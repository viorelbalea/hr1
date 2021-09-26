{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        <tr>
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                {if in_array('CompanyID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="CompanyID" name="CompanyID" class="dropdown">
                            <option value="0">{translate label='Companie self'}</option>
                            {foreach from=$self key=key item=item}
                                {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                    <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{$item}</option>
                                {/if}
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="CompanyID" value="0"/></td>
                {/if}
                {if in_array('DepartmentID', $lstVisibleFilters)}
                    <td style="padding-left: 2px;" width="75">
                        <select id="DepartmentID" name="DepartmentID" class="dropdown">
                            <option value="0">{translate label='Departament'}</option>
                            {foreach from=$departments key=key item=item}
                                <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{$item}</option>
                            {/foreach}
                        </select>
                    </td>
                {else}
                    <td><input type="hidden" id="DepartmentID" value="0"/></td>
                {/if}
            {/if}
            {if in_array('InventarCategoryID', $lstVisibleFilters)}
                <td style="padding-left: 2px;" width="75">
                    <select id="InventarCategoryID" name="InventarCategoryID" class="dropdown">
                        <option value="0">{translate label='Categorie'}</option>
                        {foreach from=$inventar_categories key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.InventarCategoryID}selected{/if}>{$item}</option>
                        {/foreach}
                    </select>
                </td>
            {else}
                <td><input type="hidden" id="InventarCategoryID" value="0"/></td>
            {/if}
            {if in_array('Token', $lstVisibleFilters)}
                <td>{translate label='Cuvant cheie'}</td>
                <td><input type="text" name="Token" id="Token" value="{$smarty.get.Token}" size="10"/></td>
            {else}
                <td><input type="hidden" id="Token" value=""/></td>
            {/if}
            {if in_array('StartDate', $lstVisibleFilters)}
                <td>{translate label='Perioada intre'}</td>
                <td style="padding-left: 2px;" width="120">
                    <input type="text" id="StartDate" class="formstyle" value="{$smarty.get.StartDate|default:$def_start|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                    <SCRIPT LANGUAGE="JavaScript" ID="js1">
                        var cal1 = new CalendarPopup();
                        cal1.isShowNavigationDropdowns = true;
                        cal1.setYearSelectStartOffset(10);
                        //writeSource("js1");
                    </SCRIPT>
                    <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
                       title="{translate label='Data de inceput'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de inceput'}"></A>
                </td>
            {else}
                <td><input type="hidden" id="StartDate" value=""/></td>
            {/if}
            {if in_array('EndDate', $lstVisibleFilters)}
                <td>{translate label='si'}</td>
                <td style="padding-left: 2px;" width="150">
                    <input type="text" id="EndDate" class="formstyle" value="{$smarty.get.EndDate|default:$def_end|date_format:'%d.%m.%Y'}" size="10" maxlength="10">
                    <SCRIPT LANGUAGE="JavaScript" ID="js2">
                        var cal2 = new CalendarPopup();
                        cal2.isShowNavigationDropdowns = true;
                        cal2.setYearSelectStartOffset(10);
                        //writeSource("js2");
                    </SCRIPT>
                    <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
                       title="{translate label='Data de sfarsit'}"><img src="./images/cal.png" border="0" alt="{translate label='Data de sfarsit'}"></A>
                </td>
            {else}
                <td><input type="hidden" id="EndDate" value=""/></td>
            {/if}
            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}" onclick="window.location.href = './?m=reports&rep=127&GroupID={$smarty.get.GroupID}'
                        + '&CompanyID=' + document.getElementById('CompanyID').value
                        + '&DepartmentID='+document.getElementById('DepartmentID').value
                        + '&InventarCategoryID='+document.getElementById('InventarCategoryID').value
                        + '&Token='+document.getElementById('Token').value
                        + '&StartDate=' + document.getElementById('StartDate').value
                        + '&EndDate=' + document.getElementById('EndDate').value">
            </td>
        </tr>
    </table>
    <br>
{/if}

<table width="100%" cellspacing="0" cellpadding="2" border="1">
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