<?php if (!defined('SCRIPTACCESS')) exit;
	class cms {
		
		public static function get_older_parent($p){
			$db=mysql_fetch_object(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".addslashes($p)."'"));
			if($db->parent==0) return $p;
			else return cms::get_older_parent($db->parent);
		}
		
		public static function get_1st_parent($p){
			$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".addslashes($p)."'"));
			return (int)$db['parent'];
		}
		
		public static function get_1st_child($p){
			$db=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE parent='".addslashes($p)."' ORDER BY pos LIMIT 0,1"));
			return (int)$db['id'];
		}
		
		public static function count_child($p){
			if($p==0) return 0;
			$db=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."sitemap WHERE parent='".addslashes($p)."'"));
			return (int)$db[0];
		}
		
		function sitemap_path($path){
                    global $hash;
                        if(isset($hash["/" . $path])) {
                            $path = $hash["sm_" . $path];
                        } else {
                            $alm=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id='".addslashes($path)."' "));
                            if($alm['alias']!='') $path=$alm['alias'];
                        }
			return conf::$hpath.$path.'/';
		}
		
		function display_content($id,$name = false){
			$row=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."texts WHERE id='".addslashes($id)."'"));
			if($name){
				return $row['name'];
			}
			return $row['text'];
		}
		function module_name($module){
			$dbs_ = mysql_query("SELECT * FROM ".conf::$dbprefix."cms_module WHERE path='".addslashes($module)."'");
			$rs=mysql_fetch_array($dbs_);
			return $rs['name'];
		}	

		function setup_value($key){
			$r=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."cms_setup WHERE `key`='".addslashes($key)."'"));
			return $r['value'];
		}		
                function cms_key($val) {
                        return base64_decode($val);
                }
			
	function get_array_parent($p){
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
	};
	
	
//	function out_nav($p,$out=true){
//		global $_fpath_;
//		$pt=get_array_parent($p);
//		$txtn[]=link_(sitemap_path($_fpath_),'Главная','nav');
//		$db=mysql_query("SELECT * FROM ".conf::$dbprefix."sitemap WHERE id IN (".implode(',',$pt).") AND id NOT IN (".$_fpath_.")");
//		while($row=mysql_fetch_array($db)){
//			$txtn[]=link_(sitemap_path($row['id']),$row['name'],'nav');
//		}
//		$txt='<table border="0" cellpadding="0" cellspacing="0"><tr>';
//		$txt.='<td>'.implode('</td><td class=nav style="text-decoration:none;">&nbsp;/&nbsp;</td><td>',$txtn).'</td>';
//		$txt.='</tr></table>';
//		echo $txt;
//		if ($out){
//			//return $txt;
//		}
//	}

// 
?>