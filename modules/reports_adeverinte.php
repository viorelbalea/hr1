<?php

if (!($_SESSION['USER_ID'] == 1 || in_array($_GET['rep'], $_SESSION['REPORT_RIGHTS'][7]))) {
    header('Location: ./?m=reports');
    exit;
}

$cond = in_array($_GET['rep'], array(72, 73, 74, 75, 76, 77, 78)) ? "" : " AND a.status=2";
if (!empty($_GET['CompanyID'])) {
    $cond .= " AND b.CompanyID = " . (int)$_GET['CompanyID'];
}
if (!empty($_GET['DivisionID'])) {
    $cond .= " AND b.DivisionID = " . (int)$_GET['DivisionID'];
}

if ($_SESSION['USER_ID'] == 1) {

    $query = "SELECT a.PersonID, a.FullName 
              FROM   persons a
                     INNER JOIN payroll b ON a.PersonID = b.PersonID
                     WHERE 1=1 $cond 
              ORDER  BY a.FullName";
} else {
    $query = "SELECT a.PersonID, a.FullName FROM persons a
    			INNER JOIN payroll b ON a.PersonID=b.PersonID
    			WHERE (a.UserID = '{$_SESSION['USER_ID']}' OR b.DirectManagerID='{$_SESSION['PERS']}' OR a.PersonID='{$_SESSION['PERS']}') 
    			$cond
    			ORDER BY FullName";
}

$conn->query($query);
while ($row = $conn->fetch_array()) {
    $persons[$row['PersonID']] = $row['FullName'];
}

