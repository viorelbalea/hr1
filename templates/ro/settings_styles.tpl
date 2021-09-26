{include file="settings_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="settings_submenu_2.tpl"}</span></td>
    </tr>
    <tr>
        <td width="400">
            <form action="{$smarty.server.REQUEST_URI}" method="post">
                <fieldset>
                    <legend>{translate label='Stiluri disponibile'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <b>{translate label='Selecteaza stil'}: </b>
                                <select id="StyleID" name="StyleID" class="cod">
                                    {foreach from=$styles key=key item=item}
                                        <option value="{$item.StyleID}" {if $key==$StyleID}selected{/if}>{$item.Name}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br/><input type="submit" value="{translate label='Salveaza'}" class="formstyle">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
</table>