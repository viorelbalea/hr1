<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}

$o = !empty($_GET['o']) ? $_GET['o'] : 'default';

switch ($o) {

    case 'personalisedlist':

        if (!empty($_POST)) {

            Utils::setPersonalisedList();
        }

        $smarty->assign('personalisedlist', Utils::getPersonalisedList());

        if ($_GET['type'] == 'popup') {
            $smarty->display('settings_personalisedlist.tpl');
            exit;
        } else
            $center_file = 'settings_personalisedlist.tpl';

        break;

    case 'styles':

        if (!empty($_POST)) {
            Utils::setAppStyle($_POST['StyleID']);
        }
        $Style = Utils::getAppStyle();
        $_SESSION['THEME'] = $Style['File'];
        $smarty->assign(array(
            'styles' => Utils::getAppStyles(),
            'StyleID' => $Style['StyleID'],
        ));

        $center_file = 'settings_styles.tpl';

        break;

    case 'lang':

        if (!empty($_POST)) {
            $_SESSION['LANG'] = $_POST['lang'];
            $conn->query("UPDATE settings SET lang = '{$_POST['lang']}'");
        }

        $smarty->assign(array(
            'langs' => Config::$msLangs,
        ));

        $center_file = 'settings_lang.tpl';

        break;

    default:

        $center_file = 'settings.tpl';

        break;
}

?>