<?php if (!defined('SCRIPTACCESS')) exit;
	class readonly_ {
		// required
		var $name;
		// optional
		var $inner;
		var $nl2br;
		var $error='none';
		//
		function work(){
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			$s="<font $this->inner>".htmlspecialchars(vars($this->name))."</font>";
			if($this->nl2br) echo nl2br($s); else echo $s;
		}
	};
?>