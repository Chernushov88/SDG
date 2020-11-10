<?php


$cache_file = "h.cache";
if($_SERVER["REQUEST_URI"] == "/")
{
	if (file_exists($cache_file) && (filemtime($cache_file) > (time() - 60 * 10 ))) {
	   echo file_get_contents($cache_file);
	} else {
	   $file = file_get_contents("https://sdg-trade.com/?cache");
	   file_put_contents($cache_file, $file, LOCK_EX);
	   echo $file;
	}
	die;
}



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
	?>
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

		<link href="https://s.tradingview.com/widgetembed/?symbol=NASDAQ%3AAAPL&interval=60&symboledit=1&saveimage=0&toolbarbg=f1f3f6&studies=&hideideas=1&theme=white&style=1&timezone=Etc%2FUTC&showpopupbutton=1&studies_overrides=%7B%7D&overrides=%7B%7D&enabled_features=%5B%5D&disabled_features=%5B%5D&showpopupbutton=1&locale=ru&utm_source=web-arhive.ru&utm_medium=widget&utm_campaign=chart&utm_term=NASDAQ%3AAAPL" rel="preload" as="document">
		<link href="https://www.googletagmanager.com/ns.html?id=GTM-PS2B68K" rel="preload" as="document">
		<link href="/img/home-img.png" rel="preload" as="image">
		<link href="/templates/rt_chapelco/images/light/abstract.jpg" rel="preload" as="image">
		<link href="/images/banners/logo.png" rel="preload" as="image">
		<link href="/images/check.png" rel="preload" as="image">
		<link href="/images/sdg-study-box-sdg-strategy.png" rel="preload" as="image">
		<link href="/images/trans365.png" rel="preload" as="image">
		<link href="/images/sdg-base-box.png" rel="preload" as="image">
		<link href="/images/sdg-stil-box-tamplate.png" rel="preload" as="image">
		<link href="/images/swing.png" rel="preload" as="image">
		<link href="/images/supermono.png" rel="preload" as="image">
		<link href="/templates/rt_chapelco/roksprocket/layouts/tabs/themes/default/tabs.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/css-compiled/master-41d7e74dc0cf9f2f48df3b0edb5a046e.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/css-compiled/master-41d7e74dc0cf9f2f48df3b0edb5a046e.css" rel="preload" as="style">
		<link href="/media/modals/css/bootstrap.min.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/css-compiled/menu-6ae96083a3cbe161d1663a8abe572bdc.css" rel="preload" as="style">
		<link href="/libraries/gantry/css/grid-responsive.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/css-compiled/mediaqueries.css" rel="preload" as="style">
		<link href="/media/system/js/mootools-core.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/libraries/gantry/assets/jui/fonts/fontawesome-webfont.ttf?v=3.2.1" rel="preload" as="font" crossorigin="anonymous">
		<link href="/libraries/gantry/assets/jui/fonts/fontawesome-webfont.woff?v=3.2.1" rel="preload" as="font" crossorigin="anonymous">
		<link href="/templates/rt_chapelco/fonts/Roboto/Robotoblack.woff" rel="preload" as="font" crossorigin="anonymous">
		<link href="/templates/rt_chapelco/fonts/Roboto/Robotobold.woff" rel="preload" as="font" crossorigin="anonymous">
		<link href="/templates/rt_chapelco/fonts/Roboto/Robotomedium.woff" rel="preload" as="font" crossorigin="anonymous">
		<link href="/templates/rt_chapelco/fonts/Roboto/Robotolight.woff" rel="preload" as="font" crossorigin="anonymous">
		<link href="/templates/rt_chapelco/fonts/Roboto/Roboto.woff" rel="preload" as="font" crossorigin="anonymous">
		
		<link href="/modules/mod_xpertcontents/assets/css/xpertcontents.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/roksprocket/layouts/mosaic/themes/default/mosaic.css" rel="preload" as="style">
		<link href="/media/nextend/combined/4d1bb92edb34d350df77acbc39429dce.css" rel="preload" as="style">
		<link href="/media/nextend/combined/4d1bb92edb34d350df77acbc39429dce.css" rel="preload" as="style">
		<link href="/modules/mod_xpertcontents/assets/css/xpertcontents.css" rel="preload" as="style">
		<link href="/templates/rt_chapelco/roksprocket/layouts/mosaic/themes/default/mosaic.css" rel="preload" as="style">
		<link href="/media/system/js/core.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/mootools-mobile.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/roksprocket.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/tabs/themes/default/tabs.js" rel="preload" as="script">
		<link href="/media/jui/js/jquery.min.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/jui/js/jquery-noconflict.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/jui/js/jquery-migrate.min.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/modals/js/jquery.touchSwipe.min.js" rel="preload" as="script">
		<link href="/media/modals/js/jquery.colorbox-min.js" rel="preload" as="script">
		<link href="/media/modals/js/script.min.js?v=9.8.2.p" rel="preload" as="script">
		<link href="https://s.tradingview.com/static/bundles/embed/embed_advanced_chart_widget.15c016a8b9f14bddc7b8.js" rel="preload" as="script">
		<link href="https://www.google-analytics.com/analytics.js" rel="preload" as="script">
		<link href="/media/system/js/mootools-more.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/libraries/gantry/js/browser-engines.js" rel="preload" as="script">
		<link href="/templates/rt_chapelco/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/modules/mod_roknavmenu/themes/default/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/modules/mod_roknavmenu/themes/default/js/responsive.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/moofx.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/roksprocket.request.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/mosaic/assets/js/mosaic.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/mosaic/themes/default/mosaic.js" rel="preload" as="script">
		<link href="/media/system/js/core.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/mootools-mobile.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/roksprocket.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/tabs/themes/default/tabs.js" rel="preload" as="script">
		<link href="/media/jui/js/jquery.min.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/jui/js/jquery-noconflict.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/jui/js/jquery-migrate.min.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/media/modals/js/jquery.touchSwipe.min.js" rel="preload" as="script">
		<link href="/media/modals/js/jquery.colorbox-min.js" rel="preload" as="script">
		<link href="/media/modals/js/script.min.js?v=9.8.2.p" rel="preload" as="script">
		<link href="/media/system/js/mootools-more.js?03165ba8d1d90a6c511a88ec2f68fa02" rel="preload" as="script">
		<link href="/libraries/gantry/js/browser-engines.js" rel="preload" as="script">
		<link href="/templates/rt_chapelco/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/modules/mod_roknavmenu/themes/default/js/rokmediaqueries.js" rel="preload" as="script">
		<link href="/modules/mod_roknavmenu/themes/default/js/responsive.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/moofx.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/assets/js/roksprocket.request.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/mosaic/assets/js/mosaic.js" rel="preload" as="script">
		<link href="/components/com_roksprocket/layouts/mosaic/themes/default/mosaic.js" rel="preload" as="script">

		
		<?php
			unset($this->_metaTags['name']['keywords']);
	        $gantry->displayHead();

			$gantry->addStyle('grid-responsive.css', 5);

	        $gantry->addLess('global.less', 'master.css', 8, array('main-accent'=>$gantry->get('main-accent','#519bda'), 'main-accent2'=>$gantry->get('main-accent2', '#e7714d'), 'main-body'=>$gantry->get('main-body', 'light'), 'main-showcasebg'=>$gantry->get('main-showcasebg', 'abstract')));

			/*
	        if ($gantry->browser->name == 'ie'){
	        	if ($gantry->browser->shortversion == 9){
	        		$gantry->addInlineScript("if (typeof RokMediaQueries !== 'undefined') window.addEvent('domready', function(){ RokMediaQueries._fireEvent(RokMediaQueries.getQuery()); });");
	        	}
				if ($gantry->browser->shortversion == 8){
					$gantry->addScript('html5shim.js');
				}
			}
			*/
			
			if ($gantry->get('layout-mode', 'responsive') == 'responsive') $gantry->addScript('rokmediaqueries.js');
			if ($gantry->get('loadtransition')) {
			$gantry->addScript('load-transition.js');
			$hidden = ' class="rt-hidden"';}

				?>
	<!-- Google Tag Manager -->
	<script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
	new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
	j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
	'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
	})(window,document,'script','dataLayer','GTM-PS2B68K');</script>
	<!-- End Google Tag Manager --> 
