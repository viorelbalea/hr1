{include file="candidates_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta'}:</label>
    <select id="DistrictID" name="DistrictID"
            onchange="if (this.value>0) window.location.href = './?m=candidates&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
            class="cod" style="width:150px;">
        <option value="0">{translate label='Judet'}</option>
        {foreach from=$districts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CityID" name="CityID" class="cod" style="width:200px;">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="status" nume="status" class="cod">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="LastName" {if $smarty.get.search_for == 'LastName'}selected{/if}>{translate label='Nume'}</option>
        <option value="FirstName" {if $smarty.get.search_for == 'FirstName'}selected{/if}>{translate label='Prenume'}</option>
        <option value="FullNameBeforeMariage" {if $smarty.get.search_for == 'FullNameBeforeMariage'}selected{/if}>{translate label='Nume inainte de casatorie'}</option>
        <option value="CNP" {if $smarty.get.search_for == 'CNP'}selected{/if}>{translate label='CNP'}</option>
        <option value="CVQualifRel" {if $smarty.get.search_for == 'CVQualifRel'}selected{/if}>{translate label='Calificari relevante'}</option>
        <option value="Responsabilities" {if $smarty.get.search_for == 'Responsabilities'}selected{/if}>{translate label='Responsabilitati'}</option>
        <option value="Company" {if $smarty.get.search_for == 'Company'}selected{/if}>{translate label='Companie'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod">
    <select id="PostId" name="PostId" class="cod">
        <option value="0">Post</option>
        {foreach from=$Posts key=key item=item}
            <option value="{$item.PostId}" {if ($item.PostId==$smarty.get.PostId)}selected="selected"{/if}>{$item.PostName}</option>
        {/foreach}
    </select>
    <input type="button" value="{translate label='Cauta'}" class="cod" onclick="window.location.href = './?m=candidates&DistrictID=' + document.getElementById('DistrictID').value +
    	                                                                                   '&CityID=' + document.getElementById('CityID').value + 
    	                                                                                   '&CVStatus=' + document.getElementById('CVStatus').value +
																						   '&Qualify=' + document.getElementById('Qualify').value +
																						   '&CVSource=' + document.getElementById('CVSource').value +
    	                                                                                   '&Sex=' + document.getElementById('Sex').value + 
																						   '&DomainIDStd=' + document.getElementById('DomainIDStd').value +
																						   '&DomainIDProf=' + document.getElementById('DomainIDProf').value +
																						   '&FunctionIDRecr=' + document.getElementById('FunctionIDRecr').value +
																						   '&FunctionIDRecrProf=' + document.getElementById('FunctionIDRecrProf').value +
    	                                                                                   '&Lang=' + document.getElementById('Lang').value + 
    	                                                                                   '&Localitate=' + document.getElementById('Localitate').value + 
    	                                                                                   '&Tara=' + document.getElementById('Tara').value + 
																						   '&Lang=' + document.getElementById('Lang').value + 
																						   '&ReadLevel=' + document.getElementById('ReadLevel').value +
																						   '&WriteLevel=' + document.getElementById('WriteLevel').value +
																						   '&SpeakLevel=' + document.getElementById('SpeakLevel').value +
    	                                                                                   '&search_for=' + document.getElementById('search_for').value + 
    	                                                                                   '&keyword=' + escape(document.getElementById('keyword').value) + 
																						   '&PostId=' +
																						   escape(document.getElementById('PostId').value) +
    	                                                                                   '&res_per_page=' + document.getElementById('res_per_page').value">
    <br/>
    <label>{translate label='Cauta in CV'}:</label>
    <select id="Sex" name="Sex" class="cod">
        <option value="">{translate label='Sex'}</option>
        <option value="M" {if $smarty.get.Sex=='M'}selected{/if}>{translate label='Masculin'}</option>
        <option value="F" {if $smarty.get.Sex=='F'}selected{/if}>{translate label='Feminin'}</option>
    </select>
    <select id="CVStatus" name="CVStatus" class="cod" style="width:150px;">
        <option value="0">{translate label='Status CV'}</option>
        {foreach from=$cvstatus key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CVStatus}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select name="Qualify" id="Qualify" style="width:150px;">
        <option value="0">{translate label='Calificativ'}</option>
        {foreach from=$qualify key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Qualify}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select name="CVSource" id="CVSource">
        <option value="">{translate label='Sursa CV'}</option>
        {foreach from=$cvsource key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CVSource}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Lang" name="Lang">
        <option value="0">{translate label='Limbi straine'}</option>
        {foreach from=$languages key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Lang}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select name="ReadLevel" id="ReadLevel">
        <option value="0">{translate label='Citit'}</option>
        {foreach from=$lang_level key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.ReadLevel}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select name="WriteLevel" id="WriteLevel">
        <option value="0">{translate label='Scris'}</option>
        {foreach from=$lang_level key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.WriteLevel}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select name="SpeakLevel" id="SpeakLevel">
        <option value="0">{translate label='Vorbit'}</option>
        {foreach from=$lang_level key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.SpeakLevel}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <br/><label>{translate label='Experienta'}:</label>
    <select name="DomainIDProf" id="DomainIDProf" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Domeniul'}</option>
        {foreach from=$jobdomains key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.DomainIDProf}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select name="FunctionIDRecrProf" id="FunctionIDRecrProf" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Functia'}</option>
        {foreach from=$functions_recr key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.FunctionIDRecrProf}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select id="Tara" name="Tara">
        <option value="">{translate label='Tara'}</option>
        {foreach from=$tari key=key item=item}
            <option value="{$item}" {if $item==$smarty.get.Tara}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Localitate" name="Localitate">
        <option value="">{translate label='Localitatea'}</option>
        {foreach from=$localitati key=key item=item}
            <option value="{$item}" {if $item==$smarty.get.Localitate}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select name="DomainIDStd" id="DomainIDStd" class="dropdown">
        <option value="0">{translate label='Studii in domeniul'}</option>
        {foreach from=$jobdomains key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.DomainIDStd}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select name="FunctionIDRecr" id="FunctionIDRecr" class="dropdown">
        <option value="0">{translate label='Pozitie interes'}</option>
        {foreach from=$functions_recr key=key2 item=item2}
            <option value="{$key2}" {if $key2==$smarty.get.FunctionIDRecr}selected{/if}>{$item2}</option>
        {/foreach}
    </select>
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select> <label>{translate label='inregistrari'}</label>
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="{translate label='Export'} .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li><input type="button" class="cod exportFile" value="{translate label='Export'} .doc"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
                <li><input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Candidate&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Nume request_uri=$request_uri order_by=LastName asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Prenume request_uri=$request_uri order_by=FirstName}</td>
        {if !empty($personalisedlist.Candidate)}
            {foreach from=$personalisedlist.Candidate key=field item=label}
                <td class="bkdTitleMenu">
                    {if $field == 'AddressName'}
                        <span class="TitleBox">{translate label='Adresa'}</span>
                    {elseif $field == 'CostCenterID'}
                        {orderby label='Centru de cost' request_uri=$request_uri order_by=CostCenters}
                    {else}
                        {orderby label=$label request_uri=$request_uri order_by=$field}
                    {/if}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Judet request_uri=$request_uri order_by=DistrictName}</td>
            <td class="bkdTitleMenu">{orderby label=Oras request_uri=$request_uri order_by=CityName}</td>
            <td class="bkdTitleMenu">{orderby label=Varsta request_uri=$request_uri order_by=varsta}</td>
            <td class="bkdTitleMenu">{orderby label=CNP request_uri=$request_uri order_by=CNP}</td>
            <td class="bkdTitleMenu">{orderby label=Status request_uri=$request_uri order_by=Status}</td>
            <td class="bkdTitleMenu">{orderby label='Status CV' request_uri=$request_uri order_by=CVStatus}</td>
        {/if}
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Evaluari'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Export in personal'}</span></td>
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=candidates&o=edit&PersonID={$key}" class="blue">{$item.LastName}</a></td>
                <td class="celulaMenuST"><a href="./?m=candidates&o=edit&PersonID={$key}" class="blue">{$item.FirstName}</a></td>
                {if !empty($personalisedlist.Candidate)}
                    {foreach from=$personalisedlist.Candidate key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]|default:'&nbsp;'}
                            {elseif $field == 'MaritalStatus'}
                                {$maritalstatus[$item.MaritalStatus]}
                            {elseif $field == 'CVStatus'}
                                {$cvstatus[$item.CVStatus]|default:'&nbsp;'}
                            {elseif $field == 'RoleID'}
                                {$roles[$item.RoleID]|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName}</td>
                    <td class="celulaMenuST">{$item.varsta|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$item.CNP|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$status[$item.Status]|default:'&nbsp;'}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$cvstatus[$item.CVStatus]|default:'&nbsp;'}</td>
                {/if}
                <td class="celulaMenuST"><a href="./?m=candidates-eval&o=forms&PersonID={$key}">{translate label='Vezi evaluari'}</a></td>
                <td class="celulaMenuST">{if empty($item.ImportStatus) && empty($item.ExportedPersonID)}<a
                        href="./?m=candidates&o=export-person&PersonID={$key}">{translate label='Exporta'}</a>{else}<a
                        href="./?m=persons&o=edit&PersonID={$item.ExportedPersonID}">{translate label='Vezi in personal'}</a>{/if}</td>
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta persoana?'}')) window.location.href='./?m=candidates&o=del&PersonID={$key}'; return false;">{translate label='Sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($persons)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
