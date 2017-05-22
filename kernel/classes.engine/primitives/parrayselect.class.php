<?php if (!defined('SCRIPTACCESS')) exit;
	class parrayselect {
		var $name;
		var $inner;
		var $list;
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(in_array(vars($this->name),array('emp',''))){
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
		//
		function display(){
			echo "<select name=".$this->name." ".$this->inner.">";
			for(reset($this->list);$key=key($this->list);next($this->list)){
				if(vars($this->name)==$key) $sel='selected'; else $sel='';
				$k=$key;
				if ($key=='emp') $key='';
				echo "<option value='$key' $sel>".htmlspecialchars($this->list[$k])."</option>";
			};
			echo "</select>";
		}
	};
?>