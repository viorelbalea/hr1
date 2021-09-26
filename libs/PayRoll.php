<?php

class PayRoll extends ConfigData
{

    public static function setPayRoll()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $info = $_POST;

        foreach ($info as &$v) {
            if (!is_numeric($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);

        if (!$info['StartDate']) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }

        /*if (strcmp($info['WorkNorm'], (int)$info['WorkNorm']) || $info['WorkNorm'] < 0 || $info['WorkNorm'] > 24) {
            throw new Exception('Norma de lucru trebuie sa fie numeric intre 0 si 24');
        }

        if ($info['LunchBreakEndHour'] <= $info['LunchBreakStartHour']) {
            throw new Exception('Intervalul orar de pauza trebuie sa fie valid');
        }*/

        $conn->query("SELECT BankID, BankNotes
                      FROM   banks
                      WHERE  LOWER(BankName) = '" . strtolower($info['BankName']) . "' AND
                             LOWER(BankLocation) = '" . strtolower($info['BankLocation']) . "' AND
                             LOWER(BankAccount) = '" . strtolower($info['BankAccount']) . "'");
        if ($row = $conn->fetch_array()) {
            $info['BankID'] = $row['BankID'];
            /*
            if ($row['BankNotes'] != $info['BankNotes']) {
                $conn->query("UPDATE banks SET BankNotes = '{$info['BankNotes']}' WHERE BankID = $BankID");
            }
            */
        } else {
            $conn->query("INSERT INTO banks(UserID, BankName, BankLocation, BankAccount, BankNotes)
                          VALUES({$_SESSION['USER_ID']}, '{$info['BankName']}', '{$info['BankLocation']}', '{$info['BankAccount']}', '{$info['BankNotes']}')");
            $info['BankID'] = $conn->get_insert_id();
        }
        unset($info['DivisionID'], $info['BankName'], $info['BankLocation'], $info['BankAccount']);

        $info[StartDate] = !empty($info[StartDate]) ? Utils::toDBDate($info[StartDate]) : '0000-00-00';
        $info[StopDate] = !empty($info[StopDate]) ? Utils::toDBDate($info[StopDate]) : '0000-00-00';
        $info[ContractDate] = !empty($info[ContractDate]) ? Utils::toDBDate($info[ContractDate]) : '0000-00-00';
        $info[ContractExpDate] = (!empty($info[ContractExpDate]) && $info[ContractType] != 2) ? Utils::toDBDate($info[ContractExpDate]) : '0000-00-00';
        $info[SuspendDate] = !empty($info[SuspendDate]) ? Utils::toDBDate($info[SuspendDate]) : '0000-00-00';
        $info[ProbaStartDate] = !empty($info[ProbaStartDate]) ? Utils::toDBDate($info[ProbaStartDate]) : '0000-00-00';
        $info[ProbaStopDate] = !empty($info[ProbaStopDate]) ? Utils::toDBDate($info[ProbaStopDate]) : '0000-00-00';
        $info[EstimateReturnDate] = !empty($info[EstimateReturnDate]) ? Utils::toDBDate($info[EstimateReturnDate]) : '0000-00-00';
        $info[ReturnDate] = !empty($info[ReturnDate]) ? Utils::toDBDate($info[ReturnDate]) : '0000-00-00';
        $info[LeaveReason] = (int)$info[LeaveReason];
        $info['ContractDismissalPeriod'] = (int)$info['ContractDismissalPeriod'];
        $info['ContractProbationPeriod'] = (int)$info['ContractProbationPeriod'];


        $conn->query("SELECT StartDate, StopDate, LeaveReason, ContractType, ContractNo, ContractDate, ContractExpDate, ContractDismissalPeriod ,WorkNorm, SuspendDate, EstimateReturnDate, ReturnDate
	              FROM   payroll 
		      WHERE  PersonID = $PersonID");
        if ($row = $conn->fetch_array()) {
            $history = false;
            foreach ($row as $k => $v) {
                if ($v != $info[$k]) {
                    $history = true;
                }
            }
            if ($history) {
                $query = "INSERT INTO persons_contracts(UserID, PersonID, Status, SubStatus, StartDate, StopDate, LeaveReason, ContractType, 
	                                                ContractNo, ContractDate, ContractExpDate, ContractDismissalPeriod, ContractProbationPeriod, WorkNorm, SuspendDate, EstimateReturnDate, ReturnDate, CreateDate)
	                  SELECT {$_SESSION['USER_ID']}, a.PersonID, b.Status, b.SubStatus, a.StartDate, a.StopDate, a.LeaveReason, a.ContractType, 
	                         a.ContractNo, a.ContractDate, a.ContractExpDate, a.ContractDismissalPeriod, ContractProbationPeriod, a.WorkNorm, a.SuspendDate, a.EstimateReturnDate, a.ReturnDate, CURRENT_TIMESTAMP
		          FROM   payroll a
		                 INNER JOIN persons b ON a.PersonID = b.PersonID
		          WHERE  a.PersonID = $PersonID";
                $conn->query($query);
            }
        }

        $conn->query("SELECT Status FROM persons WHERE PersonID = '{$PersonID}'");
        if ($row = $conn->fetch_array()) {
            $person_info = $row;
        }

        $update = '';
        unset($v);

        if (in_array($info['ContractType'], array(2, 3))) {
            $info['ContractExpDate'] = '';
        }
        if (!in_array($person_info['Status'], array(5, 6))) {
            $info['StopDate'] = '0000-00-00';
        }
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE payroll a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO payroll(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                          VALUES({$_SESSION['USER_ID']}, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }

        //Log the action
        $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
	              VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 4, 'Actualizare date contract; Data angajarii:{$info['StartDate']}; Data plecarii:{$info['StopDate']}; Data contract:{$info['ContractDate']}; Data expirare contract:{$info['ContractExpDate']}; Numar contract:{$info['ContractNo']}; Tip contract; " . self::$msContractType[$info['ContractType']] . "; Norma de lucru:{$info['WorkNorm']}; Perioada preaviz concediere:{$info['ContractDismissalPeriod']}; Perioada proba:{$info['ContractProbationPeriod']}; ', CURRENT_TIMESTAMP)");
    }

    public static function getPayRoll()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][6]}' > 0 AND
	                     (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	                     '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		             OR 
		             {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng))
	                     OR
	                     '{$_SESSION['USER_RIGHTS3'][1][1][6]}' = 2
		             OR 
		             {$_SESSION['USER_ID']} = 1";

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT a.*, b.*, c.DivisionID, p.Status, p.SubStatus, p.FullName, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
		              FROM   persons p
			             LEFT JOIN payroll a ON p.PersonID = a.PersonID
		                     LEFT JOIN banks b ON a.BankID = b.BankID
		                     LEFT JOIN departments c ON a.DepartmentID = c.DepartmentID
		              WHERE  p.PersonID = $PersonID AND ($condbase)");

