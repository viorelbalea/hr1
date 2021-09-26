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
        <td class="bkdTitleMenu">{translate label="Asigurare"}</td>
        <td class="bkdTitleMenu">{translate label="Producator"}</td>
        <td class="bkdTitleMenu">{translate label="Data inceput"}</td>
        <td class="bkdTitleMenu">{translate label="Data expirare"}</td>
        <td class="bkdTitleMenu">{translate label="Document Nr"}</td>
        <td class="bkdTitleMenu">{translate label="Data document"}</td>
        <td class="bkdTitleMenu">{translate label="Km"}</td>
        <td class="bkdTitleMenu">{translate label="Furnizor"}</td>
        <td class="bkdTitleMenu">{translate label="Valoare"}</td>
        <td class="bkdTitleMenu">{translate label="Moneda"}</td>
        <td class="bkdTitleMenu">{translate label="Buget"}</td>
        <td class="bkdTitleMenu">{translate label="Angajat"}</td>
    </tr>
    {foreach from=$costs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$costs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CostType}</td>
                <td class="celulaMenuST">{$item.Producer} {$item.Properties}</td>
                <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.ReceiptNo}</td>
                <td class="celulaMenuST">{$item.Date|date_format:'%d.%m.%Y'|default:'-'}</td>
                <td class="celulaMenuST">{$item.Km}</td>
                <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>
                <td class="celulaMenuST">{$item.Cost}</td>
                <td class="celulaMenuST">{$coins[$item.Coin]}</td>
                <td class="celulaMenuST">{if $item.Budget == 1}Da{else}Nu{/if}</td>
                <td class="celulaMenuSTDR">{$item.FullName}</td>
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