<?php

class Company
{

    private $CompanyID;

    public function __construct($CompanyID = 0)
    {
        $this->CompanyID = $CompanyID;
    }

    public static function getTrainingTypeByCompany($CompanyID)
    {

        global $conn;

        $query = "SELECT a.TrainingTypeID, b.TrainingType
    	          FROM   companies_training_type a
    	                 INNER JOIN training_types b ON a.TrainingTypeID = b.TrainingTypeID
    	          WHERE  a.CompanyID = $CompanyID
    	          ORDER  BY b.TrainingType";
        $conn->query($query);
        $trainings = array();
        while ($row = $conn->fetch_array()) {
            $trainings[$row['TrainingTypeID']] = $row['TrainingType'];
        }

        return $trainings;
    }

    public static function getTrainingsByCompanyPersons($CompanyID)
    {
        global $conn;
        $trainings = array();

        if (!empty($CompanyID)) {
            $query = "SELECT a.TrainingID, a.TrainingName
                        FROM trainings a
                        WHERE a.TrainingID IN(SELECT TrainingID FROM training_persons WHERE PersonID
                            IN(SELECT PersonID FROM payroll WHERE CompanyID = {$CompanyID}))";

            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $trainings[$row['TrainingID']] = $row['TrainingName'];
            }
        }
        return $trainings;
    }

    public static function getSelfCompanies()
    {

        global $conn;

        $query = "SELECT CompanyID, CompanyName FROM companies WHERE Self = 1 ORDER BY CompanyName";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $self[$row['CompanyID']] = $row['CompanyName'];
        }

        return $self;
    }

    public static function getSelfCompaniesData()
    {

        global $conn;

        $query = "SELECT *, d.FullName AS LegalFullName,d.Mobile AS LegalMobile, d.Fax AS LegalFax FROM companies a
    			  LEFT JOIN address b ON a.AddressID=b.AddressID
    			  LEFT JOIN address_city c ON b.CityID=a.Oras
    			  LEFT JOIN persons d ON d.PersonID=a.LegalPersonID
    			  LEFT JOIN jobsdomain e ON a.CompanyDomainID=e.JobDomainID
    			  WHERE Self = 1 ORDER BY CompanyName";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            // Adresa
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

            // Domeniu activitate
            preg_match_all('!\d+!', $row['Domain'], $matches);
            $query2 = "SELECT DomeniuActivitateID FROM nom_caen WHERE DomeniuActivitateCod='{$matches[0][0]}' LIMIT 1";
            $r2 = $conn->query($query2);
            $row2 = $conn->fetch_array($r2);
            $row['DomeniuActivitateID'] = $row2['DomeniuActivitateID'];
            $row['DomeniuActivitateCod'] = $matches[0][0];

            $self[$row['CompanyID']] = $row;
        }

        return $self;
    }

    public static function getNonSelfCompanies()
    {

        global $conn;

        $query = "SELECT CompanyID, CompanyName, CompanyEmail FROM companies WHERE Self = 0 ORDER BY CompanyName";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['CompanyID']] = $row;
        }

        return $res;
    }

    public static function getAssuranceCompanies()
    { //isAutoFurnizor

        global $conn;

        $query = "SELECT CompanyID, CompanyName FROM companies WHERE isAssurance = 1 ORDER BY CompanyName";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $self[$row['CompanyID']] = $row['CompanyName'];
        }

        return $self;
    }

    public static function getAutoFurnizorCompanies()
    { //isAutoFurnizor

        global $conn;

        $query = "SELECT CompanyID, CompanyName FROM companies WHERE isAutoFurnizor = 1 ORDER BY CompanyName";
        $conn->query($query);
        $self = array();
        while ($row = $conn->fetch_array()) {
            $self[$row['CompanyID']] = $row['CompanyName'];
        }

        return $self;
    }

    public static function getCompanies()
    {

        global $conn;

        $query = "SELECT CompanyID, CompanyName FROM companies ORDER BY CompanyName";
        $conn->query($query);
        $companies = array();
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row['CompanyName'];
        }

        return $companies;
    }

    public static function getUsedCompanies()
    {

        global $conn;

        $query = "SELECT a.CompanyID, a.CompanyName FROM companies a right join contract b on (b.PartnerID=a.CompanyID or b.CompanyID=a.CompanyID) ORDER BY a.CompanyName";
        $conn->query($query);
        $companies = array();
        while ($row = $conn->fetch_array()) {
            $companies[$row['CompanyID']] = $row['CompanyName'];
        }

        return $companies;
    }

    public static function getAllCompanies($action = '', $paginate = true)
    {

        global $conn;

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CNP';
                    $cond .= " AND a.CIF LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.CompanyName LIKE '{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Judet'])) {
            $cond .= " AND e.DistrictID = '{$_GET['Judet']}'";
        }

        if (!empty($_GET['Oras'])) {
            $cond .= " AND d.CityID = '{$_GET['Oras']}'";
        }

        if (!empty($_GET['CompanyDomainID'])) {
            $cond .= " AND f.JobDomainID = '{$_GET['CompanyDomainID']}'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        if (!isset($_SESSION['USER_RIGHTS2'][2][1]))
            $_SESSION['USER_RIGHTS2'][2][1] = NULL;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR
                     '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   companies a
			  LEFT JOIN address b ON a.AddressID = b.AddressID
                          LEFT JOIN address_city d ON d.CityID = a.Oras" . (!empty($_GET['Oras']) ? " AND d.CityID = " . (int)$_GET['Oras'] : "") . "
                          LEFT JOIN address_district e ON e.DistrictID = a.Judet" . (!empty($_GET['Judet']) ? " AND e.DistrictID = " . (int)$_GET['Judet'] : "") . "
                          LEFT JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $companies = array();
        $companies[0]['pageNo'] = $pageNo;
        $companies[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CompanyName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName, f.Domain, CASE WHEN a.PID > 0 THEN p.FullName ELSE g.UserName END AS UserName
	          FROM   companies a
	                 LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = a.Oras" . (!empty($_GET['Oras']) ? " AND d.CityID = " . (int)$_GET['Oras'] : "") . "
                         LEFT JOIN address_district e ON e.DistrictID = a.Judet" . (!empty($_GET['Judet']) ? " AND e.DistrictID = " . (int)$_GET['Judet'] : "") . "
                         LEFT JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID" . (!empty($_GET['CompanyDomainID']) ? " AND f.JobDomainID = " . (int)$_GET['CompanyDomainID'] : "") . "
                         LEFT JOIN users g ON a.UserID = g.UserID
			 LEFT JOIN persons p ON a.PID = p.PersonID
                  WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) || !$paginate ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $r1 = $conn->query($query);
        while ($row = $conn->fetch_array($r1)) {
            $companies[$row['CompanyID']] = $row;

        }

        $r2 = $conn->query("SELECT * FROM companies_contacts");
        while ($row2 = $conn->fetch_array($r2)) {

            $contacts[$row2['CompanyID']][$row2['ContactID']] = $row2;
        }

        foreach ($companies as $CompanyID => $company) {
            if (isset($contacts[$CompanyID]))
                $companies[$CompanyID]['Contacts'] = $contacts[$CompanyID];
        }


        return $companies;
    }

    public static function getCompaniesList($cond = '')
    {

        global $conn;

        $cond = '';

        $condbase = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR
                     '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";


        $query = "SELECT a.*, d.CityName, e.DistrictName, f.Domain, g.UserName
	          FROM   companies a
	                 LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = a.Oras
                         LEFT JOIN address_district e ON e.DistrictID = a.Judet
                         LEFT JOIN jobsdomain f ON a.CompanyDomainID = f.JobDomainID
                         LEFT JOIN users g ON a.UserID = g.UserID
                  WHERE 1=1 AND ($condbase) $cond
	          ORDER  BY CompanyName ASC ";
        $r1 = $conn->query($query);
        while ($row = $conn->fetch_array($r1)) {
            $companies[$row['CompanyID']] = $row;
        }

        $r2 = $conn->query("SELECT * FROM companies_contacts");
        while ($row2 = $conn->fetch_array($r2)) {

            $contacts[$row2['CompanyID']][$row2['ContactID']] = $row2;
        }

        foreach ($companies as $CompanyID => $company) {
            $companies[$CompanyID]['Contacts'] = $contacts[$CompanyID];
        }
        return $companies;
    }

    public function addCompany($info = array())
    {

        $data = $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO companies(UserID, PID, AddressID, BankID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', 0, {$data['0']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        } else {
            $this->CompanyID = $conn->get_insert_id();
            return $this->CompanyID;
        }
    }

    private function setData(&$info)
    {
        global $conn;
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);
        if (!$info['CompanyName']) {
            throw new Exception(Message::getMessage('COMPANYNAME_EMPTY'));
        }
        if ($info['Self'] == 1) {
            $conn->query("SELECT COUNT(1) AS total FROM companies WHERE Self = 1");
            $row = $conn->fetch_array();
            if ($row['total'] >= Config::COMPANY_SELF_NO) {
                throw new Exception(Message::getMessage('COMPANYSELF_LIMIT'));
            }
        } else {
            $info['Self'] = 0;
        }
        $info['isGeneric'] = isset($info['isGeneric']) ? 1 : 0;
        if (!$info['CompanyDomainID'] && !$info['Domain']) {
            throw new Exception(Message::getMessage('COMPANYDOMAIN_EMPTY'));
        }
        if ($info['CompanyEmail'] && !Utils::checkEmail($info['CompanyEmail'])) {
            throw new Exception(Message::getMessage('EMAIL_ERROR'));
        }

        $info['EmployeesNo'] = (int)$info['EmployeesNo'];
        $info['CustomCompany3'] = !empty($info['CustomCompany3']) ? Utils::toDBDate($info['CustomCompany3']) : '';
        $info['RegisterDate'] = !empty($info['RegisterDate']) ? Utils::toDBDate($info['RegisterDate']) : '';

        $conn->query("SELECT BankID, BankNotes
                      FROM   banks
                      WHERE  LOWER(BankName) = '" . strtolower($info['BankName']) . "' AND
                             LOWER(BankLocation) = '" . strtolower($info['BankLocation']) . "' AND
                             LOWER(BankAccount) = '" . strtolower($info['BankAccount']) . "'");
        if ($row = $conn->fetch_array()) {
            $BankID = $row['BankID'];
            if ($row['BankNotes'] != $info['BankNotes']) {
                $conn->query("UPDATE banks SET BankNotes = '{$info['BankNotes']}' WHERE BankID = $BankID");
            }
        } else {
            $conn->query("INSERT INTO banks(UserID, BankName, BankLocation, BankAccount, BankNotes)
                          VALUES({$_SESSION['USER_ID']}, '{$info['BankName']}', '{$info['BankLocation']}', '{$info['BankAccount']}', '{$info['BankNotes']}')");
            $BankID = $conn->get_insert_id();
        }
        unset($info['BankName'], $info['BankLocation'], $info['BankAccount'], $info['BankNotes']);
        unset($info['Domain']);
        return array($BankID);
    }

    public function addCompanyContact($info = array())
    {
        global $conn;

        $query = "INSERT INTO companies_contacts SET
       					UserID = {$_SESSION['USER_ID']},
					PID = '{$_SESSION['PERS']}',
       					CompanyID = {$this->CompanyID},
        				ContactName='{$_GET['ContactName']}',
        				ContactPhone='{$_GET['ContactPhone']}',
        				ContactEmail='{$_GET['ContactEmail']}',
        				ContactFunction='{$_GET['ContactFunction']}'
                        ";
        $conn->query($query);

        $contactID = $conn->get_insert_id();

        return $contactID;
    }

    public function editCompany($info = array())
    {
        $data = $this->setData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            if (!is_array($v))
                $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][2][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE companies a SET $update BankID = {$data[0]}, LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  CompanyID = {$this->CompanyID} AND ($condrw)");
        /*Utils::_debug("UPDATE companies a SET $update BankID = {$data[0]}, LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  CompanyID = {$this->CompanyID} AND ($condrw)");*/

        if ($info['Oras'] > 0) {
            $conn->query("UPDATE address SET CityID = {$info['Oras']} WHERE AddressID = (SELECT AddressID FROM companies WHERE CompanyID = {$this->CompanyID}) ");
        }

        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        }
    }

    public function editCompanyContact($info = array())
    {
        global $conn;

        $query = "UPDATE companies_contacts SET
        				ContactName='{$_GET['ContactName']}',
        				ContactPhone='{$_GET['ContactPhone']}',
        				ContactEmail='{$_GET['ContactEmail']}',
        				ContactFunction='{$_GET['ContactFunction']}'
                      WHERE  ContactID = {$_GET['ContactID']}";
        $conn->query($query);
    }

    public function setCompanyActivity($info = array())
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][2][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE companies a SET
    					    isTrainer      = '" . (!empty($_POST['isTrainer']) ? 1 : 0) . "',
    					    TrainingNotes  = '" . Utils::formatStr($_POST['TrainingNotes']) . "',
    					    CompanyDescr   = '" . Utils::formatStr($_POST['CompanyDescr']) . "',
					    isAssurance    = '" . (!empty($_POST['isAssurance']) ? 1 : 0) . "',
					    isAutoFurnizor    = '" . (!empty($_POST['isAutoFurnizor']) ? 1 : 0) . "',
							AssuranceNotes = '" . Utils::formatStr($_POST['AssuranceNotes']) . "',
							AutoFurnizorNotes ='" . Utils::formatStr($_POST['AutoFurnizorNotes']) . "',
    					    LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  CompanyID = {$this->CompanyID} AND ($condrw)");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        }

        $conn->query("DELETE FROM companies_training_type WHERE CompanyID = {$this->CompanyID}");
        if (!empty($_POST['isTrainer'])) {
            foreach ((array)$_POST['TrainingTypeID'] as $v) {
                $conn->query("INSERT INTO companies_training_type(UserID, PID, CompanyID, TrainingTypeID, CreateDate)
        		      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', {$this->CompanyID}, $v, CURRENT_TIMESTAMP)");
            }
        }
    }

    public function getCompany()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][2][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][2][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][2][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.*, d.*, e.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   companies a
                         LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = a.Oras
                         LEFT JOIN banks e ON a.BankID = e.BankID
                  WHERE  a.CompanyID = '{$this->CompanyID}' AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            if (file_exists('photos/companies/' . md5($row['CompanyID']) . '_100_100.jpg')) {
                $row['photo'] = 'photos/companies/' . md5($row['CompanyID']) . '_100_100.jpg?rn=' . rand(1, 99999999);
            }
            if (file_exists('photos/companies/photo_header_report_' . md5($row['CompanyID']) . '_100_100.jpg')) {
                $row['photo_header_report'] = 'photos/companies/photo_header_report_' . md5($row['CompanyID']) . '_100_100.jpg?rn=' . rand(1, 99999999);
            }
            if (!empty($row['OGFile']) && is_file('uploads/og/' . $row['OGFile'])) {
                $row['OGFilePath'] = 'uploads/og/' . $row['OGFile'];
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_COMPANY'));
        }
    }

    public function getCompanyActivity()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][2][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][2][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][2][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.CompanyName, a.CompanyDescr, a.isTrainer, a.TrainingNotes, a.isAssurance,a.isAutoFurnizor, a.AssuranceNotes, a.AutoFurnizorNotes, 
	                 CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   companies a
                  WHERE  a.CompanyID = {$this->CompanyID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            if ($row['isTrainer'] == 1) {
                $conn->query("SELECT TrainingTypeID FROM companies_training_type WHERE CompanyID = {$this->CompanyID}");
                while ($row2 = $conn->fetch_array()) {
                    $row['training_types'][$row2['TrainingTypeID']] = $row2['TrainingTypeID'];
                }
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_COMPANY'));
        }
    }

    public function getCompanyCAENActivities()
    {

        global $conn;

        $activities = array();
        $conn->query("SELECT * FROM companies_activity WHERE CompanyID = {$this->CompanyID}");
        $i = 0;
        while ($row = $conn->fetch_array()) {
            $row['Activity'] = stripslashes($row['Activity']);
            $activities[chr(65 + $i++)] = $row;
        }
        return $activities;
    }

    public function getCompanyContacts()
    {

        global $conn;

        $activities = array();
        $conn->query("SELECT * FROM companies_contacts a WHERE a.CompanyID = {$this->CompanyID}");
        $i = 0;
        while ($row = $conn->fetch_array()) {
            $row['Contact'] = stripslashes($row['Activity']);
            $contacts[chr(65 + $i++)] = $row;
        }
        return $contacts;
    }

    public function getCompanyPersons()
    {
        global $conn;

        $persons = array();
        $conn->query("SELECT a.PersonID, a.FullName FROM persons a JOIN payroll b ON b.PersonID = a.PersonID AND b.CompanyID = {$this->CompanyID}");
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public function getCompanyTrainers()
    {
        global $conn;

        $persons = array();
        $conn->query("SELECT a.PersonID, a.FullName FROM persons a JOIN payroll b ON b.PersonID = a.PersonID AND b.CompanyID = {$this->CompanyID} WHERE a.Trainer = 1 AND a.Status NOT IN (1, 11, 5, 6) ");
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public function setCompanyCAENActivity()
    {

        global $conn;

        switch ($_GET['action']) {
            case 'add':
                $conn->query("INSERT INTO companies_activity(UserID, PID, CompanyID, CompanyDomainID, Active, CreateDate)
		              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', '{$this->CompanyID}', '" . $_GET['CompanyDomainID'] . "', '{$_GET['active']}', CURRENT_TIMESTAMP)");
                break;
            case 'mod':
                $ID = (int)$_GET['ID'];
                $conn->query("UPDATE companies_activity SET
							    CompanyDomainID     = '" . $_GET['CompanyDomainID'] . "',
							    Active   = '{$_GET['active']}'
		              WHERE  ID = $ID AND CompanyID = {$this->CompanyID}");
                break;
            case 'del':
                $ID = (int)$_GET['ID'];
                $conn->query("DELETE FROM companies_activity WHERE ID = $ID AND CompanyID = {$this->CompanyID}");
                break;
        }
    }

    public function getCompanyLocations()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][2][1][3]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][2][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR '{$_SESSION['USER_RIGHTS2'][2][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][2][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][2][1][3]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $locations = array();
        $query = "SELECT a.CompanyName, b.*, c.*, e.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   companies a
                         LEFT JOIN companies_locations b ON a.CompanyID = b.CompanyID
                         LEFT JOIN address c ON b.AddressID = c.AddressID
                         LEFT JOIN address_city e ON e.CityID = c.CityID
                  WHERE  a.CompanyID = {$this->CompanyID} AND ($condbase)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $locations[] = $row;
        }
        if (empty($locations)) {
            throw new Exception(Message::getMessage('NO_SUCH_COMPANY'));
        }
        foreach ($locations as $k => $v) {
            $locations[$k]['cities'] = Address::getCities($v['DistrictID']);
        }
        if (!empty($locations[0]['ID'])) {
            $locations[] = array();
        }
        return $locations;
    }

    public function setCompanyLocation($info)
    {

        global $conn;

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }

        $CityID = (int)$info['CityID'];
        $conn->query("SELECT AddressID
	              FROM   address
		      WHERE  CityID = $CityID AND StreetName = '{$info['StreetName']}' AND
		             StreetCode = '{$info['StreetCode']}' AND StreetNumber = '{$info['StreetNumber']}' AND
			     Bl = '{$info['Bl']}' AND Sc = '{$info['Sc']}' AND Et = '{$info['Et']}' AND Ap = '{$info['Ap']}'");
        if ($row = $conn->fetch_array()) {
            $AddressID = $row['AddressID'];
            $conn->query("UPDATE address SET 
	                                    AddressType      = '{$info['AddressType']}',
					    MailingAddress   = '{$info['MailingAddress']}',
					    FactoringAddress = '{$info['FactoringAddress']}',
					    DeliveryAddress  = '{$info['DeliveryAddress']}'
			   WHERE AddressID = $AddressID");
        } else {
            $conn->query("INSERT INTO address(UserID, CityID, StreetName, StreetCode, StreetNumber, Bl, Sc, Et, Ap, AddressType, MailingAddress, FactoringAddress, DeliveryAddress)
                    	  VALUES({$_SESSION['USER_ID']}, $CityID, '{$info['StreetName']}', '{$info['StreetCode']}', '{$info['StreetNumber']}', 
			         '{$info['Bl']}', '{$info['Sc']}', '{$info['Et']}', '{$info['Ap']}', 
				 '{$info['AddressType']}', '{$info['MailingAddress']}', '{$info['FactoringAddress']}', '{$info['DeliveryAddress']}')");
            $AddressID = $conn->get_insert_id();
        }

        if ($info['AddressType'] == 1) {
            $conn->query("UPDATE companies SET AddressID = $AddressID, Judet = {$info['DistrictID']}, Oras = $CityID WHERE CompanyID = {$this->CompanyID}");
        }

        if ($info['ID'] > 0) {
            $query = "UPDATE companies_locations SET
    							AddressID          = $AddressID,
    							PhoneNumberA       = '{$info['PhoneNumberA']}',
    							PhoneNumberB       = '{$info['PhoneNumberB']}',
    							FaxNumber          = '{$info['FaxNumber']}',
    							ContactName        = '{$info['ContactName']}',
    							ContactPhone       = '{$info['ContactPhone']}',
    							ContactEmail       = '{$info['ContactEmail']}',
    							ContactFunctionID  = '{$info['ContactFunctionID']}',
    							ContactName2       = '{$info['ContactName2']}',
    							ContactPhone2      = '{$info['ContactPhone2']}',
    							ContactEmail2      = '{$info['ContactEmail2']}',
    							ContactFunctionID2 = '{$info['ContactFunctionID2']}',
    							LastUpdateDate     = CURRENT_TIMESTAMP
    	              WHERE ID = '{$info['ID']}' AND CompanyID = {$this->CompanyID}";
        } else {
            $query = "INSERT INTO companies_locations(UserID, PID, CompanyID, AddressID, PhoneNumberA, PhoneNumberB, FaxNumber, ContactName, ContactPhone, ContactEmail, ContactFunctionID,
    	                                              ContactName2, ContactPhone2, ContactEmail2, ContactFunctionID2, CreateDate, LastUpdateDate)
    	              VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', {$this->CompanyID}, $AddressID, '{$info['PhoneNumberA']}', '{$info['PhoneNumberB']}', '{$info['FaxNumber']}', '{$info['ContactName']}',
    	                      '{$info['ContactPhone']}', '{$info['ContactEmail']}', '{$info['ContactFunctionID']}', '{$info['ContactName2']}', '{$info['ContactPhone2']}', '{$info['ContactEmail2']}', '{$info['ContactFunctionID2']}',
    	                      CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
        }
        $conn->query($query);
    }

    public function delCompanyLocation($ID)
    {

        global $conn;
        $conn->query("DELETE FROM companies_locations WHERE ID = $ID AND CompanyID = {$this->CompanyID}");
    }

    public function delCompany()
    {

        global $conn;

        $query = "DELETE
                  FROM   companies
                  WHERE  CompanyID = {$this->CompanyID} AND
                         {$_SESSION['USER_ID']} = 1 AND
                         NOT EXISTS (SELECT CompanyID FROM jobs WHERE CompanyID = {$this->CompanyID}) AND
			 NOT EXISTS (SELECT PartnerID FROM contract WHERE PartnerID = {$this->CompanyID}) AND
                         NOT EXISTS (SELECT CompanyID FROM trainings WHERE CompanyID = {$this->CompanyID})";
        $conn->query($query);
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Compania nu poate fi stearsa deoarece este implicata in job-uri, contracte sau training-uri!'); window.location.href = './?m=companies';\"></body>";
            exit;
        } else {
            $query = "DELETE FROM companies_activity WHERE CompanyID = {$this->CompanyID}";
            $conn->query($query);
            $query = "DELETE FROM companies_contacts WHERE CompanyID = {$this->CompanyID}";
            $conn->query($query);
            $query = "DELETE FROM companies_locations WHERE CompanyID = {$this->CompanyID}";
            $conn->query($query);
            $query = "DELETE FROM companies_training_type WHERE CompanyID = {$this->CompanyID}";
            $conn->query($query);
        }
    }

    public function delCompanyPhoto()
    {
        if (is_file('photos/companies/' . md5($this->CompanyID) . '.jpg')) {
            @unlink('photos/companies/' . md5($this->CompanyID) . '.jpg');
            @unlink('photos/companies/' . md5($this->CompanyID) . '_100_100.jpg');
        }
    }

    public function delCompanyPhotoHeaderReport()
    {
        if (is_file('photos/companies/photo_header_report_' . md5($this->CompanyID) . '.jpg')) {
            @unlink('photos/companies/photo_header_report_' . md5($this->CompanyID) . '.jpg');
            @unlink('photos/companies/photo_header_report_' . md5($this->CompanyID) . '_100_100.jpg');
        }
    }

    public function delCompanyContact($ID)
    {
        global $conn;

        $query = "DELETE FROM companies_contacts WHERE ContactID = $ID";
        $conn->query($query);
    }

    public function getCompanyContracts()
    {
        global $conn;
        $contracts = array();
        $query = "SELECT a.ContractID, a.ContractNo, a.ContractName, a.SignDate, b.ContractType
	          FROM   contract a
		         LEFT JOIN contract_types b ON a.ContractTypeID = b.ContractTypeID
		  WHERE  a.PartnerID = '{$this->CompanyID}'
		  ORDER  BY a.SignDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $contracts[$row['ContractID']] = $row;
        }
        foreach ($contracts as $ContractID => $contract) {
            $conn->query("SELECT a.ContactName, a.ContactFunction, a.ContactPhone
	                  FROM   companies_contacts a
			         INNER JOIN contract_contacts b ON a.ContactID = b.ContactID AND b.ContractID = {$ContractID}
			  ORDER  BY a.ContactName");
            while ($row = $conn->fetch_array()) {
                $contracts[$ContractID]['contacts'][] = $row;
            }
        }
        return $contracts;
    }
}

?>