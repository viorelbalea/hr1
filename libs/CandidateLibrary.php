<?php

class CandidateLibrary
{

    private $DocID;

    public function __construct($DocID = 0)
    {
        if ($DocID > 0) {
            $this->DocID = $DocID;
        }
    }

    public static function getAllDocuments($action = '')
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'tags':
                    $cond .= " AND a.Tags LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'code':
                    $cond .= " AND a.DocCode LIKE '{$_GET['keyword']}%'";
                    break;
                case 'descr':
                    $cond .= " AND a.DocDescr LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.DocName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][6]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
	             OR 
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total FROM candidates_internal_doc a WHERE PersonID = $PersonID AND ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $docs = array();
        $docs[0]['pageNo'] = $pageNo;
        $docs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw 
                  FROM   candidates_internal_doc a
                  WHERE  PersonID = $PersonID AND ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['DocName'] = stripslashes($row['DocName']);
            $row['DocDescr'] = stripslashes($row['DocDescr']);
            $row['curr_filename'] = 'docscandidates/' . md5($row['UserID']) . '/' . md5($row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);
            $docs[$row['DocID']] = $row;
        }

        return $docs;
    }

    public function addDoc($info = array(), $fileinfo = array(), $doc_dir = '')
    {

        $this->setData($info);
        $this->setFile($fileinfo, $doc_dir);

        global $conn;

        $conn->query("INSERT INTO candidates_internal_doc(UserID, PID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES('{$_SESSION['USER_ID']}','{$_SESSION['PERS']}', '{$_GET['PersonID']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        }
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            $v = Utils::formatStr($v);
        }
        if (!$info['DocCode']) {
            throw new Exception(Message::getMessage('DOC_CODE_EMPTY'));
        }
        if (!$info['DocName']) {
            throw new Exception(Message::getMessage('DOC_NAME_EMPTY'));
        }
        if (!$info['DocDescr']) {
            throw new Exception(Message::getMessage('DOC_DESCR_EMPTY'));
        }
        if (!$info['Tags']) {
            throw new Exception(Message::getMessage('DOC_TAGS_EMPTY'));
        }
    }

    private function setFile($data, $doc_dir)
    {
        if (!empty($data['FileName']['name'])) {
            if ($data['FileName']['size'] < 2 * 1024 * 1024) {
                $filename = $doc_dir . str_replace(' ', '-', $data['FileName']['name']);
                if (file_exists($filename)) {
                    throw new Exception(Message::getMessage('DOC_DUPLICATE'));
                }
                if (!is_dir($doc_dir)) {
                    mkdir($doc_dir, 0755, true);
                }
                if (!@move_uploaded_file($data['FileName']['tmp_name'], $filename)) {
                    throw new Exception(Message::getMessage('DOC_UPLOAD_ERROR'));
                }
            } else {
                throw new Exception(Message::getMessage('DOC_SIZE_ERROR'));
            }
        } else {
            throw new Exception(Message::getMessage('DOC_EMPTY'));
        }
    }

    public function editDoc($info = array(), $fileinfo = array(), $doc_dir = '')
    {

        $this->setData($info);
        if (!empty($fileinfo['FileName']['name'])) {
            $filename = $doc_dir . str_replace(' ', '-', $fileinfo['FileName']['name']);
            if ($info['curr_filename'] == $filename) {
                @unlink($info['curr_filename']);
            }
            $info['FileName'] = $fileinfo['FileName']['name'];
            $this->setFile($fileinfo, $doc_dir);
            if ($info['curr_filename'] != $filename) {
                @unlink($info['curr_filename']);
            }
        }
        unset($info['curr_filename']);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal_doc a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE DocID = {$this->DocID} AND ($condrw)");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        }
    }

    public function getDoc()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][6]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
	             OR 
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM candidates_internal_doc a WHERE a.DocID = {$this->DocID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['DocName'] = stripslashes($row['DocName']);
            $row['DocDescr'] = stripslashes($row['DocDescr']);
            $row['curr_filename'] = 'docscandidates/' . md5($row['UserID']) . '/' . md5($row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_DOC'));
        }
    }

    public function delDoc()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (UserID = {$_SESSION['USER_ID']} OR PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][6]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $query = "DELETE FROM candidates_internal_doc WHERE DocID = {$this->DocID} AND ($condrw)";
        $conn->query($query);
    }
}

?>