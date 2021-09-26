<?php


set_time_limit(0);

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');
include('../libs/sendMail.php');
include('../libs/ConfigData.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);


$conn->query("SELECT PersonID, CNP FROM persons");

$persons = array();

while($row = $conn->fetch_array()){
    $persons[$row['CNP']] = $row['PersonID'];
}

$conn->query("SELECT * FROM imp_pontaj");

$pontaj = array();

while($row = $conn->fetch_array()){
    $pontaj[$row['CNP']][] = $row;
}


Utils::pa($persons);

?>
