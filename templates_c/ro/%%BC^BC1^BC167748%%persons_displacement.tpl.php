<?php /* Smarty version 2.6.18, created on 2020-09-21 09:44:02
         compiled from persons_displacement.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_displacement.tpl', 16, false),array('modifier', 'date_format', 'persons_displacement.tpl', 166, false),array('modifier', 'default', 'persons_displacement.tpl', 196, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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

    <div id="layer_displacement" class="layer" style="display: none;">
        <div class="eticheta">
            <?php echo $this->_tpl_vars['eticheta']; ?>

        </div>
        <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Costuri'), $this);?>
</h3>
        <div class="layerContent" id="layer_displacement_content"></div>

    </div>
    <div id="layer_displacement_x" class="butonX" style="display: none;" title="Inchide"
         onclick="document.getElementById('layer_displacement').style.display = 'none'; document.getElementById('layer_displacement_x').style.display = 'none'; window.location.reload();">
        x
    </div>

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
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Deplasari'), $this);?>
</legend>
                    <?php if (! empty ( $this->_tpl_vars['displacements'] )): ?>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <?php $_from = $this->_tpl_vars['displacements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['item']):
?>
                            <?php if ($this->_tpl_vars['Year'] != 'Status' && $this->_tpl_vars['Year'] != 'FullName'): ?>
                                <tr>
                                    <td style="padding-top: 5px;"><a href="#"
                                                                     onclick="var status = document.getElementById('displacement_<?php echo $this->_tpl_vars['Year']; ?>
').style.display; <?php $_from = $this->_tpl_vars['displacements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year2'] => $this->_tpl_vars['item2']):
?>$('displacement_<?php echo $this->_tpl_vars['Year2']; ?>
').hide();<?php endforeach; endif; unset($_from); ?>if (status == 'none') Effect.SlideDown('displacement_<?php echo $this->_tpl_vars['Year']; ?>
'); else Effect.SlideUp('displacement_<?php echo $this->_tpl_vars['Year']; ?>
'); return false;"><b><?php echo $this->_tpl_vars['Year']; ?>
</b></a>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <?php endif; ?>
                    </table>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                        <tr>
                            <td width="12%" align="center"><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</td>
                            <td width="12%;" align="center"><?php echo smarty_function_translate(array('label' => 'Locatie'), $this);?>
</td>
                            <td width="12%;" align="center"><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
</td>
                            <td width="12%;" align="center"><?php echo smarty_function_translate(array('label' => 'Centru cost'), $this);?>
</td>
                            <td width="16%;" align="center"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                            <td width="16%;" align="center"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                            <td width="5%;" align="center"><?php echo smarty_function_translate(array('label' => 'Durata'), $this);?>
</td>
                            <td width="5%;" align="center"><?php echo smarty_function_translate(array('label' => 'Cost total'), $this);?>
</td>
                            <td width="5%" align="center">&nbsp;</td>
                            <td width="5%" align="center">&nbsp;</td>
                        </tr>
                        <tr>
                            <td align="center">
                                <select name="CountryID_0" id="CountryID_0" style="width:90%;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']['CountryName']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td align="center"><input type="text" name="Location_0" id="Location_0" value="" size="12" style="width:90%;"></td>
                            <td align="center">
                                <select name="ProjectID_0" id="ProjectID_0" style="width:100%;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item2']['ProjectID']; ?>
"><?php echo $this->_tpl_vars['item2']['Name']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td align="center">
                                <select name="CostCenterID_0" id="CostCenterID_0" style="width:100%;">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Centru cost'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td nowrap="nowrap" align="center" width="190px">

                                <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <input type="text" id="StartHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>

                            </td>
                            <td nowrap="nowrap" align="center" style="width:190px;">
                                <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <input type="text" id="StopHour_0" class="formstyle" value="00:00" size="5" maxlength="5" style="font-weight: bold;">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td align="center">-</td>
                            <td align="center">-</td>
                            <td width="20" align="center">
                                <div id="button_add"><a href="#"
                                                        onclick="if (!is_empty(document.getElementById('StartDate_0').value) && checkDate(document.getElementById('StartDate_0').value, '<?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
') && !is_empty(document.getElementById('StopDate_0').value) && checkDate(document.getElementById('StopDate_0').value, '<?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_displacement' +
                                                                '&CountryID=' + document.getElementById('CountryID_0').value +'&Location=' + escape(document.getElementById('Location_0').value) +         '&ProjectID=' + document.getElementById('ProjectID_0').value +                                                             '&CostCenterID=' + document.getElementById('CostCenterID_0').value +                                                             '&StartDate=' + document.getElementById('StartDate_0').value + ' ' + document.getElementById('StartHour_0').value +                                                                             '&StopDate=' + document.getElementById('StopDate_0').value + ' ' + document.getElementById('StopHour_0').value;                                                                                                                                                                                                         else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati specificat toate informatiile despre deplasare!'), $this);?>
'); return false;"
                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga deplasare'), $this);?>
"><b>Add</b></a></div>
                            </td>
                            <td width="20">&nbsp;</td>
                        </tr>
                    </table>
                    <?php if (! empty ( $this->_tpl_vars['displacements'] )): ?>

                        <?php $_from = $this->_tpl_vars['displacements']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['Year'] => $this->_tpl_vars['detail']):
?>
                            <div id="displacement_<?php echo $this->_tpl_vars['Year']; ?>
" style="display:none; background:#fff; text-align:center; width:100%">
                                <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                    <?php $_from = $this->_tpl_vars['displacements'][$this->_tpl_vars['Year']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['year'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td width="12%">
                                                <select name="CountryID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="CountryID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" style="width:90%;">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['item']['CountryID'] == $this->_tpl_vars['key2']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item2']['CountryName']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="12%;"><input type="text" name="Location_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="Location_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" value="<?php echo $this->_tpl_vars['item']['Location']; ?>
"
                                                                    size="12" style="width:90%;"></td>

                                            <td width="12%;">
                                                <select name="ProjectID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="ProjectID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" style="width:100%;">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Proiect'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['projects']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['item2']['ProjectID']; ?>
" <?php if ($this->_tpl_vars['item']['ProjectID'] == $this->_tpl_vars['item2']['ProjectID']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item2']['Name']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td width="12%;">
                                                <select name="CostCenterID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="CostCenterID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" style="width:100%;">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Centru cost'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['item']['CostCenterID'] == $this->_tpl_vars['key2']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <td nowrap="nowrap" width="16%;">
                                                <input type="text" name="StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" class="formstyle"
                                                       value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
                                                <input type="text" id="StartHour_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
" size="5"
                                                       maxlength="5" style="font-weight: bold;">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
">
                                                    var cal1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
 = new CalendarPopup();
                                                    cal1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td nowrap="nowrap" width="16%;">
                                                <input type="text" name="StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" id="StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" class="formstyle"
                                                       value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
                                                <input type="text" id="StopHour_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%H:%M') : smarty_modifier_date_format($_tmp, '%H:%M')); ?>
" size="5"
                                                       maxlength="5" style="font-weight: bold;">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
">
                                                    var cal2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
 = new CalendarPopup();
                                                    cal2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.isShowNavigationDropdowns = true;
                                                    cal2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.setYearSelectStartOffset(10);
                                                    //writeSource("js2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
");
                                                </SCRIPT>
                                                <A HREF="#"
                                                   onClick="cal2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
','dd.MM.yyyy'); return false;"
                                                   NAME="anchor2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td align="center" width="5%;"><?php echo $this->_tpl_vars['item']['Sum']; ?>
</td>
                                            <td align="center" width="5%;"><a href="#"
                                                                              onclick="getCost(<?php echo $_GET['PersonID']; ?>
, <?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
); return false;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CostTotal'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</a>
                                            </td>
                                            <td width="5%">
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (!is_empty(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value) && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value, '<?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
') && !is_empty(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value) && checkDate(document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value, '<?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
')) window.location.href =    '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_displacement&DisplacementID=<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
' + '&CountryID=' + document.getElementById('CountryID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value +                                                                                                                                                                                                                                                        '&Location=' + escape(document.getElementById('Location_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value) +                                                                                                                                                                                                                                                    '&ProjectID=' + document.getElementById('ProjectID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value +                                                                                                                                                                                                                                                    '&CostCenterID=' + document.getElementById('CostCenterID_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value +                                                                                                                                                                                                                                                    '&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value + ' ' + document.getElementById('StartHour_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value +                                                                                                                                                                                                                                                    '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value + ' ' + document.getElementById('StopHour_<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
').value;                                                                                                                                                                                                                                                                else alert('Nu ati specificat toate informatiile despre deplasare!'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica deplasare'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td width="5%">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_displacement&DisplacementID=<?php echo $this->_tpl_vars['item']['DisplacementID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge deplasare'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                </table>
                            </div>
                        <?php endforeach; endif; unset($_from); ?>
                    <?php endif; ?>
                </fieldset>
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
    function getCost(persid, displacementid) {
        showInfo(\'./?m=persons&o=displacement_cost&PersonID=\' + persid + \'&DisplacementID=\' + displacementid, \'layer_displacement_content\');
        document.getElementById(\'layer_displacement\').style.display = \'block\';
        document.getElementById(\'layer_displacement_x\').style.display = \'block\';
    }

    function validCost(id) {
        if (document.getElementById(\'CostSubtype_\' + id).value == 0) {
            alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat tipul cheltuielii'), $this);?>
<?php echo '!\');
            return false;
        }
        if (is_empty(document.getElementById(\'Cost_\' + id).value)) {
            alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat valoarea'), $this);?>
<?php echo '!\');
            return false;
        }
        if (is_empty(document.getElementById(\'CostDate_\' + id).value)) {
            alert(\''; ?>
<?php echo smarty_function_translate(array('label' => 'Nu ati completat data'), $this);?>
<?php echo '!\');
            return false;
        }
        return true;
    }
</script>
'; ?>