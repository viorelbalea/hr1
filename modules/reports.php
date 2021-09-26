<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}
if (!isset($_GET['rep']))
    $_GET['rep'] = NULL;
$reports = Reports::getReports();
$reportID = trim($_GET['rep']);

if ($reportID > 0 && (!isset($_GET['export']) || $_GET['export'] != 1)) {
    $filters_final = $settings = array();
    $settings = Utils::getReportFiltersPersonalization($reportID);
    $filters_final = Reports::setReportFiltersVisibility($reportID, Reports::getReportFilters($reportID), $settings);

    if (!empty($filters_final)) {
        $_SESSION['report_filters_names'][$reportID] = $filters_final['names'];
        if (empty($_SESSION['report_filters_visibility'][$reportID]))
            $_SESSION['report_filters_visibility'][$reportID] = $filters_final['visibility'];

        $smarty->assign(array(
            'lstVisibleFilters' => $filters_final['lstVisibleFilters'],
            'personaliseFilters' => true
        ));
    }
}

switch ($_GET['rep']) {

    case 1:
        $events = Reports::getReports_1();
        if (!empty($_GET['export'])) {
            foreach ($events as $k => $event) {
                $excel[$k]['Scop'] = $event['Scope'];
                $excel[$k]['Autor'] = $event['UserName'];
                $excel[$k]['Reprezentant companie'] = $event['FullName'];
                $excel[$k]['Detalii'] = $event['Details'];
                $excel[$k]['Status'] = Event::$msEventStatus[$event['EventStatus']];
                $excel[$k]['Intre'] = Event::$msEventRelation[$event['EventRelation']];
                $excel[$k]['Tip'] = Event::$msEventType[$event['EventType']];
                $excel[$k]['Data'] = $event['fEventData'];
            }
        } else {
            $smarty->assign(array(
                'eventType' => Event::$msEventType,
                'eventStatus' => Event::$msEventStatus,
                'eventRelation' => Event::$msEventRelation,
                'events' => $events,
            ));
            $report_file = 'report_1.tpl';
        }
        break;

    case 2:
        $persons = Reports::getReports_2();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Judet'] = $person['DistrictName'];
                $excel[$k]['Oras'] = $person['CityName'];
                $excel[$k]['Varsta'] = $person['varsta'];
                $excel[$k]['CNP'] = $person['CNP'];
            }
        } else {
            $smarty->assign('persons', $persons);
            $report_file = 'report_2.tpl';
        }
        break;

    case 3:
        $persons = Reports::getReports_3();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Judet'] = $person['DistrictName'];
                $excel[$k]['Oras'] = $person['CityName'];
                $excel[$k]['Varsta'] = $person['varsta'];
                $excel[$k]['CNP'] = $person['CNP'];
            }
        } else {
            $smarty->assign('persons', $persons);
            $report_file = 'report_3.tpl';
        }
        break;

    case 4:
        $companies = Reports::getReports_4();
        if (!empty($_GET['export'])) {
            foreach ($companies as $k => $company) {
                $excel[$k]['Nume companie'] = $company['CompanyName'];
                $excel[$k]['Judet'] = $company['DistrictName'];
                $excel[$k]['Oras'] = $company['CityName'];
                $excel[$k]['Domeniu de activitate'] = $company['Domain'];
                $excel[$k]['CIF'] = $company['CIF'];
            }
        } else {
            $smarty->assign('companies', $companies);
            $report_file = 'report_4.tpl';
        }
        break;

    case 5:
        $report_file = 'report_5.tpl';
        break;

    case 6:
        if (!@in_array(6, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $smarty->assign(array(
            'costcenters' => Utils::getCostCenter(),
            'sites' => Utils::getSites(),
            'persons' => Reports::getReports_6(),
        ));
        $report_file = 'report_6.tpl';
        break;

    case 7:
        if (!in_array(7, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_7();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Judet'] = $person['DistrictName'];
                $excel[$k]['Oras'] = $person['CityName'];
                $excel[$k]['Varsta'] = $person['varsta'];
                $excel[$k]['CNP'] = $person['CNP'];
            }
        } else {
            $smarty->assign('persons', $persons);
            $report_file = 'report_7.tpl';
        }
        break;

    case 8:
        if (!@in_array(8, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_8();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Judet'] = $person['DistrictName'];
                $excel[$k]['Oras'] = $person['CityName'];
                $excel[$k]['Varsta'] = $person['varsta'];
                $excel[$k]['CNP'] = $person['CNP'];
            }
        } else {
            $smarty->assign('persons', $persons);
            $report_file = 'report_8.tpl';
        }
        break;

    case 25:
    case 26:
    case 27:
    case 28:
    case 29:
    case 45:
    case 56:
    case 57:
    case 64:
    case 65:
    case 66:
    case 67:
    case 68:
    case 69:
    case 70:
    case 71:
    case 72:
    case 73:
    case 74:
    case 75:
    case 76:
    case 77:
    case 78:
    case 79:
    case 80:
    case 81:
    case 82:
    case 84:
    case 85:
    case 131:
    case 132:
    case 133:
    case 134:
    case 135:
    case 136:
    case 137:
    case 138:
    case 139:
    case 140:
    case 141:
    case 142:
    case 143:
    case 144:
    case 145:
    case 146:
    case 147:
    case 148:
    case 149:
    case 150:
    case 162:

        include('reports_adeverinte.php');

        break;

    case 30:

        $children = Reports::getReports_30();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Department', 'sort' => true);
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume Prenume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'ChildName', "label" => 'Nume copil', 'default' => '-', 'sort' => true);
            $fields['names'][] = array("name" => 'ChildCNP', "label" => 'CNP', 'default' => '-', 'sort' => true);
            $fields['names'][] = array("name" => 'BirthDate', "label" => 'Data nasterii', 'default' => '-', 'sort' => true);
            $fields['names'][] = array("name" => 'varsta', "label" => 'Varsta', 'default' => '-', 'sort' => true);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        $total = 0;

        if (!empty($children))
            foreach ($children as $i => $data) {
                if (!is_numeric($i)) continue;
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
                $total++;
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'years' => range(date('Y') - 6, date('Y')),
            'children' => $children,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'total' => $total,
            'status' => Person::$msStatus,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_30.tpl';

        break;

    case 31:

        $cal = array();
        $vacations = Reports::getReports_31();
        $smarty->assign(array(
            'vacations' => $vacations,
            'cal' => $cal,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
        ));
        if (!empty($_GET['export'])) {
            header("Content-Type: application/vnd.ms-excel");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=raport_" . $_GET['rep'] . "_{$_GET['StartDate']}_{$_GET['EndDate']}.xls");
            $content = $smarty->fetch('report_' . $_GET['rep'] . '.tpl');
            $content = preg_replace("/<img[^>]+\>/i", "", $content);
            echo $content;
            exit;
        } else {
            $report_file = 'report_31.tpl';
        }

        break;

    case 33:
        if (!@in_array(33, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_33();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'DataStart', "label" => 'Data angajarii', 'sort' => true);
            $fields['names'][] = array("name" => 'DataEnd', "label" => 'Data plecarii', 'sort' => true);
            $fields['names'][] = array("name" => 'Status', "label" => 'Status', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractType', "label" => 'Tip contract', 'sort' => true);
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Companie', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'Subdepartement', "label" => 'Subdepartament', 'sort' => true);
            $fields['names'][] = array("name" => 'TCM', "label" => 'Zile efectuate CM', 'sort' => true);
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    if ($col == 'ContractType') {
                        $fields['data'][$i][$k] = PayRoll::$msContractType[$data['ContractType']];
                        continue;
                    }
                    if ($col == 'Status') {
                        $fields['data'][$i][$k] = Person::$msStatus[$data['Status']];
                        continue;
                    }
                    if (in_array($col, array('DataStart', 'DataEnd'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '00.00.0000') ? $data[$col] : '-';
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'contract_type' => PayRoll::$msContractType,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'status' => Person::$msStatus,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'request_uri' => "./?m=reports&rep=33&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}&SubdepartmentID={$_GET['SubdepartmentID']}",
        ));

        $report_file = 'report_33.tpl';
        break;

    case 34:
        if (!@in_array(34, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_34();

        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Data angajarii'] = $person['DataStart'];
                $excel[$k]['Status'] = Person::$msStatus[$person['Status']];
                $excel[$k]['Tip contract'] = PayRoll::$msContractType[$person['ContractType']];
            }
        } else {
            $smarty->assign(array(
                'status' => Person::$msStatus,
                'contract_type' => PayRoll::$msContractType,
                'persons' => $persons,
                'request_uri' => "./?m=reports&rep=34&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}",
            ));
            $report_file = 'report_34.tpl';
        }

        break;

    case 35:
        if (!@in_array(35, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_35();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'DataEnd', "label" => 'Data plecarii', 'sort' => true);
            $fields['names'][] = array("name" => 'Status', "label" => 'Status', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractType', "label" => 'Tip contract', 'sort' => true);
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Companie', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'Subdepartment', "label" => 'Subdepartament', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP', 'sort' => true);
            $fields['names'][] = array("name" => 'Varsta', "label" => 'Varsta', 'sort' => true);
            $fields['names'][] = array("name" => 'Sex', "label" => 'Sex', 'sort' => true);
            $fields['names'][] = array("name" => 'Vechime', "label" => 'Vechime', 'sort' => true);
            $fields['names'][] = array("name" => 'Motiv', "label" => 'Motiv', 'sort' => true);
            $fields['names'][] = array("name" => 'Law', "label" => 'Conform Art.', 'sort' => true);
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'Status') {
                        $fields['data'][$i][$k] = Person::$msStatus[$data['Status']];
                        continue;
                    }
                    if ($col == 'ContractType') {
                        $fields['data'][$i][$k] = PayRoll::$msContractType[$data['ContractType']];
                        continue;
                    }
                    if (in_array($col, array('DataEnd'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '00.00.0000') ? $data[$col] : '-';
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'status' => Person::$msStatus,
            'contract_type' => PayRoll::$msContractType,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'persons' => $persons,
            'request_uri' => "./?m=reports&rep=35&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}&SubdepartmentID={$_GET['SubdepartmentID']}",
        ));
        $report_file = 'report_35.tpl';

        break;

    case 36:
        if (!@in_array(36, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_36();

        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Tip'] = $person['TrainingType'];
                $excel[$k]['Total ore'] = $person['TotalHours'];
            }
        } else {

            $smarty->assign(array(
                'persons' => $persons,
                'years' => range(UTILS::getMinYear(), date('Y') + 2),
                'divisions' => Utils::getDivisions(),
                'departments' => Utils::getDepartments(),
                'training_types' => Training::getTypes(),
                'request_uri' => "./?m=reports&rep=36&Year={$_GET['Year']}&TrainingTypeID={$_GET['TrainingTypeID']}&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}",
            ));
            $report_file = 'report_36.tpl';
        }

        break;

    case 37:
        if (!@in_array(37, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $actions = Reports::getReports_37();
        if (!empty($_GET['export'])) {
            foreach ($actions as $k => $action) {
                $excel[$k]['Nume'] = $action['FullName'];
                $excel[$k]['CNP'] = $action['CNP'];
                $excel[$k]['Actiune'] = $action['Comment'];
                $excel[$k]['Data'] = $action['Date'];
                $excel[$k]['Tip utilizator'] = $action['UserName'];
                $excel[$k]['Nume utilizator'] = $action['UpdateFullName'];
            }
        } else {
            $smarty->assign(array(
                'actions' => $actions,
                'logTypes' => Person::$msLogType,
                'persons' => Person::getAllPersons(),
                'request_uri' => "./?m=reports&rep=37&PersonID={$_GET['PersonID']}&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Type={$_GET['Type']}",
            ));
            $report_file = 'report_37.tpl';
        }

        break;

    case 38:
        if (!@in_array(38, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_38();
        //Utils::pa($persons);
        $status = Person::$msStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        // Report structure
        $fields[$reportID][0] = array(
            'name' => 'FullName',
            'label' => 'Nume',
        );
        $fields[$reportID][1] = array(
            'name' => 'CompanyName',
            'label' => 'Companie',
        );
        $fields[$reportID][2] = array(
            'name' => 'Division',
            'label' => 'Divizie',
        );
        $fields[$reportID][3] = array(
            'name' => 'Department',
            'label' => 'Departament',
        );
        $fields[$reportID][4] = array(
            'name' => 'SubDepartment',
            'label' => 'Subdepartament',
        );
        $_SESSION['report_fields_names'][$reportID] = $fields[$reportID];

        // Report data
        foreach ($persons as $person) {
            $fields[$reportID][0]['data'][] = $person['FullName'];
            $fields[$reportID][1]['data'][] = $self[$person['CompanyID']];
            $fields[$reportID][2]['data'][] = $divisions[$person['DivisionID']];
            $fields[$reportID][3]['data'][] = $person['Department'];
            $fields[$reportID][4]['data'][] = $subdepartments[$person['SubDepartmentID']];
        }

        // Report visibility&order settings
        $fields_order[$reportID] = array(
            array('field_id' => 0, 'visible' => true, 'position' => 1),
            array('field_id' => 1, 'visible' => true, 'position' => 2),
            array('field_id' => 2, 'visible' => true, 'position' => 3),
            array('field_id' => 3, 'visible' => true, 'position' => 4),
            array('field_id' => 4, 'visible' => true, 'position' => 5),
        );
        // Save order in session
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields_order[$reportID];

        // Set reorder of data
        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[$reportID][] = $fields[$reportID][$v['field_id']];
        }

        $smarty->assign(array(
            'status' => $status,
            //'substatus'        => Person::$msSubStatus,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields' => $fields_final[$reportID],
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_38.tpl';

        break;

    case 42:

        $persons = Reports::getReports_42();

        unset(Person::$msStatus[1]);
        unset(Person::$msStatus[8]);

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'LastName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'FirstName', "label" => 'Prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP');
            $fields['names'][] = array("name" => 'PersonAddress', "label" => 'Adresa');
            $fields['names'][] = array("name" => 'HealthCompanyID', "label" => 'Casa asigurari sanatate');
            $fields['names'][] = array("name" => 'Status', "label" => 'Status', 'sort' => true);
            $fields['names'][] = array("name" => 'Function', "label" => 'Functie', 'sort' => true);
            $fields['names'][] = array("name" => 'COR', "label" => 'COR');
            $fields['names'][] = array("name" => 'Salary', "label" => 'Salariu brut');
            $fields['names'][] = array("name" => 'SalaryNet', "label" => 'Salariu net');
            $fields['names'][] = array("name" => 'ContractType', "label" => 'Tip contract', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractNo', "label" => 'Numar contract');
            $fields['names'][] = array("name" => 'ContractDate', "label" => 'Data contract', 'sort' => true, 'column' => 'cdata_inch');
            $fields['names'][] = array("name" => 'ContractExpDate', "label" => 'Data expirare contract', 'sort' => true, 'column' => 'cdata_exp');
            $fields['names'][] = array("name" => 'StartDate', "label" => 'Data angajarii', 'sort' => true, 'column' => 'data_inch');
            $fields['names'][] = array("name" => 'StopDate', "label" => 'Data plecarii', 'sort' => true, 'column' => 'data_exp');
            $fields['names'][] = array("name" => 'WorkNorm', "label" => 'Norma de lucru', 'sort' => true);
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    if ($col == 'HealthCompanyID') {
                        $fields['data'][$i][$k] = ConfigData::$msHealthCompanies[$data['HealthCompanyID']];
                        continue;
                    }
                    if ($col == 'Status') {
                        $fields['data'][$i][$k] = Person::$msStatus[$data['Status']];
                        continue;
                    }
                    if ($col == 'ContractType') {
                        $fields['data'][$i][$k] = PayRoll::$msContractType[$data['ContractType']];
                        continue;
                    }
                    if (in_array($col, array('cdata_inch', 'cdata_exp', 'data_inch', 'data_exp'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '00.00.0000') ? $data[$col] : '-';
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'contract_type' => PayRoll::$msContractType,
            'fields' => $fields_final,
            'personalise' => true,
            'health_companies' => ConfigData::$msHealthCompanies,
            'status' => Person::$msStatus,
            'request_uri' => "./?m=reports&rep=42&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}",
        ));
        $report_file = 'report_42.tpl';
        //}

        break;

    case 43:

        $persons = Reports::getReports_43();
        $projects = Utils::getCostCenter();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['Status'] = Person::$msStatus[$person['Status']];
                $excel[$k]['Data contractului'] = $person['data_inch'];
                $excel[$k]['Data expirarii contractului'] = $person['data_exp'];
                $excel[$k]['Proiect 1'] = $person['CostCenterID'] > 0 ? $projects[$person['CostCenterID']] : '-';
                $excel[$k]['Proiect 2'] = $person['CostCenterID2'] > 0 ? $projects[$person['CostCenterID2']] : '-';
                $excel[$k]['Proiect 3'] = $person['CostCenterID3'] > 0 ? $projects[$person['CostCenterID3']] : '-';
                $excel[$k]['Proiect 4'] = $person['CostCenterID4'] > 0 ? $projects[$person['CostCenterID4']] : '-';
                $excel[$k]['Proiect 5'] = $person['CostCenterID5'] > 0 ? $projects[$person['CostCenterID5']] : '-';
                $excel[$k]['Functia'] = $person['Function'];
            }
        } else {
            $smarty->assign(array(
                'persons' => $persons,
                'status' => Person::$msStatus,
                'projects' => $projects,
            ));
            $report_file = 'report_43.tpl';
        }

        break;

    case 44:

        $persons = Reports::getReports_44();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['FullName'];
                $excel[$k]['data'] = $person['data'];
                $excel[$k]['Sursa CV'] = $person['CVSource'];
                $excel[$k]['Detalii'] = $person['CVSourceDetails'];
            }
        } else {
            $smarty->assign(array(
                'persons' => $persons,
            ));
            $report_file = 'report_44.tpl';
        }

        break;

    case 46:

        $persons = Reports::getReports_46();
        $departments = Utils::getDepartments();

        $fields_final = $fields = array();


        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'work_days', "label" => 'Numar zile lucratoare', 'default' => 0);
            $fields['names'][] = array("name" => 'vac_days', "label" => 'Numar zile concediu', 'default' => 0);
            $fields['names'][] = array("name" => 'abs_days', "label" => 'Numar absente', 'default' => 0);
            $fields['names'][] = array("name" => 'disp_days', "label" => 'Numar zile deplasare', 'default' => 0);
            $fields['names'][] = array("name" => 'tickets', "label" => 'Numar bonuri de masa');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'Department') {
                        $fields['data'][$i][$k] = $departments[$data['DepartmentID']];
                        continue;
                    }

                    if ($col == 'tickets') {
                        $fields['data'][$i][$k] = (int)$data['work_days'] - (int)$data['vac_days'] - (int)$data['abs_days'] - (int)$data['disp_days'];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'persons' => $persons,
            'self' => Company::getSelfCompanies(),
            'departments' => $departments,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_46.tpl';


        break;

    case 47:

        if (!empty($_GET['export'])) {
            $k = 0;
            $excel[$k]['Nr. crt.'] = 1;
            $excel[$k]['Nume si prenume'] = 2;
            $excel[$k]['Cod numeric personal'] = 3;
            $excel[$k]['Nume parinti'] = 4;
            $excel[$k]['Locul si data nasterii'] = 5;
            $excel[$k]['Tip program'] = 6;
            $excel[$k]['Denumire program'] = 7;
            $excel[$k]['Durata in ore'] = 8;
            $excel[$k]['Perioada'] = 9;
            $excel[$k]['Cod COR / Nomenclator'] = 10;
            $excel[$k]['Locatie curs'] = 11;
            $excel[$k]['Medie generala'] = 12;
            $excel[$k]['Medie examen absolvire'] = 13;
            $excel[$k]['Observatii'] = 14;
            $persons = Reports::getReports_47();
            $k++;
            foreach ($persons as $person) {
                $excel[$k]['Nr. crt.'] = $k;
                $excel[$k]['Nume si prenume'] = $person['LastName'] . ' ' . $person['FirstName'];
                $excel[$k]['Cod numeric personal'] = $person['CNP'];
                $excel[$k]['Nume parinti'] = $person['MotherFirstName'] . (!empty($person['FatherFirstName']) ? ' / ' . $person['FatherFirstName'] : '');
                $excel[$k]['Locul si data nasterii'] = $person['DateOfBirth'];
                $excel[$k]['Tip program'] = 'P';
                $excel[$k]['Denumire program'] = 'Competente antreprenoriale';
                $excel[$k]['Durata in ore'] = '';
                $excel[$k]['Perioada'] = $person['StartDate'];
                $excel[$k]['Cod COR / Nomenclator'] = '';
                $excel[$k]['Locatie curs'] = $person['CompanyName'];
                $excel[$k]['Medie generala'] = '';
                $excel[$k]['Medie examen absolvire'] = '';
                $excel[$k]['Observatii'] = '';
                $k++;
            }
        } else {
            $smarty->assign(array(
                'status' => Person::$msStatus,
            ));
            $report_file = 'report_47.tpl';
        }

        break;

    case 48:

        if (!empty($_GET['export'])) {
            $k = 0;
            $excel[$k]['Nr. crt.'] = '';
            $excel[$k]['Nume'] = 1;
            $excel[$k]['Prenume'] = 2;
            $excel[$k]['CNP'] = 3;
            $excel[$k]['Telefon'] = 4;
            $excel[$k]['Email'] = 5;
            $excel[$k]['Adresa'] = 6;
            $excel[$k]['Judet'] = 7;
            $excel[$k]['Gen'] = 8;
            $excel[$k]['Nationalitate'] = 9;
            $excel[$k]['Statutul pe piata muncii'] = 10;
            $excel[$k]['Detalierea statului pe piata muncii - categoria angajati'] = 11;
            $excel[$k]['Detalierea statului pe piata muncii - categoria someri'] = 12;
            $excel[$k]['Detalierea statului pe piata muncii - categoria persoane inactive'] = 13;
            $excel[$k]['Varsta / ani'] = 14;
            $excel[$k]['Persoane apartind grupurilor vulnerabile'] = 15;
            $excel[$k]['Nivelul studiilor'] = 16;
            $excel[$k]['Anul includerii in grupul tinta'] = 17;
            $excel[$k]['Luna includerii in grupul tinta'] = 18;
            $excel[$k]['Anul iesirii din grupul tinta'] = 19;
            $excel[$k]['Luna iesirii din in grupul tinta'] = 20;
            $excel[$k]['Motivul iesirii din grupul tinta'] = 21;
            $persons = Reports::getReports_48();
            $k++;
            $countries = Utils::getCountries();
            foreach ($persons as $person) {
                $excel[$k]['Nr. crt.'] = $k;
                $excel[$k]['Nume'] = $person['LastName'];
                $excel[$k]['Prenume'] = $person['FirstName'];
                $excel[$k]['CNP'] = $person['CNP'];
                $excel[$k]['Telefon'] = $person['Phone'];
                $excel[$k]['Email'] = $person['Email'];
                $excel[$k]['Adresa'] = (!empty($person['StreetName']) ? $person['StreetName'] : '') .
                    (!empty($person['StreetNumber']) ? ', Nr ' . $person['StreetNumber'] : '') .
                    (!empty($person['Bl']) ? ', Bl ' . $person['Bl'] : '') .
                    (!empty($person['Sc']) ? ', Sc ' . $person['Sc'] : '') .
                    (!empty($person['Et']) ? ', Et ' . $person['Et'] : '') .
                    (!empty($person['Ap']) ? ', Ap ' . $person['Ap'] : '') .
                    (!empty($person['StreetCode']) ? ', Cod postal ' . $person['StreetCode'] : '');
                $excel[$k]['Adresa'] .= !empty($excel[$k]['Adresa']) ? ', ' . $person['CityName'] : '';
                $excel[$k]['Judet'] = $person['DistrictName'];
                $excel[$k]['Gen'] = $person['Sex'];
                $excel[$k]['Nationalitate'] = $countries[$person['Nationality']]['Nationality'];
                $excel[$k]['Statutul pe piata muncii'] = 'Angajat';
                $excel[$k]['Detalierea statului pe piata muncii - categoria angajati'] = 'Nu este cazul';
                $excel[$k]['Detalierea statului pe piata muncii - categoria someri'] = 'Nu este cazul';
                $excel[$k]['Detalierea statului pe piata muncii - categoria persoane inactive'] = 'Nu este cazul';
                $excel[$k]['Varsta / ani'] = $person['varsta'];
                $excel[$k]['Persoane apartind grupurilor vulnerabile'] = '';
                $excel[$k]['Nivelul studiilor'] = Person::$msStudies[$person['Studies']];
                $excel[$k]['Anul includerii in grupul tinta'] = $person['YearIn'];
                $excel[$k]['Luna includerii in grupul tinta'] = $person['MonthIn'];
                $excel[$k]['Anul iesirii din grupul tinta'] = $person['YearOut'];
                $excel[$k]['Luna iesirii din in grupul tinta'] = $person['MonthOut'];
                $excel[$k]['Motivul iesirii din grupul tinta'] = '';
                $k++;
            }
        } else {
            $smarty->assign(array(
                'status' => Person::$msStatus,
            ));
            $report_file = 'report_48.tpl';
        }

        break;

    case 49:
        if (!empty($_POST)) {
            Reports::setReports_49($_POST);
        }

        $vacations = Reports::getReports_49();


        $employees = Person::getEmployees();
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume');
            $fields['names'][] = array("name" => 'Companie', "label" => 'Companie', 'column' => 'CompanyID');
            $fields['names'][] = array("name" => 'DivisionID', "label" => 'Divizie');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'SubDepartmentID', "label" => 'Subdepartament');
            $fields['names'][] = array("name" => 'VacationStartDate', "label" => 'Data inceput');
            $fields['names'][] = array("name" => 'VacationStopDate', "label" => 'Data sfarsit');
            $fields['names'][] = array("name" => 'Type', "label" => 'Tip');
            $fields['names'][] = array("name" => 'VacationStatus', "label" => 'Status', 'column' => 'Aprove');
            $fields['names'][] = array("name" => 'Details', "label" => 'Detalii');
            $fields['names'][] = array("name" => 'Replacer', "label" => 'Inlocuitor');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($vacations))
            foreach ($vacations as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    if ($col == 'CompanyID') {
                        $fields['data'][$i][$k] = $self[$data[$col]];
                        continue;
                    }
                    if ($col == 'DivisionID') {
                        $fields['data'][$i][$k] = $divisions[$data[$col]];
                        continue;
                    }
                    if ($col == 'SubDepartmentID') {
                        $fields['data'][$i][$k] = $subdepartments[$data[$col]];
                        continue;
                    }
                    if ($col == 'Replacer') {
                        $fields['data'][$i][$k] = $employees[$data[$col]];
                        continue;
                    }
                    if ($col == 'Aprove') {
                        switch ($data[$col]) {
                            case '-1':
                                $vacationStatus = 'Respins';
                                break;
                            case '1':
                                $vacationStatus = 'Aprobat';
                                break;
                            case '0':
                            default:
                                $vacationStatus = 'Neaprobat';
                                break;
                        }
                        $fields['data'][$i][$k] = $vacationStatus;
                        continue;
                    }
                    if (in_array($col, array('VacationStartDate', 'VacationStopDate'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '00.00.0000') ? $data[$col] : '-';
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'vacations' => $vacations,
            'fields' => $fields_final,
            'personalise' => true,
            'employees' => $employees,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
        ));
        $report_file = 'report_49.tpl';


        break;

    case 50:

        $persons = Reports::getReports_50();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['LastName'];
                $excel[$k]['Prenume'] = $person['FirstName'];
                $excel[$k]['Pozitia'] = $person['JobTitle'];
                $excel[$k]['Numar interviu'] = $person['InterviewNo'];
                $excel[$k]['Calificativ'] = Event::$msInterviuQ[$person['InterviewQual']];
                $excel[$k]['Data interviu'] = $person['EventData'] . ' ' . $person['EventHourStart'] . ' ' . $person['EventHourStop'];
            }
        } else {
            $smarty->assign(array(
                'persons' => $persons,
                'projects' => Project::getActiveProjects(),
                'interviuQ' => Event::$msInterviuQ,
            ));
            $report_file = 'report_50.tpl';
        }

        break;

    case 51:

        $persons = Reports::getReports_51();
        if (!empty($_GET['export'])) {
            foreach ($persons as $k => $person) {
                $excel[$k]['Nume'] = $person['LastName'];
                $excel[$k]['Prenume'] = $person['FirstName'];
            }
        } else {
            $smarty->assign(array(
                'persons' => $persons,
                'jobs' => Job::getJobsByCompany(),
            ));
            $report_file = 'report_51.tpl';
        }

        break;

    case 58:

        $persons = Reports::getReports_58();
        $smarty->assign(array(
            'persons' => $persons,
        ));
        $report_file = 'report_58.tpl';

        break;

    case 59:

        $catering = Reports::getReports_59();
        if (!empty($_GET['export'])) {
            if (!empty($_GET['NoCatering'])) {
                foreach ($catering as $k => $v) {
                    $excel[$k]['Nume si prenume'] = $v['FullName'];
                }
            } else {
                foreach ($catering as $k => $v) {
                    $excel[$k]['Nume si prenume'] = $v['FullName'];
                    $excel[$k]['Marca'] = $v['EmpCode'];
                    $excel[$k]['Data'] = $v['Date'];
                    $excel[$k]['Nume mancare'] = $v['Item'];
                    $excel[$k]['Tip mancare'] = $v['Category'];
                    $excel[$k]['Portii'] = $v['No'];
                }
            }
        } else {
            $def_start = date('d-m-Y', strtotime(date('Y') . "W" . date('W')));
            $def_end = date('d-m-Y', strtotime(date('Y') . "W" . date('W')) + 6 * 24 * 3600);
            $smarty->assign(array(
                'catering' => $catering,
                'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
                'def_start' => $def_start,
                'def_end' => $def_end,
            ));
            $report_file = 'report_59.tpl';
        }

        break;
    case 60:

        $persons = Reports::getReports_60();
        $internal_functions = Utils::getGroupFunctions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume');
            $fields['names'][] = array("name" => 'DocName', "label" => 'Document');
            $fields['names'][] = array("name" => 'Function', "label" => 'Functie');
            $fields['names'][] = array("name" => 'ReadStatus', "label" => 'Status');
            $fields['names'][] = array("name" => 'ReadCreateDate', "label" => 'Data acceptare', 'default' => '-');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'ReadStatus') {
                        $fields['data'][$i][$k] = '';
                        if ($data['ReadStatus'] == -1) {
                            $fields['data'][$i][$k] = 'Neacceptat';
                        } elseif ($data['ReadStatus'] == 1) {
                            $fields['data'][$i][$k] = 'Acceptat';
                        }
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'ReadCreateDate') {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '0000-00-00') ? date('d-m-Y', strtotime($data[$col])) : '';
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'persons' => $persons,
            'internal_functions' => $internal_functions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_60.tpl';
        break;

    case 61:

        $catering = Reports::getReports_61();
        /*
	    if (!empty($_GET['export'])) {
		$k = 0;
		if(!empty($catering[0])){
			foreach ($catering[0] as $v) {
			foreach ($v as $v2) {
			foreach ($v2 as $v3) {
			    $excel[$k]['Nume si prenume']  	= $v3['FullName'];
			    $excel[$k]['Marca']  		= $v3['EmpCode'];
			    //$excel[$k]['Nume mancare']		= $v3['Item'];
			    $excel[$k]['Tip mancare']		= $v3['Category'];
			    $excel[$k]['Portii companie']  		= $v3['NoFree'];
			    $excel[$k]['Portii angajat']  		= $v3['NoPaid'];
			    $excel[$k]['Portii total']  		= $v3['No'];
			    $k++;
			}}}
	    }
		// Empty line
		$excel[$k+1]['1']  	= '';

		// Add categories
		$k=$k+2;
		foreach ($catering[1] as $kk=>$v) {
			$excel[$k+$kk]['1']  	= $v[''];
		    $excel[$k+$kk]['2']  	= $v[''];
		    $excel[$k+$kk]['3']		= $v[''];
		    $excel[$k+$kk]['Tip mancare']		= $v['Category'];
		    $excel[$k+$kk]['Portii companie']  		= $v['NoFree'];
		    $excel[$k+$kk]['Portii angajat']  		= $v['NoPaid'];
		    $excel[$k+$kk]['Portii total']  		= $v['No'];
		    $k++;
		}
	    }
	    */
        $def_start = date('d-m-Y', strtotime(date('Y') . "W" . date('W')));
        $def_end = date('d-m-Y', strtotime(date('Y') . "W" . date('W')) + 6 * 24 * 3600);
        $smarty->assign(array(
            'catering' => $catering,
            'departments' => Utils::getDepartments(),
            'divisions' => Utils::getDivisions(),
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'def_start' => $def_start,
            'def_end' => $def_end,
        ));
        $report_file = 'report_61.tpl';


        break;
    case 62:

        $medicals = Reports::getReports_62();
        $employees = Person::getEmployees();
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Companie');
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'SubDepartment', "label" => 'Subdepartament');
            $fields['names'][] = array("name" => 'MedicalStartDate', "label" => 'Data inceput');
            $fields['names'][] = array("name" => 'MedicalStopDate', "label" => 'Data sfarsit');
            $fields['names'][] = array("name" => 'MedicalNotes', "label" => 'Comentarii');
            $fields['names'][] = array("name" => 'ExpireDays', "label" => 'Numar zile pana la expirare');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($medicals))
            foreach ($medicals as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'MedicalStartDate') {
                        $fields['data'][$i][$k] = date('d-m-Y', strtotime($data['MedicalStartDate']));
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'MedicalStopDate') {
                        $fields['data'][$i][$k] = date('d-m-Y', strtotime($data['MedicalStopDate']));
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }


                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'employees' => $employees,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_62.tpl';


        break;

    case 157: //83
        if (!@in_array(157, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_157();
        $status = Person::$msStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'LastName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'FirstName', "label" => 'Prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'Sex', "label" => 'Sex', 'sort' => true);
            $fields['names'][] = array("name" => 'Age', "label" => 'Varsta', 'sort' => true);
            $fields['names'][] = array("name" => 'Seniority', "label" => 'Vechime', 'sort' => true);
            $cust = Utils::getCustomFields();
            $fields['names'][] = array("name" => 'CustomPerson1', "label" => $cust['CustomPerson1'], 'sort' => true);
            $fields['names'][] = array("name" => 'LeaveReasonNo', "label" => 'Motivul plecarii', 'sort' => true);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }
        // echo "<pre>"; print_r($fields); echo "</pre>";
        $smarty->assign(array(
            'persons' => $persons,
            'leavereason' => Person::$msSubStatus[6], //PayRoll::$msLeaveReason,
            'status' => $status,
            'health_companies' => $health_companies,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_157.tpl';

        $smarty->assign(array(
            'status' => $status,
            //'substatus'        => Person::$msSubStatus,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        break;

    case 158: //83
        if (!@in_array(158, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_158();
        $status = Person::$msStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'LastName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'FirstName', "label" => 'Prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'Sex', "label" => 'Sex', 'sort' => true);
            $fields['names'][] = array("name" => 'Age', "label" => 'Varsta', 'sort' => true);
            $cust = Utils::getCustomFields();
            $fields['names'][] = array("name" => 'CustomPerson1', "label" => $cust['CustomPerson1'], 'sort' => true);
            $fields['names'][] = array("name" => 'CustomPerson3', "label" => $cust['CustomPerson3'], 'sort' => true);
            $fields['names'][] = array("name" => 'CustomPerson4', "label" => $cust['CustomPerson4'], 'sort' => true);
            $fields['names'][] = array("name" => 'CustomPerson5', "label" => $cust['CustomPerson5'], 'sort' => true);
            $fields['names'][] = array("name" => 'CustomPerson6', "label" => $cust['CustomPerson6'], 'sort' => true);
            $fields['names'][] = array("name" => 'BI', "label" => 'BI', 'sort' => true);
            $fields['names'][] = array("name" => 'BIDataStart', "label" => 'Data emitere BI', 'sort' => true);
            $fields['names'][] = array("name" => 'BIDataStop', "label" => 'Data expirare BI', 'sort' => true);
            $fields['names'][] = array("name" => 'CIMNo', "label" => 'CIM nr.', 'sort' => true);
            $fields['names'][] = array("name" => 'CIMDate', "label" => 'CIM data', 'sort' => true);
            $fields['names'][] = array("name" => 'Salary', "label" => 'CIM salariu', 'sort' => true);
            $fields['names'][] = array("name" => 'asigStartDate', "label" => 'Data inceput asigurare medicala', 'sort' => true);
            $fields['names'][] = array("name" => 'asigEndDate', "label" => 'Data sfarsit asigurare medicala', 'sort' => true);
            $fields['names'][] = array("name" => 'analStartDate', "label" => 'Data inceput analize medicale', 'sort' => true);
            $fields['names'][] = array("name" => 'analEndDate', "label" => 'Data sfarsit analize medicale', 'sort' => true);
            $fields['names'][] = array("name" => 'protStartDate', "label" => 'Data inceput protectia muncii', 'sort' => true);
            $fields['names'][] = array("name" => 'protEndDate', "label" => 'Data sfarsit protectia muncii', 'sort' => true);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }
        //echo "<pre>"; print_r($fields); echo "</pre>";
        $smarty->assign(array(
            'persons' => $persons,
            'leavereason' => Person::$msSubStatus[6], //PayRoll::$msLeaveReason,
            'status' => $status,
            'health_companies' => $health_companies,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_158.tpl';

        $smarty->assign(array(
            'status' => $status,
            //'substatus'        => Person::$msSubStatus,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        break;

    case 83:
        if (!@in_array(83, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_83();
        $status = Person::$msStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();
        $health_companies = ConfigData::$msHealthCompanies;

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'LastName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'FirstName', "label" => 'Prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'DataStart', "label" => 'Data angajarii', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractNo', "label" => 'Numar contract Revisal', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractDate', "label" => 'Data incheiere contract', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP', 'sort' => true);
            $fields['names'][] = array("name" => 'PersonAddress', "label" => 'Adresa');
            $fields['names'][] = array("name" => 'HealthCompanyID', "label" => 'Casa asigurari de sanatate');
            $fields['names'][] = array("name" => 'Function', "label" => 'Functie', 'sort' => true);
            $fields['names'][] = array("name" => 'COR', "label" => 'Cod COR', 'sort' => true);
            $fields['names'][] = array("name" => 'Salary', "label" => 'Salariu brut', 'sort' => true, 'align' => 'right');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'HealthCompanyID') {
                        $fields['data'][$i][$k] = $health_companies[$data['HealthCompanyID']];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if (in_array($col, array('DataStart', 'ContractDate'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '0000-00-00') ? date('d-m-Y', strtotime($data[$col])) : '';
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }


                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'persons' => $persons,
            'status' => $status,
            'health_companies' => $health_companies,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_83.tpl';

        $smarty->assign(array(
            'status' => $status,
            //'substatus'        => Person::$msSubStatus,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        break;

    case 86:
        if (!@in_array(86, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_86();

        $StartDate = (int)$_GET['Year'] . '-01-01';
        $EndDate = (int)$_GET['Year'] . '-12-31';
        $arr_month = Utils::getMonthArray($StartDate, $EndDate);

        $smarty->assign(array(
            'status' => Person::$msStatus,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'months' => $arr_month,
            'years' => range(date('Y') - 3, date('Y')),
            'persons' => $persons,
            'request_uri' => "./?m=reports&rep=86&Year={$_GET['Year']}",
        ));
        $report_file = 'report_86.tpl';
        break;

    case 87:
        if (!@in_array(87, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_87();
        $smarty->assign(array(
            'contract_type' => PayRoll::$msContractType,
            'persons' => $persons,
            'status' => Person::$msStatus,
            'contract_type' => PayRoll::$msContractType,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'request_uri' => "./?m=reports&rep=87&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}&SubdepartmentID={$_GET['SubdepartmentID']}",
        ));
        $report_file = 'report_87.tpl';
        break;

    case 88:
        if (!@in_array(88, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $StartDate = Utils::toDBDate($_GET['StartDate']);
        $EndDate = Utils::toDBDate($_GET['EndDate']);
        $arr_month = Utils::getMonthArray($StartDate, $EndDate);

        $persons = Reports::getReports_88();

        $fields_final = $fields = array();

        $label_tichete = 'Tichete in perioada';
        if (isset($_GET['StartDate']) && isset($_GET['EndDate'])) {
            $label_tichete .= '<br/>' . $_GET['StartDate'] . ' / ' . $_GET['EndDate'];
        }

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'DataStart', "label" => 'Data angajarii', 'sort' => true);
            $fields['names'][] = array("name" => 'DataEnd', "label" => 'Data plecarii', 'sort' => true);
            $fields['names'][] = array("name" => 'Status', "label" => 'Status', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractType', "label" => 'Tip contract', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Companie', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'Subdepartment', "label" => 'Subdepartament', 'sort' => true);
            $fields['names'][] = array("name" => 'Tickets', "label" => $label_tichete, 'sort' => true);
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'Status') {
                        $fields['data'][$i][$k] = Person::$msStatus[$data['Status']];
                        continue;
                    }
                    if ($col == 'ContractType') {
                        $fields['data'][$i][$k] = PayRoll::$msContractType[$data['ContractType']];
                        continue;
                    }
                    if (in_array($col, array('DataStart', 'DataEnd'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '00.00.0000') ? $data[$col] : '-';
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'contract_type' => PayRoll::$msContractType,
            'fields' => $fields_final,
            'personalise' => true,
            'status' => Person::$msStatus,
            'contract_type' => PayRoll::$msContractType,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'months' => $arr_month,
            'request_uri' => "./?m=reports&rep=88&StartDate={$_GET['StartDate']}&EndDate={$_GET['EndDate']}&Status={$_GET['Status']}&ContractType={$_GET['ContractType']}&CompanyID={$_GET['CompanyID']}&DivisionID={$_GET['DivisionID']}&DepartmentID={$_GET['DepartmentID']}&SubdepartmentID={$_GET['SubdepartmentID']}",
        ));
        $report_file = 'report_88.tpl';
        break;

    case 89:
        if (!@in_array(89, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_89();
        $status = Person::$msStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();
        $studies = ConfigData::$msStudies;
        $jobs = Job::getJobsTitle();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'Function', "label" => 'Functie', 'sort' => true);
            $fields['names'][] = array("name" => 'COR', "label" => 'COR');
            $fields['names'][] = array("name" => 'PersonAddress', "label" => 'Domiciliul');
            $fields['names'][] = array("name" => 'BirthDate', "label" => 'Data si locul nasterii');
            $fields['names'][] = array("name" => 'JobDictionaryID', "label" => 'Calificare');
            $fields['names'][] = array("name" => 'Studies', "label" => 'Studii');
            $fields['names'][] = array("name" => 'Function-COR', "label" => 'Functie');
            $fields['names'][] = array("name" => 'Route', "label" => 'Traseul de deplasare de/la serviciu');
            $fields['names'][] = array("name" => 'StartDate', "label" => 'Data angajarii');
            $fields['names'][] = array("name" => 'MedRegDate', "label" => 'Data inceput');
            $fields['names'][] = array("name" => 'MedEndDate', "label" => 'Data sfarsit');
            $fields['names'][] = array("name" => 'ExpireDays', "label" => 'Expirare (zile)');

        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'BirthDate') {
                        $fields['data'][$i][$k] = $data['BirthDate'];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        if (!empty($data['BirthDistrict'])) {
                            $fields['data'][$i][$k] .= " " . $data['BirthCity'] . ", " . $data['BirthDistrict'];
                        }
                        continue;
                    }
                    if ($col == 'Function-COR') {
                        $fields['data'][$i][$k] = $data['Function'];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        if (!empty($data['COR'])) {
                            $fields['data'][$i][$k] .= " - " . $data['COR'];
                        }
                        continue;
                    }
                    if (in_array($col, array('StartDate', 'MedRegDate', 'MedEndDate'))) {
                        $fields['data'][$i][$k] = (!empty($data[$col]) && $data[$col] != '0000-00-00') ? date('d-m-Y', strtotime($data[$col])) : '';
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'JobDictionaryID') {
                        $fields['data'][$i][$k] = $jobs[$data['JobDictionaryID']];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'Studies') {
                        $fields['data'][$i][$k] = $studies[$data['Studies']];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }


                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'status' => $status,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_89.tpl';
        break;

    case 90:
        if (@!in_array(90, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_90();
        $self = Company::getSelfCompanies();

        // Report structure
        $fields[$reportID] = Utils::getReportPersonalization($reportID);
        if (empty($fields[$reportID]['names'])) {

            $fields[$reportID]['names'][0] = array(
                'name' => 'year',
                'label' => 'Anul',
            );
            $fields[$reportID]['names'][1] = array(
                'name' => 'trimester',
                'label' => 'Trimestrul',
            );
            $fields[$reportID]['names'][2] = array(
                'name' => 'month',
                'label' => 'Luna',
            );
            $fields[$reportID]['names'][3] = array(
                'name' => 'CompanyName',
                'label' => 'Companie',
            );
            $fields[$reportID]['names'][4] = array(
                'name' => 'employed',
                'label' => 'Angajati veniti',
            );
            $fields[$reportID]['names'][5] = array(
                'name' => 'employees_left',
                'label' => 'Angajati plecati',
            );
            $fields[$reportID]['names'][6] = array(
                'name' => 'employees',
                'label' => 'Angajati curenti',
            );
            $fields[$reportID]['names'][7] = array(
                'name' => 'fluctuation',
                'label' => 'Procent fluctuatie personal',
            );
        }

        $_SESSION['report_fields_names'][$reportID] = $fields[$reportID]['names'];

        // Report data
        foreach ($persons as $person) {
            if (!empty($person['CompanyName'])) {
                $fields[$reportID]['names'][0]['data'][] = $person['year'];
                $fields[$reportID]['names'][1]['data'][] = $person['trimester'];
                $fields[$reportID]['names'][2]['data'][] = $person['month'];
                $fields[$reportID]['names'][3]['data'][] = $person['CompanyName'];
                $fields[$reportID]['names'][4]['data'][] = $person['employed'];
                $fields[$reportID]['names'][5]['data'][] = $person['employees_left'];
                $fields[$reportID]['names'][6]['data'][] = $person['employees'];
                $fields[$reportID]['names'][7]['data'][] = $person['fluctuation'];
            }
        }

        if (empty($fields[$reportID]['order'])) {
            // Report visibility&order settings
            $fields[$reportID]['order'] = array(
                array('field_id' => 0, 'visible' => true, 'position' => 1),
                array('field_id' => 1, 'visible' => true, 'position' => 2),
                array('field_id' => 2, 'visible' => true, 'position' => 3),
                array('field_id' => 3, 'visible' => true, 'position' => 4),
                array('field_id' => 4, 'visible' => true, 'position' => 5),
                array('field_id' => 5, 'visible' => true, 'position' => 6),
                array('field_id' => 6, 'visible' => true, 'position' => 7),
                array('field_id' => 7, 'visible' => true, 'position' => 8),
            );
        }
        // Save order in session
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields[$reportID]['order'];

        // Set reorder of data
        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[$reportID][] = $fields[$reportID]['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => $self,
            'persons' => $persons,
            'fields' => $fields_final[$reportID],
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_90.tpl';
        break;

    case 92:
        if (@!in_array(92, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_92();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'TrainingCost', "label" => 'Costuri training', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'TrainedPersons', "label" => 'Angajati participanti la training', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'TotalEmployees', "label" => 'Total angajati in companie', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'PEmpTCost', "label" => 'Costuri training per angajat participant', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'AEmpTCost', "label" => 'Costuri training per angajat activ', 'align' => 'center', 'default' => 0);

        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    if ($col == 'TrainingCost') {
                        $fields['data'][$i][$k] = number_format(($data['CostPerTraining'] * $data['TrainedPersons']), 2, '.', '');
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        $fields['data'][$i][$k] .= " " . $data['CostPerTrainingCurrency'];
                        continue;
                    }
                    if ($col == 'PEmpTCost') {
                        $fields['data'][$i][$k] = $data['CostPerTraining'];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        $fields['data'][$i][$k] .= " " . $data['CostPerTrainingCurrency'];
                        continue;
                    }
                    if ($col == 'AEmpTCost') {
                        $fields['data'][$i][$k] = number_format(($data['CostPerTraining'] * $data['TrainedPersons'] / $data['TotalEmployees']), 2, '.', '');
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        $fields['data'][$i][$k] .= " " . $data['CostPerTrainingCurrency'];
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_92.tpl';
        break;

    case 93:
        if (@!in_array(93, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_93();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'CBonusBrutPerPeriod', "label" => 'Valoare bonusuri', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'BonusedPersons', "label" => 'Angajati bonusati', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'TotalEmployees', "label" => 'Total angajati in companie', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'AvBonus', "label" => 'Valoarea medie a bonusurilor', 'align' => 'center', 'default' => 0);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                if (empty($data['CompanyID'])) continue;
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'CBonusBrutPerPeriod') {
                        $fields['data'][$i][$k] = $data['BonusBrutPerPeriod'];
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        $fields['data'][$i][$k] .= " " . $data['Currency'];
                        continue;
                    }

                    if ($col == 'AvBonus') {
                        $fields['data'][$i][$k] = number_format(($data['BonusBrutPerPeriod'] / $data['TotalEmployees']), 2, '.', '');
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        $fields['data'][$i][$k] .= " " . $data['Currency'];
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_93.tpl';
        break;

    case 94:
        if (@!in_array(94, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $persons = Reports::getReports_94();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'TrainingTime', "label" => 'Total ore training', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'TrainedPersons', "label" => 'Angajati participanti la training', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'TotalEmployees', "label" => 'Total angajati in companie', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'HoursPerTraining', "label" => 'Ore training per angajat participant', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'AEmpTrTime', "label" => 'Ore training per angajat activ', 'align' => 'center', 'default' => 0);

        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                if (empty($data['CompanyID'])) continue;
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'TrainingTime') {
                        $fields['data'][$i][$k] = ($data['HoursPerTraining'] * $data['TrainedPersons']);
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'AEmpTrTime') {
                        $fields['data'][$i][$k] = number_format(($data['HoursPerTraining'] * $data['TrainedPersons'] / $data['TotalEmployees']), 2, '.', '');
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_94.tpl';
        break;

    case 96:
        if (@!in_array(96, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_96();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'CertificatesPerPeriod', "label" => 'Total certificate', 'align' => 'center');
            $fields['names'][] = array("name" => 'CertifiedPersons', "label" => 'Angajati certificati', 'align' => 'center');
            $fields['names'][] = array("name" => 'TotalEmployees', "label" => 'Total angajati in companie', 'align' => 'center');
            $fields['names'][] = array("name" => 'CertificateBalance', "label" => 'Certificari per angajat', 'align' => 'center');

        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }
        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    if ($col == 'CertificateBalance') {
                        $fields['data'][$i][$k] = number_format($data['CertificatesPerPeriod'] / $data['TotalEmployees'], 2, '.', '');
                        continue;
                    }

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_96.tpl';
        break;

    case 97:
        $results = Reports::getReports_97();
        $persons = $results[0];
        $sums = $results[1];
        $totals = $results[2];
        $self = Company::getSelfCompanies();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';

        $fields_final = $fields = $fields_sums = $fields_total = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'MonthSalary', "label" => 'Salariu lunar', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'SBonus', "label" => 'Bonus', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'SPremium', "label" => 'Prime', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'OT', "label" => 'Ore suplimentare', 'align' => 'center');
            $fields['names'][] = array("name" => 'ConcediuNeefectuat', "label" => 'Concediu odihna neefectuat', 'align' => 'center');
            $fields['names'][] = array("name" => 'TaxMealTickets', "label" => 'Impozit valoare bonuri', 'align' => 'right');
            $fields['names'][] = array("name" => 'SYoyInc', "label" => 'Crestere salariala anuala', 'align' => 'right');
            $fields['names'][] = array("name" => 'CO', "label" => 'Valoare concediu', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'Meal', "label" => 'Masa', 'align' => 'right');
            $fields['names'][] = array("name" => 'HealthIns', "label" => 'Asigurari de sanatate', 'align' => 'right');
            $fields['names'][] = array("name" => 'FamilyHealthIns', "label" => 'Asigurari de sanatate familie', 'align' => 'right');
            $fields['names'][] = array("name" => 'FinancialBenefits', "label" => 'Compensatii financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'NonFinancialBenefits', "label" => 'Compensatii non-financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'Trainings', "label" => 'Cheltuieli dezvoltare profesionala', 'align' => 'right');
            $fields['names'][] = array("name" => 'Displacements', "label" => 'Cheltuieli deplasari', 'align' => 'right');
            $fields['names'][] = array("name" => 'YearlySalaryPackage', "label" => 'Pachet salarial anual', 'align' => 'right');
            $fields['names'][] = array("name" => 'MonthlySalaryPackage', "label" => 'Pachet salarial lunar', 'align' => 'right');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons)) {
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

            foreach ($sums as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col != 'Department') {
                        if ($col != 'FullName') {
                            $fields_sums['data'][$i][$k] = $sums[$i][$col];
                            if ($i == 0) {
                                $fields_total['data'][$k] = $totals[$col];
                            }
                        } else {
                            $fields_sums['data'][$i][$k] = $sums[$i]['Name'];
                        }
                    }
                }
            }
        }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }
        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'sums_data' => $fields_sums['data'],
            'totals_data' => $fields_total['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'year' => $year,
            'company' => $self[$company_id],
            'sums' => $sums,
            'totals' => $totals,
            'salary_types' => ConfigData::$msSalaryType,
        ));
        $report_file = 'report_97.tpl';
        break;
    case 98:
        $results = Reports::getReports_98();
        $persons = $results[0];
        $sums = $results[1];
        $totals = $results[2];
        $self = Company::getSelfCompanies();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';

        $fields_final = $fields = $fields_sums = $fields_total = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'MonthSalary', "label" => 'Salariu lunar', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'SBonus', "label" => 'Bonus', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'SPremium', "label" => 'Prime', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'OT', "label" => 'Ore suplimentare', 'align' => 'center');
            $fields['names'][] = array("name" => 'ConcediuNeefectuat', "label" => 'Concediu odihna neefectuat', 'align' => 'center');
            $fields['names'][] = array("name" => 'TaxMealTickets', "label" => 'Impozit valoare bonuri', 'align' => 'right');
            $fields['names'][] = array("name" => 'Meal', "label" => 'Masa', 'align' => 'right');
            $fields['names'][] = array("name" => 'HealthIns', "label" => 'Asigurari de sanatate', 'align' => 'right');
            $fields['names'][] = array("name" => 'FamilyHealthIns', "label" => 'Asigurari de sanatate familie', 'align' => 'right');
            $fields['names'][] = array("name" => 'FinancialBenefits', "label" => 'Compensatii financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'NonFinancialBenefits', "label" => 'Compensatii non-financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'Trainings', "label" => 'Cheltuieli dezvoltare profesionala', 'align' => 'right');
            $fields['names'][] = array("name" => 'Displacements', "label" => 'Cheltuieli deplasari', 'align' => 'right');
            $fields['names'][] = array("name" => 'MonthlySalaryPackage', "label" => 'Pachet salarial lunar', 'align' => 'right');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons)) {
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

            foreach ($sums as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col != 'Department') {
                        if ($col != 'FullName') {
                            $fields_sums['data'][$i][$k] = $sums[$i][$col];
                            if ($i == 0) {
                                $fields_total['data'][$k] = $totals[$col];
                            }
                        } else {
                            $fields_sums['data'][$i][$k] = $sums[$i]['Name'];
                        }
                    }
                }
            }
        }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'sums_data' => $fields_sums['data'],
            'totals_data' => $fields_total['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => range(1, 12),
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'year' => $year,
            'company' => $self[$company_id],
            'sums' => $sums,
            'totals' => $totals,
            'salary_types' => ConfigData::$msSalaryType,
            'month' => $month,
        ));
        $report_file = 'report_98.tpl';
        break;

    case 113:
        if (@!in_array(113, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $res = Reports::getReports_113();


        $fields_final = $fields = array();


        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'VacantPositions', "label" => 'Numar pozitii vacante', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'FreeMonths', "label" => 'Timp ocupare(luni)', 'align' => 'center', 'default' => 0);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($res))
            foreach ($res as $i => $data) {
                if (empty($data['CompanyID'])) continue;
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];


                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_113.tpl';
        break;

    case 114:
        if (@!in_array(114, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $res = Reports::getReports_114();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'year', "label" => 'Anul');
            $fields['names'][] = array("name" => 'trimester', "label" => 'Trimestrul', 'align' => 'center');
            $fields['names'][] = array("name" => 'month', "label" => 'Luna');
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Firma', 'align' => 'center');
            $fields['names'][] = array("name" => 'VacantPositions', "label" => 'Numar pozitii vacante', 'align' => 'center', 'default' => 0);
            $fields['names'][] = array("name" => 'FreeMonths', "label" => 'Timp de promovare(luni)', 'align' => 'center', 'default' => 0);

        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($res))
            foreach ($res as $i => $data) {
                if (empty($data['CompanyID'])) continue;
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];


                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'years' => range(date('Y') - 10, date('Y')),
            'trimesters' => range(1, 3),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_114.tpl';
        break;

    case 115:
        if (@!in_array(115, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $results = Reports::getReports_115();
        $smarty->assign(array(
            'years' => range(date('Y') - 5, date('Y') + 2),
            'months' => range(1, 12),
            'self' => Company::getSelfCompanies(),
            'departments' => Utils::getDepartments(),
            'info' => $results[0],
            'persons' => $results[1],
            'status' => Person::$msStatus,
        ));


        $report_file = 'report_115.tpl';
        break;

    case 116:
        $persons = array();
        if (!empty($_GET['do_rep'])) {
            $persons = Reports::getReports_116();
        }
        $self = Company::getSelfCompanies();
        $deps = Utils::getDepartments();

        unset(Person::$msStatus[1]);
        unset(Person::$msStatus[8]);

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'InternalFunctionName', "label" => 'Functia interna', 'align' => 'right');
            $fields['names'][] = array("name" => 'StartDate', "label" => 'Data angajarii', 'align' => 'right', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractProbationPeriod', "label" => 'Perioada de proba', 'align' => 'right', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractProbationEnd', "label" => 'Data final perioada de proba', 'column' => 'ProbaEnd', 'align' => 'center', 'sort' => true);
            $fields['names'][] = array("name" => 'RemDays', "label" => 'Zile ramase perioada de proba', 'align' => 'right');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'self' => $self,
            'departments' => $deps,
            'contract_type' => PayRoll::$msContractType,
            'status' => Person::$msStatus,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_116.tpl';
        break;

    case 117:
        $results = Reports::getReports_117();
        $persons = $results[0][0];
        $listed_departments = $results[0][1];
        $persons_totals = $results[0][2];
        $sums_totals = $results[0][3];
        $totals_totals = $results[0][4];
        $sums = $results[1];
        $totals = $results[2];
        $self = Company::getSelfCompanies();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $months_list = !empty($_GET['PrevMonths']) ? range(1, $month) : $month;
        //Utils::pa($results);
        $smarty->assign(array(
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => range(1, 12),
            'months_list' => $months_list,
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'year' => $year,
            'company' => $self[$company_id],
            'sums' => $sums,
            'totals' => $totals,
            'salary_types' => ConfigData::$msSalaryType,
            'month' => $month,
            'results' => $results,
            'listed_departments' => $listed_departments,
            'persons_totals' => $persons_totals,
            'sums_totals' => $sums_totals,
            'totals_totals' => $totals_totals,
        ));
        $report_file = 'report_117.tpl';
        break;


    case 118:
        if (@!in_array(118, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $results = Reports::getReports_118();
        $smarty->assign(array(
            'tickets' => $results[0],
            'sums' => $results[1],
            'companies' => Company::getNonSelfCompanies(),
            'status' => ConfigData::$msTicketingStatus,
            'types' => ConfigData::$msTicketingType,
            'intervention_types' => ConfigData::$msTicketingInterventionType,
            'persons' => Person::getPersonsList(),
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        $report_file = 'report_118.tpl';
        break;

    case 119:
        if (@!in_array(119, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $results = Reports::getReports_119();
        $smarty->assign(array(
            'tickets' => $results[0],
            'sums' => $results[1],
            'companies' => Company::getNonSelfCompanies(),
            'status' => ConfigData::$msTicketingStatus,
            'types' => ConfigData::$msTicketingType,
            'intervention_types' => ConfigData::$msTicketingInterventionType,
            'persons' => Person::getPersonsList(),
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        $report_file = 'report_119.tpl';
        break;

    case 120:
        if (@!in_array(120, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $results = Reports::getReports_120();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Beneficiar', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'FurnizorName', "label" => 'Furnizor', 'sort' => true);
            $fields['names'][] = array("name" => 'resp_financiar', "label" => 'Responsabil financiar', 'sort' => true);
            $fields['names'][] = array("name" => 'resp_tehnic', "label" => 'Responsabil tehnic', 'sort' => true);
            $fields['names'][] = array("name" => 'ContractValue', "label" => 'Valoare plata', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'Coin', "label" => 'Moneda', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'PayDate', "label" => 'Data facturare', 'sort' => true);
            $fields['names'][] = array("name" => 'CompanyEmail', "label" => 'Email beneficiar', 'sort' => true);
            $fields['names'][] = array("name" => 'BeneficiarAddress', "label" => 'Adresa de livrare beneficiar');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($results)) {
            foreach ($results as $tip => $lstContracts) {
                if (count($lstContracts) > 0) {
                    foreach ($lstContracts as $i => $data) {
                        foreach ($fields['order'] as $v) {
                            $k = $fields['names'][$v['field_id']]['name'];
                            $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                            $fields['data'][$tip][$i][$k] = $data[$col];
                        }
                    }
                }
            }
        }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'contracts' => $results,
            'companies' => Company::getCompanies(),
            'persons' => Person::getPersonsList(),
            'status' => Contract::$msContractStatus,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        $report_file = 'report_120.tpl';
        break;

    case 123:
        $results = Reports::getReports_123();
        $persons = $results;
        $self = Company::getSelfCompanies();

        $month = !empty($_GET['Month']) ? str_pad($_GET['Month'], 2, '0', STR_PAD_LEFT) : '';
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        if (!empty($_GET['export_txt']) && !empty($_GET['Year']) && !empty($_GET['Month']) && !empty($_GET['SalaryPaymentType'])) {
            header("Content-Type: application/octet-stream");
            header("Expires: 0");
            header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
            header("content-disposition: attachment;filename=Plata_salarii_$month-" . $_GET['Year'] . "-" . ($_GET['SalaryPaymentType'] == 1 ? "AVANS" : "LICHIDARE") . ".txt");
            echo "cont sursa\tcont destinatie\tsuma\tbeneficiar\tdetalii 1\tdetalii 2";
            foreach ($persons as $person) {
                echo "\r\nRO71INGB5552999900780206\t{$person['BankAccount']}\t{$person['SalaryValue']}\t" . strtoupper($person['FullName']) . "\t$month\t" . ($_GET['SalaryPaymentType'] == 1 ? "AVANS" : "LICHIDARE");
            }

            exit;
        }
        $smarty->assign(array(
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => range(1, 12),
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'month' => $month,
            'company' => $self[$company_id],
            'salary_payment_types' => ConfigData::$msSalaryPaymentType,
        ));
        $report_file = 'report_123.tpl';
        break;
    case 124:
        $results = Reports::getReports_124();
        $persons = $results[0];
        $sums = $results[1];
        $totals = $results[2];
        $self = Company::getSelfCompanies();
        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';

        $fields_final = $fields = $fields_sums = $fields_total = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'Salary', "label" => 'Salariu', 'align' => 'right');
            $fields['names'][] = array("name" => 'SBonus', "label" => 'Bonus', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'SPremium', "label" => 'Prime', 'sort' => true, 'align' => 'right');
            $fields['names'][] = array("name" => 'OT', "label" => 'Ore suplimentare', 'align' => 'center');
            $fields['names'][] = array("name" => 'TaxMealTickets', "label" => 'Impozit valoare bonuri', 'align' => 'right');
            $fields['names'][] = array("name" => 'Meal', "label" => 'Masa', 'align' => 'right');
            $fields['names'][] = array("name" => 'HealthIns', "label" => 'Asigurari de sanatate', 'align' => 'right');
            $fields['names'][] = array("name" => 'FamilyHealthIns', "label" => 'Asigurari de sanatate familie', 'align' => 'right');
            $fields['names'][] = array("name" => 'FinancialBenefits', "label" => 'Compensatii financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'NonFinancialBenefits', "label" => 'Compensatii non-financiare', 'align' => 'right');
            $fields['names'][] = array("name" => 'Trainings', "label" => 'Cheltuieli dezvoltare profesionala', 'align' => 'right');
            $fields['names'][] = array("name" => 'Displacements', "label" => 'Cheltuieli deplasari', 'align' => 'right');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons)) {
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

            foreach ($sums as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col != 'Department') {
                        if ($col != 'FullName') {
                            $fields_sums['data'][$i][$k] = $sums[$i][$col];
                            if ($i == 0) {
                                $fields_total['data'][$k] = $totals[$col];
                            }
                        } else {
                            $fields_sums['data'][$i][$k] = $sums[$i]['Name'];
                        }
                    }
                }
            }
        }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'sums_data' => $fields_sums['data'],
            'totals_data' => $fields_total['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'year' => $year,
            'company' => $self[$company_id],
            'sums' => $sums,
            'totals' => $totals,
            'salary_types' => ConfigData::$msSalaryType,
        ));
        $report_file = 'report_124.tpl';
        break;
    case 125:
        $results = Reports::getReports_125();
        $persons = $results[0];
        $sums = $results[1];
        $totals = $results[2];
        $self = Company::getSelfCompanies();

        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';
        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'company' => $self[$company_id],
            'sums' => $sums,
            'totals' => $totals,
            'def_start' => date('Y-m') . '-01',
            'def_end' => date('Y-m-t'),
        ));
        $report_file = 'report_125.tpl';
        break;

    case 126:
        $results = Reports::getReports_126();
        $self = Company::getSelfCompanies();

        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'inventar_categories' => ConfigData::$msInventarCategories,
            'inventar' => $results,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'def_start' => date('Y-m') . '-01',
            'def_end' => date('Y-m-t'),
        ));
        $report_file = 'report_126.tpl';
        break;

    case 127:
        $products = Reports::getReports_127();
        $self = Company::getSelfCompanies();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume');
            $fields['names'][] = array("name" => 'ObjName', "label" => 'Model');
            $fields['names'][] = array("name" => 'ObjAcqDate', "label" => 'Data stoc', 'align' => 'center');
            $fields['names'][] = array("name" => 'InvoiceDate', "label" => 'Data factura', 'align' => 'center');
            $fields['names'][] = array("name" => 'InvoiceNo', "label" => 'Nr factura', 'align' => 'center');
            $fields['names'][] = array("name" => 'InvoiceValue', "label" => 'Total factura', 'align' => 'center');
            $fields['names'][] = array("name" => 'PaymentTerm', "label" => 'Termen de plata (zile)', 'default' => 0, 'align' => 'center');
            $fields['names'][] = array("name" => 'ToPay', "label" => 'Rest plata', 'align' => 'center');
            $fields['names'][] = array("name" => 'Payed', "label" => 'Achitat', 'align' => 'center');
            $fields['names'][] = array("name" => 'Notes', "label" => 'Observatii');
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        $total = 0;

        if (!empty($products))
            foreach ($products as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    if ($col == 'ObjName') {
                        $fields['data'][$i][$k] = $data['ObjName'] . " (" . $data['ObjCode'] . ")";
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'ObjAcqDate') {
                        $fields['data'][$i][$k] = date('d-m-Y', strtotime($data['ObjAcqDate']));
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }
                    if ($col == 'InvoiceDate') {
                        $fields['data'][$i][$k] = date('d-m-Y', strtotime($data['InvoiceDate']));
                        if (empty($fields['data'][$i][$k]) && $default !== false) {
                            $fields['data'][$i][$k] = $default;
                        }
                        continue;
                    }

                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
                $total++;
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'inventar_categories' => ConfigData::$msInventarCategories,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'def_start' => date('Y-m') . '-01',
            'def_end' => date('Y-m-t'),
        ));
        $report_file = 'report_127.tpl';
        break;

    case 128:
        $phones = Reports::getReports_128();
        $self = Company::getSelfCompanies();

        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'phones' => $phones,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'def_start' => date('Y-m') . '-01',
            'def_end' => date('Y-m-t'),
        ));
        $report_file = 'report_128.tpl';
        break;

    case 129:
        $deplasari = Reports::getReports_129();
        $self = Company::getSelfCompanies();


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Company', "label" => 'Companie');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'StartDate', "label" => 'Data Inceput Deplasare');
            $fields['names'][] = array("name" => 'StopDate', "label" => 'Data Sfarsit Deplasare');
            $fields['names'][] = array("name" => 'durata_calendar', "label" => 'Durata (zile calendaristice)');
            $fields['names'][] = array("name" => 'durata_lucratoare', "label" => 'Durata (zile lucratoare)');
            $fields['names'][] = array("name" => 'Location', "label" => 'Localitate');
            $fields['names'][] = array("name" => 'diurna', "label" => 'Diurna', 'align' => 'center');
            $fields['names'][] = array("name" => 'chelt', "label" => 'Cheltuieli', 'align' => 'center');
            $fields['names'][] = array("name" => 'chelt_total', "label" => 'Total Cheltuieli', 'align' => 'center');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($deplasari))
            foreach ($deplasari as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }


        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'divisions' => Utils::getDivisions(),
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_129.tpl';
        break;

    case 130:
        $persons = Reports::getReports_130();

        $self = Company::getSelfCompanies();

        $year = !empty($_GET['Year']) ? (int)$_GET['Year'] : date('Y');
        $month = !empty($_GET['Month']) ? (int)$_GET['Month'] : date('m');
        $company_id = !empty($_GET['CompanyID']) ? (int)$_GET['CompanyID'] : '';


        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Company', "label" => 'Companie');
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume si Prenume');
            $fields['names'][] = array("name" => 'ore', "label" => 'Total Ore', 'align' => 'center');
            $fields['names'][] = array("name" => 'cost', "label" => 'Cost Ore', 'align' => 'center');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    if ($data['ore']) {
                        $k = $fields['names'][$v['field_id']]['name'];
                        $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];

                        $fields['data'][$i][$k] = $data[$col];
                    }
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];


        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => range(1, 12),
            'departments' => Utils::getDepartments(),
            'fields_data' => $fields['data'],
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'year' => $year,
            'company' => $self[$company_id],
            'month' => $month,
            'fields' => $fields_final,
            'personalise' => true,
        ));
        $report_file = 'report_130.tpl';
        break;

    case 151:
        $persons = Reports::getReports_151();
        $self = Company::getSelfCompanies();

        $calendar = new Calendar();
        $smarty->assign(array(
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => array_combine(range(1, 12), $calendar->getMonthNames()),
            'departments' => Utils::getDepartments(),
            'divisions' => Utils::getDivisions(),
            'persons' => $persons,
            'health_companies' => ConfigData::$msHealthCompanies,
            'contract_types' => ConfigData::$msContractType,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        $report_file = 'report_151.tpl';
        break;

    case 152:
        $persons = Reports::getReports_152();
        $self = Company::getSelfCompanies();

        $calendar = new Calendar();
        $Divisions = Utils::getDivisions();
        $health_companies = ConfigData::$msHealthCompanies;
        $contract_types = ConfigData::$msContractType;

        $smarty->assign(array(
            'self' => $self,
            'years' => range(date('Y') - 3, date('Y') + 2),
            'months' => array_combine(range(1, 12), $calendar->getMonthNames()),
            'departments' => Utils::getDepartments(),
            'divisions' => $Divisions,
            'persons' => $persons,
            'health_companies' => $health_companies,
            'contract_types' => $contract_types,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));

        // EXCEL EXPORT BUILD
        $i = 0;
        foreach ($persons as $person) {
            $i++;
            $excel[$i]['#'] = $i;
            $excel[$i]['Divizie'] = $Divisions[$person['DivisionID']];
            $excel[$i]['CNP'] = $person['CNP'];
            $excel[$i]['Nume'] = $person['LastName'];
            $excel[$i]['Prenume'] = $person['FirstName'];
            $excel[$i]['Judet'] = $person['DistrictName'];
            $excel[$i]['Localitate'] = $person['CityName'];
            $excel[$i]['Sector'] = $person['Sector'];
            $excel[$i]['Cod postal'] = $person['StreetCode'];
            $excel[$i]['Adresa'] = $person['StreetName'] . ', Bl.: ' . $person['Bl'] . ', Sc.: ' . $person['Sc'] . ', Et.: ' . $person['Et'] . ', Ap.: ' . $person['Ap'];
            $excel[$i]['Telefon'] = $person['Mobile'];
            $excel[$i]['Email'] = $person['Email'];
            $excel[$i]['Cont personal'] = $person['BankAccount'];
            $excel[$i]['Banca'] = $person['BankName'];
            $excel[$i]['Sucursala'] = $person['BankLocation'];
            $excel[$i]['Data angajarii'] = date('d-m-Y', strtotime($person['StartDate']));
            $excel[$i]['Data incetarii activitatii'] = date('d-m-Y', strtotime($person['StopDate']));
            $excel[$i]['Casa de asigurari de sanatate'] = $health_companies[$person['HealthCompanyID']];
            $excel[$i]['Invaliditate'] = '';
            $excel[$i]['Grupa CAS'] = '';
            $excel[$i]['Functie'] = $person['Function'];
            $excel[$i]['Durata contractului de munca'] = $contract_types[$person['ContractType']];
            $excel[$i]['Tipul contractului de munca'] = 'Contract Individual de Munca';
            $excel[$i]['Norma zilnica'] = $person['WorkNorm'];
            $excel[$i]['Salariul tarifar brut'] = $person['Salary'];
            $excel[$i]['Mod calcul salariu'] = '';
            $excel[$i]['Salariu agreat RON'] = $person['SalaryNet'];
            $excel[$i]['Curs valutar'] = '';
        }
        // -- ENDOF EXCEL EXPORT BUILD

        $report_file = 'report_152.tpl';
        break;

    case 153:
        $persons = Reports::getReports_153();
        $self = Company::getSelfCompanies();

        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'divisions' => Utils::getDivisions(),
            'persons' => $persons,
            'quality' => ConfigData::$msQuality,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_153.tpl';
        break;

    case 154:
        $persons = Reports::getReports_154();

        if (!empty($_GET['generate'])) {
            require('cron/pontaj_month.php');

            header("Location: " . Config::SRV_URL . "?m=reports&rep=134&GroupID=" . (int)$_GET['GroupID'] . "&CompanyID=" . (int)$_GET['CompanyID'] . "&Year=" . (int)$_GET['Year'] . "&DivisionID=" . (int)$_GET['DivisionID'] . "&DepartmentID=" . (int)$_GET['DepartmentID'] . "&success=1");
            exit;
        }

        $smarty->assign(array(
            'self' => $self,
            'departments' => Utils::getDepartments(),
            'divisions' => Utils::getDivisions(),
            'years' => range(2012, date('Y') + 1),
            'persons' => $persons,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_154.tpl';
        break;

    case 155:
        if (!@in_array(155, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_155();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie', 'sort' => true);
            $fields['names'][] = array("name" => 'Salary', "label" => 'Salariu Brut', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'LeftCO', "label" => 'CO Ramas (zile)', 'sort' => false, 'align' => 'center');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }
        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'divisions' => Utils::getDivisions(),
            'persons' => Person::getPersonsList(),
            'years' => range(2012, date('Y') + 1),
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        $report_file = 'report_155.tpl';
        break;

    case 156:
        if (!@in_array(156, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $reportID = 156;
        $persons = Reports::getReports_156();

        $StartDate = (int)$_GET['Year'] . '-01-01';
        $EndDate = (int)$_GET['Year'] . '-12-31';
        $arr_month = Utils::getMonthArray($StartDate, $EndDate);

//---
        $fields_final = $fields = array();
        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Department', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'Divizie', 'sort' => true);
            $fields['names'][] = array("name" => 'PrevTotalCO', "label" => 'Disponibil la sfarsitul ' . ($_GET['Year'] - 1), 'sort' => true);
            $fields['names'][] = array("name" => 'CurrTotalCORef', "label" => 'Cuvenite in ' . $_GET['Year'], 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'CurrTotalCO', "label" => 'Disponibil la inceputul ' . $_GET['Year'], 'sort' => false, 'align' => 'center');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }
        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'status' => Person::$msStatus,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'departments' => Utils::getDepartments(),
            'subdepartments' => Utils::getSubDepartments(),
            'months' => $arr_month,
            'years' => range(date('Y') - 3, date('Y')),
            'personalise' => true,
            'persons' => $persons,
            'request_uri' => "./?m=reports&rep=156&Year={$_GET['Year']}",
        ));
        $report_file = 'report_156.tpl';
        break;
    case 159: // raport CEB
        if (!@in_array(159, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }

        $persons = Reports::getReports_159();
        $status = Person::$msTicketingStatus;
        $contract_type = PayRoll::$msContractType;
        $self = Company::getSelfCompanies();
        $departments = Utils::getDepartments();
        $subdepartments = Utils::getSubDepartments();
        $divisions = Utils::getDivisions();

        $fields_final = $fields = array();

        $fields = Utils::getReportPersonalization($reportID);// de aici ia numarul de coloane si ordinea lor
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'JobTitle', "label" => 'Position', 'sort' => true);
            $fields['names'][] = array("name" => 'JobDescription', "label" => 'Job description', 'sort' => 'asc');
            $fields['names'][] = array("name" => 'StartDate', "label" => 'Requiring date', 'sort' => true);
            $fields['names'][] = array("name" => 'DataStop', "label" => 'Closing date', 'sort' => true);
            $fields['names'][] = array("name" => 'DaysGone', "label" => 'Days gone', 'sort' => true);
            $fields['names'][] = array("name" => 'status', "label" => 'Job Status', 'sort' => true);
            $fields['names'][] = array("name" => 'FullName', "label" => 'Recruiter', 'sort' => true);
            $fields['names'][] = array("name" => 'CompanyName', "label" => 'Company', 'sort' => true);
            $fields['names'][] = array("name" => 'Department', "label" => 'Departament', 'sort' => true);
            $fields['names'][] = array("name" => 'RecruitmentStrategy', "label" => 'Type of Recruitment Process', 'sort' => true);
            $fields['names'][] = array("name" => 'JobType', "label" => 'Employment Type', 'sort' => true);
            $fields['names'][] = array("name" => 'Status', "label" => 'Recruitment process status', 'sort' => true);
        }


        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }

        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $default = (isset($fields['names'][$v['field_id']]['default'])) ? $fields['names'][$v['field_id']]['default'] : false;
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = (empty($data[$col]) && $default !== false) ? $default : $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }
        // echo "<pre>"; print_r($fields); echo "</pre>";
        $smarty->assign(array(
            'persons' => $persons,
            'leavereason' => Person::$msSubStatus[6], //PayRoll::$msLeaveReason,
            'status' => $status,
            'health_companies' => $health_companies,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'personalise' => true,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
            'JobType' => ConfigData::$msJobType,
        ));
        $report_file = 'report_159.tpl';

        $smarty->assign(array(
            'status' => $status,
            //'substatus'        => Person::$msSubStatus,
            'contract_type' => $contract_type,
            'self' => $self,
            'departments' => $departments,
            'subdepartments' => $subdepartments,
            'divisions' => $divisions,
            'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : (isset($_GET['page']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&page=')) : $_SERVER['REQUEST_URI']),
        ));
        break;

    case 160:
        if (!@in_array(160, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $reportID = 160;
        $persons = Reports::getReports_160();

        unset(Person::$msStatus[1]);
        unset(Person::$msStatus[8]);

        $StartDate = (int)$_GET['Year'] . '-01-01';
        $EndDate = (int)$_GET['Year'] . '-12-31';
        $arr_month = Utils::getMonthArrayShortFormat($StartDate, $EndDate);

        $fields_final = $fields = array();
        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume, prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'SalBrut', "label" => 'SAL BRUT', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'CostCenter', "label" => 'Centru de cost', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'divizia', 'sort' => true);
            $fields['names'][] = array("name" => 'PrevTotalCO', "label" => 'Rest dec an trecut', 'sort' => false, 'align' => 'center');
            $fields['names'][] = array("name" => 'CurrTotalCORef', "label" => 'CO conform CIM', 'sort' => false, 'align' => 'center');
            $fields['names'][] = array("name" => 'CurrTotalCO', "label" => 'CO efectiv an curent', 'sort' => false, 'align' => 'center');
            $fields['names'][] = array("name" => 'RestTotalCO', "label" => 'Rest an curent', 'sort' => false, 'align' => 'center');
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }
        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'status' => Person::$msStatus,
            'months' => $arr_month,
            'years' => range(date('Y') - 3, date('Y')),
            'personalise' => true,
            'persons' => $persons,
            'request_uri' => "./?m=reports&rep=160&Year={$_GET['Year']}",
        ));
        $report_file = 'report_160.tpl';
        break;

    case 161:
        if (!@in_array(161, $_SESSION['REPORT_RIGHTS'][7]) && $_SESSION['USER_ID'] != 1) {
            header('Location: ./?m=reports');
            exit;
        }
        $reportID = 161;
        $lstReturn = Reports::getReports_161();
        $nr_lucratoare = $lstReturn[0];
        $persons = $lstReturn[1];

        $Year = (int)$_GET['Year'];
        $Month = (int)$_GET['Month'];

        $fields_final = $fields = array();
        $fields = Utils::getReportPersonalization($reportID);
        if (empty($fields['names'])) {
            $fields['names'][] = array("name" => 'Sex', "label" => 'Sex', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'FullName', "label" => 'Nume, prenume', 'sort' => true);
            $fields['names'][] = array("name" => 'CNP', "label" => 'CNP', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'SalBrut', "label" => 'Salariu de baza brut', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'WorkNorm', "label" => 'Norma zilnica', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'UM', "label" => 'UM', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'TarifarNet', "label" => 'Tarifar Net', 'sort' => true, 'align' => 'center');
            $fields['names'][] = array("name" => 'Sediu', "label" => 'Sediu', 'sort' => true);
            $fields['names'][] = array("name" => 'Division', "label" => 'divizia', 'sort' => true);
        }

        if (empty($fields['order'])) {
            for ($i = 0; $i < count($fields['names']); $i++) {
                $fields['order'][$i] = array('field_id' => $i, 'visible' => true, 'position' => $i + 1);
            }
        }
        if (!empty($persons))
            foreach ($persons as $i => $data) {
                foreach ($fields['order'] as $v) {
                    $k = $fields['names'][$v['field_id']]['name'];
                    $col = (!empty($fields['names'][$v['field_id']]['column'])) ? $fields['names'][$v['field_id']]['column'] : $fields['names'][$v['field_id']]['name'];
                    $fields['data'][$i][$k] = $data[$col];
                }
            }

        $_SESSION['report_fields_names'][$reportID] = $fields['names'];
        if (empty($_SESSION['report_fields_order'][$reportID]))
            $_SESSION['report_fields_order'][$reportID] = $fields['order'];

        foreach ($_SESSION['report_fields_order'][$reportID] as $k => $v) {
            if ($v['visible'])
                $fields_final[] = $fields['names'][$v['field_id']];
        }

        $smarty->assign(array(
            'fields_data' => $fields['data'],
            'fields' => $fields_final,
            'self' => Company::getSelfCompanies(),
            'divisions' => Utils::getDivisions(),
            'years' => range(date('Y') - 3, date('Y')),
            'legal' => ConfigData::$msLegal,
            'personalise' => true,
            'persons' => $persons,
            'nr_lucratoare' => $nr_lucratoare,
            'CurrYear' => $Year,
            'cal' => $cal,
            'request_uri' => "./?m=reports&rep=161&Year={$_GET['Year']}&Month={$_GET['Month']}",
        ));
        $report_file = 'report_161.tpl';
        break;
}

