{include file="car_menu.tpl"}
<br>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="car_submenu.tpl"}</span></td>
    </tr>
    {if $err->getErrors()}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;">{$err->getErrors()}</td>
        </tr>
    {/if}
</table>
<br>
<table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
    <tr>
        <td style="padding-left: 4px;" width="75">{translate label='Cauta dupa'}:</td>
        <td style="padding-left: 8px;" width="300">
            <select id="CostTypeID" name="CostTypeID" class="cod">
                <option value="0">{translate label='Tip cheltuiala'}</option>
                {foreach from=$costtype key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.CostTypeID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
            &nbsp;&nbsp;&nbsp;
            <input type="checkbox" id="Active" {if !empty($smarty.get.Active)}checked{/if}> {translate label='asigurari active'}
        </td>
        <td style="padding-left: 8px;" width="60"><input type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=cars&o=assurance&CarID={$smarty.get.CarID}' +
                    '&CostTypeID=' + document.getElementById('CostTypeID').value +
                    '&Active=' + (document.getElementById('Active').checked ? 1 : 0) +
                    '&res_per_page=' + document.getElementById('res_per_page').value">
        </td>
        <td>&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
    <tr>
        <td align="right" style="padding-right: 4px;">
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select>&nbsp;{translate label='inregistrari'}&nbsp;&nbsp;&nbsp;
            <input type="button" class="cod" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
            <input type="button" class="cod" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
            <input type="button" class="cod" value="{translate label='Printeaza pagina'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
            <input type="button" class="cod" value="{translate label='Printeaza tot'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
            {*<input type="button" class="cod" value="{translate label='Personalizare'}" onclick="popUp('./?m=settings&o=personalisedlist&list=CarCost&type=popup','',250,400)">*}
        </td>
    </tr>
</table>
</br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{translate label='Asigurare'}</td>
        <td class="bkdTitleMenu">{translate label='Producator'}</td>
        <td class="bkdTitleMenu">{orderby label="Data inceput" request_uri=$request_uri order_by=StartDate}</td>
        <td class="bkdTitleMenu">{orderby label="Data expirare" request_uri=$request_uri order_by=StopDate}</td>
        <td class="bkdTitleMenu">{orderby label="Document Nr" request_uri=$request_uri order_by=ReceiptNo}</td>
        <td class="bkdTitleMenu">{orderby label="Data document" request_uri=$request_uri order_by=Date}</td>
        <td class="bkdTitleMenu">{orderby label="Km" request_uri=$request_uri order_by=Km}</td>
        <td class="bkdTitleMenu">{orderby label="Furnizor" request_uri=$request_uri order_by=CompanyName}</td>
        <td class="bkdTitleMenu">{orderby label="Valoare" request_uri=$request_uri order_by=Cost}</td>
        <td class="bkdTitleMenu">{orderby label="Moneda" request_uri=$request_uri order_by=Coin}</td>
        <td class="bkdTitleMenu">{orderby label="Buget" request_uri=$request_uri order_by=Budget}</td>
        <td class="bkdTitleMenu">{orderby label="Angajat" request_uri=$request_uri order_by=FullName}</td>
    </tr>
    {foreach from=$costs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$costs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CostType}</td>
                <td class="celulaMenuST">{$item.Producer} {$item.Properties}</td>
                <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.ReceiptNo}</td>
                <td class="celulaMenuST">{$item.Date|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.Km}</td>
                <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>
                <td class="celulaMenuST">{$item.Cost}</td>
                <td class="celulaMenuST">{$coins[$item.Coin]}</td>
                <td class="celulaMenuST">{if $item.Budget == 1}Da{else}Nu{/if}</td>
                <td class="celulaMenuST">{$item.FullName}</td>
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