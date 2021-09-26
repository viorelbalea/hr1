{include file="performance_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="perf" onsubmit="return validForm(document.perf);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox">{translate label='Plan actiuni'}</span>
                <select name="Year" onchange="window.location.href = './?m=performance&o=plan&PersonID={$smarty.session.PersonID}&Year=' + this.value;">
                    {foreach from=$years item=item}
                        <option value="{$item}" {if $item == $Year}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td valign="top" class="bkdTitleMenu" align="right"><span class="TitleBox">{$FullName}</span></td>
        </tr>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="padding: 10px;">
                <fieldset>
                    {assign var="request_uri" value="./?m=performance&o=plan&PersonID="|cat:$smarty.session.PersonID|cat:'&Year='|cat:$smarty.get.Year}
                    <table width="100%" cellspacing="0" cellpadding="4">
                        <tr>
                            {if empty($smarty.get.action)}
                                <td width="40">{orderby label='Ordine' request_uri=$request_uri order_by=Pos}</td>{/if}
                            <td>{if empty($smarty.get.action)}{orderby label='Dimeniunea HCM' request_uri=$request_uri order_by=DimensionID}{else}
                                    <b>{translate label='Dimeniunea HCM'}</b>{/if}</td>
                            <td>{if empty($smarty.get.action)}{orderby label='Actiune' request_uri=$request_uri order_by=Goal}{else}<b>{translate label='Actiune'}</b>{/if}</td>
                            <td>{if empty($smarty.get.action)}{orderby label='Termen' request_uri=$request_uri order_by=Deadline}{else}<b>{translate label='Termen'}</b>{/if}</td>
                            <td>{if empty($smarty.get.action)}{orderby label='Status' request_uri=$request_uri order_by=StatusID}{else}<b>{translate label='Status'}</b>{/if}</td>
                            <td width="180"><b>{translate label='Comentariu'}</b></td>
                            {if empty($smarty.get.action) || ($smarty.get.action == 'history' && $smarty.session.USER_ID == 1)}
                                <td colspan="2">&nbsp;</td>
                            {/if}
                        </tr>

                        {if !empty($smarty.get.action) && $smarty.get.action == 'new'}
                            <tr valign="top">
                                <td>
                                    <select name="Year">
                                        {foreach from=$years item=item}
                                            <option value="{$item}" {if $item == $Year}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                    <br><br>
                                    <select name="DimensionID" class="cod">
                                        <option value="0">{translate label='alege...'}</option>
                                        {foreach from=$dimensions key=key item=item}
                                            {if $item.Status == 1}
                                                <option value="{$key}">{$item.Dimension}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </td>
                                <td><textarea name="Goal" wrap="soft" cols="30" rows="10"></textarea></td>
                                <td>
                                    <input type="text" name="Deadline" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                        var cal1 = new CalendarPopup();
                                        cal1.isShowNavigationDropdowns = true;
                                        cal1.setYearSelectStartOffset(10);
                                        //writeSource("js1");
                                    </SCRIPT>
                                    <br>
                                    <A HREF="#" onClick="cal1.select(document.perf.Deadline,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1"
                                       ID="anchor1">{translate label='selecteaza data'}</A>
                                </td>
                                <td>
                                    <select name="StatusID">
                                        {foreach from=$status key=key item=item}
                                            <option value="{$key}">{$item}</option>
                                        {/foreach}
                                    </select>
                                    {*
                                    <br>
                                    <input type="text" name="StatusDate" value="{$smarty.now|date_format:'%d.%m.%Y'}" class="formstyle" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                                var cal2 = new CalendarPopup();
                                                cal2.isShowNavigationDropdowns = true;
                                                cal2.setYearSelectStartOffset(10);
                                                //writeSource("js2");
                                            </SCRIPT>
                                            <br>
                                            <A HREF="#" onClick="cal2.select(document.perf.StatusDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2">{translate label='selecteaza data'}</A>
                                            *}
                                </td>
                                <td width="180" colspan="2"><textarea name="Comment" wrap="soft" cols="20" rows="10"></textarea></td>
                            </tr>
                            <tr>
                                <td colspan="7"><input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}"
                                                                                                                             onclick="history.back();"></td>
                            </tr>
                        {elseif !empty($smarty.get.action) && $smarty.get.action == 'edit'}
                            <tr valign="top">
                                <td>
                                    <select name="Year">
                                        {foreach from=$years item=item}
                                            <option value="{$item}" {if $item == $plan.Year}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                    <br><br>
                                    <select name="DimensionID" class="cod">
                                        {foreach from=$dimensions key=key item=item}
                                            {if $item.Status == 1 || ($item.Status == 0 && $key==$plan.DimensionID)}
                                                <option value="{$key}" {if $key==$plan.DimensionID}selected{/if}>{$item.Dimension}</option>
                                            {/if}
                                        {/foreach}
                                    </select>
                                </td>
                                <td><textarea name="Goal" wrap="soft" cols="30" rows="10"
                                              {if $plan.edit == 0}disabled{/if} {if $smarty.session.USER_ID != 1 && $smarty.session.USER_RIGHTS2.9.1 <= 2}disabled{/if}>{$plan.Goal}</textarea>
                                </td>
                                <td>
                                    <input type="text" name="Deadline" value="{$plan.Deadline}" class="formstyle" size="10" maxlength="10">
                                    {if $smarty.session.USER_ID != 1 && $smarty.session.USER_RIGHTS2.9.1 == 1}
                                    {else}
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                            var cal1 = new CalendarPopup();
                                            cal1.isShowNavigationDropdowns = true;
                                            cal1.setYearSelectStartOffset(10);
                                            //writeSource("js1");
                                        </SCRIPT>
                                        <br>
                                        <A HREF="#" onClick="cal1.select(document.perf.Deadline,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1"
                                           ID="anchor1">{translate label='selecteaza data'}</A>
                                    {/if}
                                </td>
                                <td>
                                    <select name="StatusID">
                                        {foreach from=$status key=key item=item}
                                            <option value="{$key}" {if $key==$plan.StatusID}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                    {*
                                    <br>
                                    <input type="text" name="StatusDate" value="{$plan.StatusDate}" class="formstyle" size="10" maxlength="10" {if $smarty.session.USER_ID != 1 && $smarty.session.USER_RIGHTS2.9.1 <= 2}disabled{/if}>
                                    {if $smarty.session.USER_ID != 1 && $smarty.session.USER_RIGHTS2.9.1 <= 2}
                                    {else}
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                                var cal2 = new CalendarPopup();
                                                cal2.isShowNavigationDropdowns = true;
                                                cal2.setYearSelectStartOffset(10);
                                                //writeSource("js2");
                                            </SCRIPT>
                                            <br>
                                            <A HREF="#" onClick="cal2.select(document.perf.StatusDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2">{translate label='selecteaza data'}</A>
                                            {/if}
                                            *}
                                </td>
                                <td width="180" colspan="2"><textarea name="Comment" wrap="soft" cols="20" rows="10">{$plan.Comment}</textarea></td>
                            </tr>
                            <tr>
                                <td colspan="7">{if $plan.edit >= 1}<input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;{/if}<input type="button"
                                                                                                                                                      value="{translate label='Inapoi'}"
                                                                                                                                                      onclick="history.back();">
                                </td>
                            </tr>
                        {elseif !empty($smarty.get.action) && $smarty.get.action == 'history'}

                            {foreach from=$plan item=item}
                                <tr>
                                    <td width="220">{$dimensions[$item.DimensionID].Dimension}</td>
                                    <td width="300">{$item.Goal}</td>
                                    <td width="80">{$item.Deadline}</td>
                                    <td width="80">{$status[$item.StatusID]}<br>{$item.StatusDate}</td>
                                    <td width="180">
                                        {if ($smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS2.9.1 == 3) && !empty($smarty.get.DetailID) && $item.DetailID == $smarty.get.DetailID}
                                        <textarea name="Comment" wrap="soft" cols="21" rows="10">{$item.Comment}</textarea>
                                        <br>
                                        <input type="submit" value="{translate label='Salveaza'}">
                                        {else}
                                        {$item.Comment}
                                        {if $smarty.session.USER_RIGHTS2.9.1 == 3 || $smarty.session.USER_ID == 1}
                                        <br>
                                        <div id="button_mod" style="padding: 4px 0 0 30px;"><a href="#"
                                                                                               onclick="window.location.href = './?m=performance&o=plan&action=history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&DetailID={$item.DetailID}&Year={$Year}'"
                                                                                               title="Modifica"><b>Mod</a></a></div>
                                    </td>
                                    {/if}
                                    {/if}
                                    </td>
                                    {if $smarty.session.USER_RIGHTS2.9.1 == 3 || $smarty.session.USER_ID == 1}
                                        <td width="20" colspan="2">
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceasta inregistrare din istoric?'}')) window.location.href = './?m=performance&o=plan&action=delete_history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&DetailID={$item.DetailID}&Year={$Year}'; return false;"
                                                                    title="Sterge"><b>Del</b></a></div>
                                        </td>
                                    {/if}
                                </tr>
                                <tr>
                                    <td colspan="7" style="border-top: 1px solid #cccccc;">&nbsp;</td>
                                </tr>
                            {/foreach}
                            <tr>
                                <td colspan="7">
                                    <input type="button" value="{translate label='Inapoi'}"
                                           onclick="window.location.href = './?m=performance&o=plan&PersonID={$smarty.session.PersonID}&PerfID={$smarty.get.PerfID}&Year={$smarty.get.Year}';">&nbsp;&nbsp;
                                    <input type="button" value="Printeaza" onclick="window.open('{$smarty.server.REQUEST_URI}&print_history=1', 'print');">
                                </td>
                            </tr>
                        {else}

                            {foreach from=$plans key=key item=item}
                                {if empty($smarty.get.PerfID) || $item.PerfID == $smarty.get.PerfID}
                                    <tr valign="top">
                                        <td><input type="text" name="Pos[{$item.PerfID}]" value="{$item.Pos|default:0}" size="2" maxlength="3"></td>
                                        <td width="220">{$dimensions[$item.DimensionID].Dimension}</td>
                                        <td width="300">{$item.Goal}</td>
                                        <td width="60">{if $item.Deadline != '00-00-0000'}{$item.Deadline}{else}&nbsp;{/if}</td>
                                        <td width="60">{$status[$item.StatusID]}<br><br>{$item.StatusDate}<br>
                                            <div id="button_history" style="padding: 4px 0 0 20px;"><a href="#"
                                                                                                       onclick="window.location.href = './?m=performance&o=plan&action=history&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'"
                                                                                                       title="Istoric actiune"><b>His</b></a></div>
                                        </td>
                                        <td width="180">{$item.Comment}</td>
                                        <td width="10" align="right">
                                            {if $item.edit >= 1}
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=performance&o=plan&action=edit&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'"
                                                                        title="Modifica actiune"><b>Mod</b></a></div>
                                            {else}
                                                &nbsp;
                                            {/if}
                                        </td>
                                        <td width="10" align="right">
                                            {if $item.edit >= 1}
                                                {if $smarty.session.USER_RIGHTS2.9.1 == 3 || $smarty.session.USER_ID == 1}
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti acest obiectiv?'}')) window.location.href = './?m=performance&o=plan&action=delete&PersonID={$smarty.session.PersonID}&PerfID={$item.PerfID}&Year={$Year}'; return false;"
                                                                            title="Sterge actiune"><b>Del</b></a></div>
                                                {/if}
                                            {else}
                                                &nbsp;
                                            {/if}
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="8" style="border-top: 1px solid #cccccc;">&nbsp;</td>
                                    </tr>
                                {/if}
                            {/foreach}
                            <tr>
                                <td colspan="8">
                                    <input type="submit" value="{translate label='Salveaza ordine'}">&nbsp;&nbsp;
                                    <input type="button" value="Actiune noua"
                                           onclick="window.location.href = './?m=performance&o=plan&action=new&PersonID={$smarty.session.PersonID}&Year={$Year}';">&nbsp;&nbsp;
                                    <input type="button" value="Printeaza"
                                           onclick="window.open('./?m=performance&o=plan&PersonID={$smarty.session.PersonID}&Year={$Year}&print=1', 'print');">&nbsp;&nbsp;
                                    <input type="button" value="Export"
                                           onclick="window.location.href = './?m=performance&o=plan&PersonID={$smarty.session.PersonID}&Year={$Year}&export=1';">&nbsp;&nbsp;
                                    <input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=performance&o=divizii';">
                                </td>
                            </tr>
                        {/if}

                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="4" valign="top" class="bkdTitleMenu">&nbsp;</td>
        </tr>
    </table>
</form>

{literal}
    <script language="javascript">
        function validForm(f) {
            if (is_empty(f.Goal.value)) {
                alert('{translate label='
                Nu
                ati
                completat
                actiunea
                !'}'
            )
                ;
                return false;
            }
            return true;
        }
    </script>
{/literal}