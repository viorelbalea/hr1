<?php /* Smarty version 2.6.18, created on 2020-09-21 08:48:32
         compiled from persons_antropometrie.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_antropometrie.tpl', 14, false),array('modifier', 'default', 'persons_antropometrie.tpl', 52, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['info']['FullName']; ?>
</span></td>
        </tr>
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Date antropometrice'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Grupa sangvina'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="Grupa_sangvina" class="dropdown">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['grupa_sangvina']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['Grupa_sangvina'] != '' && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Grupa_sangvina']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b>RH:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="HR" class="dropdown">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['sang_hr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['HR'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['HR']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Greutate (kg)'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Greutate" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Greutate'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Inaltime (m)'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Inaltime" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Inaltime'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                    </table>
                </fieldset>
                <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?>
                    <div align="center"><br><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"> <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                                onclick="window.location='./?m=persons'"
                                                                                                                                class="formstyle"></div><?php endif; ?>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Masuri'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Masura casca'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_casca" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Masura_casca'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Masura manusi'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_manusi" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Masura_manusi'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Masura haine (salopeta)'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_haine" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Masura_haine'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Masura pantaloni'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_pantaloni" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Masura_pantaloni'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Masura pantofi'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="Masura_pantofi" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Masura_pantofi'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>