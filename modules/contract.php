<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $contract = new Contract();
                $ContractID = $contract->addContract($_POST);

                header('Location: ./?m=contract&o=edit&ContractID=' . $ContractID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'contract_types' => Contract::getTypes(),
            'self' => Company::getSelfCompanies(),
            'partners' => Company::getCompanies(),
            'usedPartners' => Company::getUsedCompanies(),

            'status' => Contract::$msContractStatus,
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : array(),
        ));

        $center_file = 'contract_new.tpl';

        break;

    case 'edit':

        $ContractID = (int)$_GET['ContractID'];
        $contract = new Contract($ContractID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $contract->editContract($_POST);

                header('Location: ./?m=contract&o=edit&ContractID=' . $ContractID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $info = !empty($_POST) ? Utils::displayInfo($_POST) : $contract->getContract();

        $smarty->assign(array(
            'coins' => Contract::$msCurrencies,
            'contract_types' => Contract::getTypes(),
            'self' => Company::getSelfCompanies(),
            'partners' => Company::getCompanies(),
            'usedParteners' => Company::getUsedCompanies(),
            'status' => Contract::$msContractStatus,
            'MAX_RESP_CONTR' => Contract::MAX_RESP_CONTR,
            'MAX_RESP_TECH_CONTR' => Contract::MAX_RESP_TECH_CONTR,
            'persons' => $contract->getPersons(),
            'contract_persons' => $contract->getContractPersons(),
            'contract_technical_persons' => $contract->getContractTechnicalPersons(),
            'contracts_financiar_persons' => $contract->getContractsFinanciarPersons(),

            'contacts' => $contract->getPartnerContacts($info['PartnerID']),
            'contact_persons' => $contract->getContactPersons(),
            'actead' => $contract->getActead(),
            'info' => $info,
        ));

        $center_file = 'contract_new.tpl';

        break;

    case 'del':

        $ContractID = (int)$_GET['ContractID'];
        $contract = new Contract($ContractID);

        try {

            $contract->delContract();

            header('Location: ./?m=contract');
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'finance':

        $ContractID = (int)$_GET['ContractID'];
        $contract = new Contract($ContractID);

        if (!empty($_POST) || !empty($_GET['action'])) {

            try {

                $contract->editContractFinance($_POST);

                header('Location: ./?m=contract&o=finance&ContractID=' . $ContractID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'contract_actead' => $contract->getActead(),
            'payment_type' => Contract::$msPaymentType,
            'tva' => Contract::$msTVA,
            'guarantee_type' => Contract::$msGuaranteeType,
            'lstRate' => $contract->getRate(),
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $contract->getContractFinance(),
        ));

        $center_file = 'contract_finance.tpl';

        break;

    case 'docs':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][21][1][3] > 0)) {
            $center_file = 'contract_menu.tpl';
            return;
        }

        $ContractID = (int)$_GET['ContractID'];
        $doc_dir = 'docscontr/' . md5($ContractID) . '/';

        if (!empty($_GET['action'])) {

            switch ($_GET['action']) {
                case 'new':
                    if (!empty($_POST)) {
                        try {
                            $_POST['FileName'] = $_FILES['FileName']['name'];
                            $library = new ContractLibrary();
                            $library->addDoc($_POST, $_FILES, $doc_dir);
                        } catch (Exception $exp) {
                            $err->setError($exp->getMessage());
                        }
                    }
                    $arr = !empty($_POST) ? Utils::displayInfo($_POST) : array();
                    $smarty->assign(array(
                        'info' => $arr,
                    ));
                    $center_file = 'contract_docs_new.tpl';
                    break;
                case 'edit':
                    $DocID = (int)$_GET['DocID'];
                    $library = new ContractLibrary($DocID);
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
                    $center_file = 'contract_docs_new.tpl';
                    break;
                case 'del':
                    $DocID = (int)$_GET['DocID'];
                    $library = new ContractLibrary($DocID);
                    $info = $library->getDoc();
                    @unlink($info['curr_filename']);
                    $library->delDoc();
                    header('Location: ./?m=contract&o=docs&ContractID=' . $ContractID);
                    exit;
                    break;
            }

        } else {

            $action = !empty($_GET['action2']) ? $_GET['action2'] : 'default';
            $docs = ContractLibrary::getAllDocuments($action);

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
                    export_file($excel, 'contracte');
                    break;
                case 'print_page':
                case 'print_all':
                    $smarty->assign(array(
                        'docs' => $docs,
                        'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                    ));
                    $smarty->display('contract_docs_print.tpl');
                    exit;
                    break;
                default:
                    $smarty->assign(array(
                        'info' => $info,
                        'docs' => $docs,
                        'request_uri' => isset($_GET['order_by']) ? substr($_SERVER['REQUEST_URI'], 0, strpos($_SERVER['REQUEST_URI'], '&order_by=')) : $_SERVER['REQUEST_URI'],
                    ));
                    $center_file = 'contract_docs.tpl';
                    break;
            }
        }

        break;

    case 'offer':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3'][21][1][4] > 0)) {
            $center_file = 'contract_menu.tpl';
            return;
        }

        $ContractID = (int)$_GET['ContractID'];
        $contract = new Contract($ContractID);

        if (!empty($_POST['save'])) {
            $contract->setContractOffers();
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $smarty->assign(array(
            'offers' => $contract->getOffers(),
            'contract_offers' => $contract->getContractOffers(),
        ));

        $center_file = 'contract_offer.tpl';

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][21][1] > 0)) {
            $center_file = 'contract_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $contracts = Contract::getAllContracts($action);
        $personalisedlist = Utils::getPersonalisedList('Contract');

        switch ($action) {
            case 'export':
                unset($contracts[0]);
                $excel = array();
                foreach ($contracts as $k => $contract) {
                    $excel[$k]['Name contract'] = $contract['ContractName'];
                    if (!empty($personalisedlist['Contract'])) {
                        $excel[$k]['Numar contract'] = $contract['ContractNo'];
                        $excel[$k]['Responsabil financiar'] = $contract['FullName'];
                        $excel[$k]['Responsabil tehnic'] = $contract['FullNameTechnical'];
                        $excel[$k]['Tip contract'] = $contract['ContractType'];
                        $excel[$k]['Partener'] = $contract['CompanyName'];
                        $excel[$k]['Data semnare'] = $contract['SignDate'];
                        $excel[$k]['Data inceput'] = $contract['StartDate'];
                        $excel[$k]['Data sfarsit'] = $contract['StopDate'];
                        $excel[$k]['Valoare'] = $contract['ContractValue'];
                        $excel[$k]['Data plata'] = $contract['PayDate'];
                        $excel[$k]['Moneda'] = $contract['Coin'];
                    } else {
                        foreach ($personalisedlist['Contract'] AS $field => $name) {
                            $excel[$k][$name] = $contract[$field];
                        }
                    }


                }
                include("libs/xlsStream.php");
                export_file($excel, 'contracte');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=contracte.doc");
                $smarty->assign(array(
                    'contracts' => $contracts,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('contract_print.tpl');
                exit;
            case 'print_page':
            case 'print_all':
                $smarty->assign(array(
                    'contracts' => $contracts,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('contract_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=contract&ContractTypeID={$_GET['ContractTypeID']}&PartnerID={$_GET['PartnerID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=contract";
                $smarty->assign(array(
                    'contracts' => $contracts,
                    'contract_types' => Contract::getTypes(),
                    'self' => Company::getSelfCompanies(),
                    'partners' => Company::getCompanies(),
                    'usedPartners' => Company::getUsedCompanies(),
                    'contracts_technical_persons' => Contract::getContractsTechnicalPersons(),
                    'contracts_financiar_persons' => Contract::getContractsFinanciarPersons(),

                    'coins' => Contract::$msCurrencies,
                    'payment_type' => Contract::$msPaymentType,
                    'status' => Contract::$msContractStatus,
                    'request_uri' => !empty($_GET['res_per_page']) ? "./?m=contract&ContractTypeID={$_GET['ContractTypeID']}&PartnerID={$_GET['PartnerID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=contract",
                    'personalisedlist' => $personalisedlist,
                    'request_uri' => $request_uri,
                ));
                # Pagination
                $pagination = Utils::paginate($contracts[0]['pageNo'], $contracts[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'contract.tpl';
                break;
        }

        break;
}

?>