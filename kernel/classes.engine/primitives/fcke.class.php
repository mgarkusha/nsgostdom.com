<?php if (!defined('SCRIPTACCESS')) exit;
	class fcke_ {
		var $name;
		var $width=700;
		var $height=300;
		var $toolbar='Basic';
		var $MySQLType='longtext';
		function set_permission(){
			/*global $_COOKIE;
			if($this->permission=='allow'){
				setcookie('_permission_','allow',0,'/');
				$_COOKIE['_permission_']='allow';
			}else{
				setcookie('_permission_','deny',0,'/');
				$_COOKIE['_permission_']='deny';
			};*/
		}
		function display(){
			include_once( KPATH.ROOT."kernel/fcke/fckeditor.php");
			$sBasePath = KPATH.ROOT.'kernel/fcke/';
			global $_useradmin_;
			global $_userperm_;
			//if((!$_useradmin_ && !$_userperm_) || ($_useradmin_ || $_userperm_[MODULE]['write']=='1')){
			if(coo('_file_rw_perm_')=='allow') $str='1'; else $str='2';
			//
			$f=fopen(KPATH.ROOT.'kernel/fcke/fckconfig.js','r');
			$s=fread($f,filesize(KPATH.ROOT.'kernel/fcke/fckconfig.js'));
			fclose($f);
			$s=ereg_replace('ma2;//REPLACE','ma'.$str.';//REPLACE',$s);
			$s=ereg_replace('ma1;//REPLACE','ma'.$str.';//REPLACE',$s);
			$f=fopen(KPATH.ROOT.'kernel/fcke/fckconfig.js','w');
			fwrite($f,$s);
			fclose($f);
			//
			$oFCKeditor = new FCKeditor($this->name,$this) ;
			$oFCKeditor->Config['SkinPath'] = 'skins/default/' ;
			$oFCKeditor->BasePath	= $sBasePath ;
			$oFCKeditor->Value		= vars($this->name);
			echo "<table border=0 cellpadding=0 cellspacing=0 width=".$this->width." height=".$this->height."><tr><td>";
			$oFCKeditor->Create() ;
			echo "</td></tr></table>";
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
		//
		function error_text(){
			return $this->rule[$this->error];
		}
	};
?>