<div class="filter">
    {if in_array('StartDate', $lstVisibleFilters)}
        {translate label='Perioada intre'}
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                  title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A></label>
    {else}
        <input type="hidden" id="StartDate" value=""/>
    {/if}
    {if in_array('EndDate', $lstVisibleFilters)}
        {translate label='si'}
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                  title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A></label>
    {else}
        <input type="hidden" id="EndDate" value=""/>
    {/if}
    {if in_array('Status', $lstVisibleFilters)}
        <select id="Status">
            <option value="0">{translate label='alege status'}</option>
            {foreach from=$status key=key item=item}
                <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="Status" value="0"/>
    {/if}
    {if in_array('ContractType', $lstVisibleFilters)}
        <select id="ContractType">
            <option value="0">{translate label='alege tip contract'}</option>
            {foreach from=$contract_type key=key item=item}
                <option value="{$key}" {if $smarty.get.ContractType == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="ContractType" value="0"/>
    {/if}

    {if in_array('CompanyID', $lstVisibleFilters)}
        <select id="CompanyID" style="width:150px;">
            <option value="0">{translate label='alege companie'}</option>
            {foreach from=$self key=key item=item}
                <option value="{$key}" {if $smarty.get.CompanyID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="CompanyID" value="0"/>
    {/if}
    {if in_array('DivisionID', $lstVisibleFilters)}
        <select id="DivisionID" style="width:150px;">
            <option value="0">{translate label='alege divizie'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $smarty.get.DivisionID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="DivisionID" value="0"/>
    {/if}
    {if in_array('DepartmentID', $lstVisibleFilters)}
        <select id="DepartmentID" style="width:150px;">
            <option value="0">{translate label='alege departament'}</option>
            {foreach from=$departments key=key item=item}
                <option value="{$key}" {if $smarty.get.DepartmentID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="DepartmentID" value="0"/>
    {/if}
    {if in_array('SubdepartmentID', $lstVisibleFilters)}
        <select id="SubdepartmentID" style="width:150px;">
            <option value="0">{translate label='alege subdepartament'}</option>
            {foreach from=$subdepartments key=key item=item}
                <option value="{$key}" {if $smarty.get.SubdepartmentID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="SubdepartmentID" value="0"/>
    {/if}
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                   '&EndDate=' + document.getElementById('EndDate').value +
                   '&Status=' + document.getElementById('Status').value +
                   '&ContractType=' + document.getElementById('ContractType').value +
                   '&CompanyID=' + document.getElementById('CompanyID').value +
                   '&DivisionID=' + document.getElementById('DivisionID').value +
                   '&DepartmentID=' + document.getElementById('DepartmentID').value +
                   '&SubdepartmentID=' + document.getElementById('SubdepartmentID').value;">
</div>
{if !empty($smarty.get.StartDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1" class="grid">
        <tr>
            <td><b>#</b></td>
            {foreach from=$fields item=field}
                {if !empty($field.sort)}
                    {if $field.sort === 'asc'}
                        <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                    {elseif $field.sort === 'desc'}
                        <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                    {else}
                        <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                    {/if}
                {else}
                    <td><b>{translate label=$field.label}</b></td>
                {/if}
            {/foreach}

        </tr>
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
                <td colspan="100">{translate label='Nu exista inregistrari'}</td>
            </tr>
        {/foreach}
    </table>
{/if}