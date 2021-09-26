<?php

/*

function sendMail($from_name, $from_mail, $to_name, $to_mail, $subject, $messaje, $attachments=array())
{
	echo "<hr />
	FROM: ".$from_name." ".$from_mail."<br />
	TO: ".$to_name." ".$to_mail."<br />
	SUBJECT: ".$subject."<br />
	MSG: ".$messaje."<br />
	";
	
}


*/

function sendMail($from_name, $from_mail, $to_name, $to_mail, $subject, $messaje, $attachments = array())
{
    //include_once('class.phpmailer.php');
    //include_once('Config.php');
    $class_mail = new PHPMailer();

    $mesaj = preg_replace('!\s+!', ' ', $mesaj);

    $class_mail->IsSMTP();
    $class_mail->Mailer = 'smtp';
    $class_mail->SMTPSecurity = Config::SMTP_SECURITY;
    $class_mail->IsHTML(true);
    $class_mail->CharSet = "utf-8";

    ### Date server mail
    $class_mail->Host = Config::SMTP_HOST;
    $class_mail->SMTPAuth = Config::SMTP_AUTH;
    $class_mail->Username = Config::SMTP_USER;
    $class_mail->Password = Config::SMTP_PASS;
    $class_mail->Port = Config::SMTP_PORT;

    ### Date destinatar: mail, nume
    $class_mail->AddAddress($to_mail, $to_name);

    ### Date expeditor
    $class_mail->From = $from_mail;
    $class_mail->FromName = $from_name;

    $class_mail->Subject = $subject;
    $class_mail->Body = $messaje;
    $class_mail->AltBody = $messaje;

    if (!empty($attachments)) {
        foreach ($attachments as $attachment) {
            $path_parts = pathinfo($attachment);
            $file_name = $path_parts['basename'];
            $mime_type = Utils::getMIMEType($file_name);
            $class_mail->AddAttachment($attachment, $file_name, "base64", $mime_type);
        }
    }

    //echo "<pre>";

    //$class_mail->SMTPDebug = 0;

    $class_mail->Send();

    //print_r($class_mail);
    //die();

    $class_mail = "";
    settype($class_mail, 'null');
    settype($content, 'null');
}

?>