<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

$reports = ReportBuilder::getReports();

$smarty->assign(array(
    'reports' => $reports,
    'persons' => !empty($_GET['rep']) ? ReportBuilder::getReport($_GET['rep']) : array(),
));

$center_file = 'reports_myreport.tpl';

?>