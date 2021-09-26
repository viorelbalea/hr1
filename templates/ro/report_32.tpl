<select name="year" onchange="window.location.href = './?m=reports&rep=32&Year=' + this.value;">
    {foreach from=$years item=item}
        <option value="{$item}" {if $item==$smarty.get.Year}selected{/if}>{$item}</option>
    {/foreach}
</select>
<br><br>
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
        <td><b>#</b></td>
        <td><b>{translate label='Nume'}</b></td>
        <td><b>{translate label='Data angajarii'}</b></td>
        <td align="center"><b>{translate label='Total zile'} CO</b></td>
        <td align="center"><b>{translate label='Zile efectuate'} CO</b></td>
        <td align="center"><b>{translate label='Zile efectuate'} CM</b></td>
        <td align="center"><b>{translate label='Zile efectuate'} CFS</b></td>
        <td align="center"><b>{translate label='Zile efectuate'} CE</b></td>
        <td align="center"><b>{translate label='Zile efectuate'} CIC</b></td>
    </tr>
    {foreach from=$persons item=item name=iter}
        <tr>
            <td>{$smarty.foreach.iter.iteration}</td>
            <td>{$item.FullName}</td>
            <td>{$item.DataStart}</td>
            <td align="center">{$item.TotalCO}</td>
            <td align="center">{$item.TCO|default:0}</td>
            <td align="center">{$item.TCM|default:0}</td>
            <td align="center">{$item.TCFS|default:0}</td>
            <td align="center">{$item.TCE|default:0}</td>
            <td align="center">{$item.TCIC|default:0}</td>
        </tr>
    {/foreach}
</table>
