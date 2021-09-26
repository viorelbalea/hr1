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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Divizie'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Departament'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Dimensiune'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Actiune'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Manager'}</span></td>
    </tr>
    {foreach from=$actions key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$actions.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$divisions[$item.DivisionID].Division|default:'&nbsp;'}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$departments[$item.DepartmentID].Department|default:'&nbsp;'}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$dimensions[$item.DimensionID].Dimension}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Goal}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$status[$item.StatusID]}</td>
                <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
            </tr>
        {/if}
    {/foreach}
    {if count($actions)==1}
        <tr height="30">
            <td colspan="7" class="celulaMenuSTDR">{translate label='Nici o actiune!'}</td>
        </tr>
    {/if}
</table>

</body>
</html>