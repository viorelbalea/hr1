<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

if ($_SESSION['USER_ID'] == 1) {
    $rw = 1;
} else {
    if ($o != 'default') {
        foreach (ConfigRights::$msRightsLevel3[34][1] as $k => $v) {
            if ($v['o'] == $o) {
                switch ($_SESSION['USER_RIGHTS3'][34][1][$k]) {
                    case 0:
                        throw new Exception(Message::getMessage('Access forbidden'));
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

    case 'choosemenu':

        $PersonID = (int)$_SESSION['PERS'];
        $StartDate = !empty($_GET['StartDate']) ? Utils::toDBDate($_GET['StartDate']) : '';
        $EndDate = !empty($_GET['EndDate']) ? Utils::toDBDate($_GET['EndDate']) : '';

        if (!empty($_POST['save'])) {
            Catering::setCateringByPerson($PersonID, $StartDate, $EndDate, 'week');
            header('Location: ' . $_SERVER['REQUEST_URI'] . '&msg=1');
            exit;
        }

        $days = array();
        $start = $StartDate;

        // Get catering settings to limit modifyible dates
        if (!empty($_SESSION['PERS'])) {
            $person = new Person($_SESSION['PERS']);
            $company_settings = Utils::getCompanySettings($person->getCompanyID());
            $menu_days_before = $company_settings['catering']['menu_days_before'];
            $menu_max_hour = $company_settings['catering']['menu_max_hour'];

        }

        $nextSunday = date("Y-m-d", strtotime("next sunday", time()));
        $nextMonday = date("Y-m-d", strtotime("next monday", time()));
        $nextFriday = date("Y-m-d", strtotime("next friday", strtotime(date("Y-m-d", strtotime("next friday", time())))));
        $today = date("Y-m-d", time());
        $current_hour = date("G");
        $allowed = 0;
        $catering_week = Catering::getCateringByPerson($PersonID, $StartDate, $EndDate);

        // Allowed to view the timetable only if before the allowed date and time
        if (isset($company_settings['catering']['menu_days_before']) && $_SESSION['USER_ID'] != 1) {
            $allowedDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($nextSunday)) . "- " . $menu_days_before . " day"));
            if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate && (($today < $allowedDate) || ($today == $allowedDate && $current_hour <= $menu_max_hour))) {
                $allowed = 1;
            }
            if ($today > $EndDate || ($today > $StartDate && $today < $EndDate)) {
                $start = $StartDate;
                $allowed = 0;
            } else
                $start = $nextMonday;
        } else
            if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate) {
                $allowed = 1;
            }

        // List available days in period
        if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate) {
            while ($start <= $EndDate) {
                $days[$start] = Config::$msWeekDays[date('l', strtotime($start))];
                $start = date('Y-m-d', strtotime($start) + 24 * 3600);
            }
        }

        $smarty->assign(array(
            'StartDate' => $StartDate,
            'EndDate' => $EndDate,
            'catering_week' => $catering_week,
            'nextMonday' => Utils::toDBDate($nextMonday),
            'nextFriday' => Utils::toDBDate($nextFriday),
            'days' => $days,
            'allowed' => $allowed,
        ));

        $center_file = 'catering_choosemenu.tpl';

        break;

    case 'choosemenu_ang':

        $PersonID = !empty($_GET['PersonID']) ? (int)$_GET['PersonID'] : 0;
        $StartDate = !empty($_GET['StartDate']) ? Utils::toDBDate($_GET['StartDate']) : '';
        $EndDate = !empty($_GET['EndDate']) ? Utils::toDBDate($_GET['EndDate']) : '';

        if (!empty($_POST['save'])) {
            Catering::setCateringByPerson($PersonID, $StartDate, $EndDate);
            header('Location: ' . $_SERVER['REQUEST_URI'] . '&msg=1');
            exit;
        }

        $days = array();
        $start = $StartDate;

        // Get catering settings to limit modifyible dates
        if (!empty($PersonID)) {
            $person = new Person($PersonID);
            $company_settings = Utils::getCompanySettings($person->getCompanyID());
            $menu_days_before = $company_settings['catering']['menu_days_before'];
            $menu_max_hour = $company_settings['catering']['menu_max_hour'];

        }

        $nextSunday = date("Y-m-d", strtotime("next sunday", time()));
        $nextMonday = date("Y-m-d", strtotime("next monday", time()));
        $nextFriday = date("Y-m-d", strtotime("next friday", strtotime(date("Y-m-d", strtotime("next friday", time())))));
        $today = date("Y-m-d", time());
        $current_hour = date("G");
        $allowed = 0;
        $catering_week = Catering::getCateringByPerson($PersonID, $StartDate, $EndDate);


        // Allowed to view the timetable only if before the allowed date and time
        if (isset($company_settings['catering']['menu_days_before']) && $_SESSION['USER_ID'] != 1) {
            $allowedDate = date("Y-m-d", strtotime(date("Y-m-d", strtotime($nextSunday)) . "- " . $menu_days_before . " day"));
            if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate && (($today < $allowedDate) || ($today == $allowedDate && $current_hour <= $menu_max_hour))) {
                $allowed = 1;
            }
            if ($today > $EndDate || ($today > $StartDate && $today < $EndDate)) {
                $start = $StartDate;
                $allowed = 0;
            } else
                $start = $nextMonday;
        } else
            if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate) {
                $allowed = 1;
            }

        // List available days in period
        if (!empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate) {
            while ($start <= $EndDate) {
                $days[$start] = Config::$msWeekDays[date('l', strtotime($start))];
                $start = date('Y-m-d', strtotime($start) + 24 * 3600);
            }
        }

        $smarty->assign(array(
            'StartDate' => $StartDate,
            'EndDate' => $EndDate,
            'catering_week' => $catering_week,
            'days' => $days,
            'persons' => Person::getEmployees(false),
            'nextMonday' => Utils::toDBDate($nextMonday),
            'nextFriday' => Utils::toDBDate($nextFriday),
            'allowed' => $allowed,
        ));

        $center_file = 'catering_choosemenu_ang.tpl';

        break;

    case 'menu_week':

        $StartDate = !empty($_GET['StartDate']) ? Utils::toDBDate($_GET['StartDate']) : '';
        $EndDate = !empty($_GET['EndDate']) ? Utils::toDBDate($_GET['EndDate']) : '';

        if (!empty($_POST['save'])) {
            Catering::setCateringByWeek($StartDate, $EndDate);
            header('Location: ' . $_SERVER['REQUEST_URI']);
            exit;
        }

        $days = array();
        $start = $StartDate;
        $nextMonday = date("Y-m-d", strtotime("next monday", time()));
        $nextFriday = date("Y-m-d", strtotime("next friday", strtotime(date("Y-m-d", strtotime("next friday", time())))));
        while ($start <= $EndDate) {
            $days[$start] = Config::$msWeekDays[date('l', strtotime($start))];
            $start = date('Y-m-d', strtotime($start) + 24 * 3600);
        }

        $smarty->assign(array(
            'catering_week' => !empty($StartDate) && !empty($EndDate) ? Catering::getCateringByWeek($StartDate, $EndDate) : '',
            'days' => $days,
            'nextMonday' => Utils::toDBDate($nextMonday),
            'nextFriday' => Utils::toDBDate($nextFriday),
        ));

        $center_file = 'catering_menuweek.tpl';

        break;

    case 'dictionary':

        $CatID = !empty($_GET['CatID']) ? (int)$_GET['CatID'] : 0;

        if (!empty($_GET['Category']) || !empty($_GET['delCategory'])) {
            Catering::setCatering($CatID);
            header('Location: ./?m=catering&o=dictionary');
            exit;
        }

        if ($CatID > 0 && (!empty($_GET['Item']) || !empty($_GET['delItem']))) {

            $ItemID = !empty($_GET['ItemID']) ? (int)$_GET['ItemID'] : 0;
            Catering::setCateringItem($CatID, $ItemID);
            header('Location: ./?m=catering&o=dictionary&CatID=' . $CatID);
            exit;
        }

        $smarty->assign(array(
            'catering' => Catering::getCatering(),
            'catering_items' => !empty($CatID) ? Catering::getCateringItems($CatID) : '',
        ));

        $center_file = 'catering_dictionary.tpl';

        break;

    default:

        $center_file = 'catering.tpl';

        break;
}

?>