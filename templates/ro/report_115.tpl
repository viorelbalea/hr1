{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    {*{translate label='Companie'}:*}
    <select id="CompanyID" class="dropdown">
        <option value="0">{translate label='Toate companiile'}</option>
        {foreach from=$self key=key item=item}
            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    {*{translate label='Departament'}:*}
    <select id="DepartmentID" class="dropdown">
        <option value="0">{translate label='Toate departamentele'}</option>
        {foreach from=$departments key=key item=item}
            {if empty($deps) || isset($deps.$key)}
                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    <select id="Status" class="dropdown">
        <option value="0">{translate label='Alege status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <div style="display: inline-block; margin: 0 5px;">
        <b>{translate label='Se scad zile concediu si deplasari din perioada'}</b>
        <br><br>
        {translate label='Perioada intre'}
        <input type="text" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
           title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>
        {translate label='si'}
        <input type="text" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
           title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A>
    </div>
    <div style="display: inline-block; border-left:1px solid #000; padding: 0 5px;">
        <b>{translate label='Se dau bonurile din luna/anul'}</b>
        <br><br>
        {translate label='luna'}
        <select name="Month" id="Month">
            <option value="">{translate label='alege'}</option>
            {foreach from=$months item=item}
                <option value="{$item}" {if $smarty.get.Month == $item} selected="selected" {/if}>{$item}</option>
            {/foreach}
        </select>
        {translate label='anul'}
        <select name="Year" id="Year">
            <option value="">{translate label='alege'}</option>
            {foreach from=$years item=item}
                <option value="{$item}" {if $smarty.get.Year == $item} selected="selected" {/if}>{$item}</option>
            {/foreach}
        </select>
    </div>
    &nbsp;&nbsp;&nbsp;
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID}&rep={$smarty.get.rep}&CompanyID=' + document.getElementById('CompanyID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&Status=' + document.getElementById('Status').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&Month=' + document.getElementById('Month').value + '&Year=' + document.getElementById('Year').value;">
{/if}
{if !empty($smarty.get.StartDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            {if empty($smarty.get.export)}
                <td><b>#</b></td>
            {/if}
            <td><b>{translate label='Nume'}</b></td>
            <td><b>{translate label='CNP'}</b></td>
            <td><b>{translate label='Departament'}</b></td>
            <td><b>{translate label='Numar zile lucratoare in luna '}{$info.0}-{$info.1}</b></td>
            {*<td><b>{translate label='Numar zile lucratoare in perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b></td>*}
            <td><b>{translate label='Numar zile concediu in perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b></td>
            <td><b>{translate label='Zile invoire in perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b></td>
            <td><b>{translate label='Numar zile deplasare in perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b></td>
            <td><b>{translate label='Tichete aferente lunii '}{$info.0}-{$info.1}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            {if !empty($item.FullName)}
                <tr>
                    {if empty($smarty.get.export)}
                        <td>{$smarty.foreach.iter.iteration}</td>
                    {/if}
                    <td nowrap="nowrap">{$item.FullName}</td>
                    <td nowrap="nowrap">{$item.CNP|default:'&nbsp;'}</td>
                    <td nowrap="nowrap">{$departments[$item.DepartmentID]|default:'-'}</td>
                    <td>{$item.wdays|default:0}</td>
                    {*<td>{$item.pdays|default:0}</td>*}
                    <td>{$item.vdays|default:0}</td>
                    <td>{$item.invdays|default:0}</td>
                    <td>{$item.ddays|default:0}</td>
                    <td>{$item.tickets|default:0}</td>
                </tr>
            {/if}
        {/foreach}
        <tr>
            <td colspan="7">&nbsp;</td>
            <td><strong>{translate label='Total'}</strong></td>
            <td><strong>{$persons.TicketsTotal|default:0}</strong></td>
        </tr>
    </table>
{/if}