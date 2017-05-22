<?php

if (!defined('SCRIPTACCESS')) {
    define('SCRIPTACCESS', true);
}

$page = false;
$path = false;

# Получаем запрошенный путь в $page



$t = parse_url($_SERVER['REQUEST_URI']);
$t = $t['path'];
if ($t != '/') {
    if ($t[strlen($t) - 1] == '/') {
        $t = substr($t, 0, -1);
    };
};
$page = substr($t, 1);

include 'kernel/main/conf.php';
$page = urldecode(conf::$url[0]);
//die($page);

# Загрузить карту сайта в массив $hash из файла sitemap.hash
# Если файла нет, то создать его.
if (!file_exists(conf::$bpath . 'kernel/temp/sitemap.hash')) {

    # Заполнить hash из таблицы карты сайта
    $db = mysql_query("SELECT `id`, `alias` FROM `" . conf::$dbprefix . "sitemap`");
    while ($row = mysql_fetch_assoc($db)) {
        $hash["/" . $row['id']] = $row['id'];
        if ($row['alias'] != '') {
            $hash["/" . $row['alias']] = $row['id'];
            $hash['sm_'.$row['id']] = $row['alias'];
        } else {
            $hash['sm_'.$row['id']] = $row['id'];
        }
    }

    # Сопоставить страницу, соотвесттвующую пути по умолчанию "/"
    $db = mysql_query("SELECT `id` FROM `" . conf::$dbprefix . "sitemap` WHERE `first` = '1'");
    if (mysql_num_rows($db) == 1) {
        $row = mysql_fetch_array($db);
        if ($row['id']) {
            $hash['/'] = $row['id'];
        }
    } else {
        $db2 = mysql_query("SELECT `id` FROM `" . conf::$dbprefix . "sitemap` WHERE `display` = '1' AND `parent` = 0 ORDER BY `pos` LIMIT 0,1");
        if (mysql_num_rows($db2) == 1) {
            $row = mysql_fetch_array($db2);
            $hash['/'] = $row['id'];
        };
    }
    file_put_contents(conf::$bpath . 'kernel/temp/sitemap.hash', serialize($hash));
    chmod(conf::$bpath . 'kernel/temp/sitemap.hash', 0660);
} else {
    $hash = unserialize(file_get_contents(conf::$bpath . 'kernel/temp/sitemap.hash'));
}
if (isset($hash["/" . $page])) {
    $path = $hash["/" . $page];
    conf::$urlpath = $page;
    $db = mysql_query("SELECT * FROM `" . conf::$dbprefix . "sitemap` WHERE `id` = " . (int)$path);
    $row = mysql_fetch_array($db);
}

if($page != $row['alias'] && $row['alias']){
	header('location: /'.$row['alias']);
	exit;
}

// SEO START
$opt = mysql_query("SELECT * FROM `" . conf::$dbprefix . "cms_opt` ");
$res_opt = array();
while ($ropt = mysql_fetch_array($opt)) {
    $res_opt[$ropt['key']] = $ropt['value'];
}

conf::$alt .= $res_opt['KEY_WORD'];

if (trim($res_opt['TITLE_START']) != '') {
    conf::$title = $res_opt['TITLE_START'] . ' :: ';
    conf::$before_title = $res_opt['TITLE_START'] . ' :: ';
}

conf::$title .= ($row['header'] != '' ? '' . $row['header'] : $row['name']);
if (trim($res_opt['TITLE_END']) != '') {
    conf::$title.=' :: ' . $res_opt['TITLE_END'];
    conf::$after_title = ' :: ' . $res_opt['TITLE_END'];
}

conf::$header = ($row['header'] != '' ? $row['header'] : $row['name']);


conf::$pname = $row['name'];
conf::$description = $res_opt['META_DESCRIPTION'];

conf::$key_words = $res_opt['META_KEYWORDS'];

conf::$page_name = $row['name'];
if($row['header']){
    conf::$page_name = $row['header'];
}

get_breadcrumb_sitemap($path);
breadcrumb_reverse();

set_title($row['title']);
set_description($row['description']);
set_keywords($row['keywords']);

// SEO END

if (!$path) {
    define('CONTENT', 'kernel2/error/404.php');
    conf::$title = 'Страница не найдена!';
    header('HTTP/1.1 404 Not Found');
    include conf::$skin;
    exit;
} else {
    # Компиляция файла карты сайта, если это необходимо
    if (!file_exists(conf::$bpath . 'kernel/temp/sitemap-' . $row['id'] . '')) {
        function parseobj($matches) {
            global $inc;
            $modulename = $matches[1];
            $inc[$modulename] = "";
            return ("<? include conf::\$bpath.\"admin/{$modulename}/tpl.php\"?>");
        }
        $inc = array();
        $s = preg_replace_callback('/<img class="cmsmodule" title="module:(.+?);" (.+?) \/>/is', 'parseobj', $row['text']);
        $f = fopen(conf::$bpath . 'kernel/temp/sitemap-' . (int)$row['id'] . '', 'w');
        fwrite($f, $s);
        fclose($f);
        chmod(conf::$bpath . 'kernel/temp/sitemap-' . (int)$row['id'], 0660);
        mysql_query("UPDATE `" . conf::$dbprefix . "sitemap` SET `included_modules` = '" . addslashes(serialize($inc)) . "' WHERE `id` = " . (int)$row['id']);
    }
    define('CONTENT', 'kernel/temp/sitemap-' . $row['id']);
    if ($row['included_modules'] != '') {
        $inc = unserialize($row['included_modules']);
    }
    if (is_array($inc)) {
        foreach ($inc as $name => $par) {
            if (trim($name) != '') {
                ${$name . 'param'} = $par;
                include 'admin/' . $name . '/db.php';
            }
        };
    };
}

conf::$pathid = $path;
conf::$first = false;
if($row['first']){
   conf::$first = true;
}
$slider = get_display_slide();
$menu = get_sitemap_parents();


include conf::$skin;
