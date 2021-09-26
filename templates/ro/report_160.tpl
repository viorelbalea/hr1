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
    {if in_array('Status', $lstVisibleFilters)}
        <select id="Status">
            <option value="0">{translate label='alege status'}</option>
            <option value="0">{translate label='Toate'}</option>
            {foreach from=$status key=key item=item}
                <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="Status" value="0"/>
    {/if}
    {if in_array('Name', $lstVisibleFilters)}
        Nume:
        <input id="Name" name="Name" value="{$smarty.get.Name}" style="width:200px;"/>
        &nbsp;&nbsp;&nbsp;
    {else}
        <input type="hidden" name="Name" id="Name" value=""/>
    {/if}

    &nbsp;&nbsp;&nbsp;
    <input type="button" value="{translate label='Afiseaza'}" onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}'+
            '&Year=' + document.getElementById('Year').value+
            '&CompanyID=' + document.getElementById('CompanyID').value +
            '&DivisionID=' + document.getElementById('DivisionID').value +
            '&Status=' + document.getElementById('Status').value +
            '&Name=' + document.getElementById('Name').value;">
{/if}

{if !empty($smarty.get.Year)}
    <br/>
    <br/>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td align="center" style="width:20px;"><b>#</b></td>
            <td align="center" style="width:200px;"><b>{translate label='Nume'}, {translate label='Prenume'}</b></td>
            <td align="center" style="width:80px;"><b>{translate label='CNP'}</b></td>
            <td align="center" style="width:80px;"><b>{translate label='SAL BRUT'} {$persons.PrevYear}</b></td>
            <td align="center"><b>{translate label='Centru de cost'}</b></td>
            <td width="100" align="center" style="background-color:yellow"><b>{translate label='divizia'}</b></td>
            <td align="center"><b>{translate label='Rest dec'} {$persons.PrevYear}</b></td>
            <td style="background-color:#92CDDC;" align="center"><b>{translate label='CO conform CIM'} {$persons.CurrYear}</b></td>
            <td align="center"><b>{translate label='CO efectiv'} {$persons.CurrYear}</b></td>
            {foreach from=$months item=item key=key name=iter}
                <td align="center" width="75"><b>{$item}</b></td>
            {/foreach}
            <td style="background-color:#FFC000;" align="center"><b>{translate label='Rest'} {$persons.CurrYear}</b></td>
        </tr>
        {foreach from=$persons key=key item=item name=iter}
            {if $key>0}
                <tr>
                    <td>{$smarty.foreach.iter.iteration-2}</td>
                    <td>{$item.FullName}</td>
                    <td align="center">{$item.CNP|default:'-'}</td>
                    <td align="center">{if $item.PrevYearSalaryBrut}{$item.PrevYearSalaryBrut} {$item.PrevYearSalaryCurrency}{else}-{/if}</td>
                    <td>{$item.CostCenter|default:'-'}</td>
                    <td style="background-color:#FFC000;">{$item.Division|default:'&nbsp'}</td>
                    <td align="center">{$item.PrevTotalCO|default:0}</td>
                    <td style="background-color:#92CDDC;" align="center">{$item.CurrTotalCORef|default:0}</td>
                    <td align="center">{$item.CurrTotalCO|default:0}</td>
                    {foreach from=$months key=key2 item=item2 name=iter2}
                        <td align="center">
                            {$item.$key2.TCO|default:'0'}
                        </td>
                    {/foreach}
                    <td style="background-color:#FFC000;" align="center">{$item.RestTotalCO|default:0}</td>
                </tr>
            {/if}
        {/foreach}
    </table>
{/if}