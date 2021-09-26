{include file="budget_menu.tpl"}
<div class="filter">
    <label>Anul:</label>
    <select id="year">
        <option value="0">{translate label='Alege anul'}</option>
        {foreach from=$years item=year}
            <option value="{$year}" {if $year == $smarty.get.year}selected{/if}>{$year}</option>
        {/foreach}
    </select>
    <label>Companie:</label>
    <select id="CompanyID" class="dropdown">
        <option value="0">{translate label='Toate companiile'}</option>
        {foreach from=$self key=key item=item}
            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
            {/if}
        {/foreach}
    </select>
    <input type="button"
           onclick="if (document.getElementById('year').value > 0) window.location.href = './?m=budgets&o=planned&year=' + document.getElementById('year').value + '&CompanyID=' + document.getElementById('CompanyID').value; else alert('{translate label='Nu ati ales anul pentru care faceti planificarea bugetului!'}');"
           value="Planifica">
    <br/>
    <div class="outputZone outputZoneOne">
        <div>
            <ul>
                <li class="header"><label>{translate label='Output'}</label></li>
                <li>
                    <input type="button" class="cod printFile" onclick="window.open('{$smarty.server.REQUEST_URI}&print=1', 'print')" value="Printeaza">&nbsp;
                </li>
                <li><input type="button" class="cod exportFile" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export=1'" value="Export">&nbsp;
                </li>
                <li><input type="button" class="cod exportFile" onclick="window.location.href = '{$smarty.server.REQUEST_URI}&export_doc=1'" value="Export .doc">
                </li>
            </ul>
        </div>
    </div>
</div>
{if !empty($smarty.get.year)}
    <form action="{$smarty.server.REQUEST_URI}" method="post">
        <table width="100%" cellspacing="0" cellpadding="4" class="screen">
            <tr bgcolor="#95b3d7">
                <td style="border-bottom: 1px dashed #ffffff;"><b>{translate label='Divizia / Departament'}</b></td>
                {foreach from=$months key=mon item=month}
                    <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{$month}</b></td>
                {/foreach}
                <td align="right" style="border-bottom: 1px dashed #ffffff;"><b>{translate label='TOTAL'}</b></td>
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
                <td><b>{translate label='TOTAL'}</b></td>
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
                        <td style="padding-left: 30px;">{translate label='Salariu'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][s1]" value="{$budget.$DepartmentID.$mon.s1|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s1|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='PFA'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][s2]" value="{$budget.$DepartmentID.$mon.s2|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s2|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Bonus'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][s3]" value="{$budget.$DepartmentID.$mon.s3|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s3|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Malus'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][s4]" value="{$budget.$DepartmentID.$mon.s4|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s4|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Deplasari'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][s5]" value="{$budget.$DepartmentID.$mon.s5|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.s5|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr bgcolor="#eeeeee">
                        <td style="padding-left: 20px;">{translate label='BENEFICII'}</td>
                        {assign var="totalban" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right">{math equation="a+b+c+d+e+f+g+h+i+j+k+l+m" a=$budget.$DepartmentID.$mon.b1|default:0 b=$budget.$DepartmentID.$mon.b2|default:0 c=$budget.$DepartmentID.$mon.b3|default:0 d=$budget.$DepartmentID.$mon.b4|default:0 e=$budget.$DepartmentID.$mon.b5|default:0 f=$budget.$DepartmentID.$mon.b6|default:0 g=$budget.$DepartmentID.$mon.b7|default:0 h=$budget.$DepartmentID.$mon.b8|default:0 i=$budget.$DepartmentID.$mon.b9|default:0 j=$budget.$DepartmentID.$mon.b10|default:0 k=$budget.$DepartmentID.$mon.b11|default:0 l=$budget.$DepartmentID.$mon.b12|default:0 m=$budget.$DepartmentID.$mon.b13|default:0}</td>
                            {math equation="x+a+b+c+d+e+f+g+h+i+j+k+l+m" x=$totalban a=$budget.$DepartmentID.$mon.b1|default:0 b=$budget.$DepartmentID.$mon.b2|default:0 c=$budget.$DepartmentID.$mon.b3|default:0 d=$budget.$DepartmentID.$mon.b4|default:0 e=$budget.$DepartmentID.$mon.b5|default:0 f=$budget.$DepartmentID.$mon.b6|default:0 g=$budget.$DepartmentID.$mon.b7|default:0 h=$budget.$DepartmentID.$mon.b8|default:0 i=$budget.$DepartmentID.$mon.b9|default:0 j=$budget.$DepartmentID.$mon.b10|default:0 k=$budget.$DepartmentID.$mon.b11|default:0 l=$budget.$DepartmentID.$mon.b12|default:0 m=$budget.$DepartmentID.$mon.b13|default:0 assign="totalban"}
                        {/foreach}
                        <td align="right"><b>{$totalban}</b></td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Asigurari de sanatate'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b1]" value="{$budget.$DepartmentID.$mon.b1|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b1|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Asigurari de viata'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b2]" value="{$budget.$DepartmentID.$mon.b2|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b2|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Pensie privata'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b3]" value="{$budget.$DepartmentID.$mon.b3|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b3|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Bonuri de masa'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b4]" value="{$budget.$DepartmentID.$mon.b4|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b4|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Asigurare stomatologica'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b5]" value="{$budget.$DepartmentID.$mon.b5|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b5|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Tichete cadou'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b6]" value="{$budget.$DepartmentID.$mon.b6|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b6|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Outplacement'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b7]" value="{$budget.$DepartmentID.$mon.b7|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b7|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Traininguri'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b8]" value="{$budget.$DepartmentID.$mon.b8|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b8|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Cantina'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b9]" value="{$budget.$DepartmentID.$mon.b9|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b9|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Masina serviciu'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b10]" value="{$budget.$DepartmentID.$mon.b10|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b10|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Sportiv'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b11]" value="{$budget.$DepartmentID.$mon.b11|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b11|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Pensii Facultative'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b12]" value="{$budget.$DepartmentID.$mon.b12|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b12|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                    <tr>
                        <td style="padding-left: 30px;">{translate label='Avantaj Natura'}</td>
                        {assign var="totalrow" value="0"}
                        {foreach from=$months key=mon item=month}
                            <td align="right"><input type="text" name="b[{$DepartmentID}][{$mon}][b13]" value="{$budget.$DepartmentID.$mon.b13|default:0}" size="6"
                                                     style="font-size: 11px;"></td>
                            {math equation="x+y" x=$totalrow y=$budget.$DepartmentID.$mon.b13|default:0 assign="totalrow"}
                        {/foreach}
                        <td align="right">{$totalrow}</td>
                    </tr>
                {/foreach}
                <tr>
                    <td>&nbsp;</td>
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
        </table>
        <div align="center" style="padding: 10px;"><input type="submit" value="{translate label='Salveaza'}"></div>
    </form>
{/if}