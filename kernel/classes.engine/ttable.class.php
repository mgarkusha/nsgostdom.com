<?php if (!defined('SCRIPTACCESS')) exit;
	class ttable {
		// required
		var $name;
		var $fields;
		// optional
		var $primary='id';
		var $pos;
		var $pkey;
		var $ctable;
		var $filtersql;
		var $msg=array(
			's'=>"Данные успешно обновлены",
			'n'=>"Новая запись добавлена",
			'd'=>"Запись удалена"
		);
		//
		function store(){
			if(!empty($this->before_store)) eval($this->before_store);
			if(vars('e')=='n'){
				$db=mysql_query('SHOW COLUMNS FROM '.$this->name);
				$i=2;
				$s='';
				while ($row = mysql_fetch_assoc($db)) {
					if($row['Field']==$this->primary) continue;
					if(isset($this->fields[$row['Field']]->selfstore)) continue;
					//
					if($row['Field']==$this->pos){
						$sql="SELECT MAX(".$this->pos.") FROM ".$this->name;
						$row2=mysql_fetch_array(mysql_query($sql));
					 	$s.="'".($row2[0]+1)."'";
						setvar($this->pos,($row2[0]+1));
					}else{;
						$s.="''";
					};
					if($i<mysql_num_rows($db)) $s.=",";
					$i++;
    			};
				$sql="INSERT INTO ".$this->name." VALUES(NULL,".$s.")";
				//echo $sql; exit;
				mysql_query($sql);
				setvar('e',mysql_insert_id());
				setvar('en','1');
				//
				$e_id=vars('e');
				if((int)$e_id>0){
					for($i=0;$i<count($this->fields);$i++){
						if(isset($this->fields[$i]->selfstore)){
							$this->fields[$i]->store();
							continue;
						}
						$sql="UPDATE ".$this->name." SET `".$this->fields[$i]->name."`='".addslashes(vars($this->fields[$i]->name))."' WHERE ".$this->primary."='".addslashes((int)vars('e'))."'";
						mysql_query($sql);
						//echo $sql."<br>";
					};
					//exit;
				};
			}else{
				$e_id=(int)vars('e');
				if((int)$e_id>0){
					for($i=0;$i<count($this->fields);$i++){
						if(isset($this->fields[$i]->selfstore)){
							$this->fields[$i]->store();
							continue;
						}
						$sql="UPDATE ".$this->name." SET `".$this->fields[$i]->name."`='".addslashes(vars($this->fields[$i]->name))."' WHERE ".$this->primary."='".vars('e')."'";
						//echo $sql."<br>";
						mysql_query($sql);
					};
				};
			};
			if(!empty($this->after_store)) eval(str_replace("#",vars('e'),$this->after_store));
		}
		//
		function delete($id){
			if((int)$id<=0) return;
			for($i=0;$i<count($this->fields);$i++){
				if($this->fields[$i]->selfstore){
					$this->fields[$i]->delete();
				}
			};
			if(!empty($this->del_fields)){
				for($i=0;$i<count($this->del_fields);$i++){
					$this->del_fields[$i]->delself($id);
				};
			};
			if(!empty($this->before_delete)) eval(str_replace("#",$id,$this->before_delete));
			$sql="DELETE FROM ".$this->name." WHERE ".$this->primary."='".$id."'";
			mysql_query($sql);
			//echo $sql."<br>";
			if(isset($this->ctable)){
				if(is_array($this->ctable)){
					for($i=0;$i<count($this->ctable);$i++){
						$sql="SELECT ".$this->ctable[$i]->primary." FROM ".$this->ctable[$i]->name." WHERE ".$this->ctable[$i]->pkey."='".$id."'";
						$db=mysql_query($sql);
						while($row=mysql_fetch_array($db)){
							$this->ctable[$i]->delete($row[$this->ctable[$i]->primary]);
						}
					}
				}else{
					$sql="SELECT ".$this->ctable->primary." FROM ".$this->ctable->name." WHERE ".$this->ctable->pkey."='".$id."'";
					$db=mysql_query($sql);
					while($row=mysql_fetch_array($db)){
						$this->ctable->delete($row[$this->ctable->primary]);
					}
				}
			};
			
		}
		//
		function check_self(){
			// Создать таблицу, если она не существует в базе
			$a=mysql_list_tables(conf::$dbname);
			$e=false;
			while($row=mysql_fetch_array($a)){
				if($row[0]==$this->name) {$e=true; break;};
			};
			if(!$e){
				$s="CREATE TABLE ".$this->name." (\n";
				$s.="  `".$this->primary."` int(11) PRIMARY KEY auto_increment,\n";
				$i=1;
				for($i=0;$i<count($this->fields);$i++){
					if(isset($this->fields[$i]->selfstore)) continue;
					$s.="  `".$this->fields[$i]->name."` ".$this->fields[$i]->MySQLType;
					if($i<count($this->fields)-1) $s.=",\n"; else $s.="\n";
				};
		    	$s.=")"; // ENGINE=MyISAM DEFAULT CHARSET=cp1251";
				echo "<pre>".$s."</pre><br>";
    		   	mysql_query($s);
			};
			//
			for($i=0;$i<count($this->fields);$i++){
				if(isset($this->fields[$i]->selfstore)) continue;
				$f=false;
				$db=mysql_query('SHOW COLUMNS FROM '.$this->name);
				while ($row = mysql_fetch_assoc($db)) {
					if($row['Field']==$this->fields[$i]->name){
						$f=true;
						break;
					};
				};
				if(!$f){
					$s="ALTER TABLE `".$this->name."` ADD `".$this->fields[$i]->name."` ".$this->fields[$i]->MySQLType." ;";
					mysql_query($s);
					echo "<pre>".$s."</pre>";
				}else{
					$tf=false;
					if(ereg('varchar',strtolower($row['Type']))){
						if(	strtolower($this->fields[$i]->MySQLType)!=strtolower($row['Type'])
							&& strtolower($this->fields[$i]->MySQLType)!=str_replace('varchar','char',strtolower($row['Type']))
						) $tf=true;
					}elseif(ereg('char',strtolower($row['Type']))){
						if(	strtolower($this->fields[$i]->MySQLType)!=strtolower($row['Type'])
							&& strtolower($this->fields[$i]->MySQLType)!=str_replace('char','varchar',strtolower($row['Type']))
						) $tf=true;
					}elseif(strtolower($this->fields[$i]->MySQLType)!=strtolower($row['Type'])) $tf=true;
					if($tf){
						$sql="ALTER TABLE `".$this->name."` CHANGE `".$this->fields[$i]->name."` `".$this->fields[$i]->name."` ".$this->fields[$i]->MySQLType;
						echo "<pre>".$sql."</pre>";
						mysql_query($sql);
					};
				};
			};
			// удалить из таблицы лишние поля
			/*$db=mysql_query('SHOW COLUMNS FROM '.$this->name);
			while ($row = mysql_fetch_assoc($db)) {
				$f=false;
				for($i=0;$i<count($this->fields);$i++){
					if($row['Field']==$this->fields[$i]->name){
						$f=true;
						break;
					};
				};
				if(!$f){
					$s="ALTER TABLE `".$this->name."` ADD `".$this->fields[$i]->name."` ".$this->fields[$i]->MySQLType." ;";
					mysql_query($s);
					echo "<pre>".$s."</pre>";
				};
			};*/
		}
		function moverecord($direction=false){
			if($direction=='up') {$c='<'; $s="DESC";} else {$c=">"; $s="ASC";};
			$sql="SELECT ".$this->pos." FROM ".$this->name." WHERE ".$this->primary."=".(int)vars('k');
			$sql.=" ".$this->filtersql;
			//echo $sql."<br>";
			$row=mysql_fetch_array(mysql_query($sql));
			$sql="SELECT ".$this->pos.",".$this->primary." FROM ".$this->name." WHERE ".$this->pos.$c.$row[$this->pos];
			$sql.=" ".$this->filtersql;
			$sql.=" ORDER BY ".$this->pos." $s LIMIT 0,1";
			//echo $sql."<br>";
			$row2=mysql_fetch_array(mysql_query($sql));
			if(!empty($row2[$this->pos])){
				$sql="UPDATE ".$this->name." SET ".$this->pos."=".$row2[$this->pos]." WHERE ".$this->primary."=".(int)vars('k');
				//echo $sql."<br>";
				mysql_query($sql);
				$sql="UPDATE ".$this->name." SET ".$this->pos."=".$row[$this->pos]." WHERE ".$this->primary."=".$row2[$this->primary];
				//echo $sql."<br>";
				mysql_query($sql);
			};
		}
	};
?>