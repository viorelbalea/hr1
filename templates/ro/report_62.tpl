{if empty($smarty.get.export_doc) && empty($smarty.get.export) && empty($smarty.get.print)}
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
                <td style="padding-left: 2px;" width="70">
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
            <td>
                <input type="button" value="{translate label='Trimite'}"
                       onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                               '&EndDate=' + document.getElementById('EndDate').value +
                               '&DivisionID=' + document.getElementById('DivisionID').value +
                               '&CompanyID=' + document.getElementById('CompanyID').value +
                               '&DepartmentID=' + document.getElementById('DepartmentID').value +
                               '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value;">
            </td>
        </tr>
        <tr>
            {if in_array('StartDate', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="75">
                    <label for="StartDate" style="padding-top:5px;">{translate label='Expirare intre'}</label>
                    <input type="text" label=name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
                    <SCRIPT LANGUAGE="JavaScript" ID="js1">
                        var cal1 = new CalendarPopup();
                        cal1.isShowNavigationDropdowns = true;
                        cal1.setYearSelectStartOffset(10);
                        //writeSource("js1");
                    </SCRIPT>
                    <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                       title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}" style="padding-top: 5px;"></A>
                </td>
            {else}
                <td><input type="hidden" id="StartDate" value=""/></td>
            {/if}
            {if in_array('EndDate', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="75">
                    <label for="EndDate" style="padding-top:5px;">{translate label='si'}</label>
                    <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
                    <SCRIPT LANGUAGE="JavaScript" ID="js2">
                        var cal2 = new CalendarPopup();
                        cal2.isShowNavigationDropdowns = true;
                        cal2.setYearSelectStartOffset(10);
                        //writeSource("js2");
                    </SCRIPT>
                    <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                       title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" style="padding-top: 5px;" alt="{translate label='Data de sfarsit'}"></A>
                </td>
            {else}
                <td><input type="hidden" id="EndDate" value=""/></td>
            {/if}
        </tr>
    </table>
    <br/>
    <br/>
{/if}

{if !empty($smarty.get.StartDate)}
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