{include file="sales_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="Type" name="Type" class="cod">
        <option value="0">Tip</option>
        {foreach from=$campaignType key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Status" name="Status" class="cod">
        <option value="0">{translate label='Status'}</option>
        {foreach from=$campaignStatus key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="CampaignName" {if $smarty.get.search_for == 'CampaignName'}selected{/if}>Nume campanie</option>
    </select>
    <input type="text" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">

    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select><label>{translate label='inregistrari'}</label>
    <input type="button" id="apasa" value="Cauta" class="cod"
           onclick="window.location.href = './?m=sales&o=campaigns&DateStart=' + document.getElementById('DateStart').value + '&DateEnd='+ document.getElementById('DateEnd').value + '&Type=' + document.getElementById('Type').value + '&Status=' + document.getElementById('Status').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <label>{translate label='Data intre'}</label>
    <input type="text" name="DateStart" id="DateStart" class="formstyle" value="{$smarty.get.DateStart|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                          border="0"/></A></label>
    <label>si</label>
    <input type="text" name="DateEnd" id="DateEnd" class="formstyle" value="{$smarty.get.DateEnd|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','yyyy-MM-dd'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
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
                <li><input type="button" class="cod exportFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li><input type="button" class="cod exportFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Nume campanie' request_uri=$request_uri order_by=CampaignName}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Tip' request_uri=$request_uri order_by=Type}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Status' request_uri=$request_uri order_by=Status}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Cost Net' request_uri=$request_uri order_by=CostNet}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Cost Brut' request_uri=$request_uri order_by=Cost}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Data inceput' request_uri=$request_uri order_by=DateStart}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Data sfarsit' request_uri=$request_uri order_by=DateEnd}</td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Data creare' request_uri=$request_uri order_by=CreateDate}</td>
        {if $smarty.session.USER_ID}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">{translate label='Sterge'}</span></td>
        {/if}
    </tr>
    {foreach from=$campaigns key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$campaigns.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=sales&o=edit_campaign&CampaignID={$key}" class="blue">{$item.CampaignName}</a></td>
                <td class="celulaMenuST">{$campaignType[$item.Type]|default:'-'}</td>
                <td class="celulaMenuST">{$campaignStatus[$item.Status]|default:'-'}</td>
                <td class="celulaMenuST">{$item.CostNet|default:'-'}</td>
                <td class="celulaMenuST">{$item.Cost|default:'-'}</td>
                <td class="celulaMenuST">{$item.DateStart|default:'-'}</td>
                <td class="celulaMenuST">{$item.DateEnd|default:'-'}</td>
                <td class="celulaMenuST">{$item.CreateDate|default:'-'}</td>
                {if $smarty.session.USER_ID}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceasta campanie?'}')) window.location.href='./?m=sales&o=del_campaign&CampaignID={$key}'; return false;">{translate label='sterge'}</a>
                    </td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($campaigns)<1}
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="13" valign="top" class="bkdTitleMenu">
            <span class="TitleBoxDown">
            {if $campaigns.0.page > 1}&laquo; <a href="{$request_uri}" class="white">prima</a>&nbsp;<a href="{$request_uri}&page={math equation="x-y" x=$campaigns.0.page y=1}"
                                                                                                       class="white">inapoi</a>{/if}
            pagina {$campaigns.0.page} din {$campaigns.0.pageNo}
                {if $campaigns.0.page < $campaigns.0.pageNo}<a href="{$request_uri}&page={math equation="x+y" x=$campaigns.0.page y=1}"
                                                               class="white">{translate label='inainte'}</a>&nbsp;
                    <a href="{$request_uri}&page={$campaigns.0.pageNo}" class="white">{translate label='ultima'}</a>
                    &raquo;{/if}
            </span>
        </td>
    </tr>
</table>
