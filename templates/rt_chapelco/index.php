<?php

function console_log( $data ){
	echo '<script>';
	echo 'console.log('. json_encode( $data ) .')';
	echo '</script>';
  }

// no direct access
defined( '_JEXEC' ) or die( 'Restricted index access' );

// load and inititialize gantry class
require_once(dirname(__FILE__) . '/lib/gantry/gantry.php');
$gantry->init();

// get the current preset
$gpreset = str_replace(' ','',strtolower($gantry->get('name')));
?>
<!doctype html>
<html xml:lang="<?php echo $gantry->language; ?>" lang="<?php echo $gantry->language;?>" >



<head>
	<?php
	$strServer =$_SERVER['REQUEST_URI'];
	$kalendar = "kalendar-sobyitij";
	/*
	if (strstr($strServer, $kalendar)){?>
		<meta name="robots" content="noindex, nofollow" />
	<?}*/
	?>
	<!-- <meta name="yandex-verification" content="9a4d54d9a35e6872" /> -->
	<meta name="google-site-verification" content="N9lJY3vbSbrurRirxvK8h2ofFK19COnNQgqp4y7tP3M" />
	<meta name='wmail-verification' content='c8b16f7417c0e3455248f48ef291b296' />
	<?php include 'canonical.php' ?>

	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">
	<link rel="mask-icon" href="/safari-pinned-tab.svg" color="#5bbad5">
	<meta name="msapplication-TileColor" content="#da532c">
	<meta name="theme-color" content="#ffffff">
		<?php if ($gantry->get('layout-mode') == '960fixed') : ?>
		<meta name="viewport" content="width=960px">
		<?php elseif ($gantry->get('layout-mode') == '1200fixed') : ?>
		<meta name="viewport" content="width=1200px">
		<?php else : ?>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<?php endif; ?>
		<?php
			unset($this->_metaTags['name']['keywords']);
	        $gantry->displayHead();

			$gantry->addStyle('grid-responsive.css', 5);

	        $gantry->addLess('global.less', 'master.css', 8, array('main-accent'=>$gantry->get('main-accent','#519bda'), 'main-accent2'=>$gantry->get('main-accent2', '#e7714d'), 'main-body'=>$gantry->get('main-body', 'light'), 'main-showcasebg'=>$gantry->get('main-showcasebg', 'abstract')));

	        if ($gantry->browser->name == 'ie'){
	        	if ($gantry->browser->shortversion == 9){
	        		$gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
	        	}
				if ($gantry->browser->shortversion == 8){
					$gantry->addScript('html5shim.js');
				}
			}
			if ($gantry->get('layout-mode', 'responsive') == 'responsive') $gantry->addScript('rokmediaqueries.js');
			if ($gantry->get('loadtransition')) {
			$gantry->addScript('load-transition.js');
			$hidden = ' class="rt-hidden"';}

				?>
		<script src="/build/js/modernizr-custom.js"></script>
		<link href="templates/rt_chapelco/css/mystyle_v1.7.css" rel="stylesheet">

		<link href="templates/rt_chapelco/css/bootstrap.css" rel="stylesheet">
		<link rel="stylesheet" href="./build/css/style.min.css">
		<link href="templates/rt_chapelco/css/new_style_v1.3.css" rel="stylesheet">
		<script>
			dataLayer = [];
		</script>

	<script type="application/ld+json">
	{
		"@context": "https://schema.org",
		"@type": "Organization",
		"url": "https://sdg-trade.com",
		"logo": "https://sdg-trade.com/images/banners/logo.png",
		"sameAs": [
	         "https://www.facebook.com/trade.sdg",
	         "https://vk.com/clubsdg",
	         "https://www.youtube.com/c/sdgtrade",
	         "https://twitter.com/SDGTRADE",
	         "https://telegram.me/sdgtrade"
	       ],
		"contactPoint" : [
	        {
	            "@type" : "ContactPoint",
	            "telephone": "+7(499) 350-73-98",
	            "contactType": "customer service"
	        },
	        {
	            "@type" : "ContactPoint",
	            "telephone": "+7(499) 350-75-98",
	            "contactType": "customer service"
	        }

		]
	}
	</script>
	<script src="//cdn.sendpulse.com/js/push/d1ce0b0494694053f34cc3c7d9073c9a_1.js" async></script>
	<?php include 'shemas.php' ?>
	<?php $this->setGenerator(''); ?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PS2B68K');</script>
	<!-- End Google Tag Manager -->
</head>

