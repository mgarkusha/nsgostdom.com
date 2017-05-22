<?php
session_start();
define('SCRIPTACCESS', true);
chdir($_SERVER['DOCUMENT_ROOT'].'/');
include 'kernel/main/conf.php';

$fio = mysql_real_escape_string($_POST['fio']);
$email = mysql_real_escape_string($_POST['email']);
$phone_number = mysql_real_escape_string($_POST['phone_number']);
$dateIn = mysql_real_escape_string($_POST['dateIn']);
$dateOut = mysql_real_escape_string($_POST['dateOut']);
$id_room = mysql_real_escape_string($_POST['id_room']);
$persons = mysql_real_escape_string($_POST['persons']);
$kids = mysql_real_escape_string($_POST['kids']);

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
        'text' => '<strong>Поле Tелефон</strong> не заполнено!',
    )));
}

if(!$dateIn){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Укажите дату заезда!</strong>',
    )));
}

if(!$dateOut){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Укажите дату выезда!</strong>',
    )));
}

if(!$id_room){
    die(json_encode(array(
        'status' => 2,
        'text' => '<strong>Комната не выбрана!</strong>',
    )));
}



$db = mysql::query("INSERT INTO `#booking`(`fio`,`email`,`phone_number`,`dateIn`,`dateOut`,`id_room`,`persons`,`kids`) VALUES('$fio','$email','$phone_number','$dateIn','$dateOut','$id_room','$persons','$kids')");

if($db){
    die(json_encode(array(
        'status' => 1,
        'text' => 'Ваш вопрос отправлен!',
    )));
}
die(json_encode(array(
    'status' => 2,
    'text' => 'что то пошло не так!'.mysql_error(),
)));

