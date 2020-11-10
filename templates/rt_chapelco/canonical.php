	<?

$url = $_SERVER['REQUEST_URI'];
 ///kak-stat-klientom
$urlStr = 'kak-stat-klientom';

$urlRepeat = 'http';

$postId = JRequest::getInt('id');
//echo $postId;
if ($postId == 287 || $postId == 280 || $postId == 253 || $postId == 292 || $postId == 243) {
	# code...
}elseif ($postId == 873){?>
	<link rel="canonical" href="https://sdg-trade.com/individualnyi-kouching">
<?}  elseif ($postId == 6){?>
	<link rel="canonical" href="https://sdg-trade.com">
<?}  elseif ($postId == 9){?>
	<link rel="canonical" href="https://sdg-trade.com">
<?}  elseif ($postId == 8){?>
	<link rel="canonical" href="https://sdg-trade.com">
<?} elseif ($postId == 12){?>
	<link rel="canonical" href="https://sdg-trade.com/obuchenie">
<?} elseif ($postId == 199){?>
	<link rel="canonical" href="https://sdg-trade.com/market">

<?} elseif ( stristr($url, $urlStr) ){?>
<link rel="canonical" href="https://sdg-trade.com/kak-stat-klientom">
<?} elseif ($postId === 891){?>
<link href="/templates/rt_chapelco/fonts/font-awesome-4.7.0/css/font-awesome.min.css" rel="stylesheet">

<?} elseif ($postId == 37){?>

<?} else {
	$href = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$newHref = strtok($href, '?');
	?>
    <link rel="canonical" href="<?= 'https://'.$newHref ?>">
<?}?>


<?

$currentMenuId = JSite::getMenu()->getActive()->id;
$urlArray = explode("/", $url);


function array_has_dupes($array) {
   if( count($array) !== count(array_unique($array)) ){
   //"<script type='text/javascript'> document.location.href = 'https://sdg-trade.com/404'; </script>";
	header('HTTP/1.1 301 Moved Permanently');
	header('Location: /404');        // 404 - alias
	exit;
   }
}



if( $currentMenuId == 294 || $currentMenuId == 203 ){
	array_has_dupes($urlArray);
}

?>