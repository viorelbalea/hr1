<table cellspacing="0" cellpadding="2" width="100%" class="grid">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Nume'}</span>&nbsp;<a href="./?m=reports&rep=8&order_by=FullName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=8&order_by=FullName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Judet'}</span>&nbsp;<a href="./?m=reports&rep=8&order_by=DistrictName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=8&order_by=DistrictName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Oras'}</span>&nbsp;<a href="./?m=reports&rep=8&order_by=CityName&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=8&order_by=CityName&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Varsta'}</span>&nbsp;<a href="./?m=reports&rep=8&order_by=varsta&asc_or_desc=asc"><img
                        src="./images/s_asc.png" border="0"></a>&nbsp;<a href="./?m=reports&rep=8&order_by=varsta&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a>
        </td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='CNP'}</span>&nbsp;<a href="./?m=reports&rep=8&order_by=CNP&asc_or_desc=asc"><img src="./images/s_asc.png"
                                                                                                                                                           border="0"></a>&nbsp;<a
                    href="./?m=reports&rep=8&order_by=CNP&asc_or_desc=desc"><img src="./images/s_desc.png" border="0"></a></td>
    </tr>
    {foreach from=$persons key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$smarty.foreach.iter.iteration}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;"><a href="./?m=persons&o=edit&PersonID={$key}" class="blue">{$item.FullName}</a></td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.DistrictName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.CityName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.varsta|default:'&nbsp;'}</td>
            <td class="celulaMenuSTDR" style="border-bottom: 1px solid #999999;">{$item.CNP|default:'&nbsp;'}</td>
        </tr>
    {/foreach}
    {if count($persons)==0}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>