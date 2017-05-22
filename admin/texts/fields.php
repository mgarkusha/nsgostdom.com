<?php if (!defined('SCRIPTACCESS')) exit;

$f1=new ptext();
$f1->name='name';
$f1->inner=' class=textinput size=60 maxlength=128 ';
$f1->rule=array('ne'=>'Поле <b>название страницы</b> не должно быть пустым');
$e1->fields[]=&$f1;

$f2=new mce_();
$f2->name='text';
$f2->width="100%";
$f2->height=500;
$f2->rule=array('ne'=>'Поле <b>текст страницы</b> не должно быть пустым');
$f2->toolbar='Default';
$e1->fields[]=&$f2;

$f3=new phidden();
$f3->name='pos';
$e1->fields[]=&$f3;

$t1->fields=$e1->fields;
