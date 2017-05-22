<?php if (!defined('SCRIPTACCESS')) exit;
	class pdate3 {
		
		public $name;
		public $inner;
		public $inner2;
		public $MySQLType='datetime';
		public $form='one';
		
		function display(){
			if(vars::mixed($this->name,'string')==''){
				vars::setmixed($this->name,vars::mixed($this->name.'y','string')."-".vars::setmixed($this->name.'m','string').'-'.vars::setmixed($this->name.'d','string'));
			}
			$d=explode("-",vars($this->name));
			echo "<select name=".$this->name."d ".$this->inner.">";
			for($i=1;$i<=31;$i++){
				if($d[2]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>$i</option>";
			};
			echo "</select>&nbsp;";
			echo "<select name=".$this->name."m ".$this->inner.">";
			$mo=array("Январь","Февраль",'Март',"Апрель","Май","Июнь","Июль","Август","Сентябрь","Окрябрь","Ноябрь","Декабрь");
			for($i=1;$i<=12;$i++){
				if($d[1]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>".$mo[$i-1]."</option>";
			};
			echo "</select>&nbsp;";
			echo "<select name=".$this->name."y ".$this->inner." >";
			$this->datebegin=date("Y");
			$this->dateend=date("Y")+2;
			for($i=$this->datebegin;$i<$this->dateend;$i++){
				if($d[0]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>".(int)$i."</option>";
			};
			echo "</select>&nbsp;";
		}
		
		function work(){
			if(vars($this->name.'y')!='') setvar($this->name,vars($this->name.'y')."-".vars($this->name.'m').'-'.vars($this->name.'d'));
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
	};
?>