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
        <td class="bkdTitleMenu">{translate label="Masina"}</td>
        {if !empty($personalisedlist.CarCost)}
            {foreach from=$personalisedlist.CarCost key=field item=label}
                <td class="bkdTitleMenu">{translate label=$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label="Data cheltuiala"}</td>
            <td class="bkdTitleMenu">{translate label="Km"}</td>
            <td class="bkdTitleMenu">{translate label="Grupa cheltuiala"}</td>
            <td class="bkdTitleMenu">{translate label="Furnizor"}</td>
            <td class="bkdTitleMenu">{translate label="Valoare"}</td>
            <td class="bkdTitleMenu">{translate label="Moneda"}</td>
            <td class="bkdTitleMenu">{translate label="Document Nr"}</td>
            <td class="bkdTitleMenu">{translate label="Buget"}</td>
            <td class="bkdTitleMenu">{translate label="Angajat"}</td>
        {/if}
    </tr>
    {foreach from=$costs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$costs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$brands[$item.Brand]} {$item.Model} / {$item.RegNo}</td>
                {if !empty($personalisedlist.CarCost)}
                    {foreach from=$personalisedlist.CarCost key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">
                            {$item.$field|default:'-'}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.Date|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.Km}</td>
                    <td class="celulaMenuST">{$costgroups[$item.CostGroupID]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Cost}</td>
                    <td class="celulaMenuST">{$coins[$item.Coin]}</td>
                    <td class="celulaMenuST">{$item.ReceiptNo}</td>
                    <td class="celulaMenuST">{if $item.Budget == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuSTDR">{$item.FullName}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($costs)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>
</body>
</html>