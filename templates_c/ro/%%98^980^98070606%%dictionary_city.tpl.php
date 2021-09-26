<?php /* Smarty version 2.6.18, created on 2020-10-07 11:30:53
         compiled from dictionary_city.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_city.tpl', 4, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Orase'), $this);?>
</span></td>
    </tr>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; padding-top: 10px;"><font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font></td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Judete / Districte'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <tr>
                                    <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                                    <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                </tr>
                                <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="DistrictName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DistrictName']; ?>
" size="30" maxlength="64"></td>
                                        <td><input type="checkbox" id="Active_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Active'] == 1): ?>checked<?php endif; ?>></td>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=city&DistrictID=<?php echo $this->_tpl_vars['key']; ?>
&DistrictName=' + escape(document.getElementById('DistrictName_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Active=' + (document.getElementById('Active_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Editeaza judet'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a) ca vreti sa stergeti acest judet?'), $this);?>
')) window.location.href = './?m=dictionary&o=city&DistrictID=<?php echo $this->_tpl_vars['key']; ?>
&delDistrict=1'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge judet'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <tr>
                                        <td><input type="text" id="DistrictName_0" size="30" maxlength="64"></td>
                                        <td colspan="3">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=city&DistrictID=0&DistrictName=' + escape(document.getElementById('DistrictName_0').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga judet'), $this);?>
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
                <legend><?php echo smarty_function_translate(array('label' => 'Orase'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select onchange="if (this.value>0) window.location.href='./?m=dictionary&o=city&DistrictID=' + this.value">
                                <option value="0"><?php echo smarty_function_translate(array('label' => 'alege judet'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br>
                <?php if (! empty ( $_GET['DistrictID'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Realocare'), $this);?>
</td>
                            <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if ($this->_tpl_vars['key'] > 0): ?>
                                <tr>
                                    <td><input type="text" id="CityName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CityName']; ?>
" size="30" maxlength="64"></td>
                                    <td>
                                        <select id="NewCityID_<?php echo $this->_tpl_vars['key']; ?>
">
                                            <option value="0"><?php echo smarty_function_translate(array('label' => 'realoca oras'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <?php if ($this->_tpl_vars['key'] != $this->_tpl_vars['key2']): ?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']['CityName']; ?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="checkbox" id="Active__<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Active'] == 1): ?>checked<?php endif; ?>></td>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=city&DistrictID=<?php echo $_GET['DistrictID']; ?>
&CityID=<?php echo $this->_tpl_vars['key']; ?>
&CityName=' + escape(document.getElementById('CityName_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Active=' + (document.getElementById('Active__<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica oras'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a) ca vreti sa stergeti acest oras?'), $this);?>
')) window.location.href = './?m=dictionary&o=city&DistrictID=<?php echo $_GET['DistrictID']; ?>
&CityID=<?php echo $this->_tpl_vars['key']; ?>
&NewCityID=' + document.getElementById('NewCityID_<?php echo $this->_tpl_vars['key']; ?>
').value + '&delCity=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge oras'), $this);?>
"><b>Del</b></a></div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <tr>
                                <td><input type="text" id="CityName_0" size="30" maxlength="64"></td>
                                <td colspan="3">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=dictionary&o=city&DistrictID=<?php echo $_GET['DistrictID']; ?>
&CityID=0&CityName=' + escape(document.getElementById('CityName_0').value); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga oras'), $this);?>
"><b>Add</b></a></div>
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                    <?php echo $this->_tpl_vars['pagination']; ?>

                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'judete si orase'), $this);?>
</span></td>
    </tr>
</table>