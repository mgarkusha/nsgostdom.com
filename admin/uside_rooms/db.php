<?
if(vars('catalog_rooms_id')){
    $rooms_item = mysql::selectrow("SELECT * FROM `#catalog_rooms` WHERE `id` = '".(int)vars('catalog_rooms_id')."'");
    $catalog_rooms = mysql::select("SELECT * FROM `#catalog_rooms` WHERE `display` = '1' ORDER BY `pos` DESC LIMIT 3 ");
}else{
    $ff='page';
    $$ff=new pages();
    $$ff->name=$ff;
    $$ff->sql="SELECT COUNT(*) FROM `".conf::$dbprefix."news` WHERE `display`='1' ORDER BY `posted` DESC";
    $$ff->page_size=20;
    $$ff->pages=20;
    $$ff->url='';
    $$ff->tpl=conf::$bpath.'kernel/classes/pages.class.tpl';
    $$ff->work();
    
    $rooms = mysql::select("SELECT * FROM `#catalog_rooms` WHERE `display` = '1' ORDER BY `pos` DESC ".$page->limit());

    
}