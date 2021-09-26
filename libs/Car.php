<?php

class Car extends ConfigData
{

    public static $CarImportData;
    private $CarID;

    public function __construct($CarID = 0)
    {
        $this->CarID = $CarID;
    }

    public static function getAllCars($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'RegNo';
                    $cond .= " AND a.RegNo LIKE '{$_GET['RegNo']}%'";
                    break;
            }
        }

        if (!empty($_GET['CarType'])) {
            $cond .= " AND a.CarType = " . (int)$_GET['CarType'];
        }

        if (!empty($_GET['Brand'])) {
            $cond .= " AND a.Brand = " . (int)$_GET['Brand'];
        }

        if (!empty($_GET['Fuel'])) {
            $cond .= " AND a.Fuel = " . (int)$_GET['Fuel'];
        }

        if (!empty($_GET['Gear'])) {
            $cond .= " AND a.Gear = " . (int)$_GET['Gear'];
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }

        if (!empty($_GET['Patrimony'])) {
            $cond .= " AND a.Patrimony = " . (int)$_GET['Patrimony'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][27][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][27][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   cars a
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $cars = array();
        $cars[0]['pageNo'] = $pageNo;
        $cars[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.CarType';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, CASE WHEN a.RegDate > '0000-00-00' THEN DATE_FORMAT(a.RegDate, '%d.%m.%Y') ELSE '' END AS RegDate
	          FROM   cars a
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $cars[$row['CarID']] = $row;
        }
        if (count($cars) > 1) {
            $query = "SELECT a.CarID, b.FullName
	              FROM   cars_resp a
		             INNER JOIN persons b ON a.PersonID = b.PersonID
		      WHERE  a.CarID IN (" . implode(',', array_keys($cars)) . ") AND 
		             ((a.StopDate > '0000-00-00' AND CURRENT_DATE BETWEEN a.StartDate AND a.StopDate) OR 
	    		      (a.StopDate = '0000-00-00' AND a.StartDate <= CURRENT_DATE))";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $cars[$row['CarID']]['Resp'][] = $row['FullName'];
            }
        }


        return $cars;
    }

    public static function getContractsByComodat()
    {

        global $conn;

        $contracts = array();
        $query = "SELECT a.ContractID, a.ContractName
	              FROM   contract a
		             INNER JOIN contract_types b ON a.ContractTypeID = b.ContractTypeID AND b.ContractType = 'Comodat'
		      ORDER  BY a.ContractName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $contracts[] = $row;
        }
        return $contracts;
    }

    public static function getSheets($action = '')
    {

        global $conn;

        $cond = "1=1";

        if (!empty($_GET['CarID'])) {
            $cond .= " AND a.CarID = " . (int)$_GET['CarID'];
        }

        if (!empty($_GET['Fuel'])) {
            $cond .= " AND b.Fuel = " . (int)$_GET['Fuel'];
        }

        if (!empty($_GET['DriverID'])) {
            $cond .= " AND a.DriverID = " . (int)$_GET['DriverID'];
        }

        if (!empty($_GET['Scope'])) {
            $cond .= " AND a.Scope = " . (int)$_GET['Scope'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total 
	           FROM   cars_sheets a 
		          INNER JOIN cars b ON a.CarID = b.CarID 
			  LEFT JOIN persons c ON a.DriverID = c.PersonID
		   WHERE $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $sheets = array();
        $sheets[0]['pageNo'] = $pageNo;
        $sheets[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.StartDate desc, a.StartHour';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, b.Brand, b.Model, b.RegNo, b.Fuel, c.FullName,
	                 a.StopDateKm - a.StartDateKm AS KmNo,
			 (SELECT COUNT(1) FROM cars_sheets_users WHERE SheetID = a.ID) AS PersonNo
	          FROM   cars_sheets a
		         INNER JOIN cars b ON a.CarID = b.CarID
			 LEFT JOIN persons c ON a.DriverID = c.PersonID
	          WHERE  $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $sheets[$row['ID']] = $row;
        }

        return $sheets;
    }

    public static function getSheet($SheetID)
    {

        global $conn;

        $conn->query("SELECT a.*, b.Patrimony
	              FROM   cars_sheets a
		             INNER JOIN cars b ON a.CarID = b.CarID
		      WHERE  a.ID = $SheetID");
        if ($row = $conn->fetch_array()) {
            $info = $row;
            $conn->query("SELECT ID, PersonID FROM cars_sheets_users WHERE SheetID = $SheetID ORDER BY ID");
            while ($row = $conn->fetch_array()) {
                $info['Users'][$row['ID']] = $row['PersonID'];
            }
            return $info;
        } else {
            throw new Exception(Message::$msMessagesRO['NO_SUCH_CAR_SHEET']);
        }
    }

    public static function setSheet()
    {

        global $conn;

        $SheetID = (int)$_GET['SheetID'];

        if (isset($_GET['ID'])) {

            $ID = (int)$_GET['ID'];

            if ($ID > 0 && !empty($_GET['del'])) {

                $conn->query("DELETE FROM cars_sheets_users WHERE ID = $ID AND SheetID = $SheetID");

            } else {

                $PersonID = (int)$_GET['PersonID'];
                if ($ID > 0) {
                    $conn->query("UPDATE cars_sheets_users SET PersonID = '$PersonID' WHERE ID = $ID AND SheetID = $SheetID");
                } else {
                    $conn->query("INSERT INTO cars_sheets_users(UserID, PID, SheetID, PersonID, CreateDate) 
		                  VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', '$SheetID', '$PersonID', CURRENT_TIMESTAMP)");
                }
            }

        } else {

            if ($SheetID > 0 && !empty($_GET['del'])) {
                $conn->query("DELETE FROM cars_sheets_users WHERE SheetID = $SheetID");
                $conn->query("DELETE FROM cars_sheets WHERE ID = $SheetID");
                header('Location: ./?m=cars_sheet&o=sheet');
                exit;
            }

            $CarID = (int)$_GET['CarID'];
            $SheetNo = $_GET['SheetNo'];
            $DriverID = (int)$_GET['DriverID'];
            $CostCenterID = (int)$_GET['CostCenterID'];
            $Scope = (int)$_GET['Scope'];
            $StartDate = Utils::toDBDate($_GET['StartDate']);
            $StartHour = $_GET['StartHour'];
            $StartDateKm = (int)$_GET['StartDateKm'];
            $StopDate = Utils::toDBDate($_GET['StopDate']);
            $StopHour = $_GET['StopHour'];
            $StopDateKm = (int)$_GET['StopDateKm'];
            $Destination = $_GET['Destination'];
            $Notes = $_GET['Notes'];

            if (empty($CarID)) {
                return 'Nu ati ales Marca masinii';
            }

            $conn->query("SELECT Patrimony FROM cars WHERE CarID = $CarID");
            if ($row = $conn->fetch_array()) {
                if ($row['Patrimony'] == 2) {
                    return 'Masina nu mai e in patrimoniu';
                }
            } else {
                return 'Nu ati ales Marca masinii';
            }

            if (empty($_GET['StartDate'])) {
                return 'Nu ati ales Data plecare';
            }

            if (empty($_GET['StopDate'])) {
                return 'Nu ati ales Data sosire';
            }

            if (empty($StartDateKm)) {
                return 'Nu ati ales Km plecare';
            }

            if (empty($StopDateKm)) {
                return 'Nu ati ales Km sosire';
            }

            if ($StartDate > $StopDate || $StartDate . ' ' . $StartHour > $StopDate . ' ' . $StopHour) {
                return 'Intervalul de timp trebuie sa fie valid';
            }
            if ($StartDateKm > $StopDateKm) {
                return 'Km plecare trebuie a fie mai mici decat Km sosire';
            }
            $conn->query("SELECT StopDateKm FROM cars_sheets WHERE CarID = $CarID " . ($SheetID > 0 ? " AND ID != $SheetID" : "") . " ORDER BY StartDate DESC LIMIT 1");
            if ($row = $conn->fetch_array()) {
                if ($StartDateKm < $row['StopDateKm']) {
                    return 'Km trebuie sa fie crescatori pe intervale succesive';
                }
            }
            $conn->query("SELECT ID 
		          FROM   cars_sheets 
			  WHERE  CarID = $CarID " . ($SheetID > 0 ? " AND ID != $SheetID" : "") . " AND 
			             (
		            		StartDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
			    		StopDate BETWEEN '{$StartDate}' AND '{$StopDate}' OR
					'{$StartDate}' BETWEEN StartDate AND StopDate
			    	     )");
            if ($row = $conn->fetch_array()) {
                return 'Foaia de parcurs introdusa se suprapune peste una existenta';
            }

            if ($SheetID > 0) {
                $conn->query("UPDATE cars_sheets SET 
							CarID	    	= '$CarID',
							SheetNo	    	= '$SheetNo',
							DriverID    	= '$DriverID',
							CostCenterID	= '$CostCenterID',
							Scope		= '$Scope',
							StartDate   	= '$StartDate', 
							StartHour   	= '$StartHour', 
							StartDateKm 	= '$StartDateKm', 
							StopDate    	= '$StopDate',
							StopHour    	= '$StopHour',
							StopDateKm  	= '$StopDateKm',
							Destination	= '$Destination',
							Notes		= '$Notes'
			          WHERE ID = $SheetID");
            } else {
                $conn->query("INSERT INTO cars_sheets(UserID, PID, CarID, SheetNo, DriverID, CostCenterID, Scope, 
		                                      StartDate, StartHour, StartDateKm, StopDate, StopHour, StopDateKm, 
						      Destination, Notes, CreateDate) 
		                  VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', '$CarID', '$SheetNo', '$DriverID', 
				         '$CostCenterID', '$Scope', '$StartDate', '$StartHour', '$StartDateKm', 
					 '$StopDate', '$StopHour', '$StopDateKm', '$Destination', '$Notes', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getCars()
    {

        global $conn;

        $cars = array();
        $conn->query("SELECT CarID, Brand, Model, RegNo FROM cars WHERE Status = 1 AND Patrimony = 1 ORDER BY Brand, Model");
        while ($row = $conn->fetch_array()) {
            $cars[$row['CarID']] = ConfigData::$msBrands[$row['Brand']] . ' ' . $row['Model'] . ' / ' . $row['RegNo'];
        }

        return $cars;
    }

    public static function getUsers()
    {

        global $conn;

        $users = array();
        $conn->query("SELECT PersonID, FullName FROM persons WHERE status IN (2,7,9,12) ORDER BY FullName");
        while ($row = $conn->fetch_array()) {
            $users[$row['PersonID']] = $row['FullName'];
        }

        return $users;
    }

    public static function getDrivers()
    {

        global $conn;

        $drivers = array();
        $query = "SELECT PersonID, FullName 
	          FROM   persons 
		  WHERE  status IN (2,7,9,12) AND DrivingLicense = 'Da' AND CURRENT_DATE >= DrivingStartDate
		  ORDER  BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $drivers[$row['PersonID']] = $row['FullName'];
        }

        return $drivers;
    }

    public static function getProducers($ID = 0)
    { // CIPRIAN
        global $conn;
        $Producers = array();
        $query = "select a.* 
				from companies a
				where a.isAutoFurnizor=1";
        if (!empty($ID))
            $query .= " and a.CompanyID='{$ID}'";
//	$query.=" order by CompanyName ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $Producers[$row['CompanyID']] = $row['CompanyName'];
        }
        return $Producers;
    }

    public static function getDictionary($ID = 0)
    {

        global $conn;

        $dictionary = array();
        $query = "SELECT a.*, b.Unit AS UM_Value 
                        FROM cars_dictionary a 
						LEFT JOIN companies c on c.CompanyID = a.Producer
                        LEFT JOIN measurement_units b ON b.UnitID = a.UM";

        if (!empty($ID)) {
            $query .= " WHERE a.ID = '{$ID}'";
        }

        $query .= " ORDER BY CostTypeID";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            foreach ($row as $k => $v) {
                $row[$k] = stripslashes($v);
            }
            $dictionary[$row['ID']] = $row;
        }

        return $dictionary;
    }

    public static function setDictionary()
    {

        global $conn;

        $ID = (int)$_GET['ID'];

        if ($ID > 0 && !empty($_GET['del'])) {

            $conn->query("DELETE FROM cars_dictionary WHERE ID = $ID");

        } else {

            if ($ID > 0) {
                $conn->query("UPDATE cars_dictionary SET 
							CostTypeID	= '" . $_GET['CostTypeID'] . "',
							Producer    	= '" . $_GET['Producer'] . "',
							Properties   	= '" . $conn->real_escape_string($_GET['Properties']) . "', 
							UM 		= '" . $conn->real_escape_string($_GET['UM']) . "', 
							Cost    	= '" . (double)$_GET['Cost'] . "', 
							Coin  		= '" . $conn->real_escape_string($_GET['Coin']) . "',
							Notes		= '" . $conn->real_escape_string($_GET['Notes']) . "'
			          WHERE ID = $ID");
            } else {
                $conn->query("INSERT INTO cars_dictionary(UserID, PID, CostTypeID, Producer, Properties, UM, Cost, Coin, Notes, CreateDate) 
		              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', 
			             '" . $_GET['CostTypeID'] . "',
				     '" . $_GET['Producer'] . "',
				     '" . $conn->real_escape_string($_GET['Properties']) . "',
				     '" . $conn->real_escape_string($_GET['UM']) . "',
				     '" . (double)$_GET['Cost'] . "',
				     '" . $conn->real_escape_string($_GET['Coin']) . "',
				     '" . $conn->real_escape_string($_GET['Notes']) . "',
			             CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getCosts($action = '')
    {

        global $conn;

        $cond = "1=1";

        if (!empty($_GET['CarID'])) {
            $cond .= " AND a.CarID = " . (int)$_GET['CarID'];
        }

        if (!empty($_GET['CostGroupID'])) {
            $cond .= " AND a.CostGroupID = " . (int)$_GET['CostGroupID'];
        }

        if (!empty($_GET['CostTypeID'])) {
            $cond .= " AND a.ID IN (SELECT DISTINCT CostID FROM cars_cost_details d INNER JOIN cars_dictionary e ON e.ID = d.CostTypeID_Dictionary WHERE e.CostTypeID = '" . (int)$_GET['CostTypeID'] . "')";
        }

        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.CompanyID = " . (int)$_GET['CompanyID'];
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total 
	           FROM   cars_cost a 
			  INNER JOIN cars b ON a.CarID = b.CarID
 			  LEFT JOIN persons c ON a.PersonID = c.PersonID
		   WHERE $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $costs = array();
        $costs[0]['pageNo'] = $pageNo;
        $costs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'b.Brand ASC, b.Model ASC, a.Date DESC, a.ReceiptNo DESC';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : '';

        $query = "SELECT a.*, b.Brand, b.Model, b.RegNo, c.FullName, d.CompanyName, e.StartDate, e.StopDate, g.CostType
	          FROM   cars_cost a
		         INNER JOIN cars b ON a.CarID = b.CarID
			 LEFT JOIN persons c ON a.PersonID = c.PersonID
			 LEFT JOIN companies d ON a.CompanyID = d.CompanyID
                         LEFT JOIN cars_cost_details e ON e.CostID = a.ID
                         LEFT JOIN cars_dictionary f ON f.ID = e.CostTypeID_Dictionary AND a.CostGroupID = 1
                         LEFT JOIN cars_costtype g ON g.CostTypeID = f.CostTypeID
	          WHERE  $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            !empty($row['Date']) ? $row['Date'] = date('d-m-Y', strtotime($row['Date'])) : '';
            !empty($row['StartDate']) ? $row['StartDate'] = date('d-m-Y', strtotime($row['StartDate'])) : '';
            !empty($row['StopDate']) ? $row['StopDate'] = date('d-m-Y', strtotime($row['StopDate'])) : '';
            $row['Cost'] = number_format($row['Cost'], 2, '.', ',');
            $row['Km'] = number_format($row['Km'], 0, '.', ',');
            $costs[$row['ID']] = $row;
        }

        return $costs;
    }

    public static function getCost($ID)
    {

        global $conn;

        $conn->query("SELECT * FROM cars_cost WHERE ID = $ID");
        if ($row = $conn->fetch_array()) {
            $info = $row;
            if ($_GET['costtype'] == 'assurance') {
                $conn->query("SELECT CostTypeID_Dictionary, StartDate, StopDate, ItemCost, ItemCoin, FransizaCost, FransizaCoin, RateNo FROM cars_cost_details WHERE CostID = $ID");
                if ($row = $conn->fetch_array()) {
                    $info = array_merge($info, $row);
                }
            } else {
                $conn->query("SELECT a.ID, a.CostTypeID_Dictionary, a.ItemCost, a.Quantity, a.VAT, c.Unit 
                                    FROM cars_cost_details a 
                                    LEFT JOIN cars_dictionary b ON b.ID = a.CostTypeID_Dictionary
                                    LEFT JOIN measurement_units c ON c.UnitID = b.UM
                                    WHERE a.CostID = $ID ORDER BY a.ID");
                while ($row = $conn->fetch_array()) {
                    $row['Value'] = number_format(round($row['ItemCost'] * $row['Quantity'] * ("1." . str_pad((int)ConfigData::$msVatValues[$row['VAT']], 2, "0", STR_PAD_LEFT)), 2), 2, '.', '');
                    $info['items'][$row['ID']] = $row;
                }
            }
            return $info;
        } else {
            throw new Exception(Message::$msMessagesRO['NO_SUCH_CAR_COST']);
        }
    }

    public static function setCost()
    {

        global $conn, $ID, $add_others;

        $ID = (int)$_GET['ID'];

        if (isset($_GET['ItemID'])) {

            $ItemID = (int)$_GET['ItemID'];

            if ($ItemID > 0 && !empty($_GET['del'])) {

                $conn->query("DELETE FROM cars_cost_details WHERE ID = $ItemID AND CostID = $ID");

            } else {

                if ($ItemID > 0) {
                    $conn->query("UPDATE cars_cost_details SET 
								CostTypeID_Dictionary 	= '" . (int)$_GET['CostTypeID_Dictionary'] . "',
								ItemCost	      	= '" . (double)$_GET['ItemCost'] . "',
								Quantity		= '" . (double)$_GET['Quantity'] . "',
                                                                VAT                     = '" . (int)$_GET['VAT'] . "'
		                  WHERE ID = $ItemID AND CostID = $ID");
                } else {
                    $conn->query("INSERT INTO cars_cost_details(UserID, PID, CostID, CostTypeID_Dictionary, ItemCost, Quantity, VAT, CreateDate) 
		                  VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', '$ID', 
				  '" . (int)$_GET['CostTypeID_Dictionary'] . "', '" . (double)$_GET['ItemCost'] . "', 
				  '" . (double)$_GET['Quantity'] . "', '" . (int)$_GET['VAT'] . "', CURRENT_TIMESTAMP)");
                }
            }

        } else {

            if ($ID > 0 && !empty($_GET['del'])) {

                // Get PersonID in order to delete all  Car type benefits of the person
                $conn->query("SELECT PersonID FROM cars_cost WHERE ID = '$ID'");
                $row = $conn->fetch_array();
                $PersonID = $row['PersonID'];

                // Delete the cost
                $conn->query("DELETE FROM cars_cost WHERE ID = '$ID'");
                $conn->query("DELETE FROM cars_cost_details WHERE CostID = '$ID'");

                // Delete the benefits of type Car
                $conn->query("DELETE FROM persons_beneficii WHERE PersonID = '$PersonID' AND Type=10");

                header('Location: ./?m=cars_cost&o=cost');
                exit;

            } else {

                if (empty($_GET['CarID'])) {
                    return 'Nu ati ales Marca masinii';
                }

                if (empty($_GET['Km'])) {
                    return 'Nu ati ales Km';
                }

                if (empty($_GET['PersonID'])) {
                    return 'Nu ati ales Angajat';
                }

                if (empty($_GET['ReceiptNo'])) {
                    return 'Nu ati ales Numar document';
                }

                if (empty($_GET['Date'])) {
                    return 'Nu ati ales Data document';
                }

                if (empty($_GET['CompanyID'])) {
                    return 'Nu ati ales Furnizor';
                }

//		if (empty($_GET['Cost'])) {
//		    return 'Nu ati ales Valoare';
//		}

                if (empty($_GET['Coin'])) {
                    return 'Nu ati ales Moneda';
                }

                if (empty($_GET['CostGroupID'])) {
                    return 'Nu ati ales Grupa cheltuiala';
                }

                if ($_GET['costtype'] == 'assurance') {

//		    if (empty($_GET['CostTypeID'])) {
//			return 'Nu ati ales Tip asigurare';
//		    }

                    if (empty($_GET['CostTypeID_Dictionary'])) {
                        return 'Nu ati ales Asigurare';
                    }

//		    if (empty($_GET['StartDate'])) {
//			return 'Nu ati ales Data inceput';
//		    }

//		    if (empty($_GET['StopDate'])) {
//			return 'Nu ati ales Data expirare';
//		    }
//
//		    if (empty($_GET['ItemCost'])) {
//			return 'Nu ati ales Valoare asigurare';
//		    }
//
//		    if (empty($_GET['ItemCoin'])) {
//			return 'Nu ati ales Moneda asigurare';
//		    }
//
//		    if (empty($_GET['FransizaCost'])) {
//			return 'Nu ati ales Fransiza';
//		    }
//
//		    if (empty($_GET['FransizaCoin'])) {
//			return 'Nu ati ales Moneda fransiza';
//		    }
//
//		    if (empty($_GET['RateNo'])) {
//			return 'Nu ati ales Numar rate';
//		    }
                }

                if ($ID > 0) {
                    $conn->query("UPDATE cars_cost SET 
						    CarID	= '" . (int)$_GET['CarID'] . "',
						    CompanyID	= '" . (int)$_GET['CompanyID'] . "',
						    Date	= '" . Utils::toDBDate($_GET['Date']) . "',
						    Km		= '" . $conn->real_escape_string($_GET['Km']) . "',	
						    CostGroupID	= '" . (int)$_GET['CostGroupID'] . "',
						    CostTypeID	= '" . (int)$_GET['CostTypeID'] . "',
						    Coin  	= '" . $conn->real_escape_string($_GET['Coin']) . "',
						    ReceiptNo	= '" . $conn->real_escape_string($_GET['ReceiptNo']) . "',
						    PersonID	= '" . (int)$_GET['PersonID'] . "',
						    Budget	= '" . (int)$_GET['Budget'] . "',
						    Checkup	= '" . (int)$_GET['Checkup'] . "',
						    CheckupID	= '" . (int)$_GET['CheckupID'] . "',
						    Notes	= '" . $conn->real_escape_string($_GET['Notes']) . "'
			          WHERE ID = $ID");
                    if ($_GET['costtype'] == 'assurance') {
                        $conn->query("UPDATE cars_cost_details SET
								CostTypeID_Dictionary 	= '" . (int)$_GET['CostTypeID_Dictionary'] . "',
								StartDate             	= '" . Utils::toDBDate($_GET['StartDate']) . "',
								StopDate              	= '" . Utils::toDBDate($_GET['StopDate']) . "',
								ItemCost	      	= '" . (double)$_GET['ItemCost'] . "',
								ItemCoin	      	= '" . $conn->real_escape_string($_GET['ItemCoin']) . "',
								FransizaCost		= '" . (double)$_GET['FransizaCost'] . "',
								FransizaCoin		= '" . $conn->real_escape_string($_GET['FransizaCoin']) . "',
								RateNo			= '" . (int)$_GET['RateNo'] . "'
		                      WHERE CostID = $ID");
                    }
                } else {
                    $conn->query("INSERT INTO cars_cost(UserID, PID, CarID, CompanyID, Date, Km, CostTypeID, CostGroupID, Coin, ReceiptNo, 
		                                    PersonID, Budget, Checkup, CheckupID, Notes, CreateDate) 
		              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', 
			             '" . (int)$_GET['CarID'] . "',
			             '" . (int)$_GET['CompanyID'] . "',
				     '" . Utils::toDBDate($_GET['Date']) . "',
				     '" . $conn->real_escape_string($_GET['Km']) . "',
				     '" . (int)$_GET['CostTypeID'] . "',
				     '" . (int)$_GET['CostGroupID'] . "',
				     '" . $conn->real_escape_string($_GET['Coin']) . "',
				     '" . $conn->real_escape_string($_GET['ReceiptNo']) . "',
				     '" . (int)$_GET['PersonID'] . "',
				     '" . (int)$_GET['Budget'] . "',
				     '" . (int)$_GET['Checkup'] . "',
				     '" . (int)$_GET['CheckupID'] . "',
				     '" . $conn->real_escape_string($_GET['Notes']) . "',
			             CURRENT_TIMESTAMP)");
                    $ID = $conn->get_insert_id();
                    if ($_GET['costtype'] == 'assurance') {
                        $conn->query("INSERT INTO cars_cost_details(UserID, PID, CostID, CostTypeID_Dictionary, StartDate, StopDate,
		                                                ItemCost, ItemCoin, FransizaCost, FransizaCoin, RateNo, CreateDate)
				  VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}',
				         '" . $ID . "', '" . (int)$_GET['CostTypeID_Dictionary'] . "',
					 '" . Utils::toDBDate($_GET['StartDate']) . "', '" . Utils::toDBDate($_GET['StopDate']) . "',
					 '" . (double)$_GET['ItemCost'] . "', '" . $conn->real_escape_string($_GET['ItemCoin']) . "',
					 '" . (double)$_GET['FransizaCost'] . "', '" . $conn->real_escape_string($_GET['FransizaCoin']) . "',
					 '" . (int)$_GET['RateNo'] . "', CURRENT_TIMESTAMP)");
//                        $_GET['ID'] = $conn->get_insert_id();
                    } else {
                        $add_others = true;
                    }
                }

                // Refresh the benefits of the Person
                $conn->query("SELECT PersonID FROM cars_cost WHERE ID = '$ID'");
                $row = $conn->fetch_array();
                $PersonID = $row['PersonID'];

                // Delete the benefits of type Car
                $conn->query("DELETE FROM persons_beneficii WHERE PersonID = '$PersonID' AND Type=10");

                //Insert recomputed benefits
                $conn->query("SELECT *, SUM(Cost) AS MonthlyCost, 
    	    				DATE_FORMAT(a.Date,'%Y-%m-01') AS RegDate,  
    	    				LAST_DAY(a.Date) AS EndDate FROM cars_cost a 
							WHERE a.PersonID='$PersonID' AND a.Budget=1 
							GROUP BY EXTRACT(YEAR_MONTH FROM a.Date), Coin");
                while ($row = $conn->fetch_array()) {
                    $benefits[] = $row;
                }
                if (!empty($benefits))
                    foreach ($benefits AS $benefit) {
                        $conn->query("INSERT INTO persons_beneficii (UserID,PersonID,Type,RegDate,EndDate,CompanyID,Notes,CreateDate,LastUpdateDate,TotalCost,Currency)
	    	     					VALUES ('{$benefit['UserID']}', 
	    	     					'{$benefit['PersonID']}', 
	    	     					10, 
	    	     					'{$benefit['RegDate']}', 
	    	     					'{$benefit['EndDate']}',
	    	     					'{$benefit['CompanyID']}',
	    	     					'{$benefit['Notes']}',
	    	     					CURRENT_TIMESTAMP,
	    	     					CURRENT_TIMESTAMP,
	    	     					'{$benefit['MonthlyCost']}',
	    	     					UPPER('{$benefit['Coin']}')
	    	     					)");
                    }

            }

        }
        if (!empty($ID)) {
            $conn->query("SELECT * FROM cars_cost_details WHERE CostID = '{$ID}'");
            $total_cost = 0;
            while ($row = $conn->fetch_array()) {
                if (empty($row['Quantity'])) {
                    $row['Quantity'] = 1;
                }
                $total_cost += number_format(round($row['ItemCost'] * $row['Quantity'] * ("1." . str_pad((int)ConfigData::$msVatValues[$row['VAT']], 2, "0", STR_PAD_LEFT)), 2), 2, '.', '');
            }
            $total_cost = number_format($total_cost, 2, '.', '');
            $conn->query("UPDATE cars_cost SET Cost = '" . $total_cost . "' WHERE ID = '{$ID}'");
        }

        if (!empty($ID)) {
            $_GET['ID'] = $ID;
        }
//        Utils::pa($_GET);exit;
        header("Location: ./?m=cars_cost&o=cost" . (isset($_GET['costtype']) ? "&costtype=" . $_GET['costtype'] : "") . (isset($_GET['rnd']) ? "&rnd=" . $_GET['rnd'] : "") . (isset($_GET['ID']) ? "&ID=" . $_GET['ID'] : "") . "&msg=1");
    }

    public static function getCostType($CostGroupID = 0)
    {

        global $conn;

        $costtype = array();
        $query = "SELECT a.ID, b.CostTypeID, b.CostType, c.CompanyName, a.Properties 
                    FROM cars_dictionary a
					left join companies c on c.CompanyID=a.Producer
                    INNER JOIN cars_costtype b ON a.CostTypeID = b.CostTypeID
                    WHERE 1=1";
        if (!empty($CostGroupID)) {
            $query .= " AND b.CostGroup = '{$CostGroupID}'";
        }

        $query .= " ORDER  BY b.CostType";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $costtype[$row['CostType']][$row['ID']] = stripslashes($row['CostType'] . ' ' . $row['CompanyName'] . ' ' . $row['Properties']);
        }

        return $costtype;
    }

    public static function getCostTypeDictionary($CostGroupID = 0)
    {

        global $conn;

        $costtype = array();
        $query = "SELECT CostTypeID, CostType, CostGroup, Deletable FROM cars_costtype";
        if (!empty($CostGroupID)) {
            $query .= " WHERE CostGroup = '{$CostGroupID}'";
        }

        $query .= " ORDER BY CostType";

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['CostType'] = stripslashes($row['CostType']);
            $costtype[$row['CostTypeID']] = $row;
        }

        return $costtype;
    }

    public static function getCostTypeByAssurance()
    {

        global $conn;

        $costtype = array();
        $conn->query("SELECT CostTypeID, CostType FROM cars_costtype WHERE CostGroup = 1 ORDER BY CostType");
        while ($row = $conn->fetch_array()) {
            $costtype[$row['CostTypeID']] = stripslashes($row['CostType']);
        }

        return $costtype;
    }

    public static function setCostTypeDictionary()
    {

        global $conn;

        $CostTypeID = (int)$_GET['CostTypeID'];

        if ($CostTypeID > 0 && !empty($_GET['del'])) {

            $conn->query("DELETE FROM cars_costtype WHERE CostTypeID = $CostTypeID");

        } else {

            if ($CostTypeID > 0) {
                $conn->query("UPDATE cars_costtype SET 
							CostType = '" . $conn->real_escape_string($_GET['CostType']) . "',
                                                        CostGroup = '" . (int)$_GET['CostGroup'] . "'
			          WHERE CostTypeID = $CostTypeID");
            } else {
                $conn->query("INSERT INTO cars_costtype(UserID, PID, CostType, CostGroup, CreateDate) 
		              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', 
			             '" . $conn->real_escape_string($_GET['CostType']) . "',
                                     '" . (int)$_GET['CostGroup'] . "',
			             CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getCheckup($ID)
    {

        global $conn;

        $conn->query("SELECT a.*, b.Brand, b.Model, b.RegNo, c.FullName, d.CompanyName 
                        FROM cars_cost a
                        LEFT JOIN cars b ON b.CarID = a.CarID
                        LEFT JOIN persons c ON c.PersonID = a.PersonID
                        LEFT JOIN companies d ON d.CompanyID = a.CompanyID
                        WHERE ID = $ID");
        if ($row = $conn->fetch_array()) {
            $info = $row;

            $conn->query("SELECT a.ID, a.CostTypeID_Dictionary, a.ItemCost, a.Quantity, a.VAT, c.Unit, d.CostType, co.CompanyName, b.Properties
                                FROM cars_cost_details a 
                                LEFT JOIN cars_dictionary b ON b.ID = a.CostTypeID_Dictionary
								left join companies co on co.CompanyID=b.Producer
                                LEFT JOIN measurement_units c ON c.UnitID = b.UM
                                LEFT JOIN cars_costtype d ON d.CostTypeID = b.CostTypeID
                                WHERE a.CostID = $ID ORDER BY a.ID");
            while ($row = $conn->fetch_array()) {
                $row['Value'] = number_format(round($row['ItemCost'] * $row['Quantity'] * ("1." . str_pad((int)ConfigData::$msVatValues[$row['VAT']], 2, "0", STR_PAD_LEFT)), 2), 2, '.', '');
                $row['VAT_value'] = ConfigData::$msVatValues[$row['VAT']];
                $info['items'][$row['ID']] = $row;
            }

            return $info;
        } else {
            throw new Exception(Message::$msMessagesRO['NO_SUCH_CAR_COST']);
        }
    }

    public static function getAvailableCheckups($CarID = 0, $CheckupID = 0)
    {
        global $conn;
        $conn->query("SELECT * FROM cars_checkups WHERE CarID = '{$CarID}'
                        AND ID NOT IN(SELECT DISTINCT CheckupID FROM cars_cost WHERE CheckupID != '{$CheckupID}')
            ORDER BY Km");
        $checkups = array();
        while ($row = $conn->fetch_array()) {
            $checkups[$row['ID']] = $row;
        }
        return $checkups;
    }

    public static function getXLSData($path)
    {
        $data = new Spreadsheet_Excel_Reader($path);
        for ($j = 1; $j <= $data->colcount(); $j++) {
            for ($i = 1; $i <= $data->rowcount(); $i++) {
                self::$CarImportData[$i][$j] = $data->value($i, $j);
            }
        }

    }

    public static function importXLSData($info_arr = array())
    {
        global $conn;
        $size = count($info_arr);
        if ($size != 0) {
            foreach ($info_arr as $info) {
                /*
                if (empty($info[4])) {
                    throw new Exception(Message::getMessage('XLS_FULLNAME_EMPTY'));
                }
                */
                /*
                if (!empty($info[3])) {
                    if(!Utils::checkEmail(trim($info[3])))
                     throw new Exception(Message::getMessage('XLS_EMAIL_ERROR'));
                  }
                  */
                if ($info[0] == 1) { // Verificam daca e bifat
                    //Check if the car already exists
                    $query = "SELECT CarID 
					           FROM   cars a WHERE  RegNo='" . trim($info[4]) . "'";
                    $conn->query($query);
                    $row = $conn->fetch_array();
                    if (!empty($row['CarID']))
                        $CarID = $row['CarID'];
                    else {
                        $conn->query("INSERT INTO cars(UserID, PID, CarType, Brand, Model, RegNo, RegDate, CreateDate, LastUpdateDate)
	                     			 VALUES(
	                     			 '{$_SESSION['USER_ID']}',
	                     			 '{$_SESSION['PERS']}',
	                     			 '" . trim($info[1]) . "'," . " 
	                     			 '" . trim($info[2]) . "'," . "
	                     			 '" . trim($info[3]) . "'," . "
	        						 '" . trim($info[4]) . "'," . "
	        						 '" . Utils::fromXLStoDBDate(trim($info[5])) . "'," . "
	        						 CURRENT_TIMESTAMP,
	                     			 CURRENT_TIMESTAMP
	                     			 )");

                        $CarID = $conn->get_insert_id();
                    }

                    $conn->query("INSERT INTO cars_cost(UserID, PID, CarID, Km, ReceiptNo, Date, Cost, Coin, Notes, CreateDate)
                     			 VALUES(
                     			 '{$_SESSION['USER_ID']}',
                     			 '{$_SESSION['PERS']}',
                     			 '" . $CarID . "'," . "
                     			 '" . trim($info[6]) . "'," . "
        						 '" . trim($info[7]) . "'," . "
        						 '" . Utils::fromXLStoDBDate(trim($info[8])) . "'," . "
        						 '" . trim($info[9]) . "'," . "
        						 '" . trim($info[10]) . "'," . "
        						 '" . trim($info[11]) . "'," . "
								 CURRENT_TIMESTAMP
                     			 )");
                }
            }
        }
    }

    public function addCar($info = array())
    {

        $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO cars(UserID, PID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");

        return $conn->get_insert_id();
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['CarType']) {
            throw new Exception('Nu ati ales tip vehicul!');
        }
        if (!$info['Brand']) {
            throw new Exception('Nu ati ales marca');
        }
        $info['RegDate'] = Utils::toDBDate($info['RegDate']);
        $info['Options'] = !empty($info['Options']) ? serialize($info['Options']) : '';
    }

    public function getCar()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][27][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][27][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][27][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][27][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][27][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   cars a
                  WHERE  a.CarID = {$this->CarID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['Options'] = !empty($row['Options']) ? unserialize($row['Options']) : array();
            return $row;
        } else {
            throw new Exception('Nu exista aceasta masina');
        }
    }

    public function editCar($info = array())
    {

        if (!empty($_GET['action'])) {
            global $conn;
            switch ($_GET['action']) {
                case 'new':
                    $conn->query("INSERT INTO cars_resp(CarID, PersonID, StartDate, StopDate, Notes, CreateDate)
    		                  VALUES({$this->CarID}, '{$_GET['PersonID']}', 
			             '" . Utils::toDBDate($_GET['StartDate']) . "', 
				     '" . (!empty($_GET['StopDate']) ? Utils::toDBDate($_GET['StopDate']) : '') . "', 
				     '" . Utils::formatStr($_GET['Notes']) . "', CURRENT_TIMESTAMP)");
                    break;
                case 'edit':
                    $conn->query("UPDATE cars_resp SET
    				                     PersonID     = '{$_GET['PersonID']}',
    				                     StartDate = '" . Utils::toDBDate($_GET['StartDate']) . "',
    				                     StopDate  = '" . (!empty($_GET['StopDate']) ? Utils::toDBDate($_GET['StopDate']) : '') . "',
						     Notes     = '" . Utils::formatStr($_GET['Notes']) . "'
    			          WHERE ID = {$_GET['ID']} AND CarID = {$this->CarID}");
                    break;
                case 'del':
                    $conn->query("DELETE FROM cars_resp WHERE ID = {$_GET['ID']} AND CarID = {$this->CarID}");
                    break;
            }
            echo "<body onload=\"window.location.href = './?m=cars&o=edit&CarID={$this->CarID}'\"></body>";
            exit;
        }

        $this->setData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][27][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][27][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE cars a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE CarID = {$this->CarID} AND ($condrw)");
    }

    public function delCar()
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][27][1]}' = 3 AND (UserID = {$_SESSION['USER_ID']} OR PID = '{$_SESSION['PERS']}'))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][27][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM cars WHERE CarID = {$this->CarID} AND ($condrw)");
    }

    public function getResp()
    {

        global $conn;

        $conn->query("SELECT * FROM cars_resp WHERE CarID = {$this->CarID} ORDER BY StartDate");
        $resp = array();
        while ($row = $conn->fetch_array()) {
            $resp[$row['ID']] = $row;
        }
        return $resp;
    }

    public function getAssurances()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][27][1][3]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][27][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][27][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.*
	              FROM   cars_assurance a 
		      WHERE  a.CarID = {$this->CarID} AND ($condbase)
		      ORDER  BY a.StartDate");
        $assurances = array();
        while ($row = $conn->fetch_array()) {
            $assurances[$row['ID']] = $row;
        }
        return $assurances;
    }

    public function setAssurance()
    {

        global $conn;

        $ID = (int)$_GET['ID'];

        if ($ID > 0 && !empty($_GET['del'])) {

            $conn->query("DELETE FROM cars_assurance WHERE ID = $ID AND CarID = {$this->CarID}");

        } else {

            $Value = (double)$_GET['Value'];
            $CompanyID = (int)$_GET['CompanyID'];
            $StartDate = Utils::toDBDate($_GET['StartDate']);
            $StopDate = Utils::toDBDate($_GET['StopDate']);

            if ($ID > 0) {
                $conn->query("UPDATE cars_assurance SET 
							CompanyID = '$CompanyID', 
							Value     = '$Value', 
							StartDate = '$StartDate', 
							StopDate  = '$StopDate', 
							Status    = '{$_GET['Status']}' 
			      WHERE ID = $ID AND CarID = {$this->CarID}");
            } else {
                $conn->query("INSERT INTO cars_assurance(UserID, PID, CarID, Type, CompanyID, Value, StartDate, StopDate, CreateDate) 
		              VALUES('{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}', '{$this->CarID}', '{$_GET['Type']}', '$CompanyID', '$Value', '$StartDate', '$StopDate', CURRENT_TIMESTAMP)");
            }
        }
    }

    public function getFinancial()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][27][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][27][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}')) OR
	             '{$_SESSION['USER_RIGHTS2'][27][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT a.ContractID, b.ContractName, b.ContractNo, b.StartDate, b.StopDate, b.ContractValue, b.Coin
	              FROM   cars a
		             INNER JOIN contract b ON a.ContractID = b.ContractID
		      WHERE  a.CarID = {$this->CarID} AND ($condbase)");
        $financial = array();
        if ($row = $conn->fetch_array()) {
            $financial = $row;
        }
        return $financial;
    }

    public function setFinancial()
    {

        global $conn;
        $conn->query("UPDATE cars SET ContractID = '{$_POST['ContractID']}' WHERE CarID = {$this->CarID}");
    }

    public function setPCheckup()
    {
        global $conn;

        $ID = (int)$_GET['ID'];


        if (!empty($ID)) {
            $conn->query("UPDATE cars_checkups SET Km = '" . (int)($_GET['Km']) . "',
                                                    MInt = '" . (int)$_GET['MInt'] . "',
                                                    Notes = '" . $conn->real_escape_string($_GET['Notes']) . "',
                                                    LastModifiedDate = CURRENT_TIMESTAMP
                                                    WHERE ID = '{$ID}'");
        } else {
            $conn->query("INSERT INTO cars_checkups(UserID, PID, CarID, Km, MInt, Notes, LastModifiedDate, CreateDate)
                            VALUES('" . $_SESSION['USER_ID'] . "', '" . $_SESSION['PERS'] . "','{$this->CarID}', '" . (int)$_GET['Km'] . "', '" . (int)$_GET['MInt'] . "', '" . $conn->real_escape_string($_GET['Notes']) . "', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        }

    }

    public function getPCheckups()
    {
        global $conn;

        $conn->query("SELECT a.*, IF(b.ID IS NOT NULL, 0, 1) AS RW FROM cars_checkups a LEFT JOIN cars_cost b ON a.ID = b.CheckupID WHERE a.CarID = '{$this->CarID}' ORDER BY a.Km");
        $checkups = array();
        while ($row = $conn->fetch_array()) {
            $checkups[$row['ID']] = $row;
        }
        return $checkups;
    }

    ### Get Cars Data from Excel

    public function getCheckups($action = '')
    {
        global $conn;

        $cond = "a.CarID = {$this->CarID}";

        if (!empty($_GET['CostTypeID'])) {
            $cond .= " AND a.ID IN (SELECT CostID FROM cars_cost_details b INNER JOIN cars_dictionary c ON c.ID = b.CostTypeID_Dictionary WHERE c.CostTypeID =  '" . (int)$_GET['CostTypeID'] . "')";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;


        $query = "SELECT COUNT(*) AS total 
	           FROM   cars_cost a 
                   WHERE a.Checkup = 1
		   AND  $cond";

        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;


        $costs = array();
        $costs[0]['pageNo'] = $pageNo;
        $costs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.Km';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, d.FullName, e.CompanyName
	          FROM   cars_cost a
			 LEFT JOIN persons d ON a.PersonID = d.PersonID
			 LEFT JOIN companies e ON a.CompanyID = e.CompanyID
	          WHERE  a.Checkup = 1 AND $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $costs[$row['ID']] = $row;
        }

        return $costs;

    }

    ### Import Person Data

    public function getCostsByAssurance($action = '')
    {

        global $conn;

        $cond = "a.CarID = {$this->CarID}";

        if (!empty($_GET['CostTypeID'])) {
            $cond .= " AND c.CostTypeID = " . (int)$_GET['CostTypeID'];
        }

        if (!empty($_GET['Active'])) {
            $cond .= " AND CURRENT_DATE BETWEEN b.StartDate AND b.StopDate";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $query = "SELECT COUNT(*) AS total 
	           FROM   cars_cost a 
		          INNER JOIN cars_cost_details b ON a.ID = b.CostID
		          INNER JOIN cars_dictionary c ON b.CostTypeID_Dictionary = c.ID
                          INNER JOIN cars_costtype f ON f.CostTypeID = c.CostTypeID AND f.CostGroup = 1
		   WHERE  $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $costs = array();
        $costs[0]['pageNo'] = $pageNo;
        $costs[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.Date';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, b.StartDate, b.StopDate, co.CompanyName, c.Properties, d.FullName, e.CompanyName, f.CostType
	          FROM   cars_cost a
		         INNER JOIN cars_cost_details b ON a.ID = b.CostID
		         INNER JOIN cars_dictionary c ON b.CostTypeID_Dictionary = c.ID
						left join companies co on co.CompanyID=c.Producer
                         INNER JOIN cars_costtype f ON f.CostTypeID = c.CostTypeID AND f.CostGroup = 1
			 LEFT JOIN persons d ON a.PersonID = d.PersonID
			 LEFT JOIN companies e ON a.CompanyID = e.CompanyID
	          WHERE  $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $costs[$row['ID']] = $row;
        }

        return $costs;
    }
}

?>