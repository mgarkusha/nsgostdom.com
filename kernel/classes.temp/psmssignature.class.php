<?php if (!defined('SCRIPTACCESS')) exit;
	class psmssignature {
		var $name;
		var $value;
		var $inner;
		var $MySQLType='int(11)';
		function work(){
			return true;
		}
		//
		function error_text(){
			return $this->rule[$this->error];
		}
		//
		function display(){
			$db=mysql_query($sql="SELECT * FROM mf_signature WHERE account=".$this->value." ORDER BY id");
			echo "<select name='".$this->name."' ".$this->inner." onchange='signaturechanged();'>";
			$selected=0;
			$i=0;
			while($row=mysql_fetch_array($db)){
				if(vars($this->name)==$row['id']) $sel='selected'; else $sel='';
				if($sel!='') $selected=$i;
				echo "<option value='".$row['id']."' $sel>";
				echo $row['signature'].' (Отправитель: '.addslashes($row['sender']).')';
				echo "</option>";
				$ln[$i]=strlen($row['signature']);
				$i++;
			};
			echo "</select>";
			echo '<script>';
			echo "var signatureln=Array();";
			foreach($ln as $id=>$len){
				echo "signatureln[".(int)$id."]='".addslashes($len)."';";
			}
			echo 'var signatureselected='.(int)$ln[(int)$selected].';';
			?>
				function signaturechanged(){
					signatureselected=signatureln[document.one.signature.selectedIndex];
					countchars();
				}
			</script>
			<?
		}
	}
?>