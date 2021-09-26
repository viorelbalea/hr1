<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $training = new Training();
                $TrainingID = $training->addTraining($_POST);

                header("Location: ./?m=training&o=edit&TrainingID={$TrainingID}&msg=1");

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'companies' => Job::getTrainingCompaniesWithSelfNotion(),
            // 'trainers'       => Person::getTrainers(),
            'districts' => Address::getDistricts(),
            'status' => Training::$msTrainingStatus,
            'currencies' => Currency::$msCurrencies,
            'customfields' => Utils::getCustomFields(),
        ));

        $center_file = 'training_new.tpl';

        break;

    case 'edit':

        $TrainingID = (int)$_GET['TrainingID'];
        $training = new Training($TrainingID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $training->editTraining($_POST);
                header("Location: ./?m=training&o=edit&TrainingID={$TrainingID}&msg=1");

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $info = !empty($_POST) ? Utils::displayInfo($_POST) : $training->getTraining();
        $smarty->assign(array(
            'companies' => Job::getTrainingCompaniesWithSelfNotion(),
            // 'trainers'         => Person::getTrainers(),
            'districts' => Address::getDistricts(),
            'cities' => Address::getCities($info['DistrictID']),
            'status' => Training::$msTrainingStatus,
            'currencies' => Currency::$msCurrencies,
            'persons' => Person::getEmployees(),
            'training_persons' => $training->getTrainingPersons(),
            'customfields' => Utils::getCustomFields(),
            'info' => $info,
        ));

        $center_file = 'training_new.tpl';

        break;

    case 'formsDraft':
        $evalFormsDraft = Training::getEvalFormsDraft();
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {

                case 'print_page':
                case 'print_all':
                    //unset($evalFormsDraft[0]);
                    $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('training_eval_forms_draft_print.tpl');
                    exit;
                    break;
                case 'export_doc':
                    header("Content-Type: application/vnd.ms-word");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("content-disposition: attachment;filename=formulare_feedback_training.doc");
                    $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('training_eval_forms_draft_print.tpl');
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
                    export_file($excel, 'formulare_feedback_training');
                    break;
            }
        } else {
            $request_uri = !empty($_GET['res_per_page']) ? "./?m=training&o=formsDraft&FunctionID={$_GET['FunctionID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=training&o=formsDraft";
            $smarty->assign(array('evalFormsDraft' => $evalFormsDraft,
                'evalPersonsFormsDraft' => Training::getAllPersonsByFormsDraft(),
                'types' => Training::$msTrainingFormType,
                'request_uri' => $request_uri,
            ));
            # Pagination
            $pagination = Utils::paginate($evalFormsDraft[0]['pageNo'], $evalFormsDraft[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
            $smarty->assign('pagination', $pagination);

            $center_file = 'training_eval_forms_draft.tpl';
        }
        break;

    case 'evalDraft':

        $EvalFormDraftID = !empty($_GET['EvalFormDraftID']) ? (int)$_GET['EvalFormDraftID'] : 0;

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {

                case 'new':
                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            $EvalFormDraftID = Training::addEvalFormDraft();
                            header('Location: ./?m=training&o=evalDraft&EvalFormDraftID=' . $EvalFormDraftID . '&action=edit');
                            exit;
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $smarty->assign(array(
                        'types' => Training::$msTrainingFormType,
                    ));
                    $center_file = 'training_eval_draft_new.tpl';

                    break;
                case 'edit':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];

                    if (!empty($_POST) && $_GET['EvalQuestionID'] == '') {
                        try {
                            Training::editEvalFormDraft($EvalFormDraftID, $_POST);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }

                    $smarty->assign(array(
                        'form' => Training::getEvalFormDraft($EvalFormDraftID),
                        'sections' => Training::getFormDraftSections($EvalFormDraftID),
                        'types' => Training::$msTrainingFormType,
                    ));
                    $center_file = 'training_eval_draft_new.tpl';
                    break;
                case 'new_section':
                case 'edit_section':
                case 'del_section':
                    Training::setSection();
                    header('Location: ./?m=training&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
                    exit;
                    break;


                case 'edit_question':
                case 'del_question':
                    if ($_GET['EvalQuestionID'] != '') {
                        try {
                            Training::addEvalQuestion($_GET['EvalQuestionID']);
                            header('Location: ./?m=training&o=evalDraft&EvalFormDraftID=' . $_GET['EvalFormDraftID'] . '&action=edit');
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
                        $newEvalFormDraftID = Training::cloneEvalFormDraft($EvalFormDraftID);
                    }
                    header('Location: ./?m=training&o=evalDraft&EvalFormDraftID=' . $newEvalFormDraftID . '&action=edit');
                    exit;
                    break;

                case 'delete':
                    $EvalFormDraftID = (int)$_GET['EvalFormDraftID'];
                    try {
                        Training::deleteEvalFormDraft($EvalFormDraftID);
                    } catch (Exception $exp) {
                        $err->setError($exp->getMessage());
                    }
                    header('Location: ./?m=training&o=formsDraft');
                    exit;
                    break;
            }
        } else
            header('Location: ./?m=training&o=formsDraft');
        break;

    case 'evalAssign':
        $Type = !empty($_GET['Type']) ? (int)$_GET['Type'] : 1;
        if (!empty($_POST)) {
            $TrainingID = !empty($_GET['TrainingID']) ? (int)$_GET['TrainingID'] : 0;
            try {
                if ($Type == 1) {
                    $PersonID = Training::setEvalToTrainee($_POST);
                    header('Location: ./?m=training&o=formsTrainee&PersonID=' . $PersonID);
                } elseif ($Type == 2) {
                    $PersonID = Training::setEvalToTrainer($_POST);
                    header('Location: ./?m=training&o=formsTrainer&PersonID=' . $PersonID);
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'forms' => Training::getAllEvalFormsDraft((int)$_GET['Type']),
            'trainings' => Training::getTrainings(),
        ));
        if ($Type == 1)
            $center_file = 'training_eval_assign_trainee.tpl';
        elseif ($Type == 2)
            $center_file = 'training_eval_assign_trainer.tpl';

        break;

    case 'formsTrainee':

        $evalForms = Training::getEvalFormsTrainee((int)$_GET['PersonID']);

        switch ($_GET['action']) {

            case 'delete';
                $EvalFormID = (int)$_GET['EvalFormID'];
                Training::deleteEvalForm($EvalFormID);
                header('Location: ./?m=training&o=formsTrainee&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;

            case 'export':
                $excel = array();
                unset($evalForms[0]);
                foreach ($evalForms as $k => $v) {
                    $excel[$k]['Nume formular'] = $v['FormName'];
                    $excel[$k]['Persoana evaluata'] = $v['PersonName'];
                    $excel[$k]['Evaluator'] = $v['EvaluatorName'];
                    $excel[$k]['Date inceput'] = $v['StartDate'];
                    $excel[$k]['Data sfarsit'] = $v['EndDate'];
                    $excel[$k]['Status'] = $v['Completed'] == 1 ? 'Incheiata' : 'Neincheiata';
                    $excel[$k]['Calificativ'] = $v['Completed'] == 1 ? $v['Weighted'] : '-';
                }
                include("libs/xlsStream.php");
                export_file($excel, 'formulare_evaluari_cursanti');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('training_eval_forms_trainee_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=formulare_evaluari_cursanti.doc");
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('training_eval_forms_trainee_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array('evalForms' => $evalForms,
                    'persons' => Training::getPersonsEvaluateFromEvalFormsTrainee(),
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($evalForms[0]['pageNo'], $evalForms[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'training_eval_forms_trainee.tpl';
                break;
        }

        break;

    case 'formsTrainer':

        $evalForms = Training::getEvalFormsTrainer();

        switch ($_GET['action']) {

            case 'delete';
                $EvalFormID = (int)$_GET['EvalFormID'];
                Training::deleteEvalForm($EvalFormID);
                header('Location: ./?m=training&o=formsTrainer&PersonID=' . (int)$_GET['PersonID']);
                exit;
                break;

            case 'export':
                $excel = array();
                unset($evalForms[0]);
                foreach ($evalForms as $k => $v) {
                    $excel[$k]['Nume formular'] = $v['FormName'];
                    $excel[$k]['Persoana evaluata'] = $v['FullName'];
                    $excel[$k]['Date inceput'] = $v['StartDate'];
                    $excel[$k]['Data sfarsit'] = $v['EndDate'];
                    $excel[$k]['Status'] = $v['Completed'] == 1 ? 'Incheiata' : 'Neincheiata';
                    $excel[$k]['Calificativ'] = $v['Completed'] == 1 ? $v['Weighted'] : '-';
                }
                include("libs/xlsStream.php");
                export_file($excel, 'formulare_evaluari_traineri');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('training_eval_forms_trainer_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=formulare_evaluari_traineri.doc");
                $smarty->assign(array('evalForms' => $evalForms,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                ));
                $smarty->display('training_eval_forms_trainer_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']);
                $smarty->assign(array('evalForms' => $evalForms,
                    'persons' => Training::getPersonsEvaluateFromEvalFormsTrainer(),
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($evalForms[0]['pageNo'], $evalForms[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'training_eval_forms_trainer.tpl';
                break;
        }

        break;

    case 'eval':

        $evalPersonID = Training::getPersonByForm($_GET['EvalFormID']);
        $evalEvaluatorID = Training::getEvaluatorByForm($_GET['EvalFormID']);
        /*
            if (!($FullName = ColleaguesEvals::getPersonByID($evalPersonID))) {
                header('Location: ./?m=colleagues-eval&o=eval');
                exit;
            }
        */
        //Utils::pa($_POST);
        if (!empty($_POST)) {
            Training::editEval($_POST);

            if (!empty($_POST['Completed']))
                Training::completeEvalForm((int)$_POST['Completed'], (int)$_GET['EvalFormID']);

            header('Location: ./?m=training-eval&o=eval&EvalFormID=' . (int)$_GET['EvalFormID']);
        }

        if ($_GET['action'] == 'export_doc') {
            header("Content-Type: application/vnd.ms-word");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=evaluare_" . $FullName . ".doc");
            $smarty->display('training_eval_print.tpl');
            exit;
        }
        $eval = Training::getEval($_GET['EvalFormID']);

        $StartDate = $eval['StartDate'];
        $EndDate = $eval['EndDate'];
        unset($eval['StartDate']);
        unset($eval['EndDate']);

        $Person = new Person($evalPersonID);
        $PersonInfo = $Person->getPerson();
        $Completed = Training::getCompletedStatus($_GET['EvalFormID']);

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

            $smarty->display('training_eval_print.tpl');
            exit;

        } else {

            $center_file = 'training_eval.tpl';
        }

        break;


    case 'del':

        $TrainingID = (int)$_GET['TrainingID'];
        $training = new Training($TrainingID);

        try {

            $training->delTraining();

            header('Location: ./?m=training');
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'companies':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][5][2] > 0)) {
            $center_file = 'training_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $companies = Training::getAllCompanies($action);
        $personalisedlist = Utils::getPersonalisedList('Company');

        switch ($action) {
            case 'export':
                unset($companies[0]);
                $excel = array();
                foreach ($companies as $k => $companie) {
                    if (empty($personalisedlist['Company'])) {
                        $excel[$k]['Nume companie'] = $companie['CompanyName'];
                        $excel[$k]['Domeniu de activitate'] = $companie['Domain'];
                        $excel[$k]['Judet'] = $companie['DistrictName'];
                        $excel[$k]['Localitate'] = $companie['CityName'];
                        $excel[$k]['CIF'] = $companie['CIF'];
                    } else {
                        $excel[$k]['Nume companie'] = $companie['CompanyName'];
                        foreach ($personalisedlist['Company'] as $field => $name) {
                            $excel[$k][$name] = $companie[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'companii_training');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=companii_training.doc");
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('training_companies_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('training_companies_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=training&o=companies&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&CompanyDomainID={$_GET['CompanyDomainID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=training&o=companies";
                $smarty->assign(array(
                    'companydomains' => Job::getJobDomains(),
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                # Pagination
                $pagination = Utils::paginate($companies[0]['pageNo'], $companies[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'training_companies.tpl';
                break;
        }

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][5][1] > 0)) {
            $center_file = 'training_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $trainings = Training::getAllTrainings();
        $status = Training::$msTrainingStatus;
        $personalisedlist = Utils::getPersonalisedList('Training');

        switch ($action) {
            case 'export':
                unset($trainings[0]);
                $excel = array();
                foreach ($trainings as $k => $training) {
                    $excel[$k]['Denumire training'] = $training['TrainingName'];
                    if (empty($personalisedlist['Training'])) {
                        $excel[$k]['Companie'] = $training['CompanyName'];
                        $excel[$k]['Trainer'] = $training['FullName'];
                        $excel[$k]['Judet'] = $training['DistrictName'];
                        $excel[$k]['Oras'] = $training['CityName'];
                        $excel[$k]['Domeniu'] = $training['Domain'];
                        $excel[$k]['Data de inceput'] = $training['StartDate'];
                        $excel[$k]['Data finala'] = $training['StopDate'];
                        $excel[$k]['Status'] = $status[$training['Status']];
                    } else {
                        foreach ($personalisedlist['Training'] AS $field => $name) {
                            if ($field == 'Status')
                                $excel[$k][$name] = $status[$training[$field]];
                            else
                                $excel[$k][$name] = $training[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'traininguri');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=training.doc");
                $smarty->assign(array(
                    'trainings' => $trainings,
                    'status' => $status,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('training_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'trainings' => $trainings,
                    'status' => $status,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('training_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=training&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&CompanyDomainID={$_GET['CompanyDomainID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=training";
                $smarty->assign(array(
                    'trainings' => $trainings,
                    'status' => $status,
                    'companydomains' => Job::getJobDomains(),
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'personalisedlist' => $personalisedlist,
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                # Pagination
                $pagination = Utils::paginate($trainings[0]['pageNo'], $trainings[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'training.tpl';
                break;
        }

        break;
}

?>