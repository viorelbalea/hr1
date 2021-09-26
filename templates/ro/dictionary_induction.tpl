{include file="dictionary_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Inductie'}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Capitole'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Nume capitol'}</td>
                                    <td>{translate label='Activ'}</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                {foreach from=$induction key=key item=item}
                                    <tr>
                                        <td><input type="text" id="Cap_{$key}" value="{$item.Capitol}" size="40" maxlength="255"></td>
                                        <td align="center"><input type="checkbox" id="Status_cap_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=induction&CapitolID={$key}&Capitol=' + escape(document.getElementById('Cap_{$key}').value) + '&Status=' + (document.getElementById('Status_cap_{$key}').checked ? 1 : 0); return false;"
                                                                        title="{translate label='Modifica capitol'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Stergerea unui capitol implica stergerea tuturor item-urilor aferente.\nSunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=induction&CapitolID={$key}&delCapitol=1'; return false;"
                                                                        title="{translate label='Sterge capitol'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="Cap_0" size="40" maxlength="255"></td>
                                        <td colspan="3">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=induction&CapitolID=0&Capitol=' + escape(document.getElementById('Cap_0').value); return false;"
                                                                    title="{translate label='Adauga capitol'}"><b>Add</b></a></div>
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
                <legend>{translate label='Items'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select onchange="if (this.value>0) window.location.href='./?m=dictionary&o=induction&CapitolID=' + this.value">
                                <option value="">{translate label='alege capitol'}</option>
                                {foreach from=$induction key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.CapitolID}selected{/if}>{$item.Capitol}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.CapitolID)}
                    <fieldset>
                        <legend>{translate label='Items'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Nume'}</td>
                                <td colspan="3">{translate label='Activ'}</td>
                            </tr>
                            {foreach from=$induction_items key=key item=item}
                                <tr>
                                    <td><input type="text" id="Item_{$key}" value="{$item.Item}" size="40" maxlength="255"></td>
                                    <td align="center"><input type="checkbox" id="Status_item_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                    {if $rw == 1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=induction&CapitolID={$smarty.get.CapitolID}&ItemID={$key}&Item=' + escape(document.getElementById('Item_{$key}').value) + '&Status=' + (document.getElementById('Status_item_{$key}').checked ? 1 : 0); return false;"
                                                                    title="{translate label='Modifica item'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=induction&CapitolID={$smarty.get.CapitolID}&ItemID={$key}&delItem={$key}'; return false;"
                                                                    title="{translate label='Sterge item'}"><b>Del</b></a></div>
                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}
                            {if $rw == 1}
                                <tr>
                                    <td><input type="text" id="Item_0" size="40" maxlength="255"></td>
                                    <td colspan="3">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=induction&CapitolID={$smarty.get.CapitolID}&ItemID=0&Item=' + escape(document.getElementById('Item_0').value); return false;"
                                                                title="{translate label='Adauga item'}"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            {/if}
                        </table>
                    </fieldset>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='dictionar inductie'}</span></td>
    </tr>
</table>
