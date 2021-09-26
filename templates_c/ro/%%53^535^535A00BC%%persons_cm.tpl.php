<?php /* Smarty version 2.6.18, created on 2020-12-03 10:49:47
         compiled from persons_cm.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_cm.tpl', 22, false),array('modifier', 'default', 'persons_cm.tpl', 36, false),array('modifier', 'escape', 'persons_cm.tpl', 75, false),)), $this); ?>
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
        <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['cm']['0']['FullName']; ?>
</span></td>
    </tr>
</table>
<table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td>
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_payroll_cm&ID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" enctype="multipart/form-data" name="pers"
                      onsubmit="return validateForm(this);">
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Carte de munca'), $this);?>
</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="140" style="padding-top: 10px;"><b>Carte de munca:</b></td>
                                <td style="padding-top: 10px;">
                                    <select name="CM">
                                        <option value=""></option>
                                        <option value="Da" <?php if ($this->_tpl_vars['cmPayroll']['CM'] == 'Da'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Da'), $this);?>
</option>
                                        <option value="Nu" <?php if ($this->_tpl_vars['cmPayroll']['CM'] == 'Nu'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nu'), $this);?>
</option>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Serie CM:</b></td>
                                <td><input type="text" name="CMSerie" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['cmPayroll']['CMSerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="32"></td>
                            </tr>
                            <tr>
                                <td><b>Numar CM:</b></td>
                                <td><input type="text" name="CMNo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['cmPayroll']['CMNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="32"></td>
                            </tr>
                        </table>
                        <div style="text-align:left;">
                            <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?>
                            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle">
                        </div>
                    </fieldset>
                </form>
            </td>
        </tr>
        <tr>
            <td class="" style="vertical-align: top; padding: 10px;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Vechime in munca'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0">
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Data initiala'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Data finala'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Numar zile'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Document'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Serie / Numar'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Vechime specialitate'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Perioada de scazut'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Non Vechime'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Ani / Luni / Zile'), $this);?>
</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['cm']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if ($this->_tpl_vars['key'] > 0): ?>
                                <tr>
                                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_cm&ID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="cm_<?php echo $this->_tpl_vars['key']; ?>
">
                                        <td><input type="text" name="Functie" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Functie'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="30"></td>
                                        <td><input type="text" name="Companie" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Companie'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="30"></td>
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
.select(document.cm_<?php echo $this->_tpl_vars['key']; ?>
.StartDate,'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"
                                               ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="StopDate" name="StopDate" class="formstyle" value="<?php echo $this->_tpl_vars['item']['DataFin']; ?>
" size="10" maxlength="10">
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
.select(document.cm_<?php echo $this->_tpl_vars['key']; ?>
.StopDate,'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"
                                               ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td><input type="text" name="NoDays" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['NoDays'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="2"/></td>
                                        <td>
                                            <select name="Document">
                                                <option value="">- alege -</option>
                                                <?php $_from = $this->_tpl_vars['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['doc']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['item']['Document'] == $this->_tpl_vars['k']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['doc']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </td>
                                        <td><input type="text" name="SerieNo" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['SerieNo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="10"/></td>
                                        <td><input type="checkbox" name="VechimeSpec" <?php if ($this->_tpl_vars['item']['VechimeSpec'] > 0): ?>checked<?php endif; ?> /></td>
                                        <td><input type="checkbox" name="PerioadaScazut" <?php if ($this->_tpl_vars['item']['PerioadaScazut'] > 0): ?>checked<?php endif; ?> /></td>
                                        <td><input type="checkbox" name="NonVechime" <?php if ($this->_tpl_vars['item']['NonVechime'] > 0): ?>checked<?php endif; ?> /></td>
                                        <td align="center"><?php echo $this->_tpl_vars['item']['years']; ?>
 / <?php echo $this->_tpl_vars['item']['months']; ?>
 / <?php echo $this->_tpl_vars['item']['days']; ?>
</td>
                                        <?php if ($this->_tpl_vars['cm']['0']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.cm_<?php echo $this->_tpl_vars['key']; ?>
.Functie.value) && !is_empty(document.cm_<?php echo $this->_tpl_vars['key']; ?>
.Companie.value)) document.cm_<?php echo $this->_tpl_vars['key']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Functie, Companie!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_cm&ID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                        onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a>
                                                </div>
                                            </td>
                                        <?php else: ?>
                                            <td colspan="2">&nbsp;</td>
                                        <?php endif; ?>
                                    </form>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php if (count ( $this->_tpl_vars['cm'] ) > 1): ?>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Vechime in munca anterior locului de munca actual'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['cyears']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cmonths']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cdays']; ?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Vechime totala in specialitate'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['cyearsS']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cmonthsS']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cdaysS']; ?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Vechime scazuta anterior locului de munca actual'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['cyearsM']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cmonthsM']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cdaysM']; ?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>

                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Perioada care nu se considera vechime in munca'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['cyearsN']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cmonthsN']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['cdaysN']; ?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Vechime la locul actual de munca'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['curr_years']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['curr_months']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['curr_days']; ?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td colspan="9" style="text-align:right;"><b><?php echo smarty_function_translate(array('label' => 'Vechime totala in munca (include si actualul loc de munca)'), $this);?>
</b></td>
                                <td align="center"><?php echo $this->_tpl_vars['cm']['0']['ctyears']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['ctmonths']; ?>
 / <?php echo $this->_tpl_vars['cm']['0']['ctdays']; ?>
 <br/><!--(<?php echo $this->_tpl_vars['cm']['0']['cfs']; ?>
 zile CFS deja scazute)--></td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                        <?php endif; ?>
                        <tr>
                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_cm" method="post" name="cm_0">
                                <td><input type="text" name="Functie" size="30"></td>
                                <td><input type="text" name="Companie" size="30"></td>
                                <td>
                                    <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                        var cal1_0 = new CalendarPopup();
                                        cal1_0.isShowNavigationDropdowns = true;
                                        cal1_0.setYearSelectStartOffset(10);
                                        //writeSource("js1_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal1_0.select(document.cm_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
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
                                    <A HREF="#" onClick="cal2_0.select(document.cm_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                                src="./images/cal.png" border="0"></A>
                                </td>
                                <td><input type="text" name="NoDays" size="2"/></td>
                                <td>
                                    <select name="Document">
                                        <option value="">- alege -</option>
                                        <?php $_from = $this->_tpl_vars['documents']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['doc']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['doc']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td><input type="text" name="SerieNo" value="" size="10"/></td>
                                <td><input type="checkbox" name="VechimeSpec"/></td>
                                <td><input type="checkbox" name="PerioadaScazut"/></td>
                                <td><input type="checkbox" name="NonVechime"/></td>
                                <td>&nbsp;</td>
                                <td align="center"><?php if ($this->_tpl_vars['cm']['0']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.cm_0.Functie.value) && !is_empty(document.cm_0.Companie.value)) document.cm_0.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Functie, Calitate!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                <td>&nbsp;</td>
                            </form>
                        </tr>
                        <tr>
                            <td colspan="12"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle"></td>
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
