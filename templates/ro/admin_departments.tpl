{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label=' Divizii / Departamente'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 1px; padding-top: 10px;">
            <form action="./?m=admin&o=division" method="post">
                <fieldset>
                    <legend>{translate label='Divizii'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label=' Nume divizie'}</td>
                                        <td>{translate label=' Cod'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$divisions key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Division_{$key}" name="Division_{$key}" value="{$item.Division}" size="24" maxlength="128" class="cod"></td>
                                            <td><input type="text" id="DivCode_{$key}" name="DivCode_{$key}" value="{$item.Code}" size="6" maxlength="64" class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_div_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Division_{$key}').value) || is_empty(document.getElementById('DivCode_{$key}').value)) alert('{translate label=' Nu ati introdus Nume divizie sau Cod!'}'); else window.location.href = './?m=admin&o=division&DivisionID={$key}&Division=' + escape(document.getElementById('Division_{$key}').value) + '&Code=' + escape(document.getElementById('DivCode_{$key}').value) + '&Status=' + (document.getElementById('Status_div_{$key}').checked ? 1 : 0); return false;"
                                                                        title="Modifica divizie"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=division&DivisionID={$key}&delDivision=1'; return false;"
                                                                        title="Sterge divizie"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="Division_0" name="Division_0" size="24" maxlength="128" class="cod"></td>
                                        <td><input type="text" id="DivCode_0" name="DivCode_0" size="6" maxlength="64" class="cod"></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (is_empty(document.getElementById('Division_0').value) || is_empty(document.getElementById('DivCode_0').value))alert('{translate label=' Nu ati introdus Nume divizie sau Cod!'}'); else window.location.href = './?m=admin&o=division&DivisionID=0&Division=' + escape(document.getElementById('Division_0').value) + '&Code=' + escape(document.getElementById('DivCode_0').value); return false;"
                                                                    title="Adauga divizie"><b>Add</b></a></div>
                                        </td>
                                    </tr>
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
                    <legend>{translate label='Departamente '}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume departament'}</td>
                                        <td>{translate label=' Cod'}</td>
                                        <td>{translate label=' Nume divizie'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$departments key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Department_{$key}" name="Department_{$key}" value="{$item.Department}" size="40" maxlength="128" class="cod">
                                            </td>
                                            <td><input type="text" id="DepCode_{$key}" name="DepCode_{$key}" value="{$item.Code}" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DivisionID_dep_{$key}" id="DivisionID_dep_{$key}" class="dropdown">
                                                    <option value="0">alege divizia...</option>{foreach from=$divisions_dep key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.DivisionID}selected{/if}>{$item2}</option>{/foreach}</select></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Department_{$key}').value)) alert('{translate label='Nu ati introdus Nume departament!'}'); else {literal}{{/literal}var uphis = ({$item.DivisionID} > 0 && document.getElementById('DivisionID_dep_{$key}').value != {$item.DivisionID} && confirm('{translate label='Acest departament era alocat altei divizii, doriti actualizarea datelor istorice in tabelel implicate?'}')) == true ? 1 : 0; window.location.href = './?m=admin&o=department&DepartmentID={$key}&Department=' + escape(document.getElementById('Department_{$key}').value) + '&Code=' + escape(document.getElementById('DepCode_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0) + '&DivisionID=' + document.getElementById('DivisionID_dep_{$key}').value + '&uphis=' + uphis;{literal}}{/literal} return false;"
                                                                        title="Modifica departament"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=department&DepartmentID={$key}&delDepartment=1'; return false;"
                                                                        class="button_del" title="Sterge departament"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="Department_0" name="Department_0" size="40" maxlength="128" class="cod"></td>
                                        <td><input type="text" id="DepCode_0" name="DepCode_0" size="14" maxlength="64" class="cod"></td>
                                        <td><select name="DivisionID_dep_0" id="DivisionID_dep_0" class="dropdown">
                                                <option value="0">alege divizia...</option>{foreach from=$divisions_dep key=key2 item=item2}
                                                <option value="{$key2}">{$item2}</option>{/foreach}</select></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (is_empty(document.getElementById('Department_0').value)) alert('{translate label='Nu ati introdus Nume departament!'}'); else window.location.href = './?m=admin&o=department&DepartmentID=0&Department=' + escape(document.getElementById('Department_0').value) + '&Code=' + escape(document.getElementById('DepCode_0').value) + '&DivisionID=' + document.getElementById('DivisionID_dep_0').value; return false;"
                                                                    title="Adauga departament"><b>{translate label='Add'}</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista diviziilor care apar in aplicatie '}</span></td>
    </tr>
</table>