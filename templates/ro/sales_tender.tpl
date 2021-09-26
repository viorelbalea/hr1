{include file="sales_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Subject" name="Subject" class="cod">
        <option value="0">{translate label='Subiect'}</option>
        {foreach from=$activitySubject key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Subject}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$activityStatus key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="ProjectID">
        <option value="0">{translate label='Nume proiect'}</option>
        {foreach from=$projects key=key item=item}
            {if $key > 0}
                <option value="{$key}" {if $key==$smarty.get.ProjectID}selected{/if}>{$item.Name}</option>
            {/if}
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="CompanyName" {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Beneficiar'}</option>
        <option value="Address" {if $smarty.get.search_for == 'Address'}selected{/if}>{translate label='Locatia proiectului'}</option>
    </select>
    <input type="text" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input id="apasa" type="button" value="Cauta" class="cod"
           onclick="window.location.href = './?m=sales&o=tender' + '&DateStart=' + document.getElementById('DateStart').value + '&DateEnd='+ document.getElementById('DateEnd').value + '&Subject=' + document.getElementById('Subject').value + '&Status=' + document.getElementById('Status').value + '&ProjectID=' + document.getElementById('ProjectID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <br/>
    <label>Data initiala:</label>
    <input type="text" name="DateStart" id="DateStart" class="formstyle" value="{$smarty.get.DateStart|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    </label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                           border="0"/></A></label>
    <label>Data finala:</label>
    <input type="text" name="DateEnd" id="DateEnd" class="formstyle" value="{$smarty.get.DateEnd|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','yyyy-MM-dd'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>inregistrari</label>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Ofertare&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<form action="./?m=sales&o=del_activity" method="post" enctype="multipart/form-data" name="frm_list">
    <table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
        <tr>
            <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
            <td class="bkdTitleMenu">{orderby label='Beneficiar' request_uri=$request_uri order_by=CompanyName}</td>
            {if !empty($personalisedlist.Ofertare)}
                {foreach from=$personalisedlist.Ofertare key=field item=label}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
                {/foreach}
            {else}
                <td class="bkdTitleMenu">{orderby label='Proiect' request_uri=$request_uri order_by=Name}</td>
                <td class="bkdTitleMenu">{orderby label='Subiect' request_uri=$request_uri order_by=Subject}</td>
                <td class="bkdTitleMenu">{orderby label='Status' request_uri=$request_uri order_by=Status}</td>
                <td class="bkdTitleMenu">{orderby label='Participare' request_uri=$request_uri order_by=ParticipationType}</td>
                <td class="bkdTitleMenu">{orderby label='Sursa de finantare' request_uri=$request_uri order_by=FinancialSource}</td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Locatia proiectului'}</span></td>
                <td class="bkdTitleMenu">{orderby label='Data cererii' request_uri=$request_uri order_by=RequestDate}</td>
                <td class="bkdTitleMenu">{orderby label='Termen limita' request_uri=$request_uri order_by=Deadline}</td>
                <td class="bkdTitleMenu">{orderby label='Data ofertei' request_uri=$request_uri order_by=OfferDate}</td>
                <td class="bkdTitleMenu">{orderby label='Beneficiar final' request_uri=$request_uri order_by=Beneficiary}</td>
                <td class="bkdTitleMenu">{orderby label='Valoare oferta' request_uri=$request_uri order_by=OfferValue}</td>
            {/if}
        </tr>
        {foreach from=$activities key=key item=item name=iter}
            {if $key>0}
                <tr height="30">
                    <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$key y=1 z=$activities.0.page t=$res_per_page}</td>
                    <td class="celulaMenuST"><a
                                href="./?m=sales&o=new_activity&ActivityID={$item.ActivityID}&ActivityDetID={$item.ActivityDetID}&CompanyID={$item.CompanyID}&ContactID={$item.ContactID}"
                                class="blue">{$item.CompanyName}</a></td>
                    {if !empty($personalisedlist.Ofertare)}
                        {foreach from=$personalisedlist.Ofertare key=field item=label name=iter}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                                {if $field == 'Subject'}{$activitySubject[$item.Subject]|default:'-'}
                                {elseif $field == 'Status'}{$activityStatus[$item.Status]|default:'-'}
                                {elseif $field == 'ParticipationType'}{$participation_types[$item.ParticipationType]|default:'-'}
                                {elseif $field == 'FinancialSource'}{$financial_sources[$item.FinancialSource]|default:'-'}
                                {elseif $field == 'RequestDate'}{if $item.RequestDate > '0000-00-00'}{$item.RequestDate}{else}-{/if}
                                {elseif $field == 'Deadline'}{if $item.Deadline > '0000-00-00'}{$item.Deadline}{else}-{/if}
                                {elseif $field == 'OfferDate'}{if $item.OfferDate > '0000-00-00'}{$item.OfferDate}{else}-{/if}
                                {elseif $field == 'OfferValue'}{$item.OfferValue|default:'-'} {$item.Coin}
                                {else}
                                    {$item.$field|default:'&nbsp;'}
                                {/if}
                            </td>
                        {/foreach}
                    {else}
                        <td class="celulaMenuST">{$item.Name|default:'-'}</td>
                        <td class="celulaMenuST">{$activitySubject[$item.Subject]|default:'-'}</td>
                        <td class="celulaMenuST">{$activityStatus[$item.Status]|default:'-'}</td>
                        <td class="celulaMenuST">{$participation_types[$item.ParticipationType]|default:'-'}</td>
                        <td class="celulaMenuST">{$financial_sources[$item.FinancialSource]|default:'-'}</td>
                        <td class="celulaMenuST">{$item.Address|default:'-'}</td>
                        <td class="celulaMenuST">{if $item.RequestDate > '0000-00-00'}{$item.RequestDate}{else}-{/if}</td>
                        <td class="celulaMenuST">{if $item.Deadline > '0000-00-00'}{$item.Deadline}{else}-{/if}</td>
                        <td class="celulaMenuST">{if $item.OfferDate > '0000-00-00'}{$item.OfferDate}{else}-{/if}</td>
                        <td class="celulaMenuST">{$item.Beneficiary|default:'-'}</td>
                        <td class="celulaMenuSTDR">{$item.OfferValue|default:'-'} {$item.Coin}</td>
                    {/if}
                </tr>
            {/if}
        {/foreach}
        {if count($activities)==1}
            <tr height="30">
                <td colspan="13" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
            </tr>
        {/if}
        <tr>
            <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
        </tr>
    </table>
</form>