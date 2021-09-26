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
            <label>{translate label='si'}</label>
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
            <select id="CompanyID" style="width:200px;">
                <option value="0">{translate label='alege companie'}</option>
                {foreach from=$companies key=key item=item}
                    <option value="{$key}" {if $smarty.get.CompanyID == $key}selected{/if}>{$item.CompanyName}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="CompanyID" value="0"/>
        {/if}
        {if in_array('Status', $lstVisibleFilters)}
            <select id="Status">
                <option value="0">{translate label='alege status'}</option>
                {foreach from=$status key=key item=item}
                    <option value="{$key}" {if $smarty.get.Status == $key}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="Status" value="0"/>
        {/if}
        {if in_array('InterventionType', $lstVisibleFilters)}
            <select id="InterventionType">
                <option value="0">{translate label='alege tip interventie'}</option>
                {foreach from=$intervention_types key=key item=item}
                    <option value="{$key}" {if $smarty.get.InterventionType == $key}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="InterventionType" value="0"/>
        {/if}
        {if in_array('Type', $lstVisibleFilters)}
            <select id="Type">
                <option value="0">{translate label='alege tip'}</option>
                {foreach from=$types key=key item=item}
                    <option value="{$key}" {if $smarty.get.Type == $key}selected{/if}>{$item}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="Type" value="0"/>
        {/if}
        {if in_array('PersonID', $lstVisibleFilters)}
            <select id="PersonID">
                <option value="0">{translate label='alege responsabil'}</option>
                {foreach from=$persons key=key item=item}
                    <option value="{$key}" {if $smarty.get.PersonID == $key}selected{/if}>{$item.FullName}</option>
                {/foreach}
            </select>
        {else}
            <input type="hidden" id="PersonID" value="0"/>
        {/if}
        <input type="button" value="{translate label='Trimite'}"
               onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep={$smarty.get.rep}&StartDate=' + document.getElementById('StartDate').value +
                       '&EndDate=' + document.getElementById('EndDate').value +
                       '&Status=' + document.getElementById('Status').value +
                       '&CompanyID=' + document.getElementById('CompanyID').value +
                       '&Status=' + document.getElementById('Status').value +
                       '&Type=' + document.getElementById('Type').value +
                       '&InterventionType=' + document.getElementById('InterventionType').value +
                       '&PersonID=' + document.getElementById('PersonID').value;">
    </div>
{/if}

<table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
    <tr>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='#' request_uri=$request_uri order_by=TicketID asc_or_desc=desc}{else}{translate label='#'}{/if}</b>
        </td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Companie' request_uri=$request_uri order_by=CompanyName}{else}{translate label='Companie'}{/if}</b>
        </td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Solicitant extern' request_uri=$request_uri order_by=ContactName}{else}{translate label='Solicitant extern'}{/if}</b>
        </td>
        <td><b>{translate label='Status'}</b></td>
        <td><b>{translate label='Tip'}</b></td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Responsabil intern' request_uri=$request_uri order_by=FullName}{else}{translate label='Responsabil intern'}{/if}</b>
        </td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Data' request_uri=$request_uri order_by=CreateDate}{else}{translate label='Data'}{/if}</b>
        </td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Timp remediere' request_uri=$request_uri order_by=InterventionDuration}{else}{translate label='Timp remediere'}{/if}</b>
        </td>
        <td>
            <b>{if empty($smarty.get.export) && empty($smarty.get.export_doc)}{orderby label='Timp transport' request_uri=$request_uri order_by=TransportTime}{else}{translate label='Timp transport'}{/if}</b>
        </td>
        <td><b>{translate label='Tip interventie'}</b></td>
    </tr>


    {if count($tickets) > 0}
        {foreach from=$tickets key=key item=item}
            <tr>
                <td>{$key|default:'&nbsp;'}</td>
                <td>{$item.CompanyName|default:'&nbsp;'}</td>
                <td>{$item.ContactName|default:'&nbsp;'}</td>
                <td>{$item.StatusName|default:'&nbsp;'}</td>
                <td>{$item.TypeName|default:'&nbsp;'}</td>
                <td>{$item.FullName|default:'&nbsp;'}</td>
                <td>{$item.CreateDate|default:'&nbsp;'}</td>
                <td>{$item.InterventionDuration|default:'&nbsp;'}</td>
                <td>{$item.TransportTime|default:'&nbsp;'}</td>
                <td>{$item.InterventionTypeName|default:'&nbsp;'}</td>
            </tr>
        {/foreach}
        <tr>
            <td colspan="10"><b>{translate label='Total'}</b></td>
        </tr>
        <tr>
            <td>{$sums.TicketCount|default:'&nbsp;'}</td>
            <td colspan="6">&nbsp;</td>
            <td>{$sums.InterventionDuration|default:'&nbsp;'}</td>
            <td>{$sums.TransportTime|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
        </tr>
    {else}
        <tr>
            <td colspan="100" align="center">{translate label='Nu exista inregistrari'}</td>
        </tr>
    {/if}
</table>