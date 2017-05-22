<?php if (!defined('SCRIPTACCESS')) exit;

$f='login';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
$$f->rule=array('ne'=>'Поле <b>Логин</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='name';
$$f=new ptext();
$$f->name=$f;
$$f->inner='class=textinput size=60 maxlength=128';
//$$f->rule=array('ne'=>'Поле <b>Имя</b> не должно быть пустым');
$e1->fields[]=&$$f;

$f='password';
$$f=new ppwd();
$$f->name=$f;
$$f->inner='class=textinput size=32 maxlength=32';
$$f->rule=array(
        'ne'=>'Ошибка! Вы ввели пустой пароль',
        'eq'=>'Пароли не совпадают',
        'eq2'=>'Ошибка! Пожалуйста выберите другой пароль.'
);
$e1->fields[]=&$$f;

$f = 'superadmin';
$$f=new pcheckbox();
$$f->name=$f;
$e1->fields[]=&$$f;

$f='pos';
$$f=new phidden();
$$f->name=$f;
$e1->fields[]=&$$f;

$t1->fields=$e1->fields;
