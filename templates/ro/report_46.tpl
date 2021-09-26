<div class="filter">
    {if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    {if in_array('CompanyID', $lstVisibleFilters)}
        <label>{translate label='Companie'}:</label>
        <select id="CompanyID" class="dropdown" onchange="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID=' + this.value;">
            <option value="0">{translate label='Toate companiile'}</option>
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
        <label>{translate label='Departament'}:</label>
        <select id="DepartmentID" class="dropdown">
            <option value="0">{translate label='Toate departamentele'}</option>
            {foreach from=$departments key=key item=item}
                {if empty($deps) || isset($deps.$key)}
                    <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                {/if}
            {/foreach}
        </select>
    {else}
    <input type="hidden" id="CompanyID" value="0"/>
    {/if}
    {if in_array('StartDate', $lstVisibleFilters)}
        <label>{translate label='Perioada intre'}</label>
    <input type="text" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
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
        <label>{translate label='si'}</label>
    <input type="text" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
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
        <input type="button" value="{translate label='Trimite'}"
               onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID=' + document.getElementById('CompanyID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value;">
    {/if}
</div>
{if !empty($smarty.get.StartDate)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
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