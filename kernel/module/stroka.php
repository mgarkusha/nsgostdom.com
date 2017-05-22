<?php if (!defined('SCRIPTACCESS')) exit;
function to_translit($str) {
    $transchars =array (
    "E1"=>"A",
    "E2"=>"B",
    "F7"=>"V",
    "E7"=>"G",
    "E4"=>"D",
    "E5"=>"E",
    "B3"=>"Jo",
    "F6"=>"Zh",
    "FA"=>"Z",
    "E9"=>"I",
    "EA"=>"I",
    "EB"=>"K",
    "EC"=>"L",
    "ED"=>"M",
    "EE"=>"N",
    "EF"=>"O",
    "F0"=>"P",
    "F2"=>"R",
    "F3"=>"S",
    "F4"=>"T",
    "F5"=>"U",
    "E6"=>"F",
    "E8"=>"H",
    "E3"=>"C",
    "FE"=>"Ch",
    "FB"=>"Sh",
    "FD"=>"W",
    "FF"=>"X",
    "F9"=>"Y",
    "F8"=>"Q",
    "FC"=>"Eh",
    "E0"=>"Ju",
    "F1"=>"Ja",

    "C1"=>"a",
    "C2"=>"b",
    "D7"=>"v",
    "C7"=>"g",
    "C4"=>"d",
    "C5"=>"e",
    "A3"=>"jo",
    "D6"=>"zh",
    "DA"=>"z",
    "C9"=>"i",
    "CA"=>"i",
    "CB"=>"k",
    "CC"=>"l",
    "CD"=>"m",
    "CE"=>"n",
    "CF"=>"o",
    "D0"=>"p",
    "D2"=>"r",
    "D3"=>"s",
    "D4"=>"t",
    "D5"=>"u",
    "C6"=>"f",
    "C8"=>"h",
    "C3"=>"c",
    "DE"=>"ch",
    "DB"=>"sh",
    "DD"=>"w",
    "DF"=>"x",
    "D9"=>"y",
    "D8"=>"",
    "DC"=>"eh",
    "C0"=>"ju",
    "D1"=>"ja",
    );

    $str = html_entity_decode($str);
    $str = preg_replace("!<script[^>]{0,}>.*</script>!Uis", "", $str);
    $str = strip_tags($str);
    $str = preg_replace("![^абвгдеёжзийклмнопрстуфхцчшщьыъэюяАБВГДЕЁЖЗИЙКЛМНОПРСТУФХЦЧШЩЬЫЪЭЮЯa-z0-9 ]!i", " ", $str);
    $str = preg_replace("![\s]{2,}!", " ", $str);
    $str = trim($str);
    $ns = convert_cyr_string($str, "w", "k");
    for ($i=0;$i<strlen($ns);$i++) {
        $c=substr($ns,$i,1);
        $a=strtoupper(dechex(ord($c)));
        if (isset($transchars[$a])) {
            $a=$transchars[$a];
        } else if (ctype_alnum($c)){
            $a=$c;
        } else if (ctype_space($c)){
            $a='-';
        } else {
            $a='';
        }


        $b.=$a;
    }
    return $b;
}
	function sendmail_smtp($to,$subject,$body,$from='pa@r70.ru',$pasw='860215net'){
	/**
	* Simple example script using PHPMailer with exceptions enabled
	* @package phpmailer
	* @version $Id$
	*/
	
	require '/opt/lampp/hosting/www/stroka/data/PHPMailer_v5.0.2/PHPMailer_v5.0.2/class.phpmailer.php';
	
	try {
		$mail = new PHPMailer(true); //New instance, with exceptions enabled
	
	//	$body             = file_get_contents('contents.html');
	//	$body             = preg_replace('/\\\\/','', $body); //Strip backslashes
	
		$mail->CharSet    = 'cp1251';
		$mail->IsSMTP();                           // tell the class to use SMTP
		$mail->SMTPAuth   = true;                  // enable SMTP authentication
		$mail->Port       = 25;                    // set the SMTP server port
		$mail->Host       = "smtp.gmail.com"; // SMTP server
		$mail->Username   = $from;     // SMTP server username
		$mail->Password   = $pasw;            // SMTP server password
	
		$mail->IsSendmail();  // tell the class to use Sendmail
	
		$mail->AddReplyTo($from,$subject);
	
		$mail->From       = $from;
		$mail->FromName   = $subject;
	
		$to = $to;
	
		$mail->AddAddress($to);
	
		$mail->Subject  = $subject;
	
		$mail->AltBody    = $body;//"To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
		$mail->WordWrap   = 80; // set word wrap
	
		$mail->MsgHTML($body);
	
		$mail->IsHTML(true); // send as HTML
	
		$mail->Send();
	//	echo 'Message has been sent.';
	} catch (phpmailerException $e) {
		echo $e->errorMessage();
	}
	   
	}
	function translit($s){
		$rs = Array('а','б','в','г','д','е','ё','ж','з','и','й','к','л','м','н','о','п','р','с','т','у','ф','х','ц','ч','ш','щ','ъ','ы','ь','э','ю','я',' ');
		$rb = Array('А','Б','В','Г','Д','Е','Ё','Ж','З','И','Й','К','Л','М','Н','О','П','Р','С','Т','У','Ф','Х','Ц','Ч','Ш','Щ','Ъ','Ы','Ь','Э','Ю','Я',' ');
		$ls = Array('a','b','v','g','d','e','yo','zh','z','i','i','k','l','m','n','o','p','r','s','t','u','f','h','c','ch','sh','sch','','y','','e','yu','ya','');
		$lb = Array('A','B','V','G','D','E','Yo','Zh','Z','I','I','K','L','M','N','O','P','R','S','T','U','F','H','C','Ch','Sh','Sch','','Y','','E','Yu','Ya','');
		for ($i=0;$i<34;$i++) {
			while (strpos($s,$rs[$i])!==false) $s = str_replace($rs[$i],$ls[$i],$s);
			while (strpos($s,$rb[$i])!==false) $s = str_replace($rb[$i],$lb[$i],$s);
		}
		return $s;
	}	
	
	function schet($id)
	{
		?>
		
		<tr>
			<td valign="top" style="padding-bottom:5px;">
		<script type="text/javascript" src="/highslide/highslide-with-html.js"></script>
		<script type="text/javascript">
			hs.graphicsDir = '/highslide/graphics/';
			hs.outlineType = 'rounded-white';
			hs.showCredits = false;
		</script>

		<a href="index.htm" onclick="return hs.htmlExpand(this)">
			<b>Безналичным платежом</b>
		</a>
		<div class="highslide-maincontent">
		<form method="POST" >
		<table cellpadding="0" align="center" cellspacing="0" border="0">
			<tr>
				<td>Название организации<br>
					<input type="text" name="org">
				</td>
			</tr>
			<tr>
				<td>
					ИНН	<br>
					<input type="hidden" name="schet" value="<?=$id?>">
					<input type="text" name="inn">
				</td>
			</tr>
			<tr>
				<td>
					КПП<br>
					<input type="text" name="kpp">
				</td>
			</tr>
			<tr>
				<td>
					Адрес<br>
					<input type="text" name="address">
				</td>
			</tr>
			<tr>
				<td>
					Контакты ответственного лица<br>
					<input type="text" name="contact">
				</td>
			</tr>
			<tr>
				<td >
					<input style="width:144px;" type="submit" value="Скачать счет">
				</td>
			</tr>
		</table>
		
		</form>
				
				
				
			
		</div>
			</td>
		</tr>
		<?
	}
