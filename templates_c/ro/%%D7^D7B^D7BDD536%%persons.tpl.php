<?php /* Smarty version 2.6.18, created on 2020-09-02 09:33:38
         compiled from persons.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons.tpl', 8, false),array('function', 'orderby', 'persons.tpl', 505, false),array('function', 'math', 'persons.tpl', 532, false),array('modifier', 'date_format', 'persons.tpl', 89, false),array('modifier', 'default', 'persons.tpl', 89, false),array('modifier', 'cat', 'persons.tpl', 145, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_RIGHTS2']['1']['6'] )): ?>

    <?php if ($_SESSION['THEME'] != "style6.css"): ?>
        <div class="filter personalFilter">
            <table cellspacing="0" cellpadding="0" width="100%">
                <tr>
                    <td class="label"><label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
</label></td>
                    <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_COMPANYSELF'] )): ?>
                        <td class="secondCol">
                            <select id="CompanyID" name="CompanyID" class="dropdown">
                                <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie self'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endif; ?>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    <?php else: ?>
                        <td class="secondCol"><input type="hidden" id="CompanyID" value="0"></td>
                    <?php endif; ?>
                    <td class="trirdCol">
                        <select id="Lang" name="Lang">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Limbi straine'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Lang']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <label><?php echo smarty_function_translate(array('label' => 'Afiseaza doar angajatii'), $this);?>
:</label> <input type="checkbox"
                                                                                           onclick="if (this.checked) window.location.href = './?m=persons&Status=2'; else window.location.href = './?m=persons';"
                                                                                           <?php if (! empty ( $_GET['Status'] ) && $_GET['Status'] == '2'): ?>checked<?php endif; ?>>&nbsp;&nbsp;&nbsp;
                    </td>
                    <td rowspan="6" class="outputZone">
                        <div>
                            <ul>
                                <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                                <li><input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .xls"
                                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'"></li>
                                <li><input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .doc"
                                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'"></li>
                                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'"></li>
                                <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                                           onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'"></li>
                                <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                                           onclick="popUp('./?m=settings&o=personalisedlist&list=Personal&type=popup','',250,400)"></li>
                            </ul>
                        </div>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="DistrictID" name="DistrictID"
                                onchange="if (this.value>0) window.location.href = './?m=persons&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
                                class="cod" style="width:150px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
                        <td class="secondCol">
                            <select id="DivisionID" name="DivisionID"
                                    onchange="window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value"
                                    class="dropdown">
                                <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    <?php else: ?>
                        <td class="secondCol"><input type="hidden" name="DivisionID" id="DivisionID" value="0"></td>
                    <?php endif; ?>
                    <td class="trirdCol">
                        <select id="JobDictionaryID" name="JobDictionaryID" style="width:200px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['jobtitles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['JobDictionaryID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <label><?php echo smarty_function_translate(array('label' => 'Data angajarii'), $this);?>
:</label> <input type="text" id="StartDate" name="StartDate" class="formstyle"
                                                                                  value="<?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")))) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                                                  size="10" maxlength="10">
                        <?php echo '
                            <SCRIPT LANGUAGE="JavaScript">
                                var cal1 = new CalendarPopup();
                                cal1.isShowNavigationDropdowns = true;
                                cal1.setYearSelectStartOffset(10);
                            </SCRIPT>
                        '; ?>

                        <A HREF="#"
                           onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;"
                           NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"/></A>

                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="CityID" name="CityID" class="cod" style="width:200px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="secondCol">
                        <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="ContractType" name="ContractType" style="width:150px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['contract_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ContractType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <select id="res_per_page" nume="res_per_page" class="cod">
                            <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['item']; ?>
"
                                        <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select> <label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Status" name="Status" class="cod" style="width:200px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                <?php $_from = $this->_tpl_vars['substatus'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['key2']; ?>
" <?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key2']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key2'])) == $_GET['Status']): ?>selected<?php endif; ?>>
                                        &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="secondCol">
                        <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="Studies" name="Studies">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Pregatire'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['studies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Studies']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <select id="search_for" nume="search_for" class="cod">
                            <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
                            <option value="LastName"
                                    <?php if ($_GET['search_for'] == 'LastName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</option>
                            <option value="FirstName"
                                    <?php if ($_GET['search_for'] == 'FirstName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
</option>
                            <option value="FullNameBeforeMariage"
                                    <?php if ($_GET['search_for'] == 'FullNameBeforeMariage'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
</option>
                            <option value="CNP"
                                    <?php if ($_GET['search_for'] == 'CNP'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                            <option value="CVQualifRel"
                                    <?php if ($_GET['search_for'] == 'CVQualifRel'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Calificari relevante'), $this);?>
</option>
                            <option value="Function"
                                    <?php if ($_GET['search_for'] == 'Function'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</option>
                            <option value="IFunction"
                                    <?php if ($_GET['search_for'] == 'IFunction'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functie interna'), $this);?>
</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Sex" name="Sex" class="cod">
                            <option value=""><?php echo smarty_function_translate(array('label' => 'Sex'), $this);?>
</option>
                            <option value="M" <?php if ($_GET['Sex'] == 'M'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Masculin'), $this);?>
</option>
                            <option value="F" <?php if ($_GET['Sex'] == 'F'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Feminin'), $this);?>
</option>
                        </select></td>
                    <td class="secondCol">
                        <select id="CostCenterID" name="CostCenterID" class="dropdown">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CostCenterID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="COR" name="COR" class="cod">
                            <option value=""><?php echo smarty_function_translate(array('label' => 'COR'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <option
                                        value="<?php echo $this->_tpl_vars['item']['COR']; ?>
" <?php if (! empty ( $_GET['COR'] ) && $_GET['COR'] == $this->_tpl_vars['item']['COR']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['item']['COR']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <input type="text" id="keyword" name="keyword"
                               value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="38"
                               maxlength="30"
                               class="cod"
                               style="margin:0; width:215px;"
                               onkeypress="if(getKeyUnicode(event)==13) filterList();"/>
                    </td>
                </tr>
                <tr>
                    <td class="firstCol">
                        <select id="Tara" name="Tara">
                            <option value=""><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['tari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['Tara']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>

                    </td>
                    <td class="secondCol">
                        <select id="HealthCompanyID" name="HealthCompanyID">
                            <option value=""><?php echo smarty_function_translate(array('label' => 'Casa de sanatate'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['health_companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['HealthCompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td class="trirdCol">
                        <select id="CustomPerson1" name="CustomPerson1">
                            <option value=""><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson1']), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['customperson1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['CustomPerson1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                    </td>
                    <td>
                        <script type="text/javascript">
                            function filterList() {
                                window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value +
                                    '&CityID=' + document.getElementById('CityID').value +
                                    '&Status=' + document.getElementById('Status').value +
                                    '&DivisionID=' + document.getElementById('DivisionID').value +
                                    '&CompanyID=' + document.getElementById('CompanyID').value +
                                    '&DepartmentID=' + document.getElementById('DepartmentID').value +
                                    '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
                                    '&CostCenterID=' + document.getElementById('CostCenterID').value +
                                    '&Sex=' + document.getElementById('Sex').value +
                                    '&Lang=' + document.getElementById('Lang').value +
                                    '&JobDictionaryID=' + document.getElementById('JobDictionaryID').value +
                                    '&ContractType=' + document.getElementById('ContractType').value +
                                    '&Studies=' + document.getElementById('Studies').value +
                                    '&Tara=' + document.getElementById('Tara').value +
                                    '&StartDate=' + document.getElementById('StartDate').value +
                                    '&search_for=' + document.getElementById('search_for').value +
                                    '&keyword=' + escape(document.getElementById('keyword').value) +
                                    '&COR=' + escape(document.getElementById('COR').value) +
                                    '&HealthCompanyID=' + document.getElementById('HealthCompanyID').value +
                                    '&CustomPerson1=' + escape(document.getElementById('CustomPerson1').value) +
                                    '&res_per_page=' + document.getElementById('res_per_page').value;
                                }
                        </script>
                        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
" class="cod" onclick="filterList()">
                    </td>
                    <td>&nbsp;</td>
                </tr>
            </table>
        </div>
    <?php else: ?>
        <!-- --------------------------------------------------------------------->
        <div class="filter personalFilter">
            <label><?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
</label>
            <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_COMPANYSELF'] )): ?>
                <select id="CompanyID" name="CompanyID" class="dropdown">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie self'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php else: ?>
                <input type="hidden" id="CompanyID" value="0">
            <?php endif; ?>
            <select id="Lang" name="Lang">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Limbi straine'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Lang']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>


            <select id="DistrictID" name="DistrictID"
                    onchange="if (this.value>0) window.location.href = './?m=persons&DivisionID=' + document.getElementById('DivisionID').value + '&DistrictID=' + this.value"
                    class="cod" style="width:150px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
                <select id="DivisionID" name="DivisionID"
                        onchange="window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value + '&DivisionID=' + this.value"
                        class="dropdown">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php else: ?>
                <input type="hidden" name="DivisionID" id="DivisionID" value="0">
            <?php endif; ?>
            <select id="JobDictionaryID" name="JobDictionaryID" style="width:200px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Profesia'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['jobtitles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['JobDictionaryID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <label><?php echo smarty_function_translate(array('label' => 'Data angajarii'), $this);?>
:</label> <input type="text" id="StartDate" name="StartDate" class="formstyle"
                                                                      value="<?php echo ((is_array($_tmp=((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")))) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                                      size="10" maxlength="10">
            <?php echo '
                <SCRIPT LANGUAGE="JavaScript">
                    var cal1 = new CalendarPopup();
                    cal1.isShowNavigationDropdowns = true;
                    cal1.setYearSelectStartOffset(10);
                </SCRIPT>
            '; ?>

            <A HREF="#"
               onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;"
               NAME="anchor1" ID="anchor1"><img src="./images/cal.png" border="0"/></A>

            <select id="CityID" name="CityID" class="cod" style="width:200px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="ContractType" name="ContractType" style="width:150px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['contract_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ContractType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="Status" name="Status" class="cod" style="width:200px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php $_from = $this->_tpl_vars['substatus'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['key2']; ?>
" <?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key2']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key2'])) == $_GET['Status']): ?>selected<?php endif; ?>>
                            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="Studies" name="Studies">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Pregatire'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['studies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Studies']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>

            <select id="Sex" name="Sex" class="cod">
                <option value=""><?php echo smarty_function_translate(array('label' => 'Sex'), $this);?>
</option>
                <option value="M" <?php if ($_GET['Sex'] == 'M'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Masculin'), $this);?>
</option>
                <option value="F" <?php if ($_GET['Sex'] == 'F'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Feminin'), $this);?>
</option>
            </select>
            <select id="CostCenterID" name="CostCenterID" class="dropdown">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Centru de cost'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CostCenterID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="COR" name="COR" class="cod">
                <option value=""><?php echo smarty_function_translate(array('label' => 'COR'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <option
                            value="<?php echo $this->_tpl_vars['item']['COR']; ?>
" <?php if (! empty ( $_GET['COR'] ) && $_GET['COR'] == $this->_tpl_vars['item']['COR']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['item']['COR']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="Tara" name="Tara">
                <option value=""><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['tari']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['Tara']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="HealthCompanyID" name="HealthCompanyID">
                <option value=""><?php echo smarty_function_translate(array('label' => 'Casa de sanatate'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['health_companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['HealthCompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
            <select id="CustomPerson1" name="CustomPerson1">
                <option value=""><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['customfields']['CustomPerson1']), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['customperson1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $_GET['CustomPerson1']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>

            <select id="search_for" nume="search_for" class="cod">
                <option value=""><?php echo smarty_function_translate(array('label' => 'cuvant cheie in'), $this);?>
</option>
                <option value="LastName"
                        <?php if ($_GET['search_for'] == 'LastName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</option>
                <option value="FirstName"
                        <?php if ($_GET['search_for'] == 'FirstName'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
</option>
                <option value="FullNameBeforeMariage"
                        <?php if ($_GET['search_for'] == 'FullNameBeforeMariage'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nume inainte de casatorie'), $this);?>
</option>
                <option value="CNP"
                        <?php if ($_GET['search_for'] == 'CNP'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</option>
                <option value="CVQualifRel"
                        <?php if ($_GET['search_for'] == 'CVQualifRel'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Calificari relevante'), $this);?>
</option>
                <option value="Function"
                        <?php if ($_GET['search_for'] == 'Function'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</option>
                <option value="IFunction"
                        <?php if ($_GET['search_for'] == 'IFunction'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Functie interna'), $this);?>
</option>
            </select>

            <input type="text" id="keyword" name="keyword"
                   value="<?php echo ((is_array($_tmp=@$_GET['keyword'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="38"
                   maxlength="30"
                   class="cod"
                   style="margin:0; width:215px;"
                   onkeypress="if(getKeyUnicode(event)==13) filterList();"/>

            <script type="text/javascript">
                function filterList() {
                    window.location.href = './?m=persons&DistrictID=' + document.getElementById('DistrictID').value +
                        '&CityID=' + document.getElementById('CityID').value +
                        '&Status=' + document.getElementById('Status').value +
                        '&DivisionID=' + document.getElementById('DivisionID').value +
                        '&CompanyID=' + document.getElementById('CompanyID').value +
                        '&DepartmentID=' + document.getElementById('DepartmentID').value +
                        '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value +
                        '&CostCenterID=' + document.getElementById('CostCenterID').value +
                        '&Sex=' + document.getElementById('Sex').value +
                        '&Lang=' + document.getElementById('Lang').value +
                        '&JobDictionaryID=' + document.getElementById('JobDictionaryID').value +
                        '&ContractType=' + document.getElementById('ContractType').value +
                        '&Studies=' + document.getElementById('Studies').value +
                        '&Tara=' + document.getElementById('Tara').value +
                        '&StartDate=' + document.getElementById('StartDate').value +
                        '&search_for=' + document.getElementById('search_for').value +
                        '&keyword=' + escape(document.getElementById('keyword').value) +
                        '&COR=' + escape(document.getElementById('COR').value) +
                        '&HealthCompanyID=' + document.getElementById('HealthCompanyID').value +
                        '&CustomPerson1=' + escape(document.getElementById('CustomPerson1').value) +
                        '&res_per_page=' + document.getElementById('res_per_page').value;
                    }
            </script>
            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Cauta'), $this);?>
" class="cod" onclick="filterList()">

            <label><?php echo smarty_function_translate(array('label' => 'Afiseaza doar angajatii'), $this);?>
:</label> <input type="checkbox"
                                                                               onclick="if (this.checked) window.location.href = './?m=persons&Status=2'; else window.location.href = './?m=persons';"
                                                                               <?php if (! empty ( $_GET['Status'] ) && $_GET['Status'] == '2'): ?>checked<?php endif; ?>>
            <select id="res_per_page" nume="res_per_page" class="cod">
                <?php $_from = $this->_tpl_vars['res_per_pages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['item']; ?>
"
                            <?php if (( empty ( $_GET['res_per_page'] ) && $this->_tpl_vars['res_per_page'] == $this->_tpl_vars['item'] ) || $_GET['res_per_page'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select> <label><?php echo smarty_function_translate(array('label' => 'inregistrari'), $this);?>
</label>

            <div class="outputZone outputZoneOne">
                <ul>
                    <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                    <li><input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .xls"
                               onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'"></li>
                    <li><input type="button" class="cod exportFile" value="<?php echo smarty_function_translate(array('label' => 'Export'), $this);?>
 .doc"
                               onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'"></li>
                    <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza pagina'), $this);?>
"
                               onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_page'"></li>
                    <li><input type="button" class="cod printFile" value="<?php echo smarty_function_translate(array('label' => 'Printeaza tot'), $this);?>
"
                               onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_all'"></li>
                    <li><input type="button" class="cod options" value="<?php echo smarty_function_translate(array('label' => 'Personalizare'), $this);?>
"
                               onclick="popUp('./?m=settings&o=personalisedlist&list=Personal&type=popup','',250,400)"></li>
                </ul>
            </div>

        </div>
        <!-- --------------------------------------------------------------------->
    <?php endif; ?>
<?php endif; ?>
<table cellspacing="0" cellpadding="2" width="100%" class="grid" style="margin-top:6px;">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Nume','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'LastName','asc_or_desc' => 'asc'), $this);?>
</td>
        <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Prenume','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'FirstName'), $this);?>
</td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Personal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu">
                    <?php if ($this->_tpl_vars['field'] == 'AddressName'): ?>
                        <span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
</span>
                    <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                        <?php echo smarty_function_orderby(array('label' => 'Centru de cost','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CostCenters'), $this);?>

                    <?php else: ?>
                        <?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']), $this);?>

                    <?php endif; ?></td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Judet','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'DistrictName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Oras','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CityName'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Varsta','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'varsta'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'CNP','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'CNP'), $this);?>
</td>
            <td class="bkdTitleMenu"><?php echo smarty_function_orderby(array('label' => 'Status','request_uri' => $this->_tpl_vars['request_uri'],'order_by' => 'Status'), $this);?>
</td>
        <?php endif; ?>
        <?php if ($_SESSION['USER_ID'] == 1): ?>
            <td class="bkdTitleMenu" align="center"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</span></td><?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td
                        class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['persons']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><a href="./?m=persons&o=edit&PersonID=<?php echo $this->_tpl_vars['key']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['LastName']; ?>
</a>
                </td>
                <td class="celulaMenuST"><a href="./?m=persons&o=edit&PersonID=<?php echo $this->_tpl_vars['key']; ?>
"
                                            class="blue"><?php echo $this->_tpl_vars['item']['FirstName']; ?>
</a></td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Personal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']) && $_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'MaritalStatus'): ?>
                                <?php echo $this->_tpl_vars['maritalstatus'][$this->_tpl_vars['item']['MaritalStatus']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CVStatus'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['cvstatus'][$this->_tpl_vars['item']['CVStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CompanyID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['self'][$this->_tpl_vars['item']['CompanyID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DivisionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['divisions'][$this->_tpl_vars['item']['DivisionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'SubDepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['subdepartments'][$this->_tpl_vars['item']['SubDepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CostCenters'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'Studies'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['studies'][$this->_tpl_vars['item']['Studies']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'JobDictionaryID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtitles'][$this->_tpl_vars['item']['JobDictionaryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'ContractType'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['contract_type'][$this->_tpl_vars['item']['ContractType']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FunctionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
 - <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'InternalFunction'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['internal_functions'][$this->_tpl_vars['item']['InternalFunction']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'RoleID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['roles'][$this->_tpl_vars['item']['RoleID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FirmAge'): ?>
                                <?php echo $this->_tpl_vars['item']['prof']['years']; ?>
 / <?php echo $this->_tpl_vars['item']['prof']['months']; ?>
 / <?php echo $this->_tpl_vars['item']['prof']['days']; ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CityName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['varsta'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST<?php if ($_SESSION['USER_ID'] != 1): ?>DR<?php endif; ?>"><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>
</td>
                <?php endif; ?>
                <?php if ($_SESSION['USER_ID'] == 1): ?>
                    <td class="celulaMenuSTDR" style="text-align: center;"><a href="#"
                                                                              onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta persoana?'), $this);?>
')) window.location.href='./?m=persons&o=del&PersonID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"><?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
</a>
                    </td><?php endif; ?>
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['persons'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="100" valign="top" class="bkdTitleMenu"><?php echo $this->_tpl_vars['pagination']; ?>
</td>
    </tr>
</table>