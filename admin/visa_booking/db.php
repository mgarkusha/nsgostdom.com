<?php
$first_block = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 1");
$product_1 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 17");
$product_2 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 16");
$product_3 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 18");
$product_4 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 15");