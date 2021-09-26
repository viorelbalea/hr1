<?php /* Smarty version 2.6.18, created on 2020-10-07 11:28:08
         compiled from dictionary_pontaj_phases.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_pontaj_phases.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Faze proiect'), $this);?>
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
                                        <td><?php echo smarty_function_translate(array('label' => 'Faza'), $this);?>
</td>
                                        <td><?php echo smarty_function_translate(array('label' => 'Descriere faza'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['phases']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="Phase_<?php echo $this->_tpl_vars['key']; ?>
" name="Phase_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Phase']; ?>
" size="20" maxlength="64"></td>
                                            <td><input type="text" id="Notes_<?php echo $this->_tpl_vars['key']; ?>
" name="Notes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
" size="60" maxlength="128"></td>
                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID=<?php echo $this->_tpl_vars['key']; ?>
&Phase=' + escape(document.getElementById('Phase_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica faza'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID=<?php echo $this->_tpl_vars['key']; ?>
&delPhase=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge faza'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="Phase_0" name="Phase_0" size="20" maxlength="64"></td>
                                            <td><input type="text" id="Notes_0" name="Notes_0" size="60" maxlength="128"></td>
                                            <td>&nbsp;</td>
                                            <td colspan="2">
                                                <div id="button_add"><a href="#"
                                                                        onclick="window.location.href = './?m=dictionary&o=pontaj_phases&PhaseID=0&Phase=' + escape(document.getElementById('Phase_0').value) + '&Notes=' + escape(document.getElementById('Notes_0').value); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga faza'), $this);?>
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
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de faze'), $this);?>
</span></td>
        </tr>
    </table>
</form>