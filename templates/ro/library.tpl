{include file="library_menu.tpl"}

<div class="filter">
    <select id="CatID" name="CatID" class="cod">
        <option value="0">Categorie</option>
        {foreach from=$cats.0 key=key item=item}
            {if $smarty.session.USER_ID==1 || isset($categories.$key)}
                <option value="{$key}" {if $smarty.get.CatID==$key}selected{/if}>{$item}</option>
                {if is_array($cats.$key)}
                    {foreach from=$cats.$key key=key2 item=item2}
                        <option value="{$key2}" {if $smarty.get.CatID==$key2}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                    {/foreach}
                {/if}
            {/if}
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">cuvant cheie in</option>
        <option value="name" {if $smarty.get.search_for == 'name'}selected{/if}>{translate label='Nume si descriere document'}</option>
        <option value="code" {if $smarty.get.search_for == 'code'}selected{/if}>{translate label='Cod document'}</option>
        <option value="tags" {if $smarty.get.search_for == 'tags'}selected{/if}>{translate label='Taguri'}</option>
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
                <ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Document request_uri=$request_uri order_by=DocName asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Categorie request_uri=$request_uri order_by=CatName}</td>
        <td class="bkdTitleMenu">{orderby label="Cod document" request_uri=$request_uri order_by=DocCode}</td>
        <td class="bkdTitleMenu">{orderby label=Versiune request_uri=$request_uri order_by=DocVersion}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Descriere'}</span></td>
        <td class="bkdTitleMenu">{orderby label=Data request_uri=$request_uri order_by=a.CreateDate}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Modifica'}</span></td>
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$docs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$docs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="{$item.curr_filename}" title="{translate label='Acceseaza fisierul'} {$item.FileName}"><b>{$item.DocName}</b></a></td>
                <td class="celulaMenuST">{if !empty($item.PCatName)}{$item.PCatName} / {/if}{$item.CatName}</td>
                <td class="celulaMenuST">{$item.DocCode}</td>
                <td class="celulaMenuST">{$item.DocVersion|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.DocDescr|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.data}</td>
                <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">{if $item.rw==1}
                        <div id="button_mod"><a href="./?m=library&o=edit&DocID={$key}" title="{translate label='Modifica'}"><b>Mod</b></a></div>{else}-{/if}</td>
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest document?'}')) window.location.href='./?m=library&o=del&DocID={$key}'; return false;"
                                            title="{translate label='Sterge fisierul'} {$item.FileName}"><b>Del</b></a></div></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($docs)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><label>{translate label='Nu sunt date'}!</label></td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=library&CatID=' + document.getElementById('CatID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>