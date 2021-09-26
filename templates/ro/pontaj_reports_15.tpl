<table width="100%" cellspacing="0" cellpadding="2" class="filter" style="margin-top:6px;">
    <tr>
        <td><b>{translate label='Angajat'}</b>&nbsp;<a href="./?m=pontaj&o=reports&report_id=15&order_by=FullName&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="./?m=pontaj&o=reports&report_id=15&order_by=FullName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td><b>{translate label='Rol'}</b></td>
        <td><b>{translate label='Data'}<br>{translate label='pontaj'}</b>&nbsp;<a href="./?m=pontaj&o=reports&report_id=15&order_by=Data&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=pontaj&o=reports&report_id=15&order_by=Data&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                                       border="0"></a></td>
        <td><b>{translate label='Cod proiect'}</b></td>
        <td><b>{translate label='Nr. contract'}</b></td>
        <td><b>{translate label='Data contract'}</b></td>
        <td><b>{translate label='Obiect contract'}</b></td>
        <td><b>{translate label='Faza'}</b></td>
        <td><b>{translate label='Activitate'}</b></td>
        <td><b>{translate label='Ore pontate'}</b></td>
        <td><b>{translate label='Cost'}</b></td>
    </tr>
    {foreach from=$report item=item}
        <tr>
            <td class="celulaMenuST">{$item.FullName}</td>
            <td class="celulaMenuST">{$item.Role}</td>
            <td class="celulaMenuST">{$item.FData|default:'-'}</td>
            <td class="celulaMenuST">{$item.Code}</td>
            <td class="celulaMenuST">{$item.ContractNo|default:'-'}</td>
            <td class="celulaMenuST">{$item.ContractDate|default:'-'}</td>
            <td class="celulaMenuST">{$item.Name}</td>
            <td class="celulaMenuST">{$item.Phase}</td>
            <td class="celulaMenuST">{$item.Activity}</td>
            <td class="celulaMenuST">{$item.Hours}</td>
            <td class="celulaMenuST">-</td>
        </tr>
    {/foreach}
</table>
