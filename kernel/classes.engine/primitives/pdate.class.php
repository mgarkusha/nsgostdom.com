<?php if (!defined('SCRIPTACCESS')) exit;
	class pdate {
		var $name;
		var $inner;
		var $datebegin=1930;
		var $dateend;
		
		function work(){
			if(vars($this->name.'y')!='') setvar($this->name,vars($this->name.'y')."-".vars($this->name.'m').'-'.vars($this->name.'d'));
			return true;
		}
		function display(){
			if(trim(vars($this->name))=='') $this->work();
			$d=explode("-",vars($this->name));
			echo "<select name=".$this->name."d ".$this->inner.">";
			echo "<option class='grayfont'>Число</option>";
			for($i=1;$i<=31;$i++){
				if(strlen((string)$i)==1) $ii='0'.$i; else $ii=$i;
				if($d[2]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>$ii</option>";
			};
			echo "</select>&nbsp;";
			$mo=array("Январь","Февраль",'Март',"Апрель","Май","Июнь","Июль","Август","Сентябрь","Окрябрь","Ноябрь","Декабрь");
			echo "<select name=".$this->name."m ".$this->inner.">";
			echo "<option class='grayfont'>Месяц</option>";
			for($i=1;$i<=12;$i++){
				if($d[1]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>".$mo[$i-1]."</option>";
			};
			echo "</select>&nbsp;";
			echo "<select name=".$this->name."y ".$this->inner.">";
			echo "<option class='grayfont'>Год</option>";
			if ($this->dateend=='') $this->dateend=date("Y")-5;
			for($i=$this->dateend;$i>$this->datebegin;$i--){
				if($d[0]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>$i</option>";
			};
			echo "</select>&nbsp;";
		}
		function error_text(){
			return $this->rule[$this->error];
		}
	};
?>