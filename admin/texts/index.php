<?
	define('MODULE','texts');
	include '../cms_kernel/conf/conf.php';

	include "db.php";

	$t->work();

	define('CONTENT',$t->display());

	include conf::$skin;
?>