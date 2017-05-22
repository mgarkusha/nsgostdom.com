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
	<TITLE>Дерево каталогов</TITLE>
	<link href="css/fmstyle.css" rel="stylesheet" type="text/css" />
        <meta http-equiv="Content-type" CONTENT="text/html; charset=utf-8"/>
	<script language="javascript" type="text/javascript">

		/* MYAJ */
		function callMYAJ(url, rdata, pageElement, callMessage, errorMessage)
		{
		  document.getElementById(pageElement).innerHTML = callMessage;
		  try
		  {
			req = new XMLHttpRequest(); /* e.g. Firefox */
		  }
		  catch(e)
		  {
			try
			{
				req = new ActiveXObject("Msxml2.XMLHTTP");  /* some versions IE */
			}
			catch(e)
			{
				try
				{
					req = new ActiveXObject("Microsoft.XMLHTTP");  /* some versions IE */
				}
				catch (E) { req = false; }
		  	}
	  	  }
		  req.onreadystatechange = function() { responseMYAJ(pageElement, errorMessage); };
/*		  if (rdata instanceof Object)
		  {
			req.open("POST",url,true);
			req.setRequestHeader("Content-Type","application/x-www-form-urlencoded");
			req.send(urlencMYAJ(rdata));
		  }
		  else
		  {
*/			req.open("GET",url,true);
			req.send(null);
//		  }
		}

		function responseMYAJ(pageElement, errorMessage)
		{
		  var output = '';
		  if(req.readyState == 4)
		  {
			if(req.status == 200)
			{
				output = req.responseText;
				document.getElementById(pageElement).innerHTML = output;
			}
			else
			{
				document.getElementById(pageElement).innerHTML = errorMessage;
			}
		  }
		}


		function urlencMYAJ(edata)
		{
		  var query = [];
		  if (edata instanceof Object)
		  {
			for (var k in edata)
			{
				query.push(encodeURIComponent(k) + "=" + encodeURIComponent(edata[k]));
			}
			return query.join('&');
		  }
		  else
		  {
			return encodeURIComponent(edata);
		  }
		}
	
		function chdir(path)
		{
		  parent.path.location.href="path.php?path="+path;
		  parent.cont.location.href="cont.php?path="+path;
		}

		function openDir(path)
		{
		  if (document.getElementById('img'+path).getAttribute('open')=='false')
		  {
		    document.getElementById('img'+path).setAttribute('src', 'images/folder-.gif');
		    document.getElementById('img'+path).setAttribute('open', 'true');
		    
		    if (document.getElementById(path).innerHTML=="")
		    	callMYAJ("loadtree.php?p="+path, null, path, "", "Error!");
		    else
		    	document.getElementById(path).style.visibility = 'visible'; document.getElementById(path).style.display = 'block';
//		    document.getElementById(path).innerHTML="<table><tr><td>bla</td></tr></table>";
		  //  alert(document.getElementById(path).innerHTML);
		  }
		  else
		  {
		    document.getElementById('img'+path).setAttribute('src', 'images/folder+.gif');
		    document.getElementById('img'+path).setAttribute('open', 'false');
//		    document.getElementById(path).innerHTML="";
		    document.getElementById(path).style.visibility = 'hidden'; document.getElementById(path).style.display = 'none';
		  }
		  
		  return false;
		}
	</script>

</HEAD>
<body>
<?php
  include("conf.php");
  include("loadtree.php");
?>

</BODY>
</HTML>