if (!empty($_GET['export'])) {
    if ($_GET['rep'] == 30 || $_GET['rep'] == 35 || $_GET['rep'] == 42 || $_GET['rep'] == 46 || $_GET['rep'] == 58 || $_GET['rep'] == 60 || $_GET['rep'] == 61 || $_GET['rep'] == 62 || $_GET['rep'] == 83 || $_GET['rep'] == 86 || $_GET['rep'] == 87 || $_GET['rep'] == 88 || $_GET['rep'] == 89
        || $_GET['rep'] == 90 || $_GET['rep'] == 91 || $_GET['rep'] == 92 || $_GET['rep'] == 93 || $_GET['rep'] == 94 || $_GET['rep'] == 95 || $_GET['rep'] == 96 || $_GET['rep'] == 97 || $_GET['rep'] == 98
        || $_GET['rep'] == 113 || $_GET['rep'] == 114 || $_GET['rep'] == 115 || $_GET['rep'] == 116 || $_GET['rep'] == 117 || $_GET['rep'] == 118 || $_GET['rep'] == 119 || $_GET['rep'] == 120 || $_GET['rep'] == 123
        || $_GET['rep'] == 124 || $_GET['rep'] == 125 || $_GET['rep'] == 126 || $_GET['rep'] == 127 || $_GET['rep'] == 155 || $_GET['rep'] == 156 || $_GET['rep'] == 158 || $_GET['rep'] == 160 || $_GET['rep'] == 161) {
        header("Content-Type: application/vnd.ms-excel");
        header("Expires: 0");
        header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
        header("content-disposition: attachment;filename=Raport_" . $_GET['rep'] . ".xls");
        $content = $smarty->fetch('report_' . $_GET['rep'] . '.tpl');
        $content = preg_replace("/<img[^>]+\>/i", "", $content);
        echo $content;
        exit;
    } else {
        include("libs/xlsStream.php");
        export_file($excel, 'Raport_' . $_GET['rep']);
    }
}
if (!empty($_GET['export_doc'])) {
    header("Content-Type: application/vnd.ms-word");
    header("Expires: 0");
    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
    header("content-disposition: attachment;filename=raport_" . $_GET['rep'] . ".doc");

    $content = $smarty->fetch('report_' . $_GET['rep'] . '.tpl');
    //$content=preg_replace("/<img[^>]+\>/i", "", $content);
    echo $content;
    exit;
}
if (!isset($_GET['o']))
    $_GET['o'] = NULL;
