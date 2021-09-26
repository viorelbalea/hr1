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

            {if in_array('ShowAll', $lstVisibleFilters)}
                <td><input type="checkbox" id="ShowAll" name="ShowAll" value="1" {if !empty($smarty.get.ShowAll)} checked="checked"{/if} /><label
                            for="ShowAll">{translate label='Date abonament'}</label></td>
            {else}
                <td><input type="hidden" id="ShowAll" value="0"/></td>
            {/if}

            <td>&nbsp;</td>

            <td><input type="button" value="{translate label='Afiseaza'}" onclick="window.location.href = './?m=reports&rep=128&GroupID={$smarty.get.GroupID}'

                        + '&CompanyID=' + document.getElementById('CompanyID').value

                        + '&DepartmentID='+document.getElementById('DepartmentID').value

                        + '&ShowAll='+(document.getElementById('ShowAll').checked ? 1 : 0)

                        + '&StartDate=' + document.getElementById('StartDate').value

                        + '&EndDate=' + document.getElementById('EndDate').value">

            </td>

        </tr>

    </table>
    <br>
{/if}


<table width="100%" cellspacing="0" cellpadding="2" border="1">

    <tr>

        {if empty($smarty.get.export)}
            <td rowspan="2" align="center">#</span></td>
        {/if}

        <td rowspan="2" align="center">{translate label='Departament'}</span></td>

        <td rowspan="2" align="center">{translate label='Nume'}</span></td>

        <td rowspan="2" align="center">{translate label='Nr telefon'}</span></td>

        <td rowspan="2" align="center">{translate label='Data alocare'}</span></td>

        <td rowspan="2" align="center">{translate label='Tip abonament'}</span></td>


        {if !empty($smarty.get.ShowAll)}
            <td colspan="4" align="center" style="color: #e8e8e8; background-color: #f00;">{translate label='Minute'}</td>
            <td colspan="2" align="center" style="color: #e8e8e8; background-color: #f00;">{translate label='SMS'}</td>
            <td colspan="1" align="center" style="color: #e8e8e8; background-color: #f00;">{translate label='Date MB National'}</td>
            <td colspan="2" align="center" style="color: #e8e8e8; background-color: #f00;">{translate label='Roaming'}</td>
            <td colspan="1" align="center" style="color: #e8e8e8; background-color: #f00;">{translate label='Prelungire achizitie telefon'}</td>
        {/if}


        <td rowspan="2" align="center">{translate label='Cost'}</span></td>

        <td colspan="3" align="center">{translate label='Utilizatorul anterior'}</td>

    </tr>

    <tr>


        {if !empty($smarty.get.ShowAll)}
            <td align="center">{translate label='Grup'}</td>
            <td align="center">{translate label='Nationale'}</td>
            <td align="center">{translate label='Alte retele mobile'}</td>
            <td align="center">{translate label='International'}</td>
            <td align="center">{translate label='Retea'}</td>
            <td align="center">{translate label='Nationale'}</td>
            <td align="center">{translate label='Trafic date inclus'}</td>
            <td align="center">{translate label='Voce min/sms'}</td>
            <td align="center">{translate label='Date MB'}</td>
            <td align="center">&nbsp;</td>
        {/if}


        <td align="center">{translate label='Nume'}</span></td>

        <td align="center">{translate label='Data inceput'}</span></td>

        <td align="center">{translate label='Data sfarsit'}</span></td>


    </tr>

    {foreach from=$phones key=key item=item name=iter}
        <tr>

            {if empty($smarty.get.export)}
                <td align="center">{$smarty.foreach.iter.iteration}</td>{/if}

            <td align="left">{$item.Department|default:'&nbsp;'}</td>

            <td align="left">{$item.FullName|default:'&nbsp;'}</td>

            <td align="center">{$item.PhoneNo|default:'&nbsp;'}</td>

            <td align="center">{if $item.StartDate != '0000-00-00' && $item.StartDate > 0}{$item.StartDate|default:'&nbsp;'|date_format:'%d.%m.%Y'}{else}-{/if}</td>

            <td align="left">{$item.ContractType|default:'&nbsp;'}</td>


            {if !empty($smarty.get.ShowAll)}
                <td align="center">{$item.MinuteGrup|default:'&nbsp;'}</td>
                <td align="center">{$item.MinuteNationale|default:'&nbsp;'}</td>
                <td align="center">{$item.MinuteAlte|default:'&nbsp;'}</td>
                <td align="center">{$item.MinuteInternationale|default:'&nbsp;'}</td>
                <td align="center">{$item.SMSRetea|default:'&nbsp;'}</td>
                <td align="center">{$item.SMSNat|default:'&nbsp;'}</td>
                <td align="center">{$item.TraficNational|default:'&nbsp;'}</td>
                <td align="center">{$item.RoamingVoce|default:'&nbsp;'}</td>
                <td align="center">{$item.RoamingTrafic|default:'&nbsp;'}</td>
                <td align="center">{$item.PrelungireAchizitie|default:'&nbsp;'}</td>
            {/if}


            <td align="right">{$item.Cost|default:'&nbsp;'}</td>

            <td align="left">{$item.PrevFullName|default:'&nbsp;'}</td>

            <td align="center">{if $item.PrevStartDate != '0000-00-00' && $item.PrevStartDate > 0}{$item.PrevStartDate|default:'&nbsp;'|date_format:'%d.%m.%Y'}{else}-{/if}</td>

            <td align="center">{if $item.PrevStopDate != '0000-00-00'&& $item.PrevStopDate > 0}{$item.PrevStopDate|default:'&nbsp;'|date_format:'%d.%m.%Y'}{else}-{/if}</td>

        </tr>
    {/foreach}

    {if count($phones) < 1}
        <tr height="30">
            <td colspan="{if !empty($smarty.get.export)}14{else}13{/if}" class="celulaMenuSTDR">{translate label='Nu sunt date'}!</td>
        </tr>
    {/if}

</table>