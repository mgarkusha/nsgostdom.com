<?
define('MODULE','booking');

include conf::$bpath.'admin/'.MODULE."/db.php";


$rooms = mysql::select("SELECT * FROM `#catalog_rooms`");
$excursions = mysql::select("SELECT * FROM `#excursions`");
$cars = mysql::select("SELECT * FROM `#cars`");