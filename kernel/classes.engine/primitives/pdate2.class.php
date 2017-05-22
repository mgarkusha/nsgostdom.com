<?php if (!defined('SCRIPTACCESS')) exit;
	class pdate2 {
		var $name;
		var $inner;
		var $datebegin=1930;
		var $dateend;
		
		function work(){
			setvar($this->name,vars($this->name.'y')."-".vars($this->name.'m').'-'.vars($this->name.'d'));
			if (vars($this->name)!='--')setcoo($this->name,vars($this->name));
			return true;
		}
		function display(){
			if(vars($this->name)==''){
				setvar($this->name,vars($this->name.'y')."-".vars($this->name.'m').'-'.vars($this->name.'d'));
			}
			//setvar($this->name,coo($this->name));
			//if((coo($this->name)=='--'||coo($this->name)=='')) setvar($this->name,'--');
			//else setvar($this->name,coo($this->name));
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
			echo "<select name=".$this->name."y ".$this->inner." onchange='date_class_change".$this->name."();'>";
			echo "<option value=0> -- </option>";
			if ($this->dateend=='') $this->dateend=date("Y")-5;
			for($i=$this->datebegin;$i<$this->dateend;$i++){
				if($d[0]==$i) $sel='selected'; else $sel='';
				echo "<option value=$i $sel>".$i."</option>";
			};
			echo "</select>&nbsp;";
			echo "
				<script>
					function date_class_change".$this->name."(){
						if(document.".$this->form.".".$this->name."y.options[0].selected){
							document.".$this->form.".".$this->name."m.disabled=true;
							document.".$this->form.".".$this->name."d.disabled=true;
						}else{
							document.".$this->form.".".$this->name."m.disabled=false;
							document.".$this->form.".".$this->name."d.disabled=false;
						};
					};
					date_class_change".$this->name."();
				</script>
			";
		}
	};
?>