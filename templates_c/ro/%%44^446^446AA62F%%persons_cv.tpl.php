<?php /* Smarty version 2.6.18, created on 2020-12-02 03:50:44
         compiled from persons_cv.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_cv.tpl', 21, false),array('modifier', 'default', 'persons_cv.tpl', 26, false),array('modifier', 'date_format', 'persons_cv.tpl', 70, false),array('modifier', 'escape', 'persons_cv.tpl', 156, false),)), $this); ?>
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
    <tr>
        <td colspan="2" class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-right: 10px;">
            <br>
            <fieldset>
                <legend>CV</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
:</td>
                        <td><b><?php echo $this->_tpl_vars['info']['FullName']; ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</td>
                        <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Mobil personal'), $this);?>
:</td>
                        <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['MobilePersonal'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</td>
                        <td><b><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Stare civila'), $this);?>
:</td>
                        <td><b><?php echo $this->_tpl_vars['marital_status'][$this->_tpl_vars['info']['MaritalStatus']]; ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
:</td>
                        <td><b><?php echo $this->_tpl_vars['info']['DistrictName']; ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
:</td>
                        <td><b><?php echo $this->_tpl_vars['info']['CityName']; ?>
</b></td>
                    </tr>
                    <tr>
                        <td><?php echo smarty_function_translate(array('label' => 'Adresa'), $this);?>
:</td>
                        <td><b>Cod postal: <?php echo $this->_tpl_vars['info']['StreetCode']; ?>
, Strada: <?php echo $this->_tpl_vars['info']['StreetName']; ?>
, Nr. <?php echo $this->_tpl_vars['info']['StreetNumber']; ?>
</b></td>
                    </tr>
                </table>
                <br>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <?php if (! empty ( $this->_tpl_vars['internal_functionsh'] )): ?>
                        <tr valign="top">
                            <td>
                                <fieldset>
                                    <legend><?php echo smarty_function_translate(array('label' => 'Istoric functii'), $this);?>
</legend>
                                    <table border="0" cellpadding="4" cellspacing="0">
                                        <tr>
                                            <td><?php echo smarty_function_translate(array('label' => 'Functia'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Perioada'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
</td>
                                        </tr>
                                        <?php $_from = $this->_tpl_vars['internal_functionsh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                                            <?php if ($this->_tpl_vars['item']['FunctionID'] > 0): ?>
                                                <tr>
                                                    <td><?php $_from = $this->_tpl_vars['internal_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?><?php if (isset ( $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']] )): ?><?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['Function']; ?>
 [<?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['GroupName']; ?>
 | <?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['Grad']; ?>
]<?php endif; ?><?php endforeach; endif; unset($_from); ?></td>
                                                    <td><?php if ($this->_tpl_vars['item']['StartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?>
                                                        : <?php if ($this->_tpl_vars['item']['EndDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?></td>
                                                    <td><?php echo $this->_tpl_vars['info']['CompanyName']; ?>
</td>
                                                </tr>
                                            <?php endif; ?>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </table>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <?php if (! empty ( $this->_tpl_vars['info']['trainings'] )): ?>
                        <tr valign="top">
                            <td>
                                <fieldset>
                                    <legend><?php echo smarty_function_translate(array('label' => 'Traininguri efectuate'), $this);?>
</legend>
                                    <table border="0" cellpadding="4" cellspacing="0" width="100%">
                                        <tr>
                                            <td><?php echo smarty_function_translate(array('label' => 'Perioada'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Denumire training'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Companie training'), $this);?>
</td>
                                        </tr>
                                        <?php $_from = $this->_tpl_vars['info']['trainings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                            <tr>
                                                <td><?php echo $this->_tpl_vars['item']['StartDate']; ?>
 : <?php echo $this->_tpl_vars['item']['StopDate']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['item']['TrainingName']; ?>
</td>
                                                <td><?php echo $this->_tpl_vars['info']['CompanyName']; ?>
</td>
                                            </tr>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </table>
                                </fieldset>
                            </td>
                        </tr>
                    <?php endif; ?>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Experienta profesionala'), $this);?>
</legend>
                                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data de inceput'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Data de sfarsit'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Domeniu'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['prof_exp']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr bgcolor="#efefef">
                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_prof&ProfID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="prof_<?php echo $this->_tpl_vars['key']; ?>
">
                                                <td>
                                                    <input type="text" id="StartDate" name="StartDate" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
                                                           maxlength="10">
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
.select(document.prof_<?php echo $this->_tpl_vars['key']; ?>
.StartDate,'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                       NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td>
                                                    <input type="text" id="StopDate" name="StopDate" class="formstyle" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" size="10"
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
.select(document.prof_<?php echo $this->_tpl_vars['key']; ?>
.StopDate,'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                       NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                </td>
                                                <td><input type="text" name="Company" value="<?php echo $this->_tpl_vars['item']['Company']; ?>
"/></td>
                                                <td><select name="DomainID" class="dropdown">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege domeniul'), $this);?>
</option><?php $_from = $this->_tpl_vars['jobdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['DomainID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <td><select name="FunctionIDRecr" class="dropdown">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege functia'), $this);?>
</option><?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['FunctionIDRecr']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <td>&nbsp;</td>
                                                <td>&nbsp;</td>
                                        </tr>
                                        <tr bgcolor="#efefef">
                                            <td colspan="7">
                                                <?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
 <input type="text" name="City" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['City'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="50" maxlength="64"
                                                                                      style="font-size: 10px;">
                                                &nbsp;&nbsp;&nbsp;
                                                <?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
 <input type="text" name="Country" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Country'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="50" maxlength="64"
                                                                                style="font-size: 10px;">
                                            </td>
                                        </tr>
                                        <tr bgcolor="#efefef">
                                            <td colspan="5"><textarea name="Responsabilities"
                                                                      style="width:900px; height: 50px; font-size: 10px;"><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Responsabilities'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
</textarea></td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#" onclick="document.prof_<?php echo $this->_tpl_vars['key']; ?>
.submit();"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica experienta'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_prof&ProfID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                            onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge experienta'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                            </form>
                                        </tr>
                                        <tr>
                                            <td colspan="7"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="7" style="border-top: 1px dashed #cccccc;"><span style="font-size: 1px;">&nbsp;</span></td>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_prof" method="post" name="prof_0">
                                            <td>
                                                <input type="text" id="StartDate" name="StartDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                                    var cal1_0 = new CalendarPopup();
                                                    cal1_0.isShowNavigationDropdowns = true;
                                                    cal1_0.setYearSelectStartOffset(10);
                                                    //writeSource("js1_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal1_0.select(document.prof_0.StartDate,'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                                   ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td>
                                                <input type="text" id="StopDate" name="StopDate" class="formstyle" value="" size="10" maxlength="10">
                                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                                    var cal2_0 = new CalendarPopup();
                                                    cal2_0.isShowNavigationDropdowns = true;
                                                    cal2_0.setYearSelectStartOffset(10);
                                                    //writeSource("js2_0");
                                                </SCRIPT>
                                                <A HREF="#" onClick="cal2_0.select(document.prof_0.StopDate,'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                                            </td>
                                            <td><input type="text" name="Company" value=""/></td>
                                            <td><select name="DomainID" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege domeniul'), $this);?>
</option><?php $_from = $this->_tpl_vars['jobdomains']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><select name="FunctionIDRecr" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege functia'), $this);?>
</option><?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td>&nbsp;</td>
                                            <td>&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td colspan="7">
                                            Localitate <input type="text" name="City" size="50" maxlength="64" style="font-size: 10px;">
                                            &nbsp;&nbsp;&nbsp;
                                            Tara <input type="text" name="Country" size="50" maxlength="64" style="font-size: 10px;">
                                        </td>
                                    </tr>
                                    <tr>
                                        <td colspan="5"><textarea name="Responsabilities" style="width:900px; height: 50px; font-size: 10px;">Responsabilitati</textarea></td>
                                        <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="document.prof_0.submit();"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga experienta'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                        <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Studii'), $this);?>
</legend>
                                <table border="0" cellpadding="4" cellspacing="0" width="100%">
                                    <tr>
                                                                                <td><?php echo smarty_function_translate(array('label' => 'Durata'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Institutie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Specializare'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Domeniu'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Program de studii'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'An absolvire'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Diploma obtinuta'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Serie si numar'), $this);?>
</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['std']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_std&StdID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="std_<?php echo $this->_tpl_vars['key']; ?>
">
                                                                                                <td>
                                                    <select name="Durata" class="dropdown">
                                                        <option value="0">- alege -</option>
                                                        <option value="3 ani" <?php if ($this->_tpl_vars['item']['Durata'] == '3 ani'): ?>selected<?php endif; ?>>3 ani</option>
                                                        <option value="4 ani" <?php if ($this->_tpl_vars['item']['Durata'] == '4 ani'): ?>selected<?php endif; ?>>4 ani</option>
                                                        <option value="5 ani" <?php if ($this->_tpl_vars['item']['Durata'] == '5 ani'): ?>selected<?php endif; ?>>5 ani</option>
                                                        <option value="6 ani" <?php if ($this->_tpl_vars['item']['Durata'] == '6 ani'): ?>selected<?php endif; ?>>6 ani</option>
                                                        <option value="1 semestru" <?php if ($this->_tpl_vars['item']['Durata'] == '1 semestru'): ?>selected<?php endif; ?>>1 semestru</option>
                                                        <option value="2 semestre" <?php if ($this->_tpl_vars['item']['Durata'] == '2 semestre'): ?>selected<?php endif; ?>>2 semestre</option>
                                                        <option value="3 semestre" <?php if ($this->_tpl_vars['item']['Durata'] == '3 semestre'): ?>selected<?php endif; ?>>3 semestre</option>
                                                        <option value="4 semestre" <?php if ($this->_tpl_vars['item']['Durata'] == '4 semestre'): ?>selected<?php endif; ?>>4 semestre</option>
                                                    </select>
                                                </td>
                                                <td><input type="text" name="Institution" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Institution'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="255"></td>
                                                <td><input type="text" name="Specialization" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Specialization'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="255"></td>
                                                <td><input type="text" name="Domeniu" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Domeniu'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="10" maxlength="255"></td>
                                                <td><input type="text" name="Program" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Program'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="10" maxlength="255"></td>
                                                <td><input type="text" name="An" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['An'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="10" maxlength="255"></td>
                                                <td><input type="text" name="Diploma" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Diploma'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="255"></td>
                                                <td><input type="text" name="SerieNo" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['SerieNo'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'html') : smarty_modifier_escape($_tmp, 'html')); ?>
" size="20" maxlength="255"></td>
                                                <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <td>
                                                        <div id="button_mod"><a href="#" onclick="document.std_<?php echo $this->_tpl_vars['key']; ?>
.submit();"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica studiu'), $this);?>
"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_std&StdID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                                onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge studiu'), $this);?>
"><b>Del</b></a></div>
                                                    </td>
                                                <?php else: ?>
                                                    <td colspan="2">&nbsp;</td>
                                                <?php endif; ?>
                                            </form>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_std" method="post" name="std_0">
                                                                                        <td>
                                                <select name="Durata" class="dropdown">
                                                    <option value="0">- alege -</option>
                                                    <option value="3 ani">3 ani</option>
                                                    <option value="4 ani">4 ani</option>
                                                    <option value="5 ani">5 ani</option>
                                                    <option value="6 ani">6 ani</option>
                                                    <option value="1 semestru">1 semestru</option>
                                                    <option value="2 semestre">2 semestre</option>
                                                    <option value="3 semestre">3 semestre</option>
                                                    <option value="4 semestre">4 semestre</option>
                                                </select>
                                            </td>
                                            <td><input type="text" name="Institution" size="20" maxlength="255"></td>
                                            <td><input type="text" name="Specialization" size="20" maxlength="255"></td>
                                            <td><input type="text" name="Domeniu" size="10" maxlength="255"></td>
                                            <td><input type="text" name="Program" size="10" maxlength="255"></td>
                                            <td><input type="text" name="An" size="10" maxlength="255"></td>
                                            <td><input type="text" name="Diploma" size="20" maxlength="255"></td>
                                            <td><input type="text" name="SerieNo" size="20" maxlength="255"></td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_add"><a href="#"
                                                                            onclick="document.std_0.submit();"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga studiu'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Limbii straine'), $this);?>
</legend>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Limba straina'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Citit'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Scris'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Vorbit'), $this);?>
</td>
                                        <td>&nbsp;</td>
                                        <td>&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['lang']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_lang&LangID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="lang_<?php echo $this->_tpl_vars['key']; ?>
">
                                                <td><select name="Lang">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege limba'), $this);?>
</option><?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['Lang']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <td><select name="ReadLevel">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['ReadLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <td><select name="WriteLevel">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['WriteLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <td><select name="SpeakLevel">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']['SpeakLevel']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <td>
                                                        <div id="button_mod"><a href="#"
                                                                                onclick="if (document.lang_<?php echo $this->_tpl_vars['key']; ?>
.Lang.selectedIndex>0 && document.lang_<?php echo $this->_tpl_vars['key']; ?>
.ReadLevel.selectedIndex>0 && document.lang_<?php echo $this->_tpl_vars['key']; ?>
.WriteLevel.selectedIndex>0 && document.lang_<?php echo $this->_tpl_vars['key']; ?>
.SpeakLevel.selectedIndex>0) document.lang_<?php echo $this->_tpl_vars['key']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Alegeti Limba, nivelul pentru citit, scris si vorbit!'), $this);?>
'); return false;"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica limba straina'), $this);?>
"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_lang&LangID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                                onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge limba straina'), $this);?>
"><b>Del</b></a></div>
                                                    </td>
                                                <?php else: ?>
                                                    <td colspan="2">&nbsp;</td>
                                                <?php endif; ?>
                                            </form>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_lang" method="post" name="lang_0">
                                            <td><select name="Lang">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege limba'), $this);?>
</option><?php $_from = $this->_tpl_vars['languages']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><select name="ReadLevel">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><select name="WriteLevel">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><select name="SpeakLevel">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option><?php $_from = $this->_tpl_vars['lang_level']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_add"><a href="#"
                                                                            onclick="if (document.lang_0.Lang.selectedIndex>0 && document.lang_0.ReadLevel.selectedIndex>0 && document.lang_0.WriteLevel.selectedIndex>0 && document.lang_0.SpeakLevel.selectedIndex>0) document.lang_0.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Alegeti Limba, nivelul pentru citit, scris si vorbit!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga limba straina'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <fieldset>
                                <legend><?php echo smarty_function_translate(array('label' => 'Pozitii de interes'), $this);?>
</legend>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <?php $_from = $this->_tpl_vars['func_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit_func_recr&ID=<?php echo $this->_tpl_vars['key']; ?>
" method="post" name="func_<?php echo $this->_tpl_vars['key']; ?>
">
                                                <td><select name="FunctionIDRecr">
                                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege functia'), $this);?>
</option><?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                                <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <td>
                                                        <div id="button_mod"><a href="#"
                                                                                onclick="if (document.func_<?php echo $this->_tpl_vars['key']; ?>
.FunctionIDRecr.selectedIndex>0) document.func_<?php echo $this->_tpl_vars['key']; ?>
.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Alegeti functia!'), $this);?>
'); return false;"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica functia'), $this);?>
"><b>Mod</b></a></div>
                                                    </td>
                                                    <td>
                                                        <div id="button_del"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del_func_recr&ID=<?php echo $this->_tpl_vars['key']; ?>
"
                                                                                onclick="return confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
');"
                                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge functia'), $this);?>
"><b>Del</b></a></div>
                                                    </td>
                                                <?php else: ?>
                                                    <td colspan="2">&nbsp;</td>
                                                <?php endif; ?>
                                            </form>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new_func_recr" method="post" name="func_0">
                                            <td><select name="FunctionIDRecr">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege functia'), $this);?>
</option><?php $_from = $this->_tpl_vars['functions_recr']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option><?php endforeach; endif; unset($_from); ?></select></td>
                                            <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                    <div id="button_add"><a href="#"
                                                                            onclick="if (document.func_0.FunctionIDRecr.selectedIndex>0) document.func_0.submit(); else alert('<?php echo smarty_function_translate(array('label' => 'Alegeti functia!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga functie'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                                            <td></td>
                                        </form>
                                    </tr>
                                </table>
                            </fieldset>
                        </td>
                    </tr>
                    <tr valign="top">
                        <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="cv">
                            <td>
                                <b><?php echo smarty_function_translate(array('label' => 'Calificari relevante'), $this);?>
:</b>
                                <br>
                                <textarea name="CVQualifRel" rows="8" cols="120" wrap="soft"><?php echo $this->_tpl_vars['info']['CVQualifRel']; ?>
</textarea>
                            </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b><?php echo smarty_function_translate(array('label' => 'Cursuri'), $this);?>
:</b>
                            <br>
                            <textarea name="CVCourses" rows="8" cols="120" wrap="soft"><?php echo $this->_tpl_vars['info']['CVCourses']; ?>
</textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b><?php echo smarty_function_translate(array('label' => 'Aptitudini'), $this);?>
:</b>
                            <br>
                            <textarea name="CVSkills" rows="8" cols="120" wrap="soft"><?php echo $this->_tpl_vars['info']['CVSkills']; ?>
</textarea>
                        </td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <b><?php echo smarty_function_translate(array('label' => 'Hobby-uri'), $this);?>
:</b>
                            <br>
                            <textarea name="CVHobby" rows="4" cols="120" wrap="soft"><?php echo $this->_tpl_vars['info']['CVHobby']; ?>
</textarea>
                        </td>
                    </tr>
                    <tr>
                        <td align="left">
                            <br>
                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
"><?php endif; ?>&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Printeaza'), $this);?>
" onclick="window.open('<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print', 'print')">
                            <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Printeaza'), $this);?>
 EuroPass"
                                   onclick="window.open('<?php echo $_SERVER['REQUEST_URI']; ?>
&action=print_euro', 'print_euro')">&nbsp;&nbsp;&nbsp;&nbsp;
                            <input type="button" value="Export .doc" onclick="window.open('<?php echo $_SERVER['REQUEST_URI']; ?>
&action=export', 'export')">
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
</form>