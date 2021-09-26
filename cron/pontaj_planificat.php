<?php

set_time_limit(0);

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$p_start_date = date('Y-m-01');
$p_end_date   = date('Y-m-d', mktime(0, 0, 0, date('m') + 1, 0, date('Y')));

$persons = array();
$query = "SELECT a.PersonID, b.WorkNorm, b.WorkStartHour, b.LunchBreakStartHour, b.LunchBreakEndHour, c.CostCenterID
          FROM   persons a
                 INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.WorkNorm > 0 AND b.WorkStartHour > ''
		 LEFT JOIN payroll_costcenter c ON b.PersonID = c.PersonID
          WHERE  a.Status IN (2,7,9)";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $persons[$row['PersonID']] = $row;
}

foreach ($persons as $PersonID => $person) {
    for ($curr_date = $p_start_date; $curr_date <= $p_end_date; $curr_date = date('Y-m-d', strtotime($curr_date) + 24 * 3600)) {
	if (isset(ConfigData::$msLegal[$curr_date]) || date('w', strtotime($curr_date)) == 6 || date('w', strtotime($curr_date)) == 0) {
	    continue;
	}
	$conn->query("SELECT VacationID FROM vacations_details WHERE PersonID = $PersonID AND '{$curr_date}' BETWEEN StartDate AND StopDate AND Aprove >= 0");
	if ($conn->fetch_array()) {
	    continue;
	}
	$end      = strtotime($curr_date . ' ' . $person['WorkStartHour'] . ':00') + $person['WorkNorm'] * 3600 + 
		    (!empty($person['LunchBreakEndHour']) && !empty($person['LunchBreakStartHour']) ? (strtotime($curr_date . ' ' . $person['LunchBreakEndHour'] . ':00') - strtotime($curr_date . ' ' . $person['LunchBreakStartHour'] . ':00')) : 0);
	$end_date = date('Y-m-d', $end);
	$end_hour = date('H:i', $end);
	if ($end_date != $curr_date) {
	    $hours  = round((strtotime($curr_date . ' 23:59:59') - strtotime($curr_date . ' ' . $person['WorkStartHour'] . ':00')) / 3600, 2);
	    $hours2 = $person['WorkNorm'] - $hours;
	} else {
	    $hours  = $person['WorkNorm'];
	    $hours2 = 0;
	}
	$conn->query("INSERT INTO pontaj_planif(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                      VALUES(1, $PersonID, '$curr_date', '{$person['WorkStartHour']}', '$end_date', '$end_hour', '$hours', '$hours2', '{$person['CostCenterID']}', 0, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }		  
}

echo "Pontaj planificat: $p_start_date: " . count($persons) . " inregistrari efectuate\n";

?>