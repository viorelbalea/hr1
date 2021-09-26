<?php /* Smarty version 2.6.18, created on 2020-10-07 11:29:40
         compiled from dictionary_pcontracts.tpl */ ?>
<?php require_once(SMARTY_CORE_DIR . 'core.load_plugins.php');
smarty_core_load_plugins(array('plugins' => array(array('function', 'translate', 'dictionary_pcontracts.tpl', 5, false),)), $this); ?>
<?php $_smarty_tpl_vars = $this->_tpl_vars;
$this->_smarty_include(array('smarty_include_tpl_file' => "dictionary_menu.tpl", 'smarty_include_vars' => array()));
$this->_tpl_vars = $_smarty_tpl_vars;
unset($_smarty_tpl_vars);
 ?>
<form action="<?php echo $_SERVER['REQUEST_URI']; ?>
" method="post">
    <table border="0" cellpadding="4" cellspacing="0" class="screen" width="100%">
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBox"><?php echo smarty_function_translate(array('label' => 'Abonamente'), $this);?>
</span></td>
        </tr>
        <tr>
            <td class="celulaMenuSTDR" style="vertical-align: top; padding-left: 10px; padding-bottom: 10px; padding-right: 10px;">
                <br>
                <fieldset>
                    <legend><?php echo smarty_function_translate(array('label' => 'Abonamente'), $this);?>
</legend>
                    <table border="0" cellpadding="4" cellspacing="0" class="screen">
                        <tr>
                            <td>
                                <table border="0" cellpadding="4" cellspacing="0">
                                    <tr>
                                        <td colspan="2" style="border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center;">&nbsp;</td>
                                        <td colspan="4"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'Minute'), $this);?>
</td>
                                        <td colspan="2"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'SMS'), $this);?>
</td>
                                        <td colspan="1"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'Date MB National'), $this);?>
</td>
                                        <td colspan="2"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'Roaming'), $this);?>
</td>
                                        <td colspan="1"
                                            style="border-top: 1px solid #000; border-right: 1px solid #000; border-bottom: 1px solid #000; text-align: center; color: #ffffff; background-color: #ff0000;"><?php echo smarty_function_translate(array('label' => 'Prelungire achizitie telefon'), $this);?>
</td>
                                        <td colspan="1" style="border-bottom: 1px solid #000; text-align: center;">&nbsp;</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <tr>
                                        <td style="border-left:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Nr. telefon'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Tip abonament'), $this);?>
