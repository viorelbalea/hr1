{if empty($smarty.get.print) && empty($smarty.get.print_all) && empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        {if !empty($smarty.get.success)}
            <tr>
                <td colspan="100" align="center" style="color: #00f;">{translate label='Generarea a fost efectuata.'}</td>
            </tr>
        {/if}
        <tr>

            <td style="padding-left: 2px;" width="125">
                {translate label='Anul'}
                <select id="Year" name="Year">
                    <option value=""></option>
                    {foreach from=$years item=year}
                        <option value="{$year}" {if $smarty.get.Year == $year} selected="selected"{/if}>{$year}</option>
                    {/foreach}
                </select>
            </td>
            {if $smarty.session.USER_ID==1 || !empty($smarty.session.USER_COMPANYSELF)}
                <td style="padding-left: 2px;" width="75">
                    <select id="CompanyID" name="CompanyID" class="dropdown">
                        <option value="0">{translate label='Toate Companiile'}</option>
                        {foreach from=$self key=key item=item}
                            {if $smarty.session.USER_ID==1 || in_array($key, $smarty.session.USER_COMPANYSELF)}
                                <option value="{$key}" {if $key==$smarty.get.CompanyID}selected{/if}>{translate label=$item}</option>
                            {/if}
                        {/foreach}
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DivisionID" name="DivisionID" class="dropdown">
                        <option value="0">{translate label='Divizie'}</option>
                        {foreach from=$divisions key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DivisionID}selected{/if}>{translate label=$item}</option>
                        {/foreach}
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DepartmentID" name="DepartmentID" class="dropdown">
                        <option value="0">{translate label='Departament'}</option>
                        {foreach from=$departments key=key item=item}
                            <option value="{$key}" {if $key==$smarty.get.DepartmentID}selected{/if}>{translate label=$item}</option>
                        {/foreach}
                    </select>
                </td>
            {/if}

            <td>&nbsp;</td>
            <td><input type="button" value="{translate label='Afiseaza'}"
                       onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep=154&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value;">
            </td>
            <td><input type="button" value="{translate label='Genereaza'}"
                       onclick="window.location.href = './?m=reports&GroupID={$smarty.get.GroupID|default:0}&rep=154&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&generate=1';">
            </td>
        </tr>
    </table>
    <br>
{/if}
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <tr>
        <td rowspan="2"><b>#</b></td>
        <td rowspan="2"><b>Nume</b></td>
        <td rowspan="2"><b>Functia</b></td>
        <td rowspan="2"><b>CNP</b></td>
        <td rowspan="2"><b>Salariu brut</b></td>
        <td rowspan="2"><b>Divizia</b></td>
        <td colspan="7" align="center"><b>{translate label='Aprilie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Mai'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Iunie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Iulie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='August'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Septembrie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Octombrie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Noiembrie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Decembrie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Ianuarie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Februarie'}</b></td>
        <td colspan="7" align="center"><b>{translate label='Martie'}</b></td>
    </tr>
    <tr>
        {section name=x loop=12}
            <td><b>{translate label='Stoc anterior'}</b></td>
            <td><b>{translate label='Lucrate'}</b></td>
            <td><b>{translate label='Platite'}</b></td>
            <td><b>{translate label='Rest'}</b></td>
            <td><b>{translate label='Ore'}</b></td>
            <td><b>{translate label='Plata luna urm.'}</b></td>
            <td><b>{translate label='Stoc'}</b></td>
        {/section}
    </tr>

    {foreach from=$persons key=PersonID item=person name=pfor}
        <tr>
            <td>{$smarty.foreach.pfor.iteration}</td>
            <td>{$person.PersonDetails.FullName|default:'&nbsp;'}</td>
            <td>{$person.PersonDetails.Function|default:'&nbsp;'}</td>
            <td>{$person.PersonDetails.CNP|default:'&nbsp;'}</td>
            <td>{$person.PersonDetails.Salary|default:'&nbsp;'}</td>
            <td>{$divisions[$person.PersonDetails.DivisionID]|default:'&nbsp;'}</td>

            {section name=mit loop=12}
                <td style="background: #fffd38;">{$person.Months[$smarty.section.mit.index].StocAnterior|default:'&nbsp'}</td>
                <td style="background: #fbd5b6;">{$person.Months[$smarty.section.mit.index].OreL|default:'&nbsp'}</td>
                <td style="background: #b9cce3;">{$person.Months[$smarty.section.mit.index].OreP|default:'&nbsp'}</td>
                <td>{$person.Months[$smarty.section.mit.index].Rest|default:'&nbsp'}</td>
                <td>{$person.Months[$smarty.section.mit.index].Ore|default:'&nbsp'}</td>
                <td {if $person.Months[$smarty.section.mit.index].Plata > 0}style="background: #fd9cfd;"{/if}>{$person.Months[$smarty.section.mit.index].Plata|default:'&nbsp'}</td>
                <td>{$person.Months[$smarty.section.mit.index].Stoc|default:'&nbsp'}</td>
            {/section}
        </tr>
    {/foreach}

</table>
{if empty($smarty.get.print) && empty($smarty.get.print_all) && empty($smarty.get.export) && empty($smarty.get.export_doc)}
{literal}
    <script type="text/javascript">
        function winReload() {
            setTimeout(function () {
                window.location.reload();
            }, 500);
        }
    </script>
{/literal}
{/if}