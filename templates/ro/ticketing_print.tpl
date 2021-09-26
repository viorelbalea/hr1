<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export' && $smarty.get.action!='export_doc'}
        <link href="images/style2.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">ID</td>
        {if !empty($personalisedlist.Ticketing)}
            {foreach from=$personalisedlist.Ticketing key=field item=label}
                <td class="bkdTitleMenu">{$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label='Tip'}</td>
            <td class="bkdTitleMenu">{translate label='Status'}</td>
            <td class="bkdTitleMenu">{translate label='Prioritate'}</td>
            <td class="bkdTitleMenu">{translate label='Importanta'}</td>
            <td class="bkdTitleMenu">{translate label='Data crearii'}</td>
        {/if}
    </tr>
    {foreach from=$tickets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$tickets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.Author}</td>
                {if !empty($personalisedlist.Ticketing)}
                    {foreach from=$personalisedlist.Ticketing key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.Status]|default:'-'}
                            {elseif $field == 'CategoryID'}
                                {$categories[$item.CategoryID]|default:'-'}
                            {elseif $field == 'Type'}
                                {$types[$item.Type]|default:'-'}
                            {elseif $field == 'Priority'}
                                {$priority[$item.Priority]|default:'-'}
                            {elseif $field == 'Importance'}
                                {$importance[$item.Importance]|default:'-'}
                            {elseif $field == 'CreateDate'}
                                {$item.CreateDate|default:'-'}
                            {elseif $field == 'CompanyID'}
                                {$companies[$item.CompanyID].CompanyName|default:'-'}
                            {elseif $field == 'ProjectID'}
                                {$projects[$item.ProjectID]|default:'-'}
                            {elseif $field == 'AppVersionID'}
                                {$item.DisplayVersion|default:'-'}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$types[$item.Type]|default:'-'}</td>
                    <td class="celulaMenuST">{$status[$item.Status]|default:'-'}</td>
                    <td class="celulaMenuST">{$priority[$item.Priority]|default:'-'}</td>
                    <td class="celulaMenuST">{$importance[$item.Importance]|default:'-'}</td>
                    <td class="celulaMenuDR">{$item.CreateDate|date_format:'%d.%m.%Y'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($tickets)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu">{$pagination}</td>
    </tr>
</table>

</body>
</html>