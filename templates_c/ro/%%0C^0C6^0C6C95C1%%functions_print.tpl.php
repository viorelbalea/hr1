<?php /* Smarty version 2.6.18, created on 2021-07-01 08:29:09
         compiled from functions_print.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'functions_print.tpl', 3, false),array('function', 'math', 'functions_print.tpl', 34, false),array('modifier', 'default', 'functions_print.tpl', 42, false),)), $this); ?>
<html>
<head>
    <title><?php echo smarty_function_translate(array('label' => 'Soft Resurse Umane'), $this);?>
</title>
    <?php if ($_GET['action'] != 'export_doc' && $_GET['action'] != 'export'): ?>
        <link href="images/style.css" rel="stylesheet" type="text/css">
    <?php endif; ?>
</head>

<body topmargin="5" onLoad="window.print();">


<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox">#</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
</span></td>

        <td>
            <table cellspacing="0" cellpadding="4" width="100%">
                <tr>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Companie'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="200"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Functie superioara'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii definite'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii ocupate'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="70"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Pozitii libere'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="80"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Vechime in companie (ani)'), $this);?>
</span></td>
                    <td class="bkdTitleMenu" width="80"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Vechime in functie (ani)'), $this);?>
</span></td>
                </tr>
            </table>
        </td>
    </tr>
    <?php $_from = $this->_tpl_vars['functions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter1'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter1']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter1']['iteration']++;
?>
        <?php if ($this->_tpl_vars['key'] > 0): ?>
            <tr height="30">
                <td class="celulaMenuST"><?php echo smarty_function_math(array('equation' => "x-y",'x' => $this->_foreach['iter1']['iteration'],'y' => 1), $this);?>
</td>
                <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['Function']; ?>
</td>
                <td class="celulaMenuSTDR">
                    <?php if ($this->_tpl_vars['item']['Companies']): ?>
                        <table cellspacing="0" cellpadding="2" width="100%">
                            <?php $_from = $this->_tpl_vars['item']['Companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter2'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter2']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['c']):
        $this->_foreach['iter2']['iteration']++;
?>
                                <tr>
                                    <td width="200" class="celulaMenuST"
                                        style="border-left:none; <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>border-bottom:none;<?php endif; ?>"><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['CompanyName'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="200" class="celulaMenuST"
                                        <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['parent_functions'][$this->_tpl_vars['c']['ParentFunctionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST" <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['Positions'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST" <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['PositionsOccupied'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="70" class="celulaMenuST" <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['PositionsFree'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="80" class="celulaMenuST" <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['CompanyAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                    <td width="80" class="celulaMenuST" <?php if (($this->_foreach['iter2']['iteration'] == $this->_foreach['iter2']['total'])): ?>style="border-bottom:none;"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['c']['TotalAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                                </tr>
                            <?php endforeach; endif; unset($_from); ?>
                        </table>
                    <?php else: ?>
                        &nbsp;
                    <?php endif; ?>
                </td>
                <!--
        <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Department'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
        <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['parent_functions'][$this->_tpl_vars['item']['ParentFunctionID']])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
        <td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Positions'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
		<td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['PositionsOccupied'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
		<td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['PositionsFree'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
		<td class="celulaMenuST"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CompanyAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
		<td class="celulaMenuSTDR"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TotalAge'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
		-->
            </tr>
        <?php endif; ?>
    <?php endforeach; endif; unset($_from); ?>
    <?php if (count ( $this->_tpl_vars['functions'] ) == 1): ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; ?>
</table>

</body>
</html>