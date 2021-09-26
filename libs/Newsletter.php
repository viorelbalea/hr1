<?php

class Newsletter extends ConfigData
{

    private $NewsletterID;


    public function __construct($NewsletterID = 0)
    {
        if ($NewsletterID > 0) {
            $this->NewsletterID = $NewsletterID;
        }
    }

    public static function getAllNewsletters($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['Type']))
            $cond .= " AND a.Type = '{$_GET['Type']}' ";
        if (!empty($_GET['Status']))
            $cond .= " AND a.Status = '{$_GET['Status']}' ";


        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'content';
                    $cond .= " AND a.Content LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'campaign';
                    $cond .= " AND a.Campaign LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.Title LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total
                   FROM   newsletters a
                   WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $res = array();
        $res[0]['pageNo'] = $pageNo;
        $res[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data
                  FROM   newsletters a
                  WHERE  (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $res[$row['NewsletterID']] = $row;
        }

        return $res;
    }

    public function addNewsletter($type = 1, $info = array())
    {

        $this->setData($info);
        $recipients = array();
        $recipients = $info['Recipients'];
        $recipients = serialize(array_unique($recipients));
        $info['Recipients'] = $recipients;
        $info['Type'] = $type;

        global $conn;

        $conn->query("INSERT INTO newsletters(UserID, CreateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        $insertId = $conn->get_insert_id();

        if ($info['Status'] == 1)
            $conn->query("UPDATE newsletters SET Status=2 WHERE NewsletterID!='$insertId'");

        return $insertId;
    }

    private function setData(&$info)
    {

        unset($info['CompanyID']);
        foreach ($info as $k => &$v) {
            if ($k != 'Recipients')
                $v = Utils::formatStr($v);
            if ($k == 'Campaign')
                $v = preg_replace('/[^a-z\d ]/i', '', $v);
        }
        //Utils::pa($info);
        if (!$info['Title']) {
            throw new Exception(Message::getMessage('NEWSLETTER_TITLE_EMPTY'));
        }
        if (!$info['Campaign']) {
            throw new Exception(Message::getMessage('NEWSLETTER_CAMPAIGN_EMPTY'));
        }
        if (!$info['FromAlias']) {
            throw new Exception(Message::getMessage('NEWSLETTER_FROM_EMPTY'));
        }
        if (!$info['FromEmail']) {
            throw new Exception(Message::getMessage('NEWSLETTER_EMAIL_EMPTY'));
        }
        if (!$info['Content']) {
            throw new Exception(Message::getMessage('NEWSLETTER_CONTENT_EMPTY'));
        }
        $info['SendStartDate'] = !empty($info['SendStartDate']) ? Utils::toDBDateTime($info['SendStartDate']) : '0000-00-00 00:00:00';
    }

    public function editNewsletter($info = array())
    {

        $this->setData($info);
        $recipients = $info['Recipients'];
        $recipients = serialize(array_unique($recipients));
        unset($info['Recipients']);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }
        $update .= "Recipients='" . $recipients . "', ";

        $conn->query("UPDATE newsletters SET $update LastUpdateDate = CURRENT_TIMESTAMP
                      WHERE  NewsletterID = {$this->NewsletterID} AND
                             (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)");
        if ($info['Status'] == 1)
            $conn->query("UPDATE newsletters SET Status=2 WHERE NewsletterID!='{$this->NewsletterID}'");
    }

    public function getNewsletter()
    {

        global $conn;

        $query = "SELECT a.*
                  FROM   newsletters a
                  WHERE  a.NewsletterID = {$this->NewsletterID} AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $row['LstRecipients'] = unserialize($row['Recipients']);
            $row['Recipients'] = @implode('; ', unserialize($row['Recipients']));
            //Utils::pa($row);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_NEWS'));
        }
    }

    public function showNews()
    {

        global $conn;

        $query = "SELECT a.*
                  FROM   newsletters  a
                  WHERE  a.NewsletterID = {$this->NewsletterID}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $row['Content'] = stripslashes($row['Content']);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_NEWS'));
        }
    }

    public function delNewsletter()
    {

        global $conn;

        $query = "DELETE FROM newsletters
                  WHERE  NewsletterID = {$this->NewsletterID} AND (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
        $conn->query($query);
    }

    public function previewNewsletter()
    {

        global $conn;

        $query = "SELECT a.*
                  FROM   newsletters a
                  WHERE  a.NewsletterID = {$this->NewsletterID}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Title'] = stripslashes($row['Title']);
            $row['newsletter_url'] = Config::SRV_URL . 'online-newsletters/' . $row['Campaign'];
            //Utils::pa($row);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_NEWS'));
        }
    }

}

?>