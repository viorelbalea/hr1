{include file="pontaj_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta'}:</label>
    <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=pontaj&o=pdetail' +
	                                                                            	    '&DistrictID=' + document.getElementById('DistrictID').value + 
	                                                                                    '&CityID=' + document.getElementById('CityID').value + 
											    '&Status=' + document.getElementById('Status').value + 
											    '&CompanyID=' + document.getElementById('CompanyID').value + 
											    '&DivisionID=' + document.getElementById('DivisionID').value + 
											    '&DepartmentID=' + document.getElementById('DepartmentID').value + 
											    '&CostCenterID=' + document.getElementById('CostCenterID').value + 
											    '&search_for=' + document.getElementById('search_for').value + 
											    '&keyword=' + escape(document.getElementById('keyword').value) + 
											    '&StartDate=' + escape(document.getElementById('StartDate').value) + 
											    '&EndDate=' + escape(document.getElementById('EndDate').value) + 
											    '&res_per_page=' + document.getElementById('res_per_page').value" class="cod">
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
    <select id="Status" name="Status" class="cod" style="width:200px;">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status|default:2}selected{/if}>{$item}</option>
        {/foreach}
        <option value="2_6_5" {if '2_6_5'==$smarty.get.Status|default:2}selected{/if}>Angajat + Plecat + Disp.</option>
    </select>
    <span>
            <select name="select" class="cod" id="search_for" nume="search_for">
              <option value="">{translate label='cuvant cheie in'}</option>
              <option value="LastName" {if $smarty.get.search_for == 'lastname'}selected{/if}>{translate label='Nume'}</option>
              <option value="FirstName" {if $smarty.get.search_for == 'firstname'}selected{/if}>{translate label='Prenume'}</option>
              <option value="CNP" {if $smarty.get.search_for == 'cnp'}selected{/if}>{translate label='CNP'}</option>
            </select>
          </span>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
           onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <input type="button" value="Cauta" class="cod" onclick="filterList();"><br/>
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
    {if !empty($divisions)}
        <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=pontaj&o=pdetail' +
	                                                                        	'&DistrictID=' + document.getElementById('DistrictID').value + 
	                                                                                '&CityID=' + document.getElementById('CityID').value + 
											'&Status=' + document.getElementById('Status').value + 
											'&CompanyID=' + document.getElementById('CompanyID').value + 
											'&DivisionID=' + document.getElementById('DivisionID').value + 
											'&DepartmentID=' + document.getElementById('DepartmentID').value + 
											'&CostCenterID=' + document.getElementById('CostCenterID').value + 
											'&search_for=' + document.getElementById('search_for').value + 
											'&keyword=' + escape(document.getElementById('keyword').value) + 
											'&StartDate=' + escape(document.getElementById('StartDate').value) + 
											'&EndDate=' + escape(document.getElementById('EndDate').value) + 
											'&res_per_page=' + document.getElementById('res_per_page').value" class="dropdown">
            <option value="0">{translate label='Divizie'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" name="DivisionID" id="DivisionID" value="0">
    {/if}
    <select id="DepartmentID" name="DepartmentID" class="dropdown">
        <option value="0">{translate label='Departament'}</option>
        {foreach from=$departments key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CostCenterID" name="CostCenterID" class="dropdown">
        <option value="0">{translate label='Centru de cost'}</option>
        {foreach from=$costcenter key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CostCenterID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='Perioada intre '}</label>
    <input type="text" name="StartDate" id="StartDate" class="formstyle"
           value="{if !empty($smarty.get.StartDate)}{$smarty.get.StartDate|date_format:'%d.%m.%Y'}{else}{$smarty.now|date_format:'01-%m-%Y'}{/if}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
    <label>si</label>
    <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal2 = new CalendarPopup();
        cal2.isShowNavigationDropdowns = true;
        cal2.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>{translate label='inregistrari'}</label>
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

{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <div id="layer_p" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Activitate'}</h3>
        <div id="layer_p_content" class="layerContent"></div>
    </div>
    <div id="layer_p_x" class="butonX" style="display: none" title="Inchide"
         onclick="document.getElementById('layer_p').style.display = 'none'; document.getElementById('layer_p_x').style.display = 'none'; window.location.reload();">x
    </div>
    <div id="layer_s" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Raport perioada'}</h3>
        <div id="layer_s_content" class="layerContent"></div>
    </div>
    <div id="layer_s_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_s').style.display = 'none'; document.getElementById('layer_s_x').style.display = 'none'; window.location.reload();">x
    </div>
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table width="100%" cellspacing="0" cellpadding="4" class="grid">
            <tr valign="bottom">
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuST">&nbsp;</td>
                {assign var="ZL" value="0"}
                {foreach from=$cal key=data item=wday name=iter}
                    <td class="celulaMenuST"
                        style="text-align: center;{if isset($legal.$data)}background-color:#99CCFF;{elseif $wday=='D' || $wday=='S'} background-color: #fcde63;{/if}">
                        <b>{$data|date_format:'%e'}</b></td>
                {/foreach}
                {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.11.4.1 == 2}
                    <td class="celulaMenuSTDR" style="text-align:center"><input type="submit" name="valid" value="{translate label='Validare'}"></td>
                {/if}
            </tr>
            <tr>
                <td class="celulaMenuST" width="20"><b>#</b></td>
                <td class="celulaMenuST"><b>{translate label='Nume prenume'}</b></td>
                {foreach from=$cal key=data item=wday}
                    <td class="celulaMenuST"
                        style="text-align: center;{if isset($pdisplacements.$persid[$data])}background-color:#68DE95{elseif isset($legal.$data)}background-color:#99CCFF;{elseif $wday=='D' || $wday=='S'} background-color: #fcde63;{/if}">
                        <b>{$wday}</b></td>
                {/foreach}
                {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.11.4.1 == 2}
                    <td class="celulaMenuSTDR" style="text-align:center"><a href="#" onclick="checkAll(); return false;">check</a> | <a href="#"
                                                                                                                                        onclick="uncheckAll(); return false;">uncheck</a>
                    </td>
                {/if}
            </tr>
            {foreach from=$persons key=persid item=item name=iter}
            {if $persid > 0}
            <tr bgcolor="#ffffff">
                <td class="celulaMenuST" stylex="border-top: 1px solid #000000;">{$smarty.foreach.iter.iteration-1}</td>
                <td class="celulaMenuST"><a href="#" onclick="getStat({$persid}, '{$smarty.get.StartDate}', '{$smarty.get.EndDate}'); return false;"
                                            title="{translate label='raport pontaj'}">{$item.FullName}</a></td>
                {foreach from=$cal key=data item=wday}
                    <td class="celulaMenuST"
                        style="text-align: center;{if isset($pdisplacements.$persid[$data])}background-color:#68DE95{elseif isset($legal.$data)}background-color:#99CCFF;{elseif $wday=='D' || $wday=='S'} background-color: #fcde63;{/if}">
                        {if $data <= $smarty.now|date_format:'%Y-%m-%d'}
                            <a href="#" onclick="getAct({$persid}, '{$data}'); return false;"
                               title="{translate label='pontaj pentru'} {$data|date_format:'%d.%m.%Y'}">{$item.Data.$data|default:0}</a>
                        {else}
                            {$item.Data.$data|default:0}
                        {/if}
                    </td>
                {/foreach}
                {if $smarty.session.USER_ID == 1 || $smarty.session.USER_RIGHTS3.11.4.1 == 2}
                    <td class="celulaMenuSTDR" style="text-align:center"><input type="checkbox" id="pvalid_{$persid}" name="pvalid[{$persid}]" value="{$item.CompanyID}"></td>
                {/if}
            <tr>
                {/if}
                {/foreach}
                {if $persons|@count <= 1}
            <tr>
                <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
            </tr>
            {/if}
        </table>
    </form>
{literal}
    <script type="text/javascript">
        function getAct(persid, data) {
            showInfo('./?m=pontaj&o=pdetail_act&PersonID=' + persid + '&StartDate=' + data, 'layer_p_content');
            document.getElementById('layer_p').style.display = 'block';
            document.getElementById('layer_p_x').style.display = 'block';
        }

        function getStat(persid, start_date, end_date) {
            showInfo('./?m=pontaj&o=pdetail_stat&PersonID=' + persid + '&StartDate=' + start_date + '&EndDate=' + end_date, 'layer_s_content');
            document.getElementById('layer_s').style.display = 'block';
            document.getElementById('layer_s_x').style.display = 'block';
        }

        function checkAll() {
            {/literal}
            {foreach from=$persons key=persid item=item name=iter}
            {if $persid > 0}
            document.getElementById('pvalid_{$persid}').checked = true;
            {/if}
            {/foreach}
            {literal}
        }

        function uncheckAll() {
            {/literal}
            {foreach from=$persons key=persid item=item name=iter}
            {if $persid > 0}
            document.getElementById('pvalid_{$persid}').checked = false;
            {/if}
            {/foreach}
            {literal}
        }

        function validAct(id) {
            if (is_empty(document.getElementById('StartDate_' + id).value)) {
                alert('{/literal}{translate label='Nu ati completat data de inceput'}{literal}!');
                return false;
            }
            if (is_empty(document.getElementById('StartHour_' + id).value)) {
                alert('{/literal}{translate label='Nu ati completat ora de inceput'}{literal}!');
                return false;
            }
            if (is_empty(document.getElementById('EndDate_' + id).value)) {
                alert('{/literal}{translate label='Nu ati completat data de sfarsit'}{literal}!');
                return false;
            }
            if (is_empty(document.getElementById('EndHour_' + id).value)) {
                alert('{/literal}{translate label='Nu ati completat ora de sfarsit'}{literal}!');
                return false;
            }
            if (document.getElementById('Type_' + id).value == 0) {
                alert('{/literal}{translate label='Nu ati completat tipul de pontaj'}{literal}!');
                return false;
            }
            return true;
        }
    </script>
{/literal}

{/if}
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=pontaj&o=pdetail' +
            '&DistrictID=' + document.getElementById('DistrictID').value +
            '&CityID=' + document.getElementById('CityID').value +
            '&Status=' + document.getElementById('Status').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&DepartmentID=' + document.getElementById('DepartmentID').value +
            '&CostCenterID=' + document.getElementById('CostCenterID').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&StartDate=' + escape(document.getElementById('StartDate').value) +
            '&EndDate=' + escape(document.getElementById('EndDate').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value;
        {rdelim}
</script>