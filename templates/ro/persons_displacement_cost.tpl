<div id="layer_displacement_scroll">
    {if $err->getErrors()}<p style="color: #FF0000;">{$err->getErrors()}</p>{/if}
    {translate label='Decont in valuta'}
    <select id="Currency" class="formstyle">
        {foreach from=$currencies item=item}
            <option value="{$item}" {if $item==$costs.0.Currency}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <p></p>
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr valign="top">
            <td width="50%" style="padding-right: 10px;">
                <p><b>{translate label='Cheltuieli'}</b></p>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-right: 10px">{translate label='Tipul cheltuielii'}</td>
                        <td style="padding-right: 10px">{translate label='Valoare'}</td>
                        <td style="width:120px; padding-right=0;">{translate label='Data'}</td>
                        <td width="20">&nbsp;</td>
                        <td width="20">&nbsp;</td>
                    </tr>
                    {assign var="expense" value="0"}
                    {foreach from=$costs item=item}
                        {if $item.CostType == 'expense'}
                            {math equation="x+y" x=$expense y=$item.Cost assign="expense"}
                            <tr height="35">
                                <td style="padding-right: 10px">
                                    <select id="CostSubtype_{$item.ID}" class="formstyle">
                                        <option value="0"></option>
                                        {foreach from=$cost_types.expense key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CostSubtype}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td style="padding-right: 10px"><input type="text" id="Cost_{$item.ID}" value="{$item.Cost}" size="10"></td>
                                <td style="width:120px; padding-right: 0px">
                                    <input type="text" id="CostDate_{$item.ID}" class="formstyle" value="{$item.CostDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                                    <A HREF="#"
                                       onClick="var cal1_{$item.ID} = new CalendarPopup(); cal1_{$item.ID}.isShowNavigationDropdowns = true; cal1_{$item.ID}.setYearSelectStartOffset(10); cal1_{$item.ID}.select(document.getElementById('CostDate_{$item.ID}'),'anchor1_{$item.ID}','dd.MM.yyyy'); return false;"
                                       NAME="anchor1_{$item.ID}" ID="anchor1_{$item.ID}"><img style=" padding-top:4px; width:16px; height:16px;" src="./images/cal.png" border="0"></A>
                                </td>
                                {if $costs.0.rw==1}
                                    <td>
                                        <div id="button_mod"><a href="#" onclick="if (validCost({$item.ID})) showInfo('{$smarty.server.REQUEST_URI}&action=edit&ID={$item.ID}' +
                                                    '&CostSubtype=' + document.getElementById('CostSubtype_{$item.ID}').value +
                                                    '&Cost=' + document.getElementById('Cost_{$item.ID}').value +
                                                    '&CostDate=' + document.getElementById('CostDate_{$item.ID}').value, 'layer_displacement_content'); return false;"
                                                                title="{translate label='Modifica cheltuiala'}"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Esti sigura(a)?'}')) showInfo('{$smarty.server.REQUEST_URI}&action=del&ID={$item.ID}', 'layer_displacement_content'); return false;"
                                                                title="{translate label='Sterge cheltuiala'}"><b>Del</b></a></div>
                                    </td>
                                {/if}
                            </tr>
                        {/if}
                    {/foreach}
                    <tr height="35">
                        <td style="padding-right: 10px">
                            <select id="CostSubtype_0" class="formstyle">
                                <option value="0"></option>
                                {foreach from=$cost_types.expense key=key2 item=item2}
                                    <option value="{$key2}">{$item2}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td style="padding-right: 10px"><input type="text" id="Cost_0" size="10"></td>
                        <td style="width:120px">
                            <input type="text" id="CostDate_0" class="formstyle" value="" size="10" maxlength="10">
                            <A HREF="#"
                               onClick="var cal1_0 = new CalendarPopup(); cal1_0.isShowNavigationDropdowns = true; cal1_0.setYearSelectStartOffset(10); cal1_0.select(document.getElementById('CostDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"
                               NAME="anchor1_0" ID="anchor1_0"><img style="padding-top:4px; width:16px; height:16px; " src="./images/cal.png" border="0"></A>
                        </td>
                        {if $costs.0.rw==1}
                            <td>
                                <div id="button_add"><a href="#" onclick="if (validCost(0)) showInfo('{$smarty.server.REQUEST_URI}&action=new&ID=0' +
                                            '&CostType=expense' +
                                            '&CostSubtype=' + document.getElementById('CostSubtype_0').value +
                                            '&Cost=' + document.getElementById('Cost_0').value +
                                            '&CostDate=' + document.getElementById('CostDate_0').value, 'layer_displacement_content'); return false;"
                                                        title="{translate label='Adauga cheltuiala'}"><b>Add</b></a></div>
                            </td>
                            <td>&nbsp;</td>
                        {/if}
                    </tr>
                    <tr height="35">
                        <td>&nbsp;</td>
                        <td colspan="4"><b>{translate label='Total cheltuieli'}: {$expense}</b></td>
                    </tr>
                </table>
            </td>
            <td width="50%" style="padding-left: 10px;">
                <p><b>{translate label='Avans'}</b></p>
                <table cellspacing="0" cellpadding="0">
                    <tr>
                        <td style="padding-right: 10px">{translate label='Tipul cheltuielii'}</td>
                        <td style="padding-right: 10px">{translate label='Valoare'}</td>
                        <td style="width:128px">{translate label='Data'}</td>
                        <td width="20">&nbsp;</td>
                        <td width="20">&nbsp;</td>
                    </tr>
                    {assign var="subsistence" value="0"}
                    {foreach from=$costs item=item}
                        {if $item.CostType == 'subsistence'}
                            {math equation="x+y" x=$subsistence y=$item.Cost assign="subsistence"}
                            <tr height="35">
                                <td style="padding-right: 10px">
                                    <select id="CostSubtype_{$item.ID}" class="formstyle">
                                        <option value="0"></option>
                                        {foreach from=$cost_types.subsistence key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item.CostSubtype}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td style="padding-right: 10px"><input type="text" id="Cost_{$item.ID}" value="{$item.Cost}" size="10"></td>
                                <td style="width: 128px">
                                    <input type="text" id="CostDate_{$item.ID}" class="formstyle" value="{$item.CostDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                                    <A HREF="#"
                                       onClick="var cal2_{$item.ID} = new CalendarPopup(); cal2_{$item.ID}.isShowNavigationDropdowns = true; cal2_{$item.ID}.setYearSelectStartOffset(10); cal2_{$item.ID}.select(document.getElementById('CostDate_{$item.ID}'),'anchor2_{$item.ID}','dd.MM.yyyy'); return false;"
                                       NAME="anchor2_{$item.ID}" ID="anchor2_{$item.ID}"><img style="padding-top:4px; width:16px; height:16px; " src="./images/cal.png" border="0"></A>
                                </td>
                                {if $costs.0.rw==1}
                                    <td>
                                        <div id="button_mod"><a href="#" onclick="if (validCost({$item.ID})) showInfo('{$smarty.server.REQUEST_URI}&action=edit&ID={$item.ID}' +
                                                    '&CostSubtype=' + document.getElementById('CostSubtype_{$item.ID}').value +
                                                    '&Cost=' + document.getElementById('Cost_{$item.ID}').value +
                                                    '&CostDate=' + document.getElementById('CostDate_{$item.ID}').value, 'layer_displacement_content'); return false;"
                                                                title="{translate label='Modifica diurna'}"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Esti sigura(a)?'}')) showInfo('{$smarty.server.REQUEST_URI}&action=del&ID={$item.ID}', 'layer_displacement_content'); return false;"
                                                                title="{translate label='Sterge diurna'}"><b>Del</b></a></div>
                                    </td>
                                {/if}
                            </tr>
                        {/if}
                    {/foreach}
                    <tr height="35">
                        <td style="padding-right: 10px">
                            <select id="CostSubtype_00" class="formstyle">
                                <option value="0"></option>
                                {foreach from=$cost_types.subsistence key=key2 item=item2}
                                    <option value="{$key2}">{$item2}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td style="padding-right: 10px"><input type="text" id="Cost_00" size="10"></td>
                        <td style="width:120px">
                            <input type="text" id="CostDate_00" class="formstyle" value="" size="10" maxlength="10">
                            <A HREF="#"
                               onClick="var cal2_0 = new CalendarPopup(); cal2_0.isShowNavigationDropdowns = true; cal2_0.setYearSelectStartOffset(10); cal1_0.select(document.getElementById('CostDate_00'),'anchor2_0','dd.MM.yyyy'); return false;"
                               NAME="anchor2_0" ID="anchor2_0"><img style="padding-top:4px; width:16px; height:16px; " src="./images/cal.png" border="0"></A>
                        </td>
                        {if $costs.0.rw==1}
                            <td>
                                <div id="button_add"><a href="#" onclick="if (validCost('00')) showInfo('{$smarty.server.REQUEST_URI}&action=new&ID=0' +
                                            '&CostType=subsistence' +
                                            '&CostSubtype=' + document.getElementById('CostSubtype_00').value +
                                            '&Cost=' + document.getElementById('Cost_00').value +
                                            '&CostDate=' + document.getElementById('CostDate_00').value, 'layer_displacement_content'); return false;"
                                                        title="{translate label='Adauga diurna'}"><b>Add</b></a></div>
                            </td>
                            <td>&nbsp;</td>
                        {/if}
                    </tr>
                    <tr height="35">
                        <td>&nbsp;</td>
                        <td colspan="4"><b>{translate label='Total avans'}: {$subsistence}</b></td>
                    </tr>
                </table>
            </td>
        </tr>
    </table>
    {*
    <hr class="dungaLayer" />
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td><b>{translate label='Cost total'}</b></td>
            <td><input type="text" id="CostTotal" value="{math equation="x+y" x=$expense y=0}" size="10" readonly></td>
        </tr>
        <tr>
            <td><b>{translate label='Cost deductibil'}</b></td>
            <td><input type="text" id="CostD" value="{$costs.0.CostD|default:0}" size="10"></td>
        </tr>
        <tr>
            <td><b>{translate label='Cost nedeductibil'}</b></td>
            <td><input type="text" id="CostN" value="{$costs.0.CostN|default:0}" size="10"></td>
        </tr>
    </table>
    *}

