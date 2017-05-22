<?
	class filter1_ {
		//required
		var $name;
		var $cookie;
		//
		function display(){
			echo "Выводить: ";
			echo "<select class=f_select name=".$this->name." onchange='document.one.submit();'>";
			$lst=array('1'=>'Отображаемые','2'=>'Не отображаемые');
			echo "<option value=all>Все</option>";
			foreach($lst as $key=>$value){
				if(vars($this->name)==$key) $sel='selected'; else $sel='';
				echo "<option value=$key $sel>$value</option>";
			};
			echo "</select>";
		}
		//
		function work(){
			if(vars($this->name)!='') setcooa($this->cookie,$this->name,vars($this->name));
			else if(cooa($this->cookie,$this->name)!='') setvar($this->name,cooa($this->cookie,$this->name));
			if(vars($this->name)=='') setvar($this->name,'all');
		}
		function sql(){
			if(vars($this->name)=='all') return '';
			elseif(vars($this->name)=='2') return " AND display=''";
			elseif(vars($this->name)=='1') return " AND display='1'";
			else return '';
		}
	};
?>