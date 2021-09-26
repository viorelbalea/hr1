<?php /* Smarty version 2.6.18, created on 2021-08-27 06:26:28
         compiled from admin_translate.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_translate.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Traduceri'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <select onchange="if (this.value > '') window.location.href = './?m=admin&o=translate&lang=' + this.value;">
                        <option value=""><?php echo smarty_function_translate(array('label' => 'alege traducere'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['langs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if ($this->_tpl_vars['key'] != 'ro'): ?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['lang']): ?>selected<?php endif; ?>>Romana -> <?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <?php if (! empty ( $_GET['lang'] )): ?>
                        <?php $_from = $this->_tpl_vars['letters']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['letter']):
?>
                            &nbsp;&nbsp;&nbsp;
                            <a href="./?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&letter=<?php echo $this->_tpl_vars['letter']; ?>
"><?php if ($this->_tpl_vars['letter'] == $_GET['letter']): ?><b><?php echo $this->_tpl_vars['letter']; ?>
</b><?php else: ?><?php echo $this->_tpl_vars['letter']; ?>
<?php endif; ?></a>
                        <?php endforeach; endif; unset($_from); ?>
                        &nbsp;&nbsp;&nbsp;
                        <a href="./?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&letter=Altele"><?php if ($_GET['letter'] == 'Altele'): ?><b>Altele</b><?php else: ?>Altele<?php endif; ?></a>
                        &nbsp;&nbsp;&nbsp;
                        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Generare traducere'), $this);?>
"
                               onclick="window.location.href = './?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&generate=1';">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>
                                    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                                        <font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font>
                                        <br>
                                        <br>
                                    <?php endif; ?>
                                </td>
                            </tr>
                            <tr>
                                <td><b>ro</b></td>
                                <td><b><?php echo $_GET['lang']; ?>
</b></td>
                                <td colspan="2">&nbsp;</td>
                            </tr>
                            <tr>
                                <td><input type="text" id="ro_0" size="60" maxlength="1000"></td>
                                <td><input type="text" id="lng_0" size="60" maxlength="1000"></td>
                                <td colspan="2">
                                    <div id="button_add"><a href="#"
                                                            onclick="window.location.href = './?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&letter=<?php echo $_GET['letter']; ?>
&ID=0&ro=' + escape(document.getElementById('ro_0').value) + '&lng=' + document.getElementById('lng_0').value; return false;"
                                                            title="Adauga traducere"><b>Add</b></a></div>
                                </td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['translates']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['ID'] => $this->_tpl_vars['item']):
?>
                                <tr>
                                    <td><input type="text" id="ro_<?php echo $this->_tpl_vars['ID']; ?>
" value="<?php echo $this->_tpl_vars['item']['ro']; ?>
" size="60" maxlength="1000"></td>
                                    <td><input type="text" id="lng_<?php echo $this->_tpl_vars['ID']; ?>
" value="<?php echo $this->_tpl_vars['item'][$_GET['lang']]; ?>
" size="60" maxlength="1000"></td>
                                    <td>
                                        <div id="button_mod"><a href="#"
                                                                onclick="window.location.href = './?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&letter=<?php echo $_GET['letter']; ?>
&ID=<?php echo $this->_tpl_vars['ID']; ?>
&ro=' + escape(document.getElementById('ro_<?php echo $this->_tpl_vars['ID']; ?>
').value) + '&lng=' + document.getElementById('lng_<?php echo $this->_tpl_vars['ID']; ?>
').value; return false;"
                                                                title="Modifica traducere"><b>Mod</b></a></div>
                                    </td>
                                    <td>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=admin&o=translate&lang=<?php echo $_GET['lang']; ?>
&letter=<?php echo $_GET['letter']; ?>
&ID=<?php echo $this->_tpl_vars['ID']; ?>
&del=1'; return false;"
                                                                title="Sterge traducere"><b>Del</b></a></div>
                                    </td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de labels care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>