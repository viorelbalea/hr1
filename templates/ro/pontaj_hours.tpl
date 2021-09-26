{include file="pontaj_menu.tpl"}
<br>
{if !empty($selections.1.ProjectID) && isset($selections.1.PhaseID)}
    <div align="right" style="padding-bottom: 4px;">
        {if !empty($pontaj)}
            <a href="./?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}&year={$smarty.get.year|default:0}&month={$smarty.get.month|default:0}&day={$smarty.get.day|default:0}&prev={if !empty($smarty.get.prev)}{$smarty.get.prev+1}{else}1{/if}">{translate label='saptamana anterioara'}</a>
            &nbsp;|&nbsp;
        {/if}
        {if !empty($smarty.get.prev)}
            <a href="./?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}&year={$smarty.get.year|default:0}&month={$smarty.get.month|default:0}&day={$smarty.get.day|default:0}&prev={$smarty.get.prev-1}">{translate label='saptamana urmatoare'}</a>
            &nbsp;|&nbsp;
        {/if}
        <b>{$FullName}</b>
    </div>
{/if}

<table width="100%" cellspacing="0" cellpadding="4">
    {foreach from=$selections key=sel_index item=sel name=itp}
        <tr>
            <td colspan="9" align="right" style="padding-top: 14px; padding-bottom: 10px;" class="pontaj1 pontaj2">
                <table width="100%" cellspacing="0" cellpadding="0">
                    <tr>
                        <td>
                            <form action="{$smarty.server.REQUEST_URI}" method="post">
                                <b>Cod proiect:</b>
                                <select name="ProjectID"
                                        onchange="if (this.value > 0) window.location.href = './?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}&ProjectID=' + this.value + '&sel_index={$sel_index}';">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$pontaj2 key=key item=item}
                                        <option value="{$key}" {if $key==$sel.ProjectID}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <b>Nume proiect:</b>
                                <select name="ProjectID2"
                                        onchange="if (this.value > 0) window.location.href = './?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}&ProjectID=' + this.value + '&sel_index={$sel_index}';">
                                    <option value="0">{translate label='alege...'}</option>
                                    {foreach from=$pontaj key=key item=item}
                                        <option value="{$key}" {if $key==$sel.ProjectID}selected{/if}>{$item.name}</option>
                                    {/foreach}
                                </select>
                                {if !empty($sel.ProjectID) && isset($pontaj[$sel.ProjectID].phases)}
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <b>Faza:</b>
                                    <select name="PhaseID" id="PhaseID_{$sel_index}">
                                        {if $ALLOW_ALL==1}
                                            <option value="-1">{translate label='alege...'}</option>{/if}
                                        {foreach from=$pontaj[$sel.ProjectID].phases key=key item=item}
                                            {if $key > 0}
                                                <option value="{$key}"
                                                        {if (!empty($sel.PhaseID) && $key==$sel.PhaseID) || (empty($sel.PhaseID) && $key == $pontaj[$sel.ProjectID].phase)}selected{/if}>{$item.name}
                                                    - {$phases.$key.Notes}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                    &nbsp;&nbsp;&nbsp;&nbsp;
                                    <input type="button" value="Vezi pontaj"
                                           onclick="{if $ALLOW_ALL==0}if (document.getElementById('PhaseID_{$sel_index}').value > 0) {/if}window.location.href = './?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}&ProjectID={$sel.ProjectID}&PhaseID=' + document.getElementById('PhaseID_{$sel_index}').value + '&sel_index={$sel_index}';">
                                {/if}
                        </td>
                        {if !empty($sel.ProjectID) && isset($sel.PhaseID)}
                            {if !empty($permissions_full) || !empty($permissions)}
                                <td align="right">
                                    <input type="submit" value="{translate label='Salveaza'}">
                                </td>
                            {/if}
                        {/if}
                    </tr>
                </table>
            </td>
        </tr>
        {if !empty($sel.ProjectID) && isset($sel.PhaseID)}
            <tr bgcolor="#eeeeee">
                {if $ALLOW_ALL==1}
                    <td class="pontaj2 pontajl"><b>Faza</b></td>
                {/if}
                <td class="pontaj2 pontajl"><b>{translate label='Activitate'}</b></td>
                {foreach from=$days key=key item=item}
                    {assign var="wday" value=$item|date_format:'%A'}
                    <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if} class="pontaj2"><b>{$week_days.$wday}</b></td>
                {/foreach}
            </tr>
            <tr bgcolor="#eeeeee">
                {if $ALLOW_ALL==1}
                    <td class="pontaj2 pontajl">&nbsp;</td>
                {/if}
                <td class="pontaj2 pontajl">&nbsp;</td>
                {foreach from=$days key=key item=item}
                    <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if} class="pontaj2"><b>{$item|date_format:'%d.%m.%Y'}</b></td>
                {/foreach}
            </tr>
            {foreach from=$pontaj[$sel.ProjectID].phases key=PhaseID item=phases}
                {if $sel.PhaseID <= 0 || ($sel.PhaseID > 0 && $PhaseID == $sel.PhaseID)}
                    {foreach from=$pontaj[$sel.ProjectID].phases[$PhaseID].activities key=ActivityID item=info name=iter}
                        <tr>
                            {if $ALLOW_ALL==1}
                                <td class="pontaj2 pontajl">{if $smarty.foreach.iter.iteration==1}
                                <b>{$pontaj[$sel.ProjectID].phases[$PhaseID].name|default:'&nbsp;'}</b>{else}&nbsp;{/if}</td>{/if}
                            <td class="pontaj2 pontajl"><b>{$info.name|default}</b></td>
                            {foreach from=$days key=key item=item}
                                <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if} class="pontaj2">
                                    {if ((isset($permissions.$item) && $info.hours.$item|default:0 >= 0) || isset($permissions_full.$item)) && $info.active == 1}
                                        <input type="text" name="hours[{$sel.ProjectID}][{$PhaseID}][{$ActivityID}][{$item}]" value="{$info.hours.$item|default:0}" size="3"
                                               maxlength="2">
                                    {else}
                                        {$info.hours.$item|default:0}
                                    {/if}
                                </td>
                            {/foreach}
                        </tr>
                    {/foreach}
                {/if}
            {/foreach}
            {*
            <tr bgcolor="#eeeeee">
            {if $ALLOW_ALL==1}<td class="pontajr pontajl">&nbsp;</td>{/if}
            <td class="pontajr pontajl"><b>{translate label='TOTAL PROIECT'}</b></td>
            {foreach from=$days key=key item=item}
            <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if} class="pontajr"><b>{$pontaj[$sel.ProjectID].total.$item|default:0}</b></td>
            {/foreach}
            </tr>
            *}
        {/if}
        {if !empty($selections.1.ProjectID) && isset($selections.1.PhaseID) && $smarty.foreach.itp.last}
            <tr bgcolor="#eeeeee" height="40">
                {if $ALLOW_ALL==1}
                    <td class="pontaj2 pontajl">&nbsp;</td>
                {/if}
                <td class="pontaj2 pontajl"><b>{translate label='TOTAL ZILNIC'}</b></td>
                {foreach from=$days key=key item=item name=itt}
                    <td align="center" {if $key>=5}bgcolor="#eeeeee"{/if} class="pontaj2{if $smarty.foreach.itt.last} pontajr{/if}"><b>{$totalg.$item|default:0}</b></td>
                {/foreach}
            </tr>
        {/if}
    {/foreach}
</table>

{if !empty($selections.1.ProjectID) && isset($selections.1.PhaseID)}
    <br>
    <div align="right">
        <input type="button" value="Refacere selectie" onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = './?m=pontaj&o=pontaj&PersonID={$smarty.get.PersonID}';">
        <input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=pontaj';">
    </div>
    <br>
    <div style="width: 300px;">{$cal}</div>
{/if}
