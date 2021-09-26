<?php /* Smarty version 2.6.18, created on 2020-12-03 10:00:44
         compiled from change_passwd.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'change_passwd.tpl', 6, false),)), $this); ?>
<br>
<?php if (! empty ( $_POST['go'] ) && $_POST['go'] == 2): ?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
        <table border="0" cellpadding="4" cellspacing="0">
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Schimbare parola'), $this);?>
</span></td>
            </tr>
            <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                <tr>
                    <td class="celulaMenuST">&nbsp;</td>
                    <td class="celulaMenuDR" style="text-align: center; color: #FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Parola noua'), $this);?>
:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Rescrie parola noua'), $this);?>
:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password2" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuDR" style="text-align: center;">
                    <input type="hidden" name="go" value="2">
                    <input type="submit" name="save" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle">
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</td>
            </tr>
        </table>
    </form>
<?php else: ?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
        <table border="0" cellpadding="4" cellspacing="0">
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Schimbare parola'), $this);?>
</span></td>
            </tr>
            <?php if ($this->_tpl_vars['err']->getErrors()): ?>
                <tr>
                    <td class="celulaMenuST">&nbsp;</td>
                    <td class="celulaMenuDR" style="text-align: center; color: #FF0000"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
                </tr>
            <?php endif; ?>
            <tr>
                <td class="celulaMenuST"><b><?php echo smarty_function_translate(array('label' => 'Parola curenta'), $this);?>
:*</b></td>
                <td class="celulaMenuDR"><input type="password" name="password" size="30"></td>
            </tr>
            <tr>
                <td class="celulaMenuST">&nbsp;</td>
                <td class="celulaMenuDR" style="text-align: center">
                    <input type="hidden" name="go" value="1">
                    <input type="submit" name="next" value="Pasul urmator" class="formstyle">
                </td>
            </tr>
            <tr>
                <td colspan="2" valign="top" class="bkdTitleMenu"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</td>
            </tr>
        </table>
    </form>
<?php endif; ?>