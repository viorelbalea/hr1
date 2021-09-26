<?php /* Smarty version 2.6.18, created on 2020-10-06 05:30:26
         compiled from dictionary_function_group.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_function_group.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Grupa de functii interne'), $this);?>
</span></td>
    </tr>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 1px; padding-top: 10px;">
            <form action="./?m=dictionary&o=groups" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Grupe de functii'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Grupa de functii '), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Ord. '), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Group_<?php echo $this->_tpl_vars['key']; ?>
" name="Group_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['GroupName']; ?>
" size="24" maxlength="128" class="cod"></td>
                                            <td><input type="text" id="Grad_<?php echo $this->_tpl_vars['key']; ?>
" name="Grad_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Grad']; ?>
" size="6" maxlength="64" class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Group_<?php echo $this->_tpl_vars['key']; ?>
').value) || is_empty(document.getElementById('Grad_<?php echo $this->_tpl_vars['key']; ?>
').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Grupa de functii sau Grad!'), $this);?>
'); else window.location.href = './?m=dictionary&o=groups&GroupID=<?php echo $this->_tpl_vars['key']; ?>
&Group=' + escape(document.getElementById('Group_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Grad=' + escape(document.getElementById('Grad_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica grupa de functii'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=groups&GroupID=<?php echo $this->_tpl_vars['key']; ?>
&delGroup=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge grupa de functii'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Group_0" name="Group_0" size="24" maxlength="128" class="cod"></td>
                                            <td><input type="text" id="Grad_0" name="Grad_0" size="6" maxlength="64" class="cod"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Group_0').value) || is_empty(document.getElementById('Grad_0').value)) alert('Nu ati introdus Grupa de functii sau Grad!'); else window.location.href = './?m=dictionary&o=groups&GroupID=0&Group=' + escape(document.getElementById('Group_0').value) + '&Grad=' + escape(document.getElementById('Grad_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga grupa de functii'), $this);?>
"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Functii interne'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume functie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume grupa'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => ' Activ'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Function_<?php echo $this->_tpl_vars['key']; ?>
" name="Function_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Function']; ?>
" size="40" maxlength="128" class="cod"></td>
                                            <td><select name="GroupID_<?php echo $this->_tpl_vars['key']; ?>
" id="GroupID_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege grupa...'), $this);?>
</option><?php $_from = $this->_tpl_vars['groups_func']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['GroupID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['GroupName']; ?>
</option><?php endforeach; endif; unset($_from); ?></select>
                                            </td>
                                            <td align="center"><input type="checkbox" id="Statusf_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Function_<?php echo $this->_tpl_vars['key']; ?>
').value) || document.getElementById('GroupID_<?php echo $this->_tpl_vars['key']; ?>
').selectedIndex == 0) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume functie sau Grupa de functii!'), $this);?>
'); else window.location.href = './?m=dictionary&o=function_group&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&Function=' + escape(document.getElementById('Function_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Statusf_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0) + '&GroupID=' + document.getElementById('GroupID_<?php echo $this->_tpl_vars['key']; ?>
').value; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica functie'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=function_group&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&delFunction=1'; return false;"
                                                                            class="button_del" title="<?php echo smarty_function_translate(array('label' => 'Sterge functie'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <table style="width: 100%;">
                                                    <tr>
                                                        <td style="font-weight: bold;">Grad / Treapta</td>
                                                        <td style="font-weight: bold;">Studii</td>
                                                        <td style="font-weight: bold;">Gradatie</td>
                                                        <td style="font-weight: bold;">Coeficient</td>
                                                        <td></td>
                                                    </tr>
                                                    <tr></tr>

                                                </table>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Function_0" name="Function_0" size="40" maxlength="128" class="cod"></td>
                                            <td><select name="GroupID_0" id="GroupID_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege grupa...'), $this);?>
</option><?php $_from = $this->_tpl_vars['groups_func']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']['GroupName']; ?>
 - <?php echo $this->_tpl_vars['item2']['Grad']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Function_0').value) || document.getElementById('GroupID_0').selectedIndex == 0) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume functie sau Grupa de functii!'), $this);?>
'); else window.location.href = './?m=dictionary&o=function_group&FunctionID=0&Function=' + escape(document.getElementById('Function_0').value) + '&GroupID=' + document.getElementById('GroupID_0').value; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga functie'), $this);?>
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
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista functiilor interne care apar in aplicatie'), $this);?>
</span></td>
    </tr>
</table>