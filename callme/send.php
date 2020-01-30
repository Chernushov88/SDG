<?php

$recepient = "sales@sdg-trade.com";
$pagetitle = "Вопрос с callback формы sdg-trade.com";

$name1 = isset($_POST['name1']) ? trim($_POST['name1']) : '';
$email1 = isset($_POST['email1']) ? trim($_POST['email1']) : '';
$text1 = isset($_POST['text1']) ? trim($_POST['text1']) : '';

$message = "
	‼ $pagetitle ‼<br><br>
	👤 Имя: $name1 <br>
	📝 Email: $email1 <br>
    <br>
    Мой вопрос:<br>
    $text1
	";

$headers = 'MIME-Version: 1.0' . "\r\n";
$headers .= 'Content-type: text/html; charset=urf-8' . "\r\n";
$headers .= 'From: callback@sdg-trade.com';
mail($recepient, $pagetitle, $message, $headers);
echo "Благодарим за запрос!"; // success message


?>