{include file="contract_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="ContractTypeID" name="ContractTypeID" class="cod">
        <option value="0">{translate label='Tip contract'}</option>
        {foreach from=$contract_types key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.ContractTypeID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="PartnerID" name="PartnerID" class="cod">
        <option value="0">{translate label='Partener'}</option>
        {foreach from=$usedPartners key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.PartnerID}selected{/if}>{$item}</option>
        {/foreach}
    </select>

    <script>
        {literal}
        function selecteazaResponsabili(x) {
            $('#TechnicalPersonID').hide();
            $('#FinanciarPersonID').hide();
            if (x == 1) $('#TechnicalPersonID').show();
            if (x == 2) $('#FinanciarPersonID').show();
        }
        {/literal}
    </script>

    <select id="Responsabili" name="Responsabili" class="cod" onchange="selecteazaResponsabili(this.value)">
        <option value="0">{translate label='Resonsabili'}</option>
        <option value="1">{translate label='Responsabil tehnic'}</option>
        <option value="2">{translate label='Responsabil financiar'}</option>
    </select>
    <select id="TechnicalPersonID" name="TechnicalPersonID" class="cod" style="display:none;">
        <option value="0">{translate label='Responsabil tehnic'}</option>
        {foreach from=$contracts_technical_persons key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.TechnicalPersonID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="FinanciarPersonID" name="FinanciarPersonID" class="cod" style="display:none;">
        <option value="0">{translate label='Responsabil financiar'}</option>
        {foreach from=$contracts_financiar_persons key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.FinanciarPersonID}selected{/if}>{$item}</option>
        {/foreach}

    </select>

    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="ContractName" {if $smarty.get.search_for == 'ContractName'}selected{/if}>{translate label='Nume contract'}</option>
        <option value="CompanyName" {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Nume partener'}</option>
        <option value="ContractNo" {if $smarty.get.search_for == 'ContractNo'}selected{/if}>{translate label='Numar contract'}</option>
    </select>
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input id="apasa" type="button" value="Cauta" class="cod" onclick="window.location.href = './?m=contract&ContractTypeID=' + document.getElementById('ContractTypeID').value +
	                                                                                                                         '&PartnerID=' + document.getElementById('PartnerID').value +
																 '&Responsabili=' + document.getElementById('Responsabili').value +
																 '&TechnicalPersonID=' + document.getElementById('TechnicalPersonID').value +
																 '&FinanciarPersonID=' + document.getElementById('FinanciarPersonID').value +
																 '&CompanyID=' + document.getElementById('CompanyID').value +
																 '&CompanyRole=' + document.getElementById('CompanyRole').value +
																 '&PaymentType=' + document.getElementById('PaymentType').value +
																 '&Coin=' + document.getElementById('Coin').value +
																 '&Status=' + document.getElementById('Status').value +
																 '&search_for=' + document.getElementById('search_for').value + 
																 '&keyword=' + escape(document.getElementById('keyword').value) + 
																 '&res_per_page=' + document.getElementById('res_per_page').value">

    <select id="CompanyID" name="CompanyID" class="cod">
        <option value="0">{translate label='Companie self'}</option>
        {foreach from=$self key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="CompanyRole" name="CompanyRole" class="cod">
        <option value="0">{translate label='Rol self'}</option>
        <option value="Beneficiar" {if $smarty.get.CompanyRole == 'Beneficiar'}selected{/if}>{translate label='Beneficiar'}</option>
        <option value="Furnizor" {if $smarty.get.CompanyRole == 'Furnizor'}selected{/if}>{translate label='Furnizor'}</option>
    </select>
    <select id="PaymentType" name="PaymentType" class="cod">
        <option value="0">{translate label='Tip plata'}</option>
        {foreach from=$payment_type key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.PaymentType}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Coin" name="Coin" class="cod">
        <option value="0">{translate label='Moneda'}</option>
        {foreach from=$coins item=item}
            <option value="{$item}" {if $item==$smarty.get.Coin}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0">{translate label='Stare contract'}</option>
        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>

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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Contract&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>

</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Nume contract" request_uri=$request_uri order_by=ContractName asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Contract)}
            {foreach from=$personalisedlist.Contract key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Tip contract" request_uri=$request_uri order_by=ContractType}</td>
            <td class="bkdTitleMenu">{orderby label=Partener request_uri=$request_uri order_by=CompanyName}</td>
            <td class="bkdTitleMenu">{orderby label="Data inceput" request_uri=$request_uri order_by=StartDate}</td>
            <td class="bkdTitleMenu">{orderby label="Data sfarsit" request_uri=$request_uri order_by=StopDate}</td>
            <td class="bkdTitleMenu">{orderby label=Valoare request_uri=$request_uri order_by=ContractValue}</td>
            <td class="bkdTitleMenu">{orderby label=User request_uri=$request_uri order_by=UserName}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>{/if}
    </tr>
    {foreach from=$contracts key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$contracts.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=contract&o=edit&ContractID={$key}" class="blue">{$item.ContractName}</a></td>
                {if !empty($personalisedlist.Contract)}
                    {foreach from=$personalisedlist.Contract key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">{$item.$field|default:'&nbsp;'}</td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.ContractType}</td>
                    <td class="celulaMenuST">{$item.CompanyName}</td>
                    <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.ContractValue|default:'0'} {$item.Coin}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.UserName}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest contract?'}')) window.location.href='./?m=contract&o=del&ContractID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($contracts)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>    
