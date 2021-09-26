<?php

set_time_limit(0);
ini_set("display_errors", "1");

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
function __autoload($className) {
    include('libs/' . $className . '.php');
}

include('libs/DB.class.php');
include('libs/sendMail.php');
include('libs/ConfigData.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$alerts = array();

echo "<br />TESTING: ";

sendMail('sru','server.sru@social2.ro', '', 'stefan.fodor@kate.ro', 'test', 'mesaj');

echo "<br />Testing done.";

?>