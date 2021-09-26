<?php /* Smarty version 2.6.18, created on 2020-09-09 09:25:49
         compiled from persons_incadrare.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_incadrare.tpl', 14, false),array('modifier', 'default', 'persons_incadrare.tpl', 30, false),array('modifier', 'date_format', 'persons_incadrare.tpl', 272, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers">
    <table border="0" cellpadding="4" cellspacing="0" width="100%">
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
        <?php if ($_GET['msg'] == 1 || ( ! empty ( $_POST ) && $this->_tpl_vars['err']->getErrors() == "" )): ?>
            <tr height="30">
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #0000FF; padding-top: 10px;"><?php echo smarty_function_translate(array('label' => 'Datele au fost salvate!'), $this);?>
</td>
            </tr>
        <?php endif; ?>
        <?php if ($this->_tpl_vars['err']->getErrors()): ?>
            <tr>
                <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
            </tr>
        <?php endif; ?>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Incadrare'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Marca'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="EmpCode" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['EmpCode'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="16"></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Buget'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <table cellspacing="0" cellpadding="0">
                                    <?php $_from = $this->_tpl_vars['costcenter_persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td style="padding-right: 10px;">
                                                <select id="CostCenterID_<?php echo $this->_tpl_vars['key']; ?>
" class="dropdown">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                            <?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#"
                                                                            onclick="if (document.getElementById('CostCenterID_<?php echo $this->_tpl_vars['key']; ?>
').value > 0) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=edit&ID=<?php echo $this->_tpl_vars['key']; ?>
&CostCenterID=' + document.getElementById('CostCenterID_<?php echo $this->_tpl_vars['key']; ?>
').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati ales centrul de cost!'), $this);?>
'); return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Modifica centru de cost'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del&ID=<?php echo $this->_tpl_vars['key']; ?>
&CostCenterID=' + document.getElementById('CostCenterID_<?php echo $this->_tpl_vars['key']; ?>
').value; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge centru de cost'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php else: ?>
                                                <td colspan="2">&nbsp;</td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <tr>
                                        <td style="padding-right: 10px;">
                                            <select id="CostCenterID" class="dropdown">
                                                <option value="0"></option>
                                                <?php $_from = $this->_tpl_vars['costcenter']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                    <option value="<?php echo $this->_tpl_vars['key']; ?>
"><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                <?php endforeach; endif; unset($_from); ?>
                                            </select>
                                        </td>
                                        <td colspan="2"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                <div id="button_add"><a href="#"
                                                                        onclick="if (document.getElementById('CostCenterID').value > 0) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=new&CostCenterID=' + document.getElementById('CostCenterID').value; else alert('<?php echo smarty_function_translate(array('label' => 'Nu ati ales centrul de cost!'), $this);?>
'); return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Adauga centru de cost'), $this);?>
"><b>Add</b></a></div><?php else: ?>&nbsp;<?php endif; ?></td>
                                    </tr>
                                </table>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Sef compartiment'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DirectManagerID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['directmanager']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['DirectManagerID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['DirectManagerID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Manager delegat'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="FunctionalManagerID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['directmanager']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['FunctionalManagerID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['FunctionalManagerID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <!--<tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Responsabil aprobare concediu<br>(implicit Manager Direct)'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="VacationManagerID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['directmanager']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['VacationManagerID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['VacationManagerID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>-->
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Evaluator I'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege evaluator I...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ManagerID'] ) && $this->_tpl_vars['info']['ManagerID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="ManagerIDOld" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ManagerID'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Contrasemnatar I'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID2">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege contrasemnatar I...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ManagerID2'] ) && $this->_tpl_vars['info']['ManagerID2'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="ManagerIDOld2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ManagerID2'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Contrasemnatar II'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID3">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege contrasemnatar II...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ManagerID3'] ) && $this->_tpl_vars['info']['ManagerID3'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="ManagerIDOld3" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ManagerID3'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Contrasemnatar III'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID4">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege contrasemnatar III...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ManagerID4'] ) && $this->_tpl_vars['info']['ManagerID4'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="ManagerIDOld4" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ManagerID4'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Indrumator'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="ManagerID5">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege Indrumator...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['managers']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ManagerID5'] ) && $this->_tpl_vars['info']['ManagerID5'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="ManagerIDOld5" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ManagerID5'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Institutie'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="CompanyID" class="dropdown"
                                        onchange="showInfo('ajax.php?o=functionsbycompany&CompanyID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_InternalFunctions');">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['CompanyID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Organigrama Nivel 1'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DivisionID" onchange="showInfo('ajax.php?o=department&DivisionID=' + this.value, 'DepartmentID');" class="dropdown">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['DivisionID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Organigrama Nivel 2'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <div id="DepartmentID">
                                    <select name="DepartmentID" onchange="showInfo('ajax.php?o=subdepartment&DepartmentID=' + this.value, 'SubDepartmentID');" class="dropdown">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['DepartmentID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Organigrama Nivel 3'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <div id="SubDepartmentID">
                                    <select name="SubDepartmentID" onchange="showInfo('ajax.php?o=subsubdepartment&SubDepartmentID=' + this.value, 'SubSubDepartmentID');"
                                            class="dropdown">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['SubDepartmentID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Organigrama Nivel 4'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <div id="SubSubDepartmentID">
                                    <select name="SubSubDepartmentID" class="dropdown">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['subsubdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['SubSubDepartmentID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['SubSubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </div>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Transe de vechime'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="TranseVechime" class="dropdown">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['transeVechime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['TranseVechime'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['TranseVechime']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr valign="top">
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Cod COR'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="FunctionID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['FunctionID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['FunctionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']['Function']; ?>
 - <?php echo $this->_tpl_vars['item']['COR']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <input type="hidden" name="FunctionIDOld" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FunctionID'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                                <?php if (! empty ( $this->_tpl_vars['functionsh'] )): ?>
                                    <br>
                                    <p><a href="#"
                                          onclick="var status = document.getElementById('div_func').style.display; if (status == 'none') Effect.SlideDown('div_func'); else Effect.SlideUp('div_func'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric functii'), $this);?>
</b></a>
                                    </p>
                                    <div id="div_func" style="display:none;">
                                        <?php $_from = $this->_tpl_vars['functionsh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                                            <table cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td colspan="3" <?php if (! ($this->_foreach['iter']['iteration'] <= 1)): ?>style="padding-top: 10px; border-top: 1px solid #cccccc;"<?php endif; ?>>
                                                        <b><?php echo $this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function']; ?>
 - <?php echo $this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR']; ?>
</b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 10px;">
                                                        <input type="text" id="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"
                                                               value="<?php if (! empty ( $this->_tpl_vars['item']['StartDate'] ) && $this->_tpl_vars['item']['StartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_<?php echo $this->_tpl_vars['key']; ?>
">
                                                            var cal1_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                            cal1_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                            cal1_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                            //writeSource("js1_<?php echo $this->_tpl_vars['key']; ?>
");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                        <input type="text" id="EndDate_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"
                                                               value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_<?php echo $this->_tpl_vars['key']; ?>
">
                                                            var cal2_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                            cal2_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                            cal2_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                            //writeSource("js2_<?php echo $this->_tpl_vars['key']; ?>
");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal2_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('EndDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                           NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                    </td>
                                                    <td width="20" align="right"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput') && checkDate(document.getElementById('EndDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&FID=<?php echo $this->_tpl_vars['item']['FID']; ?>
&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&EndDate=' + document.getElementById('EndDate_<?php echo $this->_tpl_vars['key']; ?>
').value; return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                                    <td width="20" align="right"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&FID=<?php echo $this->_tpl_vars['item']['FID']; ?>
&del=1'; return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                                </tr>
                                            </table>
                                            <br>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </div>
                                <?php endif; ?>

                            </td>
                        </tr>
                        <!--<tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Grupa de munca'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><input type="text" name="WorkGroup" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['WorkGroup'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="32"></td>
                        </tr>-->
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Functia interna'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <div style="float:left;" id="div_InternalFunctions"></div>
                                <!--<select name="InternalFunction">
			    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
			    <?php $_from = $this->_tpl_vars['internal_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
				<?php $_from = $this->_tpl_vars['item']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
        $this->_foreach['iter2']['iteration']++;
?>
				<?php if (($this->_foreach['iter2']['iteration'] <= 1)): ?><optgroup label="<?php echo $this->_tpl_vars['item2']['GroupName']; ?>
"><?php endif; ?>
				<option value="<?php echo $this->_tpl_vars['key2']; ?>
" <?php if ($this->_tpl_vars['key2'] == $this->_tpl_vars['info']['InternalFunction']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item2']['Function']; ?>
 [<?php echo $this->_tpl_vars['item2']['GroupName']; ?>
 | <?php echo $this->_tpl_vars['item2']['Grad']; ?>
]</option>
				<?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?></optgroup><?php endif; ?>
				<?php endforeach; endif; unset($_from); ?>
			    <?php endforeach; endif; unset($_from); ?>
			</select>
			-->
                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                <!--<input type="checkbox" value="1" name="Trainer" <?php if ($this->_tpl_vars['info']['Trainer'] == 1): ?>checked="checked"<?php endif; ?>/> Trainer-->
                                <input type="hidden" name="InternalFunctionOld" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['InternalFunction'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
">
                                <?php if (! empty ( $this->_tpl_vars['internal_functionsh'] )): ?>
                                    <br>
                                    <p><a href="#"
                                          onclick="var status = document.getElementById('div_internal_func').style.display; if (status == 'none') Effect.SlideDown('div_internal_func'); else Effect.SlideUp('div_internal_func'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric functii interne'), $this);?>
</b></a>
                                    </p>
                                    <div id="div_internal_func" style="display:none;">
                                        <?php $_from = $this->_tpl_vars['internal_functionsh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                                            <table cellspacing="0" cellpadding="2">
                                                <tr>
                                                    <td colspan="3" <?php if (! ($this->_foreach['iter']['iteration'] <= 1)): ?>style="padding-top: 10px; border-top: 1px solid #cccccc;"<?php endif; ?>>
                                                        <b><?php $_from = $this->_tpl_vars['internal_functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?><?php if (isset ( $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']] )): ?><?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['Function']; ?>
 [<?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['GroupName']; ?>
 | <?php echo $this->_tpl_vars['item2'][$this->_tpl_vars['item']['FunctionID']]['Grad']; ?>
]<?php endif; ?><?php endforeach; endif; unset($_from); ?></b>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <td style="padding-right: 10px;">
                                                        <input type="text" id="StartDate_i_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"
                                                               value="<?php if (! empty ( $this->_tpl_vars['item']['StartDate'] ) && $this->_tpl_vars['item']['StartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js1_i_<?php echo $this->_tpl_vars['key']; ?>
">
                                                            var cal1_i_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                            cal1_i_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                            cal1_i_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                            //writeSource("js1_i_<?php echo $this->_tpl_vars['key']; ?>
");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal1_i_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('StartDate_i_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_i_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                           NAME="anchor1_i_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_i_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                        <input type="text" id="EndDate_i_<?php echo $this->_tpl_vars['key']; ?>
" class="formstyle"
                                                               value="<?php if (! empty ( $this->_tpl_vars['item']['EndDate'] ) && $this->_tpl_vars['item']['EndDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                                               size="10" maxlength="10">
                                                        <SCRIPT LANGUAGE="JavaScript" ID="js2_i_<?php echo $this->_tpl_vars['key']; ?>
">
                                                            var cal2_i_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                                            cal2_i_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                                            cal2_i_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                                            //writeSource("js2_i_<?php echo $this->_tpl_vars['key']; ?>
");
                                                        </SCRIPT>
                                                        <A HREF="#"
                                                           onClick="cal2_i_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('EndDate_i_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_i_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                                           NAME="anchor2_i_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_i_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                                    </td>
                                                    <td width="20" align="right"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_mod"><a href="#"
                                                                                    onclick="if (checkDate(document.getElementById('StartDate_i_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput') && checkDate(document.getElementById('EndDate_i_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data sfarsit')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&internal=1&FID=<?php echo $this->_tpl_vars['item']['FID']; ?>
&StartDate=' + document.getElementById('StartDate_i_<?php echo $this->_tpl_vars['key']; ?>
').value + '&EndDate=' + document.getElementById('EndDate_i_<?php echo $this->_tpl_vars['key']; ?>
').value; return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Modifica'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                                    <td width="20" align="right"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                                            <div id="button_del"><a href="#"
                                                                                    onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = '<?php echo $_SERVER['REQUEST_URI']; ?>
&FID=<?php echo $this->_tpl_vars['item']['FID']; ?>
&delinternal=1'; return false;"
                                                                                    title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                                </tr>
                                            </table>
                                            <br>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </div>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Observatii functia CIM'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;"><textarea name="CIMFunction" rows="6" cols="60" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CIMFunction'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Locatie'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="SiteID">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['sites']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['SiteID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['SiteID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Interval depunere declaratie avere'), $this);?>
:</b></td>
                            <td style="padding-top: 10px;">
                                <select name="DeclaratieAvere">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <option value="1"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '1' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'Anual / aferent an fiscal anterior'), $this);?>
</option>
                                    <option value="2"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '2' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => '30 de zile de la data numirii sau alegerii in functie'), $this);?>
</option>
                                    <option value="3"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '3' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => '30 de zile de la data incetarii activitatii'), $this);?>
</option>
                                    <option value="4"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '4' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => '30 de zile de la data inceperii activitatii'), $this);?>
</option>
                                    <option value="5"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '5' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'plecarea din institutie a personalului de conducere / executie'), $this);?>
</option>
                                    <option value="6"
                                            <?php if (! empty ( $this->_tpl_vars['info']['DeclaratieAvere'] ) && '5' == $this->_tpl_vars['info']['DeclaratieAvere']): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => '30 de zile de la data incetarii suspendarii pentru personalul suspendat pe o perioada ce acopera un an fiscal'), $this);?>
</option>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td>&nbsp;</td>
                            <td style="padding-top: 29px;"><?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
"
                                                                                                            class="formstyle"><?php endif; ?> <input type="button"
                                                                                                                                           value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
                                                                                                                                           onclick="window.location='./?m=persons'"
                                                                                                                                           class="formstyle"></td>
                        </tr>

                    </table>
                </fieldset>
            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Descriere job'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td colspan="2">
                                <b><?php echo smarty_function_translate(array('label' => 'Fisa post'), $this);?>
:</b><br>
                                <input type="file" name="JDFile">
                                <?php if (isset ( $this->_tpl_vars['info']['JDFilePath'] )): ?>
                                    <a href="<?php echo $this->_tpl_vars['info']['JDFilePath']; ?>
" title="" target="_blank"><?php echo smarty_function_translate(array('label' => 'Vizualizeaza'), $this);?>
</a>
                                    &nbsp;|&nbsp;
                                    <a href="#"
                                       onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Esti sigur(a) ca vrei sa stergi acest document?'), $this);?>
')) window.location.href='./?m=persons&o=del_jd_file&PersonID=<?php echo $_GET['PersonID']; ?>
'; return false;"
                                       title="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
 class=" blue
                                    "><?php echo smarty_function_translate(array('label' => 'sterge'), $this);?>
</a>
                                <?php endif; ?>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2">
                                <b><?php echo smarty_function_translate(array('label' => 'Descriere rol'), $this);?>
:</b><br>
                                <textarea name="RolDescr" style="width: 100%" cols="40" rows="10" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RolDescr'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 13px">
                                <b><?php echo smarty_function_translate(array('label' => 'Responsabilitati principale'), $this);?>
:</b><br>
                                <textarea name="RespMain" style="width: 100%" rows="10" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RespMain'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                            </td>
                        </tr>
                        <tr>
                            <td colspan="2" style="padding-top: 13px">
                                <b><?php echo smarty_function_translate(array('label' => 'Responsabilitati generale'), $this);?>
:</b><br>
                                <textarea name="RespGen" style="width: 100%" rows="10" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['RespGen'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                            </td>
                        </tr>
                    </table>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Istoric functii'), $this);?>
</legend>
                    <p><a href="#"
                          onclick="var status = document.getElementById('div_hmod').style.display; if (status == 'none') Effect.SlideDown('div_hmod'); else Effect.SlideUp('div_hmod'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Istoric'), $this);?>
</b></a>
                    </p>
                    <div id="div_hmod" style="display:none;">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Tip'), $this);?>
</b></td>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Denumire'), $this);?>
</b></td>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</b></td>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</b></td>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Data modificare'), $this);?>
</b></td>
                            </tr>
                            <?php $_from = $this->_tpl_vars['cfunctionsh']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['func']):
?>
                                <tr>
                                    <td><?php if ($this->_tpl_vars['func']['Type'] == 1): ?><?php echo smarty_function_translate(array('label' => 'Cod COR'), $this);?>
<?php elseif ($this->_tpl_vars['func']['Type'] == 2): ?><?php echo smarty_function_translate(array('label' => 'Functie interna'), $this);?>
<?php endif; ?></td>
                                    <td><?php echo $this->_tpl_vars['func']['FName']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['func']['StartDate']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['func']['EndDate']; ?>
</td>
                                    <td><?php echo $this->_tpl_vars['func']['CreateDate']; ?>
</td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    </div>
                </fieldset>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>

<script type="text/javascript">
    showInfo('ajax.php?o=functionsbycompany&CompanyID=' + <?php echo $this->_tpl_vars['info']['CompanyID']; ?>
 +'&FunctionID=' + <?php echo $this->_tpl_vars['info']['InternalFunction']; ?>
 +'&rand=' + parseInt(Math.random() * 999999999), 'div_InternalFunctions');
</script>