<?php if (!defined('SCRIPTACCESS')) exit;
	class pfamily1 {
		// required
		public $key='id';
		public $value='name';
		var $name;
		// optional
		var $inner;
		var $error='none';
		var $MySQLType='varchar(255)';
		//
		function work(){
//			$db=mysql::query($this->sql);
//			while($row=mysql_fetch_array($db)){
//				if (vars($this->name.$row[$this->key])==$row[$this->key]){
//					$resch[]=vars($this->name.$row[$this->key]);
//				}
//			}
//			if (count($resch)>0){
//				$r=implode($this->sep,$resch);
//			}
//			setvar($this->name,$this->sep.$r.$this->sep);
			return true;
		}
		//
		function set_default_checked(){
			//$this->default_checked=true;
			//if(vars('e')=='n' && vars('s')=='') setvar($this->name,'1');
		}
		//
		function display(){
			$list=array("10"=>"Холост/не замужем","20"=>"Состою в браке","30"=>"Разведен(а)");
			$j=0;
			echo "<table cellpadding=0 cellspacing=0 border=0><tr>";
			foreach($list as $key=>$value) {
				echo "<td nowrap>";
				echo "<input type=radio name=".$this->name." value=".$key." ".$ch.">";
				echo "</td><td class=text style='padding-top:2px;'>".$value."&nbsp;</td>";
			}
			echo "</tr></table>";
		}
	};
?>