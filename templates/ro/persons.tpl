{include file="persons_menu.tpl"}
{if $smarty.session.USER_ID == 1 || !empty($smarty.session.USER_RIGHTS2.1.6)}

    {if $smarty.session.THEME !="style6.css" }
        <div class="filter personalFilter">
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td class="label"><label>{translate label='Cauta'}</label></td>
                    {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                        <td class="secondCol">
                            <select id="CompanyID" name="CompanyID" class="dropdown">
                                <option value="0">{translate label='Companie self'}</option>
                                {foreach from=$self key=key item=item}
                                    {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                        <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                                    {/if}
                                {/foreach}
                            </select>
                        </td>
                    {else}
                        <td class="secondCol"><input type="hidden" id="CompanyID" value="0"></td>
                    {/if}
                    <td class="trirdCol">
                        <select id="Lang" name="Lang">
                            <option value="0">{translate label='Limbi straine'}</option>
                            {foreach from=$languages key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.Lang}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <label>{translate label='Afiseaza doar angajatii'}:</label> <input type="checkbox"
                                                                                           onclick="if (this.checked) window.location.href = './?m=persons&Status=2'; else window.location.href = './?m=persons';"
                                                                                           {if !empty($smarty.get.Status) && $smarty.get.Status=='2'}checked{/if}>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td rowspan="6" class="outputZone">
                        <div>
                            <ul>
                                <li class="header"><label>{translate label='Output'}</label></li>
                                <li><input type="button" class="cod exportFile" value="{translate label='Export'} .xls"
                                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'"></li>
                                <li><input type="button" class="cod exportFile" value="{translate label='Export'} .doc"
                                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'"></li>
                                <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'"></li>
                                <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'"></li>
                                <li><input type="button" class="cod options" value="{translate label='Personalizare'}"
                                           onclick="popUp('./?m=settings&o=personalisedlist&list=Personal&type=popup','',250,400)"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="DistrictID" name="DistrictID"
                                onchange="if (this.value>0) window.location.href = './?m=persons&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
                                class="cod" style="width:150px;">
                            <option value="0">{translate label='Judet'}</option>
                            {foreach from=$districts key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    {if !empty($divisions)}
                        <td class="secondCol">
                            <select id="DivisionID" name="DivisionID"
                                    onchange="window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value"
                                    class="dropdown">
                                <option value="0">{translate label='Divizie'}</option>
                                {foreach from=$divisions key=key item=item}
                                    <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                                {/foreach}
                            </select>
                        </td>
                    {else}
                        <td class="secondCol"><input type="hidden" name="DivisionID" id="DivisionID" value="0"></td>
                    {/if}
                    <td class="trirdCol">
                        <select id="JobDictionaryID" name="JobDictionaryID" style="width:200px;">
                            <option value="0">{translate label='Profesia'}</option>
                            {foreach from=$jobtitles key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.JobDictionaryID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <label>{translate label='Data angajarii'}:</label> <input type="text" id="StartDate" name="StartDate" class="formstyle"
                                                                                  value="{$smarty.get.StartDate|date_format:"%d.%m.%Y"|default:''}"
                                                                                  size="10" maxlength="10">
                        {literal}
                            <SCRIPT LANGUAGE="JavaScript">
                                var cal1 = new CalendarPopup();
                                cal1.isShowNavigationDropdowns = true;
                                cal1.setYearSelectStartOffset(10);
                            </SCRIPT>
                        {/literal}
                        <A HREF="#"
                           onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;"
                           NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"/></A>

                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="CityID" name="CityID" class="cod" style="width:200px;">
                            <option value="0">{translate label='Localitate'}</option>
                            {foreach from=$cities key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td class="secondCol">
                        <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                            <option value="0">{translate label='Departament'}</option>
                            {foreach from=$departments key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="ContractType" name="ContractType" style="width:150px;">
                            <option value="0">{translate label='Tip contract'}</option>
                            {foreach from=$contract_type key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.ContractType}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <select id="res_per_page" nume="res_per_page" class="cod">
                            {foreach from=$res_per_pages item=item}
                                <option value="{$item}"
                                        {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                            {/foreach}
                        </select> <label>{translate label='inregistrari'}</label>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Status" name="Status" class="cod" style="width:200px;">
                            <option value="0">{translate label='Status'}</option>
                            {foreach from=$status key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                                {foreach from=$substatus.$key key=key2 item=item2}
                                    <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                                {/foreach}
                            {/foreach}
                        </select>
                    </td>
                    <td class="secondCol">
                        <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                            <option value="0">{translate label='Subdepartament'}</option>
                            {foreach from=$subdepartments key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.SubDepartmentID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="Studies" name="Studies">
                            <option value="0">{translate label='Pregatire'}</option>
                            {foreach from=$studies key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.Studies}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <select id="search_for" nume="search_for" class="cod">
                            <option value="">{translate label='cuvant cheie in'}</option>
                            <option value="LastName"
                                    {if $smarty.get.search_for == 'LastName'}selected{/if}>{translate label='Nume'}</option>
                            <option value="FirstName"
                                    {if $smarty.get.search_for == 'FirstName'}selected{/if}>{translate label='Prenume'}</option>
                            <option value="FullNameBeforeMariage"
                                    {if $smarty.get.search_for == 'FullNameBeforeMariage'}selected{/if}>{translate label='Nume inainte de casatorie'}</option>
                            <option value="CNP"
                                    {if $smarty.get.search_for == 'CNP'}selected{/if}>{translate label='CNP'}</option>
                            <option value="CVQualifRel"
                                    {if $smarty.get.search_for == 'CVQualifRel'}selected{/if}>{translate label='Calificari relevante'}</option>
                            <option value="Function"
                                    {if $smarty.get.search_for == 'Function'}selected{/if}>{translate label='Functie'}</option>
                            <option value="IFunction"
                                    {if $smarty.get.search_for == 'IFunction'}selected{/if}>{translate label='Functie interna'}</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Sex" name="Sex" class="cod">
                            <option value="">{translate label='Sex'}</option>
                            <option value="M" {if $smarty.get.Sex=='M'}selected{/if}>{translate label='Masculin'}</option>
                            <option value="F" {if $smarty.get.Sex=='F'}selected{/if}>{translate label='Feminin'}</option>
                        </select></td>
                    <td class="secondCol">
                        <select id="CostCenterID" name="CostCenterID" class="dropdown">
                            <option value="0">{translate label='Centru de cost'}</option>
                            {foreach from=$costcenter key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="COR" name="COR" class="cod">
                            <option value="">{translate label='COR'}</option>
                            {foreach from=$functions item=item}
                                <option
                                        value="{$item.COR}" {if !empty($smarty.get.COR) && $smarty.get.COR == $item.COR} selected="selected" {/if}>{$item.COR}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <input type="text" id="keyword" name="keyword"
                               value="{$smarty.get.keyword|default:''}" size="38"
                               maxlength="30"
                               class="cod"
                               style="margin:0; width:215px;"
                               onkeypress="if(getKeyUnicode(event)==13) filterList();"/>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Tara" name="Tara">
                            <option value="">{translate label='Tara'}</option>
                            {foreach from=$tari key=key item=item}
                                <option value="{$item}" {if $item==$smarty.get.Tara}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>

                    </td>
                    <td class="secondCol">
                        <select id="HealthCompanyID" name="HealthCompanyID">
                            <option value="">{translate label='Casa de sanatate'}</option>
                            {foreach from=$health_companies key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.HealthCompanyID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="CustomPerson1" name="CustomPerson1">
                            <option value="">{translate label=$customfields.CustomPerson1}</option>
                            {foreach from=$customperson1 key=key item=item}
                                <option value="{$item}" {if $item==$smarty.get.CustomPerson1}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                    <td>
                        <script type="text/javascript">
                            function filterList() {ldelim}
                                window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value +
                                    '&CityID=' + document.getElementById('CityID').value +
                                    '&Status=' + document.getElementById('Status').value +
                                    '&DivisionID=' + document.getElementById('DivisionID').value +
                                    '&CompanyID=' + document.getElementById('CompanyID').value +
                                    '&DepartmentID=' + document.getElementById('DepartmentID').value +
                                    '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
                                    '&CostCenterID=' + document.getElementById('CostCenterID').value +
                                    '&Sex=' + document.getElementById('Sex').value +
                                    '&Lang=' + document.getElementById('Lang').value +
                                    '&JobDictionaryID=' + document.getElementById('JobDictionaryID').value +
                                    '&ContractType=' + document.getElementById('ContractType').value +
                                    '&Studies=' + document.getElementById('Studies').value +
                                    '&Tara=' + document.getElementById('Tara').value +
                                    '&StartDate=' + document.getElementById('StartDate').value +
                                    '&search_for=' + document.getElementById('search_for').value +
                                    '&keyword=' + escape(document.getElementById('keyword').value) +
                                    '&COR=' + escape(document.getElementById('COR').value) +
                                    '&HealthCompanyID=' + document.getElementById('HealthCompanyID').value +
                                    '&CustomPerson1=' + escape(document.getElementById('CustomPerson1').value) +
                                    '&res_per_page=' + document.getElementById('res_per_page').value;
                                {rdelim}
                        </script>
                        <input type="button" value="{translate label='Cauta'}" class="cod" onclick="filterList()">
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    {else}
        <!-- --------------------------------------------------------------------->
        <div class="filter personalFilter">
            <label>{translate label='Cauta'}</label>
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                <select id="CompanyID" name="CompanyID" class="dropdown">
                    <option value="0">{translate label='Companie self'}</option>
                    {foreach from=$self key=key item=item}
                        {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                            <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                        {/if}
                    {/foreach}
                </select>
            {else}
                <input type="hidden" id="CompanyID" value="0">
            {/if}
            <select id="Lang" name="Lang">
                <option value="0">{translate label='Limbi straine'}</option>
                {foreach from=$languages key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.Lang}selected{/if}>{$item}</option>
                {/foreach}
            </select>


            <select id="DistrictID" name="DistrictID"
                    onchange="if (this.value>0) window.location.href = './?m=persons&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
                    class="cod" style="width:150px;">
                <option value="0">{translate label='Judet'}</option>
                {foreach from=$districts key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DistrictID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            {if !empty($divisions)}
                <select id="DivisionID" name="DivisionID"
                        onchange="window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value"
                        class="dropdown">
                    <option value="0">{translate label='Divizie'}</option>
                    {foreach from=$divisions key=key item=item}
                        <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            {else}
                <input type="hidden" name="DivisionID" id="DivisionID" value="0">
            {/if}
            <select id="JobDictionaryID" name="JobDictionaryID" style="width:200px;">
                <option value="0">{translate label='Profesia'}</option>
                {foreach from=$jobtitles key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.JobDictionaryID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <label>{translate label='Data angajarii'}:</label> <input type="text" id="StartDate" name="StartDate" class="formstyle"
                                                                      value="{$smarty.get.StartDate|date_format:"%d.%m.%Y"|default:''}"
                                                                      size="10" maxlength="10">
            {literal}
                <SCRIPT LANGUAGE="JavaScript">
                    var cal1 = new CalendarPopup();
                    cal1.isShowNavigationDropdowns = true;
                    cal1.setYearSelectStartOffset(10);
                </SCRIPT>
            {/literal}
            <A HREF="#"
               onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;"
               NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"/></A>

            <select id="CityID" name="CityID" class="cod" style="width:200px;">
                <option value="0">{translate label='Localitate'}</option>
                {foreach from=$cities key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.CityID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                <option value="0">{translate label='Departament'}</option>
                {foreach from=$departments key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="ContractType" name="ContractType" style="width:150px;">
                <option value="0">{translate label='Tip contract'}</option>
                {foreach from=$contract_type key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.ContractType}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="Status" name="Status" class="cod" style="width:200px;">
                <option value="0">{translate label='Status'}</option>
                {foreach from=$status key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                    {foreach from=$substatus.$key key=key2 item=item2}
                        <option value="{$key}_{$key2}" {if $key|cat:'_'|cat:$key2==$smarty.get.Status}selected{/if}>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;{$item2}</option>
                    {/foreach}
                {/foreach}
            </select>
            <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                <option value="0">{translate label='Subdepartament'}</option>
                {foreach from=$subdepartments key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.SubDepartmentID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="Studies" name="Studies">
                <option value="0">{translate label='Pregatire'}</option>
                {foreach from=$studies key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.Studies}selected{/if}>{$item}</option>
                {/foreach}
            </select>

            <select id="Sex" name="Sex" class="cod">
                <option value="">{translate label='Sex'}</option>
                <option value="M" {if $smarty.get.Sex=='M'}selected{/if}>{translate label='Masculin'}</option>
                <option value="F" {if $smarty.get.Sex=='F'}selected{/if}>{translate label='Feminin'}</option>
            </select>
            <select id="CostCenterID" name="CostCenterID" class="dropdown">
                <option value="0">{translate label='Centru de cost'}</option>
                {foreach from=$costcenter key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="COR" name="COR" class="cod">
                <option value="">{translate label='COR'}</option>
                {foreach from=$functions item=item}
                    <option
                            value="{$item.COR}" {if !empty($smarty.get.COR) && $smarty.get.COR == $item.COR} selected="selected" {/if}>{$item.COR}</option>
                {/foreach}
            </select>
            <select id="Tara" name="Tara">
                <option value="">{translate label='Tara'}</option>
                {foreach from=$tari key=key item=item}
                    <option value="{$item}" {if $item==$smarty.get.Tara}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="HealthCompanyID" name="HealthCompanyID">
                <option value="">{translate label='Casa de sanatate'}</option>
                {foreach from=$health_companies key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.HealthCompanyID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            <select id="CustomPerson1" name="CustomPerson1">
                <option value="">{translate label=$customfields.CustomPerson1}</option>
                {foreach from=$customperson1 key=key item=item}
                    <option value="{$item}" {if $item==$smarty.get.CustomPerson1}selected{/if}>{$item}</option>
                {/foreach}
            </select>

            <select id="search_for" nume="search_for" class="cod">
                <option value="">{translate label='cuvant cheie in'}</option>
                <option value="LastName"
                        {if $smarty.get.search_for == 'LastName'}selected{/if}>{translate label='Nume'}</option>
                <option value="FirstName"
                        {if $smarty.get.search_for == 'FirstName'}selected{/if}>{translate label='Prenume'}</option>
                <option value="FullNameBeforeMariage"
                        {if $smarty.get.search_for == 'FullNameBeforeMariage'}selected{/if}>{translate label='Nume inainte de casatorie'}</option>
                <option value="CNP"
                        {if $smarty.get.search_for == 'CNP'}selected{/if}>{translate label='CNP'}</option>
                <option value="CVQualifRel"
                        {if $smarty.get.search_for == 'CVQualifRel'}selected{/if}>{translate label='Calificari relevante'}</option>
                <option value="Function"
                        {if $smarty.get.search_for == 'Function'}selected{/if}>{translate label='Functie'}</option>
                <option value="IFunction"
                        {if $smarty.get.search_for == 'IFunction'}selected{/if}>{translate label='Functie interna'}</option>
            </select>

            <input type="text" id="keyword" name="keyword"
                   value="{$smarty.get.keyword|default:''}" size="38"
                   maxlength="30"
                   class="cod"
                   style="margin:0; width:215px;"
                   onkeypress="if(getKeyUnicode(event)==13) filterList();"/>

            <script type="text/javascript">
                function filterList() {ldelim}
                    window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value +
                        '&CityID=' + document.getElementById('CityID').value +
                        '&Status=' + document.getElementById('Status').value +
                        '&DivisionID=' + document.getElementById('DivisionID').value +
                        '&CompanyID=' + document.getElementById('CompanyID').value +
                        '&DepartmentID=' + document.getElementById('DepartmentID').value +
                        '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
                        '&CostCenterID=' + document.getElementById('CostCenterID').value +
                        '&Sex=' + document.getElementById('Sex').value +
                        '&Lang=' + document.getElementById('Lang').value +
                        '&JobDictionaryID=' + document.getElementById('JobDictionaryID').value +
                        '&ContractType=' + document.getElementById('ContractType').value +
                        '&Studies=' + document.getElementById('Studies').value +
                        '&Tara=' + document.getElementById('Tara').value +
                        '&StartDate=' + document.getElementById('StartDate').value +
                        '&search_for=' + document.getElementById('search_for').value +
                        '&keyword=' + escape(document.getElementById('keyword').value) +
                        '&COR=' + escape(document.getElementById('COR').value) +
                        '&HealthCompanyID=' + document.getElementById('HealthCompanyID').value +
                        '&CustomPerson1=' + escape(document.getElementById('CustomPerson1').value) +
                        '&res_per_page=' + document.getElementById('res_per_page').value;
                    {rdelim}
            </script>
            <input type="button" value="{translate label='Cauta'}" class="cod" onclick="filterList()">

            <label>{translate label='Afiseaza doar angajatii'}:</label> <input type="checkbox"
                                                                               onclick="if (this.checked) window.location.href = './?m=persons&Status=2'; else window.location.href = './?m=persons';"
                                                                               {if !empty($smarty.get.Status) && $smarty.get.Status=='2'}checked{/if}>
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}"
                            {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select> <label>{translate label='inregistrari'}</label>

            <div class="outputZone outputZoneOne">
                <ul>
                    <li class="header"><label>{translate label='Output'}</label></li>
                    <li><input type="button" class="cod exportFile" value="{translate label='Export'} .xls"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'"></li>
                    <li><input type="button" class="cod exportFile" value="{translate label='Export'} .doc"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'"></li>
                    <li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'"></li>
                    <li><input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'"></li>
                    <li><input type="button" class="cod options" value="{translate label='Personalizare'}"
                               onclick="popUp('./?m=settings&o=personalisedlist&list=Personal&type=popup','',250,400)"></li>
                </ul>
            </div>

        </div>
        <!-- --------------------------------------------------------------------->
    {/if}
{/if}
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Nume request_uri=$request_uri order_by=LastName asc_or_desc=asc}</td>
        <td class="bkdTitleMenu">{orderby label=Prenume request_uri=$request_uri order_by=FirstName}</td>
        {if !empty($personalisedlist.Personal)}
            {foreach from=$personalisedlist.Personal key=field item=label}
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
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td
                        class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=persons&o=edit&PersonID={$key}" class="blue">{$item.LastName}</a>
                </td>
                <td class="celulaMenuST"><a href="./?m=persons&o=edit&PersonID={$key}"
                                            class="blue">{$item.FirstName}</a></td>
                {if !empty($personalisedlist.Personal)}
                    {foreach from=$personalisedlist.Personal key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]}
                            {elseif $field == 'MaritalStatus'}
                                {$maritalstatus[$item.MaritalStatus]}
                            {elseif $field == 'CVStatus'}
                                {$cvstatus[$item.CVStatus]|default:'&nbsp;'}
                            {elseif $field == 'CompanyID'}
                                {$self[$item.CompanyID]|default:'&nbsp;'}
                            {elseif $field == 'DivisionID'}
                                {$divisions[$item.DivisionID]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'SubDepartmentID'}
                                {$subdepartments[$item.SubDepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'CostCenterID'}
                                {$item.CostCenters|default:'&nbsp;'}
                            {elseif $field == 'Studies'}
                                {$studies[$item.Studies]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'ContractType'}
                                {$contract_type[$item.ContractType]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {elseif $field == 'InternalFunction'}
                                {$internal_functions[$item.InternalFunction]|default:'&nbsp;'}
                            {elseif $field == 'RoleID'}
                                {$roles[$item.RoleID]|default:'&nbsp;'}
                            {elseif $field == 'FirmAge'}
                                {$item.prof.years} / {$item.prof.months} / {$item.prof.days}
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
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$status[$item.Status]}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta persoana?'}')) window.location.href='./?m=persons&o=del&PersonID={$key}'; return false;">{translate label='Sterge'}</a>
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
