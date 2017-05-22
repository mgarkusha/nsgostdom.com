<?

define('MODULE', 'sitemap');
include '../cms_kernel/conf/conf.php';

include "db.php";

if (vars::mixed('first_set', 'int') != 0) {
    mysql::query("UPDATE #sitemap SET first=''");
    mysql::query("UPDATE #sitemap SET first='1' WHERE id='?'", array(vars::mixed('first_set', 'int')));
    remove_hash(vars::mixed('first_set', 'int'));
}

if (vars::mixed('d', 'string') != '') {
    $rs = mysql::selectrow("SELECT COUNT(*) as `cnt` FROM #sitemap WHERE parent='?'", array(vars::mixed('d', 'int')));
    if ($rs['cnt'] > 0) {
        vars::setmixed('d', '');
        vars::setmixed('ms', 'ch');
    };
};

$t->work();

define('CONTENT', $t->display());

include conf::$skin;