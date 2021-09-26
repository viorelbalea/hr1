{include file="settings_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="settings_submenu_2.tpl"}</span></td>
    </tr>
    <tr>
        <td width="400">
            <form action="{$smarty.server.REQUEST_URI}" method="post">
                <fieldset>
                    <legend>{translate label='Limbi disponibile'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <b>{translate label='Selecteaza limba'} </b>
                                <select name="lang" class="cod">
                                    {foreach from=$langs key=key item=item}
                                        <option value="{$key}" {if $key == $smarty.session.LANG}selected{/if}>{$item}</option>
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