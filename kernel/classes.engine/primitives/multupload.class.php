<?php if (!defined('SCRIPTACCESS')) exit;
	class multupload_ {
		// required
		var $name;
		var $path;
		var $filenamefield;
		//
		var $ext=array('');
		var $inner;
		var $size=64;
		var $max_size=2000000;
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
			if(isset($this->filenamefield)) setvar($this->filenamefield,$_FILES[$this->name]['name']);
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
			$this->select_sql="SELECT * FROM ".$this->table." WHERE ".$this->parent."=#1";
			if(vars('e')!='n'){
				$db=mysql_query(ereg_replace("#1",vars('e'),$this->select_sql));
				$cnt=mysql_num_rows($db);
			}else{
				$cnt=0;
			}
			if($cnt==0 || vars('e')=='n'){
				echo "<div><font class=text> нет файла</font></div>";
			}else{
				echo '<div style="overflow: auto; width: 300px; height: 60px; border: solid 1px #000000;" nowrap>';
				echo '<table border="0" cellpadding="0" cellspacing="0">';
				while ($row=mysql_fetch_array($db)){
					echo "<tr><td style='padding: 5px;' align=left><a href='".KPATH.ROOT.$this->path.$row[$this->name]."' class=link target=_blank>".$row[$this->filenamefield]."</a></td>";
					echo "<td style='padding: 5px;' align=left><a onclick=\"javascript: return(confirm('Вы уверены?'));\" href='?e=".vars('e')."&rempic=".$this->name."&remid=".$row['id']."' class=link>удалить</a></td></tr>";
				}
				echo "<tr><td colspan=2 style='padding: 5px;' align=left><a onclick=\"javascript: return(confirm('Вы уверены?'));\" href='?e=".vars('e')."&rempic=".$this->name."&remid=all' class=link>удалить все</a></td></tr>";
				echo '</table>';
				echo '</div>';
			};
		}
		//
		function write_file($id){
			if(vars($this->name)=='replace'){
				if(vars('e')!='n'){
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('e'),$this->select_sql)));
					if(!empty($row[$this->name])) unlink(KPATH.ROOT.$this->path.$row[$this->name]);
				}; 
				$t=explode('.',$_FILES[$this->name]['name']);
				$ext=$t[count($t)-1];
				//
				if(file_exists(KPATH.ROOT.$this->path.'name.php')){
					$f=fopen(KPATH.ROOT.$this->path.'name.php','rb+');
					$uid=fgets($f);
					fclose($f);
				}else{
					$f=fopen(KPATH.ROOT.$this->path.'name.php','wb+');
					fwrite($f,'1');
					fclose($f);
					$uid=1;
				};
				while(true){
					if(file_exists(KPATH.ROOT.$this->path.($uid+1).".".$ext)){
						$uid++;
						continue;
					}else{
						$uid++;
						$f=fopen(KPATH.ROOT.$this->path.'name.php','wb+');
						fwrite($f,(string)$uid);
						fclose($f);
						break;
					};
				};
				//
				copy($_FILES[$this->name]['tmp_name'],KPATH.ROOT.$this->path.$uid.".".$ext);
				setvar($this->name,$uid.".".$ext);
				mysql_query($q="INSERT INTO ".$this->table." (`".$this->filenamefield."` , `".$this->name."` , `".$this->parent."`) VALUES('".vars($this->filenamefield)."','".vars($this->name)."' , '".$id."')");
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
			$db=mysql_query("SELECT ".$this->name." FROM ".$this->table." WHERE `".$this->parent."`='".vars('e')."'");
			if(vars('rempic')==$this->name){
				if (vars('remid')=='all'){
					while ($row=mysql_fetch_array($db)){
						if(!empty($row[$this->name])) unlink(KPATH.ROOT.$this->path.$row[$this->name]);
					}
					mysql_query("DELETE FROM ".$this->table." WHERE `".$this->parent."`='".vars('e')."'");
				}else{
					$row=mysql_fetch_array(mysql_query(ereg_replace("#1",vars('remid'),$this->select_sql)));
					if(!empty($row[$this->name])) unlink(KPATH.ROOT.$this->path.$row[$this->name]);
					mysql_query("DELETE FROM ".$this->table." WHERE `id`='".vars('remid')."'");
				}
			};
		}
		//
		function delself($id){
			$this->select_sql="SELECT ".$this->name." FROM ".$this->table." WHERE `".$this->parent."`=#1";
			$db=mysql_query(ereg_replace("#1",$id,$this->select_sql));
			while ($row=mysql_fetch_array($db)){
				if(!empty($row[$this->name])) unlink(KPATH.ROOT.$this->path.$row[$this->name]);
			}
			mysql_query("DELETE FROM ".$this->table." WHERE `".$this->parent."`='".$id."'");
		}
	};
?>