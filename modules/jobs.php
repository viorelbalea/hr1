<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $job = new Job();
                $JobID = $job->addJob($_POST);

                echo "<body onload=\"window.location.href = './?m=jobs&o=edit&JobID={$JobID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'autocomplete' => true,
            'jobdomains' => Job::getJobDomains(),
            'internal_functions' => Utils::getGroupFunctions(),
            'functions_recr' => Utils::getFunctionsRecr(),
            'companies' => Job::getCompanies(),
            'experiences' => Job::$msExperience,
            'jobtypes' => Job::$msJobType,
            'customfields' => Utils::getCustomFields(),
            'functions' => Utils::getFunctions(),
            'costcenter' => Utils::getCostCenter(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'studies' => Person::$msStudies,
            'educational_levels' => Person::$msEducationalLevel,
            'languages' => Utils::getLanguages(),
            'lang_level' => Person::$msLangLevel,
            'jobs' => Job::getJobsTitle(),
        ));

        $center_file = 'job_new.tpl';

        break;

    case 'edit':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $job->editJob($_POST);

                echo "<body onload=\"window.location.href = './?m=jobs&o=edit&JobID={$JobID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'autocomplete' => true,
            'jobdomains' => Job::getJobDomains(),
            'internal_functions' => Utils::getGroupFunctions(),
            'functions_recr' => Utils::getFunctionsRecr(),
            'companies' => Job::getCompanies(),
            'experiences' => Job::$msExperience,
            'jobtypes' => Job::$msJobType,
            'functions' => Utils::getFunctions(),
            'costcenter' => Utils::getCostCenter(),
            'departments' => Utils::getDepartments(),
            'customfields' => Utils::getCustomFields(),
            'studies' => Person::$msStudies,
            'educational_levels' => Person::$msEducationalLevel,
            'jobs' => Job::getJobsTitle(),
            'languages' => Utils::getLanguages(),
            'lang_level' => Person::$msLangLevel,
            'lang' => $job->getLang(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $job->getJob(),
        ));

        $center_file = 'job_new.tpl';

        break;

    case 'strategy':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        if (!empty($_POST)) {

            try {
                $job->setStrategy($_POST);

                echo "<body onload=\"window.location.href = './?m=jobs&o=strategy&JobID={$JobID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }
        $smarty->assign(array(
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $job->getStrategy(),
        ));
        $center_file = 'job_strategy.tpl';

        break;

    case 'alloc':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        if (!empty($_GET['action'])) {

            $job->allocJob();
        }

        $smarty->assign(array(
            'persons' => Job::getSimplePersons(),
            'job_persons' => $job->getJobPersons(),
            'info' => $job->getJobAlloc(),
        ));

        $center_file = 'job_alloc.tpl';

        break;

    case 'alloc-candidates':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        if (!empty($_GET['action'])) {

            $job->allocJobCandidates();
        }

        $smarty->assign(array(
            'persons' => Job::getSimpleCandidates(),
            'job_candidates' => $job->getJobCandidates(),
            'info' => $job->getJobAllocCandidates(),
        ));

        $center_file = 'job_alloc_candidates.tpl';

        break;

    case 'del':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        $job->delJob();

        header('Location: ./?m=jobs');
        exit;

        break;

    case 'save_as_new':

        $JobID = (int)$_GET['JobID'];
        $job = new Job($JobID);

        $newJobID = $job->saveAsNew();

        header('Location: ./?m=jobs&o=edit&JobID=' . $newJobID);
        exit;

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][3][1] > 0)) {
            $center_file = 'job_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';

        $personalisedlist = Utils::getPersonalisedList('Job');
        $jobs = Job::getAllJobs($action);
        $departments = Utils::getDepartments();
        $jobtitles = Job::getJobsTitle();
        $functions_recr = Utils::getFunctionsRecr();
        $functions = Utils::getFunctions();
        $jobdomains = Job::getJobDomains();
        $experiences = Job::$msExperience;
        $jobtypes = Job::$msJobType;


        switch ($action) {
            case 'export':
                unset($jobs[0]);
                $excel = array();
                foreach ($jobs as $k => $job) {
                    $excel[$k]['JobTitle'] = $job['JobTitle'];
                    $excel[$k]['Company'] = $job['CompanyName'];
                    if (empty($personalisedlist['Job'])) {
                        $excel[$k]['Judet'] = $job['DistrictName'];
                        $excel[$k]['Localitate'] = $job['CityName'];
                        $excel[$k]['Nr Persons'] = $job['no_persons'];
                        $excel[$k]['Start Date'] = $job['start_date'];
                        $excel[$k]['Stop Date'] = $job['stop_date'];
                        $excel[$k]['Status'] = $job['status'];
                    } else {
                        foreach ($personalisedlist['Job'] as $field => $name) {
                            if ($field == 'JobDomainID')
                                $excel[$k][$name] = $jobdomains[$job[$field]];
                            elseif ($field == 'RequiredExperience')
                                $excel[$k][$name] = $experiences[$job[$field]];
                            elseif ($field == 'JobType')
                                $excel[$k][$name] = $jobtypes[$job[$field]];
                            elseif ($field == 'DepartmentID')
                                $excel[$k][$name] = $departments[$job[$field]];
                            elseif ($field == 'JobDictionaryID')
                                $excel[$k][$name] = $jobtitles[$job[$field]];
                            elseif ($field == 'FunctionIDRecr')
                                $excel[$k][$name] = $functions_recr[$job[$field]];
                            elseif ($field == 'FunctionID')
                                $excel[$k][$name] = $functions[$job[$field]]['Function'] . ' - ' . $functions[$job[$field]]['COR'];
                            else
                                $excel[$k][$name] = $job[$field];
                        }
                    }

                }
                include("libs/xlsStream.php");
                export_file($excel, 'joburi');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=joburi.doc");
                $smarty->assign(array(
                    'jobs' => $jobs,
                    'departments' => $departments,
                    'jobtitles' => $jobtitles,
                    'functions_recr' => $functions_recr,
                    'functions' => $functions,
                    'jobdomains' => $jobdomains,
                    'experiences' => Job::$msExperience,
                    'jobtypes' => Job::$msJobType,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('jobs_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'jobs' => $jobs,
                    'departments' => $departments,
                    'jobtitles' => $jobtitles,
                    'functions_recr' => $functions_recr,
                    'functions' => $functions,
                    'jobdomains' => $jobdomains,
                    'experiences' => Job::$msExperience,
                    'jobtypes' => Job::$msJobType,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('jobs_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=jobs&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=jobs";
                $smarty->assign(array(
                    'jobs' => $jobs,
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'departments' => $departments,
                    'jobtitles' => $jobtitles,
                    'functions_recr' => $functions_recr,
                    'functions' => $functions,
                    'jobdomains' => $jobdomains,
                    'experiences' => Job::$msExperience,
                    'jobtypes' => Job::$msJobType,
                    'personalisedlist' => $personalisedlist,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;

                $pagination = Utils::paginate($jobs[0]['pageNo'], $jobs[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);


                $center_file = 'jobs.tpl';
                break;
        }

        break;
}

?>