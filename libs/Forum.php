<?php

class Forum
{

    public static $msStatus = array(
        1 => 'Nou',
        2 => 'Inchis',
    );
    private $ThreadID;

    public function __construct($ThreadID = 0)
    {
        if ($ThreadID > 0) {
            $this->ThreadID = $ThreadID;
        }
    }

    public static function getPersons()
    {

        global $conn;

        $query = "SELECT *
	                FROM   forum_threads a
	                INNER JOIN persons b ON a.PersonID=b.PersonID
                ";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['PersonID']] = $row['FullName'];
        }

        return $res;

    }

    public static function getAllThreads($action = '')
    {

        global $conn;

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'name';
                    $cond .= " AND a.ThreadName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND (a.Status = " . (int)$_GET['Status'] . ")";
        }

        if (!empty($_GET['PersonID'])) {
            $cond .= " AND (a.PersonID = " . (int)$_GET['PersonID'] . ")";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
               FROM   forum_threads a
               LEFT JOIN persons b ON a.PersonID=b.PersonID
                    WHERE  ((a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][24][1]}' > 1) OR ((a.UserID != {$_SESSION['USER_ID']} OR a.PersonID != '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][24][1]}' <= 1) AND Public=1) OR {$_SESSION['USER_ID']} = 1) $cond
                   ";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $res = array();
        $res[0]['pageNo'] = $pageNo;
        $res[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate ';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*,b.FullName, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data,
	                 CASE WHEN (a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][24][1]}' = 3) OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS3'][24][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1 THEN 1 ELSE 0 END AS rw
                  FROM   forum_threads a
                  LEFT JOIN persons b ON a.PersonID=b.PersonID
                  WHERE  ((a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][24][1]}' > 1) OR ((a.UserID != {$_SESSION['USER_ID']} OR a.PersonID != '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS2'][24][1]}' <= 1) AND Public=1) OR {$_SESSION['USER_ID']} = 1) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['ThreadID']] = $row;
        }

        return $res;
    }

    public static function addPost($info = array())
    {

        if (!$info['PostText']) {
            throw new Exception(Message::getMessage('POSTTEXT_EMPTY'));
        }
        if (!$_GET['ThreadID']) {
            throw new Exception(Message::getMessage('NO_SUCH_THREAD'));
        }

        global $conn;

        $conn->query("INSERT INTO forum_posts(UserID, PersonID, ThreadID, PostText,CreateDate)
                      VALUES({$_SESSION['USER_ID']}, " . (int)$_SESSION['PERS'] . ",'" . $_GET['ThreadID'] . "','" . $conn->real_escape_string(nl2br($info['PostText'])) . "', CURRENT_TIMESTAMP)");
        return $conn->get_insert_id();

    }

    public static function getPosts($ThreadID)
    {

        global $conn;

        $query = "SELECT a.*,b.FullName, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS Date, DATE_FORMAT(a.CreateDate, '%H:%i:%s') AS Time
	                FROM   forum_posts a
	                LEFT JOIN persons b ON a.PersonID=b.PersonID
	                LEFT JOIN forum_threads c ON a.ThreadID=c.ThreadID
                  WHERE  a.ThreadID=$ThreadID
	          ORDER  BY CreateDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['PostID']] = $row;
        }

        return $res;
    }

    public function addThread($info = array())
    {
        if (!$info['ThreadName']) {
            throw new Exception(Message::getMessage('THREADNAME_EMPTY'));
        }

        global $conn;

        $conn->query("INSERT INTO forum_threads(UserID, PersonID, ThreadName, Status, Public,CreateDate, LastUpdateDate)
                      VALUES({$_SESSION['USER_ID']}, " . (int)$_SESSION['PERS'] . ",'{$info['ThreadName']}'," . (int)$info['Status'] . "," . (int)$info['Public'] . ", CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        return $conn->get_insert_id();

    }

    public function editThread($info = array())
    {

        if (!$info['ThreadName']) {
            throw new Exception(Message::getMessage('THREADNAME_EMPTY'));
        }

        global $conn;

        $conn->query("UPDATE forum_threads SET ThreadName = '{$info['ThreadName']}', Status = {$info['Status']}, Public = " . (int)$info['Public'] . " , LastUpdateDate = CURRENT_TIMESTAMP WHERE ThreadID = {$this->ThreadID}
        			AND
        			((UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][24][1]}' = 3) OR PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS3'][24][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1)");

    }

    public function getThread()
    {

        global $conn;

        $query = "SELECT a.*,
                         CASE WHEN (a.UserID = {$_SESSION['USER_ID']} AND '{$_SESSION['USER_RIGHTS2'][24][1]}' = 3) OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS3'][24][1][1]}' = 2 OR {$_SESSION['USER_ID']} = 1 THEN 1 ELSE 0 END AS rw
                  FROM   forum_threads a
                  WHERE  a.ThreadID = {$this->ThreadID} AND
                         (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' OR '{$_SESSION['USER_RIGHTS3'][24][1][1]}' > 0 OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_THREAD'));
        }
    }

    public function delThread()
    {

        global $conn;

        $query = "DELETE FROM forum_threads
                  WHERE  ThreadID = {$this->ThreadID} AND {$_SESSION['USER_ID']} = 1";
        $conn->query($query);
    }

    public function delPost($PostID)
    {

        global $conn;

        $query = "DELETE FROM forum_posts
                  WHERE  PostID = $PostID AND (PersonID=" . (int)$_SESSION['PERS'] . " OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
    }

}

?>