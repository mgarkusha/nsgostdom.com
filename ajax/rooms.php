<?php
session_start();
define('SCRIPTACCESS', true);
chdir($_SERVER['DOCUMENT_ROOT'].'/');
include 'kernel/main/conf.php';

$days = array();
$room = (int)$_POST['room'];
$records = mysql::select("SELECT `dateIn`,`dateOut` FROM `#booking` WHERE `types` = 'catalog_rooms' AND `id_room` = $room AND `status` = '2'");

foreach($records as $row){
    $start = strtotime($row['dateIn']);
    $end = strtotime($row['dateOut']);
    
    while(1){
        $tmp = date('d.m.Y',$start);
        if(!in_array($tmp, $days)){
            $days[] = $tmp;
        }
        
        if($start >= $end){
            break;
        }
        
        $start += (60*60*24);
    }
    
}

die(json_encode(array(
    'days' => $days,
)));







$rooms_free = mysql::select("SELECT * FROM `#booking`");


$in = date('Y-m-d',strtotime($_POST['in']));
$out = date('Y-m-d',strtotime($_POST['out']));

foreach ($rooms_free as $row) {
    if($row['status'] != 2){
        $response[]['options'] = '<option value="' . $row['id'] . '">' . $row['name'] . ' - ' . $row['price'] . '</option>';
    }

}

    die(json_encode(
        $response
    ));
