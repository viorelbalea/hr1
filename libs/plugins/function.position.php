<?php

function smarty_function_position($params, &$smarty)
{

    $arrows = "<ul style=\"margin: 2px 0 0 0; padding: 0; list-style-type: none; display: inline-block; white-space: nowrap;\">" .
        ($params['pos'] > 1 ? "<li style=\"margin-top: -2px;\"><a href=\"{$_SERVER['REQUEST_URI']}&l2={$params['l2']}&l3={$params['l3']}&pos=" . ($params['pos'] - 1) . "\" title=\"muta sus\"><img src=\"images/s_asc_i.png\" border=\"0\"></a></li>" : "") .
        ($params['pos'] < $params['pos_last'] ? "<li style=\"margin-top: -2px;\"><a href=\"{$_SERVER['REQUEST_URI']}&l2={$params['l2']}&l3={$params['l3']}&pos=" . ($params['pos'] + 1) . "\" title=\"muta jos\"><img src=\"images/s_desc_i.png\" border=\"0\"></a></li>" : "") .
        "</ul>";

    return $arrows;
}

?>
