<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
</head>
<body topmargin="5" {if !empty($smarty.get.print)}onLoad="window.print();"{/if}>
<table cellspacing="0" cellpadding="0" height="30">
    {if empty($smarty.get.print)}
        <tr>
            <td align="right" style="padding-right: 4px;" width="300">
                <input type="button" onClick="window.open('{$smarty.server.REQUEST_URI}&print=1', 'print')" value="Printeaza">&nbsp;
            </td>
        </tr>
    {/if}
    <tr>
        <td align="left" style="padding-right: 4px;" width="300">
            <img src="{$budget_graph}"/>
        </td>
    </tr>
</table>
</body>