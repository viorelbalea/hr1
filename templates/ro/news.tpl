{include file="news_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Type" nume="Type" class="cod">
        <option value="0">{translate label='Tip'}</option>
        {foreach from=$types key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="title" {if $smarty.get.search_for == 'title'}selected{/if}>{translate label='Titlu'}</option>
        <option value="content" {if $smarty.get.search_for == 'content'}selected{/if}>{translate label='Continut'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select> <label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">
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
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Titlu request_uri=$request_uri order_by=Title asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Data request_uri=$request_uri order_by=a.CreateDate}</td>
        <td class="bkdTitleMenu">{orderby label=Tip request_uri=$request_uri order_by=a.Type}</td>
        <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
    </tr>
    {foreach from=$news key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$news.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=news&o=edit&NewsID={$key}" class="blue"><b>{$item.Title}</b></a></td>
                <td class="celulaMenuST">{$item.data}</td>
                <td class="celulaMenuST">{$types[$item.Type]}</td>
                <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta stire?'}')) window.location.href='./?m=news&o=del&NewsID={$key}'; return false;"
                                            title="{translate label='Sterge stire'}"><b>Del</b></a></div>
                </td>
            </tr>
        {/if}
    {/foreach}
    {if count($news)==1}
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
        window.location.href = './?m=news&Type=' + document.getElementById('Type').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>