<body <?php echo $gantry->displayBodyTag(); ?>  id="body_<?= JRequest::getInt('id')?>">
<?php
    // $db = &JFactory::getDBO();
    // $id = JRequest::getString('id');
    // $db->setQuery('SELECT #__categories.title FROM #__content, #__categories WHERE #__content.catid = #__categories.id AND #__content.id = '.$id);
    // $category = $db->loadResult();
    // echo $category;

$app = JFactory::getApplication();
$IDmenu = ' idMenu'. $app->getMenu()->getActive()->id;
// echo $menu;

$idPosts = JRequest::getInt('id');
$ClassNewStyle = '';
if ($idPosts == '883' || $idPosts == '891' || $idPosts == '893' ||  $idPosts == '895' ||  $idPosts == '24' ||  $idPosts == '22' ||  $idPosts == '37' ||  $idPosts == '519' || $idPosts == "203" || $idPosts == "461"):
	$ClassNewStyle = "body_NewStyle";
endif ?>
<div class="<?=$ClassNewStyle . $IDmenu;?>" data-menu="<?= $menu;?>">
<!-- beta-versoon -->
<!-- beta-versoon -->
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PS2B68K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
	<div id="rt-page-surround">
		<?php /** Begin Top Surround **/ if ($gantry->countModules('top') or $gantry->countModules('header')) : ?>
		<header id="rt-top-surround">
			<?php /** Begin Top **/ if ($gantry->countModules('top')) : ?>
			<div id="rt-top" <?php echo $gantry->displayClassesByTag('rt-top'); ?>>
				<div class="rt-container">
					<?php echo $gantry->displayModules('top','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Top **/ endif; ?>
			<div id="fb-root"></div>
			<script>
				(function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
			</script>
			<?php /** Begin Header **/ if ($gantry->countModules('header')) : ?>
			<div id="rt-header">
				<div class="rt-container">
					<?php echo $gantry->displayModules('header','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Header **/ endif; ?>
		</header>
		<?php /** End Top Surround **/ endif; ?>
<!-- TradingView Widget BEGIN -->
<div class="tradingview-widget-container">
  <div class="tradingview-widget-container__widget"></div>
  <script type="text/javascript" src="https://s3.tradingview.com/external-embedding/embed-widget-ticker-tape.js" async>
  {
  "symbols": [
    {
      "description": "Apple",
      "proName": "NASDAQ:AAPL"
    },
    {
      "description": "Facebook",
      "proName": "NASDAQ:FB"
    },
    {
      "description": "Electronic Arts",
      "proName": "NASDAQ:EA"
    },
    {
      "description": "Tesla",
      "proName": "NASDAQ:TSLA"
    },
    {
      "description": "Boeing",
      "proName": "NYSE:BA"
    },
    {
      "description": "General Motors",
      "proName": "NYSE:GM"
    },
    {
      "description": "Amazon",
      "proName": "NASDAQ:AMZN"
    },
    {
      "description": "Alibaba Group",
      "proName": "NYSE:BABA"
    },
    {
      "description": "McDonald's",
      "proName": "NYSE:MCD"
    },
    {
      "description": "Microsoft",
      "proName": "NASDAQ:MSFT"
    },
    {
      "description": "S&P 500 ETF",
      "proName": "AMEX:SPY"
    },
    {
      "description": "AMD",
      "proName": "NASDAQ:AMD"
    },
    {
      "description": "Intel",
      "proName": "NASDAQ:INTC"
    },
    {
      "description": "Twitter",
      "proName": "NYSE:TWTR"
    },
    {
      "description": "Coca-Cola",
      "proName": "NYSE:KO"
    },
    {
      "description": "Nvidia",
      "proName": "NASDAQ:NVDA"
    },
    {
      "description": "Uber",
      "proName": "NYSE:UBER"
    }
  ],
  "colorTheme": "light",
  "isTransparent": true,
  "displayMode": "regular",
  "locale": "ru"
}
  </script>
</div>
<!-- TradingView Widget END -->
		<?php /** Begin Drawer **/ if ($gantry->countModules('drawer')) : ?>
		<div id="rt-drawer">
			<div class="rt-container">
				<?php echo $gantry->displayModules('drawer','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Drawer **/ endif; ?>
		<div class="rt-showcase-bg"></div>
		<?php /** Begin Showcase **/ if ($gantry->countModules('showcase')) : ?>
		<div id="rt-showcase">
			<div class="rt-container">
				<?php echo $gantry->displayModules('showcase','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Showcase **/ endif; ?>
		<div id="rt-transition" <?php if ($gantry->get('loadtransition')) echo $hidden; ?>>
<?php
  $app = JFactory::getApplication();
  $menu = $app->getMenu()->getActive()->id;
   // echo $menu.'<br>';
  ?>
<?php if($menu != '101') { ?>

				<div id="rt-breadcrumbs">
					<div class="rt-container">
						<?php echo $gantry->displayModules('breadcrumb','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
<?}?>
			<div id="rt-mainbody-surround">
				<?php /** Begin Feature **/ if ($gantry->countModules('feature')) : ?>
				<div id="rt-feature">
					<div class="rt-container">
						<?php echo $gantry->displayModules('feature','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Feature **/ endif; ?>
				<?php /** Begin Utility **/ if ($gantry->countModules('utility')) : ?>
				<div id="rt-utility">
					<div class="rt-container">
						<?php echo $gantry->displayModules('utility','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Utility **/ endif; ?>
				<?php /** Begin Breadcrumbs **/ if ($gantry->countModules('breadcrumb')) : ?>

				<?php /** End Breadcrumbs **/ endif; ?>
				<?php /** Begin Main Top **/ if ($gantry->countModules('maintop')) : ?>
				<div id="rt-maintop">
					<div class="rt-container">
						<?php echo $gantry->displayModules('maintop','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Main Top **/ endif; ?>
				<?php /** Begin Full Width**/ if ($gantry->countModules('fullwidth')) : ?>
				<div id="rt-fullwidth">
					<?php echo $gantry->displayModules('fullwidth','basic','basic'); ?>
					<div class="clear"></div>
				</div>
				<?php /** End Full Width **/ endif; ?>
				<?php /** Begin Main Body **/ ?>
				<div class="rt-container">
					<?php echo $gantry->displayMainbody('mainbody','sidebar','standard','standard','standard','standard','standard'); ?>
				</div>
				<?php /** End Main Body **/ ?>
				<?php /** Begin Main Bottom **/ if ($gantry->countModules('mainbottom')) : ?>
				<div id="rt-mainbottom">
					<div class="rt-container">
						<?php echo $gantry->displayModules('mainbottom','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Main Bottom **/ endif; ?>
				<?php /** Begin Extension **/ if ($gantry->countModules('extension')) : ?>

				<div id="rt-extension">
					<div class="rt-container">
						<?php echo $gantry->displayModules('extension','standard','standard'); ?>
						<div class="clear"></div>
					</div>
				</div>
				<?php /** End Extension **/ endif; ?>
			</div>
		</div>
		<?php /** Begin Bottom **/ if ($gantry->countModules('bottom')) : ?>
		<div id="rt-bottom">
			<div class="rt-container">
				<?php echo $gantry->displayModules('bottom','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Bottom **/ endif; ?>

		<?php /** Begin Footer Section **/ if ($gantry->countModules('footer') or $gantry->countModules('copyright')) : ?>
		<footer id="rt-footer-surround">
			<!-- lorem1 -->
			<?php /** Begin Footer **/ if ($gantry->countModules('footer')) : ?>

			<div id="rt-footer">
				<div class="rt-container">
					<?php echo $gantry->displayModules('footer','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<?php /** End Footer **/ endif; ?>
			<!-- lorem2 -->
			<?php /** Begin Copyright **/ if ($gantry->countModules('copyright')) : ?>
			<div id="rt-copyright">
				<div class="rt-container">
					<?php echo $gantry->displayModules('copyright','standard','standard'); ?>
					<div class="clear"></div>
				</div>
			</div>
			<!-- lorem3 -->
			<?php /** End Copyright **/ endif; ?>
		</footer>
		<?php /** End Footer Surround **/ endif; ?>
		<?php /** Begin Debug **/ if ($gantry->countModules('debug')) : ?>
		<div id="rt-debug">
			<div class="rt-container">
				<?php echo $gantry->displayModules('debug','standard','standard'); ?>
				<div class="clear"></div>
			</div>
		</div>
		<?php /** End Debug **/ endif; ?>
		<?php /** Begin Popups **/
		echo $gantry->displayModules('popup','popup','popup');
		echo $gantry->displayModules('login','login','popup');
	/** End Popup s**/ ?>
		<?php /** Begin Analytics **/ if ($gantry->countModules('analytics')) : ?>
		<?php echo $gantry->displayModules('analytics','basic','basic'); ?>
		<?php /** End Analytics **/ endif; ?>
	</div>
<? $postId=JRequest::getInt('id');
if (!($idPosts == '891' || $postId == 893) ) {?>
	<div class="study-page">
		<div class="modal fade" id="customModal" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true"
			tabindex="-1">
			<div class="modal-dialog modal-dialog-centered" role="document">
				<div class="modal-content">
					<div class="modal-body"><button type="button" class="close" data-dismiss="modal"
							aria-label="Close"><span aria-hidden="true">×</span></button>
						<h5 class="modal-title" id="exampleModalLabel">Получить видеоуроки по трейдингу на почту</h5>
						<form method="post" data-id="main-form"><input type="hidden" name="formParams[setted_offer_id]">
							<div class="form-group">
								<p>Ваше имя</p><input type="text" maxlength="60" pattern="^[A-Za-zА-Яа-яЁёІіЇїЄє\s]+$"
									required="" class="form-control" placeholder="Введите ваше имя"
									name="formParams[full_name]" value="">
							</div>
							<div class="form-group form-email">
								<p>Email</p><input type="email" maxlength="60" class="form-control"
									placeholder="Введите ваш эл. адрес" name="formParams[email]" value="">
							</div>
							<div class="form-group form-phone">
								<p>Телефон</p><input type="tel" maxlength="60" class="form-control"
									placeholder="Введите ваш телефон" name="formParams[phone]" value="" minlength="11">
							</div><input name="formParams[userCustomFields][33656]" data-comment-import=""
								type="hidden"> <input name="formParams[userCustomFields][157562]" data-id="client-id"
								type="hidden" value=""> <button class="btn-simple" type="submit">Получить
								материалы</button> <input type="hidden" name="__gc__internal__form__helper"
								class="__gc__internal__form__helper" value=""> <input type="hidden" name="requestTime"
								value="1559243956"> <input type="hidden" name="requestSimpleSign"
								value="6eb4f7d8f792f437ff713ee4aa4da0b1">
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
<?}?>



<a class="top-link hide" href="" id="js-top">
  <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 12 6"><path d="M12 6H0l6-6z"/></svg>
  <span class="screen-reader-text">Back to top</span>
</a>

	<script src="templates/rt_chapelco/js/custom.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script src="templates/rt_chapelco/js/jquery.min.js"></script>
	<script src="templates/rt_chapelco/js/bootstrap.min.js"></script>
	<script src="/build/js/main.js"></script>
	<script src="templates/rt_chapelco/js/jsshare.js"></script>

	<script>
		document.addEventListener("DOMContentLoaded", function (event) {
			var shareItems = document.querySelectorAll('.share-item');
			for (var i = 0; i < shareItems.length; i += 1) {
				shareItems[i].addEventListener('click', function share(e) {
					console.log(this);
					return JSShare.go(this);
				});
			}
		});
	</script>

	<script>
		jQuery(document).ready(function ($) {
			if (!Cookies.get('online-intensive')) {
				var isMobile = window.matchMedia("only screen and (min-width: 767px)").matches;
				if (isMobile) {
					setTimeout(function () {
						jQuery('#online-intensive').modal('show');
						jQuery('#online-intensive').click(function () { jQuery('#free_registration').modal('hide') });
						Cookies.set('online-intensive', true, { expires: 1 });
					}, 25000);
				}
			}
			// if (!Cookies.get('webinar-stat')) {
			// 	var isMobile = window.matchMedia("only screen and (min-width: 767px)").matches;
			// 	if (isMobile) {
			// 		setTimeout(function () {
			// 			jQuery('#webinar-stat').modal('show');
			// 			jQuery('#webinar-stat').click(function () { jQuery('#webinar-stat').modal('hide') });
			// 			Cookies.set('webinar-stat', true, { expires: 1 });
			// 		}, 20000);
			// 	}
			// }
			var input = document.querySelectorAll('input');

			input.forEach(element => {

				if (element.getAttribute('name') == 'formParams[full_name]' || element.getAttribute('name') == 'name') {
					element.setAttribute('pattern', '^[A-Za-zА-Яа-яЁёІіЇїЄє\s]+$');
					element.setAttribute('required', 'required');
				}
			});

		});
		function stopVideoPlay(){
    		$("iframe").each(function() {
		   		$(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
		    });
	    }

	</script>
	<script>
		$(document).on('click', '#videoTekaBtn', function() {
		    var $video = $('#videoTekaIframe'),
		        src = $video.attr('src');

		    $video.attr('src', src + '&autoplay=1');
		});
	</script>
	</div>
</body>
</html>
<?php
$gantry->finalize();
?>