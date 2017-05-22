<?php if (!defined('SCRIPTACCESS')) exit;
	class twork {
		// required
		var $table;
		var $fields;
		//
		function work(){
			if(vars('s')!='' && (string)$this->tree->error=='none'){
				if(isset($this->after_check)) eval($this->after_check);
				if((string)$this->tree->error=='none') $this->table->store();
				else $this->noaction=true;
			}elseif(vars('d')!='') $this->table->delete((int)vars('d'));
			else $this->noaction=true;
		}
		function redirect(){
			if($this->noaction!=true){
				$url='';
				if(vars('s')=='1') $url="?e=".urldecode(vars('e'));
				if(vars('at')!='') $attention_url='&at='.urldecode(vars('at'));
				if(vars('m')!='' || vars('s')!='' || vars('d')!='' || vars('at')!=''){
					$mu='ms=';
					if($this->url.$url=='') $mu="?".$mu; else $mu="&".$mu;
					if(vars('en')=='1') $m_url=$mu.'n';
					elseif(vars('s')!='') $m_url=$mu.'s';
					elseif(vars('d')!='') $m_url=$mu.'d';
					else $m_url='';

					if(vars('type')){
						$this->add2url .= '&type='.vars('type');
					}

					header('location: '.conf::$hpath.conf::$path.'/'.$this->url.$url.$m_url.$attention_url.$this->add2url);
					exit;
				};
			};
		}
	};
?>