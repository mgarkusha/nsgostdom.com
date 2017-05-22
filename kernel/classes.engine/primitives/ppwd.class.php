<?php if (!defined('SCRIPTACCESS')) exit;
	class ppwd {
		// required
		var $name;
		// optional
		var $inner;
		var $maxlength;
		var $size;
		var $rule;
		var $error='none';
		var $MySQLType='varchar(128)';
		//
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(vars($this->name)=='' && vars($this->name.'2')==''){
						$this->error=$name;
						return false;
					};
				};
				if($name=='eq'){
					if(vars($this->name)!=vars($this->name.'2')){
						$this->error=$name;
						setvar($this->name,'');
						return false;
					};
				};
			}
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			echo "<input type=password name='".$this->name."'";
			if($this->size!='') echo " size=".$this->size;
			if($this->maxlength!='') echo " maxlength=".$this->maxlength;
			if($this->inner!='') echo " ".$this->inner;
			echo " value=\"".htmlspecialchars(vars($this->name))."\"";
			echo ">";
		}
		function display2(){
			echo "<input type=password name='".$this->name."2'";
			if($this->size!='') echo " size=".$this->size;
			if($this->maxlength!='') echo " maxlength=".$this->maxlength;
			if($this->inner!='') echo " ".$this->inner;
			echo " value=\"".htmlspecialchars(vars($this->name))."\"";
			echo ">";
		}
	};
?>