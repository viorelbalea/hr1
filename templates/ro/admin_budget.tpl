{include file="admin_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{translate label='Definire perioade de generare buget consumat'}</span></td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend>{translate label='Perioade bugete consumate'}</legend>
                {foreach from=$periods key=key item=item name=iter}
                    <form action="{$smarty.server.REQUEST_URI}&PeriodID={$key}" method="post" name="b_{$key}">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="50%">
                            <tr>
                                <td style="padding-top: 10px;" width="250">{translate label='An si luna inceput'}:<br/>
                                    <select id="YearStart" name="YearStart">
                                        <option value="0">{translate label='Alege anul'}</option>
                                        {foreach from=$years item=year}
                                            <option value="{$year}" {if $year == $item.YearStart}selected="selected"{/if}>{$year}</option>
                                        {/foreach}
                                    </select>
                                    <select id="MonthStart" name="MonthStart">
                                        <option value="0">{translate label='Alege luna'}</option>
                                        {foreach from=$months key=month item=month}
                                            <option value="{$month}" {if $month == $item.MonthStart}selected="selected"{/if}>{$month}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td style="padding-top: 10px;" width="250">{translate label='An si luna sfarsit'}:<br/>
                                    <select id="YearEnd" name="YearEnd">
                                        <option value="0">{translate label='Alege anul'}</option>
                                        {foreach from=$years item=year}
                                            <option value="{$year}" {if $year == $item.YearEnd}selected="selected"{/if}>{$year}</option>
                                        {/foreach}
                                    </select>
                                    <select id="MonthEnd" name="MonthEnd">
                                        <option value="0">{translate label='Alege luna'}</option>
                                        {foreach from=$months key=month item=month}
                                            <option value="{$month}" {if $month == $item.MonthEnd}selected="selected"{/if}>{$month}</option>
                                        {/foreach}
                                    </select>
                                </td>
                                <td style="padding-top: 10px;" width="250">{translate label='Status'}:<br/>
                                    <input type="checkbox" name="Status" id="Status_{$key}" {if $item.Status==1} checked="checked"{/if} value="1"
                                           onchange="
                                                   if(document.getElementById('Status_{$key}').checked==true) {ldelim} uncheckAll(); this.checked=true; return false;  {rdelim}"
                                    />
                                </td>
                                {if $key > 0}
                                    <td width="20">
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.b_{$key}.YearStart.value > 0 && document.b_{$key}.MonthStart.value > 0 && document.b_{$key}.YearEnd.value > 0 && document.b_{$key}.MonthEnd.value > 0) document.b_{$key}.submit(); else alert('{translate label='Alegeti anul si luna de inceput si sfarsit'}!'); return false;"
                                                                title="{translate label='Modifica'}"><b>Mod</b></a></div>
                                    </td>
                                    <td width="20">
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('{translate label='Sunteti sigura(a)?'}')) window.location.href = '{$smarty.server.REQUEST_URI}&PeriodID={$key}&del=1'; return false;"
                                                                title="{translate label='Sterge'}"><b>Del</b></a></div>
                                    </td>
                                {else}
                                    <td width="20">
                                        <div id="button_add"><a href="#"
                                                                onclick="if (document.b_0.YearStart.value > 0 && document.b_0.MonthStart.value > 0 && document.b_0.YearEnd.value > 0 && document.b_0.MonthEnd.value > 0) document.b_{$key}.submit(); else alert('{translate label='Alegeti anul si luna de inceput si sfarsit'}!'); return false;"
                                                                title="{translate label='Adauga'}"><b>Add</b></a></div>
                                    </td>
                                    <td width="20">&nbsp;</td>
                                {/if}
                            </tr>
                        </table>
                    </form>
                {/foreach}
            </fieldset>
        </td>
    </tr>
</table>

<script type='text/javascript'>
    {literal}
    function uncheckAll(type) {
        {/literal}
        {foreach from=$periods key=key item=item}
        document.getElementById('Status_' + {$key}).checked = false;
        {/foreach}
        {literal}
    }
    {/literal}
</script>
