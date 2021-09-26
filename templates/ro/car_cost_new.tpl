{if !empty($smarty.get.save) && $err->getErrors() == "" && empty($smarty.get.ID)}
<span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
{else}

{if !empty($smarty.get.save) && $err->getErrors() == "" && !empty($smarty.get.ID)}
    <span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
{elseif !empty($smarty.get.msg)}
    <span style="color: #0000FF">{translate label="Datele au fost salvate"}!</span>
{elseif $err->getErrors() != ""}
    <span id="errors"></span>
    <span style="color: #FF0000;">{$err->getErrors()}</span>
{else}
    <span>&nbsp;</span>
{/if}
<div id="aj_dummy" style="display: none;"></div>
<div id="layer_costauto_scroll">
    <table border="0" cellpadding="4" cellspacing="0" class="screenLayer" width="100%">
        <tr valign="top">
            <td>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Masina'}</td>
                        <td colspan="3">
                            <select id="CarID" {if $costtype != 'assurance'} onchange="getCheckups();" {/if}>
                                <option value="0">{translate label='alege masina'}</option>
                                {foreach from=$cars key=key item=item}
                                    <option value="{$key}" {if $key==$info.CarID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Km'}</td>
                        <td colspan="3"><input type="text" id="Km" value="{$info.Km|default:''}" size="10" maxlength="10" style="text-align: right;"></td>
                    </tr>
                    <tr>
                        <td>{translate label='Angajat'}</td>
                        <td colspan="3">
                            <select id="PersonID">
                                <option value="0">{translate label='alege angajat'}</option>
                                {foreach from=$users key=key item=item}
                                    <option value="{$key}" {if $key==$info.PersonID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Numar document'}</td>
                        <td colspan="3"><input type="text" id="ReceiptNo" value="{$info.ReceiptNo|default:''}" size="20" maxlength="64"></td>
                    </tr>
                    <tr>
                        <td>{translate label="Data document"}</td>
                        <td colspan="3">
                            <input type="text" id="Date" class="formstyle" value="{if !empty($info.Date) && $info.Date != '0000-00-00'}{$info.Date|date_format:"%d.%m.%Y"}{/if}"
                                   size="10" maxlength="10">
                            <A HREF="#"
                               onClick="var cal1 = new CalendarPopup(); cal1.isShowNavigationDropdowns = true; cal1.setYearSelectStartOffset(10); cal1.select(document.getElementById('Date'),'anchor1','dd.MM.yyyy'); return false;"
                               NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"></A>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Furnizor'}</td>
                        <td colspan="3">
                            <select id="CompanyID">
                                <option value="0">{translate label='alege furnizor'}</option>
                                {foreach from=$companies key=key item=item}
                                    <option value="{$key}" {if $key==$info.CompanyID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Moneda'}</td>
                        <td colspan="3">
                            <select id="Coin">
                                {foreach from=$coins key=key item=item}
                                    <option value="{$key}" {if $key==$info.Coin}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td>{translate label='Buget'}</td>
                        <td width="10"><input type="checkbox" id="Budget" value="1" {if $info.Budget == 1}checked{/if}></td>
                        {if $costtype != 'assurance'}
                            <input type="hidden" name="DummyCheckupID" id="DummyCheckupID" value="{if $info.CheckupID}{$info.CheckupID}{else}0{/if}"/>
                            <td width="40">{translate label='Revizie'}</td>
                            <td>
                                <input type="checkbox" id="Checkup" value="1" onchange="getCheckups();" {if $info.Checkup == 1}checked{/if}>
                                <div id="CheckupHolder" style="display: inline;">
                                    {if $info.Checkup == 1}
                                        <select id="CheckupID" name="CheckupID" style="max-width: 140px;">
                                            {foreach from=$checkups key=key item=item}
                                                <option value="{$key}" {if $key == $info.CheckupID} selected="selected"{/if}>{translate label='Revizie - '}{$item.Km} Km</option>
                                            {/foreach}
                                        </select>
                                    {/if}
                                </div>
                            </td>
                        {else}
                            <td colspan="2"></td>
                        {/if}
                    </tr>
                    <tr>
                        <td>{translate label='Grupa cheltuiala'}</td>
                        <td colspan="3">
                            {if $info.items|@count > 0 || $info.CostTypeID_Dictionary > 0}
                                <b>{$costgroups[$info.CostGroupID]}</b>
                                <input type="hidden" id="CostGroupID" name="CostGroupID" value="{$info.CostGroupID}"/>
                            {elseif $costtype == 'assurance'}
                                <b>{$costgroups[1]}</b>
                                <input type="hidden" id="CostGroupID" name="CostGroupID" value="1"/>
                            {else}
                                <select id="CostGroupID">
                                    <option value="0">{translate label='alege grupa cheltuiala'}</option>
                                    {foreach from=$costgroups key=key item=item}
                                        {if $key != 1}
                                            <option value="{$key}" {if $key==$info.CostGroupID}selected{/if}>{$item}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            {/if}
                        </td>
                    </tr>
                    <!--<input type="hidden" id="CostTypeID" value="0">-->
                    <tr>
                        <td>{translate label='Observatii'}</td>
                        <td colspan="3"><textarea id="Notes" style="width: 230px; height: 100px;">{$info.Notes}</textarea></td>
                    </tr>
                </table>
            </td>
            <td>

                {if $costtype == 'assurance'}
                    <div id="div_CostTypeID_Dictionary">
                        <select id="CostTypeID_Dictionary">
                            <option value="0">{translate label='alege asigurare'}</option>
                            {foreach from=$costtypes_dictionary key=key item=item}
                                <optgroup label="{$key}">
                                    {foreach from=$item key=skey item=sitem}
                                        <option value="{$skey}" {if $skey==$info.CostTypeID_Dictionary}selected{/if}>{$sitem}</option>
                                    {/foreach}
                                </optgroup>
                            {/foreach}
                        </select>
                    </div>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>{translate label="Data inceput"}</td>
                            <td>
                                <input type="text" id="StartDate" class="formstyle"
                                       value="{if !empty($info.StartDate) && $info.StartDate != '0000-00-00'}{$info.StartDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <A HREF="#"
                                   onClick="var cal2 = new CalendarPopup(); cal2.isShowNavigationDropdowns = true; cal2.setYearSelectStartOffset(10); cal2.select(document.getElementById('StartDate'),'anchor2','dd.MM.yyyy'); return false;"
                                   NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A>
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label="Data expirare"}</td>
                            <td>
                                <input type="text" id="StopDate" class="formstyle"
                                       value="{if !empty($info.StopDate) && $info.StopDate != '0000-00-00'}{$info.StopDate|date_format:"%d.%m.%Y"}{/if}" size="10" maxlength="10">
                                <A HREF="#"
                                   onClick="var cal3 = new CalendarPopup(); cal3.isShowNavigationDropdowns = true; cal3.setYearSelectStartOffset(10); cal3.select(document.getElementById('StopDate'),'anchor3','dd.MM.yyyy'); return false;"
                                   NAME="anchor3" ID="anchor3"><img src="./images/cal.png" border="0"></A>
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='Valoare asigurare'}</td>
                            <td>
                                <input type="text" id="ItemCost" value="{$info.ItemCost|default:''}" size="10" maxlength="10" style="text-align: right;">
                                <select id="ItemCoin">
                                    {foreach from=$coins key=key item=item}
                                        <option value="{$key}" {if $key==$info.ItemCoin}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='Fransiza'}</td>
                            <td>
                                <input type="text" id="FransizaCost" value="{$info.FransizaCost|default:''}" size="10" maxlength="10" style="text-align: right;">
                                <select id="FransizaCoin">
                                    {foreach from=$coins key=key item=item}
                                        <option value="{$key}" {if $key==$info.FransizaCoin}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>{translate label='Numar rate'}</td>
                            <td><input type="text" id="RateNo" value="{$info.RateNo|default:''}" size="10" maxlength="10"></td>
                        </tr>
                    </table>
                {elseif $smarty.get.ID > 0}
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>{translate label='Articol'}</td>
                            <td colspan="2">{translate label='Cant.'}</td>
                            <td>{translate label='Valoare<br> fara TVA'}</td>
                            <td>{translate label='Cota<br> TVA'}</td>
                            <td>{translate label='Total cu TVA'}</td>
                        </tr>
                        {assign var="total" value="0"}
                        {foreach from=$info.items key=key item=item}
                            <tr>
                                <td>
                                    <select id="CostTypeID_Dictionary_{$key}" style="width: 150px;">
                                        <option value="0">{translate label='alege articol'}</option>
                                        {foreach from=$costtypes_dictionary key=key2 item=item2}
                                            <optgroup label="{$key2}">
                                                {foreach from=$item2 key=skey2 item=sitem2}
                                                    <option value="{$skey2}" {if $skey2==$item.CostTypeID_Dictionary}selected{/if}>{$sitem2}</option>
                                                {/foreach}
                                            </optgroup>
                                        {/foreach}
                                    </select>
                                </td>
                                <td><input type="text" id="Quantity_{$key}" value="{$item.Quantity}" size="4" maxlength="5" style="text-align: center;"></td>
                                <td>{$item.Unit}</td>
                                <td><input type="text" id="ItemCost_{$key}" value="{$item.ItemCost}" size="10" maxlength="10" style="text-align: right;"></td>
                                <td>
                                    <select id="Vat_{$key}">
                                        <option value="0">-</option>
                                        {foreach from=$vat_types key=key2 item=item2}
                                            <option value="{$key2}" {if $item.VAT == $key2} selected="selected"{/if}>{$item2}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td><input type="text" name="item_value" value="{$item.Value}" style="border:0; width: 75px; text-align: right;"/></td>
                                <td>
                                    <div id="button_mod"><a href="#"
                                                            onclick="if (document.getElementById('CostTypeID_Dictionary_{$key}').value > 0 && document.getElementById('Quantity_{$key}').value > 0 && document.getElementById('ItemCost_{$key}').value)
                                                                    showInfo('{$smarty.server.REQUEST_URI}&save=1&ItemID={$key}' +
                                                                    '&CostTypeID_Dictionary=' + document.getElementById('CostTypeID_Dictionary_{$key}').value +
                                                                    '&Quantity=' + document.getElementById('Quantity_{$key}').value +
                                                                    '&VAT=' + document.getElementById('Vat_{$key}').value +
                                                                    '&ItemCost=' + document.getElementById('ItemCost_{$key}').value, 'layer_costauto_content'); else alert('{translate label='Nu ati specificat toate informatiile!'}');
                                                                    return false;" title="{translate label='Modificare articol'}"><b>Mod</b></a></div>
                                </td>
                                <td>
                                    <div id="button_del"><a href="#"
                                                            onclick="if (confirm('Sunteti sigur(a)?')) showInfo('{$smarty.server.REQUEST_URI}&save=1&ItemID={$key}&del=1', 'layer_costauto_content'); return false;"
                                                            title="{translate label='Stergere articol'}"><b>Del</b></a></div>
                                </td>
                            </tr>
                        {/foreach}
                        <tr>
                            <td>
                                <select id="CostTypeID_Dictionary_0" style="width: 150px;" onchange="getAproxValue(this.value);">
                                    <option value="0">{translate label='alege articol'}</option>
                                    {foreach from=$costtypes_dictionary key=key item=item}
                                        <optgroup label="{$key}">
                                            {foreach from=$item key=skey item=sitem}
                                                <option value="{$skey}">{$sitem}</option>
                                            {/foreach}
                                        </optgroup>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="text" id="Quantity_0" value="" size="4" maxlength="5" style="text-align: center;"></td>

                            <td id="ItemUm_0">&nbsp;</td>
                            <td><input type="text" id="ItemCost_0" value="" size="10" maxlength="10" style="text-align: right;"></td>

                            <td>
                                <select id="Vat_0">
                                    <option value="0">-</option>
                                    {foreach from=$vat_types key=key2 item=item2}
                                        <option value="{$key2}" {if $key2 == 1} selected="selected"{/if}>{$item2}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>&nbsp;</td>
                            <td colspan="2">
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('CostTypeID_Dictionary_0').value > 0 && document.getElementById('Quantity_0').value > 0 && document.getElementById('ItemCost_0').value)
                                                                showInfo('{$smarty.server.REQUEST_URI}&save=1&ItemID=0' +
                                                                '&CostTypeID_Dictionary=' + document.getElementById('CostTypeID_Dictionary_0').value +
                                                                '&Quantity=' + document.getElementById('Quantity_0').value +
                                                                '&VAT=' + document.getElementById('Vat_0').value +
                                                                '&ItemCost=' + document.getElementById('ItemCost_0').value, 'layer_costauto_content'); else alert('{translate label='Nu ati specificat toate informatiile!'}');
                                                                return false;" title="{translate label='Adaugare articol'}"><b>Add</b></a></div>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="5" style="border-top: 1px solid #a4a4a4;">{translate label="Suma total articole"}</td>
                            <td style="border-top: 1px solid #a4a4a4; text-align: right;">{$info.Cost|string_format:"%.2f"}</td>
                            <td colspan="2" style="border-top: 1px solid #a4a4a4;">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>{translate label="Total factura"}</td>
                            <td colspan="4">&nbsp;</td>
                            <td colspan="3"><input type="text" id="invoice_total" onkeyup="check_invoice();" style="width: 75px; text-align: right;"/></td>
                        </tr>
                        <tr>
                            <td colspan="7" id="check_invoice_message"></td>
                        </tr>
                    </table>
                {/if}
            </td>
        </tr>
    </table>
    <div align="right">
        <input type="button" value="{translate label='Salveaza'}" onclick="showInfo('{$smarty.server.REQUEST_URI}&save=1' +
                '&CarID=' +  document.getElementById('CarID').value +
                '&Km=' + document.getElementById('Km').value +
                '&PersonID=' + document.getElementById('PersonID').value +
                '&ReceiptNo=' + escape(document.getElementById('ReceiptNo').value) +
                '&Date=' + document.getElementById('Date').value +
                '&CompanyID=' + document.getElementById('CompanyID').value +
                //									      '&Cost=' + document.getElementById('Cost').value +
                '&Coin=' + document.getElementById('Coin').value +
                '&Budget=' + (document.getElementById('Budget').checked ? 1 : 0) +
                '&CostGroupID=' + document.getElementById('CostGroupID').value +
                //									      '&CostTypeID=' + document.getElementById('CostTypeID').value +
                '&Notes=' + escape(document.getElementById('Notes').value)
        {if $costtype == 'assurance'}
                +
                '&CostTypeID_Dictionary=' + document.getElementById('CostTypeID_Dictionary').value +
                '&StartDate=' + document.getElementById('StartDate').value +
                '&StopDate=' + document.getElementById('StopDate').value +
                '&ItemCost=' + document.getElementById('ItemCost').value +
                '&ItemCoin=' + document.getElementById('ItemCoin').value +
                '&FransizaCost=' + document.getElementById('FransizaCost').value +
                '&FransizaCoin=' + document.getElementById('FransizaCoin').value +
                '&RateNo=' + document.getElementById('RateNo').value
        {else}
                +
                '&Checkup=' + (document.getElementById('Checkup').checked ? 1 : 0) +
                '&CheckupID=' + (document.getElementById('Checkup').checked ? document.getElementById('CheckupID').value : 0)
        {/if}
                , 'layer_costauto_content'); setTimeout(windowClose, 300);">&nbsp;&nbsp;
        <input type="button" value="{translate label='Inapoi'}"
               onclick="document.getElementById('layer_costauto').style.display = 'none'; document.getElementById('layer_costauto_x').style.display = 'none'; window.location.reload();">
    </div>

    {/if}


    