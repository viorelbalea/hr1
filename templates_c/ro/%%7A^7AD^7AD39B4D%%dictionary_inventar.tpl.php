<?php /* Smarty version 2.6.18, created on 2020-10-07 11:31:04
         compiled from dictionary_inventar.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_inventar.tpl', 11, false),array('modifier', 'date_format', 'dictionary_inventar.tpl', 139, false),array('modifier', 'escape', 'dictionary_inventar.tpl', 183, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="layer" id="layer_co" style="display: none;">

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

     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">

    x

</div>


<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">

    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">

        <tr>

            <td colspan="2" valign="top" class="bkdTitleMenu"><span

                        class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Obiecte de inventar'), $this);?>
</span></td>

        </tr>

        <tr>

            <td class="celulaMenuSTDR"

                style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">

                <br>

                <fieldset>

                    <legend><?php echo smarty_function_translate(array('label' => ' Obiecte de inventar'), $this);?>
</legend>

                    <table border="0" cellpadding="4" cellspacing="0" class="screen">

                        <tr>

                            <td>

                                <table border="0" cellpadding="4" cellspacing="0">

                                    <tr>

                                        <td><?php echo smarty_function_translate(array('label' => 'Nume obiect'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Cod unic'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Nr. obiecte'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Valoare achizitie'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</td>

                                        <td style="width:120px;"><?php echo smarty_function_translate(array('label' => 'Data achizitie'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</td>

                                        <td style="width:110px;"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</td>

                                        <td><?php echo smarty_function_translate(array('label' => 'Activ'), $this);?>
</td>

                                        <td colspan="2">&nbsp;</td>

                                    </tr>

                                    <?php $_from = $this->_tpl_vars['inventar']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>

                                            <td><input type="text" id="ObjName_<?php echo $this->_tpl_vars['key']; ?>
" name="ObjName_<?php echo $this->_tpl_vars['key']; ?>
"

                                                       value="<?php echo $this->_tpl_vars['item']['ObjName']; ?>
" size="40" maxlength="128"></td>

                                            <td><input type="text" id="ObjCode_<?php echo $this->_tpl_vars['key']; ?>
" name="ObjCode_<?php echo $this->_tpl_vars['key']; ?>
"

                                                       value="<?php echo $this->_tpl_vars['item']['ObjCode']; ?>
" size="10"></td>

                                            <td><input type="text" id="ObjCount_<?php echo $this->_tpl_vars['key']; ?>
" name="ObjCount_<?php echo $this->_tpl_vars['key']; ?>
"

                                                       value="<?php echo $this->_tpl_vars['item']['ObjCount']; ?>
" size="10"></td>

                                            <td><input type="text" id="ObjAcqValue_<?php echo $this->_tpl_vars['key']; ?>
" name="ObjAcqValue_<?php echo $this->_tpl_vars['key']; ?>
"

                                                       value="<?php echo $this->_tpl_vars['item']['ObjAcqValue']; ?>
" size="10" maxlength="10"></td>

                                            <td>

                                                <select name="ObjCategory_<?php echo $this->_tpl_vars['key']; ?>
" id="ObjCategory_<?php echo $this->_tpl_vars['key']; ?>
">

                                                    <option value="0"></option>

                                                    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['item']['ObjCategory'] == $this->_tpl_vars['key2']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>

                                                </select>

                                            </td>

                                            <td>

                                                <input type="text" id="ObjAcqDate_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"

                                                       value="<?php if (! empty ( $this->_tpl_vars['item']['ObjAcqDate'] ) && $this->_tpl_vars['item']['ObjAcqDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ObjAcqDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"

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

                                                <A HREF="#"

                                                   onClick="cal1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('ObjAcqDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"

                                                   NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png"

                                                                                                  border="0"></A>

                                            </td>

                                            <td>

                                                <select name="Comp_<?php echo $this->_tpl_vars['key']; ?>
" id="Comp_<?php echo $this->_tpl_vars['key']; ?>
">

                                                    <option value="0">Compania</option>

                                                    <?php $_from = $this->_tpl_vars['Companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key3']; ?>
" <?php if ($this->_tpl_vars['item']['CompanyId'] == $this->_tpl_vars['key3']): ?>selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['item3']['CompanyName']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>                                                </select>

                                            </td>

                                            <td>

                                                <input type="hidden" id="ObjNotes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['ObjNotes']; ?>
"/>

                                                <span id="ObjNotes_<?php echo $this->_tpl_vars['key']; ?>
_display"></span>

                                                [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['ObjNotes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
"

                                                    onclick="getNotes('ObjNotes_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]

                                            </td>

                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1"

                                                                      <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>

                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>

                                                    <div id="button_mod"><a href="#"

                                                                            onclick="if(document.getElementById('ObjCode_<?php echo $this->_tpl_vars['key']; ?>
').value.length > 0)

                                                                                    window.location.href = './?m=dictionary&o=inventar&ObjID=<?php echo $this->_tpl_vars['key']; ?>
' +

                                                                                    '&ObjName=' + escape(document.getElementById('ObjName_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjCode=' + escape(document.getElementById('ObjCode_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjAcqValue=' + escape(document.getElementById('ObjAcqValue_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjCount=' + escape(document.getElementById('ObjCount_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjCategory=' + escape(document.getElementById('ObjCategory_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjAcqDate=' + escape(document.getElementById('ObjAcqDate_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&ObjNotes=' + escape(document.getElementById('ObjNotes_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&Comp='+

                                                                                    escape(document.getElementById('Comp_<?php echo $this->_tpl_vars['key']; ?>
').value) +

                                                                                    '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); else alert('<?php echo smarty_function_translate(array('label' => 'Cod produsului trebuie completat!'), $this);?>
');

                                                                                    return false;"

                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica obiect de inventar'), $this);?>
"><b>Mod</b></a>

                                                    </div>

                                                </td>
                                                <td>

                                                    <div id="button_del"><a href="#"

                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=inventar&ObjID=<?php echo $this->_tpl_vars['key']; ?>
&delObj=1'; return false;"

                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge obiect de inventar'), $this);?>
"><b>Del</b></a>

                                                    </div>

                                                </td>
                                            <?php endif; ?>

                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>

                                    <tr>
                                        <th colspan="7"> Adauga Obiect de inventar nou</th>
                                    </tr>

                                    <tr>
                                        <td>Nume obiect</td>
                                        <td>Cod Unic</td>
                                        <td>Nr. obiecte</td>
                                        <td>Valoare Achizitie</td>
                                        <td>Tip</td>
                                        <td>Data Achizitie</td>
                                        <td>Companie</td>
                                    </tr>

                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>

                                            <td>
                                                <input type="text" id="ObjName_0" name="ObjName_0" size="40" maxlength="128">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjCode_0" name="ObjCode_0" size="10">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjCount_0" name="ObjCount_0" size="10">
                                            </td>

                                            <td>
                                                <input type="text" id="ObjAcqValue_0" name="ObjAcqValue_0" size="10" maxlength="10">
                                            </td>

                                            <td>

                                                <select name="ObjCategory_0" id="ObjCategory_0">

                                                    <option value="0"></option>

                                                    <?php $_from = $this->_tpl_vars['categories']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
"><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>

                                                </select>

                                            </td>

                                            <td>

                                                <input type="text" id="ObjAcqDate_0" class="formstyle" value=""

                                                       size="10" maxlength="10">

                                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">

                                                    var cal1_0 = new CalendarPopup();

                                                    cal1_0.isShowNavigationDropdowns = true;

                                                    cal1_0.setYearSelectStartOffset(10);

                                                    //writeSource("js1_0");

                                                </SCRIPT>

                                                <A HREF="#"

                                                   onClick="cal1_0.select(document.getElementById('ObjAcqDate_0'),'anchor1_0','dd.MM.yyyy'); return false;"

                                                   NAME="anchor1_0" ID="anchor1_0"><img src="./images/cal.png"

                                                                                        border="0"></A>

                                            </td>

                                            <td>

                                                <select name="Comp_0" id="Comp_0">

                                                    <option value="0">Compania</option>

                                                    <?php $_from = $this->_tpl_vars['Companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key3'] => $this->_tpl_vars['item3']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key3']; ?>
"><?php echo $this->_tpl_vars['item3']['CompanyName']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>

                                                </select>

                                            </td>

                                            
                                            <input type="hidden" id="ObjNotes_0" value=""/>

                                            
                                            
                                            
                                            
                                            <td>&nbsp;</td>

                                            <td colspan="2">

                                                <div id="button_add"><a href="#"

                                                                        onclick="if(document.getElementById('ObjCode_0').value.length > 0)

                                                                                window.location.href = './?m=dictionary&o=inventar&ObjID=0' +

                                                                                '&ObjName=' + escape(document.getElementById('ObjName_0').value) +

                                                                                '&ObjCode=' + escape(document.getElementById('ObjCode_0').value) +

                                                                                '&ObjAcqValue=' + escape(document.getElementById('ObjAcqValue_0').value) +

                                                                                '&ObjCategory=' + escape(document.getElementById('ObjCategory_0').value) +
                                                                                '&ObjCount=' + escape(document.getElementById('ObjCount_0').value) +
                                                                                '&ObjAcqDate=' + escape(document.getElementById('ObjAcqDate_0').value) +

                                                                                '&Comp=' + escape(document.getElementById('Comp_0').value) +

                                                                                '&ObjNotes=' + escape(document.getElementById('ObjNotes_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Cod produsului trebuie completat!'), $this);?>
');

                                                                                return false;"

                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga obiect de inventar'), $this);?>
"><b>Add</b></a>

                                                </div>

                                            </td>

                                        </tr>
                                    <?php endif; ?>

                                </table>

                            </td>

                        </tr>

                    </table>

            </td>

        </tr>

        <tr>

            <td colspan="2" valign="top" class="bkdTitleMenu"><span

                        class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de obiecte de inventar'), $this);?>
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

