<?php /* Smarty version 2.6.18, created on 2020-10-06 16:48:57
         compiled from reports_maker_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'reports_maker_menu.tpl', 2, false),)), $this); ?>
<div class="submeniu">
    <a href="./?m=reports" class="unselected"><?php echo smarty_function_translate(array('label' => 'Rapoarte'), $this);?>
</a>
    <?php $_from = $this->_tpl_vars['rights_level_2']['33']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_RIGHTS2']['33'][$this->_tpl_vars['key']] )): ?>
            <a href="./?m=reports_maker<?php if (! empty ( $this->_tpl_vars['item']['o'] )): ?>&o=<?php echo $this->_tpl_vars['item']['o']; ?>
<?php endif; ?>"
               <?php if ($_GET['o'] == $this->_tpl_vars['item']['o']): ?>class="selected"
               <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
</div>