<?php

exit;

set_time_limit(0);

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');
include('../libs/sendMail.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$yesterday  = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));
$yesterdayf = date('d.m.Y', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));

$emails = array();

$query = "SELECT a.FullName, a.Email, b.THours
          FROM   persons a
                 INNER JOIN (
                		SELECT PersonID, SUM(Hours) AS THours FROM pontaj WHERE Data = '$yesterday' GROUP BY PersonID
                	    ) b ON a.PersonID = b.PersonID
          WHERE a.Email > '' AND THours < 8";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $row['FullName'] = stripslashes($row['FullName']);
    $emails[]        = $row;
}

if (!empty($emails)) {

    $subject = "Reminder completare pontaj pentru $yesterdayf";
    //$headers = "From: \"Adriana Mihailescu\" <a.mihailescu@popp-si-asociatii.ro>";

    foreach ($emails as $info) {
	//$info['Email'] = "cristian.stefanescu@ka-te.ro";
	$to      = "\"{$info['FullName']}\" <{$info['Email']}>";
	$message = "Salut {$info['FullName']},\n\nIeri $yesterdayf ai pontat {$info['THours']} ore. Poti modifica pontajul aferent zilei de ieri pana azi la ora 15:00.\n\nO zi buna!";
	//mail($to, $subject, $message, $headers);
	//mail($to, $subject, $message, $headers); // Simple alternative
	sendMail('HRE',Config::SMTP_USER,$info['FullName'],$info['Email'],$subject,$message);
    }

    echo(date("d-m-Y H:i:s") . " | S-au trimis " . count($emails) . " mail-uri !\n");

} else {

    echo(date("d-m-Y H:i:s") . " | Nu s-a trimis mail !");
}

?>