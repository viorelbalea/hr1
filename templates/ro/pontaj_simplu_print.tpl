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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Persoane'}</span></td>
        {if !empty($personalisedlist.Pontaj)}
            {foreach from=$personalisedlist.Pontaj key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Email'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Telefon'}</span></td>
        {/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter}
        <tr height="30" BGCOLOR="#F9F9F9">
            <td class="celulaMenuST" width="30">{$smarty.foreach.iter.iteration}</td>
            <td class="celulaMenuST"><a href="./?m=pontaj&o=psimple&o=psimple_day&PersonID={$item.PersonID}" class="blue">{$item.FullName}</a></td>
            {if !empty($personalisedlist.Pontaj)}
                {foreach from=$personalisedlist.Pontaj key=field item=label name=iter1}
                    <td class="celulaMenuST{if $smarty.foreach.iter1.last}DR{/if}">
                        {if $field == 'DivisionID'}
                            {$divisions[$item.DivisionID]|default:'&nbsp;'}
                        {elseif $field == 'DepartmentID'}
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
                <td class="celulaMenuST">{$item.Email|default:'&nbsp;'}</td>
                <td class="celulaMenuSTDR">{$item.Phone|default:'&nbsp;'}</td>
            {/if}
        </tr>
    {/foreach}
</table>

</body>
</html>