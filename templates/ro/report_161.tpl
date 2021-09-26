{if empty($smarty.get.export_doc) && empty($smarty.get.export) && empty($smarty.get.print)}
    {if in_array('Year', $lstVisibleFilters)}
        {translate label='Anul'}
        <select name="Year" id="Year">
            <option value="0">{translate label='selecteaza'}</option>
            {foreach from=$years item=item}
                <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="Year" id="Year" value="0"/>
    {/if}
    {if in_array('Month', $lstVisibleFilters)}
        {translate label='Luna'}
        <select name="Month" id="Month">
            <option value="0">{translate label='selecteaza'}</option>
            {section name=luna loop=13 start=1 step=1}
                <option value="{$smarty.section.luna.iteration}" {if $smarty.get.Month == $smarty.section.luna.iteration}selected{/if}>{$smarty.section.luna.iteration}</option>
            {/section}
        </select>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="Month" id="Month" value="0"/>
    {/if}
    {if in_array('CompanyID', $lstVisibleFilters)}
        <select id="CompanyID" style="width:150px;">
            <option value="0">{translate label='alege companie'}</option>
            {foreach from=$self key=key item=item}
                <option value="{$key}" {if $smarty.get.CompanyID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="CompanyID" id="CompanyID" value="0"/>
    {/if}
    {if in_array('DivisionID', $lstVisibleFilters)}
        <select id="DivisionID" style="width:150px;">
            <option value="0">{translate label='alege divizie'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $smarty.get.DivisionID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="DivisionID" id="DivisionID" value="0"/>
    {/if}
    {if in_array('Name', $lstVisibleFilters)}
        Nume:
        <input id="Name" name="Name" value="{$smarty.get.Name}" style="width:200px;"/>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="Name" id="Name" value=""/>
    {/if}
    {if in_array('Status', $lstVisibleFilters)}
        <select id="Status" name="Status" style="width:150px;">
            <option value="0">{translate label='Status'}</option>
            <option value="2" {if $smarty.get.Status==2}selected{/if}>{translate label='Angajat'}</option>
            <option value="9" {if $smarty.get.Status==9}selected{/if}>{translate label='Angajat temporar'}</option>
            <option value="12" {if $smarty.get.Status==12}selected{/if}>{translate label='Angajat leasing'}</option>
            <option value="6" {if $smarty.get.Status==6}selected{/if}>{translate label='Plecat'}</option>
            <option value="5" {if $smarty.get.Status==5}selected{/if}>{translate label='Disponibilizat'}</option>
        </select>
    {else}
        <input type="hidden" id="Status" value="0"/>
    {/if}

    &nbsp;&nbsp;&nbsp;
    <input type="button" value="{translate label='Afiseaza'}" onclick="window.location.href = './?m=reports&rep={$smarty.get.rep}'+
            '&Year=' + document.getElementById('Year').value+
            '&Month=' + document.getElementById('Month').value+
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&Status=' + document.getElementById('Status').value;">
{/if}

{if !empty($smarty.get.Year) && !empty($smarty.get.Month)}
<br/><br/>

<table style="width:auto;" cellspacing="0" cellpadding="2" border="1">
    <tr border="0">
        <td border="0" colspan="{math equation='(x + y)' x=$cal|@count y=17}">&nbsp;</td>
        <td style="background-color:#FB5FE8;" border="0" colspan="4"><b>{translate label='zile lucratoare'}: {$nr_lucratoare|default:'0'}</b></td>
        <td border="0" colspan="8">&nbsp;</td>
    </tr>
    <tr>
        <td align="center" style="min-width:20px;"><b>#</b></td>
        <td align="center" style="min-width:20px;"><b>{translate label='Sex'}</b></td>
        <td align="center" style="min-width:150px;"><b>{translate label='Nume'}, {translate label='Prenume'}</b></td>
        <td align="center" style="min-width:80px;"><b>{translate label='CNP'}</b></td>
        <td align="center" style="min-width:60px; background-color:yellow;"><b>{translate label='Salariu de baza brut NOU'} {$CurrYear}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Norma zilnica'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='UM'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Tarifar net'}</b></td>
        <td align="center" style="min-width:80px;"><b>{translate label='Sediu'}</b></td>
        <td align="center" style="min-width:100px; background-color:#FFC000;"><b>{translate label='divizia'}</b></td>
        {foreach from=$cal key=data item=wday name=iter}
            <td align="center"
                style="min-width:30px; text-align: center; {if $wday=='D' || $wday=='S'} background-color:#92D050;{elseif isset($legal.$data)} background-color:#FB5FE8;{/if}">
                <b>{$data|date_format:'%e'}</b></td>
        {/foreach}
        <td align="center" style="min-width:30px; background-color:#FFC000;"><b>{translate label='TOTAL'}</b></td>
        <td align="center" style="min-width:30px; background-color:#00FFFF;"><b>{translate label='Zile CO'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Ore CO'}</b></td>
        <td align="center" style="min-width:30px; background-color:#00FFFF;"><b>{translate label='Zile CE'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Ore CE'}</b></td>
        <td align="center" style="min-width:30px; background-color:#00FFFF;"><b>{translate label='Zile CM'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Ore CM'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Zile lucrate'}</b></td>
        <td align="center" style="min-width:30px; background-color:#00FFFF;"><b>{translate label='Zile CFS'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='Ore CFS'}</b></td>
        <td align="center" style="min-width:30px;"><b>{translate label='total ore SEP'}</b></td>
        <td align="center" style="min-width:50px; background-color:yellow;"><b>{translate label='Avans salariu'}</b></td>
        <td align="center" style="min-width:60px;"><b>{translate label='Prima neta'}</b></td>
        <td align="center" style="min-width:60px;"><b>{translate label='Prima bruta'}</b></td>
        <td align="center" style="min-width:60px;"><b>{translate label='SAL COMPT BRUT'}</b></td>
        <td align="center" style="min-width:60px;"><b>{translate label='Retineri'}</b></td>
        <td align="center" style="min-width:40px; background-color:#92D050;"><b>{translate label='Ore suplim'}</b></td>
        <td align="center" style="min-width:60px; background-color:#92D050;"><b>{translate label='Prima bruta ORE'}</b></td>
        <td align="center" style="min-width:60px; background-color:#FB5FE8;"><b>{translate label='Total brut de plata'}</b></td>
    </tr>

    {foreach from=$persons key=key item=item name=iter}
        <tr>
            <td align="center">{$smarty.foreach.iter.iteration}</td>
            <td align="center">{$item.Sex|default:'-'}</td>
            <td>{$item.FullName}</td>
            <td align="center">{$item.CNP|default:'-'}</td>
            <td align="center" style=" background-color:yellow;">{if $item.SalaryBrut}{$item.SalaryBrut} {$item.SalaryCurrency}{else}-{/if}</td>
            <td align="center">{$item.WorkNorm|default:'0'}</td>
            <td align="center">ore</td>
            <td align="center">&nbsp;</td>
            <td align="center">{$item.Sediu|default:'&nbsp'}</td>
            <td style="background-color:#FFC000;">{$item.Division|default:'&nbsp'}</td>
            {foreach from=$cal key=data item=wday}
                <td align="center"
                    style="text-align: center; {if $wday=='D' || $wday=='S'} background-color:#92D050;{elseif isset($legal.$data)} background-color:#FB5FE8;{/if}">{$item.Data.$data|default:0}</td>
            {/foreach}
            <td align="center" style="background-color:#FFC000;">{$item.TotalOreLucrate|default:'0'}</td>
            <td align="center" style="background-color:#00FFFF;">{$item.TotalZileCO|default:'0'}</td>
            <td align="center" style="">{$item.TotalOreCO|default:'0'}</td>
            <td align="center" style="background-color:#00FFFF;">{$item.TotalZileCE|default:'0'}</td>
            <td align="center" style="">{$item.TotalOreCE|default:'0'}</td>
            <td align="center" style="background-color:#00FFFF;">{$item.TotalZileCM|default:'0'}</td>
            <td align="center" style="">{$item.TotalOreCM|default:'0'}</td>
            <td align="center" style="">{$item.TotalZileLucrate|default:'0'}</td>
            <td align="center" style="background-color:#00FFFF;">{$item.TotalZileCFS|default:'0'}</td>
            <td align="center" style="">{$item.TotalOreCFS|default:'0'}</td>
            <td align="center" style="">{$item.TotalOreSEP|default:'0'}</td>
            <td align="center" style="">&nbsp;</td>
            <td align="center" style="">{if $item.PrimaNeta}{$item.PrimaNeta} {$item.PrimaCurrency}{else}&nbsp;{/if}</td>
            <td align="center" style="">{if $item.PrimaBruta}{$item.PrimaBruta} {$item.PrimaCurrency}{else}&nbsp;{/if}</td>
            <td align="center" style="">&nbsp;</td>
            <td align="center" style="">&nbsp;</td>
            <td align="center" style="">{$item.TotalOreSupl|default:'0'}</td>
            <td align="center" style="">&nbsp;</td>
            <td align="center" style="background-color:#FFC000;">&nbsp;</td>
        </tr>
    {/foreach}






    {/if}