{if empty($smarty.get.export) && empty($smarty.get.export_doc) && empty($smarty.get.print_page) && empty($smarty.get.print) && empty($smarty.get.print_all)}
    <table cellspacing="0" cellpadding="0" height="60" width="100%" class="filter">
        <tr>
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                {if in_array('CompanyID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="CompanyID" name="CompanyID" class="dropdown">
                            <option value="0">{translate label='Companie self'}</option>
                            {foreach from=$self key=key item=item}
                                {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                    <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="CompanyID" value="0"/></td>
                {/if}
            {/if}
            {if !empty($divisions)}
                {if in_array('DivisionID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="DivisionID" name="DivisionID" class="dropdown">
                            <option value="0">{translate label='Divizie'}</option>
                            {foreach from=$divisions key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="DivisionID" value="0"/></td>
                {/if}
            {else}
                <td style="padding-left: 4px;" width="75"><input type="hidden" name="DivisionID" value="0"></td>
            {/if}
            {if in_array('DepartmentID', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="70">
                    <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                        <option value="0">{translate label='Departament'}</option>
                        {foreach from=$departments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="DepartmentID" value="0"/></td>
            {/if}
            {if in_array('SubDepartmentID', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="80">
                    <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                        <option value="0">{translate label='Subdepartament'}</option>
                        {foreach from=$subdepartments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.SubDepartmentID}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="SubDepartmentID" value="0"/></td>
            {/if}
            <td style="padding-left: 10px;" width="500">
                <input type="button" value="{translate label='Trimite'}" onclick="
                        var x = +document.getElementById('ShowLeft').checked;
                        window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&ShowLeft='+x+
                        '&Status=' + document.getElementById('Status').value +
                        '&ContractType=' + document.getElementById('ContractType').value +
                        '&DivisionID=' + document.getElementById('DivisionID').value +
                        '&CompanyID=' + document.getElementById('CompanyID').value +
                        '&DepartmentID=' + document.getElementById('DepartmentID').value +
                        '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value;">
            </td>
        </tr>
        <tr>
            {if in_array('ShowLeft', $lstVisibleFilters)}
                <td style="padding-left: 4px;" width="150">
                    {translate label='Afiseaza plecati'} <input type="checkbox" id="ShowLeft" name="ShowLeft" value="1" {if $smarty.get.ShowLeft==1} checked="checked"{/if} />
                </td>
            {else}
                <td><input type="hidden" id="ShowLeft" value="0"/></td>
            {/if}
            {if in_array('ContractType', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="75">
                    <select id="ContractType" name="ContractType" style="width:150px;">
                        <option value="0">{translate label='Tip contract'}</option>
                        {foreach from=$contract_type key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.ContractType}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="ContractType" value="0"/></td>
            {/if}
            {if in_array('Status', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="90" colspan="3">
                    <select id="Status" name="Status" class="cod" style="width:200px;">
                        <option value="0">{translate label='Status'}</option>
                        {foreach from=$status key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                            {foreach from=$substatus.$key key=key2 item=item2}
                                <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                            {/foreach}
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="Status" value="0"/></td>
            {/if}
        </tr>
    </table>
    <br/>
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