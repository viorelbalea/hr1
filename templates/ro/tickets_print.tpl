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
        <td class="bkdTitleMenu">{translate label='Cerere'}</td>
        {if !empty($personalisedlist.Ticket)}
            {foreach from=$personalisedlist.Ticket key=field item=label}
                <td class="bkdTitleMenu">{translate label=$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label='Nume'}</td>
            <td class="bkdTitleMenu">{translate label='Tip'}</td>
            <td class="bkdTitleMenu">{translate label='Status'}</td>
            <td class="bkdTitleMenu">{translate label='Comentarii'}</td>
            <td class="bkdTitleMenu">{translate label='Data'}</td>
            <td class="bkdTitleMenu">{translate label='Data limita'}</td>
        {/if}
    </tr>
    {foreach from=$tickets key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$tickets.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">
                    {if $item.TicketType==1}
                        {$item.Report}
                    {elseif $item.TicketType==2}
                        {$services[$item.ReportID]}
                    {elseif $item.TicketType==3}
                        {translate label='Vizualizeaza'}
                    {/if}
                </td>
                {if !empty($personalisedlist.Ticket)}
                    {foreach from=$personalisedlist.Ticket key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if $field == 'Status'}
                                {$status[$item.TicketStatus]|default:'-'}
                            {elseif $field == 'Type'}
                                {$types[$item.TicketType]|default:'-'}
                            {elseif $field == 'CreateDate'}
                                {$item.TCreateDate|default:'-'}
                            {elseif $field == 'LimitDate'}
                                {$item.TLimitDate|default:'-'}
                            {elseif $field == 'CompanyID'}
                                {$self[$item.CompanyID]|default:'-'}
                            {elseif $field == 'DivisionID'}
                                {$divisions[$item.DivisionID]|default:'-'}
                            {elseif $field == 'DepartmentID'}
                                {$departments[$item.DepartmentID]|default:'-'}
                            {elseif $field == 'SubDepartmentID'}
                                {$subdepartments[$item.SubDepartmentID]|default:'-'}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.FullName|default:'-'}</td>
                    <td class="celulaMenuST">{$types[$item.TicketType]|default:'-'}</td>
                    <td class="celulaMenuST">{$status[$item.TicketStatus]|default:'-'}</td>
                    <td class="celulaMenuST">{$item.Comments|default:'-'}</td>
                    <td class="celulaMenuST">{$item.TCreateDate|default:'-'}</td>
                    <td class="celulaMenuST">{$item.TLimitDate|default:'-'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($cars)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>