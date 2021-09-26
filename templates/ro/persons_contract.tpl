{include file="persons_menu.tpl"}
<div id="layer_co" class="layer" style="display: none;">
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
<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
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
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px; border-bottom:none;">
                <br>
                <fieldset>
                    <legend>{translate label='Contract/Raport de serviciu'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;" width="180"><b>{translate label='Data angajarii'}:*</b></td>
                            <td style="padding-top: 10px;">
                                <input type="text" name="StartDate" class="formstyle"
                                       value="{if !empty($info.StartDate) && $info.StartDate != '0000-00-00'}{$info.StartDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Modalitatea de angajare'}:</b></td>
                            <td>
                                <select name="ModalitateAngajare">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$modalitateAngajare key=key item=item}
                                        <option value="{$key}" {if !empty($info.ModalitateAngajare) && $info.ModalitateAngajare == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Data plecarii:</b></td>
                            <td>
                                <input type="text" name="StopDate" class="formstyle"
                                       value="{if ($info.Status == 5 || $info.Status == 6) && !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" readonly>
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                {if $info.Status == 5 || $info.Status == 6}
                                    <A HREF="#" onClick="cal2.select(document.pers.StopDate,'anchor2','dd.MM.yyyy'); document.pers.LeaveReason.disabled = false; return false;"
                                       NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A>
                                    |
                                    <A HREF="#"
                                       onClick="document.pers.StopDate.value = ''; document.pers.LeaveReason.disabled = true; return false;">{translate label='anuleaza'}</A>
                                {/if}
                                <br>
                                ({translate label='doar pentru persoane cu status Plecat / Disponibilizat'})
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Motivul plecarii'}:</b></td>
                            <td>
                                <select name="LeaveReason">
                                    <option value="0">alege...</option>
                                    {foreach from=$leavereason key=key item=item}
                                        <option value="{$key}"
                                                {if ($info.Status == 5 || $info.Status == 6) && !empty($info.LeaveReason) && $key == $info.LeaveReason}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <div id="div_Law" style="float: right; display: none;">&nbsp;{translate label='conform articol lege'}&nbsp;<input type="text" name="Law"
                                                                                                                                                  value="{$info.Law|default:''}"
                                                                                                                                                  size="20" maxlength="255"></div>
                                {literal}
                                <script language="javascript">
                                    document.pers.LeaveReason.disabled = true;
                                    if (document.pers.StopDate.value) {
                                        document.pers.LeaveReason.disabled = false;
                                    }
                                    {/literal}
                                    {if $info.Status == 5 || $info.Status == 6}document.getElementById('div_Law').style.display = 'block';{/if}
                                    {literal}
                                </script>
                                {/literal}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar cerere de demisie /<br/>incetare cu acordul partilor'}:</b></td>
                            <td>
                                <input type="text" {if $info.Status != 5 && $info.Status != 6}disabled='true'{/if} name="ResignationDemandNo"
                                       value="{$info.ResignationDemandNo|default:''}" size="20" maxlength="255"/>
                                <br/>
                                ({translate label='doar pentru persoane cu status Plecat / Disponibilizat'})
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 40px;"><b>{translate label='Durata contract/raport de serviciu'}:</b></td>
                            <td style="padding-top: 40px;">
                                <select name="ContractType" onchange="if (this.value > 0) changeContractType(this.value);">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$contract_type key=key item=item}
                                        <option value="{$key}" {if !empty($info.ContractType) && $info.ContractType == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Perioada proba/stagiu/preaviz'}:</b></td>
                            <td>
                                {translate label='Proba/stagiu'}:
                                <select name="ContractProbationPeriod">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$probation_periods item=item}
                                        <option value="{$item}" {if $info.ContractProbationPeriod == $item}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                {translate label='zile lucratoare'}
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {translate label='Perioada preaviz'}:
                                <select name="ContractDismissalPeriod">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$dismissal_periods item=item}
                                        <option value="{$item}" {if $info.ContractDismissalPeriod == $item}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                {translate label='zile lucratoare'}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                {translate label='Data inceput'}:
                                <input type="text" name="ProbaStartDate" class="formstyle"
                                       value="{if !empty($info.ProbaStartDate) && $info.ProbaStartDate != '0000-00-00'}{$info.ProbaStartDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_ProbaStartDate">
                                    var cal_ProbaStartDate = new CalendarPopup();
                                    cal_ProbaStartDate.isShowNavigationDropdowns = true;
                                    cal_ProbaStartDate.setYearSelectStartOffset(10);
                                </SCRIPT>
                                <A HREF="#" onClick="cal_ProbaStartDate.select(document.pers.ProbaStartDate,'anchor_ProbaStartDate','dd.MM.yyyy'); return false;" NAME="anchor_ProbaStartDate" ID="anchor_ProbaStartDate"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ProbaStartDate.value = ''; return false;">anuleaza</A>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                {translate label='Data final'}:
                                <input type="text" name="ProbaStopDate" class="formstyle"
                                       value="{if !empty($info.ProbaStopDate) && $info.ProbaStopDate != '0000-00-00'}{$info.ProbaStopDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_ProbaStopDate">
                                    var cal_ProbaStopDate = new CalendarPopup();
                                    cal_ProbaStopDate.isShowNavigationDropdowns = true;
                                    cal_ProbaStopDate.setYearSelectStartOffset(10);
                                </SCRIPT>
                                <A HREF="#" onClick="cal_ProbaStopDate.select(document.pers.ProbaStopDate,'anchor_ProbaStopDate','dd.MM.yyyy'); return false;" NAME="anchor_ProbaStopDate" ID="anchor_ProbaStopDate"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ProbaStopDate.value = ''; return false;">anuleaza</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data contract/act administrativ'}:</b></td>
                            <td>
                                <input type="text" name="ContractDate" class="formstyle"
                                       value="{if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.ContractDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ContractDate.value = ''; return false;">anuleaza</A>
                            </td>
                        </tr>
                        <tr id="div_ContractExpDate">
                            <td><b>{translate label='Data expirare contract'}:</b><br/>{translate label='(ultima zi lucratoare in companie)'}</td>
                            <td>
                                <input type="text" name="ContractExpDate" class="formstyle"
                                       value="{if !empty($info.ContractExpDate) && $info.ContractExpDate != '0000-00-00'}{$info.ContractExpDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4">
                                    var cal4 = new CalendarPopup();
                                    cal4.isShowNavigationDropdowns = true;
                                    cal4.setYearSelectStartOffset(10);
                                    //writeSource("js4");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4.select(document.pers.ContractExpDate,'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.ContractExpDate.value = ''; return false;">{translate label='anuleaza'}</A>
                                <script language="javascript">
                                    {if $info.ContractType != 1}
                                    document.getElementById('div_ContractExpDate').style.display = 'none';
                                    {/if}
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar contract/act administrativ'}:</b></td>
                            <td><input type="text" name="ContractNo" value="{$info.ContractNo|default:''}" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip angajat'}:</b></td>
                            <td>{$status[$info.Status]} | {$substatus[$info.Status][$info.SubStatus]}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip norma'}:</b></td>
                            <td>
                                <select name="NormType">
                                    <option value="">- alege -</option>
                                    {foreach from=$normType key=key item=item}
                                        <option value="{$key}" {if $info.NormType == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Durata timp munca'}:</b></td>
                            <td>
                                <select name="WorkLength">
                                    <option value="">- alege -</option>
                                    {foreach from=$workLength key=key item=item}
                                        <option value="{$key}" {if $info.WorkLength == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Repartizare timp munca'}:</b></td>
                            <td>
                                <select name="WorkTime">
                                    <option value="">- alege -</option>
                                    {foreach from=$workTime key=key item=item}
                                        <option value="{$key}" {if $info.WorkTime == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Program de lucru'}:</b></td>
                            <td>
                                <select name="WorkPrg">
                                    <option value="">- alege -</option>
                                    {foreach from=$workPrg key=key item=item}
                                        <option value="{$key}" {if $info.WorkPrg == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <!--<tr>
                            <td><b>{translate label='Norma de lucru'}:</b></td>
                            <td><input type="text" name="WorkNorm" value="{if !empty($info.WorkNorm)}{$info.WorkNorm}{else}8{/if}" size="3"
                                       maxlength="2"> {translate label='(ore de lucru / zi)'}</td>
                        </tr>-->
                        <!--<tr>
                            <td><b>{translate label='Ora de inceput program'}:</b></td>
                            <td>
                                <select name="WorkStartHour">
                                    <option value=""></option>
                                    {foreach from=$hours item=hour}
                                        <option value="{$hour}" {if $info.WorkStartHour|default:'09:00' == $hour}selected{/if}>{$hour}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>-->
                        <!--<tr>
                            <td><b>{translate label='Intervalul orar de pauza'}:</b></td>
                            <td>
                                <select name="LunchBreakStartHour">
                                    <option value=""></option>
                                    {foreach from=$hours item=hour}
                                        <option value="{$hour}" {if $info.LunchBreakStartHour|default:'13:00' == $hour}selected{/if}>{$hour}</option>
                                    {/foreach}
                                </select>
                                :
                                <select name="LunchBreakEndHour">
                                    <option value=""></option>
                                    {foreach from=$hours item=hour}
                                        <option value="{$hour}" {if $info.LunchBreakEndHour|default:'14:00' == $hour}selected{/if}>{$hour}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>-->
                    </table>
                    <div id="div_Suspendat" style="display: none;">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td style="padding-top: 10px;" width="180"><b>{translate label='Data suspendarii'}:</b></td>
                                <td style="padding-top: 10px;">
                                    <input type="text" name="SuspendDate" class="formstyle"
                                           value="{if !empty($info.SuspendDate) && $info.SuspendDate != '0000-00-00'}{$info.SuspendDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                           maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js5">
                                        var cal5 = new CalendarPopup();
                                        cal5.isShowNavigationDropdowns = true;
                                        cal5.setYearSelectStartOffset(10);
                                        //writeSource("js5");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal5.select(document.pers.SuspendDate,'anchor5','dd.MM.yyyy'); return false;" NAME="anchor5" ID="anchor5"><img
                                                src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Motivul suspendarii'}:</b></td>
                                <td>
                                    <select name="SuspReason">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$suspReason key=key item=item}
                                            <option value="{$key}" {if !empty($info.SuspReason) && $info.SuspReason == $key}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Nr. cerere suspendare CIC'}:</b></td>
                                <td>
                                    <input type="text" name="CICSuspensionDemandNo" value="{$info.CICSuspensionDemandNo|default:''}" size="20" maxlength="255"/>
                                    <br/>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Data estimata a revenirii'}:</b></td>
                                <td>
                                    <input type="text" name="EstimateReturnDate" class="formstyle"
                                           value="{if !empty($info.EstimateReturnDate) && $info.EstimateReturnDate != '0000-00-00'}{$info.EstimateReturnDate|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" readonly>
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6">
                                        var cal6 = new CalendarPopup();
                                        cal6.isShowNavigationDropdowns = true;
                                        cal6.setYearSelectStartOffset(10);
                                        //writeSource("js6");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6.select(document.pers.EstimateReturnDate,'anchor6','dd.MM.yyyy'); return false;" NAME="anchor6" ID="anchor6"><img
                                                src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                            onClick="document.pers.EstimateReturnDate.value = ''; return false;">{translate label='anuleaza'}</A>
                                </td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Data revenirii'}:</b></td>
                                <td>
                                    <input type="text" name="ReturnDate" class="formstyle"
                                           value="{if !empty($info.ReturnDate) && $info.ReturnDate != '0000-00-00'}{$info.ReturnDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                           readonly>
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_2">
                                        var cal6_2 = new CalendarPopup();
                                        cal6_2.isShowNavigationDropdowns = true;
                                        cal6_2.setYearSelectStartOffset(10);
                                        //writeSource("js6_2");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_2.select(document.pers.ReturnDate,'anchor6_2','dd.MM.yyyy'); return false;" NAME="anchor6_2" ID="anchor6_2"><img
                                                src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                            onClick="document.pers.ReturnDate.value = ''; return false;">{translate label='anuleaza'}</A>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Comentarii:</b></td>
                                <td><textarea name="SuspendNotes" cols="40" rows="4" wrap="soft">{$info.SuspendNotes|default:''}</textarea></td>
                            </tr>
                        </table>
                    </div>
                    {if $info.ContractType == 3}
                        <script language="javascript">
                            document.getElementById('div_Suspendat').style.display = '';
                        </script>
                    {/if}
                </fieldset>
                <br>

            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;  border-bottom:none;">
                <br/>
                <fieldset>
                    <legend>{translate label='Acte aditionale/administrative'}</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td>{translate label='Numar act'}</td>
                            <td>{translate label='Data incheiere act<br/>aditional/administrativ'}</td>
                            <td style="width:120px;">{translate label='Data de la care<br/>produce efecte'}</td>
                            <td>{translate label=' '}Observatii</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$actead key=key item=item}
                            <tr>
                                <td><input type="text" id="ActNo_{$key}" value="{$item.ActNo}" size="10" maxlength="16"></td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                        var cal1_{$key} = new CalendarPopup();
                                        cal1_{$key}.isShowNavigationDropdowns = true;
                                        cal1_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js1_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('StartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                       NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StopDate_{$key}" value="{if $item.StopDate!='0000-00-00'}{$item.StopDate|date_format:"%d.%m.%Y"}{/if}" class="formstyle"
                                           value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                        var cal2_{$key} = new CalendarPopup();
                                        cal2_{$key}.isShowNavigationDropdowns = true;
                                        cal2_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js2_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('StopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                       NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td rowspan="2">
                                    <input type="hidden" id="Notes_{$key}" value="{$item.Notes}"/>
                                    <span id="Notes_{$key}_display">{$item.Notes}</span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td rowspan="2">{if $info.rw == 1}
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('ActNo_{$key}').value && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action=edit&ActID={$key}&ActNo=' + escape(document.getElementById('ActNo_{$key}').value) + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); else alert('{translate label='Completati Numar act, Data inceput, Data sfarsit!'}'); return false;"
                                                                title="{translate label='Modifica act aditional'}"><b>Mod</b></a></div>{/if}</td>
                                <td rowspan="2">{if $info.rw == 1}
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action=del&ActID={$key}'; return false;"
                                                                title="{translate label='Sterge act aditional'}"><b>Del</b></a></div>{/if}</td>
                            </tr>
                            <tr>
                                <td colspan="3">{if (!empty($item.FileLink))}<a href="{$item.FileLink}">{$item.FileName}</a>{/if}</td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td><input type="text" id="ActNo_0" size="10" maxlength="16"></td>
                            <td nowrap="nowrap">
                                <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap="nowrap">
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
                            <td>
                                <input type="hidden" id="Notes_0" value=""/>
                                <span id="Notes_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap">{if $info.rw == 1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('ActNo_0').value && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action=new&ActNo=' + escape(document.getElementById('ActNo_0').value) + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Completati Numar act, Data inceput, Data sfarsit!'}'); return false;"
                                                            title="{translate label='Adauga act aditional'}"><b>Add</b></a></div>{/if}</td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Sanctiuni'}</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td>{translate label='Numar'}</td>
                            <td style="width:120px;">{translate label='Data Inceput'}</td>
                            <td style="width:120px;">{translate label='Data Final'}</td>
                            <td>{translate label='Radiat'}</td>
                            <td>{translate label=' '}Observatii</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$warnings key=key item=item}
                            <tr>
                                <td><input type="text" id="WarNo_{$key}" value="{$item.WarNo}" size="10" maxlength="16"></td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate3_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_{$key}">
                                        var cal3_{$key} = new CalendarPopup();
                                        cal3_{$key}.isShowNavigationDropdowns = true;
                                        cal3_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js3_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_{$key}.select(document.getElementById('StartDate3_{$key}'),'anchor3_{$key}','dd.MM.yyyy'); return false;"
                                       NAME="anchor3_{$key}" ID="anchor3_{$key}"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="EndDate4_{$key}" value="{$item.EndDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_{$key}">
                                        var cal4_{$key} = new CalendarPopup();
                                        cal4_{$key}.isShowNavigationDropdowns = true;
                                        cal4_{$key}.setYearSelectStartOffset(10);
                                        //writeSource("js4_{$key}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_{$key}.select(document.getElementById('EndDate4_{$key}'),'anchor4_{$key}','dd.MM.yyyy'); return false;"
                                       NAME="anchor4_{$key}" ID="anchor4_{$key}"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td><input type="checkbox" id="Radiat_{$key}" {if $item.Radiat > 0}checked{/if} value="yes" /></td>
                                <td>
                                    <input type="hidden" id="NotesAV_{$key}" value="{$item.Notes}"/>
                                    <span id="NotesAV_{$key}_display">{$item.Notes}</span>
                                    [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('NotesAV_{$key}'); return false;">{translate label='Editare'}</a>]
                                </td>
                                <td>{if $info.rw == 1}
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('WarNo_{$key}').value && document.getElementById('StartDate3_{$key}').value && checkDate(document.getElementById('StartDate3_{$key}').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action_contract_warning=edit&WarID={$key}&WarNo=' + escape(document.getElementById('WarNo_{$key}').value) + '&StartDate=' + document.getElementById('StartDate3_{$key}').value + '&EndDate=' + document.getElementById('EndDate4_{$key}').value + '&Radiat=' + document.getElementById('Radiat_{$key}').checked + '&Notes=' + escape(document.getElementById('NotesAV_{$key}').value); else alert('{translate label='Completati Numar, Data!'}'); return false;"
                                                                title="{translate label='Modifica avertisment'}"><b>Mod</b></a></div>{/if}</td>
                                <td>{if $info.rw == 1}
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action_contract_warning=del&WarID={$key}'; return false;"
                                                                title="{translate label='Sterge avertisment'}"><b>Del</b></a></div>{/if}</td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td><input type="text" id="WarNo_0" size="10" maxlength="16"></td>
                            <td nowrap="nowrap">
                                <input type="text" id="StartDate3_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3_0">
                                    var cal3_0 = new CalendarPopup();
                                    cal3_0.isShowNavigationDropdowns = true;
                                    cal3_0.setYearSelectStartOffset(10);
                                    //writeSource("js3_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3_0.select(document.getElementById('StartDate3_0'),'anchor3_0','dd.MM.yyyy'); return false;" NAME="anchor3_0"
                                   ID="anchor3_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap="nowrap">
                                <input type="text" id="EndDate4_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4_0">
                                    var cal4_0 = new CalendarPopup();
                                    cal4_0.isShowNavigationDropdowns = true;
                                    cal4_0.setYearSelectStartOffset(10);
                                    //writeSource("js4_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4_0.select(document.getElementById('EndDate4_0'),'anchor4_0','dd.MM.yyyy'); return false;" NAME="anchor4_0"
                                   ID="anchor4_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td><input type="checkbox" id="Radiat_0" value="yes" /></td>
                            <td>
                                <input type="hidden" id="NotesAV_0" value=""/>
                                <span id="NotesAV_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('NotesAV_0'); return false;">{translate label='Editare'}</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap">{if $info.rw == 1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('WarNo_0').value && document.getElementById('StartDate3_0').value && checkDate(document.getElementById('StartDate3_0').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action_contract_warning=new&WarNo=' + escape(document.getElementById('WarNo_0').value) + '&StartDate=' + document.getElementById('StartDate3_0').value + '&EndDate=' + document.getElementById('EndDate4_0').value + '&Radiat=' + document.getElementById('Radiat_0').checked + '&Notes=' + escape(document.getElementById('NotesAV_0').value); else alert('{translate label='Completati Numar, Data!'}'); return false;"
                                                            title="{translate label='Adauga avertisment'}"><b>Add</b></a></div>{/if}</td>
                        </tr>
                    </table>
                </fieldset>
                <!--<fieldset>
                    <legend>{translate label='Date financiare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='IBAN'}:</b></td>
                            <td><input type="text" name="BankAccount" value="{$info.BankAccount|default:''}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Banca'}:</b></td>
                            <td><input type="text" name="BankName" value="{$info.BankName|default:''}" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Sucursala'}:</b></td>
                            <td><input type="text" name="BankLocation" value="{$info.BankLocation|default:''}" size="30" maxlength="128"></td>
                        </tr>
                    </table>
                </fieldset>
                <br/>
                <fieldset>
                    <legend>{translate label='Asigurare sanatate'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Casa asigurare sanatate'}:</b></td>
                            <td>
                                <select name="HealthCompanyID">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$health_companies item=item key=key}
                                        <option value="{$key}" {if $info.HealthCompanyID== $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>-->
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td colspan="2">
                            <b>{translate label='Observatii'}:</b><br>
                            <textarea name="Notes" cols="60" rows="6" wrap="soft">{$info.Notes|default:''}</textarea>
                        </td>
                    </tr>
                </table>
                <div style="text-align:center;">
                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    <input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=persons'" class="formstyle">
                </div>
            </td>
        </tr>
        {if !empty($contracts)}
            <tr>
                <td colspan="2">
                    <fieldset>
                        <legend>{translate label='Istoric contracte'}</legend>
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_contract_history').style.display; if (status == 'none') Effect.SlideDown('div_contract_history'); else Effect.SlideUp('div_contract_history'); return false;"><b>{translate label='Listare istoric contracte'}</b></a>
                        </p>
                        <div id="div_contract_history" style="display: none;">
                            <table cellspacing="0" cellpadding="4" width="100%">
                                <tr>
                                    <td><b>{translate label='Data angajarii'}</b></td>
                                    <td><b>{translate label='Data plecarii'}</b></td>
                                    <td><b>{translate label='Motivul plecarii'}</b></td>
                                    <td><b>{translate label='Tip contract'}</b></td>
                                    <td><b>{translate label='Data revenirii'}</b></td>
                                    <td><b>{translate label='Data contract'}</b></td>
                                    <td><b>{translate label='Data expirarii'}</b></td>
                                    <td><b>{translate label='Numar contract'}</b></td>
                                    <td><b>{translate label='Tip angajat'}</b></td>
                                    <td><b>{translate label='Program de lucru'}</b></td>
                                    <td><b>{translate label='Data modificare'}</b></td>
                                    <td><b>{translate label='User'}</b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                {foreach from=$contracts item=contract}
                                    <tr>
                                        <td style="border-bottom: 1px solid #cccccc;">{$contract.StartDate|date_format:'%d.%m.%Y'}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if $contract.ContractType == 3}{if !empty($contract.SuspendDate) && $contract.SuspendDate != '0000-00-00'}{$contract.SuspendDate|date_format:'%d.%m.%Y'}{else}-{/if}{else}{if !empty($contract.StopDate) && $contract.StopDate != '0000-00-00'}{$contract.StopDate|date_format:'%d.%m.%Y'}{else}-{/if}{/if}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if $contract.ContractType == 3}Suspendat{else}{$leavereason[$contract.LeaveReason]|default:'-'}{/if}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">
                                            {$contract_type[$contract.ContractType]|default:'-'}
                                            {if $contract.ContractType == 3}
                                                <br>
                                                Data suspendarii: {if !empty($contract.SuspendDate) && $contract.SuspendDate != '0000-00-00'}{$contract.SuspendDate|date_format:'%d.%m.%Y'}{else}-{/if}
                                                <br>
                                                Data estimata a revenirii: {if !empty($contract.EstimateReturnDate) && $contract.EstimateReturnDate != '0000-00-00'}{$contract.EstimateReturnDate|date_format:'%d.%m.%Y'}{else}-{/if}
                                            {/if}
                                        </td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if !empty($contract.ReturnDate) && $contract.ReturnDate != '0000-00-00'}{$contract.ReturnDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if !empty($contract.ContractDate) && $contract.ContractDate != '0000-00-00'}{$contract.ContractDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if !empty($contract.ContractExpDate) && $contract.ContractExpDate != '0000-00-00'}{$contract.ContractExpDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{$contract.ContractNo|default:'-'}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{$status[$contract.Status]|default:'-'}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{$contract.WorkNorm|default:'-'}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{$contract.CreateDate|date_format:'%d.%m.%Y %H:%M'}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{$contract.UserName}</td>
                                        <td style="border-bottom: 1px solid #cccccc;">{if $smarty.session.USER_ID==1}
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=contract&PersonID={$smarty.get.PersonID}&action_contract_history=del&ContractID={$contract.ContractID}'; return false;"
                                                                        title="{translate label='Sterge intrare istoric contracte'}"><b>Del</b></a></div>{/if}</td>
                                    </tr>
                                {/foreach}
                            </table>
                        </div>
                    </fieldset>
                </td>
            </tr>
        {/if}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
    <script type="text/javascript">
        function validateForm(f) {
            if (!checkDate(f.StartDate.value, 'Data angajarii')) {
                return false;
            }
            if (!is_empty(f.ContractDate.value) && !checkDate(f.ContractDate.value, 'Data contract')) {
                return false;
            }
            if (!is_empty(f.ContractExpDate.value) && !checkDate(f.ContractExpDate.value, 'Data expirare contract')) {
                return false;
            }
            return true;
        }

        function changeContractType(index) {
            switch (index) {
                case '1':
                    document.getElementById('div_ContractExpDate').style.display = '';
                    document.getElementById('div_Suspendat').style.display = 'none';
                    break;
                case '2':
                    document.getElementById('div_ContractExpDate').style.display = 'none';
                    document.getElementById('div_Suspendat').style.display = 'none';
                    break;
                case '3':
                    document.getElementById('div_Suspendat').style.display = '';
                    break;
                default:
                    break;
            }
        }

        function getNotes(id) {
            document.getElementById('layer_co_notes').value = document.getElementById(id).value;
            document.getElementById('layer_co_notes_dest').value = id;
            document.getElementById('layer_co').style.display = 'block';
            document.getElementById('layer_co_x').style.display = 'block';
        }

        function setNotes() {
            var id = document.getElementById('layer_co_notes_dest').value;
            document.getElementById(id).value = document.getElementById('layer_co_notes').value;
            // document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
            document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value;
            document.getElementById('layer_co').style.display = 'none';
            document.getElementById('layer_co_x').style.display = 'none';
        }
    </script>
{/literal}