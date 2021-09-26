{include file="candidates_menu.tpl"}
<table width="100%">
    <tr>
        <td valign="top">
            <fieldset>
                <legend>Surse</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Sursa'}</td>
                        <td>{translate label='Activ'}</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    {foreach from=$sources key=key item=item}
                        <tr>
                            <td><input type="text" id="Source_{$key}" name="Source_{$key}" value="{$item}" size="40" maxlength="255"></td>
                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $Status[$key]==1}checked{/if}></td>

                            <td>
                                <div id="button_mod"><a href="#"
                                                        onclick="window.location.href = './?m=candidates&o=posts&SourceID={$key}&action=sources&SourceID={$key}&Source=' + escape(document.getElementById('Source_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                        title="{translate label='Modifica sursa'}"><b>Mod</b></a></div>
                            </td>

                            <td>
                                <div id="button_del"><a href="#"
                                                        onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=candidates&o=posts&action=sources&SourceID={$key}&delSource=1'; return false;"
                                                        title="{translate label='Sterge sursa'}"><b>Del</b></a></div>
                            </td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td><input type="text" id="Source_0" name="Source_0" size="40" maxlength="255"></td>
                        <td>&nbsp;</td>
                        <td colspan="2">
                            <div id="button_add"><a href="#"
                                                    onclick="window.location.href = './?m=candidates&o=posts&action=sources&SourceID=0&Source=' + escape(document.getElementById('Source_0').value); return false;"
                                                    title="{translate label='Adauga sursa'}"><b>Add</b></a></div>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td valign="top">
            <fieldset>
                <legend>Posturi</legend>


                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Post'}</td>
                        <td>{translate label='Activ'}</td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                    {foreach from=$posts key=key item=item}
                        <tr>
                            <td><input type="text" id="Post_{$key}" name="Post_{$key}" value="{$item}" size="40" maxlength="255"></td>
                            <td align="center"><input type="checkbox" id="Status2_{$key}" value="1" {if $Status2[$key]==1}checked{/if}></td>

                            <td>
                                <div id="button_mod"><a href="#"
                                                        onclick="window.location.href = './?m=candidates&o=posts&action=sources&PostID={$key}&Post=' + escape(document.getElementById('Post_{$key}').value) + '&Status=' + (document.getElementById('Status2_{$key}').checked ? 1 : 0); return false;"
                                                        title="{translate label='Modifica sursa'}"><b>Mod</b></a></div>
                            </td>

                            <td>
                                <div id="button_del"><a href="#"
                                                        onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=candidates&o=posts&action=sources&PostID={$key}&delPost=1'; return false;"
                                                        title="{translate label='Sterge sursa'}"><b>Del</b></a></div>
                            </td>
                        </tr>
                    {/foreach}
                    <tr>
                        <td><input type="text" id="Post_0" name="Post_0" size="40" maxlength="255"></td>
                        <td>&nbsp;</td>
                        <td colspan="2">
                            <div id="button_add"><a href="#"
                                                    onclick="window.location.href = './?m=candidates&o=posts&action=sources&PostID=0&Post=' + escape(document.getElementById('Post_0').value); return false;"
                                                    title="{translate label='Adauga sursa'}"><b>Add</b></a></div>
                        </td>
                    </tr>
                </table>

            </fieldset>
        </td>
    </tr>
</table>