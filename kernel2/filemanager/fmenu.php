<?
	session_start();
	if ($_SESSION['SID']['_file_rw_perm_']!='allow') {header("HTTP/1.0 403 Forbidden");exit;} 
	header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT");
	header("Cache-Control: no-store, no-cache, must-revalidate");
	header("Cache-Control: post-check=0, pre-check=0", false);
	header("Pragma: no-cache");
?>
<html>
<HEAD>
	<TITLE>Содержимое каталога</TITLE>
	<link href="css/fmstyle.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-type" CONTENT="text/html; charset=utf-8"/>
	<script language="javascript">
	    function selected()
	    {
	        var string='';
		tbody=parent.cont.document.getElementsByTagName('tbody').item(0);
		for (var i=0; (node=tbody.getElementsByTagName("tr").item(i)); i++)
		{
		  if (node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0)!=null && node.getElementsByTagName("td").item(0).getElementsByTagName('input').item(0).checked)
		  {
		    string+=node.getElementsByTagName("td").item(2).getElementsByTagName("a").item(0).childNodes.item(0).nodeValue+';';
		  }
		}
		return string;
	    }
	    
	    function addmsg(msg)
	    {
	       parent.path.document.getElementById("log").innerHTML=msg+'\n';
  	    }
	</script>
</HEAD>
<body>
    <table width="100%">
    <tr><td width="32%">
	<form enctype='multipart/form-data' action='' name='upload' method='POST' onSubmit='if (this.lfile.value=="") return false; this.path.value=parent.path.document.getElementById("path").value; this.convert.value=document.getElementById("conv").checked;'>
	 <input type='hidden' name='path' value=''>
	 <input type='hidden' name='op' value='downloaded'>
	 <input name='lfile' size=28 style='border: 1px solid #000000' type='file'>
	 <input type='submit' value='Загрузить' style='border: 1px solid #000000'><br>
	 <input type='hidden' name='convert' value=''>
	</form>
     <input type='checkbox' id='conv' checked>Преобразовывать русские имена
    </td><td valign=top align=left><img src="images/border.gif" border=0>
    </td><td width="32%" align=center>
	<form enctype='multipart/form-data' action='' name='crdir' method='POST' onSubmit='if (this.dir.value=="") return false; this.path.value=parent.path.document.getElementById("path").value; if (document.getElementById("conv").checked) this.convert.value="true"; else this.convert.value="false";'>
	 <input type='hidden' name='path' value=''>
	 <input type='hidden' name='op' value='createdir'>
	 <input type='text' name='dir' size=20 style='border: 1px solid #000000' value=''>
	 <input type='submit' value='Создать каталог' style='border: 1px solid #000000'><br>
	 <input type='hidden' name='convert' value=''>
	</form>
    </td><td valign=top><img src="images/border.gif" border=0>
    </td><td width="32%" align=center>
	<form enctype='multipart/form-data' action='' name='delete' method='POST' onSubmit='if (!confirm("Вы действительно хотите удалить выбранные файлы?")) return false; this.path.value=parent.path.document.getElementById("path").value; if ((this.sel.value=selected())=="") return false;'>
	 <input type='hidden' name='path' value=''>
	 <input type='hidden' name='op' value='delete'>
	 <input type='hidden' name='sel' value=''>
	 <input type='submit' value='Удалить файлы' style='border: 1px solid #000000'><br>
	</form>
    </td>
    </tr></table>
	
      <?php
	include("functions.php");
	include("conf.php");

	if (!ini_get("register_globals")) {
	  import_request_variables('GPC');
	}
  
  	switch ($op)
	{
	  case 'downloaded':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    if ($admin && is_uploaded_file($_FILES['lfile']['tmp_name']))
	    {
		$root=realpath($root);
		$filename=$_FILES['lfile']['name'];
		if ($convert=='true') $filename=rus2lat($filename);
		$filesize=CoolSize($_FILES['lfile']['size']);
		if (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename))
		{
		  $file_array = explode('.', $filename);
        	  $num = count($file_array);
        	  $fileres = $file_array[($num - 1)];
        	  if ($num==1) 
        	  {
        	    $i=1;
          	    while (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename."(".$i.")")) {$i++;}
        	    $filename=$filename."($i)";
        	  }
        	  else
        	  {
        	   $filename="";
		   for ($i=0; $i<$num-1; $i++)  
		   { 
		     $filename.=$file_array[$i];
		     if ($i!=$num-2) $filename.=".";
		   }   
		   $i=1;
		   while (file_exists($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename."(".$i.").".$file_array[($num - 1)])) {$i++;}
		   $filename.="($i).".$file_array[($num - 1)];
		  }
		  echo "<script language='javascript'>addmsg('Файл с таким именем уже существует! Файл переименован');</script>";
		}
	        if (!@copy($_FILES['lfile']['tmp_name'], $root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$filename))
	            echo "<script language='javascript'>addmsg('Ошибка при копировании файла!');</script>";
	        else
	            echo "<script language='javascript'>addmsg('Файл ".$filename." успешно загружен(".$filesize.")'); parent.cont.location=parent.cont.location;</script>";
	    }
	  }
	  break;
	
	  case 'rename':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
	      $root=realpath($root);
	      $old=$root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$oldfile;
	      if ($convert=='true') $newfile=rus2lat($newfile);
	      $new=$root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$newfile;
	      if (!@rename($old, $new))
	            echo "<script language='javascript'>addmsg('Ошибка при переименовании файлов'); parent.cont.location=parent.cont.location;</script>";
	      else 
	            if (is_dir($new)) echo "<script language='javascript'>addmsg('Файлы успешно переименованы!'); parent.tree.location=parent.tree.location;</script>";
	            echo "<script language='javascript'>parent.cont.location=parent.cont.location;</script>";
	    }
	  }
	  
	  case 'delete':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
  		$flag=false;
   		$errfiles="";
  		if ($sel!="")
		{
    		  $mfiles=explode(";", $sel);
    		  $flag=true;
    		  $root=realpath($root);
		  foreach($mfiles as $file)
    		  {
       		     if ($file!="")
       		     {
       		       $tmp=realpath($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$file);
       		       if (is_dir($tmp))
       		       {
       		        if (!xrmdir($tmp))
       		        {
          		  $errfiles.=$file." ";
          		  $flag=false;
       		        }
       		       }
       		       else if (is_file($tmp))
       		        if (!@unlink($tmp))
       		        {
          		  $errfiles.=$file." ";
          		  $flag=false;
          		}
       		     }
    		  }
  		 if ($flag)
		 {
	            echo "<script language='javascript'>addmsg('Файлы успешно удалены!'); parent.cont.location=parent.cont.location; parent.tree.location=parent.tree.location;</script>";
  		 }
		 else
		 {
	            echo "<script language='javascript'>addmsg('Ошибка при удалении файлов: ".$errfiles."'); parent.cont.location=parent.cont.location;</script>";
  		 }
  		}
	    }
	  }
	  break;

	  case 'createdir':
	  {
	    if (!$admin) echo "<script language='javascript'>addmsg('У вас нет прав на данное действие!');</script>";
	    else
	    {
    	      $root=realpath($root);
  	      if ($convert=='true') $dir=rus2lat($dir);
  	      if (@mkdir($root.DIRECTORY_SEPARATOR.$path.DIRECTORY_SEPARATOR.$dir))
	        echo "<script language='javascript'>addmsg('Каталог ".$dir." создан!'); parent.cont.location=parent.cont.location; parent.tree.location=parent.tree.location;</script>";
  	      else 
	        echo "<script language='javascript'>addmsg('Ошибка при создании каталога!');</script>";
  	    } 
  	  }
	  break;
	}
	
	
	
       ?>
	
	
	<!--  if (!is_uploaded_file($HTTP_POST_FILES['lfile']['tmp_name']))
  {


	<a href="upload.php" target="_blank" onClick="popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value, 'createdir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;">Загрузить файл на сервер</a><br>
	<a href="createdir.php" target="_blank" onClick="popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value, 'createdir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;">Создать папку</a>
	<a href="delete.php" target="_blank" onClick="if (confirm('Удалить выбранные файлы?')) {popupWin = window.open(this.href+'?path='+parent.path.document.forms['form'].path.value+'&files='+selected(), 'deletedir', 'dialog=yes,modal=yes,width=250,height=100,status=no,toolbar=no,menubar=no'); popupWin.focus(); return false;}">Удалить</a><br>
-->	
</body>
</html>