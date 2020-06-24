<?php

  define('ADMIN', 'info@sdg-trade.com');
  define('COMPANY', 'SDG Trade');
  
  include 'mailsend.php';

  $url = 'http://'.$_SERVER['SERVER_NAME'];

  $name = isset($_POST['name']) ? $_POST['name'] : null;
  $phone = isset($_POST['phone']) ? $_POST['phone'] : null;
  $email = isset($_POST['email']) ? $_POST['email'] : null;
  $msg = isset($_POST['msg']) ? $_POST['msg'] : null;
  $ip = $_SERVER['REMOTE_ADDR'];


  $subject = isset($_POST['subject']) ? $_POST['subject'] : null;

  $messageHtml = '
      <html> 
          <head><title>'.$subject.'</title></head>
      <body>
          <h1>'.$subject.'</h1>';

          // Order table html
          $messageHtml .= '<table>';

          if(isset($name) && $name !== null) { $messageHtml .= '<tr><td width="300">Имя клиента: </td><td>'.$name.'</td></tr>'; }
          if(isset($phone) && $phone !== null) { $messageHtml .= '<tr><td width="300">Телефон клиента: </td><td>'.$phone.'</td></tr>'; }
          if(isset($email) && $email !== null) { $messageHtml .= '<tr><td width="300">E-mail клиента: </td><td>'.$email.'</td></tr>'; }
          if(isset($msg) && $msg !== null) { $messageHtml .= '<tr><td width="300">Сообщение/вопрос от клиента: </td><td>'.$msg.'</td></tr>'; }
		  $messageHtml .= '<tr><td width="300">IP: </td><td>'.$ip.'</td></tr>';
          $messageHtml .= '<tr><td width="300">Дата заявки:</td><td>'.date('d.m.Y H:i').'</td></tr>';
	
          $messageHtml .= '</table>';
		  
		

		  
          // End order table html

          //$messageHtml .= '<p>Вы получили это письмо, так как на сайте <a href="'.$url.'" target="_blank">'.$url.'</a> была оформлена заявка на электронный адрес <a href="mailto:'.$email.'">'.$email.'</a>. Если это произошло по ошибке или без вашего участия, просто проигнорируйте это письмо.</p>';

          $messageHtml .= '</body></html>';

  $emailAddr = ADMIN;

  $mail = new Mail(ADMIN); // Создаём экземпляр класса
  $mail->setFromName(COMPANY); // Устанавливаем имя в обратном адресе

  $answer = array(
      'status' => $mail->send($emailAddr, $subject, $messageHtml)
  );

  echo json_encode($answer);

?>