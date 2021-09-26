<?php


set_time_limit(0);

function __autoload($className)
{
    include('../libs/' . $className . '.php');
}

include('../libs/DB.class.php');
include('../libs/sendMail.php');
include('../libs/ConfigData.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);


/*$age_stamp = array(19,19,18,18,20,20);
$contract_type = array("Determinata" => 1, "Nedeterminata" => 2);

$persons = array();
$cm = array();
$co = array();
$healthcomp = array_flip(ConfigData::$msHealthCompanies);
$pontaj = array();
$intretinere = array();

$conn->query("SELECT b.*, a.Gender, a.Marca, a.Serie, a.Numar, a.Emis, a.Data, a.Nr_data_cim, a.Perioada_cim, a.Data_expirare FROM imp_personal_db b LEFT JOIN imp_personal a ON b.CNP = a.CNP");

while($row = $conn->fetch_array()){
    $row['Nume'] = ucwords(strtolower(preg_replace('([^A-Za-z]+)', ' ', $row['Nume'])));
    $row['Prenume'] = ucwords(strtolower(preg_replace('([^A-Za-z]+)', ' ', $row['Prenume'])));
    if($row['CAS'] == 'CASMB'){
        $row['CAS'] = $healthcomp['CASMB'];
    }
    elseif($row['CAS'] == 'OPSNAJ'){
        $row['CAS'] = $healthcomp['AOPSNAJ'];
    }
    elseif($row['CAS'] == 'CAST'){
        $row['CAS'] = $healthcomp['CASMTCT'];
    }
    else{
        $row['CAS'] = ucwords(strtolower($row['CAS']));
        if(isset($healthcomp['CAS '.$row['CAS']])){
            $row['CAS'] = $healthcomp['CAS '.$row['CAS']];
        }
        elseif(isset($healthcomp['CJAS '.$row['CAS']])){
            $row['CAS'] = $healthcomp['CJAS '.$row['CAS']];
        }
        
    }
    $persons[] = $row;
}

$conn->query("SELECT * FROM imp_cm");

while($row = $conn->fetch_array()){
    $cm[$row['CNP']][] = $row;
}

$conn->query("SELECT * FROM imp_co");

while($row = $conn->fetch_array()){
    $co[$row['CNP']] = $row;
}

$conn->query("SELECT * FROM imp_pontaj ORDER BY CNP, Luna");

while($row = $conn->fetch_array()){
    $pontaj[$row['CNP']][$row['Luna']] = $row;
}

$conn->query("SELECT * FROM imp_intretinere ORDER BY CNP, CNP_pers");

while($row = $conn->fetch_array()){
    $intretinere[$row['CNP']][] = $row;
}


//Utils::pa($pontaj);exit;

$conn->query("TRUNCATE TABLE address");
$conn->query("TRUNCATE TABLE persons");
$conn->query("TRUNCATE TABLE divisions");
$conn->query("TRUNCATE TABLE departments");
$conn->query("TRUNCATE TABLE persons_salary");
$conn->query("TRUNCATE TABLE payroll");
$conn->query("TRUNCATE TABLE vacations");
$conn->query("TRUNCATE TABLE vacations_details");
$conn->query("TRUNCATE TABLE pontaj_detail");
$conn->query("TRUNCATE TABLE persons_intretinere");


foreach($persons as $person){
    $conn->query("INSERT INTO address(UserID, CityID) VALUES(1, 2675)");
    $address_id = $conn->get_insert_id();
    
    $conn->query("SELECT DivisionID FROM divisions WHERE Division = '".$person['Divizie']."'");
    $row = $conn->fetch_array();
    $division_id = $row['DivisionID'];
    if(empty($division_id)){
        $conn->query("INSERT INTO divisions(Division, Status, CreateDate) VALUES('".$person['Divizie']."', 1, CURRENT_TIMESTAMP)");
        $division_id = $conn->get_insert_id();
    }
    unset($row);
    
    $conn->query("SELECT DepartmentID FROM departments WHERE Department = '".$person['Departament']."' AND DivisionID = '".$division_id."'");
    $row = $conn->fetch_array();
    $department_id = $row['DepartmentID'];
    if(empty($department_id)){
        $conn->query("INSERT INTO departments(DivisionID, Department, Status, CreateDate) VALUES('".$division_id."', '".$person['Departament']."', 1, CURRENT_TIMESTAMP)");
        $department_id = $conn->get_insert_id();
    }
    unset($row);
    
    
    $bistart_date = date('Y-m-d', strtotime(preg_replace('([^0-9]+)', '-', $person['Data'])));
    $dob = $age_stamp[substr($person['CNP'], 0, 1)-1].substr($person['CNP'], 1, 2)."-".substr($person['CNP'], 3, 2)."-".substr($person['CNP'], 5, 2);
    
    $conn->query("INSERT INTO persons(UserID, RoleID, Status, SubStatus, LastName, FirstName, FullName, CNP, Sex, AddressID, BINumber, BISerie, BIStartDate, BIEmitent, DateOfBirth, Email, CreateDate, LastUpdateDate)
                    VALUES(1, 15, 2, 1, '{$person['Nume']}', '{$person['Prenume']}', '{$person['Nume']} {$person['Prenume']}', '{$person['CNP']}', '{$person['Gender']}', '{$address_id}', '{$person['Numar']}', '{$person['Serie']}', '{$bistart_date}', '{$person['Emis']}', '{$dob}', '{$person['Email']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                    
    $person_id = $conn->get_insert_id();
    
    $cim_exp_date = !empty($person['Data_expirare']) ? date('Y-m-d', strtotime(preg_replace('([^0-9]+)', '-', $person['Data_expirare']))) : '';
    $start_date = !empty($person['DataAngajare']) ? date('Y-m-d', strtotime($person['DataAngajare'])) : '';
    $cim_parts = explode('/', $person['Nr_data_cim']);
    $cim_number = $cim_parts[0];
    $cim_start_date = !empty($cim_parts[1]) ? date('Y-m-d', strtotime($cim_parts[1])) : '';
    unset($cim_parts);
    
    $conn->query("INSERT INTO payroll(UserID, PersonID, EmpCode, StartDate, ContractType, ContractNo, ContractDate, ContractExpDate, WorkStartHour, WorkNorm, LunchBreakStartHour, LunchBreakEndHour, CompanyID, DivisionID, DepartmentID, HealthCompanyID, CreateDate, LastUpdateDate)
                    VALUES(1, '{$person_id}', '{$person['Marca']}', '{$start_date}', '{$contract_type[$person['Perioada_cim']]}', '{$cim_number}', '{$cim_start_date}', '{$cim_exp_date}', '06:00', '{$person['Norma']}', '00:00', '00:15', 1, '{$division_id}', '{$department_id}', '{$person['CAS']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
    
    
    $conn->query("INSERT INTO persons_salary(PersonID, Salary, SalaryNet, Currency, StartDate, StopDate, CreateDate, LastUpdateDate)
                    VALUES('{$person_id}', '{$person['Brut']}', '{$person['Net']}', 'RON', '{$start_date}', '{$cim_exp_date}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
 
    if(!empty($co[$person['CNP']])){
        $vacation = $co[$person['CNP']];
    
        $conn->query("INSERT INTO vacations(UserID, PersonID, Year, TotalCO, TotalCORef, ReportDateLimit, VacRecalc, Closed, CreateDate)
                        VALUES(1, '{$person_id}', '2012', '{$vacation['CO2012']}', '{$vacation['Teoretic']}', '2012-12-31', 1, 1, CURRENT_TIMESTAMP)");
                        
        $conn->query("INSERT INTO vacations(UserID, PersonID, Year, TotalCO, TotalCORef, ReportDateLimit, VacRecalc, Closed, CreateDate)
                        VALUES(1, '{$person_id}', '2013', '{$vacation['Efectiv']}', '{$vacation['Teoretic']}', '2013-12-31', 1, 0, CURRENT_TIMESTAMP)");
    }
                    
                    
                    
    if(!empty($cm[$person['CNP']]))
    foreach($cm[$person['CNP']] as $medical){
        $days_no = Utils::getDaysDiff($medical['DataInceputCM'], $medical['DataSfarsitCM'], false, false);
        $conn->query("INSERT INTO vacations_details(UserID, PersonID, Aprove, Year, StartDate, StopDate, Type, DaysNo, CodInd, TipCertif, CodCertif, CreateDate)
                        VALUES(1, '{$person_id}', 1, '2013', '{$medical['DataInceputCM']}', '{$medical['DataSfarsitCM']}', 'CM', '{$days_no}', '{$medical['CodIndemnizatie']}', '{$medical['SeriaCertif']}', '{$medical['NrCertif']}', CURRENT_TIMESTAMP)");
    }
    
    
    
    if(!empty($pontaj[$person['CNP']])){
        $vacation = array();
        foreach($pontaj[$person['CNP']] as $month => $p){
            $eom = date('t', strtotime($month."-01"));
            
            foreach(range(1, $eom) as $day){
                $xday = $month."-".str_pad($day, 2, '0', STR_PAD_LEFT);
                $dval = $p[$day];
               
                
                if(!empty($vacation)){
                    if((!empty($dval) && $vacation['Type'] != $dval) || (empty($dval) && !in_array(date('w', strtotime($xday)), array(0,6)))){
                        
                        $days_no = Utils::getDaysDiff($vacation['StartDate'], $vacation['StopDate']);
                        $conn->query("INSERT INTO vacations_details(UserID, PersonID, Aprove, Year, StartDate, StopDate, Type, DaysNo, CreateDate)
                                    VALUES(1, '{$person_id}', 1, '2013', '{$vacation['StartDate']}', '{$vacation['StopDate']}', '{$vacation['Type']}', '{$days_no}', CURRENT_TIMESTAMP)");
                        $vacation = array();
                    }
                }

                if(!empty($dval)){
                    if(in_array($dval, array('CO', 'CFS', 'CE', 'CS'))){
                        if(!empty($vacation)){
                            if($vacation['Type'] == $dval){
                                $vacation['StopDate'] = $xday;
                            }
                        }
                        else{
                            $vacation = array("StartDate" => $xday, "StopDate" => $xday, "Type" => $dval);
                        }
                    }
                    elseif(is_numeric($dval)){
                        $endh = date('H:i', strtotime($xday." 06:00 +".$dval." hour"));

                        $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Type, CreateDate, LastUpdateDate)
                                        VALUES(1, '{$person_id}', '{$xday}', '06:00', '{$xday}', '{$endh}', '{$dval}', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                    }
                    elseif($dval == "A"){
                        $endh = date('H:i', strtotime($xday." 06:00 +".$person['Norma']." hour"));

//                        $conn->query("INSERT INTO pontaj_detail(UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Type, CreateDate, LastUpdateDate)
//                                        VALUES(1, '{$person_id}', '{$xday}', '06:00', '{$xday}', '{$endh}', '0', 5, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
                    }
                }
                
            }
        }
    }
    
    if(!empty($intretinere[$person['CNP']])){
        $quality = array_flip(ConfigData::$msQuality);
        $coassured = array_flip(ConfigData::$msCoAssured);
        
        foreach($intretinere[$person['CNP']] as $int){
            $conn->query("INSERT INTO persons_intretinere(UserID, PersonID, Nume, Calitate, Coasigurat, CNP, Active, CreateDate, LastUpdateDate)
                            VALUES(1, '{$person_id}', '".ucwords(strtolower(preg_replace('([^A-Za-z]+)', ' ', $int['Nume_pers'])))."', '".$quality[$int['Calitate']]."', '".$coassured[$int['Coasigurat']]."', '{$int['CNP_pers']}', 1, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)");
        }
    }
    
    
}*/
echo "<pre>";

/*$_nivel1ID = 0;
$_nivel2ID = 0;
$_nivel3ID = 0;
if (($handle = fopen("organigrama.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, "|||")) !== FALSE) {

        print_r($data);
        switch ($data[3]) {
            case "1":
                $conn->query("INSERT INTO divisions (Division, Status, CreateDate) VALUES ('".$conn->real_escape_string($data[0])."', '1', 'NOW()')");
                $_nivel1ID = $conn->get_insert_id();
                break;
            case "2":
                $conn->query("INSERT INTO departments (Department, Status, CreateDate, DivisionID) VALUES ('".$conn->real_escape_string($data[0])."', '1', 'NOW()', '".$_nivel1ID."')");
                $_nivel2ID = $conn->get_insert_id();
                break;
            case "3":
                $conn->query("INSERT INTO subdepartments (SubDepartment, Status, CreateDate, DepartmentID) VALUES ('".$conn->real_escape_string($data[0])."', '1', 'NOW()', '".$_nivel2ID."')");
                $_nivel3ID = $conn->get_insert_id();
                break;
            case "4":
                $conn->query("INSERT INTO subsubdepartments (SubSubDepartment, Status, CreateDate, SubDepartmentID) VALUES ('".$conn->real_escape_string($data[0])."', '1', 'NOW()', '".$_nivel3ID."')");
                break;
        }

    }
    fclose($handle);
}/**/
$conn->query("TRUNCATE internal_functions");
$conn->query("TRUNCATE internal_functions_attr");

if (($handle = fopen("importCoef.csv", "r")) !== FALSE) {
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {

        print_r($data);
//        die();
        $existingFuncRes = $conn->fetch_array($conn->query("SELECT * FROM internal_functions WHERE Function = '".$data[0]."'"));

        if(isset($existingFuncRes) && $existingFuncRes["FunctionID"] > 0) {
            $_FunctionID = $existingFuncRes["FunctionID"];
        }
        else
        {
            $conn->query("INSERT INTO internal_functions (Function, GroupID, Status, CreateDate) VALUES ('".$data[0]."', '".($data[5] == "C" ? 3 : ($data[5] == "P" ? 4 : ""))."', 1, NOW())");
            $_FunctionID = $conn->get_insert_id();
        }
        $conn->query("INSERT INTO internal_functions_attr (FunctionID, Gradatie, GradTreapta, Studii, Coeficient) VALUES ('".$_FunctionID."', '".($data[3]+1)."', '".array_search($data[1], ConfigData::$gradTreapta)."', '".array_search($data[2], ConfigData::$funcStud)."', '".$data[4]."')");
        //Utils::_debug($existingFuncRes);
        //die();


    }
}
fclose($handle);
/**/

?>
