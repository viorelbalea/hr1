{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$projects.0.FullName}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>{translate label='Pontaj pe proiecte'}</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td>{translate label='Proiect'}*</td>
                        <td>{translate label='An'}*</td>
                        <td>{translate label='Luna'}*</td>
                        <td>{translate label='Numar ore'}*</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    {foreach from=$projects key=key item=item}
                        {if $key > 0}
                            <tr>
                                <form action="{$smarty.server.REQUEST_URI}&action=edit&ID={$key}" method="post" name="pers_{$key}">
                                    <td>
                                        <select name="ProjectID">
                                            <option value="">{translate label='alege...'}</option>
                                            {foreach from=$projects_list key=key2 item=item2}
                                                {if $key2 > 0}
                                                    <option value="{$item2.ProjectID}" {if $item2.ProjectID==$item.ProjectID} selected="selected"{/if}>{$item2.Name}</option>
                                                {/if}
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Year" id="Year">
                                            {foreach from=$years item=item2}
                                                <option value="{$item2}" {if $item.Year==$item2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Month" id="Month">
                                            {foreach from=$months item=item2}
                                                <option value="{$item2}" {if $item.Month==$item2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Hours" id="Hours">
                                            {foreach from=$hours item=item2}
                                                <option value="{$item2}" {if $item.Hours==$item2}selected{/if}>{$item2}</option>
                                            {/foreach}
                                        </select>
                                    </td>
                                    {if $projects.0.rw==1}
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.pers_{$key}.ProjectID.value) && !is_empty(document.pers_{$key}.Year.value) && !is_empty(document.pers_{$key}.Month.value) && !is_empty(document.pers_{$key}.Hours.value)) document.pers_{$key}.submit(); else alert('{translate label='Selectati Proiect, An, Luna, Numar ore ! '}'); return false;"
                                                                    title="{translate label='Modifica inregistrare'}"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="{$smarty.server.REQUEST_URI}&action=del&ID={$key}"
                                                                    onclick="return confirm('{translate label='Sunteti sigur(a)?'}');"
                                                                    title="{translate label='Sterge inregistrare'}"><b>Del</b></a></div>
                                        </td>
                                    {else}
                                        <td colspan="2">&nbsp;</td>
                                    {/if}
                                </form>
                            </tr>
                        {/if}
                    {/foreach}
                    <tr>
                        <form action="{$smarty.server.REQUEST_URI}&action=new" method="post" name="pers_0">
                            <td>
                                <select name="ProjectID">
                                    <option value="">{translate label='alege...'}</option>
                                    {foreach from=$projects_list key=key2 item=item2}
                                        {if $key2 > 0}
                                            <option value="{$item2.ProjectID}">{$item2.Name}</option>
                                        {/if}
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <select name="Year" id="Year">
                                    {foreach from=$years item=item}
                                        <option value="{$item}" {if $item==$curr_year}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <select name="Month" id="Month">
                                    {foreach from=$months item=item}
                                        <option value="{$item}" {if $item==$curr_month}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td>
                                <select name="Hours" id="Hours">
                                    {foreach from=$hours item=item}
                                        <option value="{$item}" {if $item==$curr_norm}selected{/if}>{$item}</option>
                                    {/foreach}
                                </select>
                            </td>
                            <td align="center">{if $projects.0.rw==1}
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.pers_0.ProjectID.value) && !is_empty(document.pers_0.Year.value) && !is_empty(document.pers_0.Month.value) && !is_empty(document.pers_0.Hours.value)) document.pers_0.submit(); else alert('Selectati Proiect, An, Luna, Numar ore !'); return false;"
                                                            title="{translate label='Adauga inregistrare'}"><b>Add</b></a></div>{/if}</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                </table>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="{translate label='Inapoi'}" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='campurile marcate cu * sunt obligatorii'}</span></td>
    </tr>
</table>
</form>

