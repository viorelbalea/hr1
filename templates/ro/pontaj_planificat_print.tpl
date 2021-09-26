<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc' && $smarty.get.action!='export'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>

<body topmargin="5" onLoad="window.print();">

<table width="100%" cellspacing="0" cellpadding="4" class="filter">
    <tr valign="bottom">
        <td>&nbsp;</td>
        <td>&nbsp;</td>
        {assign var="ZL" value="0"}
        {foreach from=$cal key=data item=wday name=iter}
            <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{else}{math equation="x+1" x=$ZL assign="ZL"}{/if}>
                <b>{$smarty.foreach.iter.iteration}</b></td>
        {/foreach}
    </tr>
    <tr>
        <td width="20"><b>#</b></td>
        <td><b>{translate label='Nume prenume'}</b></td>
        {foreach from=$cal key=data item=wday}
            <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}><b>{$wday}</b></td>
        {/foreach}
    </tr>
    {foreach from=$persons key=persid item=item name=iter}
    {if $persid > 0}
    <tr bgcolor="#ffffff">
        <td style="border-top: 1px solid #000000;">{$smarty.foreach.iter.iteration-1}</td>
        <td style="border-top: 1px solid #000000;">{$item.FullName}</td>
        {foreach from=$cal key=data item=wday}
            <td style="border-top: 1px solid #000000;" align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>
                {$item.Data.$data|default:0}
            </td>
        {/foreach}
    <tr>
        {/if}
        {/foreach}
        {if $persons|@count <= 1}
    <tr>
        <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
    </tr>
    {/if}
</table>

</body>
</html>