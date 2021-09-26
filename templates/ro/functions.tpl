{include file="functions_menu.tpl"}
<div class="filter">
    <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Companie'}</option>
        {foreach from=$companies key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
        <option value="0">{translate label='Functie superioara'}</option>
        {foreach from=$parent_functions key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.ParentFunctionID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="search_for" nume="search_for" class="cod">
        <option value="">{translate label='cuvant cheie in'}</option>
        <option value="name"
                {if $smarty.get.search_for == 'name'}selected{/if}>{translate label='Nume functie'}</option>
    </select>
    <input type="text" id="keyword" name="keyword" value="{$smarty.get.keyword|default:''}" size="20"
           maxlength="30" class="cod" onkeypress="if(getKeyUnicode(event)==13) filterList();">
    <select id="res_per_page" nume="res_per_page" class="cod">
        {foreach from=$res_per_pages item=item}
            <option value="{$item}"
                    {if (empty($smarty.get.res_per_page) && $res_per_page == $item) || $smarty.get.res_per_page == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <label>inregistrari</label>
    <input type="button" value="Cauta" class="cod" onclick="filterList();">
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .xls"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export'">
                </li>
                <li>
                    <input type="button" class="cod exportFile" value="Export .doc"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=export_doc'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza pagina'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_page'">
                </li>
                <li>
                    <input type="button" class="cod printFile" value="{translate label='Printeaza tot'}"
                           onclick="window.location.href='{$smarty.server.REQUEST_URI}&action=print_all'">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span
                    class="TitleBox">{orderby label='Functie' request_uri=$request_uri order_by=a.Function asc_or_desc=asc}</span>
        </td>
        <td>
            <table cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox">{translate label='Companie'}</span></td>
                    <td class="bkdTitleMenu" width="200"><span
                                class="TitleBox">{translate label='Functie superioara'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span
                                class="TitleBox">{translate label='Pozitii definite'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span
                                class="TitleBox">{translate label='Pozitii ocupate'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox">{translate label='Pozitii libere'}</span>
                    </td>
                    <td class="bkdTitleMenu" width="80"><span
                                class="TitleBox">{translate label='Vechime in companie (ani)'}</span></td>
                    <td class="bkdTitleMenu" width="80"><span
                                class="TitleBox">{translate label='Vechime in functie (ani)'}</span></td>
                </tr>
            </table>
        </td>
    </tr>
    {foreach from=$functions key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$functions.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    <a href="./?m=functions&o=edit&FunctionID={$item.InternalFunctionID}"
                       class="blue">{$item.Function}{if $item.FunctionObs != ''}&nbsp;&nbsp;<i>({$item.FunctionObs})</i>{/if}</a>
                </td>
                <td class="celulaMenuSTDR">
                    {if $item.Companies}
                        <table cellspacing="0" cellpadding="2" width="100%">
                            {foreach from=$item.Companies item=c name=iter2}
                                <tr>
                                    <td width="200" class="celulaMenuST"
                                        style="border-left:none; {if $smarty.foreach.iter2.last}border-bottom:none;{/if}">{$c.CompanyName|default:'&nbsp;'}</td>
                                    <td width="200" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$parent_functions[$c.ParentFunctionID]|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.Positions|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.PositionsOccupied|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.PositionsFree|default:'&nbsp;'}</td>
                                    <td width="80" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.CompanyAge|default:'&nbsp;'}</td>
                                    <td width="80" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.TotalAge|default:'&nbsp;'}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {else}
                        &nbsp;
                    {/if}
                </td>
            </tr>
        {/if}
    {/foreach}
    {if count($functions)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>
<script type="text/javascript">
    function filterList() {ldelim}
        window.location.href = './?m=functions&ParentFunctionID=' + document.getElementById('ParentFunctionID').value +
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&search_for=' + document.getElementById('search_for').value + '&keyword=' + escape(document.getElementById('keyword').value) + '&res_per_page=' + document.getElementById('res_per_page').value



        {rdelim}
</script>