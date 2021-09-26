{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Profesii'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                {if $err->getErrors()}
                                    <font color="FF0000">{$err->getErrors()}</font>
                                    <br>
                                    <br>
                                {/if}
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume profesie'}</td>
                                        <td>{translate label='COR'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$jobstitle key=key item=item}
                                        <tr>
                                            <td><input type="text" id="JobTitle_{$key}" name="JobTitle_{$key}" value="{$item.JobTitle}" size="40" maxlength="255"></td>
                                            <td><input type="text" id="COR_{$key}" name="COR_{$key}" value="{$item.COR}" size="10" maxlength="32"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=admin&o=jobstitle&JobDictionaryID={$key}&JobTitle=' + escape(document.getElementById('JobTitle_{$key}').value) + '&COR=' + escape(document.getElementById('COR_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                        title="Modifica profesie"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=jobstitle&JobDictionaryID={$key}&delJobTitle=1'; return false;"
                                                                        title="Sterge profesie"><b>{translate label='Mod'}</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="JobTitle_0" name="JobTitle_0" size="40" maxlength="255"></td>
                                        <td><input type="text" id="COR_0" name="COR_0" size="10" maxlength="32"></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=jobstitle&JobDictionaryID=0&JobTitle=' + escape(document.getElementById('JobTitle_0').value) + '&COR=' + escape(document.getElementById('COR_0').value); return false;"
                                                                    title="Adauga profesie"><b>Mod</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de profesii care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
