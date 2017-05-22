<?php if (!defined('SCRIPTACCESS')) exit;
	class peducation {

		public $name;
		public $error='none';
		public $tpl;
		public $ide;
		
		protected $valuesamount=0;
		//
		
		public function work(){
			//echo conf::$utype;
			$this->tpl=conf::$bpath.'admin/account_resume/education.tpl.php';
			global $auth;
			if (conf::$utype==40 || conf::$utype==10)
				$this->ide=vars::mixed('e','int');
			else
				$this->ide=$auth->logged();
			$db=mysql::query("SELECT * FROM #resume_education WHERE account='?' ORDER BY `id`",$this->ide);
			$i=0;
			while($row=mysql::fetch($db)){
				$this->values[$i]['place']=$row['place'];
				$this->values[$i]['speciality']=$row['speciality'];
				//$this->values[$i]['id']=$row['id'];
				$this->values[$i]['level']=$row['level'];
				$this->values[$i]['type']=$row['type'];
				$this->values[$i]['year1']=$row['year1'];
				$this->values[$i]['year2']=$row['year2'];
				$i++;
			}
			$this->valuesamount=$i;
			if($this->valuesamount==0) $this->valuesamount=1;
			return true;
		}
		
		public function store(){
			global $_POST;
			//echo "<pre>"; print_r($_POST); echo "</pre>"; exit;
			//$id=$_POST['id'];
			$place=$_POST['place'];
			$speciality=$_POST['speciality'];
			$level=$_POST['level'];
			$type=$_POST['type'];
			$year1=$_POST['year1'];
			$year2=$_POST['year2'];
			global $auth;
			
			if (conf::$utype==40 || conf::$utype==10) //Переопределение
				$this->ide=vars::mixed('e','int');
			else
				$this->ide=$auth->logged();
				
			$db=mysql::query("DELETE FROM #resume_education WHERE account='?'",$this->ide);
			foreach($place as $i=>$j){
				mysql::query("INSERT INTO #resume_education (`account`,`place`,`speciality`,`level`,`type`,`year1`,`year2`) VALUES ('?','?','?','?','?','?','?');",array($this->ide,$place[$i],$speciality[$i],$level[$i],$type[$i],$year1[$i],$year2[$i]));
				//echo mysql::$lastparsedsql."<br>";
			}
			//exit;
		}

		public function display(){
			?><script>var educationsamount=<?=(int)$this->valuesamount?>;</script><?
			include $this->tpl;
			echo "<script>";
			for($i=0;$i<$this->valuesamount;$i++){
				echo 'writeeducation();';
			}
			echo "</script>";
			?>
			<script>
				<? for($i=0;$i<$this->valuesamount;$i++) {?>
					//addeducationid('<?=(int)$i?>','<?=addslashes($this->values[$i]['id'])?>');
					addeducation('place','<?=(int)$i?>','<?=addslashes($this->values[$i]['place'])?>','100%');
					addeducation('speciality','<?=(int)$i?>','<?=addslashes($this->values[$i]['speciality'])?>','100%');
					addlevel('<?=(int)$i?>','<?=addslashes($this->values[$i]['level'])?>');
					addtype('<?=(int)$i?>','<?=addslashes($this->values[$i]['type'])?>');
					addperiod('<?=(int)$i?>','<?=addslashes($this->values[$i]['year1'])?>','<?=addslashes($this->values[$i]['year2'])?>');
				<? } ?>
				function addeducation(name,num,value,width) {
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
				var where=(navigator.appName == 'Microsoft Internet Explorer')?-1:null;
				function addlevel(num,value) {
					s=document.getElementById('level'+num);
					input=document.createElement('select');
					input.setAttribute('name','level'+'['+parseInt(num)+']');
					input.setAttribute('id','level'+'['+parseInt(num)+']');
					input.className='inputselect';
					input.style.width='49%';
					//
					var db=new Array();
					db=[{num:'10',text:"Выберите уровень образования..."},
						{num:'20',text:"Неполное среднее"},
						{num:'30',text:"Среднее"},
						{num:'40',text:"Среднеспециальное"},
						{num:'50',text:"Неполное высшее"},
						{num:'60',text:"Высшее"},
						{num:'70',text:"Ученая степень"}];
					var j=0; var selind=false;
					for(var i=0;i<db.length;i++){
						newelm=document.createElement("option");
						newelm.text=db[i].text;
						newelm.value=db[i].num;
						if(db[i].num==value) selind=j;
						j++;
						input.add(newelm,where);
					}
					if(selind) input.selectedIndex=selind;
					s.appendChild(input);
				}
				function addtype(num,value) {
					ne=document.createElement('span');
					ne.innerHTML='&nbsp;';
					s.appendChild(ne);
					s=document.getElementById('level'+num);
					input=document.createElement('select');
					input.setAttribute('name','type'+'['+parseInt(num)+']');
					input.setAttribute('id','type'+'['+parseInt(num)+']');
					input.className='inputselect';
					input.style.width='50%';
					//
					var db=new Array();
					db=[{num:10,text:"Выберите тип образования..."},
						{num:20,text:"Экономическое"},
						{num:30,text:"Юридическое"},
						{num:40,text:"Финансовое"},
						{num:50,text:"Техническое"},
						{num:60,text:"Строительное"},
						{num:70,text:"Гуманитарное"},
						{num:80,text:"Медицинское"},
						{num:90,text:"Художественное"},
						{num:100,text:"Музыкальное"},
						{num:200,text:"Другое"}];
					var j=0; var selind=false;
					for(var i=0;i<db.length;i++){
						newelm=document.createElement("option");
						newelm.text=db[i].text;
						newelm.value=db[i].num;
						if(db[i].num==value) selind=j;
						j++;
						input.add(newelm,where);
					}
					if(selind) input.selectedIndex=selind;
					s.appendChild(input);
				}	
				function addperiod(num,value,value2) {
					s=document.getElementById('period'+num);
					input=document.createElement('select');
					input.setAttribute('name','year1'+'['+parseInt(num)+']');
					input.setAttribute('id','year1'+'['+parseInt(num)+']');
					input.className='inputselect';
					input.style.width='49%';
					var mydate=new Date();
					newelm=document.createElement("option"); newelm.text='Начало обучения'; newelm.value='0'; input.add(newelm,where);
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
					ne.innerHTML='&nbsp;';
					s.appendChild(ne);
					//
					input2=document.createElement('select');
					input2.setAttribute('name','year2'+'['+parseInt(num)+']');
					input2.setAttribute('id','year2'+'['+parseInt(num)+']');
					input2.className='inputselect';
					input2.style.width='50%';
					//
					var mydate=new Date();
					newelm=document.createElement("option"); newelm.text='Окончание обучения'; newelm.value='0'; input2.add(newelm,where);
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
				}
											
//					function addeducationid(num,value) {
//						name='place';
//						s=document.getElementById(name+num);
//						input=document.createElement('input');
//						input.setAttribute('type','hidden');
//						input.setAttribute('name','eduid'+'['+num+']');
//						s.appendChild(input);
//						input.setAttribute('value',value);
//					}					
				function neweducation(){
					if(educationsamount==5) {
						alert("Достаточно.");
						return;
					};
					writeeducation();
					addeducation('place',lasteducation-1,'','100%');
					addeducation('speciality',lasteducation-1,'','100%');
					addlevel(lasteducation-1,'');
					addtype(lasteducation-1,'');
					addperiod(lasteducation-1,'')
					educationsamount++;
				}
				function removeeducation(num){
					if(confirm("Действительно удалить?")){
						obj=document.getElementById('educationtd');
						rem=document.getElementById('educationdiv'+num);
						obj.removeChild(rem)
						//obj.innerHTML='';
						educationsamount--;
						ed4err[num]=false;
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