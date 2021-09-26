<table width="100%" cellspacing="0" cellpadding="2" class="filter" style="margin-top:6px;">
    <tr>
        <td><b>{translate label='Cod proiect'}</b></td>
        <td><b>{translate label='Nr. contract'}</b></td>
        <td><b>{translate label='Data contract'}</b></td>
        <td><b>{translate label='Obiect contract'}</b></td>
        <td><b>{translate label='Data inceput'}</b></td>
        <td><b>{translate label='Data sfarsit'}</b></td>
    </tr>
    {foreach from=$report key=key item=item}
        <tr>
            <td class="celulaMenuST"><b>{$item.Code}</b></td>
            <td class="celulaMenuST">{$item.ContractNo|default:'-'}</td>
            <td class="celulaMenuST">{$item.ContractDate|default:'-'}</td>
            <td class="celulaMenuST">{$item.ContractObj|default:'-'}</td>
            <td class="celulaMenuST">{$item.Data_Min}</td>
            <td class="celulaMenuST">{$item.Data_Max}</td>
        </tr>
        {if !empty($item.Activity)}
            <tr>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuST"><b>{translate label='Activitate'}</b></td>
                <td class="celulaMenuST"><b>{translate label='Faza'}</b></td>
                <td class="celulaMenuST"><b>{translate label='Ore'}</b></td>
                <td class="celulaMenuST"><b>{translate label='Cost'}</b></td>
                <td class="celulaMenuST">&nbsp;</td>
            </tr>
            {foreach from=$item.Activity key=Activity item=act}
                <tr>
                    <td class="celulaMenuST">&nbsp;</td>
                    <td class="celulaMenuST">{$Activity}</td>
                    <td class="celulaMenuST">{$act.Phase}</td>
                    <td class="celulaMenuST">{$act.THours}</td>
                    <td class="celulaMenuST">{$act.Cost|default:'-'}</td>
                    <td class="celulaMenuST">&nbsp;</td>
                </tr>
            {/foreach}
        {/if}
        <tr>
            <td>{translate label='TOTAL'}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{$item.THours}</td>
            <td>{$item.Cost|default:'-'}</td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td colspan="6" class="celulaMenuST">&nbsp;</td>
        </tr>
    {/foreach}
</table>
