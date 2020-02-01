<?php

$to = "info@sdg-trade.com"; // this is the sender's Email address
$subject = "feedback";
$message = "У вас новый отзыв:" . "\n\n" . $_POST['message'];
// Для отправки HTML-письма должен быть установлен заголовок Content-type
$headers  = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=urf-8' . "\r\n";

// Дополнительные заголовки
$headers .= 'From: sdg-trade.com';
mail($to,$subject,$message,$headers);


?>