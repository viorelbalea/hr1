<?php /* Smarty version 2.6.18, created on 2020-10-13 10:46:21
         compiled from admin_reports_rights_layer.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_reports_rights_layer.tpl', 5, false),)), $this); ?>
<form action="./?m=admin&o=reports&ReportID=<?php echo $_GET['ReportID']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="layerContent">
        <tr valign="top">
            <td>
                <p><b><?php echo smarty_function_translate(array('label' => 'Nume raport'), $this);?>
:</b></p>
                <input type="text" name="ReportName" value="<?php echo $this->_tpl_vars['rights']['report']['name']; ?>
" size="40"/>
                <p>&nbsp;</p>
                <p><b><?php echo smarty_function_translate(array('label' => 'Grupa rapoarte'), $this);?>
:</b></p>
                <select name="GroupID">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['groups']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['rights']['report']['groupid'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
                <p>&nbsp;</p>
                <p><b><?php echo smarty_function_translate(array('label' => 'Tip rapoarte'), $this);?>
:</b></p>
                <select name="Type" id="Type">
                    <option value="0">alege...</option>
                    <?php $_from = $this->_tpl_vars['types']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['rights']['report']['Type'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            </td>
            <td style="padding-left: 100px;" width="100%">
                <table border="0" cellpadding="6" cellspacing="0" width="100%">
                    <tr>
                        <td><b><?php echo smarty_function_translate(array('label' => 'Useri'), $this);?>
</b></td>
                        <td><b><?php echo smarty_function_translate(array('label' => 'Roluri'), $this);?>
</b></td>
                    </tr>
                    <tr valign="top">
                        <td>
                            <?php $_from = $this->_tpl_vars['rights']['user']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <input type="checkbox" name="rights[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (isset ( $this->_tpl_vars['rights']['report']['rights'][$this->_tpl_vars['key']] )): ?>checked<?php endif; ?>>
                                <?php echo $this->_tpl_vars['item']; ?>

                                <br>
                            <?php endforeach; endif; unset($_from); ?>
                        </td>
                        <td>
                            <?php $_from = $this->_tpl_vars['rights']['role']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <input type="checkbox" name="rights[<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (isset ( $this->_tpl_vars['rights']['report']['rights'][$this->_tpl_vars['key']] )): ?>checked<?php endif; ?>>
                                <?php echo $this->_tpl_vars['item']; ?>

                                <br>
                            <?php endforeach; endif; unset($_from); ?>
                        </td>
                    </tr>
                    <tr>
                </table>
            </td>
        </tr>
    </table>
    <div class="saveObservatii">
        <input type="submit" name="save" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">
    </div>
</form>