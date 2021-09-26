{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
{foreach from=$info.Cars key=car_id item=inf}
    <br>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">
	{if $inf.StopDate > '0000-00-00' && $inf.StopDate < $smarty.now|date_format:'%Y-%m-%d'}
        {$inf.StartDate|date_format:'%d.%m.%Y'} : {if $inf.StopDate > '0000-00-00'}{$inf.StopDate|date_format:'%d.%m.%Y'}{else}-{/if} | {$brands[$inf.Brand]|default:'-'} | {$inf.Model|default:'-'} | {$inf.RegNo|default:'-'}
    {else}
        <a href="#" style="text-decoration: underline;"
           onclick="hstatus = document.getElementById('inf_{$car_id}').style.display; if (hstatus == 'none') Effect.SlideDown('inf_{$car_id}'); else Effect.SlideUp('inf_{$car_id}'); return false;">{$inf.StartDate|date_format:'%d.%m.%Y'} : {if $inf.StopDate > '0000-00-00'}{$inf.StopDate|date_format:'%d.%m.%Y'}{else}-{/if} | {$brands[$inf.Brand]|default:'-'} | {$inf.Model|default:'-'} | {$inf.RegNo|default:'-'}</a>
    {/if}
    </span></td>
        </tr>
    </table>
    <div id="inf_{$car_id}" style="display: none;">
        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
            <tr>
                <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;" width="50%">
                    <br>
                    <fieldset>
                        <legend>{translate label='General'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><b>{translate label='Tip vehicul'}:</b></td>
                                <td>{$cartypes[$inf.CarType]|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Marca'}:</b></td>
                                <td>{$brands[$inf.Brand]|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Model'}:</b></td>
                                <td>{$inf.Model|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Numar de inmatriculare'}:</b></td>
                                <td>{$inf.RegNo|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Data inmatricularii'}:</b></td>
                                <td>{if $inf.RegDate > '0000-00-00'}{$inf.RegDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
                <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px; padding-bottom: 10px;">
                    <br>
                    <fieldset>
                        <legend>{translate label='Detalii'}</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><b>{translate label='Culoare'}:</b></td>
                                <td>{$inf.Color|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='An fabricatie'}:</b></td>
                                <td>{$inf.Year|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Tip combustibil'}:</b></td>
                                <td>{$fuels[$inf.Fuel]|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Cilindree'}:</b></td>
                                <td>{$inf.Cylinders|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Putere'}:</b></td>
                                <td>{$inf.Power|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Cutie viteze'}:</b></td>
                                <td>{$gears[$inf.Gear]|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Numar de usi'}:</b></td>
                                <td>{$doors[$inf.DoorsNo]|default:'-'}</td>
                            </tr>
                            <tr>
                                <td><b>{translate label='Dimensiune anvelope'}:</b></td>
                                <td>{$inf.TireSize|default:'-'}</td>
                            </tr>
                        </table>
                    </fieldset>
    </div>
    </td>
    </tr>
    {if !empty($info.Assurance.$car_id)}
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend>{translate label='Asigurari'}</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        {foreach from=$info.Assurance.$car_id key=key item=item}
                            <tr>
                                <td colspan="8"><b>{$item.CostType}</b></td>
                            </tr>
                            <tr>
                                <td>{translate label='Valoare'}:</td>
                                <td>{$item.Cost} {$currencies[$item.Coin]}</td>
                                <td>{translate label='Companie'}:</td>
                                <td>{$item.CompanyName}</td>
                                <td>{translate label='Data inceput'}:</td>
                                <td>{if $item.StartDate > '0000-00-00'}{$item.StartDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                                <td>{translate label='Data expirare'}:</td>
                                <td>{if $item.StopDate > '0000-00-00'}{$item.StopDate|date_format:'%d.%m.%Y'}{else}-{/if}</td>
                            </tr>
                        {/foreach}
                    </table>
                </fieldset>
            </td>
        </tr>
    {/if}
    </table>
    </div>
{/foreach}

{if !empty($info.Sheets)}
    <br>
    <fieldset>
        <legend>{translate label='Foaie parcurs'}</legend>
        <table border="0" cellpadding="6" cellspacing="0" class="screen">
            <tr>
                <td><b>{translate label='Tip<br>vehicul'}</b></td>
                <td><b>{translate label='Marca'}</b></td>
                <td><b>{translate label='Model'}</b></td>
                <td><b>{translate label='Numar de<br>inmatriculare'}</b></td>
                <td><b>{translate label='Data<br>inmatricularii'}</b></td>
                <td><b>{translate label='Tip<br>combustibil'}</b></td>
                <td><b>{translate label='Consum mixt'}<br>(L/100km)</b></td>
                <td><b>{translate label='Consum urban'}<br>(L/100km)</b></td>
                <td></td>
            </tr>
            {foreach from=$info.Sheets key=car_id item=item}
            {assign var="inf" value=$item.0}
            <tr>
                <td><a href="#" style="text-decoration: underline;"
                       onclick="hstatus = document.getElementById('sheet_{$car_id}').style.display; if (hstatus == 'none') Effect.SlideDown('sheet_{$car_id}'); else Effect.SlideUp('sheet_{$car_id}'); return false;">{$cartypes[$inf.CarType]|default:'-'}</a>
                </td>
                <td>{$brands[$inf.Brand]|default:'-'}</td>
                <td>{$inf.Model|default:'-'}</td>
                <td>{$inf.RegNo|default:'-'}</td>
                <td>{$inf.RegDate|default:'-'}</td>
                <td>{$fuels[$inf.Fuel]|default:'-'}</td>
                <td align="center">{$inf.ConsumptionUrban|default:'-'}</td>
                <td align="center">{$inf.ConsumptionCombined|default:'-'}</td>
                <td>
                    <div id="sheet_{$car_id}" style="display: none;">
                        <table border="0" cellpadding="6" cellspacing="0" class="screen">
                            <tr>
                                <td>{translate label='Data<br>preluare'}</td>
                                <td>{translate label='Km<br>pornire'}</td>
                                <td>{translate label='Data<br>predare'}</td>
                                <td>{translate label='Km<br>predare'}</td>
                                <td>{translate label='Numar km<br>parcursi'}</td>
                                <td>{translate label='Numar<br>persoane'}</td>
                            </tr>
                            {foreach from=$item key=startdate item=item2}
                                {if $startdate != 0}
                                    <tr>
                                        <td>{$item2.StartDate|date_format:'%d.%m.%Y'}</td>
                                        <td>{$item2.StartDateKm}</td>
                                        <td>{$item2.StopDate|date_format:'%d.%m.%Y'}</td>
                                        <td>{$item2.StopDateKm}</td>
                                        <td>{math equation="x-y" x=$item2.StopDateKm y=$item2.StartDateKm}</td>
                                        <td>{$item2.PersNo}</td>
                                    </tr>
                                {/if}
                            {/foreach}
                        </table>
                    </div>
                </td>
            </tr>
        </table>
        {/foreach}
        </tsble>
    </fieldset>
{/if}