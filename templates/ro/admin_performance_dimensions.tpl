{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Dimensiuni'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                {if $err->getErrors()}
                    <font color="FF0000">{$err->getErrors()}</font>
                    <br>
                    <br>
                {/if}
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Denumire dimensiune'}</td>
                                        <td>{translate label='Activa'}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$dimensions key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Dimension_{$key}" name="Dimension_{$key}" value="{$item.Dimension}" size="80" maxlength="255"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=admin&o=performance_dimension&DimensionID={$key}&Dimension=' + escape(document.getElementById('Dimension_{$key}').value) + '&Status=' + (document.getElementById('Status_{$key}').checked ? 1 : 0); return false;"
                                                                        title="Modifica dimensiune"><b>{translate label='Mod'}</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=performance_dimension&DimensionID={$key}&delDimension=1'; return false;"
                                                                        title="Sterge dimensiune"><b>{translate label='Del'}</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="Dimension_0" name="Dimension_0" size="80" maxlength="255"></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=performance_dimension&DimensionID=0&Dimension=' + escape(document.getElementById('Dimension_0').value); return false;"
                                                                    title="Adauga dimensiune"><b>{translate label='Add'}</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista dimensiunilor'}</span></td>
        </tr>
    </table>
</form>
