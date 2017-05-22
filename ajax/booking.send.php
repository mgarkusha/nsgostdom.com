<?php
session_start();
define('SCRIPTACCESS', true);
chdir($_SERVER['DOCUMENT_ROOT'].'/');
include 'kernel/main/conf.php';

$type = mysql_real_escape_string($_POST['type']);
$status = mysql_real_escape_string($_POST['status']);

$id_room = mysql_real_escape_string($_POST['id_room']);
$id_excursions = mysql_real_escape_string($_POST['id_excursions']);
$id_cars = mysql_real_escape_string($_POST['id_cars']);

$fio = mysql_real_escape_string($_POST['fio']);
$email = mysql_real_escape_string($_POST['email']);
$phone_number = mysql_real_escape_string($_POST['phone_number']);
$dateIn = date('Y-m-d',strtotime(mysql_real_escape_string($_POST['dateIn'])));
$dateOut = date('Y-m-d',strtotime(mysql_real_escape_string($_POST['dateOut'])));

$persons = mysql_real_escape_string($_POST['persons']);
$kids = mysql_real_escape_string($_POST['kids']);
$payment = mysql_real_escape_string($_POST['payment']);

if($_SESSION['skey_pwd'] != $_POST['code']){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Код проверки</strong> введен неверно!',
    )));
}

if(!$fio){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Поле ФИО</strong> не заполнено!',
    )));
}

if(!$email){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>E-mail</strong> не заполнен!',
        'tmp' => $_SESSION['skey_pwd'],
    )));
}

if(!preg_match ('/^[a-zA-Z0-9\._-]+@[a-zA-Z0-9\._-]+\.[a-zA-Z]{2,4}$/',$email)){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Некорректный e-mail</strong>!',
    )));
}

if(!$phone_number){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Поле телефон</strong> не заполнено!',
    )));
}

if(!$dateIn){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Укажите дату заезда!</strong>',
    )));
}

/*if(!$dateOut){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Укажите дату выезда!</strong>',
    )));
}*/

/*if(!$id_room){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Комната не выбрана!</strong>',
    )));
}*/

$db = mysql::query("INSERT INTO `#booking`(`posted`,`fio`,`email`,`phone_number`,`dateIn`,`dateOut`,`id_room`,`persons`,`kids`,`types`,`status`,`payment`,`id_excursions`,`id_cars`)
                    VALUES('".date('Y-m-d H:i:s')."','$fio','$email','$phone_number','$dateIn','$dateOut','$id_room','$persons','$kids','$type','$status','$payment', '$id_excursions', '$id_cars')");

if($db){
	//$row = mysql::selectrow("SELECT * FROM `#booking` WHERE `id` = 51");
	$body = 'Поступила новая заявка<br>'.
            '<b>ФИО:</b> '.$fio.' <br>'.
            '<b>E-mail:</b> '.$email.' <br>'.
            '<b>Телефон:</b> '.$phone_number.' <br>';

	if ($type == 'catalog_rooms'){
	$option = mysql::selectrow("SELECT `name` FROM `#catalog_rooms` WHERE `id` = ".$id_room."");
	$body .= '<b>Комната:</b> '.$option['name'].' <br>'.
        '<b>Дата заезда:</b> '.$dateIn.' <br>'.
        '<b>Дата выезда:</b> '.$dateOut.' <br>'.
        '<b>Взрослые:</b> '.$persons.' <br>'.
        '<b>Дети:</b> '.$kids.' <br>'
		;
    }
	else if ($type == 'excursions'){
	$option = mysql::selectrow("SELECT `title` FROM `#excursions` WHERE `id` = ".$id_excursions."");
		$body .= '<b>Кол-во суток:</b> '.$option['title'].' <br>'.
        '<b>Дата заезда:</b> '.$dateIn.' <br>'.
        '<b>Взрослые:</b> '.$persons.' <br>'.
        '<b>Дети:</b> '.$kids.' <br>'
		;
	}
	else if ($type=='cars'){
	$option = mysql::selectrow("SELECT `name` FROM `#cars` WHERE `id` = ".$id_cars."");
		$body .= '<b>Автомобиль:</b> '.$option['name'].' <br>'.
        '<b>Дата заезда:</b> '.$dateIn.' <br>'.
        '<b>Дата выезда:</b> '.$dateOut.' <br>'
		;
	}
	else{
		die(json_encode(array(
			'status' => 2,
			'text' => 'что то пошло не так!',
		)));
	}
	$body .= '<b>Оплата:</b> '.$payment.' <br>';
    $mails = explode(',',cms::setup_value('mail_order'));
    foreach($mails as $mail){
       mail_(
               trim($mail),
               'Новая заявка на сайте http://'.$_SERVER['HTTP_HOST'],
               $body
           );
    }

    die(json_encode(array(
        'status' => 1,
        'text' => 'Ваш запрос отправлен! Ожидайте, пожалуйста, в ближайшее время с Вами свяжется наш менеджер.!',
    )));
}
die(json_encode(array(
    'status' => 2,
    'text' => 'что то пошло не так!'.mysql_error(),
)));

