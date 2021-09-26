<?php /* Smarty version 2.6.18, created on 2021-03-25 07:56:36
         compiled from persons_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_print.tpl', 3, false),array('function', 'math', 'persons_print.tpl', 30, false),array('modifier', 'default', 'persons_print.tpl', 40, false),)), $this); ?>
<html>
<head>
    <title><?php echo smarty_function_translate(array('label' => 'Soft Resurse Umane'), $this);?>
</title>
    <?php if ($_GET['action'] != 'export_doc'): ?>
        <link href="images/style.css" rel="stylesheet" type="text/css">
    <?php endif; ?>
</head>

<body topmargin="5" onLoad="window.print();">

<table cellspacing="0" cellpadding="2" width="100%" <?php if ($_GET['action'] == 'export_doc'): ?> BORDER="1" <?php endif; ?>>
    <tr BGCOLOR="#CCCCCC">
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</span></td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Personal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['label']; ?>
</span></td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Oras'), $this);?>
</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Varsta'), $this);?>
</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30" BGCOLOR="#F9F9F9">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "(x-y)+(z-y)*t",'x' => $this->_foreach['iter1']['iteration'],'y' => 1,'z' => $this->_tpl_vars['persons']['0']['page'],'t' => $this->_tpl_vars['res_per_page']), $this);?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Personal'] )): ?>
                    <?php $_from = $this->_tpl_vars['personalisedlist']['Personal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter']['iteration']++;
?>
                        <td class="celulaMenuST<?php if (($this->_foreach['iter']['iteration'] == $this->_foreach['iter']['total'])): ?>DR<?php endif; ?>">
                            <?php if ($this->_tpl_vars['field'] == 'Status'): ?>
                                <?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'MaritalStatus'): ?>
                                <?php echo $this->_tpl_vars['maritalstatus'][$this->_tpl_vars['item']['MaritalStatus']]; ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CVStatus'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['cvstatus'][$this->_tpl_vars['item']['CVStatus']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CostCenters'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'JobDictionaryID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtitles'][$this->_tpl_vars['item']['JobDictionaryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'ContractType'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['contract_type'][$this->_tpl_vars['item']['ContractType']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'FunctionID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
 - <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'InternalFunction'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['internal_functions'][$this->_tpl_vars['item']['InternalFunction']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php elseif ($this->_tpl_vars['field'] == 'RoleID'): ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['roles'][$this->_tpl_vars['item']['RoleID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php else: ?>
                                <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                            <?php endif; ?>
                        </td>
                    <?php endforeach; endif; unset($_from); ?>
                <?php else: ?>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['DistrictName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CityName']; ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['varsta'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td class="celulaMenuSTDR"><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['item']['Status']]; ?>
</td>
                <?php endif; ?>
            </tr>
        <?php endif; ?>
        <?php endforeach; else: ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; unset($_from); ?>
</table>

</body>
</html>