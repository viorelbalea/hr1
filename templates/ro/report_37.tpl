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
    <input type="hidden" name="StartDate" id="StartDate" value=""/>
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
    <input type="hidden" name="EndDate" id="EndDate" value=""/>
{/if}
{if in_array('Type', $lstVisibleFilters)}
    &nbsp;&nbsp;&nbsp;
    <select id="Type" name="Type" class="dropdown">
        <option value="0">Tip</option>
        {foreach from=$logTypes key=key item=item}
            <option value="{$key}" {if $key==$smarty.get.Type}selected{/if}>{$item}</option>
        {/foreach}
    </select>
{else}
    <input type="hidden" name="Type" id="Type" value="0"/>
{/if}
&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value+ '&Type=' + document.getElementById('Type').value;">
{if !empty($smarty.get.StartDate)}

    &nbsp;&nbsp;&nbsp;
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td><b>{orderby label='Nume' request_uri=$request_uri order_by=FullName}</b></td>
            <td><b>CNP</b></td>
            <td><b>Comment</b></td>
            <td><b>{orderby label='Data' request_uri=$request_uri order_by=CreateDate}</b></td>
            <td><b>{orderby label='Tip utilizator' request_uri=$request_uri order_by=UserName}</b></td>
            <td><b>{orderby label='Nume utilizator' request_uri=$request_uri order_by=UpdateFullName}</b></td>
        </tr>
        {foreach from=$actions item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                <td>{$item.FullName}</td>
                <td>{$item.CNP}</td>
                <td>{$item.Comment}</td>
                <td>{$item.Date}</td>
                <td>{$item.UserName}</td>
                <td>{$item.UpdateFullName|default:'-'}</td>
            </tr>
        {/foreach}
    </table>
{/if}