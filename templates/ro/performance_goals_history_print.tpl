<html>
<head>
    <title>{translate label='HR Suite'}</title>
</head>

<body onLoad="window.print();">

<h3>{translate label='Istoric obiective'}: {$FullName}</h3>

<table width="100%" cellspacing="0" cellpadding="4">
    <tr>
        <td><b>{translate label='Dimeniunea HCM'}</b></td>
        <td><b>{translate label='Actiune / Obiectiv'}</b></td>
        <td align="center" width="120"><b>{translate label='Pondere'}</b></td>
        <td align="center" width="120"><b>{translate label='Termen'}</b></td>
        <td align="center" width="120"><b>{translate label='Status'}</b></td>
        <td width="180"><b>{translate label='Comentariu'}</b></td>
    </tr>
    {foreach from=$goal item=item}
        <tr>
            <td width="200">{$dimensions[$item.DimensionID].Dimension}</td>
            <td width="300">{$item.Goal}</td>
            <td align="center" width="120">{$item.Pondere} %</td>
            <td align="center" width="120">{$item.Deadline}</td>
            <td align="center" width="120">{$status[$item.StatusID]}<br>{$item.StatusDate}</td>
            <td width="180">{$item.Comment}</td>
        </tr>
        <tr>
            <td colspan="7" style="border-top: 1px solid #cccccc;">&nbsp;</td>
        </tr>
    {/foreach}
</table>

</body>
</html>