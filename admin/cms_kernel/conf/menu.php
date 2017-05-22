<?php if (!defined('SCRIPTACCESS')) exit;

$adm_menu=array(
        "Карта сайта|sitemap",
        "Страницы сайта|texts",
        "newline",
        "Гостевая|book",
        "newline",
        "Каталог|catalog",
        "Каталог позиции|catalog_items",
        "newline",
        "Статьи|articles",
        "newline",
        "Пользователи|cms_user",
        "Права доступа|cms_user_permission",
        "Модули|cms_module",
);

for($i=0;$i<count($adm_menu);$i++){
        $ar=explode('|',$adm_menu[$i]);
        if(count($ar)>1) $adm_menu_assoc[$ar[0]]=$ar[1];
};