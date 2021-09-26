{if $smarty.get.type!='popup'}
    {include file="settings_menu.tpl"}
{else}
    <link href="images/style.css" rel="stylesheet" type="text/css">
{/if}

<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.coolMultiple.js"></script>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    {if $smarty.get.type!='popup'}
        <tr>
        <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox">{include file="settings_submenu_1.tpl"}</span> <br></td></tr>
    {/if}
    <tr>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="Personal" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Personal'}</legend>
                    <div>
                        <select name="Personal[]" id="Personal" multiple="multiple">
                            <option value="FullNameBeforeMariage" {if !empty($personalisedlist.Personal.FullNameBeforeMariage)} selected="selected"{/if}>{translate label='Nume inainte de casatorie'}</option>
                            <option value="DistrictName" {if !empty($personalisedlist.Personal.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Personal.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="AddressName" {if !empty($personalisedlist.Personal.AddressName)} selected="selected"{/if}>{translate label='Adresa'}</option>
                            <option value="Status" {if !empty($personalisedlist.Personal.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="varsta" {if !empty($personalisedlist.Personal.varsta)} selected="selected"{/if}>{translate label='Varsta'}</option>
                            <option value="CNP" {if !empty($personalisedlist.Personal.CNP)} selected="selected"{/if}>{translate label='CNP'}</option>
                            <option value="CI" {if !empty($personalisedlist.Personal.CI)} selected="selected"{/if}>{translate label='CI serie - numar'}</option>
                            <option value="Sex" {if !empty($personalisedlist.Personal.Sex)} selected="selected"{/if}>Sex</option>
                            <option value="Phone" {if !empty($personalisedlist.Personal.Phone)} selected="selected"{/if}>{translate label='Telefon fix'}</option>
                            <option value="Mobile" {if !empty($personalisedlist.Personal.Mobile)} selected="selected"{/if}>{translate label='Mobil serviciu'}</option>
                            <option value="MobilePersonal" {if !empty($personalisedlist.Personal.MobilePersonal)} selected="selected"{/if}>{translate label='Mobil personal'}</option>
                            <option value="Sarbatoare" {if !empty($personalisedlist.Personal.Sarbatoare)} selected="selected"{/if}>{translate label='Sarbatoare'}</option>
                            <option value="Email" {if !empty($personalisedlist.Personal.Email)} selected="selected"{/if}>Email</option>
                            <option value="MaritalStatus" {if !empty($personalisedlist.Personal.MaritalStatus)} selected="selected"{/if}>{translate label='Stare civila'}</option>
                            <option value="NumberOfChildren" {if !empty($personalisedlist.Personal.NumberOfChildren)} selected="selected"{/if}>{translate label='Numar copii'}</option>
                            <option value="DateOfBirth" {if !empty($personalisedlist.Personal.DateOfBirth)} selected="selected"{/if}>{translate label='Data nasterii'}</option>
                            <option value="CVStatus" {if !empty($personalisedlist.Personal.CVStatus)} selected="selected"{/if}>{translate label='Status CV'}</option>
                            <option value="CompanyID" {if !empty($personalisedlist.Personal.CompanyID)} selected="selected"{/if}>{translate label='Compania'}</option>
                            <option value="DivisionID" {if !empty($personalisedlist.Personal.DivisionID)} selected="selected"{/if}>{translate label='Divizia'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Personal.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="SubDepartmentID" {if !empty($personalisedlist.Personal.SubDepartmentID)} selected="selected"{/if}>{translate label='Subdepartament'}</option>
                            <option value="CostCenterID" {if !empty($personalisedlist.Personal.CostCenterID)} selected="selected"{/if}>{translate label='Centru de cost'}</option>
                            <option value="Studies" {if !empty($personalisedlist.Personal.Studies)} selected="selected"{/if}>{translate label='Pregatire'}</option>
                            <option value="JobDictionaryID" {if !empty($personalisedlist.Personal.JobDictionaryID)} selected="selected"{/if}>{translate label='Profesia'}</option>
                            <option value="ContractType" {if !empty($personalisedlist.Personal.ContractType)} selected="selected"{/if}>{translate label='Tip contract'}</option>
                            <option value="FunctionID" {if !empty($personalisedlist.Personal.FunctionID)} selected="selected"{/if}>{translate label='Functia'}</option>
                            <option value="InternalFunction" {if !empty($personalisedlist.Personal.InternalFunction)} selected="selected"{/if}>{translate label='Functia interna'}</option>
                            <option value="RoleID" {if !empty($personalisedlist.Personal.RoleID)} selected="selected"{/if}>{translate label='Rol'}</option>
                            <option value="FirmAge" {if !empty($personalisedlist.Personal.FirmAge)} selected="selected"{/if}>{translate label='Vechime in firma (a / l / z)'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.Personal.StartDate)} selected="selected"{/if}>Data angajarii</option>
                            <option value="ContractExpDate" {if !empty($personalisedlist.Personal.ContractExpDate)} selected="selected"{/if}>{translate label='Data expirare contract'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Personal.UserName)} selected="selected"{/if}>User</option>
                            <option value="EmpCode" {if !empty($personalisedlist.Personal.EmpCode)} selected="selected"{/if}>Marca</option>
                            <option value="Salary" {if !empty($personalisedlist.Personal.Salary)} selected="selected"{/if}>Salariul brut</option>
                        </select>
                        <input type="hidden" name="Label[FullNameBeforeMariage]" value="Nume inainte de casatorie">
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[AddressName]" value="Adresa">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[varsta]" value="Varsta">
                        <input type="hidden" name="Label[CNP]" value="CNP">
                        <input type="hidden" name="Label[CI]" value="CI serie - numar">
                        <input type="hidden" name="Label[Sex]" value="Sex">
                        <input type="hidden" name="Label[Phone]" value="Telefon fix">
                        <input type="hidden" name="Label[Mobile]" value="Mobil serviciu">
                        <input type="hidden" name="Label[MobilePersonal]" value="Mobil personal">
                        <input type="hidden" name="Label[Sarbatoare]" value="Sarbatoare">
                        <input type="hidden" name="Label[Email]" value="Email">
                        <input type="hidden" name="Label[MaritalStatus]" value="Stare civila">
                        <input type="hidden" name="Label[NumberOfChildren]" value="Numar copii">
                        <input type="hidden" name="Label[DateOfBirth]" value="Data nasterii">
                        <input type="hidden" name="Label[CVStatus]" value="Status CV">
                        <input type="hidden" name="Label[CompanyID]" value="Compania">
                        <input type="hidden" name="Label[DivisionID]" value="Divizia">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[SubDepartmentID]" value="Subdepartament">
                        <input type="hidden" name="Label[CostCenterID]" value="Centru de cost">
                        <input type="hidden" name="Label[Studies]" value="Pregatire">
                        <input type="hidden" name="Label[JobDictionaryID]" value="Profesia">
                        <input type="hidden" name="Label[ContractType]" value="Tip contract">
                        <input type="hidden" name="Label[FunctionID]" value="Functia">
                        <input type="hidden" name="Label[InternalFunction]" value="Functia interna">
                        <input type="hidden" name="Label[RoleID]" value="Rol">
                        <input type="hidden" name="Label[FirmAge]" value="Vechime in firma (a / l / z)">
                        <input type="hidden" name="Label[StartDate]" value="Data angajarii">
                        <input type="hidden" name="Label[ContractExpDate]" value="Data expirare contract">
                        <input type="hidden" name="Label[UserName]" value="User">
                        <input type="hidden" name="Label[EmpCode]" value="Marca">
                        <input type="hidden" name="Label[Salary]" value="Salariul brut">
                    </div>
                    <input type="submit" name="personal" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Company" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Companii'}</legend>
                    <div>
                        <select name="Company[]" id="Company" multiple="multiple">
                            <option value="DistrictName" {if !empty($personalisedlist.Company.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Company.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="Domain" {if !empty($personalisedlist.Company.Domain)} selected="selected"{/if}>{translate label='Domeniu de activitate'}</option>
                            <option value="CIF" {if !empty($personalisedlist.Company.CIF)} selected="selected"{/if}>CIF</option>
                            <option value="RegComert" {if !empty($personalisedlist.Company.RegComert)} selected="selected"{/if}>{translate label='Registrul comertului'}</option>
                            <option value="PhoneNumberA" {if !empty($personalisedlist.Company.PhoneNumberA)} selected="selected"{/if}>{translate label='Telefon 1'}</option>
                            <option value="PhoneNumberB" {if !empty($personalisedlist.Company.PhoneNumberB)} selected="selected"{/if}>{translate label='Telefon 2'}</option>
                            <option value="FaxNumber" {if !empty($personalisedlist.Company.FaxNumber)} selected="selected"{/if}>{translate label='Fax'}</option>
                            <option value="CompanyEmail" {if !empty($personalisedlist.Company.CompanyEmail)} selected="selected"{/if}>Email</option>
                            <option value="EmployeesNo" {if !empty($personalisedlist.Company.EmployeesNo)} selected="selected"{/if}>{translate label='Angajati'}</option>
                            <option value="CompanyWebsite" {if !empty($personalisedlist.Company.CompanyWebsite)} selected="selected"{/if}>WebSite</option>
                            <option value="UserName" {if !empty($personalisedlist.Company.UserName)} selected="selected"{/if}>User</option>
                        </select>
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[Domain]" value="Domeniu de activitate">
                        <input type="hidden" name="Label[CIF]" value="CIF">
                        <input type="hidden" name="Label[RegComert]" value="Registrul comertului">
                        <input type="hidden" name="Label[PhoneNumberA]" value="Telefon 1">
                        <input type="hidden" name="Label[PhoneNumberB]" value="Telefon 2">
                        <input type="hidden" name="Label[FaxNumber]" value="Fax">
                        <input type="hidden" name="Label[CompanyEmail]" value="Email">
                        <input type="hidden" name="Label[EmployeesNo]" value="Angajati">
                        <input type="hidden" name="Label[CompanyWebsite]" value="WebSite">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="company" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Pontaj" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Pontaj'} - {translate label='Proiecte'}</legend>
                    <div>
                        <select name="Pontaj[]" id="Pontaj" multiple="multiple">
                            <option value="DistrictName" {if !empty($personalisedlist.Pontaj.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Pontaj.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="varsta" {if !empty($personalisedlist.Pontaj.varsta)} selected="selected"{/if}>{translate label='Varsta'}</option>
                            <option value="CNP" {if !empty($personalisedlist.Pontaj.CNP)} selected="selected"{/if}>{translate label='CNP'}</option>
                            <option value="Sex" {if !empty($personalisedlist.Pontaj.Sex)} selected="selected"{/if}>Sex</option>
                            <option value="Phone" {if !empty($personalisedlist.Pontaj.Phone)} selected="selected"{/if}>{translate label='Telefon fix'}</option>
                            <option value="Mobile" {if !empty($personalisedlist.Pontaj.Mobile)} selected="selected"{/if}>{translate label='Telefon mobil'}</option>
                            <option value="Email" {if !empty($personalisedlist.Pontaj.Email)} selected="selected"{/if}>Email</option>
                            <option value="DivisionID" {if !empty($personalisedlist.Pontaj.DivisionID)} selected="selected"{/if}>{translate label='Divizia'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Pontaj.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="CostCenterID" {if !empty($personalisedlist.Pontaj.CostCenterID)} selected="selected"{/if}>{translate label='Centru de cost'}</option>
                            <option value="JobDictionaryID" {if !empty($personalisedlist.Pontaj.JobDictionaryID)} selected="selected"{/if}>{translate label='Profesia'}</option>
                            <option value="FunctionID" {if !empty($personalisedlist.Pontaj.FunctionID)} selected="selected"{/if}>{translate label='Functia'}</option>
                        </select>
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[varsta]" value="Varsta">
                        <input type="hidden" name="Label[CNP]" value="CNP">
                        <input type="hidden" name="Label[Sex]" value="Sex">
                        <input type="hidden" name="Label[Phone]" value="Telefon fix">
                        <input type="hidden" name="Label[Mobile]" value="Mobile">
                        <input type="hidden" name="Label[Email]" value="Email">
                        <input type="hidden" name="Label[DivisionID]" value="Divizia">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[CostCenterID]" value="Centru de cost">
                        <input type="hidden" name="Label[JobDictionaryID]" value="Profesia">
                        <input type="hidden" name="Label[FunctionID]" value="Functia">
                    </div>
                    <input type="submit" name="pontaj" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>

            <form action="{$smarty.server.REQUEST_URI}" name="Job" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Joburi'}</legend>
                    <div>
                        <select name="Job[]" id="Job" multiple="multiple">
                            <option value="DistrictName" {if !empty($personalisedlist.Job.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Job.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="no_persons" {if !empty($personalisedlist.Job.no_persons)} selected="selected"{/if}>{translate label='Numar candidati'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.Job.StartDate)} selected="selected"{/if}>{translate label='Data de inceput'}</option>
                            <option value="StopDate" {if !empty($personalisedlist.Job.StopDate)} selected="selected"{/if}>{translate label='Data de sfarsit'}</option>
                            <option value="status" {if !empty($personalisedlist.Job.status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="JobDomainID" {if !empty($personalisedlist.Job.JobDomainID)} selected="selected"{/if}>{translate label='Domeniu'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Job.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="RequiredExperience" {if !empty($personalisedlist.Job.RequiredExperience)} selected="selected"{/if}>{translate label='Experienta'}</option>
                            <option value="JobType" {if !empty($personalisedlist.Job.JobType)} selected="selected"{/if}>{translate label='Tip Job'}</option>
                            <option value="JobDictionaryID" {if !empty($personalisedlist.Job.JobDictionaryID)} selected="selected"{/if}>{translate label='Profesia'}</option>
                            <option value="FunctionIDRecr" {if !empty($personalisedlist.Job.FunctionIDRecr)} selected="selected"{/if}>{translate label='Functia'}</option>
                            <option value="FunctionID" {if !empty($personalisedlist.Job.FunctionID)} selected="selected"{/if}>{translate label='Functia COR'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Job.UserName)} selected="selected"{/if}>User</option>
                        </select>

                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[no_persons]" value="Numar candidati">
                        <input type="hidden" name="Label[StartDate]" value="Data de inceput">
                        <input type="hidden" name="Label[StopDate]" value="Data de sfarsit">
                        <input type="hidden" name="Label[status]" value="Status">
                        <input type="hidden" name="Label[JobDomainID]" value="Domeniu">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[RequiredExperience]" value="Experienta">
                        <input type="hidden" name="Label[JobType]" value="Tip Job">
                        <input type="hidden" name="Label[JobDictionaryID]" value="Profesia">
                        <input type="hidden" name="Label[FunctionIDRecr]" value="Functia">
                        <input type="hidden" name="Label[FunctionID]" value="Functia COR">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="job" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Contract" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Contracte'}</legend>
                    <div>
                        <select name="Contract[]" id="Contract" multiple="multiple">
                            <option value="ContractNo" {if !empty($personalisedlist.Contract.ContractNo)} selected="selected"{/if}>{translate label='Numar contract'}</option>
                            <option value="FullName" {if !empty($personalisedlist.Contract.FullName)} selected="selected"{/if}>{translate label='Responsabil financiar'}</option>
                            <option value="FullNameTechnical" {if !empty($personalisedlist.Contract.FullNameTechnical)} selected="selected"{/if}>{translate label='Responsabil tehnic'}</option>
                            <option value="ContractType" {if !empty($personalisedlist.Contract.ContractType)} selected="selected"{/if}>{translate label='Tip contract'}</option>
                            <option value="PaymentType" {if !empty($personalisedlist.Contract.PaymentType)} selected="selected"{/if}>{translate label='Tip plata'}</option>
                            <option value="CompanyName" {if !empty($personalisedlist.Contract.CompanyName)} selected="selected"{/if}>{translate label='Partener'}</option>
                            <option value="SignDate" {if !empty($personalisedlist.Contract.SignDate)} selected="selected"{/if}>{translate label='Data semnare'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.Contract.StartDate)} selected="selected"{/if}>{translate label='Data inceput'}</option>
                            <option value="StopDate" {if !empty($personalisedlist.Contract.StopDate)} selected="selected"{/if}>{translate label='Data sfarsit'}</option>
                            <option value="ContractValue" {if !empty($personalisedlist.Contract.ContractValue)} selected="selected"{/if}>{translate label='Valoare'}</option>
                            <option value="Coin" {if !empty($personalisedlist.Contract.Coin)} selected="selected"{/if}>{translate label='Moneda'}</option>
                            <option value="PayDate" {if !empty($personalisedlist.Contract.PayDate)} selected="selected"{/if}>{translate label='Data plata'}</option>
                        </select>
                        <input type="hidden" name="Label[ContractNo]" value="Numar contract">
                        <input type="hidden" name="Label[FullName]" value="Responsabil financiar">
                        <input type="hidden" name="Label[FullNameTechnical]" value="Responsabil tehnic">
                        <input type="hidden" name="Label[ContractType]" value="Tip contract">
                        <input type="hidden" name="Label[PaymentType]" value="Tip plata">
                        <input type="hidden" name="Label[CompanyName]" value="Partener">
                        <input type="hidden" name="Label[SignDate]" value="Data semnare">
                        <input type="hidden" name="Label[StartDate]" value="Data inceput">
                        <input type="hidden" name="Label[StopDate]" value="Data sfarsit">
                        <input type="hidden" name="Label[ContractValue]" value="Valoare">
                        <input type="hidden" name="Label[Coin]" value="Moneda">
                        <input type="hidden" name="Label[PayDate]" value="Data plata">
                    </div>
                    <input type="submit" name="contract" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Car" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Masini'}</legend>
                    <div>
                        <select name="Car[]" id="Car" multiple="multiple">
                            <option value="Brand" {if !empty($personalisedlist.Car.Brand)} selected="selected"{/if}>{translate label='Marca'}</option>
                            <option value="Model" {if !empty($personalisedlist.Car.Model)} selected="selected"{/if}>{translate label='Model'}</option>
                            <option value="RegNo" {if !empty($personalisedlist.Car.RegNo)} selected="selected"{/if}>{translate label='Inmatriculare'}</option>
                            <option value="RegDate" {if !empty($personalisedlist.Car.RegDate)} selected="selected"{/if}>{translate label='Data inmatricularii'}</option>
                            <option value="Fuel" {if !empty($personalisedlist.Car.Fuel)} selected="selected"{/if}>{translate label='Combustibil'}</option>
                            <option value="Gear" {if !empty($personalisedlist.Car.Gear)} selected="selected"{/if}>{translate label='Cutie viteze'}</option>
                            <option value="Year" {if !empty($personalisedlist.Car.Year)} selected="selected"{/if}>{translate label='An fabricatie'}</option>
                            <option value="Color" {if !empty($personalisedlist.Car.Color)} selected="selected"{/if}>{translate label='Culoare'}</option>
                            <option value="Cylinders" {if !empty($personalisedlist.Car.Cylinders)} selected="selected"{/if}>{translate label='Cilindree'}</option>
                            <option value="Power" {if !empty($personalisedlist.Car.Power)} selected="selected"{/if}>{translate label='Putere'}</option>
                            <option value="Resp" {if !empty($personalisedlist.Car.Resp)} selected="selected"{/if}>{translate label='Responsabil'}</option>
                            <option value="Status" {if !empty($personalisedlist.Car.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="Patrimony" {if !empty($personalisedlist.Car.Patrimony)} selected="selected"{/if}>{translate label='Patrimoniu'}</option>
                        </select>
                        <input type="hidden" name="Label[Brand]" value="Marca">
                        <input type="hidden" name="Label[Model]" value="Model">
                        <input type="hidden" name="Label[RegNo]" value="Inmatriculare">
                        <input type="hidden" name="Label[RegDate]" value="Data inmatricularii">
                        <input type="hidden" name="Label[Fuel]" value="Combustibil">
                        <input type="hidden" name="Label[Gear]" value="Cutie viteze">
                        <input type="hidden" name="Label[Year]" value="An fabricatie">
                        <input type="hidden" name="Label[Color]" value="Culoare">
                        <input type="hidden" name="Label[Cylinders]" value="Cilindree">
                        <input type="hidden" name="Label[Power]" value="Putere">
                        <input type="hidden" name="Label[Resp]" value="Responsabil">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[Patrimony]" value="Patrimoniu">
                    </div>
                    <input type="submit" name="car" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="Event" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Evenimente'}</legend>
                    <div>
                        <select name="Event[]" id="Event" multiple="multiple">
                            <option value="UserName" {if !empty($personalisedlist.Event.UserName)} selected="selected"{/if}>{translate label='Autor'}</option>
                            <option value="ConsultantID" {if !empty($personalisedlist.Event.ConsultantID)} selected="selected"{/if} >{translate label='Rep. companie'}</option>
                            <option value="Details" {if !empty($personalisedlist.Event.Details)} selected="selected"{/if} >{translate label='Detalii'}</option>
                            <option value="EventStatus" {if !empty($personalisedlist.Event.EventStatus)} selected="selected"{/if} >{translate label='Status'}</option>
                            <option value="EventRelation" {if !empty($personalisedlist.Event.EventRelation)} selected="selected"{/if} >{translate label='Intre'}</option>
                            <option value="EventType" {if !empty($personalisedlist.Event.EventType)} selected="selected"{/if} >{translate label='Tip'}</option>
                            <option value="EventData" {if !empty($personalisedlist.Event.EventData)} selected="selected"{/if} >{translate label='Data'}</option>
                        </select>
                        <input type="hidden" name="Label[UserName]" value="Autor">
                        <input type="hidden" name="Label[ConsultantID]" value="Reprezentant companie">
                        <input type="hidden" name="Label[Details]" value="Detalii">
                        <input type="hidden" name="Label[EventStatus]" value="Status">
                        <input type="hidden" name="Label[EventRelation]" value="Intre">
                        <input type="hidden" name="Label[EventType]" value="Tip">
                        <input type="hidden" name="Label[EventData]" value="Data">
                    </div>
                    <input type="submit" name="event" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Training" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Training'}</legend>
                    <div>
                        <select name="Training[]" id="Training" multiple="multiple">
                            <option value="CompanyName" {if !empty($personalisedlist.Training.CompanyName)} selected="selected"{/if}>{translate label='Companie'}</option>
                            <option value="FullName" {if !empty($personalisedlist.Training.FullName)} selected="selected"{/if}>{translate label='Trainer'}</option>
                            <option value="DistrictName" {if !empty($personalisedlist.Training.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Training.CityName)} selected="selected"{/if}>{translate label='Oras'}</option>
                            <option value="Domain" {if !empty($personalisedlist.Training.Domain)} selected="selected"{/if}>{translate label='Domeniu activitate'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.Training.StartDate)} selected="selected"{/if}>{translate label='Data inceput'}</option>
                            <option value="StopDate" {if !empty($personalisedlist.Training.StopDate)} selected="selected"{/if}>{translate label='Data finala'}</option>
                            <option value="Status" {if !empty($personalisedlist.Training.UserName)} selected="Status"{/if}>{translate label='Status'}</option>
                            <option value="Type" {if !empty($personalisedlist.Training.Type)} selected="Type"{/if}>{translate label='Tip'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Training.UserName)} selected="selected"{/if}>User</option>
                        </select>
                        <input type="hidden" name="Label[CompanyName]" value="Companie">
                        <input type="hidden" name="Label[FullName]" value="Trainer">
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Oras">
                        <input type="hidden" name="Label[Domain]" value="Domeniu activitate">
                        <input type="hidden" name="Label[StartDate]" value="Data inceput">
                        <input type="hidden" name="Label[StopDate]" value="Data finala">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[Type]" value="Tip">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="training" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>
            <form action="{$smarty.server.REQUEST_URI}" name="Ticket" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Cereri'}</legend>
                    <div>
                        <select name="Ticket[]" id="Ticket" multiple="multiple">

                            <option value="FullName" {if !empty($personalisedlist.Ticket.FullName)} selected="selected"{/if}>{translate label='Nume'}</option>
                            <option value="Type" {if !empty($personalisedlist.Ticket.Type)} selected="selected"{/if}>{translate label='Tip'}</option>
                            <option value="Status" {if !empty($personalisedlist.Ticket.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="Comments" {if !empty($personalisedlist.Ticket.Comments)} selected="selected"{/if}>{translate label='Comentarii'}</option>
                            <option value="CreateDate" {if !empty($personalisedlist.Ticket.CreateDate)} selected="selected"{/if}>{translate label='Data'}</option>
                            <option value="LimitDate" {if !empty($personalisedlist.Ticket.LimitDate)} selected="selected"{/if}>{translate label='Data limita'}</option>

                            <option value="CompanyID" {if !empty($personalisedlist.Ticket.CompanyID)} selected="selected"{/if}>Compania</option>
                            <option value="DivisionID" {if !empty($personalisedlist.Ticket.DivisionID)} selected="selected"{/if}>{translate label='Divizia'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Ticket.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="SubDepartmentID" {if !empty($personalisedlist.Ticket.SubDepartmentID)} selected="selected"{/if}>{translate label='Subdepartament'}</option>
                        </select>
                        <input type="hidden" name="Label[FullName]" value="Nume">
                        <input type="hidden" name="Label[Type]" value="Tip">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[Comments]" value="Comentarii">
                        <input type="hidden" name="Label[CreateDate]" value="Data">
                        <input type="hidden" name="Label[LimitDate]" value="Data limita">
                        <input type="hidden" name="Label[CompanyID]" value="Companie">
                        <input type="hidden" name="Label[DivisionID]" value="Divizia">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[SubDepartmentID]" value="Subdepartament">
                    </div>
                    <input type="submit" name="ticket" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="Performance" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Obiective'}</legend>
                    <div>
                        <select name="Performance[]" id="Performance" multiple="multiple">
                            <option value="DistrictName" {if !empty($personalisedlist.Performance.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Performance.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="varsta" {if !empty($personalisedlist.Performance.varsta)} selected="selected"{/if}>{translate label='Varsta'}</option>
                            <option value="CNP" {if !empty($personalisedlist.Performance.CNP)} selected="selected"{/if}>{translate label='CNP'}</option>
                            <option value="Sex" {if !empty($personalisedlist.Performance.Sex)} selected="selected"{/if}>Sex</option>
                            <option value="Phone" {if !empty($personalisedlist.Performance.Phone)} selected="selected"{/if}>{translate label='Telefon fix'}</option>
                            <option value="Mobile" {if !empty($personalisedlist.Performance.Mobile)} selected="selected"{/if}>{translate label='Telefon mobil'}</option>
                            <option value="Email" {if !empty($personalisedlist.Performance.Email)} selected="selected"{/if}>Email</option>
                            <option value="DivisionID" {if !empty($personalisedlist.Performance.DivisionID)} selected="selected"{/if}>{translate label='Divizia'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Performance.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="CostCenterID" {if !empty($personalisedlist.Performance.CostCenterID)} selected="selected"{/if}>{translate label='Centru de cost'}</option>
                            <option value="JobDictionaryID" {if !empty($personalisedlist.Performance.JobDictionaryID)} selected="selected"{/if}>{translate label='Profesia'}</option>
                            <option value="FunctionID" {if !empty($personalisedlist.Performance.FunctionID)} selected="selected"{/if}>{translate label='Functia'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Performance.UserName)} selected="selected"{/if}>{translate label='User'}</option>
                        </select>
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[varsta]" value="Varsta">
                        <input type="hidden" name="Label[CNP]" value="CNP">
                        <input type="hidden" name="Label[Sex]" value="Sex">
                        <input type="hidden" name="Label[Phone]" value="Telefon fix">
                        <input type="hidden" name="Label[Mobile]" value="Mobile">
                        <input type="hidden" name="Label[Email]" value="Email">
                        <input type="hidden" name="Label[DivisionID]" value="Divizia">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[CostCenterID]" value="Centru de cost">
                        <input type="hidden" name="Label[JobDictionaryID]" value="Profesia">
                        <input type="hidden" name="Label[FunctionID]" value="Functia">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="performance" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Eval" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Evaluari'}</legend>
                    <div>
                        <select name="Eval[]" id="Eval" multiple="multiple">
                            <option value="DistrictName" {if !empty($personalisedlist.Eval.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Eval.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="varsta" {if !empty($personalisedlist.Eval.varsta)} selected="selected"{/if}>{translate label='Varsta'}</option>
                            <option value="CNP" {if !empty($personalisedlist.Eval.CNP)} selected="selected"{/if}>{translate label='CNP'}</option>
                            <option value="Sex" {if !empty($personalisedlist.Eval.Sex)} selected="selected"{/if}>Sex</option>
                            <option value="Phone" {if !empty($personalisedlist.Eval.Phone)} selected="selected"{/if}>{translate label='Telefon fix'}</option>
                            <option value="Mobile" {if !empty($personalisedlist.Eval.Mobile)} selected="selected"{/if}>{translate label='Telefon mobil'}</option>
                            <option value="Email" {if !empty($personalisedlist.Eval.Email)} selected="selected"{/if}>Email</option>
                            <option value="DivisionID" {if !empty($personalisedlist.Eval.DivisionID)} selected="selected"{/if}>{translate label='Divizia'}</option>
                            <option value="DepartmentID" {if !empty($personalisedlist.Eval.DepartmentID)} selected="selected"{/if}>{translate label='Departament'}</option>
                            <option value="CostCenterID" {if !empty($personalisedlist.Eval.CostCenterID)} selected="selected"{/if}>{translate label='Centru de cost'}</option>
                            <option value="JobDictionaryID" {if !empty($personalisedlist.Eval.JobDictionaryID)} selected="selected"{/if}>{translate label='Profesia'}</option>
                            <option value="FunctionID" {if !empty($personalisedlist.Eval.FunctionID)} selected="selected"{/if}>{translate label='Functia'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Eval.UserName)} selected="selected"{/if}>User</option>
                        </select>
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[varsta]" value="Varsta">
                        <input type="hidden" name="Label[CNP]" value="CNP">
                        <input type="hidden" name="Label[Sex]" value="Sex">
                        <input type="hidden" name="Label[Phone]" value="Telefon fix">
                        <input type="hidden" name="Label[Mobile]" value="Mobile">
                        <input type="hidden" name="Label[Email]" value="Email">
                        <input type="hidden" name="Label[DivisionID]" value="Divizia">
                        <input type="hidden" name="Label[DepartmentID]" value="Departament">
                        <input type="hidden" name="Label[CostCenterID]" value="Centru de cost">
                        <input type="hidden" name="Label[JobDictionaryID]" value="Profesia">
                        <input type="hidden" name="Label[FunctionID]" value="Functia">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="eval" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>
            <form action="{$smarty.server.REQUEST_URI}" name="Ticketing" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Tichete'}</legend>
                    <div>
                        <select name="Ticketing[]" id="Ticketing" multiple="multiple">
                            <option value="Type" {if !empty($personalisedlist.Ticketing.Type)} selected="selected"{/if}>{translate label='Tip'}</option>
                            <option value="Status" {if !empty($personalisedlist.Ticketing.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="CategoryID" {if !empty($personalisedlist.Ticketing.CategoryID)} selected="selected"{/if}>{translate label='Categorie'}</option>
                            <option value="Priority" {if !empty($personalisedlist.Ticketing.Priority)} selected="selected"{/if}>{translate label='Prioritate'}</option>
                            <option value="Importance" {if !empty($personalisedlist.Ticketing.Importance)} selected="selected"{/if}>{translate label='Importanta'}</option>
                            <option value="CompanyID" {if !empty($personalisedlist.Ticketing.CompanyID)} selected="selected"{/if}>{translate label='Compania'}</option>
                            <option value="ProjectID" {if !empty($personalisedlist.Ticketing.ProjectID)} selected="selected"{/if}>{translate label='Proiect'}</option>
                            <option value="Title" {if !empty($personalisedlist.Ticketing.Title)} selected="selected"{/if}>{translate label='Titlu'}</option>
                            <option value="Notes" {if !empty($personalisedlist.Ticketing.Notes)} selected="selected"{/if}>{translate label='Descriere'}</option>
                            <option value="Notes2" {if !empty($personalisedlist.Ticketing.Notes2)} selected="selected"{/if}>{translate label='Comentarii'}</option>
                            <option value="AssignedFullName" {if !empty($personalisedlist.Ticketing.AssignedFullName)} selected="selected"{/if}>{translate label='Asignat'}</option>
                            <option value="ResponseTime" {if !empty($personalisedlist.Ticketing.ResponseTime)} selected="selected"{/if}>{translate label='Raspuns (ore)'}</option>
                            <option value="RemedialTime" {if !empty($personalisedlist.Ticketing.RemedialTime)} selected="selected"{/if}>{translate label='Remediere (ore)'}</option>
                            <option value="ComputerName" {if !empty($personalisedlist.Ticketing.ComputerName)} selected="selected"{/if}>{translate label='Nume computer'}</option>
                            <option value="CreateDate" {if !empty($personalisedlist.Ticketing.CreateDate)} selected="selected"{/if}>{translate label='Data'}</option>
                            <option value="AppVersionID" {if !empty($personalisedlist.Ticketing.AppVersionID)} selected="selected"{/if}>{translate label='Versiunea'}</option>
                        </select>
                        <input type="hidden" name="Label[Type]" value="Tip">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[CategoryID]" value="Categorie">
                        <input type="hidden" name="Label[Priority]" value="Prioritate">
                        <input type="hidden" name="Label[Importance]" value="Importanta">
                        <input type="hidden" name="Label[CompanyID]" value="Companie">
                        <input type="hidden" name="Label[ProjectID]" value="Proiect">
                        <input type="hidden" name="Label[Title]" value="Titlu">
                        <input type="hidden" name="Label[Notes]" value="Descriere">
                        <input type="hidden" name="Label[Notes2]" value="Comentarii">
                        <input type="hidden" name="Label[AssignedFullName]" value="Asignat">
                        <input type="hidden" name="Label[ResponseTime]" value="Raspuns (ore)">
                        <input type="hidden" name="Label[RemedialTime]" value="Remediere (ore)">
                        <input type="hidden" name="Label[ComputerName]" value="Nume computer">
                        <input type="hidden" name="Label[CreateDate]" value="Data">
                        <input type="hidden" name="Label[AppVersionID]" value="Versiunea">
                    </div>
                    <input type="submit" name="ticketing" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>

        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>

            <!-- Activitati -->
            <form action="{$smarty.server.REQUEST_URI}" name="Activity" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Vanzari'} - {translate label='Activitati'}</legend>
                    <div>
                        <select name="Activity[]" id="Activity" multiple="multiple">
                            <option value="FullName" {if !empty($personalisedlist.Activity.FullName)} selected="selected"{/if}>{translate label='Responsabil'}</option>
                            <option value="ContactName" {if !empty($personalisedlist.Activity.ContactName)} selected="selected"{/if}>{translate label='Persoana contact'}</option>
                            <option value="Subject" {if !empty($personalisedlist.Activity.Subject)} selected="selected"{/if}>{translate label='Subiect'}</option>
                            <option value="Status" {if !empty($personalisedlist.Activity.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="SourceID" {if !empty($personalisedlist.Activity.SourceID)} selected="selected"{/if}>{translate label='Sursa'}</option>
                            <option value="StageID" {if !empty($personalisedlist.Activity.StageID)} selected="selected"{/if}>{translate label='Stadiu'}</option>
                            <option value="CampaignID" {if !empty($personalisedlist.Activity.CampaignID)} selected="selected"{/if}>{translate label='Campanie'}</option>
                            <option value="Comment" {if !empty($personalisedlist.Activity.Comment)} selected="selected"{/if}>{translate label='Rezolutie'}</option>
                            <option value="Date" {if !empty($personalisedlist.Activity.Date)} selected="selected"{/if}>{translate label='Apelat'}</option>
                            <option value="NextDate" {if !empty($personalisedlist.Activity.NextDate)} selected="selected"{/if}>{translate label='De apelat'}</option>
                            <option value="CreateDate" {if !empty($personalisedlist.Activity.CreateDate)} selected="selected"{/if}>{translate label='Data creare'}</option>
                        </select>
                        <input type="hidden" name="Label[FullName]" value="Responsabil">
                        <input type="hidden" name="Label[ContactName]" value="Persoana contact">
                        <input type="hidden" name="Label[Subject]" value="Subiect">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[SourceID]" value="Sursa">
                        <input type="hidden" name="Label[StageID]" value="Stadiu">
                        <input type="hidden" name="Label[CampaignID]" value="Campanie">
                        <input type="hidden" name="Label[Comment]" value="Rezolutie">
                        <input type="hidden" name="Label[Date]" value="Apelat">
                        <input type="hidden" name="Label[NextDate]" value="De apelat">
                        <input type="hidden" name="Label[CreateDate]" value="Data creare">
                    </div>
                    <input type="submit" name="activity" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>

            <form action="{$smarty.server.REQUEST_URI}" name="Daily" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Vanzari'} - {translate label='Rapoarte'}</legend>
                    <div>
                        <select name="Daily[]" id="Daily" multiple="multiple">
                            <option value="Date" {if !empty($personalisedlist.Daily.Date)} selected="selected"{/if}>{translate label='Data raport'}</option>
                            <option value="CallsNew" {if !empty($personalisedlist.Daily.CallsNew)} selected="selected"{/if}>{translate label='Apeluri noi'}</option>
                            <option value="CallsBack" {if !empty($personalisedlist.Daily.CallsBack)} selected="selected"{/if}>{translate label='Apeluri revenire'}</option>
                            <option value="MeetingsNew" {if !empty($personalisedlist.Daily.MeetingsNew)} selected="selected"{/if}>{translate label='Intalniri noi'}</option>
                            <option value="MeetingsBack" {if !empty($personalisedlist.Daily.MeetingsBack)} selected="selected"{/if}>{translate label='Intalniri revenire'}</option>

                            <option value="MeetingsDone" {if !empty($personalisedlist.Daily.MeetingsDone)} selected="selected"{/if}>{translate label='Intalniri efectuate'}</option>
                            <option value="Reccos" {if !empty($personalisedlist.Daily.Reccos)} selected="selected"{/if}>{translate label='Recomandari'}</option>
                        </select>
                        <input type="hidden" name="Label[CallsNew]" value="Apeluri noi">
                        <input type="hidden" name="Label[CallsBack]" value="Apeluri revenire">
                        <input type="hidden" name="Label[MeetingsNew]" value="Intalniri noi">
                        <input type="hidden" name="Label[MeetingsBack]" value="Intalniri revenire">
                        <input type="hidden" name="Label[MeetingsDone]" value="Intalniri efectuate">
                        <input type="hidden" name="Label[Reccos]" value="Recomandari">
                        <input type="hidden" name="Label[Date]" value="Data raport">
                    </div>
                    <input type="submit" name="daily" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>

            <!-- Ofertare -->
            <form action="{$smarty.server.REQUEST_URI}" name="Ofertare" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Vanzari'} - {translate label='Ofertare'}</legend>
                    <div>
                        <select name="Ofertare[]" id="Ofertare" multiple="multiple">
                            <option value="Name" {if !empty($personalisedlist.Ofertare.Name)} selected="selected"{/if}>{translate label='Proiect'}</option>
                            <option value="Subject" {if !empty($personalisedlist.Ofertare.Subject)} selected="selected"{/if}>{translate label='Subiect'}</option>
                            <option value="Status" {if !empty($personalisedlist.Ofertare.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="ParticipationType" {if !empty($personalisedlist.Ofertare.ParticipationType)} selected="selected"{/if}>{translate label='Participare'}</option>
                            <option value="FinancialSource" {if !empty($personalisedlist.Ofertare.FinancialSource)} selected="selected"{/if}>{translate label='Sursa de finantare'}</option>
                            <option value="Address" {if !empty($personalisedlist.Ofertare.Address)} selected="selected"{/if}>{translate label='Locatia proiectului'}</option>
                            <option value="RequestDate" {if !empty($personalisedlist.Ofertare.RequestDate)} selected="selected"{/if}>{translate label='Data cererii'}</option>
                            <option value="Deadline" {if !empty($personalisedlist.Ofertare.Deadline)} selected="selected"{/if}>{translate label='Termen limita'}</option>
                            <option value="OfferDate" {if !empty($personalisedlist.Ofertare.OfferDate)} selected="selected"{/if}>{translate label='Data ofertei'}</option>
                            <option value="Beneficiary" {if !empty($personalisedlist.Ofertare.Beneficiary)} selected="selected"{/if}>{translate label='Beneficiar final'}</option>
                            <option value="OfferValue" {if !empty($personalisedlist.Ofertare.OfferValue)} selected="selected"{/if}>{translate label='Valoare oferta'}</option>
                        </select>
                        <input type="hidden" name="Label[Name]" value="Proiect">
                        <input type="hidden" name="Label[Subject]" value="Subiect">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[ParticipationType]" value="Participare">
                        <input type="hidden" name="Label[FinancialSource]" value="Sursa de finantare">
                        <input type="hidden" name="Label[Address]" value="Locatia proiectului">
                        <input type="hidden" name="Label[RequestDate]" value="Data cererii">
                        <input type="hidden" name="Label[Deadline]" value="Termen limita">
                        <input type="hidden" name="Label[OfferDate]" value="Data ofertei">
                        <input type="hidden" name="Label[Beneficiary]" value="Beneficiar final">
                        <input type="hidden" name="Label[OfferValue]" value="Valoare oferta">
                    </div>
                    <input type="submit" name="ofertare" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="Candidate" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Candidati'}</legend>
                    <div>
                        <select name="Candidate[]" id="Candidate" multiple="multiple">
                            <option value="FullNameBeforeMariage" {if !empty($personalisedlist.Candidate.FullNameBeforeMariage)} selected="selected"{/if}>{translate label='Nume inainte de casatorie'}</option>
                            <option value="DistrictName" {if !empty($personalisedlist.Candidate.DistrictName)} selected="selected"{/if}>{translate label='Judet'}</option>
                            <option value="CityName" {if !empty($personalisedlist.Candidate.CityName)} selected="selected"{/if}>{translate label='Localitate'}</option>
                            <option value="AddressName" {if !empty($personalisedlist.Candidate.AddressName)} selected="selected"{/if}>{translate label='Adresa'}</option>
                            <option value="Status" {if !empty($personalisedlist.Candidate.Status)} selected="selected"{/if}>{translate label='Status'}</option>
                            <option value="varsta" {if !empty($personalisedlist.Candidate.varsta)} selected="selected"{/if}>{translate label='Varsta'}</option>
                            <option value="CNP" {if !empty($personalisedlist.Candidate.CNP)} selected="selected"{/if}>{translate label='CNP'}</option>
                            <option value="Sex" {if !empty($personalisedlist.Candidate.Sex)} selected="selected"{/if}>Sex</option>
                            <option value="Phone" {if !empty($personalisedlist.Candidate.Phone)} selected="selected"{/if}>{translate label='Telefon fix'}</option>
                            <option value="Mobile" {if !empty($personalisedlist.Candidate.Mobile)} selected="selected"{/if}>{translate label='Mobil'}</option>
                            <option value="Email" {if !empty($personalisedlist.Candidate.Email)} selected="selected"{/if}>Email</option>
                            <option value="MaritalStatus" {if !empty($personalisedlist.Candidate.MaritalStatus)} selected="selected"{/if}>{translate label='Stare civila'}</option>
                            <option value="NumberOfChildren" {if !empty($personalisedlist.Candidate.NumberOfChildren)} selected="selected"{/if}>{translate label='Numar copii'}</option>
                            <option value="DateOfBirth" {if !empty($personalisedlist.Candidate.DateOfBirth)} selected="selected"{/if}>{translate label='Data nasterii'}</option>
                            <option value="CVStatus" {if !empty($personalisedlist.Candidate.CVStatus)} selected="selected"{/if}>{translate label='Status CV'}</option>
                            <option value="RoleID" {if !empty($personalisedlist.Candidate.RoleID)} selected="selected"{/if}>{translate label='Rol'}</option>
                            <option value="UserName" {if !empty($personalisedlist.Candidate.UserName)} selected="selected"{/if}>User</option>
                        </select>
                        <input type="hidden" name="Label[FullNameBeforeMariage]" value="Nume inainte de casatorie">
                        <input type="hidden" name="Label[DistrictName]" value="Judet">
                        <input type="hidden" name="Label[CityName]" value="Localitate">
                        <input type="hidden" name="Label[AddressName]" value="Adresa">
                        <input type="hidden" name="Label[Status]" value="Status">
                        <input type="hidden" name="Label[varsta]" value="Varsta">
                        <input type="hidden" name="Label[CNP]" value="CNP">
                        <input type="hidden" name="Label[Sex]" value="Sex">
                        <input type="hidden" name="Label[Phone]" value="Telefon fix">
                        <input type="hidden" name="Label[Mobile]" value="Mobil">
                        <input type="hidden" name="Label[Email]" value="Email">
                        <input type="hidden" name="Label[MaritalStatus]" value="Stare civila">
                        <input type="hidden" name="Label[NumberOfChildren]" value="Numar copii">
                        <input type="hidden" name="Label[DateOfBirth]" value="Data nasterii">
                        <input type="hidden" name="Label[CVStatus]" value="Status CV">
                        <input type="hidden" name="Label[RoleID]" value="Rol">
                        <input type="hidden" name="Label[UserName]" value="User">
                    </div>
                    <input type="submit" name="candidate" value="{translate label='Salveaza'}" class="cod">
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="CarSheet" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Masini - Foi parcurs'}</legend>
                    <div>
                        <select name="CarSheet[]" id="CarSheet" multiple="multiple">
                            <option value="SheetNo" {if !empty($personalisedlist.CarSheet.SheetNo)} selected="selected"{/if}>{translate label='Numar document'}</option>
                            <option value="Fuel" {if !empty($personalisedlist.CarSheet.Fuel)} selected="selected"{/if}>{translate label='Combustibil'}</option>
                            <option value="DriverID" {if !empty($personalisedlist.CarSheet.DriverID)} selected="selected"{/if}>{translate label='Sofer'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.CarSheet.StartDate)} selected="selected"{/if}>{translate label='Data plecare'}</option>
                            <option value="StartHour" {if !empty($personalisedlist.CarSheet.StartHour)} selected="selected"{/if}>{translate label='Ora plecare'}</option>
                            <option value="StartDateKm" {if !empty($personalisedlist.CarSheet.StartDateKm)} selected="selected"{/if}>{translate label='Km plecare'}</option>
                            <option value="StopDate" {if !empty($personalisedlist.CarSheet.StopDate)} selected="selected"{/if}>{translate label='Data sosire'}</option>
                            <option value="StopHour" {if !empty($personalisedlist.CarSheet.StopHour)} selected="selected"{/if}>{translate label='Ora sosire'}</option>
                            <option value="StopDateKm" {if !empty($personalisedlist.CarSheet.StopDateKm)} selected="selected"{/if}>{translate label='Km sosire'}</option>
                            <option value="KmNo" {if !empty($personalisedlist.CarSheet.KmNo)} selected="selected"{/if}>{translate label='Km parcursi'}</option>
                            <option value="PersonNo" {if !empty($personalisedlist.CarSheet.PersonNo)} selected="selected"{/if}>{translate label='Numar persoane'}</option>
                            <option value="Scope" {if !empty($personalisedlist.CarSheet.Scope)} selected="selected"{/if}>{translate label='Scop deplasare'}</option>
                        </select>
                        <input type="hidden" name="Label[SheetNo]" value="Numar document">
                        <input type="hidden" name="Label[Fuel]" value="Combustibil">
                        <input type="hidden" name="Label[DriverID]" value="Sofer">
                        <input type="hidden" name="Label[StartDate]" value="Data plecare">
                        <input type="hidden" name="Label[StartHour]" value="Ora plecare">
                        <input type="hidden" name="Label[StartDateKm]" value="Km plecare">
                        <input type="hidden" name="Label[StopDate]" value="Data sosire">
                        <input type="hidden" name="Label[StopHour]" value="Ora sosire">
                        <input type="hidden" name="Label[StopDateKm]" value="Km sosire">
                        <input type="hidden" name="Label[KmNo]" value="Km parcursi">
                        <input type="hidden" name="Label[PersonNo]" value="PersonNo">
                        <input type="hidden" name="Label[Scope]" value="Scop deplasare">
                    </div>
                    <input type="submit" name="carsheet" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="CarCost" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Masini - Cheltuieli auto'}</legend>
                    <div>
                        <select name="CarCost[]" id="CarCost" multiple="multiple">
                            <option value="ReceiptNo" {if !empty($personalisedlist.CarCost.ReceiptNo)} selected="selected"{/if}>{translate label='Numar document'}</option>
                            <option value="Date" {if !empty($personalisedlist.CarCost.Date)} selected="selected"{/if}>{translate label='Data document'}</option>
                            <option value="StartDate" {if !empty($personalisedlist.CarCost.StartDate)} selected="selected"{/if}>{translate label='Data inceput'}</option>
                            <option value="StopDate" {if !empty($personalisedlist.CarCost.StopDate)} selected="selected"{/if}>{translate label='Data expirare'}</option>
                            <option value="Km" {if !empty($personalisedlist.CarCost.Km)} selected="selected"{/if}>{translate label='Km'}</option>
                            <option value="CostGroupID" {if !empty($personalisedlist.CarCost.CostGroupID)} selected="selected"{/if}>{translate label='Grupa cheltuiala'}</option>
                            <option value="CostType" {if !empty($personalisedlist.CarCost.CostType)} selected="selected"{/if}>{translate label='Tip cheltuiala'}</option>
                            <option value="CompanyName" {if !empty($personalisedlist.CarCost.CompanyName)} selected="selected"{/if}>{translate label='Furnizor'}</option>
                            <option value="Cost" {if !empty($personalisedlist.CarCost.Cost)} selected="selected"{/if}>{translate label='Valoare'}</option>
                            <option value="Coin" {if !empty($personalisedlist.CarCost.Coin)} selected="selected"{/if}>{translate label='Moneda'}</option>
                            <option value="Budget" {if !empty($personalisedlist.CarCost.Budget)} selected="selected"{/if}>{translate label='Buget'}</option>
                            <option value="Checkup" {if !empty($personalisedlist.CarCost.Checkup)} selected="selected"{/if}>{translate label='Revizie'}</option>
                            <option value="FullName" {if !empty($personalisedlist.CarCost.FullName)} selected="selected"{/if}>{translate label='Angajat'}</option>
                        </select>
                        <input type="hidden" name="Label[ReceiptNo]" value="Numar document">
                        <input type="hidden" name="Label[Date]" value="Data document">
                        <input type="hidden" name="Label[StartDate]" value="Data inceput">
                        <input type="hidden" name="Label[StopDate]" value="Data expirare">
                        <input type="hidden" name="Label[Km]" value="Km">
                        <input type="hidden" name="Label[CostGroupID]" value="Grupa cheltuiala">
                        <input type="hidden" name="Label[CostType]" value="Tip cheltuiala">
                        <input type="hidden" name="Label[CompanyName]" value="Furnizor">
                        <input type="hidden" name="Label[Cost]" value="Valoare">
                        <input type="hidden" name="Label[Coin]" value="Moneda">
                        <input type="hidden" name="Label[Budget]" value="Buget">
                        <input type="hidden" name="Label[Checkup]" value="Revizie">
                        <input type="hidden" name="Label[FullName]" value="Angajat">
                    </div>
                    <input type="submit" name="carcost" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="{$smarty.server.REQUEST_URI}" name="Product" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend>{translate label='Produse'}</legend>
                    <div>
                        <select name="Product[]" id="Product" multiple="multiple">
                            <option value="CompanyID" {if !empty($personalisedlist.Product.CompanyID)} selected="selected"{/if}>{translate label='Producator'}</option>
                            <option value="CategoryID" {if !empty($personalisedlist.Product.CategoryID)} selected="selected"{/if}>{translate label='Categorie'}</option>
                            <option value="Promo" {if !empty($personalisedlist.Product.Promo)} selected="selected"{/if}>{translate label='Promotie'}</option>
                            <option value="SecondHand" {if !empty($personalisedlist.Product.SecondHand)} selected="selected"{/if}>{translate label='Second Hand'}</option>
                            <option value="StocOff" {if !empty($personalisedlist.Product.StocOff)} selected="selected"{/if}>{translate label='Lichidare de stoc'}</option>
                            <option value="Description" {if !empty($personalisedlist.Product.Description)} selected="selected"{/if}>{translate label='Descriere'}</option>
                            <option value="CustomProduct1" {if !empty($personalisedlist.Product.CustomProduct1)} selected="selected"{/if}>{translate label='CustomProduct1'}</option>
                            <option value="CustomProduct2" {if !empty($personalisedlist.Product.CustomProduct2)} selected="selected"{/if}>{translate label='CustomProduct2'}</option>
                            <option value="CustomProduct3" {if !empty($personalisedlist.Product.CustomProduct3)} selected="selected"{/if}>{translate label='CustomProduct2'}</option>
                        </select>
                        <input type="hidden" name="Label[CompanyID]" value="Producator">
                        <input type="hidden" name="Label[CategoryID]" value="Categorie">
                        <input type="hidden" name="Label[Promo]" value="Promotie">
                        <input type="hidden" name="Label[SecondHand]" value="Second Hand">
                        <input type="hidden" name="Label[StocOff]" value="Lichidare de stoc">
                        <input type="hidden" name="Label[Description]" value="Descriere">
                        <input type="hidden" name="Label[CustomProduct1]" value="CustomProduct1">
                        <input type="hidden" name="Label[CustomProduct2]" value="CustomProduct2">
                        <input type="hidden" name="Label[CustomProduct3]" value="CustomProduct3">
                    </div>
                    <input type="submit" name="product" value="{translate label='Salveaza'}" class="cod"/>
                </fieldset>
            </form>
        </td>
    </tr>
    {if $smarty.get.type!='popup'}
        <tr>
            <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown">{translate label='Lista personalizata'}</span></td>
        </tr>
    {else}
        {*<tr><td colspan="7" valign="top" align="center" class=""><input type="button" onclick="window.opener.document.location.reload();" value="{translate label='Actualizeaza'}" /></td>*}
    {/if}
</table>


<script language="JavaScript" type="text/javascript">
    $('#Personal').coolMultiple();
    $('#Company').coolMultiple();
    $('#Job').coolMultiple();
    $('#Event').coolMultiple();
    $('#Performance').coolMultiple();
    $('#Eval').coolMultiple();
    $('#Training').coolMultiple();
    $('#Pontaj').coolMultiple();
    $('#Contract').coolMultiple();
    $('#Activity').coolMultiple();
    $('#Daily').coolMultiple();
    $('#Ofertare').coolMultiple();
    $('#Car').coolMultiple();
    $('#Ticket').coolMultiple();
    $('#Ticketing').coolMultiple();
    $('#Candidate').coolMultiple();
    $('#CarSheet').coolMultiple();
    $('#CarCost').coolMultiple();
    $('#Product').coolMultiple();

</script>

{if !empty($smarty.get.list)}
    <script type="text/javascript">

        $().ready(function () {ldelim}
            $('form').hide();
            $(':form [name="{$smarty.get.list}"]').show();
            {rdelim});

        function refresh_opener() {ldelim}
            window.opener.document.location.reload();
            {rdelim}
    </script>
{/if}