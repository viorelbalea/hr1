<?php /* Smarty version 2.6.18, created on 2020-10-07 12:16:28
         compiled from pontaj_simplu_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_simplu_print.tpl', 3, false),array('modifier', 'default', 'pontaj_simplu_print.tpl', 32, false),)), $this); ?>
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
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Persoane'), $this);?>
</span></td>
        <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj'] )): ?>
            <?php $_from = $this->_tpl_vars['personalisedlist']['Pontaj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
?>
                <td class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['label']; ?>
</span></td>
            <?php endforeach; endif; unset($_from); ?>
        <?php else: ?>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
</span></td>
            <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
</span></td>
        <?php endif; ?>
    </tr>
    <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
        <tr height="30" BGCOLOR="#F9F9F9">
            <td class="celulaMenuST" width="30"><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
            <td class="celulaMenuST"><a href="./?m=pontaj&o=psimple&o=psimple_day&PersonID=<?php echo $this->_tpl_vars['item']['PersonID']; ?>
" class="blue"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</a></td>
            <?php if (! empty ( $this->_tpl_vars['personalisedlist']['Pontaj'] )): ?>
                <?php $_from = $this->_tpl_vars['personalisedlist']['Pontaj']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['field'] => $this->_tpl_vars['label']):
        $this->_foreach['iter1']['iteration']++;
?>
                    <td class="celulaMenuST<?php if (($this->_foreach['iter1']['iteration'] == $this->_foreach['iter1']['total'])): ?>DR<?php endif; ?>">
                        <?php if ($this->_tpl_vars['field'] == 'DivisionID'): ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['divisions'][$this->_tpl_vars['item']['DivisionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php elseif ($this->_tpl_vars['field'] == 'DepartmentID'): ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php elseif ($this->_tpl_vars['field'] == 'CostCenterID'): ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CostCenters'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php elseif ($this->_tpl_vars['field'] == 'JobDictionaryID'): ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['jobtitles'][$this->_tpl_vars['item']['JobDictionaryID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php elseif ($this->_tpl_vars['field'] == 'FunctionID'): ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['Function'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
 - <?php echo ((is_array($_tmp=@$this->_tpl_vars['functions'][$this->_tpl_vars['item']['FunctionID']]['COR'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php else: ?>
                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['item'][$this->_tpl_vars['field']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>

                        <?php endif; ?>
                    </td>
                <?php endforeach; endif; unset($_from); ?>
            <?php else: ?>
                <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Email'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                <td class="celulaMenuSTDR"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Phone'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
            <?php endif; ?>
        </tr>
    <?php endforeach; endif; unset($_from); ?>
</table>

</body>
</html>