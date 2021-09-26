{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Tipuri de traininguri'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Tipuri de traininguri'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    {foreach from=$types key=key item=item}
                                        <tr>
                                            <td><input type="text" id="TrainingType_{$key}" name="TrainingType_{$key}" value="{$item}" size="40" maxlength="128"></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=training_type&TrainingTypeID={$key}&TrainingType=' + escape(document.getElementById('TrainingType_{$key}').value); return false;"
                                                                            title="{translate label='Modifica tip training'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=training_type&TrainingTypeID={$key}&delTrainingType=1'; return false;"
                                                                            title="{translate label='Sterge tip training'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="TrainingType_0" name="TrainingType_0" size="40" maxlength="255"></td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=training_type&TrainingTypeID=0&TrainingType=' + escape(document.getElementById('TrainingType_0').value); return false;"
                                                                        title="{translate label='Adauga tip training'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de tipuri de traininguri care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
