<?php

class PontajReports
{

    public static function getReports()
    {

        global $conn;

        $reports = array();

        $conn->query("SELECT ReportID, Report FROM reports WHERE ModuleID = 11 ORDER BY ReportID");
        $i = 0;
        while ($row = $conn->fetch_array()) {
            $i++;
            if ($_SESSION['USER_ID'] == 1 || in_array($row['ReportID'], $_SESSION['REPORT_RIGHTS'][11])) {
                $reports[$i] = $row['Report'];
            }
        }
        asort($reports);

        return $reports;
    }

    public static function getReport($report_id)
    {

        global $conn;

        if (!empty($_GET['StartDate']) || !empty($_GET['EndDate'])) {
            $_GET['StartDate'] = substr($_GET['StartDate'], 6) . '-' . substr($_GET['StartDate'], 3, 2) . '-' . substr($_GET['StartDate'], 0, 2);
            $_GET['EndDate'] = substr($_GET['EndDate'], 6) . '-' . substr($_GET['EndDate'], 3, 2) . '-' . substr($_GET['EndDate'], 0, 2);
        }

        $report = array();

        switch ($report_id) {

            case 1:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $fields = array(
                    'Name' => 'b.Name',
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'FullName' => 'd.FullName',
                    'THours' => 'a.THours',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Name';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Name, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate,
		                 d.FullName 
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          INNER JOIN persons d ON a.PersonID = d.PersonID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Name'] = stripslashes($row['Name']);
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 2:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate']) || empty($_GET['PersonID'])) {
                    return $report;
                }

                $fields = array(
                    'Name' => 'b.Name',
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'THours' => 'a.THours',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Name';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Name, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND PersonID = '{$_GET['PersonID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Name'] = stripslashes($row['Name']);
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 3:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate']) || empty($_GET['ProjectID'])) {
                    return $report;
                }

                $fields = array(
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'FullName' => 'd.FullName',
                    'THours' => 'a.THours',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Code';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate,
		                 d.FullName 
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND ProjectID = '{$_GET['ProjectID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          INNER JOIN persons d ON a.PersonID = d.PersonID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 4:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate']) || empty($_GET['ProjectID']) || empty($_GET['PersonID'])) {
                    return $report;
                }

                $fields = array(
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'THours' => 'a.THours',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Code';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND 
		        	           ProjectID = '{$_GET['ProjectID']}' AND PersonID = '{$_GET['PersonID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 5:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate']) || empty($_GET['ProjectID'])) {
                    return $report;
                }

                $fields = array(
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'FullName' => 'd.FullName',
                    'THours' => 'a.THours',
                    'Cost' => 'Cost',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Code';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate,
		                 d.FullName,
		                 (SELECT Salary FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= c.StartDate ORDER BY StartDate DESC LIMIT 1) AS Cost
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND ProjectID = '{$_GET['ProjectID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          INNER JOIN persons d ON a.PersonID = d.PersonID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 6:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate']) || empty($_GET['ProjectID']) || empty($_GET['PersonID'])) {
                    return $report;
                }

                $fields = array(
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'THours' => 'a.THours',
                    'Cost' => 'Cost',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Code';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $lstPhases = Project::getPhases(false);

                $query = "SELECT a.*, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate,
		                 (SELECT Salary FROM persons_salary WHERE PersonID = a.PersonID AND StartDate <= c.StartDate ORDER BY StartDate DESC LIMIT 1) AS Cost
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND 
		        	           ProjectID = '{$_GET['ProjectID']}' AND PersonID = '{$_GET['PersonID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = $lstPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 7:

                $query = "SELECT ProjectID, Code, ContractNo, ContractDate,
		                 (SELECT MIN(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Min,
				 (SELECT MAX(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Max,
				 0 AS THours, 0 AS TCost
		          FROM   pontaj_projects a
			  ORDER  BY Code";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!empty($row['Data_Min'])) {
                        $row['Data_Min'] = Utils::toDBDate($row['Data_Min']);
                        $row['Data_Max'] = Utils::toDBDate($row['Data_Max']);
                        $report[$row['ProjectID']] = $row;
                    }
                }

                if (!empty($report)) {
                    $roles = Pontaj::getPontajRoles();
                    $query = "SELECT a.ProjectID, b.RoleID, SUM(a.Hours) AS THours
		              FROM   pontaj a
			             INNER JOIN pontaj_activity_roles b ON a.ActivityID = b.ActivityID
			      WHERE  a.ProjectID IN (" . implode(',', array_keys($report)) . ")
			      GROUP  BY a.ProjectID, b.RoleID";
                    $conn->query($query);
                    while ($row = $conn->fetch_array()) {
                        $report[$row['ProjectID']]['Role'][$row['RoleID']]['Name'] = $roles[$row['RoleID']];
                        $report[$row['ProjectID']]['Role'][$row['RoleID']]['THours'] = $row['THours'];
                        $report[$row['ProjectID']]['THours'] += $row['THours'];
                    }
                }

                break;

            case 8:

                $query = "SELECT ProjectID, Code, ContractNo, ContractDate,
		                 (SELECT MIN(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Min,
				 (SELECT MAX(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Max,
				 0 AS THours, 0 AS TCost
		          FROM   pontaj_projects a
			  ORDER  BY Code";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!empty($row['Data_Min'])) {
                        $row['Data_Min'] = Utils::toDBDate($row['Data_Min']);
                        $row['Data_Max'] = Utils::toDBDate($row['Data_Max']);
                        $report[$row['ProjectID']] = $row;
                    }
                }

                if (!empty($report)) {
                    $query = "SELECT a.ProjectID, b.PersonID, b.FullName, SUM(a.Hours) AS THours
		              FROM   pontaj a
			             INNER JOIN persons b ON a.PersonID = b.PersonID
			      WHERE  a.ProjectID IN (" . implode(',', array_keys($report)) . ")
			      GROUP  BY a.ProjectID, b.PersonID";
                    $conn->query($query);
                    while ($row = $conn->fetch_array()) {
                        $report[$row['ProjectID']]['Person'][$row['PersonID']]['FullName'] = $row['FullName'];
                        $report[$row['ProjectID']]['Person'][$row['PersonID']]['THours'] = $row['THours'];
                        $report[$row['ProjectID']]['THours'] += $row['THours'];
                    }
                }

                break;

            case 9:

                $query = "SELECT ProjectID, Code, ContractNo, ContractDate,
		                 (SELECT MIN(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Min,
				 (SELECT MAX(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Max,
				 0 AS THours, 0 AS TCost
		          FROM   pontaj_projects a
			  ORDER  BY Code";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!empty($row['Data_Min'])) {
                        $row['Data_Min'] = Utils::toDBDate($row['Data_Min']);
                        $row['Data_Max'] = Utils::toDBDate($row['Data_Max']);
                        $report[$row['ProjectID']] = $row;
                    }
                }

                if (!empty($report)) {
                    $query = "SELECT a.ProjectID, b.Phase, c.Activity, SUM(a.Hours) AS THours
		              FROM   pontaj a
			    	     INNER JOIN pontaj_phases b ON a.PhaseID = b.PhaseID
			             INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
			      WHERE  a.ProjectID IN (" . implode(',', array_keys($report)) . ")
			      GROUP  BY a.ProjectID, b.Phase, c.Activity";
                    $conn->query($query);
                    while ($row = $conn->fetch_array()) {
                        $report[$row['ProjectID']]['Phase'][$row['Phase']]['Activity'][$row['Activity']]['THours'] = $row['THours'];
                        $report[$row['ProjectID']]['THours'] += $row['THours'];
                    }
                }

                break;

            case 10:

                $query = "SELECT ProjectID, Code, ContractNo, ContractDate,
		                 (SELECT MIN(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Min,
				 (SELECT MAX(Data) FROM pontaj WHERE ProjectID = a.ProjectID) AS Data_Max,
				 0 AS THours, 0 AS TCost
		          FROM   pontaj_projects a
			  ORDER  BY Code";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!empty($row['Data_Min'])) {
                        $row['Data_Min'] = Utils::toDBDate($row['Data_Min']);
                        $row['Data_Max'] = Utils::toDBDate($row['Data_Max']);
                        $report[$row['ProjectID']] = $row;
                    }
                }

                if (!empty($report)) {
                    $query = "SELECT a.ProjectID, b.Activity, c.Phase, SUM(a.Hours) AS THours
		              FROM   pontaj a
			             INNER JOIN pontaj_project_activities b ON a.ActivityID = b.ActivityID
				     INNER JOIN pontaj_phases c ON a.PhaseID = c.PhaseID
			      WHERE  a.ProjectID IN (" . implode(',', array_keys($report)) . ")
			      GROUP  BY a.ProjectID, b.Activity";
                    $conn->query($query);
                    while ($row = $conn->fetch_array()) {
                        $report[$row['ProjectID']]['Activity'][$row['Activity']]['Phase'] = $row['Phase'];
                        $report[$row['ProjectID']]['Activity'][$row['Activity']]['THours'] = $row['THours'];
                        $report[$row['ProjectID']]['THours'] += $row['THours'];
                    }
                }

                break;

            case 11:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $roles = Pontaj::getPontajRoles();
                $query = "SELECT b.RoleID, SUM(a.Hours) AS THours
		          FROM   pontaj a
			         INNER JOIN pontaj_activity_roles b ON a.ActivityID = b.ActivityID
			  WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'				 
			  GROUP  BY b.RoleID
			  ORDER  BY THours DESC";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $report[$row['RoleID']]['Role'] = $roles[$row['RoleID']];
                    $report[$row['RoleID']]['THours'] = $row['THours'];
                }

                break;

            case 12:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $query = "SELECT a.PersonID, b.FullName, SUM(a.Hours) AS THours,
		                 SUM(CASE WHEN a.ActivityID = 467 THEN a.Hours ELSE 0 END) AS THoursFA
		          FROM   pontaj a
			         INNER JOIN persons b ON a.PersonID = b.PersonID
			  WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'				 
			  GROUP  BY a.PersonID
			  ORDER  BY b.FullName";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $report[$row['PersonID']]['FullName'] = $row['FullName'];
                    $report[$row['PersonID']]['THours'] = $row['THours'] >= $row['THoursFA'] ? $row['THours'] - $row['THoursFA'] : 0;
                    $report[$row['PersonID']]['THoursFA'] = $row['THoursFA'];
                }

                break;

            case 13:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $fields = array(
                    'FullName' => 'FullName',
                    'Data' => 'Data',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'FullName';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $query = "SELECT a.FullName, DATE_FORMAT(b.Data, '%d.%m.%Y') AS FData, 
		                 CASE WHEN b.THours IS NOT NULL THEN b.THours ELSE 0 END AS THours
		          FROM   persons a
			         LEFT JOIN (
						SELECT PersonID, Data, SUM(Hours) AS THours
						FROM   pontaj
						WHERE  Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
						GROUP  BY PersonID, Data 
					    ) b ON a.PersonID = b.PersonID
			  WHERE  RoleID IN (
						SELECT RoleID 
						FROM   pontaj_activity_roles
						WHERE  ActivityID IN (
									SELECT ActivityID
									FROM   pontaj_project_activities
								    )
					   )
			  ORDER  BY $orderby $asc_desc" . ($orderby == 'FullName' ? ', Data' : ', FullName');
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $report[] = $row;
                }

                break;

            case 14:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $fields = array(
                    'FullName' => 'FullName',
                    // 'Data'     => 'Data',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'FullName';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $query = "SELECT FullName
		          FROM   persons
			  WHERE  RoleID IN (
						SELECT RoleID 
						FROM   pontaj_activity_roles
						WHERE  ActivityID IN (
									SELECT ActivityID
									FROM   pontaj_project_activities
								    )
					   ) AND
				 PersonID NOT IN (SELECT DISTINCT PersonID FROM pontaj)	   
			  ORDER  BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $report[] = $row;
                }

                break;

            case 15:

                $fields = array(
                    'FullName' => 'FullName',
                    'Data' => 'Data',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'FullName';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $roles = Pontaj::getPontajRoles();
                $query = "SELECT a.FullName, a.RoleID, DATE_FORMAT(b.Data, '%d.%m.%Y') AS FData, DATE_FORMAT(b.Data, '%m/%d/%Y') AS FData2, 
		                 c.Code, c.ContractNo, c.ContractDate, c.Name, 
				 b.PhaseID, b.Hours, d.Activity, e.Phase
		          FROM   persons a
			         INNER JOIN pontaj b ON a.PersonID = b.PersonID
				 INNER JOIN pontaj_projects c ON b.ProjectID = c.ProjectID
				 INNER JOIN pontaj_project_activities d ON b.ActivityID = d.ActivityID
				 INNER JOIN pontaj_phases e ON b.PhaseID = e.PhaseID
			  ORDER  BY $orderby $asc_desc" . ($orderby == 'FullName' ? ', Data' : ', FullName');
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Role'] = $roles[$row['RoleID']];
                    $report[] = $row;
                }

                break;

            case 16:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $Status = !empty($_GET['Status']) ? (int)$_GET['Status'] : 0;

                global $cal;

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
                if ($_SESSION['USER_ID'] == 1) {
                    $query = "SELECT a.PersonID, a.FullName, c.StartDate, CASE WHEN c.StopDate != '0000-00-00' THEN c.StopDate ELSE '' END AS StopDate, c.WorkNorm,
		                     b.Data, Hours_Norm, Hours_Spl, Hours_SplW, Hours_Night, Hours_Inv, Hours_X, Hours_CO, Hours_CE, Hours_CFS, Hours_CIC, Hours_CM, Hours_Abs, Hours_T, Hours_P, Hours_LP
		              FROM   persons a
			             INNER JOIN payroll c ON a.PersonID = c.PersonID " . (!empty($_GET['DivisionID']) ? " AND c.DivisionID = '{$_GET['DivisionID']}'" : "") . " AND c.WorkNorm > 0 AND c.StartDate != '0000-00-00' AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate > '{$_GET['StartDate']}' OR c.StopDate IS NULL OR c.StopDate = '')
			             LEFT JOIN pontaj_simple b ON a.PersonID = b.PersonID AND b.Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
			      WHERE  " . ($Status > 0 ? "a.Status = '{$_GET['Status']}'" : "a.Status IN (2,5,6)") . "
			      ORDER  BY a.FullName";
                } else {
                    $query = "SELECT a.PersonID, a.FullName, c.StartDate, CASE WHEN c.StopDate != '0000-00-00' THEN c.StopDate ELSE '' END AS StopDate, c.WorkNorm,
		                     b.Data, Hours_Norm, Hours_Spl, Hours_SplW, Hours_Night, Hours_Inv, Hours_X, Hours_CO, Hours_CE, Hours_CFS, Hours_CIC, Hours_CM, Hours_Abs, Hours_T, Hours_P, Hours_LP
		              FROM   persons a
		                     INNER JOIN payroll c ON a.PersonID = c.PersonID AND c.WorkNorm > 0 AND c.StartDate != '0000-00-00' AND c.StartDate <= '{$_GET['EndDate']}' AND (c.StopDate = '0000-00-00' OR c.StopDate > '{$_GET['StartDate']}' OR c.StopDate IS NULL OR c.StopDate = '')
			             LEFT JOIN pontaj_simple b ON a.PersonID = b.PersonID AND b.Data BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
			      WHERE  a.UserID = {$_SESSION['USER_ID']} " . ($Status > 0 ? " AND a.Status = '{$_GET['Status']}'" : " AND a.Status IN (2,5,6)") . "
			      ORDER  BY a.FullName";
                }
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $report[$row['PersonID']]['FullName'] = $row['FullName'];
                    $report[$row['PersonID']]['StartDate'] = $row['StartDate'];
                    $report[$row['PersonID']]['StopDate'] = $row['StopDate'];
                    $report[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];
                    if (!empty($row['Data'])) {
                        $report[$row['PersonID']]['Data'][$row['Data']] = $row;
                    }
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

                foreach ($report as $k => $v) {
                    foreach ($cal as $date => $w) {
                        if (isset(Utils::$msLegal[$date]) && !isset($report[$k]['Data'][$date]['Hours_Norm'])) {
                            $report[$k]['Data'][$date]['Hours_Norm'] = 0;
                        }
                        if ($v['StartDate'] > $date) {
                            $report[$k]['Data'][$date]['Hours_Norm'] = 0;
                        }
                        if (!empty($v['StopDate']) && $v['StopDate'] <= $date) {
                            $report[$k]['Data'][$date]['Hours_Norm'] = 0;
                        }
                        if (isset($vacations[$k])) {
                            foreach ($vacations[$k] as $vac) {
                                if ($vac['StartDate'] <= $date && $date <= $vac['StopDate'] && $w != 'S' && $w != 'D' && !isset(ConfigData::$msLegal[$date])) {
                                    if (isset($v['Data'][$date]) && $v['Data'][$date]['Hours_CO'] + $v['Data'][$date]['Hours_CE'] + $v['Data'][$date]['Hours_CFS'] + $v['Data'][$date]['Hours_CIC'] + $v['Data'][$date]['Hours_CM'] == 0) {
                                        continue;
                                    }
                                    $report[$k]['Data'][$date]['Hours_Norm'] = 0;
                                    $report[$k]['Data'][$date]['Nelucr'] = $vac['Type'];
                                    @$report[$k]['TNelucr'] += 1;
                                    @$report[$k]['T' . $vac['Type']] += 1;
                                    break;
                                }
                            }
                        }
                        $report[$k]['Data'][$date]['Hours_Norm'] = isset($report[$k]['Data'][$date]) ? $report[$k]['Data'][$date]['Hours_Norm'] : ($v['StartDate'] > $date || $w == 'S' || $w == 'D' ? 0 : $v['WorkNorm']);
                        @$report[$k]['TNorm'] += $report[$k]['Data'][$date]['Hours_Norm'];
                        @$report[$k]['TNight'] += $report[$k]['Data'][$date]['Hours_Night'];
                        @$report[$k]['TSpl'] += (int)$v['Data'][$date]['Hours_Spl'];
                        @$report[$k]['TSplW'] += (int)$v['Data'][$date]['Hours_SplW'];
                        @$report[$k]['TX'] += (int)$v['Data'][$date]['Hours_X'];
                        @$report[$k]['TAbs'] += (int)$v['Data'][$date]['Hours_Abs'];
                        @$report[$k]['TInv'] += (int)$v['Data'][$date]['Hours_Inv'];
                        @$report[$k]['TT'] += (int)$v['Data'][$date]['Hours_T'];
                        @$report[$k]['TNelucr'] += (int)$v['Data'][$date]['Hours_X'] + (int)$v['Data'][$date]['Hours_Abs'] + (int)$v['Data'][$date]['Hours_Inv'] + (int)$v['Data'][$date]['Hours_T'] + (int)$v['Data'][$date]['Hours_P'] + (int)$v['Data'][$date]['Hours_LP'];
                    }
                    $report[$k]['TNorm'] += $report[$k]['TNight'];
                    $nsw = $report[$k]['TNorm'] + $report[$k]['TSpl'] + $report[$k]['TSplW'];
                    if ($k == 260) {
                    }
                    $report[$k]['TONorm'] = $nsw <= $v['WorkNorm'] * ($j - (int)$report[$k]['TNelucr']) ? $nsw : $v['WorkNorm'] * ($j - (int)$report[$k]['TNelucr']);
                    $report[$k]['SPL'] = $nsw - $report[$k]['TONorm'];
                    $report[$k]['MaxNorm'] = ($j - (int)$report[$k]['TNelucr']) * $v['WorkNorm'];
                    $report[$k]['MaxSPL'] = round((32 * ($j - (int)$report[$k]['TNelucr']) / $j / $v['WorkNorm']) * $v['WorkNorm'], 0);
                    $report[$k]['MaxNight'] = $report[$k]['MaxNorm'];
                }

                break;

            case 17:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                global $cal;

                $Status = !empty($_GET['Status']) ? (int)$_GET['Status'] : 0;

                $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

                $cal = array();

                $st_y = (int)substr($_GET['StartDate'], 0, 4);
                $st_m = (int)substr($_GET['StartDate'], 5, 2);
                $st_d = (int)substr($_GET['StartDate'], 8, 2);
                $i = 0;
                while (true) {
                    $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
                    $date = date('Y-m-d', $time);
                    if ($date <= $_GET['EndDate']) {
                        $cal[$date] = $calh[date('w', $time)];
                        $i++;
                    } else {
                        break;
                    }
                }

                $persons = array();
                $query = "SELECT PersonID, FullName 
		            FROM   persons 
			    WHERE  " . ($Status > 0 ? "Status = '{$_GET['Status']}'" : "Status IN (2,7)") . "
			    ORDER  BY FullName";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $persons[$row['PersonID']]['FullName'] = $row['FullName'];
                }

                $query = "SELECT PersonID, StartDate, EndDate, Hours, Hours2
			  FROM   pontaj_detail
			  WHERE  StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!isset($persons[$row['PersonID']])) continue;
                    $persons[$row['PersonID']][$row['StartDate']]['D'] = 0;
                    $persons[$row['PersonID']][$row['EndDate']]['D'] = 0;
                    if (!empty($row['StartDate'])) {
                        @$persons[$row['PersonID']][$row['StartDate']]['D'] += (double)$row['Hours'];
                        if ($row['StartDate'] != $row['EndDate']) {
                            @$persons[$row['PersonID']][$row['EndDate']]['D'] += (double)$row['Hours2'];
                        }
                    }
                }

                $query = "SELECT PersonID, StartDate, EndDate, Hours, Hours2
			  FROM   pontaj_planif
			  WHERE  StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    if (!isset($persons[$row['PersonID']])) continue;
                    $persons[$row['PersonID']][$row['StartDate']]['P'] = 0;
                    $persons[$row['PersonID']][$row['EndDate']]['P'] = 0;
                    if (!empty($row['StartDate'])) {
                        @$persons[$row['PersonID']][$row['StartDate']]['P'] += (double)$row['Hours'];
                        if ($row['StartDate'] != $row['EndDate']) {
                            @$persons[$row['PersonID']][$row['EndDate']]['P'] += (double)$row['Hours2'];
                        }
                    }
                }

                return $persons;

                break;

            case 18:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                global $cal;

                $Status = !empty($_GET['Status']) ? (int)$_GET['Status'] : 0;

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

                $query = "SELECT a.PersonID, a.FullName,
	                         c.WorkNorm, b.StartDate AS PStartDate, b.EndDate AS PEndDate, b.Hours, b.Hours2
		          FROM   persons a
		    	         INNER JOIN payroll c ON a.PersonID = c.PersonID" . (!empty($_GET['DivisionID']) ? " AND c.DivisionID = '{$_GET['DivisionID']}'" : "") . "
			         LEFT JOIN pontaj_detail b ON a.PersonID = b.PersonID AND b.StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
			  WHERE  " . ($Status > 0 ? "a.Status = '{$_GET['Status']}'" : "a.Status IN (2,7)") . "
			  ORDER  BY a.FullName";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $persons[$row['PersonID']]['FullName'] = $row['FullName'];
                    $persons[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];
                    if (!empty($row['PStartDate'])) {
                        @$persons[$row['PersonID']]['Data'][$row['PStartDate']] += (double)$row['Hours'];
                        if ($row['PStartDate'] != $row['PEndDate']) {
                            @$persons[$row['PersonID']]['Data'][$row['PEndDate']] += (double)$row['Hours2'];
                        }
                    }
                    $persons[$row['PersonID']]['Total'] += (double)$row['Hours'];
                }

                $query = "SELECT PersonID, StartDate, StopDate, Type, Details 
	        	  FROM   vacations_details 
	                  WHERE  ((StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		                 (StopDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}') OR
		                 ('{$_GET['StartDate']}' BETWEEN StartDate AND StopDate)) AND Aprove >= 0
	                 ORDER  BY StartDate";
                $conn->query($query);
                $persons[$row['PersonID']]['zCSS'] = 0;
                $persons[$row['PersonID']]['zCSFS'] = 0;
                $persons[$row['PersonID']]['TotalPlatite'] = 0;
                while ($row = $conn->fetch_array()) {
                    $vacations[$row['PersonID']][] = $row;
                    if (!strcmp($row['Details'], "Concediu de studiu cu plata"))
                        $persons[$row['PersonID']]['zCSS']++;
                    if (!strcmp($row['Details'], "Concediu de studiu fara plata"))
                        $persons[$row['PersonID']]['zCSFS']++;
                }
                $persons[$row['PersonID']]['TotalPlatite'] = $persons[$row['PersonID']]['Total'] + $persons[$row['PersonID']]['zCSS'];

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

                break;

            case 19:

                global $cal, $dmanagers;

                $dmanagers = array();
                $query = "SELECT a.PersonID, a.FullName
		              FROM   persons a
			             INNER JOIN payroll b ON a.PersonID = b.DirectManagerID
		              ORDER  BY a.FullName";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $dmanagers[$row['PersonID']] = $row['FullName'];
                }

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                $calh = array(0 => 'D', 1 => 'L', 2 => 'M', 3 => 'M', 4 => 'J', 5 => 'V', 6 => 'S');

                $cal = array();

                $st_y = (int)substr($_GET['StartDate'], 0, 4);
                $st_m = (int)substr($_GET['StartDate'], 5, 2);
                $st_d = (int)substr($_GET['StartDate'], 8, 2);
                $i = 0;
                while (true) {
                    $time = mktime(0, 0, 0, $st_m, $st_d + $i, $st_y);
                    $date = date('Y-m-d', $time);
                    if ($date <= $_GET['EndDate']) {
                        $cal[$date] = $calh[date('w', $time)];
                        $i++;
                    } else {
                        break;
                    }
                }

                $persons = array();
                $query = "SELECT DISTINCT a.PersonID, a.StartDate, c.FullName
			  FROM   pontaj_detail a
			         INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.DirectManagerID = '{$_GET['DirectManagerID']}'
				 inner JOIN persons c ON a.PersonID = c.PersonID
			  WHERE  a.StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}' AND a.Status = 1";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $persons[$row['PersonID']]['FullName'] = $row['FullName'];
                    $persons[$row['PersonID']]['StartDate'] = $row['StartDate'];
                }

