<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc' && $smarty.get.action!='export'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">


<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{translate label='Functie'}</span></td>

        <td>
            <table cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox">{translate label='Companie'}</span></td>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox">{translate label='Functie superioara'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox">{translate label='Pozitii definite'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox">{translate label='Pozitii ocupate'}</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox">{translate label='Pozitii libere'}</span></td>
                    <td class="bkdTitleMenu" width="80"><span class="TitleBox">{translate label='Vechime in companie (ani)'}</span></td>
                    <td class="bkdTitleMenu" width="80"><span class="TitleBox">{translate label='Vechime in functie (ani)'}</span></td>
                </tr>
            </table>
        </td>
    </tr>
    {foreach from=$functions key=key item=item name=iter1}
        {if $key>0}
            <tr height="30">
                <td class="celulaMenuST">{math equation="x-y" x=$smarty.foreach.iter1.iteration y=1}</td>
                <td class="celulaMenuST">{$item.Function}</td>
                <td class="celulaMenuSTDR">
                    {if $item.Companies}
                        <table cellspacing="0" cellpadding="2" width="100%">
                            {foreach from=$item.Companies item=c name=iter2}
                                <tr>
                                    <td width="200" class="celulaMenuST"
                                        style="border-left:none; {if $smarty.foreach.iter2.last}border-bottom:none;{/if}">{$c.CompanyName|default:'&nbsp;'}</td>
                                    <td width="200" class="celulaMenuST"
                                        {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$parent_functions[$c.ParentFunctionID]|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST" {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.Positions|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST" {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.PositionsOccupied|default:'&nbsp;'}</td>
                                    <td width="70" class="celulaMenuST" {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.PositionsFree|default:'&nbsp;'}</td>
                                    <td width="80" class="celulaMenuST" {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.CompanyAge|default:'&nbsp;'}</td>
                                    <td width="80" class="celulaMenuST" {if $smarty.foreach.iter2.last}style="border-bottom:none;"{/if}>{$c.TotalAge|default:'&nbsp;'}</td>
                                </tr>
                            {/foreach}
                        </table>
                    {else}
                        &nbsp;
                    {/if}
                </td>
                <!--
        <td class="celulaMenuST">{$item.Department|default:'&nbsp;'}</td>
        <td class="celulaMenuST">{$parent_functions[$item.ParentFunctionID]|default:'&nbsp;'}</td>
        <td class="celulaMenuST">{$item.Positions|default:'&nbsp;'}</td>
		<td class="celulaMenuST">{$item.PositionsOccupied|default:'&nbsp;'}</td>
		<td class="celulaMenuST">{$item.PositionsFree|default:'&nbsp;'}</td>
		<td class="celulaMenuST">{$item.CompanyAge|default:'&nbsp;'}</td>
		<td class="celulaMenuSTDR">{$item.TotalAge|default:'&nbsp;'}</td>
		-->
            </tr>
        {/if}
    {/foreach}
    {if count($functions)==1}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>

</body>
</html>