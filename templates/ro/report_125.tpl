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

            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&rep=125&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&DepartmentID='+document.getElementById('DepartmentID').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value">
            </td>

        </tr>

    </table>
    <br>
{/if}

<table width="100%" cellspacing="0" cellpadding="2" border="1">

    <tr>

        {if empty($smarty.get.export)}
            <td align="center">#</span></td>
        {/if}

        <td align="center">{translate label='Departament'}</span></td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Angajat'}{else}{orderby label='Angajat' request_uri=$request_uri order_by=FullName asc_or_desc=asc}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Denumire training'}{else}{orderby label='Denumire training' request_uri=$request_uri order_by=TrainingName}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Companie training'}{else}{orderby label='Companie training' request_uri=$request_uri order_by=CompanyName}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Data inceput'}{else}{orderby label='Data inceput' request_uri=$request_uri order_by=StartDate}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Data sfarsit'}{else}{orderby label='Data sfarsit' request_uri=$request_uri order_by=StopDate}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Nr ore'}{else}{orderby label='Nr ore' request_uri=$request_uri order_by=Hours}{/if}</td>

        <td align="center">{if !empty($smarty.get.export) || !empty($smarty.get.export_doc)}{translate label='Cost / Persoana'}{else}{orderby label='Cost / Persoana' request_uri=$request_uri order_by=PersonCost}{/if}</td>


    </tr>

    {foreach from=$persons key=key item=item name=iter}
        <tr height="30">

            {if empty($smarty.get.export)}
                <td align="center">{$smarty.foreach.iter.iteration}</td>{/if}

            <td align="left">{$item.Department|default:'&nbsp;'}</td>

            <td align="left">{$item.FullName|default:'&nbsp;'}</td>

            <td align="left">{$item.TrainingName|default:'&nbsp;'}</td>

            <td align="left">{$item.CompanyName|default:'&nbsp;'}</td>

            <td align="center">{$item.StartDate|default:'&nbsp;'|date_format:'%d.%m.%Y'}</td>

            <td align="center">{$item.StopDate|default:'&nbsp;'|date_format:'%d.%m.%Y'}</td>

            <td align="center">{$item.Hours|default:'&nbsp;'}</td>

            <td align="right">{$item.PersonCost|default:'&nbsp;'}</td>

        </tr>
    {/foreach}



    {if !empty($smarty.get.export)}
        <tr></tr>
    {/if}

    {if count($persons) > 0}

        {foreach from=$sums key=key item=item name=iter}
            <tr>

                <td align="left" colspan="{if !empty($smarty.get.export)}7{else}8{/if}">{$item.Name|default:'&nbsp;'}</td>

                <td align="right">{$item.PersonCost|default:'&nbsp;'}</td>

            </tr>
        {/foreach}
        <tr>

            <td align="center" colspan="{if !empty($smarty.get.export)}7{else}8{/if}">{translate label='TOTAL'}</td>

            <td align="right">{$totals.PersonCost|default:'&nbsp;'}</td>

        </tr>
    {else}
        <tr height="30">
            <td colspan="{if !empty($smarty.get.export)}7{else}8{/if}" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}

</table>