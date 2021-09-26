{include file="car_cost_menu.tpl"}

<div id="layer_costauto" class="layer" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer" id="layer_title">{translate label='Cheltuiala Auto'}</h3>
    <div id="layer_costauto_content" class="layerContent"></div>
    <div class="saveObservatii">


    </div>
</div>
<div id="layer_costauto_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_costauto').style.display = 'none'; document.getElementById('layer_costauto_x').style.display = 'none'; window.location.reload();">x
</div>


<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="CarID" name="CarID" class="cod">
        <option value="0">{translate label='Masina'}</option>
        {foreach from=$cars key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CarID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CostGroupID" name="CostGroupID" class="cod" onchange="getCostTypes(this.value);">
        <option value="0">{translate label='Grupa cheltuiala'}</option>
        {foreach from=$costgroups key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CostGroupID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CostTypeID" name="CostTypeID" class="cod">
        <option value="0">{translate label='Tip cheltuiala'}</option>
        {foreach from=$costtypedictionary key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CostTypeID}selected{/if}>{$item.CostType}</option>
        {/foreach}
    </select>
    <select id="CompanyID" name="CompanyID" class="cod">
        <option value="0">{translate label='Furnizor'}</option>
        {foreach from=$companies key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <input type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=cars_cost&o=cost&CarID=' + document.getElementById('CarID').value +
															         '&CostGroupID=' + document.getElementById('CostGroupID').value +
															         '&CostTypeID=' + document.getElementById('CostTypeID').value +
																 '&CompanyID=' + document.getElementById('CompanyID').value +
																 '&res_per_page=' + document.getElementById('res_per_page').value">
    {if $rw == 1}
        <input type="button" value="{translate label='Adauga asigurare'}" onclick="getCost(0, 'assurance');">
        <input type="button" value="{translate label='Adauga cheltuiala'}" onclick="getCost(0, 'other');">
    {/if}
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>{translate label='inregistrari'}</label>
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
                <li><input type="button" class="cod options" value="{translate label='Personalizare'}"
                           onclick="popUp('./?m=settings&o=personalisedlist&list=CarCost&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Masina" request_uri=$request_uri order_by=Brand,Model asc_or_desc=asc}</td>
        {if !empty($personalisedlist.CarCost)}
            {foreach from=$personalisedlist.CarCost key=field item=label}
                {if $field == 'Date' || $field == 'ReceiptNo'}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field asc_or_desc=desc}</td>
                {else}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
                {/if}
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Document Nr" request_uri=$request_uri order_by=ReceiptNo asc_or_desc=desc}</td>
            <td class="bkdTitleMenu">{orderby label="Data document" request_uri=$request_uri order_by=Date asc_or_desc=desc}</td>
            <td class="bkdTitleMenu">{orderby label="Km" request_uri=$request_uri order_by=Km}</td>
            <td class="bkdTitleMenu">{orderby label="Grupa cheltuiala" request_uri=$request_uri order_by=CostGroupID}</td>
            <td class="bkdTitleMenu">{orderby label="Furnizor" request_uri=$request_uri order_by=CompanyName}</td>
            <td class="bkdTitleMenu">{orderby label="Valoare" request_uri=$request_uri order_by=Cost}</td>
            <td class="bkdTitleMenu">{translate label="Moneda"}</td>
            <td class="bkdTitleMenu">{orderby label="Buget" request_uri=$request_uri order_by=Budget}</td>
            <td class="bkdTitleMenu">{orderby label="Revizie" request_uri=$request_uri order_by=Checkup}</td>
            <td class="bkdTitleMenu">{orderby label="Angajat" request_uri=$request_uri order_by=FullName}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$costs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$costs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{if $rw == 1}<a href="#" onclick="getCost({$key}, '{if $item.CostGroupID == 1}assurance{else}other{/if}'); return false;"
                                                         class="blue">{$brands[$item.Brand]} {$item.Model}
                        / {$item.RegNo}</a>{else}{$brands[$item.Brand]} {$item.Model} / {$item.RegNo}{/if}</td>
                {if !empty($personalisedlist.CarCost)}
                    {foreach from=$personalisedlist.CarCost key=field item=label name=iter}
                        {if $field == 'CostGroupID'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="padding-left: 5px;">
                                {$costgroups[$item.CostGroupID]|default:'-'}
                            </td>
                        {elseif $field == 'Coin'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">
                                {$coins[$item.Coin]|default:'-'}
                            </td>
                        {elseif $field == 'Budget'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">
                                {if $item.Budget == 1}Da{else}Nu{/if}
                            </td>
                        {elseif $field == 'Checkup'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">
                                {if $item.Checkup == 1}Da{else}Nu{/if}
                            </td>
                        {elseif $field == 'Km' || $field == 'Cost'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="text-align: right; padding-right: 5px;">
                                {$item.$field|default:'-'}
                            </td>
                        {elseif $field == 'Date' || $field == 'StartDate' || $field == 'StopDate'}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="text-align: center;">
                                {$item.$field|default:'-'}
                            </td>
                        {else}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}" style="padding-left: 5px;">
                                {$item.$field|default:'-'}
                            </td>
                        {/if}
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.ReceiptNo}</td>
                    <td class="celulaMenuST">{$item.Date|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.Km}</td>
                    <td class="celulaMenuST">{$costgroups[$item.CostGroupID]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Cost|string_format:"%.2f"}</td>
                    <td class="celulaMenuST">{$coins[$item.Coin]}</td>
                    <td class="celulaMenuST">{if $item.Budget == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{if $item.Checkup == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{$item.FullName}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta cheltuiala?'}')) window.location.href='./?m=cars_cost&o=cost&ID={$key}&save=1&del=1'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($costs)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>

{literal}
<script type="text/javascript">
    function getCost(costid, costtype) {
        if (costtype == 'assurance') {
            document.getElementById('layer_title').innerHTML = '{/literal}{translate label='Cheltuiala Auto - Asigurari'}{literal}';
        } else {
            document.getElementById('layer_title').innerHTML = '{/literal}{translate label='Cheltuiala Auto - Diverse'}{literal}';
        }
        document.getElementById('layer_costauto_content').innerHTML = '';
        var curr_time = new Date().getTime();
        showInfo('./?m=cars_cost&o=cost&ID=' + costid + '&costtype=' + costtype + '&rnd=' + curr_time, 'layer_costauto_content');
        document.getElementById('layer_costauto').style.display = 'block';
        document.getElementById('layer_costauto_x').style.display = 'block';
    }

    function check_invoice() {

        var invoice_sum = 0.00;
        var items = document.getElementsByName('item_value');
        var length = items.length;
        for (var i = 0; i < length; i++) {
            invoice_sum = (parseFloat(invoice_sum) + parseFloat(items[i].value));
        }
        invoice_sum = parseFloat(invoice_sum).toFixed(2);

        if (document.getElementById('invoice_total').value.length > 0) {
            var invoice_total = parseFloat(document.getElementById('invoice_total').value).toFixed(2);
            if (invoice_total != invoice_sum) {
                var diff = invoice_total - invoice_sum;
                diff = parseFloat(diff).toFixed(2);
                var out = '<b style="color: #f00;">Totalul facturii nu corespunde cu totalul articolelor.';
                if (diff != 'NaN' && diff != undefined) {
                    out += '<br />Diferenta este de ' + diff;
                }
                out += '</b>';
                document.getElementById('check_invoice_message').innerHTML = out;
            } else {
                document.getElementById('check_invoice_message').innerHTML = '<b style="color: #00f;">Totalurile corespund.</b>';
            }
        } else {
            document.getElementById('check_invoice_message').innerHTML = '';
        }


    }

    function getAproxValue(value) {
        showInfo('ajax.php?o=getCarDictionaryValue&DictionaryID=' + value + '&rand=' + parseInt(Math.random() * 999999999), 'aj_dummy');
        setTimeout(setAproxValues, 100);
    }

    function setAproxValues() {
        document.getElementById('ItemUm_0').innerHTML = document.getElementById('aj_um_value').value;
        document.getElementById('ItemCost_0').value = document.getElementById('aj_cost').value;
    }

    function getCostTypes(GroupID) {
        showInfo('ajax.php?o=getCostType&CostGroup=' + GroupID + '&rand=' + parseInt(Math.random() * 999999999), 'CostTypesFilter');
    }

    function windowClose() {
        var element = document.getElementById('errors');
        if (typeof (element) == 'undefined' || element == null) {
            document.getElementById('layer_costauto').style.display = 'none';
            document.getElementById('layer_costauto_x').style.display = 'none';
            window.location.reload();
        }
    }

    function getCheckups() {
        if (document.getElementById('Checkup').checked) {
            var car_id = document.getElementById('CarID').value;
            var checkup_id = document.getElementById('DummyCheckupID').value;
            if (car_id > 0) {
                showInfo('ajax.php?o=getCheckups&CarID=' + car_id + '&CheckupID=' + checkup_id + '&rand=' + parseInt(Math.random() * 999999999), 'CheckupHolder');
            } else {
                alert('Trebuie sa alegeti mai intai masina.');
                document.getElementById('Checkup').checked = false;
            }
        } else {
            document.getElementById('CheckupHolder').innerHTML = '';
        }
    }
</script>
{/literal}
