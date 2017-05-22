<?php if (!defined('SCRIPTACCESS')) exit;

function mail_($to , $subj, $body, $reply_to='ns.gostevoydom@mail.ru') {

require_once $_SERVER['DOCUMENT_ROOT'].'/kernel/classes/phpmailer.class.php';

    try {
        $mail = new PHPMailer(true); //New instance, with exceptions enabled

        //$body = file_get_contents('/mirima/phpmailer/test/contents.html');
        $body = preg_replace('/\\\\/','', $body); //Strip backslashes
        $body = nl2br($body);

        $mail->IsSMTP(); // tell the class to use SMTP
        $mail->SMTPAuth = true; // enable SMTP authentication
        $mail->SMTPSecure = "ssl";
        $mail->Port = 465; // set the SMTP server port
        $mail->Host = "smtp.yandex.ru"; // SMTP server
        $mail->CharSet='utf-8';
        $mail->Username = "noreplytomsk@yandex.ru"; // SMTP server username
        $mail->Password = "noreplytomsk123"; // SMTP server password

        $mail->AddReplyTo($reply_to,"");

        $mail->From = "noreplytomsk@yandex.ru";
        $mail->SetFrom('noreplytomsk@yandex.ru', '');
        $mail->FromName = "";

        //$to = "admin@r70.ru";


        $to = explode(',', $to);
        for ($i = 0; $i < count($to); $i++) {
        $mail->AddAddress($to[$i]);
        };

        $mail->Subject = $subj;

        $mail->AltBody = "To view the message, please use an HTML compatible email viewer!"; // optional, comment out and test
        //$mail->WordWrap = 80; // set word wrap

        $mail->MsgHTML($body);

        $mail->IsHTML(true); // send as HTML

        $mail->Send();
    //echo 'Message has been sent.';
    } catch (phpmailerException $e) {
        echo $e->errorMessage();
    }

}