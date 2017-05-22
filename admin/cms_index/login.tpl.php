<?php if (!defined('SCRIPTACCESS')) exit; ?>
<html>
    <head>
        <title>Авторизация</title>
        <LINK rel="STYLESHEET" type="text/css" href="<?=conf::$hpath?>kernel2/astyles.css">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8">
    </head>
    <body onload="document.one.login.focus();">
        <form name=one method="post">
            <table align="center" width=100% height=100%>
                <tr>
                    <td width=100% height=100% align=center>
                        <table align="center">
                            <? if($message){ ?>
                            <tr><td colspan="2" align="center" class=message>Ошибка авторизации<br><br></td></tr>
                            <? }; ?>
                            <tr>
                                <td class=text align=right>Логин:</td>
                                <td class=text align=right>
                                    <input type=text class="textinput" name=login value="<? echo htmlspecialchars(vars('login')); ?>">
                                </td>
                            </tr>
                            <tr>
                                <td class=text align=right>Пароль:</td>
                                <td class=text align=right>
                                    <input type=password class="textinput" name="password" value="<? if(!$message) echo vars(htmlspecialchars('password')); ?>">
                                </td>
                            <tr>
                                <td colspan="2" align="center" class=text>
                                    <input type="checkbox" name="remember" value="1" <? if(vars('remember')=='1') echo 'checked'; ?>> Запомнить<br>
                                    <br>
                                    <input type=submit mame=subm class=button value="Войти">
                                    <br>
                                    <br>
                                    <br>
                                    <br>
                                    <a href='/' class=link>На сайт</a>
                                </td>
                            </tr>
                        </table>
                    </td>
                </tr>
            </table>
        </form>
    </body>
</html>