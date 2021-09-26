<div class="filter">
    {translate label='Perioada intre'}
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
    &nbsp;&nbsp;&nbsp;<input type="button" value="Trimite"
                             onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value;">
</div>
{if !empty($report)}
    <table width="100%" cellspacing="0" cellpadding="2" class="filter" style="margin-top:6px;">
        <tr>
            <td><b>{translate label='Rol'}</b></td>
            <td><b>{translate label='Ore'}</b></td>
            <td><b>{translate label='Cost'}</b></td>
        </tr>
        {assign var="THours" value="0"}
        {foreach from=$report item=item}
            <tr>
                <td class="celulaMenuST">{$item.Role}</td>
                <td class="celulaMenuST">{$item.THours}</td>
                <td class="celulaMenuSTDR">{$item.Cost|default:'-'}</td>
            </tr>
            {math equation="x+y" x=$THours y=$item.THours assign="THours"}
        {/foreach}
        <tr>
            <td><b>{translate label='TOTAL PERIOADA'}</b></td>
            <td><b>{$THours}</b></td>
            <td>&nbsp;</td>
        </tr>
    </table>
{/if}