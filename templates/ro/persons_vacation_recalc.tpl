{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Recalculare concedii'}</span></td>
    </tr>
    <tr>
        <td>
            <select name="year" onchange="if (this.value > 0) window.location.href = './?m=persons&o=vacation_recalc&year=' + this.value;">
                <option value="0">{translate label='alege anul...'}</option>
                {foreach from=$years item=year}
                    <option value="{$year}" {if $year == $smarty.get.year}selected{/if}>{$year}</option>
                {/foreach}
            </select>
        </td>
    </tr>
</table>
{if !empty($success)}
    {translate label='Recalculare finalizata pentru %s' values=$smarty.get.year}!
{/if}
