<?php /* Smarty version 2.6.18, created on 2020-10-06 10:07:02
         compiled from persons_jobs.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_jobs.tpl', 13, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
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
<br>
<table cellspacing="0" cellpadding="2" width="100%">
    <tr>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'JobTitle'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Angajator'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Data sfarsit'), $this);?>
</span></td>
        <td class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Status'), $this);?>
</span></td>
    </tr>
    <?php $_from = $this->_tpl_vars['jobs']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
        <tr height="30">
            <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['JobTitle']; ?>
</td>
            <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['CompanyName']; ?>
</td>
            <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['start_date']; ?>
</td>
            <td class="celulaMenuST"><?php echo $this->_tpl_vars['item']['stop_date']; ?>
</td>
            <td class="celulaMenuSTDR"><?php echo $this->_tpl_vars['item']['status']; ?>
<?php if (isset ( $this->_tpl_vars['item']['expertiza'] )): ?> | <?php echo smarty_function_translate(array('label' => 'expertiza'), $this);?>
<?php endif; ?></td>
        </tr>
        <?php endforeach; else: ?>
        <tr height="30">
            <td colspan="100" class="celulaMenuSTDR"><?php echo smarty_function_translate(array('label' => 'Nu sunt date'), $this);?>
!</td>
        </tr>
    <?php endif; unset($_from); ?>
</table>