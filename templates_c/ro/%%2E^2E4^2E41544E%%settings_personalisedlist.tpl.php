<?php /* Smarty version 2.6.18, created on 2020-12-01 22:52:36
         compiled from settings_personalisedlist.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'settings_personalisedlist.tpl', 20, false),)), $this); ?>
<?php if ($_GET['type'] != 'popup'): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "settings_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <link href="images/style.css" rel="stylesheet" type="text/css">
<?php endif; ?>

<script type="text/javascript" src="./js/jquery-1.3.2.min.js"></script>
<script type="text/javascript" src="./js/jquery.coolMultiple.js"></script>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <?php if ($_GET['type'] != 'popup'): ?>
        <tr>
        <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "settings_submenu_1.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span> <br></td></tr>
    <?php endif; ?>
    <tr>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Personal" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Personal'), $this);?>
</legend>
                    <div>
                        <select name="Personal[]" id="Personal" multiple="multiple">
                            <option value="FullNameBeforeMariage" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['FullNameBeforeMariage'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
</option>
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="AddressName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['AddressName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="varsta" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['varsta'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</option>
                            <option value="CNP" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CNP'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="CI" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CI'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CI serie - numar'), $this);?>
</option>
                            <option value="Sex" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Sex'] )): ?> selected="selected"<?php endif; ?>>Sex</option>
                            <option value="Phone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Phone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
</option>
                            <option value="Mobile" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Mobile'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Mobil serviciu'), $this);?>
</option>
                            <option value="MobilePersonal" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['MobilePersonal'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Mobil personal'), $this);?>
</option>
                            <option value="Sarbatoare" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Sarbatoare'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Sarbatoare'), $this);?>
</option>
                            <option value="Email" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Email'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="MaritalStatus" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['MaritalStatus'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Stare civila'), $this);?>
</option>
                            <option value="NumberOfChildren" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['NumberOfChildren'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar copii'), $this);?>
</option>
                            <option value="DateOfBirth" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['DateOfBirth'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data nasterii'), $this);?>
</option>
                            <option value="CVStatus" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CVStatus'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status CV'), $this);?>
</option>
                            <option value="CompanyID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CompanyID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
</option>
                            <option value="DivisionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['DivisionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="SubDepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['SubDepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
                            <option value="CostCenterID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['CostCenterID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                            <option value="Studies" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Studies'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Pregatire'), $this);?>
</option>
                            <option value="JobDictionaryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['JobDictionaryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <option value="ContractType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['ContractType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
                            <option value="FunctionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['FunctionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
                            <option value="InternalFunction" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['InternalFunction'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia interna'), $this);?>
</option>
                            <option value="RoleID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['RoleID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Rol'), $this);?>
</option>
                            <option value="FirmAge" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['FirmAge'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Vechime in firma (a / l / z)'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['StartDate'] )): ?> selected="selected"<?php endif; ?>>Data angajarii</option>
                            <option value="ContractExpDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['ContractExpDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data expirare contract'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
                            <option value="EmpCode" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['EmpCode'] )): ?> selected="selected"<?php endif; ?>>Marca</option>
                            <option value="Salary" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal']['Salary'] )): ?> selected="selected"<?php endif; ?>>Salariul brut</option>
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
                    <input type="submit" name="personal" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Company" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Companii'), $this);?>
</legend>
                    <div>
                        <select name="Company[]" id="Company" multiple="multiple">
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="Domain" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['Domain'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Domeniu de activitate'), $this);?>
</option>
                            <option value="CIF" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['CIF'] )): ?> selected="selected"<?php endif; ?>>CIF</option>
                            <option value="RegComert" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['RegComert'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Registrul comertului'), $this);?>
</option>
                            <option value="PhoneNumberA" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['PhoneNumberA'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon 1'), $this);?>
</option>
                            <option value="PhoneNumberB" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['PhoneNumberB'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon 2'), $this);?>
</option>
                            <option value="FaxNumber" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['FaxNumber'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Fax'), $this);?>
</option>
                            <option value="CompanyEmail" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['CompanyEmail'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="EmployeesNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['EmployeesNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Angajati'), $this);?>
</option>
                            <option value="CompanyWebsite" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['CompanyWebsite'] )): ?> selected="selected"<?php endif; ?>>WebSite</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Company']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
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
                    <input type="submit" name="company" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Pontaj" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Pontaj'), $this);?>
 - <?php echo smarty_function_translate(array('label' => 'Proiecte'), $this);?>
</legend>
                    <div>
                        <select name="Pontaj[]" id="Pontaj" multiple="multiple">
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="varsta" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['varsta'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</option>
                            <option value="CNP" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['CNP'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="Sex" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['Sex'] )): ?> selected="selected"<?php endif; ?>>Sex</option>
                            <option value="Phone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['Phone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
</option>
                            <option value="Mobile" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['Mobile'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon mobil'), $this);?>
</option>
                            <option value="Email" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['Email'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="DivisionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['DivisionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="CostCenterID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['CostCenterID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                            <option value="JobDictionaryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['JobDictionaryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <option value="FunctionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj']['FunctionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
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
                    <input type="submit" name="pontaj" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Job" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Joburi'), $this);?>
</legend>
                    <div>
                        <select name="Job[]" id="Job" multiple="multiple">
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="no_persons" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['no_persons'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar candidati'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['StartDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data de inceput'), $this);?>
</option>
                            <option value="StopDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['StopDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data de sfarsit'), $this);?>
</option>
                            <option value="status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="JobDomainID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['JobDomainID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Domeniu'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="RequiredExperience" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['RequiredExperience'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Experienta'), $this);?>
</option>
                            <option value="JobType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['JobType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip Job'), $this);?>
</option>
                            <option value="JobDictionaryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['JobDictionaryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <option value="FunctionIDRecr" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['FunctionIDRecr'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
                            <option value="FunctionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['FunctionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia COR'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Job']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
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
                    <input type="submit" name="job" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Contract" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Contracte'), $this);?>
</legend>
                    <div>
                        <select name="Contract[]" id="Contract" multiple="multiple">
                            <option value="ContractNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['ContractNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar contract'), $this);?>
</option>
                            <option value="FullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['FullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Responsabil financiar'), $this);?>
</option>
                            <option value="FullNameTechnical" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['FullNameTechnical'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Responsabil tehnic'), $this);?>
</option>
                            <option value="ContractType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['ContractType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
                            <option value="PaymentType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['PaymentType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip plata'), $this);?>
</option>
                            <option value="CompanyName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['CompanyName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Partener'), $this);?>
</option>
                            <option value="SignDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['SignDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data semnare'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['StartDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</option>
                            <option value="StopDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['StopDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</option>
                            <option value="ContractValue" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['ContractValue'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Valoare'), $this);?>
</option>
                            <option value="Coin" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['Coin'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</option>
                            <option value="PayDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Contract']['PayDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data plata'), $this);?>
</option>
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
                    <input type="submit" name="contract" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Car" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Masini'), $this);?>
</legend>
                    <div>
                        <select name="Car[]" id="Car" multiple="multiple">
                            <option value="Brand" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Brand'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Marca'), $this);?>
</option>
                            <option value="Model" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Model'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Model'), $this);?>
</option>
                            <option value="RegNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['RegNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Inmatriculare'), $this);?>
</option>
                            <option value="RegDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['RegDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data inmatricularii'), $this);?>
</option>
                            <option value="Fuel" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Fuel'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Combustibil'), $this);?>
</option>
                            <option value="Gear" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Gear'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Cutie viteze'), $this);?>
</option>
                            <option value="Year" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Year'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'An fabricatie'), $this);?>
</option>
                            <option value="Color" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Color'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Culoare'), $this);?>
</option>
                            <option value="Cylinders" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Cylinders'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Cilindree'), $this);?>
</option>
                            <option value="Power" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Power'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Putere'), $this);?>
</option>
                            <option value="Resp" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Resp'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Responsabil'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="Patrimony" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Car']['Patrimony'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Patrimoniu'), $this);?>
</option>
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
                    <input type="submit" name="car" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Event" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Evenimente'), $this);?>
</legend>
                    <div>
                        <select name="Event[]" id="Event" multiple="multiple">
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['UserName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Autor'), $this);?>
</option>
                            <option value="ConsultantID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['ConsultantID'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Rep. companie'), $this);?>
</option>
                            <option value="Details" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['Details'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Detalii'), $this);?>
</option>
                            <option value="EventStatus" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['EventStatus'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="EventRelation" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['EventRelation'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Intre'), $this);?>
</option>
                            <option value="EventType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['EventType'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</option>
                            <option value="EventData" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Event']['EventData'] )): ?> selected="selected"<?php endif; ?> ><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</option>
                        </select>
                        <input type="hidden" name="Label[UserName]" value="Autor">
                        <input type="hidden" name="Label[ConsultantID]" value="Reprezentant companie">
                        <input type="hidden" name="Label[Details]" value="Detalii">
                        <input type="hidden" name="Label[EventStatus]" value="Status">
                        <input type="hidden" name="Label[EventRelation]" value="Intre">
                        <input type="hidden" name="Label[EventType]" value="Tip">
                        <input type="hidden" name="Label[EventData]" value="Data">
                    </div>
                    <input type="submit" name="event" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Training" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Training'), $this);?>
</legend>
                    <div>
                        <select name="Training[]" id="Training" multiple="multiple">
                            <option value="CompanyName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['CompanyName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</option>
                            <option value="FullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['FullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Trainer'), $this);?>
</option>
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Oras'), $this);?>
</option>
                            <option value="Domain" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['Domain'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Domeniu activitate'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['StartDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</option>
                            <option value="StopDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['StopDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data finala'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['UserName'] )): ?> selected="Status"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="Type" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['Type'] )): ?> selected="Type"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Training']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
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
                    <input type="submit" name="training" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Ticket" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Cereri'), $this);?>
</legend>
                    <div>
                        <select name="Ticket[]" id="Ticket" multiple="multiple">

                            <option value="FullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['FullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</option>
                            <option value="Type" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['Type'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="Comments" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['Comments'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</option>
                            <option value="CreateDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['CreateDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</option>
                            <option value="LimitDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['LimitDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data limita'), $this);?>
</option>

                            <option value="CompanyID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['CompanyID'] )): ?> selected="selected"<?php endif; ?>>Compania</option>
                            <option value="DivisionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['DivisionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="SubDepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticket']['SubDepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
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
                    <input type="submit" name="ticket" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Performance" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Obiective'), $this);?>
</legend>
                    <div>
                        <select name="Performance[]" id="Performance" multiple="multiple">
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="varsta" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['varsta'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</option>
                            <option value="CNP" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['CNP'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="Sex" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['Sex'] )): ?> selected="selected"<?php endif; ?>>Sex</option>
                            <option value="Phone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['Phone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
</option>
                            <option value="Mobile" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['Mobile'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon mobil'), $this);?>
</option>
                            <option value="Email" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['Email'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="DivisionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['DivisionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="CostCenterID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['CostCenterID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                            <option value="JobDictionaryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['JobDictionaryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <option value="FunctionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['FunctionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Performance']['UserName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'User'), $this);?>
</option>
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
                    <input type="submit" name="performance" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Eval" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Evaluari'), $this);?>
</legend>
                    <div>
                        <select name="Eval[]" id="Eval" multiple="multiple">
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="varsta" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['varsta'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</option>
                            <option value="CNP" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['CNP'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="Sex" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['Sex'] )): ?> selected="selected"<?php endif; ?>>Sex</option>
                            <option value="Phone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['Phone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
</option>
                            <option value="Mobile" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['Mobile'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon mobil'), $this);?>
</option>
                            <option value="Email" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['Email'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="DivisionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['DivisionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
</option>
                            <option value="DepartmentID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['DepartmentID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <option value="CostCenterID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['CostCenterID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                            <option value="JobDictionaryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['JobDictionaryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <option value="FunctionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['FunctionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Eval']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
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
                    <input type="submit" name="eval" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Ticketing" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Tichete'), $this);?>
</legend>
                    <div>
                        <select name="Ticketing[]" id="Ticketing" multiple="multiple">
                            <option value="Type" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Type'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="CategoryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['CategoryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Categorie'), $this);?>
</option>
                            <option value="Priority" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Priority'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Prioritate'), $this);?>
</option>
                            <option value="Importance" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Importance'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Importanta'), $this);?>
</option>
                            <option value="CompanyID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['CompanyID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
</option>
                            <option value="ProjectID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['ProjectID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
</option>
                            <option value="Title" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Title'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Titlu'), $this);?>
</option>
                            <option value="Notes" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Notes'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</option>
                            <option value="Notes2" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['Notes2'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</option>
                            <option value="AssignedFullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['AssignedFullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Asignat'), $this);?>
</option>
                            <option value="ResponseTime" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['ResponseTime'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Raspuns (ore)'), $this);?>
</option>
                            <option value="RemedialTime" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['RemedialTime'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Remediere (ore)'), $this);?>
</option>
                            <option value="ComputerName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['ComputerName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume computer'), $this);?>
</option>
                            <option value="CreateDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['CreateDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</option>
                            <option value="AppVersionID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ticketing']['AppVersionID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Versiunea'), $this);?>
</option>
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
                    <input type="submit" name="ticketing" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>

        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>

            <!-- Activitati -->
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Activity" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Vanzari'), $this);?>
 - <?php echo smarty_function_translate(array('label' => 'Activitati'), $this);?>
</legend>
                    <div>
                        <select name="Activity[]" id="Activity" multiple="multiple">
                            <option value="FullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['FullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Responsabil'), $this);?>
</option>
                            <option value="ContactName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['ContactName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Persoana contact'), $this);?>
</option>
                            <option value="Subject" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['Subject'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Subiect'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="SourceID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['SourceID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Sursa'), $this);?>
</option>
                            <option value="StageID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['StageID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Stadiu'), $this);?>
</option>
                            <option value="CampaignID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['CampaignID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Campanie'), $this);?>
</option>
                            <option value="Comment" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['Comment'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Rezolutie'), $this);?>
</option>
                            <option value="Date" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['Date'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Apelat'), $this);?>
</option>
                            <option value="NextDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['NextDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'De apelat'), $this);?>
</option>
                            <option value="CreateDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Activity']['CreateDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data creare'), $this);?>
</option>
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
                    <input type="submit" name="activity" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>

            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Daily" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Vanzari'), $this);?>
 - <?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</legend>
                    <div>
                        <select name="Daily[]" id="Daily" multiple="multiple">
                            <option value="Date" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['Date'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data raport'), $this);?>
</option>
                            <option value="CallsNew" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['CallsNew'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Apeluri noi'), $this);?>
</option>
                            <option value="CallsBack" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['CallsBack'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Apeluri revenire'), $this);?>
</option>
                            <option value="MeetingsNew" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['MeetingsNew'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Intalniri noi'), $this);?>
</option>
                            <option value="MeetingsBack" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['MeetingsBack'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Intalniri revenire'), $this);?>
</option>

                            <option value="MeetingsDone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['MeetingsDone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Intalniri efectuate'), $this);?>
</option>
                            <option value="Reccos" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Daily']['Reccos'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Recomandari'), $this);?>
</option>
                        </select>
                        <input type="hidden" name="Label[CallsNew]" value="Apeluri noi">
                        <input type="hidden" name="Label[CallsBack]" value="Apeluri revenire">
                        <input type="hidden" name="Label[MeetingsNew]" value="Intalniri noi">
                        <input type="hidden" name="Label[MeetingsBack]" value="Intalniri revenire">
                        <input type="hidden" name="Label[MeetingsDone]" value="Intalniri efectuate">
                        <input type="hidden" name="Label[Reccos]" value="Recomandari">
                        <input type="hidden" name="Label[Date]" value="Data raport">
                    </div>
                    <input type="submit" name="daily" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>

            <!-- Ofertare -->
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Ofertare" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Vanzari'), $this);?>
 - <?php echo smarty_function_translate(array('label' => 'Ofertare'), $this);?>
</legend>
                    <div>
                        <select name="Ofertare[]" id="Ofertare" multiple="multiple">
                            <option value="Name" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Name'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
</option>
                            <option value="Subject" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Subject'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Subiect'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="ParticipationType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['ParticipationType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Participare'), $this);?>
</option>
                            <option value="FinancialSource" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['FinancialSource'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Sursa de finantare'), $this);?>
</option>
                            <option value="Address" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Address'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Locatia proiectului'), $this);?>
</option>
                            <option value="RequestDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['RequestDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data cererii'), $this);?>
</option>
                            <option value="Deadline" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Deadline'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Termen limita'), $this);?>
</option>
                            <option value="OfferDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['OfferDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data ofertei'), $this);?>
</option>
                            <option value="Beneficiary" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['Beneficiary'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Beneficiar final'), $this);?>
</option>
                            <option value="OfferValue" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Ofertare']['OfferValue'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Valoare oferta'), $this);?>
</option>
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
                    <input type="submit" name="ofertare" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
    </tr>
    <tr>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Candidate" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Candidati'), $this);?>
</legend>
                    <div>
                        <select name="Candidate[]" id="Candidate" multiple="multiple">
                            <option value="FullNameBeforeMariage" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['FullNameBeforeMariage'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
</option>
                            <option value="DistrictName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['DistrictName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <option value="CityName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['CityName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <option value="AddressName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['AddressName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
</option>
                            <option value="Status" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['Status'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <option value="varsta" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['varsta'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</option>
                            <option value="CNP" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['CNP'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="Sex" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['Sex'] )): ?> selected="selected"<?php endif; ?>>Sex</option>
                            <option value="Phone" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['Phone'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
</option>
                            <option value="Mobile" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['Mobile'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Mobil'), $this);?>
</option>
                            <option value="Email" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['Email'] )): ?> selected="selected"<?php endif; ?>>Email</option>
                            <option value="MaritalStatus" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['MaritalStatus'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Stare civila'), $this);?>
</option>
                            <option value="NumberOfChildren" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['NumberOfChildren'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar copii'), $this);?>
</option>
                            <option value="DateOfBirth" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['DateOfBirth'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data nasterii'), $this);?>
</option>
                            <option value="CVStatus" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['CVStatus'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Status CV'), $this);?>
</option>
                            <option value="RoleID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['RoleID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Rol'), $this);?>
</option>
                            <option value="UserName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Candidate']['UserName'] )): ?> selected="selected"<?php endif; ?>>User</option>
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
                    <input type="submit" name="candidate" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod">
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="CarSheet" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Masini - Foi parcurs'), $this);?>
</legend>
                    <div>
                        <select name="CarSheet[]" id="CarSheet" multiple="multiple">
                            <option value="SheetNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['SheetNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar document'), $this);?>
</option>
                            <option value="Fuel" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['Fuel'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Combustibil'), $this);?>
</option>
                            <option value="DriverID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['DriverID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Sofer'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StartDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data plecare'), $this);?>
</option>
                            <option value="StartHour" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StartHour'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Ora plecare'), $this);?>
</option>
                            <option value="StartDateKm" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StartDateKm'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Km plecare'), $this);?>
</option>
                            <option value="StopDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StopDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data sosire'), $this);?>
</option>
                            <option value="StopHour" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StopHour'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Ora sosire'), $this);?>
</option>
                            <option value="StopDateKm" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['StopDateKm'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Km sosire'), $this);?>
</option>
                            <option value="KmNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['KmNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Km parcursi'), $this);?>
</option>
                            <option value="PersonNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['PersonNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar persoane'), $this);?>
</option>
                            <option value="Scope" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarSheet']['Scope'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Scop deplasare'), $this);?>
</option>
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
                    <input type="submit" name="carsheet" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="CarCost" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Masini - Cheltuieli auto'), $this);?>
</legend>
                    <div>
                        <select name="CarCost[]" id="CarCost" multiple="multiple">
                            <option value="ReceiptNo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['ReceiptNo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Numar document'), $this);?>
</option>
                            <option value="Date" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Date'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data document'), $this);?>
</option>
                            <option value="StartDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['StartDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</option>
                            <option value="StopDate" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['StopDate'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Data expirare'), $this);?>
</option>
                            <option value="Km" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Km'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Km'), $this);?>
</option>
                            <option value="CostGroupID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['CostGroupID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Grupa cheltuiala'), $this);?>
</option>
                            <option value="CostType" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['CostType'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Tip cheltuiala'), $this);?>
</option>
                            <option value="CompanyName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['CompanyName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Furnizor'), $this);?>
</option>
                            <option value="Cost" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Cost'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Valoare'), $this);?>
</option>
                            <option value="Coin" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Coin'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</option>
                            <option value="Budget" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Budget'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Buget'), $this);?>
</option>
                            <option value="Checkup" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['Checkup'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Revizie'), $this);?>
</option>
                            <option value="FullName" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['CarCost']['FullName'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Angajat'), $this);?>
</option>
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
                    <input type="submit" name="carcost" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
        <td class="" style="vertical-align: top; padding-left: 6px; padding-bottom: 10px; padding-right: 6px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" name="Product" method="post" onsubmit="setTimeout('refresh_opener()',10); setTimeout('window.close()',5); return true;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Produse'), $this);?>
</legend>
                    <div>
                        <select name="Product[]" id="Product" multiple="multiple">
                            <option value="CompanyID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['CompanyID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Producator'), $this);?>
</option>
                            <option value="CategoryID" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['CategoryID'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Categorie'), $this);?>
</option>
                            <option value="Promo" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['Promo'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Promotie'), $this);?>
</option>
                            <option value="SecondHand" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['SecondHand'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Second Hand'), $this);?>
</option>
                            <option value="StocOff" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['StocOff'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Lichidare de stoc'), $this);?>
</option>
                            <option value="Description" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['Description'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</option>
                            <option value="CustomProduct1" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['CustomProduct1'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CustomProduct1'), $this);?>
</option>
                            <option value="CustomProduct2" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['CustomProduct2'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CustomProduct2'), $this);?>
</option>
                            <option value="CustomProduct3" <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Product']['CustomProduct3'] )): ?> selected="selected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CustomProduct2'), $this);?>
</option>
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
                    <input type="submit" name="product" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="cod"/>
                </fieldset>
            </form>
        </td>
    </tr>
    <?php if ($_GET['type'] != 'popup'): ?>
        <tr>
            <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'Lista personalizata'), $this);?>
</span></td>
        </tr>
    <?php else: ?>
            <?php endif; ?>
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

<?php if (! empty ( $_GET['list'] )): ?>
    <script type="text/javascript">

        $().ready(function () {
            $('form').hide();
            $(':form [name="<?php echo $_GET['list']; ?>
"]').show();
            });

        function refresh_opener() {
            window.opener.document.location.reload();
            }
    </script>
<?php endif; ?>