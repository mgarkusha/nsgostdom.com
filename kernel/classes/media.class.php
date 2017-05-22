<?php if (!defined('SCRIPTACCESS')) exit;
/**
 *  media class for import video from tomsk.fm && youtube.com
 *  @author coder@r70.ru
 *  @version 1.00
 */
class media {
    var $name;
    var $inner;
    var $width;
    var $height;
    var $table;
    var $MySQLType='varchar(255)';
    var $error='none';
    var $rule=array('ne'=>'Поле видео не должно быть пустым','plus'=>'Некорректная ссылка');
    
    function work() {
       foreach($this->rule as $name=>$error) {
           if($name == 'ne') {
               if(trim(vars($this->name))=='') {
                   $this->error = $name;
                   return false;
               }
           }
           if($name == 'plus') {
               if(issetvar($this->name)) {
               // Обрабатываем содержимое
                   if(stripos(vars($this->name),'tomsk.fm')!==false) {
                       // Если видео с томск фма
//                       echo vars($this->name);
                       if(stripos(vars($this->name),'export')===false) {
                           $p1 = stripos(trim(vars($this->name)),'tomsk.fm');
                           $p2 = stripos(substr(trim(vars($this->name)),$p1),' ');
                           if($p2 <=0) $p2 = strlen(trim(vars($this->name)))-$p1;
                           // инициализация curl
                           $ch = curl_init();
                           curl_setopt($ch, CURLOPT_HEADER, 0);
                           curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, FALSE);
                           curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 10);
                           curl_setopt($ch, CURLOPT_RETURNTRANSFER,1); 
                           curl_setopt($ch, CURLOPT_USERAGENT, "Opera/9.80 (Windows NT 5.1; U; ru) Presto/2.2.15 Version/10.10");
                           curl_setopt($ch, CURLOPT_URL, 'http://'.substr(vars($this->name),$p1,($p1+$p2)));
//                           echo 'http://'.substr(vars($this->name),$p1,($p1+$p2)); exit;
                           $s = curl_exec($ch); $s0 = $s;
                           $s1 = explode('share_code',$s);
                           $s1 = explode('src=&quot;',$s1[1]);
                           $s1 = explode('&quot;',$s1[1]);
                           setvar($this->name,$s1[0]);
                           return true;
                       } else {
//                           echo 1; exit;
                           return true;
                       }
                   } elseif(stripos(vars($this->name),'youtube.com')!==false) {
                       if(stripos(vars($this->name),'www.youtube.com/embed/')===false) {
                           $p2 = stripos(trim(vars($this->name)),' ');
                           $p1 = explode('v=',vars(trim($this->name)));
                           $p1 = explode('&',$p1[1]);
                           $p1 = $p1[0];
                           $link = 'http://www.youtube.com/embed/'.$p1;
                           setvar($this->name,$link);
                           return true;
                       } else {
                           return true;
                       }
                   } else {
                        $this->error = $name;
                        return false;
                   }
               }
           }
       }
       setvar($this->name.'1','ok');
       return true;
    }
    
    function convert_link() {
        // Если все ок то конвертим
        if(vars($this->name.'1')=='ok') {
            setvar($this->name,'<iframe src="'.vars($this->name).'" '.$this->inner.'></iframe>');
        }
    }
    
    function display() {
        	echo "<input type=text name='".$this->name."' value=\"".htmlspecialchars(vars($this->name))."\"";
			if($this->inner!='') echo " ".$this->inner;
			echo ">";
    }
    
    function display2() {
        echo '<div><iframe src="'.vars($this->name).'" scrolling="no" style="border:0;" width="'.$this->width.'" height="'.$this->height.'"></iframe></div>';
    }
    
    function display3() {
            echo "<input type=text name='".$this->name."' value=\"".htmlspecialchars(vars($this->name))."\"";
			if($this->inner!='') echo " ".$this->inner;
			echo ">";
    }
    
    function error_text(){
		return $this->rule[$this->error];
	}
}