<?php if (!defined('SCRIPTACCESS')) exit;
	class upload2 {
		// required
		var $name;
		var $path;
		var $filenamefield;
		//
		var $ext=array('mp3');
		var $inner;
		var $size=64;
		var $max_size=2000000000000;
		var $rule=array(
			'size0'=>'Ошибка! Размер загруженного файла 0 байт.',
			'size'=>'Размер файла не должен превышать 10 мб.',
			'ext'=>'Недопустимое расширение файла.'
		);
		var $error='none';
		var $MySQLType='varchar(255)';
		//
		function work(){
			global $_FILES;
			if(empty($this->rule)) return true;
			if($_FILES[$this->name]["name"]=='') return true;
			if(isset($this->filenamefield)) setvar($this->filenamefield,$_FILES[$this->name]['name']);
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
					$flg=false;
					for($i=0;$i<count($this->ext);$i++){
						if($this->ext[$i]==strtolower($ext)){
							$flg=true; break;
						}
					};
					if(!$flg){
						$this->error=$name; 
						return false;
					}
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
			$this->select_sql="SELECT * FROM ".$this->table." WHERE id=#1";
			if(vars('e')!='n') $row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
			if($row[$this->name]=='' || vars('e')=='n'){
				echo "<font class=text> нет файла</font>";
			}else{
				echo "&nbsp;<a href='".(conf::$bpath.$this->path.vars($this->name))."' class=link>".$row[$this->filenamefield]."</a>";
				echo " &nbsp; <a href='?e=".vars('e')."&rempic=".$this->name."' class=link>удалить</a>";
			};
		}
		//
		function write_file(){
			if(vars($this->name)=='replace'){
				if(vars('e')!='n'){
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
					if(!empty($row[$this->name])) unlink(conf::$bpath.$this->path.$row[$this->name]);
				}; 
				$t=explode('.',$_FILES[$this->name]['name']);
				$ext=$t[count($t)-1];
				//
				if(file_exists(conf::$bpath.$this->path.'name.php')){
					$f=fopen(conf::$bpath.$this->path.'name.php','rb+');
					$uid=fgets($f);
					fclose($f);
				}else{
					$f=fopen(conf::$bpath.$this->path.'name.php','wb+');
					fwrite($f,'1');
					fclose($f);
					$uid=1;
				};
				while(true){
					if(file_exists(conf::$bpath.$this->path.($uid+1).".".$ext)){
						$uid++;
						continue;
					}else{
						$uid++;
						$f=fopen(conf::$bpath.$this->path.'name.php','wb+');
						fwrite($f,(string)$uid);
						fclose($f);
						break;
					};
				};
				//
				copy($_FILES[$this->name]['tmp_name'],conf::$bpath.$this->path.$uid.".".$ext);
				setvar($this->name,$uid.".".$ext);
			}else{
				if(vars('e')!='n'){
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
					setvar($this->name,$row[$this->name]);
				};
			};
		}
		//
		function rempic(){
			$this->select_sql="SELECT ".$this->name." FROM ".$this->table." WHERE id=#1";
			$this->delete_sql="UPDATE ".$this->table." SET ".$this->name."='' WHERE id=".vars('e');
			if(vars('rempic')==$this->name){
				$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
				if(!empty($row[$this->name])) unlink(conf::$bpath.$this->path.$row[$this->name]);
				mysql_query($this->delete_sql);
			};
		}
		//
		function delself($id){
			$this->select_sql="SELECT ".$this->name." FROM ".$this->table." WHERE id=#1";
			$row=mysql_fetch_array(mysql_query(ereg_replace("#1",$id,$this->select_sql)));
			if(!empty($row[$this->name])) unlink(conf::$bpath.$this->path.$row[$this->name]);
		}
	};
?>