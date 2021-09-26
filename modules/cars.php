<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $car = new Car();
                $CarID = $car->addCar($_POST);

                echo "<body onload=\"window.location.href = './?m=cars&o=edit&CarID={$CarID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign('info', Utils::displayInfo($_POST));
        }

        $smarty->assign(array(
            'cartypes' => Car::$msCarTypes,
            'brands' => Car::$msBrands,
            'fuels' => Car::$msFuels,
            'gears' => Car::$msGears,
            'doors' => Car::$msDoorsNo,
            'options' => Car::$msOptions,
        ));

        $center_file = 'car_new.tpl';

        break;

    case 'edit':

        $CarID = (int)$_GET['CarID'];
        $car = new Car($CarID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $car->editCar($_POST);

                echo "<body onload=\"window.location.href = './?m=cars&o=edit&CarID={$CarID}&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'cartypes' => Car::$msCarTypes,
            'brands' => Car::$msBrands,
            'fuels' => Car::$msFuels,
            'gears' => Car::$msGears,
            'doors' => Car::$msDoorsNo,
            'options' => Car::$msOptions,
            'resp' => $car->getResp(),
            'persons' => Car::getUsers(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $car->getCar(),
        ));

        $center_file = 'car_new.tpl';

        break;

    case 'del':

        $CarID = (int)$_GET['CarID'];
        $car = new Car($CarID);
        $car->delCar();

        echo "<body onload=\"window.location.href = './?m=cars'\"></body>";
        exit;

        break;

    case 'financial':

        $CarID = (int)$_GET['CarID'];
        $car = new Car($CarID);

        if (!empty($_POST)) {

            try {

                $car->setFinancial();

                echo "<body onload=\"window.location.href = './?m=cars&o=financial&CarID={$CarID}'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'rw' => $_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][27][1][2] == 2 ? 1 : 0,
            'contracts' => Car::getContractsByComodat(),
            'financial' => $car->getFinancial(),
        ));

        $center_file = 'car_financial.tpl';

        break;

    case 'assurance':

        $CarID = (int)$_GET['CarID'];
        $car = new Car($CarID);

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $costs = $car->getCostsByAssurance($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.xls");
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeByAssurance(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.doc");
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeByAssurance(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeByAssurance(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=cars&o=assurance&CarID={$_GET['CarID']}&CostTypeID={$_GET['CostTypeID']}&res_per_page={$_GET['res_per_page']}" : "./?m=cars&o=assurance&CarID={$_GET['CarID']}";
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeByAssurance(),
                    'users' => Car::getUsers(),
                    'companies' => Company::getAssuranceCompanies(),
                    'request_uri' => $request_uri,
                    'costs' => $costs,
                ));
                $pagination = Utils::paginate($costs[0]['pageNo'], $costs[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'car_assurance.tpl';
                break;
        }

        break;

    case 'pcheckups':
        try {
            $CarID = (int)$_GET['CarID'];
            $car = new Car($CarID);

            if (isset($_GET['ID'])) {
                $retmsg = $car->setPCheckup();
                if (!empty($retmsg)) {
                    throw new Exception($retmsg);
                }
                header("Location: ./?m=cars&o=pcheckups&CarID={$CarID}");
            }


        } catch (Exception $exp) {
            $err->setError($exp->getMessage());
        }
        $info = $car->getPCheckups();
        $smarty->assign(array(
            'info' => $info,
            'request_uri' => $request_uri,
            'rw' => ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][27][1][6] > 1) ? 1 : 0,
        ));
        $center_file = 'car_pcheckups.tpl';
        break;

    case 'checkups':

        if (isset($_GET['ID'])) {
            $info = Car::getCheckup((int)$_GET['ID']);

            $smarty->assign(array(
                'coins' => ConfigData::$msCurrencies,
                'info' => $info,
                'request_uri' => $request_uri,
                'brands' => ConfigData::$msBrands,
                'costgroups' => ConfigData::$msCostGroups,
            ));
            $smarty->display('car_checkups_detail.tpl');
            exit;
        }

        $CarID = (int)$_GET['CarID'];
        $car = new Car($CarID);

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $costs = $car->getCheckups($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.xls");
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeDictionary(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.doc");
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeDictionary(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeDictionary(),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_assurance_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=cars&o=checkups&CarID={$_GET['CarID']}&CostTypeID={$_GET['CostTypeID']}&res_per_page={$_GET['res_per_page']}" : "./?m=cars&o=checkups&CarID={$_GET['CarID']}";
                $smarty->assign(array(
                    'coins' => ConfigData::$msCurrencies,
                    'costtype' => Car::getCostTypeDictionary(),
                    'users' => Car::getUsers(),
                    'request_uri' => $request_uri,
                    'costs' => $costs,
                ));
                $pagination = Utils::paginate($costs[0]['pageNo'], $costs[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'car_checkups.tpl';
                break;
        }

        break;

    case 'docs':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][27][1][4] > 0)) {
            $center_file = 'car_menu.tpl';
            return;
        }

        $CarID = (int)$_GET['CarID'];
        $doc_dir = 'docscar/' . md5($CarID) . '/';

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {
                case 'new':
                    if (!empty($_POST)) {
                        try {
                            $_POST['FileName'] = $_FILES['FileName']['name'];
                            $library = new CarLibrary();
                            $library->addDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : array();
                    $smarty->assign(array(
                        'info' => $arr,
                    ));
                    $center_file = 'car_docs_new.tpl';
                    break;
                case 'edit':
                    $DocID = (int)$_GET['DocID'];
                    $library = new CarLibrary($DocID);
                    if (!empty($_POST)) {
                        try {
                            $library->editDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : $library->getDoc();
                    $smarty->assign(array(
                        'info' => $arr,
                    ));
                    $center_file = 'car_docs_new.tpl';
                    break;
                case 'del':
                    $DocID = (int)$_GET['DocID'];
                    $library = new CarLibrary($DocID);
                    $info = $library->getDoc();
                    @unlink($info['curr_filename']);
                    $library->delDoc();
                    header('Location: ./?m=cars&o=docs&CarID=' . $CarID);
                    exit;
                    break;
            }

        } else {

            $action = !empty($_GET['action2']) ? $_GET['action2'] : 'default';
            $docs = CarLibrary::getAllDocuments($action);

            switch ($action) {
                case 'export':
                    unset($docs[0]);
                    $excel = array();
                    foreach ($docs as $k => $doc) {
                        $excel[$k]['Nume document'] = $doc['DocName'];
                        $excel[$k]['Cod document'] = $doc['DocCode'];
                        $excel[$k]['Descriere'] = $doc['DocDescr'];
                        $excel[$k]['Data crearii'] = $doc['data'];
                    }
                    include("libs/xlsStream.php");
                    export_file($excel, 'masinidocs');
                    break;
                case 'print_page':
                case 'print_all':
                    $smarty->assign(array(
                        'docs' => $docs,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('car_docs_print.tpl');
                    exit;
                    break;
                default:
                    $smarty->assign(array(
                        'info' => $info,
                        'docs' => $docs,
                        'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'],
                    ));
                    $center_file = 'car_docs.tpl';
                    break;
            }
        }

        break;

    case 'dictionary':

        if (isset($_GET['ID'])) {

            try {

                Car::setDictionary();

                echo "<body onload=\"window.location.href = './?m=cars&o=dictionary'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

        } elseif (isset($_GET['CostTypeID'])) {

            try {

                Car::setCostTypeDictionary();

                echo "<body onload=\"window.location.href = './?m=cars&o=dictionary'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'rw' => $_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][27][5] == 1 ? 1 : 0,
            'coins' => ConfigData::$msCurrencies,
            'costtype' => Car::getCostTypeDictionary(),
            'dictionary' => Car::getDictionary(),
            'producers' => Car::getProducers(),
            'cost_groups' => ConfigData::$msCostGroups,
            'measurement_units' => Utils::getMeasurementUnits(),
        ));

        $center_file = 'car_dictionary.tpl';

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][27][1] > 0)) {
            $center_file = 'car_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $cars = Car::getAllCars($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=masini.xls");
                $smarty->assign(array(
                    'cartypes' => Car::$msCarTypes,
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'gears' => Car::$msGears,
                    'personalisedlist' => Utils::getPersonalisedList('Car'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'cars' => $cars,
                ));
                $smarty->display('cars_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=masini.doc");
                $smarty->assign(array(
                    'cartypes' => Car::$msCarTypes,
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'gears' => Car::$msGears,
                    'personalisedlist' => Utils::getPersonalisedList('Car'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'cars' => $cars,
                ));
                $smarty->display('cars_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'cartypes' => Car::$msCarTypes,
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'gears' => Car::$msGears,
                    'personalisedlist' => Utils::getPersonalisedList('Car'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'cars' => $cars,
                ));
                $smarty->display('cars_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=cars&CarType={$_GET['CarType']}&Brand={$_GET['Brand']}&Fuel={$_GET['Fuel']}&Gear={$_GET['Gear']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=cars";
                $smarty->assign(array(
                    'cartypes' => Car::$msCarTypes,
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'gears' => Car::$msGears,
                    'personalisedlist' => Utils::getPersonalisedList('Car'),
                    'request_uri' => $request_uri,
                    'cars' => $cars,
                ));
                $pagination = Utils::paginate($cars[0]['pageNo'], $cars[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'cars.tpl';
                break;
        }

        break;
}

?>