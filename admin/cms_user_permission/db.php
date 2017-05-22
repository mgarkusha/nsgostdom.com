<?php if (!defined('SCRIPTACCESS')) exit;

#############################################################################
$t=new trecord();
$t->table=&$t1;
$t->edit=&$e1;
$t->work=&$w1;
$t->list=&$l1;
$t->name=MODULE;
#############################################################################
$t1=new ttable();
$t1->name=conf::$dbprefix.MODULE;
$t1->pos='pos';
#############################################################################
include 'filter1.php';
$f1_=new filter1_();
$f1_->name=MODULE.'f1';
$f1_->cookie=COO;
$f1_->work();
$t1->filtersql=$f1_->get_sql();
#############################################################################
$e1=new tedit();
$e1->table=&$t1;
include 'fields.php';
#############################################################################
$l1=new tlist();
$l1->table=&$t1;
$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ".$f1_->get_sql()." ORDER BY `pos`";
$l1->skin='list.php';
#############################################################################
$w1=new twork();
$w1->table=&$t1;
$w1->tree=&$t;
