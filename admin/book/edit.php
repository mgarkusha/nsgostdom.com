<? a_message($t); ?>
<? a_header(cms::module_name(MODULE).': редактирование'); ?>
<? a_edit_controls($e1); ?>
<?
	a_edit(	
		$e1,
		'Дата|Автор|E-mail|Сообщение|Показывать|ip',
		'posted|author|mail|message|display|ip'
	); 
?>