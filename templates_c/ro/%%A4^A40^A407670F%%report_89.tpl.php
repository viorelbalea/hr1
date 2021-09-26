<?php /* Smarty version 2.6.18, created on 2021-08-17 10:07:15
         compiled from report_89.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'report_89.tpl', 6, false),array('function', 'orderby', 'report_89.tpl', 98, false),array('modifier', 'default', 'report_89.tpl', 53, false),array('modifier', 'cat', 'report_89.tpl', 82, false),)), $this); ?>
<?php if (empty ( $_GET['export'] ) && empty ( $_GET['export_doc'] ) && empty ( $_GET['print_page'] ) && empty ( $_GET['print'] ) && empty ( $_GET['print_all'] )): ?>
    <div class="filter">
        <?php if ($_SESSION['USER_ID'] == 1 || ! empty ( $_SESSION['USER_COMPANYSELF'] )): ?>
            <?php if (in_array ( 'CompanyID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
                <select id="CompanyID" name="CompanyID" class="dropdown">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Companie self'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <?php if ($_SESSION['USER_ID'] == 1 || in_array ( $this->_tpl_vars['key'] , $_SESSION['USER_COMPANYSELF'] )): ?>
                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['CompanyID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                        <?php endif; ?>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php else: ?>
                <input type="hidden" id="CompanyID" value="0"/>
            <?php endif; ?>
        <?php endif; ?>
        <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
            <?php if (in_array ( 'DivisionID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
                <select id="DivisionID" name="DivisionID" class="dropdown">
                    <option value="0"><?php echo smarty_function_translate(array('label' => 'Divizie'), $this);?>
</option>
                    <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DivisionID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                </select>
            <?php else: ?>
                <input type="hidden" id="DivisionID" value="0"/>
            <?php endif; ?>
        <?php else: ?>
            <input type="hidden" name="DivisionID" value="0">
        <?php endif; ?>
        <?php if (in_array ( 'DepartmentID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
            <select id="DepartmentID" name="DepartmentID" class="dropdown" style="width:120px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" id="DepartmentID" value="0"/>
        <?php endif; ?>
        <?php if (in_array ( 'SubDepartmentID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
            <select id="SubDepartmentID" name="SubDepartmentID" class="dropdown" style="width:120px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Subdepartament'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['SubDepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" id="SubDepartmentID" value="0"/>
        <?php endif; ?>
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Trimite'), $this);?>
" onclick="
                var x = +document.getElementById('ShowLeft').checked;
                window.location.href = './?m=reports&GroupID=<?php echo ((is_array($_tmp=@$_GET['GroupID'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
&rep=<?php echo $_GET['rep']; ?>
&ShowLeft='+x+
                '&Status=' + document.getElementById('Status').value +
                '&ContractType=' + document.getElementById('ContractType').value +
                '&DivisionID=' + document.getElementById('DivisionID').value +
                '&CompanyID=' + document.getElementById('CompanyID').value +
                '&DepartmentID=' + document.getElementById('DepartmentID').value +
                '&SubDepartmentID=' + document.getElementById('SubDepartmentID').value;">
        <?php if (in_array ( 'ShowLeft' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
            <label><?php echo smarty_function_translate(array('label' => 'Afiseaza plecati'), $this);?>
</label>
            <input type="checkbox" id="ShowLeft" name="ShowLeft" value="1" <?php if ($_GET['ShowLeft'] == 1): ?> checked="checked"<?php endif; ?> />
        <?php else: ?>
            <input type="hidden" id="ShowLeft" value="0"/>
        <?php endif; ?>
        <?php if (in_array ( 'ContractType' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
            <select id="ContractType" name="ContractType" style="width:150px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['contract_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['ContractType']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" id="ContractType" value="0"/>
        <?php endif; ?>
        <?php if (in_array ( 'Status' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
            <select id="Status" name="Status" class="cod" style="width:200px;">
                <option value="0"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</option>
                <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                    <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['Status']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                    <?php $_from = $this->_tpl_vars['substatus'][$this->_tpl_vars['key']]; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
?>
                        <option value="<?php echo $this->_tpl_vars['key']; ?>
_<?php echo $this->_tpl_vars['key2']; ?>
" <?php if (((is_array($_tmp=((is_array($_tmp=$this->_tpl_vars['key'])) ? $this->_run_mod_handler('cat', true, $_tmp, '_') : smarty_modifier_cat($_tmp, '_')))) ? $this->_run_mod_handler('cat', true, $_tmp, $this->_tpl_vars['key2']) : smarty_modifier_cat($_tmp, $this->_tpl_vars['key2'])) == $_GET['Status']): ?>selected<?php endif; ?>>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<?php echo $this->_tpl_vars['item2']; ?>
</option>
                    <?php endforeach; endif; unset($_from); ?>
                <?php endforeach; endif; unset($_from); ?>
            </select>
        <?php else: ?>
            <input type="hidden" id="Status" value="0"/>
        <?php endif; ?>
    </div>
<?php endif; ?>
<table width="100%" cellspacing="0" cellpadding="2" border="1" style="margin-top:6px;">
    <!-- Fields -->
    <tr>
        <td><b>#</b></td>
        <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['nfield'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['nfield']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['kfield'] => $this->_tpl_vars['field']):
        $this->_foreach['nfield']['iteration']++;
?>
            <?php if (! empty ( $this->_tpl_vars['field']['sort'] )): ?>
                <?php if ($this->_tpl_vars['field']['sort'] === 'asc'): ?>
                    <td align="center"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name'],'asc_or_desc' => 'asc'), $this);?>
</b></td>
                <?php elseif ($this->_tpl_vars['field']['sort'] === 'desc'): ?>
                    <td align="center"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name'],'asc_or_desc' => 'desc'), $this);?>
</b></td>
                <?php else: ?>
                    <td align="center"><b><?php echo smarty_function_orderby(array('label' => $this->_tpl_vars['field']['label'],'request_uri' => $this->_tpl_vars['request_uri'],'order_by' => $this->_tpl_vars['field']['name']), $this);?>
</b></td>
                <?php endif; ?>
            <?php else: ?>
                <td align="center"><b><?php echo smarty_function_translate(array('label' => $this->_tpl_vars['field']['label']), $this);?>
</b></td>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </tr>

    <!-- Values -->
    <?php $_from = $this->_tpl_vars['fields_data']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
        <tr>
            <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
            <?php $_from = $this->_tpl_vars['fields']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field']):
?>
                <?php $this->assign('field_name', $this->_tpl_vars['field']['name']); ?>
                <td<?php if ($this->_tpl_vars['field']['align']): ?> align="<?php echo $this->_tpl_vars['field']['align']; ?>
"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field_name']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp') : smarty_modifier_default($_tmp, '&nbsp')); ?>
</td>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php endforeach; else: ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu exista inregistrari!'), $this);?>
</td>
        </tr>
    <?php endif; unset($_from); ?>
</table>