<?php if (!defined('SCRIPTACCESS')) exit;

a_message($t); ?><? a_header(cms::module_name(MODULE)); 

	if((int)$parent!=0){
		echo "&nbsp; &nbsp;";
		$p=$parent;
		while(true){
			$rs=mysql_fetch_array(mysql_query("SELECT * FROM ".$t1->name." WHERE id=".$p));
			if($rs['parent']=='0') $rs['parent']='null';
			$arr[]=$rs['parent'];
			$arrn[]=$rs['name'];
			if($rs['parent']=='null') break;
			$p=$rs['parent'];
		};
		$arrn[]='В корень';
		for($i=count($arr)-1;$i>=0;$i--) {
			echo "<a href='?parent=".$arr[$i]."' class=link>".$arrn[$i+1]."</a>";
			if($i==0) {
				echo "<font class=text> / ".$arrn[$i]."</font>";
				break; 
			}else echo ' / ';
		};
	};
?>
<? a_list_controls($l1); ?>
<? 
	$s_="
		\$sql='SELECT COUNT(*) FROM '.conf::\$dbprefix.'sitemap WHERE parent='.\$l1->id;
 		\$db_=mysql_fetch_array(mysql_query(\$sql));
		echo '('.(int)\$db_[0].') ';
		echo \"<a href='?parent=\$l1->id' class=link2>перейти</a>\"; 
	";
	
?>
<? $s2_=" echo '<div align=center>'; if(\$l1->display==\"1\") echo \"Да\"; else echo \"Нет\"; echo '</div>';"; ?>
<?
 $s1_=" 
 	if(\$l1->page!=0){
 		\$sql='SELECT * FROM '.conf::\$dbprefix.'texts WHERE id='.\$l1->page;
 		\$db_=mysql_fetch_array(mysql_query(\$sql));
 		echo \$db_['name'];
		echo ' ( <a class=link2 href=\"".conf::$hpath."admin/texts/?e='.\$db_['id'].'\">ред.</a> )';
 	}else{
 		echo 'Нет связи';
 	};
	"; 
?>
<?
	$s3_="
			\$sql = \"SELECT * FROM \".conf::\$dbprefix.\"sitemap WHERE first='1'\";
 			\$db_=mysql_fetch_array(mysql_query(\$sql));
 			if (\$db_['id']==\$l1->id) \$sel=\"checked='checked'\"; else \$sel=\"\";
			echo '<input type=\"checkbox\" onclick=\"javscript:set('.\$l1->id.')\" '.\$sel.'>';
		";
	a_list(
		$l1,
		'ID|Название раздела|Подразделы|Отображать|Первый',
		'id|name|::'.$s_.'|::'.$s2_.'|::'.$s3_
	); 
?>
<SCRIPT>
	function set(id){
		document.location.href='?first_set='+id;
	};
</SCRIPT>