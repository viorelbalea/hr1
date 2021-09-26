{include file="catering_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Dictionar preparate'}</span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Tipuri de mancare'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td>{translate label='Tip mancare'}</td>
                                    <td>{translate label='Pret'}</td>
                                    <td>{translate label='Activ'}</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                {foreach from=$catering key=key item=item}
                                    <tr>
                                        <td><input type="text" id="Cat_{$key}" value="{$item.Category}" size="40" maxlength="255"></td>
                                        <td><input type="text" id="Price_{$key}" value="{$item.Price}" size="10" maxlength="255"></td>
                                        <td align="center"><input type="checkbox" id="Status_cat_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                        {if $rw == 1}
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=catering&o=dictionary&CatID={$key}&Category=' + escape(document.getElementById('Cat_{$key}').value) + '&Price=' + escape(document.getElementById('Price_{$key}').value) + '&Status=' + (document.getElementById('Status_cat_{$key}').checked ? 1 : 0) ; return false;"
                                                                        title="{translate label='Modifica tip mancare'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Stergerea unui tip de mancare implica stergerea tuturor mancarurilor aferente.\nSunteti sigura(a)?'}')) window.location.href = './?m=catering&o=dictionary&CatID={$key}&delCategory=1'; return false;"
                                                                        title="{translate label='Sterge tip mancare'}"><b>Del</b></a></div>
                                            </td>
                                        {/if}
                                    </tr>
                                {/foreach}
                                {if $rw == 1}
                                    <tr>
                                        <td><input type="text" id="Cat_0" size="40" maxlength="255"></td>
                                        <td><input type="text" id="Price_0" size="10" maxlength="255"></td>
                                        <td colspan="3">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=catering&o=dictionary&CatID=0&Category=' + escape(document.getElementById('Cat_0').value) + '&Price=' + escape(document.getElementById('Price_0').value); return false;"
                                                                    title="{translate label='Adauga tip mancare'}"><b>Add</b></a></div>
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
                <legend>{translate label='Mancare'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select onchange="if (this.value>0) window.location.href='./?m=catering&o=dictionary&CatID=' + this.value">
                                <option value="">{translate label='alege categoria'}</option>
                                {foreach from=$catering key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.CatID}selected{/if}>{$item.Category}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.CatID)}
                    <fieldset>
                        <legend>{translate label='Mancare'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Nume mancare'}</td>
                                <td>{translate label='Calorii'}</td>
                                <td colspan="3">{translate label='Activa'}</td>
                            </tr>
                            {foreach from=$catering_items key=key item=item}
                                <tr>
                                    <td><input type="text" id="Item_{$key}" value="{$item.Item}" size="40" maxlength="255"></td>
                                    <td><input type="text" id="Calories_{$key}" value="{$item.Calories}" size="10" maxlength="255"></td>
                                    <td align="center"><input type="checkbox" id="Status_item_{$key}" value="1" {if $item.Status==1}checked{/if}></td>
                                    {if $rw == 1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=catering&o=dictionary&CatID={$smarty.get.CatID}&ItemID={$key}&Item=' + escape(document.getElementById('Item_{$key}').value) + '&Status=' + (document.getElementById('Status_item_{$key}').checked ? 1 : 0)  + '&Calories=' + escape(document.getElementById('Calories_{$key}').value); return false;"
                                                                    title="{translate label='Modifica mancare'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=catering&o=dictionary&CatID={$smarty.get.CatID}&ItemID={$key}&delItem={$key}'; return false;"
                                                                    title="{translate label='Sterge mancare'}"><b>Del</b></a></div>
                                        </td>
                                    {/if}
                                </tr>
                            {/foreach}
                            {if $rw == 1}
                                <tr>
                                    <td><input type="text" id="Item_0" size="40" maxlength="255"></td>
                                    <td><input type="text" id="Calories_0" size="10" maxlength="255"></td>
                                    <td colspan="3">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=catering&o=dictionary&CatID={$smarty.get.CatID}&ItemID=0&Item=' + escape(document.getElementById('Item_0').value)+ '&Calories=' + escape(document.getElementById('Calories_0').value); return false;"
                                                                title="{translate label='Adauga mancare'}"><b>Add</b></a></div>
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
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='dictionar preparate'}</span></td>
    </tr>
</table>
