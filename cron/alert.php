<?php

set_time_limit(0);
ini_set("display_errors", "1");

//error_reporting(E_ALL ^ E_NOTICE ^ E_WARNING ^ E_DEPRECATED);
function __autoload($className) {
    include('../libs/' . $className . '.php');
}

include('../libs/DB.class.php');
include('../libs/sendMail.php');
include('../libs/ConfigData.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);

$alerts = array();

//$query = "SELECT * FROM alert WHERE Active = 1 AND AlertDate BETWEEN DATE_SUB(CURRENT_TIMESTAMP, INTERVAL 1 Hour) AND CURRENT_TIMESTAMP";
$query = "SELECT * FROM alert WHERE Active = 1";
//$query = "SELECT * FROM alert WHERE Active = 1 AND AlertDate = '2012-09-04 08:00:00'";
$conn->query($query);
while ($row = $conn->fetch_array()) {
    $row['Subject'] = stripslashes($row['Subject']);
    $row['Body'] = stripslashes($row['Body']);
    $row['FromAlias'] = stripslashes($row['FromAlias']);
    if (!empty($row['Settings'])) {
        $row['Settings'] = unserialize($row['Settings']);
    }
    if (!empty($row['ToAuxEmails'])) {
        $row['ToAuxEmails'] = explode(';', $row['ToAuxEmails']);
    }
    $alerts[$row['ID']] = $row;
}

foreach ($alerts as $ID => $alert) {
    switch ($ID) {
        case 1:

            $delta = date('w') == 1 ? 3 : 1;
            $yesterday = date('Y-m-d', mktime(0, 0, 0, date('m'), date('d') - $delta, date('Y')));
            $yesterdayf = date('d.m.Y', mktime(0, 0, 0, date('m'), date('d') - $delta, date('Y')));
            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, CASE WHEN b.THours > 0 THEN b.THours ELSE 0 END AS THours
        	      FROM   persons a
                	     LEFT JOIN (
                			    SELECT PersonID, SUM(Hours) AS THours
                			    FROM   pontaj
                			    WHERE  Data = '$yesterday'
                			    GROUP  BY PersonID
                			    HAVING SUM(Hours) < {$alert['Settings']['hours']}
                	                ) b ON a.PersonID = b.PersonID
			    LEFT JOIN vacations_details c ON a.PersonID = c.PersonID AND c.Aprove >= 0
                      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND a.Email > '' " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "") . " AND
                            a.RoleID IN (
                        		    SELECT RoleID
                        		    FROM   pontaj_activity_roles
                        		    WHERE  ActivityID IN (
                        					    SELECT ActivityID
                        					    FROM   pontaj_project_activities
                        					    WHERE  Active = 1 AND ProjectID IN (
                        										    SELECT ProjectID
                        										    FROM   pontaj_projects
                        										    WHERE  Phase != 4
                        										)
                        					)
                        		) AND
			    CASE WHEN b.THours > 0 THEN b.THours ELSE 0 END < {$alert['Settings']['hours']} AND
			    CASE WHEN CURRENT_DATE BETWEEN c.StartDate AND c.StopDate THEN 0 ELSE 1 END = 1";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $subject = str_replace('<<yesterday>>', $yesterdayf, $alert['Subject']);
                //$headers = "From: \"{$alert['FromAlias']}\" <{$alert['FromEmail']}>";
                foreach ($emails as $info) {
                    $to = "\"{$info['FullName']}\" <{$info['Email']}>";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<yesterday>>', '<<THours>>'), array($info['FullName'], $yesterdayf, $info['THours']), $alert['Body']));
                    //mail($to, $subject, $message, $headers); // Simple alternative
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                    }

                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta pontaj | S-au trimis " . count($emails) . " mail-uri !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta pontaj | Nu s-a trimis mail !");
            }

            break;

        case 2:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.CertifName, b.StopDate
        	      FROM   persons a
		             INNER JOIN persons_certif b ON a.PersonID = b.PersonID AND 
					 ((b.StopDate >= CURRENT_DATE AND (DATE_SUB(b.StopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
							OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
							AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.StopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))  
							AND DATEDIFF(b.StopDate, CURRENT_DATE) <={$alert['Settings']['days']})
						)
					  OR (b.StopDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.StopDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND " . (!empty($alert['Settings']['roles']) ? "a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "1=1");

            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }

            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira";
                    if (Utils::getDaysDiff($info['StopDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<CertifName>>', '<<StopDate>>', '<<CertifText>>'), array($info['FullName'], $info['CertifName'], $info['StopDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta certificate | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta certificate | Nu s-a trimis mail !");
            }

            break;

        case 4:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.ContractNo, b.ContractDate, b.ContractExpDate
        	      FROM   persons a
		             INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.ContractType = 1 AND b.ContractExpDate >= CURRENT_DATE AND
		              (((DATE_SUB(b.ContractExpDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE  
							OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
							AND {$alert['Settings']['int_rec']} > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.ContractExpDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))  
							AND DATEDIFF(b.ContractExpDate, CURRENT_DATE) <={$alert['Settings']['days']} )
						)
						OR (b.ContractExpDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.ContractExpDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )
		      WHERE  a.Status != 9 " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira";
                    if (Utils::getDaysDiff($info['ContractExpDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<ContractNo>>', '<<ContractDate>>', '<<ContractExpDate>>', '<<ContractText>>'), array($info['FullName'], $info['ContractNo'], $info['ContractDate'], $info['ContractExpDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta contracte de munca | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta contracte de munca | Nu s-a trimis mail !");
            }

            break;

        case 7:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.FirstName, a.Email 
	              FROM   persons a
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND DATE_FORMAT(a.DateOfBirth, '%d-%m') = DATE_FORMAT(CURRENT_DATE, '%d-%m') " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $row['FirstName'] = stripslashes($row['FirstName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $message = nl2br(str_replace(array('<<FullName>>', '<<FirstName>>'), array($info['FullName'], $info['FirstName']), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta zile de nastere | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta zile de nastere | Nu s-a trimis mail !");
            }

            break;

        case 9:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.Notes,
	                     DATE_FORMAT(b.RegDate, '%d.%m.%Y') AS RegDate,
			     DATE_FORMAT(b.EndDate, '%d.%m.%Y') AS EndDate
	              FROM   persons a
		             INNER JOIN persons_beneficii b ON a.PersonID = b.PersonID AND b.Type = 1 
					 AND ((b.EndDate >= CURRENT_DATE AND 
							(DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
							OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
							AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.EndDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
							AND DATEDIFF(b.EndDate, CURRENT_DATE) <={$alert['Settings']['days']} )
						  )
						  OR (b.EndDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
							)
						 )
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND " . (!empty($alert['Settings']['roles']) ? "a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "1=1");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "va expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<RegDate>>', '<<EndDate>>', '<<Notes>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $info['Notes'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare asigurare de sanatate | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare asigurare de sanatate | Nu s-a trimis mail !");
            }

            break;

        case 10:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.Notes,
	                     DATE_FORMAT(b.RegDate, '%d.%m.%Y') AS RegDate,
			     DATE_FORMAT(b.EndDate, '%d.%m.%Y') AS EndDate
	              FROM   persons a
		             INNER JOIN persons_beneficii b ON a.PersonID = b.PersonID AND b.Type = 3 AND 
					 ((b.EndDate >= CURRENT_DATE 
						AND (DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
						OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
						AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.EndDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
						AND DATEDIFF(b.EndDate, CURRENT_DATE) <={$alert['Settings']['days']} )
					  )
					  OR (b.EndDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND " . (!empty($alert['Settings']['roles']) ? "a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "1=1");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<RegDate>>', '<<EndDate>>', '<<Notes>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $info['Notes'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare pensie privata | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare pensie privata | Nu s-a trimis mail !");
            }

            break;

        case 11:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, a.DrivingNo, a.DrivingSerie,
	                     DATE_FORMAT(a.DrivingStartDate, '%d.%m.%Y') AS DrivingStartDate,
			     DATE_FORMAT(a.DrivingStopDate, '%d.%m.%Y') AS DrivingStopDate
	              FROM   persons a
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) 
			  AND ((a.DrivingStopDate >= CURRENT_DATE AND (DATE_SUB(a.DrivingStopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
						OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
						AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(a.DrivingStopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
						AND DATEDIFF(a.DrivingStopDate, CURRENT_DATE) <={$alert['Settings']['days']} )
					)
					OR (a.DrivingStopDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(a.DrivingStopDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )" .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['DrivingStopDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<DrivingNo>>', '<<DrivingSerie>>', '<<DrivingStartDate>>', '<<DrivingStopDate>>', '<<TxtAlert>>'), array($info['FullName'], $info['DrivingNo'], $info['DrivingSerie'], $info['DrivingStartDate'], $info['DrivingStopDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare permis auto | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare permis auto | Nu s-a trimis mail !");
            }

            break;

        case 12:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, a.BINumber, a.BISerie,
	                     DATE_FORMAT(a.BIStartDate, '%d.%m.%Y') AS BIStartDate,
			     DATE_FORMAT(a.BIStopDate, '%d.%m.%Y') AS BIStopDate
	              FROM   persons a
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) 
			  AND 
				((a.BIStopDate >= CURRENT_DATE 
					AND (DATE_SUB(a.BIStopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
					OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
					AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(a.BIStopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
					AND DATEDIFF(a.BIStopDate, CURRENT_DATE) <={$alert['Settings']['days']} )
				 )
				 OR (a.BIStopDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(a.BIStopDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
					)
				) " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['BIStopDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<BINumber>>', '<<BISerie>>', '<<BIStartDate>>', '<<BIStopDate>>', '<<BITxt>>'), array($info['FullName'], $info['BINumber'], $info['BISerie'], $info['BIStartDate'], $info['BIStopDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare CI | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare CI | Nu s-a trimis mail !");
            }

            break;

        case 13:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.Notes,
	                     DATE_FORMAT(b.RegDate, '%d.%m.%Y') AS RegDate,
			     DATE_FORMAT(b.EndDate, '%d.%m.%Y') AS EndDate
	              FROM   persons a
		             INNER JOIN persons_medical b ON a.PersonID = b.PersonID AND b.Type = 3 
					 AND 
					 (SELECT MedicalID FROM persons_medical WHERE Type = 3 AND PersonID = b.PersonID ORDER BY EndDate DESC LIMIT 1) = b.MedicalID
					 AND 					 
					 ((b.EndDate >= CURRENT_DATE AND (DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
							OR ('{$alert['Settings']['is_rec']}' = 1 
							AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
							AND '{$alert['Settings']['int_rec']}' > 0 
							AND (({$alert['Settings']['days']} - DATEDIFF(b.EndDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
							AND DATEDIFF(b.EndDate, CURRENT_DATE) <={$alert['Settings']['days']})
					  )
					  OR (b.EndDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND " . (!empty($alert['Settings']['roles']) ? "a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "1=1");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<RegDate>>', '<<EndDate>>', '<<Notes>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $info['Notes'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta protectia muncii | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta protectia muncii | Nu s-a trimis mail !");
            }

            break;

        case 14:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.ContractNo, b.ContractDate, b.ContractExpDate
        	      FROM   persons a
		             INNER JOIN payroll b ON a.PersonID = b.PersonID AND b.ContractType = 1 
					 AND 
						((b.ContractExpDate >= CURRENT_DATE 
		                   AND (DATE_SUB(b.ContractExpDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
						   OR ('{$alert['Settings']['is_rec']}' = 1 AND 
						   {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
						   AND '{$alert['Settings']['int_rec']}' > 0 
						   AND (({$alert['Settings']['days']} - DATEDIFF(b.ContractExpDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))  
						   AND DATEDIFF(b.ContractExpDate, CURRENT_DATE) <={$alert['Settings']['days']})
						)
						 OR (b.ContractExpDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(b.ContractExpDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						   )
					    )
		      WHERE  a.Status = 9 " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira";
                    if (Utils::getDaysDiff($info['ContractExpDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<ContractNo>>', '<<ContractDate>>', '<<ContractExpDate>>', '<<ContractTxt>>'), array($info['FullName'], $info['ContractNo'], $info['ContractDate'], $info['ContractExpDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare contract angajat temporar | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare contract Angajat temporar | Nu s-a trimis mail !");
            }

            break;

        case 17:

            $emails = array();
            $query = "SELECT a.Brand, a.Model, a.RegNo,
	                     DATE_FORMAT(h.StartDate, '%d.%m.%Y') AS StartDate,
			     DATE_FORMAT(h.StopDate, '%d.%m.%Y') AS StopDate,
			     d.Email, d.PersonID, e.CompanyName, g.CostType as Type
	              FROM   cars a
			     INNER JOIN cars_cost b ON a.CarID = b.CarID 
                             INNER JOIN cars_cost_details h ON h.CostID = b.ID 
							 AND 
								((h.StopDate >= CURRENT_DATE AND (DATE_SUB(h.StopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
								OR ('{$alert['Settings']['is_rec']}' = 1 
								AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
								AND '{$alert['Settings']['int_rec']}' > 0 
								AND (({$alert['Settings']['days']} - DATEDIFF(h.StopDate, CURRENT_DATE)) > 0) 
								AND (({$alert['Settings']['days']} - DATEDIFF(h.StopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))  
								AND DATEDIFF(h.StopDate, CURRENT_DATE) <={$alert['Settings']['days']})
								)
								OR (h.StopDate <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
									AND (DATEDIFF(CURRENT_DATE, DATE_SUB(h.StopDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
								   )
							    )
			     INNER JOIN cars_dictionary f ON h.CostTypeID_Dictionary = f.ID
                             INNER JOIN cars_costtype g ON g.CostTypeID = f.CostTypeID AND g.CostGroup = 1
			     LEFT JOIN companies e ON b.CompanyID = e.CompanyID
			     LEFT JOIN cars_resp c ON a.CarID = c.CarID
			     LEFT JOIN persons d ON c.PersonID = d.PersonID AND d.Status NOT IN (6, 5, 11, 10, 3, 1) " . (!empty($alert['Settings']['roles']) ? " AND d.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['CompanyName'] = !empty($row['CompanyName']) ? stripslashes($row['CompanyName']) : '-';
                $emails[] = $row;
            }

            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['StopDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<Brand>>', '<<Model>>', '<<RegNo>>', '<<StartDate>>', '<<StopDate>>', '<<CompanyName>>', '<<Type>>', '<<TxtAlert>>'), array(ConfigData::$msBrands[$info['Brand']], $info['Model'], $info['RegNo'], $info['StartDate'], $info['StopDate'], $info['CompanyName'], $info['Type'], $txtAlert), $alert['Body']));
                    $subject = nl2br(str_replace(array('<<Brand>>', '<<Model>>', '<<RegNo>>', '<<StartDate>>', '<<StopDate>>', '<<CompanyName>>', '<<Type>>'), array(ConfigData::$msBrands[$info['Brand']], $info['Model'], $info['RegNo'], $info['StartDate'], $info['StopDate'], $info['CompanyName'], $info['Type']), $subject));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare asigurare | S-au trimis {$emailno} mail-uri din " . count($emails) . " gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare asigurare | Nu s-a trimis mail !");
            }

            break;

        case 18:

            $emails = array();
            $query = "SELECT a.CarID, MAX(a.Km) AS Km, c.PersonID, c.FullName, c.Email, d.Brand, d.Model, d.RegNo FROM cars_cost a
                            LEFT JOIN cars_resp b ON b.CarID = a.CarID AND 
							((CURRENT_DATE BETWEEN b.StartDate AND b.StopDate OR (CURRENT_DATE > b.StartDate AND (b.StopDate = '0000-00-00' OR b.StopDate IS NULL))))
                            LEFT JOIN persons c ON c.PersonID = b.PersonID
                            LEFT JOIN cars d ON d.CarID = a.CarID
                             GROUP BY a.CarID";

            $conn->query($query);
            $cars = array();
            while ($row = $conn->fetch_array()) {
                $cars[$row['CarID']] = $row;
            }

            $query = "SELECT a.CarID, MAX(a.Date) AS Date, a.CheckupID, b.Km FROM cars_cost a INNER JOIN cars_checkups b ON b.ID = a.CheckupID WHERE a.Checkup = 1 GROUP BY a.CarID";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $cars[$row['CarID']]['LastCheckupDate'] = $row['Date'];
                $cars[$row['CarID']]['LastCheckupID'] = $row['CheckupID'];
                $cars[$row['CarID']]['LastCheckupKm'] = $row['Km'];
            }
            if (!empty($cars)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($cars as $CarID => $info) {
                    $conn->query("SELECT * FROM cars_checkups WHERE CarID = '{$CarID}' AND Km > '{$info['LastCheckupKm']}' ORDER BY Km LIMIT 1");
                    $upcomingc = $conn->fetch_array();
                    if (!empty($upcomingc['Km'])) {
                        $conn->query("SELECT DATE_ADD('{$info['LastCheckupDate']}',INTERVAL '{$upcomingc['MInt']}' MONTH) AS Date FROM dual");
                        if ($row = $conn->fetch_array()) {
                            $upcomingc['Date'] = $row['Date'];
                        }
                        $send = false;
                        if (!empty($upcomingc['Date'])) {
                            $diff = Utils::getDaysDiff(date('Y-m-d'), $upcomingc['Date'], false, false);
                        }

                        if (!empty($alert['Settings']['km']) && ($upcomingc['Km'] - $info['Km']) <= $alert['Settings']['km']) {
                            $send = true;
                        } elseif (isset($alert['Settings']['days']) && isset($diff) && $diff == $alert['Settings']['days']) {
                            $send = true;
                        } elseif (isset($alert['Settings']['days']) && isset($diff) && !empty($alert['Settings']['is_rec']) && !empty($alert['Settings']['int_rec']) && $diff < $alert['Settings']['days'] && $diff % $alert['Settings']['int_rec'] == 0) {
                            $send = true;
                        }

                        if ($send) {
                            $message = nl2br(str_replace(array('<<Brand>>', '<<Model>>', '<<RegNo>>', '<<LastCheckupDate>>', '<<NextCheckupDate>>', '<<NextCheckupKm>>'), array(ConfigData::$msBrands[$info['Brand']], $info['Model'], $info['RegNo'], $info['LastCheckupDate'], $info['NextCheckupDate'], $info['NextCheckupKm']), $alert['Body']));
                            if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                                Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                                sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                                $emailno++;
                            }
                            foreach ((array) $alert['ToAuxEmails'] as $to) {
                                Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                                sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                            }
                        }
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta revizie | S-au trimis {$emailno} mail-uri !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta revizie | Nu s-a trimis mail !");
            }

            break;

        case 19:

            $emails = array();
            $query = "SELECT a.Brand, a.Model, a.RegNo,
	                     DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
			     DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS StopDate,
		          d.PersonID, d.Email
	              FROM   cars a
			     INNER JOIN cars_cost b ON a.CarID = b.CarID AND b.StopDate >= CURRENT_DATE AND (DATE_SUB(b.StopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.StopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))  AND DATEDIFF(b.StopDate, CURRENT_DATE) <={$alert['Settings']['days']})
			     INNER JOIN cars_dictionary f ON b.CostTypeID = f.ID AND f.CostTypeID = 3 
			     LEFT JOIN cars_resp c ON a.CarID = c.CarID
			     LEFT JOIN persons d ON c.PersonID = d.PersonID" . (!empty($alert['Settings']['roles']) ? " AND d.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $message = nl2br(str_replace(array('<<Brand>>', '<<Model>>', '<<RegNo>>', '<<StartDate>>', '<<StopDate>>'), array(ConfigData::$msBrands[$info['Brand']], $info['Model'], $info['RegNo'], $info['StartDate'], $info['StopDate']), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare rovigneta | S-au trimis {$emailno} mail-uri din " . count($emails) . " gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare rovigneta | Nu s-a trimis mail !");
            }

            break;

        case 21:

            if (empty($alert['Settings']['status'])) {
                return;
            }
            $query = "SELECT AssignedPersonID, TicketID, ticketing.Status 
	              FROM   ticketing 
				  INNER JOIN   persons ON persons.PersonID = ticketing.AssignedPersonID AND persons.Status NOT IN (6, 5, 11, 10, 3, 1)  
		      WHERE  ticketing.Status IN (" . implode(',', array_keys($alert['Settings']['status'])) . ")
		      ORDER  BY TicketID";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $tickets[$row['AssignedPersonID']][$row['TicketID']] = $row['TicketID'] . ' - ' . ConfigData::$msTicketingStatus[$row['Status']];
            }
            if (!empty($tickets)) {//$tickets e un array de arrayuri cu cheie userID
                $emailno = 0;
                $query = "SELECT PersonID, Email, FullName FROM persons WHERE PersonID IN (" . implode(',', array_keys($tickets)) . ") AND Email <> ''";
                $conn->query($query);
                while ($row = $conn->fetch_array()) {
                    $message = "";
                    foreach ($tickets[$row['PersonID']] as $TicketID => $TicketInfo) {// construieste corpul
                        $message.= "{$TicketInfo}\n" . Config::SRV_URL . "?m=ticketing&o=edit&TicketID={$TicketID}\n\n";
                    }
                    if (!empty($alert['ToSelf']) && !empty($row['Email'])) {
                        Alert::logAlert($ID, $row['PersonID'], 0, $row['Email'], $alert['Subject'], $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $row['FullName'], $row['Email'], $alert['Subject'], nl2br($message));
                        $array[] = $row['Email'];
                    }
                    if (!empty($alert['ToAuxEmails'])) {
                        foreach ((array) $alert['ToAuxEmails'] as $to) {
                            Alert::logAlert($ID, 0, 0, $to, $alert['Subject'], $message);
                            sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $alert['Subject'], nl2br($message));
                        }
                    }
                    $emailno++;
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta tichete | S-au trimis {$emailno} mail-uri din " . count($tickets) . " gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta tichete | Nu s-a trimis mail !");
            }

            break;
        // alerta analize medicale
        case 30:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.Notes,
	                     DATE_FORMAT(b.RegDate, '%d.%m.%Y') AS RegDate,
			     DATE_FORMAT(b.EndDate, '%d.%m.%Y') AS EndDate
	              FROM   persons a
		             INNER JOIN persons_medical b ON a.PersonID = b.PersonID AND b.Type = 2 
					 AND 
					 (SELECT MedicalID FROM persons_medical WHERE Type = 2 AND PersonID = b.PersonID ORDER BY EndDate DESC LIMIT 1) = b.MedicalID
					 AND 
					 ((b.EndDate >= CURRENT_DATE AND (DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
							".(isset($alert['Settings']['is_rec']) ? " OR (
								{$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}'
								AND '{$alert['Settings']['int_rec']}' > 0
								AND (({$alert['Settings']['days']} - DATEDIFF(b.EndDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)
							)" : "")."
							AND DATEDIFF(b.EndDate, CURRENT_DATE) <={$alert['Settings']['days']})
					  )
					  OR (b.EndDate <= CURRENT_DATE
					  ".(isset($alert['Settings']['is_rec']) ? " AND (
								'{$alert['Settings']['int_rec']}' > 0
								AND (
										DATEDIFF(CURRENT_DATE, DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0
									)
							)" : "")."
						)
					 )
					 AND b.EndDate != '0000-00-00'
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1)";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<RegDate>>', '<<EndDate>>', '<<Notes>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $info['Notes'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        $EmailedPersonID = Person::getPersonID($info['Email']);
                        Alert::logAlert($ID, $info['PersonID'], $EmailedPersonID, 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        $EmailedPersonID = Person::getPersonID($to);
                        Alert::logAlert($ID, 0,$EmailedPersonID, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                    if(!empty($alert['Settings']['roles']))
                    {
                        $queryGetRoles = "SELECT * FROM persons WHERE RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ") AND Status NOT IN (6, 5, 11, 10, 3, 1)";
                        //print_r($queryGetRoles);
                        $conn->query($queryGetRoles);
                        while ($rowRoles = $conn->fetch_array()) {
                            if(!empty($rowRoles['Email'])) {
                                $EmailedPersonID = Person::getPersonID($rowRoles['Email']);
                                //print_r($rowRoles['Email']); echo "<br/>";
                                Alert::logAlert($ID, 0,$EmailedPersonID, 0, $rowRoles['Email'], $subject, $message);
                                sendMail($alert['FromAlias'], $alert['FromEmail'], '', $rowRoles['Email'], $subject, $message);
                            }
                        }
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta protectia muncii | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta protectia muncii | Nu s-a trimis mail !");
            }

            break;

        case 31:
            $query = "SELECT a.PersonID, a.FullName, a.Email, DATE_ADD(b.StartDate,INTERVAL b.ContractProbationPeriod DAY) as ExpDate FROM payroll b
                        JOIN persons a ON a.PersonID = b.PersonID
                            WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND a.RoleID IN('" . implode("','", array_keys($alert['Settings']['roles'])) . "') AND (";
            $recurrent = 0;
            if (!empty($alert['Settings']['int_rec'])) {
                $recurrent = floor($alert['Settings']['days'] / $alert['Settings']['int_rec']);
            }

            for ($i = 0; $i <= $recurrent; $i++) {
                $query .= ($i > 0 ? " OR " : "") . " DATE_ADD(b.StartDate,INTERVAL b.ContractProbationPeriod" . (!empty($alert['Settings']['days']) ? "-" . ($alert['Settings']['days'] - ($i * $alert['Settings']['int_rec'])) : "") . " DAY) = DATE_FORMAT(NOW(), '%Y-%m-%d')";
            }

            $query .= ")";

            $conn->query($query);

            while ($row = $conn->fetch_array()) {
                $message = nl2br(str_replace(array('<<FullName>>', '<<ExpDate>>'), array($row['FullName'], Utils::toDisplayDate($row['ExpDate'])), $alert['Body']));
                if (!empty($alert['ToSelf']) && !empty($row['Email'])) {
                    Alert::logAlert($ID, $row['PersonID'], 0, $row['Email'], $alert['Subject'], $message);
                    sendMail($alert['$row'], $alert['FromEmail'], $row['FullName'], $row['Email'], $alert['Subject'], $message);
                }

                foreach ((array) $alert['ToAuxEmails'] as $to) {
                    Alert::logAlert($ID, 0, 0, $to, $alert['Subject'], $message);
                    sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $alert['Subject'], $message);
                }
            }

            break;

        case 32:
            $emails = array();
            $query = "SELECT a.Brand, a.Model, a.RegNo,
	                     DATE_FORMAT(b.StartDate, '%d.%m.%Y') AS StartDate,
			     DATE_FORMAT(b.StopDate, '%d.%m.%Y') AS StopDate,
			      d.PersonID, d.Email
	              FROM   cars a
		    	     INNER JOIN cars_cost b ON a.CarID = b.CarID AND b.StopDate >= CURRENT_DATE AND (DATE_SUB(b.StopDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(b.StopDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0))   AND DATEDIFF(b.StopDate, CURRENT_DATE) <={$alert['Settings']['days']})
			     INNER JOIN cars_dictionary f ON b.CostTypeID = f.ID AND f.CostTypeID = 4
			     LEFT JOIN cars_resp c ON a.CarID = c.CarID
			     LEFT JOIN persons d ON c.PersonID = d.PersonID" . (!empty($alert['Settings']['roles']) ? " AND d.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $message = nl2br(str_replace(array('<<Brand>>', '<<Model>>', '<<RegNo>>', '<<StartDate>>', '<<StopDate>>'), array(ConfigData::$msBrands[$info['Brand']], $info['Model'], $info['RegNo'], $info['StartDate'], $info['StopDate']), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare revizie | S-au trimis {$emailno} mail-uri din " . count($emails) . " gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare revizie | Nu s-a trimis mail !");
            }

            break;
        case 33:
            // Obtain affected persons - in vacation
            $query = "SELECT a.PersonID, a.FullName, a.Email, c.DepartmentID, d.Department, b.StartDate, b.StopDate, b.Type, CURDATE() AS Today
            			FROM persons a
                        INNER JOIN vacations_details b ON a.PersonID = b.PersonID
                        INNER JOIN payroll c ON a.PersonID=c.PersonID
                        LEFT JOIN departments d ON c.DepartmentID=d.DepartmentID
                            WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1) AND
                            ((b.Type='CO' AND b.Aprove=1) OR b.Type IN ('CFS','CE','CS','CM')) AND
                            b.StartDate<=CURDATE() AND b.StopDate>=CURDATE() AND
                            a.RoleID IN('".implode("','", array_keys($alert['Settings']['roles']))."')";
            $conn->query($query);
            $emailno = 0;
            $persons_vac_no = 0;
            $persons_dep = array();
            $persons_same_dep = array();
            while($row = $conn->fetch_array()){
                $persons_dep[$row['DepartmentID']][$row['PersonID']]=$row;
                $persons_vac_no++;
            }
            if(!empty($persons_dep))
                $cond_affected_deps = " AND b.DepartmentID IN (".implode(",",@array_keys($persons_dep)).")";
            // Get persons in the same departments with the affected persons
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.DepartmentID
            			FROM persons a
                        INNER JOIN payroll b ON a.PersonID=b.PersonID
                            WHERE
                            a.Status IN (2,7,9,12) AND
                            a.RoleID IN('".implode("','", array_keys($alert['Settings']['roles']))."')
                            $cond_affected_deps";
            $conn->query($query);
            while($row = $conn->fetch_array()){
                $persons_same_dep[$row['DepartmentID']][$row['PersonID']]=$row;
            }

            if(!empty($persons_dep)){
                //Loop through departments
                foreach($persons_same_dep as $DepartmentID=>$persons){
                    //Loop through persons in the same de departments
                    foreach($persons as $person){
                        //Loop through the persons in vacation
                        foreach($persons_dep[$DepartmentID] as $person_vacID=>$person_vac){
                            $message = nl2br(str_replace(array('<<FullName>>', '<<Today>>', '<<Department>>', '<<StartDate>>','<<StopDate>>', '<<Type>>'), array($person_vac['FullName'], Utils::toDisplayDate($person_vac['Today']), $person_vac['Department'], Utils::toDisplayDate($person_vac['StartDate']),Utils::toDisplayDate($person_vac['StopDate']),$person_vac['Type']), $alert['Body']));
                            $messages[$person_vacID] = $message;
                            if(!empty($person['Email'])){
                                if($person['Email']!=$person_vac['Email']){
                                    sendMail($alert['FromAlias'],$alert['FromEmail'],$person['FullName'],$person['Email'],$alert['Subject'],$message);
                                }
                                elseif(!empty($alert['ToSelf']) && $person['Email']==$person_vac['Email']){
                                    sendMail($alert['FromAlias'],$alert['FromEmail'],$person['FullName'],$person['Email'],$alert['Subject'],$message);
                                }
                            }
                            $emailno++;
                        }
                    }
                }
                // Send Aux Emails
                foreach ((array)$alert['ToAuxEmails'] as $to) {
                    foreach($messages as $message){
                        sendMail($alert['FromAlias'],$alert['FromEmail'],'',$to,$alert['Subject'],$message);
                        $emailno++;
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta persoane in concediu in departament | S-au trimis {$emailno} mail-uri pentru " . count($persons_vac_no) . " persoana gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta persoane in concediu in departament | Nu s-a trimis mail !");
            }

            break;

        case 34:

            $emails = array();
            $query = "SELECT a.ChildName, DATE_FORMAT(a.ChildBirthDate, '%d.%m.%Y') AS ChildBirthDate, b.FullName, b.Email
	              FROM   persons_children a
		    	     INNER JOIN persons b ON a.PersonID=b.PersonID AND a.ChildBirthDate >= CURRENT_DATE AND (DATE_SUB(a.ChildBirthDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE OR ('{$alert['Settings']['is_rec']}' = 1 AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' AND '{$alert['Settings']['int_rec']}' > 0 AND (({$alert['Settings']['days']} - DATEDIFF(a.ChildBirthDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)))
			     	 WHERE b.Status IN(2,7,9,12) " . (!empty($alert['Settings']['roles']) ? " AND b.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                foreach ($emails as $info) {
                    $message = nl2br(str_replace(array('<<ChildName>>', '<<ChildBirthDate>>', '<<FullName>>'), array($info['ChildName'], $info['ChildBirthDate'], $info['FullName']), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        sendMail($alert['FromAlias'],$alert['FromEmail'],$info['FullName'],$info['Email'],$alert['Subject'],$message);
                        $emailno++;
                    }
                    foreach ((array)$alert['ToAuxEmails'] as $to) {
                        sendMail($alert['FromAlias'],$alert['FromEmail'],'',$to,$alert['Subject'],$message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta zi nastere copii | S-au trimis {$emailno} mail-uri din " . count($emails) . " copii gasiti !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta expirare revizie | Nu s-a trimis mail !");
            }

            break;

        case 36:
            $persons = array();
            $emails = array();
            $companies = array();
            $departments = array();
            $directmanagers = array();
            $functionalmanagers = array();
            $list = '<table border="0" cellpadding="2" cellspacing="0">';
            $query = "SELECT a.PersonID, a.StartDate, a.StartHour, a.StopHour, a.HoursNo, b.FullName, b.Email, c.DepartmentID, c.CompanyID, c.DirectManagerID, c.FunctionalManagerID
                        FROM vacations_details a
                        LEFT JOIN persons b ON b.PersonID = a.PersonID
                        LEFT JOIN payroll c ON c.PersonID = b.PersonID
                        WHERE b.Status NOT IN (6, 5, 11, 10, 3, 1) AND a.Type = 'INV' AND a.StartDate = CURRENT_DATE";

            $conn->query($query);
            while($row = $conn->fetch_array()){
                $persons[$row['PersonID']] = $row;
                if (!empty($alert['ToSelf']) && !empty($row['Email'])) {
                    $emails[$row['Email']] = $row['FullName'];
                }
                $companies[] = $row['CompanyID'];
                $departments[] = $row['DepartmentID'];
                $directmanagers[] = $row['DirectManagerID'];
                $functionalmanagers[] = $row['FunctionalManagerID'];
                $list .= "<tr><td>".$row['FullName']."</td><td>".$row['StartHour']." - ".$row['StopHour']."</td></tr>";
            }
            $list .= "</table>";

            $query = "SELECT DISTINCT a.Email, a.FullName FROM persons a
                        INNER JOIN payroll b ON b.PersonID = a.PersonID
                        WHERE 1=0";

            if(!empty($alert['Settings']['md']) && !empty($directmanagers)){
                $query .= " OR a.PersonID IN (".implode(",", $directmanagers).")";
            }
            if(!empty($alert['Settings']['mf']) && !empty($functionalmanagers)){
                $query .= " OR a.PersonID IN (".implode(",", $functionalmanagers).")";
            }
            if(!empty($alert['Settings']['gsc'])){
                $query .= " OR a.Status IN (2,3,7,9,12)";
            }
            if(!empty($alert['Settings']['sc']) && !empty($companies)){
                $query .= " OR b.CompanyID IN (".implode(",", $companies).")";
            }
            if(!empty($alert['Settings']['dpt']) && !empty($departments)){
                $query .= " OR b.DepartmentID IN (".implode(",", $departments).")";
            }

            $query .= (!empty($alert['Settings']['roles']) ? " OR a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "");

            $conn->query($query);
            while($row = $conn->fetch_array()){
                if(!empty($row['Email'])){
                    $emails[$row['Email']] = $row['FullName'];
                }
            }

            if (!empty($emails) && !empty($persons)) {
                $emailno = 0;
                foreach ($emails as $email => $fullname) {
                    $message = nl2br(str_replace(array('<<List>>'), array($list), $alert['Body']));

                    sendMail($alert['FromAlias'],$alert['FromEmail'],$fullname,$email,$alert['Subject'],$message);
                    $emailno++;

                    foreach ((array)$alert['ToAuxEmails'] as $to) {
                        sendMail($alert['FromAlias'],$alert['FromEmail'],'',$to,$alert['Subject'],$message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta invoiti | S-au trimis {$emailno} mail-uri!");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta invoiti | Nu s-a trimis mail !");
            }
            break;
        /*
          case 39:
          $emails  = array();
          $persons = array();

          $query="SELECT ad.*, p.*,cc.*,c.*
          FROM activities_det ad
          INNER JOIN persons p ON p.PersonID=ad.PersonID
          LEFT JOIN companies_contacts cc ON cc.ContactID=ad.ContactID
          LEFT JOIN companies c ON c.CompanyID=cc.CompanyID
          WHERE (ad.NewMeet=1 OR ad.NewMeet=2) AND p.Status NOT IN (6, 5, 11, 10, 3, 1)";
          $conn->query($query);

          while ($row = $conn->fetch_array()) {
          $emails[] = $row;
          }

          if (!empty($emails)) {
          $emailno = 0;
          $subject = $alert['Subject'];
          foreach ($emails as $info) {
          $message = nl2br(str_replace(array('<<FullName>>', '<<ActivitatiPlanificate>>'), array($info['UserName'], $info['ContactName']."(".$info['CompanyName'].") at ".$MeetHourStart." - ".$MeetHourStop), $alert['Body']));
          $subject = str_replace('<<AnAnterior>>', $info['Year'], $subject);
          if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
          Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
          sendMail($alert['FromAlias'],$alert['FromEmail'],$info['FullName'],$info['Email'],$subject,$message);
          $emailno++;
          }
          foreach ((array)$alert['ToAuxEmails'] as $to) {
          if(!empty($to)){
          Alert::logAlert($ID, 0, 0, $to, $subject, $message);
          sendMail($alert['FromAlias'],$alert['FromEmail'],'',$to,$subject,$message);
          }
          }
          }

          error_log(date("d-m-Y H:i:s") . " |  Alerta de activitati zilnice | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
          }
          else {
          error_log(date("d-m-Y H:i:s") . " | Alerta de activitati zilnice | Nu s-a trimis mail !");
          }

          break;
         */
        case 38:
            $emails = array();
            $persons = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, v.Year, a.WorkTime, a.WorkTimeAt, b.StartDate, b.StopDate, b.ContractExpDate, b.CompanyID,  b.ContractType, b.SuspendDate, b.ReturnDate,
						(SELECT IFNULL(SUM(DaysNo), 0) FROM vacations_details WHERE PersonID = a.PersonID AND Year = YEAR(NOW()) AND Type = 'CO' AND Aprove >= 0) AS EffThisYear,
						v.TotalCO - v.Invoire - (SELECT IFNULL(SUM(DaysNo), 0) FROM vacations_details WHERE PersonID = a.PersonID AND Year = v.Year AND Type = 'CO' AND Aprove >= 0)  AS RamasCO 			
					FROM persons a
						INNER JOIN payroll b ON a.PersonID = b.PersonID
						LEFT JOIN vacations v ON a.PersonID = v.PersonID
					WHERE a.Status IN (2, 9, 12, 8) AND 
						v.Year = YEAR(DATE_SUB(NOW(), INTERVAL 1 YEAR)) " .
                    (!empty($alert['Settings']['roles']) ? " AND a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "") .
                    " HAVING RamasCO > 0 ";

            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $persons[$row['PersonID']] = $row;
            }

            $seniority = array();
            $query = "SELECT * FROM vacations_seniority ORDER BY company_id, max_seniority";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $seniority[$row['company_id']][$row['max_seniority']] = $row;
            }

            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            foreach ($persons as $PersonID => $person) {
                $days = 0;
                $months = 0;
                $years = 0;

                if (!empty($company_settings[$person['CompanyID']]['vacation']['accepted_seniority']) && $company_settings[$person['CompanyID']]['vacation']['accepted_seniority'] == 2) {

                    $worktimetest = (int) trim(str_replace('/', '', $person['WorkTime']));
                    // Add if in Profesionale
                    if (!empty($worktimetest)) {
                        $arr = explode('/', $person['WorkTime']);
                        $days = $arr[2];
                        $months = $arr[1];
                        $years = $arr[0];
                    } else { // Add if in CIM History
                        $conn->query("SELECT DataIni AS StartDate, DataFin AS EndDate FROM persons_cm WHERE PersonID = $PersonID");
                        while ($row = $conn->fetch_array()) {
                            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);
                            $days += $arr[2];
                            $months += $arr[1];
                            $years += $arr[0];
                        }
                    }
                }

                // Compute days if ContractType is 'Suspendat' in the current Year
                if ($person['ContractType'] == 3 && substr($person['SuspendDate'], 0, 4) <= date('Y')) {
                    $persons[$PersonID]['days_suspended'] = Utils::getDaysDiff($person['SuspendDate'] < $_GET['year'] ? $start_year : $person['SuspendDate'], strtotime($person['ReturnDate']) ? $person['ReturnDate'] : $end_year, false, false);
                }

                if ($person['StartDate'] > '0000-00-00') {
                    if ($person['StopDate'] > '0000-00-00') {
                        if ($_GET['year'] < date('Y', strtotime($person['StopDate'])))
                            $contractEndDate = $end_year;
                        elseif ($_GET['year'] >= date('Y', strtotime($person['StopDate'])))
                            $contractEndDate = $person['StopDate'];
                    }
                    else {
                        $contractEndDate = $end_year;
                    }

                    $arr = Utils::dateDiff2YMD($person['StartDate'], $contractEndDate);
                    $days += $arr[2];
                    $months += $arr[1];
                    $years += $arr[0];
                }

                $cmonths = floor($days / 30);
                $persons[$PersonID]['days'] = $days % 30;
                $months = $cmonths + $months;
                $persons[$PersonID]['months'] = $months % 12;
                $persons[$PersonID]['years'] = $years + floor($months / 12);

                foreach ((array) $seniority[$person['CompanyID']] as $max_seniority => $v) {
                    if ($persons[$PersonID]['years'] < $max_seniority) {
                        $persons[$PersonID]['TotalCORef'] = $v['days'];
                        $persons[$PersonID]['max_rep_days'] = $v['max_rep_days'];

                        $persons[$PersonID]['rep_date_limit'] = date('Y-m-d', strtotime(date('Y') . "-{$v['rep_month_limit']}-{$v['rep_day_limit']}"));
                        $persons[$PersonID]['date_limit'] = Utils::toDisplayDate($persons[$PersonID]['rep_date_limit']);
                        break;
                    }
                }

                $daysDiff = Utils::getDaysDiff(date('Y-m-d'), $persons[$PersonID]['rep_date_limit'], false, false);

                if ($daysDiff > 0 && ($daysDiff <= $alert['Settings']['days'] || $alert['Settings']['days'] <= 0)) {
                    $persons[$PersonID]['RamasCO'] = ((int) $persons[$PersonID]['RamasCO'] > (int) $persons[$PersonID]['max_rep_days']) ? (int) $persons[$PersonID]['max_rep_days'] : (int) $persons[$PersonID]['RamasCO'];
                    $persons[$PersonID]['RamasCO'] -= (int) $persons[$PersonID]['EffThisYear'];
                    if ($persons[$PersonID]['RamasCO'] > 0)
                        $emails[] = $persons[$PersonID];
                }
            }

            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $message = nl2br(str_replace(array('<<FullName>>', '<<AnAnterior>>', '<<NrZile>>', '<<DataLimita>>'), array($info['FullName'], $info['Year'], $info['RamasCO'], $info['date_limit']), $alert['Body']));
                    $subject = str_replace('<<AnAnterior>>', $info['Year'], $subject);
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        Alert::logAlert($ID, $info['PersonID'], 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }

                error_log(date("d-m-Y H:i:s") . " | Alerta zile concediu ramase an anterior | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta zile concediu ramase an anterior | Nu s-a trimis mail !");
            }

            break;
		//SUMAR ALERTE
        case 41:

            $query = "SELECT DATE(a.`AlertDate`)  AS alertDate, DATE(NOW()) AS currentDate, Settings  FROM alert a WHERE a.`ID` = $ID";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $alertDate = $row['alertDate'];
                $currentDate = $row['currentDate'];
                if(!empty($row['Settings'])){
                    $settings = unserialize($row['Settings']);
                }
                $arrRolesID = array_keys($settings['roles']);
            }
            if (strtotime($alertDate) <= strtotime($currentDate)) {
                $subject = $alert['Subject'];
                $currNumber = 1;
                $addedMessages = array();
                $query = "SELECT
                        a.`Name` AS alert_name,
                        CONCAT(p.`FullName`, ' ', p.`FirstName`) AS nume_prenume,
                        al.`Message` AS content,
                        al.`CreateDate`,
                        al.AlertID as alertID,
                        al.PersonID as personID
                    FROM
                        alert_log al
                        INNER JOIN alert a ON a.`ID` = al.`AlertID`
                        INNER JOIN persons p ON al.`PersonID` = p.`PersonID`
                    WHERE al.`AlertID` IN (2, 4, 9, 10, 11, 12, 13, 14)
                         AND al.`CreateDate` > DATE_SUB(NOW(), INTERVAL 73 HOUR)
                          ORDER BY al.`CreateDate` DESC";

                $conn->query($query);
                //print_r($query);
                $header = false;
                $message = 'Nu s-au generat alerte in ultimile 72 de ore';
                while ($row = $conn->fetch_array()) {//construiesc mesajul
                    if($header == false) {
                        $message = "{$alert['Body']} <table border=1> <tr><th>Nr. crt</th><th>Nume alerta primita</th><th>Nume persoana</th><th>Continut</th><th>Data ultimei alerte</th></tr>";
                        $header = true;
                    }
                    if (!in_array($row['content'], $addedMessages)) {//verific daca nu am mai adaugat in tabel o linie cu continutul ala
                        $message .= "<tr><td>$currNumber</td><td>{$row['alert_name']}</td><td>{$row['nume_prenume']}</td><td>{$row['content']}</td><td>{$row['CreateDate']}</td></tr>";
                        $currNumber++;
                    }
                    $addedMessages[] = $row['content']; // array cu body-ul alertelor
                }
                $message .= ($message != '' ? '</table>' : '');
                //echo $message;
                foreach ((array) $alert['ToAuxEmails'] as $to) {// trimit mail catre aux si loghez alerta
                    Alert::logAlert($ID, 0, 0, $to, $subject, $message);
                    sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                }

                // dau mail catre rolurile selectate si loghez alerta 
                $query = 'SELECT Email, PersonID, CONCAT(FirstName, " ", LastName) AS fullname FROM persons p  WHERE p.`RoleID` IN ('.implode(',',$arrRolesID) .')';
                $conn->query($query);
                while ($row = $conn->fetch_array()){
                    if(!empty($row['Email'])){
                        Alert::logAlert($ID, $row['PersonID'], 0, $row['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $row['fullname'], $row['Email'], $subject, $message);
                    }
                }
            }
            break;

        // alerta A1
         case 42:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email,
	              DATE_FORMAT(a.CustomPerson5, '%d.%m.%Y') AS RegDate,
				  DATE_FORMAT(a.CustomPerson6, '%d.%m.%Y') AS EndDate
	              
				  FROM   persons a
					WHERE
					 ((a.CustomPerson6 >= CURRENT_DATE AND (DATE_SUB(a.CustomPerson6, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE 
							OR ('{$alert['Settings']['is_rec']}' = 1 
							AND {$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}' 
							AND '{$alert['Settings']['int_rec']}' > 0 
							AND (({$alert['Settings']['days']} - DATEDIFF(a.CustomPerson6, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)) 
							AND DATEDIFF(a.CustomPerson6, CURRENT_DATE) <={$alert['Settings']['days']})
					  )
					  OR (a.CustomPerson6 <= CURRENT_DATE AND ('{$alert['Settings']['is_rec']}' = 1 AND '{$alert['Settings']['int_rec']}' > 0  
							AND (DATEDIFF(CURRENT_DATE, DATE_SUB(a.CustomPerson6, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0))
						)
					 )
					 and
		       a.Status NOT IN (6, 5, 11, 10, 3, 1) AND " . (!empty($alert['Settings']['roles']) ? "a.RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ")" : "1=1");
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<StartDate>>', '<<EndDate>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        $EmailedPersonID = Person::getPersonID($info['Email']);
						Alert::logAlert($ID, $info['PersonID'], $EmailedPersonID, 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                       $EmailedPersonID = Person::getPersonID($to);
						Alert::logAlert($ID, 0,$EmailedPersonID, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta A1 | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta A1 | Nu s-a trimis mail !");
            }

            break;  
			// alerta CF3 CF4
        case 43:
            //print_r($alert);
            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email,
	              DATE_FORMAT(a.CustomPerson3, '%d.%m.%Y') AS RegDate,
				  DATE_FORMAT(a.CustomPerson4, '%d.%m.%Y') AS EndDate

				  FROM   persons a
					WHERE
					(
						(a.CustomPerson4 >= CURRENT_DATE
						AND (
							DATE_SUB(a.CustomPerson4, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE
							".(isset($alert['Settings']['is_rec']) ? " OR (
								{$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}'
								AND '{$alert['Settings']['int_rec']}' > 0
								AND (({$alert['Settings']['days']} - DATEDIFF(a.CustomPerson4, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)
							)" : "")."
							AND DATEDIFF(a.CustomPerson4, CURRENT_DATE) <={$alert['Settings']['days']}
							)
						)
						OR (
							a.CustomPerson4 <= CURRENT_DATE
							".(isset($alert['Settings']['is_rec']) ? " AND (
								'{$alert['Settings']['int_rec']}' > 0
								AND (
										DATEDIFF(CURRENT_DATE, DATE_SUB(a.CustomPerson4, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0
									)
							)" : "")."
						)

					)
					AND a.CustomPerson4 != '0000-00-00'
					 and
		       a.Status NOT IN (6, 5, 11, 10, 3, 1)  order by a.CustomPerson4 DESC";
            $conn->query($query);

            //print_r($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            //print_r($emails);
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<StartDate>>', '<<EndDate>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        $EmailedPersonID = Person::getPersonID($info['Email']);
                        //print_r($message);
                        Alert::logAlert($ID, $info['PersonID'], $EmailedPersonID, 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        $EmailedPersonID = Person::getPersonID($to);
                        //print_r($message);
                        Alert::logAlert($ID, 0,$EmailedPersonID, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                    if(!empty($alert['Settings']['roles']))
                    {
                        $queryGetRoles = "SELECT * FROM persons WHERE RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ") AND Status NOT IN (6, 5, 11, 10, 3, 1)";
                        //print_r($queryGetRoles);
                        $conn->query($queryGetRoles);
                        while ($rowRoles = $conn->fetch_array()) {
                            if(!empty($rowRoles['Email'])) {
                                $EmailedPersonID = Person::getPersonID($rowRoles['Email']);
                                //print_r($rowRoles['Email']); echo "<br/>";
                                Alert::logAlert($ID, 0,$EmailedPersonID, 0, $rowRoles['Email'], $subject, $message);
                                sendMail($alert['FromAlias'], $alert['FromEmail'], '', $rowRoles['Email'], $subject, $message);
                            }
                        }
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta CF34 | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta CF34 | Nu s-a trimis mail !");
            }
            break;

        // alerta asigurare medicala
        case 45:

            $emails = array();
            $query = "SELECT a.PersonID, a.FullName, a.Email, b.Notes,
	                     DATE_FORMAT(b.RegDate, '%d.%m.%Y') AS RegDate,
			     DATE_FORMAT(b.EndDate, '%d.%m.%Y') AS EndDate
	              FROM   persons a
		             INNER JOIN persons_medical b ON a.PersonID = b.PersonID AND b.Type = 1
					 AND
					 ((b.EndDate >= CURRENT_DATE AND (DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY) = CURRENT_DATE
							".(isset($alert['Settings']['is_rec']) ? " OR (
								{$alert['Settings']['days']} >= '{$alert['Settings']['int_rec']}'
								AND '{$alert['Settings']['int_rec']}' > 0
								AND (({$alert['Settings']['days']} - DATEDIFF(b.EndDate, CURRENT_DATE)) % '{$alert['Settings']['int_rec']}' = 0)
							)" : "")."
							AND DATEDIFF(b.EndDate, CURRENT_DATE) <={$alert['Settings']['days']})
					  )
					  OR (b.EndDate <= CURRENT_DATE
					  ".(isset($alert['Settings']['is_rec']) ? " AND (
								'{$alert['Settings']['int_rec']}' > 0
								AND (
										DATEDIFF(CURRENT_DATE, DATE_SUB(b.EndDate, INTERVAL {$alert['Settings']['days']} DAY)) % '{$alert['Settings']['int_rec']}' = 0
									)
							)" : "")."
						)
					 )
					 AND b.EndDate != '0000-00-00'
		      WHERE a.Status NOT IN (6, 5, 11, 10, 3, 1)";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $row['FullName'] = stripslashes($row['FullName']);
                $emails[] = $row;
            }
            if (!empty($emails)) {
                $emailno = 0;
                $subject = $alert['Subject'];
                foreach ($emails as $info) {
                    $txtAlert = "expira in curand";
                    if (Utils::getDaysDiff($info['EndDate'], date('Y-m-d'), false, false) > 1)
                        $txtAlert = "a expirat";
                    $message = nl2br(str_replace(array('<<FullName>>', '<<RegDate>>', '<<EndDate>>', '<<Notes>>', '<<TxtAlert>>'), array($info['FullName'], $info['RegDate'], $info['EndDate'], $info['Notes'], $txtAlert), $alert['Body']));
                    if (!empty($alert['ToSelf']) && !empty($info['Email'])) {
                        $EmailedPersonID = Person::getPersonID($info['Email']);
                        Alert::logAlert($ID, $info['PersonID'], $EmailedPersonID, 0, $info['Email'], $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], $info['FullName'], $info['Email'], $subject, $message);
                        $emailno++;
                    }
                    foreach ((array) $alert['ToAuxEmails'] as $to) {
                        $EmailedPersonID = Person::getPersonID($to);
                        Alert::logAlert($ID, 0,$EmailedPersonID, 0, $to, $subject, $message);
                        sendMail($alert['FromAlias'], $alert['FromEmail'], '', $to, $subject, $message);
                    }
                    if(!empty($alert['Settings']['roles']))
                    {
                        $queryGetRoles = "SELECT * FROM persons WHERE RoleID IN (" . implode(',', array_keys($alert['Settings']['roles'])) . ") AND Status NOT IN (6, 5, 11, 10, 3, 1)";
                        //print_r($queryGetRoles);
                        $conn->query($queryGetRoles);
                        while ($rowRoles = $conn->fetch_array()) {
                            if(!empty($rowRoles['Email'])) {
                                $EmailedPersonID = Person::getPersonID($rowRoles['Email']);
                                //print_r($rowRoles['Email']); echo "<br/>";
                                Alert::logAlert($ID, 0,$EmailedPersonID, 0, $rowRoles['Email'], $subject, $message);
                                sendMail($alert['FromAlias'], $alert['FromEmail'], '', $rowRoles['Email'], $subject, $message);
                            }
                        }
                    }
                }
                error_log(date("d-m-Y H:i:s") . " | Alerta asigurare medicala | S-au trimis {$emailno} mail-uri din " . count($emails) . " persoane gasite !");
            } else {
                error_log(date("d-m-Y H:i:s") . " | Alerta asigurare medicala | Nu s-a trimis mail !");
            }

            break;    

    }

    switch ($alert['Type']) {
        case 'daily':
            $days = 1; //date('w') == 5 ? 3 : 1;
            mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTERVAL $days DAY) WHERE ID = $ID");
            break;
        case 'weekly':
            mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTERVAL 1 WEEK) WHERE ID = $ID");
            break;
        case 'monthly':
            mysql_query("UPDATE alert SET AlertDate = DATE_ADD(AlertDate, INTREVAL 1 MONTH) WHERE ID = $ID");
            break;
        case '3days':
            $days = 3;
            mysql_query("UPDATE alert SET AlertDate = DATE_ADD(NOW(), INTERVAL 3 DAY) WHERE ID = $ID");
            break;
    }
}
?>