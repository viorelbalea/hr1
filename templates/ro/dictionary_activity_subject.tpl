{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Subiect activitati'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                {if $err->getErrors()}
                    <font color="FF0000">{$err->getErrors()}</font>
                    <br>
                    <br>
                {/if}
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Subiect'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$subjects key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Subject_{$key}" name="Subject_{$key}" value="{$item.Subject}" size="80" maxlength="255"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=activity_subject&SubjectID={$key}&Subject=' + escape(document.getElementById('Subject_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica subiect'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=activity_subject&SubjectID={$key}&delSubject=1'; return false;"
                                                                            title="{translate label='Sterge subiect'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Subject_0" name="Subject_0" size="80" maxlength="255"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=activity_subject&SubjectID=0&Subject=' + escape(document.getElementById('Subject_0').value); return false;"
                                                                        title="{translate label='Adauga subiect'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista subiectelor activitatilor'}</span></td>
        </tr>
    </table>
</form>
