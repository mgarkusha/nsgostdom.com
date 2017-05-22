<?php if (!defined('SCRIPTACCESS')) exit;
	class pparent {
		var $name;
		var $sql;
		var $key;
		var $value;
		var $default;
		var $inner;
		var $reload;
		var $MySQLType='int(11)';
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
			$db=mysql_query($this->sql);
			if($this->reload) $r="onchange='document.".$this->reload.".submit();'";
			echo "<select name='".$this->name."' ".$this->inner." $r>";
			if($this->insert_first){
				foreach($this->insert_first as $key=>$value){
					if(vars($this->name)==$key) $sel='selected'; else $sel='';
					echo "<option value='$key' $sel>$value</option>";
				};
			};
			while($row=mysql_fetch_array($db)){
				if(vars($this->name)==$row[$this->key]) $sel='selected'; else $sel='';
				if($this->sql2){
					$rs=mysql_fetch_array(mysql_query($sql=ereg_replace('#',$row[$this->value2],$this->sql2)));
					//echo $sql."<br>";
					$row[$this->value]=$rs[$this->value];
					//$row[$this->key]=$rs[$this->key];
				}
				if($this->cut) $row[$this->value]=_cut($row[$this->value],$this->cut);
				echo "<option value='".$row[$this->key]."' $sel>";
				if(is_array($this->value)){
					for($i=0;$i<count($this->value);$i++){
						echo $row[$this->value[$i]]." ";
					}
				}else echo $row[$this->value];
				echo "</option>";
			};
			if($this->insert_last){
				foreach($this->insert_last as $key=>$value){
					if(vars($this->name)==$key) $sel='selected'; else $sel='';
					echo "<option value='$key' $sel>$value</option>";
				};
			};
			echo "</select>";
		}
	}
?>