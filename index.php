<?php
define('DEBUG', 0);
error_reporting(0);
error_reporting(E_ALL ^ E_NOTICE ^ E_DEPRECATED ^ E_WARNING);
session_start();

//echo "<pre>";
//echo "Maintenance mode. For more information please contact your server administration service.";
//die();

if (DEBUG == 1) {
    $script_start_time = (float)array_sum(explode(' ', microtime()));
    $_SESSION['q'] = array();
}

function __autoload($className)
{
    include('libs/' . $className . '.php');
}

include('libs/DB.class.php');
include('libs/Smarty.class.php');

try {
    @$conn = new DB(Config::MYSQL_HOST, Config::MYSQL_USER, Config::MYSQL_PASS, Config::MYSQL_DBNAME);
} catch (Exception $exp) {
    echo $exp->getMessage();
}

if (empty($_SESSION['LANG'])) {
    $_SESSION['LANG'] = Utils::getAppLang();
}
if (isset($_SESSION['LANG']) && $_SESSION['LANG'] != 'ro') {
    include('translates/' . $_SESSION['LANG'] . '.php');
}
if (empty($_SESSION['THEME'])) {
    $_SESSION['THEME'] = Utils::getTheme();
}
//if (empty($_SESSION['CURRENCY'])) {
$_SESSION['CURRENCY']['CURRENT'] = Config::$msCurrency;
$_SESSION['CURRENCY']['RATES'] = Currency::getSysRates(date('Y'), Config::$msCurrency);
//}

try {

    if (isset($_SESSION['USER_ID']) && isset($_GET['doLogout'])) {
        session_destroy();
        header('Location: ./');
        exit;
    }

    $smarty = new Smarty();
    $smarty->template_dir .= '/' . Config::$msAppLng;
    $smarty->compile_dir .= '/' . Config::$msAppLng;
    $err = new Error($smarty);
    if (isset($_SESSION['USER_ID'])) {

        if (!empty($_GET['m']) && (($right = @array_search($_GET['m'], Config::$msAppModules[$_SESSION['AREA_ID']])) !== false) &&
            ($_SESSION['USER_ID'] == 1 || @in_array($right, $_SESSION['USER_RIGHTS']))) {

            $o = !empty($_GET['o']) ? $_GET['o'] : 'default';

            include('modules/' . $_GET['m'] . '.php');

            if ($_SESSION['USER_ID'] != 1 && !empty($_SESSION['USER_RIGHTSPOS'][$right])) {
                foreach (ConfigRights::$msRightsLevel2[$right] as $k => $v) {
                    if (isset($v['type']) && $v['type'] == 'list' && !empty($_SESSION['USER_RIGHTSPOS'][$right][$k])) {
                        $pos = 0;
                        foreach (ConfigRights::$msRightsLevel3[$right][$k] as $idx => $vv) {
                            $l3idx[$idx] = ++$pos;
                        }
                        foreach ((array)$_SESSION['USER_RIGHTSPOS'][$right][$k] as $idx => $pos) {
                            $pos_ini = $l3idx[$idx];
                            $idx_ini = array_search($pos, $l3idx);
                            $l3idx[$idx] = $pos;
                            $l3idx[$idx_ini] = $pos_ini;
                        }
                        asort($l3idx);
                        foreach ($l3idx as $idx => $pos) {
                            $l3idx[$idx] = ConfigRights::$msRightsLevel3[$right][$k][$idx];
                        }
                        ConfigRights::$msRightsLevel3[$right][$k] = $l3idx;
                    }
                }
            }

        } elseif (!empty($_GET['m']) && $_GET['m'] == 'admin' && $_SESSION['USER_ID'] == 1) {

            include('modules/admin.php');

        } // include not logged in pages
        elseif ($_SESSION['USER_ID'] == -1 && !empty($_SESSION['hashkey'])) {
            $o = !empty($_GET['o']) ? $_GET['o'] : 'default';

            if (@in_array(trim($_GET['m']), Config::$msAllowedModulesNotLogged) && @in_array($o, Config::$msAllowedOperationsNotLogged)) {
                include('modules/' . $_GET['m'] . '.php');

            } else {
                include('modules/auth.php');
            }
        } else {

            if (!empty($_GET['m']) && $_GET['m'] == 'help') {

                include('modules/help.php');

            } elseif (!empty($_GET['m']) && $_GET['m'] == 'auth') {

                include('modules/auth.php');

            } else {

                include('modules/home.php');
            }

        }


        $smarty->assign(array(
            'theme' => $_SESSION['THEME'],
            'center_file' => $center_file,
            'modules' => Config::$msAppModules[$_SESSION['AREA_ID']],
            'modules_txt' => Message::getAppModules(),
            'areas' => Message::$msAppAreasRO,
            'rights_level_2' => ConfigRights::$msRightsLevel2,
            'rights_level_3' => ConfigRights::$msRightsLevel3,
            'res_per_pages' => Config::$msResPerPages,
            'res_per_page' => empty($_GET['res_per_page']) ? Config::$msResPerPage : $_GET['res_per_page'],
        ));
        $smarty->assign("eticheta", Config::ETICHETA);

    } else {
        if (isset($_GET['doRecoverPassword'])) {

            if (!empty($_POST)) {

                try {

                    User::recoverPassword();
                    $smarty->assign('success', 1);

                } catch (Exception $exp) {

                    $err->setError($exp->getMessage());
                }
            }

        } elseif (isset($_GET['doChangePassword'])) {

            if (!empty($_POST)) {

                try {

                    User::changePassword();
                    header('Location: ./');
                    exit;

                } catch (Exception $exp) {

                    $err->setError($exp->getMessage());
                }
            }
        } elseif (!empty($_GET['hashkey'])) {

            $_SESSION['USER_ID'] = -1;
            $_SESSION['hashkey'] = $_GET['hashkey'];
            header('Location: ' . $_SERVER['REQUEST_URI']);


        } else {

            if (!empty($_POST)) {

                try {
                    if (User::login() == 'CHG_PW') {
                        header('Location: ./?doChangePassword&username=' . $_POST['username'] . '&area_id=' . $_POST['area_id']);
                    } else {
                        // Check if a user has unread documents
                        if (isset($_SESSION['PERS']) && Library::getUnreadDocs($_SESSION['PERS']))
                            header('Location: ./mandatory-read.php');
                        elseif (isset($_SESSION['PERS']) && PersonLibrary::getUnreadDocs($_SESSION['PERS']))
                            header('Location: ./mandatory-read.php');
                        else {
                            $unde = "";
                            $tmpInfo = User::getRights($_SESSION['USER_ID']);
                            if ($tmpInfo['UserRightsLevel2'][38][1] == 3)
                                $unde = "?m=dashboard";
                            header('Location: ./' . $unde);
                        }
                        die();
                    }

                } catch (Exception $exp) {

                    $smarty->assign('areas', Message::$msAppAreasRO);
                    $err->setError($exp->getMessage());
                }

            } else {

                $smarty->assign('areas', Message::$msAppAreasRO);
            }
        }
    }
    $smarty->assign_by_ref('err', $err);
    $smarty->display('index.tpl');

} catch (Exception $exp) {

    echo $exp->getMessage();
}

if (DEBUG == 1) {
    echo '<div align="center">[Processing time: ' . sprintf("%.4f", (((float)array_sum(explode(' ', microtime()))) - $script_start_time)) . ' seconds; Memory usage: ' . round((memory_get_usage() / (1024 * 1024)), 2) . ' Mb]</div>';
    echo '<pre>';
    print_r($_SESSION['q']);
    echo '</pre>';
}

?>