<?
	#######################################################
	$t=new trecord();
	$t->table=&$t1;
	$t->edit=&$e1;
	$t->work=&$w1;
	$t->list=&$l1;
	#######################################################
	$t1=new ttable();
	$t1->name=conf::$dbprefix.MODULE;
	$t1->msg['n']='Ваш вопрос отправлен';
	$t1->before_store='before_store();';
	$t1->after_store='after_store();';
	#############################################################################
	include 'filter1.php';
	$fi1=new filter1_();
	$fi1->name=MODULE.'f1';
	$fi1->cookie=COO;
	$fi1->work();	
	#######################################################
	$p=new paging_();
	$p->name=$t1->name.'_pager';
	$p->sql="SELECT COUNT(*) FROM ".$t1->name." WHERE 1 ".$fi1->sql();
	$p->work();
	#######################################################
	$e1=new tedit();
	$e1->table=&$t1;
	include 'fields.php';
	#######################################################
	$l1=new tlist();
	$l1->table=&$t1;
	$l1->sql="SELECT * FROM ".$t1->name." WHERE 1 ".$fi1->sql()." ORDER BY `posted` DESC ".$p->limit();
	#######################################################
	$w1=new twork();
	$w1->table=&$t1;
	$w1->tree=&$t;
	#######################################################
	function after_store(){
		$mlb=cms::setup_value('mail_book');
		if(conf::$uside && $mlb!=''){
			$mailsend=explode(',',$mlb);
			foreach ($mailsend as $key=>$value) {
                            mail_($value,
                                    'Сообщение с сайта '.$_SERVER['HTTP_HOST'],	
                                    '<b>Имя:</b> '.vars('author')."<br><b>E-mail:</b> ".vars('mail')."<br><b>Текст:</b> ".nl2br(vars('message'))
                                    );
                        }           
		};
		
	}
	function before_store() {
	    global $pic;
	    $pic->write_file();
	}
