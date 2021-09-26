<html>
<head>
    <title>HR Suite</title>
    {if $smarty.get.action!='export_doc' && $smarty.get.action!='export'}
        <link href="images/{$theme}" rel="stylesheet" type="text/css">
        <link rel="shortcut icon" href="images/favicon.ico"/>
    {/if}
</head>
<body onload="window.print();">
{include file="pontaj_reports_"|cat:$smarty.get.report_id|cat:".tpl"}
</body>
</html>