<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'pontaj':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][1] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];

        if (!empty($_POST['hours'])) {
            Pontaj::setPontajByPerson($PersonID);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $pontaj = Pontaj::getPontajByPerson($PersonID);

        $permissions = array();
        $permissions_full = array();
        if ($_SESSION['USER_ID'] == 1) {
            foreach ($days as $day) {
                if ($day <= date('Y-m-d')) {
                    $permissions_full[$day] = 1;
                }
            }
        } elseif ($_SESSION['USER_RIGHTS3'][11][1][1] == 2) {
            $permissions[date('Y-m-d')] = 1;
            $daysbefore = ($settings = Utils::getCompanySettings($CompanyID)) ? (int)$settings['pontaj_days'] : 0;
            $datebefore = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - $daysbefore, (int)date('Y')));
            for ($i = $daysbefore; $i > 0; $i--) {
                $datebefore = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - $i, (int)date('Y')));
                if (in_array($datebefore, $days)) {
                    $permissions[$datebefore] = 1;
                }
            }
            /*
            if (date('w') == 1) {
            $permissions[date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - 3, (int)date('Y')))] = 1;
            $permissions[date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - 2, (int)date('Y')))] = 1;
            }
            if (date('w') == 0) {
            $permissions[date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - 2, (int)date('Y')))] = 1;
            }
            */
        }

        $cal = new Calendar();

        foreach ($pontaj as $k => $v) {
            $pontaj2[$k] = $v['code'];
        }
        asort($pontaj2);

        $smarty->assign(array(
            'days' => $days,
            'pontaj' => $pontaj,
            'pontaj2' => $pontaj2,
            'permissions' => $permissions,
            'permissions_full' => $permissions_full,
            'totalg' => $totalg,
            'FullName' => $FullName,
            'week_days' => Config::$msWeekDays,
            'cal' => $cal->getMonthView(!empty($_GET['month']) ? $_GET['month'] : (int)date('m'), !empty($_GET['year']) ? $_GET['year'] : (int)date('Y'), array(), "./?m=pontaj&o=pontaj&PersonID={$_GET['PersonID']}&ProjectID={$_GET['ProjectID']}&PhaseID={$_GET['PhaseID']}"),
            'selections' => $_SESSION['PONTAJ'][$PersonID],
            'ALLOW_ALL' => Pontaj::ALLOW_ALL,
            'phases' => Project::getPhases(true),
        ));
        $center_file = 'pontaj_hours.tpl';

        break;

    case 'psimple_day':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][2] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];

        if (!empty($_POST['hours'])) {
            Pontaj::setPontajByDay($PersonID);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $curr_year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');
        $curr_month = !empty($_GET['Month']) ? $_GET['Month'] : date('m');
        $curr_day = !empty($_GET['Day']) ? $_GET['Day'] : date('d');
        $curr_date = $curr_year . '-' . ($curr_month <= 9 ? '0' : '') . $curr_month . '-' . ($curr_day <= 9 ? '0' : '') . $curr_day;

        if ($curr_date > date('Y-m-d')) {
            require_once $smarty->_get_plugin_filepath('function', 'translate');
            echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Nu puteti seta pontaj in viitor'), $smarty) . "!'); window.location.href='./?m=pontaj&o=psimple_day&PersonID={$PersonID}';\"></body>";
            exit;
        }

        $hours = Pontaj::getPontajByDay($PersonID);

        $permissions = 0;
        $permissions_full = 0;
        if ($_SESSION['USER_ID'] == 1) {
            $permissions_full = 1;
        } elseif ($_SESSION['USER_RIGHTS3'][11][2][1] == 2) {
            $daysbefore = ($settings = Utils::getCompanySettings($CompanyID)) ? (int)$settings['pontaj_days'] : 0;
            $datebefore = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - $daysbefore, (int)date('Y')));
            if ($curr_date == date('Y-m-d')) {
                $permissions = 1;
            } elseif ($curr_date >= $datebefore) {
                $permissions = 2;
            }
        }

        $cal = new Calendar();

        $smarty->assign(array(
            'hourstype' => Pontaj::$msHoursType,
            'permissions' => $permissions,
            'permissions_full' => $permissions_full,
            'years' => range(2008, date('Y')),
            'curr_year' => $curr_year,
            'months' => range(1, 12),
            'curr_month' => $curr_month,
            'days' => range(1, 31),
            'curr_day' => $curr_day,
            'curr_date' => $curr_date,
            'hours' => $hours,
            'FullName' => $FullName,
            'cal' => $cal->getMonthView(!empty($_GET['month']) ? $_GET['month'] : (int)date('m'), !empty($_GET['year']) ? $_GET['year'] : (int)date('Y'), array(), "./?m=pontaj&o=psimple_cal&PersonID={$_GET['PersonID']}"),
        ));
        $center_file = 'pontaj_simplu_day.tpl';

        break;

    case 'psimple_cal':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][2] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];

        if (!empty($_POST['hours'])) {
            Pontaj::setPontajByCal($PersonID);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $pontaj = Pontaj::getPontajByCal($PersonID);

        $permissions = array();
        $permissions_full = array();
        if ($_SESSION['USER_ID'] == 1) {
            foreach ($days as $day) {
                if ($day <= date('Y-m-d')) {
                    $permissions_full[$day] = 1;
                }
            }
        } elseif ($_SESSION['USER_RIGHTS3'][11][2][2] == 2) {
            $daysbefore = ($settings = Utils::getCompanySettings($CompanyID)) ? (int)$settings['pontaj_days'] : 0;
            $permissions[date('Y-m-d')] = 1;
            for ($i = $daysbefore; $i > 0; $i--) {
                $datebefore = date('Y-m-d', mktime(0, 0, 0, (int)date('m'), (int)date('d') - $i, (int)date('Y')));
                if (in_array($datebefore, $days)) {
                    $permissions[$datebefore] = 1;
                }
            }
        }

        $cal = new Calendar();

        $smarty->assign(array(
            'hourstype' => Pontaj::$msHoursType,
            'days' => $days,
            'pontaj' => $pontaj,
            'permissions' => $permissions,
            'permissions_full' => $permissions_full,
            'totalg' => $totalg,
            'FullName' => $FullName,
            'week_days' => Config::$msWeekDays,
            'cal' => $cal->getMonthView(!empty($_GET['month']) ? $_GET['month'] : (int)date('m'), !empty($_GET['year']) ? $_GET['year'] : (int)date('Y'), array(), "./?m=pontaj&o=psimple_cal&PersonID={$_GET['PersonID']}"),
        ));
        $center_file = 'pontaj_simplu_cal.tpl';

        break;

    case 'reports':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][3] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $report_id = !empty($_GET['report_id']) ? (int)$_GET['report_id'] : 0;

        if (!empty($_GET['action'])) {

            if ($_GET['action'] == 'export') {
                $report = PontajReports::getReport($report_id);
                $excel = array();
                include("modules/pontaj_reports_excel.php");
                include("libs/xlsStream.php");
                export_file($excel, $title);
            } elseif ($_GET['action'] == 'print') {
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'report' => PontajReports::getReport($report_id),
                    'persons' => Pontaj::getPersonsByPontaj(),
                    'projects' => Pontaj::getProjectsByPontaj(),
                ));
                if (in_array($report_id, array(16, 17, 18, 19, 21))) {
                    $smarty->assign(array(
                        'cal' => $cal,
                        'status' => Person::$msStatus,
                    ));
                }
                $smarty->display('pontaj_reports_print.tpl');
                exit;
            } elseif ($_GET['action'] == 'export_doc') {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=raport_pontaj_$report_id.doc");
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'report' => PontajReports::getReport($report_id),
                    'persons' => Pontaj::getPersonsByPontaj(),
                    'projects' => Pontaj::getProjectsByPontaj(),
                ));
                if (in_array($report_id, array(16, 17, 18, 19))) {
                    $smarty->assign(array(
                        'cal' => $cal,
                    ));
                }
                $content = $smarty->fetch('pontaj_reports_print.tpl');
                $content = preg_replace("/<img[^>]+\>/i", "", $content);
                echo $content;
                exit;
            }

        } else {

            switch ($report_id) {
                case 2:
                    $smarty->assign('persons', Pontaj::getPersonsByPontaj());
                    break;
                case 3:
                case 5:
                    $smarty->assign('projects', Pontaj::getProjectsByPontaj());
                    break;
                case 4:
                case 6:
                    $smarty->assign(array(
                        'persons' => Pontaj::getPersonsByPontaj(),
                        'projects' => Pontaj::getProjectsByPontaj(),
                    ));
                    break;
                case 20:
                    $curr_year = !empty($_GET['Year']) ? $_GET['Year'] : date('Y');
                    $curr_month = !empty($_GET['Month']) ? $_GET['Month'] : date('m');
                    $smarty->assign(array(
                        'persons' => Pontaj::getPersonsByPontaj(),
                        'projects' => Pontaj::getProjectsByPontaj(),
                        'years' => range(date('Y') - 5, date('Y') + 5),
                        'curr_year' => $curr_year,
                        'months' => range(1, 12),
                        'curr_month' => $curr_month,
                    ));
                    break;
            }

            $smarty->assign(array(
                'reports' => PontajReports::getReports(),
                'report' => !empty($report_id) ? PontajReports::getReport($report_id) : '',
            ));
            if ($report_id == 16 || $report_id == 18 || $report_id == 21) {
                $smarty->assign(array(
                    'divisions' => $_SESSION['USER_ID'] == 1 ? Utils::getDivisions() : array(),
                    'self' => $_SESSION['USER_ID'] == 1 ? Company::getSelfCompanies() : array(),
                    'cal' => $cal,
                    'legal' => ConfigData::$msLegal,
                    'status' => Person::$msStatus,
                ));
            }
            if ($report_id == 17) {
                $smarty->assign(array(
                    'cal' => $cal,
                ));
            }
            if ($report_id == 19) {
                $smarty->assign(array(
                    'cal' => $cal,
                    'dmanagers' => $dmanagers,
                ));
            }

            $center_file = 'pontaj_reports.tpl';
        }

        break;

    case 'psimple':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][2] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Pontaj::getAllPersonsSimple($action);
        $personalisedlist = Utils::getPersonalisedList('Pontaj');
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $jobtitles = Job::getJobsTitle();
        $functions = Utils::getFunctions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $maritalstatus = Person::$msMaritalStatus;
        $status = Person::$msStatus;

        switch ($action) {
            case 'export':
                unset($persons[0]);
                $excel = array();
                foreach ($persons as $k => $person) {
                    $excel[$k]['Name'] = $person['FullName'];
                    if (empty($personalisedlist['Pontaj'])) {
                        $excel[$k]['Email'] = $person['Email'];
                        $excel[$k]['Phone'] = $person['Phone'];
                        $excel[$k]['Mobile'] = $person['Mobile'];
                    } else {
                        foreach ($personalisedlist['Pontaj'] AS $field => $name) {
                            if ($field == 'DivisionID')
                                $excel[$k][$name] = $divisions[$person[$field]];
                            elseif ($field == 'DepartmentID')
                                $excel[$k][$name] = $departments[$person[$field]];
                            elseif ($field == 'CostCenterID')
                                $excel[$k][$name] = $costcenter[$person[$field]];
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
                export_file($excel, 'pontaj_simplu');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj_simplu.doc");
                $smarty->assign(array(
                    'persons' => $persons,
                    'request_uri' => (!empty($_GET['res_per_page']) ? "./?m=pontaj&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=pontaj") . "&action=" . $_GET['action'],
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('pontaj_simplu_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'persons' => $persons,
                    'request_uri' => (!empty($_GET['res_per_page']) ? "./?m=pontaj&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=pontaj") . "&action=" . $_GET['action'],
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('pontaj_simplu_print.tpl');
                exit;
                break;
            default:
                $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'];
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'request_uri' => $request_uri,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                ));
                # Pagination
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'pontaj_simplu.tpl';
                break;
        }

        break;

    case 'pdetail':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][4] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        if (!empty($_POST)) {
            Pontaj::setAllPersonDetailActivities();
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $persons = Pontaj::getAllPersonsDetail();
        $self = Company::getSelfCompanies();
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $status = Person::$msStatus;

        if (!empty($_GET['action'])) {

            if ($_GET['action'] == 'export') {
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj_detaliat.xls");
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_detaliat_print.tpl');
                exit;
            } elseif ($_GET['action'] == 'print_page' || $_GET['action'] == 'print_all') {
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_detaliat_print.tpl');
                exit;
            } elseif ($_GET['action'] == 'export_doc') {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj_detaliat.doc");
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_detaliat_print.tpl');
                exit;
            }

        } else {

            $smarty->assign(array(
                'persons' => $persons,
                'status' => Person::$msStatus,
                'self' => $self,
                'costcenter' => $costcenter,
                'departments' => $departments,
                'divisions' => $divisions,
                'districts' => $districts,
                'cities' => $cities,
                'cal' => $cal,
                'pdisplacements' => $pdisplacements,
                'legal' => ConfigData::$msLegal,
            ));

            $center_file = 'pontaj_detaliat.tpl';
        }

        break;

    case 'pdetail_act':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][4] > 0)) {
            exit;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];

        if (!empty($_GET['action'])) {
            Pontaj::setPersonDetailActivities($PersonID);
        }

        $StartDate = !empty($_GET['StartDate']) ? $_GET['StartDate'] : date('Y-m-d');

        $smarty->assign_by_ref('err', $err);
        $smarty->assign(array(
            'activities' => Pontaj::getPersonDetailActivities($PersonID, $StartDate),
            'costcenter' => Utils::getCostCenter(),
            'pontaj_types' => ConfigData::$msPontajTypes,
        ));
        $smarty->display('pontaj_detaliat_act.tpl');
        exit;

        break;

    case 'pdetail_stat':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][4] > 0)) {
            exit;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];
        $StartDate = !empty($_GET['StartDate']) ? $_GET['StartDate'] : date('Y-m-d');
        $EndDate = !empty($_GET['EndDate']) ? $_GET['EndDate'] : date('Y-m-d');

        $stat = Pontaj::getPersonDetailStat($PersonID, $StartDate, $EndDate);
        $smarty->assign(array(
            'stat' => $stat,
            'pontaj_types' => ConfigData::$msPontajTypes,
        ));
        $smarty->display('pontaj_detaliat_stat.tpl');
        exit;

        break;
    case 'pdhours':
        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][7] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }
        $allow_act = 0;
        if (($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][11][7][1] > 1)) {
            $allow_act = 1;
        }

        Pontaj::setViewHoursLog();

        $results = Pontaj::getAllPersonsHours();
        $self = Company::getSelfCompanies();
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $status = Person::$msStatus;
        $def_start = date('d-m-Y', strtotime(date('Y') . "W" . date('W')));
        $def_end = date('d-m-Y', strtotime(date('Y') . "W" . date('W')) + 6 * 24 * 3600);
        $texts = array(
            1 => 'N',
            2 => 'Inv',
            3 => 'Nel',
            4 => 'R',
            5 => 'S',
            6 => 'L',
            7 => 'Disp',
            'CO' => 'CO',
            'CM' => 'CM',
            'CFS' => 'CFS',
            'CS' => 'CS',
            'CIC' => 'CIC',
            'CE' => 'CE',
        );
        $styles = array(
            1 => 'background-color:#99CCFF;color:#000;',
            2 => 'background-color:#C0C0C0;color:#000;',
            3 => 'background-color:#CCFFCC;color:#000;',
            4 => 'background-color:#99CCFF;color:#000;',
            5 => 'background-color:#99CCFF;color:#000;',
            6 => 'background-color:#000000; color:#e8e8e8;',
            7 => 'background-color:#FFCCFF;color:#000;',
            'CO' => 'background-color:#FFFF00;color:#000;',
            'CM' => 'background-color:#FF0000;color:#FFFFFF;',
            'CFS' => 'background-color:#CCFFCC;color:#000;',
            'CS' => 'background-color:#FFFF00;color:#000;',
            'CIC' => 'background-color:#FF0000;color:#000;',
            'CE' => 'background-color:#FFCC00;color:#000;',
        );

        $restrict = array('CO' => 1, 'CM' => 1, 'CFS' => 1, "CS" => 1, "CIC" => 1, "CE" => 1);
        $restrict_days = array();
        if (!empty($_SESSION['COMPANY_SETTINGS'][1]['date_limit']) && !empty($_GET['StartDate']) && !empty($_GET['EndDate'])) {
            $start = date('Y-m', strtotime("-" . ($_SESSION['COMPANY_SETTINGS'][1]['date_limit'] >= date('d') ? "1" : "0") . " month")) . "-01";
            $restrict_days = Utils::getDaysList($_GET['StartDate'], $_GET['EndDate'], false, false, null, array(array("Start" => $start, "Stop" => $_GET['EndDate'])));
            $restrict_days = array_fill_keys($restrict_days, "1");
        }

        $smarty->assign(array(
            'dm' => $results[0],
            'hours' => $results[1],
            'persons' => $results[2],
            'vacations' => $results[3],
            'wtrans' => $results[4],
            'status' => Person::$msStatus,
            'self' => $self,
            'costcenter' => $costcenter,
            'departments' => $departments,
            'divisions' => $divisions,
            'districts' => $districts,
            'cities' => $cities,
            'cal' => $cal,
            'styles' => $styles,
            'texts' => $texts,
            'def_start' => $def_start,
            'def_end' => $def_end,
            'restrict' => $restrict,
            'restrict_days' => $restrict_days,
            'allow_act' => $allow_act,
            'days_labels' => ConfigData::$msDaysValues,
            'legal' => ConfigData::$msLegal,
        ));


        if (!empty($_GET['action'])) {
            if ($_GET['action'] == "export") {
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=Pontaj.xls");
                $content = $smarty->fetch('pontaj_dhours_print.tpl');
                $content = preg_replace("/<img[^>]+\>/i", "", $content);
                echo $content;
                exit;
            }
            if ($_GET['action'] == "export_doc") {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=Pontaj.doc");

                $content = $smarty->fetch('pontaj_dhours_print.tpl');
                //$content=preg_replace("/<img[^>]+\>/i", "", $content);
                echo $content;
                exit;
            }
            if ($_GET['action'] == "print_page" || $_GET['action'] == "print_all") {
                $smarty->display('pontaj_dhours_print.tpl');
                exit;
            }
        }
        $center_file = 'pontaj_dhours.tpl';

        break;

    case 'pdhours_act':
        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][11][7][1] > 1)) {
            exit;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : 0;

        if (!empty($_GET['action'])) {
            Pontaj::setPersonHoursActivity($PersonID);
        }
        $start = strtotime($_GET['StartDate'] . " " . $_GET['StartHour']);
        $end = strtotime($_GET['StartDate'] . " " . $_GET['EndHour']);
        if ($end < $start) {
            $tmp = $start;
            $start = $end;
            $end = $tmp;
        }
        $interval = date('d-m-Y H:i', $start) . " - " . date('H:i', $end + 1800);
        $personcost = Person::getCostCenters($PersonID);
        $personcost = array_shift(array_keys($personcost));
        $smarty->assign_by_ref('err', $err);
        $smarty->assign(array(
            'personcost' => $personcost,
            'costcenter' => Utils::getCostCenter(),
            'pontaj_types' => ConfigData::$msPontajTypes,
            'interval' => $interval,
        ));
        $smarty->display('pontaj_dhours_act.tpl');
        exit;

        break;

    case 'pphours':
        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][8] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $results = Pontaj::getAllPersonsPlanifHours();
        $self = Company::getSelfCompanies();
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $status = Person::$msStatus;
        $def_start = date('d-m-Y', strtotime(date('Y') . "W" . date('W')));
        $def_end = date('d-m-Y', strtotime(date('Y') . "W" . date('W')) + 6 * 24 * 3600);
        $texts = array(
            0 => 'P',
            1 => 'L',
            'CO' => 'CO',
            'CM' => 'CM',
            'CFS' => 'CFS',
            'CS' => 'CS',
            'CIC' => 'CIC',
            'CE' => 'CE',
        );
        $styles = array(
            0 => 'background-color:#99CCFF;color:#000;',
            1 => 'background-color:#000000; color: #e8e8e8;',
            'CO' => 'background-color:#FFFF00;color:#000;',
            'CM' => 'background-color:#FF0000;color:#FFFFFF',
            'CFS' => 'background-color:#CCFFCC;color:#000;',
            'CS' => 'background-color:#FFFF00;color:#000;',
            'CIC' => 'background-color:#FF0000;color:#000;',
            'CE' => 'background-color:#FFCC00;color:#000;',
        );

        $restrict = array('CO' => 1, 'CM' => 1, 'CFS' => 1, "CS" => 1, "CIC" => 1, "CE" => 1);

        $smarty->assign(array(
            'dm' => $results[0],
            'hours' => $results[1],
            'persons' => $results[2],
            'vacations' => $results[3],
            'wtrans' => $results[4],
            'status' => Person::$msStatus,
            'self' => $self,
            'costcenter' => $costcenter,
            'departments' => $departments,
            'divisions' => $divisions,
            'districts' => $districts,
            'cities' => $cities,
            'cal' => $cal,
            'styles' => $styles,
            'texts' => $texts,
            'def_start' => $def_start,
            'def_end' => $def_end,
            'restrict' => $restrict,
            'days_labels' => ConfigData::$msDaysValues,
            'legal' => ConfigData::$msLegal,
        ));


        if (!empty($_GET['action'])) {
            if ($_GET['action'] == "validate") {
                if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][11][8][1] > 1)) {
                    header('Location: ' . str_replace("&action=validate", "", $_SERVER['REQUEST_URI']));
                }
                if (Pontaj::transferPlanifToDetail()) {
                    header('Location: ' . str_replace("&action=validate", "", $_SERVER['REQUEST_URI'] . "&msg=1"));
                } else {
                    header('Location: ' . str_replace("&action=validate", "", $_SERVER['REQUEST_URI'] . "&msg=2"));
                }
            }
            if ($_GET['action'] == "export") {
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=Pontaj.xls");
                $content = $smarty->fetch('pontaj_dhours_print.tpl');
                $content = preg_replace("/<img[^>]+\>/i", "", $content);
                echo $content;
                exit;
            }
            if ($_GET['action'] == "export_doc") {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=Pontaj.doc");

                $content = $smarty->fetch('pontaj_dhours_print.tpl');
                //$content=preg_replace("/<img[^>]+\>/i", "", $content);
                echo $content;
                exit;
            }
            if ($_GET['action'] == "print_page" || $_GET['action'] == "print_all") {
                $smarty->display('pontaj_dhours_print.tpl');
                exit;
            }
        }
        $center_file = 'pontaj_phours.tpl';
        break;

    case 'pphours_act':
        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][8] > 0)) {
            exit;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : 0;

        if (!empty($_GET['action'])) {
            Pontaj::setPersonPlanifHoursActivity($PersonID);
        }
        $start = strtotime($_GET['StartDate'] . " " . $_GET['StartHour']);
        $end = strtotime($_GET['StartDate'] . " " . $_GET['EndHour']);
        if ($end < $start) {
            $tmp = $start;
            $start = $end;
            $end = $tmp;
        }
        $interval = date('d-m-Y H:i', $start) . " - " . date('H:i', $end + 1800);
        $personcost = Person::getCostCenters($PersonID);
        $personcost = array_shift(array_keys($personcost));
        $smarty->assign_by_ref('err', $err);
        $smarty->assign(array(
            'personcost' => $personcost,
            'costcenter' => Utils::getCostCenter(),
            'pontaj_types' => ConfigData::$msPontajTypes,
            'interval' => $interval,
        ));
        $smarty->display('pontaj_phours_act.tpl');
        exit;
        break;

    case 'pplanif':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][5] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        if (!empty($_POST)) {
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $persons = Pontaj::getAllPersonsPlanif();
        $self = Company::getSelfCompanies();
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $status = Person::$msStatus;

        if (!empty($_GET['action'])) {

            if ($_GET['action'] == 'export') {
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj_planificat.xls");
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_planificat_print.tpl');
                exit;
            } elseif ($_GET['action'] == 'print_page' || $_GET['action'] == 'print_all') {
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_planificat_print.tpl');
                exit;
            } elseif ($_GET['action'] == 'export_doc') {
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj_planificat.doc");
                $smarty->assign(array(
                    'theme' => Config::$msAppTheme,
                    'cal' => $cal,
                    'persons' => $persons,
                ));
                $smarty->display('pontaj_planificat_print.tpl');
                exit;
            }

        } else {

            $smarty->assign(array(
                'persons' => $persons,
                'status' => Person::$msStatus,
                'self' => $self,
                'costcenter' => $costcenter,
                'departments' => $departments,
                'divisions' => $divisions,
                'districts' => $districts,
                'cities' => $cities,
                'cal' => $cal,
                'start_date' => date('01-m-Y'), //date('d-m-Y', mktime(0, 0, 0, date('m') + 1, 1, date('Y'))),
                'end_date' => date('d-m-Y', mktime(0, 0, 0, date('m') + 1, 0, date('Y'))), //!empty($_GET['EndDate']) && $_GET['EndDate'] <= date('Y-m-d', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))) ? Utils::toDBDate($_GET['EndDate']) : date('d-m-Y', mktime(0, 0, 0, date('m') + 2, 0, date('Y'))),
            ));

            $center_file = 'pontaj_planificat.tpl';
        }

        break;

    case 'pplanif_act':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][5] > 0)) {
            exit;
        }

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : $_SESSION['PERS'];

        if (!empty($_GET['action'])) {
            Pontaj::setPersonPlanifActivities($PersonID);
        }

        $StartDate = !empty($_GET['StartDate']) ? $_GET['StartDate'] : date('Y-m-d');

        $smarty->assign_by_ref('err', $err);
        $smarty->assign(array(
            'activities' => Pontaj::getPersonPlanifActivities($PersonID, $StartDate),
            'costcenter' => Utils::getCostCenter(),
            'pontaj_types' => ConfigData::$msPontajTypes,
        ));
        $smarty->display('pontaj_planificat_act.tpl');
        exit;

        break;

    case 'precalc':
        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][6] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        if (!empty($_GET['recalc'])) {
            if (!empty($_GET['confirm'])) {
                include('cron/pontaj_detaliat_history.php');
                $smarty->assign('success', 1);
            } else {
                echo "<body onload=\"if (confirm('Recalcularea pontajului va declansa rularea unui job ce poate afecta rapoartele de pontaj si de bonuri de masa existente in perioada selectata si poate genera probleme temporare de performanta a aplicatiei. Continuati?')) window.location.href = './?m=pontaj&o=precalc" . (!empty($_GET['StartDate']) ? "&StartDate=" . $_GET['StartDate'] : "") . (!empty($_GET['StopDate']) ? "&StopDate=" . $_GET['StopDate'] : "") . "&recalc=1&confirm=1'; else window.location.href = './?m=pontaj&o=precalc" . (!empty($_GET['StartDate']) ? "&StartDate=" . $_GET['StartDate'] : "") . (!empty($_GET['StopDate']) ? "&StopDate=" . $_GET['StopDate'] : "") . "';\"></body>";
            }
        }

        $center_file = 'pontaj_recalc.tpl';
        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][11][1] > 0)) {
            $center_file = 'pontaj_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $persons = Pontaj::getAllPersons($action);
        $personalisedlist = Utils::getPersonalisedList('Pontaj');
        $costcenter = Utils::getCostCenter();
        $departments = Utils::getDepartments();
        $divisions = Utils::getDivisions();
        $jobtitles = Job::getJobsTitle();
        $functions = Utils::getFunctions();
        $districts = Address::getDistricts();
        $cities = !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities();
        $maritalstatus = Person::$msMaritalStatus;
        $status = Person::$msStatus;

        switch ($action) {
            case 'export':
                unset($persons[0]);
                $excel = array();
                foreach ($persons as $k => $person) {
                    $excel[$k]['Name'] = $person['FullName'];
                    if (empty($personalisedlist['Pontaj'])) {
                        $excel[$k]['Email'] = $person['Email'];
                        $excel[$k]['Phone'] = $person['Phone'];
                        $excel[$k]['Mobile'] = $person['Mobile'];
                    } else {
                        foreach ($personalisedlist['Pontaj'] AS $field => $name) {
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
                export_file($excel, 'pontaj');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=pontaj.doc");
                $smarty->assign(array(
                    'persons' => $persons,
                    'request_uri' => (!empty($_GET['res_per_page']) ? "./?m=pontaj&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=pontaj") . "&action=" . $_GET['action'],
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('pontaj_simplu_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'persons' => $persons,
                    'request_uri' => (!empty($_GET['res_per_page']) ? "./?m=pontaj&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=pontaj") . "&action=" . $_GET['action'],
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('pontaj_simplu_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=pontaj&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&Status={$_GET['Status']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=pontaj";
                $smarty->assign(array(
                    'persons' => $persons,
                    'status' => Person::$msStatus,
                    'substatus' => Person::$msSubStatus,
                    'cvstatus' => Person::$msCVStatus,
                    'costcenter' => $costcenter,
                    'departments' => $departments,
                    'divisions' => $divisions,
                    'jobtitles' => $jobtitles,
                    'functions' => $functions,
                    'districts' => $districts,
                    'cities' => $cities,
                    'request_uri' => $request_uri,
                    'personalisedlist' => $personalisedlist,
                    'maritalstatus' => Person::$msMaritalStatus,
                ));
                # Pagination
                $pagination = Utils::paginate($persons[0]['pageNo'], $persons[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'pontaj_persons.tpl';
                break;
        }

        break;
}

?>