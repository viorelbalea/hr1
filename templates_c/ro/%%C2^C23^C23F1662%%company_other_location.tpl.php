<?php /* Smarty version 2.6.18, created on 2020-09-21 08:34:01
         compiled from company_other_location.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'company_other_location.tpl', 12, false),array('modifier', 'default', 'company_other_location.tpl', 61, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
    <?php if (! empty ( $_GET['CompanyID'] )): ?>
        <tr>
            <td valign="top" class="bkdTitleMenu">
                <span class="TitleBox"><?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "companies_submenu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?></span>
            </td>
            <td align="right" class="bkdTitleMenu"><span class="TitleBox"><?php echo $this->_tpl_vars['locations']['0']['CompanyName']; ?>
</span></td>
        </tr>
    <?php else: ?>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Adaugare companie'), $this);?>
</span></td>
        </tr>
    <?php endif; ?>
    <?php if ($this->_tpl_vars['err']->getErrors()): ?>
        <tr>
            <td colspan="2" class="celulaMenuSTDR" style="text-align: center; color: #FF0000; padding-top: 10px;"><?php echo $this->_tpl_vars['err']->getErrors(); ?>
</td>
        </tr>
    <?php endif; ?>
</table>

<?php $_from = $this->_tpl_vars['locations']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['info']):
?>
    <?php if (! empty ( $this->_tpl_vars['info']['ID'] )): ?><?php $this->assign('ID', $this->_tpl_vars['info']['ID']); ?><?php else: ?><?php $this->assign('ID', 0); ?><?php endif; ?>
    <form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post" onsubmit="return validForm(this);">
        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
            <tr>
                <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 4px; padding-bottom: 10px;">
                    <fieldset>
                        <legend>Sediu</legend>
                        <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
                            <tr>
                                <td>
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Judet'), $this);?>
:*</b></td>
                                            <td>
                                                <select id="DistrictID" name="DistrictID"
                                                        onchange="if (this.value>0) showInfo('ajax.php?o=city&districtID=' + this.value + '&rand=' + parseInt(Math.random()*999999999), 'div_CityID_<?php echo $this->_tpl_vars['ID']; ?>
');">
                                                    <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['districts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['DistrictID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['DistrictID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr valign="top">
                                            <td style="padding-top: 10px;"><b><?php echo smarty_function_translate(array('label' => 'Localitate'), $this);?>
:*</b></td>
                                            <td>
                                                <div id="div_CityID_<?php echo $this->_tpl_vars['ID']; ?>
">
                                                    <select name="CityID">
                                                        <option value=""><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                        <?php $_from = $this->_tpl_vars['info']['cities']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                            <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if (! empty ( $this->_tpl_vars['info']['CityID'] ) && $this->_tpl_vars['key'] == $this->_tpl_vars['info']['CityID']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                        <?php endforeach; endif; unset($_from); ?>
                                                    </select>
                                                </div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Cod postal'), $this);?>
:</b></td>
                                            <td><input type="text" name="StreetCode" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetCode'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="16"
                                                       onblurx="showInfo('ajax.php?o=street&districtID=' + document.getElementById('DistrictID').value + '&city=' + escape(document.getElementById('CityName').value) + '&code=' + escape(this.value) + '&rand=' + parseInt(Math.random()*999999999), 'StreetNameID')">
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Strada'), $this);?>
:*</b></td>
                                            <td>
                                                <div id="StreetNameID"><input type="text" name="StreetName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="128"></div>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Nr'), $this);?>
:</b></td>
                                            <td><input type="text" name="StreetNumber" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['StreetNumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="8" maxlength="8"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="2">
                                                <b><?php echo smarty_function_translate(array('label' => 'Bl'), $this);?>
:</b>&nbsp;<input type="text" name="Bl" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Bl'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8">&nbsp;
                                                <b><?php echo smarty_function_translate(array('label' => 'Sc'), $this);?>
:</b>&nbsp;<input type="text" name="Sc" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Sc'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8">&nbsp;
                                                <b><?php echo smarty_function_translate(array('label' => 'Et'), $this);?>
:</b>&nbsp;<input type="text" name="Et" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Et'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8">&nbsp;
                                                <b><?php echo smarty_function_translate(array('label' => 'Ap'), $this);?>
:</b>&nbsp;<input type="text" name="Ap" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['Ap'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="5" maxlength="8">&nbsp;
                                            </td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon 1'), $this);?>
*:</b></td>
                                            <td><input type="text" name="PhoneNumberA" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberA'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon 2: '), $this);?>
</b></td>
                                            <td><input type="text" name="PhoneNumberB" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['PhoneNumberB'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Fax'), $this);?>
:</b></td>
                                            <td><input type="text" name="FaxNumber" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['FaxNumber'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="16" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <input type="radio" name="AddressType" value="1" <?php if ($this->_tpl_vars['info']['AddressType'] == 1): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'sediu social'), $this);?>

                                                <input type="radio" name="AddressType" value="2" <?php if ($this->_tpl_vars['info']['AddressType'] == 2): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'punct de lucru'), $this);?>

                                                <br>
                                                <p><input type="checkbox" name="MailingAddress" value="1"
                                                          <?php if ($this->_tpl_vars['info']['MailingAddress'] == 1): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'adresa de corespondenta'), $this);?>
</p>
                                                <p><input type="checkbox" name="FactoringAddress" value="1"
                                                          <?php if ($this->_tpl_vars['info']['FactoringAddress'] == 1): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'adresa de facturare'), $this);?>
</p>
                                                <p><input type="checkbox" name="DeliveryAddress" value="1"
                                                          <?php if ($this->_tpl_vars['info']['DeliveryAddress'] == 1): ?>checked<?php endif; ?>><?php echo smarty_function_translate(array('label' => 'adresa de livrare'), $this);?>
</p>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                                <td style="vertical-align: top; padding-left: 20px; padding-right: 10px;">
                                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                                        <tr>
                                            <td colspan="2" style="padding-top: 10px;"><b><u><?php echo smarty_function_translate(array('label' => 'Persoana de contact'), $this);?>
</u></b></td>
                                        <tr>
                                            <td width="100"><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactName" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactName'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactPhone" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactPhone'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactEmail" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactEmail'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
:</b></td>
                                            <td>
                                                <select name="ContactFunctionID">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['jobstitle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['ContactFunctionID'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="2" style="padding-top: 10px;"><b><u><?php echo smarty_function_translate(array('label' => 'Persoana de contact 2'), $this);?>
</u></b></td>
                                        <tr>
                                            <td width="100"><b><?php echo smarty_function_translate(array('label' => 'Nume'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactName2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactName2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Telefon'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactPhone2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactPhone2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="16"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Email'), $this);?>
:</b></td>
                                            <td><input type="text" name="ContactEmail2" value="<?php echo ((is_array($_tmp=@$this->_tpl_vars['info']['ContactEmail2'])) ? $this->_run_mod_handler('default', true, $_tmp, '') : smarty_modifier_default($_tmp, '')); ?>
" size="30" maxlength="64"></td>
                                        </tr>
                                        <tr>
                                            <td><b><?php echo smarty_function_translate(array('label' => 'Functie'), $this);?>
:</b></td>
                                            <td>
                                                <select name="ContactFunctionID2">
                                                    <option value="0"><?php echo smarty_function_translate(array('label' => 'alege...'), $this);?>
</option>
                                                    <?php $_from = $this->_tpl_vars['jobstitle']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                                        <option value="<?php echo $this->_tpl_vars['key']; ?>
" <?php if ($this->_tpl_vars['info']['ContactFunctionID2'] == $this->_tpl_vars['key']): ?>selected<?php endif; ?>><?php echo $this->_tpl_vars['item']; ?>
</option>
                                                    <?php endforeach; endif; unset($_from); ?>
                                                </select>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>&nbsp;</td>
                                            <td>
                                                <?php if ($this->_tpl_vars['ID'] > 0): ?>
                                                    <input type="hidden" name="ID" value="<?php echo $this->_tpl_vars['ID']; ?>
">
                                                    <?php if ($this->_tpl_vars['locations']['0']['rw'] == 1): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Salveaza'), $this);?>
">&nbsp;&nbsp;<input type="button"
                                                                                                                                                        value="<?php echo smarty_function_translate(array('label' => 'Sterge'), $this);?>
"
                                                                                                                                                        onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigur(a)?'), $this);?>
')) window.location.href= '<?php echo $_SERVER['REQUEST_URI']; ?>
&action=del&ID=<?php echo $this->_tpl_vars['ID']; ?>
';"><?php endif; ?>
                                                <?php else: ?>
                                                    <input type="hidden" name="ID" value="0">
                                                    <?php if ($this->_tpl_vars['locations']['0']['rw'] == 1): ?><input type="submit" value="<?php echo smarty_function_translate(array('label' => 'Adauga'), $this);?>
"><?php endif; ?>
                                                <?php endif; ?>
                                            </td>
                                        </tr>
                                    </table>
                                </td>
                            </tr>
                        </table>
                    </fieldset>
                </td>
            </tr>
        </table>
    </form>
<?php endforeach; endif; unset($_from); ?>

<?php echo '
<script type="text/javascript">
    function validForm(f) {
        '; ?>

        return validTextField(f.DistrictID, '<?php echo smarty_function_translate(array('label' => 'Nu ati ales judetul'), $this);?>
!') &&
            validTextField(f.CityID, '<?php echo smarty_function_translate(array('label' => 'Nu ati specificat localitatea'), $this);?>
!') &&
            validTextField(f.StreetName, '<?php echo smarty_function_translate(array('label' => 'Nu ati specificat Strada'), $this);?>
!') &&
            validTextField(f.PhoneNumberA, '<?php echo smarty_function_translate(array('label' => 'Nu ati specificat telefonul'), $this);?>
!');
        <?php echo '
    }
</script>
'; ?>