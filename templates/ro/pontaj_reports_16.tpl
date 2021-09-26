<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport pontaj personal perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b>
    {else}
        {translate label='Perioada intre '}
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A>
        si
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$smarty.now|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A>
        <select id="Status">
            <option value="0">{translate label='angajati total'}</option>
            <option value="2" {if $smarty.get.Status==2}selected{/if}>{translate label='angajati curenti'}</option>
            <option value="7" {if $smarty.get.Status==7}selected{/if}>{translate label='colaboratori'}</option>
        </select>
    {if !empty($divisions)}
        &nbsp;
        <select id="DivisionID">
            <option value="0">{translate label='alege divizia'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $smarty.get.DivisionID==$key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {/if}
        &nbsp;&nbsp;&nbsp;
        <input type="button" value="Trimite"
               onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value{if !empty($divisions)} + '&Status=' + document.getElementById('Status').value + '&DivisionID=' + document.getElementById('DivisionID').value{/if};">
    {/if}
</div>

{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr valign="bottom">
            <td colspan="5">&nbsp;</td>
            {assign var="ZL" value="0"}
            {foreach from=$cal key=data item=wday name=iter}
                <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63" {else}{math equation="x+1" x=$ZL assign="ZL"}}{/if}>
                    <b>{$smarty.foreach.iter.iteration}</b></td>
            {/foreach}
            <td align="center">oLN</td>
            <td align="center">oS</td>
            <td align="center">oW</td>
            <td align="center">oN</td>
            <td align="center">SPL</td>
            <td align="center">oNpt</td>
            <td align="center">zX</td>
            <td align="center">zCO</td>
            <td align="center">zCE</td>
            <td align="center">zCM</td>
            <td align="center">zCFS</td>
            <td align="center">zAbs</td>
            <td align="center">zInv</td>
            <td align="center">zCIC</td>
            <td align="center">zT</td>
            <td align="center">TzNel</td>
        </tr>
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume prenume'}</b></td>
            <td><b>{translate label='Tip ore'}</b></td>
            <td><b>{translate label='Max'}</b></td>
            <td><b>{translate label='Total'}</b></td>
            {foreach from=$cal key=data item=wday}
                <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}><b>{$wday}</b></td>
            {/foreach}
            <td colspan="16" style="text-align: center;">
                {translate label='o = ore, z = zile'}<br/>
                <table cellpadding="2" cellspacing="0" border="0">
                    <tr>
                        <td>LN = Normale</td>
                        <td>S = Suplimentare</td>
                        <td>W = Weekend</td>
                    </tr>
                    <tr>
                        <td>N = Norma</td>
                        <td>SPL = Suplimentare + Weekend</td>
                        <td>Npt = Noapte</td>
                    </tr>
                    <tr>
                        <td>X = In afara contractului de munca</td>
                        <td>CO = Concediu odihna</td>
                        <td>CE = Concediu evenimente</td>
                    </tr>
                    <tr>
                        <td>CM = Concediu medical</td>
                        <td>CFS = Concediu fara salariu</td>
                        <td>Abs = Absente</td>
                    </tr>
                    <tr>
                        <td>Inv = Invoire</td>
                        <td>T = Somaj tehnic</td>
                        <td>TNelucr = Total nelucrate</td>
                    </tr>
                    <!--                <li style="list-style: none; float: left;">LN = Normale</li>
                                    <li style="list-style: none; float: left;">S = Suplimentare</li>
                                    <li style="list-style: none; float: left;">W = Weekend</li>
                                    <li style="list-style: none; float: left;">N = Norma</li>
                                    <li style="list-style: none; float: left;">SPL = Suplimentare + Weekend</li>
                                    <li style="list-style: none; float: left;">Npt = Noapte</li>
                                    <li style="list-style: none; float: left;">X = In afara contractului de munca</li>
                                    <li style="list-style: none; float: left;">CO = Concediu odihna</li>
                                    <li style="list-style: none; float: left;">CE = Concediu evenimente</li>
                                    <li style="list-style: none; float: left;">CM = Concediu medical</li>
                                    <li style="list-style: none; float: left;">CFS = Concediu fara salariu</li>
                                    <li style="list-style: none; float: left;">Abs = Absente</li>
                                    <li style="list-style: none; float: left;">Inv = Invoire</li>
                                    <li style="list-style: none; float: left;">T = Somaj tehnic</li>
                                    <li style="list-style: none; float: left;">TNelucr = Total nelucrate</li>-->
                </table>

                <br/><b>{$ZL}{translate label='zile lucratoare'} </b>
            </td>
        </tr>
        {foreach from=$report key=persid item=item name=iter}
            <tr bgcolor="#ffffff">
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{translate label='1.Norm'}</td>
                <td align="center">{$item.MaxNorm}</td>
                <td align="center">{$item.TNorm}</td>
                {foreach from=$cal key=data item=wday}
                    <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>{$item.Data.$data.Hours_Norm|default:0}</td>
                {/foreach}
                <td align="center">{$item.TNorm|default:0}</td>
                <td align="center">{$item.TSpl|default:0}</td>
                <td align="center">{$item.TSplW|default:0}</td>
                <td align="center">{$item.TONorm}</td>
                <td align="center">{$item.SPL|default:0}</td>
                <td align="center">{$item.TNight|default:0}</td>
                <td align="center">{$item.TX|default:0}</td>
                <td align="center">{$item.TCO|default:0}</td>
                <td align="center">{$item.TCE|default:0}</td>
                <td align="center">{$item.TCM|default:0}</td>
                <td align="center">{$item.TCFS|default:0}</td>
                <td align="center">{$item.TAbs|default:0}</td>
                <td align="center">{$item.TInv|default:0}</td>
                <td align="center">{$item.TCIC|default:0}</td>
                <td align="center">{$item.TT|default:0}</td>
                <td align="center">{$item.TNelucr|default:0}</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td>&nbsp;</td>
                <td>{$item.FullName}</td>
                <td>{translate label='2.SPL'}</td>
                <td align="center">{$item.MaxSPL}</td>
                <td align="center">{$item.SPL}</td>
                {foreach from=$cal key=data item=wday}
                    <td align="center"
                        {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>{math equation="x+y" x=$item.Data.$data.Hours_SplW|default:0 y=$item.Data.$data.Hours_Spl|default:0}</td>
                {/foreach}
                <td colspan="16">&nbsp;</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td>&nbsp;</td>
                <td>{$item.FullName}</td>
                <td>{translate label='3.Noapte'}</td>
                <td align="center">{$item.MaxNight}</td>
                <td align="center">{$item.TNight}</td>
                {foreach from=$cal key=data item=wday}
                    <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>{$item.Data.$data.Hours_Night|default:0}</td>
                {/foreach}
                <td colspan="16">&nbsp;</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td style="border-bottom: 1px solid #000000;">&nbsp;</td>
                <td style="border-bottom: 1px solid #000000;">{$item.FullName}</td>
                <td style="border-bottom: 1px solid #000000;">{translate label='4.Nelucr.'}</td>
                <td style="border-bottom: 1px solid #000000;" align="center">0</td>
                <td style="border-bottom: 1px solid #000000;" align="center">{math equation="x*y" x=$item.TNelucr y=$item.WorkNorm}</td>
                {foreach from=$cal key=data item=wday}
                    <td align="center" style="border-bottom: 1px solid #000000;"
                        {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}>{$item.Data.$data.Nelucr|default:0}</td>
                {/foreach}
                <td colspan="16" style="border-bottom: 1px solid #000000;">&nbsp;</td>
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}