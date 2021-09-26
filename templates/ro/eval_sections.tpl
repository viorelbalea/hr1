<div class="submeniu">
    {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 1 || $smarty.session.ACCESSEVAL == 3}
        <a href="./?m=eval&o=sections" class="selected">{translate label='Sectiuni evaluare'}</a>
        <a href="./?m=eval&o=formsDraft" class="unselected">{translate label='Formulare evaluare'}</a>
        <a href="./?m=eval&o=evalDraft&action=new" class="unselected">{translate label='Adauga formular evaluare'}</a>
    {/if}
    <a href="./?m=eval&o=evalPersons" class="unselected">{translate label='Evaluari angajati'}</a>
</div>
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post" enctype="multipart/form-data" name="pers"
      onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        {if !empty($smarty.post) && $err->getErrors() == ""}
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR"
                    style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR"
                    style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {/if}
        <tr>
            <td class="celulaMenuST"
                style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br/>
                <!-- Sectiuni-->
                <fieldset>
                    <legend>{translate label='Sectiuni evaluare'}</legend>
                    {if !empty($sections)}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="600">
                            <tr>
                                <td>{translate label='Nume sectiune'}*</td>
                                <td>{translate label='Pondere'}*</td>
                                <td>{translate label='Prioritate'}*</td>
                                <td>{translate label='Activ'}</td>
                            </tr>
                            {foreach from=$sections item=item}
                                <tr>
                                    <td><input type="text" id="Name_{$item.SectionID}" value="{$item.Name}" size="70">
                                    </td>
                                    <td><input type="text" id="Pondere_{$item.SectionID}" value="{$item.Pondere}"
                                               size="3"></td>
                                    <td><input type="text" id="Priority_{$item.SectionID}" value="{$item.Priority}"
                                               size="3"></td>
                                    <td><input type="checkbox" id="Status_{$item.SectionID}"
                                               value="1" {if $item.Status==1} checked{/if}></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('Name_{$item.SectionID}').value) && !is_empty(document.getElementById('Pondere_{$item.SectionID}').value) && !is_empty(document.getElementById('Priority_{$item.SectionID}').value)) window.location.href = '{$smarty.server.REQUEST_URI}&action=edit_section&SectionID={$item.SectionID}&Name=' + document.getElementById('Name_{$item.SectionID}').value + '&Pondere=' + document.getElementById('Pondere_{$item.SectionID}').value +'&Priority=' + document.getElementById('Priority_{$item.SectionID}').value + '&Status=' + (document.getElementById('Status_{$item.SectionID}').checked ? 1 : 0); else alert('{translate label='Nu ati specificat toate informatiile despre sectiune!'}'); return false;"
                                                                title="Modifica sectiune"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&action=del_section&SectionID={$item.SectionID}'; return false;"
                                                                title="Sterge sectiune"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            {/foreach}
                        </table>
                    {/if}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="600">
                        <tr>
                            <td>{translate label='Nume sectiune'}*</td>
                            <td>{translate label='Pondere'}*</td>
                            <td>{translate label='Prioritate'}*</td>
                            <td>{translate label='Activ'}</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="Name_0" size="70"></td>
                            <td><input type="text" id="Pondere_0" size="3"></td>
                            <td><input type="text" id="Priority_0" size="3"></td>
                            <td><input type="checkbox" id="Status_0" value="1"></td>
                            <td>
                                <div id="button_add"><a href="#"
                                                        onclick="if (!is_empty(document.getElementById('Name_0').value) && !is_empty(document.getElementById('Priority_0').value) && !is_empty(document.getElementById('Pondere_0').value) && !is_empty(document.getElementById('Status_0').value)) window.location.href = '{$smarty.server.REQUEST_URI}&action=new_section&Name=' + document.getElementById('Name_0').value +'&Pondere=' + document.getElementById('Pondere_0').value + '&Priority=' + document.getElementById('Priority_0').value + '&Status=' + (document.getElementById('Status_0').checked ? 1 : 0); else alert('{translate label='Nu ati specificat toate informatiile despre sectiune!'}'); return false;"
                                                        title="Adauga sectiune"><b>Add</b></a></div>
                            </td>
                        </tr>
                    </table>
                </fieldset>


            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span
                        class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>