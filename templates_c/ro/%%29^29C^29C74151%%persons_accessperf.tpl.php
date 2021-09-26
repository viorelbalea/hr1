<?php /* Smarty version 2.6.18, created on 2020-10-06 11:58:49
         compiled from persons_accessperf.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_accessperf.tpl', 17, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<br>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="pers" onsubmit="return validateForm(this);">
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
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 330px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Acces performanta'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="400">
                        <tr>
                            <td><input type="checkbox" name="accessperf[1]" value="1" <?php if ($this->_tpl_vars['info']['AccessPerf'] == 1 || $this->_tpl_vars['info']['AccessPerf'] == 3): ?>checked<?php endif; ?>></td>
                            <td style="text-align: left; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Performanta actiuni : Actiuni divizii, Plan actiuni'), $this);?>
</td>
                        </tr>
                        <tr>
                            <td><input type="checkbox" name="accessperf[2]" value="2" <?php if ($this->_tpl_vars['info']['AccessPerf'] == 2 || $this->_tpl_vars['info']['AccessPerf'] == 3): ?>checked<?php endif; ?>></td>
                            <td style="text-align: left; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Performanta obiective: Obiective angajati, Obiective proprii'), $this);?>
</td>
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
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>