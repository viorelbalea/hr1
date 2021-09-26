<?php

class Activity extends ConfigData
{

    private $ActivityID;
    private $UserID, $Username;


    public function __construct($ActivityID = 0)
    {
        if ($ActivityID > 0) {
            $this->ActivityID = $ActivityID;
        }
    }

    public static function delActivity($ActivityID)
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][1]}' = 3 AND UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM activities WHERE ActivityID = $ActivityID AND ($condrw)");

        $conn->query("DELETE FROM activities_det WHERE ActivityID = $ActivityID AND ($condrw)");

    }

    public static function delActivityDet($ActivityDetID)
    {

        global $conn;

        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][1]}' = 3 AND UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("DELETE FROM activities_det WHERE ActivityDetID = $ActivityDetID AND ($condrw)");

    }

    public static function getActivity($ActivityDetID)
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][14][1][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][14][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][14][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][1]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT *, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   activities a
                         LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
                         LEFT JOIN companies_contacts c ON d.ContactID=c.ContactID
                  WHERE  d.ActivityDetID = $ActivityDetID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_ACTIVITY'));
        }
    }

    public static function getLastActivities($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CompanyName';
                    $cond .= " AND c.CompanyName LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'ContactName';
                    $cond .= " AND cc.ContactName LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND p.FullName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND d.Status = " . (int)$_GET['Status'];
        }
        if (!empty($_GET['SourceID'])) {
            $cond .= " AND d.SourceID = " . (int)$_GET['SourceID'];
        }
        if (!empty($_GET['StageID'])) {
            $cond .= " AND d.StageID = " . (int)$_GET['StageID'];
        }
        if (!empty($_GET['CampaignID'])) {
            $cond .= " AND d.CampaignID = " . (int)$_GET['CampaignID'];
        }
        if (!empty($_GET['Subject'])) {
            $cond .= " AND a.Subject = " . (int)$_GET['Subject'];
        }
        if (!empty($_GET['PersonID'])) {
            $cond .= " AND d.PersonID = " . (int)$_GET['PersonID'];
        }
        if (!empty($_GET['DateStart'])) {
            $cond .= " AND d.Date >= '" . $_GET['DateStart'] . "'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND d.Date <= '" . $_GET['DateEnd'] . "'";
        }
        if (!empty($_GET['NextDateStart'])) {
            $cond .= " AND d.NextDate >= '" . $_GET['NextDateStart'] . "'";
        }
        if (!empty($_GET['NextDateEnd'])) {
            $cond .= " AND d.NextDate <= '" . $_GET['NextDateEnd'] . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][1]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(DISTINCT d.ActivityDetID) AS total
	           FROM   activities a
                 	  LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
			  LEFT JOIN users b ON a.UserID = b.UserID
			  LEFT JOIN companies_contacts cc ON d.ContactID=cc.ContactID
			  LEFT JOIN companies c ON cc.CompanyID=c.CompanyID
			  LEFT JOIN persons p ON d.PersonID=p.PersonID
			  INNER JOIN (
				        SELECT MAX(d.ActivityDetID) AS id
				        FROM   activities_det d
					       LEFT JOIN activities a ON a.ActivityID=d.ActivityID
					       LEFT JOIN companies c ON a.CompanyID=c.CompanyID
				        GROUP BY a.ActivityID
				      ) ids ON d.ActivityDetID = ids.id
                    WHERE ($condbase) $cond";
        $conn->query($query);

        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $activities = array();
        $activities[0]['pageNo'] = $pageNo;
        $activities[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Subject', 'FullName', 'CompanyName', 'ContactName', 'Status', 'SourceID', 'StageID', 'CampaignID', 'Date', 'NextDate', 'a.CreateDate')) ? $_GET['order_by'] : 'd.Date';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*,cc.*,d.*, p.*, b.UserName, DATE_FORMAT(d.Date, '%d.%m.%Y') AS ActivityData, c.CompanyName,c.CompanyID, ct.Status as Status, d.Status as Status2
	          FROM   activities a

			 LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
				 LEFT JOIN persons p ON d.PersonID=p.PersonID
		 LEFT JOIN users b ON a.UserID = b.UserID
			 LEFT JOIN companies_contacts cc ON d.ContactID=cc.ContactID
			 LEFT JOIN companies c ON cc.CompanyID=c.CompanyID
			 INNER JOIN (
				      SELECT MAX(d.ActivityDetID) AS id
				      FROM   activities_det d
				             LEFT JOIN activities a ON a.ActivityID=d.ActivityID
					     LEFT JOIN companies c ON a.CompanyID=c.CompanyID
				      GROUP BY a.ActivityID
				    ) ids ON d.ActivityDetID = ids.id
			left join contract ct on (ct.PartnerID=a.CompanyID and ct.CompanyRole='Furnizor')
	          WHERE  ($condbase) $cond
			  GROUP BY d.ActivityDetID
	          ORDER  BY $order_by $asc_or_desc ,d.ActivityDetID DESC " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        $cnt = 2;
        while ($row = $conn->fetch_array()) {
            $activities[$cnt] = $row;
            $cnt++;
        }
//Utils::pa($activities);
        return $activities;
    }

    public static function getOfferActivities($action = '')
    {

        global $conn;

        $cond = " AND d.OfferValue > 0 AND d.OfferDate > '0000-00-00'";

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CompanyName';
                    $cond .= " AND c.CompanyName LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'Address';
                    $cond .= " AND p.Address LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND d.Status = " . (int)$_GET['Status'];
        }
        if (!empty($_GET['Subject'])) {
            $cond .= " AND a.Subject = " . (int)$_GET['Subject'];
        }
        if (!empty($_GET['ProjectID'])) {
            $cond .= " AND d.ProjectID = " . (int)$_GET['ProjectID'];
        }
        if (!empty($_GET['DateStart'])) {
            $cond .= " AND d.OfferDate >= '" . $_GET['DateStart'] . "'";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND d.OfferDate <= '" . $_GET['DateEnd'] . "'";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][7]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][7]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
	           FROM   activities a
                 	  LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
			  LEFT JOIN companies_contacts cc ON d.ContactID=cc.ContactID
			  LEFT JOIN companies c ON cc.CompanyID=c.CompanyID
			  INNER JOIN (
				        SELECT MAX(d.ActivityDetID) AS id
				        FROM   activities_det d
					       LEFT JOIN activities a ON a.ActivityID=d.ActivityID
					       LEFT JOIN companies c ON a.CompanyID=c.CompanyID
				        GROUP BY a.ActivityID
				      ) ids ON d.ActivityDetID = ids.id
			  LEFT JOIN pontaj_projects p ON d.ProjectID = p.ProjectID	      
                    WHERE ($condbase) $cond";
        $conn->query($query);

        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $activities = array();
        $activities[0]['pageNo'] = $pageNo;
        $activities[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('Subject', 'FullName', 'CompanyName', 'ContactName', 'Status', 'SourceID', 'StageID', 'CampaignID', 'Date', 'NextDate', 'a.CreateDate')) ? $_GET['order_by'] : 'a.CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT a.*, d.*, c.CompanyName, c.CompanyID, p.Name, p.Address
	          FROM   activities a
			 LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
			 LEFT JOIN companies_contacts cc ON d.ContactID=cc.ContactID
			 LEFT JOIN companies c ON cc.CompanyID=c.CompanyID
			 INNER JOIN (
				      SELECT MAX(d.ActivityDetID) AS id
				      FROM   activities_det d
				             LEFT JOIN activities a ON a.ActivityID=d.ActivityID
					     LEFT JOIN companies c ON a.CompanyID=c.CompanyID
				      GROUP BY a.ActivityID
				    ) ids ON d.ActivityDetID = ids.id
			 LEFT JOIN pontaj_projects p ON d.ProjectID = p.ProjectID	    
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc ,d.ActivityDetID DESC " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        $cnt = 2;
        while ($row = $conn->fetch_array()) {
            $activities[$cnt] = $row;
            $cnt++;
        }
        return $activities;
    }

    public static function getAllActivities($ActivityID)
    {

        global $conn;

        $condr = "('{$_SESSION['USER_RIGHTS2'][14][1]}' >1 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][1][1]}' > 1
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $query = "SELECT a.*,d.*,cc.*, b.UserName, DATE_FORMAT(d.Date, '%d.%m.%Y') AS ActivityData, c.CompanyName,c.CompanyID,p.FullName, ct.Status as CStatus
	              FROM   activities a
	              	   LEFT JOIN activities_det d ON a.ActivityID=d.ActivityID
                       LEFT JOIN users b ON a.UserID = b.UserID
                       LEFT JOIN companies_contacts cc ON d.ContactID=cc.ContactID
                       LEFT JOIN companies c ON cc.CompanyID=c.CompanyID
                       LEFT JOIN persons p ON d.PersonID=p.PersonID
					   
					   left join contract ct on ct.CompanyID=a.CompanyID

	              WHERE  ($condr)
	              AND a.ActivityID = $ActivityID
	              ORDER  BY a.ActivityID ASC";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $activities[$row['ActivityDetID']] = $row;
        }
