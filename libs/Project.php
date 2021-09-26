<?php

class Project extends ConfigData
{

    public static function addProject()
    {

        global $conn;

        $_POST['Code'] = trim($_POST['Code']);

        if (empty($_POST['Code'])) {
            $code = '';
            $words = explode(' ', $_POST['Name']);
            foreach ($words as $word) {
                $code .= strtoupper(substr(trim($word), 0, 1));
            }
            $_POST['Code'] = $code . date('dm');
        }

        $conn->query("SELECT Name, Code FROM pontaj_projects WHERE Name = '" . Utils::formatStr($_POST['Name']) . "' OR Code = '" . Utils::formatStr($_POST['Code']) . "'");
        if ($row = $conn->fetch_array()) {
            if ($row['Name'] == Utils::formatStr($_POST['Name'])) {
                throw new Exception(Message::getMessage('PROJECT_NAME_DPK'));
            } else {
                throw new Exception(Message::getMessage('PROJECT_CODE_DPK'));
            }
        }


        $conn->query("INSERT INTO pontaj_projects(Code, Name, StartDate, EndDate, EndDateRevised, Type, Phase, CompanyID, ContractNo, ContractDate, Address, FinancialSource, Beneficiary, Tags, CreateDate, LastUpdateDate)
	              VALUES('" . Utils::formatStr($_POST['Code']) . "', '" . Utils::formatStr($_POST['Name']) . "',
	                     '" . (!empty($_POST['StartDate']) ? Utils::toDBDate($_POST['StartDate']) : '') . "', 
			     '" . (!empty($_POST['EndDate']) ? Utils::toDBDate($_POST['EndDate']) : '') . "',
	                     '" . (!empty($_POST['EndDateRevised']) ? Utils::toDBDate($_POST['EndDateRevised']) : '') . "', '{$_POST['Type']}', '{$_POST['Phase']}',
	                     '{$_POST['CompanyID']}', '{$_POST['ContractNo']}', '{$_POST['ContractDate']}', 
			     '" . Utils::formatStr($_POST['Address']) . "', '{$_POST['FinancialSource']}', '" . Utils::formatStr($_POST['Beneficiary']) . "', 
			     '" . Utils::formatStr($_POST['Tags']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        return $conn->get_insert_id();
    }

    public static function editProject($ProjectID)
    {

        global $conn;

        $_POST['Code'] = trim($_POST['Code']);

        if (empty($_POST['Code'])) {
            $code = '';
            $words = explode(' ', $_POST['Name']);
            foreach ($words as $word) {
                $code .= strtoupper(substr(trim($word), 0, 1));
            }
            $_POST['Code'] = $code . date('dm');
        }

        $conn->query("SELECT Name, Code FROM pontaj_projects WHERE ProjectID != $ProjectID AND (Name = '" . Utils::formatStr($_POST['Name']) . "' OR Code = '" . Utils::formatStr($_POST['Code']) . "')");
        if ($row = $conn->fetch_array()) {
            if ($row['Name'] == Utils::formatStr($_POST['Name'])) {
                throw new Exception(Message::getMessage('PROJECT_NAME_DPK'));
            } else {
                throw new Exception(Message::getMessage('PROJECT_CODE_DPK'));
            }
        }

        $conn->query("UPDATE pontaj_projects SET
						    Code	    = '" . Utils::formatStr($_POST['Code']) . "',
						    Name	    = '" . Utils::formatStr($_POST['Name']) . "',
						    StartDate	    = '" . (!empty($_POST['StartDate']) ? Utils::toDBDate($_POST['StartDate']) : '') . "',
						    EndDate	    = '" . (!empty($_POST['EndDate']) ? Utils::toDBDate($_POST['EndDate']) : '') . "',
						    EndDateRevised  = '" . (!empty($_POST['EndDateRevised']) ? Utils::toDBDate($_POST['EndDateRevised']) : '') . "',
						    Type	    = '{$_POST['Type']}',
						    Phase 	    = '{$_POST['Phase']}',
						    CompanyID       = '{$_POST['CompanyID']}',
						    ContractNo      = '{$_POST['ContractNo']}',
						    ContractDate    = '{$_POST['ContractDate']}',
						    Address         = '" . Utils::formatStr($_POST['Address']) . "',
						    FinancialSource = '{$_POST['FinancialSource']}',
						    Beneficiary     = '" . Utils::formatStr($_POST['Beneficiary']) . "',
						    Tags            = '" . Utils::formatStr($_POST['Tags']) . "',
						    LastUpdateDate  = CURRENT_TIMESTAMP
		      WHERE ProjectID = '$ProjectID'");
    }

    public static function duplicateProject($ProjectID)
    {

        global $conn;

        $conn->query("INSERT INTO pontaj_projects(Code, Name, StartDate, EndDate, EndDateRevised, Type, Phase, CompanyID, CreateDate, LastUpdateDate)
	              SELECT CONCAT(Code, ' - DP') AS Code, CONCAT(Name, ' - DP') AS Name, StartDate, EndDate, EndDateRevised,
	                     Type, Phase, CompanyID, CURRENT_TIMESTAMP AS CreateDate, CURRENT_TIMESTAMP AS LastUpdateDate
	              FROM   pontaj_projects
	              WHERE  ProjectID = '$ProjectID'");
        $newProjectID = $conn->get_insert_id();

        $activities = array();
        $conn->query("SELECT ActivityID FROM pontaj_project_activities WHERE ProjectID = '$ProjectID' ORDER BY ActivityID");
        while ($row = $conn->fetch_array()) {
            $activities[] = $row['ActivityID'];
        }

        foreach ($activities as $id) {

            $conn->query("INSERT INTO pontaj_project_activities(ProjectID, Activity, StartDate, EndDate, EndDateRevised, Active, CreateDate, LastUpdateDate)
	                  SELECT '$newProjectID' AS ProjectID, Activity, StartDate, EndDate, EndDateRevised, Active,
	                         CURRENT_TIMESTAMP AS CreateDate, CURRENT_TIMESTAMP AS LastUpdateDate
	                  FROM   pontaj_project_activities
	                  WHERE  ActivityID = '$id' AND ProjectID = '$ProjectID'");
            $newid = $conn->get_insert_id();
            $conn->query("INSERT INTO pontaj_activity_phases(ActivityID, PhaseID)
	                  SELECT '$newid' AS ActivityID, PhaseID FROM pontaj_activity_phases WHERE ActivityID = '$id'");
            $conn->query("INSERT INTO pontaj_activity_roles(ActivityID, RoleID)
	                  SELECT '$newid' AS ActivityID, RoleID FROM pontaj_activity_roles WHERE ActivityID = '$id'");
        }

        return $newProjectID;
    }

    public static function deleteProject($ProjectID)
    {

        global $conn;

        $conn->query("DELETE FROM pontaj_projects WHERE ProjectID = '$ProjectID' AND
	              NOT EXISTS (SELECT ActivityID FROM pontaj WHERE ProjectID = '$ProjectID' AND Hours > 0)");
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Nu se poate sterge acest proiect deoarece are activitati pontate!'); window.location.href = './?m=projects&o=projects';\"></body>";
            exit;
        } else {
            $conn->query("DELETE FROM pontaj_activity_roles WHERE ActivityID IN (SELECT ActivityID FROM pontaj_project_activities WHERE ProjectID = '$ProjectID')");
            $conn->query("DELETE FROM pontaj_activity_phases WHERE ActivityID IN (SELECT ActivityID FROM pontaj_project_activities WHERE ProjectID = '$ProjectID')");
            $conn->query("DELETE FROM pontaj_project_activities WHERE ProjectID = '$ProjectID'");
        }
    }

    public static function getProject($ProjectID)
    {

        global $conn;

        $conn->query("SELECT * FROM pontaj_projects WHERE ProjectID = '$ProjectID'");
        if ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $row['StartDate'] = $row['StartDate'] != '0000-00-00' ? Utils::toDBDate($row['StartDate']) : '';
            $row['EndDate'] = $row['EndDate'] != '0000-00-00' ? Utils::toDBDate($row['EndDate']) : '';
            $row['EndDateRevised'] = $row['EndDateRevised'] != '0000-00-00' ? Utils::toDBDate($row['EndDateRevised']) : '';
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PROJECT'));
        }

    }

    public static function getPhases($dictionary = false)
    {

        global $conn;

        $phases = array();

        if ($dictionary === true) {
            $conn->query("SELECT PhaseID, Phase, Notes FROM pontaj_phases ORDER BY Phase");
            while ($row = $conn->fetch_array()) {
                $row['Phase'] = stripslashes($row['Phase']);
                $row['Notes'] = stripslashes($row['Notes']);
                $phases[$row['PhaseID']] = $row;
            }
        } else {
            $conn->query("SELECT PhaseID, Phase FROM pontaj_phases ORDER BY Phase");
            while ($row = $conn->fetch_array()) {
                $phases[$row['PhaseID']] = stripslashes($row['Phase']);
            }
        }

        return $phases;
    }

    public static function newPhase($PhaseID)
    {

        global $conn;

        if ($PhaseID > 0 && !empty($_GET['delPhase'])) {

            $conn->query("DELETE FROM pontaj_phases
                          WHERE  PhaseID = $PhaseID AND
                                 NOT EXISTS(SELECT PhaseID FROM pontaj WHERE PhaseID = $PhaseID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta faza deoarece este deja utilizata in pontaj!'); window.location.href = './?m=projects&o=phases';\"></body>";
                exit;
            }

        } else {

            $Phase = Utils::formatStr($_GET['Phase']);
            $Notes = Utils::formatStr($_GET['Notes']);

            if (empty($Phase)) {
                throw new Exception(Message::getMessage('PHASE_EMPTY'));
            }

            if ($PhaseID > 0) {
                $conn->query("UPDATE pontaj_phases SET Phase = '$Phase', Notes = '$Notes' WHERE PhaseID = $PhaseID");
            } else {
                $conn->query("INSERT INTO pontaj_phases(Phase, Notes, CreateDate) VALUES('$Phase', '$Notes', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('PHASE_DUPLICATE'));
            }
        }
    }


    public static function getAllProjects($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['ProjectID'])) {
            $cond .= " AND ProjectID = " . (int)$_GET['ProjectID'];
        } elseif (!empty($_GET['PhaseID'])) {
            $cond .= " AND Phase = " . (int)$_GET['PhaseID'];
        }

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                default:
                    $cond .= " AND a.Tags LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   pontaj_projects a
                   WHERE  (1 = 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $projects = array();
        $projects[0]['pageNo'] = $pageNo;
        $projects[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'Name';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.ProjectID, a.Code, a.Name, a.Type, a.Phase,
	                  DATE_FORMAT(a.StartDate, '%d.%m.%Y') AS start_date, DATE_FORMAT(a.EndDate, '%d.%m.%Y') AS end_date,
			  DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS create_date, b.CompanyName
                   FROM   pontaj_projects a
                          LEFT JOIN companies b ON a.CompanyID = b.CompanyID
                   WHERE  (1 = 1 OR {$_SESSION['USER_ID']} = 1) $cond
	           ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $projects[$row['ProjectID']] = $row;
        }

        return $projects;
    }

    public static function getActiveProjects()
    {
        global $conn;
        $projects = array();
        $conn->query("SELECT ProjectID, Name FROM pontaj_projects WHERE Type != 4 ORDER BY Name");
        while ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $projects[$row['ProjectID']] = $row;
        }
        return $projects;
    }
}

?>