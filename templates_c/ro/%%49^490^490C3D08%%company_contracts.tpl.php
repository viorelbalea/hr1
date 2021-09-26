<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:02
         compiled from company_contracts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'company_contracts.tpl', 11, false),array('modifier', 'date_format', 'company_contracts.tpl', 26, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Contracte'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['contracts'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <th>Nr. Contract</th>
                            <th>Nume Contract</th>
                            <th>Tip Contract</th>
                            <th>Data Semnare Contract</th>
                            <th>Persoana Contact Beneficiar</th>
                        </tr>
                        <?php $_from = $this->_tpl_vars['contracts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                            <tr>
                                <td><a href="./?m=contract&o=edit&ContractID=<?php echo $this->_tpl_vars['item']['ContractID']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['ContractNo']; ?>
</a></td>
                                <td><?php echo $this->_tpl_vars['item']['ContractName']; ?>
</td>
                                <td><?php echo $this->_tpl_vars['item']['ContractType']; ?>
</td>
                                <td><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['SignDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
                                <td>
                                    <?php if (! empty ( $this->_tpl_vars['item']['contacts'] )): ?>
                                        <?php $_from = $this->_tpl_vars['item']['contacts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contact']):
?>
                                            <?php echo $this->_tpl_vars['contact']['ContactName']; ?>
<?php if (! empty ( $this->_tpl_vars['contact']['ContactFunction'] ) || ! empty ( $this->_tpl_vars['contact']['ContactPhone'] )): ?> (<?php if (! empty ( $this->_tpl_vars['contact']['ContactFunction'] )): ?><?php echo $this->_tpl_vars['contact']['ContactFunction']; ?>
, <?php endif; ?><?php echo $this->_tpl_vars['contact']['ContactPhone']; ?>
)<?php endif; ?>
                                            <br>
                                        <?php endforeach; endif; unset($_from); ?>
                                    <?php else: ?>
                                        -
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>
                <?php else: ?>
                    <p><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</p>
                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
</table>