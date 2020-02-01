<?php

/*
 * Easy Open Graph
 * @author e-max
 * @license GPLv3 http://www.gnu.org/licenses/gpl.html
 * @email info@e-max.it
 * @url http://www.e-max.it/
 * 
 * Reference: http://developers.facebook.com/docs/opengraph/
 * Reference: http://ogp.me/
 */

defined( '_JEXEC' ) or die( 'Restricted access' );


jimport( 'joomla.plugin.plugin' );


class plgContentEasyOpenGraph extends JPlugin {
	
	function plgContentEasyOpenGraph( &$subject, $params ) {
		parent::__construct( $subject, $params );
	}
	
	public function onContentBeforeDisplay( $context, &$article, &$params ) {
//		global $mainframe;
		if (JRequest::getVar('view') != 'featured' && JRequest::getVar('option','') != 'com_media') {
			$document = JFactory::getDocument();

			$article_title = JTable::getInstance("content");
			$article_title->load(JRequest::getInt("id"));

			$u = JFactory::getURI();
			$easyopengraphURL				= $u->toString();

			// Get Plugin info
			$easyopengraphTitle				= $this->params->get('easyopengraphtitle');
			$easyopengraphUseStaticTitle	= $this->params->get('easyopengraphusestatictitle');
			$easyopengraphType				= $this->params->get('easyopengraphtype');
			$easyopengraphStaticURL			= $this->params->get('easyopengraphstaticurl');
			$easyopengraphUseStaticURL		= $this->params->get('easyopengraphusestaticurl');
			$easyopengraphSiteName			= $this->params->get('easyopengraphsitename');
			$easyopengraphImage				= $this->params->get('easyopengraphimage');
			$easyopengraphDynImage			= $this->params->get('easyopengraphdynimage');
			$easyopengraphAuthor			= $this->params->get('easyopengraphauthor');
			$easyopengraphPublisher			= $this->params->get('easyopengraphpublisher');
			$easyopengraphAdmin				= $this->params->get('easyopengraphadmin');
			$easyopengraphAppid				= $this->params->get('easyopengraphappid');
			$easyopengraphDesc				= $this->params->get('easyopengraphdesc');
			$easyopengraphUseStaticDesc		= $this->params->get('easyopengraphusestaticdesc');
			$easyopengraphLatitude			= $this->params->get('easyopengraphlatitude');
			$easyopengraphLongitude			= $this->params->get('easyopengraphlongitude');
			$easyopengraphAddress			= $this->params->get('easyopengraphaddress');
			$easyopengraphLocality			= $this->params->get('easyopengraphlocality');
			$easyopengraphRegion			= $this->params->get('easyopengraphregion');
			$easyopengraphPostal			= $this->params->get('easyopengraphpostal');
			$easyopengraphCountry			= $this->params->get('easyopengraphcountry');
			$easyopengraphEmail				= $this->params->get('easyopengraphemail');
			$easyopengraphPhone				= $this->params->get('easyopengraphphone');
			$easyopengraphFax				= $this->params->get('easyopengraphfax');
			$easyopengraphDynVideo			= $this->params->get('easyopengraphdynvideo');
			$easyopengraphVideoYoutube		= $this->params->get('easyopengraphvideoyoutube');
			$easyopengraphVideo				= $this->params->get('easyopengraphvideo');
			$easyopengraphVideoWidth		= $this->params->get('easyopengraphvideowidth');
			$easyopengraphVideoHeight		= $this->params->get('easyopengraphvideoheight');
			$easyopengraphDynAudio			= $this->params->get('easyopengraphdynaudio');
			$easyopengraphAudio				= $this->params->get('easyopengraphaudio');
			$easyopengraphAudioTitle		= $this->params->get('easyopengraphaudiotitle');
			$easyopengraphAudioArtist		= $this->params->get('easyopengraphaudioartist');
			$easyopengraphAudioAlbum		= $this->params->get('easyopengraphaudioalbum');
			$easyopengraphUpc				= $this->params->get('easyopengraphupc');
			$easyopengraphIsbn				= $this->params->get('easyopengraphisbn');
			$easyopengraphCredits			= $this->params->get('easyopengraphcredits');
			$youtube_ok=1;
			if ($easyopengraphVideoYoutube == 1) { $easyopengraphVideoYoutubeCode = $easyopengraphVideo; }

			// Static or dynamic entrys
			if ($easyopengraphUseStaticURL == 1) {
				$easyopengraphURL = $easyopengraphStaticURL; 
			}

			if ($easyopengraphUseStaticTitle == 0) {
				$easyopengraphTitle = $article_title->get("title");
			}

			if ($easyopengraphUseStaticDesc == 0) {
				$easyopengraphDesc = $article_title->get("metadesc");
				// get the meta description from menu item if not available in article
				if (empty($easyopengraphDesc)) {
					$application = JFactory::getApplication();
					$easyopengraphDesc = $application->getMenu()->getActive()->params->get('menu-meta_description');
					// get the global meta description from configuration if not available in menu item
					if (empty($easyopengraphDesc)) {
						$easyopengraphDesc = $document->getMetaData("description");
					}
				}
			}

			// Set META-Tags
			$document->addCustomTag('<meta property="og:title" content="'.$easyopengraphTitle.'"/>');
			/*$document->addCustomTag('<meta property="og:type" content="'.$easyopengraphType.'"/>');*/
			/*if ($easyopengraphDynImage == 0) {
				// its done static
				$document->addCustomTag('<meta property="og:image" content="'.$easyopengraphImage.'"/>');
			}*/
			$document->addCustomTag('<meta property="og:url" content="'.$easyopengraphURL.'"/>');
			if ($easyopengraphSiteName != '') { $document->addCustomTag('<meta property="og:site_name" content="'.$easyopengraphSiteName.'"/>'); }
			if ($easyopengraphDesc != '') { $document->addCustomTag('<meta property="og:description" content="'.$easyopengraphDesc.'"/>'); }
			if ($easyopengraphAuthor != '') { $document->addCustomTag('<meta property="article:author" content="'.$easyopengraphAuthor.'"/>');	}
			if ($easyopengraphPublisher != '') { $document->addCustomTag('<meta property="article:publisher" content="'.$easyopengraphPublisher.'"/>');	}
			if ($easyopengraphAdmin != '') { $document->addCustomTag('<meta property="fb:admins" content="'.$easyopengraphAdmin.'"/>');	}
			if ($easyopengraphAppid != '') { $document->addCustomTag('<meta property="fb:app_id" content="'.$easyopengraphAppid.'"/>'); }
			if ($easyopengraphLatitude != '') { $document->addCustomTag('<meta property="og:latitude" content="'.$easyopengraphLatitude.'"/>'); }
			if ($easyopengraphLongitude != '') { $document->addCustomTag('<meta property="og:longitude" content="'.$easyopengraphLongitude.'"/>'); }
			if ($easyopengraphAddress != '') { $document->addCustomTag('<meta property="og:street-address" content="'.$easyopengraphAddress.'"/>'); }
			if ($easyopengraphLocality != '') { $document->addCustomTag('<meta property="og:locality" content="'.$easyopengraphLocality.'"/>'); }
			if ($easyopengraphRegion != '') { $document->addCustomTag('<meta property="og:region" content="'.$easyopengraphRegion.'"/>'); }
			if ($easyopengraphPostal != '') { $document->addCustomTag('<meta property="og:postal-code" content="'.$easyopengraphPostal.'"/>'); }
			if ($easyopengraphCountry != '') { $document->addCustomTag('<meta property="og:country-name" content="'.$easyopengraphCountry.'"/>'); }
			if ($easyopengraphEmail != '') { $document->addCustomTag('<meta property="og:email" content="'.$easyopengraphEmail.'"/>'); }
			if ($easyopengraphPhone != '') { $document->addCustomTag('<meta property="og:phone_number" content="'.$easyopengraphPhone.'"/>'); }
			if ($easyopengraphFax != '') { $document->addCustomTag('<meta property="og:fax_number" content="'.$easyopengraphFax.'"/>'); }

			if ($easyopengraphDynImage > 0) {
				if ($easyopengraphDynImage == 1) {
					preg_match('/src=[\\"\']([-0-9A-Za-z\/_]*.(jpg|png|gif|jpeg))/i', $article->introtext, $image);
				}
				elseif ($easyopengraphDynImage == 2) {
					preg_match('/src=[\\"\']([-0-9A-Za-z\/_]*.(jpg|png|gif|jpeg))/i', $article->fulltext, $image);
				}
				elseif ($easyopengraphDynImage == 3) {
					$image = explode('","', $article->images);
					$image = explode('":"', $image[0]);
					$image = str_replace('\/', "/", $image);
				}
				elseif ($easyopengraphDynImage == 4) {
					$image = explode('","', $article->images);
					$image = explode('":"', $image[4]);
					$image = str_replace('\/', "/", $image);
				}
				if (array_key_exists(1, $image)) {
					if (substr($image[1], 0, 4) != 'http') {
						$image[1] = JURI::base().$image[1];	
					}
					$easyopengraphImage = $image[1];
				}
			}

			if ($easyopengraphDynVideo == 1) {
				preg_match('/data=[\\"\']([-0-9A-Za-z\/_]*.(flv|swf))/i', $article->text, $video);
				preg_match('/youtube\.com\/(v\/|watch\?v=)([\w\-]+)/', $article->text, $videoyoutube);

				if (array_key_exists(1, $video)) {
					if (substr($video[1], 0, 4) != 'http') {
						$video[1] = JURI::base().$video[1];	
					}
					$easyopengraphVideo = $video[1];
					$youtube_ok=0;
				} else {
					if (array_key_exists(2, $videoyoutube)) {
						$easyopengraphVideo = 'http://www.youtube.com/v/'.$videoyoutube[2].'?version=3&autohide=1';
						$easyopengraphImage = 'http://i2.ytimg.com/vi/'.$videoyoutube[2].'/default.jpg';
						$easyopengraphType = 'video';
						$youtube_ok=0;
					}
				}
			}
		
			if ($easyopengraphDynAudio == 1) {
				preg_match('/src=[\\"\']([-0-9A-Za-z\/_]*.(mp3))/i', $article->text, $audio);
			
				if (array_key_exists(1, $audio)) {
					if (substr($audio[1], 0, 4) != 'http') {
						$audio[1] = JURI::base().$audio[1];	
					}
					$easyopengraphAudio = $audio[1];
				}
			}
		
			if ($easyopengraphVideo != '') {
				if ($easyopengraphVideoYoutube == 1 && $youtube_ok == 1) {
					$easyopengraphVideo = 'http://www.youtube.com/v/'.$easyopengraphVideoYoutubeCode.'?version=3&autohide=1';
					$easyopengraphImage = 'http://i2.ytimg.com/vi/'.$easyopengraphVideoYoutubeCode.'/default.jpg';
					$easyopengraphType = 'video';
				}
				$document->addCustomTag('<meta property="og:video" content="'.$easyopengraphVideo.'"/>');
				$document->addCustomTag('<meta property="og:video:width" content="'.$easyopengraphVideoWidth.'"/>');
				$document->addCustomTag('<meta property="og:video:height" content="'.$easyopengraphVideoHeight.'"/>');
				$document->addCustomTag('<meta property="og:video:type" content="application/x-shockwave-flash"/>');
			}
			
			if ($easyopengraphAudio != '') {
				$document->addCustomTag('<meta property="og:audio" content="'.$easyopengraphAudio.'"/>');
				if ($easyopengraphAudioTitle != '') { $document->addCustomTag('<meta property="og:audio:title" content="'.$easyopengraphAudioTitle.'"/>'); }
				if ($easyopengraphAudioArtist != '') { $document->addCustomTag('<meta property="og:audio:artist" content="'.$easyopengraphAudioArtist.'"/>'); }
				if ($easyopengraphAudioAlbum != '') { $document->addCustomTag('<meta property="og:audio:album" content="'.$easyopengraphAudioAlbum.'"/>'); }
				$document->addCustomTag('<meta property="og:audio:type" content="application/mp3"/>');
			}
		
			if ($easyopengraphImage != '') { $document->addCustomTag('<meta property="og:image" content="'.$easyopengraphImage.'"/>'); }
			$document->addCustomTag('<meta property="og:type" content="'.$easyopengraphType.'"/>');
			if ($easyopengraphType == 'album' || $easyopengraphType == 'book' || $easyopengraphType == 'drink' || $easyopengraphType == 'food' || $easyopengraphType == 'game' || $easyopengraphType == 'movie' || $easyopengraphType == 'product' || $easyopengraphType == 'song' || $easyopengraphType == 'tv_show') {
				if ($easyopengraphUpc != '') { $document->addCustomTag('<meta property="og:upc" content="'.$easyopengraphUpc.'"/>'); }
				if ($easyopengraphIsbn != '') { $document->addCustomTag('<meta property="og:isbn" content="'.$easyopengraphIsbn.'"/>'); }
			}
			if ($easyopengraphCredits == '0') {
				$article->text.= '<div style="display:none; text-align:right;"><a href="http://e-max.it/posizionamento-siti-web/socialize" title="e-max.it: social marketing" target="_blank" rel="nofollow"><img src="'.JURI::base(true).'/plugins/content/easyopengraph/assets/img/social_media_marketing.png" alt="e-max.it: your social media marketing partner" width="12" height="12" style="vertical-align:middle;" /></a></div>';
			}
			else {
				$article->text.= '<div style="text-align:right;"><a href="http://e-max.it/posizionamento-siti-web/socialize" title="e-max.it: social marketing" target="_blank" rel="nofollow"><img src="'.JURI::base(true).'/plugins/content/easyopengraph/assets/img/social_media_marketing.png" alt="e-max.it: your social media marketing partner" width="12" height="12" style="vertical-align:middle;" /></a></div>';
			}
		}
	}
}
