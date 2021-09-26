{if in_array('Year', $lstVisibleFilters)}
    {translate label='Anul'}
    <select name="Year" id="Year">
        <option value="0">{translate label='selecteaza'}</option>
        {foreach from=$years item=item}
            <option value="{$item}" {if $smarty.get.Year==$item} selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" name="Year" id="Year" value="0"/>
{/if}
{if in_array('Trimester', $lstVisibleFilters)}
    {translate label='Trimestrul'}
    <select name="Trimester" id="Trimester">
        <option value="0">{translate label='selecteaza'}</option>
        <option value="0">{translate label='Toate'}</option>
        {foreach from=$trimesters item=item}
            <option value="{$item}" {if $smarty.get.Trimester==$item} selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" name="Trimester" id="Trimester" value="0"/>
{/if}
{if in_array('Month', $lstVisibleFilters)}
    {translate label='Luna'}
    <select name="Month" id="Month">
        <option value="">{translate label='selecteaza'}</option>
        {foreach from=$months item=item}
            <option value="{$item}" {if $smarty.get.Month==$item} selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" name="Month" id="Month" value="0"/>
{/if}
{if in_array('CompanyID', $lstVisibleFilters)}
    <select id="CompanyID" name="CompanyID" class="dropdown">
        <option value="0">{translate label='Companie self'}</option>
        {foreach from=$self key=key item=item}
            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
{else}
    <input type="hidden" name="CompanyID" id="CompanyID" value="0"/>
{/if}
&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&Year=' + document.getElementById('Year').value + '&Trimester=' + document.getElementById('Trimester').value  + '&Month=' + document.getElementById('Month').value + '&CompanyID=' + document.getElementById('CompanyID').value;">
{if !empty($smarty.get.Year)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td align="center"><b>{translate label='Anul'}</b></td>
            <td align="center"><b>{translate label='Trimestrul'}</b></td>
            <td align="center"><b>{translate label='Luna'}</b></td>
            <td align="center"><b>{translate label='Firma'}</b></td>
            <td align="center"><b>{translate label='Angajati veniti'}</b></td>
            <td align="center"><b>{translate label='Angajati plecati'}</b></td>
            <td align="center"><b>{translate label='Angajati curenti'}</b></td>
            <td align="center"><b>{translate label='Procent fluctuatie personal'}</b></td>
        </tr>
        {foreach from=$persons key=key item=item name=iter}
            {if $item.CompanyID > 0}
                <tr>
                    <td>{$smarty.foreach.iter.iteration}</td>
                    <td>{$item.year}</td>
                    <td align="center">{$item.trimester|default:'&nbsp;'}</td>
                    <td align="center">{$item.month|default:'-'}</td>
                    <td align="center">{$item.CompanyName|default:'&nbsp;'}</td>
                    <td align="center">{$item.employed|default:0}</td>
                    <td align="center">{$item.employees_left|default:0}</td>
                    <td align="center">{$item.employees|default:0}</td>
                    <td align="center">{$item.fluctuation|default:0}</td>
                </tr>
            {/if}
            {foreachelse}
            <tr>
                <td colspan="100" align="center">{translate label='Nu exista inregistrari'}</td>
            </tr>
        {/foreach}
    </table>
{/if}