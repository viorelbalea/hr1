<?php

class Evals
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

        if ($_SESSION['USER_SETTINGS'][8] == 2) {
            $cond .= " AND a.ManagerID = {$_SESSION['MANAGER']}";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   persons a
                          INNER JOIN address b ON a.AddressID = b.AddressID
                          INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                          INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                          INNER JOIN users g ON a.UserID = g.UserID
                   		  WHERE  (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][8][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
      			";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

//        $order_by    = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
//        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';


        /* WHERE  a.RoleID > 0 AND ('{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond*/
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
				  WHERE  (a.RoleID > 0 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][8][1]}' > 1 OR {$_SESSION['USER_ID']} = 1)) $cond
	              GROUP BY a.PersonID " .
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
	                     CASE WHEN '{$_SESSION['USER_SETTINGS'][8]}' = 1 AND $PersonID = '{$_SESSION['PERS']}' THEN 1 = 1
	                          WHEN '{$_SESSION['USER_SETTINGS'][8]}' = 2 AND ($PersonID = '{$_SESSION['PERS']}' OR ManagerID = '{$_SESSION['PERS']}') THEN 1 = 1
	                          WHEN '{$_SESSION['USER_SETTINGS'][8]}' = 3 OR {$_SESSION['USER_ID']} = 1 THEN 1 = 1
	                          ELSE 1 = 0
	                     END");
        return ($row = $conn->fetch_array()) ? $row['FullName'] : false;
    }


    #####################   Evaluation FORMS Draft  ##########

    public static function getPersonsByFunction($FunctionID = 0)
    {

        global $conn;
        if ($FunctionID != 0)
            $cond = " AND b.FunctionID=$FunctionID";
        $query = "SELECT a.PersonID, a.FullName FROM persons a
    					LEFT JOIN payroll b ON a.PersonID=b.PersonID
    					LEFT JOIN functions c ON c.FunctionID=b.FunctionID
    					WHERE 1=1 $cond
    					ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public static function getPersonsByInternalFunction($FunctionID = 0)
    {

        global $conn;
        if ($FunctionID != 0)
            $cond = " AND b.InternalFunction=$FunctionID";
        $query = "SELECT a.PersonID, a.FullName FROM persons a
    					LEFT JOIN payroll b ON a.PersonID=b.PersonID
    					LEFT JOIN internal_functions c ON c.FunctionID=b.InternalFunction
    					WHERE 1=1 $cond
    					ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public static function cloneEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $txClone = '[FORMULAR CLONAT] ';

        $query = "INSERT INTO eval_forms_draft (UserID,FormName,CreateDate)
       				SELECT UserID,CONCAT_WS('','$txClone',FormName),CURRENT_TIMESTAMP FROM eval_forms_draft
                  	WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                    (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        $newEvalDraftID = $conn->get_insert_id();

        $query = "SELECT * FROM eval_sections a
    			WHERE  a.EvalFormDraftID=$EvalFormDraftID";
        $r1 = $conn->query($query);
        while ($row = $conn->fetch_array($r1)) {
            // Insert new sections
            $query2 = "INSERT INTO eval_sections SET
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
            $query3 = "SELECT * FROM eval_questions a
	    			WHERE  a.EvalFormDraftID=$EvalFormDraftID
	    			AND a.SectionID='{$row['SectionID']}'";
            $r3 = $conn->query($query3);
            while ($row3 = $conn->fetch_array($r3)) {
                $query4 = "INSERT INTO eval_questions SET
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
				FROM eval_forms_draft a
    			LEFT JOIN eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
    			WHERE (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $news = array();
        $res[0]['pageNo'] = $pageNo;
        $res[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.EvalFormDraftID';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.EvalFormDraftID, a.FormName, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS CreateDate,(SELECT COUNT(*) FROM eval_forms WHERE EvalFormDraftID=a.EvalFormDraftID) AS AssignedForms
    			FROM eval_forms_draft a
    			LEFT JOIN eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
    			WHERE (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
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

        $query = "SELECT COUNT(EvalFormID) AS EvalSum,c.PersonID,c.FullName FROM eval_forms_draft a
				INNER JOIN eval_forms b ON a.EvalFormDraftID=b.EvalFormDraftID
				INNER JOIN persons c ON c.PersonID=b.PersonID
				WHERE a.EvalFormDraftID='$EvalFormDraftID'
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
            $conn->query("DELETE FROM eval_questions
                          WHERE  EvalQuestionID = $EvalQuestionID AND
                                 NOT EXISTS(SELECT EvalQuestionID FROM eval WHERE EvalQuestionID = $EvalQuestionID)");
            if (!$conn->get_affected_rows()) {
                $conn->query("SELECT EvalFormDraftID FROM eval_questions WHERE EvalQuestionID = $EvalQuestionID");
                $row = $conn->fetch_array();
                $EvalFormDraftID = $row['EvalFormDraftID'];
                echo "<body onload=\"alert('Nu se poate sterge aceasta intrebare deoarece este deja utilizata!'); window.location.href = './?m=eval&o=evalDraft&EvalFormDraftID=" . $EvalFormDraftID . "&action=edit';\"></body>";
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
                $conn->query("UPDATE eval_questions SET Question = '$Question', Pondere = '$Pondere', SectionID=$SectionID WHERE EvalQuestionID = $EvalQuestionID");
            } else {
                $conn->query("INSERT INTO eval_questions(UserID,EvalFormDraftID, Question, Pondere, SectionID) VALUES('{$_SESSION['USER_ID']}', '{$_GET['EvalFormDraftID']}','$Question', '$Pondere', $SectionID)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_QUESTION'));
            }
        }
    }

    public static function getEvalQuestions($EvalFormDraftID)
    {

        global $conn;
        $query = "SELECT *,a.Pondere AS Pondere FROM eval_questions a
    			INNER JOIN eval_sections b ON a.SectionID=b.SectionID
    			WHERE  a.EvalFormDraftID=$EvalFormDraftID
    			AND (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1)
    			ORDER BY b.Priority ASC,a.EvalQuestionID ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalQuestions[$row['EvalQuestionID']] = $row;
        }
        //Utils::pa($evalQuestions);
        // exit;
        return $evalQuestions;
    }

    public static function getEvalForms($PersonID)
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

        if (is_numeric($_GET['Completed']))
            $cond .= " AND a.Completed = '{$_GET['Completed']}'";

        if (!empty($_GET['EvalFormDraftID']))
            $cond .= " AND a.EvalFormDraftID = '{$_GET['EvalFormDraftID']}'";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        if (empty($_SESSION['MANAGER']))
            $ManagerID = 0;
        else
            $ManagerID = $_SESSION['MANAGER'];

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";

        $query = "SELECT COUNT(*) AS total FROM eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			WHERE  1=1";
        if ($_SESSION['USER_ID'] != 1) {
            $query .= " AND ((a.PersonID = '{$_SESSION['PERS']}' OR a.UserID = '{$_SESSION['USER_ID']}' ) 
    										$condmng
    										OR a.PersonID IN (SELECT DISTINCT PersonID FROM persons WHERE ManagerID = '{$_SESSION['PERS']}' OR ManagerID2 = '{$_SESSION['PERS']}'))";
        }
//                $query .= " AND (a.ManagerID=$ManagerID OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][8][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $query .= $cond;
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $evalForms = array();
        $evalForms[0]['pageNo'] = $pageNo;
        $evalForms[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.StartDate ';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        $query = "SELECT a.*, b.*, c.*,e.Function AS InternalFunction FROM eval_forms a
    			LEFT JOIN functions b ON a.FunctionID=b.FunctionID
    			LEFT JOIN persons c ON a.PersonID=c.PersonID
    			LEFT JOIN payroll d ON a.PersonID=d.PersonID
    			LEFT JOIN internal_functions e ON d.InternalFunction=e.FunctionID
    			WHERE  1=1";
        if ($_SESSION['USER_ID'] != 1) {
            //$query .= " AND (a.PersonID = '{$_SESSION['PERS']}' OR a.UserID = '{$_SESSION['USER_ID']}' OR a.PersonID IN (SELECT DISTINCT PersonID FROM persons WHERE ManagerID = '{$_SESSION['PERS']}' OR ManagerID2 = '{$_SESSION['PERS']}'))";
            $query .= " AND ((a.PersonID = '{$_SESSION['PERS']}' OR a.UserID = '{$_SESSION['USER_ID']}' ) 
    										$condmng
    										OR a.PersonID IN (SELECT DISTINCT PersonID FROM persons WHERE ManagerID = '{$_SESSION['PERS']}' OR ManagerID2 = '{$_SESSION['PERS']}'))";
        }
//        $query .= " AND (a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][8][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $query .= $cond;
        $query .= " ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getAllPersonsByFormsDraft()
    {
        global $conn;

        $query = "SELECT * FROM eval_forms a
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
					FROM eval e
					      LEFT JOIN eval_questions q ON q.EvalQuestionID=e.EvalQuestionID
					      LEFT JOIN eval_sections s ON q.SectionID=s.SectionID
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
        $query = "UPDATE eval_forms SET Completed=$CStatus, SelfWeighted=$weighted, CompletedDate=CURRENT_TIMESTAMP WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function approveEvalForm($AStatus, $EvalFormID)
    {
        global $conn;

        //Compute Weighted Mark
        $query = "SELECT ManagerMark,q.Pondere AS Pondere,s.Pondere AS SPondere,s.SectionID, ManagerMark*q.Pondere AS Nominator
					FROM eval e
					      LEFT JOIN eval_questions q ON q.EvalQuestionID=e.EvalQuestionID
					      LEFT JOIN eval_sections s ON q.SectionID=s.SectionID
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
        $query = "UPDATE eval_forms SET Approved=$AStatus, ManagerWeighted=$weighted, ApprovedDate=CURRENT_TIMESTAMP WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function approveEvalForm2($AStatus, $EvalFormID)
    {
        global $conn;

        //Compute Weighted Mark
        $query = "SELECT ManagerMark2,q.Pondere AS Pondere,s.Pondere AS SPondere,s.SectionID, ManagerMark2*q.Pondere AS Nominator
					FROM eval e
					      LEFT JOIN eval_questions q ON q.EvalQuestionID=e.EvalQuestionID
					      LEFT JOIN eval_sections s ON q.SectionID=s.SectionID
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
        $query = "UPDATE eval_forms SET Approved2=$AStatus, ManagerWeighted2=$weighted, ApprovedDate2=CURRENT_TIMESTAMP WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function mediateEvalForm($AStatus, $EvalFormID)
    {
        global $conn;

        //Compute Weighted Mark
        $query = "SELECT MediatorMark,q.Pondere AS Pondere,s.Pondere AS SPondere,s.SectionID, MediatorMark*q.Pondere AS Nominator
					FROM eval e
					      LEFT JOIN eval_questions q ON q.EvalQuestionID=e.EvalQuestionID
					      LEFT JOIN eval_sections s ON q.SectionID=s.SectionID
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
        $query = "UPDATE eval_forms SET Mediated=$AStatus, MediatorWeighted=$weighted, ApprovedDate=CURRENT_TIMESTAMP WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    ########################    Evaluations Forms  #######################################

    public static function showResultsForm($ShowResults, $EvalFormID)
    {
        global $conn;

        $conn->query("UPDATE eval_forms SET ShowResults=$ShowResults WHERE EvalFormID=$EvalFormID");
    }

    public static function getEvaluatorRank($PersonID, $evalPersonID)
    {
        global $conn;
        $conn->query("SELECT ManagerID, ManagerID2 FROM persons WHERE PersonID=$evalPersonID");
        $row = $conn->fetch_array();
        if ($row['ManagerID'] == $PersonID) {
            return 1;
        } elseif ($row['ManagerID2'] == $PersonID) {
            return 2;
        } else {
            return 0;
        }
    }

    public static function setMediation($EvalFormID)
    {
        global $conn;

        $query = "UPDATE eval_forms SET Mediated={$_GET['Status']} WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function deleteEvalForm($EvalFormID)
    {
        global $conn;

        $query = "DELETE FROM eval_forms WHERE EvalFormID=$EvalFormID";
        $conn->query($query);

        $query = "DELETE FROM eval WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    public static function getEval($EvalFormID)
    {
        global $conn;
        //Utils::pa($_SESSION);
        $eval = array();
        /* AND (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond   */
        $query = "SELECT *,d.Name AS SectionName, b.Pondere AS Pondere, d.Pondere AS SPondere FROM eval a
       			LEFT JOIN eval_questions b ON a.EvalQuestionID=b.EvalQuestionID
       			LEFT JOIN eval_forms c ON c.EvalFormID=a.EvalFormID
       			LEFT JOIN eval_sections d ON b.SectionID=d.SectionID
    			WHERE  c.EvalFormID=$EvalFormID
			    AND (a.UserID = {$_SESSION['USER_ID']}  OR '{$_SESSION['USER_RIGHTS2'][8][1]}' > 1 OR c.PersonID = '{$_SESSION['PERS']}' OR {$_SESSION['USER_ID']} = 1) $cond
    			ORDER  BY d.Priority,a.EvalQuestionID ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $eval[$row['SectionName']][$row['EvalID']] = $row;
            $eval['StartDate'] = $row['StartDate'];
            $eval['EndDate'] = $row['EndDate'];
            $eval['FormCode'] = $row['FormCode'];
            $eval['FormDesc'] = $row['FormDesc'];
        }

        return $eval;
    }

    public static function getPersonByForm($EvalFormID)
    {
        global $conn;

        $query = "SELECT b.PersonID FROM eval a
       			LEFT JOIN eval_forms b ON b.EvalFormID=a.EvalFormID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        $PersonID = $row['PersonID'];
        return $PersonID;
    }

    public static function getPersonDataByForm($EvalFormID)
    {
        global $conn;

        $query = "SELECT b.PersonID, c.*  FROM eval a
       			LEFT JOIN eval_forms b ON b.EvalFormID=a.EvalFormID
       			LEFT JOIN persons c ON b.PersonID=c.PersonID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        return $row;
    }

    public static function getCompletedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Completed FROM eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Completed'];
    }

    public static function getApprovedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Approved FROM eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Approved'];
    }

    public static function getSecondaryApprovedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Approved2 FROM eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Approved2'];
    }

    ########################## Evaluation Data  ###############################

    public static function getMediatedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Mediated FROM eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Mediated'];
    }

    public static function getShowResults($EvalFormID)
    {
        global $conn;
        $conn->query("SELECT ShowResults FROM eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['ShowResults'];
    }

    public static function editEval($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['Mark'] as $key => $mark) {
            $query = "UPDATE eval SET Mark=$mark, Comment='" . $info['Comment'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public static function editEvalByManager($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['ManagerMark'] as $key => $mark) {
            $query = "UPDATE eval SET ManagerMark=$mark, ManagerComment='" . $info['ManagerComment'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public static function editEvalByManager2($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['ManagerMark2'] as $key => $mark) {
            $query = "UPDATE eval SET ManagerMark2=$mark, ManagerComment2='" . $info['ManagerComment2'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public static function editEvalByMediator($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['MediatorMark'] as $key => $mark) {
            $query = "UPDATE eval SET MediatorMark=$mark, MediatorComment='" . $info['MediatorComment'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public static function isEvalManager($EvalFormID)
    {
        global $conn;

        $query = "SELECT * FROM eval_forms WHERE
						 EvalFormID=$EvalFormID AND
						(ManagerID={$_SESSION['MANAGER']} OR UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->get_num_rows() > 0)
            return true;
        return false;
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
                $conn->query("INSERT INTO eval_sections(EvalFormDraftID,Name, Pondere, Priority, Status,CreateDate)
		                  VALUES('$EvalFormDraftID','$Name', '$Pondere', '$Priority', '$Status', CURRENT_TIMESTAMP)");
                break;

            case 'edit_section':
                $SectionID = (int)$_GET['SectionID'];
                $Name = $conn->real_escape_string($_GET['Name']);
                $Pondere = (int)$_GET['Pondere'];
                $Priority = (int)$_GET['Priority'];
                $Status = (int)$_GET['Status'];
                $conn->query("UPDATE eval_sections SET
		                			    Name       = '$Name',
		                			   	Pondere    = '$Pondere',
		                			    Priority   = '$Priority',
		                			    Status     = '$Status',
		                			    CreateDate = CURRENT_TIMESTAMP
		                  WHERE SectionID = $SectionID");
                break;

            case 'del_section':
                $SectionID = (int)$_GET['SectionID'];
                $conn->query("DELETE FROM eval_sections WHERE SectionID = $SectionID");
                $conn->query("DELETE FROM eval_questions WHERE SectionID = $SectionID");
                break;
        }
    }

    public static function getSections()
    {

        global $conn;
        $SectionID = (int)$_GET['SectionID'];
        $sections = array();
        $conn->query("SELECT * FROM eval_sections ORDER BY Priority ASC");
        while ($row = $conn->fetch_array()) {
            $sections[] = $row;
        }
        return $sections;
    }

    public static function getFormDraftSections($EvalFormDraftID)
    {

        global $conn;

        $sections = array();
        $conn->query("SELECT * FROM eval_sections WHERE EvalFormDraftID='$EvalFormDraftID'ORDER BY Priority ASC");
        while ($row = $conn->fetch_array()) {
            $sections[$row['SectionID']] = $row;
        }

        foreach ($sections as $sectionID => $section) {
            $query = "SELECT * FROM eval_questions WHERE SectionID='$sectionID'";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $sections[$sectionID]['Questions'][] = $row;
            }

        }
        //Utils::pa($sections);
        return $sections;
    }

    public static function generateEvalGraph($DraftID, $PersonID)
    {
        include("chart/pChart/pData.php");
        include("chart/pChart/pChart.php");

        global $conn;

        $StartDate = (!empty($_GET['StartDate']) ? $conn->real_escape_string(($_GET['StartDate'])) : '');
        $EndDate = (!empty($_GET['EndDate']) ? $conn->real_escape_string(($_GET['EndDate'])) : '');


        $DataSet = new pData;

        $query = "SELECT StartDate, SelfWeighted, ManagerWeighted, ManagerWeighted2, MediatorWeighted 
                        FROM eval_forms WHERE Completed = 1 AND EvalFormDraftID = {$DraftID}
                        AND PersonID = {$PersonID}";

        if (!empty($StartDate)) {
            $query .= " AND StartDate >= '{$StartDate}'";
        }
        if (!empty($EndDate)) {
            $query .= " AND StartDate <= '{$EndDate}'";
        }

        $query .= " ORDER BY StartDate";

        $conn->query($query);

        $self = $manager = $manager2 = $avg = $mediator = $dates = array();

        while ($row = $conn->fetch_array()) {
            $self[] = !empty($row['SelfWeighted']) ? $row['SelfWeighted'] : 0;
            $manager[] = !empty($row['ManagerWeighted']) ? $row['ManagerWeighted'] : 0;
            $manager2[] = !empty($row['ManagerWeighted2']) ? $row['ManagerWeighted2'] : 0;
            if (!empty($row['ManagerWeighted']) && !empty($row['ManagerWeighted2'])) {
                $avg[] = round(($row['ManagerWeighted'] + $row['ManagerWeighted2']) / 2, 2);
            } elseif (!empty($row['ManagerWeighted'])) {
                $avg[] = $row['ManagerWeighted'];
            } elseif (!empty($row['ManagerWeighted2'])) {
                $avg[] = $row['ManagerWeighted2'];
            } else {
                $avg[] = 0;
            }
            $mediator[] = !empty($row['MediatorWeighted']) ? $row['MediatorWeighted'] : 0;
            $dates[] = $row['StartDate'];
        }
        if (!empty($self) || !empty($manager) || !empty($mediator)) {
            if (!empty($self)) {
                $DataSet->AddPoint($self, 1);
                $DataSet->AddSerie(1);
                $DataSet->SetSerieName("Autoevaluare", 1);
            }

            if (!empty($manager)) {
                $DataSet->AddPoint($manager, 2);
                $DataSet->AddSerie(2);
                $DataSet->SetSerieName("Evaluator I", 2);
            }

            if (!empty($manager2)) {
                $DataSet->AddPoint($manager2, 4);
                $DataSet->AddSerie(4);
                $DataSet->SetSerieName("Evaluator II", 4);
            }

            if (!empty($avg)) {
                $DataSet->AddPoint($avg, 5);
                $DataSet->AddSerie(5);
                $DataSet->SetSerieName("Medie evaluatori", 5);
            }

            if (!empty($mediator)) {
                $DataSet->AddPoint($mediator, 3);
                $DataSet->AddSerie(3);
                $DataSet->SetSerieName("Mediator", 3);
            }
            $DataSet->AddPoint($dates, "XLabels");
            $DataSet->SetAbsciseLabelSerie("XLabels");
            $DataSet->SetYAxisName("Medie");
            $DataSet->SetXAxisName("Data");


            // Initialise the graph
            $Test = new pChart(700, 610);
            $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
            $Test->setGraphArea(85, 30, 650, 220);
            $Test->drawFilledRoundedRectangle(7, 7, 693, 223, 5, 240, 240, 240);
            $Test->drawRoundedRectangle(5, 5, 695, 225, 5, 230, 230, 230);
            $Test->drawGraphArea(255, 255, 255, TRUE);
            $Test->drawScale($DataSet->GetData(), $DataSet->GetDataDescription(), SCALE_NORMAL, 150, 150, 150, TRUE, 0, 2);
            $Test->drawGrid(4, TRUE, 230, 230, 230, 50);

            // Draw the 0 line
            $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 6);
            $Test->drawTreshold(0, 143, 55, 72, TRUE, TRUE);

            // Draw the line graph
            $Test->drawLineGraph($DataSet->GetData(), $DataSet->GetDataDescription());
            $Test->drawPlotGraph($DataSet->GetData(), $DataSet->GetDataDescription(), 3, 2, 255, 255, 255);

            // Finish the graph
            $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 8);
            $Test->drawLegend(5, 260, $DataSet->GetDataDescription(), 255, 255, 255);
            $Test->setFontProperties("libs/chart/Fonts/tahoma.ttf", 10);
            $Test->drawTitle(60, 22, "Evaluare", 50, 50, 50, 585);
            $Test->Render("graphs/eval_graph.png");

            return "graphs/eval_graph.png";
        }

    }

    public function addEvalFormDraft($info = array())
    {

        global $conn;
        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("INSERT INTO eval_forms_draft(UserID, FormName, FormCode, FormDesc, CreateDate)
                      VALUES({$_SESSION['USER_ID']}, '{$_POST['FormName']}', '{$_POST['FormCode']}', '{$_POST['FormDesc']}', CURRENT_TIMESTAMP)");
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
        if (empty($info['StartDate'])) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (empty($info['EndDate'])) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        foreach ($info['PersonID'] as $PersonID) {
            // assing an eval form to a person
            $conn->query("INSERT INTO eval_forms(UserID, PersonID, ManagerID, EvalFormDraftID, FormName, FormCode, FormDesc, FunctionID, StartDate, EndDate, CreateDate)
	                      VALUES({$_SESSION['USER_ID']},
	                      '$PersonID',
	                      (SELECT ManagerID FROM persons WHERE PersonID=$PersonID),
	                      '{$info['EvalFormDraftID']}',
	                      (SELECT FormName FROM eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      (SELECT FormCode FROM eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      (SELECT FormDesc FROM eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      '{$info['FunctionID']}' ,
	                      '{$info['StartDate']}',
	                      '{$info['EndDate']}',
	                      CURRENT_TIMESTAMP)");
            $EvalFormID = $conn->get_insert_id();

            //Insert default questions to personal evaluation form
            $conn->query("INSERT INTO eval(UserID, EvalQuestionID, EvalFormID)
							SELECT {$_SESSION['USER_ID']}, EvalQuestionID, $EvalFormID
                            FROM eval_forms_draft a
                            LEFT JOIN eval_questions b ON a.EvalFormDraftID=b.EvalFormDraftID
                            WHERE a.EvalFormDraftID={$info['EvalFormDraftID']}");
        }
        return $EvalFormID;
    }

    ## Evaluation sections

    public function editEvalFormDraft($EvalFormDraftID, $info = array())
    {

        global $conn;

        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("UPDATE eval_forms_draft SET
        				UserID={$_SESSION['USER_ID']},
        				FormName='{$_POST['FormName']}',
                                        FormCode='{$_POST['FormCode']}',
                                        FormDesc='{$_POST['FormDesc']}',
        				CreateDate=CURRENT_TIMESTAMP
        				WHERE EvalFormDraftID=$EvalFormDraftID");
    }

    public function deleteEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $conn->query("DELETE FROM eval_forms_draft WHERE EvalFormDraftID=$EvalFormDraftID
        				AND NOT EXISTS(SELECT EvalFormID from eval_forms WHERE EvalFormDraftID=$EvalFormDraftID)");
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Nu se poate sterge acest template de evaluare deoarece este deja utilizat!'); window.location.href = './?m=eval&o=formsDraft';\"></body>";
            exit;
        }
    }

    public function getEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $query = "SELECT * FROM eval_forms_draft
                  WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
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

        $query = "SELECT * FROM eval_forms_draft
                  WHERE  1=1 AND
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][8]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
        return $res;
    }


}

?>