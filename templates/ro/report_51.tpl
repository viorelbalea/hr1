<div class="filter">
    <select id="JobID">
        <option value="0">{translate label='alege job...'}</option>
        {foreach from=$jobs key=key item=item}
            <optgroup label="{$item.0.CompanyName}">
                {foreach from=$item key=key2 item=item2}
                    <option value="{$item2.JobID}"
                            {if $item2.JobID == $info.InterviewJobID}selected{/if} {if $item2.JobStatus==0}style="color: #FF0000;"{/if}  {if $smarty.get.JobID==$item2.JobID} selected="selected"{/if}>{$item2.JobTitle}
                        [ {$item2.PositionNo} pozitii ]{if $item2.JobStatus==0} [ job expirat ]{/if}</option>
                {/foreach}
            </optgroup>
        {/foreach}
    </select>

    <select id="Type" name="Type">
        <option value="0">{translate label='alege tip...'}</option>
        <option value="employee" {if $smarty.get.Type=='employee'}selected="selected"{/if}>{translate label='Angajati'}</option>
        <option value="colaborator" {if $smarty.get.Type=='colaborator'}selected="selected"{/if}>{translate label='Colaboratori'}</option>
        <option value="candidate" {if $smarty.get.Type=='candidate'}selected="selected"{/if}>{translate label='Candidati'}</option>
    </select>
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&JobID=' + document.getElementById('JobID').value + '&Type=' + document.getElementById('Type').value">
</div>
{if !empty($smarty.get.JobID)}
    <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume'}</b></td>
            <td><b>{translate label='Prenume'}</b></td>
            <td><b>{translate label='Email'}</b></td>
            <td><b>{translate label='Telefon'}</b></td>
            <td><b>{translate label='Judet'}</b></td>
            <td><b>{translate label='Oras'}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.LastName}</td>
                <td>{$item.FirstName}</td>
                <td>{$item.Email|default:'-'}</td>
                <td>{$item.Phone|default:'-'}</td>
                <td>{$item.DistrictName|default:'-'}</td>
                <td>{$item.CityName|default:'-'}</td>
            </tr>
            {foreachelse}
            <tr>
                <td colspan="7">Nu sunt date!</td>
            </tr>
        {/foreach}
    </table>
{/if}