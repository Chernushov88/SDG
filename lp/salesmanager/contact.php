<?php
if($_POST)
{
require('constant.php');
    
    $user_name      = filter_var($_POST["name"], FILTER_SANITIZE_STRING);
    $user_email     = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);
    $user_phone     = filter_var($_POST["phone"], FILTER_SANITIZE_STRING);
    $content   = filter_var($_POST["content"], FILTER_SANITIZE_STRING);
    
    if(empty($user_name)) {
		$empty[] = "<b>Имя</b>";		
	}
	if(empty($user_email)) {
		$empty[] = "<b>Email</b>";
	}
	if(empty($user_phone)) {
		$empty[] = "<b>Телефонный номер</b>";
	}	
	
	if(!empty($empty)) {
		$output = json_encode(array('type'=>'error', 'text' => implode(", ",$empty) . ' обезательный для ввода!'));
        die($output);
	}
	
	if(!filter_var($user_email, FILTER_VALIDATE_EMAIL)){ //email validation
	    $output = json_encode(array('type'=>'error', 'text' => '<b>'.$user_email.'</b> Вы ввели не верный email, попробуйте еще раз.'));
		die($output);
	}
	
	//reCAPTCHA validation
	if (isset($_POST['g-recaptcha-response'])) {
		
		require('component/recaptcha/src/autoload.php');		
		
		$recaptcha = new \ReCaptcha\ReCaptcha(SECRET_KEY, new \ReCaptcha\RequestMethod\SocketPost());

		$resp = $recaptcha->verify($_POST['g-recaptcha-response'], $_SERVER['REMOTE_ADDR']);

		  if (!$resp->isSuccess()) {
				$output = json_encode(array('type'=>'error', 'text' => '<b>Captcha</b> обезательна для проверки'));
				die($output);				
		  }	
	}
	
	$toEmail = "sales@sdg-trade.com";
    $content = "
    Имя: $user_name
    Телефоннный номер: $user_phone
    email: $user_email
    Сообщение пользователя: $content";
	$mailHeaders = "From: " . $user_name . "<" . $user_email . ">\r\n";
	if (mail($toEmail, "Резюме с сайта lp/salesmanager", $content, $mailHeaders)) {
	    $output = json_encode(array('type'=>'message', 'text' => 'Спасибо за проявленный интерес '.$user_name .', наш рекрутер обязательно свяжется с вами в ближайшее время.'));
	    die($output);
	} else {
	    $output = json_encode(array('type'=>'error', 'text' => 'Упс, что-то пошло не так, попробуйте еще раз.'.SENDER_EMAIL));
	    die($output);
	}
}
?>
