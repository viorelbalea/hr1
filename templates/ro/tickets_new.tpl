{include file="tickets_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if !empty($smarty.get.TicketID)}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="tickets_submenu.tpl"}</span></td>
        </tr>
    {else}
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Adaugare cerere'}</span></td>
        </tr>
    {/if}
    {if $smarty.get.msg==1 || (!empty($smarty.post) && $err->getErrors() == "")}
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;">{translate label='Datele au fost salvate!'}</td>
        </tr>
    {/if}
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="100%">
            <br>
            {foreach from=$types item=item0 key=key0}
                <fieldset>
                    <legend>{translate label='Cerere'} {$item0}</legend>
                    <form action="{$smarty.server.REQUEST_URI}" method="post" name="ticket_{$key0}" onsubmit="return validateForm(this);">
                        <input type="hidden" name="Type" value="{$key0}"/>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="80%">
                            <tr>
                                <td><b>{translate label='Comentarii'}:</b></td>
                                <td><b>{translate label='Status'}:*</b></td>
                                <td><b>{translate label='Data limita'}*:</b></td>
                                <td width="250">
                                    {if $key0==1}
                                        <b>{$item0}:*</b>
                                    {elseif $key0==2}
                                        <b>{$item0}:*</b>
                                    {elseif $key0==3}
                                        &nbsp;
                                    {/if}
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td>
                                    <textarea name="Comments" style="width:250px;">{$info.Comments}</textarea>
                                </td>
                                <td>
                                    <select name="Status">
                                        {foreach from=$status key=key item=item}
                                            <option value="{$key}" {if $key == $info.Status}selected{/if}>{$item}</option>
                                        {/foreach}
                                    </select>
                                </td>

                                <td>
                                    <input type="text" name="LimitDate" id="LimitDate_{$key0}" class="formstyle"
                                           value="{if !empty($info.LimitDate) && $info.LimitDate != '0000-00-00'}{$info.LimitDate|date_format:"%d.%m.%Y"}{/if}" size="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js{$key0}">
                                        var cal{$key0} = new CalendarPopup();
                                        cal{$key0}.isShowNavigationDropdowns = true;
                                        cal{$key0}.setYearSelectStartOffset(10);
                                        //writeSource("js{$key0}");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal{$key0}.select(document.ticket_{$key0}.LimitDate,'anchor{$key0}','dd.MM.yyyy'); return false;" NAME="anchor{$key0}"
                                       ID="anchor{$key0}"><img src="./images/cal.png" border="0"/></A>
                                </td>
                                <td>
                                    {if $key0==1}
                                        <select name="ReportID" style="width:250px;">
                                            <option value="0">{translate label='Selectati'}</option>
                                            {foreach from=$reports.$key0 key=key item=item}
                                                <option value="{$key}" {if $key == $info.ReportID}selected{/if}>{$item.Report}</option>
                                            {/foreach}
                                        </select>
                                    {elseif $key0==2}
                                        <select name="ReportID" style="width:250px;">
                                            <option value="0">{translate label='Selectati'}</option>
                                            {foreach from=$services key=key item=item}
                                                <option value="{$key}" {if $key == $info.ReportID}selected{/if}>{$item}</option>
                                            {/foreach}
                                        </select>
                                    {elseif $key0==3}
                                        &nbsp;
                                        <input type="hidden" name="ReportID" value="0"/>
                                    {/if}
                                </td>


                                <td>
                                    {if !empty($smarty.get.TicketID)}
                                        {if $smarty.session.USER_ID==1 || (($smarty.session.USER_ID!=1) && ($info.Status!=1 && $info.Status!=4))}
                                            {if $info.rw == 1 || !empty($smarty.post)}<input type="submit" value="{translate label='Salveaza'}" class="formstyle">{/if}
                                        {/if}
                                    {else}
                                        <input type="submit" value="{translate label='Adauga cerere'}" class="formstyle">
                                    {/if}

                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
                <br>
            {/foreach}
            <br>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
</form>

{literal}
<script type="text/javascript">
    function validateForm(f) {
        if (!is_empty(f.LimitDate.value) && !checkDate(f.LimitDate.value, '{/literal}{translate label='Data limita'}{literal}')) {
            return false;
        }
        return true;
    }
</script>
{/literal}
