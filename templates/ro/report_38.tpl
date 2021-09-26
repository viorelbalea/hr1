{if empty($smarty.get.export_doc) && empty($smarty.get.export) && empty($smarty.get.print)}
    <div class="filter">
        <tr>
            {if in_array('SelDate', $lstVisibleFilters) && in_array('SelDatef', $lstVisibleFilters)}
                <label>{translate label='Data inceput'}</label>
                <input type="text" name="SelDate" id="SelDate" class="formstyle" value="{$smarty.get.SelDate|default:''}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                    var cal1 = new CalendarPopup();
                    cal1.isShowNavigationDropdowns = true;
                    cal1.setYearSelectStartOffset(10);
                    //writeSource("js1");
                </SCRIPT>
                <label><A HREF="#" onClick="cal1.select(document.getElementById('SelDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                          title="{translate label='Data inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data inceput'}"></A></label>
                <label>{translate label='Data sfarsit'}</label>
                <input type="text" name="SelDatef" id="SelDatef" class="formstyle" value="{$smarty.get.SelDatef|default:''}" size="10" maxlength="10">
                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                    var cal2 = new CalendarPopup();
                    cal2.isShowNavigationDropdowns = true;
                    cal2.setYearSelectStartOffset(10);
                    //writeSource("js1");
                </SCRIPT>
                <label><A HREF="#" onClick="cal2.select(document.getElementById('SelDatef'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                          title="{translate label='Data sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data sfarsit'}"></A></label>
            {else}
                <td><input type="hidden" id="SelDate" value=""/><input type="hidden" id="SelDatef" value=""/></td>
            {/if}
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
                {else}
                <input type="hidden" id="CompanyID" value="0"/>
                {/if}
                {/if}
                {if !empty($divisions)}
                    {if in_array('DivisionID', $lstVisibleFilters)}
                        <select id="DivisionID" name="DivisionID" class="dropdown">
                            <option value="0">{translate label='Divizie'}</option>
                            {foreach from=$divisions key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    {else}
                        <input type="hidden" id="DivisionID" value="0"/>
                    {/if}
                {else}
                    <input type="hidden" name="DivisionID" value="0">
                {/if}
                {if in_array('DepartmentID', $lstVisibleFilters)}
                    <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                        <option value="0">{translate label='Departament'}</option>
                        {foreach from=$departments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                {else}
                    <input type="hidden" id="DepartmentID" value="0"/>
                {/if}
                {if in_array('SubDepartmentID', $lstVisibleFilters)}
                    <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                        <option value="0">{translate label='Subdepartament'}</option>
                        {foreach from=$subdepartments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.SubDepartmentID}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                {else}
                    <input type="hidden" id="SubDepartmentID" value="0"/>
                {/if}
                <input type="button" value="{translate label='Trimite'}" onclick="
                        var x = +document.getElementById('ShowLeft').checked;
                        if(document.getElementById('SelDate').value=='' && document.getElementById('SelDatef').value=='') {ldelim}alert('{translate label='Nu ati selectat data!'}'); return false;{rdelim}
                        window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&SelDate=' + document.getElementById('SelDate').value +
                        '&SelDatef=' + document.getElementById('SelDatef').value +
                        '&ShowLeft='+x+
                        '&Status=' + document.getElementById('Status').value +
                        '&ContractType=' + document.getElementById('ContractType').value +
                        '&DivisionID=' + document.getElementById('DivisionID').value +
                        '&CompanyID=' + document.getElementById('CompanyID').value +
                        '&DepartmentID=' + document.getElementById('DepartmentID').value +
                        '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value;">
                {if in_array('ShowLeft', $lstVisibleFilters)}
                    <br/>
                    <label>{translate label='Afiseaza plecati'}</label>
                    <input type="checkbox" id="ShowLeft" name="ShowLeft" value="1" {if $smarty.get.ShowLeft==1} checked="checked"{/if} />
                {else}
                    <input type="hidden" id="ShowLeft" value="0"/>
                {/if}
                {if in_array('ContractType', $lstVisibleFilters)}
                    <select id="ContractType" name="ContractType" style="width:150px;">
                        <option value="0">{translate label='Tip contract'}</option>
                        {foreach from=$contract_type key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.ContractType}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                {else}
                    <input type="hidden" id="ContractType" value="0"/>
                {/if}
                {if in_array('Status', $lstVisibleFilters)}
                    <select id="Status" name="Status" class="cod" style="width:200px;">
                        <option value="0">{translate label='Status'}</option>
                        {foreach from=$status key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                            {foreach from=$substatus.$key key=key2 item=item2}
                                <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                            {/foreach}
                        {/foreach}
                    </select>
                {else}
                    <input type="hidden" id="Status" value="0"/>
                {/if}
    </div>
{/if}

{if !empty($smarty.get.SelDate) || !empty($smarty.get.SelDatef)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <!-- Fields -->
        <tr>
            <td><b>#</b></td>
            {foreach from=$fields item=field key=kfield name=nfield }
                <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
            {/foreach}
        </tr>

        <!-- Values -->
        {foreach from=$fields.0.data item=field key=kfield name=nfield }
            <tr>
                <td>{$smarty.foreach.nfield.iteration}</td>

                {if $fields.0}
                    <td>{$fields.0.data.$kfield}</td>{/if}
                {if $fields.1}
                    <td>{$fields.1.data.$kfield|default:'&nbsp;'}</td>{/if}
                {if $fields.2}
                    <td>{$fields.2.data.$kfield|default:'&nbsp;'}</td>{/if}
                {if $fields.3}
                    <td>{$fields.3.data.$kfield|default:'&nbsp;'}</td>{/if}
                {if $fields.4}
                    <td>{$fields.4.data.$kfield|default:'&nbsp;'}</td>{/if}

            </tr>
            {foreachelse}
            <tr height="30">
                <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}