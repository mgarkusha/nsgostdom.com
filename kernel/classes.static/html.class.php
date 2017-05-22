<?php if (!defined('SCRIPTACCESS')) exit;
	class html {
		
		// возвращает изображение из папки /htdata/images/ c альтом $alt и дополнительными параметрами внутри тега $add
		public static function image($name,$alt='',$add=''){
			if(is_file(conf::$bpath.''.$name)){
				$size=getimagesize(conf::$bpath.''.$name);
				$path=conf::$hpath.''.$name;
			}elseif(is_file(conf::$bpath.'images/'.$name)){
				$size=getimagesize(conf::$bpath.'images/'.$name);
				$path=conf::$hpath.'images/'.$name;
			}else return false;
			return "<img src='".$path."' ".$size[3]." alt=\"".htmlspecialchars(conf::$alt).' '.htmlspecialchars($alt)."\" ".$add." border=0>";
		}
		// возвращает ссылка
		public static function href($link,$name,$class='link',$alt='',$add=''){
			return "<a href='".$link."' title='".strip_tags(conf::$alt).' '.strip_tags($name).' '.strip_tags($alt)."' ".$add." class='".$class."'>".$name."</a>";
		}
		// возвращает div с заданыни width и height
		public static function space($width,$height) {
			return "<div style='width:$width; height:$height;'></div>";
		}
		
		// возвращает прозрачный gif с заданыни width и height
		public static function ispace($width,$height) {
			return "<image src='".conf::$hpath."images/empty.gif' style='width:".$width."px; height:".$height."px;'>";
		}
		
		
	}
?>