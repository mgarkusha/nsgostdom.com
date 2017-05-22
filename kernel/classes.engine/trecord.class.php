<?php if (!defined('SCRIPTACCESS')) exit;
	class trecord {
		var $table;
		var $list;
		var $edit;
		var $work;
		var $name;
		// private
		var $error='none';
		//
		function work(){
			//
			$this->table->check_self();
			//
			if(vars('e')!='') $this->error=$this->edit->work();
			$this->work->work();
			if(vars('e')=='' && isset($this->list)) $this->list->work();
			if($this->error=='none') $this->work->redirect();
		}
		//
		function display(){
			if(vars('e')!='') return $this->edit->skin;
			else return $this->list->skin;
		}
		//
		function display_message(){
			if((string)$this->error=='none'){
				if(vars('ms')!='') return $this->table->msg[vars('ms')];
			}elseif((string)$this->error=='table'){
				return $this->table->msg[$this->table->error];
			}else{
				if(vars('e')!=''){
					//print_r($this->edit->fields_names);
					if(isset($this->edit->fields_names[$this->error]))
					return $this->edit->fields[$this->edit->fields_names[$this->error]]->error_text();
					else return $this->edit->fields[$this->error]->error_text();
				}
			};
		}
		function display_attention(){
			if(vars('at')!='') return $this->table->msg[vars('at')];
		}
	};
?>