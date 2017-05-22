<?
if(!$auth->logged()){
	$_auth_header='Авторизация';
	
	$_auth_txt='<table align="center" border=0><form name=one method="post">';
	
	if($auth->message){
	$_auth_txt.='<tr>
					<td colspan="2" align="center" class="smallredlink">Ошибка авторизации</td>
				</tr>';
		}
	$_auth_txt.='<tr>
					<td align=left>
						<input type=text tabindex="1" class="text" name="'.$auth->name.'_login" value="'.$auth->login_value().'" onfocus="this.value=(this.value==\''.$auth->def_login.'\')?\'\':this.value;" onblur="this.value=(this.value==\'\')?\''.$auth->def_login.'\':this.value;">
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align=left>
						<input type=password tabindex="2" class="text" name="'.$auth->name.'_password" value="'.$auth->pwd_value().'" onfocus="this.value=(this.value==\''.$auth->def_pass.'\')?\'\':this.value;" onblur="this.value=(this.value==\'\')?\''.$auth->def_pass.'\':this.value;">
					</td>
					<td align=right><input type=submit tabindex="4" name="'.$auth->name.'_submit" class="button" value="Войти"></td>
				</tr>
				<tr>
					<td align="left" valign="top" class="smallgreytext">
						<input type="checkbox" tabindex="3" name="'.$auth->name.'_remember" value="'.$auth->remember_value().'">Запомнить
					</td>
					<td>&nbsp;</td>
				</tr>
				<tr>
					<td align=left>
						'.html::href(cms::sitemap_path(1),'забыли пароль?','smallgreylink').'
						'.html::href(cms::sitemap_path(1),'регистрация','smallgreylink').'
					</td>
					<td>&nbsp;</td>
				</tr>
				</form>
			</table>';
	$_auth_padding='5';
} else {
	$_auth_header='Добро пожаловать';
	
	$_auth_txt='<p>Здравствуйте, <font class="redtext"><b>'.conf::$udata['login'].'</b></font></p>';
	$_auth_txt.='<form name=one method="post">
					<input type="hidden" name="'.$auth->name.'_logout" value="1">
					<input type="submit" value="Выход" class="button">
				</form>
				';
	$_auth_padding='5';
}
	

	draw_space_table(5);
	draw_grey_table($_auth_header);
	draw_space_table(5);


	draw_light_grey_table($_auth_txt,$_auth_padding);
	draw_space_table(5);

?>