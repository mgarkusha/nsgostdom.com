<?php if (!defined('SCRIPTACCESS')) exit;

$f='name';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
//$$f->rule=array('ne'=>'Поле <b>Название</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='key';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
//$$f->rule=array('ne'=>'Поле <b>Папка</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='value';
$$f=new ptextarea();
$$f->name=$f;
$$f->inner='class=textareainput style="width:100%; height:100;"';
$e1->fields[]=&$$f;	

$f='pos';
$$f=new phidden();
$$f->name=$f;
$e1->fields[]=&$$f;

$t1->fields=$e1->fields;
