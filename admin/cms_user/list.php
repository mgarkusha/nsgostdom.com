<?php if (!defined('SCRIPTACCESS')) exit; ?>
<form name=one method=post style='margin:0; padding:0;'>
<? 
	a_message($t); 
	a_header('Список пользователей');
	a_list_controls($l1); 
	$_s2="if(\$l1->superadmin=='1') echo '<b>да</b>'; else echo '<b>нет</b>';";
	$_s3="
		echo \"<a href='\".conf::\$hpath.\"admin/cms_user_permission/?cms_user_permissionf1=\".\$l1->id.\"' class=link>Редактировать</a>\";
	";
	a_list(
		$l1,
		'Логин|Имя|Права|Полный доступ ',
		'login|name|::'.$_s3.'|::'.$_s2,
		'edit|delete|up|down'
	); 
?>
</form>