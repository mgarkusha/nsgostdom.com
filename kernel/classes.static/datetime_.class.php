<?php if (!defined('SCRIPTACCESS')) exit;
	class datetime_ {
		
		// возвращает true, если дата сегодняшняя (полученну в формате Y-m-d H:i:s), иначе false
		public static function istoday($date){
			$d=explode(" ",$date);
			if($d[0]==date("Y-m-d")) return true; else return false;
		}
		
		// возвращает mktime от полученной даты в формате Y-m-d H:i:s
		public static function getutime($date){
			$date=explode(" ",$date);
			$d1=explode("-",$date[0]);
			$d2=explode(":",$date[1]);
			//print_r($d1);
			return mktime($d2[0],$d2[1],$d2[2],$d1[1],$d1[2],$d1[0]);
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "Y.m.d H:i:s"
		public static function transform1($date){
			$date=explode(" ",$date);
			$d1=explode("-",$date[0]);
			$d2=explode(":",$date[1]);
			return $d1[2].'.'.$d1[1].'.'.$d1[0].' '.$d2[0].':'.$d2[1].':'.$d2[2];
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "пн d янв Y"
		public static function transform2($date){
			$da=array("вс","пн","вт","ср","чт","пт","сб");
			$db=array("янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек");
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			$t=mktime(0,0,0,$d[1],$d[2],$d[0]);
			return $da[date('w',$t)]." ".$d[2].' '.$db[$d[1]-1].' '.$d[0];
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "d ноября Y"
		public static function transform3($date){
			$db=array("января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			return $d[2].' '.$db[$d[1]-1].' '.$d[0];
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "ноябрь Y"
		public static function transform4($date){
			$db=array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			return $d[2].' '.$db[$d[1]-1].' '.$d[0];
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "Y.m.d"
		public static function transform5($date){
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			return $d[2].'.'.$d[1].'.'.$d[0];
		}
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "d янв"
		public static function transform6($date){
			$db=array("янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек");
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			$t=mktime(0,0,0,$d[1],$d[2],$d[0]);
			return $d[2].' '.$db[$d[1]-1];
		}		
		
		// возвращает дату (полученну в формате Y-m-d H:i:s) в формате "d янв 2007"
		public static function transform7($date){
			$db=array("янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек");
			$date=explode(" ",$date); $date=$date[0];
			$d=explode('-',$date);
			$t=mktime(0,0,0,$d[1],$d[2],$d[0]);
			return $d[2].' '.$db[$d[1]-1]." ".$d[0];
		}		
		
	}
?>