{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <div class="filter">
        {if !empty($divisions)}
            <select id="DivisionID" name="DivisionID" class="dropdown">
                <option value="0">{translate label='Divizie'}</option>
                {foreach from=$divisions key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="DivisionID" value="0"/>
        {/if}
        <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
            <option value="0">{translate label='Departament'}</option>
            {foreach from=$departments key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        <label>{translate label='Perioada intre'}</label>
        <input type="text" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$def_start|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                  title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A></label>
        <label>{translate label='si'}</label>
        <input type="text" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$def_end|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                  title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A></label>
        <input type="button" value="{translate label='Trimite'}"
               onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value;">
    </div>
{/if}
{if !empty($smarty.get.StartDate)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>{orderby label='Marca' request_uri=$request_uri order_by=EmpCode}</b></td>
            <td><b>{orderby label='Nume si prenume' request_uri=$request_uri order_by=FullName}</b></td>
            <td><b>{orderby label='Data' request_uri=$request_uri order_by=Date}</b></td>
            {*<td><b>{orderby label='Nume mancare' request_uri=$request_uri order_by=Item}</b></td>*}
            <td><b>{orderby label='Tip mancare' request_uri=$request_uri order_by=Category}</b></td>
            <td><b>{orderby label='Portii companie' request_uri=$request_uri order_by=NoFree}</b></td>
            <td><b>{orderby label='Portii angajat' request_uri=$request_uri order_by=NoPaid}</b></td>
            <td><b>{orderby label='Portii total' request_uri=$request_uri order_by=No}</b></td>
            <td><b>{translate label='Cost companie'}</b></td>
            <td><b>{translate label='Cost angajat'}</b></td>
            <td><b>{translate label='Cost total'}</b></td>

        </tr>
        {foreach from=$catering.0 key=key item=item}
            {foreach from=$item item=item2}
                {foreach from=$item2 item=item3}
                    {foreach from=$item3 key=key4 item=item4}
                        {if is_int($key4)}
                            <tr>
                                <td>{$item4.EmpCode|default:'-'}</td>
                                <td>{$item4.FullName}</td>
                                <td>{$item4.Date|date_format:'%d.%m.%Y'}</td>
                                {*<td>{$item4.Item}</td>*}
                                <td>{$item4.Category}</td>
                                <td>{$item4.NoFree}</td>
                                <td>{$item4.NoPaid}</td>
                                <td>{$item4.No}</td>
                                <td>{$item4.NoFree*$item4.Price|default:0}</td>
                                <td>{$item4.NoPaid*$item4.Price|default:0}</td>
                                <td>{$item4.No*$item4.Price|default:0}</td>
                            </tr>
                        {/if}
                    {/foreach}
                {/foreach}
            {/foreach}
        {/foreach}

        <tr>
            <td colspan="100" style="border:none; padding:20px 0 20px 0;"><b>{translate label='Lista generata automat pentru angajati care nu au comandat'}</b></td>
        </tr>
        <!-- Angajati generati automat -->
        {foreach from=$catering.2 key=key item=item}
            {foreach from=$item item=item2}
                {foreach from=$item2 item=item3 key=key3}
                    <tr>
                        <td>{$item3.EmpCode|default:'-'}</td>
                        <td>{$item3.FullName|default:'-'}</td>
                        <td>{$item3.Date|date_format:'%d.%m.%Y'}</td>
                        {*<td>{$item3.Item|default:'-'}</td>*}
                        <td>{$item3.Category|default:'-'}</td>
                        <td>{$item3.NoFree|default:'-'}</td>
                        <td>{$item3.NoPaid|default:'-'}</td>
                        <td>{$item3.No|default:'-'}</td>
                        <td>{$item3.NoFree*$item3.Price|default:0}</td>
                        <td>{$item3.NoPaid*$item3.Price|default:0}</td>
                        <td>{$item3.No*$item3.Price|default:0}</td>
                    </tr>
                {/foreach}
            {/foreach}
        {/foreach}
        <tr>
            <td colspan="20" style="border-bottom:none; border-left:none; border-right:none;">&nbsp;</td>
        </tr>
        <!-- List for categories -->
        {foreach from=$catering.1 key=key item=item}
            <tr>
                <td colspan="3" style="border:none;">&nbsp;</td>
                <td><b>{$item.Category|default:'-'}</b></td>
                <td>{$item.NoFree|default:'0'}</td>
                <td>{$item.NoPaid|default:'0'}</td>
                <td>{$item.No|default:'0'}</td>
                <td>{$item.NoFree*$item.Price|default:0}</td>
                <td>{$item.NoPaid*$item.Price|default:0}</td>
                <td>{$item.No*$item.Price|default:0}</td>
            </tr>
        {/foreach}
    </table>
{/if}