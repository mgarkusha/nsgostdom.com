<?php if (!defined('SCRIPTACCESS')) exit;
	class psmssender {
		
		public $name;
		public $inner;
		public $MySQLType='VARCHAR(40)';
		
		function display(){
			echo "<input type=text name='".$this->name."' id='".$this->name."'";
			if(!empty($this->inner)) echo " ".$this->inner;
			echo " onkeypress='countchars()' onchange='countchars()' onkeyup='countchars()' onkeydown='countchars()' onfocus='countchars()' value='".htmlspecialchars(vars($this->name))."'>";
			?>
			<script>
				var rus=false;
				function countchars() {
					var s=Array('q','w','e','r','t','y','u','i','o','p','a','s','d','f','g','h','j','k','l','z','x','c','v','b','n','m','Q','W','E','R','T','Y','U','I','O','P','A','S','D','F','G','H','J','K','L','Z','X','C','V','B','N','M','.','+','-','_',',','1','2','3','4','5','6','7','8','9','0');
					
					var txt=document.one.sender.value;
					var length=txt.length;

					var res='';
					for(i=0;i<length;i++){
						c=txt.charAt(i); _in=false;
						for(j=0;j<s.length;j++){ if(s[j]==c) { _in=true;	break; } }
						if(_in) res+=c;
					}
					document.one.sender.value=res;
				}
				countchars();
			</script>
			<?
		}
		
		function work(){
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