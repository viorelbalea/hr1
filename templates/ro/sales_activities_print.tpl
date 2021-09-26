<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%"{if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume Companie'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Responsabil'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Persoana contact'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Subiect'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Rezolutie'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Apelat'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='De apelat'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Necesar'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data creare'}</span></td>
    </tr>
    {foreach from=$activities key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$activities.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CompanyName|default:'-'}</td>
                <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                <td class="celulaMenuST">{$item.ContactName|default:'-'}<br/>{$item.ContactPhone}<br/>{$item.ContactPhone2}<br/>{$item.ContactEmail}<br/>{$item.ContactFunction}
                    <br/></td>
                <td class="celulaMenuST">{$activitySubject[$item.Subject]|default:'-'}</td>
                <td class="celulaMenuST">{$activityStatus[$item.Status2]|default:'-'}</td>
                <td class="celulaMenuST">{$item.Comment|default:'-'}</td>
                <td class="celulaMenuST">{$item.Date|default:'-'}</td>
                <td class="celulaMenuST">{$item.NextDate|default:'-'}</td>
                <td class="celulaMenuST">{$item.Comment2|default:'-'}</td>
                <td class="celulaMenuSTDR">{$item.CreateDate|default:'-'}</td>
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="9" style="border-bottom: 1px solid #999999; class=" celulaMenuSTDR
            ">{translate label='Nu sunt date'}!</td></tr>
    {/foreach}
</table>

</body>
</html>