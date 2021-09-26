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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume'}</span></td>
        {if !empty($personalisedlist.Performance)}
            {foreach from=$personalisedlist.Performance key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Email'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Dimensiune'}</span></td>
        {/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
                {if !empty($personalisedlist.Performance)}
                    {foreach from=$personalisedlist.Performance key=field item=label name=iter}
                        <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">
                            {if $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'CostCenterID'}
                                {$item.CostCenters|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DistrictName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CityName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Email|default:'&nbsp;'}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DimensionID|default:'&nbsp;'}</td>
                {/if}
            </tr>
        {/if}
        {if count($persons)==1}
            <tr height="30">
                <td colspan="100" class="celulaMenuSTDR">{translate label='Nici o persoana!'}</td>
            </tr>
        {/if}
    {/foreach}
</table>

</body>
</html>