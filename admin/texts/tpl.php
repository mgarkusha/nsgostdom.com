<?php if (!defined('SCRIPTACCESS')) exit; 

$r=mysql::selectrow("SELECT * FROM #texts WHERE id=".$textsparam);
echo $r['text'];