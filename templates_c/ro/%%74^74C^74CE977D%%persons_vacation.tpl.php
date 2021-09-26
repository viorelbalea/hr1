<?php /* Smarty version 2.6.18, created on 2020-12-09 08:31:52
         compiled from persons_vacation.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_vacation.tpl', 21, false),array('function', 'math', 'persons_vacation.tpl', 58, false),array('modifier', 'default', 'persons_vacation.tpl', 55, false),array('modifier', 'date_format', 'persons_vacation.tpl', 247, false),array('modifier', 'truncate', 'persons_vacation.tpl', 290, false),array('modifier', 'escape', 'persons_vacation.tpl', 291, false),)), $this); ?>
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
        <td align="right" class="bkdTitleMenu">
    		<span class="TitleBox">
    		<?php $_from = $this->_tpl_vars['vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                    <?php echo $this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['FullName']; ?>

                    <?php $this->assign('comment', $this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['VacationComment']); ?>
                    <?php $this->assign('rw', $this->_tpl_vars['vacations'][$this->_tpl_vars['key']]['rw']); ?>
                <?php endif; ?>
            <?php endforeach; endif; unset($_from); ?>
    		</span>
        </td>
    </tr>
    <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == ""): ?>
    <tr height="30">
        <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #000000; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
</td>
    </tr>
    <?php else: ?>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
</table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding: 0 10px 10px 10px;" width="50%">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Concediu de odihna CO'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Anul'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Zile CO cuvenite'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Zile CO ramase'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Efectuat'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Zile pierdute'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Ramas'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Recalculare'), $this);?>
</td>
                            <td align="center"><?php echo smarty_function_translate(array('label' => 'Inchide'), $this);?>
</td>
                            <td colspan="2">&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                            <?php if ($this->_tpl_vars['item']['Year'] > ''): ?>
                                <tr>
                                    <td align="center"><?php echo $this->_tpl_vars['item']['Year']; ?>
</td>
                                    <td align="center"><input type="text" id="TotalCO_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['item']['TotalCO']; ?>
"></td>
                                    <td align="center"><input type="text" id="TotalCORef_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="2" maxlength="2" value="<?php echo $this->_tpl_vars['item']['TotalCORef']; ?>
"></td>
                                    <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['EffCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                                    <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['LostCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                                    <td align="center"><?php echo smarty_function_math(array('equation' => "x-y-z-t",'x' => $this->_tpl_vars['item']['TotalCO'],'y' => ((is_array($_tmp=@$this->_tpl_vars['item']['EffCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)),'z' => ((is_array($_tmp=@$this->_tpl_vars['item']['Invoire'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)),'t' => ((is_array($_tmp=@$this->_tpl_vars['item']['LostCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0))), $this);?>
</td>
                                    <td align="center"><input type="checkbox" id="VacRecalc_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['VacRecalc'] == 1): ?>checked<?php endif; ?>></td>
                                    <td align="center"><input type="checkbox" id="Closed_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Closed'] == 1): ?>checked<?php endif; ?>></td>
                                    <td align="center"><?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (!isNaN(document.getElementById('TotalCO_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) && document.getElementById('TotalCORef_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value >= 0) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&TotalCO=' + document.getElementById('TotalCO_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&TotalCORef=' + document.getElementById('TotalCORef_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&VacRecalc=' + (document.getElementById('VacRecalc_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').checked == true ? 1 : 0) + '&Closed=' + (document.getElementById('Closed_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').checked == true ? 1 : 0); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat zilele totale de concediu'), $this);?>
!'); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica CO'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td align="center"><?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge CO'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <tr>
                            <td align="center"><select id="Year_0"><?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year']):
?><?php if (! isset ( $this->_tpl_vars['vacations'][$this->_tpl_vars['year']] )): ?>
                                        <option value="<?php echo $this->_tpl_vars['year']; ?>
"><?php echo $this->_tpl_vars['year']; ?>
</option><?php endif; ?><?php endforeach; endif; unset($_from); ?></select></td>
                            <td align="center"><input type="text" id="TotalCO_0" size="2" maxlength="2"></td>
                            <td align="center"><input type="text" id="TotalCORef_0" size="2" maxlength="2"></td>
                            <td>&nbsp;</td>
                            <td align="center"><?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('TotalCO_0').value >= 0 && document.getElementById('TotalCORef_0').value >= 0) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new&Year=' + document.getElementById('Year_0').value + '&TotalCO=' + document.getElementById('TotalCO_0').value + '&TotalCORef=' + document.getElementById('TotalCORef_0').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat zilele totale de concediu'), $this);?>
!'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga CO'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                            <td colspan="4">&nbsp;</td>
                        </tr>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding: 0 10px 10px 0;" width="50%">
                <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
                    <?php $this->assign('history', '0'); ?>
                    <?php $_from = $this->_tpl_vars['vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                        <?php if (! empty ( $this->_tpl_vars['item']['History'] )): ?>
                            <?php $this->assign('history', '1'); ?>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                    <br>
                    <?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>

                    <br>
                    <textarea name="VacationComment" rows="6" cols="70" wrap="soft" style="width: 100%"><?php echo $this->_tpl_vars['comment']; ?>
</textarea>
                    <?php if ($this->_tpl_vars['rw'] == 1): ?><p style="text-align: right;"><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza comentarii'), $this);?>
"></p><?php endif; ?>
                </form>
            </td>
        </tr>
    </table>

    <div id="layer_co" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</h3>
        <div class="observatiiTextbox">
            <textarea id="layer_co_notes"></textarea>
            <input type="hidden" id="layer_co_notes_dest" value=""/>

        </div>

        <div class="saveObservatii">
            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" onclick="setNotes();">
            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                   onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
        </div>
    </div>
<!---->
    <div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
    </div>


    <div id="layer_doc" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</h3>
        <div id="layer_doc_content" class="layerContent"></div>
    </div>
    <div id="layer_doc_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_doc').style.display = 'none'; document.getElementById('layer_doc_x').style.display = 'none';">x
    </div>


    <div id="layer_reason" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Motiv aprobare/respingere'), $this);?>
</h3>
        <div class="observatiiTextbox">
            <textarea id="layer_reason_notes"></textarea>
            <input type="hidden" id="layer_reason_notes_dest" value="">
        </div>
        <div class="saveObservatii">
            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" onclick="setReason();">
            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                   onclick="document.getElementById('layer_reason').style.display = 'none'; document.getElementById('layer_reason_x').style.display = 'none';">

        </div>
    </div>
    <div id="layer_reason_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_reason').style.display = 'none'; document.getElementById('layer_reason_x').style.display = 'none';">x
    </div>

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 0 10px 10px 10px;">

            <br>
            <!-- BEGIN CO -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu odihna (CO)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CO'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CO']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_co" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_co">
                                var cal1_co = new CalendarPopup();
                                cal1_co.isShowNavigationDropdowns = true;
                                cal1_co.setYearSelectStartOffset(10);
                                //writeSource("js1_co");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_co.select(document.getElementById('StartDate_co'),'anchor1_co','dd.MM.yyyy'); return false;" NAME="anchor1_co"
                               ID="anchor1_co"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_co" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_co">
                                var cal2_co = new CalendarPopup();
                                cal2_co.isShowNavigationDropdowns = true;
                                cal2_co.setYearSelectStartOffset(10);
                                //writeSource("js2_co");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_co.select(document.getElementById('StopDate_co'),'anchor2_co','dd.MM.yyyy'); return false;" NAME="anchor2_co" ID="anchor2_co"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_co">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_co"><span id="Notes_co_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_co'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <div id="button_add"><a href="#"
                                                        onclick="<?php $_from = $this->_tpl_vars['vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>if (('<?php echo $this->_tpl_vars['key']; ?>
' == document.getElementById('StartDate_co').value.substring(6) || '<?php echo $this->_tpl_vars['key']; ?>
' == document.getElementById('StopDate_co').value.substring(6)) && <?php echo $this->_tpl_vars['item']['Closed']; ?>
 == 1) <?php echo '{'; ?>
alert('<?php echo smarty_function_translate(array('label' => 'Nu puteti adauga concediu de odihna pentru anul %s','values' => $this->_tpl_vars['key']), $this);?>
!'); return false;<?php echo '}'; ?>
<?php endforeach; endif; unset($_from); ?>if (document.getElementById('StartDate_co').value && checkDate(document.getElementById('StartDate_co').value, 'Data inceput') && document.getElementById('StopDate_co').value && checkDate(document.getElementById('StopDate_co').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CO&StartDate=' + document.getElementById('StartDate_co').value + '&StopDate=' + document.getElementById('StopDate_co').value + '&Replacer=' + document.getElementById('Replacer_co').value + '&Notes=' + escape(document.getElementById('Notes_co').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul de odihna'), $this);?>
!'); return false;"
                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu odihna'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CO']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="co_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CO'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>

                                    <td>


                                        <input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
">
                                        <span id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span>
                                        [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;">
                                            <?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>

                                        </a>]
                                    </td>

                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&Type=CO&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul de odihna'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu odihna'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu odihna'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu odihna'), $this);?>
"><b>Reject</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu odihna'), $this);?>
"><b>Aproba</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                            </td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CO -->

            <br>
            <!-- BEGIN INV -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Invoiri (INV)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['INV'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['INV']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Ora inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Ora sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr ore'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_inv" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_inv">
                                var cal1_inv = new CalendarPopup();
                                cal1_inv.isShowNavigationDropdowns = true;
                                cal1_inv.setYearSelectStartOffset(10);
                                //writeSource("js1_inv");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_inv.select(document.getElementById('StartDate_inv'),'anchor1_inv','dd.MM.yyyy'); return false;" NAME="anchor1_inv"
                               ID="anchor1_inv"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StartHour_inv" class="formstyle" value="00:00" size="5" max="5"/>
                        </td>
                        <td>
                            <input type="text" id="StopHour_inv" class="formstyle" value="00:00" size="5" max="5"/>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_inv">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_inv"><span id="Notes_inv_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_inv'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <div id="button_add"><a href="#"
                                                        onclick="<?php $_from = $this->_tpl_vars['vacations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>if (('<?php echo $this->_tpl_vars['key']; ?>
' == document.getElementById('StartDate_inv').value.substring(6)) && <?php echo $this->_tpl_vars['item']['Closed']; ?>
 == 1) <?php echo '{'; ?>
alert('<?php echo smarty_function_translate(array('label' => 'Nu puteti adauga invoiri pentru anul %s','values' => $this->_tpl_vars['key']), $this);?>
!'); return false;<?php echo '}'; ?>
<?php endforeach; endif; unset($_from); ?>if (document.getElementById('StartDate_inv').value && checkDate(document.getElementById('StartDate_inv').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=INV&StartDate=' + document.getElementById('StartDate_inv').value + '&StartHour=' + document.getElementById('StartHour_inv').value + '&StopHour=' + document.getElementById('StopHour_inv').value + '&Replacer=' + document.getElementById('Replacer_inv').value + '&Notes=' + escape(document.getElementById('Notes_co').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre invoire'), $this);?>
!'); return false;"
                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga invoire'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['INV']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="inv_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['INV'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StartHour_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StartHour']; ?>
" size="5" maxlength="5"/>
                                    </td>
                                    <td>
                                        <input type="text" id="StopHour_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['StopHour']; ?>
" size="5" maxlength="5"/>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['HoursNo']; ?>
</td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&Type=INV&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StartHour=' + document.getElementById('StartHour_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopHour=' + document.getElementById('StopHour_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre invoire'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica invoire'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge invoire'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge invoire'), $this);?>
"><b>Reject</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba invoire'), $this);?>
"><b>Aproba</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END INV -->

            <br>
            <!-- BEGIN CFS -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu fara salariu (CFS)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CFS'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CFS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cfs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cfs">
                                var cal1_cfs = new CalendarPopup();
                                cal1_cfs.isShowNavigationDropdowns = true;
                                cal1_cfs.setYearSelectStartOffset(10);
                                //writeSource("js1_cfs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cfs.select(document.getElementById('StartDate_cfs'),'anchor1_cfs','dd.MM.yyyy'); return false;" NAME="anchor1_cfs"
                               ID="anchor1_cfs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cfs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cfs">
                                var cal2_cfs = new CalendarPopup();
                                cal2_cfs.isShowNavigationDropdowns = true;
                                cal2_cfs.setYearSelectStartOffset(10);
                                //writeSource("js2_cfs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cfs.select(document.getElementById('StopDate_cfs'),'anchor2_cfs','dd.MM.yyyy'); return false;" NAME="anchor2_cfs"
                               ID="anchor2_cfs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_cfs">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cfs"><span id="Notes_cfs_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_cfs'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cfs').value && checkDate(document.getElementById('StartDate_cfs').value, 'Data inceput') && document.getElementById('StopDate_cfs').value && checkDate(document.getElementById('StopDate_cfs').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CFS&StartDate=' + document.getElementById('StartDate_cfs').value + '&StopDate=' + document.getElementById('StopDate_cfs').value + '&Replacer=' + document.getElementById('Replacer_cfs').value + '&Notes=' + escape(document.getElementById('Notes_cfs').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul fara salariu'), $this);?>
!'); return false;"
                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu fara salariu'), $this);?>
"><b>Add</b></a><?php endif; ?></div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CFS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="cfs_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CFS'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && $_SESSION['ROLEMNG'] == 1): ?>+'&reason='+escape(document.getElementById('reason').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul fara salariu'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu fara salariu'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu fara salariu'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu fara salariu'), $this);?>
"><b>Reject</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu fara salariu'), $this);?>
"><b>Aproba</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                            </td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CFS -->

            <br>
            <!-- BEGIN CE -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu pentru evenimente familiale (CE)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CE'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Cauza'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_ce" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_ce">
                                var cal1_ce = new CalendarPopup();
                                cal1_ce.isShowNavigationDropdowns = true;
                                cal1_ce.setYearSelectStartOffset(10);
                                //writeSource("js1_ce");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_ce.select(document.getElementById('StartDate_ce'),'anchor1_ce','dd.MM.yyyy'); return false;" NAME="anchor1_ce"
                               ID="anchor1_ce"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_ce" class="formstyle" value="" size="10" maxlength="10" readonly>
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_ce">
                                var cal2_ce = new CalendarPopup();
                                cal2_ce.isShowNavigationDropdowns = true;
                                cal2_ce.setYearSelectStartOffset(10);
                                //writeSource("js2_ce");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_ce.select(document.getElementById('StopDate_ce'),'anchor2_ce','dd.MM.yyyy'); return false;" NAME="anchor2_ce" ID="anchor2_ce"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Details_ce">
                                <option value=""><?php echo smarty_function_translate(array('label' => 'alege cauza'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['ce_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['key']), $this);?>
 - <?php echo $this->_tpl_vars['item']; ?>
 zile</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td>
                            <select id="Replacer_ce">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_ce"><span id="Notes_ce_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_ce'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_ce').value && checkDate(document.getElementById('StartDate_ce').value, 'Data inceput') && document.getElementById('Details_ce').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CE&StartDate=' + document.getElementById('StartDate_ce').value + '&StopDate=' + document.getElementById('StopDate_ce').value + '&Details=' + escape(document.getElementById('Details_ce').value) + '&Replacer=' + document.getElementById('Replacer_ce').value + '&Notes=' + escape(document.getElementById('Notes_ce').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile (Data inceput si Cauza) despre concediul pentru evenimente familiale'), $this);?>
!'); return false;"
                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu pentru evenimente familiale'), $this);?>
"><b>Add</b></a><?php endif; ?></div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CE']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="ce_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CE'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td>
                                        <select id="Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <?php $_from = $this->_tpl_vars['ce_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['Details']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['key2']; ?>
 - <?php echo $this->_tpl_vars['item2']; ?>
 zile</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Details=' + escape(document.getElementById('Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && $_SESSION['ROLEMNG'] == 1): ?>+'&reason='+escape(document.getElementById('reason').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile (Data inceput si Cauza) despre concediul pentru evenimente familiale'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu pentru evenimente familiale'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu pentru evenimente familiale'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu pentru evenimente familiale'), $this);?>
"><b>Reject</b></a>
                                                    </div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu pentru evenimente familiale'), $this);?>
"><b>Aproba</b></a>
                                                    </div><?php else: ?>&nbsp;<?php endif; ?></td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CE -->

            <br>
            <!-- BEGIN CIC -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu de ingrijire copil (CIC)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CIC'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cic" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cic">
                                var cal1_cic = new CalendarPopup();
                                cal1_cic.isShowNavigationDropdowns = true;
                                cal1_cic.setYearSelectStartOffset(10);
                                //writeSource("js1_cic");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cic.select(document.getElementById('StartDate_cic'),'anchor1_cic','dd.MM.yyyy'); return false;" NAME="anchor1_cic"
                               ID="anchor1_cic"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cic" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cic">
                                var cal2_cic = new CalendarPopup();
                                cal2_cic.isShowNavigationDropdowns = true;
                                cal2_cic.setYearSelectStartOffset(10);
                                //writeSource("js2_cic");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cic.select(document.getElementById('StopDate_cic'),'anchor2_cic','dd.MM.yyyy'); return false;" NAME="anchor2_cic"
                               ID="anchor2_cic"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Replacer_cic">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cic"><span id="Notes_cic_display"></span> [<a href="#"
                                                                                                         onclick="getNotes('Notes_cic'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cic').value && checkDate(document.getElementById('StartDate_cic').value, 'Data inceput') && document.getElementById('StopDate_cic').value && checkDate(document.getElementById('StopDate_cic').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CIC&StartDate=' + document.getElementById('StartDate_cic').value + '&StopDate=' + document.getElementById('StopDate_cic').value + '&Replacer=' + document.getElementById('Replacer_cic').value + '&Notes=' + escape(document.getElementById('Notes_cic').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul de ingrijire copil'), $this);?>
!'); return false;"
                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu de ingrijire copil'), $this);?>
"><b>Add</b></a><?php endif; ?></div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CIC']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="cic_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CIC'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && $_SESSION['ROLEMNG'] == 1): ?>+'&reason='+escape(document.getElementById('reason').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul de ingrijire copil'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu de ingrijire copil'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu de ingrijire copil'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu de ingrijire copil'), $this);?>
"><b>Reject</b></a>
                                                    </div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu de ingrijire copil'), $this);?>
"><b>Aproba</b></a>
                                                    </div><?php else: ?>&nbsp;<?php endif; ?></td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CIC -->

            <br>
            <!-- BEGIN CS -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu special (CS)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CS'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Tip concediu'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Documente'), $this);?>
</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                        <td>&nbsp;</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cs" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cs">
                                var cal1_cs = new CalendarPopup();
                                cal1_cs.isShowNavigationDropdowns = true;
                                cal1_cs.setYearSelectStartOffset(10);
                                //writeSource("js1_cs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cs.select(document.getElementById('StartDate_cs'),'anchor1_cs','dd.MM.yyyy'); return false;" NAME="anchor1_cs"
                               ID="anchor1_cs"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cs" class="formstyle" value="" size="10" maxlength="10" readonly>
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cs">
                                var cal2_cs = new CalendarPopup();
                                cal2_cs.isShowNavigationDropdowns = true;
                                cal2_cs.setYearSelectStartOffset(10);
                                //writeSource("js2_cs");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cs.select(document.getElementById('StopDate_cs'),'anchor2_cs','dd.MM.yyyy'); return false;" NAME="anchor2_cs" ID="anchor2_cs"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td>
                            <select id="Details_cs">
                                <option value="">alege tip</option>
                                <?php $_from = $this->_tpl_vars['cs_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['item']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td>
                            <select id="Replacer_cs">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                        <td><input type="hidden" id="Notes_cs"><span id="Notes_cs_display"></span> [<a href="#"
                                                                                                       onclick="getNotes('Notes_cs'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                            <div id="button_add"><a href="#"
                                                    onclick="if (document.getElementById('StartDate_cs').value && checkDate(document.getElementById('StartDate_cs').value, 'Data inceput') && document.getElementById('Details_cs').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CS&StartDate=' + document.getElementById('StartDate_cs').value + '&StopDate=' + document.getElementById('StopDate_cs').value + '&Details=' + escape(document.getElementById('Details_cs').value) + '&Replacer=' + document.getElementById('Replacer_cs').value + '&Notes=' + escape(document.getElementById('Notes_cs').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile (Data inceput si Tip concediu) despre concediul special'), $this);?>
!'); return false;"
                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu special'), $this);?>
"><b>Add</b></a><?php endif; ?></div>
                        </td>
                        <td colspan="3">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CS']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="cs_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CS'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td>
                                        <select id="Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <?php $_from = $this->_tpl_vars['cs_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item2']; ?>
" <?php if ($this->_tpl_vars['item2'] == $this->_tpl_vars['item']['Details']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Details=' + escape(document.getElementById('Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && $_SESSION['ROLEMNG'] == 1): ?>+'&reason='+escape(document.getElementById('reason').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile (Data inceput si Tip concediu) despre concediul special'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu special'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu special'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu special'), $this);?>
"><b>Reject</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu special'), $this);?>
"><b>Aproba</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="11"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CS -->

        </td>
    </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuSTDR" colspan="2" style="padding: 0 10px 10px 10px;">
            <br>
            <!-- BEGIN CM -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Concediu medical (CM)'), $this);?>
</legend>
                <?php if (! empty ( $this->_tpl_vars['vacations_details']['CM'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td>
                                <select id="">                                     <option value=""><?php echo smarty_function_translate(array('label' => 'alege anul'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['vacations_details']['CM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['Year']; ?>
"><?php echo $this->_tpl_vars['Year']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                <?php endif; ?>
                <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                        <td width="40"><?php echo smarty_function_translate(array('label' => 'Nr zile'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Serie si numar certificat'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Cod Ind'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Tip Certif'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Cod Diagnostic'), $this);?>
</td>
                        <td><?php echo smarty_function_translate(array('label' => 'Emitent'), $this);?>
</td>
                        <td colspan="5"><?php echo smarty_function_translate(array('label' => 'Inlocuitor'), $this);?>
</td>
                    </tr>
                    <tr>
                        <td>
                            <input type="text" id="StartDate_cm" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js1_cm">
                                var cal1_cm = new CalendarPopup();
                                cal1_cm.isShowNavigationDropdowns = true;
                                cal1_cm.setYearSelectStartOffset(10);
                                //writeSource("js1_cm");
                            </SCRIPT>
                            <A HREF="#" onClick="cal1_cm.select(document.getElementById('StartDate_cm'),'anchor1_cm','dd.MM.yyyy'); return false;" NAME="anchor1_cm"
                               ID="anchor1_cm"><img src="./images/cal.png" border="0"></A>
                        </td>
                        <td>
                            <input type="text" id="StopDate_cm" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js2_cm">
                                var cal2_cm = new CalendarPopup();
                                cal2_cm.isShowNavigationDropdowns = true;
                                cal2_cm.setYearSelectStartOffset(10);
                                //writeSource("js2_cm");
                            </SCRIPT>
                            <A HREF="#" onClick="cal2_cm.select(document.getElementById('StopDate_cm'),'anchor2_cm','dd.MM.yyyy'); return false;" NAME="anchor2_cm" ID="anchor2_cm"><img
                                        src="./images/cal.png" border="0"></A>
                        </td>
                        <td align="center">-</td>
                        <td><input type="text" id="SerieNum_cm" size="15" maxlength="16"></td>
                        <td><input type="text" id="CodInd_cm" size="10" maxlength="16"></td>
                        <td><input type="text" id="TipCertif_cm" size="10" maxlength="32"></td>
                        <td><input type="text" id="CodCertif_cm" size="10" maxlength="16"></td>
                        <td><input type="text" id="Emitent_cm" size="20" maxlength="128"></td>
                        <td colspan="5">
                            <select id="Replacer_cm">
                                <option value=""></option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['v']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                    <tr>
                        <td colspan="6">Observatii <br/><textarea id="Details_cm" rows="1" cols="97" wrap="soft"></textarea></td>
                        <td>Comentarii<br><input type="hidden" id="Notes_cm"><span id="Notes_cm_display"></span> [<a href="#"
                                                                                                                     onclick="getNotes('Notes_cm'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                        </td>
                        <td>Documente<br>[<a href="#" onclick="getDocs(0); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                        <td>&nbsp;</td>
                        <td><?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <div id="button_add"><a href="#"
                                                        onclick="if (document.getElementById('StartDate_cm').value && checkDate(document.getElementById('StartDate_cm').value, 'Data inceput') && document.getElementById('StopDate_cm').value && checkDate(document.getElementById('StopDate_cm').value, 'Data sfarsit') && document.getElementById('CodInd_cm').value && document.getElementById('TipCertif_cm').value && document.getElementById('CodCertif_cm').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=newv&Type=CM&StartDate=' + document.getElementById('StartDate_cm').value + '&StopDate=' + document.getElementById('StopDate_cm').value + '&CodInd=' + document.getElementById('CodInd_cm').value + '&TipCertif=' + document.getElementById('TipCertif_cm').value + '&CodCertif=' + document.getElementById('CodCertif_cm').value + '&Emitent=' + escape(document.getElementById('Emitent_cm').value) + '&Details=' + escape(document.getElementById('Details_cm').value) + '&Replacer=' + document.getElementById('Replacer_cm').value + '&Notes=' + escape(document.getElementById('Notes_cs').value); else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul medical'), $this);?>
!'); return false;"
                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga concediu medical'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                        <td colspan="2">&nbsp;</td>
                    </tr>
                </table>
                <?php $_from = $this->_tpl_vars['vacations_details']['CM']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                    <div id="cm_<?php echo $this->_tpl_vars['Year']; ?>
">                         <table border="0" cellpadding="0" cellspacing="0" class="screen_co">
                            <?php $_from = $this->_tpl_vars['vacations_details']['CM'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td>
                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td>
                                        <input type="text" id="StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                               maxlength="10">
                                        <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 0): ?>
                                            <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                                var cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
 = new CalendarPopup();
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.isShowNavigationDropdowns = true;
                                                cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.setYearSelectStartOffset(10);
                                                //writeSource("js2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
");
                                            </SCRIPT>
                                            <A HREF="#"
                                               onClick="cal2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
','dd.MM.yyyy'); return false;"
                                               NAME="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                        <?php endif; ?>
                                    </td>
                                    <td align="center" width="40"><?php echo $this->_tpl_vars['item']['DaysNo']; ?>
</td>
                                    <td><input type="text" id="CodInd_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="10" maxlength="16" value="<?php echo $this->_tpl_vars['item']['CodInd']; ?>
"></td>
                                    <td><input type="text" id="TipCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="10" maxlength="32" value="<?php echo $this->_tpl_vars['item']['TipCertif']; ?>
"></td>
                                    <td><input type="text" id="CodCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="10" maxlength="16" value="<?php echo $this->_tpl_vars['item']['CodCertif']; ?>
"></td>
                                    <td><input type="text" id="Emitent_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" size="30" maxlength="128" value="<?php echo $this->_tpl_vars['item']['Emitent']; ?>
"></td>
                                    <td>
                                        <select id="Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
">
                                            <option value=""></option>
                                            <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['v']):
?>
                                                <option value="<?php echo $this->_tpl_vars['k']; ?>
" <?php if ($this->_tpl_vars['k'] == $this->_tpl_vars['item']['Replacer']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['v']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                                <tr<?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?> bgcolor="#FFB2B2"<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?> bgcolor="#cccccc"<?php endif; ?>>
                                    <td colspan="6">Observatii <br/><textarea id="Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" rows="1" cols="97" wrap="soft"><?php echo $this->_tpl_vars['item']['Details']; ?>
</textarea></td>
                                    <td><input type="hidden" id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"><span
                                                id="Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
_display"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('truncate', true, $_tmp, 5) : smarty_modifier_truncate($_tmp, 5)); ?>
</span> [<a href="#"
                                                                                                                          onclick="getNotes('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>
                                    <td>[<a href="#" onclick="getDocs(<?php echo $this->_tpl_vars['item']['VacationID']; ?>
); return false;"><?php echo smarty_function_translate(array('label' => 'Vizualizare'), $this);?>
</a>]</td>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><input type="hidden" id="Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
"
                                                                                                                                 value="">[
                                            <a href="#" onclick="getReason('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Motiv'), $this);?>
</a>
                                            ]<?php else: ?>&nbsp;<?php endif; ?></td>
                                    <?php if ($this->_tpl_vars['vacations'][$this->_tpl_vars['Year']]['Closed'] == 1): ?>
                                        <td colspan="3">&nbsp;</td>
                                    <?php else: ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1 && $this->_tpl_vars['item']['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data inceput') && document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value, 'Data sfarsit') && document.getElementById('CodInd_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && document.getElementById('TipCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value && document.getElementById('CodCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=editv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
&Type=CM&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&CodInd=' + document.getElementById('CodInd_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&TipCertif=' + document.getElementById('TipCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&CodCertif=' +  document.getElementById('CodCertif_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Emitent=' + escape(document.getElementById('Emitent_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) + '&Details=' + escape(document.getElementById('Details_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value) + '&Replacer=' + document.getElementById('Replacer_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value + '&Notes=' + document.getElementById('Notes_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && $_SESSION['ROLEMNG'] == 1): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre concediul medical'), $this);?>
!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica concediu medical'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=delv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge concediu medical'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                            <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_reject"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=rejectv&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>+'&reason='+escape(document.getElementById('Reason_<?php echo $this->_tpl_vars['item']['VacationID']; ?>
').value)<?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Respinge concediu medical'), $this);?>
"><b>Reject</b></a></div><?php else: ?>&nbsp;<?php endif; ?>
                                                <?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?>
                                                    <div id="button_accept"><a href="#"
                                                                               onclick="if (confirm('Sunteti sigur(a)?')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=aprovev&VacationID=<?php echo $this->_tpl_vars['item']['VacationID']; ?>
'<?php if ($this->_tpl_vars['item']['Aprove'] == 0 && ( $_SESSION['ROLEMNG'] == 1 || $_SESSION['USER_ID'] == 1 )): ?><?php endif; ?>; return false;"
                                                                               title="<?php echo smarty_function_translate(array('label' => 'Aproba concediu medical'), $this);?>
"><b>Aproba</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                        <?php else: ?>
                                            <td colspan="3">&nbsp;</td>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                    <td><?php if ($this->_tpl_vars['item']['Aprove'] == 0): ?><?php echo smarty_function_translate(array('label' => 'neaprobat'), $this);?>
<?php elseif ($this->_tpl_vars['item']['Aprove'] == -1): ?><?php echo smarty_function_translate(array('label' => 'respins'), $this);?>
<?php else: ?>&nbsp;<?php endif; ?></td>
                                </tr>
                                <tr>
                                    <td colspan="12"></td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <!-- END CM -->
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'concedii'), $this);?>
</span></td>
    </tr>
</table>

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

        function getDocs(id) {
            showInfo(\'ajax.php?o=vacation_docs&id=\' + id, \'layer_doc_content\');
            document.getElementById(\'layer_doc\').style.display = \'block\';
            document.getElementById(\'layer_doc_x\').style.display = \'block\';
        }

        function getReason(id) {
            document.getElementById(\'layer_reason_notes\').value = document.getElementById(id).value;
            document.getElementById(\'layer_reason_notes_dest\').value = id;
            document.getElementById(\'layer_reason\').style.display = \'block\';
            document.getElementById(\'layer_reason_x\').style.display = \'block\';
        }

        function setReason() {
            var id = document.getElementById(\'layer_reason_notes_dest\').value;
            document.getElementById(id).value = document.getElementById(\'layer_reason_notes\').value;
            document.getElementById(\'layer_reason\').style.display = \'none\';
            document.getElementById(\'layer_reason_x\').style.display = \'none\';
        }
    </script>
'; ?>