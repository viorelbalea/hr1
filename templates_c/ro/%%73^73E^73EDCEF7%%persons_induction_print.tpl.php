<?php /* Smarty version 2.6.18, created on 2020-12-03 12:20:18
         compiled from persons_induction_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_induction_print.tpl', 3, false),array('modifier', 'date_format', 'persons_induction_print.tpl', 28, false),)), $this); ?>
<html>
<head>
    <title><?php echo smarty_function_translate(array('label' => 'HR Executive'), $this);?>
</title>
    <link href="images/style2.css" rel="stylesheet" type="text/css">
    <link rel="shortcut icon" href="images/favicon.ico"/>
</head>
<body onLoad="window.print();">
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="padding-left: 10px; padding-right: 10px; border-top: 1px solid #EDEDED;">
            <h2><?php echo $this->_tpl_vars['info']['FullName']; ?>
</h2>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="padding-top: 10px; padding-left: 10px; padding-right: 10px;">
            <?php $_from = $this->_tpl_vars['induction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <?php if ($this->_tpl_vars['key'] > 0): ?>
                    <p><b><?php echo $this->_tpl_vars['item']['0']['Capitol']; ?>
</b></p>
                    <div style="padding-left: 70px;">
                        <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                            <?php if ($this->_tpl_vars['key2'] > 0): ?>
                                <p><input type="checkbox" name="Status[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['key2']; ?>
]" value="1" <?php if (! empty ( $this->_tpl_vars['item2']['Status'] )): ?>checked<?php endif; ?>> <?php echo $this->_tpl_vars['item2']['Item']; ?>
</p>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <p>
                            Responsabil: <?php echo $this->_tpl_vars['employees'][$this->_tpl_vars['item']['0']['ResponsableID']]; ?>

                            &nbsp;&nbsp;&nbsp;
                            Data: <?php if (! empty ( $this->_tpl_vars['item']['0']['CapitolDate'] ) && $this->_tpl_vars['item']['0']['CapitolDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['0']['CapitolDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>
                        </p>
                        <p>&nbsp;</p>
                    </div>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
        </td>
    </tr>
</table>
</body>
</html>