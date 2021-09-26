<?php

set_time_limit(0);
$LstInvoiri = array();

$query = "SELECT * 
			FROM vacations_details
			WHERE type = 'INV' ";

$conn->query($query);
while ($row = $conn->fetch_array()) {
    $LstInvoiri[] = $row;
}

foreach ($LstInvoiri as $row) {
    $VacationID = $row['VacationID'];
    $PersonID = $row['PersonID'];
    $StartDate = $row['StartDate'];
    $StopDate = $row['StopDate'];
    $StartHour = $row['StartHour'];
    $StopHour = $row['StopHour'];

    $conn->query("SELECT LunchBreakStartHour, LunchBreakEndHour FROM payroll WHERE PersonID = '{$PersonID}'");
    $row = $conn->fetch_array();
    $start = strtotime($StartDate . " " . $StartHour);
    $end = strtotime($StartDate . " " . $StopHour);
    $lunchstart = strtotime($StartDate . " " . $row['LunchBreakStartHour']);
    $lunchend = strtotime($StartDate . " " . $row['LunchBreakEndHour']);
    $time = $end - $start;
    $rm = false;
    $pin1 = $pin2 = 0;
    if ($lunchstart > $start && $lunchstart < $end) {
        $pin1 = $lunchstart;
        $rm = true;
    } elseif ($lunchstart < $end) {
        $pin1 = $start;
    }
    if ($lunchend > $start && $lunchend < $end) {
        $pin2 = $lunchend;
        $rm = true;
    } elseif ($lunchend > $start) {
        $pin2 = $end;
    }
    if ($rm && !empty($pin1) && !empty($pin2)) {
        $time -= $pin2 - $pin1;
    }
    $time = round($time / 3600, 2);

    $conn->query("UPDATE vacations_details SET HoursNo = '{$time}' WHERE VacationID = '{$VacationID}' AND PersonID = '{$PersonID}'");
}

$persons = array();
$query = "SELECT a.PersonID
          FROM   persons a
          WHERE  a.Status > 0
	  ORDER  BY a.PersonID";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $persons[$row['PersonID']] = $row;
}

foreach ($persons as $PersonID => $person) {
    $conn->query("SELECT SUM(a.HoursNo) AS HoursNo, b.WorkNorm, a.Year FROM vacations_details a LEFT JOIN payroll b ON b.PersonID = a.PersonID WHERE a.PersonID = '{$PersonID}' AND a.Type = 'INV' AND a.Aprove != -1 GROUP BY a.Year");
    while ($row = $conn->fetch_array()) {
        $invdays = floor($row['HoursNo'] / $row['WorkNorm']);
        $year = $row['Year'];
        $persons[$PersonID][$year] = $invdays;
    }

    foreach ($persons[$PersonID] as $year => $invdays) {
        $conn->query("UPDATE vacations SET Invoire = '{$invdays}' WHERE PersonID = '{$PersonID}' AND Year = '{$year}'");
    }
}

?>