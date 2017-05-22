<?php if (!defined('SCRIPTACCESS')) exit;
	class cookie {
		
		public static function get($name,$name2=false){
			global $_COOKIE;
			if($name2==false){
				if(!empty($_COOKIE[$name])) return $_COOKIE[$name];
			}else{
				if(!empty($_COOKIE[$name][$name2])) return $_COOKIE[$name][$name2];
			}
			return false;
		}

		public static function set($name,$value,$time=0){
			global $_COOKIE;
			setcookie($name,$value,$time,'/',$_SERVER['HTTP_HOST']);
			$_COOKIE[$name]=$value;
		}
	}
?>