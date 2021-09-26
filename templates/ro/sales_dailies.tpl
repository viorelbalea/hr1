{include file="sales_menu.tpl"}
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="PersonID" name="PersonID" class="cod">
        <option value="0">{translate label='Responsabil'}</option>
        {foreach from=$persons  key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.PersonID}selected="selected"{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>Data inceput</label><input type="text" name="DateStart" id="DateStart" class="formstyle" value="{$smarty.get.DateStart|default:''|date_format:"%Y-%m-%d"}" size="10"
                                      maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','yyyy-MM-dd'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                          border="0"/></A></label>
    <label>Data sfarsit</label>
    <input type="text" name="DateEnd" id="DateEnd" class="formstyle" value="{$smarty.get.DateEnd|default:''|date_format:"%Y-%m-%d"}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','yyyy-MM-dd'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                        border="0"/></A></label>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Responsabil'}</option>
    </select>
    <input type="text" id="keyword" onkeypress="if(getKeyUnicode(event)==13) $('#apasa').click();" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30"
           class="cod">
    <input name="button" id="apasa" type="button" class="cod"
           onclick="window.location.href = './?m=sales&o=dailies&PersonID=' + document.getElementById('PersonID').value + '&DateStart=' + document.getElementById('DateStart').value + '&DateEnd=' + document.getElementById('DateEnd').value +'&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value"
           value="Cauta"/>
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=Daily&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<form action="./?m=sales&o=del_daily" method="post" enctype="multipart/form-data" name="frm_list">
    <table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
        <tr>
            <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Responsabil' request_uri=$request_uri order_by=FullName}</td>
            {if !empty($personalisedlist.Daily)}
                {foreach from=$personalisedlist.Daily key=field item=label}
                    <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
                {/foreach}
            {else}
                <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Data raport' request_uri=$request_uri order_by=Date}</td>
                <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Apeluri noi' request_uri=$request_uri order_by=CallsNew}</td>
                <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Intalniri noi' request_uri=$request_uri order_by=MeetingsNew}</td>
                <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Intalniri revenire' request_uri=$request_uri order_by=MeetingsBack}</td>
                <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Intalniri efectuate' request_uri=$request_uri order_by=MeetingsDone}</td>
            {/if}
            {if $smarty.session.USER_ID==1}
                <td class="bkdTitleMenu" align="center" nowrap="nowrap"><span class="TitleBox"><a href="#"
                                                                                                  onclick="if (confirm('{translate label='Sunteti sigur(a) ca vreti sa stergeti aceste rapoarte?'}')) document.frm_list.submit(); return false;">{translate label='Sterge'}</a></span><br/>
                <input type="checkbox" id="list_all" value="1" onchange="
                        if(document.getElementById('list_all').checked==true) {ldelim} checkAll(); return false; {rdelim}
                        if(document.getElementById('list_all').checked==false) {ldelim} uncheckAll(); return false;  {rdelim}"
                />
                </td>{/if}
        </tr>
        {foreach from=$dailies key=key item=item name=iter}
            {if $key>0}
                <tr height="30">
                    <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$key y=1 z=$dailies.0.page t=$res_per_page}</td>
                    <td class="celulaMenuST"><a href="./?m=sales&o=edit_daily&DailyID={$key}" class="blue">{$item.FullName|default:'-'}</a></td>
                    {if !empty($personalisedlist.Daily)}
                        {foreach from=$personalisedlist.Daily key=field item=label name=iter}
                            <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                                {if $field == 'Date'}{$item.Date|default:'-'}
                                {elseif $field == 'CallsNew'}{$item.CallsNew}
                                {elseif $field == 'CallsBack'}{$item.CallsBack}
                                {elseif $field == 'MeetingsNew'}{$item.MeetingsNew}
                                {elseif $field == 'MeetingsBack'}{$item.MeetingsBack}
                                {elseif $field == 'MeetingsDone'}{$item.MeetingsDone}
                                {elseif $field == 'Reccos'}{$item.Reccos}
                                {else}
                                    {$item.$field|default:'&nbsp;'}
                                {/if}
                            </td>
                        {/foreach}
                    {else}
                        <td class="celulaMenuST">{$item.Date|default:'-'}</td>
                        <td class="celulaMenuST">{$item.CallsNew}</td>
                        <td class="celulaMenuST">{$item.MeetingsNew}</td>
                        <td class="celulaMenuST">{$item.MeetingsBack}</td>
                        <td class="celulaMenuST">{$item.MeetingsDone}</td>
                    {/if}
                    {if $smarty.session.USER_ID==1}
                        <td class="celulaMenuSTDR" style="text-align: center;"><input type="checkbox" id="list_{$item.DailyID}" name="daily[{$item.DailyID}]" value="1"/></td>{/if}
                </tr>
            {/if}
        {/foreach}
        {if count($dailies)==1}
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
        {foreach from=$dailies key=key item=item}
        {if $key>0}
        document.getElementById('list_' + {$item.DailyID}).checked = true;
        {/if}
        {/foreach}
        {literal}
    }

    function uncheckAll(type) {
        {/literal}
        {foreach from=$dailies key=key item=item}
        {if $key>0}
        document.getElementById('list_' + {$item.DailyID}).checked = false;
        {/if}
        {/foreach}
        {literal}
    }
</script>
{/literal}
