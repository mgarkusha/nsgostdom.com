<?php if (!defined('SCRIPTACCESS')) exit;

if (empty($_GET['parent'])) {
    if (isset($_COOKIE['parent']))
        $parent = $_COOKIE['parent'];
    else
        $parent = 0;
}else {
    $parent = $_GET['parent'];
    if ($parent == 'null')
        $parent = 0;
    setcookie('parent', $parent, null, '/');
};
#######################################################
$t = new trecord();
$t->table = &$t1;
$t->edit = &$e1;
$t->work = &$w1;
$t->list = &$l1;
$t->name = MODULE;
#######################################################
$t1 = new ttable();
$t1->name = conf::$dbprefix . 'sitemap';
$t1->primary = 'id';
$t1->pos = 'pos';
$t1->before_delete = 'remove_hash(#);';
$t1->after_store = 'remove_hash(#);';
$t1->filtersql = " AND `parent` = " . (int)$parent;
$t1->msg['ch'] = 'Нельзя удалить раздел, т.к. он содержит подразделы!';
#######################################################
#	edit                                              #
#######################################################
$e1 = new tedit();
$e1->table = &$t1;
include 'fields.php';
#######################################################
#	list                                              #
#######################################################
$l1 = new tlist();
$l1->table = &$t1;
$l1->sql = "SELECT * FROM " . $t1->name . " WHERE 1 AND parent=" . (int)$parent . " ORDER BY pos";
$l1->pos_sql = " AND parent=" . (int)$parent . "";
#######################################################
#	work                                              #
#######################################################
$w1 = new twork();
$w1->table = &$t1;
$w1->tree = &$t;
$w1->after_check = 'check1();';

function remove_hash($id) {
    if (is_file(conf::$bpath . 'kernel/temp/sitemap.hash')) {
        unlink(conf::$bpath . 'kernel/temp/sitemap.hash');
    }
    
    if (is_file(conf::$bpath . 'kernel/temp/sitemap-' . (int)$id)) {
        unlink(conf::$bpath . 'kernel/temp/sitemap-' . (int)$id);
    }
    mysql_query("UPDATE `" . conf::$dbprefix . "sitemap` SET `included_modules` = '' WHERE `id` = " . (int)$id);
}

function check1() {
    global $t, $alias;
    $err = false;
    if (trim(vars::mixed('alias', 'string')) != '') {
        $sql = "SELECT COUNT(*) as `cnt` FROM " . conf::$dbprefix . "sitemap WHERE alias='?'";
        $p = array(trim(vars::mixed('alias', 'string')));
        if (vars::mixed('e', 'string') != 'n') {
            $sql.=" AND id!='?'";
            $p[] = vars::mixed('e', 'int');
        }
        $r = mysql::selectrow($sql, $p);
        if ($r['cnt'] > 0) {
            $alias->error = 'dr';
            $t->error = 'alias';
            $err = true;
        }
    }
    if (!$err) {
        if (//!ereg('([A-z,0-9]{' . strlen(vars::mixed('alias', 'string')) . ',})', vars::mixed('alias', 'string')) ||
                //!ereg('([A-z]{1,})', vars::mixed('alias', 'string')) && vars::mixed('alias', 'string') != '' ||
                trim(vars::mixed('alias', 'string')) == 'admin' || trim(vars::mixed('alias', 'string')) == 'images' ||
                trim(vars::mixed('alias', 'string')) == 'kernel' || trim(vars::mixed('alias', 'string')) == 'files') {
            $alias->error = 'in';
            $t->error = 6;
            $err = true;
        };
    }
}
