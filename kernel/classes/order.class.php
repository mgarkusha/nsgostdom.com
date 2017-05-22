<?php if (!defined('SCRIPTACCESS')) exit;

/*
 *  Класс для сортировки по полям в таблице БД
 * 
 */


class order {
    public $name;
    public $session;
    public $fields=array();
    /*
     *  Если в варсах $this->name.'_order_by' есть элемент сортировки по полю, проверяем была ли сортировка по этому полю ранее 
     */
    public function work() {
//        print_r($this->fields[vars($this->name.'_by')]);
        if(isset($this->fields[vars($this->name.'_by')])){
            if($_SESSION[$this->session][$this->name.'_order']==$this->fields[vars($this->name.'_by')]) {
                
                switch ($_SESSION[$this->session][$this->name.'_by']):
                    case 'ASC':
                        $_SESSION[$this->session][$this->name.'_by'] = 'DESC';
                        break;
                    case 'DESC':
                        $_SESSION[$this->session][$this->name.'_by'] = 'ASC';
                        break;
                endswitch;
                
                if($_SESSION[$this->session][$this->name.'_by']=='') $_SESSION[$this->session][$this->name.'_by'] = 'ASC';
                    
            }  else {
                $_SESSION[$this->session][$this->name.'_by'] = 'ASC';
                $_SESSION[$this->session][$this->name.'_order'] = $this->fields[vars($this->name.'_by')];
            }
        } else {
            if(issetvar($this->name.'_by')) {
                unset($_SESSION[$this->session][$this->name.'_by']);
                unset($_SESSION[$this->session][$this->name.'_order']);
            }
        }
    }
    
    public function sql() {
        if(isset($_SESSION[$this->session][$this->name.'_by']) && isset($_SESSION[$this->session][$this->name.'_order']))
        return ' ORDER BY `'.$_SESSION[$this->session][$this->name.'_order'].'` '.$_SESSION[$this->session][$this->name.'_by'];
        return ' ORDER BY `posted` DESC';
    }
}
