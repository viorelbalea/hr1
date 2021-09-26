<table cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <td><h3>{$activities.0.FullName}</h3></td>
        <td align="right"><h3>{$activities.0.StartDate|date_format:'%d.%m.%Y'}</h3></td>
    </tr>
</table>
{if $err->getErrors()}<p style="color: #FF0000;">{$err->getErrors()}</p>{/if}
<table cellspacing="4" cellpadding="0" width="100%">
    <tr>
        <td colspan="2"><h3>{$interval}</h3></td>
    </tr>
    <tr>
        <td><b>{translate label='Tip pontaj'}</b></td>
        <td>
            <select id="Type" class="formstyle">
                {foreach from=$pontaj_types key=key2 item=item2}
                    <option value="{$key2}" {if $smarty.get.Type == $key2}selected{elseif $key2 == 1}selected{/if}>{$item2}</option>
                {/foreach}
            </select>
        </td>
    </tr>
    <tr>
        <td><b>{translate label='Centru cost'}</b></td>
        <td>
            <select id="CostCenterIDX" class="formstyle">
                <option value="0"></option>
                {foreach from=$costcenter key=key2 item=item2}
                    <option value="{$key2}" {if $personcost == $key2} selected="selected"{/if}>{$item2}</option>
                {/foreach}
            </select>
        </td>
    </tr>
</table>
<br>
<div style="margin-top: 4px; text-align: center;">
    <input type="button" value="{translate label='Salveaza'}" onclick="showInfo('{$smarty.server.REQUEST_URI}&action=new&ID=0' +
            '&CostCenterID=' + document.getElementById('CostCenterIDX').value +
            '&Type=' + document.getElementById('Type').value, 'layer_hp_content'); document.getElementById('layer_hp').style.display = 'none'; document.getElementById('layer_hp_x').style.display = 'none'; updateRow('{$smarty.get.RowID}', '{$smarty.get.StartDate}', '{$smarty.get.StartHour}', '{$smarty.get.EndHour}', document.getElementById('Type').value); return false;">&nbsp;&nbsp;
    <input type="button" value="{translate label='Sterge'}"
           onclick="showInfo('{$smarty.server.REQUEST_URI}&action=del&ID=0', 'layer_hp_content'); document.getElementById('layer_hp').style.display = 'none'; document.getElementById('layer_hp_x').style.display = 'none'; updateRow('{$smarty.get.RowID}', '{$smarty.get.StartDate}', '{$smarty.get.StartHour}', '{$smarty.get.EndHour}', 'delete-cell'); return false;">&nbsp;&nbsp;
    <input type="button" value="{translate label='Anuleaza'}"
           onclick="document.getElementById('layer_hp').style.display = 'none'; document.getElementById('layer_hp_x').style.display = 'none';">
</div>
    
    