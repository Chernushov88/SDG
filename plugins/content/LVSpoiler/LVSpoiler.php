<?php
/**
 * @version        1.0.6 from Arkadiy Sedelnikov
 * @copyright    Copyright (C) 2005 - 2011 Open Source Matters, Inc. All rights reserved.
 * @license        GNU General Public License version 2 or later;
 */

// No direct access to this file
defined('_JEXEC') or die();

class plgContentLVSpoiler extends JPlugin
{

    public function __construct(& $subject, $config)
    {
        parent::__construct($subject, $config);
        $this->loadLanguage();
    }

    public function onPrepareContent(&$article, &$params, $limitstart = 0)
    {
        $article->text = $this->prepare($article->text);
    }

    public function onContentPrepare($context, &$row, &$params, $page = 0)
    {
        // Danger, Will Robinson! $row in Joomla! 1.6/1.7 may be a string, not an article object!
        if (is_object($row)) {
            return $this->onPrepareContent($row, $params, $page);
        } else {
            $row = $this->prepare($row);
        }

        return true;
    }

    private function prepare($text)
    {
        $regex = "#{spoiler(?: title=(([_0-9A-Za-zА-яа-яЁё](.*?)))?)?[\s|&nbsp;]opened=([0-9](.*?))}(.*?){/spoiler}#s";
        $text = preg_replace_callback($regex, array($this, 'LVSpoiler_replacer'), $text);
        return $text;
    }

