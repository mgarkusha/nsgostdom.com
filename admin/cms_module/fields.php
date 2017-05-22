<?php if (!defined('SCRIPTACCESS')) exit;

$f='name';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
//$$f->rule=array('ne'=>'Поле <b>Название</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='path';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
//$$f->rule=array('ne'=>'Поле <b>Папка</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='pos';
$$f=new phidden();
$$f->name=$f;
$e1->fields[]=&$$f;

$f = 'display';
$$f=new pcheckbox();
$$f->name=$f;
$e1->fields[]=&$$f;	

$f = 'sitemapaccess';
$$f=new pcheckbox();
$$f->name=$f;
$e1->fields[]=&$$f;	

$t1->fields=$e1->fields;
