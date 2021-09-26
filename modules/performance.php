<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

$_SESSION['PersonID'] = !empty($_GET['PersonID']) ? $_GET['PersonID'] : $_SESSION['PERS'];

switch ($o) {

    #######################  Obiective proprii  ####################################################
    case 'goals':

        if (!($FullName = Performance::getPersonByID($_SESSION['PersonID']))) {
            header('Location: ./?m=performance&o=objective');
            exit;
        }

        $Year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new';

                    if (!empty($_POST)) {
                        Performance::newGoal();
                        header('Location: ./?m=performance&o=goals&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                        exit;
                    }
                    if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS'][9] == 1) {
                        Performance::$msPerformanceStatus = array(1 => Performance::$msPerformanceStatus[1]);
                    }

                    break;

                case 'edit';

                    $PerfID = (int)$_GET['PerfID'];

                    if (!empty($_POST)) {
                        Performance::editGoal($PerfID);
                        header('Location: ./?m=performance&o=goals&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                        exit;
                    } else {
                        $smarty->assign(array('goal' => Performance::getGoal($PerfID)));
                    }
                    if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS'][9] == 1) {
                        Performance::$msPerformanceStatus = array(1 => Performance::$msPerformanceStatus[1]);
                    }

                    break;

                case 'history';

                    $PerfID = (int)$_GET['PerfID'];

                    if ($_SESSION['USER_ID'] == 1 && !empty($_GET['DetailID']) && !empty($_POST)) {
                        Performance::editGoalHistory($PerfID, (int)$_GET['DetailID']);
                        header('Location: ./?m=performance&o=goals&action=history&PersonID=' . $_SESSION['PersonID'] . '&PerfID=' . $PerfID . '&Year=' . $Year);
                        exit;
                    }

                    $smarty->assign(array('goal' => Performance::getGoalHistory($PerfID)));

                    break;

                case 'delete';

                    $PerfID = (int)$_GET['PerfID'];

                    Performance::deleteGoal($PerfID);
                    header('Location: ./?m=performance&o=goals&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                    exit;

                    break;

                case 'delete_history';

                    $PerfID = (int)$_GET['PerfID'];
                    $DetailID = (int)$_GET['DetailID'];

                    Performance::deleteGoalHistory($PerfID, $DetailID);
                    header('Location: ./?m=performance&o=goals&action=history&PersonID=' . $_SESSION['PersonID'] . '&PerfID=' . $PerfID . '&Year=' . $Year);
                    exit;

                    break;
            }

        } else {

            if (!empty($_POST)) {
                foreach ($_POST['Pos'] as $PerfID => $Pos) {
                    $Pos = (int)$Pos;
                    $conn->query("UPDATE performance SET Pos = $Pos WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
                }
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            }

            $goals = Performance::getGoals($Year);

            if (!empty($_GET['export'])) {

                $excel = array();
                $dimensions = Performance::getDimensions();
                foreach ($goals as $k => $v) {
                    $excel[$k]['Dimeniunea HCM'] = $dimensions[$v['DimensionID']]['Dimension'];
                    $excel[$k]['Actiune / Obiectiv'] = $v['Goal'];
                    $excel[$k]['Pondere'] = $v['Pondere'];
                    $excel[$k]['Termen'] = $v['Deadline'];
                    $excel[$k]['Status'] = Performance::$msPerformanceStatus[$v['StatusID']];
                    $excel[$k]['Comentariu'] = $v['Comment'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'obiective_' . str_replace(' ', '_', $FullName));

            } else {

                $smarty->assign(array('goals' => $goals));
            }
        }

        $smarty->assign(array(
            'status' => Performance::$msPerformanceStatus,
            'calif' => Performance::$msPerformanceCalif,
            'dimensions' => Performance::getDimensions(),
            'FullName' => $FullName,
            'years' => range(date('Y') - 1, date('Y') + 2),
            'Year' => $Year,
            'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
        ));
        if (!empty($_GET['export_doc'])) {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=obiective_" . str_replace(' ', '_', $FullName) . ".doc");
            $smarty->display('performance_goals_print.tpl');
            exit;

        }
        if (!empty($_GET['print'])) {

            $smarty->display('performance_goals_print.tpl');
            exit;

        } elseif (!empty($_GET['print_history'])) {

            $smarty->display('performance_goals_history_print.tpl');
            exit;

        } else {

            $center_file = 'performance_goals.tpl';
        }

        break;


    // plan actiuni
    case 'plan':

        if (!($FullName = Performance::getPersonByID2($_SESSION['PersonID']))) {
            header('Location: ./?m=performance&o=divizii');
            exit;
        }

        $Year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new';

                    if (!empty($_POST)) {
                        Performance::newPlan();
                        header('Location: ./?m=performance&o=plan&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                        exit;
                    }
                    if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS'][9] <= 2) {
                        Performance::$msPerformanceStatus = array(1 => Performance::$msPerformanceStatus[1]);
                    }

                    break;

                case 'edit';

                    $PerfID = (int)$_GET['PerfID'];

                    if (!empty($_POST)) {
                        Performance::editPlan($PerfID);
                        header('Location: ./?m=performance&o=plan&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                        exit;
                    } else {
                        $smarty->assign(array('plan' => Performance::getPlan($PerfID)));
                    }

                    break;

                case 'history';

                    $PerfID = (int)$_GET['PerfID'];

                    if ($_SESSION['USER_ID'] == 1 && !empty($_GET['DetailID']) && !empty($_POST)) {
                        Performance::editPlanHistory($PerfID, (int)$_GET['DetailID']);
                        header('Location: ./?m=performance&o=plan&action=history&PersonID=' . $_SESSION['PersonID'] . '&PerfID=' . $PerfID . '&Year=' . $Year);
                        exit;
                    }

                    $smarty->assign(array('plan' => Performance::getPlanHistory($PerfID)));

                    break;

                case 'delete';

                    $PerfID = (int)$_GET['PerfID'];

                    Performance::deletePlan($PerfID);
                    header('Location: ./?m=performance&o=plan&PersonID=' . $_SESSION['PersonID'] . '&Year=' . $Year);
                    exit;

                    break;

                case 'delete_history';

                    $PerfID = (int)$_GET['PerfID'];
                    $DetailID = (int)$_GET['DetailID'];

                    Performance::deletePlanHistory($PerfID, $DetailID);
                    header('Location: ./?m=performance&o=plan&action=history&PersonID=' . $_SESSION['PersonID'] . '&PerfID=' . $PerfID . '&Year=' . $Year);
                    exit;

                    break;
            }

        } else {

            if (!empty($_POST)) {
                foreach ($_POST['Pos'] as $PerfID => $Pos) {
                    $Pos = (int)$Pos;
                    $conn->query("UPDATE performance_plan SET Pos = $Pos WHERE PerfID = $PerfID AND PersonID = '{$_SESSION['PersonID']}'");
                }
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;
            }

            $plans = Performance::getPlans($Year);

            if (!empty($_GET['export'])) {

                $excel = array();
                $dimensions = Performance::getDimensions();
                foreach ($plans as $k => $v) {
                    $excel[$k]['Dimeniunea HCM'] = $dimensions[$v['DimensionID']]['Dimension'];
                    $excel[$k]['Actiune / Obiectiv'] = $v['Goal'];
                    $excel[$k]['Termen'] = $v['Deadline'];
                    $excel[$k]['Status'] = Performance::$msPerformanceStatus[$v['StatusID']];
                    $excel[$k]['Comentariu'] = $v['Comment'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'plan_actiuni_' . str_replace(' ', '_', $FullName));

            } else {

                $smarty->assign(array('plans' => $plans));
            }
        }

        $smarty->assign(array(
            'status' => Performance::$msPerformanceStatus,
            'dimensions' => Performance::getDimensions(),
            'FullName' => $FullName,
            'years' => range(date('Y') - 1, date('Y') + 2),
            'Year' => $Year,
        ));

        if (!empty($_GET['print'])) {

            $smarty->display('performance_plan_print.tpl');
            exit;

        } elseif (!empty($_GET['print_history'])) {

            $smarty->display('performance_plan_history_print.tpl');
            exit;

        } else {

            $center_file = 'performance_plan.tpl';
        }

        break;

    // actiuni divizii
    case 'divizii':
    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $actions = Performance::getAllActions($action);

        switch ($action) {
            case 'export':
                unset($actions[0]);
                $divisions = Utils::getDivisionsAdmin();
                $departments = Utils::getDepartmentsAdmin();
                $dimensions = Performance::getDimensions();
                $excel = array();
                foreach ($actions as $k => $v) {
                    $excel[$k]['Divizia'] = $divisions[$v['DivisionID']]['Division'];
                    $excel[$k]['Departament'] = $departments[$v['DepartmentID']]['Department'];
                    $excel[$k]['Dimensiune'] = $dimensions[$v['DimensionID']]['Dimension'];
                    $excel[$k]['Actiune'] = stripslashes($v['Goal']);
                    $excel[$k]['Status'] = Performance::$msPerformanceStatus[$v['StatusID']];
                    $excel[$k]['Manager'] = $v['FullName'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'actiuni_divizii');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=actiuni_divizii.doc");
                $smarty->assign(array(
                    'actions' => $actions,
                    'departments' => Utils::getDepartmentsAdmin(),
                    'divisions' => Utils::getDivisionsAdmin(),
                    'dimensions' => Performance::getDimensions(),
                    'status' => Performance::$msPerformanceStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('performance_actiuni_divizii_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'actions' => $actions,
                    'departments' => Utils::getDepartmentsAdmin(),
                    'divisions' => Utils::getDivisionsAdmin(),
                    'dimensions' => Performance::getDimensions(),
                    'status' => Performance::$msPerformanceStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('performance_actiuni_divizii_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "?m=performance&o=divizii&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}&StatusID={$_GET['StatusID']}&Year={$_GET['Year']}&DimensionID={$_GET['DimensionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=performance&o=divizii";
                $smarty->assign(array(
                    'actions' => $actions,
                    'years' => range(date('Y') - 1, date('Y') + 2),
                    'departments' => Utils::getDepartmentsAdmin(),
                    'divisions' => Utils::getDivisionsAdmin(),
                    'dimensions' => Performance::getDimensions(),
                    'status' => Performance::$msPerformanceStatus,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($actions[0]['pageNo'], $actions[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'performance_actiuni_divizii.tpl';
                break;
        }

        break;

    // obiective angajati
    case 'evalPersons':
    case 'objective':
//Utils::pa($_SESSION);
        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Performance::getAllPersons($action);
        $personalisedlist = Utils::getPersonalisedList('Performance');
        $costcenter = Utils::getCostCenter();
        $divisions = Utils::getDivisions();
        $departments = Utils::getDepartments();
        $jobtitles = Job::getJobsTitle();
        $functions = Utils::getFunctions();

        switch ($action) {
            case 'export':
                unset($persons[0]);
                $excel = array();
                foreach ($persons as $k => $person) {
                    $excel[$k]['Name'] = $person['FullName'];
                    if (empty($personalisedlist['Performance'])) {
                        $excel[$k]['District'] = $person['DistrictName'];
                        $excel[$k]['City'] = $person['CityName'];
                        $excel[$k]['Email'] = $person['Email'];
                        $excel[$k]['Mobile'] = $person['Mobile'];
                    } else {
                        foreach ($personalisedlist['Performance'] AS $field => $name) {
                            if ($field == 'DivisionID')
                                $excel[$k][$name] = $divisions[$person[$field]];
                            elseif ($field == 'DepartmentID')
                                $excel[$k][$name] = $departments[$person[$field]];
                            elseif ($field == 'CostCenterID')
                                $excel[$k][$name] = $person['CostCenters'];
                            elseif ($field == 'JobDictionaryID')
                                $excel[$k][$name] = $jobtitles[$person[$field]];
                            elseif ($field == 'FunctionID')
                                $excel[$k][$name] = $functions[$person[$field]]['Function'] . ' - ' . $functions[$person[$field]]['COR'];
                            else
                                $excel[$k][$name] = $person[$field];
                        }
                    }

                }
                include("libs/xlsStream.php");
                export_file($excel, 'performance');

                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=performance.doc");
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
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('performance_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
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
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('performance_print.tpl');
                exit;
                break;
            default:
                $status = Person::$msStatus;
                unset($status[1], $status[3], $status[4]);
                $request_uri = "./?m=performance&o=objective&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&DimensionID={$_GET['DimensionID']}&CostCenterID={$_GET['CostCenterID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}";
                $smarty->assign(array(
                    'persons' => $persons,
                    'dimensions' => Performance::getDimensions(),
                    'status' => $status,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'self' => Company::getSelfCompanies(),
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'request_uri' => $request_uri,
                ));

                # Pagination
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'performance.tpl';
                break;
        }

        break;
}

?>