<div class="filter">
    <select id="CostCenterID">
        <option value="0">{translate label='alege proiectul'}</option>
        {foreach from=$projects key=key item=item}
            <option value="{$key}" {if $smarty.get.CostCenterID==$key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <input type="button" value="{translate label='Trimite'}"
           onclick="if (document.getElementById('CostCenterID').value > 0) window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&CostCenterID=' + document.getElementById('CostCenterID').value;">
</div>
{if !empty($smarty.get.CostCenterID)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume, prenume'}</b>&nbsp;<a href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=FullName&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=FullName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Status'}</b></td>
            <td><b>{translate label='Data contractului'}</b>&nbsp;<a href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=StartDate&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=StartDate&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Data expirarii contractului'}</b>&nbsp;<a href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=StopDate&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=reports&rep=43&CostCenterID={$smarty.get.CostCenterID}&order_by=StopDate&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Proiecte alocate'}</b></td>
            <td><b>{translate label='Functia'}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{$status[$item.Status]}</td>
                <td>{if $item.data_inch != '00.00.0000'}{$item.data_inch|default:'-'}{else}-{/if}</td>
                <td>{if $item.data_exp != '00.00.0000'}{$item.data_exp|default:'-'}{else}-{/if}</td>
                <td>
                    {if $item.CostCenterID > 0}{$projects[$item.CostCenterID]}<br>{/if}
                    {if $item.CostCenterID2 > 0}{$projects[$item.CostCenterID2]}<br>{/if}
                    {if $item.CostCenterID3 > 0}{$projects[$item.CostCenterID3]}<br>{/if}
                    {if $item.CostCenterID4 > 0}{$projects[$item.CostCenterID4]}<br>{/if}
                    {if $item.CostCenterID5 > 0}{$projects[$item.CostCenterID5]}<br>{/if}
                </td>
                <td>{$item.Function|default:'-'}</td>
            </tr>
        {/foreach}
    </table>
{/if}