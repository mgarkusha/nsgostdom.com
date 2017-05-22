<?php if (!defined('SCRIPTACCESS')) exit;

a_message($t);
a_header('Редактирование прав');
a_edit_controls($e1);
a_edit(
        $e1,
        'Пользователь|Имя|Четение|Запись',
        'userid|name|read|write'
);
