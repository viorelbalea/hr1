{include file="sales_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="event_2">
    <table>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Genereaza raport'}</span></td>
        </tr>
        <tr height="35">
            <td>{translate label='Data raportare'}:</b></td>
            <td>
                <input type="text" name="Date" class="formstyle" value="{$info.Date|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                    var cal2 = new CalendarPopup();
                    cal2.isShowNavigationDropdowns = true;
                    cal2.setYearSelectStartOffset(10);
                    //writeSource("js2");
                </SCRIPT>
                <A HREF="#" onClick="cal2.select(document.event_2.Date,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                align="absbottom" border="0"/></A>&nbsp;
            </td>
        </tr>

        <tr height="35">
            <td>&nbsp;</td>
            <td><input type="submit" value="{translate label='Genereaza activitate'}"></td>
        </tr>
    </table>
</form>
<br/>
<form action="{$smarty.server.REQUEST_URI}" method="post" name="event_1" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        {if !empty($smarty.get.DailyID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="sales_submenu_5.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adauga raport'}</span></td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {elseif !empty($smarty.post)}
            {*
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Raportul a fost salvat!'}</td>
            </tr>
            *}
        {/if}
        <tr valinn="top">
            <td class="celulaMenuST{if empty($smarty.get.ActivityID)}DR{/if}" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii raport'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr height="35">
                            <td>{translate label='Apeluri noi'}:</td>
                            <td><input type="text" name="CallsNew" value="{$info.CallsNew|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Apeluri revenire'}:</td>
                            <td><input type="text" name="CallsBack" value="{$info.CallsBack|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Intalniri noi'}:</td>
                            <td><input type="text" name="MeetingsNew" value="{$info.MeetingsNew|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Intalniri revenire'}:</td>
                            <td><input type="text" name="MeetingsBack" value="{$info.MeetingsBack|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Intalniri efectuate'}:</td>
                            <td><input type="text" name="MeetingsDone" value="{$info.MeetingsDone|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Recomandari'}:</td>
                            <td><input type="text" name="Reccos" value="{$info.Reccos|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data raportare'}:</b></td>
                            <td>
                                <input type="text" name="Date" class="formstyle" value="{$info.Date|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.event_1.Date,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                                border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Comentarii'}:</td>
                            <td><textarea name="Comment" cols="50" rows="5" wrap="soft">{$info.Comment|default:''}</textarea></td>
                        </tr>
                        <tr height="35">
                            <td>&nbsp;</td>
                            {if !empty($smarty.get.DailyID)}
                                <td><input type="submit" value="{translate label='Salveaza'}"></td>
                            {else}
                                <td><input type="submit" value="{translate label='Adauga activitate'}"></td>
                            {/if}
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
        </tr>
    </table>
</form>