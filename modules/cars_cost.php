<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    default:
    case 'cost':

        if (isset($_GET['ID'])) {

            try {

                if (!empty($_GET['save'])) {
                    if ($_SESSION['USER_ID'] != 1 && $_SESSION['USER_RIGHTS3'][35][1][1] < 2) {
                        $info = Car::getCost((int)$_GET['ID']);
                        $smarty->assign(array(
                            'info' => $info,
                        ));
                        throw new Exception('Nu aveti dreptul sa modificati');
                    }
                    $ID = 0;
                    $add_others = false;
                    $retmsg = Car::setCost();
                    if (!empty($retmsg)) {
                        $info = $_GET;
                        $smarty->assign(array(
                            'info' => $info,
                        ));
                        throw new Exception($retmsg);
                    } else {
                        if ($_GET['ID'] > 0) {
                            $info = Car::getCost((int)$_GET['ID']);
                            $smarty->assign(array(
                                'info' => $info,
                            ));
                        } elseif (!empty($add_others)) {
                            header('Location: ./?m=cars_cost&o=cost&ID=' . $ID . '&costtype=' . $_GET['costtype'] . '&rnd=' . time());
                            exit;
                        }
                    }

                } else {

                    if ($_GET['ID'] > 0) {
                        $info = Car::getCost((int)$_GET['ID']);
                        $smarty->assign(array(
                            'info' => $info,
                        ));
                    }
                }

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            if ($_GET['costtype'] == 'assurance') {
                $info['CostGroupID'] = 1;
            }


            $smarty->assign_by_ref('err', $err);
            $smarty->assign(array(
                'costtype' => $_GET['costtype'],
                'brands' => ConfigData::$msBrands,
                'coins' => ConfigData::$msCurrencies,
                'cars' => Car::getCars(),
                'costtypes' => Car::getCostTypeDictionary(),
                'costgroups' => ConfigData::$msCostGroups,
                'users' => Car::getUsers(),
                'companies' => Company::getAutoFurnizorCompanies(),
                'costtypes_dictionary' => Car::getCostType($info['CostGroupID']),
                'vat_types' => ConfigData::$msVatValues,
            ));
            $smarty->display('car_cost_new.tpl');
            exit;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $costs = Car::getCosts($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.xls");
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'coins' => ConfigData::$msCurrencies,
                    'costgroups' => ConfigData::$msCostGroups,
                    'personalisedlist' => Utils::getPersonalisedList('CarCost'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_cost_print.tpl');
                exit;
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=cheltuieli_auto.doc");
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'coins' => ConfigData::$msCurrencies,
                    'costgroups' => ConfigData::$msCostGroups,
                    'personalisedlist' => Utils::getPersonalisedList('CarCost'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_cost_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'brands' => Car::$msBrands,
                    'coins' => ConfigData::$msCurrencies,
                    'costgroups' => ConfigData::$msCostGroups,
                    'personalisedlist' => Utils::getPersonalisedList('CarCost'),
                    'request_uri' => $request_uri,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    'costs' => $costs,
                ));
                $smarty->display('car_cost_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=cars_cost&o=cost&CarID={$_GET['CarID']}&CostTypeID={$_GET['CostTypeID']}&CompanyID={$_GET['CompanyID']}&res_per_page={$_GET['res_per_page']}" : "./?m=cars_cost&o=cost";
                $cost_group = (!empty($_GET['CostGroupID']) ? (int)$_GET["CostGroupID"] : 0);
                $smarty->assign(array(
                    'rw' => $_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][35][1][1] > 1 ? 1 : 0,
                    'brands' => Car::$msBrands,
                    'coins' => ConfigData::$msCurrencies,
                    'cars' => Car::getCars(),
                    'costtypedictionary' => Car::getCostTypeDictionary($cost_group),
                    'costgroups' => ConfigData::$msCostGroups,
                    'users' => Car::getUsers(),
                    'companies' => Company::getAssuranceCompanies(),
                    'personalisedlist' => Utils::getPersonalisedList('CarCost'),
                    'request_uri' => $request_uri,
                    'costs' => $costs,
                ));
                $pagination = Utils::paginate($costs[0]['pageNo'], $costs[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'car_cost.tpl';
                break;
        }

        break;

}

?>