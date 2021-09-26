<?php

set_time_limit(0);
ini_set("display_errors", "1");
echo "<pre>";
//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
function __autoload($className) {
    include('../libs/' . $className . '.php');
}

include('../libs/DB.class.php');
include('../libs/sendMail.php');
include('../libs/ConfigData.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$alerts = array();

//$query = "SELECT * FROM alert WHERE Active = 1 AND AlertDate BETWEEN DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 Hour) AND CURRENT_TIMESTAMP";
$query = "SELECT * FROM alert WHERE Active = 1";
//$query = "SELECT * FROM alert WHERE Active = 1 AND AlertDate = '2012-09-04 08:00:00'";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $row['Subject'] = stripslashes($row['Subject']);
    $row['Body'] = stripslashes($row['Body']);
    $row['FromAlias'] = stripslashes($row['FromAlias']);
    if (!empty($row['Settings'])) {
        $row['Settings'] = unserialize($row['Settings']);
    }
    if (!empty($row['ToAuxEmails'])) {
        $row['ToAuxEmails'] = explode(';', $row['ToAuxEmails']);
    }
    $alerts[$row['ID']] = $row;
}

foreach ($alerts as $ID => $alert) {
    switch ($ID) {
        case 41:

            $query = "SELECT DATE(a.`AlertDate`)  AS alertDate, DATE(NOW()) AS currentDate, Settings  FROM alert a WHERE a.`ID` = $ID";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $alertDate = $row['alertDate'];
                $currentDate = $row['currentDate'];
                if(!empty($row['Settings'])){
                    $settings = unserialize($row['Settings']);
                }
                $arrRolesID = array_keys($settings['roles']);
            }
            if (strtotime($alertDate) <= strtotime($currentDate)) {
                $subject = $alert['Subject'];
                $currNumber = 1;
                $addedMessages = array();
                $query = "SELECT
                        a.`Name` AS alert_name,
                        CONCAT(p.`FullName`, ' ', p.`FirstName`) AS nume_prenume,
                        al.`Message` AS content,
                        al.`CreateDate`,
                        al.AlertID as alertID,
                        al.PersonID as personID
                    FROM
                        alert_log al
                        INNER JOIN alert a ON a.`ID` = al.`AlertID`
                        INNER JOIN persons p ON al.`PersonID` = p.`PersonID`
                    WHERE al.`AlertID` IN (2, 4, 9, 10, 11, 12, 13, 14)
                         AND al.`CreateDate` > DATE_SUB(NOW(), INTERVAL 73 HOUR)
                          ORDER BY al.`CreateDate` DESC";

                $conn->query($query);
                print_r($query);
                $header = false;
                $message = 'Nu s-au generat alerte in ultimile 72 de ore';
                while ($row = $conn->fetch_array()) {//construiesc mesajul
                    if($header == false) {
                        $message = "{$alert['Body']} <table border=1> <tr><th>Nr. crt</th><th>Nume alerta primita</th><th>Nume persoana</th><th>Continut</th><th>Data ultimei alerte</th></tr>";
                        $header = true;
                    }
                    if (!in_array($row['content'], $addedMessages)) {//verific daca nu am mai adaugat in tabel o linie cu continutul ala
                        $message .= "<tr><td>$currNumber</td><td>{$row['alert_name']}</td><td>{$row['nume_prenume']}</td><td>{$row['content']}</td><td>{$row['CreateDate']}</td></tr>";
                        $currNumber++;
                    }
                    $addedMessages[] = $row['content']; // array cu body-ul alertelor
                }
                $message .= ($message != '' ? '</table>' : '');
                echo $message;
                foreach ((array) $alert['ToAuxEmails'] as $to) {// trimit mail catre aux si loghez alerta
                    //Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                    //sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                }

                // dau mail catre rolurile selectate si loghez alerta
                $query = 'SELECT Email, PersonID, CONCAT(FirstName, " ", LastName) AS fullname FROM persons p  WHERE p.`RoleID` IN ('.implode(',',$arrRolesID) .')';
                $conn->query($query);
                while ($row = $conn->fetch_array()){
                    if(!empty($row['Email'])){
                        //Alert::logAlert($ID, $row['PersonID'], 0, $row['Email'], $subject, $message);
                        //sendMail($alert['FromAlias'], $alert['FromEmail'], $row['fullname'], $row['Email'], $subject, $message);
                    }
                }
            }
            break;
    }

    switch ($alert['Type']) {
        case 'daily':
            $days = 1; //date('w') == 5 ? 3 : 1;
            //mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTERVAL $days DAY) WHERE ID = $ID");
            break;
        case 'weekly':
            //mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTERVAL 1 WEEK) WHERE ID = $ID");
            break;
        case 'monthly':
            //mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTREVAL 1 MONTH) WHERE ID = $ID");
            break;
        case '3days':
            $days = 3;
            //mysql_query("UPDATE alert SET AlertDate = DATE_ADD(NOW(), INTERVAL 3 DAY) WHERE ID = $ID");
            break;
    }
}
echo "</pre>";