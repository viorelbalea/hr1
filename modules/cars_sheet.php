<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    default:
    case 'sheet':

        if (isset($_GET['SheetID'])) {

            try {

                if (!empty($_GET['save'])) {

                    $retmsg = Car::setSheet();
                    if (!empty($retmsg)) {
                        $smarty->assign(array(
                            'info' => $_GET,
                        ));
                        throw new Exception($retmsg);
                    } else {
                        if ($_GET['SheetID'] > 0) {
                            $smarty->assign(array(
                                'info' => Car::getSheet((int)$_GET['SheetID']),
                            ));
                        }
                    }

                } else {

                    if ($_GET['SheetID'] > 0) {
                        $smarty->assign(array(
                            'info' => Car::getSheet((int)$_GET['SheetID']),
                        ));
                    }
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign_by_ref('err', $err);
            $smarty->assign(array(
                'brands' => Car::$msBrands,
                'scopes' => Car::$msScopes,
                'cars' => Car::getCars(),
                'drivers' => Car::getDrivers(),
                'users' => Car::getUsers(),
                'costcenter' => Utils::getCostCenter(),
            ));
            $smarty->display('car_sheet_new.tpl');
            exit;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $sheets = Car::getSheets($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=foi_parcurs.xls");
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'scopes' => Car::$msScopes,
                    'cars' => Car::getCars(),
                    'drivers' => Car::getDrivers(),
                    'personalisedlist' => Utils::getPersonalisedList('CarSheet'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'sheets' => $sheets,
                ));
                $smarty->display('car_sheet_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=foi_parcurs.doc");
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'scopes' => Car::$msScopes,
                    'cars' => Car::getCars(),
                    'drivers' => Car::getDrivers(),
                    'personalisedlist' => Utils::getPersonalisedList('CarSheet'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'sheets' => $sheets,
                ));
                $smarty->display('car_sheet_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'scopes' => Car::$msScopes,
                    'cars' => Car::getCars(),
                    'drivers' => Car::getDrivers(),
                    'personalisedlist' => Utils::getPersonalisedList('CarSheet'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'sheets' => $sheets,
                ));
                $smarty->display('car_sheet_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=cars_sheet&o=sheet&CarID={$_GET['CarID']}&Fuel={$_GET['Fuel']}&DriverID={$_GET['DriverID']}&Scope={$_GET['Scope']}&res_per_page={$_GET['res_per_page']}" : "./?m=cars_sheet&o=sheet";
                $smarty->assign(array(
                    'rw' => $_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][36][1] == 1 ? 1 : 0,
                    'brands' => Car::$msBrands,
                    'fuels' => Car::$msFuels,
                    'scopes' => Car::$msScopes,
                    'cars' => Car::getCars(),
                    'drivers' => Car::getDrivers(),
                    'personalisedlist' => Utils::getPersonalisedList('CarSheet'),
                    'request_uri' => $request_uri,
                    'sheets' => $sheets,
                ));
                $pagination = Utils::paginate($sheets[0]['pageNo'], $sheets[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'car_sheet.tpl';
                break;
        }

        break;

}

?>