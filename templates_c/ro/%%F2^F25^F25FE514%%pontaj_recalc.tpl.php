<?php /* Smarty version 2.6.18, created on 2021-03-30 07:55:26
         compiled from pontaj_recalc.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_recalc.tpl', 4, false),array('modifier', 'date_format', 'pontaj_recalc.tpl', 6, false),array('modifier', 'default', 'pontaj_recalc.tpl', 16, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "pontaj_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>

<div class="filter">
    <label><?php echo smarty_function_translate(array('label' => 'Perioada intre '), $this);?>
</label>
    <input type="text" name="StartDate" id="StartDate" class="formstyle"
           value="<?php if (! empty ( $_GET['StartDate'] )): ?><?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?><?php echo ((is_array($_tmp=time())) ? $this->_run_mod_handler('date_format', true, $_tmp, '01-%m-%Y') : smarty_modifier_date_format($_tmp, '01-%m-%Y')); ?>
<?php endif; ?>" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js1">
        var cal1 = new CalendarPopup();
        cal1.isShowNavigationDropdowns = true;
        cal1.setYearSelectStartOffset(10);
        //writeSource("js1");
    </SCRIPT>
    <label><A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A></label>
    <label>si</label>
    <input type="text" name="StopDate" id="StopDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['StopDate'])) ? $this->_run_mod_handler('default', true, $_tmp, time()) : smarty_modifier_default($_tmp, time())))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
    <SCRIPT LANGUAGE="JavaScript" ID="js2">
        var cal2 = new CalendarPopup();
        cal2.isShowNavigationDropdowns = true;
        cal2.setYearSelectStartOffset(10);
        //writeSource("js2");
    </SCRIPT>
    <label><A HREF="#" onClick="cal2.select(document.getElementById('StopDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A></label>
    <input type="button" value="Genereaza" class="cod" onclick="window.location.href = './?m=pontaj&o=precalc' +
											   '&StartDate=' + escape(document.getElementById('StartDate').value) + 
											   '&StopDate=' + escape(document.getElementById('StopDate').value) + 
											   '&recalc=1'">
</div>

<?php if (! empty ( $this->_tpl_vars['success'] )): ?>
    <?php echo smarty_function_translate(array('label' => 'Recalculare finalizata'), $this);?>
!
<?php endif; ?>