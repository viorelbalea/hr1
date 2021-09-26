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
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Scop'}</span></td>
        {if !empty($personalisedlist.Event)}
            {foreach from=$personalisedlist.Event key=field item=label name=iter1}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Autor'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Reprezentant companie'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Detalii'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intre'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data'}</span></td>
        {/if}
    </tr>
    {foreach from=$events key=key item=item name=iter}
        {if $key>0}
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter.iteration y=1 z=$events.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.Scope}</td>
                {if !empty($personalisedlist.Event)}
                    {foreach from=$personalisedlist.Event key=field item=label name=iter1}
                        <td class="celulaMenuST{if $smarty.foreach.iter1.last}DR{/if}">
                            {if $field == 'ConsultantID'}
                                {$consultants[$item.ConsultantID]}
                            {elseif $field == 'EventStatus'}
                                {$eventStatus[$item.EventStatus]}

                            {elseif $field == 'EventType'}
                                {$eventType[$item.EventType]}

                            {elseif $field == 'EventRelation'}
                                {$eventRelation[$item.EventRelation]|default:'&nbsp;'}

                            {else}
                                {$item.$field|default:'&nbsp;'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.UserName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Details}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventStatus[$item.EventStatus]}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventRelation[$item.EventRelation]|default:'&nbsp;'}</td>
                    <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventType[$item.EventType]}</td>
                    <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.fEventData}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="9" class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>