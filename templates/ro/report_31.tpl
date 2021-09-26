{if empty($smarty.get.export)}
<div class="filter">
    {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
        {if in_array('CompanyID', $lstVisibleFilters)}
            <select id="CompanyID" id="CompanyID" class="dropdown">
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
    {else}
        <input type="hidden" id="CompanyID" value="0">
    {/if}
    {if !empty($divisions)}
        {if in_array('DivisionID', $lstVisibleFilters)}
            <select id="DivisionID" id="DivisionID" class="dropdown">
                <option value="0">{translate label='Divizie'}</option>
                {foreach from=$divisions key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="DivisionID" value="0"/>
        {/if}
    {else}
        <input type="hidden" id="DivisionID" value="0">
    {/if}
    {if in_array('DepartmentID', $lstVisibleFilters)}
        <select id="DepartmentID" id="DepartmentID" class="dropdown">
            <option value="0">{translate label='Departament'}</option>
            {foreach from=$departments key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="DepartmentID" value="0"/>
    {/if}

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
        <input type="hidden" id="StartDate" value=""/>
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
        <input type="hidden" id="EndDate" value=""/>
    {/if}
    {if in_array('ViewAll', $lstVisibleFilters)}
        <input type="checkbox" name="ViewAll" id="ViewAll" value="1" {if $smarty.get.ViewAll==1} checked="checked"{/if} />
        <label>{translate label='Toti angajatii'}</label>
    {else}
        <input type="hidden" id="ViewAll" value="0"/>
    {/if}
    {if in_array('VacationType', $lstVisibleFilters)}
        <label>{translate label='Tip concediu'}</label>
        <select name="VacationType" id="VacationType">
            <option value="0">{translate label='Toate'}</option>
            <option value="CO" {if $smarty.get.VacationType=='CO'} selected="selected"{/if}>CO</option>
            <option value="CM" {if $smarty.get.VacationType=='CM'} selected="selected"{/if}>CM</option>
            <option value="CS" {if $smarty.get.VacationType=='CS'} selected="selected"{/if}>CS</option>
            <option value="CIC" {if $smarty.get.VacationType=='CIC'} selected="selected"{/if}>CIC</option>
            <option value="CFS" {if $smarty.get.VacationType=='CFS'} selected="selected"{/if}>CFS</option>
            <option value="CE" {if $smarty.get.VacationType=='CE'} selected="selected"{/if}>CE</option>
        </select>
    {else}
        <input type="hidden" id="VacationType" value="0"/>
    {/if}
    &nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}" onclick="
            var x = document.getElementById('ViewAll').checked?1:0;
            window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value
            + '&EndDate=' + document.getElementById('EndDate').value
            + '&CompanyID=' + document.getElementById('CompanyID').value
            + '&DivisionID=' + document.getElementById('DivisionID').value
            + '&DepartmentID=' + document.getElementById('DepartmentID').value
            + '&ViewAll=' + x
            + '&VacationType=' + document.getElementById('VacationType').value; ">
    {/if}
</div>
{if !empty($smarty.get.StartDate)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td align="center"><b>#</b></td>
            <td align="center"><b>{translate label='Nume'}</b></td>
            <td align="center"><b>{translate label='Total'}</b></td>
            {foreach from=$cal key=day item=wday}
                <td align="center" {if $wday=='S' || $wday=='D'}bgcolor="#ffffcc"{/if}><b>{$wday}</b><br>{$day|date_format:'%d.%m'}</td>
            {/foreach}
        </tr>
        {foreach from=$vacations item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td align="center">{$item.TotalVac|default:'0'}</td>
                {foreach from=$cal key=day item=wday}
                    <td align="center" {if $wday=='S' || $wday=='D'}bgcolor="#ffffcc"{/if}>

                        {if isset($item.$day)}
                            {if $item.$day.1==1}
                                {$item.$day.0}
                            {elseif $item.$day.1==0}
                                <span style="background-color:#FFCCCC;">{$item.$day.0}</span>
                            {/if}
                        {else}
                            &nbsp;
                        {/if}

                    </td>
                {/foreach}
            </tr>
        {/foreach}
    </table>
{/if}