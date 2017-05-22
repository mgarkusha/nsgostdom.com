<?php if (!defined('SCRIPTACCESS')) exit;
	class vars {

		// возвращает значение переменной из массива $_POST и приводит его к определенному типу
		public static function post($name,$type){
			return vars::getvar($name,$type,"POST");
		}
		
		// возвращает значение переменной из массива $_GET и приводит его к определенному типу
		public static function get($name,$type){
			return vars::getvar($name,$type,"GET");
		}
		
		// возвращает значение переменной из массива $_GET || $_POST и приводит его к определенному типу
		public static function mixed($name,$type){
			$r=vars::getvar($name,$type,"POST");
			if($r) return $r; else return vars::getvar($name,$type,"GET");
		}
		
		// устанавливает значение переменной $_POST
		public static function setpost($name,$value){
			global $_POST;
			$_POST[$name]=$value;
		}

		// устанавливает значение переменной $_GET
		public static function setget($name,$value){
			global $_GET;
			$_GET[$name]=$value;
		}
		
		// устанавливает значение переменной $_POST && $_GET
		public static function setmixed($name,$value){
			global $_GET;
			global $_POST;
			$_POST[$name]=$value;
			$_GET[$name]=$value;
		}
		
		// protected area
		
		protected static function getvar($name,$type,$method){
			if($method=='POST'){
				global $_POST;
				if(!isset($_POST[$name])) return false;
				switch ($type) {
					case 'int': return (int)($_POST[$name]); break;
					case 'string': return (string)($_POST[$name]); break;
					case 'double': return (double)($_POST[$name]); break;
					case 'html': return htmlspecialchars(($_POST[$name])); break;
					default: return false;
				};
			};
			if($method=='GET'){
				global $_GET;
				if(!isset($_GET[$name])) return false;
				switch ($type) {
					case 'int': return (int)($_GET[$name]); break;
					case 'string': return (string)($_GET[$name]); break;
					case 'double': return (double)($_GET[$name]); break;
					case 'html': return htmlspecialchars(($_GET[$name])); break;
					default: return false;
				};
			};
			return false;			
		}
		
	}
?>