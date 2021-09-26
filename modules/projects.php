<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new_project':
        if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS']['11_1'] != 1) {
            header('Location: ./?m=projects');
            exit;
        }
        if (!empty($_POST)) {
            try {
                $ProjectID = Project::addProject();
                header('Location: ./?m=projects&o=edit_project&ProjectID=' . $ProjectID);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }
        $smarty->assign(array(
            'types' => Project::$msProjectTypes,
            'phases' => Project::getPhases(),
            'financial_sources' => Project::$msFinancialSources,
            'companies' => Job::getCompanies(),
        ));
        $center_file = 'projects_new.tpl';
        break;

    case 'edit_project':
        if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS']['11_1'] != 1) {
            header('Location: ./?m=projects');
            exit;
        }
        $ProjectID = (int)$_GET['ProjectID'];
        if (!empty($_POST) || !empty($_GET['action'])) {
            if (!empty($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'new_activity':
                        Pontaj::addActivity($ProjectID);
                        break;
                    case 'edit_activity':
                        Pontaj::editActivity($ProjectID, (int)$_GET['ActivityID']);
                        break;
                    case 'delete_activity':
                        Pontaj::deleteActivity($ProjectID, (int)$_GET['ActivityID']);
                        break;
                }
            } else {
                try {
                    Project::editProject($ProjectID);
                    header('Location: ./?m=projects&o=edit_project&ProjectID=' . $ProjectID);
                    exit;
                } catch (Exception $exp) {
                    $err->setError($exp->getMessage());
                }
            }
        }
        $smarty->assign(array(
            'types' => Project::$msProjectTypes,
            'phases' => Project::getPhases(),
            'financial_sources' => Project::$msFinancialSources,
            'info' => Project::getProject($ProjectID),
            'roles' => Pontaj::getPontajRoles(),
            'activities' => Pontaj::getProjectActivities($ProjectID),
            'companies' => Job::getCompanies(),
        ));
        $center_file = 'projects_new.tpl';
        break;

    case 'duplicate_project':
        if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS']['11_1'] != 1) {
            header('Location: ./?m=projects');
            exit;
        }
        $ProjectID = (int)$_GET['ProjectID'];
        $newProjectID = Project::duplicateProject($ProjectID);
        header('Location: ./?m=projects&o=edit_project&ProjectID=' . $newProjectID);
        exit;
        break;

    case 'delete_project':
        if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_SETTINGS']['11_1'] != 1) {
            header('Location: ./?m=projects');
            exit;
        }
        $ProjectID = (int)$_GET['ProjectID'];
        Project::deleteProject($ProjectID);
        header('Location: ./?m=projects&o=projects');
        exit;
        break;

    case 'projects':
    default:

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $projects = Project::getAllProjects($action);

        switch ($action) {
            case 'export':
                unset($projects[0]);
                $phases = Project::getPhases();
                $excel = array();
                foreach ($projects as $k => $v) {
                    $excel[$k]['Denumire Proiect'] = $v['Name'];
                    $excel[$k]['Partener'] = $v['CompanyName'];
                    $excel[$k]['Cod Proiect'] = $v['Code'];
                    $excel[$k]['Data de inceput'] = $v['start_date'];
                    $excel[$k]['Data de incheiere'] = $v['end_date'];
                    $excel[$k]['Statut'] = Project::$msProjectTypes[$v['Type']];
                    $excel[$k]['Faza'] = $phases[$v['Phase']];
                }
                include("libs/xlsStream.php");
                export_file($excel, 'Lista_proiecte');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=Lista_proiecte.doc");
                $smarty->assign(array(
                    'types' => Project::$msProjectTypes,
                    'phases' => Project::getPhases(),
                    'request_uri' => !empty($_GET['res_per_page']) ? "./?m=projects&o=projects&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=projects&o=projects",
                    'projects' => $projects,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('projects_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'types' => Project::$msProjectTypes,
                    'phases' => Project::getPhases(),
                    'request_uri' => !empty($_GET['res_per_page']) ? "./?m=projects&o=projects&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=projects&o=projects",
                    'projects' => $projects,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('projects_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=projects&o=projects&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=projects&o=projects";
                $smarty->assign(array(
                    'projects' => $projects,
                    'types' => Project::$msProjectTypes,
                    'phases' => Project::getPhases(),
                    'request_uri' => $request_uri,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;

                $pagination = Utils::paginate($projects[0]['pageNo'], $projects[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'projects.tpl';
                break;
        }
        break;

        /*
        default:
            $center_file = 'projects_summary.tpl';
            echo "Sumar proiecte";
        */

        break;
}

?>