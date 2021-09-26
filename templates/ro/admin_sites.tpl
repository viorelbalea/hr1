{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Locatii & sali'}</span></td>
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
                <legend>{translate label='Locatii '}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                {foreach from=$sites key=key item=item}
                                    <tr>
                                        <td><input type="text" id="Site_{$key}" name="Site_{$key}" value="{$item}" size="25" maxlength="128"></td>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=admin&o=sites&SiteID={$key}&Site=' + escape(document.getElementById('Site_{$key}').value); return false;"
                                                                    title="Modifica locatie"><b>{translate label='Mod'}</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Stergerea unei locatii implica stergerea tuturor salilor aferente.\nSunteti sigura(a)?')) window.location.href = './?m=admin&o=sites&SiteID={$key}&delSite=1'; return false;"
                                                                    title="Sterge locatie"><b>{translate label='Del'}</b></a></div>
                                        </td>
                                    </tr>
                                {/foreach}
                                <tr>
                                    <td><input type="text" id="Site_0" name="Site_0" size="25" maxlength="128"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=sites&SiteID=0&Site=' + escape(document.getElementById('Site_0').value); return false;"
                                                                title="Adauga locatie"><b>{translate label='Add'}</b></a></div>
                                    </td>
                                </tr>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Locatii si sali'}</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="sites" onchange="if (this.value>0) window.location.href='./?m=admin&o=sites&SiteID=' + this.value">
                                <option value="">{translate label='alege locatia'}</option>
                                {foreach from=$sites key=key item=item}
                                    <option value="{$key}" {if $key == $smarty.get.SiteID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                {if !empty($smarty.get.SiteID)}
                    <fieldset>
                        <legend>{translate label='Sali'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Denumire sala'}</td>
                                <td colspan="3">{translate label='Descriere'}</td>
                            </tr>
                            {foreach from=$rooms key=key item=item}
                                <tr>
                                    <td><input type="text" id="Room_{$key}" name="Room_{$key}" value="{$item.Room}" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_{$key}" name="Notes_{$key}" value="{$item.Notes}" size="30" maxlength="255"></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=sites&SiteID={$smarty.get.SiteID}&RoomID={$key}&Room=' + escape(document.getElementById('Room_{$key}').value) + '&Notes=' + escape(document.getElementById('Notes_{$key}').value); return false;"
                                                                title="Modifica sala"><b>{translate label='Mod'}</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = './?m=admin&o=sites&SiteID={$smarty.get.SiteID}&RoomID={$key}&delRoom={$key}'; return false;"
                                                                title="Sterge sala"><b>{translate label='Del'}</b></a></div>
                                    </td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td><input type="text" id="Room_0" name="Room_0" size="20" maxlength="32"></td>
                                <td><input type="text" id="Notes_0" name="Notes_0" size="30" maxlength="255"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=admin&o=sites&SiteID={$smarty.get.SiteID}&RoomID=0&Room=' + escape(document.getElementById('Room_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                            title="Adauga sala"><b>{translate label='Add'}</b></a></div>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='Locatii & sali'}</span></td>
    </tr>
</table>
