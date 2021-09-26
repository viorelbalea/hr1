<?php /* Smarty version 2.6.18, created on 2020-09-21 08:52:13
         compiled from dictionary_jobstitle.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_jobstitle.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Profesii'), $this);?>
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
                                        <td><?php echo smarty_function_translate(array('label' => 'Nume profesie'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'COR'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Activa'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['jobstitle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="JobTitle_<?php echo $this->_tpl_vars['key']; ?>
" name="JobTitle_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['JobTitle']; ?>
" size="40" maxlength="255"></td>
                                            <td><input type="text" id="COR_<?php echo $this->_tpl_vars['key']; ?>
" name="COR_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['COR']; ?>
" size="10" maxlength="32"></td>
                                            <td align="center"><input type="checkbox" id="Status_<?php echo $this->_tpl_vars['key']; ?>
" value="1" <?php if ($this->_tpl_vars['item']['Status'] == 1): ?>checked<?php endif; ?>></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=jobstitle&JobDictionaryID=<?php echo $this->_tpl_vars['key']; ?>
&JobTitle=' + escape(document.getElementById('JobTitle_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&COR=' + escape(document.getElementById('COR_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Status=' + (document.getElementById('Status_<?php echo $this->_tpl_vars['key']; ?>
').checked ? 1 : 0); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica profesie'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=jobstitle&JobDictionaryID=<?php echo $this->_tpl_vars['key']; ?>
&delJobTitle=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge profesie'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="JobTitle_0" name="JobTitle_0" size="40" maxlength="255"></td>
                                            <td><input type="text" id="COR_0" name="COR_0" size="10" maxlength="32"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=jobstitle&JobDictionaryID=0&JobTitle=' + escape(document.getElementById('JobTitle_0').value) + '&COR=' + escape(document.getElementById('COR_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga profesie'), $this);?>
"><b>Mod</b></a></div>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de profesii care apar in aplicatie'), $this);?>
</span></td>
        </tr>
    </table>
</form>