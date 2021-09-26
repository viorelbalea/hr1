{include file="reports_maker_menu.tpl"}
<br>

{if !empty($smarty.get.ReportID)}
    {include file="reports_maker_new_view.tpl"}
{else}
    <select onchange="window.location.href = './?m=reports_maker&o=myreports&ReportID=' + this.value;">
        <option value="0">{translate label="alege raport"}</option>
        {foreach from=$reports item=item}
            <option value="{$item.ReportID}" {if $smarty.get.ReportID==$item.ReportID}selected{/if}>{$item.Report}</option>
        {/foreach}
    </select>
{/if}
