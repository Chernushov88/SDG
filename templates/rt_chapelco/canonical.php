	<?



$postId = JRequest::getInt('id');
// echo $postId;
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
<?} elseif ($postId == 37){?>

<?} else {
	$href = $_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'];
	$newHref = strtok($href, '?');
	?>
    <link rel="canonical" href="<?= 'https://'.$newHref ?>">
<?}?>



