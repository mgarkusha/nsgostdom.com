<?
	
	session_start();
	if ($_SESSION['SID']['_file_rw_perm_']!='allow') {header("HTTP/1.0 403 Forbidden");exit;} 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");

	include("functions.php");
 	include("conf.php");
	if (isset($_GET['f']))
	{
		
		//$file=str_replace('%2F%2F','/',urlencode($HTTP_GET_VARS['f']));
		//$file=str_replace('%2F','/',$file);
		$file=urldecode($_GET['f']);
		$file=str_replace($root,'',$file);
		$file=str_replace('../','',$file);
		$file=$root.$file;
		echo $file.'<br>';
		
		if (file_exists($file))
		{
			header("Content-Type: application/octet-stream\r");
			header("Content-Type: application/force-download\r");
			header("Content-Type: application/download\r");//ento dlya explorera
			header("Content-Transfer-Encoding: binary\r");
			$ex=explode('/',$file);
			$filename=$ex[count($ex)-1];
			header ("Content-Disposition: attachment; filename = ".$filename."");
			
			$fp=fopen($file,"r");
			fpassthru($fp);
			fclose($fp);
		}
		else echo 'Ошибка! файл не найден!';
		exit;
	}
?>
<html>
<HEAD>
	<TITLE>Содержимое каталога</TITLE>
	<link href="css/fmstyle.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-type" CONTENT="text/html; charset=utf-8"/>
	<script language="javascript">
		function insertURL(url)
		{
		  parent.opener.imagefield.value=url;
		  if (!(typeof(parent.opener.imagefield.onchange)=="undefined" || parent.opener.imagefield.onchange==null))
		    parent.opener.imagefield.onchange();
		  parent.close();
		}
		
		function renaming(id, oldfile, file, path, frename, isdir)
		{
		   if (frename)
		   {
		      parent.fmenu.location.href='fmenu.php?op=rename&path='+path+'&oldfile='+oldfile+'&newfile='+file+'&convert='+parent.fmenu.document.getElementById("conv").checked;
		   }
		   if (isdir) document.getElementById(id).innerHTML="<a href='javascript: chdir(\""+path+"/"+file+"\");' onmousedown='return false;'>"+file+"</a> <a href='#' onmousedown='beginrenaming(\"dir"+file+"\", \""+file+"\", \""+path+"\", true); return false;'><img src=\'images/rename.gif\' width=16 border=0></a>";
		   else       document.getElementById(id).innerHTML="<a href='javascript: insertURL(\""+path+"/"+file+"\");' id='"+file+"' onmousedown='return false;'>"+file+"</a> <a href='#' onmousedown='beginrenaming(\"file"+file+"\", \""+file+"\", \""+path+"\", false); return false;'><img src=\'images/rename.gif\' width=16 border=0></a>";
		   if (frename) 
		   {
		     if (isdir) document.getElementById(id).id="dir"+file;
		     else       document.getElementById(id).id="file"+file;
		   }
		}
		
		function beginrenaming(id, file, path, isdir)
		{
		   document.getElementById(id).innerHTML='<input type="text" size=20 id=\'edit'+file+'\' value='+file+' onkeypress=\"var c=event.keyCode; if (c==13 && this.value!=\''+file+'\') renaming(\''+id+'\', \''+file+'\', this.value, \''+path+'\', true, '+isdir+'); else if ((c==13 && this.value==\''+file+'\') || c==27) renaming(\''+id+'\', \''+file+'\', this.value, \''+path+'\', false, '+isdir+');\" style="border: solid 1px #000000;">';
		   document.getElementById('edit'+file).focus();
		}
		
		function toggleall()
		{
		   checked=document.getElementsByTagName('thead').item(0).getElementsByTagName("td").item(0).getElementsByTagName('input').item(0).checked;
		   tbody=document.getElementsByTagName('tbody').item(0);
		   if (!checked)
		    for (var i=0; (node=tbody.getElementsByTagName("tr").item(i)); i++)
		    {
		     if (node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0)!=null)
  		       node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0).checked=false;
		    }
		   else
		    for (var i=0; (node=tbody.getElementsByTagName("tr").item(i)); i++)
		    {
		     if (node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0)!=null)
		       node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0).checked=true;
		    }
		   return true;  
		}
		
		function chdir(path)
		{
//		  parent.tree.document.getElementById("img"+path).onclick();
		  parent.path.location.href="path.php?path="+path;
		  location.href="cont.php?path="+path;
		}
	</script>
