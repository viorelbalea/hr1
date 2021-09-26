<?php /* Smarty version 2.6.18, created on 2020-09-21 06:37:39
         compiled from functions_new.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'functions_new.tpl', 6, false),array('modifier', 'default', 'functions_new.tpl', 93, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "functions_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <?php if (! empty ( $_GET['FunctionID'] )): ?>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span
                        class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Modificare functie - '), $this);?>
<?php echo $this->_tpl_vars['functions']['0']['Function']; ?>
<?php if ($this->_tpl_vars['functions']['0']['FunctionObs'] != ''): ?>&nbsp;&nbsp;<i>
                        (<?php echo $this->_tpl_vars['functions']['0']['FunctionObs']; ?>
)</i><?php endif; ?></span></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adaugare functie'), $this);?>
</span></td>
        </tr>
    <?php endif; ?>
    <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == ""): ?>
        <tr height="30">
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele functiei au fost salvate!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Informatii functie'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
*</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Aplicabila personal'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Functie superioara'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Functie executiva'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Nivel instruire'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Numar pozitii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Vechime in companie'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Vechime in functie'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Fisa postului'), $this);?>
</td>
                    </tr>
                    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key0'] => $this->_tpl_vars['info']):
?>
                        <?php if ($this->_tpl_vars['key0'] > 0 && ! empty ( $this->_tpl_vars['info']['FunctionID'] )): ?>
                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&FunctionCompanyID=<?php echo $this->_tpl_vars['info']['FunctionCompanyID']; ?>
&action=edit" method="post" name="q_<?php echo $this->_tpl_vars['info']['FunctionCompanyID']; ?>
">
                                <input type="hidden" name="FunctionCompanyID" value="<?php echo $this->_tpl_vars['info']['FunctionCompanyID']; ?>
"/>
                                <tr>
                                    <td nowrap="nowrap">
                                        <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="Aplicable" name="Aplicable" <?php if ($this->_tpl_vars['info']['Aplicable'] == 1): ?> checked="checked"<?php endif; ?> value="1"/></td>
                                    <td>
                                        <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['parent_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['ParentFunctionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="DottedLineFunctionID" name="DottedLineFunctionID" class="dropdown" style="width:120px;">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['parent_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['info']['DottedLineFunctionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="EducationalLevelID" id="EducationalLevelID" style="width:160px;">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['educational_levels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                <optgroup label="<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key']), $this);?>
">
                                                    <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <?php if (is_array ( $this->_tpl_vars['item2'] )): ?>
                                                            <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key2']), $this);?>
">
                                                                <?php $_from = $this->_tpl_vars['item2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                                                    <option value="<?php echo $this->_tpl_vars['key3']; ?>
"
                                                                            <?php if (! empty ( $this->_tpl_vars['info']['EducationalLevelID'] ) && $this->_tpl_vars['key3'] == $this->_tpl_vars['info']['EducationalLevelID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item3']), $this);?>
</option>
                                                                <?php endforeach; endif; unset($_from); ?>
                                                            </optgroup>
                                                        <?php else: ?>
                                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
"
                                                                    <?php if (! empty ( $this->_tpl_vars['info']['EducationalLevelID'] ) && $this->_tpl_vars['key2'] == $this->_tpl_vars['info']['EducationalLevelID']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']), $this);?>
</option>
                                                        <?php endif; ?>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </optgroup>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="Positions" id="Positions" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Positions'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
" style="width:25px;"/></td>
                                    <td><input type="text" name="CompanyAge" id="CompanyAge" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CompanyAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
" style="width:25px;"/> ani</td>
                                    <td><input type="text" name="TotalAge" id="TotalAge" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['TotalAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '0') : smarty_modifier_default($_tmp, '0')); ?>
" style="width:25px;"/> ani</td>
                                    <!--<td><textarea name="Notes" id="Notes" cols="20" rows="4" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FunctionNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>-->
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['key0']; ?>
" name="Notes" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FunctionNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"><span id="Notes_<?php echo $this->_tpl_vars['key0']; ?>
_display"></span><br/>
                                        [<a href="#" onclick="getNotes('Notes_<?php echo $this->_tpl_vars['key0']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Fisa postului'), $this);?>
</a>]
                                    </td>
                                    <td nowrap="nowrap">
                                        <div id="button_mod" style="float:left;"><a href="#"
                                                                                    onclick="if(!is_empty(document.getElementById('CompanyID').value) ) document.q_<?php echo $this->_tpl_vars['info']['FunctionCompanyID']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre functie!'), $this);?>
'); return false;"
                                                                                    title="Modifica functie"><b>Mod</b></a></div>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('Sunteti sigura(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&FunctionCompanyID=<?php echo $this->_tpl_vars['info']['FunctionCompanyID']; ?>
&action=del'; return false;"
                                                                title="Sterge functie"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            </form>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <!-- Add new question inside a section -->
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new" method="post" name="q_0">
                        <input type="hidden" name="FunctionID" value="<?php echo $this->_tpl_vars['functions']['0']['FunctionID']; ?>
"/>
                        <tr>
                            <td nowrap="nowrap">
                                <select id="CompanyID" name="CompanyID" class="dropdown" style="width:120px;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td><input type="checkbox" id="Aplicable" name="Aplicable" value="1"/></td>
                            <td>
                                <select id="ParentFunctionID" name="ParentFunctionID" class="dropdown" style="width:120px;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['parent_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <select id="DottedLineFunctionID" name="DottedLineFunctionID" class="dropdown" style="width:120px;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['parent_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <select name="EducationalLevelID" id="EducationalLevelID" style="width:160px;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['educational_levels']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <optgroup label="<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key']), $this);?>
">
                                            <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <?php if (is_array ( $this->_tpl_vars['item2'] )): ?>
                                                    <optgroup label="&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key2']), $this);?>
">
                                                        <?php $_from = $this->_tpl_vars['item2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                                            <option value="<?php echo $this->_tpl_vars['key3']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item3']), $this);?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']), $this);?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </optgroup>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td><input type="text" name="Positions" id="Positions" value="0" style="width:25px;"/></td>
                            <td><input type="text" name="CompanyAge" id="CompanyAge" value="0" style="width:25px;"/> ani</td>
                            <td><input type="text" name="TotalAge" id="TotalAge" value="0" style="width:25px;"/> ani</td>
                            <!--<td><textarea name="Notes" id="Notes" cols="20" rows="4" wrap="soft"></textarea></td>-->
                            <td><input type="hidden" id="Notes_0" name="Notes" value=""><span id="Notes_0_display"></span><br/> [<a href="#"
                                                                                                                                    onclick="getNotes('Notes_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Fisa postului'), $this);?>
</a>]
                            </td>
                            <td>
                                <div id="button_add"><a href="#"
                                                        onclick="if(!is_empty(document.getElementById('CompanyID').value) && !is_empty(document.getElementById('CompanyID').value)) document.q_0.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre functie!'), $this);?>
'); return false;"
                                                        title="Adauga functie"><b>Add</b></a></div>
                            </td>
                        </tr>
                    </form>

                    <tr>
                        <td>
                            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
" onclick="window.location.href='./?m=functions';" class="formstyle">
                        </td>
                    </tr>

                </table>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>

<div id="layer_co"
     style="display: none; width: 600px; height: 220px; position: fixed; z-index: 1001; top: 200px; left: 50%; margin-left: -300px; box-shadow: 3px 3px 5px #888; background:#ffffff; border: 1px solid #999999;">
    <h3 style="width: 580px; height: 26px; background-color: #b6b6b6; padding: 6px 0 0 20px; margin-top: 0;"><?php echo smarty_function_translate(array('label' => 'Fisa postului'), $this);?>
</h3>
    <div style="padding: 0 20px 0 20px;">
        <textarea id="layer_co_notes" style="width: 100%; height: 120px;"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value="">
        <br><br>
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" onclick="setNotes();">&nbsp;&nbsp;
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<div id="layer_co_x"
     style="display: none; width:20px; height:18px; position:fixed; left:50%; margin-left:275px; top:205px; z-index:1002; background:#efefef; border:1px solid #ccc; color:#333; cursor:pointer; text-align:center; font-weight:bold; padding-top:2px; border-radius:50px;"
     title="Inchide" onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">X
</div>


<script type="text/javascript">
    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key0'] => $this->_tpl_vars['info']):
?>
    <?php if ($this->_tpl_vars['key0'] > 0): ?>
    document.getElementById('Notes_<?php echo $this->_tpl_vars['key0']; ?>
_display').innerHTML = document.getElementById('Notes_<?php echo $this->_tpl_vars['key0']; ?>
').value.substring(0, 10) + '...';
    <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>

    <?php echo '
    function getNotes(id) {
        document.getElementById(\'layer_co_notes\').value = document.getElementById(id).value;
        document.getElementById(\'layer_co_notes_dest\').value = id;
        document.getElementById(\'layer_co\').style.display = \'block\';
        document.getElementById(\'layer_co_x\').style.display = \'block\';
    }

    function setNotes() {
        var id = document.getElementById(\'layer_co_notes_dest\').value;
        document.getElementById(id).value = document.getElementById(\'layer_co_notes\').value;
        document.getElementById(id + \'_display\').innerHTML = document.getElementById(\'layer_co_notes\').value.substring(0, 10) + \'...\';
        document.getElementById(\'layer_co\').style.display = \'none\';
        document.getElementById(\'layer_co_x\').style.display = \'none\';
    }
    '; ?>

</script>

