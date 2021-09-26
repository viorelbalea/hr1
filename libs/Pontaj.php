<?php

class Pontaj extends ConfigData
{

    public static function getPontajRoles()
    {

        global $conn;

        $roles = array();
        $conn->query("SELECT UserID, UserName, UserRights FROM users WHERE UserType = 'role' ORDER BY UserName");
        while ($row = $conn->fetch_array()) {
            $rights = explode(',', $row['UserRights']);
            if (in_array(11, $rights)) {
                $roles[$row['UserID']] = $row['UserName'];
            }
        }
        return $roles;
    }

    public static function addActivity($ProjectID)
    {

        global $conn;

        $conn->query("INSERT INTO pontaj_project_activities(ProjectID, Activity, StartDate, EndDate, EndDateRevised, CreateDate, LastUpdateDate)
	              VALUES('{$ProjectID}', '" . Utils::formatStr($_POST['Activity']) . "', 
	                     '" . Utils::toDBDate($_POST['StartDate']) . "', '" . Utils::toDBDate($_POST['EndDate']) . "', 
	                     '" . (!empty($_POST['EndDateRevised']) ? Utils::toDBDate($_POST['EndDateRevised']) : '') . "', 
	                     CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        $ActivityID = $conn->get_insert_id();
        if (!empty($_POST['Roles'])) {
            foreach ($_POST['Roles'] as $k => $v) {
                $conn->query("INSERT INTO pontaj_activity_roles(ActivityID, RoleID) VALUES('$ActivityID', '$v')");
            }
        }
        if (!empty($_POST['Phases'])) {
            foreach ($_POST['Phases'] as $k => $v) {
                $conn->query("INSERT INTO pontaj_activity_phases(ActivityID, PhaseID) VALUES('$ActivityID', '$v')");
            }
        }
    }

    public static function editActivity($ProjectID, $ActivityID)
    {

        global $conn;

        $conn->query("UPDATE pontaj_project_activities SET 
							    Activity	   = '" . Utils::formatStr($_POST['Activity']) . "', 
							    StartDate	   = '" . Utils::toDBDate($_POST['StartDate']) . "', 
							    EndDate	   = '" . Utils::toDBDate($_POST['EndDate']) . "', 
							    EndDateRevised = '" . (!empty($_POST['EndDateRevised']) ? Utils::toDBDate($_POST['EndDateRevised']) : '') . "',
							    Active         = '" . (!empty($_POST['Active']) ? 1 : 0) . "',
							    LastUpdateDate = CURRENT_TIMESTAMP
		      WHERE ActivityID = '$ActivityID' AND ProjectID = '$ProjectID'");
        $conn->query("DELETE FROM pontaj_activity_roles WHERE ActivityID = '$ActivityID'");
        if (!empty($_POST['Roles'])) {
            foreach ($_POST['Roles'] as $k => $v) {
                $conn->query("INSERT INTO pontaj_activity_roles(ActivityID, RoleID) VALUES('$ActivityID', '$v')");
            }
        }
        $conn->query("DELETE FROM pontaj_activity_phases WHERE ActivityID = '$ActivityID'");
        if (!empty($_POST['Phases'])) {
            foreach ($_POST['Phases'] as $k => $v) {
                $conn->query("INSERT INTO pontaj_activity_phases(ActivityID, PhaseID) VALUES('$ActivityID', '$v')");
            }
        }
    }

    public static function deleteActivity($ProjectID, $ActivityID)
    {

        global $conn;

        $conn->query("DELETE FROM pontaj_project_activities 
	              WHERE  ActivityID = '$ActivityID' AND ProjectID = '$ProjectID' AND
	                     NOT EXISTS (SELECT ActivityID FROM pontaj WHERE ActivityID = '$ActivityID' AND ProjectID = '$ProjectID' AND Hours > 0)");
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Nu se poate sterge aceasta activitate deoarece este pontata! Se poate inactiva.'); window.location.href = './?m=pontaj&o=edit_project&ProjectID={$ProjectID}';\"></body>";
            exit;
        } else {
            $conn->query("DELETE FROM pontaj_activity_roles WHERE ActivityID = '$ActivityID'");
            $conn->query("DELETE FROM pontaj_activity_phases WHERE ActivityID = '$ActivityID'");
            $conn->query("DELETE FROM pontaj WHERE ActivityID = '$ActivityID' AND ProjectID = '$ProjectID'");
        }
    }

    public static function getProjectActivities($ProjectID)
    {

        global $conn;

        $activities = array();
        $conn->query("SELECT a.*, b.RoleID, c.PhaseID
	              FROM   pontaj_project_activities a
	                     LEFT JOIN pontaj_activity_roles b ON a.ActivityID = b.ActivityID
	                     LEFT JOIN pontaj_activity_phases c ON a.ActivityID = c.ActivityID
	              WHERE  a.ProjectID = '$ProjectID' 
	              ORDER  BY a.ActivityID");
        while ($row = $conn->fetch_array()) {
            if (!isset($activities[$row['ActivityID']])) {
                $row['Activity'] = stripslashes($row['Activity']);
                $row['StartDate'] = Utils::toDBDate($row['StartDate']);
                $row['EndDate'] = Utils::toDBDate($row['EndDate']);
                $row['EndDateRevised'] = $row['EndDateRevised'] != '0000-00-00' ? Utils::toDBDate($row['EndDateRevised']) : '';
                $activities[$row['ActivityID']] = $row;
                $activities[$row['ActivityID']]['Roles'][$row['RoleID']] = $row['RoleID'];
                $activities[$row['ActivityID']]['Phases'][$row['PhaseID']] = $row['PhaseID'];
            } else {
                $activities[$row['ActivityID']]['Roles'][$row['RoleID']] = $row['RoleID'];
                $activities[$row['ActivityID']]['Phases'][$row['PhaseID']] = $row['PhaseID'];
            }
        }
        return $activities;
    }

    public static function getAllPersons($action = '')
    {

        global $conn;

        $cond = "";

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND h.DistrictID = " . (int)$_GET['DistrictID'];
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND g.CityID = " . (int)$_GET['CityID'];
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
            if (($pos = strpos($_GET['Status'], '_')) !== false) {
                $cond .= " AND a.SubStatus = " . (int)substr($_GET['Status'], $pos + 1);
            }
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID 
					    FROM   payroll 
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        } elseif (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID 
					    FROM   payroll 
					    WHERE  DepartmentID IN (SELECT DepartmentID FROM departments WHERE DivisionID = " . (int)$_GET['DivisionID'] . ")
					)";
        }

        if (!empty($_GET['CostCenterID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        if (!empty($_GET['Sex'])) {
            $cond .= " AND a.Sex = '{$_GET['Sex']}'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
                     '{$_SESSION['USER_RIGHTS2'][11][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(DISTINCT a.PersonID) AS total
                   FROM   persons a
                          INNER JOIN pontaj_activity_roles b ON a.RoleID = b.RoleID
                          INNER JOIN pontaj_project_activities c ON b.ActivityID = c.ActivityID
                          INNER JOIN pontaj_projects d ON c.ProjectID = d.ProjectID AND d.Type != 4
                          LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          LEFT  JOIN payroll i ON i.PersonID = a.PersonID
                          LEFT  JOIN departments k ON k.DepartmentID = i.DepartmentID
		    WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT DISTINCT a.*, g.CityName, h.DistrictName, i.DepartmentID, i.FunctionID,
                          FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, k.DivisionID,
                          GROUP_CONCAT(DISTINCT(m.CostCenter) ORDER BY m.CostCenter ASC SEPARATOR ', ') AS CostCenters
                   FROM   persons a
                          INNER JOIN pontaj_activity_roles b ON a.RoleID = b.RoleID
                          INNER JOIN pontaj_project_activities c ON b.ActivityID = c.ActivityID
                          INNER JOIN pontaj_projects d ON c.ProjectID = d.ProjectID AND d.Type != 4
                          LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          LEFT JOIN payroll i ON i.PersonID = a.PersonID
                          LEFT JOIN departments k ON k.DepartmentID = i.DepartmentID
                          LEFT JOIN payroll_costcenter l ON a.PersonID=l.PersonID
			  LEFT JOIN costcenter m ON l.CostCenterID=m.CostCenterID
		   WHERE  ($condbase) $cond
			   GROUP BY a.PersonID
	           ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getPontajByPerson($PersonID)
    {

        global $conn, $smarty, $days, $totalg, $FullName, $CompanyID;

        if (!empty($_GET['year']) && !empty($_GET['month']) && !empty($_GET['day'])) {
            $curr_date = $_GET['year'] . '-' . ($_GET['month'] <= 9 ? '0' : '') . $_GET['month'] . '-' . ($_GET['day'] <= 9 ? '0' : '') . $_GET['day'];
            $curr_year = $_GET['year'];
            $curr_month = $_GET['month'];
            $curr_day = $_GET['day'];
        } else {
            $curr_date = date('Y-m-d');
            $curr_year = date('Y');
            $curr_month = date('m');
            $curr_day = date('d');
        }

        $weekday = date('w', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));
        $days = array();

        if ($weekday == 0) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
        } elseif ($weekday == 1) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        } else {
            $days[] = $curr_date;
            for ($i = 1; $i < $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
            for ($i = 1; $i <= 7 - $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        }
        sort($days);

        if (!empty($_GET['prev'])) {
            $prev = 7 * (int)$_GET['prev'];
            foreach ($days as $k => $v) {
                $days[$k] = date('Y-m-d', mktime(0, 0, 0, (int)substr($v, 5, 2), (int)substr($v, 8) - $prev, (int)substr($v, 0, 4)));
            }
        }

        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
		      '{$_SESSION['USER_RIGHTS2'][11][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, a.RoleID, b.CompanyID
	              FROM   persons a 
		             INNER JOIN payroll b ON a.PersonID = b.PersonID
		      WHERE  a.PersonID = '{$PersonID}' AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $RoleID = $row['RoleID'];
            $FullName = $row['FullName'];
            $CompanyID = $row['CompanyID'];
        } else {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']), $smarty) . "!'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
            exit;
        }

        if (count($_GET) == 3 || (count($_GET) == 2 && $PersonID == $_SESSION['PERS'])) {
            $_SESSION['PONTAJ'] = array();
            $_SESSION['PONTAJ'][$PersonID][1] = array();
        }

        if (!empty($_GET['ProjectID']) && !empty($_GET['PhaseID'])) {
            foreach ($_SESSION['PONTAJ'][$PersonID] as $k => $v) {
                if ($v['ProjectID'] == $_GET['ProjectID'] && $v['PhaseID'] == $_GET['PhaseID'] && $k != $_GET['sel_index']) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Ati facut deja aceasta selectie'), $smarty) . "!'); window.location.href = './?m=pontaj&o=pontaj&PersonID=$PersonID&ProjectID={$_GET['ProjectID']}&sel_index={$_GET['sel_index']}';\"></body>";
                    exit;
                }
            }
        }

        if (!empty($_GET['ProjectID'])) {
            $ProjectID = (int)$_GET['ProjectID'];
            $sel_index = !empty($_GET['sel_index']) ? (int)$_GET['sel_index'] : 1;
            $_SESSION['PONTAJ'][$PersonID][$sel_index]['ProjectID'] = $ProjectID;
            if (isset($_GET['PhaseID'])) {
                $PhaseID = (int)$_GET['PhaseID'];
                $_SESSION['PONTAJ'][$PersonID][$sel_index]['PhaseID'] = $PhaseID;
                $next_index = count($_SESSION['PONTAJ'][$PersonID]);
                if (!empty($_SESSION['PONTAJ'][$PersonID][$next_index])) {
                    $_SESSION['PONTAJ'][$PersonID][++$next_index] = array();
                }
            }
        }

        //self::$msPhases = self::getPhases();

        $pontaj = array();
        $query = "SELECT a.ActivityID, a.Activity, a.Active, b.ProjectID, b.Code, b.Name, b.Phase, d.PhaseID, e.Phase AS PhaseName
                   FROM   pontaj_project_activities a
                          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID AND b.Type != 4
                          INNER JOIN pontaj_activity_roles c ON a.ActivityID = c.ActivityID AND c.RoleID = $RoleID
                          LEFT JOIN pontaj_activity_phases d ON a.ActivityID = d.ActivityID
			  LEFT JOIN pontaj_phases e ON d.PhaseID = e.PhaseID
                   WHERE  (CASE WHEN a.StartDate BETWEEN '{$days[0]}' AND '{$days[6]}' THEN a.StartDate BETWEEN '{$days[0]}' AND '{$days[6]}' ELSE a.StartDate <= '{$days[0]}' END) AND
		          EXISTS (SELECT ID FROM persons_projects WHERE ProjectID = a.ProjectID AND PersonID='$PersonID')
                   ORDER  BY b.Name, e.Phase, a.Activity";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $pontaj[$row['ProjectID']]['code'] = $row['Code'];
            $pontaj[$row['ProjectID']]['name'] = stripslashes($row['Name']);
            $pontaj[$row['ProjectID']]['phase'] = $row['Phase'];
            $row['PhaseID'] = (int)$row['PhaseID'];
            $pontaj[$row['ProjectID']]['phases'][$row['PhaseID']]['name'] = $row['PhaseName']; // self::$msPhases[$row['PhaseID']];
            $pontaj[$row['ProjectID']]['phases'][$row['PhaseID']]['activities'][$row['ActivityID']]['name'] = stripslashes($row['Activity']);
            $pontaj[$row['ProjectID']]['phases'][$row['PhaseID']]['activities'][$row['ActivityID']]['active'] = $row['Active'];
        }

        foreach ((array)$_SESSION['PONTAJ'][$PersonID] as $sel_index => $sel) {
            if (!empty($sel['ProjectID']) && isset($sel['PhaseID'])) {
                $query = "SELECT * 
    	                  FROM   pontaj 
    	                  WHERE  PersonID = '{$PersonID}'
    	                         AND ProjectID = '{$sel['ProjectID']}'" .
                    ($sel['PhaseID'] > 0 ? " AND PhaseID = '{$sel['PhaseID']}'" : "") . " AND 
    	                         Data BETWEEN '{$days[0]}' AND '{$days[6]}'";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $pontaj[$row['ProjectID']]['phases'][$row['PhaseID']]['activities'][$row['ActivityID']]['hours'][$row['Data']] = $row['Hours'];
                    @$pontaj[$row['ProjectID']]['total'][$row['Data']] += $row['Hours'];
                }
            }
        }

        $query = "SELECT Data, SUM(Hours) AS THours
    	          FROM   pontaj 
    	          WHERE  PersonID = '{$PersonID}' AND Data BETWEEN '{$days[0]}' AND '{$days[6]}'
		  GROUP  BY Data";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $totalg[$row['Data']] = $row['THours'];
        }

