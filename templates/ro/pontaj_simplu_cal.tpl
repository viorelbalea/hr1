{include file="pontaj_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <div align="right" style="padding-bottom: 4px;">
        {if !empty($pontaj)}
            <a href="./?m=pontaj&o=psimple_cal&PersonID={$smarty.get.PersonID}&prev={if !empty($smarty.get.prev)}{$smarty.get.prev+1}{else}1{/if}">{translate label='saptamana anterioara'}</a>
            &nbsp;|&nbsp;
        {/if}
        {if !empty($smarty.get.prev)}
            <a href="./?m=pontaj&o=psimple_cal&PersonID={$smarty.get.PersonID}&prev={$smarty.get.prev-1}">{translate label='saptamana urmatoare'}</a>
            &nbsp;|&nbsp;
        {/if}
        <b>{$FullName}</b>
    </div>
    <table width="100%" cellspacing="0" cellpadding="6" border="1">
        <tr>
            <td>&nbsp;</td>
            {foreach from=$days key=key item=item}
                {assign var="wday" value=$item|date_format:'%A'}
                <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if}><b>{$week_days.$wday}</b></td>
            {/foreach}
        </tr>
        <tr>
            <td>&nbsp;</td>
            {foreach from=$days key=key item=item}
                <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if}><b>{$item|date_format:'%d.%m.%Y'}</b></td>
            {/foreach}
        </tr>
        {foreach from=$hourstype key=type item=i name=iter}
            <tr>
                <td><b>{$i}</b></td>
                {foreach from=$days key=key item=item}
                    {assign var="Hours" value="Hours_"|cat:$type}
                    <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if}>
                        {if (isset($permissions.$item) && $pontaj.$item.$Hours|default:0 >= 0) || isset($permissions_full.$item)}
                            {if $smarty.foreach.iter.iteration <= 5}
                                <input type="text" name="hours[{$pontaj.$item.ID|default:$item}][Hours_{$type}]" value="{$pontaj.$item.$Hours|default:0}" size="3" maxlength="2">
                            {else}
                                <input type="checkbox" name="hours[{$pontaj.$item.ID|default:$item}][Hours_{$type}]" value="1" {if $pontaj.$item.$Hours|default:0 == 1}checked{/if}>
                            {/if}
                        {else}
                            {if $smarty.foreach.iter.iteration <= 4}
                                {$pontaj.$item.$Hours|default:0}
                            {else}
                                <input type="checkbox" name="hours[{$pontaj.$item.ID|default:$item}][Hours_{$type}]" value="1" {if $pontaj.$item.$Hours|default:0 == 1}checked{/if}
                                       disabled>
                            {/if}
                        {/if}
                    </td>
                {/foreach}
            </tr>
        {/foreach}
        <tr>
            <td><b>{translate label='TOTAL ZILNIC'}</b></td>
            {foreach from=$days key=key item=item}
                <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if}>
                    <b>{$pontaj.$item.total|default:0}</b>
                </td>
            {/foreach}
        </tr>
    </table>
    <br>
    <div align="center">{if !empty($permissions_full) || !empty($permissions)}<input type="submit" value="{translate label='Salveaza'}">&nbsp;{/if}<input type="button"
                                                                                                                                                          value="{translate label='Inapoi'}"
                                                                                                                                                          onclick="window.location.href = './?m=pontaj&o=psimple';">
    </div>
</form>
<div style="width: 300px;">{$cal}</div>