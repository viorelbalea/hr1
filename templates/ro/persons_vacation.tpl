{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu">
    		<span class="TitleBox">
    		{foreach from=$vacations key=key item=item name=iter}
                {if $smarty.foreach.iter.first}
                    {$vacations.$key.FullName}
                    {assign var="comment" value=$vacations.$key.VacationComment}
                    {assign var="rw" value=$vacations.$key.rw}
                {/if}
            {/foreach}
    		</span>
        </td>
    </tr>
    {if !empty($smarty.post) && $err->getErrors() == ""}
    <tr height="30">
        <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
    </tr>
    {else}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding: 0 10px 10px 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Concediu de odihna CO'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td align="center">{translate label='Anul'}</td>
                            <td align="center">{translate label='Zile CO cuvenite'}</td>
                            <td align="center">{translate label='Zile CO ramase'}</td>
                            <td align="center">{translate label='Efectuat'}</td>
{*                            <td align="center">{translate label='Invoire'}</td>*}
                            <td align="center">{translate label='Zile pierdute'}</td>
                            <td align="center">{translate label='Ramas'}</td>
                            <td align="center">{translate label='Recalculare'}</td>
                            <td align="center">{translate label='Inchide'}</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        {foreach from=$vacations item=item}
                            {if $item.Year > ''}
                                <tr>
                                    <td align="center">{$item.Year}</td>
                                    <td align="center"><input type="text" id="TotalCO_{$item.VacationID}" size="2" maxlength="2" value="{$item.TotalCO}"></td>
                                    <td align="center"><input type="text" id="TotalCORef_{$item.VacationID}" size="2" maxlength="2" value="{$item.TotalCORef}"></td>
                                    <td align="center">{$item.EffCO|default:0}</td>
{*                                    <td align="center"><input type="text" id="Invoire_{$item.VacationID}" size="2" maxlength="2" value="{$item.Invoire}"></td>*}
                                    <td align="center">{$item.LostCO|default:0}</td>
                                    <td align="center">{math equation="x-y-z-t" x=$item.TotalCO y=$item.EffCO|default:0 z=$item.Invoire|default:0 t=$item.LostCO|default:0}</td>
                                    <td align="center"><input type="checkbox" id="VacRecalc_{$item.VacationID}" value="1" {if $item.VacRecalc==1}checked{/if}></td>
                                    <td align="center"><input type="checkbox" id="Closed_{$item.VacationID}" value="1" {if $item.Closed==1}checked{/if}></td>
                                    <td align="center">{if $rw==1 && $item.rw==1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!isNaN(document.getElementById('TotalCO_{$item.VacationID}').value) && document.getElementById('TotalCORef_{$item.VacationID}').value >= 0) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit&VacationID={$item.VacationID}&TotalCO=' + document.getElementById('TotalCO_{$item.VacationID}').value + '&TotalCORef=' + document.getElementById('TotalCORef_{$item.VacationID}').value + '&VacRecalc=' + (document.getElementById('VacRecalc_{$item.VacationID}').checked == true ? 1 : 0) + '&Closed=' + (document.getElementById('Closed_{$item.VacationID}').checked == true ? 1 : 0); else alert('{translate label='Nu ati specificat zilele totale de concediu'}!'); return false;"
                                                                    title="{translate label='Modifica CO'}"><b>Mod</b></a></div>{/if}</td>
                                    <td align="center">{if $rw==1 && $item.rw==1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del&VacationID={$item.VacationID}'; return false;"
                                                                    title="{translate label='Sterge CO'}"><b>Del</b></a></div>{/if}</td>
                                </tr>
                            {/if}
                        {/foreach}
                        <tr>
                            <td align="center"><select id="Year_0">{foreach from=$years item=year}{if !isset($vacations.$year)}
                                        <option value="{$year}">{$year}</option>{/if}{/foreach}</select></td>
                            <td align="center"><input type="text" id="TotalCO_0" size="2" maxlength="2"></td>
                            <td align="center"><input type="text" id="TotalCORef_0" size="2" maxlength="2"></td>
                            <td>&nbsp;</td>
{*                            <td align="center"><input type="text" id="Invoire_0" size="2" maxlength="2"></td>*}
                            <td align="center">{if $rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('TotalCO_0').value >= 0 && document.getElementById('TotalCORef_0').value >= 0) window.location.href = '{$smarty.server.REQUEST_URI}&action=new&Year=' + document.getElementById('Year_0').value + '&TotalCO=' + document.getElementById('TotalCO_0').value + '&TotalCORef=' + document.getElementById('TotalCORef_0').value; else alert('{translate label='Nu ati specificat zilele totale de concediu'}!'); return false;"
                                                            title="{translate label='Adauga CO'}"><b>Add</b></a></div>{/if}</td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding: 0 10px 10px 0;" width="50%">
                <form action="{$smarty.server.REQUEST_URI}" method="post">
                    {assign var="history" value="0"}
                    {foreach from=$vacations item=item}
                        {if !empty($item.History)}
                            {assign var="history" value="1"}
                        {/if}
                    {/foreach}
                    <br>
                    {translate label='Comentarii'}
                    <br>
                    <textarea name="VacationComment" rows="6" cols="70" wrap="soft" style="width: 100%">{$comment}</textarea>
                    {if $rw==1}<p style="text-align: right;"><input type="submit" value="{translate label='Salveaza comentarii'}"></p>{/if}
                </form>
            </td>
        </tr>
    </table>

    <div id="layer_co" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Descriere'}</h3>
        <div class="observatiiTextbox">
            <textarea id="layer_co_notes"></textarea>
            <input type="hidden" id="layer_co_notes_dest" value=""/>

        </div>

        <div class="saveObservatii">
            <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">
            <input type="button" value="{translate label='Anuleaza'}"
                   onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
        </div>
    </div>
<!---->
    <div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
    </div>


    <div id="layer_doc" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Documente'}</h3>
        <div id="layer_doc_content" class="layerContent"></div>
    </div>
    <div id="layer_doc_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_doc').style.display = 'none'; document.getElementById('layer_doc_x').style.display = 'none';">x
    </div>


    <div id="layer_reason" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Motiv aprobare/respingere'}</h3>
        <div class="observatiiTextbox">
            <textarea id="layer_reason_notes"></textarea>
            <input type="hidden" id="layer_reason_notes_dest" value="">
        </div>
        <div class="saveObservatii">
            <input type="button" value="{translate label='Salveaza'}" onclick="setReason();">
            <input type="button" value="{translate label='Anuleaza'}"
                   onclick="document.getElementById('layer_reason').style.display = 'none'; document.getElementById('layer_reason_x').style.display = 'none';">

        </div>
    </div>
    <div id="layer_reason_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_reason').style.display = 'none'; document.getElementById('layer_reason_x').style.display = 'none';">x
    </div>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 0 10px 10px 10px;">

            <br>
            <!-- BEGIN CO -->
            <fieldset>
                <legend>{translate label='Concediu odihna (CO)'}</legend>
                {if !empty($vacations_details.CO)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CO key=Year2 item=item2}$('co_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('co_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CO key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_co" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_co">
                                var cal1_co = new CalendarPopup();
                                cal1_co.isShowNavigationDropdowns = true;
                                cal1_co.setYearSelectStartOffset(10);
                                //writeSource("js1_co");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_co.select(document.getElementById('StartDate_co'),'anchor1_co','dd.MM.yyyy'); return false;" NAME="anchor1_co"
                               ID="anchor1_co"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_co" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_co">
                                var cal2_co = new CalendarPopup();
                                cal2_co.isShowNavigationDropdowns = true;
                                cal2_co.setYearSelectStartOffset(10);
                                //writeSource("js2_co");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_co.select(document.getElementById('StopDate_co'),'anchor2_co','dd.MM.yyyy'); return false;" NAME="anchor2_co" ID="anchor2_co"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_co">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_co"><span id="Notes_co_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_co'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                                <div id="button_add"><a href="#"
                                                        onclick="{foreach from=$vacations key=key item=item}if (('{$key}' == document.getElementById('StartDate_co').value.substring(6) || '{$key}' == document.getElementById('StopDate_co').value.substring(6)) && {$item.Closed} == 1) {literal}{{/literal}alert('{translate label='Nu puteti adauga concediu de odihna pentru anul %s' values=$key}!'); return false;{literal}}{/literal}{/foreach}if (document.getElementById('StartDate_co').value && checkDate(document.getElementById('StartDate_co').value, 'Data inceput') && document.getElementById('StopDate_co').value && checkDate(document.getElementById('StopDate_co').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CO&StartDate=' + document.getElementById('StartDate_co').value + '&StopDate=' + document.getElementById('StopDate_co').value + '&Replacer=' + document.getElementById('Replacer_co').value + '&Notes=' + escape(document.getElementById('Notes_co').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediul de odihna'}!'); return false;"
                                                        title="{translate label='Adauga concediu odihna'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CO key=Year item=detail}
                    <div id="co_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CO.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>

                                    <td>


                                        <input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}">
                                        <span id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span>
                                        [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_{$item.VacationID}'); return false;">
                                            {translate label='Editare'}
                                        </a>]
                                    </td>

                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('StopDate_{$item.VacationID}').value && checkDate(document.getElementById('StopDate_{$item.VacationID}').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&Type=CO&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile despre concediul de odihna'}!'); return false;"
                                                                        title="{translate label='Modifica concediu odihna'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                        title="{translate label='Sterge concediu odihna'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu odihna'}"><b>Reject</b></a></div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu odihna'}"><b>Aproba</b></a></div>{else}&nbsp;{/if}
                                            </td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CO -->

            <br>
            <!-- BEGIN INV -->
            <fieldset>
                <legend>{translate label='Invoiri (INV)'}</legend>
                {if !empty($vacations_details.INV)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.INV key=Year2 item=item2}$('inv_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('inv_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.INV key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data'}</td>
                        <td>{translate label='Ora inceput'}</td>
                        <td>{translate label='Ora sfarsit'}</td>
                        <td width="40">{translate label='Nr ore'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_inv" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_inv">
                                var cal1_inv = new CalendarPopup();
                                cal1_inv.isShowNavigationDropdowns = true;
                                cal1_inv.setYearSelectStartOffset(10);
                                //writeSource("js1_inv");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_inv.select(document.getElementById('StartDate_inv'),'anchor1_inv','dd.MM.yyyy'); return false;" NAME="anchor1_inv"
                               ID="anchor1_inv"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StartHour_inv" class="formstyle" value="00:00" size="5" max="5"/>
                        </td>
                        <td>
                            <input type="text" id="StopHour_inv" class="formstyle" value="00:00" size="5" max="5"/>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_inv">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_inv"><span id="Notes_inv_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_inv'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                                <div id="button_add"><a href="#"
                                                        onclick="{foreach from=$vacations key=key item=item}if (('{$key}' == document.getElementById('StartDate_inv').value.substring(6)) && {$item.Closed} == 1) {literal}{{/literal}alert('{translate label='Nu puteti adauga invoiri pentru anul %s' values=$key}!'); return false;{literal}}{/literal}{/foreach}if (document.getElementById('StartDate_inv').value && checkDate(document.getElementById('StartDate_inv').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=INV&StartDate=' + document.getElementById('StartDate_inv').value + '&StartHour=' + document.getElementById('StartHour_inv').value + '&StopHour=' + document.getElementById('StopHour_inv').value + '&Replacer=' + document.getElementById('Replacer_inv').value + '&Notes=' + escape(document.getElementById('Notes_co').value); else alert('{translate label='Nu ati specificat toate informatiile despre invoire'}!'); return false;"
                                                        title="{translate label='Adauga invoire'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.INV key=Year item=detail}
                    <div id="inv_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.INV.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StartHour_{$item.VacationID}" class="formstyle" value="{$item.StartHour}" size="5" maxlength="5"/>
                                    </td>
                                    <td>
                                        <input type="text" id="StopHour_{$item.VacationID}" class="formstyle" value="{$item.StopHour}" size="5" maxlength="5"/>
                                    </td>
                                    <td align="center" width="40">{$item.HoursNo}</td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data')) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&Type=INV&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StartHour=' + document.getElementById('StartHour_{$item.VacationID}').value + '&StopHour=' + document.getElementById('StopHour_{$item.VacationID}').value + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile despre invoire'}!'); return false;"
                                                                        title="{translate label='Modifica invoire'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                        title="{translate label='Sterge invoire'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge invoire'}"><b>Reject</b></a></div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba invoire'}"><b>Aproba</b></a></div>{else}&nbsp;{/if}</td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END INV -->

            <br>
            <!-- BEGIN CFS -->
            <fieldset>
                <legend>{translate label='Concediu fara salariu (CFS)'}</legend>
                {if !empty($vacations_details.CFS)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CFS key=Year2 item=item2}$('cfs_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('cfs_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CFS key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cfs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cfs">
                                var cal1_cfs = new CalendarPopup();
                                cal1_cfs.isShowNavigationDropdowns = true;
                                cal1_cfs.setYearSelectStartOffset(10);
                                //writeSource("js1_cfs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cfs.select(document.getElementById('StartDate_cfs'),'anchor1_cfs','dd.MM.yyyy'); return false;" NAME="anchor1_cfs"
                               ID="anchor1_cfs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cfs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cfs">
                                var cal2_cfs = new CalendarPopup();
                                cal2_cfs.isShowNavigationDropdowns = true;
                                cal2_cfs.setYearSelectStartOffset(10);
                                //writeSource("js2_cfs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cfs.select(document.getElementById('StopDate_cfs'),'anchor2_cfs','dd.MM.yyyy'); return false;" NAME="anchor2_cfs"
                               ID="anchor2_cfs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_cfs">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cfs"><span id="Notes_cfs_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_cfs'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cfs').value && checkDate(document.getElementById('StartDate_cfs').value, 'Data inceput') && document.getElementById('StopDate_cfs').value && checkDate(document.getElementById('StopDate_cfs').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CFS&StartDate=' + document.getElementById('StartDate_cfs').value + '&StopDate=' + document.getElementById('StopDate_cfs').value + '&Replacer=' + document.getElementById('Replacer_cfs').value + '&Notes=' + escape(document.getElementById('Notes_cfs').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediul fara salariu'}!'); return false;"
                                                    title="{translate label='Adauga concediu fara salariu'}"><b>Add</b></a>{/if}</div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CFS key=Year item=detail}
                    <div id="cfs_{$Year}"> {*  style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CFS.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('StopDate_{$item.VacationID}').value && checkDate(document.getElementById('StopDate_{$item.VacationID}').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && $smarty.session.ROLEMNG==1}+'&reason='+escape(document.getElementById('reason').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile despre concediul fara salariu'}!'); return false;"
                                                                        title="{translate label='Modifica concediu fara salariu'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'; return false;"
                                                                        title="{translate label='Sterge concediu fara salariu'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu fara salariu'}"><b>Reject</b></a></div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu fara salariu'}"><b>Aproba</b></a></div>{else}&nbsp;{/if}
                                            </td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CFS -->

            <br>
            <!-- BEGIN CE -->
            <fieldset>
                <legend>{translate label='Concediu pentru evenimente familiale (CE)'}</legend>
                {if !empty($vacations_details.CE)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CE key=Year2 item=item2}$('ce_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('ce_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CE key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Cauza'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_ce" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_ce">
                                var cal1_ce = new CalendarPopup();
                                cal1_ce.isShowNavigationDropdowns = true;
                                cal1_ce.setYearSelectStartOffset(10);
                                //writeSource("js1_ce");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_ce.select(document.getElementById('StartDate_ce'),'anchor1_ce','dd.MM.yyyy'); return false;" NAME="anchor1_ce"
                               ID="anchor1_ce"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_ce" class="formstyle" value="" size="10" maxlength="10" readonly>
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_ce">
                                var cal2_ce = new CalendarPopup();
                                cal2_ce.isShowNavigationDropdowns = true;
                                cal2_ce.setYearSelectStartOffset(10);
                                //writeSource("js2_ce");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_ce.select(document.getElementById('StopDate_ce'),'anchor2_ce','dd.MM.yyyy'); return false;" NAME="anchor2_ce" ID="anchor2_ce"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Details_ce">
                                <option value="">{translate label='alege cauza'}</option>
                                {foreach from=$ce_type key=key item=item}
                                    <option value="{$key}">{translate label=$key} - {$item} zile</option>
                                {/foreach}
                            </select>
                        </td>
                        <td>
                            <select id="Replacer_ce">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_ce"><span id="Notes_ce_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_ce'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_ce').value && checkDate(document.getElementById('StartDate_ce').value, 'Data inceput') && document.getElementById('Details_ce').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CE&StartDate=' + document.getElementById('StartDate_ce').value + '&StopDate=' + document.getElementById('StopDate_ce').value + '&Details=' + escape(document.getElementById('Details_ce').value) + '&Replacer=' + document.getElementById('Replacer_ce').value + '&Notes=' + escape(document.getElementById('Notes_ce').value); else alert('{translate label='Nu ati specificat toate informatiile (Data inceput si Cauza) despre concediul pentru evenimente familiale'}!'); return false;"
                                                    title="{translate label='Adauga concediu pentru evenimente familiale'}"><b>Add</b></a>{/if}</div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CE key=Year item=detail}
                    <div id="ce_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CE.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td>
                                        <select id="Details_{$item.VacationID}">
                                            {foreach from=$ce_type key=key2 item=item2}
                                                <option value="{$key2}" {if $key2 == $item.Details}selected{/if}>{$key2} - {$item2} zile</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('Details_{$item.VacationID}').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&Details=' + escape(document.getElementById('Details_{$item.VacationID}').value) + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && $smarty.session.ROLEMNG==1}+'&reason='+escape(document.getElementById('reason').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile (Data inceput si Cauza) despre concediul pentru evenimente familiale'}!'); return false;"
                                                                        title="{translate label='Modifica concediu pentru evenimente familiale'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'; return false;"
                                                                        title="{translate label='Sterge concediu pentru evenimente familiale'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu pentru evenimente familiale'}"><b>Reject</b></a>
                                                    </div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu pentru evenimente familiale'}"><b>Aproba</b></a>
                                                    </div>{else}&nbsp;{/if}</td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CE -->

            <br>
            <!-- BEGIN CIC -->
            <fieldset>
                <legend>{translate label='Concediu de ingrijire copil (CIC)'}</legend>
                {if !empty($vacations_details.CIC)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CIC key=Year2 item=item2}$('cic_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('cic_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CIC key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cic" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cic">
                                var cal1_cic = new CalendarPopup();
                                cal1_cic.isShowNavigationDropdowns = true;
                                cal1_cic.setYearSelectStartOffset(10);
                                //writeSource("js1_cic");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cic.select(document.getElementById('StartDate_cic'),'anchor1_cic','dd.MM.yyyy'); return false;" NAME="anchor1_cic"
                               ID="anchor1_cic"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cic" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cic">
                                var cal2_cic = new CalendarPopup();
                                cal2_cic.isShowNavigationDropdowns = true;
                                cal2_cic.setYearSelectStartOffset(10);
                                //writeSource("js2_cic");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cic.select(document.getElementById('StopDate_cic'),'anchor2_cic','dd.MM.yyyy'); return false;" NAME="anchor2_cic"
                               ID="anchor2_cic"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_cic">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cic"><span id="Notes_cic_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_cic'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cic').value && checkDate(document.getElementById('StartDate_cic').value, 'Data inceput') && document.getElementById('StopDate_cic').value && checkDate(document.getElementById('StopDate_cic').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CIC&StartDate=' + document.getElementById('StartDate_cic').value + '&StopDate=' + document.getElementById('StopDate_cic').value + '&Replacer=' + document.getElementById('Replacer_cic').value + '&Notes=' + escape(document.getElementById('Notes_cic').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediul de ingrijire copil'}!'); return false;"
                                                    title="{translate label='Adauga concediu de ingrijire copil'}"><b>Add</b></a>{/if}</div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CIC key=Year item=detail}
                    <div id="cic_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CIC.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('StopDate_{$item.VacationID}').value && checkDate(document.getElementById('StopDate_{$item.VacationID}').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && $smarty.session.ROLEMNG==1}+'&reason='+escape(document.getElementById('reason').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile despre concediul de ingrijire copil'}!'); return false;"
                                                                        title="{translate label='Modifica concediu de ingrijire copil'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'; return false;"
                                                                        title="{translate label='Sterge concediu de ingrijire copil'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu de ingrijire copil'}"><b>Reject</b></a>
                                                    </div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu de ingrijire copil'}"><b>Aproba</b></a>
                                                    </div>{else}&nbsp;{/if}</td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CIC -->

            <br>
            <!-- BEGIN CS -->
            <fieldset>
                <legend>{translate label='Concediu special (CS)'}</legend>
                {if !empty($vacations_details.CS)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CS key=Year2 item=item2}$('cs_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('cs_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CS key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Tip concediu'}</td>
                        <td>{translate label='Inlocuitor'}</td>
                        <td>{translate label='Comentarii'}</td>
                        <td>{translate label='Documente'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cs">
                                var cal1_cs = new CalendarPopup();
                                cal1_cs.isShowNavigationDropdowns = true;
                                cal1_cs.setYearSelectStartOffset(10);
                                //writeSource("js1_cs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cs.select(document.getElementById('StartDate_cs'),'anchor1_cs','dd.MM.yyyy'); return false;" NAME="anchor1_cs"
                               ID="anchor1_cs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cs" class="formstyle" value="" size="10" maxlength="10" readonly>
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cs">
                                var cal2_cs = new CalendarPopup();
                                cal2_cs.isShowNavigationDropdowns = true;
                                cal2_cs.setYearSelectStartOffset(10);
                                //writeSource("js2_cs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cs.select(document.getElementById('StopDate_cs'),'anchor2_cs','dd.MM.yyyy'); return false;" NAME="anchor2_cs" ID="anchor2_cs"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Details_cs">
                                <option value="">alege tip</option>
                                {foreach from=$cs_type item=item}
                                    <option value="{$item}">{translate label=$item}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td>
                            <select id="Replacer_cs">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cs"><span id="Notes_cs_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_cs'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cs').value && checkDate(document.getElementById('StartDate_cs').value, 'Data inceput') && document.getElementById('Details_cs').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CS&StartDate=' + document.getElementById('StartDate_cs').value + '&StopDate=' + document.getElementById('StopDate_cs').value + '&Details=' + escape(document.getElementById('Details_cs').value) + '&Replacer=' + document.getElementById('Replacer_cs').value + '&Notes=' + escape(document.getElementById('Notes_cs').value); else alert('{translate label='Nu ati specificat toate informatiile (Data inceput si Tip concediu) despre concediul special'}!'); return false;"
                                                    title="{translate label='Adauga concediu special'}"><b>Add</b></a>{/if}</div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CS key=Year item=detail}
                    <div id="cs_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CS.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td>
                                        <select id="Details_{$item.VacationID}">
                                            {foreach from=$cs_type item=item2}
                                                <option value="{$item2}" {if $item2 == $item.Details}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('Details_{$item.VacationID}').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&Details=' + escape(document.getElementById('Details_{$item.VacationID}').value) + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && $smarty.session.ROLEMNG==1}+'&reason='+escape(document.getElementById('reason').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile (Data inceput si Tip concediu) despre concediul special'}!'); return false;"
                                                                        title="{translate label='Modifica concediu special'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'; return false;"
                                                                        title="{translate label='Sterge concediu special'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu special'}"><b>Reject</b></a></div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu special'}"><b>Aproba</b></a></div>{else}&nbsp;{/if}</td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CS -->

        </td>
    </tr>
    {/if}
    <tr>
        <td class="celulaMenuSTDR" colspan="2" style="padding: 0 10px 10px 10px;">
            <br>
            <!-- BEGIN CM -->
            <fieldset>
                <legend>{translate label='Concediu medical (CM)'}</legend>
                {if !empty($vacations_details.CM)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id=""> {* onchange="{foreach from=$vacations_details.CM key=Year2 item=item2}$('cm_{$Year2}').hide();{/foreach} if (this.value > '') Effect.SlideDown('cm_' + this.value);" *}
                                    <option value="">{translate label="alege anul"}</option>
                                    {foreach from=$vacations_details.CM key=Year item=item}
                                        <option value="{$Year}">{$Year}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                {/if}
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td>{translate label='Data inceput'}</td>
                        <td>{translate label='Data sfarsit'}</td>
                        <td width="40">{translate label='Nr zile'}</td>
                        <td>{translate label='Serie si numar certificat'}</td>
                        <td>{translate label='Cod Ind'}</td>
                        <td>{translate label='Tip Certif'}</td>
                        <td>{translate label='Cod Diagnostic'}</td>
                        <td>{translate label='Emitent'}</td>
                        <td colspan="5">{translate label='Inlocuitor'}</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cm" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cm">
                                var cal1_cm = new CalendarPopup();
                                cal1_cm.isShowNavigationDropdowns = true;
                                cal1_cm.setYearSelectStartOffset(10);
                                //writeSource("js1_cm");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cm.select(document.getElementById('StartDate_cm'),'anchor1_cm','dd.MM.yyyy'); return false;" NAME="anchor1_cm"
                               ID="anchor1_cm"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cm" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cm">
                                var cal2_cm = new CalendarPopup();
                                cal2_cm.isShowNavigationDropdowns = true;
                                cal2_cm.setYearSelectStartOffset(10);
                                //writeSource("js2_cm");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cm.select(document.getElementById('StopDate_cm'),'anchor2_cm','dd.MM.yyyy'); return false;" NAME="anchor2_cm" ID="anchor2_cm"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td><input type="text" id="SerieNum_cm" size="15" maxlength="16"></td>
                        <td><input type="text" id="CodInd_cm" size="10" maxlength="16"></td>
                        <td><input type="text" id="TipCertif_cm" size="10" maxlength="32"></td>
                        <td><input type="text" id="CodCertif_cm" size="10" maxlength="16"></td>
                        <td><input type="text" id="Emitent_cm" size="20" maxlength="128"></td>
                        <td colspan="5">
                            <select id="Replacer_cm">
                                <option value=""></option>
                                {foreach from=$employees key=k item=v}
                                    <option value="{$k}">{$v}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Observatii <br/><textarea id="Details_cm" rows="1" cols="97" wrap="soft"></textarea></td>
                        <td>Comentarii<br><input type="hidden" id="Notes_cm"><span id="Notes_cm_display"></span> [<a href="#"
                                                                                                                     onclick="getNotes('Notes_cm'); return false;">{translate label='Editare'}</a>]
                        </td>
                        <td>Documente<br>[<a href="#" onclick="getDocs(0); return false;">{translate label='Vizualizare'}</a>]</td>
                        <td>&nbsp;</td>
                        <td>{if $rw==1}
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('StartDate_cm').value && checkDate(document.getElementById('StartDate_cm').value, 'Data inceput') && document.getElementById('StopDate_cm').value && checkDate(document.getElementById('StopDate_cm').value, 'Data sfarsit') && document.getElementById('CodInd_cm').value && document.getElementById('TipCertif_cm').value && document.getElementById('CodCertif_cm').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=newv&Type=CM&StartDate=' + document.getElementById('StartDate_cm').value + '&StopDate=' + document.getElementById('StopDate_cm').value + '&CodInd=' + document.getElementById('CodInd_cm').value + '&TipCertif=' + document.getElementById('TipCertif_cm').value + '&CodCertif=' + document.getElementById('CodCertif_cm').value + '&Emitent=' + escape(document.getElementById('Emitent_cm').value) + '&Details=' + escape(document.getElementById('Details_cm').value) + '&Replacer=' + document.getElementById('Replacer_cm').value + '&Notes=' + escape(document.getElementById('Notes_cs').value); else alert('{translate label='Nu ati specificat toate informatiile despre concediul medical'}!'); return false;"
                                                        title="{translate label='Adauga concediu medical'}"><b>Add</b></a></div>{/if}</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$vacations_details.CM key=Year item=detail}
                    <div id="cm_{$Year}"> {* style="display:none;" *}
                        <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            {foreach from=$vacations_details.CM.$Year item=item}
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td>
                                        <input type="text" id="StartDate_{$item.VacationID}" class="formstyle" value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_{$item.VacationID}">
                                                var cal1_{$item.VacationID} = new CalendarPopup();
                                                cal1_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal1_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js1_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_{$item.VacationID}.select(document.getElementById('StartDate_{$item.VacationID}'),'anchor1_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_{$item.VacationID}" ID="anchor1_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_{$item.VacationID}" class="formstyle" value="{$item.StopDate|date_format:"%d.%m.%Y"}" size="10"
                                               maxlength="10">
                                        {if $vacations.$Year.Closed == 0}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_{$item.VacationID}">
                                                var cal2_{$item.VacationID} = new CalendarPopup();
                                                cal2_{$item.VacationID}.isShowNavigationDropdowns = true;
                                                cal2_{$item.VacationID}.setYearSelectStartOffset(10);
                                                //writeSource("js2_{$item.VacationID}");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_{$item.VacationID}.select(document.getElementById('StopDate_{$item.VacationID}'),'anchor2_{$item.VacationID}','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_{$item.VacationID}" ID="anchor2_{$item.VacationID}"><img src="./images/cal.png" border="0"></A>
                                        {/if}
                                    </td>
                                    <td align="center" width="40">{$item.DaysNo}</td>
                                    <td><input type="text" id="CodInd_{$item.VacationID}" size="10" maxlength="16" value="{$item.CodInd}"></td>
                                    <td><input type="text" id="TipCertif_{$item.VacationID}" size="10" maxlength="32" value="{$item.TipCertif}"></td>
                                    <td><input type="text" id="CodCertif_{$item.VacationID}" size="10" maxlength="16" value="{$item.CodCertif}"></td>
                                    <td><input type="text" id="Emitent_{$item.VacationID}" size="30" maxlength="128" value="{$item.Emitent}"></td>
                                    <td>
                                        <select id="Replacer_{$item.VacationID}">
                                            <option value=""></option>
                                            {foreach from=$employees key=k item=v}
                                                <option value="{$k}" {if $k==$item.Replacer}selected{/if}>{$v}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr{if $item.Aprove==0} bgcolor="#FFB2B2"{elseif $item.Aprove==-1} bgcolor="#cccccc"{/if}>
                                    <td colspan="6">Observatii <br/><textarea id="Details_{$item.VacationID}" rows="1" cols="97" wrap="soft">{$item.Details}</textarea></td>
                                    <td><input type="hidden" id="Notes_{$item.VacationID}" value="{$item.Notes}"><span
                                                id="Notes_{$item.VacationID}_display">{$item.Notes|truncate:5}</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_{$item.VacationID}'); return false;">{translate label='Editare'}</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs({$item.VacationID}); return false;">{translate label='Vizualizare'}</a>]</td>
                                    <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}<input type="hidden" id="Reason_{$item.VacationID}"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_{$item.VacationID}'); return false;">{translate label='Motiv'}</a>
                                            ]{else}&nbsp;{/if}</td>
                                    {if $vacations.$Year.Closed == 1}
                                        <td colspan="3">&nbsp;</td>
                                    {else}
                                        {if $rw==1 && $item.rw==1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_{$item.VacationID}').value && checkDate(document.getElementById('StartDate_{$item.VacationID}').value, 'Data inceput') && document.getElementById('StopDate_{$item.VacationID}').value && checkDate(document.getElementById('StopDate_{$item.VacationID}').value, 'Data sfarsit') && document.getElementById('CodInd_{$item.VacationID}').value && document.getElementById('TipCertif_{$item.VacationID}').value && document.getElementById('CodCertif_{$item.VacationID}').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=editv&VacationID={$item.VacationID}&Type=CM&StartDate=' + document.getElementById('StartDate_{$item.VacationID}').value + '&StopDate=' + document.getElementById('StopDate_{$item.VacationID}').value + '&CodInd=' + document.getElementById('CodInd_{$item.VacationID}').value + '&TipCertif=' + document.getElementById('TipCertif_{$item.VacationID}').value + '&CodCertif=' +  document.getElementById('CodCertif_{$item.VacationID}').value + '&Emitent=' + escape(document.getElementById('Emitent_{$item.VacationID}').value) + '&Details=' + escape(document.getElementById('Details_{$item.VacationID}').value) + '&Replacer=' + document.getElementById('Replacer_{$item.VacationID}').value + '&Notes=' + document.getElementById('Notes_{$item.VacationID}').value{if $item.Aprove==0 && $smarty.session.ROLEMNG==1}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; else alert('{translate label='Nu ati specificat toate informatiile despre concediul medical'}!'); return false;"
                                                                        title="{translate label='Modifica concediu medical'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delv&VacationID={$item.VacationID}'; return false;"
                                                                        title="{translate label='Sterge concediu medical'}"><b>Del</b></a></div>
                                            </td>
                                            <td>{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=rejectv&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}+'&reason='+escape(document.getElementById('Reason_{$item.VacationID}').value){/if}; return false;"
                                                                               title="{translate label='Respinge concediu medical'}"><b>Reject</b></a></div>{else}&nbsp;{/if}
                                                {if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&action=aprovev&VacationID={$item.VacationID}'{if $item.Aprove==0 && ($smarty.session.ROLEMNG==1 || $smarty.session.USER_ID==1)}{/if}; return false;"
                                                                               title="{translate label='Aproba concediu medical'}"><b>Aproba</b></a></div>{else}&nbsp;{/if}</td>
                                        {else}
                                            <td colspan="3">&nbsp;</td>
                                        {/if}
                                    {/if}
                                    <td>{if $item.Aprove==0}{translate label='neaprobat'}{elseif $item.Aprove==-1}{translate label='respins'}{else}&nbsp;{/if}</td>
                                </tr>
                                <tr>
                                    <td colspan="12"></td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                {/foreach}
            </fieldset>
            <!-- END CM -->
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='concedii'}</span></td>
    </tr>
</table>

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

        function getDocs(id) {
            showInfo('ajax.php?o=vacation_docs&id=' + id, 'layer_doc_content');
            document.getElementById('layer_doc').style.display = 'block';
            document.getElementById('layer_doc_x').style.display = 'block';
        }

        function getReason(id) {
            document.getElementById('layer_reason_notes').value = document.getElementById(id).value;
            document.getElementById('layer_reason_notes_dest').value = id;
            document.getElementById('layer_reason').style.display = 'block';
            document.getElementById('layer_reason_x').style.display = 'block';
        }

        function setReason() {
            var id = document.getElementById('layer_reason_notes_dest').value;
            document.getElementById(id).value = document.getElementById('layer_reason_notes').value;
            document.getElementById('layer_reason').style.display = 'none';
            document.getElementById('layer_reason_x').style.display = 'none';
        }
    </script>
{/literal}