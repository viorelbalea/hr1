<html>
<head>
    <title>{translate label='HR Suite'}</title>
</head>

<body onLoad="window.print();">

<h3>{translate label='Istoric plan actiuni'}: {$FullName}</h3>

<table width="100%" cellspacing="0" cellpadding="4" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td><b>{translate label='Dimeniunea HCM'}</b></td>
        <td><b>{translate label='Actiune / Obiectiv'}</b></td>
        <td align="center" width="120"><b>{translate label='Termen'}</b></td>
        <td align="center" width="120"><b>{translate label='Status'}</b></td>
        <td width="180"><b>{translate label='Comentariu'}</b></td>
    </tr>
    {foreach from=$plan item=item}
        <tr BGCOLOR="#F9F9F9">
            <td width="220">{$dimensions[$item.DimensionID].Dimension}</td>
            <td width="300">{$item.Goal}</td>
            <td align="center" width="120">{$item.Deadline}</td>
            <td align="center" width="120">{$status[$item.StatusID]}<br>{$item.StatusDate}</td>
            <td width="180">{$item.Comment}</td>
        </tr>
        <tr>
            <td colspan="6" style="border-top: 1px solid #cccccc;">&nbsp;</td>
        </tr>
    {/foreach}
</table>

</body>
</html>