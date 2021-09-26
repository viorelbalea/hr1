<table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
        <td><b>#</b></td>
        <td><b>{translate label='Dept'}</b></td>
        <td><b>{translate label='Nume si prenume'}</b></td>
        <td><b>{translate label='Cod ang'}</b></td>
        <td><b>{translate label='Zile lucr'}</b></td>
        <td><b>{translate label='ZCO'}</b></td>
        <td><b>{translate label='Zile CM'}</b></td>
        <td><b>{translate label='Zile CIC'}</b></td>
        <td><b>{translate label='Zile CFS'}</b></td>
        <td><b>{translate label='Nemotivat'}</b></td>
        <td><b>{translate label='ZCO ANT'}</b></td>
        <td><b>{translate label='Zile prez'}</b></td>
        <td><b>{translate label='Ore noapte'}</b></td>
        <td><b>{translate label='Ore supl efectuate dupa prog.normal de lucru'}</b></td>
        <td><b>{translate label='Ore efectuate in zile de repaus sapt'}</b></td>
        <td><b>{translate label='Ore efectuate in zilele de sarb.legale'}</b></td>
        <td><b>{translate label='Ore lucrate sambata si duminica, ptr unitatile cu acest tip de program'}</b></td>
        <td><b>{translate label='Tichete'}</b></td>
        <td><b>{translate label='avansuri'}</b></td>
        <td><b>{translate label='CMU'}</b></td>
        <td><b>{translate label='avantaj natura'}</b></td>
        <td><b>{translate label='sala sport'}</b></td>
        <td><b>{translate label='prima neta din vanzari'}</b></td>
        <td><b>{translate label='retineri pensii facultative'}</b></td>
        <td><b>{translate label='prima bruta'}</b></td>
        <td><b>{translate label='bonus'}</b></td>
    </tr>
    {foreach from=$persons key=key item=item name=iter}
        {if $key>0}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.Department|default:'-'}</td>
                <td>{$item.LastName} {$item.FirstName}</td>
                <td>{$item.EmpCode|default:'-'}</td>
                <td>{$item.LUCR}</td>
                <td>{$item.CO|default:'0'}</td>
                <td>{$item.CM|default:'0'}</td>
                <td>{$item.CIC|default:'0'}</td>
                <td>{$item.CFS|default:'0'}</td>
                <td>0</td> <!-- de obicei 0 -->
                <td>0</td> <!-- de obicei 0 -->
                <td>{$persons.0.work_days}</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>0</td>
                <td>{$item.BNatura|default:'0'}</td>
                <td>{$item.BSport|default:'0'}</td>
                <td>{$item.BSales|default:'0'}</td>
                <td>{$item.PFac|default:'0'}</td>
                <td>0</td>
                <td>{$item.Bonus|default:'0'}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr>
            <td colspan="7">Nu sunt date!</td>
        </tr>
    {/foreach}
</table>
