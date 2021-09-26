<?php

function smarty_function_translate($params, &$smarty)
{

    if (isset($_SESSION['LANG']) && $_SESSION['LANG'] != 'ro') {

        global $translate;

        if (isset($translate[$params['label']])) {

            if (!empty($params['values'])) {

                return is_array($params['values']) ? vsprintf($translate[$params['label']], $params['values']) : sprintf($translate[$params['label']], $params['values']);

            } else {

                return $translate[$params['label']];
            }
        }
    }

    return !empty($params['values']) ? (is_array($params['values']) ? vsprintf($params['label'], $params['values']) : sprintf($params['label'], $params['values'])) : $params['label'];
}

?>
