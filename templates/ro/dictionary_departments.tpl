{include file="dictionary_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Nivele organigrama'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 1px; padding-top: 10px;">
            <form action="./?m=dictionary&o=division" method="post">
                <fieldset>
                    <legend>{translate label='Nivel 1'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume'}</td>
                                        <td>{translate label='Cod'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$divisions key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Division_{$key}" name="Division_{$key}" value="{$item.Division}" size="70" class="cod"></td>
                                            <td><input type="text" id="DivCode_{$key}" name="DivCode_{$key}" value="{$item.Code}" size="6" maxlength="64" class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_div_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Division_{$key}').value) || is_empty(document.getElementById('DivCode_{$key}').value)) alert('{translate label='Nu ati introdus Nume sau Cod!'}'); else window.location.href = './?m=dictionary&o=division&DivisionID={$key}&Division=' + escape(document.getElementById('Division_{$key}').value) + '&Code=' + escape(document.getElementById('DivCode_{$key}').value) + '&Status=' + (document.getElementById('Status_div_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=division&DivisionID={$key}&delDivision=1'; return false;"
                                                                            title="{translate label='Sterge'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Division_0" name="Division_0" size="70" class="cod"></td>
                                            <td><input type="text" id="DivCode_0" name="DivCode_0" size="6" maxlength="64" class="cod"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Division_0').value) || is_empty(document.getElementById('DivCode_0').value)) alert('{translate label='Nu ati introdus Nume sau Cod!'}'); else window.location.href = './?m=dictionary&o=division&DivisionID=0&Division=' + escape(document.getElementById('Division_0').value) + '&Code=' + escape(document.getElementById('DivCode_0').value); return false;"
                                                                        title="{translate label='Adauga'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
        </td>
    </tr>
    <tr>
        <td rowspan="2" class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="{$smarty.server.REQUEST_URI}" method="post">
                <fieldset>
                    <legend>{translate label='Nivel 2'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume'}</td>
                                        <td>{translate label='Cod'}</td>
                                        <td>{translate label='Nivel 1'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$departments key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Department_{$key}" name="Department_{$key}" value="{$item.Department}" size="70" class="cod"></td>
                                            <td><input type="text" id="DepCode_{$key}" name="DepCode_{$key}" value="{$item.Code}" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DivisionID_dep_{$key}" id="DivisionID_dep_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>{foreach from=$divisions_dep key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.DivisionID}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Department_{$key}').value)) alert('{translate label='Nu ati introdus Nume!'}'); else {literal}{{/literal}var uphis = ({$item.DivisionID} > 0 && document.getElementById('DivisionID_dep_{$key}').value != {$item.DivisionID} && confirm('{translate label='Acest departament era alocat altui nivel, doriti actualizarea datelor istorice in tabelel implicate?'}')) == true ? 1 : 0; window.location.href = './?m=dictionary&o=department&DepartmentID={$key}&Department=' + escape(document.getElementById('Department_{$key}').value) + '&Code=' + escape(document.getElementById('DepCode_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0) + '&DivisionID=' + document.getElementById('DivisionID_dep_{$key}').value + '&uphis=' + uphis;{literal}}{/literal} return false;"
                                                                            title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=department&DepartmentID={$key}&delDepartment=1'; return false;"
                                                                            class="button_del" title="{translate label='Sterge'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Department_0" name="Department_0" size="70" class="cod"></td>
                                            <td><input type="text" id="DepCode_0" name="DepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DivisionID_dep_0" id="DivisionID_dep_0" class="dropdown">
                                                    <option value="0">alege...</option>{foreach from=$divisions_dep key=key2 item=item2}
                                                    <option value="{$key2}">{$item2}</option>{/foreach}</select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Department_0').value)) alert('{translate label='Nu ati introdus Nume!'}'); else window.location.href = './?m=dictionary&o=department&DepartmentID=0&Department=' + escape(document.getElementById('Department_0').value) + '&Code=' + escape(document.getElementById('DepCode_0').value) + '&DivisionID=' + document.getElementById('DivisionID_dep_0').value; return false;"
                                                                        title="{translate label='Adauga'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="{$smarty.server.REQUEST_URI}" method="post">
                <fieldset>
                    <legend>{translate label='Nivel 3'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume'}</td>
                                        <td>{translate label='Cod'}</td>
                                        <td>{translate label='Nivel 2'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$subdepartments key=key item=item}
                                        <tr>
                                            <td><input type="text" id="SubDepartment_{$key}" name="SubDepartment_{$key}" value="{$item.SubDepartment}" size="70" class="cod"></td>
                                            <td><input type="text" id="SubDepCode_{$key}" name="SubDepCode_{$key}" value="{$item.Code}" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DepartmentID_{$key}" id="DepartmentID_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>{foreach from=$departments key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.DepartmentID}selected{/if}>{$item2.Department}</option>{/foreach}</select></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('SubDepartment_{$key}').value)) alert('{translate label='Nu ati introdus Nume!'}'); else {literal}{{/literal} window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID={$key}&SubDepartment=' + escape(document.getElementById('SubDepartment_{$key}').value) + '&Code=' + escape(document.getElementById('SubDepCode_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0) + '&DepartmentID=' + document.getElementById('DepartmentID_{$key}').value ;{literal}}{/literal} return false;"
                                                                            title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID={$key}&delSubDepartment=1'; return false;"
                                                                            class="button_del" title="{translate label='Sterge'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="SubDepartment_0" name="SubDepartment_0" size="70" class="cod"></td>
                                            <td><input type="text" id="SubDepCode_0" name="SubDepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DepartmentID_0" id="DepartmentID_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>{foreach from=$departments key=key2 item=item2}
                                                    <option value="{$key2}">{$item2.Department}</option>{/foreach}</select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('SubDepartment_0').value)) alert('{translate label='Nu ati introdus Nume!'}'); else window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID=0&SubDepartment=' + escape(document.getElementById('SubDepartment_0').value) + '&Code=' + escape(document.getElementById('SubDepCode_0').value) + '&DepartmentID=' + document.getElementById('DepartmentID_0').value; return false;"
                                                                        title="{translate label='Adauga'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="{$smarty.server.REQUEST_URI}" method="post">
                <fieldset>
                    <legend>{translate label='Nivel 4'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume'}</td>
                                        <td>{translate label='Cod'}</td>
                                        <td>{translate label='Nivel 3'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$subsubdepartments key=key item=item}
                                        <tr>
                                            <td><input type="text" id="SubSubDepartment_{$key}" name="SubSubDepartment_{$key}" value="{$item.SubSubDepartment}" size="70"
                                                       class="cod"></td>
                                            <td><input type="text" id="SubSubDepCode_{$key}" name="SubSubDepCode_{$key}" value="{$item.Code}" size="14" maxlength="64" class="cod">
                                            </td>
                                            <td><select name="SubDepartmentID_{$key}" id="SubDepartmentID_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>{foreach from=$subdepartments key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.SubDepartmentID}selected{/if}>{$item2.SubDepartment}</option>{/foreach}</select></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('SubSubDepartment_{$key}').value)) alert('{translate label='Nu ati introdus Nume!'}'); else {literal}{{/literal} window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID={$key}&SubSubDepartment=' + escape(document.getElementById('SubSubDepartment_{$key}').value) + '&Code=' + escape(document.getElementById('SubSubDepCode_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0) + '&SubDepartmentID=' + document.getElementById('SubDepartmentID_{$key}').value ;{literal}}{/literal} return false;"
                                                                            title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID={$key}&delSubSubDepartment=1'; return false;"
                                                                            class="button_del" title="{translate label='Sterge'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="SubSubDepartment_0" name="SubSubDepartment_0" size="70" class="cod"></td>
                                            <td><input type="text" id="SubSubDepCode_0" name="SubSubDepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="SubDepartmentID_0" id="SubDepartmentID_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>{foreach from=$subdepartments key=key2 item=item2}
                                                    <option value="{$key2}">{$item2.SubDepartment}</option>{/foreach}</select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('SubSubDepartment_0').value)) alert('{translate label='Nu ati introdus Nume!'}'); else window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID=0&SubSubDepartment=' + escape(document.getElementById('SubSubDepartment_0').value) + '&Code=' + escape(document.getElementById('SubSubDepCode_0').value) + '&SubDepartmentID=' + document.getElementById('SubDepartmentID_0').value; return false;"
                                                                        title="{translate label='Adauga'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista departamentelor care apar in aplicatie'}</span></td>
    </tr>
</table>