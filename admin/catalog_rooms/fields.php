<?

$f = 'name';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->rule = array('ne' => 'Поле <b>Куда</b> не заполнено');
$$f->MySQLType = 'varchar(255)';
$e1->fields[] = &$$f;

$f = 'price';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'float';
$e1->fields[] = &$$f;

$f = 'area';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'float';
$e1->fields[] = &$$f;

$f = 'number_of_rooms';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'float';
$e1->fields[] = &$$f;

$f = 'id_for_type_room';
$$f = new ptext();
$$f->name = $f;
$$f->inner = 'class=textinput';
$$f->MySQLType = 'float';
$e1->fields[] = &$$f;

$f = 'display';
$$f=new pcheckbox();
$$f->name=$f;
$$f->set_default_checked();
$e1->fields[]=&$$f;

$f = 'additional_space';
$$f=new pcheckbox();
$$f->name=$f;
$$f->set_default_checked();
$e1->fields[]=&$$f;

$f='pic';
$$f=new picture4();
$$f->name=$f;
$$f->BigMaxWidth        = 11300;//*.jpg
$$f->BigMaxHeight       = 6530;//*.jpg
$$f->SmallMaxWidth      = 200;//*small.jpg
$$f->SmallMaxHeight     = 200;//*small.jpg
$$f->previewLongSide	= 400;
$$f->previewShortSide	= 220;
$$f->table = $t1->name;
$$f->max_size = 8000000;
$$f->inner = '';
$$f->path = 'images/rooms/';
$e1->fields[] = &$$f;
$$f->rempic ();

$f='pic1';
$$f=new picture4();
$$f->name=$f;
$$f->BigMaxWidth        = 11300;//*.jpg
$$f->BigMaxHeight       = 6530;//*.jpg
$$f->SmallMaxWidth      = 200;//*small.jpg
$$f->SmallMaxHeight     = 200;//*small.jpg
$$f->previewLongSide	= 400;
$$f->previewShortSide	= 220;
$$f->table = $t1->name;
$$f->max_size = 8000000;
$$f->inner = '';
$$f->path = 'images/rooms/';
$e1->fields[] = &$$f;
$$f->rempic ();

$f='pic2';
$$f=new picture4();
$$f->name=$f;
$$f->BigMaxWidth        = 11300;//*.jpg
$$f->BigMaxHeight       = 6530;//*.jpg
$$f->SmallMaxWidth      = 200;//*small.jpg
$$f->SmallMaxHeight     = 200;//*small.jpg
$$f->previewLongSide	= 400;
$$f->previewShortSide	= 220;
$$f->table = $t1->name;
$$f->max_size = 8000000;
$$f->inner = '';
$$f->path = 'images/rooms/';
$e1->fields[] = &$$f;
$$f->rempic ();

$f='pic3';
$$f=new picture4();
$$f->name=$f;
$$f->BigMaxWidth        = 11300;//*.jpg
$$f->BigMaxHeight       = 6530;//*.jpg
$$f->SmallMaxWidth      = 200;//*small.jpg
$$f->SmallMaxHeight     = 200;//*small.jpg
$$f->previewLongSide	= 400;
$$f->previewShortSide	= 220;
$$f->table = $t1->name;
$$f->max_size = 8000000;
$$f->inner = '';
$$f->path = 'images/rooms/';
$e1->fields[] = &$$f;
$$f->rempic ();

$f='pic4';
$$f=new picture4();
$$f->name=$f;
$$f->BigMaxWidth        = 11300;//*.jpg
$$f->BigMaxHeight       = 6530;//*.jpg
$$f->SmallMaxWidth      = 200;//*small.jpg
$$f->SmallMaxHeight     = 200;//*small.jpg
$$f->previewLongSide	= 400;
$$f->previewShortSide	= 220;
$$f->table = $t1->name;
$$f->max_size = 8000000;
$$f->inner = '';
$$f->path = 'images/rooms/';
$e1->fields[] = &$$f;
$$f->rempic ();

$f = 'text';
$$f=new mce_();
$$f->name=$f;
$$f->width="100%";
$$f->height=370;
//$$f->rule=array('ne'=>'Поле <b>текст страницы</b> не должно быть пустым');
$$f->toolbar='Default';
$e1->fields[]=&$$f;


$f3=new phidden();
$f3->name='pos';
$e1->fields[]=&$f3;

$f='title';
$$f=new ptext();
$$f->name=$f;
$$f->inner=' class=textinput size=60 maxlength=128 id="header" onkeyup="check();"';
$e1->fields[]=&$$f;

$f='keywords';
$$f=new ptext();
$$f->name=$f;
$$f->inner=' class=textinput size=60';
$e1->fields[]=&$$f;

$f4=new ptextarea();
$f4->name='description';
$f4->cols=62;
$f4->rows=10;
$f4->inner='class=textareainput';
//	$f5->rule=array('ne'=>'Поле <b>Сообщение</b> не заполнено');
$e1->fields[]=&$f4;

$t1->fields=$e1->fields;
