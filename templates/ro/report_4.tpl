<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume companie'}</span>&nbsp;<a href="./?m=reports&rep=4&order_by=CompanyName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=4&order_by=CompanyName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span>&nbsp;<a href="./?m=reports&rep=4&order_by=DistrictName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=4&order_by=DistrictName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span>&nbsp;<a href="./?m=reports&rep=4&order_by=CityName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=4&order_by=CityName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Domeniu de activitate'}</span>&nbsp;<a href="./?m=reports&rep=4&order_by=Domain&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=4&order_by=Domain&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='CIF'}</span>&nbsp;<a href="./?m=reports&rep=4&order_by=CIF&asc_or_desc=asc"><img src="./images/s_asc.png"
                                                                                                                                                           border="0"></a>&nbsp;<a
                    href="./?m=reports&rep=4&order_by=CIF&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
    </tr>
    {foreach from=$companies key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$smarty.foreach.iter.iteration}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;"><a href="./?m=companies&o=edit&CompanyID={$key}" class="blue">{$item.CompanyName}</a></td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DistrictName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CityName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.Domain}</td>
            <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.CIF|default:'&nbsp;'}</td>
        </tr>
    {/foreach}
    {if count($companies)==0}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>    
