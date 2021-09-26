{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Utilizatori aplicatie '}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Utilizatori '}</legend>
                    <br>
                    <table border="1" cellpadding="6" cellspacing="0" class="screen">
                        <tr>
                            <td><b>{translate label='Utilizator '}</b></td>
                            <td><b>{translate label='Activ '}</b></td>
                            <td align="center"><b>{translate label='Tip '}</b></td>
                            {foreach from=$app_modules key=key item=item}
                                <td><b>{$item}</b></td>
                            {/foreach}
                        </tr>
                        {foreach from=$users item=user}
                            <tr>
                                <td>
                                    {$user.UserName}
                                    <br><img width="1" height="5"><br>
                                    <table cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (username = prompt('UTILIZATOR:', '{$user.UserName}')) window.location.href = './?m=admin&o=users&action=edit&id={$user.UserID}&username=' + escape(username); return false;"
                                                                        title="{translate label='Modifica username'}"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (password = prompt('PAROLA:')) window.location.href = './?m=admin&o=users&action=pass&id={$user.UserID}&password=' + escape(password); return false;"
                                                                        title="{translate label='Seteaza parola'}"><b>Mod</b></a></div>
                                            </td>
                                            <td style="padding-left: 5px;">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('{translate label='Esti sigur(a)?'}')) window.location.href = './?m=admin&o=users&action=del&id={$user.UserID}'; return false;"
                                                                        title="{translate label='Sterge'}"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td><input type="checkbox" name="active[{$user.UserID}]" value="1" {if $user.UserActive == 1}checked{/if}></td>
                                <td align="center">
                                    <select name="type[{$user.UserID}]">
                                        <option value="user">{translate label='user'}</option>
                                        <option value="role" {if $user.UserType == 'role'}selected{/if}>{translate label='role'}</option>
                                    </select>
                                    <div id="button_mod"><a href="#" onclick="window.location.href = './?m=admin&o=users&action=settings&id={$user.UserID}'; return false;"
                                                            title="Seteaza speciale"><b>{translate label='Mod'}</b></a></div>
                                </td>
                                {foreach from=$app_modules key=key item=item}
                                    <td align="center">
                                        <input type="checkbox" name="right[{$user.UserID}][{$key}]" value="{$key}" {if in_array($key, $user.UserRights)}checked{/if}>
                                        {if in_array($key, $user.UserRights)}
                                            <div id="button_mod">
                                                {if $key==7}
                                                    <a href="#" onclick="window.location.href = './?m=admin&o=reports'; return false;"
                                                       title="Seteaza"><b>{translate label='Mod'}</b></a>
                                                {else}
                                                    <a href="#" onclick="window.location.href = './?m=admin&o=users&action=rights&id={$user.UserID}&module={$key}'; return false;"
                                                       title="Seteaza"><b>{translate label='Mod'}</b></a>
                                                {/if}
                                            </div>
                                        {/if}
                                    </td>
                                {/foreach}
                            </tr>
                        {/foreach}
                    </table>
                </fieldset>
                <br>
                <input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button" value="Adauga user"
                                                                                             onclick="if (username = prompt('USERNAME:')) window.location.href = './?m=admin&o=users&action=new&username=' + escape(username);">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='utilizatori si drepturi'}</span></td>
        </tr>
    </table>
</form>
