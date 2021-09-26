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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Responsabil'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data creare'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Apeluri noi'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Apeluri revenire'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intalniri noi'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intalniri revenire'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intalniri efectuate'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Recomandari'}</span></td>
    </tr>
    {foreach from=$dailies key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$dailies.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                <td class="celulaMenuST">{$item.CreateDate|default:'-'}</td>
                <td class="celulaMenuST">{$item.CallsNew|default:'-'}</td>
                <td class="celulaMenuST">{$item.CallsBack|default:'-'}</td>
                <td class="celulaMenuST">{$item.MeetingsNew|default:'-'}</td>
                <td class="celulaMenuST">{$item.MeetingsBack|default:'-'}</td>
                <td class="celulaMenuST">{$item.MeetingsDone|default:'-'}</td>
                <td class="celulaMenuST">{$item.Reccos|default:'-'}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="9" style="border-bottom: 1px solid #999999; background-color: #FFFFFF;" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>