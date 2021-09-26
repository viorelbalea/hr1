<div class="submeniu">
    {if $smarty.session.USER_ID == 1 || $smarty.session.USER_SETTINGS.11_1 == 1}
        <a href="./?m=pontaj" class="unselected">{translate label='Pontaj'}</a>
        <a href="./?m=pontaj&o=psimple" class="unselected">{translate label='Pontaj simplu'}</a>
        <a href="./?m=pontaj&o=projects" class="selected">{translate label='Proiecte'}</a>
        <a href="./?m=pontaj&o=new_project" class="unselected">{translate label='Adauga proiect'}</a>
    {else}
        <a href="./?m=pontaj" class="selected">{translate label='Pontaj'}</a>
    {/if}
    {if $smarty.session.USER_ID == 1 || !empty($smarty.session.REPORT_RIGHTS.11)}
        <a href="./?m=pontaj&o=reports" class="unselected">{translate label='Rapoarte'}</a>
    {/if}
</div>
<table cellspacing="0" cellpadding="0" width="100%" class="filter">
    <tr>
        <td>
            <table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
                <tr>
                    <td style="padding-left: 4px;" width="75">{translate label='Cauta dupa'}:</td>
                    <td style="padding-left: 2px;" width="100">
                        <select name="ProjectID" id="ProjectID"
                                onchange="window.location.href = './?m=pontaj&o=projects&ProjectID=' + this.value;">
                            <option value="0">{translate label='Cod proiect'}</option>
                            {foreach from=$projects key=key item=item}
                                {if $key > 0}
                                    <option value="{$key}"
                                            {if $key==$smarty.get.ProjectID}selected{/if}>{$item.Code}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                    <td style="padding-left: 6px;" width="100">
                        <select name="ProjectID2"
                                onchange="window.location.href = './?m=pontaj&o=projects&ProjectID=' + this.value;">
                            <option value="0">{translate label='Nume proiect'}</option>
                            {foreach from=$projects key=key item=item}
                                {if $key > 0}
                                    <option value="{$key}"
                                            {if $key==$smarty.get.ProjectID}selected{/if}>{$item.Name}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                    <td style="padding-left: 6px;" width="100">
                        <select name="PhaseID" id="PhaseID">
                            <option value="0">{translate label='Faza'}</option>
                            {foreach from=$phases key=key item=item}
                                {if $key > 0}
                                    <option value="{$key}"
                                            {if (!empty($smarty.get.PhaseID) && $key==$smarty.get.PhaseID) || (empty($smarty.get.PhaseID) && $key == $projects[$smarty.get.ProjectID].Phase)}selected{/if}>{$item}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                    <td style="padding-left: 4px;" width="60"><input type="button" value="Cauta" class="cod"
                                                                     onclick="window.location.href = './?m=pontaj&o=projects&ProjectID=' + document.getElementById('ProjectID').value + '&PhaseID=' + document.getElementById('PhaseID').value + '&res_per_page=' + document.getElementById('res_per_page').value">
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </table>
            <table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
                <tr>
                    <td style="padding-left: 4px;" width="300">&nbsp;</td>
                    <td align="right" style="padding-right: 4px;">
                        <select id="res_per_page" nume="res_per_page" class="cod">
                            {foreach from=$res_per_pages item=item}
                                <option value="{$item}"
                                        {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                            {/foreach}
                        </select> inregistrari&nbsp;&nbsp;&nbsp;
                        <input type="button" class="cod" value="Export .xls"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                        <input type="button" class="cod" value="Export .doc"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                        <input type="button" class="cod" value="{translate label='Printeaza pagina'}"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                        <input type="button" class="cod" value="{translate label='Printeaza tot'}"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                    </td>
                </tr>
            </table>
        </td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label='Denumire proiect' request_uri=$request_uri order_by=Name}</td>
        <td class="bkdTitleMenu">{orderby label='Partener' request_uri=$request_uri order_by=CompanyName}</td>
        <td class="bkdTitleMenu">{orderby label='Cod proiect' request_uri=$request_uri order_by=Code}</td>
        <td class="bkdTitleMenu">{orderby label='Data de inceput' request_uri=$request_uri order_by=a.StartDate}</td>
        <td class="bkdTitleMenu">{orderby label='Data de incheiere' request_uri=$request_uri order_by=a.EndDate}</td>
        <td class="bkdTitleMenu">{orderby label='Statut' request_uri=$request_uri order_by=Type}</td>
        <td class="bkdTitleMenu">{orderby label='Faza' request_uri=$request_uri order_by=Phase}</td>
        <td class="bkdTitleMenu">{orderby label='Data crearii' request_uri=$request_uri order_by=a.CreateDate}</td>
        {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Modifica'}</span></td>{/if}
        {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$projects key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$projects.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=pontaj&o=edit_project&ProjectID={$item.ProjectID}"
                                            class="blue">{$item.Name}</a></td>
                <td class="celulaMenuST">{$item.CompanyName|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.Code}</td>
                <td class="celulaMenuST">{$item.start_date}</td>
                <td class="celulaMenuST">{$item.end_date}</td>
                <td class="celulaMenuST">{$types[$item.Type]}</td>
                <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$phases[$item.Phase]}</td>
                <td class="celulaMenuST">{$item.create_date}</td>
                {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
                    <td class="celulaMenuST" style="text-align: center;">
                    <div id="button_mod"><a href="./?m=pontaj&o=edit_project&ProjectID={$item.ProjectID}"
                                            title="Modifica proiect"><b>Mod</b></a></div></td>{/if}
                {if $smarty.session.USER_ID==1 || $smarty.session.USER_SETTINGS.11_1 == 1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Sunteti sigur(a)?'}')) window.location.href = './?m=pontaj&o=delete_project&ProjectID={$item.ProjectID}'; return false;"
                                            title="Sterge proiect"><b>{translate label='Sterge'}</b></a></div></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($projects)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Niciun proiect!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">
    	    <span class="TitleBoxDown">
            {if $projects.0.page > 1}&laquo; <a
                        href="{$request_uri}&order_by={$smarty.get.order_by}&asc_or_desc={$smarty.get.asc_or_desc}"
                        class="white">{translate label='prima'}</a> <a
                        href="{$request_uri}&order_by={$smarty.get.order_by}&asc_or_desc={$smarty.get.asc_or_desc}&page={math equation="x-y" x=$projects.0.page y=1}"
                        class="white">{translate label='inapoi'}</a>{/if}
                pagina {$projects.0.page} din {$projects.0.pageNo}
                {if $projects.0.page < $projects.0.pageNo}<a
                    href="{$request_uri}&order_by={$smarty.get.order_by}&asc_or_desc={$smarty.get.asc_or_desc}&page={math equation="x+y" x=$projects.0.page y=1}"
                    class="white">inainte</a>&nbsp;

                    <a href="{$request_uri}&order_by={$smarty.get.order_by}&asc_or_desc={$smarty.get.asc_or_desc}&page={$projects.0.pageNo}"
                       class="white">{translate label='ultima'}</a>
                    &raquo;{/if}
            </span>
        </td>
    </tr>
</table>
