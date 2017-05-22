<?php if (!defined('SCRIPTACCESS')) exit;

$f = 'userid';
$$f=new pparent();
$$f->name=$f;
$$f->key='id';
$$f->value='name';
$$f->inner='class=f_select';
$$f->sql="SELECT * FROM ".TBL."cms_user ORDER BY pos";
$$f->default=vars($f1_->name);
$e1->fields[]=&$$f;

$f='name';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
$$f->rule=array('ne'=>'Поле <b>Название модуля</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f = 'read';
$$f=new pcheckbox();
$$f->name=$f;
$e1->fields[]=&$$f;

$f = 'write';
$$f=new pcheckbox();
$$f->name=$f;
$e1->fields[]=&$$f;

$f='pos';
$$f=new phidden();
$$f->name=$f;
$e1->fields[]=&$$f;

$t1->fields=$e1->fields;

