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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='JobTitle '}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Companie '}</span></td>
        {if !empty($personalisedlist.Job)}
            {foreach from=$personalisedlist.Job key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Localitate'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Numar candidati'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data de inceput'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data de sfarsit'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
        {/if}
    </tr>
    {foreach from=$jobs key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"
                    style="border-bottom: 1px solid #999999;">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$jobs.0.page t=$res_per_page}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.JobTitle}</td>
                <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CompanyName}</td>
                {if !empty($personalisedlist.Job)}
                    {foreach from=$personalisedlist.Job key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}" style="border-bottom: 1px solid #999999;">
                            {if $field == 'JobDomainID'}
                                {$jobdomains[$item.JobDomainID]}
                            {elseif $field == 'RequiredExperience'}
                                {$experiences[$item.RequiredExperience]|default:'&nbsp;'}
                            {elseif $field == 'JobType'}
                                {$jobtypes[$item.JobType]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'FunctionIDRecr'}
                                {$functions_recr[$item.FunctionIDRecr]|default:'&nbsp;'}
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
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.no_persons}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.start_date}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.stop_date}</td>
                    <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.status}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>