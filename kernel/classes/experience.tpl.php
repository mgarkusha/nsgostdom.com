<?php if (!defined('SCRIPTACCESS')) exit; ?>
<tr><td colspan=3 id=experiencetd>
</td></tr>
<tr><td colspan=3 id=ecperiencedmore>
	<table cellpadding=0 cellspacing=0 border=0>
		<tr>
			<td style='padding-left:4px;'><a href="javascript:newexperience();"><img src="/images/<?=conf::$img_dir?>secadd.gif" border=0 alt="Добавить образование."></a></td>
			<td bgcolor="#A7FBBB"><img src="/images/empty.gif" width=5 height=1></td>
			<td style='padding-left:7px;'><a href="javascript:newexperience();" style="color:#158A31;">Добавить место работы</a></td>
		</tr>
	</table>
</td></tr>
<script>
	var lastexperience=0;
	var exp4err=new Array();
	function writeexperience () {
		num=lastexperience;
		obj1=document.getElementById('experiencetd');
		
		newobj=document.createElement('div');
		newobj.setAttribute('id','experiencediv'+num);
		newobj.innerHTML+=
			//'<div id=experiencediv'+num+'>'+
				'<table border=0 cellpadding=0 cellspacing=4 width=100%>'+
					'<tr>'+
						'<td rowspan=4 height=100% valign=bottom background="/images/<?=conf::$img_dir?>secbg.gif" style="background-position:right; background-repeat:repeat-y;">'+
							'<a href="javascript:removeexperience('+num+');"><img src="/images/<?=conf::$img_dir?>secdel.gif" border=0 alt="Удалить место работы"></a>'+
						'</td>'+
						'<td width=110 nowrap class=grayfont>&nbsp;Место работы</td>'+
						'<td>&nbsp;</td>'+
						'<td width=100% id="eplace'+num+'"></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont>&nbsp;Должность</td>'+
						'<td>&nbsp;</td>'+
						'<td id="epost'+num+'"></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont valign=top>&nbsp;Функции,<br>&nbsp;достижения</td>'+
						'<td>&nbsp;</td>'+
						'<td id="elevel'+num+'" nowrap></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr>'+
						'<td class=grayfont>&nbsp;Период работы</td>'+
						'<td>&nbsp;</td>'+
						'<td id="eperiod'+num+'" nowrap></td>'+
						'<td>&nbsp;</td>'+
					'</tr>'+
					'<tr><td colspan=4><img src="/images/empty.gif" width=1 height=1></td></tr>'+
				'</table>';
			//'</div>';
			
		obj1.appendChild(newobj);		
		exp4err[num]=true;			
		lastexperience++;
		//alert(obj.innerHTML);
	};
</script>