{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
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
                {if in_array('DepartmentID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="DepartmentID" name="DepartmentID" class="dropdown">
                            <option value="0">{translate label='Departament'}</option>
                            {foreach from=$departments key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="DepartmentID" value="0"/></td>
                {/if}
                {if in_array('Status', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="Status">
                            <option value="0">{translate label='alege status'}</option>
                            <option value="0">{translate label='Toate'}</option>
                            {foreach from=$status key=key item=item}
                                <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="Status" value="0"/></td>
                {/if}
                {if in_array('ContractType', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="ContractType">
                            <option value="0">{translate label='alege tip contract'}</option>
                            {foreach from=$contract_type key=key item=item}
                                <option value="{$key}" {if $smarty.get.ContractType == $key}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="ContractType" value="0"/></td>
                {/if}
            {/if}

            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&rep=116&do_rep=1&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&DepartmentID='+document.getElementById('DepartmentID').value + '&Status=' + document.getElementById('Status').value + '&ContractType=' + document.getElementById('ContractType').value;">
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
    