<div class="filter">
    {if !empty($smarty.get.action)}
        <b>{translate label='Raport pontaje nevalidate perioada '}{$smarty.get.StartDate|date_format:'%d.%m.%Y'} - {$smarty.get.EndDate|date_format:'%d.%m.%Y'}</b>
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
        &nbsp;&nbsp;&nbsp;
        <select id="DirectManagerID">
            <option value="0">{translate label='manager'}</option>
            {foreach from=$dmanagers key=key item=item}
                <option value="{$key}" {if $key==$smarty.get.DirectManagerID}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
        <input type="button" value="Trimite"
               onclick="window.location.href = './?m=pontaj&o=reports&report_id={$smarty.get.report_id}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&DirectManagerID=' + document.getElementById('DirectManagerID').value;">
    {/if}
</div>
{if !empty($smarty.get.StartDate) && !empty($smarty.get.EndDate)}
    <div id="layer_p" style="display: none;">
        <h3 class="layer">{translate label='Activitate'}</h3>
        <div id="layer_p_content"></div>
    </div>
    <div id="layer_p_x" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_p').style.display = 'none'; document.getElementById('layer_p_x').style.display = 'none';">X
    </div>
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr valign="bottom">
            <td colspan="2">&nbsp;</td>
            {foreach from=$cal key=data item=wday name=iter}
                <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}><b>{$smarty.foreach.iter.iteration}</b></td>
            {/foreach}
        </tr>
        {foreach from=$report key=persid item=item name=iter}
            <tr bgcolor="#ffffff">
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                {foreach from=$cal key=data item=wday}
                    <td align="center" {if $wday=='D' || $wday=='S' || isset($legal.$data)}bgcolor="#fcde63"{/if}><b>{if $item.StartDate == $data}<a href="#"
                                                                                                                                                     onclick="getAct({$persid}, '{$data}'); return false;"
                                                                                                                                                     title="{translate label='pontaj pentru'} {$data|date_format:'%d.%m.%Y'}">
                                    X</a>{else}&nbsp;{/if}</b></td>
                {/foreach}
            <tr>
                {foreachelse}
            <tr>
                <td class="celulaMenuSTDR" colspan="100">{translate label='Niciun rezultat!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}
{literal}
    <script type="text/javascript">
        function getAct(persid, data) {
            showInfo('./?m=pontaj&o=pdetail_act&PersonID=' + persid + '&StartDate=' + data, 'layer_p_content');
            document.getElementById('layer_p').style.display = 'block';
            document.getElementById('layer_p_x').style.display = 'block';
        }
    </script>
{/literal}    