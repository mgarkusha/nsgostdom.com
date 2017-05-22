<? a_message($t); ?>
<? a_header(cms::module_name(MODULE).': редактирование'); ?>
<? a_edit_controls($e1); ?>
<?
	$_s='global $pic; $pic->display(); echo "&nbsp"; ';
	$_s.='$pic->display2();';

	$_s1='global $pic1; $pic1->display(); echo "&nbsp"; ';
	$_s1.='$pic1->display2();';

	$_s2='global $pic2; $pic2->display(); echo "&nbsp"; ';
	$_s2.='$pic2->display2();';
	
	$_s3='global $pic3; $pic3->display(); echo "&nbsp"; ';
	$_s3.='$pic3->display2();';
	
	$_s4='global $pic4; $pic4->display(); echo "&nbsp"; ';
	$_s4.='$pic4->display2();';

	a_edit(
		$e1,
		'Наименование|Цена|ID комнаты(travelline)|Площадь|Количество комнат|Отображать|Дополнительно место|Текст|Title|Keywords|Description|Картинка|Картинка2|Картинка3|Картинка4|Картинка5',
		'name|price|id_for_type_room|area|number_of_rooms|display|additional_space|text|title|keywords|description|::'.$_s.'|::'.$_s1.'|::'.$_s2.'|::'.$_s3.'|::'.$_s4
	);
?>
