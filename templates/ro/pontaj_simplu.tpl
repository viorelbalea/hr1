{include file="pontaj_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta'}:</label>
    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=pontaj&o=psimple&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
            class="cod">
        <option value="0">{translate label='Judet'}</option>
        {foreach from=$districts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CityID" name="CityID" class="cod" style="width:200px;">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod" style="width:200px;">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
            {foreach from=$substatus.$key key=key2 item=item2}
                <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
            {/foreach}
        {/foreach}
    </select>
    <select name="select" class="cod" id="search_for" nume="search_for">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="LastName" {if $smarty.get.search_for == 'lastname'}selected{/if}>{translate label='Nume'}</option>
        <option value="FirstName" {if $smarty.get.search_for == 'firstname'}selected{/if}>{translate label='Prenume'}</option>
        <option value="CNP" {if $smarty.get.search_for == 'cnp'}selected{/if}>{translate label='CNP'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>
    {if !empty($divisions)}
        <select id="DivisionID" name="DivisionID"
                onchange="window.location.href = './?m=pontaj&o=psimple&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value" class="dropdown">
            <option value="0">{translate label='Divizie'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" name="DivisionID" value="0">
    {/if}
    <select id="DepartmentID" name="DepartmentID" class="dropdown">
        <option value="0">{translate label='Departament'}</option>
        {foreach from=$departments key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CostCenterID" name="CostCenterID" class="dropdown">
        <option value="0">{translate label='Centru de cost'}</option>
        {foreach from=$costcenter key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Sex" name="Sex" class="cod">
        <option value="">Sex</option>
        <option value="M" {if $smarty.get.Sex=='M'}selected{/if}>{translate label='Masculin'}</option>
        <option value="F" {if $smarty.get.Sex=='F'}selected{/if}>{translate label='Feminin'}</option>
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
        <td class="bkdTitleMenu">{orderby label=Persoane request_uri=$request_uri order_by=FullName asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Pontaj)}
            {foreach from=$personalisedlist.Pontaj key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Email request_uri=$request_uri order_by=Email}</td>
            <td class="bkdTitleMenu">{orderby label=Telefon request_uri=$request_uri order_by=Phone}</td>
        {/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST" width="30">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=pontaj&o=psimple_day&PersonID={$item.PersonID}" class="blue">{$item.FullName}</a></td>
                {if !empty($personalisedlist.Pontaj)}
                    {foreach from=$personalisedlist.Pontaj key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">
                            {if $field == 'DivisionID'}
                                {$divisions[$item.DivisionID]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'CostCenterID'}
                                {$costcenter[$item.CostCenterID]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.Email|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$item.Phone|default:'&nbsp;'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($persons)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nici o persoana!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=pontaj&o=psimple&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&Status=' + document.getElementById('Status').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&CostCenterID=' + document.getElementById('CostCenterID').value + '&Sex=' + document.getElementById('Sex').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>