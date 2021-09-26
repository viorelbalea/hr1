<?php

$o = !empty($_GET['o']) ? $_GET['o'] : '';

switch ($o) {

    case 'help':
        $center_file = 'help_help.tpl';
        break;

    case 'about':
        if (is_readable('license/license')) {
            $license = file('license/license');
            $arr = explode(":", $license[0]);
            $ln = trim($arr[1]);
            $arr = explode(":", $license[3]);
            $fn = trim($arr[1]);
            $smarty->assign(array(
                'ln' => $ln,
                'fn' => $fn,
            ));
        }
        $center_file = 'help_about.tpl';
        break;

    default:
        $center_file = 'help.tpl';
        break;
}

?>