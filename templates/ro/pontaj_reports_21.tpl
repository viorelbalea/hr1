<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport invoiri pe perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b>
    {else}
        {translate label='Perioada intre '}
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A>
        si
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A>
        <select id="Status">
            <option value="0">{translate label='Toti'}</option>
            {foreach from=$status item=item key=key}
                <option value="{$key}" {if $smarty.get.Status==$key}selected{/if}>{$item}</option>
            {/foreach}
            <!--
    <option value="2" {if $smarty.get.Status==2}selected{/if}>{translate label='angajati curenti'}</option>
    <option value="7" {if $smarty.get.Status==7}selected{/if}>{translate label='colaboratori'}</option>
	-->
        </select>
    {if !empty($self)}
        &nbsp;
        <select id="CompanyID">
            <option value="0">{translate label='alege compania'}</option>
            {foreach from=$self key=key item=item}
                <option value="{$key}" {if $smarty.get.CompanyID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {/if}
    {if !empty($divisions)}
        &nbsp;
        <select id="DivisionID">
            <option value="0">{translate label='alege divizia'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $smarty.get.DivisionID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {/if}

        &nbsp;&nbsp;&nbsp;
        <input type="button" value="Trimite"
               onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value{if !empty($divisions)} + '&Status=' + document.getElementById('Status').value + '&DivisionID=' + document.getElementById('DivisionID').value{/if}{if !empty($divisions)} + '&CompanyID=' + document.getElementById('CompanyID').value{/if};">
    {/if}
</div>
{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr valign="bottom">
            <td colspan="3">&nbsp;</td>
            {assign var="ZL" value="0"}
            {foreach from=$cal key=data item=wday name=iter}
                <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63" {else}{math equation="x+1" x=$ZL assign="ZL"}}{/if}>
                    <b>{$smarty.foreach.iter.iteration}</b></td>
            {/foreach}
        </tr>
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume prenume'}</b></td>
            <td align="center"><b>{translate label='Total'}</b></td>
            {foreach from=$cal key=data item=wday}
                <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}><b>{$wday}</b></td>
            {/foreach}
            <td colspan="16"><b>{$ZL}{translate label='zile lucratoare'} </b></td>
        </tr>
        {foreach from=$report key=persid item=item name=iter}
            <tr bgcolor="#ffffff">
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td align="center"><b>{$item.Total|@abs}</b></td>
                {foreach from=$cal key=data item=wday}
                    <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>{$item.Data.$data|default:0|@abs}</td>
                {/foreach}
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}