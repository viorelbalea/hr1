<?php

class Functions
{

    private $FunctionID;

    public function __construct($FunctionID = 0)
    {
        if ($FunctionID > 0) {
            $this->FunctionID = $FunctionID;
        }
    }

    public static function setCompanyFunction($info)
    {

        global $conn;

        switch ($_GET['action']) {

            case 'new':
                $update = '';
                foreach ($info as $k => $v) {
                    if ($k != 'Aplicable')
                        $update .= "$k = '$v', ";
                }
                $conn->query("INSERT INTO internal_functions_companies SET $update Aplicable='" . $info['Aplicable'] . "', UserID='{$_SESSION['USER_ID']}', PID='{$_SESSION['PERS']}',CreateDate = CURRENT_TIMESTAMP");
                break;

            case 'edit':
                $update = '';
                foreach ($info as $k => $v) {
                    if ($k != 'Aplicable')
                        $update .= "$k = '$v', ";
                }
                $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
                $condrw = "('{$_SESSION['USER_RIGHTS2'][31][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
				     OR 
				     {$_SESSION['USER_ID']} = 1";
                $query = "UPDATE internal_functions_companies a SET $update Aplicable='" . $info['Aplicable'] . "', LastUpdateDate = CURRENT_TIMESTAMP WHERE FunctionCompanyID = '{$info['FunctionCompanyID']}' AND ($condrw)";
                $conn->query($query);
                break;

            case 'del':
                $query = "DELETE FROM internal_functions_companies WHERE FunctionCompanyID = '{$_GET['FunctionCompanyID']}'";
                $conn->query($query);
                break;
        }
    }

