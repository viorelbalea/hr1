<?php /* Smarty version 2.6.18, created on 2020-10-06 05:30:15
         compiled from dictionary_departments.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_departments.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Nivele organigrama'), $this);?>
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
            <form action="./?m=dictionary&o=division" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Nivel 1'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Cod'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Division_<?php echo $this->_tpl_vars['key']; ?>
" name="Division_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Division']; ?>
" size="70" class="cod"></td>
                                            <td><input type="text" id="DivCode_<?php echo $this->_tpl_vars['key']; ?>
" name="DivCode_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Code']; ?>
" size="6" maxlength="64" class="cod"></td>
                                            <td align="center"><input type="checkbox" id="Status_div_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Division_<?php echo $this->_tpl_vars['key']; ?>
').value) || is_empty(document.getElementById('DivCode_<?php echo $this->_tpl_vars['key']; ?>
').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume sau Cod!'), $this);?>
'); else window.location.href = './?m=dictionary&o=division&DivisionID=<?php echo $this->_tpl_vars['key']; ?>
&Division=' + escape(document.getElementById('Division_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Code=' + escape(document.getElementById('DivCode_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_div_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=division&DivisionID=<?php echo $this->_tpl_vars['key']; ?>
&delDivision=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Division_0" name="Division_0" size="70" class="cod"></td>
                                            <td><input type="text" id="DivCode_0" name="DivCode_0" size="6" maxlength="64" class="cod"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Division_0').value) || is_empty(document.getElementById('DivCode_0').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume sau Cod!'), $this);?>
'); else window.location.href = './?m=dictionary&o=division&DivisionID=0&Division=' + escape(document.getElementById('Division_0').value) + '&Code=' + escape(document.getElementById('DivCode_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
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
        </td>
    </tr>
    <tr>
        <td rowspan="2" class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Nivel 2'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Cod'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nivel 1'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Department_<?php echo $this->_tpl_vars['key']; ?>
" name="Department_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Department']; ?>
" size="70" class="cod"></td>
                                            <td><input type="text" id="DepCode_<?php echo $this->_tpl_vars['key']; ?>
" name="DepCode_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Code']; ?>
" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DivisionID_dep_<?php echo $this->_tpl_vars['key']; ?>
" id="DivisionID_dep_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option><?php $_from = $this->_tpl_vars['divisions_dep']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('Department_<?php echo $this->_tpl_vars['key']; ?>
').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else <?php echo '{'; ?>
var uphis = (<?php echo $this->_tpl_vars['item']['DivisionID']; ?>
 > 0 && document.getElementById('DivisionID_dep_<?php echo $this->_tpl_vars['key']; ?>
').value != <?php echo $this->_tpl_vars['item']['DivisionID']; ?>
 && confirm('<?php echo smarty_function_translate(array('label' => 'Acest departament era alocat altui nivel, doriti actualizarea datelor istorice in tabelel implicate?'), $this);?>
')) == true ? 1 : 0; window.location.href = './?m=dictionary&o=department&DepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&Department=' + escape(document.getElementById('Department_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Code=' + escape(document.getElementById('DepCode_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0) + '&DivisionID=' + document.getElementById('DivisionID_dep_<?php echo $this->_tpl_vars['key']; ?>
').value + '&uphis=' + uphis;<?php echo '}'; ?>
 return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=department&DepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&delDepartment=1'; return false;"
                                                                            class="button_del" title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Department_0" name="Department_0" size="70" class="cod"></td>
                                            <td><input type="text" id="DepCode_0" name="DepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DivisionID_dep_0" id="DivisionID_dep_0" class="dropdown">
                                                    <option value="0">alege...</option><?php $_from = $this->_tpl_vars['divisions_dep']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('Department_0').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else window.location.href = './?m=dictionary&o=department&DepartmentID=0&Department=' + escape(document.getElementById('Department_0').value) + '&Code=' + escape(document.getElementById('DepCode_0').value) + '&DivisionID=' + document.getElementById('DivisionID_dep_0').value; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
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
                    <legend><?php echo smarty_function_translate(array('label' => 'Nivel 3'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Cod'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nivel 2'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="SubDepartment_<?php echo $this->_tpl_vars['key']; ?>
" name="SubDepartment_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['SubDepartment']; ?>
" size="70" class="cod"></td>
                                            <td><input type="text" id="SubDepCode_<?php echo $this->_tpl_vars['key']; ?>
" name="SubDepCode_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Code']; ?>
" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DepartmentID_<?php echo $this->_tpl_vars['key']; ?>
" id="DepartmentID_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option><?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['Department']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('SubDepartment_<?php echo $this->_tpl_vars['key']; ?>
').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else <?php echo '{'; ?>
 window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&SubDepartment=' + escape(document.getElementById('SubDepartment_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Code=' + escape(document.getElementById('SubDepCode_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0) + '&DepartmentID=' + document.getElementById('DepartmentID_<?php echo $this->_tpl_vars['key']; ?>
').value ;<?php echo '}'; ?>
 return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&delSubDepartment=1'; return false;"
                                                                            class="button_del" title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="SubDepartment_0" name="SubDepartment_0" size="70" class="cod"></td>
                                            <td><input type="text" id="SubDepCode_0" name="SubDepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="DepartmentID_0" id="DepartmentID_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option><?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']['Department']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('SubDepartment_0').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else window.location.href = './?m=dictionary&o=subdepartment&SubDepartmentID=0&SubDepartment=' + escape(document.getElementById('SubDepartment_0').value) + '&Code=' + escape(document.getElementById('SubDepCode_0').value) + '&DepartmentID=' + document.getElementById('DepartmentID_0').value; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
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
    </tr>
    <tr>
        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 2px; padding-top: 10px; padding-right: 1px;">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Nivel 4'), $this);?>
</legend>
                    <table border="0" cellpadding="0" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="2" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Cod'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nivel 3'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['subsubdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="SubSubDepartment_<?php echo $this->_tpl_vars['key']; ?>
" name="SubSubDepartment_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['SubSubDepartment']; ?>
" size="70"
                                                       class="cod"></td>
                                            <td><input type="text" id="SubSubDepCode_<?php echo $this->_tpl_vars['key']; ?>
" name="SubSubDepCode_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Code']; ?>
" size="14" maxlength="64" class="cod">
                                            </td>
                                            <td><select name="SubDepartmentID_<?php echo $this->_tpl_vars['key']; ?>
" id="SubDepartmentID_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option><?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['SubDepartment']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (is_empty(document.getElementById('SubSubDepartment_<?php echo $this->_tpl_vars['key']; ?>
').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else <?php echo '{'; ?>
 window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&SubSubDepartment=' + escape(document.getElementById('SubSubDepartment_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Code=' + escape(document.getElementById('SubSubDepCode_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0) + '&SubDepartmentID=' + document.getElementById('SubDepartmentID_<?php echo $this->_tpl_vars['key']; ?>
').value ;<?php echo '}'; ?>
 return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID=<?php echo $this->_tpl_vars['key']; ?>
&delSubSubDepartment=1'; return false;"
                                                                            class="button_del" title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="SubSubDepartment_0" name="SubSubDepartment_0" size="70" class="cod"></td>
                                            <td><input type="text" id="SubSubDepCode_0" name="SubSubDepCode_0" size="14" maxlength="64" class="cod"></td>
                                            <td><select name="SubDepartmentID_0" id="SubDepartmentID_0" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option><?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']['SubDepartment']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (is_empty(document.getElementById('SubSubDepartment_0').value)) alert('<?php echo smarty_function_translate(array('label' => 'Nu ati introdus Nume!'), $this);?>
'); else window.location.href = './?m=dictionary&o=subsubdepartment&SubSubDepartmentID=0&SubSubDepartment=' + escape(document.getElementById('SubSubDepartment_0').value) + '&Code=' + escape(document.getElementById('SubSubDepCode_0').value) + '&SubDepartmentID=' + document.getElementById('SubDepartmentID_0').value; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
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
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista departamentelor care apar in aplicatie'), $this);?>
</span></td>
    </tr>
</table>