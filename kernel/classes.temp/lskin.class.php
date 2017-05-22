<?php if (!defined('SCRIPTACCESS')) exit;
	class lskin {
		
		public static $ACTION_EDIT=true;
		public static $ACTION_DELETE=true;
		public static $ACTION_MOVE=false;
		
		public static function begin(){
			?><table cellpadding="0" cellspacing="1" border=0 width=80% align=center>
				<tr><td><div style='height:20px; width:20px;'></div></td></tr>
			<?
		}
		
		public static function end(){
			?><tr><td><div style='height:20px; width:20px;'></div></td></tr></table><?
		}		
		
		public static function message($msg=false){
			if(!$msg){
				global $t;
				if($t && $t->display_message()) $msg=$t->display_message(); 
			}
			if($msg){ ?>
			<tr>
				<td align=center><font class=message>&nbsp;<?=$msg?>&nbsp;</font><div style='height:20px; width:20px;'></div></td>
			</tr>
			<? }
		}		
		
		public static function hr(){
			?><tr><td background="/images/hr1.gif"><?=html::ispace(1,2)?></td></tr><?
		}		
		
		public static function space($h=10) {
			?><tr><td><?=html::ispace(1,$h)?></td></tr><?
		}
				
		public static function header($h){
			if(!is_array($h)) $h=array($h);
			lskin::$actions=false;
			if(lskin::$ACTION_EDIT || lskin::$ACTION_DELETE || lskin::$ACTION_MOVE) lskin::$actions=true;
			?>
				<tr><td>
				<table cellpadding="0" cellspacing="0" border="0">
					<tr>
						<td bgcolor='#C2E4ED' width=1px></td>
						<?
							$i=0;
							foreach($h as $name){
								$i++;
								echo "<td bgcolor='#C2E4ED' nowrap><div class=lskinheader>".$name."</div></td>";
								if($i<count($h)) echo "<td width=1px></td>";
							}
						?>
						<?if(lskin::$actions){?><td width=1px></td><td >&nbsp;</td><td width=1px></td><?}else{?><td bgcolor='#C2E4ED' width=1px></td><?}?>
					</tr>
					<tr><td height="2px" colspan="<?=count($h)*2+1+(lskin::$actions?2:0)?>"></td></tr>
			<?
		}
		
		public static function row($r,$id){
			if(!is_array($r)) $r=array($r);
			lskin::$cols=count($r);
			if(lskin::$actions) lskin::$cols++;
			echo '<tr><td bgcolor=#92C7D5 colspan='.(lskin::$cols*2+1).'>'.html::ispace(1,1).'</td></tr>';
			echo '<tr>';
			foreach($r as $name){
				echo "<td width=1 bgcolor=#92C7D5></td><td bgcolor=#B8E3F0><div class=lskinrow>".$name.'</div></td>';
			}
			echo "<td width=1 bgcolor=#92C7D5></td>";
			$space=false;
			if(lskin::$actions){
				echo "<td align=center nowrap bgcolor=#B8E3F0><div style='margin-left:11px; margin-right:10px; valign:middle;'>";
				if(lskin::$ACTION_EDIT){ echo "<a href='?e=".$id."'>".html::image('edit.gif').'</a>'; $space=true;}
				if(lskin::$ACTION_DELETE){echo "<a href='?d=".$id."'>".html::image('remove.gif','',($space?' style="margin-left:5px;" ':'')).'</a>'; $space=true;}
				if(lskin::$ACTION_MOVE){
					echo "<a href='?m=up&k=".$id."'>".html::image('moveup.gif','',($space?' style="margin-left:5px;" ':'')).'</a>'; $space=true;
					echo "<a href='?m=dn&k=".$id."'>".html::image('movedown.gif','',($space?' style="margin-left:5px;" ':'')).'</a>'; $space=true;
				}
				echo "</div></td>";
				echo "<td width=1 bgcolor=#92C7D5></td>";
			}
			echo '</tr>';
		}
		
		public static function closetable(){
			echo '<tr><td bgcolor=#92C7D5 colspan='.(lskin::$cols*2+1).'>'.html::ispace(1,1).'</td></tr>';
			echo "</table></td></tr>";
		}
		
		public static function controls($c){
			echo "<tr><td>";
			echo "<table cellpadding=2 cellspacing=0 border=0>";
			foreach($c as $class){
				echo '<tr>';
				foreach($class as $cls){
					echo "<td valign=middle>";
					$cls->display();
					echo "</td><td>&nbsp;</td>";
				}
				echo '</tr>';
			}
			echo "</table></td></tr>";
			lskin::space(5);
		}
		
		public static function actions($b,$w){
			if(!is_array($b)) $b=array($b);
			if(!is_array($w)) $w=array($w);
			lskin::space(5);
			lskin::hr();
			lskin::space(1);
			echo "<tr><td><table cellpadding=2 cellspacing=0 border=0>";
			echo '<tr><td>'.html::ispace(5,1)."</td>";
			$i=0;
			foreach($b as $btn){
				if($btn=="ADD"){
					$url='?e=n';
					$nm='Добавить';
				}
				echo "<td>";
				echo "<input type=button class=inputbutton onclick='document.location.href=\"$url\"' ".($w[$i]?'style="width:'.$w[$i].'"':'')." value='$nm'>";
				echo "</td>";
				$i++;
			}
			echo '</tr>';
			echo "</table></td></tr>";
			lskin::space(1);
			lskin::hr();
			lskin::space(10);
		}		
		
		protected static $cols;
		protected static $actions=false;
	}
?>