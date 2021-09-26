<div class="filter">
    {if in_array('StartDate', $lstVisibleFilters)}
        <label>{translate label='Perioada intre'}</label>
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
        <input type="hidden" name="StartDate" id="StartDate" value=""/>
    {/if}
    {if in_array('EndDate', $lstVisibleFilters)}
        <label>{translate label='si'}</label>
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
        <input type="hidden" name="EndDate" id="EndDate" value=""/>
    {/if}
    {if in_array('Status', $lstVisibleFilters)}
        <select id="Status">
            <option value="0">{translate label='alege status'}</option>
            {foreach from=$status key=key item=item}
                <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" name="Status" id="Status" value="0"/>
    {/if}
    {if in_array('ContractType', $lstVisibleFilters)}
        <select id="ContractType">
            <option value="0">{translate label='alege tip contract'}</option>
            {foreach from=$contract_type key=key item=item}
                <option value="{$key}" {if $smarty.get.ContractType == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" name="ContractType" id="ContractType" value="0"/>
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
</div>
{if !empty($smarty.get.StartDate)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>#</b></td>
            <td><b>{orderby label='Nume' request_uri=$request_uri order_by=FullName}</b></td>
            <td><b>{orderby label='Data angajarii' request_uri=$request_uri order_by=StartDate}</b></td>
            <td><b>{orderby label='Data plecarii' request_uri=$request_uri order_by=StopDate}</b></td>
            <td><b>{orderby label='Status' request_uri=$request_uri order_by=Status}</b></td>
            <td><b>{orderby label='Tip contract' request_uri=$request_uri order_by=ContractType}</b></td>
            <td><b>{orderby label='Companie' request_uri=$request_uri order_by=CompanyName}</b></td>
            <td><b>{orderby label='Divizie' request_uri=$request_uri order_by=Division}</b></td>
            <td><b>{orderby label='Departament' request_uri=$request_uri order_by=Department}</b></td>
            <td><b>{orderby label='Subdepartament' request_uri=$request_uri order_by=Subdepartment}</b></td>
            <td align="center">
                <table width="100%" cellspacing="0" cellpadding="2" border="0">
                    <tr>
                        <td colspan="10" align="center" style="border-bottom:solid 1px #333;"><b>{translate label='Evolutie salariala'}</b></td>
                    </tr>
                    <tr>
                        <td><b>{translate label='Data inceput'}</b></td>
                        <td><b>{translate label='Data sfarsit'}</b></td>
                        <td><b>{translate label='Salariu net'}</b></td>
                        <td><b>{translate label='Salariu brut'}</b></td>
                        <td><b>{translate label='Cost salariu'}</b></td>
                        <td><b>{translate label='Moneda'}</b></td>
                    </tr>
                </table>
            </td>
            <td><b>{translate label='Vechime in companie (a/l/z)'}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{if $item.DataStart!='00.00.0000'}{$item.DataStart}{else}-{/if}</td>
                <td>{if $item.DataEnd!=''}{$item.DataEnd}{else}-{/if}</td>
                <td>{$status[$item.Status]|default:'-'}</td>
                <td>{$contract_type[$item.ContractType]|default:'-'}</td>
                <td>{$item.CompanyName|default:'-'}</td>
                <td>{$item.Division|default:'-'}</td>
                <td>{$item.Department|default:'-'}</td>
                <td>{$item.Subdepartment|default:'-'}</td>
                <td align="center">
                    <table width="100%" cellspacing="0" cellpadding="2" border="1">
                        {foreach from=$item.Salaries item=item2 }
                            <tr>
                                <td>{if $item2.StartDate!='00.00.0000'}{$item2.StartDate}{else}-{/if}</td>
                                <td>{if $item2.StopDate!='00.00.0000'}{$item2.StopDate}{else}-{/if}</td>
                                <td>{$item2.SalaryNet|default:'-'}</td>
                                <td>{$item2.Salary|default:'-'}</td>
                                <td>{$item2.SalaryCost|default:'-'}</td>
                                <td>{$item2.Currency|default:'-'}</td>
                            </tr>
                        {/foreach}
                    </table>
                </td>
                <td>{$item.CompanyAge|default:'0'}</td>
            </tr>
        {/foreach}
    </table>
{/if}