<?php
 defined('_JEXEC') or die;
if (($this->error->getCode()) == '404') {
    header('HTTP/1.0 404 Not Found');
    $ch = curl_init( JURI::root() . '/404');
    curl_setopt($ch, CURLOPT_RETURNTRANSFER, TRUE);
    echo curl_exec($ch);
exit;
}