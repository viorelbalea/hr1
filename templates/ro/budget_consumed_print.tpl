<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.print=='1'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">
<table cellspacing="0" cellpadding="0" width="100%">
    <tr>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid_raport" bgcolor='#EBEBEB'>
                {$report_html}
            </table>
        </td>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid grid_raport" bgcolor='#EBEBEB' style="border-left:solid 1px #000;">
                {$report_html2}
            </table>
        </td>
        <td valign="top">
            <table cellspacing="0" cellpadding="4" width="100%" class="grid grid_raport" bgcolor='#EBEBEB' style="border-left:solid 1px #000;">
                {$report_html3}
            </table>
        </td>
    </tr>
</table>
</body>