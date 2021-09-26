{if in_array('Year', $lstVisibleFilters)}
    {translate label='Anul'}
    <select name="Year" id="Year">
        <option value="0">{translate label='selecteaza'}</option>
        {foreach from=$years item=item}
            <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
        {/foreach}
    </select>
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
{if in_array('DepartmentID', $lstVisibleFilters)}
    <select id="DepartmentID" style="width:150px;">
        <option value="0">{translate label='alege departament'}</option>
        {foreach from=$departments key=key item=item}
            <option value="{$key}" {if $smarty.get.DepartmentID == $key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" name="DepartmentID" id="DepartmentID" value="0"/>
{/if}
{if in_array('SubdepartmentID', $lstVisibleFilters)}
    <select id="SubdepartmentID" style="width:150px;">
        <option value="0">{translate label='alege subdepartament'}</option>
        {foreach from=$subdepartments key=key item=item}
            <option value="{$key}" {if $smarty.get.SubdepartmentID == $key}selected{/if}>{$item}</option>
        {/foreach}
    </select>
    &nbsp;&nbsp;&nbsp;
{else}
    <input type="hidden" name="SubdepartmentID" id="SubdepartmentID" value="0"/>
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
&nbsp;&nbsp;&nbsp;<input type="button" value="{translate label='Afiseaza'}"
                         onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}'+
                                 '&Year=' + document.getElementById('Year').value+
                                 '&Status=' + document.getElementById('Status').value +
                                 '&CompanyID=' + document.getElementById('CompanyID').value +
                                 '&DivisionID=' + document.getElementById('DivisionID').value +
                                 '&DepartmentID=' + document.getElementById('DepartmentID').value +
                                 '&SubdepartmentID=' + document.getElementById('SubdepartmentID').value;">
{if !empty($smarty.get.Year)}
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td><b>{translate label='Nume'}</b></td>
            <td><b>{translate label='Departament'}</b></td>
            <td align="center"><b>{translate label='Disponibil la sfarsitul'} {$persons.PrevYear}</b></td>
            <td align="center"><b>{translate label='Cuvenite in'} {$persons.CurrYear}</b></td>
            <td align="center"><b>{translate label='Disponibil la inceputul'} {$persons.CurrYear}</b></td>
            {foreach from=$months item=item key=key name=iter}
                <td align="center"><b>Disponibil la sfarsitul {$key}</b></td>
            {/foreach}
        </tr>
        {foreach from=$persons key=key item=item name=iter}
            <tr>
            {if $key>0}
                <td>{$smarty.foreach.iter.iteration-2}</td>
                <td>{$item.FullName}</td>
                <td>{$item.Department|default:'&nbsp'}</td>
                <td align="center">{$item.PrevTotalCO|default:0}</td>
                <td align="center">{$item.CurrTotalCORef|default:0}</td>
                <td align="center">{$item.CurrTotalCO|default:0}</td>
                {foreach from=$months key=key2 item=item2 name=iter2}
                    <td>
                        {$item.$key2.RemCO|default:'-'}
                    </td>
                {/foreach}
                </tr>
            {/if}
        {/foreach}
    </table>
{/if}