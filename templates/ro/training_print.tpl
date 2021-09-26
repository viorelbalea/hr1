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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Denumite training'}</span></td>
        {if !empty($personalisedlist.Training)}
            {foreach from=$personalisedlist.Training key=field item=label name=iter1}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Companie'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Trainer'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Domeniu de activitate'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data de inceput'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data finala'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='User'}</span></td>
        {/if}
    </tr>
    {foreach from=$trainings key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$trainings.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.TrainingName}</td>
                {if !empty($personalisedlist.Training)}
                    {foreach from=$personalisedlist.Training key=field item=label name=iter1}
                        <td class="celulaMenuST{if $smarty.foreach.iter1.last}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]}

                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CompanyName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DistrictName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CityName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Domain}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.StartDate|date_format:"%d.%m.%Y"}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;" style="background-color: #FFFFFF;">{$item.StopDate|date_format:"%d.%m.%Y"}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;" style="background-color: #FFFFFF;">{$item.Status}</td>
                    <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;" style="background-color: #FFFFFF;">{$item.UserName}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>