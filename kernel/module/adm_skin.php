<?php if (!defined('SCRIPTACCESS')) exit;

// common functions

function a_header($name){
	echo "<div style='background:#0D60AE; color:#ffffff; padding: 2px; font-size: 11px; float: left;'>&nbsp; ".$name." &nbsp;</div>";
        echo "<div style='height: 2px; clear: both;'></div>";
};
function a_message($t=false,$m=false){
	if($t && $t->display_message()) echo "<div style='background:#D1674A; color:#ffffff; float: left;padding: 2px;font-weight: bold'>&nbsp; ".$t->display_message()." &nbsp;</div><div style='clear: both; height: 2px;'></div>";
	if($m) echo "<div style='background:#D1674A; color:#ffffff; float: left;padding: 2px 5px;font-weight: bold'>&nbsp; ".$m." &nbsp;</div><div style='clear: both; height: 2px;'></div>";
};

// additional navigation functions

function a_navigator($titles,$actions){
	global $_useradmin_;
	global $_userperm_;
	$titles=explode('|',$titles);
	$actions=explode('|',$actions);
	echo "<font size=1>&nbsp; Быстрый переход в: </font>";
	for($i=0;$i<count($titles);$i++){
		echo "<a href='".$actions[$i]."' class=link2 style='background-color:#999999; color:#ffffff'>&nbsp;".$titles[$i]."&nbsp;</a>";
		echo "&nbsp; ";
	};
};

// list functions

function a_list_controls($l1=false,$more_headers=false,$more_actions=false){
	global $_useradmin_;
	global $_userperm_;
	if($_useradmin_ || $_userperm_[MODULE]['write']=='1'){
	?><br><?=html::ispace(2,2)?><br><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td class=text width=100% bgcolor="#999999"><?=html::ispace(1,1)?></td></tr></table><?
	if($more_headers) $more_headers=explode('|',$more_headers);
	if($more_actions) $more_actions=explode('|',$more_actions);
	if($l1){
		if(is_array($more_headers)) $more_headers=array_merge(array('Добавить'),$more_headers);
		else $more_headers=array('Добавить');
		if(is_array($more_actions)) $more_actions=array_merge(array($l1->sys['button']),$more_actions);
		else $more_actions=array($l1->sys['button']);
	};
	for($i=0;$i<count($more_headers);$i++){
		$a=$more_headers[$i];
		if($a[0]=='!'){
			$more_headers[$i]=substr($a,1);
			$_ins='onclick="return confirm(\'Вы уверены?\');"';
		}else $_ins='';
		echo "<a href='".$more_actions[$i]."' $_ins class=link2 style='background-color:#05966F; color:#ffffff'>&nbsp;".$more_headers[$i]."&nbsp;</a>".html::ispace(5,5);
	};
	?><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td class=text width=100% bgcolor="#999999"><?=html::ispace(1,1); ?></td></tr></table><?
	};
};
function a_list($l1,$titles,$fields,$controls='edit|delete|up|down',$help=false){
	global $_useradmin_;
	global $_userperm_;
	$titles=explode('|',$titles);
	foreach ($titles as $key=>$val){
		if (ereg('[::]',$val)){
			$hlp[$key]=substr($titles[$key],$ft=strpos($titles[$key],'::')+2,strlen($titles[$key])-$ft);
			$titles[$key]=substr($titles[$key],0,strpos($titles[$key],'::'));
		}
		//$titles[$key]=substr($titles[$key],0,$ft=strpos('::',$titles[$key]));
		//echo $ft;
	}
	//print_r($hlp);
	$fields=explode('|',$fields);
	if($controls) $controls=explode('|',$controls);
	?>
		<?=html::ispace(2,2); ?><br>
		<table cellpadding=0 cellspacing=1 border=0>
			<tr bgcolor=#dddddd>
				<?
					if($controls){
						for($i=0;$i<count($controls);$i++){
							if($controls[$i]=='edit') echo "<td class=text2 bgcolor=#ffffff>&nbsp;</td>";
							elseif($_useradmin_ || $_userperm_[MODULE]['write']=='1'){
								echo "<td class=text2 bgcolor=#ffffff>&nbsp;</td>";
							};
						};
					};
					for($i=0;$i<count($titles);$i++){
						echo "<td class=text2 nowrap ".($i==count($titles)-1?'':'').">&nbsp;<b>".$titles[$i]."</b>&nbsp;&nbsp;</td>";
					};
					echo "</tr>";
					$_123=false;
					while($l1->fetch()){
						if(!$_123) { $_123=true; $co="#eeeeee"; } else {$_123=false; $co="#cccccc";};
						echo "<tr bgcolor=".$co.">";
						if($controls){
							for($i=0;$i<count($controls);$i++){
								if($controls[$i]=='edit') echo "<td  bgcolor=#ffffff align=center class=text2>&nbsp;<a class=link3 href='".$l1->sys['edit']."'>".(($_useradmin_ || $_userperm_[MODULE]['write']=='1')?'ред.':'см.')."</a>&nbsp;";
								if($_useradmin_ || $_userperm_[MODULE]['write']=='1'){
									if($controls[$i]=='delete') echo "<td  bgcolor=#ffffff align=center class=text2>&nbsp;<a class=link3 onclick='return confirm(\"".$l1->del_alert."\")' href='".$l1->sys['delete']."'>удал.</a>&nbsp;</td>";
									elseif($controls[$i]=='up') echo "<td  bgcolor=#ffffff align=center class=text2>&nbsp;<a class=link3 href='".$l1->sys['up']."'>вв.</a>&nbsp;";
									elseif($controls[$i]=='down') echo "<td  bgcolor=#ffffff align=center class=text2>&nbsp;<a class=link3 href='".$l1->sys['down']."'>вн.</a>&nbsp;";
								};
							};
						};
						for($i=0;$i<count($fields);$i++){
							echo "<td class=text2><table cellpadding=0 width=100% cellspacing=0 border=0><tr><td>".html::ispace(4,4)."</td><td valign=top class=text2 width=100%>";
							$lnk=false;
							$lnk2=false;
							$lnk3=false;
							$a=$fields[$i];
							if($a[0]=='#') { $lnk=true; $a=substr($a,1); };
							if($a[0]=='!') { $lnk3=true; $a=substr($a,1); };
							if($a[0]==':' && $a[1]==':') { 
								$lnk2=true; $a=substr($a,2); 
							};
							if($lnk) echo "<a href='".$l1->sys['go2']."' class=link>";
							if(!$lnk2){
								if($lnk3) echo $l1->{$a}; else echo htmlspecialchars($l1->{$a});
							}else eval($a);
							if($lnk) echo "</a>";
							echo "</td><td>".html::ispace(4,4)."</td></tr></table></td>";
						};
						echo "</tr>";
					};
	?>
		</table>
	<?
};
function a_path($t){
	echo "&nbsp; <a href='.".$t->back[link][0]."' class=link><u>Назад</u></a>&nbsp;&nbsp;<font class=text>Раздел: <b>".$t->back['row'][0]['name']."</b></font>";
};
// edit functions

