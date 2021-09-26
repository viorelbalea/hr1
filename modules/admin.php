<?php

if (!isset($_SESSION['USER_ID']) || $_SESSION['USER_ID'] != 1) {
    header('Location: ../');
    exit;
}

$o = !empty($_GET['o']) ? $_GET['o'] : 'default';

switch ($o) {

    case 'settings':

        if (!empty($_GET['company_id'])) {

            $company_id = (int)$_GET['company_id'];

            $conn->query("SELECT company_settings FROM settings");
            $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();

            if (!empty($_POST)) {
                $company_settings[$company_id] = $_POST['company_settings'];
                $conn->query("UPDATE settings SET company_settings = '" . serialize($company_settings) . "'");
                if (!empty($_FILES['photo']['name'])) {
                    try {
                        if (in_array(substr(strtolower($_FILES['photo']['name']), -4), array('.jpg', '.gif'))) {
                            if (@move_uploaded_file($_FILES['photo']['tmp_name'], 'photos/logo/' . $company_id . '.jpg')) {
                                $resized = Thumbnail::resize_img(Config::SRV_URL . 'photos/logo/' . $company_id . '.jpg', 170, 40);
                                rename('photos/_tmp/' . basename($resized), 'photos/logo/' . basename($resized));
                                header('Location: ./?m=admin&o=settings&company_id=' . $company_id);
                                exit;
                            } else {
                                throw new Exception(Message::getMessage('PHOTO_ERROR_UPLOAD'));
                            }
                        } else {
                            throw new Exception(Message::getMessage('PHOTO_ERROR_TYPE'));
                        }
                    } catch (Exception $exp) {
                        $err->setError($exp->getMessage());
                    }
                } else {
                    header('Location: ./?m=admin&o=settings&company_id=' . $company_id);
                    exit;
                }
            } else {
                if (!empty($_GET['del_photo'])) {
                    @unlink('photos/logo/' . $company_id . '_170_40.jpg');
                } else {
                    if (file_exists('photos/logo/' . $company_id . '_170_40.jpg')) {
                        $company_settings[$company_id]['photo'] = 'photos/logo/' . $company_id . '_170_40.jpg?rn=' . rand(1, 99999999);
                    }
                }
            }

            $smarty->assign('company_settings', (array)$company_settings[$company_id]);
        }

        $smarty->assign('self', Company::getSelfCompanies());

        $center_file = 'admin_settings.tpl';

        break;

    case 'users':
        $app_modules = Message::getAppModules() + Message::getAppModulesHidden();
        if (!empty($_GET['action'])) {
            switch ($_GET['action']) {
                case 'new':
                    User::addUser();
                    header('Location: ./?m=admin&o=users');
                    exit;
                    break;
                case 'edit':
                    User::editUser();
                    header('Location: ./?m=admin&o=users');
                    exit;
                    break;
                case 'pass':
                    User::passUser();
                    header('Location: ./?m=admin&o=users');
                    exit;
                    break;
                case 'del':
                    User::delUser();
                    header('Location: ./?m=admin&o=users');
                    exit;
                    break;
                case 'settings':
                    if (!empty($_POST)) {
                        User::setSettings();
                        header('Location: ./?m=admin&o=users');
                        exit;
                    } else {
                        $smarty->assign(array(
                            'role_type' => User::$msRoleType,
                            'self' => Company::getSelfCompanies(),
                            'app_modules' => $app_modules,
                            'users' => User::getUsers(),
                            'info' => User::getSettings(),
                        ));
                        $center_file = 'admin_users_settings.tpl';
                        return;
                    }
                    break;
                case 'rights':
                    if ($_GET['module'] == 10) {
                        unset(ConfigRights::$msRightsLevel3[$_GET['module']][1][1]);
                        $library_cats = Utils::getLibraryCats();
                        foreach ($library_cats as $library_cat) {
                            ConfigRights::$msRightsLevel3[$_GET['module']][1][$library_cat['CatID']]['name'] = $library_cat['Name'];
                        }
                    }
                    if (!empty($_POST)) {
                        User::setRights();
                        header('Location: ./?m=admin&o=users');
                        exit;
                    } elseif (!empty($_GET['pos'])) {
                        User::setRightsPosition();
                        header('Location: ./?m=admin&o=users&action=rights&id=' . $_GET['id'] . '&module=' . $_GET['module']);
                        exit;
                    } elseif (!empty($_GET['resetpos'])) {
                        User::setRightsPositionReset();
                        header('Location: ./?m=admin&o=users&action=rights&id=' . $_GET['id'] . '&module=' . $_GET['module']);
                        exit;
                    } else {
                        $info = User::getRights();
                        foreach (ConfigRights::$msRightsLevel2[$_GET['module']] as $k => $v) {
                            if (isset($v['type']) && $v['type'] == 'list' && !empty($info['UserRightsPosition'][$_GET['module']][$k])) {
                                $pos = 0;
                                foreach (ConfigRights::$msRightsLevel3[$_GET['module']][$k] as $idx => $vv) {
                                    $l3idx[$idx] = ++$pos;
                                }
                                foreach ((array)$info['UserRightsPosition'][$_GET['module']][$k] as $idx => $pos) {
                                    if (!isset($l3idx[$idx])) {
                                        continue;
                                    }
                                    $pos_ini = $l3idx[$idx];
                                    $idx_ini = array_search($pos, $l3idx);
                                    if (empty($idx_ini)) {
                                        continue;
                                    }
                                    $l3idx[$idx] = $pos;
                                    $l3idx[$idx_ini] = $pos_ini;
                                }
                                asort($l3idx);
                                foreach ($l3idx as $idx => $pos) {
                                    $l3idx[$idx] = ConfigRights::$msRightsLevel3[$_GET['module']][$k][$idx];
                                }
                                ConfigRights::$msRightsLevel3[$_GET['module']][$k] = $l3idx;
                            }
                        }
                        $smarty->assign(array(
                            'app_modules' => $app_modules,
                            'info' => $info,
                            'rights_level2' => ConfigRights::$msRightsLevel2[$_GET['module']],
                            'rights_level3' => ConfigRights::$msRightsLevel3[$_GET['module']],
                        ));
                        $center_file = 'admin_users_rights.tpl';
                        return;
                    }
                    break;
            }
        }

        if (!empty($_POST)) {

            User::setUsers();
        }

        $smarty->assign(array(
            'app_modules' => $app_modules,
            'users' => User::getUsers(),
        ));
        $center_file = 'admin_users.tpl';

        break;

    case 'reports':

        if (!empty($_GET['ReportID'])) {

            $ReportID = (int)$_GET['ReportID'];
            if (!empty($_POST)) {
                Utils::setReportRights($ReportID);
                header('Location: ./?m=admin&o=reports');
                exit;
            }
            $smarty->assign(array(
                'rights' => Utils::getReportRights($ReportID),
                'groups' => Utils::getReportGroups(),
                'types' => Ticket::$msTicketType,
            ));
            $center_file = 'admin_reports_rights.tpl';

        } elseif (!empty($_POST['reports'])) {

            Utils::allocReportRights();
            header('Location: ./?m=admin&o=reports');
            exit;

        } else {

            if (!empty($_GET['action'])) {
                Utils::setReportGroup();
                header('Location: ./?m=admin&o=reports');
                exit;
            }

            $smarty->assign(array(
                'reports' => Utils::getReports(),
                'groups' => Utils::getReportGroups(),
                'types' => Ticket::$msTicketType,
            ));
            $center_file = 'admin_reports.tpl';
        }

        break;

    case 'customfields':

        if (!empty($_POST)) {

            Utils::setCustomFields();
        }

        $smarty->assign('customfields', Utils::getCustomFields());

        $center_file = 'admin_customfields.tpl';

        break;

    case 'alert':
        if ($_GET['ID'] == 44 && empty($_POST)) {//iau toate tipurile de concediu
            $query = "SELECT DISTINCT vd.`Type` FROM vacations_details vd";
            $conn->query($query);
            while ($row = $conn->fetch_array()) {
                $vacationTypes[] = $row['Type'];
            }
            $smarty->assign('vacationTypes', $vacationTypes);
        }
        $ID = !empty($_GET['ID']) ? $_GET['ID'] : 0;

        if (!empty($_POST)) {
            if ($ID) {
                Utils::setAlerte($ID);
            } else {
                foreach ($_POST['DashboardH'] as $alert_id => $v) {
                    $conn->query("UPDATE alert SET Dashboard = " . (!empty($_POST['Dashboard'][$alert_id]) ? 1 : 0) . " WHERE ID = $alert_id");
                }
            }
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $smarty->assign('alerte', Utils::getAlerte());

        switch ($ID) {
            case 1:
                $smarty->assign('roles', Pontaj::getPontajRoles());
                break;
            case 21:
                $smarty->assign('ticketing_status', ConfigData::$msTicketingStatus);
                break;
            default:
                $smarty->assign('roles', User::getRoles());
                break;

        }

        $center_file = 'admin_alerte.tpl';

        break;

    case 'aprove':

        if (!empty($_POST)) {

            Utils::setSettings();
        }

        $smarty->assign('settings', Utils::getSettings());

        $center_file = 'admin_aprove.tpl';

        break;

    case 'import':
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getData($path);
                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportData[1];
                        unset(Person::$PersonImportData[1]);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportData,
                        ));

                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                Person::ImportData($_POST['person']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import.tpl';
        break;
    case 'import_saga':
        $smarty->assign(array('CompaniesSelf' => Company::getSelfCompanies(),));
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getData($path);
                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportData[1];
                        unset(Person::$PersonImportData[1]);
//								print_r($_SESSION['_PersonImportData']);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportData,

                        ));
                        $_SESSION['_PersonImportData'] = Person::$PersonImportData;
                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                //Person::ImportData($_POST['person']);
                Person::ImportData($_SESSION['_PersonImportData'], $_POST['person']);
                echo "<body onload=\"window.location.href = 'index.php?m=admin&o=import_saga&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_saga.tpl';
        break;

    case 'import_charisma':

        if (isset($_POST['ruleaza'])) {
            Person::importCharisma();
        }

        $center_file = 'admin_import_charisma.tpl';
        break;

    case 'import_cand_ext':
        $query = "select * from candidate_posttype";
        $res = $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $sources[$row['PostTypeId']] = $row['PostTypeName'];
        }
        $query = "select * from candidate_post";
        $res = $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $posts[$row['PostId']] = $row['PostName'];
        }
        $smarty->assign('sources', $sources);
        $smarty->assign('posts', $posts);

        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getData($path);
                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportData[1];
                        unset(Person::$PersonImportData[1]);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportData,

                        ));
                        $_SESSION['_PersonImportData'] = Person::$PersonImportData;
                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                Person::ImportCandExt($_SESSION['_PersonImportData'], $_POST['person']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import_cand_ext&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_cand_ext.tpl';
        break;
    case 'import_salary':
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getSalaryData($path);
                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportSalaryData[1];
                        unset(Person::$PersonImportSalaryData[1]);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportSalaryData,
                        ));

                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                Person::ImportSalaryData($_POST['person']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import_salary&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_salary.tpl';
        break;

    case 'import-cars':
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Car::getXLSData($path);
                        //Utils::pa(Person::$PersonImportData);
                        $carsHeader = Car::$CarImportData[1];
                        unset(Car::$CarImportData[1]);
                        $smarty->assign(array(
                            'carsHeader' => $carsHeader,
                            'cars' => Car::$CarImportData,
                            'car_types' => Car::$msCarTypes,
                            'car_brands' => Car::$msBrands,
                            'currencies' => Car::$msCurrencies,
                        ));

                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['car'])) {
            try {
                Car::importXLSData($_POST['car']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import-cars&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {

                $err->setError($exp->getMessage());
            }
            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_cars.tpl';
        break;

    case 'import_avans':
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getAvansData($path);

                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportAvansData[1];
                        unset(Person::$PersonImportAvansData[1]);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportAvansData,
                        ));

                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                Person::ImportAvansData($_POST['person']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import_avans&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_avans.tpl';
        break;

    case 'import_prime':
        // Citire si afisare date
        if (!empty($_FILES['fisier']['name'])) {
            if (in_array(substr(strtolower($_FILES['fisier']['name']), -4), array('.xls'))) {
                $path = 'xls_tmp/' . md5(microtime()) . '.xls';
                if (!move_uploaded_file($_FILES['fisier']['tmp_name'], $path)) {
                    throw new Exception(Message::getMessage('XLS_ERROR_UPLOAD'));
                } else {
                    if (file_exists($path)) {
                        Person::getPrimeData($path);

                        //Utils::pa(Person::$PersonImportData);
                        $personHeader = Person::$PersonImportPrimeData[1];
                        unset(Person::$PersonImportPrimeData[1]);
                        $smarty->assign(array(
                            'personsHeader' => $personHeader,
                            'persons' => Person::$PersonImportPrimeData,
                        ));

                        @unlink($path);

                    }
                }
            } else {
                throw new Exception(Message::getMessage('XLS_ERROR_TYPE'));
            }
        }

        if (!empty($_POST['person'])) {
            try {
                Person::ImportPrimeData($_POST['person']);
                echo "<body onload=\"window.location.href = './?m=admin&o=import_prime&msg=1'\"></body>";
                exit;

            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

            $smarty->assign(array(
                'uploaded' => '1',
            ));
        }
        $center_file = 'admin_import_prime.tpl';
        break;

    case 'budgets':
        if (!empty($_POST) || !empty($_GET['del'])) {

            try {
                Budget::editConsumedPeriod($_GET['PeriodID']);
                header('Location: ./?m=admin&o=budgets');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

        }

        $smarty->assign(array('periods' => Budget::getConsumedPeriods(),
            'years' => range(date('Y') - 2, date('Y') + 2),
            'months' => array(1 => 'Ian', 2 => 'Feb', 3 => 'Mar', 4 => 'Apr', 5 => 'Mai', 6 => 'Iun', 7 => 'Iul', 8 => 'Aug', 9 => 'Sep', 10 => 'Oct', 11 => 'Noi', 12 => 'Dec'),
        ));

        $center_file = 'admin_budget.tpl';
        break;

    case 'translate':

        if (!empty($_GET['generate'])) {
            Utils::genTranslate($_GET['lang']);
            echo "<body onload=\"alert('Traducerea a fost generata!'); window.location.href = './?m=admin&o=translate&lang={$_GET['lang']}';\"></body>";
            exit;
        }

        if (isset($_GET['ID'])) {
            Utils::setTranslate($_GET['lang']);
            header('Location: ./?m=admin&o=translate&lang=' . $_GET['lang'] . '&letter=' . $_GET['letter']);
            exit;
        }

        for ($i = 65; $i <= 90; $i++) {
            $letters[$i] = chr($i);
        }
        $smarty->assign(array(
            'langs' => Config::$msLangs,
            'letters' => $letters,
        ));
        if (!empty($_GET['lang']) && !empty($_GET['letter'])) {
            $smarty->assign(array(
                'translates' => Utils::getTranslates($_GET['lang'], $_GET['letter']),
            ));
        }

        $center_file = 'admin_translate.tpl';

        break;

    case 'currency':

        $currencies = Currency::$msCurrencies;
        if (!empty($_POST) || !empty($_GET['del'])) {

            try {
                Currency::editRate($_GET['PeriodID']);
                header('Location: ./?m=admin&o=currency');
                exit;
            } catch (Exception $exp) {
                $err->setError($exp->getMessage());
            }

        }
        foreach ($currencies as $k0 => $v0) {
            $a1 = $currencies;
            unset($a1[$k0]);
            foreach ($a1 as $k1 => $v1) {
                $a1 = $currencies[1];
                $currencies_comb[] = "$v0/$v1";
            }
        }
        $smarty->assign(array(    //'currencies'	=> Currency::$msCurrencies,
            'currencies' => $currencies_comb,
            'types' => Currency::$msCurrenciesType,
            'years' => range(date('Y') - 5, date('Y') + 2),
            'rates' => Currency::getRates(),
        ));


        $center_file = 'admin_currencies.tpl';
        break;
    case 'ticketing':

        $objTicketing = new Ticketing();

        $smarty->assign(array(
            'assign_defaults' => $objTicketing->msTicketingCategoriesDefaults,
            'categories' => Ticketing::$msTicketingCategories
        ));
        if (isset($_GET['CategoryID'])) {
            if (isset($_GET['assign_person'])) {
                $objTicketing->setTicketCategoryDefault($_GET['CategoryID'], $_GET['assign_default'], $_GET['assign_person']);
                $smarty->assign("mesajT", "Salvare efectuata.");
            } else if (isset($_GET['assign_default'])) {
                $objTicketing->setTicketCategoryDefault($_GET['CategoryID'], $_GET['assign_default']);
                $smarty->assign("mesajT", "Salvare efectuata.");
            }
            $smarty->assign('assign_default', $objTicketing->getTicketCategoryDefault($_GET['CategoryID']));
            if ($objTicketing->getTicketCategoryDefault($_GET['CategoryID']) == 3) {
                $smarty->assign('persons', Person::getEmployees(FALSE));
                $smarty->assign('assign_person', $objTicketing->getTicketCategoryDefaultPerson($_GET['CategoryID']));
            }
        }
        $center_file = 'admin_ticketing.tpl';
        break;

    default:

        $center_file = 'admin.tpl';

        break;
}

?>