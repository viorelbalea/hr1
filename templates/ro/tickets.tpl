{include file="tickets_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Type" name="Type" class="cod">
        <option value="0">{translate label='Tip'}</option>
        {foreach from=$types key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
        <select id="CompanyID" name="CompanyID" class="dropdown">
            <option value="0">{translate label='Companie self'}</option>
            {foreach from=$self key=key item=item}
                {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                    <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                {/if}
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="CompanyID" value="0">
    {/if}

    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="Comments" {if $smarty.get.search_for == 'Comments'}selected{/if}>{translate label='Comentarii'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>

    {if !empty($divisions)}
        <td style="padding-left: 2px;" width="75">
            <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=tickets&DivisionID=' + this.value" class="dropdown">
                <option value="0">{translate label='Divizie'}</option>
                {foreach from=$divisions key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                {/foreach}
            </select></td>
    {else}
        <input type="hidden" name="DivisionID" id="DivisionID" value="0">
    {/if}
    <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Departament'}</option>
        {foreach from=$departments key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Subdepartament'}</option>
        {foreach from=$subdepartments key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.SubDepartmentID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    {*
        <select id="CostCenterID" name="CostCenterID" class="dropdown">
            <option value="0">{translate label='Centru de cost'}</option>
            {foreach from=$costcenter key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    *}
    {math equation=x-y x=$smarty.now y=86400 assign=yesterday}
    {math equation=x+y x=$smarty.now y=86400 assign=tomorrow}
    <label>{translate label='Creat intre'}:</label><input type="text" name="DateStart" id="DateStart" class="formstyle"
                                                          value="{$smarty.get.DateStart|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                          border="0"/></A></label>
    <label>{translate label='si'}</label>
    <input type="text" name="DateEnd" id="DateEnd" class="formstyle" value="{$smarty.get.DateEnd|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
    <label>{translate label='Data limita intre'}:</label><input type="text" name="NextDateStart" id="NextDateStart" class="formstyle"
                                                                value="{$smarty.get.NextDateStart|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js3">
        var cal3 = new CalendarPopup();
        cal3.isShowNavigationDropdowns = true;
        cal3.setYearSelectStartOffset(10);
        //writeSource("js3");
    </SCRIPT>
    <label><A HREF="#" onClick="cal3.select(document.getElementById('NextDateStart'),'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img src="images/cal.png"
                                                                                                                                                              border="0"/></A></label>
    <label>{translate label='si'}</label> <input type="text" name="NextDateEnd" id="NextDateEnd" class="formstyle"
                                                 value="{$smarty.get.NextDateEnd|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js4">
        var cal4 = new CalendarPopup();
        cal4.isShowNavigationDropdowns = true;
        cal4.setYearSelectStartOffset(10);
        //writeSource("js4");
    </SCRIPT>
    <label><A HREF="#" onClick="cal4.select(document.getElementById('NextDateEnd'),'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img src="images/cal.png"
                                                                                                                                                            border="0"/></A></label>

    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>{translate label='inregistrari'}</label><br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li>
                    <input name="button" type="button" class="cod printFile" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'"
                           value="{translate label='Printeaza pagina'}"/>
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
                <li>
                    <input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Ticket&type=popup','',250,400)">
                </li>
                <ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Cerere" request_uri=$request_uri order_by=Report}</td>
        {if !empty($personalisedlist.Ticket)}
            {foreach from=$personalisedlist.Ticket key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Nume" request_uri=$request_uri order_by=FullName}</td>
            <td class="bkdTitleMenu">{orderby label="Tip" request_uri=$request_uri order_by=TicketType}</td>
            <td class="bkdTitleMenu">{orderby label="Status" request_uri=$request_uri order_by=TicketStatus}</td>
            <td class="bkdTitleMenu">{orderby label="Comentarii" request_uri=$request_uri order_by=Comments}</td>
            <td class="bkdTitleMenu">{orderby label="Data" request_uri=$request_uri order_by=TCreateDate}</td>
            <td class="bkdTitleMenu">{orderby label="Data limita" request_uri=$request_uri order_by=TLimitDate}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$tickets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$tickets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    {if $item.TicketType==1}
                        <a href="./?m=tickets&o=edit&TicketID={$key}" class="blue">{$item.Report}</a>
                    {elseif $item.TicketType==2}
                        <a href="./?m=tickets&o=edit&TicketID={$key}" class="blue">{$services[$item.ReportID]}</a>
                    {elseif $item.TicketType==3}
                        <a href="./?m=tickets&o=edit&TicketID={$key}" class="blue">{translate label='Vizualizeaza'}</a>
                    {/if}
                </td>
                {if !empty($personalisedlist.Ticket)}
                    {foreach from=$personalisedlist.Ticket key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.TicketStatus]|default:'-'}
                            {elseif $field == 'Type'}
                                {$types[$item.TicketType]|default:'-'}
                            {elseif $field == 'CreateDate'}
                                {$item.TCreateDate|default:'-'}
                            {elseif $field == 'LimitDate'}
                                {$item.TLimitDate|default:'-'}
                            {elseif $field == 'CompanyID'}
                                {$self[$item.CompanyID]|default:'-'}
                            {elseif $field == 'DivisionID'}
                                {$divisions[$item.DivisionID]|default:'-'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'-'}
                            {elseif $field == 'SubDepartmentID'}
                                {$subdepartments[$item.SubDepartmentID]|default:'-'}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                    <td class="celulaMenuST">{$types[$item.TicketType]|default:'-'}</td>
                    <td class="celulaMenuST">{$status[$item.TicketStatus]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Comments|default:'-'}</td>
                    <td class="celulaMenuST">{$item.TCreateDate|default:'-'}</td>
                    <td class="celulaMenuST">{$item.TLimitDate|default:'-'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta cerere?'}')) window.location.href='./?m=tickets&o=del&TicketID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($cars)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=tickets&Type=' + document.getElementById('Type').value +
            '&Status=' + document.getElementById('Status').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&NextDateStart=' + document.getElementById('NextDateStart').value +
            '&NextDateEnd=' + document.getElementById('NextDateEnd').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>
