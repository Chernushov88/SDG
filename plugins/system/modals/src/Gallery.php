<?php
/**
 * @package         Modals
 * @version         9.8.2PRO
 * 
 * @author          Peter van Westen <info@regularlabs.com>
 * @link            http://www.regularlabs.com
 * @copyright       Copyright © 2018 Regular Labs All Rights Reserved
 * @license         http://www.gnu.org/licenses/gpl-2.0.html GNU/GPL
 */

namespace RegularLabs\Plugin\System\Modals;

defined('_JEXEC') or die;


use JFolder;
use JRoute;
use JUri;
use RegularLabs\Library\RegEx as RL_RegEx;

class Gallery
{
	public static function buildGallery($attributes, $data, $content)
	{
		$html = [];

		$folder = File::trimFolder($data['gallery']);

		jimport('joomla.filesystem.folder');
		if ( ! JFolder::exists(JPATH_SITE . '/' . $folder))
		{
			return '<a href="#">';
		}

		Image::setImageDataFromDataFile($folder, $data);

		unset($data['gallery']);
		unset($data['inline']);

		$data['group'] = uniqid('gallery_') . rand(1000, 9999);

		$params = Params::get();

		$settings = (object) [];

		$settings->showall = isset($data['showall']) ? $data['showall'] : $params->gallery_showall;
		unset($data['showall']);

		$settings->createthumbs = isset($data['createthumbs']) ? $data['createthumbs'] : $params->gallery_create_thumbs;
		unset($data['createthumbs']);

		$settings->thumbsuffix = isset($data['thumbsuffix']) ? $data['thumbsuffix'] : $params->gallery_thumb_suffix;
		unset($data['thumbsuffix']);

		$settings->thumbwidth  = ! empty($data['thumbwidth']) ? $data['thumbwidth'] : $params->gallery_thumb_width;
		$settings->thumbheight = ! empty($data['thumbheight']) ? $data['thumbheight'] : $params->gallery_thumb_height;
		unset($data['thumbwidth']);
		unset($data['thumbheight']);

		$settings->style = '';
		if ($settings->showall || $content == '')
		{
			$w = $settings->thumbwidth;
			$h = $settings->thumbheight;

			$style = ($w ? 'width:' . $w . 'px;' : '')
				. ($h ? 'height:' . $h . 'px;' : '');

			$settings->style = $style ? ' style="' . $style . '"' : '';
		}

		$settings->separator = isset($data['separator']) ? $data['separator'] : str_replace('{none}', '', $params->gallery_separator);
		unset($data['separator']);

		$settings->filter = isset($data['filter']) ? $data['filter'] : $params->gallery_filter;
		unset($data['filter']);

		$settings->first = isset($data['first']) ? $data['first'] : 0;
		unset($data['first']);

		$settings->thumbnail = isset($data['thumbnail']) ? $data['thumbnail'] : '';
		unset($data['thumbnail']);

		$settings->auto_titles = isset($data['auto_titles']) ? $data['auto_titles'] : $params->auto_titles;
		unset($data['auto_titles']);

		$settings->title_case = isset($data['title_case']) ? $data['title_case'] : $params->title_case;
		unset($data['title_case']);

		$images = self::getGalleryImageList($folder, $settings);

		$settings->firstid   = self::getFirstID($settings->first, $images);
		$settings->thumbnail = self::getThumbnail($settings->thumbnail, $images);

		foreach ($images as $count => $image)
		{
			$html[] = self::getGalleryImageLink($folder, $image, $attributes, $data, $content, $settings, $count);

			// Add hidden class to other images if not show all
			if ( ! $count && ! $settings->showall)
			{
				$attributes->class .= ' modal_link_hidden';
				$attributes->id    = '';
			}
		}

		return implode('</a>' . $settings->separator, $html);
	}

	private static function getFirstID($first = 0, $images)
	{
		if ( ! $first)
		{
			return 0;
		}

		if ($first == 'random')
		{
			return array_rand($images, 1);
		}

		foreach ($images as $id => $image)
		{
			if ($image->image != $first)
			{
				continue;
			}

			return $id;
		}
	}

	private static function getThumbnail($thumbnail = '', $images)
	{
		if ( ! $thumbnail)
		{
			return '';
		}

		if ($thumbnail == 'random')
		{
			$rand = $images[array_rand($images, 1)];

			return $rand->thumbnail;
		}

		foreach ($images as $image)
		{
			if ($image->image != $thumbnail)
			{
				continue;
			}

			return $image->thumbnail;
		}
	}

	private static function getGalleryImageList($folder, &$settings)
	{
		$folder = File::trimFolder($folder);
		$filter = $settings->filter;

		if (RL_RegEx::match('(.*?\()([^\)]*)(\).*?)', $settings->filter, $match))
		{
			$filter = $match[1] . $match[2] . '|' . strtoupper($match[2]) . $match[3];
		}

		$files = JFolder::files(JPATH_SITE . '/' . $folder, $filter);

		$images = [];
		foreach ($files as $file)
		{
			if ( ! $image = Image::getImageObject($folder, $file, $settings, true))
			{
				continue;
			}

			$images[] = $image;
		}

		return $images;
	}

	private static function getGalleryImageLink($folder, $image, &$attributes, &$data, $content, $settings, &$count)
	{
		$attributes->href = JUri::root(true) . '/' . $image->folder . '/' . $image->image;
		$image_data       = $data;

		Image::setImageDataAtribute('title', $image_data, $image->image, $count + 1, true);
		Image::setImageDataAtribute('description', $image_data, $image->image, $count + 1, true);

		if ( ! isset($image_data['title']) && $settings->auto_titles)
		{
			// set the auto title
			$image_data['title'] = File::getTitle($image->image, $settings->title_case);
		}

		if ($count != $settings->firstid)
		{
			unset($image_data['open']);
		}

		$link = Link::build($attributes, $image_data);

		if ($settings->showall || $count == $settings->firstid)
		{
			$link = str_replace(' modal_link_hidden', '', $link);
		}

		if ($settings->showall || ($count == $settings->firstid && $content == ''))
		{
			// show the thumbnail if showall is set or if the first image should be shown
			$folder = File::trimFolder($folder);

			$thumbnail = $settings->thumbnail ?: $image->thumbnail;

			$image->alt = isset($image->alt) ? $image->alt : File::getTitle($image->image, $settings->title_case);

			$link .= '<img src="' . JRoute::_(JUri::base(true) . '/' . $folder . '/' . $thumbnail) . '"'
				. ' alt="' . $image->alt . '"'
				. $settings->style
				. '>';

			return $link;
		}

		if ($count != $settings->firstid)
		{
			return $link;
		}

		return $link . $content;
	}
}
