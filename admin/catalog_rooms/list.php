<form name=one method=post style='margin:0; padding:0;'>
<?
	a_message($t);
 	a_header(cms::module_name(MODULE));
 	echo "&nbsp; &nbsp;"; $p->display();

	a_list_controls($l1);
	$_s  = 'if($l1->display==1) echo "Да"; else echo "Нет";';
        
	$_s2='echo \'<img src="/images/slider/\'.$l1->pic.\'small.jpg">\'; ';

        a_list(
		$l1,
		'Наименование|Цена|Площадь|Количество комнат|Отображать',
		'name|price|area|number_of_rooms|::'.$_s
	); 
?>
</form>