<?php

function __autoload($className) {
    require_once('../libs/' . $className . '.php');
}
require_once('../libs/DB.class.php');
require_once('../libs/pop3.class.php5.inc');

$bUseSockets = FALSE;
$bUseTLS = TRUE;
$bIPv6 = FALSE;
$arrConnectionTimeout = array( "sec" => 10,
    "usec" => 500 );
// POP3 Options
$strProtocol= "tcp";
$strHost = "mail.kate.ro";
$intPort = 110;
$strUser = "tichet@kate.ro";
$strPass = "T02!crt@73";
$bAPopAutoDetect = TRUE;
$bHideUsernameAtLog = FALSE;

// Logging Options
$strLogFile = "php://stdout";//$strRootPath. "pop3.log";

// EMail store Sptions
$strPathToDir = $strRootPath."mails" .DIRECTORY_SEPARATOR;
$strFileEndings = ".eml";

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

try
{
    // Instance the POP3 object
    $objPOP3 = new POP3( $strLogFile, $bAPopAutoDetect, $bHideUsernameAtLog, $strProtocol, $bUseSockets );

    // Connect to the POP3 server
    $objPOP3->connect($strHost,$intPort,$arrConnectionTimeout,$bIPv6);

    // Logging in
    $objPOP3->login($strUser, $strPass);

    // Get the office status
    $arrOfficeStatus = $objPOP3->getOfficeStatus();

    if($arrOfficeStatus["count"] >= 20)
    {
        mail("alexandru.simion@kate.ro", "Spam ticketing HRE", "Limita maxima de 20 de mail-uri pe cron a fost depasita!");
        mail("stefan.fodor@kate.ro", "Spam ticketing HRE", "Limita maxima de 20 de mail-uri pe cron a fost depasita!");
        die();
    }

    /**
     * This for loop store the messages under their message number on the server
     * and mark the message as delete on the server.
     */
    $messages = array();
    for($intMsgNum = 1; $intMsgNum <= $arrOfficeStatus["count"]; $intMsgNum++ )
    {
        $msg = $objPOP3->getMsg($intMsgNum);
        $header = $objPOP3->getTop($intMsgNum);
        $lines = explode("\n", $msg);
        //echo "<pre>"; print_r($lines); echo "</pre>";
        //echo "<pre>"; print_r($header); echo "</pre>";
        foreach ($lines as $line) {

            if (($pos = strpos($line, 'Message-ID:')) !== false) {
                $messages[$intMsgNum]['Message-ID'] = str_replace(array('<','>'), array('',''), trim(substr($line, $pos + strlen('Message-ID:'))));
            }
            else {
                $messages[$intMsgNum]['Message-ID'] = md5($msg);
            }
            if (($pos = strpos($line, 'Date:')) !== false) {
                $messages[$intMsgNum]['Date'] = date('Y-m-d H:i:s', strtotime(trim(substr($line, $pos + strlen('Date:')))));
            }
            if (($pos = strpos($line, 'From:')) !== false) {
                if (($pos2 = strpos($line, '<')) !== false) {
                    $messages[$intMsgNum]['From'] = trim(str_replace('>', '', substr($line, $pos2 + 1)));
                } else {
                    $messages[$intMsgNum]['From'] = trim(substr($line, $pos + strlen('From:')));
                }
            }
            if (($pos = strpos($line, 'Subject:')) !== false) {
                $subject = trim(substr($line, $pos + strlen('Subject:')));
                if(strpos($subject, 'Q?') !== false) {
                    $subject = trim(str_replace("?=", "", substr($subject, strpos($subject, 'Q?')+2)));
                    $subject = trim(str_replace("_", " ", $subject));
                    $subject = trim(str_replace("=5F", "_", $subject));
                }
                $messages[$intMsgNum]['Subject'] = $subject;
            }

            if(strpos($msg, "Content-Type: text/plain") > strpos($msg, "Content-Transfer-Encoding:"))
                $startMessagePos = strpos($msg, "Content-Transfer-Encoding:");
            else
                $startMessagePos = strpos($msg, "Content-Type: text/plain");

            $endMessagePos = strpos($msg, "--", $startMessagePos);

            $body = substr($msg, $startMessagePos, ($endMessagePos !== false ? $endMessagePos-$startMessagePos : strlen(substr($msg, $startMessagePos))));

            $bodyLines = explode("\n", $body);
            $startMessage = false;
            $endMessage = false;
            $bodyContent = '';
            foreach($bodyLines as $bodyLine) {
                //echo "<pre>"; print_r(strlen($bodyLine)); echo "</pre>";
                //echo "<pre>"; print_r($bodyLine); echo "</pre>";
                if($startMessage && strlen($bodyLine) == 1)
                    $endMessage = true;
                if(strlen($bodyLine) == 1)
                    $startMessage = true;
                if($startMessage && strlen($bodyLine) > 1 && !$endMessage)
                    $bodyContent .= $bodyLine;
            }
            $startEncoding = stripos($body, "Content-Transfer-Encoding: ");
            $encoding = '';
            if($startEncoding !== false) {
                $endEncoding = strpos($body, "\n", $startEncoding);
                $encoding = trim(str_replace("Content-Transfer-Encoding: ", "", substr($body, $startEncoding, $endEncoding-$startEncoding)));
            }
            //echo "<pre>"; print_r($startEncoding); echo "</pre>";

            if ($encoding == "base64") {
                $decodedBody = explode("\n", base64_decode($bodyContent));
                $endMessage = false;
                $bodyContent = '';
                foreach($decodedBody as $bodyLine) {
                    //echo "<pre>"; print_r(strlen($bodyLine)); echo "</pre>";
                    //echo "<pre>"; print_r($bodyLine); echo "</pre>";
                    if(strlen($bodyLine) == 1)
                        $endMessage = true;
                    if(strlen($bodyLine) > 1 && !$endMessage)
                        $bodyContent .= $bodyLine;
                }
            }
            $bodyContent = trim($bodyContent);
            if(substr(trim($bodyContent), -1) == "=")
                $bodyContent = substr($bodyContent, 0, strlen($bodyContent) - 1);
            //echo "<pre>"; print_r($decodedBody); echo "</pre>";

            $messages[$intMsgNum]['Body'] = $bodyContent;
            //echo "<pre>"; print_r($encoding); echo "</pre>";
        }
        //die();
        //$objPOP3->saveToFileFromServer($intMsgNum, $strPathToDir, $strFileEndings);
        $objPOP3->deleteMsg($intMsgNum);
    }
    //echo "<pre>"; print_r($messages); echo "</pre>";
    foreach ($messages as $intMsgNum => $info) {

        $Title = $info['Subject'];
        $Notes = $info['Body'];

        $PersonID  = 0;
        $RoleID  = 1;
        $CompanyID = 0;
        $ContactID = 0;
        $conn->query("SELECT PersonID, RoleID FROM persons WHERE Status IN (2,7,9,10) AND Email = '{$info['From']}'");
        //echo "<pre>"; print_r("SELECT PersonID FROM persons WHERE Status IN (2,7,9,10) AND Email = '{$info['From']}'"); echo "</pre>";
        if ($row = $conn->fetch_array()) {
            $PersonID = $row['PersonID'];
            $RoleID = $row['RoleID'];
        } else {
            $conn->query("SELECT CompanyID, ContactID FROM companies_contacts WHERE ContactEmail = '{$info['From']}'");
            if ($row = $conn->fetch_array()) {
                $CompanyID = $row['CompanyID'];
                $ContactID = $row['ContactID'];
            }
        }
        if($PersonID == 0 && $CompanyID == 0) {
            mail("alexandru.simion@kate.ro", "Tichet trimis de persoana inexistenta", "From: " . $info['From'] . "\nSubject: " . $info['Subject'] . "\nBody: " . $info['Body']);
            mail("stefan.fodor@kate.ro", "Tichet trimis de persoana inexistenta", "From: " . $info['From'] . "\nSubject: " . $info['Subject'] . "\nBody: " . $info['Body']);
        }
        else
            $conn->query("INSERT INTO ticketing(UserID, PID, CreateDate, LastUpdateDate, UserIDLast, PIDLast, MailMessageID,
											CategoryID, PersonID, CompanyID, ContactID,
											CostCenterID, Status, Priority, Importance, Type, InterventionType, Title, Notes)
					  VALUES($RoleID, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, $RoleID, $PersonID, '{$info['Message-ID']}',
					 1, $PersonID, $CompanyID, $ContactID, 8, 1, 2, 2, 2, 1, '" . $conn->real_escape_string($Title) . "', '" . $conn->real_escape_string($Notes) . "')");
        /*print_r("INSERT INTO ticketing(UserID, PID, CreateDate, LastUpdateDate, UserIDLast, PIDLast, MailMessageID,
                                            CategoryID, PersonID, CompanyID, ContactID,
                                            CostCenterID, Status, Priority, Importance, Type, InterventionType, Title, Notes)
                      VALUES(1, 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 1, 0, '{$info['Message-ID']}',
                     1, $PersonID, $CompanyID, $ContactID, 8, 1, 2, 2, 2, 1, '" . $conn->real_escape_string($Title) . "', '" . $conn->real_escape_string($Notes) . "')");*/
    }

    // Send the quit command and all as delete marked message will remove from the server.
    // IMPORTANT: 
    // If you deleted many mails it could be that the +OK response will take some time.
    $objPOP3->quit();

    // Disconnect from the server
    // !!! CAUTION !!!
    // - this function does not send the QUIT command to the server
    //   so all as delete marked message will NOT delete
    //   To delete the mails from the server you have to send the quit command themself before disconnecting from the server
    $objPOP3->disconnect();
}
catch( POP3_Exception $e )
{
    die($e);
}

// Your next code