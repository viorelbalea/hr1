{include file="training_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta'}:</label>
    <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=training&DistrictID=' + this.value" class="cod">
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
        <option value="TrainingName" {if $smarty.get.search_for == 'TrainingName'}selected{/if}>{translate label='Denumire Training'}</option>
        <option value="CompanyName" {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Nume companie'}</option>
        <option value="Trainer" {if $smarty.get.search_for == 'Trainer'}selected{/if}>{translate label='Trainer'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">
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
                <li>
                    <input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Training&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Denumire training" request_uri=$request_uri order_by=TrainingName asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Training)}
            {foreach from=$personalisedlist.Training key=field item=label name=iter}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Companie request_uri=$request_uri order_by=CompanyName}</td>
            <td class="bkdTitleMenu">{orderby label=Trainer request_uri=$request_uri order_by=FullName}</td>
            <td class="bkdTitleMenu">{orderby label=Judet request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label=Localitate request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label="Domeniu activitate" request_uri=$request_uri order_by=Domain}</td>
            <td class="bkdTitleMenu">{orderby label="Data inceput" request_uri=$request_uri order_by=StartDate}</td>
            <td class="bkdTitleMenu">{orderby label="Data finala" request_uri=$request_uri order_by=StopDate}</td>
            <td class="bkdTitleMenu">{orderby label=Status request_uri=$request_uri order_by=Status}</td>
            <td class="bkdTitleMenu">{orderby label=User request_uri=$request_uri order_by=UserName}</td>
        {/if}
        <td class="bkdTitleMenu"><b>{translate label='Generare formular'}</b></td>
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$trainings key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$trainings.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=training&o=edit&TrainingID={$key}" class="blue">{$item.TrainingName}</a></td>
                {if !empty($personalisedlist.Training)}
                    {foreach from=$personalisedlist.Training key=field item=label name=iter1}
                        <td class="celulaMenuST{if $smarty.foreach.iter1.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]}

                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.CompanyName}</td>
                    <td class="celulaMenuST">{$item.FullName}</td>
                    <td class="celulaMenuST">{$item.DistrictName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CityName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Domain}</td>
                    <td class="celulaMenuST">{$item.StartDate|date_format:"%d.%m.%Y"}</td>
                    <td class="celulaMenuST">{$item.StopDate|date_format:"%d.%m.%Y"}</td>
                    <td class="celulaMenuST">{$status[$item.Status]}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.UserName}</td>
                {/if}
                <td class="celulaMenuST"><a href="./?m=training&o=evalAssign&TrainingID={$key}&Type=2"><b>{translate label='Trainer'}</b></a> | <a
                            href="./?m=training&o=evalAssign&TrainingID={$key}&Type=1"><b>{translate label='Cursant'}</b></a></td>
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti acest training?'}')) window.location.href='./?m=training&o=del&TrainingID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($trainings)==1}
        <tr height="30">
            <td colspan="12" class="celulaMenuSTDR">{translate label='Nici un training!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="12" valign="top" class="bkdTitleMenu">
    	    <span class="TitleBoxDown">
            {if $trainings.0.page > 1}&laquo; <a href="{$request_uri}" class="white">prima</a>&nbsp;<a href="{$request_uri}&page={math equation="x-y" x=$trainings.0.page y=1}"
                                                                                                       class="white">inapoi</a>{/if}
            pagina {$trainings.0.page} din {$trainings.0.pageNo}
                {if $trainings.0.page < $trainings.0.pageNo}<a href="{$request_uri}&page={math equation="x+y" x=$trainings.0.page y=1}"
                                                               class="white">{translate label='inainte'}</a>&nbsp;
                    <a href="{$request_uri}&page={$trainings.0.pageNo}" class="white">{translate label='ultima'}</a>
                    &raquo;{/if}
            </span>
        </td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=training&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&CompanyDomainID=' + document.getElementById('CompanyDomainID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>
