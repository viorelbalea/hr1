<?php

if (!isset($_SESSION['USER_ID'])) {
    header('Location: ../');
    exit;
}


if (isset($_GET['doChangePasswd'])) {

    if (!empty($_POST['go']) && $_POST['go'] == 2) {

        try {

            User::setPasswd();
            echo "<body OnLoad=\"alert('Parola a fost schimbata! Veti fi delogat pentru a putea folosi noua parola!'); window.location.href='./?doLogout=1';\"></body>";
            exit;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }
    }

    if (!empty($_POST['go']) && $_POST['go'] == 1) {

        try {

            User::checkPasswd();
            $_POST['go'] = 2;

        } catch (Exception $exp) {

            $err->setError($exp->getMessage());
        }
    }

    $center_file = 'change_passwd.tpl';

} elseif (!empty($_GET['area_id'])) {

    $_SESSION['AREA_ID'] = (int)$_GET['area_id'];
    header('Location: ./');
    exit;

} else {
    if (!isset($_GET['o']))
        $_GET['o'] = NULL;
    $o = $_GET['o'];
    switch ($_GET['o']) {

        case 'view':
            $News = new News((int)$_GET['NewsID']);
            $smarty->assign(array(
                'news' => $News->showNews(),
            ));

            $center_file = 'news_view.tpl';
            break;

        default:
            $employees = Person::employeesAtDate();
            $year = date('Y');
            $months = Utils::getMonthArray($year . '-01-01', $year . '-12-31');


            if (!empty($_GET['keyword'])) {
                $replace = array('%', '?', '!', '"', '\'');
                $replacer = array('', '', '', '', '');
                $keyword = str_replace($replace, $replacer, trim(strip_tags($_GET['keyword'])));
            } else {
                $keyword = '';
            }
            $smarty->assign(array(
                'news1' => News::displayNews('1'),
                'news2' => News::displayNews('2'),
                'news3' => News::displayNews('3'),
                'employees' => $employees,
                'months' => $months,
                'year' => $year,
                'news_types' => ConfigData::$msNewsTypes,
                'status' => ConfigData::$msStatus,
                'request_uri' => "./?keyword={$keyword}",
                'keyword' => $keyword,
            ));
            $center_file = 'home.tpl';
            break;

    }
}

?>