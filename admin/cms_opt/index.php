<?php	
	$_tmp_str_=explode('/',$_SERVER['REQUEST_URI']); 
	define('MODULE',$_tmp_str_=$_tmp_str_[count($_tmp_str_)-2]);

	include '../cms_kernel/conf/conf.php';

	$default=array(
		'META_DESCRIPTION'=>'Общие "Meta description"',
		'META_KEYWORDS'=>'Общие "Meta keywords"',
		'TITLE_START'=>'Начало заголовка <title>',
		'TITLE_END'=>'Конец заголовка <title>',
		'KEY_WORD'=>'Ключевое слово'
	);
	
	foreach($default as $key=>$value){
		if(!mysql::exist_record(conf::$dbprefix.MODULE,'key',$key)){
			mysql::insert_record(
				conf::$dbprefix.MODULE,
				array(
					"name"=>$value,
					"key"=>$key,
					"value"=>''
				),
				'pos'
			);
		};
	}

	include "db.php";
	$t->work();
	
	define('CONTENT',$t->display());

	include conf::$skin;
?>