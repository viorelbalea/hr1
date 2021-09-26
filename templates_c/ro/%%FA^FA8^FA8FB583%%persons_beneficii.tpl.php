<?php /* Smarty version 2.6.18, created on 2020-09-21 09:38:40
         compiled from persons_beneficii.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_beneficii.tpl', 6, false),array('modifier', 'count', 'persons_beneficii.tpl', 49, false),array('modifier', 'date_format', 'persons_beneficii.tpl', 86, false),array('modifier', 'escape', 'persons_beneficii.tpl', 122, false),)), $this); ?>
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
<br/>
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
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Asigurari de sanatate'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['1']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_1').style.display; if (status == 'none') Effect.SlideDown('div_1'); else Effect.SlideUp('div_1'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric asigurari de sanatate '), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['1']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_1" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f1_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
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
.select(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js12_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal12_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal12_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal12_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js12_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal12_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor12_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor12_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor12_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250px;">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110px;" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes1_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes1_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes1_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="1">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f1_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f1_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['1']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Asigurari de viata'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['2']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_2').style.display; if (status == 'none') Effect.SlideDown('div_2'); else Effect.SlideUp('div_2'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric asigurari de viata'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['2']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_2" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f2_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
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
.select(document.f2_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js22_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal22_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal22_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal22_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js22_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal22_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f2_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor22_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor22_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor22_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes2_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes2_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes2_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="2">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f2_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f2_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f2_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['2']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Pensie privata'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['3']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_3').style.display; if (status == 'none') Effect.SlideDown('div_3'); else Effect.SlideUp('div_3'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric pensie privata'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['3']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_3" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f3_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal3_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal3_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal3_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js3_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f3_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor3_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor3_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor3_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js32_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal32_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal32_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal32_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js32_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal32_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f3_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor32_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor32_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor32_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes3_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes3_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes3_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="3">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f3_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f3_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f3_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['3']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Bonuri de masa'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['4']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['4']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_4').style.display; if (status == 'none') Effect.SlideDown('div_4'); else Effect.SlideUp('div_4'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric bonuri de masa'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['4']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_4" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f4_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal4_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal4_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal4_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js4_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f4_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor4_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor4_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor4_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js42_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal42_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal42_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal42_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js42_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal42_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f4_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor42_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor42_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor42_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes4_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes4_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes4_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="4">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f4_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f4_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f4_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['4']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Asigurare stomatologica'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['5']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['5']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_5').style.display; if (status == 'none') Effect.SlideDown('div_5'); else Effect.SlideUp('div_5'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric asigurare stomatologica'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['5']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_5" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f5_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js5_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal5_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal5_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal5_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js5_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal5_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f5_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor5_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor5_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor5_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js52_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal52_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal52_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal52_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js52_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal52_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f5_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor52_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor52_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor52_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">alege...</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes5_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes5_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes5_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="5">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f5_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f5_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f5_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['5']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Tichete cadou'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['6']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['6']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_6').style.display; if (status == 'none') Effect.SlideDown('div_6'); else Effect.SlideUp('div_6'); return false;"><b>Istoric
                                    tichete cadou</b></a></p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['6']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_6" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f6_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal6_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal6_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal6_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js6_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f6_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor6_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor6_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor6_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js62_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal62_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal62_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal62_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js62_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal62_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f6_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor62_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor62_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor62_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0">alege...</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes6_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes6_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes6_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="6">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f6_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f6_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f6_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['6']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Outplacement'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['7']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['7']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_7').style.display; if (status == 'none') Effect.SlideDown('div_7'); else Effect.SlideUp('div_7'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric outplacement'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['7']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_7" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f7_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal7_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal7_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal7_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js7_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal7_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f7_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor7_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor7_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor7_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js72_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal72_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal72_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal72_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js72_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal72_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f7_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor72_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor72_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor72_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes7_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes7_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes7_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="7">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f7_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f7_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f7_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['7']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Traininguri'), $this);?>
</legend>
                <?php if (count($this->_tpl_vars['ben']['8']) > 0): ?>
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_8').style.display; if (status == 'none') Effect.SlideDown('div_8'); else Effect.SlideUp('div_8'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric Traininguri'), $this);?>
</b></a>
                    </p>
                <?php endif; ?>
                <div id="div_8" style="display:none;">
                    <?php $_from = $this->_tpl_vars['ben']['8']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f8_<?php echo $this->_tpl_vars['key']; ?>
">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost per training'), $this);?>
: <br/>
                                        <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10" readonly="true"
                                               style="background-color:#CCCCCC;">
                                    </td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
: <br/>
                                        <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
: <br/>
                                        <input type="text" name="RegDate" class="formstyle"
                                               value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                                                            </td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
:<br/>
                                        <input type="text" name="EndDate" class="formstyle"
                                               value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                                                            </td>
                                    <td> <?php echo smarty_function_translate(array('label' => 'Firma training'), $this);?>
: <br/>
                                        <select name="CompanyID" style="background-color:#CCCCCC; width:150px;">
                                            <?php $_from = $this->_tpl_vars['companies_training'][$this->_tpl_vars['item']['CompanyID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item']['CompanyID']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td align="center"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
: <br/>
                                        <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                    </td>
                                    <td colspan="3"
                                        <?php if ($this->_foreach['iter']['iteration'] < $this->_foreach['iter']['total']): ?>style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"<?php endif; ?>>
                                        <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%;background-color:#CCCCCC;" readonly="true"><?php echo $this->_tpl_vars['item']['Notes']; ?>
</textarea>
                                        <input type="hidden" name="Type" value="8">
                                    </td>
                                    <?php if ($this->_tpl_vars['key'] > 0): ?>
                                        <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (checkDate(document.f8_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f8_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <?php else: ?>
                                        <td width="20">&nbsp;</td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </form>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Catering'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['9']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['9']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_9').style.display; if (status == 'none') Effect.SlideDown('div_9'); else Effect.SlideUp('div_9'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric catering'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['9']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_9" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f9_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js7_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal9_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal9_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal9_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js9_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal9_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f9_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor9_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor9_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor9_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js92_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal92_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal92_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal92_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js92_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal92_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f9_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor92_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor92_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor92_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes9_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes9_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes9_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="9">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f9_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f9_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f9_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['9']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'] - 1): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Sportiv'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['15']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['15']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_15').style.display; if (status == 'none') Effect.SlideDown('div_15'); else Effect.SlideUp('div_15'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric sportiv'), $this);?>
</b></a>
                        </p>
                        <div id="div_15" style="display:none;">
                    <?php endif; ?>
                    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f15_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr>
                                <td style="padding-top: 10px;" width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
: <br/>
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td style="padding-top: 10px;" width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
: <br/>
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td style="padding-top: 10px;" width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
: <br/>
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js15_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal15_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal15_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal15_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js15_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal15_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f15_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor15_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor15_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor15_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td style="padding-top: 10px;" width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
:<br/>
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js152_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal152_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal152_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal152_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js152_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal152_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f15_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor152_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor152_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor152_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td style="padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Firma'), $this);?>
: <br/>
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td colspan="3" <?php if ($this->_foreach['iter']['iteration'] < $this->_foreach['iter']['total']): ?>style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"<?php endif; ?>>
                                    <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%"><?php echo $this->_tpl_vars['item']['Notes']; ?>
</textarea>
                                    <input type="hidden" name="Type" value="15">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f15_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f15_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f15_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['15']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'] - 1): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Masina serviciu'), $this);?>
</legend>
                <?php if (count($this->_tpl_vars['ben']['10']) > 0): ?>
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_10').style.display; if (status == 'none') Effect.SlideDown('div_10'); else Effect.SlideUp('div_10'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric beneficii Masina serviciu'), $this);?>
</b></a>
                    </p>
                <?php endif; ?>
                <div id="div_10" style="display:none;">
                    <?php $_from = $this->_tpl_vars['ben']['10']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f10_<?php echo $this->_tpl_vars['key']; ?>
">
                            <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
: <br/>
                                        <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10" readonly="true"
                                               style="background-color:#CCCCCC;">
                                    </td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
: <br/>
                                        <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
: <br/>
                                        <input type="text" name="RegDate" class="formstyle"
                                               value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                                                            </td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
:<br/>
                                        <input type="text" name="EndDate" class="formstyle"
                                               value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                               maxlength="10" readonly="true" style="background-color:#CCCCCC;">
                                                                            </td>
                                    <td> <?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
: <br/>
                                        <select name="CompanyID" style="background-color:#CCCCCC; width:150px;">
                                            <?php $_from = $this->_tpl_vars['companies_training'][$this->_tpl_vars['item']['CompanyID']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                <option value="<?php echo $this->_tpl_vars['item']['CompanyID']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                            <?php endforeach; endif; unset($_from); ?>
                                        </select>
                                    </td>
                                    <td colspan="3"
                                        <?php if ($this->_foreach['iter']['iteration'] < $this->_foreach['iter']['total']): ?>style="padding-bottom: 6px; border-bottom: 1px solid #cccccc;"<?php endif; ?>>
                                        <textarea name="Notes" rows="2" cols="40" wrap="soft" style="width: 100%;background-color:#CCCCCC;" readonly="true"><?php echo $this->_tpl_vars['item']['Notes']; ?>
</textarea>
                                        <input type="hidden" name="Type" value="10">
                                    </td>
                                    <?php if ($this->_tpl_vars['key'] > 0): ?>
                                        <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (checkDate(document.f10_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f10_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <?php else: ?>
                                        <td width="20">&nbsp;</td>
                                    <?php endif; ?>
                                </tr>
                            </table>
                        </form>
                    <?php endforeach; endif; unset($_from); ?>
                </div>
            </fieldset>

            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Sportiv'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['11']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['11']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_11').style.display; if (status == 'none') Effect.SlideDown('div_11'); else Effect.SlideUp('div_11'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric sportiv'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['11']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_11" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f11_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js11_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal11_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal11_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal11_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js11_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal11_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f11_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor11_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor11_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor11_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js112_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal112_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal112_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal112_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js112_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal112_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f11_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor112_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor112_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor112_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes11_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes11_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes11_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="11">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f11_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f11_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f11_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['11']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <br/>
            <!-- Pensii facultative -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Pensii facultative'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['12']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['12']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_12').style.display; if (status == 'none') Effect.SlideDown('div_12'); else Effect.SlideUp('div_12'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric pensii facultative'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['12']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_12" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f12_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js12_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal12_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal12_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal12_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js12_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal12_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f12_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor12_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor12_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor12_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js122_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal122_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal122_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal122_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js122_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal122_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f12_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor122_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor122_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor122_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes12_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes12_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes12_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="12">
                                </td>

                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f12_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f12_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f12_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['12']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>

            <!-- Avantaj natura -->
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Avantaj natura'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['ben']['13']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['ben']['13']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                        <p><a href="#"
                              onclick="var status = document.getElementById('div_13').style.display; if (status == 'none') Effect.SlideDown('div_13'); else Effect.SlideUp('div_13'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric avantaj natura'), $this);?>
</b></a>
                        </p>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['ben']['13']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_13" style="display:none;">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f13_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="120"><?php echo smarty_function_translate(array('label' => 'Cost lunar contract'), $this);?>
</td>
                                    <td width="100"><?php echo smarty_function_translate(array('label' => 'Moneda'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="250"><?php echo smarty_function_translate(array('label' => 'Firma asiguratoare'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Retinere salariu'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
                                <td width="120">
                                    <input type="text" name="TotalCost" class="formstyle" value="<?php echo $this->_tpl_vars['item']['TotalCost']; ?>
" size="16" maxlength="10">
                                </td>
                                <td width="100">
                                    <select id="Currency_<?php echo $this->_tpl_vars['item']['SalaryID']; ?>
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
                                <td width="110">
                                    <input type="text" name="RegDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['RegDate'] ) && $this->_tpl_vars['item']['RegDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['RegDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js13_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal13_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal13_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal13_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js13_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal13_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f13_<?php echo $this->_tpl_vars['key']; ?>
.RegDate,'anchor13_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor13_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor13_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="110">
                                    <input type="text" name="EndDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '00-00-0000'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js132_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal132_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal132_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal132_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js132_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal132_<?php echo $this->_tpl_vars['key']; ?>
.select(document.f13_<?php echo $this->_tpl_vars['key']; ?>
.EndDate,'anchor132_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;" NAME="anchor132_<?php echo $this->_tpl_vars['key']; ?>
"
                                       ID="anchor132_<?php echo $this->_tpl_vars['key']; ?>
"><img border="0" src="./images/cal.png"></A>
                                </td>
                                <td width="250">
                                    <select name="CompanyID">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                                <td width="110" align="center">
                                    <input type="checkbox" name="Retained" value="1" <?php if ($this->_tpl_vars['item']['Retained'] == 1): ?> checked="checked"<?php endif; ?>/>
                                </td>
                                <td width="110">
                                    <input name="Notes" type="hidden" id="Notes13_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes13_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes13_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="13">
                                </td>

                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f13_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f13_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&BenID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['ben']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f13_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['ben']['13']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
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

    </script>
'; ?>
