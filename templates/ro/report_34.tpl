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

{if in_array('Status', $lstVisibleFilters)}
    <select id="Status">

        <option value="0">{translate label='alege status'}</option>

        {foreach from=$status key=key item=item}
            <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
        {/foreach}

    </select>
{else}
    <input type="hidden" name="Status" id="Status" value="0"/>
{/if}

{if in_array('ContractType', $lstVisibleFilters)}
    <select id="ContractType">

        <option value="0">{translate label='alege tip contract'}</option>

        {foreach from=$contract_type key=key item=item}
            <option value="{$key}" {if $smarty.get.ContractType == $key}selected{/if}>{$item}</option>
        {/foreach}

    </select>
{else}
    <input type="hidden" name="ContractType" id="ContractType" value="0"/>
{/if}

&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Trimite'}"
                         onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&Status=' + document.getElementById('Status').value + '&ContractType=' + document.getElementById('ContractType').value;">

{if !empty($smarty.get.StartDate)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">

        <tr>

            <td><b>#</b></td>

            <td><b>{orderby label='Nume' request_uri=$request_uri order_by=FullName}</b></td>

            <td><b>{orderby label='Data angajarii' request_uri=$request_uri order_by=StartDate}</b></td>

            <td><b>{orderby label='Status' request_uri=$request_uri order_by=Status}</b></td>

            <td><b>{orderby label='Tip contract' request_uri=$request_uri order_by=COntractType}</b></td>

        </tr>

        {foreach from=$persons item=item name=iter}
            <tr>

                <td>{$smarty.foreach.iter.iteration}</td>

                <td>{$item.FullName}</td>

                <td>{$item.DataStart}</td>

                <td>{$status[$item.Status]}</td>

                <td>{$contract_type[$item.ContractType]|default:'-'}</td>

            </tr>
        {/foreach}

    </table>
{/if}