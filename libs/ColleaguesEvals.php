<?php

class ColleaguesEvals extends ConfigData
{


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
                    $cond .= " AND a.FullName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FullName LIKE '% {$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (a.FullName LIKE '{$_GET['keyword']}%' OR a.FullName LIKE '% {$_GET['keyword']}%')";
                    break;
            }
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

        if ($_SESSION['USER_SETTINGS'][25] == 2) {
            $cond .= " AND a.ManagerID = {$_SESSION['MANAGER']}";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   persons a
                          INNER JOIN address b ON a.AddressID = b.AddressID
                          INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                          INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          INNER JOIN users g ON a.UserID = g.UserID
                   		  WHERE  (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
      			";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        /* WHERE  a.RoleID > 0 AND ('{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond*/
        $query = "SELECT a.*, d.CityName, e.DistrictName, f.DepartmentID, f.FunctionID,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, g.UserName, h.DivisionID
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                       LEFT  JOIN payroll f ON a.PersonID = f.PersonID
                       LEFT  JOIN departments h ON f.DepartmentID = h.DepartmentID
                       INNER JOIN users g ON a.UserID = g.UserID
                       INNER JOIN colleagues_eval_forms i ON a.PersonID=i.PersonID
				  WHERE  (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
	              ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getAllPersonsEvaluator($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.FullName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FullName LIKE '% {$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (a.FullName LIKE '{$_GET['keyword']}%' OR a.FullName LIKE '% {$_GET['keyword']}%')";
                    break;
            }
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

        if ($_SESSION['USER_SETTINGS'][25] == 2) {
            $cond .= " AND a.ManagerID = {$_SESSION['MANAGER']}";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   persons a
                          INNER JOIN address b ON a.AddressID = b.AddressID
                          INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                          INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          INNER JOIN users g ON a.UserID = g.UserID
                          INNER JOIN colleagues_eval_forms i ON a.PersonID=i.PersonID
                   		  WHERE  (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR i.EvaluatorID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
      			";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        /* WHERE  a.RoleID > 0 AND ('{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond*/
        $query = "SELECT a.*, d.CityName, e.DistrictName, f.DepartmentID, f.FunctionID,
                       FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, g.UserName, h.DivisionID
	              FROM   persons a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                       LEFT  JOIN payroll f ON a.PersonID = f.PersonID
                       LEFT  JOIN departments h ON f.DepartmentID = h.DepartmentID
                       INNER JOIN users g ON a.UserID = g.UserID
                       INNER JOIN colleagues_eval_forms i ON a.PersonID=i.PersonID
				  WHERE (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR i.EvaluatorID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
	              ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }


    public static function getPersonByID($PersonID)
    {
        global $conn;

        if (empty($_SESSION['PERS']) && !$PersonID) {
            $PersonID = 0;
            $_SESSION['PERS'] = 0;
        }

        $conn->query("SELECT FullName
	              FROM   persons
	              WHERE  PersonID = $PersonID AND
	                     CASE WHEN '{$_SESSION['USER_SETTINGS'][25]}' = 1 AND $PersonID = '{$_SESSION['PERS']}' THEN 1 = 1
	                          WHEN '{$_SESSION['USER_SETTINGS'][25]}' = 2 AND ($PersonID = '{$_SESSION['PERS']}' OR ManagerID = '{$_SESSION['PERS']}') THEN 1 = 1
	                          WHEN '{$_SESSION['USER_SETTINGS'][25]}' = 3 OR {$_SESSION['USER_ID']} = 1 THEN 1 = 1
	                          ELSE 1 = 0
	                     END");
        return ($row = $conn->fetch_array()) ? $row['FullName'] : false;
    }


    #####################   Evaluation FORMS Draft  ##########

    public static function cloneEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $txClone = '[FORMULAR CLONAT] ';

        $query = "INSERT INTO colleagues_eval_forms_draft (UserID,FormName,CreateDate)
       				SELECT UserID,CONCAT_WS('','$txClone',FormName),CURRENT_TIMESTAMP FROM colleagues_eval_forms_draft
                  	WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                    (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        $newEvalDraftID = $conn->get_insert_id();

        $query = "SELECT * FROM colleagues_eval_sections a
    			WHERE  a.EvalFormDraftID=$EvalFormDraftID";
        $r1 = $conn->query($query);
        while ($row = $conn->fetch_array($r1)) {
            // Insert new sections
            $query2 = "INSERT INTO colleagues_eval_sections SET
		    		 	EvalFormDraftID=$newEvalDraftID,
		    		 	Name='{$row['Name']}',
		    		 	Priority='{$row['Priority']}',
		    		 	Pondere='{$row['Pondere']}',
		    		 	Status='{$row['Status']}',
		    		 	CreateDate = CURRENT_TIMESTAMP
		    		 	";
            $r2 = $conn->query($query2);
            $newSectionID = $conn->get_insert_id($r2);
            // Insert new questions
            $query3 = "SELECT * FROM colleagues_eval_questions a
	    			WHERE  a.EvalFormDraftID=$EvalFormDraftID
	    			AND a.SectionID='{$row['SectionID']}'";
            $r3 = $conn->query($query3);
            while ($row3 = $conn->fetch_array($r3)) {
                $query4 = "INSERT INTO colleagues_eval_questions SET
			    		 	UserID={$_SESSION['USER_ID']},
			    		 	EvalFormDraftID=$newEvalDraftID,
			    		 	SectionID='$newSectionID',
			    		 	Question='{$row3['Question']}',
			    		 	Pondere='{$row3['Pondere']}'
			    		 	";
                $r4 = $conn->query($query4);
            }
        }

        return $newEvalDraftID;
    }

    public static function getEvalFormsDraft()
    {

        global $conn;
        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'FormName';
                    $cond .= " AND a.FormName LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.FormName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['PersonID']))
            $cond .= " AND c.PersonID = " . (int)$_GET['PersonID'];

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
				FROM colleagues_eval_forms_draft a
    			LEFT JOIN eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
    			WHERE (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $news = array();
        $res[0]['pageNo'] = $pageNo;
        $res[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.EvalFormDraftID';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.EvalFormDraftID, a.FormName, a.CreateDate, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS CreateDate, (SELECT COUNT(*) FROM colleagues_eval_forms WHERE EvalFormDraftID=a.EvalFormDraftID) AS AssignedForms 
    			FROM colleagues_eval_forms_draft a
    			LEFT JOIN eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
    			WHERE (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY a.EvalFormDraftID
    			ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['EvalFormDraftID']] = $row;
        }
        return $res;
    }

    public static function getPersonsByFormDraft($EvalFormDraftID)
    {
        global $conn;

        $query = "SELECT COUNT(b.EvalFormID) AS EvalSum,c.PersonID,c.FullName FROM colleagues_eval_forms_draft a
				INNER JOIN colleagues_eval_forms b ON a.EvalFormDraftID=b.EvalFormDraftID
				INNER JOIN persons c ON c.PersonID=b.PersonID
				WHERE a.EvalFormDraftID=$EvalFormDraftID
				GROUP BY c.PersonID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['PersonID']] = $row;
        }
        return $res;
    }

    public static function addEvalQuestion($EvalQuestionID)
    {

        global $conn;

        if ($EvalQuestionID > 0 && $_GET['action'] == 'del_question') {
            $conn->query("DELETE FROM colleagues_eval_questions
                          WHERE  EvalQuestionID = $EvalQuestionID AND
                                 NOT EXISTS(SELECT EvalQuestionID FROM colleagues_eval WHERE EvalQuestionID = $EvalQuestionID)");
            if (!$conn->get_affected_rows()) {
                $conn->query("SELECT EvalFormDraftID FROM colleagues_eval_questions WHERE EvalQuestionID = $EvalQuestionID");
                $row = $conn->fetch_array();
                $EvalFormDraftID = $row['EvalFormDraftID'];
                echo "<body onload=\"alert('Nu se poate sterge aceasta intrebare deoarece este deja utilizata!'); window.location.href = './?m=colleagues-eval&o=evalDraft&EvalFormDraftID=" . $EvalFormDraftID . "&action=edit';\"></body>";
                exit;
            }

        } else {
            if (empty($_POST['SectionID']))
                throw new Exception(Message::getMessage('SELECT_EVAL_SECTION'));

            elseif (empty($_POST['Question']))
                throw new Exception(Message::getMessage('QUESTION_EMPTY'));

            elseif (empty($_POST['Pondere']))
                throw new Exception(Message::getMessage('PONDERE_EMPTY'));
            $SectionID = Utils::formatStr($_POST['SectionID']);
            $Question = Utils::formatStr($_POST['Question']);
            $Pondere = $_POST['Pondere'];
            //Utils::pa($_POST);
            //exit;
            if ($EvalQuestionID > 0) {
                $conn->query("UPDATE colleagues_eval_questions SET Question = '$Question', Pondere = '$Pondere', SectionID=$SectionID WHERE EvalQuestionID = $EvalQuestionID");
            } else {
                $conn->query("INSERT INTO colleagues_eval_questions(UserID,EvalFormDraftID, Question, Pondere, SectionID) VALUES('{$_SESSION['USER_ID']}', '{$_GET['EvalFormDraftID']}','$Question', '$Pondere', $SectionID)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_QUESTION'));
            }
        }
    }

    public static function getEvalQuestions($EvalFormDraftID)
    {

        global $conn;
        $query = "SELECT *,a.Pondere AS Pondere FROM colleagues_eval_questions a
    			INNER JOIN colleagues_eval_sections b ON a.SectionID=b.SectionID
    			WHERE  a.EvalFormDraftID=$EvalFormDraftID
    			AND (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1)
    			ORDER BY b.Priority ASC,a.EvalQuestionID ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalQuestions[$row['EvalQuestionID']] = $row;
        }
        //Utils::pa($evalQuestions);
        // exit;
        return $evalQuestions;
    }

    public static function getEvalFormsPersonal()
    {

        global $conn;
        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                default:
                    $cond .= "";
                    break;
            }
        }

        if (!empty($_GET['PersonID']))
            $cond .= " AND a.PersonID = '{$_GET['PersonID']}'";

        if (!empty($_GET['StartDate']))
            $cond .= " AND a.StartDate >= '{$_GET['StartDate']}'";

        if (!empty($_GET['EndDate']))
            $cond .= " AND a.EndDate <= '{$_GET['EndDate']}'";

        if (!empty($_GET['EvalFormDraftID']))
            $cond .= " AND a.EvalFormDraftID = '{$_GET['EvalFormDraftID']}'";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        if (empty($_SESSION['MANAGER']))
            $ManagerID = 0;
        else
            $ManagerID = $_SESSION['MANAGER'];

        $query = "SELECT COUNT(*) AS total FROM colleagues_eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			WHERE  1=1 
    			AND (a.ManagerID=$ManagerID OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY EvalFormKey";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $evalForms = array();
        $evalForms[0]['pageNo'] = $pageNo;
        $evalForms[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.StartDate ';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        $query = "SELECT *, d.FullName as EvaluatedName FROM colleagues_eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			LEFT JOIN persons c ON a.EvaluatorID=c.PersonID
    			LEFT JOIN persons d ON a.PersonID=d.PersonID
    			WHERE  1=1
    			AND (a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY EvalFormKey
    			ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            $query = "SELECT * FROM colleagues_eval_forms a
    			LEFT JOIN persons c ON a.EvaluatorID=c.PersonID
    			WHERE  a.EvalFormKey='" . $evalForm['EvalFormKey'] . "' $cond";
            $conn->query($query);
            $evalForms[$evalFormID]['CompletedFlag'] = 1;
            while ($row = $conn->fetch_array()) {
                $evalForms[$evalFormID]['EvalCount']++;
                if ($row['Completed'] == 0)
                    $evalForms[$evalFormID]['CompletedFlag'] = 0;
                $evalForms[$evalFormID]['SelfWeightedSum'] = $evalForms[$evalFormID]['SelfWeightedSum'] + $row['SelfWeighted'];
                $evalForms[$evalFormID]['Evaluated'][] = $row;
            }
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            $evalForms[$evalFormID]['Completed'] = $evalForms[$evalFormID]['CompletedFlag'];
            if ($evalForm['EvalCount'] > 0)
                $evalForms[$evalFormID]['SelfWeighted'] = number_format($evalForm['SelfWeightedSum'] / $evalForm['EvalCount'], 2, '.', '');
            else
                $evalForms[$evalFormID]['SelfWeighted'] = 0;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getEvalFormsEvaluator()
    {

        global $conn;
        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                default:
                    $cond .= "";
                    break;
            }
        }
        if (!empty($_GET['PersonID']))
            $cond .= " AND a.PersonID = '{$_GET['PersonID']}'";

        if (!empty($_GET['StartDate']))
            $cond .= " AND a.StartDate >= '{$_GET['StartDate']}'";

        if (!empty($_GET['EndDate']))
            $cond .= " AND a.EndDate <= '{$_GET['EndDate']}'";

        if (!empty($_GET['EvalFormDraftID']))
            $cond .= " AND a.EvalFormDraftID = '{$_GET['EvalFormDraftID']}'";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        if (empty($_SESSION['MANAGER']))
            $ManagerID = 0;
        else
            $ManagerID = $_SESSION['MANAGER'];

        $query = "SELECT COUNT(*) AS total FROM colleagues_eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			WHERE  1=1
    			AND (a.EvaluatorID = '{$_SESSION['PERS']}' OR a.ManagerID=$ManagerID OR a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY EvalFormKey";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $evalForms = array();
        $evalForms[0]['pageNo'] = $pageNo;
        $evalForms[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.StartDate ';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        $query = "SELECT * FROM colleagues_eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			WHERE  1=1
    			AND (a.EvaluatorID = '{$_SESSION['PERS']}' OR a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY EvalFormKey
    			ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            $query = "SELECT * FROM colleagues_eval_forms a
    			LEFT JOIN persons c ON a.EvaluatorID=c.PersonID
    			WHERE  a.EvalFormKey='" . $evalForm['EvalFormKey'] . "'
    			AND (a.EvaluatorID = '{$_SESSION['PERS']}' OR a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
            $conn->query($query);
            $evalForms[$evalFormID]['CompletedFlag'] = 1;
            while ($row = $conn->fetch_array()) {
                $evalForms[$evalFormID]['EvalCount']++;
                if ($row['Completed'] == 0)
                    $evalForms[$evalFormID]['CompletedFlag'] = 0;
                $evalForms[$evalFormID]['SelfWeightedSum'] = $evalForms[$evalFormID]['SelfWeightedSum'] + $row['SelfWeighted'];
                $evalForms[$evalFormID]['Evaluated'][] = $row;
            }
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            $evalForms[$evalFormID]['Completed'] = $evalForms[$evalFormID]['CompletedFlag'];
            if ($evalForm['EvalCount'] > 0)
                $evalForms[$evalFormID]['SelfWeighted'] = number_format($evalForm['SelfWeightedSum'] / $evalForm['EvalCount'], 2, '.', '');
            else
                $evalForms[$evalFormID]['SelfWeighted'] = 0;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getAllPersonsByFormsDraft()
    {
        global $conn;

        $query = "SELECT * FROM colleagues_eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			LEFT JOIN persons c ON a.PersonID=c.PersonID
    			GROUP BY c.PersonID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function completeEvalForm($CStatus, $EvalFormID)
    {
        global $conn;

        //Compute Weighted Mark
        $query = "SELECT Mark,q.Pondere AS Pondere,s.Pondere AS SPondere,s.SectionID, Mark*q.Pondere AS Nominator
					FROM colleagues_eval e
					      LEFT JOIN colleagues_eval_questions q ON q.EvalQuestionID=e.EvalQuestionID
					      LEFT JOIN colleagues_eval_sections s ON q.SectionID=s.SectionID
					WHERE e.EvalFormID=$EvalFormID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $qnom[$row['SectionID']] = $qnom[$row['SectionID']] + $row['Nominator'];
            $qdenom[$row['SectionID']] = $qdenom[$row['SectionID']] + $row['Pondere'];
            $snom[$row['SectionID']] = $row['SPondere'];

        }
        $sdenom += array_sum($snom);
        foreach ($qnom as $k => $v) {
            $nom += $snom[$k] * ($qnom[$k] / $qdenom[$k]);
        }
        $weighted = round($nom / $sdenom, 2);


        //update eval form
        $query = "UPDATE colleagues_eval_forms SET Completed=$CStatus, SelfWeighted=$weighted, CompletedDate=CURRENT_TIMESTAMP WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function deleteEvalForm($EvalFormID)
    {
        global $conn;

        $query = "DELETE FROM colleagues_eval_forms WHERE EvalFormID=$EvalFormID";
        $conn->query($query);

        $query = "DELETE FROM colleagues_eval WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function getEval($EvalFormID)
    {
        global $conn;
        //Utils::pa($_SESSION);
        $eval = array();
        /* AND (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond   */
        $query = "SELECT *,d.Name AS SectionName, b.Pondere AS Pondere, d.Pondere AS SPondere FROM colleagues_eval a
       			LEFT JOIN colleagues_eval_questions b ON a.EvalQuestionID=b.EvalQuestionID
       			LEFT JOIN colleagues_eval_forms c ON c.EvalFormID=a.EvalFormID
       			LEFT JOIN colleagues_eval_sections d ON b.SectionID=d.SectionID
    			WHERE  c.EvalFormID=$EvalFormID
			    AND (a.UserID = {$_SESSION['USER_ID']}  OR '{$_SESSION['USER_RIGHTS2'][25][1]}' > 1 OR c.PersonID = '{$_SESSION['PERS']}' OR c.EvaluatorID = '{$_SESSION['PERS']}' OR {$_SESSION['USER_ID']} = 1) $cond
    			ORDER  BY d.Priority,a.EvalQuestionID ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $eval[$row['SectionName']][$row['EvalID']] = $row;
            $eval['StartDate'] = $row['StartDate'];
            $eval['EndDate'] = $row['EndDate'];
        }

        return $eval;
    }

    public static function getPersonByForm($EvalFormID)
    {
        global $conn;

        $query = "SELECT b.PersonID FROM colleagues_eval a
       			LEFT JOIN colleagues_eval_forms b ON b.EvalFormID=a.EvalFormID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        $PersonID = $row['PersonID'];
        return $PersonID;
    }

    ########################    Evaluations Forms Personal  #######################################

    public static function getEvaluatorByForm($EvalFormID)
    {
        global $conn;

        $query = "SELECT b.EvaluatorID FROM colleagues_eval a
       			LEFT JOIN colleagues_eval_forms b ON b.EvalFormID=a.EvalFormID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        $EvaluatorID = $row['EvaluatorID'];
        return $EvaluatorID;
    }

########################    Evaluations Forms Personal  #######################################

    public static function getCompletedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Completed FROM colleagues_eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Completed'];
    }

    public static function editEval($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['Mark'] as $key => $mark) {
            $query = "UPDATE colleagues_eval SET Mark=$mark, Comment='" . $info['Comment'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public static function setSection()
    {

        global $conn;

        switch ($_GET['action']) {

            case 'new_section':
                $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
                $Name = $conn->real_escape_string($_GET['Name']);
                $Pondere = (int)$_GET['Pondere'];
                $Priority = (int)$_GET['Priority'];
                $Status = (int)$_GET['Status'];
                $conn->query("INSERT INTO colleagues_eval_sections(EvalFormDraftID,Name, Pondere, Priority, Status,CreateDate)
		                  VALUES('$EvalFormDraftID','$Name', '$Pondere', '$Priority', '$Status', CURRENT_TIMESTAMP)");
                break;

            case 'edit_section':
                $SectionID = (int)$_GET['SectionID'];
                $Name = $conn->real_escape_string($_GET['Name']);
                $Pondere = (int)$_GET['Pondere'];
                $Priority = (int)$_GET['Priority'];
                $Status = (int)$_GET['Status'];
                $conn->query("UPDATE colleagues_eval_sections SET
		                			    Name       = '$Name',
		                			   	Pondere    = '$Pondere',
		                			    Priority   = '$Priority',
		                			    Status     = '$Status',
		                			    CreateDate = CURRENT_TIMESTAMP
		                  WHERE SectionID = $SectionID");
                break;

            case 'del_section':
                $SectionID = (int)$_GET['SectionID'];
                $conn->query("DELETE FROM colleagues_eval_sections WHERE SectionID = $SectionID");
                break;
        }
    }

    public static function getFormDraftSections($EvalFormDraftID)
    {

        global $conn;

        $sections = array();
        $conn->query("SELECT * FROM colleagues_eval_sections WHERE EvalFormDraftID='$EvalFormDraftID'ORDER BY Priority ASC");
        while ($row = $conn->fetch_array()) {
            $sections[$row['SectionID']] = $row;
        }

        foreach ($sections as $sectionID => $section) {
            $query = "SELECT * FROM colleagues_eval_questions WHERE SectionID='$sectionID'";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $sections[$sectionID]['Questions'][] = $row;
            }

        }
        //Utils::pa($sections);
        return $sections;
    }

    ########################## Evaluation Data  ###############################

    public function getPersonsByFunction($FunctionID = 0)
    {

        global $conn;
        if ($FunctionID != 0)
            $cond = " AND b.FunctionID=$FunctionID";

        $conn->query("SELECT a.PersonID, a.FullName FROM persons a
    					LEFT JOIN payroll b ON a.PersonID=b.PersonID
    					LEFT JOIN functions c ON c.FunctionID=b.FunctionID
    					WHERE 1=1 $cond 
    					ORDER BY FullName");
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public function addEvalFormDraft($info = array())
    {

        global $conn;
        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("INSERT INTO colleagues_eval_forms_draft(UserID, FormName, CreateDate)
                      VALUES({$_SESSION['USER_ID']},'{$_POST['FormName']}', CURRENT_TIMESTAMP)");
        return $conn->get_insert_id();
    }

    public function setEvalToPerson($info = array())
    {

        global $conn;

        if (empty($info['EvalFormDraftID']) || $info['EvalFormDraftID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_FORM'));
        }
        if (empty($info['PersonID']) || $info['PersonID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_PERSON'));
        }
        if (empty($info['EvaluatorID']) || $info['EvaluatorID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_EVALUATOR'));
        }
        if (empty($info['StartDate'])) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (empty($info['EndDate'])) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        //Utils::pa($info);
        //exit;

        // Insert multiple evaluators data
        $conn->query("INSERT INTO colleagues_eval_forms_groups(EvalFormID, PersonID)
	                      VALUES(
	                      '$EvalFormID',
	                      '{$info['PersonID']}')
	                      ");
        $EvalFormPersonID = $conn->get_insert_id();

        foreach ($info['EvaluatorID'] as $EvaluatorID) {
            // assign an eval form to a person for every evaluator
            $conn->query("INSERT INTO colleagues_eval_forms(UserID, PersonID, EvaluatorID, ManagerID, EvalFormDraftID, RelationID, EvalFormKey, FormName, FunctionID, StartDate, EndDate, CreateDate)
                      VALUES({$_SESSION['USER_ID']},
                      '{$info['PersonID']}',
                      '$EvaluatorID',
                      (SELECT ManagerID FROM persons WHERE PersonID={$info['PersonID']}),
                      '{$info['EvalFormDraftID']}',
                      '{$info['RelationID']}',
                      '" . md5(date('s')) . "',
                      (SELECT FormName FROM colleagues_eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      '{$info['FunctionID']}' ,
                      '{$info['StartDate']}',
                      '{$info['EndDate']}',
                      CURRENT_TIMESTAMP)");
            $EvalFormID = $conn->get_insert_id();

            //Insert default questions to personal evaluation form
            $conn->query("INSERT INTO colleagues_eval(UserID, EvalQuestionID, EvalFormID)
							SELECT {$_SESSION['USER_ID']}, EvalQuestionID, $EvalFormID
                            FROM colleagues_eval_forms_draft a
                            LEFT JOIN colleagues_eval_questions b ON a.EvalFormDraftID=b.EvalFormDraftID
                            WHERE a.EvalFormDraftID={$info['EvalFormDraftID']}");
        }
        return $EvalFormID;
    }

    public function editEvalFormDraft($EvalFormDraftID, $info = array())
    {

        global $conn;

        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("UPDATE colleagues_eval_forms_draft SET
        				UserID={$_SESSION['USER_ID']},
        				FormName='{$_POST['FormName']}',
        				CreateDate=CURRENT_TIMESTAMP
        				WHERE EvalFormDraftID=$EvalFormDraftID");
    }

    public function deleteEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $conn->query("DELETE FROM colleagues_eval_forms_draft WHERE EvalFormDraftID=$EvalFormDraftID
        				AND NOT EXISTS(SELECT EvalFormID from colleagues_eval_forms WHERE EvalFormDraftID=$EvalFormDraftID)");
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Nu se poate sterge acest template de evaluare deoarece este deja utilizat!'); window.location.href = './?m=colleagues-eval&o=formsDraft';\"></body>";
            exit;
        }
    }

    ## Evaluation sections

    public function getEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $query = "SELECT * FROM colleagues_eval_forms_draft
                  WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM'));
        }
    }

    public function getAllEvalFormsDraft()
    {

        global $conn;

        $query = "SELECT * FROM colleagues_eval_forms_draft
                  WHERE  1=1 AND
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
        return $res;
    }


}

?>