                return $persons;

                break;

            case 20:

                if (empty($_GET['Year']) || empty($_GET['Month']) || empty($_GET['ProjectID']) || empty($_GET['PersonID'])) {
                    return $report;
                }

                $fields = array(
                    'Code' => 'b.Code',
                    'Phase' => 'b.Phase',
                    'Activity' => 'c.Activity',
                    'THours' => 'a.THours',
                );
                $orderby = !empty($_GET['order_by']) && isset($fields[$_GET['order_by']]) ? $fields[$_GET['order_by']] : 'b.Code';
                $asc_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

                $query = "SELECT a.*, b.Code, b.Phase, c.Activity, 
		                 DATE_FORMAT(c.StartDate, '%d.%m.%Y') AS StartDate, DATE_FORMAT(c.EndDate, '%d.%m.%Y') AS EndDate,
		                 (SELECT Hours FROM persons_projects WHERE PersonID = a.PersonID AND ProjectID = a.ProjectID AND Year='{$_GET['Year']}' AND Month='{$_GET['Month']}' LIMIT 1 ) AS PHours
		          FROM (
				    SELECT ProjectID, ActivityID, PersonID, SUM(Hours) AS THours
		        	    FROM   pontaj
		        	    WHERE  MONTH(Data) ='{$_GET['Month']}' AND YEAR(Data) ='{$_GET['Year']}' AND
		        	           ProjectID = '{$_GET['ProjectID']}' AND PersonID = '{$_GET['PersonID']}'
		        	    GROUP  BY ProjectID, ActivityID, PersonID
		        	) a
		          INNER JOIN pontaj_projects b ON a.ProjectID = b.ProjectID
		          INNER JOIN pontaj_project_activities c ON a.ActivityID = c.ActivityID
		          ORDER BY $orderby $asc_desc";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $row['Activity'] = stripslashes($row['Activity']);
                    $row['Phase'] = Pontaj::$msPhases[$row['Phase']];
                    $report[] = $row;
                }

                break;

            case 21:

                if (empty($_GET['StartDate']) || empty($_GET['EndDate'])) {
                    return $report;
                }

                global $cal;

                $persons = array();
                $Status = !empty($_GET['Status']) ? (int)$_GET['Status'] : 0;

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

                $query = "SELECT a.PersonID, a.FullName,
	                         c.WorkNorm, b.StartDate AS PStartDate, b.EndDate AS PEndDate, b.Hours, b.Hours2
		          FROM   persons a
		    	         INNER JOIN payroll c ON a.PersonID = c.PersonID" . (!empty($_GET['DivisionID']) ? " AND c.DivisionID = '{$_GET['DivisionID']}'" : "") . (!empty($_GET['CompanyID']) ? " AND c.CompanyID = '{$_GET['CompanyID']}'" : "") . "
			         LEFT JOIN pontaj_detail b ON a.PersonID = b.PersonID AND b.StartDate BETWEEN '{$_GET['StartDate']}' AND '{$_GET['EndDate']}'
			  WHERE Type=2  " . ($Status > 0 ? " AND a.Status = '{$_GET['Status']}'" : "") . "
			  ORDER  BY a.FullName";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $persons[$row['PersonID']]['FullName'] = $row['FullName'];
                    $persons[$row['PersonID']]['WorkNorm'] = $row['WorkNorm'];
                    if (!empty($row['PStartDate'])) {
                        @$persons[$row['PersonID']]['Data'][$row['PStartDate']] += (double)$row['Hours'];
                        if ($row['PStartDate'] != $row['PEndDate']) {
                            @$persons[$row['PersonID']]['Data'][$row['PEndDate']] += (double)$row['Hours2'];
                        }
                    }
                    $persons[$row['PersonID']]['Total'] += (double)$row['Hours'];
                }

                return $persons;

                break;
        }

        if ($report_id <= 6) {

            $activities = array();
            foreach ($report as $k => $v) {
                $activities[$v['ActivityID']] = array();
            }

            if (empty($activities)) {
                return $report;
            }

            $query = "SELECT a.ActivityID, b.Phase
	              FROM   pontaj_activity_phases a
		             INNER JOIN pontaj_phases b ON a.PhaseID = b.PhaseID
	              WHERE  a.ActivityID IN (" . implode(',', array_keys($activities)) . ")";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $activities[$row['ActivityID']][] = $row['Phase'];
            }

            foreach ($report as $k => $v) {
                $report[$k]['PhaseAct'] = !empty($activities[$v['ActivityID']]) ? implode(', ', $activities[$v['ActivityID']]) : '-';
            }
        }

        return $report;
    }

}

?>