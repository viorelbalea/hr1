<?php /* Smarty version 2.6.18, created on 2020-10-13 10:58:37
         compiled from persons_summary.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_summary.tpl', 15, false),array('modifier', 'default', 'persons_summary.tpl', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span></td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <h3><?php echo $this->_tpl_vars['info']['FullName']; ?>
</h3>
            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                <tr valign="top">
                    <td style="padding-right: 20px; border-right: 1px solid #cccccc;" width="30%">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Data nasterii'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DateOfBirth'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['districts'][$this->_tpl_vars['info']['DistrictID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['info']['CityName']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Telefon fix'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Mobil'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Mobile'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Fax'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Fax'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Yahoo'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Yahoo'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Skype'), $this);?>
:</td>
                                <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Skype'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                            </tr>
                        </table>
                        <br><br>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['info']['Status']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['substatus'][$this->_tpl_vars['info']['Status']][$this->_tpl_vars['info']['SubStatus']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Evaluator direct'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['managers'][$this->_tpl_vars['info']['ManagerID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Profesie'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['jobs'][$this->_tpl_vars['info']['JobDictionaryID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Pregatire'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['studies'][$this->_tpl_vars['info']['Studies']]; ?>
</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="padding-left: 20px; padding-right: 20px; border-right: 1px solid #cccccc;" width="30%">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Centru cost'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['costcenter'][$this->_tpl_vars['info']['CostCenterID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Manager direct'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['directmanager'][$this->_tpl_vars['info']['DirectManagerID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['self'][$this->_tpl_vars['info']['CompanyID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Divizia'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['divisions'][$this->_tpl_vars['info']['DivisionID']]; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['departments'][$this->_tpl_vars['info']['DepartmentID']]['Department']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
:</td>
                                <td><b><?php if (! empty ( $this->_tpl_vars['info']['FunctionID'] )): ?><?php echo $this->_tpl_vars['functions'][$this->_tpl_vars['info']['FunctionID']]['Function']; ?>
 - <?php echo $this->_tpl_vars['functions'][$this->_tpl_vars['info']['FunctionID']]['COR']; ?>
<?php endif; ?></b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Grupa de munca'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['info']['WorkGroup']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Functia interna'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['info']['Function']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Fisa post'), $this);?>
:</td>
                                <td>
                                    <?php if (isset ( $this->_tpl_vars['info']['JDFilePath'] )): ?>
                                        <a href="<?php echo $this->_tpl_vars['info']['JDFilePath']; ?>
" title="" target="_blank"><?php echo smarty_function_translate(array('label' => 'Vizualizeaza'), $this);?>
</a>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Locatie'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['sites'][$this->_tpl_vars['info']['SiteID']]; ?>
</b></td>
                            </tr>
                        </table>
                        <br><br>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Masina marca'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['info']['Marca']; ?>
</b></td>
                            </tr>
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Numar inmatriculare'), $this);?>
:</td>
                                <td><b><?php echo $this->_tpl_vars['info']['NoIm']; ?>
</b></td>
                            </tr>
                        </table>
                    </td>
                    <td style="padding-left: 20px" width="40%">
                        <?php if (! empty ( $this->_tpl_vars['info']['photo'] )): ?><img src="<?php echo $this->_tpl_vars['info']['photo']; ?>
" width="80"><?php endif; ?>
                    </td>
                </tr>
                <tr>
                    <td colspan="3" align="right"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Printeaza'), $this);?>
" onclick="window.print();">&nbsp;&nbsp;<input type="button"
                                                                                                                                                          value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
"
                                                                                                                                                          onclick="history.back();"></a>
                </tr>
            </table>
            <br>
        </td>
    </tr>
    <tr>
        <td valign="top" class="bkdTitleMenu">
        </td>
    </tr>
</table>    	