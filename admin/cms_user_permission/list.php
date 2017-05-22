<?php if (!defined('SCRIPTACCESS')) exit; ?>
<form name=one style="margin:0; padding:0;">
<? 
	a_message($t);
	a_header('Права пользователей');
	a_navigator('Пользователи',conf::$hpath.'admin/cms_user/');
	echo "<br>".html::ispace(2,2)."<br>";
	$f1_->display();
	a_list_controls($l1); 
	
	$s11='
		$rs=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."cms_module WHERE path=\'$l1->name\'"));
		if($rs[0]==0 && !in_array($l1->name,array("files","cms_setup","cms_opt"))) echo "<font color=red><b>!</b> модуль не существует</font>"; else echo "&nbsp;";
	';
	$_s2='
		if($l1->read=="1") echo "<font color=green><b>ДА</b></font> &nbsp;<a href=\'?ch=".$l1->id."&r\' class=link>изм</a>"; 
		else echo "<font color=red>нет</font> &nbsp;<a href=\'?ch=".$l1->id."&r=1\' class=link>изм</a>";
	';
	$_s3='
		if($l1->write=="1") echo "<font color=green><b>ДА</b></font> &nbsp;<a href=\'?ch=".$l1->id."&w\' class=link>изм</a>"; 
		else echo "<font color=red>нет</font> &nbsp;<a href=\'?ch=".$l1->id."&w=1\' class=link>изм</a>";
	';
	$_s22='
		$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."cms_module WHERE path=\'$l1->name\'"));
		if($db["name"]=="") echo $l1->name; else echo $db[\'name\'];
	';
	a_list(
		$l1,
		'Имя|Чтение|Запись|',
		'::'.$_s22.'|::'.$_s2.'|::'.$_s3.'|::'.$s11,
		'up|down'
	); 
?>
</form>