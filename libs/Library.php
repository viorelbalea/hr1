<?php

class Library
{

    private $DocID;

    public function __construct($DocID = 0)
    {
        if ($DocID > 0) {
            $this->DocID = $DocID;
        }
    }

    public static function getAllCats()
    {

        global $conn;

        $cats = array();
        $query = "SELECT CatID, Name, PCatID FROM library_categories ORDER BY PCatID, Name";
        $conn->query($query, __FILE__, __LINE__);
        while ($row = $conn->fetch_array()) {
            $cats[$row['PCatID']][$row['CatID']] = stripslashes($row['Name']);
        }
        return $cats;
    }

    public static function getAllDocuments($action = '')
    {

        global $conn, $categories;

        $cond = $_SESSION['USER_ID'] == 1 ? "" : (!empty($categories) ? " AND (a.CatID IN (" . implode(',', array_keys($categories)) . ") OR a.CatID IN (SELECT CatID FROM library_categories WHERE PCatID IN (" . implode(',', array_keys($categories)) . ")))" : "1=0");
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'tags';
                    $cond .= " AND a.Tags LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'code';
                    $cond .= " AND a.DocCode LIKE '{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND (a.DocName LIKE '%{$_GET['keyword']}%' OR a.DocDescr LIKE '%{$_GET['keyword']}%')";
                    break;
            }
        }

        if (!empty($_GET['CatID'])) {
            $cond .= " AND (a.CatID = " . (int)$_GET['CatID'] . " OR a.CatID IN (SELECT CatID FROM library_categories WHERE PCatID = " . (int)$_GET['CatID'] . "))";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;
        if (!isset($_SESSION['USER_RIGHTS2'][10][1]))
            $_SESSION['USER_RIGHTS2'][10][1] = NULL;
        if (!isset($_SESSION['PERS']))
            $_SESSION['PERS'] = NULL;
        $condbase = "('{$_SESSION['USER_RIGHTS2'][10][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][10][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total FROM library_documents a WHERE ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $docs = array();
        $docs[0]['pageNo'] = $pageNo;
        $docs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.DocName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, DATE_FORMAT(a.CreateDate, '%d.%m.%Y') AS data, b.Name AS CatName, c.Name AS PCatName, b.PCatID,
	                 CASE WHEN ('{$_SESSION['USER_RIGHTS2'][10][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR {$_SESSION['USER_ID']} = 1 THEN 1 ELSE 0 END AS rw
                  FROM   library_documents a
                         INNER JOIN library_categories b ON a.CatID = b.CatID
                         LEFT JOIN library_categories c ON b.PCatID = c.CatID
                  WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['DocName'] = stripslashes($row['DocName']);
            $row['DocDescr'] = stripslashes($row['DocDescr']);
            $row['curr_filename'] = 'docs/' . md5($row['UserID'] > 0 ? $row['UserID'] . '_0' : '0_' . $row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);
            if ($row['rw'] == 0) {
                if (!empty($row['PCatID'])) {
                    if ($_SESSION['USER_RIGHTS3'][10][1][$row['PCatID']] == 2) {
                        $row['rw'] = 1;
                    }
                } else {
                    if ($_SESSION['USER_RIGHTS3'][10][1][$row['CatID']] == 2) {
                        $row['rw'] = 1;
                    }
                }
            }
            $docs[$row['DocID']] = $row;
        }

        return $docs;
    }

    public static function getCategoriesByUser($write = false)
    {

        if ($_SESSION['USER_ID'] == 1) {
            return;
        }

        global $conn;

        $query = "SELECT UserRightsLevel3 FROM users WHERE UserID = {$_SESSION['USER_ID']}";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $arr = !empty($row['UserRightsLevel3']) ? unserialize($row['UserRightsLevel3']) : array();
            $arr2 = (array)$arr[10][1];
            foreach ($arr2 as $k => $v) {
                if ((!$write && $v > 0) || ($write && $v == 2)) {
                    $arr3[$k] = $v;
                }
            }
            return (array)$arr3;
        }
    }

    public static function markRead($PersonID, $MandatoryID)
    {
        global $conn;
        $query = "INSERT INTO library_mandatory_reads (PersonID, MandatoryID, CreateDate) 
					SELECT '$PersonID','$MandatoryID', CURRENT_TIMESTAMP 
					";
        $conn->query($query);
    }

    public static function getUnreadDocs($PersonID)
    {
        global $conn;
        $query = "SELECT b.*,c.*,d.* FROM library_mandatory_functions b 
						INNER JOIN payroll c ON b.FunctionID=c.InternalFunction 
						INNER JOIN library_documents d ON b.DocID=d.DocID 
						WHERE d.MandatoryReading=1 AND c.PersonID = '$PersonID' AND b.IsSters = 0 AND 
						     NOT EXISTS (SELECT * FROM library_mandatory_reads x WHERE x.MandatoryID=b.MandatoryID AND x.PersonID=c.PersonID)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['curr_filename'] = 'docs/' . md5($row['UserID'] > 0 ? $row['UserID'] . '_0' : '0_' . $row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);
            $res[] = $row;
        }
        if (count($res) > 0)
            return $res;
        else
            return false;

    }

    public function addDoc($info = array(), $fileinfo = array(), $doc_dir = '')
    {

        $this->setData($info);
        $this->setFile($fileinfo, $doc_dir);

        $mandatoryReading = (int)$info['MandatoryReading'];
        $internalFunctions = $info['InternalFunctions'];
        unset($info['MandatoryReading']);
        unset($info['InternalFunctions']);

        global $conn;

        $conn->query("INSERT INTO library_documents(UserID, PersonID, CreateDate, LastUpdateDate, MandatoryReading, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '$mandatoryReading', '" . implode("', '", $info) . "')");
        $this->DocID = $conn->get_insert_id();

        if (!empty($internalFunctions))
            foreach ($internalFunctions as $k => $v) {
                $conn->query("INSERT INTO library_mandatory_functions SET FunctionID='$v', DocID = '{$this->DocID}', CreateDate = CURRENT_TIMESTAMP ");
            }
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_array($v))
                $v = Utils::formatStr($v);
        }
        if (!$info['CatID']) {
            throw new Exception(Message::getMessage('DOC_CAT_EMPTY'));
        }
        if (!$info['DocCode']) {
            throw new Exception(Message::getMessage('DOC_CODE_EMPTY'));
        }
        if (!$info['DocName']) {
            throw new Exception(Message::getMessage('DOC_NAME_EMPTY'));
        }
    }

    private function setFile($data, $doc_dir)
    {
        if (!empty($data['FileName']['name'])) {
            if ($data['FileName']['size'] < 64 * 1024 * 1024) {
                $filename = str_replace(' ', '-', $data['FileName']['name']);
                $filename = $doc_dir . preg_replace('/[^-a-z0-9_. ]/i', '', $filename);
                if (file_exists($filename)) {
                    throw new Exception(Message::getMessage('DOC_DUPLICATE'));
                }
                if (!is_dir($doc_dir)) {
                    mkdir($doc_dir, 0755);
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
            $filename = str_replace(' ', '-', $fileinfo['FileName']['name']);
            $filename = $doc_dir . preg_replace('/[^-a-z0-9_. ]/i', '', $filename);
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
        $mandatoryReading = (int)$info['MandatoryReading'];
        $internalFunctions = $info['InternalFunctions'];
        unset($info['MandatoryReading']);
        unset($info['InternalFunctions']);

        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $conn->query("UPDATE library_documents SET $update MandatoryReading='$mandatoryReading', LastUpdateDate = CURRENT_TIMESTAMP WHERE DocID = {$this->DocID}");

        if (!empty($internalFunctions)) {
            $conn->query("UPDATE library_mandatory_functions SET IsSters = 1 WHERE DocID = {$this->DocID}");
            foreach ($internalFunctions as $k => $v) {
                $conn->query("SELECT MandatoryID FROM library_mandatory_functions WHERE FunctionId = '$v' AND DocID = '{$this->DocID}' AND IsSters = 1");
                $row = $conn->fetch_array();

                if ($row['MandatoryID'] > 0) {
                    $conn->query("UPDATE library_mandatory_functions SET IsSters = 0 WHERE MandatoryId = " . $row['MandatoryID']);
                } else {
                    $conn->query("INSERT INTO library_mandatory_functions SET FunctionID='$v', DocID = '{$this->DocID}', CreateDate = CURRENT_TIMESTAMP ");
                }
            }
        }
    }

    public function getDoc()
    {

        global $conn, $categories;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][10][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][10][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.PCatID,
			 CASE WHEN ('{$_SESSION['USER_RIGHTS2'][10][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}')) OR {$_SESSION['USER_ID']} = 1 THEN 1 ELSE 0 END AS rw
                  FROM   library_documents a
		         INNER JOIN library_categories b ON a.CatID = b.CatID
                  WHERE  a.DocID = {$this->DocID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['DocName'] = stripslashes($row['DocName']);
            $row['DocDescr'] = stripslashes($row['DocDescr']);
            $row['curr_filename'] = 'docs/' . md5($row['UserID'] > 0 ? $row['UserID'] . '_0' : '0_' . $row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);
            $conn->query("SELECT b.FunctionID, b.Function FROM library_mandatory_functions a 
    	    				LEFT JOIN internal_functions b ON a.FunctionID=b.FunctionID
    	    				WHERE  a.DocID = {$this->DocID} AND a.IsSters = 0");
            while ($row2 = $conn->fetch_array()) {
                $row['InternalFunctions'][$row2['FunctionID']] = $row2['FunctionID'];
            }
            if ($row['rw'] == 0) {
                if (!empty($row['PCatID'])) {
                    if ($_SESSION['USER_RIGHTS3'][10][1][$row['PCatID']] == 2) {
                        $row['rw'] = 1;
                    }
                } else {
                    if ($_SESSION['USER_RIGHTS3'][10][1][$row['CatID']] == 2) {
                        $row['rw'] = 1;
                    }
                }
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_DOC'));
        }
    }

    public function delDoc()
    {

        global $conn;

        $query = "DELETE FROM library_documents 
                  WHERE  DocID = {$this->DocID} AND {$_SESSION['USER_ID']} = 1 
                  AND NOT EXISTS(SELECT MandatoryID FROM library_mandatory_functions WHERE DocID = {$this->DocID}) AND IsSters = 0";
        $conn->query($query);
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Documentul nu poate fi sters deoarece a fost asignat pentru citire obligatorie!'); window.location.href = './?m=library';\"></body>";
            exit;
        }
    }

}

?>