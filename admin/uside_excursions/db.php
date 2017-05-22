<?
if(vars('excursions_id')){
    $excurs_item = mysql::selectrow("SELECT * FROM `#excursions` WHERE `id` = '".(int)vars('excursions_id')."'");
}else{
    $ff='page';
    $$ff=new pages();
    $$ff->name=$ff;
    $$ff->sql="SELECT COUNT(*) FROM `".conf::$dbprefix."excursions` WHERE `display`='1' ORDER BY `posted` DESC";
    $$ff->page_size=20;
    $$ff->pages=20;
    $$ff->url='';
    $$ff->tpl=conf::$bpath.'kernel/classes/pages.class.tpl';
    $$ff->work();
    
    $excurs = mysql::select("SELECT * FROM `#excursions` WHERE `display` = '1' ");

    
}