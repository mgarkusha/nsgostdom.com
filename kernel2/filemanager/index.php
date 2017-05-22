<?
	session_start();
	if ($_SESSION['SID']['_file_rw_perm_']!='allow') {header("HTTP/1.0 403 Forbidden");exit;} 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>FileManager</title>
        <meta http-equiv="Content-type" CONTENT="text/html; charset=utf-8"/>
</head>
<FRAMESET rows="60,*,80">
  <FRAME id="path" name="path" noresize scrolling=no src="path.php">
  <FRAMESET cols="30%, 70%">
    <FRAME id="tree" name="tree" src="tree.php">
    <FRAME id="cont" name="cont" src="cont.php">
  </FRAMESET>
  <FRAME id="fmenu" name="fmenu" noresize scrolling=no src="fmenu.php">
</FRAMESET>
</html> 
