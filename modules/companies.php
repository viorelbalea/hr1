<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

switch ($o) {

    case 'new':

        if (!empty($_POST)) {

            try {

                $company = new Company();
                $CompanyID = $company->addCompany($_POST);

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/companies/' . md5($CompanyID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/' . md5($CompanyID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/companies/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                if (!empty($_FILES['photo_header_report']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo_header_report']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo_header_report']['tmp_name'], 'photos/companies/photo_header_report_' . md5($CompanyID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/photo_header_report_' . md5($CompanyID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/companies/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }

            $smarty->assign(array('info' => Utils::displayInfo($_POST),
                'request_uri' => "./?m=companies&CompanyID=$CompanyID"));
        }

        $smarty->assign(array(
            'companydomains' => Job::getJobDomains(),
            'districts' => Address::getDistricts(),
            'jobstitle' => Job::getJobsTitle(),
            'customfields' => Utils::getCustomFields(),
            'situation' => ConfigData::$msCompanySituation,
            'request_uri' => "./?m=companies&CompanyID=$CompanyID",
            'persons' => Person::getAllPersons(),
        ));

        $center_file = 'company_new.tpl';

        break;

    case 'new_contact':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        if (!empty($_GET)) {
            try {

                $company->addCompanyContact($_GET);
                header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
                exit;

            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        break;

    case 'edit':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        if (!empty($_POST)) {

            try {
                if (!empty($_FILES['OGFile']['name'])) {
                    $_POST['OGFile'] = (int)$CompanyID . '.' . pathinfo($_FILES['OGFile']['name'], PATHINFO_EXTENSION);
                    @move_uploaded_file($_FILES['OGFile']['tmp_name'], 'uploads/og/' . $_POST['OGFile']);
                }
                $company->editCompany($_POST);
                //die();

                if (!empty($_FILES['photo']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/companies/' . md5($CompanyID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/' . md5($CompanyID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/companies/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                if (!empty($_FILES['photo_header_report']['name'])) {
                    if (in_array(substr(strtolower($_FILES['photo_header_report']['name']), -4), array('.jpg', '.gif'))) {
                        if (@move_uploaded_file($_FILES['photo_header_report']['tmp_name'], 'photos/companies/photo_header_report_' . md5($CompanyID) . '.jpg')) {
                            $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/companies/photo_header_report_' . md5($CompanyID) . '.jpg', 100, 100);
                            rename('photos/_tmp/' . basename($resized), 'photos/companies/' . basename($resized));
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                        }
                    } else {
                        throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                    }
                }

                header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $info = !empty($_POST) ? Utils::displayInfo($_POST) : $company->getCompany();
        $smarty->assign(array(
            'companydomains' => Job::getJobDomains(),
            'contacts' => $company->getCompanyContacts(),
            'districts' => Address::getDistricts(),
            'cities' => Address::getCities($info['Judet']),
            'jobstitle' => Job::getJobsTitle(),
            'customfields' => Utils::getCustomFields(),
            'situation' => ConfigData::$msCompanySituation,
            'info' => $info,
            'request_uri' => "./?m=companies&CompanyID=$CompanyID",
            'persons' => Person::getAllPersons(),
        ));

        $center_file = 'company_new.tpl';

        break;

    case 'edit_contact':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        if (!empty($_GET)) {

            try {

                $company->editCompanyContact($_GET);
                header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        break;

    case 'activity':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        if (!empty($_POST)) {

            try {

                $company->setCompanyActivity($_POST);
                header('Location: ./?m=companies&o=activity&CompanyID=' . $CompanyID . '&msg=1');
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        if (!empty($_GET['action'])) {
            $company->setCompanyCAENActivity();
            header('Location: ./?m=companies&o=activity&CompanyID=' . $CompanyID);
            exit;
        }

        $smarty->assign(array(
            'info' => !empty($_POST) ? Utils::displayInfo($_POST) : $company->getCompanyActivity(),
            'activities' => $company->getCompanyCAENActivities(),
            'companydomains' => Job::getJobDomains(),
            'training_types' => Training::getTypes(),
        ));

        $center_file = 'company_activity.tpl';

        break;

    case 'del_og_file':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);
        $info = $company->getCompany();


        try {
            $query = "UPDATE companies SET OGFile=NULL WHERE CompanyID = $CompanyID";
            $conn->query($query);

            if (is_file($info['OGFilePath'])) {
                @unlink($info['OGFilePath']);
            }

            header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'other_location':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        if (!empty($_GET['action'])) {
            $company->delCompanyLocation((int)$_GET['ID']);
            header('Location: ./?m=companies&o=other_location&CompanyID=' . $CompanyID);
            exit;
        }

        if (!empty($_POST)) {

            try {

                $company->setCompanyLocation($_POST);
                header('Location: ' . $_SERVER['REQUEST_URI']);
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'districts' => Address::getDistricts(),
            'jobstitle' => Job::getJobsTitle(),
            'locations' => $company->getCompanyLocations(),
        ));

        $center_file = 'company_other_location.tpl';

        break;

    case 'contracts':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        $smarty->assign(array(
            'contracts' => $company->getCompanyContracts(),
        ));

        $center_file = 'company_contracts.tpl';

        break;

    case 'del':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        try {

            $company->delCompany();

            header('Location: ' . (!empty($_GET['back_url']) ? $_GET['back_url'] : './?m=companies'));
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

    case 'del_photo':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        try {

            $company->delCompanyPhoto();

            header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_photo_header_report':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        try {

            $company->delCompanyPhotoHeaderReport();

            header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'del_contact':

        $CompanyID = (int)$_GET['CompanyID'];
        $company = new Company($CompanyID);

        try {

            $company->delCompanyContact($_GET['ContactID']);

            header('Location: ./?m=companies&o=edit&CompanyID=' . $CompanyID);
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }

        break;

    case 'contacts':

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][2][2] > 0)) {
            $center_file = 'companies_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $companies = Company::getAllCompanies($action);

        switch ($action) {
            case 'export':
                header("Content-Type: application/vnd.ms-excel");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=contacte_companii.xls");
                //unset($companies[0]);
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('companies_contacts_print.tpl');
                exit;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=contacte_companii.doc");
                //unset($companies[0]);
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('companies_contacts_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                //unset($companies[0]);
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('companies_contacts_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=companies&o=contacts&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&CompanyDomainID={$_GET['CompanyDomainID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=companies&o=contacts";
                $smarty->assign(array(
                    'companydomains' => Job::getJobDomains(),
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['DistrictID']) ? Address::getCities($_GET['DistrictID']) : Address::getAllCities(),
                    'companies' => $companies,
                    'request_uri' => $request_uri,
                    'personalisedlist' => Utils::getPersonalisedList('Company'),
                ));
                # Pagination
                $pagination = Utils::paginate($companies[0]['pageNo'], $companies[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);

                $center_file = 'companies_contacts.tpl';
                break;
        }

        break;

    default:

        if (!($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS2'][2][1] > 0)) {
            $center_file = 'companies_menu.tpl';
            return;
        }

        $action = !empty($_GET['action']) ? $_GET['action'] : 'default';
        $personalisedlist = Utils::getPersonalisedList('Company');
        $companies = Company::getAllCompanies($action);

        switch ($action) {
            case 'export':
                unset($companies[0]);
                $excel = array();
                foreach ($companies as $k => $companie) {
                    if (empty($personalisedlist['Company'])) {
                        $excel[$k]['Name'] = $companie['CompanyName'];
                        $excel[$k]['Domain'] = $companie['Domain'];
                        $excel[$k]['Judet'] = $companie['DistrictName'];
                        $excel[$k]['Localitate'] = $companie['CityName'];
                        $excel[$k]['CIF'] = $companie['CIF'];
                    } else {
                        $excel[$k]['Name'] = $companie['CompanyName'];
                        foreach ($personalisedlist['Company'] AS $field => $name) {
                            $excel[$k][$name] = $companie[$field];
                        }
                    }
                }
                include("libs/xlsStream.php");
                export_file($excel, 'companii');
                break;
            case 'export_doc':
                header("Content-Type: application/vnd.ms-word");
                header("Expires: 0");
                header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
                header("content-disposition: attachment;filename=companii.doc");
                //unset($companies[0]);
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('companies_print.tpl');
                exit;
                break;
            case 'print_page':
            case 'print_all':
                // unset($companies[0]);
                $smarty->assign(array(
                    'companies' => $companies,
                    'personalisedlist' => $personalisedlist,
                    'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
                ));
                $smarty->display('companies_print.tpl');
                exit;
                break;
            default:
                $request_uri = !empty($_GET['res_per_page']) ? "./?m=companies&DistrictID={$_GET['DistrictID']}&CityID={$_GET['CityID']}&CompanyDomainID={$_GET['CompanyDomainID']}&search_for={$_GET['search_for']}&keyword={$_GET['keyword']}&res_per_page={$_GET['res_per_page']}" : "./?m=companies";
                $smarty->assign(array(
                    'companydomains' => Job::getJobDomains(),
                    'districts' => Address::getDistricts(),
                    'cities' => !empty($_GET['Judet']) ? Address::getCities($_GET['Judet']) : Address::getAllCities(),
                    'companies' => $companies,
                    'request_uri' => $request_uri,
                    'personalisedlist' => $personalisedlist,
                ));
                # Pagination
                if (!isset($_GET['order_by']))
                    $_GET['order_by'] = NULL;
                if (!isset($_GET['asc_or_desc']))
                    $_GET['asc_or_desc'] = NULL;

                $pagination = Utils::paginate($companies[0]['pageNo'], $companies[0]['page'], $request_uri . "&order_by={$_GET['order_by']}&asc_or_desc={$_GET['asc_or_desc']}&page=[pag]", Config::$msResPageGroup);
                $smarty->assign('pagination', $pagination);
                $center_file = 'companies.tpl';
                break;
        }

        break;
}

?>