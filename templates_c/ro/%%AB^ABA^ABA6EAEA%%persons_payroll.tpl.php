<?php /* Smarty version 2.6.18, created on 2021-06-07 07:34:37
         compiled from persons_payroll.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_payroll.tpl', 6, false),array('modifier', 'default', 'persons_payroll.tpl', 78, false),array('modifier', 'escape', 'persons_payroll.tpl', 250, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="layer_co" style="display: none;">
    <div class="eticheta">
        <?php echo $this->_tpl_vars['eticheta']; ?>

    </div>
    <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</h3>
    <div class="observatiiTextbox">
        <textarea id="layer_co_notes"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value=""/>

    </div>

    <div class="saveObservatii" style="margin-top: 4px">
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" onclick="setNotes();">
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<!---->
<div id="layer_co_x" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
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
        <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == ""): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br/>
                <!-- Salariu -->
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Salariu'), $this);?>
</legend>
                    <?php if (! empty ( $this->_tpl_vars['salary'] )): ?>
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_salary').style.display; if (status == 'none') Effect.SlideDown('div_salary'); else Effect.SlideUp('div_salary'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>

                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td width="110px"><?php echo smarty_function_translate(array('label' => 'Salariu de baza'), $this);?>
</td>
                            <td width="70px"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                            <td width="120px"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                            <td width="120px"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                            <td width="20">&nbsp;</td>
                            <td width="20">&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="Salary_0" size="10"></td>
                            <td><select id="Currency_0" name="Currency_0">
                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="StartDate_0" class="formstyle" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ls_startdate'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.getElementById('Salary_0').value) && !is_empty(document.getElementById('StartDate_0').value) && checkDate(document.getElementById('StartDate_0').value, 'Data inceput')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary&Salary=' + document.getElementById('Salary_0').value +'&Currency=' + document.getElementById('Currency_0').value +'&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre salariu!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga salariu'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>

                    <?php if (! empty ( $this->_tpl_vars['salary'] )): ?>
                        <div id="div_salary" style="display:none; width:758px; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                <?php $_from = $this->_tpl_vars['salary']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <?php $this->assign('ls_startdate', $this->_tpl_vars['item']['StopDate']); ?>
                                    <tr>
                                        <td width="110px"><input type="text" id="Salary_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>

                                        <td width="70px"><select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="Currency">
                                                <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                            <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </td>
                                        <td width="120px">
                                            <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td width="120px">
                                            <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StopDate']; ?>
" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                            <td width="20">
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('Salary_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data inceput')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('Salary_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre salariu!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica salariu'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td width="20">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge salariu'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php else: ?>
                                            <td colspan="2">&nbsp;</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </fieldset>
                <br>
                <!-- Bonusuri -->
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Bonusuri'), $this);?>
</legend>
                    <?php if (! empty ( $this->_tpl_vars['bonus'] )): ?>
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_bonus').style.display; if (status == 'none') Effect.SlideDown('div_bonus'); else Effect.SlideUp('div_bonus'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                        <tr>
                            <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus net'), $this);?>
</td>
                            <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus brut'), $this);?>
</td>
                            <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                            <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                            <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><input type="text" id="SalaryNetB_0" size="10"></td>
                            <td><input type="text" id="SalaryB_0" size="10"></td>
                            <td><select id="CurrencyB_0" name="CurrencyB_0">
                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td>
                                <input type="text" id="StartDateB_0" class="formstyle" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js5_0">
                                    var cal5_0 = new CalendarPopup();
                                    cal5_0.isShowNavigationDropdowns = true;
                                    cal5_0.setYearSelectStartOffset(10);
                                    //writeSource("js5_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal5_0.select(document.getElementById('StartDateB_0'),'anchor5_0','dd.MM.yyyy'); return false;" NAME="anchor5_0"
                                   ID="anchor5_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="hidden" id="NotesB_0" value=""/>
                                <span id="NotesB_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('NotesB_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                            </td>
                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (!is_empty(document.getElementById('SalaryB_0').value) && !is_empty(document.getElementById('SalaryNetB_0').value) && !is_empty(document.getElementById('StartDateB_0').value) && checkDate(document.getElementById('StartDateB_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=bonus&Salary=' + document.getElementById('SalaryB_0').value + '&SalaryNet=' + document.getElementById('SalaryNetB_0').value + '&Currency=' + document.getElementById('CurrencyB_0').value +'&StartDate=' + document.getElementById('StartDateB_0').value + '&Notes=' + escape(document.getElementById('NotesB_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga bonus'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>

                    <?php if (! empty ( $this->_tpl_vars['bonus'] )): ?>
                        <div id="div_bonus" style="display:none; width:700px; background:#ccc; text-align:center;">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" style="width:700px;">
                                <?php $_from = $this->_tpl_vars['bonus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td width="120"><input type="text" id="SalaryNetB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                        <td width="120"><input type="text" id="SalaryB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                        <td width="80">
                                            <select id="CurrencyB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                            <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </td>
                                        <td width="130">
                                            <input type="text" id="StartDateB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                            <SCRIPT LANGUAGE="JavaScript" ID="js5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                var cal5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                cal5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                cal5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor5_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        </td>
                                        <td width="110">
                                            <input type="hidden" id="NotesB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                            <span id="NotesB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                            [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                onclick="getNotes('NotesB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                        </td>
                                        <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('SalaryB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=bonus&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('NotesB_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica bonus'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge bonus'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php else: ?>
                                            <td colspan="2">&nbsp;</td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                            </table>
                        </div>
                    <?php endif; ?>
                </fieldset>
                <?php if (1 == 2): ?>
                    <!-- Contract PFA -->
                    <br/>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Contract'), $this);?>
 </legend>
                        <?php if (! empty ( $this->_tpl_vars['salaryPFA'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_salaryPFA').style.display; if (status == 'none') Effect.SlideDown('div_salaryPFA'); else Effect.SlideUp('div_salaryPFA'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="760">
                            <tr>
                                <td width="110px"><?php echo smarty_function_translate(array('label' => 'Valoare neta'), $this);?>
</td>
                                <td width="110px"><?php echo smarty_function_translate(array('label' => 'Valoare bruta'), $this);?>
</td>
                                <td width="120px"><?php echo smarty_function_translate(array('label' => 'Cost total contract'), $this);?>
</td>
                                <td width="70px"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="120px"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                <td width="110px"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                <td width="20">&nbsp;</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetPFA_0" size="10"></td>
                                <td><input type="text" id="SalaryPFA_0" size="10"></td>
                                <td><input type="text" id="SalaryCostPFA_0" size="10"></td>
                                <td>
                                    <select id="CurrencyPFA_0" name="CurrencyPFA_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDatePFA_0" class="formstyle" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['ls_startdate'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_0">
                                        var cal3_0 = new CalendarPopup();
                                        cal3_0.isShowNavigationDropdowns = true;
                                        cal3_0.setYearSelectStartOffset(10);
                                        //writeSource("js3_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_0.select(document.getElementById('StartDatePFA_0'),'anchor3_0','dd.MM.yyyy'); return false;" NAME="anchor3_0"
                                       ID="anchor3_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="text" id="StopDatePFA_0" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_0">
                                        var cal4_0 = new CalendarPopup();
                                        cal4_0.isShowNavigationDropdowns = true;
                                        cal4_0.setYearSelectStartOffset(10);
                                        //writeSource("js4_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_0.select(document.getElementById('StopDatePFA_0'),'anchor4_0','dd.MM.yyyy'); return false;" NAME="anchor4_0"
                                       ID="anchor4_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryPFA_0').value) && !is_empty(document.getElementById('SalaryNetPFA_0').value) && !is_empty(document.getElementById('StartDatePFA_0').value) && checkDate(document.getElementById('StartDatePFA_0').value, 'Data inceput')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salaryPFA&Salary=' + document.getElementById('SalaryPFA_0').value + '&SalaryNet=' + document.getElementById('SalaryNetPFA_0').value + '&SalaryCost=' + document.getElementById('SalaryCostPFA_0').value +'&Currency=' + document.getElementById('CurrencyPFA_0').value +'&StartDate=' + document.getElementById('StartDatePFA_0').value + '&StopDate=' + document.getElementById('StopDatePFA_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre PFA!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga contract'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>

                        <?php if (! empty ( $this->_tpl_vars['salaryPFA'] )): ?>
                            <div id="div_salaryPFA" style="display:none; width:760px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

                                    <?php $_from = $this->_tpl_vars['salaryPFA']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <?php $this->assign('ls_startdate', $this->_tpl_vars['item']['StopDate']); ?>
                                        <tr>
                                            <td width="110px"><input type="text" id="SalaryNetPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="110px"><input type="text" id="SalaryPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="120px"><input type="text" id="SalaryCostPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryCost']; ?>
" size="10"></td>
                                            <td width="70px">
                                                <select id="CurrencyPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="120px">
                                                <input type="text" id="StartDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor3_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="120px">
                                                <input type="text" id="StopDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StopDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StopDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor4_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td width="20">
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data inceput')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salaryPFA&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryCost=' + document.getElementById('SalaryCostPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyPFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StopDate=' + document.getElementById('StopDatePFA_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre PFA!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica contract'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td width="20">
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salaryPFA&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge contract'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td width="40" colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <br/>
                    <!-- Concediu odihna neefectuat -->
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Concediu odihna neefectuat'), $this);?>
</legend>
                        <?php if (! empty ( $this->_tpl_vars['concediu'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_concediu').style.display; if (status == 'none') Effect.SlideDown('div_concediu'); else Effect.SlideUp('div_concediu'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="150"><?php echo smarty_function_translate(array('label' => 'Valoare Concediu net'), $this);?>
</td>
                                <td width="150"><?php echo smarty_function_translate(array('label' => 'Valoare Concediu brut'), $this);?>
</td>
                                <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetConcediu_0" size="10"></td>
                                <td><input type="text" id="SalaryConcediu_0" size="10"></td>
                                <td><select id="CurrencyConcediu_0" name="CurrencyConcediu_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateConcediu_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="jsCO_0">
                                        var calCO_0 = new CalendarPopup();
                                        calCO_0.isShowNavigationDropdowns = true;
                                        calCO_0.setYearSelectStartOffset(10);
                                        //writeSource("jsCO_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="calCO_0.select(document.getElementById('StartDateConcediu_0'),'anchorCO_0','dd.MM.yyyy'); return false;" NAME="anchorCO_0"
                                       ID="anchorCO_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesConcediu_0" value=""/>
                                    <span id="NotesConcediu_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesConcediu_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryConcediu_0').value) && !is_empty(document.getElementById('SalaryNetConcediu_0').value) && !is_empty(document.getElementById('StartDateConcediu_0').value) && checkDate(document.getElementById('StartDateConcediu_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=concediu&Salary=' + document.getElementById('SalaryConcediu_0').value + '&SalaryNet=' + document.getElementById('SalaryNetConcediu_0').value + '&Currency=' + document.getElementById('CurrencyConcediu_0').value +'&StartDate=' + document.getElementById('StartDateConcediu_0').value + '&Notes=' + escape(document.getElementById('NotesConcediu_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediu odihna neefectuat!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu odihna neefectuat'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>

                        <?php if (! empty ( $this->_tpl_vars['concediu'] )): ?>
                            <div id="div_concediu" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" style="width:700px;">
                                    <?php $_from = $this->_tpl_vars['concediu']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="150"><input type="text" id="SalaryNetConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="150"><input type="text" id="SalaryConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="jsCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var calCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    calCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    calCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("jsCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="calCO_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchorConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchorConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchorConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                                <span id="NotesConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                    onclick="getNotes('NotesConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=concediu&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('NotesConcediu_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediu odihna neefectuat!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu odihna neefectuat'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu odihna neefectuat'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <br/>
                    <!-- Bonusuri vanzari -->
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Bonusuri vanzari'), $this);?>
</legend>
                        <?php if (! empty ( $this->_tpl_vars['bonus_sales'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusSales').style.display; if (status == 'none') Effect.SlideDown('div_bonusSales'); else Effect.SlideUp('div_bonusSales'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus net'), $this);?>
</td>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus brut'), $this);?>
</td>
                                <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                                <td width="20">&nbsp;</td>
                                <td width="20">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBS_0" size="10"></td>
                                <td><input type="text" id="SalaryBS_0" size="10"></td>
                                <td><select id="CurrencyBS_0" name="CurrencyBS_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBS_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_0">
                                        var cal7_0 = new CalendarPopup();
                                        cal7_0.isShowNavigationDropdowns = true;
                                        cal7_0.setYearSelectStartOffset(10);
                                        //writeSource("js7_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal7_0.select(document.getElementById('StartDateBS_0'),'anchor7_0','dd.MM.yyyy'); return false;" NAME="anchor7_0"
                                       ID="anchor7_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBS_0" value=""/>
                                    <span id="NotesBS_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBS_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBS_0').value) && !is_empty(document.getElementById('SalaryNetBS_0').value) && !is_empty(document.getElementById('StartDateBS_0').value) && checkDate(document.getElementById('StartDateBS_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=bonus_sales&Salary=' + document.getElementById('SalaryBS_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBS_0').value + '&Currency=' + document.getElementById('CurrencyBS_0').value +'&StartDate=' + document.getElementById('StartDateBS_0').value + '&Notes=' + escape(document.getElementById('NotesBS_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga bonus'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        <?php if (! empty ( $this->_tpl_vars['bonus_sales'] )): ?>
                            <div id="div_bonusSales" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">

                                    <?php $_from = $this->_tpl_vars['bonus_sales']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor7_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                                <span id="NotesBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                    onclick="getNotes('NotesBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=bonus_sales&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('NotesBS_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica bonus'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge bonus'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <br>
                    <!-- Avantaj natura -->
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Avantaj natura'), $this);?>
</legend>
                        <?php if (! empty ( $this->_tpl_vars['bonus_natura'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusNatura').style.display; if (status == 'none') Effect.SlideDown('div_bonusNatura'); else Effect.SlideUp('div_bonusNatura'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>

                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus net'), $this);?>
</td>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Bonus brut'), $this);?>
</td>
                                <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBN_0" size="10"></td>
                                <td><input type="text" id="SalaryBN_0" size="10"></td>
                                <td><select id="CurrencyBN_0" name="CurrencyBN_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBN_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js8_0">
                                        var cal8_0 = new CalendarPopup();
                                        cal8_0.isShowNavigationDropdowns = true;
                                        cal8_0.setYearSelectStartOffset(10);
                                        //writeSource("js8_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal8_0.select(document.getElementById('StartDateBN_0'),'anchor8_0','dd.MM.yyyy'); return false;" NAME="anchor8_0"
                                       ID="anchor8_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBN_0" value=""/>
                                    <span id="NotesBN_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBN_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBN_0').value) && !is_empty(document.getElementById('SalaryNetBN_0').value) && !is_empty(document.getElementById('StartDateBN_0').value) && checkDate(document.getElementById('StartDateBN_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=bonus_natura&Salary=' + document.getElementById('SalaryBN_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBN_0').value + '&Currency=' + document.getElementById('CurrencyBN_0').value +'&StartDate=' + document.getElementById('StartDateBN_0').value + '&Notes=' + escape(document.getElementById('NotesBN_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga bonus'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        <?php if (! empty ( $this->_tpl_vars['bonus_natura'] )): ?>
                            <div id="div_bonusNatura" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                                    <?php $_from = $this->_tpl_vars['bonus_natura']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor8_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                                <span id="NotesBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                    onclick="getNotes('NotesBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=bonus_natura&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('NotesBN_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre bonus!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica bonus'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge bonus'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <br>
                    <!-- Prime -->
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Prime'), $this);?>
</legend>
                        <?php if (! empty ( $this->_tpl_vars['bonus_prime'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_bonusPrime').style.display; if (status == 'none') Effect.SlideDown('div_bonusPrime'); else Effect.SlideUp('div_bonusPrime'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>

                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Valoare neta'), $this);?>
</td>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Valoare bruta'), $this);?>
</td>
                                <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetBP_0" size="10"></td>
                                <td><input type="text" id="SalaryBP_0" size="10"></td>
                                <td><select id="CurrencyBP_0" name="CurrencyBP_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateBP_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js9_0">
                                        var cal9_0 = new CalendarPopup();
                                        cal9_0.isShowNavigationDropdowns = true;
                                        cal9_0.setYearSelectStartOffset(10);
                                        //writeSource("js9_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal9_0.select(document.getElementById('StartDateBP_0'),'anchor9_0','dd.MM.yyyy'); return false;" NAME="anchor9_0"
                                       ID="anchor9_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="NotesBP_0" value=""/>
                                    <span id="NotesBP_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('NotesBP_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryBP_0').value) && !is_empty(document.getElementById('SalaryNetBP_0').value) && !is_empty(document.getElementById('StartDateBP_0').value) && checkDate(document.getElementById('StartDateBP_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=bonus_prime&Salary=' + document.getElementById('SalaryBP_0').value + '&SalaryNet=' + document.getElementById('SalaryNetBP_0').value + '&Currency=' + document.getElementById('CurrencyBP_0').value +'&StartDate=' + document.getElementById('StartDateBP_0').value + '&Notes=' + escape(document.getElementById('NotesBP_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre prima!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga prima'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        <?php if (! empty ( $this->_tpl_vars['bonus_prime'] )): ?>
                            <div id="div_bonusPrime" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                                    <?php $_from = $this->_tpl_vars['bonus_prime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="80">
                                                <select id="CurrencyBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor9_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="NotesBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                                <span id="NotesBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                    onclick="getNotes('NotesBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=bonus_prime&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('NotesBP_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre prima!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica prima'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge prima'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                    <br/>
                    <!-- Penalizari -->
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Penalizari'), $this);?>
</legend>
                        <?php if (! empty ( $this->_tpl_vars['malus'] )): ?>
                            <p style="padding-left: 4px;"><a href="#"
                                                             onclick="var status = document.getElementById('div_malus').style.display; if (status == 'none') Effect.SlideDown('div_malus'); else Effect.SlideUp('div_malus'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                            </p>
                        <?php endif; ?>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">
                            <tr>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Malus net'), $this);?>
</td>
                                <td width="120"><?php echo smarty_function_translate(array('label' => 'Malus brut'), $this);?>
</td>
                                <td width="80"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                <td width="130"><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                                <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentariu'), $this);?>
</td>
                                <td>&nbsp;</td>
                                <td>&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="SalaryNetM_0" size="10"></td>
                                <td><input type="text" id="SalaryM_0" size="10"></td>
                                <td><select id="CurrencyM_0" name="CurrencyM_0">
                                        <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                            <option value="<?php echo $this->_tpl_vars['curr']; ?>
" <?php if ($this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td>
                                    <input type="text" id="StartDateM_0" class="formstyle" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_0">
                                        var cal6_0 = new CalendarPopup();
                                        cal6_0.isShowNavigationDropdowns = true;
                                        cal6_0.setYearSelectStartOffset(10);
                                        //writeSource("js6_0");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_0.select(document.getElementById('StartDateM_0'),'anchor6_0','dd.MM.yyyy'); return false;" NAME="anchor6_0"
                                       ID="anchor6_0"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="Notes_0" value=""/>
                                    <span id="Notes_0_display"></span>
                                    [<a href="#" title="" onclick="getNotes('Notes_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_add"><a href="#"
                                                                onclick="if (!is_empty(document.getElementById('SalaryM_0').value) && !is_empty(document.getElementById('SalaryNetM_0').value) && !is_empty(document.getElementById('StartDateM_0').value) && checkDate(document.getElementById('StartDateM_0').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_salary_extra&Type=malus&Salary=' + document.getElementById('SalaryM_0').value + '&SalaryNet=' + document.getElementById('SalaryNetM_0').value + '&Currency=' + document.getElementById('CurrencyM_0').value + '&StartDate=' + document.getElementById('StartDateM_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre penalizare!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga penalizare'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                <td width="20">&nbsp;</td>
                            </tr>
                        </table>
                        <?php if (! empty ( $this->_tpl_vars['malus'] )): ?>
                            <div id="div_malus" style="display:none; width:700px; background:#ccc; text-align:center;">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="700">

                                    <?php $_from = $this->_tpl_vars['malus']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="120"><input type="text" id="SalaryNetM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['SalaryNet']; ?>
" size="10"></td>
                                            <td width="120"><input type="text" id="SalaryM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Salary']; ?>
" size="10"></td>
                                            <td width="80"><select id="CurrencyM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" name="CurrencyM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    <?php $_from = $this->_tpl_vars['currencies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['curr']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['curr']; ?>
"
                                                                <?php if (( ! empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $this->_tpl_vars['item']['Currency'] ) ) || ( empty ( $this->_tpl_vars['item']['Currency'] ) && ( $this->_tpl_vars['curr'] == $_SESSION['CURRENCY']['CURRENT'] ) )): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['curr']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="130">
                                                <input type="text" id="StartDateM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartDate']; ?>
" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
">
                                                    var cal6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
 = new CalendarPopup();
                                                    cal6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
.select(document.getElementById('StartDateM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'),'anchor6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" ID="anchor6_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td width="110">
                                                <input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                                <span id="Notes_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
_display"></span>
                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                                    onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (!is_empty(document.getElementById('SalaryM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('SalaryNetM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && !is_empty(document.getElementById('StartDateM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value) && checkDate(document.getElementById('StartDateM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_salary_extra&Type=malus&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
&Salary=' + document.getElementById('SalaryM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&SalaryNet=' + document.getElementById('SalaryNetM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Currency=' + document.getElementById('CurrencyM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&StartDate=' + document.getElementById('StartDateM_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre penalizare!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica penalizare'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_salary_extra&SalaryID=<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge penalizare'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endif; ?>
                    </fieldset>
                <?php endif; ?>
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

<?php echo '
    <script type="text/javascript">

        function getNotes(id) {
            document.getElementById(\'layer_co_notes\').value = document.getElementById(id).value;
            document.getElementById(\'layer_co_notes_dest\').value = id;
            document.getElementById(\'layer_co\').style.display = \'block\';
            document.getElementById(\'layer_co_x\').style.display = \'block\';
        }

        function setNotes() {
            var id = document.getElementById(\'layer_co_notes_dest\').value;
            document.getElementById(id).value = document.getElementById(\'layer_co_notes\').value;
            document.getElementById(id + \'_display\').innerHTML = document.getElementById(\'layer_co_notes\').value.substring(0, 5) + \'...\';
            document.getElementById(\'layer_co\').style.display = \'none\';
            document.getElementById(\'layer_co_x\').style.display = \'none\';
        }

    </script>
'; ?>