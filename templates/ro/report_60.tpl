{if empty($smarty.get.export) && empty($smarty.get.export_doc) && empty($smarty.get.print_page) && empty($smarty.get.print) && empty($smarty.get.print_all)}
    {translate label='Document creat intre'}
    <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
       title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>
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
    &nbsp;&nbsp;&nbsp;
    Status:
    <select id="ReadStatus" name="ReadStatus">
        <option value="0" {if $smarty.get.ReadStatus==0} selected="selected"{/if}>{translate label='Toate'}</option>
        <option value="1" {if $smarty.get.ReadStatus==1} selected="selected"{/if}>{translate label='Acceptate'}</option>
        <option value="-1" {if $smarty.get.ReadStatus==-1} selected="selected"{/if}>{translate label='Neacceptate'}</option>
    </select>
    &nbsp;&nbsp;&nbsp;
    Functie:
    <select name="FunctionID" id="FunctionID">
        <option value="0">{translate label='Toate'}</option>
        {foreach from=$internal_functions item=item}
            {foreach from=$item key=key2 item=item2 name=iter2}
                {if $smarty.foreach.iter2.first}<optgroup label="{$item2.GroupName}">{/if}
                <option value="{$key2}" {if $key2==$smarty.get.FunctionID}selected{/if}>{$item2.Function} [{$item2.GroupName} | {$item2.Grad}]</option>
                {if $smarty.foreach.iter2.last}</optgroup>{/if}
            {/foreach}
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
    <input type="button" value="{translate label='Trimite'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&ReadStatus=' + document.getElementById('ReadStatus').value+'&FunctionID=' + document.getElementById('FunctionID').value;">
    {if !empty($smarty.get.StartDate)}
        <br>
        <br>
    {/if}
    <table class="grid" width="100%" cellspacing="0" cellpadding="2" border="1">
        <!-- Fields -->
        <tr>
            <td><b>#</b></td>
            {foreach from=$fields item=field key=kfield name=nfield }
                {if !empty($field.sort)}
                    {if $field.sort === 'asc'}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                    {elseif $field.sort === 'desc'}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                    {else}
                        <td align="center"><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                    {/if}
                {else}
                    <td align="center"><b>{translate label=$field.label}</b></td>
                {/if}
            {/foreach}
        </tr>

        <!-- Values -->
        {foreach from=$fields_data item=item name=iter}
            <tr>
                <td>{$smarty.foreach.iter.iteration}</td>
                {foreach from=$fields item=field}
                    {assign var=field_name value=$field.name}
                    <td{if $field.align} align="{$field.align}"{/if}>{$item.$field_name|default:'&nbsp'}</td>
                {/foreach}
            </tr>
            {foreachelse}
            <tr height="30">
                <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
            </tr>
        {/foreach}
    </table>
{/if}