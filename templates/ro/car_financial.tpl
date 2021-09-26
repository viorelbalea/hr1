{include file="car_menu.tpl"}
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="car_submenu.tpl"}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Financiar'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>{translate label='Contract de comodat'}:</td>
                            <td>
                                <select name="ContractID">
                                    <option value="0"></option>
                                    {foreach from=$contracts item=item}
                                        <option value="{$item.ContractID}" {if $financial.ContractID == $item.ContractID}selected{/if}>{$item.ContractName}</option>
                                    {/foreach}
                                </select>{if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.21.2)}&nbsp;&nbsp;[ <a href="./?m=contract&o=new"
                                                                                                                                        onclick="window.location.href = './?area_id=3'; return true;">adauga
                                contract de comodat</a> ]{/if}
                            </td>
                        </tr>
                        {if $rw == 1}
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="{translate label='Salveaza'}"></td>
                            </tr>
                        {/if}
                        {if !empty($financial)}
                            <tr>
                                <td>{translate label='Nume contract'}:</td>
                                <td>{$financial.ContractName}</td>
                            </tr>
                            <tr>
                                <td>{translate label='Numar contract'}:</td>
                                <td>{$financial.ContractNo}</td>
                            </tr>
                            <tr>
                                <td>{translate label='Data inceput'}:</td>
                                <td>{$financial.StartDate|date_format:'%d.%m.%Y'}</td>
                            </tr>
                            {if $financial.StopDate > '0000-00-00'}
                                <tr>
                                    <td>{translate label='Data sfarsit'}:</td>
                                    <td>{$financial.StopDate|date_format:'%d.%m.%Y'}</td>
                                </tr>
                            {/if}
                            <tr>
                                <td>{translate label='Valoare contract'}:</td>
                                <td>{$financial.ContractValue} {$financial.Coin}</td>
                            </tr>
                            <tr>
                                <td colspan="2">{if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.21.2)}&nbsp;&nbsp;[
                                        <a href="./?m=contract&o=edit&ContractID={$financial.ContractID}" onclick="window.location.href = './?area_id=3'; return true;">detalii
                                            contract de comodat</a>
                                        ]{/if}</td>
                            </tr>
                        {/if}
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>
