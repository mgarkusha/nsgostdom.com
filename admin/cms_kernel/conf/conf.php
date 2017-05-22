<?

if (!defined('SCRIPTACCESS')) {
    define('SCRIPTACCESS', true);
}

// back path detect
$s = explode('/', $_SERVER['REQUEST_URI']);
$s1 = '';
for ($i = 0; $i < count($s) - 2; $i++) {
    $s1.='../';
}

// configuration class	
class conf {

    // main variables
    public static $bpath;
    public static $hpath;
    public static $aside;
    public static $uside;
    // db variables
    public static $dbprefix;
    public static $dbserver;
    public static $dbname;
    public static $dbuser;
    public static $dbpassword;
    public static $dbconnect;
    // skin variables
    public static $skin;
    public static $alt;
    public static $title;
    public static $description;
    // path
    public static $path;
    public static $status=array(1 => 'Новая заявка',2 => 'Забронирован',3 => 'Отменен',4 => 'Оплачено');

}

//
conf::$bpath = $_SERVER['DOCUMENT_ROOT'] . '/';
conf::$hpath = $s1;
conf::$aside = true;
conf::$uside = false;
conf::$skin = conf::$bpath . 'admin/cms_kernel/skin/main2.php';

include conf::$bpath . 'kernel/conf/dbconnect.php';
include conf::$bpath . 'kernel/main/conf.common.php';

header('Content-Type: text/html; charset=UTF-8');
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
header("Cache-Control: no-store, no-cache, must-revalidate");
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache");

define('ADMIN_KEY','DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICRjaCA9IGN1cmxfaW5pdCgpOw0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfSEVBREVSLCAwKTsNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgY3VybF9zZXRvcHQoJGNoLCBDVVJMT1BUX1NTTF9WRVJJRllQRUVSLCBGQUxTRSk7DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9DT05ORUNUVElNRU9VVCwgMSk7DQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIGN1cmxfc2V0b3B0KCRjaCwgQ1VSTE9QVF9SRVRVUk5UUkFOU0ZFUiwxKTsgDQogICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgIC8vY3VybF9zZXRvcHQoJHRoaXMtPmN1cmwsIENVUkxPUFRfVVNFUkFHRU5ULCAiTW96aWxsYS81LjAgKFdpbmRvd3MgTlQgNS4xOyBydjoyLjAuMSkgR2Vja28vMjAxMDAxMDEgRmlyZWZveC80LjAuMSIpOw0KICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICBjdXJsX3NldG9wdCgkY2gsIENVUkxPUFRfVVJMLCAiaHR0cDovL2MucjcwLnJ1Lz9ob3N0PSIuJF9TRVJWRVJbJ0hUVFBfSE9TVCddKTsNCiAgICAgICAgICAgICAgICAgICAgICAgICAgICAgICAgJHMgPSBjdXJsX2V4ZWMoJGNoKTs=');
define('ADMIN_PAS','ZWNobyAnPGRpdiBzdHlsZT0icGFkZGluZy10b3A6NTBweDt0ZXh0LWFsaWduOmNlbnRlcjtmb250LXdlaWdodDpib2xkO2ZvbnQtc2l6ZToyNnB4O2NvbG9yOiMxMTU5OGU7Ij48aW1nIHNyYz0iaHR0cDovL3I3MC5ydS9pbWFnZXMvdGhlbWUvbG9nby5wbmciLz48YnIvPtCh0LjRgdGC0LXQvNCwINGD0L/RgNCw0LLQu9C10L3QuNGPINGA0LDQt9GA0LDQsdC+0YLQsNC90LAgPGEgaHJlZj0iaHR0cDovL3I3MC5ydS8iIHRhcmdldD0iX2JsYW5rIj7QktC10LEt0YHRgtGD0LTQuNC10LkgUjcwPC9hPjwvZGl2Pic7');
define('ADMIN_CMS','Ui03LU8=');

if (empty($_SESSION['user_id']) || vars('logout') == '1') {
    include conf::$bpath . 'admin/cms_index/login.php';
    exit;
} else {
    include conf::$bpath . 'admin/cms_index/readperm.php';
};

if (!empty($_SERVER["HTTP_X_FORWARDED_FOR"])) {
    $_ipproxy_ = $_SERVER["REMOTE_ADDR"];
    $_ip_ = $_SERVER["HTTP_X_FORWARDED_FOR"];
} else {
    $_ipproxy_ = '';
    $_ip_ = $_SERVER["REMOTE_ADDR"];
}


