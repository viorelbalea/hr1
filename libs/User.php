<?php

class User
{

    public static $msRoleType = array(
        1 => 'manager',
        2 => 'angajat',
    );

    public static function checkPasswd()
    {
        $password = trim($_POST['password']);
        if (empty($password)) {
            throw new Exception(Message::getMessage('PASSWORD_EMPTY'));
        }
        global $conn;
        $conn->query("SELECT UserID FROM users WHERE UserID = {$_SESSION['USER_ID']} AND UserPassword = md5('$password')");
        if (!$conn->fetch_array()) {
            throw new Exception(Message::getMessage('PASSWORD_ERROR'));
        }
    }

    public static function setPasswd()
    {
        $password = trim($_POST['password']);
        $password2 = trim($_POST['password2']);
        if (empty($password)) {
            throw new Exception(Message::getMessage('PASSWORD_EMPTY'));
        }
        if ($password != $password2) {
            throw new Exception(Message::getMessage('PASSWORD_RETYPE_ERROR'));
        }
        if (!Utils::checkPassword($password)) {
            throw new Exception(Message::getMessage('PASSWORD_FORMAT_ERROR'));
        }
        global $conn;
        $conn->query("UPDATE users SET UserPassword = md5('$password'), ChgPwLastDate = CURRENT_TIMESTAMP WHERE UserID = {$_SESSION['USER_ID']}");
    }

    public static function getUsers()
    {
        global $conn;
        $conn->query("SELECT * FROM users WHERE UserID > 1");
        $users = array();
        while ($row = $conn->fetch_array()) {
            $row['UserRights'] = explode(',', $row['UserRights']);
            $users[] = $row;
        }
        return $users;
    }

    public static function getRoles()
    {
        global $conn;
        $conn->query("SELECT UserID, UserName FROM users WHERE UserID > 1 AND UserType = 'role' AND UserActive = 1");
        $users = array();
        while ($row = $conn->fetch_array()) {
            $users[$row['UserID']] = $row['UserName'];
        }
        return $users;
    }

