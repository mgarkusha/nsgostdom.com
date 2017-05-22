<form name=one method=post style='margin:0; padding:0;'>
<?
	a_message($t);
 	a_header(cms::module_name(MODULE));
	echo "&nbsp; &nbsp;"; $p->display();
	a_list_controls($l1);
	echo html::ispace(2,5)."<br>";

	$fi1->display();

	echo "<br>".html::ispace(2,2)."<br>";

	$_s="if(\$l1->display==\"1\") echo \"<span style=color:green;font-weight:bold;>Да</span>\"; else echo \"<span style=color:red;font-weight:bold;>Нет</span>\";";
	$_s2="if(\$l1->approved==\"1\") echo \"Да\"; else echo \"<font color=red><b>Нет</b></font>\";";
	a_list(
		$l1,
		'ID|Дата|Вопрос|Автор|Выводить',
		'id|::echo hrdate($l1->posted);|message|author|::'.$_s,
		'edit|delete'
	); 
?>
</form>