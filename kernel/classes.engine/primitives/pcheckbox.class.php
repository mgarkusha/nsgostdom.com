<?php if (!defined('SCRIPTACCESS')) exit;
	class pcheckbox {
		// required
		var $name;
		// optional
		var $inner;
		var $error='none';
		var $MySQLType='varchar(1)';
		var $default_checked=false;
		//
		function work(){
			return true;
		}
		//
		function set_default_checked(){
			$this->default_checked=true;
			if(vars('e')=='n' && vars('s')=='') setvar($this->name,'1');
		}
		//
		function display(){
			if(vars($this->name)=='1') $ch='checked'; else $ch='';
			echo "<input type=checkbox name=".$this->name." value=1 ".$ch." ".($this->inner?$this->inner:'').">";
		}
	};
?>