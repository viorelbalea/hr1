{include file="sales_menu.tpl"}
<div class="filter">
    <tr>
        <label>{translate label='Cauta dupa'}:</label>
        <select id="PersonID" name="PersonID" class="cod">
            <option value="0">{translate label='Responsabil'}</option>
            {foreach from=$persons  key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.PersonID}selected="selected"{/if}>{$item}</option>
            {/foreach}
        </select>
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
        <select id="search_for" nume="search_for" class="cod">
            <option value="">{translate label='cuvant cheie in'}</option>
            <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Responsabil'}</option>
            <option value="CompanyName" {if $smarty.get.search_for == 'CompanyName'}selected{/if}>{translate label='Nume firma'}</option>
            <option value="ContactName" {if $smarty.get.search_for == 'ContactName'}selected{/if}>{translate label='Persoana contact'}</option>
        </select>
        <input type="text" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20"
               maxlength="30" class="cod">
        <input id="apasa" type="button" value="Cauta" class="cod"
               onclick="window.location.href = './?m=sales&o=activities&PersonID=' + document.getElementById('PersonID').value + '&DateStart=' + document.getElementById('DateStart').value + '&DateEnd='+ document.getElementById('DateEnd').value + '&NextDateStart=' + document.getElementById('NextDateStart').value + '&NextDateEnd='+ document.getElementById('NextDateEnd').value + '&Subject=' + document.getElementById('Subject').value + '&Status=' + document.getElementById('Status').value + '&SourceID=' + document.getElementById('SourceID').value + '&StageID=' + document.getElementById('StageID').value + '&CampaignID=' + document.getElementById('CampaignID').value + '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
        <script>{literal}
            function selecteazaSourceID(x) {
                $('#CampaignID').hide();
                if (x == 2) $('#CampaignID').show();
            }
            {/literal} </script>
        <select id="SourceID" name="SourceID" class="cod">
            <option value="0">{translate label='Sursa'}</option>
            {foreach from=$activitySource key=key item=item}
                <option value="{$item.SourceID}" {if $item.SourceID==$smarty.get.SourceID}selected{/if}>{$item.Name}</option>
            {/foreach}
        </select>
        <td style="padding-left: 2px;" width="90">
            <select id="StageID" name="StageID" class="cod">
                <option value="0">{translate label='Stadiu'}</option>
                {foreach from=$activityStage key=key item=item}
                    <option value="{$item.StageID}" {if $item.StageID==$smarty.get.StageID}selected{/if}>{$item.Name}</option>
                {/foreach}
            </select>
            <select id="CampaignID" name="CampaignID" class="cod">
                <option value="0">{translate label='Campanie'}</option>
                {foreach from=$activityCampaign key=key item=item}
                    <option value="{$item.CampaignID}" {if $item.CampaignID==$smarty.get.CampaignID}selected{/if}>{$item.CampaignName}</option>
                {/foreach}
            </select>

            {math equation=x-y x=$smarty.now y=86400 assign=yesterday}
            {math equation=x+y x=$smarty.now y=86400 assign=tomorrow}
            <label>Apelat intre</label>
            <input type="text" name="DateStart" id="DateStart" class="formstyle" value="{$smarty.get.DateStart|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
            <SCRIPT LANGUAGE="JavaScript" ID="js1">
                var cal1 = new CalendarPopup();
                cal1.isShowNavigationDropdowns = true;
                cal1.setYearSelectStartOffset(10);
                //writeSource("js1");
            </SCRIPT>
            <label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img
                            src="images/cal.png" border="0"/></A></label>
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
            <label>De apelat intre</label>
            <input type="text" name="NextDateStart" id="NextDateStart" class="formstyle" value="{$smarty.get.NextDateStart|default:''|date_format:"%Y-%m-%d"}" size="10"
                   maxlength="10">
            <SCRIPT LANGUAGE="JavaScript" ID="js3">
                var cal3 = new CalendarPopup();
                cal3.isShowNavigationDropdowns = true;
                cal3.setYearSelectStartOffset(10);
                //writeSource("js3");
            </SCRIPT>
            <label><A HREF="#" onClick="cal3.select(document.getElementById('NextDateStart'),'anchor3','yyyy-MM-dd'); return false;" NAME="anchor3" ID="anchor3"><img
                            src="images/cal.png" border="0"/></A></label>
            <label>si</label>
            <input type="text" name="NextDateEnd" id="NextDateEnd" class="formstyle" value="{$smarty.get.NextDateEnd|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
            <SCRIPT LANGUAGE="JavaScript" ID="js4">
                var cal4 = new CalendarPopup();
                cal4.isShowNavigationDropdowns = true;
                cal4.setYearSelectStartOffset(10);
                //writeSource("js4");
            </SCRIPT>
            <label><A HREF="#" onClick="cal4.select(document.getElementById('NextDateEnd'),'anchor4','yyyy-MM-dd'); return false;" NAME="anchor4" ID="anchor4"><img
                            src="images/cal.png" border="0"/></A></label>
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select> <label>inregistrari</label>
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
                                   onclick="popUp('./?m=settings&o=personalisedlist&list=Activity&type=popup','',250,400)">
                        </li>
                    </ul>
                </div>
            </div>
