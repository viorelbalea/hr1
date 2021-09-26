{include file="dictionary_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Orase'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Judete / Districte'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Nume'}</td>
                                    <td colspan="3">{translate label='Activ'}</td>
                                </tr>
                                {foreach from=$districts key=key item=item}
                                    <tr>
                                        <td><input type="text" id="DistrictName_{$key}" value="{$item.DistrictName}" size="30" maxlength="64"></td>
                                        <td><input type="checkbox" id="Active_{$key}" value="1" {if $item.Active == 1}checked{/if}></td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=city&DistrictID={$key}&DistrictName=' + escape(document.getElementById('DistrictName_{$key}').value) + '&Active=' + (document.getElementById('Active_{$key}').checked ? 1 : 0); return false;"
                                                                        title="{translate label='Editeaza judet'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigura(a) ca vreti sa stergeti acest judet?'}')) window.location.href = './?m=dictionary&o=city&DistrictID={$key}&delDistrict=1'; return false;"
                                                                        title="{translate label='Sterge judet'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="DistrictName_0" size="30" maxlength="64"></td>
                                        <td colspan="3">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=city&DistrictID=0&DistrictName=' + escape(document.getElementById('DistrictName_0').value); return false;"
                                                                    title="{translate label='Adauga judet'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                {/if}
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Orase'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select onchange="if (this.value>0) window.location.href='./?m=dictionary&o=city&DistrictID=' + this.value">
                                <option value="0">{translate label='alege judet'}</option>
                                {foreach from=$districts key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.DistrictID}selected{/if}>{$item.DistrictName}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.DistrictID)}
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>{translate label='Nume'}</td>
                            <td>{translate label='Realocare'}</td>
                            <td colspan="3">{translate label='Activ'}</td>
                        </tr>
                        {foreach from=$cities key=key item=item}
                            {if $key > 0}
                                <tr>
                                    <td><input type="text" id="CityName_{$key}" value="{$item.CityName}" size="30" maxlength="64"></td>
                                    <td>
                                        <select id="NewCityID_{$key}">
                                            <option value="0">{translate label='realoca oras'}</option>
                                            {foreach from=$cities key=key2 item=item2}
                                                {if $key != $key2}
                                                    <option value="{$key2}">{$item2.CityName}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="Active__{$key}" value="1" {if $item.Active == 1}checked{/if}></td>
                                    {if $rw == 1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=city&DistrictID={$smarty.get.DistrictID}&CityID={$key}&CityName=' + escape(document.getElementById('CityName_{$key}').value) + '&Active=' + (document.getElementById('Active__{$key}').checked ? 1 : 0); return false;"
                                                                    title="{translate label='Modifica oras'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a) ca vreti sa stergeti acest oras?'}')) window.location.href = './?m=dictionary&o=city&DistrictID={$smarty.get.DistrictID}&CityID={$key}&NewCityID=' + document.getElementById('NewCityID_{$key}').value + '&delCity=1'; return false;"
                                                                    title="{translate label='Sterge oras'}"><b>Del</b></a></div>
                                        </td>
                                    {/if}
                                </tr>
                            {/if}
                        {/foreach}
                        {if $rw == 1}
                            <tr>
                                <td><input type="text" id="CityName_0" size="30" maxlength="64"></td>
                                <td colspan="3">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=dictionary&o=city&DistrictID={$smarty.get.DistrictID}&CityID=0&CityName=' + escape(document.getElementById('CityName_0').value); return false;"
                                                            title="{translate label='Adauga oras'}"><b>Add</b></a></div>
                                </td>
                            </tr>
                        {/if}
                    </table>
                    {$pagination}
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='judete si orase'}</span></td>
    </tr>
</table>
