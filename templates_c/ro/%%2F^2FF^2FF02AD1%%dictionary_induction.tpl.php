<?php /* Smarty version 2.6.18, created on 2020-09-21 09:13:25
         compiled from dictionary_induction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_induction.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Inductie'), $this);?>
</span></td>
    </tr>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Capitole'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td><?php echo smarty_function_translate(array('label' => 'Nume capitol'), $this);?>
</td>
                                    <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                    <td colspan="2">&nbsp;</td>
                                </tr>
                                <?php $_from = $this->_tpl_vars['induction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="Cap_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Capitol']; ?>
" size="40" maxlength="255"></td>
                                        <td align="center"><input type="checkbox" id="Status_cap_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=induction&CapitolID=<?php echo $this->_tpl_vars['key']; ?>
&Capitol=' + escape(document.getElementById('Cap_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_cap_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica capitol'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Stergerea unui capitol implica stergerea tuturor item-urilor aferente.\nSunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=induction&CapitolID=<?php echo $this->_tpl_vars['key']; ?>
&delCapitol=1'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge capitol'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <tr>
                                        <td><input type="text" id="Cap_0" size="40" maxlength="255"></td>
                                        <td colspan="3">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=induction&CapitolID=0&Capitol=' + escape(document.getElementById('Cap_0').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga capitol'), $this);?>
"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Items'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select onchange="if (this.value>0) window.location.href='./?m=dictionary&o=induction&CapitolID=' + this.value">
                                <option value=""><?php echo smarty_function_translate(array('label' => 'alege capitol'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['induction']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CapitolID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Capitol']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <?php if (! empty ( $_GET['CapitolID'] )): ?>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Items'), $this);?>
</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['induction_items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text" id="Item_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Item']; ?>
" size="40" maxlength="255"></td>
                                    <td align="center"><input type="checkbox" id="Status_item_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=induction&CapitolID=<?php echo $_GET['CapitolID']; ?>
&ItemID=<?php echo $this->_tpl_vars['key']; ?>
&Item=' + escape(document.getElementById('Item_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_item_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica item'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=induction&CapitolID=<?php echo $_GET['CapitolID']; ?>
&ItemID=<?php echo $this->_tpl_vars['key']; ?>
&delItem=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge item'), $this);?>
"><b>Del</b></a></div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <tr>
                                    <td><input type="text" id="Item_0" size="40" maxlength="255"></td>
                                    <td colspan="3">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=induction&CapitolID=<?php echo $_GET['CapitolID']; ?>
&ItemID=0&Item=' + escape(document.getElementById('Item_0').value); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga item'), $this);?>
"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'dictionar inductie'), $this);?>
</span></td>
    </tr>
</table>