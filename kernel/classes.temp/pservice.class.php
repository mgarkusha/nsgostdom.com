<?php if (!defined('SCRIPTACCESS')) exit;
	class pservice {
		
		public $name;
		public $inner;
		public $MySQLType='INT(11)';
		
		function display(){
			$tarif=array('1'=>'0','2'=>'5','5'=>'10','10'=>'15','20'=>'16','30'=>'17','40'=>'18','50'=>'19','60'=>'20','70'=>'22','80'=>'24','90'=>'26','100'=>'28','200'=>'30','500'=>'30','1000'=>'30','5000'=>'30','10000'=>'30');
			$t=array();
			echo "Количество sms-пакетов: ";
			echo "<select name='".$this->name."' ".$this->inner." onchange='tarifch();'>";
			$selected=0;
			$i=0;
			foreach($tarif as $pack=>$disc){
				//if(vars($this->name)==$row['id']) $sel='selected'; else $sel='';
				//if($sel!='') $selected=$i;
				echo "<option value='".$pack."'>";
				echo $pack;
				echo "</option>";
				$t[$i]=array($pack,(int)$disc);
				$i++;
			};
			echo "</select>";
			echo "<script>var tarifs=new Array();";
			for($i=0;$i<count($t);$i++){
				echo "tarifs[".(int)$i."]=new Array('".$t[$i][0]."','".$t[$i][1]."');";
			}
			echo "var packs=1; var discount=0;";
			echo "</script>";
			//echo '<input style="display:none; width:45px;" maxlength=6 id=othertarif name=othertarif type=text class=inputtext value="110" onkeypress="tarifch()" onchange="tarifch()" onkeyup="tarifch()" onkeydown="tarifch()" onfocus="tarifch()">';
			echo "<br>Количетво sms: <b><span id=smsamount>100</span></b>";
			echo ", скидка: <b><span id=discnt>0</span></b>%, стоимость одной sms: <b><span id=smscost>2.00</span></b>руб.";
			echo "<br><br>Итого к оплате (с учетом налогов): <b><span id=total>200</span></b>руб."
			?>
			<input type=hidden name='totalsms' value=100><input type=hidden name='totalsum' value=200>
			<script>
				function tarifch(){
					packs=tarifs[document.one.serv.selectedIndex][0];
					discount=tarifs[document.one.serv.selectedIndex][1];
					document.getElementById('smsamount').innerHTML=100*packs;
					document.getElementById('discnt').innerHTML=discount;
					document.getElementById('smscost').innerHTML=2-2*discount/100;
					document.getElementById('total').innerHTML=(2-2*discount/100)*100*packs;
					document.one.totalsms.value=100*packs;
					document.one.totalsum.value=(2-2*discount/100)*100*packs;
				}
			</script>
			<?
		}
		
		function work(){
			if(empty($this->rule)) return true;
			foreach($this->rule as $name => $value){
				if($name=='ne'){
					if(vars($this->name)==''){
						$this->error=$name;
						return false;
					};
				};
			}
			return true;
		}

		function error_text(){
			return $this->rule[$this->error];
		}
	};
?>