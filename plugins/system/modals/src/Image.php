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


use JFile;
use JImage;
use JText;
use RegularLabs\Library\RegEx as RL_RegEx;

class Image
{
	static $data_files = null;

	public static function getImageObject($folder, $file, &$settings, $ignore_thumbnails = false)
	{
		$folder       = rtrim($folder, '/');
		$file         = utf8_encode($file);
		$reverse_file = self::isThumbnail($folder, $file, $settings->thumbsuffix);

		if ($reverse_file && $ignore_thumbnails)
		{
			// Return false if this is a gallery, as we want to ignore thumbnails
			return false;
		}

		$image     = $reverse_file ?: $file;
		$thumbnail = $reverse_file ? $file : self::getThumbnailFile($folder, $file, $settings->thumbsuffix, $settings->createthumbs, $settings->thumbwidth);

		return (object) [
			'folder'    => $folder,
			'image'     => $image,
			'thumbnail' => $thumbnail,
		];
	}

	public static function setImageDataFromDataFile($folder, &$data)
	{
		$file_data = self::getImageDataFromDataFile($folder);

		if (empty($file_data) || ! is_array($file_data))
		{
			return;
		}

		$data = $file_data + $data;
	}

	public static function getImageDataFromDataFile($folder)
	{
		$folder = File::trimFolder($folder);

		if (isset(self::$data_files[$folder]))
		{
			return self::$data_files[$folder];
		}

		jimport('joomla.filesystem.file');
		if ( ! JFile::exists(JPATH_SITE . '/' . $folder . '/data.txt'))
		{
			return [];
		}

		$data = file_get_contents(JPATH_SITE . '/' . $folder . '/data.txt');

		$data = str_replace("\r", '', $data);
		$data = explode("\n", $data);

		$array = [];
		foreach ($data as $data_line)
		{
			if (empty($data_line)
				|| $data_line[0] == '#'
				|| strpos($data_line, '=') === false
			)
			{
				continue;
			}
			list($key, $val) = explode('=', $data_line, 2);
			$array[$key] = $val;
		}

		self::$data_files[$folder] = $array;

		return $array;
	}

	public static function setImageDataAtribute($type, &$image_data, $image, $count = 0, $jtext = false)
	{
		if ($count && isset($image_data[$type . '_' . $count]))
		{
			$image_data[$type] = $image_data[$type . '_' . $count];

			if ($jtext)
			{
				$image_data[$type] = JText::_($image_data[$type]);
			}

			return;
		}

		$image_name = str_replace('.' . File::getFiletype($image), '', $image);

		if (isset($image_data[$type . '_' . $image_name]))
		{
			$image_data[$type] = $image_data[$type . '_' . $image_name];

			if ($jtext)
			{
				$image_data[$type] = JText::_($image_data[$type]);
			}
		}
	}

	private static function isThumbnail($folder, $file, $thumbsuffix)
	{
		// this image is a thumbnail
		if ( ! RL_RegEx::match($thumbsuffix . '(\.[^.]+)$', $file, $match))
		{
			return false;
		}

		$folder = File::trimFolder($folder);

		// check if there is a non-thumbnail image
		$test = str_replace($match[0], $match[1], $file);
		if (JFile::exists(JPATH_SITE . '/' . $folder . '/' . utf8_decode($test)))
		{
			return $test;
		}

		// there is no non-thumbnail image
		return false;
	}

	private static function getThumbnailFile($folder, $file, $thumbsuffix, $create = false, $width = 0)
	{
		$folder = JPATH_SITE . '/' . File::trimFolder($folder);

		// Check if there is a thumbnail image
		// image = image_x.jpg => thumbnail = image_x_t.jpg
		// image = image_1234.jpg => thumbnail = image_1234_t.jpg
		$thumbnail = RL_RegEx::replace('\.[^.]+$', $thumbsuffix . '\0', $file);
		if (JFile::exists($folder . '/' . utf8_decode($thumbnail)))
		{
			return $thumbnail;
		}

		if ($create)
		{
			// Create new thumbnail
			// image = image_x.jpg => thumbnail = image_x_t.jpg
			// image = image_1234.jpg => thumbnail = image_1234_t.jpg
			self::createThumbnail($folder, $file, $thumbnail, $width);

			return $thumbnail;
		}

		// Remove ending letter/digits and test for thumbnail on that:
		// image = image_x.jpg => thumbnail = image_t.jpg
		// image = image_1234.jpg => thumbnail = image_t.jpg
		$thumbnail = RL_RegEx::replace('_(?:[a-z]|[0-9]+)(\.[^.]+)$', $thumbsuffix . '\1', $file);
		if (JFile::exists($folder . '/' . utf8_decode($thumbnail)))
		{
			return $thumbnail;
		}

		return $file;
	}

	private static function createThumbnail($folder, $file, $thumbnail, $width)
	{
		$jImage = new JImage($folder . '/' . $file);

		$thumb = $jImage->resize($width, '100%', true);

		$thumb->toFile($folder . '/' . utf8_decode($thumbnail));

		$thumb->destroy();
		$jImage->destroy();
	}
}
