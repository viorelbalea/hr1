{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Tari'}</span></td>
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
                                        <td>{translate label='Tara'}</td>
                                        <td>{translate label='Cod'}</td>
                                        <td>{translate label='Nationalitate'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$countries key=key item=item}
                                        <tr>
                                            <td><input type="text" id="CountryName_{$key}" name="CountryName_{$key}" value="{$item.CountryName}" size="60" maxlength="128"></td>
                                            <td><input type="text" id="CountryCode_{$key}" name="CountryCode_{$key}" value="{$item.CountryCode}" size="4" maxlength="3"></td>
                                            <td><input type="text" id="Nationality_{$key}" name="Nationality_{$key}" value="{$item.Nationality}" size="20" maxlength="32"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=country&CountryID={$key}&CountryName=' + escape(document.getElementById('CountryName_{$key}').value) + '&CountryCode=' + escape(document.getElementById('CountryCode_{$key}').value) + '&Nationality=' + escape(document.getElementById('Nationality_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                            title="{translate label='Modifica tara'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=country&CountryID={$key}&delCountry=1'; return false;"
                                                                            title="{translate label='Sterge tara'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="CountryName_0" name="CountryName_0" size="60" maxlength="128"></td>
                                            <td><input type="text" id="CountryCode_0" name="CountryCode_0" size="4" maxlength="3"></td>
                                            <td><input type="text" id="Nationality_0" name="Nationality_0" size="20" maxlength="32"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=country&CountryID=0&CountryName=' + escape(document.getElementById('CountryName_0').value) + '&CountryCode=' + escape(document.getElementById('CountryCode_0').value) + '&Nationality=' + escape(document.getElementById('Nationality_0').value); return false;"
                                                                        title="{translate label='Adauga tara'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista tarilor care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
