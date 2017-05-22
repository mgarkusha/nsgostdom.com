<?php if (!defined('SCRIPTACCESS')) exit;
	class skin {
		public static $width1=false;
		public static $width2=false;
		public static $width='100%';
		public static $actioninner=false;
		public static $margin=false;
		public static $storetype=2;
		
		public static function begin($formname='one'){
			?><form name=<?=$formname?> method="POST" enctype='multipart/form-data'><table cellpadding="0" cellspacing="4" border=0 width=<?=skin::$width?> align=center>
				<tr><td><?if(skin::$width1) echo html::ispace(skin::$width1,1)?></td><td>
				<input type=hidden name=e value='<?=vars('e')?>'>
				<input type=hidden name=s>
				<script>
					function store_(v) {
						document.one.s.value=v;
						document.one.submit();
					};
				</script>
				</td><td><?=html::ispace(1,1)?></td></tr>
			<?
		}
		
		public static function end($margin=true){
			?><?if($margin) { ?><tr><td colspan="3"><div style='height:20px; width:20px;'></div></td></tr><?}?></table></form><?
		}
		
		public static function rowbegin($header,$required=false){
			?><tr>
				<td align=left valign="top" <?=skin::$width1?'width='.skin::$width1:''?> style='padding-left:7px; color:#888888;'><?=$header?><?=$required?'<font style="color:red;">*</font>':' '?></td>
				<td>&nbsp;</td>
				<td valign="top" <?=skin::$width2?'width='.skin::$width2:''?> style="padding-right:7px;"><?
				if(skin::$margin) echo "<div style='margin-bottom:7px;'>";
		}
		
		public static function rowend($text=false){
				if(skin::$margin) echo "</div>";
				if($text!=false){
//					echo "</td></tr><tr><td colspan=3 valgn=top><div class=comment style='margin-bottom:10px;'>";
//					echo $text;
//					echo "</div>";
					echo "<div class=comment style='margin-bottom:10px;'>";
					echo $text;
					echo "</div>";
				}
				?></td>
			</tr><?
		}		
		
		public static function hr(){
			?><tr><td colspan="3" background="/images/hr1.gif"><?=html::ispace(1,2)?></td></tr><?
		}
		
		public static function space($h=20) {
			?><tr><td colspan="3"><?=html::ispace(1,$h)?></td></tr><?
		}
		
		public static function text($c) {
			?><tr><td colspan="3"><?=$c?></td></tr><?
		}		
		
		public static function textbegin(){
			?><tr><td colspan="3"><?
		}
		
		public static function textend(){
			?></td></tr><?
		}

		//комментарий чистой воды
		public static function comment($c) {
			?><tr><td colspan="3" class=comment><?=$c?></td></tr><?
		}
				
		// подзаголовок блин
		public static function subheader($h) {
			?><tr><td colspan="3" width=100%>
				<table cellpadding="0" cellspacing="0" width="100%">
					<tr>
						<td><?=html::image('bghl.gif')?></td>
						<td width=100% background="/images/bghc.gif" class=text style='color:#06567B;'><?=$h?></td>
						<td><?=html::image('bghr.gif')?></td>
					</tr>
				</table>
			</td></tr><?
		}
		
		// выводим сообщения всякие
		public static function message($msg=false){
			if(!$msg){
				global $t;
				if($t && $t->display_message()) $msg=$t->display_message(); 
			}
			if($msg){ ?>
			<tr>
				<td colspan="3" align=center><font class=message>&nbsp;<?=$msg?>&nbsp;</font><div style='height:20px; width:20px;'></div></td>
			</tr>
			<? }
		}
		
		// кнопки действий различных необычных
		public static function actions($a,$width=false){
			if(!is_array($a)) $a=array($a);
			if(!is_array($width)) $width=array($width);
			echo "<tr><td colspan=3 align=center>";
			$space=false;
			$i=0;
			foreach($a as $btn){
				if($btn=='CANCEL'){
					if($space) echo "&nbsp;&nbsp;";
					echo "<input type=button class=inputbutton onclick='document.location.href=\"?\";' value='Отменить' ".($width[$i]?'style="width:'.$width[$i].'"':'').">";
					$space=true;
				}
				if($btn=='SAVE'){
					if($space) echo "&nbsp;&nbsp;";
					echo "<input type=button class=inputbutton onclick=\"".(skin::$actioninner?skin::$actioninner:'store_('.skin::$storetype.')').";\" value='Сохранить' ".($width[$i]?'style="width:'.$width[$i].'"':'').">";
					$space=true;
				}
				if($btn=='REG'){
					echo "<input type=button class=inputbutton onclick=\"javascript: store_(1);\" value='Сохранить' ".($width[$i]?'style="width:'.$width[$i].'"':'').">";
					$space=true;
				}
				if($btn=='AUTH'){
					echo "<input type=button class=inputbutton onclick=\"store_(1);\" value='Войти' ".($width[$i]?'style="width:'.$width[$i].'"':'').">";
					$space=true;
				}
				$i++;
			}
			echo "</td></tr>";
		}
		
	};
?>