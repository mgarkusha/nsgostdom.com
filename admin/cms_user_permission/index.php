<?
	$_tmp_str_=explode('/',$_SERVER['REQUEST_URI']); 
	define('MODULE',$_tmp_str_=$_tmp_str_[count($_tmp_str_)-2]);

	include '../cms_kernel/conf/conf.php';
	include "db.php";

	//
	if(vars('ch')!=''){
		if(issetvar('r')) $type='read'; else $type='write';
		mysql_query($sql="UPDATE ".conf::$dbprefix."cms_user_permission SET `$type`='".($type=='read'?vars('r'):vars('w'))."' WHERE id=".vars('ch')."");
	}
	//
	$db=mysql_query("SELECT * FROM ".conf::$dbprefix."cms_module WHERE path!=''");
	while($row=mysql_fetch_array($db)){
		$rs=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."cms_user_permission WHERE userid='".vars(MODULE.'f1')."' AND name='".$row['path']."'"));
		if($rs[0]==0){
			$rs2=mysql_fetch_array(mysql_query("SELECT MAX(pos) FROM ".conf::$dbprefix."cms_user_permission"));
			mysql_query($sql="INSERT INTO ".conf::$dbprefix."cms_user_permission VALUES(NULL,'".vars(MODULE.'f1')."','".$row['path']."','','','".($rs2[0]+1)."')");
		}
	}
	$rs=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."cms_user_permission WHERE userid='".vars(MODULE.'f1')."' AND name='files'"));
	if($rs[0]==0){
		$rs2=mysql_fetch_array(mysql_query("SELECT MAX(pos) FROM ".conf::$dbprefix."cms_user_permission"));
		mysql_query($sql="INSERT INTO ".conf::$dbprefix."cms_user_permission VALUES(NULL,'".vars(MODULE.'f1')."','files','','','".($rs2[0]+1)."')");
	}
	$rs=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."cms_user_permission WHERE userid='".vars(MODULE.'f1')."' AND name='cms_setup'"));
	if($rs[0]==0){
		$rs2=mysql_fetch_array(mysql_query("SELECT MAX(pos) FROM ".conf::$dbprefix."cms_user_permission"));
		mysql_query($sql="INSERT INTO ".conf::$dbprefix."cms_user_permission VALUES(NULL,'".vars(MODULE.'f1')."','cms_setup','','','".($rs2[0]+1)."')");
	}
	$rs=mysql_fetch_array(mysql_query("SELECT COUNT(*) FROM ".conf::$dbprefix."cms_user_permission WHERE userid='".vars(MODULE.'f1')."' AND name='cms_opt'"));
	if($rs[0]==0){
		$rs2=mysql_fetch_array(mysql_query("SELECT MAX(pos) FROM ".conf::$dbprefix."cms_user_permission"));
		mysql_query($sql="INSERT INTO ".conf::$dbprefix."cms_user_permission VALUES(NULL,'".vars(MODULE.'f1')."','cms_opt','','','".($rs2[0]+1)."')");
	}
	//

	$t->work();

	define('CONTENT',$t->display());

	include conf::$skin;
?>