<?php

class Candidate extends ConfigData
{

    private $PersonID;

    public function __construct($PersonID = 0)
    {
        if ($PersonID > 0) {
            $this->PersonID = $PersonID;
        }
    }

    public static function getPersonsByCM($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][4]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][13][1][4]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $cm = array();

        $conn->query("SELECT FullName, Status, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw FROM candidates_internal a WHERE PersonID = $PersonID AND ($condbase)");
        if ($row = $conn->fetch_array()) {
            $cm[0] = $row;
            $cm[0]['zile'] = 0;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        $conn->query("SELECT ID, Functie, Companie, DataIni AS StartDate, DataFin AS EndDate, DATEDIFF(DataFin, DataIni) AS zile,
		                     DATE_FORMAT(DataIni, '%d.%m.%Y') AS DataIni, DATE_FORMAT(DataFin, '%d.%m.%Y') AS DataFin
		              FROM   candidates_internal_cm
		              WHERE  PersonID = $PersonID");
        while ($row = $conn->fetch_array()) {
            /*
            $cm[0]['zile'] += $row['zile'];
            $row['years']   = floor($row['zile'] / 365);
            $rest           = $row['zile'] % 365;
            $row['months']  = floor($rest / 30);
            $row['days']    = $rest % 30;
            */
            $arr = Utils::dateDiff2YMD($row['StartDate'], $row['EndDate']);
            $row['years'] = $arr[0];
            $row['months'] = $arr[1];
            $row['days'] = $arr[2];
            $cm[$row['ID']] = $row;
            $cm[0]['days'] += $row['days'];
            $cm[0]['months'] += $row['months'];
            $cm[0]['years'] += $row['years'];
        }
        /*
        $cm[0]['years']  = floor($cm[0]['zile'] / 365);
        $rest            = $cm[0]['zile'] % 365;
        $cm[0]['months'] = floor($rest / 30);
        $cm[0]['days']   = $rest % 30;
        */
        $months = floor($cm[0]['days'] / 30);
        $cm[0]['cdays'] = $cm[0]['days'] % 30;
        $months = $cm[0]['months'] + $months;
        $cm[0]['cmonths'] = $months % 12;
        $cm[0]['cyears'] = $cm[0]['years'] + floor($months / 12);

        return $cm;
    }

    public static function setPersonsByCM($PersonID)
    {

        global $conn;

        switch ($_GET['action']) {
            case 'new_cm':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $query = "INSERT INTO candidates_internal_cm(UserID, PersonID, Functie, Companie, DataIni, DataFin, CreateDate, LastUpdateDate)
			          VALUES({$_SESSION['USER_ID']}, $PersonID, '" . Utils::formatStr($_POST['Functie']) . "',
			                  '" . Utils::formatStr($_POST['Companie']) . "',
			                  '{$_POST['StartDate']}', '{$_POST['StopDate']}', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
                break;
            case 'edit_cm':
                $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
                $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);
                $query = "UPDATE candidates_internal_cm SET
			        				Functie        = '" . Utils::formatStr($_POST['Functie']) . "',
			                			Companie       = '" . Utils::formatStr($_POST['Companie']) . "',
			                                        DataIni        = '{$_POST['StartDate']}',
			                                        DataFin        = '{$_POST['StopDate']}',
			                                        LastUpdateDate = CURRENT_TIMESTAMP
			          WHERE  ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
            case 'del_cm':
                $query = "DELETE FROM candidates_internal_cm WHERE ID = '{$_GET['ID']}' AND PersonID = $PersonID";
                break;
        }
        $conn->query($query);
    }

    public static function getMilitary($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][3]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][13][1][3]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FullName, a.Status, b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	                  FROM   candidates_internal a
	                         LEFT JOIN candidates_internal_military b ON a.PersonID = b.PersonID
	                  WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getAntropometrie($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][5]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][5]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FullName, a.Status, b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   candidates_internal a
                         LEFT JOIN candidates_internal_antropometrie b ON a.PersonID = b.PersonID
                  WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getRecruiterEval($PersonID)
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][7]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][7]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.FullName, a.Status, b.*, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   candidates_internal a
                         LEFT JOIN candidates_internal_recruiter b ON a.PersonID = b.PersonID
                  WHERE  a.PersonID = $PersonID AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function getLocalitatiByCV()
    {
        global $conn;
        $localitati = array();
        $conn->query("SELECT DISTINCT City FROM candidates_internal_prof WHERE City > '' ORDER BY City");
        while ($row = $conn->fetch_array()) {
            $localitati[] = $row['City'];
        }
        return $localitati;
    }

    public static function getTariByCV()
    {
        global $conn;
        $tari = array();
        $conn->query("SELECT DISTINCT Country FROM candidates_internal_prof WHERE Country > '' ORDER BY Country");
        while ($row = $conn->fetch_array()) {
            $tari[] = $row['Country'];
        }
        return $tari;
    }

    public static function exportToPersons($CandidateID = 0)
    {
        global $conn;

        if ($CandidateID > 0) {

            $username = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 12);
            $password = substr(str_shuffle(str_repeat('ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz0123456789', 5)), 0, 12);

            // Insert person Data
            $query = "INSERT INTO persons 
       					(UserID,				     PID				,AddressID,Status,SubStatus,Qualify,LastName,FirstName,FullName,FullNameBeforeMariage,CNP,Sex,BINumber,BISerie,BIStartDate,BIStopDate,BIEmitent,DateOfBirth,Phone,Mobile,Fax,Email,MaritalStatus,MaritalStatusNotes,NumberOfChildren,Notes,JobDictionaryID,Studies,EducationalLevel,WorkTime,WorkTimeAt,LastJobTime,DrivingLicense,DrivingCategory,DrivingNo,DrivingSerie,DrivingStartDate,DrivingStopDate,DrivingNotes,ProfNotes,CVQualifRel,CVCourses,CVSkills,CVHobby,CVStatus,ModulIT,ModulOthers,CPFullName,CPAddress,CPPhone,CPMobile,CPEmail,CustomPerson1,CustomPerson2,CustomPerson3,CVSource,CVSourceRecc,CVSourceDetails,CreateDate		 ,LastUpdateDate	,Username 	,Password	,ImportStatus,ImportCode										,MotherFirstName,MotherLastName,FatherFirstName,FatherLastName,Religion,Nationality,Country,Trainer,AuthMessageType,AuthMessageBody,ChgPwLastDate) 
					  SELECT 
       				  	 '{$_SESSION['USER_ID']}', '{$_SESSION['PERS']}',AddressID,8	 ,SubStatus,Qualify,LastName,FirstName,FullName,FullNameBeforeMariage,CNP,Sex,BINumber,BISerie,BIStartDate,BIStopDate,BIEmitent,DateOfBirth,Phone,Mobile,Fax,Email,MaritalStatus,MaritalStatusNotes,NumberOfChildren,Notes,JobDictionaryID,Studies,EducationalLevel,WorkTime,WorkTimeAt,LastJobTime,DrivingLicense,DrivingCategory,DrivingNo,DrivingSerie,DrivingStartDate,DrivingStopDate,DrivingNotes,ProfNotes,CVQualifRel,CVCourses,CVSkills,CVHobby,CVStatus,ModulIT,ModulOthers,CPFullName,CPAddress,CPPhone,CPMobile,CPEmail,CustomPerson1,CustomPerson2,CustomPerson3,CVSource,CVSourceRecc,CVSourceDetails,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP ,'$username','$password',1			 ,MD5(CONCAT_WS(' ',FirstName,LastName,PersonID)),MotherFirstName,MotherLastName,FatherFirstName,FatherLastName,Religion,Nationality,Country,Trainer,AuthMessageType,AuthMessageBody,CURRENT_TIMESTAMP 
					  FROM candidates_internal b WHERE b.PersonID='$CandidateID'";
            $conn->query($query);
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_PERSON'));
            } else {
                $PersonID = $conn->get_insert_id();
            }

            if ($PersonID > 0) {
                // Insert antropometrie
                $query = "INSERT INTO persons_antropometrie
	    					(UserID					,PersonID	  ,Grupa_sangvina,HR,Greutate,Inaltime,Masura_casca,Masura_manusi,Masura_haine,Masura_pantaloni,Masura_pantofi,CreateDate		,LastUpdateDate)
	    				  SELECT 
	    				  	'{$_SESSION['USER_ID']}','$PersonID',Grupa_sangvina,HR,Greutate,Inaltime,Masura_casca,Masura_manusi,Masura_haine,Masura_pantaloni,Masura_pantofi,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP
	    				  FROM candidates_internal_antropometrie b WHERE b.PersonID='$CandidateID'";
                $conn->query($query);

                // Insert military
                $query = "INSERT INTO persons_military
	    					(UserID					,PersonID	  ,MilStatus,StartDate,StopDate,Type,Position,Livret,Grad,Arm,Notes,CreateDate		 ,LastUpdateDate)
	    				  SELECT 
	    				  	'{$_SESSION['USER_ID']}','$PersonID',MilStatus,StartDate,StopDate,Type,Position,Livret,Grad,Arm,Notes,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP
	    				  FROM candidates_internal_military b WHERE b.PersonID='$CandidateID'";
                $conn->query($query);

                //****** Multiple rows inserts

                // Insert gun permits
                $query = "SELECT PermisID FROM candidates_internal_permis_arma WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_permis_arma
	    					(UserID					 ,PersonID	 ,Emitent,Serie,No,StartDate,StopDate,CreateDate)
	    				  SELECT
	    				  	 '{$_SESSION['USER_ID']}','$PersonID',Emitent,Serie,No,StartDate,StopDate,CURRENT_TIMESTAMP
	    				  FROM candidates_internal_permis_arma b WHERE b.PermisID='{$row['PermisID']}' ";
                    $conn->query($query);
                }
                // Insert children
                $query = "SELECT ChildID FROM candidates_internal_children WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_children
		    					(PersonID	,ChildName,ChildBirthDate,ChildCNP,CreateDate)
		    				  SELECT
		    				  	 '$PersonID',ChildName,ChildBirthDate,ChildCNP,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_children b WHERE b.ChildID='{$row['ChildID']}' ";
                    $conn->query($query);
                }

                // Insert CIM
                $query = "SELECT ID FROM candidates_internal_cm WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_cm
		    					(UserID					 ,PersonID	 ,Functie,Companie,DataIni,DataFin,CreateDate		,LastUpdateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',Functie,Companie,DataIni,DataFin,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_cm b WHERE b.ID='{$row['ID']}' ";
                    $conn->query($query);
                }

                // Insert Functions
                $query = "SELECT ID FROM candidates_internal_func_recr WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_func_recr
		    					(UserID					,PersonID,FunctionIDRecr,CreateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',FunctionIDRecr,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_func_recr b WHERE b.ID='{$row['ID']}' ";
                    $conn->query($query);
                }

                // Insert Languages
                $query = "SELECT LangID FROM candidates_internal_lang WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_lang
		    					(UserID					 ,PersonID	 ,Lang,ReadLevel,WriteLevel,SpeakLevel,CreateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',Lang,ReadLevel,WriteLevel,SpeakLevel,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_lang b WHERE b.LangID='{$row['LangID']}' ";
                    $conn->query($query);
                }

                // Insert Professional
                $query = "SELECT ProfID FROM candidates_internal_prof WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_prof
		    					(UserID					 ,PersonID	 ,Company,DomainID,FunctionIDRecr,Responsabilities,Job,City,Country,StartDate,StopDate,CreateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',Company,DomainID,FunctionIDRecr,Responsabilities,Job,City,Country,StartDate,StopDate,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_prof b WHERE b.ProfID='{$row['ProfID']}' ";
                    $conn->query($query);
                }

                // Insert Studies
                $query = "SELECT StdID FROM candidates_internal_std WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_std
		    					(UserID					 ,PersonID	 ,Institution,Specialization,DomainID,Diploma,StartDate,StopDate,CreateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',Institution,Specialization,DomainID,Diploma,StartDate,StopDate,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_std b WHERE b.StdID='{$row['StdID']}' ";
                    $conn->query($query);
                }

                // Insert Docs
                $query = "SELECT UserID, PersonID, FileName, DocID FROM candidates_internal_doc WHERE PersonID='$CandidateID'";
                $r = $conn->query($query);
                while ($row = $conn->fetch_array($r)) {
                    $query = "INSERT INTO persons_doc
		    					(UserID					 ,PersonID	 ,DocCode,DocName,DocDescr,Tags,FileName,CreateDate		  ,LastUpdateDate)
		    				  SELECT
		    				  	 '{$_SESSION['USER_ID']}','$PersonID',DocCode,DocName,DocDescr,Tags,FileName,CURRENT_TIMESTAMP,CURRENT_TIMESTAMP
		    				  FROM candidates_internal_doc b WHERE b.DocID='{$row['DocID']}' ";
                    $conn->query($query);

                    // Move the files
                    if ($row['FileName'] != '') {
                        $source_file = 'docscandidates/' . md5($row['UserID']) . '/' . md5($row['PersonID']) . '/' . str_replace(' ', '-', $row['FileName']);

                        $dest_dir = 'docspers/' . md5($_SESSION['USER_ID']) . '/' . md5($PersonID) . '/';
                        $dest_file = $dest_dir . str_replace(' ', '-', $row['FileName']);

                        if (!is_dir($dest_dir))
                            mkdir($dest_dir, 0755, true);
                        if (copy($source_file, $dest_file))
                            echo "";
                    }

                }

                return $PersonID;
            }
        }
        return false;
    }

    public static function getAllPersons($action = '')
    {

        global $conn;

        $cond = '';

        if (!empty($_GET['search_for']) && !empty($_GET['keyword'])) {
            switch ($_GET['search_for']) {
                case 'CVQualifRel';
                    $cond .= " AND a.CVQualifRel LIKE '%{$_GET['keyword']}%'";
                    break;
                case 'Responsabilities';
                    $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE Responsabilities LIKE '%{$_GET['keyword']}%')";
                    break;
                case 'Company';
                    $cond .= " AND ((a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE Company LIKE '%{$_GET['keyword']}%')) 
                    			OR (a.PersonID IN (SELECT PersonID FROM candidates_internal_cm WHERE Companie LIKE '%{$_GET['keyword']}%')) )";
                    break;
                case 'CNP';
                    $cond .= " AND a.CNP LIKE '{$_GET['keyword']}%'";
                    break;
                case 'LastName':
                    $cond .= " AND a.LastName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FirstName':
                    $cond .= " AND a.FirstName LIKE '{$_GET['keyword']}%'";
                    break;
                case 'FullNameBeforeMariage':
                    $cond .= " AND (a.FullNameBeforeMariage LIKE '{$_GET['keyword']}%' OR a.FullNameBeforeMariage LIKE '% {$_GET['keyword']}%')";
                    break;
            }
        }
        if (!empty($_GET['PostId'])) {
            $cond .= " AND (a.PostId = " . (int)$_GET['PostId'] . " OR a.PostId2 = " . (int)$_GET['PostId'] . ")";
        }
        if (!empty($_GET['Status'])) {
            $cond .= " AND a.Status = " . (int)$_GET['Status'];
        }
        if (!empty($_GET['CVStatus'])) {
            $cond .= " AND a.CVStatus = " . (int)$_GET['CVStatus'];
        }

        if (!empty($_GET['CVSource'])) {
            $cond .= " AND a.CVSource LIKE '%" . $_GET['CVSource'] . "'";
        }
        if (!empty($_GET['Qualify'])) {
            $cond .= " AND a.Qualify = " . (int)$_GET['Qualify'];
        }


        if (!empty($_GET['CityID'])) {
            $cond .= " AND d.CityID = " . (int)$_GET['CityID'];

        }
        if (!empty($_GET['DistrictID'])) {
            $cond .= " AND e.DistrictID = " . (int)$_GET['DistrictID'];

        }


        if (!empty($_GET['Sex'])) {
            $cond .= " AND a.Sex = '{$_GET['Sex']}'";
        }

        // Languages
        if (!empty($_GET['Lang'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_lang WHERE Lang = " . (int)$_GET['Lang'] . ")";
        }
        if (!empty($_GET['ReadLevel'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_lang WHERE ReadLevel = " . (int)$_GET['ReadLevel'] . ")";
        }
        if (!empty($_GET['WriteLevel'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_lang WHERE WriteLevel = " . (int)$_GET['WriteLevel'] . ")";
        }
        if (!empty($_GET['SpeakLevel'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_lang WHERE SpeakLevel = " . (int)$_GET['SpeakLevel'] . ")";
        }


        // CV data
        if (!empty($_GET['Localitate'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE City = '{$_GET['Localitate']}')";
        }

        if (!empty($_GET['Tara'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE Country = '{$_GET['Tara']}')";
        }

        if (!empty($_GET['DomainIDStd'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_std WHERE DomainID = '" . (int)$_GET['DomainIDStd'] . "')";

        }

        if (!empty($_GET['DomainIDProf'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE DomainID = '" . (int)$_GET['DomainIDProf'] . "')";

        }

        if (!empty($_GET['FunctionIDRecr'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_func_recr WHERE FunctionIDRecr = '" . (int)$_GET['FunctionIDRecr'] . "')";

        }

        if (!empty($_GET['FunctionIDRecrProf'])) {
            $cond .= " AND a.PersonID IN (SELECT PersonID FROM candidates_internal_prof WHERE FunctionIDRecr = '" . (int)$_GET['FunctionIDRecrProf'] . "')";

        }

        $res_per_page = !empty($_GET['res_per_page']) && (int)$_GET['res_per_page'] ? (int)$_GET['res_per_page'] : Config::$msResPerPage;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1 OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT COUNT(*) AS total
                   FROM   candidates_internal a
                          LEFT JOIN address b ON b.AddressID=a.AddressID
                          LEFT JOIN address_city d ON d.CityID = b.CityID
                          LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
                          INNER JOIN users g ON a.UserID = g.UserID
                   WHERE  ($condbase) $cond";
        $conn->query($query);
        $row = $conn->fetch_array();
        $pageNo = $row['total'] ? ceil($row['total'] / $res_per_page) : 1;
        $page = !empty($_GET['page']) && $_GET['page'] >= 1 && $_GET['page'] <= $pageNo ? $_GET['page'] : 1;

        $persons = array();
        $persons[0]['pageNo'] = $pageNo;
        $persons[0]['page'] = $page;

        $order_by = !empty($_GET['order_by']) ? $_GET['order_by'] : 'a.LastName, a.FirstName';
        $asc_or_desc = !empty($_GET['asc_or_desc']) && in_array($_GET['asc_or_desc'], array('asc', 'desc')) ? $_GET['asc_or_desc'] : 'asc';

        $query = "SELECT a.*,b.*, d.CityName, e.DistrictName, pers.ImportStatus, pers.PersonID AS ExportedPersonID,
	                 CASE WHEN a.DateOfBirth > '0000-00-00' THEN DATE_FORMAT(a.DateOfBirth, '%d.%m.%Y') ELSE '' END AS DateOfBirth,
                         FLOOR(DATEDIFF(CURRENT_DATE, a.DateOfBirth) / 365) AS varsta, g.UserName
	          FROM   candidates_internal a
	                 LEFT JOIN address b ON b.AddressID=a.AddressID
                     LEFT JOIN address_city d ON d.CityID = b.CityID
                     LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
                     LEFT JOIN users g ON a.UserID = g.UserID
                     LEFT JOIN persons pers ON MD5(CONCAT_WS(' ',a.FirstName,a.LastName,a.PersonID))=pers.ImportCode
	          WHERE  ($condbase) $cond
	          GROUP BY a.PersonID  
		  	  ORDER  BY $order_by $asc_or_desc " .
            (in_array($action, array('export', 'print_all')) ? '' : "LIMIT  " . ($page - 1) * $res_per_page . ", " . $res_per_page);
        $conn->query($query);
        $FirmAge = array();
        while ($row = $conn->fetch_array()) {
            $AddressName = '';
            if ($row['StreetName']) $AddressName .= 'Strada: ' . $row['StreetName'];
            if ($row['StreetCode']) $AddressName .= ', Cod postal: ' . $row['StreetCode'];
            if ($row['StreeNumber']) $AddressName .= ', Numar: ' . $row['StreeNumber'];
            if ($row['Bl']) $AddressName .= ', Bl: ' . $row['Bl'];
            if ($row['Sc']) $AddressName .= ', Bl: ' . $row['Sc'];
            if ($row['Et']) $AddressName .= ', Et: ' . $row['Et'];
            if ($row['Ap']) $AddressName .= ', Ap: ' . $row['Ap'];
            $AddressName = trim($AddressName, ',');
            $row['AddressName'] = $AddressName;
            $persons[$row['PersonID']] = $row;
        }
        return $persons;
    }

    public static function getCandidatesList($all = true)
    {

        global $conn;

        $cond = !empty($all) ? "1=1" : "status IN (1)";

        $res = array();

        $query = "SELECT PersonID, FullName FROM candidates_internal WHERE $cond ORDER BY FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $res[$row['PersonID']] = $row['FullName'];
        }

        return $res;
    }

    public function addPerson($info = array())
    {

        $AddressID = $this->setData($info);

        global $conn;

        $conn->query("INSERT INTO candidates_internal(UserID, AddressID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                      VALUES({$_SESSION['USER_ID']}, $AddressID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        } else {
            return $conn->get_insert_id();
        }
    }

    private function setData(&$info)
    {
        foreach ($info as $k => &$v) {
            if (!is_numeric($v)) {
                $v = Utils::formatStr($v);
            }
            if (substr($k, 0, 5) == 'Child') {
                unset($info[$k]);
            }
        }
        if (!$info['LastName']) {
            throw new Exception(Message::getMessage('LASTNAME_EMPTY'));
        }
        if (!$info['FirstName']) {
            throw new Exception(Message::getMessage('FIRSTNAME_EMPTY'));
        }
        if (!empty($info['CNP']) && !Utils::checkCNP($info['CNP'])) {
            throw new Exception(Message::getMessage('CNP_ERROR'));
        }
        if (!$info['DistrictID']) {
            throw new Exception(Message::getMessage('DISTRICT_EMPTY'));
        }
        if (!$info['CityID']) {
            throw new Exception(Message::getMessage('CITY_EMPTY'));
        }
        if ($info['Email'] && !Utils::checkEmail($info['Email'])) {
            throw new Exception(Message::getMessage('EMAIL_ERROR'));
        }
        /*if (!$info['MaritalStatus']) {
             throw new Exception(Message::getMessage('MARITAL_EMPTY'));
        }
        */
        $info['FullName'] = $info['FirstName'] . ' ' . $info['LastName'];
        $info['NumberOfChildren'] = (int)$info['NumberOfChildren'];
        //$info['DateOfBirth']    = '19' . $info['CNP']{1} . $info['CNP']{2} . '-' . $info['CNP']{3} . $info['CNP']{4} . '-' . $info['CNP']{5} . $info['CNP']{6};
        $info['DateOfBirth'] = !empty($info['DateOfBirth']) ? Utils::toDBDate($info['DateOfBirth']) : '';
        $info['BIStartDate'] = !empty($info['BIStartDate']) ? Utils::toDBDate($info['BIStartDate']) : '';
        $info['BIStopDate'] = !empty($info['BIStopDate']) ? Utils::toDBDate($info['BIStopDate']) : '';
        $info['CustomPerson3'] = !empty($info['CustomPerson3']) ? Utils::toDBDate($info['CustomPerson3']) : '';

        global $conn;

        $CityID = (int)$info['CityID'];
        $conn->query("SELECT AddressID
	              FROM   address
		      WHERE  CityID = $CityID AND StreetName = '{$info['StreetName']}' AND
		             StreetCode = '{$info['StreetCode']}' AND StreetNumber = '{$info['StreetNumber']}' AND
			     Bl = '{$info['Bl']}' AND Sc = '{$info['Sc']}' AND Et = '{$info['Et']}' AND Ap = '{$info['Ap']}'");
        if ($row = $conn->fetch_array()) {
            $AddressID = $row['AddressID'];
        } else {
            $conn->query("INSERT INTO address(UserID, CityID, StreetName, StreetCode, StreetNumber, Bl, Sc, Et, Ap)
                    	  VALUES({$_SESSION['USER_ID']}, $CityID, '{$info['StreetName']}', '{$info['StreetCode']}', '{$info['StreetNumber']}', '{$info['Bl']}', '{$info['Sc']}', '{$info['Et']}', '{$info['Ap']}')");
            $AddressID = $conn->get_insert_id();
        }
        unset($info['DistrictID'], $info['CityID'], $info['StreetName'], $info['StreetCode'], $info['StreetNumber'], $info['Bl'], $info['Sc'], $info['Et'], $info['Ap']);
        return $AddressID;
    }

    public function editPerson($info = array())
    {

        $AddressID = $this->setData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][1]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal a SET $update AddressID = $AddressID, LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)");
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        }
    }

    public function getPerson()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][1]}' > 0 AND
		             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
		             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
			     OR
			     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][13][1][1]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.*, d.*, cp.PostName as Post_1, CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
	                  FROM   candidates_internal a
	                         LEFT JOIN address b ON a.AddressID = b.AddressID
	                         LEFT JOIN address_city d ON d.CityID = b.CityID
							 LEFT JOIN candidate_post cp on cp.PostId=a.PostId
	                  WHERE  a.PersonID = '{$this->PersonID}' AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $hash = md5($row['PersonID']);
            if (file_exists('photos/candidates_internal/' . $hash . '.jpg')) {
                $row['photoBig'] = 'photos/candidates_internal/' . $hash . '.jpg?rn=' . rand(1, 99999999);
                if (!file_exists('photos/persons/' . $hash . '_100_100.jpg')) {
                    $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/candidates_internal/' . $hash . '.jpg', 100, 100);
                    rename('photos/_tmp/' . basename($resized), 'photos/candidates_internal/' . basename($resized));
                }
                $row['photo'] = 'photos/candidates_internal/' . $hash . '_100_100.jpg?rn=' . rand(1, 99999999);
            }
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function delPerson()
    {

        global $conn;

        $query = "DELETE
                  FROM   candidates_internal
                  WHERE  PersonID = {$this->PersonID} AND
                         {$_SESSION['USER_ID']} = 1 ";
        $conn->query($query);
        if (!$conn->get_affected_rows()) {
            echo "<body onload=\"alert('Persoana nu poate fi stearsa deoarece este implicata in alte legaturi!'); window.location.href = './?m=candidates';\"></body>";
            exit;
        } else {
            $query = "DELETE FROM candidates_internal_lang WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM candidates_internal_prof WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM candidates_internal_std WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
            $query = "DELETE FROM candidates_internal_children WHERE PersonID = {$this->PersonID}";
            $conn->query($query);
        }
    }

    public function delPersonPhoto()
    {
        if (is_file('photos/candidates_internal/' . md5($this->PersonID) . '.jpg')) {
            @unlink('photos/candidates_internal/' . md5($this->PersonID) . '.jpg');
            @unlink('photos/_tmp/' . md5($this->PersonID) . '_100_100.jpg');
        }
    }

    public function newChild()
    {

        global $conn;

        echo $query = "INSERT INTO candidates_internal_children(PersonID, ChildName, ChildBirthDate, ChildCNP, CreateDate)
    	          VALUES({$this->PersonID}, '" . Utils::formatStr($_GET['ChildName']) . "', '" . Utils::toDBDate($_GET['ChildBirthDate']) . "', '" . Utils::formatStr($_GET['ChildCNP']) . "', CURRENT_TIMESTAMP)";
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        }
        $conn->query($query);
        $query = "UPDATE candidates_internal SET NumberOfChildren = " . (int)$_GET['NumberOfChildren'] . " WHERE PersonID = {$this->PersonID}";
        $conn->query($query);
    }

    public function editChild()
    {

        global $conn;

        $query = "UPDATE candidates_internal_children SET
    	          				ChildName      = '" . Utils::formatStr($_GET['ChildName']) . "',
    	          				ChildBirthDate = '" . Utils::toDBDate($_GET['ChildBirthDate']) . "',
    	          				ChildCNP       = '" . Utils::formatStr($_GET['ChildCNP']) . "'
    	          WHERE ChildID = " . (int)$_GET['ChildID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
        if ($conn->errno == 1062) {
            throw new Exception(Message::getMessage('DUPLICATE_CNP'));
        }
    }

    public function delChild()
    {

        global $conn;

        $query = "DELETE FROM candidates_internal_children WHERE ChildID = " . (int)$_GET['ChildID'] . " AND PersonID = {$this->PersonID}";
        $conn->query($query);
        $query = "UPDATE candidates_internal SET NumberOfChildren = (SELECT COUNT(1) FROM candidates_internal_children WHERE PersonID = {$this->PersonID}) WHERE PersonID = {$this->PersonID}";
        $conn->query($query);
    }

    public function getChildren()
    {

        global $conn;

        $children = array();

        $query = "SELECT * FROM candidates_internal_children WHERE PersonID = {$this->PersonID} ORDER BY ChildID";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $children[] = $row;
        }

        return $children;
    }

    public function setMilitary($PersonID, $info = array())
    {

        global $conn;

        if (!empty($_GET['action'])) {
            foreach ($_GET as &$v) {
                if (!is_numeric($v) && !is_array($v)) {
                    $v = Utils::formatStr($v);
                }
            }
            switch ($_GET['action']) {
                case 'new':
                    $conn->query("INSERT INTO candidates_internal_permis_arma(UserID, PersonID, Emitent, Serie, No, StartDate, StopDate, CreateDate)
	    				              VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, '{$_GET['Emitent']}', '{$_GET['Serie']}', '{$_GET['No']}', '" . Utils::toDBDate($_GET['StartDate']) . "', '" . Utils::toDBDate($_GET['StopDate']) . "', CURRENT_TIMESTAMP)");
                    break;
                case 'edit':
                    $conn->query("UPDATE candidates_internal_permis_arma SET
	    				                     Emitent       = '{$_GET['Emitent']}',
	    				                     Serie         = '{$_GET['Serie']}',
	    				                     No            = '{$_GET['No']}',
	    				                     StartDate     = '" . Utils::toDBDate($_GET['StartDate']) . "',
	    				                     StopDate      = '" . Utils::toDBDate($_GET['StopDate']) . "'
	    				              WHERE  PermisID = {$_GET['PermisID']} AND PersonID = {$this->PersonID}");
                    break;
                case 'del':
                    $conn->query("DELETE FROM candidates_internal_permis_arma WHERE PermisID = {$_GET['PermisID']} AND PersonID = {$this->PersonID}");
                    break;
            }
            header('Location: ./?m=candidates&o=military&PersonID=' . $this->PersonID);
            exit;
        }

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);
        $info['StartDate'] = Utils::toDBDate($info['StartDate']);
        $info['StopDate'] = Utils::toDBDate($info['StopDate']);

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
		             OR
		             '{$_SESSION['USER_RIGHTS3'][1][1][20]}' = 2
			     OR
			     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal_military a SET $update PID='{$_SESSION['PERS']}',LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO candidates_internal_military(UserID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
	                          VALUES({$_SESSION['USER_ID']}, $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    public function getPermisArma()
    {

        global $conn;

        $conn->query("SELECT * FROM candidates_internal_permis_arma WHERE PersonID = {$this->PersonID} ORDER BY StartDate");
        $permis = array();
        while ($row = $conn->fetch_array()) {
            $permis[$row['PermisID']] = $row;
        }
        return $permis;
    }

    public function getProfExp()
    {

        global $conn;

        $conn->query("SELECT * FROM candidates_internal_prof WHERE PersonID = {$this->PersonID} ORDER BY StartDate DESC");
        $prof_exp = array();
        while ($row = $conn->fetch_array()) {
            $prof_exp[$row['ProfID']] = $row;
        }
        return $prof_exp;
    }

    public function addProfExp()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $conn->query("INSERT INTO candidates_internal_prof(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editProfExp()
    {

        global $conn;

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }

        $update = substr($update, 0, -1);
        $conn->query("UPDATE candidates_internal_prof SET $update WHERE ProfID = {$_GET['ProfID']} AND PersonID = {$this->PersonID}");
    }

    public function delProfExp()
    {
        global $conn;
        $conn->query("DELETE FROM candidates_internal_prof WHERE ProfID = {$_GET['ProfID']} AND PersonID = {$this->PersonID}");
    }

    public function getStd()
    {

        global $conn;

        $conn->query("SELECT * FROM candidates_internal_std WHERE PersonID = {$this->PersonID} ORDER BY StartDate DESC");
        $std = array();
        while ($row = $conn->fetch_array()) {
            $std[$row['StdID']] = $row;
        }
        return $std;
    }

    public function addStd()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $conn->query("INSERT INTO candidates_internal_std(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editStd()
    {

        global $conn;

        $_POST['StartDate'] = Utils::toDBDate($_POST['StartDate']);
        $_POST['StopDate'] = Utils::toDBDate($_POST['StopDate']);

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE candidates_internal_std SET $update WHERE StdID = {$_GET['StdID']} AND PersonID = {$this->PersonID}");
    }

    public function delStd()
    {
        global $conn;
        $conn->query("DELETE FROM candidates_internal_std WHERE StdID = {$_GET['StdID']} AND PersonID = {$this->PersonID}");
    }

    public function getLang()
    {

        global $conn;

        $conn->query("SELECT * FROM candidates_internal_lang WHERE PersonID = {$this->PersonID} ORDER BY LangID");
        $lang = array();
        while ($row = $conn->fetch_array()) {
            $lang[$row['LangID']] = $row;
        }
        return $lang;
    }

    public function addLang()
    {

        global $conn;

        foreach ($_POST as $k => &$v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $v = Utils::formatStr($v);
                }
            } else {
                unset($_POST[$k]);
            }
        }

        $conn->query("INSERT INTO candidates_internal_lang(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editLang()
    {

        global $conn;

        $update = '';
        foreach ($_POST as $k => $v) {
            if (!empty($v)) {
                if (!is_numeric($v)) {
                    $update .= "$k = '" . Utils::formatStr($v) . "',";
                } else {
                    $update .= "$k = $v,";
                }
            } else {
                $update .= "$k = NULL,";
            }
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE candidates_internal_lang SET $update WHERE LangID = {$_GET['LangID']} AND PersonID = {$this->PersonID}");
    }

    public function delLang()
    {
        global $conn;
        $conn->query("DELETE FROM candidates_internal_lang WHERE LangID = {$_GET['LangID']} AND PersonID = {$this->PersonID}");
    }

    public function getFuncRecr()
    {
        global $conn;
        $conn->query("SELECT ID, FunctionIDRecr FROM candidates_internal_func_recr WHERE PersonID = {$this->PersonID} ORDER BY ID");
        $func_recr = array();
        while ($row = $conn->fetch_array()) {
            $func_recr[$row['ID']] = $row['FunctionIDRecr'];
        }
        return $func_recr;
    }

    public function addFuncRecr()
    {
        global $conn;
        $conn->query("INSERT INTO candidates_internal_func_recr(UserID, PersonID, CreateDate, " . implode(',', array_keys($_POST)) . ")
                      VALUES({$_SESSION['USER_ID']}, {$this->PersonID}, now(), '" . implode("','", $_POST) . "')");
    }

    public function editFuncRecr()
    {
        global $conn;
        $update = '';
        foreach ($_POST as $k => $v) {
            $update .= "$k = $v,";
        }
        $update = substr($update, 0, -1);
        $conn->query("UPDATE candidates_internal_func_recr SET $update WHERE ID = {$_GET['ID']} AND PersonID = {$this->PersonID}");
    }

    public function delFuncRecr()
    {
        global $conn;
        $conn->query("DELETE FROM candidates_internal_func_recr WHERE ID = {$_GET['ID']} AND PersonID = {$this->PersonID}");
    }

    public function setAntropometrie($PersonID, $info = array())
    {

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][5]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal_antropometrie a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO candidates_internal_antropometrie(UserID, PID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                          VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    public function setRecruiterEval($PersonID, $info = array())
    {

        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
        unset($v);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][1][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][1][1][7]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal_recruiter a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = $PersonID AND ($condrw)");

        if (!$conn->get_affected_rows()) {

            $conn->query("INSERT INTO candidates_internal_recruiter(UserID, PID, PersonID, CreateDate, LastUpdateDate, " . implode(", ", array_keys($info)) . ")
                          VALUES({$_SESSION['USER_ID']}, '{$_SESSION['PERS']}', $PersonID, CURRENT_TIMESTAMP, CURRENT_TIMESTAMP, '" . implode("', '", $info) . "')");
        }
    }

    public function getCV()
    {

        global $conn;

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condbase = "('{$_SESSION['USER_RIGHTS3'][13][1][2]}' > 0 AND
	             (('{$_SESSION['USER_RIGHTS2'][13][1]}' = 1 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng)) OR
	             '{$_SESSION['USER_RIGHTS2'][13][1]}' > 1))
		     OR
		     {$_SESSION['USER_ID']} = 1";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $query = "SELECT a.*, b.StreetNumber, b.StreetName, b.StreetCode, d.CityName, e.DistrictName, g.CompanyName,
	                 CASE WHEN $condrw THEN 1 ELSE 0 END AS rw
                  FROM   candidates_internal a
                         LEFT JOIN address b ON a.AddressID = b.AddressID
                         LEFT JOIN address_city d ON d.CityID = b.CityID
                         LEFT JOIN address_district e ON e.DistrictID = d.DistrictID
			 LEFT JOIN payroll f ON a.PersonID = f.PersonID
			 LEFT JOIN companies g ON f.CompanyID = g.CompanyID
                  WHERE  a.PersonID = {$this->PersonID} AND ($condbase)";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            //$row['trainings'] = $this->getTrainingsByPerson();
            return $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public function editCV($info = array())
    {

        $this->setCVData($info);

        global $conn;

        $update = '';
        foreach ($info as $k => $v) {
            $update .= "$k = '$v', ";
        }

        $condmng = $_SESSION['ROLEMNG'] == 1 ? " OR a.PID IN (SELECT PersonID FROM payroll WHERE DirectManagerID = '{$_SESSION['PERS']}') " : "";
        $condrw = "('{$_SESSION['USER_RIGHTS2'][13][1]}' = 3 AND (a.UserID = {$_SESSION['USER_ID']} OR a.PID = '{$_SESSION['PERS']}' $condmng))
	             OR
	             '{$_SESSION['USER_RIGHTS3'][13][1][2]}' = 2
		     OR
		     {$_SESSION['USER_ID']} = 1";

        $conn->query("UPDATE candidates_internal a SET $update LastUpdateDate = CURRENT_TIMESTAMP WHERE PersonID = {$this->PersonID} AND ($condrw)");
    }

    private function setCVData(&$info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = Utils::formatStr($v);
            }
        }
    }

}

?>