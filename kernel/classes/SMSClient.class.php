<?php if (!defined('SCRIPTACCESS')) exit;
	class SMSClient {
		
		private $login,$password;
		
		private $error=Array();
		
		public  $UseTransaction = false;
		
		function __construct($login,$password){
			$this->login	= $login;
			$this->password = $password;
		}
		
		// public area
		
		public function ActivateTransaction($id){
			
			$this->error=Array();
			
			$data = 
			'<?xml version="1.0" encoding="utf-8"?>'."\n".
			'<ActivateTransaction>'."\n".
			'	<User><![CDATA['.$this->login.']]></User>'."\n".
			'	<Password><![CDATA['.$this->password.']]></Password>'."\n".
			'	<Transaction><![CDATA['.$id.']]></Transaction>'."\n".
			'</ActivateTransaction>';
			
			$result=$this->SendToServer(iconv('windows-1251','utf-8',$data));
			
			return $result;
		}
		
		
		public function GetGateStatus(){
			
			$this->error=Array();
			
			$data = 
			'<?xml version="1.0" encoding="utf-8"?>'."\n".
			'<GetGateStatus>'."\n".
			'	<User><![CDATA['.$this->login.']]></User>'."\n".
			'	<Password><![CDATA['.$this->password.']]></Password>'."\n".
			'</GetGateStatus>';
			
			$result=$this->SendToServer(iconv('windows-1251','utf-8',$data));
			
			return $result;
		}
		
		public function SendPacketSMS($messages){
			$this->error=Array();
			$data = 
			'<?xml version="1.0" encoding="utf-8"?>'."\n".
			'<SendPacketSMS>'."\n".
			'	<User><![CDATA['.$this->login.']]></User>'."\n".
			'	<Password><![CDATA['.$this->password.']]></Password>'."\n".
			
			'	<UseTransaction>'.$this->UseTransaction.'</UseTransaction>'."\n".
			
			'	<Messages>'."\n";
			foreach($messages as $msg){
				$data.=
				'		<Msg>'."\n".
				'			<LocalID>'.$msg['localid'].'</LocalID>'."\n".
				'			<Sender><![CDATA['.$msg['sender'].']]></Sender>'."\n".
				'			<SMSText><![CDATA['.$msg['text'].']]></SMSText>'."\n".
				'			<Receiver>'.$msg['receiver'].'</Receiver>'."\n".
				'			<Priority>'.(int)$msg['priority'].'</Priority>'."\n".
				'			<NLtransform>'.(int)$msg['nltransform'].'</NLtransform>'."\n".
				'		</Msg>'."\n";
			};
			$data.='	</Messages>'."\n";
			$data.='</SendPacketSMS>';
			
			
			$result=$this->SendToServer(iconv('windows-1251','utf-8',$data));
			return $result;
		}
		
		public function GetPacketSMSStatus($messages){
			$this->error=Array();
			$data = 
			'<?xml version="1.0" encoding="utf-8"?>'."\n".
			'<GetPacketSMSStatus>'."\n".
			'	<User><![CDATA['.$this->login.']]></User>'."\n".
			'	<Password><![CDATA['.$this->password.']]></Password>'."\n".
			'	<Messages>'."\n";
			foreach($messages as $msg){
				$data.=
				'		<Msg>'."\n".
				'			<ServerID>'.$msg['serverid'].'</ServerID>'."\n".
				'		</Msg>'."\n";
				$i++;
			};
			$data.='	</Messages>'."\n";
			$data.='</GetPacketSMSStatus>';
			
			$result=$this->SendToServer(iconv('windows-1251','utf-8',$data));
			
			return $result;
			
		}		
		
		public function ErrNo(){
			return $this->error['no'];
		}

		public function Error(){
			return $this->error['err'];
		}
		
		// private area
		
		private function SendToServer($data){
			$headers = array (
				"POST / HTTP/1.1",
				"Host: gate.sms-client.ru",
				"Content-Type: text/xml; charset=utf-8",
				"Content-Length: ".strlen($data),
			);	
	
			$ch = curl_init();
		    curl_setopt($ch, CURLOPT_URL,"http://gate.sms-client.ru/?".rand(222222,333333333333));
		    curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
		    curl_setopt($ch, CURLOPT_TIMEOUT, 120);
		    curl_setopt($ch, CURLOPT_HTTPHEADER, $headers);
		    curl_setopt($ch, CURLOPT_POST, 1);
		    curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
		    
		    $return = curl_exec($ch);  
		    
		    if(!$return){
		    	$this->error['no']=curl_errno($ch);
		    	$this->error['err']=curl_error($ch);
		    }
		    
		    return $return;
		}
	}
?>