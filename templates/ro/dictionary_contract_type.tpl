{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Tipuri de contracte'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Tipuri de contracte'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    {foreach from=$types key=key item=item}
                                        <tr>
                                            <td><input type="text" id="ContractType_{$key}" name="ContractType_{$key}" value="{$item}" size="40" maxlength="128"></td>
                                            {if $rw == 1}
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=contract_type&ContractTypeID={$key}&ContractType=' + escape(document.getElementById('ContractType_{$key}').value); return false;"
                                                                            title="{translate label='Modifica tip contract'}"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=contract_type&ContractTypeID={$key}&delContractType=1'; return false;"
                                                                            title="{translate label='Sterge tip contract'}"><b>Del</b></a></div>
                                                </td>
                                            {/if}
                                        </tr>
                                    {/foreach}
                                    {if $rw == 1}
                                        <tr>
                                            <td><input type="text" id="ContractType_0" name="ContractType_0" size="40" maxlength="128"></td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=contract_type&ContractTypeID=0&ContractType=' + escape(document.getElementById('ContractType_0').value); return false;"
                                                                        title="{translate label='Adauga tip contract'}"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de tipuri de contracte care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
