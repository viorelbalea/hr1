<?php

class ReportBuilder
{

    public static $sCriteria = array(
        'Personal' => array(
            'Status' => 'Status',
            'SubStatus' => 'Tip',
            'FullName' => 'Nume',
            'DateOfBirth' => 'Data nasterii',
            'Sex' => 'Sex',
            'd.DistrictID' => 'Judet',
            'd.CityID' => 'Localitate',
            'MaritalStatus' => 'Stare civila',
            'NumberOfChildren' => 'Numar copii',
            'JobDictionaryID' => 'Profesia',
            'Studies' => 'Pregatire',
            'DepartmentID' => 'Departament',
            'CostCenterID' => 'Centru de cost',
            'FunctionID' => 'Functie',
            'SiteID' => 'Locatie',

        ),
        'Companii' => array(
            'status' => 'Status',
            'FullName' => 'Nume',
            'DateOfBirth' => 'Data nasterii',
            'Sex' => 'Sex',
        ),
        'Joburi' => array(
            'status' => 'Status',
            'FullName' => 'Nume',
            'DateOfBirth' => 'Data nasterii',
            'Sex' => 'Sex',
        ),
        'Evenimente' => array(
            'status' => 'Status',
            'FullName' => 'Nume',
            'DateOfBirth' => 'Data nasterii',
            'Sex' => 'Sex',
        ),
        'Training' => array(
            'status' => 'Status',
            'FullName' => 'Nume',
            'DateOfBirth' => 'Data nasterii',
            'Sex' => 'Sex',
        ),
    );

    public static function saveReport($type, $cond, $report)
    {

        global $conn;

        $conn->query("INSERT INTO reports_builder(UserID, Type, Cond, Report) 
	              VALUES({$_SESSION['USER_ID']}, '$type', '" . Utils::formatStr($cond) . "', '" . Utils::formatStr($report) . "')");
    }

    public static function getReports()
    {

        global $conn;

        $reports = array();

        $conn->query("SELECT ReportID, Report FROM reports_builder WHERE (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1) ORDER BY ReportID");
        while ($row = $conn->fetch_array()) {
            $reports[] = $row;
        }

        return $reports;
    }

    public static function getReport($ReportID)
    {

        global $conn;

        $conn->query("SELECT Cond 
	              FROM   reports_builder 
	              WHERE  ReportID = $ReportID AND 
	                     (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)");
        if ($row = $conn->fetch_array()) {
            $cond = stripslashes($row['Cond']);
        } else {
            exit;
        }

        $persons = array();

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.FullName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*, d.CityName, e.DistrictName,
                  FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta
	          FROM   persons a
	                 INNER JOIN address b ON a.AddressID = b.AddressID
                         INNER JOIN address_city d ON d.CityID = b.CityID" . (!empty($_GET['CityID']) ? " AND d.CityID = " . (int)$_GET['CityID'] : "") . "
                         INNER JOIN address_district e ON e.DistrictID = d.DistrictID" . (!empty($_GET['DistrictID']) ? " AND e.DistrictID = " . (int)$_GET['DistrictID'] : "") . "
	          WHERE  $cond
	          ORDER  BY $order_by $asc_or_desc";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row;
        }

        return $persons;

    }

}

?>