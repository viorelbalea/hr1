{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <div class="filter">
        {if in_array('Year', $lstVisibleFilters)}
            <label>{translate label='An'}:</label>
            <select name="Year" id="Year">
                <option value="0">{translate label='alege...'}</option>
                {foreach from=$years key=key item=item}
                    <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="Year" value="0"/>
        {/if}
        {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
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
            {if in_array('DepartmentID', $lstVisibleFilters)}
                <select id="DepartmentID" name="DepartmentID" class="dropdown">
                    <option value="0">{translate label='Departament'}</option>
                    {foreach from=$departments key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            {else}
                <input type="hidden" id="DepartmentID" value="0"/>
            {/if}
        {/if}

        {if in_array('SalaryType', $lstVisibleFilters)}
            <select id="SalaryType" name="SalaryType" class="dropdown">
                <option value="0">{translate label='Tip salariu'}</option>
                {foreach from=$salary_types key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.SalaryType}selected{/if}>{translate label=$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="SalaryType" value="0"/>
        {/if}
        <input type="button" value="{translate label='Afiseaza'}"
               onclick="window.location.href = './?m=reports&rep=124&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&SalaryType=' + document.getElementById('SalaryType').value + '&DepartmentID='+document.getElementById('DepartmentID').value">
    </div>
{/if}
<table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
    <tr>
        <td><b>#</b></td>
        {foreach from=$fields item=field}
            {if !empty($field.sort)}
                {if $field.sort === 'asc'}
                    <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                {elseif $field.sort === 'desc'}
                    <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                {else}
                    <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                {/if}
            {else}
                <td align="center">{translate label=$field.label}</td>
            {/if}
        {/foreach}

    </tr>
    {foreach from=$fields_data item=item name=iter}
        <tr height="30">
            <td>{$smarty.foreach.iter.iteration}</td>

            {foreach from=$fields item=field}
                {assign var=field_name value=$field.name}
                <td{if $field.align} align="{$field.align}"{/if}>{$item.$field_name|default:'&nbsp'}</td>
            {/foreach}

        </tr>
        {foreachelse}
        <tr height="30">
            <td colspan="100">{translate label='Nu sunt date!'}</td>
        </tr>
    {/foreach}

    {if count($sums_data) > 0}
        {foreach from=$sums_data key=key item=item name=iter}
            <tr>
                {foreach from=$fields item=field}
                    {assign var=field_name value=$field.name}
                    {if $field_name != 'Department'}
                        {if $field_name == 'FullName'}
                            <td{if $field.align} align="{$field.align}"{/if} colspan="3">{$item.$field_name|default:'&nbsp'}</td>
                        {else}
                            <td{if $field.align} align="{$field.align}"{/if}>{$item.$field_name|default:'&nbsp'}</td>
                        {/if}
                    {/if}
                {/foreach}
            </tr>
        {/foreach}
        <tr>
            <td align="center" colspan="3">{translate label='TOTAL'}</td>
            {foreach from=$fields item=field}
                {assign var=field_name value=$field.name}
                {if $field_name != 'Department' && $field_name != 'FullName'}
                    <td{if $field.align} align="{$field.align}"{/if}>{$totals_data.$field_name|default:'&nbsp'}</td>
                {/if}
            {/foreach}
        </tr>
    {/if}
</table>