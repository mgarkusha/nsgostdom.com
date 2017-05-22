<?php if (!defined('SCRIPTACCESS')) exit; ?>
<tr><td colspan=3 id=educationtd>
</td></tr>
<tr><td colspan=3 id=educationtdmore>
	<table cellpadding=0 cellspacing=0 border=0>
		<tr>
			<td style='padding-left:4px;'><a href="javascript:neweducation();"><img src="/images/<?=conf::$img_dir?>secadd.gif" border=0 alt="Добавить образование."></a></td>
			<td bgcolor="#A7FBBB"><img src="/images/empty.gif" width=5 height=1></td>
			<td style='padding-left:7px;'><a href="javascript:neweducation();" style="color:#158A31;">Добавить образование</a></td>
		</tr>
	</table>
</td></tr>
<script>
	var lasteducation=0;
	var ed4err=new Array();
	function writeeducation () {
		num=lasteducation;
		obj1=document.getElementById('educationtd');
		
		newobj=document.createElement('div');
		newobj.setAttribute('id','educationdiv'+num);
		newobj.innerHTML+=
			//'<div id=educationdiv'+num+'>'+
				'<table border=0 cellpadding=0 cellspacing=4 width=100% height=100%>'+
					'<tr height=100%>'+
						'<td rowspan=4 height=100% valign=bottom background="/images/<?=conf::$img_dir?>secbg.gif" style="background-position:right; background-repeat:repeat-y;">'+
							'<a href="javascript:removeeducation('+num+');"><img src="/images/<?=conf::$img_dir?>secdel.gif" border=0 alt="Удалить образование."></a>'+
						'</td>'+
						'<td width=110 nowrap class=grayfont>&nbsp;Место обучения</td>'+
						'<td>&nbsp;</td>'+
						'<td width=100% id="place'+num+'"></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont>&nbsp;Специальность</td>'+
						'<td>&nbsp;</td>'+
						'<td id="speciality'+num+'"></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont>&nbsp;Образование</td>'+
						'<td>&nbsp;</td>'+
						'<td id="level'+num+'" nowrap></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont>&nbsp;Период обучения</td>'+
						'<td>&nbsp;</td>'+
						'<td id="period'+num+'" nowrap></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr><td colspan=4><img src="/images/empty.gif" width=1 height=1></td></tr>'+
				'</table>';
			//'</div>';
			
		obj1.appendChild(newobj);	
		ed4err[num]=true;				
		lasteducation++;
		//alert(obj.innerHTML);
	};
</script>