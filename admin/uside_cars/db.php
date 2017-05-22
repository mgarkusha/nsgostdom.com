<?
if(vars('cars_id')){
    $cars_item = mysql::selectrow("SELECT * FROM `#cars` WHERE `id` = '".(int)vars('cars_id')."'");
}else{
    $ff='page';
    $$ff=new pages();
    $$ff->name=$ff;
    $$ff->sql="SELECT COUNT(*) FROM `".conf::$dbprefix."cars` WHERE `display`='1' ORDER BY `posted` DESC";
    $$ff->page_size=20;
    $$ff->pages=20;
    $$ff->url='';
    $$ff->tpl=conf::$bpath.'kernel/classes/pages.class.tpl';
    $$ff->work();
    
    $cars = mysql::select("SELECT * FROM `#cars` WHERE `display` = '1' ");

    
}