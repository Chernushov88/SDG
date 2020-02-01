<?php 
/* 	
If you see this text in your browser, PHP is not configured correctly on this hosting provider. 
Contact your hosting provider regarding PHP configuration for your site.

PHP file generated by Adobe Muse CC 2015.1.1.343
*/

require_once('form_process.php');

$form = array(
	'subject' => 'Отправка Форма Психология стандарт',
	'heading' => 'Отправка новой формы',
	'success_redirect' => 'ok.html',
	'resources' => array(
		'checkbox_checked' => 'Отмечено',
		'checkbox_unchecked' => 'Флажок не установлен',
		'submitted_from' => 'Формы, отправленные с веб-сайта: %s',
		'submitted_by' => 'IP-адрес посетителя: %s',
		'too_many_submissions' => 'Недопустимо высокое количество отправок с этого IP-адреса за последнее время',
		'failed_to_send_email' => 'Не удалось отправить сообщение эл. почты',
		'invalid_reCAPTCHA_private_key' => 'Недействительный закрытый ключ reCAPTCHA.',
		'invalid_field_type' => 'Неизвестный тип поля \'%s\'.',
		'invalid_form_config' => 'Недопустимая конфигурация поля \"%s\".',
		'unknown_method' => 'Неизвестный метод запроса сервера'
	),
	'email' => array(
		'from' => 'info@sdg-trade.com',
		'to' => 'info@sdg-trade.com'
	),
	'fields' => array(
		'custom_U735' => array(
			'order' => 1,
			'type' => 'string',
			'label' => 'Пользовательский текст:',
			'required' => true,
			'errors' => array(
				'required' => 'Поле \'Пользовательский текст:\' не может быть пустым.'
			)
		),
		'Email' => array(
			'order' => 2,
			'type' => 'email',
			'label' => 'Пользовательский текст:',
			'required' => true,
			'errors' => array(
				'required' => 'Поле \'Пользовательский текст:\' не может быть пустым.',
				'format' => 'Поле \'Пользовательский текст:\' содержит недействительное сообщение эл. почты.'
			)
		),
		'custom_U742' => array(
			'order' => 3,
			'type' => 'string',
			'label' => 'Пользовательский текст:',
			'required' => true,
			'errors' => array(
				'required' => 'Поле \'Пользовательский текст:\' не может быть пустым.'
			)
		)
	)
);

process_form($form);
?>
