<?php if (!defined('SCRIPTACCESS')) exit;
	class date_y_ {
		var $name;
		var $inner;
		var $MySQLType='int(4)';
		var $datebegin=1930;
		var $dateend;
		
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
		function error_text(){
			return $this->rule[$this->error];
		}
		function display(){
			echo "<select name=".$this->name." ".$this->inner.">";
			echo "<option value=0> -- </option>";
			if ($this->dateend=='') $this->dateend=date("Y");
			for($i=$this->dateend;$i>=$this->datebegin;$i--){
				if(vars($this->name)==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>$i</option>";
			};
			echo "</select>&nbsp;";
		}
	};
?>