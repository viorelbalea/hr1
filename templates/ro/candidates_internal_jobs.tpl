{include file="candidates_menu.tpl"}
<table border="0" cellpadding="4" cellspacing="0" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox">{include file="candidates_submenu.tpl"}</span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox">{$info.FullName}</span></td>
    </tr>
</table>
<br>
<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='JobTitle'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Angajator'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data inceput'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data sfarsit'}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Status'}</span></td>
    </tr>
    {foreach from=$jobs key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST">{$item.JobTitle}</td>
            <td class="celulaMenuST">{$item.CompanyName}</td>
            <td class="celulaMenuST">{$item.start_date}</td>
            <td class="celulaMenuST">{$item.stop_date}</td>
            <td class="celulaMenuSTDR">{$item.status}
                {if isset($item.expertiza)} |
                    <a href="#"
                       onclick="window.open('./?m=jobs&o=alloc-candidates&JobID={$item.JobID}&action=options&PersonID={$smarty.get.PersonID}', 'options', 'scrollbars=yes, width=600, height=600'); return false;">{translate label='expertiza'}</a>
                {/if}
            </td>
        </tr>
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>
