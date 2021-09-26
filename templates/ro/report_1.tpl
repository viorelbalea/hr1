<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Scop'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=Scope&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=Scope&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Autor'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=UserName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=UserName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Reprezentant companie'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=FullName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=FullName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Detalii'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=Details&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=Details&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=EventStatus&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=EventStatus&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intre'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=EventRelation&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=EventRelation&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                                border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=EventType&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=EventType&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                            border="0"></a></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data'}</span>&nbsp;<a href="./?m=reports&rep=1&order_by=EventData&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=1&order_by=EventData&asc_or_desc=desc"><img src="./images/s_desc.png"
                                                                                                                                            border="0"></a></td>
    </tr>
    {foreach from=$events key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$smarty.foreach.iter.iteration}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;"><a href="./?m=events&o=edit&EventID={$key}" class="blue">{$item.Scope}</a></td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.UserName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Details|default:'&nbsp;'}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventStatus[$item.EventStatus]}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventRelation[$item.EventRelation]}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$eventType[$item.EventType]}</td>
            <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.fEventData}</td>
        </tr>
    {/foreach}
    {if count($events)==0}
        <tr height="30">
            <td colspan="10" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>
