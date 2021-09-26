<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.action!='export_doc' && $smarty.get.action!='export'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>


<body topmargin="5" onLoad="window.print();">

<table width="100%" cellspacing="0" cellpadding="4" class="filter">
    <!--        <tr>
            <td class="celulaMenuST"><b>{translate label='Departament'}</b></td>
            <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;"><b>{translate label='Data'}</b></td>
            <td class="celulaMenuST">&nbsp;</td>
            {foreach from=$hours item=hour name=hfor}
                {if $smarty.foreach.hfor.iteration%2!=0}
                    <td colspan="2" class="celulaMenuST" {if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}name="NHours"{/if} style="{if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}display:table-cell;{/if}border-left: 1px solid #a4a4a4;">&nbsp;</td>
                {/if}
            {/foreach}
            <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;">&nbsp;</td>
            <td class="celulaMenuST">&nbsp;</td>
            <td class="celulaMenuSTDR">&nbsp;</td>
        </tr>-->
    {foreach from=$dm key=DptID item=department name=dpmfor}
        <tr>
        <!--<td rowspan="{$department.RSpan}" valign="top" style="border-bottom: 3px solid #a4a4a4;">{$departments.$DptID}</td>-->
        {foreach from=$department.Dates key=dateval item=day name=dfor}
            {assign var='yearval' value=$dateval|date_format:'%Y'}
            {assign var='monthval' value=$dateval|date_format:'%m'}
            {assign var='weekval' value=$dateval|date_format:'%W'}
            {assign var='weekval' value=$wtrans.$dateval}
            {assign var='dayofweek' value=$dateval|date_format:'%w'}

            {if $smarty.foreach.dfor.iteration > 1}
                </tr><tr>
            {/if}
            <td class="celulaMenuST" rowspan="{$department.DayPersonCount.$dateval}" valign="top" style="border-left: 1px solid #a4a4a4; border-bottom: 3px solid #a4a4a4;">
                <b>{$departments.$DptID}</b><br><br>{translate label=$days_labels.$dayofweek}<br>{$dateval|date_format:'%d.%m.%Y'} (W{$weekval}){if !empty($legal.$dateval)}
            <br>({translate label='SL'}){/if}</td>
            <td class="celulaMenuST"><b>{translate label='Angajat'}</b></td>
            {foreach from=$hours item=hour name=hfor}
                {if $smarty.foreach.hfor.iteration%2!=0}
                    <td colspan="2" class="celulaMenuST" {if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}name="NHours"{/if}
                        style="{if $smarty.foreach.hfor.iteration < 12 || $smarty.foreach.hfor.iteration > 43}display:table-cell;{/if}border-left: 1px solid #a4a4a4;">
                        <b>{$hour}</b></td>
                {/if}
            {/foreach}
            <td class="celulaMenuST" style="border-left: 1px solid #a4a4a4;"><b>{translate label='T.<br />zi'}</b></td>
            <td class="celulaMenuST"><b>{translate label='R.<br />sapt'}</b></td>
            <td class="celulaMenuSTDR"><b>{translate label='R.<br />luna'}</b></td>
            </tr>
            <tr>
            {foreach from=$day key=PersonID item=personhours name=persfor}
                {if $smarty.foreach.persfor.iteration > 1}
                    </tr><tr>
                {/if}
                <td class="celulaMenuST" style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}">{$persons.$DptID.$PersonID.FullName}</td>
                {foreach from=$hours item=hour name=hsfor}
                    {assign var='hour_val' value=$personhours.$hour}
                    <td class="celulaMenuST" {if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}name="NHours"{/if}
                        style="{if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}display:table-cell;{/if}{if $smarty.foreach.hsfor.iteration%2!=0}border-left: 1px solid #a4a4a4;{/if}{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}text-align: center;{$styles.$hour_val}" {if empty($restrict.$hour_val) && $allow_act}onclick="regClick('{$PersonID}','{$dateval}','{$hour}');"{/if}>{$texts.$hour_val|default:'&nbsp;'}</td>
                {/foreach}
                <td class="celulaMenuST"
                    style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if} border-left:1px solid #a4a4a4;{if $department.Days.$dateval.$PersonID > 10}background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Days.$dateval.$PersonID|default:'0'}</td>
                <td class="celulaMenuST"
                    style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if} {if ($department.Weeks.$yearval.$weekval.$PersonID < 0 && $department.Weeks_ref.$yearval.$weekval.$PersonID < 40) || ($department.Weeks.$yearval.$weekval.$PersonID < -8 && $department.Weeks_ref.$yearval.$weekval.$PersonID >= 40)} background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Weeks.$yearval.$weekval.$PersonID|default:'&nbsp;'}</td>
                <td class="celulaMenuSTDR"
                    style="{if $smarty.foreach.persfor.last}border-bottom: 1px solid #a4a4a4;{/if}{if $department.Months.$yearval.$monthval.$PersonID < 0} background-color:#ff0000; color:#e8e8e8;{/if}">{$department.Months.$yearval.$monthval.$PersonID|default:'&nbsp;'}</td>
            {/foreach}
            </tr>
            <tr>
                <td class="celulaMenuST" style="border-bottom: 3px solid #a4a4a4;"><b>{translate label='Total angajati'}</b></td>
                {foreach from=$hours item=hour name=hsfor}
                    {assign var='hour_val' value=$personhours.$hour}
                    <td class="celulaMenuST" {if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}name="NHours"{/if}
                        style="{if $smarty.foreach.hsfor.iteration < 13 || $smarty.foreach.hsfor.iteration > 44}display:table-cell;{/if}{if $smarty.foreach.hsfor.iteration%2!=0}border-left: 1px solid #a4a4a4;{/if}{if $smarty.foreach.persfor.last}border-bottom: 3px solid #a4a4a4;{/if}text-align: center;">{$department.Totals.$dateval.$hour|default:'0'}</td>
                {/foreach}
                <td colspan="3" class="celulaMenuSTDR" style="border-bottom: 3px solid #a4a4a4;">&nbsp;</td>
            </tr>
        {/foreach}
        </tr>
    {/foreach}
</table>

</body>
</html>
        
        

