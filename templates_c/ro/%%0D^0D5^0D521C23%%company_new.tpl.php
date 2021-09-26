<?php /* Smarty version 2.6.18, created on 2020-09-21 08:33:56
         compiled from company_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'company_new.tpl', 21, false),array('modifier', 'default', 'company_new.tpl', 42, false),array('modifier', 'replace', 'company_new.tpl', 185, false),array('modifier', 'date_format', 'company_new.tpl', 207, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php echo '
<script type="text/javascript">
    $(document).ready(function () {
        if ($(\'#Judet\').val() > 0) showInfo(\'ajax.php?o=Oras&Judet=\' + $(\'#Judet\').val() + \'&rand=\' + parseInt(Math.random() * 999999999) + \'&companyID=\' + '; ?>
<?php echo $_GET['CompanyID']; ?>
<?php echo ' , \'div_CityID_\');
    });

</script>'; ?>


<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <?php if (! empty ( $_GET['CompanyID'] )): ?>
            <tr>
                <td valign="top" class="bkdTitleMenu">
                    <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
                </td>
                <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['info']['CompanyName']; ?>
</span></td>
            </tr>
        <?php else: ?>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adaugare companie'), $this);?>
</span></td>
            </tr>
        <?php endif; ?>
        <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele companiei au fost salvate!'), $this);?>
</td>
            </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Date identificare'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nume companie'), $this);?>
:*</b></td>
                            <td><input type="text" name="CompanyName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Tip companie'), $this);?>
:</b></td>
                            <td>
                                <input type="checkbox" name="Self" value="1" <?php if ($this->_tpl_vars['info']['Self'] == 1): ?>checked<?php endif; ?>> self
                                <input type="checkbox" name="isGeneric" value="1" <?php if ($this->_tpl_vars['info']['isGeneric'] == 1): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'generica'), $this);?>

                                <select name="Situation">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Situatie companie'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['situation']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['Situation'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Domeniu de activitate'), $this);?>
:*</b></td>
                            <td>
                                <select name="CompanyDomainID" class="dropdown">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['companydomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['CompanyDomainID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['CompanyDomainID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="Domain" value="">
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'CIF'), $this);?>
:</b></td>
                            <td><input type="text" name="CIF" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Registrul comertului'), $this);?>
:</b></td>
                            <td><input type="text" name="RegComert" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RegComert'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Reprezentant legal'), $this);?>
:</b></td>
                            <td>
                                <select name="LegalPersonID" class="dropdown">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['LegalPersonID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['LegalPersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['FullName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Reprezentant resurse umane'), $this);?>
:</b></td>
                            <td>
                                <select name="HRPersonID" class="dropdown">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['HRPersonID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['HRPersonID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['FullName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'E-mail'), $this);?>
:</b></td>
                            <td><input type="text" name="CompanyEmail" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyEmail'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Website'), $this);?>
:</b></td>
                            <td><input type="text" name="CompanyWebsite" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyWebsite'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
:</b></td>
                            <td>
                                <select id="Judet" name="Judet"
                                        onchange="if (this.value>0) showInfo('ajax.php?o=Oras&Judet=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID_<?php echo $this->_tpl_vars['ID']; ?>
');">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['Judet'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Judet']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Oras'), $this);?>
:</b></td>
                            <td>
                                <div id="div_CityID_<?php echo $this->_tpl_vars['ID']; ?>
">
                                    <select name="Oras">
                                        <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['info']['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['Oras'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Oras']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </td>
                        </tr>

                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon 1'), $this);?>
:</b></td>
                            <td><input type="text" name="PhoneNumberA" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberA'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="50"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon 2'), $this);?>
:</b></td>
                            <td><input type="text" name="PhoneNumberB" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberB'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="50"></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <div align="center">
                    <?php if (! empty ( $_GET['CompanyID'] )): ?>
                    <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?>
                    <?php else: ?>
                    <div align="center"><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Adauga companie'), $this);?>
" class="formstyle">
                        <?php endif; ?>
                        <input type="button" class="formstyle" onclick="window.location.href = './?m=companies';" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
">
                    </div>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="100"><b><?php echo smarty_function_translate(array('label' => 'Angajati'), $this);?>
:</b></td>
                            <td><input type="text" name="EmployeesNo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['EmployeesNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="10"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'IBAN'), $this);?>
:</b></td>
                            <td><input type="text" name="BankAccount" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankAccount'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Banca'), $this);?>
:</b></td>
                            <td><input type="text" name="BankName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sucursala'), $this);?>
:</b></td>
                            <td><input type="text" name="BankLocation" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankLocation'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii banca'), $this);?>
:</b></td>
                            <td><textarea name="BankNotes" rows="2" cols="50"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Alte observatii'), $this);?>
:</b></td>
                            <td><textarea name="Notes" rows="2" cols="50"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Notes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sigla companie'), $this);?>
:</b></td>
                            <td><input type="file" name="photo"></td>
                            <td rowspan="4" align="center"><?php if (isset ( $this->_tpl_vars['info']['photo'] )): ?><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['info']['photo'])) ? $this->_run_mod_handler('replace', true, $_tmp, '_100_100', '') : smarty_modifier_replace($_tmp, '_100_100', '')); ?>
" title="<?php echo smarty_function_translate(array('label' => 'mareste poza'), $this);?>
"
                                                                                     target="_blank"><img style="padding:2px; border:solid 1px #666;" src="<?php echo $this->_tpl_vars['info']['photo']; ?>
"></a>
                                    <br/>
                                <a href="#"
                                   onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta imagine?'), $this);?>
')) window.location.href='./?m=companies&o=del_photo&CompanyID=<?php echo $_GET['CompanyID']; ?>
'; return false;"
                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
" class="blue">sterge</a><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Imagine header tipizate'), $this);?>
:</b></td>
                            <td><input type="file" name="photo_header_report"></td>
                            <td rowspan="4" align="center"><?php if (isset ( $this->_tpl_vars['info']['photo_header_report'] )): ?><a href="<?php echo ((is_array($_tmp=$this->_tpl_vars['info']['photo_header_report'])) ? $this->_run_mod_handler('replace', true, $_tmp, '_100_100', '') : smarty_modifier_replace($_tmp, '_100_100', '')); ?>
"
                                                                                                   title="<?php echo smarty_function_translate(array('label' => 'mareste poza'), $this);?>
" target="_blank"><img
                                            style="padding:2px; border:solid 1px #666;" src="<?php echo $this->_tpl_vars['info']['photo_header_report']; ?>
"></a>
                                    <br/>
                                <a href="#"
                                   onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi aceasta imagine?'), $this);?>
')) window.location.href='./?m=companies&o=del_photo_header_report&CompanyID=<?php echo $_GET['CompanyID']; ?>
'; return false;"
                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
" class="blue">sterge header</a><?php endif; ?></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data inregistrarii'), $this);?>
:</b></td>
                            <td>
                                <input type="text" id="RegisterDate" name="RegisterDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['RegisterDate'] ) && $this->_tpl_vars['info']['RegisterDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['RegisterDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_RegisterDate">
                                    var cal_RegisterDate = new CalendarPopup();
                                    cal_RegisterDate.isShowNavigationDropdowns = true;
                                    cal_RegisterDate.setYearSelectStartOffset(10);
                                    //writeSource("js_RegisterDate");
                                </SCRIPT>
                                <A HREF="#" onClick="cal_RegisterDate.select(document.getElementById('RegisterDate'),'anchor_RegisterDate','dd.MM.yyyy'); return false;"
                                   NAME="anchor_RegisterDate" ID="anchor_RegisterDate"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomCompany1'] )): ?>
                            <tr>
                                <td><b><?php echo $this->_tpl_vars['customfields']['CustomCompany1']; ?>
:</b></td>
                                <td><input type="text" name="CustomCompany1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CustomCompany1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="255"></td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomCompany2'] )): ?>
                            <tr>
                                <td><b><?php echo $this->_tpl_vars['customfields']['CustomCompany2']; ?>
:</b></td>
                                <td><input type="text" name="CustomCompany2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CustomCompany2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="255"></td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                        <?php if (! empty ( $this->_tpl_vars['customfields']['CustomCompany3'] )): ?>
                            <tr>
                                <td><b><?php echo $this->_tpl_vars['customfields']['CustomCompany3']; ?>
:</b></td>
                                <td>
                                    <input type="text" id="CustomCompany3" name="CustomCompany3" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['CustomCompany3'] ) && $this->_tpl_vars['info']['CustomCompany3'] != '0000-00-00 00:00:00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['CustomCompany3'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js_CustomCompany3">
                                        var cal_CustomCompany3 = new CalendarPopup();
                                        cal_CustomCompany3.isShowNavigationDropdowns = true;
                                        cal_CustomCompany3.setYearSelectStartOffset(10);
                                        //writeSource("js_CustomCompany3");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal_CustomCompany3.select(document.getElementById('CustomCompany3'),'anchor_CustomCompany3','dd.MM.yyyy'); return false;"
                                       NAME="anchor_CustomCompany3" ID="anchor_CustomCompany3"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
            </td>
        </tr>
    </table>
</form>
<fieldset>
    <legend><?php echo smarty_function_translate(array('label' => 'Persoane de contact '), $this);?>
</legend>
    <form action="" method="post" enctype="multipart/form-data" onsubmit="return validateForm(this);">
        <table border="0" cellpadding="4" cellspacing="0" class="screen">
            <tr>
                <td width="100"><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
*:</b></td>
                <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</b></td>
                <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
                <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
:</b></td>
                <td>&nbsp;</td>
                <td>&nbsp;</td>
            </tr>
            <?php $_from = $this->_tpl_vars['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
                <tr>
                    <td><input type="text" id="ContactName_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
" name="ContactName[<?php echo $this->_tpl_vars['item']['ContactID']; ?>
]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ContactName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="25"
                               maxlength="64"/></td>
                    <td><input type="text" id="ContactPhone_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
" name="ContactPhone[<?php echo $this->_tpl_vars['item']['ContactID']; ?>
]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ContactPhone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="15"
                               maxlength="16"/></td>
                    <td><input type="text" id="ContactEmail_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
" name="ContactEmail[<?php echo $this->_tpl_vars['item']['ContactID']; ?>
]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ContactEmail'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="25"
                               maxlength="64"/></td>
                    <td><input type="text" id="ContactFunction_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
" name="ContactFunction[<?php echo $this->_tpl_vars['item']['ContactID']; ?>
]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ContactFunction'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="25"
                               maxlength="128"/></td>
                    <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                        <td>
                            <div id="button_mod"><a href="#" onclick="if (document.getElementById('ContactName_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
').value)
                                        window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&o=edit_contact&ContactID=<?php echo $this->_tpl_vars['item']['ContactID']; ?>
' + '&ContactName=' + escape(document.getElementById('ContactName_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
').value) + '&ContactPhone=' + escape(document.getElementById('ContactPhone_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
').value) + '&ContactEmail=' + escape(document.getElementById('ContactEmail_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
').value) + '&ContactFunction=' + escape(document.getElementById('ContactFunction_<?php echo $this->_tpl_vars['item']['ContactID']; ?>
').value);
                                        else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati completat numele'), $this);?>
!');
                                        return false;" title="<?php echo smarty_function_translate(array('label' => 'Modifica persoana'), $this);?>
"><b>Mod</b></a></div>
                        </td>
                        <td>
                            <div id="button_del">
                                <a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&o=del_contact&ContactID=<?php echo $this->_tpl_vars['item']['ContactID']; ?>
" onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge contact'), $this);?>
"><b>Del</b></a>
                            </div>
                        </td>
                    <?php endif; ?>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
            <!--- ADD new contact  -->
            <td width="100"><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
*:</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
:</b></td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            </tr>
            <tr>
                <td><input type="text" id="ContactName" name="ContactName[0]" value="" size="25" maxlength="64"/></td>
                <td><input type="text" id="ContactPhone" name="ContactPhone[0]" value="" size="15" maxlength="16"/></td>
                <td><input type="text" id="ContactEmail" name="ContactEmail[0]" value="" size="25" maxlength="64"/></td>
                <td><input type="text" id="ContactFunction" name="ContactFunction[0]" value="" size="25" maxlength="128"/></td>
                <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                    <td style="padding-left: 10px;" colspan="2">
                        <div id="button_add"><a href="#" onclick="
                                    if (document.getElementById('ContactName').value)
                                    window.location.href = '<?php echo $this->_tpl_vars['request_uri']; ?>
&o=new_contact&ContactName=' + escape(document.getElementById('ContactName').value) + '&ContactPhone=' + escape(document.getElementById('ContactPhone').value) + '&ContactEmail=' + escape(document.getElementById('ContactEmail').value) + '&ContactFunction=' + escape(document.getElementById('ContactFunction').value);
                                    else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati completat numele'), $this);?>
!');
                                    return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a></div>
                    </td>
                <?php endif; ?>
            </tr>
            <!-- END ADD contact -->
        </table>
    </form>
</fieldset>
<table width="100%" border="0" cellpadding="4" cellspacing="0" class="screen">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>
<?php echo '
<script type="text/javascript">
    showInfo(\'ajax.php?o=Oras&Judet=\' + {$info.Judet} + \'&Oras=\' + {$info.Oras} + \'&rand=\' + parseInt(Math.random() * 999999999), \'div_CityID_\');

    {
        literal
    }

    function validateForm(f) {
        return '; ?>
<?php if (! empty ( $this->_tpl_vars['customfields']['CustomCompany3'] )): ?>is_empty(f.CustomCompany3.value) ? true : checkDate(f.CustomCompany3.value, '<?php echo $this->_tpl_vars['customfields']['CustomCompany3']; ?>
')
        <?php else: ?>true<?php endif; ?><?php echo ';
    }
</script>
'; ?>