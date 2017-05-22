<?php if (!defined('SCRIPTACCESS')) exit;
	class pager_ {
		//required
		var $name;
		var $sql;
		var $page_size=20;
		var $cookie='COO';
		//
		var $size;
		function display(){
			echo "<font class=text2>&nbsp; &nbsp Страница ".vars($this->name)." из ".$this->page_amount."</font> &nbsp;&nbsp;&nbsp;";
			$sp=floor((vars($this->name)-1)/10);
			if($sp>0) echo "&nbsp; <a class=link2 href='?".$this->name."=".(($sp-1)*10+1)."'>&lt;&lt; Предыдущие 10</a>&nbsp; ";
			$aa=$this->page_amount;
			if($aa>10) $aa=10;
			for($i=$sp*10;$i<$aa+$sp*10;$i++){
				if($i==$this->page_amount) break;
				if($i!=vars($this->name)-1) echo "<a class=text2 href='?".$this->name."=".($i+1)."'>".($i+1)."</a>";
				else echo "<font class=text2 style='color:red'><b>".($i+1)."</b></font>";
				if($i<$this->page_amount-1 && $i<($aa+$sp*10-1)) echo "<font class=text2> | </font>";
			};
			if($sp<floor($this->page_amount/10)) echo "&nbsp; <a class=link2 href='?".$this->name."=".($i+1)."'>Следующие 10 &gt;&gt;</a>";
		}
		//
		function work(){
			if(vars($this->name)!='') setcooa($this->cookie,$this->name,vars($this->name));
			else if(cooa($this->cookie,$this->name)!='') setvar($this->name,cooa($this->cookie,$this->name));
			if(vars($this->name)=='') setvar($this->name,'1');
			$cp=(int)vars($this->name);
			if($cp < 1){$cp=1;};
			$db=mysql_fetch_array(mysql_query($this->sql));
			$size=$db[0];
			$this->size=$size;
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
	};
?>