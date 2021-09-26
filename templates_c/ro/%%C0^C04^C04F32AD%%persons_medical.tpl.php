<?php /* Smarty version 2.6.18, created on 2020-12-02 02:37:03
         compiled from persons_medical.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_medical.tpl', 6, false),array('modifier', 'count', 'persons_medical.tpl', 47, false),array('modifier', 'date_format', 'persons_medical.tpl', 70, false),array('modifier', 'escape', 'persons_medical.tpl', 95, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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

    <div class="saveObservatii" style="margin-top: 4px">
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
            <td colspan="3" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="3" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Fisa de aptitudini'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['medical']['1']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['medical']['1']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['medical']['1']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_1">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f1_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>
                            <tr>
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
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes1_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes1_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                        onclick="getNotes('Notes1_<?php echo $this->_tpl_vars['key']; ?>
','Comentarii'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="1">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')&&checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.EndDate.value, 'Data')) document.f1_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica adeverinta'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge adeverinta'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')&&checkDate(document.f1_<?php echo $this->_tpl_vars['key']; ?>
.EndDate.value, 'Data')) document.f1_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga adeverinta'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['medical']['1']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
            <p style="padding: 10px"><input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle"></p>
        </td>
        <td class="celulaMenuST" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend>SSM</legend>
                <?php $_from = $this->_tpl_vars['medical']['2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['medical']['2']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['medical']['2']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_2">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f2_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Comentarii'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
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
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes2_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes2_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                        onclick="getNotes('Notes2_<?php echo $this->_tpl_vars['key']; ?>
','Comentarii'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="2">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f2_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f2_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica analiza'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge analiza'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#"
                                                                    onclick="if (checkDate(document.f2_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')) document.f2_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga analiza'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['medical']['2']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        </td>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding: 10px;" width="30%">
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'PSI'), $this);?>
</legend>
                <?php $_from = $this->_tpl_vars['medical']['3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                    <?php if (count($this->_tpl_vars['medical']['3']) > 1 && ($this->_foreach['iter']['iteration'] <= 1)): ?>
                    <?php endif; ?>
                    <?php if (count($this->_tpl_vars['medical']['3']) > 1 && $this->_foreach['iter']['iteration'] == 2): ?>
                        <div id="div_3">
                    <?php endif; ?>
                    <form style="margin-bottom:0px;" action="<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="f3_<?php echo $this->_tpl_vars['key']; ?>
">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <?php if (($this->_foreach['iter']['iteration'] <= 1)): ?>
                                <tr>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</td>
                                    <td width="110"><?php echo smarty_function_translate(array('label' => 'Traseu'), $this);?>
</td>
                                    <td>&nbsp;</td>
                                    <td>&nbsp;</td>
                                </tr>
                            <?php endif; ?>

                            <tr>
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
                                <td width="110px">
                                    <input name="Notes" type="hidden" id="Notes3_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes3_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                        onclick="getNotes('Notes3_<?php echo $this->_tpl_vars['key']; ?>
','Traseu de deplasare de/la serviciu'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    <input type="hidden" name="Type" value="3">
                                </td>
                                <?php if ($this->_tpl_vars['key'] > 0): ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="if (checkDate(document.f3_<?php echo $this->_tpl_vars['key']; ?>
.RegDate.value, 'Data')&&checkDate(document.f3_<?php echo $this->_tpl_vars['key']; ?>
.EndDate.value, 'Data')) document.f3_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&MedicalID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                <?php else: ?>
                                    <td width="20"><?php if ($this->_tpl_vars['medical']['0']['rw'] == 1): ?>
                                            <div id="button_add"><a href="#" onclick="document.f3_<?php echo $this->_tpl_vars['key']; ?>
.submit(); return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><b>Add</b></a>
                                            </div><?php endif; ?></td>
                                    <td width="20">&nbsp;</td>
                                <?php endif; ?>
                            </tr>
                        </table>
                    </form>
                    <?php if (count($this->_tpl_vars['medical']['3']) > 1 && $this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total']): ?>
                        </div>
                    <?php endif; ?>
                <?php endforeach; endif; unset($_from); ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="3" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>

<?php echo '
    <script type="text/javascript">

        function getNotes(id, title) {
            document.getElementById(\'layer_co_notes\').value = document.getElementById(id).value;
            document.getElementById(\'layer_co_notes_dest\').value = id;
            document.getElementById(\'layer_co\').style.display = \'block\';
            document.getElementById(\'layer_co_x\').style.display = \'block\';
            document.getElementById(\'layer_title\').innerHTML = title;
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