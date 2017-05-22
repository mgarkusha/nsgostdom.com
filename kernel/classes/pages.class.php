<?php if (!defined('SCRIPTACCESS')) exit;
	class pages {

		public $name;
		public $sql;
		public $page_size=25;
		public $size;
		public $pages=10;
		public $url;
		public $tpl;
		public $js;
		//
		protected $link=array();
		protected $separetor=array();
		protected $active=array();

		function display(){
			$p=&$this;
			if (file_exists($this->tpl)) include($this->tpl);
		}

		function work(){
			if(vars::mixed($this->name,'int')==0) vars::setmixed($this->name,1);
			$cp=vars::mixed($this->name,'int');
			if($cp < 1) $cp=1;
			//
			if($this->size==0 && isset($this->sql)){
				$db=mysql_fetch_array(mysql_query($this->sql));
				$size=$db[0];
				$this->size=$size;
			}else $size=$this->size;
			//
			$pa=floor($size/$this->page_size);
			if($pa*$this->page_size < $size) $pa++;
			if($cp>$pa) $cp=1;
			vars::setmixed($this->name,$cp);
			//
			$min = $this->page_size*($cp-1);
			$max = $this->page_size*$cp;
			$this->page_amount=$pa;
			$this->min=$min;
			$this->max=$max;
			
			// tpl prepare
			$ps=$this->page_size;
			$pp=$this->pages;
			$this->cp=$cp;
			//	
			$p1=$cp-$pp;
			$p2=$cp+$pp;
			
			if($p1==2) {$p1=1; $p2--;};
			if($p1==3) {$p1=1; $p2-=2;};
			if($p1<=0) {$p2+=abs($p1)+1; $p1=1;};
			
			if($p2>=$pa) {$p1-=abs($pa-$p2); $p2=$pa;};
			if($p2==$pa-1) {$p2=$pa; $p1++;};
			if($p2==$pa-2) {$p2=$pa; $p1+=2;};
			
			if($p1<=0) $p1=1;
			if($p2>$pa) $p1=$pa;
			//
			
			//$sp=floor((vars($this->name)-1)/$this->pages);
			if($p1>1) $this->previous='?'.$this->name.'='.($p1-1).$this->url;
			
			//$aa=$this->page_amount;
			//if($aa>$this->pages) $aa=$this->pages;
			for($i=$p1-1;$i<=$p2-1;$i++){
				$this->link[$i+1]='?'.$this->name.'='.($i+1).$this->url;
				if($i==vars::mixed($this->name,'int')-1){
					$this->active[$i+1]=true; 
				}
				if($i<$this->page_amount-1) $this->separator[$i+1]=true;
			};
			if($p2<$pa) $this->next='?'.$this->name.'='.($i+1).$this->url;
			
			if(vars::mixed($this->name,'int')>1){
				$this->previons2='?'.$this->name.'='.(vars::mixed($this->name,'int')-1).$this->url; 
				$this->js.='var ctrlprevions="'.$this->previons2.'";';
			}else{
				$this->previons2=false;
				$this->js.='var ctrlprevions=false;';
			}
			if(vars::mixed($this->name,'int')<$this->page_amount){
				$this->next2='?'.$this->name.'='.(vars::mixed($this->name,'int')+1).$this->url;
				$this->js.='var ctrlnext="'.$this->next2.'";';
			}else{
				$this->next2=false;
				$this->js.='var ctrlnext=false;';
			}
			$this->firstpage='?'.$this->name.'=1'.$this->url;
			$this->lastpage='?'.$this->name.'='.$this->page_amount.$this->url;
		}
		function reset(){
			setvar($this->name,"1");
			setcooa($this->cookie,$this->name,vars($this->name));
		}
		function limit(){
			return " LIMIT ".$this->min.",".($this->max-$this->min);
		}
	};
?>