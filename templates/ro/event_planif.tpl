{include file="event_menu.tpl"}
<table cellspacing="0" cellpadding="2" width="100%" class="screen">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><b>{translate label='Calendar evenimente'}</b></span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="padding: 10px 5px 10px 5px;">
            <fieldset>
                <legend>{translate label='Evenimente reprezentantanti companie'}</legend>
                <select name="ConsultantID"
                        onchange="window.location.href = './?m=events&o=planif&RoomID={$smarty.get.RoomID|default:0}&week={$smarty.get.week|default:0}&ConsultantID=' + this.value">
                    <option value="0">{translate label='Reprezentant companie'}</option>
                    {foreach from=$consultants key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.ConsultantID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
                <table cellspacing="0" cellpadding="4" width="100%">
                    <tr valign="bottom">
                        <td>
                            <a href="./?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x-1" x=$smarty.get.week|default:0}">&laquo;</a> {translate label='saptamana anterioara'}
                        </td>
                        <td>{translate label='saptamana curenta'} <input type="checkbox" {if empty($smarty.get.week)}checked{/if}
                                                                         onclick="window.location.href = './?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}';">
                        </td>
                        <td>{translate label='saptamana urmatoare'} <a
                                    href="./?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x+1" x=$smarty.get.week|default:0}">&raquo;</a>
                        </td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="4" width="100%" class="planif_events">
                    <tr>
                        <th width="16%" align="center" style="border-left: 1px solid #666666;"><b>{translate label='Ora / ziua'}</b></th>
                        <th width="12%" align="center">L<br>{$days.0|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Ma<br>{$days.1|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Mi<br>{$days.2|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">J<br>{$days.3|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">V<br>{$days.4|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">S<br>{$days.5|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">D<br>{$days.6|date_format:'%d.%m.%y'}</th>
                    </tr>
                    {foreach from=$hours item=hour}
                        <tr>
                            <td align="center" style="border-left: 1px solid #666666;">{$hour}</td>
                            {foreach from=$days key=key item=day}
                                <td>
                                    {foreach from=$events.$day.$hour key=eventid item=inf}
                                        {if isset($events.$day.$hour.$eventid) && (empty($smarty.get.ConsultantID) || $events.$day.$hour.$eventid.ConsultantID == $smarty.get.ConsultantID || $events.$day.$hour.$eventid.ConsultantID2 == $smarty.get.ConsultantID || $events.$day.$hour.$eventid.ConsultantID3 == $smarty.get.ConsultantID)}
                                            {assign var="Consultant" value=$events.$day.$hour.$eventid.ConsultantID}
                                            {assign var="Consultant2" value=$events.$day.$hour.$eventid.ConsultantID2}
                                            {assign var="Consultant3" value=$events.$day.$hour.$eventid.ConsultantID3}
                                            {assign var="Room" value=$events.$day.$hour.$eventid.RoomID}
                                            <a href="./?m=events&o=edit&EventID={$events.$day.$hour.$eventid.EventID}"
                                               title="{$events.$day.$hour.$eventid.Scope} in {$rooms[$Room]}"><b>{$consultants.$Consultant}{if !empty($Consultant2)}-{$consultants.$Consultant2}{/if}{if !empty($Consultant3)}-{$consultants.$Consultant3}{/if}</b></a>
                                            <br>
                                            <br>
                                        {else}
                                            &nbsp;
                                        {/if}
                                        {foreachelse}
                                        &nbsp;
                                    {/foreach}
                                </td>
                            {/foreach}
                        </tr>
                    {/foreach}
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="padding: 10px 5px 10px 5px;">
            <fieldset>
                <legend>{translate label='Evenimente locatii'}</legend>
                <select name="RoomID"
                        onchange="window.location.href = './?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&week={$smarty.get.week|default:0}&RoomID=' + this.value">
                    <option value="0">{translate label='Locatie'}</option>
                    {foreach from=$rooms key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.RoomID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
                <table cellspacing="0" cellpadding="4" width="100%">
                    <tr valign="bottom">
                        <td>
                            <a href="./?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x-1" x=$smarty.get.week|default:0}">&laquo;</a> {translate label='saptamana anterioara'}
                        </td>
                        <td>{translate label='saptamana curenta'} <input type="checkbox" {if empty($smarty.get.week)}checked{/if}
                                                                         onclick="window.location.href = './?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}';">
                        </td>
                        <td>{translate label='saptamana urmatoare'} <a
                                    href="./?m=events&o=planif&ConsultantID={$smarty.get.ConsultantID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x+1" x=$smarty.get.week|default:0}">&raquo;</a>
                        </td>
                    </tr>
                </table>
                <table cellspacing="0" cellpadding="4" width="100%" class="planif_events">
                    <tr>
                        <th width="16%" align="center" style="border-left: 1px solid #666666;"><b>{translate label='Ora / ziua'}</b></th>
                        <th width="12%" align="center">L<br>{$days.0|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Ma<br>{$days.1|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Mi<br>{$days.2|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">J<br>{$days.3|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">V<br>{$days.4|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">S<br>{$days.5|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">D<br>{$days.6|date_format:'%d.%m.%y'}</th>
                    </tr>
                    {foreach from=$hours item=hour}
                        <tr>
                            <td align="center" style="border-left: 1px solid #666666;">{$hour}</td>
                            {foreach from=$days key=key item=day}
                                <td>
                                    {foreach from=$events.$day.$hour key=eventid item=inf}
                                        {if isset($events.$day.$hour.$eventid) && (empty($smarty.get.RoomID) || $events.$day.$hour.$eventid.RoomID == $smarty.get.RoomID)}
                                            {assign var="Consultant" value=$events.$day.$hour.$eventid.ConsultantID}
                                            {assign var="Consultant2" value=$events.$day.$hour.$eventid.ConsultantID2}
                                            {assign var="Consultant3" value=$events.$day.$hour.$eventid.ConsultantID3}
                                            {assign var="Room" value=$events.$day.$hour.$eventid.RoomID}
                                            <a href="./?m=events&o=edit&EventID={$events.$day.$hour.$eventid.EventID}"
                                               title="{$events.$day.$hour.$eventid.Scope} in {$rooms[$Room]}"><b>{$consultants.$Consultant}{if !empty($Consultant2)}-{$consultants.$Consultant2}{/if}{if !empty($Consultant3)}-{$consultants.$Consultant3}{/if}</b></a>
                                            <br>
                                            <br>
                                        {else}
                                            &nbsp;
                                        {/if}
                                        {foreachelse}
                                        &nbsp;
                                    {/foreach}
                                </td>
                            {/foreach}
                        </tr>
                    {/foreach}
                </table>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='planificator evenimente'}</span></td>
    </tr>
</table>
