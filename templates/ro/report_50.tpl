<div class="filter">
    <select id="ProjectID">
        <option value="0">{translate label='alege proiect...'}</option>
        {foreach from=$projects key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.ProjectID} selected="selected"{/if}>{$item.Name}</option>
        {/foreach}
    </select>
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&ProjectID=' + document.getElementById('ProjectID').value">
</div>
{if !empty($smarty.get.ProjectID)}
    <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume'}</b></td>
            <td><b>{translate label='Prenume'}</b></td>
            <td><b>{translate label='Pozitia'}</b></td>
            <td><b>{translate label='Numar interviu'}</b></td>
            <td><b>{translate label='Calificativ'}</b></td>
            <td><b>{translate label='Data interviu'}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.LastName}</td>
                <td>{$item.FirstName}</td>
                <td>{$item.JobTitle}</td>
                <td>{$item.InterviewNo}</td>
                <td>{if $item.InterviewQual > 0}{$interviuQ[$item.InterviewQual]}{else}-{/if}</td>
                <td>{$item.EventData|date_format:'%d.%m.%Y'} {$item.EventHourStart} - {$item.EventHourStop}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="7">Nu sunt date!</td>
            </tr>
        {/foreach}
    </table>
{/if}