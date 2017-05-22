<?php if (!defined('SCRIPTACCESS')) exit;

// возвращает значение заключенное в тег <tag>value</tag>
function _tag($s,$tag){
                $p=strpos('11'.$s,"<".$tag.">",0);
                if($p){
                        $p-=2;
                        $o=strlen($tag)+2+$p;
                        $p=strpos($s,"</".$tag.">",$o);
                        $s=substr($s,$o,$p-$o);
                        return $s;
                };
                return false;
};
function _tagar($s,$tag){
        while(true){
                $p=strpos('11'.$s,"<".$tag.">",0);
                if($p){
                        $p-=2;
                        $o=strlen($tag)+2+$p;
                        $p=strpos($s,"</".$tag.">",$o);
                        $ret=substr($s,$o,$p-$o);
                        $s=substr($s,$p+strlen("</".$tag.">"));
                        $ar[]=$ret;
                        //if ($s!='') _tagar(&$s,$tag,&$ar); else return true;
                }else{
                        return $ar;
                }
        };
        return false;
};
// подствечивает слово(а) в строке
function _hl($where,$what,$start='<b>',$end="</b>"){
        if(!$what) return $where;
        for($i=0;$i<count($what);$i++){
                $where=ereg_replace($what[$i],$start.$what[$i].$end,$where);
        };
        return $where;
};
// заменяет в строке {value} на значние
function _replace($where,$what,$value){
        if(is_array($what)){
                for($i=0;$i<count($what);$i++){
                        $where=ereg_replace('{'.$what[$i].'}',$value[$i],$where);
                };
                return $where;
        }else{
                return eregi_replace('{'.$what.'}',$value,$where);
        };
};
// разбивае строку на массив слов, слова короче 2-х символов игнорируются
function get_words($s){
        $a=explode(' ',$s);
        $b=array();
        for($i=0;$i<count($a);$i++){
                if(trim($a[$i])=='') continue;
                if(strlen(trim($a[$i]))>1) $b[]=trim($a[$i]);
                else continue;
        };
        if(count($b)>0) return $b; else return false;
};
// вырезает из строки первые N символов добавляя в конце "..."
function _cut($s,$length=27){
        if(strlen($s)<=$length) return $s;
        else return substr($s,0,$length).'...';
};	
// проверяет правильность введенного емайла
function is_email($str) {
        if(strlen($str)==0)return true;
        if(preg_match("/^\w+([\x24\w+]|[\x2d\w+]|[\.\w]+)*\w@\w(([\x2d]|[\.\w])*\w+)*\.\w{2,4}$/",$str)){
                return true;
        };
        return false;
};
// отдает дату в формате "11 янв 2005"
function hrdate($date){
        $da=array("вс","пн","вт","ср","чт","пт","сб");
        //$db=array("января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");	
        $db=array("янв","фев","мар","апр","мая","июн","июл","авг","сен","окт","ноя","дек");
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        $t=mktime(0,0,0,$d[1],$d[2],$d[0]);
        return /*$da[date('w',$t)]." ".*/$d[2].' '.$db[$d[1]-1].' '.$d[0];
};
// отдаетдату в формате "11 ноября 2005"
function hrdate2($date){
        $db=array("января","февраля","марта","апреля","мая","июня","июля","августа","сентября","октября","ноября","декабря");
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        return $d[2].' '.$db[$d[1]-1].' '.$d[0];
};
// отдаетдату в формате "ноябрь 2005"
function hrdate3($date){
        $db=array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        return $d[2].' '.$db[$d[1]-1].' '.$d[0];
};
function hrdate4($date){
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        return $d[2].'.'.$d[1].'.'.$d[0];
};
function hrdate5($date){
        $db=array("Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь");
        $date=explode(" ",$date); $date=$date[0];
        $d=explode('-',$date);
        return $db[$d[1]-1].' '.$d[0];
};
function hrdatemn($month){
        $db=array("Января","Февраля","Марта","Апреля","Мая","Июня","Июля","Августа","Сентября","Октября","Ноября","Декабря");
        return $db[$month];
};
// вырезает из пути двойные "//"
function strip_path($s){
        $os='';
        for($i=0;$i<strlen($s);$i++){
                if($s[$i]=='/'){
                        if(!$f){
                                $f=true;
                                $os.=$s[$i];
                        }else{
                                $f=false;
                        };
                }else{
                        $f=false;
                        $os.=$s[$i];
                };
        };
        return $os;
};

// функция преобразования окончаний, в зависимости от числа
function pluralForm($n, $form1, $form2, $form5){
    $n = abs($n) %100;
    $n1 = $n % 10;
    if($n > 10 && $n < 20) return $form5;
    if($n1 > 1 && $n1 < 5) return $form2;
    if($n1 == 1) return $form1;
    return $form5;
}

