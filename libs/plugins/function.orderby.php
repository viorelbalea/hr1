<?php

function smarty_function_orderby($params, &$smarty)
{

    require_once $smarty->_get_plugin_filepath('function', 'translate');
    $params['label'] = smarty_function_translate(array('label' => $params['label']), $smarty);

    if (!empty($_GET['order_by'])) {
        if ($_GET['order_by'] == $params['order_by']) {
            $arrow_asc = $_GET['asc_or_desc'] == "asc" ? "s_asc.png" : "s_asc_i.png";
            $arrow_desc = $_GET['asc_or_desc'] == "desc" ? "s_desc.png" : "s_desc_i.png";
        } else {
            $arrow_asc = "s_asc_i.png";
            $arrow_desc = "s_desc_i.png";
        }
    } else {
        $arrow_asc = $params['asc_or_desc'] == "asc" ? "s_asc.png" : "s_asc_i.png";
        $arrow_desc = $params['asc_or_desc'] == "desc" ? "s_desc.png" : "s_desc_i.png";
    }

    $arrows = "<ul style=\"margin: 4px 14px 0 0; padding: 0; list-style-type: none; white-space: nowrap;\">
               <li style=\"float: left;\" class=\"TitleBox\">{$params['label']}</li>
	       <li>
               <ul style=\"margin: 2px 0 0 3px; padding: 0; list-style-type: none; display: inline-block;\">
               <li style=\"margin-top: -5px;\"><a href=\"{$params['request_uri']}&order_by={$params['order_by']}&asc_or_desc=asc\" title=\"ordoneaza crescator\"><img src=\"images/{$arrow_asc}\" border=\"0\"></a></li>
	       <li style=\"margin-top: -5px;\"><a href=\"{$params['request_uri']}&order_by={$params['order_by']}&asc_or_desc=desc\" title=\"ordoneaza descrescator\"><img src=\"images/{$arrow_desc}\" border=\"0\"></a></li>
	       </ul>
	       </li>
	       </ul>";

    return $arrows;
}

?>
