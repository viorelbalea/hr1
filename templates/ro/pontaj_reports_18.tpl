<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport pontaj detaliat perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b>
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
            <td colspan="4">&nbsp;</td>
            {assign var="ZL" value="0"}
            {foreach from=$cal key=data item=wday name=iter}
                <td align="center" style="text-align: center; {if $wday=='D' || $wday=='S'} background-color:#fcde63;{elseif isset($legal.$data)} background-color:#99CCFF;{/if}">
                    <b>{$data|date_format:'%e'}</b></td>
            {/foreach}
            <td align="center" style="border-left: 2px solid #000;">oNorm</td>
            <td align="center">oS</td>
            <td align="center">oN</td>
            <td align="center">oL</td>
            <td align="center">oW</td>
            <td align="center">oSN</td>
            <td align="center">oSL</td>
            <td align="center">oSW</td>
            <td align="center">oNL</td>
            <td align="center">oNW</td>
            <td align="center">oLW</td>
            <td align="center">oSNL</td>
            <td align="center">oSLW</td>
            <td align="center">oSNW</td>
            <td align="center">oNLW</td>
            <td align="center">oSNLW</td>
            <td align="center">oI</td>
            <td align="center">oNem</td>
            <td align="center">oR</td>
            <td align="center" style="border-left: 2px solid #000;">zCO</td>
            <td align="center">zCFS</td>
            <td align="center">zCE</td>
            <td align="center">zCIC</td>
            <td align="center">zCS</td>
            <td align="center">zCM</td>
            <td align="center">zCSS</td>
            <td align="center">zCSFS</td>
        </tr>
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume prenume'}</b></td>
            <td align="center"><b>{translate label='Total ore lucrate'}</b></td>
            <td align="center"><b>{translate label='Total ore platite'}</b></td>
            {foreach from=$cal key=data item=wday}
                <td align="center" style="text-align: center; {if $wday=='D' || $wday=='S'} background-color:#fcde63;{elseif isset($legal.$data)} background-color:#99CCFF;{/if}">
                    <b>{$wday}</b></td>
            {/foreach}
            <td colspan="19" style="border-left: 2px solid #000; text-align: center;">{translate label='o = ore'}
                <br/> {translate label='S = Suplimentare, N = Noapte, L = Sarbatori Legale, W = Weekend'} <br/> {translate label='I = Invoire, Nem = Nemotivate, R = Recuperare'}
                <br/> <b>{$ZL} {translate label='zile lucratoare'} </b></td>
            <td colspan="8" style="border-left: 2px solid #000; text-align: center;">
                {translate label='z = zile'} <br/>
                {translate label='CO = Concediu Odihna'} <br/>
                {translate label='CFS = Concediu Fara Salariu'} <br/>
                {translate label='CE = Concediu pentru Evenimente familiale'} <br/>
                {translate label='CIC = Concediu Ingrijire Copil'} <br/>
                {translate label='CS = Concediu Special'} <br/>
                {translate label="CM = Concediu Medical"} <br/>
                {translate label="CSS = Concediu de Studii cu Salariu"}<br/>
                {translate label="CSFS = Concediu de Studii Fara Salariu"}</td>
        </tr>
        {foreach from=$report key=persid item=item name=iter}
            <tr bgcolor="#ffffff">
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td align="center"><b>{$item.Total}</b></td>
                <td align="center"><b>{$item.TotalPlatite}</b></td>
                {foreach from=$cal key=data item=wday}
                    <td align="center"
                        style="text-align: center; {if $wday=='D' || $wday=='S'} background-color:#fcde63;{elseif isset($legal.$data)} background-color:#99CCFF;{/if}">{$item.Data.$data|default:0}</td>
                {/foreach}
                <td align="center" style="border-left: 2px solid #000;">{$item.stat.Normal|default:0}</td>
                <td align="center">{$item.stat.Overtime|default:0}</td>
                <td align="center">{$item.stat.Night|default:0}</td>
                <td align="center">{$item.stat.Legal|default:0}</td>
                <td align="center">{$item.stat.Weekend|default:0}</td>
                <td align="center">{$item.stat.Overtime_Night|default:0}</td>
                <td align="center">{$item.stat.Overtime_Legal|default:0}</td>
                <td align="center">{$item.stat.Overtime_Weekend|default:0}</td>
                <td align="center">{$item.stat.Night_Legal|default:0}</td>
                <td align="center">{$item.stat.Night_Weekend|default:0}</td>
                <td align="center">{$item.stat.Legal_Weekend|default:0}</td>
                <td align="center">{$item.stat.Overtime_Night_Legal|default:0}</td>
                <td align="center">{$item.stat.Overtime_Legal_Weekend|default:0}</td>
                <td align="center">{$item.stat.Overtime_Night_Weekend|default:0}</td>
                <td align="center">{$item.stat.Night_Legal_Weekend|default:0}</td>
                <td align="center">{$item.stat.Overtime_Night_Legal_Weekend|default:0}</td>
                <td align="center">{$item.stat.Leave|default:0}</td>
                <td align="center">{$item.stat.Unfounded|default:0}</td>
                <td align="center">{$item.stat.Recuperate|default:0}</td>
                <td align="center" style="border-left: 2px solid #000;">{$item.zCO|default:0}</td>
                <td align="center">{$item.zCFS|default:0}</td>
                <td align="center">{$item.zCE|default:0}</td>
                <td align="center">{$item.zCIC|default:0}</td>
                <td align="center">{$item.zCS|default:0}</td>
                <td align="center">{$item.zCM|default:0}</td>
                <td align="center">{$item.zCSS|default:0}</td>
                <td align="center">{$item.zCSFS|default:0}</td>
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}