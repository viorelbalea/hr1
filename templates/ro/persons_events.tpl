{include file="persons_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="persons_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Intre'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip intalnire'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Scop'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Detalii'}</span></td>
    </tr>
    {foreach from=$events key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST">{$item.Data}</td>
            <td class="celulaMenuST">{$eventRelation[$item.EventRelation]}</td>
            <td class="celulaMenuST">{$eventType[$item.EventType]}</td>
            <td class="celulaMenuST">{$item.Scope}</td>
            <td class="celulaMenuSTDR">{$item.Details}</td>
        </tr>
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>
