<?php

    //print_r($_POST);

$url = $_POST['action'];
$params = "name=".$_POST['name']."&email=".$_POST['email']."&webform_id=".$_POST['webform_id'];
$user_agent = "Mozilla/5.0 (compatible; MSIE 5.01; Windows NT 5.0)";
$ch = curl_init();
curl_setopt($ch, CURLOPT_POST, 1);
curl_setopt($ch, CURLOPT_POSTFIELDS, $params);
curl_setopt($ch, CURLOPT_URL, $url);
curl_setopt($ch, CURLOPT_USERAGENT, $user_agent);
curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
curl_setopt($ch, CURLOPT_HTTPHEADER, array('Expect:'));

$result=curl_exec ($ch);
curl_close ($ch);

echo $result;

?>