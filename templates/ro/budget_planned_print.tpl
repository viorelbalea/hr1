<html>
<head>
    <title>Soft Resurse Umane</title>
    {if $smarty.get.print=='1'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>
<body topmargin="5" onLoad="window.print();">
<table width="100%" cellspacing="0" cellpadding="4" class="screen">
    <tr bgcolor="#95b3d7">
        <td style="border-bottom: 1px dashed #ffffff;"><b>Divizia / Departament</b></td>
        {foreach from=$months key=mon item=month}
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$month}</b></td>
        {/foreach}
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>TOTAL</b></td>
    </tr>
    {assign var="totalgen" value="0"}
    {foreach from=$persons key=DivisionID item=item}
        <tr bgcolor="#95b3d7">
            <td style="border-bottom: 1px dashed #ffffff;"><b>{$divisions.$DivisionID}</b></td>
            {assign var="totaldivan" value="0"}
            {foreach from=$months key=mon item=month}
                <td align="right" style="border-bottom: 1px dashed #ffffff;">
                    <b>
                        {assign var="totaldiv" value="0"}
                        {foreach from=$item key=DepartmentID item=item2}
                            {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.$mon.total|default:0 assign="totaldiv"}
                        {/foreach}
                        {$totaldiv}
                        {math equation="x+y" x=$totaldivan y=$totaldiv assign="totaldivan"}
                    </b>
                </td>
            {/foreach}
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totaldivan}</b></td>
            {math equation="x+y" x=$totalgen y=$totaldivan assign="totalgen"}
        </tr>
    {/foreach}
    <tr bgcolor="#95b3d7">
        <td><b>TOTAL</b></td>
        {foreach from=$months key=mon item=month}
            <td align="right">
                <b>
                    {assign var="totalmongen" value="0"}
                    {foreach from=$persons key=DivisionID item=item}
                        {foreach from=$item key=DepartmentID item=item2}
                            {math equation="x+y" x=$totalmongen y=$budget.$DepartmentID.$mon.total|default:0 assign="totalmongen"}
                        {/foreach}
                    {/foreach}
                    {$totalmongen}
                </b>
            </td>
        {/foreach}
        <td align="right"><b>{$totalgen}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    {foreach from=$persons key=DivisionID item=item}
        <tr bgcolor="#95b3d7">
            <td><b>{$divisions.$DivisionID}</b></td>
            {assign var="totaldivan" value="0"}
            {foreach from=$months key=mon item=month}
                <td align="right">
                    <b>
                        {assign var="totaldiv" value="0"}
                        {foreach from=$item key=DepartmentID item=item2}
                            {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.$mon.total|default:0 assign="totaldiv"}
                        {/foreach}
                        {$totaldiv}
                        {math equation="x+y" x=$totaldivan y=$totaldiv assign="totaldivan"}
                    </b>
                </td>
            {/foreach}
            <td align="right"><b>{$totaldivan}</b></td>
            {math equation="x+y" x=$totalgen y=$totaldivan assign="totalgen"}
        </tr>
        {foreach from=$item key=DepartmentID item=item2}
            <tr bgcolor="#dce6f1">
                <td style="padding-left: 10px;"><b>{$departments.$DepartmentID}</b></td>
                {assign var="totaldepan" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right"><b>{$budget.$DepartmentID.$mon.total}</b></td>
                    {math equation="x+y" x=$totaldepan y=$budget.$DepartmentID.$mon.total|default:0 assign="totaldepan"}
                {/foreach}
                <td align="right"><b>{$totaldepan}</b></td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td style="padding-left: 20px;">SALARII</td>
                {assign var="totalsalan" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{math equation="a+b+c-d+e" a=$budget.$DepartmentID.$mon.s1|default:0 b=$budget.$DepartmentID.$mon.s2|default:0 c=$budget.$DepartmentID.$mon.s3|default:0 d=$budget.$DepartmentID.$mon.s4|default:0 e=$budget.$DepartmentID.$mon.s5|default:0}</td>
                    {math equation="x+a+b+c-d+e" x=$totalsalan a=$budget.$DepartmentID.$mon.s1|default:0 b=$budget.$DepartmentID.$mon.s2|default:0 c=$budget.$DepartmentID.$mon.s3|default:0 d=$budget.$DepartmentID.$mon.s4|default:0 e=$budget.$DepartmentID.$mon.s5|default:0 assign="totalsalan"}
                {/foreach}
                <td align="right"><b>{$totalsalan}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Salariu</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.s1|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s1|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">PFA</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.s2|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s2|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Bonus</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.s3|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s3|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Malus</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.s4|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s4|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Deplasari</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.s5|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s5|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td style="padding-left: 20px;">BENEFICII</td>
                {assign var="totalban" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j" a=$budget.$DepartmentID.$mon.b1|default:0 b=$budget.$DepartmentID.$mon.b2|default:0 c=$budget.$DepartmentID.$mon.b3|default:0 d=$budget.$DepartmentID.$mon.b4|default:0 e=$budget.$DepartmentID.$mon.b5|default:0 f=$budget.$DepartmentID.$mon.b6|default:0 g=$budget.$DepartmentID.$mon.b7|default:0 h=$budget.$DepartmentID.$mon.b8|default:0 i=$budget.$DepartmentID.$mon.b9|default:0 j=$budget.$DepartmentID.$mon.b10|default:0}</td>
                    {math equation="x+a+b+c+d+e+f+g+h+i+j" x=$totalban a=$budget.$DepartmentID.$mon.b1|default:0 b=$budget.$DepartmentID.$mon.b2|default:0 c=$budget.$DepartmentID.$mon.b3|default:0 d=$budget.$DepartmentID.$mon.b4|default:0 e=$budget.$DepartmentID.$mon.b5|default:0 f=$budget.$DepartmentID.$mon.b6|default:0 g=$budget.$DepartmentID.$mon.b7|default:0 h=$budget.$DepartmentID.$mon.b8|default:0 i=$budget.$DepartmentID.$mon.b9|default:0 j=$budget.$DepartmentID.$mon.b10|default:0 k=$budget.$DepartmentID.$mon.b11|default:0 l=$budget.$DepartmentID.$mon.b12|default:0 m=$budget.$DepartmentID.$mon.b13|default:0 assign="totalban"}
                {/foreach}
                <td align="right"><b>{$totalban}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Asigurari de sanatate</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b1|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b1|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Asigurari de viata</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b2|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b2|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Pensie privata</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b3|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b3|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Bonuri de masa</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b4|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b4|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Asigurare stomatologica</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b5|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b5|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Tichete cadou</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b6|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b6|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Outplacement</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b7|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b7|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Traininguri</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b8|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b8|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Cantina</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b9|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b9|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">Masina serviciu</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b10|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b10|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Sportiv'}</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b11|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b11|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Pensii Facultative'}</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b12|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b12|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Avantaj Natura'}</td>
                {assign var="totalrow" value="0"}
                {foreach from=$months key=mon item=month}
                    <td align="right">{$budget.$DepartmentID.$mon.b13|default:0}</td>
                    {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b13|default:0 assign="totalrow"}
                {/foreach}
                <td align="right">{$totalrow}</td>
            </tr>
        {/foreach}
    {/foreach}
    <tr bgcolor="#95b3d7">
        <td><b>TOTAL</b></td>
        {foreach from=$months key=mon item=month}
            <td align="right">
                <b>
                    {assign var="totalmongen" value="0"}
                    {foreach from=$persons key=DivisionID item=item}
                        {foreach from=$item key=DepartmentID item=item2}
                            {math equation="x+y" x=$totalmongen y=$budget.$DepartmentID.$mon.total|default:0 assign="totalmongen"}
                        {/foreach}
                    {/foreach}
                    {$totalmongen}
                </b>
            </td>
        {/foreach}
        <td align="right"><b>{$totalgen}</b></td>
    </tr>
</table>
</body>
</html>