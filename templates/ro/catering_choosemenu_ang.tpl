{include file="catering_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Alegere meniu angajati'}</span></td>
    </tr>
    <tr valign="top">
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" colspan="2">
            <br>
            <fieldset>
                <legend>{translate label='Alegere meniu angajati'}</legend>
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
                &nbsp;
                <select id="PersonID">
                    <option value="0">{translate label='alege angajat'}</option>
                    {foreach from=$persons key=key2 item=item2}
                        <option value="{$key2}" {if $key2==$smarty.get.PersonID}selected{/if}>{$item2}</option>
                    {/foreach}
                </select>
                &nbsp;
                <input type="button" value="{translate label='Alege'}"
                       onclick="window.location.href = './?m=catering&o=choosemenu_ang&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&PersonID=' + document.getElementById('PersonID').value">
                <br><br>
                {if $smarty.get.msg==1}
                    <b>{translate label='Meniul selectat a fost salvat cu succes! Pofta buna!'}</b>
                    <br>
                    <br>
                {/if}

                {if !empty($StartDate) && !empty($EndDate) && $StartDate <= $EndDate}
                    {if !empty($catering_week)}
                        {if !empty($smarty.get.PersonID)}
                            {if $allowed==0}<br/><b>{translate label='Nu se mai poate reveni asupra acestui meniu'}</b><br/><br/>{/if}
                            <form action="{$smarty.server.REQUEST_URI}" method="post">
                                <table border="0" cellpadding="4" cellspacing="0" class="planif_events">
                                    <tr>
                                        <td colspan="2">&nbsp;</td>
                                        {foreach from=$days key=date item=wday}
                                            <td align="center" width="50" bgcolor="#dedede" style="border-top: 1px solid #666666;"><b>{$wday}<br>{$date|date_format:'%d.%m'}</b>
                                            </td>
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
                                                        <td>{translate label=$item2.Item}</td>
                                                        {foreach from=$days key=date item=wday}
                                                            <td align="center">
                                                                {if !empty($item2.Date.$date)}
                                                                    <input type="text" name="No[{$key}][{$date}][{$key2}]"
                                                                           value="{$item2.$date|default:''}" {if $allowed==0} readonly="readonly" style="background-color:#DDD;"{/if}
                                                                           size="1" maxlength="2">
                                                                {else}
                                                                    &nbsp;
                                                                {/if}
                                                            </td>
                                                        {/foreach}
                                                    </tr>
                                                {/if}
                                            {/foreach}
                                        {/if}
                                    {/foreach}
                                </table>
                                <br>
                                {if $rw == 1 && $allowed==1}<input type="submit" name="save" value="{translate label='Salveaza'}">{/if}
                            </form>
                        {else}
                            {translate label='Trebuie selectat un angajat pentru alegere meniului!'}
                        {/if}
                    {else}
                        {translate label='Nu este meniu setat in aceasta perioada sau perioada de alegere a meniului a expirat!'}
                    {/if}
                {else}
                    {translate label='Trebuie selectat un interval complet si corect!'}
                {/if}
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='alegere meniu angajati'}</span></td>
    </tr>
</table>