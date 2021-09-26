<?php /* Smarty version 2.6.18, created on 2021-03-25 13:40:25
         compiled from dictionary_countries.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_countries.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Tari'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                                    <font color="FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</font>
                                    <br>
                                    <br>
                                <?php endif; ?>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td><?php echo smarty_function_translate(array('label' => 'Tara'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Cod'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Nationalitate'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['countries']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="CountryName_<?php echo $this->_tpl_vars['key']; ?>
" name="CountryName_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CountryName']; ?>
" size="60" maxlength="128"></td>
                                            <td><input type="text" id="CountryCode_<?php echo $this->_tpl_vars['key']; ?>
" name="CountryCode_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['CountryCode']; ?>
" size="4" maxlength="3"></td>
                                            <td><input type="text" id="Nationality_<?php echo $this->_tpl_vars['key']; ?>
" name="Nationality_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Nationality']; ?>
" size="20" maxlength="32"></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=country&CountryID=<?php echo $this->_tpl_vars['key']; ?>
&CountryName=' + escape(document.getElementById('CountryName_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&CountryCode=' + escape(document.getElementById('CountryCode_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Nationality=' + escape(document.getElementById('Nationality_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica tara'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=country&CountryID=<?php echo $this->_tpl_vars['key']; ?>
&delCountry=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge tara'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="CountryName_0" name="CountryName_0" size="60" maxlength="128"></td>
                                            <td><input type="text" id="CountryCode_0" name="CountryCode_0" size="4" maxlength="3"></td>
                                            <td><input type="text" id="Nationality_0" name="Nationality_0" size="20" maxlength="32"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=country&CountryID=0&CountryName=' + escape(document.getElementById('CountryName_0').value) + '&CountryCode=' + escape(document.getElementById('CountryCode_0').value) + '&Nationality=' + escape(document.getElementById('Nationality_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga tara'), $this);?>
"><b>Add</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista tarilor care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>