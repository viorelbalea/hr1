<div class="submeniu">
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_SETTINGS.11_1 == 1}
        <a href="./?m=pontaj" class="unselected">Pontaj</a>
        <a href="./?m=pontaj&o=psimple" class="unselected">{translate label='Pontaj simplu'}</a>
        <a href="./?m=pontaj&o=projects"
           class="{if $smarty.get.o != 'edit_project'}un{/if}selected">{translate label='Proiecte'}</a>
        <a href="./?m=pontaj&o=new_project"
           class="{if $smarty.get.o != 'new_project'}un{/if}selected">{translate label='Adauga proiect'}</a>
    {else}
        <a href="./?m=pontaj" class="selected">{translate label='Proiecte'}</a>
    {/if}
    {if $smarty.session.USER_ID == 1 || !empty($smarty.session.REPORT_RIGHTS.11)}
        <a href="./?m=pontaj&o=reports" class="unselected">{translate label='Rapoarte'}</a>
    {/if}
</div>
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <form action="{$smarty.server.REQUEST_URI}" method="post" name="project" onsubmit="return validateForm(this);">
                <br>
                <fieldset>
                    <legend>{translate label='Date proiect'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        {if $err->getErrors()}
                            <tr>
                                <td colspan="4" style="color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
                            </tr>
                        {/if}
                        <tr>
                            <td><b>Cod proiect:*</b></td>
                            <td><input type="text" name="Code" value="{$info.Code|default:''}" size="20" maxlength="64"></td>
                            <td style="padding-left: 40px;"><b>{translate label='Partener'}:</b></td>
                            <td>
                                <select name="CompanyID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}" {if $key==$info.CompanyID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Denumire proiect'}:*</b></td>
                            <td><input type="text" name="Name" value="{$info.Name|default:''}" size="50" maxlength="255"></td>
                            <td style="padding-left: 40px;"><b>{translate label='Nr. contract'}:</b></td>
                            <td><input type="text" name="ContractNo" value="{$info.ContractNo|default:''}" size="20" maxlength="32">
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data de inceput'}:*</b></td>
                            <td>
                                <input type="text" name="StartDate" class="formstyle"
                                       value="{if !empty($info.StartDate) && $info.StartDate != '0000-00-00'}{$info.StartDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.project.StartDate,'anchor1','dd.MM.yyyy'); return false;"
                                   NAME="anchor1" ID="anchor1">{translate label='selecteaza data'}</A>
                            </td>
                            <td style="padding-left: 40px;"><b>{translate label='Data contract'}:</b></td>
                            <td>
                                <input type="text" name="ContractDate" class="formstyle"
                                       value="{if !empty($info.ContractDate) && $info.ContractDate != '0000-00-00'}{$info.ContractDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="jscd">
                                    var calcd = new CalendarPopup();
                                    calcd.isShowNavigationDropdowns = true;
                                    calcd.setYearSelectStartOffset(10);
                                    //writeSource("jscd");
                                </SCRIPT>
                                <A HREF="#"
                                   onClick="calcd.select(document.project.ContractDate,'anchorcd','dd.MM.yyyy'); return false;"
                                   NAME="anchorcd" ID="anchorcd">{translate label='selecteaza data'}</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data de incheiere'}:*</b></td>
                            <td>
                                <input type="text" name="EndDate" class="formstyle"
                                       value="{if !empty($info.EndDate) && $info.EndDate != '0000-00-00'}{$info.EndDate|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.project.EndDate,'anchor2','dd.MM.yyyy'); return false;"
                                   NAME="anchor2" ID="anchor2">{translate label='selecteaza data'}</A>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Data de incheiere revizuita'}:</b></td>
                            <td>
                                <input type="text" name="EndDateRevised" class="formstyle"
                                       value="{if !empty($info.EndDateRevised) && $info.EndDateRevised != '0000-00-00'}{$info.EndDateRevised|date_format:"%d.%m.%Y"}{/if}"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#"
                                   onClick="cal3.select(document.project.EndDateRevised,'anchor3','dd.MM.yyyy'); return false;"
                                   NAME="anchor3" ID="anchor3">{translate label='selecteaza data'}</A>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Statut proiect'}:*</b></td>
                            <td>
                                <select name="Type">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$types key=key item=item}
                                        <option value="{$key}"
                                                {if !empty($info.Type) && $info.Type==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Faza proiect'}:*</b></td>
                            <td>
                                <select name="Phase">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$phases key=key item=item}
                                        <option value="{$key}"
                                                {if !empty($info.Phase) && $info.Phase==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td>
                                {if !empty($smarty.get.ProjectID)}
                                    <input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                                    &nbsp;&nbsp;
                                    <input type="button" value="Duplicare proiect" class="formstyle"
                                           onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=pontaj&o=duplicate_project&ProjectID={$smarty.get.ProjectID}';">
                                {else}
                                    <input type="submit" value="Adauga proiect" class="formstyle">
                                {/if}
                                &nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}"
                                                   onclick="window.location.href = './?m=pontaj&o=projects';" class="formstyle">
                            </td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
            </form>
            {if !empty($smarty.get.ProjectID)}
                {foreach from=$activities item=item}
                    <form action="{$smarty.server.REQUEST_URI}&action=edit_activity&ActivityID={$item.ActivityID}" method="post"
                          name="activity{$item.ActivityID}" onsubmitx="return validateForm2(this);">
                        <fieldset>
                            <legend>{translate label='Activitate'}: {$item.Activity}</legend>
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr valign="top">
                                    <td>
                                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                            <tr>
                                                <td><b>Denumire:*</b></td>
                                                <td colspan="3"><input type="text" name="Activity" value="{$item.Activity}"
                                                                       size="50" maxlength="255"></td>
                                            </tr>
                                            <tr>
                                                <td><b>Data inceput:*</b></td>
                                                <td>
                                                    <input type="text" name="StartDate" class="formstyle"
                                                           value="{$item.StartDate|date_format:"%d.%m.%Y"}" size="10"
                                                           maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js{$item.ActivityID}_1">
                                                        var cal{$item.ActivityID}_1 = new CalendarPopup();
                                                        cal{$item.ActivityID}_1.isShowNavigationDropdowns = true;
                                                        cal{$item.ActivityID}_1.setYearSelectStartOffset(10);
                                                        //writeSource("js{$item.ActivityID}_1");
                                                    </SCRIPT>
                                                    <A HREF="#"
                                                       onClick="cal{$item.ActivityID}_1.select(document.activity{$item.ActivityID}.StartDate,'anchor{$item.ActivityID}_1','dd.MM.yyyy'); return false;"
                                                       NAME="anchor{$item.ActivityID}_1" ID="anchor{$item.ActivityID}_1"><img
                                                                src="images/cal.png" border="0"></A>
                                                </td>
                                                <td><b>Data incheiere:*</b></td>
                                                <td>
                                                    <input type="text" name="EndDate" class="formstyle"
                                                           value="{$item.EndDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                                    <SCRIPT LANGUAGE="JavaScript" ID="js{$item.ActivityID}_2">
                                                        var cal{$item.ActivityID}_2 = new CalendarPopup();
                                                        cal{$item.ActivityID}_2.isShowNavigationDropdowns = true;
                                                        cal{$item.ActivityID}_2.setYearSelectStartOffset(10);
                                                        //writeSource("js{$item.ActivityID}_2");
                                                    </SCRIPT>
                                                    <A HREF="#"
                                                       onClick="cal{$item.ActivityID}_2.select(document.activity{$item.ActivityID}.EndDate,'anchor{$item.ActivityID}_2','dd.MM.yyyy'); return false;"
                                                       NAME="anchor{$item.ActivityID}_2" ID="anchor{$item.ActivityID}_2"><img
                                                                src="images/cal.png" border="0"></A>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td style="border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;">
                                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                            <tr>
                                                <td>
                                                    <b>{translate label='Drepturi'}:*</b>
                                                    <br>
                                                    <table width="100%" cellspacing="0" cellpadding="4">
                                                        {foreach from=$roles key=RoleID item=Role name=iter}
                                                            {if $smarty.foreach.iter.iteration%4==1}<tr>{/if}
                                                            <td><input type="checkbox" name="Roles[{$RoleID}]" value="{$RoleID}"
                                                                       {if in_array($RoleID, $item.Roles)}checked{/if}> {$Role}</td>
                                                            {if $smarty.foreach.iter.iteration%4==0 || $smarty.foreach.iter.last}</tr>{/if}
                                                        {/foreach}
                                                    </table>
                                                </td>
                                            </tr>
                                        </table>
                                    </td>
                                    <td width="60" align="center"><b>Activa</b><br><br><input type="checkbox" name="Active"
                                                                                              value="1"
                                                                                              {if $item.Active==1}checked{/if}></td>
                                    <td width="30"><br><br>

                                        <div id="button_mod"><a href="#"
                                                                onclick="if (validateForm2(document.activity{$item.ActivityID})) document.activity{$item.ActivityID}.submit(); return false;"
                                                                title="Modifica activitate"><b>Mod</b></div>
                                        </a></td>
                                    <td width="30"><br><br>

                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceasta activitate?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=delete_activity&ActivityID={$item.ActivityID}'; return false;"
                                                                title="Sterge activitate"><b>Del</b></div>
                                        </a></td>
                                </tr>
                                <tr bgcolor="#dddddd">
                                    <td colspan="5"><b>{translate label='Apartine de fazele'}
                                            :</b>&nbsp;{foreach from=$phases key=key2 item=item2}<input type="checkbox"
                                                                                                        name="Phases[{$key2}]"
                                                                                                        value="{$key2}"
                                                                                                        {if in_array($key2, $item.Phases)}checked{/if}> {$item2}&nbsp;&nbsp;{/foreach}
                                    </td>
                                </tr>
                            </table>
                        </fieldset>
                    </form>
                {/foreach}
                <form action="{$smarty.server.REQUEST_URI}&action=new_activity" method="post" name="activity0"
                      onsubmitx="return validateForm2(this);">
                    <fieldset>
                        <legend>{translate label='Activitate noua'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr valign="top">
                                <td>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b>{translate label='Denumire'}:*</b></td>
                                            <td colspan="3"><input type="text" name="Activity" value="" size="50" maxlength="255">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label='Data inceput'}:*</b></td>
                                            <td>
                                                <input type="text" name="StartDate" class="formstyle"
                                                       value="{$info.StartDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js0_1">
                                                    var cal0_1 = new CalendarPopup();
                                                    cal0_1.isShowNavigationDropdowns = true;
                                                    cal0_1.setYearSelectStartOffset(10);
                                                    //writeSource("js0_1");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal0_1.select(document.activity0.StartDate,'anchor0_1','dd.MM.yyyy'); return false;"
                                                   NAME="anchor0_1" ID="anchor0_1"><img src="images/cal.png" border="0"></A>
                                            </td>
                                            <td><b>Data incheiere:*</b></td>
                                            <td>
                                                <input type="text" name="EndDate" class="formstyle"
                                                       value="{$info.EndDate|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js0_2">
                                                    var cal0_2 = new CalendarPopup();
                                                    cal0_2.isShowNavigationDropdowns = true;
                                                    cal0_2.setYearSelectStartOffset(10);
                                                    //writeSource("js0_2");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal0_2.select(document.activity0.EndDate,'anchor0_2','dd.MM.yyyy'); return false;"
                                                   NAME="anchor0_2" ID="anchor0_2"><img src="images/cal.png" border="0"></A>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="border-left: 1px solid #cccccc; border-right: 1px solid #cccccc;">
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td>
                                                <b>Drepturi:*</b>
                                                <br>
                                                <table width="100%" cellspacing="0" cellpadding="4">
                                                    {foreach from=$roles key=RoleID item=Role name=iter}
                                                        {if $smarty.foreach.iter.iteration%4==1}<tr>{/if}
                                                        <td><input type="checkbox" name="Roles[{$RoleID}]"
                                                                   value="{$RoleID}"> {$Role}</td>
                                                        {if $smarty.foreach.iter.iteration%4==0 || $smarty.foreach.iter.last}</tr>{/if}
                                                    {/foreach}
                                                </table>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td width="60">&nbsp;</td>
                                <td width="30">&nbsp;</td>
                                <td width="30" align="center"><br><br>

                                    <div id="button_add"><a href="#"
                                                            onclick="if (validateForm2(document.activity0)) document.activity0.submit(); return false;"
                                                            title="Adauga activitate"><b>Add</b></div>
                                    </a></td>
                            </tr>
                            <tr bgcolor="#dddddd">
                                <td colspan="5"><b>{translate label='Apartine de fazele'}
                                        :</b>&nbsp;{foreach from=$phases key=key2 item=item2}<input type="checkbox"
                                                                                                    name="Phases[{$key2}]"
                                                                                                    value="{$key2}"> {$item2}&nbsp;&nbsp;{/foreach}
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </form>
            {/if}
        </td>
    </tr>
</table>
{literal}
    <script language="javascript">
        function validateForm(f) {
            if (is_empty(f.Code.value)) {
                alert('Nu ati intodus Cod proiect !');
                return false;
            }
            if (is_empty(f.Name.value)) {
                alert('Nu ati intodus Denumire proiect !');
                return false;
            }
            if (is_empty(f.StartDate.value)) {
                alert('Nu ati specificat Data de inceput !');
                return false;
            }
            if (!checkDate(f.StartDate.value, 'Data de inceput')) {
                return false;
            }
            if (is_empty(f.EndDate.value)) {
                alert('Nu ati specificat Data de incheiere !');
                return false;
            }
            if (!checkDate(f.EndDate.value, 'Data de incheiere')) {
                return false;
            }
            if (!is_empty(f.EndDateRevised.value) && !checkDate(f.EndDateRevised.value, 'Data de incheiere revizuita')) {
                return false;
            }
            if (f.Type.value == 0) {
                alert('Nu ati specificat Statut proiect !');
                return false;
            }
            if (f.Phase.value == 0) {
                alert('Nu ati specificat faza proiect !');
                return false;
            }
            return true;
        }

        function validateForm2(f) {
            if (is_empty(f.Activity.value)) {
                alert('Nu ati intodus Denumire activitate !');
                return false;
            }
            if (is_empty(f.StartDate.value)) {
                alert('Nu ati specificat Data de inceput !');
                return false;
            }
            if (!checkDate(f.StartDate.value, 'Data de inceput')) {
                return false;
            }
            if (is_empty(f.EndDate.value)) {
                alert('Nu ati specificat Data de incheiere !');
                return false;
            }
            if (!checkDate(f.EndDate.value, 'Data de incheiere')) {
                return false;
            }
            return true;
        }
    </script>
{/literal}