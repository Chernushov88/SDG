<?php
$fio = $_POST['fio'];
$email = $_POST['email'];
$tell = $_POST['tell'];
$fio = htmlspecialchars($fio);
$email = htmlspecialchars($email);
$tell = htmlspecialchars($tell);
$fio = urldecode($fio);
$email = urldecode($email);
$tell = urldecode($tell);
$fio = trim($fio);
$email = trim($email);
$fio = trim($fio);


if (mail("info@sdg-trade.com", "Заявка на курс Swing - пакет Cтандарт", "Телефон:".$tell.". ФИО:".$fio.". E-mail: ".$email ,"From: info@sdg-trade.com \r\n"))
 {    // echo "Cообщение успешно отправлено";
	   //header('Location: https://sdg-trade.com/lp/swing/success.html');
	   echo '<script>location.replace("https://sdg-trade.com/lp/swing/success.html");</script>';
	   exit;
} else {
    echo "при отправке сообщения возникли ошибки";
}?>