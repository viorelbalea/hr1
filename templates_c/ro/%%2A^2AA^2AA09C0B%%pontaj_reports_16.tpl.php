<?php /* Smarty version 2.6.18, created on 2020-10-06 13:02:40
         compiled from pontaj_reports_16.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'pontaj_reports_16.tpl', 3, false),array('function', 'math', 'pontaj_reports_16.tpl', 53, false),array('modifier', 'date_format', 'pontaj_reports_16.tpl', 3, false),array('modifier', 'default', 'pontaj_reports_16.tpl', 6, false),)), $this); ?>
<div class="filter">
    <?php if (! empty ( $_GET['action'] )): ?>
        <b><?php echo smarty_function_translate(array('label' => 'Raport pontaj personal perioada '), $this);?>
<?php echo ((is_array($_tmp=$_GET['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
 - <?php echo ((is_array($_tmp=$_GET['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</b>
    <?php else: ?>
        <?php echo smarty_function_translate(array('label' => 'Perioada intre '), $this);?>

        <input type="text" name="StartDate" id="StartDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['StartDate'])) ? $this->_run_mod_handler('default', true, $_tmp, time()) : smarty_modifier_default($_tmp, time())))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js1">
            var cal1 = new CalendarPopup();
            cal1.isShowNavigationDropdowns = true;
            cal1.setYearSelectStartOffset(10);
            //writeSource("js1");
        </SCRIPT>
        <A HREF="#" onClick="cal1.select(document.getElementById('StartDate'),'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1" title="Data de inceput"><img
                    src="./images/cal.png" border="0" alt="Data de inceput"></A>
        si
        <input type="text" name="EndDate" id="EndDate" class="formstyle" value="<?php echo ((is_array($_tmp=((is_array($_tmp=@$_GET['EndDate'])) ? $this->_run_mod_handler('default', true, $_tmp, time()) : smarty_modifier_default($_tmp, time())))) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
" size="10" maxlength="10">
        <SCRIPT LANGUAGE="JavaScript" ID="js2">
            var cal2 = new CalendarPopup();
            cal2.isShowNavigationDropdowns = true;
            cal2.setYearSelectStartOffset(10);
            //writeSource("js2");
        </SCRIPT>
        <A HREF="#" onClick="cal2.select(document.getElementById('EndDate'),'anchor2','dd.MM.yyyy'); return false;" NAME="anchor2" ID="anchor2" title="Data de sfarsit"><img
                    src="./images/cal.png" border="0" alt="Data de sfarsit"></A>
        <select id="Status">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'angajati total'), $this);?>
</option>
            <option value="2" <?php if ($_GET['Status'] == 2): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'angajati curenti'), $this);?>
</option>
            <option value="7" <?php if ($_GET['Status'] == 7): ?>selected<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'colaboratori'), $this);?>
</option>
        </select>
    <?php if (! empty ( $this->_tpl_vars['divisions'] )): ?>
        &nbsp;
        <select id="DivisionID">
            <option value="0"><?php echo smarty_function_translate(array('label' => 'alege divizia'), $this);?>
</option>
            <?php $_from = $this->_tpl_vars['divisions']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($_GET['DivisionID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
            <?php endforeach; endif; unset($_from); ?>
        </select>
    <?php endif; ?>
        &nbsp;&nbsp;&nbsp;
        <input type="button" value="Trimite"
               onclick="window.location.href = './?m=pontaj&o=reports&report_id=<?php echo $_GET['report_id']; ?>
&StartDate=' + document.getElementById('StartDate').value + '&EndDate=' + document.getElementById('EndDate').value<?php if (! empty ( $this->_tpl_vars['divisions'] )): ?> + '&Status=' + document.getElementById('Status').value + '&DivisionID=' + document.getElementById('DivisionID').value<?php endif; ?>;">
    <?php endif; ?>
</div>

<?php if (! empty ( $_GET['StartDate'] ) && ! empty ( $_GET['EndDate'] )): ?>
    <br>
    <br>
    <table width="100%" cellspacing="0" cellpadding="4" class="filter">
        <tr valign="bottom">
            <td colspan="5">&nbsp;</td>
            <?php $this->assign('ZL', '0'); ?>
            <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
        $this->_foreach['iter']['iteration']++;
?>
                <td align="center" <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63" <?php else: ?><?php echo smarty_function_math(array('equation' => "x+1",'x' => $this->_tpl_vars['ZL'],'assign' => 'ZL'), $this);?>
}<?php endif; ?>>
                    <b><?php echo $this->_foreach['iter']['iteration']; ?>
</b></td>
            <?php endforeach; endif; unset($_from); ?>
            <td align="center">oLN</td>
            <td align="center">oS</td>
            <td align="center">oW</td>
            <td align="center">oN</td>
            <td align="center">SPL</td>
            <td align="center">oNpt</td>
            <td align="center">zX</td>
            <td align="center">zCO</td>
            <td align="center">zCE</td>
            <td align="center">zCM</td>
            <td align="center">zCFS</td>
            <td align="center">zAbs</td>
            <td align="center">zInv</td>
            <td align="center">zCIC</td>
            <td align="center">zT</td>
            <td align="center">TzNel</td>
        </tr>
        <tr>
            <td><b>#</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Nume prenume'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Tip ore'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Max'), $this);?>
</b></td>
            <td><b><?php echo smarty_function_translate(array('label' => 'Total'), $this);?>
</b></td>
            <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                <td align="center" <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63"<?php endif; ?>><b><?php echo $this->_tpl_vars['wday']; ?>
</b></td>
            <?php endforeach; endif; unset($_from); ?>
            <td colspan="16" style="text-align: center;">
                <?php echo smarty_function_translate(array('label' => 'o = ore, z = zile'), $this);?>
<br/>
                <table cellpadding="2" cellspacing="0" border="0">
                    <tr>
                        <td>LN = Normale</td>
                        <td>S = Suplimentare</td>
                        <td>W = Weekend</td>
                    </tr>
                    <tr>
                        <td>N = Norma</td>
                        <td>SPL = Suplimentare + Weekend</td>
                        <td>Npt = Noapte</td>
                    </tr>
                    <tr>
                        <td>X = In afara contractului de munca</td>
                        <td>CO = Concediu odihna</td>
                        <td>CE = Concediu evenimente</td>
                    </tr>
                    <tr>
                        <td>CM = Concediu medical</td>
                        <td>CFS = Concediu fara salariu</td>
                        <td>Abs = Absente</td>
                    </tr>
                    <tr>
                        <td>Inv = Invoire</td>
                        <td>T = Somaj tehnic</td>
                        <td>TNelucr = Total nelucrate</td>
                    </tr>
                    <!--                <li style="list-style: none; float: left;">LN = Normale</li>
                                    <li style="list-style: none; float: left;">S = Suplimentare</li>
                                    <li style="list-style: none; float: left;">W = Weekend</li>
                                    <li style="list-style: none; float: left;">N = Norma</li>
                                    <li style="list-style: none; float: left;">SPL = Suplimentare + Weekend</li>
                                    <li style="list-style: none; float: left;">Npt = Noapte</li>
                                    <li style="list-style: none; float: left;">X = In afara contractului de munca</li>
                                    <li style="list-style: none; float: left;">CO = Concediu odihna</li>
                                    <li style="list-style: none; float: left;">CE = Concediu evenimente</li>
                                    <li style="list-style: none; float: left;">CM = Concediu medical</li>
                                    <li style="list-style: none; float: left;">CFS = Concediu fara salariu</li>
                                    <li style="list-style: none; float: left;">Abs = Absente</li>
                                    <li style="list-style: none; float: left;">Inv = Invoire</li>
                                    <li style="list-style: none; float: left;">T = Somaj tehnic</li>
                                    <li style="list-style: none; float: left;">TNelucr = Total nelucrate</li>-->
                </table>

                <br/><b><?php echo $this->_tpl_vars['ZL']; ?>
<?php echo smarty_function_translate(array('label' => 'zile lucratoare'), $this);?>
 </b>
            </td>
        </tr>
        <?php $_from = $this->_tpl_vars['report']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }$this->_foreach['iter'] = array('total' => count($_from), 'iteration' => 0);
if ($this->_foreach['iter']['total'] > 0):
    foreach ($_from as $this->_tpl_vars['persid'] => $this->_tpl_vars['item']):
        $this->_foreach['iter']['iteration']++;
?>
            <tr bgcolor="#ffffff">
                <td><?php echo $this->_foreach['iter']['iteration']; ?>
</td>
                <td><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <td><?php echo smarty_function_translate(array('label' => '1.Norm'), $this);?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['MaxNorm']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['TNorm']; ?>
</td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td align="center" <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']]['Hours_Norm'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <?php endforeach; endif; unset($_from); ?>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TNorm'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TSpl'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TSplW'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['TONorm']; ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['SPL'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TNight'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TX'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCO'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCE'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCM'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCFS'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TAbs'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TInv'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TCIC'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TT'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <td align="center"><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['TNelucr'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td>&nbsp;</td>
                <td><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <td><?php echo smarty_function_translate(array('label' => '2.SPL'), $this);?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['MaxSPL']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['SPL']; ?>
</td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td align="center"
                        <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63"<?php endif; ?>><?php echo smarty_function_math(array('equation' => "x+y",'x' => ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']]['Hours_SplW'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)),'y' => ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']]['Hours_Spl'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0))), $this);?>
</td>
                <?php endforeach; endif; unset($_from); ?>
                <td colspan="16">&nbsp;</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td>&nbsp;</td>
                <td><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <td><?php echo smarty_function_translate(array('label' => '3.Noapte'), $this);?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['MaxNight']; ?>
</td>
                <td align="center"><?php echo $this->_tpl_vars['item']['TNight']; ?>
</td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td align="center" <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']]['Hours_Night'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <?php endforeach; endif; unset($_from); ?>
                <td colspan="16">&nbsp;</td>
            <tr>
            <tr bgcolor="#ffffff">
                <td style="border-bottom: 1px solid #000000;">&nbsp;</td>
                <td style="border-bottom: 1px solid #000000;"><?php echo $this->_tpl_vars['item']['FullName']; ?>
</td>
                <td style="border-bottom: 1px solid #000000;"><?php echo smarty_function_translate(array('label' => '4.Nelucr.'), $this);?>
</td>
                <td style="border-bottom: 1px solid #000000;" align="center">0</td>
                <td style="border-bottom: 1px solid #000000;" align="center"><?php echo smarty_function_math(array('equation' => "x*y",'x' => $this->_tpl_vars['item']['TNelucr'],'y' => $this->_tpl_vars['item']['WorkNorm']), $this);?>
</td>
                <?php $_from = $this->_tpl_vars['cal']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['data'] => $this->_tpl_vars['wday']):
?>
                    <td align="center" style="border-bottom: 1px solid #000000;"
                        <?php if ($this->_tpl_vars['wday'] == 'D' || $this->_tpl_vars['wday'] == 'S' || isset ( $this->_tpl_vars['legal'][$this->_tpl_vars['data']] )): ?>bgcolor="#fcde63"<?php endif; ?>><?php echo ((is_array($_tmp=@$this->_tpl_vars['item']['Data'][$this->_tpl_vars['data']]['Nelucr'])) ? $this->_run_mod_handler('default', true, $_tmp, 0) : smarty_modifier_default($_tmp, 0)); ?>
</td>
                <?php endforeach; endif; unset($_from); ?>
                <td colspan="16" style="border-bottom: 1px solid #000000;">&nbsp;</td>
            <tr>
                <?php endforeach; else: ?>
            <tr>
                <td class="celulaMenuSTDR" colspan="100"><?php echo smarty_function_translate(array('label' => 'Niciun rezultat!'), $this);?>
</td>
            </tr>
        <?php endif; unset($_from); ?>
    </table>
<?php endif; ?>