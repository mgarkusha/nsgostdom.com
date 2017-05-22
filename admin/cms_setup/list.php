<?php if (!defined('SCRIPTACCESS')) exit; ?>
<form name=one method=post style='margin:0; padding:0;'>
<? 
	a_message($t); 
	a_header('Настройки сайта');
	a_list_controls($l1); 
	$code2='echo _cut($l1->value);';
	a_list(
		$l1,
		'Название|KEY|VALUE',
		'name|key|::'.$code2,
		'edit|delete|up|down'
	); 
?>
</form>
