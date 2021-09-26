<?php /* Smarty version 2.6.18, created on 2020-10-12 09:10:01
         compiled from settings_submenu_2.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'settings_submenu_2.tpl', 4, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['rights_level_3']['6']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
    <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['6']['2'][$this->_tpl_vars['key']] > 0): ?>
        <a href="./?m=settings&o=<?php echo $this->_tpl_vars['item']['o']; ?>
"
           class="subMeniuPage<?php if ($this->_tpl_vars['item']['o'] == $_GET['o']): ?>Activ<?php endif; ?>"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a><?php if (! ($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>