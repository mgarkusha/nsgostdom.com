<? a_message($t); ?>
<? a_header(cms::module_name(MODULE).': редактирование'); ?>
<? a_edit_controls($e1); ?>
<?
	$_s='global $pic; $pic->display(); echo "&nbsp"; ';
	$_s.='$pic->display2();';

	a_edit(
		$e1,
		'Изображение|Текст|Отображать|Ссылка',
		'::'.$_s.'|text|display|url'
	);
?>
