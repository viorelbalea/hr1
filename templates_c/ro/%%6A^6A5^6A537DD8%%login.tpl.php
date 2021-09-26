<?php /* Smarty version 2.6.18, created on 2020-09-02 08:46:59
         compiled from login.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'login.tpl', 25, false),array('modifier', 'date_format', 'login.tpl', 46, false),array('modifier', 'default', 'login.tpl', 68, false),)), $this); ?>
<link href="images/style.css" rel="stylesheet" type="text/css"/>


<div id="loginPageNew" class="loginPageNew">

    <div class="logoHreLogin">
        <img src="images/logo.png" alt=""/>
        <p style="margin-top:20px;">
            <?php if ($this->_tpl_vars['err']->getErrors()): ?><font color="#FF0000"><b><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</b></font><?php endif; ?>
        </p>
    </div>
    <div align="center" class="loginHolder">

        <div class="fieldsHolder">
            <form action="<?php if (! isset ( $_GET['doChangePassword'] )): ?>./<?php endif; ?>" method="post">
                <?php echo '
                    <input type="text" id="username" class="username" name="username" onfocus="if(this.value == \'Nume utilizator\') { this.value = \'\'; }"
                           onblur="if(this.value == \'\') {this.value = \'Nume utilizator\';}" value="Nume utilizator" size="27">
                    <input type="password" id="password" class="password" name="password" onfocus="if(this.value == \'Parola\') { this.value = \'\'; }"
                           onblur="if(this.value == \'\') {this.value = \'Parola\';}" value="Parola">
                '; ?>

                <?php if (! isset ( $_GET['doChangePassword'] )): ?>
                    <select name="area_id" class="loginSelect">
                        <?php $_from = $this->_tpl_vars['areas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
                        <?php endforeach; endif; unset($_from); ?>
                    </select>
                <?php else: ?>
                    <input type="hidden" name="area_id" value="<?php echo $_GET['area_id']; ?>
"/>
                    <p class="loginText"><?php echo smarty_function_translate(array('label' => 'Confirma parola'), $this);?>
: </p>
                    <input type="password" class="password" name="password2" size="27">
                <?php endif; ?>

        </div>

        <div class="loginAuthBtn">
            <input id="loginAuthBtn" class="loginAuthBtn" type="submit" value="<?php if (! isset ( $_GET['doChangePassword'] )): ?>Intra in cont<?php else: ?><?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
<?php endif; ?>">
        </div>
        <div class="loginForgotBtn">
            <a href="#" class="forgotPass" onclick="window.location.href = './?doRecoverPassword';"><?php echo smarty_function_translate(array('label' => 'Am uitat parola'), $this);?>
</a>
        </div>
        </form>
        <br style="clear:both;"/>
    </div>
    <div align="center" class="allRights">
        <p align="center"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Ka&Te Associates. All rights reserved </p>
    </div>
</div>


<!--
<div align="center" class="loginPage">
<br clear="left" />
		<div>
	<form action="<?php if (! isset ( $_GET['doChangePassword'] )): ?>./<?php endif; ?>" method="post">
		<table  class="loginBox" border="0" cellpadding="0" cellspacing="0" align="center">
			
			<tr>
				<td width="150" height="22" align="left" valign="top" ><p class="loginText"><b><?php if (! isset ( $_GET['doChangePassword'] )): ?><?php echo smarty_function_translate(array('label' => 'Autentificare'), $this);?>
<?php else: ?><?php echo smarty_function_translate(array('label' => 'Schimbare parola'), $this);?>
<?php endif; ?></b></p> </td>
				<td height="22" align="left"  valign="top"><?php if ($this->_tpl_vars['err']->getErrors()): ?><font color="#FF0000"><b><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</b></font><?php endif; ?></td>
			</tr>
			<tr>


			<tr>
				<td align="left" height="30"><p class="loginText"><?php echo smarty_function_translate(array('label' => 'Username'), $this);?>
:</p> </td>
				<td align="left" height="30"><input type="text" class="loginInput" name="username" id="username" value="<?php echo ((is_array($_tmp=@$_POST['username'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="27"></td>
			</tr>
			<tr>
				<td height="30" align="left"><p class="loginText"><?php echo smarty_function_translate(array('label' => 'Parola'), $this);?>
: </p></td>
				<td align="left"><input type="password" class="loginInput" name="password" size="27"></td>
			</tr>
			<?php if (! isset ( $_GET['doChangePassword'] )): ?>
			<tr>
				<td height="30"  align="left">
					<p class="loginText"><?php echo smarty_function_translate(array('label' => 'Zona aplicatie'), $this);?>
</p>
				</td>
                                
				<td  align="left">
					<select name="area_id" class="loginSelect">
					<?php $_from = $this->_tpl_vars['areas']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
					<option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['item']), $this);?>
</option>
					<?php endforeach; endif; unset($_from); ?>
					</select>
				</td>
			</tr>
                        <?php else: ?>
                        <tr>
                        <input type="hidden" name="area_id" value="<?php echo $_GET['area_id']; ?>
" />
                            <td height="30" align="left"><p class="loginText"><?php echo smarty_function_translate(array('label' => 'Confirma parola'), $this);?>
: </p></td>
                            <td align="left"><input type="password" class="loginInput" name="password2" size="27"></td>
			</tr>
                        <?php endif; ?>
			<tr>
				<td  height="30" colspan="2" align="left">
				    <p align="right" style="margin: 11px 23px 0 0;"><input id="loginSubmit" type="submit" value="<?php if (! isset ( $_GET['doChangePassword'] )): ?>Login<?php else: ?><?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
<?php endif; ?>" class="loginSubmit">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo smarty_function_translate(array('label' => 'Am uitat parola'), $this);?>
" class="loginSubmit" onclick="window.location.href = './?doRecoverPassword';"></p>
				</td>
			</tr>
			<tr>
				<td  height="160" colspan="2" align="left" valign="top"><p align="center" style="margin-top: 30px;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Ka&Te Associates. All rights reserved  </p></td>
			</tr>
		</table>
	</form>
	</div>
</div>


-->