<?php
/*
* Smarty plugin
* ��������������������-
* File:     function.recurse_array_horiz.php
* Type:     function
* Name:     recurse_array
* Purpose:  prints out elements of an array recursively
* ��������������������-
*/

function smarty_function_recurse_array_horiz($params, &$smarty)
{
    if ($params['array']['PersonID'] > 0) {
        $aux = $params['array'];
        $params['array'] = array();
        $params['array'][0] = $aux;
    }

    if (is_array($params['array']) && count($params['array']) > 0) {
        $markup = '';
        $markup .= '<ul>';
        foreach ($params['array'] as $element) {
            if ($element['PersonID'] > 0)
                $markup .= '<li>';
            else
                $markup .= '<li class="free">';

            $markup .= $element['FullName'] . ' (' . $element['Function'] . ')';

            if (isset($element['children'])) {
                $markup .= smarty_function_recurse_array_horiz(array('array' => $element['children']), $smarty);
            }
            $markup .= '</li>';
        }

        $markup .= '</ul>';

        return $markup;

    } else {
        return 'Structura inexistenta';
    }
}
