<?php /* Smarty version 2.6.18, created on 2020-09-21 08:48:36
         compiled from persons_intretinere.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_intretinere.tpl', 18, false),)), $this); ?>
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
        <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['persons']['0']['FullName']; ?>
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
                <legend><?php echo smarty_function_translate(array('label' => 'Persoane in intretinere'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Nume persoana'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Calitate'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data initiala'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data finala'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Activ / Inactiv'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($this->_tpl_vars['key'] > 0): ?>
                            <tr>
                                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_pers&ID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="pers_<?php echo $this->_tpl_vars['key']; ?>
">
                                    <td><input type="text" name="Nume" value="<?php echo $this->_tpl_vars['item']['Nume']; ?>
" size="30"></td>
                                    <td>
                                        <select name="Calitate">
                                            <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                            <?php $_from = $this->_tpl_vars['quality']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['Calitate']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="text" name="CNP" value="<?php echo $this->_tpl_vars['item']['CNP']; ?>
" size="20"></td>
                                    <td>
                                        <input type="text" id="StartDate" name="StartDate" class="formstyle" value="<?php echo $this->_tpl_vars['item']['DataIni']; ?>
" size="10" maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                            var cal1_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                            cal1_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                            cal1_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                            //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StartDate,'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"
                                           ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate" name="StopDate" class="formstyle" value="<?php if ($this->_tpl_vars['item']['DataFin'] != '00-00-0000'): ?><?php echo $this->_tpl_vars['item']['DataFin']; ?>
<?php endif; ?>" size="10"
                                               maxlength="10">
                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['key']; ?>
">
                                            var cal2_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                            cal2_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                            cal2_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                            //writeSource("js2_<?php echo $this->_tpl_vars['key']; ?>
");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal2_<?php echo $this->_tpl_vars['key']; ?>
.select(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StopDate,'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"
                                           ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                    </td>
                                    <td align="center"><input type="checkbox" name="Active" <?php if ($this->_tpl_vars['item']['Active'] == 1): ?>checked<?php endif; ?>></td>
                                    <?php if ($this->_tpl_vars['persons']['0']['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.Nume.value) && !is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.Calitate.value) && !is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.CNP.value) && document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StartDate.value && checkDate(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StartDate.value, 'Data initiala') && (is_empty(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StopDate.value) || checkDate(document.pers_<?php echo $this->_tpl_vars['key']; ?>
.StopDate.value, 'Data finala'))) document.pers_<?php echo $this->_tpl_vars['key']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Nume, Calitate, CNP, Data initiala ! '), $this);?>
'); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica persoana'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_pers&ID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                    onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge persoana'), $this);?>
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
&action=new_pers" method="post" name="pers_0">
                            <td><input type="text" name="Nume" size="30"></td>
                            <td>
                                <select name="Calitate">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['quality']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td><input type="text" name="CNP" size="20"></td>
                            <td>
                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.pers_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.pers_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td align="center"><?php if ($this->_tpl_vars['persons']['0']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.pers_0.Nume.value) && !is_empty(document.pers_0.Calitate.value) && !is_empty(document.pers_0.CNP.value) && document.pers_0.StartDate.value && checkDate(document.pers_0.StartDate.value, 'Data initiala') && (is_empty(document.pers_0.StopDate.value) || checkDate(document.pers_0.StopDate.value, 'Data finala'))) document.pers_0.submit(); else alert('Completati Nume, Calitate, CNP, Data initiala !'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga persoana'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </form>
                    </tr>
                </table>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>
</form>
