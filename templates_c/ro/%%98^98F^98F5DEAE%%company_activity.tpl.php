<?php /* Smarty version 2.6.18, created on 2020-09-21 08:33:59
         compiled from company_activity.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'company_activity.tpl', 13, false),array('modifier', 'default', 'company_activity.tpl', 89, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => ' Datele companiei au fost salvate!'), $this);?>
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 4px; padding-bottom: 10px;" width="65%">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Domenii de activitate principale'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>#</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Obiecte activitate'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['activities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td><?php echo $this->_tpl_vars['key']; ?>
</td>
                                <td>
                                    <select name="CompanyDomainID_<?php echo $this->_tpl_vars['item']['ID']; ?>
" id="CompanyDomainID_<?php echo $this->_tpl_vars['item']['ID']; ?>
" class="dropdown">
                                        <option value="0">alege...</option>
                                        <?php $_from = $this->_tpl_vars['companydomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyDomainID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td><input type="checkbox" id="active_<?php echo $this->_tpl_vars['item']['ID']; ?>
" <?php if ($this->_tpl_vars['item']['Active'] == 1): ?>checked<?php endif; ?>></td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('CompanyDomainID_<?php echo $this->_tpl_vars['item']['ID']; ?>
').value<=0 ) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati selectat Obiect activitate'), $this);?>
!'); else window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=mod&ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
&CompanyDomainID=' + escape(document.getElementById('CompanyDomainID_<?php echo $this->_tpl_vars['item']['ID']; ?>
').value) + '&active=' + (document.getElementById('active_<?php echo $this->_tpl_vars['item']['ID']; ?>
').checked == true ? 1 : 0); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica activitate'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a) ca vreti sa stergeti aceasta activitate?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del&ID=<?php echo $this->_tpl_vars['item']['ID']; ?>
'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge activitate'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <tr>
                            <td>&nbsp;</td>
                            <td><select name="CompanyDomainID_0" id="CompanyDomainID_0" class="dropdown">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['companydomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td><input type="checkbox" id="active_0"></td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('CompanyDomainID_0').value<=0) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati selectat Obiect activitate'), $this);?>
!'); else window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=add&CompanyDomainID=' + escape(document.getElementById('CompanyDomainID_0').value) +  '&active=' + (document.getElementById('active_0').checked == true ? 1 : 0); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga activitate'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                            <td>&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Training'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Compania ofera training'), $this);?>
:</b></td>
                            <td><input type="checkbox" name="isTrainer" value="1" <?php if ($this->_tpl_vars['info']['isTrainer'] == 1): ?>checked<?php endif; ?>></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Detalii training'), $this);?>
:</b></td>
                            <td><textarea name="TrainingNotes" rows="3" cols="36"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['TrainingNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr valign="top">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Tipul de training oferit'), $this);?>
:</b></td>
                            <td>
                                <?php $_from = $this->_tpl_vars['training_types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <input type="checkbox" name="TrainingTypeID[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['training_types'][$this->_tpl_vars['key']] )): ?>checked<?php endif; ?>>
                                    <?php echo $this->_tpl_vars['item']; ?>

                                    <br>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Asigurare / beneficii'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Compania ofera asigurari / beneficii'), $this);?>
:</b></td>
                            <td><input type="checkbox" name="isAssurance" value="1" <?php if ($this->_tpl_vars['info']['isAssurance'] == 1): ?>checked<?php endif; ?>></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Detalii asigurari / beneficii'), $this);?>
:</b></td>
                            <td><textarea name="AssuranceNotes" rows="3" cols="36"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['AssuranceNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                    </table>
                </fieldset>


                <br/>

                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Fleet Management'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Compania este furnizor de servicii auto'), $this);?>
:</b></td>
                            <td><input type="checkbox" name="isAutoFurnizor" value="1" <?php if ($this->_tpl_vars['info']['isAutoFurnizor'] == 1): ?>checked<?php endif; ?>></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Detalii servicii auto'), $this);?>
:</b></td>
                            <td><textarea name="AutoFurnizorNotes" rows="3" cols="36"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['AutoFurnizorNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                    </table>
                </fieldset>

            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 4px; padding-right: 4px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Descriere firma'), $this);?>
</legend>
                    <textarea name="CompanyDescr" cols="44" rows="12" wrap="soft"><?php echo $this->_tpl_vars['info']['CompanyDescr']; ?>
</textarea>
                </fieldset>
                <br>
                <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?>
                    <div align="center"><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"></div><?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>