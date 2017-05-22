<?php if (!defined('SCRIPTACCESS')) exit;
	class pmultiparent {
		var $name;
		var $sql;
		var $key;
		var $value;
		var $default;
		var $inner;
		var $reload;
		var $MySQLType='varchar(255)';
		function work(){
			if(isset($_REQUEST[$this->name])){
				if(!is_array($_REQUEST[$this->name])){
					setvar($this->name,$_REQUEST[$this->name].',');
				}else{
					$s='';
					foreach ($_REQUEST[$this->name] as $key){
						$s.=','.$key;
					}
					$s.=',';
					setvar($this->name,$s);
				}
			}
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='empty'){
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
		//
		function display(){
			if(vars($this->name)=='') setvar($this->name,$this->default);
			$s=substr(vars($this->name),1,-1);
			$arr=explode(',',$s);
			$db=mysql_query($this->sql);
			//echo $this->sql.'<br>';
			if($this->reload) $r="onchange='document.".$this->reload.".submit();'";
			echo "<select name='".$this->name."[]' ".$this->inner." $r multiple>";
			while($row=mysql_fetch_array($db)){
				if(in_array($row[$this->key],$arr)) $sel='selected'; else $sel='';
				//if(vars($this->name)==$row[$this->key]) $sel='selected'; else $sel='';
				if($this->sql2){
					$rs=mysql_fetch_array(mysql_query($sql=ereg_replace('#',$row[$this->value2],$this->sql2)));
					//echo $sql."<br>";
					$row[$this->value]=$rs[$this->value];
				}
				if($this->cut) $row[$this->value]=_cut($row[$this->value],$this->cut);
				echo "<option value='".$row[$this->key]."' $sel>".$row[$this->value]."</option>";
			};
			echo "</select>";
		}
	}
?>