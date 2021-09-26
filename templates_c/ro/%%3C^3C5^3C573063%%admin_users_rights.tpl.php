<?php /* Smarty version 2.6.18, created on 2020-10-13 10:44:42
         compiled from admin_users_rights.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'admin_users_rights.tpl', 6, false),array('function', 'position', 'admin_users_rights.tpl', 81, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "admin_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" name="rights">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span
                        class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Setari modul '), $this);?>
 <u><?php echo $this->_tpl_vars['app_modules'][$_GET['module']]; ?>
</u> <?php echo smarty_function_translate(array('label' => 'pentru'), $this);?>
 <u><?php echo $this->_tpl_vars['info']['UserName']; ?>
</a></span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Setari nivel 2'), $this);?>
</legend>
                    <?php $_from = $this->_tpl_vars['rights_level2']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <br>
                        <?php if ($_GET['module'] == 20): ?>
                            <b><?php echo $this->_tpl_vars['item']['name']; ?>
</b>
                        <?php else: ?>
                            <input type="checkbox" name="RightsLevel2[<?php echo $this->_tpl_vars['key']; ?>
]" value="1" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] > 0): ?>checked<?php endif; ?>>
                            <b><?php echo $this->_tpl_vars['item']['name']; ?>
</b>
                            <?php if ($this->_tpl_vars['item']['type'] == 'list'): ?>
                                <?php if ($_GET['module'] == 9): ?>
                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="1" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 1): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'vede doar actiunile introduse de el'), $this);?>

                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="2" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 2): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'vede actiunile introduse de el si de catre cei care depind de el'), $this);?>

                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="3" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 3): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'vede toate actiunile si le poate modifica'), $this);?>


                                <?php else: ?>
                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="1" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 1): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'read own'), $this);?>

                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="2" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 2): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'read all'), $this);?>

                                    <br>
                                    <input type="radio" name="settings[<?php echo $this->_tpl_vars['key']; ?>
]" value="3" <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][$this->_tpl_vars['key']] == 3): ?>checked<?php endif; ?>>
                                    <?php echo smarty_function_translate(array('label' => 'read all / write own'), $this);?>

                                    <br>
                                    <?php if ($_GET['module'] == 1 && $this->_tpl_vars['info']['UserType'] == 'role'): ?>
                                        <b>Summary</b>
                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="0"
                                               <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][9] == 0): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'none'), $this);?>

                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="1"
                                               <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][9] == 1): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'all'), $this);?>

                                        <br>
                                        <input type="radio" name="RightsLevel2[9]" value="2"
                                               <?php if ($this->_tpl_vars['info']['UserRightsLevel2'][$_GET['module']][9] == 2): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'others (not own)'), $this);?>

                                    <?php endif; ?>

                                <?php endif; ?>
                            <?php endif; ?>
                        <?php endif; ?>
                        <br>
                    <?php endforeach; endif; unset($_from); ?>
                </fieldset>
                <?php if (! empty ( $this->_tpl_vars['rights_level3'] )): ?>
                    <br>
                    <fieldset>
                        <legend>Setari nivel 3</legend>
                        <?php $_from = $this->_tpl_vars['rights_level3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <br>
                            <table cellspacing="0" celpadding="0" cellpadding="4">
                                <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
        $this->_foreach['iter']['iteration']++;
?>
                                    <tr>
                                        <td><?php echo $this->_tpl_vars['item2']['name']; ?>
</td>
                                        <td align="center"><input type="radio" id="write_<?php echo $this->_tpl_vars['key2']; ?>
" name="RightsLevel3[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['key2']; ?>
]" value="2"
                                                                  <?php if ($this->_tpl_vars['info']['UserRightsLevel3'][$_GET['module']][$this->_tpl_vars['key']][$this->_tpl_vars['key2']] == 2): ?>checked<?php endif; ?>>write
                                        </td>
                                        <td align="center"><input type="radio" id="read_<?php echo $this->_tpl_vars['key2']; ?>
" name="RightsLevel3[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['key2']; ?>
]" value="1"
                                                                  <?php if ($this->_tpl_vars['info']['UserRightsLevel3'][$_GET['module']][$this->_tpl_vars['key']][$this->_tpl_vars['key2']] == 1): ?>checked<?php endif; ?>>read
                                        </td>
                                        <td align="center"><input type="radio" id="none_<?php echo $this->_tpl_vars['key2']; ?>
" name="RightsLevel3[<?php echo $this->_tpl_vars['key']; ?>
][<?php echo $this->_tpl_vars['key2']; ?>
]" value="0"
                                                                  <?php if ($this->_tpl_vars['info']['UserRightsLevel3'][$_GET['module']][$this->_tpl_vars['key']][$this->_tpl_vars['key2']] == 0): ?>checked<?php endif; ?>>none
                                        </td>
                                        <td align="center" width="150"><?php echo smarty_function_position(array('l2' => $this->_tpl_vars['key'],'l3' => $this->_tpl_vars['key2'],'pos' => $this->_foreach['iter']['iteration'],'pos_last' => $this->_foreach['iter']['total']), $this);?>
</td>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                                <tr>
                                    <td>&nbsp;</td>
                                    <td><a href="#" onclick="checkall('write'); return false;"><?php echo smarty_function_translate(array('label' => 'check all'), $this);?>
</a> | <a href="#"
                                                                                                                                      onclick="uncheckall('write'); return false;"><?php echo smarty_function_translate(array('label' => 'uncheck all'), $this);?>
</a>
                                    </td>
                                    <td><a href="#" onclick="checkall('read'); return false;"><?php echo smarty_function_translate(array('label' => 'check all'), $this);?>
</a> | <a href="#"
                                                                                                                                     onclick="uncheckall('read'); return false;"><?php echo smarty_function_translate(array('label' => 'uncheck all'), $this);?>
</a>
                                    </td>
                                    <td><a href="#" onclick="checkall('none'); return false;"><?php echo smarty_function_translate(array('label' => 'check all'), $this);?>
</a> | <a href="#"
                                                                                                                                     onclick="uncheckall('none'); return false;"><?php echo smarty_function_translate(array('label' => 'uncheck all'), $this);?>
</a>
                                    </td>
                                    <td align="center"><a href="<?php echo $_SERVER['REQUEST_URI']; ?>
&resetpos=1">reset</a></td>
                                </tr>
                            </table>
                        <?php endforeach; endif; unset($_from); ?>
                    </fieldset>
                <?php endif; ?>
                <br>
                <input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">&nbsp;&nbsp;<input type="button" value="<?php echo smarty_function_translate(array('label' => 'Inapoi'), $this);?>
"
                                                                                             onclick="window.location.href = './?m=admin&o=users';">
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'utilizatori si drepturi'), $this);?>
</span></td>
        </tr>
    </table>
</form>
<?php echo '
<script language="javascript">
    function checkall(type) {
        '; ?>

        <?php $_from = $this->_tpl_vars['rights_level3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
        document.getElementById(type + '_' + <?php echo $this->_tpl_vars['key2']; ?>
).checked = true;
        <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
    }

    function uncheckall(type) {
        '; ?>

        <?php $_from = $this->_tpl_vars['rights_level3']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
        <?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
        document.getElementById(type + '_' + <?php echo $this->_tpl_vars['key2']; ?>
).checked = false;
        <?php endforeach; endif; unset($_from); ?>
        <?php endforeach; endif; unset($_from); ?>
        <?php echo '
    }
</script>
'; ?>