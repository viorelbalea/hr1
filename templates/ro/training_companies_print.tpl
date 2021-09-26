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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume companie'}</span></td>
        {if !empty($personalisedlist.Company)}
            {foreach from=$personalisedlist.Company key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Training'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Domeniu de activitate'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='CIF'}</span></td>
        {/if}
    </tr>
    {foreach from=$companies key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$companies.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CompanyName}</td>
                {if !empty($personalisedlist.Company)}
                    {foreach from=$personalisedlist.Company key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}" style=" border-bottom: 1px solid #999999;">{$item.$field|default:'&nbsp;'}</td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.TrainingNotes|default:'-'}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DistrictName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CityName|default:'-'}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Domain}</td>
                    <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.CIF|default:'&nbsp;'}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="7" class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>