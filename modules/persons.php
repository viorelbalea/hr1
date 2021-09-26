<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

if ($o != 'default' && $o != 'new') {
    if (!empty($_SESSION['PERS']) && $_SESSION['PERS'] != (int)$_GET['PersonID'] && ($_SESSION['USER_RIGHTS2'][1][9] == 1 || ($_SESSION['USER_RIGHTS2'][1][9] == 2 && Person::getDirectManagerID((int)$_GET['PersonID']) != $_SESSION['PERS']))) {
        $o = 'summary';
    }
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $person = new Person();
                $PersonID = $person->addPerson($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/persons/' . md5($PersonID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/persons/' . md5($PersonID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/persons/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                echo "<body onload=\"window.location.href = './?m=persons&o=edit&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'status' => Person::$msStatus,
            'cvstatus' => Person::$msCVStatus,
            'roles' => User::getRoles(),
            'substatus' => Person::$msSubStatus,
            'qualify' => Person::$msQualify,
            'cvsource' => Candidate::$msCVSource,
            'maritalstatus' => Person::$msMaritalStatus,
            'districts' => Address::getDistricts(),
            'religion' => Person::$msReligion,
            'countries' => Utils::getCountries(),
            'sarbatori' => ConfigData::$sarbatori,
            'customfields' => Utils::getCustomFields(),
            'terminals' => Application::getPhoneTerminals(),
            'numbers' => Application::getPhoneNumbers(),
        ));

        $center_file = 'persons_new.tpl';

        break;

    case 'edit':

        if (empty($_SESSION['USER_RIGHTS3'][1][1][1]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=persons&o=summary&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {

                // Adaugare de nou copil (intretinere)
                case 'new_child';
                    $person->newChild();
                    break;

                // Editare copil (intretinere)
                case 'edit_child';
                    $person->editChild();
                    break;

                // Stergere copil
                case 'del_child';
                    $person->delChild();
                    break;

                // Adaugare certificat de casatorie
                case 'new_cc';
                    $person->newCC();
                    break;

                // Editare certificat de casatorie
                case 'edit_cc';
                    $person->editCC();
                    break;

                // Stergere certificat de casatorie
                case 'del_cc';
                    $person->delCC();
                    break;
            }
            header('Location: ./?m=persons&o=edit&PersonID=' . $PersonID);
            exit;
        }

        if (!empty($_POST)) {


            try {

                $person->editPerson($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/persons/' . md5($PersonID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/persons/' . md5($PersonID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/persons/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                if (!empty($_FILES['cvfile']['name'])) {
                    $_POST['cvfile'] = (int)$_GET['PersonID'] . '.' . pathinfo($_FILES['cvfile']['name'], PATHINFO_EXTENSION);
                    @move_uploaded_file($_FILES['cvfile']['tmp_name'], 'uploads/cv/' . $_POST['cvfile']);
                }
                echo "<body onload=\"window.location.href = './?m=persons&o=edit&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $info = !empty($_POST) ? Utils::displayInfo($_POST) : $person->getPerson();
        $smarty->assign(array(
            'status' => Person::$msStatus,
            'cvstatus' => Person::$msCVStatus,
            'roles' => User::getRoles(),
            'substatus' => Person::$msSubStatus,
            'qualify' => Person::$msQualify,
            'cvsource' => Candidate::$msCVSource,
            'maritalstatus' => Person::$msMaritalStatus,
            'districts' => Address::getDistricts(),
            'cities' => Address::getCities($info['DistrictID']),
            'children' => $person->getChildren(),
            'cc' => $person->getCC(),
            'religion' => Person::$msReligion,
            'countries' => Utils::getCountries(),
            'sarbatori' => ConfigData::$sarbatori,
            'customfields' => Utils::getCustomFields(),
            'employees' => Person::getEmployees(),
            'institutii' => Company::getNonSelfCompanies(),
            'info' => $info,

        ));

        $center_file = 'persons_new.tpl';

        break;

    case 'del':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        try {

            $person->delPerson();

            header('Location: ./?m=persons');
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_photo':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);
        try {

            $person->delPersonPhoto();

            header('Location: ./?m=persons&o=edit&PersonID=' . $PersonID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_person_cv':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);
        try {

            $person->delPersonCV();

            header('Location: ./?m=persons&o=edit&PersonID=' . $PersonID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_jd_file':

        $PersonID = (int)$_GET['PersonID'];
        $payroll = PayRoll::getIncadrare();
        try {
            $query = "UPDATE payroll SET JDFile=NULL WHERE PersonID = $PersonID";
            $conn->query($query);

            if (is_file($payroll['JDFilePath'])) {
                @unlink($payroll['JDFilePath']);
            }

            header('Location: ./?m=persons&o=incadrare&PersonID=' . $PersonID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'editprof':

        $PersonID = (int)$_GET['PersonID'];

        $person = new Person($PersonID);



        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $person->editPersonProf($_POST);

                echo "<body onload=\"window.location.href = './?m=persons&o=editprof&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'studies' => Person::$msStudies,
            'educational_levels' => Person::$msEducationalLevel,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $person->getProfData(),
            'jobs' => Job::getJobsTitle(),
            'cvstatus' => Person::$msCVStatus,
            'certificate' => $person->getCertif(1),
            'atestate' => $person->getCertif(2),
            'medDocsNew' => $person->getMedicalDocsNew(),
            'psyDocsNew' => $person->getPsichologicalDocsNew(),
            'cppc' => $person->getCPPC(),
            'years' => range(0, 45),
            'months' => range(0, 12),
            'days' => range(0, 31)
        ));

        $center_file = 'persons_prof.tpl';

        break;

    case 'editcv':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        if (!empty($_GET['action']) && ($_GET['action'] == "print" || $_GET['action'] == "export" || $_GET['action'] == "print_euro" || $_GET['action'] == "export_euro")) {
            $smarty->assign(array(
                'info' => $person->getPerson(),
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
                'trainings' => $person->getTrainingsByPerson(),
            ));
            if ($_GET['action'] == "print") {
                $smarty->display('persons_cv_print.tpl');
            }
            if ($_GET['action'] == "print_euro") {
                $smarty->display('persons_cve_print.tpl');
            }
            if ($_GET['action'] == "export") {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=CV_" . str_replace(' ', '_', $info['FullName']) . ".doc");
                echo $smarty->fetch('persons_cv_print.tpl');
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
                    header("Location: ./?m=persons&o=editcv&PersonID=" . $PersonID);
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

        $center_file = 'persons_cv.tpl';

        break;

    case 'incadrare':

        if (!empty($_POST)) {

            try {
                if (!empty($_FILES['JDFile']['name'])) {
                    $_POST['JDFile'] = (int)$_GET['PersonID'] . '.' . pathinfo($_FILES['JDFile']['name'], PATHINFO_EXTENSION);
                    @move_uploaded_file($_FILES['JDFile']['tmp_name'], 'uploads/jd/' . $_POST['JDFile']);
                }
                PayRoll::setIncadrare();

                echo "<body onload=\"window.location.href = './?m=persons&o=incadrare&PersonID={$_GET['PersonID']}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        } elseif (!empty($_GET['FID'])) {

            if (!empty($_GET['del'])) {
                PayRoll::deleteFunctionHistory();
            } elseif (!empty($_GET['delinternal'])) {
                PayRoll::deleteInternalFunctionHistory();
            } elseif (!empty($_GET['internal'])) {
                PayRoll::updateInternalFunctionHistory();
            } else {
                PayRoll::updateFunctionHistory();
            }
            header('Location: ./?m=persons&o=incadrare&PersonID=' . (int)$_GET['PersonID']);
            exit;

        } elseif (!empty($_GET['action'])) {
            PayRoll::setCostCenterByPerson();
            header('Location: ./?m=persons&o=incadrare&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        $smarty->assign(array(
            'costcenter' => Utils::getCostCenter(),
            'costcenter_persons' => PayRoll::getCostCenterByPerson(),
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'subsubdepartments' => Utils::getSubSubDepartments(),
            'functions' => Utils::getFunctions(),
            'functionsh' => PayRoll::getFunctionsHistory(),
            'internal_functions' => Utils::getGroupFunctions(),
            'internal_functionsh' => PayRoll::getInternalFunctionsHistory(),
            'directmanager' => Person::getPersonsByRole(1),
            'managers' => Person::getEmployees(),
            'sites' => Utils::getSites(),
            'prototype' => 1,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : PayRoll::getIncadrare(),
            'transeVechime' => ConfigData::$transeVechime,
        ));

        $center_file = 'persons_incadrare.tpl';

        break;

    case 'payroll':
        //echo "<pre>";
        //echo "Your server version doesn't match with service requirements. For more information please contact your server administration service.";
        if (!empty($_GET['action'])) {
            PayRoll::setSalary();
            PayRoll::setSalaryPFA();
            PayRoll::setSalaryExtra();
            Pontaj::setMonthlyAdjustments();
            echo "<body onload=\"window.location.href = './?m=persons&o=payroll&PersonID={$_GET['PersonID']}'\"></body>";
            exit;
        }


        $calendar = new Calendar();


        $smarty->assign(array(
            'salary' => PayRoll::getSalary(),
            'salaryPFA' => PayRoll::getSalaryPFA(),
            'bonus' => PayRoll::getSalaryExtra('bonus'),
            'bonus_sales' => PayRoll::getSalaryExtra('bonus_sales'),
            'bonus_natura' => PayRoll::getSalaryExtra('bonus_natura'),
            'bonus_prime' => PayRoll::getSalaryExtra('bonus_prime'),
            'avans' => PayRoll::getSalaryExtra('avans'),
            'concediu' => PayRoll::getSalaryExtra('concediu'),
            'malus' => PayRoll::getSalaryExtra('malus'),
            'adjustments' => Pontaj::getMonthlyAdjustments(),
            'currencies' => Currency::$msCurrencies,
            'prototype' => 1,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : PayRoll::getPayRollSalary(),
            'years' => range(2012, date('Y') + 1),
            'months' => array_combine(range(1, 12), $calendar->getMonthNames()),
        ));
        $center_file = 'persons_payroll.tpl';

        break;

    case 'displacement':

        if (!empty($_GET['action'])) {

            PayRoll::setDisplacement();
            header('Location: ./?m=persons&o=displacement&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        $smarty->assign(array(
            'prototype' => 1,
            'years' => range(date('Y') + 5, date('Y') - 1),
            'countries' => Utils::getCountries(),
            'projects' => Project::getActiveProjects(),
            'costcenter' => Utils::getCostCenter(),
            'displacements' => PayRoll::getDisplacements(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : PayRoll::getDisplacements(),
        ));
        $center_file = 'persons_displacement.tpl';

        break;

    case 'displacement_cost':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][1][1][23] > 0)) {
            exit;
        }

        $PersonID = (int)$_GET['PersonID'];
        $DisplacementID = (int)$_GET['DisplacementID'];

        if (!empty($_GET['action'])) {
            PayRoll::setDisplacementCost($PersonID, $DisplacementID);
        }

        $smarty->assign_by_ref('err', $err);
        $smarty->assign(array(
            'costs' => PayRoll::getDisplacementCost($PersonID, $DisplacementID),
            'cost_types' => ConfigData::$msCostTypes,
            'currencies' => ConfigData::$msCurrencies,
        ));
        $smarty->display('persons_displacement_cost.tpl');
        exit;

        break;

    case 'contract':

        if (!empty($_GET['action'])) {
            PayRoll::setActead();
            header('Location: ./?m=persons&o=contract&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        if (!empty($_GET['action_contract_history'])) {
            PayRoll::setContractHistory();
            header('Location: ./?m=persons&o=contract&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        if (!empty($_GET['action_contract_warning'])) {
            PayRoll::setContractWarnings();
            header('Location: ./?m=persons&o=contract&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        if (!empty($_POST)) {

            try {

                PayRoll::setPayRoll();
                echo "<body onload=\"window.location.href = './?m=persons&o=contract&PersonID={$_GET['PersonID']}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        for ($i = 0; $i <= 23; $i++) {
            $j = $i <= 9 ? '0' . $i : $i;
            $hours[$j . ':00'] = $j . ':00';
            $hours[$j . ':15'] = $j . ':15';
            $hours[$j . ':30'] = $j . ':30';
            $hours[$j . ':45'] = $j . ':45';
        }

        $smarty->assign(array(
            'status' => Person::$msStatus,
            'substatus' => Person::$msSubStatus,
            'leavereason' => Person::$msSubStatus[6], //PayRoll::$msLeaveReason,
            'modalitateAngajare' => Person::$msSubStatus[9],
            'suspReason' => Person::$msSubStatus[10],
            'health_companies' => ConfigData::$msHealthCompanies,
            'employeetype' => PayRoll::$msEmployeeType,
            'contract_type' => PayRoll::$msContractType,
            'prototype' => 1,
            'hours' => $hours,
            'dismissal_periods' => range(1, 60),
            'probation_periods' => range(1, 120),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : PayRoll::getPayRoll(),
            'actead' => PayRoll::getActead(),
            'warnings' => PayRoll::getContractWarnings(),
            'contracts' => PayRoll::getContractsHistory(),
            'normType' => ConfigData::$normType,
            'workLength' => ConfigData::$workLength,
            'workTime' => ConfigData::$workTime,
            'workPrg' => ConfigData::$workPrg,
        ));
        $center_file = 'persons_contract.tpl';

        break;

    case 'modulIT';

        if (!empty($_GET['action'])) {
            Application::setPersonInventar();
            header('Location: ./?m=persons&o=modulIT&PersonID=' . (int)$_GET['PersonID']);
            exit;
        }

        if (!empty($_POST)) {

            Application::setPersonApplications((int)$_GET['PersonID']);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }
        $rights = Application::getPersonApplications((int)$_GET['PersonID']);
        $smarty->assign(array(
            'applications' => Application::getAllApplications(),
            'rights' => $rights,
            'info' => $rights,
            'inventar' => Application::getInventar(),
            'person_inventar' => Application::getPersonInventar(),
        ));

        $center_file = 'persons_modulIT.tpl';

        break;

    case 'inventar':
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'payments':
                    if (!empty($_GET['save'])) {
                        if ($_GET['save'] == 1) {
                            Application::setPersonInventar();
                            header('Location: ./?m=persons&o=inventar&action=payments&msg=1&ID=' . (int)$_GET['ID']);
                        } elseif ($_GET['save'] == 2) {
                            Application::setPersonInventarPayments();
                            header('Location: ./?m=persons&o=inventar&action=payments&ID=' . (int)$_GET['ID']);
                        }
                    }

                    $smarty->assign(array(
                        'coins' => ConfigData::$msCurrencies,
                        'info' => Application::getPersonInventarByID((int)$_GET['ID']),
                        'payments' => Application::getPersonInventarPayments(),
                    ));

                    $smarty->display('persons_inventar_payments.tpl');
                    exit;
                    break;
                case 'save_phone':
                    //Utils::pa($_GET);
                    Application::setPersonPhoneInventar();
                    header('Location: ./?m=persons&o=inventar&PersonID=' . (int)$_GET['PersonID']);
                    exit;
                    break;

                default:
                    Application::setPersonInventar();
                    header('Location: ./?m=persons&o=inventar&PersonID=' . (int)$_GET['PersonID']);
                    exit;
                    break;
            }
        }

        $rights = Application::getPersonApplications((int)$_GET['PersonID']);
        $smarty->assign(array(
            'applications' => Application::getAllApplications(),
            'rights' => $rights,
            'info' => $rights,
            'inventar' => Application::getInventar((int)$_GET['PersonID']),
            'person_inventar' => Application::getPersonInventar((int)$_GET['PersonID']),

            'person_phone_inventar' => Application::getPhoneInventar((int)$_GET['PersonID']),
            'terminals' => Application::getPhoneTerminals($PersonID),
            'numbers' => Application::getPhoneNumbers($PersonID),
        ));


        $center_file = 'persons_inventar.tpl';
        break;

    case 'vacation':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {
                case 'new':
                    Person::newVacation($PersonID);
                    break;
                case 'edit':
                    Person::editVacation($PersonID);
                    break;
                case 'del':
                    Person::delVacation($PersonID);
                    break;
                case 'newv':
                    $VacationID = Person::newVacationDetail($PersonID);
                    if (is_dir('uploads/vacations/0')) {
                        @rename('uploads/vacations/0', 'uploads/vacations/' . $VacationID);
                    }
                    break;
                case 'editv':
                    Person::editVacationDetail($PersonID);
                    break;
                case 'delv':
                    Person::delVacationDetail($PersonID);
                    break;
                case 'rejectv':
                    Person::rejectVacationDetail($PersonID);
                    break;
                case 'aprovev':
                    Person::aproveVacationDetail($PersonID);
                    break;
            }

            header('Location: ./?m=persons&o=vacation&PersonID=' . $PersonID);
            exit;

        } elseif (!empty($_POST)) {

            Person::setVacationComment($PersonID);

            header('Location: ./?m=persons&o=vacation&PersonID=' . $PersonID);
            exit;
        }
        $vacations = Person::getVacation($PersonID);
        foreach ($vacations as $v) {
            $info = $v;
            break;
        }
        $smarty->assign(array(
            'prototype' => 1,
            'info' => $info,
            'vacations' => $vacations,
            'vacations_details' => Person::getVacationDetails($PersonID),
            'years' => range(date('Y') + 2, date('Y') - 5),
            'ce_type' => Person::$msCEType,
            'cs_type' => Person::$msCSType,
            'employees' => Person::getEmployees(true, $info["DivisionID"], $PersonID),
        ));

        $center_file = 'persons_vacation.tpl';

        break;

    case 'vacation_recalc':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][1][4] > 0)) {
            $center_file = 'persons_menu.tpl';
            return;
        }

        if (!empty($_GET['year'])) {
            if (!empty($_GET['recalc'])) {
                if ($_GET['year'] == date('Y')) {
                    include('cron/vacation.php');
                } else {
                    include('modules/vacation_recalc.php');
                }
                $smarty->assign('success', 1);
            } else {
                echo "<body onload=\"if (confirm('Recalcularea concediului teoretic al persoanelor va declansa rularea unui job, putand genera probleme temporare de performanta a aplicatiei. Continuati?')) window.location.href = './?m=persons&o=vacation_recalc&year={$_GET['year']}&recalc=1'; else window.location.href = './?m=persons&o=vacation_recalc';\"></body>";
            }
        }

        $smarty->assign('years', range(date('Y') + 1, date('Y') - 10));
        $center_file = 'persons_vacation_recalc.tpl';

        break;

    case 'export_revisal':

        $smarty->assign(array(
            'info' => Revisal::exportXML(),
        ));

        header("Content-Type:text/xml");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=revisal_" . date('Y-m-d') . ".xml");

        $smarty->display('persons_revisal.tpl');
        exit;
        break;

    case 'car':

        $PersonID = (int)$_GET['PersonID'];

        $smarty->assign(array(
            'prototype' => 1,
            'cartypes' => Car::$msCarTypes,
            'brands' => Car::$msBrands,
            'fuels' => Car::$msFuels,
            'gears' => Car::$msGears,
            'doors' => Car::$msDoorsNo,
            'currencies' => ConfigData::$msCurrencies,
            'info' => Person::getCarInfo($PersonID),
        ));

        $center_file = 'persons_car.tpl';

        break;

    case 'auth':

        $PersonID = (int)$_GET['PersonID'];

        if (isset($_POST['save'])) {

            try {

                Person::setAuthInfo($PersonID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        }

        $smarty->assign(array(
            'info' => Person::getAuthInfo($PersonID),
        ));

        $center_file = 'persons_auth.tpl';

        break;

    case 'accessperf':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Person::setAccessPerfInfo($PersonID);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        }

        $smarty->assign(array(
            'info' => Person::getAccessPerfInfo($PersonID),
        ));

        $center_file = 'persons_accessperf.tpl';

        break;

    case 'accesseval':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST['saveEval'])) {

            try {

                Person::setAccessEvalInfo($PersonID);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        }
        if (!empty($_POST['saveColleaguesEval'])) {

            try {

                Person::setColleaguesAccessEvalInfo($PersonID);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        }

        if (!empty($_POST['saveSurvey'])) {

            try {

                Person::setAccessSurvey($PersonID);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        }

        $smarty->assign(array(
            'info' => Person::getAccessEvalInfo($PersonID),
            'info_colleagues' => Person::getAccessColleaguesEvalInfo($PersonID),
            'info_survey' => Person::getAccessSurvey($PersonID),
        ));

        $center_file = 'persons_accesseval.tpl';

        break;

    case 'medical':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST) || !empty($_GET['del'])) {

            try {

                Person::setMedical($PersonID);
                header('Location: ./?m=persons&o=medical&PersonID=' . $PersonID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $medical = Person::getMedical($PersonID);
        $smarty->assign(array(
            'info' => $medical[0],
            'medical' => $medical,
            'prototype' => 1,
        ));

        $center_file = 'persons_medical.tpl';

        break;

    case 'beneficii':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST) || !empty($_GET['del'])) {

            try {

                Person::setBeneficii($PersonID);
                header('Location: ./?m=persons&o=beneficii&PersonID=' . $PersonID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $ben = Person::getBeneficii($PersonID);
        $smarty->assign(array(
            'info' => $ben[0],
            'ben' => $ben,
            'companies' => Company::getAssuranceCompanies(),
            'currencies' => Currency::$msCurrencies,
            'companies_training' => Job::getTrainingCompanies(),
            'prototype' => 1,
        ));

        $center_file = 'persons_beneficii.tpl';

        break;

    case 'summary':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        $info = array_merge($person->getPersonSummary(), $person->getProfDataSummary());

        $smarty->assign(array(
            'info' => $info,
            'districts' => Address::getDistricts(),
            'status' => Person::$msStatus,
            'substatus' => Person::$msSubStatus,
            'studies' => Person::$msStudies,
            'jobs' => Job::getJobsTitle(),
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'costcenter' => Utils::getCostCenter(),
            'departments' => Utils::getDepartmentsAdmin(),
            'functions' => Utils::getFunctions(),
            'directmanager' => Person::getEmployees(),
            'sites' => Utils::getSites(),
            'managers' => Person::getPersonsByRole('manager'),
        ));
        $center_file = 'persons_summary.tpl';

        break;

    case 'docs':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][1][1][14] > 0)) {
            $center_file = 'persons_menu.tpl';
            return;
        }

        $PersonID = (int)$_GET['PersonID'];
        $doc_dir = 'docspers/' . md5($_SESSION['USER_ID']) . '/' . md5($PersonID) . '/';

        $query = "SELECT FullName, Status FROM persons WHERE PersonID = $PersonID";
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
                            $library = new PersonLibrary();
                            $library->addDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : array();
                    $smarty->assign(array(
                        'info' => array_merge($arr, $info),
                    ));
                    $center_file = 'persons_docs_new.tpl';
                    break;
                case 'edit':
                    $DocID = (int)$_GET['DocID'];
                    $library = new PersonLibrary($DocID);
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
                    $center_file = 'persons_docs_new.tpl';
                    break;
                case 'del':
                    $DocID = (int)$_GET['DocID'];
                    $library = new PersonLibrary($DocID);
                    $info = $library->getDoc();
                    @unlink($info['curr_filename']);
                    $library->delDoc();
                    header('Location: ./?m=persons&o=docs&PersonID=' . $PersonID);
                    exit;
                    break;
            }

        } else {

            $action = !empty($_GET['action2']) ? $_GET['action2'] : 'default';
            $docs = PersonLibrary::getAllDocuments($action);

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
                    $smarty->display('persons_docs_print.tpl');
                    exit;
                    break;
                default:
                    $smarty->assign(array(
                        'info' => $info,
                        'docs' => $docs,
                        'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'],
                    ));
                    $center_file = 'persons_docs.tpl';
                    break;
            }
        }

        break;

    case 'intretinere':

        $PersonID = (int)$_GET['PersonID'];

        if ($_GET['action']) {

            Person::setPersonsByIntretinere($PersonID);
            header('Location: ./?m=persons&o=intretinere&PersonID=' . $PersonID);
            exit;

        } else {
            $persons = Person::getPersonsByIntretinere($PersonID);
            $smarty->assign(array(
                'info' => $persons[0],
                'persons' => $persons,
                'quality' => Person::$msQuality,
            ));
            $center_file = 'persons_intretinere.tpl';
        }

        break;

    case 'asistate':

        $PersonID = (int)$_GET['PersonID'];

        if ($_GET['action']) {

            Person::setPersonsByAsistate($PersonID);
            header('Location: ./?m=persons&o=asistate&PersonID=' . $PersonID);
            exit;

        } else {
            $persons = Person::getPersonsByAsistate($PersonID);
            $smarty->assign(array(
                'info' => $persons[0],
                'persons' => $persons,
                'quality' => Person::$msQuality,
            ));
            $center_file = 'persons_asistate.tpl';
        }

        break;

    case 'cm':

        $PersonID = (int)$_GET['PersonID'];

        if ($_GET['action']) {

            Person::setPersonsByCM($PersonID);
            header('Location: ./?m=persons&o=cm&PersonID=' . $PersonID);
            exit;

        } else {
            $cm = Person::getPersonsByCM($PersonID);
            $cmPayroll = PayRoll::getCM($PersonID);
            $smarty->assign(array(
                'info' => $cm[0],
                'cm' => $cm,
                'cmPayroll' => $cmPayroll,
                'documents' => ConfigData::$cmDoc,
            ));
            $center_file = 'persons_cm.tpl';
        }

        break;

    case 'projects':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        $curr_year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');
        $curr_month = !empty($_GET['Month']) ? $_GET['Month'] : date('m');

        $projects_list = Project::getActiveProjects();

        if ($_GET['action']) {
            $person->setPersonProjects($_POST);
            //header('Location: ./?m=persons&o=projects&PersonID=' . $PersonID);
            exit;

        } else {
            $projects = $person->getPersonProjects();
            $smarty->assign(array(
                'info' => $projects[0],
                'years' => range(date('Y') - 1, date('Y') + 1),
                'curr_year' => $curr_year,
                'months' => range(1, 12),
                'curr_month' => $curr_month,
                'hours' => range(0, 1200),
                'projects' => $projects,
                'projects_list' => $projects_list,
            ));
            $center_file = 'persons_projects.tpl';
        }

        break;

    case 'antropometrie':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Person::setAntropometrie($PersonID, $_POST);

                echo "<body onload=\"window.location.href = './?m=persons&o=antropometrie&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'grupa_sangvina' => Person::$msGrupaSangvina,
            'sang_hr' => Person::$msSangHR,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : Person::getAntropometrie($PersonID),
        ));
        $center_file = 'persons_antropometrie.tpl';

        break;

    case 'induction':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Application::setInductionByPerson($PersonID, $_POST);
                echo "<body onload=\"window.location.href = './?m=persons&o=induction&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        if (!empty($_GET['del']) && !empty($_GET['ID'])) {

            try {

                Application::delInductionByPerson($PersonID, $_GET['ID']);
                echo "<body onload=\"window.location.href = './?m=persons&o=induction&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $induction = Application::getInductionByPerson($PersonID);

        $smarty->assign(array(
            'info' => $induction,
            'employees' => Person::getEmployees(),
            'etica' => ConfigData::$etica,
            'prototype' => 1,
        ));
        if ($_GET['action'] == 'print') {
            $smarty->display('persons_induction_print.tpl');
            exit;
        } else {
            $center_file = 'persons_induction.tpl';
        }

        break;

    case 'military':

        $PersonID = (int)$_GET['PersonID'];
        $person = new Person($PersonID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $person->setMilitary($PersonID, $_POST);

                echo "<body onload=\"window.location.href = './?m=persons&o=military&PersonID={$PersonID}&msg=1'\"></body>";
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

        $center_file = 'persons_military.tpl';

        break;

    case 'events':

        $PersonID = (int)$_GET['PersonID'];

        $events = Event::getEventsByPerson($PersonID);
        $info = $events[0];
        unset($events[0]);
        $smarty->assign(array(
            'eventType' => Event::$msEventType,
            'eventRelation' => Event::$msEventRelation,
            'events' => $events,
            'info' => $info,
        ));
        $center_file = 'persons_events.tpl';

        break;

    case 'jobs':

        $PersonID = (int)$_GET['PersonID'];

        $jobs = Job::getJobsByPerson($PersonID);
        $info = $jobs[0];
        unset($jobs[0]);
        $smarty->assign(array(
            'jobs' => $jobs,
            'info' => $info,
        ));
        $center_file = 'persons_jobs.tpl';

        break;

    case 'catering':

        $PersonID = (int)$_GET['PersonID'];

        if (!empty($_POST)) {

            try {

                Application::setCateringByPerson($PersonID, $_GET['StartDate'], $_GET['EndDate']);
                echo "<body onload=\"window.location.href = './?m=persons&o=catering&PersonID={$PersonID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $catering = Application::getCateringByPerson($PersonID, $_GET['StartDate'], $_GET['EndDate']);
        $smarty->assign(array(
            'info' => $catering[0],
            'catering' => $catering,
        ));
        if ($_GET['action'] == 'print') {
            $smarty->display('persons_catering_print.tpl');
            exit;
        } else {
            $center_file = 'persons_catering.tpl';
        }

        break;

    case 'matching_persons':

        if (!empty($_POST['src_person']) && !empty($_POST['dst_person'])) {
            print_r($_POST);
        }

        $query = "SELECT a.PersonID, a.FullName, a.CNP, c.CompanyName
	          FROM   persons a
		         INNER JOIN payroll b ON a.PersonID = b.PersonID
			 INNER JOIN companies c ON b.CompanyID = c.CompanyID
		  WHERE  a.status IN (2,7,9,10,12) 
		  ORDER  BY a.FullName";
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $persons[$row['PersonID']] = $row['FullName'] . (!empty($row['CNP']) ? ' (' . $row['CNP'] . ')' : '') . ' - ' . $row['CompanyName'];
        }


        $smarty->assign(array(
            'persons' => $persons,
        ));

        $center_file = 'persons_matching.tpl';

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][1][1] > 0)) {
            $center_file = 'persons_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Person::getAllPersons($action);

        $personalisedlist = Utils::getPersonalisedList('Personal');

        $status = Person::$msStatus;
        $maritalstatus = Person::$msMaritalStatus;
        $cvstatus = Person::$msCVStatus;
        $costcenter = Utils::getCostCenter();
        $jobtitles = Job::getJobsTitle();
        $functions = Utils::getFunctions();
        $internal_functions = Utils::getInternalFunctions();
        $studies = Person::$msStudies;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $divisions = Utils::getDivisions();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $roles = User::getRoles();
        $CAS = ConfigData::$msHealthCompanies;
        $smarty->assign('customfields', Utils::getCustomFields());

        $smarty->assign('CAS', $CAS);
        $smarty->assign('CF1', Utils::getCustomFieldsData());

        if (!empty($_GET['res_per_page'])) {
            $_SESSION['res_per_page'] = (int)$_GET['res_per_page'];
        }

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
                    } else {
                        foreach ($personalisedlist['Personal'] AS $field => $name) {
                            if ($field == 'Status')
                                $excel[$k][$name] = $status[$person[$field]];
                            elseif ($field == 'MaritalStatus')
                                $excel[$k][$name] = $maritalstatus[$person[$field]];
                            elseif ($field == 'CVStatus')
                                $excel[$k][$name] = $cvstatus[$person[$field]];
                            elseif ($field == 'CompanyID')
                                $excel[$k][$name] = $self[$person[$field]];
                            elseif ($field == 'DivisionID')
                                $excel[$k][$name] = $divisions[$person[$field]];
                            elseif ($field == 'DepartmentID')
                                $excel[$k][$name] = $departments[$person[$field]];
                            elseif ($field == 'SubDepartmentID')
                                $excel[$k][$name] = $subdepartments[$person[$field]];
                            elseif ($field == 'CostCenterID')
                                $excel[$k][$name] = $person['CostCenters'];
                            elseif ($field == 'JobDictionaryID')
                                $excel[$k][$name] = $jobtitles[$person[$field]];
                            elseif ($field == 'Studies')
                                $excel[$k][$name] = $studies[$person[$field]];
                            elseif ($field == 'ContractType')
                                $excel[$k][$name] = $contract_type[$person[$field]];
                            elseif ($field == 'FunctionID')
                                $excel[$k][$name] = $functions[$person[$field]]['Function'] . ' - ' . $functions[$person[$field]]['COR'];
                            elseif ($field == 'InternalFunction')
                                $excel[$k][$name] = $internal_functions[$person[$field]];
                            elseif ($field == 'RoleID')
                                $excel[$k][$name] = $roles[$person[$field]];
                            elseif ($field == 'FirmAge')
                                $excel[$k][$name] = $person['prof']['years'] . '/' . $person['prof']['months'] . '/' . $person['prof']['days'];
                            else
                                $excel[$k][$name] = $person[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'persoane');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=persoane.doc");
                //unset($persons[0]);
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'internal_functions' => $internal_functions,
                    'roles' => $roles,
                    'contract_type' => PayRoll::$msContractType,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('persons_print.tpl');
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
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'internal_functions' => $internal_functions,
                    'roles' => $roles,
                    'contract_type' => PayRoll::$msContractType,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('persons_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => $costcenter,
                    'self' => $self,
                    'departments' => $departments,
                    'subdepartments' => $subdepartments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'internal_functions' => $internal_functions,
                    'roles' => $roles,
                    'contract_type' => PayRoll::$msContractType,
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'studies' => $studies,
                    'languages' => Utils::getLanguages(),
                    'localitati' => Utils::getLocalitatiByCV(),
                    'tari' => Utils::getTariByCV(),
                    'health_companies' => ConfigData::$msHealthCompanies,
                    'customfields' => Utils::getCustomFields(),
                    'customperson1' => Utils::getCustomFieldValues('persons', 'CustomPerson1'),
                    'request_uri' => $request_uri,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'persons.tpl';
                break;
        }

        break;
}

?>
