<?php if (!defined('SCRIPTACCESS')) exit;
	class parraycheckbox {
		// required
		var $name;
		// optional
		var $inner;
		var $error='none';
		var $sql;
		var $sep=',';
		var $MySQLType='varchar(255)';
		var $default_checked=false;
		//
		function work(){
			$db=mysql_query($this->sql);
			while($row=mysql_fetch_array($db)){
				if (vars($this->name.$row[$this->key])==$row[$this->key]){
					$resch[]=vars($this->name.$row[$this->key]);
				}
			}
			if (count($resch)>0){
				$r=implode($this->sep,$resch);
			}
			setvar($this->name,$this->sep.$r.$this->sep);
			return true;
		}
		//
		function set_default_checked(){
			$this->default_checked=true;
			if(vars('e')=='n' && vars('s')=='') setvar($this->name,'1');
		}
		//
		function display(){
			$db=mysql_query($this->sql);
			$j=0;
			echo "<table cellpadding=0 cellspacing=0 border=0>";
			while($row=mysql_fetch_array($db)){
				if($j==0) echo "<tr>";
				if(ereg($row[$this->key],vars($this->name))) $ch='checked'; else $ch='';
				echo "<td class=text><input type=checkbox name=".$this->name.$row[$this->key]." value=".$row[$this->key]." ".$ch."> ".$row[$this->value]."</td>";
				$j++;
				if ($j==3){
					echo "</tr>";
					$j=0;
				}
			}
			if($j!=3) echo "</tr>";
			echo "</table>";
		}
		function display2(){
			$intr=explode(",",vars(vars($this->name)));
			$db=mysql_query($this->sql);
			$j=0;
			echo "<input type=hidden name='".$this->name."' value='".vars($this->name)."'>";
			while($row=mysql_fetch_array($db)){
				if(ereg($row[$this->key],vars($this->name))) $ch=$row[$this->key]; else $ch='';
				echo "<input type=hidden name=".$this->name.$row['id']." value=".$ch." > ";
				$j++;
			}
		}
		
	};
?>