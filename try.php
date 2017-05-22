<?php 
define('SCRIPTACCESS', true);
ini_set('display_errors', 1);
include('kernel/main/conf.php');
				$row = mysql::selectrow("SELECT * FROM `#booking` WHERE `id` = 51");
				$body = 'Поступила новая заявка<br>'.
                        '<b>ФИО:</b> '.$row['fio'].' <br>'.
                        '<b>E-mail:</b> '.$row['email'].' <br>'.
                        '<b>Телефон:</b> '.$row['phone_number'].' <br>';
                        
 				if ($row['types'] == 'catalog_rooms'){
					$option = mysql::selectrow("SELECT `name` FROM `#catalog_rooms` WHERE `id` = ".$row['id_room']."");
					$body .= '<b>Комната:</b> '.$option['name'].' <br>'.
                        '<b>Дата заезда:</b> '.$row['dateIn'].' <br>'.
                        '<b>Дата выезда:</b> '.$row['dateOut'].' <br>'.
                        '<b>Взрослые:</b> '.$row['persons'].' <br>'.
                        '<b>Дети:</b> '.$row['kids'].' <br>'
						;
				}
 				else if ($row['types'] == 'excursions'){
					$option = mysql::selectrow("SELECT `title` FROM `#excursions` WHERE `id` = ".$row['id_excursions']."");
						$body .= '<b>Кол-во суток:</b> '.$option['title'].' <br>'.
                        '<b>Дата заезда:</b> '.$row['dateIn'].' <br>'.
                        '<b>Взрослые:</b> '.$row['persons'].' <br>'.
                        '<b>Дети:</b> '.$row['kids'].' <br>'
						;
				}
 				else{
					$option = mysql::selectrow("SELECT `name` FROM `#cars` WHERE `id` = ".$row['id_cars']."");
						$body .= '<b>Автомобиль:</b> '.$option['name'].' <br>'.
                        '<b>Дата заезда:</b> '.$row['dateIn'].' <br>'.
                        '<b>Дата выезда:</b> '.$row['dateOut'].' <br>'
						;
				}  
				$body .= '<b>Оплата:</b> '.$row['payment'].' <br>';
                $mails = explode(',',cms::setup_value('mail_order'));
                foreach($mails as $mail){
                   mail_(
                           trim($mail),
                           'Новая заявка на сайте http://'.$_SERVER['HTTP_HOST'],
                           $body
                       ); 
                }
				
?>