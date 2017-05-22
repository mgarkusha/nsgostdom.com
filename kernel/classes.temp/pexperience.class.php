<?php if (!defined('SCRIPTACCESS')) exit;
	class pexperience {

		public $name;
		public $error='none';
		public $tpl;
		
		protected $valuesamount=0;
		//
		
		public function work(){
			$this->tpl=conf::$bpath.'admin/account_resume/experience.tpl.php';
			global $auth;
			$db=mysql::query("SELECT * FROM #resume_experience WHERE account='?' ORDER BY `id`",$auth->logged());
			$i=0;
			while($row=mysql::fetch($db)){
				$this->values[$i]['eplace']=$row['place'];
				$this->values[$i]['epost']=$row['post'];
				$this->values[$i]['elevel']=$row['level'];
				$this->values[$i]['eyear1']=$row['year1'];
				$this->values[$i]['eyear2']=$row['year2'];
				$this->values[$i]['month1']=$row['month1'];
				$this->values[$i]['month2']=$row['month2'];
				$i++;
			}
			$this->valuesamount=$i;
			return true;
		}
		
		public function store(){
			global $HTTP_POST_VARS;
			//echo "<pre>"; print_r($HTTP_POST_VARS); echo "</pre>"; exit;
			//$id=$HTTP_POST_VARS['id'];
			$place=$HTTP_POST_VARS['eplace'];
			$post=$HTTP_POST_VARS['epost'];
			$level=$HTTP_POST_VARS['elevel'];
			$year1=$HTTP_POST_VARS['eyear1'];
			$year2=$HTTP_POST_VARS['eyear2'];
			$month1=$HTTP_POST_VARS['month1'];
			$month2=$HTTP_POST_VARS['month2'];
			global $auth;
			$db=mysql::query("DELETE FROM #resume_experience WHERE account='?'",$auth->logged());
			foreach($place as $i=>$j){
				mysql::query("INSERT INTO #resume_experience (`account`,`place`,`post`,`level`,`year1`,`year2`,`month1`,`month2`) VALUES ('?','?','?','?','?','?','?','?');",array($auth->logged(),$place[$i],$post[$i],$level[$i],$year1[$i],$year2[$i],$month1[$i],$month2[$i]));
				//echo mysql::$lastparsedsql."<br>";
			}
			//exit;
		}

		public function display(){
			?><script>var experiencesamount=<?=(int)$this->valuesamount?>;</script><?
			include $this->tpl;
			echo "<script>";
			for($i=0;$i<$this->valuesamount;$i++){
				echo 'writeexperience();';
			}
			echo "</script>";
			?>
			<script>
				<? for($i=0;$i<$this->valuesamount;$i++) {?>
					addexperience('eplace','<?=(int)$i?>','<?=addslashes($this->values[$i]['eplace'])?>','100%');
					addexperience('epost','<?=(int)$i?>','<?=addslashes($this->values[$i]['epost'])?>','100%');
					addelevel('<?=(int)$i?>','<?=str::chr13replace(addslashes($this->values[$i]['elevel']))?>');
					addeperiod('<?=(int)$i?>','<?=addslashes($this->values[$i]['eyear1'])?>','<?=addslashes($this->values[$i]['eyear2'])?>','<?=addslashes($this->values[$i]['month1'])?>','<?=addslashes($this->values[$i]['month2'])?>');
				<? } ?>
				function addexperience(name,num,value,width) {
					s=document.getElementById(name+num);
					input=document.createElement('input');
					input.setAttribute('type','text');
					input.setAttribute('name',name+'['+parseInt(num)+']');
					input.setAttribute('id',name+'['+parseInt(num)+']');
					input.className='inputtext';
					s.appendChild(input);
					input.setAttribute('value',value);
					input.style.width = width;
				}
				function addelevel(num,value) {
					var name='elevel';
					s=document.getElementById(name+num);
					input=document.createElement('textarea');
					input.setAttribute('name',name+'['+parseInt(num)+']');
					input.setAttribute('id',name+'['+parseInt(num)+']');
					input.className='inputtextarea';
					s.appendChild(input);
					input.setAttribute('value',value);
					input.style.width = '100%';
					input.style.height = 60;
				}
				function addeperiod(num,value,value2,month,month2) {
					var mo=new Array();
					mo=[{num:1,name:'Января'},{num:2,name:'Февряля'},{num:3,name:'Марта'},{num:4,name:'Апреля'},{num:5,name:'Мая'},{num:6,name:'Июня'},{num:7,name:'Июля'},{num:8,name:'Августа'},{num:9,name:'Сентября'},{num:10,name:'Октября'},{num:11,name:'Ноября'},{num:12,name:'Декабря'}];
					s=document.getElementById('eperiod'+num);
					//s.appendChild(input);
					ne=document.createElement('span');
					ne.innerHTML='с&nbsp;';
					s.appendChild(ne);
					// month1
					input=document.createElement('select');
					input.setAttribute('name','month1'+'['+parseInt(num)+']');
					input.setAttribute('id','month1'+'['+parseInt(num)+']');
					input.className='inputselect';
					input.style.width='15%';
					newelm=document.createElement("option"); newelm.text='Месяц'; newelm.value='0'; input.add(newelm,where);
					var j=1; var selind=false;
					for(var i=1;i<=12;i++){
						newelm=document.createElement("option");
						newelm.text=mo[i-1].name;
						newelm.value=i;
						if(i==month) selind=j;
						j++;
						input.add(newelm,where);
					}
					if(selind) input.selectedIndex=selind;
					s.appendChild(input);
					// year1
					input=document.createElement('select');
					input.setAttribute('name','eyear1'+'['+parseInt(num)+']');
					input.setAttribute('id','eyear1'+'['+parseInt(num)+']');
					input.className='inputselect';
					input.style.width='15%';
					var mydate=new Date();
					newelm=document.createElement("option"); newelm.text='Год'; newelm.value='0'; input.add(newelm,where);
					var j=1; var selind=false;
					for(var i=mydate.getFullYear();i>=1960;i--){
						newelm=document.createElement("option");
						newelm.text=i;
						newelm.value=i;
						if(i==value) selind=j;
						j++;
						input.add(newelm,where);
					}
					if(selind) input.selectedIndex=selind;
					s.appendChild(input);
					ne=document.createElement('span');
					ne.innerHTML='&nbsp;-ого года, по&nbsp;';
					s.appendChild(ne);
					// month 2
					mo2=new Array();
					mo2=[{num:1,name:'Январь'},{num:2,name:'Февраль'},{num:3,name:'Март'},{num:4,name:'Апрель'},{num:5,name:'Май'},{num:6,name:'Июнь'},{num:7,name:'Июль'},{num:8,name:'Август'},{num:9,name:'Сентябрь'},{num:10,name:'Октябрь'},{num:11,name:'Ноябрь'},{num:12,name:'Декабрь'}];
					input2=document.createElement('select');
					input2.setAttribute('name','month2'+'['+parseInt(num)+']');
					input2.setAttribute('id','month2'+'['+parseInt(num)+']');
					input2.className='inputselect';
					input2.style.width='15%';
					newelm=document.createElement("option"); newelm.text='Месяц'; newelm.value='0'; input2.add(newelm,where);
					var j=1; var selind=false;
					for(var i=1;i<=12;i++){
						newelm=document.createElement("option");
						newelm.text=mo2[i-1].name;
						newelm.value=i;
						if(i==month2) selind=j;
						j++;
						input2.add(newelm,where);
					}
					if(selind) input2.selectedIndex=selind;
					s.appendChild(input2);
					// year 2
					input2=document.createElement('select');
					input2.setAttribute('name','eyear2'+'['+parseInt(num)+']');
					input2.setAttribute('id','eyear2'+'['+parseInt(num)+']');
					input2.className='inputselect';
					input2.style.width='15%';
					//
					var mydate=new Date();
					newelm=document.createElement("option"); newelm.text='Год'; newelm.value='0'; input2.add(newelm,where);
					j=1; selind=false;
					for(var i=mydate.getFullYear();i>=1960;i--){
						newelm=document.createElement("option");
						newelm.text=i;
						newelm.value=i;
						if(i==value2) selind=j;
						j++;
						input2.add(newelm,where);
					}
					if(selind) input2.selectedIndex=selind;
					s.appendChild(input2);
					ne=document.createElement('span');
					ne.innerHTML='&nbsp;-ого года.';
					s.appendChild(ne);
				}
											
				function newexperience(){
					if(experiencesamount==10) {
						alert("Достаточно.");
						return;
					};
					writeexperience();
					addexperience('eplace',lastexperience-1,'','100%');
					addexperience('epost',lastexperience-1,'','100%');
					addelevel(lastexperience-1,'');
					addeperiod(lastexperience-1,'')
					experiencesamount++;
				}
				function removeexperience(num){
					if(confirm("Действительно удалить?")){
						obj=document.getElementById('experiencetd');
						rem=document.getElementById('experiencediv'+num);
						obj.removeChild(rem)
						exp4err[num]=false;
						experiencesamount--;
					};
				}
			</script>
			<?
		}
		
		public function error_text(){
			return '';
		}
		
	};
?>