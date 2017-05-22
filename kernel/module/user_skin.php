<?php if (!defined('SCRIPTACCESS')) exit;

function u_message($t=false,$m=false){
	if(!$t && !$m) global $t;
	if($t && $t->display_message()) $msg=$t->display_message(); 
	elseif($m) $msg=$m;
	if(!empty($msg)) echo "<div align=center><font class=message>".$msg."</font></div><br>";
};

function u_edit_controls($e1,$buttons='save',$he=false,$ac=false){
	$buttons=explode('|',$buttons);
	if($he){
		$he=explode('|',$he);
		$ac=explode('|',$ac);
		$buttons=array_merge($buttons,$he);
	};
	echo "<div align=center>";
	for($i=0;$i<count($buttons);$i++){
		if($buttons[$i]=='back'){
			$bname='Отменить/Назад';
			$baction='document.location.href="'.ROOT.PATH.'"';
		}else{
			if($buttons[$i]=='save'){
				$bname='Сохранить';
				$baction=$e1->sys['store'];
			}elseif($buttons[$i]=='save&back'){
				$bname='Добавить/Сохранить';
				$baction=$e1->sys['store&back'];
			}elseif($buttons[$i]=='delete'){
				if(vars('e')=='n') continue;
				$bname='Удалить запись';
				$baction=$e1->sys['delete'];
			}else{
				$bname=$he[$i];
				$baction=$ac[$i-(count($buttons)-count($he))];
			};
		};
		echo "<input class=buttoninput type=button onclick='".$baction."' value='".$bname."'>&nbsp;";
	};
	echo "</div></form>";
};
function u_edit_txt($ttl,$e1,$titles,$fields){
		echo '	
					<b>'.$ttl.'</b>
					<div>'.spacer(1,2).'</div>
					<div style="border: solid 1px #d4d4d4; padding: 4;">';
						u_edit($e1,$titles,$fields);
		echo '
					</div>';
}
function u_edit_txt_eval($ttl,$titles,$fields){
		echo '	
					<b>'.$ttl.'</b>
					<div>'.spacer(1,2).'</div>
					<div style="background-color: #fbfbfb; border: solid 1px #d4d4d4; padding: 4;">';
		echo "<table cellpadding=0 cellspacing=0 border=0>\n";
		foreach ($titles as $key=>$value){
			if ($fields[$key]=='') continue;
			echo "<tr><td class=text valign=top>".$value."</td>\n";
			echo '<td>'.spacer(10,1).'</td>'."\n";
			echo "<td class=text valign=top>\n";
			eval($fields[$key]);
			echo '</td>';
			echo '</tr>';
			echo '<tr>';
			echo '<td>'.spacer(1,3).'</td>';
			echo '</tr>';
		}
		echo "</table>";
		echo '
					</div>';
}
function u_edit($e1,$titles,$fields){
	$titles=explode('|',$titles);
	$fields=explode('|',$fields);
	echo "<table cellpadding=0 cellspacing=0 border=0>\n";
	for($i=0;$i<count($titles);$i++){
		for($j=0;$j<count($e1->fields);$j++){
			$a=$fields[$i];
			if($e1->fields[$j]->name==$fields[$i] || ($a[0]==':' && $a[1]==':')){
				if(trim($titles[$i])=='#'){
					$e1->fields[$j]->display();
					continue;
				}elseif(trim($titles[$i])!=''){
					echo "<tr><td class=text valign=top>".$titles[$i]."</td>\n";
					echo '<td>'.spacer(10,1).'</td>'."\n";
					echo "<td class=text valign=top>\n";
				};
				$lnk2=false;
				if($a[0]==':' && $a[1]==':') { 
					$lnk2=true; $a=substr($a,2); 
				};
				if($lnk2) eval($a); else $e1->fields[$j]->display();
				if(trim($titles[$i])!='') echo "</td></tr>\n";
				echo '<tr><td>'.spacer(1,3).'</td></tr>'."\n";
				break;
			};
		};
	};
	echo "</table>";
}

function u_list_controls($title,$action){
	$t=explode('|',$title);
	$a=explode('|',$action);
	echo "<div align=right>";
	for($i=0;$i<count($t);$i++){
		echo "<a href='".$a[$i]."' class=link>".$t[$i]."</a> &nbsp;";
	};
	echo "</div>";
};

?>