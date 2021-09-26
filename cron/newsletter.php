<?php

set_time_limit(0);

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');
include('../libs/sendMail.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$query = "SELECT * FROM newsletters WHERE Status = 1 AND SendStartDate<=CURRENT_TIMESTAMP LIMIT 1";
$conn->query($query);
$row = $conn->fetch_array();
$i=1;
if(!empty($row)){
	// Reset counter
	$conn->query("UPDATE newsletters SET Counter=0 WHERE NewsletterID={$row['NewsletterID']}");
	// Get mail content
	$message = file_get_contents('../online-newsletters/'.$row['Campaign'].'/index.html');
	$message = str_replace("<br />", "<br/>", $message);
	// Get attachments
	$docs = array();
	foreach ((array)glob('../online-newsletters/' . $row['Campaign'] . '/docs/*') as $item) {
	    	$docs[] = $item;
	}

	// Arrange e-mail addresses
	$emailsGeneral = unserialize($row['Recipients']);
	$emailsAux = explode(';',$row['AuxRecipients']);
	$emails = array();
	if(!empty($emailsGeneral))
	foreach($emailsGeneral as $email){		if(filter_var(trim($email), FILTER_VALIDATE_EMAIL))
			$emails[] = trim($email);
	}
	
	if(!empty($emailsAux))
	foreach($emailsAux as $email){		if(filter_var(trim($email), FILTER_VALIDATE_EMAIL))
			$emails[] = trim($email);
	}
	$emails = array_unique($emails);
	
	//sendMail($row['FromAlias'],$row['FromEmail'],'dragos.andrei@kate.ro','dragos.andrei@kate.ro',$row['Title'],$message,$docs);
	//exit;
	
	//Start sending
	if(!empty($emails))
	foreach($emails as $email){
		sendMail($row['FromAlias'],$row['FromEmail'],$email,$email,$row['Title'],$message,$docs);
		// Update Counter
		$conn->query("UPDATE newsletters SET Counter=Counter+1 WHERE NewsletterID={$row['NewsletterID']}");
		## Afisez
		echo " Am trimis la ".$email."(".+$i.")<br>";
		flush();
		ob_flush();
		
		// Delay in order not to overlead server
		sleep(2);
		$i++;
	}
	
	// Finished, then make it Inactive
	$conn->query("UPDATE newsletters SET Status=2 WHERE NewsletterID={$row['NewsletterID']}");

}




?>