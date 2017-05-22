<?php if (!defined('SCRIPTACCESS')) exit;

$f = 'posted';
$$f = new ptext();
$$f->name = $f;
$$f->size = 60;
$$f->maxlength = 64;
$$f->inner = 'class=textinput';
$ff->MySQLType = 'datetime';
if (vars($f) == '')
    setvar($f, date('Y-m-d H:i:s'));
$e1->fields[] = &$$f;

$f = 'fio';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'varchar(255)';
$$f->rule = array('ne' => 'Поле <b>ФИО</b> не заполнено');
$e1->fields[] = &$$f;

$f = 'email';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'varchar(255)';
$$f->rule = array('ne' => 'Поле <b>E-mail</b> не заполнено');
$e1->fields[] = &$$f;

$f = 'phone_number';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'varchar(255)';
$$f->rule = array('ne' => 'Поле <b>Телефон</b> не заполнено');
$e1->fields[] = &$$f;

$f = 'dateIn';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'date';
$$f->rule = array('ne' => 'Укажите <b>Дату заезда</b>');
$e1->fields[] = &$$f;

$f = 'dateOut';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'date';
if($type == 'excursions'){
    $$f->rule = array('ne' => 'Укажите <b>Дату выезда</b>');
}
$e1->fields[] = &$$f;

$f = 'id_room';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'id_excursions';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'id_cars';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'persons';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'kids';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'sum';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;



$f = 'amount_days';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'int(11)';
$e1->fields[] = &$$f;

$f = 'types';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'varchar(30)';
$e1->fields[] = &$$f;

$f = 'payment';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'varchar(255)';
$e1->fields[] = &$$f;

$f = 'status';
$$f = new parrayselect();
$$f->name=$f;
$$f->list = conf::$status;
$$f->inner='class=f_select style="width:350px;"';
$$f->MySQLType='int(1)';
$e1->fields[]=&$$f;


$t1->fields=$e1->fields;