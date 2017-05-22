<?php if (!defined('SCRIPTACCESS')) exit;
	class pparent_tree {
		var $name;
		var $sql;
		var $key;
		var $value;
		var $default;
		var $inner;
		var $reload;
		var $MySQLType='int(11)';
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='self'){
					if(vars($this->name)==vars('e')){
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
			if(vars($this->name)=='') setvar($this->name,$this->default);
			echo "<select name='".$this->name."' ".$this->inner.">";
			if (is_array($this->first)){
				foreach ($this->first as $key=>$value){
					echo "<option value='".$key."'>".$value."</option>";
				}
			}else{
				echo "<option value=''> + </option>";
			}
			function p($parent,$t,$level){
				$sql=ereg_replace('#',$parent,$t->sql);
				//echo $sql."<br>";
				$db=mysql_query($sql);
				while($row=mysql_fetch_array($db)){
					if(vars($t->name)==$row[$t->key]) $sel='selected'; else $sel='';
					echo "<option value='".$row[$t->key]."' $sel>";
					for($i=0;$i<=$level;$i++) echo "+&nbsp;&nbsp;";
					echo $row[$t->value]."</option>";
					p($row['id'],$t,$level+1);
				};
			};
			p(0,$this,0);
			echo "</select>";
		}
	}
?>