{include file="training_menu.tpl"}

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Formular feedback training'}</span></td>
    </tr>
    <tr>
        {if !empty($smarty.post) && $err->getErrors() == ""}
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
            <br/>
            <form action="{$request_uri}" method="post">
                <fieldset>
                    <legend>{translate label='Detalii formular'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td>
                                <b>{translate label='Nume formular'}:</b>
                            </td>
                            <td>
                                <input type="text" id="FormName" name="FormName" value="{$form.FormName}" size="50" maxlength="200">
                            </td>
                            <td>
                                <b>{translate label='Tip'}:</b>
                            </td>
                            <td>
                                <select name="Type">
                                    {foreach from=$types item=item key=key}
                                        <option value="{$key}" {if $form.Type==$key} selected="selected"{/if}>{$item}</option>
                                    {/foreach}
                            </td>
                            <td>
                                {if !empty($smarty.get.EvalFormDraftID)}
                                    <input type="submit" value="Salveaza" class="formstyle">
                                {else}
                                    <input type="submit" value="Adauga formular" class="formstyle">
                                {/if}
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
    {if $smarty.get.action=='edit'}
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br/>
                <!-- Sectiuni-->
                <fieldset>
                    <legend>{translate label='Sectiuni feedback training'}</legend>
                    {if !empty($sections)}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="600">
                            <tr>
                                <td colspan="2">{translate label='Nume sectiune*'}</td>
                                <td>{translate label='Pondere'}*</td>
                                <td>{translate label='Prioritate'}*</td>
                                <td>{translate label='Activ'}</td>
                            </tr>
                            {foreach from=$sections item=item}
                                <tr>
                                    <td colspan="2"><input type="text" id="Name_{$item.SectionID}" value="{$item.Name}" size="70"></td>
                                    <td><input type="text" id="Pondere_{$item.SectionID}" value="{$item.Pondere}" size="3"></td>
                                    <td><input type="text" id="Priority_{$item.SectionID}" value="{$item.Priority}" size="3"></td>
                                    <td><input type="checkbox" id="Status_{$item.SectionID}" value="1" {if $item.Status==1} checked{/if}></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('Name_{$item.SectionID}').value) && !is_empty(document.getElementById('Pondere_{$item.SectionID}').value) && !is_empty(document.getElementById('Priority_{$item.SectionID}').value)) window.location.href = './?m=training&o=evalDraft&EvalFormDraftID={$smarty.get.EvalFormDraftID}&action=edit_section&SectionID={$item.SectionID}&Name=' + document.getElementById('Name_{$item.SectionID}').value + '&Pondere=' + document.getElementById('Pondere_{$item.SectionID}').value +'&Priority=' + document.getElementById('Priority_{$item.SectionID}').value + '&Status=' + (document.getElementById('Status_{$item.SectionID}').checked ? 1 : 0); else alert('{translate label='Nu ati specificat toate informatiile despre sectiune!'}'); return false;"
                                                                title="Modifica sectiune"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=training&o=evalDraft&EvalFormDraftID={$smarty.get.EvalFormDraftID}&action=del_section&SectionID={$item.SectionID}'; return false;"
                                                                title="Sterge sectiune"><b>Del</b></a></div>
                                    </td>
                                </tr>
                                <tr>
                                    <td width="30">&nbsp;</td>
                                    <td>{translate label='Citeriu'}*</td>
                                    <td>{translate label='Pondere'}*</td>
                                    <td>{translate label='Optiuni'}*</td>
                                </tr>
                                {foreach from=$item.Questions item=item2 key=key2 name=name2}
                                    <form action="?m=training&o=evalDraft&EvalFormDraftID={$item.EvalFormDraftID}&action=edit_question&EvalQuestionID={$item2.EvalQuestionID}"
                                          method="post" name="q_{$item2.EvalQuestionID}">
                                        <input type="hidden" name="SectionID" value="{$item.SectionID}"/>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td valign="top" nowrap="nowrap"><textarea id="Question" name="Question" cols="40" rows="2">{$item2.Question}</textarea></td>
                                            <td><input type="text" name="Pondere" id="Pondere" value="{$item2.Pondere}" size="3" maxlength="4"></td>
                                            <td>
                                                <div id="button_mod" style="float:left;"><a href="#"
                                                                                            onclick="if(!is_empty(document.getElementById('Question').value) && !is_empty(document.getElementById('Pondere').value)) document.q_{$item2.EvalQuestionID}.submit(); else alert('{translate label='Nu ati specificat toate informatiile despre criteriu!'}'); return false;"
                                                                                            title="Modifica criteriu"><b>Mod</b></a></div>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=training&o=evalDraft&EvalFormDraftID={$item.EvalFormDraftID}&EvalQuestionID={$item2.EvalQuestionID}&action=del_question'; return false;"
                                                                        title="Sterge criteriu"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    </form>
                                {/foreach}
                                <!-- Add new question inside a section -->
                                <form action="?m=training&o=evalDraft&EvalFormDraftID={$smarty.get.EvalFormDraftID}&action=edit_question&EvalQuestionID=0" method="post"
                                      name="q_{$item.SectionID}_0">
                                    <input type="hidden" name="SectionID" value="{$item.SectionID}"/>
                                    <tr>
                                        <td>&nbsp;</td>
                                        <td><textarea id="Question" name="Question" cols="40" rows="2"></textarea></td>
                                        </td>
                                        <td><input type="text" id="Pondere" name="Pondere" size="3" maxlength="4"></td>
                                        <td>
                                            <div id="button_add"><a href="#"
                                                                    onclick="if(!is_empty(document.getElementById('Question').value) && !is_empty(document.getElementById('Pondere').value)) document.q_{$item.SectionID}_0.submit(); else alert('{translate label='Nu ati specificat toate informatiile despre criteriu!'}'); return false;"
                                                                    title="Adauga criteriu"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                </form>
                            {/foreach}
                        </table>
                    {/if}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="600">
                        <tr>
                            <td colspan="2">{translate label='Nume sectiune*'}</td>
                            <td>{translate label='Pondere'}*</td>
                            <td>{translate label='Prioritate'}*</td>
                            <td>{translate label='Activ'}</td>
                        </tr>
                        <tr>
                            <td colspan="2"><input type="text" id="Name_0" size="70"></td>
                            <td><input type="text" id="Pondere_0" size="3"></td>
                            <td><input type="text" id="Priority_0" size="3"></td>
                            <td><input type="checkbox" id="Status_0" value="1"></td>
                            <td>
                                <div id="button_add"><a href="#"
                                                        onclick="if (!is_empty(document.getElementById('Name_0').value) && !is_empty(document.getElementById('Priority_0').value) && !is_empty(document.getElementById('Pondere_0').value) && !is_empty(document.getElementById('Status_0').value)) window.location.href = './?m=training&o=evalDraft&EvalFormDraftID={$smarty.get.EvalFormDraftID}&action=new_section&Name=' + document.getElementById('Name_0').value +'&Pondere=' + document.getElementById('Pondere_0').value + '&Priority=' + document.getElementById('Priority_0').value + '&Status=' + (document.getElementById('Status_0').checked ? 1 : 0); else alert('{translate label='Nu ati specificat toate informatiile despre sectiune!'}'); return false;"
                                                        title="Adauga sectiune"><b>Add</b></a></div>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;&nbsp;<input type="button" value="Inapoi" onclick="window.location='./?m=training&o=formsDraft';" class="formstyle"></td>

                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
    {/if}
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">&nbsp;</span></td>
    </tr>
</table>

