<?php

function __autoload($className) {
    include('libs/' . $className . '.php');
}
include('libs/DB.class.php');

try {

    session_start();
    
    $redirect = !empty($_GET['redirect']) ? $_GET['redirect'] : Config::SRV_URL;
    
    if (isset($_SESSION['USER_ID'])) {
	header('Location: ' . $redirect);
	exit;
    }
    
    if (!empty($_GET['authString'])) {
    
	@$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);
    
	$authString 	  = Utils::decrypt(base64_decode(str_replace(' ', '+', trim($_GET['authString']))), Config::ENCRYPTION_KEY);
	$parts	    	  = explode('||', $authString);
	$username   	  = trim($parts[0]);
	$password   	  = trim($parts[1]); 
	$_POST['area_id'] = 1;
	User::login($username, $password, 1);
    }

    header('Location: ' . $redirect);
    exit;

} catch(Exception $exp) {

    echo $exp->getMessage();
}   

?>