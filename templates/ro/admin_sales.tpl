{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Surse Lead/ Stadii'}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000">{$err->getErrors()}</font></td>
        </tr>
    {/if}
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 1px; padding-top: 10px;">
            <form action="./?m=admin&o=sales_source" method="post">
                <fieldset>
                    <legend>{translate label='Surse Lead'}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume sursa '}</td>
                                        <td>{translate label='Activa '}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$sales_sources key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Name_{$item.SourceID}" name="Name_{$item.SourceID}" value="{$item.Name}" size="24" maxlength="128"
                                                       class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_{$item.SourceID}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Name_{$item.SourceID}').value)) alert('{translate label='Nu ati introdus Numele sursei! '}'); else window.location.href = './?m=admin&o=sales_source&SourceID={$item.SourceID}&Name=' + escape(document.getElementById('Name_{$item.SourceID}').value) + '&Status=' + (document.getElementById('Status_{$item.SourceID}').checked ? 1 : 0); return false;"
                                                                        title="Modifica sursa"><b>{translate label='Mod'}</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=sales_source&SourceID={$item.SourceID}&delSource=1'; return false;"
                                                                        title="Sterge sursa"><b>{translate label='Del'}</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="Name_0" name="Name_0" size="24" maxlength="128" class="cod"></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (is_empty(document.getElementById('Name_0').value)) alert('{translate label='Nu ati introdus Numele sursei! '}'); else window.location.href = './?m=admin&o=sales_source&SourceID=0&Name=' + escape(document.getElementById('Name_0').value); return false;"
                                                                    title="Adauga sursa"><b>{translate label='Add'}</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="./?m=admin&o=sales_source" method="post">
                <fieldset>
                    <legend>{translate label='Stadii '}</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td>{translate label='Nume stadiu '}</td>
                                        <td>{translate label='Activ '}</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    {foreach from=$sales_stages key=key item=item}
                                        <tr>
                                            <td><input type="text" id="Stage_{$item.StageID}" name="Stage_{$item.StageID}" value="{$item.Name}" size="24" maxlength="128"
                                                       class="cod"></td>
                                            <td align="center"><input type="checkbox" id="SStatus_{$item.StageID}" value="1" {if $item.Status==1}checked{/if}></td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Stage_{$item.StageID}').value)) alert('{translate label='Nu ati introdus Numele stadiului! '}'); else window.location.href = './?m=admin&o=sales_stage&StageID={$item.StageID}&Name=' + escape(document.getElementById('Stage_{$item.StageID}').value) + '&Status=' + (document.getElementById('SStatus_{$item.StageID}').checked ? 1 : 0); return false;"
                                                                        title="Modifica stadiu"><b>{translate label='Mod'}</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=sales_stage&StageID={$item.StageID}&delStage=1'; return false;"
                                                                        title="Sterge stadiu"><b>{translate label='Del'}</b></a></div>
                                            </td>
                                        </tr>
                                    {/foreach}
                                    <tr>
                                        <td><input type="text" id="Stage_0" name="Stage_0" size="24" maxlength="128" class="cod"/></td>
                                        <td>&nbsp;</td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (is_empty(document.getElementById('Stage_0').value)) alert('{translate label='Nu ati introdus Numele stadiului! '}'); else window.location.href = './?m=admin&o=sales_stage&StageID=0&Name=' + escape(document.getElementById('Stage_0').value); return false;"
                                                                    title="Adauga stadiu"><b>{translate label='Add'}</b></a></div>
                                        </td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='lista diviziilor care apar in aplicatie '}</span></td>
    </tr>
</table>