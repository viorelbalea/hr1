{include file="persons_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
        </tr>
    </table>

    <div id="layer_displacement" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Costuri'}</h3>
        <div class="layerContent" id="layer_displacement_content"></div>

    </div>
    <div id="layer_displacement_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_displacement').style.display = 'none'; document.getElementById('layer_displacement_x').style.display = 'none'; window.location.reload();">
        x
    </div>

    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.post) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br/>
                <fieldset>
                    <legend>{translate label='Deplasari'}</legend>
                    {if !empty($displacements)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        {foreach from=$displacements key=Year item=item}
                            {if $Year!='Status' && $Year!='FullName'}
                                <tr>
                                    <td style="padding-top: 5px;"><a href="#"
                                                                     onclick="var status = document.getElementById('displacement_{$Year}').style.display; {foreach from=$displacements key=Year2 item=item2}$('displacement_{$Year2}').hide();{/foreach}if (status == 'none') Effect.SlideDown('displacement_{$Year}'); else Effect.SlideUp('displacement_{$Year}'); return false;"><b>{$Year}</b></a>
                                    </td>
                                </tr>
                            {/if}
                        {/foreach}
                        {/if}
                    </table>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="12%" align="center">{translate label='Tara'}</td>
                            <td width="12%;" align="center">{translate label='Locatie'}</td>
                            <td width="12%;" align="center">{translate label='Proiect'}</td>
                            <td width="12%;" align="center">{translate label='Centru cost'}</td>
                            <td width="16%;" align="center">{translate label='Data inceput'}</td>
                            <td width="16%;" align="center">{translate label='Data sfarsit'}</td>
                            <td width="5%;" align="center">{translate label='Durata'}</td>
                            <td width="5%;" align="center">{translate label='Cost total'}</td>
                            <td width="5%" align="center">&nbsp;</td>
                            <td width="5%" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">
                                <select name="CountryID_0" id="CountryID_0" style="width:90%;">
                                    <option value="0">{translate label='Tara'}</option>
                                    {foreach from=$countries item=item2 key=key2}
                                        <option value="{$key2}">{$item2.CountryName}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td align="center"><input type="text" name="Location_0" id="Location_0" value="" size="12" style="width:90%;"></td>
                            <td align="center">
                                <select name="ProjectID_0" id="ProjectID_0" style="width:100%;">
                                    <option value="0">{translate label='Proiect'}</option>
                                    {foreach from=$projects item=item2 key=key2}
                                        <option value="{$item2.ProjectID}">{$item2.Name}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td align="center">
                                <select name="CostCenterID_0" id="CostCenterID_0" style="width:100%;">
                                    <option value="0">{translate label='Centru cost'}</option>
                                    {foreach from=$costcenter item=item2 key=key2}
                                        <option value="{$key2}">{$item2}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td nowrap="nowrap" align="center" width="190px">

                                <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <input type="text" id="StartHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>

                            </td>
                            <td nowrap="nowrap" align="center" style="width:190px;">
                                <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <input type="text" id="StopHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td align="center">-</td>
                            <td align="center">-</td>
                            <td width="20" align="center">
                                <div id="button_add"><a href="#"
                                                        onclick="if (!is_empty(document.getElementById('StartDate_0').value) && checkDate(document.getElementById('StartDate_0').value, '{translate label='Data inceput'}') && !is_empty(document.getElementById('StopDate_0').value) && checkDate(document.getElementById('StopDate_0').value, '{translate label='Data sfarsit'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_displacement' +
                                                                '&CountryID=' + document.getElementById('CountryID_0').value +'&Location=' + escape(document.getElementById('Location_0').value) +         '&ProjectID=' + document.getElementById('ProjectID_0').value +                                                             '&CostCenterID=' + document.getElementById('CostCenterID_0').value +                                                             '&StartDate=' + document.getElementById('StartDate_0').value + ' ' + document.getElementById('StartHour_0').value +                                                                             '&StopDate=' + document.getElementById('StopDate_0').value + ' ' + document.getElementById('StopHour_0').value;                                                                                                                                                                                                         else alert('{translate label='Nu ati specificat toate informatiile despre deplasare!'}'); return false;"
                                                        title="{translate label='Adauga deplasare'}"><b>Add</b></a></div>
                            </td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>
                    {if !empty($displacements)}

                        {foreach from=$displacements key=Year item=detail}
                            <div id="displacement_{$Year}" style="display:none; background:#fff; text-align:center; width:100%">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                    {foreach from=$displacements.$Year item=item key=year}
                                        <tr>
                                            <td width="12%">
                                                <select name="CountryID_{$item.DisplacementID}" id="CountryID_{$item.DisplacementID}" style="width:90%;">
                                                    <option value="0">{translate label='Tara'}</option>
                                                    {foreach from=$countries item=item2 key=key2}
                                                        <option value="{$key2}" {if $item.CountryID==$key2} selected="selected"{/if}>{$item2.CountryName}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="12%;"><input type="text" name="Location_{$item.DisplacementID}" id="Location_{$item.DisplacementID}" value="{$item.Location}"
                                                                    size="12" style="width:90%;"></td>

                                            <td width="12%;">
                                                <select name="ProjectID_{$item.DisplacementID}" id="ProjectID_{$item.DisplacementID}" style="width:100%;">
                                                    <option value="0">{translate label='Proiect'}</option>
                                                    {foreach from=$projects item=item2 key=key2}
                                                        <option value="{$item2.ProjectID}" {if $item.ProjectID==$item2.ProjectID} selected="selected"{/if}>{$item2.Name}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="12%;">
                                                <select name="CostCenterID_{$item.DisplacementID}" id="CostCenterID_{$item.DisplacementID}" style="width:100%;">
                                                    <option value="0">{translate label='Centru cost'}</option>
                                                    {foreach from=$costcenter item=item2 key=key2}
                                                        <option value="{$key2}" {if $item.CostCenterID==$key2} selected="selected"{/if}>{$item2}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td nowrap="nowrap" width="16%;">
                                                <input type="text" name="StartDate_{$item.DisplacementID}" id="StartDate_{$item.DisplacementID}" class="formstyle"
                                                       value="{$item.StartDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                                                <input type="text" id="StartHour_{$item.DisplacementID}" class="formstyle" value="{$item.StartDate|date_format:'%H:%M'}" size="5"
                                                       maxlength="5" style="font-weight: bold;">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.DisplacementID}">
                                                    var cal1_{$item.DisplacementID} = new CalendarPopup();
                                                    cal1_{$item.DisplacementID}.isShowNavigationDropdowns = true;
                                                    cal1_{$item.DisplacementID}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$item.DisplacementID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal1_{$item.DisplacementID}.select(document.getElementById('StartDate_{$item.DisplacementID}'),'anchor1_{$item.DisplacementID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_{$item.DisplacementID}" ID="anchor1_{$item.DisplacementID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td nowrap="nowrap" width="16%;">
                                                <input type="text" name="StopDate_{$item.DisplacementID}" id="StopDate_{$item.DisplacementID}" class="formstyle"
                                                       value="{$item.StopDate|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                                                <input type="text" id="StopHour_{$item.DisplacementID}" class="formstyle" value="{$item.StopDate|date_format:'%H:%M'}" size="5"
                                                       maxlength="5" style="font-weight: bold;">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.DisplacementID}">
                                                    var cal2_{$item.DisplacementID} = new CalendarPopup();
                                                    cal2_{$item.DisplacementID}.isShowNavigationDropdowns = true;
                                                    cal2_{$item.DisplacementID}.setYearSelectStartOffset(10);
                                                    //writeSource("js2_{$item.DisplacementID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal2_{$item.DisplacementID}.select(document.getElementById('StopDate_{$item.DisplacementID}'),'anchor2_{$item.DisplacementID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_{$item.DisplacementID}" ID="anchor2_{$item.DisplacementID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td align="center" width="5%;">{$item.Sum}</td>
                                            <td align="center" width="5%;"><a href="#"
                                                                              onclick="getCost({$smarty.get.PersonID}, {$item.DisplacementID}); return false;">{$item.CostTotal|default:0}</a>
                                            </td>
                                            <td width="5%">
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('StartDate_{$item.DisplacementID}').value) && checkDate(document.getElementById('StartDate_{$item.DisplacementID}').value, '{translate label='Data inceput'}') && !is_empty(document.getElementById('StopDate_{$item.DisplacementID}').value) && checkDate(document.getElementById('StopDate_{$item.DisplacementID}').value, '{translate label='Data sfarsit'}')) window.location.href =    '{$smarty.server.REQUEST_URI}&action=edit_displacement&DisplacementID={$item.DisplacementID}' + '&CountryID=' + document.getElementById('CountryID_{$item.DisplacementID}').value +                                                                                                                                                                                                                                                        '&Location=' + escape(document.getElementById('Location_{$item.DisplacementID}').value) +                                                                                                                                                                                                                                                    '&ProjectID=' + document.getElementById('ProjectID_{$item.DisplacementID}').value +                                                                                                                                                                                                                                                    '&CostCenterID=' + document.getElementById('CostCenterID_{$item.DisplacementID}').value +                                                                                                                                                                                                                                                    '&StartDate=' + document.getElementById('StartDate_{$item.DisplacementID}').value + ' ' + document.getElementById('StartHour_{$item.DisplacementID}').value +                                                                                                                                                                                                                                                    '&StopDate=' + document.getElementById('StopDate_{$item.DisplacementID}').value + ' ' + document.getElementById('StopHour_{$item.DisplacementID}').value;                                                                                                                                                                                                                                                                else alert('Nu ati specificat toate informatiile despre deplasare!'); return false;"
                                                                        title="{translate label='Modifica deplasare'}"><b>Mod</b></a></div>
                                            </td>
                                            <td width="5%">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_displacement&DisplacementID={$item.DisplacementID}'; return false;"
                                                                        title="{translate label='Sterge deplasare'}"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/foreach}
                    {/if}
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function getCost(persid, displacementid) {
        showInfo('./?m=persons&o=displacement_cost&PersonID=' + persid + '&DisplacementID=' + displacementid, 'layer_displacement_content');
        document.getElementById('layer_displacement').style.display = 'block';
        document.getElementById('layer_displacement_x').style.display = 'block';
    }

    function validCost(id) {
        if (document.getElementById('CostSubtype_' + id).value == 0) {
            alert('{/literal}{translate label='Nu ati completat tipul cheltuielii'}{literal}!');
            return false;
        }
        if (is_empty(document.getElementById('Cost_' + id).value)) {
            alert('{/literal}{translate label='Nu ati completat valoarea'}{literal}!');
            return false;
        }
        if (is_empty(document.getElementById('CostDate_' + id).value)) {
            alert('{/literal}{translate label='Nu ati completat data'}{literal}!');
            return false;
        }
        return true;
    }
</script>
{/literal}