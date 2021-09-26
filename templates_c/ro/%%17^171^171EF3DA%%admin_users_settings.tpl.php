<?php /* Smarty version 2.6.18, created on 2020-10-13 10:46:42
         compiled from admin_users_settings.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_users_settings.tpl', 5, false),array('modifier', 'default', 'admin_users_settings.tpl', 24, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Setari speciale pentru'), $this);?>
 <u><?php echo $this->_tpl_vars['info']['UserName']; ?>
</a></span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Setari speciale'), $this);?>
</legend>
                    <br>
                    <table cellspacing="0" cellpadding="2" style="border: 1px solid #666666; padding: 10px;">
                        <tr>
                            <td style="padding-right: 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Company self'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="checkbox" name="UserCompanySelf[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (in_array ( $this->_tpl_vars['key'] , $this->_tpl_vars['info']['UserCompanySelf'] )): ?>checked<?php endif; ?>> <?php echo $this->_tpl_vars['item']; ?>
</p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Zile concediu retroactive'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="text" name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][vacation_days]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['vacation_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="4"
                                              maxlength="4"></p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Limitare concediu la zilele ramase din an'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="checkbox" name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][vacation_limit]" value="1"
                                              <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['vacation_limit'] == 1): ?>checked<?php endif; ?>></p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Numarul de zile pentru pontaj'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="text" name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][pontaj_days]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="4"
                                              maxlength="4"></p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Nivel validare pontaj'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p>
                                        <select name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][pontaj_validation_level]">
                                            <option value="0"></option>
                                            <option value="1" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 1): ?>selected<?php endif; ?>>1</option>
                                            <option value="2" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 2): ?>selected<?php endif; ?>>2</option>
                                            <option value="3" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 3): ?>selected<?php endif; ?>>3</option>
                                            <option value="4" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 4): ?>selected<?php endif; ?>>4</option>
                                            <option value="5" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 5): ?>selected<?php endif; ?>>5</option>
                                            <option value="6" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 6): ?>selected<?php endif; ?>>6</option>
                                            <option value="7" <?php if ($this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_validation_level'] == 7): ?>selected<?php endif; ?>>7</option>
                                        </select>
                                    </p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Numar zile planificare pontaj'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="text" name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][pontaj_planif_days]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['pontaj_planif_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                              size="4" maxlength="4"></p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                            <td align="center" style="border-left: 1px solid #666666; padding: 0 10px 0 10px;">
                                <b><?php echo smarty_function_translate(array('label' => 'Numar zile perioada proba'), $this);?>
</b><br>
                                <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <p><input type="text" name="CompanySettings[<?php echo $this->_tpl_vars['key']; ?>
][probation_days]" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanySettings'][$this->_tpl_vars['key']]['probation_days'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="4"
                                              maxlength="4"></p>
                                <?php endforeach; endif; unset($_from); ?>
                            </td>
                        </tr>
                    </table>
                    <br><br>
                    <?php if ($this->_tpl_vars['info']['UserType'] == 'role'): ?>
                        <b><?php echo smarty_function_translate(array('label' => 'Tip role'), $this);?>
:</b>
                        <br>
                        <select name="RoleType" style="margin-top: 4px;">
                            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                            <?php $_from = $this->_tpl_vars['role_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['RoleType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endforeach; endif; unset($_from); ?>
                        </select>
                        <br>
                        <br>
                        <br>
                    <?php endif; ?>
                    <b><?php echo smarty_function_translate(array('label' => 'Roluri pe care le poate aloca'), $this);?>
:</b><br>
                    <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
                        <?php if ($this->_tpl_vars['user']['UserType'] == 'role'): ?>
                            <input type="checkbox" name="RoleAlloc[<?php echo $this->_tpl_vars['user']['UserID']; ?>
]" value="<?php echo $this->_tpl_vars['user']['UserID']; ?>
"
                                   <?php if (in_array ( $this->_tpl_vars['user']['UserID'] , $this->_tpl_vars['info']['RoleAlloc'] )): ?>checked<?php endif; ?>><?php echo $this->_tpl_vars['user']['UserName']; ?>
&nbsp;&nbsp;&nbsp;
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <br><br><br>
                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">&nbsp;&nbsp;<input type="button" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
"
                                                                                                 onclick="window.location.href = './?m=admin&o=users';">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'utilizatori si drepturi'), $this);?>
</span></td>
        </tr>
    </table>
</form>