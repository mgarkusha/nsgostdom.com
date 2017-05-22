<?php if (!defined('SCRIPTACCESS')) exit; ?>
<table cellpadding="0" cellspacing="0" width="100%" border="0">
    <tr>
        <td width="100%">
            <table cellpadding=0 cellspacing=0 border=0 width="100%"><form name=one1><tr>
                        <?
                        echo "<td class=text>Пользователь:&nbsp;" . $_username_ . "</td>";
                        ?>
                    </tr></form></table>
        </td><td align=right class=text nowrap>&nbsp; | &nbsp;<a href="<?= conf::$hpath ?>admin/cms_index/?logout=1" class=link>Выход</a>
            <? if ($_useradmin_ || ($_userperm_['files']['write'] == '1' && $_userperm_['files']['read'] == '1')) { ?>
                &nbsp;|&nbsp; <a href="javascript:open_browser();" class=link>Файлы</a>
            <? } ?>
            <? if ($_useradmin_ || ($_userperm_['cms_opt']['read'] == '1')) { ?>
                &nbsp;|&nbsp; <a href="<?= conf::$hpath ?>admin/cms_opt/" class=link>Оптимизация</a>
            <? } ?><? if ($_useradmin_ || ($_userperm_['cms_setup']['read'] == '1')) { ?>
                &nbsp;|&nbsp; <a href="<?= conf::$hpath ?>admin/cms_setup/" class=link>Настройки</a>
            <? } ?><? if ($_useradmin_) { ?>
                &nbsp;| &nbsp;<a href="<?= conf::$hpath ?>admin/cms_user/" class=link>Пользователи</a>
                &nbsp;| &nbsp;<a href="<?= conf::$hpath ?>admin/cms_module/" class=link>Модули</a>
            <? } ?>
            &nbsp;| &nbsp;
        </td>
    </tr>
</table>
<script>
    function open_browser(){
        mywin=open('/kernel2/filemanager/', 'displaywindow', 'width=700, height=500,resizable=no');
    };
</SCRIPT>