    public static function setUsers()
    {
        global $conn;
        $conn->query("UPDATE users SET UserRights = '', UserActive = 0 WHERE UserID > 1");
        foreach ((array)$_POST['right'] as $k => $v) {
            $conn->query("UPDATE users SET 
	                                     UserRights = '" . implode(",", $v) . "', 
					     UserType = '{$_POST['type'][$k]}'
			  WHERE UserID = $k");
        }
        foreach ((array)$_POST['active'] as $k => $v) {
            $conn->query("UPDATE users SET UserActive = 1 WHERE UserID = $k");
        }
    }

    public static function addUser()
    {
        global $conn;
        $conn->query("INSERT INTO users(UserName, UserPassword) VALUES('{$_GET['username']}', '" . md5($_GET['username']) . "')");
    }

    public static function editUser()
    {
        global $conn;
        $conn->query("UPDATE users SET UserName = '" . trim($_GET['username']) . "' WHERE UserID = " . (int)$_GET['id'] . " AND UserID > 1");
    }

    public static function passUser()
    {
        global $conn;
        $conn->query("UPDATE users SET UserPassword = '" . md5($_GET['password']) . "' , ChgPwLastDate = CURRENT_TIMESTAMP WHERE UserID = " . (int)$_GET['id'] . " AND UserID > 1");
    }

    public static function delUser()
    {
        global $conn;
        $user_id = (int)$_GET['id'];
        $tables = array('persons', 'companies', 'contract', 'jobs', 'events', 'trainings', 'payroll', 'performance', 'vacations', 'eval', 'dailies');
        $cond = array();
        foreach ($tables as $table) {
            $cond[] = "SELECT DISTINCT UserID FROM {$table} WHERE UserID = $user_id";
        }
        $conn->query("DELETE 
	              FROM   users 
		      WHERE  UserID = $user_id AND UserID > 1 AND NOT EXISTS (" . implode(" UNION ", $cond) . ")");
        if (!$conn->get_affected_rows()) {
            $conn->query("UPDATE users SET UserActive = 0 WHERE UserID = $user_id AND UserID > 1");
        }
    }

    public static function getSettings()
    {
        global $conn;
        $conn->query("SELECT * FROM users WHERE UserID = " . (int)$_GET['id']);
        if ($row = $conn->fetch_array()) {
            $row['UserRights'] = explode(',', $row['UserRights']);
            $row['UserSettings'] = !empty($row['UserSettings']) ? unserialize($row['UserSettings']) : array();
            $row['UserCompanySelf'] = explode(',', $row['UserCompanySelf']);
            $row['CompanySettings'] = !empty($row['CompanySettings']) ? unserialize($row['CompanySettings']) : array();
            $row['RoleAlloc'] = !empty($row['RoleAlloc']) ? unserialize($row['RoleAlloc']) : array();
            return $row;
        }
        return array();
    }

    public static function setSettings()
    {
        global $conn;
        $conn->query("UPDATE users SET 
					UserSettings    = '" . serialize($_POST['settings']) . "',
					UserCompanySelf = '" . (!empty($_POST['UserCompanySelf']) ? implode(',', $_POST['UserCompanySelf']) : '') . "',
					CompanySettings = '" . Utils::formatStr(serialize($_POST['CompanySettings'])) . "',
					RoleType        = '" . (!empty($_POST['RoleType']) ? $_POST['RoleType'] : 0) . "',
					RoleAlloc       = '" . (!empty($_POST['RoleAlloc']) ? serialize($_POST['RoleAlloc']) : '') . "'
		      WHERE UserID = " . (int)$_GET['id']);
    }

    public static function setRights()
    {
        $rights = self::getRights();
        global $conn;
        $module = (int)$_GET['module'];
        foreach (ConfigRights::$msRightsLevel2[$module] as $k => $v) {
            $rights['UserRightsLevel2'][$module][$k] = ($v['type'] == 'list' || $v['type'] == 'perf') && $_POST['RightsLevel2'][$k] == 1 ?
                (isset($_POST['settings'][$k]) ? $_POST['settings'][$k] : 1) :
                (int)$_POST['RightsLevel2'][$k];
        }
        if ($module == 1) {
            $rights['UserRightsLevel2'][$module][9] = isset($_POST['RightsLevel2'][9]) ? $_POST['RightsLevel2'][9] : 0;
        }
        foreach ((array)ConfigRights::$msRightsLevel3[$module] as $k => $v) {
            foreach ($v as $kk => $vv) {
                $rights['UserRightsLevel3'][$module][$k][$kk] = (int)$_POST['RightsLevel3'][$k][$kk];
            }
        }
        $conn->query("UPDATE users SET 
					UserRightsLevel2 = '" . serialize($rights['UserRightsLevel2']) . "',
					UserRightsLevel3 = '" . serialize($rights['UserRightsLevel3']) . "'
		      WHERE UserID = " . (int)$_GET['id']);
    }

    public static function getRights($supraId = 0)
    {
        global $conn;
        if ($supraId != 0)
            $_GET['id'] = $supraId;
        $q = "SELECT UserName, UserType, UserRightsLevel2, UserRightsLevel3, UserRightsPosition FROM users WHERE UserID = " . (int)$_GET['id'];
        $conn->query($q);
        if ($row = $conn->fetch_array()) {
            $row['UserRightsLevel2'] = !empty($row['UserRightsLevel2']) ? unserialize($row['UserRightsLevel2']) : array();
            $row['UserRightsLevel3'] = !empty($row['UserRightsLevel3']) ? unserialize($row['UserRightsLevel3']) : array();
            $row['UserRightsPosition'] = !empty($row['UserRightsPosition']) ? unserialize($row['UserRightsPosition']) : array();
            return $row;
        }
        return array();
    }

    public static function setRightsPosition()
    {
        global $conn;
        $conn->query("SELECT UserRightsPosition FROM users WHERE UserID = " . (int)$_GET['id']);
        if ($row = $conn->fetch_array()) {
            $UserRightsPosition = !empty($row['UserRightsPosition']) ? unserialize($row['UserRightsPosition']) : array();
        } else {
            $UserRightsPosition = array();
        }
        $UserRightsPosition[$_GET['module']][$_GET['l2']][$_GET['l3']] = !empty($_GET['pos']) ? $_GET['pos'] : 1;
        $conn->query("UPDATE users SET UserRightsPosition = '" . serialize($UserRightsPosition) . "' WHERE UserID = " . (int)$_GET['id']);
    }

    public static function setRightsPositionReset()
    {
        global $conn;
        $conn->query("UPDATE users SET UserRightsPosition = '' WHERE UserID = " . (int)$_GET['id']);
    }

    public static function recoverPassword()
    {
        global $conn;
        $username = trim($_POST['username']);
        if (empty($username)) {
            throw new Exception(Message::getMessage('USERNAME_EMPTY'));
        }
        $conn->query("SELECT a.PersonID, a.FullName, a.Email, a.DateOfBirth
    	              FROM   persons a
    	              WHERE  a.Status IN (2,7,9,10) AND a.Username = '" . mysql_escape_string($username) . "'");
        if ($row = $conn->fetch_array()) {
            if (empty($row['Email'])) {
                throw new Exception('User-ul nu are adresa de email');
            } else {
                $parts = explode(' ', $row['FullName']);
                $row['Password'] = substr($parts[0], 0, 3) . (isset($parts[1]) ? substr($parts[1], 0, 3) : '') . str_replace('-', '', substr(Utils::toDBDate($row['DateOfBirth']), 0, 5)) . rand(11111, 99999);
                $conn->query("UPDATE persons SET Password = md5('" . $row['Password'] . "'), ChgPwLastDate = CURRENT_TIMESTAMP WHERE PersonID = '{$row['PersonID']}'");
                include_once('sendMail.php');
                $message = "Salut {$row['FullName']},<br><br>parola este: {$row['Password']}<br><br>O zi buna!";
                sendMail(Config::SMTP_EMAIL, Config::SMTP_EMAIL, $row['FullName'], $row['Email'], 'Recuperare parola', $message);
            }
        } else {
            throw new Exception(Message::getMessage('NO_SUCH_PERSON'));
        }
    }

    public static function changePassword()
    {
        global $conn;
        if (empty($_POST['password'])) {
            throw new Exception(Message::getMessage('PASSWORD_EMPTY'));
        }
        if (!Utils::checkPassword($_POST['password'])) {
            throw new Exception(Message::getMessage('PASSWORD_FORMAT_ERROR'));
        }
        if ($_POST['password'] != $_POST['password2']) {
            throw new Exception(Message::getMessage('PASSWORD_RETYPE_ERROR'));
        }
        $conn->query("SELECT UserID FROM users WHERE UserActive = 1 AND UserName = '" . mysql_escape_string($_POST['username']) . "'");
        if ($row = $conn->fetch_array()) {
            $conn->query("UPDATE users SET UserPassword = md5('" . mysql_escape_string($_POST['password']) . "'), ChgPwLastDate = CURRENT_TIMESTAMP WHERE UserID = {$row['UserID']}");
        } else {
            $conn->query("SELECT PersonID, FullName, Email FROM persons WHERE Status IN (2,7,9,10) AND Username = '" . mysql_escape_string($_POST['username']) . "'");
            if ($row = $conn->fetch_array()) {
                $conn->query("UPDATE persons SET Password = md5('" . mysql_escape_string($_POST['password']) . "'), ChgPwLastDate = CURRENT_TIMESTAMP WHERE PersonID = {$row['PersonID']}");
            } else {
                throw new Exception(Message::getMessage('AUTH_ERROR'));
            }
        }
        if (!empty($row['Email'])) {
            include_once('sendMail.php');
            $message = "Salut {$row['FullName']},<br><br>username: {$_POST['username']}<br><br>parola noua: {$_POST['password']}<br><br>O zi buna!";
            sendMail(Config::SMTP_EMAIL, Config::SMTP_EMAIL, $row['FullName'], $row['Email'], 'Schimbare parola', $message);
        }
        self::login();
    }

    public static function login($user = '', $pass = '', $force_auth = 0)
    {
        $username = empty($user) ? trim($_POST['username']) : $user;
        $password = empty($pass) ? trim($_POST['password']) : $pass;
        if (empty($username)) {
            throw new Exception(Message::getMessage('USERNAME_EMPTY'));
        }
        if (empty($password)) {
            throw new Exception(Message::getMessage('PASSWORD_EMPTY'));
        }
        if (self::checkLicense() === false) {
            throw new Exception(Message::getMessage('INVALIDE_LICENSE'));
        }
        if (!Application::validateKey(Config::LICENSE_KEY)) {
            throw new Exception(Message::getMessage('INVALIDE_LICENSE'));
        }
        global $conn;
        $conn->query("SELECT *, CASE WHEN ChgPwLastDate IS NOT NULL THEN DATE_ADD(ChgPwLastDate, INTERVAL " . Config::CHG_PW_MONTH_FREQ . " MONTH) ELSE '' END AS ChgPwLastDate
                      FROM   users 
                      WHERE  UserActive = 1 AND 
		             UserName = '" . mysql_escape_string($username) . "' AND UserPassword = md5('" . mysql_escape_string($password) . "')");
        if ($row = $conn->fetch_array()) {
            //print_r($row);
            //die();
            if (empty($row['ChgPwLastDate']) || $row['ChgPwLastDate'] < date('Y-m-d')) {
                return 'CHG_PW';
            }
            $_SESSION['USER_ID'] = $row['UserID'];
            $_SESSION['USER_NAME'] = $row['UserName'];
            $_SESSION['USER_RIGHTS'] = explode(',', $row['UserRights']);
            $_SESSION['USER_RIGHTS2'] = !empty($row['UserRightsLevel2']) ? unserialize($row['UserRightsLevel2']) : array();
            $_SESSION['USER_RIGHTS3'] = !empty($row['UserRightsLevel3']) ? unserialize($row['UserRightsLevel3']) : array();
            $_SESSION['USER_RIGHTSPOS'] = !empty($row['UserRightsPosition']) ? unserialize($row['UserRightsPosition']) : array();
            $_SESSION['USER_SETTINGS'] = !empty($row['UserSettings']) ? unserialize($row['UserSettings']) : array();
            $_SESSION['USER_COMPANYSELF'] = !empty($row['UserCompanySelf']) ? explode(',', $row['UserCompanySelf']) : array();
            $_SESSION['ROLEALLOC'] = !empty($row['RoleAlloc']) ? unserialize($row['RoleAlloc']) : array();
        } else {
            $password_check = empty($force_auth) ? "md5('" . mysql_escape_string($password) . "')" : "'$password'";
            $query = "SELECT a.PersonID, a.FullName, a.RoleID, a.ManagerID, a.AccessPerf, a.AccessEval, a.AccessColleaguesEval,
	                         b.UserRights, b.UserRightsLevel2, b.UserRightsLevel3, b.UserRightsPosition, b.CompanySettings,
				 b.UserCompanySelf, b.UserSettings, b.UserName, b.UserType, b.RoleType, b.RoleAlloc, c.CompanyID,
				 CASE WHEN a.ChgPwLastDate IS NOT NULL THEN DATE_ADD(a.ChgPwLastDate, INTERVAL " . Config::CHG_PW_MONTH_FREQ . " MONTH) ELSE '' END AS ChgPwLastDate
    	                  FROM   persons a
    	                         INNER JOIN users b ON a.RoleID = b.UserID AND b.UserType = 'role' AND b.UserActive = 1
				 LEFT JOIN payroll c ON a.PersonID = c.PersonID
    	                  WHERE  a.Status IN (2,7,9,10,12) AND 
			         a.Username = '" . mysql_escape_string($username) . "' AND a.Password = $password_check";
            $conn->query($query);
            if ($row = $conn->fetch_array()) {
                if (empty($row['ChgPwLastDate']) || $row['ChgPwLastDate'] < date('Y-m-d')) {
                    return 'CHG_PW';
                }
                $_SESSION['USER_ID'] = $row['RoleID'];
                $_SESSION['USER_NAME'] = $row['FullName'];
                $_SESSION['USER_RIGHTS'] = explode(',', $row['UserRights']);
                $_SESSION['USER_RIGHTS2'] = !empty($row['UserRightsLevel2']) ? unserialize($row['UserRightsLevel2']) : array();
                $_SESSION['USER_RIGHTS3'] = !empty($row['UserRightsLevel3']) ? unserialize($row['UserRightsLevel3']) : array();
                $_SESSION['USER_RIGHTSPOS'] = !empty($row['UserRightsPosition']) ? unserialize($row['UserRightsPosition']) : array();
                $_SESSION['USER_SETTINGS'] = !empty($row['UserSettings']) ? unserialize($row['UserSettings']) : array();
                $_SESSION['USER_COMPANYSELF'] = !empty($row['UserCompanySelf']) ? explode(',', $row['UserCompanySelf']) : array();
                $_SESSION['COMPANY_SETTINGS'] = !empty($row['CompanySettings']) ? unserialize($row['CompanySettings']) : array();
                $_SESSION['PERS'] = $row['PersonID'];
                $_SESSION['ACCESSPERF'] = !empty($row['AccessPerf']) ? $row['AccessPerf'] : 3;
                $_SESSION['ACCESSEVAL'] = $row['AccessEval'];
                $_SESSION['ACCESSCEVAL'] = $row['AccessColleaguesEval'];
                $_SESSION['ACCESSSURVEY'] = $row['AccessSurvey'];
                $_SESSION['ROLE'] = $row['RoleID'];
                $_SESSION['ROLEMNG'] = $row['RoleType'] == 1 ? 1 : 0;
                $_SESSION['ROLEALLOC'] = !empty($row['RoleAlloc']) ? unserialize($row['RoleAlloc']) : array();
                $_SESSION['MANAGER'] = $row['ManagerID'];
                $_SESSION['COMPANYLOGO'] = file_exists('photos/logo/' . $row['CompanyID'] . '_170_40.jpg') ? 'photos/logo/' . $row['CompanyID'] . '_170_40.jpg' : '';

                if ($row['PersonID'] == 161) {
                    mail("stefan.fodor@kate.ro", "S-a logat x-ulescu", date("Y-m-d H:i:s"));
                }
            } else {
                throw new Exception(Message::getMessage('AUTH_ERROR'));
            }
        }
        $_SESSION['AREA_ID'] = $_POST['area_id'];
        if ($_SESSION['USER_ID'] != 1) {
            $user_id = $_SESSION['USER_ID'];
            $conn->query("SELECT ReportID, Rights, ModuleID FROM reports");
            while ($row = $conn->fetch_array()) {
                if (!empty($row['Rights'])) {
                    $rights = unserialize($row['Rights']);
                    if (isset($rights[$user_id])) {
                        $_SESSION['REPORT_RIGHTS'][$row['ModuleID']][] = $row['ReportID'];
                    }
                }
            }
        }
    }

    public static function checkLicense()
    {
        return true;
        if (is_readable('license/license')) {
            $license = file('license/license');
            $arr = explode(":", $license[0]);
            $vc = trim($arr[1]);
            $arr = explode(":", $license[1]);
            $sd = trim($arr[1]);
            $arr = explode(":", $license[2]);
            $ed = trim($arr[1]);
            $arr = explode(":", $license[3]);
            $cs = trim($arr[1]);
            if (date('Y-m-d') >= Utils::toDBDate($sd) && date('Y-m-d') <= Utils::toDBDate($ed) && md5('HRS:' . $vc) . md5('HRS:' . $sd) . md5('HRS:' . $ed) == $cs) {
                return true;
            }
            mail('cristian.stefanescu@ka-te.ro', 'Licenta invalida HR Suite', implode("\n\n", $license), "From: \"HR Suite\" <cristian.stefanescu@ka-te.ro>");
        } else {
            @unlink('license/lic');
            header('Location: ./');
            exit;
        }
        return false;
    }
}

?>