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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume campanie'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Cost Net'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Cost Brut'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data inceput'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data sfarsit'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data creare'}</span></td>
    </tr>
    {foreach from=$campaigns key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$campaigns.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.CampaignName|default:'-'}</td>
                <td class="celulaMenuST">{$campaignType[$item.Type]|default:'-'}</td>
                <td class="celulaMenuST">{$campaignStatus[$item.Status]|default:'-'}</td>
                <td class="celulaMenuST">{$item.CostNet|default:'-'}</td>
                <td class="celulaMenuST">{$item.Cost|default:'-'}</td>
                <td class="celulaMenuST">{$item.DateStart|default:'-'}</td>
                <td class="celulaMenuST">{$item.DateEnd|default:'-'}</td>
                <td class="celulaMenuST">{$item.CreateDate|default:'-'}</td>
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