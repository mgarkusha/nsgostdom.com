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

	a_edit(
		$e1,
		'Наименование авто|Цена|МКПП|Без ограничения пробега|Без залога|Передача в любой точке города|Отображать|Описание|Title|Keywords|Description|Картинка|Картинка2|Картинка3',
		'name|price|transmission|unlimited_mileage|collateral|transfer_cars|display|text|title|keywords|description|::'.$_s.'|::'.$_s1.'|::'.$_s2
	);
?>
