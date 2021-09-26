<div class="filter">
    {if in_array('StartDate', $lstVisibleFilters)}
        <label>{translate label='Saptamana intre'}</label>
        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$def_start|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                  title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A></label>
    {else}
        <input type="hidden" id="StartDate" value=""/>
    {/if}
    {if in_array('EndDate', $lstVisibleFilters)}
        {translate label='si'}
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$def_end|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <label><A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                  title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A></label>
    {else}
        <input type="hidden" id="EndDate" value=""/>
    {/if}
    {if in_array('NoCatering', $lstVisibleFilters)}
        <input type="checkbox" id="NoCatering" value="1" {if $smarty.get.NoCatering==1} checked="checked"{/if}>
        <label>{translate label='vezi doar angajatii care nu au ales meniu'}</label>
    {else}
        <input type="hidden" id="NoCatering" value="0"/>
    {/if}
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                   '&EndDate=' + document.getElementById('EndDate').value +
                   '&NoCatering=' + (document.getElementById('NoCatering').checked ? 1 : 0);">
    {if isset($smarty.get.StartDate)}
</div>

{if !empty($smarty.get.NoCatering)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Marca'}</b></td>
            <td><b>{translate label='Nume si prenume'}</b></td>
        </tr>
        {foreach from=$catering item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.EmpCode|default:'-'}</td>
                <td>{$item.FullName}</td>
            </tr>
        {/foreach}
    </table>
{else}
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td><b>{orderby label='Nume si prenume' request_uri=$request_uri order_by=FullName}</b></td>
            <td><b>{orderby label='Marca' request_uri=$request_uri order_by=EmpCode}</b></td>
            <td><b>{orderby label='Data' request_uri=$request_uri order_by=Date}</b></td>
            <td><b>{orderby label='Nume mancare' request_uri=$request_uri order_by=Item}</b></td>
            <td><b>{orderby label='Tip mancare' request_uri=$request_uri order_by=Category}</b></td>
            <td><b>{orderby label='Portii' request_uri=$request_uri order_by=No}</b></td>
        </tr>
        {foreach from=$catering item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{$item.EmpCode|default:'-'}</td>
                <td>{$item.Date|date_format:'%d.%m.%Y'}</td>
                <td>{$item.Item}</td>
                <td>{$item.Category}</td>
                <td>{$item.No}</td>
            </tr>
        {/foreach}
    </table>
{/if}
{/if}