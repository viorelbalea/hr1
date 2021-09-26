{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        <tr>
            {if in_array('Year', $lstVisibleFilters)}
                <td>{translate label='An'}:</td>
                <td>
                    <select name="Year" id="Year">
                        <option value="0">{translate label='alege...'}</option>
                        {foreach from=$years key=key item=item}
                            <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="Year" value="0"/></td>
            {/if}
            {if in_array('Month', $lstVisibleFilters)}
                <td>
                    <select name="Month" id="Month">
                        <option value="0">{translate label='alege...'}</option>
                        {foreach from=$months key=key item=item}
                            <option value="{$item}" {if $smarty.get.Month == $item}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="Month" value="0"/></td>
            {/if}
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                {if in_array('CompanyID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="CompanyID" name="CompanyID" class="dropdown">
                            <option value="0">{translate label='Toate Companiile'}</option>
                            {foreach from=$self key=key item=item}
                                {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                    <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{translate label=$item}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="CompanyID" value="0"/></td>
                {/if}
                {if in_array('DepartmentID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="DepartmentID" name="DepartmentID" class="dropdown">
                            <option value="0">{translate label='Departament'}</option>
                            {foreach from=$departments key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{translate label=$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="DepartmentID" value="0"/></td>
                {/if}
            {/if}

            {if in_array('CostType', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="75">
                    <select id="CostType" name="CostType" class="dropdown">
                        <option value="0">{translate label='Tip Cost'}</option>
                        <option value="1" {if 1==$smarty.get.CostType}selected{/if}>Cost brut</option>
                        <option value="2" {if 2==$smarty.get.CostType}selected{/if}>Cost net</option>
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="CostType" value="0"/></td>
            {/if}
            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&rep=130&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&Month=' + document.getElementById('Month').value + '&CostType=' + document.getElementById('CostType').value + '&DepartmentID=' + document.getElementById('DepartmentID').value">
            </td>
        </tr>
    </table>
    <br>
{/if}
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