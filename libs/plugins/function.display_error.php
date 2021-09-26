<?php

function smarty_function_display_error($params, &$smarty)
{

    $layer = '<div id="layer_error">
                <h3 class="layer">Eroare</h3>
                <div style="padding: 0 20px 0 20px">
            	    <textarea id="layer_error_notes">' . $params['errors'] . '</textarea>
		    <div align="center" style="margin-top: 4px"><input type="button" value="Inchide" onclick="document.getElementById(\'layer_error\').style.display = \'none\'; document.getElementById(\'layer_error_x\').style.display = \'none\';"></div>
                </div>
              </div>
              <div id="layer_error_x" title="Inchide" onclick="document.getElementById(\'layer_error\').style.display = \'none\'; document.getElementById(\'layer_error_x\').style.display = \'none\';">X</div>';

    return $layer;
}

?>