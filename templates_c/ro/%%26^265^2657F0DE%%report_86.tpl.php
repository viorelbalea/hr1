<?php /* Smarty version 2.6.18, created on 2021-09-07 07:34:09
         compiled from report_86.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'report_86.tpl', 2, false),array('modifier', 'default', 'report_86.tpl', 67, false),)), $this); ?>
<?php if (in_array ( 'Year' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <?php echo smarty_function_translate(array('label' => 'Anul'), $this);?>

    <select name="Year" id="Year">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'selecteaza'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($_GET['Year'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
<?php else: ?>
    <input type="hidden" name="Year" id="Year" value="0"/>
<?php endif; ?>
<?php if (in_array ( 'CompanyID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <select id="CompanyID" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege companie'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['self']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['CompanyID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    &nbsp;&nbsp;&nbsp;
<?php else: ?>
    <input type="hidden" name="CompanyID" id="CompanyID" value="0"/>
<?php endif; ?>
<?php if (in_array ( 'DivisionID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <select id="DivisionID" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege divizie'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['DivisionID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    &nbsp;&nbsp;&nbsp;
<?php else: ?>
    <input type="hidden" name="DivisionID" id="DivisionID" value="0"/>
<?php endif; ?>
<?php if (in_array ( 'DepartmentID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <select id="DepartmentID" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege departament'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['DepartmentID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    &nbsp;&nbsp;&nbsp;
<?php else: ?>
    <input type="hidden" name="DepartmentID" id="DepartmentID" value="0"/>
<?php endif; ?>
<?php if (in_array ( 'SubdepartmentID' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <select id="SubdepartmentID" style="width:150px;">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege subdepartament'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['subdepartments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['SubdepartmentID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    &nbsp;&nbsp;&nbsp;
<?php else: ?>
    <input type="hidden" name="SubdepartmentID" id="SubdepartmentID" value="0"/>
<?php endif; ?>
<?php if (in_array ( 'Status' , $this->_tpl_vars['lstVisibleFilters'] )): ?>
    <select id="Status">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege status'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['Status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
<?php else: ?>
    <input type="hidden" name="Status" id="Status" value="0"/>
<?php endif; ?>
&nbsp;&nbsp;&nbsp;<input type="button" value="<?php echo smarty_function_translate(array('label' => 'Afiseaza'), $this);?>
"
                         onclick="window.location.href = './?m=reports&GroupID=<?php echo ((is_array($_tmp=@$_GET['GroupID'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
&rep=<?php echo $_GET['rep']; ?>
'+
                                 '&Year=' + document.getElementById('Year').value+
                                 '&Status=' + document.getElementById('Status').value +
                                 '&CompanyID=' + document.getElementById('CompanyID').value +
                                 '&DivisionID=' + document.getElementById('DivisionID').value +
                                 '&DepartmentID=' + document.getElementById('DepartmentID').value +
                                 '&SubdepartmentID=' + document.getElementById('SubdepartmentID').value;">
<?php if (! empty ( $_GET['Year'] )): ?>
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <td><b>#</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</b></td>
            <td align="center"><b><?php echo smarty_function_translate(array('label' => 'Disponibil la sfarsitul'), $this);?>
 <?php echo $this->_tpl_vars['persons']['PrevYear']; ?>
</b></td>
            <td align="center"><b><?php echo smarty_function_translate(array('label' => 'Cuvenite in'), $this);?>
 <?php echo $this->_tpl_vars['persons']['CurrYear']; ?>
</b></td>
            <td align="center"><b><?php echo smarty_function_translate(array('label' => 'Disponibil la inceputul'), $this);?>
 <?php echo $this->_tpl_vars['persons']['CurrYear']; ?>
</b></td>
            <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
                <td align="center"><b>Disponibil la sfarsitul <?php echo $this->_tpl_vars['key']; ?>
</b></td>
            <?php endforeach; endif; unset($_from); ?>
        </tr>
        <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <tr>
            <?php if ($this->_tpl_vars['key'] > 0): ?>
                <td><?php echo $this->_foreach['iter']['iteration']-2; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Department'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp') : smarty_modifier_default($_tmp, '&nbsp')); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['PrevTotalCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CurrTotalCORef'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CurrTotalCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key2'] => $this->_tpl_vars['item2']):
        $this->_foreach['iter2']['iteration']++;
?>
                    <td>
                        <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['key2']]['RemCO'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                    </td>
                <?php endforeach; endif; unset($_from); ?>
                </tr>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </table>
<?php endif; ?>