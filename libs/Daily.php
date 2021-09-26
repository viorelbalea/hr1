<?php

class Daily
{

    private $DailyID;

    public function __construct($DailyID = 0)
    {
        if ($DailyID > 0) {
            $this->DailyID = $DailyID;
        }
    }

    public static function delDaily($DailyID)
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][5]}' = 3 AND UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][5][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM dailies WHERE DailyID = $DailyID AND ($condrw)");

    }

    public static function getDailyDates()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][5]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][5]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT Date
                  FROM   dailies a
                  WHERE  ($condbase)
                  GROUP BY Date
                  ORDER BY Date ASC";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            while ($row = $conn->fetch_array()) {
                $dates[] = $row;
            }

        } else {
            throw new Exception(Message::getMessage('NO_SUCH_DAILY_DATES'));
        }

        return $dates;
    }

    public static function getAllDailies($action = '')
    {

        global $conn;

        $cond = '';
        if (!empty($_SESSION['PERS']) && $_SESSION['ROLEMNG'] != 1) {
            $pcond = " AND c.PersonID={$_SESSION['PERS']} ";
        }

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                default:
                    $cond .= " AND c.FullName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['PersonID'])) {
            $cond .= " AND c.PersonID = " . (int)$_GET['PersonID'];
        }

        if (!empty($_GET['DateStart'])) {
            $cond .= " AND a.Date >= '" . $_GET['DateStart'] . "'";
        }

        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND a.Date <= '" . $_GET['DateEnd'] . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][5]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][5]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                 FROM   dailies a
                        LEFT JOIN persons c ON a.PersonID=c.PersonID
                 WHERE  ($condbase) $pcond $cond";
        $conn->query($query);

        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $dailies = array();
        $dailies[0]['pageNo'] = $pageNo;
        $dailies[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Scope', 'FullName', 'Date', 'CallsNew', 'CallsBack', 'MeetingsNew', 'MeetingsBack', 'MeetingsDone', 'Reccos')) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS DailyDate, c.FullName
	              FROM   dailies a
                       LEFT JOIN persons c ON a.PersonID=c.PersonID
	              WHERE  ($condbase) $pcond $cond
	              ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        $cnt = 2;
        while ($row = $conn->fetch_array()) {
            $dailies[$cnt] = $row;
            $cnt++;
        }
//Utils::pa($dailies);
        return $dailies;
    }

    public function addDaily($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO dailies(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, " . (int)$_SESSION['PERS'] . ", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");

        return $conn->get_insert_id();
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        $info['Date'] = Utils::toDBDate($info['Date']);
    }

    public function editDaily($info = array())
    {

        global $conn;

        $this->setData($info);

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][5]}' = 3 AND UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][5][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE dailies SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE DailyID = {$this->DailyID} AND ($condrw)");
    }

    public function getDaily()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][14][5][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][14][5]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][14][5]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][5]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][5][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT *, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   dailies a
                  WHERE  DailyID = {$this->DailyID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_DAILY'));
        }
    }
}