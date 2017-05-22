<?php if (!defined('SCRIPTACCESS')) exit;

a_message($t);
a_header('Пользователи: редактирование');
a_edit_controls($e1);
$_s='global $password; $password->display2();';
a_edit(
        $e1,
        'Логин|Имя|Пароль|Повтор пароля|Суперадминистратор',
        'login|name|password|::'.$_s.'|superadmin'
);
