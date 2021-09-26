<?php

class ReportMaker
{

    public static $msCategories = array(
        1 => 'Administrare personal',
        2 => 'Companie',
        3 => 'Recrutare',
        4 => 'Training',
        5 => 'Pontaj',
        6 => 'HR',
        7 => 'Managementul performantei',
    );

    public static $msFields = array(
        1 => array(
            'persons__LastName' => 'Nume',
            'persons__FirstName' => 'Prenume',
            'persons__FullNameBeforeMariage' => 'Nume inainte de casatorie',
            'payroll__EmpCode' => 'Marca',
            'persons__CNP' => 'CNP',
            'persons__DateOfBirth' => 'Data nastere',
            'Age' => 'Varsta',
            'persons__Sex' => 'Sex',
            'persons__Status' => 'Status',
            'persons__Nationality' => 'Nationalitate',
            'persons__BIStopDate' => 'CI - expirare data',
            'address_country__Country' => 'Tara',
            'address_district__County' => 'Judet',
            'address_city__City' => 'Localitate',
            'address__Address' => 'Adresa (strada, nr, bl, sc, et, ap)',
            'persons__MaritalStatus' => 'Stare civila',
            'persons__NumberOfChildren' => 'Numar copii',
            'persons__Religion' => 'Religie',
            'persons_intretinere__Nume' => 'Persoane in intretinere - Nume persoana',
            'persons_intretinere__CNP' => 'Persoane in intretinere - CNP persoana',
            'persons_intretinere__DataIni' => 'Persoane in intretinere - perioada',
            'persons__EducationalLevel' => 'Nivel de instruire',
            'persons__Studies' => 'Pregatire',
            'FirmWorkTime' => 'Vechime in firma',
            'persons__WorkTime' => 'Vechime totala in munca',
            'persons__DrivingCategory' => 'Permis conducere - categorie',
            'persons__DrivingStopDate' => 'Permis conducere - data expirare',
            'payroll_costcenter__CostCenterID' => 'Centru de cost',
            'payroll__DirectManagerID' => 'Manager direct',
            'payroll__CompanyID' => 'Companie',
            'payroll__DivisionID' => 'Divizie',
            'payroll__DepartmentID' => 'Departament',
            'payroll__SubDepartmentID' => 'Subdepartament',
        ),
        /*
        2 => array(
            'companies__CompanyName' 		=> 'Nume',
            'address_district__County'		=> 'Judet',
            'address_city__City'			=> 'Localitate',
            'address__Address'			=> 'Adresa (strada, nr, bl, sc, et, ap)',
            'companies__CompanyDomainID'		=> 'Domeniu de activitate',
            'companies__CIF'			=> 'CUI',
            'companies__RegComert'			=> 'Nr. Registrul Comertului',
            'companies_contacts__ContactName'	=> 'Persoana de contact - Nume',
            'companies_contacts__ContactPhone'	=> 'Persoana de contact - telefon',
            'companies_contacts__ContactEmail'	=> 'Persoana de contact - email',
            'companies_contacts__ContactFunction'	=> 'Persoana de contact - functie',
            'companies__BankAccount'		=> 'IBAN',
            'companies__BankName'			=> 'IBAN - Banca',
            'companies__isTrainer'			=> 'Servicii training',
            'companies__TrainingTypeID'		=> 'Tipuri training',
            'companies__isAssurance'		=> 'Servicii asigurari/beneficii',
            'companies__EmployeesNo'		=> 'Numar angajati',
            ),

        3 => array(
            'CVSource' => 'Sursa CV',
            ),

        4 => array(
            'Training' => 'Denumire training',
            ),

        5 => array(
            'ProjectName' => 'Nume proiect',
            ),

        6 => array(
            'Type' => 'Tip cerere',
            ),

        7 => array(
            'Dim' => 'Obiectiv - Dimensiunea HCM',
            ),
        */
    );

    public static function getFieldsValues()
    {
        $countriesArr = Utils::getCountries();
        foreach ($countriesArr as $k => $v) {
            $countries[$k] = $v['CountryName'];
            if (!empty($v['Nationality'])) {
                $nationality[$k] = $v['Nationality'];
            }
        }
        $districts = Address::getDistricts();
        $fields_values = array(
            'persons__Sex' => array('M' => 'M', 'F' => 'F'),
            'persons__Status' => ConfigData::$msStatus,
            'persons__Nationality' => $nationality,
            'persons__MaritalStatus' => '',
            'persons__Religion' => ConfigData::$msReligion,
            'address_country__Country' => $countries,
            'address_district__County' => $districts,
            'address_city__City' => array(),
            'persons__MaritalStatus' => ConfigData::$msMaritalStatus,
            'persons__EducationalLevel' => ConfigData::$msEducationalLevel,
            'persons__Studies' => ConfigData::$msStudies,
            'persons__DrivingCategory' => array('A', 'B', 'C', 'D', 'E'),
            'payroll_costcenter__CostCenterID' => Utils::getCostCenter(),
            'companies__CompanyDomainID' => Job::getJobDomains(),
            'payroll__DirectManagerID' => Person::getPersonsByRole(1),
            'payroll__CompanyID' => Job::getCompanies(),
            'payroll__DivisionID' => '',
            'payroll__DepartmentID' => '',
        );
        return $fields_values;
    }

