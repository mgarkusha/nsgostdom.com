<?php if (!defined('SCRIPTACCESS')) exit;

a_message($t);
a_header('Модули: редактирование');
a_edit_controls($e1);
a_edit(
        $e1,
        'Папка|Название|Отображать|Доступ из карты сайта',
        'path|name|display|sitemapaccess'
);

