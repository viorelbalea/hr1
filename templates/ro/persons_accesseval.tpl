{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
            <br>
            <fieldset>
                <legend>{translate label='Calificative evaluari'}</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Data initiala'}</td>
                        <td>{translate label='Data finala'}</td>
                        <td>{translate label='Calificativ'}</td>
                        <td>{translate label='Observatii'}</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {foreach from=$persons key=key item=item}
                        {if $key > 0}
                            <tr>
                                <form action="{$smarty.server.REQUEST_URI}&action=edit_pers&ID={$key}" method="post" name="pers_{$key}">
                                    <td>
                                        <input type="text" id="StartDate" name="StartDate" class="formstyle" value="{$item.DataIni}" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                            var cal1_{$key} = new CalendarPopup();
                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                            cal1_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js1_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_{$key}.select(document.pers_{$key}.StartDate,'anchor1_{$key}','dd.MM.yyyy'); return false;" NAME="anchor1_{$key}"
                                           ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate" name="StopDate" class="formstyle" value="{if $item.DataFin != '00-00-0000'}{$item.DataFin}{/if}" size="10"
                                               maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                            var cal2_{$key} = new CalendarPopup();
                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                            cal2_{$key}.setYearSelectStartOffset(10);
                                            //writeSource("js2_{$key}");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_{$key}.select(document.pers_{$key}.StopDate,'anchor2_{$key}','dd.MM.yyyy'); return false;" NAME="anchor2_{$key}"
                                           ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td><input type="text" name="Calificativ" value="{$item.Calificativ}" size="30"></td>
                                    <td><input type="text" name="Observatii" value="{$item.Observatii}" size="30"></td>
                                    {if $persons.0.rw==1 || $smarty.session.USER_ID == 1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.pers_{$key}.Calificativ.value) && document.pers_{$key}.StartDate.value && checkDate(document.pers_{$key}.StartDate.value, 'Data initiala') && (is_empty(document.pers_{$key}.StopDate.value) || checkDate(document.pers_{$key}.StopDate.value, 'Data finala'))) document.pers_{$key}.submit(); else alert('{translate label='Completati Calificativ, Data initiala ! '}'); return false;"
                                                                    title="{translate label='Modifica evaluarea'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del_eval&ID={$key}"
                                                                    onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                    title="{translate label='Sterge evaluarea'}"><b>Del</b></a></div>
                                        </td>
                                    {else}
                                        <td colspan="2">&nbsp;</td>
                                    {/if}
                                </form>
                            </tr>
                        {/if}
                    {/foreach}
                    <tr>
                        <form action="{$smarty.server.REQUEST_URI}&action=new_eval" method="post" name="pers_0">
                            <td>
                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.pers_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.pers_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td><input type="text" name="Calificativ" size="30"></td>
                            <td><input type="text" name="Observatii" size="30"></td>
                            {if $persons.0.rw==1 || $smarty.session.USER_ID == 1}
                                <td align="center">
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.pers_0.Calificativ.value) && document.pers_0.StartDate.value && checkDate(document.pers_0.StartDate.value, 'Data initiala') && (is_empty(document.pers_0.StopDate.value) || checkDate(document.pers_0.StopDate.value, 'Data finala'))) document.pers_0.submit(); else alert('Completati Calificativul, Data initiala !'); return false;"
                                                            title="{translate label='Adauga evaluare'}"><b>Add</b></a></div>
                                </td>
                            {/if}
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                </table>
            </fieldset>
        </td>
    </tr>
</table>
<form action="{$smarty.server.REQUEST_URI}" method="post" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend>{translate label='Acces evaluari'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="400">
                        <tr>
                            <td><input type="checkbox" name="accesseval[1]" value="1" {if $info.AccessEval == 1 || $info.AccessEval == 3}checked{/if} /></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate crea formulare evaluari'}</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="accesseval[2]" value="2" {if $info.AccessEval == 2 || $info.AccessEval == 3}checked{/if}></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate fi mediator de evaluari'}</td>
                        </tr>
                        {if $info.rw==1}
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td><input type="submit" name="saveEval" value="{translate label='Salveaza'}" class="formstyle"></td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>

<form action="{$smarty.server.REQUEST_URI}" method="post" name="persColleagues" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend>{translate label='Acces feedback'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="400">
                        <tr>
                            <td><input type="checkbox" name="colleaguesaccesseval[1]" value="1"
                                       {if $info_colleagues.AccessColleaguesEval == 1 || $info_colleagues.AccessColleaguesEval == 3}checked{/if} /></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate crea formulare feedback'}</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="colleaguesaccesseval[2]" value="2"
                                       {if $info_colleagues.AccessColleaguesEval == 2 || $info_colleagues.AccessColleaguesEval == 3}checked{/if}></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate oferi feedback'}</td>
                        </tr>
                        {if $info.rw==1}
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td><input type="submit" name="saveColleaguesEval" value="{translate label='Salveaza'}" class="formstyle"></td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>

<form action="{$smarty.server.REQUEST_URI}" method="post" name="survey" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend>{translate label='Acces studii'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="400">
                        <tr>
                            <td><input type="checkbox" name="survey[1]" value="1" {if $info_survey.AccessSurvey == 1 || $info_survey.AccessSurvey == 3}checked{/if} /></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate crea formulare studii'}</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="survey[2]" value="2" {if $info_survey.AccessSurvey == 2 || $info_survey.AccessSurvey == 3}checked{/if}></td>
                            <td style="text-align: left; padding-top: 10px;">{translate label='Poate realiza studii'}</td>
                        </tr>
                        {if $info.rw==1}
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td><input type="submit" name="saveSurvey" value="{translate label='Salveaza'}" class="formstyle"></td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
