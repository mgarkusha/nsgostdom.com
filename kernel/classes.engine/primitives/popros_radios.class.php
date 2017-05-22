<?php if (!defined('SCRIPTACCESS')) exit;
	class popros_radios {
		var $name;
		var $sql;
		var $key;
		var $value;
		var $default;
		var $inner;
		var $reload;
		var $MySQLType='TEXT';
		function work(){
			if(!$this->worked){
				$this->worked=true;
				if(isset($_POST[$this->name])){
					//print_r($_POST); exit;
					$s='~';
					//print_r($_REQUEST[$this->name]); exit;
					foreach($this->variants as $key=>$value) {
						$s.=$key.'`'.($_REQUEST[$this->name]==$key?'1':'0');
						$o=trim($_REQUEST[$this->name.'othervalue'][$key]);
						if($o!=''){
							$o=str_replace('`','',$o);
							$o=str_replace('~','',$o);
							$s.='`'.$o;
						}
						$s=$s.'~';
					}
	//				foreach ($_REQUEST[$this->name] as $key=>$value){
	//					if($key=='text' || $key=='textarea') {
	//						$text=$value;
	//						$text=str_replace('`','',$text);
	//						$text=str_replace('~','',$text);
	//						continue;
	//					}
	//					if($value=='on') $s.='~'.$key;
	//				}
	//				if($text!='') $s.='~`'.$text;
					//echo $s; exit;
					setvar($this->name,$s);
				}else setvar($this->name,'~'.$this->default.'`1~');
				if(empty($this->rule)) return true;
		
				return true;
			};
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			$this->work();
			$s=substr(vars($this->name),1,-1);
			$arr=explode('~',$s);
			for($i=0;$i<count($arr);$i++){
				$ar=explode('`',$arr[$i]);
				$a[$ar[0]]=array($ar[1],$ar[2]);
			}
			echo "<table cellpadding=0 cellspacing=0 border=0><tr>";
			foreach($this->variants as $key=>$value){
				if($a[$key][0]=='1') $sel='checked'; else $sel='';
				if(!is_array($value)) $value=array($value);
				echo "<td>";
				echo "<input type='radio' name='".$this->name."' $sel value='".$key."'></td><td valign=middle>".$value[0]."&nbsp;&nbsp;</td>";
				if(isset($value[1])) {
					echo "<td colspan=2>&nbsp;</td><td>";
					if($a[$key][1]!='') $v=$a[$key][1]; else $v='';
					if($value[1]=='text') echo " <input type='text' style='height:18px; width:200px; font-size:12px;' name='".$this->name."othervalue[".$key."]' value='".htmlspecialchars($v)."'>";
					else echo "<textarea name='".$this->name."othervalue[".$key."]'>".htmlspecialchars($v)."</textarea>";
					echo '</td>';
				};
			}
			echo "</tr></table>";
		}
	}
?>