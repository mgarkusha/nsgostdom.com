<?php if (!defined('SCRIPTACCESS')) exit;
	class paging_ {
		//required
		var $name;
		var $sql;
		var $page_size=25;
		var $cookie='COO';
		var $size;
		var $pages=10;
		var $skin='
			<begin><font class=text></begin>
			<header><font class=text>Стр. {current_page} из {pages_amount}&nbsp;&nbsp;</font></header>
			<previous><a class=link2 href="{url}">&lt;&lt;</a>&nbsp;&nbsp;</previous>
			<next>&nbsp;&nbsp;<a class=link2 href="{url}">&gt;&gt;</a></next>
			<pages><a class=link2 href="{url}">{page}</a></pages>
			<active_page><font class=text>{page}</font></active_page>
			<separator><font class=text>&nbsp;|&nbsp;</font></separator>
			<end></font></end>
		';
		function display(){
			echo str_replace('{size}',$this->size,_tag($this->skin,'begin'));
			echo _replace(_tag($this->skin,'header'),array('current_page','pages_amount'),array(vars($this->name),(string)$this->page_amount));
			$sp=floor((vars($this->name)-1)/$this->pages);
			if($sp>0) echo _replace(_tag($this->skin,'previous'),'url',"?".$this->name."=".(($sp-1)*$this->pages+1).$this->url);
			$aa=$this->page_amount;
			if($aa>$this->pages) $aa=$this->pages;
			for($i=$sp*$this->pages;$i<$aa+$sp*$this->pages;$i++){
				if($i==$this->page_amount) break;
				if($i!=vars($this->name)-1) echo _replace(_tag($this->skin,'pages'),array('url','page'),array("?".$this->name."=".($i+1).$this->url,(string)($i+1)));
				else echo _replace(_tag($this->skin,'active_page'),'page',(string)($i+1));
				if($i<$this->page_amount-1 && $i<($aa+$sp*$this->pages-1)) echo _tag($this->skin,'separator');
			};
			if($sp<floor($this->page_amount/$this->pages)) echo _replace(_tag($this->skin,'next'),'url',"?".$this->name."=".($i+1).$this->url);
			echo _tag($this->skin,'end');
		}
		//
		function work(){
			if(vars($this->name)!='') setcooa($this->cookie,$this->name,vars($this->name));
			else if(cooa($this->cookie,$this->name)!='') setvar($this->name,cooa($this->cookie,$this->name));
			if(vars($this->name)=='') setvar($this->name,'1');
			$cp=(int)vars($this->name);
			if($cp < 1){$cp=1;};
			if($this->size==0 && isset($this->sql)){
				$db=mysql_fetch_array(mysql_query($this->sql));
				$size=$db[0];
				$this->size=$size;
			}else $size=$this->size;
			$pa=floor($size/$this->page_size);
			if($pa*$this->page_size < $size){$pa++;};	
			if($cp>$pa) $cp=1;
			setvar($this->name,$cp);
			$min = $this->page_size*($cp-1);
			$max = $this->page_size*$cp;
			$this->page_amount=$pa;
			$this->min=$min;
			$this->max=$max;
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