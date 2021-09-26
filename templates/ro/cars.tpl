{include file="car_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="CarType" name="CarType" class="cod">
        <option value="0">{translate label='Tip vehicul'}</option>
        {foreach from=$cartypes key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CarType}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Brand" name="Brand" class="cod">
        <option value="0">{translate label='Marca'}</option>
        {foreach from=$brands key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Brand}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Fuel" name="Fuel" class="cod">
        <option value="">{translate label='Combustibil'}</option>
        {foreach from=$fuels key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Fuel}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Gear" name="Gear" class="cod">
        <option value="">{translate label='Cutie viteze'}</option>
        {foreach from=$gears key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Gear}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0">{translate label='Status'}</option>
        <option value="1" {if $smarty.get.Status == 1}selected{/if}>{translate label='Activ'}</option>
        <option value="2" {if $smarty.get.Status == 2}selected{/if}>{translate label='Inactiv'}</option>
    </select>
    <select id="Patrimony" name="Patrimony" class="cod">
        <option value="0">{translate label='In patrimoniu'}</option>
        <option value="1" {if $smarty.get.Patrimony==1}selected{/if}>{translate label='Da'}</option>
        <option value="2" {if $smarty.get.Patrimony==2}selected{/if}>{translate label='Nu'}</option>
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="RegNo" {if $smarty.get.search_for == 'RegNo'}selected{/if}>{translate label='Inmatriculare'}</option>
    </select>
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input type="button" id="apasa" value="Cauta" class="cod" onclick="window.location.href = './?m=cars&CarType=' + document.getElementById('CarType').value +
	                                                                                                                         '&Brand=' + document.getElementById('Brand').value + 
																 '&Fuel=' + document.getElementById('Fuel').value + 
																 '&Gear=' + document.getElementById('Gear').value + 
																 '&Status=' + document.getElementById('Status').value + 
																 '&Patrimony=' + document.getElementById('Patrimony').value + 
																 '&search_for=' + document.getElementById('search_for').value + 
																 '&keyword=' + escape(document.getElementById('keyword').value) + 
																 '&res_per_page=' + document.getElementById('res_per_page').value">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='inregistrari'}</label>
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
                <li><input type="button" class="cod printFile" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Car&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Tip vehicul" request_uri=$request_uri order_by=CarType asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Car)}
            {foreach from=$personalisedlist.Car key=field item=label}
                {if in_array($field, array('Resp', 'Status', 'Patrimony'))}
                    <td class="bkdTitleMenu"><span class="TitleBox">{translate label=$label}</span></td>
                {else}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
                {/if}
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Marca" request_uri=$request_uri order_by=Brand}</td>
            <td class="bkdTitleMenu">{orderby label="Model" request_uri=$request_uri order_by=Model}</td>
            <td class="bkdTitleMenu">{orderby label="Inmatriculare" request_uri=$request_uri order_by=RegNo}</td>
            <td class="bkdTitleMenu">{orderby label="Combustibil" request_uri=$request_uri order_by=Fuel}</td>
            <td class="bkdTitleMenu">{orderby label="Cutie viteze" request_uri=$request_uri order_by=Gear}</td>
            <td class="bkdTitleMenu">{orderby label="An fabricatie" request_uri=$request_uri order_by=Year}</td>
            <td class="bkdTitleMenu">{orderby label="Culoare" request_uri=$request_uri order_by=Color}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$cars key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$cars.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=cars&o=edit&CarID={$key}" class="blue">{$cartypes[$item.CarType]}</a></td>
                {if !empty($personalisedlist.Car)}
                    {foreach from=$personalisedlist.Car key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Brand'}
                                {$brands[$item.Brand]|default:'-'}
                            {elseif $field == 'Fuel'}
                                {$fuels[$item.Fuel]|default:'-'}
                            {elseif $field == 'Gear'}
                                {$gears[$item.Gear]|default:'-'}
                            {elseif $field == 'Resp'}
                                {foreach from=$item.Resp item=FullName}{$FullName|default:'-'}<br>{/foreach}
                            {elseif $field == 'Status'}
                                {if $item.Status == 2}{translate label='Inactiv'}{else}{translate label='Activ'}{/if}
                            {elseif $field == 'Patrimony'}
                                {if $item.Status == 2}{translate label='Nu'}{else}{translate label='Da'}{/if}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$brands[$item.Brand]}</td>
                    <td class="celulaMenuST">{$item.Model|default:'-'}</td>
                    <td class="celulaMenuST">{$item.RegNo|default:'-'}</td>
                    <td class="celulaMenuST">{$fuels[$item.Fuel]|default:'-'}</td>
                    <td class="celulaMenuST">{$gears[$item.Gear]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Year|default:'-'}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.Color|default:'-'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta masina?'}')) window.location.href='./?m=cars&o=del&CarID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($cars)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
