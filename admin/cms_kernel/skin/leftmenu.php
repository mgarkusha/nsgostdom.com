<?php

$db = mysql_query($sql = "SELECT * FROM " . conf::$dbprefix . "cms_module WHERE display='1' ORDER BY pos");
while ($row = mysql_fetch_array($db)) {
    if ($row['path'] != '') {
        if ($_useradmin_ || (isset($_userperm_) && $_userperm_[$row['path']]['read'] == '1')) {
            if (MODULE == $row['path']) {
                $lnk = "linka";
            } else {
                $lnk = "link";
            }
            echo "<a href='" . conf::$hpath . 'admin/' . $row['path'] . "/' class=" . $lnk . ">" . $row['name'] . "</a><br>";
        }
    } else {
        if ($row['name'] == 'разделитель1')
            html::ispace(1, 8) . "<hr width=100%>" . html::ispace(1, 4) . "<br>";
        else
            echo html::ispace(5, 10) . "<br>";
    }
};