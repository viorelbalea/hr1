<?php

exit;

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php'); 

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$persons = array();

$query = "SELECT PersonID FROM vacations_details WHERE Type = 'CIC' AND Aprove >= 0 AND DATE_ADD(StopDate, INTERVAL 1 DAY) = CURRENT_DATE";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $persons[] = $row['PersonID'];
}

foreach ($persons as $PersonID) {
    $conn->query("UPDATE persons SET Status = CASE WHEN Status = 8 THEN 2 WHEN Status = 14 THEN 7 ELSE Status END WHERE PersonID = $PersonID");
}

?>