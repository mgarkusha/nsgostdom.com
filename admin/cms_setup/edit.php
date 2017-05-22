<?php if (!defined('SCRIPTACCESS')) exit;

a_message($t);
a_header('Настройки сайта');
a_edit_controls($e1);
a_edit(
        $e1,
        'Название|KEY|VALUE',
        'name|key|value'
);
