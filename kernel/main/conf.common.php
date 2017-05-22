<?php if (!defined('SCRIPTACCESS')) exit;

session_start();

// include main modules
$dir = conf::$bpath . 'kernel/module/';
$d = dir($dir);
while ($entry = $d->read()) {
    if (is_file($dir . $entry))
        include_once($dir . $entry);
}
$d->close();

// dbconnect
conf::$dbconnect = mysql_connect(conf::$dbserver, conf::$dbuser, conf::$dbpassword);
if (!conf::$dbconnect) {
    echo "Fatal error. No database server connection.";
    exit;
}
if (!mysql_select_db(conf::$dbname)) {
    echo "Fatal error. No database.";
    exit;
}

mysql_query("SET NAMES utf8");

// path detect
$_tmp_str_ = explode('/', $_SERVER['REQUEST_URI']);
conf::$path = $_tmp_str_ = $_tmp_str_[count($_tmp_str_) - 2];
if (conf::$aside)
    conf::$path = 'admin/' . conf::$path;

// classes autoload function 
function __autoload($class) {
    $list = array('classes.static/', 'classes.engine/', 'classes/', 'classes.temp/', 'classes.engine/primitives/');
    foreach ($list as $path) {
        if (file_exists(conf::$bpath . 'kernel/' . $path . $class . '.class.php')) {
            require_once(conf::$bpath . 'kernel/' . $path . $class . '.class.php');
            return true;
        }
    };
    echo "Fatal error. Can't find class <b>$class</b>";
    exit;
}