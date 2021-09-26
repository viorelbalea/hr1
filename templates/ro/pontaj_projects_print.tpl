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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Denumire proiect'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Partener'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Cod proiect'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data de inceput'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data de incheiere'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Statut'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Faza'}</span></td>
    </tr>
    {foreach from=$projects key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$projects.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.Name}</td>
                <td class="celulaMenuST">{$item.CompanyName|default:'&nbsp;'}</td>
                <td class="celulaMenuST">{$item.Code}</td>
                <td class="celulaMenuST">{$item.start_date}</td>
                <td class="celulaMenuST">{$item.end_date}</td>
                <td class="celulaMenuST">{$types[$item.Type]}</td>
                <td class="celulaMenuSTDR">{$phases[$item.Phase]}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="9" style="border-bottom: 1px solid #999999; background-color: #FFFFFF;" class="celulaMenuSTDR">{translate label='Nici o proiect!'}</td>
        </tr>
    {/foreach}
</table>

</body>
</html>