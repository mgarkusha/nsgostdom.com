<?php if (!defined('SCRIPTACCESS')) exit; ?>
<? a_message($t); ?><? a_header(cms::module_name(MODULE)); ?>
<? $p->display(); ?><? a_list_controls($l1); ?>
<? a_list($l1,'ID|Название страницы','id|name','edit|delete|up|down'); ?>