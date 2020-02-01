<?php
$fio1 = $_POST['fio1'];
$email1 = $_POST['email1'];
$tell1 = $_POST['tell1'];
$fio = htmlspecialchars($fio1);
$email = htmlspecialchars($email1);
$tell = htmlspecialchars($tell1);
$fio = urldecode($fio1);
$email = urldecode($email1);
$tell = urldecode($tell1);
$fio = trim($fio1);
$email = trim($email1);
$fio = trim($tell1);
//echo $fio;
//echo "<br>";
//echo $email;
if (mail("info@sdg-trade.com", "Заявка на курс Swing - пакет Премиум", "Телефон:".$tell1.". ФИО:".$fio1.". E-mail: ".$email1 ,"From: info@sdg-trade.com \r\n"))
{    // echo "Cообщение успешно отправлено";
	   //header('Location: https://sdg-trade.com/lp/swing/success.html');
	   echo '<script>location.replace("https://sdg-trade.com/lp/swing/success.html");</script>';
	   exit;
} else {
    echo "при отправке сообщения возникли ошибки";
}?>