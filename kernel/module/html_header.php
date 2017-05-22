<?php if (!defined('SCRIPTACCESS')) exit;

function _header(){
        _styles_load();
        _title();
        _meta_keywords();
        _meta_description();
        _meta_other();
};
function _styles_load(){
        ?><LINK rel="STYLESHEET" type="text/css" href="<? echo ROOT; ?>styles.css"><?
        ?><LINK rel="STYLESHEET" type="text/css" href="<? echo ROOT; ?>menu.css"><?
}
function _title(){

        echo "<title>".setup_value('TITLE_START').' '.HEADER.' '.setup_value('TITLE_END')."</title>";
}
function _meta_keywords(){
        echo '<META NAME="Keywords" content=\''.setup_value('META_KEYWORDS').' '.HEADER.'\'>';
}
function _meta_description(){
        echo '<META NAME="DESCRIPTION" CONTENT=\''.setup_value('META_DESCRIPTION').' '.HEADER.'\'>';
}
function _meta_other(){
        ?>
                <meta http-equiv="Content-Type" content="text/html; charset=windows-1251">
                <META NAME="robots" CONTENT="index,all">
                <META NAME="Author" CONTENT="R70">
        <?		
}
function chk_ip(){
        return in_array($_SERVER['REMOTE_ADDR'],array('212.192.102.197'));
}
