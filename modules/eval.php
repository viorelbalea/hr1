<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

$_SESSION['PersonID'] = !empty($_GET['PersonID']) ? $_GET['PersonID'] : $_SESSION['PERS'];

switch ($o) {
    ###################### FORMULARE Evaluari DRAFT  --> OK ######################################################################
    ##########################################################################################################################
    case 'formsDraft':
        $evalFormsDraft = Evals::getEvalFormsDraft();
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {

                case 'print_page':
                case 'print_all':
                    //unset($evalFormsDraft[0]);
                    $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('eval_forms_draft_print.tpl');
                    exit;
                    break;
                case 'export_doc':
                    header("Content-Type: application/vnd.ms-word");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("content-disposition: attachment;filename=formulare_evaluare.doc");
                    $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('eval_forms_draft_print.tpl');
                    exit;
                    break;
                case 'export':
                    $excel = array();
                    foreach ($evalFormsDraft as $k => $v) {
                        $excel[$k]['Nume formular'] = $v['FormName'];
                        $excel[$k]['Numar asignari'] = $v['AssignedForms'];
                        $excel[$k]['Data creare'] = $v['CreateDate'];
                    }
                    include("libs/xlsStream.php");
                    export_file($excel, 'formulare_evaluare');
                    break;
            }
        } else {
            $request_uri = !empty($_GET['res_per_page']) ? "./?m=eval&o=formsDraft&FunctionID={$_GET['FunctionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=eval&o=formsDraft";
            $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                'evalPersonsFormsDraft' => Evals::getAllPersonsByFormsDraft(),
                'request_uri' => $request_uri,
            ));
            # Pagination
            $pagination = Utils::paginate($evalFormsDraft[0]['pageNo'], $evalFormsDraft[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
            $smarty->assign('pagination', $pagination);

            $center_file = 'eval_forms_draft.tpl';
        }
        break;

    ###################### Asign evaluation to Person ######################################################################
    ##########################################################################################################################
    case 'evalAssign':
        if (!empty($_POST)) {
            try {
                $EvalFormID = Evals::setEvalToPerson($_POST);
                header('Location: ./?m=eval&o=eval&EvalFormID=' . $EvalFormID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'forms' => Evals::getAllEvalFormsDraft(),
            'functions' => Utils::getFunctions(),
        ));
        $center_file = 'eval_assign.tpl';


        break;

    ###################### Evaluare DRAFT ######################################################################
    ##########################################################################################################################
    case 'evalDraft':

        $EvalFormDraftID = !empty($_GET['EvalFormDraftID']) ? (int)$_GET['EvalFormDraftID'] : 0;

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new':
                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            $EvalFormDraftID = Evals::addEvalFormDraft();
                            header('Location: ./?m=eval&o=evalDraft&EvalFormDraftID=' . $EvalFormDraftID . '&action=edit');
                            exit;
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $center_file = 'eval_draft_new.tpl';

                    break;
                case 'edit':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];

                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            Evals::editEvalFormDraft($EvalFormDraftID, $_POST);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $form = Evals::getEvalFormDraft($EvalFormDraftID);
                    $persons = Evals::getPersonsByFunction($form['FunctionID']);

                    $smarty->assign(array(
                        'form' => $form,
                        'evaledPersons' => Evals::getPersonsByFormDraft($EvalFormDraftID),
                        'sections' => Evals::getFormDraftSections($EvalFormDraftID),
                    ));
                    if (!empty($_GET['export_doc'])) {
                        header("Content-Type: application/vnd.ms-word");

                        header("Expires: 0");

                        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");

                        header("content-disposition: attachment;filename=evaluare_" . str_replace(" ", "_", $form['FormName']) . ".doc");

                        $content = $smarty->fetch('eval_draft_print.tpl');

                        //$content=preg_replace("/<img[^>]+\>/i", "", $content);

                        echo $content;

                        exit;
                    }
                    $center_file = 'eval_draft_new.tpl';
                    break;
                case 'new_section':
                case 'edit_section':
                case 'del_section':
                    Evals::setSection();
                    header('Location: ./?m=eval&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
                    exit;
                    break;


                case 'edit_question':
                case 'del_question':
                    if ($_GET['EvalQuestionID'] != '') {
                        try {
                            Evals::addEvalQuestion($_GET['EvalQuestionID']);
                            header('Location: ./?m=eval&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
                            exit;
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    exit;
                    break;

                case 'clone':

                    if (!empty($_GET['EvalFormDraftID'])) {
                        $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
                        $newEvalFormDraftID = Evals::cloneEvalFormDraft($EvalFormDraftID);
                    }
                    header('Location: ./?m=eval&o=evalDraft&EvalFormDraftID=' . $newEvalFormDraftID . '&action=edit');
                    exit;
                    break;

                case 'delete':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
                    try {
                        Evals::deleteEvalFormDraft($EvalFormDraftID);
                    } catch (Exception $exp) {
                        $err->setError($exp->getMessage());
                    }
                    header('Location: ./?m=eval&o=formsDraft');
                    exit;
                    break;
            }
        } else {
            $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
            $evalFormsDraft = Evals::getEvalFormsDraft();
            $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                'evaledPersons' => Evals::getPersonsByFormDraft($EvalFormDraftID),
                'request_uri' => !empty($_GET['res_per_page']) ? "./?m=eval&o=formsDraft&FunctionID={$_GET['FunctionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=eval",
            ));
            $center_file = 'eval_draft_new.tpl';
        }
        break;


    ###################### FORMULARE Evaluari personal  ######################################################################
    ##########################################################################################################################
    case 'forms':
    default:
        /*
            if (!($FullName = Evals::getPersonByID($_SESSION['PersonID']))) {
                header('Location: ./?m=eval&o=evalPersons');
                exit;
            }
        */
        $evalForms = Evals::getEvalForms((int)$_GET['PersonID']);
        $internal_functions = Utils::getInternalFunctions();

        switch ($_GET['action']) {

            case 'delete';
                $EvalFormID = (int)$_GET['EvalFormID'];
                Evals::deleteEvalForm($EvalFormID);
                header('Location: ./?m=eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;

            case 'set_mediation';
                $EvalFormID = (int)$_GET['EvalFormID'];
                Evals::setMediation($EvalFormID);
                header('Location: ./?m=eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;
            case 'export':
                $excel = array();
                unset($evalForms[0]);
                foreach ($evalForms as $k => $v) {
                    $excel[$k]['Nume formular'] = $v['FormName'];
                    $excel[$k]['Persoana evaluata'] = $v['FullName'];
                    $excel[$k]['Functie'] = $v['Function'];
                    $excel[$k]['Functie interna'] = $v['InternalFunction'];
                    $excel[$k]['Date inceput'] = $v['StartDate'];
                    $excel[$k]['Data sfarsit'] = $v['EndDate'];
                    $excel[$k]['Calificativ autoevaluare'] = $v['Completed'] == 1 ? $v['SelfWeighted'] : '-';
                    $excel[$k]['Calificativ evaluator'] = $v['Approved'] == 1 ? $v['ManagerWeighted'] : '-';
                    $excel[$k]['Calificativ mediator'] = $v['Mediated'] == 1 ? $v['MediatorWeighted'] : '-';
                }
                include("libs/xlsStream.php");
                export_file($excel, 'formulare_evaluari_' . str_replace(' ', '_', $FullName));
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array('evalForms' => $evalForms,
                    'internal_functions' => $internal_functions,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('eval_forms_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=formulare_evaluari_" . str_replace(' ', '_', $FullName) . ".doc");
                $smarty->assign(array('evalForms' => $evalForms,
                    'internal_functions' => $internal_functions,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('eval_forms_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array('evalForms' => $evalForms,
                    'persons' => Evals::getAllPersons(),
                    'internal_functions' => $internal_functions,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($evalForms[0]['pageNo'], $evalForms[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'eval_forms.tpl';
                break;
        }

        break;

    ############################### Evaluare ################################################################
    #########################################################################################################

    case 'eval':

        $evalPersonID = Evals::getPersonByForm($_GET['EvalFormID']);
        /*
            if (!($FullName = Evals::getPersonByID($evalPersonID))) {
                header('Location: ./?m=eval&o=eval');
                exit;
            }
        */
        //Utils::pa($_POST);
        if (!empty($_POST)) {
            Evals::editEval($_POST);

            if (!empty($_POST['Completed']))
                Evals::completeEvalForm((int)$_POST['Completed'], (int)$_GET['EvalFormID']);

            //if is Manager
            Evals::editEvalByManager($_POST);
            if (!empty($_POST['Approved']))
                Evals::approveEvalForm((int)$_POST['Approved'], (int)$_GET['EvalFormID']);

            //if is Manager 2
            Evals::editEvalByManager2($_POST);
            if (!empty($_POST['Approved2']))
                Evals::approveEvalForm2((int)$_POST['Approved2'], (int)$_GET['EvalFormID']);

            //if is Mediator
            Evals::editEvalByMediator($_POST);
            if (!empty($_POST['Mediated']))
                Evals::mediateEvalForm((int)$_POST['Mediated'], (int)$_GET['EvalFormID']);

            if (!empty($_POST['ShowResults'])) {
                Evals::showResultsForm((int)$_POST['ShowResults'], (int)$_GET['EvalFormID']);
            }

            header('Location: ./?m=eval&o=eval&EvalFormID=' . (int)$_GET['EvalFormID']);
        }


        $eval = Evals::getEval($_GET['EvalFormID']);

        $StartDate = $eval['StartDate'];
        $EndDate = $eval['EndDate'];
        $FormCode = $eval['FormCode'];
        $FormDesc = nl2br($eval['FormDesc']);
        unset($eval['StartDate']);
        unset($eval['EndDate']);
        unset($eval['FormCode']);
        unset($eval['FormDesc']);

        $Person = new Person($evalPersonID);
        //$PersonInfo		= $Person->getPerson();
        $PersonInfo = Evals::getPersonDataByForm($_GET['EvalFormID']);
        $Completed = Evals::getCompletedStatus($_GET['EvalFormID']);
        $Approved = Evals::getApprovedStatus($_GET['EvalFormID']);
        $Approved2 = Evals::getSecondaryApprovedStatus($_GET['EvalFormID']);
        $Mediated = Evals::getMediatedStatus($_GET['EvalFormID']);
        $ShowResults = Evals::getShowResults($_GET['EvalFormID']);
        //colectare date pt CEB
        // date despre persoana evaluata
        $conn->query("select p.EmpCode as Marca, d.Department as Department, f.Function as Function, p.StartDate as StartDate, pp.ManagerID as ManagerID from payroll p inner join persons pp on p.PersonID=pp.PersonID  left join departments d on p.DepartmentID=d.DepartmentID left join functions f on p.FunctionID=f.FunctionID where p.PersonID=$evalPersonID limit 1");
        $personInfo = $conn->fetch_array();
        //date despre evaluator
        $managerID = $personInfo['ManagerID'];
        $conn->query("select pp.Fullname as Fullname, d.Department as Department, f.Function as Function, p.StartDate as StartDate, pp.ManagerID as ManagerID from payroll p inner join persons pp on p.PersonID=pp.PersonID  left join departments d on p.DepartmentID=d.DepartmentID left join functions f on p.FunctionID=f.FunctionID where p.PersonID=$managerID limit 1");
        $managerInfo = $conn->fetch_array();

        if ($_SESSION['PersonID'] == $evalPersonID && ($_SESSION['ACCESSEVAL'] != 2 && $_SESSION['ACCESSEVAL'] != 3)) {
            $isPerson = true;
        }
        if ($_SESSION['PersonID'] != $evalPersonID && Evals::getEvaluatorRank($_SESSION['PersonID'], $evalPersonID) == 1) {
            $isManager = true;
        }
        if ($_SESSION['PersonID'] != $evalPersonID && Evals::getEvaluatorRank($_SESSION['PersonID'], $evalPersonID) == 2) {
            $isManager2 = true;
        }
        if ($_SESSION['PersonID'] != $evalPersonID && ($_SESSION['ACCESSEVAL'] == 2 || $_SESSION['ACCESSEVAL'] == 3)) {
            $isMediator = true;
        }
        $markSum = "";
        foreach ($eval as $value => $item) {
            foreach ($item as $key => $row) {
                //echo "<pre>"; print_r($row['Question']); echo "</pre>";
                $eval[$value][$key]['Question'] = nl2br($row['Question']);
                $mark += $row['Mark'];
            }
        }

        $smarty->assign(array(
            'eval' => $eval,
            'StartDate' => $StartDate,
            'EndDate' => $EndDate,
            'FormCode' => $FormCode,
            'FormDesc' => $FormDesc,
            'evalPersonID' => $evalPersonID,
            'person' => $PersonInfo,
            'Completed' => $Completed,
            'Approved' => $Approved,
            'Approved2' => $Approved2,
            'Mediated' => $Mediated,
            'ShowResults' => $ShowResults,
            'isPerson' => $isPerson,
            'isManager' => $isManager,
            'isManager2' => $isManager2,
            'isMediator' => $isMediator,
            'personInfo' => $personInfo,
            'managerInfo' => $managerInfo,
            'mark' => $mark

        ));

        if ($_GET['action'] == 'export_doc') {
            header("Content-type: application/vnd.ms-excel;charset=UTF-8");
            header("content-disposition: attachment;filename=evaluare_" . $FullName . ".doc");
            header("Cache-control: private");

            /*header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=evaluare_" . $FullName . ".doc");*/
            $smarty->display('eval_print.tpl');
            exit;
        }
        if ($_GET['action'] == 'print_all') {

            $smarty->display('eval_print.tpl');
            exit;

        } else {
            if ($_GET['view'] == 'normal') {
                $center_file = 'eval.tpl';
            } elseif ($_GET['view'] == 'CEB') {
                $center_file = 'eval_CEB.tpl';
            } else
                $center_file = 'eval.tpl';
        }

        break;
    case 'graph_eval':
        $DraftID = (int)$_GET['DraftID'];
        $PersonID = (int)$_GET['PersonID'];
        $smarty->assign(array(
            'eval_graph' => Evals::generateEvalGraph($DraftID, $PersonID),
        ));

        $smarty->display('eval_graphs.tpl');
        exit;
        break;
    // evaluari angajati
    case 'evalPersons':

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Evals::getAllPersons($action);

        $personalisedlist = Utils::getPersonalisedList('Eval');
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
                    if (empty($personalisedlist['Eval'])) {
                        $excel[$k]['District'] = $person['DistrictName'];
                        $excel[$k]['City'] = $person['CityName'];
                        $excel[$k]['Email'] = $person['Email'];
                        $excel[$k]['Mobile'] = $person['Mobile'];
                    } else {
                        foreach ($personalisedlist['Eval'] AS $field => $name) {
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
                export_file($excel, 'persoane_evaluari');

                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=persoane_evaluate.doc");
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
                $smarty->display('eval_print.tpl');
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
                $smarty->display('eval_print.tpl');
                exit;
                break;

            default:
                $status = Person::$msStatus;
                unset($status[1], $status[3], $status[4]);
                $request_uri = "./?m=eval&o=evalPersons&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&CostCenterID={$_GET['CostCenterID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}";
                $smarty->assign(array(
                    'persons' => $persons,
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

                $center_file = 'eval_persons.tpl';

                break;
        }

        break;
}

?>