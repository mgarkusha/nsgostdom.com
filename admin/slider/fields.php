<?
        $f='pic';
        $$f=new picture4();
        $$f->name=$f;
	$$f->BigMaxWidth        = 11300;//*.jpg
	$$f->BigMaxHeight       = 6530;//*.jpg
	$$f->SmallMaxWidth      = 200;//*small.jpg
	$$f->SmallMaxHeight     = 200;//*small.jpg
        $$f->previewLongSide	= 960;
	$$f->previewShortSide	= 400;
	$$f->table = $t1->name;
	$$f->max_size = 8000000;
	$$f->inner = '';
	$$f->path = 'images/slider/';
	$e1->fields[] = &$$f;
	$$f->rempic ();

        $f='url';
  $$f=new ptext();
  $$f->name=$f;
  $$f->MySQLType='varchar(128)';
  $$f->inner=' class=textinput size=60 maxlength=128 ';
  //$$f->rule=array('ne'=>'Поле <b>название страницы</b> не должно быть пустым');
  $e1->fields[]=&$$f;

        $f2s=new mce_();
        $f2s->name='text';
        //$f2->rule=array('ne'=>'Поле <b>Текст</b> не должно быть пустым');
        $f2s->toolbar='Default';
        $e1->fields[]=&$f2s;

	$f2='display';
	$$f2=new pcheckbox();
	$$f2->name=$f2;
	$$f2->set_default_checked();
	$e1->fields[]=&$$f2;

	$f3=new phidden();
	$f3->name='pos';
	$e1->fields[]=&$f3;

	$t1->fields=$e1->fields;
?>
