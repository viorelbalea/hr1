<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume document'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Categorie'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Cod document'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Versiune'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Descriere'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data crearii'}</span></td>
    </tr>
    {foreach from=$docs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$docs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.DocName}</td>
                <td class="celulaMenuST">{$item.CatName}</td>
                <td class="celulaMenuST">{$item.DocCode}</td>
                <td class="celulaMenuST">{$item.DocVersion}</td>
                <td class="celulaMenuST">{$item.DocDescr|default:'&nbsp;'}</td>
                <td class="celulaMenuST{if $smarty.session.USER_ID!=1}DR{/if}">{$item.data}</td>
            </tr>
        {/if}
    {/foreach}
    {if count($docs)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>