{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Definire rate de schimb anuale'}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Rate de schimb anuale'}. {translate label='Moneda de referinta curenta a aplicatiei'}: <b>{$smarty.session.CURRENCY.CURRENT}</b></legend>
                <table border="0" cellpadding="2" cellspacing="0" class="screen" width="50%">
                    <tr>
                        <td nowrap="nowrap" width="60">{translate label='Anul'}:</td>
                        <td nowrap="nowrap" width="130">{translate label='Moneda'} {translate label='referinta'}/ {translate label='convertita'}*:</td>
                        <td nowrap="nowrap" width="20">&nbsp;</td>
                        <td nowrap="nowrap" width="80">{translate label='Curs'}*:</td>
                        <td nowrap="nowrap" width="150">{translate label='Tip'}:</td>
                        <td nowrap="nowrap" width="50">{translate label='Status'}:</td>
                        <td nowrap="nowrap" width="200">{translate label='Observatii'}:</td>
                        <td>&nbsp;</td>
                    </tr>
                </table>
                {foreach from=$rates key=key_init item=item name=iter}
                    <form action="{$smarty.server.REQUEST_URI}&PeriodID={$key_init}" method="post" name="b_{$key_init}" style="margin:0;">
                        <table border="0" cellpadding="2" cellspacing="0" class="screen" width="50%">
                            <tr>
                                <td nowrap="nowrap" width="60">
                                    <select id="Year" name="Year">
                                        <option value="0">{translate label='Alege'}</option>
                                        {foreach from=$years item=year}
                                            <option value="{$year}" {if $year == $item.Year}selected="selected"{/if}>{$year}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td nowrap="nowrap" width="130">
                                    <select id="Currency" name="Currency">
                                        <option value="0">{translate label='Alege'}</option>
                                        {foreach from=$currencies item=curr}
                                            <option value="{$curr}" {if $curr == $item.Parity}selected="selected"{/if}>{$curr}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td width="20" nowrap="nowrap"><b>=</b></td>
                                <td nowrap="nowrap" style="padding-top: 10px;" width="80">
                                    <input type="text" name="Rate" id="Rate" value="{$item.Rate}" style="width:50px;"/>
                                </td>
                                <td width="150" nowrap="nowrap">
                                    <select id="Type" name="Type">
                                        <option value="0">{translate label='Alege'}</option>
                                        {foreach from=$types key=key item=type }
                                            <option value="{$key}" {if $key == $item.Type}selected="selected"{/if}>{$type}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td nowrap="nowrap" width="50">
                                    <input type="checkbox" name="Status" id="Status" {if $item.Status==1} checked="checked"{/if} value="1"/>
                                </td>
                                <td nowrap="nowrap" width="200">
                                    <textarea name="Note" id="Note" rows="1" cols="30">{$item.Note}</textarea>
                                </td>
                                {if $key_init > 0}
                                    <td width="20">
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.b_{$key_init}.Year.value > 0 && isNaN(parseInt(document.b_{$key_init}.Currency.value)) &&  document.b_{$key_init}.Rate.value > 0) document.b_{$key_init}.submit(); else alert('{translate label='Alegeti anul, monedele si completati valoarea'}!'); return false;"
                                                                title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                    </td>
                                    <td width="20">
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&PeriodID={$key_init}&del=1'; return false;"
                                                                title="{translate label='Sterge'}"><b>Del</b></a></div>
                                    </td>
                                {else}
                                    <td width="20">
                                        <div id="button_add"><a href="#"
                                                                onclick="if (document.b_{$key_init}.Year.value > 0 && isNaN(parseInt(document.b_{$key_init}.Currency.value)) && document.b_{$key_init}.Rate.value > 0) document.b_{$key_init}.submit(); else alert('{translate label='Alegeti anul, monedele si completati valoarea'}!'); return false;"
                                                                title="{translate label='Adauga'}"><b>Add</b></a></div>
                                    </td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                {/foreach}
            </fieldset>
        </td>
    </tr>
</table>

<script type='text/javascript'>
    {literal}
    function uncheckAll(type) {
        {/literal}
        {foreach from=$periods key=key item=item}
        document.getElementById('Status_' + {$key}).checked = false;
        {/foreach}
        {literal}
    }
    {/literal}
</script>
