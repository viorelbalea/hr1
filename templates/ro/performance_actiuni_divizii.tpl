{include file="performance_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Year" name="Year" class="cod">
        <option value="0">{translate label='Anul'}</option>
        {foreach from=$years key=key item=item}
            <option value="{$item}" {if $item==$smarty.get.Year}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    {if !empty($divisions)}
        <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=performance&o=divizii&DivisionID=' + this.value" class="dropdown">
            <option value="0">{translate label='Cod divizie'}</option>
            {foreach from=$divisions key=key item=item}
                {if $item.Status == 1 && !empty($item.Code)}
                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item.Code}</option>
                {/if}
            {/foreach}
        </select>
        <select id="DivisionID2" name="DivisionID2" onchange="window.location.href = './?m=performance&o=divizii&DivisionID=' + this.value" class="dropdown">
            <option value="0">{translate label='Divizie'}</option>
            {foreach from=$divisions key=key item=item}
                {if $item.Status == 1}
                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item.Division}</option>
                {/if}
            {/foreach}
        </select>
    {else}
        <input type="hidden" name="DivisionID" value="0">
    {/if}
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Nume si Prenum'}e</option>
        <option value="LastName" {if $smarty.get.search_for == 'LastName'}selected{/if}>{translate label='Nume'}</option>
        <option value="FirstName" {if $smarty.get.search_for == 'FirstName'}selected{/if}>{translate label='Prenume'}</option>
        <option value="Goal" {if $smarty.get.search_for == 'Goal'}selected{/if}>{translate label='Actiune'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="10" maxlength="30" class="cod">
    <input type="button" value="Cauta" class="cod"
           onclick="window.location.href = './?m=performance&o=divizii&DivisionID=' + (document.getElementById('DivisionID2').value ? document.getElementById('DivisionID2').value : document.getElementById('DivisionID').value) + '&DepartmentID=' + (document.getElementById('DepartmentID2').value ? document.getElementById('DepartmentID2').value : document.getElementById('DepartmentID').value) + '&StatusID=' + document.getElementById('StatusID').value + '&Year=' + document.getElementById('Year').value + '&DimensionID=' + document.getElementById('DimensionID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <br/>
    <select id="DepartmentID" name="DepartmentID" class="dropdown">
        <option value="0">{translate label='Cod departament'}</option>
        {foreach from=$departments key=key item=item}
            {if $item.Status == 1 && !empty($item.Code)}
                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item.Code}</option>
            {/if}
        {/foreach}
    </select>
    <select id="DepartmentID2" name="DepartmentID2" class="dropdown">
        <option value="0">{translate label='Departament'}</option>
        {foreach from=$departments key=key item=item}
            {if $item.Status == 1}
                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item.Department}</option>
            {/if}
        {/foreach}
    </select>
    <select id="DimensionID" name="DimensionID" class="cod" style="width: 200px;">
        <option value="0">{translate label='Dimeniune'}</option>
        {foreach from=$dimensions key=key item=item}
            {if $item.Status == 1}
                <option value="{$key}" {if $key==$smarty.get.DimensionID}selected{/if}>{$item.Dimension}</option>
            {/if}
        {/foreach}
    </select>
    <select id="StatusID" name="StatusID" class="cod" style="width: 200px;">
        <option value="0">{translate label='Status actiuni'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.StatusID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>inregistrari</label>
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>

<table cellspacing="0" cellpadding="2" width="100%" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label='Divizie' request_uri=$request_uri order_by=DivisionID}</td>
        <td class="bkdTitleMenu">{orderby label='Departament' request_uri=$request_uri order_by=DepartmentID}</td>
        <td class="bkdTitleMenu">{orderby label='Dimensiune' request_uri=$request_uri order_by=DimensionID}</td>
        <td class="bkdTitleMenu">{orderby label='Actiune' request_uri=$request_uri order_by=Goal}</td>
        <td class="bkdTitleMenu">{orderby label='Status' request_uri=$request_uri order_by=StatusID}</td>
        <td class="bkdTitleMenu">{orderby label='Manager' request_uri=$request_uri order_by=FullName}</td>
    </tr>
    {foreach from=$actions key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$actions.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$divisions[$item.DivisionID].Division|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$departments[$item.DepartmentID].Department|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$dimensions[$item.DimensionID].Dimension}</td>
                <td class="celulaMenuST">
                    {if $smarty.session.USER_ID != 1 && ($smarty.session.USER_SETTINGS.9 == 1 || ($smarty.session.USER_SETTINGS.9 == 2 && $item.PersonID != $smarty.session.PERS))}
                        {$item.Goal}
                    {else}
                        <a href="./?m=performance&o=plan&PersonID={$item.PersonID}&PerfID={$item.PerfID}&Year={$item.Year}" class="blue"><b>{$item.Goal}</b></a>
                    {/if}
                </td>
                <td class="celulaMenuST">{$status[$item.StatusID]}</td>
                <td class="celulaMenuSTDR">{$item.FullName}</td>
            </tr>
        {/if}
    {/foreach}
    {if count($actions)==1}
        <tr height="30">
            <td colspan="7" class="celulaMenuSTDR">{translate label='Nici o actiune!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
