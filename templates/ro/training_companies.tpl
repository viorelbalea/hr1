{include file="training_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=training&o=companies&DistrictID=' + this.value" style="cod">
        <option value="0">Judet</option>
        {foreach from=$districts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CityID" name="CityID" style="cod">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CompanyDomainID" name="CompanyDomainID" class="dropdown">
        <option value="0">{translate label='Domeniu'}</option>
        {foreach from=$companydomains key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyDomainID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" style="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="CompanyName" {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Nume companie'}</option>
        <option value="CIF" {if $smarty.get.search_for == 'CIF'}selected{/if}>{translate label='CIF'}</option>
    </select>

    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" style="cod">
        <option value="10">10</option>
        <option value="20" {if $smarty.get.res_per_page == 20}selected{/if}>20</option>
        <option value="30" {if $smarty.get.res_per_page == 30}selected{/if}>30</option>
        <option value="50" {if $smarty.get.res_per_page == 50}selected{/if}>50</option>
    </select> <label>inregistrari</label> <input type="button" value="Cauta" onclick="filterList();">
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" value="Export .xls" class="cod exportFile" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
                <li><input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Company&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Nume companie" request_uri=$request_uri order_by=CompanyName asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Company)}
            {foreach from=$personalisedlist.Company key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">Detalii training</span></td>
            <td class="bkdTitleMenu">{orderby label=Judet request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label=Localitate request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label="Domeniu activitate" request_uri=$request_uri order_by=Domain}</td>
            <td class="bkdTitleMenu">{orderby label=CIF request_uri=$request_uri order_by=CIF}</td>
            <td class="bkdTitleMenu">{orderby label=USer request_uri=$request_uri order_by=UserName}</td>
        {/if}
    </tr>
    {foreach from=$companies key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$companies.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=companies&o=edit&CompanyID={$key}" class="blue">{$item.CompanyName}</a></td>
                {if !empty($personalisedlist.Company)}
                    {foreach from=$personalisedlist.Company key=field item=label name=iter1}
                        <td class="celulaMenuST{if $smarty.foreach.iter1.last}DR{/if}">{$item.$field|default:'&nbsp;'}</td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.TrainingNotes|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$item.Domain}</td>
                    <td class="celulaMenuST">{$item.CIF|default:'&nbsp;'}</td>
                    <td class="celulaMenuSTDR">{$item.UserName}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($companies)==1}
        <tr height="30">
            <td colspan="8" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=training&o=companies&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>
