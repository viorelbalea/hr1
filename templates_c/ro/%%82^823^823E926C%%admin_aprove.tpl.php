<?php /* Smarty version 2.6.18, created on 2020-10-13 12:16:58
         compiled from admin_aprove.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_aprove.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" style="background-color: #F9F9F9;" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"> <?php echo smarty_function_translate(array('label' => 'Aprobari'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Aprobare concediu'), $this);?>
</legend>
                    <input type="radio" name="vacation_aprove" value="0" <?php if ($this->_tpl_vars['settings']['vacation_aprove'] == 0): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'fara aprobare'), $this);?>

                    <br><br>
                    <input type="radio" name="vacation_aprove" value="1" <?php if ($this->_tpl_vars['settings']['vacation_aprove'] == 1): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'aprobarea managerului direct'), $this);?>

                    <br><br>
                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Aprobare la nivel de training'), $this);?>
</legend>
                    <input type="radio" name="training_aprove" value="0" <?php if ($this->_tpl_vars['settings']['training_aprove'] == 0): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'fara aprobare'), $this);?>

                    <br><br>
                    <input type="radio" name="training_aprove" value="1" <?php if ($this->_tpl_vars['settings']['training_aprove'] == 1): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'aprobarea managerului direct'), $this);?>

                    <br><br>
                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Aprobare training la nivel de angajat'), $this);?>
</legend>
                    <input type="radio" name="training_person_aprove" value="0" <?php if ($this->_tpl_vars['settings']['training_person_aprove'] == 0): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'fara aprobare'), $this);?>

                    <br><br>
                    <input type="radio" name="training_person_aprove" value="1"
                           <?php if ($this->_tpl_vars['settings']['training_person_aprove'] == 1): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'aprobarea managerului direct'), $this);?>

                    <br><br>
                    <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><font color="#FFFFFF">&nbsp;</td>
        </tr>
    </table>
</form>