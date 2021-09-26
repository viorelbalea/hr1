<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export' && $smarty.get.action!='export_doc'}
        <link href="images/style2.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">
<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{translate label="Masina"}</td>
        {if !empty($personalisedlist.CarSheet)}
            {foreach from=$personalisedlist.CarSheet key=field item=label}
                <td class="bkdTitleMenu">{translate label=$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label="Combustibil"}</td>
            <td class="bkdTitleMenu">{translate label="Sofer"}</td>
            <td class="bkdTitleMenu">{translate label="Data plecare"}</td>
            <td class="bkdTitleMenu">{translate label="Ora plecare"}</td>
            <td class="bkdTitleMenu">{translate label="Km plecare"}</td>
            <td class="bkdTitleMenu">{translate label="Data sosire"}</td>
            <td class="bkdTitleMenu">{translate label="Ora sosire"}</td>
            <td class="bkdTitleMenu">{translate label="Km sosire"}</td>
            <td class="bkdTitleMenu">{translate label="Km parcursi"}</td>
            <td class="bkdTitleMenu">{translate label="Numar persoane"}</td>
            <td class="bkdTitleMenu">{translate label="Scop deplasare"}</td>
        {/if}
    </tr>
    {foreach from=$sheets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$sheets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$brands[$item.Brand]} {$item.Model} / {$item.RegNo}</td>
                {if !empty($personalisedlist.CarSheet)}
                    {foreach from=$personalisedlist.CarSheet key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">
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
                    <td class="celulaMenuST">{$item.FullName}</td>
                    <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StartHour}</td>
                    <td class="celulaMenuST">{$item.StartDateKm}</td>
                    <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StopHour}</td>
                    <td class="celulaMenuST">{$item.StopDateKm}</td>
                    <td class="celulaMenuST">{$item.KmNo}</td>
                    <td class="celulaMenuST">{$item.PersonNo}</td>
                    <td class="celulaMenuSTDR">{$scopes[$item.Scope]|default:'-'}</td>
                {/if}
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

</body>
</html>