<?php /* Smarty version 2.6.18, created on 2020-09-02 10:35:06
         compiled from persons_submenu.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_submenu.tpl', 5, false),)), $this); ?>
<?php $_from = $this->_tpl_vars['rights_level_3']['1']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
    <?php if ($_SESSION['USER_ID'] == 1 || $_SESSION['USER_RIGHTS3']['1']['1'][$this->_tpl_vars['key']] > 0): ?>
        <?php if (( $this->_tpl_vars['info']['Status'] == 1 && in_array ( $this->_tpl_vars['key'] , array ( 1 , 3 , 5 , 11 , 14 , 17 , 18 , 20 , 21 , 22 ) ) ) || in_array ( $this->_tpl_vars['info']['Status'] , array ( 2 , 7 , 9 , 10 , 12 ) ) || ( $this->_tpl_vars['info']['Status'] > 2 && ! in_array ( $this->_tpl_vars['key'] , array ( 15 , 16 , 17 ) ) )): ?>
            <a href="./?m=persons&o=<?php echo $this->_tpl_vars['item']['o']; ?>
&PersonID=<?php echo $_GET['PersonID']; ?>
"
               class="subMeniuPage<?php if ($this->_tpl_vars['item']['o'] == $_GET['o']): ?>Activ<?php endif; ?>"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']['name']), $this);?>
</a><?php if (! ($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>&nbsp;&nbsp;|&nbsp;&nbsp;<?php endif; ?>
        <?php endif; ?>
    <?php endif; ?>
<?php endforeach; endif; unset($_from); ?>