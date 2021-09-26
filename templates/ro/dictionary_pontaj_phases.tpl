{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Faze proiect'}</span></td>
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
                                        <td>{translate label='Faza'}</td>
                                        <td>{translate label='Descriere faza'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$phases key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Phase_{$key}" name="Phase_{$key}" value="{$item.Phase}" size="20" maxlength="64"></td>
                                            <td><input type="text" id="Notes_{$key}" name="Notes_{$key}" value="{$item.Notes}" size="60" maxlength="128"></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID={$key}&Phase=' + escape(document.getElementById('Phase_{$key}').value) + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); return false;"
                                                                            title="{translate label='Modifica faza'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID={$key}&delPhase=1'; return false;"
                                                                            title="{translate label='Sterge faza'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Phase_0" name="Phase_0" size="20" maxlength="64"></td>
                                            <td><input type="text" id="Notes_0" name="Notes_0" size="60" maxlength="128"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID=0&Phase=' + escape(document.getElementById('Phase_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                                        title="{translate label='Adauga faza'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de faze'}</span></td>
        </tr>
    </table>
</form>
