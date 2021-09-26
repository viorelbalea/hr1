{include file="dictionary_menu.tpl"}
<form action="{$smarty.server.REQUEST_URI}" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Grila vechime in munca'}</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <select name="company_id" onchange="if (this.value > 0) window.location.href = './?m=dictionary&o=grila&company_id=' + this.value;">
                        <option value="0">{translate label="Compania"}</option>
                        {foreach from=$self key=key item=item}
                            {if $smarty.session.USER_ID == 1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                <option value="{$key}" {if $smarty.get.company_id == $key}selected{/if}>{$item}</option>
                            {/if}
                        {/foreach}
                    </select>
                    {if !empty($smarty.get.company_id)}
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="4" cellspacing="0">
                                        <tr>
                                            <td>{translate label='Maxim ani vechime'}</td>
                                            <td>{translate label='Zile concediu'}</td>
                                            <td>{translate label='Maxim zile reportate'}</td>

                                            <td colspan="2">{translate label='Data limita zile reportate in an curent'}</td>

                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        {foreach from=$grila key=key item=item}
                                            <tr>
                                                <td><input type="text" id="max_seniority_{$key}" name="max_seniority_{$key}" value="{$item.max_seniority}" size="14" maxlength="10">
                                                </td>
                                                <td><input type="text" id="days_{$key}" name="days_{$key}" value="{$item.days}" size="8" maxlength="10"></td>
                                                <td><input type="text" id="max_rep_days_{$key}" name="max_rep_days_{$key}" value="{$item.max_rep_days}" size="15" maxlength="10">
                                                </td>

                                                <td>Ziua: <input type="text" name="rep_day_limit_{$key}" id="rep_day_limit_{$key}" class="formstyle" value="{$item.rep_day_limit}"
                                                                 size="2" maxlength="2"/></td>

                                                <td>Luna: <select name="rep_month_limit_{$key}" id="rep_month_limit_{$key}">
                                                        {foreach from=$months item=month}
                                                            <option value="{$month}" {if $item.rep_month_limit == $month} selected="selected"{/if}>{$month}</option>
                                                        {/foreach}
                                                    </select>

                                                    {if $rw == 1}

                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=grila&ID={$key}&company_id={$smarty.get.company_id}&max_seniority=' + escape(document.getElementById('max_seniority_{$key}').value) + '&days=' + escape(document.getElementById('days_{$key}').value) + '&max_rep_days=' + escape(document.getElementById('max_rep_days_{$key}').value) + '&rep_day_limit=' + escape(document.getElementById('rep_day_limit_{$key}').value) + '&rep_month_limit=' + escape(document.getElementById('rep_month_limit_{$key}').value); return false;"
                                                                            title="{translate label='Modifica grila'}"><b>Mod</b></a></div>
                                                </td>

                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = './?m=dictionary&o=grila&ID={$key}&company_id={$smarty.get.company_id}&delGrila=1'; return false;"
                                                                            title="{translate label='Sterge grila'}"><b>Del</b></a></div>
                                                </td>
                                                {/if}
                                            </tr>
                                        {/foreach}
                                        {if $rw == 1}
                                            <tr>
                                                <td><input type="text" id="max_seniority_0" name="max_seniority_0" size="14" maxlength="10"></td>
                                                <td><input type="text" id="days_0" name="days_0" size="8" maxlength="10"></td>
                                                <td colspan="3">
                                                    <div id="button_add"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=grila&ID=0&company_id={$smarty.get.company_id}&max_seniority=' + escape(document.getElementById('max_seniority_0').value) + '&days=' + escape(document.getElementById('days_0').value); return false;"
                                                                            title="{translate label='Adauga grila'}"><b>Add</b></a></div>
                                                </td>
                                            </tr>
                                        {/if}
                                    </table>
                                </td>
                            </tr>
                        </table>
                    {/if}
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='grila vechime in munca'}</span></td>
        </tr>
    </table>
</form>
