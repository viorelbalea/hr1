{include file="contract_menu.tpl"}
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="contract_submenu.tpl"}</span>
        </td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="0" width="100%" border="0" class="filter">
    <tr height="40">
        <td style="padding-left: 4px;" width="75">{translate label='Cauta dupa'}:</td>
        <td width="60">
            <select id="search_for" nume="search_for" class="cod">
                <option value="">cuvant cheie in</option>
                <option value="name" {if $smarty.get.search_for == 'name'}selected{/if}>{translate label='Nume si descriere document'}</option>
                <option value="code" {if $smarty.get.search_for == 'code'}selected{/if}>{translate label='Cod document'}</option>
                <option value="tags" {if $smarty.get.search_for == 'tags'}selected{/if}>{translate label='Taguri'}</option>
            </select>
        </td>
        <td style="padding-left: 4px;" width="60"><input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"></td>
        <td style="padding-left: 4px;" width="60"><input type="button" value="Cauta" class="cod"
                                                         onclick="window.location.href = './?m=contract&o=docs&ContractID={$smarty.get.ContractID}&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
        </td>
        <td>&nbsp;</td>
        <td align="right" style="padding-right: 4px;">
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select> {translate label='inregistrari'}&nbsp;&nbsp;&nbsp;
            <input type="button" class="cod" value="Export" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action2=export'">
            <input type="button" class="cod" value="{translate label='Printeaza pagina'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action2=print_page'">
            <input type="button" class="cod" value="{translate label='Printeaza tot'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action2=print_all'">
        </td>
    </tr>
    <tr height="40">
        <td colspan="6" style="padding-left: 4px;"><input type="button" value="Adauga document"
                                                          onclick="window.location.href = './?m=contract&o=docs&ContractID={$smarty.get.ContractID}&action=new';"></td>
    </tr>
</table>
</br>
<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume document'}</span>&nbsp;<a href="{$request_uri}&order_by=DocName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=DocName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Cod document'}</span>&nbsp;<a href="{$request_uri}&order_by=DocCode&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=DocCode&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Descriere'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data'}</span>&nbsp;<a href="{$request_uri}&order_by=a.CreateDate&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=a.CreateDate&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu" style="text-align: center;"><span class="TitleBox">{translate label='Modifica'}</span></td>
        <td class="bkdTitleMenu" style="text-align: center;"><span class="TitleBox">{translate label='Sterge'}</span></td>
    </tr>
    {foreach from=$docs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=1}</td>
                <td class="celulaMenuST"><a href="{$item.curr_filename}" title="{translate label='Acceseaza fisierul'} {$item.FileName}" target="_blank"><b>{$item.DocName}</b></a>
                </td>
                <td class="celulaMenuST">{$item.DocCode}</td>
                <td class="celulaMenuST">{$item.DocDescr|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.data}</td>
                <td class="celulaMenuST" style="text-align: center;"{if $item.rw==1}
                <div id="button_mod"><a href="./?m=contract&o=docs&ContractID={$smarty.get.ContractID}&action=edit&DocID={$key}" title="{translate label='Modifica'}"><b>Mod</b></a>
                </div>{else}&nbsp;{/if}</td>
                {if $item.rw==1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest document?'}')) window.location.href='./?m=contract&o=docs&ContractID={$smarty.get.ContractID}&action=del&DocID={$key}'; return false;"
                                            title="{translate label='Sterge fisierul'} {$item.FileName}"><b>Del</b></a></div></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($docs)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">
    	    <span class="TitleBoxDown">
            {if $docs.0.page > 1}&laquo; <a href="{$request_uri}&page={math equation="x-y" x=$docs.0.page y=1}" class="white">{translate label='inapoi'}</a>{/if}
            pagina {$docs.0.page} din {$docs.0.pageNo}
                {if $docs.0.page < $docs.0.pageNo}<a href="{$request_uri}&page={math equation="x+y" x=$docs.0.page y=1}" class="white">{translate label='inainte '}</a> &raquo;{/if}
            </span>
        </td>
    </tr>
</table>    
