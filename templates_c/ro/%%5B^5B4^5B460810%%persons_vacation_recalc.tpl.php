<?php /* Smarty version 2.6.18, created on 2020-09-22 07:55:31
         compiled from persons_vacation_recalc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_vacation_recalc.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Recalculare concedii'), $this);?>
</span></td>
    </tr>
    <tr>
        <td>
            <select name="year" onchange="if (this.value > 0) window.location.href = './?m=persons&o=vacation_recalc&year=' + this.value;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'alege anul...'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?>
                    <option value="<?php echo $this->_tpl_vars['year']; ?>
" <?php if ($this->_tpl_vars['year'] == $_GET['year']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['year']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        </td>
    </tr>
</table>
<?php if (! empty ( $this->_tpl_vars['success'] )): ?>
    <?php echo smarty_function_translate(array('label' => 'Recalculare finalizata pentru %s','values' => $_GET['year']), $this);?>
!
<?php endif; ?>