function a_edit_controls($e1,$buttons='back|save|save&back|delete',$he=false,$ac=false){
	global $_useradmin_;
	global $_userperm_;
	$buttons=explode('|',$buttons);
	if($he){
		$he=explode('|',$he);
		$ac=explode('|',$ac);
		$buttons=array_merge($buttons,$he);
	};
	?><form name=one method=post enctype="multipart/form-data"><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td class=text width=100% bgcolor="#999999"><?=html::ispace(1,1)?></td></tr></table><?
		for($i=0;$i<count($buttons);$i++){
			if($buttons[$i]=='back'){
				$bname='Назад';
				$baction=conf::$hpath.conf::$path.'/';
			}else{
				if($_useradmin_ || $_userperm_[MODULE]['write']=='1'){
					if($buttons[$i]=='save'){
						$bname='Сохранить';
						$baction=$e1->sys['store'];
					}elseif($buttons[$i]=='save&back'){
						$bname='Сохранить и вернуться к списку';
						$baction=$e1->sys['store&back'];
					}elseif($buttons[$i]=='delete'){
						if(vars('e')=='n') continue;
						$bname='Удалить запись';
						$baction=$e1->sys['delete'];
					}else{
						$bname=$he[$i];
						$baction=$ac[$i-(count($buttons)-count($he))];
					};
				}else continue;
			};
			echo "<a href='".$baction."' class=link2 style='background-color:#05966F; color:#ffffff'>&nbsp;".$bname."&nbsp;</a><font class=text>&nbsp; </font>";
		};
	?><table cellpadding=0 cellspacing=0 border=0 width=100%><tr><td class=text width=100% bgcolor="#999999"><?=html::ispace(1,1)?></td></tr></table><?
};
function a_edit($e1,$titles,$fields){
	$titles=explode('|',$titles);
	foreach ($titles as $key=>$val){
		if (ereg('[::]',$val)){
			$hlp[$key]=substr($titles[$key],$ft=strpos($titles[$key],'::')+2,strlen($titles[$key])-$ft);
			$titles[$key]=substr($titles[$key],0,strpos($titles[$key],'::'));
		}
		//$titles[$key]=substr($titles[$key],0,$ft=strpos('::',$titles[$key]));
		//echo $ft;
	}
	$fields=explode('|',$fields);
	echo "<table cellpadding=0 cellspacing=0 border=0 width=100%";
	echo "<br>".html::ispace(5,5).'<br>';
	for($i=0;$i<count($titles);$i++){
		for($j=0;$j<count($e1->fields);$j++){
			$a=$fields[$i];
			if($e1->fields[$j]->name==$fields[$i] || ($a[0]==':' && $a[1]==':')){
				if(trim($titles[$i])!=''){
					echo "<tr><td class=text2 align=right valign=top nowrap><font style='background-color:#d0d0d0; color:#000000'>&nbsp;".$titles[$i]."&nbsp;</font></td>";
					echo "<td>".html::ispace(7,1)."</td>";
					echo "<td class=text2 width=100% align=left valign=top>";
				};
				$lnk2=false;
				if($a[0]==':' && $a[1]==':') { 
					$lnk2=true; $a=substr($a,2); 
				};
				if($lnk2) eval($a); else $e1->fields[$j]->display();
				if(trim($titles[$i])!='') echo "</td></tr>";
				break;
			};
		};
	};
	for($j=0;$j<count($e1->fields);$j++){
		if($e1->fields[$j]->name=='pos') $e1->fields[$j]->display(); 
	};
	echo $e1->sys['sys'];
	echo "</table></form>";
};
?>