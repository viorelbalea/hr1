<?php

class Training extends ConfigData
{

    private $TrainingID;

    public function __construct($TrainingID = 0)
    {
        if ($TrainingID > 0) {
            $this->TrainingID = $TrainingID;
        }
    }

    public static function getPersonsByTraining($TrainingID)
    {

        global $conn;

        $query = "SELECT * FROM   training_persons a
        			LEFT JOIN persons b ON a.PersonID=b.PersonID
                  WHERE  TrainingID = $TrainingID
                  GROUP BY b.PersonID
                  ORDER BY b.FullName";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row;
        }
        return $persons;
    }

    public static function getTrainings()
    {

        global $conn;
        $cond = '';
        $query = "SELECT * FROM trainings a 
				  LEFT JOIN persons b ON a.PersonID = b.PersonID
					ORDER BY TrainingName ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['TrainingID']] = $row;
        }

        return $res;
    }

    public static function getAllTrainings($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'TrainingName';
                    $cond .= " AND a.TrainingName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'Trainer';
                    $cond .= " AND (c.FullName LIKE '{$_GET['keyword']}%' OR c2.ContactName LIKE '{$_GET['keyword']}%')";
                    break;
                default:
                    $cond .= " AND b.CompanyName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND e.DistrictID = " . (int)$_GET['DistrictID'];
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND d.CityID = " . (int)$_GET['CityID'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                 FROM   trainings a
                        INNER JOIN companies b ON a.CompanyID = b.CompanyID
                        LEFT JOIN persons c ON a.PersonID = c.PersonID
			LEFT JOIN companies_contacts c2 ON a.PersonID = c2.ContactID
                        LEFT JOIN address_city d ON a.CityID = d.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                        LEFT JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                        INNER JOIN jobsdomain f ON b.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                        LEFT JOIN users g ON a.UserID = g.UserID
                 WHERE  (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $trainings = array();
        $trainings[0]['pageNo'] = $pageNo;
        $trainings[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('TrainingName', 'CompanyName', 'FullName', 'DistrictName', 'CityName', 'Domain', 'StartDate', 'StopDate', 'Status')) ? $_GET['order_by'] : 'a.TrainingName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.CompanyName, d.CityName, e.DistrictName, f.Domain, g.UserName,
	                     CASE WHEN a.Type = 1 THEN c.FullName ELSE c2.ContactName END AS FullName
	              FROM   trainings a
                       INNER JOIN companies b ON a.CompanyID = b.CompanyID
                       LEFT JOIN persons c ON a.PersonID = c.PersonID
		       LEFT JOIN companies_contacts c2 ON a.PersonID = c2.ContactID
                       LEFT JOIN address_city d ON a.CityID = d.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       LEFT JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                       INNER JOIN jobsdomain f ON b.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                       LEFT JOIN users g ON a.UserID = g.UserID
                WHERE  (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
	              ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if ($row['Type'] == 0) $row['Type'] = 'Extern';
            elseif ($row['Type'] == 1) $row['Type'] = 'Intern';
            $trainings[$row['TrainingID']] = $row;
        }

        return $trainings;
    }

    public static function getTypes()
    {

        global $conn;

        $conn->query("SELECT TrainingTypeID, TrainingType FROM training_types ORDER BY TrainingType");
        $types = array();
        while ($row = $conn->fetch_array()) {
            $types[$row['TrainingTypeID']] = $row['TrainingType'];
        }
        return $types;
    }

    public static function setType($TrainingTypeID)
    {

        global $conn;

        if ($TrainingTypeID > 0 && !empty($_GET['delTrainingType'])) {
            $conn->query("DELETE FROM training_types
                          WHERE  TrainingTypeID = $TrainingTypeID AND                              
                                 NOT EXISTS(SELECT TrainingTypeID FROM companies_training_type WHERE TrainingTypeID = $TrainingTypeID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest tip de training deoarece este deja utilizat!'); window.location.href = './?m=dictionary&o=training_type';\"></body>";
                exit;
            }

        } else {

            $TrainingType = Utils::formatStr($_GET['TrainingType']);

            if ($TrainingTypeID > 0) {
                $conn->query("UPDATE training_types SET TrainingType = '$TrainingType' WHERE TrainingTypeID = $TrainingTypeID");
            } else {
                $conn->query("INSERT INTO training_types(TrainingType, CreateDate) VALUES('$TrainingType', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getAllCompanies($action = '')
    {

        global $conn;

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CIF';
                    $cond .= " AND a.CIF LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.CompanyName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                 FROM   companies a
                        INNER JOIN address b ON a.AddressID = b.AddressID
                        INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                        INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                        INNER JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                        INNER JOIN users g ON a.UserID = g.UserID
                 WHERE  (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) AND a.isTrainer = 1 $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $companies = array();
        $companies[0]['pageNo'] = $pageNo;
        $companies[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('CompanyName', 'DistrictName', 'CityName', 'Domain', 'CIF')) ? $_GET['order_by'] : 'a.CompanyName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName, f.Domain, g.UserName
	              FROM   companies a
	                     INNER JOIN address b ON a.AddressID = b.AddressID
                       INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                       INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
                       INNER JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                       INNER JOIN users g ON a.UserID = g.UserID
               	WHERE  (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) AND a.isTrainer = 1 $cond
	              ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row;
        }

        return $companies;
    }

    public static function getFormDraftSections($EvalFormDraftID)
    {

        global $conn;

        $sections = array();
        $conn->query("SELECT * FROM training_eval_sections WHERE EvalFormDraftID='$EvalFormDraftID'ORDER BY Priority ASC");
        while ($row = $conn->fetch_array()) {
            $sections[$row['SectionID']] = $row;
        }

        foreach ($sections as $sectionID => $section) {
            $query = "SELECT * FROM training_eval_questions WHERE SectionID='$sectionID'";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $sections[$sectionID]['Questions'][] = $row;
            }

        }
        return $sections;
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
                $conn->query("INSERT INTO training_eval_sections(EvalFormDraftID,Name, Pondere, Priority, Status,CreateDate)
		                  VALUES('$EvalFormDraftID','$Name', '$Pondere', '$Priority', '$Status', CURRENT_TIMESTAMP)");
                break;

            case 'edit_section':
                $SectionID = (int)$_GET['SectionID'];
                $Name = $conn->real_escape_string($_GET['Name']);
                $Pondere = (int)$_GET['Pondere'];
                $Priority = (int)$_GET['Priority'];
                $Status = (int)$_GET['Status'];
                $conn->query("UPDATE training_eval_sections SET
		                			    Name       = '$Name',
		                			   	Pondere    = '$Pondere',
		                			    Priority   = '$Priority',
		                			    Status     = '$Status',
		                			    CreateDate = CURRENT_TIMESTAMP
		                  WHERE SectionID = $SectionID");
                break;

            case 'del_section':
                $SectionID = (int)$_GET['SectionID'];
                $conn->query("DELETE FROM training_eval_sections WHERE SectionID = $SectionID");
                break;
        }
    }

    public static function addEvalQuestion($EvalQuestionID)
    {

        global $conn;

        if ($EvalQuestionID > 0 && $_GET['action'] == 'del_question') {
            $conn->query("DELETE FROM training_eval_questions
                          WHERE  EvalQuestionID = $EvalQuestionID AND
                                 NOT EXISTS(SELECT EvalQuestionID FROM training_eval WHERE EvalQuestionID = $EvalQuestionID)");
            if (!$conn->get_affected_rows()) {
                $conn->query("SELECT EvalFormDraftID FROM training_eval_questions WHERE EvalQuestionID = $EvalQuestionID");
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
                $conn->query("UPDATE training_eval_questions SET Question = '$Question', Pondere = '$Pondere', SectionID=$SectionID WHERE EvalQuestionID = $EvalQuestionID");
            } else {
                $conn->query("INSERT INTO training_eval_questions(UserID,EvalFormDraftID, Question, Pondere, SectionID) VALUES('{$_SESSION['USER_ID']}', '{$_GET['EvalFormDraftID']}','$Question', '$Pondere', $SectionID)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_QUESTION'));
            }
        }
    }

    public static function cloneEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $txClone = '[FORMULAR CLONAT] ';

        $query = "INSERT INTO training_eval_forms_draft (UserID,FormName,CreateDate)
       				SELECT UserID,CONCAT_WS('','$txClone',FormName),CURRENT_TIMESTAMP FROM training_eval_forms_draft
                  	WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                    (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][5]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        $newEvalDraftID = $conn->get_insert_id();

        $query = "SELECT * FROM training_eval_sections a
    			WHERE  a.EvalFormDraftID=$EvalFormDraftID";
        $r1 = $conn->query($query);
        while ($row = $conn->fetch_array($r1)) {
            // Insert new sections
            $query2 = "INSERT INTO training_eval_sections SET
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
            $query3 = "SELECT * FROM training_eval_questions a
	    			WHERE  a.EvalFormDraftID=$EvalFormDraftID
	    			AND a.SectionID='{$row['SectionID']}'";
            $r3 = $conn->query($query3);
            while ($row3 = $conn->fetch_array($r3)) {
                $query4 = "INSERT INTO training_eval_questions SET
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
				FROM training_eval_forms_draft a
    			LEFT JOIN training_eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
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

        $query = "SELECT a.EvalFormDraftID, a.FormName, a.CreateDate, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS CreateDate, a.Type,(SELECT COUNT(*) FROM training_eval_forms WHERE EvalFormDraftID=a.EvalFormDraftID) AS AssignedForms
    			FROM training_eval_forms_draft a
    			LEFT JOIN training_eval_forms c ON a.EvalFormDraftID=c.EvalFormDraftID
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

    public static function getAllPersonsByFormsDraft()
    {
        global $conn;

        $query = "SELECT * FROM training_eval_forms a
    			LEFT JOIN persons c ON a.PersonID=c.PersonID
    			GROUP BY c.PersonID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getEvalFormsTrainee()
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

        $query = "SELECT COUNT(*) AS total FROM training_eval_forms a
    			WHERE  a.Type=1
    			AND (a.ManagerID=$ManagerID OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $evalForms = array();
        $evalForms[0]['pageNo'] = $pageNo;
        $evalForms[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.StartDate ';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';


        $query = "SELECT *, b.FullName AS PersonName, c.FullName AS EvaluatorName FROM training_eval_forms a
    		    LEFT JOIN persons b ON a.PersonID=b.PersonID
    		    LEFT JOIN persons c ON a.EvaluatorID=c.PersonID
    			WHERE  a.Type=1
    			AND (a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getPersonsEvaluateFromEvalFormsTrainee()
    {

        global $conn;

        $persons = array();

        $query = "SELECT PersonID, FullName
                FROM   persons
                WHERE
		       PersonID IN (SELECT DISTINCT PersonID FROM training_eval_forms WHERE type = 1)
                ORDER  BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function getEvalFormsTrainer()
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

        $query = "SELECT COUNT(*) AS total FROM training_eval_forms a
    			WHERE  a.Type=2
    			AND (a.ManagerID=$ManagerID OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
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

        $query = "SELECT * FROM training_eval_forms a
    			LEFT JOIN persons b ON a.PersonID=b.PersonID
    			WHERE  a.Type=2
    			AND (a.ManagerID='{$_SESSION['PERS']}' OR a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond
    			GROUP BY EvalFormKey
    			ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $evalForms[$row['EvalFormID']] = $row;
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            if (!empty($evalForm['EvalFormKey'])) {
                $query = "SELECT * FROM training_eval_forms a
	    			LEFT JOIN persons c ON a.EvaluatorID=c.PersonID
	    			WHERE  a.EvalFormKey='" . $evalForm['EvalFormKey'] . "' $cond";
                $conn->query($query);
                $evalForms[$evalFormID]['CompletedFlag'] = 1;
                while ($row = $conn->fetch_array()) {
                    $evalForms[$evalFormID]['EvalCount']++;
                    if ($row['Completed'] == 0)
                        $evalForms[$evalFormID]['CompletedFlag'] = 0;
                    $evalForms[$evalFormID]['WeightedSum'] = $evalForms[$evalFormID]['WeightedSum'] + $row['Weighted'];
                    $evalForms[$evalFormID]['Evaluated'][] = $row;
                }
            }
        }
        foreach ($evalForms as $evalFormID => $evalForm) {
            $evalForms[$evalFormID]['Completed'] = $evalForms[$evalFormID]['CompletedFlag'];
            if ($evalForm['EvalCount'] > 0)
                $evalForms[$evalFormID]['Weighted'] = number_format($evalForm['WeightedSum'] / $evalForm['EvalCount'], 2, '.', '');
            else
                $evalForms[$evalFormID]['Weighted'] = 0;
        }
        //Utils::pa($evalForms);
        return $evalForms;
    }

    public static function getPersonsEvaluateFromEvalFormsTrainer()
    {

        global $conn;

        $persons = array();

        $query = "SELECT PersonID, FullName
                FROM   persons
                WHERE
		       PersonID IN (SELECT DISTINCT PersonID FROM training_eval_forms WHERE type = 2)
                ORDER  BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;
    }

    public static function deleteEvalForm($EvalFormID)
    {
        global $conn;

        $query = "DELETE FROM training_eval_forms WHERE EvalFormID=$EvalFormID";
        $conn->query($query);

        $query = "DELETE FROM training_eval WHERE EvalFormID=$EvalFormID";
        $conn->query($query);
    }

    ## Set Evaluation sections

    public static function getEval($EvalFormID)
    {
        global $conn;
        //Utils::pa($_SESSION);
        $eval = array();
        /* AND (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][25]}' > 1 OR {$_SESSION['USER_ID']} = 1) $cond   */
        $query = "SELECT *,d.Name AS SectionName, b.Pondere AS Pondere, d.Pondere AS SPondere FROM training_eval a
       			LEFT JOIN training_eval_questions b ON a.EvalQuestionID=b.EvalQuestionID
       			LEFT JOIN training_eval_forms c ON c.EvalFormID=a.EvalFormID
       			LEFT JOIN training_eval_sections d ON b.SectionID=d.SectionID
    			WHERE  c.EvalFormID=$EvalFormID
			    AND (a.UserID = {$_SESSION['USER_ID']}  OR '{$_SESSION['USER_RIGHTS2'][5][1]}' > 1 OR c.PersonID = '{$_SESSION['PERS']}' OR c.EvaluatorID = '{$_SESSION['PERS']}' OR {$_SESSION['USER_ID']} = 1) $cond
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

        $query = "SELECT b.PersonID FROM training_eval a
       			LEFT JOIN training_eval_forms b ON b.EvalFormID=a.EvalFormID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        $PersonID = $row['PersonID'];
        return $PersonID;
    }

    public static function getEvaluatorByForm($EvalFormID)
    {
        global $conn;

        $query = "SELECT b.EvaluatorID FROM training_eval a
       			LEFT JOIN training_eval_forms b ON b.EvalFormID=a.EvalFormID
    			WHERE  b.EvalFormID=$EvalFormID
    			LIMIT 1";
        $conn->query($query);
        $row = $conn->fetch_array();
        $EvaluatorID = $row['EvaluatorID'];
        return $EvaluatorID;
    }

    public static function getCompletedStatus($EvalFormID)
    {
        global $conn;

        $conn->query("SELECT Completed FROM training_eval_forms WHERE EvalFormID=$EvalFormID");
        $row = $conn->fetch_array();
        return $row['Completed'];
    }

    public static function editEval($info = array())
    {
        global $conn;

        //update answers
        foreach ($info['Mark'] as $key => $mark) {
            $query = "UPDATE training_eval SET Mark=$mark, Comment='" . $info['Comment'][$key] . "' WHERE EvalID=$key";
            $conn->query($query);
        }
    }

    public function addTraining($info = array())
    {

        $this->setData($info);

        global $conn;

        if ($info['CostType'] == 'person')
            $costTotal = 0;
        if ($info['CostType'] == 'total')
            $costTotal = $info['Cost'];

        $conn->query("INSERT INTO trainings(UserID, CreateDate, LastUpdateDate, CostTotal, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$costTotal', '" . implode("', '", $info) . "')");

        $TrainingID = $conn->get_insert_id();
        return $TrainingID;
    }

    private function setData(&$info)
    {
        $info['Type'] = !empty($info['Type']) ? 1 : 0;
        $info['PersonID'] = $info['PersonID'];
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['TrainingName']) {
            throw new Exception(Message::getMessage('TRAININGNAME_EMPTY'));
        }
        /*
            if (!$info['Description']) {
                 throw new Exception(Message::getMessage('TRAININGDESCR_EMPTY'));
            }
        */
        if (!$info['CompanyID']) {
            throw new Exception(Message::getMessage('COMPANYNAME_EMPTY'));
        }
        if (!$info['TrainingTypeID']) {
            throw new Exception(Message::getMessage('TRAINING_TYPE_EMPTY'));
        }
        if (!$info['PersonID']) {
            throw new Exception(Message::getMessage('TRAINER_EMPTY'));
        }
        if (!$info['StartDate']) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (!$info['StopDate']) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        /*
            if (!$info['DistrictID']) {
                 throw new Exception(Message::getMessage('DISTRICT_EMPTY'));
            }
            if (!$info['CityID']) {
                 throw new Exception(Message::getMessage('CITY_EMPTY'));
            }
        */
        if (!$info['Status']) {
            throw new Exception(Message::getMessage('TRAININGSTATUS_EMPTY'));
        }

        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);
        $info['CustomTraining3'] = !empty($info['CustomTraining3']) ? Utils::toDBDate($info['CustomTraining3']) : '';
    }

    public function editTraining($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del':
                    $conn->query("DELETE FROM training_persons WHERE TrainingID = {$this->TrainingID} AND PersonID = {$_GET['PersonID']}");
                    $conn->query("DELETE FROM persons_beneficii WHERE
		    			PersonID = {$_GET['PersonID']} AND
		    			Type=8 AND
		    			ExternalBenID={$this->TrainingID}"
                    );

                    // Update training costs
                    $personsNo = $this->countPersons();
                    $conn->query("UPDATE trainings SET CostTotal = 
									       CASE CostType 
									            WHEN 'total' 
									                 THEN CostTotal 
									            WHEN 'person' 
									                 THEN Cost * $personsNo 
									
									       END
									WHERE TrainingID={$this->TrainingID}");

                    $conn->query("UPDATE trainings SET Cost = 
									       CASE CostType 
									            WHEN 'total' 
									                 THEN CostTotal/$personsNo
									            WHEN 'person' 
									                 THEN Cost
									
									       END
									WHERE TrainingID={$this->TrainingID}");

                    header('Location: ./?m=training&o=edit&TrainingID=' . $this->TrainingID);
                    exit;
                    break;
                case 'add':
                    $conn->query("INSERT INTO training_persons(UserID, TrainingID, PersonID) VALUES({$_SESSION['USER_ID']}, {$this->TrainingID}, {$_GET['PersonID']})");
                    // Update training costs
                    $personsNo = $this->countPersons();
                    $conn->query("UPDATE trainings SET CostTotal = 
									       CASE CostType 
									            WHEN 'total' 
									                 THEN CostTotal 
									            WHEN 'person' 
									                 THEN Cost * $personsNo 
									
									       END
									WHERE TrainingID={$this->TrainingID}");

                    $conn->query("UPDATE trainings SET Cost = 
									       CASE CostType 
									            WHEN 'total' 
									                 THEN CostTotal/$personsNo
									            WHEN 'person' 
									                 THEN Cost
									
									       END
									WHERE TrainingID={$this->TrainingID}");

                    // Insert the benefit
                    $conn->query("INSERT INTO persons_beneficii SET
						UserID={$_SESSION['USER_ID']},
						PersonID={$_GET['PersonID']},
						Type=8,
						ExternalBenID={$this->TrainingID},
						RegDate=(SELECT StartDate FROM trainings WHERE TrainingID={$this->TrainingID}),
						EndDate=(SELECT StopDate FROM trainings WHERE TrainingID={$this->TrainingID}),
						CompanyId=(SELECT CompanyID FROM trainings WHERE TrainingID={$this->TrainingID}),
						Notes=(SELECT TrainingName FROM trainings WHERE TrainingID={$this->TrainingID}),
						TotalCost=(SELECT Cost FROM trainings WHERE TrainingID={$this->TrainingID}),
						Currency=(SELECT Currency FROM trainings WHERE TrainingID={$this->TrainingID}),
						CreateDate=(SELECT CreateDate FROM trainings WHERE TrainingID={$this->TrainingID}),
						LastUpdateDate=CURRENT_TIMESTAMP");
                    header('Location: ./?m=training&o=edit&TrainingID=' . $this->TrainingID);
                    exit;
                    break;
            }
        }

        $this->setData($info);
        unset($info['persons']);

        // Compute training Total Cost/ Persons Cost
        $personsNo = $this->countPersons();
        if ($info['CostType'] == 'person') {
            // Get training persons
            $info['Cost'] = $info['Cost'];
            $info['CostTotal'] = $info['Cost'] * $personsNo;
        } elseif ($info['CostType'] == 'total') {
            // Get training persons
            $personsNo = $this->countPersons();
            $info['CostTotal'] = $info['Cost'];
            $info['Cost'] = $info['Cost'] / $personsNo;
        }

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $conn->query("UPDATE trainings SET $update LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  TrainingID = {$this->TrainingID} AND
                             ((UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][5][1]}' = 3) OR '{$_SESSION['USER_RIGHTS3'][5][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1)");
        $conn->query("UPDATE persons_beneficii SET
         				RegDate='{$info['StartDate']}',
         				EndDate='{$info['StopDate']}',
         				CompanyId={$info['CompanyID']},
         				Notes='{$info['TrainingName']}',
         				TotalCost='{$info['Cost']}',
         				Currency='{$info['Currency']}',
         				LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  ExternalBenID = {$this->TrainingID} AND
                             ((UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][5][1]}' = 3) OR '{$_SESSION['USER_RIGHTS3'][5][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1)");
        /*
        $conn->query("DELETE FROM training_persons WHERE UserID = {$_SESSION['USER_ID']} AND TrainingID = {$this->TrainingID}");
        foreach ((array)$persons as $k => $v) {
            if ($v > 0) {
                $conn->query("INSERT INTO training_persons(UserID, TrainingID, PersonID) VALUES({$_SESSION['USER_ID']}, {$this->TrainingID}, {$v})");
            }
        }
        */
    }

    public function countPersons()
    {

        global $conn;
        $query = "SELECT COUNT(PersonID) AS personsNo
                  FROM   training_persons 
                  WHERE  TrainingID = {$this->TrainingID}";
        $conn->query($query);
        $row = $conn->fetch_array();

        return (int)$row['personsNo'];
    }

    public function delTraining()
    {

        global $conn;

        $conn->query("DELETE FROM trainings WHERE TrainingID = {$this->TrainingID} AND {$_SESSION['USER_ID']} = 1");
        $conn->query("DELETE FROM training_persons WHERE TrainingID = {$this->TrainingID} AND {$_SESSION['USER_ID']} = 1");
        $conn->query("DELETE FROM persons_beneficii WHERE ExternalBenID = {$this->TrainingID} AND {$_SESSION['USER_ID']} = 1");
    }

    public function getTraining()
    {

        global $conn;

        $query = "SELECT a.*, b.CityName,
                         CASE WHEN (a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][5][1]}' = 3) OR '{$_SESSION['USER_RIGHTS3'][5][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1 THEN 1 ELSE 0 END AS rw
                  FROM   trainings a
                         LEFT JOIN address_city b ON a.CityID = b.CityID
                  WHERE  a.TrainingID = {$this->TrainingID} AND 
                         (a.UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS3'][5][1][1]}' > 0 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_TRAINING'));
        }
    }

    public function getTrainingPersons()
    {

        global $conn;

        $query = "SELECT PersonID 
                  FROM   training_persons 
                  WHERE  TrainingID = {$this->TrainingID} AND 
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_RIGHTS3'][5][1][1]}' > 0 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row['PersonID'];
        }
        return $persons;
    }

    public function addEvalFormDraft($info = array())
    {

        global $conn;
        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("INSERT INTO training_eval_forms_draft(UserID, FormName, Type, CreateDate)
                      VALUES({$_SESSION['USER_ID']}, '{$_POST['FormName']}','{$_POST['Type']}', CURRENT_TIMESTAMP)");
        return $conn->get_insert_id();
    }

    public function editEvalFormDraft($EvalFormDraftID, $info = array())
    {

        global $conn;

        if (empty($_POST['FormName']))
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM_NAME'));

        $conn->query("UPDATE training_eval_forms_draft SET
        				UserID={$_SESSION['USER_ID']},
        				FormName='{$_POST['FormName']}',
        				Type='{$_POST['Type']}',
        				CreateDate=CURRENT_TIMESTAMP
        				WHERE EvalFormDraftID=$EvalFormDraftID");
    }

########################## Evaluation Data  ###############################

    public function getEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $query = "SELECT * FROM training_eval_forms_draft
                  WHERE  EvalFormDraftID = {$EvalFormDraftID} AND
                         (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][5]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_EVAL_FORM'));
        }
    }

    public function deleteEvalFormDraft($EvalFormDraftID)
    {

        global $conn;

        $conn->query("DELETE FROM training_eval_forms_draft WHERE EvalFormDraftID=$EvalFormDraftID
        				AND NOT EXISTS(SELECT EvalFormID from training_eval_forms WHERE EvalFormDraftID=$EvalFormDraftID)");
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Nu se poate sterge acest template de evaluare deoarece este deja utilizat!'); window.location.href = './?m=training&o=formsDraft';\"></body>";
            exit;
        }
    }

    public function getAllEvalFormsDraft($type = '')
    {

        global $conn;

        if (!empty($type))
            $cond = " AND Type=$type ";

        $query = "SELECT * FROM training_eval_forms_draft
                  WHERE  1=1 $cond 
                         AND (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][5]}' > 1 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
        return $res;
    }

    public function setEvalToTrainee($info = array())
    {

        global $conn;

        if (empty($info['TrainingID']) || $info['TrainingID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_TRAINING'));
        }
        if (empty($info['EvalFormDraftID']) || $info['EvalFormDraftID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_FORM'));
        }
        if (empty($info['PersonID']) || $info['PersonID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_PERSON'));
        }
        /*
		if (empty($info['EvaluatorID'])|| $info['EvaluatorID']<=0) {
             throw new Exception(Message::getMessage('NO_SEL_EVALUATOR'));
        }
        */
        if (empty($info['StartDate'])) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (empty($info['EndDate'])) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        foreach ($info['PersonID'] as $PersonID) {
            // assing an eval form to a person
            $conn->query("INSERT INTO training_eval_forms(UserID, PersonID, EvaluatorID, ManagerID, EvalFormDraftID, FormName, Type, TrainingID, StartDate, EndDate, CreateDate)
	                      VALUES({$_SESSION['USER_ID']},
	                      '$PersonID',
	                      (SELECT PersonID FROM trainings WHERE TrainingID={$info['TrainingID']}),
	                      (SELECT ManagerID FROM persons WHERE PersonID=$PersonID),
	                      '{$info['EvalFormDraftID']}',
	                      (SELECT FormName FROM training_eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      (SELECT Type FROM training_eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      '{$info['TrainingID']}' ,
	                      '{$info['StartDate']}',
	                      '{$info['EndDate']}',
	                      CURRENT_TIMESTAMP)");
            $EvalFormID = $conn->get_insert_id();

            //Insert default questions to personal evaluation form
            $conn->query("INSERT INTO training_eval(UserID, EvalQuestionID, EvalFormID)
							SELECT {$_SESSION['USER_ID']}, EvalQuestionID, $EvalFormID
                            FROM training_eval_forms_draft a
                            LEFT JOIN training_eval_questions b ON a.EvalFormDraftID=b.EvalFormDraftID
                            WHERE a.EvalFormDraftID={$info['EvalFormDraftID']}");
            $PersonID = $PersonID;
        }
        return $PersonID;
    }

    public function setEvalToTrainer($info = array())
    {

        global $conn;

        if (empty($info['TrainingID']) || $info['TrainingID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_TRAINING'));
        }
        if (empty($info['EvalFormDraftID']) || $info['EvalFormDraftID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_FORM'));
        }
        if (empty($info['PersonID']) || $info['PersonID'] <= 0) {
            throw new Exception(Message::getMessage('NO_SEL_EVALUATOR'));
        }
        /*
    	if (empty($info['EvaluatorID'])|| $info['EvaluatorID']<=0) {
             throw new Exception(Message::getMessage('NO_SEL_PERSON'));
        }
        */
        if (empty($info['StartDate'])) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (empty($info['EndDate'])) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        //Utils::pa($info);
        //exit;

        // Insert multiple evaluators data
        /*
        $conn->query("INSERT INTO training_eval_forms_groups(EvalFormID, PersonID)
	                      VALUES(
	                      '$EvalFormID',
	                      '{$info['PersonID']}')
	                      ");
	    $EvalFormPersonID= $conn->get_insert_id();
	    */
        foreach ($info['PersonID'] as $PersonID) {
            // assign an eval form to a person for every evaluator
            $conn->query("INSERT INTO training_eval_forms(UserID, PersonID, EvaluatorID, ManagerID, EvalFormDraftID, EvalFormKey, FormName, Type, TrainingID, StartDate, EndDate, CreateDate)
	                      VALUES({$_SESSION['USER_ID']},
	                      (SELECT PersonID FROM trainings WHERE TrainingID={$info['TrainingID']}),
	                      '{$info['PersonID']}',
	                      (SELECT ManagerID FROM persons WHERE PersonID='$PersonID'),
	                      '{$info['EvalFormDraftID']}',
	                      '" . md5(date('mdHs')) . "',
	                      (SELECT FormName FROM training_eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
	                      (SELECT Type FROM training_eval_forms_draft WHERE EvalFormDraftID={$info['EvalFormDraftID']}),
		                   '{$info['TrainingID']}' ,
	                      '{$info['StartDate']}',
	                      '{$info['EndDate']}',
	                      CURRENT_TIMESTAMP)");
            $EvalFormID = $conn->get_insert_id();

            //Insert default questions to personal evaluation form
            $query2 = "INSERT INTO training_eval(UserID, EvalQuestionID, EvalFormID)
								SELECT {$_SESSION['USER_ID']}, EvalQuestionID, $EvalFormID
	                            FROM training_eval_forms_draft a
	                            LEFT JOIN training_eval_questions b ON a.EvalFormDraftID=b.EvalFormDraftID
	                            WHERE a.EvalFormDraftID={$info['EvalFormDraftID']}";
            $conn->query($query2);
            $PersonID = $PersonID;
        }
        return $PersonID;
    }

}

?>