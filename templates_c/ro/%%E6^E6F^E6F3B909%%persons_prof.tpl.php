<?php /* Smarty version 2.6.18, created on 2021-09-27 09:41:28
         compiled from persons_prof.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_prof.tpl', 16, false),array('modifier', 'default', 'persons_prof.tpl', 167, false),array('modifier', 'date_format', 'persons_prof.tpl', 177, false),)), $this); ?>
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
        <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['info']['FullName']; ?>
</span></td>
    </tr>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
    <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Date profesionale'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="pers" onsubmit="return validateForm(this);">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Profesie'), $this);?>
:</b></td>
                            <td>
                                <select multiple size="6" name="JobDictionaryID[]" id="JobDictionaryID">
                                    <?php $_from = $this->_tpl_vars['jobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['JobDictionaryID'][$this->_tpl_vars['key']] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['JobDictionaryID'][$this->_tpl_vars['key']]): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Nivelul de instruire'), $this);?>
:</b></td>
                            <td>
                                <select name="EducationalLevel">
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
                                                                    <?php if (! empty ( $this->_tpl_vars['info']['EducationalLevel'] ) && $this->_tpl_vars['key3'] == $this->_tpl_vars['info']['EducationalLevel']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item3']), $this);?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"
                                                            <?php if (! empty ( $this->_tpl_vars['info']['EducationalLevel'] ) && $this->_tpl_vars['key2'] == $this->_tpl_vars['info']['EducationalLevel']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']), $this);?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </optgroup>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Studii absolvite'), $this);?>
:</b></td>
                            <td>
                                <select multiple size="6" name="StudiiAbsolvite[]">
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
                                                                    <?php if (! empty ( $this->_tpl_vars['info']['StudiiAbsolvite'][$this->_tpl_vars['key3']] ) && $this->_tpl_vars['key3'] == $this->_tpl_vars['info']['StudiiAbsolvite'][$this->_tpl_vars['key3']]): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item3']), $this);?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </optgroup>
                                                <?php else: ?>
                                                    <option value="<?php echo $this->_tpl_vars['key2']; ?>
"
                                                            <?php if (! empty ( $this->_tpl_vars['info']['StudiiAbsolvite'][$this->_tpl_vars['key2']] ) && $this->_tpl_vars['key2'] == $this->_tpl_vars['info']['StudiiAbsolvite'][$this->_tpl_vars['key2']]): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']), $this);?>
</option>
                                                <?php endif; ?>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </optgroup>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Pregatire'), $this);?>
:*</b></td>
                            <td>
                                <select name="Studies">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['studies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['Studies'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['Studies']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                                                <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Vechime in firma'), $this);?>
:</b></td>
                            <td>
                                <?php echo $this->_tpl_vars['info']['years']; ?>
 / <?php echo $this->_tpl_vars['info']['months']; ?>
 / <?php echo $this->_tpl_vars['info']['days']; ?>
<?php echo smarty_function_translate(array('label' => '(ani / luni / zile)'), $this);?>

                                <input type="hidden" name="years" value="<?php echo $this->_tpl_vars['info']['years']; ?>
">
                                <input type="hidden" name="months" value="<?php echo $this->_tpl_vars['info']['months']; ?>
">
                                <input type="hidden" name="days" value="<?php echo $this->_tpl_vars['info']['days']; ?>
">
                            </td>
                        </tr>
                        <!--
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Permis auto'), $this);?>
:</b></td>
                            <td>
                                <select name="DrivingLicense"
                                        <?php echo 'onchange="if (this.value == \'Nu\') {document.getElementById(\'DC_A\').disabled = true; document.getElementById(\'DC_B\').disabled = true; document.getElementById(\'DC_C\').disabled = true; document.getElementById(\'DC_D\').disabled = true; document.getElementById(\'DC_E\').disabled = true;} else {document.getElementById(\'DC_A\').disabled = false; document.getElementById(\'DC_B\').disabled = false; document.getElementById(\'DC_C\').disabled = false; document.getElementById(\'DC_D\').disabled = false; document.getElementById(\'DC_E\').disabled = false;}"'; ?>
>
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <option value="Nu" <?php if (! empty ( $this->_tpl_vars['info']['DrivingLicense'] ) && $this->_tpl_vars['info']['DrivingLicense'] == 'Nu'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Nu'), $this);?>
</option>
                                    <option value="Da" <?php if (! empty ( $this->_tpl_vars['info']['DrivingLicense'] ) && $this->_tpl_vars['info']['DrivingLicense'] == 'Da'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Da'), $this);?>
</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Permis categorie'), $this);?>
:</b></td>
                            <td>
                                <input type="checkbox" id="DC_A" name="DrivingCategory[A]" value="A"
                                       <?php if (( is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && isset ( $this->_tpl_vars['info']['DrivingCategory']['A'] ) ) || ( ! is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && strstr ( $this->_tpl_vars['info']['DrivingCategory'] , 'A' ) )): ?>checked<?php endif; ?> />
                                A&nbsp;&nbsp;
                                <input type="checkbox" id="DC_B" name="DrivingCategory[B]" value="B"
                                       <?php if (( is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && isset ( $this->_tpl_vars['info']['DrivingCategory']['B'] ) ) || ( ! is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && strstr ( $this->_tpl_vars['info']['DrivingCategory'] , 'B' ) )): ?>checked<?php endif; ?>>
                                B&nbsp;&nbsp;
                                <input type="checkbox" id="DC_C" name="DrivingCategory[C]" value="C"
                                       <?php if (( is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && isset ( $this->_tpl_vars['info']['DrivingCategory']['C'] ) ) || ( ! is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && strstr ( $this->_tpl_vars['info']['DrivingCategory'] , 'C' ) )): ?>checked<?php endif; ?>>
                                C&nbsp;&nbsp;
                                <input type="checkbox" id="DC_D" name="DrivingCategory[D]" value="D"
                                       <?php if (( is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && isset ( $this->_tpl_vars['info']['DrivingCategory']['D'] ) ) || ( ! is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && strstr ( $this->_tpl_vars['info']['DrivingCategory'] , 'D' ) )): ?>checked<?php endif; ?>>
                                D&nbsp;&nbsp;
                                <input type="checkbox" id="DC_E" name="DrivingCategory[E]" value="E"
                                       <?php if (( is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && isset ( $this->_tpl_vars['info']['DrivingCategory']['E'] ) ) || ( ! is_array ( $this->_tpl_vars['info']['DrivingCategory'] ) && strstr ( $this->_tpl_vars['info']['DrivingCategory'] , 'E' ) )): ?>checked<?php endif; ?>>
                                E
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Numar permis'), $this);?>
:</b></td>
                            <td><input type="text" name="DrivingNo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DrivingNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Serie permis'), $this);?>
:</b></td>
                            <td><input type="text" name="DrivingSerie" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DrivingSerie'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data emitere permis'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="DrivingStartDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['DrivingStartDate'] ) && $this->_tpl_vars['info']['DrivingStartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['DrivingStartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.DrivingStartDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                onClick="document.pers.DrivingStartDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data expirare permis'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="DrivingStopDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['DrivingStopDate'] ) && $this->_tpl_vars['info']['DrivingStopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['DrivingStopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.DrivingStopDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                onClick="document.pers.DrivingStopDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii permis'), $this);?>
:</b></td>
                            <td><input type="text" name="DrivingNotes" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['DrivingNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="40" maxlength="255"></td>
                        </tr>
                        -->
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
:</b></td>
                            <td><textarea name="ProfNotes" rows="8" cols="50"><?php echo $this->_tpl_vars['info']['ProfNotes']; ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td><input type="hidden" name="Status" value="<?php echo $this->_tpl_vars['info']['Status']; ?>
"></td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?> <input type="button"
                                                                                                                                                                   value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                                                                   onclick="window.location='./?m=persons'"
                                                                                                                                                                   class="formstyle">
                            </td>
                        </tr>
                    </form>
                                        <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Certificate / cursuri'), $this);?>
</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Denumire certificat / curs'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Emitent'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Serie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Numar'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput / eliberare'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit / expirare'), $this);?>
</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['certificate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="CertifName_<?php echo $this->_tpl_vars['key']; ?>
" name="CertifName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertifName']; ?>
" size="24" maxlength="255"></td>
                                            <td><input type="text" id="CertifEmitent_<?php echo $this->_tpl_vars['key']; ?>
" name="CertifEmitent_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertifEmitent']; ?>
" size="20" maxlength="255"></td>
                                            <td><input type="text" id="CertifSerie_<?php echo $this->_tpl_vars['key']; ?>
" name="CertifSerie_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertifSerie']; ?>
" size="10" maxlength="16"></td>
                                            <td><input type="text" id="CertifNo_<?php echo $this->_tpl_vars['key']; ?>
" name="CertifNo_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertifNo']; ?>
" size="10" maxlength="16"></td>
                                            <td>
                                                <input type="text" id="CertifStartDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="jsC1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calC1_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calC1_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calC1_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calC1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('CertifStartDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorC1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorC1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorC1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="CertifStopDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StopDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
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
.select(document.getElementById('CertifStopDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CertifName_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('CertifEmitent_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('CertifSerie_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('CertifNo_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('CertifStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('CertifStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput') && document.getElementById('CertifStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('CertifStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&CertifID=<?php echo $this->_tpl_vars['key']; ?>
&CertifName=' + escape(document.getElementById('CertifName_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&CertifEmitent=' + escape(document.getElementById('CertifEmitent_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&CertifSerie=' + escape(document.getElementById('CertifSerie_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&CertifNo=' + escape(document.getElementById('CertifNo_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&StartDate=' + document.getElementById('CertifStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StopDate=' + document.getElementById('CertifStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Denumire certificat, Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica certificat'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&CertifID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge certificat'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td><input type="text" id="CertifName_0" name="CertifName_0" size="24" maxlength="255"></td>
                                        <td><input type="text" id="CertifEmitent_0" name="CertifEmitent_0" size="20" maxlength="255"></td>
                                        <td><input type="text" id="CertifSerie_0" name="CertifSerie_0" size="10" maxlength="16"></td>
                                        <td><input type="text" id="CertifNo_0" name="CertifNo_0" size="10" maxlength="16"></td>
                                        <td>
                                            <input type="text" id="CertifStartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var cal1_0 = new CalendarPopup();
                                                cal1_0.isShowNavigationDropdowns = true;
                                                cal1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal1_0.select(document.getElementById('CertifStartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                               ID="anchor1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="CertifStopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                var cal2_0 = new CalendarPopup();
                                                cal2_0.isShowNavigationDropdowns = true;
                                                cal2_0.setYearSelectStartOffset(10);
                                                //writeSource("js2_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal2_0.select(document.getElementById('CertifStopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                               ID="anchor2_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="CertifType_0" name="Type_0" value="1" />
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CertifName_0').value && document.getElementById('CertifEmitent_0').value && document.getElementById('CertifSerie_0').value && document.getElementById('CertifNo_0').value && document.getElementById('CertifStartDate_0').value && checkDate(document.getElementById('CertifStartDate_0').value, 'Data inceput') && document.getElementById('CertifStopDate_0').value && checkDate(document.getElementById('CertifStopDate_0').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new&CertifName=' + escape(document.getElementById('CertifName_0').value) + '&Type=' + escape(document.getElementById('CertifType_0').value) + '&CertifEmitent=' + escape(document.getElementById('CertifEmitent_0').value) + '&CertifSerie=' + escape(document.getElementById('CertifSerie_0').value) + '&CertifNo=' + escape(document.getElementById('CertifNo_0').value) + '&StartDate=' + document.getElementById('CertifStartDate_0').value + '&StopDate=' + document.getElementById('CertifStopDate_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Denumire certificat, Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga certificat'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Atestate asistent maternal'), $this);?>
</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Numar hotarare'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data eliberare'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data expirare'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Numar copii care pot<br/>fi primiti in plasament'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Tip nevoi copil'), $this);?>
</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['atestate']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="AtestNo_<?php echo $this->_tpl_vars['key']; ?>
" name="CertifNo_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertifNo']; ?>
" size="10" maxlength="16"></td>
                                            <td>
                                                <input type="text" id="AtestStartDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
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
.select(document.getElementById('AtestStartDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="AtestStopDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StopDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
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
.select(document.getElementById('AtestStopDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <select id="NrCopiiPlasament_<?php echo $this->_tpl_vars['key']; ?>
" name="NrCopiiPlasament_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    <option value="">- alege -</option>
                                                    <option value="1" <?php if ($this->_tpl_vars['item']['NrCopiiPlasament'] == 1): ?>selected="selected"<?php endif; ?>>1</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['NrCopiiPlasament'] == 2): ?>selected="selected"<?php endif; ?>>2</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['NrCopiiPlasament'] == 3): ?>selected="selected"<?php endif; ?>>3</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['NrCopiiPlasament'] == 4): ?>selected="selected"<?php endif; ?>>4</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['NrCopiiPlasament'] == 5): ?>selected="selected"<?php endif; ?>>5</option>
                                                </select>
                                            </td>
                                            <td>
                                                <select id="TipNevoiCopil_<?php echo $this->_tpl_vars['key']; ?>
" name="TipNevoiCopil_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    <option value="">- alege -</option>
                                                    <option value="1" <?php if ($this->_tpl_vars['item']['TipNevoiCopil'] == 1): ?>selected="selected"<?php endif; ?>>Cu nevoi speciale</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['TipNevoiCopil'] == 2): ?>selected="selected"<?php endif; ?>>Fara nevoi speciale</option>
                                                </select>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('AtestNo_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('AtestStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('AtestStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput') && document.getElementById('AtestStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('AtestStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&CertifID=<?php echo $this->_tpl_vars['key']; ?>
&NrCopiiPlasament=' + escape(document.getElementById('NrCopiiPlasament_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&TipNevoiCopil=' + escape(document.getElementById('TipNevoiCopil_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&CertifNo=' + escape(document.getElementById('AtestNo_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&StartDate=' + document.getElementById('AtestStartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StopDate=' + document.getElementById('AtestStopDate_<?php echo $this->_tpl_vars['key']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica atestat'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&CertifID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge atestat'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td><input type="text" id="AtestNo_0" name="CertifNo_0" size="10" maxlength="16"></td>
                                        <td>
                                            <input type="text" id="AtestStartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var cal1_0 = new CalendarPopup();
                                                cal1_0.isShowNavigationDropdowns = true;
                                                cal1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal1_0.select(document.getElementById('AtestStartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                               ID="anchor1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="AtestStopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                var cal2_0 = new CalendarPopup();
                                                cal2_0.isShowNavigationDropdowns = true;
                                                cal2_0.setYearSelectStartOffset(10);
                                                //writeSource("js2_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="cal2_0.select(document.getElementById('AtestStopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                               ID="anchor2_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <select id="NrCopiiPlasament_0" name="NrCopiiPlasament_0">
                                                <option value="">- alege -</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                                <option value="3">3</option>
                                                <option value="4">4</option>
                                                <option value="5">5</option>
                                            </select>
                                        </td>
                                        <td>
                                            <select id="TipNevoiCopil_0" name="TipNevoiCopil_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Cu nevoi speciale</option>
                                                <option value="2">Fara nevoi speciale</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="AtestType_0" name="Type_0" value="2" />
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('AtestNo_0').value && document.getElementById('AtestStartDate_0').value && checkDate(document.getElementById('AtestStartDate_0').value, 'Data inceput') && document.getElementById('AtestStopDate_0').value && checkDate(document.getElementById('AtestStopDate_0').value, 'Data sfarsit')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new&NrCopiiPlasament=' + escape(document.getElementById('NrCopiiPlasament_0').value) + '&Type=' + escape(document.getElementById('AtestType_0').value) + '&TipNevoiCopil=' + escape(document.getElementById('TipNevoiCopil_0').value) + '&CertifNo=' + escape(document.getElementById('AtestNo_0').value) + '&StartDate=' + document.getElementById('AtestStartDate_0').value + '&StopDate=' + document.getElementById('AtestStopDate_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga atestat'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Avize Psihologice</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Titlu Document</td></td>
                                        <td>Numar Document</td>
                                        <td>Data Document</td>
                                        <td>Emis de</td>
                                        <td>Tip document</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php if ($this->_tpl_vars['psyDocsNew']): ?>
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['psyDocsNew']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td>
                                                <input type="text" id="PsyDocName_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyDocName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DocName']; ?>
" size="50" maxlength="256">
                                            </td>
                                            <td>
                                                <input type="text" id="PsyDocNumber_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyDocNumber_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DocNumber']; ?>
" size="10" maxlength="16">
                                            </td>
                                            <td>
                                                <input type="text" id="PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['DocDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calpsi1_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calpsi1_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calpsi1_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calpsi1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorpsy1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorpsy1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorpsy1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="PsyIssuer_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyIssuer_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Issuer']; ?>
" size="50" maxlength="255">
                                            </td>
                                            <td>
                                                <select id="PsyDocType_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyDocType_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    <option value="">- alege -</option>
                                                    <option value="1" <?php if ($this->_tpl_vars['item']['DocType'] == 1): ?> selected="selected"<?php endif; ?>>Angajare</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['DocType'] == 2): ?> selected="selected"<?php endif; ?>>??colarizare</option>
                                                    <option value="3" <?php if ($this->_tpl_vars['item']['DocType'] == 3): ?> selected="selected"<?php endif; ?>>Control Periodic</option>
                                                    <option value="4" <?php if ($this->_tpl_vars['item']['DocType'] == 4): ?> selected="selected"<?php endif; ?>>Schimbare de func??ie</option>
                                                    <option value="5" <?php if ($this->_tpl_vars['item']['DocType'] == 5): ?> selected="selected"<?php endif; ?>>Sesizare</option>
                                                    <option value="6" <?php if ($this->_tpl_vars['item']['DocType'] == 6): ?> selected="selected"<?php endif; ?>>Contesta??ie</option>
                                                </select>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('PsyDocNumber_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data document')
                                                                                    && document.getElementById('PsyDocName_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('PsyIssuer_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('PsyDocType_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=editpsychological&Id=<?php echo $this->_tpl_vars['key']; ?>
&DocNumber='
                                                                                    + escape(document.getElementById('PsyDocNumber_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocName=' + escape(document.getElementById('PsyDocName_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocDate=' + document.getElementById('PsyDocDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    + '&Issuer=' + escape(document.getElementById('PsyIssuer_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocType=' + escape(document.getElementById('PsyDocType_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Approval=' + escape(document.getElementById('PsyApproval_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Recommendations=' + escape(document.getElementById('PsyRecommendations_<?php echo $this->_tpl_vars['key']; ?>
').value);
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Psihologic"><b>Mod</b></a></div><?php endif; ?>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=delpsychological&Id=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge Aviz Psihologic'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Aviz Psihologic</td>
                                            <td colspan="3">Recomandari</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <textarea id="PsyApproval_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyApproval_<?php echo $this->_tpl_vars['key']; ?>
" rows="4" cols="85"><?php echo $this->_tpl_vars['item']['Approval']; ?>
</textarea>
                                            </td>
                                            <td colspan="3">
                                                <textarea id="PsyRecommendations_<?php echo $this->_tpl_vars['key']; ?>
" name="PsyRecommendations_<?php echo $this->_tpl_vars['key']; ?>
" rows="4" cols="85"><?php echo $this->_tpl_vars['item']['Recommendations']; ?>
</textarea>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="PsyDocName_0" name="PsyDocName_0" size="50" maxlength="256"></td>
                                        <td><input type="text" id="PsyDocNumber_0" name="PsyDocNumber_0" size="10" maxlength="10"></td>
                                        <td>
                                            <input type="text" id="PsyDocDate_0" name="PsyDocDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calpsy1_0 = new CalendarPopup();
                                                calpsy1_0.isShowNavigationDropdowns = true;
                                                calpsy1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calpsy1_0.select(document.getElementById('PsyDocDate_0'),'anchorpsy1_0','dd.MM.yyyy'); return false;" NAME="anchorpsy1_0"
                                               ID="anchorpsy1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="PsyIssuer_0" name="PsyIssuer_0" class="formstyle" value="" size="50" maxlength="255">

                                        </td>
                                        <td>
                                            <select id="PsyDocType_0" name="PsyDocType_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Angajare</option>
                                                <option value="2">??colarizare</option>
                                                <option value="3">Control Periodic</option>
                                                <option value="4">Schimbare de func??ie</option>
                                                <option value="5">Sesizare</option>
                                                <option value="6">Contesta??ie</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="PsyDocType_0" name="PsyDoc_Type_0" value="2" />
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('PsyDocNumber_0').value
                                                                                && document.getElementById('PsyDocName_0').value
                                                                                && document.getElementById('PsyDocDate_0').value
                                                                                && checkDate(document.getElementById('PsyDocDate_0').value, 'Data document')
                                                                                && document.getElementById('PsyIssuer_0').value
                                                                                && document.getElementById('PsyDocType_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=newpsychological&DocType='
                                                                                + escape(document.getElementById('PsyDocType_0').value)
                                                                                + '&DocName=' + escape(document.getElementById('PsyDocName_0').value)
                                                                                + '&DocDate=' + escape(document.getElementById('PsyDocDate_0').value)
                                                                                + '&Issuer=' + document.getElementById('PsyIssuer_0').value
                                                                                + '&DocNumber=' + document.getElementById('PsyDocNumber_0').value
                                                                                + '&Approval=' + document.getElementById('PsyApproval_0').value
                                                                                + '&Recommendations=' + document.getElementById('PsyRecommendations_0').value;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga Aviz Psihologic"><b>Adauga</b></a></div><?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Rezultat Psihologic</td>
                                        <td colspan="3">Recomandari</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <textarea id="PsyApproval_0" name="PsyApproval_0" rows="4" cols="85"></textarea>
                                        </td>
                                        <td colspan="3">
                                        <textarea id="PsyRecommendations_0" name="PsyRecommendations_0" rows="4" cols="85"></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Avize Medicale</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Titlu Document</td></td>
                                        <td>Numar Document</td>
                                        <td>Data Document</td>
                                        <td>Emis de</td>
                                        <td>Tip document</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php if ($this->_tpl_vars['medDocsNew']): ?>
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['medDocsNew']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td>
                                                <input type="text" id="DocName_<?php echo $this->_tpl_vars['key']; ?>
" name="DocName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DocName']; ?>
" size="50" maxlength="256">
                                            </td>
                                            <td>
                                                <input type="text" id="DocNumber_<?php echo $this->_tpl_vars['key']; ?>
" name="DocNumber_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DocNumber']; ?>
" size="10" maxlength="16">
                                            </td>
                                            <td>
                                                <input type="text" id="DocDate_<?php echo $this->_tpl_vars['key']; ?>
" name="DocDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['DocDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
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
.select(document.getElementById('DocDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="Issuer_<?php echo $this->_tpl_vars['key']; ?>
" name="Issuer_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Issuer']; ?>
" size="50" maxlength="255">
                                            </td>
                                            <td>
                                                <select id="DocType_<?php echo $this->_tpl_vars['key']; ?>
" name="DocType_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    <option value="">- alege -</option>
                                                    <option value="1" <?php if ($this->_tpl_vars['item']['DocType'] == 1): ?> selected="selected"<?php endif; ?>>Angajare</option>
                                                    <option value="2" <?php if ($this->_tpl_vars['item']['DocType'] == 2): ?> selected="selected"<?php endif; ?>>??colarizare</option>
                                                    <option value="3" <?php if ($this->_tpl_vars['item']['DocType'] == 3): ?> selected="selected"<?php endif; ?>>Control Periodic</option>
                                                    <option value="4" <?php if ($this->_tpl_vars['item']['DocType'] == 4): ?> selected="selected"<?php endif; ?>>Schimbare de func??ie</option>
                                                    <option value="5" <?php if ($this->_tpl_vars['item']['DocType'] == 5): ?> selected="selected"<?php endif; ?>>Sesizare</option>
                                                    <option value="6" <?php if ($this->_tpl_vars['item']['DocType'] == 6): ?> selected="selected"<?php endif; ?>>Contesta??ie</option>
                                                </select>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DocNumber_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('DocDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('DocDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data document')
                                                                                    && document.getElementById('DocName_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('Issuer_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('DocType_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=editnewmedical&Id=<?php echo $this->_tpl_vars['key']; ?>
&DocNumber='
                                                                                    + escape(document.getElementById('DocNumber_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocName=' + escape(document.getElementById('DocName_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocDate=' + document.getElementById('DocDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    + '&Issuer=' + escape(document.getElementById('Issuer_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DocType=' + escape(document.getElementById('DocType_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Approval=' + escape(document.getElementById('Approval_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Recommendations=' + escape(document.getElementById('Recommendations_<?php echo $this->_tpl_vars['key']; ?>
').value);
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Medical"><b>Mod</b></a></div><?php endif; ?>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=delnewmedical&Id=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge atestat'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">Aviz Medical</td>
                                            <td colspan="3">Recomandari</td>
                                        </tr>
                                        <tr>
                                            <td colspan="3">
                                                <textarea id="Approval_<?php echo $this->_tpl_vars['key']; ?>
" name="Approval_<?php echo $this->_tpl_vars['key']; ?>
" rows="4" cols="85"><?php echo $this->_tpl_vars['item']['Approval']; ?>
</textarea>
                                            </td>
                                            <td colspan="3">
                                                <textarea id="Recommendations_<?php echo $this->_tpl_vars['key']; ?>
" name="Recommendations_<?php echo $this->_tpl_vars['key']; ?>
" rows="4" cols="85"><?php echo $this->_tpl_vars['item']['Recommendations']; ?>
</textarea>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td><input type="text" id="DocName_0" name="DocName_0" size="50" maxlength="256"></td>
                                        <td><input type="text" id="DocNumber_0" name="DocNumber_0" size="10" maxlength="10"></td>
                                        <td>
                                            <input type="text" id="DocDate_0" name="DocDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calmed1_0 = new CalendarPopup();
                                                calmed1_0.isShowNavigationDropdowns = true;
                                                calmed1_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calmed1_0.select(document.getElementById('DocDate_0'),'anchormed1_0','dd.MM.yyyy'); return false;" NAME="anchormed1_0"
                                               ID="anchormed1_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="Issuer_0" name="Issuer_0" class="formstyle" value="" size="50" maxlength="255">

                                        </td>
                                        <td>
                                            <select id="DocType_0" name="DocType_0">
                                                <option value="">- alege -</option>
                                                <option value="1">Angajare</option>
                                                <option value="2">??colarizare</option>
                                                <option value="3">Control Periodic</option>
                                                <option value="4">Schimbare de func??ie</option>
                                                <option value="5">Sesizare</option>
                                                <option value="6">Contesta??ie</option>
                                            </select>
                                        </td>
                                        <td colspan="2">
                                            <input type="hidden" id="DocType_0" name="Doc_Type_0" value="2" />
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DocNumber_0').value
                                                                                && document.getElementById('DocName_0').value
                                                                                && document.getElementById('DocDate_0').value
                                                                                && checkDate(document.getElementById('DocDate_0').value, 'Data document')
                                                                                && document.getElementById('Issuer_0').value
                                                                                && document.getElementById('DocType_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=newmedical&DocType='
                                                                                + escape(document.getElementById('DocType_0').value)
                                                                                + '&DocName=' + escape(document.getElementById('DocName_0').value)
                                                                                + '&DocDate=' + escape(document.getElementById('DocDate_0').value)
                                                                                + '&Issuer=' + document.getElementById('Issuer_0').value
                                                                                + '&DocNumber=' + document.getElementById('DocNumber_0').value
                                                                                + '&Approval=' + document.getElementById('Approval_0').value
                                                                                + '&Recommendations=' + document.getElementById('Recommendations_0').value;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga Aviz Medical"><b>Adauga</b></a></div><?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">Aviz Medical</td>
                                        <td colspan="3">Recomandari</td>
                                    </tr>
                                    <tr>
                                        <td colspan="3">
                                            <textarea id="Approval_0" name="Approval_0" rows="4" cols="85"></textarea>
                                        </td>
                                        <td colspan="3">
                                            <textarea id="Recommendations_0" name="Recommendations_0" rows="4" cols="85"></textarea>
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Certificate de Preg??tire Profesional?? a Conduc??torului Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliber??rii</td></td>
                                        <td>Data expir??rii</td>
                                        <td>Num??r permis conducere</td>
                                        <td>Num??r certificat</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php if ($this->_tpl_vars['cppc']): ?>
                                        <tr>
                                            <td colspan="6" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['cppc']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
" name="ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ReleaseDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calrd_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calrd_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calrd_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrd_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorrd_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrd_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorrd_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
" name="ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ExpirationDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calcped1_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calcped1_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calcped1_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcped1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorcped_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcped_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorcped_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumber_<?php echo $this->_tpl_vars['key']; ?>
" name="DrivingLicenseNumber_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DrivingLicenseNumber']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="CertificateNumber_<?php echo $this->_tpl_vars['key']; ?>
" name="CertificateNumber_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CertificateNumber']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DrivingLicenseNumber_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=editCPPC&Id=<?php echo $this->_tpl_vars['key']; ?>
&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDate_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDate_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumber_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&CertificateNumber=' + escape(document.getElementById('CertificateNumber_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + (document.getElementById('AM_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&AM=1' :'')
                                                                                    + (document.getElementById('A1_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A1=1' :'')
                                                                                    + (document.getElementById('A2_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A2=1' :'')
                                                                                    + (document.getElementById('A_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A=1' :'')
                                                                                    + (document.getElementById('B1_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&B1=1' :'')
                                                                                    + (document.getElementById('B_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&B=1' :'')
                                                                                    + (document.getElementById('BE_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&BE=1' :'')
                                                                                    + (document.getElementById('C1_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C1=1' :'')
                                                                                    + (document.getElementById('C1E_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C1E=1' :'')
                                                                                    + (document.getElementById('C_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C=1' :'')
                                                                                    + (document.getElementById('CE_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&CE=1' :'')
                                                                                    + (document.getElementById('D1_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D1=1' :'')
                                                                                    + (document.getElementById('D1E_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D1E=1' :'')
                                                                                    + (document.getElementById('D_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D=1' :'')
                                                                                    + (document.getElementById('DE_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&DE=1' :'')
                                                                                    + (document.getElementById('Tr_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tr=1' :'')
                                                                                    + (document.getElementById('Tb_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tb=1' :'')
                                                                                    + (document.getElementById('Tv_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tv=1' :'')
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Aviz Medical"><b>Mod</b></a></div><?php endif; ?>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=delCPPC&Id=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge Certificat'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Categorii de vehicule</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">

                                                <input type="checkbox" id="AM_<?php echo $this->_tpl_vars['key']; ?>
" name="AM_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['AM'] == 1 )): ?> checked <?php endif; ?> />
                                                AM&nbsp;&nbsp;
                                                <input type="checkbox" id="A1_<?php echo $this->_tpl_vars['key']; ?>
" name="A1_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A1'] == 1 )): ?> checked <?php endif; ?>/>
                                                A1
                                                <input type="checkbox" id="A2_<?php echo $this->_tpl_vars['key']; ?>
" name="A2_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A2'] == 1 )): ?> checked <?php endif; ?>/>
                                                A2
                                                <input type="checkbox" id="A_<?php echo $this->_tpl_vars['key']; ?>
" name="A_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A'] == 1 )): ?> checked <?php endif; ?> />
                                                A
                                                <input type="checkbox" id="B1_<?php echo $this->_tpl_vars['key']; ?>
" name="B1_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['B1'] == 1 )): ?> checked <?php endif; ?> />
                                                B1
                                                <input type="checkbox" id="B_<?php echo $this->_tpl_vars['key']; ?>
" name="B_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['B'] == 1 )): ?> checked <?php endif; ?> />
                                                B
                                                <input type="checkbox" id="BE_<?php echo $this->_tpl_vars['key']; ?>
" name="BE_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['BE'] == 1 )): ?> checked <?php endif; ?> />
                                                BE
                                                <input type="checkbox" id="C1_<?php echo $this->_tpl_vars['key']; ?>
" name="C1_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C1'] == 1 )): ?> checked <?php endif; ?> />
                                                C1
                                                <input type="checkbox" id="C1E_<?php echo $this->_tpl_vars['key']; ?>
" name="C1E_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C1E'] == 1 )): ?> checked <?php endif; ?> />
                                                C1E
                                                <input type="checkbox" id="C_<?php echo $this->_tpl_vars['key']; ?>
" name="C_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C'] == 1 )): ?> checked <?php endif; ?> />
                                                C
                                                <input type="checkbox" id="CE_<?php echo $this->_tpl_vars['key']; ?>
" name="CE_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['CE'] == 1 )): ?> checked <?php endif; ?> />
                                                CE
                                                <input type="checkbox" id="D1_<?php echo $this->_tpl_vars['key']; ?>
" name="D1_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D1'] == 1 )): ?> checked <?php endif; ?> />
                                                D1
                                                <input type="checkbox" id="D1E_<?php echo $this->_tpl_vars['key']; ?>
" name="D1E_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D1E'] == 1 )): ?> checked <?php endif; ?> />
                                                D1E
                                                <input type="checkbox" id="D_<?php echo $this->_tpl_vars['key']; ?>
" name="D_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D'] == 1 )): ?> checked <?php endif; ?> />
                                                D
                                                <input type="checkbox" id="DE_<?php echo $this->_tpl_vars['key']; ?>
" name="DE_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['DE'] == 1 )): ?> checked <?php endif; ?> />
                                                DE
                                                <input type="checkbox" id="Tr_<?php echo $this->_tpl_vars['key']; ?>
" name="Tr_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tr'] == 1 )): ?> checked <?php endif; ?> />
                                                Tr
                                                <input type="checkbox" id="Tb_<?php echo $this->_tpl_vars['key']; ?>
" name="Tb_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tb'] == 1 )): ?> checked <?php endif; ?> />
                                                Tb
                                                <input type="checkbox" id="Tv_<?php echo $this->_tpl_vars['key']; ?>
" name="Tv_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tv'] == 1 )): ?> checked <?php endif; ?> />
                                                Tv
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td colspan="5" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDate_0" name="ReleaseDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRD_0 = new CalendarPopup();
                                                calRD_0.isShowNavigationDropdowns = true;
                                                calRD_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRD_0.select(document.getElementById('ReleaseDate_0'),'anchorRD_0','dd.MM.yyyy'); return false;" NAME="anchorRD_0"
                                               ID="anchorRD_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDate_0" name="ExpirationDate_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calED_0 = new CalendarPopup();
                                                calED_0.isShowNavigationDropdowns = true;
                                                calED_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calED_0.select(document.getElementById('ExpirationDate_0'),'anchorED_0','dd.MM.yyyy'); return false;" NAME="anchorED_0"
                                               ID="anchorED_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumber_0" name="DrivingLicenseNumber_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="CertificateNumber_0" name="CertificateNumber_0" size="20" maxlength="20"></td>
                                        <td colspan="2">
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumber_0').value
                                                                                && document.getElementById('ReleaseDate_0').value
                                                                                && checkDate(document.getElementById('ReleaseDate_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDate_0').value
                                                                                && checkDate(document.getElementById('ExpirationDate_0').value, 'Data Expirare'))
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=newCPPC&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumber_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDate_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDate_0').value)
                                                                                + '&CertificateNumber=' + document.getElementById('CertificateNumber_0').value
                                                                                + (document.getElementById('AM_0').checked ? '+&AM=1' :'')
                                                                                + (document.getElementById('A1_0').checked ? '+&A1=1' :'')
                                                                                + (document.getElementById('A2_0').checked ? '+&A2=1' :'')
                                                                                + (document.getElementById('A_0').checked ? '+&A=1' :'')
                                                                                + (document.getElementById('B1_0').checked ? '+&B1=1' :'')
                                                                                + (document.getElementById('B_0').checked ? '+&B=1' :'')
                                                                                + (document.getElementById('BE_0').checked ? '+&BE=1' :'')
                                                                                + (document.getElementById('C1_0').checked ? '+&C1=1' :'')
                                                                                + (document.getElementById('C1E_0').checked ? '+&C1E=1' :'')
                                                                                + (document.getElementById('C_0').checked ? '+&C=1' :'')
                                                                                + (document.getElementById('CE_0').checked ? '+&CE=1' :'')
                                                                                + (document.getElementById('D1_0').checked ? '+&D1=1' :'')
                                                                                + (document.getElementById('D1E_0').checked ? '+&D1E=1' :'')
                                                                                + (document.getElementById('D_0').checked ? '+&D=1' :'')
                                                                                + (document.getElementById('DE_0').checked ? '+&DE=1' :'')
                                                                                + (document.getElementById('Tr_0').checked ? '+&Tr=1' :'')
                                                                                + (document.getElementById('Tb_0').checked ? '+&Tb=1' :'')
                                                                                + (document.getElementById('Tv_0').checked ? '+&Tv=1' :'')
                                                                                ;
                                                                                else alert('Completati Titlul, Data, Emitentul, Numarul Documentului si Tipul de document'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div><?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Categorii de vehicule</td>
                                    </tr>
                                    <tr>

                                        <td colspan="6">

                                            <input type="checkbox" id="AM_0" name="AM_0" value="0" />
                                            AM&nbsp;&nbsp;
                                            <input type="checkbox" id="A1_0" name="A1_0" value="0"/>
                                            A1
                                            <input type="checkbox" id="A2_0" name="A2_0" value="0"/>
                                            A2
                                            <input type="checkbox" id="A_0" name="A_0" value="0" />
                                            A
                                            <input type="checkbox" id="B1_0" name="B1_0" value="0" />
                                            B1
                                            <input type="checkbox" id="B_0" name="B_0" value="0" />
                                            B
                                            <input type="checkbox" id="BE_0" name="BE_0" value="0" />
                                            BE
                                            <input type="checkbox" id="C1_0" name="C1_0" value="0" />
                                            C1
                                            <input type="checkbox" id="C1E_0" name="C1E_0" value="0" />
                                            C1E
                                            <input type="checkbox" id="C_0" name="C_0" value="0" />
                                            C
                                            <input type="checkbox" id="CE_0" name="CE_0" value="0" />
                                            CE
                                            <input type="checkbox" id="D1_0" name="D1_0" value="0" />
                                            D1
                                            <input type="checkbox" id="D1E_0" name="D1E_0" value="0" />
                                            D1E
                                            <input type="checkbox" id="D_0" name="D_0" value="0" />
                                            D
                                            <input type="checkbox" id="DE_0" name="DE_0" value="0" />
                                            DE
                                            <input type="checkbox" id="Tr_0" name="Tr_0" value="0" />
                                            Tr
                                            <input type="checkbox" id="Tb_0" name="Tb_0" value="0" />
                                            Tb
                                            <input type="checkbox" id="Tv_0" name="Tv_0" value="0" />
                                            Tv
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Cartela Conduc??torului Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliber??rii</td></td>
                                        <td>Data expir??rii</td>
                                        <td>Num??r permis conducere</td>
                                        <td>Num??r certificat</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php if ($this->_tpl_vars['dl']): ?>
                                        <tr>
                                            <td colspan="6" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['cca']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
" name="ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ReleaseDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calrdcca_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calrdcca_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calrdcca_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrdcca_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorrdcca_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrdcca_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorrdcca_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
" name="ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ExpirationDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calcpedcca_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calcpedcca_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calcpedcca_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcpedcca_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorcpedcca_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcpedcca_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorcpedcca_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
" name="DrivingLicenseNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DrivingLicenseNumber']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="DriverCardNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
" name="DriverCardNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CardNumber']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DriverCardNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=editCCA&Id=<?php echo $this->_tpl_vars['key']; ?>
&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateCCA_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&CardNumber=' + escape(document.getElementById('DriverCardNumberCCA_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Cartela Conducator Auto"><b>Mod</b></a></div><?php endif; ?>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=delCCA&Id=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge Certificat'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>

                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td colspan="5" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDateCCA_0" name="ReleaseDateCCA_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRDCCA_0 = new CalendarPopup();
                                                calRDCCA_0.isShowNavigationDropdowns = true;
                                                calRDCCA_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRDCCA_0.select(document.getElementById('ReleaseDateCCA_0'),'anchorRDCCA_0','dd.MM.yyyy'); return false;" NAME="anchorRDCCA_0"
                                               ID="anchorRDCCA_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDateCCA_0" name="ExpirationDateCCA_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calEDCCA_0 = new CalendarPopup();
                                                calEDCCA_0.isShowNavigationDropdowns = true;
                                                calEDCCA_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calEDCCA_0.select(document.getElementById('ExpirationDateCCA_0'),'anchorEDCCA_0','dd.MM.yyyy'); return false;" NAME="anchorEDCCA_0"
                                               ID="anchorEDCCA_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumberCCA_0" name="DrivingLicenseNumberCCA_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="DriverCardNumberCCA_0" name="DriverCardNumberCCA_0" size="20" maxlength="20"></td>
                                        <td colspan="2">
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumberCCA_0').value
                                                                                && document.getElementById('ReleaseDateCCA_0').value
                                                                                && checkDate(document.getElementById('ReleaseDateCCA_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDateCCA_0').value
                                                                                && checkDate(document.getElementById('ExpirationDateCCA_0').value, 'Data Expirare'))
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=newCCA&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumberCCA_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDateCCA_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateCCA_0').value)
                                                                                + '&CardNumber=' + document.getElementById('DriverCardNumberCCA_0').value
                                                                                ;
                                                                                else alert('Completati Data Emiterii, Data Expirarii, Numar permis auto'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div><?php endif; ?>

                                        </td>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>

                    
                    <tr>
                        <td colspan="2">
                            <fieldset>
                                <legend>Permise Auto</legend>
                                <table cellspacing="0" cellpadding="4">
                                    <tr>
                                        <td>Data Eliber??rii</td></td>
                                        <td>Data expir??rii</td>
                                        <td>Num??r permis conducere</td>
                                        <td>Emitent</td>
                                        <td>Restrictii</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php if ($this->_tpl_vars['dl']): ?>
                                        <tr>
                                            <td colspan="7" style="color: white; background-color: grey; padding: 5px; font-size: 12px">Sectiune date curente</td>
                                        </tr>
                                    <?php endif; ?>
                                    <?php $_from = $this->_tpl_vars['dl']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>

                                        <tr>
                                            <td>
                                                <input type="text" id="ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
" name="ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ReleaseDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calrdDL_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calrdDL_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calrdDL_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calrdDL_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorrdDL_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorrdDL_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorrdDL_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
" name="ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ExpirationDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle"
                                                       value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                    var calcpedDL_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                    calcpedDL_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                    calcpedDL_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#" onClick="calcpedDL_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
'),'anchorcpedDL_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorcpedDL_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchorcpedDL_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="DrivingLicenseNumberDL_<?php echo $this->_tpl_vars['key']; ?>
" name="DrivingLicenseNumberDL_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['DrivingLicenseNumber']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="IssuerDL_<?php echo $this->_tpl_vars['key']; ?>
" name="IssuerDL_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Issuer']; ?>
" size="20" maxlength="20">
                                            </td>
                                            <td>
                                                <input type="text" id="RestrictionsDL_<?php echo $this->_tpl_vars['key']; ?>
" name="RestrictionsDL_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Restrictions']; ?>
" size="50" maxlength="50">
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('DrivingLicenseNumberDL_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('IssuerDL_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && document.getElementById('ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Eliberare')
                                                                                    && document.getElementById('ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    && checkDate(document.getElementById('ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data Expirare'))
                                                                                    window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=editDL&Id=<?php echo $this->_tpl_vars['key']; ?>
&ReleaseDate='
                                                                                    + document.getElementById('ReleaseDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value
                                                                                    + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateDL_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&DrivingLicenseNumber=' + escape(document.getElementById('DrivingLicenseNumberDL_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Issuer=' + escape(document.getElementById('IssuerDL_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + '&Restrictions=' + escape(document.getElementById('RestrictionsDL_<?php echo $this->_tpl_vars['key']; ?>
').value)
                                                                                    + (document.getElementById('AMDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&AM=1' :'')
                                                                                    + (document.getElementById('A1DL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A1=1' :'')
                                                                                    + (document.getElementById('A2DL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A2=1' :'')
                                                                                    + (document.getElementById('ADL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&A=1' :'')
                                                                                    + (document.getElementById('B1DL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&B1=1' :'')
                                                                                    + (document.getElementById('BDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&B=1' :'')
                                                                                    + (document.getElementById('BEDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&BE=1' :'')
                                                                                    + (document.getElementById('C1DL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C1=1' :'')
                                                                                    + (document.getElementById('C1EDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C1E=1' :'')
                                                                                    + (document.getElementById('CDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&C=1' :'')
                                                                                    + (document.getElementById('CEDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&CE=1' :'')
                                                                                    + (document.getElementById('D1DL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D1=1' :'')
                                                                                    + (document.getElementById('D1EDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D1E=1' :'')
                                                                                    + (document.getElementById('DDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&D=1' :'')
                                                                                    + (document.getElementById('DEDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&DE=1' :'')
                                                                                    + (document.getElementById('TrDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tr=1' :'')
                                                                                    + (document.getElementById('TbDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tb=1' :'')
                                                                                    + (document.getElementById('TvDL_<?php echo $this->_tpl_vars['key']; ?>
').checked ? '+&Tv=1' :'')
                                                                                    ;
                                                                                    else alert('Va rugam sa completati toate informatiile'); return false;"
                                                                            title="Modifica Permis de Conducere"><b>Mod</b></a></div><?php endif; ?>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=delDL&Id=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge Permis de Conducere'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">Categorii de vehicule</td>
                                        </tr>
                                        <tr>
                                            <td colspan="6">

                                                <input type="checkbox" id="AMDL_<?php echo $this->_tpl_vars['key']; ?>
" name="AMDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['AM'] == 1 )): ?> checked <?php endif; ?> />
                                                AM&nbsp;&nbsp;
                                                <input type="checkbox" id="A1DL_<?php echo $this->_tpl_vars['key']; ?>
" name="A1DL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A1'] == 1 )): ?> checked <?php endif; ?>/>
                                                A1
                                                <input type="checkbox" id="A2DL_<?php echo $this->_tpl_vars['key']; ?>
" name="A2DL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A2'] == 1 )): ?> checked <?php endif; ?>/>
                                                A2
                                                <input type="checkbox" id="ADL_<?php echo $this->_tpl_vars['key']; ?>
" name="ADL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['A'] == 1 )): ?> checked <?php endif; ?> />
                                                A
                                                <input type="checkbox" id="B1DL_<?php echo $this->_tpl_vars['key']; ?>
" name="B1DL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['B1'] == 1 )): ?> checked <?php endif; ?> />
                                                B1
                                                <input type="checkbox" id="BDL_<?php echo $this->_tpl_vars['key']; ?>
" name="BDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['B'] == 1 )): ?> checked <?php endif; ?> />
                                                B
                                                <input type="checkbox" id="BEDL_<?php echo $this->_tpl_vars['key']; ?>
" name="BEDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['BE'] == 1 )): ?> checked <?php endif; ?> />
                                                BE
                                                <input type="checkbox" id="C1DL_<?php echo $this->_tpl_vars['key']; ?>
" name="C1DL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C1'] == 1 )): ?> checked <?php endif; ?> />
                                                C1
                                                <input type="checkbox" id="C1EDL_<?php echo $this->_tpl_vars['key']; ?>
" name="C1EDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C1E'] == 1 )): ?> checked <?php endif; ?> />
                                                C1E
                                                <input type="checkbox" id="CDL_<?php echo $this->_tpl_vars['key']; ?>
" name="CDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['C'] == 1 )): ?> checked <?php endif; ?> />
                                                C
                                                <input type="checkbox" id="CEDL_<?php echo $this->_tpl_vars['key']; ?>
" name="CEDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['CE'] == 1 )): ?> checked <?php endif; ?> />
                                                CE
                                                <input type="checkbox" id="D1DL_<?php echo $this->_tpl_vars['key']; ?>
" name="D1DL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D1'] == 1 )): ?> checked <?php endif; ?> />
                                                D1
                                                <input type="checkbox" id="D1EDL_<?php echo $this->_tpl_vars['key']; ?>
" name="D1EDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D1E'] == 1 )): ?> checked <?php endif; ?> />
                                                D1E
                                                <input type="checkbox" id="DDL_<?php echo $this->_tpl_vars['key']; ?>
" name="DDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['D'] == 1 )): ?> checked <?php endif; ?> />
                                                D
                                                <input type="checkbox" id="DEDL_<?php echo $this->_tpl_vars['key']; ?>
" name="DEDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['DE'] == 1 )): ?> checked <?php endif; ?> />
                                                DE
                                                <input type="checkbox" id="TrDL_<?php echo $this->_tpl_vars['key']; ?>
" name="TrDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tr'] == 1 )): ?> checked <?php endif; ?> />
                                                Tr
                                                <input type="checkbox" id="TbDL_<?php echo $this->_tpl_vars['key']; ?>
" name="TbDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tb'] == 1 )): ?> checked <?php endif; ?> />
                                                Tb
                                                <input type="checkbox" id="TvDL_<?php echo $this->_tpl_vars['key']; ?>
" name="TvDL_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if (( $this->_tpl_vars['item']['Tv'] == 1 )): ?> checked <?php endif; ?> />
                                                Tv
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td colspan="6" style="color: white; background-color: green; padding: 5px; font-size: 12px">Sectiune adaugare Inregistrare noua</td>
                                    </tr>
                                    <tr>
                                        <td>
                                            <input type="text" id="ReleaseDateDL_0" name="ReleaseDateDL_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calRDDL_0 = new CalendarPopup();
                                                calRDDL_0.isShowNavigationDropdowns = true;
                                                calRDDL_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calRDDL_0.select(document.getElementById('ReleaseDateDL_0'),'anchorRDDL_0','dd.MM.yyyy'); return false;" NAME="anchorRDDL_0"
                                               ID="anchorRDDL_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td>
                                            <input type="text" id="ExpirationDateDL_0" name="ExpirationDateDL_0" class="formstyle" value="" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                var calEDDL_0 = new CalendarPopup();
                                                calEDDL_0.isShowNavigationDropdowns = true;
                                                calEDDL_0.setYearSelectStartOffset(10);
                                                //writeSource("js1_0");
                                            </SCRIPT>
                                            <A HREF="#" onClick="calEDDL_0.select(document.getElementById('ExpirationDateDL_0'),'anchorEDDL_0','dd.MM.yyyy'); return false;" NAME="anchorEDDL_0"
                                               ID="anchorEDDL_0"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A>
                                        </td>
                                        <td><input type="text" id="DrivingLicenseNumberDL_0" name="DrivingLicenseNumberDL_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="IssuerDL_0" name="IssuerDL_0" size="20" maxlength="20"></td>
                                        <td><input type="text" id="RestrictionsDL_0" name="RestrictionsDL_0" size="50" maxlength="50"></td>
                                        <td colspan="2">
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('DrivingLicenseNumberDL_0').value
                                                                                && document.getElementById('ReleaseDateDL_0').value
                                                                                && checkDate(document.getElementById('ReleaseDateDL_0').value, 'Data Eliberare')
                                                                                && document.getElementById('ExpirationDateDL_0').value
                                                                                && checkDate(document.getElementById('ExpirationDateDL_0').value, 'Data Expirare')
                                                                                && document.getElementById('IssuerDL_0').value)
                                                                                window.location.href = './?m=persons&o=editprof&PersonID=<?php echo $_GET['PersonID']; ?>
&action=newDL&DrivingLicenseNumber='
                                                                                + escape(document.getElementById('DrivingLicenseNumberDL_0').value)
                                                                                + '&ReleaseDate=' + escape(document.getElementById('ReleaseDateDL_0').value)
                                                                                + '&ExpirationDate=' + escape(document.getElementById('ExpirationDateDL_0').value)
                                                                                + '&Issuer=' + document.getElementById('IssuerDL_0').value
                                                                                + '&Restrictions=' + document.getElementById('RestrictionsDL_0').value
                                                                                + (document.getElementById('AMDL_0').checked ? '+&AM=1' :'')
                                                                                + (document.getElementById('A1DL_0').checked ? '+&A1=1' :'')
                                                                                + (document.getElementById('A2DL_0').checked ? '+&A2=1' :'')
                                                                                + (document.getElementById('ADL_0').checked ? '+&A=1' :'')
                                                                                + (document.getElementById('B1DL_0').checked ? '+&B1=1' :'')
                                                                                + (document.getElementById('BDL_0').checked ? '+&B=1' :'')
                                                                                + (document.getElementById('BEDL_0').checked ? '+&BE=1' :'')
                                                                                + (document.getElementById('C1DL_0').checked ? '+&C1=1' :'')
                                                                                + (document.getElementById('C1EDL_0').checked ? '+&C1E=1' :'')
                                                                                + (document.getElementById('CDL_0').checked ? '+&C=1' :'')
                                                                                + (document.getElementById('CEDL_0').checked ? '+&CE=1' :'')
                                                                                + (document.getElementById('D1DL_0').checked ? '+&D1=1' :'')
                                                                                + (document.getElementById('D1EDL_0').checked ? '+&D1E=1' :'')
                                                                                + (document.getElementById('DDL_0').checked ? '+&D=1' :'')
                                                                                + (document.getElementById('DEDL_0').checked ? '+&DE=1' :'')
                                                                                + (document.getElementById('TrDL_0').checked ? '+&Tr=1' :'')
                                                                                + (document.getElementById('TbDL_0').checked ? '+&Tb=1' :'')
                                                                                + (document.getElementById('TvDL_0').checked ? '+&Tv=1' :'')
                                                                                ;
                                                                                else alert('Completati T Data Emitere, Data Expirare, Emitentul, Numarul Permisului de conducere'); return false;"
                                                                        title="Adauga CPPC"><b>Adauga</b></a></div><?php endif; ?>

                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="6">Categorii de vehicule</td>
                                    </tr>
                                    <tr>

                                        <td colspan="6">

                                            <input type="checkbox" id="AMDL_0" name="AMDL_0" value="0" />
                                            AM&nbsp;&nbsp;
                                            <input type="checkbox" id="A1DL_0" name="A1DL_0" value="0"/>
                                            A1
                                            <input type="checkbox" id="A2DL_0" name="A2DL_0" value="0"/>
                                            A2
                                            <input type="checkbox" id="ADL_0" name="ADL_0" value="0" />
                                            A
                                            <input type="checkbox" id="B1DL_0" name="B1_0" value="0" />
                                            B1
                                            <input type="checkbox" id="BDL_0" name="BDL_0" value="0" />
                                            B
                                            <input type="checkbox" id="BEDL_0" name="BEDL_0" value="0" />
                                            BE
                                            <input type="checkbox" id="C1DL_0" name="C1DL_0" value="0" />
                                            C1
                                            <input type="checkbox" id="C1EDL_0" name="C1EDL_0" value="0" />
                                            C1E
                                            <input type="checkbox" id="CDL_0" name="CDL_0" value="0" />
                                            C
                                            <input type="checkbox" id="CEDL_0" name="CEDL_0" value="0" />
                                            CE
                                            <input type="checkbox" id="D1DL_0" name="D1DL_0" value="0" />
                                            D1
                                            <input type="checkbox" id="D1EDL_0" name="D1EDL_0" value="0" />
                                            D1E
                                            <input type="checkbox" id="DDL_0" name="DDL_0" value="0" />
                                            D
                                            <input type="checkbox" id="DEDL_0" name="DEDL_0" value="0" />
                                            DE
                                            <input type="checkbox" id="TrDL_0" name="TrDL_0" value="0" />
                                            Tr
                                            <input type="checkbox" id="TbDL_0" name="TbDL_0" value="0" />
                                            Tb
                                            <input type="checkbox" id="TvDL_0" name="TvDL_0" value="0" />
                                            Tv
                                        </td>
                                    </tr>

                                </table>
                            </fieldset>
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


<?php echo '
<script type="text/javascript">
    function validateForm(f) {
        if (!is_empty(f.WorkTimeAt.value)) {
            return checkDate(f.WorkTimeAt.value, \''; ?>
<?php echo smarty_function_translate(array('label' => 'Vechime totala la data'), $this);?>
<?php echo '\');
        }
        if (!is_empty(f.DrivingStartDate.value)) {
            return checkDate(f.DrivingStartDate.value, \''; ?>
<?php echo smarty_function_translate(array('label' => 'Data emitere permis'), $this);?>
<?php echo '\');
        }
        if (!is_empty(f.DrivingStopDate.value)) {
            return checkDate(f.DrivingStopDate.value, \''; ?>
<?php echo smarty_function_translate(array('label' => 'Data expirare permis'), $this);?>
<?php echo '\');
        }
        return true;
    }
</script>

'; ?>

