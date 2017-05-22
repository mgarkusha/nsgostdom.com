<?

	$s=explode('/',$_SERVER['REQUEST_URI']); 
	$s1='';
	for($i=0;$i<count($s)-2;$i++) $s1.='../';
	
	class conf {
		// db variables
		public static $dbprefix;
		public static $dbserver;
		public static $dbname;
		public static $dbuser;
		public static $dbpassword;
		public static $dbconnect;
	}
	
	$filename = $s1."kernel/conf/dbconnect.php";
	require_once($filename);
	
	conf::$dbconnect=mysql_connect(conf::$dbserver,conf::$dbuser,conf::$dbpassword);
	if(!conf::$dbconnect){
		echo "Fatal error. No database server connection.";
		exit;
	}
	if(!mysql_select_db(conf::$dbname)){
		echo "Fatal error. No database.";
		exit;
	}
	
	mysql_query("SET NAMES 'cp1251'");
	mysql_query("SET CHARACTER_SET 'cp1251'");
	setlocale(LC_ALL, 'ru_RU.CP1251');		

?>
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
	<title>{$lang_module_title}</title>
	<meta http-equiv="Content-Type" content="text/html; charset=windows-1251" />
	<script language="javascript" type="text/javascript" src="../../tiny_mce_popup.js"></script>
	<script language="javascript" type="text/javascript" src="jscripts/func.js"></script>
	<script language="javascript" type="text/javascript" src="../../utils/mctabs.js"></script>
	<link href="css/advhr.css" rel="stylesheet" type="text/css" />
	<base target="_self" />
</head>
<body onload="tinyMCEPopup.executeOnLoad('init();');">
<form onsubmit="insertModule();return false;" action="#">
	<div class="tabs">
		<ul>
			<li id="general_tab" class="current"><span><a href="javascript:mcTabs.displayTab('general_tab','general_panel');" onmousedown="return false;">{$lang_module_title}</a></span></li>
		</ul>
	</div>

	<div class="panel_wrapper">
		<div id="general_panel" class="panel current">
			<table border="0" cellpadding="4" cellspacing="0">
                <tr>
                    <td><label for="modulename">Модуль</label></td>
                    <td nowrap="nowrap">
						<select id="modulename" name="modulename">
							<?
								$sql='SELECT * FROM `'.conf::$dbprefix.'cms_module` WHERE sitemapaccess=\'1\' ORDER BY `pos`;';
								$db=mysql_query($sql);
								
								while($row=mysql_fetch_assoc($db)){
									echo '<option value="'.$row ['path'].'">'.$row ['name'].'</option>';
								}	
							?> 
						</select>
                    </td>
                </tr>
                <tr>
                    <td><label for="parametr">Передаваемый параметр</label></td>
                    <td nowrap="nowrap">
                        <input id="parametr" name="parametr" type="text" value="" />
                    </td>
                </tr>                
                <input id="width" name="width" type="hidden" value="" />
                <input id="height" name="height" type="hidden" value="" />
            </table>
		</div>
	</div>

	<div class="mceActionPanel">
		<div style="float: left">
			<input type="button" id="insert" name="insert" value="{$lang_insert}" onclick="insertModule();" />
		</div>

		<div style="float: right">
			<input type="button" id="cancel" name="cancel" value="{$lang_cancel}" onclick="tinyMCEPopup.close();" />
		</div>
	</div>
</form>
</body>
</html>
