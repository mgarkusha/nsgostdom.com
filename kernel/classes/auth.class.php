<?php if (!defined('SCRIPTACCESS')) exit;
	class auth {
		
		public $user;
		public $table;
		public $password = 'password';
		public $login_redirect;
		public $logout_redirect;
		public $sql='';
		public $name='auth';

		public function __construct($name){
			$this->name=$name;
		}
		
		function logged(){
			if(!isset($_SESSION[$this->name])) $this->logged=false;
			else{
				$sql="SELECT COUNT(*) FROM ".$this->table." WHERE id='".addslashes($_SESSION[$this->name])."' ".$this->sql;
				$db=mysql_fetch_array(mysql_query($sql));
				if($db[0]==0) $this->logged=false; else $this->logged=$_SESSION[$this->name];
			};
			return $this->logged;
		}

		public function authorize(){
			if(vars($this->name.'_login')!=''){
				//vars::setmixed($this->name.'_password',(vars::mixed($this->name.'_password','string')));
				$sql="SELECT COUNT(*) FROM ".$this->table." WHERE ".$this->user."='".addslashes(trim(vars($this->name.'_login')))."' AND ".$this->password."='".addslashes(trim(vars($this->name.'_password')))."' ".$this->sql;
				$db=mysql_fetch_array(mysql_query($sql));
				if($db[0]==0) $this->message=true;
				else{
					$sql="SELECT * FROM ".$this->table." WHERE ".$this->user."='".addslashes(trim(vars($this->name.'_login')))."' AND ".$this->password."='".addslashes(trim(vars($this->name.'_password')))."' ".$this->sql;
					$db=mysql_fetch_array(mysql_query($sql));
					$_SESSION[$this->name]=$db['id'];
					if(vars($this->name.'_remember')){
						cookie::set('main['.$this->name.'l]',($db[$this->user]),time()+3600*24*100);
						cookie::set('main['.$this->name.'p]',($db[$this->password]),time()+3600*24*100);
						cookie::set('main['.$this->name.'r]','1',time()+3600*24*100);
					}else{
						cookie::set('main['.$this->name.'l]','',time()+1);
						cookie::set('main['.$this->name.'p]','',time()+1);
						cookie::set('main['.$this->name.'r]','',time()+1);
					};
					if($this->login_redirect){
						header("Location: ".$this->login_redirect); 
						exit;
					};
				};
			}elseif(vars($this->name.'_logout')=='1'){
				$_SESSION[$this->name]='';
				cookie::set('main['.$this->name.'l]','',time()+1);
				cookie::set('main['.$this->name.'p]','',time()+1);
				cookie::set('main['.$this->name.'r]','',time()+1);
				if($this->logout_redirect){
					header("Location: ".$this->logout_redirect); 
					exit;
				};
			}else{
				if(!$this->logged()){
					if(cookie::get('main',$this->name.'r')=='1'){
						vars::setmixed($this->name.'_login',cookie::get('main',$this->name.'l'));
						vars::setmixed($this->name.'_password',cookie::get('main',$this->name.'p'));
						vars::setmixed($this->name.'_remember',cookie::get('main',$this->name.'r'));
						vars::setmixed($this->name.'_fromrem','1');
					};
				};
			};

		}
		
		public function login_value(){
			return vars::mixed($this->name.'_login','html');
		}
		public function pwd_value(){
			return vars::mixed($this->name.'_password','html');
		}
		public function remember_value(){
			return ' value="1" ';
			if(vars::mixed($this->name.'_remember','int')==1)
			return ' checked ';
		}

	};
?>