<?php
/* @package Joomla
 * @copyright Copyright (C) Open Source Matters. All rights reserved.
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL, see LICENSE.php
 * @extension Phoca Extension
 * @copyright Copyright (C) Jan Pavelka www.phoca.cz
 * @license http://www.gnu.org/copyleft/gpl.html GNU/GPL
 */

defined( '_JEXEC' ) or die( 'Restricted access' );
jimport( 'joomla.plugin.plugin' );

class plgContentPhocaOpenGraphHelper
{
	public static function renderTag($name, $value, $type = 1) {
		$document 	= JFactory::getDocument();
		if ($type == 1) {
			$document->setMetadata(htmlspecialchars($name), htmlspecialchars($value));
		} else {
			$document->addCustomTag('<meta property="'.htmlspecialchars($name).'" content="' . htmlspecialchars($value) . '" />');
		}
	}
	
}

class plgContentPhocaOpenGraph extends JPlugin
{
	public $pluginNr = 0;
	
	public function __construct(& $subject, $config) {
		parent::__construct($subject, $config);
		$this->loadLanguage();
		
	}
	
	public function onContentAfterDisplay($context, &$row, &$params, $page=0) {
		
		$app 	= JFactory::getApplication();
		$view	= JRequest::getCmd('view');// article, category, featured
		$option	= JRequest::getCmd('option');// article, category, featured
		$itemid	= JRequest::getCmd('Itemid');

		
		/*if ($view == 'article' && JRequest::getCmd('id') != $row->id) {
			// Page displays article so we want to set metadata for main content article only
			return;
		}*/
		if ($app->getName() != 'site') { return;}
		if ($view == 'featured' && $this->params->get('displayf', 1) == 0) { return; }
		if ($view == 'category' && $this->params->get('displayc', 1) == 0) { return; }
		
		
		if ((int)$this->pluginNr > 0) { return; } // Second instance in featured view or category view 
	
		$itemids 	= $this->params->get('disable_menu_items', '');
		$options 	= $this->params->get('disable_options', '');
		$views 		= $this->params->get('disable_views', '');
		
		if ($itemids != '') {
			$itemidsA =  explode(',', $itemids);
			if (!empty($itemidsA)) {
				foreach ($itemidsA as $k => $v) {
					if ($itemid == $v) {
						return;// don't apply it in this view
					}
				}
			}
		}
		
		if ($options != '') {
			$optionsA =  explode(',', $options);
			if (!empty($optionsA)) {
				foreach ($optionsA as $k => $v) {
					if ($option == $v) {
						return;// don't apply it in this view
					}
				}
			}
		}
		
		if ($views != '') {
			$viewsA =  explode(',', $views);
			if (!empty($viewsA)) {
				foreach ($viewsA as $k => $v) {
					if ($view == $v) {
						return;// don't apply it in this view
					}
				}
			}
		}
		
		$document 	= JFactory::getDocument();
		$config 	= JFactory::getConfig();
		$type		= $this->params->get('render_type', 1);
		$desc_intro	= $this->params->get('desc_intro', 0);
		
		// We need help variables as we cannot change the $row variable - such then will influence global settings
		$thisDesc 	= '';
		$thisTitle	= '';
		$thisKey	= '';
		$thisImg	= '';
		
		if (isset($row->metadesc)) {
			$thisDesc 	= $row->metadesc;
		}
		if (isset($row->title)) {
			$thisTitle	= $row->title;
		}
		if (isset($row->metakey)) {
			$thisKey	= $row->metakey;
		}

		
		if ($view == 'featured' && $this->pluginNr == 0) {
			$suffix 		= 'f';// Data from first article will be set
			$this->pluginNr = 1;
		} else if ($view == 'category' && $this->pluginNr == 0) {
			$suffix 		= 'c';// Data from first article will be set
			if (isset($row->catid) && (int)$row->catid > 0) {
				$db = JFactory::getDBO();
				$query = ' SELECT c.metadesc, c.metakey, c.params, c.title FROM #__categories AS c'
			    .' WHERE c.id = '.(int) $row->catid . ' LIMIT 1';
				$db->setQuery($query);
				$cItem = $db->loadObjectList();
				
				if (!empty($cItem[0]->params)) {
					$registry = new JRegistry;
					$registry->loadString($cItem[0]->params);
					$pC = $registry->toArray();
					if (isset($pC['image']) && $pC['image'] != '') {
						$thisImg =  $pC['image'];
					}
					
				}
				
				if (isset($cItem[0]->metadesc) && $cItem[0]->metadesc != '') {
					//$row->metadesc 	= $cItem[0]->metadesc; We cannot influence global variable
					$thisDesc		= $cItem[0]->metadesc;
				}
				if (isset($cItem[0]->title) && $cItem[0]->title != '') {
					//$row->title 	= $cItem[0]->title; We cannot influence global variable
					$thisTitle		= $cItem[0]->title;
				}
				if (isset($cItem[0]->metakey) && $cItem[0]->metakey != '') {
					//$row->title 	= $cItem[0]->title; We cannot influence global variable
					$thisKey		= $cItem[0]->metakey;
				}
			}
			$this->pluginNr = 1;
		} else {
			$suffix 		= '';
		}
		
		// Title
		if ($this->params->get('title'.$suffix, '') != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:title', $this->params->get('title'.$suffix, ''), $type);
		} else if ($row->title != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:title', $thisTitle, $type);
		}
		
		// Type
		plgContentPhocaOpenGraphHelper::renderTag('og:type', $this->params->get('type'.$suffix, 'article'), $type);
		
		// Image
		$pictures = '';
		if (isset($row->images)) {
			$pictures = json_decode($row->images);
		}

		if ($this->params->get('image'.$suffix, '') != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:image', JURI::base(false).$this->params->get('image'.$suffix, ''), $type);
		} else if ($thisImg != ''){
			plgContentPhocaOpenGraphHelper::renderTag('og:image', JURI::base(false).$thisImg, $type);
		} else if (isset($pictures->{'image_intro'}) && $pictures->{'image_intro'} != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:image', JURI::base(false).$pictures->{'image_intro'}, $type);
		} else if (isset($pictures->{'image_fulltext'}) && $pictures->{'image_fulltext'} != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:image', JURI::base(false).$pictures->{'image_fulltext'}, $type);
		} else {
			// Try to find image in article
			$img = 0;
			$fulltext = '';
			if (isset($row->fulltext) && $row->fulltext != '') {
				$fulltext = $row->fulltext;
			}
			$introtext = '';
			if (isset($row->introtext) && $row->introtext != '') {
				$introtext = $row->introtext;
			}
			$content = $introtext . $fulltext;
			preg_match('/< *img[^>]*src *= *["\']?([^"\']*)/i', $content, $src);
			if (isset($src[1]) && $src[1] != '') {
				plgContentPhocaOpenGraphHelper::renderTag('og:image', JURI::base(false).$src[1], $type);
				$img = 1;
			}
			
			// Try to find image in images/phocaopengraph folder
			if ($img == 0) {
				if (isset($row->id) && (int)$row->id > 0) {
					
					jimport( 'joomla.filesystem.file' );
					$imgPath	= '';
					$path 		= JPATH_ROOT . '/images/phocaopengraph/';
					if (JFile::exists($path . '/' . (int)$row->id.'.jpg')) {
						$imgPath = JURI::base(false) . 'images/phocaopengraph/'.(int)$row->id.'.jpg';
					} else if (JFile::exists($path . '/' . (int)$row->id.'.png')) {
						$imgPath = JURI::base(false) . 'images/phocaopengraph/'.(int)$row->id.'.png';
					} else if (JFile::exists($path . '/' . (int)$row->id.'.gif')) {
						$imgPath = JURI::base(false) . 'images/phocaopengraph/'.(int)$row->id.'.gif';
					}
					
					if ($imgPath != '') {
						plgContentPhocaOpenGraphHelper::renderTag('og:image', $imgPath, $type);
					}
				}
			}
		}
		
		//URL
		if ($this->params->get('url'.$suffix, '') != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:url', $this->params->get('url'.$suffix, ''), $type);
		} else {	
			//} else if ((int)$row->id > 0) {
			//$url = ContentHelperRoute::getArticleRoute($row->id);
			//$document->setMetadata('og:url', JRoute::_($url));
			$uri 	= JFactory::getURI();
			plgContentPhocaOpenGraphHelper::renderTag('og:url', $uri->toString(), $type);
		}
		
		
		// Site Name
		if ($this->params->get('site_name'.$suffix, '') != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:site_name', $this->params->get('site_name'.$suffix, ''), $type);
		} else if ($thisTitle != '') {
			plgContentPhocaOpenGraphHelper::renderTag('og:site_name', $config->get('sitename'), $type);
		}
		
		
		// Description
		
		
		if ($this->params->get('description'.$suffix, '') != '') { // description in params
			plgContentPhocaOpenGraphHelper::renderTag('og:description', $this->params->get('description'.$suffix, ''), $type);
		} else if (isset($thisDesc) && $thisDesc != '') { // article meta description
			plgContentPhocaOpenGraphHelper::renderTag('og:description', $thisDesc, $type);
		} else if ($row->params->get('menu-meta_description') != '') { // menu link meta description
			plgContentPhocaOpenGraphHelper::renderTag('og:description', $row->params->get('menu-meta_description'), $type);
		} else if (isset($row->introtext) && $row->introtext != '' && $desc_intro == 1) { // artcle introtext
			$iTD = str_replace("\r\n", ' ', strip_tags($row->introtext));
			$iTD = str_replace("\n", ' ', $iTD);
			$iTD = str_replace("\n", ' ', $iTD);
			
			// Remove every possible plugin code
			$iTD = preg_replace("/\{[^}]+\}/","",$iTD);
			plgContentPhocaOpenGraphHelper::renderTag('og:description', $iTD, $type);
		} else if ($config->get('MetaDesc') != '') { // site meta desc
			plgContentPhocaOpenGraphHelper::renderTag('og:description', $config->get('MetaDesc'), $type);
		}
		
		// FB App ID - COMMON
		if ($this->params->get('app_id', '') != '') {
			plgContentPhocaOpenGraphHelper::renderTag('fb:app_id', $this->params->get('app_id', ''), $type);
		}
		
		// Other
		if ($this->params->get('other', '') != '') {
			$other = explode (';', $this->params->get('other', ''));
			if (!empty($other)) {
				foreach ($other as $v) {
					if ($v != '') {
						$vother = explode ('=', $v);
						if(!empty($vother)) {
							if (isset($vother[0]) && isset($vother[1])) {
								plgContentPhocaOpenGraphHelper::renderTag(strip_tags($vother[0]), $vother[1], $type);
							}
						}
					}
				
				}
			}
		}

	}
}
?>