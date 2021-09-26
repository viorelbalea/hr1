<?php /* Smarty version 2.6.18, created on 2020-09-21 09:49:18
         compiled from persons_modulIT.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_modulIT.tpl', 6, false),array('modifier', 'date_format', 'persons_modulIT.tpl', 154, false),array('modifier', 'escape', 'persons_modulIT.tpl', 180, false),)), $this); ?>
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
" method="post" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['rights']['FullName']; ?>
</span></td>
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Modul IT'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="120">&nbsp;</td>
                            <td>
                                <table cellspacing="0" cellpadding="2">
                                    <tr>
                                        <td width="120">&nbsp;</td>
                                        <td width="30" align="center"><b><?php echo smarty_function_translate(array('label' => 'R/W'), $this);?>
</b></td>
                                        <td width="30" align="center"><b><?php echo smarty_function_translate(array('label' => 'R'), $this);?>
</b></td>
                                        <td width="30" align="center"><b><?php echo smarty_function_translate(array('label' => 'W'), $this);?>
</b></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['applications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['appid'] => $this->_tpl_vars['info']):
?>
                            <?php $_from = $this->_tpl_vars['info']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['moduleid'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                                <tr>
                                    <td width="120"><?php if (($this->_foreach['iter']['iteration'] <= 1)): ?><b><?php echo $this->_tpl_vars['item']['Application']; ?>
</b><?php else: ?>&nbsp;<?php endif; ?></td>
                                    <td>
                                        <table cellspacing="0" cellpadding="2">
                                            <tr>
                                                <td width="120"><b><?php echo $this->_tpl_vars['item']['Module']; ?>
</b></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[<?php echo $this->_tpl_vars['appid']; ?>
][<?php echo $this->_tpl_vars['moduleid']; ?>
]" value="rw"
                                                                                     <?php if ($this->_tpl_vars['rights']['ModulIT'][$this->_tpl_vars['appid']][$this->_tpl_vars['moduleid']] == 'rw'): ?>checked<?php endif; ?>></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[<?php echo $this->_tpl_vars['appid']; ?>
][<?php echo $this->_tpl_vars['moduleid']; ?>
]" value="r"
                                                                                     <?php if ($this->_tpl_vars['rights']['ModulIT'][$this->_tpl_vars['appid']][$this->_tpl_vars['moduleid']] == 'r'): ?>checked<?php endif; ?>></td>
                                                <td width="30" align="center"><input type="radio" name="modulIT[<?php echo $this->_tpl_vars['appid']; ?>
][<?php echo $this->_tpl_vars['moduleid']; ?>
]" value="w"
                                                                                     <?php if ($this->_tpl_vars['rights']['ModulIT'][$this->_tpl_vars['appid']][$this->_tpl_vars['moduleid']] == 'w'): ?>checked<?php endif; ?>></td>
                                            </tr>
                                        </table>
                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                            <tr>
                                <td colspan="2" style="border-top: 1px solid #CCCCCC;">&nbsp;</td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>
                </fieldset>
                <br>
                <?php if ($this->_tpl_vars['rights']['rw'] == 1): ?>
                    <div align="center"><input type="submit" name="save" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"</div><?php endif; ?>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Altele'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="100"><b>Hardware</b></td>
                            <td><input type="checkbox" name="others[1][1]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['1']['1'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'PC'), $this);?>
</td>
                            <td><input type="checkbox" name="others[1][2]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['1']['2'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Laptop'), $this);?>
</td>
                            <td><input type="checkbox" name="others[1][3]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['1']['3'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Imprimanta'), $this);?>
</td>
                            <td><input type="checkbox" name="others[1][4]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['1']['4'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Altele'), $this);?>
</td>
                        </tr>
                        <tr>
                            <td><b>Internet</b></td>
                            <td><input type="checkbox" name="others[2][1]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['2']['1'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Internet full'), $this);?>
</td>
                            <td><input type="checkbox" name="others[2][2]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['2']['2'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Internet limitat'), $this);?>
</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>eMail</b></td>
                            <td><input type="checkbox" name="others[3][1]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['3']['1'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'eMail'), $this);?>
</td>
                            <td><input type="checkbox" name="others[3][2]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['3']['2'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'webMail'), $this);?>
</td>
                            <td><input type="checkbox" name="others[3][3]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['3']['3'] )): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'mail extern'), $this);?>
</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b>IM</b></td>
                            <td><input type="checkbox" name="others[4][1]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['4']['1'] )): ?>checked<?php endif; ?>>Skype</td>
                            <td><input type="checkbox" name="others[4][2]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['4']['2'] )): ?>checked<?php endif; ?>>MSN</td>
                            <td><input type="checkbox" name="others[4][3]" <?php if (! empty ( $this->_tpl_vars['rights']['ModulOthers']['4']['3'] )): ?>checked<?php endif; ?>>Yahoo</td>
                            <td>&nbsp;</td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
</b></td>
                            <td colspan="4"><textarea name="others[5]" rows="5" cols="60" wrap="soft"><?php echo $this->_tpl_vars['rights']['ModulOthers']['5']; ?>
</textarea></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Obiecte de inventar'), $this);?>
</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'Obiect'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                            <td width="120px"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['person_inventar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td>
                                    <select id="ObjID_<?php echo $this->_tpl_vars['key']; ?>
">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['inventar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['ObjID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['ObjName']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value="" size="10" maxlength="10">
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
                                <td nowrap="nowrap">
                                    <input type="text" id="StopDate_<?php echo $this->_tpl_vars['key']; ?>
"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['StopDate'] ) && $this->_tpl_vars['item']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" class="formstyle"
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
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                       NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td>
                                    <input type="hidden" id="Notes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['rights']['rw'] == 1): ?>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('ObjID_<?php echo $this->_tpl_vars['key']; ?>
').value > 0 && document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, '<?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
')) window.location.href = './?m=persons&o=modulIT&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&ID=<?php echo $this->_tpl_vars['key']; ?>
&ObjID=' + document.getElementById('ObjID_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['key']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Obiect, Data inceput!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica obiect de inventar'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                <td><?php if ($this->_tpl_vars['rights']['rw'] == 1): ?>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=modulIT&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&ID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge obiect de inventar'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <tr>
                            <td>
                                <select id="ObjID_0">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['inventar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']['ObjName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td nowrap="nowrap">
                                <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap="nowrap">
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
                            <td>
                                <input type="hidden" id="Notes_0" value=""/>
                                <span id="Notes_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('Notes_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap"><?php if ($this->_tpl_vars['rights']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('ObjID_0').value > 0 && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, '<?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
')) window.location.href = './?m=persons&o=modulIT&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new&ID=0&ObjID=' + document.getElementById('ObjID_0').value + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Obiect, Data inceput!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga obiect de inventar'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'drepturi pe aplicatiile firmei'), $this);?>
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