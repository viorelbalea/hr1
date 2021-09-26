{include file="job_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="job" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        {if !empty($smarty.get.JobID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="job_submenu.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare concurs'}</span></td>
            </tr>
        {*{/if}*}
        {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele concursului au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
    </table>
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding: 10px; width: 50%">
                <fieldset>
                    <legend>{translate label='Date concurs'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr valign="top">
                            <td><b>{translate label='Denumire concurs:'}*</b></td>
                            <td>
                                <div class="autocomplete yui-ac">
                                    <input autocomplete="off" type="text" id="JobTitle" name="JobTitle" value="{$info.JobTitle|default:''}" class="yui-ac-input" maxlength="255">
                                    <div class="yui-ac-container" id="JobTitleContainer">
                                        <div style="display: none;" class="yui-ac-content">
                                            <div style="display: none;" class="yui-ac-hd"></div>
                                            <div class="yui-ac-bd">
                                                <ul>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                    <li style="display: none;"></li>
                                                </ul>
                                            </div>
                                            <div style="display: none;" class="yui-ac-ft"></div>
                                        </div>
                                    </div>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Functie interna'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="InternalFunction">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$internal_functions item=item}
                                        {foreach from=$item key=key2 item=item2 name=iter2}
                                            {if $smarty.foreach.iter2.first}<optgroup label="{$item2.GroupName}">{/if}
                                            <option value="{$key2}" {if $key2==$info.InternalFunction}selected{/if}>{$item2.Function} [{$item2.GroupName} | {$item2.Grad}]</option>
                                            {if $smarty.foreach.iter2.last}</optgroup>{/if}
                                        {/foreach}
                                    {/foreach}
                                </select>
                        </tr>
                        <tr>
                            <td><b>Functie:</b></td>
                            <td>
                                <select name="FunctionIDRecr">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$functions_recr key=key item=item}
                                        <option value="{$key}" {if !empty($info.FunctionIDRecr) && $key == $info.FunctionIDRecr}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Functie COR:</b></td>
                            <td>
                                <select name="FunctionID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$functions key=key item=item}
                                        <option value="{$key}" {if !empty($info.FunctionID) && $key == $info.FunctionID}selected{/if}>{$item.Function} - {$item.COR}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Descriere'}:*</b></td>
                            <td><textarea name="JobDescription" style="width: 100%; height: 100px;">{$info.JobDescription|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Responsabilitati principale'}:</b></td>
                            <td><textarea name="KeyResponsibilities" style="width: 100%; height: 100px;">{$info.KeyResponsibilities|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nota de fundamentare'}:</b></td>
                            <td><textarea name="RelevantQualifications" style="width: 100%; height: 100px;">{$info.RelevantQualifications|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Referat scoatere la concurs'}:</b></td>
                            <td><textarea name="Benefits" style="width: 100%; height: 100px;">{$info.Benefits|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Text anunt recrutare'}:</b></td>
                            <td><textarea name="RecruitmentAdText" style="width: 100%; height: 100px;">{$info.RecruitmentAdText|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Mesaj automat email'}:</b></td>
                            <td><textarea name="AutomaticMessageEmail" style="width: 100%; height: 100px;">{$info.AutomaticMessageEmail|default:''}</textarea></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding: 10px; width: 50%">
                <fieldset>
                    <legend>{translate label='Date recrutare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Numar pozitii'}:*</b></td>
                            <td><input type="text" name="PositionNo" value="{$info.PositionNo|default:1}" size="2" maxlength="2"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Domeniu'}:*</b></td>
                            <td>
                                <select name="JobDomainID" class="dropdown">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$jobdomains key=key item=item}
                                        <option value="{$key}" {if !empty($info.JobDomainID) && $key == $info.JobDomainID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="Domain" value="">
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Companie'}:*</b></td>
                            <td>
                                <select name="CompanyID">
                                    {*<option value="0">{translate label='alege...'}</option>*}
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}" {if !empty($info.CompanyID) && $key == $info.CompanyID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Experienta ceruta'}:*</b></td>
                            <td>
                                <select name="RequiredExperience">
                                    {foreach from=$experiences key=key item=item}
                                        <option value="{$key}" {if !empty($info.RequiredExperience) && $key == $info.RequiredExperience}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip concurs'}:*</b></td>
                            <td>
                                <select name="JobType">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$jobtypes key=key item=item}
                                        <option value="{$key}" {if !empty($info.JobType) && $key == $info.JobType}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Organigrama'}</b></td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nivel 1'}:</b></td>
                            <td>
                                <select name="DivisionID" onchange="showInfo('ajax.php?o=department&DivisionID=' + this.value, 'DepartmentID');" class="dropdown">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$divisions key=key item=item}
                                        <option value="{$key}" {if !empty($info.DivisionID) && $key == $info.DivisionID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nivel 2'}:</b></td>
                            <td>
                                <div id="DepartmentID">
                                    <select name="DepartmentID" onchange="showInfo('ajax.php?o=subdepartment&DepartmentID=' + this.value, 'SubDepartmentID');" class="dropdown">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$departments key=key item=item}
                                            <option value="{$key}" {if !empty($info.DepartmentID) && $key == $info.DepartmentID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nivel 3'}:</b></td>
                            <td>
                                <div id="SubDepartmentID">
                                    <select name="SubDepartmentID" onchange="showInfo('ajax.php?o=subsubdepartment&SubDepartmentID=' + this.value, 'SubSubDepartmentID');"
                                            class="dropdown">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$subdepartments key=key item=item}
                                            <option value="{$key}" {if !empty($info.SubDepartmentID) && $key == $info.SubDepartmentID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <!--<tr>
                    <td><b>{translate label='Centru cost'}:</b></td>
                    <td>
                        <select name="CostCenterID" class="dropdown">
                            <option value="0">{translate label='alege...'}</option>
                            {foreach from=$costcenter key=key item=item}
                            <option value="{$key}" {if !empty($info.CostCenterID) && $key == $info.CostCenterID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                </tr>-->
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Date profesionale'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Titulatura postului'}:*</b></td>
                            <td>
                                <select name="ProfJobDictionaryID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$jobs key=key item=item}
                                        <option value="{$key}"
                                                {if !empty($info.ProfJobDictionaryID) && $key == $info.ProfJobDictionaryID}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Nivelul de instruire'}:</b></td>
                            <td>
                                <select name="EducationalLevel">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$educational_levels key=key item=item}
                                        <optgroup label="{translate label=$key}">
                                            {foreach from=$item key=key2 item=item2}
                                                {if is_array($item2)}
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{translate label=$key2}">
                                                        {foreach from=$item2 key=key3 item=item3}
                                                            <option value="{$key3}"
                                                                    {if !empty($info.EducationalLevel) && $key3 == $info.EducationalLevel}selected{/if}>{translate label=$item3}</option>
                                                        {/foreach}
                                                    </optgroup>
                                                {else}
                                                    <option value="{$key2}"
                                                            {if !empty($info.EducationalLevel) && $key2 == $info.EducationalLevel}selected{/if}>{translate label=$item2}</option>
                                                {/if}
                                            {/foreach}
                                        </optgroup>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Pregatire'}:*</b></td>
                            <td>
                                <select name="Studies">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$studies key=key item=item}
                                        <option value="{$key}" {if !empty($info.Studies) && $key == $info.Studies}selected{/if}>{translate label=$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Permis auto'}:</b></td>
                            <td>
                                <select name="DrivingLicense"
                                        {literal}onchange="if (this.value == 'Nu') {document.getElementById('DC_A').disabled = true; document.getElementById('DC_B').disabled = true; document.getElementById('DC_C').disabled = true; document.getElementById('DC_D').disabled = true; document.getElementById('DC_E').disabled = true;} else {document.getElementById('DC_A').disabled = false; document.getElementById('DC_B').disabled = false; document.getElementById('DC_C').disabled = false; document.getElementById('DC_D').disabled = false; document.getElementById('DC_E').disabled = false;}"{/literal}>
                                    <option value="">{translate label='alege...'}</option>
                                    <option value="Nu" {if !empty($info.DrivingLicense) && $info.DrivingLicense == 'Nu'}selected{/if}>{translate label='Nu'}</option>
                                    <option value="Da" {if !empty($info.DrivingLicense) && $info.DrivingLicense == 'Da'}selected{/if}>{translate label='Da'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Permis categorie'}:</b></td>
                            <td>
                                <input type="checkbox" id="DC_A" name="DrivingCategory[A]" value="A"
                                       {if (is_array($info.DrivingCategory) && isset($info.DrivingCategory.A)) || (!is_array($info.DrivingCategory) && strstr($info.DrivingCategory,'A'))}checked{/if} />
                                A&nbsp;&nbsp;
                                <input type="checkbox" id="DC_B" name="DrivingCategory[B]" value="B"
                                       {if (is_array($info.DrivingCategory) && isset($info.DrivingCategory.B)) || (!is_array($info.DrivingCategory) && strstr($info.DrivingCategory,'B'))}checked{/if}>
                                B&nbsp;&nbsp;
                                <input type="checkbox" id="DC_C" name="DrivingCategory[C]" value="C"
                                       {if (is_array($info.DrivingCategory) && isset($info.DrivingCategory.C)) || (!is_array($info.DrivingCategory) && strstr($info.DrivingCategory,'C'))}checked{/if}>
                                C&nbsp;&nbsp;
                                <input type="checkbox" id="DC_D" name="DrivingCategory[D]" value="D"
                                       {if (is_array($info.DrivingCategory) && isset($info.DrivingCategory.D)) || (!is_array($info.DrivingCategory) && strstr($info.DrivingCategory,'D'))}checked{/if}>
                                D&nbsp;&nbsp;
                                <input type="checkbox" id="DC_E" name="DrivingCategory[E]" value="E"
                                       {if (is_array($info.DrivingCategory) && isset($info.DrivingCategory.E)) || (!is_array($info.DrivingCategory) && strstr($info.DrivingCategory,'E'))}checked{/if}>
                                E
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Limbii straine'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>{translate label='Limba straina'}</td>
                            <td>{translate label='Citit'}</td>
                            <td>{translate label='Scris'}</td>
                            <td>{translate label='Vorbit'}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        {foreach from=$lang key=key item=item}
                            <tr>
                                <td><select id="Lang_{$key}" name="Lang">
                                        <option value="0">{translate label='alege limba'}</option>{foreach from=$languages key=key2 item=item2}
                                        <option value="{$key2}" {if $key2==$item.Lang}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                <td><select id="ReadLevel_{$key}" name="ReadLevel">
                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                        <option value="{$key2}" {if $key2==$item.ReadLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                <td><select id="WriteLevel_{$key}" name="WriteLevel">
                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                        <option value="{$key2}" {if $key2==$item.WriteLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                <td><select id="SpeakLevel_{$key}" name="SpeakLevel">
                                        <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key2 item=item2}
                                        <option value="{$key2}" {if $key2==$item.SpeakLevel}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                {if $info.rw==1}
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('Lang_{$key}').selectedIndex>0 && document.getElementById('ReadLevel_{$key}').selectedIndex>0 && document.getElementById('WriteLevel_{$key}').selectedIndex>0 && document.getElementById('SpeakLevel_{$key}').selectedIndex>0) window.location.href = './?m=jobs&o=edit&JobID={$smarty.get.JobID}&action=edit&LangID={$key}&Lang=' + document.getElementById('Lang_{$key}').value + '&ReadLevel=' + document.getElementById('ReadLevel_{$key}').value + '&WriteLevel=' + document.getElementById('WriteLevel_{$key}').value + '&SpeakLevel=' + document.getElementById('SpeakLevel_{$key}').value; else alert('{translate label='Alegeti Limba, nivelul pentru citit, scris si vorbit!'}'); return false;"
                                                                title="{translate label='Modifica limba straina'}"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=jobs&o=edit&JobID={$smarty.get.JobID}&action=del&LangID={$key}'; return false;"
                                                                title="{translate label='Sterge limba straina'}"><b>Del</b></a></div>
                                    </td>
                                {else}
                                    <td colspan="2">&nbsp;</td>
                                {/if}
                            </tr>
                        {/foreach}
                        <tr>
                            <td><select id="Lang_0" name="Lang">
                                    <option value="0">{translate label='alege limba'}</option>{foreach from=$languages key=key item=item}
                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                            <td><select id="ReadLevel_0" name="ReadLevel">
                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                            <td><select id="WriteLevel_0" name="WriteLevel">
                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                            <td><select id="SpeakLevel_0" name="SpeakLevel">
                                    <option value="0">{translate label='alege'}</option>{foreach from=$lang_level key=key item=item}
                                    <option value="{$key}">{$item}</option>{/foreach}</select></td>
                            <td>{if $info.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('Lang_0').selectedIndex>0 && document.getElementById('ReadLevel_0').selectedIndex>0 && document.getElementById('WriteLevel_0').selectedIndex>0 && document.getElementById('SpeakLevel_0').selectedIndex>0) window.location.href = './?m=jobs&o=edit&JobID={$smarty.get.JobID}&action=add&Lang=' + document.getElementById('Lang_0').value + '&ReadLevel=' + document.getElementById('ReadLevel_0').value + '&WriteLevel=' + document.getElementById('WriteLevel_0').value + '&SpeakLevel=' + document.getElementById('SpeakLevel_0').value; else alert('{translate label='Alegeti Limba, nivelul pentru citit, scris si vorbit!'}'); return false;"
                                                            title="{translate label='Adauga limba straina'}"><b>Add</b></a></div>{/if}</td>
                            <td></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend>{translate label='Observatii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Data incepere depunere dosare'}*:</b></td>
                            <td>
                                <input type="text" name="StartDate" class="formstyle" value="{$info.StartDate|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.job.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data incheiere depunere dosare '}*:</b></td>
                            <td>
                                <input type="text" name="StopDate" class="formstyle" value="{$info.StopDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.job.StopDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>&nbsp;
                            </td>
                        </tr>
                        <tr>
                            <td><b>Observatii:</b></td>
                            <td><textarea name="Notes" rows="8" cols="45">{$info.Notes}</textarea></td>
                        </tr>
                        {if !empty($customfields.CustomJob1)}
                            <tr>
                                <td><b>{$customfields.CustomJob1}:</b></td>
                                <td><input type="text" name="CustomJob1" value="{$info.CustomJob1|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomJob2)}
                            <tr>
                                <td><b>{$customfields.CustomJob2}:</b></td>
                                <td><input type="text" name="CustomJob2" value="{$info.CustomJob2|default:''}" size="30" maxlength="255"></td>
                            </tr>
                        {/if}
                        {if !empty($customfields.CustomJob3)}
                            <tr>
                                <td><b>{$customfields.CustomJob3}:</b></td>
                                <td>
                                    <input type="text" id="CustomJob3" name="CustomJob3" class="formstyle"
                                           value="{if !empty($info.CustomJob3) && $info.CustomJob3 != '0000-00-00 00:00:00'}{$info.CustomJob3|date_format:"%d.%m.%Y"}{/if}"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomJob3">
                                        var cal_CustomJob3 = new CalendarPopup();
                                        cal_CustomJob3.isShowNavigationDropdowns = true;
                                        cal_CustomJob3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomJob3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomJob3.select(document.getElementById('CustomJob3'),'anchor_CustomJob3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomJob3" ID="anchor_CustomJob3"><img src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
                <br>
                {if !empty($smarty.get.JobID)}
                    <div align="center">{if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}"
                                                                                         class="formstyle">&nbsp;&nbsp;{/if}{if $info.rw == 1}<input type="button"
                                                                                                                                                     value="{translate label='Salveaza ca concurs nou'}"
                                                                                                                                                     class="formstyle"
                                                                                                                                                     onclick="window.location.href = './?m=jobs&o=save_as_new&JobID={$smarty.get.JobID}'">{/if}
                        &nbsp;&nbsp;<input type="button" value="{translate label='Anuleaza'}" onclick="window.location='./?m=jobs'" class="formstyle"></div>
                {else}
                    <div align="center"><input type="submit" value="Adauga concurs" class="formstyle"> <input type="button" value="{translate label='Anuleaza'}"
                                                                                                              onclick="window.location='./?m=jobs'" class="formstyle"></div>
                {/if}
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
        return {/literal}checkDate(f.StartDate.value, '{translate label='Data de inceput este obligatorie'}'){literal} &&
                {/literal}checkDate(f.StopDate.value, '{translate label='Valabil pana la este obligatoriu'}'){literal}
                {/literal}{if !empty($customfields.CustomJob3)} && (is_empty(f.CustomJob3.value) ? true : checkDate(f.CustomJob3.value, '{$customfields.CustomJob3}')){/if}{literal}
            ;
    }

    YAHOO.example.ACFlatData = new function () {
        // Define a custom formatter function
        this.fnCustomFormatter = function (oResultItem, sQuery) {
            var sKey = oResultItem[0];
            var nQuantity = oResultItem[1];
            var sKeyQuery = sKey.substr(0, sQuery.length);
            var sKeyRemainder = sKey.substr(sQuery.length);
            var aMarkup = ["<div class='sample-result'><div class='sample-quantity'>",
                nQuantity,
                "</div><span class='sample-query'>",
                sKeyQuery,
                "</span>",
                sKeyRemainder,
                "</div>"];
            return (aMarkup.join(""));
        };

        // Instantiate one XHR DataSource and define schema as an array:
        //     ["Record Delimiter",
        //     "Field Delimiter"]
        this.oACDS = new YAHOO.widget.DS_XHR("ajax.php?o=jobtitle&rand=" + parseInt(Math.random() * 999999999), ["\n", "\t"]);
        this.oACDS.responseType = YAHOO.widget.DS_XHR.TYPE_FLAT;
        this.oACDS.maxCacheEntries = 60;
        this.oACDS.queryMatchSubset = true;

        // Instantiate AutoComplete
        this.oAutoComp = new YAHOO.widget.AutoComplete('JobTitle', 'JobTitleContainer', this.oACDS);
        this.oAutoComp.queryDelay = 0;
        this.oAutoComp.delimChar = " ";
        this.oAutoComp.prehighlightClassName = "yui-ac-prehighlight";
        this.oAutoComp.formatResult = this.fnCustomFormatter;
    };
</script>
{/literal}
