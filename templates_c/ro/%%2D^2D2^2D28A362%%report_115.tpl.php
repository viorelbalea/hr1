<?php /* Smarty version 2.6.18, created on 2021-07-27 08:28:14
         compiled from report_115.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'report_115.tpl', 4, false),array('modifier', 'default', 'report_115.tpl', 30, false),array('modifier', 'date_format', 'report_115.tpl', 85, false),)), $this); ?>
<?php if (empty ( $_GET['export'] ) && empty ( $_GET['export_doc'] )): ?>
        <select id="CompanyID" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Toate companiile'), $this);?>
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
        <select id="DepartmentID" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Toate departamentele'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['departments']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <?php if (empty ( $this->_tpl_vars['deps'] ) || isset ( $this->_tpl_vars['deps'][$this->_tpl_vars['key']] )): ?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['key'] == $_GET['DepartmentID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <select id="Status" class="dropdown">
        <option value="0"><?php echo smarty_function_translate(array('label' => 'Alege status'), $this);?>
</option>
        <?php $_from = $this->_tpl_vars['status']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['Status'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
        <?php endforeach; endif; unset($_from); ?>
    </select>
    <div style="display: inline-block; margin: 0 5px;">
        <b><?php echo smarty_function_translate(array('label' => 'Se scad zile concediu si deplasari din perioada'), $this);?>
</b>
        <br><br>
        <?php echo smarty_function_translate(array('label' => 'Perioada intre'), $this);?>

        <input type="text" id="StartDate" class="formstyle" value="<?php echo ((is_array($_tmp=@$_GET['StartDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"
           title="<?php echo smarty_function_translate(array('label' => 'Data de inceput'), $this);?>
"><img src="./images/cal.png" border="0" alt="<?php echo smarty_function_translate(array('label' => 'Data de inceput'), $this);?>
"></A>
        <?php echo smarty_function_translate(array('label' => 'si'), $this);?>

        <input type="text" id="EndDate" class="formstyle" value="<?php echo ((is_array($_tmp=@$_GET['EndDate'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2"
           title="<?php echo smarty_function_translate(array('label' => 'Data de sfarsit'), $this);?>
"><img src="./images/cal.png" border="0" alt="<?php echo smarty_function_translate(array('label' => 'Data de sfarsit'), $this);?>
"></A>
    </div>
    <div style="display: inline-block; border-left:1px solid #000; padding: 0 5px;">
        <b><?php echo smarty_function_translate(array('label' => 'Se dau bonurile din luna/anul'), $this);?>
</b>
        <br><br>
        <?php echo smarty_function_translate(array('label' => 'luna'), $this);?>

        <select name="Month" id="Month">
            <option value=""><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['months']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($_GET['Month'] == $this->_tpl_vars['item']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
        <?php echo smarty_function_translate(array('label' => 'anul'), $this);?>

        <select name="Year" id="Year">
            <option value=""><?php echo smarty_function_translate(array('label' => 'alege'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['years']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($_GET['Year'] == $this->_tpl_vars['item']): ?> selected="selected" <?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    </div>
    &nbsp;&nbsp;&nbsp;
    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Trimite'), $this);?>
"
           onclick="window.location.href = './?m=reports&GroupID=<?php echo $_GET['GroupID']; ?>
&rep=<?php echo $_GET['rep']; ?>
&CompanyID=' + document.getElementById('CompanyID').value + '&DepartmentID=' + document.getElementById('DepartmentID').value + '&Status=' + document.getElementById('Status').value + '&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value + '&Month=' + document.getElementById('Month').value + '&Year=' + document.getElementById('Year').value;">
<?php endif; ?>
<?php if (! empty ( $_GET['StartDate'] )): ?>
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="2" border="1">
        <tr>
            <?php if (empty ( $_GET['export'] )): ?>
                <td><b>#</b></td>
            <?php endif; ?>
            <td><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'CNP'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Departament'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Numar zile lucratoare in luna '), $this);?>
<?php echo $this->_tpl_vars['info']['0']; ?>
-<?php echo $this->_tpl_vars['info']['1']; ?>
</b></td>
                        <td><b><?php echo smarty_function_translate(array('label' => 'Numar zile concediu in perioada '), $this);?>
<?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 - <?php echo ((is_array($_tmp=$_GET['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Zile invoire in perioada '), $this);?>
<?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 - <?php echo ((is_array($_tmp=$_GET['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Numar zile deplasare in perioada '), $this);?>
<?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 - <?php echo ((is_array($_tmp=$_GET['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Tichete aferente lunii '), $this);?>
<?php echo $this->_tpl_vars['info']['0']; ?>
-<?php echo $this->_tpl_vars['info']['1']; ?>
</b></td>
        </tr>
        <?php $_from = $this->_tpl_vars['persons']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <?php if (! empty ( $this->_tpl_vars['item']['FullName'] )): ?>
                <tr>
                    <?php if (empty ( $_GET['export'] )): ?>
                        <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
                    <?php endif; ?>
                    <td nowrap="nowrap"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                    <td nowrap="nowrap"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['CNP'])) ? $this->_run_mod_handler('default', true, $_tmp, '&nbsp;') : smarty_modifier_default($_tmp, '&nbsp;')); ?>
</td>
                    <td nowrap="nowrap"><?php echo ((is_array($_tmp=@$this->_tpl_vars['departments'][$this->_tpl_vars['item']['DepartmentID']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['wdays'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                                        <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['vdays'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['invdays'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['ddays'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                    <td><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['tickets'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                </tr>
            <?php endif; ?>
        <?php endforeach; endif; unset($_from); ?>
        <tr>
            <td colspan="7">&nbsp;</td>
            <td><strong><?php echo smarty_function_translate(array('label' => 'Total'), $this);?>
</strong></td>
            <td><strong><?php echo ((is_array($_tmp=@$this->_tpl_vars['persons']['TicketsTotal'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</strong></td>
        </tr>
    </table>
<?php endif; ?>