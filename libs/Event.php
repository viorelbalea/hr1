<?php

class Event extends ConfigData
{

    private $EventID;

    public function __construct($EventID = 0)
    {
        if ($EventID > 0) {
            $this->EventID = $EventID;
        }
    }

    public static function getAllEvents($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'Scope';
                    $cond .= " AND a.Scope LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (c.FullName LIKE '{$_GET['keyword']}%' OR c.FullName LIKE '% {$_GET['keyword']}%')";
                    break;
            }
        }

        if (!empty($_GET['EventType'])) {
            $cond .= " AND a.EventType = " . (int)$_GET['EventType'];
        } else {
            $cond .= " AND a.EventType NOT IN (5,6)";
        }

        $_GET['DateStart'] = !empty($_GET['DateStart']) ? Utils::toDBDate($_GET['DateStart']) : '';
        $_GET['DateEnd'] = !empty($_GET['DateEnd']) ? Utils::toDBDate($_GET['DateEnd']) : '';

        if (!empty($_GET['DateStart'])) {
            $cond .= " AND a.EventData >= '{$_GET['DateStart']}'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND a.EventData <= '{$_GET['DateEnd']}'";
        }


        $condbase = "('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        if (!empty($_GET['PersonID'])) {
            $cond .= " AND a.EventID IN (SELECT EventID FROM event_persons WHERE PersonID = " . (int)$_GET['PersonID'] . " AND ($condbase)) ";
        }

        $condbase = "('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   events a
                          INNER JOIN users b ON a.UserID = b.UserID
                          INNER JOIN persons c ON a.ConsultantID = c.PersonID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $events = array();
        $events[0]['pageNo'] = $pageNo;
        $events[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Scope', 'UserName', 'FullName', 'Details', 'EventType', 'EventData')) ? $_GET['order_by'] : 'a.Scope';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.UserName, c.FullName, DATE_FORMAT(a.EventData, '%d.%m.%Y') AS fEventData
	          FROM   events a
                         INNER JOIN users b ON a.UserID = b.UserID
                         INNER JOIN persons c ON a.ConsultantID = c.PersonID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[$row['EventID']] = $row;
        }

        return $events;
    }

    public static function getAllInterviews($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'Scope';
                    $cond .= " AND a.Scope LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (c.FullName LIKE '{$_GET['keyword']}%' OR c.FullName LIKE '% {$_GET['keyword']}%')";
                    break;
            }
        }

        if (!empty($_GET['EventType'])) {
            $cond .= " AND a.EventType = " . (int)$_GET['EventType'];
        } else {
            $cond .= " AND a.EventType IN (5,6)";
        }

        $_GET['DateStart'] = !empty($_GET['DateStart']) ? Utils::toDBDate($_GET['DateStart']) : '';
        $_GET['DateEnd'] = !empty($_GET['DateEnd']) ? Utils::toDBDate($_GET['DateEnd']) : '';

        if (!empty($_GET['DateStart'])) {
            $cond .= " AND a.EventData >= '{$_GET['DateStart']}'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND a.EventData <= '{$_GET['DateEnd']}'";
        }

        $condbase = "('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        if (!empty($_GET['PersonID'])) {
            $cond .= " AND a.EventID IN (SELECT EventID FROM event_persons WHERE PersonID = " . (int)$_GET['PersonID'] . " AND ($condbase)) ";
        }

        $condbase = "('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   events a
                          INNER JOIN users b ON a.UserID = b.UserID
                          INNER JOIN persons c ON a.ConsultantID = c.PersonID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $events = array();
        $events[0]['pageNo'] = $pageNo;
        $events[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Scope', 'UserName', 'FullName', 'Details', 'EventType', 'EventData')) ? $_GET['order_by'] : 'a.Scope';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.UserName, c.FullName, DATE_FORMAT(a.EventData, '%d.%m.%Y') AS fEventData
	          FROM   events a
                         INNER JOIN users b ON a.UserID = b.UserID
                         INNER JOIN persons c ON a.ConsultantID = c.PersonID
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[$row['EventID']] = $row;
        }

        return $events;
    }

    public static function getEventsByPerson($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][22]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT FullName, Status FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $events[] = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $query = "SELECT DATE_FORMAT(a.EventData, '%d.%m.%Y') AS Data, a.EventType, a.EventRelation, a.Scope, a.Details
	          FROM   events a
	                 INNER JOIN event_persons b ON a.EventID = b.EventID AND b.PersonID = $PersonID
	                 INNER JOIN persons c ON b.PersonID = c.PersonID
	          ORDER  BY a.EventData";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[] = $row;
        }
        return $events;
    }

    public static function getAllEventsByPlanif($action = '')
    {

        global $conn, $days;

        $curr_date = date('Y-m-d');
        $curr_year = date('Y');
        $curr_month = date('m');
        $curr_day = date('d');

        if (!empty($_GET['week'])) {
            $curr_day += 7 * (int)$_GET['week'];
            $curr_date = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));
        }

        $weekday = date('w', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));

        if ($weekday == 0) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
        } elseif ($weekday == 1) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        } else {
            $days[] = $curr_date;
            for ($i = 1; $i < $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
            for ($i = 1; $i <= 7 - $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        }
        sort($days);

        $events = array();

        $query = "SELECT a.*
                  FROM   events a
                  WHERE  a.EventData BETWEEN '{$days[0]}' AND '{$days[6]}'
		  ORDER  BY a.EventData, a.EventHourStart";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[$row['EventData']][$row['EventHourStart']][$row['EventID']] = $row;
        }

        foreach ($events as $EventData => $v) {
            foreach ($v as $EventHourStart => $vv) {
                foreach ($vv as $EventID => $vvv) {
                    $fEventHourStart = strtotime("$EventData $EventHourStart");
                    $fEventHourStop = strtotime("$EventData {$vvv['EventHourStop']}");
                    while ($fEventHourStart + 15 * 60 < $fEventHourStop) {
                        $fEventHourStart += 15 * 60;
                        $events[$EventData][date('H:i', $fEventHourStart)][$EventID] = $vvv;
                    }
                }
            }
        }

        return $events;
    }

    public function addEvent($info = array())
    {

        $this->setData($info);

        global $conn;

        unset($info['PersonType']);

        $conn->query("SELECT EventID 
	              FROM   events 
		      WHERE  RoomID = '{$info['RoomID']}' AND EventData = '{$info['EventData']}' AND 
			     (('{$info['EventHourStart']}' >= EventHourStart AND '{$info['EventHourStart']}' < EventHourStop) OR 
			      ('{$info['EventHourStop']}' > EventHourStart AND '{$info['EventHourStop']}' <= EventHourStop) OR
			      ('{$info['EventHourStart']}' <= EventHourStart AND '{$info['EventHourStop']}' >= EventHourStop))");
        if ($conn->fetch_array()) {
            throw new Exception('Exista un eveniment setat pentru aceasta locatie in intervalul specificat');
        }

        $conn->query("INSERT INTO events(UserID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");

        return $conn->get_insert_id();
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['EventData']) {
            throw new Exception(Message::getMessage('EVENTDATA_EMPTY'));
        }
        if ($info['EventHourStart'] || $info['EventHourStop']) {
            if (!$info['EventHourStart'] || !$info['EventHourStop']) {
                throw new Exception(Message::getMessage('HOUR_ERROR'));
            }
            if ($info['EventHourStart'] >= $info['EventHourStop']) {
                throw new Exception(Message::getMessage('HOUR_ERROR'));
            }
        }
        if (!$info['RoomID']) {
            throw new Exception(Message::getMessage('ROOM_EMPTY'));
        }
        if (!$info['ConsultantID']) {
            throw new Exception(Message::getMessage('CONSULTANT_EMPTY'));
        }
        if (!$info['Scope']) {
            throw new Exception(Message::getMessage('SCOPE_EMPTY'));
        }
        $info['EventData'] = Utils::toDBDate($info['EventData']);
        $info['CustomEvent3'] = !empty($info['CustomEvent3']) ? Utils::toDBDate($info['CustomEvent3']) : '';
    }

    public function editEvent($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'del':
                    $conn->query("DELETE FROM event_persons WHERE EventID = {$this->EventID} AND PersonID = {$_GET['PersonID']}");
                    $conn->query("UPDATE events SET InterviewNo = 0, InterviewPrezent = 0, InterviewQual = 0, InterviewDomain = '' WHERE EventID = {$this->EventID}");
                    header('Location: ./?m=events&o=edit&EventID=' . $this->EventID);
                    exit;
                    break;
                case 'del-candidate':
                    $conn->query("DELETE FROM event_candidates WHERE EventID = {$this->EventID} AND PersonID = {$_GET['PersonID']}");
                    $conn->query("UPDATE events SET InterviewNo = 0, InterviewPrezent = 0, InterviewQual = 0, InterviewDomain = '' WHERE EventID = {$this->EventID}");
                    header('Location: ./?m=events&o=edit&EventID=' . $this->EventID);
                    exit;
                    break;
                case 'add':
                    $conn->query("INSERT INTO event_persons(UserID, EventID, PersonID) VALUES({$_SESSION['USER_ID']}, {$this->EventID}, {$_GET['PersonID']})");
                    header('Location: ./?m=events&o=edit&EventID=' . $this->EventID);
                    exit;
                    break;
                case 'add-candidate':
                    $conn->query("INSERT INTO event_candidates(UserID, EventID, PersonID) VALUES({$_SESSION['USER_ID']}, {$this->EventID}, {$_GET['PersonID']})");
                    header('Location: ./?m=events&o=edit&EventID=' . $this->EventID);
                    exit;
                    break;
            }
        }

        $this->setData($info);
        unset($info['persons']);
        unset($info['candidates']);
        unset($info['PersonType']);

        $conn->query("SELECT EventID 
	              FROM   events 
		      WHERE  EventID != {$this->EventID} AND RoomID = '{$info['RoomID']}' AND EventData = '{$info['EventData']}' AND 
			     (('{$info['EventHourStart']}' >= EventHourStart AND '{$info['EventHourStart']}' < EventHourStop) OR 
			      ('{$info['EventHourStop']}' > EventHourStart AND '{$info['EventHourStop']}' <= EventHourStop) OR
			      ('{$info['EventHourStart']}' <= EventHourStart AND '{$info['EventHourStop']}' >= EventHourStop))");
        if ($conn->fetch_array()) {
            throw new Exception('Exista un eveniment setat pentru aceasta locatie in intervalul specificat');
        }

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][4][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
		     ('{$_SESSION['USER_RIGHTS2'][4][4]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][4][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE events a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE EventID = {$this->EventID} AND ($condrw)");
        /*
        $conn->query("DELETE FROM event_persons WHERE UserID = {$_SESSION['USER_ID']} AND EventID = {$this->EventID}");
        foreach ((array)$persons as $k => $v) {
            if ($v > 0) {
                $conn->query("INSERT INTO event_persons(UserID, EventID, PersonID) VALUES({$_SESSION['USER_ID']}, {$this->EventID}, {$v})");
            }
        }
        */
    }

    public function delEvent()
    {

        global $conn;

        $conn->query("DELETE FROM events WHERE EventID = {$this->EventID} AND {$_SESSION['USER_ID']} = 1");
        $conn->query("DELETE FROM event_persons WHERE EventID = {$this->EventID} AND {$_SESSION['USER_ID']} = 1");
    }

    public function getEvent()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1))
		     OR
		     ('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][4][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
		     ('{$_SESSION['USER_RIGHTS2'][4][4]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][4][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT *, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   events a
                  WHERE  EventID = {$this->EventID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_EVENT'));
        }
    }

    public function getEventPersons()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1))
		     OR
		     ('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT PersonID FROM event_persons a WHERE EventID = {$this->EventID} AND ($condbase)";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row['PersonID'];
        }
        return $persons;
    }

    public function getEventCandidates()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1))
			     OR
			     ('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT PersonID FROM event_candidates a WHERE EventID = {$this->EventID} AND ($condbase)";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[] = $row['PersonID'];
        }
        return $persons;
    }

    public function getAllEventPersons()
    {

        global $conn;

        if (!isset($_SESSION['USER_RIGHTS2'][4]))
            $_SESSION['USER_RIGHTS2'][4] = NULL;
        if (!isset($_SESSION['USER_RIGHTS2'][4][1]))
            $_SESSION['USER_RIGHTS2'][4][1] = NULL;
        if (!isset($_SESSION['USER_RIGHTS2'][4][4]))
            $_SESSION['USER_RIGHTS2'][4][4] = NULL;

        if (!isset($_SESSION['USER_RIGHTS3'][4]))
            $_SESSION['USER_RIGHTS3'][4] = NULL;
        if (!isset($_SESSION['USER_RIGHTS3'][4][1][1]))
            $_SESSION['USER_RIGHTS3'][4][1][1] = NULL;

        if (!isset($_SESSION['USER_RIGHTS4'][4]))
            $_SESSION['USER_RIGHTS4'][4] = NULL;


        $condbase = "('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][1]}' > 1))
		     OR
		     ('{$_SESSION['USER_RIGHTS3'][4][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][4][4]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][4][4]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT DISTINCT a.PersonID, b.FullName
	          FROM   event_persons a
		         INNER JOIN persons b ON a.PersonID = b.PersonID
		  WHERE  ($condbase)
		  ORDER  BY b.FullName";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }
        return $persons;
    }
}

?>