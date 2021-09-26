<html>
<head>
    <title>{translate label='HR Executive'}</title>
    <link href="images/style2.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="images/favicon.ico"/>
</head>
<body onLoad="window.print();">
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="padding-left: 10px; padding-right: 10px; border-top: 1px solid #EDEDED;">
            <h2>{$info.FullName}</h2>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="padding-top: 10px; padding-left: 10px; padding-right: 10px;">
            {foreach from=$induction key=key item=item}
                {if $key > 0}
                    <p><b>{$item.0.Capitol}</b></p>
                    <div style="padding-left: 70px;">
                        {foreach from=$item key=key2 item=item2}
                            {if $key2 > 0}
                                <p><input type="checkbox" name="Status[{$key}][{$key2}]" value="1" {if !empty($item2.Status)}checked{/if}> {$item2.Item}</p>
                            {/if}
                        {/foreach}
                        <p>
                            Responsabil: {$employees[$item.0.ResponsableID]}
                            &nbsp;&nbsp;&nbsp;
                            Data: {if !empty($item.0.CapitolDate) && $item.0.CapitolDate != '0000-00-00'}{$item.0.CapitolDate|date_format:"%d.%m.%Y"}{/if}
                        </p>
                        <p>&nbsp;</p>
                    </div>
                {/if}
            {/foreach}
        </td>
    </tr>
</table>
</body>
</html>