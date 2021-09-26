<?php


set_time_limit(0);
if(empty($_GET['skip_load'])){
    function __autoload($className) {
        include('../libs/' . $className . '.php');
    }


    include('../libs/DB.class.php');
    include('../libs/sendMail.php');
    include('../libs/ConfigData.php');
}
$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$conn->query("TRUNCATE TABLE pontaj_monthly");

$conn->query("SELECT PersonID, CNP FROM persons");
$persons = array();
while($row = $conn->fetch_array()){
    $persons[$row['CNP']] = $row['PersonID'];
}


$conn->query("SELECT * FROM imp_pm");
$pm = array();
while($row = $conn->fetch_array()){
    $pm[] = $row;
}

foreach($pm as $p){
    if(!empty($p['P04'])){
        $conn->query("INSERT INTO pontaj_monthly(Month, PersonID, Type, Value, StocAnterior, OreL, OreP, Rest, Plata, Stoc, CreateDate)
                        VALUES('2013-04-01', '{$persons[$p['CNP']]}', 1, '{$p['L04']}', '{$p['StocA04']}', '{$p['L04']}', '{$p['P04']}', '{$p['R04']}', '{$p['PL04']}', '{$p['Stoc04']}', CURRENT_TIMESTAMP)");
    }
    if(!empty($p['P05'])){
        $conn->query("INSERT INTO pontaj_monthly(Month, PersonID, Type, Value, StocAnterior, OreL, OreP, Rest, Plata, Stoc, CreateDate)
                        VALUES('2013-05-01', '{$persons[$p['CNP']]}', 1, '{$p['L05']}', '{$p['StocA05']}', '{$p['L05']}', '{$p['P05']}', '{$p['R05']}', '{$p['PL05']}', '{$p['Stoc05']}', CURRENT_TIMESTAMP)");
    }
    if(!empty($p['P06'])){
        $conn->query("INSERT INTO pontaj_monthly(Month, PersonID, Type, Value, StocAnterior, OreL, OreP, Rest, Plata, Stoc, CreateDate)
                        VALUES('2013-06-01', '{$persons[$p['CNP']]}', 1, '{$p['L06']}', '{$p['StocA06']}', '{$p['L06']}', '{$p['P06']}', '{$p['R06']}', '{$p['PL06']}', '{$p['Stoc06']}', CURRENT_TIMESTAMP)");
    }
}




?>
