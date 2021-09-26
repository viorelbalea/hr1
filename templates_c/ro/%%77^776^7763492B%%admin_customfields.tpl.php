<?php /* Smarty version 2.6.18, created on 2020-10-05 06:28:19
         compiled from admin_customfields.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_customfields.tpl', 5, false),array('modifier', 'default', 'admin_customfields.tpl', 18, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Campuri custom'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Personal'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomPerson 1'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"><?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
 </td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomPerson 2'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomPerson 3'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomPerson 4'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson4" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson4'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomPerson 5'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson5" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson5'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomPerson 6'), $this);?>
:</td>
                                        <td><input type="text" name="CustomPerson6" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomPerson6'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Companii'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomCompany 1'), $this);?>
:</td>
                                        <td><input type="text" name="CustomCompany1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomCompany1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomCompany 2'), $this);?>
:</td>
                                        <td><input type="text" name="CustomCompany2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomCompany2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomCompany 3'), $this);?>
:</td>
                                        <td><input type="text" name="CustomCompany3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomCompany3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Joburi'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomJob 1'), $this);?>
:</td>
                                        <td><input type="text" name="CustomJob1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomJob1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomJob 2'), $this);?>
:</td>
                                        <td><input type="text" name="CustomJob2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomJob2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomJob 3'), $this);?>
:</td>
                                        <td><input type="text" name="CustomJob3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomJob3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Evenimente'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomEvent 1'), $this);?>
:</td>
                                        <td><input type="text" name="CustomEvent1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomEvent1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomEvent 2'), $this);?>
:</td>
                                        <td><input type="text" name="CustomEvent2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomEvent2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
                                    </tr>
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'CustomEvent 3'), $this);?>
:</td>
                                        <td><input type="text" name="CustomEvent3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomEvent3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                   maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Training'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0"
                        <tr>
                            <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomTraining 1'), $this);?>
:</td>
                            <td><input type="text" name="CustomTraining1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomTraining1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'CustomTraining 2'), $this);?>
:</td>
                            <td><input type="text" name="CustomTraining2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomTraining2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>

                            </td>
                        </tr>
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'CustomTraining 3'), $this);?>
:</td>
                            <td><input type="text" name="CustomTraining3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomTraining3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>

                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
    </table>
    </fieldset>
    <br>
    <fieldset>
        <legend><?php echo smarty_function_translate(array('label' => 'Produse'), $this);?>
</legend>
        <table border="0" cellpadding="4" cellspacing="0" class="screen">
            <tr>
                <td>
                    <table border="0" cellpadding="4" cellspacing="0"
            <tr>
                <td width="120"><?php echo smarty_function_translate(array('label' => 'CustomProduct 1'), $this);?>
:</td>
                <td><input type="text" name="CustomProduct1" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomProduct1'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
            </tr>
            <tr>
                <td><?php echo smarty_function_translate(array('label' => 'CustomProduct 2'), $this);?>
:</td>
                <td><input type="text" name="CustomProduct2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomProduct2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip text)'), $this);?>
</td>
            </tr>
            <tr>
                <td><?php echo smarty_function_translate(array('label' => 'CustomProduct 3'), $this);?>
:</td>
                <td><input type="text" name="CustomProduct3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['customfields']['CustomProduct3'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" maxlength="32"> <?php echo smarty_function_translate(array('label' => '(camp de tip data)'), $this);?>
</td>
            </tr>
        </table>
        </td>
        </tr>
        </table>
    </fieldset>
    <br>
    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">
    </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de campuri custom care apar in aplicatie'), $this);?>
</span></td>
    </tr>
    </table>
</form>