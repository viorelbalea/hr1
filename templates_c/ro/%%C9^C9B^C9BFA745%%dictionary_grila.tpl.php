<?php /* Smarty version 2.6.18, created on 2020-09-24 09:11:00
         compiled from dictionary_grila.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_grila.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Grila vechime in munca'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <select name="company_id" onchange="if (this.value > 0) window.location.href = './?m=dictionary&o=grila&company_id=' + this.value;">
                        <option value="0"><?php echo smarty_function_translate(array('label' => 'Compania'), $this);?>
</option>
                        <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['company_id'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                            <?php endif; ?>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                    <?php if (! empty ( $_GET['company_id'] )): ?>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="4" cellspacing="0">
                                        <tr>
                                            <td><?php echo smarty_function_translate(array('label' => 'Maxim ani vechime'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Zile concediu'), $this);?>
</td>
                                            <td><?php echo smarty_function_translate(array('label' => 'Maxim zile reportate'), $this);?>
</td>

                                            <td colspan="2"><?php echo smarty_function_translate(array('label' => 'Data limita zile reportate in an curent'), $this);?>
</td>

                                            <td colspan="2">&nbsp;</td>
                                        </tr>
                                        <?php $_from = $this->_tpl_vars['grila']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <tr>
                                                <td><input type="text" id="max_seniority_<?php echo $this->_tpl_vars['key']; ?>
" name="max_seniority_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['max_seniority']; ?>
" size="14" maxlength="10">
                                                </td>
                                                <td><input type="text" id="days_<?php echo $this->_tpl_vars['key']; ?>
" name="days_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['days']; ?>
" size="8" maxlength="10"></td>
                                                <td><input type="text" id="max_rep_days_<?php echo $this->_tpl_vars['key']; ?>
" name="max_rep_days_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['max_rep_days']; ?>
" size="15" maxlength="10">
                                                </td>

                                                <td>Ziua: <input type="text" name="rep_day_limit_<?php echo $this->_tpl_vars['key']; ?>
" id="rep_day_limit_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle" value="<?php echo $this->_tpl_vars['item']['rep_day_limit']; ?>
"
                                                                 size="2" maxlength="2"/></td>

                                                <td>Luna: <select name="rep_month_limit_<?php echo $this->_tpl_vars['key']; ?>
" id="rep_month_limit_<?php echo $this->_tpl_vars['key']; ?>
">
                                                        <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['month']):
?>
                                                            <option value="<?php echo $this->_tpl_vars['month']; ?>
" <?php if ($this->_tpl_vars['item']['rep_month_limit'] == $this->_tpl_vars['month']): ?> selected="selected"<?php endif; ?>><?php echo $this->_tpl_vars['month']; ?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </select>

                                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>

                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=grila&ID=<?php echo $this->_tpl_vars['key']; ?>
&company_id=<?php echo $_GET['company_id']; ?>
&max_seniority=' + escape(document.getElementById('max_seniority_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&days=' + escape(document.getElementById('days_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&max_rep_days=' + escape(document.getElementById('max_rep_days_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&rep_day_limit=' + escape(document.getElementById('rep_day_limit_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&rep_month_limit=' + escape(document.getElementById('rep_month_limit_<?php echo $this->_tpl_vars['key']; ?>
').value); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica grila'), $this);?>
"><b>Mod</b></a></div>
                                                </td>

                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=grila&ID=<?php echo $this->_tpl_vars['key']; ?>
&company_id=<?php echo $_GET['company_id']; ?>
&delGrila=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge grila'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                                <?php endif; ?>
                                            </tr>
                                        <?php endforeach; endif; unset($_from); ?>
                                        <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                            <tr>
                                                <td><input type="text" id="max_seniority_0" name="max_seniority_0" size="14" maxlength="10"></td>
                                                <td><input type="text" id="days_0" name="days_0" size="8" maxlength="10"></td>
                                                <td colspan="3">
                                                    <div id="button_add"><a href="#"
                                                                            onclick="window.location.href = './?m=dictionary&o=grila&ID=0&company_id=<?php echo $_GET['company_id']; ?>
&max_seniority=' + escape(document.getElementById('max_seniority_0').value) + '&days=' + escape(document.getElementById('days_0').value); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga grila'), $this);?>
"><b>Add</b></a></div>
                                                </td>
                                            </tr>
                                        <?php endif; ?>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    <?php endif; ?>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'grila vechime in munca'), $this);?>
</span></td>
        </tr>
    </table>
</form>