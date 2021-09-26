{include file="companies_menu.tpl"}
{literal}
<script type="text/javascript">
    $(document).ready(function () {
        if ($('#Judet').val() > 0) showInfo('ajax.php?o=Oras&Judet=' + $('#Judet').val() + '&rand=' + parseInt(Math.random() * 999999999) + '&companyID=' + {/literal}{$smarty.get.CompanyID}{literal} , 'div_CityID_');
    });

</script>{/literal}

<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.CompanyID)}
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox">{include file="companies_submenu.tpl"}</span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.CompanyName}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare companie'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele companiei au fost salvate!'}</td>
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
                    <legend>{translate label='Date identificare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Nume companie'}:*</b></td>
                            <td><input type="text" name="CompanyName" value="{$info.CompanyName|default:''}" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip companie'}:</b></td>
                            <td>
                                <input type="checkbox" name="Self" value="1" {if $info.Self==1}checked{/if}> self
                                <input type="checkbox" name="isGeneric" value="1" {if $info.isGeneric==1}checked{/if}> {translate label='generica'}
                                <select name="Situation">
                                    <option value="0">{translate label="Situatie companie"}</option>
                                    {foreach from=$situation key=key item=item}
                                        <option value="{$key}" {if $info.Situation==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Domeniu de activitate'}:*</b></td>
                            <td>
                                <select name="CompanyDomainID" class="dropdown">
                                    <option value="0">alege...</option>
                                    {foreach from=$companydomains key=key item=item}
                                        <option value="{$key}" {if !empty($info.CompanyDomainID) && $key == $info.CompanyDomainID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="Domain" value="">
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CIF'}:</b></td>
                            <td><input type="text" name="CIF" value="{$info.CIF|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Registrul comertului'}:</b></td>
                            <td><input type="text" name="RegComert" value="{$info.RegComert|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Reprezentant legal'}:</b></td>
                            <td>
                                <select name="LegalPersonID" class="dropdown">
                                    <option value="0">alege...</option>
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}" {if !empty($info.LegalPersonID) && $key == $info.LegalPersonID}selected{/if}>{$item.FullName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Reprezentant resurse umane'}:</b></td>
                            <td>
                                <select name="HRPersonID" class="dropdown">
                                    <option value="0">alege...</option>
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}" {if !empty($info.HRPersonID) && $key == $info.HRPersonID}selected{/if}>{$item.FullName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='E-mail'}:</b></td>
                            <td><input type="text" name="CompanyEmail" value="{$info.CompanyEmail|default:''}" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Website'}:</b></td>
                            <td><input type="text" name="CompanyWebsite" value="{$info.CompanyWebsite|default:''}" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Judet'}:</b></td>
                            <td>
                                <select id="Judet" name="Judet"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=Oras&Judet=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID_{$ID}');">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$districts key=key item=item}
                                        <option value="{$key}" {if !empty($info.Judet) && $key == $info.Judet}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Oras'}:</b></td>
                            <td>
                                <div id="div_CityID_{$ID}">
                                    <select name="Oras">
                                        <option value="">{translate label='alege...'}</option>
                                        {foreach from=$info.cities key=key item=item}
                                            <option value="{$key}" {if !empty($info.Oras) && $key == $info.Oras}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><b>{translate label='Telefon 1'}:</b></td>
                            <td><input type="text" name="PhoneNumberA" value="{$info.PhoneNumberA|default:''}" size="30" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Telefon 2'}:</b></td>
                            <td><input type="text" name="PhoneNumberB" value="{$info.PhoneNumberB|default:''}" size="30" maxlength="50"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <div align="center">
                    {if !empty($smarty.get.CompanyID)}
                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                    {else}
                    <div align="center"><input type="submit" value="{translate label='Adauga companie'}" class="formstyle">
                        {/if}
                        <input type="button" class="formstyle" onclick="window.location.href = './?m=companies';" value="{translate label='Inapoi'}">
                    </div>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Observatii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="100"><b>{translate label='Angajati'}:</b></td>
                            <td><input type="text" name="EmployeesNo" value="{$info.EmployeesNo|default:''}" size="10" maxlength="10"></td>
                        </tr>
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
                        <tr>
                            <td><b>{translate label='Observatii banca'}:</b></td>
                            <td><textarea name="BankNotes" rows="2" cols="50">{$info.BankNotes|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Alte observatii'}:</b></td>
                            <td><textarea name="Notes" rows="2" cols="50">{$info.Notes|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Sigla companie'}:</b></td>
                            <td><input type="file" name="photo"></td>
                            <td rowspan="4" align="center">{if isset($info.photo)}<a href="{$info.photo|replace:'_100_100':''}" title="{translate label='mareste poza'}"
                                                                                     target="_blank"><img style="padding:2px; border:solid 1px #666;" src="{$info.photo}"></a>
                                    <br/>
                                <a href="#"
                                   onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta imagine?'}')) window.location.href='./?m=companies&o=del_photo&CompanyID={$smarty.get.CompanyID}'; return false;"
                                   title="{translate label='Sterge'}" class="blue">sterge</a>{/if}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Imagine header tipizate'}:</b></td>
                            <td><input type="file" name="photo_header_report"></td>
                            <td rowspan="4" align="center">{if isset($info.photo_header_report)}<a href="{$info.photo_header_report|replace:'_100_100':''}"
                                                                                                   title="{translate label='mareste poza'}" target="_blank"><img
                                            style="padding:2px; border:solid 1px #666;" src="{$info.photo_header_report}"></a>
                                    <br/>
                                <a href="#"
                                   onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta imagine?'}')) window.location.href='./?m=companies&o=del_photo_header_report&CompanyID={$smarty.get.CompanyID}'; return false;"
                                   title="{translate label='Sterge'}" class="blue">sterge header</a>{/if}</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data inregistrarii'}:</b></td>
                            <td>
                                <input type="text" id="RegisterDate" name="RegisterDate" class="formstyle"
                                       value="{if !empty($info.RegisterDate) && $info.RegisterDate != '0000-00-00'}{$info.RegisterDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_RegisterDate">
                                    var cal_RegisterDate = new CalendarPopup();
                                    cal_RegisterDate.isShowNavigationDropdowns = true;
                                    cal_RegisterDate.setYearSelectStartOffset(10);
                                    //writeSource("js_RegisterDate");
                                </SCRIPT>
                                <A HREF="#" onClick="cal_RegisterDate.select(document.getElementById('RegisterDate'),'anchor_RegisterDate','dd.MM.yyyy'); return false;"
                                   NAME="anchor_RegisterDate" ID="anchor_RegisterDate"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        {if !empty($customfields.CustomCompany1)}
                            <tr>
                                <td><b>{$customfields.CustomCompany1}:</b></td>
                                <td><input type="text" name="CustomCompany1" value="{$info.CustomCompany1|default:''}" size="30" maxlength="255"></td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomCompany2)}
                            <tr>
                                <td><b>{$customfields.CustomCompany2}:</b></td>
                                <td><input type="text" name="CustomCompany2" value="{$info.CustomCompany2|default:''}" size="30" maxlength="255"></td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomCompany3)}
                            <tr>
                                <td><b>{$customfields.CustomCompany3}:</b></td>
                                <td>
                                    <input type="text" id="CustomCompany3" name="CustomCompany3" class="formstyle"
                                           value="{if !empty($info.CustomCompany3) && $info.CustomCompany3 != '0000-00-00 00:00:00'}{$info.CustomCompany3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomCompany3">
                                        var cal_CustomCompany3 = new CalendarPopup();
                                        cal_CustomCompany3.isShowNavigationDropdowns = true;
                                        cal_CustomCompany3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomCompany3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomCompany3.select(document.getElementById('CustomCompany3'),'anchor_CustomCompany3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomCompany3" ID="anchor_CustomCompany3"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>
<fieldset>
    <legend>{translate label='Persoane de contact '}</legend>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
        <table border="0" cellpadding="4" cellspacing="0" class="screen">
            <tr>
                <td width="100"><b>{translate label='Nume'}*:</b></td>
                <td><b>{translate label='Telefon'}:</b></td>
                <td><b>{translate label='Email'}:</b></td>
                <td><b>{translate label='Functie'}:</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            {foreach from=$contacts key=key item=item name=iter1}
                <tr>
                    <td><input type="text" id="ContactName_{$item.ContactID}" name="ContactName[{$item.ContactID}]" value="{$item.ContactName|default:''}" size="25"
                               maxlength="64"/></td>
                    <td><input type="text" id="ContactPhone_{$item.ContactID}" name="ContactPhone[{$item.ContactID}]" value="{$item.ContactPhone|default:''}" size="15"
                               maxlength="16"/></td>
                    <td><input type="text" id="ContactEmail_{$item.ContactID}" name="ContactEmail[{$item.ContactID}]" value="{$item.ContactEmail|default:''}" size="25"
                               maxlength="64"/></td>
                    <td><input type="text" id="ContactFunction_{$item.ContactID}" name="ContactFunction[{$item.ContactID}]" value="{$item.ContactFunction|default:''}" size="25"
                               maxlength="128"/></td>
                    {if $info.rw == 1}
                        <td>
                            <div id="button_mod"><a href="#" onclick="if (document.getElementById('ContactName_{$item.ContactID}').value)
                                        window.location.href = '{$smarty.server.REQUEST_URI}&o=edit_contact&ContactID={$item.ContactID}' + '&ContactName=' + escape(document.getElementById('ContactName_{$item.ContactID}').value) + '&ContactPhone=' + escape(document.getElementById('ContactPhone_{$item.ContactID}').value) + '&ContactEmail=' + escape(document.getElementById('ContactEmail_{$item.ContactID}').value) + '&ContactFunction=' + escape(document.getElementById('ContactFunction_{$item.ContactID}').value);
                                        else alert('{translate label='Nu ati completat numele'}!');
                                        return false;" title="{translate label='Modifica persoana'}"><b>Mod</b></a></div>
                        </td>
                        <td>
                            <div id="button_del">
                                <a href="{$smarty.server.REQUEST_URI}&o=del_contact&ContactID={$item.ContactID}" onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                   title="{translate label='Sterge contact'}"><b>Del</b></a>
                            </div>
                        </td>
                    {/if}
                </tr>
            {/foreach}
            <!--- ADD new contact  -->
            <td width="100"><b>{translate label='Nume'}*:</b></td>
            <td><b>{translate label='Telefon'}:</b></td>
            <td><b>{translate label='Email'}:</b></td>
            <td><b>{translate label='Functie'}:</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="text" id="ContactName" name="ContactName[0]" value="" size="25" maxlength="64"/></td>
                <td><input type="text" id="ContactPhone" name="ContactPhone[0]" value="" size="15" maxlength="16"/></td>
                <td><input type="text" id="ContactEmail" name="ContactEmail[0]" value="" size="25" maxlength="64"/></td>
                <td><input type="text" id="ContactFunction" name="ContactFunction[0]" value="" size="25" maxlength="128"/></td>
                {if $info.rw == 1}
                    <td style="padding-left: 10px;" colspan="2">
                        <div id="button_add"><a href="#" onclick="
                                    if (document.getElementById('ContactName').value)
                                    window.location.href = '{$request_uri}&o=new_contact&ContactName=' + escape(document.getElementById('ContactName').value) + '&ContactPhone=' + escape(document.getElementById('ContactPhone').value) + '&ContactEmail=' + escape(document.getElementById('ContactEmail').value) + '&ContactFunction=' + escape(document.getElementById('ContactFunction').value);
                                    else alert('{translate label='Nu ati completat numele'}!');
                                    return false;" title="{translate label='Adauga'}"><b>Add</b></a></div>
                    </td>
                {/if}
            </tr>
            <!-- END ADD contact -->
        </table>
    </form>
</fieldset>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="screen">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
{literal}
<script type="text/javascript">
    showInfo('ajax.php?o=Oras&Judet=' + {$info.Judet} + '&Oras=' + {$info.Oras} + '&rand=' + parseInt(Math.random() * 999999999), 'div_CityID_');

    {
        literal
    }

    function validateForm(f) {
        return {/literal}{if !empty($customfields.CustomCompany3)}is_empty(f.CustomCompany3.value) ? true : checkDate(f.CustomCompany3.value, '{$customfields.CustomCompany3}')
        {else}true{/if}{literal};
    }
</script>
{/literal}