        if ($info = $conn->fetch_array()) {
            return $info;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getPayrollContracts()
    {
        global $conn;

        $contracts = array();
        $conn->query("SELECT * FROM persons a
				  INNER JOIN persons_contracts pc ON a.PersonID=pc.PersonID
				  INNER JOIN payroll b ON a.PersonID=b.PersonID
	    		  INNER JOIN companies c ON b.CompanyID=c.CompanyID
				  ORDER BY ContractID");
        while ($row = $conn->fetch_array()) {
            $contracts[] = $row;
        }
        return $contracts;
    }

    public static function getContractsHistory()
    {
        global $conn;
        $PersonID = (int)$_GET['PersonID'];
        $contracts = array();
        $conn->query("SELECT a.*, b.UserName
	              FROM   persons_contracts a
		             INNER JOIN users b ON a.UserID = b.UserID
		      WHERE  a.PersonID = $PersonID 
		      ORDER  BY a.ContractID");
        while ($row = $conn->fetch_array()) {
            $contracts[] = $row;
        }
        return $contracts;
    }

    public static function getPayRollSalary()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][7]}' > 0 AND
	                     (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	                     '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		             OR 
		             {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng))
	                     OR
	                     '{$_SESSION['USER_RIGHTS3'][1][1][7]}' = 2
		             OR 
		             {$_SESSION['USER_ID']} = 1";

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT p.FullName, p.Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
		              FROM   persons p
			             LEFT JOIN payroll a ON p.PersonID = a.PersonID
		              WHERE  p.PersonID = $PersonID AND ($condbase)");

        if ($info = $conn->fetch_array()) {
            return $info;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getIncadrare()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][4]}' > 0 AND
	                     (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	                     '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		             OR 
		             {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (p.UserID = {$_SESSION['USER_ID']} OR p.PersonID = '{$_SESSION['PERS']}' $condmng))
	                     OR
	                     '{$_SESSION['USER_RIGHTS3'][1][1][4]}' = 2
		             OR 
		             {$_SESSION['USER_ID']} = 1";

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT a.*, p.Status, p.SubStatus, p.FullName, p.ManagerID, p.ManagerID2, p.ManagerID3, p.ManagerID4, p.ManagerID5, p.Trainer, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
		              FROM   persons p
			             LEFT JOIN payroll a ON p.PersonID = a.PersonID
		                     LEFT JOIN departments c ON a.DepartmentID = c.DepartmentID
		              WHERE  p.PersonID = $PersonID AND ($condbase)");

        if ($info = $conn->fetch_array()) {
            if (!empty($info['JDFile']) && is_file('uploads/jd/' . $info['JDFile']))
                $info['JDFilePath'] = 'uploads/jd/' . $info['JDFile'];
            return $info;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function setIncadrare()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $info = $_POST;
        $FunctionIDOld = $info['FunctionIDOld'];
        unset($info['FunctionIDOld']);
        $InternalFunctionOld = $info['InternalFunctionOld'];
        unset($info['InternalFunctionOld']);
        $ManagerIDOld = $info['ManagerIDOld'];
        unset($info['ManagerIDOld']);
        $ManagerIDOld2 = $info['ManagerIDOld2'];
        unset($info['ManagerIDOld2']);
        $ManagerIDOld3 = $info['ManagerIDOld3'];
        unset($info['ManagerIDOld3']);
        $ManagerIDOld4 = $info['ManagerIDOld4'];
        unset($info['ManagerIDOld4']);
        $ManagerIDOld5 = $info['ManagerIDOld5'];
        unset($info['ManagerIDOld5']);

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	                 OR
	                 '{$_SESSION['USER_RIGHTS3'][1][1][4]}' = 2
		         OR 
		         {$_SESSION['USER_ID']} = 1";

        if ($ManagerIDOld != $info['ManagerID']) {
            $query = "UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET ManagerID = '{$info['ManagerID']}', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)";
            $conn->query($query);
        }
        if ($ManagerIDOld2 != $info['ManagerID2']) {
            $query = "UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET ManagerID2 = '{$info['ManagerID2']}', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)";
            $conn->query($query);
        }
        if ($ManagerIDOld3 != $info['ManagerID3']) {
            $query = "UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET ManagerID3 = '{$info['ManagerID3']}', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)";
            $conn->query($query);
        }
        if ($ManagerIDOld4 != $info['ManagerID4']) {
            $query = "UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET ManagerID4 = '{$info['ManagerID4']}', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)";
            $conn->query($query);
        }
        if ($ManagerIDOld5 != $info['ManagerID5']) {
            $query = "UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET ManagerID5 = '{$info['ManagerID5']}', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)";
            $conn->query($query);
        }
        unset($info['ManagerID']);
        unset($info['ManagerID2']);
        unset($info['ManagerID3']);
        unset($info['ManagerID4']);
        unset($info['ManagerID5']);

        $conn->query("UPDATE persons p INNER JOIN payroll a ON a.PersonID=p.PersonID SET Trainer = '" . (int)$info['Trainer'] . "', p.LastUpdateDate = CURRENT_TIMESTAMP WHERE p.PersonID = $PersonID AND ($condrw)");
        unset($info['Trainer']);

        foreach ($info as &$v) {
            if (!is_numeric($v)) {
                $v = Utils::formatStr($v);
            }
        }

        $update = '';
        unset($v);
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $conn->query("UPDATE payroll a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");
        if (!$conn->get_affected_rows()) {
            $conn->query("INSERT INTO payroll(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                              VALUES({$_SESSION['USER_ID']}, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
        //if ($FunctionIDOld != $info['FunctionID']) {

        $conn->query("INSERT INTO persons_functions(UserID, PersonID, FunctionID, StartDate, CreateDate, LastUpdateDate)
                              VALUES({$_SESSION['USER_ID']}, $PersonID, '{$info['FunctionID']}', CURRENT_DATE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        // Update the previos function with EndDate
        $conn->query("SELECT FID FROM persons_functions WHERE PersonID='$PersonID' ORDER BY FID DESC LIMIT 1,1");
        $rowf = $conn->fetch_array();
        if (!empty($rowf['FID']))
            $conn->query("UPDATE persons_functions SET EndDate=CURRENT_DATE WHERE PersonID='$PersonID' AND FID='{$rowf['FID']}'");

        //Log the action
        $Function = self::getFunctionByID($FunctionIDOld);
        $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
                          VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 2, 'Adaugare functie; Nume:{$Function['Function']}; Cod COR:{$Function['COR']}; ', CURRENT_TIMESTAMP)");
        //}
        //if ($InternalFunctionOld != $info['InternalFunction']) {

        $conn->query("INSERT INTO persons_internal_functions(UserID, PersonID, FunctionID, StartDate, CreateDate, LastUpdateDate)
                      VALUES({$_SESSION['USER_ID']}, $PersonID, '{$info['InternalFunction']}', CURRENT_DATE, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        // Update the previos function with EndDate
        $conn->query("SELECT FID FROM persons_internal_functions WHERE PersonID='$PersonID' ORDER BY FID DESC LIMIT 1,1");
        $rowif = $conn->fetch_array();
        if (!empty($rowif['FID']))
            $conn->query("UPDATE persons_internal_functions SET EndDate=CURRENT_DATE WHERE PersonID='$PersonID' AND FID='{$rowif['FID']}'");

        //Log the action
        $Function = self::getInternalFunctionByID($InternalFunctionOld);
        $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
                          VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 3, 'Adaugare functie interna; Nume:{$Function['Function']}; ', CURRENT_TIMESTAMP)");
        //}
    }

    public static function getFunctionByID($FunctionID)
    {

        global $conn;
        $conn->query("SELECT * FROM functions WHERE FunctionID = $FunctionID");
        $row = $conn->fetch_array();
        return $row;
    }

    public static function getInternalFunctionByID($FunctionID)
    {

        global $conn;
        $conn->query("SELECT * FROM internal_functions WHERE FunctionID = $FunctionID");
        $row = $conn->fetch_array();
        return $row;
    }

    public static function setSalary()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        switch ($_GET['action']) {

            case 'new_salary':
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $StopDate = Utils::toDBDate($_GET['StopDate']);
                $conn->query("INSERT INTO persons_salary(UserID, PersonID, Salary, SalaryNet, SalaryCost, Currency, StartDate, StopDate, CreateDate, LastUpdateDate)
		                  VALUES({$_SESSION['USER_ID']}, $PersonID, '$Salary', '$SalaryNet','$SalaryCost','$Currency', '$StartDate', '$StopDate', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                //Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 1, 'Adaugare salariu; Valoare neta:$SalaryNet; Valoare bruta:$Salary; Cost total:$SalaryCost; Data inceput:$StartDate; Data sfarsit:$StopDate;', CURRENT_TIMESTAMP)");
                break;

            case 'edit_salary':
                $SalaryID = (int)$_GET['SalaryID'];
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $StopDate = Utils::toDBDate($_GET['StopDate']);

                //Get existing data
                $SalaryOld = self::getSalaryByID($SalaryID);
                // Compare and log data
                $Comment = 'Modificare salariala: ';
                $log = false;
                if ($SalaryNet != $SalaryOld['SalaryNet']) {
                    $Comment .= "Valoare neta din {$SalaryOld['SalaryNet']} in $SalaryNet; ";
                    $log = true;
                }
                if ($Salary != $SalaryOld['Salary']) {
                    $Comment .= "Valoare bruta din {$SalaryOld['Salary']} in $Salary; ";
                    $log = true;
                }
                if ($SalaryCost != $SalaryOld['SalaryCost']) {
                    $Comment .= "Cost total din {$SalaryOld['SalaryCost']} in $SalaryCost; ";
                    $log = true;
                }
                if ($_GET['StartDate'] != $SalaryOld['StartDate']) {
                    $Comment .= "Data inceput din {$SalaryOld['StartDate']} in {$_GET['StartDate']}; ";
                    $log = true;
                }
                if ($_GET['StopDate'] != $SalaryOld['StopDate']) {
                    $Comment .= "Data sfarsit din {$SalaryOld['StopDate']} in {$_GET['StopDate']}; ";
                    $log = true;
                }
                // Insert log
                if ($log)
                    $conn->query("INSERT INTO persons_log SET
    					UserID={$_SESSION['USER_ID']},
    					PID='{$_SESSION['PERS']}',
    					PersonID=$PersonID,
    					Type=1,
    					Comment='$Comment',
    					CreateDate=	CURRENT_TIMESTAMP");

                $conn->query("UPDATE persons_salary SET
		                			    Salary         = '$Salary',
		                			    SalaryNet      = '$SalaryNet',
		                			    SalaryCost     = '$SalaryCost',
		                			    Currency  	   = '$Currency',
		                			    StartDate      = '$StartDate',
		                			    StopDate       = '$StopDate',
		                			    LastUpdateDate = CURRENT_TIMESTAMP
		                  WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;

            case 'del_salary':
                $SalaryID = (int)$_GET['SalaryID'];
                // Get existing data
                $SalaryOld = self::getSalaryByID($SalaryID);
                // Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', {$SalaryOld['PersonID']}, 1, 'Stergere salariu; Valoare neta:{$SalaryOld['SalaryNet']}; Valoare bruta:{$SalaryOld['Salary']}; Cost total:{$SalaryOld['SalaryCost']}; Data inceput:{$SalaryOld['StartDate']}; Data sfarsit:{$SalaryOld['StopDate']};', CURRENT_TIMESTAMP)");
                // Delete data
                $conn->query("DELETE FROM persons_salary WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;
        }
    }

    public static function getSalaryByID($SalaryID)
    {

        global $conn;

        $conn->query("SELECT * FROM persons_salary WHERE SalaryID = $SalaryID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        $row['StopDate'] = Utils::toDBDate($row['StopDate']);
        return $row;
    }

    public static function getSalary()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $salary = array();

        $conn->query("SELECT SalaryID, Salary, SalaryNet, SalaryCost, Currency, StartDate, StopDate FROM persons_salary WHERE PersonID = $PersonID ORDER BY StartDate");
        while ($row = $conn->fetch_array()) {
            $row['StartDate'] = Utils::toDisplayDate($row['StartDate']);
            $row['StopDate'] = Utils::toDisplayDate($row['StopDate']);
            $salary[] = $row;
        }

        return $salary;
    }

    public static function setSalaryPFA()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        switch ($_GET['action']) {

            case 'new_salaryPFA':
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $StopDate = Utils::toDBDate($_GET['StopDate']);
                $conn->query("INSERT INTO persons_salary_pfa(UserID, PersonID, Salary, SalaryNet, SalaryCost, Currency, StartDate, StopDate, CreateDate, LastUpdateDate)
		                  VALUES({$_SESSION['USER_ID']}, $PersonID, '$Salary', '$SalaryNet','$SalaryCost','$Currency', '$StartDate', '$StopDate', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                //Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 1, 'Adaugare contract PFA; Valoare neta:$SalaryNet; Valoare bruta:$Salary; Cost total:$SalaryCost; Data inceput:$StartDate; Data sfarsit:$StopDate;', CURRENT_TIMESTAMP)");
                break;

            case 'edit_salaryPFA':
                $SalaryID = (int)$_GET['SalaryID'];
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $StopDate = Utils::toDBDate($_GET['StopDate']);

                //Get existing data
                $SalaryOld = self::getSalaryPFAByID($SalaryID);
                // Compare and log data
                $Comment = 'Modificare contract PFA: ';
                $log = false;
                if ($SalaryNet != $SalaryOld['SalaryNet']) {
                    $Comment .= "Valoare neta din {$SalaryOld['SalaryNet']} in $SalaryNet; ";
                    $log = true;
                }
                if ($Salary != $SalaryOld['Salary']) {
                    $Comment .= "Valoare bruta din {$SalaryOld['Salary']} in $Salary; ";
                    $log = true;
                }
                if ($SalaryCost != $SalaryOld['SalaryCost']) {
                    $Comment .= "Cost total din {$SalaryOld['SalaryCost']} in $SalaryCost; ";
                    $log = true;
                }
                if ($_GET['StartDate'] != $SalaryOld['StartDate']) {
                    $Comment .= "Data inceput din {$SalaryOld['StartDate']} in {$_GET['StartDate']}; ";
                    $log = true;
                }
                if ($_GET['StopDate'] != $SalaryOld['StopDate']) {
                    $Comment .= "Data sfarsit din {$SalaryOld['StopDate']} in {$_GET['StopDate']}; ";
                    $log = true;
                }
                // Insert log
                if ($log)
                    $conn->query("INSERT INTO persons_log SET
    					UserID={$_SESSION['USER_ID']},
    					PID='{$_SESSION['PERS']}',
    					PersonID=$PersonID,
    					Type=1,
    					Comment='$Comment',
    					CreateDate=	CURRENT_TIMESTAMP");
                // Update data
                $conn->query("UPDATE persons_salary_pfa SET
		                			    Salary         = '$Salary',
		                			    SalaryNet      = '$SalaryNet',
		                			    SalaryCost     = '$SalaryCost',
		                			    Currency   	   = '$Currency',
		                			    StartDate      = '$StartDate',
		                			    StopDate       = '$StopDate',
		                			    LastUpdateDate = CURRENT_TIMESTAMP
		                  WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;

            case 'del_salaryPFA':
                $SalaryID = (int)$_GET['SalaryID'];
                // Get existing data
                $SalaryOld = self::getSalaryPFAByID($SalaryID);
                // Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', {$SalaryOld['PersonID']}, 1, 'Stergere contract PFA; Valoare neta:{$SalaryOld['SalaryNet']}; Valoare bruta:{$SalaryOld['Salary']}; Cost total:{$SalaryOld['SalaryCost']}; Data inceput:{$SalaryOld['StartDate']}; Data sfarsit:{$SalaryOld['StopDate']};', CURRENT_TIMESTAMP)");
                // Delete data
                $conn->query("DELETE FROM persons_salary_pfa WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;
        }
    }

    public static function getSalaryPFAByID($SalaryID)
    {

        global $conn;

        $conn->query("SELECT * FROM persons_salary_pfa WHERE SalaryID = $SalaryID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        $row['StopDate'] = Utils::toDBDate($row['StopDate']);
        return $row;
    }

    public static function setSalaryExtra()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        switch ($_GET['action']) {

            case 'new_salary_extra':
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $Type = $_GET['Type'];
                $Notes = Utils::formatStr($_GET['Notes']);
                $conn->query("INSERT INTO persons_salary_extra(UserID, PersonID, Salary, SalaryNet, SalaryCost, Currency, StartDate, Type, Notes, CreateDate, LastUpdateDate)
		                  VALUES({$_SESSION['USER_ID']}, $PersonID, '$Salary', '$SalaryNet', '$SalaryCost', '$Currency', '$StartDate', '$Type', '$Notes', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                //Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 1, 'Adaugare $Type; Valoare neta:$SalaryNet; Valoare bruta:$Salary; Data:$StartDate; Comentariu:$Notes', CURRENT_TIMESTAMP)");
                break;

            case 'edit_salary_extra':
                $SalaryID = (int)$_GET['SalaryID'];
                $Salary = (double)$_GET['Salary'];
                $SalaryNet = (double)$_GET['SalaryNet'];
                $SalaryCost = (double)$_GET['SalaryCost'];
                $Currency = $_GET['Currency'];
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $Type = $_GET['Type'];
                $Notes = Utils::formatStr($_GET['Notes']);
                //Get existing data
                $SalaryOld = self::getSalaryExtraByID($SalaryID);
                // Compare and log data
                $Comment = "Modificare $Type: ";
                $log = false;
                if ($SalaryNet != $SalaryOld['SalaryNet']) {
                    $Comment .= "Valoare neta din {$SalaryOld['SalaryNet']} in $SalaryNet; ";
                    $log = true;
                }
                if ($Salary != $SalaryOld['Salary']) {
                    $Comment .= "Valoare bruta din {$SalaryOld['Salary']} in $Salary; ";
                    $log = true;
                }
                if ($SalaryCost != $SalaryOld['SalaryCost']) {
                    $Comment .= "Cost total din {$SalaryOld['SalaryCost']} in $SalaryCost; ";
                    $log = true;
                }
                if ($_GET['StartDate'] != $SalaryOld['StartDate']) {
                    $Comment .= "Data din {$SalaryOld['StartDate']} in {$_GET['StartDate']}; ";
                    $log = true;
                }
                if ($_GET['Notes'] != $SalaryOld['Notes']) {
                    $Comment .= "Comentariu din {$SalaryOld['Notes']} in {$_GET['Notes']}; ";
                    $log = true;
                }
                // Insert log
                if ($log)
                    $conn->query("INSERT INTO persons_log SET
    					UserID={$_SESSION['USER_ID']},
    					PID='{$_SESSION['PERS']}',
    					PersonID=$PersonID,
    					Type=1,
    					Comment='$Comment',
    					CreateDate=	CURRENT_TIMESTAMP");
                // Update data
                $conn->query("UPDATE persons_salary_extra SET
		                			    Salary         = '$Salary',
		                			    SalaryNet      = '$SalaryNet',
		                			    SalaryCost      = '$SalaryCost',
		                			    Currency       = '$Currency',
		                			    StartDate      = '$StartDate',
		                			    Type       	   = '$Type',
							    Notes          = '$Notes',
		                			    LastUpdateDate = CURRENT_TIMESTAMP
		                  WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;

            case 'del_salary_extra':
                $SalaryID = (int)$_GET['SalaryID'];
                // Get existing data
                $SalaryOld = self::getSalaryExtraByID($SalaryID);
                // Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', {$SalaryOld['PersonID']}, 1, 'Stergere {$SalaryOld['Type']}; Valoare neta:{$SalaryOld['SalaryNet']}; Valoare bruta:{$SalaryOld['Salary']}; Data:{$SalaryOld['StartDate']}; Comentariu:{$SalaryOld['Notes']}', CURRENT_TIMESTAMP)");
                // Delete data
                $conn->query("DELETE FROM persons_salary_extra WHERE SalaryID = $SalaryID AND PersonID = $PersonID");
                break;
        }
    }

    public static function getSalaryExtraByID($SalaryID)
    {

        global $conn;

        $conn->query("SELECT * FROM persons_salary_extra WHERE SalaryID = $SalaryID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        return $row;
    }

    public static function getSalaryPFA()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $salary = array();

        $conn->query("SELECT SalaryID, Salary, SalaryNet, SalaryCost, Currency, StartDate, StopDate FROM persons_salary_pfa WHERE PersonID = $PersonID ORDER BY StartDate");
        while ($row = $conn->fetch_array()) {
            $row['StartDate'] = Utils::toDBDate($row['StartDate']);
            $row['StopDate'] = Utils::toDBDate($row['StopDate']);
            $salary[] = $row;
        }

        return $salary;
    }

    public static function getSalaryExtra($Type)
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        if ($Type == '')
            $Type = 'bonus';

        $salary = array();

        $conn->query("SELECT SalaryID, Salary, SalaryNet, SalaryCost, Currency, StartDate, Type, Notes FROM persons_salary_extra
	    				WHERE PersonID = $PersonID
	    				AND Type='$Type'
	    				ORDER BY StartDate");
        while ($row = $conn->fetch_array()) {
            $row['StartDate'] = Utils::toDBDate($row['StartDate']);
            $salary[] = $row;
        }

        return $salary;
    }

    public static function setDisplacement()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        switch ($_GET['action']) {

            case 'new_displacement':
                $CountryID = (int)$_GET['CountryID'];
                $ProjectID = (int)$_GET['ProjectID'];
                $CostCenterID = (int)$_GET['CostCenterID'];
                $Location = Utils::formatStr($_GET['Location']);
                $StartDate = Utils::toDBDateTime($_GET['StartDate']);
                $StopDate = Utils::toDBDateTime($_GET['StopDate']);
                $conn->query("INSERT INTO persons_displacement(UserID, PersonID, CountryID, Location, ProjectID, CostCenterID, StartDate, StopDate, CreateDate, LastUpdateDate)
		                  VALUES({$_SESSION['USER_ID']}, $PersonID, $CountryID, '$Location', $ProjectID, $CostCenterID, '$StartDate', '$StopDate', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                break;

            case 'edit_displacement':
                $DisplacementID = (int)$_GET['DisplacementID'];
                $CountryID = (int)$_GET['CountryID'];
                $ProjectID = (int)$_GET['ProjectID'];
                $CostCenterID = (int)$_GET['CostCenterID'];
                $Location = Utils::formatStr($_GET['Location']);
                $StartDate = Utils::toDBDateTime($_GET['StartDate']);
                $StopDate = Utils::toDBDateTime($_GET['StopDate']);
                $conn->query("UPDATE persons_displacement SET
							    CountryID	 	= $CountryID,
							    Location     	= '$Location',
		                			    ProjectID         	= $ProjectID,
		                			    CostCenterID     	= $CostCenterID,
		                			    StartDate      	= '$StartDate',
		                			    StopDate       	= '$StopDate',
		                			    LastUpdateDate 	= CURRENT_TIMESTAMP
		                  WHERE DisplacementID = $DisplacementID AND PersonID = $PersonID");
                break;

            case 'del_displacement':
                $DisplacementID = (int)$_GET['DisplacementID'];
                // Delete data
                $conn->query("DELETE FROM persons_displacement WHERE DisplacementID = $DisplacementID AND PersonID = $PersonID");
                break;
        }
    }

    public static function getDisplacements()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][23]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT FullName, Status FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $res = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT *, YEAR(StartDate) AS Year FROM persons_displacement a WHERE a.PersonID = $PersonID ORDER BY StartDate");
        while ($row = $conn->fetch_array()) {
            $row['StartDate'] = Utils::toDBDateTime($row['StartDate']);
            $row['StopDate'] = Utils::toDBDateTime($row['StopDate']);
            $diff = strtotime($row['StopDate']) - strtotime($row['StartDate']);
            $days = floor($diff / (24 * 3600));
            $row['Sum'] = $days . 'd ' . round(($diff - $days * 24 * 3600) / 3600) . 'h';
            $res[$row['Year']][] = $row;
        }
        return $res;
    }

    public static function getDisplacementDays($PersonID, $StartDate = 0, $EndDate = 0)
    {
        global $conn;

        $query = "SELECT StartDate, StopDate FROM persons_displacement a WHERE a.PersonID = $PersonID ";

        if (!empty($StartDate)) {
            $query .= " AND '" . date('Y-m-d H:i:s', strtotime($StartDate)) . "' <= a.StopDate";
        }
        if (!empty($EndDate)) {
            $query .= " AND '" . date('Y-m-d H:i:s', strtotime($EndDate)) . "' >= a.StartDate";
        }

        $query .= " ORDER BY StartDate";
        $conn->query($query);
        $days = array();
        while ($row = $conn->fetch_array()) {
            $days = array_unique(array_merge($days, Utils::getDaysList($row['StartDate'], $row['StopDate'], false, false)));
        }
        return $days;
    }

## Function COR

    public static function getDisplacementCost($PersonID, $DisplacementID)
    {

        global $conn, $smarty;

        $costs = array();

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][23]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		      '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	           OR
	           '{$_SESSION['USER_RIGHTS3'][1][1][23]}' = 2
		   OR
		   {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, c.CostTotal, c.CostD, c.CostN, c.Currency,
			     CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
			     INNER JOIN persons_displacement c ON a.PersonID = c.PersonID AND c.DisplacementID = $DisplacementID
	              WHERE  a.PersonID = '{$PersonID}' AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $costs[0] = $row;
        } else {
            $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo smarty_function_translate($params, $smarty) . '!';
            exit;
        }

        $conn->query("SELECT * FROM persons_displacement_cost WHERE PersonID = '{$PersonID}' AND DisplacementID = '{$DisplacementID}' ORDER BY CostDate");
        while ($row = $conn->fetch_array()) {
            $costs[$row['ID']] = $row;
        }

        return $costs;
    }

    public static function setDisplacementCost($PersonID, $DisplacementID)
    {

        global $conn, $smarty, $err;

        $ID = (int)$_GET['ID'];

        switch ($_GET['action']) {

            case 'new':
            case 'edit':
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                if ($ID > 0) {
                    $conn->query("UPDATE persons_displacement_cost SET
							    CostSubtype 	= '{$_GET['CostSubtype']}',
							    Cost 	 	= '{$_GET['Cost']}',
							    CostDate   	 	= '" . Utils::toDBDate($_GET['CostDate']) . "'
		                  WHERE  PersonID = '{$PersonID}' AND DisplacementID = '{$DisplacementID}' AND ID = $ID");
                } else {
                    $conn->query("INSERT INTO persons_displacement_cost(UserID, PersonID, DisplacementID, CostType, CostSubtype, Cost, CostDate, CreateDate)
                                  VALUES('{$_SESSION['USER_ID']}', $PersonID, $DisplacementID, '{$_GET['CostType']}',  '{$_GET['CostSubtype']}', '{$_GET['Cost']}', '" . Utils::toDBDate($_GET['CostDate']) . "', CURRENT_TIMESTAMP)");
                }
                header('Location: ./?m=persons&o=displacement_cost&PersonID=' . $PersonID . '&DisplacementID=' . $DisplacementID);
                exit;

                break;

            case 'del':

                $ID = (int)$_GET['ID'];
                $conn->query("DELETE FROM persons_displacement_cost WHERE PersonID = '{$PersonID}' AND DisplacementID = '{$DisplacementID}' AND ID = $ID");
                header('Location: ./?m=persons&o=displacement_cost&PersonID=' . $PersonID . '&DisplacementID=' . $DisplacementID);
                exit;

                break;

            case 'set_info':

                $conn->query("UPDATE persons_displacement SET 
								CostTotal 	= '{$_GET['CostTotal']}',
								CostD 	 	= '{$_GET['CostD']}',
								CostN 	 	= '{$_GET['CostN']}',
								Currency 	= '{$_GET['Currency']}'
		              WHERE PersonID = '{$PersonID}' AND DisplacementID = '{$DisplacementID}'");
                exit;

                break;

        }

    }

    public static function getFunctionsHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT FID, FunctionID, StartDate, EndDate FROM persons_functions WHERE PersonID = $PersonID ORDER BY FID DESC");
        $functionsh = array();
        while ($row = $conn->fetch_array()) {
            $functionsh[$row['FID']] = $row;
        }
        return $functionsh;
    }

    public static function updateFunctionHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $FID = (int)$_GET['FID'];
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        //Log the action
        // Get existing data
        $PFunction = self::getPersonFunctionByID($FID);

        // Compare and log data
        $Comment = 'Modificare functie: ';
        $log = false;
        if ($_GET['StartDate'] != $PFunction['StartDate']) {
            $Comment .= "Data inceput din {$PFunction['StartDate']} in {$_GET['StartDate']}; ";
            $log = true;
        }
        if ($_GET['EndDate'] != $PFunction['EndDate']) {
            $Comment .= "Data sfarsit din {$PFunction['EndDate']} in {$_GET['EndDate']}; ";
            $log = true;
        }
        // Insert log
        if ($log)
            $conn->query("INSERT INTO persons_log SET
    					UserID={$_SESSION['USER_ID']},
    					PID='{$_SESSION['PERS']}',
    					PersonID=$PersonID,
    					Type=2,
    					Comment='$Comment',
    					CreateDate=	CURRENT_TIMESTAMP");
        // Update date
        $conn->query("UPDATE persons_functions SET StartDate = '$StartDate', EndDate = '$EndDate' WHERE FID = $FID AND PersonID = $PersonID");
    }

    public static function getPersonFunctionByID($FunctionID)
    {

        global $conn;
        $conn->query("SELECT * FROM persons_functions WHERE FID = $FunctionID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        $row['EndDate'] = Utils::toDBDate($row['EndDate']);
        return $row;
    }


## Internal Functions

    public static function deleteFunctionHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $FID = (int)$_GET['FID'];

        // Get existing data
        $PFunction = self::getPersonFunctionByID($FID);
        $FunctionID = $PFunction['FunctionID'];
        $Function = self::getFunctionByID($FunctionID);
        // Log the action
        $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 2, 'Stergere functie; Nume:{$Function['Function']}; Cod COR:{$Function['COR']}; Data inceput:{$PFunction['StartDate']}; Data sfarsit:{$PFunction['EndDate']};', CURRENT_TIMESTAMP)");
        // Delete data
        $conn->query("DELETE FROM persons_functions WHERE FID = $FID AND PersonID = $PersonID");
    }

    public static function getInternalFunctionsHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT FID, FunctionID, StartDate, EndDate FROM persons_internal_functions WHERE PersonID = $PersonID ORDER BY FID DESC");
        $functionsh = array();
        while ($row = $conn->fetch_array()) {
            $functionsh[$row['FID']] = $row;
        }
        return $functionsh;
    }

    public static function getCombinedFunctionsHistory()
    {
        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $conn->query("SELECT a.FID, a.FunctionID, a.StartDate, a.EndDate, a.CreateDate, a.LastUpdateDate, '1' AS Type, CONCAT(c.Function, ' - ', c.COR) AS FName FROM persons_functions a LEFT JOIN functions c ON c.FunctionID = a.FunctionID WHERE PersonID = '{$PersonID}'
                            UNION
                            SELECT b.FID, b.FunctionID, b.StartDate, b.EndDate, b.CreateDate, b.LastUpdateDate, '2' AS Type, d.Function AS FName FROM persons_internal_functions b LEFT JOIN internal_functions d ON d.FunctionID = b.FunctionID WHERE b.PersonID = '{$PersonID}'
                            ORDER BY CreateDate DESC");

        while ($row = $conn->fetch_array()) {
            if (!empty($row['StartDate']) && $row['StartDate'] != "0000-00-00") {
                $row['StartDate'] = date('d-m-Y', strtotime($row['StartDate']));
            } else {
                $row['StartDate'] = "";
            }
            if (!empty($row['EndDate']) && $row['EndDate'] != "0000-00-00") {
                $row['EndDate'] = date('d-m-Y', strtotime($row['EndDate']));
            } else {
                $row['EndDate'] = "";
            }
            if (!empty($row['CreateDate']) && $row['CreateDate'] != "0000-00-00") {
                $row['CreateDate'] = date('d-m-Y H:i:s', strtotime($row['CreateDate']));
            } else {
                $row['CreateDate'] = "";
            }

            $functionsh[$row['FID']] = $row;
        }
        return $functionsh;
    }

    public static function updateInternalFunctionHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $FID = (int)$_GET['FID'];
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);

        //Log the action
        // Get existing data
        $PFunction = self::getPersonInternalFunctionByID($FID);

        // Compare and log data
        $Comment = 'Modificare functie interna: ';
        $log = false;
        if ($_GET['StartDate'] != $PFunction['StartDate']) {
            $Comment .= "Data inceput din {$PFunction['StartDate']} in {$_GET['StartDate']}; ";
            $log = true;
        }
        if ($_GET['EndDate'] != $PFunction['EndDate']) {
            $Comment .= "Data sfarsit din {$PFunction['EndDate']} in {$_GET['EndDate']}; ";
            $log = true;
        }
        // Insert log
        if ($log)
            $conn->query("INSERT INTO persons_log SET
    					UserID={$_SESSION['USER_ID']},
    					PID='{$_SESSION['PERS']}',
    					PersonID=$PersonID,
    					Type=3,
    					Comment='$Comment',
    					CreateDate=	CURRENT_TIMESTAMP");
        // Update date
        $conn->query("UPDATE persons_internal_functions SET StartDate = '$StartDate', EndDate = '$EndDate' WHERE FID = $FID AND PersonID = $PersonID");
    }

    public static function getPersonInternalFunctionByID($FunctionID)
    {

        global $conn;
        $conn->query("SELECT * FROM persons_internal_functions WHERE FID = $FunctionID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        $row['EndDate'] = Utils::toDBDate($row['EndDate']);
        return $row;
    }

    public static function deleteInternalFunctionHistory()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $FID = (int)$_GET['FID'];

        // Get existing data
        $PFunction = self::getPersonInternalFunctionByID($FID);
        $FunctionID = $PFunction['FunctionID'];
        $Function = self::getInternalFunctionByID($FunctionID);
        // Log the action
        $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 3, 'Stergere functie interna; Nume:{$Function['Function']}; Data inceput:{$PFunction['StartDate']}; Data sfarsit:{$PFunction['EndDate']};', CURRENT_TIMESTAMP)");
        // Delete data
        $conn->query("DELETE FROM persons_internal_functions WHERE FID = $FID AND PersonID = $PersonID");
    }

    public static function getCostCenterByPerson()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT ID, CostCenterID FROM payroll_costcenter WHERE PersonID = $PersonID ORDER BY ID");
        $costcenter = array();
        while ($row = $conn->fetch_array()) {
            $costcenter[$row['ID']] = $row['CostCenterID'];
        }

        return $costcenter;
    }

    public static function getCostCenterDataByPerson($PersonID = 0)
    {

        global $conn;

        if (empty($PersonID))
            $PersonID = (int)$_GET['PersonID'];

        if (!empty($PersonID))
            $cond = " AND PersonID='$PersonID'";

        $query = "SELECT * FROM payroll_costcenter a
	    			LEFT JOIN costcenter b ON a.CostCenterID=b.CostCenterID 
	    			WHERE 1=1 $cond ORDER BY ID";
        $conn->query($query);
        $costcenter = array();
        while ($row = $conn->fetch_array()) {
            $costcenter[] = $row;
        }

        return $costcenter;
    }

    public static function setCostCenterByPerson()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $CostCenterID = (int)$_GET['CostCenterID'];

        switch ($_GET['action']) {
            case 'new':
                $conn->query("INSERT INTO payroll_costcenter(PersonID, CostCenterID, CreateDate) VALUES('$PersonID', '$CostCenterID', CURRENT_TIMESTAMP)");
                break;
            case 'edit':
                $conn->query("UPDATE payroll_costcenter SET CostCenterID = '$CostCenterID' WHERE PersonID = '$PersonID' AND ID = '{$_GET['ID']}'");
                break;
            case 'del':
                $conn->query("DELETE FROM payroll_costcenter WHERE PersonID = '$PersonID' AND ID = '{$_GET['ID']}'");
                break;
        }
    }

    public static function getActead()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT * FROM persons_actead WHERE PersonID = $PersonID ORDER BY StartDate");
        $actead = array();
        while ($row = $conn->fetch_array()) {
            if (!empty($row['FileLink'])) {
                $row['FileLink'] = Config::SRV_URL . 'docsactead/' . $row['FileLink'];
            }
            $actead[$row['ActID']] = $row;
        }
        return $actead;
    }

    public static function getContractWarnings()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT * FROM persons_warnings WHERE PersonID = $PersonID ORDER BY StartDate");
        $warnings = array();
        while ($row = $conn->fetch_array()) {
            $warnings[$row['WarID']] = $row;
        }
        return $warnings;
    }

    public static function setContractWarnings()
    {

        global $conn;


        $PersonID = (int)$_GET['PersonID'];
        $StartDate = date('Y-m-d', strtotime($conn->real_escape_string($_GET['StartDate'])));
        $EndDate = date('Y-m-d', strtotime($conn->real_escape_string($_GET['EndDate'])));
        $Notes = Utils::formatStr($conn->real_escape_string($_GET['Notes']));
        $Radiat = (isset($_GET['Radiat']) && $_GET['Radiat'] == true ? 1 : 0);

        switch ($_GET['action_contract_warning']) {
            case 'new':
                $conn->query("INSERT INTO persons_warnings(UserID, PersonID, ContractNo, WarNo, StartDate, EndDate, Radiat, Notes, CreateDate)
	    		              VALUES({$_SESSION['USER_ID']}, $PersonID, '" . $conn->real_escape_string($_GET['ContractNo']) . "', '" . $conn->real_escape_string($_GET['WarNo']) . "', '$StartDate', '$EndDate', '$Radiat', '$Notes', CURRENT_TIMESTAMP)");
                //Log the action

                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  		VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 4, 'Adaugare avertisment; Numar:" . $conn->real_escape_string($_GET['WarNo']) . "; Data inceput:$StartDate; Data final:$EndDate; Radiat:($Radiat > 0 ? \"da\" : \"nu\"); Observatii: &laquo; $Notes &raquo;; ', CURRENT_TIMESTAMP)");
                break;
            case 'edit':
                //Get existing data
                $OldWar = self::getContractWarningByID($_GET['WarID']);
                // Compare and log data
                $Comment = "Modificare avertisment: ";
                $log = false;
                if ($_GET['WarNo'] != $OldWar['WarNo']) {
                    $Comment .= "Numar din {$OldWar['ActNo']} in {$_GET['WarNo']}; ";
                    $log = true;
                }
                if ($_GET['StartDate'] != $OldWar['StartDate']) {
                    $Comment .= "Data inceput din {$OldWar['StartDate']} in {$_GET['StartDate']}; ";
                    $log = true;
                }
                if ($_GET['EndDate'] != $OldWar['EndDate']) {
                    $Comment .= "Data final din {$OldWar['EndDate']} in {$_GET['EndDate']}; ";
                    $log = true;
                }
                if ($Radiat != $OldWar['Radiat']) {
                    $Comment .= "Bifa radiat din " . ($OldWar['Radiat'] > 0 ? "da" : "nu") . " in " . ($Radiat > 0 ? "da" : "nu") . "; ";
                    $log = true;
                }
                if ($Notes != $OldWar['Notes']) {
                    $Comment .= "Observatii din &laquo; {$OldWar['Notes']} &raquo; in &laquo; $Notes &raquo; ; ";
                    $log = true;
                }
                // Insert log
                if ($log)
                    $conn->query("INSERT INTO persons_log SET
	    					UserID={$_SESSION['USER_ID']},
	    					PID='{$_SESSION['PERS']}',
	    					PersonID=$PersonID,
	    					Type=4,
	    					Comment='" . $conn->real_escape_string($Comment) . "',
	    					CreateDate=	CURRENT_TIMESTAMP");
                // Update data
                $conn->query("UPDATE persons_warnings SET
	    				                     WarNo     = '" . $conn->real_escape_string($_GET['WarNo']) . "',
	    				                     StartDate = '$StartDate',
	    				                     EndDate = '$EndDate',
	    				                     Radiat = '$Radiat',
							     			 Notes     = '$Notes'
	    			      WHERE WarID = '" . $conn->real_escape_string($_GET['WarID']) . "' AND PersonID = $PersonID");
                break;
            case 'del':
                // Get existing data
                $OldWar = self::getContractWarningByID($_GET['WarID']);
                // Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  		VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 4, 'Stergere avertisment; Numar:{$OldWar['ActNo']}; Data inceput:{$OldWar['StartDate']}; Observatii: &laquo; {$OldWar['Notes']} &raquo;; ', CURRENT_TIMESTAMP)");
                // Delete data
                $conn->query("DELETE FROM persons_warnings WHERE WarID = '" . $conn->real_escape_string($_GET['WarID']) . "' AND PersonID = $PersonID");
                break;
        }


    }

    public static function getContractWarningByID($WarID)
    {
        global $conn;

        $conn->query("SELECT * FROM persons_warnings WHERE WarID = '" . $conn->real_escape_string($WarID) . "'");
        $row = $conn->fetch_array();
        return $row;
    }

    public static function setContractHistory()
    {
        global $conn;
        $PersonID = (int)$_GET['PersonID'];
        $ContractID = (int)$_GET['ContractID'];
        switch ($_GET['action_contract_history']) {
            case 'del':
                $conn->query("DELETE FROM persons_contracts WHERE PersonID = $PersonID AND ContractID = $ContractID");
                break;
        }
    }

    public static function getCM($PersonID)
    {
        global $conn;

        $conn->query("SELECT CM, CMNo, CMSerie FROM payroll WHERE PersonID = $PersonID");
        $row = $conn->fetch_array();

        return $row;
    }

    public function setActead($filename = '', $content = '', $extension = '')
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $StopDate = !empty($_GET['StopDate']) ? Utils::toDBDate($_GET['StopDate']) : '';
        $Notes = Utils::formatStr($_GET['Notes']);

        switch ($_GET['action']) {
            case 'new':
                if (!empty($filename)) {
                    $orig_filename = $filename;
                    $filename = $orig_filename . '_' . rand(0, 99999);

                    if (!file_exists('/docsactead/' . md5($PersonID))) {
                        mkdir('/docsactead/' . md5($PersonID), 0755);
                    }
                    while (file_exists('/docsactead/' . md5($PersonID) . '/' . $filename . '.' . $extension)) {
                        $filename = $orig_filename . '_' . rand(0, 99999);
                    }
                    $handle = fopen('/docsactead/' . md5($PersonID) . '/' . $filename . '.' . $extension, 'w+');
                    fwrite($handle, $content);
                    fclose($handle);


                }
                $conn->query("INSERT INTO persons_actead(UserID, PersonID, ActNo, StartDate, StopDate, Notes, CreateDate, FileName, FileLink)
	    		              VALUES({$_SESSION['USER_ID']}, $PersonID, '{$_GET['ActNo']}', '$StartDate', '$StopDate', '$Notes', CURRENT_TIMESTAMP, '" . str_replace(array('-', '_'), array(' ', ' '), $filename) . "', '" . md5($PersonID) . "/" . $filename . "." . $extension . "')");
                //Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  		VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 4, 'Adaugare act aditional; Numar:{$_GET['ActNo']}; Data inceput:$StartDate; Data sfarsit:$StopDate; Observatii: &laquo; $Notes &raquo;; ', CURRENT_TIMESTAMP)");
                break;
            case 'edit':
                //Get existing data
                $ActOld = self::getActeadByID($_GET['ActID']);
                // Compare and log data
                $Comment = "Modificare act aditional: ";
                $log = false;
                if ($_GET['ActNo'] != $ActOld['ActNo']) {
                    $Comment .= "Numar din {$ActOld['ActNo']} in {$_GET['ActNo']}; ";
                    $log = true;
                }
                if ($_GET['StartDate'] != $ActOld['StartDate']) {
                    $Comment .= "Data inceput din {$ActOld['StartDate']} in {$_GET['StartDate']}; ";
                    $log = true;
                }
                if ($_GET['StopDate'] != $ActOld['StopDate']) {
                    $Comment .= "Data sfarsit din {$ActOld['StopDate']} in {$_GET['StopDate']}; ";
                    $log = true;
                }
                if ($Notes != $ActOld['Notes']) {
                    $Comment .= "Observatii din &laquo; {$ActOld['Notes']} &raquo; in &laquo; $Notes &raquo; ; ";
                    $log = true;
                }
                // Insert log
                if ($log)
                    $conn->query("INSERT INTO persons_log SET
	    					UserID={$_SESSION['USER_ID']},
	    					PID='{$_SESSION['PERS']}',
	    					PersonID=$PersonID,
	    					Type=4,
	    					Comment='$Comment',
	    					CreateDate=	CURRENT_TIMESTAMP");
                // Update data
                $conn->query("UPDATE persons_actead SET
	    				                     ActNo     = '{$_GET['ActNo']}',
	    				                     StartDate = '$StartDate',
	    				                     StopDate  = '$StopDate',
							     			 Notes     = '$Notes'
	    			      WHERE ActID = {$_GET['ActID']} AND PersonID = $PersonID");
                break;
            case 'del':
                // Get existing data
                $ActOld = self::getActeadByID($_GET['ActID']);
                // Log the action
                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
		                  		VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 4, 'Stergere act aditional; Numar:{$ActOld['ActNo']}; Data inceput:{$ActOld['StartDate']}; Data sfarsit:{$ActOld['StopDate']}; Observatii: &laquo; {$ActOld['Notes']} &raquo;; ', CURRENT_TIMESTAMP)");
                // Delete data
                $conn->query("SELECT FileLink as link FROM persons_actead WHERE ActID = {$_GET['ActID']} AND PersonID = $PersonID");
                $file = $conn->fetch_array();
                if (!empty($file['link']) && file_exists($file['link'])) {
                    @unlink(Config::SRV_URL . '/docsactead/' . $file['link']);

                }
                $conn->query("DELETE FROM persons_actead WHERE ActID = {$_GET['ActID']} AND PersonID = $PersonID");
                break;
        }
    }

    public static function getActeadByID($ActID)
    {

        global $conn;

        $conn->query("SELECT * FROM persons_actead WHERE ActID = $ActID");
        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        $row['StopDate'] = Utils::toDBDate($row['StopDate']);
        return $row;
    }
}

?>