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
        {if !empty($personalisedlist.Personal)}
            {foreach from=$personalisedlist.Personal key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Varsta'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='CNP'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
        {/if}
    </tr>
    {foreach from=$persons key=key item=item name=iter1}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$persons.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.FullName}</td>
                {if !empty($personalisedlist.Personal)}
                    {foreach from=$personalisedlist.Personal key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]}
                            {elseif $field == 'MaritalStatus'}
                                {$maritalstatus[$item.MaritalStatus]}
                            {elseif $field == 'CVStatus'}
                                {$cvstatus[$item.CVStatus]|default:'&nbsp;'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'&nbsp;'}
                            {elseif $field == 'CostCenterID'}
                                {$item.CostCenters|default:'&nbsp;'}
                            {elseif $field == 'JobDictionaryID'}
                                {$jobtitles[$item.JobDictionaryID]|default:'&nbsp;'}
                            {elseif $field == 'ContractType'}
                                {$contract_type[$item.ContractType]|default:'&nbsp;'}
                            {elseif $field == 'FunctionID'}
                                {$functions[$item.FunctionID].Function|default:'&nbsp;'} - {$functions[$item.FunctionID].COR|default:'&nbsp;'}
                            {elseif $field == 'InternalFunction'}
                                {$internal_functions[$item.InternalFunction]|default:'&nbsp;'}
                            {elseif $field == 'RoleID'}
                                {$roles[$item.RoleID]|default:'&nbsp;'}
                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.DistrictName}</td>
                    <td class="celulaMenuST">{$item.CityName}</td>
                    <td class="celulaMenuST">{$item.varsta|default:'&nbsp;'}</td>
                    <td class="celulaMenuST">{$item.CNP|default:'&nbsp;'}</td>
                    <td class="celulaMenuSTDR">{$status[$item.Status]}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>