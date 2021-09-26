<?php

class Utils extends ConfigData
{

    public static function checkPassword($password)
    {
        if (!preg_match('/[a-z]/', $password)) {
            return false;
        }
        if (!preg_match('/[A-Z]/', $password)) {
            return false;
        }
        if (!preg_match('/[0-9]/', $password)) {
            return false;
        }
        if (strlen($password) < 8) {
            return false;
        }
        return true;
    }

    public static function tmpDebug($str, $var)
    {
        echo "<small>" . $str . ": </small><br />";
        echo "<pre>";
        var_dump($var);
        echo "</pre>";
    }

    public static function checkEmail($email)
    {
        if (!eregi("^[_a-z0-9-]+(\.[_a-z0-9-]+)*@[a-z0-9-]+(\.[a-z0-9-]+)*(\.([a-z]{2,3}|info))$", $email)) {
            return false;
        }
        return true;
    }

    public static function checkCNP($cnp)
    {
        if (strlen($cnp) == 13) {
            $s = $cnp{0} * 2 + $cnp{1} * 7 + $cnp{2} * 9 + $cnp{3} * 1 + $cnp{4} * 4 + $cnp{5} * 6 +
                $cnp{6} * 3 + $cnp{7} * 5 + $cnp{8} * 8 + $cnp{9} * 2 + $cnp{10} * 7 + $cnp{11} * 9;
            $rest = $s % 11;
            if (($rest < 10 && $rest == $cnp{12}) || ($rest == 10 && $cnp{12} == 1)) {
                return true;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }

    public static function fromXLStoDBDate($string)
    {
        $parts = explode('/', $string);
        return $parts[2] . '-' . $parts[0] . '-' . $parts[1];
    }

    public static function toDisplayDate($dbString)
    {
        $parts = explode('-', $dbString);
        return $parts[2] . '.' . $parts[1] . '.' . $parts[0];
    }

    public static function toDisplayTime($string)
    {
        $parts = explode(' ', $string);
        $parts2 = explode('-', $parts[0]);
        return $parts2[2] . '.' . $parts2[1] . '.' . $parts2[0] . ' ' . $parts[1];
    }

    public static function getDaysDiff($datai, $dataf, $skip_weekend = true, $skip_legal = true, $exclude = array(), $restrict = array(), $exclude_range = array(), $restrict_range = array())
    {
        $legal = self::$msLegal;
        $timei = strtotime($datai);
        $timef = strtotime($dataf);
        $timef++;
        $days = 0;
        while ($timei < $timef) {
            if ($skip_weekend && in_array(date('w', $timei), array(0, 6))) {
                $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                continue;
            }
            if ($skip_legal && isset($legal[date('Y-m-d', $timei)])) {
                $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                continue;
            }
            if (!empty($exclude) && in_array(date('Y-m-d', $timei), $exclude)) {
                $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                continue;
            }
            if (!empty($restrict) && !in_array(date('Y-m-d', $timei), $restrict)) {
                $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                continue;
            }
            if (!empty($exclude_range)) {
                $exclude = true;
                foreach ($exclude_range as $range) {
                    if ($timei < strtotime($range['Start']) || $timei > strtotime($range['Stop'])) {
                        $exclude = false;
                    }
                }
                if ($exclude) {
                    $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                    continue;
                }
            }
            if (!empty($restrict_range)) {
                $include = false;
                foreach ($restrict_range as $range) {
                    if ($timei >= strtotime($range['Start']) && $timei <= strtotime($range['Stop'])) {
                        $include = true;
                    }
                }
                if (!$include) {
                    $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
                    continue;
                }
            }

            $days++;
            $timei = strtotime(date('Y-m-d', $timei) . " +1 day");
        }
        return $days;
    }

    public static function getDaysList($datai, $dataf, $skip_weekend = true, $skip_legal = true, $exclude = array(), $exclude_range = array(), $restrict_range = array())
    {
        $day = strtotime($datai);
        $timef = strtotime($dataf);

        $days = array();
        while ($day <= $timef) {
            if ($skip_weekend && in_array(date('w', $day), array(0, 6))) {
                $day = strtotime(date('Y-m-d', $day) . " +1 day");
                continue;
            }
            if ($skip_legal && isset(ConfigData::$msLegal[date('Y-m-d', $day)])) {
                $day = strtotime(date('Y-m-d', $day) . " +1 day");
                continue;
            }
            if (!empty($exclude) && in_array(date('Y-m-d', $day), $exclude)) {
                $day = strtotime(date('Y-m-d', $day) . " +1 day");
                continue;
            }
            if (!empty($exclude_range)) {
                $exclude = true;
                foreach ($exclude_range as $range) {
                    if ($day < strtotime($range['Start']) || $day > strtotime($range['Stop'])) {
                        $exclude = false;
                    }
                }
                if ($exclude) {
                    $day = strtotime(date('Y-m-d', $day) . " +1 day");
                    continue;
                }
            }
            if (!empty($restrict_range)) {
                $include = false;
                foreach ($restrict_range as $range) {
                    if ($day >= strtotime($range['Start']) && $day <= strtotime($range['Stop'])) {
                        $include = true;
                    }
                }
                if (!$include) {
                    $day = strtotime(date('Y-m-d', $day) . " +1 day");
                    continue;
                }
            }

            $days[] = date('Y-m-d', $day);
            $day = strtotime(date('Y-m-d', $day) . " +1 day");
        }
        //print_r($days);
        //die();

        return $days;
    }

    public static function getHoursList($starth = "00:00", $endh = "00:00", $increment = 3600)
    {
        $hours = array();
        $starth = strtotime($starth);
        $endh = strtotime($endh);
        if ($endh == $starth) {
            $endh += 24 * 3600;
        }
        if ($endh > $starth) {
            for ($i = $starth; $i < $endh; $i += $increment) {
                $hours[] = date('H:i', $i);
            }
        }
        return $hours;
    }

    public static function getMonthsList($datai, $dataf)
    {
        $day = strtotime($datai);
        $timef = strtotime($dataf);

        $months = array();
        while ($day <= $timef) {
            $month = date('m', $day);
            $year = date('Y', $day);
            if (!isset($months[$year])) {
                $months[$year] = array();
            }
            if (!in_array($month, $months[$year])) {
                $months[$year][] = $month;
            }
            $day = strtotime(date('Y-m-t', $day)) + 24 * 3600;
        }
        return $months;
    }

    public static function getWeeksList($datai, $dataf)
    {
        $day = strtotime($datai);
        $timef = strtotime($dataf);

        $weeks = array();
        while ($day <= $timef) {
            $week = date('W', $day);
            $wday = date('w', $day);
            if ($wday < 1) {
                $wday = 7;
            }
            $day -= ($wday - 1) * 24 * 3600;
            $month = date('m', $day);
            $year = date('Y', $day);
            if ($week == "01" && $month == "12") {
                $year++;
            }

            if (!isset($weeks[$year])) {
                $weeks[$year] = array();
            }
            if (!in_array($week, $weeks[$year])) {
                $weeks[$year][] = $week;
            }
            $day += (7 - (date('w', $day)) + 1) * 24 * 3600;
        }
        return $weeks;
    }

    public static function getHoursByType($datai, $dataf, $WorkStartHour = null, $WorkEndHour = null, $LunchBreakStartHour = null, $LunchBreakEndHour = null)
    {
        $legal = self::$msLegal;
        $timei = strtotime($datai);
        $timef = strtotime($dataf);

        $starti = $endi = $lunchstarti = $lunchendi = null;

        if (isset($WorkStartHour) && isset($WorkEndHour)) {
            $starti = strtotime(date('Y-m-d', $datai) . " " . $WorkStartHour);
            $endi = strtotime(date('Y-m-d', $datai) . " " . $WorkEndHour);
            if ($endi <= $starti) {
                $endi += 24 * 3600;
            }

            if (isset($LunchBreakStartHour) && isset($LunchBreakEndHour)) {
                $lunchstarti = strtotime(date('Y-m-d', $datai) . " " . $LunchBreakStartHour);
                if ($lunchstarti < $starti) {
                    $lunchstarti += 24 * 3600;
                }
                $lunchendi = strtotime(date('Y-m-d', $datai) . " " . $LunchBreakEndHour);
                if ($lunchendi < $starti) {
                    $lunchendi += 24 * 3600;
                }
            }
        }

        $stat['Normal'] = 0;
        $stat['Overtime'] = 0;
        $stat['Night'] = 0;
        $stat['Legal'] = 0;
        $stat['Weekend'] = 0;
        $stat['Overtime_Night'] = 0;
        $stat['Overtime_Legal'] = 0;
        $stat['Overtime_Weekend'] = 0;
        $stat['Night_Legal'] = 0;
        $stat['Night_Weekend'] = 0;
        $stat['Legal_Weekend'] = 0;
        $stat['Overtime_Night_Legal'] = 0;
        $stat['Overtime_Legal_Weekend'] = 0;
        $stat['Overtime_Night_Weekend'] = 0;
        $stat['Night_Legal_Weekend'] = 0;
        $stat['Overtime_Night_Legal_Weekend'] = 0;


        $cursor = $timei;
        $pin = $timef;
        while ($cursor < $timef) {
            $is_normal = $is_overtime = $is_night = $is_legal = $is_weekend = $is_lunch = false;
            $eod = strtotime(date('Y-m-d', $cursor) . " 00:00:00") + 24 * 3600;
            if ($cursor < strtotime(date('Y-m-d', $cursor) . " 06:00:00")) {
                $is_night = true;
                $pin = strtotime(date('Y-m-d', $cursor) . " 06:00:00");
            } elseif ($cursor < strtotime(date('Y-m-d', $cursor) . " 22:00:00")) {
                $pin = strtotime(date('Y-m-d', $cursor) . " 22:00:00");
            } elseif ($cursor < $eod) {
                $is_night = true;
                $pin = $eod;
            }

            if (in_array(date('w', $cursor), array(0, 6))) {
                $is_weekend = true;
            }
            if (isset(ConfigData::$msLegal[date('Y-m-d', $cursor)])) {
                $is_legal = true;
            }

            if (!empty($starti) && $starti < $pin) {
                $is_overtime = true;
                $pin = $starti;
            } elseif (!empty($lunchstarti) && $lunchstarti < $pin) {
                $is_lunch = true;
                $pin = $lunchstarti;
            }

            if ($timef < $pin) {
                $pin = $timef;
            }

            $diff = $pin - $cursor;
            $key = '';
            if ($is_overtime) {
                $key = 'Overtime';
            }
            if ($is_night) {
                $key .= (!empty($key) ? "_" : "") . "Night";
            }
            if ($is_legal) {
                $key .= (!empty($key) ? "_" : "") . "Legal";
            }
            if ($is_weekend) {
                $key .= (!empty($key) ? "_" : "") . "Weekend";
            }
            if (empty($key)) {
                $key = "Normal";
            }

            $stat[$key] += $diff / 3600;

            $cursor = $pin;
            if ($is_lunch) {
                $cursor = $lunchendi;
            }
        }
        return $stat;
    }

    public static function getDateTimeDiff($datai, $dataf, $skip_weekend = true, $skip_legal = true, $exclude = array(), $restrict = array(), $exclude_range = array(), $restrict_range = array())
    {
        $legal = self::$msLegal;
        $timei = strtotime($datai);
        $timef = strtotime($dataf);
        $mstamp = date('m-Y', $timei);

        $data = array("y" => 0, "m" => 0, "d" => 0, "h" => 0, "i" => 0, "s" => 0, "days" => 0, "hours" => 0, "seconds" => 0);
        while ($timei < $timef) {
            $eod = mktime(23, 59, 59, date('m', $timei), date('d', $timei), date('Y', $timei));
            if ($skip_weekend && in_array(date('w', $timei), array(0, 6))) {
                $timei = $eod + 1;
                continue;
            }
            if ($skip_legal && isset($legal[date('Y-m-d', $timei)])) {
                $timei = $eod + 1;
                continue;
            }
            if (!empty($exclude) && in_array(date('Y-m-d', $timei), $exclude)) {
                $timei = $eod + 1;
                continue;
            }
            if (!empty($restrict) && !in_array(date('Y-m-d', $timei), $restrict)) {
                $timei = $eod + 1;
                continue;
            }
            if (!empty($exclude_range)) {
                $exclude = true;
                foreach ($exclude_range as $range) {
                    if ($timei < strtotime($range['Start']) || $timei > strtotime($range['Stop'])) {
                        $exclude = false;
                    }
                }
                if ($exclude) {
                    $timei = $eod + 1;
                    continue;
                }
            }
            if (!empty($restrict_range)) {
                $include = false;
                foreach ($restrict_range as $range) {
                    if ($timei >= strtotime($range['Start']) && $timei <= strtotime($range['Stop'])) {
                        $include = true;
                    }
                }
                if (!$include) {
                    $timei = $eod + 1;
                    continue;
                }
            }

            if ($eod > $timef) {
                $eod = $timef;
            }
            $diff = $eod - $timei;
            if ($eod != $timef)
                $diff++;

            $data['seconds'] += $diff;
            $data['s'] += $diff;
            if ($data['s'] >= 60) {
                $data['i'] += floor($data['s'] / 60);
                $data['s'] = $data['s'] % 60;
            }
            if ($data['i'] >= 60) {
                $data['h'] += floor($data['i'] / 60);
                $data['hours'] += floor($data['i'] / 60);
                $data['i'] = $data['i'] % 60;
            }
            if ($data['h'] >= 24) {
                $data['d'] += floor($data['h'] / 24);
                $data['days'] += floor($data['h'] / 24);
                $data['h'] = $data['h'] % 24;
            }
            $timei = $eod + 1;
            if ((date('d', $timei) >= date('d', strtotime($datai)) || ((date('d', strtotime($datai)) > date('t', $timei)) && (date('d', $timei) == date('t', $timei)))) && date('m-Y', $timei) != $mstamp) {
                $data['d'] = 0;
                $data['m']++;
                $mstamp = date('m-Y', $timei);
            }
            if ($data['m'] >= 12) {
                $data['m'] -= 12;
                $data['y']++;
            }

            if ($eod == $timef) {
                break;
            }
        }
        return $data;
    }

    public static function dateDiff($datai, $dataf, $full = false)
    {
        $legal = self::$msLegal;
        $days_no = 0;
        $dayi = (int)substr($datai, 0, 2);
        $monthi = (int)substr($datai, 3, 2);
        $yeari = (int)substr($datai, 6);
        $dayf = (int)substr($dataf, 0, 2);
        $monthf = (int)substr($dataf, 3, 2);
        $yearf = (int)substr($dataf, 6);
        $uti = mktime(0, 0, 0, $monthi, $dayi, $yeari);
        while (($utf = mktime(0, 0, 0, $monthf, $dayf, $yearf)) >= $uti) {
            $dayf--;
            if ($full == false && (date('w', $utf) == 0 || date('w', $utf) == 6 || isset($legal[date('Y-m-d', $utf)]))) {
                continue;
            }
            $days_no++;
        }
        return $days_no;
    }

    public static function dateDiff2YMD($StartDate, $EndDate, $to_curr_date = true)
    {

        if (empty($StartDate) || $StartDate == '0000-00-00') {
            return array(0, 0, 0);
        }

        if (empty($EndDate) || $EndDate == '0000-00-00') {
            $EndDate = date('Y-m-d');
        }

        if ($to_curr_date == true) {
            if ($EndDate > date('Y-m-d')) {
                $EndDate = date('Y-m-d');
            }
        }

        $months = array(31, 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31);
        if (!(((int)$EndDate) % 4)) {
            $months[1] = 29;
        }

        $DeltaYY = (int)$EndDate - (int)$StartDate;
        $Anniversary = date('Y-m-d', mktime(0, 0, 0, (int)substr($StartDate, 5, 2), (int)substr($StartDate, 8, 2), (int)$StartDate + $DeltaYY));
        $YYDelta = $DeltaYY - ($Anniversary > $EndDate ? 1 : 0);

        $MMDelta = (int)substr($EndDate, 5, 2) - (int)substr($Anniversary, 5, 2);
        if ($MMDelta < 0) {
            $MMDelta += 12;
        }

        $DDDelta = (int)substr($EndDate, 8, 2) - (int)substr($Anniversary, 8, 2);  // Ciprian + 1
        if ($DDDelta < 0) {
            $MMDelta--;
            $DDDelta += $months[(int)date('m', mktime(0, 0, 0, (int)substr($EndDate, 5, 2) - 1, (int)substr($EndDate, 8, 2), (int)$EndDate)) - 1];
            if ($MMDelta < 0) {
                $MMDelta = 11;
            }
        }

        return array($YYDelta, $MMDelta, $DDDelta);
    }

    public static function getMonthArray($start_date, $end_date)
    {
        $start_timestamp = strtotime(str_replace('-', '/', $start_date));
        $end_timestamp = strtotime(str_replace('-', '/', $end_date));

        $start_month_timestamp = strtotime(date('F Y', $start_timestamp));
        $current_month_timestamp = strtotime(date('F Y', $end_timestamp));

        $arr_month = array();

        while ($start_month_timestamp <= $current_month_timestamp) {
            $arr_month[strtolower(date('Y-m', $end_timestamp))] = date('F Y', $end_timestamp);
            $end_timestamp = strtotime('-1 month', $end_timestamp);

            $current_month_timestamp = strtotime(date('F Y', $end_timestamp));
        }
        ksort($arr_month);
        return $arr_month;
    }

    public static function getMonthArrayShortFormat($start_date, $end_date)
    {
        $start_timestamp = strtotime(str_replace('-', '/', $start_date));
        $end_timestamp = strtotime(str_replace('-', '/', $end_date));

        $start_month_timestamp = strtotime(date('F Y', $start_timestamp));
        $current_month_timestamp = strtotime(date('F Y', $end_timestamp));

        $arr_month = array();

        while ($start_month_timestamp <= $current_month_timestamp) {
            $arr_month[strtolower(date('Y-m', $end_timestamp))] = date('M-y', $end_timestamp);
            $end_timestamp = strtotime('-1 month', $end_timestamp);

            $current_month_timestamp = strtotime(date('F Y', $end_timestamp));
        }
        ksort($arr_month);
        return $arr_month;
    }

    public static function getDatesFromRange($startDate, $endDate)
    {
        $return = array($startDate);
        $start = $startDate;
        $i = 1;
        if (strtotime($startDate) < strtotime($endDate)) {
            while (strtotime($start) < strtotime($endDate)) {
                $start = date('Y-m-d', strtotime($startDate . '+' . $i . ' days'));
                $return[] = $start;
                $i++;
            }
        }

        return $return;
    }

    public static function displayInfo($info)
    {
        foreach ($info as &$v) {
            if (!is_numeric($v) && !is_array($v)) {
                $v = strip_tags(stripslashes($v));
            }
        }
        return $info;
    }

    public static function base64url_encode($input)
    {
        return strtr(base64_encode($input), '+/=', '-_~');
    }

    public static function base64url_decode($input)
    {
        return base64_decode(strtr($input, '-_~', '+/='));
    }

    public static function getSettings()
    {

        global $conn;

        $conn->query("SELECT * FROM settings");
        return $conn->fetch_array();
    }

    public static function getMinYear()
    {
        global $conn;
        $conn->query("SELECT min(year(StartDate)) AS minYear FROM payroll WHERE StartDate != 0");
        $minYear = $conn->fetch_array();
        return ($minYear[minYear]);
    }

    public static function getCompanySettings($CompanyID, $RoleID = 0)
    {
        global $conn;
        if ($RoleID > 0) {
            $conn->query("SELECT CompanySettings AS company_settings FROM users WHERE UserID = $RoleID");
        } else {
            $conn->query("SELECT company_settings FROM settings");
        }
        $company_settings = ($row = $conn->fetch_array()) && !empty($row['company_settings']) ? unserialize($row['company_settings']) : array();
        return isset($company_settings[$CompanyID]) ? $company_settings[$CompanyID] : array();
    }

    public static function setSettings()
    {

        global $conn;

        $update = array();
        foreach ($_POST as $k => $v) {
            $update[] = "$k = '$v'";
        }

        $conn->query("UPDATE settings SET " . implode(",", $update));
    }

    public static function getSites()
    {

        global $conn;

        $conn->query("SELECT SiteID, Site FROM sites ORDER BY Site");
        $sites = array();
        while ($row = $conn->fetch_array()) {
            $sites[$row['SiteID']] = $row['Site'];
        }
        return $sites;
    }

    public static function setSites($SiteID)
    {

        global $conn;

        if (!empty($_GET['delSite']) && $SiteID > 0) {
            $rooms = self::getRooms($SiteID);
            $conn->query("DELETE FROM rooms
                          WHERE SiteID = $SiteID AND
                                NOT EXISTS(SELECT InterviewID FROM interviews WHERE RoomID IN (" . (count($rooms) ? implode(',', array_keys($rooms)) : 0) . "))");
            if (!$conn->get_affected_rows() && count($rooms)) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta locatie deoarece contine sali deja alocate pentru interviuri!'); window.location.href = './?m=dictionary&o=sites';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM sites WHERE SiteID = $SiteID");
                header('Location: ./?m=dictionary&o=sites');
                exit;
            }
        }

        if (!empty($_GET['Site']) && trim($_GET['Site'])) {
            if ($SiteID > 0) {
                $conn->query("UPDATE sites SET site = '" . trim($_GET['Site']) . "' WHERE SiteID = $SiteID");
            } else {
                $conn->query("INSERT INTO sites(Site, CreateDate) VALUES('" . trim($_GET['Site']) . "', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SITE'));
            }
        }
    }

    public static function getRooms($SiteID)
    {

        global $conn;

        $conn->query("SELECT RoomID, Room, Notes FROM rooms WHERE SiteID = $SiteID ORDER BY Room");
        $rooms = array();
        while ($row = $conn->fetch_array()) {
            $rooms[$row['RoomID']] = $row;
        }
        return $rooms;
    }

    public static function setSiteRooms($SiteID, $RoomID)
    {

        global $conn;

        if (!empty($_GET['delRoom'])) {
            $conn->query("DELETE FROM rooms
                          WHERE SiteID = $SiteID AND
                          RoomID = $RoomID AND
                          NOT EXISTS(SELECT InterviewID FROM interviews WHERE RoomID = $RoomID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta sala deoarece este deja alocata pentru interviuri!'); window.location.href = './?m=dictionary&o=sites&SiteID=$SiteID';\"></body>";
                exit;
            }
        }

        if (!empty($_GET['Room']) && trim($_GET['Room'])) {
            if ($RoomID > 0) {
                $conn->query("UPDATE rooms SET Room = '" . trim($_GET['Room']) . "', Notes = '" . trim($_GET['Notes']) . "' WHERE RoomID = $RoomID AND SiteID = $SiteID");
            } else {
                $conn->query("INSERT INTO rooms(SiteID, Room, Notes, CreateDate) VALUES($SiteID, '" . trim($_GET['Room']) . "', '" . trim($_GET['Notes']) . "', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SITE'));
            }
        }
    }

    public static function getSitesByRooms()
    {

        global $conn;

        $conn->query("SELECT b.RoomID, CONCAT(a.Site, ' - ', b.Room) AS Room
                      FROM   sites a INNER JOIN rooms b ON a.SiteID = b.SiteID
                      ORDER  BY a.Site, b.Room");
        $rooms = array();
        while ($row = $conn->fetch_array()) {
            $rooms[$row['RoomID']] = $row['Room'];
        }
        return $rooms;
    }

    public static function getLanguages()
    {

        global $conn;

        $conn->query("SELECT LangID, Language FROM languages ORDER BY Language");
        $langs = array();
        while ($row = $conn->fetch_array()) {
            $langs[$row['LangID']] = $row['Language'];
        }
        return $langs;
    }

    public static function getCostCenter()
    {

        global $conn;

        $conn->query("SELECT CostCenterID, CostCenter FROM costcenter WHERE Status = 1 ORDER BY CostCenter");
        $costcenter = array();
        while ($row = $conn->fetch_array()) {
            $costcenter[$row['CostCenterID']] = $row['CostCenter'];
        }
        return $costcenter;
    }

    public static function getCostCenterAdmin()
    {

        global $conn;

        $conn->query("SELECT CostCenterID, CostCenter, Status FROM costcenter ORDER BY CostCenter");
        $costcenter = array();
        while ($row = $conn->fetch_array()) {
            $costcenter[$row['CostCenterID']] = $row;
        }
        return $costcenter;
    }

    public static function newCostCenter($CostCenterID)
    {

        global $conn;

        if ($CostCenterID > 0 && !empty($_GET['delCostCenter'])) {
            $conn->query("DELETE FROM costcenter
                          WHERE  CostCenterID = $CostCenterID AND
                                 NOT EXISTS(SELECT CostCenterID FROM payroll WHERE CostCenterID = $CostCenterID) AND
                                 NOT EXISTS(SELECT CostCenterID FROM jobs WHERE CostCenterID = $CostCenterID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest centru de cost deoarece este deja utilizat!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=dictionary&o=costcenter';\"></body>";
                exit;
            }

        } else {

            $CostCenter = Utils::formatStr($_GET['CostCenter']);

            if ($CostCenterID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE costcenter SET CostCenter = '$CostCenter', Status = $Status WHERE CostCenterID = $CostCenterID");
            } else {
                $conn->query("INSERT INTO costcenter(CostCenter, CreateDate) VALUES('$CostCenter', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_COST'));
            }
        }
    }

    public static function formatStr($str)
    {
        return trim(get_magic_quotes_gpc() ? $str : addslashes($str));
    }

    public static function getDepartments()
    {

        global $conn;

        $cond = !empty($_GET['DivisionID']) ? " AND DivisionID = " . (int)$_GET['DivisionID'] : "";

        $conn->query("SELECT DepartmentID, Department FROM departments WHERE Status = 1 $cond ORDER BY Department");
        $departments = array();
        while ($row = $conn->fetch_array()) {
            $departments[$row['DepartmentID']] = $row['Department'];
        }
        return $departments;
    }

    public static function getDepartmentsAdmin()
    {

        global $conn;

        $cond = !empty($_GET['DivisionID']) ? " WHERE DivisionID = " . (int)$_GET['DivisionID'] : "";

        $conn->query("SELECT DepartmentID, DivisionID, Department, Code, Status FROM departments $cond ORDER BY Department");
        $departments = array();
        while ($row = $conn->fetch_array()) {
            $departments[$row['DepartmentID']] = $row;
        }
        return $departments;
    }

    public static function getSubDepartments()
    {

        global $conn;

        $cond = !empty($_GET['DepartmentID']) ? " AND DepartmentID = " . (int)$_GET['DepartmentID'] : "";

        $conn->query("SELECT SubDepartmentID, SubDepartment FROM subdepartments WHERE Status = 1 $cond ORDER BY SubDepartment");
        $subdepartments = array();
        while ($row = $conn->fetch_array()) {
            $subdepartments[$row['SubDepartmentID']] = $row['SubDepartment'];
        }
        return $subdepartments;
    }

    public static function getSubDepartmentsAdmin()
    {

        global $conn;

        $conn->query("SELECT * FROM subdepartments ORDER BY SubDepartment");
        $subdepartments = array();
        while ($row = $conn->fetch_array()) {
            $subdepartments[$row['SubDepartmentID']] = $row;
        }
        return $subdepartments;
    }

    public static function getSubSubDepartments()
    {

        global $conn;

        $cond = !empty($_GET['SubDepartmentID']) ? " AND SubDepartmentID = " . (int)$_GET['SubDepartmentID'] : "";

        $conn->query("SELECT SubSubDepartmentID, SubSubDepartment FROM subsubdepartments WHERE Status = 1 $cond ORDER BY SubSubDepartment");
        $subsubdepartments = array();
        while ($row = $conn->fetch_array()) {
            $subsubdepartments[$row['SubSubDepartmentID']] = $row['SubSubDepartment'];
        }
        return $subsubdepartments;
    }

    public static function getSubSubDepartmentsAdmin()
    {

        global $conn;

        $conn->query("SELECT * FROM subsubdepartments ORDER BY SubSubDepartment");
        $subdepartments = array();
        while ($row = $conn->fetch_array()) {
            $subdepartments[$row['SubSubDepartmentID']] = $row;
        }
        return $subdepartments;
    }

    public static function newDepartment($DepartmentID)
    {

        global $conn;

        if ($DepartmentID > 0 && !empty($_GET['delDepartment'])) {
            $conn->query("DELETE FROM departments
                          WHERE  DepartmentID = $DepartmentID AND
                                 NOT EXISTS(SELECT DepartmentID FROM payroll WHERE DepartmentID = $DepartmentID) AND
                                 NOT EXISTS(SELECT DepartmentID FROM jobs WHERE DepartmentID = $DepartmentID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest departament deoarece este deja utilizat!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=dictionary&o=department';\"></body>";
                exit;
            }

        } else {

            $Department = Utils::formatStr($_GET['Department']);
            $Code = Utils::formatStr($_GET['Code']);
            $DivisionID = (int)$_GET['DivisionID'];

            if ($DepartmentID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE departments SET Department = '$Department', Code = '$Code', DivisionID = $DivisionID, Status = $Status WHERE DepartmentID = $DepartmentID");
                if (!empty($_GET['uphis'])) {
                    $conn->query("UPDATE payroll SET DivisionID = $DivisionID WHERE DepartmentID = $DepartmentID");
                }
            } else {
                $conn->query("INSERT INTO departments(Department, Code, DivisionID, CreateDate) VALUES('$Department', '$Code', $DivisionID, CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DEP'));
            }
        }
    }

    public static function newSubDepartment($SubDepartmentID)
    {

        global $conn;

        if ($SubDepartmentID > 0 && !empty($_GET['delSubDepartment'])) {
            $conn->query("DELETE FROM subdepartments
                          WHERE  SubDepartmentID = $SubDepartmentID AND
                                 NOT EXISTS(SELECT SubDepartmentID FROM payroll WHERE SubDepartmentID = $SubDepartmentID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest subdepartament deoarece este deja utilizat!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=dictionary&o=subdepartment';\"></body>";
                exit;
            }

        } else {

            $SubDepartment = Utils::formatStr($_GET['SubDepartment']);
            $Code = Utils::formatStr($_GET['Code']);
            $DepartmentID = (int)$_GET['DepartmentID'];

            if ($SubDepartmentID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE subdepartments SET SubDepartment = '$SubDepartment', Code = '$Code', DepartmentID = $DepartmentID, Status = $Status WHERE SubDepartmentID = $SubDepartmentID");

            } else {
                $conn->query("INSERT INTO subdepartments(SubDepartment, Code, DepartmentID, CreateDate) VALUES('$SubDepartment', '$Code', $DepartmentID, CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function newSubSubDepartment($SubSubDepartmentID)
    {

        global $conn;

        if ($SubSubDepartmentID > 0 && !empty($_GET['delSubSubDepartment'])) {
            $conn->query("DELETE FROM subsubdepartments
                          WHERE  SubSubDepartmentID = $SubSubDepartmentID AND
                                 NOT EXISTS(SELECT SubSubDepartmentID FROM payroll WHERE SubSubDepartmentID = $SubSubDepartmentID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest subdepartament deoarece este deja utilizat!\\nVa recomandam inactivarea lui!'); window.location.href = './?m=dictionary&o=subsubdepartment';\"></body>";
                exit;
            }

        } else {

            $SubSubDepartment = Utils::formatStr($_GET['SubSubDepartment']);
            $Code = Utils::formatStr($_GET['Code']);
            $SubDepartmentID = (int)$_GET['SubDepartmentID'];

            if ($SubSubDepartmentID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE subsubdepartments SET SubSubDepartment = '$SubSubDepartment', Code = '$Code', SubDepartmentID = $SubDepartmentID, Status = $Status WHERE SubSubDepartmentID = $SubSubDepartmentID");

            } else {
                $conn->query("INSERT INTO subsubdepartments(SubSubDepartment, Code, SubDepartmentID, CreateDate) VALUES('$SubSubDepartment', '$Code', $SubDepartmentID, CURRENT_TIMESTAMP)");
            }
        }
    }

    public static function getDivisions()
    {

        global $conn;

        $conn->query("SELECT DivisionID, Division FROM divisions WHERE Status = 1 ORDER BY Division");
        $divisions = array();
        while ($row = $conn->fetch_array()) {
            $divisions[$row['DivisionID']] = $row['Division'];
        }
        return $divisions;
    }

    public static function getDivisionsAdmin()
    {

        global $conn;

        $conn->query("SELECT DivisionID, Division, Code, Status FROM divisions ORDER BY Division");
        $divisions = array();
        while ($row = $conn->fetch_array()) {
            $divisions[$row['DivisionID']] = $row;
        }
        return $divisions;
    }

    public static function newDivision($DivisionID)
    {

        global $conn;

        if ($DivisionID > 0 && !empty($_GET['delDivision'])) {
            $conn->query("DELETE FROM divisions
                          WHERE  DivisionID = $DivisionID AND
                                 NOT EXISTS(SELECT DivisionID FROM departments WHERE DivisionID = $DivisionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta divizie deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=department';\"></body>";
                exit;
            }

        } else {

            $Division = Utils::formatStr($_GET['Division']);
            $Code = Utils::formatStr($_GET['Code']);

            if ($DivisionID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE divisions SET Division = '$Division', Code = '$Code', Status = $Status WHERE DivisionID = $DivisionID");
            } else {
                $conn->query("INSERT INTO divisions(Division, Code, CreateDate) VALUES('$Division', '$Code', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DIV'));
            }
        }
    }

    public static function newSalesSource($SourceID)
    {

        global $conn;

        if ($SourceID > 0 && !empty($_GET['delSource'])) {
            $conn->query("DELETE FROM sales_sources
                          WHERE  SourceID = $SourceID AND
                                 NOT EXISTS(SELECT SourceID FROM activities_det WHERE SourceID = $SourceID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta sursa deoarece este deja utilizata!\\nVa recomandam inactivarea sa!'); window.location.href = './?m=admin&o=sales_source';\"></body>";
                exit;
            }

        } else {

            $Name = Utils::formatStr($_GET['Name']);
            $Status = !empty($_GET['Status']) ? 1 : 0;
            if ($SourceID > 0) {
                $conn->query("UPDATE sales_sources SET Name = '$Name', Status = $Status WHERE SourceID = $SourceID");
            } else {
                $conn->query("INSERT INTO sales_sources(Name, Status) VALUES('$Name', 1)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SALES_SOURCE'));
            }
        }
    }

    public static function getSalesSources($all = true)
    {

        global $conn;
        if (!$all) $cond = " WHERE Status=1 ";
        $conn->query("SELECT * FROM sales_sources $cond ORDER BY SourceID");
        $res = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['SourceID']] = $row;
        }
        //Utils::pa($res);
        return $res;
    }

    public static function newSalesStage($StageID)
    {

        global $conn;

        if ($StageID > 0 && !empty($_GET['delStage'])) {
            $conn->query("DELETE FROM sales_stages
                          WHERE  StageID = $StageID AND
                                 NOT EXISTS(SELECT StageID FROM activities_det WHERE StageID = $StageID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceast stadiu deoarece este deja utilizat!\\nVa recomandam inactivarea sa!'); window.location.href = './?m=admin&o=sales_stage';\"></body>";
                exit;
            }

        } else {

            $Name = Utils::formatStr($_GET['Name']);
            $Status = !empty($_GET['Status']) ? 1 : 0;
            if ($StageID > 0) {
                $conn->query("UPDATE sales_stages SET Name = '$Name', Status = $Status WHERE StageID = $StageID");
            } else {
                $conn->query("INSERT INTO sales_stages(Name, Status) VALUES('$Name', 1)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_SALES_STAGE'));
            }
        }
    }

    public static function getSalesStages($all = true)
    {

        global $conn;
        if (!$all) $cond = " WHERE Status=1 ";
        $conn->query("SELECT * FROM sales_stages $cond ORDER BY StageID");
        $res = array();
        while ($row = $conn->fetch_array()) {
            $res[$row['StageID']] = $row;
        }
        return $res;
    }

    public static function getFunctions()
    {

        global $conn;

        $conn->query("SET NAMES utf8");
        $conn->query("SELECT FunctionID, Function, COR FROM functions WHERE Status = 1 ORDER BY Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function getFunctionsAdmin()
    {

        global $conn;

        $conn->query("SET NAMES utf8");
        $conn->query("SELECT FunctionID, Function, COR, Status FROM functions ORDER BY Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function newFunction($FunctionID)
    {

        global $conn;

        if ($FunctionID > 0 && !empty($_GET['delFunction'])) {
            $conn->query("DELETE FROM functions
                          WHERE  FunctionID = $FunctionID AND
                                 NOT EXISTS(SELECT FunctionID FROM payroll WHERE FunctionID = $FunctionID) AND
                                 NOT EXISTS(SELECT FunctionID FROM jobs WHERE FunctionID = $FunctionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta functie deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=function';\"></body>";
                exit;
            }

        } else {

            if ($FunctionID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE functions SET Status = $Status WHERE FunctionID = $FunctionID");
            } else {
                $conn->query("INSERT INTO functions(Function, COR, CreateDate) SELECT Nume, Cod, CURRENT_TIMESTAMP FROM nom_cor WHERE Cod = '{$_GET['Cor']}'");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_FUNC'));
            }
        }
    }

    public static function getFunctionsRecr()
    {

        global $conn;

        $conn->query("SELECT FunctionID, Function FROM functions_recr WHERE Status = 1 ORDER BY Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = stripslashes($row['Function']);
        }
        return $functions;
    }

    public static function getFunctionsRecrAdmin()
    {

        global $conn;

        $conn->query("SELECT * FROM functions_recr ORDER BY Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function newFunctionRecr($FunctionID)
    {

        global $conn;

        if ($FunctionID > 0 && !empty($_GET['delFunction'])) {
            $conn->query("DELETE FROM functions_recr
                          WHERE  FunctionID = $FunctionID AND
                                 NOT EXISTS(SELECT FunctionIDRecr FROM persons_prof WHERE FunctionIDRecr = $FunctionID) AND
                                 NOT EXISTS(SELECT FunctionIDRecr FROM jobs WHERE FunctionIDRecr = $FunctionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta functie deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=function_recr';\"></body>";
                exit;
            }

        } else {

            $Function = Utils::formatStr($_GET['Function']);

            if ($FunctionID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE functions_recr SET Function = '".$Function."', 
                          FunctionType = '".$_GET['FunctionType']."',
                          GradTreapta = '".$_GET['GradTreapta']."',
                          Studii = '".$_GET['Studii']."',
                          Gradatie = '".$_GET['Gradatie']."',
                          Coeficient = '".$_GET['Coeficient']."',
                          Status = $Status WHERE FunctionID = $FunctionID");
            } else {
                $conn->query("INSERT INTO functions_recr(Function, FunctionType, GradTreapta, Studii, Gradatie, Coeficient, CreateDate) VALUES('$Function', '".$_GET['FunctionType']."', '".$_GET['GradTreapta']."', '".$_GET['Studii']."', '".$_GET['Gradatie']."', '".$_GET['Coeficient']."', CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_FUNC'));
            }
        }
    }

    public static function getInternalFunctions()
    {

        global $conn;

        $conn->query("SELECT FunctionID, Function, FunctionObs FROM internal_functions WHERE Status = 1 ORDER BY Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = $row['Function'] . ($row['FunctionObs'] != '' ? '&nbsp;&nbsp;(' . $row['FunctionObs'] . ')' : '');
        }
        return $functions;
    }

    public static function getCustomFields()
    {

        global $conn;

        $customfields = array();

        $conn->query("SELECT CustomField, FieldLabel FROM custom_fields");
        while ($row = $conn->fetch_array()) {
            $customfields[$row['CustomField']] = $row['FieldLabel'];
        }

        return $customfields;
    }

    public static function getCustomFieldsData()
    {
        global $conn;
        $data = array();
        $conn->query("select DISTINCT (CustomPerson1) from persons");
        while ($row = $conn->fetch_array()) {
            $data[] = $row['CustomPerson1'];
        }
        return $data;
    }

    public static function setCustomFields()
    {

        global $conn;

        $conn->query("DELETE FROM custom_fields");

        foreach ($_POST as $k => $v) {
            $v = Utils::formatStr($v);
            if ($v) {
                $conn->query("INSERT INTO custom_fields(UserID, CustomField, FieldLabel) VALUES({$_SESSION['USER_ID']}, '$k', '$v')");
            }
        }
    }

    public static function getCustomFieldValues($table, $field)
    {
        global $conn;
        $values = array();
        $conn->query("SELECT DISTINCT {$field} AS field FROM {$table} WHERE {$field} > ''");
        while ($row = $conn->fetch_array()) {
            $values[] = stripslashes($row['field']);
        }
        return $values;
    }

    public static function getPersonalisedList($module = '')
    {

        global $conn;

        $personalisedlist = array();

        $conn->query("SELECT Module, Field, Label
    		              FROM   personalised_list
    		              WHERE  UserID = '" . $_SESSION['USER_ID'] . "'" . (!empty($module) ? " AND Module = '$module'" : "") . "
    		              ORDER  BY ID");
        while ($row = $conn->fetch_array()) {
            $personalisedlist[$row['Module']][$row['Field']] = $row['Label'];
        }

        return $personalisedlist;
    }

    public static function setPersonalisedList()
    {

        global $conn;

        if (!empty($_POST['personal'])) {
            $module = 'Personal';
        } elseif (!empty($_POST['company'])) {
            $module = 'Company';
        } elseif (!empty($_POST['job'])) {
            $module = 'Job';
        } elseif (!empty($_POST['event'])) {
            $module = 'Event';
        } elseif (!empty($_POST['training'])) {
            $module = 'Training';
        } elseif (!empty($_POST['performance'])) {
            $module = 'Performance';
        } elseif (!empty($_POST['eval'])) {
            $module = 'Eval';
        } elseif (!empty($_POST['pontaj'])) {
            $module = 'Pontaj';
        } elseif (!empty($_POST['contract'])) {
            $module = 'Contract';
        } elseif (!empty($_POST['activity'])) {
            $module = 'Activity';
        } elseif (!empty($_POST['daily'])) {
            $module = 'Daily';
        } elseif (!empty($_POST['ofertare'])) {
            $module = 'Ofertare';
        } elseif (!empty($_POST['car'])) {
            $module = 'Car';
        } elseif (!empty($_POST['ticket'])) {
            $module = 'Ticket';
        } elseif (!empty($_POST['ticketing'])) {
            $module = 'Ticketing';
        } elseif (!empty($_POST['candidate'])) {
            $module = 'Candidate';
        } elseif (!empty($_POST['carsheet'])) {
            $module = 'CarSheet';
        } elseif (!empty($_POST['carcost'])) {
            $module = 'CarCost';
        } elseif (!empty($_POST['product'])) {
            $module = 'Product';
        }

        $conn->query("DELETE FROM personalised_list WHERE UserID = {$_SESSION['USER_ID']} AND Module = '$module'");

        if (!empty($_POST[$module]))
            foreach ($_POST[$module] as $k => $v) {
                $conn->query("INSERT INTO personalised_list(UserID, Module, Field, Label) VALUES({$_SESSION['USER_ID']}, '$module', '$v', '{$_POST['Label'][$v]}')");
            }
    }

    public static function getReports()
    {

        global $conn;

        $cond = "";

        if (!empty($_GET['GroupID']))
            $cond .= " AND GroupID = '{$_GET['GroupID']}'";

        if (!empty($_GET['Type']))
            $cond .= " AND Type = '{$_GET['Type']}'";


        $reports = array();

        $conn->query("SELECT * FROM reports WHERE Status=1 $cond ORDER BY ReportID");
        while ($row = $conn->fetch_array()) {
            $reports[] = $row;
        }

        return $reports;
    }

    public static function getReportRights($ReportID)
    {

        global $conn;

        $rights = array();

        $conn->query("SELECT UserID, UserName, UserType FROM users WHERE UserID > 1 ORDER BY UserName");
        while ($row = $conn->fetch_array()) {
            $rights[$row['UserType']][$row['UserID']] = $row['UserName'];
        }

        $conn->query("SELECT * FROM reports WHERE Status=1 AND ReportID = $ReportID");
        while ($row = $conn->fetch_array()) {
            $rights['report']['name'] = $row['Report'];
            $rights['report']['groupid'] = $row['GroupID'];
            $rights['report']['Type'] = $row['Type'];
            $rights['report']['rights'] = !empty($row['Rights']) ? unserialize($row['Rights']) : '';
        }

        return $rights;
    }

    public static function setReportRights($ReportID)
    {

        global $conn;

        $conn->query("UPDATE reports SET Report = '" . $conn->real_escape_string($_POST['ReportName']) . "', GroupID = '{$_POST['GroupID']}', Type = '{$_POST['Type']}', Rights = '" . (!empty($_POST['rights']) ? serialize($_POST['rights']) : '') . "' WHERE ReportID = $ReportID");
    }

    public static function allocReportRights()
    {
        global $conn;
        $reports = str_replace('|', ',', substr($_POST['reports'], 1, -1));
        $conn->query("UPDATE reports SET GroupID = '{$_POST['GroupID']}', Type = '{$_POST['Type']}', Rights = '" . (!empty($_POST['rights']) ? serialize($_POST['rights']) : '') . "' WHERE ReportID IN ($reports)");
    }

    public static function getReportGroups()
    {

        global $conn;

        $groups = array();

        $conn->query("SELECT GroupID, GroupName FROM reports_groups ORDER BY GroupName");
        while ($row = $conn->fetch_array()) {
            $groups[$row['GroupID']] = $row['GroupName'];
        }

        return $groups;
    }

    public static function setReportGroup()
    {

        global $conn;

        switch ($_GET['action']) {
            case 'new':
                $conn->query("INSERT INTO reports_groups(GroupName, CreateDate) VALUES('" . Utils::formatStr($_GET['GroupName']) . "', CURRENT_TIMESTAMP)");
                break;
            case 'edit':
                $conn->query("UPDATE reports_groups SET GroupName = '" . Utils::formatStr($_GET['GroupName']) . "' WHERE GroupID = '" . (int)$_GET['GroupID'] . "'");
                break;
            case 'del':
                $conn->query("DELETE FROM reports_groups WHERE GroupID = '" . (int)$_GET['GroupID'] . "'");
                break;
        }
    }

    public static function getLibraryCats($PCatID = 0)
    {

        global $conn;

        $conn->query("SELECT CatID, Name, Descr FROM library_categories WHERE PCatID = $PCatID ORDER BY Name");
        $cats = array();
        while ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $row['Descr'] = stripslashes($row['Descr']);
            $cats[$row['CatID']] = $row;
        }
        return $cats;
    }

    public static function setLibraryCat($CatID = 0, $PCatID = 0)
    {

        global $conn, $smarty;

        if (!empty($_GET['delCat']) && $CatID > 0) {
            $conn->query("SELECT CatID 
	                  FROM   library_categories
                          WHERE  CatID = $CatID AND 
			         NOT EXISTS (SELECT CatID FROM library_categories WHERE PCatID = $CatID) AND
			         NOT EXISTS (SELECT DocID FROM library_documents WHERE CatID = $CatID)");
            if (!$conn->get_affected_rows()) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Nu se poate sterge aceasta categorie / subcategorie deoarece contine subcategorii / documente'), $smarty) . "!'); window.location.href = './?m=dictionary&o=library';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM library_categories WHERE CatID = $CatID");
                header('Location: ./?m=dictionary&o=library&CatID=' . $PCatID);
                exit;
            }
        }

        if (!empty($_GET['Name']) && trim($_GET['Name'])) {
            if ($CatID > 0) {
                $conn->query("UPDATE library_categories SET Name = '" . trim($_GET['Name']) . "', Descr = '" . trim($_GET['Descr']) . "' WHERE CatID = $CatID");
            } else {
                $conn->query("INSERT INTO library_categories(Name, Descr, PCatID, CreateDate) VALUES('" . trim($_GET['Name']) . "', '" . trim($_GET['Descr']) . "', $PCatID, CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_CAT'));
            }
        }
    }

    public static function getAlerte()
    {

        global $conn;

        $conn->query("SELECT * FROM alert ORDER BY ID");
        $alert = array();
        while ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $row['Subject'] = stripslashes($row['Subject']);
            $row['Body'] = stripslashes($row['Body']);
            $row['FromAlias'] = stripslashes($row['FromAlias']);
            $row['AlertDate'] = Utils::toDBDateTime($row['AlertDate']);
            $row['Settings'] = !empty($row['Settings']) ? unserialize($row['Settings']) : '';
            $alert[$row['ID']] = $row;
        }
        return $alert;
    }

    public static function toDBDateTime($string)
    {
        $parts = explode(' ', $string);
        $parts2 = explode('.', $parts[0]);
        return $parts2[2] . '-' . $parts2[1] . '-' . $parts2[0] . ' ' . $parts[1];
    }

    public static function getAlertAuxEmails($ID)
    {

        global $conn;

        $conn->query("SELECT ToAuxEmails FROM alert WHERE ID=$ID");
        $emails_arr = array();
        $row = $conn->fetch_array();
        $emails = stripslashes($row['ToAuxEmails']);
        if ($emails != '')
            $emails_arr = explode(';', $emails);

        return $emails_arr;
    }

    public static function setAlerte($ID)
    {
        global $conn;
        $conn->query("UPDATE alert SET
	                                Active    = '" . (!empty($_POST['Active']) ? 1 : 0) . "',
	                                Subject   = '" . Utils::formatStr($_POST['Subject']) . "',
	                                Body      = '" . Utils::formatStr($_POST['Body']) . "',
	                                FromEmail = '" . Utils::formatStr($_POST['FromEmail']) . "',
	                                FromAlias = '" . Utils::formatStr($_POST['FromAlias']) . "',
	                                ToAuxEmails = '" . Utils::formatStr($_POST['ToAuxEmails']) . "',
                                        ToSelf      = '" . (!empty($_POST['ToSelf']) ? 1 : 0) . "',
					Type      = '" . $_POST['Type'] . "',
					AlertDate = '" . Utils::toDBDateTime($_POST['AlertDate']) . "',
					Settings  = '" . serialize($_POST['settings']) . "'
		      WHERE id = $ID");
    }

    public static function getLocalitatiByCV()
    {
        global $conn;
        $localitati = array();
        $conn->query("SELECT DISTINCT City FROM persons_prof WHERE City > '' ORDER BY City");
        while ($row = $conn->fetch_array()) {
            $localitati[] = $row['City'];
        }
        return $localitati;
    }

    public static function getTariByCV()
    {
        global $conn;
        $tari = array();
        $conn->query("SELECT DISTINCT Country FROM persons_prof WHERE Country > '' ORDER BY Country");
        while ($row = $conn->fetch_array()) {
            $tari[] = $row['Country'];
        }
        return $tari;
    }

    public static function getAppStyles()
    {
        global $conn;
        $styles = array();
        $conn->query("SELECT * FROM styles");
        while ($row = $conn->fetch_array()) {
            $styles[$row['StyleID']] = $row;
        }
        return $styles;
    }

    public static function getAppStyle()
    {
        global $conn;
        $conn->query("SELECT * FROM styles WHERE Status=1");
        $row = $conn->fetch_array();

        return $row;
    }

    public static function setAppStyle($StyleID)
    {
        global $conn;
        $styles = array();
        $conn->query("UPDATE styles SET Status=0");

        $conn->query("UPDATE styles SET Status=1 WHERE StyleID=$StyleID");

    }

    public static function getTheme()
    {
        global $conn;
        $theme = 'style2.css';
        $conn->query("SELECT * FROM styles WHERE Status = 1");
        $row = $conn->fetch_array();
        if ($row['File'] != '')
            $theme = $row['File'];
        return $theme;
    }

    public static function _debug()
    {
        $vars = func_get_args();
        $return = ($vars[count($vars) - 1] === 'DEBUG_RETURN');
        $verPeste4_3 = (phpversion() >= '4.3.0');

        if ($verPeste4_3 && $return)
            $output = "<pre>._";
        else
            print "<pre>._";

        foreach ($vars as $i => $var) {
            if ($return && $i == count($vars) - 1)
                break;
            if ($verPeste4_3 && $return)
                $output .= "<br>" . print_r($var, true);
            else {
                print "<br>";
                print_r($var);
            }
        }

        if ($verPeste4_3 && $return)
            return $output . "_.</pre>";
        else
            print "_.</pre>";
    }

    public static function getMeasurementUnits()
    {
        global $conn;

        $units = array();
        $conn->query("SELECT * FROM measurement_units ORDER BY Unit");
        while ($row = $conn->fetch_array()) {
            $units[$row['UnitID']] = $row;
        }
        return $units;
    }

    public static function setMeasurementUnit($UnitID)
    {
        global $conn;

        if (!empty($UnitID)) {
            if (!empty($_GET['delUnit'])) {
                $conn->query("DELETE FROM measurement_units WHERE UnitID = '{$UnitID}'");
            } else {
                $conn->query("UPDATE measurement_units SET Unit = '" . $conn->real_escape_string($_GET['Unit']) . "' WHERE UnitID = '{$UnitID}'");
            }
        } else {
            $conn->query("INSERT INTO measurement_units(Unit, CreateDate) VALUES('" . $conn->real_escape_string($_GET['Unit']) . "', CURRENT_TIMESTAMP)");
        }

    }

    public static function getGroupFunctionsAdmin()
    {

        global $conn;

        $cond = !empty($_GET['GroupID']) ? " WHERE GroupID = " . (int)$_GET['GroupID'] : "";

        $conn->query("SELECT FunctionID, a.GroupID, Function, FunctionObs, a.Status FROM internal_functions a
        				LEFT JOIN function_groups b ON a.GroupID=b.GroupID $cond ORDER BY Grad,Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function newGroupFunction($FunctionID)
    {

        global $conn;

        if ($FunctionID > 0 && !empty($_GET['delFunction'])) {
            $conn->query("DELETE FROM internal_functions
                          WHERE  FunctionID = $FunctionID AND
                                 NOT EXISTS(SELECT InternalFunction FROM payroll WHERE InternalFunction = $FunctionID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta functie deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=function_group';\"></body>";
                exit;
            }

        } else {

            $Function = Utils::formatStr($_GET['Function']);
            $FunctionObs = Utils::formatStr($_GET['FunctionObs']);
            $GroupID = (int)$_GET['GroupID'];

            if ($FunctionID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE internal_functions SET Function = '$Function', FunctionObs = '$FunctionObs', GroupID = $GroupID, Status = $Status WHERE FunctionID = $FunctionID");
            } else {
                $conn->query("INSERT INTO internal_functions(Function, FunctionObs, GroupID, CreateDate) VALUES('$Function', '$FunctionObs', $GroupID, CURRENT_TIMESTAMP)");
            }
            /*
                if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DEP'));
                }
            */
        }
    }

    public static function getGroups()
    {

        global $conn;

        $conn->query("SELECT GroupID, GroupName, Grad FROM function_groups WHERE Status = 1 ORDER BY GroupName");
        $groups = array();
        while ($row = $conn->fetch_array()) {
            $groups[$row['GroupID']] = $row;
        }
        return $groups;
    }

    public static function getGroupsAdmin()
    {

        global $conn;

        $conn->query("SELECT GroupID, GroupName, Grad, Status FROM function_groups ORDER BY Grad");
        $groups = array();
        while ($row = $conn->fetch_array()) {
            $groups[$row['GroupID']] = $row;
        }
        return $groups;
    }

    public static function newGroup($GroupID)
    {

        global $conn;

        if ($GroupID > 0 && !empty($_GET['delGroup'])) {
            $conn->query("DELETE FROM function_groups
                          WHERE  GroupID = $GroupID AND
                                 NOT EXISTS(SELECT GroupID FROM internal_functions WHERE GroupID = $GroupID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta grupa de functii deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=function_group';\"></body>";
                exit;
            }

        } else {

            $Group = Utils::formatStr($_GET['Group']);
            $Grad = Utils::formatStr($_GET['Grad']);

            if ($GroupID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE function_groups SET GroupName = '$Group', Grad = '$Grad', Status = $Status WHERE GroupID = $GroupID");
            } else {
                $conn->query("INSERT INTO function_groups(GroupName, Grad, CreateDate) VALUES('$Group', '$Grad', CURRENT_TIMESTAMP)");
            }
            /*
                if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_DIV'));
                }
            */
        }
    }

    public static function getGroupFunctions($CompanyID = 0)
    {

        global $conn;

        $cond = '';
        if (!empty($CompanyID))
            $cond .= " AND c.CompanyID='" . (int)$CompanyID . "'";
        $conn->query("SELECT a.GroupID, a.GroupName, a.Grad, b.FunctionID, b.Function, b.FunctionObs, c.Positions,
        			(c.Positions-(SELECT COUNT(*) FROM payroll WHERE InternalFunction=b.FunctionID)) AS PositionsFree
	              FROM   function_groups a
		             INNER JOIN internal_functions b ON a.GroupID = b.GroupID 
		             INNER JOIN internal_functions_companies c ON b.FunctionID=c.FunctionID
		             AND b.Status = 1 AND c.Aplicable=1 $cond
		      ORDER  BY a.GroupName, b.Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['GroupID']][$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function getGroupAvailableFunctions($CompanyID = 0)
    {

        global $conn;

        $cond = '';
        if (!empty($CompanyID))
            $cond .= " AND c.CompanyID='" . (int)$CompanyID . "'";
        $conn->query("SELECT a.GroupID, a.GroupName, a.Grad, b.FunctionID, b.Function, b.FunctionObs, c.Positions,
        			(c.Positions-(SELECT COUNT(*) FROM payroll x 
        							INNER JOIN persons y ON x.PersonID=y.PersonID AND y.Status NOT IN (1,5,6,8)
        							WHERE x.InternalFunction=b.FunctionID AND x.CompanyID=c.CompanyID)) AS PositionsFree
	              FROM   function_groups a
		             INNER JOIN internal_functions b ON a.GroupID = b.GroupID 
		             INNER JOIN internal_functions_companies c ON b.FunctionID=c.FunctionID
		             AND b.Status = 1 AND c.Aplicable=1 $cond
		      ORDER  BY a.GroupName, b.Function");
        $functions = array();
        while ($row = $conn->fetch_array()) {
            $functions[$row['GroupID']][$row['FunctionID']] = $row;
        }
        return $functions;
    }

    public static function getCountries()
    {

        global $conn;

        $conn->query("SELECT CountryID, CountryName, Nationality FROM address_country WHERE Status = 1 ORDER BY CountryName");
        $countries = array();
        while ($row = $conn->fetch_array()) {
            $countries[$row['CountryID']]['CountryName'] = $row['CountryName'];
            if (!empty($row['Nationality'])) {
                $countries[$row['CountryID']]['Nationality'] = $row['Nationality'];
            }
        }
        return $countries;
    }

    public static function getCountriesAdmin()
    {

        global $conn;

        $conn->query("SELECT CountryID, CountryName, CountryCode, Nationality, Status FROM address_country ORDER BY CountryName");
        $countries = array();
        while ($row = $conn->fetch_array()) {
            $countries[$row['CountryID']] = $row;
        }
        return $countries;
    }

    public static function newCountry($CountryID)
    {

        global $conn;

        if ($CountryID > 0 && !empty($_GET['delCountry'])) {
            $conn->query("DELETE FROM address_country WHERE CountryID = $CountryID");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge aceasta tara deoarece este deja utilizata!\\nVa recomandam inactivarea ei!'); window.location.href = './?m=dictionary&o=country';\"></body>";
                exit;
            }

        } else {

            $CountryName = Utils::formatStr($_GET['CountryName']);
            $CountryCode = Utils::formatStr($_GET['CountryCode']);
            $Nationality = Utils::formatStr($_GET['Nationality']);

            if ($CountryID > 0) {
                $Status = !empty($_GET['Status']) ? 1 : 0;
                $conn->query("UPDATE address_country SET CountryName = '$CountryName', CountryCode = '$CountryCode', Nationality = '$Nationality', Status = $Status WHERE CountryID = $CountryID");
            } else {
                $conn->query("INSERT INTO address_country(CountryName, CountryCode, Nationality) VALUES('$CountryName', '$CountryCode', '$Nationality')");
            }
        }
    }

    public static function getInventar()
    {

        global $conn;

        $conn->query("SELECT * FROM inventar ORDER BY ObjID DESC");
        $inventar = array();
        while ($row = $conn->fetch_array()) {
            $inventar[$row['ObjID']] = $row;
        }
        return $inventar;
    }

    public static function setInventar($ObjID)
    {

        global $conn;

        if ($ObjID > 0 && !empty($_GET['delObj'])) {
            $conn->query("DELETE FROM inventar WHERE ObjID = $ObjID AND NOT EXISTS (SELECT ObjID FROM persons_inventar WHERE ObjID = $ObjID)");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest obiect de inventar deoarece este deja utilizat!'); window.location.href = './?m=dictionary&o=inventar';\"></body>";
                exit;
            }

        } else {

            $ObjName = Utils::formatStr($_GET['ObjName']);
            $ObjCode = Utils::formatStr($_GET['ObjCode']);
            $ObjAcqValue = Utils::formatStr($_GET['ObjAcqValue']);
            $ObjCount = Utils::formatStr($_GET['ObjCount']);
            $ObjCategory = (int)($_GET['ObjCategory']);
            $ObjAcqDate = Utils::toDBDate($_GET['ObjAcqDate']);
            $ObjNotes = Utils::formatStr($_GET['ObjNotes']);
            $Comp = (int)($_GET['Comp']);

            if ($ObjID > 0) {

                $conn->query("UPDATE inventar SET ObjName = '$ObjName', ObjCode = '$ObjCode', ObjAcqValue = '$ObjAcqValue', ObjCategory = '$ObjCategory', ObjAcqDate = '$ObjAcqDate', ObjNotes = '$ObjNotes', ObjCount = '$ObjCount', Status = '{$_GET['Status']}', CompanyId='$Comp' WHERE ObjID = $ObjID");

            } else {
//                echo "<pre>";
//                var_dump($_GET);
//            die("INSERT INTO inventar(ObjName, ObjCode, ObjAcqValue, ObjCategory, ObjAcqDate, ObjNotes, ObjCount, CreateDate, CompanyId) VALUES('$ObjName', '$ObjCode', '$ObjAcqValue', '$ObjCategory', '$ObjAcqDate', '$ObjNotes', '$ObjNotes''$ObjCount', CURRENT_TIMESTAMP, '$Comp')");
//                echo "</pre>";

                $conn->query("INSERT INTO inventar(
                          ObjName,
                          ObjCode,
                          ObjAcqValue,
                          ObjCategory,
                          ObjAcqDate,
                          ObjNotes,
                          ObjCount,
                          CreateDate,
                          CompanyId
                          )
                      VALUES(
                           '$ObjName',
                           '$ObjCode',
                           '$ObjAcqValue',
                           '$ObjCategory',
                           '$ObjAcqDate',
                           '$ObjNotes',
                           '$ObjCount',
                           CURRENT_TIMESTAMP,
                           '$Comp'
                       )"
                );

            }
        }
    }

    public static function toDBDate($string)
    {
        $parts = explode('.', $string);
        return $parts[2] . '-' . $parts[1] . '-' . $parts[0];
    }

    public static function getPhoneContracts()
    {
        global $conn;

        $conn->query("SELECT * FROM phone_contracts");
        $contracts = array();
        while ($row = $conn->fetch_array()) {
            $contracts[$row['ID']] = $row;
        }
        return $contracts;
    }

    public static function setPhoneContracts($ID)
    {
        global $conn;


        if ($ID > 0 && !empty($_GET['del'])) {
            $conn->query("DELETE FROM phone_contracts WHERE ID = $ID");
            if (!$conn->get_affected_rows()) {
                echo "<body onload=\"alert('Nu se poate sterge acest abonament deoarece este deja utilizat!'); window.location.href = './?m=dictionary&o=phone_contracts';\"></body>";
                exit;
            }

        } else {

            $data['PhoneNo'] = $_GET['PhoneNo'];
            $data['ContractType'] = $_GET['ContractType'];
            $data['MinuteGrup'] = $_GET['MinuteGrup'];
            $data['MinuteNationale'] = $_GET['MinuteNationale'];
            $data['MinuteAlte'] = $_GET['MinuteAlte'];
            $data['MinuteInternationale'] = $_GET['MinuteInternationale'];
            $data['SMSRetea'] = $_GET['SMSRetea'];
            $data['SMSNat'] = $_GET['SMSNat'];
            $data['TraficNational'] = $_GET['TraficNational'];
            $data['RoamingVoce'] = $_GET['RoamingVoce'];
            $data['RoamingTrafic'] = $_GET['RoamingTrafic'];
            $data['PrelungireAchizitie'] = $_GET['PrelungireAchizitie'];
            $data['Cost'] = $_GET['Cost'];


            if ($ID > 0) {
                $update = '';

                foreach ($data as $k => $v) {
                    $update .= (!empty($update) ? "," : "") . "$k = '" . $conn->real_escape_string($v) . "'";
                }

                $conn->query("UPDATE phone_contracts SET $update WHERE ID = $ID");
            } else {
                $table = '';
                $values = '';
                foreach ($data as $k => $v) {
                    $table .= (!empty($table) ? "," : "") . "$k";
                    $values .= (!empty($values) ? "," : "") . "'" . $conn->real_escape_string($v) . "'";
                }

                $conn->query("INSERT INTO phone_contracts($table, CreateDate) VALUES($values, CURRENT_TIMESTAMP)");
            }
        }

    }

    public static function getGrila($company_id = 0)
    {

        global $conn;

        $conn->query("SELECT * FROM vacations_seniority WHERE company_id = $company_id ORDER BY max_seniority");
        $grila = array();
        while ($row = $conn->fetch_array()) {
            $grila[$row['id']] = $row;
        }
        return $grila;
    }

    public static function setGrila($ID)
    {

        global $conn;

        if ($ID > 0 && !empty($_GET['delGrila'])) {

            $conn->query("DELETE FROM vacations_seniority WHERE id = $ID");

        } else {

            $max_seniority = (float)$_GET['max_seniority'];
            $days = (int)$_GET['days'];
            $max_rep_days = (int)$_GET['max_rep_days'];
            $rep_day_limit = (int)$_GET['rep_day_limit'];
            $rep_month_limit = (int)$_GET['rep_month_limit'];

            if ($ID > 0) {
                $conn->query("UPDATE vacations_seniority SET company_id = '{$_GET['company_id']}', max_seniority = '$max_seniority', days = '$days', max_rep_days = '$max_rep_days', rep_day_limit = '$rep_day_limit', rep_month_limit = '$rep_month_limit' WHERE id = $ID");
            } else {
                $conn->query("INSERT INTO vacations_seniority(company_id, max_seniority, days) VALUES('{$_GET['company_id']}', '$max_seniority', '$days')");
            }
        }
    }

    public static function get_months($date1, $date2)
    {
        $time1 = strtotime($date1);
        $time2 = strtotime($date2);
        $my = date('mY', $time2);

        $months = array(date('Y-m', $time1));

        while ($time1 < $time2) {
            $time1 = strtotime(date('Y-m', $time1) . ' +1 month');
            if (date('mY', $time1) != $my && ($time1 < $time2))
                $months[] = date('Y-m', $time1);
        }

        $months[] = date('Y-m', $time2);
        return $months;
    }

    ###  Budget Report Functions

    public static function countDaysInMonth($yearMonth)
    {
        // user 2010-01 format for month
        $arr = explode('-', $yearMonth);
        $days = cal_days_in_month(CAL_GREGORIAN, $arr[1], $arr[0]);
        return $days;
    }

    public static function countWorkdaysInMonth($yearMonth, $holidays = array())
    {
        $first = strtotime($yearMonth) . '-01';
        // The first day of the month is also the first day of the
        // remaining days after whole weeks are handled.
        list($first_day, $days) = explode(' ', date('w t', $first));
        $weekdays = 20;

        if ($days == 28)
            return $weekdays; // Only happens most Februarys

        $weekdays += $days - 29;
        // Neither starts on Sunday nor ends on Saturday
        if ($first_day != 0 && ($first_day + $days - 1) % 7 != 6) { // Adjust for weekend days.
            $weekdays += ($days <= 34 - $first_day) - ($days > 34 - $first_day);
        }

        // Substract the holidays
        $cnt = 0;
        if (is_array($holidays)) {
            foreach ($holidays as $holiday) {
                if (strrpos($holiday, $yearMonth) !== false)
                    $cnt++;
            }
        }
        return $weekdays - $cnt;
    }

    public static function listWorkdays($datei, $datef, $holidays = array())
    {

        $day = 60 * 60 * 24;

        $date1 = strtotime($datei);
        $date2 = strtotime($datef);

        $days_diff = round(($date2 - $date1) / $day); // Unix time difference devided by 1 day to get total days in between

        $dates_array = array();

        if (!empty($holidays)) {
            if (!in_array($datei, $holidays))
                $dates_array[] = $datei;
        } else
            $dates_array[] = $datei;

        for ($x = 1; $x < $days_diff; $x++) {
            if (date('N', ($date1 + ($day * $x))) != 6 && date('N', ($date1 + ($day * $x))) != 7 && !in_array(date('Y-m-d', ($date1 + ($day * $x))), $holidays))
                $dates_array[] = date('Y-m-d', ($date1 + ($day * $x)));
        }

        if (!empty($holidays)) {
            if (!in_array($datef, $holidays))
                $dates_array[] = $datef;
        } else
            $dates_array[] = $datef;

        return $dates_array;
    }

    public static function quarterByDate($date)
    {
        return (int)floor(date('m', strtotime($date)) / 3.1) + 1;
    }

    public static function listFiles($path)
    {
        //using the opendir function
        $dir_handle = @opendir($path) or die("Unable to open $path");

        while (false !== ($file = readdir($dir_handle))) {
            if ($file != "." && $file != "..") {
                //Display a list of files.
                $files[] = $file;
            }
        }


        //closing the directory
        closedir($dir_handle);
        return $files;
    }

    public static function paginate($nr_pages, $pag_current, $old_url, $grup_pag = 5)
    {
        global $smarty;

        $start = $pag_current - floor($grup_pag / 2);
        if ($start <= 0) $start = 1;

        $end = $start + $grup_pag - 1;
        if ($end > $nr_pages) $end = $nr_pages;

        if ($nr_pages - $start < $grup_pag) $start = $nr_pages - $grup_pag + 1;

        if ($start <= 0) $start = 1;

        if ($end != $nr_pages) {
            $smarty->assign('limit_sus', '1');

            $limit_sus = $pag_current + 1;

            if ($limit_sus > $nr_pages)
                $limit_sus = $nr_pages;


            $url_grup_sus = str_replace('[pag]', $limit_sus, $old_url);

            $smarty->assign('url_grup_sus', $url_grup_sus);
            $smarty->assign('pag_next', $limit_sus);
        }

        if ($start != 1) {
            $smarty->assign('limit_jos', '1');

            $limit_jos = $pag_current - 1;
            if ($limit_jos <= 0)
                $limit_jos = 1;


            $url_grup_jos = str_replace('[pag]', $limit_jos, $old_url);

            $smarty->assign('url_grup_jos', $url_grup_jos);
            $smarty->assign('pag_back', $limit_jos);
        }

        for ($i = $start; $i <= $end; $i++) {
            $k = $i;


            if ($pag_current == $i)
                $urls[] = '';
            else
                $urls[] = str_replace('[pag]', $k, $old_url);

            $pages[] = $i;
        }
        $smarty->assign('url1', str_replace('[pag]', 1, $old_url));
        $smarty->assign('urllast', str_replace('[pag]', $nr_pages, $old_url));
        $smarty->assign('pages', $pages);
        if (!isset($selected))
            $selected = NULL;
        $smarty->assign('selected', $selected);
        $smarty->assign('urls', $urls);
        $smarty->assign('nr_pages', $nr_pages);
        $smarty->assign('grup_pag', $grup_pag);
        $smarty->assign('pag_current', $pag_current);

        $content = $smarty->fetch('_paginate.tpl');
        return $content;
    }

    public static function getTranslates($lang, $letter = '')
    {
        global $conn;
        $translates = array();
        if ($letter == 'Altele') {
            $query = "SELECT ID, ro, {$lang} FROM translates WHERE LEFT(ro, 1) < 'A' ORDER BY ro";
        } else {
            $query = "SELECT ID, ro, {$lang} FROM translates" . (!empty($letter) ? " WHERE UPPER(LEFT(ro, 1)) = '$letter'" : "") . " ORDER BY ro";
        }
        $conn->query($query);
        while ($row = $conn->fetch_array()) {
            $translates[$row['ID']]['ro'] = $row['ro'];
            $translates[$row['ID']][$lang] = $row[$lang];
        }
        return $translates;
    }

    public static function setTranslate($lang)
    {
        global $conn;
        if (!empty($_GET['ID'])) {
            if (!empty($_GET['del'])) {
                $query = "DELETE FROM translates WHERE ID = '{$_GET['ID']}'";
            } else {
                $query = "UPDATE translates SET ro = '" . Utils::formatStr($_GET['ro']) . "', {$lang} = '" . Utils::formatStr($_GET['lng']) . "' WHERE ID = '{$_GET['ID']}'";
            }
        } else {
            $query = "INSERT INTO translates(ro, {$lang}) VALUES('" . Utils::formatStr($_GET['ro']) . "', '" . Utils::formatStr($_GET['lng']) . "')";
        }
        $conn->query($query);
    }

    public static function genTranslate($lang)
    {
        global $conn;
        $content = "<?php\n\$translate=array(\n";
        $conn->query("SELECT ro, {$lang} FROM translates ORDER BY ro");
        while ($row = $conn->fetch_array()) {
            if (!empty($row[$lang])) {
                $content .= "\"{$row['ro']}\" => \"{$row[$lang]}\",\n";
            }
        }
        $content .= ");\n?>";
        file_put_contents("translates/{$lang}.php", $content);
    }

    public static function getAppLang()
    {
        global $conn;
        $conn->query("SELECT lang FROM settings");
        return ($row = $conn->fetch_array()) ? $row['lang'] : 'ro';
    }

    public static function getNomCor()
    {

        global $conn;

        $conn->query("SET NAMES utf8");
        $conn->query("SELECT CONCAT(Nume, ' | ', Cod) AS Cor FROM nom_cor");
        $cor = array();
        while ($row = $conn->fetch_array()) {
            $cor[] = $row['Cor'];
        }
        return $cor;
    }

    public static function getNomCorAjax($search)
    {

        global $conn;

        $conn->query("SET NAMES utf8");
        $conn->query("SELECT Id, CONCAT(Nume, ' | ', Cod) AS Cor FROM nom_cor WHERE Nume LIKE '%$search%' OR Cod LIKE '%$search%'  ORDER BY Nume ASC");
        $cor = array();
        while ($row = $conn->fetch_array()) {
            $cor[$row['Id']] = $row['Cor'];
        }
        return $cor;
    }

    public static function getNomCaen()
    {

        global $conn;

        $conn->query("SELECT CONCAT(DomeniuActivitateDenumire, ' | ', DomeniuActivitateCod) AS Caen FROM nom_caen");
        $caen = array();
        while ($row = $conn->fetch_array()) {
            $caen[] = $row['Caen'];
        }
        return $caen;
    }

    public static function getNomCaenAjax($search)
    {

        global $conn;

        $conn->query("SELECT DomeniuActivitateID, CONCAT(DomeniuActivitateDenumire, ' | ', DomeniuActivitateCod) AS Caen FROM nom_caen WHERE DomeniuActivitateDenumire LIKE '%$search%' OR DomeniuActivitateCod LIKE '%$search%' ORDER BY DomeniuActivitateDenumire ASC");
        $cor = array();
        while ($row = $conn->fetch_array()) {
            $cor[$row['DomeniuActivitateID']] = $row['Caen'];
        }
        return $cor;
    }

    public static function setReportPersonalization($ReportID, $settings)
    {
        global $conn;

        $conn->query("REPLACE INTO reports_personalised_settings (ReportID, PersonID, settings)
                            VALUES('$ReportID', '" . $_SESSION['PERS'] . "', '" . serialize($settings) . "')");

    }

    public static function getReportPersonalization($ReportID)
    {
        global $conn;

        $conn->query("SELECT settings FROM reports_personalised_settings WHERE ReportID = $ReportID AND PersonID = '" . $_SESSION['PERS'] . "'");
        if ($row = $conn->fetch_array()) {
            return unserialize($row['settings']);
        }
    }

    public static function setReportFiltersPersonalization($ReportID, $settings)
    {
        global $conn;

        $conn->query("DELETE FROM reports_personalised_filters 
						WHERE ReportID = $ReportID AND PersonID = '" . $_SESSION['PERS'] . "'");

        $conn->query("INSERT INTO reports_personalised_filters (ReportID, PersonID, settings)
                            VALUES('$ReportID', '" . $_SESSION['PERS'] . "', '" . serialize($settings) . "')");

    }

    public static function getReportFiltersPersonalization($ReportID)
    {
        global $conn;

        $conn->query("SELECT settings FROM reports_personalised_filters WHERE ReportID = $ReportID AND PersonID = '" . $_SESSION['PERS'] . "'");
        if ($row = $conn->fetch_array()) {
            return unserialize($row['settings']);
        }
    }

    public static function getProductCats($PCatID = 0)
    {

        global $conn;

        $conn->query("SELECT CatID, Name, Descr FROM product_categories WHERE PCatID = $PCatID ORDER BY Name");
        $cats = array();
        while ($row = $conn->fetch_array()) {
            $row['Name'] = stripslashes($row['Name']);
            $row['Descr'] = stripslashes($row['Descr']);
            $cats[$row['CatID']] = $row;
        }
        return $cats;
    }

    public static function setProductCat($CatID = 0, $PCatID = 0)
    {

        global $conn, $smarty;

        if (!empty($_GET['delCat']) && $CatID > 0) {
            $conn->query("SELECT CatID 
	                  FROM   product_categories
                          WHERE  CatID = $CatID AND NOT EXISTS (SELECT CatID FROM product_categories WHERE PCatID = $CatID)");
            if (!$conn->get_affected_rows()) {
                require_once $smarty->_get_plugin_filepath('function', 'translate');
                echo "<body onload=\"alert('" . smarty_function_translate(array('label' => 'Nu se poate sterge aceasta categorie / subcategorie deoarece contine subcategorii / produse'), $smarty) . "!'); window.location.href = './?m=dictionary&o=product';\"></body>";
                exit;
            } else {
                $conn->query("DELETE FROM product_categories WHERE CatID = $CatID");
                header('Location: ./?m=dictionary&o=product&CatID=' . $PCatID);
                exit;
            }
        }

        if (!empty($_GET['Name']) && trim($_GET['Name'])) {
            if ($CatID > 0) {
                $conn->query("UPDATE product_categories SET Name = '" . trim($_GET['Name']) . "', Descr = '" . trim($_GET['Descr']) . "' WHERE CatID = $CatID");
            } else {
                $conn->query("INSERT INTO product_categories(Name, Descr, PCatID, CreateDate) VALUES('" . trim($_GET['Name']) . "', '" . trim($_GET['Descr']) . "', $PCatID, CURRENT_TIMESTAMP)");
            }
            if ($conn->errno == 1062) {
                throw new Exception(Message::getMessage('DUPLICATE_CAT'));
            }
        }
    }

    public static function getAllProductCats()
    {
        global $conn;
        $conn->query("SELECT CatID, PCatID, Name FROM product_categories ORDER BY Name");
        $cats = array();
        while ($row = $conn->fetch_array()) {
            $cats[$row['PCatID']][$row['CatID']] = stripslashes($row['Name']);
        }
        return $cats;
    }

    public static function encrypt($pure_string, $encryption_key)
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $encrypted_string = mcrypt_encrypt(MCRYPT_BLOWFISH, $encryption_key, utf8_encode($pure_string), MCRYPT_MODE_ECB, $iv);
        return $encrypted_string;
    }

    public static function decrypt($encrypted_string, $encryption_key)
    {
        $iv_size = mcrypt_get_iv_size(MCRYPT_BLOWFISH, MCRYPT_MODE_ECB);
        $iv = mcrypt_create_iv($iv_size, MCRYPT_RAND);
        $decrypted_string = mcrypt_decrypt(MCRYPT_BLOWFISH, $encryption_key, $encrypted_string, MCRYPT_MODE_ECB, $iv);
        return $decrypted_string;
    }

    function getMIMEType($filename)
    {
        preg_match("|\.([a-z0-9]{2,4})$|i", $filename, $fileSuffix);

        switch (strtolower($fileSuffix[1])) {
            case "js" :
                return "application/x-javascript";

            case "json" :
                return "application/json";

            case "jpg" :
            case "jpeg" :
            case "jpe" :
                return "image/jpg";

            case "png" :
            case "gif" :
            case "bmp" :
            case "tiff" :
                return "image/" . strtolower($fileSuffix[1]);

            case "css" :
                return "text/css";

            case "xml" :
                return "application/xml";

            case "doc" :
            case "docx" :
                return "application/msword";

            case "xls" :
            case "xlt" :
            case "xlm" :
            case "xld" :
            case "xla" :
            case "xlc" :
            case "xlw" :
            case "xll" :
                return "application/vnd.ms-excel";

            case "ppt" :
            case "pps" :
                return "application/vnd.ms-powerpoint";

            case "rtf" :
                return "application/rtf";

            case "pdf" :
                return "application/pdf";

            case "html" :
            case "htm" :
            case "php" :
                return "text/html";

            case "txt" :
                return "text/plain";

            case "mpeg" :
            case "mpg" :
            case "mpe" :
                return "video/mpeg";

            case "mp3" :
                return "audio/mpeg3";

            case "wav" :
                return "audio/wav";

            case "aiff" :
            case "aif" :
                return "audio/aiff";

            case "avi" :
                return "video/msvideo";

            case "wmv" :
                return "video/x-ms-wmv";

            case "mov" :
                return "video/quicktime";

            case "zip" :
                return "application/zip";

            case "tar" :
                return "application/x-tar";

            case "swf" :
                return "application/x-shockwave-flash";

            default :
                if (function_exists("mime_content_type")) {
                    $fileSuffix = mime_content_type($filename);
                }

                return "unknown/" . trim($fileSuffix[0], ".");
        }
    }

}

?>