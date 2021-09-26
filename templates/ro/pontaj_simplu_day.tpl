{include file="pontaj_menu.tpl"}
<br>
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <b>{translate label='An'}:</b>
    <select name="Year" id="Year">
        {foreach from=$years item=item}
            <option value="{$item}" {if $item==$curr_year}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <b>{translate label='Luna'}:</b>
    <select name="Month" id="Month">
        {foreach from=$months item=item}
            <option value="{$item}" {if $item==$curr_month}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;
    <b>{translate label='Ziua'}:</b>
    <select name="Day" id="Day">
        {foreach from=$days item=item}
            <option value="{$item}" {if $item==$curr_day}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="Vezi pontaj"
                                   onclick="window.location.href = './?m=pontaj&o=psimple_day&PersonID={$smarty.get.PersonID}&Year=' + document.getElementById('Year').value + '&Month=' + document.getElementById('Month').value + '&Day=' + document.getElementById('Day').value;">
</form>
{if !empty($smarty.get.Day)}
    <div align="right" style="padding-bottom: 4px;">
        <b>{$FullName}</b>
    </div>
    <br>
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table cellspacing="0" cellpadding="4">
            {assign var="total" value="0"}
            {foreach from=$hourstype key=key item=item name=iter}
                <tr>
                    <td>{$item}:</td>
                    <td align="center">
                        {assign var="Hours" value="Hours_"|cat:$key}
                        {if ($permissions == 1 && $hours.$Hours|default:0 >= 0) || $permissions == 2 || $permissions_full == 1}
                            {if $smarty.foreach.iter.iteration <= 5}
                                <input type="text" name="hours[{$Hours}]" value="{$hours.$Hours|default:0}" size="2" maxlength="2">
                                {math equation="x+y" x=$total y=$hours.$Hours|default:0 assign="total"}
                            {else}
                                <input type="checkbox" name="hours[{$Hours}]" value="1" {if $hours.$Hours|default:0 == 1}checked{/if}>
                            {/if}
                        {else}
                            {if $smarty.foreach.iter.iteration <= 4}
                                {$hours.$Hours|default:0}
                                {math equation="x+y" x=$total y=$hours.$Hours|default:0 assign="total"}
                            {else}
                                <input type="checkbox" name="hours[{$Hours}]" value="1" {if $hours.$Hours==1}checked{/if} disabled>
                            {/if}
                        {/if}
                    </td>
                    <td>&nbsp;</td>
                </tr>
            {/foreach}
            <tr>
                <td><b>{translate label='Total ore'}:</b></td>
                <td align="center">
                    <b>{$total}</b>
                </td>
                <td>&nbsp;</td>
            </tr>
            <tr>
                <td>&nbsp;</td>
                {if $permissions_full == 1 || $permissions > 0}
                    <td><input type="submit" value="{translate label='Salveaza'}"></td>
                    <td><input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=pontaj&o=psimple';"></td>
                {else}
                    <td colspan="2"><input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=pontaj&o=psimple';"></td>
                {/if}
            </tr>
        </table>
    </form>
{/if}
<br>
<div style="width: 300px;">{$cal}</div>