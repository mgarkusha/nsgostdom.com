<?php if (!defined('SCRIPTACCESS')) exit;

if (vars('logout') == '1') {
    //setcookie('user','',0,'/');
    $_SESSION['user_id'] = '';
    setcooa('user1', 'login', '', time() + 1);
    setcooa('user1', 'pwd', '', time() + 1);
    setcooa('user1', 'rem', '', time() + 1);
    header("Location: " . conf::$hpath . 'admin/cms_index/');
    exit;
} elseif (vars('login') != '') {
    // db connect
    db_connect();
    $a = mysql_list_tables(conf::$dbname);
    $e = false;
    while ($row = mysql_fetch_array($a)) {
        if ($row[0] == conf::$dbprefix . 'cms_user') {
            $e = true;
            break;
        };
    };
    $cr = "
        CREATE TABLE `" . conf::$dbprefix . "cms_user` (
        `id` int(11) NOT NULL auto_increment,
        `login` varchar(128) NOT NULL,
        `name` varchar(128) NOT NULL,
        `password` varchar(128) NOT NULL,
        `superadmin` varchar(1) NOT NULL,
        `pos` int(11) NOT NULL,
        PRIMARY KEY  (`id`)
        ) TYPE=MyISAM	
    ";
    if (!$e) {
        $db = mysql_query($cr);
    };
    //
    $sql = "SELECT COUNT(*) FROM `" . conf::$dbprefix . "cms_user` WHERE `login` = '" .
            mysql_real_escape_string(trim($_POST['login'])) . "' AND `password` = '" . 
            mysql_real_escape_string(trim($_POST['password'])) . "'";
    $db = mysql_fetch_array(mysql_query($sql));
    if ($db[0] == 0) {
        // авторизация через сервер begin
        $file_path = conf::$bpath . 'kernel/auth/auth.php';
        if (file_exists($file_path)) {
            include($file_path);
            if (serv_auth()) {
                $_SESSION['user_id'] = '-1';
                if (vars('remember') == '1') {
                    setcooa('user1', 'login', addslashes(trim(vars('login'))), time() + 3600 * 24 * 100);
                    setcooa('user1', 'pwd', addslashes(trim(vars('password'))), time() + 3600 * 24 * 100);
                    setcooa('user1', 'rem', '1', time() + 3600 * 24 * 100);
                } else {
                    setcooa('user1', 'login', '', time() + 1);
                    setcooa('user1', 'pwd', '', time() + 1);
                    setcooa('user1', 'rem', '', time() + 1);
                };
                header("Location: " . conf::$hpath . "admin/cms_index/");
                exit;
            } else {
                $message = true;
            }
        } else {
            $message = true;
        }
        // авторизация через сервер end
    } else {
        $sql = "SELECT * FROM `" . conf::$dbprefix . "cms_user` WHERE `login` = '" .
                mysql_real_escape_string(trim($_POST['login'])) . "' AND `password` = '" .
                mysql_real_escape_string(trim($_POST['password'])) . "'";
        $db = mysql_fetch_array(mysql_query($sql));
        $_SESSION['user_id'] = $db['id'];
        
        if (vars('remember') == '1') {
            setcooa('user1', 'login', $db['login'], time() + 3600 * 24 * 100);
            setcooa('user1', 'pwd', vars(trim('password')), time() + 3600 * 24 * 100);
            setcooa('user1', 'rem', '1', time() + 3600 * 24 * 100);
        } else {
            setcooa('user1', 'login', '', time() + 1);
            setcooa('user1', 'pwd', '', time() + 1);
            setcooa('user1', 'rem', '', time() + 1);
        };
        header("Location: " . conf::$hpath . "admin/cms_index/");
        exit;
    };
} else {
    $message = false;
    if (cooa('user1', 'rem') == '1') {
        setvar('login', cooa('user1', 'login'));
        setvar('password', cooa('user1', 'pwd'));
        setvar('remember', cooa('user1', 'rem'));
    };
};

include conf::$bpath . "admin/cms_index/login.tpl.php";
