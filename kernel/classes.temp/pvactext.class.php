<?php if (!defined('SCRIPTACCESS')) exit;
	class pvactext {
		
		public $name;
		public $inner;
		public $MySQLType='LONGTEXT';
		
		function display(){
			echo "<textarea name='".$this->name."' id='".$this->name."'";
			if(!empty($this->inner)) echo " ".$this->inner;
			echo " onkeypress='".$this->name."countchars()' onchange='".$this->name."countchars()' onkeyup='".$this->name."countchars()' onkeydown='".$this->name."countchars()' onfocus='".$this->name."countchars()'>".htmlspecialchars(vars($this->name))."</textarea><br>";
			?>
			<table cellpadding="0" cellspacing="0" border="0" width=<?=$this->width?>>
				<tr>
					<td width=100% class=mini2 valign=top nowrap><div id=<?=$this->name?>amount></div></td>
				</tr>
			</table>
			<script>
				var <?=$this->name?>maxlength=300;
				function <?=$this->name?>countchars() {
					var cnt=document.getElementById('<?=$this->name?>amount');
					var txt=document.one.<?=$this->name?>.value;
					var length=parseInt(txt.length);

					if(length><?=$this->name?>maxlength) sa='<font style="color:red">' + length + '</font>'; else sa=length;
					
					cnt.innerHTML="Набрано символов: <b>" + sa + '</b>.';
					if(length><?=$this->name?>maxlength) cnt.innerHTML+='<br><font style="color:red">Слишком длинный текст!!!<br>Будут добавлены только первые '+<?=$this->name?>maxlength+' символов.</font>';
				}
				<?=$this->name?>countchars();
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