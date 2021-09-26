<?php

class Contract extends ConfigData
{

    private $ContractID;

    public function __construct($ContractID = 0)
    {
        if ($ContractID > 0) {
            $this->ContractID = $ContractID;
        }
    }

    public static function getAllContracts($action = '')
    {

        global $conn;

        $cond = '';
        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'ContractNo':
                    $cond .= " AND a.ContractNo LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'CompanyName':
                    $cond .= " AND c.CompanyName LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.ContractName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }
        if (!empty($_GET['ContractTypeID'])) {
            $cond .= " AND a.ContractTypeID = '{$_GET['ContractTypeID']}'";
        }
        if (!empty($_GET['PartnerID'])) {
            $cond .= " AND a.PartnerID = '{$_GET['PartnerID']}'";
        }
        if (!empty($_GET['CompanyID'])) {
            $cond .= " AND a.CompanyID = '{$_GET['CompanyID']}'";
        }
        if (!empty($_GET['CompanyRole'])) {
            $cond .= " AND a.CompanyRole = '{$_GET['CompanyRole']}'";
        }
        if (!empty($_GET['PaymentType'])) {
            $cond .= " AND a.PaymentType = '{$_GET['PaymentType']}'";
        }
        if (!empty($_GET['Coin'])) {
            $cond .= " AND a.Coin = '{$_GET['Coin']}'";
        }
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = '{$_GET['Status']}'";
        }
        if ($_GET['Responsabili'] == 1) {
            $cond .= " AND f.PersonID='{$_GET['TechnicalPersonID']}'";
        }
        if ($_GET['Responsabili'] == 2) {
            $cond .= " AND t.PersonID='{$_GET['FinanciarPersonID']}'";
        }
        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR
                     '{$_SESSION['USER_RIGHTS2'][21][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
					FROM   contract a
					INNER JOIN contract_types b ON a.ContractTypeID = b.ContractTypeID
					INNER JOIN companies c ON a.PartnerID = c.CompanyID

			 LEFT JOIN contract_persons f ON a.ContractID=f.ContractID AND f.PersonType = 1
			 LEFT JOIN persons g ON f.PersonID=g.PersonID
			 LEFT JOIN contract_persons ct ON a.ContractID=ct.ContractID AND ct.PersonType = 2
			 LEFT JOIN persons t ON ct.PersonID=t.PersonID

