<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}


switch ($o) {
    case 'organigram':
        if (isset($_GET['mark']))
            $_SESSION['canPrint'] = 0;
        if (isset($_SESSION['oData']))
            unset($_SESSION['oData']);

        if (!isset($_GET['Level']) || $_GET['Level'] < 0)
            $_GET['Level'] = 6;
        $maxDepth = (int)$_GET['Level'];

        $companies = Company::getSelfCompanies();

        if (!isset($_GET['CompanyID']) || empty($_GET['CompanyID']))
            $sel_companies = $companies;
        else {
            $sel_companies = array((int)$_GET['CompanyID'] => $companies[(int)$_GET['CompanyID']]);
        }

        // Get functions tree for any company
        foreach ($sel_companies as $CompanyID => $company) {
            $functions[$CompanyID] = Functions::getAlocatedFunctions($CompanyID);
            $functionsTree[$CompanyID] = Functions::getFunctionsTree($functions[$CompanyID], 0, 0, $maxDepth);
        }

        // Get persons tree for any company
        foreach ($sel_companies as $CompanyID => $company) {
            $persons[$CompanyID] = Functions::getInternalFunctionsPersons($CompanyID);
            $parentID = 0;
            if (isset($_GET['mark']) && $_GET['mark'] > 0)
                $parentID = $_GET['mark'];
            $startID = 0;
            if (isset($_GET['mark3']) && $_GET['mark3'] > 0)
                $startID = $_GET['mark3'];
            $personsTree[$CompanyID] = Functions::getFunctionsPersonsTree($persons[$CompanyID], $parentID, 0, $maxDepth, $startID);
        }

        $smarty->assign(array(
            'functions_tree' => $functionsTree,
            'persons_tree' => $personsTree,
            'companies' => $companies,
            'levels' => array(0, 1, 2, 3, 4, 5)
        ));
        $center_file = 'functions_organigram.tpl';
        break;

    case 'organigram_dir':
        if (isset($_GET['mark']))
            $_SESSION['canPrint'] = 0;
        if (isset($_SESSION['oData']))
            unset($_SESSION['oData']);

        if (!isset($_GET['Level']) || $_GET['Level'] < 0)
            $_GET['Level'] = 6;
        $maxDepth = (int)$_GET['Level'];

        $companies = Company::getSelfCompanies();

        if (!isset($_GET['CompanyID']) || empty($_GET['CompanyID']))
            $sel_companies = $companies;
        else {
            $sel_companies = array((int)$_GET['CompanyID'] => $companies[(int)$_GET['CompanyID']]);
        }

        // Get functions tree for any company
        foreach ($sel_companies as $CompanyID => $company) {
            $functions[$CompanyID] = Functions::getAlocatedFunctions($CompanyID);
            $functionsTree[$CompanyID] = Functions::getFunctionsTree($functions[$CompanyID], 0, 0, $maxDepth);
        }

        // Get persons tree for any company
        foreach ($sel_companies as $CompanyID => $company) {
            $persons[$CompanyID] = Functions::getInternalFunctionsPersons($CompanyID);
            $parentID = 0;
            if (isset($_GET['mark']) && $_GET['mark'] > 0)
                $parentID = $_GET['mark'];
            $startID = 0;
            if (isset($_GET['mark3']) && $_GET['mark3'] > 0)
                $startID = $_GET['mark3'];
            $personsTree[$CompanyID] = Functions::getFunctionsPersonsTree($persons[$CompanyID], $parentID, 0, $maxDepth, $startID);
        }

        $smarty->assign(array(
            'dir_tree' => $functionsTree,
            'persons_tree' => $personsTree,
            'companies' => $companies,
            'levels' => array(0, 1, 2, 3, 4, 5)
        ));
        $center_file = 'functions_organigram_dir.tpl';
        break;

    default:

        if (!empty($_GET['o'])) {

            switch ($_GET['o']) {

                case 'edit':
                    $FunctionCompanyID = (int)$_GET['FunctionCompanyID'];
                    $FunctionID = (int)$_GET['FunctionID'];
                    $function = new Functions($FunctionID);
                    //Utils::pa($_POST);
                    if (!empty($_POST) || $_GET['action'] == 'del') {
                        try {
                            $function->setCompanyFunction($_POST);
                            //header('Location: ./?m=functions&o=edit&FunctionID=' . $FunctionID);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    //$info = !empty($_POST) ? Utils::displayInfo($_POST) : $function->getFunction();
                    $functions = $function->getFunction();
                    $smarty->assign(array(
                        'functions' => $functions,
                        'parent_functions' => Utils::getInternalFunctions(),
                        'educational_levels' => Person::$msEducationalLevel,
                        'companies' => Company::getSelfCompanies(),
                    ));
                    $center_file = 'functions_new.tpl';
                    break;
            }

        } else {

            $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
            $functions = Functions::getInternalFunctionsFull($action);
            $parent_functions = Utils::getInternalFunctions();

            switch ($action) {
                case 'export':
                    /*
                    unset($functions[0]);
                    $excel = array();
                    foreach ($functions as $k => $function) {
                    $excel[$k]['Nume Functie'] 				= $function['Function'];
                    $excel[$k]['Companie']  				= $function['CompanyName'];
                    $excel[$k]['Functie superioara']     	= $parent_functions[$function['ParentFunctionID']];
                    $excel[$k]['Pozitii definite']  		= $function['Positions'];
                    $excel[$k]['Pozitii ocupate']  			= $function['PositionsOccupied'];
                    $excel[$k]['Pozitii libere']  			= $function['PositionsFree'];
                    $excel[$k]['Vechime in companie (ani)'] = $function['CompanyAge'];
                    $excel[$k]['Vechime in functie (ani)']  = $function['TotalAge'];
                    }
                    include("libs/xlsStream.php");
                export_file($excel, 'functii_interne');
                */
                    header("Content-Type: application/vnd.ms-excel");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("content-disposition: attachment;filename=functii_interne.xls");
                    $smarty->assign(array(
                        'functions' => $functions,
                        'parent_functions' => $parent_functions,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('functions_print.tpl');
                    exit;
                    break;
                case 'export_doc':
                    header("Content-Type: application/vnd.ms-word");
                    header("Expires: 0");
                    header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                    header("content-disposition: attachment;filename=functii_interne.doc");
                    //unset($functions[0]);
                    $smarty->assign(array(
                        'functions' => $functions,
                        'parent_functions' => $parent_functions,
                    ));
                    $smarty->display('functions_print.tpl');
                    exit;
                    break;
                case 'print_page':
                case 'print_all':
                    $smarty->assign(array(
                        'functions' => $functions,
                        'parent_functions' => $parent_functions,
                    ));
                    $smarty->display('functions_print.tpl');
                    exit;
                    break;
                default:
                    $request_uri = isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'];
                    $smarty->assign(array(
                        'functions' => $functions,
                        'parent_functions' => $parent_functions,
                        'educational_levels' => Person::$msEducationalLevel,
                        'departments' => Utils::getDepartments(),
                        'companies' => Company::getSelfCompanies(),
                        'request_uri' => $request_uri,
                    ));


                    # Pagination
                    $pagination = Utils::paginate($functions[0]['pageNo'], $functions[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                    $smarty->assign('pagination', $pagination);
                    $center_file = 'functions.tpl';
                    break;
            }
        }

        break;

}
?>