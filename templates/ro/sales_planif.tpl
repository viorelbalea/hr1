{include file="sales_menu.tpl"}
<table cellspacing="0" cellpadding="2" width="100%" class="screen">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><b>{translate label='Calendar intalniri'}</b></span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="padding: 10px 5px 10px 5px;">
            <fieldset>
                <legend>{translate label='Evenimente reprezentantanti companie'}</legend>
                <select name="UserID"
                        onchange="window.location.href = './?m=sales&o=planif&RoomID={$smarty.get.RoomID|default:0}&week={$smarty.get.week|default:0}&UserID=' + this.value">
                    <option value="0">{translate label='Reprezentant companie'}</option>
                    {foreach from=$consultants key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.UserID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
                <table cellspacing="0" cellpadding="4" width="100%">
                    <tr valign="bottom">
                        <td>
                            <a href="./?m=sales&o=planif&UserID={$smarty.get.UserID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x-1" x=$smarty.get.week|default:0}">&laquo;</a> {translate label='saptamana anterioara'}
                        </td>
                        <td>{translate label='saptamana curenta'} <input type="checkbox" {if empty($smarty.get.week)}checked{/if}
                                                                         onclick="window.location.href = './?m=sales&o=planif&UserID={$smarty.get.UserID|default:0}&RoomID={$smarty.get.RoomID|default:0}';">
                        </td>
                        <td>{translate label='saptamana urmatoare'} <a
                                    href="./?m=sales&o=planif&UserID={$smarty.get.UserID|default:0}&RoomID={$smarty.get.RoomID|default:0}&week={math equation="x+1" x=$smarty.get.week|default:0}">&raquo;</a>
                        </td>
                    </tr>
                </table>
                <style>
                    {literal}
                    table.calend td {
                        border-left: 1px solid #FFF;
                        border-right: 1px solid #DDD;
                    }

                    tr.rand0 {
                        background: #DDD;
                    }

                    tr.rand1 {
                        background: #EEE;
                    }

                    {/literal}
                </style>
                <table class="calend" cellspacing="0" cellpadding="4" width="100%" class="planif_events">
                    <tr class="rand0">
                        <th width="16%" align="center" style="border-left: 1px solid #666666;"><b>{translate label='Ora / ziua'}</b></th>
                        <th width="12%" align="center">L<br>{$days.0|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Ma<br>{$days.1|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">Mi<br>{$days.2|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">J<br>{$days.3|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">V<br>{$days.4|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">S<br>{$days.5|date_format:'%d.%m.%y'}</th>
                        <th width="12%" align="center">D<br>{$days.6|date_format:'%d.%m.%y'}</th>
                    </tr>
                    {assign var="Rand" value="0"}
                    {foreach from=$hours item=hour}
                        {if ($Rand eq "0")}
                            {assign var="Rand" value="1" }
                        {elseif ($Rand eq "1")}
                            {assign var="Rand" value="0" }
                        {/if}
                        <tr class="rand{$Rand}">
                            <td align="center" style="border-left: 1px solid #666666;">{$hour}</td>
                            {foreach from=$days key=key item=day}
                                <td>
                                    {foreach from=$activities.$day.$hour key=ActivityDetID item=inf}
                                        {if isset($activities.$day.$hour.$ActivityDetID) && (empty($smarty.get.UserID) || $activities.$day.$hour.$ActivityDetID.UserID == $smarty.get.UserID )}
                                            {assign var="User" value=$activities.$day.$hour.$ActivityDetID.UserID}
                                            <a href="./?m=sales&o=edit&ActivityDetID={$activities.$day.$hour.$ActivityDetID.ActivityDetID}"
                                               title="{$activities.$day.$hour.$ActivityDetID.Scope}">
                                                <b>{$activities.$day.$hour.$ActivityDetID.UserName} {$activities.$day.$hour.$ActivityDetID.FullName}
                                                    - {$activities.$day.$hour.$ActivityDetID.ContactName} ({$activities.$day.$hour.$ActivityDetID.CompanyName})</b>
                                            </a>
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

    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='planificator evenimente'}</span></td>
    </tr>
</table>
