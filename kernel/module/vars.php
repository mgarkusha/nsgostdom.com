<?php if (!defined('SCRIPTACCESS')) exit;
	function	varscheck($res)
	{
		$arr=array("SELECT","DELETE","UNION","JOIN","INSERT","TRUNCATE","UPDATE","ALTER");
		if ($res)
		{
			$tmp=strtoupper($res);
			foreach ($arr as $word)
			{
				$word=strtoupper($word);
				if (strpos($tmp,$word)!==false)	return false;
			}
			return $res;
		}
		else return $res;
	}/*PATCHED*/
	function vars($name)
	{
		global $_GET,$_POST;
		if(!empty($_POST[$name])) $res=trim($_POST[$name]);
		elseif(!empty($_GET[$name])) $res=trim($_GET[$name]);
		else $res=false;
		return varscheck($res);
	}
	function varsa($name)
	{
		global $_GET,$_POST;
		if(!empty($_POST[$name])) $res=$_POST[$name];
		elseif(!empty($_GET[$name])) $res=$_GET[$name];
		else $res=false;
		return varscheck($res);
	}
	function varsi($name,$i)
	{
		global $_GET,$_POST;
		if(!empty($_POST[$name][$i])) $res=trim($_POST[$name][$i]);
		elseif(!empty($_GET[$name][$i])) $res=trim($_GET[$name][$i]);
		else $res=false;
		return varscheck($res);
	}
	function setvar($name,$value){
		global $_GET,$_POST;
		$_GET[$name]=$value;
		$_POST[$name]=$value;
	};
	function issetvar($name){
		global $_GET,$_POST;
		if(isset($_POST[$name])) return true;
		if(isset($_GET[$name])) return true;
		return false;
	};
	function getone(){
		global $_GET;
		reset($_GET);
		if(isset($_GET[key($_GET)])){
			return key($_GET);
		}else return false;
	};
?>