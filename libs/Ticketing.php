<?php

class Ticketing extends ConfigData
{

    private $TicketID;

    public function __construct($TicketID = 0)
    {
        parent::__construct();
        if ($TicketID > 0) {
            $this->TicketID = $TicketID;
        }
    }

    public static function getAllTickets($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'Title':
                    $cond .= " AND a.Title LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'Notes':
                    $cond .= " AND a.Notes LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'Notes2':
                    $cond .= " AND a.Notes2 LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'TicketID':
                    $cond .= " AND a.TicketID = '{$_GET['keyword']}'";
                    break;
                case 'ComputerName':
                    $cond .= " AND a.ComputerName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Type'])) {
            $cond .= " AND a.Type = " . (int)$_GET['Type'];
        }
        if (!empty($_GET['Status']) && $_GET['Status'] != '|') {
            $cond .= " AND a.Status IN (" . str_replace('|', ',', substr($_GET['Status'], 1, -1)) . ")";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.CompanyID = " . (int)$_GET['CompanyID'];
        }
        if (!empty($_GET['Priority'])) {
            $cond .= " AND a.Priority = " . (int)$_GET['Priority'];
        }
        if (!empty($_GET['Importance'])) {
            $cond .= " AND a.Importance = " . (int)$_GET['Importance'];
        }
        if (!empty($_GET['AssignedPersonID'])) {
            $cond .= " AND a.AssignedPersonID = " . (int)$_GET['AssignedPersonID'];
        }
        if (!empty($_GET['CategoryID'])) {
            $cond .= " AND a.CategoryID = " . (int)$_GET['CategoryID'];
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND h.DepartmentID = " . (int)$_GET['DepartmentID'];
        }
        if (!empty($_GET['AppVersionID'])) {
            $cond .= " AND a.AppVersionID = " . (int)$_GET['AppVersionID'];
        }

        $_GET['DateStart'] = !empty($_GET['DateStart']) ? Utils::toDBDate($_GET['DateStart']) : '';
        $_GET['DateEnd'] = !empty($_GET['DateEnd']) ? Utils::toDBDate($_GET['DateEnd']) : '';

