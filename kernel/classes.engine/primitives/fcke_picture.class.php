<?php if (!defined('SCRIPTACCESS')) exit;
	class fcke_picture_ {
		// required
		var $name;
		// optional
		var $inner;
		var $maxlength=128;
		var $size=60;
		var $rule;
		var $error='none';
		//
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(vars($this->name)==''){
						$this->error=$name;
						return false;
					};
				};
				if($name=='email'){
					if(!is_email(vars($this->name))){
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
			echo "<input type=text name='".$this->name."' value=\"".htmlspecialchars(vars($this->name))."\"";
			if($this->size!='') echo " size=".$this->size;
			if($this->maxlength!='') echo " maxlength=".$this->maxlength;
			if($this->inner!='') echo " ".$this->inner;
			echo ">&nbsp;&nbsp; <a href='javascript:open_dialog_".$this->name."();' class=link>Смотреть на сервере</a>";
			?><script>
			function open_dialog_<? echo $this->name; ?>(){
				mywin=open('<?echo KPATH.ROOT?>kernel/fcke/editor/filemanager/browser/default/browser.html?Connector=connectors/php/connector.php&receiver=<? echo $this->name; ?>', 'displaywindow', 'width=700, height=500,resizable=no');
			};
			</SCRIPT><?
			global $_fcke_picture_tmp;
			if(!$_fcke_picture_tmp){
				?><script>
					function SetUrl(value,receiver){
						if(document.all) document.all(receiver).value=value; else document.getElementById(receiver).value=value;
					};
				</script><?
			};
			$_fcke_picture_tmp=true;
		}
		function href(){
			$a=vars($this->name);
			$a=trim($a);
			if(!ereg('http://',$a)) $a="http://".$a;
			echo "<a target='_blank' class=sysnav href='".$a."'>".$a."</a>";
		}
	};
?>