<?php

set_time_limit(0);

if (!isset($_GET['recalc'])) {

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

}

$periodstart = (!empty($_GET['StartDate']) ? $conn->real_escape_string(Utils::toDBDate($_GET['StartDate'])) : 0);
$periodstop = (!empty($_GET['StopDate']) ? $conn->real_escape_string(Utils::toDBDate($_GET['StopDate'])) : date('Y-m-d'));

$counter = 0;
$persons = array();


$query = "SELECT a.PersonID, b.WorkNorm, b.WorkStartHour, b.LunchBreakStartHour, b.LunchBreakEndHour, b.StartDate, b.StopDate, c.CostCenterID
          FROM   persons a
                 INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.WorkNorm > 0 AND b.WorkStartHour > ''
		 LEFT JOIN payroll_costcenter c ON b.PersonID = c.PersonID WHERE 1=1 ";

if(!empty($periodstart)){
    $query .= " AND (b.StopDate IS NULL OR b.StopDate = '0000-00-00' OR b.StopDate >= '{$periodstart}')";
}

if(!empty($periodstop)){
    $query .= " AND (b.StartDate <= '{$periodstop}')";
}

$conn->query($query);
while($row = $conn->fetch_array()){
    $row['StopDate'] = (!empty($row['StopDate']) && $row["StopDate"] != '0000-00-00' ? date('Y-m-d', strtotime($row['StopDate'])) : date('Y-m-d'));
    $persons[$row['PersonID']] = $row;
}

foreach ($persons as $PersonID => $person) {
    $vacations = array();
    $query = "SELECT StartDate, StopDate, DaysNo FROM vacations_details WHERE PersonID = {$PersonID} AND Aprove = 1 AND Type != 'INV'";
    
    if(!empty($periodstart)){
        $query .= " AND StopDate >= '{$periodstart}'";
    }
    if(!empty($periodstop)){
        $query .= " AND StartDate <= '{$periodstop}'";
    }
    $conn->query($query);
    
    while($row = $conn->fetch_array()){
        $StartDate = date('Y-m-d', strtotime($row['StartDate']));
        if(!empty($periodstart) && date('Y-m-d', strtotime($periodstart)) > $StartDate){
            $StartDate = date('Y-m-d', strtotime($periodstart));
        }
        $EndDate = date('Y-m-d', strtotime($row['StopDate']));
        if(!empty($periodstop) && date('Y-m-d', strtotime($periodstop)) < $EndDate){
            $EndDate = date('Y-m-d', strtotime($periodstop));
        }
        if(!in_array($StartDate, $vacations)){
            $vacations[] = $StartDate;
        }
        
        $day = $StartDate;
        while($day <= $EndDate){
            if(!in_array($day, $vacations) && !in_array(date('w', strtotime($day)), array(0,6))){
                $vacations[] = $day;
            }
            $day = date('Y-m-d', strtotime("+1 day", strtotime($day)));
        }
           
    }
    
    $wdays = array();
    
    $query = "SELECT StartDate FROM pontaj_detail WHERE PersonID = {$PersonID}";
    
    if(!empty($periodstart)){
        $query .= " AND StartDate >= '{$periodstart}'";
    }
    
    if(!empty($periodstop)){
        $query .= " AND EndDate <= '{$periodstop}'";
    }
    
    
    $conn->query($query);
    
    while($row = $conn->fetch_array()){
        if(!in_array($row['StartDate'], $wdays)){
            $wdays[] = $row['StartDate'];
        }
    }
    
    $xvacations = array_intersect($wdays, $vacations);

    
    if(!empty($xvacations)){
        foreach($xvacations as $vday){
            $conn->query("DELETE FROM pontaj_detail WHERE PersonID = {$PersonID} AND StartDate = '{$vday}'");
            $counter++;
        }
    }

    $accounted_days = array_unique(array_merge($vacations, $wdays));
    
    if(!empty($periodstart) && strtotime($periodstart) > strtotime($person['StartDate'])){
        $day = date('Y-m-d', strtotime($periodstart));
    }
    else{
        $day = date('Y-m-d', strtotime($person['StartDate']));
    }
    
    while($day <= date('Y-m-d', strtotime($person['StopDate'])) && $day <= date('Y-m-d', strtotime($periodstop)) && $day < date('Y-m-d')){
        
        if(!in_array($day, $accounted_days)){
            if (date('w', strtotime($day)) != 6 && date('w', strtotime($day)) != 0 && !isset(ConfigData::$msLegal[$day])) {
                $end      = strtotime($day . ' ' . $person['WorkStartHour'] . ':00') + $person['WorkNorm'] * 3600 + 
                    (!empty($person['LunchBreakEndHour']) && !empty($person['LunchBreakStartHour']) ? (strtotime($day . ' ' . $person['LunchBreakEndHour'] . ':00') - strtotime($day . ' ' . $person['LunchBreakStartHour'] . ':00')) : 0);
                $end_date = date('Y-m-d', $end);
                $end_hour = date('H:i', $end);

                if ($end_date != $day) {
                    $hours  = round((strtotime($day . ' 23:59:59') - strtotime($day . ' ' . $person['WorkStartHour'] . ':00')) / 3600, 2);
                    $hours2 = $person['WorkNorm'] - $hours;
                } else {
                    $hours  = $person['WorkNorm'];
                    $hours2 = 0;
                }

                $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                      VALUES(1, $PersonID, '$day', '{$person['WorkStartHour']}', '$end_date', '$end_hour', '$hours', '$hours2', '{$person['CostCenterID']}', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");

                

                $counter++;
            }
        }
        
        $day = date('Y-m-d', strtotime("+1 day", strtotime($day)));
    }
    
}



?>
