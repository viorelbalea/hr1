{include file="candidates_eval_menu.tpl"}
<table cellspacing="0" cellpadding="0" width="100%" class="filter" height="40">
    <tr>
        <td style="padding-left: 4px;" width="75" nowrap="nowrap">Cauta dupa:</td>
        <td style="padding-left: 2px;" width="70">
            <select id="DistrictID" name="DistrictID"
                    onchange="if (this.value>0) window.location.href = './?m=colleagues-eval&o=evalPersons&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
                    class="cod">
                <option value="0">{translate label='Judet'}</option>
                {foreach from=$districts key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 4px;" width="90">
            <select id="CityID" name="CityID" class="cod" style="width:150px;">
                <option value="0">{translate label='Localitate'}</option>
                {foreach from=$cities key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 4px;" width="90">
            <select id="Status" name="Status" class="cod">
                <option value="0">{translate label='Status'}</option>
                {foreach from=$status key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                    {foreach from=$substatus.$key key=key2 item=item2}
                        <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                    {/foreach}
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 20px;" width="60">
            <select id="search_for" nume="search_for" class="cod">
                <option value="">{translate label='cuvant cheie in'}</option>
                <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Nume si Prenume'}</option>
                <option value="LastName" {if $smarty.get.search_for == 'LastName'}selected{/if}>{translate label='Nume'}</option>
                <option value="FirstName" {if $smarty.get.search_for == 'FirstName'}selected{/if}>{translate label='Prenume'}</option>
                <option value="CNP" {if $smarty.get.search_for == 'CNP'}selected{/if}>{translate label='CNP'}</option>
            </select>
        </td>
        <td style="padding-left: 4px;" width="60"><input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"></td>
        <td style="padding-left: 4px;" width="60"><input type="button" value="{translate label='Cauta'}" class="cod"
                                                         onclick="window.location.href = './?m=colleagues-eval&o=evalPersons&DistrictID=' + document.getElementById('DistrictID').value + '&CityID=' + document.getElementById('CityID').value + '&Status=' + document.getElementById('Status').value + '&CompanyID=' + document.getElementById('CompanyID').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&CostCenterID=' + document.getElementById('CostCenterID').value + '&Sex=' + document.getElementById('Sex').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="filter" height="40">
    <tr>
        <td style="padding-left: 4px;" width="75">&nbsp;</td>
        <td style="padding-left: 4px;" width="70">
            <select id="CompanyID" name="CompanyID" class="dropdown">
                <option value="0">{translate label='Companie self'}</option>
                {foreach from=$self key=key item=item}
                    {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                        <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                    {/if}
                {/foreach}
            </select>
        </td>
        {if !empty($divisions)}
            <td style="padding-left: 2px;" width="75">
                <select id="DivisionID" name="DivisionID"
                        onchange="window.location.href = './?m=colleagues-eval&o=evalPersons&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value"
                        class="dropdown">
                    <option value="0">{translate label='Divizie'}</option>
                    {foreach from=$divisions key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
        {else}
            <td style="padding-left: 4px;" width="75"><input type="hidden" name="DivisionID" value="0"></td>
        {/if}
        <td style="padding-left: 4px;" width="70">
            <select id="DepartmentID" name="DepartmentID" class="dropdown">
                <option value="0">{translate label='Departament'}</option>
                {foreach from=$departments key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 4px;" width="70">
            <select id="CostCenterID" name="CostCenterID" class="dropdown">
                <option value="0">{translate label='Centru de cost'}</option>
                {foreach from=$costcenter key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" class="filter" height="40">
    <tr>
        <td width="75">&nbsp;</td>
        <td style="padding-left: 4px;" width="50">
            <select id="Sex" name="Sex" class="cod">
                <option value="">Sex</option>
                <option value="M" {if $smarty.get.Sex=='M'}selected{/if}>{translate label='Masculin'}</option>
                <option value="F" {if $smarty.get.Sex=='F'}selected{/if}>{translate label='Feminin'}</option>
            </select>
        </td>
        <td style="padding-left: 50px;">
            {translate label='Afiseaza doar angajatii'}: <input type="checkbox"
                                                                onclick="if (this.checked) window.location.href = './?m=colleagues-eval&o=evalPersons&Status=2'; else window.location.href = './?m=colleagues-eval&o=evalPersons';"
                                                                {if !empty($smarty.get.Status) && $smarty.get.Status=='2'}checked{/if}>
        </td>
        <td style="padding-left: 5px;">
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}

            </select><label>{translate label='inregistrari'}</label>
        </td>
        <td align="right" style="padding-right: 4px;">
            <input type="button" class="cod" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
            <input type="button" class="cod" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
            <input type="button" class="cod" value="Printeaza pagina" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
            <input type="button" class="cod" value="Printeaza tot" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
            <input type="button" class="cod" value="{translate label='Personalizare'}" onclick="popUp('./?m=settings&o=personalisedlist&list=Eval&type=popup','',250,400)">
        </td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label='Nume' request_uri=$request_uri order_by=FullName}</td>
        {if !empty($personalisedlist.Eval)}
            {foreach from=$personalisedlist.Eval key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label='Judet' request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label='Oras' request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label='Email' request_uri=$request_uri order_by=Email}</td>
            <td class="bkdTitleMenu">{orderby label='Mobil' request_uri=$request_uri order_by=Mobile}</td>
        {/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=colleagues-eval&o=forms&PersonID={$item.PersonID}" class="blue"><b>{$item.FullName}</b></a></td>
                {if !empty($personalisedlist.Eval)}
                    {foreach from=$personalisedlist.Eval key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">
                            {if $field == 'DivisionID'}
                                {$divisions[$item.DivisionID]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'CostCenterID'}
                                {$costcenter[$item.CostCenterID]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName}</td>
                    <td class="celulaMenuST">{$item.Email|default:'&nbsp;'}</td>
                    <td class="celulaMenuSTDR">{$item.Mobile|default:'&nbsp;'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($persons)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nici o persoana!'}</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