    public static function getInternalFunctionsFull($action)
    {

        global $conn;

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'name';
                    $cond .= " AND a.Function LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.Function LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }
        if (!empty($_GET['ParentFunctionID'])) {
            $cond .= " AND b.ParentFunctionID = " . (int)$_GET['ParentFunctionID'];

        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND b.CompanyID = " . (int)$_GET['CompanyID'];

        }
        if (!empty($CompanyID)) {
            $cond .= " AND b.CompanyID = " . (int)$CompanyID;

        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "((('{$_SESSION['USER_RIGHTS2'][31][1]}' = 1 AND (b.UserID = {$_SESSION['USER_ID']} $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][31][1]}' > 1))
		             OR 
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][31][1]}' = 3 AND (b.UserID = {$_SESSION['USER_ID']} OR b.PID = '{$_SESSION['PERS']}' $condmng))
			     OR 
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
						FROM internal_functions a
        				LEFT JOIN internal_functions_companies b ON a.FunctionID=b.FunctionID
        				WHERE a.Status = 1 AND ($condbase) $cond
        				";
        $conn->query($query);
        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $res = array();
        $res[0]['pageNo'] = $pageNo;
        $res[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.Function';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT *, a.FunctionID AS InternalFunctionID, a.Function AS Function
						FROM internal_functions a
        				LEFT JOIN internal_functions_companies b ON a.FunctionID=b.FunctionID
        				WHERE a.Status = 1 AND ($condbase) $cond
        				GROUP BY a.FunctionID
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['InternalFunctionID']] = $row;
        }

        $r2 = $conn->query("SELECT *,
							(SELECT COUNT(*) FROM payroll x 
								INNER JOIN persons y ON x.PersonID=y.PersonID AND y.Status NOT IN (1,5,6,8)
								WHERE x.InternalFunction=a.FunctionID AND x.CompanyID=a.CompanyID) AS PositionsOccupied, 
							(a.Positions-(SELECT COUNT(*) FROM payroll x 
								INNER JOIN persons y ON x.PersonID=y.PersonID AND y.Status NOT IN (1,5,6,8)
								WHERE x.InternalFunction=a.FunctionID AND x.CompanyID=a.CompanyID)) AS PositionsFree
							FROM internal_functions_companies a 
						  	LEFT JOIN companies b ON a.CompanyID=b.CompanyID");
        while ($row2 = $conn->fetch_array($r2)) {

            $res2[$row2['FunctionID']][$row2['FunctionCompanyID']] = $row2;
        }

        foreach ($res as $FunctionID => $function) {
            if ($FunctionID > 0)
                $res[$FunctionID]['Companies'] = $res2[$FunctionID];
        }

        //Utils::pa($res);
        return $res;
    }

    public static function getAlocatedFunctions($CompanyID = 0)
    {
        global $conn;

        $cond = '';

        if (!empty($CompanyID)) {
            $cond .= " AND d.CompanyID = " . (int)$CompanyID;

        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR d.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "((('{$_SESSION['USER_RIGHTS2'][31][1]}' = 1 AND (d.UserID = {$_SESSION['USER_ID']} $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][31][1]}' > 1))
		             OR 
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FunctionID AS InternalFunctionID, d.ParentFunctionID, a.Function, d.CompanyID
						FROM internal_functions a
        				INNER JOIN internal_functions_companies d ON a.FunctionID=d.FunctionID
        				WHERE a.Status = 1  AND ($condbase) $cond
        				GROUP BY a.FunctionID
	          			ORDER  BY a.Function";
        /*
         INNER JOIN payroll b ON a.FunctionID=b.InternalFunction
        INNER JOIN persons c ON b.PersonID=c.PersonID

        AND c.Status NOT IN (1,5,6,8)
         */
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[] = $row;
        }
        return $res;
    }

    public static function getInternalFunctionsPersons($CompanyID = 0)
    {

        global $conn;
        $res = array();

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'name';
                    $cond .= " AND a.Function LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.Function LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($CompanyID)) {
            $cond .= " AND d.CompanyID = " . (int)$CompanyID;

        }
        if (!empty($_GET['ParentFunctionID'])) {
            $cond .= " AND d.ParentFunctionID = " . (int)$_GET['ParentFunctionID'];

        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR d.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        /*
        $condbase = "((('{$_SESSION['USER_RIGHTS2'][31][2]}' = 1 AND (c.UserID = {$_SESSION['USER_ID']} $condmng)) OR
                     '{$_SESSION['USER_RIGHTS2'][31][2]}' > 1))
                     OR
                 {$_SESSION['USER_ID']} = 1";
        */
        $condbase = '1=1';
        $condrw = "('{$_SESSION['USER_RIGHTS2'][31][2]}' = 3 AND (d.UserID = {$_SESSION['USER_ID']} OR d.PID = '{$_SESSION['PERS']}' $condmng))
			     OR 
			     {$_SESSION['USER_ID']} = 1";


        $query = "SELECT IF(c.PersonID IS NOT NULL,c.PersonID, 0) AS PersonID,
						IF(c.FullName  IS NOT NULL,c.FullName, 'Vacant') AS FullName,
						d.FunctionID, d.ParentFunctionID, d.Positions, a.Function, d.CompanyID,
						(d.Positions-(SELECT COUNT(*) FROM payroll x 
										INNER JOIN persons y ON x.PersonID=y.PersonID AND y.Status NOT IN (1,5,6,8)
										WHERE x.InternalFunction=a.FunctionID AND x.CompanyID=d.CompanyID)) AS PositionsFree
						FROM internal_functions a 
						LEFT JOIN internal_functions_companies d ON a.FunctionID=d.FunctionID
						LEFT JOIN payroll b ON (a.FunctionID=b.InternalFunction AND d.CompanyID=b.CompanyID )
						LEFT JOIN persons c ON b.PersonID=c.PersonID AND c.Status NOT IN (1,5,6,8)
        				WHERE a.Status = 1 $cond ";
        /*
         AND c.Status NOT IN (1,5,6,8) ($condbase)
         */

        $query_unique = $query . " GROUP BY d.FunctionID ";
        $query .= " ORDER  BY FullName ASC ";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            if (file_exists('photos/persons/' . md5($row['PersonID']) . '_100_100.jpg'))
                $row['Photo'] = 'photos/persons/' . md5($row['PersonID']) . '_100_100.jpg?rn=' . rand(1, 99999999);
            $res[] = $row;
        }

        // Run the 'No duplicate functions' query
        $conn->query($query_unique);
        while ($row = $conn->fetch_array()) {
            $res2[] = $row;
        }


        // Create Vacant positions based on Unique functions
        $vacant = array();
        foreach ($res2 as $posID => $item) {
            if ($item['PositionsFree'] > 0) {
                for ($i = 1; $i <= $item['PositionsFree']; $i++) {
                    $vacant[] = array('PersonID' => 0,
                        'FullName' => 'Vacant',
                        'FunctionID' => $item['FunctionID'],
                        'ParentFunctionID' => $item['ParentFunctionID'],
                        'Function' => $item['Function'],
                        'isFree' => 1,
                        'count' => $i,
                    );

                }
            }

        }

        // Merge persons with vacant
        $res_final = array_merge($res, $vacant);

        // Remove initialy available but not marked with isFree
        foreach ($res_final as $posID => $item) {
            if ($item['PersonID'] == 0 && empty($item['isFree'])) {
                unset($res_final[$posID]);
            }
        }

        return $res_final;
    }

    public static function getFunctionsPersonsTree($elements, $parentId = 0, $recursionDepth = 0, $maxDepth = false, $startId = 0)
    {
        $branch = array();
        if (($recursionDepth > $maxDepth)) return $branch;
        if (is_array($elements)) {
            foreach ($elements as $element) {
                if (($element['ParentFunctionID'] == $parentId && $startId == $element['FunctionID'] && $startId > 0) || ($element['ParentFunctionID'] == $parentId && $startId == 0)) {
                    $children = self::getFunctionsPersonsTree($elements, $element['FunctionID'], $recursionDepth + 1, $maxDepth);
                    $element['level'] = $recursionDepth;
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;
                }
            }
        }
        return $branch;
    }

    public static function getDirTree($elements, $parentId = 0, $recursionDepth = 0, $maxDepth = false)
    {
        $branch = array();
        if (($recursionDepth > $maxDepth)) return $branch;
        if (is_array($elements)) {
            foreach ($elements as $element) {
                if ($element['ParentFunctionID'] == $parentId) {
                    $children = self::getFunctionsTree($elements, $element['InternalFunctionID'], $recursionDepth + 1, $maxDepth);
                    $element['level'] = $recursionDepth;
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;

                }

            }
        }
        return $branch;
    }

    public static function getFunctionsTree($elements, $parentId = 0, $recursionDepth = 0, $maxDepth = false)
    {
        $branch = array();
        if (($recursionDepth > $maxDepth)) return $branch;
        if (is_array($elements)) {
            foreach ($elements as $element) {
                if ($element['ParentFunctionID'] == $parentId) {
                    $children = self::getFunctionsTree($elements, $element['InternalFunctionID'], $recursionDepth + 1, $maxDepth);
                    $element['level'] = $recursionDepth;
                    if ($children) {
                        $element['children'] = $children;
                    }
                    $branch[] = $element;

                }

            }
        }
        return $branch;
    }

    static function arrayUnique($myArray)
    {
        if (!is_array($myArray))
            return $myArray;

        foreach ($myArray as &$myvalue) {
            $myvalue = serialize($myvalue);
        }

        $myArray = array_unique($myArray);

        foreach ($myArray as &$myvalue) {
            $myvalue = unserialize($myvalue);
        }

        return $myArray;

    }

    public function editFunction($info = array())
    {
        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            if ($k != 'Aplicable')
                $update .= "$k = '$v', ";
        }
        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][31][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
			     OR 
			     {$_SESSION['USER_ID']} = 1";
        $query = "UPDATE internal_functions a SET $update Aplicable='" . $info['Aplicable'] . "', LastUpdateDate = CURRENT_TIMESTAMP WHERE FunctionID = {$this->FunctionID} AND ($condrw)";
        $conn->query($query);
    }

    public function getFunction()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR b.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "((('{$_SESSION['USER_RIGHTS2'][31][1]}' = 1 AND (b.UserID = {$_SESSION['USER_ID']} $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][31][1]}' > 1))
		             OR 
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][31][1]}' = 3 AND (b.UserID = {$_SESSION['USER_ID']} OR b.PID = '{$_SESSION['PERS']}' $condmng))
			     OR 
			     {$_SESSION['USER_ID']} = 1";


        $query = "SELECT *, b.Notes AS FunctionNotes, a.FunctionID AS InternalFunctionID, a.Function AS FunctionName,
					(SELECT COUNT(*) FROM payroll WHERE InternalFunction=a.FunctionID) AS PositionsOccupied, 
				(b.Positions-(SELECT COUNT(*) FROM payroll WHERE InternalFunction=a.FunctionID)) AS PositionsFree
						FROM internal_functions a
        				LEFT JOIN internal_functions_companies b ON a.FunctionID=b.FunctionID
        				LEFT JOIN companies c ON b.CompanyID=c.CompanyID
        				WHERE a.Status = 1 AND a.FunctionID= {$this->FunctionID} AND ($condbase)";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[0]['FunctionID'] = $row['InternalFunctionID'];
            $res[0]['Function'] = $row['FunctionName'];
            $res[0]['FunctionObs'] = $row['FunctionObs'];
            $res[] = $row;
        }
        //Utils::pa($res);
        return $res;
        /*
        if ($row = $conn->fetch_array()) {

        } else {
            throw new Exception(Message::getMessage('NO_SUCH_FUNCTION'));
        }
        */
    }

    private function setData(&$info)
    {
        global $conn;
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
    }

}

?>