<?php if (!defined('SCRIPTACCESS')) exit;
	class tsort {
		//required
		var $name;
		var $cookie=COO;
		var $fields=array('id');
		var $defaultdirection='ASC';
		//
		function issort($s){
			for($i=0;$i<count($this->fields);$i++){
				//echo $this->fields[$i];
				if($this->fields[$i]==$s){
					//echo '1'; 
					return true;
				}
			}
			return false;
		}
		//
		function href($s){
			return $this->name."=".$s;
		}
		//
		function displaydirection($s){
			if($s==vars($this->name)){
				if(vars($this->name.'d')=="ASC") return "\\/"; else return "/\\";
			}else return "";
		}
		//
		function work(){
			if(vars($this->name)!=''){
				if(vars($this->name)==cooa($this->cookie,$this->name)){
					setcooa($this->cookie,$this->name,vars($this->name));
					if(cooa($this->cookie,$this->name.'d')=='ASC') $st='DESC'; else $st='ASC';
					setcooa($this->cookie,$this->name.'d',$st);
					setvar($this->name.'d',$st);
				}else{
					setcooa($this->cookie,$this->name,vars($this->name));
					setcooa($this->cookie,$this->name.'d',$this->defaultdirection);
					setvar($this->name.'d',$this->defaultdirection);
				}
			}elseif(cooa($this->cookie,$this->name)!=''){
				setvar($this->name,cooa($this->cookie,$this->name));
				setvar($this->name.'d',cooa($this->cookie,$this->name.'d'));
			}
			if(vars($this->name)==''){
				setvar($this->name,$this->fields[0]);
				setvar($this->name.'d',$this->defaultdirection);
			}
		}
		function sql(){
			return ' '.vars($this->name).' '.vars($this->name.'d');
		}
	};
?>