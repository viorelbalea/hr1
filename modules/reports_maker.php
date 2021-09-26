<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            if (!empty($_POST['view'])) {

                $smarty->assign(array(
                    'fields_values' => ReportMaker::getFieldsValues(),
                    'results' => ReportMaker::getResults(),
                ));
            }

            if (!empty($_POST['save'])) {
                ReportMaker::saveReport($cond);
                header('Location: ./?m=reports_maker&o=myreports');
                exit;
            }

            if (!empty($_POST['generate'])) {

                $_SESSION['REPORT_MAKER']['FIELDS'] = $_POST['Fields'];

                $smarty->assign(array(
                    'fields_values' => ReportMaker::getFieldsValues(),
                ));
            }

        } else {

            if (!empty($_GET['action'])) {
                switch ($_GET['action']) {
                    case 'remake':
                        break;
                }
            } else {
                if (isset($_SESSION['REPORT_MAKER'])) {
                    unset($_SESSION['REPORT_MAKER']);
                }
            }
        }

        $smarty->assign(array(
            'categories' => ReportMaker::$msCategories,
            'fields' => ReportMaker::$msFields,
        ));
        $center_file = 'reports_maker_new.tpl';

        break;

    case 'myreports':

        if (isset($_GET['ReportID'])) {
            $ReportID = (int)$_GET['ReportID'];
            $results = ReportMaker::getReport($ReportID);
            $smarty->assign(array(
                'results' => $results,
                'fields' => ReportMaker::$msFields,
                'fields_values' => ReportMaker::getFieldsValues(),
            ));
        }

        $smarty->assign(array(
            'reports' => ReportMaker::getReports(),
        ));
        $center_file = 'reports_maker_myreports.tpl';

        break;

    default:

        $center_file = 'reports_maker.tpl';

        break;

}

?>