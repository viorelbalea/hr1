<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.action!='export' && $smarty.get.action!='export_doc'}
        <link href="images/style2.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onload="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu">{translate label="Denumire produs"}</td>
        {if !empty($personalisedlist.Product)}
            {foreach from=$personalisedlist.Product key=field item=label}
                <td class="bkdTitleMenu">{translate label=$label}</td>
            {/foreach}
        {else}
            <td class="bkdTitleMenu">{translate label="Producator"}</td>
            <td class="bkdTitleMenu">{translate label="Categorie"}</td>
            <td class="bkdTitleMenu">{translate label="Promotie"}</td>
            <td class="bkdTitleMenu">{translate label="Second Hand"}</td>
            <td class="bkdTitleMenu">{translate label="Lichidare de stoc"}</td>
            <td class="bkdTitleMenu">{translate label="CustomProduct1"}</td>
            <td class="bkdTitleMenu">{translate label="CustomProduct2"}</td>
            <td class="bkdTitleMenu">{translate label="CustomProduct3"}</td>
        {/if}
    </tr>
    {foreach from=$products key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="(x-y)+(z-y)*t" x=$smarty.foreach.iter1.iteration y=1 z=$products.0.page t=$res_per_page}</td>
                <td class="celulaMenuST">{$item.Title}</td>
                {if !empty($personalisedlist.Product)}
                    {foreach from=$personalisedlist.Product key=field item=label name=iter}
                        <td class="celulaMenuST{if $smarty.foreach.iter.last && $smarty.session.USER_ID!=1}DR{/if}">
                            {if in_array($field, array('Promo', 'SecondHand', 'StocOff'))}
                                {if $item.$field == 1}Da{else}Nu{/if}
                            {else}
                                {$item.$field|default:'-'}
                            {/if}
                        </td>
                    {/foreach}
                {else}
                    <td class="celulaMenuST">{$item.Provider}</td>
                    <td class="celulaMenuST">{$item.Category}</td>
                    <td class="celulaMenuST">{if $item.Promo == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{if $item.SecondHand == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{if $item.StocOff == 1}Da{else}Nu{/if}</td>
                    <td class="celulaMenuST">{$item.CustomProduct1|default:'-'}</td>
                    <td class="celulaMenuST">{$item.CustomProduct2|default:'-'}</td>
                    <td class="celulaMenuSTDR">{$item.CustomProduct3|default:'-'}</td>
                {/if}
            </tr>
        {/if}
    {/foreach}
    {if count($products)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>