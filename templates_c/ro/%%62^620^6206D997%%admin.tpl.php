<?php /* Smarty version 2.6.18, created on 2020-10-05 06:28:17
         compiled from admin.tpl */ ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php if (empty ( $_GET['o'] )): ?>
    <div id="checkversion" align="center"></div>
    <script type="text/javascript">showInfo('./update/checkversion.php', 'checkversion');</script>
<?php endif; ?>