<?php if (!defined('SCRIPTACCESS')) exit;

function coo($name){
        global $_COOKIE;
        if(!empty($_COOKIE[$name])) return trim(stripslashes($_COOKIE[$name]));
        return false;
};
function cooa($name,$name2){
        global $_COOKIE;
        if(!empty($_COOKIE[$name][$name2])) return trim(stripslashes($_COOKIE[$name][$name2]));
        return false;
};
function cooaa($name){
        global $_COOKIE;
        if(!empty($_COOKIE[$name])) return $_COOKIE[$name];
        return false;
};
function setcoo($name,$value,$time=0){
        global $_COOKIE;
        setcookie($name,$value,$time,'/',$_SERVER['HTTP_HOST']);
        $_COOKIE[$name]=$value;
};
function setcooa($name,$name2,$value,$time=0){
        global $_COOKIE;
        setcookie($name."[".$name2."]",$value,$time,'/',$_SERVER['HTTP_HOST']);
        $_COOKIE[$name][$name2]=$value;
};
function killallcoo(){
        global $_COOKIE;
        foreach ($_COOKIE as $k=>$v){
                if(is_array($_COOKIE[$k])){
                        foreach ($_COOKIE[$k] as $k1=>$v1){
                                $_COOKIE[$k][$k1]='';
                                setcooa($k,$k1,'');
                        };
                }else{
                        $_COOKIE[$k]='';
                        setcoo($k,'');
                };
        };
};
