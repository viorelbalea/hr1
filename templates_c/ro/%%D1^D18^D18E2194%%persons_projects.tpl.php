<?php /* Smarty version 2.6.18, created on 2020-09-21 09:44:05
         compiled from persons_projects.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_projects.tpl', 18, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
        </td>
        <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['projects']['0']['FullName']; ?>
</span></td>
    </tr>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Pontaj pe proiecte'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
*</td>
                        <td><?php echo smarty_function_translate(array('label' => 'An'), $this);?>
*</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Luna'), $this);?>
*</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Numar ore'), $this);?>
*</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <tr>
                                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit&ID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="pers_<?php echo $this->_tpl_vars['key']; ?>
">
                                    <td>
                                        <select name="ProjectID">
                                            <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['projects_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <?php if ($this->_tpl_vars['key2'] > 0): ?>
                                                    <option value="<?php echo $this->_tpl_vars['item2']['ProjectID']; ?>
" <?php if ($this->_tpl_vars['item2']['ProjectID'] == $this->_tpl_vars['item']['ProjectID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item2']['Name']; ?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Year" id="Year">
                                            <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item2']; ?>
" <?php if ($this->_tpl_vars['item']['Year'] == $this->_tpl_vars['item2']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Month" id="Month">
                                            <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item2']; ?>
" <?php if ($this->_tpl_vars['item']['Month'] == $this->_tpl_vars['item2']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select name="Hours" id="Hours">
                                            <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item2']; ?>
" <?php if ($this->_tpl_vars['item']['Hours'] == $this->_tpl_vars['item2']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <?php if ($this->_tpl_vars['projects']['0']['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.ProjectID.value) && !is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.Year.value) && !is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.Month.value) && !is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.Hours.value)) document.pers_<?php echo $this->_tpl_vars['key']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Selectati Proiect, An, Luna, Numar ore ! '), $this);?>
'); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica inregistrare'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del&ID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                    onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge inregistrare'), $this);?>
"><b>Del</b></a></div>
                                        </td>
                                    <?php else: ?>
                                        <td colspan="2">&nbsp;</td>
                                    <?php endif; ?>
                                </form>
                            </tr>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <tr>
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new" method="post" name="pers_0">
                            <td>
                                <select name="ProjectID">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['projects_list']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                        <?php if ($this->_tpl_vars['key2'] > 0): ?>
                                            <option value="<?php echo $this->_tpl_vars['item2']['ProjectID']; ?>
"><?php echo $this->_tpl_vars['item2']['Name']; ?>
</option>
                                        <?php endif; ?>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <select name="Year" id="Year">
                                    <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['curr_year']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <select name="Month" id="Month">
                                    <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['curr_month']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <select name="Hours" id="Hours">
                                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['item'] == $this->_tpl_vars['curr_norm']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td align="center"><?php if ($this->_tpl_vars['projects']['0']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.pers_0.ProjectID.value) && !is_empty(document.pers_0.Year.value) && !is_empty(document.pers_0.Month.value) && !is_empty(document.pers_0.Hours.value)) document.pers_0.submit(); else alert('Selectati Proiect, An, Luna, Numar ore !'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga inregistrare'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                </table>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>
</form>
