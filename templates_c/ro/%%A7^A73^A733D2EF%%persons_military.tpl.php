<?php /* Smarty version 2.6.18, created on 2020-12-02 01:05:09
         compiled from persons_military.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_military.tpl', 18, false),array('modifier', 'date_format', 'persons_military.tpl', 39, false),array('modifier', 'default', 'persons_military.tpl', 80, false),)), $this); ?>
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
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
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
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 550px;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="pers" onsubmit="return validateForm(this);">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Stagiu militar'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="120"><b><?php echo smarty_function_translate(array('label' => 'Satisfacut'), $this);?>
:</b></td>
                            <td>
                                <input type="radio" name="MilStatus" value="Y" <?php if ($this->_tpl_vars['info']['MilStatus'] == 'Y'): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Da'), $this);?>

                                <input type="radio" name="MilStatus" value="N" <?php if ($this->_tpl_vars['info']['MilStatus'] == 'N'): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => 'Nu'), $this);?>

                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
:</b></td>
                            <td nowrap='nowrap'>
                                <input type="text" name="StartDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['StartDate'] ) && $this->_tpl_vars['info']['StartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.StartDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
:</b></td>
                            <td nowrap='nowrap'>
                                <input type="text" name="StopDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['StopDate'] ) && $this->_tpl_vars['info']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2.select(document.pers.StopDate,'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.StopDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Stare militara'), $this);?>
:</b></td>
                            <td>
                                <select name="Type">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => ' '), $this);?>
alege...</option>
                                    <option value="1" <?php if ($this->_tpl_vars['info']['Type'] == 1): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'apt combatant'), $this);?>
</option>
                                    <option value="2" <?php if ($this->_tpl_vars['info']['Type'] == 2): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'apt necombatant'), $this);?>
</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Pozitie'), $this);?>
:</b></td>
                            <td><input type="text" name="Position" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Position'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Livret militar'), $this);?>
:</b></td>
                            <td><input type="text" name="Livret" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Livret'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Grad'), $this);?>
:</b></td>
                            <td><input type="text" name="Grad" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Grad'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Arma'), $this);?>
:</b></td>
                            <td><input type="text" name="Arm" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Arm'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="40" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
:</b></td>
                            <td><textarea name="Notes" rows="5" cols="31"><?php echo $this->_tpl_vars['info']['Notes']; ?>
</textarea></td>
                        </tr>
                        <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"> <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                        onclick="window.location='./?m=persons'" class="formstyle">
                                </td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
            </form>
        </td>
        <td class="celulaMenuDR" style="vertical-align: top; padding-right: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Permis de port arma'), $this);?>
</legend>
                <table cellspacing="0" cellpadding="4">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Emitent'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Serie'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Numar'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <?php $_from = $this->_tpl_vars['permis']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <tr>
                            <td><input type="text" id="Emitent_<?php echo $this->_tpl_vars['key']; ?>
" name="Emitent_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Emitent']; ?>
" size="20" maxlength="128"></td>
                            <td><input type="text" id="Serie_<?php echo $this->_tpl_vars['key']; ?>
" name="Serie_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Serie']; ?>
" size="10" maxlength="16"></td>
                            <td><input type="text" id="No_<?php echo $this->_tpl_vars['key']; ?>
" name="No_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['No']; ?>
" size="10" maxlength="16"></td>
                            <td nowrap='nowrap'>
                                <input type="text" id="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value=""
                                       size="10" maxlength="10">
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
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                   NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap='nowrap'>
                                <input type="text" id="StopDate_<?php echo $this->_tpl_vars['key']; ?>
" name="StopDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value="" size="10"
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
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                   NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_mod"><a href="#"
                                                            onclick="if (document.getElementById('Emitent_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('Serie_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('No_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput') && document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data sfarsit')) window.location.href = './?m=persons&o=military&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&PermisID=<?php echo $this->_tpl_vars['key']; ?>
&Emitent=' + escape(document.getElementById('Emitent_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Serie=' + escape(document.getElementById('Serie_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&No=' + escape(document.getElementById('No_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica permis'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_del"><a href="#"
                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=military&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&PermisID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge permis'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                        </tr>
                    <?php endforeach; endif; unset($_from); ?>
                    <tr>
                        <td><input type="text" id="Emitent_0" name="Emitent_0" size="20" maxlength="128"></td>
                        <td><input type="text" id="Serie_0" name="Serie_0" size="10" maxlength="16"></td>
                        <td><input type="text" id="No_0" name="No_0" size="10" maxlength="16"></td>
                        <td nowrap='nowrap'>
                            <input type="text" id="StartDate_0" name="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                var cal1_0 = new CalendarPopup();
                                cal1_0.isShowNavigationDropdowns = true;
                                cal1_0.setYearSelectStartOffset(10);
                                //writeSource("js1_0");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td nowrap='nowrap'>
                            <input type="text" id="StopDate_0" name="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                var cal2_0 = new CalendarPopup();
                                cal2_0.isShowNavigationDropdowns = true;
                                cal2_0.setYearSelectStartOffset(10);
                                //writeSource("js2_0");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0" ID="anchor2_0"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td colspan="2"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('Emitent_0').value && document.getElementById('Serie_0').value && document.getElementById('No_0').value && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, 'Data inceput') && document.getElementById('StopDate_0').value && checkDate(document.getElementById('StopDate_0').value, 'Data sfarsit')) window.location.href = './?m=persons&o=military&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new&Emitent=' + escape(document.getElementById('Emitent_0').value) + '&Serie=' + escape(document.getElementById('Serie_0').value) + '&No=' + escape(document.getElementById('No_0').value) + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Completati Emitent, Serie, Numar, Data de inceput, Data de sfarsit!'), $this);?>
'); return false;"
                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga permis'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
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
            if (!is_empty(f.StartDate.value)) {
                return checkDate(f.StartDate.value, \'Data inceput\');
            }
            if (!is_empty(f.StopDate.value)) {
                return checkDate(f.StopDate.value, \'Data sfarsit\');
            }
            return true;
        }
    </script>
'; ?>

