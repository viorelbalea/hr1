{include file="job_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta'}</label>

    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=jobs&DistrictID=' + this.value"
            class="cod">
        <option value="0">{translate label='Judet'}</option>
        {foreach from=$districts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CityID" name="CityID" class="cod">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="">{translate label='Status'}</option>
        <option value="activ" {if $smarty.get.Status=='activ'}selected{/if}>{translate label='Activ'}</option>
        <option value="inactiv"
                {if $smarty.get.Status=='inactiv'}selected{/if}>{translate label='Inactiv'}</option>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="JobTitle"
                {if $smarty.get.search_for == 'JobTitle'}selected{/if}>{translate label='JobTitle'}</option>
        <option value="CompanyName"
                {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Companie'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20"
           maxlength="30" class="cod" onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}"
                    {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>{translate label='inregistrari'}</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">


    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .doc"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
                <li>
                    <input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Job&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>

</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Denumire concurs" request_uri=$request_uri order_by=JobTitle asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Companie request_uri=$request_uri order_by=CompanyName}</td>
        {if !empty($personalisedlist.Job)}
            {foreach from=$personalisedlist.Job key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Judet request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label=Localitate request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label="Numar candidati" request_uri=$request_uri order_by=no_persons}</td>
            <td class="bkdTitleMenu">{orderby label="Data de inceput" request_uri=$request_uri order_by=start_date}</td>
            <td class="bkdTitleMenu">{orderby label="Data de sfarsit" request_uri=$request_uri order_by=stop_date}</td>
            <td class="bkdTitleMenu">{orderby label=Status request_uri=$request_uri order_by=status}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$jobs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$jobs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    <a href="./?m=jobs&o=edit&JobID={$key}" class="blue">{$item.JobTitle}</a>
                </td>
                <td class="celulaMenuST">{$item.CompanyName}</td>
                {if !empty($personalisedlist.Job)}
                    {foreach from=$personalisedlist.Job key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'JobDomainID'}
                                {$jobdomains[$item.JobDomainID]}
                            {elseif $field == 'RequiredExperience'}
                                {$experiences[$item.RequiredExperience]|default:'&nbsp;'}
                            {elseif $field == 'JobType'}
                                {$jobtypes[$item.JobType]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionIDRecr'}
                                {$functions_recr[$item.FunctionIDRecr]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.no_persons}</td>
                    <td class="celulaMenuST">{$item.start_date}</td>
                    <td class="celulaMenuST">{$item.stop_date|default:'-'}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.status}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <a href="#"
                       onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest job?'}')) window.location.href='./?m=jobs&o=del&JobID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($jobs)==1}
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
        window.location.href = './?m=jobs&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&Status=' + document.getElementById('Status').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>