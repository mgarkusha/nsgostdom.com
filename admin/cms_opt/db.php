<?php if (!defined('SCRIPTACCESS')) exit;

#######################################################
$t=new trecord();
$t->table=&$t1;
$t->edit=&$e1;
$t->work=&$w1;
$t->list=&$l1;
$t->name=MODULE;
#######################################################
$t1=new ttable();
$t1->name=conf::$dbprefix.MODULE;
$t1->pos='pos';
#######################################################
$e1=new tedit();
$e1->table=&$t1;
$e1->del_alert=$msg='Вы действительно желаете данный модуль пользователя?';
include 'fields.php';
#######################################################
$l1=new tlist();
$l1->table=&$t1;
//	if (vars('need')=='help'){
//		$_SESSION['need']='help';
//	}
//$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ".($_SESSION['need']=='help'?"":" AND `key` NOT IN ('META_DESCRIPTION','META_KEYWORDS','TITLE_START','TITLE_END','KEY_WORD') ")." ORDER BY pos";
$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ORDER BY pos";
$l1->del_alert=$msg;
#######################################################
$w1=new twork();
$w1->table=&$t1;
$w1->tree=&$t;