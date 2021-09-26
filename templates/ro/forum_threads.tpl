{include file="forum_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="StatusID" name="StatusID" class="cod">
        <option value="0">Status</option>
        {foreach from=$threadStatus key=key item=item}
            <option value="{$key}" {if $smarty.get.StatusID==$key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="PersonID" name="PersonID" class="cod">
        <option value="0">{translate label='Persoana'}</option>
        {foreach from=$persons key=key item=item}
            <option value="{$key}" {if $smarty.get.PersonID==$key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="name" {if $smarty.get.search_for == 'name'}selected{/if}>Nume discutie</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='inregistrari'}</label>
    <input type="button" value="Cauta" class="cod"
           onclick="window.location.href = './?m=forum&PersonID=' + document.getElementById('PersonID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label="Discutie" request_uri=$request_uri order_by=ThreadName}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label="Nume" request_uri=$request_uri order_by=FullName}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label="Status" request_uri=$request_uri order_by=Status}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label="Tip" request_uri=$request_uri order_by=Public}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label="Data" request_uri=$request_uri order_by=a.CreateDate}</span></td>

        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Modifica'}</span></td>
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$threads key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$threads.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=forum&o=posts&ThreadID={$item.ThreadID}" class="blue"><b>{$item.ThreadName}</b></a></td>
                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                <td class="celulaMenuST">{$threadStatus[$item.Status]|default:'-'}</td>
                <td class="celulaMenuST">{if $item.Public==1}Public{else}Privat{/if}</td>
                <td class="celulaMenuST">{$item.data}</td>
                <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">{if $item.rw==1}
                        <div id="button_mod"><a href="./?m=forum&o=edit&ThreadID={$key}" title="Modifica"><b>Mod</b></a></div>{else}&nbsp;{/if}</td>
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;">
                    <div id="button_del"><a href="#"
                                            onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta discutie?'}')) window.location.href='./?m=forum&o=del&ThreadID={$key}'; return false;"
                                            title="Sterge"><b>Del</b></a></div></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($threads)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nici o discutie!'}</td>
        </tr>
    {/if}
    <tr>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
    </tr>
</table>    
