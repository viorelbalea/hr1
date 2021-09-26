<?php

class Ticket extends ConfigData
{

    private $TicketID;

    public function __construct($TicketID = 0)
    {
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
                case 'Comments';
                    $cond .= " AND a.Comments LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['ReportID'])) {
            $cond .= " AND a.ReportID = " . (int)$_GET['ReportID'];
        }
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }
        if (!empty($_GET['Type'])) {
            $cond .= " AND a.Type = " . (int)$_GET['Type'];
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND c.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['DivisionID'])) {
            $cond .= " AND c.DivisionID = '{$_GET['DivisionID']}'";
        }
        if (!empty($_GET['DepartmentID'])) {
            $cond .= " AND c.DepartmentID = '{$_GET['DepartmentID']}'";
        }
        if (!empty($_GET['SubDepartmentID'])) {
            $cond .= " AND c.SubDepartmentID = '{$_GET['SubDepartmentID']}'";
        }
        /*
        if (!empty($_GET['CostCenterID'])) {
                $cond.= " AND c.CostcenterID = '{$_GET['CostCenterID']}'";
            }
        */

        $_GET['DateStart'] = !empty($_GET['DateStart']) ? Utils::toDBDate($_GET['DateStart']) : '';
        $_GET['DateEnd'] = !empty($_GET['DateEnd']) ? Utils::toDBDate($_GET['DateEnd']) : '';
        $_GET['NextDateStart'] = !empty($_GET['NextDateStart']) ? Utils::toDBDate($_GET['NextDateStart']) : '';
        $_GET['NextDateEnd'] = !empty($_GET['NextDateEnd']) ? Utils::toDBDate($_GET['NextDateEnd']) : '';

        if (!empty($_GET['DateStart'])) {
            $cond .= " AND a.CreateDate >= '{$_GET['DateStart']}'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND a.CreateDate <= '{$_GET['DateEnd']}'";
        }
        if (!empty($_GET['NextDateStart'])) {
            $cond .= " AND a.LimitDate >= '{$_GET['NextDateStart']}'";
        }
        if (!empty($_GET['NextDateEnd'])) {
            $cond .= " AND a.LimitDate <= '{$_GET['NextDateEnd']}'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][29][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][29][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   tickets a
                   LEFT JOIN persons b ON a.PID=b.PersonID
	          	   LEFT JOIN payroll c ON b.PersonID=c.PersonID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $items = array();
        $items[0]['pageNo'] = $pageNo;
        $items[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT *, a.Status AS TicketStatus,a.Type AS TicketType,
			  CASE WHEN a.CreateDate > '0000-00-00' THEN DATE_FORMAT(a.CreateDate, '%d.%m.%Y') ELSE '' END AS TCreateDate,
			  CASE WHEN a.LimitDate > '0000-00-00' THEN DATE_FORMAT(a.LimitDate, '%d.%m.%Y') ELSE '' END AS TLimitDate,
			  CASE WHEN a.LastUpdateDate > '0000-00-00' THEN DATE_FORMAT(a.LastUpdateDate, '%d.%m.%Y') ELSE '' END AS TLastUpdateDate
	          FROM   tickets a
	          LEFT JOIN persons b ON a.PID=b.PersonID
	          LEFT JOIN payroll c ON b.PersonID=c.PersonID
	          LEFT JOIN reports d ON a.ReportID=d.ReportID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $items[$row['TicketID']] = $row;
        }

        return $items;
    }

    public static function getReportsByTypes($type = '')
    {
        global $conn;

        $cond = '';
        if (!empty($type))
            $cond .= " AND Type=$type";

        $query = "SELECT * FROM reports WHERE 1=1 $cond ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $items[$row['Type']][$row['ReportID']] = $row;
            //echo "zzz";
        }
        return $items;
    }

    public function addTicket($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO tickets(UserID, PID, ReportID, Status, Type, Comments, LimitDate, CreateDate, LastUpdateDate)
                      VALUES({$_SESSION['USER_ID']}," . (int)$_SESSION['PERS'] . ",'{$_POST['ReportID']}','{$_POST['Status']}','{$_POST['Type']}', '{$info['Comments']}', '{$info['LimitDate']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        $this->TicketID = $conn->get_insert_id();

        return $this->TicketID;
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }

        $info['LimitDate'] = !empty($info['LimitDate']) ? Utils::toDBDate($info['LimitDate']) : '';

        if (!$info['ReportID'] && $info['Type'] != 3) {
            throw new Exception(Message::getMessage('TICKET_REPORT_EMPTY'));
        }
        if (!$info['Status']) {
            throw new Exception(Message::getMessage('TICKET_STATUS_EMPTY'));
        }
        if (!$info['LimitDate']) {
            throw new Exception(Message::getMessage('TICKET_LDATE_EMPTY'));
        }

    }

    public function editTicket($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("UPDATE tickets SET
							 ReportID={$info['ReportID']},
							 Status={$info['Status']},
							 Type={$info['Type']},
							 Comments='{$info['Comments']}',
							 LimitDate='{$info['LimitDate']}',
							 LastUpdateDate=CURRENT_TIMESTAMP
							 WHERE TicketID={$this->TicketID}");
    }

    public function delTicket()
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][29][1]}' = 3 AND (UserID = {$_SESSION['USER_ID']} OR PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][29][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM tickets WHERE TicketID = {$this->TicketID} AND ($condrw)");
    }

    public function getTicket()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][29][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][29][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][29][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][29][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][29][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   tickets a
                  WHERE  a.TicketID = {$this->TicketID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception('Nu exista acest tichet!');
        }
    }
}