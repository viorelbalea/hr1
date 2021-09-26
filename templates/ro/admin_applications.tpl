{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Aplicatii'}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend> {translate label='Aplicatii'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                {foreach from=$applications key=key item=item}
                                    <tr>
                                        <td><input type="text" id="App_{$key}" name="App_{$key}" value="{$item}" size="25" maxlength="128"></td>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=applications&AppID={$key}&App=' + escape(document.getElementById('App_{$key}').value); return false;"
                                                                    title="{translate label='Modifica aplicatie'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Stergerea unei aplicatii implica stergerea tuturor modulelor aferente.\nSunteti sigura(a)?')) window.location.href = './?m=admin&o=applications&AppID={$key}&delApp=1'; return false;"
                                                                    title="{translate label='Sterge aplicatie'}"><b>Del</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                                <tr>
                                    <td><input type="text" id="App_0" name="App_0" size="25" maxlength="128"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=applications&AppID=0&App=' + escape(document.getElementById('App_0').value); return false;"
                                                                title="{translate label='Adauga aplicatie'}"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend> {translate label='Module'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="applications" onchange="if (this.value>0) window.location.href='./?m=admin&o=applications&AppID=' + this.value">
                                <option value="">{translate label='alege aplicatia'}</option>
                                {foreach from=$applications key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.AppID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.AppID)}
                    <fieldset>
                        <legend>{translate label='Module'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>Modul</td>
                                <td colspan="3">{translate label='Descriere'}</td>
                            </tr>
                            {foreach from=$app_modules key=key item=item}
                                <tr>
                                    <td><input type="text" id="Module_{$key}" name="Module_{$key}" value="{$item.Module}" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_{$key}" name="Notes_{$key}" value="{$item.Notes}" size="30" maxlength="255"></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=applications&AppID={$smarty.get.AppID}&ModuleID={$key}&Module=' + escape(document.getElementById('Module_{$key}').value) + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); return false;"
                                                                title="{translate label='Modifica modul'}"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=applications&AppID={$smarty.get.AppID}&ModuleID={$key}&delModule={$key}'; return false;"
                                                                title="{translate label='Sterge modul'}"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td><input type="text" id="Module_0" name="Module_0" size="20" maxlength="32"></td>
                                <td><input type="text" id="Notes_0" name="Notes_0" size="30" maxlength="255"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=admin&o=applications&AppID={$smarty.get.AppID}&ModuleID=0&Module=' + escape(document.getElementById('Module_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                            title="{translate label='Adauga modul'}"><b>Add</b></a></div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='aplicatii flosite in firma'}</span></td>
    </tr>
</table>
