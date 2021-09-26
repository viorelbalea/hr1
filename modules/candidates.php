<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
};
$Posts = Array();
$query = "select * from candidate_post";
$res = $conn->query($query);
while ($row = $conn->fetch_array()) {
    $Posts[$row['PostId']] = $row;
}
$smarty->assign('Posts', $Posts);

switch ($o) {
    case 'redirector': // divul de editare CV sa se duca pe candidatii externi sau interni cand e inchis in functie de prezenta sau absenta unei editari efective realizate.
        $goLocation = "./?m=candidates";
        if (!isset($_SESSION['goExtern'])) {
            $goLocation .= "&o=list_external&CityId=" . $_GET['CityID'] . "&PostTypeId=" . $_GET['PostTypeId'] . "&PostId=" . $_GET['PostId'] . "&search_for=" . $_GET['search_for'] . "&keyword=" . $_GET['keyword'] . "&res_per_page=" . $_GET['res_per_page'];
        } else {
            unset($_SESSION['goExtern']);
        }
        header('Location: ' . $goLocation);
        break;
    case 'new':

        if (!empty($_POST)) {

            try {

                $person = new Candidate();
                $PersonID = $person->addPerson($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/candidates_internal/' . md5($PersonID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/candidates_internal/' . md5($PersonID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/candidates_internal/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                echo "<body onload=\"window.location.href = './?m=candidates&o=edit&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'status' => Candidate::$msCandidateStatus,
            'cvstatus' => Candidate::$msCVStatus,
            'roles' => User::getRoles(),
            'substatus' => Person::$msSubStatus,
            'qualify' => Person::$msQualify,
            'maritalstatus' => Person::$msMaritalStatus,
            'districts' => Address::getDistricts(),
            'cvsource' => Candidate::$msCVSource,
            'religion' => Person::$msReligion,
            'countries' => Utils::getCountries(),
        ));

        $center_file = 'candidates_internal_new.tpl';

        break;

    case 'edit':
        $PersonID = (int)$_GET['PersonID'];
        $person = new Candidate($PersonID);

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'new_child';
                    try {
                        $person->newChild();
                    } catch (Exception $exp) {

                        $err->setError($exp->getMessage());
                    }
                    break;
                case 'edit_child';
                    try {
                        $person->editChild();
                    } catch (Exception $exp) {

                        $err->setError($exp->getMessage());
                    }
                    break;
                case 'del_child';
                    $person->delChild();
                    break;
            }
            header('Location: ./?m=candidates&o=edit&PersonID=' . $PersonID);
            exit;
        }

        if (!empty($_POST)) {

            try {

                $person->editPerson($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/candidates_internal/' . md5($PersonID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/candidates_internal/' . md5($PersonID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/candidates_internal/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                echo "<body onload=\"window.location.href = './?m=candidates&o=edit&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $info = !empty($_POST) ? Utils::displayInfo($_POST) : $person->getPerson();
        $smarty->assign(array(
            'status' => Candidate::$msCandidateStatus,
            'cvstatus' => Person::$msCVStatus,
            'cvsource' => Candidate::$msCVSource,
            'roles' => User::getRoles(),
            'substatus' => Person::$msSubStatus,
            'qualify' => Person::$msQualify,
            'maritalstatus' => Person::$msMaritalStatus,
            'districts' => Address::getDistricts(),
            'cities' => Address::getCities($info['DistrictID']),
            'children' => $person->getChildren(),
            'religion' => Person::$msReligion,
            'countries' => Utils::getCountries(),
            'employees' => Person::getEmployees(),
            'info' => $info,
        ));

        $center_file = 'candidates_internal_new.tpl';

        break;

    case 'del':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Candidate($PersonID);

        try {

            $person->delPerson();

            header('Location: ./?m=candidates');
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_photo':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Candidate($PersonID);
        try {

            $person->delPersonPhoto();

            header('Location: ./?m=candidates&o=edit&PersonID=' . $PersonID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'export-person':
        $CandidateID = (int)$_GET['PersonID'];
        $PersonID = Candidate::exportToPersons($CandidateID);
        header('Location: ./?m=persons&o=edit&PersonID=' . $PersonID);
        exit;
        break;

    case 'viewcv':
        $CandidateID = (int)$_GET['CvId'];
        $candidate = new CandidateExternal($CandidateID);

        if (!empty($_GET['action']) && ($_GET['action'] == "preview")) {
            if (isset($_GET['preDelete'])) {
                $sql = "delete from candidate_foreignlanguage where CvId='" . $_GET['preDelete'] . "'";
                $conn->query($sql);
                $sql = "delete from candidate_address where CvId='" . $_GET['preDelete'] . "'";
                $conn->query($sql);
                $sql = "delete from candidate_education where CvId='" . $_GET['preDelete'] . "'";
                $conn->query($sql);
                $sql = "delete from candidate_cv where CvId='" . $_GET['preDelete'] . "'";
                $conn->query($sql);
            }


            $cond = "";
            if (!empty($_GET['search_for']) && $_GET['keyword'] != '') {
                switch ($_GET['search_for']) {

                    case 'FullName':
                        $cond .= " AND (LOWER(c.FirstName) LIKE '%" . strtolower($_GET['keyword']) . "%' OR LOWER(c.LastName) LIKE '%" . strtolower($_GET['keyword']) . "%')";
                        break;
                    case 'Email':
                        $cond .= " AND c.Email LIKE '%{$_GET['keyword']}%'";
                        break;
                    case 'default':
                        $cond .= " AND (LOWER(c.FirstName) LIKE '%" . strtolower($_GET['keyword']) . "%' OR LOWER(c.LastName) LIKE '%" . strtolower($_GET['keyword']) . "%')";
                        break;
                }
            }

            if (!empty($_GET['CityId'])) {
                $cond .= " AND a.CityId = " . (int)$_GET['CityId'];
            }
            if (!empty($_GET['PostTypeId'])) {
                $cond .= " AND c.SourceId = " . (int)$_GET['PostTypeId'];
            }
            if (!empty($_GET['PostId'])) {
                $cond .= " AND p.PostId = " . (int)$_GET['PostId'];
            }
            $sql = "select * from candidate_cv where CvId>'" . $_GET['CvId'] . "' " . $cond . " order by CvId ASC limit 1";
            $res = $conn->query($sql);
            if (mysql_num_rows($res))
                $row = $conn->fetch_array();
            else {
                $sql = "select * from candidate_cv where 1=1 " . $cond . " order by CvId ASC limit 1";
                $res = $conn->query($sql);
                $row = $conn->fetch_array();
            }

            $smarty->assign(array(
                'nextCand' => $row['CvId'],
                'info' => $candidate->getCandidate(),
                'education' => CandidateExternal::getEducation($CandidateID),
                'addresses' => CandidateExternal::getAddresses($CandidateID),
                'lang_read' => CandidateExternal::getLanguageRead($CandidateID),
                'lang_write' => CandidateExternal::getLanguageWrite($CandidateID),
                'lang_speak' => CandidateExternal::getLanguageSpeak($CandidateID),
                'work_exp' => CandidateExternal::getWorkExperience($CandidateID)
            ));
            $smarty->display('candidate_cv.tpl');
            exit;
        }
        break;

    case 'view_xls':
        include('/libs/Excel_Reader.php');
        $path = $_SERVER['DOCUMENT_ROOT'] . '/hre_ss2/candidates/java.xls';
        $data = new Spreadsheet_Excel_Reader($path);
        $cols_l = array('A', 'B', 'C', 'D', 'E', 'F', 'G', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P');

        foreach ($cols_l as $col_l) {

            for ($i = 2; $i <= $data->rowcount(); $i++) {
                $col = $data->getCol($col_l);
                $cands[$i][$col_l] = $data->value($i, $col);
            }

        }

//Utils::pa($cands);

        foreach ($cands as $cand) {
            $conn->query("INSERT IGNORE INTO candidate_xls(CvCode,Name,Sex,Age,City,Company,Position,Experience,Studies,DateApply)
											VALUES('{$cand['A']}','{$cand['B']}','{$cand['C']}','{$cand['D']}','{$cand['E']}','{$cand['F']}','{$cand['G']}','{$cand['N']}','{$cand['O']}','{$cand['P']}')");
        }

        break;

    case 'antropometrie':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Candidate::setAntropometrie($PersonID, $_POST);

                echo "<body onload=\"window.location.href = './?m=candidates&o=antropometrie&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'grupa_sangvina' => Person::$msGrupaSangvina,
            'sang_hr' => Person::$msSangHR,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : Candidate::getAntropometrie($PersonID),
        ));
        $center_file = 'candidates_internal_antropometrie.tpl';

        break;

    case 'recruiter-eval':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Candidate::setRecruiterEval($PersonID, $_POST);

                echo "<body onload=\"window.location.href = './?m=candidates&o=recruiter-eval&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : Candidate::getRecruiterEval($PersonID),
        ));
        $center_file = 'candidates_internal_recruiter_eval.tpl';

        break;

    case 'military':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Candidate($PersonID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $person->setMilitary($PersonID, $_POST);

                echo "<body onload=\"window.location.href = './?m=candidates&o=military&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'studies' => Person::$msStudies,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $person->getMilitary($PersonID),
            'permis' => $person->getPermisArma(),
        ));

        $center_file = 'candidates_internal_military.tpl';

        break;

    case 'editcv':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Candidate($PersonID);
        $info = $person->getPerson();
        if (!empty($_GET['action']) && ($_GET['action'] == "print" || $_GET['action'] == "export" || $_GET['action'] == "print_euro" || $_GET['action'] == "export_euro")) {
            $smarty->assign(array(
                'info' => $info,
                'districts' => Address::getDistricts(),
                'marital_status' => Person::$msMaritalStatus,
                'jobdomains' => Job::getJobDomains(),
                'companies' => Job::getCompanies(),
                'languages' => Utils::getLanguages(),
                'lang_level' => Person::$msLangLevel,
                'functions_recr' => Utils::getFunctionsRecr(),
                'prof_exp' => $person->getProfExp(),
                'std' => $person->getStd(),
                'lang' => $person->getLang(),
                'func_recr' => $person->getFuncRecr(),
                //'trainings'      => $person->getTrainingsByPerson(),
                'recruiter_eval' => Candidate::getRecruiterEval($PersonID),
            ));
            if ($_GET['action'] == "print") {
                $smarty->display('candidates_internal_cv_print.tpl');
            }
            if ($_GET['action'] == "print_euro") {
                $smarty->display('candidates_internal_cve_print.tpl');
            }
            if ($_GET['action'] == "export") {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=CV_" . str_replace(' ', '_', $info['FullName']) . ".doc");
                echo $smarty->fetch('candidates_internal_cv_print.tpl');
            }
            exit;
        }

        if (!empty($_POST) || in_array($_GET['action'], array('del_prof', 'del_std', 'del_lang', 'del_func_recr'))) {

            try {

                if (!empty($_GET['action'])) {

                    switch ($_GET['action']) {
                        case 'new_prof':
                            $person->addProfExp();
                            break;
                        case 'edit_prof':
                            $person->editProfExp();
                            break;
                        case 'del_prof':
                            $person->delProfExp();
                            break;
                        case 'new_std':
                            $person->addStd();
                            break;
                        case 'edit_std':
                            $person->editStd();
                            break;
                        case 'del_std':
                            $person->delStd();
                            break;
                        case 'new_lang':
                            $person->addLang();
                            break;
                        case 'edit_lang':
                            $person->editLang();
                            break;
                        case 'del_lang':
                            $person->delLang();
                            break;
                        case 'new_func_recr':
                            $person->addFuncRecr();
                            break;
                        case 'edit_func_recr':
                            $person->editFuncRecr();
                            break;
                        case 'del_func_recr':
                            $person->delFuncRecr();
                            break;
                    }
                    header("Location: ./?m=candidates&o=editcv&PersonID=" . $PersonID);
                    exit;

                } else {

                    $person->editCV($_POST);
                    header("Location: " . $_SERVER['REQUEST_URI']);
                    exit;
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $person->getCV(),
            'jobdomains' => Job::getJobDomains(),
            'companies' => Job::getCompanies(),
            'languages' => Utils::getLanguages(),
            'lang_level' => Person::$msLangLevel,
            'functions_recr' => Utils::getFunctionsRecr(),
            'prof_exp' => $person->getProfExp(),
            'std' => $person->getStd(),
            'lang' => $person->getLang(),
            'func_recr' => $person->getFuncRecr(),
            // 'consultants'    => Person::getConsultants(),
            // 'rooms'          => Utils::getSitesByRooms(),
            'marital_status' => Person::$msMaritalStatus,
            'internal_functions' => Utils::getGroupFunctions(),
            'internal_functionsh' => PayRoll::getInternalFunctionsHistory(),
        ));

        $center_file = 'candidates_internal_cv.tpl';

        break;

    case 'cm':

        $PersonID = (int)$_GET['PersonID'];

        if ($_GET['action']) {

            Candidate::setPersonsByCM($PersonID);
            header('Location: ./?m=candidates&o=cm&PersonID=' . $PersonID);
            exit;

        } else {
            $cm = Candidate::getPersonsByCM($PersonID);
            $smarty->assign(array(
                'info' => $cm[0],
                'cm' => $cm,
            ));
            $center_file = 'candidates_internal_cm.tpl';
        }

        break;

    case 'jobs':

        $PersonID = (int)$_GET['PersonID'];

        $jobs = Job::getJobsByCandidate($PersonID);
        $info = $jobs[0];
        unset($jobs[0]);
        $smarty->assign(array(
            'jobs' => $jobs,
            'info' => $info,
        ));
        $center_file = 'candidates_internal_jobs.tpl';
        break;

    case 'docs':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][1][1][14] > 0)) {
            $center_file = 'candidates_menu.tpl';
            return;
        }

        $PersonID = (int)$_GET['PersonID'];
        $doc_dir = 'docscandidates/' . md5($_SESSION['USER_ID']) . '/' . md5($PersonID) . '/';

        $query = "SELECT FullName, Status FROM candidates_internal WHERE PersonID = $PersonID";
        $conn->query($query);
        if ($row = $conn->fetch_array()) {
            $info = $row;
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {
                case 'new':
                    if (!empty($_POST)) {
                        try {
                            $_POST['FileName'] = $_FILES['FileName']['name'];
                            $library = new CandidateLibrary();
                            $library->addDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : array();
                    $smarty->assign(array(
                        'info' => array_merge($arr, $info),
                    ));
                    $center_file = 'candidates_internal_docs_new.tpl';
                    break;
                case 'edit':
                    $DocID = (int)$_GET['DocID'];
                    $library = new CandidateLibrary($DocID);
                    if (!empty($_POST)) {
                        try {
                            $library->editDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : $library->getDoc();
                    $smarty->assign(array(
                        'info' => array_merge($arr, $info),
                    ));
                    $center_file = 'candidates_internal_docs_new.tpl';
                    break;
                case 'del':
                    $DocID = (int)$_GET['DocID'];
                    $library = new CandidateLibrary($DocID);
                    $info = $library->getDoc();
                    @unlink($info['curr_filename']);
                    $library->delDoc();
                    header('Location: ./?m=candidates&o=docs&PersonID=' . $PersonID);
                    exit;
                    break;
            }

        } else {

            $action = !empty($_GET['action2']) ? $_GET['action2'] : 'default';
            $docs = CandidateLibrary::getAllDocuments($action);

            switch ($action) {
                case 'export':
                    unset($docs[0]);
                    $excel = array();
                    foreach ($docs as $k => $doc) {
                        $excel[$k]['Nume document'] = $doc['DocName'];
                        $excel[$k]['Cod document'] = $doc['DocCode'];
                        $excel[$k]['Descriere'] = $doc['DocDescr'];
                        $excel[$k]['Data crearii'] = $doc['data'];
                    }
                    include("libs/xlsStream.php");
                    export_file($excel, 'documente');
                    break;
                case 'print_page':
                case 'print_all':
                    $smarty->assign(array(
                        'docs' => $docs,
                    ));
                    $smarty->display('candidates_internal_docs_print.tpl');
                    exit;
                    break;
                default:
                    $smarty->assign(array(
                        'info' => $info,
                        'docs' => $docs,
                        'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'],
                    ));
                    $center_file = 'candidates_internal_docs.tpl';
                    break;
            }
        }

        break;

    case 'import':
        $_SESSION['goExtern'] = 1;
        $CandidateID = (int)$_GET['CvId'];
        $candidate = new CandidateExternal($CandidateID);

        ## Check and insert default country Romania
        $conn->query("SELECT CountryID
                      FROM   address_country
                      WHERE  LOWER(CountryName)='romania'");
        if ($row = $conn->fetch_array()) {
            $CountryID = $row['CountryID'];
        } else {
            $conn->query("INSERT INTO address_country(CountryName,CountryCode,PhoneExtension,Currency) VALUES('Romania','RO','0040','RON')");
            $CountryID = $conn->get_insert_id();
        }

        ## Check and insert default District -
        $conn->query("SELECT DistrictID
                      FROM   address_district
                      WHERE  LOWER(DistrictName)='-'");
        if ($row = $conn->fetch_array()) {
            $DistrictID = $row['DistrictID'];
        } else {
            $conn->query("INSERT INTO address_district(CountryID,DistrictName) VALUES('$CountryID','-')");
            $DistrictID = $conn->get_insert_id();
        }
        ## Check and insert default District -
        $conn->query("SELECT CityID
                      FROM   address_city
                      WHERE  LOWER(CityName)='-'");
        if ($row = $conn->fetch_array()) {
            $CityID = $row['CityID'];
        } else {
            $conn->query("INSERT INTO address_city(DistrictID,CityName) VALUES('$DistrictID','-')");
            $CityID = $conn->get_insert_id();
        }

        ## Obtain address as street as concat of all Address details
        $conn->query("SELECT *
                      FROM   candidate_address a
                      LEFT JOIN candidate_city c ON a.CityId=c.CityId
                      WHERE CvId=$CandidateID
                      ORDER  BY AddressId ASC");
        while ($row = $conn->fetch_array()) {
            $addr .= $row['CityName'] . ', ' . $row['Address'] . ';';
        }

        $conn->query("INSERT INTO address(UserID,CityID,StreetName,StreetCode,StreetNumber,Bl,Sc,Et,Ap) VALUES('{$_SESSION['USER_ID']}','$CityID','$addr','','','','','','')");
        $StreetID = $conn->get_insert_id();

        ## Create languages as Skills
        $lRead = CandidateExternal::getLanguageRead($CandidateID);
        $lr_tx = 'Citit: ';
        foreach ($lRead as $lr)
            $lr_tx .= $lr['LanguageName'] . ': ' . $lr['LanguageLevelName'] . '; ';
        $lr_tx .= '   ';

        $lWrite = CandidateExternal::getLanguageWrite($CandidateID);
        $lw_tx = 'Vorbit: ';
        foreach ($lWrite as $lw)
            $lr_tx .= $lw['LanguageName'] . ': ' . $lw['LanguageLevelName'] . '; ';
        $lw_tx .= '   ';

        $lSpeak = CandidateExternal::getLanguageSpeak($CandidateID);
        $ls_tx = 'Scris: ';
        foreach ($lSpeak as $ls)
            $ls_tx .= $ls['LanguageName'] . ': ' . $ls['LanguageLevelName'] . '; ';
        $ls_tx .= '   ';

        $lang_tx = $lr_tx . $lw_tx . $ls_tx;

        $candidateData = $candidate->getCandidate();

        ## Check by ImportCode or Insert the new candidate
        $conn->query("SELECT PersonID FROM candidates_internal WHERE ImportCode=(SELECT MD5(CONCAT_WS(' ',FirstName,LastName,BirthDate)) FROM candidate_cv WHERE CvId=$CandidateID )");
        if ($row = $conn->fetch_array()) {
            $PersonID = $row['PersonID'];
        } else {
            $conn->query("INSERT INTO candidates_internal (
						UserId,AddressID,Status,
						LastName,FirstName,FullName,
						Sex,DateOfBirth,Phone,Mobile,Email,MaritalStatusNotes,
						CVSkills,CreateDate,ImportStatus,
						ImportCode,
						CVSourceRecc, CVSourceDetails,
						Notes, PostId, PostId2
						)
						SELECT
						{$_SESSION['USER_ID']},$StreetID,2,
						LastName,FirstName,CONCAT_WS(' ',FirstName,LastName),Gender,BirthDate,Phone,Mobile,Email,'" . $candidateData['MaritalStatusName'] . "',
						'$lang_tx',now(),1,
						MD5(CONCAT_WS(' ',FirstName,LastName,BirthDate)),
						0,Url,
						CONCAT_WS(' ','Data aplicarii',ApplyDate),
						PostId, PostId
						FROM candidate_cv WHERE CvId=$CandidateID");
            $PersonID = $conn->get_insert_id();
        }

        $q = "select * from candidate_cv where CvId=$CandidateID";
        $conn->query($q);
        $rowCv = $conn->fetch_array();

        ## Insert the Work experience
        $query = "SELECT
						{$_SESSION['USER_ID']},$PersonID,Employer,0,Position,CONCAT_WS('; ',Domain,Description,Recomandation) AS ExtResponsabilities,FromDate,ToDate,now()
						FROM candidate_workexperience WHERE CvId=$CandidateID";
        $r1 = $conn->query($query);

        while ($row = $conn->fetch_array($r1)) {
            $query2 = "INSERT INTO candidates_internal_prof SET
						UserId={$_SESSION['USER_ID']},
						PersonID=$PersonID,
						Company='" . $row['Employer'] . "',
						DomainID=0,
						Job='" . $row['Position'] . "',
						Responsabilities='" . $conn->real_escape_string($row['ExtResponsabilities']) . "',
						StartDate='" . Utils::toDBDateBestJobs($row['FromDate']) . "',
						StopDate='" . Utils::toDBDateBestJobs($row['ToDate']) . "',
						CreateDate=now()
						";
            $conn->query($query2);
        }
        $query2 = "INSERT INTO candidates_internal_prof SET
						UserId={$_SESSION['USER_ID']},
						PersonID=$PersonID,
						Company='" . $rowCv['LastCompany'] . "',
						DomainID=0,
						Responsabilities='" . $rowCv['LastWorkPlace'] . "',
						CreateDate=now()
						";
        $conn->query($query2);

        ## Insert the Studies
        $conn->query("INSERT INTO candidates_internal_std (
						UserId,PersonID,Institution,Specialization,DomainID,Diploma,CreateDate
						)
						SELECT
						{$_SESSION['USER_ID']},$PersonID,'',Studies,0,Skills,now()
						FROM candidate_education WHERE CvId=$CandidateID");

        if (!isset($_GET['rePreview']))
            header('Location: ./?m=candidates&o=list_external&CityId=' . $_GET['CityId'] . '&PostTypeId=' . $_GET['PostTypeId'] . '&PostId=' . $_GET['PostId'] . '&search_for=' . $_GET['search_for'] . '&keyword=' . $_GET['keyword'] . '&res_per_page=' . $_GET['res_per_page']);
        else
            header('Location: ./?m=candidates&o=viewcv&CvId=' . $_GET['rePreview'] . '&action=preview&CityId=' . $_GET['CityId'] . '&PostTypeId=' . $_GET['PostTypeId'] . '&PostId=' . $_GET['PostId'] . '&search_for=' . $_GET['search_for'] . '&keyword=' . $_GET['keyword'] . '&res_per_page=' . $_GET['res_per_page']);


        break;

    case 'posts':
        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        $query = "select * from candidate_posttype";
        $res = $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $sources[$row['PostTypeId']] = $row['PostTypeName'];
            $status[$row['PostTypeId']] = $row['Status'];
        }
        $smarty->assign('sources', $sources);
        $query = "select * from candidate_post";
        $res = $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $posts[$row['PostId']] = $row['PostName'];
            $status2[$row['PostId']] = $row['Status'];
            $sourceID[$row['PostId']] = $sources[$row['PostTypeId']];
        }

        $smarty->assign('posts', $posts);
        $smarty->assign('Status', $status);
        $smarty->assign('Status2', $status2);
        $smarty->assign('sourceID', $sourceID);


        switch ($action) {
            default:
            case 'sources':
                $SourceID = !empty($_GET['SourceID']) ? (int)$_GET['SourceID'] : 0;
                $PostID = !empty($_GET['PostID']) ? (int)$_GET['PostID'] : 0;

                if ((!empty($_GET['Source']) && trim($_GET['Source'])) || !empty($_GET['delSource'])) {
                    if ($SourceID == 0) { // add source
                        $_GET['Source'] = $conn->real_escape_string(trim($_GET['Source']));
                        if ($_GET['Source'] == "") {
                            $mesaj = '<font color="red">Completati campul sursa</font>';
                        } else {
                            $query = "insert into `candidate_posttype` values('','" . $_GET['Source'] . "','1')";
                            $res = $conn->query($query);
                            if (mysql_error()) {
                                $mesaj = '<font color="red">Sursa nu a putut fi adaugata.</font>';
                            } else {
                                $mesaj = '<font color="green">Sursa a fost adaugata.</font>
									<script>document.location="?m=candidates&o=posts&action=sources";</script>';
                            }
                        }
                    } else if (isset($_GET['delSource'])) {
                        $query = "delete from `candidate_posttype` where PostTypeId='" . $SourceID . "' limit 1";
                        $res = $conn->query($query);
                    } else {
                        $query = "update `candidate_posttype` set
								PostTypeName='" . $_GET['Source'] . "',
								Status='" . $_GET['Status'] . "'
								where PostTypeId='" . $SourceID . "'
							";
                        $conn->query($query);
                    }
                    header('Location: ./?m=candidates&o=posts&action=sources');
                    exit;
                } else if ((!empty($_GET['Post']) && trim($_GET['Post'])) || !empty($_GET['delPost'])) {
                    if ($PostID == 0) { // add post
                        $_GET['Post'] = $conn->real_escape_string(trim($_GET['Post']));
                        if ($_GET['Post'] == "") {
                            $mesaj = '<font color="red">Completati campul post</font>';
                        } else {
                            $query = "insert into `candidate_post` values('','" . $_GET['Post'] . "','0','1')";
                            $res = $conn->query($query);
                            if (mysql_error()) {
                                $mesaj = '<font color="red">Postul nu a putut fi adaugat.</font>';
                            } else {
                                $mesaj = '<font color="green">Postul a fost adaugat.</font>
									<script>document.location="?m=candidates&o=posts&action=sources";</script>';
                            }
                        }
                    } else if (isset($_GET['delPost'])) {
                        $query = "delete from `candidate_post` where PostId='" . $PostID . "' limit 1";
                        $res = $conn->query($query);
                    } else {
                        $query = "update `candidate_post` set
								PostName='" . $_GET['Post'] . "',
								Status='" . $_GET['Status'] . "'
								where PostId='" . $PostID . "'
							";
                        $conn->query($query);

                    }
                    header('Location: ./?m=candidates&o=posts&action=sources');
                    exit;
                }

                $center_file = 'candidates_posts_sources.tpl';
                break;

        }
        break;

    case 'list_external':

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $CandidateID = (int)$_GET['CvId'];
        $candidates = CandidateExternal::getAllCandidates($action);
        // print_r(Candidate::getAllCandidates($action));
        switch ($action) {
            case 'export':
                unset($candidates[0]);
                $excel = array();
                foreach ($candidates as $k => $candidate) {
                    $excel[$k]['Name'] = $candidate['FirstName'] . ' ' . $candidate['LastName'];
                    $excel[$k]['Post'] = $candidate['PostName'];
                    $excel[$k]['Email'] = $candidate['Email'];
                    $excel[$k]['Telefon'] = $candidate['Phone'];
                    $excel[$k]['Mobil'] = $candidate['Mobile'];
                    $excel[$k]['Sursa'] = $candidate['PostTypeName'];
                    $excel[$k]['Status'] = $candidate['ImportStatus'] == '1' ? 'Importat' : 'Neimportat';

                }
                include("libs/xlsStream.php");
                export_file($excel, 'candidati_externi');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=candidati_externi.doc");
                unset($candidates[0]);
                $smarty->assign(array(
                    'candidates' => $candidates,
                    'personalisedlist' => Utils::getPersonalisedList('Job'),
                ));
                $smarty->display('candidates_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                unset($candidates[0]);
                $smarty->assign(array(
                    'candidates' => $candidates,
                    'personalisedlist' => Utils::getPersonalisedList('Job'),
                ));
                $smarty->display('candidates_print.tpl');
                exit;
                break;
            default:
                $smarty->assign(array(
                    'candidates' => $candidates,
                    'cities' => CandidateExternal::getAllCities(),
                    'ptypes' => CandidateExternal::getAllPostTypes(),
                    'posts' => CandidateExternal::getAllPosts(),
                    'request_uri' => !empty($_GET['res_per_page']) ? "./?m=candidates&o=list_external&CityId={$_GET['CityId']}&PostTypeId={$_GET['PostTypeId']}&PostId={$_GET['PostId']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}&action=print" : "./?m=candidates",
                ));
                $center_file = 'candidates.tpl';
                break;
        }
        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][1][1] > 0)) {
            $center_file = 'candidates_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Candidate::getAllPersons($action);
        $personalisedlist = Utils::getPersonalisedList('Candidate');
        $status = Candidate::$msCandidateStatus;
        $maritalstatus = Person::$msMaritalStatus;
        $cvstatus = Person::$msCVStatus;
        $roles = User::getRoles();

        //Utils::pa($internal_functions);

        switch ($action) {
            case 'export':
                unset($persons[0]);
                $excel = array();
                foreach ($persons as $k => $person) {
                    $excel[$k]['Name'] = $person['FullName'];
                    if (empty($personalisedlist['Personal'])) {
                        $excel[$k]['District'] = $person['DistrictName'];
                        $excel[$k]['City'] = $person['CityName'];
                        $excel[$k]['Varsta'] = $person['varsta'];
                        $excel[$k]['CNP'] = $person['CNP'];
                        $excel[$k]['Status'] = Person::$msStatus[$person['Status']];
                        $excel[$k]['Status CV'] = Person::$msCVStatus[$person['CVStatus']];
                    } else {
                        foreach ($personalisedlist['Personal'] AS $field => $name) {
                            if ($field == 'Status')
                                $excel[$k][$name] = $status[$person[$field]];
                            elseif ($field == 'MaritalStatus')
                                $excel[$k][$name] = $maritalstatus[$person[$field]];
                            elseif ($field == 'CVStatus')
                                $excel[$k][$name] = $cvstatus[$person[$field]];
                            elseif ($field == 'RoleID')
                                $excel[$k][$name] = $roles[$person[$field]];
                            else
                                $excel[$k][$name] = $person[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'candidati');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=candidati.doc");
                //unset($persons[0]);
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'roles' => $roles,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('candidates_internal_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                //unset($persons[0]);
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'roles' => $roles,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('candidates_internal_print.tpl');
                exit;
                break;
            default:


                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Candidate::$msCandidateStatus,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'roles' => $roles,
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'studies' => Person::$msStudies,
                    'languages' => Utils::getLanguages(),
                    'localitati' => Candidate::getLocalitatiByCV(),
                    'tari' => Candidate::getTariByCV(),
                    'cvsource' => Candidate::$msCVSource,
                    'qualify' => Person::$msQualify,
                    'jobdomains' => Job::getJobDomains(),
                    'lang_level' => Person::$msLangLevel,
                    'functions_recr' => Utils::getFunctionsRecr(),
                    'request_uri' => $request_uri,

                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'candidates_internal.tpl';
                break;
        }

        break;

}
?>