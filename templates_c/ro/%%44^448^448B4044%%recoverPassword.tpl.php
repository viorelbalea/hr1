<?php /* Smarty version 2.6.18, created on 2020-10-14 06:41:28
         compiled from recoverPassword.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'recoverPassword.tpl', 24, false),array('modifier', 'date_format', 'recoverPassword.tpl', 31, false),array('modifier', 'default', 'recoverPassword.tpl', 52, false),)), $this); ?>
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
            <form action="./?doRecoverPassword" method="post">
                <?php echo '
                    <input type="text" id="username" class="username" name="username" onfocus="if(this.value == \'Nume utilizator\') { this.value = \'\'; }"
                           onblur="if(this.value == \'\') {this.value = \'Nume utilizator\';}" value="Nume utilizator" size="27">
                '; ?>


        </div>

        <div class="loginRecover">
            <input id="loginRecover" class="loginRecover" type="submit" value="<?php echo smarty_function_translate(array('label' => 'Recupereaza Parola'), $this);?>
">
        </div>

        </form>

    </div>
    <div class="allRights">
        <p align="center"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Ka&Te Associates. All rights reserved </p>
    </div>
</div>

<!--
<link href="images/style.css" rel="stylesheet" type="text/css" />
<div align="center" class="loginPage">
<br clear="left" />
		<div>
	<form action="./?doRecoverPassword" method="post">
		<table class="loginBox" border="0" cellpadding="0" cellspacing="0" align="center">
			<tr>
				<td colspan="2" align="left" valign="top" height="80"><a href="./"><img src="images/logo.png" alt="" /></a></td>
			</tr>
			<tr>
				<td width="150" height="22" align="left" valign="top" ><p class="loginText"><b><?php echo smarty_function_translate(array('label' => 'Recuperare parola'), $this);?>
</b></p> </td>
				<td height="22" align="left" valign="top"><?php if (! empty ( $this->_tpl_vars['success'] )): ?><?php echo smarty_function_translate(array('label' => 'Verifica adresa de email pentru recuperarea parolei'), $this);?>
!<?php elseif ($this->_tpl_vars['err']->getErrors()): ?><font color="#FF0000"><b><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</b></font><?php else: ?>&nbsp;<?php endif; ?></td>
			</tr>
			<tr>
				<td align="left" height="30"><p class="loginText"><?php echo smarty_function_translate(array('label' => 'Username'), $this);?>
:</p> </td>
				<td align="left" height="30"><input type="text" class="loginInput" name="username" id="username" value="<?php echo ((is_array($_tmp=@$_POST['username'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="27"></td>
			</tr>
			<tr>
				<td height="30" colspan="2" align="left"><p align="center" style="margin-top: 11px;"><input id="loginSubmit" type="submit" value="<?php echo smarty_function_translate(array('label' => 'Trimite'), $this);?>
" class="loginSubmit"></p></td>
			</tr>
			<tr>
				<td height="145" colspan="2" align="left" valign="top"><p align="center" style="margin-top: 30px;"><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, "%Y") : smarty_modifier_date_format($_tmp, "%Y")); ?>
 Ka&Te Associates. All rights reserved  </p></td>
			</tr>
		</table>
	</form>
	</div>
</div>
-->