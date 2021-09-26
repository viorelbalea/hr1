{include file="companies_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=companies&o=contacts&DistrictID=' + this.value"
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
    <label>inregistrari</label>
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
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:7px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume Companie'}</span>&nbsp;
            <a href="{$request_uri}&o=contacts&order_by=CompanyName&asc_or_desc=asc">
                <img src="./images/s_asc.png" border="0">
            </a>
            &nbsp;
            <a href="{$request_uri}&o=contacts&order_by=CompanyName&asc_or_desc=desc">
                <img src="./images/s_desc.png" border="0">
            </a>
        </td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Nume'}</span></td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Telefon'}</span></td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Email'}</span></td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Functie'}</span></td>
    </tr>
    {foreach from=$companies key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
            <td class="celulaMenuST"
                rowspan="{if $item.Contacts|@count >0}{$item.Contacts|@count}{else}1{/if}">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$companies.0.page t=$res_per_page}</td>
            <td class="celulaMenuST" rowspan="{if $item.Contacts|@count >0}{$item.Contacts|@count}{else}1{/if}">
                <a href="./?m=companies&o=edit&CompanyID={$item.CompanyID}" class="blue">{$item.CompanyName}</a>
            </td>
            {if !empty($item.Contacts)}
                {foreach from=$item.Contacts item=c name=iter2}
                    {if $smarty.foreach.iter2.iteration > 1}
                        </tr><tr>
                    {/if}
                    <td width="130" class="celulaMenuST">{$c.ContactName|default:'-'}</td>
                    <td width="100" class="celulaMenuST">{$c.ContactPhone|default:'-'}</td>
                    <td width="220" class="celulaMenuST">{$c.ContactEmail|default:'-'}</td>
                    <td width="150" class="celulaMenuSTDR">{$c.ContactFunction|default:'-'}</td>
                {/foreach}
            {else}
                <td width="130" class="celulaMenuST">-</td>
                <td width="100" class="celulaMenuST">-</td>
                <td width="220" class="celulaMenuST">-</td>
                <td width="150" class="celulaMenuSTDR">-</td>
            {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($companies)<1}
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
        window.location.href = './?m=companies&o=contacts&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value;
        {rdelim}
</script>
