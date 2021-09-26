<?php /* Smarty version 2.6.18, created on 2020-10-07 11:28:04
         compiled from dictionary_performance_dimensions.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_performance_dimensions.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Dimensiuni'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                    <font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font>
                    <br>
                    <br>
                <?php endif; ?>
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Denumire dimensiune'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['dimensions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Dimension_<?php echo $this->_tpl_vars['key']; ?>
" name="Dimension_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Dimension']; ?>
" size="80" maxlength="255"></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=performance_dimension&DimensionID=<?php echo $this->_tpl_vars['key']; ?>
&Dimension=' + escape(document.getElementById('Dimension_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica dimensiune'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=performance_dimension&DimensionID=<?php echo $this->_tpl_vars['key']; ?>
&delDimension=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge dimensiune'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Dimension_0" name="Dimension_0" size="80" maxlength="255"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=performance_dimension&DimensionID=0&Dimension=' + escape(document.getElementById('Dimension_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga dimensiune'), $this);?>
"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista dimensiunilor'), $this);?>
</span></td>
        </tr>
    </table>
</form>