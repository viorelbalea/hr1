{include file="contract_menu.tpl"}
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

<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);" name="contract">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.ContractID)}
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox">{include file="contract_submenu.tpl"}</span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.CompanyName}</td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare contract'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele contractului au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Informatii generale'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Nume contract'}:*</b></td>
                            <td><input type="text" name="ContractName" value="{$info.ContractName|default:''}" size="60" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip contract'}:*</b></td>
                            <td>
                                <select name="ContractTypeID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$contract_types key=key item=item}
                                        <option value="{$key}" {if $info.ContractTypeID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Compania self'}:*</b></td>
                            <td>
                                <select name="CompanyID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$self key=key item=item}
                                        <option value="{$key}" {if $info.CompanyID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                {translate label='cu rol de: '} <select name="CompanyRole">
                                    <option value="">{translate label='alege...'}</option>
                                    <option value="Beneficiar" {if $info.CompanyRole == 'Beneficiar'}selected{/if}>{translate label='Beneficiar'}</option>
                                    <option value="Furnizor" {if $info.CompanyRole == 'Furnizor'}selected{/if}>{translate label='Furnizor'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Partener'}:*</b></td>
                            <td>
                                <select name="PartnerID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$partners key=key item=item}
                                        <option value="{$key}" {if $info.PartnerID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                {if !empty($smarty.get.ContractID)}
                                    <table cellspacing="0" cellpadding="4">
                                        <tr>
                                            <td>{translate label='CIF'}:</td>
                                            <td><b></b>{$info.CIF|default:'-'}</td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Registrul comertului'}:</td>
                                            <td><b>{$info.RegComert|default:'-'}</b></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='IBAN'}:</td>
                                            <td><b>{$info.BankAccount|default:'-'}</b></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Banca'}:</td>
                                            <td><b>{$info.BankName|default:'-'}</b></td>
                                        </tr>
                                        <tr>
                                            <td>{translate label='Sucursala'}:</td>
                                            <td><b>{$info.BankLocation|default:'-'}</b></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2"><a href="./?m=companies&o=edit&CompanyID={$info.PartnerID}" target="_blank"
                                                               style="text-decoration: underline;">{translate label='Detalii partener'}</a></td>
                                        </tr>
                                    </table>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cesionat catre:'}</b></td>
                            <td><select name="AssignedCompanyID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$partners key=key item=item}
                                        <option value="{$key}" {if $info.AssignedCompanyID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Numar contract'}:</b></td>
                            <td><input type="text" name="ContractNo" value="{$info.ContractNo|default:''}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data semnare'}*:</b></b></td>
                            <td>
                                <input type="text" name="SignDate" class="formstyle" value="{if $info.SignDate != '0000-00-00'}{$info.SignDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4">
                                    var cal4 = new CalendarPopup();
                                    cal4.isShowNavigationDropdowns = true;
                                    cal4.setYearSelectStartOffset(10);
                                    //writeSource("js4");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4.select(document.contract.SignDate,'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data inceput'}*:</b></b></td>
                            <td>
                                <input type="text" name="StartDate" class="formstyle" value="{$info.StartDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.contract.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data sfarsit'}*:</b></td>
                            <td>
                                <input type="text" name="StopDate" class="formstyle" value="{$info.StopDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.contract.StopDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>Stare contract:</b></td>
                            <td>
                                <select name="Status">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$status key=key item=item}
                                        <option value="{$key}" {if $info.Status == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Prelungire automata'}:</b></td>
                            <td><input type="text" name="Extension" value="{$info.Extension|default:''}" size="10" maxlength="10">{translate label='(luni)'}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Moneda'}:</b></td>
                            <td>
                                <select name="Coin">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$coins item=item}
                                        <option value="{$item}" {if $info.Coin == $item}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                {if !empty($smarty.get.ContractID)}
                    <br>
                    <fieldset>
                        <legend>{translate label='Acte aditionale'}</legend>
                        <table cellspacing="0" cellpadding="4">
                            <tr>
                                <td>{translate label='Numar act'}</td>
                                <td>{translate label='Data inceput'}</td>
                                <td width="110">{translate label='Data sfarsit'}</td>
                                <td>{translate label='Valoare'}</td>
                                <td>{translate label='Observatii'}</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            {foreach from=$actead key=key item=item}
                                <tr>
                                    <td><input type="text" id="ActNo_{$key}" value="{$item.ActNo}" size="10" maxlength="16"></td>
                                    <td nowrap="nowrap">
                                        <input type="text" id="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10"
                                               maxlength="10">
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
                                        <input type="text" id="StopDate_{$key}" value="{$item.StopDate|date_format:"%d.%m.%Y"}" class="formstyle" value="" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                            var cal2_{$key} = new CalendarPopup();
                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                            cal2_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js2_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('StopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                           NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td><input type="text" id="ActValue_{$key}" value="{$item.ActValue}" size="10" maxlength="16"/></td>
                                    <td>
                                        <input type="hidden" id="Notes_{$key}" value="{$item.Notes}"/>
                                        <span id="Notes_{$key}_display"></span>
                                        [<a href="#" title="{$item.Notes|escape:'javascript'}" onclick="getNotes('Notes_{$key}'); return false;">{translate label='Editare'}</a>]
                                    </td>

                                    <td>{if $info.rw == 1}
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (document.getElementById('ActNo_{$key}').value && document.getElementById('StartDate_{$key}').value && checkDate(document.getElementById('StartDate_{$key}').value, 'Data inceput')) window.location.href = './?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=edit_actead&ActID={$key}&ActNo=' + escape(document.getElementById('ActNo_{$key}').value) + '&StartDate=' + document.getElementById('StartDate_{$key}').value + '&StopDate=' + document.getElementById('StopDate_{$key}').value + '&ActValue=' + document.getElementById('ActValue_{$key}').value + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); else alert('{translate label='Completati Numar act, Data inceput'}!'); return false;"
                                                                    title="{translate label='Modifica act aditional'}"><b>Mod</b></a></div>{/if}</td>
                                    <td>{if $info.rw == 1}
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=del_actead&ActID={$key}'; return false;"
                                                                    title="{translate label='Sterge act aditional'}"><b>Del</b></a></div>{/if}</td>
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
                                    <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                       ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
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
                                <td><input type="text" id="ActValue_0" value="" size="10" maxlength="16"/></td>
                                <td>
                                    <input type="hidden" id="Notes_0" value=""/>
                                    <span id="Notes_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('Notes_0'); return false;">{translate label='Editare'}</a>]
                                </td>

                                <td colspan="2" nowrap="nowrap">{if $info.rw == 1}
                                        <div id="button_add"><a href="#"
                                                                onclick="if (document.getElementById('ActNo_0').value && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, 'Data inceput')) window.location.href = './?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=new_actead&ActNo=' + escape(document.getElementById('ActNo_0').value) + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&ActValue=' + document.getElementById('ActValue_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('{translate label='Completati Numar act, Data inceput'}!'); return false;"
                                                                title="{translate label='Adauga act aditional'}"><b>Add</b></a></div>{/if}</td>
                            </tr>
                        </table>
                    </fieldset>
                {/if}
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                {if !empty($smarty.get.ContractID)}
                    <br/>
                    <fieldset>
                        <legend>Responsabil financiar</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {foreach from=$contract_persons key=key item=item}
                                <tr>
                                    <td>
                                        <b>{$item.FullName}</b>{if !empty($item.Function) || !empty($item.Phone) || !empty($item.Mobile)}
                                    <br>({if !empty($item.Function)}{$item.Function}, {/if}{if !empty($item.Phone)}{$item.Phone}, {/if}{$item.Mobile}){/if}
                                        {if $info.rw == 1}&nbsp;&nbsp;<a href="#"
                                                                         onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=del&PersonID={$key}'; return false;">{translate label='sterge'}</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 && $contract_persons|@count < $MAX_RESP_CONTR}
                                <tr>
                                    <td>
                                        <select id="persons_0">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$persons key=key item=item}
                                                <option value="{$key}">{$item}</option>
                                            {/foreach}
                                        </select>
                                        <a href="#"
                                           onclick="if (document.getElementById('persons_0').value>0) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=add&PersonID=' + document.getElementById('persons_0').value; return false;">{translate label='adauga '}</a>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                    <br/>
                    <fieldset>
                        <legend>Responsabil tehnic</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {foreach from=$contract_technical_persons key=key item=item}
                                <tr>
                                    <td>
                                        <b>{$item.FullName}</b>{if !empty($item.Function) || !empty($item.Phone) || !empty($item.Mobile)}
                                    <br>({if !empty($item.Function)}{$item.Function}, {/if}{if !empty($item.Phone)}{$item.Phone}, {/if}{$item.Mobile}){/if}
                                        {if $info.rw == 1}&nbsp;&nbsp;<a href="#"
                                                                         onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=del_tehnic&PersonID={$key}'; return false;">{translate label='sterge'}</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1 && $contract_technical_persons|@count < $MAX_RESP_TECH_CONTR}
                                <tr>
                                    <td>
                                        <select id="persons_tehnic_0">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$persons key=key item=item}
                                                <option value="{$key}">{$item}</option>
                                            {/foreach}
                                        </select>
                                        <a href="#"
                                           onclick="if (document.getElementById('persons_tehnic_0').value>0) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=add_tehnic&PersonID=' + document.getElementById('persons_tehnic_0').value; return false;">{translate label='adauga '}</a>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                    <br/>
                    <fieldset>
                        <legend>{translate label='Persoana de contact'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            {foreach from=$contact_persons key=key item=item}
                                <tr>
                                    <td>
                                        <b>{$item.ContactName}</b>{if !empty($item.ContactFunction) || !empty($item.ContactPhone)}
                                    <br>({if !empty($item.ContactFunction)}{$item.ContactFunction}, {/if}{$item.ContactPhone}){/if}
                                        {if $info.rw == 1}&nbsp;&nbsp;<a href="#"
                                                                         onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=del_contact&ContactID={$key}'; return false;">{translate label='sterge'}</a>{/if}
                                    </td>
                                </tr>
                            {/foreach}
                            {if $info.rw == 1}
                                <tr>
                                    <td>
                                        <select id="contacts_0">
                                            <option value="0">{translate label='alege...'}.</option>
                                            {foreach from=$contacts key=key item=item}
                                                {if $contact_persons|@count == 0 || !array_key_exists($key, $contact_persons)}
                                                    <option value="{$key}">{$item}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                        <a href="#"
                                           onclick="if (document.getElementById('contacts_0').value>0) window.location.href='./?m=contract&o=edit&ContractID={$smarty.get.ContractID}&action=add_contact&ContactID=' + document.getElementById('contacts_0').value; return false;">{translate label='adauga'}</a>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                {/if}
                <br>
                <fieldset>
                    <legend>Comentarii</legend>
                    <textarea name="Notes" rows="24" cols="60" wrap="soft" style="width: 100%">{$info.Notes|default:''}</textarea>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top">
                <br/>
                <div align="center">
                    {if !empty($smarty.get.ContractID)}
                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    {else}
                    <div align="center"><input type="submit" value="{translate label='Adauga contract'}" class="formstyle">
                        {/if}
                        <input type="button" class="formstyle" onclick="window.location.href = './?m=contract';" value="{translate label='Inapoi'}">
                    </div>
            </td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        {/literal}return (checkDate(f.SignDate.value, 'Data semnare') && checkDate(f.StartDate.value, 'Data inceput') && checkDate(f.StopDate.value, 'Data sfarsit'));{literal}
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
        document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 5) + '...';
        document.getElementById('layer_co').style.display = 'none';
        document.getElementById('layer_co_x').style.display = 'none';
    }

</script>
{/literal}