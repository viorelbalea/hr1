<?php /* Smarty version 2.6.18, created on 2020-09-07 08:07:43
         compiled from report_149.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_149.tpl', 1, false),array('modifier', 'default', 'report_149.tpl', 1, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
"/></td>
</b><br/>
 cu sediul social declarat in
<?php endif; ?>,
,

<?php else: ?>judetul <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............') : smarty_modifier_default($_tmp, '..............')); ?>
<?php endif; ?>,
, CUI: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
,
<?php else: ?>domnul .....................................................<?php endif; ?>



 contractul individual de
, avand functia de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................') : smarty_modifier_default($_tmp, '...........................')); ?>

 sa inceteze conform <b>art. 55 lit. b</b> din Codul Muncii.
</b>
<br/>
