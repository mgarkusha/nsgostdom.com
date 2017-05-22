<?php if (!defined('SCRIPTACCESS')) exit;

	$f1=new ptext();
	$f1->name='name';
	$f1->inner=' class=textinput size=60 maxlength=128 ';
	$f1->rule=array('ne'=>'Поле <b>раздел сайта</b> обязательно для заполнения.',
					'ch'=>'Раздел не может быть удален, т.к. содержит подразделы.');
	$e1->fields[]=&$f1;

	$f='header';
	$$f=new ptext();
	$$f->name=$f;
	$$f->inner=' class=textinput size=60 maxlength=128 id="header" onkeyup="check();"';
	$e1->fields[]=&$$f;

	$f22=new pparent_tree();
	$f22->name='parent';
	$f22->key='id';
	$f22->value='name';
	$f22->inner='class=f_select';
	$f22->rule=array('self'=>'Раздел не может ссылаться на себя.');
	$f22->sql="SELECT * FROM ".$t1->name." WHERE parent='#' ORDER BY pos";
	$f22->default=$parent;
	$e1->fields[]=&$f22;

	$f = 'text';
	$$f=new mce_();
	$$f->name=$f;
	$$f->width="100%";
	$$f->height=370;
	//$$f->rule=array('ne'=>'Поле <b>текст страницы</b> не должно быть пустым');
	$$f->toolbar='Default';
	$e1->fields[]=&$$f;

	/*
	$f='meta';
	$$f=new textarea_();
	$$f->name=$f;
	$$f->inner='class=textareainput style="width:100%; height:100;"';
	$e1->fields[]=&$$f;	
	*/
	
	$f3=new phidden();
	$f3->name='pos';
	$e1->fields[]=&$f3;

	$f8=new pcheckbox();
	$f8->name='display';
	$f8->set_default_checked();
	$e1->fields[]=&$f8;

	$f='alias';
	$$f=new ptext();
	$$f->name=$f;
	$$f->inner=' class=textinput size=60 maxlength=128 id=out ';
	$$f->rule=array('dr'=>'Такой <b>Путь</b> уже существует','in'=>'<b>Путь</b> содержит недопустимые символы');
	$e1->fields[]=&$$f;

	$f = 'first';
	$$f->MySQLType='varchar(1)';
	$$f=new phidden();
	$$f->name=$f;
	$e1->fields[]=&$$f;
	
	$f = 'included_modules';
	$$f=new ptext();
	$$f->name=$f;
	$$f->MySQLType='varchar(128)';
	$$f->inner=' class=textinput size=80 readonly ';
	$e1->fields[]=&$$f;	
        
        
	$f='title';
	$$f=new ptext();
	$$f->name=$f;
	$$f->inner=' class=textinput size=60 maxlength=128 ';
	$e1->fields[]=&$$f;
        
        
	$f='keywords';
	$$f=new ptextarea();
	$$f->name=$f;
	$$f->inner=' class=textareainput style="width:500px;height:100%;"';
	$e1->fields[]=&$$f;
        
	$f='description';
	$$f=new ptextarea();
	$$f->name=$f;
	$$f->inner=' class=textareainput style="width:500px;height:100%;"';
	$e1->fields[]=&$$f;

	$t1->fields=$e1->fields;
?>