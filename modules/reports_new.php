<?php

$step = !empty($_GET['step']) ? $_GET['step'] : 1;

switch ($step) {

    default:
    case 1:

        $criteria_values = array();
        $criteria_values['Personal']['Status'] = Person::$msStatus;
        $criteria_values['Personal']['SubStatus'] = array();
        $criteria_values['Personal']['Sex'] = array('M' => 'M', 'F' => 'F');
        $criteria_values['Personal']['MaritalStatus'] = Person::$msMaritalStatus;
        $criteria_values['Personal']['d.DistrictID'] = Address::getDistricts();
        $criteria_values['Personal']['d.CityID'] = array();
        $criteria_values['Personal']['JobDictionaryID'] = Job::getJobsTitle();
        $criteria_values['Personal']['Studies'] = Person::$msStudies;
        $criteria_values['Personal']['DepartmentID'] = Utils::getDepartments();
        $criteria_values['Personal']['CostCenterID'] = Utils::getCostCenter();
        $criteria_values['Personal']['FunctionID'] = Utils::getFunctions();
        foreach ($criteria_values['Personal']['FunctionID'] as $k => $v) {
            $criteria_values['Personal']['FunctionID'][$k] = $v['Function'] . ' - ' . $v['COR'];
        }
        $criteria_values['Personal']['SiteID'] = Utils::getSites();

        $smarty->assign(array(
            'criteria' => ReportBuilder::$sCriteria,
            'criteria_values' => $criteria_values,
        ));

        $center_file = 'reports_new_1.tpl';

        break;

    case 2:

        foreach ($_POST['value'] as $k => $v) {
            foreach ($v as $kk => $vv) {
                if (empty($vv)) {
                    unset($_POST['value'][$k][$kk]);
                }
            }
        }

        $center_file = 'reports_new_2.tpl';

        break;

    case 3:

        $cond = '';
        foreach ($_POST['criteria'] as $k => $v) {
            $cond .= $_POST['paranthesisl'][$k] . $v . $_POST['paranthesisr'][$k];
            if (!empty($_POST['operator'][$k])) {
                $cond .= ' ' . $_POST['operator'][$k] . ' ';
            }
        }

        $smarty->assign(array('cond' => $cond));

        $center_file = 'reports_new_3.tpl';

        break;

    case 4:

        ReportBuilder::saveReport($type, $_POST['cond'], $_POST['report']);

        header('Location: ./?m=reports&o=myreport');
        exit;

        break;

}

?>