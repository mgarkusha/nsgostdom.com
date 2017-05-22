<?
	#######################################################
	$t=new trecord();
	$t->table=&$t1;
	$t->edit=&$e1;
	$t->work=&$w1;
	$t->list=&$l1;
	#######################################################
	$t1=new ttable();
	$t1->pos='pos';
	$t1->name=conf::$dbprefix.MODULE;
	$t1->before_store='before_store();';
	#############################################################################
	$p=new paging_();
	$p->name=$t1->name.'_pager';
	$p->sql="SELECT * FROM ".$t1->name." WHERE 1 ORDER BY pos";
	$p->work();
	#############################################################################
	$e1=new tedit();
	$e1->table=&$t1;
	include conf::$bpath.'admin/'.MODULE.'/fields.php';
	#######################################################
	$l1=new tlist();
        $l1->up = 'down';
        $l1->down = 'up';
	$l1->table=&$t1;
	$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ORDER BY pos DESC";
	$l1->skin=conf::$bpath.'admin/'.MODULE.'/list.php';
	#######################################################
	$w1=new twork();
	$w1->table=&$t1;
	$w1->tree=&$t;
	#######################################################
	function before_store() {
	    global $pic;
	    $pic->write_file();
		 global $pic1;
		 $pic1->write_file();
		 global $pic2;
		 $pic2->write_file();
	}
