<?php

exit;

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php'); 

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$tickets = array();

$query = "SELECT TicketID, UserIDLast, PIDLast, Priority, Importance, Type FROM ticketing";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $tickets[] = $row;
}

foreach ($tickets as $ticket) {
    $conn->query("UPDATE ticketing_history SET 
						UserID     = {$ticket['UserIDLast']},
						PID        = {$ticket['PIDLast']},
						Priority   = {$ticket['Priority']},
						Importance = {$ticket['Importance']},
						Type       = {$ticket['Type']}
                  WHERE TicketID = {$ticket['TicketID']}");
}

?>