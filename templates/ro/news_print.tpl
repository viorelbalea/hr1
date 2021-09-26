<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Titlu stire'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data crearii'}</span></td>
    </tr>
    {foreach from=$news key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$news.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.Title}</td>
                <td class="celulaMenuSTDR">{$item.data}</td>
            </tr>
        {/if}
    {/foreach}
    {if count($news)==0}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>