</HEAD>
<body>
<?php
  if (!ini_get("register_globals")) {
    import_request_variables('GPC');
  }

  $directory=$root;
  if(!empty($path)) $directory.=$path;
//echo $directory;
  if ($dir = opendir($directory))
  {
    echo "<form action='#' method='POST'>\n";
    echo "<table border='0' cellpadding='0' cellspacing='0' width='100%'>\n";
    echo "<thead>\n";
        echo "<tr class='filelistHeadRow'>\n";
        echo "  <td class='filelistHeadCol' title='Toggle all' width='1' valign='middle'><input type='checkbox' onclick='toggleall();' style=\"background-color: #D4D0C8;\"></td>\n";
        echo "  <td class='filelistHeadCol' width='16'>&nbsp;</td>\n";
        echo "  <td class='filelistHeadCol'>Filename</td>\n";
        echo "  <td class='filelistHeadCol' width='15%'>Size</td>\n";
        echo "  <td class='filelistHeadCol' width='20%'>ModTime</td>\n";
        echo "</tr>\n";
    echo "</thead>\n";
    echo "<tbody>\n";
    
    $files=array();
    $dirs=array();
    $ftime=array();
    while (($file = @readdir($dir)) !== false)
    {
      $tmp = $directory.DIRECTORY_SEPARATOR.$file;
    
      if (is_file($tmp)){
      	$files[]=$file;
      	$ftime[]=filemtime($tmp);
      }elseif (is_dir($tmp) && $file!="." && ($file!=".." || $file==".." && !empty($path) && $path!="/")){
        $dirs[]=$file;
      }
    }
    closedir($dir);
    if (count($ftime)>0) array_multisort($ftime, SORT_ASC, $files);
    
    foreach($dirs as $file)
    {
        $tmp = $directory.DIRECTORY_SEPARATOR.$file;
        echo "<tr>\n";
        if ($file=="..")
          echo "<td width='0' valign='middle' style='text-align: center;' value='$file' nowrap>&nbsp</td>\n";
        else  
          echo "<td width='0' valign='middle' style='text-align: center;' value='$file' nowrap><input type='checkbox'></td>\n";
        echo "<td width='16' style='text-align: center;'><img src='images/folder.gif' nowrap></td>\n";
        if ($file=="..")
        {
         if (dirname($path)=="\\")
          echo "<td nowrap><a href='javascript: chdir(\"/\");' onmousedown='return false;'>$file</a></td>\n";
         else
          echo "<td nowrap><a href='javascript: chdir(\"".dirname($path)."\");' onmousedown='return false;'>$file</a></td>\n";
        }
        else {
             echo "<td id='dir$file' nowrap><a href='javascript: chdir(\"/".$file."\");' onmousedown='return false;'>$file</a> <a href='#' onmousedown='beginrenaming(\"dir$file\", \"$file\", \"\", true); return false;'><img src='images/rename.gif' width=16 border=0></a></td>\n";
        }
        echo "<td width='15%'>dir</td>\n";
        echo "<td width='20%' nowrap>".date("Y-m-d H:i", filemtime($tmp))."</td>\n";
        echo "</tr>\n";
    
    }

    foreach($files as $file)
    {
        $tmp = $directory.DIRECTORY_SEPARATOR.$file;
    
        $file_array = explode('.', $file);
        $num = count($file_array);
        $fileres = $file_array[($num - 1)];
         
        echo "<tr>";
        echo "<td width='0' valign='middle' style='text-align: center;' nowrap><input type='checkbox'></td>";
        echo "<td width='16' style='text-align: center;' nowrap><img src='images/icons/";
        if (file_exists("images/icons/".$fileres.".gif"))
          echo "$fileres.gif";
        else
          echo "default.icon.gif";
        echo"'></td>";
        echo "<td id='file$file' nowrap><a href='javascript:insertURL(\"".$root.$path."/".$file."\");' id='$file' onmousedown='return false;'>$file</a> <a href='#' onmousedown='beginrenaming(\"file$file\", \"$file\", \"$path\", false); return false;'><img src='images/rename.gif' width=16 border=0></a>&nbsp<a href='?f=".urldecode($tmp)."'><img src='images/save.gif' width=16 border=0></a></td>";
        echo "<td width='15%' nowrap>".CoolSize(filesize($tmp))."</td>";
        echo "<td width='20%' nowrap>".date("Y-m-d H:i", filemtime($tmp))."</td>";
        echo "</tr>\n";
    }  

    echo "</tbody>\n";
    echo "</table>\n";
    echo "</form>\n";
  }
  else
  {
    echo "error!";
  }

?>
</BODY>
</HTML>