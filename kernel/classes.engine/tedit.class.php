<?php if (!defined('SCRIPTACCESS')) exit;
	class tedit {
		// http vars used 'e','s'
		//required
		var $table;
		var $form='one';
		var $fields;
		var $del_alert='Вы действительно желаете удалить эту запись?';
		//private
		var $sys;
		var $error='none';
		var $js='';
		
		function __construct(){
			if(conf::$uside) $this->skin=conf::$bpath.'admin/uside_'.MODULE.'/edit.php';
			if(conf::$aside) $this->skin=conf::$bpath.'admin/'.MODULE.'/edit.php';
		}
		
		//
		function work(){
			$i=0;
			foreach($this->fields as $num=>$f){
				$this->fields_names[$f->name]=$i;
				$i++;
			}
			if(vars('s')!=""){
				if(vars('r')!='1') {
					for($i=0;$i<count($this->fields);$i++){
						if(!$this->fields[$i]->work()){
							$this->error=$i;
							break;
						};
					};
				};
			};
			$sql="SELECT * FROM ".$this->table->name." WHERE ".$this->table->primary."=".vars('e');
			//echo $sql;
			if(vars('e')!='n' && (int)vars('e')>0 && vars('s')=="" && vars('r')=='') $row=mysql_fetch_array(mysql_query($sql));
			else{
				for($i=0;$i<count($this->fields);$i++){
					if($this->fields[$i]->name!=$this->table->primary) $row[$this->fields[$i]->name]=vars($this->fields[$i]->name);
				};
			};
			for($i=0;$i<count($this->fields);$i++){
				setvar($this->fields[$i]->name,$row[$this->fields[$i]->name]);
				//echo $this->fields[$i]->name."-".$row[$this->fields[$i]->name]."<br>";
			};
			$this->sys['sys']="<input type=hidden name=e value='".htmlspecialchars(vars('e'))."'><input type=hidden name=s><input type=hidden name=r value=1>
					<script>
						function store_(v){
							".($this->js?$this->js:'')."
							document.".$this->form.".s.value=v;
							document.".$this->form.".r.value='';
							document.".$this->form.".submit();
						};
					</script>";
			$this->sys['store']="javascript:store_(1);";
			$this->sys['store&back']="javascript:store_(2);";
			$this->sys['delete']='javascript:if(confirm("'.$this->del_alert.'"))document.location.href="?d='.(int)vars('e').'"';
			return $this->error;
		}
		function display(){
			return;
			for($i=0;$i<count($this->fields);$i++){
				setvar($this->fields[$i]->name,$row[$this->fields[$i]->name]);
				if((string)$this->fields[$i]->error!='none' && $_out_['error']==''){
					$_out_['error']=$this->fields[$i]->error_text[$this->fields[$i]->error];
				}
			};
		}
	};
?>