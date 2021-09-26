<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport de activitate pe perioada '}{$smarty.get.Year} - {$smarty.get.Month} {translate label='pentru proiectul'} "{$projects[$smarty.get.ProjectID]}
            " {translate label='pentru'} {$persons[$smarty.get.PersonID]}</b>
    {else}
        {translate label='Perioada intre '}
        <select name="Year" id="Year">
            <option value="0">{translate label='alege An...'}</option>
            {foreach from=$years item=item2}
                <option value="{$item2}" {if $smarty.get.Year==$item2}selected{/if}>{$item2}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
        <select name="Month" id="Month">
            <option value="0">{translate label='alege Luna...'}</option>
            {foreach from=$months item=item2}
                <option value="{$item2}" {if $smarty.get.Month==$item2}selected{/if}>{$item2}</option>
            {/foreach}
        </select>
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
               onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&Year=' + document.getElementById('Year').value + '&Month=' + document.getElementById('Month').value + '&ProjectID=' + document.getElementById('ProjectID').value + '&PersonID=' + document.getElementById('PersonID').value;">
    {/if}
</div>
{if !empty($smarty.get.Year) && !empty($smarty.get.Month)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr>
            <td align="center"><b>{translate label='Cod Proiect'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Code&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Code&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Faza proiect'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Phase&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Phase&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            {*<td align="center"><b>{translate label='Faze activitate'}</b></td>*}
            <td><b>Activitate</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Activity&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=Activity&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Perioada activitate'}</b></td>
            <td align="center"><b>{translate label='Numar total ore'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=THours&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=THours&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td align="center"><b>{translate label='Numar total ore personal'}</b>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=PHours&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=pontaj&o=reports&report_id=4&ProjectID={$smarty.get.ProjectID}&PersonID={$smarty.get.PersonID}&Year={$smarty.get.Year|date_format:'%d.%m.%Y'}&Month={$smarty.get.Month|date_format:'%d.%m.%Y'}&order_by=PHours&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
        </tr>
        {foreach from=$report item=item}
            <tr>
                <td class="celulaMenuST" style="text-align: center;">{$item.Code}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.Phase|default:'-'}</td>
                {*<td class="celulaMenuST" style="text-align: center;">{$item.PhaseAct}</td>*}
                <td class="celulaMenuST">{$item.Activity}</td>
                <td class="celulaMenuST" style="text-align: center;">{$item.StartDate} - {$item.EndDate}</td>
                <td class="celulaMenuSTDR" style="text-align: center;">{$item.THours}</td>
                <td class="celulaMenuSTDR" style="text-align: center;">{$item.PHours}</td>
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="6">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}