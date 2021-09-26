{include file="catering_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Meniu saptamanal'}</span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" colspan="2">
            <br>
            <fieldset>
                <legend>{translate label='Meniu saptamanal'}</legend>
                {translate label='Saptamana intre'}
                <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$nextMonday}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                    var cal1 = new CalendarPopup();
                    cal1.isShowNavigationDropdowns = true;
                    cal1.setYearSelectStartOffset(10);
                    //writeSource("js1");
                </SCRIPT>
                <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                   title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>
                {translate label='si'}
                <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$nextFriday}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                    var cal2 = new CalendarPopup();
                    cal2.isShowNavigationDropdowns = true;
                    cal2.setYearSelectStartOffset(10);
                    //writeSource("js2");
                </SCRIPT>
                <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                   title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A>
                <input type="button" value="{translate label='Alege'}"
                       onclick="window.location.href = './?m=catering&o=menu_week&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value">
                {if !empty($smarty.get.StartDate)}
                    <br>
                    <br>
                    <form action="{$smarty.server.REQUEST_URI}" method="post">
                        <table border="0" cellpadding="4" cellspacing="0" class="planif_events">
                            <tr>
                                <td colspan="2">&nbsp;</td>
                                {foreach from=$days key=date item=wday}
                                    <td align="center" width="50" bgcolor="#dedede" style="border-top: 1px solid #666666;"><b>{$wday}<br>{$date|date_format:'%d.%m'}</b></td>
                                {/foreach}
                            </tr>
                            {foreach from=$catering_week key=key item=item}
                                {if $key > 0}
                                    <tr>
                                        <td colspan="{math equation="x+2" x=$days|@count}" bgcolor="#dedede" style="border-left: 1px solid #666666;">
                                            <b>{translate label=$item.0.Category}</b></td>
                                    </tr>
                                    {foreach from=$item key=key2 item=item2}
                                        {if $key2 > 0}
                                            <tr>
                                                <td width="70" nowrap="nowrap"
                                                    style="border-left: 1px solid #666666;">{if !empty($item2.Calories)}{$item2.Calories} {translate label='calorii'}{else}&nbsp;{/if}</td>
                                                <td>{translate label=$item2.Item} {if !empty($item2.Calories)}({$item2.Calories} {translate label='calorii'}) {/if}</td>
                                                {foreach from=$days key=date item=wday}
                                                    <td align="center"><input type="checkbox" name="Status[{$key}][{$key2}][{$date}]" value="1"
                                                                              {if !empty($item2.$date)}checked{/if}></td>
                                                {/foreach}
                                            </tr>
                                        {/if}
                                    {/foreach}
                                {/if}
                            {/foreach}
                        </table>
                        <br>
                        {if $rw == 1}<input type="submit" name="save" value="{translate label='Salveaza'}">{/if}
                    </form>
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='meniu saptamanal'}</span></td>
    </tr>
</table>