//Utils::pa($activities);
        return $activities;
    }

    public static function newSalesCampaign($CampaignID)
    {

        global $conn;

        if ($CampaignID > 0 && !empty($_GET['delCampaign'])) {
            $conn->query("DELETE FROM sales_campaigns
                          WHERE  CampaignID = $CampaignIDD AND
                                 NOT EXISTS(SELECT CampaignID FROM activities_det WHERE CampaignID = $CampaignID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta campanie deoarece este deja utilizata!\\nVa recomandam inactivarea sa!'); window.location.href = './?m=admin&o=sales_stage';\"></body>";
                exit;
            }

        } else {

            $Name = Utils::formatStr($_GET['Name']);
            $Status = !empty($_GET['Status']) ? 1 : 0;
            if ($CampaignID > 0) {
                $conn->query("UPDATE sales_campaigns SET Name = '$Name', Status = $Status WHERE StageID = $CampaignID");
            } else {
                $conn->query("INSERT INTO sales_campaigns(Name, Status) VALUES('$Name', 1)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SALES_CAMPAIGN'));
            }
        }
    }

    public static function addCampaign($info)
    {

        global $conn;

        if (trim($info['CampaignName']) == '') {
            throw new Exception(Message::getMessage('CAMPAIGN_EMPTY'));
        }
        if (trim($info['Status']) < 1) {
            throw new Exception(Message::getMessage('CAMPAIGNSTATUS_EMPTY'));
        }
        if (trim($info['Type']) < 1) {
            throw new Exception(Message::getMessage('CAMPAIGNTYPE_EMPTY'));
        }
        $info['DateStart'] = Utils::toDBDate($info['DateStart']);
        $info['DateEnd'] = Utils::toDBDate($info['DateEnd']);

        $conn->query("INSERT INTO sales_campaigns(UserID,CampaignName, Status, Type, DateStart, DateEnd, CostNet, Cost, ExchangeRate, Comment, CreateDate )
		 				VALUES({$_SESSION['USER_ID']},'{$info['CampaignName']}','{$info['Status']}','{$info['Type']}','{$info['DateStart']}','{$info['DateEnd']}','{$info['CostNet']}','{$info['Cost']}','{$info['ExchangeRate']}','{$info['Comment']}',CURRENT_TIMESTAMP)");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_SALES_CAMPAIGN'));
        }
        $CampanignID = $conn->get_insert_id();
        return $CampanignID;

    }

    public static function delCampaign($CampaignID)
    {

        global $conn;

        if ($CampaignID > 0) {
            $conn->query("DELETE FROM sales_campaigns
                          WHERE  CampaignID = $CampaignID
                          AND NOT EXISTS(SELECT CampaignID FROM activities_det WHERE CampaignID = $CampaignID)
                          AND (UserID = {$_SESSION['USER_ID']} OR '{$_SESSION['USER_SETTINGS'][14]}' = 3 OR {$_SESSION['USER_ID']} = 1)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta campanie deoarece este deja utilizata!'); window.location.href = './?m=sales&o=campaigns';\"></body>";
                exit;
            }

        }

    }

    public static function getCampaign($CampaignID)
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS3'][14][3][1]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][14][3]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR '{$_SESSION['USER_RIGHTS2'][14][3]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][14][3]}' = 3 AND a.UserID = {$_SESSION['USER_ID']})
	             OR
	             '{$_SESSION['USER_RIGHTS3'][14][3][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT *, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   sales_campaigns a
                  WHERE  a.CampaignID = $CampaignID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_CAMPAIGN'));
        }
    }

    ## Sales Campaigns ##
    #####################

    public static function getCampaigns($action)
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for'])) {
            switch ($_GET['search_for']) {
                case 'CampaignName';
                    $cond .= " AND a.CampaignName LIKE '%{$_GET['keyword']}%'";
                    break;
                default:
                    $cond .= " AND a.CampaignName LIKE '%{$_GET['keyword']}%'";
                    break;
            }
        }

        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }
        if (!empty($_GET['Type'])) {
            $cond .= " AND a.Type = " . (int)$_GET['Type'];
        }
        if (!empty($_GET['DateStart'])) {
            $cond .= " AND (a.DateStart >= '" . $_GET['DateStart'] . "' OR a.DateEnd >= '" . $_GET['DateStart'] . "')";
        }
        if (!empty($_GET['DateEnd'])) {
            $cond .= " AND (a.DateStart <= '" . $_GET['DateEnd'] . "' OR a.DateEnd <= '" . $_GET['DateEnd'] . "')";
        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][3]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][3]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total FROM sales_campaigns a WHERE ($condbase) $cond";
        $conn->query($query);

        $row = $conn->fetch_array();

        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $campaigns = array();
        $campaigns[0]['pageNo'] = $pageNo;
        $campaigns[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) && in_array($_GET['order_by'], array('CampaignName', 'Type', 'Status', 'StartDate', 'EndDate', 'CreateDate')) ? $_GET['order_by'] : 'CreateDate';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'desc';

        $query = "SELECT *
	          FROM   sales_campaigns a
	          WHERE  ($condbase) $cond
	          ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $campaigns[$row['CampaignID']] = $row;
        }

        return $campaigns;
    }

    public static function getAllCampaigns($all = true)
    {

        global $conn;

        $condbase = "('{$_SESSION['USER_RIGHTS2'][14][3]}' = 1 AND a.UserID = {$_SESSION['USER_ID']}) OR
                     '{$_SESSION['USER_RIGHTS2'][14][3]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        if (!$all) $cond = " AND(Status=1 OR Status=2) ";
        $query = "SELECT *
	          FROM   sales_campaigns a
	          WHERE  ($condbase) $cond";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $campaigns[$row['CampaignID']] = $row;
        }
        return $campaigns;
    }

    public static function getActiveSubjects()
    {

        global $conn;

        $subjects = array();
        $conn->query("SELECT SubjectID, Subject FROM activity_subject WHERE Status = 1 ORDER BY SubjectID");
        while ($row = $conn->fetch_array()) {
            $subjects[$row['SubjectID']] = stripslashes($row['Subject']);
        }
        return $subjects;
    }

    public static function getSubjects()
    {

        global $conn;

        $subjects = array();
        $conn->query("SELECT SubjectID, Subject, Status FROM activity_subject ORDER BY SubjectID");
        while ($row = $conn->fetch_array()) {
            $row['Subject'] = stripslashes($row['Subject']);
            $subjects[$row['SubjectID']] = $row;
        }
        return $subjects;
    }

    public static function newSubject($SubjectID)
    {

        global $conn;

        if ($SubjectID > 0 && !empty($_GET['delSubject'])) {
            $conn->query("DELETE FROM activity_subject
                          WHERE  SubjectID = $SubjectID AND
                                 NOT EXISTS(SELECT Subject FROM activities WHERE Subject = $SubjectID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest subiect deoarece este deja utilizat!'); window.location.href = './?m=dictionary&o=activity_subject';\"></body>";
                exit;
            }

        } else {

            $Subject = Utils::formatStr($_GET['Subject']);

            if ($SubjectID > 0) {
                $conn->query("UPDATE activity_subject SET Subject = '$Subject', Status = '{$_GET['Status']}' WHERE SubjectID = $SubjectID");
            } else {
                $conn->query("INSERT INTO activity_subject(UserID, Subject, CreateDate) VALUES('{$_SESSION['USER_ID']}', '$Subject', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SUBJECT'));
            }
        }
    }

    public static function getAllSalesByPlanif($action = '')
    {

        global $conn, $days;

        $curr_date = date('Y-m-d');
        $curr_year = date('Y');
        $curr_month = date('m');
        $curr_day = date('d');

        if (!empty($_GET['week'])) {
            $curr_day += 7 * (int)$_GET['week'];
            $curr_date = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));
        }

        $weekday = date('w', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day, (int)$curr_year));

        if ($weekday == 0) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
        } elseif ($weekday == 1) {
            $days[] = $curr_date;
            for ($i = 1; $i <= 6; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        } else {
            $days[] = $curr_date;
            for ($i = 1; $i < $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day - $i, (int)$curr_year));
            }
            for ($i = 1; $i <= 7 - $weekday; $i++) {
                $days[] = date('Y-m-d', mktime(0, 0, 0, (int)$curr_month, (int)$curr_day + $i, (int)$curr_year));
            }
        }
        sort($days);

        $events = array();

        $query = "SELECT a.*, u.*,cc.*,c.*
                  FROM   activities_det  a
				  left join activities act on act.ActivityID=a.ActivityID
				  left join users u on u.UserID=act.UserID
				  left join companies_contacts cc on cc.ContactID=a.ContactID
				  left join companies c on c.CompanyID=cc.CompanyID
                  WHERE  a.MeetDate BETWEEN '{$days[0]}' AND '{$days[6]}'
		  ORDER  BY a.MeetDate, a.MeetHourStart";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $events[$row['MeetDate']][$row['MeetHourStart']][$row['ActivityDetID']] = $row;
        }

        foreach ($events as $EventData => $v) {
            foreach ($v as $MeetHourStart => $vv) {
                foreach ($vv as $EventID => $vvv) {
                    $fMeetHourStart = strtotime("$MeetDate $MeetHourStart");
                    $fMeetHourStop = strtotime("$MeetDate {$vvv['MeetHourStop']}");
                    while ($fMeetHourStart + 15 * 60 < $fMeetHourStop) {
                        $fMeetHourStart += 15 * 60;
                        $events[$EventData][date('H:i', $fMeetHourStart)][$EventID] = $vvv;
                    }
                }
            }
        }

        return $events;
    }

    public function addActivity($info = array())
    {

        $this->setData($info);

        global $conn;
        //Utils::pa($info);
        $conn->query("SELECT ActivityID FROM activities
        			   WHERE Subject=" . $info['Subject'] . " AND CompanyID=" . $_GET['CompanyID']);
        if ($conn->get_num_rows() == 0) {
            //throw new Exception(Message::getMessage('DUPLICATE_SUBJ_COMPANY'));
            $conn->query("INSERT INTO activities(UserID, CompanyID, Subject, CreateDate, LastUpdateDate)
                      VALUES({$_SESSION['USER_ID']},{$_POST['CompanyID']}, {$info['Subject']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            $this->ActivityID = $conn->get_insert_id();

            $conn->query("INSERT INTO activities_det(ActivityID, PersonID, ContactID, Status, SourceID, StageID, CampaignID, Date, NextDate, Comment, Comment2, NewMeet, MeetDate, MeetHourStart, MeetHourStop, ProjectID, ParticipationType, FinancialSource, RequestDate, Deadline, OfferDate, OfferValue, Coin, CreateDate, LastUpdateDate)
                      VALUES($this->ActivityID, " . (int)$_SESSION['PERS'] . ",{$info['ContactID']},{$info['Status']},{$info['SourceID']},{$info['StageID']},{$info['CampaignID']},'{$info['Date']}','{$info['NextDate']}','{$info['Comment']}','{$info['Comment2']}','{$info['NewMeet']}','{$info['MeetDate']}','{$info['MeetHourStart']}','{$info['MeetHourStop']}', '{$info['ProjectID']}', '{$info['ParticipationType']}', '{$info['FinancialSource']}', '{$info['RequestDate']}', '{$info['Deadline']}', '{$info['OfferDate']}', '{$info['OfferValue']}', '{$info['Coin']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");

            $ActivityDetID = $conn->get_insert_id();
        } else {
            $row = $conn->fetch_array();
            $this->ActivityID = $row['ActivityID'];
            $conn->query("INSERT INTO activities_det(ActivityID, PersonID, ContactID, Status, SourceID, StageID, CampaignID, Date, NextDate, Comment, Comment2, NewMeet, MeetDate, MeetHourStart, MeetHourStop, ProjectID, ParticipationType, FinancialSource, RequestDate, Deadline, OfferDate, OfferValue, Coin, CreateDate, LastUpdateDate)
                      VALUES({$this->ActivityID}, " . (int)$_SESSION['PERS'] . ",{$info['ContactID']},{$info['Status']},{$info['SourceID']},{$info['StageID']},{$info['CampaignID']},'{$info['Date']}','{$info['NextDate']}','{$info['Comment']}','{$info['Comment2']}','{$info['NewMeet']}','{$info['MeetDate']}','{$info['MeetHourStart']}','{$info['MeetHourStop']}', '{$info['ProjectID']}', '{$info['ParticipationType']}', '{$info['FinancialSource']}', '{$info['RequestDate']}', '{$info['Deadline']}', '{$info['OfferDate']}', '{$info['OfferValue']}', '{$info['Coin']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            $ActivityDetID = $conn->get_insert_id();
        }

        if ($info['NewMeet']) {
            //			echo "[meet-detected]";

//cip
            $conn->query("select Email from persons where PersonID=" . $_SESSION['PERS']);
            $em = $conn->fetch_array();

            $conn->query("select CompanyID,ContactName from companies_contacts where ContactID=" . $info['ContactID']);
            $cnt = $conn->fetch_array();

            $conn->query("select CompanyName from companies where CompanyID=" . $cnt['CompanyID']);
            $cmp = $conn->fetch_array();

            $conn->query("select DirectManagerID from payroll where PersonID=" . $_SESSION['PERS']);
            $mng = $conn->fetch_array();

            $conn->query("select Email from persons where PersonID=" . $mng['DirectManagerID']);
            $mang = $conn->fetch_array();

            include_once('sendMail.php');
            $conn->query("SELECT Subject, Body, FromAlias, FromEmail, ToAuxEmails, Settings FROM alert WHERE ID = 40 AND Active = 1");
            if ($row = $conn->fetch_array()) {
                $conn->query("SELECT FullName, Email
	                	  FROM   persons
				  WHERE  PersonID =  " . ((int)$_SESSION['PERS']) . "");
                if ($row3 = $conn->fetch_array()) {
                    $compDate = explode("-", $info['MeetDate']);
                    $newInfoDate = $compDate[2] . "-" . $compDate[1] . "-" . $compDate[0];
                    $message = str_replace(array('<<FullName>>', '<<StartDate>>', '<<StartHour>>', '<<EndHour>>', '<<CompanyName>>', '<<TodayDate>>'),
                        array($row3['FullName'], $newInfoDate, $info['MeetHourStart'], $info['MeetHourStop'], $cnt['ContactName'] . " (" . $cmp['CompanyName'] . ")", date("d-m-Y")), $row['Body']);
                }

                $alert_settings = !empty($row['Settings']) ? unserialize($row['Settings']) : '';
                if (!empty($alert_settings['md'])) {
                    sendMail($row['FromAlias'], $row['FromEmail'], $info['FullName'], $em['Email'], $row['Subject'], $message);
                    sendMail($row['FromAlias'], $row['FromEmail'], $info['FullName'], $mang['Email'], $row['subject'], $message);
                    //		 echo '[send1]['.$_SESSION['PERS'].']['.$em['Email'].']';

                }
                if (!empty($alert_settings['mf'])) {
                    $conn->query("SELECT FullName, Email
	                	  FROM   persons
				  WHERE  PersonID = (SELECT FunctionalManagerID FROM payroll WHERE PersonID = " . ((int)$_SESSION['PERS']) . ")");
                    if ($row2 = $conn->fetch_array()) {
                        sendMail($row['FromAlias'], $row['FromEmail'], $row2['FullName'], $row2['Email'], $row['Subject'], $message);
                        //		 echo '[send2]['.$row2['Email'].']';

                    }
                }
                if (!empty($row['ToAuxEmails'])) {
                    $row['ToAuxEmails'] = explode(';', $row['ToAuxEmails']);
                    foreach ((array)$alert['ToAuxEmails'] as $to) {
                        sendMail($row['FromAlias'], $row['FromEmail'], '', $to, $row['Subject'], $message);
                        //		 echo '[send3]['.$to.']';
                    }
                }
            }
        }

//eocip

        //return $this->ActivityID;
        return $ActivityDetID;
    }

    private function setData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }

        $info['Date'] = Utils::toDBDate($info['Date']);
        $info['NextDate'] = Utils::toDBDate($info['NextDate']);
        $info['RequestDate'] = Utils::toDBDate($info['RequestDate']);
        $info['Deadline'] = Utils::toDBDate($info['Deadline']);
        $info['OfferDate'] = Utils::toDBDate($info['OfferDate']);
        $info['MeetDate'] = Utils::toDBDate($info['MeetDate']);

        if ($info['CompanyID'] < 0) {
            throw new Exception(Message::getMessage('COMPANY_EMPTY'));
        }
        if ($info['ContactID'] < 0) {
            throw new Exception(Message::getMessage('CONTACT_EMPTY'));
        }
        unset($info['CompanyID']);

    }

    public function getUser($ActivityDetID)
    {
        global $conn;

        $conn->query("SELECT ActivityID FROM activities
        			   WHERE ActivityDetID=" . $ActivityDetID);
        $rr = $conn->fetch_array();

        $conn->query("SELECT UserName from users where UserID=" . $rr['UserID']);
        $r = $con->fetch_array();
        return $r['UserName'];
    }

    public function editActivity($info = array(), $ActivityDetID)
    {

        $this->setData($info);

        global $conn;

        $conn->query("SELECT ActivityID FROM activities
        			   WHERE Subject=" . $info['Subject'] . " AND CompanyID=" . $_GET['CompanyID']);
        if ($conn->get_num_rows() == 0) {
            //throw new Exception(Message::getMessage('DUPLICATE_SUBJ_COMPANY'));
            $conn->query("INSERT INTO activities(UserID, CompanyID, Subject, CreateDate, LastUpdateDate)
                      VALUES({$_SESSION['USER_ID']},{$_POST['CompanyID']}, {$info['Subject']}, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
            $this->ActivityID = $conn->get_insert_id();

            $conn->query("INSERT INTO activities_det(ActivityID, PersonID, ContactID, Status, SourceID, StageID, CampaignID, Date, NextDate, Comment, Comment2, NewMeet, MeetDate, MeetHourStart, MeetHourStop, ProjectID, ParticipationType, FinancialSource, RequestDate, Deadline, OfferDate, OfferValue, Coin, CreateDate, LastUpdateDate)
                      VALUES($this->ActivityID, " . (int)$_SESSION['PERS'] . ",{$info['ContactID']},{$info['Status']},{$info['SourceID']},{$info['StageID']},{$info['CampaignID']},'{$info['Date']}','{$info['NextDate']}','{$info['Comment']}','{$info['Comment2']}','{$info['NewMeet']}','{$info['MeetDate']}','{$info['MeetHourStart']}','{$info['MeetHourStop']}', '{$info['ProjectID']}', '{$info['ParticipationType']}', '{$info['FinancialSource']}', '{$info['RequestDate']}', '{$info['Deadline']}', '{$info['OfferDate']}', '{$info['OfferValue']}', '{$info['Coin']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        } else {
            $row = $conn->fetch_array();
            $this->ActivityID = $row['ActivityID'];
            $this->UserID = $_SESSION['UserID'];
            $conn->query("UPDATE activities_det SET ActivityID={$this->ActivityID},
								 PersonID=" . (int)$_SESSION['PERS'] . ",
								 ContactID={$info['ContactID']},
								 Status={$info['Status']},
								 SourceID={$info['SourceID']},
								 StageID={$info['StageID']},
								 CampaignID={$info['CampaignID']},
								 Date='{$info['Date']}',
								 NextDate='{$info['NextDate']}',
								 Comment='{$info['Comment']}',
								 Comment2='{$info['Comment2']}',
								 NewMeet='{$info['NewMeet']}',
								 MeetDate='{$info['MeetDate']}',
								 MeetHourStart='{$info['MeetHourStart']}',
								 MeetHourStop='{$info['MeetHourStop']}',
								 ProjectID='{$info['ProjectID']}',
								 ParticipationType='{$info['ParticipationType']}',
								 FinancialSource='{$info['FinancialSource']}',
								 RequestDate='{$info['RequestDate']}',
								 Deadline='{$info['Deadline']}',
								 OfferDate='{$info['OfferDate']}',
								 OfferValue='{$info['OfferValue']}',
								 Coin='{$info['Coin']}',
								 CreateDate=CURRENT_TIMESTAMP,
								 LastUpdateDate=CURRENT_TIMESTAMP
								 WHERE ActivityDetID=$ActivityDetID");
        }
    }

    public function editCampaign($info = array(), $CampaignID)
    {

        global $conn;

        if (trim($info['CampaignName']) == '') {
            throw new Exception(Message::getMessage('CAMPAIGN_EMPTY'));
        }
        if (trim($info['Status']) < 1) {
            throw new Exception(Message::getMessage('CAMPAIGNSTATUS_EMPTY'));
        }
        if (trim($info['Type']) < 1) {
            throw new Exception(Message::getMessage('CAMPAIGNTYPE_EMPTY'));
        }
        $info['DateStart'] = Utils::toDBDate($info['DateStart']);
        $info['DateEnd'] = Utils::toDBDate($info['DateEnd']);

        $conn->query("UPDATE sales_campaigns SET
						UserID={$_SESSION['USER_ID']},
						CampaignName = '{$info['CampaignName']}',
						Status = '{$info['Status']}',
						Type = '{$info['Type']}',
						DateStart = '{$info['DateStart']}',
						DateEnd = '{$info['DateEnd']}',
						CostNet = '{$info['CostNet']}',
						Cost = '{$info['Cost']}',
						Comment = '{$info['Comment']}',
						CreateDate = CURRENT_TIMESTAMP
						WHERE CampaignID = $CampaignID");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_SALES_CAMPAIGN'));
        }
        global $conn;
    }

}