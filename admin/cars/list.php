<form name=one method=post style='margin:0; padding:0;'>
<?
	a_message($t);
 	a_header(cms::module_name(MODULE));
 	echo "&nbsp; &nbsp;"; $p->display();

	a_list_controls($l1);
	$_s  = 'if($l1->display==1) echo "Да"; else echo "Нет";';

        a_list(
		$l1,
		'Наименование авто|Цена|МКПП|Без ограничения пробега|Без залога|Передача в любой точке города|Отображать',
		'name|price|transmission|unlimited_mileage|collateral|transfer_cars|::'.$_s
	); 
?>
</form>