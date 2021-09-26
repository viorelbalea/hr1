<div class="layerContent" style="overflow-y:hidden; overflow-x:hidden; height:396px;">
    {if !empty($smarty.get.save) && $err->getErrors() == "" && empty($smarty.get.SheetID)}
    <span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
    {else}

    {if !empty($smarty.get.save) && $err->getErrors() == "" && !empty($smarty.get.SheetID)}
        <span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
    {elseif $err->getErrors() != ""}
        <span style="color: #FF0000;">{$err->getErrors()}</span>
    {else}
        <span>&nbsp;</span>
    {/if}
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr valign="top">
            <td>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Numar document'}</td>
                        <td><input type="text" id="SheetNo" value="{$info.SheetNo|default:''}" size="20" maxlength="32"></td>
                    </tr>
                    <tr>
                        <td>{translate label='Marca'}</td>
                        <td>
                            <select id="CarID">
                                <option value="0">{translate label='alege marca'}</option>
                                {foreach from=$cars key=key item=item}
                                    <option value="{$key}" {if $key==$info.CarID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Sofer'}</td>
                        <td>
                            <select id="DriverID">
                                <option value="0">{translate label='alege sofer'}</option>
                                {foreach from=$drivers key=key item=item}
                                    <option value="{$key}" {if $key==$info.DriverID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Centru cost'}</td>
                        <td>
                            <select id="CostCenterID">
                                <option value="0">{translate label='alege centru cost'}</option>
                                {foreach from=$costcenter key=key item=item}
                                    <option value="{$key}" {if $key==$info.CostCenterID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Scop'}</td>
                        <td>
                            <select id="Scope">
                                <option value="0">{translate label='alege scop'}</option>
                                {foreach from=$scopes key=key item=item}
                                    <option value="{$key}" {if $key==$info.Scope}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
            </td>
            {if $smarty.get.SheetID > 0 && $info.Patrimony == 1}
                <td>
                    <table border="0" cellpadding="0" cellspacing="0">
                        {foreach from=$info.Users key=key item=item}
                            <tr>
                                <td style="padding-bottom: 4px;">
                                    <select id="PersonID_{$key}">
                                        <option value="0">{translate label='alege utilizator'}</option>
                                        {foreach from=$users key=key2 item=item2}
                                            <option value="{$key2}" {if $key2==$item}selected{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>&nbsp;&nbsp;
                                </td>
                                <td>
                                    <div id="button_mod"><a href="#" onclick="if (document.getElementById('PersonID_{$key}').value > 0)
                                                showInfo('./?m=cars_sheet&SheetID={$smarty.get.SheetID}&save=1&ID={$key}&PersonID=' + document.getElementById('PersonID_{$key}').value, 'layer_cost_content'); else alert('{translate label='Intoduceti Utilizator!'}');
                                                return false;" title="{translate label='Modificare utilizator'}"><b>Add</b></a></div>
                                </td>
                                <td>
                                    <div id="button_del"><a href="#"
                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) showInfo('./?m=cars_sheet&SheetID={$smarty.get.SheetID}&save=1&ID={$key}&del=1', 'layer_cost_content'); return false;"
                                                            title="{translate label='Sterge utilizator'}"><b>Del</b></a></div>
                                </td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td>
                                <select id="PersonID_0">
                                    <option value="0">{translate label='alege utilizator'}</option>
                                    {foreach from=$users key=key2 item=item2}
                                        <option value="{$key2}">{$item2}</option>
                                    {/foreach}
                                </select>&nbsp;&nbsp;
                            </td>
                            <td colspan="2">
                                <div id="button_add"><a href="#" onclick="if (document.getElementById('PersonID_0').value > 0)
                                            showInfo('./?m=cars_sheet&SheetID={$smarty.get.SheetID}&save=1&ID=0&PersonID=' + document.getElementById('PersonID_0').value, 'layer_cost_content'); else alert('{translate label='Intoduceti Utilizator!'}');
                                            return false;" title="{translate label='Adauga utilizator'}"><b>Add</b></a></div>
                            </td>
                        </tr>
                    </table>
                </td>
            {/if}
        </tr>
    </table>

    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr valign="top">
            <td>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label="Data plecare"}</td>
                        <td>
                            <input type="text" id="StartDate" class="formstyle"
                                   value="{if !empty($info.StartDate) && $info.StartDate != '0000-00-00'}{$info.StartDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                            <A HREF="#"
                               onClick="var cal1 = new CalendarPopup(); cal1.isShowNavigationDropdowns = true; cal1.setYearSelectStartOffset(10); cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;"
                               NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"></A>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Ora plecare'}</td>
                        <td><input type="text" id="StartHour" value="{$info.StartHour|default:'00:00'}" size="5" maxlength="5"></td>
                    </tr>
                    <tr>
                        <td>{translate label='Km plecare'}</td>
                        <td><input type="text" id="StartDateKm" value="{$info.StartDateKm|default:''}" size="10" maxlength="10"></td>
                    </tr>
                </table>
            </td>
            <td>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label="Data sosire"}</td>
                        <td>
                            <input type="text" id="StopDate" class="formstyle"
                                   value="{if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                            <A HREF="#"
                               onClick="var cal2 = new CalendarPopup(); cal2.isShowNavigationDropdowns = true; cal2.setYearSelectStartOffset(10); cal2.select(document.getElementById('StopDate'),'anchor2','dd.MM.yyyy'); return false;"
                               NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Ora sosire'}</td>
                        <td><input type="text" id="StopHour" value="{$info.StopHour|default:'00:00'}" size="5" maxlength="5"></td>
                    </tr>
                    <tr>
                        <td>{translate label='Km sosire'}</td>
                        <td><input type="text" id="StopDateKm" value="{$info.StopDateKm|default:''}" size="10" maxlength="10"></td>
                    </tr>
                </table>
            </td>
        </tr>


    </table>
    <table>
        <tr>
            <td colspan="2">
                {translate label="Destinatie"}
                <br>
                <textarea id="Destination" style="width: 300px; resize:none;">{$info.Destination|default:''}</textarea>
            </td>
            <td colspan="2">
                {translate label="Observatii"}
                <br>
                <textarea id="Notes" style="width: 300px; resize:none;">{$info.Notes|default:''}</textarea>
            </td>
        </tr>
    </table>
</div>
<hr>
<div class="saveObservatii">
    {if empty($smarty.get.SheetID) || ($smarty.get.SheetID > 0 && $info.Patrimony == 1)}
        <input type="button" value="{translate label='Salveaza'}" onclick="showInfo('./?m=cars_sheet&SheetID={$smarty.get.SheetID}&save=1' +
                '&CarID=' +  document.getElementById('CarID').value +
                '&SheetNo=' + document.getElementById('SheetNo').value +
                '&DriverID=' + document.getElementById('DriverID').value +
                '&CostCenterID=' + document.getElementById('CostCenterID').value +
                '&Scope=' + document.getElementById('Scope').value +
                '&StartDate=' + document.getElementById('StartDate').value +
                '&StartHour=' + document.getElementById('StartHour').value +
                '&StartDateKm=' + document.getElementById('StartDateKm').value +
                '&StopDate=' + document.getElementById('StopDate').value +
                '&StopHour=' + document.getElementById('StopHour').value +
                '&StopDateKm=' + document.getElementById('StopDateKm').value +
                '&Destination=' + escape(document.getElementById('Destination').value) +
                '&Notes=' + escape(document.getElementById('Notes').value), 'layer_foi_content');">
    {/if}
    <input type="button" value="{translate label='Inchide'}"
           onclick="document.getElementById('layer_foi').style.display = 'none'; document.getElementById('layer_foi_x').style.display = 'none';">
</div>

{/if}