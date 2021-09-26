<div class="filter">
    {if in_array('Year', $lstVisibleFilters)}
        <label>{translate label='An'}:</label>
        <select name="Year" id="Year">
            <option value="0">{translate label='alege...'}</option>
            {foreach from=$years key=key item=item}
                <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="Year" value="0"/>
    {/if}
    {if in_array('DivisionID', $lstVisibleFilters)}
        <label>Divizie:</label>
        <select name="DivisionID" id="DivisionID"
                onchange="window.location.href = './?m=reports&rep=36&DepartmentID=' + document.getElementById('DepartmentID').value + '&TrainingTypeID=' + document.getElementById('TrainingTypeID').value + '&Year=' + document.getElementById('Year').value + '&DivisionID=' + this.value">
            <option value="0">{translate label='alege...'}</option>
            {foreach from=$divisions key=key item=item}
                <option value="{$key}" {if $smarty.get.DivisionID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="DivisionID" value="0"/>
    {/if}
    {if in_array('DepartmentID', $lstVisibleFilters)}
        <label>Departament:</label>
        <select name="DepartmentID" id="DepartmentID">
            <option value="0">{translate label='alege...'}</option>
            {foreach from=$departments key=key item=item}
                <option value="{$key}" {if $smarty.get.DepartmentID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="DepartmentID" value="0"/>
    {/if}
    {if in_array('TrainingTypeID', $lstVisibleFilters)}
        <label>Tip:</label>
        <select name="TrainingTypeID" id="TrainingTypeID">
            <option value="0">{translate label='alege...'}</option>
            {foreach from=$training_types key=key item=item}
                <option value="{$key}" {if $smarty.get.TrainingTypeID == $key}selected{/if}>{$item}</option>
            {/foreach}
        </select>
    {else}
        <input type="hidden" id="TrainingTypeID" value="0"/>
    {/if}
    <input type="button" value="{translate label='Afiseaza'}"
           onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep=36&DivisionID=' + document.getElementById('DivisionID').value + '&Year=' + document.getElementById('Year').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&TrainingTypeID=' + document.getElementById('TrainingTypeID').value">
</div>

<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Nume' request_uri=$request_uri order_by=FullName}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Tip training' request_uri=$request_uri order_by=TrainingType}</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox">{orderby label='Total ore' request_uri=$request_uri order_by=TotalHours}</span></td>
    </tr>
    {foreach from=$persons key=key item=item name=iter}
        <tr height="30">
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$smarty.foreach.iter.iteration}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.FullName}</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.TrainingType} ({if $item.Type==1}intern{else}extern{/if})</td>
            <td class="celulaMenuST" style="border-bottom: 1px solid #999999;">{$item.TotalHours|default:'&nbsp;'}</td>
        </tr>
    {/foreach}
    {if count($persons)==0}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}
</table>
