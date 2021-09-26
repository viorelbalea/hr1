{include file="pontaj_menu.tpl"}
{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
{literal}
    <style type="text/css">
        .grid td {
            font-size: 10px;
        }
    </style>
{/literal}
    <div class="filter">
        <label>{translate label='Cauta'}:</label>
        <select id="DistrictID" name="DistrictID" onchange="if (this.value>0) window.location.href = './?m=pontaj&o=pphours' +
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
											    '&EndDate=' + escape(document.getElementById('EndDate').value)" class="cod">
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
        </select>
        <select name="select" class="cod" id="search_for" nume="search_for">
            <option value="">{translate label='cuvant cheie in'}</option>
            <option value="LastName" {if $smarty.get.search_for == 'lastname'}selected{/if}>{translate label='Nume'}</option>
            <option value="FirstName" {if $smarty.get.search_for == 'firstname'}selected{/if}>{translate label='Prenume'}</option>
            <option value="CNP" {if $smarty.get.search_for == 'cnp'}selected{/if}>{translate label='CNP'}</option>
        </select>
        <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
               onkeypress="if(getKeyUnicode(event)==13) filterList();">
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
            <select id="DivisionID" name="DivisionID" onchange="window.location.href = './?m=pontaj&o=pphours' +
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
											'&EndDate=' + escape(document.getElementById('EndDate').value)" class="dropdown">
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
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$def_start|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                  title="Data de inceput"><img src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
        <label>si</label>
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$def_end|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                        src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
        <input type="button" class="cod" value="{translate label='Recalcul'}" onclick="window.location.reload();">
        <input type="button" class="cod" value="{translate label='Ore noapte'}" onclick="toggleNHours();">
        <input type="button" class="cod" value="{translate label='Finalizare planificare'}"
               onclick="if(confirm('Finalizarea planificarii nu va mai permite sa reveniti pe tipul de ore (adaugare/modificare/stergere). Sunteti sigur?')) window.location.href='{$smarty.server.REQUEST_URI}&action=validate'; return false;">
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
                        <!--</li><li><input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">-->
                    </li>
                    <li><input type="button" class="cod printFile" value="{translate label='Printeaza'}"
                               onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                    </li>
                </ul>
            </div>
        </div>
    </div>
    <div id="layer_hp" class="layer" style="display: none;">
        <div class="eticheta">
            {$eticheta}
        </div>
        <h3 class="layer">{translate label='Activitate'}</h3>
        <div id="layer_hp_content" class="layerContent"></div>
    </div>
    <div id="layer_hp_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_hp').style.display = 'none'; document.getElementById('layer_hp_x').style.display = 'none';">x
    </div>
    {if !empty($smarty.get.msg)}

        {if $smarty.get.msg == 1}
            <div style="text-align: center; color: #0000FF;">{translate label='Planificarea a fost validata.'}</div>
        {elseif $smarty.get.msg == 2}
            <div style="text-align: center; color: #ff0000;">{translate label='Planificarea nu a putut fi validata.<br />Va rugam verificati ca perioada selectata sa nu fi fost deja planificata.'}</div>
        {/if}

    {/if}
{/if}
{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <table width="100%" cellspacing="0" cellpadding="0" class="grid">
        <!--        <tr>
            <td class="celulaMenuST"><b>{translate label='Departament'}</b></td>
            <td class="celulaMenuST" colspan="2">&nbsp;</td>
            {foreach from=$hours item=hour name=hfor}
                {if $smarty.foreach.hfor.iteration%2!=0}
                    <td colspan="2" class="celulaMenuST" {if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}name="NHours"{/if} style="{if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}display:none;{/if}border-left: 1px solid #a4a4a4;">&nbsp;</td>
                {/if}
            {/foreach}
            <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;">&nbsp;</td>
            <td class="celulaMenuST">&nbsp;</td>
            <td class="celulaMenuSTDR">&nbsp;</td>
        </tr>-->
        {foreach from=$dm key=DptID item=department name=dpmfor}
            <tr>
            <!--<td rowspan="{$department.RSpan}" valign="top" style="border-bottom: 3px solid #a4a4a4;">{$departments.$DptID}</td>-->
            {foreach from=$department.Dates key=dateval item=day name=dfor}

                {if $smarty.foreach.dfor.iteration > 1}
                    </tr><tr>
                {/if}


                {assign var='yearval' value=$dateval|date_format:'%Y'}
                {assign var='monthval' value=$dateval|date_format:'%m'}
                {assign var='weekval' value=$dateval|date_format:'%W'}
                {assign var='weekval' value=$wtrans.$dateval}
                {assign var='dayofweek' value=$dateval|date_format:'%w'}
                <td class="celulaMenuST" rowspan="{$department.DayPersonCount.$dateval}" valign="top" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">
                    <b>{$departments.$DptID}</b><br><br>{translate label=$days_labels.$dayofweek}<br>{$dateval|date_format:'%d.%m.%Y'} (W{$weekval}){if !empty($legal.$dateval)}
                <br>({translate label='SL'}){/if}</td>
                <td class="celulaMenuST"><b>{translate label='Angajat'}</b></td>
                {foreach from=$hours item=hour name=hfor}
                    {if $smarty.foreach.hfor.iteration%2!=0}
                        <td colspan="2" class="celulaMenuST" {if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}name="NHours"{/if}
                            style="{if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}display:none;{/if}border-left: 1px solid #a4a4a4;"><b>{$hour}</b>
                        </td>
                    {/if}
                {/foreach}
                <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;"><b>{translate label='T.<br />zi'}</b></td>
                <td class="celulaMenuST"><b>{translate label='R.<br />sapt'}</b></td>
                <td class="celulaMenuSTDR"><b>{translate label='R.<br />luna'}</b></td>
                </tr>
                <tr>
                {foreach from=$day key=PersonID item=personhours name=persfor}
                    {assign var='RowID' value=$DptID|cat:'-'|cat:$dateval|cat:'-'|cat:$PersonID}
                    {if $smarty.foreach.persfor.iteration > 1}
                        </tr><tr>
                    {/if}
                    <td class="celulaMenuST" style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}">{$persons.$DptID.$PersonID.FullName}</td>
                    {foreach from=$hours item=hour name=hsfor}
                        {assign var='hour_val' value=$personhours.$hour}
                        <td id="{$RowID}-{$hour}" class="celulaMenuST" {if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}name="NHours"{/if}
                            style="{if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}display:none;{/if}{if $smarty.foreach.hsfor.iteration%2!=0}border-left: 1px solid #a4a4a4;{/if}{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}text-align: center;{$styles.$hour_val}" {if empty($restrict.$hour_val)}onclick="regClick('{$PersonID}','{$dateval}','{$hour}', '{$RowID}');"{/if}>{$texts.$hour_val|default:'&nbsp;'}</td>
                    {/foreach}
                    <td class="celulaMenuST"
                        style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if} border-left:1px solid #a4a4a4;{if $department.Days.$dateval.$PersonID > 10}background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Days.$dateval.$PersonID|default:'0'}</td>
                    <td class="celulaMenuST"
                        style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if} {if ($department.Weeks.$yearval.$weekval.$PersonID < 0 && $department.Weeks_ref.$yearval.$weekval.$PersonID < 40) || ($department.Weeks.$yearval.$weekval.$PersonID < -8 && $department.Weeks_ref.$yearval.$weekval.$PersonID >= 40)} background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Weeks.$yearval.$weekval.$PersonID|default:'&nbsp;'}</td>
                    <td class="celulaMenuSTDR"
                        style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}{if $department.Months.$yearval.$monthval.$PersonID < 0} background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Months.$yearval.$monthval.$PersonID|default:'&nbsp;'}</td>
                {/foreach}
                </tr>
                <tr>
                    <td class="celulaMenuST" style="border-bottom: 3px solid #a4a4a4;"><b>{translate label='Total angajati'}</b></td>
                    {foreach from=$hours item=hour name=hsfor}
                        {assign var='hour_val' value=$personhours.$hour}
                        <td class="celulaMenuST" {if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}name="NHours"{/if}
                            style="{if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}display:none;{/if}{if $smarty.foreach.hsfor.iteration%2!=0}border-left: 1px solid #a4a4a4;{/if}{if $smarty.foreach.persfor.last}border-bottom: 3px solid #a4a4a4;{/if}text-align: center;">{$department.Totals.$dateval.$hour|default:'0'}</td>
                    {/foreach}
                    <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">{$department.Sums.Days.$dateval|default:'&nbsp;'}</td>
                    <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">{$department.Sums.Weeks.$weekval|default:'&nbsp;'}</td>
                    <td class="celulaMenuSTDR" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">{$department.Sums.Months.$monthval|default:'&nbsp;'}</td>
                </tr>
            {/foreach}
            </tr>
        {/foreach}
    </table>
{literal}
    <script type="text/javascript">
        var click
        var styles;
        var texts;
        var selected_cell;

        function regClick(persid, data, hour, rowid) {
            if (selected_cell !== undefined && selected_cell !== null && selected_cell.length > 1) {
                var elem = document.getElementById(selected_cell[0]);
                elem.style.background = selected_cell[1];
            }

            selected_cell = new Array();

            selected_cell[0] = rowid + "-" + hour;
            var elem = document.getElementById(selected_cell[0]);
            selected_cell[1] = elem.style.background;
            elem.style.background = "#1BA5E0";

            if (!click || click[0] != persid || click[1] != data) {
                click = new Array();
                click[0] = persid;
                click[1] = data;
                click[2] = hour;
            } else {
                showInfo('./?m=pontaj&o=pphours_act&PersonID=' + persid + '&StartDate=' + data + '&StartHour=' + click[2] + '&EndHour=' + hour + '&RowID=' + rowid, 'layer_hp_content');
                document.getElementById('layer_hp').style.display = 'block';
                document.getElementById('layer_hp_x').style.display = 'block';
                click = null;
                selected_cell = null;
            }
        }

        function toggleNHours() {
            var cval = null;
            var elems = document.getElementsByName("NHours");
            for (i = 0; i < elems.length; i++) {
                if (elems[i].style.display == "none") {
                    elems[i].style.display = "table-cell";
                    cval = 1;
                } else {
                    elems[i].style.display = "none";
                    cval = 0;
                }
            }
            if (cval != null) {
                setCookie('nhours', cval, 1);
            }
        }

        function winReload() {
            setTimeout(function () {
                window.location.reload();
            }, 100);
        }


        function updateRow(rowId, rowDate, startHour, endHour, type) {
            var dateParts = rowDate.split('-');
            var shParts = startHour.split(':');
            var ehParts = endHour.split(':');

            var initDate = new Date(dateParts[0], dateParts[1], dateParts[2], shParts[0], shParts[1]);
            var endDate = new Date(dateParts[0], dateParts[1], dateParts[2], ehParts[0], ehParts[1]);

            if (initDate.getTime() > endDate.getTime()) {
                var tmp = initDate;
                initDate = endDate;
                endDate = tmp;
            }

            while (initDate.getTime() <= endDate.getTime()) {
                var elem = document.getElementById(rowId + '-' + pad(initDate.getHours(), 2) + ':' + pad(initDate.getMinutes(), 2));

                if (type == 'delete-cell') {
                    elem.innerHTML = '&nbsp;';
                    elem.style['background'] = 'transparent';
                    elem.style['color'] = '#000;'
                } else {
                    elem.innerHTML = texts[type];
                    var styleParts = styles[type].split(';');
                    for (var i = 0; i < styleParts.length; i++) {
                        var styleInstr = styleParts[i].split(':');
                        if (styleInstr[0].length > 0) {
                            styleInstr[0] = styleInstr[0].replace('-color', '');
                            elem.style[styleInstr[0]] = styleInstr[1];
                        }
                    }
                }

                initDate = new Date(initDate.getTime() + 1800 * 1000);
            }
        }

        function pad(number, length) {
            var str = '' + number;
            while (str.length < length) {
                str = '0' + str;
            }
            return str;
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

        function setCookie(c_name, value, exdays) {
            var exdate = new Date();
            exdate.setDate(exdate.getDate() + exdays);
            var c_value = escape(value) + ((exdays == null) ? "" : "; expires=" + exdate.toUTCString());
            document.cookie = c_name + "=" + c_value;
        }

        function getCookie(c_name) {
            var i, x, y, ARRcookies = document.cookie.split(";");
            for (i = 0; i < ARRcookies.length; i++) {
                x = ARRcookies[i].substr(0, ARRcookies[i].indexOf("="));
                y = ARRcookies[i].substr(ARRcookies[i].indexOf("=") + 1);
                x = x.replace(/^\s+|\s+$/g, "");
                if (x == c_name) {
                    return unescape(y);
                }
            }
        }

        window.onload = function () {
            var nhc = getCookie('nhours');
            if (nhc != null && nhc != "" && nhc != 0) {
                toggleNHours();
            }
            styles = new Array();
            texts = new Array();


            {/literal}
            {foreach from=$styles item=style key=key}
            {literal}styles['{/literal}{$key}{literal}'] = {/literal}'{$style}';
            {/foreach}
            {foreach from=$texts item=text key=key}
            {literal}texts['{/literal}{$key}{literal}'] = {/literal}'{$text}';
            {/foreach}
            {literal}



        }


    </script>
{/literal}
{/if}
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=pontaj&o=pphours' +
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
            '&EndDate=' + escape(document.getElementById('EndDate').value)
        {rdelim}
</script>