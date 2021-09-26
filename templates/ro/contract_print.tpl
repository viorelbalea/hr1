<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export_doc'}
        <link href="images/style2.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" {if $smarty.get.action=='export_doc'} BORDER="1" {/if}>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume contract'}</span></td>
        {if !empty($personalisedlist.Contract)}
            {foreach from=$personalisedlist.Contract key=field item=label}
                <td class="bkdTitleMenu"><span class="TitleBox">{$label}</span></td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Tip contract'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Partener'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data inceput'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Data sfarsit'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Valoare'}</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox">{translate label='User'}</span></td>
        {/if}
    </tr>
    {foreach from=$contracts key=key item=item name=iter1}
        {if $key>0}
            <tr BGCOLOR="#F9F9F9" height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$contracts.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.ContractName}</td>
                {if !empty($personalisedlist.Contract)}
                    {foreach from=$personalisedlist.Contract key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last}DR{/if}">{$item.$field|default:'&nbsp;'}</td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.ContractType}</td>
                    <td class="celulaMenuST">{$item.CompanyName}</td>
                    <td class="celulaMenuST">{$item.StartDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.StopDate|date_format:'%d.%m.%Y'}</td>
                    <td class="celulaMenuST">{$item.ContractValue|default:'0'} {$item.Coin}</td>
                    <td class="celulaMenuSTDR">{$item.UserName}</td>
                {/if}
            </tr>
        {/if}
        {foreachelse}
        <tr height="30">
            <td colspan="9" style="border-bottom: 1px solid #999999; background-color: #FFFFFF;" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/foreach}
</table>

</body>
</html>