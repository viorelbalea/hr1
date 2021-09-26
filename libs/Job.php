<?php

class Job extends ConfigData
{

    public static $msResPerPage = 20;
    private $JobID;

    public function __construct($JobID = 0)
    {
        if ($JobID > 0) {
            $this->JobID = $JobID;
        }
    }

    public static function getAllJobs($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CompanyName';
                    $cond .= " AND b.CompanyName LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND c.JobTitle LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            if ($_GET['Status'] == 'activ') {
                $cond .= " AND a.StopDate >= CURRENT_DATE";
            }
            if ($_GET['Status'] == 'inactiv') {
                $cond .= " AND a.StopDate < CURRENT_DATE";
            }
        }

        if (!empty($_GET['CityID'])) {
            $cond .= " AND f.CityID = " . (int)$_GET['CityID'];
        }

        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND g.DistrictID = " . (int)$_GET['DistrictID'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;
        if (!isset($_SESSION['USER_RIGHTS2'][3][1]))
            $_SESSION['USER_RIGHTS2'][3][1] = NULL;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   jobs a
                          INNER JOIN companies b ON a.CompanyID = b.CompanyID
                          INNER JOIN jobsdictionary c ON a.JobDictionaryID = c.JobDictionaryID
                          INNER JOIN users h ON a.UserID = h.UserID
			  LEFT JOIN address d ON b.AddressID = d.AddressID
                          LEFT JOIN address_city f ON f.CityID = d.CityID
                          LEFT JOIN address_district g ON f.DistrictID = g.DistrictID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $jobs = array();
        $jobs[0]['pageNo'] = $pageNo;
        $jobs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('JobTitle', 'CompanyName', 'DistrictName', 'CityName', 'no_persons', 'StartDate', 'StopDate', 'status')) ? $_GET['order_by'] : 'JobTitle';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.CompanyName, c.JobTitle, f.CityName, g.DistrictName,
                         DATE_FORMAT(a.StartDate, '%d.%m.%Y') AS start_date,
                         DATE_FORMAT(a.StopDate, '%d.%m.%Y') AS stop_date,
                         CASE WHEN a.StopDate < CURRENT_DATE THEN 'inactiv' ELSE 'activ' END AS status,
                         (SELECT COUNT(1) AS no_persons FROM events WHERE InterviewJobID = a.JobID) AS no_persons,
                         h.UserName
	          FROM   jobs a
	                 INNER JOIN companies b ON a.CompanyID = b.CompanyID
                         INNER JOIN jobsdictionary c ON a.JobDictionaryID = c.JobDictionaryID
                         INNER JOIN users h ON a.UserID = h.UserID
			 LEFT JOIN address d ON b.AddressID = d.AddressID
                         LEFT JOIN address_city f ON f.CityID = d.CityID
                         LEFT JOIN address_district g ON f.DistrictID = g.DistrictID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['JobID']] = $row;
        }

        return $jobs;
    }

    public static function getJobsTitle()
    {

        global $conn;

        $jobs = array();

        $query = "SELECT JobDictionaryID, JobTitle FROM jobsdictionary WHERE Status = 1 ORDER BY JobTitle";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['JobDictionaryID']] = $row['JobTitle'];
        }

        return $jobs;
    }

    public static function getJobsTitleAdmin()
    {

        global $conn;

        $jobs = array();

        $query = "SELECT JobDictionaryID, JobTitle, COR, Status FROM jobsdictionary ORDER BY JobTitle";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['JobDictionaryID']] = $row;
        }

        return $jobs;
    }

    public static function getJobDomains()
    {

        global $conn;

        $domains = array();

        $query = "SELECT JobDomainID, Domain FROM jobsdomain WHERE status = 1 ORDER BY Domain";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $domains[$row['JobDomainID']] = $row['Domain'];
        }

        return $domains;
    }

    public static function getJobDomainsAdmin()
    {

        global $conn;

        $domains = array();

        $query = "SELECT JobDomainID, Domain, Status FROM jobsdomain ORDER BY Domain";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $domains[$row['JobDomainID']] = $row;
        }

        return $domains;
    }

    public static function getCompanies()
    {

        global $conn;

        $companies = array();

        $query = "SELECT CompanyID, CompanyName FROM companies ORDER BY isGeneric DESC, CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row['CompanyName'];
        }

        return $companies;
    }

    public static function getTrainingCompanies()
    {

        global $conn;

        $companies = array();

        $query = "SELECT CompanyID, CompanyName
                FROM   companies
                WHERE  isTrainer = 1 AND
		       CompanyID IN (SELECT DISTINCT CompanyID FROM companies_training_type)
                ORDER  BY CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row['CompanyName'];
        }

        return $companies;
    }

    public static function getTrainingCompaniesWithSelfNotion()
    {

        global $conn;

        $companies = array();

        $query = "SELECT CompanyID, CompanyName, Self
                FROM   companies
                WHERE  isTrainer = 1 AND
		       CompanyID IN (SELECT DISTINCT CompanyID FROM companies_training_type)
                ORDER  BY CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']]['nume'] = $row['CompanyName'];
            $companies[$row['CompanyID']]['self'] = $row['Self'];
        }

        return $companies;
    }

    public static function newJob($JobDictionaryID)
    {

        global $conn;

        if ($JobDictionaryID > 0 && !empty($_GET['delJobTitle'])) {

            $conn->query("DELETE FROM jobsdictionary
                          WHERE  JobDictionaryID = $JobDictionaryID AND
                                 NOT EXISTS(SELECT JobDictionaryID FROM jobs WHERE JobDictionaryID = $JobDictionaryID) AND
                                 NOT EXISTS(SELECT JobDictionaryID FROM persons WHERE JobDictionaryID = $JobDictionaryID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta profesie deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=admin&o=jobstitle';\"></body>";
                exit;
            }

        } else {

            $JobTitle = Utils::formatStr($_GET['JobTitle']);

            if ($JobDictionaryID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE jobsdictionary SET JobTitle = '$JobTitle', COR = '{$_GET['COR']}', Status = $Status WHERE JobDictionaryID = $JobDictionaryID");
            } else {
                $conn->query("INSERT INTO jobsdictionary(UserID, JobTitle, COR, CreateDate) VALUES({$_SESSION['USER_ID']}, '$JobTitle', '{$_GET['COR']}', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_PROF'));
            }
        }
    }

    public static function newDomain($JobDomainID)
    {

        global $conn;

        if ($JobDomainID > 0 && !empty($_GET['delDomain'])) {
            $conn->query("DELETE FROM jobsdomain
                          WHERE  JobDomainID = $JobDomainID AND
                                 NOT EXISTS(SELECT CompanyDomainID FROM companies WHERE CompanyDomainID = $JobDomainID) AND
                                 NOT EXISTS(SELECT JobDomainID FROM jobs WHERE JobDomainID = $JobDomainID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest domeniu deoarece este deja utilizat!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=admin&o=domains';\"></body>";
                exit;
            }

        } else {

            if ($JobDomainID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE jobsdomain SET Status = $Status WHERE JobDomainID = $JobDomainID");
            } else {
                $conn->query("INSERT INTO jobsdomain(UserID, Domain, CreateDate) SELECT '{$_SESSION['USER_ID']}' AS UserID, CONCAT('(', DomeniuActivitateCod, ') ', DomeniuActivitateDenumire) AS Domain, CURRENT_TIMESTAMP FROM nom_caen WHERE DomeniuActivitateCod = '{$_GET['Caen']}'");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DOM'));
            }
        }
    }

    public static function getJobsByCompany()
    {

        global $conn;

        $jobs = array();
        $query = "SELECT a.JobID, a.CompanyID, a.PositionNo, b.JobTitle, c.CompanyName,
	                 CASE WHEN CURRENT_DATE BETWEEN a.StartDate AND a.StopDate THEN 1 ELSE 0 END AS JobStatus
	          FROM   jobs a
	                 INNER JOIN jobsdictionary b ON a.JobDictionaryID = b.JobDictionaryID
	                 INNER JOIN companies c ON a.CompanyID = c.CompanyID
	    	  ORDER  BY c.CompanyName, b.JobTitle";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[$row['CompanyID']][] = $row;
        }
        return $jobs;
    }

    public static function getSimplePersons()
    {

        global $conn;

        $persons = array();

        $query = "SELECT PersonID, FullName FROM persons ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }

        return $persons;
    }

    public static function getSimpleCandidates()
    {

        global $conn;

        $candidates = array();

        $query = "SELECT PersonID, FullName FROM candidates_internal ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $candidates[$row['PersonID']] = $row['FullName'];
        }
        //Utils::pa($candidates);
        return $candidates;
    }

    public static function getJobsByPerson($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][21]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT FullName, Status FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $jobs[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
        /*
        $query = "SELECT a.*, b.CompanyName, d.JobTitle,
                             DATE_FORMAT(a.StartDate, '%d.%m.%Y') AS start_date,
                             DATE_FORMAT(a.StopDate, '%d.%m.%Y') AS stop_date,
                             CASE WHEN a.StopDate < CURRENT_DATE THEN 'inactiv' ELSE 'activ' END AS status
                  FROM   jobs a
                         INNER JOIN companies b ON a.CompanyID = b.CompanyID
                          INNER JOIN job_persons c ON a.JobID = c.JobID AND c.PersonID = '$PersonID'
                          INNER JOIN jobsdictionary d ON a.JobDictionaryID = d.JobDictionaryID
                  ORDER  BY a.JobID DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[] = $row;
        }
        */
        $query = "SELECT d.JobTitle, e.CompanyName AS CompanyName, 
	                         DATE_FORMAT(a.StartDate, '%d.%m.%Y') AS start_date,
	                         DATE_FORMAT(a.StopDate, '%d.%m.%Y') AS stop_date,
	                         CASE WHEN a.StopDate < CURRENT_DATE THEN 'inactiv' ELSE 'activ' END AS status,
				 			'1' AS expertiza
		          FROM   jobs a
			         	LEFT JOIN persons_prof b ON a.FunctionIDRecr = b.FunctionIDRecr
			         	INNER JOIN job_persons c ON a.JobID = c.JobID 
				 		LEFT JOIN jobsdictionary d ON a.JobDictionaryID = d.JobDictionaryID
				 		INNER JOIN companies e ON a.CompanyID = e.CompanyID
				 		AND c.PersonID = '$PersonID'
		          ORDER  BY a.StartDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[] = $row;
        }

        return $jobs;
    }

    public static function getJobsByCandidate($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][8]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT FullName, Status FROM candidates_internal a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $jobs[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
        $query = "SELECT d.JobTitle, c.JobID, e.CompanyName AS CompanyName, 
	                         DATE_FORMAT(a.StartDate, '%d.%m.%Y') AS start_date,
	                         DATE_FORMAT(a.StopDate, '%d.%m.%Y') AS stop_date,
	                         CASE WHEN a.StopDate < CURRENT_DATE THEN 'inactiv' ELSE 'activ' END AS status,
				 			'1' AS expertiza
		          FROM   jobs a
			         	LEFT JOIN candidates_internal_prof b ON a.FunctionIDRecr = b.FunctionIDRecr
			         	INNER JOIN job_candidates c ON a.JobID = c.JobID 
				 		LEFT JOIN jobsdictionary d ON a.JobDictionaryID = d.JobDictionaryID
				 		INNER JOIN companies e ON a.CompanyID = e.CompanyID
				 		AND c.PersonID = '$PersonID'
		          ORDER  BY a.StartDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $jobs[] = $row;
        }

        return $jobs;
    }

    public static function getJobsByDictionary()
    {
        global $conn;
        $jobs = array();
        $conn->query("SELECT JobID, JobDictionaryID FROM jobs ORDER BY CreateDate DESC");
        while ($row = $conn->fetch_array()) {
            $jobs[$row['JobID']] = $row['JobDictionaryID'];
        }
        return $jobs;
    }

    public function addJob($info = array())
    {

        $this->setData($info);

        global $conn;

        $lang['Lang'] = $info['Lang'];
        $lang['ReadLevel'] = $info['ReadLevel'];
        $lang['WriteLevel'] = $info['WriteLevel'];
        $lang['SpeakLevel'] = $info['SpeakLevel'];
        unset($info['Lang'], $info['ReadLevel'], $info['WriteLevel'], $info['SpeakLevel']);

        $conn->query("INSERT INTO jobs(UserID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            //throw new Exception(Message::getMessage('DUPLICATE'));
        } else {
            $this->JobID = $conn->get_insert_id();
            $this->addLang($lang);
            return $this->JobID;
        }
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($info)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['JobTitle']) {
            throw new Exception(Message::getMessage('JOBTITLE_EMPTY'));
        }
        if (!$info['JobDescription']) {
            throw new Exception(Message::getMessage('JOBDESCRIPTION_EMPTY'));
        }
        if (!$info['JobDomainID'] && !$info['Domain']) {
            throw new Exception(Message::getMessage('DOMAIN_EMPTY'));
        }
        if (!$info['CompanyID']) {
            throw new Exception(Message::getMessage('COMPANYNAME_EMPTY'));
        }
        if (!$info['RequiredExperience']) {
            throw new Exception(Message::getMessage('EXPERIENCE_EMPTY'));
        }
        if (!$info['JobType']) {
            throw new Exception(Message::getMessage('JOBTYPE_EMPTY'));
        }
        if (!$info['StartDate']) {
            throw new Exception(Message::getMessage('STARTDATE_EMPTY'));
        }
        if (!$info['StopDate']) {
            throw new Exception(Message::getMessage('STOPDATE_EMPTY'));
        }
        if (!$info['ProfJobDictionaryID']) {
            throw new Exception(Message::getMessage('PROF_EMPTY'));
        }
        if (!$info['Studies']) {
            throw new Exception(Message::getMessage('STUDIES_EMPTY'));
        }
        if ($info['DrivingLicense'] == 'Da') {
            $info['DrivingCategory'] = !empty($info['DrivingCategory']) ? implode(',', $info['DrivingCategory']) : '';
        }

        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);
        $info['CustomJob3'] = !empty($info['CustomJob3']) ? Utils::toDBDate($info['CustomJob3']) : '';

        global $conn;

        $conn->query("SELECT JobDictionaryID
                      FROM   jobsdictionary
                      WHERE  LOWER(JobTitle) = '" . strtolower($info['JobTitle']) . "'");
        if ($row = $conn->fetch_array()) {
            $info['JobDictionaryID'] = $row['JobDictionaryID'];
        } else {
            $conn->query("INSERT INTO jobsdictionary(UserID, JobTitle, CreateDate)
                          VALUES({$_SESSION['USER_ID']}, '{$info['JobTitle']}', CURRENT_TIMESTAMP)");
            $info['JobDictionaryID'] = $conn->get_insert_id();
        }
        unset($info['JobTitle'], $info['Lang'], $info['ReadLevel'], $info['WriteLevel'], $info['SpeakLevel']);
        /*
        if (!empty($info['Domain'])) {
             $conn->query("INSERT INTO jobsdomain(UserID, Domain, CreateDate)
                           VALUES({$_SESSION['USER_ID']}, '{$info['Domain']}', CURRENT_TIMESTAMP)");
             $info['JobDomainID'] = $conn->get_insert_id();
        }
        */
        unset($info['Domain']);
    }

    public function addLang($info)
    {

        global $conn;

        $conn->query("INSERT INTO job_lang(UserID, JobID, CreateDate, Lang, ReadLevel, WriteLevel, SpeakLevel)
                      VALUES({$_SESSION['USER_ID']}, {$this->JobID}, now(), '{$info['Lang']}', '{$info['ReadLevel']}', '{$info['WriteLevel']}', '{$info['SpeakLevel']}')");
    }

    public function editJob($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'add':
                    $this->addLang($_GET);
                    break;
                case 'edit':
                    $this->editLang($_GET);
                    break;
                case 'del':
                    $this->delLang($_GET);
                    break;
            }
            return;
        }

        $this->setData($info);

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][3][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE jobs a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE JobID = {$this->JobID} AND ($condrw)");
        if ($conn->errno == 1062) {
            //throw new Exception(Message::getMessage('DUPLICATE'));
        }
    }

    public function editLang($info)
    {

        global $conn;

        $conn->query("UPDATE job_lang SET 
					    Lang       = '{$info['Lang']}',
					    ReadLevel  = '{$info['ReadLevel']}',
					    WriteLevel = '{$info['WriteLevel']}',
					    SpeakLevel = '{$info['SpeakLevel']}'
		      WHERE LangID = {$info['LangID']} AND JobID = {$this->JobID}");
    }

    public function delLang($info)
    {
        global $conn;
        $conn->query("DELETE FROM job_lang WHERE LangID = {$info['LangID']} AND JobID = {$this->JobID}");
    }

    public function allocJob()
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del':
                    $conn->query("DELETE FROM job_persons WHERE JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                    header('Location: ./?m=jobs&o=alloc&JobID=' . $this->JobID);
                    exit;
                    break;
                case 'add':
                    $conn->query("INSERT INTO job_persons(UserID, JobID, PersonID) VALUES('{$_SESSION['USER_ID']}', {$this->JobID}, {$_GET['PersonID']})");
                    header('Location: ./?m=jobs&o=alloc&JobID=' . $this->JobID);
                    exit;
                    break;
                case 'options';
                    if (!empty($_POST)) {
                        foreach ($_POST['Phase'] as $k => $v) {
                            $update = "Phase{$k} = '{$v}'";
                            $conn->query("UPDATE job_persons SET $update WHERE JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                        }
                        header('Location: ' . $_SERVER['REQUEST_URI']);
                        exit;
                    }
                    global $smarty;
                    $conn->query("SELECT Phase1, Phase2, Phase3, Phase4, 
			                         (SELECT FullName FROM persons WHERE PersonID = a.PersonID) AS Candidat
			                  FROM   job_persons a
					  WHERE  JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                    if ($row = $conn->fetch_array()) {
                        $smarty->assign('phases', $row);
                    }
                    $smarty->display('job_options.tpl');
                    exit;
                    break;
            }
        }
    }

    public function allocJobCandidates()
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del':
                    $conn->query("DELETE FROM job_candidates WHERE JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                    header('Location: ./?m=jobs&o=alloc-candidates&JobID=' . $this->JobID);
                    exit;
                    break;
                case 'add':
                    $conn->query("INSERT INTO job_candidates(UserID, PID, JobID, PersonID) VALUES('{$_SESSION['USER_ID']}','{$_SESSION['PERS']}', {$this->JobID}, {$_GET['PersonID']})");
                    header('Location: ./?m=jobs&o=alloc-candidates&JobID=' . $this->JobID);
                    exit;
                    break;
                case 'options';
                    if (!empty($_POST)) {
                        foreach ($_POST['Phase'] as $k => $v) {
                            $update = "Phase{$k} = '{$v}'";
                            $conn->query("UPDATE job_candidates SET $update WHERE JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                        }
                        header('Location: ' . $_SERVER['REQUEST_URI']);
                        exit;
                    }
                    global $smarty;
                    $conn->query("SELECT Phase1, Phase2, Phase3, Phase4, 
			                         (SELECT FullName FROM candidates_internal WHERE PersonID = a.PersonID) AS Candidat
			                  FROM   job_candidates a
					  WHERE  JobID = {$this->JobID} AND PersonID = {$_GET['PersonID']}");
                    if ($row = $conn->fetch_array()) {
                        $smarty->assign('phases', $row);
                    }
                    $smarty->display('job_options_candidates.tpl');
                    exit;
                    break;
            }
        }
    }

    public function delJob()
    {

        global $conn;

        $conn->query("DELETE FROM jobs WHERE JobID = {$this->JobID} AND {$_SESSION['USER_ID']} = 1");
    }

    public function saveAsNew()
    {

        global $conn;

        $query = "INSERT INTO jobs(UserID, CompanyID, JobDomainID, JobDictionaryID, JobDescription, JobType, RequiredExperience, StartDate, Notes, CostCenterID, CreateDate)
    	          SELECT UserID, CompanyID, JobDomainID, JobDictionaryID, JobDescription, JobType, RequiredExperience, CURRENT_DATE, Notes, CostCenterID, CURRENT_TIMESTAMP
    	          FROM   jobs
    	          WHERE  JobID = {$this->JobID}";
        $conn->query($query);

        return $conn->get_insert_id();
    }

    public function getJob()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][1]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
		             OR
		             '{$_SESSION['USER_RIGHTS3'][3][1][1]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.JobTitle, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	                  FROM   jobs a
	                         INNER JOIN jobsdictionary b ON a.JobDictionaryID = b.JobDictionaryID
	                  WHERE  a.JobID = {$this->JobID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_JOB'));
        }
    }

    public function getJobAlloc()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][3][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.JobTitle, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   jobs a
                         INNER JOIN jobsdictionary b ON a.JobDictionaryID = b.JobDictionaryID
                  WHERE  a.JobID = {$this->JobID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_JOB'));
        }
    }

    public function getJobAllocCandidates()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][3]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
		             OR
		             '{$_SESSION['USER_RIGHTS3'][3][1][3]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.JobTitle, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	                  FROM   jobs a
	                         INNER JOIN jobsdictionary b ON a.JobDictionaryID = b.JobDictionaryID
	                  WHERE  a.JobID = {$this->JobID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_JOB'));
        }
    }

    public function getJobPersons()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT PersonID FROM job_persons a WHERE JobID = {$this->JobID} AND ($condbase)";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row['PersonID'];
        }
        return $persons;
    }

    public function getJobCandidates()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT PersonID FROM job_candidates a WHERE JobID = {$this->JobID} AND ($condbase)";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row['PersonID'];
        }
        //Utils::pa($persons);
        return $persons;
    }

    public function getLang()
    {

        global $conn;

        $conn->query("SELECT * FROM job_lang WHERE JobID = {$this->JobID} ORDER BY LangID");
        $lang = array();
        while ($row = $conn->fetch_array()) {
            $lang[$row['LangID']] = $row;
        }
        return $lang;
    }

    public function setStrategy($info = array())
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

        $conn->query("UPDATE job_strategy a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE JobID = {$this->JobID}");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO job_strategy(UserID, JobID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
	                          VALUES({$_SESSION['USER_ID']}, {$this->JobID}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    public function getStrategy()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][3][1][4]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][3][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][3][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][3][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][3][1][4]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   jobs a
                  LEFT JOIN job_strategy b ON a.JobID=b.JobID
                  WHERE  a.JobID = '{$this->JobID}' AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_JOB'));
        }
    }
}

?>