</div>
<form action="./?m=sales&o=del_activity" method="post" enctype="multipart/form-data" name="frm_list">
    <table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
        <tr>
            <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
            <td class="bkdTitleMenu">{orderby label='Nume firma' request_uri=$request_uri order_by=CompanyName}</td>
            {if !empty($personalisedlist.Activity)}
                {foreach from=$personalisedlist.Activity key=field item=label}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
                {/foreach}
            {else}
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Responsabil'}</span>&nbsp;<a href="{$request_uri}&order_by=UserName&asc_or_desc=asc"><img
                                src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=UserName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
                </td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Persoana contact'}</span>&nbsp;<a href="{$request_uri}&order_by=ContactName&asc_or_desc=asc"><img
                                src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=ContactName&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                                  border="0"></a></td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Subiect'}</span>&nbsp;<a href="{$request_uri}&order_by=Subject&asc_or_desc=asc"><img
                                src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=Subject&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
                </td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span>&nbsp;<a href="{$request_uri}&order_by=Status&asc_or_desc=asc"><img
                                src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=Status&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                             border="0"></a></td>
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label='De apelat'}</span>&nbsp;<a href="{$request_uri}&order_by=NextDate&asc_or_desc=asc"><img
                                src="./images/s_asc.png" border="0"></a>&nbsp;<a href="{$request_uri}&order_by=NextDate&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
                </td>
            {/if}
            {if $smarty.session.USER_ID==1}
                <td class="bkdTitleMenu" align="center" nowrap="nowrap"><span class="TitleBox"><a href="#"
                                                                                                  onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceste activitati?'}')) document.frm_list.submit(); return false;">{translate label='sterge'}</a></span><br/>
                <input type="checkbox" id="list_all" value="1" onchange="
                        if(document.getElementById('list_all').checked==true) {ldelim} checkAll(); return false; {rdelim}
                        if(document.getElementById('list_all').checked==false) {ldelim} uncheckAll(); return false;  {rdelim}"
                />
                </td>
            {/if}
        </tr>
        {foreach from=$activities key=key item=item name=iter}
            {if $key>0}
                <tr height="30" class="CompanyColor{$item.Status}">
                    <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$key y=1 z=$activities.0.page t=$res_per_page}</td>
                    <td class="celulaMenuST"><a
                                href="./?m=sales&o=new_activity&ActivityID={$item.ActivityID}&ActivityDetID={$item.ActivityDetID}&CompanyID={$item.CompanyID}&ContactID={$item.ContactID}"
                                class="blue">{$item.CompanyName}</a></td>
                    {if !empty($personalisedlist.Activity)}
                        {foreach from=$personalisedlist.Activity key=field item=label name=iter}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                                {if $field == 'FullName'}{$item.FullName|default:'-'}
                                {elseif $field == 'ContactName'}{$item.ContactName|default:'-'}
                                    <br/>
                                    {$item.ContactPhone}
                                    <br/>
                                    {$item.ContactEmail}
                                    <br/>
                                    {$item.ContactFunction}
                                {elseif $field == 'Subject'}{$activitySubject[$item.Subject]|default:'-'}
                                {elseif $field == 'Status'}{$activityStatus[$item.Status2]|default:'-'}
                                {elseif $field == 'SourceID'}{$activitySource[$item.SourceID].Name|default:'-'}
                                {elseif $field == 'StageID'}{$activityStage[$item.StageID].Name|default:'-'}
                                {elseif $field == 'CampaignID'}{$activityCampaign[$item.CampaignID].CampaignName|default:'-'}
                                {elseif $field == 'Comment'}{$item.Comment|default:'-'}
                                {elseif $field == 'Date'}{$item.Date|default:'-'}
                                {elseif $field == 'NextDate'}{$item.NextDate|default:'-'}
                                {elseif $field == 'CreateDate'}{$item.CreateDate|default:'-'}
                                {else}
                                    {$item.$field|default:'&nbsp;'}
                                {/if}
                            </td>
                        {/foreach}
                    {else}
                        <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                        <td class="celulaMenuST">{$item.ContactName|default:'-'}<br/>{$item.ContactPhone}<br/>{$item.ContactEmail}<br/>{$item.ContactFunction}<br/></td>
                        <td class="celulaMenuST">{$activitySubject[$item.Subject]|default:'-'}</td>
                        <td class="celulaMenuST">{$activityStatus[$item.Status2]|default:'-'}</td>
                        <td class="celulaMenuST">{$item.NextDate|default:'-'}</td>
                    {/if}
                    {if $smarty.session.USER_ID==1}
                        <td class="celulaMenuSTDR" style="text-align: center;">
                        <input type="checkbox" id="list_{$item.ActivityID}" name="activity[{$item.ActivityID}]" value="1"/>
                        </td>
                    {/if}
                </tr>
            {/if}
        {/foreach}
        {if count($activities)==1}
            <tr height="30">
                <td colspan="10" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
            </tr>
        {/if}
        <tr>
            <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
        </tr>
    </table>
</form>

{literal}
<script language="javascript">
    function checkAll() {
        {/literal}
        {foreach from=$activities key=key item=item}
        {if $key>0}
        document.getElementById('list_' + {$item.ActivityID}).checked = true;
        {/if}
        {/foreach}
        {literal}
    }

    function uncheckAll(type) {
        {/literal}
        {foreach from=$activities key=key item=item}
        {if $key>0}
        document.getElementById('list_' + {$item.ActivityID}).checked = false;
        {/if}
        {/foreach}
        {literal}
    }
</script>
{/literal}