    private function LVSpoiler_css()
    {
        $jsjquery = $this->params->get('jsjquery', 1);
        $jsshow = $this->params->get('jsshow', 1);
        $jstype = $this->params->get('jstype', 1);
        $cssload = $this->params->get('cssload', 1);

        $titlesize = $this->params->get('titlesize', 18);
        $titlecolor = $this->params->get('titlecolor', '008aeb');
        $titlebordersize = $this->params->get('titlebordersize', 0);
        $titlebordercolor = $this->params->get('titlebordercolor', 'ccc');
        $titlestyle = $this->params->get('titlestyle', 'normal');
        $titleborderstyle = $this->params->get('titleborderstyle', 'solid');

        $titleborderradius = $this->params->get('titleborderradius', '8');
        $titlewidth = $this->params->get('titlewidth', '95%');
        $titlebgcolor = $this->params->get('titlebgcolor', 'ff5c00');
        $textShadow = $this->params->get('textshadow', 1);
        $boxShadow = $this->params->get('boxshadow', 1);
        $boxshadowvalue = $this->params->get('boxshadowvalue', '0 0 5px rgba(0,0,0,0.6)');
        $texthadowvalue = $this->params->get('texthadowvalue', '0 -1px 1px rgba(0,0,0,0.25)');
        $fontfamily = $this->params->get('fontfamily', '');

        $spoilerfontsize = $this->params->get('spoilerfontsize', 11);
        $spoilerfontweight = $this->params->get('spoilerfontweight', 'normal');
        $spoilerbg = $this->params->get('spoilerbg', 'FFFDDD');
        $spoilerbordersize = $this->params->get('spoilerbordersize', 1);
        $spoilerbordercolor = $this->params->get('spoilerbordercolor', 'ccc');
        $spoilerborderstyle = $this->params->get('spoilerborderstyle', 'solid');
        $spoilerborderradius = $this->params->get('spoilerborderradius', 7);
        $spoilerwidth = $this->params->get('spoilerwidth', '95%');
        $spoilerstyle = $this->params->get('spoilerstyle', 'italic');
        $spoilerpadding = $this->params->get('spoilerpadding', 10);
        $revealtype = $this->params->get('revealtype', 'click');
        $mouseoverdelay = $this->params->get('mouseoverdelay', 200);
        $collapseprev = $this->params->get('collapseprev', 0);
        $onemustopen = $this->params->get('onemustopen', 0);
        $animatedefault = $this->params->get('animatedefault', 0);
        $animatespeed = $this->params->get('animatespeed', 400);
        $togglehtml = $this->params->get('togglehtml', 'none');
        if ($togglehtml == 'none') {
            $togglehtml1 = '';
            $togglehtml2 = '';
        } else {
            $togglehtml1 = $this->params->get('togglehtml1', '');
            $togglehtml2 = $this->params->get('togglehtml2', '');
        }
        $document = & JFactory::getDocument();

        if (($jstype == 1) && $this->includeOnce('Spoiler_Mootools')) {
            $revealtype = ($revealtype == 'clickgo') ? 'click' : $revealtype;

            $jscode = '
                        var pb_sp_conf = {
                            revealtype: "' . $revealtype . '",
                            mouseoverdelay: ' . $mouseoverdelay . ',
                            collapseprev: ' . $collapseprev . ',
                            onemustopen: ' . $onemustopen . ',
                            animatedefault: ' . $animatedefault . ',
                            animatespeed: ' . $animatespeed . '
                        };';
            $document->addScriptDeclaration($jscode);

            // Load mooTools
            JHtml::_('behavior.framework', true);

            $document->addScript(JUri::base() . 'plugins/content/LVSpoiler/assets/mootools/spoiler.js');
            if ($cssload == 1) {
                $document->addStyleSheet(JUri::base() . 'plugins/content/LVSpoiler/assets/mootools/spoiler.css');
            }
            $css = '
    .sp-head-click a{font-size: 16px; font-style: ' . $titlestyle . '; color: #464F54 !important; }
	.sp-head{border: ' . $titlebordersize . 'px #' . $titlebordercolor . ' ' . $titleborderstyle . '; font-weight: bold; color: #000;
            -webkit-border-radius: ' . $titleborderradius . 'px;
            -moz-border-radius: ' . $titleborderradius . 'px;
            -khtml-border-radius: ' . $titleborderradius . 'px;
            border-radius: ' . $titleborderradius . 'px;
            width: ' . $titlewidth . ';
            background-color: rgba(204, 204, 204, 0.21);
            ';
            

            if (!empty($fontfamily)) {
                $css .= 'font-family: ' . $fontfamily . ';';
            }

            if ($boxShadow == 1) {
                $css .= '
            box-shadow: ' . $boxshadowvalue . ';
            -moz-box-shadow: ' . $boxshadowvalue . ';
	        
	        ';
            }

            $css .= '}
	.sp-body{ font-weight: ' . $spoilerfontweight . '; background-color: rgba(235, 236, 237, 0.11); border: ' . $spoilerbordersize . 'px #' . $spoilerbordercolor . ' ' . $spoilerborderstyle . '; 
	-webkit-border-radius: ' . $spoilerborderradius . 'px;
	-moz-border-radius: ' . $spoilerborderradius . 'px;
	-khtml-border-radius: ' . $spoilerborderradius . 'px;
	border-radius: ' . $spoilerborderradius . 'px;
	width: ' . $spoilerwidth . ';
	font-style: ' . $spoilerstyle . ';
	padding: 18px}	
	';


            $document->addStyleDeclaration($css);

        }
        if (($jstype == 2) && $this->includeOnce('Spoiler_Jquery')) {

            if ($cssload == 1) {
                $document->addStyleSheet(JUri::base() . '/plugins/content/LVSpoiler/assets/jquery/style.css');
            }

            if ($jsjquery == 1) {
                // Load jQuery
                JHtml::_('jquery.framework');
            }

            $document->addScript(JUri::base() . '/plugins/content/LVSpoiler/assets/jquery/ddaccordion.js');
            $jscode = '
		ddaccordion.init({
		headerclass: "technology",
		contentclass: "thelanguage",
		revealtype: "' . $revealtype . '",
		mouseoverdelay: ' . $mouseoverdelay . ',
		collapseprev: ' . $collapseprev . ',
		defaultexpanded: [],
		onemustopen: ' . $onemustopen . ',
		animatedefault: ' . $animatedefault . ',
		toggleclass: ["closedlanguage", "openlanguage"],
		togglehtml: ["' . $togglehtml . '", "' . $togglehtml1 . '", "' . $togglehtml2 . '"],
		animatespeed: "' . $animatespeed . '",
		oninit:function(expandedindices){
			//do nothing
		},
		onopenclose:function(header, index, state, isuseractivated){
			//do nothing
		}
	});';
            $document->addScriptDeclaration($jscode);


            $css = '
    .technology div{font-size: ' . $titlesize . 'px; color: #' . $titlecolor . '; font-style: ' . $titlestyle . ';border: ' . $titlebordersize . 'px #' . $titlebordercolor . ' ' . $titleborderstyle . '; font-weight: bold;
        -webkit-border-radius: ' . $titleborderradius . 'px;
        -moz-border-radius: ' . $titleborderradius . 'px;
        -khtml-border-radius: ' . $titleborderradius . 'px;
        border-radius: ' . $titleborderradius . 'px;
        background-color: #' . $titlebgcolor . ';
        width: ' . $titlewidth . ';
    ';
            if ($textShadow == 1) {
                $css .= 'text-shadow: ' . $texthadowvalue . ';';
            }

            if (!empty($fontfamily)) {
                $css .= 'font-family: ' . $fontfamily . ';';
            }

            if ($boxShadow == 1) {
                $css .= '
            box-shadow: ' . $boxshadowvalue . ';
            -moz-box-shadow: ' . $boxshadowvalue . ';
	        -webkit-box-shadow: ' . $boxshadowvalue . ';
	        ';
            }

            $css .= '}

	.thetextinter{font-size: ' . $spoilerfontsize . 'px; font-weight: ' . $spoilerfontweight . '; background: #' . $spoilerbg . '; border: ' . $spoilerbordersize . 'px #' . $spoilerbordercolor . ' ' . $spoilerborderstyle . '; 
	-webkit-border-radius: ' . $spoilerborderradius . 'px;
	-moz-border-radius: ' . $spoilerborderradius . 'px;
	-khtml-border-radius: ' . $spoilerborderradius . 'px;
	border-radius: ' . $spoilerborderradius . 'px;
	width: ' . $spoilerwidth . ';
	font-style: ' . $spoilerstyle . ';
	padding: ' . $spoilerpadding . 'px}	
	';
            $document->addStyleDeclaration($css);

        }
    }

    private function LVSpoiler_replacer(&$matches)
    {
        $this->LVSpoiler_css();



        //нумерация каждого спойлера (если нужно)
        global $numspoilers;
        if (!$numspoilers) {
            $numspoilers = 1;
        } else {
            $numspoilers++;
        }

        $jstype = $this->params->get('jstype', 1);
        $load_img = $this->params->get('load_img', 0);
        $revealtype = $this->params->get('revealtype', '');
        $opened = $matches[4];

        $html = '';
        $regex1 = "#{spoiler title=([_0-9A-Za-zА-яа-яЁё](.*?))}#s";
        $regex2 = "#{/spoiler}#s";
        $spoilertext = preg_replace($regex2, '', (preg_replace($regex1, '', $matches[0])));

        //обработка изображений если установлена загрузка после открытия спойлера
        if ($load_img == 1 && $opened != 1) {
            $search = array("src=", "src =", "src  =");
            $replace = 'src="#" class="spoilerimage" data-src=';
            $spoilertext = str_replace($search, $replace, $spoilertext);
        }

        switch ($jstype) {
            case '1'; //mootools

                $fold_class = ($opened == 1) ? 'unfolded' : 'folded';

                $url = 'javascript:void(0)';

                if ($revealtype == 'clickgo') {
                    $uri = & JURI::getInstance();
                    $base = $uri->toString(array('scheme', 'host', 'port'));
                    $url = $base . $_SERVER['REQUEST_URI'] . '#spoiler_' . $numspoilers;

                    //якорь к которому будет отсылать спойлер при нажатии
                    $html .= '<a name="spoiler_' . $numspoilers . '"></a>';
                }
                $html .= '<div class="spoiler" id="' . $numspoilers . '_spoiler">
                        <input type="hidden" class="opened" value="' . $opened . '">
			<div class="sp-head ' . $fold_class . '" id="' . $numspoilers . '-sp-head">
			<div class="sp-head-click" id="' . $numspoilers . '-sp-head-click"><a href="' . $url . '">' . $matches[1] . '</a></div></div>
			<div class="sp-body" id="' . $numspoilers . '-sp-body">' . $spoilertext . '</div>
			</div>';
                break;
            case '2'; //jquery
                $html .= '<div  id="spoiler_' . $numspoilers . '" class="technology"><div>' . $matches[1] . '</div></div><div class="thelanguage"><input type="hidden" class="opened" value="' . $opened . '"><div class="thetextinter">' . $spoilertext . '</div></div>';
                break;
        }
        return $html;
    }

    private function includeOnce($name)
    {
        if (!defined($name)) {
            define($name, true);
            return true;
        }
        return false;
    }

}

?>
