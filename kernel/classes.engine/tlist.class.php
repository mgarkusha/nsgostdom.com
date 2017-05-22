<?php if (!defined('SCRIPTACCESS')) exit;
	class tlist {
		// http vars used: 'e','d','m','k'
		// required
		var $sql;
		var $table;
		var $skin='list.php';
		var $del_alert='Вы действительно желаете удалить эту запись?';
		// public
		var $sys;
		// private
		var $db;
		var $up='up';
		var $down='down';
		
		function __construct(){
			if(conf::$uside) $tihs->skin=conf::$bpath.'admin/uside_'.MODULE.'/list.php';
			else $this->skin=conf::$bpath.'admin/'.MODULE.'/list.php';	
		}
		
		//
		function work(){
			if(vars('m')!=''){
				if(vars('m')=='up') $this->table->moverecord($this->up); else $this->table->moverecord($this->down);
			}
			$this->db=mysql_query($this->sql);
			$this->sys['button']="?e=n";
		}
		//
		function fetch(){
			$row=mysql_fetch_assoc($this->db);
			if($row){
				foreach ($row as $name => $value) $this->$name=$value;;
				$this->sys['go']="?g=".$row[$this->table->primary];
				$this->sys['go2']="?l=".(vars('_LEVEL_')+1)."&k=".$row[$this->table->primary];
				$this->sys['up']="?m=up&k=".$row[$this->table->primary];
				$this->sys['down']="?m=dn&k=".$row[$this->table->primary];
				$this->sys['delete']="?d=".$row[$this->table->primary];
				$this->sys['edit']="?e=".$row[$this->table->primary];
				return true;
			}else return false;
		}
	};
?>