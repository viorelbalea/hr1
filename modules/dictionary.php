<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

$o = !empty($_GET['o']) ? $_GET['o'] : 'default';

if ($_SESSION['USER_ID'] == 1) {
    $rw = 1;
} else {
    if ($o != 'default') {
        foreach (ConfigRights::$msRightsLevel3[20][1] as $k => $v) {
            if ($v['o'] == $o) {
                switch ($_SESSION['USER_RIGHTS3'][20][1][$k]) {
                    case 0:
                        throw new Exception(Message::getMessage('NO_SUCH_DICTIONARY'));
                        break;
                    case 1:
                        $rw = 0;
                        break;
                    case 2:
                        $rw = 1;
                        break;
                }
                break;
            }
        }
    }
}
$smarty->assign('rw', $rw);

switch ($o) {

    case 'sites':

        $SiteID = !empty($_GET['SiteID']) ? (int)$_GET['SiteID'] : 0;

        if (!empty($_GET['Site']) || !empty($_GET['delSite'])) {

            try {
                Utils::setSites($SiteID);
                header('Location: ./?m=dictionary&o=sites');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        if ($SiteID > 0 && (!empty($_GET['Room']) || !empty($_GET['delRoom']))) {

            $RoomID = !empty($_GET['RoomID']) ? (int)$_GET['RoomID'] : 0;

            try {
                Utils::setSiteRooms($SiteID, $RoomID);
                header('Location: ./?m=dictionary&o=sites&SiteID=' . $SiteID);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'sites' => Utils::getSites(),
            'rooms' => !empty($SiteID) ? Utils::getRooms($SiteID) : '',
        ));

        $center_file = 'dictionary_sites.tpl';

        break;

    case 'jobstitle':

        $JobDictionaryID = !empty($_GET['JobDictionaryID']) ? (int)$_GET['JobDictionaryID'] : 0;

        if ((!empty($_GET['JobTitle']) && trim($_GET['JobTitle'])) || !empty($_GET['delJobTitle'])) {
            try {
                Job::newJob($JobDictionaryID);
                header('Location: ./?m=dictionary&o=jobstitle');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'jobstitle' => Job::getJobsTitleAdmin(),
        ));

        $center_file = 'dictionary_jobstitle.tpl';

        break;

    case 'domains':

        $JobDomainID = !empty($_GET['JobDomainID']) ? (int)$_GET['JobDomainID'] : 0;

        if ($JobDomainID > 0 || !empty($_GET['Caen'])) {

            try {
                Job::newDomain($JobDomainID);
                header('Location: ./?m=dictionary&o=domains');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'autocomplete' => true,
            'domains' => Job::getJobDomainsAdmin(),
        ));

        $center_file = 'dictionary_domains.tpl';

        break;

    case 'costcenter':

        $CostCenterID = !empty($_GET['CostCenterID']) ? (int)$_GET['CostCenterID'] : 0;

        if ((!empty($_GET['CostCenter']) && trim($_GET['CostCenter'])) || !empty($_GET['delCostCenter'])) {

            try {
                Utils::newCostCenter($CostCenterID);
                header('Location: ./?m=dictionary&o=costcenter');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'costcenter' => Utils::getCostCenterAdmin(),
        ));

        $center_file = 'dictionary_costcenters.tpl';

        break;

    case 'department':

        $DepartmentID = !empty($_GET['DepartmentID']) ? (int)$_GET['DepartmentID'] : 0;

        if ((!empty($_GET['Department']) && trim($_GET['Department'])) || !empty($_GET['delDepartment'])) {

            try {
                Utils::newDepartment($DepartmentID);
                header('Location: ./?m=dictionary&o=department');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'departments' => Utils::getDepartmentsAdmin(),
            'subdepartments' => Utils::getSubDepartmentsAdmin(),
            'subsubdepartments' => Utils::getSubSubDepartmentsAdmin(),
            'divisions' => Utils::getDivisionsAdmin(),
            'divisions_dep' => Utils::getDivisions(),
        ));

        $center_file = 'dictionary_departments.tpl';

        break;

    case 'subdepartment':

        $SubDepartmentID = !empty($_GET['SubDepartmentID']) ? (int)$_GET['SubDepartmentID'] : 0;

        if ((!empty($_GET['SubDepartment']) && trim($_GET['SubDepartment'])) || !empty($_GET['delSubDepartment'])) {

            try {
                Utils::newSubDepartment($SubDepartmentID);
                header('Location: ./?m=dictionary&o=subdepartment');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'departments' => Utils::getDepartmentsAdmin(),
            'subdepartments' => Utils::getSubDepartmentsAdmin(),
            'subsubdepartments' => Utils::getSubSubDepartmentsAdmin(),
            'divisions' => Utils::getDivisionsAdmin(),
            'divisions_dep' => Utils::getDivisions(),
        ));

        $center_file = 'dictionary_departments.tpl';

        break;

    case 'subsubdepartment':

        $SubDepartmentID = !empty($_GET['SubSubDepartmentID']) ? (int)$_GET['SubSubDepartmentID'] : 0;

        if ((!empty($_GET['SubSubDepartment']) && trim($_GET['SubSubDepartment'])) || !empty($_GET['delSubSubDepartment'])) {

            try {
                Utils::newSubSubDepartment($SubDepartmentID);
                header('Location: ./?m=dictionary&o=subsubdepartment');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'departments' => Utils::getDepartmentsAdmin(),
            'subdepartments' => Utils::getSubDepartmentsAdmin(),
            'subsubdepartments' => Utils::getSubSubDepartmentsAdmin(),
            'divisions' => Utils::getDivisionsAdmin(),
            'divisions_dep' => Utils::getDivisions(),
        ));

        $center_file = 'dictionary_departments.tpl';

        break;

    case 'division':

        $DivisionID = !empty($_GET['DivisionID']) ? (int)$_GET['DivisionID'] : 0;

        if ((!empty($_GET['Division']) && trim($_GET['Division'])) || !empty($_GET['delDivision'])) {

            try {
                Utils::newDivision($DivisionID);
                header('Location: ./?m=dictionary&o=department');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

            $smarty->assign(array(
                'departments' => Utils::getDepartmentsAdmin(),
                'subdepartments' => Utils::getSubDepartmentsAdmin(),
                'subsubdepartments' => Utils::getSubSubDepartmentsAdmin(),
                'divisions' => Utils::getDivisionsAdmin(),
                'divisions_dep' => Utils::getDivisions(),
            ));

            $center_file = 'dictionary_departments.tpl';
        }

        break;

    case 'function':

        $FunctionID = !empty($_GET['FunctionID']) ? (int)$_GET['FunctionID'] : 0;

        if ($FunctionID > 0 || !empty($_GET['Cor'])) {

            try {
                Utils::newFunction($FunctionID);
                header('Location: ./?m=dictionary&o=function');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'autocomplete' => true,
            'functions' => Utils::getFunctionsAdmin(),
        ));

        $center_file = 'dictionary_functions.tpl';

        break;

    case 'function_recr':

        $FunctionID = !empty($_GET['FunctionID']) ? (int)$_GET['FunctionID'] : 0;

        if ((!empty($_GET['Function']) && trim($_GET['Function'])) || !empty($_GET['delFunction'])) {

            try {
                Utils::newFunctionRecr($FunctionID);
                header('Location: ./?m=dictionary&o=function_recr');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'functions' => Utils::getFunctionsRecrAdmin(),
            'functionType' => ConfigData::$tipFunctie,
            'gradTreapta' => ConfigData::$gradTreapta,
            'studii' => ConfigData::$funcStud,
            'gradatie' => ConfigData::$transeVechime,
        ));

        $center_file = 'dictionary_functions_recr.tpl';

        break;

    case 'applications':

        $AppID = !empty($_GET['AppID']) ? (int)$_GET['AppID'] : 0;

        if (!empty($_GET['App']) || !empty($_GET['delApp'])) {
            Application::setApplications($AppID);
            header('Location: ./?m=dictionary&o=applications');
            exit;
        }

        if ($AppID > 0 && (!empty($_GET['Module']) || !empty($_GET['delModule']))) {

            $ModuleID = !empty($_GET['ModuleID']) ? (int)$_GET['ModuleID'] : 0;

            Application::setAppModules($AppID, $ModuleID);

            header('Location: ./?m=dictionary&o=applications&AppID=' . $AppID);
            exit;
        }

        if (($AppID > 0 && trim($_GET['VersionName'])) || !empty($_GET['delVersion'])) {
            $VersionID = !empty($_GET['VersionID']) ? (int)$_GET['VersionID'] : 0;
            Application::setApplicationVersions($AppID, $VersionID);

            header('Location: ./?m=dictionary&o=applications&AppID=' . $AppID);
            exit;
        }

        $smarty->assign(array(
            'applications' => Application::getApplications(),
            'app_modules' => !empty($AppID) ? Application::getAppModules($AppID) : '',
            'app_versions' => !empty($AppID) ? Application::getApplicationVersions($AppID) : '',
        ));

        $center_file = 'dictionary_applications.tpl';

        break;

    case 'training_type':

        $TrainingTypeID = !empty($_GET['TrainingTypeID']) ? (int)$_GET['TrainingTypeID'] : 0;

        if ((!empty($_GET['TrainingType']) && trim($_GET['TrainingType'])) || !empty($_GET['delTrainingType'])) {

            Training::setType($TrainingTypeID);
            header('Location: ./?m=dictionary&o=training_type');
            exit;
        }

        $smarty->assign(array(
            'types' => Training::getTypes(),
        ));

        $center_file = 'dictionary_training_type.tpl';

        break;

    case 'performance_dimension':

        $DimensionID = !empty($_GET['DimensionID']) ? (int)$_GET['DimensionID'] : 0;

        if ((!empty($_GET['Dimension']) && trim($_GET['Dimension'])) || !empty($_GET['delDimension'])) {

            try {
                Performance::newDimension($DimensionID);
                header('Location: ./?m=dictionary&o=performance_dimension');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'dimensions' => Performance::getDimensions(),
        ));

        $center_file = 'dictionary_performance_dimensions.tpl';

        break;

    case 'pontaj_phases':

        $PhaseID = !empty($_GET['PhaseID']) ? (int)$_GET['PhaseID'] : 0;

        if ((!empty($_GET['Phase']) && trim($_GET['Phase'])) || !empty($_GET['delPhase'])) {
            try {
                Project::newPhase($PhaseID);
                header('Location: ./?m=dictionary&o=pontaj_phases');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'phases' => Project::getPhases(true),
        ));

        $center_file = 'dictionary_pontaj_phases.tpl';

        break;

    case 'function_group':

        $FunctionID = !empty($_GET['FunctionID']) ? (int)$_GET['FunctionID'] : 0;

        if ((!empty($_GET['Function']) && trim($_GET['Function'])) || !empty($_GET['delFunction'])) {

            try {
                Utils::newGroupFunction($FunctionID);
                header('Location: ./?m=dictionary&o=function_group');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'functions' => Utils::getGroupFunctionsAdmin(),
            'groups' => Utils::getGroupsAdmin(),
            'groups_func' => Utils::getGroups(),
        ));

        $center_file = 'dictionary_function_group.tpl';

        break;

    case 'groups':

        $GroupID = !empty($_GET['GroupID']) ? (int)$_GET['GroupID'] : 0;

        if ((!empty($_GET['Group']) && trim($_GET['Group'])) || !empty($_GET['delGroup'])) {

            try {
                Utils::newGroup($GroupID);
                header('Location: ./?m=dictionary&o=function_group');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

            $smarty->assign(array(
                'functions' => Utils::getGroupFunctionsAdmin(),
                'groups' => Utils::getGroupsAdmin(),
                'groups_func' => Utils::getGroups(),
            ));

            $center_file = 'dictionary_function_group.tpl';
        }

        break;

    case 'country':

        $CountryID = !empty($_GET['CountryID']) ? (int)$_GET['CountryID'] : 0;

        if ((!empty($_GET['CountryName']) && trim($_GET['CountryName'])) || !empty($_GET['delCountry'])) {

            try {
                Utils::newCountry($CountryID);
                header('Location: ./?m=dictionary&o=country');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'countries' => Utils::getCountriesAdmin(),
        ));
        $center_file = 'dictionary_countries.tpl';

        break;

    case 'induction':

        $CapitolID = !empty($_GET['CapitolID']) ? (int)$_GET['CapitolID'] : 0;

        if (!empty($_GET['Capitol']) || !empty($_GET['delCapitol'])) {
            Application::setInduction($CapitolID);
            header('Location: ./?m=dictionary&o=induction');
            exit;
        }

        if ($CapitolID > 0 && (!empty($_GET['Item']) || !empty($_GET['delItem']))) {

            $ItemID = !empty($_GET['ItemID']) ? (int)$_GET['ItemID'] : 0;
            Application::setInductionItem($CapitolID, $ItemID);
            header('Location: ./?m=dictionary&o=induction&CapitolID=' . $CapitolID);
            exit;
        }

        $smarty->assign(array(
            'induction' => Application::getInduction(),
            'induction_items' => !empty($CapitolID) ? Application::getInductionItems($CapitolID) : '',
        ));

        $center_file = 'dictionary_induction.tpl';

        break;

    case 'contract_type':

        $ContractTypeID = !empty($_GET['ContractTypeID']) ? (int)$_GET['ContractTypeID'] : 0;

        if ((!empty($_GET['ContractType']) && trim($_GET['ContractType'])) || !empty($_GET['delContractType'])) {

            Contract::setType($ContractTypeID);
            header('Location: ./?m=dictionary&o=contract_type');
            exit;
        }

        $smarty->assign(array(
            'types' => Contract::getTypes(),
        ));

        $center_file = 'dictionary_contract_type.tpl';

        break;

    case 'company_type':
        $CompanyTypeID = !empty($_GET['CompanyTypeID']) ? (int)$_GET['CompanyTypeID'] : 0;


        if ((!empty($_GET['CompanyType']) && trim($_GET['CompanyType'])) || !empty($_GET['delCompanyType'])) {

            Company::setType($CompanyTypeID);
            header('Location: ./?m=dictionary&o=company_type');
            exit;
        }

        $smarty->assign(array(
            'types' => Company::getTypes(),
        ));

        $center_file = 'dictionary_company_type.tpl';

        break;

    case 'measurement_units':
        $UnitID = !empty($_GET['UnitID']) ? (int)$_GET['UnitID'] : 0;

        if ((!empty($_GET['Unit']) && trim($_GET['Unit'])) || !empty($_GET['delUnit'])) {

            Utils::setMeasurementUnit($UnitID);
            header('Location: ./?m=dictionary&o=measurement_units');
            exit;
        }

        $smarty->assign(array(
            'units' => Utils::getMeasurementUnits(),
        ));


        $center_file = 'dictionary_measurement_units.tpl';
        break;

    case 'inventar':

        $ObjID = !empty($_GET['ObjID']) ? (int)$_GET['ObjID'] : 0;

        if (!empty($_GET['ObjName']) || !empty($_GET['delObj'])) {

            Utils::setInventar($ObjID);
            header('Location: ./?m=dictionary&o=inventar');
            exit;
        }

        $smarty->assign(array(
            'inventar' => Utils::getInventar(),
            'categories' => ConfigData::$msInventarCategories,
            'Companies' => Ticketing::getCompanies(),
        ));

        $center_file = 'dictionary_inventar.tpl';

        break;

    case 'phone_contracts':

        $ID = !empty($_GET['ID']) ? (int)$_GET['ID'] : 0;

        if (!empty($_GET['PhoneNo']) || !empty($_GET['del'])) {

            Utils::setPhoneContracts($ID);
            header('Location: ./?m=dictionary&o=phone_contracts');
            exit;
        }

        $smarty->assign(array(
            'contracts' => Utils::getPhoneContracts(),
        ));

        $center_file = 'dictionary_pcontracts.tpl';

        break;

    case 'city':

        $DistrictID = !empty($_GET['DistrictID']) ? (int)$_GET['DistrictID'] : 0;
        $CityID = !empty($_GET['CityID']) ? (int)$_GET['CityID'] : 0;

        if (!empty($_GET['DistrictName']) || !empty($_GET['delDistrict'])) {

            try {
                Address::setDistrict($DistrictID);
                header('Location: ./?m=dictionary&o=city');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

        } elseif (!empty($_GET['CityName']) || !empty($_GET['delCity'])) {

            try {
                Address::setCity($DistrictID, $CityID);
                header('Location: ./?m=dictionary&o=city&DistrictID=' . $DistrictID);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        if (!empty($DistrictID)) {
            $cities = Address::getCitiesAdmin($DistrictID);
            $pagination = Utils::paginate($cities[0]['pageNo'], $cities[0]['page'], "./?m=dictionary&o=city&DistrictID=$DistrictID&page=[pag]", Config::$msResPageGroup);
            $smarty->assign(array(
                'districts' => Address::getDistrictsAdmin(),
                'cities' => $cities,
                'pagination' => $pagination,
            ));
        } else {
            $smarty->assign(array(
                'districts' => Address::getDistrictsAdmin(),
            ));
        }

        $center_file = 'dictionary_city.tpl';

        break;

    case 'grila':

        $ID = !empty($_GET['ID']) ? (int)$_GET['ID'] : 0;

        if ((!empty($_GET['max_seniority']) && trim($_GET['max_seniority'])) || !empty($_GET['delGrila'])) {

            try {
                Utils::setGrila($ID);
                header('Location: ./?m=dictionary&o=grila&company_id=' . $_GET['company_id']);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'self' => Company::getSelfCompanies(),
            'grila' => !empty($_GET['company_id']) ? Utils::getGrila($_GET['company_id']) : array(),
            'months' => range(1, 12),
        ));

        $center_file = 'dictionary_grila.tpl';

        break;

    case 'library':

        $CatID = !empty($_GET['CatID']) ? (int)$_GET['CatID'] : 0;
        $PCatID = !empty($_GET['PCatID']) ? (int)$_GET['PCatID'] : 0;

        if (!empty($_GET['Name']) || !empty($_GET['delCat'])) {

            try {
                Utils::setLibraryCat($CatID, $PCatID);
                header('Location: ./?m=dictionary&o=library&CatID=' . $PCatID);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'cats' => Utils::getLibraryCats(),
            'subcats' => !empty($CatID) ? Utils::getLibraryCats($CatID) : '',
        ));

        $center_file = 'dictionary_library.tpl';

        break;

    case 'activity_subject':

        $SubjectID = !empty($_GET['SubjectID']) ? (int)$_GET['SubjectID'] : 0;

        if ((!empty($_GET['Subject']) && trim($_GET['Subject'])) || !empty($_GET['delSubject'])) {

            try {
                Activity::newSubject($SubjectID);
                header('Location: ./?m=dictionary&o=activity_subject');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'subjects' => Activity::getSubjects(),
        ));

        $center_file = 'dictionary_activity_subject.tpl';

        break;

    case 'product':

        $CatID = !empty($_GET['CatID']) ? (int)$_GET['CatID'] : 0;
        $PCatID = !empty($_GET['PCatID']) ? (int)$_GET['PCatID'] : 0;

        if (!empty($_GET['Name']) || !empty($_GET['delCat'])) {

            try {
                Utils::setProductCat($CatID, $PCatID);
                header('Location: ./?m=dictionary&o=product&CatID=' . $PCatID);
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }
        }

        $smarty->assign(array(
            'cats' => Utils::getProductCats(),
            'subcats' => !empty($CatID) ? Utils::getProductCats($CatID) : '',
        ));

        $center_file = 'dictionary_product.tpl';

        break;

    default:

        $center_file = 'dictionary.tpl';

        break;
}

?>