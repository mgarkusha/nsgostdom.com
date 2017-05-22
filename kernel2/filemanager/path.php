<?
	session_start();
	if ($_SESSION['SID']['_file_rw_perm_']!='allow') {header("HTTP/1.0 403 Forbidden");exit;} 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<HTML>
<HEAD>
	<TITLE>Путь</TITLE>
	<link href="css/fmstyle.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-type" CONTENT="text/html; charset=utf-8"/>
</HEAD>
<BODY>
<?php
  if (!ini_get("register_globals")) {
    import_request_variables('GPC');
  }
  
  echo "<table border=0 width=100%><tr><td width=60%><form name='form'>";
  echo "<input type='text' size=70 id='path' name='path' style='border: 1px solid #000000; width: 100%;' readonly value='";
  if (isset($path) && $path!=NULL)
    echo "$path";
  else
    echo "/";
  echo "'></form></td>\n<td align=right width40%>";
  echo "<textarea id='log' rows='2' cols='100' style='border: 1px solid #000000; width: 100%;' readonly></textarea>";
  echo "</td></tr></table>";
?>
</BODY>
</HTML>