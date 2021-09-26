<?php

class Performance extends ConfigData
{

    public static function getDimensions()
    {

        global $conn;

        $dim = array();
        $conn->query("SELECT DimensionID, Dimension, Status FROM performance_dimensions ORDER BY DimensionID");
        while ($row = $conn->fetch_array()) {
            $row['Dimension'] = stripslashes($row['Dimension']);
            $dim[$row['DimensionID']] = $row;
        }
        return $dim;
    }

    public static function newDimension($DimensionID)
    {

        global $conn;

        if ($DimensionID > 0 && !empty($_GET['delDimension'])) {
            $conn->query("DELETE FROM performance_dimensions
                          WHERE  DimensionID = $DimensionID AND
                                 NOT EXISTS(SELECT DimensionID FROM performance WHERE DimensionID = $DimensionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta dimensiune deoarece este deja utilizata!'); window.location.href = './?m=performance&o=dimension';\"></body>";
                exit;
            }

        } else {

            $Dimension = Utils::formatStr($_GET['Dimension']);

            if ($DimensionID > 0) {
                $conn->query("UPDATE performance_dimensions SET Dimension = '$Dimension', Status = '{$_GET['Status']}' WHERE DimensionID = $DimensionID");
            } else {
                $conn->query("INSERT INTO performance_dimensions(UserID, Dimension, CreateDate) VALUES('{$_SESSION['USER_ID']}', '$Dimension', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DIM'));
            }
        }
    }

    public static function getGoals($Year)
    {

        global $conn;

        $goals = array();
        $conn->query("SELECT a.PerfID, a.DimensionID, a.Goal, a.Pondere, a.Indicator, a.IndicatorRealizat, a.Deadline, a.Closed, a.Pos,
	                     
	                     CASE WHEN a.Pos > 0 THEN a.Pos ELSE 999999 END AS Prior, b.StatusID, b.StatusDate, b.Comment
	              FROM   performance a
	            	     LEFT JOIN performance_details b ON a.PerfID = b.PerfID
	              WHERE  a.PersonID = '{$_SESSION['PersonID']}' AND a.Year = '$Year'
	              ORDER  BY Prior, a.PerfID, b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);

            //calcule speciale
            $row['GradIndeplinire'] = ((double)$row['Indicator'] > 0) ? round((double)$row['IndicatorRealizat'] / (double)$row['Indicator'] * 100, 2) : 0;
            $row['NotaFinala'] = ((double)$row['Pondere'] > 0) ? round((double)$row['GradIndeplinire'] * (double)$row['Pondere'] / 100, 2) : 0;
            //end calcule speciale

            $goals[$row['PerfID']] = $row;
        }

        if (!empty($_GET['order_by']) && in_array($_GET['order_by'], array('Pos', 'DimensionID', 'Goal', 'Pondere', 'Indicator', 'IndicatorRealizat', 'GradIndeplinire', 'NotaFinala', 'Deadline', 'StatusID'))) {
            $tmp = array();
            foreach ($goals as $k => $v) {
                $tmp[$k] = $v[$_GET['order_by']];
                if ($_GET['asc_or_desc'] == 'desc') {
                    arsort($tmp);
                } else {
                    asort($tmp);
                }
            }
            $new_goals = array();
            foreach ($tmp as $k => $v) {
                $new_goals[$k] = $goals[$k];
            }
            $goals = $new_goals;
        }

        return $goals;
    }

    public static function getGoal($PerfID)
    {

        global $conn;

        $goal = array();
        $conn->query("SELECT a.PerfID, a.Year, a.DimensionID, a.Goal, a.Pondere, a.Indicator, a.IndicatorRealizat, a.Deadline, a.Closed,
	                     b.StatusID, b.StatusDate, b.Comment, b.CommentEval, b.EspectedLevel
	              FROM   performance a
	            	     LEFT JOIN performance_details b ON a.PerfID = b.PerfID
	              WHERE  a.PerfID = $PerfID AND a.PersonID = '{$_SESSION['PersonID']}'
	              ORDER  BY b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['CommentEval'] = stripslashes($row['CommentEval']);
            $row['EspectedLevel'] = stripslashes($row['EspectedLevel']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);
            $goal = $row;
        }

        return $goal;
    }

    public static function getGoalHistory($PerfID)
    {

        global $conn;

        $goal = array();
        $conn->query("SELECT a.PerfID, a.DimensionID, a.Goal, a.Pondere, a.Indicator, a.IndicatorRealizat, a.Deadline, 
	                     b.DetailID, b.StatusID, b.StatusDate, b.Comment
	              FROM   performance a
	            	     INNER JOIN performance_details b ON a.PerfID = b.PerfID
	              WHERE  a.PerfID = $PerfID AND a.PersonID = '{$_SESSION['PersonID']}'
	              ORDER  BY b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);

            //calcule speciale
            $row['GradIndeplinire'] = ((double)$row['Indicator'] > 0) ? round((double)$row['IndicatorRealizat'] / (double)$row['Indicator'] * 100, 2) : 0;
            $row['NotaFinala'] = ((double)$row['Pondere'] > 0) ? round((double)$row['GradIndeplinire'] * (double)$row['Pondere'] / 100, 2) : 0;
            //end calcule speciale

            $goal[$row['DetailID']] = $row;
        }

        return $goal;
    }

