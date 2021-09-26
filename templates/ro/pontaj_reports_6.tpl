<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport de costuri pe perioada'} {$smarty.get.StartDate|date_format:'%d.%m.%Y'}
            - {$smarty.get.EndDate|date_format:'%d.%m.%Y'} {translate label='pentru proiectul'} "{$projects[$smarty.get.ProjectID]}
            " {translate label='pentru'} {$persons[$smarty.get.PersonID]}</b>
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
        &nbsp;&nbsp;&nbsp;
        <select name="ProjectID" id="ProjectID">
            <option value="0">{translate label='alege proiect...'}</option>
            {foreach from=$projects key=key item=item}
                <option value="{$key}" {if $smarty.get.ProjectID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
        <select name="PersonID" id="PersonID">
            <option value="0">{translate label='alege persoana...'}</option>
            {foreach from=$persons key=key item=item}
                <option value="{$key}" {if $smarty.get.PersonID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
        <input type="button" value="Trimite"
               onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&ProjectID=' + document.getElementById('ProjectID').value + '&PersonID=' + document.getElementById('PersonID').value;">
    {/if}
</div>
{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr>
            <td align="center"><b>{translate label='Cod Proiect'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Code&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Code&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Faza proiect'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Phase&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Phase&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Faze activitate'}</b></td>
            <td><b>{translate label='Activitate'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Activity&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Activity&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Perioada activitate'}</b></td>
            <td align="center"><b>{translate label='Numar total ore'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=THours&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=THours&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Cost'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Cost&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=6&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&StartDate={$smarty.get.StartDate|date_format:'%d.%m.%Y'}&EndDate={$smarty.get.EndDate|date_format:'%d.%m.%Y'}&order_by=Cost&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
        </tr>
        {foreach from=$report item=item}
            <tr>
                <td class="celulaMenuST" style="text-align: center;">{$item.Code}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.Phase|default:'-'}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.PhaseAct}</td>
                <td class="celulaMenuST">{$item.Activity}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.StartDate} - {$item.EndDate}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.THours}</td>
                <td class="celulaMenuSTDR" style="text-align: center;">{$item.Cost|default:'-'}</td>
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="7">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}