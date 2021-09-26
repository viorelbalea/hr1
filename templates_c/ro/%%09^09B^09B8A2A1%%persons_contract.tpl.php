<?php /* Smarty version 2.6.18, created on 2020-12-03 10:12:53
         compiled from persons_contract.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'persons_contract.tpl', 6, false),array('modifier', 'date_format', 'persons_contract.tpl', 54, false),array('modifier', 'default', 'persons_contract.tpl', 111, false),array('modifier', 'escape', 'persons_contract.tpl', 449, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "persons_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<div id="layer_co" class="layer" style="display: none;">
    <div class="eticheta">
        <?php echo $this->_tpl_vars['eticheta']; ?>

    </div>
    <h3 class="layer"><?php echo smarty_function_translate(array('label' => 'Descriere'), $this);?>
</h3>
    <div class="observatiiTextbox">
        <textarea id="layer_co_notes"></textarea>
        <input type="hidden" id="layer_co_notes_dest" value=""/>

    </div>

    <div class="saveObservatii" style="margin-top: 4px">
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" onclick="setNotes();">
        <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
"
               onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">
    </div>
</div>
<!---->
<div id="layer_co_x" class="butonX" style="display: none;" title="Inchide"
     onclick="document.getElementById('layer_co').style.display = 'none'; document.getElementById('layer_co_x').style.display = 'none';">x
</div>

<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" enctype="multipart/form-data" name="pers" onsubmit="return validateForm(this);">
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
            <td class="celulaMenuST" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px; border-bottom:none;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Contract/Raport de serviciu'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td style="padding-top: 10px;" width="180"><b><?php echo smarty_function_translate(array('label' => 'Data angajarii'), $this);?>
:*</b></td>
                            <td style="padding-top: 10px;">
                                <input type="text" name="StartDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['StartDate'] ) && $this->_tpl_vars['info']['StartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1">
                                    var cal1 = new CalendarPopup();
                                    cal1.isShowNavigationDropdowns = true;
                                    cal1.setYearSelectStartOffset(10);
                                    //writeSource("js1");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1.select(document.pers.StartDate,'anchor1','dd.MM.yyyy'); return false;" NAME="anchor1" ID="anchor1"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Modalitatea de angajare'), $this);?>
:</b></td>
                            <td>
                                <select name="ModalitateAngajare">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['modalitateAngajare']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ModalitateAngajare'] ) && $this->_tpl_vars['info']['ModalitateAngajare'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b>Data plecarii:</b></td>
                            <td>
                                <input type="text" name="StopDate" class="formstyle"
                                       value="<?php if (( $this->_tpl_vars['info']['Status'] == 5 || $this->_tpl_vars['info']['Status'] == 6 ) && ! empty ( $this->_tpl_vars['info']['StopDate'] ) && $this->_tpl_vars['info']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                       size="10" readonly>
                                <SCRIPT LANGUAGE="JavaScript" ID="js2">
                                    var cal2 = new CalendarPopup();
                                    cal2.isShowNavigationDropdowns = true;
                                    cal2.setYearSelectStartOffset(10);
                                    //writeSource("js2");
                                </SCRIPT>
                                <?php if ($this->_tpl_vars['info']['Status'] == 5 || $this->_tpl_vars['info']['Status'] == 6): ?>
                                    <A HREF="#" onClick="cal2.select(document.pers.StopDate,'anchor2','dd.MM.yyyy'); document.pers.LeaveReason.disabled = false; return false;"
                                       NAME="anchor2" ID="anchor2"><img src="./images/cal.png" border="0"></A>
                                    |
                                    <A HREF="#"
                                       onClick="document.pers.StopDate.value = ''; document.pers.LeaveReason.disabled = true; return false;"><?php echo smarty_function_translate(array('label' => 'anuleaza'), $this);?>
</A>
                                <?php endif; ?>
                                <br>
                                (<?php echo smarty_function_translate(array('label' => 'doar pentru persoane cu status Plecat / Disponibilizat'), $this);?>
)
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Motivul plecarii'), $this);?>
:</b></td>
                            <td>
                                <select name="LeaveReason">
                                    <option value="0">alege...</option>
                                    <?php $_from = $this->_tpl_vars['leavereason']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
"
                                                <?php if (( $this->_tpl_vars['info']['Status'] == 5 || $this->_tpl_vars['info']['Status'] == 6 ) && ! empty ( $this->_tpl_vars['info']['LeaveReason'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['LeaveReason']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <div id="div_Law" style="float: right; display: none;">&nbsp;<?php echo smarty_function_translate(array('label' => 'conform articol lege'), $this);?>
&nbsp;<input type="text" name="Law"
                                                                                                                                                  value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Law'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
"
                                                                                                                                                  size="20" maxlength="255"></div>
                                <?php echo '
                                <script language="javascript">
                                    document.pers.LeaveReason.disabled = true;
                                    if (document.pers.StopDate.value) {
                                        document.pers.LeaveReason.disabled = false;
                                    }
                                    '; ?>

                                    <?php if ($this->_tpl_vars['info']['Status'] == 5 || $this->_tpl_vars['info']['Status'] == 6): ?>document.getElementById('div_Law').style.display = 'block';<?php endif; ?>
                                    <?php echo '
                                </script>
                                '; ?>

                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Numar cerere de demisie /<br/>incetare cu acordul partilor'), $this);?>
:</b></td>
                            <td>
                                <input type="text" <?php if ($this->_tpl_vars['info']['Status'] != 5 && $this->_tpl_vars['info']['Status'] != 6): ?>disabled='true'<?php endif; ?> name="ResignationDemandNo"
                                       value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ResignationDemandNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="255"/>
                                <br/>
                                (<?php echo smarty_function_translate(array('label' => 'doar pentru persoane cu status Plecat / Disponibilizat'), $this);?>
)
                            </td>
                        </tr>
                        <tr>
                            <td style="padding-top: 40px;"><b><?php echo smarty_function_translate(array('label' => 'Durata contract/raport de serviciu'), $this);?>
:</b></td>
                            <td style="padding-top: 40px;">
                                <select name="ContractType" onchange="if (this.value > 0) changeContractType(this.value);">
                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['contract_type']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['ContractType'] ) && $this->_tpl_vars['info']['ContractType'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Perioada proba/stagiu/preaviz'), $this);?>
:</b></td>
                            <td>
                                <?php echo smarty_function_translate(array('label' => 'Proba/stagiu'), $this);?>
:
                                <select name="ContractProbationPeriod">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['probation_periods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['info']['ContractProbationPeriod'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <?php echo smarty_function_translate(array('label' => 'zile lucratoare'), $this);?>

                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo smarty_function_translate(array('label' => 'Perioada preaviz'), $this);?>
:
                                <select name="ContractDismissalPeriod">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['dismissal_periods']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['item']; ?>
" <?php if ($this->_tpl_vars['info']['ContractDismissalPeriod'] == $this->_tpl_vars['item']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                <?php echo smarty_function_translate(array('label' => 'zile lucratoare'), $this);?>

                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td>
                                <?php echo smarty_function_translate(array('label' => 'Data inceput'), $this);?>
:
                                <input type="text" name="ProbaStartDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['ProbaStartDate'] ) && $this->_tpl_vars['info']['ProbaStartDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ProbaStartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_ProbaStartDate">
                                    var cal_ProbaStartDate = new CalendarPopup();
                                    cal_ProbaStartDate.isShowNavigationDropdowns = true;
                                    cal_ProbaStartDate.setYearSelectStartOffset(10);
                                </SCRIPT>
                                <A HREF="#" onClick="cal_ProbaStartDate.select(document.pers.ProbaStartDate,'anchor_ProbaStartDate','dd.MM.yyyy'); return false;" NAME="anchor_ProbaStartDate" ID="anchor_ProbaStartDate"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ProbaStartDate.value = ''; return false;">anuleaza</A>
                                &nbsp;&nbsp;&nbsp;&nbsp;
                                <?php echo smarty_function_translate(array('label' => 'Data final'), $this);?>
:
                                <input type="text" name="ProbaStopDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['ProbaStopDate'] ) && $this->_tpl_vars['info']['ProbaStopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ProbaStopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js_ProbaStopDate">
                                    var cal_ProbaStopDate = new CalendarPopup();
                                    cal_ProbaStopDate.isShowNavigationDropdowns = true;
                                    cal_ProbaStopDate.setYearSelectStartOffset(10);
                                </SCRIPT>
                                <A HREF="#" onClick="cal_ProbaStopDate.select(document.pers.ProbaStopDate,'anchor_ProbaStopDate','dd.MM.yyyy'); return false;" NAME="anchor_ProbaStopDate" ID="anchor_ProbaStopDate"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ProbaStopDate.value = ''; return false;">anuleaza</A>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data contract/act administrativ'), $this);?>
:</b></td>
                            <td>
                                <input type="text" name="ContractDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['ContractDate'] ) && $this->_tpl_vars['info']['ContractDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ContractDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                       maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3">
                                    var cal3 = new CalendarPopup();
                                    cal3.isShowNavigationDropdowns = true;
                                    cal3.setYearSelectStartOffset(10);
                                    //writeSource("js3");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3.select(document.pers.ContractDate,'anchor3','dd.MM.yyyy'); return false;" NAME="anchor3" ID="anchor3"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#" onClick="document.pers.ContractDate.value = ''; return false;">anuleaza</A>
                            </td>
                        </tr>
                        <tr id="div_ContractExpDate">
                            <td><b><?php echo smarty_function_translate(array('label' => 'Data expirare contract'), $this);?>
:</b><br/><?php echo smarty_function_translate(array('label' => '(ultima zi lucratoare in companie)'), $this);?>
</td>
                            <td>
                                <input type="text" name="ContractExpDate" class="formstyle"
                                       value="<?php if (! empty ( $this->_tpl_vars['info']['ContractExpDate'] ) && $this->_tpl_vars['info']['ContractExpDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ContractExpDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                       size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4">
                                    var cal4 = new CalendarPopup();
                                    cal4.isShowNavigationDropdowns = true;
                                    cal4.setYearSelectStartOffset(10);
                                    //writeSource("js4");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4.select(document.pers.ContractExpDate,'anchor4','dd.MM.yyyy'); return false;" NAME="anchor4" ID="anchor4"><img
                                            src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                        onClick="document.pers.ContractExpDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'anuleaza'), $this);?>
</A>
                                <script language="javascript">
                                    <?php if ($this->_tpl_vars['info']['ContractType'] != 1): ?>
                                    document.getElementById('div_ContractExpDate').style.display = 'none';
                                    <?php endif; ?>
                                </script>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Numar contract/act administrativ'), $this);?>
:</b></td>
                            <td><input type="text" name="ContractNo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContractNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="10" maxlength="32"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Tip angajat'), $this);?>
:</b></td>
                            <td><?php echo $this->_tpl_vars['status'][$this->_tpl_vars['info']['Status']]; ?>
 | <?php echo $this->_tpl_vars['substatus'][$this->_tpl_vars['info']['Status']][$this->_tpl_vars['info']['SubStatus']]; ?>
</td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Tip norma'), $this);?>
:</b></td>
                            <td>
                                <select name="NormType">
                                    <option value="">- alege -</option>
                                    <?php $_from = $this->_tpl_vars['normType']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['NormType'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Durata timp munca'), $this);?>
:</b></td>
                            <td>
                                <select name="WorkLength">
                                    <option value="">- alege -</option>
                                    <?php $_from = $this->_tpl_vars['workLength']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['WorkLength'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Repartizare timp munca'), $this);?>
:</b></td>
                            <td>
                                <select name="WorkTime">
                                    <option value="">- alege -</option>
                                    <?php $_from = $this->_tpl_vars['workTime']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['WorkTime'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Program de lucru'), $this);?>
:</b></td>
                            <td>
                                <select name="WorkPrg">
                                    <option value="">- alege -</option>
                                    <?php $_from = $this->_tpl_vars['workPrg']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['WorkPrg'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                        <!--<tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Norma de lucru'), $this);?>
:</b></td>
                            <td><input type="text" name="WorkNorm" value="<?php if (! empty ( $this->_tpl_vars['info']['WorkNorm'] )): ?><?php echo $this->_tpl_vars['info']['WorkNorm']; ?>
<?php else: ?>8<?php endif; ?>" size="3"
                                       maxlength="2"> <?php echo smarty_function_translate(array('label' => '(ore de lucru / zi)'), $this);?>
</td>
                        </tr>-->
                        <!--<tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Ora de inceput program'), $this);?>
:</b></td>
                            <td>
                                <select name="WorkStartHour">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hour']):
?>
                                        <option value="<?php echo $this->_tpl_vars['hour']; ?>
" <?php if (((is_array($_tmp=@$this->_tpl_vars['info']['WorkStartHour'])) ? $this->_run_mod_handler('default', true, $_tmp, '09:00') : smarty_modifier_default($_tmp, '09:00')) == $this->_tpl_vars['hour']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['hour']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>-->
                        <!--<tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Intervalul orar de pauza'), $this);?>
:</b></td>
                            <td>
                                <select name="LunchBreakStartHour">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hour']):
?>
                                        <option value="<?php echo $this->_tpl_vars['hour']; ?>
" <?php if (((is_array($_tmp=@$this->_tpl_vars['info']['LunchBreakStartHour'])) ? $this->_run_mod_handler('default', true, $_tmp, '13:00') : smarty_modifier_default($_tmp, '13:00')) == $this->_tpl_vars['hour']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['hour']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                                :
                                <select name="LunchBreakEndHour">
                                    <option value=""></option>
                                    <?php $_from = $this->_tpl_vars['hours']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['hour']):
?>
                                        <option value="<?php echo $this->_tpl_vars['hour']; ?>
" <?php if (((is_array($_tmp=@$this->_tpl_vars['info']['LunchBreakEndHour'])) ? $this->_run_mod_handler('default', true, $_tmp, '14:00') : smarty_modifier_default($_tmp, '14:00')) == $this->_tpl_vars['hour']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['hour']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>-->
                    </table>
                    <div id="div_Suspendat" style="display: none;">
                        <table border="0" cellpadding="4" cellspacing="0" class="screen">
                            <tr>
                                <td style="padding-top: 10px;" width="180"><b><?php echo smarty_function_translate(array('label' => 'Data suspendarii'), $this);?>
:</b></td>
                                <td style="padding-top: 10px;">
                                    <input type="text" name="SuspendDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['SuspendDate'] ) && $this->_tpl_vars['info']['SuspendDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['SuspendDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                           maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js5">
                                        var cal5 = new CalendarPopup();
                                        cal5.isShowNavigationDropdowns = true;
                                        cal5.setYearSelectStartOffset(10);
                                        //writeSource("js5");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal5.select(document.pers.SuspendDate,'anchor5','dd.MM.yyyy'); return false;" NAME="anchor5" ID="anchor5"><img
                                                src="./images/cal.png" border="0"></A>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Motivul suspendarii'), $this);?>
:</b></td>
                                <td>
                                    <select name="SuspReason">
                                        <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                        <?php $_from = $this->_tpl_vars['suspReason']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['SuspReason'] ) && $this->_tpl_vars['info']['SuspReason'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                        <?php endforeach; endif; unset($_from); ?>
                                    </select>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Nr. cerere suspendare CIC'), $this);?>
:</b></td>
                                <td>
                                    <input type="text" name="CICSuspensionDemandNo" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['CICSuspensionDemandNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="20" maxlength="255"/>
                                    <br/>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Data estimata a revenirii'), $this);?>
:</b></td>
                                <td>
                                    <input type="text" name="EstimateReturnDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['EstimateReturnDate'] ) && $this->_tpl_vars['info']['EstimateReturnDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['EstimateReturnDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>"
                                           size="10" readonly>
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6">
                                        var cal6 = new CalendarPopup();
                                        cal6.isShowNavigationDropdowns = true;
                                        cal6.setYearSelectStartOffset(10);
                                        //writeSource("js6");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6.select(document.pers.EstimateReturnDate,'anchor6','dd.MM.yyyy'); return false;" NAME="anchor6" ID="anchor6"><img
                                                src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                            onClick="document.pers.EstimateReturnDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'anuleaza'), $this);?>
</A>
                                </td>
                            </tr>
                            <tr>
                                <td><b><?php echo smarty_function_translate(array('label' => 'Data revenirii'), $this);?>
:</b></td>
                                <td>
                                    <input type="text" name="ReturnDate" class="formstyle"
                                           value="<?php if (! empty ( $this->_tpl_vars['info']['ReturnDate'] ) && $this->_tpl_vars['info']['ReturnDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['info']['ReturnDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" size="10"
                                           readonly>
                                    <SCRIPT LANGUAGE="JavaScript" ID="js6_2">
                                        var cal6_2 = new CalendarPopup();
                                        cal6_2.isShowNavigationDropdowns = true;
                                        cal6_2.setYearSelectStartOffset(10);
                                        //writeSource("js6_2");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal6_2.select(document.pers.ReturnDate,'anchor6_2','dd.MM.yyyy'); return false;" NAME="anchor6_2" ID="anchor6_2"><img
                                                src="./images/cal.png" border="0"></A> | <A HREF="#"
                                                                                            onClick="document.pers.ReturnDate.value = ''; return false;"><?php echo smarty_function_translate(array('label' => 'anuleaza'), $this);?>
</A>
                                </td>
                            </tr>
                            <tr>
                                <td><b>Comentarii:</b></td>
                                <td><textarea name="SuspendNotes" cols="40" rows="4" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['SuspendNotes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea></td>
                            </tr>
                        </table>
                    </div>
                    <?php if ($this->_tpl_vars['info']['ContractType'] == 3): ?>
                        <script language="javascript">
                            document.getElementById('div_Suspendat').style.display = '';
                        </script>
                    <?php endif; ?>
                </fieldset>
                <br>

            </td>
            <td class="celulaMenuDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;  border-bottom:none;">
                <br/>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Acte aditionale/administrative'), $this);?>
</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'Numar act'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Data incheiere act<br/>aditional/administrativ'), $this);?>
</td>
                            <td style="width:120px;"><?php echo smarty_function_translate(array('label' => 'Data de la care<br/>produce efecte'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => ' '), $this);?>
Observatii</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['actead']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td><input type="text" id="ActNo_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['ActNo']; ?>
" size="10" maxlength="16"></td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value="" size="10" maxlength="10">
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
                                    <A HREF="#" onClick="cal1_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor1_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                       NAME="anchor1_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor1_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StopDate_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php if ($this->_tpl_vars['item']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
<?php endif; ?>" class="formstyle"
                                           value="" size="10" maxlength="10">
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
                                    <A HREF="#" onClick="cal2_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor2_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                       NAME="anchor2_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor2_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td rowspan="2">
                                    <input type="hidden" id="Notes_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="Notes_<?php echo $this->_tpl_vars['key']; ?>
_display"><?php echo $this->_tpl_vars['item']['Notes']; ?>
</span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('Notes_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td rowspan="2"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('ActNo_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action=edit&ActID=<?php echo $this->_tpl_vars['key']; ?>
&ActNo=' + escape(document.getElementById('ActNo_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&StartDate=' + document.getElementById('StartDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&StopDate=' + document.getElementById('StopDate_<?php echo $this->_tpl_vars['key']; ?>
').value + '&Notes=' + escape(document.getElementById('Notes_<?php echo $this->_tpl_vars['key']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar act, Data inceput, Data sfarsit!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica act aditional'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                <td rowspan="2"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action=del&ActID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge act aditional'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                            </tr>
                            <tr>
                                <td colspan="3"><?php if (( ! empty ( $this->_tpl_vars['item']['FileLink'] ) )): ?><a href="<?php echo $this->_tpl_vars['item']['FileLink']; ?>
"><?php echo $this->_tpl_vars['item']['FileName']; ?>
</a><?php endif; ?></td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <tr>
                            <td><input type="text" id="ActNo_0" size="10" maxlength="16"></td>
                            <td nowrap="nowrap">
                                <input type="text" id="StartDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js1_0">
                                    var cal1_0 = new CalendarPopup();
                                    cal1_0.isShowNavigationDropdowns = true;
                                    cal1_0.setYearSelectStartOffset(10);
                                    //writeSource("js1_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal1_0.select(document.getElementById('StartDate_0'),'anchor1_0','dd.MM.yyyy'); return false;" NAME="anchor1_0" ID="anchor1_0"><img
                                            src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap="nowrap">
                                <input type="text" id="StopDate_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js2_0">
                                    var cal2_0 = new CalendarPopup();
                                    cal2_0.isShowNavigationDropdowns = true;
                                    cal2_0.setYearSelectStartOffset(10);
                                    //writeSource("js2_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal2_0.select(document.getElementById('StopDate_0'),'anchor2_0','dd.MM.yyyy'); return false;" NAME="anchor2_0"
                                   ID="anchor2_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td>
                                <input type="hidden" id="Notes_0" value=""/>
                                <span id="Notes_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('Notes_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('ActNo_0').value && document.getElementById('StartDate_0').value && checkDate(document.getElementById('StartDate_0').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action=new&ActNo=' + escape(document.getElementById('ActNo_0').value) + '&StartDate=' + document.getElementById('StartDate_0').value + '&StopDate=' + document.getElementById('StopDate_0').value + '&Notes=' + escape(document.getElementById('Notes_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar act, Data inceput, Data sfarsit!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga act aditional'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                        </tr>
                    </table>
                </fieldset>
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Sanctiuni'), $this);?>
</legend>
                    <table cellspacing="0" cellpadding="4">
                        <tr>
                            <td><?php echo smarty_function_translate(array('label' => 'Numar'), $this);?>
</td>
                            <td style="width:120px;"><?php echo smarty_function_translate(array('label' => 'Data Inceput'), $this);?>
</td>
                            <td style="width:120px;"><?php echo smarty_function_translate(array('label' => 'Data Final'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => 'Radiat'), $this);?>
</td>
                            <td><?php echo smarty_function_translate(array('label' => ' '), $this);?>
Observatii</td>
                            <td>&nbsp;</td>
                            <td>&nbsp;</td>
                        </tr>
                        <?php $_from = $this->_tpl_vars['warnings']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                            <tr>
                                <td><input type="text" id="WarNo_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['WarNo']; ?>
" size="10" maxlength="16"></td>
                                <td nowrap="nowrap">
                                    <input type="text" id="StartDate3_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js3_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal3_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal3_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal3_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js3_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal3_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('StartDate3_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor3_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                       NAME="anchor3_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor3_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td nowrap="nowrap">
                                    <input type="text" id="EndDate4_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['EndDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, "%d.%m.%Y") : smarty_modifier_date_format($_tmp, "%d.%m.%Y")); ?>
" class="formstyle" value="" size="10" maxlength="10">
                                    <SCRIPT LANGUAGE="JavaScript" ID="js4_<?php echo $this->_tpl_vars['key']; ?>
">
                                        var cal4_<?php echo $this->_tpl_vars['key']; ?>
 = new CalendarPopup();
                                        cal4_<?php echo $this->_tpl_vars['key']; ?>
.isShowNavigationDropdowns = true;
                                        cal4_<?php echo $this->_tpl_vars['key']; ?>
.setYearSelectStartOffset(10);
                                        //writeSource("js4_<?php echo $this->_tpl_vars['key']; ?>
");
                                    </SCRIPT>
                                    <A HREF="#" onClick="cal4_<?php echo $this->_tpl_vars['key']; ?>
.select(document.getElementById('EndDate4_<?php echo $this->_tpl_vars['key']; ?>
'),'anchor4_<?php echo $this->_tpl_vars['key']; ?>
','dd.MM.yyyy'); return false;"
                                       NAME="anchor4_<?php echo $this->_tpl_vars['key']; ?>
" ID="anchor4_<?php echo $this->_tpl_vars['key']; ?>
"><img src="./images/cal.png" border="0"></A>
                                </td>
                                <td><input type="checkbox" id="Radiat_<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['item']['Radiat'] > 0): ?>checked<?php endif; ?> value="yes" /></td>
                                <td>
                                    <input type="hidden" id="NotesAV_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Notes']; ?>
"/>
                                    <span id="NotesAV_<?php echo $this->_tpl_vars['key']; ?>
_display"><?php echo $this->_tpl_vars['item']['Notes']; ?>
</span>
                                    [<a href="#" title="<?php echo ((is_array($_tmp=$this->_tpl_vars['item']['Notes'])) ? $this->_run_mod_handler('escape', true, $_tmp, 'javascript') : smarty_modifier_escape($_tmp, 'javascript')); ?>
" onclick="getNotes('NotesAV_<?php echo $this->_tpl_vars['key']; ?>
'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                                </td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_mod"><a href="#"
                                                                onclick="if (document.getElementById('WarNo_<?php echo $this->_tpl_vars['key']; ?>
').value && document.getElementById('StartDate3_<?php echo $this->_tpl_vars['key']; ?>
').value && checkDate(document.getElementById('StartDate3_<?php echo $this->_tpl_vars['key']; ?>
').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action_contract_warning=edit&WarID=<?php echo $this->_tpl_vars['key']; ?>
&WarNo=' + escape(document.getElementById('WarNo_<?php echo $this->_tpl_vars['key']; ?>
').value) + '&StartDate=' + document.getElementById('StartDate3_<?php echo $this->_tpl_vars['key']; ?>
').value + '&EndDate=' + document.getElementById('EndDate4_<?php echo $this->_tpl_vars['key']; ?>
').value + '&Radiat=' + document.getElementById('Radiat_<?php echo $this->_tpl_vars['key']; ?>
').checked + '&Notes=' + escape(document.getElementById('NotesAV_<?php echo $this->_tpl_vars['key']; ?>
').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar, Data!'), $this);?>
'); return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Modifica avertisment'), $this);?>
"><b>Mod</b></a></div><?php endif; ?></td>
                                <td><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                        <div id="button_del"><a href="#"
                                                                onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action_contract_warning=del&WarID=<?php echo $this->_tpl_vars['key']; ?>
'; return false;"
                                                                title="<?php echo smarty_function_translate(array('label' => 'Sterge avertisment'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                            </tr>
                        <?php endforeach; endif; unset($_from); ?>
                        <tr>
                            <td><input type="text" id="WarNo_0" size="10" maxlength="16"></td>
                            <td nowrap="nowrap">
                                <input type="text" id="StartDate3_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js3_0">
                                    var cal3_0 = new CalendarPopup();
                                    cal3_0.isShowNavigationDropdowns = true;
                                    cal3_0.setYearSelectStartOffset(10);
                                    //writeSource("js3_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal3_0.select(document.getElementById('StartDate3_0'),'anchor3_0','dd.MM.yyyy'); return false;" NAME="anchor3_0"
                                   ID="anchor3_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td nowrap="nowrap">
                                <input type="text" id="EndDate4_0" class="formstyle" value="" size="10" maxlength="10">
                                <SCRIPT LANGUAGE="JavaScript" ID="js4_0">
                                    var cal4_0 = new CalendarPopup();
                                    cal4_0.isShowNavigationDropdowns = true;
                                    cal4_0.setYearSelectStartOffset(10);
                                    //writeSource("js4_0");
                                </SCRIPT>
                                <A HREF="#" onClick="cal4_0.select(document.getElementById('EndDate4_0'),'anchor4_0','dd.MM.yyyy'); return false;" NAME="anchor4_0"
                                   ID="anchor4_0"><img src="./images/cal.png" border="0"></A>
                            </td>
                            <td><input type="checkbox" id="Radiat_0" value="yes" /></td>
                            <td>
                                <input type="hidden" id="NotesAV_0" value=""/>
                                <span id="NotesAV_0_display"></span>
                                [<a href="#" title="" onclick="getNotes('NotesAV_0'); return false;"><?php echo smarty_function_translate(array('label' => 'Editare'), $this);?>
</a>]
                            </td>
                            <td colspan="2" nowrap="nowrap"><?php if ($this->_tpl_vars['info']['rw'] == 1): ?>
                                    <div id="button_add"><a href="#"
                                                            onclick="if (document.getElementById('WarNo_0').value && document.getElementById('StartDate3_0').value && checkDate(document.getElementById('StartDate3_0').value, 'Data inceput')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action_contract_warning=new&WarNo=' + escape(document.getElementById('WarNo_0').value) + '&StartDate=' + document.getElementById('StartDate3_0').value + '&EndDate=' + document.getElementById('EndDate4_0').value + '&Radiat=' + document.getElementById('Radiat_0').checked + '&Notes=' + escape(document.getElementById('NotesAV_0').value); else alert('<?php echo smarty_function_translate(array('label' => 'Completati Numar, Data!'), $this);?>
'); return false;"
                                                            title="<?php echo smarty_function_translate(array('label' => 'Adauga avertisment'), $this);?>
"><b>Add</b></a></div><?php endif; ?></td>
                        </tr>
                    </table>
                </fieldset>
                <!--<fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Date financiare'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'IBAN'), $this);?>
:</b></td>
                            <td><input type="text" name="BankAccount" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankAccount'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Banca'), $this);?>
:</b></td>
                            <td><input type="text" name="BankName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Sucursala'), $this);?>
:</b></td>
                            <td><input type="text" name="BankLocation" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['BankLocation'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></td>
                        </tr>
                    </table>
                </fieldset>
                <br/>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Asigurare sanatate'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td><b><?php echo smarty_function_translate(array('label' => 'Casa asigurare sanatate'), $this);?>
:</b></td>
                            <td>
                                <select name="HealthCompanyID">
                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                    <?php $_from = $this->_tpl_vars['health_companies']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['HealthCompanyID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                    <?php endforeach; endif; unset($_from); ?>
                                </select>
                            </td>
                        </tr>
                    </table>
                </fieldset>
                <br>-->
                <table border="0" cellpadding="4" cellspacing="0" class="screen">
                    <tr>
                        <td colspan="2">
                            <b><?php echo smarty_function_translate(array('label' => 'Observatii'), $this);?>
:</b><br>
                            <textarea name="Notes" cols="60" rows="6" wrap="soft"><?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Notes'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
</textarea>
                        </td>
                    </tr>
                </table>
                <div style="text-align:center;">
                    <?php if ($this->_tpl_vars['info']['rw'] == 1 || ! empty ( $_POST )): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
" class="formstyle"><?php endif; ?>
                    <input type="button" value="<?php echo smarty_function_translate(array('label' => 'Anuleaza'), $this);?>
" onclick="window.location='./?m=persons'" class="formstyle">
                </div>
            </td>
        </tr>
        <?php if (! empty ( $this->_tpl_vars['contracts'] )): ?>
            <tr>
                <td colspan="2">
                    <fieldset>
                        <legend><?php echo smarty_function_translate(array('label' => 'Istoric contracte'), $this);?>
</legend>
                        <p style="padding-left: 4px;"><a href="#"
                                                         onclick="var status = document.getElementById('div_contract_history').style.display; if (status == 'none') Effect.SlideDown('div_contract_history'); else Effect.SlideUp('div_contract_history'); return false;"><b><?php echo smarty_function_translate(array('label' => 'Listare istoric contracte'), $this);?>
</b></a>
                        </p>
                        <div id="div_contract_history" style="display: none;">
                            <table cellspacing="0" cellpadding="4" width="100%">
                                <tr>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data angajarii'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data plecarii'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Motivul plecarii'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Tip contract'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data revenirii'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data contract'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data expirarii'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Numar contract'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Tip angajat'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Program de lucru'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'Data modificare'), $this);?>
</b></td>
                                    <td><b><?php echo smarty_function_translate(array('label' => 'User'), $this);?>
</b></td>
                                    <td>&nbsp;</td>
                                </tr>
                                <?php $_from = $this->_tpl_vars['contracts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['contract']):
?>
                                    <tr>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['StartDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if ($this->_tpl_vars['contract']['ContractType'] == 3): ?><?php if (! empty ( $this->_tpl_vars['contract']['SuspendDate'] ) && $this->_tpl_vars['contract']['SuspendDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['SuspendDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?><?php else: ?><?php if (! empty ( $this->_tpl_vars['contract']['StopDate'] ) && $this->_tpl_vars['contract']['StopDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['StopDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?><?php endif; ?></td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if ($this->_tpl_vars['contract']['ContractType'] == 3): ?>Suspendat<?php else: ?><?php echo ((is_array($_tmp=@$this->_tpl_vars['leavereason'][$this->_tpl_vars['contract']['LeaveReason']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
<?php endif; ?></td>
                                        <td style="border-bottom: 1px solid #cccccc;">
                                            <?php echo ((is_array($_tmp=@$this->_tpl_vars['contract_type'][$this->_tpl_vars['contract']['ContractType']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>

                                            <?php if ($this->_tpl_vars['contract']['ContractType'] == 3): ?>
                                                <br>
                                                Data suspendarii: <?php if (! empty ( $this->_tpl_vars['contract']['SuspendDate'] ) && $this->_tpl_vars['contract']['SuspendDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['SuspendDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?>
                                                <br>
                                                Data estimata a revenirii: <?php if (! empty ( $this->_tpl_vars['contract']['EstimateReturnDate'] ) && $this->_tpl_vars['contract']['EstimateReturnDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['EstimateReturnDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?>
                                            <?php endif; ?>
                                        </td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if (! empty ( $this->_tpl_vars['contract']['ReturnDate'] ) && $this->_tpl_vars['contract']['ReturnDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['ReturnDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?></td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if (! empty ( $this->_tpl_vars['contract']['ContractDate'] ) && $this->_tpl_vars['contract']['ContractDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['ContractDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?></td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if (! empty ( $this->_tpl_vars['contract']['ContractExpDate'] ) && $this->_tpl_vars['contract']['ContractExpDate'] != '0000-00-00'): ?><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['ContractExpDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y') : smarty_modifier_date_format($_tmp, '%d.%m.%Y')); ?>
<?php else: ?>-<?php endif; ?></td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['contract']['ContractNo'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['status'][$this->_tpl_vars['contract']['Status']])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo ((is_array($_tmp=@$this->_tpl_vars['contract']['WorkNorm'])) ? $this->_run_mod_handler('default', true, $_tmp, '-') : smarty_modifier_default($_tmp, '-')); ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo ((is_array($_tmp=$this->_tpl_vars['contract']['CreateDate'])) ? $this->_run_mod_handler('date_format', true, $_tmp, '%d.%m.%Y %H:%M') : smarty_modifier_date_format($_tmp, '%d.%m.%Y %H:%M')); ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php echo $this->_tpl_vars['contract']['UserName']; ?>
</td>
                                        <td style="border-bottom: 1px solid #cccccc;"><?php if ($_SESSION['USER_ID'] == 1): ?>
                                                <div id="button_del"><a href="#"
                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href = './?m=persons&o=contract&PersonID=<?php echo $_GET['PersonID']; ?>
&action_contract_history=del&ContractID=<?php echo $this->_tpl_vars['contract']['ContractID']; ?>
'; return false;"
                                                                        title="<?php echo smarty_function_translate(array('label' => 'Sterge intrare istoric contracte'), $this);?>
"><b>Del</b></a></div><?php endif; ?></td>
                                    </tr>
                                <?php endforeach; endif; unset($_from); ?>
                            </table>
                        </div>
                    </fieldset>
                </td>
            </tr>
        <?php endif; ?>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'campurile marcate cu * sunt obligatorii'), $this);?>
</span></td>
        </tr>
    </table>
</form>

<?php echo '
    <script type="text/javascript">
        function validateForm(f) {
            if (!checkDate(f.StartDate.value, \'Data angajarii\')) {
                return false;
            }
            if (!is_empty(f.ContractDate.value) && !checkDate(f.ContractDate.value, \'Data contract\')) {
                return false;
            }
            if (!is_empty(f.ContractExpDate.value) && !checkDate(f.ContractExpDate.value, \'Data expirare contract\')) {
                return false;
            }
            return true;
        }

        function changeContractType(index) {
            switch (index) {
                case \'1\':
                    document.getElementById(\'div_ContractExpDate\').style.display = \'\';
                    document.getElementById(\'div_Suspendat\').style.display = \'none\';
                    break;
                case \'2\':
                    document.getElementById(\'div_ContractExpDate\').style.display = \'none\';
                    document.getElementById(\'div_Suspendat\').style.display = \'none\';
                    break;
                case \'3\':
                    document.getElementById(\'div_Suspendat\').style.display = \'\';
                    break;
                default:
                    break;
            }
        }

        function getNotes(id) {
            document.getElementById(\'layer_co_notes\').value = document.getElementById(id).value;
            document.getElementById(\'layer_co_notes_dest\').value = id;
            document.getElementById(\'layer_co\').style.display = \'block\';
            document.getElementById(\'layer_co_x\').style.display = \'block\';
        }

        function setNotes() {
            var id = document.getElementById(\'layer_co_notes_dest\').value;
            document.getElementById(id).value = document.getElementById(\'layer_co_notes\').value;
            // document.getElementById(id + \'_display\').innerHTML = document.getElementById(\'layer_co_notes\').value.substring(0, 5) + \'...\';
            document.getElementById(id + \'_display\').innerHTML = document.getElementById(\'layer_co_notes\').value;
            document.getElementById(\'layer_co\').style.display = \'none\';
            document.getElementById(\'layer_co_x\').style.display = \'none\';
        }
    </script>
'; ?>