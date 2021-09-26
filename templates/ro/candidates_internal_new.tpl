{include file="candidates_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.get.PersonID)}
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
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
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele persoanei au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
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
                                            <select name="Status">
                                                {foreach from=$status key=key item=item}
                                                    <option value="{$key}" {if !empty($info.Status) && $key == $info.Status}selected{/if}>{$item}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <div id="calif">
                                    <b>{translate label='Calificativ'}:</b>
                                    <select name="Qualify" style="margin-left: 95px">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$qualify key=key item=item}
                                            <option value="{$key}" {if $key==$info.Qualify}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Status CV'}:</b></td>
                            <td>
                                <select name="CVStatus">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$cvstatus key=key item=item}
                                        <option value="{$key}"
                                                {if (!empty($info.CVStatus) && $info.CVStatus!=0 && $key == $info.CVStatus) || (!empty($info.SubStatus) && $key == $info.SubStatus) }selected{/if}>{$item}</option>{/foreach}
                                </select>
                            </td>
                        </tr>
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
                            <td><input type="text" name="LastName" value="{$info.LastName|default:''}" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Prenume'}:*</b></td>
                            <td><input type="text" name="FirstName" value="{$info.FirstName|default:''}" size="30" maxlength="32"></td>
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
                                   title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CNP'}:</b></td>
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
                                            src="./images/cal.png" border="0" alt="selecteaza data"></A>
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
                                            src="./images/cal.png" border="0" alt="selecteaza data"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='CI - emis de'}:</b></td>
                            <td><input type="text" name="BIEmitent" value="{$info.BIEmitent|default:''}" size="30" maxlength="32"></td>
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
                            <td><b>{translate label='Mobil'}:</b></td>
                            <td><input type="text" name="Mobile" value="{$info.Mobile|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Fax'}:</b></td>
                            <td><input type="text" name="Fax" value="{$info.Fax|default:''}" size="16" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Email'}:</b></td>
                            <td><input type="text" name="Email" value="{$info.Email|default:''}" size="30" maxlength="64"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                {if !empty($smarty.get.PersonID)}
                    {if $info.rw == 1 || !empty($smarty.post)}
                        <div align="center"><input type="submit" value="{translate label='Salveaza'}" class="formstyle"> <input type="button" value="{translate label='Anuleaza'}"
                                                                                                                                onclick="window.location='./?m=candidates'"
                                                                                                                                class="formstyle"></div>{/if}
                {else}
                    <div align="center"><input type="submit" value="{translate label='Adauga persoana'}" class="formstyle"> <input type="button"
                                                                                                                                   value="{translate label='Anuleaza'}"
                                                                                                                                   onclick="window.location='./?m=candidates'"
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
                                                    <td><input type="text" id="ChildName_{$child.ChildID}" value="{$child.ChildName}" size="15" maxlength="32"></td>
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
                                                <td><input type="text" id="ChildName_0" value="" size="15" maxlength="32"></td>
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
                        {if !empty($smarty.get.PersonID)}
                            <tr>
                                <td colspan="2">
                                    <table border="0" cellpadding="0" cellspacing="0">
                                        <tr>
                                            <td width="120"><b>{translate label='Foto'}:</b></td>
                                            <td><input type="file" name="photo"></td>
                                            <td rowspan="4" align="center">{if isset($info.photo)}<a href="{$info.photoBig}" title="{translate label='mareste poza'}"
                                                                                                     target="_blank"><img
                                                            style="padding:2px; margin-left:10px; border:solid 1px #666;" src="{$info.photo}"></a>
                                                    <br/>
                                                    <a href="#"
                                                       onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta imagine?'}')) window.location.href='./?m=candidates&o=del_photo&PersonID={$smarty.get.PersonID}'; return false;"
                                                       title="{translate label='Sterge'} class=" blue
                                                    ">{translate label='sterge'}</a>{/if}
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Sursa CV'}</legend>
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
                        {if ($smarty.get.o!="new")}
                            <tr>
                                <td><b>{translate label='Post'}:</b></td>
                                <td>{$info.Post_1}</td>
                            </tr>
                        {/if}
                        <tr>
                            <td><b>{translate label='Post actual'}:</b></td>
                            <td>
                                <select name="PostId2">
                                    <option value="0">Selectati postul actual</option>
                                    {foreach from=$Posts key=key item=item}
                                        <option value="{$item.PostId}" {if ($item.PostId==$info.PostId2)}selected="selected"{/if}>{$item.PostName}</option>
                                    {/foreach}
                                </select>
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
                            <td><b>{translate label='Adresa'}:</b></td>
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
