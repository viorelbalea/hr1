{if empty($smarty.get.export) && empty($smarty.get.export_doc)}
    <table cellspacing="0" cellpadding="2">
        <tr>
            <td>{translate label='An'}:</td>
            <td>
                <select name="Year" id="Year">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$years key=key item=item}
                        <option value="{$item}" {if $smarty.get.Year == $item}selected{/if}>{$item}</option>
                    {/foreach}
                </select>
            </td>
            <td>
                <select name="Month" id="Month">
                    <option value="0">{translate label='alege...'}</option>
                    {foreach from=$months key=key item=item}
                        <option value="{$key}" {if $smarty.get.Month == $key}selected{/if}>{$item}</option>
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
                       onclick="window.location.href = './?m=reports&rep=152&GroupID={$smarty.get.GroupID}&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&Month=' + document.getElementById('Month').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value;">
            </td>
        </tr>
    </table>
    <br>
{/if}
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <!-- Fields -->
    <tr>
        <td><b>#</b></td>
        <td><b>{translate label='Divizie'}</b></td>
        <td><b>{translate label='CNP'}</b></td>
        <td><b>{translate label='Nume'}</b></td>
        <td><b>{translate label='Prenume'}</b></td>
        <td><b>{translate label='Judet'}</b></td>
        <td><b>{translate label='Localitate'}</b></td>
        <td><b>{translate label='Sector'}</b></td>
        <td><b>{translate label='Cod postal'}</b></td>
        <td><b>{translate label='Adresa'}</b></td>
        <td><b>{translate label='Telefon'}</b></td>
        <td><b>{translate label='Email'}</b></td>
        <td><b>{translate label='Cont personal'}</b></td>
        <td><b>{translate label='Banca'}</b></td>
        <td><b>{translate label='Sucursala'}</b></td>
        <td><b>{translate label='Data angajarii'}</b></td>
        <td><b>{translate label='Data incetarii activitatii'}</b></td>
        <td><b>{translate label='Casa de asigurari de sanatate'}</b></td>
        <td><b>{translate label='Invaliditate'}</b></td>
        <td><b>{translate label='Grupa CAS'}</b></td>
        <td><b>{translate label='Functie'}</b></td>
        <td><b>{translate label='Durata contractului de munca'}</b></td>
        <td><b>{translate label='Tipul contractului de munca'}</b></td>
        <td><b>{translate label='Norma zilnica'}</b></td>
        <td><b>{translate label='Salariul tarifar brut'}</b></td>
        <td><b>{translate label='Mod calcul salariu'}</b></td>
        <td><b>{translate label='Salariu agreat RON'}</b></td>
        <td><b>{translate label='Curs valutar'}</b></td>
    </tr>

    <!-- Values -->
    {foreach from=$persons item=person name=iter}
        <tr>
            <td>{$smarty.foreach.iter.iteration}</td>
            <td>{$divisions[$person.DivisionID]|default:'&nbsp;'}</td>
            <td>{$person.CNP|default:'&nbsp;'}</td>
            <td>{$person.LastName|default:'&nbsp;'}</td>
            <td>{$person.FirstName|default:'&nbsp;'}</td>
            <td>{$person.DistrictName|default:'&nbsp;'}</td>
            <td>{$person.CityName|default:'&nbsp;'}</td>
            <td>{$person.Sector|default:'&nbsp;'}</td>
            <td>{$person.StreetCode|default:'&nbsp;'}</td>
            <td>{$person.StreetName|default:'&nbsp;'}{if !empty($person.Bl)} {translate label='Bl.'}{$person.Bl|default:'&nbsp;'}{/if}{if !empty($person.Sc)} {translate label='Sc.'} {$person.Sc|default:'&nbsp;'}{/if}{if !empty($person.Et)} {translate label='Et.'} {$person.Et|default:'&nbsp;'}{/if}{if !empty($person.Ap)} {translate label='Ap.'} {$person.Ap|default:'&nbsp;'}{/if}</td>
            <td>{$person.Mobile|default:'&nbsp;'}</td>
            <td>{$person.Email|default:'&nbsp;'}</td>
            <td>{$person.BankAccount|default:'&nbsp;'}</td>
            <td>{$person.BankName|default:'&nbsp;'}</td>
            <td>{$person.BankLocation|default:'&nbsp;'}</td>
            <td>{if !empty($person.StartDate)}{$person.StartDate|date_format:'%d.%m.%Y'}{else}&nbsp;{/if}</td>
            <td>{if !empty($person.StopDate) && $person.StopDate != '0000-00-00'}{$person.StopDate|date_format:'%d.%m.%Y'}{else}&nbsp;{/if}</td>
            <td>{$health_companies[$person.HealthCompanyID]|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td>{$person.Function|default:'&nbsp;'}</td>
            <td>{$contract_types[$person.ContractType]|default:'&nbsp;'}</td>
            <td>Contract Individual de Munca</td>
            <td>{$person.WorkNorm|default:'&nbsp;'}</td>
            <td>{$person.Salary|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
            <td>{$person.SalaryNet|default:'&nbsp;'}</td>
            <td>&nbsp;</td>
        </tr>
        {foreachelse}
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR">{translate label='Nu exista inregistrari!'}</td>
        </tr>
    {/foreach}

</table>