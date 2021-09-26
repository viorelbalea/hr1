{include file="dictionary_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Grupa de functii interne'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 1px; padding-top: 10px;">
            <form action="./?m=dictionary&o=groups" method="post">
                <fieldset>
                    <legend>{translate label='Grupe de functii'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Grupa de functii '}</td>
                                        <td>{translate label='Ord. '}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$groups key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Group_{$key}" name="Group_{$key}" value="{$item.GroupName}" size="24" maxlength="128" class="cod"></td>
                                            <td><input type="text" id="Grad_{$key}" name="Grad_{$key}" value="{$item.Grad}" size="6" maxlength="64" class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Group_{$key}').value) || is_empty(document.getElementById('Grad_{$key}').value)) alert('{translate label='Nu ati introdus Grupa de functii sau Grad!'}'); else window.location.href = './?m=dictionary&o=groups&GroupID={$key}&Group=' + escape(document.getElementById('Group_{$key}').value) + '&Grad=' + escape(document.getElementById('Grad_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica grupa de functii'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=groups&GroupID={$key}&delGroup=1'; return false;"
                                                                            title="{translate label='Sterge grupa de functii'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Group_0" name="Group_0" size="24" maxlength="128" class="cod"></td>
                                            <td><input type="text" id="Grad_0" name="Grad_0" size="6" maxlength="64" class="cod"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Group_0').value) || is_empty(document.getElementById('Grad_0').value)) alert('Nu ati introdus Grupa de functii sau Grad!'); else window.location.href = './?m=dictionary&o=groups&GroupID=0&Group=' + escape(document.getElementById('Group_0').value) + '&Grad=' + escape(document.getElementById('Grad_0').value); return false;"
                                                                        title="{translate label='Adauga grupa de functii'}"><b>Add</b></a></div>
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
                    <legend>{translate label='Functii interne'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume functie'}</td>
                                        <td>{translate label='Nume grupa'}</td>
                                        <td>{translate label=' Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$functions key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Function_{$key}" name="Function_{$key}" value="{$item.Function}" size="40" maxlength="128" class="cod"></td>
                                            <td><select name="GroupID_{$key}" id="GroupID_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege grupa...'}</option>{foreach from=$groups_func key=key2 item=item2}
                                                    <option value="{$key2}" {if $key2==$item.GroupID}selected{/if}>{$item2.GroupName}</option>{/foreach}</select>
                                            </td>
                                            <td align="center"><input type="checkbox" id="Statusf_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Function_{$key}').value) || document.getElementById('GroupID_{$key}').selectedIndex == 0) alert('{translate label='Nu ati introdus Nume functie sau Grupa de functii!'}'); else window.location.href = './?m=dictionary&o=function_group&FunctionID={$key}&Function=' + escape(document.getElementById('Function_{$key}').value) + '&Status=' + (document.getElementById('Statusf_{$key}').checked ? 1 : 0) + '&GroupID=' + document.getElementById('GroupID_{$key}').value; return false;"
                                                                            title="{translate label='Modifica functie'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=function_group&FunctionID={$key}&delFunction=1'; return false;"
                                                                            class="button_del" title="{translate label='Sterge functie'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="font-weight: bold;">Grad / Treapta</td>
                                                        <td style="font-weight: bold;">Studii</td>
                                                        <td style="font-weight: bold;">Gradatie</td>
                                                        <td style="font-weight: bold;">Coeficient</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr></tr>

                                                </table>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Function_0" name="Function_0" size="40" maxlength="128" class="cod"></td>
                                            <td><select name="GroupID_0" id="GroupID_0" class="dropdown">
                                                    <option value="0">{translate label='alege grupa...'}</option>{foreach from=$groups_func key=key2 item=item2}
                                                    <option value="{$key2}">{$item2.GroupName} - {$item2.Grad}</option>{/foreach}</select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Function_0').value) || document.getElementById('GroupID_0').selectedIndex == 0) alert('{translate label='Nu ati introdus Nume functie sau Grupa de functii!'}'); else window.location.href = './?m=dictionary&o=function_group&FunctionID=0&Function=' + escape(document.getElementById('Function_0').value) + '&GroupID=' + document.getElementById('GroupID_0').value; return false;"
                                                                        title="{translate label='Adauga functie'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista functiilor interne care apar in aplicatie'}</span></td>
    </tr>
</table>