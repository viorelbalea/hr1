<?php /* Smarty version 2.6.18, created on 2020-12-03 10:24:07
         compiled from reports_maker_myreports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'reports_maker_myreports.tpl', 8, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reports_maker_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>

<?php if (! empty ( $_GET['ReportID'] )): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "reports_maker_new_view.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php else: ?>
    <select onchange="window.location.href = './?m=reports_maker&o=myreports&ReportID=' + this.value;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege raport'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']['ReportID']; ?>
" <?php if ($_GET['ReportID'] == $this->_tpl_vars['item']['ReportID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Report']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
<?php endif; ?>