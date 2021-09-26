{include file="persons_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
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
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Incadrare'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Marca'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="EmpCode" value="{$info.EmpCode|default:''}" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Buget'}:</b></td>
                            <td style="padding-top: 10px;">
                                <table cellspacing="0" cellpadding="0">
                                    {foreach from=$costcenter_persons key=key item=item}
                                        <tr>
                                            <td style="padding-right: 10px;">
                                                <select id="CostCenterID_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$costcenter key=key2 item=item2}
                                                        <option value="{$key2}" {if $key2 == $item}selected{/if}>{$item2}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            {if $info.rw==1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CostCenterID_{$key}').value > 0) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit&ID={$key}&CostCenterID=' + document.getElementById('CostCenterID_{$key}').value; else alert('{translate label='Nu ati ales centrul de cost!'}'); return false;"
                                                                            title="{translate label='Modifica centru de cost'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del&ID={$key}&CostCenterID=' + document.getElementById('CostCenterID_{$key}').value; return false;"
                                                                            title="{translate label='Sterge centru de cost'}"><b>Del</b></a></div>
                                                </td>
                                            {else}
                                                <td colspan="2">&nbsp;</td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td style="padding-right: 10px;">
                                            <select id="CostCenterID" class="dropdown">
                                                <option value="0"></option>
                                                {foreach from=$costcenter key=key item=item}
                                                    <option value="{$key}">{$item}</option>
                                                {/foreach}
                                            </select>
                                        </td>
                                        <td colspan="2">{if $info.rw==1}
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CostCenterID').value > 0) window.location.href = '{$smarty.server.REQUEST_URI}&action=new&CostCenterID=' + document.getElementById('CostCenterID').value; else alert('{translate label='Nu ati ales centrul de cost!'}'); return false;"
                                                                        title="{translate label='Adauga centru de cost'}"><b>Add</b></a></div>{else}&nbsp;{/if}</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Sef compartiment'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DirectManagerID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$directmanager key=key item=item}
                                        <option value="{$key}" {if !empty($info.DirectManagerID) && $key == $info.DirectManagerID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Manager delegat'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="FunctionalManagerID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$directmanager key=key item=item}
                                        <option value="{$key}" {if !empty($info.FunctionalManagerID) && $key == $info.FunctionalManagerID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <!--<tr>
                            <td style="padding-top: 10px;"><b>{translate label='Responsabil aprobare concediu<br>(implicit Manager Direct)'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="VacationManagerID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$directmanager key=key item=item}
                                        <option value="{$key}" {if !empty($info.VacationManagerID) && $key == $info.VacationManagerID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Evaluator I'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID">
                                    <option value="0">{translate label='alege evaluator I...'}</option>
                                    {foreach from=$managers key=key item=item}
                                        <option value="{$key}" {if !empty($info.ManagerID) && $info.ManagerID==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="ManagerIDOld" value="{$info.ManagerID|default:0}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Contrasemnatar I'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID2">
                                    <option value="0">{translate label='alege contrasemnatar I...'}</option>
                                    {foreach from=$managers key=key item=item}
                                        <option value="{$key}" {if !empty($info.ManagerID2) && $info.ManagerID2==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="ManagerIDOld2" value="{$info.ManagerID2|default:0}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Contrasemnatar II'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID3">
                                    <option value="0">{translate label='alege contrasemnatar II...'}</option>
                                    {foreach from=$managers key=key item=item}
                                        <option value="{$key}" {if !empty($info.ManagerID3) && $info.ManagerID3==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="ManagerIDOld3" value="{$info.ManagerID3|default:0}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Contrasemnatar III'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID4">
                                    <option value="0">{translate label='alege contrasemnatar III...'}</option>
                                    {foreach from=$managers key=key item=item}
                                        <option value="{$key}" {if !empty($info.ManagerID4) && $info.ManagerID4==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="ManagerIDOld4" value="{$info.ManagerID4|default:0}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Indrumator'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID5">
                                    <option value="0">{translate label='alege Indrumator...'}</option>
                                    {foreach from=$managers key=key item=item}
                                        <option value="{$key}" {if !empty($info.ManagerID5) && $info.ManagerID5==$key}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="ManagerIDOld5" value="{$info.ManagerID5|default:0}">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Institutie'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="CompanyID" class="dropdown"
                                        onchange="showInfo('ajax.php?o=functionsbycompany&CompanyID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_InternalFunctions');">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$self key=key item=item}
                                        <option value="{$key}" {if !empty($info.CompanyID) && $key == $info.CompanyID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Organigrama Nivel 1'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DivisionID" onchange="showInfo('ajax.php?o=department&DivisionID=' + this.value, 'DepartmentID');" class="dropdown">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$divisions key=key item=item}
                                        <option value="{$key}" {if !empty($info.DivisionID) && $key == $info.DivisionID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Organigrama Nivel 2'}:</b></td>
                            <td style="padding-top: 10px;">
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
                            <td style="padding-top: 10px;"><b>{translate label='Organigrama Nivel 3'}:</b></td>
                            <td style="padding-top: 10px;">
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
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Organigrama Nivel 4'}:</b></td>
                            <td style="padding-top: 10px;">
                                <div id="SubSubDepartmentID">
                                    <select name="SubSubDepartmentID" class="dropdown">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$subsubdepartments key=key item=item}
                                            <option value="{$key}" {if !empty($info.SubSubDepartmentID) && $key == $info.SubSubDepartmentID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Transe de vechime'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="TranseVechime" class="dropdown">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$transeVechime key=key item=item}
                                        <option value="{$key}" {if !empty($info.TranseVechime) && $key == $info.TranseVechime}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b>{translate label='Cod COR'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="FunctionID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$functions key=key item=item}
                                        <option value="{$key}" {if !empty($info.FunctionID) && $key == $info.FunctionID}selected{/if}>{$item.Function} - {$item.COR}</option>
                                    {/foreach}
                                </select>
                                <input type="hidden" name="FunctionIDOld" value="{$info.FunctionID|default:0}">
                                {if !empty($functionsh)}
                                    <br>
                                    <p><a href="#"
                                          onclick="var status = document.getElementById('div_func').style.display; if (status == 'none') Effect.SlideDown('div_func'); else Effect.SlideUp('div_func'); return false;"><b>{translate label='Istoric functii'}</b></a>
                                    </p>
                                    <div id="div_func" style="display:none;">
                                        {foreach from=$functionsh key=key item=item name=iter}
                                            <table cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td colspan="3" {if !$smarty.foreach.iter.first}style="padding-top: 10px; border-top: 1px solid #cccccc;"{/if}>
                                                        <b>{$functions[$item.FunctionID].Function} - {$functions[$item.FunctionID].COR}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 10px;">
                                                        <input type="text" id="StartDate_{$key}" class="formstyle"
                                                               value="{if !empty($item.StartDate) && $item.StartDate != '0000-00-00'}{$item.StartDate|date_format:"%d.%m.%Y"}{/if}"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_{$key}">
                                                            var cal1_{$key} = new CalendarPopup();
                                                            cal1_{$key}.isShowNavigationDropdowns = true;
                                                            cal1_{$key}.setYearSelectStartOffset(10);
                                                            //writeSource("js1_{$key}");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal1_{$key}.select(document.getElementById('StartDate_{$key}'),'anchor1_{$key}','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_{$key}" ID="anchor1_{$key}"><img src="./images/cal.png" border="0"></A>
                                                        <input type="text" id="EndDate_{$key}" class="formstyle"
                                                               value="{if !empty($item.EndDate) && $item.EndDate != '0000-00-00'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_{$key}">
                                                            var cal2_{$key} = new CalendarPopup();
                                                            cal2_{$key}.isShowNavigationDropdowns = true;
                                                            cal2_{$key}.setYearSelectStartOffset(10);
                                                            //writeSource("js2_{$key}");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal2_{$key}.select(document.getElementById('EndDate_{$key}'),'anchor2_{$key}','dd.MM.yyyy'); return false;"
                                                           NAME="anchor2_{$key}" ID="anchor2_{$key}"><img src="./images/cal.png" border="0"></A>
                                                    </td>
                                                    <td width="20" align="right">{if $info.rw == 1}
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (checkDate(document.getElementById('StartDate_{$key}').value, 'Data inceput') && checkDate(document.getElementById('EndDate_{$key}').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&FID={$item.FID}&StartDate=' + document.getElementById('StartDate_{$key}').value + '&EndDate=' + document.getElementById('EndDate_{$key}').value; return false;"
                                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                                    <td width="20" align="right">{if $info.rw == 1}
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&FID={$item.FID}&del=1'; return false;"
                                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                                </tr>
                                            </table>
                                            <br>
                                        {/foreach}
                                    </div>
                                {/if}

                            </td>
                        </tr>
                        <!--<tr>
                            <td style="padding-top: 10px;"><b>{translate label='Grupa de munca'}:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="WorkGroup" value="{$info.WorkGroup|default:''}" size="30" maxlength="32"></td>
                        </tr>-->
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Functia interna'}:</b></td>
                            <td style="padding-top: 10px;">
                                <div style="float:left;" id="div_InternalFunctions"></div>
                                <!--<select name="InternalFunction">
			    <option value="0">{translate label='alege...'}</option>
			    {foreach from=$internal_functions item=item}
				{foreach from=$item key=key2 item=item2 name=iter2}
				{if $smarty.foreach.iter2.first}<optgroup label="{$item2.GroupName}">{/if}
				<option value="{$key2}" {if $key2==$info.InternalFunction}selected{/if}>{$item2.Function} [{$item2.GroupName} | {$item2.Grad}]</option>
				{if $smarty.foreach.iter2.last}</optgroup>{/if}
				{/foreach}
			    {/foreach}
			</select>
			-->
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--<input type="checkbox" value="1" name="Trainer" {if $info.Trainer==1}checked="checked"{/if}/> Trainer-->
                                <input type="hidden" name="InternalFunctionOld" value="{$info.InternalFunction|default:0}">
                                {if !empty($internal_functionsh)}
                                    <br>
                                    <p><a href="#"
                                          onclick="var status = document.getElementById('div_internal_func').style.display; if (status == 'none') Effect.SlideDown('div_internal_func'); else Effect.SlideUp('div_internal_func'); return false;"><b>{translate label='Istoric functii interne'}</b></a>
                                    </p>
                                    <div id="div_internal_func" style="display:none;">
                                        {foreach from=$internal_functionsh key=key item=item name=iter}
                                            <table cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td colspan="3" {if !$smarty.foreach.iter.first}style="padding-top: 10px; border-top: 1px solid #cccccc;"{/if}>
                                                        <b>{foreach from=$internal_functions key=key2 item=item2}{if isset($item2[$item.FunctionID])}{$item2[$item.FunctionID].Function} [{$item2[$item.FunctionID].GroupName} | {$item2[$item.FunctionID].Grad}]{/if}{/foreach}</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 10px;">
                                                        <input type="text" id="StartDate_i_{$key}" class="formstyle"
                                                               value="{if !empty($item.StartDate) && $item.StartDate != '0000-00-00'}{$item.StartDate|date_format:"%d.%m.%Y"}{/if}"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_i_{$key}">
                                                            var cal1_i_{$key} = new CalendarPopup();
                                                            cal1_i_{$key}.isShowNavigationDropdowns = true;
                                                            cal1_i_{$key}.setYearSelectStartOffset(10);
                                                            //writeSource("js1_i_{$key}");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal1_i_{$key}.select(document.getElementById('StartDate_i_{$key}'),'anchor1_i_{$key}','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_i_{$key}" ID="anchor1_i_{$key}"><img src="./images/cal.png" border="0"></A>
                                                        <input type="text" id="EndDate_i_{$key}" class="formstyle"
                                                               value="{if !empty($item.EndDate) && $item.EndDate != '0000-00-00'}{$item.EndDate|date_format:"%d.%m.%Y"}{/if}"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_i_{$key}">
                                                            var cal2_i_{$key} = new CalendarPopup();
                                                            cal2_i_{$key}.isShowNavigationDropdowns = true;
                                                            cal2_i_{$key}.setYearSelectStartOffset(10);
                                                            //writeSource("js2_i_{$key}");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal2_i_{$key}.select(document.getElementById('EndDate_i_{$key}'),'anchor2_i_{$key}','dd.MM.yyyy'); return false;"
                                                           NAME="anchor2_i_{$key}" ID="anchor2_i_{$key}"><img src="./images/cal.png" border="0"></A>
                                                    </td>
                                                    <td width="20" align="right">{if $info.rw == 1}
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (checkDate(document.getElementById('StartDate_i_{$key}').value, 'Data inceput') && checkDate(document.getElementById('EndDate_i_{$key}').value, 'Data sfarsit')) window.location.href = '{$smarty.server.REQUEST_URI}&internal=1&FID={$item.FID}&StartDate=' + document.getElementById('StartDate_i_{$key}').value + '&EndDate=' + document.getElementById('EndDate_i_{$key}').value; return false;"
                                                                                    title="{translate label='Modifica'}"><b>Mod</b></a></div>{/if}</td>
                                                    <td width="20" align="right">{if $info.rw == 1}
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&FID={$item.FID}&delinternal=1'; return false;"
                                                                                    title="{translate label='Sterge'}"><b>Del</b></a></div>{/if}</td>
                                                </tr>
                                            </table>
                                            <br>
                                        {/foreach}
                                    </div>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Observatii functia CIM'}:</b></td>
                            <td style="padding-top: 10px;"><textarea name="CIMFunction" rows="6" cols="60" wrap="soft">{$info.CIMFunction|default:''}</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Locatie'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="SiteID">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$sites key=key item=item}
                                        <option value="{$key}" {if !empty($info.SiteID) && $key == $info.SiteID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>{translate label='Interval depunere declaratie avere'}:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DeclaratieAvere">
                                    <option value="0">{translate label='alege...'}</option>
                                    <option value="1"
                                            {if !empty($info.DeclaratieAvere) && '1' == $info.DeclaratieAvere}selected{/if}>{translate label='Anual / aferent an fiscal anterior'}</option>
                                    <option value="2"
                                            {if !empty($info.DeclaratieAvere) && '2' == $info.DeclaratieAvere}selected{/if}>{translate label='30 de zile de la data numirii sau alegerii in functie'}</option>
                                    <option value="3"
                                            {if !empty($info.DeclaratieAvere) && '3' == $info.DeclaratieAvere}selected{/if}>{translate label='30 de zile de la data incetarii activitatii'}</option>
                                    <option value="4"
                                            {if !empty($info.DeclaratieAvere) && '4' == $info.DeclaratieAvere}selected{/if}>{translate label='30 de zile de la data inceperii activitatii'}</option>
                                    <option value="5"
                                            {if !empty($info.DeclaratieAvere) && '5' == $info.DeclaratieAvere}selected{/if}>{translate label='plecarea din institutie a personalului de conducere / executie'}</option>
                                    <option value="6"
                                            {if !empty($info.DeclaratieAvere) && '5' == $info.DeclaratieAvere}selected{/if}>{translate label='30 de zile de la data incetarii suspendarii pentru personalul suspendat pe o perioada ce acopera un an fiscal'}</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style="padding-top: 29px;">{if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}"
                                                                                                            class="formstyle">{/if} <input type="button"
                                                                                                                                           value="{translate label='Anuleaza'}"
                                                                                                                                           onclick="window.location='./?m=persons'"
                                                                                                                                           class="formstyle"></td>
                        </tr>

                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Descriere job'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td colspan="2">
                                <b>{translate label='Fisa post'}:</b><br>
                                <input type="file" name="JDFile">
                                {if isset($info.JDFilePath)}
                                    <a href="{$info.JDFilePath}" title="" target="_blank">{translate label='Vizualizeaza'}</a>
                                    &nbsp;|&nbsp;
                                    <a href="#"
                                       onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest document?'}')) window.location.href='./?m=persons&o=del_jd_file&PersonID={$smarty.get.PersonID}'; return false;"
                                       title="{translate label='Sterge'} class=" blue
                                    ">{translate label='sterge'}</a>
                                {/if}
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b>{translate label='Descriere rol'}:</b><br>
                                <textarea name="RolDescr" style="width: 100%" cols="40" rows="10" wrap="soft">{$info.RolDescr|default:''}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 13px">
                                <b>{translate label='Responsabilitati principale'}:</b><br>
                                <textarea name="RespMain" style="width: 100%" rows="10" wrap="soft">{$info.RespMain|default:''}</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 13px">
                                <b>{translate label='Responsabilitati generale'}:</b><br>
                                <textarea name="RespGen" style="width: 100%" rows="10" wrap="soft">{$info.RespGen|default:''}</textarea>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <fieldset>
                    <legend>{translate label='Istoric functii'}</legend>
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_hmod').style.display; if (status == 'none') Effect.SlideDown('div_hmod'); else Effect.SlideUp('div_hmod'); return false;"><b>{translate label='Istoric'}</b></a>
                    </p>
                    <div id="div_hmod" style="display:none;">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><b>{translate label='Tip'}</b></td>
                                <td><b>{translate label='Denumire'}</b></td>
                                <td><b>{translate label='Data inceput'}</b></td>
                                <td><b>{translate label='Data sfarsit'}</b></td>
                                <td><b>{translate label='Data modificare'}</b></td>
                            </tr>
                            {foreach from=$cfunctionsh item=func key=key}
                                <tr>
                                    <td>{if $func.Type == 1}{translate label='Cod COR'}{elseif $func.Type == 2}{translate label='Functie interna'}{/if}</td>
                                    <td>{$func.FName}</td>
                                    <td>{$func.StartDate}</td>
                                    <td>{$func.EndDate}</td>
                                    <td>{$func.CreateDate}</td>
                                </tr>
                            {/foreach}
                        </table>
                    </div>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    showInfo('ajax.php?o=functionsbycompany&CompanyID=' + {$info.CompanyID} +'&FunctionID=' + {$info.InternalFunction} +'&rand=' + parseInt(Math.random() * 999999999), 'div_InternalFunctions');
</script>
