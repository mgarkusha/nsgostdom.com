<?
	$_tmp_str_=explode('/',$_SERVER['REQUEST_URI']);
	define('MODULE',$_tmp_str_=$_tmp_str_[count($_tmp_str_)-2]);

	include '../cms_kernel/conf/conf.php';

	include "db.php";

	$t->work();

	define('CONTENT',$t->display());

	include conf::$skin;
?>