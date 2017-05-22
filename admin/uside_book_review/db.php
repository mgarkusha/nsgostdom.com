<?
	define('MODULE','book_review');

	include conf::$bpath.'admin/'.MODULE."/db.php";

	$t->work();

        $ff='page';
	$$ff=new pages();
	$$ff->name=$ff;
	$$ff->sql="SELECT COUNT(*) FROM `".conf::$dbprefix."book` WHERE `display`='1' ORDER BY `posted` DESC";
	$$ff->page_size=10;
	$$ff->pages=3;
	$$ff->url='';
	$$ff->tpl=conf::$bpath.'kernel/classes/pages.class.tpl';
	$$ff->work();
        
        $records = mysql::select("SELECT * FROM `#book_review` WHERE `display` = '1' ORDER BY `posted` DESC ".$page->limit());

    

?>
