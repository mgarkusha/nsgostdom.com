<?php if (!defined('SCRIPTACCESS')) exit;

if ($_SESSION['user_id'] != '-1') {
    $sql = "SELECT COUNT(*) FROM `" . conf::$dbprefix . "cms_user` WHERE `id` = " . (int)$_SESSION['user_id'];
    $db = mysql_fetch_array(mysql_query($sql));
    if ($db[0] == 0){
        echo "Неизвестная ошибка.";
        exit;
    };
    $sql = "SELECT * FROM `" . conf::$dbprefix . "cms_user` WHERE `id` = " . (int)$_SESSION['user_id'];
    $db = mysql_fetch_array(mysql_query($sql));
    if ($db['superadmin'] == '1') {
        $_useradmin_ = true; 
    } else {
        $_useradmin_ = false;
    };
    $_userlogin_ = $db['login'];
    $_username_ = $db['name'];
    $sql = "SELECT * FROM `" . conf::$dbprefix . "cms_user_permission` WHERE `userid` = " . (int)$_SESSION['user_id'];
    $db = mysql_query($sql);
    $_acc_ = false;
} else {
    $_useradmin_ = true;
    $_userlogin_ = 'Admin';
    $_username_ = 'R70';
}

if (MODULE == 'cms_index' || $_useradmin_) {
    $_acc_ = true;
}
if ($_useradmin_) {
    $_SESSION['SID']['_file_rw_perm_'] = 'allow';
} else {
    setcoo('_file_rw_perm_', 'deny');
};
if (!$_useradmin_) {
    while ($row = mysql_fetch_object($db)) {
        $_userperm_[$row->name]['read'] = $row->read;
        $_userperm_[$row->name]['write'] = $row->write;
        if ($row->name == MODULE) {
            if ($_userperm_[$row->name]['read'] == '1') {
                $_acc_ = true;
            };
        };
        if ($row->name == 'files') {
            if (($_userperm_[$row->name]['read'] == '1' && $_userperm_[$row->name]['write'] == '1') || $_useradmin_) {
                $_SESSION['SID']['_file_rw_perm_'] = 'allow';
            };
        };
    };
}
if (!defined('MODULE') || !$_acc_) {
    echo 'Модуль не существует/Нет прав доступа к модулю<br><br><a href="javascript:history.back(-1);">Назад</a>';
    exit;
};
if ($_useradmin_ || $_userperm_[MODULE]['write'] == '1') {
    //
} else {
    if (vars('d') != '') {
        setvar('d', '');
    };
    if (vars('s') != '') {
        setvar('s', '');
    };
};