{if empty($smarty.get.export_doc) && empty($smarty.get.export) && empty($smarty.get.print)}
    <table cellspacing="0" cellpadding="0" height="60" width="100%" class="filter">
        <tr>
            {if in_array('Year', $lstVisibleFilters)}
                <td style="padding-left: 4px;" width="110">
                    <label for="Year" style="margin-top:5px;padding-right:5px;">{translate label='Anul: '}</label>
                    <select id="Year" name="Year">
                        <option value=""></option>
                        {foreach from=$years item=year}
                            <option value="{$year}" {if $smarty.get.Year == $year} selected="selected"{/if}>{$year}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="Year" value=""/></td>
            {/if}

            {if !empty($divisions)}
                {if in_array('DivisionID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="275">
                        <label for="Year" style="margin-top:5px;padding-right:5px;">{translate label='Divizia:'}</label>
                        <select id="DivisionID" name="DivisionID" class="dropdown">
                            <option value="0">{translate label='Alege Divizia'}</option>
                            {foreach from=$divisions key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="DivisionID" value="0"/></td>
                {/if}
            {else}
                <td style="padding-left: 4px;" width="75"><input type="hidden" name="DivisionID" value="0"></td>
            {/if}

            {if in_array('Name', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="275">
                    <label for="Year" style="margin-top:5px;padding-right:5px;">Nume:</label>
                    <select id="Name" name="Name" class="dropdown">
                        <option value="0">{translate label='Alege Persoana'}</option>
                        {foreach from=$persons key=key item=item}
                            <option value="{$item.FullName}" {if $item.FullName==$smarty.get.Name}selected{/if}>{$item.FullName}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="Name" value=""/></td>
            {/if}

            <td style="padding-left: 2px;" width="70">
                <input type="button" value="{translate label='Trimite'}" onclick="
                        window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&Year=' + document.getElementById('Year').value +
                        '&DivisionID=' + document.getElementById('DivisionID').value +
                        '&Name=' + document.getElementById('Name').value;"/>
            </td>

            <td>&nbsp;</td>
        </tr>

    </table>
    <br/>
    <br/>
{/if}

{if !empty($smarty.get.Year)}
    <table width="100%" cellspacing="0" cellpadding="2" border="1" class="grid">
        <tr>
            <td><b>#</b></td>
            {foreach from=$fields item=field}
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
                <td colspan="100">{translate label='Nu exista inregistrari'}</td>
            </tr>
        {/foreach}
    </table>
{/if}