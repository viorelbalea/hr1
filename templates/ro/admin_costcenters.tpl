{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Centre de cost'}</span></td>
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
                                        <td>{translate label='Nume centru de cost'}</td>
                                        <td>{translate label='Activ'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$costcenter key=key item=item}
                                        <tr>
                                            <td><input type="text" id="CostCenter_{$key}" name="CostCenter_{$key}" value="{$item.CostCenter}" size="40" maxlength="255"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=admin&o=costcenter&CostCenterID={$key}&CostCenter=' + escape(document.getElementById('CostCenter_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                        title="{translate label='Modifica centru de cost'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Sunteti sigura(a)'}?')) window.location.href = './?m=admin&o=costcenter&CostCenterID={$key}&delCostCenter=1'; return false;"
                                                                        title="{translate label='Sterge centru de cost'}"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="CostCenter_0" name="CostCenter_0" size="40" maxlength="255"></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=costcenter&CostCenterID=0&CostCenter=' + escape(document.getElementById('CostCenter_0').value); return false;"
                                                                    title="{translate label='Adauga centru de cost'}"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista de centre de cost care apar in aplicatie'}</span></td>
        </tr>
    </table>
</form>
