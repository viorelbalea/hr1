<?php /* Smarty version 2.6.18, created on 2020-09-09 07:30:33
         compiled from dictionary_menu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'count', 'dictionary_menu.tpl', 2, false),array('function', 'translate', 'dictionary_menu.tpl', 7, false),)), $this); ?>
<div class="submeniu">
    <?php if (count($this->_tpl_vars['rights_level_3']['20']['1']) > 13): ?>
        <?php $_from = $this->_tpl_vars['rights_level_3']['20']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>

            <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_RIGHTS3']['20']['1'][$this->_tpl_vars['key']] )): ?>
                <a href="./?m=dictionary&o=<?php echo $this->_tpl_vars['item']['o']; ?>
" <?php if ($_GET['o'] == $this->_tpl_vars['item']['o']): ?>class="selected"
                   <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a>
            <?php endif; ?>

        <?php endforeach; endif; unset($_from); ?>
    <?php else: ?>
        <?php $_from = $this->_tpl_vars['rights_level_3']['20']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_RIGHTS3']['20']['1'][$this->_tpl_vars['key']] )): ?>
                <a href="./?m=dictionary&o=<?php echo $this->_tpl_vars['item']['o']; ?>
" <?php if ($_GET['o'] == $this->_tpl_vars['item']['o']): ?>class="selected"
                   <?php else: ?>class="unselected"<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    <?php endif; ?>
</div>