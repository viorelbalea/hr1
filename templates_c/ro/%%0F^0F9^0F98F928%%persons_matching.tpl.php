<?php /* Smarty version 2.6.18, created on 2020-09-22 07:55:35
         compiled from persons_matching.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_matching.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <tr>
        <td valign="top" class="bkdTitleMenu">
            <span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Potrivire persoane'), $this);?>
</span>
        </td>
    </tr>
</table>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
    <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
</td>
        </tr>
    <?php endif; ?>
    <tr>
        <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; width: 100%;">
            <br>
            <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="pers">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Potrivire persoane'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <select name="src_person" size="20">
                                    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                            <td><input type="submit" value="Potrivire &gt;&gt;">
                            <td>
                            <td>
                                <select name="dst_person" size="20">
                                    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
        </td>
    </tr>
    <tr>
        <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
    </tr>
</table>