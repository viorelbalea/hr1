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
        $evalFormsDraft = ColleaguesEvals::getEvalFormsDraft();
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {

                case 'print_page':
                case 'print_all':
                    //unset($evalFormsDraft[0]);
                    $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('colleagues_eval_forms_draft_print.tpl');
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
                    $smarty->display('colleagues_eval_forms_draft_print.tpl');
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
            $request_uri = !empty($_GET['res_per_page']) ? "./?m=colleagues-eval&o=formsDraft&FunctionID={$_GET['FunctionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=colleagues-eval&o=formsDraft";
            $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                'evalPersonsFormsDraft' => ColleaguesEvals::getAllPersonsByFormsDraft(),
                'request_uri' => $request_uri,
            ));
            # Pagination
            $pagination = Utils::paginate($evalFormsDraft[0]['pageNo'], $evalFormsDraft[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
            $smarty->assign('pagination', $pagination);

            $center_file = 'colleagues_eval_forms_draft.tpl';
        }
        break;
    ###################### Asign evaluation to Person ######################################################################
    ##########################################################################################################################
    case 'evalAssign':
        if (!empty($_POST)) {
            try {
                $EvalFormID = ColleaguesEvals::setEvalToPerson($_POST);
                header('Location: ./?m=colleagues-eval&o=eval&EvalFormID=' . $EvalFormID);

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'forms' => ColleaguesEvals::getAllEvalFormsDraft(),
            'functions' => Utils::getFunctions(),
            'relations' => ColleaguesEvals::$msFeedbackRelation,
            'persons' => ColleaguesEvals::getPersonsByFunction()
        ));
        $center_file = 'colleagues_eval_assign.tpl';


        break;

    ###################### Evaluare DRAFT ######################################################################
    ##########################################################################################################################
    case 'evalDraft':

        $EvalFormDraftID = !empty($_GET['EvalFormDraftID']) ? (int)$_GET['EvalFormDraftID'] : 0;

        if ($_GET['EvalQuestionID'] != '' || !empty($_GET['del'])) {
            try {
                ColleaguesEvals::addEvalQuestion($_GET['EvalQuestionID']);
                header('Location: ./?m=colleagues-eval&o=evalDraft&EvalFormDraftID=' . $EvalFormDraftID . '&action=edit');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new':
                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            $EvalFormDraftID = ColleaguesEvals::addEvalFormDraft();
                            header('Location: ./?m=colleagues-eval&o=evalDraft&EvalFormDraftID=' . $EvalFormDraftID . '&action=edit');
                            exit;
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $center_file = 'colleagues_eval_draft_new.tpl';

                    break;
                case 'edit':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];

                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            ColleaguesEvals::editEvalFormDraft($EvalFormDraftID, $_POST);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $form = ColleaguesEvals::getEvalFormDraft($EvalFormDraftID);
                    $persons = ColleaguesEvals::getPersonsByFunction($form['FunctionID']);

                    $smarty->assign(array(
                        'form' => $form,
                        'evaledPersons' => ColleaguesEvals::getPersonsByFormDraft($EvalFormDraftID),
                        'sections' => ColleaguesEvals::getFormDraftSections($EvalFormDraftID),
                    ));
                    $center_file = 'colleagues_eval_draft_new.tpl';
                    break;
                case 'new_section':
                case 'edit_section':
                case 'del_section':
                    ColleaguesEvals::setSection();
                    header('Location: ./?m=colleagues-eval&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
                    exit;
                    break;


                case 'edit_question':
                case 'del_question':
                    if ($_GET['EvalQuestionID'] != '') {
                        try {
                            ColleaguesEvals::addEvalQuestion($_GET['EvalQuestionID']);
                            header('Location: ./?m=colleagues-eval&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
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
                        $newEvalFormDraftID = ColleaguesEvals::cloneEvalFormDraft($EvalFormDraftID);
                    }
                    header('Location: ./?m=colleagues-eval&o=evalDraft&EvalFormDraftID=' . $newEvalFormDraftID . '&action=edit');
                    exit;
                    break;

                case 'delete':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
                    try {
                        ColleaguesEvals::deleteEvalFormDraft($EvalFormDraftID);
                    } catch (Exception $exp) {
                        $err->setError($exp->getMessage());
                    }
                    header('Location: ./?m=colleagues-eval&o=formsDraft');
                    exit;
                    break;
            }
        } else {
            $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
            $evalFormsDraft = ColleaguesEvals::getEvalFormsDraft();
            $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                'functions' => Utils::getFunctions(),
                'evaledPersons' => ColleaguesEvals::getPersonsByFormDraft($EvalFormDraftID),
                'request_uri' => !empty($_GET['res_per_page']) ? "./?m=colleagues-eval&o=formsDraft&FunctionID={$_GET['FunctionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=colleagues-eval",
            ));
            $center_file = 'colleagues_eval_draft_new.tpl';
        }
        break;


    ###################### FORMULARE Evaluari   ######################################################################
    ##########################################################################################################################
    case 'forms-evaluator':
        /*
            if (!($FullName = ColleaguesEvals::getPersonByID($_SESSION['PersonID']))) {
                header('Location: ./?m=colleagues-eval&o=evalPersons');
                exit;
            }
        */
        $evalForms = ColleaguesEvals::getEvalFormsEvaluator((int)$_GET['PersonID']);

        switch ($_GET['action']) {

            case 'delete';
                $EvalFormID = (int)$_GET['EvalFormID'];
                ColleaguesEvals::deleteEvalForm($EvalFormID);
                header('Location: ./?m=colleagues-eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;

            case 'set_mediation';
                $EvalFormID = (int)$_GET['EvalFormID'];
                ColleaguesEvals::setMediation($EvalFormID);
                header('Location: ./?m=colleagues-eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;
            case 'export':
                $excel = array();
                foreach ($evalForms as $k => $v) {
                    $excel[$k]['Nume formular'] = $v['FormName'];
                    $excel[$k]['Functie'] = $v['Function'];
                    $excel[$k]['Date inceput'] = $v['StartDate'];
                    $excel[$k]['Data sfarsit'] = $v['EndDate'];
                    $excel[$k]['Calificativ autoevaluare'] = $v['SelfWeighted'];
                    $excel[$k]['Calificativ evaluator'] = $v['ManagerWeighted'];
                    $excel[$k]['Calificativ mediator'] = $v['MediatorWeighted'];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'formulare_evaluari_' . str_replace(' ', '_', $FullName));
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('colleagues_eval_forms_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=formulare_evaluari_" . str_replace(' ', '_', $FullName) . ".doc");
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('colleagues_eval_forms_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array('evalForms' => $evalForms,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($evalForms[0]['pageNo'], $evalForms[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'colleagues_eval_forms.tpl';
                break;
        }

        break;

    ###################### FORMULARE Evaluari personale  ######################################################################
    ##########################################################################################################################
    case 'forms':
    default:
        /*
            if (!($FullName = ColleaguesEvals::getPersonByID($_SESSION['PersonID']))) {
                header('Location: ./?m=colleagues-eval&o=evalPersons');
                exit;
            }
        */
        $evalForms = ColleaguesEvals::getEvalFormsPersonal((int)$_GET['PersonID']);

        switch ($_GET['action']) {

            case 'delete';
                $EvalFormID = (int)$_GET['EvalFormID'];
                ColleaguesEvals::deleteEvalForm($EvalFormID);
                header('Location: ./?m=colleagues-eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;

            case 'set_mediation';
                $EvalFormID = (int)$_GET['EvalFormID'];
                ColleaguesEvals::setMediation($EvalFormID);
                header('Location: ./?m=colleagues-eval&o=forms&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;
            case 'export':
                $excel = array();
                unset($evalForms[0]);
                foreach ($evalForms as $k => $v) {
                    $excel[$k]['Nume formular'] = $v['FormName'];
                    $excel[$k]['Evaluator'] = $v['FullName'];
                    $excel[$k]['Functie'] = $v['Function'];
                    $excel[$k]['Relatie'] = ColleaguesEvals::$msFeedbackRelation[$v['RelationID']];
                    $excel[$k]['Date inceput'] = $v['StartDate'];
                    $excel[$k]['Data sfarsit'] = $v['EndDate'];
                    $excel[$k]['Status'] = $v['Completed'] == 1 ? 'Incheiata' : 'Neincheiata';
                    $excel[$k]['Calificativ'] = $v['Completed'] == 1 ? $v['SelfWeighted'] : '-';
                }
                include("libs/xlsStream.php");
                export_file($excel, 'formulare_evaluari_colegi');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'evalForms' => $evalForms,
                    'relations' => ColleaguesEvals::$msFeedbackRelation,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('colleagues_eval_forms_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=formulare_evaluari_colegi.doc");
                $smarty->assign(array(
                    'evalForms' => $evalForms,
                    'relations' => ColleaguesEvals::$msFeedbackRelation,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('colleagues_eval_forms_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array('evalForms' => $evalForms,
                    'persons' => ColleaguesEvals::getAllPersons(),
                    'relations' => ColleaguesEvals::$msFeedbackRelation,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($evalForms[0]['pageNo'], $evalForms[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'colleagues_eval_forms.tpl';
                break;
        }

        break;

    ############################### Evaluare ################################################################
    #########################################################################################################

    case 'eval':

        $evalPersonID = ColleaguesEvals::getPersonByForm($_GET['EvalFormID']);
        $evalEvaluatorID = ColleaguesEvals::getEvaluatorByForm($_GET['EvalFormID']);
        /*
            if (!($FullName = ColleaguesEvals::getPersonByID($evalPersonID))) {
                header('Location: ./?m=colleagues-eval&o=eval');
                exit;
            }
        */
        //Utils::pa($_POST);
        if (!empty($_POST)) {
            ColleaguesEvals::editEval($_POST);

            if (!empty($_POST['Completed']))
                ColleaguesEvals::completeEvalForm((int)$_POST['Completed'], (int)$_GET['EvalFormID']);

            header('Location: ./?m=colleagues-eval&o=eval&EvalFormID=' . (int)$_GET['EvalFormID']);
        }

        if ($_GET['action'] == 'export_doc') {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=evaluare_" . $FullName . ".doc");
            $smarty->display('colleagues_eval_print.tpl');
            exit;
        }
        $eval = ColleaguesEvals::getEval($_GET['EvalFormID']);

        $StartDate = $eval['StartDate'];
        $EndDate = $eval['EndDate'];
        unset($eval['StartDate']);
        unset($eval['EndDate']);

        $Person = new Person($evalPersonID);
        $PersonInfo = $Person->getPerson();
        $Completed = ColleaguesEvals::getCompletedStatus($_GET['EvalFormID']);

        if ($_SESSION['PersonID'] == $evalPersonID) {
            $isPerson = true;
        }
        if ($_SESSION['PersonID'] == $evalEvaluatorID) {
            $isEvaluator = true;
        }

        $smarty->assign(array(
            'eval' => $eval,
            'StartDate' => $StartDate,
            'EndDate' => $EndDate,
            'evalPersonID' => $evalPersonID,
            'evalEvaluatorID' => $evalEvaluatorID,
            'person' => $PersonInfo,
            'Completed' => $Completed,
            'isPerson' => $isPerson,
            'isEvaluator' => $isEvaluator,

        ));
        if (!empty($_GET['print'])) {

            $smarty->display('colleagues_eval_print.tpl');
            exit;

        } else {

            $center_file = 'colleagues_eval.tpl';
        }

        break;

    // evaluari personale
    case 'evalPersons':
    case 'evalPersonsEvaluator':

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        if ($_SESSION['USER_ID'] != 1) {
            if ($o == 'evalPersons' || $o == 'default')
                $persons = ColleaguesEvals::getAllPersons($action);

            elseif ($o == 'evalPersonsEvaluator')
                $persons = ColleaguesEvals::getAllPersonsEvaluator($action);

        } elseif ($_SESSION['USER_ID'] == 1) {
            $persons = ColleaguesEvals::getAllPersonsEvaluator($action);
        }

        switch ($action) {
            case 'export':
                unset($persons[0]);
                $excel = array();
                foreach ($persons as $k => $person) {
                    $excel[$k]['Name'] = $person['FullName'];
                    $excel[$k]['District'] = $person['DistrictName'];
                    $excel[$k]['City'] = $person['CityName'];
                    $excel[$k]['CNP'] = $person['CNP'];
                    $excel[$k]['BISerie'] = $person['BISerie'];
                    $excel[$k]['BINumber'] = $person['BINumber'];
                    $excel[$k]['BI Data eliberarii'] = $person['BIStartDate'];
                    $excel[$k]['BI Data expirarii'] = $person['BIStopDate'];
                    $excel[$k]['BI eliberat de'] = $person['BIEmitent'];
                    $excel[$k]['Phone'] = $person['Phone'];
                    $excel[$k]['Mobile'] = $person['Mobile'];
                    $excel[$k]['Email'] = $person['Email'];
                    $excel[$k]['Varsta'] = $person['varsta'];
                    $excel[$k]['Status'] = Person::$msStatus[$person['Status']];
                    $excel[$k]['Stare civila'] = Person::$msMaritalStatus[$person['MaritalStatus']];
                    $excel[$k]['Numar copii'] = $person['NumberOfChildren'];
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
                    'personalisedlist' => Utils::getPersonalisedList('Eval'),
                    'maritalstatus' => Person::$msMaritalStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => Utils::getCostCenter(),
                    'departments' => Utils::getDepartments(),
                    'jobtitles' => Job::getJobsTitle(),
                    'functions' => Utils::getFunctions(),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('colleagues_eval_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'personalisedlist' => Utils::getPersonalisedList('Eval'),
                    'maritalstatus' => Person::$msMaritalStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => Utils::getCostCenter(),
                    'departments' => Utils::getDepartments(),
                    'jobtitles' => Job::getJobsTitle(),
                    'functions' => Utils::getFunctions(),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('colleagues_eval_print.tpl');
                exit;
                break;

            default:
                $status = Person::$msStatus;
                unset($status[1], $status[3], $status[4]);
                $request_uri = "./?m=colleagues-eval&o=evalPersons&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&CostCenterID={$_GET['CostCenterID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}";
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => $status,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => Utils::getCostCenter(),
                    'departments' => Utils::getDepartments(),
                    'self' => Company::getSelfCompanies(),
                    'divisions' => Utils::getDivisions(),
                    'jobtitles' => Job::getJobsTitle(),
                    'functions' => Utils::getFunctions(),
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'personalisedlist' => Utils::getPersonalisedList('Eval'),
                    'maritalstatus' => Person::$msMaritalStatus,
                    'request_uri' => $request_uri,
                ));

                # Pagination
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                if ($_SESSION['USER_ID'] != 1) {
                    if ($o == 'evalPersons' || $o == 'default')
                        $center_file = 'colleagues_eval_persons.tpl';

                    elseif ($o == 'evalPersonsEvaluator')
                        $center_file = 'colleagues_eval_persons_evaluator.tpl';

                } elseif ($_SESSION['USER_ID'] == 1) {
                    $center_file = 'colleagues_eval_persons_evaluator.tpl';
                }


                break;
        }

        break;
}

?>