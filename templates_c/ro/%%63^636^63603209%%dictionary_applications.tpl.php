<?php /* Smarty version 2.6.18, created on 2020-10-06 05:30:08
         compiled from dictionary_applications.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_applications.tpl', 6, false),array('modifier', 'date_format', 'dictionary_applications.tpl', 146, false),array('modifier', 'escape', 'dictionary_applications.tpl', 161, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
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

<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Aplicatii'), $this);?>
</span></td>
    </tr>
    <tr>
        <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px;">
            <br>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Aplicatii'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <table border="0" cellpadding="4" cellspacing="0">
                                <?php $_from = $this->_tpl_vars['applications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <tr>
                                        <td><input type="text" id="App_<?php echo $this->_tpl_vars['key']; ?>
" name="App_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']; ?>
" size="25" maxlength="128"></td>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $this->_tpl_vars['key']; ?>
&App=' + escape(document.getElementById('App_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica aplicatie'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Stergerea unei aplicatii implica stergerea tuturor modulelor si versiunilor aferente.\nSunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $this->_tpl_vars['key']; ?>
&delApp=1'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge aplicatie'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        <?php endif; ?>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>

                                <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                    <tr>
                                        <td><input type="text" id="App_0" name="App_0" size="25" maxlength="128"></td>
                                        <td colspan="2">
                                            <div id="button_add"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=applications&AppID=0&App=' + escape(document.getElementById('App_0').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Adauga aplicatie'), $this);?>
"><b>Add</b></a></div>
                                        </td>
                                    </tr>
                                <?php endif; ?>
                            </table>
                        </td>
                    </tr>
                </table>
            </fieldset>
        </td>

        <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
            <br/>
            <fieldset>
                <legend><?php echo smarty_function_translate(array('label' => 'Module si Versiuni'), $this);?>
</legend>
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td>
                            <select name="applications" onchange="if (this.value>0) window.location.href='./?m=dictionary&o=applications&AppID=' + this.value">
                                <option value=""><?php echo smarty_function_translate(array('label' => 'alege aplicatia'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['applications']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['AppID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </td>
                    </tr>
                </table>
                <br/>
                <?php if (! empty ( $_GET['AppID'] )): ?>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Module'), $this);?>
</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>Modul</td>
                                <td colspan="3"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>
                            </tr>

                            <?php $_from = $this->_tpl_vars['app_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text" id="Module_<?php echo $this->_tpl_vars['key']; ?>
" name="Module_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Module']; ?>
" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_<?php echo $this->_tpl_vars['key']; ?>
" name="Notes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
" size="30" maxlength="255"></td>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod"><a href="#"
                                                                    onclick="window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&ModuleID=<?php echo $this->_tpl_vars['key']; ?>
&Module=' + escape(document.getElementById('Module_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica modul'), $this);?>
"><b>Mod</b></a></div>
                                        </td>
                                        <td>
                                            <div id="button_del"><a href="#"
                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&ModuleID=<?php echo $this->_tpl_vars['key']; ?>
&delModule=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge modul'), $this);?>
"><b>Del</b></a></div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>

                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <tr>
                                    <td><input type="text" id="Module_0" name="Module_0" size="20" maxlength="32"></td>
                                    <td><input type="text" id="Notes_0" name="Notes_0" size="30" maxlength="255"></td>
                                    <td colspan="2">
                                        <div id="button_add"><a href="#"
                                                                onclick="window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&ModuleID=0&Module=' + escape(document.getElementById('Module_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Adauga modul'), $this);?>
"><b>Add</b></a></div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                    <br/>
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Versiuni'), $this);?>
</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><?php echo smarty_function_translate(array('label' => 'Versiune'), $this);?>
</td>
                                <td style="width:120px;"><?php echo smarty_function_translate(array('label' => 'Data Livrare'), $this);?>
</td>
                                <td style="width:70px;"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>
                                <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['app_versions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text" id="VersionName_<?php echo $this->_tpl_vars['key']; ?>
" name="VersionName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['VersionName']; ?>
" style="width:100px;" maxlength="255"></td>
                                    <td>
                                        <input type="text" id="VersionLivrare_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"
                                               value="<?php if (! empty ( $this->_tpl_vars['item']['VersionLivrare'] ) && $this->_tpl_vars['item']['VersionLivrare'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['VersionLivrare'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                               size="10" maxlength="10"/>
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
.select(document.getElementById('VersionLivrare_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                           NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                    </td>

                                    <td>
                                        <input type="hidden" id="VersionDescription_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['VersionDescription']; ?>
"/>
                                        <span id="VersionDescription_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>
                                        [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['VersionDescription'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"
                                            onclick="getNotes('VersionDescription_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>

                                    <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>

                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <td>
                                            <div id="button_mod">
                                                <a href="#" onclick="window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&VersionID=<?php echo $this->_tpl_vars['key']; ?>
' +
                                                        '&VersionName=' + escape(document.getElementById('VersionName_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                        '&VersionLivrare=' + escape(document.getElementById('VersionLivrare_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                        '&VersionDescription=' + escape(document.getElementById('VersionDescription_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                        '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0);
                                                        return false;" title="<?php echo smarty_function_translate(array('label' => 'Modifica versiune aplicatie'), $this);?>
">
                                                    <b>Mod</b>
                                                </a>
                                            </div>
                                        </td>
                                        <td>
                                            <div id="button_del">
                                                <a href="#"
                                                   onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&VersionID=<?php echo $this->_tpl_vars['key']; ?>
&delVersion=1'; return false;"
                                                   title="<?php echo smarty_function_translate(array('label' => 'Sterge versiunea aplicatiei'), $this);?>
">
                                                    <b>Del</b>
                                                </a>
                                            </div>
                                        </td>
                                    <?php endif; ?>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>

                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                <tr>
                                    <td><input type="text" id="VersionName_0" name="VersionName_0" value="" style="width:100px;" maxlength="255"></td>

                                    <td>
                                        <input type="text" id="VersionLivrare_0" class="formstyle" value="" size="10" maxlength="10"/>
                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                            var cal1_0 = new CalendarPopup();
                                            cal1_0.isShowNavigationDropdowns = true;
                                            cal1_0.setYearSelectStartOffset(10);
                                            //writeSource("js1_0");
                                        </SCRIPT>
                                        <A HREF="#" onClick="cal1_0.select(document.getElementById('VersionLivrare_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0"
                                           ID="anchor1_0"><img src="./images/cal.png" border="0"></A>
                                    </td>

                                    <td>
                                        <input type="hidden" id="VersionDescription_0" value=""/>
                                        <span id="VersionDescription_0_display"></span>
                                        [<a href="#" title="" onclick="getNotes('VersionDescription_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                    </td>

                                    <td>&nbsp;</td>

                                    <td colspan="2">
                                        <div id="button_add">
                                            <a href="#" onclick="window.location.href = './?m=dictionary&o=applications&AppID=<?php echo $_GET['AppID']; ?>
&VersionID=0' +
                                                    '&VersionName=' + escape(document.getElementById('VersionName_0').value) +
                                                    '&VersionLivrare=' + escape(document.getElementById('VersionLivrare_0').value) +
                                                    '&VersionDescription=' + escape(document.getElementById('VersionDescription_0').value);
                                                    return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga versiune aplicatie'), $this);?>
">
                                                <b>Add</b>
                                            </a>
                                        </div>
                                    </td>
                                </tr>
                            <?php endif; ?>
                        </table>
                    </fieldset>
                <?php endif; ?>
            </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'aplicatii flosite in firma'), $this);?>
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