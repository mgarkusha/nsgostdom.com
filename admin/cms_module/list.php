<?php if (!defined('SCRIPTACCESS')) exit; ?>
<form name=one method=post style='margin:0; padding:0;'>
<? 
	a_message($t); 
	a_header('Список модулей');
	a_list_controls($l1); 
	$code='
		$d = dir($dir="../");
		$f=false;
		while($entry=$d->read()) {
    		if(is_dir($dir.$entry)){
    			if($entry==$l1->path){
	    			$f=true;
    				break;
    			};
    		}
		};
		$d->close();
		if(!$f && $l1->path!="") echo "<font color=red><b>!</b> модуль не существует</font>"; else echo "&nbsp;";
	';
	$code1='if($l1->display=="1") echo "Да"; else echo "Нет";';
	$code2='
		if($l1->path=="") echo "<hr width=100%>"; else echo $l1->path;
	';
	$code3='
		if($l1->path=="") echo "<b>".$l1->name."</b>"; else echo $l1->name;
	';
	a_list(
		$l1,
		'Папка|Название|Отображать|',
		'::'.$code2.'|::'.$code3.'|::'.$code1.'|::'.$code,
		'edit|delete|up|down'
	); 
?>
</form><br>
<?
	echo '<b>Неразмещенные модули:</b><br>';
	$d = dir($dir='../');
	while($entry=$d->read()) {
    	if(is_dir($dir.$entry)){
    		$rs=mysql_fetch_array(mysql_query($sql="SELECT COUNT(*) FROM ".conf::$dbprefix."cms_module WHERE path='".$entry."'"));
    		if(	
    			$entry!='.' && 
    			$entry!='..' && 
				!ereg('^(cms_)',$entry) &&
    			$rs[0]==0
    		) echo $entry.'&nbsp; &nbsp; <a href="?e=n&path='.$entry.'" class=link>Разместить</a><br>';
    	}
	}
	$d->close();
?>