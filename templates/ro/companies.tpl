{include file="companies_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Judet" name="Judet"
            onchange="if (this.value>0) window.location.href = './?m=companies&Judet=' + this.value"
            class="cod">
        <option value="0">{translate label='Judet'}</option>
        {foreach from=$districts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Judet}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Oras" name="Oras"
            onchange="if (this.value>0) window.location.href = './?m=companies&Judet={$smarty.get.Judet}&Oras='+this.value"
            class="cod">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Oras}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CompanyDomainID" name="CompanyDomainID" class="dropdown">
        <option value="0">{translate label='Domeniu'}</option>
        {foreach from=$companydomains key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyDomainID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="CompanyName"
                {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Nume companie'}</option>
        <option value="CIF" {if $smarty.get.search_for == 'CIF'}selected{/if}>{translate label='CIF'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20"
           maxlength="30" class="cod" onkeypress="if(getKeyUnicode(event)==13) filterList();">

    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}"
                    {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label=' inregistrari'}</label>
    <input type="button" value="{translate label='Cauta'}" class="cod" onclick="filterList();">
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="{translate label='Export'} .xls"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="{translate label='Export'} .doc"
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Company&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Nume companie" request_uri=$request_uri order_by=CompanyName asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Company)}
            {foreach from=$personalisedlist.Company key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Judet request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label=Localitate request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label="Domeniu de activitate" request_uri=$request_uri order_by=Domain}</td>
            <td class="bkdTitleMenu">{orderby label=CIF request_uri=$request_uri order_by=CIF}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$companies key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$companies.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    <a href="./?m=companies&o=edit&CompanyID={$key}" class="blue">{$item.CompanyName}</a>
                </td>
                {if !empty($personalisedlist.Company)}
                    {foreach from=$personalisedlist.Company key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">{$item.$field|default:'&nbsp;'}</td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Domain}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.CIF|default:'&nbsp;'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <a href="#"
                       onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta companie?'}')) window.location.href='./?m=companies&o=del&CompanyID={$key}&back_url=' + escape('{$smarty.server.REQUEST_URI}'); return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($companies)==1}
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
        window.location.href = './?m=companies&Judet=' + document.getElementById('Judet').value + '&Oras=' + document.getElementById('Oras').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>