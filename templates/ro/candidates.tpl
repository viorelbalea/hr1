{include file="candidates_menu.tpl"}
<div class="layer" id="layer_candidates_review" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Curiculum Vitae'}</h3>
    <div class="layerContent" id="layer_candidates_review_content">
    </div>


</div>

<div class="butonX" id="layer_candidates_review_x" style="display: none;" title="Inchide"
     onclick="document.location= './?m=candidates&o=redirector&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}'">
    x
</div>
<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="CityId" name="CityId" class="cod">
        <option value="0">{translate label='Localitate'}</option>
        {foreach from=$cities key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CityId}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="PostTypeId" name="PostTypeId" class="cod">
        <option value="0">{translate label='Sursa'}</option>
        {foreach from=$ptypes key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.PostTypeId}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="PostId" name="PostId" class="cod" style="width:250px;">
        <option value="0">{translate label='Post'}</option>
        {foreach from=$posts key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.PostId}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" name="search_for" class="cod">
        <option value="default">{translate label='cuvant cheie in'}</option>
        <option value="FullName" {if $smarty.get.search_for == 'FullName'}selected{/if}>{translate label='Nume si Prenume'}</option>
        <option value="Email" {if $smarty.get.search_for == 'Email'}selected{/if}>{translate label='Email'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20" maxlength="30" class="cod">


    <input type="button" value="Cauta" class="cod"
           onclick="window.location.href = './?m=candidates&o=list_external&CityId=' + document.getElementById('CityId').value + '&PostTypeId=' + document.getElementById('PostTypeId').value + '&PostId=' + document.getElementById('PostId').value +'&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}" {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select> <label>inregistrari</label>
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
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Nume</span>&nbsp;<a href="{$request_uri}&order_by=FirstName&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=FirstName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Post</span>&nbsp;<a href="{$request_uri}&order_by=PostName&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=PostName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">E-mail</span>&nbsp;<a href="{$request_uri}&order_by=Email&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=Email&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Telefon</span>&nbsp;<a href="{$request_uri}&order_by=Phone&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=Phone&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Mobil</span>&nbsp;<a href="{$request_uri}&order_by=Mobile&asc_or_desc=asc"><img src="./images/s_asc.png" border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=Mobile&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Sursa</span>&nbsp;<a href="{$request_uri}&order_by=PostTypeName&asc_or_desc=asc"><img src="./images/s_asc.png"
                                                                                                                                              border="0"></a>&nbsp;<a
                    href="{$request_uri}&order_by=PostTypeName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Optiuni</span>&nbsp;</td>
        {if !empty($personalisedlist.Job)}
            {foreach from=$personalisedlist.Job key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span>&nbsp;<a href="{$request_uri}&order_by={$field}&asc_or_desc=asc"><img src="./images/s_asc.png"
                                                                                                                                                     border="0"></a>&nbsp;<a
                            href="{$request_uri}&order_by={$field}&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
            {/foreach}
        {else}
        {/if}
        {if $smarty.session.USER_ID==1}
            <td style="display:none;" class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$candidates key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=1}</td>
                <td class="celulaMenuST"><a
                            onclick="getCv('./?m=candidates&o=viewcv&CvId={$key}&action=preview&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}'); return false;"
                            href="javascript:return false;" class="blue">{$item.FirstName|default:'-'} {$item.LastName|default:'-'}</a></td>
                <td class="celulaMenuST">{$item.PostName|default:'-'}</td>
                <td class="celulaMenuST"><a href="mailto:{$item.Email}">{$item.Email|default:'-'}</a></td>
                <td class="celulaMenuST">{$item.Phone|default:'-'}</td>
                <td class="celulaMenuST">{$item.Mobile|default:'-'}</td>
                <td class="celulaMenuST">{$item.PostTypeName|default:'Best Jobs'}</td>
                <td class="celulaMenuST">{if $item.ImportStatus!='1'}<a
                        href="./?m=candidates&o=import&CvId={$key}&CityId={$smarty.get.CityId}&PostTypeId={$smarty.get.PostTypeId}&PostId={$smarty.get.PostId}&search_for={$smarty.get.search_for}&keyword={$smarty.get.keyword}&res_per_page={$smarty.get.res_per_page}">
                            Importa</a>{else}
                        <span style="color:#006600">Importat</span>
                    {/if}</td>

                {if !empty($personalisedlist.Job)}
                    {foreach from=$personalisedlist.Job key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'JobDomainID'}
                                {$jobdomains[$item.JobDomainID]}
                            {elseif $field == 'RequiredExperience'}
                                {$experiences[$item.RequiredExperience]|default:'&nbsp;'}
                            {elseif $field == 'JobType'}
                                {$jobtypes[$item.JobType]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center; display:none;">
                    <!--<a href="#" onclick="if (confirm('Esti sigur(a) ca vrei sa stergi acest job?')) window.location.href='./?m=candidates&o=del&JobID={$key}'; return false;">sterge</a></td>-->
                    <a href="#" onclick="window.location.href='./?m=candidates&o=delPre&JobID={$key}';">sterge</a></td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($candidates)==1}
        <tr height="30">
            <td style="text-align:center;" colspan="100" class="celulaMenuSTDR">
                <b style="color:#CC0000;">{translate label='FOLOSITI FILTRELE DE MAI SUS PENTRU AFISAREA REZULTATELOR!'}</b>
            </td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">
            <span class="TitleBoxDown">
            {if $candidates.0.page > 1}&laquo; <a href="{$request_uri}" class="white">prima</a>&nbsp;<a href="{$request_uri}&page={math equation="x-y" x=$candidates.0.page y=1}"
                                                                                                        class="white">{translate label='inapoi'}</a>{/if}
            pagina {$candidates.0.page} din {$candidates.0.pageNo}
                {if $candidates.0.page < $candidates.0.pageNo}<a href="{$request_uri}&page={math equation="x+y" x=$candidates.0.page y=1}" class="white">inainte</a>&nbsp;
                    <a href="{$request_uri}&page={$candidates.0.pageNo}" class="white">{translate label='ultima'}</a>
                    &raquo;{/if}
            </span>
        </td>
    </tr>
</table>

{literal}
    <script type="text/javascript">
        function getCv(cv_id) {
            document.getElementById('layer_candidates_review_content').innerHTML = '';
            showInfo(cv_id, 'layer_candidates_review_content');
            document.getElementById('layer_candidates_review').style.display = 'block';
            document.getElementById('layer_candidates_review_x').style.display = 'block';
        }
    </script>
    <script type="text/javascript">
        function PrintDiv(div_id) {
            var divToPrint = document.getElementById(div_id);
            var popupWin = window.open('', '_blank', 'width=800,height=600');
            popupWin.document.open();
            popupWin.document.write('<html><head><link href="images/{$theme}" rel="stylesheet" type="text/css"><link rel="stylesheet" href="images/layer.css" type="text/css"/></head><body onload="window.print()"><div class="layer_print" style="margin-left: 50px; margin-right: auto;"><div class="eticheta">HR Executive</div><h3 class="layer">Curiculum Vitae</h3><div style="font-family: helvetica;">' + divToPrint.innerHTML + '</div></div></body></html>');
            popupWin.document.close();

        }
    </script>
{/literal}
<!---->