</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;"><?php echo smarty_function_translate(array('label' => 'Grup'), $this);?>
</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;"><?php echo smarty_function_translate(array('label' => 'Nationale'), $this);?>
</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;"><?php echo smarty_function_translate(array('label' => 'Alte retele mobile'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'International'), $this);?>
</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;"><?php echo smarty_function_translate(array('label' => 'Retea'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Nationale'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Trafic date inclus'), $this);?>
</td>
                                        <td style="border-bottom: 1px solid #000;text-align: center;"><?php echo smarty_function_translate(array('label' => 'Voce min/sms'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Date MB'), $this);?>
</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;">&nbsp;</td>
                                        <td style="border-right:1px solid #000; text-align: center;border-bottom: 1px solid #000;"><?php echo smarty_function_translate(array('label' => 'Cost'), $this);?>
</td>
                                        <td colspan="2">&nbsp;</td>
                                    </tr>
                                    <?php $_from = $this->_tpl_vars['contracts']; if (!is_array($_from) && !is_object($_from)) { settype($_from, 'array'); }if (count($_from)):
    foreach ($_from as $this->_tpl_vars['key'] => $this->_tpl_vars['item']):
?>
                                        <tr>
                                            <td><input type="text" id="PhoneNo_<?php echo $this->_tpl_vars['key']; ?>
" name="PhoneNo_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['PhoneNo']; ?>
" size="17" maxlength="17"></td>
                                            <td><input type="text" id="ContractType_<?php echo $this->_tpl_vars['key']; ?>
" name="ContractType_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['ContractType']; ?>
"></td>
                                            <td><input type="text" id="MinuteGrup_<?php echo $this->_tpl_vars['key']; ?>
" name="MinuteGrup_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['MinuteGrup']; ?>
" size="10"></td>
                                            <td><input type="text" id="MinuteNationale_<?php echo $this->_tpl_vars['key']; ?>
" name="MinuteNationale_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['MinuteNationale']; ?>
" size="10"></td>
                                            <td><input type="text" id="MinuteAlte_<?php echo $this->_tpl_vars['key']; ?>
" name="MinuteAlte_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['MinuteAlte']; ?>
" size="10"></td>
                                            <td><input type="text" id="MinuteInternationale_<?php echo $this->_tpl_vars['key']; ?>
" name="MinuteInternationale_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['MinuteInternationale']; ?>
"
                                                       size="10"></td>
                                            <td><input type="text" id="SMSRetea_<?php echo $this->_tpl_vars['key']; ?>
" name="SMSRetea_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['SMSRetea']; ?>
" size="10"></td>
                                            <td><input type="text" id="SMSNat_<?php echo $this->_tpl_vars['key']; ?>
" name="SMSNat_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['SMSNat']; ?>
" size="10"></td>
                                            <td><input type="text" id="TraficNational_<?php echo $this->_tpl_vars['key']; ?>
" name="TraficNational_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['TraficNational']; ?>
" size="10"></td>
                                            <td><input type="text" id="RoamingVoce_<?php echo $this->_tpl_vars['key']; ?>
" name="RoamingVoce_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['RoamingVoce']; ?>
" size="10"></td>
                                            <td><input type="text" id="RoamingTrafic_<?php echo $this->_tpl_vars['key']; ?>
" name="RoamingTrafic_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['RoamingTrafic']; ?>
" size="10"></td>
                                            <td><input type="text" id="PrelungireAchizitie_<?php echo $this->_tpl_vars['key']; ?>
" name="PrelungireAchizitie_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['PrelungireAchizitie']; ?>
"></td>
                                            <td><input type="text" id="Cost_<?php echo $this->_tpl_vars['key']; ?>
" name="Cost_<?php echo $this->_tpl_vars['key']; ?>
" value="<?php echo $this->_tpl_vars['item']['Cost']; ?>
"></td>

                                            <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                                <td>
                                                    <div id="button_mod"><a href="#" onclick="window.location.href = './?m=dictionary&o=phone_contracts&ID=<?php echo $this->_tpl_vars['key']; ?>
' +
                                                                '&PhoneNo=' + escape(document.getElementById('PhoneNo_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&ContractType=' + escape(document.getElementById('ContractType_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&MinuteGrup=' + escape(document.getElementById('MinuteGrup_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&MinuteNationale=' + escape(document.getElementById('MinuteNationale_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&MinuteAlte=' + escape(document.getElementById('MinuteAlte_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&MinuteInternationale=' + escape(document.getElementById('MinuteInternationale_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&SMSRetea=' + escape(document.getElementById('SMSRetea_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&SMSNat=' + escape(document.getElementById('SMSNat_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&TraficNational=' + escape(document.getElementById('TraficNational_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&RoamingVoce=' + escape(document.getElementById('RoamingVoce_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&RoamingTrafic=' + escape(document.getElementById('RoamingTrafic_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&PrelungireAchizitie=' + escape(document.getElementById('PrelungireAchizitie_<?php echo $this->_tpl_vars['key']; ?>
').value) +
                                                                '&Cost=' + escape(document.getElementById('Cost_<?php echo $this->_tpl_vars['key']; ?>
').value);
                                                                return false;" title="<?php echo smarty_function_translate(array('label' => 'Modifica contract'), $this);?>
"><b>Mod</b></a></div>
                                                </td>
                                                <td>
                                                    <div id="button_del"><a href="#"
                                                                            onclick="if (confirm('<?php echo smarty_function_translate(array('label' => 'Sunteti sigura(a)?'), $this);?>
')) window.location.href = './?m=dictionary&o=phone_contracts&ID=<?php echo $this->_tpl_vars['key']; ?>
&del=1'; return false;"
                                                                            title="<?php echo smarty_function_translate(array('label' => 'Sterge contract'), $this);?>
"><b>Del</b></a></div>
                                                </td>
                                            <?php endif; ?>
                                        </tr>
                                    <?php endforeach; endif; unset($_from); ?>
                                    <?php if ($this->_tpl_vars['rw'] == 1): ?>
                                        <tr>
                                            <td><input type="text" id="PhoneNo_0" name="PhoneNo_0" size="17" maxlength="17"></td>
                                            <td><input type="text" id="ContractType_0" name="ContractType_0"></td>
                                            <td><input type="text" id="MinuteGrup_0" name="MinuteGrup_0" size="10"></td>
                                            <td><input type="text" id="MinuteNationale_0" name="MinuteNationale_0" size="10"></td>
                                            <td><input type="text" id="MinuteAlte_0" name="MinuteAlte_0" size="10"></td>
                                            <td><input type="text" id="MinuteInternationale_0" name="MinuteInternationale_0" size="10"></td>
                                            <td><input type="text" id="SMSRetea_0" name="SMSRetea_0" size="10"></td>
                                            <td><input type="text" id="SMSNat_0" name="SMSNat_0" size="10"></td>
                                            <td><input type="text" id="TraficNational_0" name="TraficNational_0" size="10"></td>
                                            <td><input type="text" id="RoamingVoce_0" name="RoamingVoce_0" size="10"></td>
                                            <td><input type="text" id="RoamingTrafic_0" name="RoamingTrafic_0" size="10"></td>
                                            <td><input type="text" id="PrelungireAchizitie_0" name="PrelungireAchizitie_0"></td>
                                            <td><input type="text" id="Cost_0" name="Cost_0"></td>

                                            <td colspan="2">
                                                <div id="button_add"><a href="#" onclick="window.location.href = './?m=dictionary&o=phone_contracts&ID=0' +
				                                                                                 '&PhoneNo=' + escape(document.getElementById('PhoneNo_0').value) +  
				                                                                                 '&ContractType=' + escape(document.getElementById('ContractType_0').value) +  
				                                                                                 '&MinuteGrup=' + escape(document.getElementById('MinuteGrup_0').value) +  
				                                                                                 '&MinuteNationale=' + escape(document.getElementById('MinuteNationale_0').value) +  
				                                                                                 '&MinuteAlte=' + escape(document.getElementById('MinuteAlte_0').value) +  
				                                                                                 '&MinuteInternationale=' + escape(document.getElementById('MinuteInternationale_0').value) +  
				                                                                                 '&SMSRetea=' + escape(document.getElementById('SMSRetea_0').value) +  
				                                                                                 '&SMSNat=' + escape(document.getElementById('SMSNat_0').value) +  
				                                                                                 '&TraficNational=' + escape(document.getElementById('TraficNational_0').value) +  
				                                                                                 '&RoamingVoce=' + escape(document.getElementById('RoamingVoce_0').value) +  
				                                                                                 '&RoamingTrafic=' + escape(document.getElementById('RoamingTrafic_0').value) +  
				                                                                                 '&PrelungireAchizitie=' + escape(document.getElementById('PrelungireAchizitie_0').value) +  
				                                                                                 '&Cost=' + escape(document.getElementById('Cost_0').value); 
														 return false;" title="<?php echo smarty_function_translate(array('label' => 'Adauga contract'), $this);?>
"><b>Add</b></a></div>
                                            </td>
                                        </tr>
                                    <?php endif; ?>
                                </table>
                            </td>
                        </tr>
                    </table>
            </td>
        </tr>
        <tr>
            <td colspan="2" valign="top" class="bkdTitleMenu"><span class="TitleBoxDown"><?php echo smarty_function_translate(array('label' => 'lista de obiecte de inventar'), $this);?>
</span></td>
        </tr>
    </table>
</form>