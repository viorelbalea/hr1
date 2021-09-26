{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Functii'}</span></td>
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
                                        <td>{translate label='Functie'}</td>
                                        <td>{translate label='Tip'}</td>
                                        <td>{translate label='Grad / Treapta'}</td>
                                        <td>{translate label='Studii'}</td>
                                        <td>{translate label='Gradatie'}</td>
                                        <td>{translate label='Coeficient'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$functions key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Function_{$key}" name="Function_{$key}" value="{$item.Function}" size="40" maxlength="128"></td>
                                            <td>
                                                <select id="FunctionType_{$key}" name="FunctionType_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$functionType key=k item=i}
                                                        <option value="{$k}" {if !empty($item.FunctionType) && $k == $item.FunctionType}selected{/if}>{$i}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="GradTreapta_{$key}" name="GradTreapta_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$gradTreapta key=k item=i}
                                                        <option value="{$k}" {if !empty($item.GradTreapta) && $k == $item.GradTreapta}selected{/if}>{$i}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Studii_{$key}" name="Studii_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$studii key=k item=i}
                                                        <option value="{$k}" {if !empty($item.Studii) && $k == $item.Studii}selected{/if}>{$i}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Gradatie_{$key}" name="Gradatie_{$key}" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$gradatie key=k item=i}
                                                        <option value="{$k}" {if !empty($item.Gradatie) && $k == $item.Gradatie}selected{/if}>{$i}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" id="Coeficient_{$key}" name="Coeficient_{$key}" value="{$item.Coeficient}" size="5" maxlength="7">
                                            </td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=function_recr&FunctionID={$key}&Function=' + escape(document.getElementById('Function_{$key}').value) +
                                                                                    '&FunctionType=' + escape(document.getElementById('FunctionType_{$key}').value) +
                                                                                    '&GradTreapta=' + escape(document.getElementById('GradTreapta_{$key}').value) +
                                                                                    '&Gradatie=' + escape(document.getElementById('Gradatie_{$key}').value) +
                                                                                    '&Studii=' + escape(document.getElementById('Studii_{$key}').value) +
                                                                                    '&Coeficient=' + escape(document.getElementById('Coeficient_{$key}').value) +
                                                                                    '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica functie'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=function_recr&FunctionID={$key}&delFunction=1'; return false;"
                                                                            title="{translate label='Sterge functie'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Function_0" name="Function_0" size="40" maxlength="128"></td>
                                            <td>
                                                <select id="FunctionType_0" name="FunctionType_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$functionType key=key item=item}
                                                        <option value="{$key}" {if !empty($info.FunctionType) && $key == $info.FunctionType}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="GradTreapta_0" name="GradTreapta_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$gradTreapta key=key item=item}
                                                        <option value="{$key}" {if !empty($info.GradTreapta) && $key == $info.GradTreapta}selected{/if}>{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Studii_0" name="Studii_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$studii key=key item=item}
                                                        <option value="{$key}">{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Gradatie_0" name="Gradatie_0" class="dropdown">
                                                    <option value="0">{translate label='alege...'}</option>
                                                    {foreach from=$gradatie key=key item=item}
                                                        <option value="{$key}">{$item}</option>
                                                    {/foreach}
                                                </select>
                                            </td>
                                            <td><input type="text" id="Coeficient_0" name="Coeficient_0" size="5" maxlength="7"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=function_recr&FunctionID=0&Function=' + escape(document.getElementById('Function_0').value) +
                                                                        '&FunctionType=' + escape(document.getElementById('FunctionType_0').value) +
                                                                        '&GradTreapta=' + escape(document.getElementById('GradTreapta_0').value) +
                                                                        '&Gradatie=' + escape(document.getElementById('Gradatie_0').value) +
                                                                        '&Coeficient=' + escape(document.getElementById('Coeficient_0').value) +
                                                                        '&Studii=' + escape(document.getElementById('Studii_0').value); return false;"
                                                                        title="{translate label='Adauga functie'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista functiilor pentru recrutare care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
