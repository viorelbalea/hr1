<?php

set_time_limit(0);

$yesterday = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - 1, date('Y')));

if (date('w') == 0 || date('w') == 1) {
    echo "Pontaj detaliat: $yesterday: zi de weekend\n";
    exit;
}

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');

if (isset(ConfigData::$msLegal[$yesterday])) {
    echo "Pontaj detaliat: $yesterday: sarbatoare legala\n";
    exit;
}

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$persons = array();
$query = "SELECT a.PersonID, b.WorkNorm, b.WorkStartHour, b.LunchBreakStartHour, b.LunchBreakEndHour, c.CostCenterID,
                 CASE WHEN EXISTS (SELECT VacationID FROM vacations_details WHERE PersonID = a.PersonID AND Type != 'INV' AND '$yesterday' BETWEEN StartDate AND StopDate AND Aprove >= 0) THEN 1 ELSE 0 END AS is_vac
          FROM   persons a
                 INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.WorkNorm > 0 AND b.WorkStartHour > ''
		 LEFT JOIN payroll_costcenter c ON b.PersonID = c.PersonID
          WHERE  a.Status IN (2,7,9)";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    if ($row['is_vac'] == 1) {
	continue;
    }
    $persons[$row['PersonID']] = $row;
}

foreach ($persons as $PersonID => $person) {
    $end      = strtotime($yesterday . ' ' . $person['WorkStartHour'] . ':00') + $person['WorkNorm'] * 3600 + 
		(!empty($person['LunchBreakEndHour']) && !empty($person['LunchBreakStartHour']) ? (strtotime($yesterday . ' ' . $person['LunchBreakEndHour'] . ':00') - strtotime($yesterday . ' ' . $person['LunchBreakStartHour'] . ':00')) : 0);
    $end_date = date('Y-m-d', $end);
    $end_hour = date('H:i', $end);
    if ($end_date != $yesterday) {
	$hours  = round((strtotime($yesterday . ' 23:59:59') - strtotime($yesterday . ' ' . $person['WorkStartHour'] . ':00')) / 3600, 2);
	$hours2 = $person['WorkNorm'] - $hours;
    } else {
	$hours  = $person['WorkNorm'];
	$hours2 = 0;
    }
    $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                  VALUES(1, $PersonID, '$yesterday', '{$person['WorkStartHour']}', '$end_date', '$end_hour', '$hours', '$hours2', '{$person['CostCenterID']}', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
}

echo "Pontaj detaliat: $yesterday: " . count($persons) . " inregistrari efectuate\n";

?>