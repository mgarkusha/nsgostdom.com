<?php if (!defined('SCRIPTACCESS')) exit;
	#######################################################
	$t=new trecord();
	$t->table=&$t1;
	$t->edit=&$e1;
	$t->work=&$w1;
	$t->list=&$l1;
	#######################################################
	$t1=new ttable();
	$t1->name=conf::$dbprefix.MODULE;
	//$t1->after_store='after_store(#);';
	//$t1->before_store='before_store();';
	#############################################################################
	$p=new paging_();
	$p->name=$t1->name.'_pager';
	$p->sql="SELECT * FROM ".$t1->name." WHERE 1 ORDER BY `id`";
	$p->work();
	#############################################################################
	$e1=new tedit();
	$e1->table=&$t1;
	include conf::$bpath.'admin/'.MODULE.'/fields.php';
	#######################################################
	$l1=new tlist();
	$l1->table=&$t1;
	$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ORDER BY `id` DESC";
	$l1->skin=conf::$bpath.'admin/'.MODULE.'/list.php';
#######################################################
	$w1=new twork();
	$w1->table=&$t1;
	$w1->tree=&$t;

$rooms = mysql::select("SELECT * FROM `#catalog_rooms`");
$excursions = mysql::select("SELECT * FROM `#excursions`");
$cars = mysql::select("SELECT * FROM `#cars`");



$type = $_GET['type'] ? mysql_real_escape_string($_GET['type']) : 'catalog_rooms' ;


$month = $_GET['month'] ? $_GET['month'] : date('m') ;
$year = $_GET['year'] ? $_GET['year'] : date('Y') ;

$join = array(
	'catalog_rooms' =>array(
			'table' => '`#catalog_rooms` b',
			'fields' => 'b.`name` as `value_1`,b.`price` as `value_2`',
			'on' => 'a.`id_room` = b.`id`'
	),
	'cars' =>array(
			'table' => '`#cars` b',
			'fields' => 'b.`name` as `value_1`,b.`price` as `value_2`',
			'on' => 'a.`id_cars` = b.`id`'
	),
	'excursions' =>array(
			'table' => '`#excursions` b',
			'fields' => 'b.`group` as `value_1`,b.`price` as `value_2`',
			'on' => 'a.`id_excursions` = b.`id`'
	),
);

$array = mysql::select($b = "
	SELECT a.*,{$join[$type]['fields']}
	FROM `{$t1->name}` a
	LEFT JOIN {$join[$type]['table']}
	ON {$join[$type]['on']}
	WHERE a.`types` = '$type'
	ORDER BY a.`posted` DESC
");


//////some new features
/*         function after_store(){
            
			//$row = mysql::selectrow("SELECT * FROM `#booking` WHERE `id` = '".(int)$id."'");
			
	 		if(conf::$uside){ 
				$body = 'Поступила новая заявка<br>' .
						'<b>ФИО:</b> '.vars('fio').' <br>'.
						'<b>E-mail:</b> '.vars('email').' <br>'.
						'<b>Телефон:</b> '.vars('phone_number').' <br>'; 
						
 				if (vars('types') == 'catalog_rooms'){
					$option = mysql::selectrow("SELECT `name` FROM `#catalog_rooms` WHERE `id` = ".vars('id_room')."");
					$body .= '<b>Комната:</b> '.$option['name'].' <br>'.
						'<b>Дата заезда:</b> '.vars('dateIn').' <br>'.
						'<b>Дата выезда:</b> '.vars('dateOut').' <br>'.
						'<b>Взрослые:</b> '.vars('persons').' <br>'.
						'<b>Дети:</b> '.vars('kids').' <br>'
						;
				}
				else if (vars('types') == 'excursions'){
					$option = mysql::selectrow("SELECT `title` FROM `#excursions` WHERE `id` = ".vars('id_excursions')."");
						$body .= '<b>Кол-во суток:</b> '.$option['title'].' <br>'.
						'<b>Дата заезда:</b> '.vars('dateIn').' <br>'.
						'<b>Взрослые:</b> '.vars('persons').' <br>'.
						'<b>Дети:</b> '.vars('kids').' <br>'
						;
				}
				else{
					$option = mysql::selectrow("SELECT `name` FROM `#cars` WHERE `id` = ".vars('id_cars')."");
						$body .= '<b>Автомобиль:</b> '.$option['name'].' <br>'.
						'<b>Дата заезда:</b> '.vars('dateIn').' <br>'.
						'<b>Дата выезда:</b> '.vars('dateOut').' <br>'.
						;
				}
				$body .= '<b>Оплата:</b> '.vars('payment').' <br>'; 
				$mails = explode(',',cms::setup_value('mail_order'));
				
				
				foreach($mails as $mail){
				   mail_(
						   trim($mail),
						   'Новая заявка на сайте http://'.$_SERVER['HTTP_HOST'],
						   $body
					   ); 
				}
			 } 
        } */
		
		
////////// end new



//die($b);
//print_r($array);

        /*
        function before_store(){
        	
        }
        
        
        
        if(vars('check')){
            $search = mysql_fetch_array(mysql_query("SELECT `check` FROM `".conf::$dbprefix."order` WHERE `id` = ".(int)vars('check')));
            if($search['check'] == '1'){
                mysql_query("UPDATE `".conf::$dbprefix."order` SET `check` = '' WHERE `id` = '".(int)vars('check')."'");
            }else{
                mysql_query("UPDATE `".conf::$dbprefix."order` SET `check` = '1' WHERE `id` = '".(int)vars('check')."'");
            }
        }
        */