if ($_GET['o'] == 'personalisedlist') {

    //$_SESSION['report_fields_order'][$_GET['rep']]='';

    //Utils::pa($_POST);
    // Show/ hide columns
    if (!empty($_POST['field_visible'])) {
        foreach ($_SESSION['report_fields_order'][$_GET['rep']] as $k => $v) {
            if (array_key_exists($k, $_POST['field_visible']))
                $_SESSION['report_fields_order'][$_GET['rep']][$k]['visible'] = 1;
            else
                $_SESSION['report_fields_order'][$_GET['rep']][$k]['visible'] = 0;
        }
        //$_SESSION['report_fields_order'][$_GET['rep']] = $list_fields_order;
    }

    // Reorder the columns
    if ($_GET['field_id'] != '' && $_GET['move'] != '' && $_GET['curr_pos'] != '') {
        if ($_GET['next_field_id'] != '') {
            $_SESSION['report_fields_order'][$_GET['rep']][$_GET['next_field_id']]['position'] = $_GET['curr_pos'];
            $_SESSION['report_fields_order'][$_GET['rep']][$_GET['field_id']]['position'] = $_GET['move'];
        }
        if ($_GET['prev_field_id'] != '') {
            $_SESSION['report_fields_order'][$_GET['rep']][$_GET['prev_field_id']]['position'] = $_GET['curr_pos'];
            $_SESSION['report_fields_order'][$_GET['rep']][$_GET['field_id']]['position'] = $_GET['move'];
        }
    }

    foreach ($_SESSION['report_fields_order'][$_GET['rep']] as $key => $row) {
        $position[$key] = $row['position'];
    }

    // Sort the data with volume descending, edition ascending
    // Add $data as the last parameter, to sort by the common key
    array_multisort($position, SORT_ASC, $_SESSION['report_fields_order'][$_GET['rep']]);

    $settings['order'] = $_SESSION['report_fields_order'][$_GET['rep']];

    if (!empty($settings)) {
        Utils::setReportPersonalization($_GET['rep'], $settings);
    }


    $smarty->assign(array(
        'jquery' => 1,
        'list_fields_names' => $_SESSION['report_fields_names'][$_GET['rep']],
        'list_fields_order' => $_SESSION['report_fields_order'][$_GET['rep']]
    ));

    $content = $smarty->fetch('reports_personalisedlist.tpl');
    echo $content;
    exit;
}

