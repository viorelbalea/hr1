<?php

set_time_limit(0);

if (!isset($_GET['recalc'])) {

function __autoload($className) {
    include('../libs/' . $className . '.php');
}
include('../libs/DB.class.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

}

$persons = array();
$query = "SELECT a.PersonID, a.WorkTime, a.WorkTimeAt, b.StartDate, b.StopDate, b.ContractExpDate, b.CompanyID,  b.ContractType, b.SuspendDate, b.ReturnDate
          FROM   persons a
	         INNER JOIN payroll b ON a.PersonID = b.PersonID
          WHERE  a.Status > 0
	  ORDER  BY a.PersonID";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $persons[$row['PersonID']] = $row;
}

$seniority = array();
$query = "SELECT * FROM vacations_seniority ORDER BY company_id, max_seniority";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $seniority[$row['company_id']][$row['max_seniority']] = $row;
}

$conn->query("SELECT company_settings FROM settings");
$company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

foreach ($persons as $PersonID => $person) {

    $days   = 0;
    $months = 0;
    $years  = 0;
    if(!empty($company_settings[$person['CompanyID']]['vacation']['accepted_seniority']) && $company_settings[$person['CompanyID']]['vacation']['accepted_seniority'] == 2){
        $worktimetest = (int)trim(str_replace('/', '', $person['WorkTime']));
        // Add if in Profesionale
	if (!empty($worktimetest)) {
            $arr    = explode('/', $person['WorkTime']);
            $days   = $arr[2];
            $months = $arr[1];
            $years  = $arr[0];
        } else { // Add if in CIM History
            $conn->query("SELECT DataIni AS StartDate, DataFin AS EndDate FROM persons_cm WHERE PersonID = $PersonID");
            while ($row = $conn->fetch_array()) {
                $arr     = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);
                $days   += $arr[2];
                $months += $arr[1];
                $years  += $arr[0];
            }
        }
    }

    
	// Compute days if ContractType is 'Suspendat' in the current Year
    if ($person['ContractType']==3 && substr($person['SuspendDate'], 0, 4) <= $_GET['year']) {
		$persons[$PersonID]['days_suspended']     = Utils::getDaysDiff($person['SuspendDate']<$_GET['year']?$start_year:$person['SuspendDate'], strtotime($person['ReturnDate'])?$person['ReturnDate']:$end_year,false,false);
    }
    
    if ($person['StartDate'] > '0000-00-00') {
    	if($person['StopDate'] > '0000-00-00'){
    		if($_GET['year'] < date('Y', strtotime($person['StopDate'])))
    			$contractEndDate = $end_year;
    		elseif($_GET['year']>=date('Y', strtotime($person['StopDate'])))
	    		$contractEndDate = $person['StopDate'];
	    }
	    else{
	    	$contractEndDate = $end_year;
	    }
	$arr     = Utils::dateDiff2YMD($person['StartDate'], $contractEndDate);
	$days   += $arr[2];
	$months += $arr[1];
	$years  += $arr[0];
    }
    $cmonths             	  = floor($days / 30);
    $persons[$PersonID]['days']   = $days % 30;
    $months            		  = $cmonths + $months;
    $persons[$PersonID]['months'] = $months % 12;
    $persons[$PersonID]['years']  = $years + floor($months / 12);

    foreach ((array)$seniority[$person['CompanyID']] as $max_seniority => $v) {
	if ($persons[$PersonID]['years'] < $max_seniority) {
	    $persons[$PersonID]['TotalCORef']   = $v['days'];
	    $persons[$PersonID]['max_rep_days'] = $v['max_rep_days'];
                        
	    $persons[$PersonID]['rep_date_limit'] = date('Y-m-d', strtotime(date('Y')."-{$v['rep_month_limit']}-{$v['rep_day_limit']}"));
	    $persons[$PersonID]['rep_date_limit_past'] = date('Y-m-d', strtotime(date('Y') - 1 ."-{$v['rep_month_limit']}-{$v['rep_day_limit']}"));
	    break;
	}
    }
    //Compute effective days 
    if ((substr($person['StartDate'], 0, 4) == date('Y'))) {
    	if ($person['ContractExpDate'] > '0000-00-00' && date('Y', strtotime($person['ContractExpDate'])) == date('Y')) {
	    $persons[$PersonID]['TotalCO']  = ($persons[$PersonID]['TotalCORef'] / 12) * ((12 - (int)substr($person['StartDate'], 5, 2))-(12 - (int)substr($person['ContractExpDate'], 5, 2))) + ($persons[$PersonID]['TotalCORef'] / (12*30))*((date('d', strtotime($person['ContractExpDate']))) - (date('d', strtotime($person['StartDate']))) + 1);
	} elseif ($person['StopDate'] > '0000-00-00' && date('Y', strtotime($person['StopDate'])) == date('Y')) {
	    $persons[$PersonID]['TotalCO']  = ($persons[$PersonID]['TotalCORef'] / 12) * ((12 - (int)substr($person['StartDate'], 5, 2))-(12 - (int)substr($person['StopDate'], 5, 2))) + ($persons[$PersonID]['TotalCORef'] / (12*30))*((date('d', strtotime($person['StopDate']))) - (date('d', strtotime($person['StartDate']))) + 1);
	} else {            
	    $persons[$PersonID]['TotalCO']  = ($persons[$PersonID]['TotalCORef'] / 12) * (12 - (int)substr($person['StartDate'], 5, 2)) + ($persons[$PersonID]['TotalCORef'] / (12*30))*((date('t', strtotime($person['StartDate']))) - (date('d', strtotime($person['StartDate']))) + 1);
	}    
    } else {
    	if ($person['ContractExpDate'] > '0000-00-00' && date('Y', strtotime($person['ContractExpDate'])) == date('Y')) {
    	    $persons[$PersonID]['TotalCO-'] = round(($persons[$PersonID]['TotalCORef'] / 12) * (12-((int)substr($person['ContractExpDate'], 5, 2))) + ($persons[$PersonID]['TotalCORef'] / (12*30))*((date('t', strtotime($person['ContractExpDate']))) - (date('d', strtotime($person['ContractExpDate']))) + 1));
	    $persons[$PersonID]['TotalCO']  = $persons[$PersonID]['TotalCORef'] - $persons[$PersonID]['TotalCO-'];
	} elseif ($person['StopDate'] > '0000-00-00' && date('Y', strtotime($person['StopDate'])) == date('Y')) {
	    $persons[$PersonID]['TotalCO-'] = round(($persons[$PersonID]['TotalCORef'] / 12) * (12-((int)substr($person['StopDate'], 5, 2))) + ($persons[$PersonID]['TotalCORef'] / (12*30))*((date('t', strtotime($person['StopDate']))) - (date('d', strtotime($person['StopDate']))) + 1));
	    $persons[$PersonID]['TotalCO']  = $persons[$PersonID]['TotalCORef'] - $persons[$PersonID]['TotalCO-'];
    	} else {
	    $persons[$PersonID]['TotalCO']  = $persons[$PersonID]['TotalCORef'];
	}    
    }
    
    // Substract days if ContractType is 'Suspendat' in the selected Year
    $persons[$PersonID]['TotalCO'] = $persons[$PersonID]['TotalCO'] - floor($persons[$PersonID]['days_suspended']*$persons[$PersonID]['TotalCORef']/365);
    

    $conn->query("SELECT TotalCO, Invoire, TotalCORef, 
			 (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Year = '" . (date('Y') - 1) . "' AND Type = 'CO' AND Aprove >= 0) AS EffCO
                  FROM   vacations a
				WHERE  PersonID = $PersonID AND Year = '" . (date('Y') - 1) . "'");
	$LeftCO		=	0;
	$LeftCOINV	=	0;
	$bDaysLost	=	0;
	if ($row = $conn->fetch_array()) {
		$bDaysLost		=	($row['TotalCO'] - $row['TotalCORef'] > 0) ? 1 : 0;
		$LeftCO			=	$row['TotalCO'] - $row['TotalCORef'];
		$LeftCOINV		=	$row['TotalCO'] - $row['Invoire'] - $row['EffCO'];
	}
	
	if ($bDaysLost == 1 && $LeftCOINV > 0){
		$PastCO	=	0;
		$LostCO	=	0;	
		$query	=	"SELECT StartDate, StopDate, DaysNo 
					FROM vacations_details 
					WHERE PersonID = $PersonID AND Year = '" . (date('Y') - 1) . "' AND Type = 'CO' AND Aprove >= 0
						AND StartDate <= '{$persons[$PersonID]['rep_date_limit_past']}' ";
		$conn->query($query);
		while ($row = $conn->fetch_array()) {
			if (Utils::getDaysDiff($persons[$PersonID]['rep_date_limit_past'], $row['StopDate'], true, true) > 0){
				$PastCO	+= Utils::getDaysDiff($row['StartDate'], $persons[$PersonID]['rep_date_limit_past'], true, true);
			}else{
				$PastCO	+= (int)$row['DaysNo'];
			}
		}

		$LostCO = ($LeftCO - $PastCO > 0) ? $LeftCO - $PastCO : 0 ;
		$LeftCOINV =	($LeftCOINV - $LostCO > 0) ? $LeftCOINV - $LostCO : 0;
	}
	
	$persons[$PersonID]['TotalCO']+= $LeftCOINV >= $persons[$PersonID]['max_rep_days'] ? $persons[$PersonID]['max_rep_days'] : $LeftCOINV;
    
    $conn->query("SELECT VacationID, Closed, VacRecalc FROM vacations WHERE PersonID = $PersonID AND Year = '" . date('Y') . "'");
    if ($row = $conn->fetch_array()) {
		if ($row['Closed'] == 0 && $row['VacRecalc'] == 1) {
			$conn->query("UPDATE vacations SET TotalCO = '{$persons[$PersonID]['TotalCO']}', TotalCORef = '{$persons[$PersonID]['TotalCORef']}', ReportDateLimit = '{$persons[$PersonID]['rep_date_limit']}'  WHERE VacationID = '{$row['VacationID']}' AND PersonID = $PersonID");
		}
    } else {
		$conn->query("INSERT INTO vacations(UserID, PersonID, Year, TotalCO, TotalCORef, CreateDate, ReportDateLimit) VALUES(1, $PersonID, '" . date('Y') . "', '{$persons[$PersonID]['TotalCO']}', '{$persons[$PersonID]['TotalCORef']}', CURRENT_TIMESTAMP, '{$persons[$PersonID]['rep_date_limit']}')");
    }
}

?>