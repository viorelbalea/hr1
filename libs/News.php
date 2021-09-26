<?php

class News extends ConfigData
{

    private $NewsID;

    public function __construct($NewsID = 0)
    {
        if ($NewsID > 0) {
            $this->NewsID = $NewsID;
        }
    }

    public static function getAllNews($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['Type']))
            $cond .= " AND a.Type = '{$_GET['Type']}' ";


        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'content';
                    $cond .= " AND a.Content LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.Title LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   news a
                   WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $news = array();
        $news[0]['pageNo'] = $pageNo;
        $news[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data
                  FROM   news a
                  WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $news[$row['NewsID']] = $row;
        }

        return $news;
    }

    public static function displayNews($Type, $res_per_page = 5)
    {

        global $conn, $keyword;

        if (!empty($keyword)) {
            $cond = " AND (Title LIKE '%{$keyword}%' OR Content LIKE '%{$keyword}%') ";
        } else {
            $cond = "";
        }

        $query = "SELECT NewsID, Title, Content,Image, DATE_FORMAT(CreateDate, '%d.%m.%Y') AS data
                  FROM   news
                  WHERE 1=1
		  		  AND Type=$Type $cond
	          ORDER  BY CreateDate DESC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $row['Content'] = strip_tags($row['Content']);
            $news[$row['NewsID']] = $row;
        }

        return $news;
    }

    public function addNews($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO news(UserID, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        return $conn->get_insert_id();
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            $v = Utils::formatStr($v);
        }
        if (!$info['Title']) {
            throw new Exception(Message::getMessage('NEWS_TITLE_EMPTY'));
        }
        if (!$info['Content']) {
            throw new Exception(Message::getMessage('NEWS_CONTENT_EMPTY'));
        }
        $info['CreateDate'] = !empty($info['CreateDate']) ? Utils::toDBDate($info['CreateDate']) : '';
    }

    public function editNews($info = array())
    {

        $this->setData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $conn->query("UPDATE news SET $update LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  NewsID = {$this->NewsID} AND
                             (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)");
    }

    public function getNews()
    {

        global $conn;

        $query = "SELECT a.*
                  FROM   news a
                  WHERE  a.NewsID = {$this->NewsID} AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_NEWS'));
        }
    }

    public function showNews()
    {

        global $conn;

        $query = "SELECT a.*
                  FROM   news a
                  WHERE  a.NewsID = {$this->NewsID}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $row['Content'] = stripslashes($row['Content']);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_NEWS'));
        }
    }

    public function delNews()
    {

        global $conn;

        $query = "DELETE FROM news
                  WHERE  NewsID = {$this->NewsID} AND (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
    }

}

?>