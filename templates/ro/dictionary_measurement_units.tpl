{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Unitati de masura'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Unitati de masura'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    {foreach from=$units key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Unit_{$key}" name="Unit_{$key}" value="{$item.Unit}" size="40" maxlength="128"></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=measurement_units&UnitID={$key}&Unit=' + escape(document.getElementById('Unit_{$key}').value); return false;"
                                                                            title="{translate label='Modifica unitate de masura'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=measurement_units&UnitID={$key}&delUnit=1'; return false;"
                                                                            title="{translate label='Sterge unitate de masura'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="Unit_0" name="Unit_0" size="40" maxlength="128"></td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=measurement_units&UnitID=0&Unit=' + escape(document.getElementById('Unit_0').value); return false;"
                                                                        title="{translate label='Adauga unitate de masura'}"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    {/if}
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
</form>
