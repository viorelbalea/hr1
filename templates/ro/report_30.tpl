<div class="filter">
    <label>{translate label='An'}:</label>
    <select name="Year" id="Year"
            onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID={$smarty.get.CompanyID}&Status={$smarty.get.Status}&Year=' + this.value;">
        <option value="0">{translate label='alege...'}</option>
        {foreach from=$years key=key item=item}
            <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='Companie'}:</label>
    <select id="CompanyID" class="dropdown"
            onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&Year={$smarty.get.Year}&Status={$smarty.get.Status}&CompanyID=' + this.value;">
        <option value="0">{translate label='Toate companiile'}</option>
        {foreach from=$self key=key item=item}
            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    <select id="Status"
            onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&Year={$smarty.get.Year}&CompanyID={$smarty.get.CompanyID}&Status=' + this.value;">
        <option value="0">{translate label='alege status'}</option>
        <option value="0">{translate label='Toate'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
</div>
<br><br>
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
    {if count($fields_data) > 0}
        <tr height="30">
            <td><b>{translate label='Total'}</b></td>
            <td colspan="6">{$total}</td>
        </tr>
    {/if}
</table>