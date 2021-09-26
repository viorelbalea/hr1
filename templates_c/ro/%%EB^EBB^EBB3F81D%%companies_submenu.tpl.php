<?php /* Smarty version 2.6.18, created on 2020-09-21 08:33:57
         compiled from companies_submenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'companies_submenu.tpl', 4, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['rights_level_3']['2']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
    <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['2']['1'][$this->_tpl_vars['key']] > 0): ?>
        <a href="./?m=companies&o=<?php echo $this->_tpl_vars['item']['o']; ?>
&CompanyID=<?php echo $_GET['CompanyID']; ?>
"
           class="subMeniuPage<?php if ($this->_tpl_vars['item']['o'] == $_GET['o']): ?>Activ<?php endif; ?>"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a><?php if (! ($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>