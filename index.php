<?
if($_SERVER['HTTP_HOST'] != 'nsgostdom.com'){
	header('location: http://nsgostdom.com/'.$_SERVER['REQUEST_URI']);
	exit;
}
include 'kernel/main/page.php';

