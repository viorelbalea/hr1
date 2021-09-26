<?php /* Smarty version 2.6.18, created on 2020-09-09 11:48:08
         compiled from dictionary_functions_recr.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_functions_recr.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Functii'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                                    <font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Grad / Treapta'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Studii'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Gradatie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Coeficient'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
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
" size="40" maxlength="128"></td>
                                            <td>
                                                <select id="FunctionType_<?php echo $this->_tpl_vars['key']; ?>
" name="FunctionType_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['functionType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! empty ( $this->_tpl_vars['item']['FunctionType'] ) && $this->_tpl_vars['k'] == $this->_tpl_vars['item']['FunctionType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="GradTreapta_<?php echo $this->_tpl_vars['key']; ?>
" name="GradTreapta_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['gradTreapta']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! empty ( $this->_tpl_vars['item']['GradTreapta'] ) && $this->_tpl_vars['k'] == $this->_tpl_vars['item']['GradTreapta']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Studii_<?php echo $this->_tpl_vars['key']; ?>
" name="Studii_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['studii']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! empty ( $this->_tpl_vars['item']['Studii'] ) && $this->_tpl_vars['k'] == $this->_tpl_vars['item']['Studii']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Gradatie_<?php echo $this->_tpl_vars['key']; ?>
" name="Gradatie_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['gradatie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if (! empty ( $this->_tpl_vars['item']['Gradatie'] ) && $this->_tpl_vars['k'] == $this->_tpl_vars['item']['Gradatie']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['i']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <input type="text" id="Coeficient_<?php echo $this->_tpl_vars['key']; ?>
" name="Coeficient_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Coeficient']; ?>
" size="5" maxlength="7">
                                            </td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=function_recr&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&Function=' + escape(document.getElementById('Function_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&FunctionType=' + escape(document.getElementById('FunctionType_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&GradTreapta=' + escape(document.getElementById('GradTreapta_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&Gradatie=' + escape(document.getElementById('Gradatie_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&Studii=' + escape(document.getElementById('Studii_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&Coeficient=' + escape(document.getElementById('Coeficient_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                                    '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica functie'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=function_recr&FunctionID=<?php echo $this->_tpl_vars['key']; ?>
&delFunction=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge functie'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Function_0" name="Function_0" size="40" maxlength="128"></td>
                                            <td>
                                                <select id="FunctionType_0" name="FunctionType_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['functionType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['FunctionType'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['FunctionType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="GradTreapta_0" name="GradTreapta_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['gradTreapta']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['GradTreapta'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['GradTreapta']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Studii_0" name="Studii_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['studii']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="Gradatie_0" name="Gradatie_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['gradatie']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td><input type="text" id="Coeficient_0" name="Coeficient_0" size="5" maxlength="7"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=function_recr&FunctionID=0&Function=' + escape(document.getElementById('Function_0').value) +
                                                                        '&FunctionType=' + escape(document.getElementById('FunctionType_0').value) +
                                                                        '&GradTreapta=' + escape(document.getElementById('GradTreapta_0').value) +
                                                                        '&Gradatie=' + escape(document.getElementById('Gradatie_0').value) +
                                                                        '&Coeficient=' + escape(document.getElementById('Coeficient_0').value) +
                                                                        '&Studii=' + escape(document.getElementById('Studii_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga functie'), $this);?>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista functiilor pentru recrutare care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>