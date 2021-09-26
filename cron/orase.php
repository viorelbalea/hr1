<?php

exit;

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');
include('../libs/sendMail.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$conn->query("SELECT b.DistrictID, a.Oras
              FROM   __orase a 
	             INNER JOIN address_district b ON a.Cod = b.DistrictCode");
while ($row = $conn->fetch_array()) {
    $orase[] = $row;
}

foreach ($orase as $v) {
    $conn->query("INSERT INTO address_city(DistrictID, CityName) VALUES('{$v['DistrictID']}', '{$v['Oras']}')");
    if ($conn->errno == 1062) {
	continue;
    }
}

?>