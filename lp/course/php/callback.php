<?php

  define('ADMIN', 'info@sdg-trade.com');
  define('COMPANY', 'SDG Trade');
  
  include 'mailsend.php';

  $url = 'http://'.$_SERVER['SERVER_NAME'];

  $name = $_POST['name'];
  $phone = $_POST['phone'];
  $email = $_POST['email'];

  $subject = $_POST['subject'];

  $messageHtml = '
      <html> 
          <head><title>'.$subject.'</title></head>
      <body>
          <h1>'.$subject.'</h1>';

          // Order table html
          $messageHtml .= '<table>';

          if(isset($name) && $name !== '') { $messageHtml .= '<tr><td width="300">Имя клиента: </td><td>'.$name.'</td></tr>'; }
          if(isset($phone) && $phone !== '') { $messageHtml .= '<tr><td width="300">Телефон клиента: </td><td>'.$phone.'</td></tr>'; }
          if(isset($email) && $email !== '') { $messageHtml .= '<tr><td width="300">E-mail клиента: </td><td>'.$email.'</td></tr>'; }
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