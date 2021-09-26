{include file="persons_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.PersonID)}
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare persoana'}</span></td>
            </tr>
        {/if}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR"
                    style="text-align: center; color: #0000FF; padding-top: 10px;">{display_success message='Datele persoanei au fost salvate!'|translate}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR">{display_error errors=$err->getErrors()}</td>
            </tr>
        {/if}
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="40%">
                <br>
                <fieldset>
                    <legend>{translate label='Status persoana'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="160"><b>{translate label='Status'}:*</b></td>
                            <td>
                                <table cellspacing="0" cellpadding="0">
                                    <tr>
                                        <td>
                                            <input type="hidden" name="OldStatus" value="{$info.Status}"/>
                                            <select name="Status" onchange="setSubStatus(this.value);">
                                                {foreach from=$status key=key item=item}
                                                    <option value="{$key}" {if !empty($info.Status) && $key == $info.Status}selected{/if}>{$item}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td style="padding-left: 10px;">
                                            <div id="div_role">
                                                {if !empty($roles)}
                                                    <select name="RoleID">
                                                        <option value="0">{translate label='alege role...'}</option>
                                                        {foreach from=$roles key=key item=item}
                                                            {if $smarty.session.USER_ID == 1 || in_array($key, $smarty.session.ROLEALLOC)}
                                                                <option value="{$key}" {if !empty($info.RoleID) && $info.RoleID==$key}selected{/if}>{$item}</option>
                                                            {/if}
                                                        {/foreach}
                                                    </select>
                                                {/if}
                                            </div>
                                            {if empty($info.Status) || (!empty($info.Status) && in_array($info.Status, array(2, 7, 9, 10)))}
                                                <script language="javascript">document.getElementById('div_role').style.display = 'none';</script>
                                            {/if}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {if !empty($smarty.get.PersonID)}
                            <tr>
                                <td colspan="2">
                                    <div id="calif">
                                        <b>{translate label='Calificativ'}:</b>
                                        <select name="Qualify" style="margin-left: 98px">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$qualify key=key item=item}
                                                <option value="{$key}" {if $key==$info.Qualify}selected{/if}>{$item}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td colspan="2">
                                    <div id="institutie">
                                        <b>{translate label='Institutie solicitanta'}:</b>
                                        <select name="InstitutieID" style="margin-left: 33px">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$institutii key=key item=item}
                                                <option value="{$item.CompanyID}" {if $item.CompanyID==$info.InstitutieID}selected{/if}>{$item.CompanyName}</option>
                                            {/foreach}
                                        </select>
                                    </div>
                                </td>
                            </tr>
                        {/if}
                        {if !empty($smarty.get.PersonID) && $info.Status == 1}
                            <tr>
                                <td><b>{translate label='Status CV'}:</b></td>
                                <td>
                                    <select name="CVStatus">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$cvstatus key=key item=item}
                                            <option value="{$key}"
                                                    {if (!empty($info.CVStatus) && $info.CVStatus!=0 && $key == $info.CVStatus) || (!empty($info.SubStatus) && $key == $info.SubStatus) }selected{/if}>{$item}</option>{/foreach}
                                    </select>
                                    {literal}
                                        <script language="javascript">
                                            function setSubStatus(index) {
                                                if (index == 2 || index == 7 || index == 9 || index == 10) {
                                                    document.getElementById('div_role').style.display = 'block';
                                                } else {
                                                    document.getElementById('div_role').style.display = 'none';
                                                }
                                            }
                                        </script>
                                    {/literal}
                                    <script language="javascript">setSubStatus(1);</script>
                                    <input type="hidden" id="SubStatus" name="SubStatus" value="0">
                                </td>
                            </tr>
                        {else}
                            <tr>
                                <td><b>{translate label='Tip'}:</b></td>
                                <td>
                                    {foreach from=$status key=key item=item}
                                        <div id="Status_{$key}" style="display: none;">
                                            <select onchange="if (this.value>0) document.getElementById('SubStatus').value = this.value;">
                                                <option value="0">{translate label='alege...'}</option>
                                                {foreach from=$substatus.$key key=key2 item=item2}
                                                    <option value="{$key2}"
                                                            {if $info.Status == $key && !empty($info.SubStatus) && $key2 == $info.SubStatus}selected{/if}>{$item2}</option>
                                                {/foreach}
                                            </select>
                                        </div>
                                    {/foreach}
                                    {literal}
                                    <script language="javascript">
                                        function setSubStatus(index) {
                                            {/literal}
                                            {foreach from=$status key=key item=item}
                                            document.getElementById('Status_{$key}').style.display = 'none';
                                            {/foreach}
                                            {literal}
                                            document.getElementById('Status_' + index).style.display = 'block';
                                            if (index == 7 || index == 9) {
                                                document.getElementById('calif').style.display = 'none';
                                                document.getElementById('div_role').style.display = 'block';
                                                document.getElementById('institutie').style.display = 'none';
                                            } else if (index == 2) {
                                                document.getElementById('calif').style.display = 'none';
                                                document.getElementById('div_role').style.display = 'block';
                                                document.getElementById('institutie').style.display = 'none';
                                            } else if (index == 10) {
                                                document.getElementById('calif').style.display = 'block';
                                                document.getElementById('institutie').style.display = 'block';
                                                document.getElementById('div_role').style.display = 'none';
                                            } else {
                                                document.getElementById('institutie').style.display = 'none';
                                                document.getElementById('calif').style.display = 'none';
                                                document.getElementById('div_role').style.display = 'block';
                                            }
                                        }
                                    </script>
                                    {/literal}
                                    <script language="javascript">setSubStatus({$info.Status|default:1});</script>
                                    <input type="hidden" id="SubStatus" name="SubStatus" value="{$info.SubStatus|default:0}">
                                </td>
                            </tr>
                        {/if}
                        <tr>
                            <td><b>{translate label='Persoana este pensionar'}:</b></td>
                            <td>
                                <input type="checkbox" {if $info.Pensionat == 1}checked="checked"{/if} id="Pensionat" name="Pensionat" value="1" />
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                {if !empty($smarty.get.PersonID)}
                                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                                {/if}
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Date identificare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Nume'}:*</b></td>
                            <td><input type="text" name="LastName" value="{$info.LastName|default:''}" size="30" maxlength="127"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Prenume'}:*</b></td>
                            <td><input type="text" name="FirstName" value="{$info.FirstName|default:''}" size="30" maxlength="127"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Sarbatoare'}:</b></td>
                            <td>
                                <select name="Sarbatoare">
                                    <option value="">- alege -</option>
                                    {foreach from=$sarbatori key=key item=item}
                                        <option value="{$key}"
                                                {if (!empty($info.Sarbatoare) && $key == $info.Sarbatoare)}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nume inainte de casatorie'}:</b></td>
                            <td><input type="text" name="FullNameBeforeMariage" value="{$info.FullNameBeforeMariage|default:''}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td width="160"><b>{translate label='Nationalitate'}:</b></td>
                            <td>
                                <select name="Nationality">
                                    {foreach from=$countries key=key item=item}
                                        <option value="{$key}"
                                                {if (!empty($info.Nationality) && $key == $info.Nationality) || (empty($info.Nationality) && $key == 181)}selected{/if}>{$item.Nationality}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data nasterii'}:</b></td>
                            <td>
                                <input type="text" name="DateOfBirth" class="formstyle"
                                       value="{if !empty($info.DateOfBirth) && $info.DateOfBirth != '0000-00-00'}{$info.DateOfBirth|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.DateOfBirth,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                                   title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td width="90"><b>{translate label='Tara nastere'}:</b></td>
                            <td>
                                <select name="BirthCountryID">
                                    {foreach from=$countries key=key item=item}
                                        <option value="{$key}"
                                                {if (!empty($info.BirthCountryID) && $key == $info.BirthCountryID) || (empty($info.BirthCountryID) && $key == 181)}selected{/if}>{$item.CountryName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Judet nastere'}:</b></td>
                            <td>
                                <select id="BirthDistrictID" name="BirthDistrictID"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=birth_city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_BirthCityID');">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$districts key=key item=item}
                                        <option value="{$key}" {if !empty($info.BirthDistrictID) && $key == $info.BirthDistrictID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Localitate nastere'}:</b></td>
                            <td>
                                <div id="div_BirthCityID">
                                    <select name="BirthCityID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$cities key=key item=item}
                                            <option value="{$key}" {if !empty($info.BirthCityID) && $key == $info.BirthCityID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                <script type="text/javascript">showInfo('ajax.php?o=birth_city&districtID={$info.BirthDistrictID}&CityID={$info.BirthCityID}&rand=' + parseInt(Math.random() * 999999999), 'div_BirthCityID');</script>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CNP'}:*</b></td>
                            <td><input type="text" name="CNP" value="{$info.CNP|default:''}" size="30" maxlength="13"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Sex'}:</b></td>
                            <td>
                                <input type="radio" name="Sex" value="M" {if $info.Sex == 'M'}checked{/if}> M
                                <input type="radio" name="Sex" value="F" {if $info.Sex == 'F'}checked{/if}> F
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CI serie/ numar'}:</b></td>
                            <td><input type="text" name="BISerie" value="{$info.BISerie|default:''}" size="2" maxlength="2"> / <input type="text" name="BINumber"
                                                                                                                                      value="{$info.BINumber|default:''}" size="8"
                                                                                                                                      maxlength="8"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CI - eliberat la data'}:</b></td>
                            <td>
                                <input type="text" name="BIStartDate" class="formstyle"
                                       value="{if !empty($info.BIStartDate) && $info.BIStartDate != '0000-00-00'}{$info.BIStartDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.BIStartDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CI - expira la data'}:</b></td>
                            <td>
                                <input type="text" name="BIStopDate" class="formstyle"
                                       value="{if !empty($info.BIStopDate) && $info.BIStopDate != '0000-00-00'}{$info.BIStopDate|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.BIStopDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CI - emis de'}:</b></td>
                            <td><input type="text" name="BIEmitent" value="{$info.BIEmitent|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Adresa de domiciliu'}</b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td width="90"><b>{translate label='Tara'}:</b></td>
                            <td>
                                <select name="Country">
                                    {foreach from=$countries key=key item=item}
                                        <option value="{$key}"
                                                {if (!empty($info.Country) && $key == $info.Country) || (empty($info.Country) && $key == 181)}selected{/if}>{$item.CountryName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Judet'}:*</b></td>
                            <td>
                                <select id="DistrictID" name="DistrictID"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID');">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$districts key=key item=item}
                                        <option value="{$key}" {if !empty($info.DistrictID) && $key == $info.DistrictID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Localitate'}:*</b></td>
                            <td>
                                <div id="div_CityID">
                                    <select name="CityID">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$cities key=key item=item}
                                            <option value="{$key}" {if !empty($info.CityID) && $key == $info.CityID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                                {if $smarty.get.o == 'new' && !empty($info.CityID)}
                                    <script type="text/javascript">showInfo('ajax.php?o=city&districtID={$info.DistrictID}&CityID={$info.CityID}&rand=' + parseInt(Math.random() * 999999999), 'div_CityID');</script>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Cod postal'}:</b></td>
                            <td>
                                <input type="text" name="StreetCode" value="{$info.StreetCode|default:''}" size="30" maxlength="16"
                                       onblurx="showInfo('ajax.php?o=street&districtID=' + document.getElementById('DistrictID').value + '&city=' + escape(document.getElementById('CityName').value) + '&code=' + escape(this.value) + '&rand=' + parseInt(Math.random()*999999999), 'StreetNameID')">
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Strada'}:</b></td>
                            <td>
                                <div id="StreetNameID"><input type="text" name="StreetName" value="{$info.StreetName|default:''}" size="30" maxlength="128"></div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nr'}:</b></td>
                            <td><input type="text" name="StreetNumber" value="{$info.StreetNumber|default:''}" size="8" maxlength="8" style="width:40px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Adresa'}:</b></td>
                            <td>
                                <b>{translate label='Bl.'}</b><input type="text" name="Bl" value="{$info.Bl|default:''}" size="5" maxlength="8" style="width:30px;">
                                <b>{translate label='Sc.'}</b><input type="text" name="Sc" value="{$info.Sc|default:''}" size="5" maxlength="8" style="width:20px;">
                                <b>{translate label='Et.'}</b><input type="text" name="Et" value="{$info.Et|default:''}" size="5" maxlength="8" style="width:20px;">
                                <b>{translate label='Ap.'}</b><input type="text" name="Ap" value="{$info.Ap|default:''}" size="5" maxlength="8" style="width:25px;">
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Telefon fix'}:</b></td>
                            <td><input type="text" name="Phone" value="{$info.Phone|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Telefon interior'}:</b></td>
                            <td><input type="text" name="PhoneInt" value="{$info.PhoneInt|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Mobil serviciu'}:</b></td>
                            <td>{$info.Mobile}

                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Mobil personal'}:</b></td>
                            <td><input type="text" name="MobilePersonal" value="{$info.MobilePersonal|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Alt numar de contact'}:</b></td>
                            <td><input type="text" name="MobileOther" value="{$info.MobileOther|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Email'}:</b></td>
                            <td><input type="text" name="Email" value="{$info.Email|default:''}" maxlength="64" size="30"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Fax'}:</b></td>
                            <td><input type="text" name="Fax" value="{$info.Fax|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Yahoo ID'}:</b></td>
                            <td><input type="text" name="Yahoo" value="{$info.Yahoo|default:''}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Skype ID'}:</b></td>
                            <td><input type="text" name="Skype" value="{$info.Skype|default:''}" size="30" maxlength="64"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                {if !empty($smarty.get.PersonID)}
                    {if $info.rw == 1 || !empty($smarty.post)}
                        <div align="center"><input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button" value="{translate label='Anuleaza'}"
                                                                                                                                onclick="window.location='./?m=persons'"
                                                                                                                                class="formstyle"></div>{/if}
                {else}
                    <div align="center"><input type="submit" value="{translate label='Adauga persoana'}" class="formstyle"> <input type="button"
                                                                                                                                   value="{translate label='Anuleaza'}"
                                                                                                                                   onclick="window.location='./?m=persons'"
                                                                                                                                   class="formstyle"></div>
                {/if}
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Observatii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b>{translate label='Stare civila'}:</b></td>
                            <td>
                                <select name="MaritalStatus">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$maritalstatus key=key item=item}
                                        <option value="{$key}" {if !empty($info.MaritalStatus) && $key == $info.MaritalStatus}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Nr. copii'}:</b></td>
                            <td>
                                <input type="text" name="NumberOfChildren" id="NumberOfChildren" value="{$info.NumberOfChildren|default:''}" size="2" maxlength="2"
                                       {if $smarty.get.o == 'edit'}onchange="if (this.value > 0) document.getElementById('div_NumberOfChildren').style.display = 'block'; else document.getElementById('div_NumberOfChildren').style.display = 'none';"{/if}>
                                {if $smarty.get.o == 'edit'}
                                    <div id="div_NumberOfChildren">
                                        <br>
                                        <table border="0" cellpadding="0" cellspacing="0" width="100%">
                                            <tr>
                                                <td>{translate label='Nume copil'}</td>
                                                <td style="padding-left: 10px;" colspan="2">{translate label='Data nasterii'}</td>
                                                <td style="padding-left: 10px;">{translate label='CNP'}</td>
                                                <td style="padding-left: 10px;" colspan="3">&nbsp;</td>
                                            </tr>
                                            {foreach from=$children item=child name=child}
                                                <tr>
                                                    <td><input type="text" id="ChildName_{$child.ChildID}" value="{$child.ChildName}" size="24" maxlength="32"></td>
                                                    <td style="padding-left: 10px;">
                                                        <input type="text" id="ChildBirthDate_{$child.ChildID}" class="formstyle"
                                                               value="{$child.ChildBirthDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$child.ChildID}">
                                                            var cal1_{$child.ChildID} = new CalendarPopup();
                                                            cal1_{$child.ChildID}.isShowNavigationDropdowns = true;
                                                            cal1_{$child.ChildID}.setYearSelectStartOffset(10);
                                                            //writeSource("js1_{$child.ChildID}");
                                                        </SCRIPT>
                                                    </td>
                                                    <td>
                                                        <A HREF="#"
                                                           onClick="cal1_{$child.ChildID}.select(document.getElementById('ChildBirthDate_{$child.ChildID}'),'anchor1_{$child.ChildID}','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_{$child.ChildID}" ID="anchor1_{$child.ChildID}"><img src="./images/cal.png" border="0"></A></td>
                                                    <td style="padding-left: 10px;"><input type="text" id="ChildCNP_{$child.ChildID}" value="{$child.ChildCNP}" size="13"
                                                                                           maxlength="13"></td>
                                                    <td style="padding-left: 10px;">
                                                        {if $info.rw == 1}
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (document.getElementById('ChildName_{$child.ChildID}').value && document.getElementById('ChildBirthDate_{$child.ChildID}').value && checkDate(document.getElementById('ChildBirthDate_{$child.ChildID}').value, 'Data nasterii copil') && (document.getElementById('ChildCNP_{$child.ChildID}').value == '' || (document.getElementById('ChildCNP_{$child.ChildID}').value && check_cnp(document.getElementById('ChildCNP_{$child.ChildID}').value)))) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_child&ChildID={$child.ChildID}&ChildName=' + escape(document.getElementById('ChildName_{$child.ChildID}').value) + '&ChildBirthDate=' + document.getElementById('ChildBirthDate_{$child.ChildID}').value + '&ChildCNP=' + escape(document.getElementById('ChildCNP_{$child.ChildID}').value); else alert('{translate label='Completati Numele, Data nasterii si CNP-ul corect ale copilului!'}'); return false;"
                                                                                    title="{translate label='Editeaza copil'}"><b>Mod</b></a></div>
                                                        {else}
                                                            &nbsp;
                                                        {/if}                                </td>
                                                    <td style="padding-left: 2px;">
                                                        {if $info.rw == 1}
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest copil?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_child&ChildID={$child.ChildID}'; return false;"
                                                                                    title="{translate label='Sterge copil'}"><b>Del</b></a></div>
                                                        {else}
                                                            &nbsp;
                                                        {/if}                                </td>
                                                    <td>&nbsp;</td>
                                                </tr>
                                            {/foreach}
                                            <tr>
                                                <td><input type="text" id="ChildName_0" value="" size="24" maxlength="32"></td>
                                                <td style="padding-left: 10px;">
                                                    <input type="text" id="ChildBirthDate_0" class="formstyle" value="" size="10" maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                        var cal1_0 = new CalendarPopup();
                                                        cal1_0.isShowNavigationDropdowns = true;
                                                        cal1_0.setYearSelectStartOffset(10);
                                                        //writeSource("js1_0");
                                                    </SCRIPT>
                                                </td>
                                                <td>
                                                    <A HREF="#" onClick="cal1_0.select(document.getElementById('ChildBirthDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"
                                                       NAME="anchor1_0" ID="anchor1_0"><img src="./images/cal.png" border="0"></A></td>
                                                <td style="padding-left: 10px;"><input type="text" id="ChildCNP_0" value="" size="13" maxlength="13"></td>
                                                <td style="padding-left: 10px;" colspan="2">
                                                    {if $info.rw == 1}
                                                        <div id="button_add"><a href="#"
                                                                                onclick="if ({$smarty.foreach.child.total} < document.pers.NumberOfChildren.value) {literal}{{/literal} if (document.getElementById('ChildName_0').value && document.getElementById('ChildBirthDate_0').value && checkDate(document.getElementById('ChildBirthDate_0').value, 'Data nasterii copil') && (document.getElementById('ChildCNP_0').value == '' | (document.getElementById('ChildCNP_0').value && check_cnp(document.getElementById('ChildCNP_0').value)))) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_child&ChildName=' + escape(document.getElementById('ChildName_0').value) + '&ChildBirthDate=' + document.getElementById('ChildBirthDate_0').value + '&ChildCNP=' + escape(document.getElementById('ChildCNP_0').value) + '&NumberOfChildren=' + document.getElementById('NumberOfChildren').value; else alert('{translate label='Completati Numele, Data nasterii si CNP-ul corect ale copilului!'}'); {literal}}{/literal} else alert('{translate label='Nu mai puteti adauga copii!'}'); return false;"
                                                                                title="{translate label='Adauga copil'}"><b>Add</b></a></div>
                                                    {else}
                                                        &nbsp;
                                                    {/if}                                </td>
                                                <td>&nbsp;</td>
                                            </tr>
                                        </table>
                                        <br>
                                    </div>
                                    <script language="javascript">if (document.pers.NumberOfChildren.value > 0) document.getElementById('div_NumberOfChildren').style.display = 'block'; else document.getElementById('div_NumberOfChildren').style.display = 'none';</script>
                                {/if}                    </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Certificat casatorie'}:</b></td>
                            <td>
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume Prenume sot / sotie'}</td>
                                        <td style="padding-left: 4px;">{translate label='CNP sot / sotie'}</td>
                                        <td style="padding-left: 4px;" colspan="2">{translate label='Data'}</td>
{*                                        <td style="padding-left: 4px;">{translate label='Serie'}</td>*}
                                        <td style="padding-left: 4px;">{translate label='Numar'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$cc item=item}
                                        <tr>
                                            <td><input type="text" id="CC_Nume_{$item.CCID}" value="{$item.Nume}" size="24" maxlength="32"></td>
                                            <td style="padding-left: 4px;"><input type="text" id="CC_CNP_{$item.CCID}" value="{$item.CNP}" size="15" maxlength="13"></td>
                                            <td style="padding-left: 4px;">
                                                <input type="text" id="CC_Data_{$item.CCID}" value="{$item.Data|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_cc_{$item.CCID}">
                                                    var cal1_cc_{$item.CCID} = new CalendarPopup();
                                                    cal1_cc_{$item.CCID}.isShowNavigationDropdowns = true;
                                                    cal1_cc_{$item.CCID}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_cc_{$item.CCID}");
                                                </SCRIPT>
                                            </td>
                                            <td><A HREF="#"
                                                   onClick="cal1_cc_{$item.CCID}.select(document.getElementById('CC_Data_{$item.CCID}'),'anchor1_cc_{$item.CCID}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_cc_{$item.CCID}" ID="anchor1_cc_{$item.CCID}"><img src="./images/cal.png" border="0"></A></td>
{*                                            <td style="padding-left: 4px;"><input type="text" id="CC_Serie_{$item.CCID}" value="{$item.Serie}" size="6" maxlength="16"></td>*}
                                            <td style="padding-left: 4px;"><input type="text" id="CC_Nr_{$item.CCID}" value="{$item.Nr}" size="6" maxlength="16"></td>
                                            {if $info.rw == 1}
                                                <td style="padding-left: 10px;" colspan="2">
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CC_Nume_{$item.CCID}').value && document.getElementById('CC_CNP_{$item.CCID}').value && checkDate(document.getElementById('CC_Data_{$item.CCID}').value, 'Data') && document.getElementById('CC_Nr_{$item.CCID}').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_cc&CCID={$item.CCID}&Nume=' + escape(document.getElementById('CC_Nume_{$item.CCID}').value) + '&CNP=' + document.getElementById('CC_CNP_{$item.CCID}').value + '&Data=' + document.getElementById('CC_Data_{$item.CCID}').value + '&Nr=' + document.getElementById('CC_Nr_{$item.CCID}').value; else alert('{translate label='Completati Nume sot / sotie, CNP, Data, Numar!'}'); return false;"
                                                                            title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta inregistrare?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_cc&CCID={$item.CCID}'; return false;"
                                                                            title="{translate label='Sterge'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}                            </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="CC_Nume_0" size="24" maxlength="32"></td>
                                        <td style="padding-left: 4px;"><input type="text" id="CC_CNP_0" size="15" maxlength="13"></td>
                                        <td style="padding-left: 4px;">
                                            <input type="text" id="CC_Data_0" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cc_0">
                                                var cal1_cc_0 = new CalendarPopup();
                                                cal1_cc_0.isShowNavigationDropdowns = true;
                                                cal1_cc_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_cc_0");
                                            </SCRIPT>
                                        </td>
                                        <td><A HREF="#" onClick="cal1_cc_0.select(document.getElementById('CC_Data_0'),'anchor1_cc_0','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_cc_0" ID="anchor1_cc_0"><img src="./images/cal.png" border="0"></A></td>
{*                                        <td style="padding-left: 4px;"><input type="text" id="CC_Serie_0" size="6" maxlength="16"></td>*}
                                        <td style="padding-left: 4px;"><input type="text" id="CC_Nr_0" size="6" maxlength="16"></td>
                                        <td style="padding-left: 10px;" colspan="2">
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CC_Nume_0').value && document.getElementById('CC_CNP_0').value && checkDate(document.getElementById('CC_Data_0').value, 'Data') && document.getElementById('CC_Nr_0').value) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_cc&Nume=' + escape(document.getElementById('CC_Nume_0').value) + '&CNP=' + document.getElementById('CC_CNP_0').value + '&Data=' + document.getElementById('CC_Data_0').value + '&Nr=' + document.getElementById('CC_Nr_0').value; else alert('{translate label='Completati Nume sot / sotie, CNP, Data, Numar!'}'); return false;"
                                                                        title="{translate label='Adauga'}"><b>Add</b></a></div>
                                            {else}
                                                &nbsp;
                                            {/if}                                </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Religie'}:</b></td>
                            <td>
                                <select name="Religion">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$religion key=key item=item}
                                        <option value="{$key}" {if !empty($info.Religion) && $key == $info.Religion}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Observatii'}<br>{translate label='stare civila'}:</b></td>
                            <td><textarea name="MaritalStatusNotes" rows="2" cols="62">{$info.MaritalStatusNotes}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Alte observatii'}:</b></td>
                            <td><textarea name="Notes" rows="2" cols="62">{$info.Notes}</textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="120"><b>{translate label='Foto'}:</b></td>
                                        <td><input type="file" name="photo"></td>
                                        <td rowspan="4" align="center">{if isset($info.photo)}<a href="{$info.photoBig}" title="{translate label='mareste poza'}" target="_blank">
                                                <img style="padding:2px; margin-left:10px; border:solid 1px #666;" src="{$info.photo}" width="100"></a>
                                                <br/>
                                                <a href="#"
                                                   onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta imagine?'}')) window.location.href='./?m=persons&o=del_photo&PersonID={$smarty.get.PersonID}'; return false;"
                                                   title="{translate label='Sterge'} class=" blue
                                                ">{translate label='sterge'}</a>{/if}
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        {if !empty($customfields.CustomPerson1)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson1}:</b></td>
                                <td><input type="text" name="CustomPerson1" value="{$info.CustomPerson1|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomPerson2)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson2}:</b></td>
                                <td><input type="text" name="CustomPerson2" value="{$info.CustomPerson2|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomPerson3)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson3}:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson3" name="CustomPerson3" class="formstyle"
                                           value="{if !empty($info.CustomPerson3) && $info.CustomPerson3 != '0000-00-00'}{$info.CustomPerson3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson3">
                                        var cal_CustomPerson3 = new CalendarPopup();
                                        cal_CustomPerson3.isShowNavigationDropdowns = true;
                                        cal_CustomPerson3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomPerson3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson3.select(document.getElementById('CustomPerson3'),'anchor_CustomPerson3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson3" ID="anchor_CustomPerson3"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomPerson4)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson4}:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson4" name="CustomPerson4" class="formstyle"
                                           value="{if !empty($info.CustomPerson4) && $info.CustomPerson4 != '0000-00-00'}{$info.CustomPerson4|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson4">
                                        var cal_CustomPerson4 = new CalendarPopup();
                                        cal_CustomPerson4.isShowNavigationDropdowns = true;
                                        cal_CustomPerson4.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomPerson4");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson4.select(document.getElementById('CustomPerson4'),'anchor_CustomPerson4','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson4" ID="anchor_CustomPerson4"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomPerson5)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson5}:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson5" name="CustomPerson5" class="formstyle"
                                           value="{if !empty($info.CustomPerson5) && $info.CustomPerson5 != '0000-00-00 00:00:00'}{$info.CustomPerson5|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson5">
                                        var cal_CustomPerson5 = new CalendarPopup();
                                        cal_CustomPerson5.isShowNavigationDropdowns = true;
                                        cal_CustomPerson5.setYearSelectStartOffset(10);
                                        writeSource("js_CustomPerson5");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson5.select(document.getElementById('CustomPerson5'),'anchor_CustomPerson5','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson5" ID="anchor_CustomPerson5"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomPerson6)}
                            <tr>
                                <td><b>{translate label=$customfields.CustomPerson6}:</b></td>
                                <td>
                                    <input type="text" id="CustomPerson6" name="CustomPerson6" class="formstyle"
                                           value="{if !empty($info.CustomPerson6) && $info.CustomPerson6 != '0000-00-00 00:00:00'}{$info.CustomPerson6|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomPerson6">
                                        var cal_CustomPerson6 = new CalendarPopup();
                                        cal_CustomPerson6.isShowNavigationDropdowns = true;
                                        cal_CustomPerson6.setYearSelectStartOffset(10);
                                        writeSource("js_CustomPerson6");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomPerson6.select(document.getElementById('CustomPerson6'),'anchor_CustomPerson6','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomPerson6" ID="anchor_CustomPerson6"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Sursa CV [valabil pentru candidati]'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b>{translate label='Sursa CV'}:</b></td>
                            <td>
                                <select name="CVSource" onchange="document.getElementById('CVSourceRecc').style.display = this.value == 'recomandare' ? '' : 'none';">
                                    <option value="">{translate label='alege sursa'}</option>
                                    {foreach from=$cvsource key=key item=item}
                                        <option value="{$key}" {if $key==$info.CVSource}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <select id="CVSourceRecc" name="CVSourceRecc">
                                    <option value="0">{translate label='alege persoana care recomanda'}</option>
                                    {foreach from=$employees key=key item=item}
                                        <option value="{$key}" {if $info.CVSourceRecc == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <script type="text/javascript">
                                    {if $info.CVSource != 'recomandare'}
                                    document.getElementById('CVSourceRecc').style.display = 'none';
                                    {/if}
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Detalii'}:</b></td>
                            <td><textarea name="CVSourceDetails" rows="2" cols="62">{$info.CVSourceDetails|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <table border="0" cellpadding="0" cellspacing="0">
                                    <tr>
                                        <td width="120"><b>CV:</b></td>
                                        <td><input type="file" name="cvfile"></td>
                                        <td rowspan="4" align="center">
                                            {if isset($info.CVFileName)}
                                                <a href="{$info.CVFileName}" title="{$info.CVFileName}" target="_blank">
                                                    &nbsp;&nbsp;&nbsp;<img src="images/document_view.png" width="32" height="32" alt="Vizualizeaza document" /> Vizualizare CV
                                                </a>
                                                <br />
                                                <a href="#" onclick="if (confirm('Sunteti sigur ca doriti stergerea documentului?')) window.location.href='./?m=persons&o=del_person_cv&PersonID={$smarty.get.PersonID}'; return false;"
                                                   title="{translate label='Sterge'} class=" blue">
                                                    <img src="images/document_delete.png" width="32" height="32" alt="Sterge document" /> Stergere CV
                                                </a>
                                            {/if}
                                       </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Parinti'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b>{translate label='Nume/ Prenume tata'}:</b></td>
                            <td><input type="text" name="FatherLastName" value="{$info.FatherLastName|default:''}" size="30" maxlength="32"> / <input type="text"
                                                                                                                                                      name="FatherFirstName"
                                                                                                                                                      value="{$info.FatherFirstName|default:''}"
                                                                                                                                                      size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nume/ Prenume mama'}:</b></td>
                            <td><input type="text" name="MotherLastName" value="{$info.MotherLastName|default:''}" size="30" maxlength="32"> / <input type="text"
                                                                                                                                                      name="MotherFirstName"
                                                                                                                                                      value="{$info.MotherFirstName|default:''}"
                                                                                                                                                      size="30" maxlength="32"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Persoana de contact'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b>{translate label='Nume si prenume'}:</b></td>
                            <td><input type="text" name="CPFullName" value="{$info.CPFullName|default:''}" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Adresa este aceeasi cu a salariatului'}:</b></td>
                            <td><input type="checkbox" name="CPSameAddress" {if ($info.CPSameAddress == 1)}checked="checked"{/if} value="yes"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Sau completeaza alta adresa'}:</b></td>
                            <td><textarea name="CPAddress" rows="2" cols="62">{$info.CPAddress|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Telefon'}:</b></td>
                            <td><input type="text" name="CPPhone" value="{$info.CPPhone|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Mobil'}:</b></td>
                            <td><input type="text" name="CPMobile" value="{$info.CPMobile|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Email'}:</b></td>
                            <td><input type="text" name="CPEmail" value="{$info.CPEmail|default:''}" size="30" maxlength="64"></td>
                        </tr>
                    </table>
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
    function validateForm(f) {
        return (is_empty(f.DateOfBirth.value) ? true : checkDate(f.DateOfBirth.value, 'Data nasterii')) &&
            (is_empty(f.BIStartDate.value) ? true : checkDate(f.BIStartDate.value, 'BI - eliberat la data')) &&
            (is_empty(f.BIStopDate.value) ? true : checkDate(f.BIStopDate.value, 'BI - expira la data'))
                {/literal}{if !empty($customfields.CustomPerson3)} && (is_empty(f.CustomPerson3.value) ? true : checkDate(f.CustomPerson3.value, '{$customfields.CustomPerson3}')){/if}{literal}
            ;
    }
</script>
{/literal}
