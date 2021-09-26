<table cellspacing="0" cellpadding="3">
    <tr>
        <td colspan="2"><h3>{$stat.FullName}</h3></td>
    </tr>
    <tr>
        <td><b>{translate label='Regie (Ore normale)'}:</b></td>
        <td align="right"><b>{$stat.NormalHours}</b></td>
    </tr>

    <tr>
        <td><b>{translate label='Ore platite (pentru calcul pensie)'}:</b></td>
        <td align="right"><b>{$stat.NormalHours+$stat.StudyHoursPay}</b></td>
    </tr>

    <tr>
        <td><b>{translate label='Ore completare norma'}:</b></td>
        <td align="right"><b>{$stat.CompletareNorma}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Ore suplimentare'}:</b></td>
        <td align="right"><b>{$stat.SplHours}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Ore noapte'}:</b></td>
        <td align="right"><b>{$stat.NightHours}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Ore spor SD (Ore weekend)'}:</b></td>
        <td align="right"><b>{$stat.WkHours}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Ore sarbatori legale'}:</b></td>
        <td align="right"><b>{$stat.LegalHours}</b></td>
    </tr>
    {foreach from=$pontaj_types key=key item=item}
        {if $key > 1}
            <tr>
                <td><b>{translate label=$item}:</b></td>
                <td align="right"><b>{assign var="htype" value="Hours"|cat:$key}{$stat.$htype|default:0}</b></td>
            </tr>
        {/if}
    {/foreach}
    <tr>
        <td><b>{translate label='Sold ore suplimentare 2 luni'}:</b></td>
        <td align="right"><b>{$stat.Supl2MHours|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Sold ore suplimentare 1 luna'}:</b></td>
        <td align="right"><b>{$stat.Supl1MHours|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile nelucrate'}:</b></td>
        <td align="right"><b>{$stat.DaysNoWork|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Repaus saptamanal'}:</b></td>
        <td align="right"><b>{$stat.DaysRepause|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Somaj tehnic'}:</b></td>
        <td align="right"><b>{$stat.DaysUnempl|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile libere platite'}:</b></td>
        <td align="right"><b>{$stat.DaysPay|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Suspendare contract'}:</b></td>
        <td align="right"><b>{$stat.DaysSuspend|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu odihna'}:</b></td>
        <td align="right"><b>{$stat.DaysCO|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu fara salariu'}:</b></td>
        <td align="right"><b>{$stat.DaysCFS|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu pentru evenimente familiale'}:</b></td>
        <td align="right"><b>{$stat.DaysCE|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu de ingrijire copil'}:</b></td>
        <td align="right"><b>{$stat.DaysCIC|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu special'}:</b></td>
        <td align="right"><b>{$stat.DaysCS|default:0}</b></td>
    </tr>
    <tr>
        <td><b>{translate label='Zile concediu medical'}:</b></td>
        <td align="right"><b>{$stat.DaysCM|default:0}</b></td>
    </tr>
</table>
