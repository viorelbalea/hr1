<?php /* Smarty version 2.6.18, created on 2021-07-27 08:28:25
         compiled from report_57.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('modifier', 'default', 'report_57.tpl', 4, false),array('modifier', 'date_format', 'report_57.tpl', 10, false),)), $this); ?>
<?php if (! empty ( $_GET['PersonID'] )): ?>
    <div style="width:800px; margin:0px;">

        <p><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
</b><br/>
            <b>Adresa: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyAddress'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
</b><br/>
            <b>R.C.: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RegComert'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
</b><br/>
            <b>C.F.: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIF'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
</b><br/>
            <b>Tel.: <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberA'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
</b></p>

        <p style="text-align:right"><b>........... / <?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b></p>

        <p style="text-align:center"><strong>ADEVERINTA</strong></p>
        <br/>
        <p style="text-indent:20px;">Se adevereste prin prezenta ca <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>dl<?php else: ?>dna<?php endif; ?> <b><?php echo $this->_tpl_vars['info']['FullName']; ?>
</b>, avand
            CNP <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
, este <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>salariat al<?php else: ?>salariata a<?php endif; ?>
            companiei <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '..............................') : smarty_modifier_default($_tmp, '..............................')); ?>
 in functia de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '...........................................') : smarty_modifier_default($_tmp, '...........................................')); ?>
, iar
            societatea declara pe propria raspundere ca are platite toate contributiile catre Casa de Asigurari de Sanatate in contul RO85TREZ7005502XXXXXXXXX, deschis la
            Trezoreria Operativa a Municipiului Bucuresti.</p>
        <p><?php if ($this->_tpl_vars['info']['FirmAge'] >= 1): ?>In ultimele 12 luni<?php else: ?>De cand se afla in evidenta noastra<?php endif; ?> <?php if ($this->_tpl_vars['info']['Sex'] == 'M'): ?>salariatul<?php else: ?>salariata<?php endif; ?> a beneficiat
            de <?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['cm_days'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
 zile de concediu medical.</p>
        <p style="text-indent:20px;">Prezenta adeverinta se elibereaza pentru a-i servi la medicul de familie.</p>
        <br/>
        <br/>
        <table border="1" width="100%" align="center">
            <tr>
                <th>Cod de indemnizatie</th>
                <th>Numar zile concediu medical in ultimele 12 luni</th>
            </tr>
            <?php $_from = $this->_tpl_vars['infoCM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <tr>
                    <td><?php echo $this->_tpl_vars['item']['CodInd']; ?>
</td>
                    <td><?php echo $this->_tpl_vars['item']['Days']; ?>
</td>
                </tr>
            <?php endforeach; endif; unset($_from); ?>
        </table>
        <table width="100%" align="center">
            <tr>
                <td width="50%"><strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '.......................') : smarty_modifier_default($_tmp, '.......................')); ?>
  </strong>,</td>
                <td width="50%" align="right">DATA</td>
            </tr>
            <tr>
                <td width="50%">______________________</td>
                <td width="50%" align="right"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
            </tr>
        </table>

    </div>
<?php endif; ?>