<?php
 defined('_JEXEC') or die;
if (($this->error->getCode()) == '404') {
#	https://sdg-trade.com/index.php?option=com_content&view=article&id=904
#header('Location: /index.php?option=com_content&view=article&id=549');
header('HTTP/1.0 404 Not Found');
	$errorPageContent = file_get_contents('https://sdg-trade.com/index.php?option=com_content&view=article&id=904');
	echo $errorPageContent;
	exit;
#header("HTTP/1.1 404 Not Found");
#echo file_get_contents(JURI::root().'error-404');
#exit;
}

#if (($this->error->getCode()) == '404') {
#   header('HTTP/1.0 404 Not Found');
#    $ch = curl_init( JURI::root() . '/');
#    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
#    echo curl_exec($ch);
#exit;
#}
?>