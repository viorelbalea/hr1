{include file="meets_menu.tpl"}
<br>
<table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
    <tr>
        <td style="padding-left: 4px;" width="75">{translate label='Cauta dupa:'}</td>
        <td style="padding-left: 2px;" width="100">
            <select id="EventType" name="EventType" class="cod">
                <option value="0">{translate label='Tip interviu'}</option>
                {foreach from=$eventType key=key item=item}
                    {if $key == 5 || $key == 6}
                        <option value="{$key}" {if $key==$smarty.get.EventType}selected{/if}>{$item}</option>
                    {/if}
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 2px;" width="200">
            <select id="PersonID" name="PersonID" class="cod">
                <option value="0">{translate label='Personal'}</option>
                {foreach from=$persons key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.PersonID}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        </td>
        <td style="padding-left: 30px;" width="60">
            <select id="search_for" nume="search_for" class="cod">
                <option value="">{translate label='cuvant cheie in'}</option>
                <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Reprezentant companie'}</option>
                <option value="Scope" {if $smarty.get.search_for == 'Scope'}selected{/if}>{translate label='Scop'}</option>
            </select>
        </td>
        <td style="padding-left: 4px;" width="60"><input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod"
                                                         onkeypress="if(getKeyUnicode(event)==13) filterList();"></td>
        <td style="padding-left: 4px;" width="60"><input type="button" value="Cauta" class="cod" onclick="filterList();"></td>
        <td>&nbsp;</td>
    </tr>
</table>
<table cellspacing="0" cellpadding="0" width="100%" height="40" class="filter">
    <tr>
        <td style="padding-left: 46px;" width="140" valign="middle" nowrap="nowrap">
            {translate label='intre'}: <input type="text" id="DateStart" class="formstyle" value="{$smarty.get.DateStart|default:''|date_format:"%d.%m.%Y"}" size="10"
                                              maxlength="10">
            <SCRIPT LANGUAGE="JavaScript" ID="js1">
                var cal1 = new CalendarPopup();
                cal1.isShowNavigationDropdowns = true;
                cal1.setYearSelectStartOffset(10);
                //writeSource("js1");
            </SCRIPT>
            <A HREF="#" onClick="cal1.select(document.getElementById('DateStart'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img src="images/cal.png"
                                                                                                                                                           align="absbottom"
                                                                                                                                                           border="0"/></A>&nbsp;
        </td>
        <td style="padding-left: 10px;" width="120" valign="middle" nowrap="nowrap">
            {translate label='si'} <input type="text" id="DateEnd" class="formstyle" value="{$smarty.get.DateEnd|default:''|date_format:"%d.%m.%Y"}" size="10" maxlength="10">
            <SCRIPT LANGUAGE="JavaScript" ID="js2">
                var cal1 = new CalendarPopup();
                cal1.isShowNavigationDropdowns = true;
                cal1.setYearSelectStartOffset(10);
                //writeSource("js2");
            </SCRIPT>
            <A HREF="#" onClick="cal1.select(document.getElementById('DateEnd'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img src="images/cal.png"
                                                                                                                                                         border="0"
                                                                                                                                                         align="absbottom"/></A>&nbsp;
        </td>
        <td align="right" style="padding-right: 4px;">
            <select id="res_per_page" nume="res_per_page" class="cod">
                {foreach from=$res_per_pages item=item}
                    <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
                {/foreach}
            </select> {translate label='inregistrari'}&nbsp;&nbsp;&nbsp;
            <input type="button" class="cod" value="Export .xls" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
            <input type="button" class="cod" value="Export .doc" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
            <input type="button" class="cod" value="{translate label='Printeaza pagina'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
            <input type="button" class="cod" value="{translate label='Printeaza tot'}" onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
            <input type="button" class="cod" value="{translate label='Personalizare'}" onclick="popUp('./?m=settings&o=personalisedlist&list=Event&type=popup','',250,400)">
        </td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label=Scop request_uri=$request_uri order_by=Scope asc_or_desc=asc}</td>
        {if !empty($personalisedlist.Event)}
            {foreach from=$personalisedlist.Event key=field item=label name=iter}
                <td class="bkdTitleMenu">
                    {orderby label=$label request_uri=$request_uri order_by=$field}
                </td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label=Autor request_uri=$request_uri order_by=UserName}</td>
            <td class="bkdTitleMenu">{orderby label="Reprezentant companie" request_uri=$request_uri order_by=FullName}</td>
            <td class="bkdTitleMenu">{orderby label=Detalii request_uri=$request_uri order_by=Details}</td>
            <td class="bkdTitleMenu">{orderby label=Status request_uri=$request_uri order_by=EventStatus}</td>
            <td class="bkdTitleMenu">{orderby label=Intre request_uri=$request_uri order_by=EventRelation}</td>
            <td class="bkdTitleMenu">{orderby label=Tip request_uri=$request_uri order_by=EventType}</td>
            <td class="bkdTitleMenu">{orderby label=Data request_uri=$request_uri order_by=EventData}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$events key=key item=item name=iter}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$events.0.page t=$res_per_page}</td>
                <td class="celulaMenuST"><a href="./?m=events&o=edit&EventID={$key}" class="blue">{$item.Scope}</a></td>
                {if !empty($personalisedlist.Event)}
                    {foreach from=$personalisedlist.Event key=field item=label name=iter1}
                        <td class="celulaMenuST{if $smarty.foreach.iter1.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'ConsultantID'}
                                {$consultants[$item.ConsultantID]}
                            {elseif $field == 'EventStatus'}
                                {$eventStatus[$item.EventStatus]}

                            {elseif $field == 'EventType'}
                                {$eventType[$item.EventType]}

                            {elseif $field == 'EventRelation'}
                                {$eventRelation[$item.EventRelation]}

                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.UserName}</td>
                    <td class="celulaMenuST">{$item.FullName}</td>
                    <td class="celulaMenuST">{$item.Details|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$eventStatus[$item.EventStatus]}</td>
                    <td class="celulaMenuST">{$eventRelation[$item.EventRelation]}</td>
                    <td class="celulaMenuST">{$eventType[$item.EventType]}</td>
                    <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.fEventData}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi acest interviu?'}')) window.location.href='./?m=events&o=interview&o=del&EventID={$key}&type=interviu'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($events)==1}
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=events&o=interview&EventType=' + document.getElementById('EventType').value +
            '&PersonID=' + document.getElementById('PersonID').value +
            '&DateStart=' + document.getElementById('DateStart').value +
            '&DateEnd=' + document.getElementById('DateEnd').value +
            '&search_for=' + document.getElementById('search_for').value +
            '&keyword=' + escape(document.getElementById('keyword').value) +
            '&res_per_page=' + document.getElementById('res_per_page').value
        {rdelim}
</script>