<?php if (!defined('SCRIPTACCESS')) exit;
	class parent2_ {
		var $name;
		var $sql;
		var $key;
		var $value;
		var $default;
		var $inner;
		var $reload;
		function work(){
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			if(vars($this->name)=='') setvar($this->name,$this->default);
			if($this->reload) $r="onchange='document.".$this->reload.".submit();'";
			echo "<select name='".$this->name."' ".$this->inner." $r>";
			if($this->insert_first){
				foreach($this->insert_first as $key=>$value){
					if(vars($this->name)==$key) $sel='selected'; else $sel='';
					echo "<option value=$key $sel>$value</option>";
				};
			};
			$db1=mysql_query($this->parentsql);
			$cl=false;
			while($row1=mysql_fetch_array($db1)){
				$db=mysql_query(ereg_replace('#',$row1[$this->parentkey],$this->sql));
				$cl=!$cl;
				while($row=mysql_fetch_array($db)){
					if(vars($this->name)==$row[$this->key]) $sel='selected'; else $sel='';
					echo "<option style='background-color:#".($cl?'eeeeee':'ffffff')."' value='".$row[$this->key]."' $sel>".$row1[$this->parentname].'.'.$row[$this->value]."</option>";
				};
			};
			if($this->insert_last){
				foreach($this->insert_last as $key=>$value){
					if(vars($this->name)==$key) $sel='selected'; else $sel='';
					echo "<option value=$key $sel>$value</option>";
				};
			};
			echo "</select>";
		}
	}
?>