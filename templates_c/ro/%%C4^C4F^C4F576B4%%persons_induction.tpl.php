<?php /* Smarty version 2.6.18, created on 2020-12-03 13:05:49
         compiled from persons_induction.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_induction.tpl', 14, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers">
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
        <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
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
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Etica'), $this);?>
</legend>
                    <div id="items" style="padding-left: 20px; padding-top: 20px;">                         <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                            <?php if ($this->_tpl_vars['key2'] > 0): ?>
                                <p><input type="checkbox" name="Status[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['key2']; ?>
]" value="1" <?php if (! empty ( $this->_tpl_vars['item2']['Status'] )): ?>checked<?php endif; ?>> <?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item2']['Item']), $this);?>
</p>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                        <table style="width: 550px;" border="0" cellpadding="4" cellspacing="0">
                            <tr>
                                <td><b>Categoria instruita</b></td>
                                <td><b>Responsabil</b></td>
                                <td><b>Data</b></td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['info']['items']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><?php echo $this->_tpl_vars['item']['Categorie']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['item']['CapitolDate']; ?>
</td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&ID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge inregistrarea'), $this);?>
"><b>Del</b></a></div>
                                    </td>
                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                        <p>
                            <?php echo smarty_function_translate(array('label' => 'Categoria instruita'), $this);?>

                            <select name="Categorie">
                                <option value="0">alege...</option>
                                <?php $_from = $this->_tpl_vars['etica']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>
                        </p>
                        <p>
                            <?php echo smarty_function_translate(array('label' => 'Responsabil'), $this);?>
:
                            <select name="ResponsableID">
                                <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                <?php $_from = $this->_tpl_vars['employees']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['k'] => $this->_tpl_vars['i']):
?>
                                    <option value="<?php echo $this->_tpl_vars['k']; ?>
"><?php echo $this->_tpl_vars['i']; ?>
</option>
                                <?php endforeach; endif; unset($_from); ?>
                            </select>&nbsp;&nbsp;&nbsp;
                            Data:
                            <input type="text" name="CapitolDate" id="CapitolDate" class="formstyle" value="" size="10" maxlength="10">
                            <SCRIPT LANGUAGE="JavaScript" ID="js">
                                var cal = new CalendarPopup();
                                cal.isShowNavigationDropdowns = true;
                                cal.setYearSelectStartOffset(10);
                                //writeSource("js");
                            </SCRIPT>
                            <A HREF="#" onClick="cal.select(document.getElementById('CapitolDate'),'anchor','dd.MM.yyyy'); return false;"
                               NAME="anchor" ID="anchor"><img src="./images/cal.png" border="0" alt="selecteaza data" align="absbottom"></A> | <A HREF="#"
                                                                                                                                                                onClick="document.getElementById('CapitolDate').value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
</A>
                        </p>
                        <p>&nbsp;</p>
                    </div>
                    <?php if ($this->_tpl_vars['info'][0]['rw'] == 1): ?>
                        <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle">
                        &nbsp;
                    <?php endif; ?>
                    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle">
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>