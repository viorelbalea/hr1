<html>
<head>
    <title>{translate label='HR Suite'}</title>
</head>

<body onLoad="window.print();">

<h3>Obiective: {$FullName}</h3>

<table width="100%" cellspacing="0" cellpadding="4" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr>
        <td><b>{translate label='Dimeniunea HCM'}</b></td>
        <td><b>{translate label='Actiune / Obiectiv'}</b></td>
        <td align="center" width="120"><b>{translate label='Pondere'}</b></td>
        <td align="center" width="120"><b>{translate label='Termen'}</b></td>
        <td align="center" width="120"><b>{translate label='Status'}</b></td>
        <td width="180"><b>{translate label='Comentariu'}</b></td>
    </tr>
    {assign var="total" value="0"}
    {foreach from=$goals key=key item=item}
        <tr>
            <td width="220">{$dimensions[$item.DimensionID].Dimension}</td>
            <td width="300">{$item.Goal}</td>
            <td align="center" width="120">{$item.Pondere} %</td>
            <td align="center" width="120">{$item.Deadline}</td>
            <td align="center" width="120">{$status[$item.StatusID]}<br>{$item.StatusDate}</td>
            <td width="180">{$item.Comment}</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top: 1px solid #cccccc;">&nbsp;</td>
        </tr>
        {math equation="x+y" x=$total y=$item.Pondere assign="total"}
    {/foreach}
    <tr>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td align="center"><b>{$total} %</b></td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        <td>&nbsp;</td>
    </tr>
</table>

</body>
</html>