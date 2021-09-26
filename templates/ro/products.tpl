{include file="product_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="CompanyID" name="CompanyID" class="cod">
        <option value="0">{translate label='Producator'}</option>
        {foreach from=$companies key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CategoryID" name="CategoryID" class="cod">
        <option value="0">{translate label='Categorie'}</option>
        {foreach from=$categories.0 key=PCatID item=item}
            <option value="{$PCatID}" {if $info.CategoryID==$PCatID}selected{/if}>{$item}</option>
            {if !empty($categories.$PCatID)}
                {foreach from=$categories.$PCatID key=CatID item=item2}
                    <option value="{$CatID}" {if $info.CategoryID==$CatID}selected{/if}>&nbsp;&nbsp;&nbsp;{$item2}</option>
                {/foreach}
            {/if}
        {/foreach}
    </select>
    <select id="Promo" name="Promo" class="cod">
        <option value="all">{translate label='Promotii'}</option>
        <option value="1" {if $smarty.get.Promo|default:'all'=='1'}selected{/if}>{translate label='Da'}</option>
        <option value="0" {if $smarty.get.Promo|default:'all'=='0'}selected{/if}>{translate label='Nu'}</option>
    </select>
    <select id="SecondHand" name="SecondHand" class="cod">
        <option value="all">{translate label='Second Hand'}</option>
        <option value="1" {if $smarty.get.SecondHand|default:'all'=='1'}selected{/if}>{translate label='Da'}</option>
        <option value="0" {if $smarty.get.SecondHand|default:'all'=='0'}selected{/if}>{translate label='Nu'}</option>
    </select>
    <select id="StocOff" name="StocOff" class="cod">
        <option value="all">{translate label='Licidare de stoc'}</option>
        <option value="1" {if $smarty.get.StocOff|default:'all'=='1'}selected{/if}>{translate label='Da'}</option>
        <option value="0" {if $smarty.get.StocOff|default:'all'=='0'}selected{/if}>{translate label='Nu'}</option>
    </select>
    <p></p>
    <label style="color: none;">{translate label='Cauta dupa'}:</label>
    <select id="CustomProduct1" name="CustomProduct1" class="cod">
        <option value="">CustomProduct1</option>
        {foreach from=$customproducts1 key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CustomProduct1}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CustomProduct2" name="CustomProduct2" class="cod">
        <option value="">CustomProduct2</option>
        {foreach from=$customproducts2 key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CustomProduct2}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CustomProduct3" name="CustomProduct3" class="cod">
        <option value="">CustomProduct3</option>
        {foreach from=$customproducts3 key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CustomProduct3}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="Title" {if $smarty.get.search_for == 'Title'}selected{/if}>{translate label='Denumire produs'}</option>
        <option value="Description" {if $smarty.get.search_for == 'Description'}selected{/if}>{translate label='Descriere produs'}</option>
    </select>
    &nbsp;&nbsp;&nbsp;
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input type="button" id="apasa" value="Cauta" class="cod" onclick="window.location.href = './?m=products' +
    													'&CompanyID=' + document.getElementById('CompanyID').value + 
	                                                                                        	'&CategoryID=' + document.getElementById('CategoryID').value + 
													'&Promo=' + document.getElementById('Promo').value + 
													'&SecondHand=' + document.getElementById('SecondHand').value + 
													'&StocOff=' + document.getElementById('StocOff').value + 
													'&CustomProduct1=' + document.getElementById('CustomProduct1').value + 
													'&CustomProduct2=' + document.getElementById('CustomProduct2').value + 
													'&CustomProduct3=' + document.getElementById('CustomProduct3').value + 
													'&search_for=' + document.getElementById('search_for').value + 
													'&keyword=' + escape(document.getElementById('keyword').value) + 
													'&res_per_page=' + document.getElementById('res_per_page').value">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='inregistrari'}</label>
    <p></p>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li><input type="button" class="cod exportFile" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'"></li>
                <li><input type="button" class="cod exportFile" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'"></li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'"></li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'"></li>
                <li><input type="button" class="cod printFile" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Product&type=popup','',250,400)"></li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Denumire produs" request_uri=$request_uri order_by=Title asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Product)}
            {foreach from=$personalisedlist.Product key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Producator" request_uri=$request_uri order_by=CompanyName}</td>
            <td class="bkdTitleMenu">{orderby label="Categorie" request_uri=$request_uri order_by=Name}</td>
            <td class="bkdTitleMenu">{orderby label="Promotie" request_uri=$request_uri order_by=Promo}</td>
            <td class="bkdTitleMenu">{orderby label="Second Hand" request_uri=$request_uri order_by=SecondHand}</td>
            <td class="bkdTitleMenu">{orderby label="Lichidare de stoc" request_uri=$request_uri order_by=StocOff}</td>
            <td class="bkdTitleMenu">{orderby label="CustomProduct1" request_uri=$request_uri order_by=CustomProduct1}</td>
            <td class="bkdTitleMenu">{orderby label="CustomProduct2" request_uri=$request_uri order_by=CustomProduct2}</td>
            <td class="bkdTitleMenu">{orderby label="CustomProduct3" request_uri=$request_uri order_by=CustomProduct3}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$products key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$products.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=products&o=edit&ProductID={$key}" class="blue">{$item.Title}</a></td>
                {if !empty($personalisedlist.Product)}
                    {foreach from=$personalisedlist.Product key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'CompanyID'}
                                {$item.CompanyName}
                            {elseif $field == 'CategoryID'}
                                {$item.Name}
                            {elseif in_array($field, array('Promo', 'SecondHand', 'StocOff'))}
                                {if $item.$field == 1}Da{else}Nu{/if}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$companies[$item.CompanyID]}</td>
                    <td class="celulaMenuST">{$categories[$item.CategoryID]}</td>
                    <td class="celulaMenuST">{if $item.Promo == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{if $item.SecondHand == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{if $item.StocOff == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{$item.CustomProduct1|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CustomProduct2|default:'-'}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.CustomProduct3|default:'-'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest produs?'}')) window.location.href='./?m=products&o=del&ProductID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($products)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
