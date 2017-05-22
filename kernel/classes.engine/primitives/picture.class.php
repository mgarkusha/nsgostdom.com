<?php if (!defined('SCRIPTACCESS')) exit;
	class picture_ {
		// required
		var $name;
		var $path;
		// optional
		var $inner;
		var $size;
		var $rule;
		var $error='none';
		//
		function work(){
			global $_FILES;
			if(empty($this->rule)) return true;
			if($_FILES[$this->name]["name"]=='') return true;
			foreach($this->rule as $name => $value){
				if($name=='size0'){
					if($_FILES[$this->name]["size"]==0){;
						$this->error=$name;
						return false;
					};
				};
				if($name=='size'){
					if($_FILES[$this->name]["size"]>$this->max_size){
						$this->error=$name;
						return false;
					};
				};
				if($name=='ext'){
					$t=explode('.',$_FILES[$this->name]['name']);
					$ext=$t[count($t)-1];
					if($ext!='jpg' && $ext!='gif'){ 
						$this->error=$name; 
						return false;
					};
				};
			};
			setvar($this->name,'replace');
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			echo "<input type=file name=".$this->name;
			if($this->size!='') echo " size=".$this->size;
			if($this->inner!='') echo " ".$this->inner;
			echo ">";
		}
		function display2(){
			if(vars('e')!='n') $row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
			if($row[$this->name]=='' || vars('e')=='n'){
				echo "<font class=systext>Нет изображения</font>";
			}else{
				echo "<a href='?e=".vars('e')."&rempic=".$this->name."' class=sysnav>Удалить</a>";
				if($this->display_pic){
					echo "<br>";
					echo "<img src='".conf::$bpath.PICPATH.$row[$this->name]."' hspace=5 vspace=5>";
				}else{
					echo "&nbsp;<a href='javascript: ".cr_href(PICPATH.$row[$this->name])."' class=sysnav>Посмотреть</a>";
				};
			};
		}
		//
		function write_file(){
			if(vars($this->name)=='replace'){
				if(vars('e')!='n'){
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
					if(!empty($row[$this->name])) unlink(conf::$bpath.PICPATH.$row[$this->name]);
				};
				//srand((double)microtime()*10000000000);
				//$uid=rand(10000000,99999999).time();
				//$uid=md5($uid);
				$t=explode('.',$_FILES[$this->name]['name']);
				$ext=$t[count($t)-1];
				//
				if(file_exists(conf::$bpath.PICPATH.$this->path.'name.php')){
					$f=fopen(conf::$bpath.PICPATH.$this->path.'name.php','rb+');
					$uid=fgets($f);
					fclose($f);
				}else{
					$f=fopen(conf::$bpath.PICPATH.$this->path.'name.php','wb+');
					fwrite($f,'1');
					fclose($f);
					$uid=1;
				};
				while(true){
					if(file_exists(conf::$bpath.PICPATH.$this->path.($uid+1).".".$ext)){
						$uid++;
						continue;
					}else{
						$uid++;
						$f=fopen(conf::$bpath.PICPATH.$this->path.'name.php','wb+');
						fwrite($f,(string)$uid);
						fclose($f);
						break;
					};
				};
				//
				copy($_FILES[$this->name]['tmp_name'],conf::$bpath.PICPATH.$this->path.$uid.".".$ext);
				setvar($this->name,$this->path.$uid.".".$ext);
			}else{
				if(vars('e')!='n'){
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
					setvar($this->name,$row[$this->name]);
				};
			};
		}
		//
		function rempic(){
			if(vars('rempic')==$this->name){
				$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
				if(!empty($row[$this->name])) unlink(conf::$bpath.PICPATH.$row[$this->name]);
				mysql_query($this->delete_sql);
			};
		}
		//
		function delself($id){
			$row=mysql_fetch_array(mysql_query(ereg_replace("#1",$id,$this->select_sql)));
			if(!empty($row[$this->name])) unlink(conf::$bpath.PICPATH.$row[$this->name]);
		}
	};
?>