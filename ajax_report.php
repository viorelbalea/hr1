<?php

function __autoload($className) {
    include('libs/' . $className . '.php');
}
include('libs/DB.class.php'); 
include('libs/Smarty.class.php');

try {

    @$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

    $o = !empty($_GET['o']) ? $_GET['o'] : 'default';

    switch ($_GET['o']) {
    
	case 'SubStatus';
	
	    $info = "<select name=\"value[Personal][SubStatus]\" style=\"font-size: 11px;\"><option value=\"\">alege...</option>";
	    foreach (Person::$msSubStatus[$_GET['Status']] as $k => $v) {
		$info.= "<option value=\"{$k}\">{$v}</option>";
	    }
	    $info.= "</select>";
	    echo $info;
	
	break;
	
	case 'CityID':

            $cities = Address::getCities($_GET['DistrictID']);
            $info   = "<select name=\"value[Personal][d.CityID]\" style=\"font-size: 11px;\"><option value=\"\">alege...</option>";
	    foreach ($cities as $k => $v) {
		$info.= "<option value=\"{$k}\">{$v}</option>";
	    }
	    $info  .= "</select>";
	    echo $info;

        break;
	
	case 'city':
        
            $listArr = Address::getCities($_GET['districtID']);
            $list    = '<select name="values[1][address_city__City]"><option value=""></option>';
            foreach ($listArr as $k => $v) {
                $list.= '<option value="' . $k . '"' . ($k == $_GET['CityID'] ? 'selected' : '') . '>' . $v . '</option>';
            }
            echo $list . '</select>';
	
	break;    
    }
    
} catch(Exception $exp) {
    
    echo $exp->getMessage();
}    

?>