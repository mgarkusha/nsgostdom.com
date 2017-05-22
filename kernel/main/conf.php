<?php if (!defined('SCRIPTACCESS')) exit;
	// back path detect
	$s=explode('/',$_SERVER['REQUEST_URI']);
	$s1='';
	for($i=0;$i<count($s)-2;$i++) $s1.='../';
	// config class
	class conf {
		// main variables
		public static $bpath;
		public static $hpath;
		public static $aside;
		public static $uside;
		// db variables
		public static $dbprefix;
		public static $dbserver;
		public static $dbname;
		public static $dbuser;
		public static $dbpassword;
		public static $dbconnect;
		// skin
		public static $skin;
		//auth
		public static $udata;
		// sitemap
		public static $urlpath;
		public static $pathid;
		public static $fpath;
		// path
		public static $path;
		// highlight search
		public static $highlight1='<strong>';
		public static $highlight2='</strong>';
		// альты
		public static $alt;
		public static $title;
		public static $before_title;
		public static $after_title;
		public static $header;
		public static $pname;
		public static $key_words;
		public static $description;
		public static $url;
		public static $page_name;
		public static $first;
		public static $breadcrumb;
		////////////////////////
		// конфигурация в рамках этого проекта
		public static $utype=false;
		public static $status=array(1 => 'Новая заявка',2 => 'Забронирован',3 => 'Отменен',4 => 'Оплачено');
	}

	conf::$bpath='';
	conf::$hpath=$s1;
	conf::$aside=false;
	conf::$uside=true;
	conf::$skin='kernel/skin/skin.main.php';
	//
	include conf::$bpath.'kernel/conf/dbconnect.php';
	include conf::$bpath.'kernel/main/conf.common.php';
	//
	header('Content-Type: text/html; charset=UTF-8');
//killallcoo;
//exit;

        $path_ = parse_url($_SERVER['REQUEST_URI']);
        conf::$url = array_slice(explode('/', $path_['path']),1);
	//auth detect
	$auth=new auth('auth_tbf');
	$auth->table=conf::$dbprefix.'account';
	$auth->user='login';
	//$auth->login_redirect='/my/';
	$auth->logout_redirect='/';
	$auth->authorize();
	//print_r($auth->logged());
	if($auth->logged()){
		$r=mysql::selectrow("SELECT who FROM #account WHERE id='?'",$auth->logged());
		conf::$utype=$r['who'];
	}
	//
