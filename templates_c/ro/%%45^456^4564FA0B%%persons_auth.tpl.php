<?php /* Smarty version 2.6.18, created on 2020-10-06 11:06:54
         compiled from persons_auth.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_auth.tpl', 16, false),array('modifier', 'default', 'persons_auth.tpl', 32, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="pers">
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
    </table>
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Autentificare'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == ""): ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="color: #0000FF;"><?php echo smarty_function_translate(array('label' => 'Datele de autentificare au fost salvate!'), $this);?>
</td>
                            </tr>
                        <?php endif; ?>
                        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                            <tr>
                                <td>&nbsp;</td>
                                <td style="text-align: left; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
                            </tr>
                        <?php endif; ?>
                        <tr height="60">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Username'), $this);?>
:</b></td>
                            <td><input type="text" id="Username" name="Username" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Username'])) ? $this->_run_mod_handler('default', true, $_tmp, @$this->_tpl_vars['info']['suggest']) : smarty_modifier_default($_tmp, @$this->_tpl_vars['info']['suggest'])); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr height="35">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Parola'), $this);?>
:</b></td>
                            <td>
                                <input type="password" name="Password" id="Password" value="" size="30" maxlength="64">
                                <?php if ($_SESSION['USER_ID'] == 1): ?>
                                    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Genereaza'), $this);?>
" onclick="
			var username=document.getElementById('Username').value;
			var passgen =  username.charAt(0).toUpperCase() + username.slice(1) + Math.floor(Math.random()*Math.pow(10,5));
			document.getElementById('passgen').innerHTML = passgen;
			document.getElementById('Password').value = passgen;
			document.getElementById('Password2').value = passgen;
			">
                                    <span id="passgen"></span>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr height="35">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Rescrie parola'), $this);?>
:</b></td>
                            <td><input type="password" name="Password2" id="Password2" value="" size="30" maxlength="64"></td>
                        </tr>
                        <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                            <tr height="40">
                                <td>&nbsp;</td>
                                <td><input type="submit" name="save" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"></td>
                            </tr>
                        <?php endif; ?>
                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; width: 50%;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Trimite prin email'), $this);?>
</legend>
                    <?php if (! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" && ! empty ( $_POST['AuthMessageType'] )): ?>
                        <p style="color: #0000FF;"><?php echo smarty_function_translate(array('label' => 'Credentialele au fost trimise!'), $this);?>
</p>
                    <?php else: ?>
                        <br>
                    <?php endif; ?>
                    <b>Mesaj:</b>
                    <select name="AuthMessageType"
                            onchange="if (this.value == 'personalizat') document.getElementById('div_AuthMessageBody').style.display = 'block'; else document.getElementById('div_AuthMessageBody').style.display = 'none';">
                        <option value=""><?php echo smarty_function_translate(array('label' => 'fara trimitere mesaj'), $this);?>
</option>
                        <option value="standard" <?php if ($_POST['AuthMessageType'] == 'standard'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'standard'), $this);?>
</option>
                        <option value="personalizat" <?php if ($_POST['AuthMessageType'] == 'personalizat'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'personalizat'), $this);?>
</option>
                    </select>&nbsp;&nbsp;
                    <div id="div_AuthMessageBody" style="display: none;"><br><textarea name="AuthMessageBody" cols="60" rows="8"
                                                                                       wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['AuthMessageBody'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></div>
                    <?php if ($_POST['AuthMessageType'] == 'personalizat'): ?>
                        <script type="text/javascript">document.getElementById('div_AuthMessageBody').style.display = 'block';</script>
                    <?php endif; ?>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>