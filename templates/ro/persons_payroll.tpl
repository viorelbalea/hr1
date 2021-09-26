{include file="persons_menu.tpl"}
<div id="layer_co" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Descriere'}</h3>
    <div class="observatiiTextbox">
        <textarea id="layer_co_notes"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value=""/>

    </div>

    <div class="saveObservatii" style="margin-top: 4px">
        <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">
        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<!---->
<div id="layer_co_x" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>

<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
        </tr>
    </table>
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
                <!-- Salariu -->
                <fieldset>
                    <legend>{translate label='Salariu'}</legend>
                    {if !empty($salary)}
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_salary').style.display; if (status == 'none') Effect.SlideDown('div_salary'); else Effect.SlideUp('div_salary'); return false;"><b>{translate label='Istoric'}</b></a>
                        </p>
                    {/if}

                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
{*                            <td width="110px">{translate label='Salariu net'}</td>*}
                            <td width="110px">{translate label='Salariu de baza'}</td>
{*                            <td width="120px">{translate label='Cost total salariu'}</td>*}
                            <td width="70px">{translate label='Moneda'}</td>
                            <td width="120px">{translate label='Data inceput'}</td>
                            <td width="120px">{translate label='Data sfarsit'}</td>
                            <td width="20">&nbsp;</td>
                            <td width="20">&nbsp;</td>
                        </tr>
                        <tr>
{*                            <td><input type="text" id="SalaryNet_0" size="10"></td>*}
                            <td><input type="text" id="Salary_0" size="10"></td>
{*                            <td><input type="text" id="SalaryCost_0" size="10"></td>*}
                            <td><select id="Currency_0" name="Currency_0">
                                    {foreach from=$currencies item=curr}
                                        <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <input type="text" id="StartDate_0" class="formstyle" value="{$ls_startdate|default:''}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>{if $info.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.getElementById('Salary_0').value) && !is_empty(document.getElementById('StartDate_0').value) && checkDate(document.getElementById('StartDate_0').value, 'Data inceput')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary&Salary=' + document.getElementById('Salary_0').value +'&Currency=' + document.getElementById('Currency_0').value +'&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value; else alert('{translate label='Nu ati specificat toate informatiile despre salariu!'}'); return false;"
                                                            title="{translate label='Adauga salariu'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>

                    {if !empty($salary)}
                        <div id="div_salary" style="display:none; width:758px; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                {foreach from=$salary item=item}
                                    {assign var="ls_startdate" value=$item.StopDate}
                                    <tr>
{*                                        <td width="110px"><input type="text" id="SalaryNet_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>*}
                                        <td width="110px"><input type="text" id="Salary_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>

{*                                        <td width="120px"><input type="text" id="SalaryCost_{$item.SalaryID}" value="{$item.SalaryCost}" size="10"></td>*}
                                        <td width="70px"><select id="Currency_{$item.SalaryID}" name="Currency">
                                                {foreach from=$currencies item=curr}
                                                    <option value="{$curr}"
                                                            {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td width="120px">
                                            <input type="text" id="StartDate_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.SalaryID}">
                                                var cal1_{$item.SalaryID} = new CalendarPopup();
                                                cal1_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.SalaryID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.SalaryID}.select(document.getElementById('StartDate_{$item.SalaryID}'),'anchor1_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.SalaryID}" ID="anchor1_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td width="120px">
                                            <input type="text" id="StopDate_{$item.SalaryID}" class="formstyle" value="{$item.StopDate}" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.SalaryID}">
                                                var cal2_{$item.SalaryID} = new CalendarPopup();
                                                cal2_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.SalaryID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.SalaryID}.select(document.getElementById('StopDate_{$item.SalaryID}'),'anchor2_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.SalaryID}" ID="anchor2_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        {if $info.rw==1}
                                            <td width="20">
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('Salary_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDate_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDate_{$item.SalaryID}').value, 'Data inceput')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('Salary_{$item.SalaryID}').value + '&Currency=' + document.getElementById('Currency_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDate_{$item.SalaryID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.SalaryID}').value; else alert('{translate label='Nu ati specificat toate informatiile despre salariu!'}'); return false;"
                                                                        title="{translate label='Modifica salariu'}"><b>Mod</b></a></div>
                                            </td>
                                            <td width="20">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary&SalaryID={$item.SalaryID}'; return false;"
                                                                        title="{translate label='Sterge salariu'}"><b>Del</b></a></div>
                                            </td>
                                        {else}
                                            <td colspan="2">&nbsp;</td>
                                        {/if}
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    {/if}
                </fieldset>
                <br>
                <!-- Bonusuri -->
                <fieldset>
                    <legend>{translate label='Bonusuri'}</legend>
                    {if !empty($bonus)}
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_bonus').style.display; if (status == 'none') Effect.SlideDown('div_bonus'); else Effect.SlideUp('div_bonus'); return false;"><b>{translate label='Istoric'}</b></a>
                        </p>
                    {/if}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                        <tr>
                            <td width="120">{translate label='Bonus net'}</td>
                            <td width="120">{translate label='Bonus brut'}</td>
                            <td width="80">{translate label='Moneda'}</td>
                            <td width="130">{translate label='Data'}</td>
                            <td width="110">{translate label='Comentariu'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="SalaryNetB_0" size="10"></td>
                            <td><input type="text" id="SalaryB_0" size="10"></td>
                            <td><select id="CurrencyB_0" name="CurrencyB_0">
                                    {foreach from=$currencies item=curr}
                                        <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <input type="text" id="StartDateB_0" class="formstyle" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js5_0">
                                    var cal5_0 = new CalendarPopup();
                                    cal5_0.isShowNavigationDropdowns = true;
                                    cal5_0.setYearSelectStartOffset(10);
                                    //writeSource("js5_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal5_0.select(document.getElementById('StartDateB_0'),'anchor5_0','dd.MM.yyyy'); return false;" NAME="anchor5_0"
                                   ID="anchor5_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="hidden" id="NotesB_0" value=""/>
                                <span id="NotesB_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('NotesB_0'); return false;">{translate label='Editare'}</a>]
                            </td>
                            <td>{if $info.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.getElementById('SalaryB_0').value) && !is_empty(document.getElementById('SalaryNetB_0').value) && !is_empty(document.getElementById('StartDateB_0').value) && checkDate(document.getElementById('StartDateB_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=bonus&Salary=' + document.getElementById('SalaryB_0').value + '&SalaryNet=' + document.getElementById('SalaryNetB_0').value + '&Currency=' + document.getElementById('CurrencyB_0').value +'&StartDate=' + document.getElementById('StartDateB_0').value + '&Notes=' + escape(document.getElementById('NotesB_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                            title="{translate label='Adauga bonus'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>

                    {if !empty($bonus)}
                        <div id="div_bonus" style="display:none; width:700px; background:#ccc; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" style="width:700px;">
                                {foreach from=$bonus item=item}
                                    <tr>
                                        <td width="120"><input type="text" id="SalaryNetB_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                        <td width="120"><input type="text" id="SalaryB_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                        <td width="80">
                                            <select id="CurrencyB_{$item.SalaryID}" name="CurrencyB_{$item.SalaryID}">
                                                {foreach from=$currencies item=curr}
                                                    <option value="{$curr}"
                                                            {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td width="130">
                                            <input type="text" id="StartDateB_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js5_{$item.SalaryID}">
                                                var cal5_{$item.SalaryID} = new CalendarPopup();
                                                cal5_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                cal5_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                //writeSource("js5_{$item.SalaryID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal5_{$item.SalaryID}.select(document.getElementById('StartDateB_{$item.SalaryID}'),'anchor5_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor5_{$item.SalaryID}" ID="anchor5_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td width="110">
                                            <input type="hidden" id="NotesB_{$item.SalaryID}" value="{$item.Notes}"/>
                                            <span id="NotesB_{$item.SalaryID}_display"></span>
                                            [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                onclick="getNotes('NotesB_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                        </td>
                                        {if $info.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('SalaryB_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetB_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateB_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateB_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=bonus&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryB_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetB_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyB_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateB_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('NotesB_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                                        title="{translate label='Modifica bonus'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                        title="{translate label='Sterge bonus'}"><b>Del</b></a></div>
                                            </td>
                                        {else}
                                            <td colspan="2">&nbsp;</td>
                                        {/if}
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    {/if}
                </fieldset>
                {if 1 == 2}
                    <!-- Contract PFA -->
                    <br/>
                    <fieldset>
                        <legend>{translate label='Contract'} </legend>
                        {if !empty($salaryPFA)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_salaryPFA').style.display; if (status == 'none') Effect.SlideDown('div_salaryPFA'); else Effect.SlideUp('div_salaryPFA'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="760">
                            <tr>
                                <td width="110px">{translate label='Valoare neta'}</td>
                                <td width="110px">{translate label='Valoare bruta'}</td>
                                <td width="120px">{translate label='Cost total contract'}</td>
                                <td width="70px">{translate label='Moneda'}</td>
                                <td width="120px">{translate label='Data inceput'}</td>
                                <td width="110px">{translate label='Data sfarsit'}</td>
                                <td width="20">&nbsp;</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetPFA_0" size="10"></td>
                                <td><input type="text" id="SalaryPFA_0" size="10"></td>
                                <td><input type="text" id="SalaryCostPFA_0" size="10"></td>
                                <td>
                                    <select id="CurrencyPFA_0" name="CurrencyPFA_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDatePFA_0" class="formstyle" value="{$ls_startdate|default:''}" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_0">
                                        var cal3_0 = new CalendarPopup();
                                        cal3_0.isShowNavigationDropdowns = true;
                                        cal3_0.setYearSelectStartOffset(10);
                                        //writeSource("js3_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_0.select(document.getElementById('StartDatePFA_0'),'anchor3_0','dd.MM.yyyy'); return false;" NAME="anchor3_0"
                                       ID="anchor3_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="text" id="StopDatePFA_0" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_0">
                                        var cal4_0 = new CalendarPopup();
                                        cal4_0.isShowNavigationDropdowns = true;
                                        cal4_0.setYearSelectStartOffset(10);
                                        //writeSource("js4_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_0.select(document.getElementById('StopDatePFA_0'),'anchor4_0','dd.MM.yyyy'); return false;" NAME="anchor4_0"
                                       ID="anchor4_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryPFA_0').value) && !is_empty(document.getElementById('SalaryNetPFA_0').value) && !is_empty(document.getElementById('StartDatePFA_0').value) && checkDate(document.getElementById('StartDatePFA_0').value, 'Data inceput')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salaryPFA&Salary=' + document.getElementById('SalaryPFA_0').value + '&SalaryNet=' + document.getElementById('SalaryNetPFA_0').value + '&SalaryCost=' + document.getElementById('SalaryCostPFA_0').value +'&Currency=' + document.getElementById('CurrencyPFA_0').value +'&StartDate=' + document.getElementById('StartDatePFA_0').value + '&StopDate=' + document.getElementById('StopDatePFA_0').value; else alert('{translate label='Nu ati specificat toate informatiile despre PFA!'}'); return false;"
                                                                title="{translate label='Adauga contract'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>

                        {if !empty($salaryPFA)}
                            <div id="div_salaryPFA" style="display:none; width:760px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

                                    {foreach from=$salaryPFA item=item}
                                        {assign var="ls_startdate" value=$item.StopDate}
                                        <tr>
                                            <td width="110px"><input type="text" id="SalaryNetPFA_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="110px"><input type="text" id="SalaryPFA_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="120px"><input type="text" id="SalaryCostPFA_{$item.SalaryID}" value="{$item.SalaryCost}" size="10"></td>
                                            <td width="70px">
                                                <select id="CurrencyPFA_{$item.SalaryID}" name="CurrencyPFA_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="120px">
                                                <input type="text" id="StartDatePFA_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.SalaryID}">
                                                    var cal3_{$item.SalaryID} = new CalendarPopup();
                                                    cal3_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal3_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js3_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal3_{$item.SalaryID}.select(document.getElementById('StartDatePFA_{$item.SalaryID}'),'anchor3_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor3_{$item.SalaryID}" ID="anchor3_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="120px">
                                                <input type="text" id="StopDatePFA_{$item.SalaryID}" class="formstyle" value="{$item.StopDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js4_{$item.SalaryID}">
                                                    var cal4_{$item.SalaryID} = new CalendarPopup();
                                                    cal4_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal4_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js4_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal4_{$item.SalaryID}.select(document.getElementById('StopDatePFA_{$item.SalaryID}'),'anchor4_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor4_{$item.SalaryID}" ID="anchor4_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            {if $info.rw==1}
                                                <td width="20">
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryPFA_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetPFA_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDatePFA_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDatePFA_{$item.SalaryID}').value, 'Data inceput')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salaryPFA&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryPFA_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetPFA_{$item.SalaryID}').value + '&SalaryCost=' + document.getElementById('SalaryCostPFA_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyPFA_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDatePFA_{$item.SalaryID}').value + '&StopDate=' + document.getElementById('StopDatePFA_{$item.SalaryID}').value; else alert('{translate label='Nu ati specificat toate informatiile despre PFA!'}'); return false;"
                                                                            title="{translate label='Modifica contract'}"><b>Mod</b></a></div>
                                                </td>
                                                <td width="20">
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salaryPFA&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge contract'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td width="40" colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                    <br/>
                    <!-- Concediu odihna neefectuat -->
                    <fieldset>
                        <legend>{translate label='Concediu odihna neefectuat'}</legend>
                        {if !empty($concediu)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_concediu').style.display; if (status == 'none') Effect.SlideDown('div_concediu'); else Effect.SlideUp('div_concediu'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="150">{translate label='Valoare Concediu net'}</td>
                                <td width="150">{translate label='Valoare Concediu brut'}</td>
                                <td width="80">{translate label='Moneda'}</td>
                                <td width="130">{translate label='Data'}</td>
                                <td width="110">{translate label='Comentariu'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetConcediu_0" size="10"></td>
                                <td><input type="text" id="SalaryConcediu_0" size="10"></td>
                                <td><select id="CurrencyConcediu_0" name="CurrencyConcediu_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateConcediu_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="jsCO_0">
                                        var calCO_0 = new CalendarPopup();
                                        calCO_0.isShowNavigationDropdowns = true;
                                        calCO_0.setYearSelectStartOffset(10);
                                        //writeSource("jsCO_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="calCO_0.select(document.getElementById('StartDateConcediu_0'),'anchorCO_0','dd.MM.yyyy'); return false;" NAME="anchorCO_0"
                                       ID="anchorCO_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesConcediu_0" value=""/>
                                    <span id="NotesConcediu_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesConcediu_0'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryConcediu_0').value) && !is_empty(document.getElementById('SalaryNetConcediu_0').value) && !is_empty(document.getElementById('StartDateConcediu_0').value) && checkDate(document.getElementById('StartDateConcediu_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=concediu&Salary=' + document.getElementById('SalaryConcediu_0').value + '&SalaryNet=' + document.getElementById('SalaryNetConcediu_0').value + '&Currency=' + document.getElementById('CurrencyConcediu_0').value +'&StartDate=' + document.getElementById('StartDateConcediu_0').value + '&Notes=' + escape(document.getElementById('NotesConcediu_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediu odihna neefectuat!'}'); return false;"
                                                                title="{translate label='Adauga concediu odihna neefectuat'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>

                        {if !empty($concediu)}
                            <div id="div_concediu" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" style="width:700px;">
                                    {foreach from=$concediu item=item}
                                        <tr>
                                            <td width="150"><input type="text" id="SalaryNetConcediu_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="150"><input type="text" id="SalaryConcediu_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyConcediu_{$item.SalaryID}" name="CurrencyConcediu_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateConcediu_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="jsCO_{$item.SalaryID}">
                                                    var calCO_{$item.SalaryID} = new CalendarPopup();
                                                    calCO_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    calCO_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("jsCO_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="calCO_{$item.SalaryID}.select(document.getElementById('StartDateConcediu_{$item.SalaryID}'),'anchorConcediu_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorConcediu_{$item.SalaryID}" ID="anchorConcediu_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesConcediu_{$item.SalaryID}" value="{$item.Notes}"/>
                                                <span id="NotesConcediu_{$item.SalaryID}_display"></span>
                                                [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                    onclick="getNotes('NotesConcediu_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryConcediu_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetConcediu_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateConcediu_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateConcediu_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=concediu&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryConcediu_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetConcediu_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyConcediu_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateConcediu_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('NotesConcediu_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediu odihna neefectuat!'}'); return false;"
                                                                            title="{translate label='Modifica concediu odihna neefectuat'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge concediu odihna neefectuat'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                    <br/>
                    <!-- Bonusuri vanzari -->
                    <fieldset>
                        <legend>{translate label='Bonusuri vanzari'}</legend>
                        {if !empty($bonus_sales)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusSales').style.display; if (status == 'none') Effect.SlideDown('div_bonusSales'); else Effect.SlideUp('div_bonusSales'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120">{translate label='Bonus net'}</td>
                                <td width="120">{translate label='Bonus brut'}</td>
                                <td width="80">{translate label='Moneda'}</td>
                                <td width="130">{translate label='Data'}</td>
                                <td width="110">{translate label='Comentariu'}</td>
                                <td width="20">&nbsp;</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBS_0" size="10"></td>
                                <td><input type="text" id="SalaryBS_0" size="10"></td>
                                <td><select id="CurrencyBS_0" name="CurrencyBS_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBS_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_0">
                                        var cal7_0 = new CalendarPopup();
                                        cal7_0.isShowNavigationDropdowns = true;
                                        cal7_0.setYearSelectStartOffset(10);
                                        //writeSource("js7_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal7_0.select(document.getElementById('StartDateBS_0'),'anchor7_0','dd.MM.yyyy'); return false;" NAME="anchor7_0"
                                       ID="anchor7_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBS_0" value=""/>
                                    <span id="NotesBS_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBS_0'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBS_0').value) && !is_empty(document.getElementById('SalaryNetBS_0').value) && !is_empty(document.getElementById('StartDateBS_0').value) && checkDate(document.getElementById('StartDateBS_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=bonus_sales&Salary=' + document.getElementById('SalaryBS_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBS_0').value + '&Currency=' + document.getElementById('CurrencyBS_0').value +'&StartDate=' + document.getElementById('StartDateBS_0').value + '&Notes=' + escape(document.getElementById('NotesBS_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                                title="{translate label='Adauga bonus'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        {if !empty($bonus_sales)}
                            <div id="div_bonusSales" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">

                                    {foreach from=$bonus_sales item=item}
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBS_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBS_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBS_{$item.SalaryID}" name="CurrencyBS_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBS_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js7_{$item.SalaryID}">
                                                    var cal7_{$item.SalaryID} = new CalendarPopup();
                                                    cal7_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal7_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js7_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal7_{$item.SalaryID}.select(document.getElementById('StartDateBS_{$item.SalaryID}'),'anchor7_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor7_{$item.SalaryID}" ID="anchor7_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBS_{$item.SalaryID}" value="{$item.Notes}"/>
                                                <span id="NotesBS_{$item.SalaryID}_display"></span>
                                                [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                    onclick="getNotes('NotesBS_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBS_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetBS_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateBS_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateBS_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=bonus_sales&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryBS_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetBS_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyBS_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateBS_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('NotesBS_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                                            title="{translate label='Modifica bonus'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge bonus'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                    <br>
                    <!-- Avantaj natura -->
                    <fieldset>
                        <legend>{translate label='Avantaj natura'}</legend>
                        {if !empty($bonus_natura)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusNatura').style.display; if (status == 'none') Effect.SlideDown('div_bonusNatura'); else Effect.SlideUp('div_bonusNatura'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}

                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120">{translate label='Bonus net'}</td>
                                <td width="120">{translate label='Bonus brut'}</td>
                                <td width="80">{translate label='Moneda'}</td>
                                <td width="130">{translate label='Data'}</td>
                                <td width="110">{translate label='Comentariu'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBN_0" size="10"></td>
                                <td><input type="text" id="SalaryBN_0" size="10"></td>
                                <td><select id="CurrencyBN_0" name="CurrencyBN_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBN_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js8_0">
                                        var cal8_0 = new CalendarPopup();
                                        cal8_0.isShowNavigationDropdowns = true;
                                        cal8_0.setYearSelectStartOffset(10);
                                        //writeSource("js8_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal8_0.select(document.getElementById('StartDateBN_0'),'anchor8_0','dd.MM.yyyy'); return false;" NAME="anchor8_0"
                                       ID="anchor8_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBN_0" value=""/>
                                    <span id="NotesBN_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBN_0'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBN_0').value) && !is_empty(document.getElementById('SalaryNetBN_0').value) && !is_empty(document.getElementById('StartDateBN_0').value) && checkDate(document.getElementById('StartDateBN_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=bonus_natura&Salary=' + document.getElementById('SalaryBN_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBN_0').value + '&Currency=' + document.getElementById('CurrencyBN_0').value +'&StartDate=' + document.getElementById('StartDateBN_0').value + '&Notes=' + escape(document.getElementById('NotesBN_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                                title="{translate label='Adauga bonus'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        {if !empty($bonus_natura)}
                            <div id="div_bonusNatura" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                                    {foreach from=$bonus_natura item=item}
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBN_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBN_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBN_{$item.SalaryID}" name="CurrencyBN_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBN_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js8_{$item.SalaryID}">
                                                    var cal8_{$item.SalaryID} = new CalendarPopup();
                                                    cal8_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal8_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js8_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal8_{$item.SalaryID}.select(document.getElementById('StartDateBN_{$item.SalaryID}'),'anchor8_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor8_{$item.SalaryID}" ID="anchor8_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBN_{$item.SalaryID}" value="{$item.Notes}"/>
                                                <span id="NotesBN_{$item.SalaryID}_display"></span>
                                                [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                    onclick="getNotes('NotesBN_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBN_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetBN_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateBN_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateBN_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=bonus_natura&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryBN_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetBN_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyBN_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateBN_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('NotesBN_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre bonus!'}'); return false;"
                                                                            title="{translate label='Modifica bonus'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge bonus'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                    <br>
                    <!-- Prime -->
                    <fieldset>
                        <legend>{translate label='Prime'}</legend>
                        {if !empty($bonus_prime)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusPrime').style.display; if (status == 'none') Effect.SlideDown('div_bonusPrime'); else Effect.SlideUp('div_bonusPrime'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}

                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120">{translate label='Valoare neta'}</td>
                                <td width="120">{translate label='Valoare bruta'}</td>
                                <td width="80">{translate label='Moneda'}</td>
                                <td width="130">{translate label='Data'}</td>
                                <td width="110">{translate label='Comentariu'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBP_0" size="10"></td>
                                <td><input type="text" id="SalaryBP_0" size="10"></td>
                                <td><select id="CurrencyBP_0" name="CurrencyBP_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBP_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js9_0">
                                        var cal9_0 = new CalendarPopup();
                                        cal9_0.isShowNavigationDropdowns = true;
                                        cal9_0.setYearSelectStartOffset(10);
                                        //writeSource("js9_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal9_0.select(document.getElementById('StartDateBP_0'),'anchor9_0','dd.MM.yyyy'); return false;" NAME="anchor9_0"
                                       ID="anchor9_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBP_0" value=""/>
                                    <span id="NotesBP_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBP_0'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBP_0').value) && !is_empty(document.getElementById('SalaryNetBP_0').value) && !is_empty(document.getElementById('StartDateBP_0').value) && checkDate(document.getElementById('StartDateBP_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=bonus_prime&Salary=' + document.getElementById('SalaryBP_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBP_0').value + '&Currency=' + document.getElementById('CurrencyBP_0').value +'&StartDate=' + document.getElementById('StartDateBP_0').value + '&Notes=' + escape(document.getElementById('NotesBP_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre prima!'}'); return false;"
                                                                title="{translate label='Adauga prima'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        {if !empty($bonus_prime)}
                            <div id="div_bonusPrime" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                                    {foreach from=$bonus_prime item=item}
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBP_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBP_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBP_{$item.SalaryID}" name="CurrencyBP_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBP_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js9_{$item.SalaryID}">
                                                    var cal9_{$item.SalaryID} = new CalendarPopup();
                                                    cal9_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal9_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js9_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal9_{$item.SalaryID}.select(document.getElementById('StartDateBP_{$item.SalaryID}'),'anchor9_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor9_{$item.SalaryID}" ID="anchor9_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBP_{$item.SalaryID}" value="{$item.Notes}"/>
                                                <span id="NotesBP_{$item.SalaryID}_display"></span>
                                                [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                    onclick="getNotes('NotesBP_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBP_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetBP_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateBP_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateBP_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=bonus_prime&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryBP_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetBP_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyBP_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateBP_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('NotesBP_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre prima!'}'); return false;"
                                                                            title="{translate label='Modifica prima'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge prima'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                    <br/>
                    <!-- Penalizari -->
                    <fieldset>
                        <legend>{translate label='Penalizari'}</legend>
                        {if !empty($malus)}
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_malus').style.display; if (status == 'none') Effect.SlideDown('div_malus'); else Effect.SlideUp('div_malus'); return false;"><b>{translate label='Istoric'}</b></a>
                            </p>
                        {/if}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120">{translate label='Malus net'}</td>
                                <td width="120">{translate label='Malus brut'}</td>
                                <td width="80">{translate label='Moneda'}</td>
                                <td width="130">{translate label='Data'}</td>
                                <td width="110">{translate label='Comentariu'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetM_0" size="10"></td>
                                <td><input type="text" id="SalaryM_0" size="10"></td>
                                <td><select id="CurrencyM_0" name="CurrencyM_0">
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $smarty.session.CURRENCY.CURRENT}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateM_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_0">
                                        var cal6_0 = new CalendarPopup();
                                        cal6_0.isShowNavigationDropdowns = true;
                                        cal6_0.setYearSelectStartOffset(10);
                                        //writeSource("js6_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_0.select(document.getElementById('StartDateM_0'),'anchor6_0','dd.MM.yyyy'); return false;" NAME="anchor6_0"
                                       ID="anchor6_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="Notes_0" value=""/>
                                    <span id="Notes_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw==1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryM_0').value) && !is_empty(document.getElementById('SalaryNetM_0').value) && !is_empty(document.getElementById('StartDateM_0').value) && checkDate(document.getElementById('StartDateM_0').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_salary_extra&Type=malus&Salary=' + document.getElementById('SalaryM_0').value + '&SalaryNet=' + document.getElementById('SalaryNetM_0').value + '&Currency=' + document.getElementById('CurrencyM_0').value + '&StartDate=' + document.getElementById('StartDateM_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Nu ati specificat toate informatiile despre penalizare!'}'); return false;"
                                                                title="{translate label='Adauga penalizare'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        {if !empty($malus)}
                            <div id="div_malus" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">

                                    {foreach from=$malus item=item}
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetM_{$item.SalaryID}" value="{$item.SalaryNet}" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryM_{$item.SalaryID}" value="{$item.Salary}" size="10"></td>
                                            <td width="80"><select id="CurrencyM_{$item.SalaryID}" name="CurrencyM_{$item.SalaryID}">
                                                    {foreach from=$currencies item=curr}
                                                        <option value="{$curr}"
                                                                {if (!empty($item.Currency) && ($curr == $item.Currency)) || (empty($item.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateM_{$item.SalaryID}" class="formstyle" value="{$item.StartDate}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js6_{$item.SalaryID}">
                                                    var cal6_{$item.SalaryID} = new CalendarPopup();
                                                    cal6_{$item.SalaryID}.isShowNavigationDropdowns = true;
                                                    cal6_{$item.SalaryID}.setYearSelectStartOffset(10);
                                                    //writeSource("js6_{$item.SalaryID}");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal6_{$item.SalaryID}.select(document.getElementById('StartDateM_{$item.SalaryID}'),'anchor6_{$item.SalaryID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor6_{$item.SalaryID}" ID="anchor6_{$item.SalaryID}"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="Notes_{$item.SalaryID}" value="{$item.Notes}"/>
                                                <span id="Notes_{$item.SalaryID}_display"></span>
                                                [<a href="#" title="{$item.Notes|escape:'javascript'}"
                                                    onclick="getNotes('Notes_{$item.SalaryID}'); return false;">{translate label='Editare'}</a>]
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryM_{$item.SalaryID}').value) && !is_empty(document.getElementById('SalaryNetM_{$item.SalaryID}').value) && !is_empty(document.getElementById('StartDateM_{$item.SalaryID}').value) && checkDate(document.getElementById('StartDateM_{$item.SalaryID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_salary_extra&Type=malus&SalaryID={$item.SalaryID}&Salary=' + document.getElementById('SalaryM_{$item.SalaryID}').value + '&SalaryNet=' + document.getElementById('SalaryNetM_{$item.SalaryID}').value + '&Currency=' + document.getElementById('CurrencyM_{$item.SalaryID}').value + '&StartDate=' + document.getElementById('StartDateM_{$item.SalaryID}').value + '&Notes=' + escape(document.getElementById('Notes_{$item.SalaryID}').value); else alert('{translate label='Nu ati specificat toate informatiile despre penalizare!'}'); return false;"
                                                                            title="{translate label='Modifica penalizare'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_salary_extra&SalaryID={$item.SalaryID}'; return false;"
                                                                            title="{translate label='Sterge penalizare'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                </table>
                            </div>
                        {/if}
                    </fieldset>
                {/if}
                <p style="padding: 10px"><input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle"></p>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
    <script type="text/javascript">

        function getNotes(id) {
            document.getElementById('layer_co_notes').value = document.getElementById(id).value;
            document.getElementById('layer_co_notes_dest').value = id;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
        }

        function setNotes() {
            var id = document.getElementById('layer_co_notes_dest').value;
            document.getElementById(id).value = document.getElementById('layer_co_notes').value;
            document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
            document.getElementById('layer_co').style.display = 'none';
            document.getElementById('layer_co_x').style.display = 'none';
        }

    </script>
{/literal}