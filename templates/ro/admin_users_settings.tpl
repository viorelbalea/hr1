{include file="admin_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Setari speciale pentru'} <u>{$info.UserName}</a></span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Setari speciale'}</legend>
                    <br>
                    <table cellspacing="0" cellpadding="2" style="border: 1px solid #666666; padding: 10px;">
                        <tr>
                            <td style="padding-right: 10px;">
                                <b>{translate label='Company self'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="checkbox" name="UserCompanySelf[{$key}]" value="{$key}" {if in_array($key, $info.UserCompanySelf)}checked{/if}> {$item}</p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Zile concediu retroactive'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="text" name="CompanySettings[{$key}][vacation_days]" value="{$info.CompanySettings.$key.vacation_days|default:''}" size="4"
                                              maxlength="4"></p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Limitare concediu la zilele ramase din an'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="checkbox" name="CompanySettings[{$key}][vacation_limit]" value="1"
                                              {if $info.CompanySettings.$key.vacation_limit == 1}checked{/if}></p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Numarul de zile pentru pontaj'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="text" name="CompanySettings[{$key}][pontaj_days]" value="{$info.CompanySettings.$key.pontaj_days|default:''}" size="4"
                                              maxlength="4"></p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Nivel validare pontaj'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p>
                                        <select name="CompanySettings[{$key}][pontaj_validation_level]">
                                            <option value="0"></option>
                                            <option value="1" {if $info.CompanySettings.$key.pontaj_validation_level==1}selected{/if}>1</option>
                                            <option value="2" {if $info.CompanySettings.$key.pontaj_validation_level==2}selected{/if}>2</option>
                                            <option value="3" {if $info.CompanySettings.$key.pontaj_validation_level==3}selected{/if}>3</option>
                                            <option value="4" {if $info.CompanySettings.$key.pontaj_validation_level==4}selected{/if}>4</option>
                                            <option value="5" {if $info.CompanySettings.$key.pontaj_validation_level==5}selected{/if}>5</option>
                                            <option value="6" {if $info.CompanySettings.$key.pontaj_validation_level==6}selected{/if}>6</option>
                                            <option value="7" {if $info.CompanySettings.$key.pontaj_validation_level==7}selected{/if}>7</option>
                                        </select>
                                    </p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Numar zile planificare pontaj'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="text" name="CompanySettings[{$key}][pontaj_planif_days]" value="{$info.CompanySettings.$key.pontaj_planif_days|default:''}"
                                              size="4" maxlength="4"></p>
                                {/foreach}
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b>{translate label='Numar zile perioada proba'}</b><br>
                                {foreach from=$self key=key item=item}
                                    <p><input type="text" name="CompanySettings[{$key}][probation_days]" value="{$info.CompanySettings.$key.probation_days|default:''}" size="4"
                                              maxlength="4"></p>
                                {/foreach}
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    {if $info.UserType == 'role'}
                        <b>{translate label='Tip role'}:</b>
                        <br>
                        <select name="RoleType" style="margin-top: 4px;">
                            <option value="0">{translate label='alege...'}</option>
                            {foreach from=$role_type key=key item=item}
                                <option value="{$key}" {if $key == $info.RoleType}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                        <br>
                        <br>
                        <br>
                    {/if}
                    <b>{translate label='Roluri pe care le poate aloca'}:</b><br>
                    {foreach from=$users item=user}
                        {if $user.UserType == 'role'}
                            <input type="checkbox" name="RoleAlloc[{$user.UserID}]" value="{$user.UserID}"
                                   {if in_array($user.UserID, $info.RoleAlloc)}checked{/if}>{$user.UserName}&nbsp;&nbsp;&nbsp;
                        {/if}
                    {/foreach}
                    <br><br><br>
                    <input type="submit" value="{translate label='Salveaza'}">&nbsp;&nbsp;<input type="button" value="{translate label='Inapoi'}"
                                                                                                 onclick="window.location.href = './?m=admin&o=users';">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='utilizatori si drepturi'}</span></td>
        </tr>
    </table>
</form>
