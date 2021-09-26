{include file="companies_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.get.CompanyID)}
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="companies_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$locations.0.CompanyName}</span></td>
        </tr>
    {else}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare companie'}</span></td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>

{foreach from=$locations item=info}
    {if !empty($info.ID)}{assign var="ID" value=$info.ID}{else}{assign var="ID" value=0}{/if}
    <form action="{$smarty.server.REQUEST_URI}" method="post" onsubmit="return validForm(this);">
        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
            <tr>
                <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 4px; padding-bottom: 10px;">
                    <fieldset>
                        <legend>Sediu</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b>{translate label='Judet'}:*</b></td>
                                            <td>
                                                <select id="DistrictID" name="DistrictID"
                                                        onchange="if (this.value>0) showInfo('ajax.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID_{$ID}');">
                                                    <option value="">{translate label='alege...'}</option>
                                                    {foreach from=$districts key=key item=item}
                                                        <option value="{$key}" {if !empty($info.DistrictID) && $key == $info.DistrictID}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="padding-top: 10px;"><b>{translate label='Localitate'}:*</b></td>
                                            <td>
                                                <div id="div_CityID_{$ID}">
                                                    <select name="CityID">
                                                        <option value="">{translate label='alege...'}</option>
                                                        {foreach from=$info.cities key=key item=item}
                                                            <option value="{$key}" {if !empty($info.CityID) && $key == $info.CityID}selected{/if}>{$item}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Cod postal'}:</b></td>
                                            <td><input type="text" name="StreetCode" value="{$info.StreetCode|default:''}" size="30" maxlength="16"
                                                       onblurx="showInfo('ajax.php?o=street&districtID=' + document.getElementById('DistrictID').value + '&city=' + escape(document.getElementById('CityName').value) + '&code=' + escape(this.value) + '&rand=' + parseInt(Math.random()*999999999), 'StreetNameID')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Strada'}:*</b></td>
                                            <td>
                                                <div id="StreetNameID"><input type="text" name="StreetName" value="{$info.StreetName|default:''}" size="30" maxlength="128"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Nr'}:</b></td>
                                            <td><input type="text" name="StreetNumber" value="{$info.StreetNumber|default:''}" size="8" maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <b>{translate label='Bl'}:</b>&nbsp;<input type="text" name="Bl" value="{$info.Bl|default:''}" size="5" maxlength="8">&nbsp;
                                                <b>{translate label='Sc'}:</b>&nbsp;<input type="text" name="Sc" value="{$info.Sc|default:''}" size="5" maxlength="8">&nbsp;
                                                <b>{translate label='Et'}:</b>&nbsp;<input type="text" name="Et" value="{$info.Et|default:''}" size="5" maxlength="8">&nbsp;
                                                <b>{translate label='Ap'}:</b>&nbsp;<input type="text" name="Ap" value="{$info.Ap|default:''}" size="5" maxlength="8">&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Telefon 1'}*:</b></td>
                                            <td><input type="text" name="PhoneNumberA" value="{$info.PhoneNumberA|default:''}" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Telefon 2: '}</b></td>
                                            <td><input type="text" name="PhoneNumberB" value="{$info.PhoneNumberB|default:''}" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Fax'}:</b></td>
                                            <td><input type="text" name="FaxNumber" value="{$info.FaxNumber|default:''}" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <input type="radio" name="AddressType" value="1" {if $info.AddressType == 1}checked{/if}>{translate label='sediu social'}
                                                <input type="radio" name="AddressType" value="2" {if $info.AddressType == 2}checked{/if}>{translate label='punct de lucru'}
                                                <br>
                                                <p><input type="checkbox" name="MailingAddress" value="1"
                                                          {if $info.MailingAddress == 1}checked{/if}>{translate label='adresa de corespondenta'}</p>
                                                <p><input type="checkbox" name="FactoringAddress" value="1"
                                                          {if $info.FactoringAddress == 1}checked{/if}>{translate label='adresa de facturare'}</p>
                                                <p><input type="checkbox" name="DeliveryAddress" value="1"
                                                          {if $info.DeliveryAddress == 1}checked{/if}>{translate label='adresa de livrare'}</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td colspan="2" style="padding-top: 10px;"><b><u>{translate label='Persoana de contact'}</u></b></td>
                                        <tr>
                                            <td width="100"><b>{translate label='Nume'}:</b></td>
                                            <td><input type="text" name="ContactName" value="{$info.ContactName|default:''}" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Telefon'}:</b></td>
                                            <td><input type="text" name="ContactPhone" value="{$info.ContactPhone|default:''}" size="30" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Email'}:</b></td>
                                            <td><input type="text" name="ContactEmail" value="{$info.ContactEmail|default:''}" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Functie'}:</b></td>
                                            <td>
                                                <select name="ContactFunctionID">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$jobstitle key=key item=item}
                                                        <option value="{$key}" {if $info.ContactFunctionID==$key}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-top: 10px;"><b><u>{translate label='Persoana de contact 2'}</u></b></td>
                                        <tr>
                                            <td width="100"><b>{translate label='Nume'}:</b></td>
                                            <td><input type="text" name="ContactName2" value="{$info.ContactName2|default:''}" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Telefon'}:</b></td>
                                            <td><input type="text" name="ContactPhone2" value="{$info.ContactPhone2|default:''}" size="30" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Email'}:</b></td>
                                            <td><input type="text" name="ContactEmail2" value="{$info.ContactEmail2|default:''}" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Functie'}:</b></td>
                                            <td>
                                                <select name="ContactFunctionID2">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$jobstitle key=key item=item}
                                                        <option value="{$key}" {if $info.ContactFunctionID2==$key}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                {if $ID > 0}
                                                    <input type="hidden" name="ID" value="{$ID}">
                                                    {if $locations.0.rw==1}<input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button"
                                                                                                                                                        value="{translate label='Sterge'}"
                                                                                                                                                        onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href= '{$smarty.server.REQUEST_URI}&action=del&ID={$ID}';">{/if}
                                                {else}
                                                    <input type="hidden" name="ID" value="0">
                                                    {if $locations.0.rw==1}<input type="submit" value="{translate label='Adauga'}">{/if}
                                                {/if}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </form>
{/foreach}

{literal}
<script type="text/javascript">
    function validForm(f) {
        {/literal}
        return validTextField(f.DistrictID, '{translate label='Nu ati ales judetul'}!') &&
            validTextField(f.CityID, '{translate label='Nu ati specificat localitatea'}!') &&
            validTextField(f.StreetName, '{translate label='Nu ati specificat Strada'}!') &&
            validTextField(f.PhoneNumberA, '{translate label='Nu ati specificat telefonul'}!');
        {literal}
    }
</script>
{/literal}