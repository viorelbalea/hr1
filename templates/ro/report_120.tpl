<style type="text/css">
    {literal}
    @page {
        size: landscape;
        margin: 0.5cm;
    }

    {/literal}
</style>

<style type="text/css" media="print">
    {literal}
    @page {
        size: landscape;
        margin: 0.5cm;
    }

    {/literal}
</style>

{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <div class="filter">
        {if in_array('StartDate', $lstVisibleFilters)}
            <label>{translate label='Perioada intre'}</label>
            <input type="text" name="StartDate" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:''}" size="10" maxlength="10">
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
            <input type="text" name="EndDate" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:''}" size="10" maxlength="10">
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
        {if in_array('CompanyID', $lstVisibleFilters)}
            <select id="CompanyID" style="width:200px; margin-left:15px;">
                <option value="0">{translate label='- alege beneficiar -'}</option>
                {foreach from=$companies key=key item=item}
                    <option value="{$key}" {if $smarty.get.CompanyID == $key}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="CompanyID" value="0"/>
        {/if}
        {if in_array('Self', $lstVisibleFilters)}
            <input type="checkbox" id="Self" value="1" {if $smarty.get.Self==1}checked{/if}/>
            <label for="Self">Companie Self</label>
        {else}
            <input type="hidden" id="Self" value="0"/>
        {/if}
        {if in_array('FinanciarID', $lstVisibleFilters)}
            <select id="FinanciarID" style="margin-left:15px;">
                <option value="0">{translate label='- alege responsabil financiar -'}</option>
                {foreach from=$persons key=key item=item}
                    <option value="{$key}" {if $smarty.get.FinanciarID == $key}selected{/if}>{$item.FullName}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="FinanciarID" value="0"/>
        {/if}
        {if in_array('TehnicID', $lstVisibleFilters)}
            <select id="TehnicID">
                <option value="0">{translate label='- alege responsabil tehnic -'}</option>
                {foreach from=$persons key=key item=item}
                    <option value="{$key}" {if $smarty.get.TehnicID == $key}selected{/if}>{$item.FullName}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="TehnicID" value="0"/>
        {/if}
        {if in_array('Status', $lstVisibleFilters)}
            <select id="Status" name="Status" class="cod">
                <option value="0">{translate label='Stare contract'}</option>
                {foreach from=$status key=key item=item}
                    <option value="{$key}" {if $key==$smarty.get.Status}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="Status" value="0"/>
        {/if}
        <input type="button" value="{translate label='Trimite'}"
               onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                       '&EndDate=' + document.getElementById('EndDate').value +
                       '&CompanyID=' + document.getElementById('CompanyID').value +
                       '&FinanciarID=' + document.getElementById('FinanciarID').value +
                       '&TehnicID=' + document.getElementById('TehnicID').value +
                       '&Self=' + (document.getElementById('Self').checked ? 1 : 0) +
                       '&Status=' + document.getElementById('Status').value;">
    </div>
{/if}

<table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
    <tr>
        <td><b>#</b></td>
        {foreach from=$fields item=field}
            {if !empty($field.sort)}
                {if $field.sort === 'asc'}
                    <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=asc}</b></td>
                {elseif $field.sort === 'desc'}
                    <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name asc_or_desc=desc}</b></td>
                {else}
                    <td><b>{orderby label=$field.label request_uri=$request_uri order_by=$field.name}</b></td>
                {/if}
            {else}
                <td><b>{translate label=$field.label}</b></td>
            {/if}
        {/foreach}
    </tr>
    {if count($fields_data) > 0}
        {foreach from=$fields_data key=type item=lstContracts}
            {if $lstContracts|@count > 0}
                <tr style="border:0px; height:30px;">
                    {if $type == 3}
                        <td colspan="10" style="text-align:center; font-weight:bold;">PLATA TRIMESTRIALA</td>
                    {elseif $type == 2}
                        <td colspan="10" style="text-align:center;  font-weight:bold;">ABONAMENT LUNAR</td>
                    {elseif $type == 4}
                        <td colspan="10" style="text-align:center;  font-weight:bold;">PLATA IN RATE (+ INTEGRALA)</td>
                    {/if}
                </tr>
                {foreach from=$lstContracts key=key item=item name=iter}
                    <tr>
                        <td>{$smarty.foreach.iter.iteration}</td>

                        {foreach from=$fields item=field}
                            {assign var=field_name value=$field.name}
                            <td{if $field.align} align="{$field.align}"{/if}>{$item.$field_name|default:'&nbsp'}</td>
                        {/foreach}

                    </tr>
                {/foreach}
            {/if}
        {/foreach}
    {else}
        <tr>
            <td colspan="100" align="center">{translate label='Nu exista inregistrari'}</td>
        </tr>
    {/if}
</table>