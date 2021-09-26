<?php /* Smarty version 2.6.18, created on 2020-10-07 17:35:34
         compiled from admin_users.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_users.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Utilizatori aplicatie '), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Utilizatori '), $this);?>
</legend>
                    <br>
                    <table border="1" cellpadding="6" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Utilizator '), $this);?>
</b></td>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Activ '), $this);?>
</b></td>
                            <td align="center"><b><?php echo smarty_function_translate(array('label' => 'Tip '), $this);?>
</b></td>
                            <?php $_from = $this->_tpl_vars['app_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                <td><b><?php echo $this->_tpl_vars['item']; ?>
</b></td>
                            <?php endforeach; endif; unset($_from); ?>
                        </tr>
                        <?php $_from = $this->_tpl_vars['users']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['user']):
?>
                            <tr>
                                <td>
                                    <?php echo $this->_tpl_vars['user']['UserName']; ?>

                                    <br><img width="1" height="5"><br>
                                    <table cellspacing="0" cellpadding="0">
                                        <tr>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (username = prompt('UTILIZATOR:', '<?php echo $this->_tpl_vars['user']['UserName']; ?>
')) window.location.href = './?m=admin&o=users&action=edit&id=<?php echo $this->_tpl_vars['user']['UserID']; ?>
&username=' + escape(username); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Modifica username'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td>
                                                <div id="button_mod"><a href="#"
                                                                        onclick="if (password = prompt('PAROLA:')) window.location.href = './?m=admin&o=users&action=pass&id=<?php echo $this->_tpl_vars['user']['UserID']; ?>
&password=' + escape(password); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Seteaza parola'), $this);?>
"><b>Mod</b></a></div>
                                            </td>
                                            <td style="padding-left: 5px;">
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a)?'), $this);?>
')) window.location.href = './?m=admin&o=users&action=del&id=<?php echo $this->_tpl_vars['user']['UserID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td><input type="checkbox" name="active[<?php echo $this->_tpl_vars['user']['UserID']; ?>
]" value="1" <?php if ($this->_tpl_vars['user']['UserActive'] == 1): ?>checked<?php endif; ?>></td>
                                <td align="center">
                                    <select name="type[<?php echo $this->_tpl_vars['user']['UserID']; ?>
]">
                                        <option value="user"><?php echo smarty_function_translate(array('label' => 'user'), $this);?>
</option>
                                        <option value="role" <?php if ($this->_tpl_vars['user']['UserType'] == 'role'): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'role'), $this);?>
</option>
                                    </select>
                                    <div id="button_mod"><a href="#" onclick="window.location.href = './?m=admin&o=users&action=settings&id=<?php echo $this->_tpl_vars['user']['UserID']; ?>
'; return false;"
                                                            title="Seteaza speciale"><b><?php echo smarty_function_translate(array('label' => 'Mod'), $this);?>
</b></a></div>
                                </td>
                                <?php $_from = $this->_tpl_vars['app_modules']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                    <td align="center">
                                        <input type="checkbox" name="right[<?php echo $this->_tpl_vars['user']['UserID']; ?>
][<?php echo $this->_tpl_vars['key']; ?>
]" value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (in_array ( $this->_tpl_vars['key'] , $this->_tpl_vars['user']['UserRights'] )): ?>checked<?php endif; ?>>
                                        <?php if (in_array ( $this->_tpl_vars['key'] , $this->_tpl_vars['user']['UserRights'] )): ?>
                                            <div id="button_mod">
                                                <?php if ($this->_tpl_vars['key'] == 7): ?>
                                                    <a href="#" onclick="window.location.href = './?m=admin&o=reports'; return false;"
                                                       title="Seteaza"><b><?php echo smarty_function_translate(array('label' => 'Mod'), $this);?>
</b></a>
                                                <?php else: ?>
                                                    <a href="#" onclick="window.location.href = './?m=admin&o=users&action=rights&id=<?php echo $this->_tpl_vars['user']['UserID']; ?>
&module=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                       title="Seteaza"><b><?php echo smarty_function_translate(array('label' => 'Mod'), $this);?>
</b></a>
                                                <?php endif; ?>
                                            </div>
                                        <?php endif; ?>
                                    </td>
                                <?php endforeach; endif; unset($_from); ?>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                    </table>
                </fieldset>
                <br>
                <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">&nbsp;&nbsp;<input type="button" value="Adauga user"
                                                                                             onclick="if (username = prompt('USERNAME:')) window.location.href = './?m=admin&o=users&action=new&username=' + escape(username);">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'utilizatori si drepturi'), $this);?>
</span></td>
        </tr>
    </table>
</form>