</head>

<body <?php echo $gantry->displayBodyTag(); ?>  id="body_<?= JRequest::getInt('id')?>">
<!-- Google Tag Manager (noscript) -->
<noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-PS2B68K"
height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
<!-- End Google Tag Manager (noscript) -->
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
<div  class="<?=$ClassNewStyle . $IDmenu;?>" data-menu="<?= $menu;?>">

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
   //echo ' <div class="hidden">' . $menu . '</div>';
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

<!-- header scripts start-->
		<script src="/build/js/modernizr-custom.js"></script>
		<link href="templates/rt_chapelco/fonts/Roboto/roboto.css" rel="stylesheet">
		<link href="templates/rt_chapelco/css/mystyle_v1.8.css" rel="stylesheet">

		<link href="templates/rt_chapelco/css/bootstrap.min.css" rel="stylesheet">
		<link rel="stylesheet" href="./build/css/style.min.css">
		<link href="templates/rt_chapelco/css/new_style_v1.5.css" rel="stylesheet">
		<script>
			dataLayer = [];
		</script>

	
	<script src="//cdn.sendpulse.com/js/push/d1ce0b0494694053f34cc3c7d9073c9a_1.js" async></script>
	<?php include 'shemas.php' ?>
	<?php $this->setGenerator(''); ?>
