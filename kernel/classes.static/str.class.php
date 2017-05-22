<?php if (!defined('SCRIPTACCESS')) exit;
	class str {
		// разбивае строку на массив слов, слова короче 2-х символов игнорируются
		static public function get_words($s) {
			$a=explode(' ',$s);
			$b=array();
			for($i=0;$i<count($a);$i++){
				if(trim($a[$i])=='') continue;
				if(strlen(trim($a[$i]))>1) $b[]=trim($a[$i]);
				else continue;
			};
			if(count($b)>0) return $b; else return false;
		}

		// возвращает значение заключенное в тег <tag>value</tag> выбирает 1-ое попавшееся
		static public function get_tag_value($s,$tag){
			$p=strpos('11'.$s,"<".$tag.">",0);
			if($p){
				$p-=2;
				$o=strlen($tag)+2+$p;
				$p=strpos($s,"</".$tag.">",$o);
				$s=substr($s,$o,$p-$o);
				return $s;
			};
			return false;
		}
		
		// возвращает массив значений заключенных в теги <tag>value1</tag>...<tag>value1</tag>
		static public function get_tag_value_array($s,$tag){
			while(true){
				$p=strpos('11'.$s,"<".$tag.">",0);
				if($p){
					$p-=2;
					$o=strlen($tag)+2+$p;
					$p=strpos($s,"</".$tag.">",$o);
					$ret=substr($s,$o,$p-$o);
					$s=substr($s,$p+strlen("</".$tag.">"));
					$ar[]=$ret;
				}else return $ar;
			};
			return false;
		}

		// является ли строка емайлом, если длинна 0, то возвращает true
		static public function is_email($str) {
			if(strlen($str)==0) return true;
			if(preg_match("/^\w+([\x24\w+]|[\x2d\w+]|[\.\w]+)*\w@\w(([\x2d]|[\.\w])*\w+)*\.\w{2,4}$/",$str)) return true;
			return false;
		}
		
		// транслитерирует русскую строку, пробел заменяет на знак "_"
		public static function rus2lat($str) {
			$chars = array(
				'й'=>'j','Й'=>'J',
				'ц'=>'c','Ц'=>'C',
				'у'=>'u','У'=>'U',
				'к'=>'k','К'=>'K',
				'е'=>'e','Е'=>'E',
				'н'=>'n','Н'=>'N',
				'г'=>'g','Г'=>'G',
				'ш'=>'sh','Ш'=>'Sh',
				'щ'=>'csh','Щ'=>'CSH',
				'з'=>'z','З'=>'Z',
				'х'=>'h','Х'=>'H',
				'ъ'=>'_','Ъ'=>'_',
				'ф'=>'f','Ф'=>'F',
				'ы'=>'y','Ы'=>'Y',
				'в'=>'v','В'=>'V',
				'а'=>'a','А'=>'A',
				'п'=>'p','П'=>'P',
				'р'=>'r','Р'=>'R',
				'о'=>'o','О'=>'O',
				'л'=>'l','Л'=>'L',
				'д'=>'d','Д'=>'D',
				'ж'=>'j','Ж'=>'J',
				'э'=>'e','Э'=>'E',
				'я'=>'ya','Я'=>'YA',
				'ч'=>'ch','Ч'=>'CH',
				'с'=>'s','С'=>'s',
				'м'=>'m','М'=>'M',
				'и'=>'i','И'=>'I',
				'т'=>'t','Т'=>'T',
				'ь'=>'_','Ь'=>'_',
				'б'=>'b','Б'=>'B',
				'ю'=>'u','Ю'=>'U',
				'ё'=>'e','Ё'=>'E',
				' '=>'_'
			);
			for ($i=0;$i<strlen($str);$i++){
				if ($chars[$str[$i]]!='') $res .= $chars[$str[$i]];	else $res .= $str[$i];
			}
			return $res;
		}
		
		// заменяет перевод каретки в \n
		public static function chr13replace($s){
			$s=str_replace("\n\r",'\n',$s);
			$s=str_replace("\r\n",'\n',$s);
			$s=str_replace("\n",'\n',$s);
			return $s;
		}
		
		// раскрашивает массив слов $w в строке $s. начитает тегами $p1, заканчивает $p2
		public static function paint($s,$w,$p1,$p2){
			if(!$w) return $s;
			if(!is_array($w)) $w=array($w);
			for ($i=0; $i<count($w);$i++){
		    	$b=$w[$i];
			    $s=eregi_replace($b,$p1.$b.$p2,$s);
			}		
			return $s;
		}			
	};
?>