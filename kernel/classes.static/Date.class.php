<?php if (!defined('SCRIPTACCESS')) exit;
/**
 * Класс для обработки даты и времени
 *
 * Класс реализует следующие методы:
 *
 * @copyright  Copyright (c) 2005-2010 ООО "Капитал Интернет решений". (http://www.r70.ru)
 * @author     Васильев Анатолий 06.05.2010
 * @version    1.0.0
 * @link       http://example.ru/kernel/classes.static/Date.class.php
 */
class Date
{
    /*
     *  
     * 
     */
    public static function shortDm ($date) {
        $da=array("вс","пн","вт","ср","чт","пт","сб");
        $db=array("янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек");
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        $t=mktime(0,0,0,$d[1],$d[2],$d[0]);
        return $d[2].' '.$db[$d[1]-1].' '.$d[0];
	}

}