<?
	$f='posted';
	$$f=new ptext();
	$$f->name=$f;
	$$f->size=60;
	$$f->maxlength=64;
	$$f->inner='class=textinput';
	$$f->rule=array('ne'=>'Поле <b>Дата</b> не заполнено');
	$ff->MySQLType='datetime';
	if(vars($f)=='') setvar($f,date('Y-m-d H:i:s'));
	$e1->fields[]=&$$f;

	$f1=new ptext();
	$f1->name='author';
	$f1->size=60;
	$f1->maxlength=64;
	$f1->inner='class=textinput';
	if(conf::$aside) {
	   $f1->rule=array('ne'=>'<span style="color: red">Поле <b>Ваше имя</b> не заполнено</span>');
	} else {
	   $f1->rule=array('ne'=>'<span style="color: red">Поле <b>Ваше имя</b> не заполнено','cpch'=>'<span style="color: red">Неверный код проверки</span>');
	}
	$e1->fields[]=&$f1;

//	$f='mail';
//	$$f=new ptext();
//	$$f->name=$f;
//	$$f->size=60;
//	$$f->maxlength=64;
//	$$f->inner='class=textinput';
//	$$f->rule=array('email'=>'Неправильный <b>E-mail</b>','ne'=>'Не заполнен E-mail');
//	$e1->fields[]=&$$f;

	$f5=new ptextarea();
	$f5->name='message';
	$f5->cols=80;
	$f5->rows=10;
	$f5->inner='class=textareainput';
	$f5->rule=array('ne'=>'<span style="color: red">Поле <b>Сообщение</b> не заполнено</span>');
	$e1->fields[]=&$f5;

    $f6=new ptextarea();
	$f6->name='otvet';
	$f6->cols=80;
	$f6->rows=10;
	$f6->inner='class=textareainput';
//	$f6->rule=array('ne'=>'Поле <b>Сообщение</b> не заполнено');
	$e1->fields[]=&$f6;

	$f='pic';
	$$f=new picture4();
	$$f->name=$f;
	$$f->BigMaxWidth        = 4000;//*.jpg
	$$f->BigMaxHeight       = 4000;//*.jpg
	$$f->SmallMaxWidth      = 1000;//*small.jpg
	$$f->SmallMaxHeight     = 1000;//*small.jpg
	$$f->previewLongSide	= 600;
	$$f->previewShortSide	= 420;
	$$f->table = $t1->name;
	$$f->max_size = 8000000;
	$$f->inner = '';
	$$f->path = 'images/avatar/';
	$e1->fields[] = &$$f;
	$$f->rempic ();

        $f='ip';
        $$f=new ptext();
        $$f->name=$f;
        $$f->inner='class=textinput';
        if(vars($f)=='' && vars('e')=='n') setvar($f,$_SERVER['REMOTE_ADDR']);
        $e1->fields[]=&$$f;

        $f8=new pcheckbox();
	$f8->name='display';
//	$f8->set_default_checked();
	$e1->fields[]=&$f8;

	$t1->fields=$e1->fields;
?>
