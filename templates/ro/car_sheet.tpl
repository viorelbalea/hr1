{include file="car_sheet_menu.tpl"}

<div id="layer_foi" class="layer" style="display: none;">
    <div class="eticheta">
        {$eticheta}
    </div>
    <h3 class="layer">{translate label='Foaie de parcurs'}</h3>
    <div class="layerContent" id="layer_foi_content"></div>
</div>
<div id="layer_foi_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_foi').style.display = 'none'; document.getElementById('layer_foi_x').style.display = 'none'; window.location.reload();">x
</div>

<div class="filter">
    <label>{translate label='Cauta dupa'}:</label>
    <select id="CarID" name="CarID" class="cod">
        <option value="0">{translate label='Masina'}</option>
        {foreach from=$cars key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.CarID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Fuel" name="Fuel" class="cod">
        <option value="">{translate label='Combustibil'}</option>
        {foreach from=$fuels key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Fuel}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="DriverID" name="DriverID" class="cod">
        <option value="">{translate label='Sofer'}</option>
        {foreach from=$drivers key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.DriverID}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <select id="Scope" name="Scope" class="cod">
        <option value="">{translate label='Scop deplasare'}</option>
        {foreach from=$scopes key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Scope}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    <input type="button" value="{translate label='Cauta'}" class="cod" onclick="window.location.href = './?m=cars_sheet&o=sheet&CarID=' + document.getElementById('CarID').value +
																 '&Fuel=' + document.getElementById('Fuel').value + 
																 '&DriverID=' + document.getElementById('DriverID').value + 
																 '&Scope=' + document.getElementById('Scope').value + 
																 '&res_per_page=' + document.getElementById('res_per_page').value">
    {if $rw == 1}
        <input type="button" value="{translate label='Adauga foaie parcurs'}" onclick="getCost(0);">
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
                           onclick="popUp('./?m=settings&o=personalisedlist&list=CarSheet&type=popup','',250,400)">
                </li>
            </ul>
        </div>
    </div>
</div>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{orderby label="Masina" request_uri=$request_uri order_by=Brand asc_or_desc=asc}</td>
        {if !empty($personalisedlist.CarSheet)}
            {foreach from=$personalisedlist.CarSheet key=field item=label}
                <td class="bkdTitleMenu">{orderby label=$label request_uri=$request_uri order_by=$field}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{orderby label="Combustibil" request_uri=$request_uri order_by=Fuel}</td>
            <td class="bkdTitleMenu">{orderby label="Sofer" request_uri=$request_uri order_by=FullName}</td>
            <td class="bkdTitleMenu">{orderby label="Data plecare" request_uri=$request_uri order_by=StartDate}</td>
            <td class="bkdTitleMenu">{orderby label="Ora plecare" request_uri=$request_uri order_by=StartHour}</td>
            <td class="bkdTitleMenu">{orderby label="Km plecare" request_uri=$request_uri order_by=StartDateKm}</td>
            <td class="bkdTitleMenu">{orderby label="Data sosire" request_uri=$request_uri order_by=StopDate}</td>
            <td class="bkdTitleMenu">{orderby label="Ora sosire" request_uri=$request_uri order_by=StopHour}</td>
            <td class="bkdTitleMenu">{orderby label="Km sosire" request_uri=$request_uri order_by=StopDateKm}</td>
            <td class="bkdTitleMenu">{orderby label="Km parcursi" request_uri=$request_uri order_by=KmNo}</td>
            <td class="bkdTitleMenu">{orderby label="Numar persoane" request_uri=$request_uri order_by=PersonNo}</td>
            <td class="bkdTitleMenu">{orderby label="Scop deplasare" request_uri=$request_uri order_by=Scope}</td>
        {/if}
        {if $smarty.session.USER_ID==1}
            <td class="bkdTitleMenu" align="center"><span class="TitleBox">Sterge</span></td>
        {/if}
    </tr>
    {foreach from=$sheets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$sheets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{if $rw == 1}<a href="#" onclick="getCost({$key}); return false;" class="blue">{$brands[$item.Brand]} {$item.Model}
                        / {$item.RegNo}</a>{else}{$brands[$item.Brand]} {$item.Model} / {$item.RegNo}{/if}</td>
                {if !empty($personalisedlist.CarSheet)}
                    {foreach from=$personalisedlist.CarSheet key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Fuel'}
                                {$fuels[$item.Fuel]|default:'-'}
                            {elseif $field == 'DriverID'}
                                {$drivers[$item.DriverID]|default:'-'}
                            {elseif $field == 'Scope'}
                                {$scopes[$item.Scope]|default:'-'}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$fuels[$item.Fuel]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StartHour|default:'-'}</td>
                    <td class="celulaMenuST">{$item.StartDateKm}</td>
                    <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StopHour|default:'-'}</td>
                    <td class="celulaMenuST">{$item.StopDateKm}</td>
                    <td class="celulaMenuST">{$item.KmNo}</td>
                    <td class="celulaMenuST">{$item.PersonNo}</td>
                    <td class="celulaMenuST">{$scopes[$item.Scope]|default:'-'}</td>
                {/if}
                {if $smarty.session.USER_ID==1}
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('{translate label='Esti sigur(a) ca vrei sa stergi aceasta foaie de parcurs?'}')) window.location.href='./?m=cars_sheet&o=sheet&SheetID={$key}&save=1&del=1'; return false;">{translate label='sterge'}</a>
                    </td>{/if}
            </tr>
        {/if}
    {/foreach}
    {if count($sheets)==1}
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
        function getCost(sheetid) {
            document.getElementById('layer_foi_content').innerHTML = '';
            var curr_time = new Date().getTime();
            showInfo('./?m=cars_sheet&o=sheet&SheetID=' + sheetid + '&rnd=' + curr_time, 'layer_foi_content');
            document.getElementById('layer_foi').style.display = 'block';
            document.getElementById('layer_foi_x').style.display = 'block';
        }
    </script>
{/literal}
