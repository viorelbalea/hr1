<div class="submeniu">
    <a href="./?m=eval&o=forms" class="unselected">{translate label='Lista evaluari'}</a>
    {if $smarty.session.USER_ID == 1 || $smarty.session.ACCESSEVAL == 1 || $smarty.session.ACCESSEVAL == 3}
        <a href="./?m=eval&o=formsDraft" class="selected">{translate label='Formulare evaluare'}</a>
        <a href="./?m=eval&o=evalDraft&action=new" class="unselected">{translate label='Adauga formular evaluare'}</a>
        <a href="./?m=eval&o=evalAssign" class="unselected">{translate label='Asignare evaluare'}</a>
    {/if}
    <a href="./?m=eval&o=evalPersons" class="unselected">{translate label='Evaluari angajati'}</a>
</div>
<div class="filter">
    <label>{translate label='Cauta dupa:'}</label>
    <select id="PersonID" name="PersonID" class="cod">
        <option value="0">{translate label='Angajat'}  </option>
        {foreach from=$evalPersonsFormsDraft key=key item=item}
            <option value="{$item.PersonID}"
                    {if $item.PersonID==$smarty.get.PersonID}selected{/if}>{$item.FullName}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="FormName"
                {if $smarty.get.search_for == 'FormName'}selected{/if}>{translate label='Nume formular'}</option>
    </select>
    <input type="text" id="keyword" name="keyword"
           value="{$smarty.get.keyword|default:''}" size="20"
           maxlength="30" class="cod">
    <input type="button" value="Cauta" class="cod"
           onclick="window.location.href = './?m=eval&o=formsDraft&FunctionID=' + document.getElementById('FunctionID').value + '&PersonID=' + document.getElementById('PersonID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}"
                    {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>inregistrari</label>
    <br/>
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
                    <input type="button" class="cod printFile" value="Printeaza pagina"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="Printeaza tot"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label='Nume formular' request_uri=$request_uri order_by=FormName}</td>
        <td class="bkdTitleMenu">{orderby label='Data creare' request_uri=$request_uri order_by=CreateDate}</td>
        <td class="bkdTitleMenu">{orderby label='Numar asignari' request_uri=$request_uri order_by=AssignedForms}</td>
        {if $smarty.session.USER_ID==1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Clonare'}</span></td>{/if}
        {if $smarty.session.USER_ID==1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$evalFormsDraft key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$evalFormsDraft.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a
                            href="./?m=eval&o=evalDraft&EvalFormDraftID={$item.EvalFormDraftID}&action=edit"
                            class="blue"><b>{$item.FormName}</b></a></td>
                <td class="celulaMenuST">{$item.CreateDate}</td>
                <td class="celulaMenuST">{$item.AssignedForms}</td>
                {if $smarty.session.USER_ID==1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
                    <td class="celulaMenuST"><a class="blue" href="#"
                                                onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa creezi un duplicat al acestui formular?'}'))window.location.href='./?m=eval&o=evalDraft&EvalFormDraftID={$key}&action=clone'; return false;">{translate label='Cloneaza formular'}</a>
                    </td>
                {/if}
                {if $smarty.session.USER_ID==1 || $smarty.session.ACCESSEVAL == 2 || $smarty.session.ACCESSEVAL == 3}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest formular?'}')) window.location.href='./?m=eval&o=evalDraft&EvalFormDraftID={$key}&action=delete'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}

    {if count($evalFormsDraft)<1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nici un formular de evaluare!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
