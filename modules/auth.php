<?php

if (!isset($_SESSION['PERS'])) {
    header('Location: ../');
    exit;
}

if (!empty($_POST)) {

    try {

        Person::setAuthInfo($_SESSION['PERS']);
        $unde = $_SERVER['REQUEST_URI']
	header('Location: ' . $unde);
	exit;
		
    } catch (Exception $exp) {

        $err->setError($exp->getMessage());
    }
}

$smarty->assign(array(
    'info' => Person::getAuthInfo($_SESSION['PERS']),
));

$center_file = 'auth.tpl';

?>