<!-- header scripts stop-->
	<script defer src="templates/rt_chapelco/js/custom.js"></script>
	<script defer src="https://cdn.jsdelivr.net/npm/js-cookie@2/src/js.cookie.min.js"></script>
	<script defer src="templates/rt_chapelco/js/jquery.min.js"></script>
	<script defer src="templates/rt_chapelco/js/bootstrap.min.js"></script>
	<script defer src="/build/js/main.js"></script>
	<script defer src="templates/rt_chapelco/js/jsshare.js"></script>

	<script>
		//document.addEventListener("DOMContentLoaded", function (event) {
			var shareItems = document.querySelectorAll('.share-item');
			for (var i = 0; i < shareItems.length; i += 1) {
				shareItems[i].addEventListener('click', function share(e) {
					console.log(this);
					return JSShare.go(this);
				});
			}
		//});
	</script>

	<script>
		//jQuery(document).ready(function ($) {
			/*if (!Cookies.get('online-intensive')) {
				var isMobile = window.matchMedia("only screen and (min-width: 767px)").matches;
				if (isMobile) {
					setTimeout(function () {
						jQuery('#online-intensive').modal('show');
						jQuery('#online-intensive').click(function () { jQuery('#free_registration').modal('hide') });
						Cookies.set('online-intensive', true, { expires: 1 });
					}, 25000);
				}
			}*/
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
            console.log(input);
			input.forEach(element => {

				if (element.getAttribute('name') == 'formParams[full_name]' || element.getAttribute('name') == 'name') {
					element.setAttribute('pattern', '^[A-Za-zА-Яа-яЁёІіЇїЄє\s]+$');
					element.setAttribute('required', 'required');
				}
			});

		//});
		/*function stopVideoPlay(){
    		$("iframe").each(function() {
		   		$(this)[0].contentWindow.postMessage('{"event":"command","func":"pauseVideo","args":""}', '*')
		    });
	    }*/

	</script>
	</div>

<?/*
	<div class="hidden">
        <div class="button-menu" style="text-align: right;"><span class="icon-desktop"> Личный кабинет: </span> <a class="sppb-btn  sppb-btn-success sppb-btn-rounded sppb-btn-gradient" href="free-online-education">Регистрация</a> <a class="sppb-btn  sppb-btn-primary sppb-btn-rounded" href="https://sdg-trade.info/cms/system/login" target="_blank" rel="noopener noreferrer">Вход</a></div>
		<form action="/?task=user.login" method="post" class="form-validate form-horizontal well">
			<fieldset>

			<div class="control-group">
			<div class="control-label">
			<label id="username-lbl" for="username" class="required">
			Логин<span class="star">&nbsp;*</span></label>
			</div>
			<div class="controls">
			<input type="text" name="username" id="username" value="" class="validate-username required" size="25" required="required" aria-required="true" autofocus="" aria-invalid="false">
			</div>
			</div>

			<div class="control-group">
			<div class="control-label">
			<label id="password-lbl" for="password" class="required">
			Пароль<span class="star">&nbsp;*</span></label>
			</div>
			<div class="controls">
			<input type="password" name="password" id="password" value="" class="validate-password required" size="25" maxlength="99" required="required" aria-required="true" aria-invalid="false">	</div>
			</div>
			<div class="control-group">
			<div class="control-label">
			<label for="remember">
			Запомнить меня						</label>
			</div>
			<div class="controls">
			<input id="remember" type="checkbox" name="remember" class="inputbox" value="yes">
			</div>
			</div>
			<div class="control-group">
			<div class="controls">
			<button type="submit" class="btn btn-primary">
			Войти					</button>
			</div>
			</div>
			<input type="hidden" name="return" value="">
			<input type="hidden" name="50c55faa9f6faafeb6b64ca6394d2c0f" value="1">		</fieldset>
		</form>
	</div>
*/?>

<script>
				(function (d, s, id) {
					var js, fjs = d.getElementsByTagName(s)[0];
					if (d.getElementById(id)) return;
					js = d.createElement(s);
					js.id = id;
					js.async = true;
					js.src = "//connect.facebook.net/ru_RU/sdk.js#xfbml=1&version=v2.5";
					fjs.parentNode.insertBefore(js, fjs);
				}(document, 'script', 'facebook-jssdk'));
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

</body>
</html>
<?php
$gantry->finalize();
?>