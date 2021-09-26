<?php
set_time_limit(0);
define('DEBUG', 0);
error_reporting(E_ALL ^ E_NOTICE);
echo "running...\n";
function __autoload($className) {
    include('../libs/' . $className . '.php');
}

include('../libs/DB.class.php');
include('../libs/sendMail.php');

$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);


$fisiere=scandir('C:\wamp\www\hre\csv');
echo "Am gasit ".count($fisiere)."\n";
foreach($fisiere as $key=>$fisier){
	$parti=explode(".",$fisier);
	if($parti[1]=="csv"){
		$altele=explode("_",$parti[0]);
		//acum am stringul de data in $altele[1]

$nowDate = $altele[1];

$filenamePath = '../' . Config::PONTAJ_IMPORT_FILE_PATH . 'Resource_' . $nowDate . '.csv';
echo $filenamePath;
if (file_exists($filenamePath)) {
    $row = 1;
    if (($handle = fopen($filenamePath, "r")) !== FALSE) {
        while (($data = fgetcsv($handle, 1000, ";")) !== FALSE) {
			
			// get personID by CNP
            $conn->query("SELECT PersonID FROM persons WHERE CNP = '" . $data[0] . "'");
            $rowPerson = $conn->fetch_array();
            if ($rowPerson) {
                $personId = $rowPerson['PersonID'];
				
				// get costCenter ID if exists, else add it to db
                $conn->query("SELECT CostCenterID FROM costcenter WHERE CostCenter = '" . $data[2] . "'");
                $rowCostCenter = $conn->fetch_array();
                if ($rowCostCenter)
                    $costCenterId = $rowCostCenter['CostCenterID'];
                else {
                    $conn->query("INSERT INTO costcenter (CostCenter, Status, CreateDate) VALUES ('" . $data[2] . "', 1, NOW())");
                    $costCenterId = mysql_insert_id();
                }

                // check for link between cost center and person
                $conn->query("SELECT ID FROM payroll_costcenter WHERE PersonID = '" . $personId . "' AND CostCenterID = '" . $costCenterId . "'");
                $rowCostCenterToPerson = $conn->fetch_array();
                if (!$rowCostCenterToPerson)
                    $conn->query("INSERT INTO payroll_costcenter (PersonID, CostCenterID, CreateDate) VALUES ('" . $personId . "', '" . $costCenterId . "', NOW())");

                // get division ID if exists, else add it to db
                $conn->query("SELECT DivisionID FROM divisions WHERE Code = '" . $data[3] . "'");
                $rowDivision = $conn->fetch_array();
                if ($rowDivision)
                    $divisionId = $rowDivision['DivisionID'];
                else {
                    $conn->query("INSERT INTO divisions (Division, Code, Status, CreateDate) VALUES ('" . $data[3] . "', '" . $data[3] . "', 1, NOW())");
                    $divisionId = mysql_insert_id();
                }

                //update Division in payroll
                $conn->query("UPDATE payroll SET DivisionID = '" . $divisionId . "' WHERE PersonID = '" . $personId . "'");

                $conn->query("SELECT WorkNorm, WorkStartHour FROM payroll WHERE PersonID = '" . $personId . "'");
                $rowPayroll = $conn->fetch_array();

                $workDate = substr($data[4], 4, 4) . '-' . substr($data[4], 2, 2) . '-' . substr($data[4], 0, 2);
                switch ($data[6]) {
                    case "ZI":
                        $workHours = $rowPayroll['WorkNorm'];
                        break;
                    case "ORA":
                        $workHours = $data[5];
                        break;
                }

                //insert data in pontaj_detail
                $conn->query("INSERT INTO pontaj_detail (UserID, PersonID, StartDate, StartHour, EndDate, EndHour, Hours, Hours2, CostCenterID, Type, Status, CreateDate, LastUpdateDate)
                            VALUES (1, '" . $personId . "', '" . $workDate . "', '" . $rowPayroll['WorkStartHour'] . "', '" . $workDate . "', '" . date('H:i', strtotime($rowPayroll['WorkStartHour'] . "+" . $workHours . " hours")) . "', '" . $workHours . "', '', '" . $costCenterId . "', 1, 1, NOW(), NOW())");
            } else {
                // cnp isn't in db
            }

        }
        fclose($handle);

        if (!is_dir('../' . Config::PONTAJ_IMPORT_FILE_PATH . 'imported'))
            mkdir('../' . Config::PONTAJ_IMPORT_FILE_PATH . 'imported');
        rename($filenamePath, '../' . Config::PONTAJ_IMPORT_FILE_PATH . 'imported/Resource_' . $nowDate . '.csv');
    }
} else {
    // file not found
}
}//endif csv
}//endforach
?>