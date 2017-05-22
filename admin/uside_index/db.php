<?
if(vars('catalog_rooms_id')){
    $rooms_item = mysql::selectrow("SELECT * FROM `#catalog_rooms` WHERE `id` = '".(int)vars('catalog_rooms_id')."'");
    $catalog_rooms = mysql::select("SELECT * FROM `#catalog_rooms` WHERE `display` = '1' ORDER BY `pos` DESC LIMIT 3 ");
}else{
    $ff='page';
    $$ff=new pages();
    $$ff->name=$ff;
    $$ff->sql="SELECT COUNT(*) FROM `".conf::$dbprefix."news` WHERE `display`='1' ORDER BY `posted` DESC";
    $$ff->page_size=10;
    $$ff->pages=10;
    $$ff->url='';
    $$ff->tpl=conf::$bpath.'kernel/classes/pages.class.tpl';
    $$ff->work();


    $first_block = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 1");
    $product_1 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 17");
    $product_2 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 16");
    $product_3 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 18");
    $product_4 = mysql::selectrow("SELECT `name`,`text` FROM `#texts` WHERE `id` = 15");

    $rooms = mysql::select("SELECT * FROM `#catalog_rooms` WHERE `display` = '1' ORDER BY `pos` DESC ".$page->limit());
    $catalog_rooms = mysql::select("SELECT * FROM `#catalog_rooms` WHERE `display` = '1' ORDER BY `pos` DESC LIMIT 3 ");

}
