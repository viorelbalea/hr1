{include file="functions_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.get.FunctionID)}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span
                        class="TitleBox">{translate label='Modificare functie - '}{$functions.0.Function}{if $functions.0.FunctionObs != ''}&nbsp;&nbsp;<i>
                        ({$functions.0.FunctionObs})</i>{/if}</span></td>
        </tr>
    {else}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare functie'}</span></td>
        </tr>
    {/if}
    {if !empty($smarty.post) && $err->getErrors() == ""}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Datele functiei au fost salvate!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Informatii functie'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>{translate label='Companie'}*</td>
                        <td>{translate label='Aplicabila personal'}</td>
                        <td>{translate label='Functie superioara'}</td>
                        <td>{translate label='Functie executiva'}</td>
                        <td>{translate label='Nivel instruire'}</td>
                        <td>{translate label='Numar pozitii'}</td>
                        <td>{translate label='Vechime in companie'}</td>
                        <td>{translate label='Vechime in functie'}</td>
                        <td>{translate label='Fisa postului'}</td>
                    </tr>
                    {foreach from=$functions item=info key=key0}
                        {if $key0>0 && !empty($info.FunctionID)}
                            <form action="{$smarty.server.REQUEST_URI}&FunctionCompanyID={$info.FunctionCompanyID}&action=edit" method="post" name="q_{$info.FunctionCompanyID}">
                                <input type="hidden" name="FunctionCompanyID" value="{$info.FunctionCompanyID}"/>
                                <tr>
                                    <td nowrap="nowrap">
                                        <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
                                            <option value="0">{translate label='selecteaza'}</option>
                                            {foreach from=$companies key=key item=item}
                                                <option value="{$key}" {if $key==$info.CompanyID}selected{/if}>{$item}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="Aplicable" name="Aplicable" {if $info.Aplicable==1} checked="checked"{/if} value="1"/></td>
                                    <td>
                                        <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
                                            <option value="0">{translate label='selecteaza'}</option>
                                            {foreach from=$parent_functions key=key item=item}
                                                <option value="{$key}" {if $key==$info.ParentFunctionID}selected{/if}>{$item}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select id="DottedLineFunctionID" name="DottedLineFunctionID" class="dropdown" style="width:120px;">
                                            <option value="0">{translate label='selecteaza'}</option>
                                            {foreach from=$parent_functions key=key item=item}
                                                <option value="{$key}" {if $key==$info.DottedLineFunctionID}selected{/if}>{$item}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select name="EducationalLevelID" id="EducationalLevelID" style="width:160px;">
                                            <option value="0">{translate label='alege...'}</option>
                                            {foreach from=$educational_levels key=key item=item}
                                                <optgroup label="{translate label=$key}">
                                                    {foreach from=$item key=key2 item=item2}
                                                        {if is_array($item2)}
                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{translate label=$key2}">
                                                                {foreach from=$item2 key=key3 item=item3}
                                                                    <option value="{$key3}"
                                                                            {if !empty($info.EducationalLevelID) && $key3 == $info.EducationalLevelID}selected{/if}>{translate label=$item3}</option>
                                                                {/foreach}
                                                            </optgroup>
                                                        {else}
                                                            <option value="{$key2}"
                                                                    {if !empty($info.EducationalLevelID) && $key2 == $info.EducationalLevelID}selected{/if}>{translate label=$item2}</option>
                                                        {/if}
                                                    {/foreach}
                                                </optgroup>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="text" name="Positions" id="Positions" value="{$info.Positions|default:'0'}" style="width:25px;"/></td>
                                    <td><input type="text" name="CompanyAge" id="CompanyAge" value="{$info.CompanyAge|default:'0'}" style="width:25px;"/> ani</td>
                                    <td><input type="text" name="TotalAge" id="TotalAge" value="{$info.TotalAge|default:'0'}" style="width:25px;"/> ani</td>
                                    <!--<td><textarea name="Notes" id="Notes" cols="20" rows="4" wrap="soft">{$info.FunctionNotes|default:''}</textarea></td>-->
                                    <td><input type="hidden" id="Notes_{$key0}" name="Notes" value="{$info.FunctionNotes|default:''}"><span id="Notes_{$key0}_display"></span><br/>
                                        [<a href="#" onclick="getNotes('Notes_{$key0}'); return false;">{translate label='Fisa postului'}</a>]
                                    </td>
                                    <td nowrap="nowrap">
                                        <div id="button_mod" style="float:left;"><a href="#"
                                                                                    onclick="if(!is_empty(document.getElementById('CompanyID').value) ) document.q_{$info.FunctionCompanyID}.submit(); else alert('{translate label='Nu ati specificat toate informatiile despre functie!'}'); return false;"
                                                                                    title="Modifica functie"><b>Mod</b></a></div>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = '{$smarty.server.REQUEST_URI}&FunctionCompanyID={$info.FunctionCompanyID}&action=del'; return false;"
                                                                title="Sterge functie"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            </form>
                        {/if}
                    {/foreach}
                    <!-- Add new question inside a section -->
                    <form action="{$smarty.server.REQUEST_URI}&action=new" method="post" name="q_0">
                        <input type="hidden" name="FunctionID" value="{$functions.0.FunctionID}"/>
                        <tr>
                            <td nowrap="nowrap">
                                <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
                                    <option value="0">{translate label='selecteaza'}</option>
                                    {foreach from=$companies key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="checkbox" id="Aplicable" name="Aplicable" value="1"/></td>
                            <td>
                                <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
                                    <option value="0">{translate label='selecteaza'}</option>
                                    {foreach from=$parent_functions key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <select id="DottedLineFunctionID" name="DottedLineFunctionID" class="dropdown" style="width:120px;">
                                    <option value="0">{translate label='selecteaza'}</option>
                                    {foreach from=$parent_functions key=key item=item}
                                        <option value="{$key}">{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <select name="EducationalLevelID" id="EducationalLevelID" style="width:160px;">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$educational_levels key=key item=item}
                                        <optgroup label="{translate label=$key}">
                                            {foreach from=$item key=key2 item=item2}
                                                {if is_array($item2)}
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{translate label=$key2}">
                                                        {foreach from=$item2 key=key3 item=item3}
                                                            <option value="{$key3}">{translate label=$item3}</option>
                                                        {/foreach}
                                                    </optgroup>
                                                {else}
                                                    <option value="{$key2}">{translate label=$item2}</option>
                                                {/if}
                                            {/foreach}
                                        </optgroup>
                                    {/foreach}
                                </select>
                            </td>
                            <td><input type="text" name="Positions" id="Positions" value="0" style="width:25px;"/></td>
                            <td><input type="text" name="CompanyAge" id="CompanyAge" value="0" style="width:25px;"/> ani</td>
                            <td><input type="text" name="TotalAge" id="TotalAge" value="0" style="width:25px;"/> ani</td>
                            <!--<td><textarea name="Notes" id="Notes" cols="20" rows="4" wrap="soft"></textarea></td>-->
                            <td><input type="hidden" id="Notes_0" name="Notes" value=""><span id="Notes_0_display"></span><br/> [<a href="#"
                                                                                                                                    onclick="getNotes('Notes_0'); return false;">{translate label='Fisa postului'}</a>]
                            </td>
                            <td>
                                <div id="button_add"><a href="#"
                                                        onclick="if(!is_empty(document.getElementById('CompanyID').value) && !is_empty(document.getElementById('CompanyID').value)) document.q_0.submit(); else alert('{translate label='Nu ati specificat toate informatiile despre functie!'}'); return false;"
                                                        title="Adauga functie"><b>Add</b></a></div>
                            </td>
                        </tr>
                    </form>

                    <tr>
                        <td>
                            <input type="button" value="{translate label='Inapoi'}" onclick="window.location.href='./?m=functions';" class="formstyle">
                        </td>
                    </tr>

                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>

<div id="layer_co"
     style="display: none; width: 600px; height: 220px; position: fixed; z-index: 1001; top: 200px; left: 50%; margin-left: -300px; box-shadow: 3px 3px 5px #888; background:#ffffff; border: 1px solid #999999;">
    <h3 style="width: 580px; height: 26px; background-color: #b6b6b6; padding: 6px 0 0 20px; margin-top: 0;">{translate label='Fisa postului'}</h3>
    <div style="padding: 0 20px 0 20px;">
        <textarea id="layer_co_notes" style="width: 100%; height: 120px;"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value="">
        <br><br>
        <input type="button" value="{translate label='Salveaza'}" onclick="setNotes();">&nbsp;&nbsp;
        <input type="button" value="{translate label='Anuleaza'}"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<div id="layer_co_x"
     style="display: none; width:20px; height:18px; position:fixed; left:50%; margin-left:275px; top:205px; z-index:1002; background:#efefef; border:1px solid #ccc; color:#333; cursor:pointer; text-align:center; font-weight:bold; padding-top:2px; border-radius:50px;"
     title="Inchide" onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">X
</div>


<script type="text/javascript">
    {foreach from=$functions item=info key=key0}
    {if $key0>0}
    document.getElementById('Notes_{$key0}_display').innerHTML = document.getElementById('Notes_{$key0}').value.substring(0, 10) + '...';
    {/if}
    {/foreach}

    {literal}
    function getNotes(id) {
        document.getElementById('layer_co_notes').value = document.getElementById(id).value;
        document.getElementById('layer_co_notes_dest').value = id;
        document.getElementById('layer_co').style.display = 'block';
        document.getElementById('layer_co_x').style.display = 'block';
    }

    function setNotes() {
        var id = document.getElementById('layer_co_notes_dest').value;
        document.getElementById(id).value = document.getElementById('layer_co_notes').value;
        document.getElementById(id + '_display').innerHTML = document.getElementById('layer_co_notes').value.substring(0, 10) + '...';
        document.getElementById('layer_co').style.display = 'none';
        document.getElementById('layer_co_x').style.display = 'none';
    }
    {/literal}
</script>


