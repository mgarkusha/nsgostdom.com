<?php if (!defined('SCRIPTACCESS')) exit;
	class phidden {
		var $name;
		var $default;
		var $MySQLType='int(11)';
		function display(){
			if(vars($this->name)=='') setvar($this->name,$this->default);
			echo "<input type=hidden name=".$this->name." value=\"".htmlspecialchars(vars($this->name))."\">";
		}
		function work(){
			return true;
		}
		function error_text(){
			return true;
		}		
	};
?>