        return $pontaj;
    }

    public static function setPontajByPerson($PersonID)
    {

        global $conn;

        foreach ($_POST['hours'] as $k => $v) {
            foreach ($v as $kk => $vv) {
                foreach ($vv as $kkk => $vvv) {
                    foreach ($vvv as $kkkk => $vvvv) {
                        $vvvv = (int)$vvvv;
                        $conn->query("SELECT id FROM pontaj WHERE PersonID = '$PersonID' AND ProjectID = '$k' AND PhaseID = '$kk' AND ActivityID = '$kkk' AND Data = '$kkkk'");
                        if ($row = $conn->fetch_array()) {
                            $conn->query("UPDATE pontaj SET Hours = '$vvvv' WHERE id = '{$row['id']}'");
                        } else {
                            if ($vvvv > 0) {
                                $conn->query("INSERT INTO pontaj(ProjectID, PhaseID, ActivityID, Data, Hours, PersonID, CreateDate)
			                      VALUES('$k', '$kk', '$kkk', '$kkkk', '$vvvv', '$PersonID', CURRENT_TIMESTAMP)");
                            }
                        }
                    }
                }
            }
        }
    }

    public static function getPersonsByPontaj()
    {

        global $conn;

        $persons = array();

        $conn->query("SELECT DISTINCT a.PersonID, b.FullName
	              FROM   pontaj a 
	                     INNER JOIN persons b ON a.PersonID = b.PersonID
	              ORDER  BY b.FullName");
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }

        return $persons;
    }

    public static function getProjectsByPontaj()
    {

        global $conn;

        $persons = array();

        $conn->query("SELECT DISTINCT a.ProjectID, b.Name
	              FROM   pontaj a 
	                     INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
	              ORDER  BY b.Name");
        while ($row = $conn->fetch_array()) {
            $persons[$row['ProjectID']] = $row['Name'];
        }

        return $persons;
    }

    public static function setViewHoursLog()
    {
        global $conn;

        $conn->query("SELECT LogID FROM persons_log WHERE PID = '" . $_SESSION['PERS'] . "' AND Type = 7 AND CURRENT_DATE = DATE_FORMAT(CreateDate, '%Y-%m-%d')");
        $check = $conn->fetch_array();

        if (empty($check['LogID'])) {
            $conn->query("INSERT INTO persons_log (UserID, PID, PersonID, Type, Comment, CreateDate)
                            VALUES('" . $_SESSION['USER_ID'] . "', '" . $_SESSION['PERS'] . "', '" . $_SESSION['PERS'] . "', 7, 'Vizualizare pontaj ore', CURRENT_TIMESTAMP)");
        }

    }

    public static function getAllPersonsSimple($action = '')
    {

        global $conn;

        $cond = "";

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND h.DistrictID = " . (int)$_GET['DistrictID'];
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND g.CityID = " . (int)$_GET['CityID'];
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
            if (($pos = strpos($_GET['Status'], '_')) !== false) {
                $cond .= " AND a.SubStatus = " . (int)substr($_GET['Status'], $pos + 1);
            }
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID 
					    FROM   payroll 
					    WHERE  DepartmentID = " . (int)$_GET['DepartmentID'] . "
					)";
        } elseif (!empty($_GET['DivisionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT PersonID 
					    FROM   payroll 
					    WHERE  DivisionID = " . (int)$_GET['DivisionID'] . "
					)";
        }

        if (!empty($_GET['CostCenterID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        if (!empty($_GET['Sex'])) {
            $cond .= " AND a.Sex = '{$_GET['Sex']}'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][2]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
                     '{$_SESSION['USER_RIGHTS2'][11][2]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(DISTINCT a.PersonID) AS total
                   FROM   persons a
                	  LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          LEFT  JOIN payroll i ON i.PersonID = a.PersonID
                          LEFT  JOIN departments k ON k.DepartmentID = i.DepartmentID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT DISTINCT a.*, g.CityName, h.DistrictName, i.DepartmentID, i.FunctionID,
                          FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, k.DivisionID
                   FROM   persons a
                	  LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          LEFT  JOIN payroll i ON i.PersonID = a.PersonID
                          LEFT  JOIN departments k ON k.DepartmentID = i.DepartmentID
                   WHERE  ($condbase) $cond
	           ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getPontajByDay($PersonID)
    {

        global $conn, $smarty, $FullName, $CompanyID;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][2][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][2]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
		      '{$_SESSION['USER_RIGHTS2'][11][2]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, a.RoleID, b.StartDate, b.StopDate, b.WorkNorm, b.CompanyID,
	                     CASE WHEN ($condbase) THEN 1 ELSE 0 END AS access
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  a.PersonID = '{$PersonID}'");
        if ($row = $conn->fetch_array()) {
            if ($row['access'] == 0) {
                $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            } elseif (empty($row['WorkNorm'])) {
                $params = array('label' => '%s nu are Norma de lucru setata in meniul Personal -> Contract', 'values' => $row['FullName']);
            } elseif (empty($row['StartDate']) || $row['StartDate'] == '0000-00-00') {
                $params = array('label' => '%s nu are Data angajarii setata in meniul Personal -> Contract', 'values' => $row['FullName']);
            } elseif (empty($row['CompanyID'])) {
                $params = array('label' => '%s nu are compania setata in meniul Personal -> Incadrare', 'values' => $row['FullName']);
            }
            if (!empty($params)) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate($params, $smarty) . "!'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
                exit;
            }
            $RoleID = $row['RoleID'];
            $FullName = $row['FullName'];
            $StartDate = $row['StartDate'];
            $StopDate = $row['StopDate'];
            $WorkNorm = $row['WorkNorm'];
            $CompanyID = $row['CompanyID'];
        } else {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            $params = array('label' => 'Angajatului %s nu i se poate seta pontaj deoarece nu are salvate informatiile in meniul Personal -> Contract', 'values' => $row['FullName']);
            echo "<body onload=\"alert('" . smarty_function_translate($params, $smarty) . " . !'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
            exit;
        }

        if (!empty($_GET['Day'])) {

            $Year = (int)$_GET['Year'];
            $Month = (int)$_GET['Month'];
            $Day = (int)$_GET['Day'];

            $sel_day = "{$Year}-" . ($Month <= 9 ? '0' . $Month : $Month) . "-" . ($Day <= 9 ? '0' . $Day : $Day);

            if ($row['StartDate'] > $sel_day) {
                echo "<body onload=\"alert('{$row['FullName']} nu era angajat(a) la aceasta data !'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
                exit;
            }

            if (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00' && $row['StopDate'] < $sel_day) {
                echo "<body onload=\"alert('{$row['FullName']} nu mai era angajat(a) la aceasta data !'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
                exit;
            }

            $query = "SELECT * 
    	              FROM   pontaj_simple
    	              WHERE  PersonID = '{$PersonID}' AND Year = '{$Year}' AND Month = '{$Month}' AND Day = '{$Day}'";
            $conn->query($query);
            if ($row = $conn->fetch_array()) {
                return $row;
            } else {
                $query = "SELECT Type FROM vacations_details WHERE PersonID = '{$PersonID}' AND '{$sel_day}' BETWEEN StartDate AND StopDate AND Aprove >= 0";
                $conn->query($query);
                if ($row = $conn->fetch_array()) {
                    $x["Hours_{$row['Type']}"] = 1;
                    $x["Hours_Norm"] = 0;
                } else {
                    $query = "SELECT StartDate, StopDate, DATE_FORMAT(StartDate, '%Y-%m-%d') AS fStartDate, DATE_FORMAT(StopDate, '%Y-%m-%d') AS fStopDate
		              FROM   persons_displacement 
			      WHERE  PersonID = '{$PersonID}' AND '{$sel_day}' BETWEEN DATE_FORMAT(StartDate, '%Y-%m-%d') AND DATE_FORMAT(StopDate, '%Y-%m-%d')";
                    $conn->query($query);
                    if ($row = $conn->fetch_array()) {
                        if ($sel_day == $row['fStartDate']) {
                            if ($sel_day == $row['fStopDate']) {
                                $hours_disp = round((strtotime($row['StopDate']) - strtotime($row['StartDate'])) / 3600, 1);
                                $x["Hours_Disp"] = $hours_disp;
                                $x["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                            } else {
                                $hours_disp = round((strtotime($row['fStartDate'] . ' 23:59:59') - strtotime($row['StartDate'])) / 3600, 1);
                                $x["Hours_Disp"] = $hours_disp;
                                $x["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                            }
                        } else {
                            if ($sel_day == $row['fStopDate']) {
                                $hours_disp = round((strtotime($row['StopDate']) - strtotime($row['fStopDate'] . ' 00:00:00')) / 3600, 1);
                                $x["Hours_Disp"] = $hours_disp;
                                $x["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                            } else {
                                $hours_disp = 24;
                                $x["Hours_Disp"] = $hours_disp;
                                $x["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                            }
                        }
                    } else {
                        $weekday = date('w', mktime(0, 0, 0, $Month, $Day, $Year));
                        if ($weekday == 0 || $weekday == 6 || isset(Utils::$msLegal[date('Y-m-d', mktime(0, 0, 0, $Month, $Day, $Year))])) {
                            return array();
                        }
                        $x["Hours_Norm"] = $WorkNorm;
                    }
                }
                return $x;
            }
        }

        return array();
    }

    public static function setPontajByDay($PersonID)
    {

        global $conn;

        $Year = (int)$_GET['Year'];
        $Month = (int)$_GET['Month'];
        $Day = (int)$_GET['Day'];

        $conn->query("SELECT id FROM pontaj_simple WHERE PersonID = '$PersonID' AND Year = '{$Year}' AND Month = '{$Month}' AND Day = '{$Day}'");
        if ($row = $conn->fetch_array()) {
            $cond_up = "";
            foreach (self::$msHoursType as $k => $v) {
                $cond_up .= "Hours_$k = '" . (int)$_POST['hours']["Hours_$k"] . "', ";
            }
            $conn->query("UPDATE pontaj_simple SET $cond_up LastUpdateDate = CURRENT_TIMESTAMP WHERE id = '{$row['id']}'");
        } else {
            $cond_if = "";
            $cond_iv = "";
            foreach (self::$msHoursType as $k => $v) {
                $cond_if .= "Hours_$k, ";
                $cond_iv .= "'" . (int)$_POST['hours']["Hours_$k"] . "', ";
            }
            $conn->query("INSERT INTO pontaj_simple(PersonID, Data, Year, Month, Day, $cond_if CreateDate, LastUpdateDate)
	                  VALUES('$PersonID', '{$Year}-{$Month}-{$Day}', '{$Year}', '{$Month}', '{$Day}', $cond_iv CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        }
    }

    public static function getPontajByCal($PersonID)
    {

        global $conn, $smarty, $days, $FullName, $CompanyID;

        if (!empty($_GET['year']) && !empty($_GET['month']) && !empty($_GET['day'])) {
            $curr_date = $_GET['year'] . '-' . ($_GET['month'] <= 9 ? '0' : '') . $_GET['month'] . '-' . ($_GET['day'] <= 9 ? '0' : '') . $_GET['day'];
            $curr_year = $_GET['year'];
            $curr_month = $_GET['month'];
            $curr_day = $_GET['day'];
        } else {
            $curr_date = date('Y-m-d');
            $curr_year = date('Y');
            $curr_month = date('m');
            $curr_day = date('d');
        }

        $weekday = date('w', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));
        $days = array();

        if ($weekday == 0) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
        } elseif ($weekday == 1) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        } else {
            $days[] = $curr_date;
            for ($i = 1; $i < $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
            for ($i = 1; $i <= 7 - $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        }
        sort($days);

        if (!empty($_GET['prev'])) {
            $prev = 7 * (int)$_GET['prev'];
            foreach ($days as $k => $v) {
                $days[$k] = date('Y-m-d', mktime(0, 0, 0, (int)substr($v, 5, 2), (int)substr($v, 8) - $prev, (int)substr($v, 0, 4)));
            }
        }

        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][2][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][2]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
		      '{$_SESSION['USER_RIGHTS2'][11][2]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, a.RoleID, b.StartDate, b.StopDate, b.WorkNorm, b.CompanyID,
	                     CASE WHEN ($condbase) THEN 1 ELSE 0 END AS access
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  a.PersonID = '{$PersonID}'");
        if ($row = $conn->fetch_array()) {
            if ($row['access'] == 0) {
                $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            } elseif (empty($row['WorkNorm'])) {
                $params = array('label' => '%s nu are Norma de lucru setata in meniul Personal -> PayRoll', 'values' => $row['FullName']);
            } elseif (empty($row['StartDate']) || $row['StartDate'] == '0000-00-00') {
                $params = array('label' => '%s nu are Data angajarii setata in meniul Personal -> PayRoll', 'values' => $row['FullName']);
            } elseif (empty($row['CompanyID'])) {
                $params = array('label' => '%s nu are compania setata in meniul Personal -> Incadrare', 'values' => $row['FullName']);
            }
            if (!empty($params)) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate($params, $smarty) . "!'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
                exit;
            }
            $RoleID = $row['RoleID'];
            $FullName = $row['FullName'];
            $StartDate = $row['StartDate'];
            $StopDate = $row['StopDate'];
            $WorkNorm = $row['WorkNorm'];
            $CompanyID = $row['CompanyID'];
        } else {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            $params = array('label' => 'Angajatului %s nu i se poate seta pontaj deoarece nu are salvate informatiile in meniul Personal -> PayRoll', 'values' => $row['FullName']);
            echo "<body onload=\"alert('" . smarty_function_translate($params, $smarty) . " . !'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
            exit;
        }

        if (($row['StartDate'] > $days[6]) || (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00' && $row['StopDate'] < $days[0])) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            $params = array('label' => '%s nu era angajat(a) in aceasta perioada', 'values' => $row['FullName']);
            echo "<body onload=\"alert('" . smarty_function_translate($params, $smarty) . " . !'); window.location.href = '{$_SERVER['HTTP_REFERER']}';\"></body>";
            exit;
        }

        $query = "SELECT *
    	          FROM   pontaj_simple
    	          WHERE  PersonID = '{$PersonID}' AND Data BETWEEN '{$days[0]}' AND '{$days[6]}'";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['total'] = 0;
            foreach (self::$msHoursType as $k => $v) {
                if (in_array($k, array('Norm', 'Spl', 'SplW', 'Night'))) {
                    $row['total'] += $row["Hours_$k"];
                }
            }
            $pontaj[$row['Data']] = $row;
        }

        /* Displacements */
        $displacements = array();
        foreach ($days as $day) {
            if (!isset($pontaj[$day])) {
                $displacements[$day] = "'{$day}' BETWEEN DATE_FORMAT(StartDate, '%Y-%m-%d') AND DATE_FORMAT(StopDate, '%Y-%m-%d')";
            }
        }

        if (!empty($displacements)) {
            foreach ($displacements as $day => $cond) {
                $query = "SELECT StartDate, StopDate, DATE_FORMAT(StartDate, '%Y-%m-%d') AS fStartDate, DATE_FORMAT(StopDate, '%Y-%m-%d') AS fStopDate 
		          FROM   persons_displacement 
			  WHERE  PersonID = '{$PersonID}' AND $cond";
                $conn->query($query);
                if ($row = $conn->fetch_array()) {
                    if ($day == $row['fStartDate']) {
                        if ($day == $row['fStopDate']) {
                            $hours_disp = round((strtotime($row['StopDate']) - strtotime($row['StartDate'])) / 3600, 1);
                            $pontaj[$day]["Hours_Disp"] = $hours_disp;
                            $pontaj[$day]["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                        } else {
                            $hours_disp = round((strtotime($row['fStartDate'] . ' 23:59:59') - strtotime($row['StartDate'])) / 3600, 1);
                            $pontaj[$day]["Hours_Disp"] = $hours_disp;
                            $pontaj[$day]["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                        }
                    } else {
                        if ($day == $row['fStopDate']) {
                            $hours_disp = round((strtotime($row['StopDate']) - strtotime($row['fStopDate'] . ' 00:00:00')) / 3600, 1);
                            $pontaj[$day]["Hours_Disp"] = $hours_disp;
                            $pontaj[$day]["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                        } else {
                            $hours_disp = 24;
                            $pontaj[$day]["Hours_Disp"] = $hours_disp;
                            $pontaj[$day]["Hours_Norm"] = $hours_disp < $WorkNorm ? $WorkNorm - $hours_disp : 0;
                        }
                    }
                } else {
                    $weekday = date('w', mktime(0, 0, 0, (int)substr($day, 5, 2), (int)substr($day, 8, 2), (int)substr($day, 0, 4)));
                    if ($weekday == 0 || $weekday == 6 || isset(Utils::$msLegal[$day]) || $StartDate > $day || ($StopDate != '0000-00-00' && $StopDate < $day)) {
                        continue;
                    }
                    $pontaj[$day]["Hours_Norm"] = $WorkNorm;
                    $pontaj[$day]["total"] = $WorkNorm;
                }
            }
        }

        /* Vacations */
        $vacations = array();
        foreach ($days as $day) {
            if (!isset($pontaj[$day])) {
                $vacations[$day] = "'{$day}' BETWEEN StartDate AND StopDate";
            }
        }
        if (!empty($vacations)) {
            foreach ($vacations as $day => $cond) {
                $query = "SELECT Type FROM vacations_details WHERE PersonID = '{$PersonID}' AND $cond AND Aprove >= 0";
                $conn->query($query);
                if ($row = $conn->fetch_array()) {
                    $pontaj[$day]["Hours_{$row['Type']}"] = 1;
                    $pontaj[$day]["Hours_Norm"] = 0;
                    $pontaj[$day]["total"] = 0;
                } else {
                    $weekday = date('w', mktime(0, 0, 0, (int)substr($day, 5, 2), (int)substr($day, 8, 2), (int)substr($day, 0, 4)));
                    if ($weekday == 0 || $weekday == 6 || isset(Utils::$msLegal[$day]) || $StartDate > $day || ($StopDate != '0000-00-00' && $StopDate < $day)) {
                        continue;
                    }
                    $pontaj[$day]["Hours_Norm"] = $WorkNorm;
                    $pontaj[$day]["total"] = $WorkNorm;
                }
            }
        }

        return $pontaj;
    }

    public static function setPontajByCal($PersonID)
    {

        global $conn;

        foreach ($_POST['hours'] as $ID => $info) {
            $conn->query("SELECT ID FROM pontaj_simple WHERE PersonID = '$PersonID' AND ID = '$ID'");
            if ($conn->fetch_array()) {
                $cond_up = "";
                foreach (self::$msHoursType as $k => $v) {
                    $cond_up .= "Hours_$k = '" . (int)($info["Hours_$k"]) . "',";
                }
                $conn->query("UPDATE pontaj_simple SET $cond_up LastUpdateDate = CURRENT_TIMESTAMP WHERE ID = '{$ID}'");
            } else {
                $cond_if = "";
                $cond_iv = "";
                foreach (self::$msHoursType as $k => $v) {
                    $cond_if .= "Hours_$k, ";
                    $cond_iv .= "'" . (int)($info["Hours_$k"]) . "', ";
                }
                $conn->query("INSERT INTO pontaj_simple(PersonID, Data, Year, Month, Day, $cond_if CreateDate, LastUpdateDate)
			      VALUES('$PersonID', '" . (substr($ID, 0, 4) . '-' . substr($ID, 5, 2) . '-' . substr($ID, 8, 2)) . "', '" . (substr($ID, 0, 4)) . "', '" . (int)(substr($ID, 5, 2)) . "', '" . (int)(substr($ID, 8, 2)) . "', 
			      $cond_iv CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getAllPersonsHours()
    {
        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return array();
        }

        $StartDate = date("Y-m-d", strtotime($_GET['StartDate']));
        $EndDate = date("Y-m-d", strtotime($_GET['EndDate']));
        $days = Utils::getDaysList($StartDate, $EndDate, false, false);
        $departments = array();
        $hours = Utils::getHoursList("00:00", "00:00", 1800);
        $flipped_hours = array_flip($hours);
        $months = Utils::getMonthsList($StartDate, $EndDate);
        $weeks = Utils::getWeeksList($StartDate, $EndDate);
        $months_list = array();
        $weeks_list = array();
        $weeksbydays = array();
        foreach ($months as $year => $month_range) {
            foreach ($month_range as $month) {
                if (!in_array($month, $months_list)) {
                    $months_list[] = $month;
                }
            }
        }
        foreach ($weeks as $year => $week_range) {
            foreach ($week_range as $k => $week) {
                if (!in_array($week, $weeks_list)) {
                    $weeks_list[] = $week;
                }
            }
        }

        global $conn;


        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR c.DirectManagerID = '{$_SESSION['PERS']}'" : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][7]}' = 1 AND (b.UserID = {$_SESSION['USER_ID']} OR b.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][11][7]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.PersonID, b.FullName, c.DepartmentID, c.LunchBreakStartHour, c.LunchBreakEndHour, c.WorkStartHour, c.WorkNorm, c.ContractExpDate, c.SuspendDate, c.ReturnDate, c.StartDate, c.StopDate
                    FROM persons b
                    INNER JOIN payroll c ON c.PersonID = b.PersonID
                    LEFT JOIN address d ON d.AddressID = b.AddressID
                    LEFT JOIN address_city e ON e.CityID = d.CityID
                    LEFT JOIN divisions f ON f.DivisionID = c.DivisionID
                    WHERE 1=1 AND ({$condbase})";

        $query .= " AND ('{$EndDate}' >= c.StartDate AND (c.StopDate IS NULL OR c.StopDate = '0000-00-00' OR c.StopDate >= '{$StartDate}') AND (c.ContractType != 1 OR c.ContractExpDate IS NULL OR c.ContractExpDate = '0000-00-00' OR c.ContractExpDate >= '{$StartDate}'))";
        $query .= " AND (c.ContractType != 3 OR c.SuspendDate > '{$StartDate}' OR c.ReturnDate <= '{$EndDate}')";

        if (!empty($_GET['DistrictID'])) {
            $query .= " AND e.DistrictID = '" . (int)($_GET['DistrictID']) . "'";
        }

        if (!empty($_GET['CityID'])) {
            $query .= " AND e.CityID = '" . (int)($_GET['CityID']) . "'";
        }

        if (!empty($_GET['Status'])) {
            $query .= " AND b.Status = '" . (int)($_GET['Status']) . "'";
        }

        if (!empty($_GET['CompanyID'])) {
            $query .= " AND c.CompanyID = '" . (int)($_GET['CompanyID']) . "'";
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $query .= " AND c.CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")";
        }

        if (!empty($_GET['DivisionID'])) {
            $query .= " AND c.DivisionID = '" . (int)($_GET['DivisionID']) . "'";
        }

        if (!empty($_GET['DepartmentID'])) {
            $query .= " AND c.DepartmentID = '" . (int)($_GET['DepartmentID']) . "'";
        }

        if (!empty($_GET['CostCenterID'])) {
            $query .= " AND b.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        if (!empty($_GET['search_for']) && !empty($_GET['keyword'])) {
            switch ($_GET['search_for']) {
                case 'LastName':
                    $query .= " AND b.LastName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'FirstName':
                    $query .= " AND b.FirstName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'CNP':
                    $query .= " AND b.CNP LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
            }
        }
        $query .= " ORDER BY b.FullName";
        $conn->query($query);
        $persons_list = "";
        $ndays = array();
        $vacations = array();
        $xvacations = array();
        while ($row = $conn->fetch_array()) {
            if (!isset($ndays[$row['PersonID']])) {
                $ndays[$row['PersonID']] = array();
            }
            if (!empty($row['ContractExpDate']) && $row['ContractExpDate'] != '0000-00-00') {
                $cexpdate = strtotime($row['ContractExpDate']);
                if ($cexpdate < strtotime($EndDate)) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', ($cexpdate + 24 * 3600)), $EndDate, false, false)));
                }
            }
            if (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00') {
                $pstopdate = strtotime($row['StopDate']);
                if ($pstopdate < strtotime($EndDate)) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', ($pstopdate + 24 * 3600)), $EndDate, false, false)));
                }
            }
            if (!empty($row['StartDate']) && $row['StartDate'] != '0000-00-00') {
                $pstartdate = strtotime($row['StartDate']);
                if ($StartDate < $pstartdate) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList($StartDate, date('Y-m-d', ($pstartdate - 24 * 3600)), false, false)));
                }
            }
            if (!empty($row['SuspendDate']) && $row['SuspendDate'] != '0000-00-00') {
                $psuspenddate = strtotime($row['SuspendDate']);
                $pin = strtotime($EndDate);
                if (!empty($row['ReturnDate']) && $row['ReturnDate'] != '0000-00-00') {
                    $preturndate = strtotime($row['ReturnDate']);
                    if ($pin > $preturndate) {
                        $pin = $preturndate - 24 * 3600;
                    }
                }
                if ($psuspenddate <= $pin) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', $psuspenddate), date('Y-m-d', $pin), false, false)));
                }
            }
            if (!empty($row['ReturnDate']) && $row['ReturnDate'] != '0000-00-00') {
                $preturndate = strtotime($row['ReturnDate']);
                $pin = strtotime($StartDate);
                if (!empty($row['SuspendDate']) && $row['SuspendDate'] != '0000-00-00') {
                    $psuspenddate = strtotime($row['SuspendDate']);
                    if ($pin < $psuspenddate) {
                        $pin = $psuspenddate;
                    }
                }
                if ($pin < $preturndate) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', $pin), date('Y-m-d', ($preturndate - 24 * 3600)), false, false)));
                }
            }

            $departments[$row['DepartmentID']][$row['PersonID']] = $row;
            $vacations[$row['PersonID']] = array();
            $xvacations[$row['PersonID']] = array();
            $persons_list .= (!empty($persons_list) ? "','" : "") . $row['PersonID'];
        }
//        echo "<pre>";print_r($departments); echo "</pre>";exit;


        $query = "SELECT a.PersonID, a.StartDate, a.StartHour, a.EndDate, a.EndHour, a.Type
                    FROM pontaj_detail a
                    WHERE (a.StartDate <= '{$EndDate}' AND a.EndDate >= '{$StartDate}')
                    AND a.PersonID IN('" . $persons_list . "')";

        $conn->query($query);
        $list = array();
        while ($row = $conn->fetch_array()) {
            $list[$row['PersonID']][] = $row;
        }


        end($weeks);
        $endy = key($weeks);
        reset($weeks);
        $starty = key($weeks);
        $first_week = explode("-", date('Y-m-W', strtotime(date('Y-m', strtotime($EndDate)) . "-01")));
        $Start = date('Y-m-d', strtotime($first_week[0] . "W" . $first_week[2]));
        $last_week = explode("-", date('Y-m-W', strtotime(date('Y-m-t', strtotime($EndDate)))));
        if ($last_week[2] == "01" && $last_week[1] == "12") {
            $last_week[0]++;
        }
        $End = date('Y-m-d', strtotime($last_week[0] . "W" . $last_week[2]) + 6 * 24 * 3600) . " 23:59:59";


        $query = "SELECT a.PersonID, a.StartDate, a.StopDate, a.Type 
                        FROM vacations_details a
                        WHERE a.Aprove = 1
                        AND (a.StartDate <= '{$End}' AND a.StopDate >= '{$Start}')
                        AND a.PersonID IN('" . $persons_list . "')";
        $conn->query($query);

        while ($row = $conn->fetch_array()) {
            if (!isset($vacations[$row['PersonID']])) {
                $vacations[$row['PersonID']] = array();
            }
            $VStart = $row['StartDate'];
            $VEnd = $row['StopDate'];
            if (strtotime($VStart) < strtotime($StartDate)) {
                $VStart = $StartDate;
            }
            if (strtotime($VEnd) > strtotime($EndDate . " 23:59:59")) {
                $VEnd = $EndDate;
            }
            $vdays = Utils::getDaysList($VStart, $VEnd, false, false);
            if (count($vdays) > 0) {
                $vdays = array_combine($vdays, array_fill(0, count($vdays), $row['Type']));
                $vacations[$row['PersonID']] = array_merge($vacations[$row['PersonID']], $vdays);
            }

            if (!isset($xvacations[$row['PersonID']])) {
                $xvacations[$row['PersonID']] = array();
            }
            $VStart = $row['StartDate'];
            $VEnd = $row['StopDate'];
            if (strtotime($VStart) < strtotime(date('Y-m', strtotime($StartDate)) . "-01")) {
                $VStart = date('Y-m', strtotime($StartDate)) . "-01";
            }
            if (strtotime($VEnd) > strtotime(date('Y-m-t', strtotime($EndDate)) . " 23:59:59")) {
                $VEnd = date('Y-m-t', strtotime($EndDate));
            }
            $vdays = Utils::getDaysList($VStart, $VEnd);
            if (count($vdays) > 0) {
//                echo "<pre>";print_r($vdays); echo "</pre>"; exit;
                foreach ($vdays as $day) {
                    $params = explode('-', date('Y-m-W', strtotime($day)));
                    $xvacations[$row['PersonID']][$params[0]]['Weeks'][$params[2]]++;
                    $xvacations[$row['PersonID']][$params[0]]['Months'][$params[1]]++;
                }
                $vdays = array_combine($vdays, array_fill(0, count($vdays), $row['Type']));

            }
        }

        $query = "SELECT PersonID, SUM(Hours) AS Hours, WEEKOFYEAR(StartDate) AS Week, MONTH(StartDate) AS Month, YEAR(StartDate) AS Year, StartDate
                    FROM pontaj_detail 
                    WHERE Type IN(1,4,5,7)
                    AND EndDate >= '{$Start}' AND StartDate <= '{$End}'        
                    AND PersonID IN('" . $persons_list . "')
                    GROUP BY Year, Month, Week, StartDate, PersonID";

        $conn->query($query);
        $whours = array();
        while ($row = $conn->fetch_array()) {
            if (!in_array($row['StartDate'], array_keys($vacations[$row['PersonID']]))) {
                $year = $row['Year'];
                $whours[$row['PersonID']][$year]['Months'][$row['Month']] += $row['Hours'];
                if ($row['Month'] == 12 && $row['Week'] == 1) {
                    $year++;
                }
                $whours[$row['PersonID']][$year]['Weeks'][$row['Week']] += $row['Hours'];
            }
        }


//        echo "<pre>"; print_r($whours); echo "</pre>";exit;
//        Utils::pa($departments);exit;
        $dm = array();
        foreach ($departments as $DptID => $department) {
            $ldays = array_flip($days);
            foreach (array_keys($ldays) as $k) {
                $weeksbydays[$k] = date('W', strtotime($k));
                $ldays[$k] = array_fill_keys(array_keys($department), array());
            }
            $lweeks = array();
            foreach ($weeks as $year => $week_range) {
                foreach ($week_range as $week) {
                    $wkv = strtotime($year . "W" . $week);
                    $wkve = strtotime($year . "W" . $week . " + 6 day");
                    $wwdays = Utils::getDaysDiff(date('Y-m-d', $wkv), date('Y-m-d', $wkve));
                    foreach ($department as $kd => $vd) {
                        $ndc = false;
                        $ndcs = $wkv;
                        $ndce = $wkve;
                        $dc = $wwdays;
                        if (strtotime($vd['StartDate']) > $wkv && strtotime($vd['StartDate']) <= $wkve) {
                            $ndcs = strtotime($vd['StartDate']);
                            $ndc = true;
                        }
                        if ($vd['StopDate'] != '0000-00-00' && $vd['StopDate'] != '' && strtotime($vd['StopDate']) < $wkve && strtotime($vd['StopDate']) > $wkv) {
                            $ndce = strtotime($vd['StopDate']);
                            $ndc = true;
                        }
                        if ($ndc) {
                            $dc = Utils::getDaysDiff(date('Y-m-d', $ndcs), date('Y-m-d', $ndce));
                        }

                        $lweeks[$year][$week][$kd] = $dc * $vd['WorkNorm'];
                        $dm[$DptID]['Weeks_ref'][$year][$week][$kd] = $wwdays * $vd['WorkNorm'];
                        $lweeks[$year][$week][$kd] -= $whours[$kd][$year]['Weeks'][(int)$week];
                        $lweeks[$year][$week][$kd] -= $xvacations[$kd][$year]['Weeks'][$week] * $vd['WorkNorm'];
                    }
                }
            }
            $lmonths = array();
            foreach ($months as $year => $month_range) {
                foreach ($month_range as $month) {
                    $mths = strtotime("$year-$month-01");
                    $mthe = strtotime(date('Y-m-t', $mths));
                    $days_count = Utils::getDaysDiff(date('Y-m-d', $mths), date('Y-m-d', $mthe));
                    foreach ($department as $kd => $vd) {
                        $ndc = false;
                        $ndcs = $mths;
                        $ndce = $mthe;
                        $dc = $days_count;
                        if (strtotime($vd['StartDate']) > $mths && strtotime($vd['StartDate']) <= $mthe) {
                            $ndcs = strtotime($vd['StartDate']);
                            $ndc = true;
                        }
                        if ($vd['StopDate'] != '0000-00-00' && $vd['StopDate'] != '' && strtotime($vd['StopDate']) < $mthe && strtotime($vd['StopDate']) > $mths) {
                            $ndce = strtotime($vd['StopDate']);
                            $ndc = true;
                        }
                        if ($ndc) {
                            $dc = Utils::getDaysDiff(date('Y-m-d', $ndcs), date('Y-m-d', $ndce));
                        }
                        $lmonths[$year][$month][$kd] = $dc * $vd['WorkNorm'];
                        $lmonths[$year][$month][$kd] -= $whours[$kd][$year]['Months'][(int)$month];
                        $lmonths[$year][$month][$kd] -= $xvacations[$kd][$year]['Months'][$month] * $vd['WorkNorm'];
                    }
                }
            }
            $dm[$DptID]['Dates'] = $ldays;
            $dm[$DptID]['Totals'] = array_fill_keys($days, "");
            $dm[$DptID]['Weeks'] = $lweeks;
            $dm[$DptID]['Months'] = $lmonths;
//            !isset($dm[$DptID]['PersonCount']) ? $dm[$DptID]['PersonCount'] = count($department)+2 : '';
//            !isset($dm[$DptID]['RSpan']) ? $dm[$DptID]['RSpan'] = count($days)*$dm[$DptID]['PersonCount'] : '';
            foreach ($department as $PersonID => $person) {
                if (!empty($ndays[$PersonID])) {
                    foreach ($ndays[$PersonID] as $nday) {
                        unset($dm[$DptID]['Dates'][$nday][$PersonID]);
                    }
                }

                if (isset($vacations[$PersonID])) {
                    foreach ($vacations[$PersonID] as $kday => $vday) {
                        if (isset($dm[$DptID]['Dates'][$kday][$PersonID])) {
                            foreach ($hours as $hour) {
                                $dm[$DptID]['Dates'][$kday][$PersonID][$hour] = $vday;
                            }
                        }
                    }
                }

                if (isset($list[$PersonID])) {

                    foreach ($list[$PersonID] as $interval) {

                        $starti = strtotime($interval['StartHour']);
                        $endi = strtotime($interval['EndHour']);
                        if ($starti % 1800 > 0) {
                            $diff = $starti % 1800;
                            if ($diff > 900) {
                                $starti += 1800 - $diff;
                            } else {
                                $starti -= $diff;
                            }
                        }
                        if ($endi % 1800 > 0) {
                            $diff = $endi % 1800;
                            if ($diff > 900) {
                                $endi += 1800 - $diff;
                            } else {
                                $endi -= $diff;
                            }
                        }
                        $cursor = $start = strtotime($interval['StartDate'] . " " . date("H:i", $starti));
                        $pin = $end = strtotime($interval['EndDate'] . " " . date("H:i", $endi));

                        while ($cursor < $end) {
                            $eod = strtotime(date('Y-m-d', $cursor) . " +1 day");
                            if ($pin != $end) {
                                $pin = $end;
                            }

                            if ($pin > $eod) {
                                $pin = $eod;
                            }

                            $sh = date('H:i', $cursor);
                            $eh = date('H:i', $pin - 1800);
                            $cday = date('Y-m-d', $cursor);
                            if (isset($dm[$DptID]['Dates'][$cday][$PersonID])) {
                                if (!in_array($cday, array_keys($vacations[$PersonID])) && in_array($interval['Type'], array(1, 4, 5, 7))) {
                                    $dm[$DptID]['Days'][$cday][$PersonID] += ($pin - $cursor) / 3600;
                                    $dm[$DptID]['Sums']['Days'][$cday] += ($pin - $cursor) / 3600;
                                }
                                for ($i = $flipped_hours[$sh]; $i <= $flipped_hours[$eh]; $i++) {
                                    if (!isset($dm[$DptID]['Dates'][$cday][$PersonID][$hours[$i]]) || ($dm[$DptID]['Dates'][$cday][$PersonID][$hours[$i]] == 1 && in_array($interval['Type'], array(2, 3)))) {
                                        $dm[$DptID]['Dates'][$cday][$PersonID][$hours[$i]] = $interval['Type'];
                                        if (in_array($interval['Type'], array(1, 4, 5))) {
                                            $dm[$DptID]['Totals'][$cday][$hours[$i]]++;
                                        }
                                    }
                                }
                            }
                            $cursor = $pin;
                        }

                    }
                }
            }
            foreach ($dm[$DptID]['Dates'] as $kday => $day) {
                $dm[$DptID]['RSpan'] += count($day) + 2;
                $dm[$DptID]['DayPersonCount'][$kday] = count($day) + 2;
            }
        }
//        echo "<pre>";print_r($dm); echo "</pre>";exit;
        return array($dm, $hours, $departments, $vacations, $weeksbydays);

    }

    public static function getAllPersonsPlanifHours()
    {
        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return array();
        }

        $StartDate = date("Y-m-d", strtotime($_GET['StartDate']));
        $EndDate = date("Y-m-d", strtotime($_GET['EndDate']));
        $days = Utils::getDaysList($StartDate, $EndDate, false, false);
        $departments = array();
        $hours = Utils::getHoursList("00:00", "00:00", 1800);
        $flipped_hours = array_flip($hours);
        $months = Utils::getMonthsList($StartDate, $EndDate);
        $weeks = Utils::getWeeksList($StartDate, $EndDate);
        $months_list = array();
        $weeks_list = array();
        $weeksbydays = array();
        foreach ($months as $year => $month_range) {
            foreach ($month_range as $month) {
                if (!in_array($month, $months_list)) {
                    $months_list[] = $month;
                }
            }
        }
        foreach ($weeks as $year => $week_range) {
            foreach ($week_range as $k => $week) {
                if (!in_array($week, $weeks_list)) {
                    $weeks_list[] = $week;
                }
            }
        }

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR c.DirectManagerID = '{$_SESSION['PERS']}'" : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][8]}' = 1 AND (b.UserID = {$_SESSION['USER_ID']} OR b.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][11][8]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.PersonID, b.FullName, c.DepartmentID, c.LunchBreakStartHour, c.LunchBreakEndHour, c.WorkStartHour, c.WorkNorm, c.ContractExpDate, c.SuspendDate, c.ReturnDate, c.StartDate, c.StopDate 
                    FROM persons b
                    INNER JOIN payroll c ON c.PersonID = b.PersonID
                    LEFT JOIN address d ON d.AddressID = b.AddressID
                    LEFT JOIN address_city e ON e.CityID = d.CityID
                    LEFT JOIN divisions f ON f.DivisionID = c.DivisionID
                    WHERE 1=1 AND ({$condbase})";

        $query .= " AND ('{$EndDate}' >= c.StartDate AND (c.StopDate IS NULL OR c.StopDate = '0000-00-00' OR c.StopDate >= '{$StartDate}') AND (c.ContractType != 1 OR c.ContractExpDate IS NULL OR c.ContractExpDate = '0000-00-00' OR c.ContractExpDate >= '{$StartDate}'))";
        $query .= " AND (c.ContractType != 3 OR c.SuspendDate > '{$StartDate}' OR c.ReturnDate <= '{$EndDate}')";

        if (!empty($_GET['DistrictID'])) {
            $query .= " AND e.DistrictID = '" . (int)($_GET['DistrictID']) . "'";
        }

        if (!empty($_GET['CityID'])) {
            $query .= " AND e.CityID = '" . (int)($_GET['CityID']) . "'";
        }

        if (!empty($_GET['Status'])) {
            $query .= " AND b.Status = '" . (int)($_GET['Status']) . "'";
        }

        if (!empty($_GET['CompanyID'])) {
            $query .= " AND c.CompanyID = '" . (int)($_GET['CompanyID']) . "'";
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $query .= " AND c.CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")";
        }

        if (!empty($_GET['DivisionID'])) {
            $query .= " AND c.DivisionID = '" . (int)($_GET['DivisionID']) . "'";
        }

        if (!empty($_GET['DepartmentID'])) {
            $query .= " AND c.DepartmentID = '" . (int)($_GET['DepartmentID']) . "'";
        }

        if (!empty($_GET['CostCenterID'])) {
            $query .= " AND b.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        if (!empty($_GET['search_for']) && !empty($_GET['keyword'])) {
            switch ($_GET['search_for']) {
                case 'LastName':
                    $query .= " AND b.LastName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'FirstName':
                    $query .= " AND b.FirstName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'CNP':
                    $query .= " AND b.CNP LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
            }
        }
        $query .= " ORDER BY b.FullName";
        $conn->query($query);
        $persons_list = "";
        $ndays = array();
        while ($row = $conn->fetch_array()) {
            if (!isset($ndays[$row['PersonID']])) {
                $ndays[$row['PersonID']] = array();
            }
            if (!empty($row['ContractExpDate']) && $row['ContractExpDate'] != '0000-00-00') {
                $cexpdate = strtotime($row['ContractExpDate']);
                if ($cexpdate < strtotime($EndDate)) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', ($cexpdate + 24 * 3600)), $EndDate, false, false)));
                }
            }
            if (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00') {
                $pstopdate = strtotime($row['StopDate']);
                if ($pstopdate < strtotime($EndDate)) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', ($pstopdate + 24 * 3600)), $EndDate, false, false)));
                }
            }
            if (!empty($row['StartDate']) && $row['StartDate'] != '0000-00-00') {
                $pstartdate = strtotime($row['StartDate']);
                if ($StartDate < $pstartdate) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList($StartDate, date('Y-m-d', ($pstartdate - 24 * 3600)), false, false)));
                }
            }
            if (!empty($row['SuspendDate']) && $row['SuspendDate'] != '0000-00-00') {
                $psuspenddate = strtotime($row['SuspendDate']);
                $pin = strtotime($EndDate);
                if (!empty($row['ReturnDate']) && $row['ReturnDate'] != '0000-00-00') {
                    $preturndate = strtotime($row['ReturnDate']);
                    if ($pin > $preturndate) {
                        $pin = $preturndate - 24 * 3600;
                    }
                }
                if ($psuspenddate <= $pin) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', $psuspenddate), date('Y-m-d', $pin), false, false)));
                }
            }
            if (!empty($row['ReturnDate']) && $row['ReturnDate'] != '0000-00-00') {
                $preturndate = strtotime($row['ReturnDate']);
                $pin = strtotime($StartDate);
                if (!empty($row['SuspendDate']) && $row['SuspendDate'] != '0000-00-00') {
                    $psuspenddate = strtotime($row['SuspendDate']);
                    if ($pin < $psuspenddate) {
                        $pin = $psuspenddate;
                    }
                }
                if ($pin < $preturndate) {
                    $ndays[$row['PersonID']] = array_unique(array_merge($ndays[$row['PersonID']], Utils::getDaysList(date('Y-m-d', $pin), date('Y-m-d', ($preturndate - 24 * 3600)), false, false)));
                }
            }

            $departments[$row['DepartmentID']][$row['PersonID']] = $row;
            $persons_list .= (!empty($persons_list) ? "','" : "") . $row['PersonID'];
        }
//        echo "<pre>";print_r($departments); echo "</pre>";exit;


        $query = "SELECT a.PersonID, a.StartDate, a.StartHour, a.EndDate, a.EndHour, a.Type
                    FROM pontaj_planif a
                    WHERE (a.StartDate <= '{$EndDate}' AND a.EndDate >= '{$StartDate}')
                    AND a.PersonID IN('" . $persons_list . "')";

        $conn->query($query);
        $list = array();
        while ($row = $conn->fetch_array()) {
            $list[$row['PersonID']][] = $row;
        }


        end($weeks);
        $endy = key($weeks);
        reset($weeks);
        $starty = key($weeks);
        $first_week = explode("-", date('Y-m-W', strtotime(date('Y-m', strtotime($EndDate)) . "-01")));
        $Start = date('Y-m-d', strtotime($first_week[0] . "W" . $first_week[2]));
        $last_week = explode("-", date('Y-m-W', strtotime(date('Y-m-t', strtotime($EndDate)))));
        if ($last_week[2] == "01" && $last_week[1] == "12") {
            $last_week[0]++;
        }
        $End = date('Y-m-d', strtotime($last_week[0] . "W" . $last_week[2]) + 6 * 24 * 3600) . " 23:59:59";


        $query = "SELECT a.PersonID, a.StartDate, a.StopDate, a.Type 
                        FROM vacations_details a
                        WHERE a.Aprove = 1
                        AND (a.StartDate <= '{$End}' AND a.StopDate >= '{$Start}')
                        AND a.PersonID IN('" . $persons_list . "')";
        $conn->query($query);
        $vacations = array();
        $xvacations = array();
        while ($row = $conn->fetch_array()) {
            if (!isset($vacations[$row['PersonID']])) {
                $vacations[$row['PersonID']] = array();
            }
            $VStart = $row['StartDate'];
            $VEnd = $row['StopDate'];
            if (strtotime($VStart) < strtotime($StartDate)) {
                $VStart = $StartDate;
            }
            if (strtotime($VEnd) > strtotime($EndDate . " 23:59:59")) {
                $VEnd = $EndDate;
            }
            $vdays = Utils::getDaysList($VStart, $VEnd, false, false);
            if (count($vdays) > 0) {
                $vdays = array_combine($vdays, array_fill(0, count($vdays), $row['Type']));
                $vacations[$row['PersonID']] = array_merge($vacations[$row['PersonID']], $vdays);
            }

            if (!isset($xvacations[$row['PersonID']])) {
                $xvacations[$row['PersonID']] = array();
            }
            $VStart = $row['StartDate'];
            $VEnd = $row['StopDate'];
            if (strtotime($VStart) < strtotime(date('Y-m', strtotime($StartDate)) . "-01")) {
                $VStart = date('Y-m', strtotime($StartDate)) . "-01";
            }
            if (strtotime($VEnd) > strtotime(date('Y-m-t', strtotime($EndDate)) . " 23:59:59")) {
                $VEnd = date('Y-m-t', strtotime($EndDate));
            }
            $vdays = Utils::getDaysList($VStart, $VEnd);
            if (count($vdays) > 0) {
//                echo "<pre>";print_r($vdays); echo "</pre>"; exit;
                foreach ($vdays as $day) {
                    $params = explode('-', date('Y-m-W', strtotime($day)));
                    $xvacations[$row['PersonID']][$params[0]]['Weeks'][$params[2]]++;
                    $xvacations[$row['PersonID']][$params[0]]['Months'][$params[1]]++;
                }
                $vdays = array_combine($vdays, array_fill(0, count($vdays), $row['Type']));

            }
        }

        $query = "SELECT PersonID, SUM(Hours) AS Hours, WEEKOFYEAR(StartDate) AS Week, MONTH(StartDate) AS Month, YEAR(StartDate) AS Year, StartDate
                    FROM pontaj_planif 
                    WHERE Type IN(0)
                    AND EndDate >= '{$Start}' AND StartDate <= '{$End}'        
                    AND PersonID IN('" . $persons_list . "')
                    GROUP BY Year, Month, Week, StartDate, PersonID";

        $conn->query($query);
        $whours = array();
        while ($row = $conn->fetch_array()) {
            if (!in_array($row['StartDate'], array_keys((array)$vacations[$row['PersonID']]))) {
                $year = $row['Year'];
                $whours[$row['PersonID']][$year]['Months'][$row['Month']] += $row['Hours'];
                if ($row['Month'] == 12 && $row['Week'] == 1) {
                    $year++;
                }
                $whours[$row['PersonID']][$year]['Weeks'][$row['Week']] += $row['Hours'];
            }
        }

//        echo "<pre>"; print_r($whours); echo "</pre>";exit;

        $dm = array();

        foreach ($departments as $DptID => $department) {
            $ldays = array_flip($days);
            foreach (array_keys($ldays) as $k) {
                $weeksbydays[$k] = date('W', strtotime($k));
                $ldays[$k] = array_fill_keys(array_keys($department), array());
            }

            $lweeks = array();
            foreach ($weeks as $year => $week_range) {
                foreach ($week_range as $week) {
                    $wkv = strtotime($year . "W" . $week);
                    $wkve = strtotime($year . "W" . $week . " + 6 day");
                    $wwdays = Utils::getDaysDiff(date('Y-m-d', $wkv), date('Y-m-d', $wkve));
                    foreach ($department as $kd => $vd) {
                        $ndc = false;
                        $ndcs = $wkv;
                        $ndce = $wkve;
                        $dc = $wwdays;
                        if (strtotime($vd['StartDate']) > $wkv && strtotime($vd['StartDate']) <= $wkve) {
                            $ndcs = strtotime($vd['StartDate']);
                            $ndc = true;
                        }
                        if ($vd['StopDate'] != '0000-00-00' && $vd['StopDate'] != '' && strtotime($vd['StopDate']) < $wkve && strtotime($vd['StopDate']) > $wkv) {
                            $ndce = strtotime($vd['StopDate']);
                            $ndc = true;
                        }
                        if ($ndc) {
                            $dc = Utils::getDaysDiff(date('Y-m-d', $ndcs), date('Y-m-d', $ndce));
                        }

                        $lweeks[$year][$week][$kd] = $dc * $vd['WorkNorm'];
                        $dm[$DptID]['Weeks_ref'][$year][$week][$kd] = $wwdays * $vd['WorkNorm'];
                        $lweeks[$year][$week][$kd] -= $whours[$kd][$year]['Weeks'][(int)$week];
                        $lweeks[$year][$week][$kd] -= $xvacations[$kd][$year]['Weeks'][$week] * $vd['WorkNorm'];
                    }
                }
            }
            $lmonths = array();
            foreach ($months as $year => $month_range) {
                foreach ($month_range as $month) {
                    $mths = strtotime("$year-$month-01");
                    $mthe = strtotime(date('Y-m-t', $mths));
                    $days_count = Utils::getDaysDiff(date('Y-m-d', $mths), date('Y-m-d', $mthe));
                    foreach ($department as $kd => $vd) {
                        $ndc = false;
                        $ndcs = $mths;
                        $ndce = $mthe;
                        $dc = $days_count;
                        if (strtotime($vd['StartDate']) > $mths && strtotime($vd['StartDate']) <= $mthe) {
                            $ndcs = strtotime($vd['StartDate']);
                            $ndc = true;
                        }
                        if ($vd['StopDate'] != '0000-00-00' && $vd['StopDate'] != '' && strtotime($vd['StopDate']) < $mthe && strtotime($vd['StopDate']) > $mths) {
                            $ndce = strtotime($vd['StopDate']);
                            $ndc = true;
                        }
                        if ($ndc) {
                            $dc = Utils::getDaysDiff(date('Y-m-d', $ndcs), date('Y-m-d', $ndce));
                        }
                        $lmonths[$year][$month][$kd] = $dc * $vd['WorkNorm'];
                        $lmonths[$year][$month][$kd] -= $whours[$kd][$year]['Months'][(int)$month];
                        $lmonths[$year][$month][$kd] -= $xvacations[$kd][$year]['Months'][$month] * $vd['WorkNorm'];
                    }
                }
            }
            $dm[$DptID]['Dates'] = $ldays;
            $dm[$DptID]['Totals'] = array_fill_keys($days, "");
            $dm[$DptID]['Weeks'] = $lweeks;
            $dm[$DptID]['Months'] = $lmonths;
//            !isset($dm[$DptID]['PersonCount']) ? $dm[$DptID]['PersonCount'] = count($department)+2 : '';
//            !isset($dm[$DptID]['RSpan']) ? $dm[$DptID]['RSpan'] = count($days)*$dm[$DptID]['PersonCount'] : '';
            foreach ($department as $PersonID => $person) {
                if (!empty($ndays[$PersonID])) {
                    foreach ($ndays[$PersonID] as $nday) {
                        unset($dm[$DptID]['Dates'][$nday][$PersonID]);
                    }
                }

                if (isset($vacations[$PersonID])) {
                    foreach ($vacations[$PersonID] as $kday => $vday) {
                        if (isset($dm[$DptID]['Dates'][$kday][$PersonID])) {
                            foreach ($hours as $hour) {
                                $dm[$DptID]['Dates'][$kday][$PersonID][$hour] = $vday;
                            }
                        }
                    }
                }

                if (isset($list[$PersonID])) {
                    foreach ($list[$PersonID] as $interval) {

                        $starti = strtotime($interval['StartHour']);
                        $endi = strtotime($interval['EndHour']);
                        if ($starti % 1800 > 0) {
                            $diff = $starti % 1800;
                            if ($diff > 900) {
                                $starti += 1800 - $diff;
                            } else {
                                $starti -= $diff;
                            }
                        }
                        if ($endi % 1800 > 0) {
                            $diff = $endi % 1800;
                            if ($diff > 900) {
                                $endi += 1800 - $diff;
                            } else {
                                $endi -= $diff;
                            }
                        }
                        $cursor = $start = strtotime($interval['StartDate'] . " " . date("H:i", $starti));
                        $pin = $end = strtotime($interval['EndDate'] . " " . date("H:i", $endi));

                        while ($cursor < $end) {
                            $eod = strtotime(date('Y-m-d', $cursor) . " +1 day");
                            if ($pin != $end) {
                                $pin = $end;
                            }

                            if ($pin > $eod) {
                                $pin = $eod;
                            }
                            $sh = date('H:i', $cursor);
                            $eh = date('H:i', $pin - 1800);
                            $cday = date('Y-m-d', $cursor);
                            if (isset($dm[$DptID]['Dates'][$cday][$PersonID])) {
                                if (in_array($interval['Type'], array(0))) {
                                    $dm[$DptID]['Days'][$cday][$PersonID] += ($pin - $cursor) / 3600;
                                    $dm[$DptID]['Sums']['Days'][$cday] += ($pin - $cursor) / 3600;
                                }
                                for ($i = $flipped_hours[$sh]; $i <= $flipped_hours[$eh]; $i++) {
                                    if (!isset($dm[$DptID]['Dates'][$cday][$PersonID][$hours[$i]])) {
                                        $dm[$DptID]['Dates'][$cday][$PersonID][$hours[$i]] = $interval['Type'];
                                        if (in_array($interval['Type'], array(0))) {
                                            $dm[$DptID]['Totals'][$cday][$hours[$i]]++;
                                        }
                                    }
                                }
                            }
                            $cursor = $pin;
                        }
                    }
                }
            }
            foreach ($dm[$DptID]['Dates'] as $kday => $day) {
                $dm[$DptID]['RSpan'] += count($day) + 2;
                $dm[$DptID]['DayPersonCount'][$kday] = count($day) + 2;
            }
        }
//        echo "<pre>";print_r($dm); echo "</pre>";exit;
        return array($dm, $hours, $departments, $vacations, $weeksbydays);

    }

    public static function getAllPersonsDetail($action = '')
    {

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return array();
        }

        global $conn, $cal, $pdisplacements;

        $_GET['StartDate'] = Utils::toDBDate($_GET['StartDate']);
        $_GET['EndDate'] = Utils::toDBDate($_GET['EndDate']);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        $cal = array();

        $st_y = (int)substr($_GET['StartDate'], 0, 4);
        $st_m = (int)substr($_GET['StartDate'], 5, 2);
        $st_d = (int)substr($_GET['StartDate'], 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $_GET['EndDate']) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D' && !isset(Utils::$msLegal[$date])) {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        $cond = "";

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND h.DistrictID = " . (int)$_GET['DistrictID'];
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND g.CityID = " . (int)$_GET['CityID'];
        }

        if (!empty($_GET['Status'])) {

            $cond .= $_GET['Status'] == '2_6_5' ? " AND (a.Status IN (2,5,6))" : " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.CompanyID = " . (int)$_GET['CompanyID'];
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $cond .= " AND c.CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND c.DepartmentID = " . (int)$_GET['DepartmentID'];
        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND c.DivisionID = " . (int)$_GET['DivisionID'];
        }

        if (!empty($_GET['CostCenterID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR c.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][4]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][11][4]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(DISTINCT a.PersonID) AS total
                   FROM   persons a
		          INNER JOIN payroll c ON a.PersonID = c.PersonID AND c.StartDate != '0000-00-00' AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate > '{$_GET['StartDate']}')
                	  LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;
        $persons[0]['total'] = $row['total'];

        $query = "SELECT a.PersonID, a.FullName, c.StartDate, CASE WHEN c.StopDate != '0000-00-00' THEN c.StopDate ELSE '' END AS StopDate, 
	                 c.WorkNorm, b.StartDate AS PStartDate, b.EndDate AS PEndDate, b.Hours, b.Hours2, c.CompanyID
		  FROM   persons a
		         INNER JOIN payroll c ON a.PersonID = c.PersonID AND (c.StartDate != '0000-00-00' OR c.StartDate IS NOT NULL) AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate IS NULL OR c.StopDate >= '{$_GET['StartDate']}')
                	 LEFT JOIN address e ON e.AddressID = a.AddressID
                         LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                         LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "	 
			 LEFT JOIN pontaj_detail b ON a.PersonID = b.PersonID AND b.StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
		  WHERE  ($condbase) $cond
		  ORDER  BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['CompanyID'] = $row['CompanyID'];
            $persons[$row['PersonID']]['StartDate'] = $row['StartDate'];
            $persons[$row['PersonID']]['StopDate'] = $row['StopDate'];
            $persons[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];
            if (!empty($row['PStartDate'])) {
                @$persons[$row['PersonID']]['Data'][$row['PStartDate']] += (double)$row['Hours'];
                if ($row['PStartDate'] != $row['PEndDate']) {
                    @$persons[$row['PersonID']]['Data'][$row['PEndDate']] += (double)$row['Hours2'];
                }
            }
        }

        if ($persons[0]['total'] >= $res_per_page && (empty($action) || $action == 'print_page')) {
            $persons_slice = array_slice($persons, ($page - 1) * $res_per_page, $res_per_page, true);
            unset($persons);
            $persons = $persons_slice;
        }

        $query = "SELECT PersonID, StartDate, StopDate, Type 
	          FROM   vacations_details 
	          WHERE  ((StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		         (StopDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		         ('{$_GET['StartDate']}' BETWEEN StartDate AND StopDate)) AND Aprove >= 0
                        AND Type != 'INV'
	          ORDER  BY StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }

        foreach ($persons as $k => $v) {
            $pdisp_days = PayRoll::getDisplacementDays($k, date('Y-m-d', strtotime($_GET['StartDate'])), date('Y-m-d', strtotime($_GET['EndDate']) + 24 * 3600));
            foreach ($cal as $date => $w) {
                if (in_array($date, $pdisp_days)) {
                    $pdisplacements[$k][$date] = 1;
                }


                if (isset($vacations[$k])) {
                    foreach ($vacations[$k] as $vac) {
                        if ($vac['StartDate'] <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D') {
//			    if (isset($v['Data'][$date])) {
//				continue;
//			    }
                            $persons[$k]['Data'][$date] = $vac['Type'];
                            break;
                        }
                    }
                }
            }
        }

        return $persons;
    }

    public static function getPersonDetailActivities($PersonID, $StartDate)
    {

        global $conn, $smarty;

        $activities = array();

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][4][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][4]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		      '{$_SESSION['USER_RIGHTS2'][11][4]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $condrw = "('{$_SESSION['USER_RIGHTS2'][11][4]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	           OR
	           '{$_SESSION['USER_RIGHTS3'][11][4][1]}' = 2
		   OR
		   {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, b.WorkNorm, b.WorkStartHour, b.CompanyID,
	                     CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  a.PersonID = '{$PersonID}' AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $activities[0] = $row;
        } else {
            $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo smarty_function_translate($params, $smarty) . '!';
            exit;
        }

        $activities[0]['StartDate'] = $StartDate;
        $activities[0]['Status'] = 7;
        $activities[0]['MaxStatus'] = 0;
        $activities[0]['THours'] = 0;

        $pontaj_validation_level = !empty($activities[0]['CompanyID']) && isset($_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_validation_level']) ? (int)$_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_validation_level'] : 0;

        $conn->query("SELECT ID, StartDate, StartHour, EndDate, EndHour, CostCenterID, Type, Status, Notes,
	                     CASE WHEN StartDate = DATE_SUB('{$StartDate}', INTERVAL 1 DAY) AND EndDate = '{$StartDate}' THEN Hours2 ELSE Hours END AS Hours
	              FROM   pontaj_detail 
		      WHERE  PersonID = '{$PersonID}' AND 
		             (StartDate = '{$StartDate}' OR (StartDate = DATE_SUB('{$StartDate}', INTERVAL 1 DAY) AND EndDate = '{$StartDate}'))
		      ORDER  BY StartDate, StartHour");
        while ($row = $conn->fetch_array()) {
            $row['Notes'] = stripslashes($row['Notes']);
            $row['rw'] = $_SESSION['USER_ID'] == 1 ||
            ($pontaj_validation_level == 1 && $row['Status'] < 1) ||
            ($pontaj_validation_level == 2 && $row['Status'] < 2) ||
            ($pontaj_validation_level == 3 && $row['Status'] < 3) ||
            ($pontaj_validation_level == 4 && $row['Status'] < 4) ||
            ($pontaj_validation_level == 5 && $row['Status'] < 5) ||
            ($pontaj_validation_level == 6 && $row['Status'] < 6) ||
            ($pontaj_validation_level == 7 && $row['Status'] < 7) ? 1 : 0;
            $activities[0]['THours'] += $row['Hours'];
            if ($row['Status'] < $activities[0]['Status']) {
                $activities[0]['Status'] = $row['Status'];
            }
            if ($row['Status'] > $activities[0]['MaxStatus']) {
                $activities[0]['MaxStatus'] = $row['Status'];
            }
            $activities[$row['ID']] = $row;
        }

        return $activities;
    }

    public static function setPersonHoursActivity($PersonID)
    {
        if (empty($PersonID)) {
            return;
        }
        global $conn;

        switch ($_GET['action']) {
            case 'new':
            case 'edit':
            case 'del':
                $Date = date('Y-m-d', strtotime($_GET['StartDate']));
                $start = strtotime($Date . " " . $_GET['StartHour']);
                $end = strtotime($Date . " " . $_GET['EndHour']);
                $costcenter = (int)$_GET['CostCenterID'];
                if ($end < $start) {
                    $tmp = $start;
                    $start = $end;
                    $end = $tmp;
                }
                $end += 1800;
                $type = (int)$_GET['Type'];


                $lunchstart = $lunchend;

                $conn->query("SELECT LunchBreakStartHour, LunchBreakEndHour FROM payroll WHERE PersonID = '{$PersonID}'");
                if ($row = $conn->fetch_array()) {
                    if (!empty($row['LunchBreakStartHour']) && !empty($row['LunchBreakEndHour'])) {
                        $lunchstart = strtotime($Date . " " . $row['LunchBreakStartHour']);
                        $lunchend = strtotime($Date . " " . $row['LunchBreakEndHour']);
                    }
                }

                $hours = round(($end - $start) / 3600, 2);
                if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $end && $lunchend > $start) {
                    $lstart = $lunchstart;
                    $lend = $lunchend;
                    if ($lstart < $start) {
                        $lstart = $start;
                    }
                    if ($lend > $end) {
                        $lend = $end;
                    }
                    $hours -= round(($lend - $lstart) / 3600, 2);
                }
                if ($hours < 0) {
                    $hours = 0;
                }

                if (($type == 2 || $type == 3 || $type == 6) && $hours > 0) {
//                    $hours = "-".$hours;
                    $hours = 0;
                }
                $skip_add = false;
                $interval_id;


                $query = "SELECT * FROM pontaj_detail 
                            WHERE PersonID = '{$PersonID}'
                            AND STR_TO_DATE(CONCAT(StartDate,' ',StartHour), '%Y-%m-%d %H:%i') <= '" . date('Y-m-d H:i:s', $end) . "'
                            AND STR_TO_DATE(CONCAT(EndDate,' ',EndHour), '%Y-%m-%d %H:%i') >= '" . date('Y-m-d H:i:s', $start) . "'";

                $conn->query($query);
                $intervals = array();
                while ($row = $conn->fetch_array()) {
                    $intervals[] = $row;
                }


                foreach ($intervals as $interval) {
                    $istart = strtotime($interval['StartDate'] . " " . $interval['StartHour']);
                    $iend = strtotime($interval['EndDate'] . " " . $interval['EndHour']);
                    $ihstart = $ihend;
                    if ($istart >= $start && $iend <= $end) {
                        $conn->query("DELETE FROM pontaj_detail WHERE ID = '" . $interval['ID'] . "'");
                    } elseif ($istart >= $start && $iend > $end) {
                        if ($type == $interval['Type'] && $istart <= $end) {
                            $ihend = $iend;
                            $ihstart = $start;
                            $end = $iend;
                            $istartd = date('Y-m-d', $start);
                            $istarth = date('H:i', $start);
                            $skip_add = true;
                        } else {
                            $ihend = $iend;
                            $ihstart = $end;
                            $istartd = date('Y-m-d', $end);
                            $istarth = date('H:i', $end);
                        }

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        if (($interval['Type'] == 2 || $interval['Type'] == 3 || $interval['Type'] == 6) && $ihours > 0) {
//                            $ihours = "-".$ihours;
                            $ihours = 0;
                        }
                        $conn->query("UPDATE pontaj_detail SET StartDate = '{$istartd}', StartHour = '{$istarth}', Hours = '{$ihours}', LastUpdateDate = CURRENT_TIMESTAMP WHERE ID = '" . $interval['ID'] . "'");
                        if (!empty($interval_id)) {
                            $conn->query("DELETE FROM pontaj_detail WHERE ID = '" . $interval_id . "'");
                            $interval_id = "";
                        } elseif ($skip_add) {
                            $interval_id = $interval['ID'];
                        }
                    } elseif ($istart < $start) {
                        if ($type == $interval['Type'] && $iend >= $start) {
                            $ihend = $end;
                            $ihstart = $istart;
                            $start = $istart;
                            $iendd = date('Y-m-d', $end);
                            $iendh = date('H:i', $end);
                            $skip_add = true;
                        } else {
                            $ihend = $start;
                            $ihstart = $istart;
                            $iendd = date('Y-m-d', $start);
                            $iendh = date('H:i', $start);
                        }

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        if (($interval['Type'] == 2 || $interval['Type'] == 3 || $interval['Type'] == 6) && $ihours > 0) {
//                            $ihours = "-".$ihours;
                            $ihours = 0;
                        }
                        $conn->query("UPDATE pontaj_detail SET EndDate = '{$iendd}', EndHour = '{$iendh}', Hours = '{$ihours}', LastUpdateDate = CURRENT_TIMESTAMP WHERE ID = '" . $interval['ID'] . "'");
                        if (!empty($interval_id)) {
                            $conn->query("DELETE FROM pontaj_detail WHERE ID = '" . $interval_id . "'");
                            $interval_id = "";
                        } elseif ($skip_add) {
                            $interval_id = $interval['ID'];
                        }
                    }
                    if ($istart < $start && $iend > $end) {
                        $ihend = $iend;
                        $ihstart = $end;
                        $istartd = date('Y-m-d', $end);
                        $istarth = date('H:i', $end);

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        if (($interval['Type'] == 2 || $interval['Type'] == 3 || $interval['Type'] == 6) && $ihours > 0) {
//                            $ihours = "-".$ihours;
                            $ihours = 0;
                        }
                        $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                     VALUES('" . $interval['UserID'] . "', '" . $interval['PersonID'] . "', '{$istartd}', '{$istarth}', '" . $interval['EndDate'] . "', '" . $interval['EndHour'] . "', '$ihours', '" . $interval['Hours2'] . "',
		                                            '" . $interval['CostCenterID'] . "', '" . $interval['Type'] . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                    }
                }

                if ($_GET['action'] != 'del' && !$skip_add) {
                    $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                 VALUES('{$_SESSION['USER_ID']}', $PersonID, '{$Date}', '" . date('H:i', $start) . "', '" . (date('Y-m-d', $end)) . "', '" . date('H:i', $end) . "', '$hours', '0',
                                                        '{$costcenter}', '$type', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                }

                $conn->query("INSERT INTO persons_log(UserID, PID, PersonID, Type, Comment, CreateDate)
	              VALUES({$_SESSION['USER_ID']},'{$_SESSION['PERS']}', $PersonID, 5, 'Actualizare pontaj; Data: {$Date} Interval orar: " . date('H:i', $start) . " - " . date('H:i', $end) . "; Tip: " . ConfigData::$msPontajTypes[$type] . ";', CURRENT_TIMESTAMP)");
                break;
        }
    }

    public static function transferPlanifToDetail()
    {
        if (empty($_GET["StartDate"]) || empty($_GET['EndDate'])) {
            return;
        }

        $StartDate = date('Y-m-d', strtotime($_GET["StartDate"]));
        $EndDate = date('Y-m-d', strtotime($_GET['EndDate']));
        global $conn;


        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR c.DirectManagerID = '{$_SESSION['PERS']}' " : "";

        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][8]}' = 1 AND (b.UserID = {$_SESSION['USER_ID']} OR b.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][11][8]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.PersonID, b.FullName, c.DepartmentID, c.LunchBreakStartHour, c.LunchBreakEndHour, c.WorkStartHour, c.WorkNorm 
                    FROM persons b
                    INNER JOIN payroll c ON c.PersonID = b.PersonID
                    LEFT JOIN address d ON d.AddressID = b.AddressID
                    LEFT JOIN address_city e ON e.CityID = d.CityID
                    WHERE 1=1 AND ({$condbase})";


        if (!empty($_GET['DistrictID'])) {
            $query .= " AND e.DistrictID = '" . (int)($_GET['DistrictID']) . "'";
        }

        if (!empty($_GET['CityID'])) {
            $query .= " AND e.CityID = '" . (int)($_GET['CityID']) . "'";
        }

        if (!empty($_GET['Status'])) {
            $query .= " AND b.Status = '" . (int)($_GET['Status']) . "'";
        }

        if (!empty($_GET['CompanyID'])) {
            $query .= " AND c.CompanyID = '" . (int)($_GET['CompanyID']) . "'";
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $query .= " AND c.CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")";
        }

        if (!empty($_GET['DivisionID'])) {
            $query .= " AND c.DivisionID = '" . (int)($_GET['DivisionID']) . "'";
        }

        if (!empty($_GET['DepartmentID'])) {
            $query .= " AND c.DepartmentID = '" . (int)($_GET['DepartmentID']) . "'";
        }

        if (!empty($_GET['CostCenterID'])) {
            $query .= " AND b.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        if (!empty($_GET['search_for']) && !empty($_GET['keyword'])) {
            switch ($_GET['search_for']) {
                case 'LastName':
                    $query .= " AND b.LastName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'FirstName':
                    $query .= " AND b.FirstName LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
                case 'CNP':
                    $query .= " AND b.CNP LIKE '%" . $conn->real_escape_string($_GET['keyword']) . "%'";
                    break;
            }
        }
        $query .= " ORDER BY b.FullName";
        $conn->query($query);
        $persons_list = "";
        while ($row = $conn->fetch_array()) {
            $persons_list .= (!empty($persons_list) ? "','" : "") . $row['PersonID'];
        }
//        echo "<pre>";print_r($departments); echo "</pre>";exit;

        $query = "SELECT COUNT(a.ID) as cnt
                    FROM pontaj_detail a
                    WHERE (a.StartDate <= '{$EndDate}' AND a.EndDate >= '{$StartDate}')
                    AND a.PersonID IN('" . $persons_list . "')";

        $conn->query($query);

        if ($row = $conn->fetch_array()) {
            if (!empty($row['cnt'])) {
                return;
            }
        }

        $query = "SELECT *
                    FROM pontaj_planif a
                    WHERE (a.StartDate <= '{$EndDate}' AND a.EndDate >= '{$StartDate}')
                    AND a.PersonID IN('" . $persons_list . "')";

        $conn->query($query);
        $list = array();
        while ($row = $conn->fetch_array()) {
            $list[] = $row;
        }


        foreach ($list as $interval) {
            unset($interval['ID']);
            unset($interval['CreateDate']);
            unset($interval['LastUpdateDate']);
            if ($interval['Type'] == 1) {
                $interval['Type'] = 6;
            } else {
                $interval['Type'] = 1;
            }

            $conn->query("INSERT INTO pontaj_detail(" . implode(",", array_keys($interval)) . ", CreateDate, LastUpdateDate)
                                                 VALUES('" . (implode("','", $interval)) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        }
        return true;
    }

    public static function setPersonPlanifHoursActivity($PersonID)
    {
        if (empty($PersonID)) {
            return;
        }
        global $conn;

        switch ($_GET['action']) {
            case 'new':
            case 'edit':
            case 'del':
                $Date = date('Y-m-d', strtotime($_GET['StartDate']));
                $start = strtotime($Date . " " . $_GET['StartHour']);
                $end = strtotime($Date . " " . $_GET['EndHour']);
                $costcenter = (int)$_GET['CostCenterID'];
                if ($end < $start) {
                    $tmp = $start;
                    $start = $end;
                    $end = $tmp;
                }
                $end += 1800;
                $type = $conn->real_escape_string($_GET['Type']);


                $lunchstart = $lunchend;

                $conn->query("SELECT LunchBreakStartHour, LunchBreakEndHour FROM payroll WHERE PersonID = '{$PersonID}'");
                if ($row = $conn->fetch_array()) {
                    if (!empty($row['LunchBreakStartHour']) && !empty($row['LunchBreakEndHour'])) {
                        $lunchstart = strtotime($Date . " " . $row['LunchBreakStartHour']);
                        $lunchend = strtotime($Date . " " . $row['LunchBreakEndHour']);
                    }
                }

                $hours = round(($end - $start) / 3600, 2);
                if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $end && $lunchend > $start) {
                    $lstart = $lunchstart;
                    $lend = $lunchend;
                    if ($lstart < $start) {
                        $lstart = $start;
                    }
                    if ($lend > $end) {
                        $lend = $end;
                    }
                    $hours -= round(($lend - $lstart) / 3600, 2);
                }
                if ($hours < 0) {
                    $hours = 0;
                }

                if (($type == 1) && $hours > 0) {
//                    $hours = "-".$hours;
                    $hours = 0;
                }
                $skip_add = false;
                $interval_id;


                $query = "SELECT * FROM pontaj_planif 
                            WHERE PersonID = '{$PersonID}'
                            AND STR_TO_DATE(CONCAT(StartDate,' ',StartHour), '%Y-%m-%d %H:%i') <= '" . date('Y-m-d H:i:s', $end) . "'
                            AND STR_TO_DATE(CONCAT(EndDate,' ',EndHour), '%Y-%m-%d %H:%i') >= '" . date('Y-m-d H:i:s', $start) . "'";

                $conn->query($query);
                $intervals = array();
                while ($row = $conn->fetch_array()) {
                    $intervals[] = $row;
                }


                foreach ($intervals as $interval) {
                    $istart = strtotime($interval['StartDate'] . " " . $interval['StartHour']);
                    $iend = strtotime($interval['EndDate'] . " " . $interval['EndHour']);
                    $ihstart = $ihend;
                    if ($istart >= $start && $iend <= $end) {
                        $conn->query("DELETE FROM pontaj_planif WHERE ID = '" . $interval['ID'] . "'");
                    } elseif ($istart >= $start && $iend > $end) {
                        if ($type === $interval['Type'] && $istart <= $end) {
                            $ihend = $iend;
                            $ihstart = $start;
                            $end = $iend;
                            $istartd = date('Y-m-d', $start);
                            $istarth = date('H:i', $start);
                            $skip_add = true;
                        } else {
                            $ihend = $iend;
                            $ihstart = $end;
                            $istartd = date('Y-m-d', $end);
                            $istarth = date('H:i', $end);
                        }

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        if (($interval['Type'] == 1) && $ihours > 0) {
//                            $ihours = "-".$ihours;
                            $ihours = 0;
                        }
                        $conn->query("UPDATE pontaj_planif SET StartDate = '{$istartd}', StartHour = '{$istarth}', Hours = '{$ihours}', LastUpdateDate = CURRENT_TIMESTAMP WHERE ID = '" . $interval['ID'] . "'");
                        if (!empty($interval_id)) {
                            $conn->query("DELETE FROM pontaj_planif WHERE ID = '" . $interval_id . "'");
                            $interval_id = "";
                        } elseif ($skip_add) {
                            $interval_id = $interval['ID'];
                        }
                    } elseif ($istart < $start) {
                        if ($type === $interval['Type'] && $iend >= $start) {
                            $ihend = $end;
                            $ihstart = $istart;
                            $start = $istart;
                            $iendd = date('Y-m-d', $end);
                            $iendh = date('H:i', $end);
                            $skip_add = true;
                        } else {
                            $ihend = $start;
                            $ihstart = $istart;
                            $iendd = date('Y-m-d', $start);
                            $iendh = date('H:i', $start);
                        }

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        if (($interval['Type'] == 1) && $ihours > 0) {
//                            $ihours = "-".$ihours;
                            $ihours = 0;
                        }
                        $conn->query("UPDATE pontaj_planif SET EndDate = '{$iendd}', EndHour = '{$iendh}', Hours = '{$ihours}', LastUpdateDate = CURRENT_TIMESTAMP WHERE ID = '" . $interval['ID'] . "'");
                        if (!empty($interval_id)) {
                            $conn->query("DELETE FROM pontaj_planif WHERE ID = '" . $interval_id . "'");
                            $interval_id = "";
                        } elseif ($skip_add) {
                            $interval_id = $interval['ID'];
                        }
                    }
                    if ($istart < $start && $iend > $end) {
                        $ihend = $iend;
                        $ihstart = $end;
                        $istartd = date('Y-m-d', $end);
                        $istarth = date('H:i', $end);

                        $ihours = round(($ihend - $ihstart) / 3600, 2);
                        if (!empty($lunchstart) && !empty($lunchend) && $lunchstart < $ihend && $lunchend > $ihstart) {
                            $lstart = $lunchstart;
                            $lend = $lunchend;
                            if ($lstart < $ihstart) {
                                $lstart = $ihstart;
                            }
                            if ($lend > $ihend) {
                                $lend = $ihend;
                            }
                            $ihours -= round(($lend - $lstart) / 3600, 2);
                        }

                        if ($ihours < 0) {
                            $ihours = 0;
                        }
                        $conn->query("INSERT INTO pontaj_planif(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                     VALUES('" . $interval['UserID'] . "', '" . $interval['PersonID'] . "', '{$istartd}', '{$istarth}', '" . $interval['EndDate'] . "', '" . $interval['EndHour'] . "', '$ihours', '" . $interval['Hours2'] . "',
		                                            '" . $interval['CostCenterID'] . "', '" . $interval['Type'] . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                    }
                }

                if ($_GET['action'] != 'del' && !$skip_add) {
                    $conn->query("INSERT INTO pontaj_planif(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                 VALUES('{$_SESSION['USER_ID']}', $PersonID, '{$Date}', '" . date('H:i', $start) . "', '" . date('Y-m-d', $end) . "', '" . date('H:i', $end) . "', '$hours', '0',
                                                        '{$costcenter}', '$type', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                }
                break;
        }
    }

    public static function setPersonDetailActivities($PersonID)
    {

        global $conn, $smarty, $err;

        switch ($_GET['action']) {

            case 'new':
            case 'edit':
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $EndDate = Utils::toDBDate($_GET['EndDate']);
                $start = strtotime($StartDate . ' ' . $_GET['StartHour'] . ':00');
                $end = strtotime($EndDate . ' ' . $_GET['EndHour'] . ':00');
                $type = (int)$_GET['Type'];
                if ($StartDate != $EndDate) {
                    $hours = round((strtotime($StartDate . ' 23:59:59') - $start) / 3600, 2);
                    $hours2 = round(($end - strtotime($EndDate . ' 00:00:00')) / 3600, 2);
                } else {
                    $hours = round(($end - $start) / 3600, 2);
                    $hours2 = 0;
                }
                $ID = (int)$_GET['ID'];
                if ($type != 2 && $type != 3) { // except Invoire & Ore nemotivate
                    $query = "SELECT ID
		            	      FROM   pontaj_detail
			    	      WHERE  PersonID = $PersonID AND " . ($ID > 0 ? "ID != $ID AND " : "") . "
			              (
			                (CONCAT(StartDate, ' ', StartHour, ':00') >= '{$StartDate} {$_GET['StartHour']}:00' AND CONCAT(StartDate, ' ', StartHour, ':00') < '{$EndDate} {$_GET['EndHour']}:00') OR
				        (CONCAT(EndDate, ' ', EndHour, ':00') > '{$StartDate} {$_GET['StartHour']}:00' AND CONCAT(EndDate, ' ', EndHour, ':00') <= '{$EndDate} {$_GET['EndHour']}:00') OR
					('{$StartDate} {$_GET['StartHour']}:00' >= CONCAT(StartDate, ' ', StartHour, ':00') AND '{$StartDate} {$_GET['StartHour']}:00' < CONCAT(EndDate, ' ', EndHour, ':00'))
				      ) ";
                    $conn->query($query);
                    if ($row = $conn->fetch_array()) {
                        require_once $smarty->_get_plugin_filepath('function', 'translate');
                        $err->setError(smarty_function_translate(array('label' => 'Activitatea se suprapune peste o activitate existenta'), $smarty));
                        $_GET['StartDate'] = Utils::toDBDate($_GET['StartDate']);
                        return;
                    }
                }
                $conn->query("SELECT LunchBreakStartHour, LunchBreakEndHour FROM payroll WHERE PersonID = $PersonID");
                if ($row = $conn->fetch_array()) {
                    if (!empty($row['LunchBreakStartHour']) && !empty($row['LunchBreakEndHour'])) {
                        $lunch_break_start = strtotime($StartDate . ' ' . $row['LunchBreakStartHour'] . ':00');
                        $lunch_break_end = strtotime($StartDate . ' ' . $row['LunchBreakEndHour'] . ':00');
                        if ($lunch_break_start > $start && $lunch_break_end < $end) {
                            $hours = round($hours - ($lunch_break_end - $lunch_break_start) / 3600, 2);
                        }
                    }
                }
                // negative values for Invoire & Ore nemotivate
                if ($type == 2 || $type == 3) {
                    $hours = -$hours;
                    $hours2 = -$hours2;
                }

                if ($ID > 0) {
                    $conn->query("UPDATE pontaj_detail SET
							    StartDate 	 	= '$StartDate',
							    StartHour 	 	= '{$_GET['StartHour']}',
							    EndDate   	 	= '$EndDate',
							    EndHour   	 	= '{$_GET['EndHour']}',
							    Hours     	 	= '$hours',
							    Hours2    	 	= '$hours2',
							    CostCenterID 	= '{$_GET['CostCenterID']}',
							    Type         	= '$type',
							    LastUpdateDate 	= CURRENT_TIMESTAMP
		                  WHERE  PersonID = $PersonID AND ID = $ID");
                } else {
                    $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                     VALUES('{$_SESSION['USER_ID']}', $PersonID, '$StartDate', '{$_GET['StartHour']}', '$EndDate', '{$_GET['EndHour']}', '$hours', '$hours2',
		                                            '{$_GET['CostCenterID']}', '$type', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                }
                header('Location: ./?m=pontaj&o=pdetail_act&PersonID=' . $PersonID . '&StartDate=' . Utils::toDBDate($_GET['StartDate']));
                exit;

                break;

            case 'set_notes':

                $conn->query("UPDATE pontaj_detail SET Notes = '" . Utils::formatStr($_GET['Notes']) . "' WHERE PersonID = $PersonID AND StartDate = '{$_GET['StartDate']}'");
                header('Location: ./?m=pontaj&o=pdetail_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'del':

                $ID = (int)$_GET['ID'];
                $conn->query("DELETE FROM pontaj_detail WHERE PersonID = $PersonID AND ID = $ID");
                header('Location: ./?m=pontaj&o=pdetail_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'accept':
            case 'accept_all':

                $Status = (int)$_GET['Status'];

                if ($_GET['action'] == 'accept_all') {
                    $conn->query("UPDATE pontaj_detail SET Status = $Status WHERE PersonID = $PersonID AND StartDate = '{$_GET['StartDate']}' AND Status = " . ($Status - 1));
                } else {
                    $ID = (int)$_GET['ID'];
                    $conn->query("UPDATE pontaj_detail SET Status = $Status WHERE PersonID = $PersonID AND ID = $ID");
                }
                if ($Status < 7) {
                    switch ($Status) {
                        case 1:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 22 AND Active = 1";
                            $query2 = "SELECT FullName, Email FROM persons WHERE PersonID = (SELECT DirectManagerID FROM payroll WHERE PersonID = $PersonID)";
                            break;
                        case 2:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 23 AND Active = 1";
                            break;
                        case 3:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 25 AND Active = 1";
                            break;
                        case 4:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 26 AND Active = 1";
                            break;
                        case 5:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 27 AND Active = 1";
                            break;
                        case 6:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 28 AND Active = 1";
                            break;
                    }
                    $conn->query($query);
                    if ($row = $conn->fetch_array()) {
                        $headers = "From: \"{$row['FromAlias']}\" <{$row['FromEmail']}>";
                        $conn->query("SELECT FullName FROM persons WHERE PersonID = $PersonID");
                        if ($row2 = $conn->fetch_array()) {
                            $message = str_replace(array('<<FullName>>', '<<StartDate>>'), array($row2['FullName'], Utils::toDBDate($_GET['StartDate'])), $row['Body']);
                        }
                        if ($Status > 1) {
                            $Settings = !empty($row['Settings']) ? unserialize($row['Settings']) : array();
                            if (!empty($Settings['roles'])) {
                                $roles = array();
                                foreach ($Settings['roles'] as $RoleID => $v) {
                                    if ($v == 1) {
                                        $roles[] = $RoleID;
                                    }
                                }
                                if (!empty($roles)) {
                                    $query2 = "SELECT FullName, Email FROM persons WHERE RoleID IN (" . implode(',', $roles) . ")";
                                }
                            }
                        }
                        if (!empty($query2)) {
                            $conn->query($query2);
                            while ($row2 = $conn->fetch_array()) {
                                @mail("\"{$row2['FullName']}\" <{$row2['Email']}>", $row['Subject'], $message, $headers);
                            }
                        }
                    }
                }
                header('Location: ./?m=pontaj&o=pdetail_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'reject':
            case 'reject_all':

                if ($_GET['action'] == 'reject_all') {
                    $conn->query("UPDATE pontaj_detail SET Status = 0 WHERE PersonID = $PersonID AND StartDate = '{$_GET['StartDate']}'");
                } else {
                    $ID = (int)$_GET['ID'];
                    $conn->query("UPDATE pontaj_detail SET Status = 0 WHERE PersonID = $PersonID AND ID = $ID");
                }
                header('Location: ./?m=pontaj&o=pdetail_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;
        }

    }

    public static function setAllPersonDetailActivities()
    {
        global $conn;
        $_GET['StartDate'] = Utils::toDBDate($_GET['StartDate']);
        $_GET['EndDate'] = Utils::toDBDate($_GET['EndDate']);
        foreach ($_POST['pvalid'] as $personid => $companyid) {
            if ($_SESSION['USER_ID'] == 1) {
                $query = "UPDATE pontaj_detail SET Status = Status + 1
	                  WHERE  PersonID = $personid AND 
			         StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND 
			         Status < 7";
                $conn->query($query);
            } else {
                $pontaj_validation_level = !empty($companyid) && isset($_SESSION['COMPANY_SETTINGS'][$companyid]['pontaj_validation_level']) ? (int)$_SESSION['COMPANY_SETTINGS'][$companyid]['pontaj_validation_level'] : 0;
                if (empty($pontaj_validation_level)) {
                    continue;
                }
                $Status = $pontaj_validation_level;
                $query = "UPDATE pontaj_detail SET Status = $Status 
	                   WHERE  PersonID = $personid AND 
			          StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND 
			          Status = " . ($Status - 1);
                $conn->query($query);
                if ($Status < 7) {
                    switch ($Status) {
                        case 1:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 22 AND Active = 1";
                            $query2 = "SELECT FullName, Email FROM persons WHERE PersonID = (SELECT DirectManagerID FROM payroll WHERE PersonID = $personid)";
                            break;
                        case 2:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 23 AND Active = 1";
                            break;
                        case 3:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 25 AND Active = 1";
                            break;
                        case 4:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 26 AND Active = 1";
                            break;
                        case 5:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 27 AND Active = 1";
                            break;
                        case 6:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 28 AND Active = 1";
                            break;
                    }
                    $conn->query($query);
                    if ($row = $conn->fetch_array()) {
                        $headers = "From: \"{$row['FromAlias']}\" <{$row['FromEmail']}>";
                        $conn->query("SELECT FullName FROM persons WHERE PersonID = $personid");
                        if ($row2 = $conn->fetch_array()) {
                            $message = str_replace(array('<<FullName>>', '<<StartDate>>'), array($row2['FullName'], Utils::toDBDate($_GET['StartDate'])), $row['Body']);
                        }
                        if ($Status > 1) {
                            $Settings = !empty($row['Settings']) ? unserialize($row['Settings']) : array();
                            if (!empty($Settings['roles'])) {
                                $roles = array();
                                foreach ($Settings['roles'] as $RoleID => $v) {
                                    if ($v == 1) {
                                        $roles[] = $RoleID;
                                    }
                                }
                                if (!empty($roles)) {
                                    $query2 = "SELECT FullName, Email FROM persons WHERE RoleID IN (" . implode(',', $roles) . ")";
                                }
                            }
                        }
                        if (!empty($query2)) {
                            $conn->query($query2);
                            while ($row2 = $conn->fetch_array()) {
                                @mail("\"{$row2['FullName']}\" <{$row2['Email']}>", $row['Subject'], $message, $headers);
                            }
                        }
                    }
                }
            }
        }
    }

    public static function getPersonDetailStat($PersonID, $StartDate, $EndDate)
    {

        global $conn, $smarty;

        $stat = array();

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][4][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][4]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		      '{$_SESSION['USER_RIGHTS2'][11][4]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, b.WorkNorm, b.WorkStartHour, b.LunchBreakStartHour, b.LunchBreakEndHour
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  a.PersonID = '{$PersonID}' AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $stat = $row;
        } else {
            $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo smarty_function_translate($params, $smarty) . '!';
            exit;
        }

        $cal = array();

        $st_y = (int)substr($StartDate, 0, 4);
        $st_m = (int)substr($StartDate, 5, 2);
        $st_d = (int)substr($StartDate, 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            $wk = date('w', $time);
            if ($date <= $EndDate) {
                if ($wk != 0 && $wk != 6 && !isset(Utils::$msLegal[$date])) {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        $stat['NormalHours'] = 0;
        $stat['SplHours'] = 0;
        $stat['NightHours'] = 0;
        $stat['LegalHours'] = 0;
        $stat['WkHours'] = 0;

        $conn->query("SELECT StartDate, StartHour, EndDate, EndHour, Type
	              FROM   pontaj_detail 
		      WHERE  PersonID = '{$PersonID}' AND (StartDate BETWEEN '{$StartDate} 00:00:00' AND '{$EndDate} 23:59:59')");
        while ($row = $conn->fetch_array()) {

            $start = strtotime($row['StartDate'] . ' ' . $row['StartHour'] . ':00');
            $end = strtotime($row['EndDate'] . ' ' . $row['EndHour'] . ':00');

            if ($row['Type'] > 1) {
                @$stat['Hours' . $row['Type']] += round(($end - $start) / 3600, 2);
                continue;
            }

            $lunch_break = 0;
            if (!empty($stat['LunchBreakStartHour']) && !empty($stat['LunchBreakEndHour'])) {
                $lunch_break_start = strtotime($row['StartDate'] . ' ' . $stat['LunchBreakStartHour'] . ':00');
                $lunch_break_end = strtotime($row['EndDate'] . ' ' . $stat['LunchBreakEndHour'] . ':00');
                if ($lunch_break_start > $start && $lunch_break_end < $end) {
                    $lunch_break = $lunch_break_end - $lunch_break_start;
                }
            }

            $is_legal_or_wk = 0;

            if (isset(ConfigData::$msLegal[$row['StartDate']])) {
                if ($row['StartDate'] != $row['EndDate']) {
                    if (isset(ConfigData::$msLegal[$row['EndDate']])) {
                        $stat['LegalHours'] += round(($end - $start) / 3600, 2);
                        $is_legal_or_wk = 1;
                    } else {
                        $mid_night = strtotime($row['StartDate'] . ' 23:59:59');
                        $stat['LegalHours'] += round(($mid_night - $start) / 3600, 2);
                        $start = $mid_night;
                    }
                } else {
                    $stat['LegalHours'] += round(($end - $start - $lunch_break) / 3600, 2);
                    $is_legal_or_wk = 1;
                }
            } else {
                if ($row['StartDate'] != $row['EndDate'] && isset(ConfigData::$msLegal[$row['EndDate']])) {
                    $mid_night = strtotime($row['StartDate'] . ' 23:59:59');
                    $stat['LegalHours'] += round(($end - $mid_night) / 3600, 2);
                    $end = $mid_night;
                }
            }

            if (date('w', $start) == 5 && $row['StartDate'] != $row['EndDate']) {
                $mid_night = strtotime($row['StartDate'] . ' 23:59:59');
                $stat['WkHours'] += round(($end - $mid_night) / 3600, 2);
                $end = $mid_night;
            }

            if (date('w', $start) == 6) {
                $stat['WkHours'] += round(($end - $start - $lunch_break) / 3600, 2);
                $is_legal_or_wk = 1;
            }

            if (date('w', $start) == 0) {
                if ($row['StartDate'] != $row['EndDate']) {
                    $mid_night = strtotime($row['StartDate'] . ' 23:59:59');
                    $stat['WkHours'] += round(($mid_night - $start) / 3600, 2);
                    $start = $mid_night;
                } else {
                    $stat['WkHours'] += round(($end - $start - $lunch_break) / 3600, 2);
                    $is_legal_or_wk = 1;
                }
            }

            if ($is_legal_or_wk == 1) {
                continue;
            }

            $start_norm = strtotime($row['StartDate'] . ' ' . $stat['WorkStartHour'] . ':00');
            $end_norm = $start_norm + $stat['WorkNorm'] * 3600 + $lunch_break;
            if ($start >= $start_norm && $start < $end_norm) {
                if ($end <= $end_norm) {
                    $stat['NormalHours'] += round(($end - $start - $lunch_break) / 3600, 2);
                } else {
                    $stat['NormalHours'] += round(($end_norm - $start - $lunch_break) / 3600, 2);
                    $start_night = strtotime($row['StartDate'] . ' 22:00:00');
                    if ($end < $start_night) {
                        $stat['SplHours'] += round(($end - $end_norm) / 3600, 2);
                    } else {
                        $stat['SplHours'] += round(($start_night - $end_norm) / 3600, 2);
                        $stat['NightHours'] += round(($end - $start_night) / 3600, 2);
                    }
                }
            } elseif ($start >= $end_norm) {
                $start_night = strtotime($row['StartDate'] . ' 22:00:00');
                if ($start < $start_night) {
                    if ($end < $start_night) {
                        $stat['SplHours'] += round(($end - $start) / 3600, 2);
                    } else {
                        $stat['SplHours'] += round(($start_night - $start) / 3600, 2);
                        $stat['NightHours'] += round(($end - $start_night) / 3600, 2);
                    }
                } else {
                    $end_night = strtotime($row['StartDate'] . ' 06:00:00') + 24 * 3600;
                    if ($end < $end_night) {
                        $stat['NightHours'] += round(($end - $start) / 3600, 2);
                    } else {
                        $stat['NightHours'] += round(($end_night - $start) / 3600, 2);
                        if ($end < $start_norm) {
                            $stat['SplHours'] += round(($end - $end_night) / 3600, 2);
                        } else {
                            $stat['SplHours'] += round(($start_norm - $end_night) / 3600, 2);
                            $stat['NormalHours'] += round(($end - $start_norm) / 3600, 2);
                        }
                    }
                }
            } elseif ($start < $start_norm) {
                $end_night = strtotime($row['StartDate'] . ' 06:00:00');
                if ($start > $end_night) {
                    $stat['SplHours'] += round(($start_norm - $start) / 3600, 2);
                } else {
                    $stat['SplHours'] += round(($start_norm - $end_night) / 3600, 2);
                    $stat['NightHours'] += round(($end_night - $start) / 3600, 2);
                }
                if ($end <= $end_norm) {
                    $stat['NormalHours'] += round(($end - $start_norm - $lunch_break) / 3600, 2);
                } else {
                    $stat['NormalHours'] += round(($end_norm - $start_norm - $lunch_break) / 3600, 2);
                    $start_night = strtotime($row['StartDate'] . ' 22:00:00');
                    if ($end < $start_night) {
                        $stat['SplHours'] += round(($end - $end_norm) / 3600, 2);
                    } else {
                        $stat['SplHours'] += round(($start_night - $end_norm) / 3600, 2);
                        $stat['NightHours'] += round(($end - $start_night) / 3600, 2);
                    }
                }
            }
        }

        $stat['CompletareNorma'] = $j * $stat['WorkNorm'] - $stat['NormalHours'];
        $stat['StudyHoursPay'] = 0; //cip
        $stat['StudyHoursNoPay'] = 0;
        $conn->query("SELECT Details, Type, DaysNo 
	              FROM   vacations_details 
		      WHERE  PersonID = $PersonID AND Aprove >= 0 AND 
		    	     ((StartDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR 
			      (StopDate BETWEEN '{$StartDate}' AND '{$EndDate}') OR
			      (StartDate <= '{$StartDate}' AND StopDate >= '{$StartDate}'))
		      GROUP  BY Type");
        while ($row = $conn->fetch_array()) {
            $stat['Days' . $row['Type']] += $row['DaysNo'];
            if (!strcmp($row['Details'], "Concediu de studiu fara plata"))
                $stat['StudyHoursNoPay'] += $row['DaysNo'];

            if (!strcmp($row['Details'], "Concediu de studiu cu plata"))
                $stat['StudyHoursPay'] += $row['DaysNo'];

        }

        $stat['StudyHoursPay'] *= $stat['WorkNorm'];
        $stat['StudyHoursNoPay'] *= $stat['WorkNorm'];

        return $stat;
    } //

    public static function getAllPersonsPlanif($action = '')
    {

        if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
            return array();
        }

        global $conn, $cal;

        $_GET['StartDate'] = Utils::toDBDate($_GET['StartDate']);
        $_GET['EndDate'] = Utils::toDBDate($_GET['EndDate']);

        $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

        $cal = array();

        $st_y = (int)substr($_GET['StartDate'], 0, 4);
        $st_m = (int)substr($_GET['StartDate'], 5, 2);
        $st_d = (int)substr($_GET['StartDate'], 8, 2);
        $i = 0;
        $j = 0;
        while (true) {
            $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
            $date = date('Y-m-d', $time);
            if ($date <= $_GET['EndDate']) {
                $cal[$date] = $calh[date('w', $time)];
                if ($cal[$date] != 'S' && $cal[$date] != 'D' && !isset(Utils::$msLegal[$date])) {
                    $j++;
                }
                $i++;
            } else {
                break;
            }
        }

        $cond = "";

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND h.DistrictID = " . (int)$_GET['DistrictID'];
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND g.CityID = " . (int)$_GET['CityID'];
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.CompanyID = " . (int)$_GET['CompanyID'];
        } elseif (!empty($_SESSION['USER_COMPANYSELF'])) {
            $cond .= " AND c.CompanyID IN (" . implode(',', $_SESSION['USER_COMPANYSELF']) . ")";
        }

        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND c.DepartmentID = " . (int)$_GET['DepartmentID'];
        }

        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND c.DivisionID = " . (int)$_GET['DivisionID'];
        }

        if (!empty($_GET['CostCenterID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT DISTINCT PersonID 
					    FROM   payroll_costcenter 
					    WHERE  CostCenterID = " . (int)$_GET['CostCenterID'] . "
					)";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR c.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][11][5]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][11][5]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(DISTINCT a.PersonID) AS total
                   FROM   persons a
		          INNER JOIN payroll c ON a.PersonID = c.PersonID AND c.StartDate != '0000-00-00' AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate > '{$_GET['StartDate']}')
                	  LEFT JOIN address e ON e.AddressID = a.AddressID
                          LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                          LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;
        $persons[0]['total'] = $row['total'];

        $query = "SELECT a.PersonID, a.FullName, c.StartDate, CASE WHEN c.StopDate != '0000-00-00' THEN c.StopDate ELSE '' END AS StopDate, 
	                 c.WorkNorm, b.StartDate AS PStartDate, b.EndDate AS PEndDate, b.Hours, b.Hours2
		  FROM   persons a
		         INNER JOIN payroll c ON a.PersonID = c.PersonID AND c.StartDate != '0000-00-00' AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate > '{$_GET['StartDate']}')
                	 LEFT JOIN address e ON e.AddressID = a.AddressID
                         LEFT JOIN address_city g ON g.CityID = e.CityID" . (!empty($_GET['CityID']) ? " AND g.CityID = " . (int)$_GET['CityID'] : "") . "
                         LEFT JOIN address_district h ON h.DistrictID = g.DistrictID" . (!empty($_GET['DistrictID']) ? " AND h.DistrictID = " . (int)$_GET['DistrictID'] : "") . "	 
			 LEFT JOIN pontaj_planif b ON a.PersonID = b.PersonID AND b.StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
		  WHERE  ($condbase) $cond
		  ORDER  BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']]['FullName'] = $row['FullName'];
            $persons[$row['PersonID']]['StartDate'] = $row['StartDate'];
            $persons[$row['PersonID']]['StopDate'] = $row['StopDate'];
            $persons[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];
            if (!empty($row['PStartDate'])) {
                @$persons[$row['PersonID']]['Data'][$row['PStartDate']] += (double)$row['Hours'];
                if ($row['PStartDate'] != $row['PEndDate']) {
                    @$persons[$row['PersonID']]['Data'][$row['PEndDate']] += (double)$row['Hours2'];
                }
            }
        }
        if ($persons[0]['total'] >= $res_per_page && (empty($action) || $action == 'print_page')) {
            $persons_slice = array_slice($persons, ($page - 1) * $res_per_page, $res_per_page, true);
            unset($persons);
            $persons = $persons_slice;
        }

        $query = "SELECT PersonID, StartDate, StopDate, Type 
	          FROM   vacations_details 
	          WHERE  ((StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		         (StopDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		         ('{$_GET['StartDate']}' BETWEEN StartDate AND StopDate)) AND Aprove >= 0
	          ORDER  BY StartDate";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $vacations[$row['PersonID']][] = $row;
        }

        foreach ($persons as $k => $v) {
            foreach ($cal as $date => $w) {
                if (isset($vacations[$k])) {
                    foreach ($vacations[$k] as $vac) {
                        if ($vac['StartDate'] <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D') {
                            if (isset($v['Data'][$date])) {
                                continue;
                            }
                            $persons[$k]['Data'][$date] = $vac['Type'];
                            break;
                        }
                    }
                }
            }
        }

        return $persons;
    }

    public static function getPersonPlanifActivities($PersonID, $StartDate)
    {

        global $conn, $smarty;

        $activities = array();

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][11][5][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][11][5]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		      '{$_SESSION['USER_RIGHTS2'][11][5]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $condrw = "('{$_SESSION['USER_RIGHTS2'][11][5]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	           OR
	           '{$_SESSION['USER_RIGHTS3'][11][5][1]}' = 2
		   OR
		   {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.FullName, b.WorkNorm, b.WorkStartHour, b.CompanyID,
	                     CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	              FROM   persons a
	                     INNER JOIN payroll b ON a.PersonID = b.PersonID
	              WHERE  a.PersonID = '{$PersonID}' AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $activities[0] = $row;
        } else {
            $params = array('label' => Message::$msMessagesRO['ACCESS_FORBIDDEN']);
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo smarty_function_translate($params, $smarty) . '!';
            exit;
        }

        $activities[0]['StartDate'] = $StartDate;
        $activities[0]['Status'] = 3;
        $activities[0]['THours'] = 0;

        $pontaj_planif_days = !empty($activities[0]['CompanyID']) && isset($_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_planif_days']) ? (int)$_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_planif_days'] : 0;
        $pontaj_validation_level = !empty($activities[0]['CompanyID']) && isset($_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_validation_level']) ? (int)$_SESSION['COMPANY_SETTINGS'][$activities[0]['CompanyID']]['pontaj_validation_level'] : 0;

        if ($_SESSION['USER_ID'] != 1) {
            $start_month_date = date('Y-m-01');
            $planif_end_date = date('Y-m-d', mktime(0, 0, 0, date('m'), $pontaj_planif_days, date('Y')));
            $curr_date = date('Y-m-d');
            if ($curr_date >= $start_month_date && $curr_date <= $planif_end_date) {
                $activities[0]['rw'] = 1;
            } else {
                $activities[0]['rw'] = 0;
            }
        }

        $conn->query("SELECT ID, StartDate, StartHour, EndDate, EndHour, CostCenterID, Type, Status, Notes,
	                     CASE WHEN StartDate = DATE_SUB('{$StartDate}', INTERVAL 1 DAY) AND EndDate = '{$StartDate}' THEN Hours2 ELSE Hours END AS Hours
	              FROM   pontaj_planif 
		      WHERE  PersonID = '{$PersonID}' AND 
		             (StartDate = '{$StartDate}' OR (StartDate = DATE_SUB('{$StartDate}', INTERVAL 1 DAY) AND EndDate = '{$StartDate}'))
		      ORDER  BY StartDate, StartHour");
        while ($row = $conn->fetch_array()) {
            $row['Notes'] = stripslashes($row['Notes']);
            $row['rw'] = $_SESSION['USER_ID'] == 1 ||
            ($pontaj_validation_level == 1 && $row['Status'] < 1) ||
            ($pontaj_validation_level == 2 && $row['Status'] < 2) ||
            ($pontaj_validation_level == 3 && $row['Status'] < 3) ||
            ($pontaj_validation_level == 4 && $row['Status'] < 4) ||
            ($pontaj_validation_level == 5 && $row['Status'] < 5) ||
            ($pontaj_validation_level == 6 && $row['Status'] < 6) ||
            ($pontaj_validation_level == 7 && $row['Status'] < 7) ? 1 : 0;
            $activities[0]['THours'] += $row['Hours'];
            if ($row['Status'] < $activities[0]['Status']) {
                $activities[0]['Status'] = $row['Status'];
            }
            $activities[$row['ID']] = $row;
        }

        return $activities;
    }

    public static function setPersonPlanifActivities($PersonID)
    {

        global $conn, $smarty, $err;

        switch ($_GET['action']) {

            case 'new':
            case 'edit':
                $StartDate = Utils::toDBDate($_GET['StartDate']);
                $EndDate = Utils::toDBDate($_GET['EndDate']);
                $start = strtotime($StartDate . ' ' . $_GET['StartHour'] . ':00');
                $end = strtotime($EndDate . ' ' . $_GET['EndHour'] . ':00');
                if ($StartDate != $EndDate) {
                    $hours = round((strtotime($StartDate . ' 23:59:59') - $start) / 3600, 2);
                    $hours2 = round(($end - strtotime($EndDate . ' 00:00:00')) / 3600, 2);
                } else {
                    $hours = round(($end - $start) / 3600, 2);
                    $hours2 = 0;
                }
                $ID = (int)$_GET['ID'];
                $conn->query("SELECT ID
	            	      FROM   pontaj_planif
		    	      WHERE  PersonID = $PersonID AND " . ($ID > 0 ? "ID != $ID AND " : "") . "
		              (
			        (CONCAT(StartDate, ' ', StartHour, ':00') >= '{$StartDate} {$_GET['StartHour']}:00' AND CONCAT(StartDate, ' ', StartHour, ':00') < '{$EndDate} {$_GET['EndHour']}:00') OR
			        (CONCAT(EndDate, ' ', EndHour, ':00') > '{$StartDate} {$_GET['StartHour']}:00' AND CONCAT(EndDate, ' ', EndHour, ':00') <= '{$EndDate} {$_GET['EndHour']}:00') OR
				('{$StartDate} {$_GET['StartHour']}:00' >= CONCAT(StartDate, ' ', StartHour, ':00') AND '{$StartDate} {$_GET['StartHour']}:00' < CONCAT(EndDate, ' ', EndHour, ':00'))
			      )");
                if ($row = $conn->fetch_array()) {
                    require_once $smarty->_get_plugin_filepath('function', 'translate');
                    $err->setError(smarty_function_translate(array('label' => 'Activitatea se suprapune peste o activitate existenta'), $smarty));
                    $_GET['StartDate'] = Utils::toDBDate($_GET['StartDate']);
                    return;
                }
                $conn->query("SELECT LunchBreakStartHour, LunchBreakEndHour FROM payroll WHERE PersonID = $PersonID");
                if ($row = $conn->fetch_array()) {
                    if (!empty($row['LunchBreakStartHour']) && !empty($row['LunchBreakEndHour'])) {
                        $lunch_break_start = strtotime($StartDate . ' ' . $row['LunchBreakStartHour'] . ':00');
                        $lunch_break_end = strtotime($StartDate . ' ' . $row['LunchBreakEndHour'] . ':00');
                        if ($lunch_break_start > $start && $lunch_break_end < $end) {
                            $hours = round($hours - ($lunch_break_end - $lunch_break_start) / 3600, 2);
                        }
                    }
                }
                if ($ID > 0) {
                    $conn->query("UPDATE pontaj_planif SET
							    StartDate 	 	= '$StartDate',
							    StartHour 	 	= '{$_GET['StartHour']}',
							    EndDate   	 	= '$EndDate',
							    EndHour   	 	= '{$_GET['EndHour']}',
							    Hours     	 	= '$hours',
							    Hours2    	 	= '$hours2',
							    CostCenterID 	= '{$_GET['CostCenterID']}',
							    Type         	= '{$_GET['Type']}',
							    LastUpdateDate 	= CURRENT_TIMESTAMP
		                  WHERE  PersonID = $PersonID AND ID = $ID");
                } else {
                    $conn->query("INSERT INTO pontaj_planif(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, CreateDate, LastUpdateDate)
                                                     VALUES('{$_SESSION['USER_ID']}', $PersonID, '$StartDate', '{$_GET['StartHour']}', '$EndDate', '{$_GET['EndHour']}', '$hours', '$hours2',
		                                            '{$_GET['CostCenterID']}', '{$_GET['Type']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                }
                header('Location: ./?m=pontaj&o=pplanif_act&PersonID=' . $PersonID . '&StartDate=' . Utils::toDBDate($_GET['StartDate']));
                exit;

                break;

            case 'set_notes':

                $conn->query("UPDATE pontaj_planif SET Notes = '" . Utils::formatStr($_GET['Notes']) . "' WHERE PersonID = $PersonID AND StartDate = '{$_GET['StartDate']}'");
                header('Location: ./?m=pontaj&o=pplanif_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'del':

                $ID = (int)$_GET['ID'];
                $conn->query("DELETE FROM pontaj_planif WHERE PersonID = $PersonID AND ID = $ID");
                header('Location: ./?m=pontaj&o=pplanif_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'accept':
            case 'accept_all':

                $Status = (int)$_GET['Status'];

                if ($_GET['action'] == 'accept_all') {
                    $conn->query("UPDATE pontaj_planif SET Status = $Status WHERE PersonID = $PersonID AND StartDate = '{$_GET['StartDate']}' AND Status = " . ($Status - 1));
                } else {
                    $ID = (int)$_GET['ID'];
                    $conn->query("UPDATE pontaj_planif SET Status = $Status WHERE PersonID = $PersonID AND ID = $ID");
                }
                if ($Status < 7) {
                    switch ($Status) {
                        case 1:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 22 AND Active = 1";
                            $query2 = "SELECT FullName, Email FROM persons WHERE PersonID = (SELECT DirectManagerID FROM payroll WHERE PersonID = $PersonID)";
                            break;
                        case 2:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 23 AND Active = 1";
                            break;
                        case 3:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 25 AND Active = 1";
                            break;
                        case 4:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 26 AND Active = 1";
                            break;
                        case 5:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 27 AND Active = 1";
                            break;
                        case 6:
                            $query = "SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 28 AND Active = 1";
                            break;
                    }
                    $conn->query($query);
                    if ($row = $conn->fetch_array()) {
                        $headers = "From: \"{$row['FromAlias']}\" <{$row['FromEmail']}>";
                        $conn->query("SELECT FullName FROM persons WHERE PersonID = $PersonID");
                        if ($row2 = $conn->fetch_array()) {
                            $message = str_replace(array('<<FullName>>', '<<StartDate>>'), array($row2['FullName'], Utils::toDBDate($_GET['StartDate'])), $row['Body']);
                        }
                        if ($Status > 1) {
                            $Settings = !empty($row['Settings']) ? unserialize($row['Settings']) : array();
                            if (!empty($Settings['roles'])) {
                                $roles = array();
                                foreach ($Settings['roles'] as $RoleID => $v) {
                                    if ($v == 1) {
                                        $roles[] = $RoleID;
                                    }
                                }
                                if (!empty($roles)) {
                                    $query2 = "SELECT FullName, Email FROM persons WHERE RoleID IN (" . implode(',', $roles) . ")";
                                }
                            }
                        }
                        if (!empty($query2)) {
                            $conn->query($query2);
                            while ($row2 = $conn->fetch_array()) {
                                @mail("\"{$row2['FullName']}\" <{$row2['Email']}>", $row['Subject'], $message, $headers);
                            }
                        }
                    }
                }
                header('Location: ./?m=pontaj&o=pplanif_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;

            case 'del':

                $ID = (int)$_GET['ID'];
                $conn->query("DELETE FROM pontaj_planif WHERE PersonID = $PersonID AND ID = $ID");
                header('Location: ./?m=pontaj&o=pplanif_act&PersonID=' . $PersonID . '&StartDate=' . $_GET['StartDate']);
                exit;

                break;
        }

    }

    public static function getMonthlyAdjustments()
    {
        $PersonID = (int)$_GET['PersonID'];

        global $conn;
        $adjustments = array();
        $conn->query("SELECT * FROM pontaj_monthly WHERE Type IN(2,3) AND PersonID = '$PersonID' ORDER BY Month DESC");
        while ($row = $conn->fetch_array()) {
            $row['Year'] = date('Y', strtotime($row['Month']));
            $row['MonthVal'] = date('m', strtotime($row['Month']));
            $adjustments[] = $row;
        }
        return $adjustments;
    }

    public static function setMonthlyAdjustments()
    {
        $PersonID = (int)$_GET['PersonID'];

        global $conn;

        switch ($_GET['action']) {
            case 'new_monthly_adjustment':
                $month = date('Y-m-d', strtotime($_GET['Year'] . "-" . $_GET['Month'] . "-01"));
                $value = (double)$_GET['Value'];
                $type = (int)$_GET['Type'];

                $conn->query("INSERT INTO pontaj_monthly(Month, PersonID, Type, Value, CreateDate)
                                VALUES('{$month}', '{$PersonID}', '{$type}', '{$value}', CURRENT_TIMESTAMP)");

//            header('Location: '.Config::SRV_URL.'cron/pontaj_month.php?Year='.(int)$_GET['Year'].'&Month='.(int)$_GET['Month'].'&PersonID='.$PersonID.'&do_straight=1&back_to=payroll');exit;

                break;
            case 'edit_monthly_adjustment':
                $adjustment_id = (int)$_GET['AdjustmentID'];
                $month = date('Y-m-d', strtotime($_GET['Year'] . "-" . $_GET['Month'] . "-01"));
                $value = (double)$_GET['Value'];
                $type = (int)$_GET['Type'];

//                $conn->query("SELECT * FROM pontaj_monthly WHERE ID = '{$adjustment_id}'");
//                
//                $orig = $conn->fetch_array();
//                $year = date('Y', strtotime($orig['Month']));
//                $mth = date('n', strtotime($orig['Month']));

                $conn->query("UPDATE pontaj_monthly SET
                                    Month = '{$month}',
                                    Type = '{$type}',
                                    Value = '{$value}'
                                WHERE ID = '{$adjustment_id}'");

//               $_GET['Year'] = $year;
//               $_GET['Month'] = $month;
//               $_GET['PersonID'] = $PersonID;
//               $_GET['do_straight'] = 1;
//               $_GET['back_to'] = 'payroll';
//               $_GET['skip_load'] = 1;
//               
//               require('./cron/pontaj_month.php');
//               
//               $_GET['Year'] = date('Y', strtotime($month));
//               $_GET['Month'] = date('n', strtotime($month));
//               
//               require('./cron/pontaj_month.php');

//            header('Location: '.Config::SRV_URL.'cron/pontaj_month.php?Year='.$year.'&Month='.$mth.'&PersonID='.$PersonID.'&do_straight=1&back_to=payroll');exit;
                break;
            case 'del_monthly_adjustment':
                $adjustment_id = (int)$_GET['AdjustmentID'];
//                $conn->query("SELECT * FROM pontaj_monthly WHERE ID = '{$adjustment_id}'");

//                $orig = $conn->fetch_array();
//                $year = date('Y', strtotime($orig['Month']));
//                $mth = date('n', strtotime($orig['Month']));

                $conn->query("DELETE FROM pontaj_monthly WHERE ID = '{$adjustment_id}'");

//                header('Location: '.Config::SRV_URL.'cron/pontaj_month.php?Year='.$year.'&Month='.$mth.'&PersonID='.$PersonID.'&do_straight=1&back_to=payroll');exit;
                break;
        }
    }

}

?>