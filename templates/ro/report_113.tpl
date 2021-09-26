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
    <input type="hidden" id="Year" value="0"/>
{/if}
{if in_array('Trimester', $lstVisibleFilters)}
    {translate label='Trimestrul'}
    <select name="Trimester" id="Trimester">
        <option value="0">{translate label='selecteaza'}</option>
        {foreach from=$trimesters item=item}
            <option value="{$item}" {if $smarty.get.Trimester==$item} selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" id="Trimester" value="0"/>
{/if}
{if in_array('Month', $lstVisibleFilters)}
    {translate label='Luna'}
    <select name="Month" id="Month">
        <option value="0">{translate label='selecteaza'}</option>
        {foreach from=$months item=item}
            <option value="{$item}" {if $smarty.get.Month==$item} selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" id="Month" value="0"/>
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
    <input type="hidden" id="CompanyID" value="0"/>
{/if}
&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&rep={$smarty.get.rep}&Year=' + document.getElementById('Year').value + '&Trimester=' + document.getElementById('Trimester').value + '&Month=' + document.getElementById('Month').value + '&CompanyID=' + document.getElementById('CompanyID').value;">
{if !empty($smarty.get.Year)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <!-- Fields -->
        <tr>
            <td><b>#</b></td>
            {foreach from=$fields item=field key=kfield name=nfield }
                {if !empty($field.sort)}
                    {if $field.sort === 'asc'}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                    {elseif $field.sort === 'desc'}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                    {else}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                    {/if}
                {else}
                    <td align="center"><b>{translate label=$field.label}</b></td>
                {/if}
            {/foreach}
        </tr>

        <!-- Values -->
        {foreach from=$fields_data item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                {foreach from=$fields item=field}
                    {assign var=field_name value=$field.name}
                    <td{if $field.align} align="{$field.align}"{/if}>{$item.$field_name|default:'&nbsp'}</td>
                {/foreach}
            </tr>
            {foreachelse}
            <tr height="30">
                <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}