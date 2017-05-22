<?php if (!defined('SCRIPTACCESS')) exit;
	class ptextarea {
		var $name;
		var $inner;
		var $cols;
		var $rows;
		var $MySQLType='longtext';
		function display(){
			echo "<textarea name='".$this->name."'";
			if(!empty($this->cols)) echo " cols=".$this->cols;
			if(!empty($this->rows)) echo " rows=".$this->rows;
			if(!empty($this->inner)) echo " ".$this->inner;
			echo ">".htmlspecialchars(vars($this->name))."</textarea>";
		}
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(vars($this->name)==''){
						$this->error=$name;
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
	};
?>