if ($_GET['o'] == 'personalisedfilters') {
    // Show/ hide filters
    if (isset($_POST['saveFilters']) && ($_POST['saveFilters'] == 'save')) {
        foreach ($_SESSION['report_filters_visibility'][$_GET['rep']] as $k => $v) {
            if (array_key_exists($k, $_POST['field_visible']) || ($_SESSION['report_filters_names'][$_GET['rep']][$k]['mandatory'] == true))
                $_SESSION['report_filters_visibility'][$_GET['rep']][$k]['visible'] = 1;
            else
                $_SESSION['report_filters_visibility'][$_GET['rep']][$k]['visible'] = 0;
        }

        $settings['visibility'] = $_SESSION['report_filters_visibility'][$_GET['rep']];

        if (!empty($settings)) {
            Utils::setReportFiltersPersonalization($_GET['rep'], $settings);
        }
    }

    $smarty->assign(array(
            'jquery' => 1,
            'list_filters_names' => $_SESSION['report_filters_names'][$_GET['rep']],
            'list_filters_visibility' => $_SESSION['report_filters_visibility'][$_GET['rep']]
        )
    );

    $content = $smarty->fetch('reports_personalisedfilters.tpl');
    echo $content;
    exit;
}
if (!isset($report_file))
    $report_file = NULL;
$smarty->assign(array(
    'groups' => Utils::getReportGroups(),
    'reports' => $reports,
    'report_file' => $report_file,
));

$center_file = 'reports.tpl';

?>