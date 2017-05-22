<?php if (!defined('SCRIPTACCESS')) exit; ?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">
<html>
    <head>
        <title>Система управления сайтом "R70"</title>
        <LINK rel="STYLESHEET" type="text/css" href="/kernel2/astyles.css"/>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    </head>
    <body style="margin:4px; padding:0px;">
        <table cellpadding="0" cellspacing="0" border="0" width="100%" height="100%" align="center">
            <tr bgcolor="#e7f1f5">
                <td height="30" style="width:100%; border:1px solid #d9d9d9;">
                    <table cellpadding="0" cellspacing="0" border="0" width="100%" height="30">
                        <tr>
                            <td valign="middle">&nbsp;&nbsp;</td>
                            <td valign="middle"><img src="/images/cms/r70.png" border="0"></td>
                            <td valign=top>&nbsp;&nbsp;</td>
                            <td nowrap width="100%" valign="top" style="padding-top:8px;"><? include conf::$bpath . 'admin/cms_kernel/skin/menu.php'; ?></td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr>
                <td height="100%" valign="top" class="text2" style="padding-top: 4px; padding-bottom: 4px;">
                    <table cellpadding="10" cellspacing="0" border="0" width="100%" height="100%">
                        <tr>
                            <td valign="top" nowrap height="100%" class="text2" bgcolor="#f3f3f3">
                                <? include conf::$bpath . 'admin/cms_kernel/skin/leftmenu.php'; ?>
                            </td>
                            <td valign="top" width="100%" height="100%" class="text2">
                                <? include CONTENT ?>
                            </td>
                        </tr>
                    </table>
                </td>
            </tr>
            <tr bgcolor="#d2d2d2">
                <td valign="middle" widht="100%" align="left" style="font-family: verdana; font-size: 10px; color: #000; padding: 3px;">
                    &nbsp;&copy;2005 &mdash; <? echo date("Y"); ?> ООО "Капитал Интернет-решений"
                </td>
            </tr>
        </table>
    </body>
</html>