//if (!empty($_GET['PersonID']) && !empty($_GET['CompanyID'])) {
if (!empty($_GET['PersonID'])) {

    switch ($_GET['rep']) {

        case 25:
        case 148:
            $query = "SELECT a.FullName, a.CNP, a.BISerie, a.BINumber, a.Status, a.Sex, 
	                     DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
	                     DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS StopDate,
	                     DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS ContractDate, b.ContractNo, b.Law, 
						 e.CompanyName, e.CIF, e.RegComert, e.CompanyDomainID, e.CompanyEmail, e.CompanyWebsite,  
						 f.*, g.CityName, h.DistrictName, i.PhoneNumberA, i.FaxNumber,
						 j.FullName as LegalFullName, l.Function as LegalFunction, m.FullName as HRFullName, o.Function as HRFunction
			     " . ($_GET['rep'] == 148 ? ", (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND Aprove = 1) AS TCMDaysNo" : "") . "	
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
							 INNER JOIN companies e ON b.CompanyID = e.CompanyID
                             LEFT JOIN address f ON e.AddressID=f.AddressID AND f.AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
							 LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
							 LEFT JOIN payroll k ON k.PersonID = j.PersonID
							 LEFT JOIN functions l ON k.FunctionID=l.FunctionID
							 LEFT JOIN persons m ON e.HRPersonID=m.PersonID
							 LEFT JOIN payroll n ON n.PersonID = m.PersonID
							 LEFT JOIN functions o ON n.FunctionID=o.FunctionID
					  WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];

            $AddressName = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $AddressName;

            $smarty->assign('info', $info);
            $smarty->assign('companydomains', Job::getJobDomains());
            $filename = "Adeverinta_somaj";
            break;

        case 26:
            $query = "SELECT a.FullName, a.Sex, a.CNP, c.Division, j.CityName as PersonCityName, d.StreetName as PersonStreetName, 
						d.StreetNumber as PersonStreetNumber, d.Bl as PersonBl, d.Sc as PersonSc, d.Et as PersonEt, b.ContractType, 
						d.Ap as PersonAp, k.DistrictName as PersonDistrictName, l.Function, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate, 
						e.CompanyName, e.CIF, e.RegComert, e.CompanyDomainID, e.CompanyEmail, e.CompanyWebsite,  
						f.*, g.CityName, h.DistrictName, i.PhoneNumberA, i.FaxNumber
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
                             LEFT JOIN address d ON a.AddressID = d.AddressID
							 INNER JOIN companies e ON b.CompanyID = e.CompanyID
                             LEFT JOIN address f ON e.AddressID=f.AddressID AND f.AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
							 LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
							 LEFT JOIN address_city j ON j.CityID = d.CityID
                             LEFT JOIN address_district k ON j.DistrictID = k.DistrictID
							 LEFT JOIN functions l ON b.FunctionID = l.FunctionID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';

            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];

            $AddressName = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $AddressName;

            $smarty->assign('info', $info);
            $filename = "Adeverinta_crestere_copil";
            break;

        case 27:
            $query = "SELECT a.FullName, a.CNP, b.ContractType, c.Division, b.CompanyID, d.CompanyName,
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND Aprove >= 0 AND StartDate >= DATE_SUB(CURRENT_DATE, INTERVAL 12 MONTH)) AS cm_days
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
                             LEFT JOIN companies d ON b.CompanyID = d.CompanyID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';
            // Get resized photo
            if (!file_exists(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg', 350, 500);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/logo/' . basename($resized);
            }
            $smarty->assign('info', $info);
            $filename = "Adeverinta_medic_familie";
            break;

        case 28:
            $query = "SELECT a.FullName, a.Sex, a.CNP, c.Division, d.Function, e.CompanyName, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
					DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS StopDate, b.CICSuspensionDemandNo,
					e.CIF, e.RegComert, e.CompanyDomainID, e.CompanyEmail, e.CompanyWebsite,  
					f.*, g.CityName, h.DistrictName, i.PhoneNumberA, i.FaxNumber
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
                             LEFT JOIN internal_functions d ON b.InternalFunction = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID
							 LEFT JOIN address f ON e.AddressID=f.AddressID AND AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
							 LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];

            $AddressName = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $AddressName;

            $smarty->assign('info', $info);
            $filename = "Adeverinta_postnatal";
            break;

        case 29:
        case 146:
            $query = "SELECT a.FullName, a.CNP, a.Sex, b.ContractType, c.Division, d.Function, 
					e.CompanyName, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate, j.FullName as LegalFullName, 
					(SELECT SalaryNet FROM persons_salary WHERE PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS LastSalaryNet
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
							 INNER JOIN companies e ON b.CompanyID = e.CompanyID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
							 LEFT JOIN internal_functions d ON b.InternalFunction = d.FunctionID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';
            $smarty->assign('info', $info);
            $filename = "Adeverinta_primarie";
            break;

        case 45:
            $query = "SELECT a.FullName, b.EmpCode, b.StopDate, b.ContractDate, b.ContractNo, b.ContractExpDate, b.Law, c.Function,
	                     e.CompanyName, e.CIF, e.RegComert, f.*, i.PhoneNumberA
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
			     LEFT JOIN internal_functions c ON b.InternalFunction = c.FunctionID
			     INNER JOIN companies e ON b.CompanyID = e.CompanyID
			     LEFT JOIN address f ON e.AddressID=f.AddressID AND f.AddressType=1
			     LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();
            $CompanyAddress = '';
            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];
            $CompanyAddress = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $CompanyAddress;
            $query = "SELECT Marca
	              FROM   persons_car
		      WHERE  PersonID = '{$_GET['PersonID']}'
		      ORDER  BY ContractDate";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $info['inventar'][] = $row['Marca'];
            }
            $query = "SELECT b.ObjName
	              FROM   persons_inventar a
		             INNER JOIN inventar b ON a.ObjID = b.ObjID 
		      WHERE  a.PersonID = '{$_GET['PersonID']}'
                           AND a.ObjType = 1 AND Active = 1
		      ORDER  BY a.StartDate";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $info['inventar'][] = $row['ObjName'];
            }
            $smarty->assign('info', $info);
            $filename = "Fisa_lichidare";
            break;

        case 56:
            $person = new Person($_GET['PersonID']);
            $children = $person->getChildren();
            $cond = "";
            if (!empty($_GET['ChildID']))
                $cond .= " AND h.ChildID='{$_GET['ChildID']}'";

            $query = "SELECT a.FullName, a.CNP, a.Sex, a.BINumber, a.BISerie, a.BIStartDate, a.BIEmitent, b.StartDate, c.Division,
			     f.CityName, d.StreetName, d.StreetNumber, d.Bl, d.Sc, d.Et, d.Ap, g.DistrictName, b.CompanyID, h.ChildName
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
			     			 LEFT JOIN address d ON a.AddressID = d.AddressID
                             LEFT JOIN address_city f ON f.CityID = d.CityID
                             LEFT JOIN address_district g ON f.DistrictID = g.DistrictID
                             LEFT JOIN persons_children h ON a.PersonID=h.PersonID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' $cond AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';
            if (!file_exists(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg', 350, 500);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/logo/' . basename($resized);
            }
            $smarty->assign('children', $children);
            $smarty->assign('info', $info);
            $filename = "Adeverinta_gradinita";
            break;

        case 135:
            $query = "SELECT a.FullName, a.CNP, b.StartDate, a.Sex, j.FullName as LegalFullName, b.HealthCompanyID, 	
			     b.CompanyID, b.StartDate AS fStartDate, b.StopDate AS fStopDate, b.ContractNo, b.CM,
			     d.Function, e.CompanyName, e.CIF, e.RegComert, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate 
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN functions d ON b.FunctionID = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            // Get resized photo
            if (file_exists('photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg', 800, 172);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/_tmp/' . basename($resized);
            }

            $cm_array = array();
            $total_cm = 0;
            $query_cm = "SELECT * FROM vacations_details v
								INNER JOIN persons a ON a.PersonID = v.PersonID
							WHERE v.PersonID = a.PersonID AND Type = 'CM' 
							AND v.StartDate>=DATE_SUB(curdate(), INTERVAL 1 YEAR)
							AND a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) 
							ORDER BY v.Year, v.StartDate";
            $conn->query($query_cm);
            while ($row = $conn->fetch_array()) {
                $tmp_array = array();
                $nr_days = Utils::getDaysDiff($row['StartDate'], $row['StopDate']);
                $tmp_array['StartDate'] = $row['StartDate'];
                $tmp_array['StopDate'] = $row['StopDate'];
                $tmp_array['Year'] = $row['Year'];
                $tmp_array['NrDays'] = $nr_days;
                $cm_array[] = $tmp_array;

                $total_cm += $nr_days;
            }

            $display_cm_array = array();
            foreach ($cm_array as $cm_vacation) {
                $month_start = date('m', strtotime($cm_vacation['StartDate']));
                $month_end = date('m', strtotime($cm_vacation['StopDate']));

                $month_start_name = ConfigData::$msMonthValues[(int)$month_start];
                $display_cm_array[$cm_vacation['Year']][$month_start_name]['NrDays'] += (int)$cm_vacation['NrDays'];
                $display_cm_array[$cm_vacation['Year']][$month_start_name]['detail'][] = $cm_vacation;
            }
            $info['StartDateDay'] = date('d', strtotime($info['fStartDate']));

            $info['TotalCM'] = $total_cm;
            $info['DisplayCM'] = $display_cm_array;

            // Get Age in company
            $arr = Utils::dateDiff2YMD($info['fStartDate'], $info['fStopDate']);
            $info['FirmYearAge'] = $arr[0];
            $info['FirmMonthAge'] = $arr[1];


            $smarty->assign('info', $info);
            switch ($_GET['rep']) {
                case 135:
                    $filename = "Adeverinta - Medic familie, spital, policlinica";
                    break;
            }

            break;

        case 136:
            $query = "SELECT a.FullName, a.CNP, b.StartDate, a.Sex, a.BINumber, a.BISerie, a.BIStartDate, a.BIEmitent, 
			     b.CompanyID, b.StopDate, b.ContractNo, b.CM, b.StartDate, 
			     d.Function, e.CompanyName, e.CIF, e.RegComert, j.FullName as LegalFullName, 
				 l.StreetName as PersonStreetName, l.StreetCode as PersonStreetCode, l.StreetNumber as PersonStreetNumber, 
				 l.Bl as PersonBl, l.Sc as PersonSc, l.Et as PersonEt, l.Ap as PersonAp, 
	    		 m.CityName AS PersonCity,n.DistrictName AS PersonDistrict,
				 (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND StartDate>=DATE_SUB(curdate(), INTERVAL 1 YEAR)) AS TotalCM 
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN functions d ON b.FunctionID = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
							 LEFT JOIN address l ON a.AddressID=l.AddressID
                             LEFT JOIN address_city m ON l.CityID=m.CityID
                             LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            // Get resized photo
            if (file_exists('photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg', 800, 172);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/_tmp/' . basename($resized);
            }

            $lstIntretinere = array();
            $tmp = Person::getPersonsByIntretinere($_GET['PersonID']);
            foreach ($tmp as $pers_intretinere) {
                if ($pers_intretinere['Active'] == 1 && $pers_intretinere['DataFin'] == '00-00-0000')
                    $lstIntretinere[] = $pers_intretinere;
            }
            $info['lstIntretinere'] = $lstIntretinere;

            // Get Age in company
            $arr = Utils::dateDiff2YMD($info['StartDate'], $info['StopDate']);
            $info['FirmYearAge'] = $arr[0];
            $info['FirmMonthAge'] = $arr[1];

            $smarty->assign('info', $info);
            $smarty->assign('quality', Person::$msQuality);

            switch ($_GET['rep']) {
                case 136:
                    $filename = "Adeverinta - Persoane intretinere";
                    break;
            }

            break;

        case 137:
        case 138:
        case 139:
        case 140:
            $query = "SELECT a.FullName, a.CNP, b.StartDate, a.Sex, a.BINumber, a.BISerie, a.BIStartDate, a.BIEmitent, 
			     b.CompanyID, b.StopDate, b.ContractNo, b.CM, b.ContractType, b.ResignationDemandNo, b.Law,
			     d.Function, e.CompanyName, e.CIF, e.RegComert,
				 l.StreetName as PersonStreetName, l.StreetCode as PersonStreetCode, l.StreetNumber as PersonStreetNumber, 
				 l.Bl as PersonBl, l.Sc as PersonSc, l.Et as PersonEt, l.Ap as PersonAp, 
	    		 m.CityName AS PersonCity,n.DistrictName AS PersonDistrict,
				 f.*, g.CityName, h.DistrictName, j.FullName as LegalFullName, j.Sex as LegalSex, 
				 (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND StartDate>=DATE_SUB(curdate(), INTERVAL 1 YEAR)) AS TotalCM 
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN functions d ON b.FunctionID = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID
							 LEFT JOIN address f ON e.AddressID=f.AddressID AND f.AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
							 LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
							 LEFT JOIN address l ON a.AddressID=l.AddressID
                             LEFT JOIN address_city m ON l.CityID=m.CityID
                             LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            // Get resized photo
            if (file_exists('photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/photo_header_report_' . md5($info['CompanyID']) . '.jpg', 800, 172);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/_tmp/' . basename($resized);
            }
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';

            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];

            $AddressName = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $CompanyAddress;

            $smarty->assign('info', $info);
            switch ($_GET['rep']) {
                case 137:
                    $filename = "Adeverinta - Decizie suspendare CIC";
                    break;
            }

            break;

        case 57:
        case 85:
        case 134:
        case 147:
            $query = "SELECT a.FullName, a.CNP, a.Sex, a.BINumber, a.BISerie, a.BIStartDate, a.BIEmitent, b.StartDate, c.Division,
			     f.StreetName, f.StreetNumber, f.Bl, f.Sc, f.Et, f.Ap, h.DistrictName, b.CompanyID,
			     b.StartDate AS fStartDate, b.StopDate AS fStopDate, b.ContractNo,b.CM, b.ContractType, DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS ContractDate,  
			     d.Function, e.CompanyName, e.CIF, e.RegComert, f.*, g.CityName, h.DistrictName, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
				 i.PhoneNumberA, i.FaxNumber, j.FullName as LegalFullName, 
				 d.COR as CodCor, d.Function as NumeCor,
				 t.FullName as HRFullName, n.DistrictID as DistrictID, b.ContractType as ContractType,
				 l.StreetName as PersonStreetName, l.StreetCode as PersonStreetCode, l.StreetNumber as PersonStreetNumber, 
				 l.Bl as PersonBl, l.Sc as PersonSc, l.Et as PersonEt, l.Ap as PersonAp, 
				 m.CityName AS PersonCity, n.DistrictName AS PersonDistrict, 
	                     (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID = a.PersonID AND Type = 'CM' AND StartDate>=DATE_SUB(curdate(), INTERVAL 1 YEAR)) AS cm_days,
	                     (SELECT Salary FROM persons_salary WHERE PersonID=a.PersonID ORDER BY SalaryID DESC LIMIT 1) AS CurrSalary
			     " . ($_GET['rep'] == 147 ? ",(SELECT ABS(CEIL(SUM(Hours)/IF(b.WorkNorm>'',b.WorkNorm,8))) FROM pontaj_detail WHERE PersonID=a.PersonID AND Type = 3) AS THours_Abs" : "") . "
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
                             LEFT JOIN functions d ON b.FunctionID = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID
                             LEFT JOIN address f ON e.AddressID=f.AddressID AND AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
							 LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
							 LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
							 LEFT JOIN address l ON a.AddressID=l.AddressID
                             LEFT JOIN address_city m ON l.CityID=m.CityID
                             LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
                             LEFT JOIN persons t ON e.HRPersonID=t.PersonID
                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";
            $conn->query($query);
            $info = $conn->fetch_array();

            $queryCM = "SELECT CodInd, SUM(DaysNo) as Days FROM vacations_details WHERE PersonID = '{$_GET['PersonID']}' AND Type = 'CM' AND StartDate>=DATE_SUB(curdate(), INTERVAL 1 YEAR) GROUP BY CodInd";
            $conn->query($queryCM);
            while ($row = $conn->fetch_array()) {
                $infoCM[] = $row;
            }
            // Get resized photo
            if (!file_exists(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg', 350, 500);
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/logo/' . basename($resized);
                if ($info['StartDate'] != NULL) {
                    $info['StartDateDay'] = date('d', strtotime($info['fStartDate']));
                    $info['StartDateMonth'] = date('m', strtotime($info['fStartDate']));
                    $info['StartDateYear'] = date('Y', strtotime($info['fStartDate']));
                }
            }
            // Get Age in company
            if ($info['fStopDate'] == '0000-00-00' || empty($info['fStopDate']))
                $fStopDate = date('Y-m-d');
            else
                $fStopDate = $info['fStopDate'];
            $arr = Utils::dateDiff2YMD($info['fStartDate'], $fStopDate);
            $info['FirmAge'] = $arr[0];
            $info['ContractType'] = $info['ContractType'] == 1 ? 'determinata' : 'nedeterminata';

            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            if ($info['CityName']) $CompanyAddress .= ', ' . $info['CityName'];
            if ($info['DistrictName']) $CompanyAddress .= ', ' . $info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];

            $AddressName = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $AddressName;
            //print_r($infoCM);
            $smarty->assign('info', $info);
            $smarty->assign('infoCM', $infoCM);
            switch ($_GET['rep']) {
                case 57:
                    $filename = "Adeverinta_medic_familie";
                case 85:
                    $filename = "Adeverinta - Vechime";
                    break;
            }
            break;

        case 64:
        case 65:
        case 66:
        case 67:
        case 68:
        case 69:
        case 70:
        case 71:
        case 72:
        case 73:
        case 74:
        case 75:
        case 76:
        case 77:
        case 78:
        case 79:
        case 80:
        case 81:
        case 82:
        case 84:
        case 131:
        case 132:
        case 133:
        case 141:
        case 142:
        case 143:
        case 144:
        case 145:
        case 149:
        case 150:
        case 162:
            $query = "SELECT a.FullName, a.FirstName, a.LastName, a.BINumber, a.BISerie, a.BIStartDate, a.BIEmitent, a.CNP, a.Sex, c.Division, d.Function, d.COR, e.CompanyName, e.CIF, e.RegComert, e.CompanyEmail, f.*, 
		g.CityName, h.DistrictName, b.ContractNo, b.WorkNorm, b.WorkStartHour, b.LunchBreakStartHour, b.LunchBreakEndHour,
		                b.ContractDismissalPeriod, b.ContractProbationPeriod, b.ResignationDemandNo, b.HealthCompanyID, b.StopDate, b.ResignationDemandNo, b.Law, 
	    			DATE_FORMAT(b.ContractDate, '%d.%m.%Y') AS ContractDate, DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS WorkStartDate, DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS WorkStopDate, DATE_FORMAT(b.ContractExpDate, '%d.%m.%Y') as ContractExpDate, i.PhoneNumberA, i.FaxNumber,
	    			b.StartDate AS fStartDate, b.StopDate AS fStopDate, b.ContractDismissalPeriod, b.ContractProbationPeriod,
	    			j.FullName AS LegalFullName, j.BINumber as LegalBINumber, j.BISerie as LegalBISerie, j.BIEmitent as LegalBIEmitent, j.BiStartDate as LegatBIStartDate , j.Sex as LegalSex, t.FullName as HRFullName, n.DistrictID as DistrictID, k.DistrictName AS RegComertDistrict, b.ContractType as ContractType,
					l.StreetName as PersonStreetName, l.StreetCode as PersonStreetCode, l.StreetNumber as PersonStreetNumber, l.Bl as PersonBl, l.Sc as PersonSc, l.Et as PersonEt, l.Ap as PersonAp, 
	    			m.CityName AS PersonCity,n.DistrictName AS PersonDistrict, r.Department, s.Salary AS BrutSalary, TIMESTAMPDIFF(MONTH, b.StartDate, b.ContractExpDate) as Months,
	    			(SELECT TotalCORef FROM vacations WHERE Year=YEAR(b.StartDate) AND a.PersonID=PersonID ORDER BY VacationID DESC LIMIT 1) AS ContractVacationDays
	    			" . ($_GET['rep'] == 82 ? ", (SELECT SUM(TotalCost) FROM persons_beneficii WHERE PersonID = a.PersonID AND Type = 4 AND CURRENT_DATE BETWEEN RegDate AND (CASE WHEN EndDate != '0000-00-00' THEN EndDate ELSE '2100-01-01' END)) AS VBonuriMasa" : "") .
                ($_GET['rep'] == 81 ? ", (SELECT TotalCO FROM vacations WHERE PersonID=a.PersonID AND Year=YEAR(CURRENT_DATE)) AS TotalCO, 
	    			                             (SELECT SUM(DaysNo) FROM vacations_details WHERE PersonID=a.PersonID AND Year=YEAR(CURRENT_DATE) AND Type = 'CO' AND Aprove = 1) AS UsedCO" : "") . "
	              FROM   persons a
                             INNER JOIN payroll b ON a.PersonID = b.PersonID
                             LEFT JOIN divisions c ON b.DivisionID = c.DivisionID
                             LEFT JOIN functions d ON b.FunctionID = d.FunctionID
                             INNER JOIN companies e ON b.CompanyID = e.CompanyID              
                             LEFT JOIN address f ON e.AddressID=f.AddressID AND f.AddressType=1
                             LEFT JOIN address_city g ON f.CityID=g.CityID
                             LEFT JOIN address_district h ON g.DistrictID=h.DistrictID
                             LEFT JOIN companies_locations i ON f.AddressID=i.AddressID
                             LEFT JOIN persons j ON e.LegalPersonID=j.PersonID
                             LEFT JOIN address_district k ON e.RegComertDistrictID=k.DistrictID
                             LEFT JOIN address l ON a.AddressID=l.AddressID
                             LEFT JOIN address_city m ON l.CityID=m.CityID
                             LEFT JOIN address_district n ON m.DistrictID=n.DistrictID
                             LEFT JOIN internal_functions_companies o ON e.CompanyID=o.CompanyID AND b.InternalFunction=o.FunctionID
                             LEFT JOIN internal_functions p ON p.FunctionID=b.FunctionID
                             LEFT JOIN departments r ON b.DepartmentID=r.DepartmentID
                             LEFT JOIN persons_salary s ON s.PersonID=a.PersonID
                             LEFT JOIN persons t ON e.HRPersonID=t.PersonID

                      WHERE  a.PersonID = '{$_GET['PersonID']}' AND (a.UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)";

            $conn->query($query);
            $info = $conn->fetch_array();

            if (!file_exists(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg')) {
                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/logo/' . $info['CompanyID'] . '.jpg', 350, 500);
                @rename('photos/_tmp/' . basename($resized), 'photos/logo/' . basename($resized));
                $info['CompanyPhoto'] = Config::SRV_URL . 'photos/_tmp/company_' . basename($resized);
            }
            // Get address
            $CompanyAddress = '';
            if ($info['StreetName']) $CompanyAddress .= 'Strada ' . $info['StreetName'];
            if ($info['StreetNumber']) $CompanyAddress .= ', Numarul ' . $info['StreetNumber'];
            if ($info['Bl']) $CompanyAddress .= ', Bl. ' . $info['Bl'];
            if ($info['Sc']) $CompanyAddress .= ', Sc. ' . $info['Sc'];
            if ($info['Et']) $CompanyAddress .= ', Et. ' . $info['Et'];
            if ($info['Ap']) $CompanyAddress .= ', Ap. ' . $info['Ap'];
            if ($info['DistrictName'] == 'Bucuresti') {
                if (stristr($info['CityName'], 'bucuresti') !== FALSE) {
                    $info['CityName'] = str_ireplace('bucuresti,', '', $info['CityName']);
                    $info['CityName'] = str_ireplace('bucuresti', '', $info['CityName']);
                }
            }
            //if ($info['CityName']) $CompanyAddress.=', '.$info['CityName'];
            //if($info['DistrictName']) $CompanyAddress.=', '.$info['DistrictName'];
            if ($info['StreetCode']) $CompanyAddress .= ', Cod postal ' . $info['StreetCode'];
            $CompanyAddress = trim($CompanyAddress, ',');
            $info['CompanyAddress'] = $CompanyAddress;

            // Get person address
            $PersonAddress = '';
            if ($info['PersonDistrict'] == 'Bucuresti') {
                if (stristr($info['PersonCity'], 'bucuresti') !== FALSE) {
                    $PersonAddress .= 'localitatea ' . $info['PersonDistrict'];
                }
            } else {
                $PersonAddress .= 'localitatea ' . $info['PersonCity'];
            }
            if ($info['PersonStreetName']) $PersonAddress .= ', strada ' . $info['PersonStreetName'];
            if ($info['PersonStreetNumber']) $PersonAddress .= ', Numarul ' . $info['PersonStreetNumber'];
            if ($info['PersonBl']) $PersonAddress .= ', Bl. ' . $info['PersonBl'];
            if ($info['PersonSc']) $PersonAddress .= ', Sc. ' . $info['PersonSc'];
            if ($info['PersonEt']) $PersonAddress .= ', Et. ' . $info['PersonEt'];
            if ($info['PersonAp']) $PersonAddress .= ', Ap. ' . $info['PersonAp'];
            if ($info['PersonDistrict'] == 'Bucuresti') {
                if (stristr($info['PersonCity'], 'bucuresti') !== FALSE) {
                    $info['PersonCity'] = str_ireplace('bucuresti,', '', $info['PersonCity']);
                    $info['PersonCity'] = str_ireplace('bucuresti', '', $info['PersonCity']);
                    $PersonAddress .= ', ' . $info['PersonCity'];
                }
            }
            //if($info['PersonDistrict']) $PersonAddress.=', '.$info['PersonDistrict'];
            if ($info['PersonStreetCode']) $PersonAddress .= ', Cod postal ' . $info['PersonStreetCode'];
            $PersonAddress = trim($PersonAddress, ',');
            $info['PersonAddress'] = $PersonAddress;


            // Get Age in company
            $arr = Utils::dateDiff2YMD($row['fStartDate'], $row['fStopDate']);
            $info['FirmAge'] = $arr[0];
            //Utils::pa($info);
            switch ($_GET['rep']) {
                case 67:
                    if (!empty($info['WorkNorm']) && !empty($info['WorkStartHour'])) {
                        $date = new DateTime(date('Y-m-d ' . $info['WorkStartHour'] . ':00'));
                        $date->add(new DateInterval('PT' . ((int)$info['WorkNorm']) . 'H'));
                        $info['WorkInterval'] = $info['WorkStartHour'] . ' - ' . $date->format('H:i');
                    }
                    if (!empty($info['LunchBreakStartHour']) && !empty($info['LunchBreakEndHour'])) {
                        $date1 = new DateTime(date('Y-m-d ' . $info['LunchBreakStartHour'] . ':00'));
                        $date2 = new DateTime(date('Y-m-d ' . $info['LunchBreakEndHour'] . ':00'));
                        $interval = $date1->diff($date2);
                        $info['LunchBreakInterval'] = 60 * $interval->h + $interval->i;
                    }
                    break;
                case 81:
                    $conn->query("SELECT StartDate, StopDate
	    		              FROM   vacations_details 
	    		              WHERE  PersonID = '{$_GET['PersonID']}' AND Type = 'CM' AND Aprove = 1 AND
	    		                     StartDate >= DATE_SUB(CURRENT_DATE, INTERVAL 12 MONTH)");
                    while ($row = $conn->fetch_array()) {
                        $CurrDate = $row['StartDate'];
                        while ($CurrDate <= $row['StopDate']) {
                            @$info['VacationCM'][substr($CurrDate, 0, 4)][substr($CurrDate, 5, 2)]++;
                            $CurrDate = date('Y-m-d', mktime(0, 0, 0, (int)substr($CurrDate, 5, 2), (int)substr($CurrDate, 8, 2) + 1, substr($CurrDate, 0, 4)));
                        }
                    }
                    $conn->query("SELECT SUM(DaysNo) AS CFSDaysNo FROM vacations_details WHERE PersonID = '{$_GET['PersonID']}' AND Type = 'CFS' AND Aprove = 1 AND Year = YEAR(CURRENT_DATE)");
                    if ($row = $conn->fetch_array()) {
                        $info['CFSDaysNo'] = $row['CFSDaysNo'];
                    }
                    $conn->query("SELECT SUM(HoursNo) AS THoursNo FROM vacations_details WHERE PersonID = '{$_GET['PersonID']}' AND Type = 'INV' AND Aprove = 1 AND Year = YEAR(CURRENT_DATE)");
                    if ($row = $conn->fetch_array()) {
                        $info['CFSDaysNo'] += ceil($row['THoursNo'] / (!empty($info['WorkNorm']) ? $info['WorkNorm'] : 8));
                    }
                    break;
                case 131:
                    $conn->query("SELECT StartDate, StopDate FROM persons_actead WHERE PersonID = '{$_GET['PersonID']}' ORDER BY StartDate DESC LIMIT 1");
                    if ($row = $conn->fetch_array()) {
                        $info['ActeAd'] = $row;
                    }
                    break;
                case 132:
                    $conn->query("SELECT StartDate FROM persons_contracts WHERE PersonID = '{$_GET['PersonID']}' AND ContractType = 2 ORDER BY StartDate DESC LIMIT 1");
                    if ($row = $conn->fetch_array()) {
                        $info['Contract'] = $row;
                    }
                    break;
                case 145:
                    $conn->query("SELECT Salary, StartDate FROM persons_salary WHERE PersonID = '{$_GET['PersonID']}' ORDER BY StartDate DESC LIMIT 2");
                    while ($row = $conn->fetch_array()) {
                        $info['Salary'][] = $row;
                    }
                    break;
                case 162:
                    $info['CM'][0] = 0;
                    $conn->query("SELECT CodInd, DaysNo FROM vacations_details WHERE PersonID = '{$_GET['PersonID']}' AND Type = 'CM' AND Aprove = 1 AND StartDate >= DATE_SUB(CURRENT_DATE, INTERVAL 12 MONTH)");
                    while ($row = $conn->fetch_array()) {
                        $info['CM'][] = $row;
                        $info['CM'][0] += $row['DaysNo'];
                    }
                    $conn->query("SELECT Nume FROM persons_intretinere WHERE PersonID = '{$_GET['PersonID']}' AND Active = 1");
                    while ($row = $conn->fetch_array()) {
                        $info['Coasig'][] = stripslashes($row['Nume']);
                    }
                    if (is_array($info['Coasig'])) {
                        $info['Coasig'] = implode(',', $info['Coasig']);
                    }
                    break;
            }
            $smarty->assign('info', $info);
            switch ($_GET['rep']) {
                case 64:
                    $filename = "Adeverinta - Formare profesionala";
                    break;
                case 65:
                    $filename = "Adeverinta - Functie";
                    break;
                case 66:
                    $filename = "Adeverinta - Salariu";
                    break;
                case 67:
                    $filename = "Adeverinta - CIM";
                    break;
                case 68:
                    $filename = "Adeverinta - Decizie incetare cu acordul partilor";
                    break;
                case 69:
                    $filename = "Adeverinta - Decizie reintegrare";
                    break;
                case 70:
                    $filename = "Adeverinta - Decizie suspendare CIM";
                    break;
                case 71:
                    $filename = "Adeverinta - Notificare";
                    break;
                case 72:
                    $filename = "Proces verbal - Declaratie CASS";
                    break;
                case 73:
                    $filename = "Proces verbal - Cartela acces";
                    break;
                case 74:
                    $filename = "Proces verbal - Predare echipament";
                    break;
                case 75:
                    $filename = "Proces verbal - Predare vestiar";
                    break;
                case 76:
                    $filename = "Proces verbal - Reguli concurentiale";
                    break;
                case 77:
                    $filename = "Proces verbal - ROI";
                    break;
                case 78:
                    $filename = "Proces verbal - SSM si PSI";
                    break;
                case 84:
                    $filename = "Contract - CIM (II)";
                    break;
                case 131:
                    $filename = "Contract - Act aditional CIM";
                    break;
                case 132:
                    $filename = "Contract - Act aditional CIM prelungire nedeterminata";
                    break;
                case 133:
                    $filename = "Contract - Act aditional zile CO";
                    break;
            }

            break;
    }

    if (!empty($_GET['export'])) {
        header("Content-Type: application/vnd.ms-word");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename={$filename}_" . str_replace(' ', '_', $info['FullName']) . ".doc");
        echo $smarty->fetch('report_' . $_GET['rep'] . '.tpl');
        exit;
    } elseif (!empty($_GET['print'])) {
        $smarty->display('report_' . $_GET['rep'] . '.tpl');
        exit;
    }
}

$smarty->assign(array(
    'self' => Company::getSelfCompanies(),
    'divisions' => $_SESSION['USER_ID'] == 1 ? Utils::getDivisions() : array(),
    'persons' => $persons,
    'health_companies' => ConfigData::$msHealthCompanies,
    'rep_adv' => 1,
    'base_url' => Config::SRV_URL,
));

$report_file = 'report_' . $_GET['rep'] . '.tpl';

?>