</div>
<div class="saveObservatii" style="height:140px; width:980px;">
    <hr class="dungaLayer"/>
    <input type="hidden" id="CostTotal" value="{$expense}">
    <table cellspacing="0" cellpadding="4">
        <tr>
            <td><b>{translate label='Diferenta de restituit'}</b></td>
            <td><input type="text" id="CostRestituit" value="{if $expense<$subsistence}{math equation="x-y" x=$subsistence y=$expense}{else}0{/if}" size="10" readonly></td>
        </tr>
        <tr>
            <td><b>{translate label='Diferenta de primit'}</b></td>
            <td><input type="text" id="CostDePrimit" value="{if $expense>=$subsistence}{math equation="x-y" x=$expense y=$subsistence}{else}0{/if}" size="10" readonly></td>
        </tr>
    </table>

    <div class="saveObservatii">
        {if $costs.0.rw==1}
            <input type="button" value="{translate label='Salveaza'}" onclick="updateInfo('{$smarty.server.REQUEST_URI}&action=set_info' +
                    '&Currency=' + document.getElementById('Currency').value +
                    '&CostTotal=' + document.getElementById('CostTotal').value +
                    '&CostD=' + document.getElementById('CostRestituit').value +
                    '&CostN=' + document.getElementById('CostDePrimit').value); document.getElementById('layer_displacement').style.display = 'none'; document.getElementById('layer_displacement_x').style.display = 'none';">
        {/if}
        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_displacement').style.display = 'none'; document.getElementById('layer_displacement_x').style.display = 'none';">
    </div>
</div>
