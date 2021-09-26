<?php /* Smarty version 2.6.18, created on 2020-10-06 13:02:25
         compiled from pontaj_reports.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_reports.tpl', 14, false),array('modifier', 'cat', 'pontaj_reports.tpl', 33, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pontaj_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div class="filter">
    <label>Alege raport:</label>
    <select name="report_id" onchange="window.location.href = './?m=pontaj&o=reports&report_id=' + this.value;">
        <option value="0">alege...</option>
        <?php $_from = $this->_tpl_vars['reports']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $_GET['report_id'] ) && $_GET['report_id'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <?php if (! empty ( $_GET['report_id'] ) && isset ( $this->_tpl_vars['reports'][$_GET['report_id']] )): ?>
        <div class="outputZone outputZoneOne">
            <div>
                <ul>
                    <li class="header"><label><?php echo smarty_function_translate(array('label' => 'Output'), $this);?>
</label></li>
                    <li>
                        <td width="60"><input type="button" class="cod printFile" value="Printeaza" onclick="window.open('<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print', 'print')">
                        </td>
                    </li>
                    <li>
                        <td width="60"><input type="button" class="cod exportFile" value="Export .xls"
                                              onclick="window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export'"></td>
                    </li>
                    <li>
                        <td width="60"><input type="button" class="cod exportFile" value="Export .doc"
                                              onclick="window.location.href='<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export_doc'"></td>
                    </li>
                </ul>
            </div>
        </div>
    <?php endif; ?>
</div>
<?php if (! empty ( $_GET['report_id'] ) && isset ( $this->_tpl_vars['reports'][$_GET['report_id']] )): ?>
    <?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => ((is_array($_tmp=((is_array($_tmp='pontaj_reports_')) ? $this->_run_mod_handler('cat', true, $_tmp, $_GET['report_id']) : smarty_modifier_cat($_tmp, $_GET['report_id'])))) ? $this->_run_mod_handler('cat', true, $_tmp, ".tpl") : smarty_modifier_cat($_tmp, ".tpl")), 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<?php endif; ?>