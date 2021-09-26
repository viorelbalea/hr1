<?php

function smarty_modifier_translate($params, &$smarty)
{

    global $translate;

    return smarty_function_translate(array('label' => $params), $smarty);
}

?>
