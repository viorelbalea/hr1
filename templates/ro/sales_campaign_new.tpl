{include file="sales_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post" name="event" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%" class="screen">
        {if !empty($smarty.get.CampaignID)}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="sales_submenu_3.tpl"}</span></td>
            </tr>
        {else}
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adauga campanie'}</span></td>
            </tr>
        {/if}
        {if $err->getErrors()}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
            </tr>
        {elseif !empty($smarty.post) && $err->getErrors() == ""}
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;">{translate label='Campania a fost salvata!'}</td>
            </tr>
        {/if}
        <tr valinn="top">
            <td class="celulaMenuST{if empty($smarty.get.ActivityID)}DR{/if}" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Detalii campanie'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr height="35">
                            <td>{translate label='Nume'}:*</td>
                            <td><input type="text" name="CampaignName" value="{$info.CampaignName|default:''}" size="50" maxlength="255"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Tip'}:*</td>
                            <td><select id="Type" name="Type" class="cod">
                                    <option value="0">{translate label='Tip'}</option>
                                    {foreach from=$campaignType key=key item=item}
                                        <option value="{$key}" {if $key==$info.Type}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Status'}:*</td>
                            <td><select id="Status" name="Status" class="cod">
                                    <option value="0">{translate label='Status'}</option>
                                    {foreach from=$campaignStatus key=key item=item}
                                        <option value="{$key}" {if $key==$info.Status}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Cost Net'}:</td>
                            <td><input type="text" name="CostNet" value="{$info.CostNet|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Cost Brut'}:</td>
                            <td><input type="text" name="Cost" value="{$info.Cost|default:'0'}" size="3" maxlength="3"></td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data inceput'}:</b></td>
                            <td>
                                <input type="text" name="DateStart" class="formstyle" value="{$info.DateStart|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.event.DateStart,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Data sfarsit'}:</b></td>
                            <td>
                                <input type="text" name="DateEnd" class="formstyle" value="{$info.DateEnd|default:$smarty.now|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.event.DateEnd,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="images/cal.png" border="0"/></A>&nbsp;
                            </td>
                        </tr>
                        <tr height="35">
                            <td>{translate label='Comentarii'}:</td>
                            <td><textarea name="Comment" cols="50" rows="5" wrap="soft">{$info.Comment|default:''}</textarea></td>
                        </tr>
                        <tr height="35">
                            <td>&nbsp;</td>
                            {if !empty($smarty.get.CampaignID)}
                                <td><input type="submit" value="{translate label='Salveaza'}"></td>
                            {else}
                                <td><input type="submit" value="{translate label='Adauga campanie'}"></td>
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