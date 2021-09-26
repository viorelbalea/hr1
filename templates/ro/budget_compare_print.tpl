<html>
<head>
    <title>{translate label='Soft Resurse Umane'}</title>
    {if $smarty.get.print=='1'}
        <link href="images/style.css" rel="stylesheet" type="text/css">
    {/if}
</head>
<body topmargin="5" onLoad="window.print();">
{assign var="monthsel" value=$smarty.get.month}
<table width="100%" cellspacing="0" cellpadding="4" class="screen">
    <tr bgcolor="#95b3d7">
        <td style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Divizia / Departament'}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Planificat pana in  '}{$months.$monthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Consumat pana in'} {$months.$monthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Variatie pana in '} {$months.$monthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Planificat in'} {$months.$monthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label=' Consumat in'} {$months.$monthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Variatie in '}{$months.$monthsel}</b></td>
    </tr>
    {assign var="totalgenbefore" value="0"}
    {assign var="totalgenmonthsel" value="0"}
    {assign var="totalcgenbefore" value="0"}
    {assign var="totalcgenmonthsel" value="0"}
    {foreach from=$persons key=DivisionID item=item}
        <tr bgcolor="#95b3d7">
            <td style="border-bottom: 1px dashed #ffffff;"><b>{$divisions.$DivisionID}</b></td>
            <td align="right" style="border-bottom: 1px dashed #ffffff;">
                <b>
                    {assign var="totaldiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.before.total|default:0 assign="totaldiv"}
                    {/foreach}
                    {$totaldiv}
                </b>
            </td>
            {math equation="x+y" x=$totalgenbefore y=$totaldiv assign="totalgenbefore"}
            <td align="right" style="border-bottom: 1px dashed #ffffff;">
                <b>
                    {assign var="totalcdiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totalcdiv y=$budgetc.$DepartmentID.before.total|default:0 assign="totalcdiv"}
                    {/foreach}
                    {$totalcdiv}
                </b>
            </td>
            {math equation="x+y" x=$totalcgenbefore y=$totalcdiv assign="totalcgenbefore"}
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totaldiv y=$totalcdiv}</b></td>
            <td align="right" style="border-bottom: 1px dashed #ffffff;">
                <b>
                    {assign var="totaldiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.$monthsel.total|default:0 assign="totaldiv"}
                    {/foreach}
                    {$totaldiv}
                </b>
            </td>
            {math equation="x+y" x=$totalgenmonthsel y=$totaldiv assign="totalgenmonthsel"}
            <td align="right" style="border-bottom: 1px dashed #ffffff;">
                <b>
                    {assign var="totalcdiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totalcdiv y=$budgetc.$DepartmentID.$monthsel.total|default:0 assign="totalcdiv"}
                    {/foreach}
                    {$totalcdiv}
                </b>
            </td>
            {math equation="x+y" x=$totalcgenmonthsel y=$totalcdiv assign="totalcgenmonthsel"}
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totaldiv y=$totalcdiv}</b></td>
        </tr>
    {/foreach}
    <tr bgcolor="#95b3d7">
        <td><b>{translate label='TOTAL'}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalcgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totalgenbefore y=$totalcgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalgenmonthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalcgenmonthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totalgenmonthsel y=$totalcgenmonthsel}</b></td>
    </tr>
    <tr>
        <td>&nbsp;</td>
    </tr>
    {foreach from=$persons key=DivisionID item=item}
        <tr bgcolor="#95b3d7">
            <td><b>{$divisions.$DivisionID}</b></td>
            <td align="right">
                <b>
                    {assign var="totaldiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.before.total|default:0 assign="totaldiv"}
                    {/foreach}
                    {$totaldiv}
                </b>
            </td>
            <td align="right">
                <b>
                    {assign var="totalcdiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totalcdiv y=$budgetc.$DepartmentID.before.total|default:0 assign="totalcdiv"}
                    {/foreach}
                    {$totalcdiv}
                </b>
            </td>
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totaldiv y=$totalcdiv}</b></td>
            <td align="right">
                <b>
                    {assign var="totaldiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totaldiv y=$budget.$DepartmentID.$monthsel.total|default:0 assign="totaldiv"}
                    {/foreach}
                    {$totaldiv}
                </b>
            </td>
            <td align="right">
                <b>
                    {assign var="totalcdiv" value="0"}
                    {foreach from=$item key=DepartmentID item=item2}
                        {math equation="x+y" x=$totalcdiv y=$budgetc.$DepartmentID.$monthsel.total|default:0 assign="totalcdiv"}
                    {/foreach}
                    {$totalcdiv}
                </b>
            </td>
            <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totaldiv y=$totalcdiv}</b></td>
        </tr>
        {foreach from=$item key=DepartmentID item=item2}
            <tr bgcolor="#dce6f1">
                <td style="padding-left: 10px;"><b>{$departments.$DepartmentID}</b></td>
                <td align="right"><b>{$budget.$DepartmentID.before.total|default:0}</b></td>
                <td align="right"><b>{$budgetc.$DepartmentID.before.total|default:0}</b></td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.total|default:0 y=$budgetc.$DepartmentID.before.total|default:0}</b></td>
                <td align="right"><b>{$budget.$DepartmentID.$monthsel.total|default:0}</b></td>
                <td align="right"><b>{$budgetc.$DepartmentID.$monthsel.total|default:0}</b></td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.total|default:0 y=$budgetc.$DepartmentID.$monthsel.total|default:0}</b></td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td style="padding-left: 20px;">{translate label='SALARII'}</td>
                <td align="right">{math equation="a+b+c-d+e" a=$budget.$DepartmentID.before.s1|default:0 b=$budget.$DepartmentID.before.s2|default:0 c=$budget.$DepartmentID.before.s3|default:0 d=$budget.$DepartmentID.before.s4|default:0  e=$budget.$DepartmentID.before.s5|default:0}</td>
                <td align="right">{math equation="a+b+c-d+e" a=$budgetc.$DepartmentID.before.salary|default:0 b=$budgetc.$DepartmentID.before.contract|default:0 c=$budgetc.$DepartmentID.before.bonus|default:0 d=$budgetc.$DepartmentID.before.malus|default:0 d=$budgetc.$DepartmentID.before.displacement|default:0}</td>
                <td align="right">{math equation="a+b+c-d+e-x-y-z+t-u" a=$budget.$DepartmentID.before.s1|default:0 b=$budget.$DepartmentID.before.s2|default:0 c=$budget.$DepartmentID.before.s3|default:0 d=$budget.$DepartmentID.before.s4|default:0 e=$budget.$DepartmentID.before.s5|default:0 x=$budgetc.$DepartmentID.before.salary|default:0 y=$budgetc.$DepartmentID.before.contract|default:0 z=$budgetc.$DepartmentID.before.bonus|default:0 t=$budgetc.$DepartmentID.before.malus|default:0 u=$budgetc.$DepartmentID.before.displacement|default:0}</td>
                <td align="right">{math equation="a+b+c-d+e" a=$budget.$DepartmentID.$monthsel.s1|default:0 b=$budget.$DepartmentID.$monthsel.s2|default:0 c=$budget.$DepartmentID.$monthsel.s3|default:0 d=$budget.$DepartmentID.$monthsel.s4|default:0  e=$budget.$DepartmentID.$monthsel.s5|default:0}</td>
                <td align="right">{math equation="a+b+c-d+e" a=$budgetc.$DepartmentID.$monthsel.salary|default:0 b=$budgetc.$DepartmentID.$monthsel.contract|default:0 c=$budgetc.$DepartmentID.$monthsel.bonus|default:0 d=$budgetc.$DepartmentID.$monthsel.malus|default:0 e=$budgetc.$DepartmentID.$monthsel.displacement|default:0}</td>
                <td align="right">{math equation="a+b+c-d+e-x-y-z+t-u" a=$budget.$DepartmentID.$monthsel.s1|default:0 b=$budget.$DepartmentID.$monthsel.s2|default:0 c=$budget.$DepartmentID.$monthsel.s3|default:0 d=$budget.$DepartmentID.$monthsel.s4|default:0   e=$budget.$DepartmentID.$monthsel.s5|default:0 x=$budgetc.$DepartmentID.$monthsel.salary|default:0 y=$budgetc.$DepartmentID.$monthsel.contract|default:0 z=$budgetc.$DepartmentID.$monthsel.bonus|default:0 t=$budgetc.$DepartmentID.$monthsel.malus|default:0  u=$budgetc.$DepartmentID.$monthsel.displacement|default:0}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Salariu'}</td>
                <td align="right">{$budget.$DepartmentID.before.s1|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.salary|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.s1|default:0 y=$budgetc.$DepartmentID.before.salary|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.s1|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.salary|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.s1|default:0 y=$budgetc.$DepartmentID.$monthsel.salary|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='PFA'}</td>
                <td align="right">{$budget.$DepartmentID.before.s2|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.contract|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.s2|default:0 y=$budgetc.$DepartmentID.before.contract|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.s2|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.contract|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.s2|default:0 y=$budgetc.$DepartmentID.$monthsel.contract|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Bonus'}</td>
                <td align="right">{$budget.$DepartmentID.before.s3|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.bonus|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.s3|default:0 y=$budgetc.$DepartmentID.before.bonus|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.s3|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.bonus|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.s3|default:0 y=$budgetc.$DepartmentID.$monthsel.bonus|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Malus'}</td>
                <td align="right">{$budget.$DepartmentID.before.s4|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.malus|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.s4|default:0 y=$budgetc.$DepartmentID.before.malus|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.s4|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.malus|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.s4|default:0 y=$budgetc.$DepartmentID.$monthsel.malus|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Deplasari'}</td>
                <td align="right">{$budget.$DepartmentID.before.s5|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.displacement|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.s5|default:0 y=$budgetc.$DepartmentID.before.displacement|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.s5|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.displacement|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.s5|default:0 y=$budgetc.$DepartmentID.$monthsel.displacement|default:0}</b></td>
            </tr>
            <tr bgcolor="#eeeeee">
                <td style="padding-left: 20px;">{translate label='BENEFICII'}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m" a=$budget.$DepartmentID.before.b1|default:0 b=$budget.$DepartmentID.before.b2|default:0 c=$budget.$DepartmentID.before.b3|default:0 d=$budget.$DepartmentID.before.b4|default:0 e=$budget.$DepartmentID.before.b5|default:0 f=$budget.$DepartmentID.before.b6|default:0 g=$budget.$DepartmentID.before.b7|default:0 h=$budget.$DepartmentID.before.b8|default:0 i=$budget.$DepartmentID.before.b9|default:0 j=$budget.$DepartmentID.before.b10|default:0 k=$budget.$DepartmentID.before.b11|default:0 l=$budget.$DepartmentID.before.b12|default:0 m=$budget.$DepartmentID.before.b13|default:0}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m" a=$budgetc.$DepartmentID.before.1|default:0 b=$budgetc.$DepartmentID.before.2|default:0 c=$budgetc.$DepartmentID.before.3|default:0 d=$budgetc.$DepartmentID.before.4|default:0 e=$budgetc.$DepartmentID.before.5|default:0 f=$budgetc.$DepartmentID.before.6|default:0 g=$budgetc.$DepartmentID.before.7|default:0 h=$budgetc.$DepartmentID.before.8|default:0 i=$budgetc.$DepartmentID.before.9|default:0 j=$budgetc.$DepartmentID.before.10|default:0 k=$budgetc.$DepartmentID.before.11|default:0 l=$budgetc.$DepartmentID.before.12|default:0 m=$budgetc.$DepartmentID.before.13|default:0}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m-aa-bb-cc-dd-ee-ff-gg-hh-ii-jj-kk-ll-mm" a=$budget.$DepartmentID.before.b1|default:0 b=$budget.$DepartmentID.before.b2|default:0 c=$budget.$DepartmentID.before.b3|default:0 d=$budget.$DepartmentID.before.b4|default:0 e=$budget.$DepartmentID.before.b5|default:0 f=$budget.$DepartmentID.before.b6|default:0 g=$budget.$DepartmentID.before.b7|default:0 h=$budget.$DepartmentID.before.b8|default:0 i=$budget.$DepartmentID.before.b9|default:0 j=$budget.$DepartmentID.before.b9|default:0 aa=$budgetc.$DepartmentID.before.1|default:0 bb=$budgetc.$DepartmentID.before.2|default:0 cc=$budgetc.$DepartmentID.before.3|default:0 dd=$budgetc.$DepartmentID.before.4|default:0 ee=$budgetc.$DepartmentID.before.5|default:0 ff=$budgetc.$DepartmentID.before.6|default:0 gg=$budgetc.$DepartmentID.before.7|default:0 hh=$budgetc.$DepartmentID.before.8|default:0 ii=$budgetc.$DepartmentID.before.9|default:0 jj=$budgetc.$DepartmentID.before.10|default:0 kk=$budgetc.$DepartmentID.before.11|default:0 ll=$budgetc.$DepartmentID.before.12|default:0 mm=$budgetc.$DepartmentID.before.13|default:0}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m" a=$budget.$DepartmentID.$monthsel.b1|default:0 b=$budget.$DepartmentID.$monthsel.b2|default:0 c=$budget.$DepartmentID.$monthsel.b3|default:0 d=$budget.$DepartmentID.$monthsel.b4|default:0 e=$budget.$DepartmentID.$monthsel.b5|default:0 f=$budget.$DepartmentID.$monthsel.b6|default:0 g=$budget.$DepartmentID.$monthsel.b7|default:0 h=$budget.$DepartmentID.$monthsel.b8|default:0 i=$budget.$DepartmentID.$monthsel.b9|default:0 j=$budget.$DepartmentID.$monthsel.b10|default:0 k=$budget.$DepartmentID.$monthsel.b11|default:0 l=$budget.$DepartmentID.$monthsel.b12|default:0 m=$budget.$DepartmentID.$monthsel.b13|default:0}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m" a=$budgetc.$DepartmentID.$monthsel.1|default:0 b=$budgetc.$DepartmentID.$monthsel.2|default:0 c=$budgetc.$DepartmentID.$monthsel.3|default:0 d=$budgetc.$DepartmentID.$monthsel.4|default:0 e=$budgetc.$DepartmentID.$monthsel.5|default:0 f=$budgetc.$DepartmentID.$monthsel.6|default:0 g=$budgetc.$DepartmentID.$monthsel.7|default:0 h=$budgetc.$DepartmentID.$monthsel.8|default:0 i=$budgetc.$DepartmentID.$monthsel.9|default:0 j=$budgetc.$DepartmentID.$monthsel.10|default:0 k=$budgetc.$DepartmentID.$monthsel.11|default:0 l=$budgetc.$DepartmentID.$monthsel.12|default:0 m=$budgetc.$DepartmentID.$monthsel.13|default:0}</td>
                <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j-aa-bb-cc-dd-ee-ff-gg-hh-ii-jj-kk-ll-mm" a=$budget.$DepartmentID.$monthsel.b1|default:0 b=$budget.$DepartmentID.$monthsel.b2|default:0 c=$budget.$DepartmentID.$monthsel.b3|default:0 d=$budget.$DepartmentID.$monthsel.b4|default:0 e=$budget.$DepartmentID.$monthsel.b5|default:0 f=$budget.$DepartmentID.$monthsel.b6|default:0 g=$budget.$DepartmentID.$monthsel.b7|default:0 h=$budget.$DepartmentID.$monthsel.b8|default:0  i=$budget.$DepartmentID.$monthsel.b9|default:0  j=$budget.$DepartmentID.$monthsel.b10|default:0 aa=$budgetc.$DepartmentID.$monthsel.1|default:0 bb=$budgetc.$DepartmentID.$monthsel.2|default:0 cc=$budgetc.$DepartmentID.$monthsel.3|default:0 dd=$budgetc.$DepartmentID.$monthsel.4|default:0 ee=$budgetc.$DepartmentID.$monthsel.5|default:0 ff=$budgetc.$DepartmentID.$monthsel.6|default:0 gg=$budgetc.$DepartmentID.$monthsel.7|default:0 hh=$budgetc.$DepartmentID.$monthsel.8|default:0 ii=$budgetc.$DepartmentID.$monthsel.9|default:0 jj=$budgetc.$DepartmentID.$monthsel.10|default:0 kk=$budgetc.$DepartmentID.$monthsel.11|default:0 ll=$budgetc.$DepartmentID.$monthsel.12|default:0 mm=$budgetc.$DepartmentID.$monthsel.13|default:0}</td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Asigurari de sanatate'}</td>
                <td align="right">{$budget.$DepartmentID.before.b1|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.1|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b1|default:0 y=$budgetc.$DepartmentID.before.1|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b1|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.1|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b1|default:0 y=$budgetc.$DepartmentID.$monthsel.1|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Asigurari de viata'}</td>
                <td align="right">{$budget.$DepartmentID.before.b2|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.2|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b2|default:0 y=$budgetc.$DepartmentID.before.2|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b2|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.2|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b2|default:0 y=$budgetc.$DepartmentID.$monthsel.2|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Pensie privata'}</td>
                <td align="right">{$budget.$DepartmentID.before.b3|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.3|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b3|default:0 y=$budgetc.$DepartmentID.before.3|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b3|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.3|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b3|default:0 y=$budgetc.$DepartmentID.$monthsel.3|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Bonuri de masa'}</td>
                <td align="right">{$budget.$DepartmentID.before.b4|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.4|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b4|default:0 y=$budgetc.$DepartmentID.before.4|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b4|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.4|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b4|default:0 y=$budgetc.$DepartmentID.$monthsel.4|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Asigurare stomatologica'}</td>
                <td align="right">{$budget.$DepartmentID.before.b5|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.5|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b5|default:0 y=$budgetc.$DepartmentID.before.5|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b5|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.5|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b5|default:0 y=$budgetc.$DepartmentID.$monthsel.5|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Tichete cadou'}</td>
                <td align="right">{$budget.$DepartmentID.before.b6|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.6|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b6|default:0 y=$budgetc.$DepartmentID.before.6|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b6|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.6|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b6|default:0 y=$budgetc.$DepartmentID.$monthsel.6|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Outplacement'}</td>
                <td align="right">{$budget.$DepartmentID.before.b7|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.7|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b7|default:0 y=$budgetc.$DepartmentID.before.7|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b7|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.7|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b7|default:0 y=$budgetc.$DepartmentID.$monthsel.7|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Traininguri'}</td>
                <td align="right">{$budget.$DepartmentID.before.b8|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.8|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b8|default:0 y=$budgetc.$DepartmentID.before.8|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b8|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.8|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b8|default:0 y=$budgetc.$DepartmentID.$monthsel.8|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Cantina'}</td>
                <td align="right">{$budget.$DepartmentID.before.b9|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.9|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b9|default:0 y=$budgetc.$DepartmentID.before.9|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b9|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.9|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b9|default:0 y=$budgetc.$DepartmentID.$monthsel.9|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Masina serviciu'}</td>
                <td align="right">{$budget.$DepartmentID.before.b10|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.10|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b10|default:0 y=$budgetc.$DepartmentID.before.10|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b10|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.10|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b10|default:0 y=$budgetc.$DepartmentID.$monthsel.10|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Sportiv'}</td>
                <td align="right">{$budget.$DepartmentID.before.b11|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.11|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b11|default:0 y=$budgetc.$DepartmentID.before.11|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b11|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.11|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b11|default:0 y=$budgetc.$DepartmentID.$monthsel.11|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Pensii Facultative'}</td>
                <td align="right">{$budget.$DepartmentID.before.b12|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.12|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b12|default:0 y=$budgetc.$DepartmentID.before.12|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b12|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.12|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b12|default:0 y=$budgetc.$DepartmentID.$monthsel.12|default:0}</b></td>
            </tr>
            <tr>
                <td style="padding-left: 30px;">{translate label='Avantaj Natura'}</td>
                <td align="right">{$budget.$DepartmentID.before.b13|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.before.13|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.before.b13|default:0 y=$budgetc.$DepartmentID.before.13|default:0}</b></td>
                <td align="right">{$budget.$DepartmentID.$monthsel.b13|default:0}</td>
                <td align="right">{$budgetc.$DepartmentID.$monthsel.13|default:0}</td>
                <td align="right"><b>{math equation="x-y" x=$budget.$DepartmentID.$monthsel.b13|default:0 y=$budgetc.$DepartmentID.$monthsel.13|default:0}</b></td>
            </tr>
        {/foreach}
        <tr>
            <td>&nbsp;</td>
        </tr>
    {/foreach}
    <tr bgcolor="#95b3d7">
        <td><b>{translate label='TOTAL'}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalcgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totalgenbefore y=$totalcgenbefore}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalgenmonthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$totalcgenmonthsel}</b></td>
        <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{math equation="x-y" x=$totalgenmonthsel y=$totalcgenmonthsel}</b></td>
    </tr>
</table>
</body>
</html>