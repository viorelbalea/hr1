{include file="ticketing_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Type" name="Type" class="cod">
        <option value="0">{translate label='Tip tichet'}</option>
        {foreach from=$types key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>Status:</label>
    {foreach from=$status key=key item=item}&nbsp;
        <input type="checkbox" id="Status_{$key}" {if strstr($smarty.get.Status, '|'|cat:$key|cat:'|')}checked{/if}>
        <label>{translate label=$item}</label>{/foreach}
    <select id="CompanyID" class="cod" style="width:200px;">
        <option value="0">{translate label='companie'}</option>
        {foreach from=$companies key=key item=item}
            <option value="{$key}" {if $smarty.get.CompanyID == $key}selected{/if}>{$item.CompanyName}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="Title" {if $smarty.get.search_for == 'Title'}selected{/if}>{translate label='Titlu'}</option>
        <option value="Notes" {if $smarty.get.search_for == 'Notes'}selected{/if}>{translate label='Descriere'}</option>
        <option value="Notes2" {if $smarty.get.search_for == 'Notes2'}selected{/if}>{translate label='Comentarii'}</option>
        <option value="TicketID" {if $smarty.get.search_for == 'TicketID'}selected{/if}>{translate label='ID tichet'}</option>
        <option value="ComputerName" {if $smarty.get.search_for == 'ComputerName'}selected{/if}>{translate label='Nume computer'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();">
    <br/>
    <label>{translate label='Creat intre'}:</label> <input type="text" name="DateStart" id="DateStart" class="formstyle"
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
    <select id="AssignedPersonID" name="AssignedPersonID" class="cod">
        <option value="0">{translate label='Asignare'}</option>
        {foreach from=$asignees key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.AssignedPersonID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CategoryID" name="CategoryID" class="cod">
        <option value="0">{translate label='Categoria'}</option>
        {foreach from=$categories key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CategoryID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="DepartmentID" name="DepartmentID" class="cod">
        <option value="0">{translate label='Departament'}</option>
        {foreach from=$departments key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="AppVersionID" name="AppVersionID" class="cod">
        <option value="0">{translate label='Versiunea'}</option>
        {foreach from=$application_version key=key item=item}
            <option {if $item.Status == 0} style="color:gray;"{/if} value="{$key}" {if $key==$smarty.get.AppVersionID}selected{/if}>{$item.DisplayVersion}</option>
        {/foreach}
    </select>
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>{translate label='inregistrari'}</label>
    <br/>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Ticketing&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="ID" request_uri=$request_uri order_by=TicketID}</td>
        <td class="bkdTitleMenu">{orderby label="Solicitant" request_uri=$request_uri order_by=Author}</td>
        {if !empty($personalisedlist.Ticketing)}
            {foreach from=$personalisedlist.Ticketing key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Solicitat de" request_uri=$request_uri order_by=Author}</td>
            <td class="bkdTitleMenu">{orderby label="Tip" request_uri=$request_uri order_by=Type}</td>
            <td class="bkdTitleMenu">{orderby label="Status" request_uri=$request_uri order_by=Status}</td>
            <td class="bkdTitleMenu">{orderby label="Prioritate" request_uri=$request_uri order_by=Priority}</td>
            <td class="bkdTitleMenu">{orderby label="Importanta" request_uri=$request_uri order_by=Importance}</td>
            <td class="bkdTitleMenu">{orderby label="Data crearii" request_uri=$request_uri order_by=CreateDate}</td>
            <td class="bkdTitleMenu">{orderby label="Asignare" request_uri=$request_uri order_by=AssignedFullName}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$tickets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$tickets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=ticketing&o=edit&TicketID={$key}" class="blue">{$item.TicketID}</a></td>
                <td class="celulaMenuST"><a href="./?m=ticketing&o=edit&TicketID={$key}" class="blue">{$item.Author}</a></td>
                {if !empty($personalisedlist.Ticketing)}
                    {foreach from=$personalisedlist.Ticketing key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]|default:'-'}
                            {elseif $field == 'CategoryID'}
                                {$categories[$item.CategoryID]|default:'-'}
                            {elseif $field == 'Type'}
                                {$types[$item.Type]|default:'-'}
                            {elseif $field == 'Priority'}
                                {$priority[$item.Priority]|default:'-'}
                            {elseif $field == 'Importance'}
                                {$importance[$item.Importance]|default:'-'}
                            {elseif $field == 'CreateDate'}
                                {$item.CreateDate|default:'-'}
                            {elseif $field == 'CompanyID'}
                                {$companies[$item.CompanyID].CompanyName|default:'-'}
                            {elseif $field == 'ProjectID'}
                                {$projects[$item.ProjectID]|default:'-'}
                            {elseif $field == 'AppVersionID'}
                                {$item.DisplayVersion|default:'-'}
                            {elseif $field == 'Title'}
                                <p title="{$item.Title|default:'-'}">{$item.Title|default:'-'}</p>
                            {elseif $field == 'Notes'}
                                <p title="{$item.Notes|default:'-'}">{$item.NotesX|default:'-'}</p>
                            {elseif $field == 'Notes2'}
                                <p title="{$item.Notes2|default:'-'}">{$item.Notes2X|default:'-'}</p>
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.Author}</td>
                    <td class="celulaMenuST">{$types[$item.Type]|default:'-'}</td>
                    <td class="celulaMenuST">{$status[$item.Status]|default:'-'}</td>
                    <td class="celulaMenuST">{$priority[$item.Priority]|default:'-'}</td>
                    <td class="celulaMenuST">{$importance[$item.Importance]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CreateDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.AssignedFullName|default:'-'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest tichet?'}')) window.location.href='./?m=ticketing&o=del&TicketID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($tickets)==1}
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
        window.location.href = './?m=ticketing' +
            '&Type=' + document.getElementById('Type').value +
            '&Status=|' + {foreach from=$status key=key item=item}(document.getElementById('Status_{$key}').checked == true ? '{$key}|' : '') + {/foreach}
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&AssignedPersonID=' + document.getElementById('AssignedPersonID').value +
            '&CategoryID=' + document.getElementById('CategoryID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&AppVersionID=' + document.getElementById('AppVersionID').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>