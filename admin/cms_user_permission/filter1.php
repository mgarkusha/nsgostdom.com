<?php if (!defined('SCRIPTACCESS')) exit;

class filter1_ {
        //required
        var $name;
        var $cookie;
        var $size;
        //
        function display(){
                //$rs=mysql_fetch_array(mysql_query("SELECT * FROM ".TBL."menu WHERE id='".vars($this->name)."'"));
                echo " &nbsp;Пользователь:&nbsp; ";
                echo "<select class=f_select name=".$this->name." onchange='document.one.submit();'>";
                $db=mysql_query("SELECT * FROM ".TBL."cms_user ORDER BY pos");
                while($row=mysql_fetch_array($db)){
                        if(vars($this->name)==$row['id']) $sel='selected'; else $sel='';
                        echo "<option value=".$row['id']." $sel>"._cut($row['name'])."</option>";
                };
                echo "</select>";
        }
        //
        function work(){
                if(vars($this->name)!='') setcooa($this->cookie,$this->name,vars($this->name));
                else if(cooa($this->cookie,$this->name)!='') setvar($this->name,cooa($this->cookie,$this->name));
                if(vars($this->name)==''){
                        $rs=mysql_fetch_array(mysql_query($sql="SELECT * FROM ".TBL."cms_user ORDER BY pos LIMIT 0,1"));
                        setvar($this->name,$rs['id']);
                }
                /*$rs=mysql_fetch_array(mysql_query($sql="SELECT COUNT(*) FROM ".TBL."catalog WHERE type=".vars('menuf1')." AND id='".vars($this->name)."'"));
                if($rs[0]==0){
                        $rs=mysql_fetch_array(mysql_query($sql="SELECT * FROM ".TBL."catalog WHERE type=".vars('menuf1')." ORDER BY pos LIMIT 0,1"));
                        setvar($this->name,$rs['id']);
                }*/
        }
        function get_sql(){
                return " AND userid='".vars($this->name)."' ";
        }
};
