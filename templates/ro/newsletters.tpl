{include file="newsletters_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa:'}</label>
    <select id="Type" nume="Type" class="cod">
        <option value="0">{translate label='Tip'}</option>
        {foreach from=$types key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" nume="Status" class="cod">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="title" {if $smarty.get.search_for == 'title'}selected{/if}>{translate label='Titlu'}</option>
        <option value="content" {if $smarty.get.search_for == 'campaign'}selected{/if}>{translate label='Campanie'}</option>
        <option value="content" {if $smarty.get.search_for == 'content'}selected{/if}>{translate label='Continut'}</option>
    </select>
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input type="button" id="apasa" value="Cauta" class="cod"
           onclick="window.location.href = './?m=newsletters&Type='+ document.getElementById('Type').value + '&Status='+document.getElementById('Status').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>inregistrari</label>
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
                <li><input type="button" class="cod printFile" value="Printeaza pagina" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="Printeaza tot" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Campanie request_uri=$request_uri order_by=Campaign asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Titlu request_uri=$request_uri order_by=Title asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Tip request_uri=$request_uri order_by=a.Type}</td>
        <td class="bkdTitleMenu">{orderby label=Status request_uri=$request_uri order_by=a.Status}</td>
        <td class="bkdTitleMenu">{orderby label='Emailuri trimise' request_uri=$request_uri order_by=a.Counter}</td>
        <td class="bkdTitleMenu"><strong>{translate label='Previzualizare'}</strong></td>
        <td class="bkdTitleMenu"><strong>{translate label='Trimitere'}</strong></td>
        <td class="bkdTitleMenu">{orderby label=Data request_uri=$request_uri order_by=a.CreateDate}</td>

        <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>
    </tr>
    {foreach from=$news key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$news.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    {if $item.Type==1}
                        <a href="./?m=newsletters&o=edit-intern&NewsletterID={$key}" class="blue"><b>{$item.Campaign}</b></a>
                    {elseif $item.Type==2}
                        <a href="./?m=newsletters&o=edit-extern&NewsletterID={$key}" class="blue"><b>{$item.Campaign}</b></a>
                    {/if}
                </td>
                <td class="celulaMenuST">{$item.Title}</a></td>
                <td class="celulaMenuST">{$types[$item.Type]|default:'-'}</td>
                <td class="celulaMenuST">{$status[$item.Status]|default:'-'}</td>
                <td class="celulaMenuST">{$item.Counter|default:'0'}</td>
                <td class="celulaMenuST"><a href="./?m=newsletters&o=preview&NewsletterID={$key}" target="_blank" class="blue"><b>{translate label='Previzualizare'}</b></a></td>
                <td class="celulaMenuST"><a href="./cron/newsletter.php" target="_blank" class="blue"><b>{translate label='Trimite'}</b></a></td>
                <td class="celulaMenuST">{$item.data}</td>
                <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta stire?'}')) window.location.href='./?m=newsletters&o=del&NewsletterID={$key}'; return false;"
                                            title="Sterge stire"><b>Del</b></a></div>
                </td>
            </tr>
        {/if}
    {/foreach}
    {if count($news)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nici o stire!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>    