    public static function newGoal()
    {

        global $conn;

        $conn->query("SELECT COUNT(*) as Nb FROM performance WHERE PersonID = {$_SESSION['PersonID']} AND Year = '{$_POST['Year']}'");
        $row = $conn->fetch_array();
        $pos = (int)$row['Nb'] + 1;

        /*$conn->query("INSERT INTO performance(UserID, PersonID, CreateDate, LastUpdateDate, Year, DimensionID, Goal, Pondere, FPondere, Deadline, Calif, Note1, Note2, Note3, Note4, Note5)
                      VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PersonID']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '{$_POST['Year']}',
                         '{$_POST['DimensionID']}', '" . Utils::formatStr($_POST['Goal']) . "', '{$_POST['Pondere']}', '{$_POST['FPondere']}',
                     '" . Utils::toDBDate($_POST['Deadline']) . "', '" . (!empty($_POST['Calif']) ? $_POST['Calif'] : 0) . "',
                     '" . Utils::formatStr($_POST['Note1']) . "', '" . Utils::formatStr($_POST['Note2']) . "', '" . Utils::formatStr($_POST['Note3']) . "',
                     '" . Utils::formatStr($_POST['Note4']) . "', '" . Utils::formatStr($_POST['Note5']) . "')"); */

        $conn->query("INSERT INTO performance(UserID, PersonID, CreateDate, LastUpdateDate, Year, DimensionID, Goal, Pondere, Indicator, IndicatorRealizat, Deadline, Pos)
	              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PersonID']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '{$_POST['Year']}', 
		             '{$_POST['DimensionID']}', '" . Utils::formatStr($_POST['Goal']) . "', '{$_POST['Pondere']}', '{$_POST['Indicator']}', '{$_POST['IndicatorRealizat']}', 
			     '" . Utils::toDBDate($_POST['Deadline']) . "', '$pos')");

        //echo $query;
        $PerfID = $conn->get_insert_id();
        $conn->query("INSERT INTO performance_details(PerfID, UserID, StatusID, StatusDate, Comment, CommentEval, EspectedLevel, CreateDate, LastUpdateDate)
	              VALUES('$PerfID', '{$_SESSION['USER_ID']}', '{$_POST['StatusID']}', '" . Utils::toDBDate($_POST['StatusDate']) . "', 
		             '" . Utils::formatStr($_POST['Comment']) . "', '" . Utils::formatStr($_POST['CommentEval']) . "', 
			     '" . Utils::formatStr($_POST['EspectedLevel']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

    public static function editGoal($PerfID)
    {

        global $conn;

        $info = self::checkGoal($PerfID);
        if ($info['edit'] == 1) {
            $condclosed = '';
            if (($_SESSION['USER_RIGHTS2'][9][1] == 2 && $_SESSION['ROLEMNG'] == 1 && $_POST['Closed'] == 1) || $_SESSION['USER_RIGHTS2'][9][1] == 3 || $_SESSION['USER_ID'] == 1) {
                $condclosed = ", Closed = '{$_POST['Closed']}'";
            }
            $conn->query("UPDATE performance SET
						    LastUpdatedate = CURRENT_TIMESTAMP,
						    Year           = '{$_POST['Year']}',
						    DimensionID    = '{$_POST['DimensionID']}',
						    Goal           = '" . Utils::formatStr($_POST['Goal']) . "',
						    Pondere        = '{$_POST['Pondere']}',
						    Indicator       = '{$_POST['Indicator']}',
						    IndicatorRealizat   = '{$_POST['IndicatorRealizat']}',
						    Deadline       = '" . Utils::toDBDate($_POST['Deadline']) . "'
						    $condclosed
			  WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
            if (($info['StatusID'] != $_POST['StatusID']) || ($_POST['StatusID'] == 3 && $info['StatusDate'] != Utils::toDBDate($_POST['StatusDate']))) {
                $conn->query("INSERT INTO performance_details(PerfID, UserID, StatusID, StatusDate, Comment, CommentEval, EspectedLevel, CreateDate, LastUpdateDate)
	                      VALUES('$PerfID', '{$_SESSION['USER_ID']}', '{$_POST['StatusID']}', '" . Utils::toDBDate($_POST['StatusDate']) . "', 
			             '" . Utils::formatStr($_POST['Comment']) . "', '" . Utils::formatStr($_POST['CommentEval']) . "', 
				     '" . Utils::formatStr($_POST['EspectedLevel']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            } else {
                $conn->query("UPDATE performance_details SET
								StatusDate     = '" . Utils::toDBDate($_POST['StatusDate']) . "',
								Comment        = '" . Utils::formatStr($_POST['Comment']) . "',
								CommentEval    = '" . Utils::formatStr($_POST['CommentEval']) . "',
								EspectedLevel  = '" . Utils::formatStr($_POST['EspectedLevel']) . "',
								LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE DetailID = '{$info['DetailID']}' AND PerfID = $PerfID");
            }
        }
    }

    public static function checkGoal($PerfID)
    {

        global $conn;

        $conn->query("SELECT StatusID, StatusDate, Comment, DetailID
	              FROM   performance_details
	              WHERE  PerfID = $PerfID AND EXISTS (SELECT PerfID FROM performance WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')
	              ORDER  BY DetailID DESC
	              LIMIT 1");
        $row = $conn->fetch_array();
        $row['edit'] = ($row['StatusID'] == 1 && $_SESSION['USER_RIGHTS2'][9][1] == 1) || $_SESSION['USER_RIGHTS2'][9][1] >= 2 || $_SESSION['USER_ID'] == 1 ? 1 : 0;
        return $row;
    }

    public static function deleteGoal($PerfID)
    {

        global $conn;
        $conn->query("DELETE FROM performance WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
        if ($conn->get_affected_rows()) {
            $conn->query("DELETE FROM performance_details WHERE PerfID = $PerfID");
        }
    }

    public static function editGoalHistory($PerfID, $DetailID)
    {

        global $conn;
        $conn->query("UPDATE performance_details SET Comment = '" . Utils::formatStr($_POST['Comment']) . "'
	              WHERE DetailID = $DetailID AND PerfID = $PerfID AND
	              EXISTS (SELECT PerfID FROM performance WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')");
    }

    public static function deleteGoalHistory($PerfID, $DetailID)
    {

        global $conn;
        $conn->query("DELETE FROM performance_details WHERE DetailID = $DetailID AND PerfID = $PerfID AND
	              EXISTS (SELECT PerfID FROM performance WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')");
    }

    public static function getPlans($Year)
    {

        global $conn;

        $plans = array();
        $conn->query("SELECT a.PerfID, a.DimensionID, a.Goal, a.Deadline, a.Pos, 
	                     CASE WHEN a.Pos > 0 THEN a.Pos ELSE 999999 END AS Prior, b.StatusID, b.StatusDate, b.Comment
	              FROM   performance_plan a
	            	     LEFT JOIN performance_plan_details b ON a.PerfID = b.PerfID
	              WHERE  a.PersonID = '{$_SESSION['PersonID']}' AND a.Year = '$Year'
	              ORDER  BY Prior, a.PerfID, b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);
            $row['edit'] = $_SESSION['USER_RIGHTS2'][9][1] == 3 || $_SESSION['USER_ID'] == 1 ? 2 : ($_SESSION['USER_RIGHTS2'][9][1] == 2 ? 1 : 0);
            $plans[$row['PerfID']] = $row;
        }

        if (!empty($_GET['order_by']) && in_array($_GET['order_by'], array('DimensionID', 'Goal', 'Deadline', 'StatusID'))) {
            $tmp = array();
            foreach ($plans as $k => $v) {
                $tmp[$k] = $v[$_GET['order_by']];
                if ($_GET['asc_or_desc'] == 'desc') {
                    arsort($tmp);
                } else {
                    asort($tmp);
                }
            }
            $new_plans = array();
            foreach ($tmp as $k => $v) {
                $new_plans[$k] = $plans[$k];
            }
            $plans = $new_plans;
        }

        return $plans;
    }

    public static function getPlan($PerfID)
    {

        global $conn;

        $goal = array();
        $info = self::checkPlan($PerfID);
        $conn->query("SELECT a.PerfID, a.Year, a.DimensionID, a.Goal, a.Deadline, b.StatusID, b.StatusDate, b.Comment
	              FROM   performance_plan a
	            	     LEFT JOIN performance_plan_details b ON a.PerfID = b.PerfID
	              WHERE  a.PerfID = $PerfID AND a.PersonID = '{$_SESSION['PersonID']}'
	              ORDER  BY b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);
            $row['edit'] = $info['edit'];
            $goal = $row;
        }

        return $goal;
    }

    public static function checkPlan($PerfID)
    {

        global $conn;

        $conn->query("SELECT StatusID, StatusDate, Comment, DetailID
	              FROM   performance_plan_details
	              WHERE  PerfID = $PerfID AND EXISTS (SELECT PerfID FROM performance_plan WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')
	              ORDER  BY DetailID DESC
	              LIMIT 1");
        $row = $conn->fetch_array();
        $row['edit'] = $_SESSION['USER_RIGHTS2'][9][1] == 3 || $_SESSION['USER_ID'] == 1 ? 2 : ($_SESSION['USER_RIGHTS2'][9][1] == 2 ? 1 : 0);
        return $row;
    }

    public static function getPlanHistory($PerfID)
    {

        global $conn;

        $plan = array();
        $conn->query("SELECT a.PerfID, a.DimensionID, a.Goal, a.Deadline, b.DetailID, b.StatusID, b.StatusDate, b.Comment
	              FROM   performance_plan a
	            	     INNER JOIN performance_plan_details b ON a.PerfID = b.PerfID
	              WHERE  a.PerfID = $PerfID AND a.PersonID = '{$_SESSION['PersonID']}'
	              ORDER  BY b.DetailID");
        while ($row = $conn->fetch_array()) {
            $row['Goal'] = stripslashes($row['Goal']);
            $row['Comment'] = stripslashes($row['Comment']);
            $row['Deadline'] = Utils::toDBDate($row['Deadline']);
            $row['StatusDate'] = Utils::toDBDate($row['StatusDate']);
            $plan[$row['DetailID']] = $row;
        }

        return $plan;
    }

    public static function newPlan()
    {

        global $conn;

        $conn->query("INSERT INTO performance_plan(UserID, PersonID, CreateDate, LastUpdateDate, Year, DimensionID, Goal, Deadline)
	              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PersonID']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '{$_POST['Year']}', '{$_POST['DimensionID']}', '" . Utils::formatStr($_POST['Goal']) . "', '" . Utils::toDBDate($_POST['Deadline']) . "')");
        $PerfID = $conn->get_insert_id();
        $StatusDate = !empty($_POST['StatusDate']) ? Utils::toDBDate($_POST['StatusDate']) : date('Y-m-d');
        $conn->query("INSERT INTO performance_plan_details(PerfID, UserID, StatusID, StatusDate, Comment, CreateDate, LastUpdateDate)
	              VALUES('$PerfID', '{$_SESSION['USER_ID']}', '{$_POST['StatusID']}', '$StatusDate', '" . Utils::formatStr($_POST['Comment']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    }

    public static function editPlan($PerfID)
    {

        global $conn;

        $info = self::checkPlan($PerfID);
        if ($info['edit'] == 2) {
            $StatusDate = !empty($_POST['StatusDate']) ? Utils::toDBDate($_POST['StatusDate']) : date('Y-m-d');
            $conn->query("UPDATE performance_plan SET
						    LastUpdatedate = CURRENT_TIMESTAMP,
						    Year           = '{$_POST['Year']}',
						    DimensionID    = '{$_POST['DimensionID']}',
						    Goal           = '" . Utils::formatStr($_POST['Goal']) . "',
						    Deadline       = '" . Utils::toDBDate($_POST['Deadline']) . "'
			  WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
            if (($info['StatusID'] != $_POST['StatusID']) || ($_POST['StatusID'] == 3 && $info['StatusDate'] != $StatusDate)) {
                $conn->query("INSERT INTO performance_plan_details(PerfID, UserID, StatusID, StatusDate, Comment, CreateDate, LastUpdateDate)
	                      VALUES('$PerfID', '{$_SESSION['USER_ID']}', '{$_POST['StatusID']}', '$StatusDate', '" . Utils::formatStr($_POST['Comment']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            } else {
                $conn->query("UPDATE performance_plan_details SET
								StatusDate     = '$StatusDate',
								Comment        = '" . Utils::formatStr($_POST['Comment']) . "',
								LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE DetailID = '{$info['DetailID']}' AND PerfID = $PerfID");
            }
        } elseif ($info['edit'] == 1) {
            $StatusDate = !empty($_POST['StatusDate']) ? Utils::toDBDate($_POST['StatusDate']) : date('Y-m-d');
            $conn->query("UPDATE performance_plan SET
						    LastUpdatedate = CURRENT_TIMESTAMP,
						    Year           = '{$_POST['Year']}',
						    DimensionID    = '{$_POST['DimensionID']}',
						    Deadline       = '" . Utils::toDBDate($_POST['Deadline']) . "'
			  WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
            if (($info['StatusID'] != $_POST['StatusID']) || ($_POST['StatusID'] == 3 && $info['StatusDate'] != $StatusDate)) {
                $conn->query("INSERT INTO performance_plan_details(PerfID, UserID, StatusID, StatusDate, Comment, CreateDate, LastUpdateDate)
	                      VALUES('$PerfID', '{$_SESSION['USER_ID']}', '{$_POST['StatusID']}', '$StatusDate', '" . Utils::formatStr($_POST['Comment']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            } else {
                $conn->query("UPDATE performance_plan_details SET
								StatusDate     = '$StatusDate',
								Comment        = '" . Utils::formatStr($_POST['Comment']) . "',
								LastUpdateDate = CURRENT_TIMESTAMP
		              WHERE DetailID = '{$info['DetailID']}' AND PerfID = $PerfID");
            }
        }
    }

    public static function deletePlan($PerfID)
    {

        global $conn;
        $conn->query("DELETE FROM performance_plan WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
        if ($conn->get_affected_rows()) {
            $conn->query("DELETE FROM performance_plan_details WHERE PerfID = $PerfID");
        }
    }

    public static function editPlanHistory($PerfID, $DetailID)
    {

        global $conn;
        $conn->query("UPDATE performance_plan_details SET Comment = '" . Utils::formatStr($_POST['Comment']) . "'
	              WHERE DetailID = $DetailID AND PerfID = $PerfID AND
	              EXISTS (SELECT PerfID FROM performance_plan WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')");
    }

    public static function deletePlanHistory($PerfID, $DetailID)
    {

        global $conn;
        $conn->query("DELETE FROM performance_plan_details WHERE DetailID = $DetailID AND PerfID = $PerfID AND
	              EXISTS (SELECT PerfID FROM performance_plan WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}')");
    }

    public static function getAllPersons($action = '')
    {

        global $conn;

        $cond = '';

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
                default:
                    $cond .= " AND (a.LastName LIKE '{$_GET['keyword']}%' OR a.FirstName LIKE '{$_GET['keyword']}%')";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            if ($_GET['Status'] != 'all') {
                $cond .= " AND a.Status = " . (int)$_GET['Status'];
                if (($pos = strpos($_GET['Status'], '_')) !== false) {
                    $cond .= " AND a.SubStatus = " . (int)substr($_GET['Status'], $pos + 1);
                }
            }
        } else {
            $cond .= " AND a.Status IN (2,9)";
        }

        if (!empty($_GET['DimensionID'])) {
            $cond .= " AND a.PersonID IN (
					    SELECT DISTINCT PersonID
					    FROM   performance
					    WHERE  DimensionID = " . (int)$_GET['DimensionID'] . "
					)";
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

        $condmng = '';
        if ($_SESSION['USER_ID'] != 1) {
            if ($_SESSION['USER_RIGHTS2'][9][1] == 1) {
                $condmng = "a.PersonID = '{$_SESSION['PERS']}' OR ";
            }
            if ($_SESSION['USER_RIGHTS2'][9][1] == 2 && $_SESSION['ROLEMNG'] == 1) {
                $condmng = "a.PersonID = '{$_SESSION['PERS']}' OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') OR ";
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   persons a
                          INNER JOIN address b ON a.AddressID = b.AddressID
                          INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                          INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          INNER JOIN users g ON a.UserID = g.UserID
                   WHERE  a.RoleID > 0 AND ($condmng '{$_SESSION['USER_RIGHTS2'][9][1]}' = 3 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.LastName, a.FirstName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName, f.DepartmentID, f.FunctionID,
                         FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, g.UserName, h.DivisionID,
                         GROUP_CONCAT(k.CostCenter ORDER BY CostCenter ASC SEPARATOR ', ') AS CostCenters
	          FROM   persons a
	                 INNER JOIN address b ON a.AddressID = b.AddressID
                         INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                         INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                         LEFT  JOIN payroll f ON a.PersonID = f.PersonID
                         LEFT  JOIN departments h ON f.DepartmentID = h.DepartmentID
                         INNER JOIN users g ON a.UserID = g.UserID
                         LEFT JOIN payroll_costcenter j ON a.PersonID=j.PersonID
			 LEFT JOIN costcenter k ON j.CostCenterID=k.CostCenterID
	          WHERE  a.RoleID > 0 AND ($condmng '{$_SESSION['USER_RIGHTS2'][9][1]}' = 3 OR {$_SESSION['USER_ID']} = 1) $cond
	          GROUP  BY a.PersonID
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getAllActions($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'Goal';
                    $cond .= " AND a.Goal LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND c.FullName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND c.FullName LIKE '% {$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (c.FullName LIKE '{$_GET['keyword']}%' OR c.FullName LIKE '% {$_GET['keyword']}%')";
                    break;
            }
        }

        if (!empty($_GET['Year'])) {
            $cond .= " AND a.Year = " . (int)$_GET['Year'];
        }

        if (!empty($_GET['StatusID'])) {
            $cond .= " AND b.StatusID = " . (int)$_GET['StatusID'];
        }

        if (!empty($_GET['DimensionID'])) {
            $cond .= " AND a.DimensionID = " . (int)$_GET['DimensionID'];
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

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                 FROM   performance_plan a
                        INNER JOIN (
                        		SELECT PerfID, StatusID
                        		FROM   performance_plan_details
                        		WHERE  DetailID IN (
                        					SELECT MAX(DetailID) AS DetailID
                                    				FROM   performance_plan_details
                                    				GROUP  BY PerfID
                                    			    )
                                    ) b ON a.PerfID = b.PerfID
                        INNER JOIN persons c ON a.PersonID = c.PersonID 
                 WHERE  1=1 $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $actions = array();
        $actions[0]['pageNo'] = $pageNo;
        $actions[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.PerfID';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.PerfID, a.PersonID, a.Year, a.Goal, a.DimensionID, b.StatusID, c.FullName, d.DepartmentID, e.DivisionID
                  FROM   performance_plan a
                         INNER JOIN (
                        		SELECT PerfID, StatusID
                        		FROM   performance_plan_details
                        		WHERE  DetailID IN (
                        					SELECT MAX(DetailID) AS DetailID
                                    				FROM   performance_plan_details
                                    				GROUP  BY PerfID
                                    			    )
                                    ) b ON a.PerfID = b.PerfID
                         INNER JOIN persons c ON a.PersonID = c.PersonID 
                         LEFT  JOIN payroll d ON a.PersonID = d.PersonID
                         LEFT  JOIN departments e ON d.DepartmentID = e.DepartmentID
                  WHERE  1=1 $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $actions[$row['PerfID']] = $row;
        }

        return $actions;
    }

    public static function getPersonByID($PersonID)
    {
        global $conn;

        if (empty($_SESSION['PERS']) && !$PersonID) {
            $PersonID = 0;
            $_SESSION['PERS'] = 0;
        }
        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $conn->query("SELECT FullName
	              FROM   persons
	              WHERE  PersonID = $PersonID AND
	                     CASE WHEN '{$_SESSION['USER_RIGHTS2'][9][1]}' = 1 AND $PersonID = '{$_SESSION['PERS']}' THEN 1 = 1
	                          WHEN '{$_SESSION['USER_RIGHTS2'][9][1]}' = 2 AND ($PersonID = '{$_SESSION['PERS']}' $condmng) THEN 1 = 1
	                          WHEN '{$_SESSION['USER_RIGHTS2'][9][1]}' = 3 OR {$_SESSION['USER_ID']} = 1 THEN 1 = 1
	                          ELSE 1 = 0
	                     END");
        return ($row = $conn->fetch_array()) ? $row['FullName'] : false;
    }

    public static function getPersonByID2($PersonID)
    {
        global $conn;
        $conn->query("SELECT FullName
	              FROM   persons
	              WHERE  PersonID = $PersonID AND
	                     CASE WHEN '{$_SESSION['USER_RIGHTS2'][9][1]}' <= 2 AND $PersonID = '{$_SESSION['PERS']}' THEN 1 = 1
	                          WHEN '{$_SESSION['USER_RIGHTS2'][9][1]}' = 3 OR {$_SESSION['USER_ID']} = 1 THEN 1 = 1
	                          ELSE 1 = 0
	                     END");
        return ($row = $conn->fetch_array()) ? $row['FullName'] : false;
    }
}

?>