function comp_bloc($sql)
{
	
			$db=mysql_query($sql);
			$id_div=0;
			
			while($row=mysql_fetch_array($db)){
				$i--;$id_div++;
				
			
				
			if (in_array($id_div,$_SESSION['rblock_array']))
			{
				$rowb=mysql_fetch_array(mysql_query("SELECT * FROM ".conf::$dbprefix."company WHERE id=".(int)$_SESSION['rblock_id_array'][$id_div]." limit 1"));
			
//			if ($rowb['reklam_block'] && $_SERVER['REMOTE_ADDR']=='62.68.140.197') //Если рекламный блок
			if ($rowb['reklam_block']) //Если рекламный блок
			{
				echo "<div class=comp_advr1>";
				echo "<div class=comp_adv4 style='border: 1px dashed #FF8D6A;' >";
				?>
					<TABLE  cellPadding=0 width="337" border=0 cellspacing="0" height="100%"  style="background-color: #FFEFEB;">
						<tbody>
							<TR>
								<TD align="center" valign="top"  style="overflow: hidden;height:104px; border-bottom: 1px dashed #FF8D6A;padding:0px !important;">
								<div style="overflow:hidden;width:337px;height:104px;margin:0px;padding:0px;">
									<?
									$pik_help=$rowb['pictures'];
									$i=0;
									$pik="";
									while (($pik_help[$i]!='|') && ($i<strlen($pik_help)))
									{
										$pik.=$pik_help[$i];
										$i++;
									}
									if($rowb['pictures']){
											if(is_file('/opt/lampp/hosting/www/stroka/data/sitedata/'.$pik.'.jpg'))
											{
											if (!$rowb['url'])
												{
											?><a href="/company/<?=$rowb['id']?>/" class="link_obyav" ><IMG id=imgs src='/sitedata/<?=$pik?>.jpg'></a><?	
												}
											else {
											?><a target="_blank" href="<?=$rowb['url']?>" class="link_obyav" ><IMG id=imgs src='/sitedata/<?=$pik?>.jpg'></a><?
											}											
										}
									}	
									?>
								</div>
								</TD>
							</TR>
							<TR>
								<TD align="left" valign="middle" style="padding:0 0 0 5px;" height="26" width="100%" >
									<a class='niz' style="padding:0px !important;margin:0px;" href="/add_message/?rblock=1">Разместить рекламный блок</a>								
								</TD>
							</TR>
						</tbody>
					</table>
						
				<?
				echo "</div>";
				echo "</div>";
			}
			}
			if($row['reklam_block']!=1) {
				if ($row['sms'])
				{
					$strt='comp_std_act';
					$stra='comp_sadv_act';
					$strp='comp_pr2'.$id_div;
					$cv='#FF8D6A';
				}
				else 
				{
					$strt='comp_std2';
					$stra='comp_sadv2';
					$strp='comp_pr2';
					$cv='#e0e0e0';
				}
				echo "<div class=comp_advr1>";
				echo "<div class=comp_adv4  >";

				$pik_help=$row['pictures'];
				$i=0;
				$pik="";
				while (($pik_help[$i]!='|') && ($i<strlen($pik_help)))
				{
					$pik.=$pik_help[$i];
					$i++;
				}
				
				$da=datetime_::transform4($row['posted']);
				?>
				
				<TABLE class='<?=$stra;?>' id='<?=$strp?>' width="100%" cellPadding=0 cellspacing="0" border=0 height="100%">
						<TR>
							<TD class='<?=$strt?>' vAlign=top width="100%" height="100%" >
								<?
								if ($row['url'])
								{
									if (substr($row['url'],0,7)!='http://')
										$url='http://'.$row['url'];
									else $url=$row['url'];
								}
								else $url="http://Stroka.TV/company/{$row['id']}/";
									?>
								<div class="comp"><a href="/company/<?=$row['id']?>/" class="comp comp_link_name" ><b><?=(strlen($row['name'])>40)?substr($row['name'],0,40).'...':$row['name']?></b></a></div>
								<div class="comp comp_text" id=txt  style="font-family: arial;padding:0px!important;margin:0px!important;"><?=(strlen($row['short'])>100)?substr($row['short'],0,100).'...':$row['short']?></div>
								<div class="comp"><a target="_blank" href="<?=$url?>" class="comp comp_link" ><?=$url?></a></div>
							</TD>
						</TR>
				</TABLE>
						
				
	 			<?
				echo "</div>";
				echo "</div>";
			}
			}
}

function LinkForRef($text)
{
	if (/*$_SERVER['REMOTE_ADDR']=='62.68.129.155'&&*/!vars('print_r')&&!vars('print_v'))
	{
		?>
		<table class="tablehead" border="0" cellpadding="0" cellspacing="0" height="20" width="100%">
			<tbody><tr>
				<td>&nbsp;<img width="0" height="0" src="/NewRef/index.php?ref=<?=$_SESSION['ref']?>&refthis=<?=vars('refthis')?>&pathid=<?=conf::$pathid?>"></td>
				<td class="text" style="color: rgb(6, 86, 123);" width="100%"><?=$text?></td>
				<td>&nbsp;</td>
			</tr>
		</tbody></table>		
		<?;	
	}
	
}

	
?>