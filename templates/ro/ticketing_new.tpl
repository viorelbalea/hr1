{include file="ticketing_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.get.TicketID)}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="ticketing_submenu.tpl"}</span></td>
        </tr>
    {else}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare tichet'}</span></td>
        </tr>
    {/if}
    {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>

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

<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="fticket">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding: 0 0 10px 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Categorie'}</legend>
                    <select name="CategoryID" style="width: 150px" onchange="updateFieldsByCategory(this.value)">
                        {foreach from=$categories key=key item=item}
                            <option value="{$key}" {if $info.CategoryID == $key}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
            </td>
            <td class="celulaMenuDR" width="50%">&nbsp;</td>
        </tr>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Emitent'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Intern solicitat de'}:*</b></td>
                            <td>
                                <select name="PersonID">
                                    <option value="0"></option>
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}" {if $info.PersonID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Client'}:*</b></td>
                            <td>
                                <select name="CompanyID" id="CompanyID"
                                        onchange="updateFields(this.value); LoadComputerName(this.value, {if ($info.ComputerName=='')}0{else}{$info.ComputerName}{/if});">
                                    <option value="0"></option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}" {if $info.CompanyID == $key}selected{/if}>{$item.CompanyName}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Contract'}:</b></td>
                            <td>
                                <select name="ContractID" id="ContractID">
                                    <option value="0"></option>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Extern solicitat de'}:</b></td>
                            <td>
                                <select name="ContactID" id="ContactID" onchange="displayContact(this.value)">
                                    <option value="0"></option>
                                </select>
                                <div id="contact_info" style="padding-top: 10px;"></div>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td><b>{translate label='Proiect'}:</b></td>
                            <td>
                                <select name="ProjectID" id="ProjectID">
                                    <option value="0"></option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Centru de cost'}:</b></td>
                            <td>
                                <select name="CostCenterID" id="CostCenterID">
                                    <option value="0"></option>
                                    {foreach from=$costcenter key=key item=item}
                                        <option value="{$key}" {if $info.CostCenterID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii tichet'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Titlu'}:</b></td>
                            <td><input type="text" name="Title" value="{$info.Title}" size="40" maxlength="255"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Status tichet'}:</b></td>
                            <td>
                                <select name="Status">
                                    <option value="0"></option>
                                    {foreach from=$status key=key item=item}
                                        <option value="{$key}" {if $info.Status == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <select name="AssignedPersonID">
                                    <option value="0">{translate label='Asignare tichet'}</option>
                                    {foreach from=$persons key=key item=item}
                                        <option value="{$key}" {if $info.AssignedPersonID == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        {if !empty($smarty.get.TicketID)}
                            <tr>
                                <td><b>{translate label='Data tichet'}:</b></td>
                                <td>{$info.CreateDate|date_format:'%d.%m.%Y %H:%M'}</td>
                            </tr>
                        {/if}
                        <tr>
                            <td><b>{translate label='Prioritate'}:*</b></td>
                            <td>
                                <select name="Priority" id="Priority">
                                    <option value="0"></option>
                                    {foreach from=$priority key=key item=item}
                                        <option value="{$key}" {if $info.Priority == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Importanta'}:*</b></td>
                            <td>
                                <select name="Importance" id="Importance">
                                    <option value="0"></option>
                                    {foreach from=$importance key=key item=item}
                                        <option value="{$key}" {if $info.Importance == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Tip tichet'}:*</b></td>
                            <td>
                                <select name="Type" id="Type">
                                    <option value="0"></option>
                                    {foreach from=$types key=key item=item}
                                        <option value="{$key}" {if $info.Type == $key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr id="tr_AppVersion">
                            <td><b>{translate label='Versiunea'}:</b></td>
                            <td>
                                {if $info.AppVersionID > 0 && $info.AppVersionObject.Status == 0}
                                    {$info.AppVersionObject.DisplayVersion}
                                {else}
                                    <select name="AppVersionID">
                                        <option value="0"></option>
                                        {foreach from=$application_version key=key item=item}
                                            <option value="{$key}" {if $info.AppVersionID == $key}selected{/if}>{$item.DisplayVersion}</option>
                                        {/foreach}
                                    </select>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Raspuns (min)'}:</b></td>
                            <td><input type="text" name="ResponseTime" value="{$info.ResponseTime}" size="5" maxlength="5"></td>
                        </tr>
                        <tr>
                            <td><b>{translate label='Remediere (min)'}:</b></td>
                            <td><input type="text" name="RemedialTime" value="{$info.RemedialTime}" size="5" maxlength="5"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%" id="table_details">
        <tr>
            <td class="celulaMenuSTDR" colspan=2" style="vertical-align: top; padding: 10px 0 10px 10px;">
                <a href="#"
                   onclick="if (document.getElementById('additional_details').style.display == 'none') Effect.SlideDown('additional_details'); else Effect.SlideUp('additional_details'); return false;">{translate label="Detalii suplimentare tichet"}</a>
                <div id="additional_details" style="display: none;">
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td style="vertical-align: top;" width="50%">
                                <br>
                                <fieldset>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b>{translate label="Tipul interventiei"}:</b></td>
                                            <td>
                                                <select name="InterventionType" id="InterventionType">
                                                    <option value="0"></option>
                                                    {foreach from=$intervention_type key=key item=item}
                                                        <option value="{$key}" {if $info.InterventionType == $key}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Timp de transport (min)"}:</b></td>
                                            <td><input type="text" name="TransportTime" value="{$info.TransportTime}" size="5" maxlength="5"><span
                                                        style="margin-left:10px; font-weight:bold;">{translate label="(transport dus/intors)"}</span></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Timp incepere interventie"}:</b></td>
                                            <td>
                                                <input type="text" name="InterventionStartDate" class="formstyle"
                                                       value="{if !empty($info.InterventionStartDate) && $info.InterventionStartDate != '0000-00-00 00:00:00'}{$info.InterventionStartDate|date_format:"%d.%m.%Y"}{/if}"
                                                       size="10" maxlength="10"/>
                                                <input type="text" name="InterventionStartHour" class="formstyle"
                                                       value="{if !empty($info.InterventionStartDate) && $info.InterventionStartDate != '0000-00-00 00:00:00'}{$info.InterventionStartDate|date_format:"%H:%M"}{else}00:00{/if}"
                                                       size="5" maxlength="5"/>
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                                    var cal1 = new CalendarPopup();
                                                    cal1.isShowNavigationDropdowns = true;
                                                    cal1.setYearSelectStartOffset(10);
                                                    //writeSource("js1");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1.select(document.fticket.InterventionStartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1"
                                                   ID="anchor1" title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data"
                                                                                                                 align="absbottom"></A>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Timp finalizare interventie"}:</b></td>
                                            <td>
                                                <input type="text" name="InterventionEndDate" class="formstyle"
                                                       value="{if !empty($info.InterventionEndDate) && $info.InterventionEndDate != '0000-00-00 00:00:00'}{$info.InterventionEndDate|date_format:"%d.%m.%Y"}{/if}"
                                                       size="10" maxlength="10"/>
                                                <input type="text" name="InterventionEndHour" class="formstyle"
                                                       value="{if !empty($info.InterventionEndDate) && $info.InterventionEndDate != '0000-00-00 00:00:00'}{$info.InterventionEndDate|date_format:"%H:%M"}{else}00:00{/if}"
                                                       size="5" maxlength="5"/>
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                                    var cal2 = new CalendarPopup();
                                                    cal2.isShowNavigationDropdowns = true;
                                                    cal2.setYearSelectStartOffset(10);
                                                    //writeSource("js2");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2.select(document.fticket.InterventionEndDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2"
                                                   ID="anchor2" title="{translate label='selecteaza data'}"><img src="./images/cal.png" border="0" alt="selecteaza data"
                                                                                                                 align="absbottom"></A>
                                            </td>
                                        </tr>
                                        {if !empty($smarty.get.TicketID) && $info.InterventionStartDate > '0000-00-00 00:00:00' && $info.InterventionEndDate > '0000-00-00 00:00:00'}
                                            <tr>
                                                <td><b>{translate label="Timp de remediere"}:</b></td>
                                                <td>{$info.InterventionDuration}</td>
                                            </tr>
                                            <tr>
                                                <td><b>{translate label="Timp total interventie"}:</b></td>
                                                <td>{$info.InterventionTotalDuration}</td>
                                            </tr>
                                        {/if}
                                    </table>
                                </fieldset>
                            </td>
                            <td style="vertical-align: top; padding-right: 10px;" width="50%">
                                <br>
                                <fieldset>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b>{translate label="Nume computer"}:</b></td>
                                            <td>
                                                <div id="DivComputerName">
                                                    <select name="ComputerName" id="ComputerName">
                                                        <option value="0">{translate label="Nume computer"}</option>
                                                    </select>
                                                </div>
                                                <!--
				<input type="text" name="ComputerName" value="{$info.ComputerName}" size="30"></td>
					-->
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Nume utilizator"}:</b></td>
                                            <td><input type="text" name="UserName" value="{$info.UserName}" size="30"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Locatie"}:</b></td>
                                            <td><input type="text" name="Location" value="{$info.Location}" size="30"></td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Motiv business"}:</b></td>
                                            <td><textarea name="BusinessReason" rows="4" cols="50" style="width: 100%">{$info.BusinessReason|default:''}</textarea></td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%" id="table_position">
        <tr>
            <td class="celulaMenuSTDR" colspan=2" style="vertical-align: top; padding: 10px 0 10px 10px;">
                <a href="#"
                   onclick="if (document.getElementById('position_details').style.display == 'none') Effect.SlideDown('position_details'); else Effect.SlideUp('position_details'); return false;">{translate label="Detalii pozitie"}</a>
                <div id="position_details" style="display: none;">
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td style="vertical-align: top;" width="50%">
                                <br>
                                <fieldset>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <!--<tr>
				<td><b>{translate label="Compania"}:</b></td>
				<td>
				    <select name="CompanyID" onchange="showInfo('ajax.php?o=functionsbycompany&CompanyID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_InternalFunctions');">
					<option value="0">{translate label='alege...'}</option>                                                                                                      
					{foreach from=$self key=key item=item}
					<option value="{$key}" {if !empty($info.CompanyID) && $key == $info.CompanyID}selected{/if}>{$item}</option>
					{/foreach}
				    </select>
				</td>
			    </tr>-->
                                        <tr>
                                            <td><b>{translate label="Divizia"}:</b></td>
                                            <td>
                                                <select name="DivisionID" onchange="showInfo('ajax.php?o=department&DivisionID=' + this.value, 'div_DepartmentID');">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$divisions key=key item=item}
                                                        <option value="{$key}" {if !empty($info.DivisionID) && $key == $info.DivisionID}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Departamentul"}:</b></td>
                                            <td>
                                                <div id="div_DepartmentID">
                                                    <select name="DepartmentID">
                                                        <option value="0">{translate label='alege...'}</option>
                                                        {foreach from=$departments key=key item=item}
                                                            <option value="{$key}" {if !empty($info.DepartmentID) && $key == $info.DepartmentID}selected{/if}>{$item}</option>
                                                        {/foreach}
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Functia interna"}:</b></td>
                                            <td>
                                                <div id="div_InternalFunctions">-</div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Job"}:</b></td>
                                            <td>
                                                <select name="JobID"
                                                        onchange="document.getElementById('jobview').innerHTML = document.getElementById('jobviewh').innerHTML.replace('[[jobid]]', this.value);">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$jobs key=key item=item}
                                                        <option value="{$key}" {if !empty($info.JobID) && $key == $info.JobID}selected{/if}>{$jobs_title.$item}</option>
                                                    {/foreach}
                                                </select>
                                                <span id="jobview">{if !empty($info.JobID)}<a href="#"
                                                                                              onclick="if(confirm('{translate label='Sunteti sigur(a) ca vreti sa parasiti pagina curenta'}?')) window.location.href = './?m=jobs&o=edit&JobID={$info.JobID}'; return false;">{translate label='vezi job'}</a>{/if}</span>
                                                <span id="jobviewh" style="display:none"><a href="#"
                                                                                            onclick="if(confirm('{translate label='Sunteti sigur(a) ca vreti sa parasiti pagina curenta'}?')) window.location.href = './?m=jobs&o=edit&JobID=[[jobid]]'; return false;">{translate label='vezi job'}</a></span>
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </td>
                            <td style="vertical-align: top; padding-right: 10px;" width="50%">
                                <br>
                                <fieldset>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b>{translate label="Profesia"}:</b></td>
                                            <td>
                                                <select name="JobDictionaryID">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$jobs_title key=key item=item}
                                                        <option value="{$key}"
                                                                {if !empty($info.JobDictionaryID) && $key == $info.JobDictionaryID}selected{/if}>{translate label=$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Nivel de instruire"}:</b></td>
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
                                            <td><b>{translate label="Manager direct"}:</b></td>
                                            <td>
                                                <select name="DirectManagerID">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$directmanager key=key item=item}
                                                        <option value="{$key}" {if !empty($info.DirectManagerID) && $key == $info.DirectManagerID}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b>{translate label="Manager functional"}:</b></td>
                                            <td>
                                                <select name="FunctionalManagerID">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$directmanager key=key item=item}
                                                        <option value="{$key}"
                                                                {if !empty($info.FunctionalManagerID) && $key == $info.FunctionalManagerID}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                        </tr>
                                    </table>
                                </fieldset>
                            </td>
                        </tr>
                    </table>
                </div>
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%" id="table_prcomp">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Competente'}</legend>
                    <textarea name="Competences" rows="10" cols="50" style="width: 100%">{$info.Competences|default:''}</textarea>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Profil'}</legend>
                    <textarea name="Profile" rows="10" cols="50" style="width: 100%">{$info.Profile|default:''}</textarea>
                </fieldset>
            </td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Descriere'}*</legend>
                    <textarea name="Notes" rows="10" cols="50" style="width: 100%">{$info.Notes|default:''}</textarea>
                    <p>{translate label='Incarca document'}: <input type="file" name="doc"></p>
                    {if !empty($docs)}
                        <table border="0" cellpadding="4" cellspacing="0">
                            {foreach from=$docs key=doc item=docname}
                                <tr>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_doc&doc=' + escape('{$doc}'); return false;"
                                                                title="{translate label='Sterge document'}"><b>Del</b></a></div>
                                    </td>
                                    <td><a href="{$doc}" target="_blank">{$docname}</a></td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;" width="50%">
                <br>
                <fieldset>
                    <legend>{translate label='Comentarii'}</legend>
                    <textarea name="Notes2" rows="10" cols="50" style="width: 100%">{$info.Notes2|default:''}</textarea>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" colspan="2" style="padding: 10px;">
                {if !empty($smarty.get.TicketID)}
                    {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                {else}
                    <input type="submit" value="{translate label='Adauga tichet'}" class="formstyle">
                {/if}
        </tr>
        {if !empty($smarty.get.TicketID)}
            <tr>
                <td class="celulaMenuST" colspan="2" style="padding: 0 0 10px 10px;" width="100%">
                    <br>
                    <fieldset>
                        <legend>{translate label='Evolutie tichet'}</legend>
                        <br>
                        <table border="0" cellpadding="6" cellspacing="0" class="screen">
                            <tr>
                                <td><b>{translate label='Data'}</b></td>
                                <td><b>{translate label='Status'}</b></td>
                                <td><b>{translate label='User'}</b></td>
                                <td><b>{translate label='Prioritate'}</b></td>
                                <td><b>{translate label='Importanta'}</b></td>
                                <td><b>{translate label='Tip tichet'}</b></td>
                                <td><b>{translate label='User Last'}</b></td>
                                <td><b>{translate label='Descriere'}</b></td>
                                <td>&nbsp;</td>
                            </tr>
                            {foreach from=$history item=item}
                                <tr>
                                    <td>{$item.CreateDate|date_format:'%d.%m.%Y %H:%M'}</td>
                                    <td>{$status[$item.Status]}</td>
                                    <td>{if $item.Status == 1}{$item.FullNameLast}{else}{$item.FullName}{/if}</td>
                                    <td>{$priority[$item.Priority]|default:'-'}</td>
                                    <td>{$importance[$item.Importance]|default:'-'}</td>
                                    <td>{$types[$item.Type]|default:'-'}</td>
                                    <td>{$item.FullNameLast}</td>
                                    <td>
                                        {if $smarty.session.USER_ID == 1 || ($smarty.session.USER_ID == $item.UserID && $smarty.session.PERS == $item.PID)}
                                            <input type="hidden" id="Comment_{$item.ID}" value="{$info.Comment}">
                                            <span id="Comment_{$item.ID}_display"></span>
                                            [
                                            <a href="#" title="{$info.Comment|escape:'javascript'}"
                                               onclick="getNotes('Comment_{$item.ID}'); return false;">{translate label='Editare'}</a>
                                            ]
                                        {/if}
                                    </td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=save_comment&ID={$item.ID}&Comment=' + escape(document.getElementById('Comment_{$item.ID}').value); return false;"
                                                                title="{translate label='salveaza'}"><b>Mod</b></a></div>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td>{$info.LastUpdateDate|date_format:'%d.%m.%Y %H:%M'}</td>
                                <td>{$status[$info.Status]}</td>
                                <td>{if !empty($info.AssignedPersonID)}{$persons[$info.AssignedPersonID]}{else}{$info.UserLast}{/if}</td>
                                <td>{$priority[$info.Priority]}</td>
                                <td>{$importance[$info.Importance]}</td>
                                <td>{$types[$info.Type]}</td>
                                <td>{$info.UserLast}</td>
                                <td>
                                    {if $smarty.session.USER_ID == 1 || ($smarty.session.USER_ID == $info.UserIDLast && $smarty.session.PERS == $info.PIDLast)}
                                        <input type="hidden" id="Comment_0" value="{$info.Comment}">
                                        <span id="Comment_0_display"></span>
                                        [
                                        <a href="#" title="{$info.Comment|escape:'javascript'}" onclick="getNotes('Comment_0'); return false;">{translate label='Editare'}</a>
                                        ]
                                    {/if}
                                </td>
                                <td>
                                    <div id="button_mod"><a href="#"
                                                            onclick="window.location.href = '{$smarty.server.REQUEST_URI}&action=save_comment&Comment=' + escape(document.getElementById('Comment_0').value); return false;"
                                                            title="{translate label='salveaza'}"><b>Mod</b></a></div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        {/if}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

{literal}
<script type="text/javascript">
    function LoadComputerName(CompId, CurValue) {
        var url = './ajax.php?o=LoadComputerName&CompanyID=' + CompId + '&CurValue=' + CurValue;
        jQuery('#DivComputerName').load(url);
    }

    jQuery(document).ready(function () {
        var v1 = document.getElementById('CompanyID').value;
        {/literal}
        var v2 = {if ($info.ComputerName=='')}0{else}{$info.ComputerName}{/if};
        {literal}
        LoadComputerName(v1, v2);
    });

    function updateFields(index) {
        document.getElementById('ContactID').options.length = 1;
        document.getElementById('contact_info').innerHTML = '';
        document.getElementById('ContractID').options.length = 1;
        document.getElementById('ProjectID').options.length = 1;
        if (index == 0) {
            return;
        }
        {/literal}
        {foreach from=$companies key=key item=item}
        if ({$key} == index
    )
            {literal}{{/literal}
            {foreach from=$item.Contracts key=key2 item=item2}
            AddSelectOption(document.getElementById('ContractID'), '{$item2}', '{$key2}', {if !empty($info.ContractID) && $info.ContractID == $key2}true{else}false{/if});
            {/foreach}
            {foreach from=$item.Contacts key=key2 item=item2}
            AddSelectOption(document.getElementById('ContactID'), '{$item2.ContactName}', '{$key2}|{$item2.ContactFunction}|{$item2.ContactPhone}|{$item2.ContactEmail}', {if !empty($info.ContactID) && $info.ContactID == $key2|cat:'|'|cat:$item2.ContactFunction|cat:'|'|cat:$item2.ContactPhone|cat:'|'|cat:$item2.ContactEmail}true{else}false{/if});
            {/foreach}
            {foreach from=$item.Projects key=key2 item=item2}
            AddSelectOption(document.getElementById('ProjectID'), '{$item2.Code} - {$item2.Name}', '{$key2}', {if !empty($info.ProjectID) && $info.ProjectID == $key2}true{else}false{/if});
            {/foreach}
            {literal}}{/literal}
        {/foreach}
        {literal}
    }

    function AddSelectOption(selectObj, text, value, isSelected) {
        if (selectObj != null && selectObj.options != null) {
            selectObj.options[selectObj.options.length] = new Option(text, value, false, isSelected);
        }
    }

    function displayContact(index) {
        if (index == 0) {
            document.getElementById('contact_info').innerHTML = '';
            return;
        }
        contactObj = document.getElementById('ContactID');
        for (var i = 1; i < contactObj.options.length; i++) {
            if (contactObj.options[i].value == index) {
                var parts = contactObj.options[i].value.split('|');
                document.getElementById('contact_info').innerHTML = (is_empty(parts[1]) ? '' : parts[1]) + (is_empty(parts[2]) ? '' : '<br>Phone: ' + parts[2]) + (is_empty(parts[3]) ? '' : '<br>Email: ' + parts[3]);
            }
        }
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

    function updateFieldsByCategory(category_id) {
        switch (category_id) {
            case '1':
            default:
            {/literal}
            {$java1}
            {literal}
                document.getElementById('tr_AppVersion').style.display = '';
                document.getElementById('table_details').style.display = '';
                document.getElementById('table_position').style.display = 'none';
                document.getElementById('table_prcomp').style.display = 'none';
                {/literal}{if $smarty.get.o == 'edit'}return;{/if}{literal}
                var cc_options = document.getElementById('CostCenterID').options;
                var cc_len = cc_options.length;
                for (i = 0; i < cc_len; i++) {
                    if (cc_options[i].value == 8) {
                        document.getElementById('CostCenterID').selectedIndex = i;
                        break;
                    }
                }
                var pr_options = document.getElementById('Priority').options;
                var pr_len = pr_options.length;
                for (i = 0; i < pr_len; i++) {
                    if (pr_options[i].value == 2) {
                        document.getElementById('Priority').selectedIndex = i;
                        break;
                    }
                }
                var im_options = document.getElementById('Importance').options;
                var im_len = im_options.length;
                for (i = 0; i < im_len; i++) {
                    if (im_options[i].value == 2) {
                        document.getElementById('Importance').selectedIndex = i;
                        break;
                    }
                }
                var ty_options = document.getElementById('Type').options;
                var ty_len = ty_options.length;
                for (i = 0; i < ty_len; i++) {
                    if (ty_options[i].value == 2) {
                        document.getElementById('Type').selectedIndex = i;
                        break;
                    }
                }
                var in_options = document.getElementById('InterventionType').options;
                var in_len = in_options.length;
                for (i = 0; i < in_len; i++) {
                    if (in_options[i].value == 1) {
                        document.getElementById('InterventionType').selectedIndex = i;
                        break;
                    }
                }
                break;
            case '2':
            {/literal}
            {$java2}
            {literal}
                document.getElementById('tr_AppVersion').style.display = '';
                document.getElementById('table_details').style.display = '';
                document.getElementById('table_position').style.display = 'none';
                document.getElementById('table_prcomp').style.display = 'none';
                {/literal}{if $smarty.get.o == 'edit'}return;{/if}{literal}
                var cc_options = document.getElementById('CostCenterID').options;
                var cc_len = cc_options.length;
                for (i = 0; i < cc_len; i++) {
                    if (cc_options[i].value == 7) {
                        document.getElementById('CostCenterID').selectedIndex = i;
                        break;
                    }
                }
                var pr_options = document.getElementById('Priority').options;
                var pr_len = pr_options.length;
                for (i = 0; i < pr_len; i++) {
                    if (pr_options[i].value == 2) {
                        document.getElementById('Priority').selectedIndex = i;
                        break;
                    }
                }
                var im_options = document.getElementById('Importance').options;
                var im_len = im_options.length;
                for (i = 0; i < im_len; i++) {
                    if (im_options[i].value == 2) {
                        document.getElementById('Importance').selectedIndex = i;
                        break;
                    }
                }
                var ty_options = document.getElementById('Type').options;
                var ty_len = ty_options.length;
                for (i = 0; i < ty_len; i++) {
                    if (ty_options[i].value == 1) {
                        document.getElementById('Type').selectedIndex = i;
                        break;
                    }
                }
                var in_options = document.getElementById('InterventionType').options;
                var in_len = in_options.length;
                for (i = 0; i < in_len; i++) {
                    if (in_options[i].value == 1) {
                        document.getElementById('InterventionType').selectedIndex = i;
                        break;
                    }
                }
                break;
            case '3':
            {/literal}
            {$java3}
            {if $smarty.get.o == 'new'}
                document.getElementById('CostCenterID').selectedIndex = 0;
                document.getElementById('Priority').selectedIndex = 0;
                document.getElementById('Importance').selectedIndex = 0;
                document.getElementById('Type').selectedIndex = 0;
                document.getElementById('InterventionType').selectedIndex = 0;
            {/if}
            {literal}
                document.getElementById('tr_AppVersion').style.display = 'none';
                document.getElementById('table_details').style.display = 'none';
                document.getElementById('table_position').style.display = '';
                document.getElementById('table_prcomp').style.display = '';
                break;
        }
    }

    updateFieldsByCategory('{/literal}{$info.CategoryID|default:1}{literal}');
</script>
{/literal}

{if !empty($info.CompanyID)}
    <script type="text/javascript">updateFields({$info.CompanyID});</script>
{/if}
{if !empty($smarty.get.TicketID)}
    <script type="text/javascript">displayContact('{$info.ContactID}');</script>
{/if}
{if $info.CategoryID == 3}
    <script type="text/javascript">
        showInfo('ajax.php?o=functionsbycompany&CompanyID=' + {$info.CompanyID} +'&FunctionID=' + {$info.InternalFunction} +'&rand=' + parseInt(Math.random() * 999999999), 'div_InternalFunctions');
        showInfo('ajax.php?o=department&DivisionID=' + {$info.DivisionID} +'&DepartmentID=' + {$info.DepartmentID} +'&rand=' + parseInt(Math.random() * 999999999), 'div_DepartmentID');
    </script>
{/if}
	