				   WHERE ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $contracts = array();
        $contracts[0]['pageNo'] = $pageNo;
        $contracts[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.ContractName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, b.ContractType, c.CompanyName, d.UserName, g.FullName, t.FullName as FullNameTechnical
	          FROM   contract a
		         INNER JOIN contract_types b ON a.ContractTypeID = b.ContractTypeID
			 INNER JOIN companies c ON a.PartnerID = c.CompanyID
                	 LEFT JOIN users d ON a.UserID = d.UserID
			 LEFT JOIN contract_persons f ON a.ContractID=f.ContractID AND f.PersonType = 1
			 LEFT JOIN persons g ON f.PersonID=g.PersonID
			 LEFT JOIN contract_persons ct ON a.ContractID=ct.ContractID AND ct.PersonType = 2
			 LEFT JOIN persons t ON ct.PersonID=t.PersonID
                  WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'export_doc', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);

        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $row['PaymentType'] = self::$msPaymentType[$row['PaymentType']];
            $contracts[$row['ContractID']] = $row;
        }
        return $contracts;
    }

    public static function getTypes()
    {

        global $conn;

        $conn->query("SELECT ContractTypeID, ContractType FROM contract_types ORDER BY ContractType");
        $types = array();
        while ($row = $conn->fetch_array()) {
            $types[$row['ContractTypeID']] = $row['ContractType'];
        }
        return $types;
    }

    public static function setType($ContractTypeID)
    {

        global $conn;

        if ($ContractTypeID > 0 && !empty($_GET['delContractType'])) {
            $conn->query("DELETE FROM contract_types
                          WHERE  ContractTypeID = $ContractTypeID AND
			         NOT EXISTS (SELECT ContractTypeID FROM contract WHERE ContractTypeID = ContractTypeID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest tip de contract deoarece este deja utilizat!'); window.location.href = './?m=dictionary&o=contract_type';\"></body>";
                exit;
            }

        } else {

            $ContractType = Utils::formatStr($_GET['ContractType']);

            if ($ContractTypeID > 0) {
                $conn->query("UPDATE contract_types SET ContractType = '$ContractType' WHERE ContractTypeID = $ContractTypeID");
            } else {
                $conn->query("INSERT INTO contract_types(ContractType, CreateDate) VALUES('$ContractType', CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getPersons()
    {

        global $conn;

        $persons = array();

        $query = "SELECT PersonID, FullName FROM persons WHERE status IN (2,3,4,7) ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }

        return $persons;
    }

    public static function getPartnerContacts($CompanyID)
    {

        global $conn;

        $contacts = array();

        $query = "SELECT ContactID, ContactName FROM companies_contacts WHERE CompanyID = $CompanyID ORDER BY ContactName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $contacts[$row['ContactID']] = $row['ContactName'];
        }

        return $contacts;
    }

    public function addContract($info = array())
    {

        $this->setData($info);

        $info['SignDate'] = Utils::toDBDate($info['SignDate']);
        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);

        global $conn;

        $conn->query("INSERT INTO contract(UserID, PID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            //throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        } else {
            $this->ContractID = $conn->get_insert_id();
            return $this->ContractID;
        }
    }

    private function setData(&$info)
    {
        global $conn;
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        if (!$info['ContractName']) {
            throw new Exception(Message::getMessage('CONTRACTNAME_EMPTY'));
        }
        if (!$info['ContractTypeID']) {
            throw new Exception(Message::getMessage('CONTRACTTYPE_EMPTY'));
        }
        if (!$info['CompanyID']) {
            throw new Exception(Message::getMessage('CONTRACTCOMPANY_EMPTY'));
        }
        if (!$info['PartnerID']) {
            throw new Exception(Message::getMessage('CONTRACTPARTNER_EMPTY'));
        }
        if (!$info['ContractNo']) {
            //throw new Exception(Message::getMessage('CONTRACTNO_EMPTY'));
        }
        if (!$info['SignDate']) {
            throw new Exception(Message::getMessage('CONTRACTSIGNDATE_EMPTY'));
        }
        if (!$info['StartDate']) {
            throw new Exception(Message::getMessage('CONTRACTSTARTDATE_EMPTY'));
        }
        if (!$info['StopDate']) {
            throw new Exception(Message::getMessage('CONTRACTSTOPDATE_EMPTY'));
        }
        if (!$info['Status']) {
            //throw new Exception(Message::getMessage('CONTRACTSTATUS_EMPTY'));
        }
    }

    public function editContract($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            $act_ok = 0;

            switch ($_GET['action']) {
                case 'del':
                    $conn->query("DELETE FROM contract_persons WHERE ContractID = {$this->ContractID} AND PersonID = {$_GET['PersonID']} AND PersonType = 1"); //PersonType = 1 <=> responsabil financiar
                    break;
                case 'add':
                    $conn->query("INSERT INTO contract_persons(UserID, ContractID, PersonID, PersonType) VALUES({$_SESSION['USER_ID']}, {$this->ContractID}, {$_GET['PersonID']}, 1)");
                    break;
                case 'del_tehnic':
                    $conn->query("DELETE FROM contract_persons WHERE ContractID = {$this->ContractID} AND PersonID = {$_GET['PersonID']} AND PersonType = 2"); //PersonType = 2 <=> responsabil tehnic
                    break;
                case 'add_tehnic':
                    $conn->query("INSERT INTO contract_persons(UserID, ContractID, PersonID, PersonType) VALUES({$_SESSION['USER_ID']}, {$this->ContractID}, {$_GET['PersonID']}, 2)");
                    break;
                case 'del_contact':
                    $conn->query("DELETE FROM contract_contacts WHERE ContractID = {$this->ContractID} AND ContactID = {$_GET['ContactID']}");
                    break;
                case 'add_contact':
                    $conn->query("INSERT INTO contract_contacts(UserID, ContractID, ContactID) VALUES({$_SESSION['USER_ID']}, {$this->ContractID}, {$_GET['ContactID']})");
                    break;
                case 'new_actead':
                    $stopDate = (!empty($_GET['StopDate'])) ? "'" . Utils::toDBDate($_GET['StopDate']) . "' " : "NULL";
                    $conn->query("INSERT INTO contract_actead(UserID, PID, ContractID, ActNo, StartDate, StopDate, ActValue, Notes, CreateDate)
    		                  VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', {$this->ContractID}, '{$_GET['ActNo']}',
			             '" . Utils::toDBDate($_GET['StartDate']) . "',
				     " . $stopDate . ", '{$_GET['ActValue']}', 
				     '" . Utils::formatStr($_GET['Notes']) . "', CURRENT_TIMESTAMP)");
                    $act_ok = 1;
                    break;
                case 'edit_actead':
                    $stopDate = (!empty($_GET['StopDate'])) ? "'" . Utils::toDBDate($_GET['StopDate']) . "' " : "NULL";
                    $conn->query("UPDATE contract_actead SET
    				                     ActNo     = '{$_GET['ActNo']}',
    				                     StartDate = '" . Utils::toDBDate($_GET['StartDate']) . "',
    				                     StopDate  = " . $stopDate . ",
										 ActValue = '{$_GET['ActValue']}', 
						     Notes     = '" . Utils::formatStr($_GET['Notes']) . "'
    			      WHERE ActID = {$_GET['ActID']} AND ContractID = {$this->ContractID}");
                    $act_ok = 1;
                    break;
                case 'del_actead':
                    $conn->query("DELETE FROM contract_actead WHERE ActID = {$_GET['ActID']} AND ContractID = {$this->ContractID}");
                    $act_ok = 1;
                    break;
            }

            if ($act_ok == 1) {
                //update valoare totala contract
                $lstActead = self::getActead();
                $valActead = 0;
                foreach ($lstActead as $act) {
                    $valActead += $act['ActValue'];
                }
                $contract = self::getContract();
                $contractInitialValue = (double)$contract['ContractInitialValue'];

                $update = "ContractValue = " . ($valActead + $contractInitialValue) . ", ";

                $condrw = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
						OR
							'{$_SESSION['USER_RIGHTS3'][21][1][2]}' = 2
						OR
							{$_SESSION['USER_ID']} = 1";

                $conn->query("UPDATE contract a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE ContractID = {$this->ContractID} AND ($condrw)");
            }

            header('Location: ./?m=contract&o=edit&ContractID=' . $this->ContractID);
            exit;
        }

        $this->setData($info);

        $info['SignDate'] = Utils::toDBDate($info['SignDate']);
        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);

        $update = '';
        foreach ($info as $k => $v) {
            if (!is_array($v)) {
                $update .= "$k = '$v', ";
            }
        }

        $condrw = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][21][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE contract a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE ContractID = {$this->ContractID} AND ($condrw)");
        if ($conn->errno == 1062) {
            //throw new Exception(Message::getMessage('DUPLICATE_CIF'));
        }
    }

    public function getActead()
    {

        global $conn;

        $conn->query("SELECT * FROM contract_actead WHERE ContractID = {$this->ContractID} ORDER BY StartDate");
        $actead = array();
        while ($row = $conn->fetch_array()) {
            $actead[$row['ActID']] = $row;
        }
        return $actead;
    }

    public function getContract()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][21][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][21][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR '{$_SESSION['USER_RIGHTS2'][21][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][21][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.CIF, b.RegComert, c.BankName, c.BankLocation, c.BankAccount, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   contract a
		         LEFT JOIN companies b ON a.PartnerID = b.CompanyID
		         LEFT JOIN banks c ON b.BankID = c.BankID
                  WHERE  a.ContractID = {$this->ContractID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $row['ContractName'] = stripslashes($row['ContractName']);
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_CONTRACT'));
        }
    }

    public function delContract()
    {

        global $conn;

        $query = "DELETE FROM contract WHERE ContractID = {$this->ContractID} AND {$_SESSION['USER_ID']} = 1";
        $conn->query($query);
    }

    public function getContractFinance()
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][21][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][21][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}') OR '{$_SESSION['USER_RIGHTS2'][21][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][21][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   contract a
                  WHERE  a.ContractID = {$this->ContractID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_CONTRACT'));
        }
    }

    public function editContractFinance($info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            $tva = substr(ConfigData::$msVatValues[1], 0, -1);
            switch ($_GET['action']) {
                case 'del_rata':
                    $conn->query("DELETE FROM contract_rate WHERE RataID = {$_GET['RataID']} AND ContractID = {$this->ContractID}");
                    break;

                case 'add_rata':
                    $conn->query("INSERT INTO contract_rate(UserID, PID, ContractID, RataValue, TVA, PayDate, CreateDate)
    		                  VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', {$this->ContractID}, '{$_GET['RataValue']}', '{$tva}', 
							  '" . Utils::toDBDate($_GET['PayDate']) . "',
								CURRENT_TIMESTAMP)");
                    break;

                case 'edit_rata':
                    $conn->query("UPDATE contract_rate SET
							RataValue = '{$_GET['RataValue']}',
							PayDate = '" . Utils::toDBDate($_GET['PayDate']) . "',
							RataAchitat = '{$_GET['RataAchitat']}' 
							WHERE RataID = {$_GET['RataID']} AND ContractID = {$this->ContractID}"
                    );
                    break;

            }
            header('Location: ./?m=contract&o=finance&ContractID=' . $this->ContractID);
            exit;
        }

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);

        $info['PayDate'] = Utils::toDBDate($info['PayDate']);
        $info['GuaranteeExpireDate'] = Utils::toDBDate($info['GuaranteeExpireDate']);

        $lstActead = self::getActead();
        $valActead = 0;
        foreach ($lstActead as $act) {
            $valActead += $act['ActValue'];
        }

        $update = '';
        foreach ($info as $k => $v) {
            if (!is_array($v)) {
                $update .= "$k = '$v', ";
            }
        }

        $update .= "ContractValue = " . (!empty($info['ContractInitialValue']) ? $valActead + $info['ContractInitialValue'] : $valActead) . ", ";

        $condrw = "('{$_SESSION['USER_RIGHTS2'][21][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']} AND a.PID = '{$_SESSION['PERS']}')
	             OR
	             '{$_SESSION['USER_RIGHTS3'][21][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE contract a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE ContractID = {$this->ContractID} AND ($condrw)");
    }

    public function getContractPersons()
    {

        global $conn;

        $query = "SELECT a.PersonID, b.FullName, b.Phone, b.Mobile, d.Function
                  FROM   contract_persons a
		         INNER JOIN persons b ON a.PersonID = b.PersonID
			 INNER JOIN payroll c ON a.PersonID = c.PersonID
			 LEFT JOIN internal_functions d ON c.InternalFunction = d.FunctionID
                  WHERE  a.ContractID = {$this->ContractID} AND a.PersonType = 1";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public function getContractTechnicalPersons()
    {

        global $conn;

        $query = "SELECT a.PersonID, b.FullName, b.Phone, b.Mobile, d.Function
                  FROM   contract_persons a
		         INNER JOIN persons b ON a.PersonID = b.PersonID
			 INNER JOIN payroll c ON a.PersonID = c.PersonID
			 LEFT JOIN internal_functions d ON c.InternalFunction = d.FunctionID
                  WHERE  a.ContractID = {$this->ContractID}  AND a.PersonType = 2";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public function getContractsTechnicalPersons()
    {

        global $conn;

        $query = "SELECT a.PersonID, b.FullName, b.Phone, b.Mobile, d.Function
                  FROM   contract_persons a
		         INNER JOIN persons b ON a.PersonID = b.PersonID
			 INNER JOIN payroll c ON a.PersonID = c.PersonID
			 LEFT JOIN internal_functions d ON c.InternalFunction = d.FunctionID
                  WHERE  a.PersonType = 2";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }
        return $persons;
    }

    public function getContractsFinanciarPersons()
    {

        global $conn;

        $query = "SELECT a.PersonID, b.FullName, b.Phone, b.Mobile, d.Function
                  FROM   contract_persons a
		         INNER JOIN persons b ON a.PersonID = b.PersonID
			 INNER JOIN payroll c ON a.PersonID = c.PersonID
			 LEFT JOIN internal_functions d ON c.InternalFunction = d.FunctionID
                  WHERE  a.PersonType = 1";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'];
        }
        return $persons;
    }

    public function getRate()
    {

        global $conn;

        $contract = self::getContract();
        $contractValue = (double)$contract['ContractValue'];

        $conn->query("SELECT * FROM contract_rate WHERE ContractID = {$this->ContractID} ORDER BY CreateDate");
        $lstRate = array();
        $sum = 0;
        while ($row = $conn->fetch_array()) {
            $tva = (int)$row['TVA'];
            $row['RataValueTVA'] = round((double)$row['RataValue'] + ((double)$row['RataValue'] * $tva / 100), 2);
            $sum += $row['RataValueTVA'];
            $row['RataProcent'] = round(($row['RataValueTVA'] / $contractValue) * 100, 2);
            $row['RataRealizat'] = round(($sum / $contractValue) * 100, 2);

            $lstRate[$row['RataID']] = $row;
        }
        return $lstRate;
    }

    public function getContactPersons()
    {

        global $conn;

        $query = "SELECT a.ContactID, b.ContactName, b.ContactFunction, b.ContactPhone
                  FROM   contract_contacts a
		         INNER JOIN companies_contacts b ON a.ContactID = b.ContactID
                  WHERE  a.ContractID = {$this->ContractID}";
        $conn->query($query);
        $persons = array();
        while ($row = $conn->fetch_array()) {
            $persons[$row['ContactID']] = $row;
        }
        return $persons;
    }

    public function getOffers()
    {

        global $conn;

        $query = "SELECT a.CompanyID, d.ActivityDetID, d.ActivityID, d.OfferDate, d.OfferValue, d.Coin, d.ContactID, p.Beneficiary
	          FROM   activities a
		         INNER JOIN activities_det d ON a.ActivityID = d.ActivityID AND d.OfferValue > 0 AND d.OfferDate > '0000-00-00'
			 INNER JOIN (
                                	SELECT MAX(d.ActivityDetID) AS id
					FROM   activities_det d
					       LEFT JOIN activities a ON a.ActivityID = d.ActivityID
				        GROUP BY a.ActivityID
				    ) ids ON d.ActivityDetID = ids.id
			 INNER JOIN contract c ON a.CompanyID = c.PartnerID AND c.ContractID = {$this->ContractID}
		         LEFT JOIN pontaj_projects p ON d.ProjectID = p.ProjectID
	          ORDER  BY d.OfferDate";
        $conn->query($query);
        $offers = array();
        while ($row = $conn->fetch_array()) {
            $offers[] = $row;
        }

        return $offers;
    }

    public function getContractOffers()
    {
        global $conn;
        $conn->query("SELECT ActivityDetID FROM contract_offers WHERE ContractID = {$this->ContractID}");
        $offers = array();
        while ($row = $conn->fetch_array()) {
            $offers[$row['ActivityDetID']] = $row;
        }
        return $offers;
    }

    public function setContractOffers()
    {
        global $conn;
        $conn->query("DELETE FROM contract_offers WHERE ContractID = {$this->ContractID}");
        if (!empty($_POST['contract_offers'])) {
            foreach ($_POST['contract_offers'] as $ActivityDetID => $v) {
                $conn->query("INSERT INTO contract_offers(UserID, ContractID, ActivityDetID, CreatedDate) 
		              VALUES({$_SESSION['USER_ID']}, {$this->ContractID}, {$ActivityDetID}, CURRENT_TIMESTAMP)");
            }
        }
    }
}

?>