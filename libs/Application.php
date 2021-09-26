<?php

class Application
{

    public static function getApplications()
    {

        global $conn;

        $conn->query("SELECT AppID, Application FROM applications ORDER BY Application");
        $applications = array();
        while ($row = $conn->fetch_array()) {
            $applications[$row['AppID']] = $row['Application'];
        }
        return $applications;
    }

    public static function setApplications($AppID)
    {

        global $conn;

        if (!empty($_GET['delApp']) && $AppID > 0) {
            $modules = self::getAppModules($AppID);
            $conn->query("DELETE FROM applications_modules
                          WHERE AppID = $AppID
                                ");
            $versions = self::getApplicationVersions($AppID);
            $conn->query("DELETE FROM applications_versions
                          WHERE AppID = $AppID
                                ");
            if (!$conn->get_affected_rows() && count($modules) && count($versions)) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta aplicatie deoarece este deja alocata utilizatorilor!'); window.location.href = './?m=dictionary&o=applications';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM applications WHERE AppID = $AppID");
                header('Location: ./?m=dictionary&o=applications');
                exit;
            }
        }

        if (!empty($_GET['App']) && trim($_GET['App'])) {
            if ($AppID > 0) {
                $conn->query("UPDATE applications SET Application = '" . trim($_GET['App']) . "' WHERE AppID = $AppID");
            } else {
                $conn->query("INSERT INTO applications(Application, CreateDate) VALUES('" . trim($_GET['App']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getAppModules($AppID)
    {

        global $conn;

        $conn->query("SELECT ModuleID, Module, Notes FROM applications_modules WHERE AppID = $AppID ORDER BY Module");
        $modules = array();
        while ($row = $conn->fetch_array()) {
            $modules[$row['ModuleID']] = $row;
        }
        return $modules;
    }

    public static function getApplicationVersions($AppID = -1, $pbWithDisplayVersion = true, $VersionID = -1, $pbWithoutInactives = false, $psOrder = 'ASC')
    {

        global $conn;

        if ($pbWithDisplayVersion = true) {
            $query = "SELECT av.*, a.Application FROM applications_versions av 
						INNER JOIN applications a ON av.AppID = a.AppID WHERE 1=1 ";
            if ($AppID > 0)
                $query .= "AND av.AppID=$AppID ";
            if ($VersionID > 0)
                $query .= "AND av.VersionID=$VersionID ";
            if ($pbWithoutInactives == true)
                $query .= "AND av.Status=1 ";
            $query .= " ORDER BY VersionID " . $psOrder;
            $conn->query($query);
            $version = array();
            while ($row = $conn->fetch_array()) {
                $row['DisplayVersion'] = self::getDisplayVersionFromVersionRow($row);
                $version[$row['VersionID']] = $row;
            }
        } else {
            $query = "SELECT * FROM applications_versions WHERE 1=1 ";
            if ($AppID > 0)
                $query .= "AND AppID=$AppID ";
            if ($VersionID > 0)
                $query .= "AND av.VersionID=$VersionID ";
            if ($pbWithoutInactives == true)
                $query .= "AND av.Status=1 ";
            $query .= " ORDER BY VersionID ";

            $conn->query($query);
            $version = array();
            while ($row = $conn->fetch_array()) {
                $version[$row['VersionID']] = $row;
            }
        }
        return $version;
    }

    public static function getDisplayVersionFromVersionRow($row)
    {
        if ($row['Application'] == '' || $row['VersionName'] == '') return '';
        $livrare = !empty($row['VersionLivrare']) ? date('d-m-Y', strtotime($row['VersionLivrare'])) : '';
        $DisplayVersion = $row['Application'] . ' - ' . $row['VersionName'] . ' - ' . $livrare;

        return $DisplayVersion;
    }

    public static function setAppModules($AppID, $ModuleID)
    {

        global $conn;

        if (!empty($_GET['delModule'])) {
            $conn->query("DELETE FROM applications_modules
                          WHERE AppID = $AppID AND
                          ModuleID = $ModuleID ");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest modul deoarece este deja alocat utilizatorilor!'); window.location.href = './?m=dictionary&o=applications&AppID=$AppID';\"></body>";
                exit;
            }
        }

        if (!empty($_GET['Module']) && trim($_GET['Module'])) {
            if ($ModuleID > 0) {
                $conn->query("UPDATE applications_modules SET Module = '" . trim($_GET['Module']) . "', Notes = '" . trim($_GET['Notes']) . "' WHERE ModuleID = $ModuleID AND AppID = $AppID");
            } else {
                $conn->query("INSERT INTO applications_modules (AppID, Module, Notes, CreateDate) VALUES($AppID, '" . trim($_GET['Module']) . "', '" . trim($_GET['Notes']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function setApplicationVersions($AppID, $VersionID)
    {

        global $conn;

        if ($VersionID > 0 && !empty($_GET['delVersion'])) {
            $conn->query("DELETE FROM applications_versions WHERE VersionID = $VersionID AND AppID = $AppID AND NOT EXISTS (SELECT AppVersionID FROM ticketing WHERE AppVersionID = $VersionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta versiune deoarece este deja utilizata!'); window.location.href = './?m=dictionary&o=applications&AppID=$AppID';\"></body>";
                exit;
            }
        } else {
            $AppID = $_GET['AppID'];
            $VersionName = Utils::formatStr($_GET['VersionName']);
            $VersionLivrare = Utils::toDBDate($_GET['VersionLivrare']);
            $VersionDescription = Utils::formatStr($_GET['VersionDescription']);
            $VersionStatus = $_GET['Status'];

            if ($VersionID > 0) {
                //verific daca vreau sa inchid versiunea -> daca da, verific sa nu am tichete cu statut diferit de rezolvat sau anulat care folosesc versiunea;
                //daca gasesc, atunci eroare
                if ($VersionStatus == 0) {
                    $versions = self::getApplicationVersions($AppID, false, $VersionID);
                    if (!empty($versions) && count($versions) > 0) {
                        $OldVersion = $versions[$VersionID];
                        if ($OldVersion['Status'] == 1) {

                            $conn->query("SELECT COUNT(*) AS nb_tichete FROM ticketing WHERE AppVersionID = $VersionID AND Status NOT IN (5,6) ");
                            $row = $conn->fetch_array();
                            if ((int)$row['nb_tichete'] > 0) {
                                echo "<body onload=\"alert('Nu se poate dezactiva (inchide) aceasta versiune deoarece exista tichete nerezolvate sau neanulate atasate acestei versiuni!'); window.location.href = './?m=dictionary&o=applications&AppID=$AppID';\"></body>";
                                exit;
                            }
                        }
                    }
                }
                $conn->query("UPDATE applications_versions SET VersionName = '$VersionName', VersionLivrare = '$VersionLivrare', VersionDescription = '$VersionDescription', Status = $VersionStatus WHERE VersionID = $VersionID AND AppID = $AppID ");
            } else {
                $conn->query("INSERT INTO applications_versions(AppID, VersionName, VersionLivrare, VersionDescription, CreateDate) VALUES($AppID, '$VersionName', '$VersionLivrare', '$VersionDescription', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function validateKey()
    {
        $s = func_get_args();
        if (!empty($s[0])) {
            $a = str_split(preg_replace('([^a-z])', '', strtolower($s[0])));
            $x = '';
            while (isset($a[0])) $x .= base_convert(array_shift($a), 36, 10) - 10;
            if (time() < $x) return true;
        }
        include_once('sendMail.php');
        sendMail(Config::COMPANY_NAME, Config::SMTP_EMAIL, '', Config::SUPPORT_EMAIL, 'Licenta invalida HRE', "Buna ziua,<br><br>Compania " . Config::COMPANY_NAME . " a incercat sa foloseasca aplicatia cu o licenta expirata din data de " . date('d.m.Y', $x) . ".<br><br>Multumesc,<br>HRE");
        return false;
    }

    public static function getAllApplications()
    {

        global $conn;

        $conn->query("SELECT a.AppID, a.Application, b.ModuleID, b.Module
                      FROM   applications a
                             INNER JOIN applications_modules b ON a.AppID = b.AppID
                      ORDER  BY a.Application, b.Module");
        $applications = array();
        while ($row = $conn->fetch_array()) {
            $applications[$row['AppID']][$row['ModuleID']] = $row;
        }

        return $applications;
    }

    public static function getPersonApplications($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][12]}' > 0 AND
	                     (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	                     '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		             OR 
		             {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	                     OR
	                     '{$_SESSION['USER_RIGHTS3'][1][1][12]}' = 2
		             OR 
		             {$_SESSION['USER_ID']} = 1";

        $conn->query("SELECT ModulIT, ModulOthers, FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        $row = $conn->fetch_array();
        $row['ModulIT'] = !empty($row['ModulIT']) ? unserialize($row['ModulIT']) : array();
        $row['ModulOthers'] = !empty($row['ModulOthers']) ? unserialize($row['ModulOthers']) : array();

        return $row;
    }

    public static function setPersonApplications($PersonID)
    {

        global $conn;

        $modulIT = !empty($_POST['modulIT']) ? serialize($_POST['modulIT']) : '';
        $others = !empty($_POST['others']) ? serialize($_POST['others']) : '';

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	                     OR
	                     '{$_SESSION['USER_RIGHTS3'][1][1][12]}' = 2
		             OR 
		             {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE persons a SET ModulIT = '$modulIT', ModulOthers = '$others' WHERE PersonID = $PersonID AND ($condrw)");
    }

    public static function getInduction()
    {

        global $conn;

        $conn->query("SELECT CapitolID, Capitol, Status FROM induction ORDER BY CapitolID");
        $induction = array();
        while ($row = $conn->fetch_array()) {
            $induction[$row['CapitolID']] = $row;
        }
        return $induction;
    }

    public static function setInduction($CapitolID)
    {

        global $conn;

        if (!empty($_GET['delCapitol']) && $CapitolID > 0) {
            $conn->query("DELETE FROM induction WHERE CapitolID = $CapitolID AND NOT EXISTS (SELECT CapitolID FROM persons_induction WHERE CapitolID = $CapitolID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest capitol deoarece este deja alocat angajatilor!'); window.location.href = './?m=dictionary&o=induction';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM induction_items WHERE CapitolID = $CapitolID");
                header('Location: ./?m=dictionary&o=induction');
                exit;
            }
        }

        if (!empty($_GET['Capitol']) && trim($_GET['Capitol'])) {
            if ($CapitolID > 0) {
                $conn->query("UPDATE induction SET Capitol = '" . trim($_GET['Capitol']) . "', Status = '{$_GET['Status']}' WHERE CapitolID = $CapitolID");
            } else {
                $conn->query("INSERT INTO induction(Capitol, CreateDate) VALUES('" . trim($_GET['Capitol']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getInductionItems($CapitolID)
    {

        global $conn;

        $conn->query("SELECT ItemID, CapitolID, Item, Status FROM induction_items WHERE CapitolID = $CapitolID ORDER BY ItemID");
        $items = array();
        while ($row = $conn->fetch_array()) {
            $items[$row['ItemID']] = $row;
        }
        return $items;
    }

    public static function setInductionItem($CapitolID, $ItemID)
    {

        global $conn;

        if (!empty($_GET['delItem'])) {
            $conn->query("DELETE FROM induction_items WHERE CapitolID = $CapitolID AND ItemID = $ItemID AND NOT EXISTS (SELECT ItemID FROM persons_induction_items WHERE ItemID = $ItemID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest item deoarece este deja alocat angajatilor!'); window.location.href = './?m=dictionary&o=induction&CapitolID=$CapitolID';\"></body>";
                exit;
            }
        }

        if (!empty($_GET['Item']) && trim($_GET['Item'])) {
            if ($ItemID > 0) {
                $conn->query("UPDATE induction_items SET Item = '" . trim($_GET['Item']) . "', Status = '{$_GET['Status']}' WHERE ItemID = $ItemID AND CapitolID = $CapitolID");
            } else {
                $conn->query("INSERT INTO induction_items(CapitolID, Item, CreateDate) VALUES($CapitolID, '" . trim($_GET['Item']) . "', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getInductionByPerson($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PersonID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][1][1][19]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][1][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][1][1]}' > 1))
		     OR 
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PersonID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][19]}' = 2
		     OR 
		     {$_SESSION['USER_ID']} = 1";

        $induction = array();

        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM persons a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $induction = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }


        $query = "SELECT a.ID, a.CapitolDate, a.ResponsableID, a.Categorie, p.Status, p.FullName
                    FROM   persons_induction a
                    LEFT JOIN persons p ON p.PersonID = a.ResponsableID
                    WHERE  a.PersonID = $PersonID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $induction["items"][$row['ID']]['CapitolDate'] = Utils::toDisplayDate($row['CapitolDate']);
            $induction["items"][$row['ID']]['Categorie'] = ConfigData::$etica[$row['Categorie']];
            $induction["items"][$row['ID']]['FullName'] = $row['FullName'];
        }

        return $induction;
    }

    public static function setInductionByPerson($PersonID, $data)
    {
        global $conn;

        $CapitolDate = Utils::toDBDate($data['CapitolDate']);
        $conn->query("INSERT INTO persons_induction(UserID, PersonID, CapitolDate, ResponsableID, Categorie, CreateDate)
	                  VALUES({$_SESSION['USER_ID']}, $PersonID, '".$CapitolDate."', " . $data['ResponsableID'] . ", " . $data['Categorie'] . ", CURRENT_TIMESTAMP)");
    }

    public static function delInductionByPerson($PersonID, $ID)
    {
        global $conn;

        $conn->query("DELETE FROM persons_induction WHERE ID = '" . $ID . "'");
    }

    public static function getInventar($PersonID)
    {

        global $conn;

        $conn->query("SELECT ObjID, ObjName, ObjCode, ObjCount, ObjCountAssigned FROM inventar WHERE Status = 1
                        AND ObjCategory != 2
                        AND ObjID NOT IN(SELECT ObjID FROM persons_inventar
                        WHERE ObjType = 2 AND PersonID != '$PersonID'
                AND (CURRENT_TIMESTAMP BETWEEN StartDate AND StopDate OR (CURRENT_TIMESTAMP >= StartDate AND StopDate = '0000-00-00')))
                        AND ObjCount > 0
                        ORDER BY ObjName
                        ");

        $inventar = array();
        while ($row = $conn->fetch_array()) {
            $inventar[$row['ObjID']] = $row;
        }
        return $inventar;
    }

    public static function getPhoneInventar($PersonID)
    {

        global $conn;

        $conn->query("SELECT *, ObjID as MobileTerminal FROM persons a
        				LEFT JOIN persons_inventar e ON e.PersonID = a.PersonID 
        				WHERE a.PersonID = '$PersonID' AND e.ObjType = 2 AND e.Active = 1");

        $row = $conn->fetch_array();
        $row['StartDate'] = Utils::toDBDate($row['StartDate']);
        if (!empty($row['StopDate']) && $row['StopDate'] != '0000-00-00')
            $row['StopDate'] = Utils::toDBDate($row['StopDate']);
        else
            $row['StopDate'] = '';

        return $row;
    }

    public static function getPhoneTerminals($PersonID)
    {
        global $conn;

        $conn->query("SELECT ObjID, ObjName, ObjCode FROM inventar WHERE Status = 1 AND ObjCategory = 2 ORDER BY ObjName");
        $inventar = array();
        while ($row = $conn->fetch_array()) {
            $inventar[$row['ObjID']] = $row;
        }
        return $inventar;
    }

    public static function getPhoneNumbers($PersonID)
    {
        global $conn;

        $conn->query("SELECT ID, PhoneNo, ContractType FROM phone_contracts WHERE 1=1");
        $numbers = array();
        while ($row = $conn->fetch_array()) {
            $numbers[$row['ID']] = $row;
        }

        return $numbers;
    }

    public static function getPersonInventarByID($ID)
    {
        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT *, InvoiceValue*(IF(InvoiceCurrency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = InvoiceCurrency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = YEAR(CreateDate) LIMIT 1), 1)) AS InvoiceRealValue FROM persons_inventar WHERE ID = $ID");
        $inventar = array();
        while ($row = $conn->fetch_array()) {
            $inventar = $row;
        }

        $payed = 0;
        $conn->query("SELECT a.Value*(IF(a.Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = a.Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = YEAR(a.CreateDate) LIMIT 1), 1)) AS RealValue FROM persons_inventar_payments a WHERE a.InventarID = '$ID' ORDER BY CreateDate");
        while ($row = $conn->fetch_array()) {
            $payed += round($row['RealValue'], 2);
        }
        $inventar['Payed'] = number_format($payed, 2);
        $inventar['ToPay'] = number_format(($inventar['InvoiceRealValue'] - $payed), 2);

        return $inventar;
    }

    public static function getPersonInventar()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $conn->query("SELECT a.* FROM persons_inventar a WHERE a.PersonID = $PersonID AND a.ObjType = 1 ORDER BY a.StartDate");
        $inventar = array();
        while ($row = $conn->fetch_array()) {
            $inventar[$row['ID']] = $row;
        }

        foreach ($inventar as $ID => $v) {
            $payed = 0;
            $conn->query("SELECT a.Value*(IF(a.Currency != '{$_SESSION['CURRENCY']['CURRENT']}', (SELECT Rate FROM rates WHERE Currency1 = a.Currency AND Currency2 = '{$_SESSION['CURRENCY']['CURRENT']}' AND Year = YEAR(a.CreateDate) LIMIT 1), 1)) AS RealValue FROM persons_inventar_payments a WHERE a.InventarID = '$ID' ORDER BY CreateDate");
            while ($row = $conn->fetch_array()) {
                $payed += round($row['RealValue'], 2);
            }
            $inventar[$ID]['Payed'] = number_format($payed, 2);
        }

        return $inventar;
    }

    public static function checkPersonPhoneInventar($lPersonId, $lObjectId, $lMobileId, $xStartDate, $xStopDate)
    {
        global $conn;

        $lstReturn = array();

        $StartDate = strtotime($xStartDate);
        if (empty($xStopDate))
            $StopDate = strtotime($xStopDate);
        else
            $StopDate = strtotime(date('Y-m-d', time()));

        $conn->query("SELECT p.PersonID, p.FullName FROM persons_inventar inv INNER JOIN persons p ON inv.PersonID = p.PersonID
						WHERE p.PersonID <> $lPersonId AND inv.active = 1 AND inv.ObjId = $lObjectId AND inv.ObjType = 2 AND p.Status NOT IN (5, 6)
						AND ($StopDate > inv.StartDate && (inv.StopDate IS NULL || inv.StopDate = '0000-00-00' || $StartDate < inv.StopDate)) ");

        $row = $conn->fetch_array();
        if ($row) {
            $lstReturn[0]['alocat'] = 0;// aicisia
            $lstReturn[0]['id'] = $row['PersonID'];
            $lstReturn[0]['nume'] = $row['FullName'];
        } else {
            $lstReturn[0]['alocat'] = 0;
            $lstReturn[0]['id'] = 0;
            $lstReturn[0]['nume'] = '';
        }

        $conn->query("SELECT p.PersonID, p.FullName FROM persons p
						WHERE p.Status NOT IN (5, 6) AND p.PersonID <> $lPersonId AND Mobile = (SELECT PhoneNo FROM phone_contracts WHERE ID=$lMobileId )");

        $row = $conn->fetch_array();
        if ($row) {
            $lstReturn[1]['alocat'] = 1;
            $lstReturn[1]['id'] = $row['PersonID'];
            $lstReturn[1]['nume'] = $row['FullName'];
        } else {
            $lstReturn[1]['alocat'] = 0;
            $lstReturn[1]['id'] = 0;
            $lstReturn[1]['nume'] = '';
        }

        return $lstReturn;

    }

    public static function getPersonInventarPayments()
    {
        global $conn;

        $payments = array();
        $conn->query("SELECT * FROM persons_inventar_payments WHERE InventarID = '" . (int)$_GET['ID'] . "' ORDER BY PaymentDate DESC");
        while ($row = $conn->fetch_array()) {
            $row['Value'] = number_format($row['Value'], 2);
            $payments[$row['ID']] = $row;
        }
        return $payments;
    }

    public static function setPersonInventarPayments()
    {
        global $conn;

        $PaymentID = (int)$_GET['PaymentID'];

        if (!empty($_GET['del'])) {
            if (!empty($PaymentID)) {
                $conn->query("DELETE FROM persons_inventar_payments WHERE ID = '$PaymentID' ORDER BY PaymentDate DESC");
            }
            return;
        }

        $data['Value'] = $conn->real_escape_string($_GET['Value']);
        $data['Currency'] = $conn->real_escape_string($_GET['Currency']);
        $data['PaymentDate'] = date('Y-m-d', strtotime($_GET['PaymentDate']));

        if (!empty($PaymentID)) {
            $update = '';
            foreach ($data as $k => $v) {
                $update .= (!empty($update) ? "," : "") . " $k = '$v'";
            }
            $conn->query("UPDATE persons_inventar_payments SET $update WHERE ID = '$PaymentID'");
        } else {
            $table = '';
            $values = '';
            foreach ($data as $k => $v) {
                $table .= ",$k";
                $values .= ",'$v'";
            }
            $conn->query("INSERT INTO persons_inventar_payments(InventarID, UserID, PID, CreateDate $table)
                            VALUES('" . (int)$_GET['ID'] . "', '" . $_SESSION['USER_ID'] . "', '" . $_SESSION['PERS'] . "', CURRENT_TIMESTAMP $values)");
        }


    }

    public function setPersonInventar()
    {


        global $conn;


        $PersonID = (int)$_GET['PersonID'];


        $active = 1;

        $StartDate = strtotime($_GET['StartDate']);

        $StopDate = strtotime($_GET['StopDate']);

        $count = $_GET["count"];

        $now = strtotime(date('Y-m-d', time()));

        if ($now < $StartDate || ($now > $StopDate && !empty($_GET['StopDate']))) {

            $active = 0;

        }


        switch ($_GET['action']) {

            case 'new':

                $conn->query("UPDATE inventar SET ObjCountAssigned=ObjCountAssigned+" . $count . " WHERE ObjID = " . $_GET['ObjID']);

                $conn->query("UPDATE persons_inventar SET Active = 0 WHERE ObjID = {$_GET['ObjID']} AND Active = 1");

                $conn->query("INSERT INTO persons_inventar(UserID, PersonID, ObjID, ObjType, StartDate, StopDate, Active, Notes, CreateDate)

    		              VALUES({$_SESSION['USER_ID']}, $PersonID, '{$_GET['ObjID']}',

                                     '1',

			             '" . date('Y-m-d', $StartDate) . "', 

			             '" . (!empty($_GET['StopDate']) ? date('Y-m-d', $StopDate) : "") . "', 

                                     '$active',

				     '" . Utils::formatStr($_GET['Notes']) . "', CURRENT_TIMESTAMP)");

                break;

            case 'edit':

                $conn->query("UPDATE persons_inventar SET Active = 0 WHERE ObjID = {$_GET['ObjID']} AND Active = 1");

                $conn->query("UPDATE persons_inventar SET

    				                     ObjID     = '{$_GET['ObjID']}',

    				                     StartDate = '" . date('Y-m-d', $StartDate) . "',

    				                     StopDate  = '" . (!empty($_GET['StopDate']) ? date('Y-m-d', $StopDate) : "") . "',

                                                     Active    = '$active',

                                                     PersonProperty = '" . (!empty($_GET['PersonProperty']) ? 1 : 0) . "',

						     Notes     = '" . Utils::formatStr($_GET['Notes']) . "'

    			      WHERE ID = {$_GET['ID']} AND PersonID = $PersonID");

                break;

            case 'del':

                $conn->query("UPDATE inventar SET ObjCountAssigned=ObjCountAssigned-1 WHERE ObjID = " . $_GET['what']);

                $conn->query("DELETE FROM persons_inventar WHERE ID = {$_GET['ID']} AND PersonID = $PersonID");

                break;

            case 'payments':

                $data['InvoiceNo'] = $conn->real_escape_string($_GET['InvoiceNo']);

                $data['InvoiceDate'] = date('Y-m-d', strtotime($_GET['InvoiceDate']));

                $data['PaymentDueDate'] = date('Y-m-d', strtotime($_GET['PaymentDueDate']));

                $data['InvoiceValue'] = $conn->real_escape_string($_GET['InvoiceValue']);

                $data['InvoiceCurrency'] = $conn->real_escape_string($_GET['InvoiceCurrency']);

                $update = '';

                foreach ($data as $k => $v) {

                    $update .= (!empty($update) ? "," : "") . " $k = '$v'";

                }

                $conn->query("UPDATE persons_inventar SET $update WHERE ID = '" . (int)$_GET['ID'] . "'");
                break;

        }
    }

    public function setPersonPhoneInventar()
    {

        global $conn;

        $PersonID = (int)$_GET['PersonID'];

        $active = 1;
        $StartDate = strtotime($_GET['StartDate']);
        $StopDate = strtotime($_GET['StopDate']);
        $now = strtotime(date('Y-m-d', time()));
        /*
        if($now < $StartDate || ($now > $StopDate && !empty($_GET['StopDate']))){
            $active = 0;
        }
        */

        $conn->query("UPDATE persons_inventar SET Active = 1, StopDate = '$now' WHERE ObjID = '{$_GET['MobileTerminal']}' AND Active = 1 AND ObjType=2 ");
        $conn->query("UPDATE persons SET Mobile = ''  WHERE PersonID <> $PersonID AND Mobile = (SELECT PhoneNo FROM phone_contracts WHERE ID='{$_GET['Mobile']}')");
        $conn->query("UPDATE persons SET Mobile = (SELECT PhoneNo FROM phone_contracts WHERE ID='{$_GET['Mobile']}') WHERE PersonID = '$PersonID'");

        if (!empty($_GET['MobileTerminal'])) {
            $conn->query("INSERT INTO persons_inventar(UserID, PersonID, ObjID, ObjType, StartDate, StopDate, Active, Notes, CreateDate)
	    		              VALUES({$_SESSION['USER_ID']}, $PersonID, '{$_GET['MobileTerminal']}',
	                                     '2',
				             '" . date('Y-m-d', $StartDate) . "', 
				             '" . (!empty($_GET['StopDate']) ? date('Y-m-d', $StopDate) : "") . "', 
	                                     '$active',
					     '" . Utils::formatStr($_GET['Notes']) . "', CURRENT_TIMESTAMP)");

        }
    }

}

?>