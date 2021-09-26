{if in_array('StartDate', $lstVisibleFilters)}
    {translate label='Perioada intre'}
    <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
       title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>
{else}
    <input type="hidden" id="StartDate" value=""/>
{/if}
{if in_array('EndDate', $lstVisibleFilters)}
    {translate label='si'}
    <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal2 = new CalendarPopup();
        cal2.isShowNavigationDropdowns = true;
        cal2.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
       title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A>
{else}
    <input type="hidden" id="EndDate" value=""/>
{/if}
&nbsp;&nbsp;&nbsp;
{if in_array('CVSource1', $lstVisibleFilters)}
    <input type="checkbox" id="CVSource1" value="bestjobs" {if $smarty.get.CVSource1=='bestjobs'}checked{/if}>
    bestjobs&nbsp;
{else}
    <input type="hidden" id="CVSource1" value="0"/>
{/if}
{if in_array('CVSource2', $lstVisibleFilters)}
    <input type="checkbox" id="CVSource2" value="ejobs" {if $smarty.get.CVSource2=='ejobs'}checked{/if}>
    ejobs&nbsp;
{else}
    <input type="hidden" id="CVSource2" value="0"/>
{/if}
{if in_array('CVSource3', $lstVisibleFilters)}
    <input type="checkbox" id="CVSource3" value="recomandare" {if $smarty.get.CVSource3=='recomandare'}checked{/if}>{translate label='recomandare'}&nbsp;
{else}
    <input type="hidden" id="CVSource3" value="0"/>
{/if}
{if in_array('CVSource4', $lstVisibleFilters)}
    <input type="checkbox" id="CVSource4" value="mail" {if $smarty.get.CVSource4=='mail'}checked{/if}>
    mail&nbsp;
{else}
    <input type="hidden" id="CVSource4" value="0"/>
{/if}

&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                                 '&EndDate=' + document.getElementById('EndDate').value +
                                 '&CVSource1=' + (document.getElementById('CVSource1').checked ? document.getElementById('CVSource1').value : '') +
                                 '&CVSource2=' + (document.getElementById('CVSource2').checked ? document.getElementById('CVSource2').value : '') +
                                 '&CVSource3=' + (document.getElementById('CVSource3').checked ? document.getElementById('CVSource3').value : '') +
                                 '&CVSource4=' + (document.getElementById('CVSource4').checked ? document.getElementById('CVSource4').value : '');">
{if isset($smarty.get.StartDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume, prenume'}</b>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=FullName&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=FullName&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Data'}</b>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=CreateDate&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=CreateDate&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Sursa CV'}</b>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=CVSource&asc_or_desc=asc"><img
                            src="./images/s_asc.png" border="0"></a>&nbsp;<a
                        href="./?m=reports&rep=44&StartDate={$smarty.get.StartDate}&EndDate={$smarty.get.EndDate}&CVSource1={$smarty.get.CVSource1}&CVSource2={$smarty.get.CVSource2}&CVSource3={$smarty.get.CVSource3}&CVSource4={$smarty.get.CVSource4}&order_by=CVSource&asc_or_desc=desc"><img
                            src="./images/s_desc.png" border="0"></a></td>
            <td><b>{translate label='Detalii'}</b></td>
        </tr>
        {foreach from=$persons item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{$item.data}</td>
                <td>{$item.CVSource|default:'-'}</td>
                <td>{$item.CVSourceDetails|default:'-'}</td>
            </tr>
        {/foreach}
    </table>
{/if}