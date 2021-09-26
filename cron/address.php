<?php

exit;

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');
include('../libs/sendMail.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$conn->query("SELECT * FROM address_street");
while ($row = $conn->fetch_array()) {
    $streets[$row['StreetID']] = $row;
}

foreach ($streets as $StreetID => $v) {
    $conn->query("UPDATE address SET CityID = '{$v['CityID']}', StreetName = '{$v['StreetName']}', StreetCode = '{$v['StreetCode']}' WHERE StreetID = $StreetID");
}

?>