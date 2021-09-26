<?php /* Smarty version 2.6.18, created on 2020-10-12 09:10:01
         compiled from settings_styles.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'settings_styles.tpl', 10, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "settings_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td colspan="7" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "settings_submenu_2.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span></td>
    </tr>
    <tr>
        <td width="400">
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Stiluri disponibile'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <b><?php echo smarty_function_translate(array('label' => 'Selecteaza stil'), $this);?>
: </b>
                                <select id="StyleID" name="StyleID" class="cod">
                                    <?php $_from = $this->_tpl_vars['styles']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']['StyleID']; ?>
" <?php if ($this->_tpl_vars['key'] == $this->_tpl_vars['StyleID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Name']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <br/><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle">
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </form>
        </td>
    </tr>
</table>