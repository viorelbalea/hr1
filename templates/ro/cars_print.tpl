<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export' && $smarty.get.action!='export_doc'}
        <link href="images/style2.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onload="window.print();">
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip vehicul'}</span></td>
        {if !empty($personalisedlist.Car)}
            {foreach from=$personalisedlist.Car key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{translate label=$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label='Marca'}</td>
            <td class="bkdTitleMenu">{translate label='Model'}</td>
            <td class="bkdTitleMenu">{translate label='Numar inmatriculare'}</td>
            <td class="bkdTitleMenu">{translate label='Combustibil'}</td>
            <td class="bkdTitleMenu">{translate label='Cutie viteze'}</td>
            <td class="bkdTitleMenu">{translate label='An fabricatie'}</td>
            <td class="bkdTitleMenu">{translate label='Culoare'}</td>
        {/if}
    </tr>
    {foreach from=$cars key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$cars.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$cartypes[$item.CarType]}</td>
                {if !empty($personalisedlist.Car)}
                    {foreach from=$personalisedlist.Car key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Brand'}
                                {$brands[$item.Brand]|default:'-'}
                            {elseif $field == 'Fuel'}
                                {$fuels[$item.Fuel]|default:'-'}
                            {elseif $field == 'Gear'}
                                {$gears[$item.Gear]|default:'-'}
                            {elseif $field == 'Resp'}
                                {foreach from=$item.Resp item=FullName}{$FullName|default:'-'}<br>{/foreach}
                            {elseif $field == 'Status'}
                                {if $item.Status == 2}{translate label='Inactiv'}{else}{translate label='Activ'}{/if}
                            {elseif $field == 'Patrimony'}
                                {if $item.Status == 2}{translate label='Nu'}{else}{translate label='Da'}{/if}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$brands[$item.Brand]}</td>
                    <td class="celulaMenuST">{$item.Model|default:'-'}</td>
                    <td class="celulaMenuST">{$item.RegNo|default:'-'}</td>
                    <td class="celulaMenuST">{$fuels[$item.Fuel]|default:'-'}</td>
                    <td class="celulaMenuST">{$gears[$item.Gear]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Year|default:'-'}</td>
                    <td class="celulaMenuSTDR">{$item.Color|default:'-'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($cars)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>