    public static function saveReport()
    {

        global $conn;

        $cond = self::buildCond();

        $conn->query("INSERT INTO reports_builder(UserID, Type, Cond, Report, Fields, FieldsOperators, FieldsValues, FieldsValues2) 
	              VALUES({$_SESSION['USER_ID']}, 0, \"" . Utils::formatStr($cond) . "\", '" . Utils::formatStr($_POST['report']) . "',
		      '" . serialize($_SESSION['REPORT_MAKER']['FIELDS']) . "', 
		      '" . serialize($_POST['operators']) . "', 
		      '" . serialize($_POST['values']) . "', 
		      '" . serialize($_POST['values2']) . "')");
    }

    private static function buildCond()
    {
        $fields_references = self::getFieldsReferences();
        $cond = "SELECT ";
        $join = "";
        $where = "WHERE 1=1 ";
        $i = 0;
        foreach ($_POST['operators'] as $k => $operators) {
            $i++;
            $j = 0;
            foreach ($operators as $field => $operator) {
                $j++;
                $table_name = substr($field, 0, strpos($field, '__'));
                $table_field = substr($field, strpos($field, '__') + 2);
                switch ($table_name) {
                    case 'persons':
                        $table_calif = "a";
                        break;
                    case 'payroll':
                        $table_calif = "b";
                        break;
                    default:
                        $table_calif = "x{$i}{$j}";
                        $join .= " LEFT JOIN {$table_name} {$table_calif} ON a.PersonID = {$table_calif}.PersonID";
                        break;
                }
                if (isset($fields_references[$field])) {
                    $join .= " " . str_replace(array("[x]", "[y]"), array($table_calif, "y{$i}{$j}"), $fields_references[$field]['join']);
                }
                $cond .= (isset($fields_references[$field]) ? "y{$i}{$j}." . $fields_references[$field]['field'] : $table_calif . '.' . $table_field) . ', ';
                if (!empty($_POST['values'][$k][$field])) {
                    $where .= " AND ({$table_calif}.{$table_field} {$operator} '{$_POST['values'][$k][$field]}' " . (!empty($_POST['values2'][$k][$field]) ? " AND '{$_POST['values2'][$k][$field]}'" : "") . ")";
                }
            }
        }
        echo $cond = substr($cond, 0, -2) . " FROM persons a INNER JOIN payroll b ON a.PersonID = b.PersonID {$join} {$where}";
        return $cond;
    }

    public static function getFieldsReferences()
    {
        $fields_references = array(
            'payroll_costcenter__CostCenterID' => array(
                'field' => 'CostCenter',
                'join' => 'LEFT JOIN costcenter [y] ON [x].CostCenterID = [y].CostCenterID',
            ),
            'payroll__DirectManagerID' => array(
                'field' => 'FullName',
                'join' => 'LEFT JOIN persons [y] ON b.DirectManagerID = [y].PersonID',
            ),
            'payroll__CompanyID' => array(
                'field' => 'CompanyName',
                'join' => 'LEFT JOIN companies [y] ON b.CompanyID = [y].CompanyID',
            ),
        );
        return $fields_references;
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

        $results = array();

        $conn->query("SELECT *
	              FROM   reports_builder 
	              WHERE  ReportID = $ReportID AND 
	                     (UserID = {$_SESSION['USER_ID']} OR {$_SESSION['USER_ID']} = 1)");
        if ($row = $conn->fetch_array()) {
            $cond = stripslashes($row['Cond']);
            $_SESSION['REPORT_MAKER']['FIELDS'] = unserialize($row['Fields']);
            $_SESSION['REPORT_MAKER']['FIELDS_OPERATORS'] = unserialize($row['FieldsOperators']);
            $_SESSION['REPORT_MAKER']['FIELDS_VALUES'] = unserialize($row['FieldsValues']);
            $_SESSION['REPORT_MAKER']['FIELDS_VALUES2'] = unserialize($row['FieldsValues2']);
        } else {
            return;
        }

        $conn->query($cond);
        while ($row = $conn->fetch_array()) {
            $results[] = $row;
        }

        return $results;
    }

    public static function getResults()
    {

        global $conn;

        $cond = self::buildCond();
        $conn->query($cond);
        while ($row = $conn->fetch_array()) {
            $results[] = $row;
        }

        return $results;
    }
}

?>