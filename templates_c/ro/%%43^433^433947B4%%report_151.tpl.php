<?php /* Smarty version 2.6.18, created on 2020-10-05 11:24:42
         compiled from report_151.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'report_151.tpl', 4, false),array('modifier', 'default', 'report_151.tpl', 96, false),array('modifier', 'date_format', 'report_151.tpl', 110, false),)), $this); ?>
<?php if (empty ( $_GET['export'] ) && empty ( $_GET['export_doc'] )): ?>
    <table cellspacing="0" cellpadding="2">
        <tr>
            <td><?php echo smarty_function_translate(array('label' => 'An'), $this);?>
:</td>
            <td>
                <select name="Year" id="Year">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($_GET['Year'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
            <td>
                <select name="Month" id="Month">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['Month'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>

            <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_COMPANYSELF'] )): ?>
                <td style="padding-left: 2px;" width="75">
                    <select id="CompanyID" name="CompanyID" class="dropdown">
                        <option value="0"><?php echo smarty_function_translate(array('label' => 'Toate Companiile'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DivisionID" name="DivisionID" class="dropdown">
                        <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </td>
                <td style="padding-left: 2px;" width="75">
                    <select id="DepartmentID" name="DepartmentID" class="dropdown">
                        <option value="0"><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                </td>
            <?php endif; ?>

            <td>&nbsp;</td>
            <td><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Afiseaza'), $this);?>
"
                       onclick="window.location.href = './?m=reports&rep=151&GroupID=<?php echo $_GET['GroupID']; ?>
&CompanyID=' + document.getElementById('CompanyID').value + '&Year=' + document.getElementById('Year').value + '&Month=' + document.getElementById('Month').value + '&DivisionID=' + document.getElementById('DivisionID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value;">
            </td>
        </tr>
    </table>
    <br>
<?php endif; ?>
<table width="100%" cellspacing="0" cellpadding="2" border="1">
    <!-- Fields -->
    <tr>
        <td><b>#</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Prenume'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Sector'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Cod postal'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Cont personal'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Banca'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Sucursala'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Data angajarii'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Data incetarii activitatii'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Casa de asigurari de sanatate'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Invaliditate'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Grupa CAS'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Durata contractului de munca'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Tipul contractului de munca'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Norma zilnica'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Salariul tarifar brut'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Mod calcul salariu'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Salariu agreat RON'), $this);?>
</b></td>
        <td><b><?php echo smarty_function_translate(array('label' => 'Curs valutar'), $this);?>
</b></td>
    </tr>

    <!-- Values -->
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['person']):
        $this->_foreach['iter']['iteration']++;
?>
        <tr>
            <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['divisions'][$this->_tpl_vars['person']['DivisionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['LastName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['FirstName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['CityName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Sector'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['StreetCode'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['StreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php if (! empty ( $this->_tpl_vars['person']['Bl'] )): ?> <?php echo smarty_function_translate(array('label' => 'Bl.'), $this);?>
<?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Bl'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?><?php if (! empty ( $this->_tpl_vars['person']['Sc'] )): ?> <?php echo smarty_function_translate(array('label' => 'Sc.'), $this);?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Sc'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?><?php if (! empty ( $this->_tpl_vars['person']['Et'] )): ?> <?php echo smarty_function_translate(array('label' => 'Et.'), $this);?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Et'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?><?php if (! empty ( $this->_tpl_vars['person']['Ap'] )): ?> <?php echo smarty_function_translate(array('label' => 'Ap.'), $this);?>
 <?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Ap'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
<?php endif; ?></td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Mobile'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['BankAccount'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['BankName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['BankLocation'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php if (! empty ( $this->_tpl_vars['person']['StartDate'] )): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['person']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
            <td><?php if (! empty ( $this->_tpl_vars['person']['StopDate'] ) && $this->_tpl_vars['person']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['person']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>&nbsp;<?php endif; ?></td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['health_companies'][$this->_tpl_vars['person']['HealthCompanyID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td>&nbsp;</td>
            <td>&nbsp;</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['contract_types'][$this->_tpl_vars['person']['ContractType']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td>Contract Individual de Munca</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['WorkNorm'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['Salary'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td>&nbsp;</td>
            <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['person']['SalaryNet'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <td>&nbsp;</td>
        </tr>
        <?php endforeach; else: ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu exista inregistrari!'), $this);?>
</td>
        </tr>
    <?php endif; unset($_from); ?>

</table>