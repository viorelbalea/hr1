<?php /* Smarty version 2.6.18, created on 2021-04-05 07:46:46
         compiled from report_147.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_147.tpl', 1, false),array('modifier', 'default', 'report_147.tpl', 1, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
"/></td>
</b></p>
</b>, <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>domiciliat<?php else: ?>domiciliata<?php endif; ?> in
, Str. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonStreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '................................') : smarty_modifier_default($_tmp, '................................')); ?>

, Bl. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonBl'])) ? $this->_run_mod_handler('default', true, $_tmp, '............') : smarty_modifier_default($_tmp, '............')); ?>
, Sc. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonSc'])) ? $this->_run_mod_handler('default', true, $_tmp, '............') : smarty_modifier_default($_tmp, '............')); ?>
,
, Ap. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonAp'])) ? $this->_run_mod_handler('default', true, $_tmp, '........') : smarty_modifier_default($_tmp, '........')); ?>
, Judet/Sector <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PersonDistrict'])) ? $this->_run_mod_handler('default', true, $_tmp, '............') : smarty_modifier_default($_tmp, '............')); ?>
,</b>
, nr. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BINumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '....................') : smarty_modifier_default($_tmp, '....................')); ?>
,
, este <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>angajatul<?php else: ?>angajata<?php endif; ?> societatii
, CUI <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>

, Str. <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..........................') : smarty_modifier_default($_tmp, '..........................')); ?>
,
, Judet/Sector <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DistrictName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............') : smarty_modifier_default($_tmp, '..............')); ?>
,</b>
 ore/zi, incheiat pe durata <?php echo $this->_tpl_vars['info']['ContractType']; ?>


 conform carnetului de munca seria .........., nr. ..................... .
<?php endif; ?></td>
<?php endif; ?></td>
<?php endif; ?></td>
 contractul individual de munca

, in baza prevederilor .............................., din Legea nr.53/2003 - Codul muncii,
 zile de absente nemotivate si ............. zile concediu fara plata.