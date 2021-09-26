<?php

function smarty_function_display_success($params, &$smarty)
{

    $layer = '<div id="layer_success">
                <h3 class="layer">Succes</h3>
                <div style="padding: 0 20px 0 20px">
            	    <textarea id="layer_success_notes">' . $params['message'] . '</textarea>
		    <div align="center" style="margin-top: 4px"><input type="button" value="Inchide" onclick="document.getElementById(\'layer_success\').style.display = \'none\'; document.getElementById(\'layer_success_x\').style.display = \'none\';"></div>
                </div>
              </div>
              <div id="layer_success_x" title="Inchide" onclick="document.getElementById(\'layer_success\').style.display = \'none\'; document.getElementById(\'layer_success_x\').style.display = \'none\';">X</div>';

    return $layer;
}

?>