{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Date profesionale'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <form action="{$smarty.server.REQUEST_URI}" method="post" name="pers" onsubmit="return validateForm(this);">
                        <tr>
                            <td><b>{translate label='Profesie'}:</b></td>
                            <td>
                                <select multiple size="6" name="JobDictionaryID[]" id="JobDictionaryID">
                                    {foreach from=$jobs key=key item=item}
                                        <option value="{$key}" {if !empty($info.JobDictionaryID.$key) && $key == $info.JobDictionaryID.$key}selected{/if}>{translate label=$item}</option>
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
                            <td><b>{translate label='Studii absolvite'}:</b></td>
                            <td>
                                <select multiple size="6" name="StudiiAbsolvite[]">
                                    {foreach from=$educational_levels key=key item=item}
                                        <optgroup label="{translate label=$key}">
                                            {foreach from=$item key=key2 item=item2}
                                                {if is_array($item2)}
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{translate label=$key2}">
                                                        {foreach from=$item2 key=key3 item=item3}
                                                            <option value="{$key3}"
                                                                    {if !empty($info.StudiiAbsolvite.$key3) && $key3 == $info.StudiiAbsolvite.$key3}selected{/if}>{translate label=$item3}</option>
                                                        {/foreach}
                                                    </optgroup>
                                                {else}
                                                    <option value="{$key2}"
                                                            {if !empty($info.StudiiAbsolvite.$key2) && $key2 == $info.StudiiAbsolvite.$key2}selected{/if}>{translate label=$item2}</option>
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
                        {*<tr>
                            <td><b>{translate label='Vechime totala'}:</b></td>
                            <td>
                                <select name="WorkTime[years]" style="width: 40px;">{foreach from=$years item=year}
                                        <option value="{$year}" {if $year==$info.WorkTime.0}selected{/if}>{$year}</option>{/foreach}</select> {translate label='(ani) /'}
                                <select name="WorkTime[months]" style="width: 40px;">{foreach from=$months item=month}
                                        <option value="{$month}" {if $month==$info.WorkTime.1}selected{/if}>{$month}</option>{/foreach}</select> {translate label=' '}(luni) /
                                <select name="WorkTime[days]" style="width: 40px;">{foreach from=$days item=day}
                                        <option value="{$day}" {if $day==$info.WorkTime.2}selected{/if}>{$day}</option>{/foreach}</select> {translate label='(zile)'}
                                {translate label='la data'}
                                <input type="text" name="WorkTimeAt" class="formstyle"
                                       value="{if !empty($info.WorkTimeAt) && $info.WorkTimeAt != '0000-00-00'}{$info.WorkTimeAt|date_format:"%d.%m.%Y"}{/if}" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.WorkTimeAt,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                onClick="document.pers.WorkTimeAt.value = ''; return false;">{translate label='Anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Vechime la ultimul job'}:</b></td>
                            <td><input type="text" name="LastJobTime" value="{$info.LastJobTime|default:''}" size="10" maxlength="32"></td>
                        </tr>*}
                        <tr>
                            <td><b>{translate label='Vechime in firma'}:</b></td>
                            <td>
                                {$info.years} / {$info.months} / {$info.days}{translate label='(ani / luni / zile)'}
                                <input type="hidden" name="years" value="{$info.years}">
                                <input type="hidden" name="months" value="{$info.months}">
                                <input type="hidden" name="days" value="{$info.days}">
                            </td>
                        </tr>
                        <!--
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
                        <tr>
                            <td><b>{translate label='Numar permis'}:</b></td>
                            <td><input type="text" name="DrivingNo" value="{$info.DrivingNo|default:''}" size="10" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Serie permis'}:</b></td>
                            <td><input type="text" name="DrivingSerie" value="{$info.DrivingSerie|default:''}" size="10" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data emitere permis'}:</b></td>
                            <td>
                                <input type="text" name="DrivingStartDate" class="formstyle"
                                       value="{if !empty($info.DrivingStartDate) && $info.DrivingStartDate != '0000-00-00'}{$info.DrivingStartDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.DrivingStartDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                onClick="document.pers.DrivingStartDate.value = ''; return false;">{translate label='Anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data expirare permis'}:</b></td>
                            <td>
                                <input type="text" name="DrivingStopDate" class="formstyle"
                                       value="{if !empty($info.DrivingStopDate) && $info.DrivingStopDate != '0000-00-00'}{$info.DrivingStopDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.DrivingStopDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                onClick="document.pers.DrivingStopDate.value = ''; return false;">{translate label='Anuleaza'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Observatii permis'}:</b></td>
                            <td><input type="text" name="DrivingNotes" value="{$info.DrivingNotes|default:''}" size="40" maxlength="255"></td>
                        </tr>
                        -->
                        <tr>
                            <td><b>{translate label='Observatii'}:</b></td>
                            <td><textarea name="ProfNotes" rows="8" cols="50">{$info.ProfNotes}</textarea></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="Status" value="{$info.Status}"></td>
                            <td>{if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if} <input type="button"
                                                                                                                                                                   value="{translate label='Anuleaza'}"
                                                                                                                                                                   onclick="window.location='./?m=persons'"
                                                                                                                                                                   class="formstyle">
                            </td>
                        </tr>
                    </form>
                    {**************** Certificate / cursuri ****************}
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>{translate label='Certificate / cursuri'}</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>{translate label='Denumire certificat / curs'}</td>
                                        <td>{translate label='Emitent'}</td>
                                        <td>{translate label='Serie'}</td>
                                        <td>{translate label='Numar'}</td>
                                        <td>{translate label='Data inceput / eliberare'}</td>
                                        <td>{translate label='Data sfarsit / expirare'}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {foreach from=$certificate key=key item=item}
                                        <tr>
                                            <td><input type="text" id="CertifName_{$key}" name="CertifName_{$key}" value="{$item.CertifName}" size="24" maxlength="255"></td>
                                            <td><input type="text" id="CertifEmitent_{$key}" name="CertifEmitent_{$key}" value="{$item.CertifEmitent}" size="20" maxlength="255"></td>
                                            <td><input type="text" id="CertifSerie_{$key}" name="CertifSerie_{$key}" value="{$item.CertifSerie}" size="10" maxlength="16"></td>
                                            <td><input type="text" id="CertifNo_{$key}" name="CertifNo_{$key}" value="{$item.CertifNo}" size="10" maxlength="16"></td>
                                            <td>
                                                <input type="text" id="CertifStartDate_{$key}" name="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="jsC1_{$key}">
                                                    var calC1_{$key} = new CalendarPopup();
                                                    calC1_{$key}.isShowNavigationDropdowns = true;
                                                    calC1_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calC1_{$key}.select(document.getElementById('CertifStartDate_{$key}'),'anchorC1_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorC1_{$key}" ID="anchorC1_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="CertifStopDate_{$key}" name="StopDate_{$key}" value="{$item.StopDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                                    var cal2_{$key} = new CalendarPopup();
                                                    cal2_{$key}.isShowNavigationDropdowns = true;
                                                    cal2_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js2_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('CertifStopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CertifName_{$key}').value && document.getElementById('CertifEmitent_{$key}').value && document.getElementById('CertifSerie_{$key}').value && document.getElementById('CertifNo_{$key}').value && document.getElementById('CertifStartDate_{$key}').value && checkDate(document.getElementById('CertifStartDate_{$key}').value, 'Data inceput') && document.getElementById('CertifStopDate_{$key}').value && checkDate(document.getElementById('CertifStopDate_{$key}').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=edit&CertifID={$key}&CertifName=' + escape(document.getElementById('CertifName_{$key}').value) + '&CertifEmitent=' + escape(document.getElementById('CertifEmitent_{$key}').value) + '&CertifSerie=' + escape(document.getElementById('CertifSerie_{$key}').value) + '&CertifNo=' + escape(document.getElementById('CertifNo_{$key}').value) + '&StartDate=' + document.getElementById('CertifStartDate_{$key}').value + '&StopDate=' + document.getElementById('CertifStopDate_{$key}').value; else alert('{translate label='Completati Denumire certificat, Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                                            title="{translate label='Modifica certificat'}"><b>Mod</b></a></div>{/if}</td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=del&CertifID={$key}'; return false;"
                                                                            title="{translate label='Sterge certificat'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="CertifName_0" name="CertifName_0" size="24" maxlength="255"></td>
                                        <td><input type="text" id="CertifEmitent_0" name="CertifEmitent_0" size="20" maxlength="255"></td>
                                        <td><input type="text" id="CertifSerie_0" name="CertifSerie_0" size="10" maxlength="16"></td>
                                        <td><input type="text" id="CertifNo_0" name="CertifNo_0" size="10" maxlength="16"></td>
                                        <td>
                                            <input type="text" id="CertifStartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var cal1_0 = new CalendarPopup();
                                                cal1_0.isShowNavigationDropdowns = true;
                                                cal1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal1_0.select(document.getElementById('CertifStartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                               ID="anchor1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="CertifStopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                var cal2_0 = new CalendarPopup();
                                                cal2_0.isShowNavigationDropdowns = true;
                                                cal2_0.setYearSelectStartOffset(10);
                                                //writeSource("js2_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal2_0.select(document.getElementById('CertifStopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                               ID="anchor2_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="CertifType_0" name="Type_0" value="1" />
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CertifName_0').value && document.getElementById('CertifEmitent_0').value && document.getElementById('CertifSerie_0').value && document.getElementById('CertifNo_0').value && document.getElementById('CertifStartDate_0').value && checkDate(document.getElementById('CertifStartDate_0').value, 'Data inceput') && document.getElementById('CertifStopDate_0').value && checkDate(document.getElementById('CertifStopDate_0').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=new&CertifName=' + escape(document.getElementById('CertifName_0').value) + '&Type=' + escape(document.getElementById('CertifType_0').value) + '&CertifEmitent=' + escape(document.getElementById('CertifEmitent_0').value) + '&CertifSerie=' + escape(document.getElementById('CertifSerie_0').value) + '&CertifNo=' + escape(document.getElementById('CertifNo_0').value) + '&StartDate=' + document.getElementById('CertifStartDate_0').value + '&StopDate=' + document.getElementById('CertifStopDate_0').value; else alert('{translate label='Completati Denumire certificat, Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                                        title="{translate label='Adauga certificat'}"><b>Add</b></a></div>{/if}</td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Atestate ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>{translate label='Atestate asistent maternal'}</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>{translate label='Numar hotarare'}</td>
                                        <td>{translate label='Data eliberare'}</td>
                                        <td>{translate label='Data expirare'}</td>
                                        <td>{translate label='Numar copii care pot<br/>fi primiti in plasament'}</td>
                                        <td>{translate label='Tip nevoi copil'}</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {foreach from=$atestate key=key item=item}
                                        <tr>
                                            <td><input type="text" id="AtestNo_{$key}" name="CertifNo_{$key}" value="{$item.CertifNo}" size="10" maxlength="16"></td>
                                            <td>
                                                <input type="text" id="AtestStartDate_{$key}" name="StartDate_{$key}" value="{$item.StartDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var cal1_{$key} = new CalendarPopup();
                                                    cal1_{$key}.isShowNavigationDropdowns = true;
                                                    cal1_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('AtestStartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="AtestStopDate_{$key}" name="StopDate_{$key}" value="{$item.StopDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                                    var cal2_{$key} = new CalendarPopup();
                                                    cal2_{$key}.isShowNavigationDropdowns = true;
                                                    cal2_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js2_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2_{$key}.select(document.getElementById('AtestStopDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <select id="NrCopiiPlasament_{$key}" name="NrCopiiPlasament_{$key}">
                                                    <option value="">- alege -</option>
                                                    <option value="1" {if $item.NrCopiiPlasament == 1}selected="selected"{/if}>1</option>
                                                    <option value="2" {if $item.NrCopiiPlasament == 2}selected="selected"{/if}>2</option>
                                                    <option value="2" {if $item.NrCopiiPlasament == 3}selected="selected"{/if}>3</option>
                                                    <option value="2" {if $item.NrCopiiPlasament == 4}selected="selected"{/if}>4</option>
                                                    <option value="2" {if $item.NrCopiiPlasament == 5}selected="selected"{/if}>5</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="TipNevoiCopil_{$key}" name="TipNevoiCopil_{$key}">
                                                    <option value="">- alege -</option>
                                                    <option value="1" {if $item.TipNevoiCopil == 1}selected="selected"{/if}>Cu nevoi speciale</option>
                                                    <option value="2" {if $item.TipNevoiCopil == 2}selected="selected"{/if}>Fara nevoi speciale</option>
                                                </select>
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('AtestNo_{$key}').value && document.getElementById('AtestStartDate_{$key}').value && checkDate(document.getElementById('AtestStartDate_{$key}').value, 'Data inceput') && document.getElementById('AtestStopDate_{$key}').value && checkDate(document.getElementById('AtestStopDate_{$key}').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=edit&CertifID={$key}&NrCopiiPlasament=' + escape(document.getElementById('NrCopiiPlasament_{$key}').value) + '&TipNevoiCopil=' + escape(document.getElementById('TipNevoiCopil_{$key}').value) + '&CertifNo=' + escape(document.getElementById('AtestNo_{$key}').value) + '&StartDate=' + document.getElementById('AtestStartDate_{$key}').value + '&StopDate=' + document.getElementById('AtestStopDate_{$key}').value; else alert('{translate label='Completati Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                                            title="{translate label='Modifica atestat'}"><b>Mod</b></a></div>{/if}</td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=del&CertifID={$key}'; return false;"
                                                                            title="{translate label='Sterge atestat'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="AtestNo_0" name="CertifNo_0" size="10" maxlength="16"></td>
                                        <td>
                                            <input type="text" id="AtestStartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var cal1_0 = new CalendarPopup();
                                                cal1_0.isShowNavigationDropdowns = true;
                                                cal1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal1_0.select(document.getElementById('AtestStartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                               ID="anchor1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="AtestStopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                var cal2_0 = new CalendarPopup();
                                                cal2_0.isShowNavigationDropdowns = true;
                                                cal2_0.setYearSelectStartOffset(10);
                                                //writeSource("js2_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal2_0.select(document.getElementById('AtestStopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                               ID="anchor2_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <select id="NrCopiiPlasament_0" name="NrCopiiPlasament_0">
                                                <option value="">- alege -</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="TipNevoiCopil_0" name="TipNevoiCopil_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Cu nevoi speciale</option>
                                                <option value="2">Fara nevoi speciale</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="AtestType_0" name="Type_0" value="2" />
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('AtestNo_0').value && document.getElementById('AtestStartDate_0').value && checkDate(document.getElementById('AtestStartDate_0').value, 'Data inceput') && document.getElementById('AtestStopDate_0').value && checkDate(document.getElementById('AtestStopDate_0').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=new&NrCopiiPlasament=' + escape(document.getElementById('NrCopiiPlasament_0').value) + '&Type=' + escape(document.getElementById('AtestType_0').value) + '&TipNevoiCopil=' + escape(document.getElementById('TipNevoiCopil_0').value) + '&CertifNo=' + escape(document.getElementById('AtestNo_0').value) + '&StartDate=' + document.getElementById('AtestStartDate_0').value + '&StopDate=' + document.getElementById('AtestStopDate_0').value; else alert('{translate label='Completati Numar, Data de inceput, Data de sfarsit!'}'); return false;"
                                                                        title="{translate label='Adauga atestat'}"><b>Add</b></a></div>{/if}</td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Avize Psihologice ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Avize Psihologice</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Titlu Document</td></td>
                                        <td>Numar Document</td>
                                        <td>Data Document</td>
                                        <td>Emis de</td>
                                        <td>Tip document</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {if $psyDocsNew}
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    {/if}
                                    {foreach from=$psyDocsNew key=key item=item}
                                        <tr>
                                            <td>
                                                <input type="text" id="PsyDocName_{$key}" name="PsyDocName_{$key}" value="{$item.DocName}" size="50" maxlength="256">
                                            </td>
                                            <td>
                                                <input type="text" id="PsyDocNumber_{$key}" name="PsyDocNumber_{$key}" value="{$item.DocNumber}" size="10" maxlength="16">
                                            </td>
                                            <td>
                                                <input type="text" id="PsyDocDate_{$key}" name="PsyDocDate_{$key}" value="{$item.DocDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calpsi1_{$key} = new CalendarPopup();
                                                    calpsi1_{$key}.isShowNavigationDropdowns = true;
                                                    calpsi1_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calpsi1_{$key}.select(document.getElementById('PsyDocDate_{$key}'),'anchorpsy1_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorpsy1_{$key}" ID="anchorpsy1_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="PsyIssuer_{$key}" name="PsyIssuer_{$key}" value="{$item.Issuer}" size="50" maxlength="255">
                                            </td>
                                            <td>
                                                <select id="PsyDocType_{$key}" name="PsyDocType_{$key}">
                                                    <option value="">- alege -</option>
                                                    <option value="1" {if $item.DocType == 1} selected="selected"{/if}>Angajare</option>
                                                    <option value="2" {if $item.DocType == 2} selected="selected"{/if}>Școlarizare</option>
                                                    <option value="3" {if $item.DocType == 3} selected="selected"{/if}>Control Periodic</option>
                                                    <option value="4" {if $item.DocType == 4} selected="selected"{/if}>Schimbare de funcție</option>
                                                    <option value="5" {if $item.DocType == 5} selected="selected"{/if}>Sesizare</option>
                                                    <option value="6" {if $item.DocType == 6} selected="selected"{/if}>Contestație</option>
                                                </select>
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('PsyDocNumber_{$key}').value
                                                                                    && document.getElementById('PsyDocDate_{$key}').value
                                                                                    && checkDate(document.getElementById('PsyDocDate_{$key}').value, 'Data document')
                                                                                    && document.getElementById('PsyDocName_{$key}').value
                                                                                    && document.getElementById('PsyIssuer_{$key}').value
                                                                                    && document.getElementById('PsyDocType_{$key}').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=editpsychological&Id={$key}&DocNumber='
                                                                                    + escape(document.getElementById('PsyDocNumber_{$key}').value)
                                                                                    + '&DocName=' + escape(document.getElementById('PsyDocName_{$key}').value)
                                                                                    + '&DocDate=' + document.getElementById('PsyDocDate_{$key}').value
                                                                                    + '&Issuer=' + escape(document.getElementById('PsyIssuer_{$key}').value)
                                                                                    + '&DocType=' + escape(document.getElementById('PsyDocType_{$key}').value)
                                                                                    + '&Approval=' + escape(document.getElementById('PsyApproval_{$key}').value)
                                                                                    + '&Recommendations=' + escape(document.getElementById('PsyRecommendations_{$key}').value);
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Psihologic"><b>Mod</b></a></div>{/if}
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=delpsychological&Id={$key}'; return false;"
                                                                            title="{translate label='Sterge Aviz Psihologic'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Aviz Psihologic</td>
                                            <td colspan="3">Recomandari</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <textarea id="PsyApproval_{$key}" name="PsyApproval_{$key}" rows="4" cols="85">{$item.Approval}</textarea>
                                            </td>
                                            <td colspan="3">
                                                <textarea id="PsyRecommendations_{$key}" name="PsyRecommendations_{$key}" rows="4" cols="85">{$item.Recommendations}</textarea>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="PsyDocName_0" name="PsyDocName_0" size="50" maxlength="256"></td>
                                        <td><input type="text" id="PsyDocNumber_0" name="PsyDocNumber_0" size="10" maxlength="10"></td>
                                        <td>
                                            <input type="text" id="PsyDocDate_0" name="PsyDocDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calpsy1_0 = new CalendarPopup();
                                                calpsy1_0.isShowNavigationDropdowns = true;
                                                calpsy1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calpsy1_0.select(document.getElementById('PsyDocDate_0'),'anchorpsy1_0','dd.MM.yyyy'); return false;" NAME="anchorpsy1_0"
                                               ID="anchorpsy1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="PsyIssuer_0" name="PsyIssuer_0" class="formstyle" value="" size="50" maxlength="255">

                                        </td>
                                        <td>
                                            <select id="PsyDocType_0" name="PsyDocType_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Angajare</option>
                                                <option value="2">Școlarizare</option>
                                                <option value="3">Control Periodic</option>
                                                <option value="4">Schimbare de funcție</option>
                                                <option value="5">Sesizare</option>
                                                <option value="6">Contestație</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="PsyDocType_0" name="PsyDoc_Type_0" value="2" />
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('PsyDocNumber_0').value
                                                                                && document.getElementById('PsyDocName_0').value
                                                                                && document.getElementById('PsyDocDate_0').value
                                                                                && checkDate(document.getElementById('PsyDocDate_0').value, 'Data document')
                                                                                && document.getElementById('PsyIssuer_0').value
                                                                                && document.getElementById('PsyDocType_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=newpsychological&DocType='
                                                                                + escape(document.getElementById('PsyDocType_0').value)
                                                                                + '&DocName=' + escape(document.getElementById('PsyDocName_0').value)
                                                                                + '&DocDate=' + escape(document.getElementById('PsyDocDate_0').value)
                                                                                + '&Issuer=' + document.getElementById('PsyIssuer_0').value
                                                                                + '&DocNumber=' + document.getElementById('PsyDocNumber_0').value
                                                                                + '&Approval=' + document.getElementById('PsyApproval_0').value
                                                                                + '&Recommendations=' + document.getElementById('PsyRecommendations_0').value;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga Aviz Psihologic"><b>Adauga</b></a></div>{/if}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Rezultat Psihologic</td>
                                        <td colspan="3">Recomandari</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <textarea id="PsyApproval_0" name="PsyApproval_0" rows="4" cols="85"></textarea>
                                        </td>
                                        <td colspan="3">
                                        <textarea id="PsyRecommendations_0" name="PsyRecommendations_0" rows="4" cols="85"></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Avize Medicale ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Avize Medicale</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Titlu Document</td></td>
                                        <td>Numar Document</td>
                                        <td>Data Document</td>
                                        <td>Emis de</td>
                                        <td>Tip document</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {if $medDocsNew}
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    {/if}
                                    {foreach from=$medDocsNew key=key item=item}
                                        <tr>
                                            <td>
                                                <input type="text" id="DocName_{$key}" name="DocName_{$key}" value="{$item.DocName}" size="50" maxlength="256">
                                            </td>
                                            <td>
                                                <input type="text" id="DocNumber_{$key}" name="DocNumber_{$key}" value="{$item.DocNumber}" size="10" maxlength="16">
                                            </td>
                                            <td>
                                                <input type="text" id="DocDate_{$key}" name="DocDate_{$key}" value="{$item.DocDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var cal1_{$key} = new CalendarPopup();
                                                    cal1_{$key}.isShowNavigationDropdowns = true;
                                                    cal1_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1_{$key}.select(document.getElementById('DocDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="Issuer_{$key}" name="Issuer_{$key}" value="{$item.Issuer}" size="50" maxlength="255">
                                            </td>
                                            <td>
                                                <select id="DocType_{$key}" name="DocType_{$key}">
                                                    <option value="">- alege -</option>
                                                    <option value="1" {if $item.DocType == 1} selected="selected"{/if}>Angajare</option>
                                                    <option value="2" {if $item.DocType == 2} selected="selected"{/if}>Școlarizare</option>
                                                    <option value="3" {if $item.DocType == 3} selected="selected"{/if}>Control Periodic</option>
                                                    <option value="4" {if $item.DocType == 4} selected="selected"{/if}>Schimbare de funcție</option>
                                                    <option value="5" {if $item.DocType == 5} selected="selected"{/if}>Sesizare</option>
                                                    <option value="6" {if $item.DocType == 6} selected="selected"{/if}>Contestație</option>
                                                </select>
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DocNumber_{$key}').value
                                                                                    && document.getElementById('DocDate_{$key}').value
                                                                                    && checkDate(document.getElementById('DocDate_{$key}').value, 'Data document')
                                                                                    && document.getElementById('DocName_{$key}').value
                                                                                    && document.getElementById('Issuer_{$key}').value
                                                                                    && document.getElementById('DocType_{$key}').value)
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=editnewmedical&Id={$key}&DocNumber='
                                                                                    + escape(document.getElementById('DocNumber_{$key}').value)
                                                                                    + '&DocName=' + escape(document.getElementById('DocName_{$key}').value)
                                                                                    + '&DocDate=' + document.getElementById('DocDate_{$key}').value
                                                                                    + '&Issuer=' + escape(document.getElementById('Issuer_{$key}').value)
                                                                                    + '&DocType=' + escape(document.getElementById('DocType_{$key}').value)
                                                                                    + '&Approval=' + escape(document.getElementById('Approval_{$key}').value)
                                                                                    + '&Recommendations=' + escape(document.getElementById('Recommendations_{$key}').value);
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Medical"><b>Mod</b></a></div>{/if}
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=delnewmedical&Id={$key}'; return false;"
                                                                            title="{translate label='Sterge atestat'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Aviz Medical</td>
                                            <td colspan="3">Recomandari</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <textarea id="Approval_{$key}" name="Approval_{$key}" rows="4" cols="85">{$item.Approval}</textarea>
                                            </td>
                                            <td colspan="3">
                                                <textarea id="Recommendations_{$key}" name="Recommendations_{$key}" rows="4" cols="85">{$item.Recommendations}</textarea>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="DocName_0" name="DocName_0" size="50" maxlength="256"></td>
                                        <td><input type="text" id="DocNumber_0" name="DocNumber_0" size="10" maxlength="10"></td>
                                        <td>
                                            <input type="text" id="DocDate_0" name="DocDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calmed1_0 = new CalendarPopup();
                                                calmed1_0.isShowNavigationDropdowns = true;
                                                calmed1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calmed1_0.select(document.getElementById('DocDate_0'),'anchormed1_0','dd.MM.yyyy'); return false;" NAME="anchormed1_0"
                                               ID="anchormed1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="Issuer_0" name="Issuer_0" class="formstyle" value="" size="50" maxlength="255">

                                        </td>
                                        <td>
                                            <select id="DocType_0" name="DocType_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Angajare</option>
                                                <option value="2">Școlarizare</option>
                                                <option value="3">Control Periodic</option>
                                                <option value="4">Schimbare de funcție</option>
                                                <option value="5">Sesizare</option>
                                                <option value="6">Contestație</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="DocType_0" name="Doc_Type_0" value="2" />
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DocNumber_0').value
                                                                                && document.getElementById('DocName_0').value
                                                                                && document.getElementById('DocDate_0').value
                                                                                && checkDate(document.getElementById('DocDate_0').value, 'Data document')
                                                                                && document.getElementById('Issuer_0').value
                                                                                && document.getElementById('DocType_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=newmedical&DocType='
                                                                                + escape(document.getElementById('DocType_0').value)
                                                                                + '&DocName=' + escape(document.getElementById('DocName_0').value)
                                                                                + '&DocDate=' + escape(document.getElementById('DocDate_0').value)
                                                                                + '&Issuer=' + document.getElementById('Issuer_0').value
                                                                                + '&DocNumber=' + document.getElementById('DocNumber_0').value
                                                                                + '&Approval=' + document.getElementById('Approval_0').value
                                                                                + '&Recommendations=' + document.getElementById('Recommendations_0').value;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga Aviz Medical"><b>Adauga</b></a></div>{/if}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Aviz Medical</td>
                                        <td colspan="3">Recomandari</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <textarea id="Approval_0" name="Approval_0" rows="4" cols="85"></textarea>
                                        </td>
                                        <td colspan="3">
                                            <textarea id="Recommendations_0" name="Recommendations_0" rows="4" cols="85"></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Certificat de pregatire profesionala a conducatorului auto ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Certificate de Pregătire Profesională a Conducătorului Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliberării</td></td>
                                        <td>Data expirării</td>
                                        <td>Număr permis conducere</td>
                                        <td>Număr certificat</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {if $cppc}
                                        <tr>
                                            <td colspan="6" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    {/if}
                                    {foreach from=$cppc key=key item=item}
                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDate_{$key}" name="ReleaseDate_{$key}" value="{$item.ReleaseDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calrd_{$key} = new CalendarPopup();
                                                    calrd_{$key}.isShowNavigationDropdowns = true;
                                                    calrd_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrd_{$key}.select(document.getElementById('ReleaseDate_{$key}'),'anchorrd_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrd_{$key}" ID="anchorrd_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDate_{$key}" name="ExpirationDate_{$key}" value="{$item.ExpirationDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calcped1_{$key} = new CalendarPopup();
                                                    calcped1_{$key}.isShowNavigationDropdowns = true;
                                                    calcped1_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcped1_{$key}.select(document.getElementById('ExpirationDate_{$key}'),'anchorcped_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcped_{$key}" ID="anchorcped_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumber_{$key}" name="DrivingLicenseNumber_{$key}" value="{$item.DrivingLicenseNumber}" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="CertificateNumber_{$key}" name="CertificateNumber_{$key}" value="{$item.CertificateNumber}" size="20" maxlength="20">
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DrivingLicenseNumber_{$key}').value
                                                                                    && document.getElementById('ReleaseDate_{$key}').value
                                                                                    && checkDate(document.getElementById('ReleaseDate_{$key}').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDate_{$key}').value
                                                                                    && checkDate(document.getElementById('ExpirationDate_{$key}').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=editCPPC&Id={$key}&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDate_{$key}').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDate_{$key}').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumber_{$key}').value)
                                                                                    + '&CertificateNumber=' + escape(document.getElementById('CertificateNumber_{$key}').value)
                                                                                    + (document.getElementById('AM_{$key}').checked ? '+&AM=1' :'')
                                                                                    + (document.getElementById('A1_{$key}').checked ? '+&A1=1' :'')
                                                                                    + (document.getElementById('A2_{$key}').checked ? '+&A2=1' :'')
                                                                                    + (document.getElementById('A_{$key}').checked ? '+&A=1' :'')
                                                                                    + (document.getElementById('B1_{$key}').checked ? '+&B1=1' :'')
                                                                                    + (document.getElementById('B_{$key}').checked ? '+&B=1' :'')
                                                                                    + (document.getElementById('BE_{$key}').checked ? '+&BE=1' :'')
                                                                                    + (document.getElementById('C1_{$key}').checked ? '+&C1=1' :'')
                                                                                    + (document.getElementById('C1E_{$key}').checked ? '+&C1E=1' :'')
                                                                                    + (document.getElementById('C_{$key}').checked ? '+&C=1' :'')
                                                                                    + (document.getElementById('CE_{$key}').checked ? '+&CE=1' :'')
                                                                                    + (document.getElementById('D1_{$key}').checked ? '+&D1=1' :'')
                                                                                    + (document.getElementById('D1E_{$key}').checked ? '+&D1E=1' :'')
                                                                                    + (document.getElementById('D_{$key}').checked ? '+&D=1' :'')
                                                                                    + (document.getElementById('DE_{$key}').checked ? '+&DE=1' :'')
                                                                                    + (document.getElementById('Tr_{$key}').checked ? '+&Tr=1' :'')
                                                                                    + (document.getElementById('Tb_{$key}').checked ? '+&Tb=1' :'')
                                                                                    + (document.getElementById('Tv_{$key}').checked ? '+&Tv=1' :'')
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Medical"><b>Mod</b></a></div>{/if}
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=delCPPC&Id={$key}'; return false;"
                                                                            title="{translate label='Sterge Certificat'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Categorii de vehicule</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">

                                                <input type="checkbox" id="AM_{$key}" name="AM_{$key}" value="1" {if ($item.AM == 1)} checked {/if} />
                                                AM&nbsp;&nbsp;
                                                <input type="checkbox" id="A1_{$key}" name="A1_{$key}" value="1" {if ($item.A1 == 1)} checked {/if}/>
                                                A1
                                                <input type="checkbox" id="A2_{$key}" name="A2_{$key}" value="1" {if ($item.A2 == 1)} checked {/if}/>
                                                A2
                                                <input type="checkbox" id="A_{$key}" name="A_{$key}" value="1" {if ($item.A == 1)} checked {/if} />
                                                A
                                                <input type="checkbox" id="B1_{$key}" name="B1_{$key}" value="1" {if ($item.B1 == 1)} checked {/if} />
                                                B1
                                                <input type="checkbox" id="B_{$key}" name="B_{$key}" value="1" {if ($item.B == 1)} checked {/if} />
                                                B
                                                <input type="checkbox" id="BE_{$key}" name="BE_{$key}" value="1" {if ($item.BE == 1)} checked {/if} />
                                                BE
                                                <input type="checkbox" id="C1_{$key}" name="C1_{$key}" value="1" {if ($item.C1 == 1)} checked {/if} />
                                                C1
                                                <input type="checkbox" id="C1E_{$key}" name="C1E_{$key}" value="1" {if ($item.C1E == 1)} checked {/if} />
                                                C1E
                                                <input type="checkbox" id="C_{$key}" name="C_{$key}" value="1" {if ($item.C == 1)} checked {/if} />
                                                C
                                                <input type="checkbox" id="CE_{$key}" name="CE_{$key}" value="1" {if ($item.CE == 1)} checked {/if} />
                                                CE
                                                <input type="checkbox" id="D1_{$key}" name="D1_{$key}" value="1" {if ($item.D1 == 1)} checked {/if} />
                                                D1
                                                <input type="checkbox" id="D1E_{$key}" name="D1E_{$key}" value="1" {if ($item.D1E == 1)} checked {/if} />
                                                D1E
                                                <input type="checkbox" id="D_{$key}" name="D_{$key}" value="1" {if ($item.D == 1)} checked {/if} />
                                                D
                                                <input type="checkbox" id="DE_{$key}" name="DE_{$key}" value="1" {if ($item.DE == 1)} checked {/if} />
                                                DE
                                                <input type="checkbox" id="Tr_{$key}" name="Tr_{$key}" value="1" {if ($item.Tr == 1)} checked {/if} />
                                                Tr
                                                <input type="checkbox" id="Tb_{$key}" name="Tb_{$key}" value="1" {if ($item.Tb == 1)} checked {/if} />
                                                Tb
                                                <input type="checkbox" id="Tv_{$key}" name="Tv_{$key}" value="1" {if ($item.Tv == 1)} checked {/if} />
                                                Tv
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td colspan="5" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDate_0" name="ReleaseDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRD_0 = new CalendarPopup();
                                                calRD_0.isShowNavigationDropdowns = true;
                                                calRD_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRD_0.select(document.getElementById('ReleaseDate_0'),'anchorRD_0','dd.MM.yyyy'); return false;" NAME="anchorRD_0"
                                               ID="anchorRD_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDate_0" name="ExpirationDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calED_0 = new CalendarPopup();
                                                calED_0.isShowNavigationDropdowns = true;
                                                calED_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calED_0.select(document.getElementById('ExpirationDate_0'),'anchorED_0','dd.MM.yyyy'); return false;" NAME="anchorED_0"
                                               ID="anchorED_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumber_0" name="DrivingLicenseNumber_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="CertificateNumber_0" name="CertificateNumber_0" size="20" maxlength="20"></td>
                                        <td colspan="2">
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumber_0').value
                                                                                && document.getElementById('ReleaseDate_0').value
                                                                                && checkDate(document.getElementById('ReleaseDate_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDate_0').value
                                                                                && checkDate(document.getElementById('ExpirationDate_0').value, 'Data Expirare'))
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=newCPPC&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumber_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDate_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDate_0').value)
                                                                                + '&CertificateNumber=' + document.getElementById('CertificateNumber_0').value
                                                                                + (document.getElementById('AM_0').checked ? '+&AM=1' :'')
                                                                                + (document.getElementById('A1_0').checked ? '+&A1=1' :'')
                                                                                + (document.getElementById('A2_0').checked ? '+&A2=1' :'')
                                                                                + (document.getElementById('A_0').checked ? '+&A=1' :'')
                                                                                + (document.getElementById('B1_0').checked ? '+&B1=1' :'')
                                                                                + (document.getElementById('B_0').checked ? '+&B=1' :'')
                                                                                + (document.getElementById('BE_0').checked ? '+&BE=1' :'')
                                                                                + (document.getElementById('C1_0').checked ? '+&C1=1' :'')
                                                                                + (document.getElementById('C1E_0').checked ? '+&C1E=1' :'')
                                                                                + (document.getElementById('C_0').checked ? '+&C=1' :'')
                                                                                + (document.getElementById('CE_0').checked ? '+&CE=1' :'')
                                                                                + (document.getElementById('D1_0').checked ? '+&D1=1' :'')
                                                                                + (document.getElementById('D1E_0').checked ? '+&D1E=1' :'')
                                                                                + (document.getElementById('D_0').checked ? '+&D=1' :'')
                                                                                + (document.getElementById('DE_0').checked ? '+&DE=1' :'')
                                                                                + (document.getElementById('Tr_0').checked ? '+&Tr=1' :'')
                                                                                + (document.getElementById('Tb_0').checked ? '+&Tb=1' :'')
                                                                                + (document.getElementById('Tv_0').checked ? '+&Tv=1' :'')
                                                                                ;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div>{/if}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Categorii de vehicule</td>
                                    </tr>
                                    <tr>

                                        <td colspan="6">

                                            <input type="checkbox" id="AM_0" name="AM_0" value="0" />
                                            AM&nbsp;&nbsp;
                                            <input type="checkbox" id="A1_0" name="A1_0" value="0"/>
                                            A1
                                            <input type="checkbox" id="A2_0" name="A2_0" value="0"/>
                                            A2
                                            <input type="checkbox" id="A_0" name="A_0" value="0" />
                                            A
                                            <input type="checkbox" id="B1_0" name="B1_0" value="0" />
                                            B1
                                            <input type="checkbox" id="B_0" name="B_0" value="0" />
                                            B
                                            <input type="checkbox" id="BE_0" name="BE_0" value="0" />
                                            BE
                                            <input type="checkbox" id="C1_0" name="C1_0" value="0" />
                                            C1
                                            <input type="checkbox" id="C1E_0" name="C1E_0" value="0" />
                                            C1E
                                            <input type="checkbox" id="C_0" name="C_0" value="0" />
                                            C
                                            <input type="checkbox" id="CE_0" name="CE_0" value="0" />
                                            CE
                                            <input type="checkbox" id="D1_0" name="D1_0" value="0" />
                                            D1
                                            <input type="checkbox" id="D1E_0" name="D1E_0" value="0" />
                                            D1E
                                            <input type="checkbox" id="D_0" name="D_0" value="0" />
                                            D
                                            <input type="checkbox" id="DE_0" name="DE_0" value="0" />
                                            DE
                                            <input type="checkbox" id="Tr_0" name="Tr_0" value="0" />
                                            Tr
                                            <input type="checkbox" id="Tb_0" name="Tb_0" value="0" />
                                            Tb
                                            <input type="checkbox" id="Tv_0" name="Tv_0" value="0" />
                                            Tv
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Cartela Conducatorului Auto ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Cartela Conducătorului Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliberării</td></td>
                                        <td>Data expirării</td>
                                        <td>Număr permis conducere</td>
                                        <td>Număr certificat</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {if $cca}
                                        <tr>
                                            <td colspan="6" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    {/if}
                                    {foreach from=$cca key=key item=item}

                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDateCCA_{$key}" name="ReleaseDateCCA_{$key}" value="{$item.ReleaseDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calrdcca_{$key} = new CalendarPopup();
                                                    calrdcca_{$key}.isShowNavigationDropdowns = true;
                                                    calrdcca_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrdcca_{$key}.select(document.getElementById('ReleaseDateCCA_{$key}'),'anchorrdcca_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrdcca_{$key}" ID="anchorrdcca_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDateCCA_{$key}" name="ExpirationDateCCA_{$key}" value="{$item.ExpirationDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calcpedcca_{$key} = new CalendarPopup();
                                                    calcpedcca_{$key}.isShowNavigationDropdowns = true;
                                                    calcpedcca_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcpedcca_{$key}.select(document.getElementById('ExpirationDateCCA_{$key}'),'anchorcpedcca_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcpedcca_{$key}" ID="anchorcpedcca_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumberCCA_{$key}" name="DrivingLicenseNumberCCA_{$key}" value="{$item.DrivingLicenseNumber}" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="DriverCardNumberCCA_{$key}" name="DriverCardNumberCCA_{$key}" value="{$item.CardNumber}" size="20" maxlength="20">
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DriverCardNumberCCA_{$key}').value
                                                                                    && document.getElementById('ReleaseDateCCA_{$key}').value
                                                                                    && checkDate(document.getElementById('ReleaseDateCCA_{$key}').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDateCCA_{$key}').value
                                                                                    && checkDate(document.getElementById('ExpirationDateCCA_{$key}').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=editCCA&Id={$key}&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDateCCA_{$key}').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateCCA_{$key}').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumberCCA_{$key}').value)
                                                                                    + '&CardNumber=' + escape(document.getElementById('DriverCardNumberCCA_{$key}').value)
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Cartela Conducator Auto"><b>Mod</b></a></div>{/if}
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=delCCA&Id={$key}'; return false;"
                                                                            title="{translate label='Sterge Certificat'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>

                                    {/foreach}
                                    <tr>
                                        <td colspan="5" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDateCCA_0" name="ReleaseDateCCA_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRDCCA_0 = new CalendarPopup();
                                                calRDCCA_0.isShowNavigationDropdowns = true;
                                                calRDCCA_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRDCCA_0.select(document.getElementById('ReleaseDateCCA_0'),'anchorRDCCA_0','dd.MM.yyyy'); return false;" NAME="anchorRDCCA_0"
                                               ID="anchorRDCCA_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDateCCA_0" name="ExpirationDateCCA_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calEDCCA_0 = new CalendarPopup();
                                                calEDCCA_0.isShowNavigationDropdowns = true;
                                                calEDCCA_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calEDCCA_0.select(document.getElementById('ExpirationDateCCA_0'),'anchorEDCCA_0','dd.MM.yyyy'); return false;" NAME="anchorEDCCA_0"
                                               ID="anchorEDCCA_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumberCCA_0" name="DrivingLicenseNumberCCA_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="DriverCardNumberCCA_0" name="DriverCardNumberCCA_0" size="20" maxlength="20"></td>
                                        <td colspan="2">
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumberCCA_0').value
                                                                                && document.getElementById('ReleaseDateCCA_0').value
                                                                                && checkDate(document.getElementById('ReleaseDateCCA_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDateCCA_0').value
                                                                                && checkDate(document.getElementById('ExpirationDateCCA_0').value, 'Data Expirare'))
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=newCCA&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumberCCA_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDateCCA_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateCCA_0').value)
                                                                                + '&CardNumber=' + document.getElementById('DriverCardNumberCCA_0').value
                                                                                ;
                                                                                else alert('Completati Data Emiterii, Data Expirarii, Numar permis auto'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div>{/if}

                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    {************ Permis Auto ***********}

                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Permise Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliberării</td></td>
                                        <td>Data expirării</td>
                                        <td>Număr permis conducere</td>
                                        <td>Emitent</td>
                                        <td>Restrictii</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    {if $dl}
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    {/if}
                                    {foreach from=$dl key=key item=item}

                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDateDL_{$key}" name="ReleaseDateDL_{$key}" value="{$item.ReleaseDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calrdDL_{$key} = new CalendarPopup();
                                                    calrdDL_{$key}.isShowNavigationDropdowns = true;
                                                    calrdDL_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrdDL_{$key}.select(document.getElementById('ReleaseDateDL_{$key}'),'anchorrdDL_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrdDL_{$key}" ID="anchorrdDL_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDateDL_{$key}" name="ExpirationDateDL_{$key}" value="{$item.ExpirationDate|date_format:"%d.%m.%Y"}" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                    var calcpedDL_{$key} = new CalendarPopup();
                                                    calcpedDL_{$key}.isShowNavigationDropdowns = true;
                                                    calcpedDL_{$key}.setYearSelectStartOffset(10);
                                                    //writeSource("js1_{$key}");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcpedDL_{$key}.select(document.getElementById('ExpirationDateDL_{$key}'),'anchorcpedDL_{$key}','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcpedDL_{$key}" ID="anchorcpedDL_{$key}"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumberDL_{$key}" name="DrivingLicenseNumberDL_{$key}" value="{$item.DrivingLicenseNumber}" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="IssuerDL_{$key}" name="IssuerDL_{$key}" value="{$item.Issuer}" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="RestrictionsDL_{$key}" name="RestrictionsDL_{$key}" value="{$item.Restrictions}" size="50" maxlength="50">
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DrivingLicenseNumberDL_{$key}').value
                                                                                    && document.getElementById('IssuerDL_{$key}').value
                                                                                    && document.getElementById('ReleaseDateDL_{$key}').value
                                                                                    && checkDate(document.getElementById('ReleaseDateDL_{$key}').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDateDL_{$key}').value
                                                                                    && checkDate(document.getElementById('ExpirationDateDL_{$key}').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=editDL&Id={$key}&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDateDL_{$key}').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateDL_{$key}').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumberDL_{$key}').value)
                                                                                    + '&Issuer=' + escape(document.getElementById('IssuerDL_{$key}').value)
                                                                                    + '&Restrictions=' + escape(document.getElementById('RestrictionsDL_{$key}').value)
                                                                                    + (document.getElementById('AMDL_{$key}').checked ? '+&AM=1' :'')
                                                                                    + (document.getElementById('A1DL_{$key}').checked ? '+&A1=1' :'')
                                                                                    + (document.getElementById('A2DL_{$key}').checked ? '+&A2=1' :'')
                                                                                    + (document.getElementById('ADL_{$key}').checked ? '+&A=1' :'')
                                                                                    + (document.getElementById('B1DL_{$key}').checked ? '+&B1=1' :'')
                                                                                    + (document.getElementById('BDL_{$key}').checked ? '+&B=1' :'')
                                                                                    + (document.getElementById('BEDL_{$key}').checked ? '+&BE=1' :'')
                                                                                    + (document.getElementById('C1DL_{$key}').checked ? '+&C1=1' :'')
                                                                                    + (document.getElementById('C1EDL_{$key}').checked ? '+&C1E=1' :'')
                                                                                    + (document.getElementById('CDL_{$key}').checked ? '+&C=1' :'')
                                                                                    + (document.getElementById('CEDL_{$key}').checked ? '+&CE=1' :'')
                                                                                    + (document.getElementById('D1DL_{$key}').checked ? '+&D1=1' :'')
                                                                                    + (document.getElementById('D1EDL_{$key}').checked ? '+&D1E=1' :'')
                                                                                    + (document.getElementById('DDL_{$key}').checked ? '+&D=1' :'')
                                                                                    + (document.getElementById('DEDL_{$key}').checked ? '+&DE=1' :'')
                                                                                    + (document.getElementById('TrDL_{$key}').checked ? '+&Tr=1' :'')
                                                                                    + (document.getElementById('TbDL_{$key}').checked ? '+&Tb=1' :'')
                                                                                    + (document.getElementById('TvDL_{$key}').checked ? '+&Tv=1' :'')
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Permis de Conducere"><b>Mod</b></a></div>{/if}
                                            </td>
                                            <td>{if $info.rw == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=delDL&Id={$key}'; return false;"
                                                                            title="{translate label='Sterge Permis de Conducere'}"><b>Del</b></a></div>{/if}</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Categorii de vehicule</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">

                                                <input type="checkbox" id="AMDL_{$key}" name="AMDL_{$key}" value="1" {if ($item.AM == 1)} checked {/if} />
                                                AM&nbsp;&nbsp;
                                                <input type="checkbox" id="A1DL_{$key}" name="A1DL_{$key}" value="1" {if ($item.A1 == 1)} checked {/if}/>
                                                A1
                                                <input type="checkbox" id="A2DL_{$key}" name="A2DL_{$key}" value="1" {if ($item.A2 == 1)} checked {/if}/>
                                                A2
                                                <input type="checkbox" id="ADL_{$key}" name="ADL_{$key}" value="1" {if ($item.A == 1)} checked {/if} />
                                                A
                                                <input type="checkbox" id="B1DL_{$key}" name="B1DL_{$key}" value="1" {if ($item.B1 == 1)} checked {/if} />
                                                B1
                                                <input type="checkbox" id="BDL_{$key}" name="BDL_{$key}" value="1" {if ($item.B == 1)} checked {/if} />
                                                B
                                                <input type="checkbox" id="BEDL_{$key}" name="BEDL_{$key}" value="1" {if ($item.BE == 1)} checked {/if} />
                                                BE
                                                <input type="checkbox" id="C1DL_{$key}" name="C1DL_{$key}" value="1" {if ($item.C1 == 1)} checked {/if} />
                                                C1
                                                <input type="checkbox" id="C1EDL_{$key}" name="C1EDL_{$key}" value="1" {if ($item.C1E == 1)} checked {/if} />
                                                C1E
                                                <input type="checkbox" id="CDL_{$key}" name="CDL_{$key}" value="1" {if ($item.C == 1)} checked {/if} />
                                                C
                                                <input type="checkbox" id="CEDL_{$key}" name="CEDL_{$key}" value="1" {if ($item.CE == 1)} checked {/if} />
                                                CE
                                                <input type="checkbox" id="D1DL_{$key}" name="D1DL_{$key}" value="1" {if ($item.D1 == 1)} checked {/if} />
                                                D1
                                                <input type="checkbox" id="D1EDL_{$key}" name="D1EDL_{$key}" value="1" {if ($item.D1E == 1)} checked {/if} />
                                                D1E
                                                <input type="checkbox" id="DDL_{$key}" name="DDL_{$key}" value="1" {if ($item.D == 1)} checked {/if} />
                                                D
                                                <input type="checkbox" id="DEDL_{$key}" name="DEDL_{$key}" value="1" {if ($item.DE == 1)} checked {/if} />
                                                DE
                                                <input type="checkbox" id="TrDL_{$key}" name="TrDL_{$key}" value="1" {if ($item.Tr == 1)} checked {/if} />
                                                Tr
                                                <input type="checkbox" id="TbDL_{$key}" name="TbDL_{$key}" value="1" {if ($item.Tb == 1)} checked {/if} />
                                                Tb
                                                <input type="checkbox" id="TvDL_{$key}" name="TvDL_{$key}" value="1" {if ($item.Tv == 1)} checked {/if} />
                                                Tv
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDateDL_0" name="ReleaseDateDL_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRDDL_0 = new CalendarPopup();
                                                calRDDL_0.isShowNavigationDropdowns = true;
                                                calRDDL_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRDDL_0.select(document.getElementById('ReleaseDateDL_0'),'anchorRDDL_0','dd.MM.yyyy'); return false;" NAME="anchorRDDL_0"
                                               ID="anchorRDDL_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDateDL_0" name="ExpirationDateDL_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calEDDL_0 = new CalendarPopup();
                                                calEDDL_0.isShowNavigationDropdowns = true;
                                                calEDDL_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calEDDL_0.select(document.getElementById('ExpirationDateDL_0'),'anchorEDDL_0','dd.MM.yyyy'); return false;" NAME="anchorEDDL_0"
                                               ID="anchorEDDL_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumberDL_0" name="DrivingLicenseNumberDL_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="IssuerDL_0" name="IssuerDL_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="RestrictionsDL_0" name="RestrictionsDL_0" size="50" maxlength="50"></td>
                                        <td colspan="2">
                                            {if $info.rw == 1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumberDL_0').value
                                                                                && document.getElementById('ReleaseDateDL_0').value
                                                                                && checkDate(document.getElementById('ReleaseDateDL_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDateDL_0').value
                                                                                && checkDate(document.getElementById('ExpirationDateDL_0').value, 'Data Expirare')
                                                                                && document.getElementById('IssuerDL_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID={$smarty.get.PersonID}&action=newDL&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumberDL_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDateDL_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateDL_0').value)
                                                                                + '&Issuer=' + document.getElementById('IssuerDL_0').value
                                                                                + '&Restrictions=' + document.getElementById('RestrictionsDL_0').value
                                                                                + (document.getElementById('AMDL_0').checked ? '+&AM=1' :'')
                                                                                + (document.getElementById('A1DL_0').checked ? '+&A1=1' :'')
                                                                                + (document.getElementById('A2DL_0').checked ? '+&A2=1' :'')
                                                                                + (document.getElementById('ADL_0').checked ? '+&A=1' :'')
                                                                                + (document.getElementById('B1DL_0').checked ? '+&B1=1' :'')
                                                                                + (document.getElementById('BDL_0').checked ? '+&B=1' :'')
                                                                                + (document.getElementById('BEDL_0').checked ? '+&BE=1' :'')
                                                                                + (document.getElementById('C1DL_0').checked ? '+&C1=1' :'')
                                                                                + (document.getElementById('C1EDL_0').checked ? '+&C1E=1' :'')
                                                                                + (document.getElementById('CDL_0').checked ? '+&C=1' :'')
                                                                                + (document.getElementById('CEDL_0').checked ? '+&CE=1' :'')
                                                                                + (document.getElementById('D1DL_0').checked ? '+&D1=1' :'')
                                                                                + (document.getElementById('D1EDL_0').checked ? '+&D1E=1' :'')
                                                                                + (document.getElementById('DDL_0').checked ? '+&D=1' :'')
                                                                                + (document.getElementById('DEDL_0').checked ? '+&DE=1' :'')
                                                                                + (document.getElementById('TrDL_0').checked ? '+&Tr=1' :'')
                                                                                + (document.getElementById('TbDL_0').checked ? '+&Tb=1' :'')
                                                                                + (document.getElementById('TvDL_0').checked ? '+&Tv=1' :'')
                                                                                ;
                                                                                else alert('Completati T Data Emitere, Data Expirare, Emitentul, Numarul Permisului de conducere'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div>{/if}

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Categorii de vehicule</td>
                                    </tr>
                                    <tr>

                                        <td colspan="6">

                                            <input type="checkbox" id="AMDL_0" name="AMDL_0" value="0" />
                                            AM&nbsp;&nbsp;
                                            <input type="checkbox" id="A1DL_0" name="A1DL_0" value="0"/>
                                            A1
                                            <input type="checkbox" id="A2DL_0" name="A2DL_0" value="0"/>
                                            A2
                                            <input type="checkbox" id="ADL_0" name="ADL_0" value="0" />
                                            A
                                            <input type="checkbox" id="B1DL_0" name="B1_0" value="0" />
                                            B1
                                            <input type="checkbox" id="BDL_0" name="BDL_0" value="0" />
                                            B
                                            <input type="checkbox" id="BEDL_0" name="BEDL_0" value="0" />
                                            BE
                                            <input type="checkbox" id="C1DL_0" name="C1DL_0" value="0" />
                                            C1
                                            <input type="checkbox" id="C1EDL_0" name="C1EDL_0" value="0" />
                                            C1E
                                            <input type="checkbox" id="CDL_0" name="CDL_0" value="0" />
                                            C
                                            <input type="checkbox" id="CEDL_0" name="CEDL_0" value="0" />
                                            CE
                                            <input type="checkbox" id="D1DL_0" name="D1DL_0" value="0" />
                                            D1
                                            <input type="checkbox" id="D1EDL_0" name="D1EDL_0" value="0" />
                                            D1E
                                            <input type="checkbox" id="DDL_0" name="DDL_0" value="0" />
                                            D
                                            <input type="checkbox" id="DEDL_0" name="DEDL_0" value="0" />
                                            DE
                                            <input type="checkbox" id="TrDL_0" name="TrDL_0" value="0" />
                                            Tr
                                            <input type="checkbox" id="TbDL_0" name="TbDL_0" value="0" />
                                            Tb
                                            <input type="checkbox" id="TvDL_0" name="TvDL_0" value="0" />
                                            Tv
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>


{literal}
<script type="text/javascript">
    function validateForm(f) {
        if (!is_empty(f.WorkTimeAt.value)) {
            return checkDate(f.WorkTimeAt.value, '{/literal}{translate label='Vechime totala la data'}{literal}');
        }
        if (!is_empty(f.DrivingStartDate.value)) {
            return checkDate(f.DrivingStartDate.value, '{/literal}{translate label='Data emitere permis'}{literal}');
        }
        if (!is_empty(f.DrivingStopDate.value)) {
            return checkDate(f.DrivingStopDate.value, '{/literal}{translate label='Data expirare permis'}{literal}');
        }
        return true;
    }
</script>

{/literal}

