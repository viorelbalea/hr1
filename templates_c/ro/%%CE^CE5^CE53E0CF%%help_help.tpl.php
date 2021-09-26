<?php /* Smarty version 2.6.18, created on 2021-09-14 10:57:13
         compiled from help_help.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'help_help.tpl', 2, false),)), $this); ?>
<div class="submeniu">
    <a href="./?m=help&o=about" class="unselected"><?php echo smarty_function_translate(array('label' => 'Despre HR Executive'), $this);?>
</a>
    <a href="./?m=help&o=help" class="selected"><?php echo smarty_function_translate(array('label' => 'Ajutor'), $this);?>
</a>
</div>
<iframe src="help/index.html" width="100%" frameborder="0" height="700"></iframe>