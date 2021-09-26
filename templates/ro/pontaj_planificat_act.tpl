<div id="layer_p_scroll">
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td><h3>{$activities.0.FullName}</h3></td>
            <td align="right"><h3>{$activities.0.StartDate|date_format:'%d.%m.%Y'}</h3></td>
        </tr>
    </table>
    {if $err->getErrors()}<p style="color: #FF0000;">{$err->getErrors()}</p>{/if}
    <table cellspacing="0" cellpadding="0" width="100%">
        <tr>
            <td>{translate label='Centru cost'}</td>
            <td>{translate label='Data inceput'}</td>
            <td>{translate label='Data sfarsit'}</td>
            <td>{translate label='Ore'}</td>
            <td>{translate label='Tip pontaj'}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
        </tr>
        {foreach from=$activities key=key item=item name=iter}
            {if $key > 0}
                {if $smarty.foreach.iter.last}{assign var="Notes" value=$item.Notes}{/if}
                <tr height="35">
                    <td style="border-bottom: 1px solid #000000;">
                        <select id="CostCenterID_{$item.ID}" class="formstyle">
                            <option value="0"></option>
                            {foreach from=$costcenter key=key2 item=item2}
                                <option value="{$key2}" {if $item.CostCenterID == $key2}selected{/if}>{$item2}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td style="border-bottom: 1px solid #000000;">
                        <input type="text" id="StartDate_{$item.ID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                        <input type="text" id="StartHour_{$item.ID}" class="formstyle" value="{$item.StartHour}" size="5" maxlength="5" style="font-weight: bold;">
                        <A HREF="#"
                           onClick="var cal1_{$item.ID} = new CalendarPopup(); cal1_{$item.ID}.isShowNavigationDropdowns = true; cal1_{$item.ID}.setYearSelectStartOffset(10); cal1_{$item.ID}.select(document.getElementById('StartDate_{$item.ID}'),'anchor1_{$item.ID}','dd.MM.yyyy'); return false;"
                           NAME="anchor1_{$item.ID}" ID="anchor1_{$item.ID}"><img src="./images/cal.png" border="0"></A>
                    </td>
                    <td style="border-bottom: 1px solid #000000;">
                        <input type="text" id="EndDate_{$item.ID}" class="formstyle" value="{$item.EndDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                        <input type="text" id="EndHour_{$item.ID}" class="formstyle" value="{$item.EndHour}" size="5" maxlength="5" style="font-weight: bold;">
                        <A HREF="#"
                           onClick="var cal2_{$item.ID} = new CalendarPopup(); cal2_{$item.ID}.isShowNavigationDropdowns = true; cal2_{$item.ID}.setYearSelectStartOffset(10); cal2_{$item.ID}.select(document.getElementById('EndDate_{$item.ID}'),'anchor2_{$item.ID}','dd.MM.yyyy'); return false;"
                           NAME="anchor2_{$item.ID}" ID="anchor2_{$item.ID}"><img src="./images/cal.png" border="0"></A>
                    </td>
                    <td style="border-bottom: 1px solid #000000; padding-left: 4px;"><b>{$item.Hours}</b></td>
                    <td style="border-bottom: 1px solid #000000;">
                        <select id="Type_{$item.ID}" class="formstyle">
                            <option value="0">{translate label='planificat'}</option>
                        </select>
                    </td>
                    {if $activities.0.rw==1 && $item.rw==1}
                        <td style="border-bottom: 1px solid #000000;">
                            <div id="button_mod"><a href="#" onclick="if (validAct({$item.ID})) showInfo('{$smarty.server.REQUEST_URI}&action=edit&ID={$item.ID}' +
                                        '&CostCenterID=' + document.getElementById('CostCenterID_{$item.ID}').value +
                                        '&StartDate=' + document.getElementById('StartDate_{$item.ID}').value +
                                        '&StartHour=' + document.getElementById('StartHour_{$item.ID}').value +
                                        '&EndDate=' + document.getElementById('EndDate_{$item.ID}').value +
                                        '&EndHour=' + document.getElementById('EndHour_{$item.ID}').value +
                                        '&Type=' + document.getElementById('Type_{$item.ID}').value, 'layer_p_content'); return false;"
                                                    title="{translate label='Modifica activitate'}"><b>Mod</b></a></div>
                        </td>
                        <td style="border-bottom: 1px solid #000000;">
                            <div id="button_del"><a href="#"
                                                    onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) showInfo('{$smarty.server.REQUEST_URI}&action=del&ID={$item.ID}', 'layer_p_content'); return false;"
                                                    title="{translate label='Sterge activitate'}"><b>Del</b></a></div>
                        </td>
                        <td style="border-bottom: 1px solid #000000;">{if $item.Status > 0}<img src="images/icons/pontaj_l{$item.Status}.png">{else}&nbsp;{/if}</td>
                        <td style="border-bottom: 1px solid #000000;">{if $item.Status < 7}<input type="button" value="{translate label='Valideaza'}"
                                                                                                  onclick="showInfo('{$smarty.server.REQUEST_URI}&action=accept&ID={$item.ID}&Status={math equation="x+1" x=$item.Status}', 'layer_p_content'); return false;">{else}&nbsp;{/if}
                        </td>
                    {else}
                        <td style="border-bottom: 1px solid #000000;">{if $item.Status > 0}<img src="images/icons/pontaj_l{$item.Status}.png">{else}&nbsp;{/if}</td>
                        <td colspan="3" style="border-bottom: 1px solid #000000;">&nbsp;</td>
                    {/if}
                </tr>
            {/if}
        {/foreach}
        <tr height="35">
            <td>
                <select id="CostCenterID_0" class="formstyle">
                    <option value="0"></option>
                    {foreach from=$costcenter key=key2 item=item2}
                        <option value="{$key2}">{$item2}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <input type="text" id="StartDate_0" class="formstyle" value="{$activities.0.StartDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                <input type="text" id="StartHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                <A HREF="#"
                   onClick="var cal1_0 = new CalendarPopup(); cal1_0.isShowNavigationDropdowns = true; cal1_0.setYearSelectStartOffset(10); cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"
                   NAME="anchor1_0" ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
            </td>
            <td>
                <input type="text" id="EndDate_0" class="formstyle" value="{$activities.0.StartDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                <input type="text" id="EndHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                <A HREF="#"
                   onClick="var cal2_0 = new CalendarPopup(); cal2_0.isShowNavigationDropdowns = true; cal2_0.setYearSelectStartOffset(10); cal2_0.select(document.getElementById('EndDate_0'),'anchor2_0','dd.MM.yyyy'); return false;"
                   NAME="anchor2_0" ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
            </td>
            <td>&nbsp;</td>
            <td>
                <select id="Type_0" class="formstyle">
                    <option value="0">{translate label='planificat'}</option>
                </select>
            </td>
            {if $activities.0.rw==1}
                <td>
                    <div id="button_add"><a href="#" onclick="if (validAct(0)) showInfo('{$smarty.server.REQUEST_URI}&action=new&ID=0' +
                                '&CostCenterID=' + document.getElementById('CostCenterID_0').value +
                                '&StartDate=' + document.getElementById('StartDate_0').value +
                                '&StartHour=' + document.getElementById('StartHour_0').value +
                                '&EndDate=' + document.getElementById('EndDate_0').value +
                                '&EndHour=' + document.getElementById('EndHour_0').value +
                                '&Type=' + document.getElementById('Type_0').value, 'layer_p_content'); return false;" title="{translate label='Adauga activitate'}"><b>Add</b></a>
                    </div>
                </td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            {/if}
        </tr>
        <tr height="35">
            <td colspan="2">&nbsp;</td>
            <td align="right" style="padding-right: 10px;"><b>{translate label='Total ore'}:</b></td>
            <td><b>{$activities.0.THours}</b></td>
            <td colspan="4">&nbsp;</td>
            <td>{if $activities|@count > 2 && $activities.0.rw==1 && $item.rw==1 && $activities.0.Status < 7}<input type="button" value="{translate label='Valideaza tot'}"
                                                                                                                    onclick="showInfo('{$smarty.server.REQUEST_URI}&action=accept_all&Status={math equation="x+1" x=$activities.0.Status}', 'layer_p_content'); return false;">{else}&nbsp;{/if}
            </td>
        </tr>
    </table>
    <br><br>
    {translate label='Observatii'}<br>
    <input type="text" id="Notes" class="formstyle" style="width: 80%; height: 30px;" value="{$Notes|default:''}">
    <br><br>
</div>

<hr class="dungaLayer"/>
<div class="saveObservatii">
    <input type="button" value="{translate label='Salveaza'}"
           onclick="showInfo('{$smarty.server.REQUEST_URI}&action=set_notes&Notes=' + escape(document.getElementById('Notes').value), 'layer_p_content'); document.getElementById('layer_p').style.display = 'none'; document.getElementById('layer_p_x').style.display = 'none'; window.location.reload(); return false;">
    <input type="button" value="{translate label='Anuleaza'}"
           onclick="document.getElementById('layer_p').style.display = 'none'; document.getElementById('layer_p_x').style.display = 'none';">
</div>
