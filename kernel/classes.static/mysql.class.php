<?php if (!defined('SCRIPTACCESS')) exit;
	class mysql {
		public static $lastparsedsql;
		
		// анеалог mysql_query("SELECT * FROM ?sometable WHERE somefields=? AND somefield2 LIKE '?%'");
		public static function query($sql,$param=false){
			$sql=mysql::parse($sql,$param); 
			if(!$sql) return false;
			return mysql_query($sql);
		}
		
		// аналог mysql_fetch_assoc($db)		
		public static function fetch($db){
			return mysql_fetch_assoc($db);
		}
		
		// возвращает все строки ассоциативным массивом
		public static function select($sql,$param=false){
			if($db=mysql::query($sql,$param)){
				$rows=array();
				while($row=mysql::fetch($db)){
					$rows[]=$row;
				}
			}else return false;
			return $rows;
		}
		
		// возвращает одну строку ассоциативным массивом
		public static function selectrow($sql,$param=false){
			if($db=mysql::query($sql,$param)){
				return mysql::fetch($db);
			}else return false;
		}
		
		protected function parse($sql,$param=false) {
			$sql=str_replace('#',addslashes(conf::$dbprefix),$sql);
			if(!$param){
				mysql::$lastparsedsql=$sql;
				return $sql;
			}
			if(!is_array($param)) $param=array($param);
			$i=0;
			$offset=0;
			while(true){
				$p=strpos($sql,'?',$offset);
				if($p===false) break;
				$sql=substr($sql,0,$p).addslashes($param[$i]).substr($sql,$p+1);
				$offset=(int)($p+strlen(addslashes($param[$i])));
				$i++;
			}
			mysql::$lastparsedsql=$sql;
			return $sql;
		}
		
		public static function insert_record($table,$values,$pos=false){
			$db=mysql_query('SHOW COLUMNS FROM '.$table);
			$i=2;
			$s='';
			while ($row = mysql_fetch_assoc($db)) {
				if($row['Field']=='id') continue;
				if($pos && $row['Field']==$pos){
					$sql="SELECT MAX(".$pos.") FROM ".$table;
					$row2=mysql_fetch_array(mysql_query($sql));
					$s.="'".($row2[0]+1)."'";
				}else{
					$s.="''";
				};
				if($i<mysql_num_rows($db)) $s.=",";
				$i++;
    		};
			$sql="INSERT INTO ".$table." VALUES(NULL,".$s.")";
			//echo $sql."<br>";
			mysql_query($sql);
			$id=mysql_insert_id();
			foreach($values as $key=>$value){
					$sql="UPDATE ".$table." SET `".$key."`='".addslashes($value)."' WHERE id='".$id."'";
					//echo $sql."<br>";
					mysql_query($sql);
			};
		}

		public static function exist_record($table,$key,$value){
			$r=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".$table." WHERE `$key`='".addslashes($value)."'"));
			return $r[0];
		}

		public static function get_parent($p){
			$db=mysql_fetch_object(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".$p."'"));
			if($db->parent==0){
				//global $_parent_;
				//$_parent_= $p;
				//return $_parent_;
				//define('_PARENT_',$p);
				return $p;
			}else return mysql::get_parent($db->parent);
		}

		public static function get_1st_parent($p){
			$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".$p."'"));
			return (int)$db['parent'];
		}

		public static function get_1st_child($p){
			$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE parent='".$p."' ORDER BY pos LIMIT 0,1"));
			return (int)$db['id'];
		}

		public static function get_array_parent($p){
			$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".$p."' ORDER BY pos LIMIT 0,1"));
			$res[]=$p;
			$db=mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".$db['parent']."' ORDER BY pos LIMIT 0,1");
			while (mysql_num_rows($db)!=0){
				$rw=mysql_fetch_array($db);
				$res[]=$rw['id'];
				$db=mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".$rw['parent']."' ORDER BY pos LIMIT 0,1");
			}
			for ($i=(count($res)-1);$i>=0;$i--)
				$out[]=$res[$i];
			return $out;
		}

		public static function out_nav($p,$out=true){
			global $_fpath_;
			$pt=get_array_parent($p);
			$txtn[]=link_(sitemap_path($_fpath_),'Главная','nav');
			$db=mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id IN (".implode(',',$pt).") AND id NOT IN (".$_fpath_.")");
			while($row=mysql_fetch_array($db)){
				$txtn[]=link_(sitemap_path($row['id']),$row['name'],'nav');
			}
			$txt='<table border="0" cellpadding="0" cellspacing="0"><tr>';
			$txt.='<td>'.implode('</td><td class=nav style="text-decoration:none;">&nbsp;/&nbsp;</td><td>',$txtn).'</td>';
			$txt.='</tr></table>';
			echo $txt;
			if ($out){
				//return $txt;
			}
		}

		public static function count_child($p){
			if($p==0) return 0;
			$db=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."sitemap WHERE parent='".$p."'"));
			return (int)$db[0];
		}
	}
?>