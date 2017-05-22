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
$p=new pager_();
$p->name=$t1->name.'_pager';
$p->sql="SELECT COUNT(*) FROM ".$t1->name." WHERE 1";
$p->page_size=25;
$p->cookie='COO';
$p->work();
#######################################################
$e1=new tedit();
$e1->table=&$t1;
include 'fields.php';
#######################################################
$l1=new tlist();
$l1->table=&$t1;
$l1->sql="SELECT * FROM ".$t1->name." ORDER BY pos";
$l1->sql.=" LIMIT ".$p->min.",".($p->max-$p->min);
$l1->skin='list.php';
#######################################################
#	work                                              #
#######################################################
$w1=new twork();
$w1->table=&$t1;
$w1->tree=&$t;
$w1->after_check='check1();';
function check1(){
        $s=vars::mixed('text','string');
        $s=preg_replace_callback ('/<objcms (.+?)>(<emcms (.+?)>)(.+?)<\/objcms>/is', "parseobj", $s);
        vars::setmixed('text',$s);
};	
function parseobj ($matches) {
        return ("");
}
