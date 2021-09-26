<?php

class Person extends ConfigData
{

    public static $PersonImportAvansData;
    public static $PersonImportPrimeData;
    private $PersonID;

    public function __construct($PersonID = 0)
    {
        $this->PersonID = $PersonID;
    }

    public static function getAllPersons($action = '', $withoutInactives = 0)
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CVQualifRel';
                    $cond .= " AND a.CVQualifRel LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FullNameBeforeMariage':
                    $cond .= " AND (a.FullNameBeforeMariage LIKE '{$_GET['keyword']}%' OR a.FullNameBeforeMariage LIKE '% {$_GET['keyword']}%')";
                    break;
                case 'Function':
                    $cond .= " AND l.Function LIKE '{$_GET['keyword']}%'";
                    break;
                case 'IFunction':
                    $cond .= " AND m.Function LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if ($withoutInactives == 1) {
            $cond .= " AND a.Status NOT IN (6, 5, 11, 10, 3, 1) ";
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
            if (($pos = strpos($_GET['Status'], '_')) !== false) {
                $cond .= " AND a.SubStatus = " . (int)substr($_GET['Status'], $pos + 1);
            }
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID = " . (int)$_GET['CompanyID'] . "
					)";
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")
					)";
        }

        if (!empty($_GET['CF1'])) {
            $cond .= " AND a.CustomPerson1='" . $_GET['CF1'] . "'
		";
        }

        if (!empty($_GET['CAS'])) {
            $cond .= " AND impdb.CAS='" . $_GET['CAS'] . "'
		";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND f.SubDepartmentID = " . (int)$_GET['SubDepartmentID'];

        }
        /*
        if (!empty($_GET['CityID'])) {
    	    $cond.= " AND d.CityID IN (
					    SELECT CityID
					    FROM   address_city
					    WHERE  CityID = " . (int)$_GET['CityID'] . "
					)";
        }
*/
        if (!empty($_GET['CityID'])) {
            $cond .= " AND d.CityID = " . (int)$_GET['CityID'];

        }
        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND e.DistrictID = " . (int)$_GET['DistrictID'];

        } elseif (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID
					    FROM   payroll
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        if (!empty($_GET['CostCenterID'])) {
            $cond .= " AND a.PersonID IN (SELECT DISTINCT PersonID FROM payroll_costcenter WHERE CostCenterID = " . (int)$_GET['CostCenterID'] . ")";
        }

        if (!empty($_GET['Sex'])) {
            $cond .= " AND a.Sex = '{$_GET['Sex']}'";
        }

        if (!empty($_GET['Lang'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM persons_lang WHERE Lang = " . (int)$_GET['Lang'] . ")";
        }

        if (!empty($_GET['JobDictionaryID'])) {
            $cond .= " AND a.JobDictionaryID = " . (int)$_GET['JobDictionaryID'];
        }

        if (!empty($_GET['ContractType'])) {
            $cond .= " AND f.ContractType = " . (int)$_GET['ContractType'];
        }

        if (!empty($_GET['Studies'])) {
            $cond .= " AND a.Studies = '{$_GET['Studies']}'";
        }

        if (!empty($_GET['Localitate'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM persons_prof WHERE City = '{$_GET['Localitate']}')";
        }

        if (!empty($_GET['Tara'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM persons_prof WHERE Country = '{$_GET['Tara']}')";
        }

        if (!empty($_GET['StartDate'])) {
            $StartDate = Utils::toDBDate($_GET['StartDate']);
            $cond .= " AND f.StartDate >= '$StartDate' AND a.Status = 2";
        }

        if (!empty($_GET['COR'])) {
            $cond .= " AND l.COR = '" . $conn->real_escape_string($_GET['COR']) . "'";
        }

        if (!empty($_GET['HealthCompanyID'])) {
            $cond .= " AND f.HealthCompanyID = " . (int)$_GET['HealthCompanyID'];
        }

        if (!empty($_GET['CustomPerson1'])) {
            $cond .= " AND a.CustomPerson1 = '" . $conn->real_escape_string($_GET['CustomPerson1']) . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   persons a
                          LEFT JOIN address b ON b.AddressID=a.AddressID
                          LEFT JOIN address_city d ON d.CityID = b.CityID
                          LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
			  			  LEFT  JOIN payroll f ON a.PersonID = f.PersonID
                                                  LEFT JOIN functions l ON l.FunctionID = f.FunctionID
                                                  LEFT JOIN internal_functions m ON m.FunctionID = f.InternalFunction
                          INNER JOIN users g ON a.UserID = g.UserID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.LastName, a.FirstName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, CONCAT(a.BISerie, ' - ', a.BINumber) AS CI, b.*, d.CityName, e.DistrictName, f.CompanyID, f.DepartmentID, i.SubDepartmentID, f.FunctionID, f.ContractType, f.InternalFunction, f.EmpCode,
	                 CASE WHEN a.DateOfBirth > '0000-00-00' THEN DATE_FORMAT(a.DateOfBirth, '%d.%m.%Y') ELSE '' END AS DateOfBirth,
                         FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, g.UserName, f.DivisionID,
			 CASE WHEN f.StartDate > '0000-00-00' THEN DATE_FORMAT(f.StartDate, '%d.%m.%Y') ELSE '-' END AS StartDate,
			 CASE WHEN f.ContractExpDate > '0000-00-00' THEN DATE_FORMAT(f.ContractExpDate, '%d.%m.%Y') ELSE '-' END AS ContractExpDate,
			 f.StartDate AS fStartDate, f.StopDate AS fStopDate, l.COR,
			 GROUP_CONCAT(k.CostCenter ORDER BY CostCenter ASC SEPARATOR ', ') AS CostCenters,
			 (SELECT Salary FROM persons_salary WHERE PersonID = a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS Salary
	          FROM   persons a
	                 LEFT JOIN address b ON b.AddressID=a.AddressID
                         LEFT JOIN address_city d ON d.CityID = b.CityID
                         LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
                         LEFT  JOIN payroll f ON a.PersonID = f.PersonID
                         LEFT  JOIN departments h ON f.DepartmentID = h.DepartmentID
                         INNER JOIN users g ON a.UserID = g.UserID
                         LEFT  JOIN subdepartments i ON f.SubDepartmentID = i.SubDepartmentID
                         LEFT JOIN payroll_costcenter j ON a.PersonID=j.PersonID
			 LEFT JOIN costcenter k ON j.CostCenterID=k.CostCenterID
                         LEFT JOIN functions l ON l.FunctionID = f.FunctionID
                         LEFT JOIN internal_functions m ON m.FunctionID = f.InternalFunction
	          WHERE  ($condbase) $cond
	          GROUP BY a.PersonID " .
            ($order_by == 'FirmAge' ? "" : " ORDER BY $order_by $asc_or_desc " . (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page));
        $conn->query($query);
        $FirmAge = array();
        while ($row = $conn->fetch_array()) {
            $AddressName = '';
            if ($row['StreetName']) $AddressName .= 'Strada: ' . $row['StreetName'];
            if ($row['StreetCode']) $AddressName .= ', Cod postal: ' . $row['StreetCode'];
            if ($row['StreetNumber']) $AddressName .= ', Numar: ' . $row['StreetNumber'];
            if ($row['Bl']) $AddressName .= ', Bl: ' . $row['Bl'];
            if ($row['Sc']) $AddressName .= ', Sc: ' . $row['Sc'];
            if ($row['Et']) $AddressName .= ', Et: ' . $row['Et'];
            if ($row['Ap']) $AddressName .= ', Ap: ' . $row['Ap'];
            $AddressName = trim($AddressName, ',');
            $row['AddressName'] = $AddressName;
            $arr = Utils::dateDiff2YMD($row['fStartDate'], $row['fStopDate']);
            $row['prof']['years'] = $arr[0];
            $row['prof']['months'] = $arr[1];
            $row['prof']['days'] = $arr[2];
            $FirmAge[$row['PersonID']] = $arr[0] . "/" . $arr[1] . "/" . $arr[2];
            $persons[$row['PersonID']] = $row;
        }
        if ($order_by == 'FirmAge') {
            if ($asc_or_desc == 'desc') {
                arsort($FirmAge);
            } else {
                asort($FirmAge);
            }
            foreach ($FirmAge as $k => $v) {
                $_persons[$k] = $persons[$k];
            }
            $persons = array(0 => $persons[0]) + array_slice($_persons, ($page - 1) * $res_per_page, $res_per_page, true);
            unset($_persons, $FirmAge);
        }
        return $persons;
    }

    public static function getPersonsList($cond = "")
    {
        global $conn;

        $persons = array();
        $query = "SELECT a.PersonID, a.FullName, a.Email FROM persons a
        			INNER JOIN payroll b ON a.PersonID=b.PersonID $cond
        			ORDER BY a.FullName";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getDepartmentPersons($DepartmentID)
    {
        global $conn;

        $persons = array();
        $conn->query("SELECT a.PersonID, a.FullName FROM persons a INNER JOIN payroll b ON b.PersonID = a.PersonID WHERE b.DepartmentID = '{$DepartmentID}'");
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public static function getJobsTitle()
    {

        global $conn;

        $jobs = array();

        $query = "SELECT a.JobID, b.JobTitle, c.CompanyName
                  FROM   jobs a
                         INNER JOIN jobsdictionary b ON a.JobDictionaryID = b.JobDictionaryID
                         INNER JOIN companies c ON a.CompanyID = c.CompanyID
                  WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)
                  ORDER  BY b.JobTitle";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['JobID']] = $row;
        }

        return $jobs;
    }

    public static function getConsultants()
    {

        global $conn;

        $consultants = array();

        $query = "SELECT PersonID, FullName FROM persons WHERE status = 2 OR status = 3 ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $consultants[$row['PersonID']] = $row['FullName'];
        }

        return $consultants;
    }

    public static function getCostCenters($PersonID)
    {
        global $conn;

        $cost_centers = array();
        $conn->query("SELECT a.CostCenterID, a.CostCenter FROM costcenter a JOIN payroll_costcenter b ON b.CostCenterID = a.CostCenterID AND b.PersonID = '{$PersonID}'");
        while ($row = $conn->fetch_array()) {
            $cost_centers[$row['CostCenterID']] = $row['CostCenter'];
        }
        return $cost_centers;
    }

    public static function getEmployeesData($all = true)
    {

        global $conn;

        $cond = !empty($all) ? "1=1" : "(a.status = 2 OR a.status=3 OR a.status=5 OR a.status=6 OR a.status=7 OR a.status=9)";

        $res = array();

        $query = "SELECT *, (SELECT Salary FROM persons_salary x WHERE x.PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS PersonSalary FROM persons a
	    		  INNER JOIN payroll b ON a.PersonID=b.PersonID
	    		  INNER JOIN companies c ON b.CompanyID=c.CompanyID
	    		  LEFT JOIN address d ON a.AddressID=d.AddressID
	    		  LEFT JOIN address_city e ON d.CityID=e.CityID
	    		  LEFT JOIN address_district f ON e.DistrictID=f.DistrictID
	    		  LEFT JOIN functions g ON b.FunctionID=g.FunctionID
	    		  WHERE $cond ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $AddressName = '';
            if ($row['StreetName']) $AddressName .= 'Strada: ' . $row['StreetName'];
            if ($row['StreetCode']) $AddressName .= ', Cod postal: ' . $row['StreetCode'];
            if ($row['StreeNumber']) $AddressName .= ', Numar: ' . $row['StreeNumber'];
            if ($row['Bl']) $AddressName .= ', Bl: ' . $row['Bl'];
            if ($row['Sc']) $AddressName .= ', Bl: ' . $row['Sc'];
            if ($row['Et']) $AddressName .= ', Et: ' . $row['Et'];
            if ($row['Ap']) $AddressName .= ', Ap: ' . $row['Ap'];
            $AddressName = trim($AddressName, ',');
            $row['AddressName'] = $AddressName;
            $res[$row['PersonID']] = $row;
        }

        return $res;
    }

    public static function getTrainers()
    {

        global $conn;

        $trainers = array();

        $query = "SELECT PersonID, FullName FROM persons WHERE Trainer = 1 ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $trainers[$row['PersonID']] = $row['FullName'];
        }

        return $trainers;
    }

    public static function getEmployees($all = true, $divisionID = 0, $exceptPers = 0)
    {
        global $conn;

        $cond = "1=1";
        $cond .= !empty($all) ? "" : "status IN (2,7,9,10,12)";

        if ($divisionID > 0)
            $cond .= " AND p.DivisionID = '" . $divisionID . "'";
        if ($exceptPers > 0)
            $cond .= " AND pers.PersonID <> '" . $exceptPers . "'";
        $consultants = array();

        $query = "SELECT pers.PersonID, pers.FullName FROM persons pers
                    LEFT JOIN payroll p ON p.PersonID = pers.PersonID
                    WHERE $cond ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $consultants[$row['PersonID']] = $row['FullName'];
        }

        return $consultants;
    }

    public static function getVacation($PersonID, $RefYear = '')
    {

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][1][1][10] > 0)) {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][10]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][10]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        if (!empty($RefYear))
            $condbase .= " AND b.Year = $RefYear ";

        $vacations = array();

        $query = "SELECT a.FullName, a.Status, b.VacationID, b.Year, b.TotalCO, b.TotalCORef, b.Invoire, b.VacRecalc, b.Closed, b.History, a.VacationComment, b.ReportDateLimit,
    	                 (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Year = b.Year AND Type = 'CO' AND Aprove >= 0) AS EffCO,
    	                 CASE WHEN $condrw THEN 1 ELSE 0 END AS rw,
    	                 c.DivisionID
    	          FROM   persons a
    	                 LEFT JOIN vacations b ON a.PersonID = b.PersonID
    	                 LEFT JOIN payroll c ON c.PersonID = a.PersonID
    	          WHERE  a.PersonID = $PersonID AND ($condbase)
    	          ORDER  BY b.Year";
        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            $vacations[$row['Year']] = $row;
        }

        foreach ($vacations as $year => $vac_year) {
            if (strtotime($vac_year['ReportDateLimit']) >= strtotime(date('Y-m-d')))
                continue;

            if (empty($vac_year['ReportDateLimit']))
                continue;

            if ($vac_year['TotalCO'] <= $vac_year['TotalCORef'])
                continue;

            $PastCO = 0;

            $query = "SELECT StartDate, StopDate, DaysNo 
						FROM vacations_details 
						WHERE PersonID = $PersonID AND Year = '{$year}' AND Type = 'CO' AND Aprove >= 0
							AND StartDate <= '{$vac_year['ReportDateLimit']}' ";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                if (Utils::getDaysDiff($vac_year['ReportDateLimit'], $row['StopDate'], true, true) > 0) {
                    $PastCO += Utils::getDaysDiff($row['StartDate'], $vac_year['ReportDateLimit'], true, true);
                } else {
                    $PastCO += (int)$row['DaysNo'];
                }
            }

            $vacations[$year]['PastCO'] = $PastCO;
            $vacations[$year]['LostCO'] = ($vac_year['TotalCO'] - $vac_year['TotalCORef'] - $PastCO > 0) ? $vac_year['TotalCO'] - $vac_year['TotalCORef'] - $PastCO : 0;
        }
        return $vacations;
    }

    public static function getPersonID($Email)
    {
        $Email = trim($Email);
        @$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);
        $conn->query("select PersonID from persons where Email='{$Email}' limit 1");
        $row = $conn->fetch_array();
        if (!empty($row['PersonID'])) {
            return $row['PersonID'];
        } else {
            return 0;
        }

    }

    public static function getPersonsByRole($role_type)
    {

        global $conn;

        $conn->query("SELECT PersonID, FullName 
	              FROM   persons 
		      WHERE  RoleID IN (SELECT UserID FROM users WHERE UserType = 'role' AND RoleType = '$role_type') AND
		             Status IN (2,7)
		      ORDER  BY FullName");
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }
        return $persons;
    }

    public static function getDirectManagerID($PersonID)
    {
        global $conn;

        $conn->query("SELECT DirectManagerID FROM payroll WHERE PersonID = '{$PersonID}'");
        $row = $conn->fetch_array();
        return $row['DirectManagerID'];
    }

    public static function getMedical($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][9]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][9]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $medical = array();

        $query = "SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)";

        $conn->query($query);

        if ($row = $conn->fetch_array()) {
            $medical[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT MedicalID, RegDate, EndDate, Notes, Type
	              FROM   persons_medical
		      WHERE  PersonID = $PersonID
		      ORDER  BY Type, MedicalID DESC");
        while ($row = $conn->fetch_array()) {
            $row['RegDate'] = Utils::toDisplayDate($row['RegDate']);
            $row['EndDate'] = Utils::toDisplayDate($row['EndDate']);
            $row['Notes'] = stripslashes($row['Notes']);
            $medical[$row['Type']][$row['MedicalID']] = $row;
        }

        $medical[1][0] = array();
        $medical[2][0] = array();
        $medical[3][0] = array();

        foreach ($medical as $key => $med) {
            $medical[$key] = array_reverse($med, true);
        }

        return $medical;
    }

    public static function setMedical($PersonID)
    {

        global $conn;

        $MedicalID = (int)$_GET['MedicalID'];

        if (!empty($_GET['del'])) {
            $conn->query("DELETE FROM persons_medical WHERE MedicalID = $MedicalID AND PersonID = $PersonID");
        } else {
            $RegDate = Utils::toDBDate($_POST['RegDate']);
            $EndDate = Utils::toDBDate($_POST['EndDate']);
            $Notes = Utils::formatStr($_POST['Notes']);
            if ($MedicalID > 0) {
                $conn->query("UPDATE persons_medical SET RegDate = '$RegDate', EndDate = '$EndDate', Notes = '$Notes', LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE MedicalID = $MedicalID AND PersonID = $PersonID");
            } else {
                $conn->query("INSERT INTO persons_medical(UserID, PersonID, Type, RegDate, EndDate, Notes, CreateDate, LastUpdateDate)
		              VALUES('{$_SESSION['USER_ID']}', '$PersonID', '{$_POST['Type']}', '$RegDate', '$EndDate', '$Notes', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getMedicalDocs($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][9]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][9]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $medical = array();

        $query = "SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)";

        $conn->query($query);

        if ($row = $conn->fetch_array()) {
            $medical[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT Id, DocName, DocDate, Issuer, DocType, DocNumber
	              FROM   persons_medical_docs
		      WHERE  PersonID = $PersonID
		      ORDER  BY DocType, Id DESC");
        while ($row = $conn->fetch_array()) {
            $row['DocDate'] = Utils::toDisplayDate($row['DocDate']);
            $row['DocName'] = stripslashes($row['DocName']);
            $row['Issuer'] = stripslashes($row['Issuer']);
            $row['DocNumber'] = stripslashes($row['DocNumber']);
            $medical[$row['DocType']][$row['Id']] = $row;
        }

        $medical[1][0] = array();
        $medical[2][0] = array();
        $medical[3][0] = array();

        foreach ($medical as $key => $med) {
            $medical[$key] = array_reverse($med, true);
        }

        return $medical;
    }

    public static function getBeneficii($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][8]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][8]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $ben = array();

        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $ben[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT BenID, TotalCost, Currency, Retained, RegDate, EndDate, CompanyID, Notes, Type
	              FROM   persons_beneficii
		      WHERE  PersonID = $PersonID
		      ORDER  BY Type, BenID DESC");
        while ($row = $conn->fetch_array()) {
            $row['RegDate'] = Utils::toDBDate($row['RegDate']);
            $row['EndDate'] = Utils::toDBDate($row['EndDate']);
            $row['Notes'] = stripslashes($row['Notes']);
            $ben[$row['Type']][$row['BenID']] = $row;
        }

        $ben[1][0] = array();
        $ben[2][0] = array();
        $ben[3][0] = array();
        $ben[4][0] = array();
        $ben[5][0] = array();
        $ben[6][0] = array();
        $ben[7][0] = array();
        //$ben[8][0] = array();
        $ben[9][0] = array();
        $ben[11][0] = array();
        $ben[12][0] = array();
        $ben[13][0] = array();
        $ben[14][0] = array();
        $ben[15][0] = array();

        foreach ($ben as $key => $beneficiu) {
            $ben[$key] = array_reverse($beneficiu, true);
        }
        return $ben;
    }

    public static function setBeneficii($PersonID)
    {

        global $conn;

        $BenID = (int)$_GET['BenID'];

        if (!empty($_GET['del'])) {
            $conn->query("DELETE FROM persons_beneficii WHERE BenID = $BenID AND PersonID = $PersonID");
        } else {
            $RegDate = Utils::toDBDate($_POST['RegDate']);
            $EndDate = Utils::toDBDate($_POST['EndDate']);
            $Notes = Utils::formatStr($_POST['Notes']);
            if ($BenID > 0) {
                $conn->query("UPDATE persons_beneficii SET
		                                           TotalCost = '{$_POST['TotalCost']}', Currency = '{$_POST['Currency']}', Retained='" . (int)$_POST['Retained'] . "',
		                                           RegDate = '$RegDate', EndDate = '$EndDate', CompanyID = '{$_POST['CompanyID']}',
							   Notes = '$Notes', LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE BenID = $BenID AND PersonID = $PersonID");
            } else {
                $query = "INSERT INTO persons_beneficii(UserID, PersonID, Type, TotalCost, Currency, Retained, RegDate, EndDate, CompanyID, Notes, CreateDate, LastUpdateDate)
		              VALUES('{$_SESSION['USER_ID']}', '$PersonID', '{$_POST['Type']}', '{$_POST['TotalCost']}', '{$_POST['Currency']}', '" . (int)$_POST['Retained'] . "', '$RegDate', '$EndDate', '{$_POST['CompanyID']}', '$Notes', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                $conn->query($query);
            }
        }
    }

    public static function getPersonsByIntretinere($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $persons = array();

        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $persons[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT ID, Nume, Calitate, Coasigurat, CNP, Active,
	                     DATE_FORMAT(DataIni, '%d.%m.%Y') AS DataIni, DATE_FORMAT(DataFin, '%d.%m.%Y') AS DataFin
	              FROM   persons_intretinere
	              WHERE  PersonID = $PersonID ");
        while ($row = $conn->fetch_array()) {
            $persons[$row['ID']] = $row;
        }

        return $persons;
    }

    public static function setPersonsByIntretinere($PersonID)
    {

        global $conn, $smarty;

        switch ($_GET['action']) {
            case 'new_pers':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $query = "INSERT INTO persons_intretinere(UserID, PersonID, Nume, Calitate, Coasigurat, CNP, DataIni, DataFin, CreateDate, LastUpdateDate)
		          VALUES({$_SESSION['USER_ID']}, $PersonID, '" . Utils::formatStr($_POST['Nume']) . "',
		                  '" . Utils::formatStr($_POST['Calitate']) . "', '" . Utils::formatStr($_POST['Coasigurat']) . "', '" . Utils::formatStr($_POST['CNP']) . "',
		                  '{$_POST['StartDate']}', '{$_POST['StopDate']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                break;
            case 'edit_pers':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $query = "UPDATE persons_intretinere SET
		        				Nume           = '" . Utils::formatStr($_POST['Nume']) . "',
		                			Calitate       = '" . Utils::formatStr($_POST['Calitate']) . "',
		                			Coasigurat       = '" . Utils::formatStr($_POST['Coasigurat']) . "',
		                			CNP            = '" . Utils::formatStr($_POST['CNP']) . "',
		                                        DataIni        = '{$_POST['StartDate']}',
		                                        DataFin        = '{$_POST['StopDate']}',
		                                        Active         = " . (!empty($_POST['Active']) ? 1 : 0) . ",
		                                        LastUpdateDate = CURRENT_TIMESTAMP
		          WHERE  ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
            case 'del_pers':
                $query = "DELETE FROM persons_intretinere WHERE ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
        }
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=intretinere&PersonID={$PersonID}';\"></body>";
            exit;
        }
    }

    public static function getPersonsByAsistate($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $persons = array();

        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $persons[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT ID, Nume, Calitate, Coasigurat, CNP, Active, DATE_FORMAT(BirthDate, '%d.%m.%Y') AS BirthDate, Certificat, TipHandicap,
	                     DATE_FORMAT(DataIni, '%d.%m.%Y') AS DataIni, DATE_FORMAT(DataFin, '%d.%m.%Y') AS DataFin
	              FROM   persons_asistate
	              WHERE  PersonID = $PersonID ");
        while ($row = $conn->fetch_array()) {
            $persons[$row['ID']] = $row;
        }

        return $persons;
    }

    public static function setPersonsByAsistate($PersonID)
    {

        global $conn, $smarty;

        switch ($_GET['action']) {
            case 'new_pers':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $_POST['BirthDate'] = Utils::toDBDate($_POST['BirthDate']);
                $query = "INSERT INTO persons_asistate(UserID, PersonID, Nume, Calitate, Coasigurat, CNP, BirthDate, Certificat, TipHandicap, DataIni, DataFin, CreateDate, LastUpdateDate)
		          VALUES({$_SESSION['USER_ID']}, $PersonID, '" . Utils::formatStr($_POST['Nume']) . "',
		                  '" . Utils::formatStr($_POST['Calitate']) . "', '" . Utils::formatStr($_POST['Coasigurat']) . "', '" . Utils::formatStr($_POST['CNP']) . "',
		                  '{$_POST['BirthDate']}', '" . Utils::formatStr($_POST['Certificat']) . "', '" . Utils::formatStr($_POST['TipHandicap']) . "', '{$_POST['StartDate']}', '{$_POST['StopDate']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                break;
            case 'edit_pers':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $_POST['BirthDate'] = Utils::toDBDate($_POST['BirthDate']);
                $query = "UPDATE persons_asistate SET
		        				Nume           = '" . Utils::formatStr($_POST['Nume']) . "',
		                		Calitate       = '" . Utils::formatStr($_POST['Calitate']) . "',
		                		Coasigurat       = '" . Utils::formatStr($_POST['Coasigurat']) . "',
		                		CNP            = '" . Utils::formatStr($_POST['CNP']) . "',
		                		Certificat     = '" . Utils::formatStr($_POST['Certificat']) . "',
		                		TipHandicap    = '" . Utils::formatStr($_POST['TipHandicap']) . "',
		                        BirthDate      = '{$_POST['BirthDate']}',
		                        DataIni        = '{$_POST['StartDate']}',
                                DataFin        = '{$_POST['StopDate']}',
                                Active         = " . (!empty($_POST['Active']) ? 1 : 0) . ",
                                LastUpdateDate = CURRENT_TIMESTAMP
		          WHERE  ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
            case 'del_pers':
                $query = "DELETE FROM persons_asistate WHERE ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
        }
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=intretinere&PersonID={$PersonID}';\"></body>";
            exit;
        }
    }

    public static function getPersonsByCM($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][5]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][5]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $cm = array();

        $conn->query("SELECT a.FullName, a.Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw, b.StartDate, b.StopDate
                            FROM persons a 
                            INNER JOIN payroll b ON b.PersonID = a.PersonID
                            WHERE a.PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $cm[0] = $row;
            $cm[0]['zile'] = 0;
            if (empty($row['StopDate']) || $row['StopDate'] == "00-00-0000") {
                $row['StopDate'] = date('d-m-Y');
            }

            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['StopDate']);
            $cm[0]['total_years'] = $arr[0];
            $cm[0]['total_months'] = $arr[1];
            $cm[0]['total_days'] = $arr[2];
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $cm[0]['curr_years'] = $cm[0]['total_years'];
        $cm[0]['curr_months'] = $cm[0]['total_months'] % 12;
        $cm[0]['curr_days'] = $cm[0]['total_days'] % 30;
        $conn->query("SELECT ID, Functie, Companie, DataIni AS StartDate, DataFin AS EndDate, DATEDIFF(DataFin, DataIni) AS zile,
	                     DataIni, DataFin, Document, SerieNo, VechimeSpec, PerioadaScazut, NonVechime, NoDays
	              FROM   persons_cm
	              WHERE  PersonID = $PersonID ORDER BY ID");
        $auxDateStart = array();
        $auxDateEnd = array();

        $cm_to_minus = array();
        $cm_spec = array();
        $cm_non = array();

        while ($row = $conn->fetch_array()) {
            /*
	    $cm[0]['zile'] += $row['zile'];
	    $row['years']   = floor($row['zile'] / 365);
	    $rest           = $row['zile'] % 365;
	    $row['months']  = floor($rest / 30);
	    $row['days']    = $rest % 30;
	    */
            if ($row['NoDays'] > 0) {
                $arr[0] = 0;
                $arr[1] = 0;
                $arr[2] = $row['NoDays'];
            } else
                $arr = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);

            /************** hack 30 zile = luna noua *****************/

            if($arr[2] == 30) {
                $arr[2] = 0;
                $arr[1] += 1;
                if($arr[1] == 12) {
                    $arr[1] = 0;
                    $arr[0] += 1;
                }
            }

            /*************--------------------------******************/

            $x1 = $row['StartDate'];
            $y1 = $row['EndDate'];
            $auxMod = 0; // nu exista modificari
            for ($auxI = 0; $auxI < count($auxDateStart); $auxI++) {
                $auxMod = 1; //voi modifica
                $x0 = $auxDateStart[$auxI];
                $y0 = $auxDateEnd[$auxI];
                if ($x1 <= $x0 and $y1 <= $y0 and $y1 >= $x0) {
                    $auxDateStart[$auxI] = $x1;
                    $auxArr = Utils::dateDiff2YMD($row['StartDate'], $auxDateStart[$auxI]);
                    $cm[0]['vdays'] += $auxArr[2];
                    $cm[0]['vmonths'] += $auxArr[1];
                    $cm[0]['vyears'] += $auxArr[0];
                } else if ($x1 <= $x0 and $y1 >= $y0) {
                    $auxDateStart[$auxI] = $x1;
                    $auxDateEnd[$auxI] = $y1;
                    $auxArr = Utils::dateDiff2YMD($x1, $x0);
                    $cm[0]['vdays'] += $auxArr[2];
                    $cm[0]['vmonths'] += $auxArr[1];
                    $cm[0]['vyears'] += $auxArr[0];
                    $auxArr = Utils::dateDiff2YMD($y0, $y1);
                    $cm[0]['vdays'] += $auxArr[2];
                    $cm[0]['vmonths'] += $auxArr[1];
                    $cm[0]['vyears'] += $auxArr[0];
                } else if ($x1 >= $x0 and $y1 <= $y0) {
                } else if ($x1 >= $x0 and $y1 >= $y0 and $x1 <= $y0) {
                    $auxDateEnd[$auxI] = $y1;
                    $auxArr = Utils::dateDiff2YMD($y0, $y1);
                    $cm[0]['vdays'] += $auxArr[2];
                    $cm[0]['vmonths'] += $auxArr[1];
                    $cm[0]['vyears'] += $auxArr[0];
                } else {
                    $auxMod = 0; //de fapt nu am modificat nimic deci trebuie adaugat in vector mai jos
                }

            }
            if ($auxMod == 0) {
                $auxDateStart[] = $row['StartDate'];
                $auxDateEnd[] = $row['EndDate'];
                $cm[0]['vdays'] += $arr[2];
                $cm[0]['vmonths'] += $arr[1];
                $cm[0]['vyears'] += $arr[0];

            }
            if ($cm[0]['vdays'] > 30) {
                $cm[0]['vdays'] -= 30;
                $cm[0]['vmonths'] += 1;
            }
            if ($cm[0]['vmonths'] > 12) {
                $cm[0]['vmonths'] -= 12;
                $cm[0]['vyears'] += 1;
            }
            $row['years'] = $arr[0];
            $row['months'] = $arr[1];
            $row['days'] = $arr[2];
            $row['DataIni'] = Utils::toDisplayDate($row['DataIni']);
            $row['DataFin'] = Utils::toDisplayDate($row['DataFin']);
            $cm[$row['ID']] = $row;
            if ($row['PerioadaScazut'] != 0) {
                $cm_to_minus['days'] += $row['days'];
                $cm_to_minus['months'] += $row['months'];
                $cm_to_minus['years'] += $row['years'];
            } else {
                if ($row['NonVechime'] != 0) {
                    $cm_non['days'] += $row['days'];
                    $cm_non['months'] += $row['months'];
                    $cm_non['years'] += $row['years'];
                } else {
                    if ($row['VechimeSpec'] != 0) {
                        $cm_spec['days'] += $row['days'];
                        $cm_spec['months'] += $row['months'];
                        $cm_spec['years'] += $row['years'];
                    }
                    $cm[0]['days'] += $row['days'];
                    $cm[0]['months'] += $row['months'];
                    $cm[0]['years'] += $row['years'];
                    $cm[0]['total_days'] += $row['days'];
                    $cm[0]['total_months'] += $row['months'];
                    $cm[0]['total_years'] += $row['years'];
                }
            }
        }

        /*
	$cm[0]['years']  = floor($cm[0]['zile'] / 365);
	$rest            = $cm[0]['zile'] % 365;
	$cm[0]['months'] = floor($rest / 30);
	$cm[0]['days']   = $rest % 30;
	*/

        $months = floor($cm_to_minus['days'] / 30);
        $cm[0]['cdaysM'] = $cm_to_minus['days'] % 30;
        $months = $cm_to_minus['months'] + $months;
        $cm[0]['cmonthsM'] = $months % 12;
        $cm[0]['cyearsM'] = $cm_to_minus['years'] + floor($months / 12);

        $months = floor($cm_spec['days'] / 30);
        $cm[0]['cdaysS'] = $cm_spec['days'] % 30;
        $months = $cm_spec['months'] + $months;
        $cm[0]['cmonthsS'] = $months % 12;
        $cm[0]['cyearsS'] = $cm_spec['years'] + floor($months / 12);

        $months = floor($cm_non['days'] / 30);
        $cm[0]['cdaysN'] = $cm_non['days'] % 30;
        $months = $cm_non['months'] + $months;
        $cm[0]['cmonthsN'] = $months % 12;
        $cm[0]['cyearsN'] = $cm_non['years'] + floor($months / 12);

        $months = floor($cm[0]['days'] / 30);
        $cm[0]['cdays'] = $cm[0]['days'] % 30;
        $months = $cm[0]['months'] + $months;
        $cm[0]['cmonths'] = $months % 12;
        $cm[0]['cyears'] = $cm[0]['years'] + floor($months / 12);

        if ($cm[0]['cdaysM'] > $cm[0]['cdays']) {
            $daysM = $cm[0]['cdaysM'] - $cm[0]['cdays'];
            $cm[0]['cdays'] = 30 - $daysM;
            if ($cm[0]['cmonths'] > 0)
                $cm[0]['cmonths'] -= 1;
            else {
                $cm[0]['cyears'] -= 1;
                $cm[0]['cmonths'] = 11;
            }
        } else {
            $cm[0]['cdays'] -= $cm[0]['cdaysM'];
        }

        if ($cm[0]['cmonthsM'] > $cm[0]['cmonths']) {
            $monthsM = $cm[0]['cmonthsM'] - $cm[0]['cmonths'];
            $cm[0]['cmonths'] = 12 - $monthsM;
            $cm[0]['cyears'] -= 1;
        } else {
            $cm[0]['cmonths'] -= $cm[0]['cmonthsM'];
        }
        $cm[0]['cyears'] -= $cm[0]['cyearsM'];

        $conn->query("SELECT StartDate, StopDate AS EndDate, DATEDIFF(StopDate, StartDate) AS zile,
	                     DATE_FORMAT(StartDate, '%d.%m.%Y') AS DataIni, DATE_FORMAT(StopDate, '%d.%m.%Y') AS DataFin
	              FROM   vacations_details
	              WHERE  PersonID = $PersonID and Type='CFS'");
        $tzile = 0;
        while ($row = $conn->fetch_array()) {
            $tzile += $row['zile'];
        }
        $cm[0]['total_days'] -= $tzile;
        $cm[0]['cfs'] = $tzile;

        $months = floor($cm[0]['total_days'] / 30);
        $cm[0]['ctdays'] = $cm[0]['total_days'] % 30;
        $months = $cm[0]['total_months'] + $months;
        $cm[0]['ctmonths'] = $months % 12;
        $cm[0]['ctyears'] = $cm[0]['total_years'] + floor($months / 12);

        if ($cm[0]['cdaysM'] > $cm[0]['ctdays']) {
            $daysM = $cm[0]['cdaysM'] - $cm[0]['ctdays'];
            $cm[0]['ctdays'] = 30 - $daysM;
            if ($cm[0]['ctmonths'] > 0)
                $cm[0]['ctmonths'] -= 1;
            else {
                $cm[0]['ctyears'] -= 1;
                $cm[0]['ctmonths'] = 11;
            }
        } else {
            $cm[0]['ctdays'] -= $cm[0]['cdaysM'];
        }

        if ($cm[0]['cmonthsM'] > $cm[0]['ctmonths']) {
            $monthsM = $cm[0]['cmonthsM'] - $cm[0]['ctmonths'];
            $cm[0]['ctmonths'] = 12 - $monthsM;
            $cm[0]['ctyears'] -= 1;
        } else {
            $cm[0]['ctmonths'] -= $cm[0]['cmonthsM'];
        }
        $cm[0]['ctyears'] -= $cm[0]['cyearsM'];

        return $cm;
    }

    public static function setPersonsByCM($PersonID)
    {
        global $conn;

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        if($_POST['StartDate'] != '--' && $_POST['StopDate'] != '--' && $_POST['StartDate'] != '0000-00-00' && $_POST['StopDate'] != '0000-00-00') {
            $checkEditID = '';
            if ($_GET['action'] == 'edit_cm')
                $checkEditID = " AND ID != '{$_GET['ID']}'";
            $query = "SELECT ID
	              FROM   persons_cm
		      WHERE  PersonID = $PersonID " . $checkEditID . " AND
		             (DataIni BETWEEN '{$_POST['StartDate']}' AND '{$_POST['StopDate']}' OR
			        DataFin BETWEEN '{$_POST['StartDate']}' AND '{$_POST['StopDate']}' OR
				'{$_POST['StartDate']}' BETWEEN DataIni AND DataFin)";
            $conn->query($query);


            if ($row = $conn->fetch_array()) {
                echo "<body onload=\"if(confirm('Perioada se suprapune peste o alta perioada deja introdusa! Continuati?')){} else {window.location.href = './?m=persons&o=cm&PersonID={$PersonID}';}\"></body>";
                //exit;
            }
        }
        switch ($_GET['action']) {
            case 'new_cm':
                $query = "INSERT INTO persons_cm(UserID, PersonID, Functie, Companie, DataIni, DataFin, NoDays, Document, SerieNo, VechimeSpec, PerioadaScazut, NonVechime, CreateDate, LastUpdateDate)
		          VALUES({$_SESSION['USER_ID']}, $PersonID, '" . Utils::formatStr($_POST['Functie']) . "',
		                  '" . Utils::formatStr($_POST['Companie']) . "',
		                  '{$_POST['StartDate']}', '{$_POST['StopDate']}', '{$_POST['NoDays']}', '{$_POST['Document']}', '{$_POST['SerieNo']}', '" . (isset($_POST['VechimeSpec']) ? 1 : 0) . "', '" . (isset($_POST['PerioadaScazut']) ? 1 : 0) . "', '" . (isset($_POST['NonVechime']) ? 1 : 0) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                break;
            case 'edit_cm':
                $query = "UPDATE persons_cm SET
		        				Functie        = '" . Utils::formatStr($_POST['Functie']) . "',
		                			Companie       = '" . Utils::formatStr($_POST['Companie']) . "',
		                                        DataIni        = '{$_POST['StartDate']}',
		                                        DataFin        = '{$_POST['StopDate']}',
		                                        NoDays        = '{$_POST['NoDays']}',
		                                        Document        = '{$_POST['Document']}',
		                                        SerieNo        = '{$_POST['SerieNo']}',
		                                        VechimeSpec        = '" . (isset($_POST['VechimeSpec']) ? 1 : 0) . "',
		                                        PerioadaScazut        = '" . (isset($_POST['PerioadaScazut']) ? 1 : 0) . "',
		                                        NonVechime        = '" . (isset($_POST['NonVechime']) ? 1 : 0) . "',
		                                        LastUpdateDate = CURRENT_TIMESTAMP
		          WHERE  ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
            case 'del_cm':
                $query = "DELETE FROM persons_cm WHERE ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
            case 'edit_payroll_cm':

                $info = $_POST;

                foreach ($info as &$v) {
                    if (!is_numeric($v)) {
                        $v = Utils::formatStr($v);
                    }
                }
                unset($v);

                $update = '';
                unset($v);

                foreach ($info as $k => $v) {
                    $update .= "$k = '$v', ";
                }

                $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.DirectManagerID = '{$_SESSION['PERS']}' " : "";
                $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";
                $query = "UPDATE payroll a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)";

                break;
        }
        $conn->query($query);
    }

    public static function getAntropometrie($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][18]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][18]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FullName, a.Status, b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   persons a
                         LEFT JOIN persons_antropometrie b ON a.PersonID = b.PersonID
                  WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getMilitary($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][20]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][20]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FullName, a.Status, b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   persons a
                         LEFT JOIN persons_military b ON a.PersonID = b.PersonID
                  WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function employeesAtDate()
    {
        global $conn;

        $persons = array();
        $year = date('Y');
        $months = Utils::getMonthArray($year . '-01-01', $year . '-12-31');
        foreach ($months as $month => $v) {
            $query = "SELECT COUNT(a.PersonID) AS EmployeesNo,'$month' AS Month, a.Status
		              FROM persons a
		              INNER JOIN payroll b ON a.PersonID = b.PersonID
		              WHERE  DATE_FORMAT(b.StartDate,'%Y-%m')<='$month' AND (DATE_FORMAT(b.StopDate,'%Y-%m')<='$month' OR b.StopDate!='0000-00-00')
		              
		              GROUP BY a.Status
		              ";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $res[$row['Status']] = $row;
            }
            $persons[$month] = $res;
        }
        //Utils::pa($persons);
        return $persons;
    }

    public static function getData($path)
    {
        $data = new Spreadsheet_Excel_Reader($path);
        //	echo "<pre>";
        //	print_r($data);
        //	echo "</pre>";
        for ($j = 1; $j <= $data->colcount(); $j++) {
            for ($i = 1; $i <= $data->rowcount(); $i++) {
                self::$PersonImportData[$i][$j] = $data->value($i, $j);
            }
        }

    }

    public static function ImportData($info_arr = array(), $info_arrPost = array())
    {
        global $conn;
        $size = count($info_arrPost);
        if ($size != 0) {
            $randuri = 1;
            foreach ($info_arrPost as $infoPost) {
                $randuri++;
                $info = $info_arr[$randuri];
                //echo "<pre>"; print_r($infoPost); echo"</pre>";
                //echo "<pre>"; print_r($info); echo"</pre>";
                //die();

                if ($infoPost[0] == 1)
                    if (empty($info[2])) {
                        echo "<pre>";
                        print_r($infoPost);
                        echo "</pre>";
                        echo "<pre>";
                        print_r($info);
                        echo "</pre>";
                        die();
                        throw new Exception(Message::getMessage('XLS_FULLNAME_EMPTY'));
                    }
                /*
        		if (!empty($info[3])) {
        			if(!Utils::checkEmail(trim($info[3])))
             		throw new Exception(Message::getMessage('XLS_EMAIL_ERROR'));
      			}
      			*/
                if ($infoPost[0] == 1) // Verificam daca e bifat
                {

                    $q = "select * from persons pers 
					inner join payroll pay on pers.PersonID=pay.PersonID
						where pers.CNP='" . trim($info[22]) . "' and pay.CompanyID='" . $_POST['CompanyID'] . "' limit 1";

                    $res = $conn->query($q);

                    if (!mysql_num_rows($res)) {
                        //			echo "INTRODUC PERSOANA NOUA<br /><br />";

                        $q = "select * from address_district 
						where DistrictName='" . trim($info[23]) . "'";
                        $res = $conn->query($q);

                        if (!mysql_num_rows($res)) {
                            $conn->query("insert into address_district (DistrictName) values('" . trim($info[23]) . "')");
                            $DistrictID = mysql_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $DistrictID = $row['DistrictID'];
                        }
                        $q = "select * from address_city
						where 
						DistrictID='" . $DistrictID . "'
						and CityName='" . trim($info[24]) . "'";
                        $res = $conn->query($q);
                        if (!mysql_num_rows($res)) {
                            $conn->query("insert into address_city (CityName, DistrictID) values('" . trim($info[24]) . "','" . $DistrictID . "')");
                            $CityID = mysql_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $CityID = $row['CityID'];
                        }


                        $q = "INSERT INTO address(
					StreetName, StreetNumber,
					StreetCode,
					Bl, Sc, Et, Ap,
					CityID
						)
							VALUES (
					'" . trim($info[25]) . "','" . trim($info[26]) . "',
					'" . trim($info[27]) . "',
					'" . trim($info[28]) . "','" . trim($info[29]) . "','" . trim($info[30]) . "','" . trim($info[31]) . "',
					'" . $CityID . "'
							)";

                        $conn->query($q);

                        $AddressID = $conn->get_insert_id();

                        switch ($info[79]) {
                            case "Activ":
                                $StatusAngajat = 2; // Angajat
                                break;
                            case "Incetat":
                                $StatusAngajat = 6; // Plecat
                                break;
                            default:
                                $StatusAngajat = 8; // importat;
                                break;
                        }

                        $q = "INSERT INTO persons(
						UserID, CreateDate, LastUpdateDate, RoleID, Status, AddressID,
						LastName, FirstName, 
						FullName, 
						CNP, 
						Phone,
						Nationality, Country

						 )
                     			 VALUES(
                     			 {$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, 15, '" . $StatusAngajat . "', '" . $AddressID . "',
                     			 '" . trim($info[2]) . "','" . trim($info[3]) . "'," . "
                     			 '" . trim($info[3]) . ' ' . trim($info[2]) . "',
								 '" . trim($info[22]) . "',
								 '" . trim($info[33]) . "',
								 '181','181'



                     			 )";

                        $conn->query($q);
                        $PersonID = $conn->get_insert_id();

                        switch ($info[75]) {
                            case "Nedeterminata":
                                $TipContract = 2;
                                break;
                            case "Determinata":
                                $TipContract = 1;
                                break;
                            case "Suspendata";
                                $TipContract = 3;
                                break;
                            default:
                                $TipContract = 0;
                                break;
                        }

                        $q = "select * from nom_cor where Cod='" . trim($info[78]) . "'";
                        $conn->query($q);
                        $row = $conn->fetch_array();
                        $CorID = $row['Id'];

                        $q = "select * from functions where COR='" . trim($info[78]) . "'";
                        $res = $conn->query($q);
                        if (!mysql_num_rows($res)) {
                            $q = "insert into functions 
							(Function, COR, Status, CreateDate)
							VALUES
							('" . $row['Nume'] . "','" . $row['Cod'] . "','1',NOW())
							";
                            $conn->query($q);
                            $FunctionID = $conn->get_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $FunctionID = $row['FunctionID'];
                        }

                        $q = "INSERT INTO persons_functions
							(
							UserID, PersonID,
							FunctionID,
							StartDate,
							EndDate,
							CreateDate, LastUpdateDate
							)
							VALUES
							(
							{$_SESSION['USER_ID']},'" . $PersonID . "',
							'" . $FunctionID . "',
							'" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "',
							'" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "',
							 CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
							)";

                        $conn->query($q);

                        switch ($info[36]) {
                            case "TM":
                                $HeathCompanyID = 42;
                                break;
                            default:
                                $HeathCompanyID = 42;
                                break;
                        }

                        $q = "insert into banks
							(
							UserID,
							BankAccount
							)
							VALUES
							(
                     		 {$_SESSION['USER_ID']},
							'" . trim($info[63]) . "'
							)";

                        $conn->query($q);
                        $BankID = $conn->get_insert_id();


                        $q = "INSERT INTO payroll(
							UserID, 
							PersonID, 
							CreateDate, LastUpdateDate,
							StartDate, 
							StopDate,
							ContractDate,
							ContractType,
							Law,
							WorkNorm,
							WorkGroup,
							HealthCompanyID,
							BankID,
							CompanyID,
							ContractNo,
							FunctionID
							)
                     			 VALUES(
                     			 {$_SESSION['USER_ID']},
                     			 '" . $PersonID . "'," . "
								   CURRENT_TIMESTAMP, CURRENT_TIMESTAMP,
								'" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "',
								'" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "',
								'" . (strtotime(trim($info[35])) > '0' ? date("Y-m-d", strtotime(trim($info[35]))) : '') . "',
								'" . $TipContract . "',
								'" . trim($info[83]) . "',
								'" . trim($info[9]) . "',
								'" . trim($info[12]) . "',
								'" . $HeathCompanyID . "',
								'" . $BankID . "',
								'" . $_POST['CompanyID'] . "',
								'" . trim($info[34]) . "',
								'" . $FunctionID . "'
                     			 )";

                        $conn->query($q);


                        switch ($info[79]) {
                            case "Activ":
                                $StatusAngajat = 2;
                                break;
                            case "Incetat":
                                $StatusAngajat = 6;
                                break;
                            default:
                                $StatusAngajat = NULL;
                                break;
                        }

                        $q = "INSERT INTO vacations
							(
							UserID, 
							PersonID,
							Year,
							TotalCO,
							TotalCORef
							)
							VALUES
							(
                     			 {$_SESSION['USER_ID']},
								 '" . $PersonID . "',
								 '2014',
								 '" . trim($info[17]) . "',
								 '21'
							)
							";

                        $conn->query($q);


                        $q = "INSERT INTO persons_salary
							(
							UserID, 
							PersonID,
							Salary,
							Currency,
							StartDate,
							StopDate,
							CreateDate, LastUpdateDate
							)
							VALUES
							(
							{$_SESSION['USER_ID']},
							'" . $PersonID . "',
							'" . trim($info[20]) . "',
							'RON',
							'" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "',
							'" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "',
							CURRENT_TIMESTAMP, CURRENT_TIMESTAMP
							)
							";

                        $conn->query($q);


                        $q = "INSERT INTO persons_contracts
								(
								UserID, 
								PersonID,
								ContractNo,
								ContractDate,
								StartDate,
								StopDate,
								ContractType,
								Status
								)
								VALUES (
			       				{$_SESSION['USER_ID']},
								'" . $PersonID . "',
								'" . trim($info[34]) . "',
								'" . (strtotime(trim($info[35])) > '0' ? date("Y-m-d", strtotime(trim($info[35]))) : '') . "',
								'" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "',
								'" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "',
								'" . $contractType . "',
								'" . $StatusAngajat . "'
								)
						";

                        $conn->query($q);

                    } // if numrows
                    else {
                        $row = $conn->fetch_array();
                        $PersonID = $row['PersonID'];
                        $PayrollID = $row['PayRollID'];
                        $AddressID = $row['AddressID'];
                        $BankID = $row['BankID'];
                        //print_r($PayrollID);

                        //			echo "TRE SA FAC UPDATE <br /><br />";


                        $q = "select * from address_district 
						where DistrictName='" . trim($info[23]) . "'";
                        $res = $conn->query($q);

                        if (!mysql_num_rows($res)) {
                            $conn->query("insert into address_district (DistrictName) values('" . trim($info[23]) . "')");
                            $DistrictID = mysql_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $DistrictID = $row['DistrictID'];
                        }
                        $q = "select * from address_city
						where 
						DistrictID='" . $DistrictID . "'
						and CityName='" . trim($info[24]) . "'";
                        $res = $conn->query($q);
                        if (!mysql_num_rows($res)) {
                            $conn->query("insert into address_city (CityName, DistrictID) values('" . trim($info[24]) . "','" . $DistrictID . "')");
                            $CityID = mysql_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $CityID = $row['CityID'];
                        }
                        $fields = '';
                        if (strlen(trim($info[25])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StreetName='" . trim($info[25]) . "'";
                        }
                        if (strlen(trim($info[26])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StreetNumber='" . trim($info[26]) . "'";
                        }
                        if (strlen(trim($info[27])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StreetCode='" . trim($info[27]) . "'";
                        }
                        if (strlen(trim($info[28])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Bl='" . trim($info[28]) . "'";
                        }
                        if (strlen(trim($info[29])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Sc='" . trim($info[29]) . "'";
                        }
                        if (strlen(trim($info[30])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Et='" . trim($info[30]) . "'";
                        }
                        if (strlen(trim($info[31])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Ap='" . trim($info[31]) . "'";
                        }
                        if (strlen($CityID) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "CityID='" . $CityID . "'";
                        }

                        if ($fields != '') {
                            $q = "UPDATE address
                                                    set " . $fields .
                                " WHERE
                                                            AddressID=' " . $AddressID . "'
                                                    ";


                            $conn->query($q);

                            $AddressID = $conn->get_insert_id();
                        } else
                            die($conn->mysql_error());
                        // end stefan
                        switch ($info[79]) {
                            case "Activ":
                                $StatusAngajat = 2; // Angajat
                                break;
                            case "Incetat":
                                $StatusAngajat = 6; // Plecat
                                break;
                            default:
                                $StatusAngajat = 8; // importat;
                                break;
                        }
                        $fields = '';
                        if (strlen(trim($info[2])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "LastName='" . trim($info[2]) . "'";
                        }
                        if (strlen(trim($info[3])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "FirstName='" . trim($info[3]) . "'";
                        }
                        if (strlen(trim($info[3]) . ' ' . trim($info[2])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "FullName='" . trim($info[3]) . ' ' . trim($info[2]) . "'";
                        }
                        if (strlen(trim($info[22])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "CNP='" . trim($info[22]) . "'";
                        }
                        if (strlen(trim($info[33])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Phone='" . trim($info[33]) . "'";
                        }
                        if (strlen($StatusAngajat) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Status='" . $StatusAngajat . "'";
                        }


                        if ($fields != '') {
                            $q = "UPDATE persons
						SET " . $fields .
                                " WHERE
							PersonID='" . $PersonID . "'
							";


                            $conn->query($q);
                        }
                        switch ($info[75]) {
                            case "Nedeterminata":
                                $TipContract = 2;
                                break;
                            case "Determinata":
                                $TipContract = 1;
                                break;
                            case "Suspendata";
                                $TipContract = 3;
                                break;
                            default:
                                $TipContract = 0;
                                break;
                        }


                        $q = "select * from nom_cor where Cod='" . trim($info[78]) . "'";
                        $conn->query($q);
                        $row = $conn->fetch_array();
                        $CorID = $row['Id'];

                        $q = "select * from functions where COR='" . trim($info[78]) . "'";
                        $res = $conn->query($q);
                        if (!mysql_num_rows($res)) {
                            $q = "insert into functions 
							(Function, COR, Status, CreateDate)
							VALUES
							('" . $row['Nume'] . "','" . $row['Cod'] . "','1',NOW())
							";
                            $conn->query($q);
                            $FunctionID = $conn->get_insert_id();
                        } else {
                            $row = $conn->fetch_array();
                            $FunctionID = $row['FunctionID'];
                        }
                        $q = "UPDATE persons_functions
							set
                                                                
								FunctionID='" . $FunctionID . "'
							where
								PersonID='" . $PersonID . "'
								";

                        $conn->query($q);
                        print_r($q);
                        switch ($info[36]) {
                            case "TM":
                                $HeathCompanyID = 42;
                                break;
                            default:
                                $HeathCompanyID = 42;
                                break;
                        }

                        $fields = '';
                        if (strlen(trim($info[63])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "BankAccount='" . trim($info[63]) . "'";
                        }
                        if ($fields != '') {

                            $q = "UPDATE banks
							set " . $fields .
                                " where
						BankId='" . $BankID . "'
						";


                            $conn->query($q);
                        }
                        $fields = '';
                        if (strlen($TipContract) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractType='" . $TipContract . "'";
                        }
                        if (strlen(trim($info[83])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Law='" . trim($info[83]) . "'";
                        }
                        if (strlen(trim($info[9])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "WorkNorm='" . trim($info[9]) . "'";
                        }
                        if (strlen(trim($info[12])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "WorkGroup='" . trim($info[12]) . "'";
                        }
                        if (strlen($HeathCompanyID) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "HealthCompanyID='" . $HeathCompanyID . "'";
                        }
                        if (strlen(trim($info[6])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StartDate='" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "'";
                        }
                        if (strlen(trim($info[45])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StopDate='" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "'";
                        }
                        if (strlen(trim($info[35])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractDate='" . (strtotime(trim($info[35])) > '0' ? date("Y-m-d", strtotime(trim($info[35]))) : '') . "'";
                        }
                        if (strlen(trim($info[34])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractNo='" . trim($info[34]) . "'";
                        }
                        if (strlen($FunctionID) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "FunctionID='" . $FunctionID . "'";
                        }

                        if ($fields != '') {
                            $q = "UPDATE payroll
							set " . $fields .
                                " where
								PayRollID='" . $PayrollID . "'
								";

                            $conn->query($q);
                            //print_r($q); die();
                        }
                        switch ($info[79]) {
                            case "Activ":
                                $StatusAngajat = 2;
                                break;
                            case "Incetat":
                                $StatusAngajat = 6;
                                break;
                            default:
                                $StatusAngajat = NULL;
                                break;
                        }
                        $fields = '';
                        if (strlen(trim($info[17])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "TotalCO='" . trim($info[17]) . "'";
                        }
                        if ($fields != "") {
                            $q = "update vacations
							set " . $fields .
                                " where
								PersonID='" . $PersonID . "'
							";


                            $conn->query($q);
                        }

                        $fields = '';
                        if (strlen(trim($info[20])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Salary='" . trim($info[20]) . "'";
                        }
                        if (strlen(trim($info[6])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StartDate='" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "'";
                        }
                        if (strlen(trim($info[45])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StopDate='" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "'";
                        }


                        if ($fields != "") {
                            $q = "update persons_salary
							set " . $fields .
                                " where
								PersonID='" . $PersonID . "'
							";


                            $conn->query($q);
                        }

                        $fields = '';
                        if (strlen(trim($info[34])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractNo='" . trim($info[34]) . "'";
                        }
                        if (strlen(trim($info[35])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractDate='" . (strtotime(trim($info[35])) > '0' ? date("Y-m-d", strtotime(trim($info[35]))) : '') . "'";
                        }
                        if (strlen(trim($info[6])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StartDate='" . (strtotime(trim($info[6])) > '0' ? date("Y-m-d", strtotime(trim($info[6]))) : '') . "'";
                        }
                        if (strlen(trim($info[45])) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "StopDate='" . (strtotime(trim($info[45])) > '0' ? date("Y-m-d", strtotime(trim($info[45]))) : '') . "'";
                        }
                        if (strlen($contractType) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "ContractType='" . $contractType . "'";
                        }
                        if (strlen($StatusAngajat) > 0) {
                            $fields .= ($fields != '' ? ", " : "") . "Status='" . $StatusAngajat . "'";
                        }

                        if (!empty($fields)) {
                            $q = "update persons_contracts
							set " . $fields .
                                " where
								PersonID='" . $PersonId . "'
							";


                            $conn->query($q);
                        }
                    }
                }
            }

//	die(); // stefan
        }
        unset($_SESSION['_PersonImportData']);
    }

    public static function ImportCandExt($info_arr = array(), $info_arrPost = array())
    {
        global $conn;
        $size = count($info_arrPost);
        if ($size != 0) {
            $randuri = 1;
            foreach ($info_arrPost as $infoPost) {
                $randuri++;
                $info = $info_arr[$randuri];
                //echo "<pre>"; print_r($infoPost); echo"</pre>";
                //echo "<pre>"; print_r($info); echo"</pre>";
                //die();

                if ($infoPost[0] == 1)
                    if (empty($info[2])) {
                        throw new Exception(Message::getMessage('XLS_FULLNAME_EMPTY'));
                    }

                if ($infoPost[0] == 1) // Verificam daca e bifat
                {

                    $q = "select * from candidate_cv cv
						where cv.Email='" . trim($info[5]) . "' limit 1";

                    $res = $conn->query($q);

                    if (!mysql_num_rows($res)) {
                        $tmp['nume'] = explode(" ", trim($info[2]));
                        $tmp['LastName'] = $tmp['nume'][0];
                        $tmp['FirstName'] = '';
                        for ($i = 1; $i < count($tmp['nume']); $i++)
                            $tmp['FirstName'] .= $tmp['nume'][$i];
                        $auxAppDate = date("Y-m-d", strtotime(trim($info[18])));
                        $q = "insert 
							into 
								candidate_cv
							(PostId, SourceId,
								LastName, FirstName, Email,
								Phone, Gender,
								Url, Age, LastCompany, Experience, LastWorkPlace, ApplyDate)
							VALUES
							('" . $_POST['PostId'] . "','" . $_POST['SourceId'] . "',
								'" . $tmp['LastName'] . "','" . $tmp['FirstName'] . "','" . trim($info[5]) . "',
								'" . trim($info[7]) . "','" . trim($info[4]) . "',
								'" . trim($info[1]) . "','" . trim($info[6]) . "','" . trim($info[8]) . "','" . trim($info[9]) . "','" . trim($info[10]) . "','" . $auxAppDate . "')";
                        $conn->query($q);
                        $CvId = $conn->get_insert_id();

                        $q = "select * from candidate_city where CityName='" . trim($info[3]) . "'";
                        $res = $conn->query($q);
                        if (mysql_num_rows($res)) {
                            $row = $conn->fetch_array();
                            $CityId = $row['CityId'];
                        } else {
                            $q = "insert into candidate_city (CityName) values ('" . trim($info[3]) . "')";
                            $conn->query($q);
                            $CityId = $conn->get_insert_id();
                        }

                        $q = "insert into candidate_address (CvId, CityId) values ('" . $CvId . "','" . $CityId . "')";
                        $conn->query($q);

                        $q = "insert into candidate_education (CvId, Studies) values ('" . $CvId . "','" . trim($info[11]) . "')";
                        $conn->query($q);

                        if ((trim($info[12]) != "") && (trim($info[12]) != "-")) {
                            switch (trim($info[13])) {
                                case 'Avansat':
                                    $LevelId1 = 4;
                                    break;
                                case 'Mediu':
                                    $LevelId1 = 2;
                                    break;
                                case 'Incepator':
                                    $LevelId1 = 1;
                                    break;
                                default:
                                    $LevelId1 = '';
                                    break;
                            }
                            $q = "select * from candidate_language where LanguageName='" . trim($info[12]) . "'";
                            $res = $conn->query($q);
                            if (mysql_num_rows($res)) {
                                $row = $conn->fetch_array();
                                $LangId1 = $row['LanguageId'];
                            } else {
                                $q = "insert into candidate_language (LanguageName) values ('" . trim($info[12]) . "')";
                                $conn->query($q);
                                $LangId1 = $conn->get_insert_id();
                            }
                            $q = "insert into candidate_foreignlanguage (CvId, LanguageId, WriteLevelId, ReadLevelId, SpeakLevelId)
						values ('" . $CvId . "','" . $LangId1 . "','" . $LevelId1 . "','" . $LevelId1 . "','" . $LevelId1 . "')";
                            $conn->query($q);
                        }

                        if ((trim($info[14]) != "") && (trim($info[14]) != "-")) {
                            switch (trim($info[15])) {
                                case 'Avansat':
                                    $LevelId2 = 4;
                                    break;
                                case 'Mediu':
                                    $LevelId2 = 2;
                                    break;
                                case 'Incepator':
                                    $levelId2 = 1;
                                    break;
                                default:
                                    $LevelId2 = '';
                                    break;
                            }
                            $q = "select * from candidate_language where LanguageName='" . trim($info[14]) . "'";
                            $res = $conn->query($q);
                            if (mysql_num_rows($res)) {
                                $row = $conn->fetch_array();
                                $LangId2 = $row['LanguageId'];
                            } else {
                                $q = "insert into candidate_language (LanguageName) values ('" . trim($info[14]) . "')";
                                $conn->query($q);
                                $LangId2 = $conn->get_insert_id();
                            }
                            $q = "insert into candidate_foreignlanguage (CvId, LanguageId, WriteLevelId, ReadLevelId, SpeakLevelId)
						values ('" . $CvId . "','" . $LangId2 . "','" . $LevelId2 . "','" . $LevelId2 . "','" . $LevelId2 . "')";
                            $conn->query($q);
                        }

                        if ((trim($info[16]) != "") && (trim($info[16]) != "-")) {
                            switch (trim($info[16])) {
                                case 'Avansat':
                                    $LevelId3 = 4;
                                    break;
                                case 'Mediu':
                                    $LevelId3 = 2;
                                    break;
                                case 'Incepator':
                                    $LevelId3 = 1;
                                    break;
                                default:
                                    $LevelId3 = '';
                                    break;
                            }
                            $q = "select * from candidate_language where LanguageName='" . trim($info[16]) . "'";
                            $res = $conn->query($q);
                            if (mysql_num_rows($res)) {
                                $row = $conn->fetch_array();
                                $LangId3 = $row['LanguageId'];
                            } else {
                                $q = "insert into candidate_language (LanguageName) values ('" . trim($info[16]) . "')";
                                $conn->query($q);
                                $LangId3 = $conn->get_insert_id();
                            }
                            $q = "insert into candidate_foreignlanguage (CvId, LanguageId, WriteLevelId, ReadLevelId, SpeakLevelId)
						values ('" . $CvId . "','" . $LangId3 . "','" . $LevelId3 . "','" . $LevelId3 . "','" . $LevelId3 . "')";
                            $conn->query($q);
                        }

                    } // if !numrows (persoana noua)

                }
            }

//	die(); // stefan
        }
    }

    public static function getSalaryData($path)
    {
        $data = new Spreadsheet_Excel_Reader($path);
        for ($j = 1; $j <= $data->colcount(); $j++) {
            for ($i = 1; $i <= $data->rowcount(); $i++) {
                self::$PersonImportSalaryData[$i][$j] = $data->value($i, $j);
            }
        }

    }

    public static function ImportSalaryData($info_arr = array())
    {
        global $conn;
        $size = count($info_arr);
        if ($size != 0) {
            foreach ($info_arr as $info) {
                /*
				if (empty($info[2])) {
            		throw new Exception(Message::getMessage('XLS_FULLNAME_EMPTY'));
        		}

        		if (!empty($info[3])) {
        			if(!Utils::checkEmail(trim($info[3])))
             		throw new Exception(Message::getMessage('XLS_EMAIL_ERROR'));
      			}
      			*/
                if ($info[0] == 1) { // Verificam daca e bifat
                    //format date
                    list($month, $day, $year) = split('/', trim($info[4]));
                    $date = $year . '-' . $month . '-' . $day;
                    if (trim($info[1]) != "")
                        $PersonIDQ = "(SELECT PersonID FROM payroll WHERE EmpCode='" . trim($info[1]) . "'),";
                    if (trim($info[2]) != "")
                        $PersonIDQ = "(SELECT PersonID FROM persons WHERE CNP='" . trim($info[2]) . "'),";

                    $conn->query("INSERT INTO persons_salary(UserID, PersonID, Salary, Currency, StartDate, CreateDate, LastUpdateDate)
                     			 VALUES(
                     			 {$_SESSION['USER_ID']},
								" . $PersonIDQ . "
								 '" . trim($info[3]) . "'," . "
                     			 'RON',
                     			 '$date'
        						 , CURRENT_TIMESTAMP
                     			 , CURRENT_TIMESTAMP
                     			 )");

                }
            }
        }
    }

    //without inactives: status NOT IN (6, 5, 11, 10, 3, 1)

    public static function getAvansData($path)
    {
        $data = new Spreadsheet_Excel_Reader($path);
        for ($j = 1; $j <= $data->colcount(); $j++) {
            for ($i = 1; $i <= $data->rowcount(); $i++) {
                self::$PersonImportAvansData[$i][$j] = $data->value($i, $j);
            }
        }

    }

    public static function ImportAvansData($info_arr = array())
    {
        global $conn;
        $size = count($info_arr);
        if ($size != 0) {
            foreach ($info_arr as $info) {
                $cnp = trim($info[1]);
                if ($info[0] == 1 && !empty($cnp)) { // Verificam daca e bifat + cnp ok
                    //format date
                    list($month, $day, $year) = split('/', trim($info[3]));
                    $date = $year . '-' . $month . '-' . $day;

                    if (empty($year) || empty($month) || empty($day)) continue;

                    $personID = 0;
                    $conn->query("SELECT PersonID FROM persons WHERE CNP='" . $cnp . "'");
                    if ($row = $conn->fetch_array()) {
                        $personID = $row['PersonID'];
                    }

                    if ($personID == 0) continue;

                    $conn->query("INSERT INTO persons_salary_extra(UserID, PersonID, SalaryNet, Currency, StartDate, Type, CreateDate, LastUpdateDate)
                     			 VALUES(
                     			 {$_SESSION['USER_ID']},
                     			 '$personID', 
                     			 '" . trim($info[2]) . "'," . "
                     			 'RON',
                     			 '$date',
								 'avans',
        						 CURRENT_TIMESTAMP,
                     			 CURRENT_TIMESTAMP
                     			 )");

                }
            }
        }
    }

    public static function getPrimeData($path)
    {
        $data = new Spreadsheet_Excel_Reader($path);
        for ($j = 1; $j <= $data->colcount(); $j++) {
            for ($i = 1; $i <= $data->rowcount(); $i++) {
                self::$PersonImportPrimeData[$i][$j] = $data->value($i, $j);
            }
        }

    }

    public static function ImportPrimeData($info_arr = array())
    {
        global $conn;
        $size = count($info_arr);
        if ($size != 0) {
            foreach ($info_arr as $info) {
                $cnp = trim($info[1]);
                if ($info[0] == 1 && !empty($cnp)) { // Verificam daca e bifat + cnp
                    //format date
                    list($month, $day, $year) = split('/', trim($info[3]));
                    $date = $year . '-' . $month . '-' . $day;

                    if (empty($year) || empty($month) || empty($day)) continue;

                    $personID = 0;
                    $conn->query("SELECT PersonID FROM persons WHERE CNP='" . $cnp . "'");
                    if ($row = $conn->fetch_array()) {
                        $personID = $row['PersonID'];
                    }

                    if ($personID == 0) continue;

                    $conn->query("INSERT INTO persons_salary_extra(UserID, PersonID, Salary, Currency, StartDate, Type, CreateDate, LastUpdateDate)
                     			 VALUES(
                     			 {$_SESSION['USER_ID']},
                     			 '$personID', 
                     			 '" . trim($info[2]) . "'," . "
                     			 'RON',
                     			 '$date',
								 'bonus_prime',
        						 CURRENT_TIMESTAMP,
                     			 CURRENT_TIMESTAMP
                     			 )");
                }
            }
        }
    }

    public static function importCharisma()
    {

        global $conn;

        // tb sa fie pus pe server extensia php_mssql pt conectarea cu ms sql
        $handle = mssql_connect(Config::MSSQL_HOST, Config::MSSQL_USER, Config::MSSQL_PASS) or die("Cannot connect to server");
        $db = mssql_select_db(Config::MSSQL_DBNAME, $handle) or die("Cannot select database");
        $query = "SELECT 
                            STATUS_CURRENT, 
                            EmployeeState_Current, 
                            EmployeeState_Histo,
                            CityName,
                            County,
                            IsCurrent,
                            StreetName,
                            StreetNo,
                            BLOCK,
                            ENTRANCE,
                            AddressFloor,
                            Apartament,
                            AddressRegion,
                            PayCenterName,
                            LastName,
                            FirstName,
                            Maiden_Name,
                            Nationality,
                            Home_Country,
                            Digit_Code,
                            Gender,
                            PhoneInterior,
                            PersMobile,
                            Email
                        FROM
                            dbo.UVW_HRExecutive_Personal_Data pd
                                INNER JOIN
                            dbo.UVW_HRExecutive_Person_Position_Localization ppd ON pd.Person_Id = ppd.Person_Id
                                INNER JOIN
                            dbo.UVW_HRExecutive_Person_Address pa ON pd.Person_Id = pa.Person_Id
                                INNER JOIN
                            dbo.UVW_HRExecutive_EmployeeState es ON pd.Person_Id = es.Person_Id";
        $result = mssql_query($query);

        // Iterate over results
        while ($row = mssql_fetch_array($result)) {
            $persons[] = $row;
        }
        foreach ($persons as $person) {
            $CNP = trim($person['Digit_Code']);
            $query = "SELECT * FROM persons p WHERE p.CNP='$CNP' LIMIT 1";
            $conn->query($query);
            $isCNPused = $conn->fetch_array();
            if (!$isCNPused) {// daca nu gasesc nici o persoana cu acest CNP fac insert

                if (!empty($person['STATUS_CURRENT']) && in_array(trim($person['STATUS_CURRENT']), ConfigData::$msStatus)) {//
                    $Status = array_search($person['STATUS_CURRENT'], ConfigData::$msStatus);
                } else {
                    $Status = "";
                }

                $query = "INSERT INTO persons SET "
                    . "FirstName='" . trim($person['FirstName']) . "',"
                    . "LastName='" . trim($person['LastName']) . "',"
                    . "FullNameBeforeMariage='" . trim($person['Maiden_Name']) . "',"
                    . "Nationality='" . trim($person['Nationality']) . "'," // de luat denumirea
                    . "Country='" . trim($person['Home_Country']) . "',"  // de luat denumirea
                    . "CNP='" . trim($person['Digit_Code']) . "',"
                    . "Sex='" . trim($person['Gender']) . "',"
                    . "PhoneInt='" . trim($person['PhoneInterior']) . "',"
                    . "Status='" . $Status . "',"
                    . "MobilePersonal='" . trim($person['PersMobile']) . "',"
                    . "Email='" . trim($person['Email']) . "'";
                $conn->query($query);
                $PersonID = mysql_insert_id();
                if (!empty($person['CityName'])) {// daca am cityname introduc o noua adresa in tabela address
                    $query = "select * from address_city
                                        where CityName='" . trim($person['CityName']) . "'";
                    $res = $conn->query($query);

                    if (!mysql_num_rows($res)) {// daca nu am orasul verific mai departe daca am judetul
                        $res = $conn->query("select * from address_district where DistrictName='{$person['County']}'");
                        if (mysql_num_fields($res) > 0) {
                            $row = $conn->fetch_array();
                            $DistrictID = $row['DistrictName'];
                        } else {
                            $conn->query("insert into address_district (DistrictName) values('" . trim($person['County']) . "')");
                            $DistrictID = mysql_insert_id();
                        }

                        $conn->query("insert into address_city (DistrictID, CityName) values('" . trim($DistrictID) . "" . trim($person['CityName']) . "')");
                        $CityID = mysql_insert_id();
                    } else {// daca am orasul in dictionarul de orase
                        $row = $conn->fetch_array();
                        $DistrictID = $row['DistrictID'];
                        $CityID = $row['CityID'];
                    }

                    $query = "INSERT INTO address SET "
                        . "CityID='" . $CityID . "',"
                        . "StreetName='" . trim($person['StreetName']) . "',"
                        . "StreetNumber='" . trim($person['StreetNo']) . "',"
                        . "Bl='" . trim($person['BLOCK']) . "',"
                        . "Sc='" . trim($person['ENTRANCE']) . "',"
                        . "Et='" . trim($person['AddressFloor']) . "',"
                        . "Ap='" . trim($person['Apartament']);
                    $conn->query($query);
                    $AddressID = mysql_insert_id();
                    // asociez adresa introdusa cu persoana
                    $conn->query("update persons set AddressID = '{$AddressID}' where PersonID='{$PersonID}'");

                }

                if (!empty($person['PayCenterName'])) {
                    $res = $conn->query("select * from costcenter where CostCenter='{$person['PayCenterName']}'");
                    if (mysql_num_rows($res)) {//dc am definit costcenter-ul respectiv iau ID-ul
                        $row = $conn->fetch_array();
                        $CostCenterID = $row['CostCenterID'];
                    } else {// daca nu fac insert si iau ID
                        $conn->query("insert into costcenter(Costcenter) values({$person['PayCenterName']})");
                        $CostCenterID = mysql_insert_id();
                    }
                    // fac insert de payroll_costcenter
                    $conn->query("insert into payroll_costcenter(PersonID,CostCenterID) values($PersonID,$CostCenterID)");
                }

                if (!empty($person['STATUS_CURRENT']) //fac insert pt leaveDate
                    && in_array($person['EmployeeState_Histo'], ConfigData::$msSubStatus[6])
                    && ($person['STATUS_CURRENT'] == 'Plecat' || $person['STATUS_CURRENT'] == 'Suspendat')
                    && !empty($PersonID)) {
                    $LeaveReason = array_search($person['EmployeeState_Current'], ConfigData::$msSubStatus[6]);
                    $conn->query("insert into payroll(PersonID,LeaveReason) values($PersonID, $LeaveReason)");
                }
            } else {// daca am deja o persoana cu CNP-ul asta fac update
                $CNP = trim($isCNPused['CNP']);
                if (!empty($person['STATUS_CURRENT']) && in_array(trim($person['STATUS_CURRENT']), ConfigData::$msStatus)) {//
                    $Status = array_search($person['STATUS_CURRENT'], ConfigData::$msStatus);
                } else {
                    $Status = "";
                }

                $query = "UPDATE persons SET "
                    . "FirstName='" . trim($person['FirstName']) . "',"
                    . "LastName='" . trim($person['LastName']) . "',"
                    . "FullNameBeforeMariage='" . trim($person['Maiden_Name']) . "',"
                    . "Nationality='" . trim($person['Nationality']) . "'," // de luat denumirea
                    . "Country='" . trim($person['Home_Country']) . "',"  // de luat denumirea
                    . "Sex='" . trim($person['Gender']) . "',"
                    . "PhoneInt='" . trim($person['PhoneInterior']) . "',"
                    . "Status='" . $Status . "',"
                    . "MobilePersonal='" . trim($person['PersMobile']) . "',"
                    . "Email='" . trim($person['Email']) . "'"
                    . "WHERE CNP='{$CNP}'";
                $conn->query($query);
                // iau PersonID pentru randul pe care l-am updatat
                $conn->query("Select PersonID from persons where CNP=$CNP");
                $row = $conn->fetch();
                $PersonID = $row['PersonID'];

                if (!empty($person['CityName'])) {// daca am cityname introduc o noua adresa in tabela address
                    $query = "select * from address_city
                                        where CityName='" . trim($person['CityName']) . "'";
                    $res = $conn->query($query);

                    if (!mysql_num_rows($res)) {// daca nu am orasul verific mai departe daca am judetul
                        $res = $conn->query("select * from address_district where DistrictName='{$person['County']}'");
                        if (mysql_num_fields($res) > 0) {
                            $row = $conn->fetch_array();
                            $DistrictID = $row['DistrictName'];
                        } else {
                            $conn->query("insert into address_district (DistrictName) values('" . trim($person['County']) . "')");
                            $DistrictID = mysql_insert_id();
                        }

                        $conn->query("insert into address_city (DistrictID, CityName) values('" . trim($DistrictID) . "" . trim($person['CityName']) . "')");
                        $CityID = mysql_insert_id();
                    } else {// daca am orasul in dictionarul de orase
                        $row = $conn->fetch_array();
                        $DistrictID = $row['DistrictID'];
                        $CityID = $row['CityID'];
                    }
                    // iau AddressID din persons
                    $conn->query("select AddressID from persons where PersonID='$PersonID'");
                    $row = $conn->fetch_array();
                    $AddressID = $row['AddressID'];
                    if (!empty($AddressID)) {// daca persoana pentru care se face update are o adresa asociata face update la acea adresa
                        $query = "UPDATE address SET "
                            . "CityID='" . $CityID . "',"
                            . "StreetName='" . trim($person['StreetName']) . "',"
                            . "StreetNumber='" . trim($person['StreetNo']) . "',"
                            . "Bl='" . trim($person['BLOCK']) . "',"
                            . "Sc='" . trim($person['ENTRANCE']) . "',"
                            . "Et='" . trim($person['AddressFloor']) . "',"
                            . "Ap='" . trim($person['Apartament'])
                            . "WHERE AddressID='$AddressID";
                        $conn->query($query);
                    } else {// daca persoana pentru care se face update nu are o adresa asociata facem insert si asociem
                        $query = "Insert into address SET "
                            . "CityID='" . $CityID . "',"
                            . "StreetName='" . trim($person['StreetName']) . "',"
                            . "StreetNumber='" . trim($person['StreetNo']) . "',"
                            . "Bl='" . trim($person['BLOCK']) . "',"
                            . "Sc='" . trim($person['ENTRANCE']) . "',"
                            . "Et='" . trim($person['AddressFloor']) . "',"
                            . "Ap='" . trim($person['Apartament']);
                        $conn->query($query);
                        $AddressID = mysql_insert_id();
                        // asociez adresa introdusa cu persoana
                        $conn->query("update persons set AddressID = '{$AddressID}' where PersonID='{$PersonID}'");
                    }

                }

                if (!empty($person['PayCenterName'])) {
                    $res = $conn->query("select * from costcenter where CostCenter='{$person['PayCenterName']}'");
                    if (mysql_num_rows($res)) {//dc am definit costcenter-ul respectiv iau ID-ul
                        $row = $conn->fetch_array();
                        $CostCenterID = $row['CostCenterID'];
                    } else {// daca nu fac insert si iau ID
                        $conn->query("insert into costcenter(Costcenter) values({$person['PayCenterName']})");
                        $CostCenterID = mysql_insert_id();
                    }
                    // fac update de payroll_costcenter
                    $conn->query("update payroll_costcenter CostCenterID='$CostCenterID' where PersonID='$PersonID'");
                }

                if (!empty($person['STATUS_CURRENT']) //fac update pt leaveDate
                    && in_array($person['EmployeeState_Histo'], ConfigData::$msSubStatus[6])
                    && ($person['STATUS_CURRENT'] == 'Plecat' || $person['STATUS_CURRENT'] == 'Suspendat')
                    && !empty($PersonID)) {
                    $LeaveReason = array_search($person['EmployeeState_Current'], ConfigData::$msSubStatus[6]);
                    $conn->query("update payroll set LeaveReason='$LeaveReason' where PersonID='$PersonID'");
                }
            }
        }
        // Close the connection
        mssql_close($handle);
    }

    public function addPerson($info = array())
    {
        $AddressID = $this->setData($info);

        unset($info['OldStatus']);

        global $conn;

        unset($info['oldMobile']);
        unset($info['oldMobileTerminal']);
        $mobile_terminal = $info['MobileTerminal'];
        unset($info['MobileTerminal']);

        $conn->query("INSERT INTO persons(UserID, AddressID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, $AddressID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        } else {
            $PersonID = $conn->get_insert_id();
            return $PersonID;
        }
    }

    private function setData(&$info)
    {
        global $conn, $smarty;
        foreach ($info as $k => &$v) {
            if (!is_numeric($v)) {
                $v = Utils::formatStr($v);
            }
            if (substr($k, 0, 5) == 'Child') {
                unset($info[$k]);
            }
        }

        if (!$info['LastName']) {
            throw new Exception(Message::getMessage('LASTNAME_EMPTY'));
        }
        if (!$info['FirstName']) {
            throw new Exception(Message::getMessage('FIRSTNAME_EMPTY'));
        }
        if (isset($info['CNP']) && $info['CNP'] == '') {
            throw new Exception(Message::getMessage('CNP_ERROR'));
        }
        if (!empty($info['CNP']) && !Utils::checkCNP($info['CNP'])) {
            throw new Exception(Message::getMessage('CNP_ERROR'));
        }
        if (!empty($info['CNP'])) {
            $conn->query("SELECT a.PersonID, a.FullName, c.CompanyName
	    		   FROM   persons a
	    		          LEFT JOIN payroll b ON a.PersonID = b.PersonID
	    		          LEFT JOIN companies c ON b.CompanyID = c.CompanyID
	    		   WHERE  a.CNP = '{$info['CNP']}'");
            if (($row = $conn->fetch_array()) && ($this->PersonID == 0 || $this->PersonID != $row['PersonID'])) {
                //throw new Exception(Message::getMessage('DUPLICATE_CNP'));
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                $params = array('label' => 'CNP-ul %s este deja alocat persoanei %s din compania %s', 'values' => array($info['CNP'], $row['FullName'], $row['CompanyName']));
                throw new Exception(smarty_function_translate($params, $smarty));
            }
        }
        if (!$info['DistrictID']) {
            throw new Exception(Message::getMessage('DISTRICT_EMPTY'));
        }
        if (!$info['CityID']) {
            throw new Exception(Message::getMessage('CITY_EMPTY'));
        }
        if ($info['Email'] && !Utils::checkEmail($info['Email'])) {
            throw new Exception(Message::getMessage('EMAIL_ERROR'));
        }
        if (isset($info['CPSameAddress']) && $info['CPSameAddress'] == 'yes')
            $info['CPSameAddress'] = 1;
        else
            $info['CPSameAddress'] = 0;

        $info['FullName'] = $info['LastName'] . ' ' . $info['FirstName'];
        $info['NumberOfChildren'] = (int)$info['NumberOfChildren'];
        //$info['DateOfBirth']    = '19' . $info['CNP']{1} . $info['CNP']{2} . '-' . $info['CNP']{3} . $info['CNP']{4} . '-' . $info['CNP']{5} . $info['CNP']{6};
        $info['DateOfBirth'] = !empty($info['DateOfBirth']) ? Utils::toDBDate($info['DateOfBirth']) : '';
        $info['BIStartDate'] = !empty($info['BIStartDate']) ? Utils::toDBDate($info['BIStartDate']) : '';
        $info['BIStopDate'] = !empty($info['BIStopDate']) ? Utils::toDBDate($info['BIStopDate']) : '';
        $info['CustomPerson3'] = !empty($info['CustomPerson3']) ? Utils::toDBDate($info['CustomPerson3']) : '';
        $info['CustomPerson4'] = !empty($info['CustomPerson4']) ? Utils::toDBDate($info['CustomPerson4']) : '';
        $info['CustomPerson5'] = !empty($info['CustomPerson5']) ? Utils::toDBDate($info['CustomPerson5']) : '';
        $info['CustomPerson6'] = !empty($info['CustomPerson5']) ? Utils::toDBDate($info['CustomPerson6']) : '';
        $CityID = (int)$info['CityID'];
        $conn->query("SELECT AddressID
	              FROM   address
		      WHERE  CityID = $CityID AND StreetName = '{$info['StreetName']}' AND
		             StreetCode = '{$info['StreetCode']}' AND StreetNumber = '{$info['StreetNumber']}' AND
			     Bl = '{$info['Bl']}' AND Sc = '{$info['Sc']}' AND Et = '{$info['Et']}' AND Ap = '{$info['Ap']}'");
        if ($row = $conn->fetch_array()) {
            $AddressID = $row['AddressID'];
            $conn->query("UPDATE address SET StreetName='{$info['StreetName']}', StreetCode='{$info['StreetCode']}', 
            						StreetNumber='{$info['StreetNumber']}',
            						Bl='{$info['Bl']}', Sc='{$info['Sc']}' , Et='{$info['Et']}', Ap='{$info['Ap']}'
            						WHERE  AddressID='$AddressID'");
        } else {
            $conn->query("INSERT INTO address(UserID, CityID, StreetName, StreetCode, StreetNumber, Bl, Sc, Et, Ap)
                    	  VALUES({$_SESSION['USER_ID']}, $CityID, '{$info['StreetName']}', '{$info['StreetCode']}', '{$info['StreetNumber']}', '{$info['Bl']}', '{$info['Sc']}', '{$info['Et']}', '{$info['Ap']}')");
            $AddressID = $conn->get_insert_id();
        }
        unset($info['DistrictID'], $info['CityID'], $info['StreetName'], $info['StreetCode'], $info['StreetNumber'], $info['Bl'], $info['Sc'], $info['Et'], $info['Ap']);
        return $AddressID;
    }

    // Editare date de baza Persoana
    public function editPerson($info = array())
    {

        $AddressID = $this->setData($info);

        global $conn;

        $update = '';
        $rw_stopdate = false;
        if (!empty($info['OldStatus']) && $info['OldStatus'] != $info['Status'] && in_array($info['OldStatus'], array(5, 6)) && !in_array($info['Status'], array(5, 6))) {
            $rw_stopdate = true;
        }
        unset($info['OldStatus']);


        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        if(!isset($info['Pensionat']))
            $update .= "Pensionat = '0', ";

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET $update AddressID = $AddressID, LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)");
        //echo "UPDATE persons a SET $update AddressID = $AddressID, LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)";var_dump($_POST);var_dump($update);die;
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        }
        if ($rw_stopdate) {
            $query = "INSERT INTO persons_contracts(UserID, PersonID, Status, SubStatus, StartDate, StopDate, LeaveReason, ContractType, 
                                                    ContractNo, ContractDate, ContractExpDate, ContractDismissalPeriod, ContractProbationPeriod, WorkNorm, SuspendDate, EstimateReturnDate, ReturnDate, CreateDate)
                      SELECT {$_SESSION['USER_ID']}, a.PersonID, b.Status, b.SubStatus, a.StartDate, a.StopDate, a.LeaveReason, a.ContractType, 
                             a.ContractNo, a.ContractDate, a.ContractExpDate, a.ContractDismissalPeriod, ContractProbationPeriod, a.WorkNorm, a.SuspendDate, a.EstimateReturnDate, a.ReturnDate, CURRENT_TIMESTAMP
                      FROM   payroll a
                             INNER JOIN persons b ON a.PersonID = b.PersonID
                      WHERE  a.PersonID = '{$this->PersonID}' AND ($condrw)";
            $conn->query($query);

            $conn->query("UPDATE payroll a SET StopDate = '0000-00-00', LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = '{$this->PersonID}' AND ($condrw)");
        }
    }

    public function getPerson()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.*, d.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   persons a
                         LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = b.CityID
                  WHERE  a.PersonID = {$this->PersonID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $hash = md5($row['PersonID']);
            if (file_exists('photos/persons/' . $hash . '.jpg')) {
                $row['photoBig'] = 'photos/persons/' . $hash . '.jpg?rn=' . rand(1, 99999999);
                if (!file_exists('photos/persons/' . $hash . '_100_100.jpg')) {
                    $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/persons/' . $hash . '.jpg', 100, 100);
                    rename('photos/_tmp/' . basename($resized), 'photos/persons/' . basename($resized));
                }
                $row['photo'] = 'photos/persons/' . $hash . '_100_100.jpg?rn=' . rand(1, 99999999);
            }
            if ((file_exists('uploads/cv/' . $row['PersonID'] . '.pdf')) )
            {
                $row['CVFileName'] = 'uploads/cv/' . $row['PersonID'] . '.pdf';
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function getPersonSummary()
    {

        global $conn;

        $query = "SELECT a.*, b.*, d.*
                  FROM   persons a
                         LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = b.CityID
                  WHERE  a.PersonID = {$this->PersonID} ";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $hash = md5($row['PersonID']);
            if (file_exists('photos/persons/' . $hash . '.jpg')) {
                $row['photoBig'] = 'photos/persons/' . $hash . '.jpg?rn=' . rand(1, 99999999);
                if (!file_exists('photos/persons/' . $hash . '_100_100.jpg')) {
                    $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/persons/' . $hash . '.jpg', 150, 200);
                    rename('photos/_tmp/' . basename($resized), 'photos/persons/' . basename($resized));
                }
                $row['photo'] = 'photos/persons/' . $hash . '_150_200.jpg?rn=' . rand(1, 99999999);
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function delPerson()
    {

        global $conn;

        $query = "DELETE
                  FROM   persons
                  WHERE  PersonID = {$this->PersonID} AND
                         {$_SESSION['USER_ID']} = 1 AND
                         NOT EXISTS(SELECT ConsultantID FROM events WHERE ConsultantID = {$this->PersonID}) AND
                         NOT EXISTS(SELECT PersonID FROM event_persons WHERE PersonID = {$this->PersonID}) AND
			 NOT EXISTS(SELECT PersonID FROM contract_persons WHERE PersonID = {$this->PersonID}) AND
                         NOT EXISTS(SELECT PersonID FROM trainings WHERE PersonID = {$this->PersonID}) AND
                         NOT EXISTS(SELECT PersonID FROM training_persons WHERE PersonID = {$this->PersonID})";
        $conn->query($query);
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Persoana nu poate fi stearsa deoarece este implicata in evenimente, training-uri sau contracte!'); window.location.href = './?m=persons';\"></body>";
            exit;
        } else {
            $query = "DELETE FROM persons_certif WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM persons_lang WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM persons_prof WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM persons_std WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM payroll WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM persons_children WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM vacations WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM vacations_details WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
        }
    }

    public function delPersonPhoto()
    {
        if (is_file('photos/persons/' . md5($this->PersonID) . '.jpg')) {
            @unlink('photos/persons/' . md5($this->PersonID) . '.jpg');
            @unlink('photos/persons/' . md5($this->PersonID) . '_100_100.jpg');
            @unlink('photos/_tmp/' . md5($this->PersonID) . '_100_100.jpg');
        }
    }

    public function delPersonCV()
    {
        if (is_file('uploads/cv/' . $this->PersonID . '.pdf')) {
            @unlink('uploads/cv/' . $this->PersonID . '.pdf');
        }
    }

    public function getProfData()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][3]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][3]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.*, b.StartDate, b.StopDate AS EndDate, c.Function, c.FunctionID AS InternalFunctionID, b.FunctionID AS FunctionID, b.DivisionID AS DivisionID,
                         CASE WHEN b.StartDate > '0000-00-00' AND b.StopDate > '0000-00-00' THEN DATEDIFF(b.StopDate, b.StartDate)
			      WHEN b.StartDate > '0000-00-00' THEN DATEDIFF(CURRENT_TIMESTAMP, b.StartDate) ELSE 0 END AS zile,
                         CASE WHEN $condrw THEN 1 ELSE 0 END AS rw, d.OGFile
                  FROM   persons a
                         LEFT JOIN payroll b ON a.PersonID = b.PersonID
                         LEFT JOIN companies d ON d.CompanyID = b.CompanyID
                         LEFT JOIN internal_functions c ON b.InternalFunction=c.FunctionID
                  WHERE  a.PersonID = {$this->PersonID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            /*
	    $row['years']   = floor($row['zile'] / 365);
	    $rest           = $row['zile'] % 365;
	    $row['months']  = floor($rest / 30);
	    $row['days']    = $rest % 30;
	    */

            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);
            $row['years'] = $arr[0];
            $row['months'] = $arr[1];
            $row['days'] = $arr[2];
            $_JobDictionaryID = explode(',', $row['JobDictionaryID']);
            $row['JobDictionaryID'] = array();
            foreach ($_JobDictionaryID as $_item) {
                $row['JobDictionaryID'][$_item] = $_item;
            }

            $_StudiiAbsolvite = explode(',', $row['StudiiAbsolvite']);
            $row['StudiiAbsolvite'] = array();
            foreach ($_StudiiAbsolvite as $_item) {
                $row['StudiiAbsolvite'][$_item] = $_item;
            }
//            Utils::_debug($row);


//de aici cip
            $conn->query("SELECT StartDate, StopDate AS EndDate, DATEDIFF(StopDate, StartDate) AS zile,
	                     DATE_FORMAT(StartDate, '%d.%m.%Y') AS DataIni, DATE_FORMAT(StopDate, '%d.%m.%Y') AS DataFin
	              FROM   vacations_details
	              WHERE  PersonID = " . $_GET['PersonID'] . " and Type='CFS'");
            $tzile = 0;
            while ($Arow = $conn->fetch_array()) {
                $tzile += $Arow['zile'];
            }
            if ($row['days'] < $tzile) {
                $row['days'] += 30;
                if ($row['months'] == 0) {
                    $row['months'] = 11;
                    $row['years'] -= 1;
                }
                $row['months'] -= 1;
            }
            $row['days'] -= $tzile;


            //pana aici cip

            $row['WorkTime'] = explode('/', $row['WorkTime']);

            // Create path to JD file
            if (!empty($row['JDFile']) && is_file('uploads/jd/' . $row['JDFile'])) {
                $row['JDFilePath'] = 'uploads/jd/' . $row['JDFile'];
            }
            if (!empty($row['OGFile']) && is_file('uploads/og/' . $row['OGFile'])) {
                $row['OGFilePath'] = 'uploads/og/' . $row['OGFile'];
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function getProfDataSummary()
    {

        global $conn;

        $query = "SELECT a.*, b.*, b.StartDate, b.StopDate AS EndDate, c.Function, c.FunctionID AS InternalFunctionID, b.FunctionID AS FunctionID, b.DivisionID AS DivisionID,
                         CASE WHEN b.StartDate > '0000-00-00' AND b.StopDate > '0000-00-00' THEN DATEDIFF(b.StopDate, b.StartDate)
			      WHEN b.StartDate > '0000-00-00' THEN DATEDIFF(CURRENT_TIMESTAMP, b.StartDate) ELSE 0 END AS zile,
                         d.OGFile
                  FROM   persons a
                         LEFT JOIN payroll b ON a.PersonID = b.PersonID
                         LEFT JOIN companies d ON d.CompanyID = b.CompanyID
                         LEFT JOIN internal_functions c ON b.InternalFunction=c.FunctionID
                  WHERE  a.PersonID = {$this->PersonID}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            /*
	    $row['years']   = floor($row['zile'] / 365);
	    $rest           = $row['zile'] % 365;
	    $row['months']  = floor($rest / 30);
	    $row['days']    = $rest % 30;
	    */
            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);
            $row['years'] = $arr[0];
            $row['months'] = $arr[1];
            $row['days'] = $arr[2];
            $row['WorkTime'] = explode('/', $row['WorkTime']);

            // Create path to JD file
            if (!empty($row['JDFile']) && is_file('uploads/jd/' . $row['JDFile'])) {
                $row['JDFilePath'] = 'uploads/jd/' . $row['JDFile'];
            }
            if (!empty($row['OGFile']) && is_file('uploads/og/' . $row['OGFile'])) {
                $row['OGFilePath'] = 'uploads/og/' . $row['OGFile'];
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function editPersonProf($info = array())
    {
            global $conn;

        if (!empty($_GET['action'])) {
            foreach ($_GET as &$v) {
                if (!is_numeric($v) && !is_array($v)) {
                    $v = Utils::formatStr($v);
                }
            }
            switch ($_GET['action']) {
                case 'new':
                    $conn->query("INSERT INTO persons_certif(UserID, PersonID, CertifName, CertifEmitent, CertifSerie, 
                           CertifNo, NrCopiiPlasament, TipNevoiCopil, StartDate, StopDate, Type, CreateDate)
    				              VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, '{$_GET['CertifName']}', 
    				                     '{$_GET['CertifEmitent']}', '{$_GET['CertifSerie']}', 
    				                     '{$_GET['CertifNo']}', '".($_GET['NrCopiiPlasament'] ? $_GET['NrCopiiPlasament'] : 0)."', '".($_GET['TipNevoiCopil'] > 0 ? $_GET['TipNevoiCopil'] : 0)."', '" . Utils::toDBDate($_GET['StartDate']) . "', '" . Utils::toDBDate($_GET['StopDate']) . "', '".$_GET['Type']."', CURRENT_TIMESTAMP)");
                    break;
                case 'edit':
                    $conn->query("UPDATE persons_certif SET
    				                     CertifName    = '{$_GET['CertifName']}',
    				                     CertifEmitent = '{$_GET['CertifEmitent']}',
    				                     CertifSerie   = '{$_GET['CertifSerie']}',
    				                     CertifNo      = '{$_GET['CertifNo']}',
    				                     NrCopiiPlasament      = '".($_GET['NrCopiiPlasament'] ? $_GET['NrCopiiPlasament'] : 0)."',
    				                     TipNevoiCopil      = '".($_GET['TipNevoiCopil'] ? $_GET['TipNevoiCopil'] : 0)."',
    				                     StartDate     = '" . Utils::toDBDate($_GET['StartDate']) . "',
    				                     StopDate      = '" . Utils::toDBDate($_GET['StopDate']) . "'
    				              WHERE  CertifID = {$_GET['CertifID']} AND PersonID = {$this->PersonID}");
                    break;
                case 'del':
                    $conn->query("DELETE FROM persons_certif WHERE CertifID = {$_GET['CertifID']} AND PersonID = {$this->PersonID}");
                    break;
                case 'newmedical':
                    $conn->query("INSERT INTO persons_medical_docs(
                                UserID
                                , PersonID
                                , DocName
                                , DocDate
                                , Issuer
                                , DocType
                                , DocNumber
                                , Approval
                                , Recommendations
                                , CreateDate)
    				              VALUES(
    				                     {$_SESSION['USER_ID']}
    				                     , {$this->PersonID}
    				                     , '{$_GET['DocName']}'
    				                     , '{$_GET['DocDate']}'
    				                     , '{$_GET['Issuer']}'
    				                     , '{$_GET['DocType']}'
    				                     , '{$_GET['DocNumber']}'
    				                     , '{$_GET['Approval']}'
    				                     , '{$_GET['Recommendations']}'
    				                     , CURRENT_TIMESTAMP)");
                    break;
                case 'editnewmedical':
                    $conn->query("UPDATE persons_medical_docs SET
    				                     DocName    = '{$_GET['DocName']}', 
                                         DocDate     = '" . Utils::toDBDate($_GET['DocDate']) . "',
                                         Issuer = '{$_GET['Issuer']}',
                                         DocType      = '{$_GET['DocType']}',
                                    	 DocNumber      = '{$_GET['DocNumber']}',
    				                     Approval      = '{$_GET['Approval']}',
    				                     Recommendations      = '{$_GET['Recommendations']}'				                     
    				              WHERE  Id = {$_GET['Id']} AND PersonID = {$this->PersonID}");
                    break;
                case 'delnewmedical':
                    $conn->query("DELETE FROM persons_medical_docs WHERE Id = {$_GET['Id']} AND PersonID = {$this->PersonID}");
                    break;
                case 'newpsychological':
                    $conn->query("INSERT INTO persons_psychological_docs(
                                UserID
                                , PersonID
                                , DocName
                                , DocDate
                                , Issuer
                                , DocType
                                , DocNumber
                                , Approval
                                , Recommendations
                                , CreateDate)
    				              VALUES(
    				                     {$_SESSION['USER_ID']}
    				                     , {$this->PersonID}
    				                     , '{$_GET['DocName']}'
    				                     , '{$_GET['DocDate']}'
    				                     , '{$_GET['Issuer']}'
    				                     , '{$_GET['DocType']}'
    				                     , '{$_GET['DocNumber']}'
    				                     , '{$_GET['Approval']}'
    				                     , '{$_GET['Recommendations']}'
    				                     , CURRENT_TIMESTAMP)");
                    break;
                case 'editpsychological':
                    $conn->query("UPDATE persons_psychological_docs SET
    				                     DocName    = '{$_GET['DocName']}', 
                                         DocDate     = '" . Utils::toDBDate($_GET['DocDate']) . "',
                                         Issuer = '{$_GET['Issuer']}',
                                         DocType      = '{$_GET['DocType']}',
                                    	 DocNumber      = '{$_GET['DocNumber']}',
    				                     Approval      = '{$_GET['Approval']}',
    				                     Recommendations      = '{$_GET['Recommendations']}'				                     
    				              WHERE  Id = {$_GET['Id']} AND PersonID = {$this->PersonID}");
                    break;
                case 'delpsychological':
                    $conn->query("DELETE FROM persons_psychological_docs WHERE Id = {$_GET['Id']} AND PersonID = {$this->PersonID}");
                    break;

                case 'newCPPC':
                    $conn->query("INSERT INTO persons_driver_certificates(
                                UserID
                                , PersonID
                                , ReleaseDate
                                , ExpirationDate
                                , DrivingLicenseNumber
                                , CertificateNumber
                                , AM
                                , A1
                                , A2
                                , A                                
                                , B1
                                , B
                                , BE
                                , C1
                                , C1E
                                , C
                                , CE
                                , D1
                                , D1E
                                , D
                                , DE
                                , Tr
                                , Tb
                                , Tv
                                , CreateDate)
    				              VALUES(
    				                     {$_SESSION['USER_ID']}
    				                     , {$this->PersonID}
    				                     , '{$_GET['ReleaseDate']}'
    				                     , '{$_GET['ExpirationDate']}'
    				                     , '{$_GET['DrivingLicenseNumber']}'
    				                     , '{$_GET['CertificateNumber']}'
    				                     , '{$_GET['AM']}'
    				                     , '{$_GET['A1']}'
    				                     , '{$_GET['A2']}'
    				                     , '{$_GET['A']}'
    				                     , '{$_GET['B1']}'
    				                     , '{$_GET['B']}'
    				                     , '{$_GET['BE']}'
    				                     , '{$_GET['C1']}'
    				                     , '{$_GET['C1E']}'
    				                     , '{$_GET['C']}'
    				                     , '{$_GET['CE']}'
    				                     , '{$_GET['D1']}'
    				                     , '{$_GET['D1E']}'
    				                     , '{$_GET['D']}'
    				                     , '{$_GET['DE']}'
    				                     , '{$_GET['Tr']}'
    				                     , '{$_GET['Tb']}'
    				                     , '{$_GET['Tv']}'
    				                     , CURRENT_TIMESTAMP)");
                    break;

            }
            header('Location: ./?m=persons&o=editprof&PersonID=' . $this->PersonID);
            exit;
        }

        $this->setProfData($info);

        $update = '';
        foreach ($info as $k => $v) {
            if (in_array($k, array('years', 'months', 'days', 'Status'))) {
                continue;
            }
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][3]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)");
    }

    private function setProfData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }

//        if (!$info['JobDictionaryID']) {
//            throw new Exception(Message::getMessage('PROF_EMPTY'));
//        }
        if (!$info['Studies']) {
            throw new Exception(Message::getMessage('STUDIES_EMPTY'));
        }
        if ($info['DrivingLicense'] == 'Da') {
            $info['DrivingCategory'] = !empty($info['DrivingCategory']) ? implode(',', $info['DrivingCategory']) : '';
        }


        $info['JobDictionaryID'] = implode(',', $info['JobDictionaryID']);
        $info['StudiiAbsolvite'] = implode(',', $info['StudiiAbsolvite']);
        $info['WorkTime'] = implode('/', $info['WorkTime']);
        $info['WorkTimeAt'] = Utils::toDBDate($info['WorkTimeAt']);
        $info['DrivingStartDate'] = Utils::toDBDate($info['DrivingStartDate']);
        $info['DrivingStopDate'] = Utils::toDBDate($info['DrivingStopDate']);
    }

    public function getCV()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][11]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][11]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.StreetNumber, b.StreetName, b.StreetCode, d.CityName, e.DistrictName, g.CompanyName,
	                 CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   persons a
                         INNER JOIN address b ON a.AddressID = b.AddressID
                         INNER JOIN address_city d ON d.CityID = b.CityID
                         INNER JOIN address_district e ON e.DistrictID = d.DistrictID
			 LEFT JOIN payroll f ON a.PersonID = f.PersonID
			 LEFT JOIN companies g ON f.CompanyID = g.CompanyID
                  WHERE  a.PersonID = {$this->PersonID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['trainings'] = $this->getTrainingsByPerson();
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function getTrainingsByPerson()
    {

        global $conn;

        $trainings = array();

        $query = "SELECT DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
    	                 DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS StopDate,
    	                 b.TrainingName, c.CompanyName
    	          FROM   training_persons a
    	                 INNER JOIN trainings b ON a.TrainingID = b.TrainingID
    	                 INNER JOIN companies c ON b.CompanyID = c.CompanyID
    	          WHERE  a.PersonID = {$this->PersonID} AND b.Status = 1
    	          ORDER  BY a.ID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $trainings[] = $row;
        }

        return $trainings;
    }

    public function editCV($info = array())
    {

        $this->setCVData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][11]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)");
    }

    private function setCVData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
    }

    public function getProfExp()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_prof WHERE PersonID = {$this->PersonID} ORDER BY StartDate DESC");
        $prof_exp = array();
        while ($row = $conn->fetch_array()) {
            $prof_exp[$row['ProfID']] = $row;
        }
        return $prof_exp;
    }

    public function addProfExp()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $conn->query("INSERT INTO persons_prof(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editProfExp()
    {

        global $conn;

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }

        $update = substr($update, 0, -1);
        $conn->query("UPDATE persons_prof SET $update WHERE ProfID = {$_GET['ProfID']} AND PersonID = {$this->PersonID}");
    }

    public function delProfExp()
    {
        global $conn;
        $conn->query("DELETE FROM persons_prof WHERE ProfID = {$_GET['ProfID']} AND PersonID = {$this->PersonID}");
    }

    public function getStd()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_std WHERE PersonID = {$this->PersonID} ORDER BY StartDate DESC");
        $std = array();
        while ($row = $conn->fetch_array()) {
            $std[$row['StdID']] = $row;
        }
        return $std;
    }

    public function addStd()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $conn->query("INSERT INTO persons_std(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editStd()
    {

        global $conn;

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE persons_std SET $update WHERE StdID = {$_GET['StdID']} AND PersonID = {$this->PersonID}");
    }

    public function delStd()
    {
        global $conn;
        $conn->query("DELETE FROM persons_std WHERE StdID = {$_GET['StdID']} AND PersonID = {$this->PersonID}");
    }

    public function getLang()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_lang WHERE PersonID = {$this->PersonID} ORDER BY LangID");
        $lang = array();
        while ($row = $conn->fetch_array()) {
            $lang[$row['LangID']] = $row;
        }
        return $lang;
    }

    public function addLang()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $conn->query("INSERT INTO persons_lang(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editLang()
    {

        global $conn;

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE persons_lang SET $update WHERE LangID = {$_GET['LangID']} AND PersonID = {$this->PersonID}");
    }

    public function delLang()
    {
        global $conn;
        $conn->query("DELETE FROM persons_lang WHERE LangID = {$_GET['LangID']} AND PersonID = {$this->PersonID}");
    }

    public function getFuncRecr()
    {
        global $conn;
        $conn->query("SELECT ID, FunctionIDRecr FROM persons_func_recr WHERE PersonID = {$this->PersonID} ORDER BY ID");
        $func_recr = array();
        while ($row = $conn->fetch_array()) {
            $func_recr[$row['ID']] = $row['FunctionIDRecr'];
        }
        return $func_recr;
    }

    public function addFuncRecr()
    {
        global $conn;
        $conn->query("INSERT INTO persons_func_recr(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editFuncRecr()
    {
        global $conn;
        $update = '';
        foreach ($_POST as $k => $v) {
            $update .= "$k = $v,";
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE persons_func_recr SET $update WHERE ID = {$_GET['ID']} AND PersonID = {$this->PersonID}");
    }

    public function delFuncRecr()
    {
        global $conn;
        $conn->query("DELETE FROM persons_func_recr WHERE ID = {$_GET['ID']} AND PersonID = {$this->PersonID}");
    }

    public function getCertif($type = 0)
    {

        global $conn;

        $cond = " AND 1 = 1";
        if($type > 0)
            $cond .= " AND Type = '".$type."'";

        $conn->query("SELECT * FROM persons_certif WHERE PersonID = {$this->PersonID} ".$cond." ORDER BY StartDate");
        $certif = array();
        while ($row = $conn->fetch_array()) {
            $certif[$row['CertifID']] = $row;
        }
        return $certif;
    }

    public static function setMedicalDocs($PersonID)
    {
        echo "cucu-bau-bau"; die;
        global $conn;

        $MedicalDocID = (int)$_GET['Id'];

        if (!empty($_GET['del'])) {
            $conn->query("DELETE FROM persons_medical_docs WHERE Id = $MedicalDocID AND PersonID = $PersonID");
        } else {
            $DocDate= Utils::toDBDate($_POST['DocDate']);
            $DocName = Utils::formatStr($_POST['DocName']);
            $Issuer = Utils::formatStr($_POST['Issuer']);
            $DocNumber= Utils::formatStr($_POST['DocNumber']);
            $DocType= Utils::formatStr($_POST['DocType']);
            $DocApproval= Utils::formatStr($_POST['Approval']);
            $DocRecommendations= Utils::formatStr($_POST['Recommendations']);

            if ($MedicalDocID > 0) {
                $conn->query("UPDATE persons_medical_docs SET 
                                DocDate = '$DocDate'
                              , DocName = '$DocName'
                              , Issuer = '$Issuer'
                              , DocNumber = '$DocNumber'
                              , DocType = '$DocType'
                              , Approval = '$DocApproval'
                              , Recommendations = '$DocRecommendations'
                              , LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE Id = $MedicalDocID AND PersonID = $PersonID");
            } else {
                $conn->query("INSERT INTO persons_medical_docs
                            (UserID
                            , PersonID
                            , DocName
                            , DocDate
                            , Issuer
                            , DocType
                            , DocNumber
                            , Approval
                            , Recommendation
                            , CreateDate
                            , LastUpdateDate)
		              VALUES
		                     ('{$_SESSION['USER_ID']}'
		                     , '$PersonID'
		                     , '$DocName'
		                     , '$DocDate'
		                     , '$Issuer'
		                     , '$DocType'
		                     , '$DocNumber'
		                     , '$DocApproval'
		                     , '$DocRecommendations'
		                     , CURRENT_TIMESTAMP
		                     , CURRENT_TIMESTAMP)");
            }
        }
    }

    public function getMedicalDocsNew()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_medical_docs WHERE PersonID = {$this->PersonID} ORDER BY DocDate");
        $medDocs = array();
        while ($row = $conn->fetch_array()) {
            $medDocs[$row['Id']] = $row;
        }
        return $medDocs;
    }

    public static function setPsychologicalDocs($PersonID)
    {
        global $conn;

        $PsychologicalDocID = (int)$_GET['Id'];

        if (!empty($_GET['del'])) {
            $conn->query("DELETE FROM persons_psychological_docs WHERE Id = $PsychologicalDocID AND PersonID = $PersonID");
        } else {
            $DocDate= Utils::toDBDate($_POST['DocDate']);
            $DocName = Utils::formatStr($_POST['DocName']);
            $Issuer = Utils::formatStr($_POST['Issuer']);
            $DocNumber= Utils::formatStr($_POST['DocNumber']);
            $DocType= Utils::formatStr($_POST['DocType']);
            $DocApproval= Utils::formatStr($_POST['Approval']);
            $DocRecommendations= Utils::formatStr($_POST['Recommendations']);

            if ($PsychologicalDocID > 0) {
                $conn->query("UPDATE persons_psychological_docs SET 
                                DocDate = '$DocDate'
                              , DocName = '$DocName'
                              , Issuer = '$Issuer'
                              , DocNumber = '$DocNumber'
                              , DocType = '$DocType'
                              , Approval = '$DocApproval'
                              , Recommendations = '$DocRecommendations'
                              , LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE Id = $PsychologicalDocID AND PersonID = $PersonID");
            } else {
                $conn->query("INSERT INTO persons_psychological_docs
                            (UserID
                            , PersonID
                            , DocName
                            , DocDate
                            , Issuer
                            , DocType
                            , DocNumber
                            , Approval
                            , Recommendation
                            , CreateDate
                            , LastUpdateDate)
		              VALUES
		                     ('{$_SESSION['USER_ID']}'
		                     , '$PersonID'
		                     , '$DocName'
		                     , '$DocDate'
		                     , '$Issuer'
		                     , '$DocType'
		                     , '$DocNumber'
		                     , '$DocApproval'
		                     , '$DocRecommendations'
		                     , CURRENT_TIMESTAMP
		                     , CURRENT_TIMESTAMP)");
            }
        }
    }

    public function getPsichologicalDocsNew()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_psychological_docs WHERE PersonID = {$this->PersonID} ORDER BY DocDate");
        $psyDocs = array();
        while ($row = $conn->fetch_array()) {
            $psyDocs[$row['Id']] = $row;
        }
        return $psyDocs;
    }

    public static function setCPPC($PersonID)
    {
        global $conn;

        $cppcID = (int)$_GET['Id'];

        if (!empty($_GET['del'])) {
            $conn->query("DELETE FROM persons_driver_certificates WHERE Id = $cppcID AND PersonID = $PersonID");
        } else {
            $ReleaseDate= Utils::toDBDate($_POST['ReleaseDate']);
            $ExpirationDate= Utils::toDBDate($_POST['ExpirationDate']);
            $DrivingLicenseNumber = Utils::formatStr($_POST['DrivingLicenseNumber']);
            $CertificateNumber = Utils::formatStr($_POST['CertificateNumber']);
            $AM = Utils::formatStr($_POST['AM']);
            $A1 = Utils::formatStr($_POST['A1']);
            $A2 = Utils::formatStr($_POST['A2']);
            $A = Utils::formatStr($_POST['A']);


            if ($cppcID > 0) {
                $conn->query("UPDATE persons_driver_certificates SET 
                                ReleaseDate = '$ReleaseDate'
                              , ExpirationDate = '$ExpirationDate'
                              , DrivingLicenseNumber = '$DrivingLicenseNumber'
                              , CertificateNumber = '$CertificateNumber'
                              , AM = '$AM'
                              , A1 = '$A1'
                              , A2 = '$A2'
                              , A = '$A'
                              , LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE Id = $cppcID AND PersonID = $PersonID");
            } else {
                $conn->query("INSERT INTO persons_driver_certificates
                            (UserID
                            , PersonID
                            , ReleaseDate
                            , ExpirationDate
                            , DrivingLicenseNumber
                            , CertificateNumber
                            , AM
                            , A1
                            , A2
                            , A
                            , CreateDate
                            , LastUpdateDate)
		              VALUES
		                     ('{$_SESSION['USER_ID']}'
		                     , '$PersonID'
		                     , '$ReleaseDate'
		                     , '$ExpirationDate'
		                     , '$DrivingLicenseNumber'
		                     , '$CertificateNumber'
		                     , '$AM'
		                     , '$A1'
		                     , '$A2'
		                     , '$A'
		                     , CURRENT_TIMESTAMP
		                     , CURRENT_TIMESTAMP)");
            }
        }
    }

    public function getCPPC()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_driver_certificates WHERE PersonID = {$this->PersonID} ORDER BY ReleaseDate");
        $cppc = array();
        while ($row = $conn->fetch_array()) {
            $cppc[$row['Id']] = $row;
        }
        return $cppc;
    }

    public function getChildren()
    {

        global $conn;

        $children = array();

        $query = "SELECT * FROM persons_children WHERE PersonID = {$this->PersonID} ORDER BY ChildID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $children[] = $row;
        }

        return $children;
    }

    // Adaugare de nou copil (intretinere)
    public function newChild()
    {

        global $conn, $smarty;

        $query = "INSERT INTO persons_children(PersonID, ChildName, ChildBirthDate, ChildCNP, CreateDate)
    	          VALUES({$this->PersonID}, '" . Utils::formatStr($_GET['ChildName']) . "', '" . Utils::toDBDate($_GET['ChildBirthDate']) . "', '" . Utils::formatStr($_GET['ChildCNP']) . "', CURRENT_TIMESTAMP)";
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=edit&PersonID={$this->PersonID}';\"></body>";
            exit;
        }
        $query = "UPDATE persons SET NumberOfChildren = " . (int)$_GET['NumberOfChildren'] . " WHERE PersonID = {$this->PersonID}";
        $conn->query($query);
    }

    // Editare copil (intretinere)
    public function editChild()
    {

        global $conn, $smarty;

        $query = "UPDATE persons_children SET
    	          				ChildName      = '" . Utils::formatStr($_GET['ChildName']) . "',
    	          				ChildBirthDate = '" . Utils::toDBDate($_GET['ChildBirthDate']) . "',
    	          				ChildCNP       = '" . Utils::formatStr($_GET['ChildCNP']) . "'
    	          WHERE ChildID = " . (int)$_GET['ChildID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=edit&PersonID={$this->PersonID}';\"></body>";
            exit;
        }
    }

    // Stergere copil
    public function delChild()
    {

        global $conn;

        $query = "DELETE FROM persons_children WHERE ChildID = " . (int)$_GET['ChildID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
        $query = "UPDATE persons SET NumberOfChildren = (SELECT COUNT(1) FROM persons_children WHERE PersonID = {$this->PersonID}) WHERE PersonID = {$this->PersonID}";
        $conn->query($query);
    }

    // Incarcare certificate de casatorie
    public function getCC()
    {

        global $conn;

        $cc = array();

        $query = "SELECT * FROM persons_cc WHERE PersonID = {$this->PersonID} ORDER BY CCID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $cc[] = $row;
        }

        return $cc;
    }

    // Adaugare certificat de casatorie
    public function newCC()
    {

        global $conn, $smarty;

        $query = "INSERT INTO persons_cc(PersonID, Nume, CNP, Data, Serie, Nr, CreateDate)
    	          VALUES({$this->PersonID}, '" . Utils::formatStr($_GET['Nume']) . "', '" . Utils::formatStr($_GET['CNP']) . "',
    	                 '" . Utils::toDBDate($_GET['Data']) . "', '" . Utils::formatStr($_GET['Serie']) . "',
    	                 '" . Utils::formatStr($_GET['Nr']) . "', CURRENT_TIMESTAMP)";
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=edit&PersonID={$this->PersonID}';\"></body>";
            exit;
        }
    }

    // Editare certificat de casatorie
    public function editCC()
    {

        global $conn, $smarty;

        $query = "UPDATE persons_cc SET
    	          			Nume  = '" . Utils::formatStr($_GET['Nume']) . "',
    	          			CNP   = '" . Utils::formatStr($_GET['CNP']) . "',
    	          			Data  = '" . Utils::toDBDate($_GET['Data']) . "',
    	          			Serie = '" . Utils::formatStr($_GET['Serie']) . "',
    	          			Nr    = '" . Utils::formatStr($_GET['Nr']) . "'
    	          WHERE CCID = " . (int)$_GET['CCID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
        if ($conn->errno == 1062) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::getMessage('DUPLICATE_CNP')), $smarty) . "!'); window.location.href = './?m=persons&o=edit&PersonID={$this->PersonID}';\"></body>";
            exit;
        }
    }

    // Stergere certificat de casatorie
    public function delCC()
    {

        global $conn;

        $query = "DELETE FROM persons_cc WHERE CCID = " . (int)$_GET['CCID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
    }

    public function setVacationComment($PersonID)
    {
        global $conn;
        $conn->query("UPDATE persons SET VacationComment = '" . Utils::formatStr($_POST['VacationComment']) . "' WHERE PersonID = $PersonID");
        if ($_SESSION['USER_ID'] == 1) {
            foreach ((array)$_POST['History'] as $Year => $History) {
                $History = Utils::formatStr($History) . "\n";
                $conn->query("UPDATE vacations SET History = '{$History}' WHERE PersonID = $PersonID AND Year = '{$Year}'");
            }
        }
    }

    public function newVacation($PersonID)
    {
        global $conn;
        $conn->query("INSERT INTO vacations(UserID, PersonID, Year, TotalCO, TotalCORef, Invoire, CreateDate)
    	              VALUES({$_SESSION['USER_ID']}, $PersonID, '{$_GET['Year']}', '" . (int)$_GET['TotalCO'] . "', 
		             '" . (int)$_GET['TotalCORef'] . "', '" . (int)$_GET['Invoire'] . "', CURRENT_TIMESTAMP)");
    }

    public function editVacation($PersonID)
    {
        global $conn;
        $conn->query("UPDATE vacations SET 
					    TotalCO    = '" . (int)$_GET['TotalCO'] . "', 
					    TotalCORef = '" . (int)$_GET['TotalCORef'] . "', 
					    Invoire    = '" . (int)$_GET['Invoire'] . "',
					    VacRecalc  = " . (int)$_GET['VacRecalc'] . ",
					    Closed     = " . (int)$_GET['Closed'] . "
    	              WHERE VacationID = " . (int)$_GET['VacationID']) . " AND PersonID = $PersonID";
    }

    public function delVacation($PersonID)
    {
        global $conn;
        $conn->query("DELETE FROM vacations WHERE VacationID = " . (int)$_GET['VacationID']) . " AND PersonID = $PersonID";
    }

    public function getVacationDetails($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][10]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (UserID = {$_SESSION['USER_ID']} OR PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $vacations = array();

        $query = "SELECT * FROM vacations_details WHERE PersonID = $PersonID AND ($condbase) ORDER BY StartDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['rw'] = $_SESSION['USER_ID'] > 1 && empty($_SESSION['ROLEMNG']) && $row['Aprove'] == 1 ? 0 : 1;
            $vacations[$row['Type']][$row['Year']][] = $row;
        }

        return $vacations;
    }

    public function newVacationDetail($PersonID)
    {
        global $conn, $smarty;
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $StartHour = '';
        $StopHour = '';
        $time = 0;
        if (empty($_GET['StopDate']) && !empty($_GET['Details'])) {
            $timeStamp = strtotime($StartDate);
            $timeStamp += 24 * 60 * 60 * (Person::$msCEType[$_GET['Details']] - 1);
            $StopDate = date("Y-m-d", $timeStamp);
            $_GET['StopDate'] = date("d-m-Y", $timeStamp);
        } elseif ($_GET['Type'] == "INV") {
            $StopDate = $StartDate;
            $StartHour = $conn->real_escape_string($_GET['StartHour']);
            $StopHour = $conn->real_escape_string($_GET['StopHour']);
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

        } else {
            $StopDate = Utils::toDBDate($_GET['StopDate']);
        }
        if ($StartDate > $StopDate) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Data inceput trebuie sa fie mai mica decat Data sfarsit'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
            exit;
        }
        if ($_GET['Type'] == 'CO') {
            $conn->query("SELECT a.RoleID, b.CompanyID FROM persons a INNER JOIN payroll b ON a.PersonID = b.PersonID WHERE a.PersonID = $PersonID");
            if ($row = $conn->fetch_array()) {
                $CompanyID = (int)$row['CompanyID'];
                $RoleID = (int)$row['RoleID'];
            } else {
                $CompanyID = 0;
                $RoleID = 0;
            }
            if (empty($CompanyID)) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Angajatul nu are compania setata in meniul Personal -> Incadrare'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                exit;
            }
            $settings = Utils::getCompanySettings($CompanyID, $RoleID);
            if (isset($settings['vacation_days']) && $settings['vacation_days'] != '') {
                $minStartDate = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - (int)$settings['vacation_days'], (int)date('Y')));
                if ($StartDate < $minStartDate) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Nu se poate seta o data de inceput mai veche de %s', 'values' => Utils::toDBDate($minStartDate)), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                    exit;
                }
            }
            $vacation_limit = isset($settings['vacation_limit']) ? (int)$settings['vacation_limit'] : 0;
            $query = "SELECT TotalCO, 
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Year = a.Year AND Type = 'CO' AND Aprove >= 0) AS EffCO
    	              FROM   vacations a
    	              WHERE  a.PersonID = $PersonID AND a.Year = '" . substr($StartDate, 0, 4) . "'";
            $conn->query($query);
            if ($row = $conn->fetch_array()) {
                if ($vacation_limit == 1 && (Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], false) > ($row['TotalCO'] - $row['EffCO']))) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Concediul nu poate depasi numarul de zile ramase din an'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                    exit;
                }
            }
        }
        $conn->query("SELECT *
	              FROM   vacations_details
		      WHERE  PersonID = $PersonID AND Aprove >= 0 AND
		             (
		                StartDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
			        StopDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
				'{$StartDate}' BETWEEN StartDate AND StopDate
			     )");
        if ($row = $conn->fetch_array()) {
            if($_GET['Type'] == 'CM' && $row['Type'] == 'CO') {
                $_oldVacStartDate = strtotime($row['StartDate']);
                $_oldVacStopDate = strtotime($row['StopDate']);
                $_newVacStartDate = strtotime($StartDate);
                $_newVacStopDate = strtotime($StopDate);
                if($_oldVacStartDate < $_newVacStartDate && $_oldVacStopDate < $_newVacStopDate) {
                    // insert first part of CO
                    $conn->query("INSERT INTO vacations_details(UserID, PersonID, Aprove, Year, StartDate, StartHour, StopDate, StopHour, Type, DaysNo, HoursNo, NoCerere, SerieNum, CodInd, TipCertif, CodCertif, Emitent, Details, Replacer, Notes, CreateDate)
    	              VALUES('" . $row['UserID'] . "', 
    	                    $PersonID,
                            '" . $row['Aprove'] . "',
                            '" . $row['Year'] . "',
    	            	    '" . $row['StartDate'] . "',
                            '" . $row['StartHour'] . "',
    	              	    '" . $row['StopDate'] . "', 
    	              	    '" . $row['StopHour'] . "', 
    	            	    '" . $row['Type'] . "',
    	                    '" . Utils::dateDiff($row['StartDate'], $_GET['StopDate']) . "',
    	                    '" . $row['HoursNo'] . "',
    	                    '" . $row['HoursNo'] . "',
    	                    '" . $row['HoursNo'] . "',
    	                    '" . $row['HoursNo'] . "',
    	                    '" . $row['HoursNo'] . "',
    	                    '" . $row['HoursNo'] . "',
                            '" . $row['HoursNo'] . "',
                            '" . $row['HoursNo'] . "',
                            '" . $row['HoursNo'] . "',
                            '" . $row['HoursNo'] . "',
    	                    CURRENT_TIMESTAMP)");
                }
                if($_oldVacStartDate < $_newVacStartDate && $_oldVacStopDate > $_newVacStopDate){

                }
                if($_oldVacStartDate > $_newVacStartDate && $_oldVacStopDate > $_newVacStopDate){

                }
                if($_oldVacStartDate > $_newVacStartDate && $_oldVacStopDate < $_newVacStopDate){

                }
                //insert second part of CO

                $conn->query("INSERT INTO vacations_details(UserID, PersonID, Aprove, Year, StartDate, StartHour, StopDate, StopHour, Type, DaysNo, HoursNo, NoCerere, SerieNum, CodInd, TipCertif, CodCertif, Emitent, Details, Replacer, Notes, CreateDate)
    	              VALUES({$_SESSION['USER_ID']}, $PersonID,
		            '" . ($settings['vacation_aprove'] == 1 ? 0 : 1) . "',
		    	    '" . substr($StartDate, 0, 4) . "',
    	            	    '{$StartDate}',
                            '{$StartHour}',
    	              	    '{$StopDate}', 
    	              	    '{$StopHour}', 
    	            	    '" . $_GET['Type'] . "',
    	                    '" . Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], $_GET['Type'] == 'CM' ? true : false) . "',
    	                    '{$time}',
    	                    '" . (!empty($_GET['NoCerere']) ? $_GET['NoCerere'] : '') . "',
    	                    '" . (!empty($_GET['SerieNum']) ? $_GET['SerieNum'] : '') . "',
    	                    '" . (!empty($_GET['CodInd']) ? $_GET['CodInd'] : '') . "',
    	                    '" . (!empty($_GET['TipCertif']) ? $_GET['TipCertif'] : '') . "',
    	                    '" . (!empty($_GET['CodCertif']) ? $_GET['CodCertif'] : '') . "',
			    '" . (!empty($_GET['Emitent']) ? Utils::formatStr($_GET['Emitent']) : '') . "',
			    '" . (!empty($_GET['Details']) ? Utils::formatStr($_GET['Details']) : '') . "',
			    '" . (!empty($_GET['Replacer']) ? $_GET['Replacer'] : '') . "',
			    '" . (!empty($_GET['Notes']) ? Utils::formatStr($_GET['Notes']) : '') . "',
    	                    CURRENT_TIMESTAMP)");
            }
            else {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Concediul ales se suprapune peste un concediu tip %s', 'values' => $row['Type']), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                exit;
            }
        }
        $settings = Utils::getSettings();
        if ($settings['vacation_aprove'] == 1) {
            $conn->query("SELECT PersonID, FullName, Email, Username, Password,
	                         (SELECT FullName FROM persons WHERE PersonID = $PersonID LIMIT 1) AS Employee
	                  FROM   persons a
			  WHERE  PersonID = (SELECT IF(VacationManagerID IS NULL OR VacationManagerID = '0' OR VacationManagerID = '', DirectManagerID, VacationManagerID) FROM payroll WHERE PersonID = $PersonID LIMIT 1)");
            if ($row = $conn->fetch_array()) {
                if ($row['PersonID'] == $PersonID) {
                    $settings['vacation_aprove'] = 0;
                } else {
                    $info = $row;
                }
            } else {
                $settings['vacation_aprove'] = 0;
            }
        }
        if ($_SESSION['USER_ID'] == 1) {
            $settings['vacation_aprove'] = 0;
        }
        $conn->query("INSERT INTO vacations_details(UserID, PersonID, Aprove, Year, StartDate, StartHour, StopDate, StopHour, Type, DaysNo, HoursNo, NoCerere, SerieNum, CodInd, TipCertif, CodCertif, Emitent, Details, Replacer, Notes, CreateDate)
    	              VALUES({$_SESSION['USER_ID']}, $PersonID,
		            '" . ($settings['vacation_aprove'] == 1 ? 0 : 1) . "',
		    	    '" . substr($StartDate, 0, 4) . "',
    	            	    '{$StartDate}',
                            '{$StartHour}',
    	              	    '{$StopDate}', 
    	              	    '{$StopHour}', 
    	            	    '" . $_GET['Type'] . "',
    	                    '" . Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], $_GET['Type'] == 'CM' ? true : false) . "',
    	                    '{$time}',
    	                    '" . (!empty($_GET['NoCerere']) ? $_GET['NoCerere'] : '') . "',
    	                    '" . (!empty($_GET['SerieNum']) ? $_GET['SerieNum'] : '') . "',
    	                    '" . (!empty($_GET['CodInd']) ? $_GET['CodInd'] : '') . "',
    	                    '" . (!empty($_GET['TipCertif']) ? $_GET['TipCertif'] : '') . "',
    	                    '" . (!empty($_GET['CodCertif']) ? $_GET['CodCertif'] : '') . "',
			    '" . (!empty($_GET['Emitent']) ? Utils::formatStr($_GET['Emitent']) : '') . "',
			    '" . (!empty($_GET['Details']) ? Utils::formatStr($_GET['Details']) : '') . "',
			    '" . (!empty($_GET['Replacer']) ? $_GET['Replacer'] : '') . "',
			    '" . (!empty($_GET['Notes']) ? Utils::formatStr($_GET['Notes']) : '') . "',
    	                    CURRENT_TIMESTAMP)");
        $VacationID = $conn->get_insert_id();
        if ($_GET['Type'] == 'CIC' && date('Y-m-d') >= $StartDate && date('Y-m-d') <= $StopDate) {
            //$conn->query("UPDATE persons SET Status = CASE WHEN Status = 2 THEN 8 WHEN Status = 7 THEN 14 ELSE Status END WHERE PersonID = $PersonID");
        }
        if ($_GET['Type'] == "INV") {
//            $conn->query("SELECT SUM(a.HoursNo) AS HoursNo, b.WorkNorm FROM vacations_details a LEFT JOIN payroll b ON b.PersonID = a.PersonID WHERE a.PersonID = '{$PersonID}' AND a.Type = 'INV' AND a.Year = '".substr($StartDate, 0, 4)."' AND a.Aprove != -1");
//            if($row = $conn->fetch_array()){
//               $invdays = floor($row['HoursNo']/$row['WorkNorm']);
//                $conn->query("UPDATE vacations SET Invoire = '{$invdays}' WHERE PersonID = '{$PersonID}' AND Year = '".substr($StartDate, 0, 4)."'");
//            }
            Person::syncInvoiri($PersonID);

            //insert line in pontaj_detail for approved INV
            if ($settings['vacation_aprove'] == 0) {
                //get cost center id for PersonID
                $CostCenterID = 0;
                $conn->query("SELECT CostCenterID
							FROM payroll_costcenter 
							WHERE PersonID = '{$PersonID}'");
                if ($row = $conn->fetch_array()) {
                    $CostCenterID = $row['CostCenterID'];
                }
                //insert line in pontaj detail
                $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                      VALUES('{$_SESSION['USER_ID']}', $PersonID, '{$StartDate}', '{$StartHour}', '{$StopDate}', '{$StopHour}', '-{$time}', 0, '{$CostCenterID}', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");

            }
        }

//	if ($settings['vacation_aprove'] == 1) {
        $vacation_status = array("Aprobat", "Neaprobat");
        include_once('sendMail.php');
        if ($_GET['Type'] == "INV") {
            $conn->query("SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 35 AND Active = 1");
        } else {
            $conn->query("SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 8 AND Active = 1");
        }
        if ($row = $conn->fetch_array()) {
            //$headers = "From: \"{$row['FromAlias']}\" <{$row['FromEmail']}>";
            //$to      = "\"{$info['FullName']}\" <{$info['Email']}>";
            $message = str_replace(array('<<FullName>>', '<<Type>>', '<<StartDate>>', '<<StopDate>>', '<<StartHour>>', '<<StopHour>>', '<<HoursNo>>', '<<Status>>'), array($info['Employee'], $_GET['Type'], $_GET['StartDate'], $_GET['StopDate'], $StartHour, $StopHour, $time, $vacation_status[$settings['vacation_aprove']]), $row['Body']);
            $message_md = $message;
            $message = str_replace('<<AproveLink>>', '', $message);

            if (!empty($_GET['Replacer'])) {
                $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = '{$_GET['Replacer']}'");
                if ($row2 = $conn->fetch_array()) {
                    $message .= "\nPentru perioada mentionata inlocuitor va fi {$row2['FullName']}";
                    $message_md .= "\nPentru perioada mentionata inlocuitor va fi {$row2['FullName']}";
                    //@mail("\"{$row2['FullName']}\" <{$row2['Email']}>", $row['Subject'], $message, $headers);
                    sendMail($row['FromAlias'], $row['FromEmail'], $row2['FullName'], $row2['Email'], $row['Subject'], $message);
                }
            }
            $alert_settings = !empty($row['Settings']) ? unserialize($row['Settings']) : '';
            if (!empty($alert_settings['md'])) {
                $authString = base64_encode(Utils::encrypt($info['Username'] . '||' . $info['Password'], Config::ENCRYPTION_KEY));
                $aprove_link = Config::SRV_URL . 'auth.php?authString=' . $authString . '&redirect=' . urlencode('./?m=persons&o=vacation&PersonID=' . $PersonID);
                $aprove_textlink = 'Pentru a aproba concediul va rugam sa apasati <a href="' . $aprove_link . '">aici.</a><br><br>';
                $message_md = str_replace('<<AproveLink>>', $aprove_textlink, $message_md);
                //@mail($to, $row['Subject'], $message, $headers);
                sendMail($row['FromAlias'], $row['FromEmail'], $info['FullName'], $info['Email'], $row['Subject'], $message_md);
            }
            if (!empty($alert_settings['mf'])) {
                $conn->query("SELECT FullName, Email
	                	  FROM   persons
				  WHERE  PersonID = (SELECT FunctionalManagerID FROM payroll WHERE PersonID = $PersonID)");
                if ($row2 = $conn->fetch_array()) {
                    //@mail("\"{$row2['FullName']}\" <{$row2['Email']}>", $row['Subject'], $message, $headers);
                    sendMail($row['FromAlias'], $row['FromEmail'], $row2['FullName'], $row2['Email'], $row['Subject'], $message);
                }
            }
            if (!empty($alert_settings['adm'])) {
                //@mail($to, $row['Subject'], $message, $headers);
                sendMail($row['FromAlias'], $row['FromEmail'], 'Admin HRS', Config::ADMIN_EMAIL, $row['Subject'], $message);
            }
            if (!empty($row['ToAuxEmails'])) {
                $row['ToAuxEmails'] = explode(';', $row['ToAuxEmails']);
                foreach ((array)$alert['ToAuxEmails'] as $to) {
                    //@mail($to, $row['Subject'], $message, $headers);
                    sendMail($row['FromAlias'], $row['FromEmail'], '', $to, $row['Subject'], $message);
                }
            }
        }
//	}
        return $VacationID;
    }

    public static function syncInvoiri($PersonID)
    {
        global $conn;

        $conn->query("SELECT WorkNorm FROM payroll WHERE PersonID = '{$PersonID}'");
        $person = $conn->fetch_array();
        if ($person['WorkNorm'] <= 0) {
            return;
        }

        $inv = array();
        $conn->query("SELECT * FROM vacations_details WHERE Type = 'INV' AND PersonID = '{$PersonID}' AND Aprove != -1 ORDER BY StartDate");
        while ($row = $conn->fetch_array()) {
            $inv[] = $row;
        }

        $conn->query("DELETE FROM persons_invoiri WHERE PersonID = '{$PersonID}'");

        $hours = 0;
        $year_inv = array();

        foreach ($inv as $i) {
            $hours += $i['HoursNo'];
            if ($hours >= $person['WorkNorm']) {
                $days = floor($hours / $person['WorkNorm']);
                $year_inv[date('Y', strtotime($i['StartDate']))] += $days;
                $conn->query("INSERT INTO persons_invoiri(PersonID, StartDate, DaysNo, CreateDate)
                                    VALUES('{$PersonID}', '{$i['StartDate']}', '{$days}', CURRENT_TIMESTAMP)");
                $hours -= $days * $person['WorkNorm'];
            }
        }

        foreach ($year_inv as $year => $i) {
            $conn->query("UPDATE vacations SET Invoire = '{$i}' WHERE PersonID = '{$PersonID}' AND Year = '{$year}' AND Closed = 0");
        }
    }

    public function editVacationDetail($PersonID)
    {
        global $conn, $smarty;
        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $StartHour = '';
        $StopHour = '';
        $time = 0;
        if (empty($_GET['StopDate']) && !empty($_GET['Details'])) {
            $timeStamp = strtotime($StartDate);
            $timeStamp += 24 * 60 * 60 * (Person::$msCEType[$_GET['Details']] - 1);
            $StopDate = date("Y-m-d", $timeStamp);
            $_GET['StopDate'] = date("d-m-Y", $timeStamp);
        } elseif ($_GET['Type'] == "INV") {
            $StopDate = $StartDate;
            $StartHour = $conn->real_escape_string($_GET['StartHour']);
            $StopHour = $conn->real_escape_string($_GET['StopHour']);
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

        } else {
            $StopDate = Utils::toDBDate($_GET['StopDate']);
        }
        if ($StartDate > $StopDate) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Data inceput trebuie sa fie mai mica decat Data sfarsit'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
            exit;
        }
        $old_vacation = array();
        $conn->query("SELECT * FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " LIMIT 1");
        if ($row = $conn->fetch_array()) {
            $old_vacation = $row;
        }
        $conn->query("SELECT a.RoleID, b.CompanyID, b.DirectManagerID FROM persons a INNER JOIN payroll b ON a.PersonID = b.PersonID WHERE a.PersonID = $PersonID");
        if ($row = $conn->fetch_array()) {
            $CompanyID = (int)$row['CompanyID'];
            $RoleID = (int)$row['RoleID'];
            $DirectManagerID = (int)$row['DirectManagerID'];
        } else {
            $CompanyID = 0;
            $RoleID = 0;
            $DirectManagerID = 0;
        }
        $settings = Utils::getCompanySettings($CompanyID, $RoleID);
        $company_settings = Utils::getCompanySettings($CompanyID);
        $app_settings = Utils::getSettings();


        if ($_GET['Type'] == 'CO') {

            if (empty($CompanyID)) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Angajatul nu are compania setata in meniul Personal -> Incadrare'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                exit;
            }


            if (isset($settings['vacation_days']) && $settings['vacation_days'] != '') {
                $minStartDate = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - (int)$settings['vacation_days'], (int)date('Y')));
                if ($StartDate < $minStartDate) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Nu se poate seta o data de inceput mai veche de %s', 'values' => Utils::toDBDate($minStartDate)), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                    exit;
                }
            }
            $vacation_limit = isset($settings['vacation_limit']) ? (int)$settings['vacation_limit'] : 0;
            $query = "SELECT TotalCO, 
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Year = a.Year AND Aprove=1 AND Type = 'CO') AS EffCO
    	              FROM   vacations a
    	              WHERE  a.PersonID = $PersonID AND a.Year = '" . substr($StartDate, 0, 4) . "'";
            $conn->query($query);
            if ($row = $conn->fetch_array()) {
                $new_days = Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], false);
                $conn->query("SELECT DaysNo
	              FROM   vacations_details
		      	WHERE  PersonID = $PersonID AND VacationID = " . (int)$_GET['VacationID']);
                $row2 = $conn->fetch_array();
                $curr_days = $row2['DaysNo'];
                if ($vacation_limit == 1 && ($new_days > ($row['TotalCO'] - $row['EffCO'] + $curr_days))) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Concediul nu poate depasi numarul de zile ramase din an'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                    exit;
                }
            }
        }
        $conn->query("SELECT Type
	              FROM   vacations_details
		      WHERE  PersonID = $PersonID AND VacationID != " . (int)$_GET['VacationID'] . " AND Aprove >= 0 AND
		             (
		                StartDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
			        StopDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
				'{$StartDate}' BETWEEN StartDate AND StopDate
			     )");
        if ($row = $conn->fetch_array()) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Concediul ales se suprapune peste un concediu tip %s', 'values' => $row['Type']), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
            exit;
        }

        if ($_SESSION['ROLEMNG'] == 1) {
            // Check if manager is the authenticated person and has rights to approve self vacation
            if ($PersonID == $_SESSION['PERS'] && $company_settings['vacation']['manager_self_approve'] == 1) {
                $app_settings['vacation_aprove'] = 0;
            }
        } else {
            // Reset $app_settings
            $app_settings = Utils::getSettings();
        }
        if ($_SESSION['USER_ID'] == 1)
            $app_settings['vacation_aprove'] = 0;

        $query = "UPDATE vacations_details SET
	                     Aprove    = '" . ($app_settings['vacation_aprove'] == 1 ? 0 : 1) . "',
			     Year      = '" . substr($StartDate, 0, 4) . "',
    	                     StartDate = '{$StartDate}',
                             StartHour = '{$StartHour}',
    	                     StopDate  = '{$StopDate}',
    	                     StopHour  = '{$StopHour}',
    	                     DaysNo    = '" . Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], $_GET['Type'] == 'CM' ? true : false) . "',
    	                     HoursNo    = '{$time}',
    	                     NoCerere    = '" . (!empty($_GET['NoCerere']) ? $_GET['NoCerere'] : '') . "',
    	                     SerieNum    = '" . (!empty($_GET['SerieNum']) ? $_GET['SerieNum'] : '') . "',
    	                     CodInd    = '" . (!empty($_GET['CodInd']) ? $_GET['CodInd'] : '') . "',
    	                     TipCertif = '" . (!empty($_GET['TipCertif']) ? $_GET['TipCertif'] : '') . "',
    	                     CodCertif = '" . (!empty($_GET['CodCertif']) ? $_GET['CodCertif'] : '') . "',
			     Emitent   = '" . (!empty($_GET['Emitent']) ? Utils::formatStr($_GET['Emitent']) : '') . "',
			     Details   = '" . (!empty($_GET['Details']) ? Utils::formatStr($_GET['Details']) : '') . "',
			     Replacer  = '" . (!empty($_GET['Replacer']) ? $_GET['Replacer'] : '') . "',
			     Notes     = '" . (!empty($_GET['Notes']) ? Utils::formatStr($_GET['Notes']) : '') . "'
    	              WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID";
        //exit;
        $conn->query($query);
        if (!empty($_GET['reason'])) {
            $reason = trim($_GET['reason']);
            if (($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) && !empty($reason)) {
                $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = $PersonID");
                $info = $conn->fetch_array();
                if (!empty($info['Email'])) {
                    include_once('sendMail.php');
                    if ($_GET['Type'] == "INV") {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 35 AND Active = 1");
                        $alert = $conn->fetch_array();
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Aprobare invoire', $reason);
                    } else {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 8 AND Active = 1");
                        $alert = $conn->fetch_array();
                        $message = "Cererea dumneavoastra de CO a fost aprobata pentru o perioada de " . Utils::dateDiff($_GET['StartDate'], $_GET['StopDate'], $_GET['Type'] == 'CM' ? true : false) . " zile in intervalul {$_GET['StartDate']} : {$_GET['StopDate']}<br><br>" .
                            "Motiv aprobare: \"$reason\"";
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Aprobare concediu', $message);
                    }
                }
                $history = "{$StartDate} : {$StopDate} : {$_GET['reason']}\n";
                $conn->query("UPDATE vacations SET History = CONCAT(CASE WHEN History IS NULL THEN '' ELSE History END, '" . mysql_escape_string($history) . "') WHERE PersonID = $PersonID AND Year = '" . substr($StartDate, 0, 4) . "'");
            }
        }
        if ($_GET['Type'] == "INV") {
//            $conn->query("SELECT SUM(a.HoursNo) AS HoursNo, b.WorkNorm FROM vacations_details a LEFT JOIN payroll b ON b.PersonID = a.PersonID WHERE a.PersonID = '{$PersonID}' AND a.Type = 'INV' AND a.Year = '".substr($StartDate, 0, 4)."' AND a.Aprove != -1");
//            if($row = $conn->fetch_array()){
//                $invdays = floor($row['HoursNo']/$row['WorkNorm']);
//                $conn->query("UPDATE vacations SET Invoire = '{$invdays}' WHERE PersonID = '{$PersonID}' AND Year = '".substr($StartDate, 0, 4)."'");
//            }
            Person::syncInvoiri($PersonID);

            //insert line in pontaj_detail for approved INV
            if ($settings['vacation_aprove'] == 0) {
                //get cost center id for PersonID
                $CostCenterID = 0;
                $conn->query("SELECT CostCenterID
							FROM payroll_costcenter 
							WHERE PersonID = '{$PersonID}'");
                if ($row = $conn->fetch_array()) {
                    $CostCenterID = $row['CostCenterID'];
                }

                if (!empty($old_vacation)) {
                    $conn->query("DELETE FROM pontaj_detail WHERE PersonID = {$PersonID} AND StartDate = '" . $old_vacation['StartDate'] . "' AND StartHour = '" . $old_vacation['StartHour'] . "' AND EndDate = '" . $old_vacation['StopDate'] . "' AND EndHour = '" . $old_vacation['StopHour'] . "' AND Type = 2");
                }

                //insert line in pontaj detail
                $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                      VALUES('{$_SESSION['USER_ID']}', $PersonID, '{$StartDate}', '{$StartHour}', '{$StopDate}', '{$StopHour}', '-{$time}', 0, '{$CostCenterID}', 2, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");

            }
        }
    }

    public function delVacationDetail($PersonID)
    {
        global $conn, $smarty;

        $conn->query("SELECT Year, Type FROM vacations_details WHERE VacationID = '" . (int)$_GET['VacationID'] . "'");
        if ($row = $conn->fetch_array()) {
            $year = $row['Year'];
            $type = $row['Type'];
            $invdays = 0;
        }

        if (!empty($_GET['reason'])) {
            $reason = trim($_GET['reason']);
            if (($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) && !empty($reason)) {
                $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = $PersonID");
                $info = $conn->fetch_array();
                if (!empty($info['Email'])) {
                    include_once('sendMail.php');
                    if (!empty($type) && $type == "INV") {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 35 AND Active = 1");
                        $alert = $conn->fetch_array();
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Stergere invoire', $reason);
                    } else {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 8 AND Active = 1");
                        $alert = $conn->fetch_array();
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Stergere concediu', $reason);
                    }
                }
                $conn->query("SELECT Year, StartDate, StopDate FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID");
                $row = $conn->fetch_array();
                $history = "{$row['StartDate']} : {$row['StopDate']} : DEL : {$_GET['reason']}\n";
                $conn->query("UPDATE vacations SET History = CONCAT(CASE WHEN History IS NULL THEN '' ELSE History END, '" . mysql_escape_string($history) . "') WHERE PersonID = $PersonID AND Year = '" . $row['Year'] . "'");
            }
        }
        if ($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) {
            $conn->query("DELETE FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID");
        } else {
            $conn->query("DELETE FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID AND Aprove <= 0");
            if (!$conn->get_affected_rows()) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Concediul nu poate fi sters fiind aprobat'), $smarty) . "!'); window.location.href = './?m=persons&o=vacation&PersonID={$PersonID}';\"></body>";
                exit;
            }
        }

        if ($type == 'INV') {
//            $conn->query("SELECT SUM(a.HoursNo) AS HoursNo, b.WorkNorm FROM vacations_details a LEFT JOIN payroll b ON b.PersonID = a.PersonID WHERE a.PersonID = '{$PersonID}' AND a.Type = 'INV' AND a.Year = '".$year."' AND a.Aprove != -1");
//            if($row = $conn->fetch_array()){
//                $invdays = floor($row['HoursNo']/$row['WorkNorm']);
//            }
//            $conn->query("UPDATE vacations SET Invoire = '{$invdays}' WHERE PersonID = '{$PersonID}' AND Year = '".$year."'");
            Person::syncInvoiri($PersonID);
        }
    }

    public function aproveVacationDetail($PersonID)
    {
        global $conn, $smarty;

        $conn->query("SELECT Year, Type FROM vacations_details WHERE VacationID = '" . (int)$_GET['VacationID'] . "'");
        if ($row = $conn->fetch_array()) {
            $type = $row['Type'];
        }

        if (($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1)) {
            $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = $PersonID");
            $info = $conn->fetch_array();
            if (!empty($info['Email'])) {
                include_once('sendMail.php');
                if (!empty($type) && $type == "INV") {
                    $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 35 AND Active = 1");
                    $alert = $conn->fetch_array();
                    $message = "Cererea dumneavoastra de invoire a fost aprobata.";
                    sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Aprobare invoire', $message);
                } else {
                    $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 8 AND Active = 1");
                    $alert = $conn->fetch_array();
                    $message = "Cererea dumneavoastra de CO a fost aprobata.";
                    sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Aprobare concediu', $message);
                }
            }
            $conn->query("SELECT Year, StartDate, StopDate FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID");
            $row = $conn->fetch_array();
            $history = "{$row['StartDate']} : {$row['StopDate']} : APROVED}\n";
            $conn->query("UPDATE vacations SET History = CONCAT(CASE WHEN History IS NULL THEN '' ELSE History END, '" . mysql_escape_string($history) . "') WHERE PersonID = $PersonID AND Year = '" . $row['Year'] . "'");
        }

        if ($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) {
            $conn->query("UPDATE vacations_details SET Aprove = 1 WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID AND Aprove = 0");
        }

        if ($type == 'INV') {
            Person::syncInvoiri($PersonID);
        }
    }

    public function rejectVacationDetail($PersonID)
    {
        global $conn, $smarty;

        $conn->query("SELECT Year, Type FROM vacations_details WHERE VacationID = '" . (int)$_GET['VacationID'] . "'");
        if ($row = $conn->fetch_array()) {
            $year = $row['Year'];
            $type = $row['Type'];
            $invdays = 0;
        }


        if (!empty($_GET['reason'])) {
            $reason = trim($_GET['reason']);
            if (($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) && !empty($reason)) {
                $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = $PersonID");
                $info = $conn->fetch_array();
                if (!empty($info['Email'])) {
                    include_once('sendMail.php');
                    if (!empty($type) && $type == "INV") {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 35 AND Active = 1");
                        $alert = $conn->fetch_array();
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Respingere invoire', $reason);
                    } else {
                        $conn->query("SELECT FromEmail, FromAlias FROM alert WHERE ID = 8 AND Active = 1");
                        $alert = $conn->fetch_array();
                        $message = "Cererea dumneavoastra de CO a fost respinsa. Va rugam sa va planficati concediul in alta perioada.<br><br>" .
                            "Motiv respingere:<br>\"$reason\"";
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], 'Respingere concediu', $message);
                    }
                }
                $conn->query("SELECT Year, StartDate, StopDate FROM vacations_details WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID");
                $row = $conn->fetch_array();
                $history = "{$row['StartDate']} : {$row['StopDate']} : REJECT : {$_GET['reason']}\n";
                $conn->query("UPDATE vacations SET History = CONCAT(CASE WHEN History IS NULL THEN '' ELSE History END, '" . mysql_escape_string($history) . "') WHERE PersonID = $PersonID AND Year = '" . $row['Year'] . "'");
            }
        }
        if ($_SESSION['USER_ID'] == 1 || $_SESSION['ROLEMNG'] == 1) {
            $conn->query("UPDATE vacations_details SET Aprove = -1 WHERE VacationID = " . (int)$_GET['VacationID'] . " AND PersonID = $PersonID AND Aprove = 0");
        }

        if ($type == 'INV') {
//            $conn->query("SELECT SUM(a.HoursNo) AS HoursNo, b.WorkNorm FROM vacations_details a LEFT JOIN payroll b ON b.PersonID = a.PersonID WHERE a.PersonID = '{$PersonID}' AND a.Type = 'INV' AND a.Year = '".$year."' AND a.Aprove != -1");
//            if($row = $conn->fetch_array()){
//                $invdays = floor($row['HoursNo']/$row['WorkNorm']);
//                $conn->query("UPDATE vacations SET Invoire = '{$invdays}' WHERE PersonID = '{$PersonID}' AND Year = '".$year."'");
//            }
            Person::syncInvoiri($PersonID);
        }
    }

    public function getCarInfo($PersonID)
    {

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][1][1][13] > 0)) {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][13]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][13]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $car_info = array();
        $query = "SELECT a.FullName, a.Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
    	          FROM   persons a
    	          WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $car_info = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
        $query = "SELECT a.*, b.StartDate, b.StopDate
    	          FROM   cars a
			 INNER JOIN cars_resp b ON a.CarID = b.CarID AND b.PersonID = $PersonID
		  ORDER  BY b.StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $car_info['Cars'][$row['CarID']] = $row;
        }

        foreach ((array)$car_info['Cars'] as $CarID => $v) {
//	    $query = "SELECT a.* , b.CompanyName
//	              FROM   cars_assurance a
//		             LEFT JOIN companies b ON a.CompanyID = b.CompanyID
//		      WHERE  a.CarID = '{$CarID}' AND a.Status = 1
//		      ORDER  BY a.Type, a.StartDate";

            $query = "SELECT a.CarID, a.Cost, a.Coin, a.Km, c.CostTypeID, b.StartDate, b.StopDate, d.CostType, e.CompanyName
                            FROM cars_cost a
                            INNER JOIN cars_cost_details b ON b.CostID = a.ID
                            INNER JOIN cars_dictionary c ON b.CostTypeID_Dictionary = c.ID
                            INNER JOIN cars_costtype d ON d.CostTypeID = c.CostTypeID AND d.CostGroup = 1
                            LEFT JOIN companies e ON e.CompanyID = a.CompanyID
                            WHERE ((CURRENT_DATE BETWEEN b.StartDate AND b.StopDate AND a.CarID = '{$CarID}') OR (CURRENT_DATE >= b.StartDate AND (b.StopDate IS NULL OR b.StopDate = '' OR b.StopDate = '0000-00-00')))";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $car_info['Assurance'][$row['CarID']][$row['CostTypeID']] = $row;
            }
        }

        $query = "SELECT a.CarID, a.CarType, a.Brand, a.Model, a.RegNo, a.Fuel, a.ConsumptionCombined, a.ConsumptionUrban,
	                 b.StartDate, b.StopDate, b.StartDateKm, b.StopDateKm,
			 (SELECT COUNT(1) FROM cars_sheets_users WHERE SheetID = c.SheetID) AS PersNo
    	          FROM   cars a
			 INNER JOIN cars_sheets b ON a.CarID = b.CarID 
			 INNER JOIN cars_sheets_users c ON b.ID = c.SheetID AND c.PersonID = $PersonID
		  ORDER  BY b.StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($car_info['Sheets'][$row['CarID']][0])) {
                $car_info['Sheets'][$row['CarID']][0] = $row;
            }
            @$car_info['Sheets'][$row['CarID']][$row['StartDate']] = $row;
        }

        return $car_info;
    }

    public function getAuthInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][15]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][15]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT FullName, Status, DateOfBirth, Username, Password, AuthMessageType, AuthMessageBody, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
    	          FROM   persons a
    	          WHERE  PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $parts = explode(' ', $row['FullName']);
            $row['suggest'] = substr($parts[0], 0, 3) . (isset($parts[1]) ? substr($parts[1], 0, 3) : '') . str_replace('-', '', substr(Utils::toDBDate($row['DateOfBirth']), 0, 5));
            if ($row['AuthMessageType'] == 'personalizat' && !empty($row['AuthMessageBody'])) {
                $row['AuthMessageBody'] = stripslashes($row['AuthMessageBody']);
            } else {
                $conn->query("SELECT Body FROM alert WHERE ID = 16");
                if ($alert = $conn->fetch_array()) {
                    $row['AuthMessageBody'] = stripslashes($alert['Body']);
                }
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function setAuthInfo($PersonID)
    {

        global $conn;

        $_POST['Username'] = trim($_POST['Username']);
        $_POST['Password'] = trim($_POST['Password']);

        if (empty($_POST['Username'])) {
            throw new Exception(Message::getMessage('USERNAME_EMPTY'));
        }

        if (empty($_POST['Password'])) {
            throw new Exception(Message::getMessage('PASSWORD_EMPTY'));
        }

        if (!Utils::checkPassword($_POST['Password'])) {
            throw new Exception(Message::getMessage('PASSWORD_FORMAT_ERROR'));
        }

        if ($_POST['Password'] != $_POST['Password2']) {
            throw new Exception(Message::getMessage('PASSWORD_RETYPE_ERROR'));
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][15]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET 
					    Username 		= '" . Utils::formatStr($_POST['Username']) . "', 
					    Password 		= md5('" . ($_POST['Password']) . "'),
					    ChgPwLastDate	= CURRENT_TIMESTAMP
    	              WHERE PersonID = $PersonID AND ($condrw)");

        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_PERSON'));
        }

        self::sendAuthInfo($PersonID);
    }

    private function sendAuthInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][15]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $AuthMessageBody = $_POST['AuthMessageType'] == 'personalizat' && !empty($_POST['AuthMessageBody']) ? $_POST['AuthMessageBody'] : '';
        $conn->query("UPDATE persons a SET 
							AuthMessageType = '" . $_POST['AuthMessageType'] . "', 
							AuthMessageBody = '" . Utils::formatStr($AuthMessageBody) . "'
						  WHERE PersonID = $PersonID AND ($condrw)");
        if ($_POST['AuthMessageType'] != '') {
            $conn->query("SELECT FullName, Email FROM persons WHERE PersonID = $PersonID");
            $info = $conn->fetch_array();
            if (!empty($info['Email'])) {
                $conn->query("SELECT Subject, Body, FromEmail, FromAlias FROM alert WHERE ID = 16");
                $alert = $conn->fetch_array();
                $subject = $alert['Subject'];
                $message = str_replace(array('<<username>>', '<<password>>'), array($_POST['Username'], $_POST['Password']), !empty($AuthMessageBody) ? $AuthMessageBody : stripslashes($alert['Body']));
                include_once('sendMail.php');
                sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, nl2br($message));
            }
        }
    }

    public function getAccessPerfInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][16]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][16]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT FullName, Status, AccessPerf, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
    	          FROM   persons a
    	          WHERE  PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function setAccessPerfInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][16]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET AccessPerf = '" . ((!empty($_POST['accessperf'][1]) ? 1 : 0) + (!empty($_POST['accessperf'][2]) ? 2 : 0)) . "'
    	              WHERE PersonID = $PersonID AND ($condrw)");
    }

    public function getAccessEvalInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][17]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT FullName, Status, AccessEval, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
    	          FROM   persons a
    	          WHERE  PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }


    ### Get Person Data from Excel

    public function getAccessColleaguesEvalInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][17]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT FullName, Status, AccessColleaguesEval, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	    	          FROM   persons a
	    	          WHERE  PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    ### Import Person Data

    public function getAccessSurvey($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][17]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT FullName, Status, AccessSurvey, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	    	          FROM   persons a
	    	          WHERE  PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    ### Import Person Data

    public function setAccessEvalInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET AccessEval = '" . ((!empty($_POST['accesseval'][1]) ? 1 : 0) + (!empty($_POST['accesseval'][2]) ? 2 : 0)) . "'
    	              WHERE PersonID = $PersonID AND ($condrw)");
    }

    ### Get Person Salary Data from Excel

    public function setColleaguesAccessEvalInfo($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET AccessColleaguesEval = '" . ((!empty($_POST['colleaguesaccesseval'][1]) ? 1 : 0) + (!empty($_POST['colleaguesaccesseval'][2]) ? 2 : 0)) . "'
    	              WHERE PersonID = $PersonID AND ($condrw)");
    }

### Import Person Data

    public function setAccessSurvey($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][1][1][17]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET AccessSurvey = '" . ((!empty($_POST['survey'][1]) ? 1 : 0) + (!empty($_POST['survey'][2]) ? 2 : 0)) . "'
    	              WHERE PersonID = $PersonID AND ($condrw)");
    }

    ### Get Person Avans Data from Excel

    public function setAntropometrie($PersonID, $info = array())
    {

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][18]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons_antropometrie a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO persons_antropometrie(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                          VALUES({$_SESSION['USER_ID']}, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    ### Import Avans Data

    public function setMilitary($PersonID, $info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            foreach ($_GET as &$v) {
                if (!is_numeric($v) && !is_array($v)) {
                    $v = Utils::formatStr($v);
                }
            }
            switch ($_GET['action']) {
                case 'new':
                    $conn->query("INSERT INTO persons_permis_arma(UserID, PersonID, Emitent, Serie, No, StartDate, StopDate, CreateDate)
    				              VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, '{$_GET['Emitent']}', '{$_GET['Serie']}', '{$_GET['No']}', '" . Utils::toDBDate($_GET['StartDate']) . "', '" . Utils::toDBDate($_GET['StopDate']) . "', CURRENT_TIMESTAMP)");
                    break;
                case 'edit':
                    $conn->query("UPDATE persons_permis_arma SET
    				                     Emitent       = '{$_GET['Emitent']}',
    				                     Serie         = '{$_GET['Serie']}',
    				                     No            = '{$_GET['No']}',
    				                     StartDate     = '" . Utils::toDBDate($_GET['StartDate']) . "',
    				                     StopDate      = '" . Utils::toDBDate($_GET['StopDate']) . "'
    				              WHERE  PermisID = {$_GET['PermisID']} AND PersonID = {$this->PersonID}");
                    break;
                case 'del':
                    $conn->query("DELETE FROM persons_permis_arma WHERE PermisID = {$_GET['PermisID']} AND PersonID = {$this->PersonID}");
                    break;
            }
            header('Location: ./?m=persons&o=military&PersonID=' . $this->PersonID);
            exit;
        }

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);
        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][20]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons_military a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO persons_military(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                          VALUES({$_SESSION['USER_ID']}, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    ### Get Person Prime Data from Excel

    public function getPermisArma()
    {

        global $conn;

        $conn->query("SELECT * FROM persons_permis_arma WHERE PersonID = {$this->PersonID} ORDER BY StartDate");
        $permis = array();
        while ($row = $conn->fetch_array()) {
            $permis[$row['PermisID']] = $row;
        }
        return $permis;
    }

    ### Import Prime Data

    public function getPersonProjects()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][24]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][24]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $res = array();
        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = {$this->PersonID} AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $res[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT * FROM persons_projects WHERE PersonID = {$this->PersonID} ORDER BY Year DESC, Month DESC");

        while ($row = $conn->fetch_array()) {
            $res[$row['ID']] = $row;
        }
        return $res;
    }

    public function setPersonProjects($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'new':
                    $conn->query("INSERT INTO persons_projects(UserID, PersonID, ProjectID, Year, Month, Hours, CreateDate)
    				              VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, '{$info['ProjectID']}', '{$info['Year']}', '{$info['Month']}','{$info['Hours']}', CURRENT_TIMESTAMP)");
                    break;
                case 'edit':
                    echo $query = "UPDATE persons_projects SET
    				                     ProjectID       = '{$info['ProjectID']}',
    				                     Year         	 = '{$info['Year']}',
    				                     Month           = '{$info['Month']}',
    				                     Hours     		 = '{$info['Hours']}'
    				              WHERE  ID = {$_GET['ID']} AND PersonID = {$this->PersonID}";
                    $conn->query($query);
                    break;
                case 'del':
                    $conn->query("DELETE FROM persons_projects WHERE ID = {$_GET['ID']} AND PersonID = {$this->PersonID}");
                    break;
            }
            header('Location: ./?m=persons&o=projects&PersonID=' . $this->PersonID);
            exit;
        }
    }

    public function getCompanyID()
    {
        global $conn;
        $conn->query("SELECT CompanyID FROM payroll WHERE PersonID = '{$this->PersonID}' LIMIT 1");
        $row = $conn->fetch_array();
        return $row['CompanyID'];
    }
}

?>
