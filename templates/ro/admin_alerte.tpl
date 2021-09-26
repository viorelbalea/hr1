{include file="admin_menu.tpl"}
{if !empty($smarty.get.ID)}
    <table cellspacing="0" cellpadding="4" width="100%">
        <tr valign="top">
            <td>
                <fieldset>
                    <legend>{$alerte[$smarty.get.ID].Name|upper}</legend>
                    <form action="{$smarty.server.REQUEST_URI}" method="post" name="alert">
                        <table cellspacing="0" cellpadding="4">
                            <tr>
                                <td>{translate label='Alerta activa'}:</td>
                                <td><input type="checkbox" name="Active" value="1" {if $alerte[$smarty.get.ID].Active==1}checked{/if}></td>
                            </tr>
                            <tr>
                                <td>{translate label='Subiect'}:</td>
                                <td><input type="text" name="Subject" size="80" maxlength="128" value="{$alerte[$smarty.get.ID].Subject|default:''}"></td>
                            </tr>
                            <tr>
                                <td>{translate label='Mesaj'}:</td>
                                <td><textarea name="Body" cols="79" rows="10">{$alerte[$smarty.get.ID].Body|default:''}</textarea></td>
                            </tr>
                            <tr>
                                <td>{translate label='From e-mail'}:</td>
                                <td><input type="text" name="FromEmail" size="50" maxlength="64" value="{$alerte[$smarty.get.ID].FromEmail|default:''}"></td>
                            </tr>
                            <tr>
                                <td>{translate label='From alias'}:</td>
                                <td><input type="text" name="FromAlias" size="50" maxlength="64" value="{$alerte[$smarty.get.ID].FromAlias|default:''}"></td>
                            </tr>
                            <tr>
                                <td>{translate label='Catre emailuri auxiliare'} <br>{translate label='(separate prin ;)'}:</td>
                                <td><input type="text" name="ToAuxEmails" size="80" maxlength="255" value="{$alerte[$smarty.get.ID].ToAuxEmails|default:''}"></td>
                            </tr>
                            {if $smarty.get.ID != 41 }
                                <tr>
                                    <td>{translate label='Catre angajat'}:</td>
                                    <td><input type="checkbox" name="ToSelf" value="1" {if $alerte[$smarty.get.ID].ToSelf} checked="checked"{/if}></td>
                                </tr>
                            {/if}
                            {if $smarty.get.ID != 41 }
                                <tr>
                                    <td>{translate label='Tip alerta'}:</td>
                                    <td>
                                        <select name="Type">
                                            <option value="daily">{translate label='zilnic'}</option>
                                            <option value="weekly" {if $alerte[$smarty.get.ID].Type=="weekly"}selected{/if}>{translate label='saptamanal'}</option>
                                            <option value="monthly" {if $alerte[$smarty.get.ID].Type=="monthly"}selected{/if}>{translate label='lunar'}</option>
                                            <option value="ondemand" {if $alerte[$smarty.get.ID].Type=="ondemand"}selected{/if}>{translate label='la cerere'}</option>
                                            <option value="3days" {if $alerte[$smarty.get.ID].Type=="3days"}selected{/if}>{translate label='la 3 zile'}</option>
                                        </select>
                                    </td>
                                </tr>
                            {/if}
                            <tr>
                                <td>{translate label='Data trimiterii alertei'}:</td>
                                <td>
                                    <input type="text" name="AlertDate" size="19" maxlength="19"
                                           value="{if $alerte[$smarty.get.ID].AlertDate > '0000-00-00'}{$alerte[$smarty.get.ID].AlertDate|date_format:"%d.%m.%Y %H:%M:00"}{/if}">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                        var cal1 = new CalendarPopup();
                                        cal1.isShowNavigationDropdowns = true;
                                        cal1.setYearSelectStartOffset(10);
                                        //writeSource("js1");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal1.select(document.alert.AlertDate,'anchor1','dd-MM-yyyy 08:00:00'); return false;" NAME="anchor1" ID="anchor1"><img
                                                src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                            {include file="admin_alerte_"|cat:$smarty.get.ID|cat:".tpl"}
                            <tr>
                                <td colspan="2">
                                    <input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;
                                    <input type="button" value="{translate label='Inapoi'}" onclick="window.location.href = './?m=admin&o=alert'">
                                </td>
                            </tr>
                        </table>
                    </form>
                </fieldset>
            </td>
        </tr>
    </table>
{else}
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table cellspacing="0" cellpadding="2" width="100%" class="grid">
            <tr>
                <td class="bkdTitleMenu" width="200"><span class="TitleBox">{translate label='Denumire alerta'}</span></td>
                <td class="bkdTitleMenu" align="center" width="160"><span class="TitleBox">{translate label='Activa (D/N)'}</span></td>
                <td class="bkdTitleMenu" align="center" width="160"><span class="TitleBox">{translate label='Tip alerta'}</span></td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='De la'}</span></td>
                <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Data trimiterii'}</span></td>
                <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Modul'}</span></td>
                <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Dashboard'}</span></td>
            </tr>
            {foreach from=$alerte key=key item=item name=iter}
                <tr>
                    <td class="celulaMenuST"><a href="./?m=admin&o=alert&ID={$item.ID}" class="blue">{$item.Name}</a></td>
                    <td class="celulaMenuST" style="text-align: center;">{if $item.Active==1}D{else}N{/if}</td>
                    <td class="celulaMenuST" style="text-align: center;">
                        {if $item.Type == 'daily'}
                            {translate label='zilnic'}
                        {elseif $item.Type == 'weekly'}
                            {translate label='saptamanal'}
                        {elseif $item.Type == 'monthly'}
                            {translate label='lunar'}
                        {elseif $item.Type == 'ondemand'}
                            {translate label='la cerere'}
                        {else}
                            -
                        {/if}
                    </td>
                    <td class="celulaMenuST">{$item.FromAlias} - {$item.FromEmail}</td>
                    <td class="celulaMenuST" style="text-align: center;">{if $item.AlertDate > '0000-00-00'}{$item.AlertDate|date_format:"%d.%m.%Y %H:%M:00"}{else}-{/if}</td>
                    <td class="celulaMenuST" style="text-align: center;">{$modules_txt[$item.Module]}</td>
                    <td class="celulaMenuSTDR" style="text-align: center;">
                        <input type="checkbox" name="Dashboard[{$item.ID}]" value="1" {if $item.Dashboard==1}checked{/if}>
                        <input type="hidden" name="DashboardH[{$item.ID}]">
                    </td>
                </tr>
            {/foreach}
            <tr>
                <td colspan="6"></td>
                <td style="text-align: center;"><input type="submit" name="save_dashboard" value="Salveaza"></td>
            </tr>
        </table>
    </form>
{/if}