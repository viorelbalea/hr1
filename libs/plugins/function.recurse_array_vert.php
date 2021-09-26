<?php
/*
* Smarty plugin
* ��������������������-
* File:     function.recurse_array_vert.php
* Type:     function
* Name:     recurse_array
* Purpose:  prints out elements of an array recursively
* ��������������������-
*/

function smarty_function_recurse_array_vert($params, &$smarty)
{

    if (is_array($params['array']) && count($params['array']) > 0) {
        $markup = '';

        $markup .= '<ul>';

        foreach ($params['array'] as $element) {


            $markup .= '<li>';
            if ($element['PersonID'] > 0) {
                $photoSize = $photo = $photoSrc = '';
                if (isset($element['Photo'])) {
                    $photo = '<img align="left" src="' . $element['Photo'] . '" alt="" />';
                    $photoSize = 'style="height:100px;"';
                }
                $markup .= '<a ' . $photoSize . ' href="?m=persons&o=edit&PersonID=' . $element['PersonID'] . '"><b>' . $photo . $element['FullName'] . '</b> <br>(' . $element['Function'] . ')' . '</a>';
            } else
                $markup .= '<a href="#" style="background-color:#FF8888;">' . $element['FullName'] . ' <br>(' . $element['Function'] . ')' . '</a>';


            if (isset($element['children'])) {
                $markup .= smarty_function_recurse_array_vert(array('array' => $element['children']), $smarty);
            }

            $markup .= '</li>';

        }

        $markup .= '</ul>';

        return $markup;

    } else {
        return 'Structura inexistenta';
    }
}
