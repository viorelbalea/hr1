<?php /* Smarty version 2.6.18, created on 2021-04-01 10:01:43
         compiled from report_134.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'date_format', 'report_134.tpl', 13, false),array('modifier', 'default', 'report_134.tpl', 20, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
    <div style="width:800px; margin:0px;">

        <?php if ($this->_tpl_vars['info']['CompanyID'] && $this->_tpl_vars['info']['CompanyPhoto']): ?>
            <table width="100%" border="0" cellspacing="0" cellpadding="0">
                <tr width="100%">
                    <td align="center"><img src="<?php echo $this->_tpl_vars['info']['CompanyPhoto']; ?>
"/></td>
                </tr>
            </table>
            <br clear="all"/>
        <?php endif; ?>

        <p style="text-align:right"><b>Nr. ........... /<?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b></p>
        <br/>

        <p style="text-align:center"><strong>ADEVERINTA</strong></p>
        <br/>
        <p style="text-indent:40px; text-align:justify;">
            Se adevereste prin prezenta ca <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>Domnul<?php else: ?>Doamna<?php endif; ?> <b><?php echo $this->_tpl_vars['info']['FullName']; ?>
</b>,
            CNP <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
,
            este <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>salariat<?php else: ?>salariata<?php endif; ?> la <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>

            avand un contract de munca pe durata <?php echo $this->_tpl_vars['info']['ContractType']; ?>
 din data de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StartDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '.............................') : smarty_modifier_default($_tmp, '.............................')); ?>
,
            in functia de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
 .
        </p>

        <p style="text-indent:40px; text-align:justify;">
            Se elibereaza prezenta spre a-i servi la gradinita.
        </p>

        <br/><br/><br/>

        <p style="text-align:left">
            <b>DIRECTOR GENERAL,<br/>
                <?php echo smarty_modifier_default(@$this->_tpl_vars['info']['LegalFullName'], '.......................................................'); ?>
</b>
        </p>

    </div>
<?php endif; ?>