{include file="budget_menu.tpl"}

<div class="filter">
    {if !$updateEndDate}{translate label=''}{else}{translate label='Ultimul raport generat este pentru perioada'}:<br/><b>{$updateStartDate} - {$updateEndDate}</b>{/if}
    <label>{translate label='Companie'}: </label>
    <select id="CompanyID" name="CompanyID" class="dropdown"
            onchange="window.location.href = './?m=budgets&o=consumed&CompanyID=' + document.getElementById('CompanyID').value + '&Currency=' + document.getElementById('Currency').value">
        <option value="0">{translate label='Toate companiile'}</option>
        {foreach from=$self key=key item=item}
            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    <label>{translate label='Moneda'}: </label>
    <select id="Currency" name="Currency" class="dropdown"
            onchange="window.location.href = './?m=budgets&o=consumed&CompanyID=' + document.getElementById('CompanyID').value + '&Currency=' + document.getElementById('Currency').value">
        {foreach from=$currencies item=curr}
            <option value="{$curr}"
                    {if (!empty($smarty.get.Currency) && ($curr == $smarty.get.Currency)) || (empty($smarty.get.Currency) && ($curr == $smarty.session.CURRENCY.CURRENT))}selected="selected"{/if}>{$curr}</option>
        {/foreach}
    </select>
    <label>{translate label='Raport nou'} </label>
    <input type="button" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&new=1'" value="Genereaza">
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod printFile" onclick="window.open('{$smarty.server.REQUEST_URI}&print=1', 'print')" value="Printeaza">&nbsp;
                </li>
                <li><input type="button" class="cod exportFile" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export_doc=1'" value="Export .doc">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="0" width="100%" style="margin-top:6px;">
    <tr>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid_raport" bgcolor='#EBEBEB'>
                {$report_html}
            </table>
        </td>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid_raport" bgcolor='#EBEBEB' style="border-left:solid 1px #000;">
                {$report_html2}
            </table>
        </td>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid_raport" bgcolor='#EBEBEB' style="border-left:solid 1px #000;">
                {$report_html3}
            </table>
        </td>
    </tr>
</table>
<script type='text/javascript'>document.getElementById('loading').style.display = 'none';</script>