        if (!empty($_GET['DateStart'])) {
            $cond .= " AND a.CreateDate >= '{$_GET['DateStart']}'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND a.CreateDate <= '" . date("Y-m-d", strtotime($_GET['DateEnd'] . "+1 day")) . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][30][1]}' = 1 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][30][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   ticketing a
		    " . (!empty($_GET['search_for']) && $_GET['search_for'] == 'CompanyID' ? "LEFT JOIN companies c ON a.CompanyID = c.CompanyID" : "") . "
                   LEFT JOIN persons e ON a.AssignedPersonID = e.PersonID
			 		LEFT JOIN payroll f ON e.PersonID=f.PersonID
			 		LEFT JOIN departments h ON f.DepartmentID=h.DepartmentID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $items = array();
        $items[0]['pageNo'] = $pageNo;
        $items[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.TicketID';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, av.VersionName, av.VersionLivrare, app.Application, 
	                 CASE 
						WHEN b.FullName IS NOT NULL THEN b.FullName 
						ELSE CONCAT(CASE 
										WHEN d.ContactName IS NULL THEN '' 
										ELSE d.ContactName 
										END, 
								' - ', 
									CASE 
										WHEN c.CompanyName IS NULL THEN '' 
										ELSE c.CompanyName 
										END
									) 
						END AS Author,
			 e.FullName AS AssignedFullName
	          FROM   ticketing a
		         LEFT JOIN persons b ON a.PersonID = b.PersonID
				 LEFT JOIN companies c ON a.CompanyID = c.CompanyID
				 LEFT JOIN companies_contacts d ON a.ContactID = d.ContactID
				 LEFT JOIN persons e ON a.AssignedPersonID = e.PersonID
				 LEFT JOIN payroll f ON e.PersonID=f.PersonID
				 LEFT JOIN departments h ON f.DepartmentID=h.DepartmentID
				 LEFT JOIN applications_versions av ON a.AppVersionID = av.VersionID
				 LEFT JOIN applications app ON av.AppID = app.AppID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);

        /*
$query = "SELECT a.*, av.VersionName, av.VersionLivrare, app.Application,
                 CASE WHEN b.FullName IS NOT NULL THEN b.FullName ELSE CONCAT(CASE WHEN d.ContactName IS NULL THEN '' ELSE d.ContactName END, ' - ', CASE WHEN c.CompanyName IS NULL THEN '' ELSE c.CompanyName END) END AS Author,
         e.FullName AS AssignedFullName
          FROM   ticketing a
             LEFT JOIN persons b ON a.PersonID = b.PersonID
             LEFT JOIN companies c ON a.CompanyID = c.CompanyID
             LEFT JOIN companies_contacts d ON a.ContactID = d.ContactID
             LEFT JOIN persons e ON a.AssignedPersonID = e.PersonID
             LEFT JOIN payroll f ON e.PersonID=f.PersonID
             LEFT JOIN departments h ON f.DepartmentID=h.DepartmentID
             LEFT JOIN applications_versions av ON a.AppVersionID = av.VersionID
             LEFT JOIN applications app ON av.AppID = app.AppID
          WHERE  ($condbase) $cond
          ORDER  BY $order_by $asc_or_desc " .
          (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
          */
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['DisplayVersion'] = Application::getDisplayVersionFromVersionRow($row);
            $items[$row['TicketID']] = $row;

            $items[$row['TicketID']]['NotesX'] = substr($items[$row['TicketID']]['Notes'], 0, 100);
            if (strlen($items[$row['TicketID']]['Notes']) > 100)
                $items[$row['TicketID']]['NotesX'] .= "(...)";
            $items[$row['TicketID']]['Notes'] = str_replace("  ", " &nbsp; ", $items[$row['TicketID']]['Notes']);

            $items[$row['TicketID']]['Notes2X'] = substr($items[$row['TicketID']]['Notes2'], 0, 100);
            if (strlen($items[$row['TicketID']]['Notes2']) > 100)
                $items[$row['TicketID']]['Notes2X'] .= "(...)";
            $items[$row['TicketID']]['Notes2'] = str_replace("  ", " &nbsp; ", $items[$row['TicketID']]['Notes2']);

        }

        return $items;
    }

    public static function getPersons()
    {
        global $conn;
        $persons = array();
        $query = "SELECT PersonID, LastName, FirstName, FullName FROM persons WHERE Status IN (2,7,9,10) ORDER BY FirstName, LastName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
//	    $persons[$row['PersonID']] = $row['FullName'];
            $persons[$row['PersonID']] = $row['FirstName'] . ' ' . $row['LastName'];
        }
        return $persons;
    }

    public static function getCompanies()
    {
        global $conn;
        $companies = array();
        $query = "SELECT a.CompanyID, a.CompanyName, c.ContactID, c.ContactName, c.ContactPhone, c.ContactEmail, c.ContactFunction
	          FROM   companies a
		         LEFT JOIN companies_contacts c ON a.CompanyID = c.CompanyID
		  WHERE  a.Self = 1
		  ORDER  BY a.CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']]['CompanyName'] = $row['CompanyName'];
            }
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactName'] = $row['ContactName'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactPhone'] = $row['ContactPhone'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactEmail'] = $row['ContactEmail'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactFunction'] = $row['ContactFunction'];
        }
        $query = "SELECT DISTINCT a.CompanyID, a.CompanyName, c.ContactID, c.ContactName, c.ContactPhone, c.ContactEmail, c.ContactFunction
	          FROM   companies a
		         INNER JOIN contract b ON a.CompanyID = b.PartnerID
			 LEFT JOIN companies_contacts c ON a.CompanyID = c.CompanyID
		  ORDER  BY a.CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']]['CompanyName'] = $row['CompanyName'];
            }
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactName'] = $row['ContactName'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactPhone'] = $row['ContactPhone'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactEmail'] = $row['ContactEmail'];
            $companies[$row['CompanyID']]['Contacts'][$row['ContactID']]['ContactFunction'] = $row['ContactFunction'];
        }
        $query = "SELECT ProjectID, Code, Name, CompanyID FROM pontaj_projects WHERE Type != 4";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']]['Projects'][$row['ProjectID']]['Code'] = $row['Code'];
                $companies[$row['CompanyID']]['Projects'][$row['ProjectID']]['Name'] = $row['Name'];
            }
        }
        $query = "SELECT a.ContractID, a.ContractName, a.Status, a.PartnerID, b.ContractType
	          FROM   contract a
		         INNER JOIN contract_types b ON a.ContractTypeID = b.ContractTypeID
		  WHERE	 a.Status NOT IN (3, 4, 5)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (isset($companies[$row['PartnerID']])) {
                $companies[$row['PartnerID']]['Contracts'][$row['ContractID']] = $row['ContractName'] . ' - ' . $row['ContractType'] . ' - ' . ConfigData::$msContractStatus[$row['Status']];
            }
        }
        return $companies;
    }

    public static function getCompaniesForListTickets()
    {
        global $conn;
        $companies = array();

        $query = "SELECT a.CompanyID, a.CompanyName
	          FROM   companies a
		  WHERE  a.Self = 1
		  ORDER  BY a.CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']] = $row['CompanyName'];
            }
        }

        $query = "SELECT DISTINCT a.CompanyID, a.CompanyName
					FROM   companies a
					INNER JOIN contract b ON a.CompanyID = b.PartnerID
				WHERE	 b.Status NOT IN (3, 4, 5)
				ORDER BY a.CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']] = $row['CompanyName'];
            }
        }

        $query = "SELECT DISTINCT a.CompanyID, a.CompanyName
					FROM   companies a
					INNER JOIN ticketing b ON a.CompanyID = b.CompanyID
				WHERE b.Status != 6
				ORDER BY a.CompanyName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (!isset($companies[$row['CompanyID']])) {
                $companies[$row['CompanyID']] = $row['CompanyName'];
            }
        }

        asort($companies);

        $lstCompanies = array();
        foreach ($companies as $key => $value) {
            $lstCompanies[$key]['CompanyName'] = $value;
        }

        return $lstCompanies;
    }

    public function addTicket($info = array())
    {

        $this->setData($info);
        //$info['Status']    = 1;
        $info['ContactID'] = (int)$info['ContactID'];

        global $conn;

        $conn->query("INSERT INTO ticketing(UserID, PID, CreateDate, LastUpdateDate, UserIDLast, PIDLast, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, {$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', '" . implode("', '", $info) . "')");
        $this->TicketID = $conn->get_insert_id();
        $conn->query("SELECT a.TicketID, a.Status, a.AssignedPersonID, a.Notes, a.Notes2, a.CreateDate,
				     b.FullName AS FullNameAssigned, b.Email AS EmailAssigned,
				     c.FullName AS FullNameAssigner, c.Email AS EmailAssigner,
				     d.CompanyName AS CompanyNameAssigner, f.Department AS DepartmentAssigned
			      		FROM ticketing a
			           LEFT JOIN persons b ON a.AssignedPersonID = b.PersonID
			           LEFT JOIN payroll e ON a.AssignedPersonID=e.PersonID
			           LEFT JOIN departments f ON e.DepartmentID=f.DepartmentID
				   		LEFT JOIN persons c ON a.PersonID = c.PersonID
				   		LEFT JOIN companies d ON a.CompanyID=d.CompanyID
			      WHERE TicketID = {$this->TicketID}");
        if ($row = $conn->fetch_array()) {
            // Compose and Send email
            $message = "<b>ID Ticket</b>: " . $row['TicketID'] . "<br>";
            $message .= "<b>Descriere</b>:<br> " . nl2br($row['Notes']) . "<br>";
            $message .= !empty($row['Notes2']) ? "<b>Pasi reproducere</b>:<br> " . nl2br($row['Notes2']) . "<br><br>" : "";
            $message .= "<b>Catre departament</b>: " . $row['DepartmentAssigned'] . "<br>";
            $message .= "<b>Solicitant intern</b>:  " . $row['FullNameAssigner'] . "<br>";
            $message .= "<b>Companie solicitanta</b>:  " . $row['CompanyNameAssigner'] . "<br>";

            include('sendMail.php');
            sendMail('HR Executive Ticketing', Config::SMTP_EMAIL, $row['FullNameAssigned'], $row['EmailAssigned'], 'Tichet - ' . $row['TicketID'] . ' - ' . self::$msTicketingStatus[$row['Status']], $message);
            sendMail('HR Executive Ticketing', Config::SMTP_EMAIL, $row['FullNameAssigner'], $row['EmailAssigner'], 'Tichet - ' . $row['TicketID'] . ' - ' . self::$msTicketingStatus[$row['Status']], $message);
        }
        return $this->TicketID;
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }

        if (!$info['PersonID'] && !$info['CompanyID']) {
            throw new Exception('Nu ati specificat emitent intern sau extern');
        }
        if (!$info['Priority']) {
            throw new Exception('Nu ati specificat prioritate');
        }
        if (!$info['Importance']) {
            throw new Exception('Nu ati specificat importanta');
        }
        if (!$info['Type']) {
            throw new Exception('Nu ati specificat tip tichet');
        }
        if (!$info['Notes']) {
            throw new Exception('Nu ati specificat descriere');
        }
        if ($info['Status'] == 1 && $info['AssignedPersonID'] > 0) {
            throw new Exception('Trebuie schimbat statusul tichetului');
        }

        $info['InterventionStartDate'] = (!empty($info['InterventionStartDate']) ? $info['InterventionStartDate'] : '0000-00-00') . ' ' . (!empty($info['InterventionStartHour']) ? $info['InterventionStartHour'] : '00:00') . ':00';
        $info['InterventionEndDate'] = (!empty($info['InterventionEndDate']) ? $info['InterventionEndDate'] : '0000-00-00') . ' ' . (!empty($info['InterventionEndHour']) ? $info['InterventionEndHour'] : '00:00') . ':00';

        unset($info['InterventionStartHour']);
        unset($info['InterventionEndHour']);

        $info['InterventionStartDate'] = !empty($info['InterventionStartDate']) ? Utils::toDBDateTime($info['InterventionStartDate']) : '0000-00-00 00:00:00';
        $info['InterventionEndDate'] = !empty($info['InterventionEndDate']) ? Utils::toDBDateTime($info['InterventionEndDate']) : '0000-00-00 00:00:00';
    }

    public function editTicket($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del_doc':
                    @unlink($_GET['doc']);
                    break;
                case 'save_comment':
                    if (!empty($_GET['ID'])) {
                        $conn->query("UPDATE ticketing_history SET Comment = '" . Utils::formatStr($_GET['Comment']) . "' WHERE ID = '{$_GET['ID']}' AND TicketID = {$this->TicketID}");
                    } else {
                        $conn->query("UPDATE ticketing SET Comment = '" . Utils::formatStr($_GET['Comment']) . "' WHERE TicketID = {$this->TicketID}");
                    }
                    break;
            }
            return;
        }

        $this->setData($info);
        $info['ContactID'] = (int)$info['ContactID'];

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][30][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][30][1]}' = 1 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][30][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][30][1]}' = 3 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][30][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $conn->query("SELECT TicketID, Status, AssignedPersonID, Priority, Importance, Type, Comment, UserIDLast, PIDLast, LastUpdateDate FROM ticketing a WHERE TicketID = {$this->TicketID} AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $conn->query("UPDATE ticketing a SET $update LastUpdateDate = CURRENT_TIMESTAMP, UserIDLast = {$_SESSION['USER_ID']}, PIDLast = '{$_SESSION['PERS']}' WHERE TicketID = {$this->TicketID} AND ($condrw)");
            if ($row['Status'] != $info['Status'] || $row['AssignedPersonID'] != $info['AssignedPersonID'] || $row['Priority'] != $info['Priority'] || $row['Importance'] != $info['Importance'] || $row['Type'] != $info['Type']) {
                $conn->query("INSERT INTO ticketing_history(UserID, PID, TicketID, Status, AssignedPersonID, Priority, Importance, Type, Comment, CreateDate) 
		              VALUES({$row['UserIDLast']}, {$row['PIDLast']}, {$this->TicketID}, {$row['Status']}, {$row['AssignedPersonID']}, {$row['Priority']}, {$row['Importance']}, {$row['Type']}, '{$row['Comment']}', '{$row['LastUpdateDate']}')");
                $conn->query("UPDATE ticketing SET Comment = '' WHERE TicketID = {$this->TicketID}");
                // Get new ticket data
                $conn->query("SELECT a.TicketID, a.Status, a.AssignedPersonID, a.Notes, a.Notes2, a.CreateDate, 
				     b.FullName AS FullNameAssigned, b.Email AS EmailAssigned,
				     c.FullName AS FullNameAssigner, c.Email AS EmailAssigner,
				     d.CompanyName AS CompanyNameAssigner, f.Department AS DepartmentAssigned
			      		FROM ticketing a 
			           LEFT JOIN persons b ON a.AssignedPersonID = b.PersonID
			           LEFT JOIN payroll e ON a.AssignedPersonID=e.PersonID
			           LEFT JOIN departments f ON e.DepartmentID=f.DepartmentID
				   		LEFT JOIN persons c ON a.PersonID = c.PersonID
				   		LEFT JOIN companies d ON a.CompanyID=d.CompanyID
			      WHERE TicketID = {$this->TicketID} AND ($condbase)");
                if ($row = $conn->fetch_array()) {
                    // Compose and Send email
                    $message = "<b>ID Ticket</b>: " . $row['TicketID'] . "<br>";
                    $message .= "<b>Descriere</b>:<br> " . nl2br($row['Notes']) . "<br>";
                    $message .= !empty($row['Notes2']) ? "<b>Pasi reproducere</b>:<br> " . nl2br($row['Notes2']) . "<br><br>" : "";
                    $message .= "<b>Catre departament</b>: " . $row['DepartmentAssigned'] . "<br>";
                    $message .= "<b>Solicitant intern</b>:  " . $row['FullNameAssigner'] . "<br>";
                    $message .= "<b>Companie solicitanta</b>:  " . $row['CompanyNameAssigner'] . "<br>";

                    include('sendMail.php');
                    sendMail('HR Executive Ticketing', Config::SMTP_EMAIL, $row['FullNameAssigned'], $row['EmailAssigned'], 'Tichet - ' . $row['TicketID'] . ' - ' . self::$msTicketingStatus[$row['Status']], $message);
                    sendMail('HR Executive Ticketing', Config::SMTP_EMAIL, $row['FullNameAssigner'], $row['EmailAssigner'], 'Tichet - ' . $row['TicketID'] . ' - ' . self::$msTicketingStatus[$row['Status']], $message);
                }
            }
        } else {
            throw new Exception('Nu exista acest tichet!');
        }
    }

    public function delTicket()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][30][1]}' = 3 AND ((UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][30][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM ticketing WHERE TicketID = {$this->TicketID} AND ($condrw)");
    }

    public function getTicketCategoryDefault($CategoryID)
    {
        global $conn;
        $sql = "select * from ticketing_categories where id='" . $CategoryID . "'";
        $req = $conn->query($sql);
        $row = $conn->fetch_array();
        return $row['assign_default'];
    }

    public function getTicketCategoryDefaultPerson($CategoryID)
    {
        global $conn;
        $sql = "select * from ticketing_categories where id='" . $CategoryID . "'";
        $req = $conn->query($sql);
        $row = $conn->fetch_array();
        return $row['assign_person'];
    }

    public function setTicketCategoryDefault($CategoryID, $assign_default, $assign_person = 0)
    {
        global $conn;
        $sql = "update ticketing_categories 
					set	
						assign_default='" . $assign_default . "', 
						assign_person='" . $assign_person . "'
					where
						id='" . $CategoryID . "'";
        return $conn->query($sql);
    }

    public function getTicket()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][30][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][30][1]}' = 1 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][30][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][30][1]}' = 3 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][30][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, TIMEDIFF(a.InterventionEndDate, a.InterventionStartDate) AS InterventionDuration, TIMEDIFF(DATE_ADD(a.InterventionEndDate, INTERVAL a.TransportTime MINUTE), a.InterventionStartDate) as InterventionTotalDuration, c.ContactPhone, c.ContactEmail, c.ContactFunction,
	                 CASE WHEN a.PIDLast > 0 THEN (SELECT FullName FROM persons WHERE PersonID = a.PIDLast) ELSE (SELECT UserName FROM users WHERE UserID = a.UserIDLast) END AS UserLast,
	                 CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   ticketing a
		         " . ($_SESSION['ROLEMNG'] == 1 ? "LEFT JOIN payroll b ON a.PID = b.PersonID" : "") . "
					LEFT JOIN companies_contacts c ON a.ContactID = c.ContactID
                  WHERE  a.TicketID = {$this->TicketID} AND ($condbase)";

        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['ContactID'] = $row['ContactID'] . '|' . $row['ContactFunction'] . '|' . $row['ContactPhone'] . '|' . $row['ContactEmail'];
            $row['InterventionDuration'] = substr($row['InterventionDuration'], 0, -3); //without seconds;
            $row['InterventionTotalDuration'] = substr($row['InterventionTotalDuration'], 0, -3); //without seconds;

            if ((int)$row['AppVersionID'] > 0) {
                $versions = Application::GetApplicationVersions(-1, true, (int)$row['AppVersionID']);
                if (!empty($versions) && count($versions) > 0) {
                    $version = $versions[(int)$row['AppVersionID']];
                    $row['AppVersionObject'] = $version;
                }
            }
            return $row;
        } else {
            throw new Exception('Nu exista acest tichet!');
        }
    }

    public function getTicketHistory()
    {
        global $conn;
        $history = array();
        $conn->query("SELECT a.*, b.FullName,
	                     CASE WHEN a.PID > 0 THEN (SELECT FullName FROM persons WHERE PersonID = a.PID) ELSE (SELECT UserName FROM users WHERE UserID = a.UserID) END AS FullNameLast
	              FROM   ticketing_history a
		             LEFT JOIN persons b ON a.AssignedPersonID = b.PersonID
		      WHERE  a.TicketID = {$this->TicketID} 
		      ORDER  BY a.ID");
        while ($row = $conn->fetch_array()) {
            $history[] = $row;
        }
        return $history;
    }

    public function getTicketForReport()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.DirectManagerID = '{$_SESSION['PERS']}' " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][30][1][1]}' > 0 AND
					 (('{$_SESSION['USER_RIGHTS2'][30][1]}' = 1 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}')) OR
					 '{$_SESSION['USER_RIGHTS2'][30][1]}' > 1))
				 OR
				 {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][30][1]}' = 3 AND ((a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['ROLE']}' = '') OR a.PID = '{$_SESSION['PERS']}' $condmng OR a.AssignedPersonID = '{$_SESSION['PERS']}'))
					 OR
					 '{$_SESSION['USER_RIGHTS3'][30][1][1]}' = 2
				 OR
				 {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, TIMEDIFF(a.InterventionEndDate, a.InterventionStartDate) AS InterventionDuration, TIMEDIFF(DATE_ADD(a.InterventionEndDate, INTERVAL a.TransportTime MINUTE), a.InterventionStartDate) as InterventionTotalDuration, 
						adr.StreetName, adr.StreetCode, adr.StreetNumber, adr.Bl, adr.Sc, adr.Et, adr.Ap,
						oras.CityName AS CompanyOras, jud.DistrictName as CompanyJudet, c.PhoneNumberA as CompanyPhone, c.CompanyName,
						pers.FullName as AssignedFullName, pers.Mobile as AssignedMobile, solic.FullName as SolicitantFullName, 
						CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
					FROM  ticketing a
					 " . ($_SESSION['ROLEMNG'] == 1 ? "LEFT JOIN payroll b ON a.PID = b.PersonID" : "") . "
					LEFT JOIN companies c ON a.CompanyID = c.CompanyID
					LEFT JOIN address adr ON adr.AddressID = c.AddressID
					LEFT JOIN address_city oras ON oras.CityID = adr.CityID
					LEFT JOIN address_district jud ON jud.DistrictID = oras.DistrictID
					LEFT JOIN persons pers ON a.AssignedPersonID = pers.PersonID
					LEFT JOIN persons solic ON a.PersonID = solic.PersonID
				 
					WHERE  a.TicketID = {$this->TicketID} AND ($condbase)";

        $conn->query($query);


        if ($row = $conn->fetch_array()) {
            if ($row['StreetName']) $CompanyAddress .= 'Strada: ' . $row['StreetName'];
            if ($row['StreetCode']) $CompanyAddress .= ', Cod postal: ' . $row['StreetCode'];
            if ($row['StreetNumber']) $CompanyAddress .= ', Numar: ' . $row['StreetNumber'];
            if ($row['Bl']) $CompanyAddress .= ', Bl: ' . $row['Bl'];
            if ($row['Sc']) $CompanyAddress .= ', Sc: ' . $row['Sc'];
            if ($row['Et']) $CompanyAddress .= ', Et: ' . $row['Et'];
            if ($row['Ap']) $CompanyAddress .= ', Ap: ' . $row['Ap'];
            $row['CompanyAddress'] = $CompanyAddress;

            $row['ReportedProblem'] = $row['Notes'] . (!empty($row['Notes2']) ? '<br/>Pasi de reproducere: ' . $row['Notes2'] : '');
            $row['EquipmentLocation'] = $row['Location'] . (!empty($row['ComputerName']) ? ', Nume computer: ' . $row['ComputerName'] : '');
            $row['InterventionDuration'] = substr($row['InterventionDuration'], 0, -3); //without seconds;
            $row['InterventionTotalDuration'] = substr($row['InterventionTotalDuration'], 0, -3); //without seconds;

            return $row;
        } else {
            throw new Exception('Nu exista acest tichet!');
        }

    }

}