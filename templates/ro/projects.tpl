{include file="projects_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select name="ProjectID" id="ProjectID" onchange="window.location.href = './?m=projects&o=projects&ProjectID=' + this.value;">
        <option value="0">{translate label='Cod proiect'}</option>
        {foreach from=$projects key=key item=item}
            {if $key > 0}
                <option value="{$key}" {if $key==$smarty.get.ProjectID}selected{/if}>{$item.Code}</option>
            {/if}
        {/foreach}
    </select>
    <select name="ProjectID2" onchange="window.location.href = './?m=projects&o=projects&ProjectID=' + this.value;">
        <option value="0">{translate label='Nume proiect'}</option>
        {foreach from=$projects key=key item=item}
            {if $key > 0}
                <option value="{$key}" {if $key==$smarty.get.ProjectID}selected{/if}>{$item.Name}</option>
            {/if}
        {/foreach}
    </select>
    <select name="PhaseID" id="PhaseID">
        <option value="0">{translate label='Faza'}</option>
        {foreach from=$phases key=key item=item}
            {if $key > 0}
                <option value="{$key}"
                        {if (!empty($smarty.get.PhaseID) && $key==$smarty.get.PhaseID) || (empty($smarty.get.PhaseID) && $key == $projects[$smarty.get.ProjectID].Phase)}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="Tags" {if $smarty.get.search_for == 'Tags'}selected{/if}>{translate label='Taguri'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select> <label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=projects&o=projects&ProjectID=' + document.getElementById('ProjectID').value +
	                                                                                                                         '&PhaseID=' + document.getElementById('PhaseID').value + 
																 '&search_for=' + document.getElementById('search_for').value + 
																 '&keyword=' + escape(document.getElementById('keyword').value) + 
																 '&res_per_page=' + document.getElementById('res_per_page').value"><br/>
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
                    <input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Denumire proiect" request_uri=$request_uri order_by=Name asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Partener request_uri=$request_uri order_by=CompanyName}</td>
        <td class="bkdTitleMenu">{orderby label="Cod proiect" request_uri=$request_uri order_by=Code}</td>
        <td class="bkdTitleMenu">{orderby label="Data de inceput" request_uri=$request_uri order_by=a.StartDate}</td>
        <td class="bkdTitleMenu">{orderby label="Data de incheiere" request_uri=$request_uri order_by=a.EndDate}</td>
        <td class="bkdTitleMenu">{orderby label="Statut" request_uri=$request_uri order_by=Type}</td>
        <td class="bkdTitleMenu">{orderby label=Faza request_uri=$request_uri order_by=Phase}</td>
        <td class="bkdTitleMenu">{orderby label="Data crearii" request_uri=$request_uri order_by=a.CreateDate}</td>
        {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Modifica'}</span></td>{/if}
        {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$projects key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$projects.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=projects&o=edit_project&ProjectID={$item.ProjectID}" class="blue">{$item.Name}</a></td>
                <td class="celulaMenuST">{$item.CompanyName|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.Code}</td>
                <td class="celulaMenuST">{$item.start_date}</td>
                <td class="celulaMenuST">{$item.end_date}</td>
                <td class="celulaMenuST">{$types[$item.Type]}</td>
                <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$phases[$item.Phase]}</td>
                <td class="celulaMenuST">{$item.create_date}</td>
                {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
                    <td class="celulaMenuST" style="text-align: center;">
                    <div id="button_mod"><a href="./?m=projects&o=edit_project&ProjectID={$item.ProjectID}" title="{translate label='Modifica proiect'}"><b>Mod</b></a></div>
                    </td>{/if}
                {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=projects&o=delete_project&ProjectID={$item.ProjectID}'; return false;"
                                            title="{translate label='Sterge proiect'}"><b>Del</b></a></div></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($projects)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
