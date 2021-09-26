<?php
/** Smarty plugin* ????????????????????-*
 * File:     function.recurse_array.php* Type:
 * function* Name:     recurse_array*
 * Purpose:  prints out elements of an array recursively* ????????????????????-
 */
function smarty_function_recurse_array($params, &$smarty)
{

    if (is_array($params['array']) && count($params['array']) > 0) {
        $markup = '';
        $markup .= '<ul>';
        foreach ($params['array'] as $element) {
            //var_dump($element);    
            $markup .= '<li>';
            $markup .= $element['Function'];
            $markup .= ' <a href="?m=functions&o=organigram&CompanyID=' . $element['CompanyID'] . '&mark=' . $element['ParentFunctionID'] . '&mark2=' . $element['Function'] . '&mark3=' . $element['InternalFunctionID'] . '&Level=' . $_GET['Level'] . '"> -print</a>';
            //$markup .= '<h1>' . 
            //$element['Function'] . '</h1>';      
            //$markup .= '<p>' . $element['Notes'] . '</p>';      
            if (isset($element['children'])) {
                $markup .= smarty_function_recurse_array(array('array' => $element['children']), $smarty);
            }
            $markup .= '</li>';
        }
        $markup .= '</ul>';
        return $markup;
    } else {
        return 'not array';
    }
}
		