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
        <td class="bkdTitleMenu"><span class="TitleBox">Nume</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Post</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">E-mail</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Telefon</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Mobil</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Sursa</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">Status</span></td>
    </tr>
    {foreach from=$candidates key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=1}</td>
                <td class="celulaMenuST">{$item.FirstName} {$item.LastName}</td>
                <td class="celulaMenuST">{$item.PostName}</td>
                <td class="celulaMenuST">{$item.Email}</td>
                <td class="celulaMenuST">{$item.Phone}</td>
                <td class="celulaMenuST">{$item.Mobile}</td>
                <td class="celulaMenuSTDR">{$item.PostTypeName}</td>
                <td class="celulaMenuSTDR">{if $item.ImportStatus!='1'}Neimportat{else}Importat{/if}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">Nici un candidat!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>